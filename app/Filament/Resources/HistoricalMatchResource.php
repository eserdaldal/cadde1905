<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoricalMatchResource\Pages;
use App\Models\HistoricalMatch;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Services\SiteModeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class HistoricalMatchResource extends Resource
{
    protected static ?string $model = HistoricalMatch::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationGroup = 'Miras';
    protected static ?string $navigationLabel = 'Tarihsel Maçlar';
    protected static ?string $modelLabel = 'Maç';
    protected static ?string $pluralModelLabel = 'Tarihsel Maçlar';
    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->disabled(fn (?HistoricalMatch $record) => $record?->isDemo() ?? false)
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        // MAIN CONTENT (2/3)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Maç Bilgileri')
                                    ->description('Maçın başlığı, tarihi ve skor bilgileri.')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Başlık')
                                            ->required()
                                            ->maxLength(220)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                if (blank($get('slug')) && filled($state)) {
                                                    $set('slug', Str::slug($state));
                                                }
                                            }),

                                        Forms\Components\TextInput::make('slug')
                                            ->label('Slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true),

                                        Forms\Components\DatePicker::make('match_date')
                                            ->label('Maç Tarihi')
                                            ->native(false)
                                            ->required(),

                                        Forms\Components\TextInput::make('opponent')
                                            ->label('Rakip Takım')
                                            ->maxLength(255)
                                            ->required(),

                                        Forms\Components\TextInput::make('competition')
                                            ->label('Organizasyon / Lig')
                                            ->maxLength(255),

                                        Forms\Components\Select::make('result')
                                            ->label('Maç Sonucu')
                                            ->options([
                                                'win' => 'Galibiyet',
                                                'draw' => 'Beraberlik',
                                                'loss' => 'Mağlubiyet',
                                            ])
                                            ->native(false)
                                            ->required(),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('score_for')
                                                    ->label('Galatasaray Skoru')
                                                    ->numeric()
                                                    ->default(0),
                                                Forms\Components\TextInput::make('score_against')
                                                    ->label('Rakip Skoru')
                                                    ->numeric()
                                                    ->default(0),
                                            ]),

                                        Forms\Components\Textarea::make('summary')
                                            ->label('Kısa Özet')
                                            ->rows(2)
                                            ->placeholder('Maç hakkında vurucu bir özet...')
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
                                                    ->placeholder('YouTube, Vimeo veya harici bağlantı yapıştırın...')
                                                    ->url()
                                                    ->helperText('Yeni bağlantı mevcut videoyu günceller.'),

                                                Forms\Components\Select::make('existing_video_media_id')
                                                    ->label('Arşivden Video Seç')
                                                    ->placeholder('Önceden yüklenmiş bir video seçin...')
                                                    ->options(fn (?HistoricalMatch $record) => static::getExistingVideoOptions($record))
                                                    ->searchable()
                                                    ->preload()
                                                    ->native(false),

                                                Forms\Components\Toggle::make('remove_video')
                                                    ->label('Videoyu Kaldır')
                                                    ->offIcon('heroicon-m-video-camera')
                                                    ->onIcon('heroicon-m-trash')
                                                    ->onColor('danger'),
                                            ]),

                                        Forms\Components\Placeholder::make('separator')
                                            ->label('')
                                            ->content(new \Illuminate\Support\HtmlString('<div class="h-px bg-gray-200 my-6"></div>'))
                                            ->columnSpanFull(),

                                        // GALLERY
                                        Forms\Components\Group::make()
                                            ->schema([
                                                Forms\Components\View::make('filament.news.gallery-preview')
                                                    ->columnSpanFull(),

                                                Forms\Components\FileUpload::make('gallery_uploads')
                                                    ->label('Yeni Galeri Yükle')
                                                    ->placeholder('Görselleri sürükleyip bırakın')
                                                    ->multiple()
                                                    ->image()
                                                    ->imageEditor()
                                                    ->reorderable()
                                                    ->appendFiles()
                                                    ->storeFiles(false),

                                                Forms\Components\Select::make('existing_gallery_media_ids')
                                                    ->label('Arşivden Görsel Seç')
                                                    ->placeholder('Kütüphaneden görsel ekleyin...')
                                                    ->multiple()
                                                    ->options(fn (?HistoricalMatch $record) => static::getExistingImageOptionsForRecord($record, 'gallery'))
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
                                    ->columns(1),

                                Forms\Components\Section::make('İçeriğe Görsel Ekle')
                                    ->description('Arşivden bir görsel seçtiğinizde otomatik olarak aşağıdaki editörün sonuna eklenir.')
                                    ->schema([
                                        Forms\Components\Select::make('existing_content_media_id')
                                            ->label('Arşivden Görsel Seç')
                                            ->searchable()
                                            ->preload()
                                            ->native(false)
                                            ->dehydrated(false)
                                            ->options(function (): array {
                                                return Media::query()
                                                    ->where('media_kind', 'image')
                                                    ->where('is_active', true)
                                                    ->latest()
                                                    ->limit(100)
                                                    ->get()
                                                    ->mapWithKeys(fn ($m) => [
                                                        $m->id => '#' . $m->id . ' • ' . ($m->original_name ?: basename($m->path))
                                                    ])
                                                    ->toArray();
                                            })
                                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                if (blank($state)) return;
                                                $media = Media::find($state);
                                                if (!$media || empty($media->path)) return;

                                                $url = Storage::disk($media->disk ?: 'public')->url($media->path);
                                                $currentContent = (string) ($get('content') ?? '');
                                                $imageHtml = '<p><img src="' . e($url) . '" alt="' . e($media->original_name ?: basename($media->path)) . '"></p>';

                                                if (!str_contains($currentContent, $url)) {
                                                    $set('content', trim($currentContent . "\n" . $imageHtml));
                                                }
                                                $set('existing_content_media_id', null);
                                            }),
                                    ])
                                    ->collapsible()
                                    ->collapsed(),

                                Forms\Components\Section::make('Maç Hikayesi')
                                    ->schema([
                                        Forms\Components\RichEditor::make('content')
                                            ->label('Detaylı Anlatım')
                                            ->fileAttachmentsDisk('public')
                                            ->fileAttachmentsDirectory('historical-matches-content')
                                            ->columnSpanFull(),
                                    ]),
                            ])
                            ->columnSpan(2),

                        // SIDEBAR (1/3)
                        Forms\Components\Group::make()
                            ->schema([
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
                                            ->label('Öne Çıkarılan Maç'),

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
                                            ->options(fn (?HistoricalMatch $record) => static::getExistingImageOptionsForRecord($record, 'cover'))
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
                                                ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\HistoricalMatchResource\Pages\CreateHistoricalMatch)
                                                ->extraAttributes(['class' => 'w-full']),

                                            Forms\Components\Actions\Action::make('preview_sidebar')
                                                ->label('Önizle')
                                                ->icon('heroicon-m-eye')
                                                ->color('purple')
                                                ->url(fn (HistoricalMatch $record) => URL::temporarySignedRoute(
                                                    'preview.historical-matches.show',
                                                    now()->addMinutes(30),
                                                    ['historicalMatch' => $record->id]
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
                Tables\Columns\TextColumn::make('is_demo')
                    ->label('Tür')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'DEMO' : 'Gerçek')
                    ->color(fn (bool $state): string => $state ? 'warning' : 'success')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('cover')
                    ->label('Görsel')
                    ->disk('public')
                    ->getStateUsing(fn ($record) => optional($record->primaryCoverMedia())->path)
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('match_date')
                    ->label('Tarih')
                    ->date('d.m.Y')
                    ->sortable()
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('opponent')
                    ->label('Rakip')
                    ->searchable()
                    ->sortable()
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('competition')
                    ->label('Organizasyon')
                    ->searchable()
                    ->toggleable()
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('score')
                    ->label('Skor')
                    ->state(function (HistoricalMatch $record): string {
                        return ($record->score_for ?? '-') . ' - ' . ($record->score_against ?? '-');
                    })
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('result')
                    ->label('Sonuç')
                    ->formatStateUsing(function (?string $state): string {
                        return match ($state) {
                            'win' => 'Galibiyet',
                            'draw' => 'Beraberlik',
                            'loss' => 'Mağlubiyet',
                            default => $state ?? '-',
                        };
                    })
                    ->badge(),

                Tables\Columns\TextColumn::make('has_cover')
                    ->label('Kapak')
                    ->state(fn (HistoricalMatch $record): string => $record->hasCoverImage() ? 'Var' : 'Yok')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'Var' ? 'success' : 'gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Öne Çıkan')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Yayında')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Güncellendi')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->extraAttributes(['class' => 'text-xs']),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Öne Çıkan'),

                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Yayında'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->disabled(fn (HistoricalMatch $record) => $record->isDemo()),
                Tables\Actions\DeleteAction::make()
                    ->disabled(fn (HistoricalMatch $record) => $record->isDemo()),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->action(fn (\Illuminate\Database\Eloquent\Collection $records) => $records->reject->isDemo()->each->delete()),
            ])
            ->defaultSort('match_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHistoricalMatches::route('/'),
            'create' => Pages\CreateHistoricalMatch::route('/create'),
            'edit' => Pages\EditHistoricalMatch::route('/{record}/edit'),
        ];
    }

    protected static function getExistingImageOptionsForRecord(?HistoricalMatch $record, string $context = 'gallery'): array
    {
        $recordId = $record?->getKey();

        return \App\Models\Media::query()
            ->where('media_kind', 'image')
            ->where('is_active', true)
            ->latest()
            ->limit(100)
            ->get()
            ->mapWithKeys(function ($m) use ($recordId, $context) {
                $isUsedInCurrent = false;
                if ($recordId) {
                    $isUsedInCurrent = \Illuminate\Support\Facades\DB::table('mediaables')
                        ->where('media_id', $m->id)
                        ->where('mediable_type', HistoricalMatch::class)
                        ->where('mediable_id', $recordId)
                        ->where('usage_type', $context)
                        ->exists();
                }

                $prefix = $isUsedInCurrent ? '★ ' : '';
                return [$m->id => $prefix . ($m->original_name ?: basename($m->path))];
            })
            ->toArray();
    }

    protected static function getExistingVideoOptions(?HistoricalMatch $record): array
    {
        return Media::query()
            ->where('media_kind', 'embed')
            ->where('is_active', true)
            ->latest()
            ->limit(50)
            ->get()
            ->mapWithKeys(fn ($m) => [
                $m->id => '#' . $m->id . ' • ' . ($m->embed_provider ?: 'video') . ' • ' . ($m->original_name ?: $m->embed_url)
            ])
            ->toArray();
    }
}
