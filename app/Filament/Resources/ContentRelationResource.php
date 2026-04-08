<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentRelationResource\Pages;
use App\Models\WorldCup\ContentRelation;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class ContentRelationResource extends Resource
{
    protected static ?string $model = ContentRelation::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?string $navigationLabel = 'İçerik İlişkileri';
    protected static ?string $modelLabel = 'İçerik İlişkisi';
    protected static ?string $pluralModelLabel = 'İçerik İlişkileri';
    protected static ?int $navigationSort = 90;

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

    public static function canDelete($record): bool
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
                            Forms\Components\Section::make('İlişki Bilgileri')
                                ->schema([
                                    Forms\Components\Select::make('tournament_id')
                                        ->label('Turnuva')
                                        ->relationship('worldCup', 'name')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name . ' ' . $record->year)
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->native(false),

                                    Forms\Components\Select::make('related_type')
                                        ->label('Related Type')
                                        ->options([
                                            'App\\Models\\News' => 'News',
                                            'App\\Models\\Article' => 'Article',
                                            'App\\Models\\Blog' => 'Blog',
                                        ])
                                        ->required()
                                        ->native(false),

                                    Forms\Components\TextInput::make('related_id')
                                        ->label('Related ID')
                                        ->numeric()
                                        ->required()
                                        ->minValue(1)
                                        ->unique(ignoreRecord: true, modifyRuleUsing: function (Unique $rule, Get $get) {
                                            return $rule
                                                ->where('tournament_id', $get('tournament_id'))
                                                ->where('related_type', $get('related_type'))
                                                ->where('relation_type', $get('relation_type'));
                                        }),

                                    Forms\Components\TextInput::make('relation_type')
                                        ->label('Relation Type')
                                        ->required()
                                        ->maxLength(255),

                                    Forms\Components\Toggle::make('is_featured')
                                        ->label('Öne Çıkan')
                                        ->reactive()
                                        ->afterStateUpdated(function (Set $set, Get $get, $state): void {
                                            if ($state && ! $get('is_visible')) {
                                                $set('is_visible', true);
                                            }
                                        })
                                        ->rule(function (Get $get, ?ContentRelation $record) {
                                            return function (string $attribute, $value, callable $fail) use ($get, $record): void {
                                                if (! $value) {
                                                    return;
                                                }

                                                if (! $get('is_visible')) {
                                                    $fail('Öne çıkarma için görünür olmalı.');
                                                    return;
                                                }

                                                $tournamentId = $get('tournament_id');
                                                $relationType = $get('relation_type');
                                                if (! $tournamentId || ! $relationType) {
                                                    return;
                                                }

                                                $query = ContentRelation::query()
                                                    ->where('tournament_id', $tournamentId)
                                                    ->where('relation_type', $relationType)
                                                    ->where('is_featured', true);

                                                if ($record) {
                                                    $query->whereKeyNot($record->getKey());
                                                }

                                                if ($query->count() >= 10) {
                                                    $fail('Aynı ilişki tipi için en fazla 10 içerik öne çıkarılabilir.');
                                                }
                                            };
                                        }),

                                    Forms\Components\Toggle::make('is_visible')
                                        ->label('Görünür')
                                        ->default(true)
                                        ->reactive()
                                        ->afterStateUpdated(function (Set $set, $state): void {
                                            if (! $state) {
                                                $set('is_featured', false);
                                            }
                                        }),

                                    Forms\Components\TextInput::make('sort_order')
                                        ->label('Sıra')
                                        ->numeric()
                                        ->default(0)
                                        ->minValue(0),
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
                                            ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\ContentRelationResource\Pages\CreateContentRelation)
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
                Tables\Columns\TextColumn::make('worldCup.year')->label('Yıl')->sortable(),
                Tables\Columns\TextColumn::make('related_type')->label('Related Type')->searchable(),
                Tables\Columns\TextColumn::make('related_id')->label('Related ID')->sortable(),
                Tables\Columns\TextColumn::make('relation_type')->label('Relation Type')->placeholder('—'),
                Tables\Columns\IconColumn::make('is_featured')->label('Öne Çıkan')->boolean(),
                Tables\Columns\IconColumn::make('is_visible')->label('Görünür')->boolean()->trueColor('success')->falseColor('gray'),
                Tables\Columns\TextColumn::make('sort_order')->label('Sıra')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tournament_id')
                    ->label('Turnuva')
                    ->relationship('worldCup', 'year'),
                Tables\Filters\SelectFilter::make('relation_type')
                    ->label('Relation Type')
                    ->options(fn () => ContentRelation::query()->whereNotNull('relation_type')->pluck('relation_type', 'relation_type')->unique()->all()),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Öne Çıkan'),
                Tables\Filters\TernaryFilter::make('is_visible')->label('Görünür'),
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
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContentRelations::route('/'),
            'create' => Pages\CreateContentRelation::route('/create'),
            'edit' => Pages\EditContentRelation::route('/{record}/edit'),
        ];
    }
}
