<?php

namespace App\Filament\Resources\HistoryEventResource\Pages;

use App\Filament\Resources\HistoryEventResource;
use App\Models\Media;
use App\Services\Media\MediaAttachService;
use App\Services\Media\MediaUploadService;
use App\Services\Media\MediaUsageService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class EditHistoryEvent extends EditRecord
{
    protected static string $resource = HistoryEventResource::class;

    public function getTitle(): string
    {
        return 'Olayı Düzenle';
    }

    protected ?UploadedFile $pendingCoverUpload = null;

    /** @var array<int, UploadedFile> */
    protected array $pendingGalleryUploads = [];

    protected ?string $pendingVideoUrl = null;

    protected ?int $pendingExistingCoverMediaId = null;

    /** @var array<int, int> */
    protected array $pendingExistingGalleryMediaIds = [];

    protected ?int $pendingExistingVideoMediaId = null;
    protected bool $pendingRemoveCover = false;
    protected bool $pendingRemoveGallery = false;
    protected bool $pendingRemoveVideo = false;
    protected string $pendingContent = '';
 
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->pendingContent = $data['content'] ?? '';
        $this->pendingCoverUpload = $data['cover_upload'] ?? null;
        if (is_array($this->pendingCoverUpload)) {
            $this->pendingCoverUpload = reset($this->pendingCoverUpload);
        }

        $this->pendingGalleryUploads = array_values(array_filter(
            $data['gallery_uploads'] ?? [],
            fn ($file) => $file instanceof UploadedFile
        ));

        $this->pendingVideoUrl = filled($data['video_url'] ?? null)
            ? trim((string) $data['video_url'])
            : null;

        $this->pendingExistingCoverMediaId = filled($data['existing_cover_media_id'] ?? null)
            ? (int) $data['existing_cover_media_id']
            : null;

        $this->pendingExistingGalleryMediaIds = array_values(array_map(
            'intval',
            array_filter($data['existing_gallery_media_ids'] ?? [], fn ($id) => filled($id))
        ));

        $this->pendingExistingVideoMediaId = filled($data['existing_video_media_id'] ?? null)
            ? (int) $data['existing_video_media_id']
            : null;

        $this->pendingRemoveCover = (bool) ($data['remove_cover'] ?? false);
        $this->pendingRemoveGallery = (bool) ($data['remove_gallery'] ?? false);
        $this->pendingRemoveVideo = (bool) ($data['remove_video'] ?? false);

        unset(
            $data['cover_upload'],
            $data['gallery_uploads'],
            $data['video_url'],
            $data['existing_cover_media_id'],
            $data['existing_gallery_media_ids'],
            $data['existing_video_media_id'],
            $data['remove_cover'],
            $data['remove_gallery'],
            $data['remove_video'],
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

        // --- COVER ---
        if ($this->pendingRemoveCover) {
            $existingCoverIds = $this->record->media()->wherePivot('usage_type', 'cover')->pluck('media.id')->all();
            foreach ($existingCoverIds as $id) { $usageService->detachFromModel($this->record, (int) $id); }
        } elseif ($this->pendingCoverUpload instanceof UploadedFile) {
            $uploadService->replacePrimaryForModel($this->record, $this->pendingCoverUpload, 'cover', ['media_kind' => 'image', 'storage_type' => 'file'], ['title_override' => $this->record->title]);
        } elseif ($this->pendingExistingCoverMediaId) {
            $attachService->attachExistingToModel($this->record, $this->pendingExistingCoverMediaId, 'cover', ['title_override' => $this->record->title]);
        }

        // --- VIDEO ---
        if ($this->pendingRemoveVideo) {
            $existingVideoIds = $this->record->media()->wherePivot('usage_type', 'video')->pluck('media.id')->all();
            foreach ($existingVideoIds as $id) { $usageService->detachFromModel($this->record, (int) $id); }
        } elseif (filled($this->pendingVideoUrl)) {
            $existingVideoIds = $this->record->media()->wherePivot('usage_type', 'video')->pluck('media.id')->all();
            foreach ($existingVideoIds as $id) { $usageService->detachFromModel($this->record, (int) $id); }
            $uploadService->createEmbedForModel($this->record, ['media_kind' => 'embed', 'storage_type' => 'external', 'embed_provider' => $this->detectVideoProvider($this->pendingVideoUrl), 'embed_url' => $this->pendingVideoUrl, 'original_name' => Str::limit($this->record->title . ' video', 255, ''), 'is_active' => true], ['usage_type' => 'video', 'sort_order' => 0, 'is_primary' => true, 'title_override' => $this->record->title]);
        } elseif ($this->pendingExistingVideoMediaId) {
            $existingVideoIds = $this->record->media()->wherePivot('usage_type', 'video')->pluck('media.id')->all();
            foreach ($existingVideoIds as $id) { if ((int)$id !== (int)$this->pendingExistingVideoMediaId) $usageService->detachFromModel($this->record, (int) $id); }
            $attachService->attachExistingToModel($this->record, $this->pendingExistingVideoMediaId, 'video', ['title_override' => $this->record->title]);
        }

        // --- GALLERY ---
        if ($this->pendingRemoveGallery) {
            $existingGalleryIds = $this->record->media()->wherePivot('usage_type', 'gallery')->pluck('media.id')->all();
            foreach ($existingGalleryIds as $id) { $usageService->detachFromModel($this->record, (int) $id); }
        } else {
            if (! empty($this->pendingGalleryUploads)) {
                $sortOrder = $this->record->galleryMedia()->count();
                foreach ($this->pendingGalleryUploads as $file) {
                    if ($file instanceof UploadedFile) {
                        $uploadService->uploadForModel($this->record, $file, ['media_kind' => 'image', 'storage_type' => 'file'], ['usage_type' => 'gallery', 'sort_order' => $sortOrder, 'is_primary' => false, 'title_override' => $this->record->title]);
                        $sortOrder++;
                    }
                }
            }
            if (! empty($this->pendingExistingGalleryMediaIds)) {
                $attachService->attachExistingManyToModel($this->record, $this->pendingExistingGalleryMediaIds, 'gallery', ['title_override' => $this->record->title]);
            }
        }

        $this->attachContentMedia();
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

    public function deleteMedia(int $mediaId): void
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

        // Stabilize: Only detach as requested for edit flow
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

    public function deleteVideo(int $mediaId): void
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

        // Stabilize: Only detach as requested for edit flow
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
 
    protected function getFormActions(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}