<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StadiumAliasResource\Pages;
use App\Models\WorldCup\StadiumAlias;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StadiumAliasResource extends Resource
{
    protected static ?string $model = StadiumAlias::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?string $navigationLabel = 'Stat Takma Adları';
    protected static ?string $modelLabel = 'Takma Ad';
    protected static ?string $pluralModelLabel = 'Takma Adlar';
    protected static ?int $navigationSort = 55;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('stadium_id')
                ->label('Gerçek Stadyum')
                ->relationship('stadium', 'name_api')
                ->required()
                ->searchable()
                ->preload(),
            Forms\Components\TextInput::make('alias_name')
                ->label('Takma Ad')
                ->required()
                ->maxLength(255),
            Forms\Components\Toggle::make('is_active')
                ->label('Aktif')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('alias_name')
                    ->label('Takma Ad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stadium.name_api')
                    ->label('Gerçek Stadyum')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Durum'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Aktif'),
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
            'index' => Pages\ManageStadiumAliases::route('/'),
        ];
    }
}
