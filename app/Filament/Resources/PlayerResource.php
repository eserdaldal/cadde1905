<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlayerResource\Pages;
use App\Models\WorldCup\Player;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class PlayerResource extends Resource
{
    protected static ?string $model = Player::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?string $navigationLabel = 'Oyuncular';
    protected static ?string $modelLabel = 'Oyuncu';
    protected static ?string $pluralModelLabel = 'Oyuncular';
    protected static ?int $navigationSort = 30;

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

                                    Forms\Components\Select::make('team_id')
                                        ->label('Takım')
                                        ->relationship('team', 'name_api')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name_override ?: $record->name_api)
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->native(false),
                                ])
                                ->columns(2),

                            Forms\Components\Section::make('Oyuncu Bilgileri')
                                ->schema([
                                    Forms\Components\TextInput::make('name_api')
                                        ->label('Ad (API)')
                                        ->required()
                                        ->maxLength(255),

                                    Forms\Components\TextInput::make('name_override')
                                        ->label('Ad (Override)')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('slug')
                                        ->label('Slug')
                                        ->required()
                                        ->maxLength(255)
                                        ->unique(ignoreRecord: true, modifyRuleUsing: function (Unique $rule, callable $get) {
                                            return $rule->where('tournament_id', $get('tournament_id'));
                                        }),

                                    Forms\Components\TextInput::make('shirt_number')
                                        ->label('Forma No')
                                        ->maxLength(10)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('position')
                                        ->label('Pozisyon')
                                        ->maxLength(50)
                                        ->nullable(),

                                    Forms\Components\DatePicker::make('date_of_birth')
                                        ->label('Doğum Tarihi')
                                        ->nullable(),

                                    Forms\Components\TextInput::make('nationality')
                                        ->label('Uyruk')
                                        ->maxLength(100)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('club_name_api')
                                        ->label('Kulüp (API)')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('club_name_normalized')
                                        ->label('Kulüp (Normalize)')
                                        ->maxLength(255)
                                        ->nullable(),
                                ])
                                ->columns(2),

                            Forms\Components\Section::make('Medya / Biyografi')
                                ->schema([
                                    Forms\Components\TextInput::make('image_api')
                                        ->label('Görsel (API)')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('image_override')
                                        ->label('Görsel (Override)')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\Textarea::make('bio_editorial')
                                        ->label('Biyografi')
                                        ->rows(4)
                                        ->maxLength(2000)
                                        ->nullable(),
                                ]),

                            Forms\Components\Section::make('Galatasaray İlişkisi')
                                ->schema([
                                    Forms\Components\Toggle::make('is_galatasaray_related')
                                        ->label('GS İlişkili')
                                        ->reactive()
                                        ->disabled(fn (Get $get) => (bool) $get('gs_relation_lock'))
                                        ->afterStateUpdated(function (Set $set, Get $get, $state): void {
                                            if (! $state) {
                                                $set('galatasaray_relation_type', null);
                                                $set('galatasaray_note', null);
                                                $set('gs_relation_approved_at', null);
                                                return;
                                            }

                                            if (! $get('gs_relation_approved_at')) {
                                                $set('gs_relation_approved_at', now());
                                            }
                                        }),

                                    Forms\Components\Select::make('galatasaray_relation_type')
                                        ->label('İlişki Tipi')
                                        ->options([
                                            'former_player' => 'Eski Oyuncu',
                                            'current_player' => 'Mevcut Oyuncu',
                                            'staff' => 'Teknik Ekip',
                                            'legend' => 'Efsane',
                                            'youth' => 'Altyapı',
                                        ])
                                        ->native(false)
                                        ->nullable()
                                        ->required(fn (Get $get) => (bool) $get('is_galatasaray_related'))
                                        ->disabled(fn (Get $get) => ! $get('is_galatasaray_related') || $get('gs_relation_lock')),

                                    Forms\Components\Textarea::make('galatasaray_note')
                                        ->label('Not')
                                        ->rows(3)
                                        ->maxLength(1000)
                                        ->nullable()
                                        ->disabled(fn (Get $get) => ! $get('is_galatasaray_related') || $get('gs_relation_lock')),

                                    Forms\Components\Toggle::make('gs_relation_lock')
                                        ->label('GS Relation Lock'),

                                    Forms\Components\DateTimePicker::make('gs_relation_approved_at')
                                        ->label('Onay Tarihi')
                                        ->nullable()
                                        ->disabled(fn (Get $get) => ! $get('is_galatasaray_related') || $get('gs_relation_lock')),
                                ])
                                ->columns(2),

                            Forms\Components\Section::make('Durum')
                                ->schema([
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
                                        ->afterStateUpdated(function (Set $set, Get $get, $state): void {
                                            if ($state && ! $get('is_visible')) {
                                                $set('is_visible', true);
                                            }
                                        })
                                        ->rule(function (Get $get, ?Player $record) {
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

                                                $query = Player::query()
                                                    ->where('tournament_id', $tournamentId)
                                                    ->where('is_featured', true);

                                                if ($record) {
                                                    $query->whereKeyNot($record->getKey());
                                                }

                                                if ($query->count() >= 8) {
                                                    $fail('Aynı turnuvada en fazla 8 oyuncu öne çıkarılabilir.');
                                                }
                                            };
                                        }),
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
                                            ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\PlayerResource\Pages\CreatePlayer)
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
                Tables\Columns\TextColumn::make('name_override')
                    ->label('Ad')
                    ->formatStateUsing(fn (?string $state, Player $record) => $state ?: $record->name_api)
                    ->searchable(),
                Tables\Columns\TextColumn::make('team.name_api')->label('Takım')->placeholder('—')->searchable(),
                Tables\Columns\TextColumn::make('galatasaray_relation_type')->label('İlişki')->placeholder('—')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nationality')->label('Uyruk')->placeholder('—'),
                Tables\Columns\IconColumn::make('is_galatasaray_related')->label('GS')->boolean(),
                Tables\Columns\TextColumn::make('gs_relation_approved_at')
                    ->label('Onay')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_featured')->label('Öne Çıkan')->boolean(),
                Tables\Columns\IconColumn::make('is_visible')->label('Görünür')->boolean()->trueColor('success')->falseColor('gray'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')->label('Görünür'),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Öne Çıkan'),
                Tables\Filters\TernaryFilter::make('is_galatasaray_related')->label('GS'),
                Tables\Filters\SelectFilter::make('gs_relation_approved_at')
                    ->label('Onay')
                    ->options([
                        'approved' => 'Onaylı',
                        'pending' => 'Beklemede',
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['value'] === 'approved', fn ($q) => $q->whereNotNull('gs_relation_approved_at'))
                            ->when($data['value'] === 'pending', fn ($q) => $q->whereNull('gs_relation_approved_at'));
                    }),
                Tables\Filters\SelectFilter::make('tournament_id')
                    ->label('Turnuva')
                    ->relationship('worldCup', 'year'),
                Tables\Filters\SelectFilter::make('team_id')
                    ->label('Takım')
                    ->relationship('team', 'name_api'),
                Tables\Filters\SelectFilter::make('galatasaray_relation_type')
                    ->label('İlişki Tipi')
                    ->options(fn () => Player::query()->whereNotNull('galatasaray_relation_type')->pluck('galatasaray_relation_type', 'galatasaray_relation_type')->unique()->all()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit' => Pages\EditPlayer::route('/{record}/edit'),
        ];
    }
}
