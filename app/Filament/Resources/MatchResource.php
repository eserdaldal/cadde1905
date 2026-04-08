<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatchResource\Pages;
use App\Models\WorldCup\WorldCupMatch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MatchResource extends Resource
{
    protected static ?string $model = WorldCupMatch::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?string $navigationLabel = 'Maçlar';
    protected static ?string $modelLabel = 'Maç';
    protected static ?string $pluralModelLabel = 'Maçlar';
    protected static ?int $navigationSort = 40;

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
                            Forms\Components\Section::make('İlişkiler')
                                ->schema([
                                    Forms\Components\Select::make('tournament_id')
                                        ->label('Turnuva')
                                        ->relationship('worldCup', 'name')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name . ' ' . $record->year)
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->default(4)
                                        ->native(false),

                                    Forms\Components\Select::make('home_team_id')
                                        ->label('Ev Sahibi')
                                        ->relationship('homeTeam', 'name_api')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name_override ?: $record->name_api)
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->disabled(fn (?WorldCupMatch $record) => (bool) ($record && (
                                            $record->home_score !== null
                                            || $record->away_score !== null
                                            || $record->home_penalty_score !== null
                                            || $record->away_penalty_score !== null
                                        )))
                                        ->native(false),

                                    Forms\Components\Select::make('away_team_id')
                                        ->label('Deplasman')
                                        ->relationship('awayTeam', 'name_api')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name_override ?: $record->name_api)
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->different('home_team_id')
                                        ->validationMessages([
                                            'different' => 'Ev sahibi ve deplasman aynı olamaz.',
                                        ])
                                        ->disabled(fn (?WorldCupMatch $record) => (bool) ($record && (
                                            $record->home_score !== null
                                            || $record->away_score !== null
                                            || $record->home_penalty_score !== null
                                            || $record->away_penalty_score !== null
                                        )))
                                        ->native(false),

                                    Forms\Components\Select::make('stadium_id')
                                        ->label('Stadyum')
                                        ->relationship('stadium', 'name_api')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name_override ?: $record->name_api)
                                        ->searchable()
                                        ->preload()
                                        ->nullable()
                                        ->native(false),

                                    Forms\Components\Select::make('winner_team_id')
                                        ->label('Kazanan')
                                        ->relationship('winnerTeam', 'name_api')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name_override ?: $record->name_api)
                                        ->searchable()
                                        ->preload()
                                        ->nullable()
                                        ->native(false),
                                ])
                                ->columns(2),

                            Forms\Components\Section::make('Maç Bilgileri')
                                ->schema([
                                    Forms\Components\TextInput::make('external_id')
                                        ->label('External ID')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('stage')
                                        ->label('Aşama')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('round_name')
                                        ->label('Tur Adı')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('match_number')
                                        ->label('Maç No')
                                        ->numeric()
                                        ->nullable(),

                                    Forms\Components\DateTimePicker::make('kickoff_at')
                                        ->label('Başlama Saati')
                                        ->required(),

                                    Forms\Components\TextInput::make('status')
                                        ->label('Durum')
                                        ->maxLength(100)
                                        ->nullable()
                                        ->rule('in:scheduled,live,finished,cancelled,postponed'),
                                ])
                                ->columns(2),

                            Forms\Components\Section::make('Skor')
                                ->schema([
                                    Forms\Components\TextInput::make('home_score')
                                        ->label('Ev Skor')
                                        ->numeric()
                                        ->nullable(),

                                    Forms\Components\TextInput::make('away_score')
                                        ->label('Deplasman Skor')
                                        ->numeric()
                                        ->nullable(),

                                    Forms\Components\TextInput::make('home_penalty_score')
                                        ->label('Ev Penaltı')
                                        ->numeric()
                                        ->nullable(),

                                    Forms\Components\TextInput::make('away_penalty_score')
                                        ->label('Deplasman Penaltı')
                                        ->numeric()
                                        ->nullable(),
                                ])
                                ->columns(2),

                            Forms\Components\Section::make('Ek Bilgiler')
                                ->schema([
                                    Forms\Components\TextInput::make('referee')
                                        ->label('Hakem')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('attendance')
                                        ->label('Seyirci')
                                        ->numeric()
                                        ->nullable(),

                                    Forms\Components\Textarea::make('summary_api')
                                        ->label('Özet (API)')
                                        ->rows(3)
                                        ->nullable(),

                                    Forms\Components\Textarea::make('editor_note')
                                        ->label('Editör Notu')
                                        ->rows(3)
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
                                        ->rule(function (Get $get, ?WorldCupMatch $record) {
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

                                                $query = WorldCupMatch::query()
                                                    ->where('tournament_id', $tournamentId)
                                                    ->where('is_featured', true);

                                                if ($record) {
                                                    $query->whereKeyNot($record->getKey());
                                                }

                                                if ($query->count() >= 12) {
                                                    $fail('Aynı turnuvada en fazla 12 maç öne çıkarılabilir.');
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
                                            ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\MatchResource\Pages\CreateMatch)
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
                Tables\Columns\TextColumn::make('kickoff_at')
                    ->label('Başlama')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('round_name')
                    ->label('Tur')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('homeTeam.name_api')
                    ->label('Ev Sahibi')
                    ->formatStateUsing(fn ($state, WorldCupMatch $record) => $record->homeTeam?->name_override ?: $state)
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('home_score')
                    ->label(' ')
                    ->numeric()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('away_score')
                    ->label(' ')
                    ->numeric()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('awayTeam.name_api')
                    ->label('Deplasman')
                    ->formatStateUsing(fn ($state, WorldCupMatch $record) => $record->awayTeam?->name_override ?: $state)
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('stadium.name_api')
                    ->label('Stadyum')
                    ->formatStateUsing(fn ($state, WorldCupMatch $record) => $record->stadium?->name_override ?: $state)
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'scheduled' => 'gray',
                        'live' => 'danger',
                        'finished' => 'success',
                        default => 'gray',
                    })
                    ->placeholder('—'),
                Tables\Columns\IconColumn::make('is_featured')->label('Öne Çıkan')->boolean(),
                Tables\Columns\IconColumn::make('is_visible')->label('Görünür')->boolean()->trueColor('success')->falseColor('gray'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')->label('Görünür'),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Öne Çıkan'),
                Tables\Filters\SelectFilter::make('tournament_id')
                    ->label('Turnuva')
                    ->relationship('worldCup', 'year'),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Durum')
                    ->options(fn () => WorldCupMatch::query()->whereNotNull('status')->pluck('status', 'status')->unique()->all()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([])
            ->defaultSort('kickoff_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMatches::route('/'),
            'create' => Pages\CreateMatch::route('/create'),
            'edit' => Pages\EditMatch::route('/{record}/edit'),
        ];
    }
}
