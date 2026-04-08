<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeasonArchiveResource\Pages;
use App\Models\Media;
use App\Models\SeasonArchive;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use App\Services\SiteModeService;

class SeasonArchiveResource extends Resource
{
    protected static ?string $model = SeasonArchive::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Miras';
    protected static ?string $navigationLabel = 'Sezon Arşivi';
    protected static ?string $modelLabel = 'Sezon';
    protected static ?string $pluralModelLabel = 'Sezon Arşivi';
    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form
            ->disabled(fn (?SeasonArchive $record) => $record?->isDemo() ?? false)
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        // MAIN CONTENT (2/3)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Sezon Bilgileri')
                                    ->description('Sezonun başlığı, dönemi ve kısa özeti.')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Başlık')
                                            ->required()
                                            ->maxLength(200)
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

                                        Forms\Components\TextInput::make('season_label')
                                            ->label('Sezon Etiketi')
                                            ->placeholder('Örn: 2023-2024')
                                            ->maxLength(50),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('start_year')
                                                    ->label('Başlangıç Yılı')
                                                    ->numeric()
                                                    ->minValue(1900),
                                                Forms\Components\TextInput::make('end_year')
                                                    ->label('Bitiş Yılı')
                                                    ->numeric()
                                                    ->minValue(1900),
                                            ]),

                                        Forms\Components\Textarea::make('summary')
                                            ->label('Sezon Özeti (Kısa)')
                                            ->rows(2)
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
                                                    ->options(fn (?SeasonArchive $record) => static::getExistingVideoOptions($record))
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
                                                    ->options(fn (?SeasonArchive $record) => static::getExistingImageOptionsForRecord($record, 'gallery'))
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

                                Forms\Components\Section::make('Detaylı Arşiv İçeriği')
                                    ->schema([
                                        Forms\Components\RichEditor::make('content')
                                            ->label('Ana İçerik')
                                            ->fileAttachmentsDisk('public')
                                            ->fileAttachmentsDirectory('season-archives-content')
                                            ->columnSpanFull(),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\Textarea::make('season_overview')
                                                    ->label('Genel Bakış')
                                                    ->rows(3),
                                                Forms\Components\Textarea::make('league_summary')
                                                    ->label('Lig Performansı')
                                                    ->rows(3),
                                                Forms\Components\Textarea::make('europe_summary')
                                                    ->label('Avrupa Kupaları')
                                                    ->rows(3),
                                                Forms\Components\Textarea::make('cup_summary')
                                                    ->label('Türkiye Kupası')
                                                    ->rows(3),
                                            ]),

                                        Forms\Components\TextInput::make('manager_name')
                                            ->label('Dönemin Teknik Direktörü')
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-m-user'),
                                    ]),

                                Forms\Components\Section::make('İçeriğe Görsel Ekle')
                                    ->description('Arşivden bir görsel seçtiğinizde otomatik olarak ana içerik editörüne eklenir.')
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
                            ])
                            ->columnSpan(2),

                        // SIDEBAR (1/3)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Yayın Durumu')
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\Toggle::make('is_published')
                                            ->label('Yayında')
                                            ->default(true),

                                        Forms\Components\TextInput::make('importance_score')
                                            ->label('Önem Skoru')
                                            ->numeric()
                                            ->default(0),

                                        Forms\Components\Toggle::make('is_featured')
                                            ->label('Öne Çıkarılan Sezon'),

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
                                            ->options(fn (?SeasonArchive $record) => static::getExistingImageOptionsForRecord($record, 'cover'))
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
                                                ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\SeasonArchiveResource\Pages\CreateSeasonArchive)
                                                ->extraAttributes(['class' => 'w-full']),

                                            Forms\Components\Actions\Action::make('preview_sidebar')
                                                ->label('Önizle')
                                                ->icon('heroicon-m-eye')
                                                ->color('purple')
                                                ->url(fn (SeasonArchive $record) => URL::temporarySignedRoute(
                                                    'preview.season-archives.show',
                                                    now()->addMinutes(30),
                                                    ['seasonArchive' => $record->id]
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
                    ->sortable(),

                Tables\Columns\TextColumn::make('season_label')
                    ->label('Sezon')
                    ->sortable(),

                Tables\Columns\TextColumn::make('years')
                    ->label('Yıllar')
                    ->state(function (SeasonArchive $record): string {
                        if ($record->start_year || $record->end_year) {
                            return ($record->start_year ?: '?') . ' - ' . ($record->end_year ?: '?');
                        }

                        return '-';
                    }),

                Tables\Columns\TextColumn::make('has_cover')
                    ->label('Kapak')
                    ->state(fn (SeasonArchive $record): string => $record->hasCoverImage() ? 'Var' : 'Yok')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'Var' ? 'success' : 'gray'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Öne Çıkan')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Yayında')
                    ->boolean(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Güncellendi')
                    ->since()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->disabled(fn (SeasonArchive $record) => $record->isDemo()),
                Tables\Actions\DeleteAction::make()
                    ->disabled(fn (SeasonArchive $record) => $record->isDemo()),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->action(fn (\Illuminate\Database\Eloquent\Collection $records) => $records->reject->isDemo()->each->delete()),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeasonArchives::route('/'),
            'create' => Pages\CreateSeasonArchive::route('/create'),
            'edit' => Pages\EditSeasonArchive::route('/{record}/edit'),
        ];
    }

    protected static function getExistingImageOptionsForRecord(?SeasonArchive $record, string $context = 'gallery'): array
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
                        ->where('mediable_type', SeasonArchive::class)
                        ->where('mediable_id', $recordId)
                        ->where('usage_type', $context)
                        ->exists();
                }

                $prefix = $isUsedInCurrent ? '★ ' : '';
                return [$m->id => $prefix . ($m->original_name ?: basename($m->path))];
            })
            ->toArray();
    }

    protected static function getExistingVideoOptions(?SeasonArchive $record): array
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
