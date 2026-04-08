<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatchStadiumMapResource\Pages;
use App\Models\WorldCup\MatchStadiumMap;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MatchStadiumMapResource extends Resource
{
    protected static ?string $model = MatchStadiumMap::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?string $navigationLabel = 'Maç-Stat Eşleşmeleri';
    protected static ?string $modelLabel = 'Eşleşme';
    protected static ?string $pluralModelLabel = 'Eşleşmeler';
    protected static ?int $navigationSort = 60;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('tournament_id')
                ->label('Turnuva')
                ->relationship('tournament', 'name')
                ->required()
                ->searchable()
                ->preload(),
            Forms\Components\TextInput::make('slot_number')
                ->label('Slot No')
                ->required()
                ->numeric(),
            Forms\Components\Select::make('stadium_id')
                ->label('Stadyum')
                ->relationship('stadium', 'name_api')
                ->required()
                ->searchable()
                ->preload(),
            Forms\Components\TextInput::make('source')
                ->label('Kaynak')
                ->default('canonical')
                ->maxLength(50),
            Forms\Components\Toggle::make('is_locked')
                ->label('Kilitli')
                ->default(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slot_number')
                    ->label('Slot No')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stadium.name_api')
                    ->label('Stadyum')
                    ->sortable(),
                Tables\Columns\TextColumn::make('source')
                    ->label('Kaynak'),
                Tables\Columns\IconColumn::make('is_locked')
                    ->label('Kilitli')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_locked')->label('Kilitli'),
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
            'index' => Pages\ManageMatchStadiumMaps::route('/'),
        ];
    }
}
