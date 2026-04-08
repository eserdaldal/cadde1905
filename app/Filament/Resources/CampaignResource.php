<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampaignResource\Pages;
use App\Models\Campaign;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = "heroicon-o-megaphone";
    protected static ?string $navigationGroup = 'Yönetim';
    protected static ?string $navigationLabel = 'Kampanyalar';
    protected static ?string $pluralModelLabel = 'Kampanyalar';
    protected static ?int $navigationSort = 130;

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

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(3)
                ->schema([
                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('Kampanya İçeriği')
                                ->schema([
                                    Forms\Components\TextInput::make("key")
                                        ->label("Anahtar")
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->maxLength(255)
                                        ->rules([
                                            'string',
                                            'regex:/^[A-Za-z0-9._-]+$/',
                                        ])
                                        ->helperText('Örn: world_cup (yalnızca harf, rakam, . _ -)'),

                                    Forms\Components\TextInput::make("title")
                                        ->label("Başlık")
                                        ->required()
                                        ->maxLength(255)
                                        ->rules(['string']),

                                    Forms\Components\TextInput::make("subtitle")
                                        ->label("Alt Başlık")
                                        ->maxLength(255)
                                        ->nullable()
                                        ->rules(['nullable', 'string', 'max:255']),

                                    Forms\Components\Textarea::make("description")
                                        ->label("Açıklama")
                                        ->rows(4)
                                        ->maxLength(1000)
                                        ->nullable()
                                        ->rules(['nullable', 'string', 'max:1000']),

                                    Forms\Components\TextInput::make("cta_label")
                                        ->label("CTA Etiketi")
                                        ->required()
                                        ->maxLength(255)
                                        ->rules(['string']),

                                    Forms\Components\TextInput::make("cta_route_name")
                                        ->label("CTA Route Adı")
                                        ->required()
                                        ->maxLength(255)
                                        ->rules([
                                            'string',
                                            'regex:/^[A-Za-z0-9._-]+$/',
                                        ])
                                        ->rule(function () {
                                            return function (string $attribute, $value, callable $fail): void {
                                                if (! is_string($value) || $value === '') {
                                                    return;
                                                }

                                                if (! Route::has($value)) {
                                                    $fail('Girilen route adı bulunamadı.');
                                                }
                                            };
                                        })
                                        ->helperText('Geçersiz route adı girilirse kampanya gösterilmez.'),

                                    Forms\Components\KeyValue::make("cta_route_params")
                                        ->label("CTA Route Parametreleri")
                                        ->keyLabel("Parametre")
                                        ->valueLabel("Değer")
                                        ->addButtonLabel('Parametre Ekle')
                                        ->reorderable()
                                        ->nullable()
                                        ->rules(['nullable', 'array']),
                                ]),
                        ])
                        ->columnSpan(2),

                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('Durum ve Zamanlama')
                                ->schema([
                                    Forms\Components\Select::make("status")
                                        ->label("Durum")
                                        ->options([
                                            "draft" => "Taslak",
                                            "active" => "Aktif",
                                            "scheduled" => "Planlı",
                                            "inactive" => "Pasif",
                                            "archived" => "Arşiv",
                                        ])
                                        ->required()
                                        ->rules(['in:draft,active,scheduled,inactive,archived'])
                                        ->native(false),

                                    Forms\Components\Toggle::make("is_enabled")
                                        ->label("Etkin")
                                        ->default(true),

                                    Forms\Components\TextInput::make("priority")
                                        ->label("Öncelik")
                                        ->numeric()
                                        ->minValue(1)
                                        ->maxValue(999)
                                        ->default(100)
                                        ->required()
                                        ->rules(['integer', 'min:1', 'max:999']),

                                    Forms\Components\DateTimePicker::make("starts_at")
                                        ->label("Başlangıç")
                                        ->nullable()
                                        ->rules(['nullable', 'date'])
                                        ->rule(function (callable $get) {
                                            return function (string $attribute, $value, callable $fail) use ($get): void {
                                                $end = $get('ends_at');

                                                if (! $value || ! $end) {
                                                    return;
                                                }

                                                try {
                                                    $startAt = \Illuminate\Support\Carbon::parse($value);
                                                    $endAt = \Illuminate\Support\Carbon::parse($end);
                                                } catch (\Throwable) {
                                                    return;
                                                }

                                                if ($startAt->gt($endAt)) {
                                                    $fail('Başlangıç tarihi bitişten sonra olamaz.');
                                                }
                                            };
                                        }),

                                    Forms\Components\DateTimePicker::make("ends_at")
                                        ->label("Bitiş")
                                        ->nullable()
                                        ->rules(['nullable', 'date'])
                                        ->rule(function (callable $get) {
                                            return function (string $attribute, $value, callable $fail) use ($get): void {
                                                $start = $get('starts_at');

                                                if (! $value || ! $start) {
                                                    return;
                                                }

                                                try {
                                                    $startAt = \Illuminate\Support\Carbon::parse($start);
                                                    $endAt = \Illuminate\Support\Carbon::parse($value);
                                                } catch (\Throwable) {
                                                    return;
                                                }

                                                if ($endAt->lt($startAt)) {
                                                    $fail('Bitiş tarihi başlangıçtan önce olamaz.');
                                                }
                                            };
                                        }),
                                ]),

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
                                            ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\CampaignResource\Pages\CreateCampaign)
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
                Tables\Columns\TextColumn::make("key")->label("Anahtar")->searchable(),
                Tables\Columns\TextColumn::make("title")->label("Başlık")->searchable(),
                Tables\Columns\TextColumn::make("status")->label("Durum"),
                Tables\Columns\IconColumn::make("is_enabled")->label("Etkin")->boolean(),
                Tables\Columns\TextColumn::make("priority")->label("Öncelik")->sortable(),
                Tables\Columns\TextColumn::make("starts_at")->label("Başlangıç")->dateTime(),
                Tables\Columns\TextColumn::make("ends_at")->label("Bitiş")->dateTime(),
                Tables\Columns\TextColumn::make("updated_at")->label("Güncelleme")->dateTime(),
            ])
            ->defaultSort("updated_at", "desc")
            ->filters([])
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
            "index" => Pages\ListCampaigns::route("/"),
            "create" => Pages\CreateCampaign::route("/create"),
            "edit" => Pages\EditCampaign::route("/{record}/edit"),
        ];
    }
}
