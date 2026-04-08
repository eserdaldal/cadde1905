<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimelineEntryResource\Pages;
use App\Models\HistoryEvent;
use App\Models\HistoricalMatch;
use App\Models\Legend;
use App\Models\SeasonArchive;
use App\Models\TimelineEntry;
use App\Models\Trophy;
use App\Services\Timeline\TimelineDuplicateChecker;
use App\Services\Timeline\TimelineRuleSet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\URL;

class TimelineEntryResource extends Resource
{
    protected static ?string $model = TimelineEntry::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Miras';
    protected static ?string $navigationLabel = 'Zaman Çizelgesi';
    protected static ?string $modelLabel = 'Timeline Kaydı';
    protected static ?string $pluralModelLabel = 'Zaman Çizelgesi';
    protected static ?int $navigationSort = 15;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        // MAIN CONTENT (2/3)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Timeline İçeriği')
                                    ->description('Timeline akışında görünecek ana başlık ve açıklama.')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Başlık')
                                            ->helperText('Timeline akışında görünen kısa başlık.')
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\Textarea::make('excerpt')
                                            ->label('Kısa Açıklama')
                                            ->helperText('İsteğe bağlı kısa açıklama.')
                                            ->rows(4)
                                            ->columnSpanFull()
                                            ->nullable(),
                                    ]),

                                Forms\Components\Section::make('Kaynak Bilgisi')
                                    ->description('Bu kaydın hangi modüle bağlı olduğunu gösterir.')
                                    ->schema([
                                        Forms\Components\Placeholder::make('ux_info')
                                            ->label('Sistem Bilgisi')
                                            ->content(function (Get $get) {
                                                $sourceType = $get('source_type');
                                                $sourceId = $get('source_id');

                                                if (! $sourceType && ! $sourceId) {
                                                    return 'Standalone mod: Bu kayıt herhangi bir modele bağlı olmadan yalnız timeline için oluşturulur.';
                                                }

                                                if ($sourceType && ! $sourceId) {
                                                    return 'Kaynak modeli seçildi fakat kaynak kaydı seçilmedi.';
                                                }

                                                if ($sourceType && $sourceId) {
                                                    if (TimelineRuleSet::isStrict($sourceType)) {
                                                        return 'Referenced mod / strict kaynak: Aynı kaynak için aynı tarihte ikinci kayıt oluşturulamaz.';
                                                    }

                                                    if (TimelineRuleSet::isFlexible($sourceType)) {
                                                        return 'Referenced mod / flexible kaynak: HistoryEvent daha esnek editoryal kullanıma uygundur.';
                                                    }

                                                    return 'Referenced mod: Bu kayıt seçtiğin modele bağlı olarak oluşturulacak.';
                                                }

                                                return null;
                                            })
                                            ->columnSpanFull(),
                                    ])
                                    ->collapsible(),
                            ])
                            ->columnSpan(2),

                        // SIDEBAR (1/3)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Zamanlama & Durum')
                                    ->schema([
                                        Forms\Components\DatePicker::make('timeline_date')
                                            ->label('Timeline Tarihi')
                                            ->required(),

                                        Forms\Components\Select::make('type')
                                            ->label('Tip')
                                            ->options(TimelineEntry::typeOptions())
                                            ->required()
                                            ->native(false),

                                        Forms\Components\Select::make('icon')
                                            ->label('İkon')
                                            ->options(TimelineEntry::iconOptions())
                                            ->nullable()
                                            ->native(false),

                                        Forms\Components\TextInput::make('position')
                                            ->label('Sıra (Aynı Gün)')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        Forms\Components\Toggle::make('is_visible')
                                            ->label('Timeline’da Göster')
                                            ->default(true),

                                        Forms\Components\Select::make('tags')
                                            ->label('Etiketler')
                                            ->placeholder('Etiket seçiniz...')
                                            ->relationship('tags', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload()
                                            ->native(false),
                                    ]),

                                Forms\Components\Section::make('Kaynak Bağlantısı')
                                    ->collapsible()
                                    ->collapsed()
                                    ->schema([
                                        Forms\Components\Select::make('source_type')
                                            ->label('Kaynak Model')
                                            ->options(TimelineEntry::sourceTypeOptions())
                                            ->live()
                                            ->nullable()
                                            ->native(false)
                                            ->afterStateUpdated(fn (Forms\Set $set) => $set('source_id', null)),

                                        Forms\Components\Select::make('source_id')
                                            ->label('Kaynak Kayıt')
                                            ->options(function (Get $get): array {
                                                $sourceType = $get('source_type');

                                                if (! $sourceType || ! class_exists($sourceType)) {
                                                    return [];
                                                }

                                                return match ($sourceType) {
                                                    HistoryEvent::class => HistoryEvent::query()
                                                        ->orderByDesc('id')
                                                        ->limit(200)
                                                        ->get()
                                                        ->mapWithKeys(fn ($item) => [$item->getKey() => $item->title ?? ('#' . $item->getKey())])
                                                        ->all(),

                                                    HistoricalMatch::class => HistoricalMatch::query()
                                                        ->orderByDesc('id')
                                                        ->limit(200)
                                                        ->get()
                                                        ->mapWithKeys(fn ($item) => [$item->getKey() => $item->title ?? ('#' . $item->getKey())])
                                                        ->all(),

                                                    SeasonArchive::class => SeasonArchive::query()
                                                        ->orderByDesc('id')
                                                        ->limit(200)
                                                        ->get()
                                                        ->mapWithKeys(fn ($item) => [$item->getKey() => $item->title ?? ($item->season_label ?? ('#' . $item->getKey()))])
                                                        ->all(),

                                                    Legend::class => Legend::query()
                                                        ->orderByDesc('id')
                                                        ->limit(200)
                                                        ->get()
                                                        ->mapWithKeys(fn ($item) => [$item->getKey() => $item->name ?? $item->title ?? ('#' . $item->getKey())])
                                                        ->all(),

                                                    Trophy::class => Trophy::query()
                                                        ->orderByDesc('id')
                                                        ->limit(200)
                                                        ->get()
                                                        ->mapWithKeys(fn ($item) => [$item->getKey() => $item->name ?? ('#' . $item->getKey())])
                                                        ->all(),

                                                    default => [],
                                                };
                                            })
                                            ->searchable()
                                            ->nullable()
                                            ->native(false),
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
                                                ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\TimelineEntryResource\Pages\CreateTimelineEntry)
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
                    ])
                    ->extraAttributes(['class' => 'gap-y-6']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('timeline_date', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('is_demo')
                    ->label('Tür')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'DEMO' : 'Gerçek')
                    ->color(fn (bool $state): string => $state ? 'warning' : 'success')
                    ->sortable()
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->limit(60)
                    ->description(fn (TimelineEntry $record): ?string => filled($record->excerpt)
                        ? str($record->excerpt)->limit(80)->toString()
                        : null)
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('type_label')
                    ->label('Tip')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'An' => 'info',
                        'Maç' => 'warning',
                        'Sezon' => 'gray',
                        'Efsane' => 'success',
                        'Kupa' => 'danger',
                        'Başarı' => 'success',
                        'Dönüm Noktası' => 'primary',
                        'Dönem' => 'gray',
                        'Kadro' => 'warning',
                        default => 'gray',
                    })
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('source_label')
                    ->label('Kaynak')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => $state ?: 'Standalone')
                    ->color(fn (?string $state): string => match ($state) {
                        'HistoryEvent' => 'success',
                        'HistoricalMatch' => 'warning',
                        'SeasonArchive' => 'gray',
                        'Legend' => 'info',
                        'Trophy' => 'danger',
                        default => 'gray',
                    })
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Görünür')
                    ->boolean()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('timeline_date')
                    ->label('Tarih')
                    ->date('d.m.Y')
                    ->sortable()
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Güncellendi')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->extraAttributes(['class' => 'text-xs']),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Görünürlük'),

                Tables\Filters\SelectFilter::make('type')
                    ->label('Tip')
                    ->options(TimelineEntry::typeOptions()),

                Tables\Filters\SelectFilter::make('source_type')
                    ->label('Kaynak Model')
                    ->options(TimelineEntry::sourceTypeOptions()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateHeading('Henüz timeline kaydı yok')
            ->emptyStateDescription('İlk timeline kaydını oluşturarak kronoloji akışını başlatabilirsin.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTimelineEntries::route('/'),
            'create' => Pages\CreateTimelineEntry::route('/create'),
            'edit' => Pages\EditTimelineEntry::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->orderByDesc('timeline_date')
            ->orderBy('position');
    }

    /**
     * Timeline validation logic (Missing method fix)
     */
    public static function timelineValidationErrors(array $data, ?int $ignoreId = null): array
    {
        $errors = [];

        $sourceType = $data['source_type'] ?? null;
        $sourceId = $data['source_id'] ?? null;
        $timelineDate = $data['timeline_date'] ?? null;

        // 1. Source Pair Validation (Ya ikisi dolu ya ikisi boş olmalı)
        if (! TimelineRuleSet::hasValidSourcePair($sourceType, $sourceId)) {
            $errors['source_id'] = 'Kaynak modeli ve kaynak kaydı birlikte seçilmelidir (veya ikisi de boş bırakılmalıdır).';
        }

        // 2. Duplicate Check (Strict kaynaklar için aynı tarihte tek kayıt)
        if ($sourceType && $sourceId && $timelineDate) {
            $checker = new TimelineDuplicateChecker();
            if ($checker->existsReferencedDuplicate($sourceType, $sourceId, $timelineDate, $ignoreId)) {
                $errors['timeline_date'] = 'Bu kaynak için bu tarihte zaten bir timeline kaydı mevcut.';
            }
        }

        return $errors;
    }
}