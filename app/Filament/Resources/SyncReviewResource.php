<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SyncReviewResource\Pages;
use App\Models\WorldCup\WorldCupMatch;
use App\Models\WorldCup\StadiumAlias;
use App\Models\WorldCup\WorldCup;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SyncReviewResource extends Resource
{
    protected static ?string $model = WorldCupMatch::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?string $navigationLabel = 'Senkronizasyon İnceleme';
    protected static ?string $modelLabel = 'İnceleme';
    protected static ?string $pluralModelLabel = 'İncelemeler';
    protected static ?int $navigationSort = 35;

    public static function getEloquentQuery(): Builder
    {
        $activeId = WorldCup::activeTournament()?->id;

        return parent::getEloquentQuery()
            ->when($activeId, fn ($q) => $q->where('tournament_id', $activeId))
            ->with(['stadium', 'matchStadiumMap.stadium']);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('match_number')
                    ->label('Maç No')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kickoff_at')
                    ->label('Tarih')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('slot_number')
                    ->label('Slot No')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stage')
                    ->label('Aşama')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('stadium.name_api')
                    ->label('Kanonik Stat')
                    ->placeholder('Eksik'),
                Tables\Columns\TextColumn::make('venue_name_api')
                    ->label('API Stat Adı')
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('venue_city_api')
                    ->label('API Şehir')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->getStateUsing(function (WorldCupMatch $record): string {
                        $canonicalId = $record->stadium_id;
                        $apiVenueName = $record->venue_name_api;
                        $mapping = $record->matchStadiumMap;

                        if ($record->is_locked) {
                            return 'Kilitli';
                        }
                        if (! $canonicalId) {
                            return 'Eksik Veri';
                        }
                        if (! $mapping) {
                            return 'Eşleşme Bulunamadı';
                        }
                        if ($mapping->stadium_id !== $canonicalId) {
                            return 'İncelenecek';
                        }
                        if ($apiVenueName && $record->stadium?->name_api !== $apiVenueName) {
                            return 'Uyumsuz';
                        }

                        return 'Doğru';
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Doğru' => 'success',
                        'Uyumsuz' => 'danger',
                        'İncelenecek' => 'warning',
                        'Eksik Veri' => 'gray',
                        'Eşleşme Bulunamadı' => 'orange',
                        'Kilitli' => 'info',
                        default => 'gray',
                    }),

                Tables\Columns\IconColumn::make('is_locked')
                    ->label('Kilit')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_locked')->label('Kilitli Maçlar'),
                Tables\Filters\SelectFilter::make('stadium_id')
                    ->label('Stadyum')
                    ->relationship('stadium', 'name_api'),
            ])
            ->actions([
                Action::make('apply_canonical')
                    ->label('Kanonik Uygula')
                    ->icon('heroicon-m-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (WorldCupMatch $record) => ! $record->is_locked && $record->matchStadiumMap)
                    ->action(function (WorldCupMatch $record) {
                        $mapping = $record->matchStadiumMap;

                        if ($mapping) {
                            $record->update(['stadium_id' => $mapping->stadium_id]);
                        }
                    }),

                Action::make('accept_api')
                    ->label('API Kabul Et')
                    ->icon('heroicon-m-arrow-path')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->visible(fn (WorldCupMatch $record) => ! $record->is_locked && $record->venue_name_api)
                    ->action(function (WorldCupMatch $record) {
                        $alias = StadiumAlias::where('alias_name', $record->venue_name_api)->first();

                        if ($alias) {
                            $record->update(['stadium_id' => $alias->stadium_id]);
                        } else {
                            \Filament\Notifications\Notification::make()
                                ->title('Eşleşme bulunamadı')
                                ->danger()
                                ->send();
                        }
                    }),

                Action::make('toggle_lock')
                    ->label(fn (WorldCupMatch $record) => $record->is_locked ? 'Kilidi Aç' : 'Kilitle')
                    ->icon(fn (WorldCupMatch $record) => $record->is_locked ? 'heroicon-m-lock-open' : 'heroicon-m-lock-closed')
                    ->color(fn (WorldCupMatch $record) => $record->is_locked ? 'gray' : 'info')
                    ->action(fn (WorldCupMatch $record) => $record->update(['is_locked' => ! $record->is_locked])),

                Tables\Actions\EditAction::make()->label('Düzenle'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSyncReviews::route('/'),
        ];
    }
}
