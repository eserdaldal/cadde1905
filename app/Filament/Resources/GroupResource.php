<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
use App\Models\WorldCup\Group;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class GroupResource extends Resource
{
    protected static ?string $model = Group::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?string $navigationLabel = 'Gruplar';
    protected static ?string $modelLabel = 'Grup';
    protected static ?string $pluralModelLabel = 'Gruplar';
    protected static ?int $navigationSort = 60;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function canViewAny(): bool
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
                            Forms\Components\Section::make('Grup Bilgileri')
                                ->schema([
                                    Forms\Components\Select::make('tournament_id')
                                        ->label('Turnuva')
                                        ->relationship('worldCup', 'name')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name . ' ' . $record->year)
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->native(false),

                                    Forms\Components\TextInput::make('external_id')
                                        ->label('External ID')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('code')
                                        ->label('Kod')
                                        ->required()
                                        ->maxLength(10)
                                        ->unique(ignoreRecord: true, modifyRuleUsing: function (Unique $rule, callable $get) {
                                            return $rule->where('tournament_id', $get('tournament_id'));
                                        }),

                                    Forms\Components\TextInput::make('name')
                                        ->label('Ad')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('stage')
                                        ->label('Aşama')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('sort_order')
                                        ->label('Sıra')
                                        ->numeric()
                                        ->default(0),

                                    Forms\Components\TextInput::make('title_override')
                                        ->label('Başlık (Override)')
                                        ->maxLength(255)
                                        ->nullable(),

                                    Forms\Components\Toggle::make('is_visible')
                                        ->label('Görünür')
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
                                            ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\GroupResource\Pages\CreateGroup)
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
                Tables\Columns\TextColumn::make('code')->label('Kod')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Ad')->placeholder('—'),
                Tables\Columns\TextColumn::make('stage')->label('Aşama')->placeholder('—'),
                Tables\Columns\TextColumn::make('sort_order')->label('Sıra')->sortable(),
                Tables\Columns\IconColumn::make('is_visible')->label('Görünür')->boolean()->trueColor('success')->falseColor('gray'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')->label('Görünür'),
                Tables\Filters\SelectFilter::make('tournament_id')
                    ->label('Turnuva')
                    ->relationship('worldCup', 'year'),
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
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
        ];
    }
}
