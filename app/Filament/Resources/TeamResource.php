<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Models\WorldCup\Team;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Unique;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?string $navigationLabel = 'Takımlar';
    protected static ?string $modelLabel = 'Takım';
    protected static ?string $pluralModelLabel = 'Takımlar';
    protected static ?int $navigationSort = 20;

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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('tournament_id', 4);
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
                            Forms\Components\Section::make('İlişkiler')
                                ->schema([
                                    Forms\Components\Select::make('tournament_id')
                                        ->label('Turnuva')
                                        ->relationship('worldCup', 'name')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name . ' ' . $record->year)
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->native(false),

                                    Forms\Components\Select::make('group_id')
                                        ->label('Grup')
                                        ->relationship('group', 'code')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->code . ($record->name ? ' — ' . $record->name : ''))
                                        ->searchable()
                                        ->preload()
                                        ->nullable()
                                        ->native(false),
                                ])
                                ->columns(2),

                            Forms\Components\Section::make('Takım Bilgileri')
                                ->schema([
                                    Forms\Components\TextInput::make('name_api')
                                        ->label('Ad (API)')
                                        ->required()
                                        ->maxLength(255),

                                    Forms\Components\TextInput::make('name_override')
                                        ->label('Ad (Override)')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('short_name_api')
                                        ->label('Kısa Ad (API)')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('short_name_override')
                                        ->label('Kısa Ad (Override)')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('slug')
                                        ->label('Slug')
                                        ->required()
                                        ->maxLength(255)
                                        ->unique(ignoreRecord: true, modifyRuleUsing: function (Unique $rule, callable $get) {
                                            return $rule->where('tournament_id', $get('tournament_id'));
                                        }),

                                    Forms\Components\TextInput::make('fifa_code')
                                        ->label('FIFA Kodu')
                                        ->maxLength(10)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('confederation')
                                        ->label('Konfederasyon')
                                        ->maxLength(100)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('coach_name_api')
                                        ->label('Teknik Direktör (API)')
                                        ->maxLength(255)
                                        ->nullable(),
                                ])
                                ->columns(2),

                            Forms\Components\Section::make('Medya / Açıklama')
                                ->schema([
                                    Forms\Components\TextInput::make('flag_image_api')
                                        ->label('Bayrak Görseli (API)')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('image_override')
                                        ->label('Görsel (Override)')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\Textarea::make('description_editorial')
                                        ->label('Editoryal Açıklama')
                                        ->rows(4)
                                        ->maxLength(2000)
                                        ->nullable(),
                                ]),

                            Forms\Components\Section::make('Durum')
                                ->schema([
                                    Forms\Components\Toggle::make('featured_lock')
                                        ->label('Featured Lock'),

                                    Forms\Components\Toggle::make('is_visible')
                                        ->label('Görünür')
                                        ->default(true)
                                        ->reactive()
                                        ->afterStateUpdated(function (Set $set, $state): void {
                                            if (! $state) {
                                                $set('is_featured', false);
                                            }
                                        }),

                                    Forms\Components\Toggle::make('is_featured')
                                        ->label('Öne Çıkan')
                                        ->reactive()
                                        ->disabled(fn (Get $get) => (bool) $get('featured_lock'))
                                        ->afterStateUpdated(function (Set $set, Get $get, $state): void {
                                            if ($state && ! $get('is_visible')) {
                                                $set('is_visible', true);
                                            }
                                        })
                                        ->rule(function (Get $get, ?Team $record) {
                                            return function (string $attribute, $value, callable $fail) use ($get, $record): void {
                                                if (! $value) {
                                                    return;
                                                }

                                                if (! $get('is_visible')) {
                                                    $fail('Öne çıkarma için görünür olmalı.');
                                                    return;
                                                }

                                                $tournamentId = $get('tournament_id');
                                                if (! $tournamentId) {
                                                    return;
                                                }

                                                $query = Team::query()
                                                    ->where('tournament_id', $tournamentId)
                                                    ->where('is_featured', true);

                                                if ($record) {
                                                    $query->whereKeyNot($record->getKey());
                                                }

                                                if ($query->count() >= 8) {
                                                    $fail('Aynı turnuvada en fazla 8 takım öne çıkarılabilir.');
                                                }
                                            };
                                        }),

                                    Forms\Components\TextInput::make('sort_order')
                                        ->label('Sıra')
                                        ->numeric()
                                        ->default(0),
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
                                            ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\TeamResource\Pages\CreateTeam)
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
                Tables\Columns\ImageColumn::make('flag_url')
                    ->label('Bayrak')
                    ->circular()
                    ->disk('public'),
                Tables\Columns\TextColumn::make('name_override')
                    ->label('Ad')
                    ->formatStateUsing(fn (?string $state, Team $record) => $state ?: $record->name_api)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')->label('Slug')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('group.code')->label('Grup')->placeholder('—'),
                Tables\Columns\TextColumn::make('confederation')->label('Konfederasyon')->placeholder('—'),
                Tables\Columns\IconColumn::make('is_featured')->label('Öne Çıkan')->boolean(),
                Tables\Columns\IconColumn::make('featured_lock')->label('Lock')->boolean()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_visible')->label('Görünür')->boolean()->trueColor('success')->falseColor('gray'),
                Tables\Columns\TextColumn::make('sort_order')->label('Sıra')->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')->label('Görünür'),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Öne Çıkan'),
                Tables\Filters\TernaryFilter::make('featured_lock')->label('Featured Lock'),
                Tables\Filters\SelectFilter::make('tournament_id')
                    ->label('Turnuva')
                    ->relationship('worldCup', 'year'),
                Tables\Filters\SelectFilter::make('group_id')
                    ->label('Grup')
                    ->relationship('group', 'code'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([])
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
