<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SyncLogResource\Pages;
use App\Models\WorldCup\SyncLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class SyncLogResource extends Resource
{
    protected static ?string $model = SyncLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?string $navigationLabel = 'Sync Log';
    protected static ?string $modelLabel = 'Sync Log';
    protected static ?string $pluralModelLabel = 'Sync Log';
    protected static ?int $navigationSort = 100;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function canViewAny(): bool
    {
        $user = Auth::user();

        return (bool) ($user?->isSuperAdmin() || $user?->isAdmin());
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\Section::make('Sync Bilgisi')
                        ->schema([
                            Forms\Components\Select::make('tournament_id')
                                ->label('Turnuva')
                                ->relationship('worldCup', 'name')
                                ->getOptionLabelFromRecordUsing(fn ($record) => $record->name . ' ' . $record->year)
                                ->searchable()
                                ->preload()
                                ->nullable()
                                ->disabled(),

                            Forms\Components\TextInput::make('dataset')
                                ->label('Dataset')
                                ->disabled(),

                            Forms\Components\TextInput::make('source')
                                ->label('Source')
                                ->disabled(),

                            Forms\Components\TextInput::make('status')
                                ->label('Status')
                                ->disabled(),

                            Forms\Components\TextInput::make('batch_uuid')
                                ->label('Batch UUID')
                                ->disabled(),

                            Forms\Components\DateTimePicker::make('started_at')
                                ->label('Başlangıç')
                                ->disabled(),

                            Forms\Components\DateTimePicker::make('finished_at')
                                ->label('Bitiş')
                                ->disabled(),
                        ])
                        ->columns(2),

                    Forms\Components\Section::make('Sayaçlar')
                        ->schema([
                            Forms\Components\TextInput::make('records_processed')
                                ->label('İşlenen')
                                ->disabled(),

                            Forms\Components\TextInput::make('records_skipped')
                                ->label('Atlanan')
                                ->disabled(),

                            Forms\Components\TextInput::make('warnings_count')
                                ->label('Uyarılar')
                                ->disabled(),

                            Forms\Components\TextInput::make('errors_count')
                                ->label('Hatalar')
                                ->disabled(),
                        ])
                        ->columns(2),

                    Forms\Components\Section::make('Hata Özeti')
                        ->schema([
                            Forms\Components\Textarea::make('error_summary')
                                ->label('Özet')
                                ->rows(4)
                                ->disabled(),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('worldCup.year')->label('Yıl')->sortable()->placeholder('—'),
                Tables\Columns\TextColumn::make('dataset')->label('Dataset')->searchable(),
                Tables\Columns\TextColumn::make('status')->label('Durum')->sortable(),
                Tables\Columns\TextColumn::make('records_processed')->label('İşlenen')->sortable(),
                Tables\Columns\TextColumn::make('errors_count')->label('Hata')->sortable(),
                Tables\Columns\TextColumn::make('started_at')->label('Başlangıç')->dateTime(),
                Tables\Columns\TextColumn::make('finished_at')->label('Bitiş')->dateTime()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('batch_uuid')->label('Batch')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tournament_id')
                    ->label('Turnuva')
                    ->relationship('worldCup', 'year'),
                Tables\Filters\SelectFilter::make('dataset')
                    ->label('Dataset')
                    ->options(fn () => SyncLog::query()->pluck('dataset', 'dataset')->unique()->all()),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Durum')
                    ->options(fn () => SyncLog::query()->pluck('status', 'status')->unique()->all()),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([])
            ->defaultSort('started_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSyncLogs::route('/'),
            'view' => Pages\ViewSyncLog::route('/{record}'),
        ];
    }
}
