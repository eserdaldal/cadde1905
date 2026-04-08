<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\WorldCup\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?string $navigationLabel = 'Ayarlar';
    protected static ?string $modelLabel = 'Ayar';
    protected static ?string $pluralModelLabel = 'Ayarlar';
    protected static ?int $navigationSort = 80;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function canViewAny(): bool
    {
        $user = Auth::user();

        return (bool) ($user?->isSuperAdmin() || $user?->isAdmin());
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(3)
                ->schema([
                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('Temel Ayarlar')
                                ->schema([
                                    Forms\Components\Select::make('tournament_id')
                                        ->label('Turnuva')
                                        ->relationship('worldCup', 'name')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name . ' ' . $record->year)
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->native(false),

                                    Forms\Components\Toggle::make('wc_module_enabled')
                                        ->label('Modül Aktif')
                                        ->default(true),

                                    Forms\Components\Toggle::make('home_teaser_enabled')
                                        ->label('Home Teaser')
                                        ->default(true),

                                    Forms\Components\Toggle::make('countdown_enabled')
                                        ->label('Countdown')
                                        ->default(true),

                                    Forms\Components\Toggle::make('show_featured_players')
                                        ->label('Featured Players')
                                        ->default(true),

                                    Forms\Components\Toggle::make('show_featured_matches')
                                        ->label('Featured Matches')
                                        ->default(true),

                                    Forms\Components\Toggle::make('show_featured_stadiums')
                                        ->label('Featured Stadiums')
                                        ->default(true),

                                    Forms\Components\Toggle::make('show_stat_cards')
                                        ->label('Stat Kartları')
                                        ->default(true),

                                    Forms\Components\Toggle::make('stale_data_notice_enabled')
                                        ->label('Stale Data Uyarısı')
                                        ->default(true),
                                ])
                                ->columns(2),
                        ])
                        ->columnSpan(2),

                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('İşlemler')
                                ->schema([
                                    Forms\Components\Actions::make([
                                        Forms\Components\Actions\Action::make('save_sidebar')
                                            ->label('Kaydet')
                                            ->icon('heroicon-m-check-circle')
                                            ->color('primary')
                                            ->action(fn ($livewire) => method_exists($livewire, 'save') ? $livewire->save() : $livewire->create())
                                            ->extraAttributes(['class' => 'w-full']),

                                        Forms\Components\Actions\Action::make('save_and_new_sidebar')
                                            ->label('Kaydet ve Yeni Ekle')
                                            ->icon('heroicon-m-plus-circle')
                                            ->color('success')
                                            ->action(fn ($livewire) => $livewire->createAnother())
                                            ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\SettingResource\Pages\CreateSetting)
                                            ->extraAttributes(['class' => 'w-full']),
                                    ])->fullWidth(),

                                    Forms\Components\Actions::make([
                                        Forms\Components\Actions\Action::make('cancel_sidebar')
                                            ->label('İptal')
                                            ->color('gray')
                                            ->url(fn () => static::getUrl('index')),

                                        Forms\Components\Actions\Action::make('delete_sidebar')
                                            ->label('Sil')
                                            ->icon('heroicon-m-trash')
                                            ->color('danger')
                                            ->requiresConfirmation()
                                            ->action(fn ($livewire) => $livewire->delete())
                                            ->visible(fn ($record) => filled($record)),
                                    ])->fullWidth(),
                                ])
                                ->compact()
                                ->extraAttributes(['class' => 'bg-gray-400/5 border-none shadow-none']),
                        ])
                        ->columnSpan(1),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('worldCup.name')->label('Turnuva')->placeholder('Genel'),
                Tables\Columns\IconColumn::make('wc_module_enabled')->label('Modül')->boolean(),
                Tables\Columns\IconColumn::make('home_teaser_enabled')->label('Teaser')->boolean(),
                Tables\Columns\IconColumn::make('countdown_enabled')->label('Countdown')->boolean(),
                Tables\Columns\IconColumn::make('show_featured_players')->label('Players')->boolean(),
                Tables\Columns\IconColumn::make('show_featured_matches')->label('Matches')->boolean(),
                Tables\Columns\IconColumn::make('show_featured_stadiums')->label('Stadiums')->boolean(),
                Tables\Columns\IconColumn::make('show_stat_cards')->label('Stats')->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('wc_module_enabled')->label('Modül'),
                Tables\Filters\SelectFilter::make('tournament_id')
                    ->label('Turnuva')
                    ->relationship('worldCup', 'year'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
