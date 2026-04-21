<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use App\Models\News;
use App\Services\Media\MediaAttachService;
use App\Services\Media\MediaUploadService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    public function getTitle(): string
    {
        return 'Yeni Haber Oluştur';
    }

    protected ?UploadedFile $pendingCoverUpload = null;

    protected ?int $pendingExistingCoverMediaId = null;

    /** @var array<int, UploadedFile> */
    protected array $pendingGalleryUploads = [];

    /** @var array<int, int> */
    protected array $pendingExistingGalleryMediaIds = [];

    protected ?string $pendingVideoUrl = null;

    protected ?int $pendingExistingVideoMediaId = null;

    protected bool $pendingWatermarkEnabled = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (auth()->user()?->role === 'editor') {
            $data['author_user_id'] = auth()->id();
            $data['status'] = \App\Models\News::STATUS_DRAFT;
        }

        $this->pendingCoverUpload = $data['cover_upload'] ?? null;
        if (is_array($this->pendingCoverUpload)) {
            $this->pendingCoverUpload = reset($this->pendingCoverUpload);
        }
        $this->pendingExistingCoverMediaId = filled($data['existing_cover_media_id'] ?? null)
            ? (int) $data['existing_cover_media_id']
            : null;
        $this->pendingGalleryUploads = is_array($data['gallery_upload'] ?? null)
            ? $data['gallery_upload']
            : [];
        $this->pendingExistingGalleryMediaIds = array_values(array_map(
            'intval',
            array_filter($data['existing_gallery_media_ids'] ?? [], fn ($id) => filled($id))
        ));
        $this->pendingVideoUrl = filled($data['video_url'] ?? null)
            ? trim((string) $data['video_url'])
            : null;
        $this->pendingExistingVideoMediaId = filled($data['existing_video_media_id'] ?? null)
            ? (int) $data['existing_video_media_id']
            : null;
        $this->pendingWatermarkEnabled = (bool) ($data['watermark_enabled'] ?? false);

        unset($data['cover_upload']);
        unset($data['existing_cover_media_id']);
        unset($data['gallery_upload']);
        unset($data['existing_gallery_media_ids']);
        unset($data['video_url']);
        unset($data['existing_video_media_id']);
        unset($data['watermark_enabled']);

        return $data;
    }

    protected function afterCreate(): void
    {
        /** @var MediaUploadService $service */
        $service = app(MediaUploadService::class);

        /** @var MediaAttachService $attachService */
        $attachService = app(MediaAttachService::class);

        // COVER
        if ($this->pendingCoverUpload instanceof UploadedFile) {
            $media = $service->replacePrimaryForModel(
                $this->record,
                $this->pendingCoverUpload,
                'cover',
                [
                    'media_kind' => 'image',
                    'storage_type' => 'file',
                ],
                [
                    'title_override' => $this->record->title,
                    'watermark_enabled' => $this->pendingWatermarkEnabled,
                ]
            );

            if ($this->pendingWatermarkEnabled) {
                \App\Support\Media\WatermarkGenerator::generate($media);
            }
        } elseif ($this->pendingExistingCoverMediaId) {
            $attachService->attachExistingToModel(
                $this->record,
                $this->pendingExistingCoverMediaId,
                'cover',
                [
                    'title_override' => $this->record->title,
                    'watermark_enabled' => $this->pendingWatermarkEnabled,
                ]
            );

            if ($this->pendingWatermarkEnabled) {
                $media = \App\Models\Media::find($this->pendingExistingCoverMediaId);
                if ($media) {
                    \App\Support\Media\WatermarkGenerator::generate($media);
                }
            }
        }

        // VIDEO
        if (filled($this->pendingVideoUrl)) {
            $service->createEmbedForModel(
                $this->record,
                [
                    'media_kind' => 'embed',
                    'storage_type' => 'external',
                    'embed_provider' => $this->detectVideoProvider($this->pendingVideoUrl),
                    'embed_url' => $this->pendingVideoUrl,
                    'original_name' => Str::limit($this->record->title . ' video', 255, ''),
                    'is_active' => true,
                ],
                [
                    'usage_type' => 'video',
                    'sort_order' => 0,
                    'is_primary' => true,
                    'title_override' => $this->record->title,
                ]
            );
        } elseif ($this->pendingExistingVideoMediaId) {
            $attachService->attachExistingToModel(
                $this->record,
                $this->pendingExistingVideoMediaId,
                'video',
                [
                    'title_override' => $this->record->title,
                ]
            );
        }

        // GALLERY
        $sortOrder = 0;

        foreach ($this->pendingGalleryUploads as $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }

            $service->uploadForModel(
                $this->record,
                $file,
                [
                    'media_kind' => 'image',
                    'storage_type' => 'file',
                ],
                [
                    'usage_type' => 'gallery',
                    'sort_order' => $sortOrder,
                    'is_primary' => false,
                    'title_override' => $this->record->title,
                ]
            );

            $sortOrder++;
        }

        if (! empty($this->pendingExistingGalleryMediaIds)) {
            $existingAttachedIds = $this->record->media()
                ->wherePivot('usage_type', 'gallery')
                ->pluck('media.id')
                ->map(fn ($id) => (int) $id)
                ->all();

            foreach ($this->pendingExistingGalleryMediaIds as $mediaId) {
                if (in_array((int) $mediaId, $existingAttachedIds, true)) {
                    continue;
                }

                $attachService->attachExistingToModel(
                    $this->record,
                    (int) $mediaId,
                    'gallery',
                    [
                        'title_override' => $this->record->title,
                    ]
                );
            }
        }
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function detectVideoProvider(string $url): string
    {
        $value = mb_strtolower($url);

        return match (true) {
            str_contains($value, 'youtube.com'), str_contains($value, 'youtu.be') => 'youtube',
            str_contains($value, 'vimeo.com') => 'vimeo',
            default => 'external',
        };
    }
}
