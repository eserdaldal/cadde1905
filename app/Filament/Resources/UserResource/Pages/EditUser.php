<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        $me = auth()->user();
        $record = $this->getRecord();

        $canDelete = $me instanceof User
            && $me->isSuperAdmin()
            && $record instanceof User
            && ! $record->isProtectedAccount()
            && $record->id !== $me->id;

        return [
            Actions\DeleteAction::make()->visible($canDelete),
        ];
    }
}