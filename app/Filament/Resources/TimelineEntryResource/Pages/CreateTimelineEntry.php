<?php

namespace App\Filament\Resources\TimelineEntryResource\Pages;

use App\Filament\Resources\TimelineEntryResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateTimelineEntry extends CreateRecord
{
    protected static string $resource = TimelineEntryResource::class;

    public function getTitle(): string
    {
        return 'Zaman Çizelgesi Kaydı Oluştur';
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $errors = TimelineEntryResource::timelineValidationErrors($data);

        if (! empty($errors)) {
            Notification::make()
                ->title('Kayıt oluşturulamadı')
                ->body(implode(' ', array_values($errors)))
                ->danger()
                ->send();

            throw ValidationException::withMessages($errors);
        }

        return $data;
    }
}