<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StadiumResource\Pages;
use App\Models\WorldCup\Stadium;
use App\Models\WorldCup\WorldCup;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Database\Eloquent\Builder;

class StadiumResource extends Resource
{
    protected static ?string $model = Stadium::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?string $navigationLabel = 'Stadyumlar';
    protected static ?string $modelLabel = 'Stadyum';
    protected static ?string $pluralModelLabel = 'Stadyumlar';
    protected static ?int $navigationSort = 50;

    public static function canViewAny(): bool
    {
        $user = Auth::user();
        return (bool) ($user?->isSuperAdmin() || $user?->isAdmin());
    }

    public static function getEloquentQuery(): Builder
    {
        $activeId = WorldCup::activeTournament()?->id;

        return parent::getEloquentQuery()
            ->when($activeId, fn ($q) => $q->where('tournament_id', $activeId));
    }

    public static function form(Form $form): Form
    {
        $activeId = WorldCup::activeTournament()?->id;

        return $form->schema([
            Forms\Components\Grid::make(3)
                ->schema([
                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('Temel Bilgiler')
                                ->schema([
                                    Forms\Components\Select::make('tournament_id')
                                        ->label('Turnuva')
                                        ->relationship('worldCup', 'name')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name . ' ' . $record->year)
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->default($activeId)
                                        ->columnSpan(2),

                                    Forms\Components\TextInput::make('name_api')
                                        ->label('Stat Adı (API)')
                                        ->required()
                                        ->maxLength(255),

                                    Forms\Components\TextInput::make('name_override')
                                        ->label('Stat Adı (Override)')
                                        ->maxLength(255),

                                    Forms\Components\TextInput::make('city_api')
                                        ->label('Şehir')
                                        ->maxLength(255),

                                    Forms\Components\TextInput::make('country_api')
                                        ->label('Ülke')
                                        ->maxLength(255),

                                    Forms\Components\TextInput::make('address')
                                        ->label('Adres')
                                        ->columnSpan(2)
                                        ->maxLength(500),

                                    Forms\Components\TextInput::make('capacity')
                                        ->label('Kapasite (API)')
                                        ->numeric(),

                                    Forms\Components\TextInput::make('capacity_override')
                                        ->label('Kapasite (Override)')
                                        ->numeric(),

                                    Forms\Components\TextInput::make('opened_year')
                                        ->label('Açılış Yılı')
                                        ->numeric(),

                                    Forms\Components\TextInput::make('surface_type')
                                        ->label('Zemin Tipi'),

                                    Forms\Components\TextInput::make('latitude')
                                        ->label('Enlem')
                                        ->numeric(),

                                    Forms\Components\TextInput::make('longitude')
                                        ->label('Boylam')
                                        ->numeric(),
                                ])
                                ->columns(2),

                            Forms\Components\Section::make('İçerik ve Medya')
                                ->schema([
                                    Forms\Components\RichEditor::make('description')
                                        ->label('Açıklama')
                                        ->columnSpanFull(),

                                    Forms\Components\FileUpload::make('hero_image')
                                        ->label('Kapak')
                                        ->directory('stadiums/hero')
                                        ->image(),

                                    Forms\Components\FileUpload::make('seating_plan_image')
                                        ->label('Oturma Planı')
                                        ->directory('stadiums/seating')
                                        ->image(),

                                    Forms\Components\FileUpload::make('gallery')
                                        ->label('Galeri')
                                        ->directory('stadiums/gallery')
                                        ->image()
                                        ->multiple()
                                        ->reorderable()
                                        ->appendFiles()
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),

                            Forms\Components\Section::make('SEO')
                                ->schema([
                                    Forms\Components\TextInput::make('meta_title')
                                        ->label('SEO Başlığı'),

                                    Forms\Components\Textarea::make('meta_description')
                                        ->label('SEO Açıklaması'),
                                ]),
                        ])
                        ->columnSpan(2),

                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('Durum')
                                ->schema([
                                    Forms\Components\Toggle::make('is_visible')
                                        ->label('Görünür')
                                        ->default(true),

                                    Forms\Components\Toggle::make('is_featured')
                                        ->label('Öne Çıkan')
                                        ->default(false),

                                    Forms\Components\TextInput::make('slug')
                                        ->label('Slug')
                                        ->unique(ignoreRecord: true),
                                ]),

                            Forms\Components\Section::make('İşlemler')
                                ->schema([
                                    Forms\Components\Actions::make([
                                        Forms\Components\Actions\Action::make('save')
                                            ->label('Kaydet')
                                            ->color('primary')
                                            ->action(fn ($livewire) => method_exists($livewire, 'save') ? $livewire->save() : $livewire->create())
                                            ->extraAttributes(['class' => 'w-full']),
                                    ]),
                                ])
                                ->compact(),
                        ])
                        ->columnSpan(1),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_override')
                    ->label('Ad')
                    ->formatStateUsing(fn (?string $state, Stadium $record) => $state ?: $record->name_api)
                    ->searchable(),

                Tables\Columns\TextColumn::make('city_api')->label('Şehir'),

                Tables\Columns\TextColumn::make('display_capacity')
                    ->label('Kapasite')
                    ->suffix(' kişi'),

                Tables\Columns\TextColumn::make('aliases_count')
                    ->label('Alias')
                    ->counts('aliases'),

                Tables\Columns\IconColumn::make('is_featured')->label('Öne Çıkan')->boolean(),
                Tables\Columns\IconColumn::make('is_visible')->label('Görünür')->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')->label('Görünür'),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Öne Çıkan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('name_api');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStadiums::route('/'),
            'create' => Pages\CreateStadium::route('/create'),
            'edit' => Pages\EditStadium::route('/{record}/edit'),
        ];
    }
}
