<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorldCupResource\Pages;
use App\Models\WorldCup\WorldCup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Support\Facades\Auth;

class WorldCupResource extends Resource
{
    protected static ?string $model = WorldCup::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?string $navigationLabel = 'Turnuvalar';
    protected static ?string $modelLabel = 'Turnuva';
    protected static ?string $pluralModelLabel = 'Turnuvalar';
    protected static ?int $navigationSort = 10;

    public static function shouldRegisterNavigation(): bool
    {
        $user = Auth::user();

        return (bool) ($user?->isSuperAdmin() || $user?->isAdmin());
    }

    public static function canViewAny(): bool
    {
        $user = Auth::user();

        return (bool) ($user?->isSuperAdmin() || $user?->isAdmin());
    }

    public static function canCreate(): bool
    {
        $user = Auth::user();

        return (bool) ($user?->isSuperAdmin() || $user?->isAdmin());
    }

    public static function canEdit($record): bool
    {
        $user = Auth::user();

        return (bool) ($user?->isSuperAdmin() || $user?->isAdmin());
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(3)
                ->schema([
                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('Turnuva Bilgileri')
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->label('Ad')
                                        ->required()
                                        ->maxLength(255),

                                    Forms\Components\TextInput::make('slug')
                                        ->label('Slug')
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->maxLength(255),

                                    Forms\Components\TextInput::make('year')
                                        ->label('Yıl')
                                        ->numeric()
                                        ->minValue(1900)
                                        ->maxValue(2100)
                                        ->required(),

                                    Forms\Components\Select::make('status')
                                        ->label('Durum')
                                        ->options([
                                            'upcoming' => 'Yaklaşan',
                                            'active' => 'Aktif',
                                            'completed' => 'Tamamlandı',
                                        ])
                                        ->nullable()
                                        ->native(false),

                                    Forms\Components\TextInput::make('host_country')
                                        ->label('Ev Sahibi Ülke(ler)')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\DateTimePicker::make('starts_at')
                                        ->label('Başlangıç')
                                        ->nullable(),

                                    Forms\Components\DateTimePicker::make('ends_at')
                                        ->label('Bitiş')
                                        ->nullable(),
                                ])
                                ->columns(2),

                            Forms\Components\Section::make('Durum')
                                ->schema([
                                    Forms\Components\Toggle::make('is_active')
                                        ->label('Aktif')
                                        ->default(false),

                                    Forms\Components\Toggle::make('is_visible')
                                        ->label('Görünür')
                                        ->default(true),
                                ])
                                ->columns(2),

                            Forms\Components\Section::make('Hero')
                                ->schema([
                                    Forms\Components\TextInput::make('hero_title')
                                        ->label('Hero Başlığı')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('hero_subtitle')
                                        ->label('Hero Alt Başlık')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('hero_image')
                                        ->label('Hero Görsel URL')
                                        ->maxLength(255)
                                        ->nullable(),
                                ]),

                            Forms\Components\Section::make('SEO')
                                ->schema([
                                    Forms\Components\TextInput::make('seo_title')
                                        ->label('SEO Başlığı')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\Textarea::make('seo_description')
                                        ->label('SEO Açıklaması')
                                        ->rows(3)
                                        ->maxLength(1000)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('og_image')
                                        ->label('OG Görsel URL')
                                        ->maxLength(255)
                                        ->nullable(),
                                ]),
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
                                            ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\WorldCupResource\Pages\CreateWorldCup)
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
                Tables\Columns\TextColumn::make('name')->label('Ad')->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('Slug')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('year')->label('Yıl')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status')->label('Durum')->placeholder('—')->toggleable(),
                Tables\Columns\TextColumn::make('host_country')->label('Ev Sahibi')->placeholder('—')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean(),
                Tables\Columns\IconColumn::make('is_visible')->label('Görünür')->boolean()->trueColor('success')->falseColor('gray'),
                Tables\Columns\TextColumn::make('updated_at')->label('Güncelleme')->dateTime()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')->label('Aktif'),
                TernaryFilter::make('is_visible')->label('Görünür'),
                SelectFilter::make('status')
                    ->label('Durum')
                    ->options([
                        'upcoming' => 'Yaklaşan',
                        'active' => 'Aktif',
                        'completed' => 'Tamamlandı',
                    ]),
                SelectFilter::make('year')
                    ->label('Yıl')
                    ->options(fn () => WorldCup::query()->orderByDesc('year')->pluck('year', 'year')->all()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([])
            ->defaultSort('year', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorldCups::route('/'),
            'create' => Pages\CreateWorldCup::route('/create'),
            'edit' => Pages\EditWorldCup::route('/{record}/edit'),
        ];
    }
}
