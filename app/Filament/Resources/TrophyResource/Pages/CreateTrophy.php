<?php

namespace App\Filament\Resources\TrophyResource\Pages;

use App\Filament\Resources\TrophyResource;
use App\Services\Media\MediaAttachService;
use App\Services\Media\MediaUploadService;
use App\Services\Media\MediaUsageService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class CreateTrophy extends CreateRecord
{
    protected static string $resource = TrophyResource::class;

    public function getTitle(): string
    {
        return 'Kupa Kaydı Oluştur';
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected $pendingCoverUpload = null;
    protected int|string|null $pendingExistingCoverMediaId = null;
    protected bool $pendingRemoveCover = false;
    protected string $pendingContent = '';
    protected ?string $pendingVideoUrl = null;
    protected ?int $pendingExistingVideoMediaId = null;
    protected bool $pendingRemoveVideo = false;
    /** @var array<int, UploadedFile> */
    protected array $pendingGalleryUploads = [];
    /** @var array<int, int> */
    protected array $pendingExistingGalleryMediaIds = [];
    protected bool $pendingRemoveGallery = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->pendingCoverUpload = $data['cover_upload'] ?? null;
        if (is_array($this->pendingCoverUpload)) {
            $this->pendingCoverUpload = reset($this->pendingCoverUpload);
        }
        $this->pendingExistingCoverMediaId = $data['existing_cover_media_id'] ?? null;
        $this->pendingRemoveCover = (bool) ($data['remove_cover'] ?? false);
        $this->pendingContent = $data['content'] ?? '';
        $this->pendingVideoUrl = filled($data['video_url'] ?? null)
            ? trim((string) $data['video_url'])
            : null;
        $this->pendingExistingVideoMediaId = filled($data['existing_video_media_id'] ?? null)
            ? (int) $data['existing_video_media_id']
            : null;
        $this->pendingRemoveVideo = (bool) ($data['remove_video'] ?? false);
        $this->pendingGalleryUploads = array_values(array_filter(
            $data['gallery_uploads'] ?? [],
            fn ($file) => $file instanceof UploadedFile
        ));
        $this->pendingExistingGalleryMediaIds = array_values(array_map(
            'intval',
            array_filter($data['existing_gallery_media_ids'] ?? [], fn ($id) => filled($id))
        ));
        $this->pendingRemoveGallery = (bool) ($data['remove_gallery'] ?? false);

        unset(
            $data['cover_upload'],
            $data['existing_cover_media_id'],
            $data['remove_cover'],
            $data['video_url'],
            $data['existing_video_media_id'],
            $data['remove_video'],
            $data['gallery_uploads'],
            $data['existing_gallery_media_ids'],
            $data['remove_gallery'],
        );

        return $data;
    }

    protected function afterCreate(): void
    {
        /** @var MediaUploadService $uploadService */
        $uploadService = app(MediaUploadService::class);

        /** @var MediaAttachService $attachService */
        $attachService = app(MediaAttachService::class);

        /** @var MediaUsageService $usageService */
        $usageService = app(MediaUsageService::class);

        if ($this->pendingRemoveCover) {
            $this->record->removeCover();
        } elseif ($this->pendingCoverUpload) {
            $this->record->replaceCoverFromUpload($this->pendingCoverUpload);
        } elseif ($this->pendingExistingCoverMediaId) {
            $this->record->replaceCoverFromExistingMedia($this->pendingExistingCoverMediaId);
        }

        // VIDEO
        if ($this->pendingRemoveVideo) {
            $existingVideoIds = $this->record->media()
                ->wherePivot('usage_type', 'video')
                ->pluck('media.id')
                ->all();
            foreach ($existingVideoIds as $id) {
                $usageService->detachFromModel($this->record, (int) $id);
            }
        } elseif (filled($this->pendingVideoUrl)) {
            $uploadService->createEmbedForModel(
                $this->record,
                [
                    'media_kind' => 'embed',
                    'storage_type' => 'external',
                    'embed_provider' => $this->detectVideoProvider($this->pendingVideoUrl),
                    'embed_url' => $this->pendingVideoUrl,
                    'original_name' => Str::limit($this->record->name . ' video', 255, ''),
                    'is_active' => true,
                ],
                [
                    'usage_type' => 'video',
                    'sort_order' => 0,
                    'is_primary' => true,
                    'title_override' => $this->record->name,
                ]
            );
        } elseif ($this->pendingExistingVideoMediaId) {
            $attachService->attachExistingToModel(
                $this->record,
                $this->pendingExistingVideoMediaId,
                'video',
                [
                    'title_override' => $this->record->name,
                ]
            );
        }

        // GALLERY
        if ($this->pendingRemoveGallery) {
            $existingGalleryIds = $this->record->media()
                ->wherePivot('usage_type', 'gallery')
                ->pluck('media.id')
                ->all();
            foreach ($existingGalleryIds as $id) {
                $usageService->detachFromModel($this->record, (int) $id);
            }
        } else {
            if (! empty($this->pendingGalleryUploads)) {
                $nextSortOrder = (($this->record->galleryMedia()->max('mediaables.sort_order')) ?? -1) + 1;
                $uploadService->uploadManyForModel(
                    $this->record,
                    $this->pendingGalleryUploads,
                    [
                        'media_kind' => 'image',
                        'storage_type' => 'file',
                    ],
                    [
                        'usage_type' => 'gallery',
                        'sort_order' => $nextSortOrder,
                        'is_primary' => false,
                        'title_override' => $this->record->name,
                    ]
                );
            }

            if (! empty($this->pendingExistingGalleryMediaIds)) {
                $attachService->attachExistingManyToModel(
                    $this->record,
                    $this->pendingExistingGalleryMediaIds,
                    'gallery',
                    [
                        'title_override' => $this->record->name,
                    ]
                );
            }
        }

        $this->attachContentMedia();
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

    protected function attachContentMedia(): void
    {
        preg_match_all('/src="([^"]+)"/', $this->pendingContent, $matches);
        $paths = [];

        foreach ($matches[1] ?? [] as $url) {
            if (! str_contains($url, '/storage/')) {
                continue;
            }

            $path = ltrim((string) parse_url($url, PHP_URL_PATH), '/');
            $path = str_replace('storage/', '', $path);

            if (blank($path)) {
                continue;
            }

            $paths[] = $path;
        }

        $this->record->syncContentMedia($paths);
    }
}
