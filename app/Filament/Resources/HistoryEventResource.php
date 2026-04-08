<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryEventResource\Pages;
use App\Filament\Resources\HistoryEventResource\RelationManagers\LegendsRelationManager;
use App\Filament\Resources\HistoryEventResource\RelationManagers\TrophiesRelationManager;
use App\Models\HistoryEvent;
use App\Models\Media;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use App\Services\SiteModeService;

class HistoryEventResource extends Resource
{
    protected static ?string $model = HistoryEvent::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Miras';
    protected static ?string $navigationLabel = 'Tarihsel Olaylar';
    protected static ?string $modelLabel = 'Olay';
    protected static ?string $pluralModelLabel = 'Tarihsel Olaylar';
    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->disabled(fn (?HistoryEvent $record) => $record?->isDemo() ?? false)
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        // MAIN CONTENT (2/3)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Temel Bilgiler')
                                    ->description('Olayın başlığı, tipi ve kısa özet bilgileri.')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Başlık')
                                            ->required()
                                            ->maxLength(220)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function (?string $state, ?string $old, Forms\Set $set, Forms\Get $get): void {
                                                $currentSlug = (string) ($get('slug') ?? '');
                                                $oldSlug = filled($old) ? Str::slug($old) : '';

                                                if (blank($currentSlug) || $currentSlug === $oldSlug) {
                                                    $set('slug', filled($state) ? Str::slug($state) : null);
                                                }
                                            }),

                                        Forms\Components\TextInput::make('slug')
                                            ->label('Slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true),

                                        Select::make('type')
                                            ->label('Olay Türü')
                                            ->required()
                                            ->options([
                                                'moment' => 'Moment (Tekil Olay)',
                                                'achievement' => 'Achievement (Başarı)',
                                                'era' => 'Era (Dönem)',
                                                'milestone' => 'Milestone (Dönüm Noktası)',
                                                'squad' => 'Squad (Kadrosal Dönem)',
                                            ])
                                            ->native(false)
                                            ->searchable()
                                            ->default('moment'),

                                        Forms\Components\TextInput::make('source_url')
                                            ->label('Kaynak URL')
                                            ->url()
                                            ->maxLength(500),

                                        Forms\Components\Textarea::make('excerpt')
                                            ->label('Kısa Özet')
                                            ->rows(2)
                                            ->helperText('Liste ve kartlarda gösterilecek vurucu özet.')
                                            ->columnSpanFull(),

                                        Forms\Components\Textarea::make('description')
                                            ->label('Yönetimsel Açıklama')
                                            ->rows(2)
                                            ->helperText('Editörler için notlar veya dahili açıklama.')
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Medya Yönetimi')
                                    ->description('Video ve Galeri içeriklerini buradan yönetin.')
                                    ->schema([
                                        // VIDEO
                                        Forms\Components\Group::make()
                                            ->schema([
                                                Forms\Components\View::make('filament.news.video-viewer')
                                                    ->columnSpanFull(),

                                                Forms\Components\TextInput::make('video_url')
                                                    ->label('Video URL')
                                                    ->placeholder('YouTube, Vimeo bağlantısı...')
                                                    ->url(),

                                                Forms\Components\Select::make('existing_video_media_id')
                                                    ->label('Arşivden Video Seç')
                                                    ->options(fn (?HistoryEvent $record) => static::getExistingEmbedOptionsForRecord($record))
                                                    ->searchable()
                                                    ->preload()
                                                    ->native(false),

                                                Forms\Components\Toggle::make('remove_video')
                                                    ->label('Mevcut Videoyu Kaldır')
                                                    ->offIcon('heroicon-m-video-camera')
                                                    ->onIcon('heroicon-m-trash')
                                                    ->onColor('danger'),
                                            ]),

                                        Forms\Components\Placeholder::make('separator')
                                            ->label('')
                                            ->content(new HtmlString('<div class="h-px bg-gray-100/10 my-6"></div>'))
                                            ->columnSpanFull(),

                                        // GALLERY
                                        Forms\Components\Group::make()
                                            ->schema([
                                                Forms\Components\View::make('filament.news.gallery-preview')
                                                    ->columnSpanFull(),

                                                Forms\Components\FileUpload::make('gallery_uploads')
                                                    ->label('Yeni Galeri Yükle')
                                                    ->multiple()
                                                    ->image()
                                                    ->imageEditor()
                                                    ->reorderable()
                                                    ->appendFiles()
                                                    ->storeFiles(false),

                                                Forms\Components\Select::make('existing_gallery_media_ids')
                                                    ->label('Arşivden Görsel Seç')
                                                    ->multiple()
                                                    ->options(fn (?HistoryEvent $record) => static::getExistingImageOptionsForRecord($record, 'gallery'))
                                                    ->searchable()
                                                    ->preload()
                                                    ->native(false),

                                                Forms\Components\Toggle::make('remove_gallery')
                                                    ->label('Galeriyi Tamamen Kaldır')
                                                    ->offIcon('heroicon-m-photo')
                                                    ->onIcon('heroicon-m-trash')
                                                    ->onColor('danger'),
                                            ]),
                                    ])
                                    ->columns(1)
                                    ->collapsible(),

                                Forms\Components\Section::make('İçerik')
                                    ->schema([
                                        Forms\Components\RichEditor::make('content')
                                            ->label('Detaylı Anlatım')
                                            ->fileAttachmentsDisk('public')
                                            ->fileAttachmentsDirectory('history-content')
                                            ->columnSpanFull(),
                                    ]),
                            ])
                            ->columnSpan(2),

                        // SIDEBAR (1/3)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Tarih Bilgisi')
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\DatePicker::make('event_date')
                                            ->label('Olay Tarihi')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get): void {
                                                if (blank($state)) return;
                                                $date = $state instanceof Carbon ? $state : Carbon::parse($state);
                                                $set('year', (int) $date->year);
                                                $set('month', (int) $date->month);
                                                $set('day', (int) $date->day);
                                                if (blank($get('start_date'))) $set('start_date', $date->toDateString());
                                                if (blank($get('end_date'))) $set('end_date', $date->toDateString());
                                                if ((bool) $get('is_on_this_day')) {
                                                    $set('on_this_day_month', (int) $date->month);
                                                    $set('on_this_day_day', (int) $date->day);
                                                }
                                            }),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\DatePicker::make('start_date')
                                                    ->label('Başlangıç'),
                                                Forms\Components\DatePicker::make('end_date')
                                                    ->label('Bitiş'),
                                            ]),

                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\TextInput::make('year')->label('Yıl')->numeric(),
                                                Forms\Components\TextInput::make('month')->label('Ay')->numeric(),
                                                Forms\Components\TextInput::make('day')->label('Gün')->numeric(),
                                            ]),
                                    ]),

                                Forms\Components\Section::make('Tarihte Bugün')
                                    ->collapsible()
                                    ->compact()
                                    ->schema([
                                        Forms\Components\Toggle::make('is_on_this_day')
                                            ->label('Bugün Aktif')
                                            ->live(),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('on_this_day_month')->label('Ay')->numeric(),
                                                Forms\Components\TextInput::make('on_this_day_day')->label('Gün')->numeric(),
                                            ])
                                            ->visible(fn ($get) => (bool) $get('is_on_this_day')),
                                    ]),

                                Forms\Components\Section::make('Yayın & Önem')
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\Toggle::make('is_published')
                                            ->label('Yayında')
                                            ->default(true),

                                        Forms\Components\DateTimePicker::make('published_at')
                                            ->label('Yayın Zamanı'),

                                        Forms\Components\TextInput::make('importance_score')
                                            ->label('Önem Skoru')
                                            ->numeric()
                                            ->default(0),

                                        Forms\Components\Toggle::make('is_featured')
                                            ->label('Öne Çıkarılan Olay'),

                                        Forms\Components\Select::make('tags')
                                            ->label('Etiketler')
                                            ->placeholder('Etiket seçiniz...')
                                            ->relationship('tags', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload()
                                            ->native(false),

                                        Forms\Components\Toggle::make('is_demo')
                                            ->label('Demo İçerik')
                                            ->helperText('Bu içerik sadece demo/test amaçlıdır.')
                                            ->default(fn () => !SiteModeService::isLive())
                                            ->dehydrated(fn ($state) => filled($state))
                                            ->columnSpanFull(),

                                        Forms\Components\Placeholder::make('canonical_separator')
                                            ->label('')
                                            ->content(new HtmlString('<div class="h-px bg-gray-100/10 my-2"></div>')),

                                        Forms\Components\Toggle::make('is_canonical')
                                            ->label('Canonical Aktif')
                                            ->default(true),

                                        Forms\Components\TextInput::make('canonical_key')
                                            ->label('Canonical Key')
                                            ->placeholder('Örn: milestone_1907'),
                                    ]),

                                Forms\Components\Section::make('İlgili Bağlantılar')
                                    ->description('Bu olayla ilişkili efsaneler ve kupalar.')
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\Select::make('legends')
                                            ->label('Efsaneler')
                                            ->multiple()
                                            ->relationship('legends', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->native(false),

                                        Forms\Components\Select::make('trophies')
                                            ->label('Kupalar')
                                            ->multiple()
                                            ->relationship('trophies', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->native(false),
                                    ]),

                                Forms\Components\Section::make('Kapak Görseli')
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\View::make('filament.news.cover-preview'),

                                        Forms\Components\FileUpload::make('cover_upload')
                                            ->label('Yeni Kapak Yükle')
                                            ->image()
                                            ->imageEditor()
                                            ->storeFiles(false),

                                        Forms\Components\Select::make('existing_cover_media_id')
                                            ->label('Arşivden Seç')
                                            ->options(fn (?HistoryEvent $record) => static::getExistingImageOptionsForRecord($record, 'cover'))
                                            ->searchable()
                                            ->preload()
                                            ->native(false),

                                        Forms\Components\Toggle::make('remove_cover')
                                            ->label('Mevcut Kapağı Kaldır')
                                            ->offIcon('heroicon-m-photo')
                                            ->onIcon('heroicon-m-trash')
                                            ->onColor('danger'),
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
                                                ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\HistoryEventResource\Pages\CreateHistoryEvent)
                                                ->extraAttributes(['class' => 'w-full']),

                                            Forms\Components\Actions\Action::make('preview_sidebar')
                                                ->label('Önizle')
                                                ->icon('heroicon-m-eye')
                                                ->color('purple')
                                                ->url(fn (HistoryEvent $record) => URL::temporarySignedRoute(
                                                    'preview.history-events.show',
                                                    now()->addMinutes(30),
                                                    ['historyEvent' => $record->id]
                                                ))
                                                ->openUrlInNewTab()
                                                ->visible(fn ($record) => filled($record)),
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
                                                ->visible(fn ($record) => filled($record) && ! $record->isDemo()),
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
            ->columns([

                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('is_demo')
                    ->label('Tür')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'DEMO' : 'Gerçek')
                    ->color(fn (bool $state): string => $state ? 'warning' : 'success')
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tür')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('event_date')
                    ->label('Tarih')
                    ->date('d.m.Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('year')
                    ->label('Yıl')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_on_this_day')
                    ->label('Bugün')
                    ->boolean()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Yayın')
                    ->boolean()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Öne Çıkan')
                    ->boolean()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturma')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->disabled(fn (HistoryEvent $record) => $record->isDemo()),
                Tables\Actions\DeleteAction::make()
                    ->disabled(fn (HistoryEvent $record) => $record->isDemo()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(fn (\Illuminate\Database\Eloquent\Collection $records) => $records->reject->isDemo()->each->delete()),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHistoryEvents::route('/'),
            'create' => Pages\CreateHistoryEvent::route('/create'),
            'edit' => Pages\EditHistoryEvent::route('/{record}/edit'),
        ];
    }

    protected static function getExistingImageOptionsForRecord(?HistoryEvent $record, string $context = 'gallery'): array
    {
        $recordId = $record?->getKey();

        $query = Media::query()
            ->select('media.*')
            ->selectSub(
                DB::table('mediaables')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('mediaables.media_id', 'media.id'),
                'usage_count'
            )
            ->when(
                filled($recordId),
                fn (Builder $query) => $query->selectSub(
                    DB::table('mediaables')
                        ->selectRaw('COUNT(*)')
                        ->whereColumn('mediaables.media_id', 'media.id')
                        ->where('mediable_type', HistoryEvent::class)
                        ->where('mediable_id', $recordId),
                    'current_record_usage_count'
                ),
                fn (Builder $query) => $query->selectRaw('0 as current_record_usage_count')
            )
            ->selectSub(
                DB::table('mediaables')
                    ->selectRaw(
                        "GROUP_CONCAT(
                            DISTINCT CONCAT(
                                REPLACE(mediable_type, 'App\\\\Models\\\\', ''),
                                '#',
                                mediable_id,
                                ' [',
                                usage_type,
                                ']'
                            )
                            ORDER BY mediable_type ASC, mediable_id ASC, usage_type ASC
                            SEPARATOR ' | '
                        )"
                    )
                    ->whereColumn('mediaables.media_id', 'media.id'),
                'usage_summary'
            )
            ->where('media_kind', 'image')
            ->where('is_active', true);

        if ($context === 'cover' && filled($recordId)) {
            $query->whereNotExists(function ($sub) use ($recordId) {
                $sub->selectRaw('1')
                    ->from('mediaables')
                    ->whereColumn('mediaables.media_id', 'media.id')
                    ->where('mediaables.mediable_type', HistoryEvent::class)
                    ->where('mediaables.mediable_id', $recordId)
                    ->where('mediaables.usage_type', 'cover');
            });
        }

        if (filled($recordId)) {
            $query->orderByRaw("
                CASE
                    WHEN COALESCE(usage_count, 0) = 0 THEN 0
                    WHEN COALESCE(current_record_usage_count, 0) > 0 THEN 1
                    ELSE 2
                END ASC
            ");
        } else {
            $query->orderByRaw('CASE WHEN COALESCE(usage_count, 0) = 0 THEN 0 ELSE 1 END ASC');
        }

        return $query
            ->orderByDesc('id')
            ->limit(300)
            ->get()
            ->mapWithKeys(function (Media $media) use ($recordId) {
                $name = $media->original_name ?: basename((string) $media->path);
                $usageCount = (int) ($media->usage_count ?? 0);
                $currentRecordUsageCount = (int) ($media->current_record_usage_count ?? 0);
                $usageSummary = (string) ($media->usage_summary ?? '');

                $status = match (true) {
                    $usageCount === 0 => 'kullanılmıyor',
                    filled($recordId) && $currentRecordUsageCount > 0 => 'bu kayıtta kullanılıyor',
                    default => 'başka kayıtta kullanılıyor',
                };

                $role = match (true) {
                    Str::contains($usageSummary, '[cover]') => 'cover',
                    Str::contains($usageSummary, '[gallery]') => 'gallery',
                    default => null,
                };

                $label = $name . ' — ' . $status;

                if ($role) {
                    $label .= ' • ' . $role;
                }

                return [$media->id => $label];
            })
            ->all();
    }

    protected static function getExistingEmbedOptionsForRecord(?HistoryEvent $record): array
    {
        $recordId = $record?->getKey();

        $query = Media::query()
            ->select('media.*')
            ->selectSub(
                DB::table('mediaables')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('mediaables.media_id', 'media.id'),
                'usage_count'
            )
            ->when(
                filled($recordId),
                fn (Builder $query) => $query->selectSub(
                    DB::table('mediaables')
                        ->selectRaw('COUNT(*)')
                        ->whereColumn('mediaables.media_id', 'media.id')
                        ->where('mediable_type', HistoryEvent::class)
                        ->where('mediable_id', $recordId),
                    'current_record_usage_count'
                ),
                fn (Builder $query) => $query->selectRaw('0 as current_record_usage_count')
            )
            ->selectSub(
                DB::table('mediaables')
                    ->selectRaw(
                        "GROUP_CONCAT(
                            DISTINCT CONCAT(
                                REPLACE(mediable_type, 'App\\\\Models\\\\', ''),
                                '#',
                                mediable_id,
                                ' [',
                                usage_type,
                                ']'
                            )
                            ORDER BY mediable_type ASC, mediable_id ASC, usage_type ASC
                            SEPARATOR ' | '
                        )"
                    )
                    ->whereColumn('mediaables.media_id', 'media.id'),
                'usage_summary'
            )
            ->where('media_kind', 'embed')
            ->where('is_active', true)
            ->whereNotExists(function ($sub) use ($recordId) {
                if (! filled($recordId)) {
                    $sub->selectRaw('1')->whereRaw('1 = 0');
                    return;
                }

                $sub->selectRaw('1')
                    ->from('mediaables')
                    ->whereColumn('mediaables.media_id', 'media.id')
                    ->where('mediaables.mediable_type', HistoryEvent::class)
                    ->where('mediaables.mediable_id', $recordId)
                    ->where('mediaables.usage_type', 'video');
            });

        if (filled($recordId)) {
            $query->orderByRaw("
                CASE
                    WHEN COALESCE(usage_count, 0) = 0 THEN 0
                    WHEN COALESCE(current_record_usage_count, 0) > 0 THEN 1
                    ELSE 2
                END ASC
            ");
        } else {
            $query->orderByRaw('CASE WHEN COALESCE(usage_count, 0) = 0 THEN 0 ELSE 1 END ASC');
        }

        return $query
            ->orderByDesc('id')
            ->limit(200)
            ->get()
            ->mapWithKeys(function (Media $media) use ($recordId) {
                $provider = $media->embed_provider ?: 'embed';
                $name = $media->original_name ?: Str::limit((string) $media->embed_url, 40);
                $usageCount = (int) ($media->usage_count ?? 0);
                $currentRecordUsageCount = (int) ($media->current_record_usage_count ?? 0);

                $status = match (true) {
                    $usageCount === 0 => 'kullanılmıyor',
                    filled($recordId) && $currentRecordUsageCount > 0 => 'bu kayıtta kullanılıyor',
                    default => 'başka kayıtta kullanılıyor',
                };

                $label = $provider . ' — ' . $name . ' — ' . $status;

                return [$media->id => $label];
            })
            ->all();
    }
}