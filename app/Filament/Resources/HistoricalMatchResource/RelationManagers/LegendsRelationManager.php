<?php

namespace App\Filament\Resources\HistoricalMatchResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;

class LegendsRelationManager extends RelationManager
{
    protected static string $relationship = 'legends';

    protected static ?string $title = 'Legends';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->toggleable(),

                Tables\Columns\IconColumn::make('pivot.is_primary')
                    ->label('Primary')
                    ->boolean(),

                Tables\Columns\TextColumn::make('pivot.relation_type')
                    ->label('Relation type')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('pivot.sort_order')
                    ->label('Sort')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('pivot.notes')
                    ->label('Notes')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Attach Legend')
                    ->recordTitle(fn ($record) => $record->name)
                    ->recordSelectSearchColumns(['name', 'title', 'slug'])
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\Toggle::make('is_primary')
                            ->label('Primary')
                            ->default(false),
                        Forms\Components\TextInput::make('relation_type')
                            ->label('Relation type')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->rows(3),
                    ]),
            ])
            ->actions([
                Action::make('editRelation')
                    ->label('Edit relation')
                    ->icon('heroicon-o-pencil-square')
                    ->fillForm(fn ($record): array => [
                        'is_primary' => (bool) ($record->pivot->is_primary ?? false),
                        'relation_type' => $record->pivot->relation_type,
                        'sort_order' => $record->pivot->sort_order,
                        'notes' => $record->pivot->notes,
                    ])
                    ->form([
                        Forms\Components\Toggle::make('is_primary')
                            ->label('Primary'),
                        Forms\Components\TextInput::make('relation_type')
                            ->label('Relation type')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->rows(3),
                    ])
                    ->action(function ($record, array $data): void {
                        $this->getOwnerRecord()
                            ->legends()
                            ->updateExistingPivot($record->getKey(), [
                                'is_primary' => (bool) ($data['is_primary'] ?? false),
                                'relation_type' => $data['relation_type'] ?: null,
                                'sort_order' => (int) ($data['sort_order'] ?? 0),
                                'notes' => $data['notes'] ?: null,
                            ]);
                    }),

                Tables\Actions\DetachAction::make()
                    ->label('Detach'),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make()
                    ->label('Detach selected'),
            ]);
    }
}