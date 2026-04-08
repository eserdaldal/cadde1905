<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupStandingResource\Pages;
use App\Models\WorldCup\GroupStanding;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class GroupStandingResource extends Resource
{
    protected static ?string $model = GroupStanding::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?string $navigationLabel = 'Puan Tablosu';
    protected static ?string $modelLabel = 'Puan Satırı';
    protected static ?string $pluralModelLabel = 'Puan Tablosu';
    protected static ?int $navigationSort = 70;

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
        $user = Auth::user();

        return (bool) ($user?->isSuperAdmin() || $user?->isAdmin());
    }

    public static function canEdit($record): bool
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

                                    Forms\Components\Select::make('group_id')
                                        ->label('Grup')
                                        ->relationship('group', 'code')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->code . ($record->name ? ' — ' . $record->name : ''))
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->disabled(fn (?GroupStanding $record) => (bool) ($record && $record->position !== null))
                                        ->native(false),

                                    Forms\Components\Select::make('team_id')
                                        ->label('Takım')
                                        ->relationship('team', 'name_api')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name_override ?: $record->name_api)
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->disabled(fn (?GroupStanding $record) => (bool) ($record && $record->position !== null))
                                        ->native(false),
                                ])
                                ->columns(2),

                            Forms\Components\Section::make('Puan Tablosu')
                                ->schema([
                                    Forms\Components\TextInput::make('played')
                                        ->label('O')
                                        ->numeric()
                                        ->default(0),

                                    Forms\Components\TextInput::make('won')
                                        ->label('G')
                                        ->numeric()
                                        ->default(0),

                                    Forms\Components\TextInput::make('drawn')
                                        ->label('B')
                                        ->numeric()
                                        ->default(0),

                                    Forms\Components\TextInput::make('lost')
                                        ->label('M')
                                        ->numeric()
                                        ->default(0),

                                    Forms\Components\TextInput::make('goals_for')
                                        ->label('AG')
                                        ->numeric()
                                        ->default(0),

                                    Forms\Components\TextInput::make('goals_against')
                                        ->label('YG')
                                        ->numeric()
                                        ->default(0),

                                    Forms\Components\TextInput::make('goal_difference')
                                        ->label('AV')
                                        ->numeric()
                                        ->default(0),

                                    Forms\Components\TextInput::make('points')
                                        ->label('P')
                                        ->numeric()
                                        ->default(0)
                                        ->minValue(0),

                                    Forms\Components\TextInput::make('position')
                                        ->label('Sıra')
                                        ->numeric()
                                        ->default(1)
                                        ->minValue(1),
                                ])
                                ->columns(3),

                            Forms\Components\Section::make('Ek Alanlar')
                                ->schema([
                                    Forms\Components\TextInput::make('qualified_status')
                                        ->label('Qualified Status')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\Select::make('visibility_override')
                                        ->label('Görünürlük Override')
                                        ->options([
                                            1 => 'Göster',
                                            0 => 'Gizle',
                                        ])
                                        ->nullable()
                                        ->native(false),

                                    Forms\Components\DateTimePicker::make('snapshot_at')
                                        ->label('Snapshot Tarihi')
                                        ->nullable(),
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
                                            ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\GroupStandingResource\Pages\CreateGroupStanding)
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
                Tables\Columns\TextColumn::make('worldCup.year')->label('Yıl')->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('group.code')->label('Grup')->sortable(),
                Tables\Columns\TextColumn::make('team.name_api')->label('Takım')->searchable(),
                Tables\Columns\TextColumn::make('played')->label('O')->sortable(),
                Tables\Columns\TextColumn::make('goal_difference')->label('AV')->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('points')->label('P')->sortable(),
                Tables\Columns\TextColumn::make('position')->label('Sıra')->sortable(),
                Tables\Columns\TextColumn::make('visibility_override')->label('Override')->placeholder('—'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tournament_id')
                    ->label('Turnuva')
                    ->relationship('worldCup', 'year'),
                Tables\Filters\SelectFilter::make('group_id')
                    ->label('Grup')
                    ->relationship('group', 'code'),
                Tables\Filters\SelectFilter::make('visibility_override')
                    ->label('Override')
                    ->options([
                        1 => 'Göster',
                        0 => 'Gizle',
                    ]),
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
            ->defaultSort('group_id');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGroupStandings::route('/'),
            'create' => Pages\CreateGroupStanding::route('/create'),
            'edit' => Pages\EditGroupStanding::route('/{record}/edit'),
        ];
    }
}
