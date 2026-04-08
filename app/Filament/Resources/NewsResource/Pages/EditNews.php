<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use App\Models\News;
use App\Models\Media;
use App\Services\Media\MediaAttachService;
use App\Services\Media\MediaUploadService;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    public function getTitle(): string
    {
        return 'Haberi Düzenle';
    }

    protected ?UploadedFile $pendingCoverUpload = null;

    protected ?int $pendingExistingCoverMediaId = null;

    /** @var array<int, UploadedFile> */
    protected array $pendingGalleryUploads = [];

    /** @var array<int, int> */
    protected array $pendingExistingGalleryMediaIds = [];

    protected ?string $pendingVideoUrl = null;

    protected ?int $pendingExistingVideoMediaId = null;

    protected bool $pendingRemoveCover = false;

    protected bool $pendingRemoveVideo = false;

    protected bool $pendingRemoveGallery = false;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (auth()->user()?->role === 'editor') {
            unset($data['author_user_id']);
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

        $this->pendingRemoveCover = (bool) ($data['remove_cover'] ?? false);
        $this->pendingRemoveVideo = (bool) ($data['remove_video'] ?? false);
        $this->pendingRemoveGallery = (bool) ($data['remove_gallery'] ?? false);

        unset($data['cover_upload']);
        unset($data['existing_cover_media_id']);
        unset($data['gallery_upload']);
        unset($data['existing_gallery_media_ids']);
        unset($data['video_url']);
        unset($data['existing_video_media_id']);
        unset($data['remove_cover']);
        unset($data['remove_video']);
        unset($data['remove_gallery']);

        return $data;
    }

    protected function afterSave(): void
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
                ]
            );
        } elseif ($this->pendingRemoveCover) {
            $existingCoverIds = $this->record->media()
                ->wherePivot('usage_type', 'cover')
                ->pluck('media.id')
                ->all();

            if (! empty($existingCoverIds)) {
                $this->record->media()->detach($existingCoverIds);
            }

            Notification::make()
                ->title('Kapak bu haberden kaldırıldı.')
                ->success()
                ->send();
        } elseif ($this->pendingExistingCoverMediaId) {
            $attachService->attachExistingToModel(
                $this->record,
                $this->pendingExistingCoverMediaId,
                'cover',
                [
                    'title_override' => $this->record->title,
                ]
            );

            Notification::make()
                ->title('Kapak medya havuzundan seçildi.')
                ->success()
                ->send();
        }

        // VIDEO
        if (filled($this->pendingVideoUrl)) {
            $existingVideoIds = $this->record->media()
                ->wherePivot('usage_type', 'video')
                ->pluck('media.id')
                ->all();

            if (! empty($existingVideoIds)) {
                $this->record->media()->detach($existingVideoIds);
                $this->cleanupOrphanMedia($existingVideoIds);
            }

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
        } elseif ($this->pendingRemoveVideo) {
            $existingVideoIds = $this->record->media()
                ->wherePivot('usage_type', 'video')
                ->pluck('media.id')
                ->all();

            if (! empty($existingVideoIds)) {
                $this->record->media()->detach($existingVideoIds);
            }

            Notification::make()
                ->title('Video bu haberden kaldırıldı.')
                ->success()
                ->send();
        } elseif ($this->pendingExistingVideoMediaId) {
            $existingVideoIds = $this->record->media()
                ->wherePivot('usage_type', 'video')
                ->pluck('media.id')
                ->all();

            if (! empty($existingVideoIds)) {
                $this->record->media()->detach($existingVideoIds);
            }

            $attachService->attachExistingToModel(
                $this->record,
                $this->pendingExistingVideoMediaId,
                'video',
                [
                    'title_override' => $this->record->title,
                ]
            );

            Notification::make()
                ->title('Video medya havuzundan seçildi.')
                ->success()
                ->send();
        }

        // GALLERY
        if ($this->pendingRemoveGallery) {
            $existingGalleryIds = $this->record->media()
                ->wherePivot('usage_type', 'gallery')
                ->pluck('media.id')
                ->all();

            if (! empty($existingGalleryIds)) {
                $this->record->media()->detach($existingGalleryIds);
            }

            Notification::make()
                ->title('Galeri bu haberden kaldırıldı.')
                ->success()
                ->send();
        }

        $existingGalleryCount = $this->record->galleryMedia()->count();
        $sortOrder = $existingGalleryCount;

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

            Notification::make()
                ->title('Seçilen galeri görselleri eklendi.')
                ->success()
                ->send();
        }
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

        $this->record->media()->detach($media->id);

        Notification::make()
            ->title('Görsel galeriden çıkarıldı.')
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

        $this->record->media()->detach($media->id);

        $remainingUsageCount = DB::table('mediaables')
            ->where('media_id', $media->id)
            ->count();

        if ($remainingUsageCount === 0) {
            if ($media->disk && $media->path) {
                Storage::disk($media->disk)->delete($media->path);
            }

            $media->delete();

            Notification::make()
                ->title('Görsel galeriden çıkarıldı ve sistemden silindi.')
                ->success()
                ->send();

            return;
        }

        Notification::make()
            ->title('Görsel bu haberden çıkarıldı. Başka içeriklerde kullanıldığı için sistemden silinmedi.')
            ->warning()
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

        $this->record->media()->detach($media->id);

        Notification::make()
            ->title('Video bu haberden çıkarıldı.')
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

        $this->record->media()->detach($media->id);

        $remainingUsageCount = DB::table('mediaables')
            ->where('media_id', $media->id)
            ->count();

        if ($remainingUsageCount === 0) {
            if ($media->disk && $media->path) {
                Storage::disk($media->disk)->delete($media->path);
            }

            $media->delete();

            Notification::make()
                ->title('Video haberden çıkarıldı ve sistemden silindi.')
                ->success()
                ->send();

            return;
        }

        Notification::make()
            ->title('Video bu haberden çıkarıldı. Başka içeriklerde kullanıldığı için sistemden silinmedi.')
            ->warning()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function cleanupOrphanMedia(array $mediaIds): void
    {
        foreach ($mediaIds as $mediaId) {
            $media = Media::find($mediaId);

            if (! $media) {
                continue;
            }

            $remainingUsageCount = DB::table('mediaables')
                ->where('media_id', $media->id)
                ->count();

            if ($remainingUsageCount > 0) {
                continue;
            }

            if ($media->disk && $media->path) {
                Storage::disk($media->disk)->delete($media->path);
            }

            $media->delete();
        }
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
