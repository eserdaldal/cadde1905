<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomepageHeroOverrideResource\Pages;
use App\Models\HomepageHeroOverride;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class HomepageHeroOverrideResource extends Resource
{
    protected static ?string $model = HomepageHeroOverride::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'İçerik';
    protected static ?string $navigationLabel = 'Hero Yönetimi';
    protected static ?string $modelLabel = 'Hero Override';
    protected static ?string $pluralModelLabel = 'Hero Yönetimi';
    protected static ?int $navigationSort = 5;

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
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        // MAIN CONTENT (2/3)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Hero İçeriği')
                                    ->description('Anasayfa hero alanında öne çıkarılacak haberi seçin.')
                                    ->schema([
                                        Forms\Components\Select::make('item_id')
                                            ->label('Yayındaki Haber')
                                            ->options(
                                                News::query()
                                                    ->where('status', 'published')
                                                    ->whereNull('deleted_at')
                                                    ->orderByDesc('published_at')
                                                    ->orderByDesc('id')
                                                    ->pluck('title', 'id')
                                            )
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->live()
                                            ->helperText('Yalnızca yayındaki haberlerden seçim yapılabilir.'),

                                        Forms\Components\Placeholder::make('selected_news_preview')
                                            ->label('İçerik Önizlemesi')
                                            ->content(function (callable $get): HtmlString|string {
                                                $itemId = (int) ($get('item_id') ?? 0);

                                                if ($itemId <= 0) {
                                                    return 'Henüz içerik seçilmedi.';
                                                }

                                                $news = News::query()->find($itemId);

                                                if (! $news) {
                                                    return 'Seçilen içerik bulunamadı.';
                                                }

                                                $coverUrl = null;

                                                if (method_exists($news, 'coverImageUrl')) {
                                                    $resolved = $news->coverImageUrl();
                                                    if (! empty($resolved)) {
                                                        $coverUrl = $resolved;
                                                    }
                                                }

                                                if ($coverUrl === null && method_exists($news, 'coverMedia')) {
                                                    $media = $news->coverMedia()
                                                        ->orderByDesc('mediaables.is_primary')
                                                        ->orderBy('mediaables.sort_order')
                                                        ->orderByDesc('mediaables.id')
                                                        ->first();

                                                    if ($media && ! empty($media->url)) {
                                                        $coverUrl = $media->url;
                                                    } elseif ($media && ! empty($media->path)) {
                                                        $coverUrl = asset('storage/' . ltrim($media->path, '/'));
                                                    }
                                                }

                                                $newsUrl = route('news.show', ['slug' => $news->slug]);

                                                $statusBadge = match ($news->status) {
                                                    News::STATUS_PUBLISHED => '<span style="display:inline-block;padding:4px 8px;border-radius:999px;background:#166534;color:#fff;font-size:12px;">Yayında</span>',
                                                    News::STATUS_IN_REVIEW => '<span style="display:inline-block;padding:4px 8px;border-radius:999px;background:#92400e;color:#fff;font-size:12px;">İncelemede</span>',
                                                    default => '<span style="display:inline-block;padding:4px 8px;border-radius:999px;background:#374151;color:#fff;font-size:12px;">Taslak</span>',
                                                };

                                                $warning = '';

                                                $resolvedCover = $coverUrl;

                                                if (! $resolvedCover) {
                                                    $warning = '<div style="margin-top:10px;padding:10px 12px;border-radius:8px;background:#fff1f2;color:#9f1239;font-size:12px;border:1px solid #fecdd3;">'
                                                        . 'Uyarı: Bu içerikte kapak görseli yok. Hero alanında görsel boş veya zayıf görünebilir.'
                                                        . '</div>';
                                                }

                                                $html = '<div style="display:flex;flex-direction:column;gap:12px;padding:12px;border:1px solid #e9e2d8;border-radius:10px;background:#fffdf9;">';

                                                if ($coverUrl) {
                                                    $html .= '<img src="' . e($coverUrl) . '" alt="' . e($news->title) . '" style="width:100%;max-width:360px;height:200px;object-fit:cover;border-radius:8px;border:1px solid #333;" />';
                                                }

                                                $html .= '<div style="display:flex;flex-direction:column;gap:8px;">';
                                                $html .= '<div>' . $statusBadge . '</div>';
                                                $html .= '<div style="font-size:16px;font-weight:700;color:#2f2a24;">' . e($news->title) . '</div>';
                                                $html .= '<div style="font-size:12px;color:#6f6559;">ID: ' . e((string) $news->id) . ' | Slug: ' . e((string) $news->slug) . '</div>';
                                                $html .= '<div style="font-size:12px;color:#6f6559;">Yayın Tarihi: ' . e(optional($news->published_at)->format('d.m.Y H:i') ?: '-') . '</div>';
                                                $html .= '<div style="font-size:12px;"><a href="' . e($newsUrl) . '" target="_blank" rel="noopener noreferrer" style="color:#A91D35;text-decoration:underline;font-weight:700;">Haberi yeni sekmede aç</a></div>';
                                                $html .= $warning;
                                                $html .= '</div>';
                                                $html .= '</div>';

                                                return new HtmlString($html);
                                            })
                                            ->columnSpanFull(),
                                    ]),
                            ])
                            ->columnSpan(2),

                        // SIDEBAR (1/3)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Zamanlama & Durum')
                                    ->schema([
                                        Forms\Components\DateTimePicker::make('starts_at')
                                            ->label('Başlangıç')
                                            ->nullable()
                                            ->helperText('Boşsa hemen devreye girer.'),

                                        Forms\Components\DateTimePicker::make('ends_at')
                                            ->label('Bitiş')
                                            ->required()
                                            ->helperText('Bitiş zamanı zorunludur.'),

                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Aktif')
                                            ->default(true),

                                        Forms\Components\Textarea::make('notes')
                                            ->label('Dahili Notlar')
                                            ->rows(3)
                                            ->maxLength(255),
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
                                                ->visible(fn ($livewire) => $livewire instanceof \App\Filament\Resources\HomepageHeroOverrideResource\Pages\CreateHomepageHeroOverride)
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
                                    ->extraAttributes(['class' => 'border-none shadow-none']),
                            ])
                            ->columnSpan(1),
                    ])
                    ->extraAttributes(['class' => 'gap-y-6']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('item_id')
                    ->label('İçerik')
                    ->formatStateUsing(function ($state): string {
                        $news = News::query()->find((int) $state);

                        if (! $news) {
                            return 'Bulunamadı (ID: ' . $state . ')';
                        }

                        return $news->title . ' (ID: ' . $news->id . ')';
                    })
                    ->searchable(query: function ($query, string $search) {
                        $matchingIds = News::query()
                            ->where('title', 'like', '%' . $search . '%')
                            ->orWhere('id', is_numeric($search) ? (int) $search : 0)
                            ->pluck('id')
                            ->all();

                        if (empty($matchingIds)) {
                            $query->whereRaw('1 = 0');
                            return;
                        }

                        $query->whereIn('item_id', $matchingIds);
                    })
                    ->wrap(),

                Tables\Columns\IconColumn::make('item_cover')
                    ->label('Görsel')
                    ->state(function (HomepageHeroOverride $record): bool {
                        $news = News::query()->find((int) $record->item_id);

                        if (! $news) {
                            return false;
                        }

                        if (method_exists($news, 'coverImageUrl')) {
                            $resolved = $news->coverImageUrl();
                            if (! empty($resolved)) {
                                return true;
                            }
                        }

                        if (method_exists($news, 'coverMedia')) {
                            $media = $news->coverMedia()
                                ->orderByDesc('mediaables.is_primary')
                                ->orderBy('mediaables.sort_order')
                                ->orderByDesc('mediaables.id')
                                ->first();

                            if ($media && (! empty($media->url) || ! empty($media->path))) {
                                return true;
                            }
                        }

                        return false;
                    })
                    ->boolean(),

                Tables\Columns\TextColumn::make('current_status')
                    ->label('Durum')
                    ->badge()
                    ->color(function (HomepageHeroOverride $record): string {
                        $now = now();

                        if (! $record->is_active) {
                            return 'gray';
                        }

                        if ($record->starts_at && $record->starts_at > $now) {
                            return 'warning';
                        }

                        if ($record->ends_at <= $now) {
                            return 'danger';
                        }

                        return 'success';
                    })
                    ->formatStateUsing(function (HomepageHeroOverride $record): string {
                        $now = now();

                        if (! $record->is_active) {
                            return 'Pasif';
                        }

                        if ($record->starts_at && $record->starts_at > $now) {
                            return 'Zamanı gelmedi';
                        }

                        if ($record->ends_at <= $now) {
                            return 'Süresi doldu';
                        }

                        return 'Yayında';
                    }),

                Tables\Columns\TextColumn::make('starts_at')
                    ->label('Başlangıç')
                    ->dateTime('d.m.Y H:i')
                    ->placeholder('Hemen')
                    ->sortable(),

                Tables\Columns\TextColumn::make('ends_at')
                    ->label('Bitiş')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_by')
                    ->label('Oluşturan')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('notes')
                    ->label('Not')
                    ->limit(40)
                    ->tooltip(fn ($state) => $state)
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Aktif durumu'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Düzenle'),
                Tables\Actions\DeleteAction::make()
                    ->label('Sil'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Hero override kaydı yok')
            ->emptyStateDescription('Yeni bir hero override kaydı oluşturarak anasayfa hero alanını manuel yönetebilirsin.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomepageHeroOverrides::route('/'),
            'create' => Pages\CreateHomepageHeroOverride::route('/create'),
            'edit' => Pages\EditHomepageHeroOverride::route('/{record}/edit'),
        ];
    }
}
