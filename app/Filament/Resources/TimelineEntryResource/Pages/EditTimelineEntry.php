<?php

namespace App\Filament\Resources\TimelineEntryResource\Pages;

use App\Filament\Resources\TimelineEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTimelineEntry extends EditRecord
{
    protected static string $resource = TimelineEntryResource::class;

    public function getTitle(): string
    {
        return 'Timeline Kaydını Düzenle';
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $errors = TimelineEntryResource::timelineValidationErrors($data, $this->record->id);

        if (! empty($errors)) {
            \Filament\Notifications\Notification::make()
                ->title('Değişiklikler kaydedilemedi')
                ->body(implode(' ', array_values($errors)))
                ->danger()
                ->send();

            throw \Illuminate\Validation\ValidationException::withMessages($errors);
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}