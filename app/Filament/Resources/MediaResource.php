<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Models\HistoryEvent;
use App\Models\Media;
use App\Models\News;
use App\Services\Media\MediaUsageService;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use RuntimeException;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'İçerik';
    protected static ?string $navigationLabel = 'Medya Kütüphanesi';
    protected static ?string $modelLabel = 'Medya';
    protected static ?string $pluralModelLabel = 'Medya Kütüphanesi';
    protected static ?int $navigationSort = 90;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount('usages')
            ->addSelect('media.*')
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
            );
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Section::make('Medya Önizleme')
                    ->description('Dosyanın görsel veya gömülü içerik görünümü')
                    ->schema([
                        ViewEntry::make('preview')
                            ->label('')
                            ->view('filament.infolists.media-preview')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                \Filament\Infolists\Components\Grid::make(2)
                    ->schema([
                        \Filament\Infolists\Components\Section::make('Genel Bilgiler')
                            ->schema([
                                TextEntry::make('id')
                                    ->label('ID')
                                    ->badge()
                                    ->color('gray'),

                                TextEntry::make('media_kind')
                                    ->label('Medya Türü')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'image' => 'success',
                                        'embed' => 'info',
                                        'video' => 'warning',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'image' => 'Görsel',
                                        'embed' => 'Dış İçerik',
                                        'video' => 'Video',
                                        default => $state,
                                    }),

                                TextEntry::make('storage_type')
                                    ->label('Depolama')
                                    ->badge()
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'file' => 'Dosya',
                                        'external' => 'Harici',
                                        default => $state,
                                    }),

                                TextEntry::make('original_name')
                                    ->label('Orijinal Ad')
                                    ->placeholder('-'),

                                TextEntry::make('created_at')
                                    ->label('Oluşturulma')
                                    ->dateTime('d.m.Y H:i'),

                                TextEntry::make('updated_at')
                                    ->label('Güncellenme')
                                    ->dateTime('d.m.Y H:i'),
                            ])
                            ->columnSpan(1),

                        \Filament\Infolists\Components\Section::make('Teknik Detaylar')
                            ->schema([
                                TextEntry::make('mime_type')
                                    ->label('MIME Tipi')
                                    ->placeholder('-'),

                                TextEntry::make('extension')
                                    ->label('Uzantı')
                                    ->placeholder('-'),

                                TextEntry::make('size')
                                    ->label('Dosya Boyutu')
                                    ->formatStateUsing(fn ($state): string => filled($state) ? number_format((int) $state / 1024, 2) . ' KB' : '-'),

                                TextEntry::make('disk')
                                    ->label('Disk Bölümü')
                                    ->placeholder('-'),

                                TextEntry::make('path')
                                    ->label('Dosya Yolu')
                                    ->placeholder('-')
                                    ->copyable()
                                    ->limit(40),

                                TextEntry::make('embed_provider')
                                    ->label('Sağlayıcı')
                                    ->placeholder('-')
                                    ->visible(fn (Media $record) => $record->media_kind === 'embed'),
                            ])
                            ->columnSpan(1),
                    ]),

                \Filament\Infolists\Components\Section::make('Kullanım Bilgileri')
                    ->description('Bu medyanın hangi içeriklerde kullanıldığına dair özet')
                    ->schema([
                        \Filament\Infolists\Components\Split::make([
                            TextEntry::make('usage_status')
                                ->label('Durum')
                                ->state(function (Media $record): string {
                                    /** @var MediaUsageService $usageService */
                                    $usageService = app(MediaUsageService::class);
                                    return $usageService->getUsageStatus($record->id);
                                })
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'kullanılmıyor' => 'warning',
                                    'tek kullanım' => 'info',
                                    'paylaşımlı kullanım' => 'success',
                                    default => 'gray',
                                }),

                            TextEntry::make('usages_count')
                                ->label('Toplam Kullanım Sayısı')
                                ->badge()
                                ->color('gray'),
                        ])->grow(false),

                        TextEntry::make('usage_summary')
                            ->label('Kullanıldığı Yerler')
                            ->formatStateUsing(function ($state): HtmlString|string {
                                if (blank($state)) {
                                    return '-';
                                }
                                return static::formatUsageSummaryAsHtml((string) $state);
                            })
                            ->html(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('preview')
                    ->label('Önizleme')
                    ->extraAttributes(['class' => 'text-xs'])
                    ->state(function (Media $record) {
                        if ($record->media_kind === 'embed') {
                            $provider = strtolower($record->embed_provider ?: 'harici');

                            return match ($provider) {
                                'youtube' => 'YOUTUBE',
                                'vimeo' => 'VIMEO',
                                default => 'GÖMÜLÜ',
                            };
                        }

                        if (! $record->path || ! $record->disk) {
                            return 'DOSYA YOK';
                        }

                        try {
                            $url = Storage::disk($record->disk)->url($record->path);

                            return new HtmlString(
                                '<img src="' . e($url) . '" alt="" style="width:64px;height:64px;object-fit:cover;border-radius:8px;border:1px solid #2f2f2f;" />'
                            );
                        } catch (\Exception $e) {
                            return 'HATA';
                        }
                    })
                    ->html(),

                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('media_kind')
                    ->label('Tür')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'image' => 'Görsel',
                        'embed' => 'Dış İçerik',
                        'video' => 'Video',
                        default => $state,
                    })
                    ->sortable()
                    ->toggleable()
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('storage_type')
                    ->label('Depolama')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'file' => 'Dosya',
                        'external' => 'Harici',
                        default => $state,
                    })
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('original_name')
                    ->label('Orijinal Ad')
                    ->wrap()
                    ->limit(40)
                    ->toggleable()
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('embed_provider')
                    ->label('Sağlayıcı')
                    ->formatStateUsing(fn (?string $state): string => match (strtolower($state ?? '')) {
                        'youtube' => 'Youtube',
                        'vimeo' => 'Vimeo',
                        default => $state ?? '-',
                    })
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('usages_count')
                    ->label('Kullanım')
                    ->sortable()
                    ->toggleable()
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\TextColumn::make('usage_status')
                    ->label('Durum')
                    ->state(function (Media $record): string {
                        /** @var MediaUsageService $usageService */
                        $usageService = app(MediaUsageService::class);

                        return $usageService->getUsageStatus($record->id);
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'kullanılmıyor' => 'warning',
                        'tek kullanım' => 'info',
                        'paylaşımlı kullanım' => 'success',
                        default => 'gray',
                    })
                    ->toggleable(),

                Tables\Columns\TextColumn::make('usage_summary')
                    ->label('Kullanıldığı Yerler')
                    ->formatStateUsing(function ($state): HtmlString|string {
                        if (blank($state)) {
                            return '-';
                        }

                        return static::formatUsageSummaryAsHtml((string) $state);
                    })
                    ->html()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->extraAttributes(['class' => 'text-xs']),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('usage_status')
                    ->label('Kullanım Durumu')
                    ->options([
                        'kullanilmayan' => 'Kullanılmayan',
                        'kullanilan' => 'Kullanılan',
                        'paylasimli' => 'Paylaşımlı',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['value'] === 'kullanilmayan', fn (Builder $q) => $q->doesntHave('usages'))
                            ->when($data['value'] === 'kullanilan', fn (Builder $q) => $q->has('usages'))
                            ->when($data['value'] === 'paylasimli', fn (Builder $q) => $q->has('usages', '>', 1));
                    }),

                SelectFilter::make('icerik_turu')
                    ->label('İçerik Türü')
                    ->options([
                        'history_event' => 'Tarih Olayı',
                        'news' => 'Haber',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['value'], function (Builder $q) use ($data) {
                            $model = match ($data['value']) {
                                'history_event' => HistoryEvent::class,
                                'news' => News::class,
                                default => null,
                            };
                            return $q->whereHas('usages', fn (Builder $sq) => $sq->where('mediable_type', $model));
                        });
                    }),

                SelectFilter::make('kullanim_tipi')
                    ->label('Kullanım Tipi')
                    ->options([
                        'cover' => 'Kapak',
                        'gallery' => 'Galeri',
                        'video' => 'Video',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['value'], function (Builder $q) use ($data) {
                            return $q->whereHas('usages', fn (Builder $sq) => $sq->where('usage_type', $data['value']));
                        });
                    }),

                SelectFilter::make('media_kind')
                    ->label('Medya Türü')
                    ->options([
                        'image' => 'Görsel',
                        'embed' => 'Gömülü Video',
                        'video' => 'Video',
                    ]),
            ], layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(4)
            ->defaultSort('id', 'desc')
            ->paginated([10, 25, 50])
            ->searchable()
            ->actions([
                Tables\Actions\Action::make('open')
                    ->label('Aç')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(function (Media $record): ?string {
                        if ($record->media_kind === 'embed') {
                            return $record->embed_url ?: null;
                        }

                        if ($record->path && $record->disk) {
                            try {
                                return Storage::disk($record->disk)->url($record->path);
                            } catch (\Exception $e) {
                                return null;
                            }
                        }

                        return null;
                    }, shouldOpenInNewTab: true)
                    ->visible(function (Media $record): bool {
                        if ($record->media_kind === 'embed') {
                            return filled($record->embed_url);
                        }

                        return filled($record->path) && filled($record->disk);
                    }),

                Tables\Actions\Action::make('safe_delete')
                    ->label('Sil')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Medya silinsin mi?')
                    ->modalDescription('Bu işlem yalnızca kullanımda olmayan medya kayıtlarında çalışır.')
                    ->action(function (Media $record): void {
                        /** @var MediaUsageService $usageService */
                        $usageService = app(MediaUsageService::class);

                        try {
                            $didDelete = $usageService->deleteMediaByIdIfUnused($record->id);

                            if ($didDelete) {
                                Notification::make()
                                    ->title('Medya silindi.')
                                    ->success()
                                    ->send();

                                return;
                            }

                            Notification::make()
                                ->title('Medya silinemedi.')
                                ->warning()
                                ->send();
                        } catch (RuntimeException $exception) {
                            Notification::make()
                                ->title($exception->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('cleanup_orphans')
                    ->label('Seçili yetim medyaları temizle')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Seçili kullanılmayan medyalar silinsin mi?')
                    ->modalDescription('Yalnızca kullanım sayısı 0 olan kayıtlar silinir. Kullanımda olanlar atlanır.')
                    ->action(function ($records): void {
                        /** @var MediaUsageService $usageService */
                        $usageService = app(MediaUsageService::class);

                        $ids = $records->pluck('id')->map(fn ($id) => (int) $id)->all();
                        $result = $usageService->cleanupOrphanMediaIds($ids);

                        Notification::make()
                            ->title("Temizleme tamamlandı. Silinen: {$result['deleted']}, Atlanan: {$result['skipped']}")
                            ->success()
                            ->send();
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedia::route('/'),
        ];
    }

    protected static function formatUsageSummaryAsHtml(string $summary): HtmlString
    {
        $items = array_filter(array_map('trim', explode('|', $summary)));

        if (empty($items)) {
            return new HtmlString('-');
        }

        $html = '<div style="display:flex;flex-wrap:wrap;gap:4px;max-width:300px;">';

        foreach ($items as $item) {
            $label = e(static::translateUsageSummaryItem($item));

            $html .= '<div style="
                display:inline-flex;
                align-items:center;
                width:fit-content;
                max-width:100%;
                padding:4px 10px;
                border:1px solid #e9e2d8;
                border-radius:9999px;
                background:#fffdf9;
                color:#6f6559;
                font-size:10px;
                line-height:1;
                white-space:nowrap;
            ">' . $label . '</div>';
        }

        $html .= '</div>';

        return new HtmlString($html);
    }

    protected static function translateUsageSummaryItem(string $item): string
    {
        $translated = str_replace('HistoryEvent', 'Tarih Olayı', $item);
        $translated = str_replace('News', 'Haber', $translated);
        $translated = str_replace('Trophy', 'Kupa', $translated);
        $translated = str_replace('Legend', 'Efsane', $translated);
        $translated = str_replace('HistoricalMatch', 'Tarihi Maç', $translated);
        $translated = str_replace('HistoricalEvent', 'Tarihsel Olay', $translated);
        $translated = str_replace('[cover]', '[kapak]', $translated);
        $translated = str_replace('[gallery]', '[galeri]', $translated);
        $translated = str_replace('[video]', '[video]', $translated);

        return $translated;
    }
}