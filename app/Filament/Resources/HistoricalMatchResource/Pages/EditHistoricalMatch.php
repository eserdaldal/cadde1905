<?php

namespace App\Filament\Resources\HistoricalMatchResource\Pages;

use App\Filament\Resources\HistoricalMatchResource;
use App\Models\Media;
use App\Services\Media\MediaAttachService;
use App\Services\Media\MediaUploadService;
use App\Services\Media\MediaUsageService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class EditHistoricalMatch extends EditRecord
{
    protected static string $resource = HistoricalMatchResource::class;

    public function getTitle(): string
    {
        return 'Maçı Düzenle';
    }

    protected $pendingCoverUpload = null;
    protected string $pendingContent = '';
    protected ?int $pendingExistingCoverMediaId = null;
    protected bool $pendingRemoveCover = false;
    protected ?string $pendingVideoUrl = null;
    protected ?int $pendingExistingVideoMediaId = null;
    protected bool $pendingRemoveVideo = false;
    /** @var array<int, UploadedFile> */
    protected array $pendingGalleryUploads = [];
    /** @var array<int, int> */
    protected array $pendingExistingGalleryMediaIds = [];
    protected bool $pendingRemoveGallery = false;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->pendingCoverUpload = $data['cover_upload'] ?? null;
        if (is_array($this->pendingCoverUpload)) {
            $this->pendingCoverUpload = reset($this->pendingCoverUpload);
        }
        $this->pendingRemoveCover = (bool) ($data['remove_cover'] ?? false);
        $this->pendingContent = $data['content'] ?? '';
        $this->pendingExistingCoverMediaId = filled($data['existing_cover_media_id'] ?? null)
            ? (int) $data['existing_cover_media_id']
            : null;
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

    protected function afterSave(): void
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
            $existingVideoIds = $this->record->media()
                ->wherePivot('usage_type', 'video')
                ->pluck('media.id')
                ->all();
            foreach ($existingVideoIds as $id) {
                $usageService->detachFromModel($this->record, (int) $id);
            }
            $uploadService->createEmbedForModel(
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
            $existingVideoIds = $this->record->media()
                ->wherePivot('usage_type', 'video')
                ->pluck('media.id')
                ->all();
            foreach ($existingVideoIds as $id) {
                if ((int) $id !== (int) $this->pendingExistingVideoMediaId) {
                    $usageService->detachFromModel($this->record, (int) $id);
                }
            }
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
                $sortOrder = (($this->record->galleryMedia()->max('mediaables.sort_order')) ?? -1) + 1;
                foreach ($this->pendingGalleryUploads as $file) {
                    if ($file instanceof UploadedFile) {
                        $uploadService->uploadForModel(
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
                }
            }
            if (! empty($this->pendingExistingGalleryMediaIds)) {
                $attachService->attachExistingManyToModel(
                    $this->record,
                    $this->pendingExistingGalleryMediaIds,
                    'gallery',
                    [
                        'title_override' => $this->record->title,
                    ]
                );
            }
        }

        $this->attachContentMedia();
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

    public function removeFromGallery(int $mediaId): void
    {
        $media = Media::find($mediaId);

        if (! $media) {
            Notification::make()
                ->title('Medya bulunamadı.')
                ->danger()
                ->send();

            return;
        }

        /** @var MediaUsageService $usageService */
        $usageService = app(MediaUsageService::class);

        $detached = $usageService->detachFromModel($this->record, $media->id);

        if (! $detached) {
            Notification::make()
                ->title('Bu görsel bu içerikte bağlı bulunamadı.')
                ->warning()
                ->send();

            return;
        }

        Notification::make()
            ->title('Görsel bu içerikten çıkarıldı.')
            ->success()
            ->send();
    }

    public function removeVideo(int $mediaId): void
    {
        $media = Media::find($mediaId);

        if (! $media) {
            Notification::make()
                ->title('Video bulunamadı.')
                ->danger()
                ->send();

            return;
        }

        /** @var MediaUsageService $usageService */
        $usageService = app(MediaUsageService::class);

        $detached = $usageService->detachFromModel($this->record, $media->id);

        if (! $detached) {
            Notification::make()
                ->title('Bu video bu içerikte bağlı bulunamadı.')
                ->warning()
                ->send();

            return;
        }

        Notification::make()
            ->title('Video bu içerikten çıkarıldı.')
            ->success()
            ->send();
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

    protected function getFormActions(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
