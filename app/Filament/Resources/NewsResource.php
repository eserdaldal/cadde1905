<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\Media;
use App\Models\News;
use App\Services\SiteModeService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;
    public const DUPLICATE_LOOKBACK_DAYS = 7;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'İçerik';
    protected static ?string $navigationLabel = 'Haberler';
    protected static ?string $modelLabel = 'Haber';
    protected static ?string $pluralModelLabel = 'Haberler';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->disabled(fn (?News $record) => $record?->isDemo() ?? false)
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        // ANA İÇERİK (2/3)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Haber İçeriği')
                                    ->description('Başlık, özet ve ana metin detayları.')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Haber Başlığı')
                                            ->placeholder('Çarpıcı bir başlık yazın...')
                                            ->required()
                                            ->maxLength(200)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                                        Forms\Components\TextInput::make('slug')
                                            ->label('Bağlantı (Slug)')
                                            ->required()
                                            ->maxLength(220)
                                            ->live(onBlur: true)
                                            ->unique(ignoreRecord: true),

                                        Forms\Components\Placeholder::make('duplicate_check')
                                            ->label('')
                                            ->hidden(function (\Filament\Forms\Get $get, ?News $record) {
                                                $title = (string) $get('title');
                                                // Min 8 karakter kontrolü
                                                if (mb_strlen($title) < 8) return true;
                                                return false;
                                            })
                                            ->content(function (\Filament\Forms\Get $get, ?News $record) {
                                                $title = (string) $get('title');
                                                $slug = (string) $get('slug');
                                                
                                                if (mb_strlen($title) < 8) return null;
                                                
                                                // DB Sorgusu (Yapılandırılabilir Lookback Period veya exact slug catch)
                                                // Performansı korumak için LIKE kullanılmaz.
                                                $records = News::query()
                                                    ->select('id', 'title', 'slug', 'status', 'published_at', 'created_at')
                                                    ->when($record, fn ($q) => $q->where('id', '!=', $record->id))
                                                    ->where(function($q) use ($slug) {
                                                        $q->where('created_at', '>=', now()->subDays(self::DUPLICATE_LOOKBACK_DAYS))
                                                          ->orWhere('slug', $slug);
                                                    })
                                                    ->latest()
                                                    ->take(50)
                                                    ->get();
                                                    
                                                $searchTokens = \App\Support\Text\TitleNormalizer::getTokens($title);
                                                $searchTokenCount = count($searchTokens);
                                                $searchNormalizedTitle = \App\Support\Text\TitleNormalizer::normalize($title);
                                                
                                                $similar = [];
                                                $hasExactDuplicate = false;
                                                
                                                foreach ($records as $item) {
                                                    $itemNormalizedTitle = \App\Support\Text\TitleNormalizer::normalize($item->title);
                                                    
                                                    // 1) Slug eşleşmesi VEYA tamamen aynı normalize edilmiş başlık
                                                    $isExactSlug = ($slug !== '' && $item->slug === $slug);
                                                    $isExactTitle = ($searchNormalizedTitle !== '' && $itemNormalizedTitle === $searchNormalizedTitle);
                                                    
                                                    if ($isExactSlug || $isExactTitle) {
                                                        $item->similarity_score = 1.0;
                                                        $item->is_exact = true;
                                                        $similar[] = $item;
                                                        $hasExactDuplicate = true;
                                                        continue;
                                                    }
                                                    
                                                    if ($searchTokenCount === 0) continue;
                                                    
                                                    // 2) Token benzerliği
                                                    $itemTokens = \App\Support\Text\TitleNormalizer::getTokens($item->title);
                                                    $intersection = array_intersect($searchTokens, $itemTokens);
                                                    $commonCount = count($intersection);
                                                    
                                                    $score = $commonCount / max(1, $searchTokenCount);
                                                    
                                                    // Minimum 2 kelime eşleşmesi veya oran >= 0.4
                                                    if ($commonCount >= 2 && $score >= 0.4) {
                                                        $item->similarity_score = $score;
                                                        $item->is_exact = false;
                                                        $similar[] = $item;
                                                    }
                                                }
                                                
                                                // Sort by similarity_score DESC
                                                usort($similar, function($a, $b) {
                                                    return $b->similarity_score <=> $a->similarity_score;
                                                });
                                                
                                                if (count($similar) === 0) {
                                                    return null; // Arayüzde hiçbir şey gösterme
                                                }
                                                
                                                return view('filament.forms.components.duplicate-news-alert', [
                                                    'similar' => $similar,
                                                    'hasExactDuplicate' => $hasExactDuplicate,
                                                    'searchTokens' => $searchTokens,
                                                ]);
                                            })
                                            ->columnSpanFull(),

                                        Forms\Components\Textarea::make('summary')
                                            ->label('Özet Cümle')
                                            ->placeholder('Okuyucuyu içeriğe davet eden kısa bir giriş...')
                                            ->rows(3),

                                        Forms\Components\RichEditor::make('content')
                                            ->label('Haber İçeriği')
                                            ->placeholder('Haberin tüm detaylarını buraya girebilirsiniz...')
                                            ->fileAttachmentsDisk('public')
                                            ->fileAttachmentsDirectory('news-content')
                                            ->required()
                                            ->columnSpanFull()
                                            ->extraAttributes(['class' => 'shadow-none border-gray-200']),
                                    ])
                                    ->columns(1),

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
                                                    ->options(fn (?News $record) => static::getExistingVideoOptions($record))
                                                    ->searchable()
                                                    ->preload()
                                                    ->native(false),
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

                                                Forms\Components\FileUpload::make('gallery_upload')
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
                                                    ->options(fn (?News $record) => static::getExistingGalleryOptions($record))
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
                            ])
                            ->columnSpan(2),

                        // SIDEBAR (1/3)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Yayın Ayarları')
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\Select::make('status')
                                            ->label('Durum')
                                            ->options([
                                                News::STATUS_DRAFT => 'Taslak',
                                                News::STATUS_PUBLISHED => 'Yayında',
                                                News::STATUS_IN_REVIEW => 'İncelemede',
                                            ])
                                            ->required()
                                            ->native(false),

                                        Forms\Components\DateTimePicker::make('published_at')
                                            ->label('Yayın Tarihi')
                                            ->default(now()),

                                        Forms\Components\Toggle::make('is_featured')
                                            ->label('Öne Çıkarılan Haber')
                                            ->default(false),

                                        Forms\Components\Toggle::make('is_demo')
                                            ->label('Demo İçerik')
                                            ->helperText('Ghost modda demo içerikler görünür. Live modda gizlenir.')
                                            ->default(fn () => SiteModeService::isGhost()),
                                    ]),

                                Forms\Components\Section::make('Sınıflandırma')
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\Select::make('category_id')
                                            ->label('Kategori')
                                            ->placeholder('Kategori seçiniz...')
                                            ->relationship('category', 'name')
                                            ->required()
                                            ->searchable()
                                            ->preload()
                                            ->native(false),

                                        Forms\Components\Select::make('tags')
                                            ->label('Etiketler')
                                            ->placeholder('Etiket seçiniz...')
                                            ->relationship('tags', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Etiket Adı')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                                                Forms\Components\TextInput::make('slug')
                                                    ->label('Slug')
                                                    ->required()
                                                    ->unique('tags', 'slug'),
                                                Forms\Components\Select::make('type')
                                                    ->label('Tip')
                                                    ->options([
                                                        'general' => 'Genel',
                                                        'person' => 'Kişi',
                                                        'tournament' => 'Turnuva',
                                                    ])
                                                    ->default('general')
                                                    ->required(),
                                            ])
                                            ->native(false),

                                        Forms\Components\Select::make('author_user_id')
                                            ->label('Yazar')
                                            ->placeholder('Yazar seçiniz...')
                                            ->relationship('author', 'name')
                                            ->default(auth()->id())
                                            ->required()
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
                                            ->label('Arşivden Kapak Seç')
                                            ->placeholder('Seçiniz...')
                                            ->options(fn (?News $record) => static::getExistingCoverOptions($record))
                                            ->searchable()
                                            ->preload()
                                            ->native(false),

                                        Forms\Components\Toggle::make('remove_cover')
                                            ->label('Mevcut Kapağı Kaldır')
                                            ->offIcon('heroicon-m-photo')
                                            ->onIcon('heroicon-m-trash')
                                            ->onColor('danger'),

                                        Forms\Components\Toggle::make('watermark_enabled')
                                            ->label('Watermark Uygula')
                                            ->helperText('Kapak görselinin sağ alt köşesine kulüp logosunu ekler.')
                                            ->default(false),
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
                                                ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\NewsResource\Pages\CreateNews)
                                                ->extraAttributes(['class' => 'w-full']),

                                            Forms\Components\Actions\Action::make('preview_sidebar')
                                                ->label('Önizle')
                                                ->icon('heroicon-m-eye')
                                                ->color('purple')
                                                ->url(fn (News $record) => route('news.show', ['slug' => $record->slug]))
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
                Tables\Columns\ImageColumn::make('cover')
                    ->label('Kapak')
                    ->disk('public')
                    ->getStateUsing(function (News $record): ?string {
                        $primary = $record->primaryCover()->first();

                        if ($primary && ! empty($primary->path)) {
                            return $primary->path;
                        }

                        return null;
                    })
                    ->square()
                    ->size(45),

                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(60)
                    ->description(fn (News $record): string => Str::limit((string)$record->summary, 40)),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        News::STATUS_DRAFT => 'gray',
                        News::STATUS_PUBLISHED => 'success',
                        News::STATUS_IN_REVIEW => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        News::STATUS_DRAFT => 'Taslak',
                        News::STATUS_PUBLISHED => 'Yayında',
                        News::STATUS_IN_REVIEW => 'İncelemede',
                        default => $state,
                    }),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Vitrinde')
                    ->boolean()
                    ->trueIcon('heroicon-s-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->sortable(),

                Tables\Columns\TextColumn::make('is_demo')
                    ->label('Tür')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'DEMO' : 'Gerçek')
                    ->color(fn (bool $state): string => $state ? 'warning' : 'success')
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Yayın Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('author.name')
                    ->label('Yazar')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Durum')
                    ->options([
                        News::STATUS_DRAFT => 'Taslak',
                        News::STATUS_PUBLISHED => 'Yayında',
                        News::STATUS_IN_REVIEW => 'İncelemede',
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Düzenle')
                    ->icon('heroicon-m-pencil-square'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Seçilenleri Sil')
                        ->action(fn (\Illuminate\Database\Eloquent\Collection $records) => $records->reject->isDemo()->each->delete()),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }

    protected static function getExistingCoverOptions(?News $record): array
    {
        return Media::query()
            ->where('media_kind', 'image')
            ->where('is_active', true)
            ->latest()
            ->limit(100)
            ->get()
            ->mapWithKeys(fn ($m) => [$m->id => '#' . $m->id . ' • ' . ($m->original_name ?: basename((string)$m->path))])
            ->toArray();
    }

    protected static function getExistingGalleryOptions(?News $record): array
    {
        return Media::query()
            ->where('media_kind', 'image')
            ->where('is_active', true)
            ->latest()
            ->limit(100)
            ->get()
            ->mapWithKeys(fn ($m) => [$m->id => '#' . $m->id . ' • ' . ($m->original_name ?: basename((string)$m->path))])
            ->toArray();
    }

    protected static function getExistingVideoOptions(?News $record): array
    {
        return Media::query()
            ->where('media_kind', 'embed')
            ->where('is_active', true)
            ->latest()
            ->limit(50)
            ->get()
            ->mapWithKeys(fn ($m) => [$m->id => '#' . $m->id . ' • ' . ($m->embed_provider ?: 'video') . ' • ' . ($m->original_name ?: $m->embed_url)])
            ->toArray();
    }
}
