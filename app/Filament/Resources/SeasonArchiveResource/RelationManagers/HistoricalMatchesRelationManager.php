<?php

namespace App\Filament\Resources\SeasonArchiveResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class HistoricalMatchesRelationManager extends RelationManager
{
    protected static string $relationship = 'historicalMatches';

    protected static ?string $title = 'Historical Matches';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('match_date')
                    ->label('Match date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('opponent')
                    ->label('Opponent')
                    ->sortable(),

                Tables\Columns\TextColumn::make('competition')
                    ->label('Competition')
                    ->sortable(),

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
                    ->label('Attach Historical Match')
                    ->recordTitle(fn ($record) => $record->title)
                    ->recordSelectSearchColumns(['title', 'slug', 'opponent', 'competition'])
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
                Tables\Actions\Action::make('editRelation')
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
                            ->historicalMatches()
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
