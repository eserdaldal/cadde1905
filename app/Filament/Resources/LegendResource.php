<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LegendResource\Pages;
use App\Models\Legend;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Services\SiteModeService;

class LegendResource extends Resource
{
    protected static ?string $model = Legend::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Miras';
    protected static ?string $navigationLabel = 'Efsaneler';
    protected static ?string $modelLabel = 'Efsane';
    protected static ?string $pluralModelLabel = 'Efsaneler';
    protected static ?int $navigationSort = 40;

    public static function shouldRegisterNavigation(): bool
    {
        $user = Auth::user();

        return (bool) ($user?->isSuperAdmin() || $user?->isAdmin() || $user?->isEditor());
    }

    public static function canViewAny(): bool
    {
        $user = Auth::user();

        return (bool) ($user?->isSuperAdmin() || $user?->isAdmin() || $user?->isEditor());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->disabled(fn (?Legend $record) => $record?->isDemo() ?? false)
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        // MAIN CONTENT (2/3)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Temel Bilgiler')
                                    ->description('Efsaneye ait ana metin ve özet bilgileri.')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('İsim')
                                            ->required()
                                            ->maxLength(160)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                if (blank($get('slug')) && filled($state)) {
                                                    $set('slug', Str::slug($state));
                                                }
                                            }),

                                        Forms\Components\TextInput::make('slug')
                                            ->label('Slug')
                                            ->required()
                                            ->maxLength(180)
                                            ->unique(ignoreRecord: true),

                                        Forms\Components\TextInput::make('title')
                                            ->label('Unvan / Kısa Başlık')
                                            ->maxLength(200),

                                        Forms\Components\Textarea::make('summary')
                                            ->label('Özet')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('İçerik')
                                    ->description('Bu alanda metin ve içerik içi görseller yer alır.')
                                    ->schema([
                                        RichEditor::make('content')
                                            ->label('Detay İçerik')
                                            ->helperText('Editör içinden yeni görsel yükleyebilir veya medya merkezinden seçtiğin görselleri burada kullanabilirsin.')
                                            ->fileAttachmentsDisk('public')
                                            ->fileAttachmentsDirectory('editor-content')
                                            ->fileAttachmentsVisibility('public')
                                            ->toolbarButtons([
                                                'attachFiles',
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'codeBlock',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),
                                    ]),

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
                                                    ->options(fn (?Legend $record) => static::getExistingVideoOptions($record))
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
                                                    ->options(fn (?Legend $record) => static::getExistingImageOptionsForRecord($record, 'gallery'))
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
                                Forms\Components\Section::make('Dönem Bilgisi')
                                    ->description('Efsanenin aktif olduğu yıllar.')
                                    ->schema([
                                        Forms\Components\TextInput::make(name: 'era_start_year')
                                            ->label('Başlangıç Yılı')
                                            ->numeric()
                                            ->minValue(1800)
                                            ->maxValue(2100),

                                        Forms\Components\TextInput::make('era_end_year')
                                            ->label('Bitiş Yılı')
                                            ->numeric()
                                            ->minValue(1800)
                                            ->maxValue(2100),
                                    ])
                                    ->columns(1),

                                Forms\Components\Section::make('Yayın & Önem')
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\Toggle::make('is_published')
                                            ->label('Yayında')
                                            ->default(false),

                                        Forms\Components\DateTimePicker::make('published_at')
                                            ->label('Yayın Zamanı'),

                                        Forms\Components\TextInput::make('importance_score')
                                            ->label('Önem Skoru')
                                            ->numeric()
                                            ->default(0),

                                        Forms\Components\Toggle::make('is_featured')
                                            ->label('Öne Çıkarılan Efsane'),

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
                                            ->placeholder('Seçiniz...')
                                            ->options(function (): array {
                                                return Media::query()
                                                    ->where('media_kind', 'image')
                                                    ->where('is_active', true)
                                                    ->latest()
                                                    ->limit(200)
                                                    ->get()
                                                    ->mapWithKeys(fn ($m) => [
                                                        $m->id => '#' . $m->id . ' • ' . ($m->original_name ?: basename($m->path))
                                                    ])
                                                    ->toArray();
                                            })
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
                                                ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\LegendResource\Pages\CreateLegend)
                                                ->extraAttributes(['class' => 'w-full']),

                                            Forms\Components\Actions\Action::make('preview_sidebar')
                                                ->label('Önizle')
                                                ->icon('heroicon-m-eye')
                                                ->color('purple')
                                                ->url(fn (Legend $record) => URL::temporarySignedRoute(
                                                    'preview.legends.show',
                                                    now()->addMinutes(30),
                                                    ['legend' => $record->id]
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

                Tables\Columns\TextColumn::make('name')
                    ->label('İsim')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Unvan')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('era_start_year')
                    ->label('Başlangıç')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('era_end_year')
                    ->label('Bitiş')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('has_cover')
                    ->label('Kapak')
                    ->state(fn (Legend $record): string => $record->hasCoverImage() ? 'Var' : 'Yok')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'Var' ? 'success' : 'gray'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Güncellendi')
                    ->since()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->disabled(fn (Legend $record) => $record->isDemo()),
                Tables\Actions\DeleteAction::make()
                    ->disabled(fn (Legend $record) => $record->isDemo()),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->action(fn (\Illuminate\Database\Eloquent\Collection $records) => $records->reject->isDemo()->each->delete()),
            ])
            ->defaultSort('name');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLegends::route('/'),
            'create' => Pages\CreateLegend::route('/create'),
            'edit' => Pages\EditLegend::route('/{record}/edit'),
        ];
    }

    protected static function getExistingImageOptionsForRecord(?Legend $record, string $context = 'gallery'): array
    {
        $recordId = $record?->getKey();

        return Media::query()
            ->where('media_kind', 'image')
            ->where('is_active', true)
            ->latest()
            ->limit(100)
            ->get()
            ->mapWithKeys(function ($m) use ($recordId, $context) {
                $isUsedInCurrent = false;
                if ($recordId) {
                    $isUsedInCurrent = DB::table('mediaables')
                        ->where('media_id', $m->id)
                        ->where('mediable_type', Legend::class)
                        ->where('mediable_id', $recordId)
                        ->where('usage_type', $context)
                        ->exists();
                }

                $prefix = $isUsedInCurrent ? '★ ' : '';
                return [$m->id => $prefix . ($m->original_name ?: basename($m->path))];
            })
            ->toArray();
    }

    protected static function getExistingVideoOptions(?Legend $record): array
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
