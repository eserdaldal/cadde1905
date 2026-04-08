<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = "heroicon-o-users";
    protected static ?string $navigationGroup = 'Yönetim';
    protected static ?string $navigationLabel = 'Kullanıcılar';
    protected static ?string $pluralModelLabel = 'Kullanıcılar';
    protected static ?int $navigationSort = 200;

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->isAdmin() ?? false;
    }

    public static function canViewAny(): bool
    {
        return Auth::user()?->isAdmin() ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(3)
                ->schema([
                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('Kullanıcı Bilgileri')
                                ->schema([
                                    Forms\Components\TextInput::make("name")
                                        ->label("İsim")
                                        ->required()
                                        ->maxLength(255),

                                    Forms\Components\TextInput::make("email")
                                        ->label("E-posta")
                                        ->email()
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->maxLength(255),

                                    Forms\Components\Select::make("role")
                                        ->label("Rol")
                                        ->options([
                                            "admin" => "Admin",
                                            "editor" => "Editör",
                                        ])
                                        ->required()
                                        ->native(false),

                                    Forms\Components\Toggle::make("is_super_admin")
                                        ->label("Süper Admin")
                                        ->disabled(fn (?User $record) => $record?->id === \Illuminate\Support\Facades\Auth::id()),

                                    Forms\Components\Toggle::make("is_active")
                                        ->label("Aktif")
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
                                            ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\UserResource\Pages\CreateUser)
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
                                            ->visible(fn ($record) => filled($record) && $record->id !== \Illuminate\Support\Facades\Auth::id()),
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
                Tables\Columns\TextColumn::make("name")->label("İsim")->searchable(),
                Tables\Columns\TextColumn::make("email")->label("E-posta")->searchable(),
                Tables\Columns\TextColumn::make("role")->label("Role"),
                Tables\Columns\IconColumn::make("is_super_admin")->label("Superadmin")->boolean(),
                Tables\Columns\IconColumn::make("is_active")->label("Aktif")->boolean(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn (User $record) => $record->id !== Auth::id()),
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
            "index" => Pages\ListUsers::route("/"),
            "create" => Pages\CreateUser::route("/create"),
            "edit" => Pages\EditUser::route("/{record}/edit"),
        ];
    }
}
