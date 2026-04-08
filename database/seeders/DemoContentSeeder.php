<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DemoContentSeeder extends Seeder
{
    /**
     * @var array<string, array<int, string>>
     */
    private array $columnsCache = [];

    /**
     * @var array<int, int>
     */
    private array $imagePool = [];

    /**
     * @var array<int, bool>
     */
    private array $usedCoverMediaIds = [];

    public function run(): void
    {
        DB::transaction(function (): void {
            $userMap = $this->resolveUsers();
            $categoryMap = $this->resolveCategories();

            $this->clearDemoMediaUsages();

            $this->seedNews($categoryMap, $userMap);
            $this->seedHistoryEvents($userMap);
            $this->seedLegends($userMap);
            $this->seedHistoricalMatches($userMap);
            $this->seedSeasonArchives($userMap);
            $this->seedTrophies();

            $this->attachHistoryEventLegends();
            $this->attachHistoryEventTrophies();

            $this->imagePool = $this->resolveImagePool();

            $this->attachNewsImages();
            $this->attachLegendImages();
            $this->attachHistoricalMatchImages();
            $this->attachSeasonArchiveImages();
            $this->attachHistoryEventImages();

            $this->command?->info('✅ DemoContentSeeder tamamlandı.');
        });
    }

    private function resolveUsers(): array
    {
        return [
            'admin_id' => $this->safeFindIdBy('users', 'email', 'admin@cadde1905.test'),
            'editor_id' => $this->safeFindIdBy('users', 'email', 'editor@cadde1905.test'),
        ];
    }

    private function resolveCategories(): array
    {
        return [
            'genel' => $this->safeFindIdBy('categories', 'slug', 'genel'),
            'futbol' => $this->safeFindIdBy('categories', 'slug', 'futbol'),
            'basketbol' => $this->safeFindIdBy('categories', 'slug', 'basketbol'),
        ];
    }

    private function clearDemoMediaUsages(): void
    {
        if (! Schema::hasTable('mediaables')) {
            return;
        }

        DB::table('mediaables')
            ->whereIn('mediable_type', [
                'App\Models\News',
                'App\Models\HistoryEvent',
                'App\Models\Legend',
                'App\Models\HistoricalMatch',
                'App\Models\SeasonArchive',
            ])
            ->delete();

        $this->command?->info('✅ Demo media usage kayıtları temizlendi.');
    }

    private function seedNews(array $categoryMap, array $userMap): void
    {
        foreach ($this->newsPayloads($categoryMap, $userMap) as $row) {
            $this->safeUpdateOrInsert('news', $row['unique'], $row['payload']);
        }

        $this->command?->info('✅ Demo news seeded.');
    }

    private function seedHistoryEvents(array $userMap): void
    {
        foreach ($this->historyEventPayloads($userMap) as $row) {
            $this->safeUpdateOrInsert('history_events', $row['unique'], $row['payload']);
        }

        $this->command?->info('✅ Demo history events seeded.');
    }

    private function seedLegends(array $userMap): void
    {
        foreach ($this->legendPayloads($userMap) as $row) {
            $this->safeUpdateOrInsert('legends', $row['unique'], $row['payload']);
        }

        $this->command?->info('✅ Demo legends seeded.');
    }

    private function seedHistoricalMatches(array $userMap): void
    {
        foreach ($this->historicalMatchPayloads($userMap) as $row) {
            $this->safeUpdateOrInsert('historical_matches', $row['unique'], $row['payload']);
        }

        $this->command?->info('✅ Demo historical matches seeded.');
    }

    private function seedSeasonArchives(array $userMap): void
    {
        foreach ($this->seasonArchivePayloads($userMap) as $row) {
            $this->safeUpdateOrInsert('season_archives', $row['unique'], $row['payload']);
        }

        $this->command?->info('✅ Demo season archives seeded.');
    }

    private function seedTrophies(): void
    {
        foreach ($this->trophyPayloads() as $row) {
            $this->safeUpdateOrInsert('trophies', $row['unique'], $row['payload']);
        }

        $this->command?->info('✅ Demo trophies seeded.');
    }

    private function attachHistoryEventLegends(): void
    {
        $historyEventMap = $this->historyEventMap();
        $legendMap = $this->legendMap();

        foreach ($this->historyEventLegendRelations() as $row) {
            $historyEventId = $historyEventMap[$row['history_event_slug']] ?? null;
            $legendId = $legendMap[$row['legend_slug']] ?? null;

            if (! $historyEventId || ! $legendId) {
                continue;
            }

            $this->safeUpdateOrInsert(
                'history_event_legend',
                [
                    'history_event_id' => $historyEventId,
                    'legend_id' => $legendId,
                ],
                [
                    'history_event_id' => $historyEventId,
                    'legend_id' => $legendId,
                    'is_primary' => $row['is_primary'],
                    'relation_type' => $row['relation_type'],
                    'notes' => $row['notes'],
                    'sort_order' => $row['sort_order'],
                ]
            );
        }

        $this->command?->info('✅ Demo history_event_legend relations seeded.');
    }

    private function attachHistoryEventTrophies(): void
    {
        $historyEventMap = $this->historyEventMap();
        $trophyMap = $this->trophyMap();

        foreach ($this->historyEventTrophyRelations() as $row) {
            $historyEventId = $historyEventMap[$row['history_event_slug']] ?? null;
            $trophyId = $trophyMap[$row['trophy_slug']] ?? null;

            if (! $historyEventId || ! $trophyId) {
                continue;
            }

            $this->safeUpdateOrInsert(
                'history_event_trophy',
                [
                    'history_event_id' => $historyEventId,
                    'trophy_id' => $trophyId,
                ],
                [
                    'history_event_id' => $historyEventId,
                    'trophy_id' => $trophyId,
                    'is_primary' => $row['is_primary'],
                    'relation_type' => $row['relation_type'],
                    'notes' => $row['notes'],
                    'sort_order' => $row['sort_order'],
                ]
            );
        }

        $this->command?->info('✅ Demo history_event_trophy relations seeded.');
    }

    private function resolveImagePool(): array
    {
        if (! Schema::hasTable('media')) {
            return [];
        }

        return DB::table('media')
            ->where('media_kind', 'image')
            ->where('is_active', 1)
            ->whereNull('deleted_at')
            ->orderBy('id')
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->toArray();
    }

    private function attachNewsImages(): void
    {
        $newsMap = $this->newsMap();

        foreach ($this->newsImagePlan() as $row) {
            $newsId = $newsMap[$row['slug']] ?? null;
            if (! $newsId) {
                continue;
            }

            if ($row['cover']) {
                $coverMediaId = $this->reserveUniqueCoverImageId();
                if ($coverMediaId) {
                    $this->attachMediaUsage($coverMediaId, 'App\Models\News', $newsId, 'cover', true, 0);
                }
            }

            if ($row['gallery_count'] > 0) {
                $galleryIds = $this->reserveGalleryImageIds($row['gallery_count']);
                foreach ($galleryIds as $sortOrder => $mediaId) {
                    $this->attachMediaUsage($mediaId, 'App\Models\News', $newsId, 'content', false, $sortOrder);
                }
            }
        }

        $this->command?->info('✅ Demo news images attached.');
    }

    private function attachLegendImages(): void
    {
        $legendMap = $this->legendMap();

        foreach ($this->legendImagePlan() as $row) {
            $legendId = $legendMap[$row['slug']] ?? null;
            if (! $legendId) {
                continue;
            }

            if ($row['cover']) {
                $coverMediaId = $this->reserveUniqueCoverImageId();
                if ($coverMediaId) {
                    $this->attachMediaUsage($coverMediaId, 'App\Models\Legend', $legendId, 'cover', true, 0);
                }
            }
        }

        $this->command?->info('✅ Demo legend images attached.');
    }

    private function attachHistoricalMatchImages(): void
    {
        $matchMap = $this->historicalMatchMap();

        foreach ($this->historicalMatchImagePlan() as $row) {
            $matchId = $matchMap[$row['slug']] ?? null;
            if (! $matchId) {
                continue;
            }

            if ($row['cover']) {
                $coverMediaId = $this->reserveUniqueCoverImageId();
                if ($coverMediaId) {
                    $this->attachMediaUsage($coverMediaId, 'App\Models\HistoricalMatch', $matchId, 'cover', true, 0);
                }
            }

            if ($row['gallery_count'] > 0) {
                $galleryIds = $this->reserveGalleryImageIds($row['gallery_count']);
                foreach ($galleryIds as $sortOrder => $mediaId) {
                    $this->attachMediaUsage($mediaId, 'App\Models\HistoricalMatch', $matchId, 'content', false, $sortOrder);
                }
            }
        }

        $this->command?->info('✅ Demo historical match images attached.');
    }

    private function attachSeasonArchiveImages(): void
    {
        $seasonMap = $this->seasonArchiveMap();

        foreach ($this->seasonArchiveImagePlan() as $row) {
            $seasonId = $seasonMap[$row['slug']] ?? null;
            if (! $seasonId) {
                continue;
            }

            if ($row['cover']) {
                $coverMediaId = $this->reserveUniqueCoverImageId();
                if ($coverMediaId) {
                    $this->attachMediaUsage($coverMediaId, 'App\Models\SeasonArchive', $seasonId, 'cover', true, 0);
                }
            }
        }

        $this->command?->info('✅ Demo season archive images attached.');
    }

    private function attachHistoryEventImages(): void
    {
        $historyEventMap = $this->historyEventMap();

        foreach ($this->historyEventImagePlan() as $row) {
            $historyEventId = $historyEventMap[$row['slug']] ?? null;
            if (! $historyEventId) {
                continue;
            }

            if ($row['cover']) {
                $coverMediaId = $this->reserveUniqueCoverImageId();
                if ($coverMediaId) {
                    $this->attachMediaUsage($coverMediaId, 'App\Models\HistoryEvent', $historyEventId, 'cover', true, 0);
                }
            }

            if ($row['gallery_count'] > 0) {
                $galleryIds = $this->reserveGalleryImageIds($row['gallery_count']);
                foreach ($galleryIds as $sortOrder => $mediaId) {
                    $this->attachMediaUsage($mediaId, 'App\Models\HistoryEvent', $historyEventId, 'content', false, $sortOrder);
                }
            }
        }

        $this->command?->info('✅ Demo history event images attached.');
    }

    private function attachMediaUsage(
        int $mediaId,
        string $mediableType,
        int $mediableId,
        string $usageType,
        bool $isPrimary,
        int $sortOrder
    ): void {
        $this->safeUpdateOrInsert(
            'mediaables',
            [
                'media_id' => $mediaId,
                'mediable_type' => $mediableType,
                'mediable_id' => $mediableId,
                'usage_type' => $usageType,
            ],
            [
                'media_id' => $mediaId,
                'mediable_type' => $mediableType,
                'mediable_id' => $mediableId,
                'usage_type' => $usageType,
                'sort_order' => $sortOrder,
                'is_primary' => $isPrimary,
                'title_override' => null,
            ]
        );
    }

    private function reserveUniqueCoverImageId(): ?int
    {
        foreach ($this->imagePool as $mediaId) {
            if (! isset($this->usedCoverMediaIds[$mediaId])) {
                $this->usedCoverMediaIds[$mediaId] = true;
                return $mediaId;
            }
        }

        return null;
    }

    /**
     * Gallery tekrar kullanımına izin var.
     *
     * @return array<int, int>
     */
    private function reserveGalleryImageIds(int $count): array
    {
        if (empty($this->imagePool) || $count <= 0) {
            return [];
        }

        $result = [];
        $poolCount = count($this->imagePool);

        for ($i = 0; $i < $count; $i++) {
            $result[] = $this->imagePool[$i % $poolCount];
        }

        return array_values(array_unique($result));
    }

    private function newsMap(): array
    {
        return DB::table('news')->pluck('id', 'slug')->toArray();
    }

    private function historyEventMap(): array
    {
        return DB::table('history_events')->pluck('id', 'slug')->toArray();
    }

    private function legendMap(): array
    {
        return DB::table('legends')->pluck('id', 'slug')->toArray();
    }

    private function historicalMatchMap(): array
    {
        return DB::table('historical_matches')->pluck('id', 'slug')->toArray();
    }

    private function seasonArchiveMap(): array
    {
        return DB::table('season_archives')->pluck('id', 'slug')->toArray();
    }

    private function trophyMap(): array
    {
        return DB::table('trophies')->pluck('id', 'slug')->toArray();
    }

    private function newsImagePlan(): array
    {
        return [
            ['slug' => 'parcali-formayi-giymeye-hazir-ilkay-gundogan-geliyor', 'cover' => true, 'gallery_count' => 6],
            ['slug' => 'durdurulamayan-aslan-victor-osimhenden-3-gol-birden', 'cover' => true, 'gallery_count' => 6],
            ['slug' => 'sampiyonlar-ligi-ceyrek-finalinde-rakip-bayern-munih', 'cover' => true, 'gallery_count' => 8],
            ['slug' => 'galatasaray-daikin-cev-kupasi-yari-finalinde-avantaji-kapti', 'cover' => true, 'gallery_count' => 0],
            ['slug' => 'akademi-meyvelerini-veriyor-3-genc-yildiz-a-takima-cikti', 'cover' => true, 'gallery_count' => 0],
            ['slug' => 'parkenin-aslanlari-derbide-geri-dondu', 'cover' => true, 'gallery_count' => 0],
            ['slug' => 'icardinin-galatasaray-aski-bitmiyor-sosyal-medya-sallandi', 'cover' => true, 'gallery_count' => 0],
            ['slug' => 'kombineler-tukendi-mac-gunu-gelirlerinde-tarihi-zirve', 'cover' => true, 'gallery_count' => 0],
            ['slug' => 'tekerlekli-sandalye-basketbolda-final-four-heyecani-basliyor', 'cover' => true, 'gallery_count' => 0],
            ['slug' => 'efsane-uefa-kupasi-formasi-yeniden-satista', 'cover' => true, 'gallery_count' => 6],
        ];
    }

    private function legendImagePlan(): array
    {
        return [
            ['slug' => 'ali-sami-yen', 'cover' => true],
            ['slug' => 'metin-oktay', 'cover' => true],
            ['slug' => 'fatih-terim', 'cover' => true],
            ['slug' => 'gheorghe-hagi', 'cover' => true],
            ['slug' => 'bulent-korkmaz', 'cover' => true],
            ['slug' => 'fernando-muslera', 'cover' => true],
            ['slug' => 'claudio-taffarel', 'cover' => true],
            ['slug' => 'cevad-prekazi', 'cover' => true],
            ['slug' => 'jupp-derwall', 'cover' => true],
            ['slug' => 'mauro-icardi', 'cover' => true],
        ];
    }

    private function historicalMatchImagePlan(): array
    {
        return [
            ['slug' => 'kopenhag-destani-uefa-kupasi-sampiyonlugu', 'cover' => true, 'gallery_count' => 6],
            ['slug' => 'super-kupa-bizim-dunyanin-en-buyugu-cimbom', 'cover' => true, 'gallery_count' => 6],
            ['slug' => 'ali-sami-yende-mucize-uefa-yolu-aciliyor', 'cover' => true, 'gallery_count' => 0],
            ['slug' => 'old-traffordda-tarih-yazildi-cehenneme-hos-geldiniz', 'cover' => true, 'gallery_count' => 0],
            ['slug' => 'karanlikta-parlayan-kupa-kadikoy-sampiyonlugu', 'cover' => true, 'gallery_count' => 4],
            ['slug' => 'drogba-ve-sneijderden-madride-kabus', 'cover' => true, 'gallery_count' => 0],
            ['slug' => 'karlar-icinden-gelen-zafer-sneijderin-imzasi', 'cover' => true, 'gallery_count' => 0],
            ['slug' => '3-0in-rovansinda-5-0lik-inanilmaz-geri-donus', 'cover' => true, 'gallery_count' => 4],
            ['slug' => 'old-traffordda-30-yil-sonra-yeniden', 'cover' => false, 'gallery_count' => 0],
            ['slug' => 'turkiye-kupasi-finalinde-tarihi-skor', 'cover' => false, 'gallery_count' => 0],
        ];
    }

    private function seasonArchiveImagePlan(): array
    {
        return [
            ['slug' => '1905-kurucu-sezon', 'cover' => true],
            ['slug' => '1986-1987-14-yillik-hasretin-sonu', 'cover' => true],
            ['slug' => '1992-1993-feldkamp-ile-gelen-cifte-kupa', 'cover' => true],
            ['slug' => '1996-1997-fatih-terim-donemi-basliyor', 'cover' => true],
            ['slug' => '1999-2000-altin-yil-the-golden-season', 'cover' => true],
            ['slug' => '2005-2006-16-dakikalik-mucize', 'cover' => true],
            ['slug' => '2011-2012-yeniden-dogus-ve-kadikoy-zaferi', 'cover' => true],
            ['slug' => '2013-2014-avrupada-istikrar-ve-drogba-etkisi', 'cover' => true],
            ['slug' => '2014-2015-4-yildizin-takildigi-yil', 'cover' => false],
            ['slug' => '2022-2023-cumhuriyetin-100-yil-sampiyonlugu-sezonu', 'cover' => false],
        ];
    }

    private function historyEventImagePlan(): array
    {
        return [
            ['slug' => 'aglari-yirtan-gol-metin-oktay-1959', 'cover' => true, 'gallery_count' => 4],
            ['slug' => 'prekazinin-fuzeye-donusen-serbest-vurusu-1989', 'cover' => true, 'gallery_count' => 0],
            ['slug' => 'taffarelin-henryye-dur-dedigi-an-17-mayis-2000', 'cover' => true, 'gallery_count' => 6],
            ['slug' => 'popescunun-son-penaltisi-ve-kupa-17-mayis-2000', 'cover' => true, 'gallery_count' => 6],
            ['slug' => 'jardelin-altin-goluyle-super-kupa-25-agustos-2000', 'cover' => true, 'gallery_count' => 6],
            ['slug' => 'kadikoyde-karanlikta-kalkan-kupa-12-mayis-2012', 'cover' => true, 'gallery_count' => 4],
        ];
    }

    private function newsPayloads(array $categoryMap, array $userMap): array
    {
        $base = CarbonImmutable::now();

        return [
            $this->makeNewsRow(
                'parcali-formayi-giymeye-hazir-ilkay-gundogan-geliyor',
                'Parçalı Formayı Giymeye Hazır: İlkay Gündoğan Geliyor',
                $categoryMap['futbol'] ?? null,
                $userMap['admin_id'] ?? null,
                'futbol',
                'Sarı-kırmızılı camiada beklenen transfer müjdesi sonunda geliyor.',
                'Sarı-kırmızılı camiada beklenen transfer müjdesi sonunda geliyor. Barcelona ve Manchester City kariyerlerinin ardından çocukluk aşkı Galatasaray ile görüşmelere başlayan tecrübeli yıldız İlkay Gündoğan ile prensip anlaşmasına varıldı. Yönetimin, Şampiyonlar Ligi tecrübesiyle orta sahayı orkestra şefi gibi yönetecek olan yıldız oyuncuyu önümüzdeki hafta İstanbul\'a getirmesi bekleniyor.',
                $base,
                true,
                'https://youtu.be/Hmx1fSY6uDE?si=2vRCyIOWUGyNDoI0'
            ),
            $this->makeNewsRow(
                'durdurulamayan-aslan-victor-osimhenden-3-gol-birden',
                'Durdurulamayan Aslan: Victor Osimhen’den 3 Gol Birden',
                $categoryMap['futbol'] ?? null,
                $userMap['admin_id'] ?? null,
                'futbol',
                'Süper Lig’in 26. haftasında Kasımpaşa’yı konuk eden Galatasaray, yıldız forvetinin şovuyla kazandı.',
                'Süper Lig’in 26. haftasında Kasımpaşa’yı konuk eden Galatasaray, Nijeryalı süper golcüsü Victor Osimhen’in yıldızlaştığı maçta sahadan 4-1 galip ayrıldı. Maçın ardından tribünlere "üçlü" çektiren Osimhen, gol krallığı yarışında rakipleriyle arasındaki farkı açarken, taraftarların sevgisini bir kez daha perçinledi.',
                $base->subHour(),
                true,
                'https://youtu.be/8hJIvwbM1vQ?si=_Qhh7G9bXiu2x1qK'
            ),
            $this->makeNewsRow(
                'sampiyonlar-ligi-ceyrek-finalinde-rakip-bayern-munih',
                'Şampiyonlar Ligi Çeyrek Finalinde Rakip: Bayern Münih',
                $categoryMap['futbol'] ?? null,
                $userMap['admin_id'] ?? null,
                'futbol',
                'Avrupa arenasında dev randevu yaklaşıyor.',
                'UEFA Şampiyonlar Ligi son 16 turunda Portekiz ekibi Porto\'yu eleyerek adını çeyrek finale yazdıran Galatasaray\'ın rakibi belli oldu. Nyon\'da çekilen kurada sarı-kırmızılılar, Alman devi Bayern Münih ile eşleşti. İlk maçın Rams Park\'ta oynanacak olması, İstanbul\'da şimdiden "Cehennem" atmosferi hazırlıklarını başlattı.',
                $base->subHours(2),
                true,
                'https://youtu.be/K_Jj4DIYaaE?si=syDZNblZovxwbA7U'
            ),
            $this->makeNewsRow(
                'galatasaray-daikin-cev-kupasi-yari-finalinde-avantaji-kapti',
                'Galatasaray Daikin CEV Kupası Yarı Finalinde Avantajı Kaptı',
                $categoryMap['genel'] ?? null,
                $userMap['admin_id'] ?? null,
                'genel',
                'Filenin Aslanları finale bir adım daha yaklaştı.',
                'Kadın voleybolunun yükselen değeri Galatasaray Daikin, CEV Kupası yarı final ilk maçında İtalyan rakibini deplasmanda 3-1 mağlup ederek final kapısını araladı. Kaptan İlkin Aydın ve pasör çaprazı Alexia Carutasu’nun muazzam oyunuyla dönen takımımız, Burhan Felek’teki rövanş öncesi taraftarına büyük umut verdi.',
                $base->subHours(3),
                false,
                'https://youtu.be/uGFNuxy4OOc?si=eW7aMHX3m3VbCp0u'
            ),
            $this->makeNewsRow(
                'akademi-meyvelerini-veriyor-3-genc-yildiz-a-takima-cikti',
                'Akademi Meyvelerini Veriyor: 3 Genç Yıldız A Takıma Çıktı',
                $categoryMap['futbol'] ?? null,
                $userMap['admin_id'] ?? null,
                'futbol',
                'Florya’da altyapı devrimi sahaya yansıyor.',
                'Galatasaray Akademisi, teknik direktör Okan Buruk’un raporu doğrultusunda U19 takımından öne çıkan 3 yeteneği (Emirhan, Caner ve Yusuf) profesyonel kadroya dahil etti. "Florya’nın suyuyla büyüyen" gençlerin, önümüzdeki kupa maçlarında şans bulması bekleniyor.',
                $base->subHours(4),
                false,
                'https://youtu.be/hmcRnVoE2BE?si=7z2Dph_bj30tDyyE'
            ),
            $this->makeNewsRow(
                'parkenin-aslanlari-derbide-geri-dondu',
                'Parkenin Aslanları Derbide Geri Döndü!',
                $categoryMap['basketbol'] ?? null,
                $userMap['admin_id'] ?? null,
                'basketbol',
                'Basketbolda derbi zaferi geldi.',
                'Basketbol Süper Ligi’nin dev derbisinde Galatasaray, deplasmanda geriye düştüğü maçta son periyot performansı ile ezeli rakibini 89-84 mağlup etti. Koç Pozzecco’nun teknik faul sonrası tribünleri ateşlemesi ve takımın savunma direnci, galibiyetin anahtarı oldu.',
                $base->subHours(5),
                false,
                'https://youtu.be/6PU-_xX5wAk?si=oZ_tUS4N99AiATmj'
            ),
            $this->makeNewsRow(
                'icardinin-galatasaray-aski-bitmiyor-sosyal-medya-sallandi',
                'Icardi’nin Galatasaray Aşkı Bitmiyor: Sosyal Medya Sallandı',
                $categoryMap['futbol'] ?? null,
                $userMap['admin_id'] ?? null,
                'futbol',
                'Yıldız oyuncunun paylaşımı taraftarı heyecanlandırdı.',
                'Arjantinli yıldız Mauro Icardi, Instagram hesabından yaptığı "Burada kendimi evimde hissediyorum, hikaye henüz bitmedi" paylaşımıyla taraftarı heyecanlandırdı. Sözleşme uzatma sinyali olarak yorumlanan bu paylaşım, dakikalar içinde binlerce beğeni alarak gündeme oturdu.',
                $base->subHours(6),
                false,
                'https://youtu.be/LBv_x4Pv6t8?si=4KGgJhYQUUR5u0YC'
            ),
            $this->makeNewsRow(
                'kombineler-tukendi-mac-gunu-gelirlerinde-tarihi-zirve',
                'Kombineler Tükendi, Maç Günü Gelirlerinde Tarihi Zirve',
                $categoryMap['genel'] ?? null,
                $userMap['admin_id'] ?? null,
                'genel',
                'Rams Park’ta gelir rekoru kapıda.',
                'Galatasaray yönetimi, 2025-2026 sezonu loca ve kombine gelirlerinin tarihin en yüksek seviyesine ulaştığını açıkladı. Şampiyonlar Ligi ve ligdeki başarılarla birlikte kulübün kasasına giren rakamlar, yeni sezon transfer bütçesinin de habercisi oldu.',
                $base->subHours(7),
                false,
                'https://youtu.be/a2wR1tBCKmQ?si=WyVGz7FPWDQdLxt3'
            ),
            $this->makeNewsRow(
                'tekerlekli-sandalye-basketbolda-final-four-heyecani-basliyor',
                'Tekerlekli Sandalye Basketbolda Final-Four Heyecanı Başlıyor',
                $categoryMap['genel'] ?? null,
                $userMap['admin_id'] ?? null,
                'genel',
                'Engelsiz Aslanlar Avrupa yolunda.',
                'Dünya şampiyonu unvanlı Galatasaray Fuzul, Avrupa Şampiyonlar Ligi’nde gruplardan lider çıkarak Final-Four’a kalmayı başardı. Nisan ayında düzenlenecek finallerde Aslanlar, 6. kez Avrupa’nın en büyüğü olmak için sahaya çıkacak.',
                $base->subHours(8),
                false,
                'https://youtu.be/mU8GGpoe75s?si=nR50BkkuvcHI91B9'
            ),
            $this->makeNewsRow(
                'efsane-uefa-kupasi-formasi-yeniden-satista',
                'Efsane UEFA Kupası Forması Yeniden Satışta!',
                $categoryMap['genel'] ?? null,
                $userMap['admin_id'] ?? null,
                'genel',
                'GS Store’da retro çılgınlığı başladı.',
                'Taraftarların yoğun isteği üzerine 2000 yılındaki UEFA şampiyonluğunda giyilen ikonik "Beyaz Yaka Parçalı" formanın sınırlı sayıda üretilen retro versiyonu GS Store’larda satışa sunuldu. Mağazalarda uzun kuyruklar oluşurken, online satış sitesi yoğunluktan kısa süreliğine erişime kapandı.',
                $base->subHours(9),
                false,
                'https://youtu.be/C1uhC8EZsmI?si=KBilbB7fYvollDvt'
            ),
        ];
    }

    private function historyEventPayloads(array $userMap): array
    {
        $adminId = $userMap['admin_id'] ?? null;

        return [
            $this->makeHistoryEventRow('aglari-yirtan-gol-metin-oktay-1959', 'Ağları Yırtan Gol (Metin Oktay - 1959)', 'moment', '1959-01-01', false, true, 92, 'metin-oktay-net-breaker-1959', 'Anın Özeti: Fenerbahçe ile oynanan Türkiye Şampiyonluğu finalinde, "Taçsız Kral" Metin Oktay’ın vuruşunda topun ağları delip dışarı çıkması.', 'Önemi: Bu an, sadece bir gol değil; Galatasaray asaletinin ve gücünün efsaneleştiği ilk büyük kırılma noktasıdır.', $adminId),
            $this->makeHistoryEventRow('prekazinin-fuzeye-donusen-serbest-vurusu-1989', 'Prekazi’nin Füzeye Dönüşen Serbest Vuruşu (1989)', 'moment', '1989-01-01', false, true, 90, 'prekazi-free-kick-1989', 'Anın Özeti: Şampiyon Kulüpler Kupası çeyrek finalinde Monaco ağlarına yaklaşık 35 metreden gönderilen o inanılmaz gol.', 'Önemi: Spikerin "Aman Allahım!" çığlığıyla hafızalara kazınan bu an, Galatasaray’ın Avrupa devlerine kafa tutabileceğini gösteren ilk büyük "modern" mucizedir.', $adminId),
            $this->makeHistoryEventRow('taffarelin-henryye-dur-dedigi-an-17-mayis-2000', 'Taffarel’in Henry’ye "Dur" Dediği An (17 Mayıs 2000)', 'moment', '2000-05-17', true, true, 98, 'taffarel-save-henry-2000', 'Anın Özeti: UEFA Kupası finalinin uzatma dakikalarında Thierry Henry’nin yere çarptırarak vurduğu imkansız kafayı Taffarel’in çizgiden çıkarması.', 'Önemi: Eğer o top içeri girseydi, bugün müzemizde UEFA Kupası olmayabilirdi. Bir kalecinin kaderi değiştirdiği en epik andır.', $adminId),
            $this->makeHistoryEventRow('popescunun-son-penaltisi-ve-kupa-17-mayis-2000', 'Popescu’nun Son Penaltısı ve Kupa (17 Mayıs 2000)', 'achievement', '2000-05-17', true, true, 100, 'popescu-penalty-2000', 'Anın Özeti: Kopenhag’da penaltı atışlarında topun başına geçen Popescu’nun soğukkanlı vuruşu ve ardından gelen "Kupa bizim!" haykırışı.', 'Önemi: Türk futbolunun kulüpler düzeyindeki en büyük başarısının mühürlendiği, milyonların sokağa döküldüğü andır.', $adminId),
            $this->makeHistoryEventRow('jardelin-altin-goluyle-super-kupa-25-agustos-2000', 'Jardel’in Altın Golüyle Süper Kupa (25 Ağustos 2000)', 'achievement', '2000-08-25', true, true, 99, 'jardel-golden-goal-2000', 'Anın Özeti: Real Madrid karşısında uzatmalarda Fatih Akyel’in ortasına Mario Jardel’in dokunuşu ve maçın bitişi.', 'Önemi: Şampiyonlar Ligi şampiyonunu devirip "Dünyanın En Büyüğü" unvanının tescillendiği saniyedir.', $adminId),
            $this->makeHistoryEventRow('kadikoyde-karanlikta-kalkan-kupa-12-mayis-2012', 'Kadıköy’de Karanlıkta Kalkan Kupa (12 Mayıs 2012)', 'milestone', '2012-05-12', true, true, 96, 'kadikoy-title-2012', 'Anın Özeti: Ezeli rakibin sahasında şampiyonluğun ilan edilmesi ve polisin ışıkları söndürmesine rağmen zifiri karanlıkta kupanın havaya yükselmesi.', 'Önemi: Galatasaray tarihinin en büyük psikolojik zaferidir; "Her yerde şampiyonuz" mesajının somut halidir.', $adminId),
            $this->makeHistoryEventRow('drogbanin-real-madride-attigi-topuk-golu-2013', 'Drogba’nın Real Madrid’e Attığı Topuk Golü (2013)', 'moment', '2013-01-01', false, false, 87, 'drogba-backheel-2013', 'Anın Özeti: Şampiyonlar Ligi çeyrek finalinde Didier Drogba’nın Real Madrid ağlarına gönderdiği o klas topuk golüyle stadın yıkılması.', 'Önemi: Galatasaray’ın dünya yıldızlarıyla dünya devlerine diz çöktürdüğü, o efsanevi geri dönüş inancının zirve yaptığı andır.', $adminId),
            $this->makeHistoryEventRow('sneijderin-karda-juventusu-yiktigi-an-11-aralik-2013', 'Sneijder’in Karda Juventus’u Yıktığı An (11 Aralık 2013)', 'moment', '2013-12-11', true, false, 88, 'sneijder-juventus-snow-2013', 'Anın Özeti: İki güne yayılan, kar yağışı nedeniyle ertelenen maçın 85. dakikasında Sneijder’in Buffon’u avladığı çapraz vuruş.', 'Önemi: İtalyan devini saf dışı bırakıp karlar arasından Şampiyonlar Ligi’nde üst tura yürümenin destansı öyküsüdür.', $adminId),
            $this->makeHistoryEventRow('4-yildizin-takildigi-an-2015', '4. Yıldızın Takıldığı An (2015)', 'achievement', '2015-01-01', false, true, 89, 'fourth-star-2015', 'Anın Özeti: Wesley Sneijder’in Beşiktaş’a attığı gol sonrası şampiyonluğun garantilenmesi ve Türkiye’de 4 yıldızı takan ilk takım olma başarısı.', 'Önemi: Ezeli rekabette "yıldız" savaşlarını bitiren ve Galatasaray’ın Türkiye’deki hükümdarlığını kanıtlayan andır.', $adminId),
            $this->makeHistoryEventRow('icardinin-old-traffordu-susturusu-2023', 'Icardi’nin Şampiyonlar Ligi’nde Old Trafford’u Susturuşu (2023)', 'moment', '2023-10-03', true, true, 90, 'icardi-old-trafford-2023', 'Anın Özeti: Manchester United deplasmanında penaltı kaçırmasına rağmen pes etmeyen Icardi’nin, kalecinin üzerinden aşırttığı golle maçı 3-2’ye getirmesi.', 'Önemi: Galatasaray’ın Avrupa genlerinin 20 yıl sonra bile hala ne kadar canlı olduğunu dünyaya hatırlattığı andır.', $adminId),
            $this->makeHistoryEventRow('namaglup-avrupa-sampiyonu-ilk-ve-tek-2000', 'Namağlup Avrupa Şampiyonu: İlk ve Tek! (2000 UEFA Kupası Şampiyonluğu)', 'achievement', '2000-05-17', true, true, 100, 'uefa-cup-title-2000', '17 Mayıs 2000\'de Kopenhag\'da Arsenal\'i devirerek kazanılan bu kupa, Türk futbol tarihinin kulüpler bazındaki en büyük başarısıdır.', 'Şampiyonlar Ligi\'nden elendikten sonra UEFA Kupası\'na dahil olan ve tek bir maç bile kaybetmeden kupayı müzesine götüren Galatasaray, bir Türk takımının Avrupa\'nın zirvesine çıkabileceğini dünyaya kanıtlamıştır.', $adminId),
            $this->makeHistoryEventRow('real-madridi-deviren-dunyanin-en-buyugu-2000', 'Real Madrid’i Deviren "Dünyanın En Büyüğü" (2000 UEFA Süper Kupa Şampiyonluğu)', 'achievement', '2000-08-25', true, true, 99, 'uefa-super-cup-title-2000', 'UEFA Kupası şampiyonu Galatasaray ile Şampiyonlar Ligi şampiyonu Real Madrid’in Monaco’daki randevusu.', 'Mario Jardel’in "Altın Gol"üyle gelen 2-1’lik zafer, Galatasaray’ı o tarihte IFFHS Dünya Kulüpler Sıralaması\'nda 1 numaraya taşımış ve dünyanın en büyük kulübü unvanını tescillemiştir.', $adminId),
            $this->makeHistoryEventRow('istatistiklerle-kanitlanmis-dunya-liderligi-2001', 'İstatistiklerle Kanıtlanmış Dünya Liderliği (2001)', 'achievement', '2001-01-01', false, false, 84, 'iffhs-first-2001', 'Galatasaray, 2001 yılı Ocak ayında IFFHS tarafından yapılan değerlendirmede, dev rakiplerini geride bırakarak dünyanın 1 numaralı kulübü seçilmiştir.', 'Bu başarı, bir Türk takımının global ölçekte ulaştığı en yüksek istatistiksel zirvedir.', $adminId),
            $this->makeHistoryEventRow('avrupanin-en-iyi-4-takimi-arasinda-1989', 'Avrupa’nın En İyi 4 Takımı Arasında (1989)', 'achievement', '1989-01-01', false, false, 83, 'europe-semi-1989', 'Modern Şampiyonlar Ligi formatı öncesinde, Mustafa Denizli yönetimindeki Galatasaray; Neuchâtel Xamax ve Monaco gibi ekipleri eleyerek yarı finale yükselmiştir.', 'Steaua Bükreş’e elenilse de bu başarı, Türk futbolunun makus talihini yenen ilk büyük Avrupa yürüyüşüdür.', $adminId),
            $this->makeHistoryEventRow('yildiz-savaslarinin-galibi-ilk-20-sampiyonluk-2015', 'Yıldız Savaşlarının Galibi: İlk 20. Şampiyonluk (2015)', 'achievement', '2015-01-01', false, false, 86, 'first-fourth-star-2015', '2014-2015 sezonunda kazandığı şampiyonlukla 20. şampiyonluğa ulaşan Galatasaray, Türkiye\'de göğsüne 4. yıldızı takan ilk kulüp olmuştur.', 'Bu başarı, Galatasaray\'ın yerel ligdeki mutlak dominasyonunun ve "ilklerin takımı" olma geleneğinin bir simgesidir.', $adminId),
            $this->makeHistoryEventRow('engelsiz-aslanlardan-dunya-dominasyonu', 'Engelsiz Aslanlar’dan Dünya Dominasyonu', 'achievement', '2024-01-01', false, true, 88, 'wheelchair-basketball-dominance', 'Galatasaray Tekerlekli Sandalye Basketbol Takımı, kazandığı 5 Şampiyon Kulüpler Kupası ve 4 Kıtalararası Kupa ile bu branşta dünyanın en başarılı takımlarından biri olmuştur.', '"Engelsiz Aslanlar", sarı-kırmızılı bayrağı amatör branşlarda dünyanın en yüksek kürsüsüne defalarca taşımıştır.', $adminId),
            $this->makeHistoryEventRow('sarayin-sultanlari-avrupanin-zirvesinde-2014', 'Sarayın Sultanları Avrupa’nın Zirvesinde (2014)', 'achievement', '2014-01-01', false, true, 89, 'euroleague-women-2014', '2014 yılında Rusya’nın Ekaterinburg kentinde düzenlenen finalde ezeli rakibi Fenerbahçe’yi yenen Galatasaray, EuroLeague Women kupasını kazanan ilk ve tek Türk takımı olmuştur.', 'Bu başarı, Türk kadın basketbolunun kulüpler bazındaki zirve noktasıdır.', $adminId),
            $this->makeHistoryEventRow('dortte-dort-yapan-ilk-ve-tek-takim-1996-2000', '"Dörtte Dört" Yapan İlk ve Tek Takım (1996-2000)', 'achievement', '2000-01-01', false, false, 85, 'four-in-a-row-1996-2000', 'Fatih Terim yönetimindeki Galatasaray, 1996 ile 2000 yılları arasında ligi adeta ambargo altına almıştır.', 'Türkiye ligi tarihinde üst üste 4 kez şampiyon olan başka bir takım bulunmamaktadır. Bu seri, 2000 yılındaki UEFA zaferinin yerel ligdeki temelidir.', $adminId),
            $this->makeHistoryEventRow('sampiyonlar-liginin-abonesi-ve-ceyrek-finalisti', 'Şampiyonlar Ligi’nin "Abonesi" ve Çeyrek Finalisti', 'achievement', '2013-01-01', false, false, 81, 'ucl-quarterfinal-tradition', 'Galatasaray, 2001 ve 2013 yıllarında Şampiyonlar Ligi\'nde son 8 takım arasına kalarak Avrupa\'nın en elit kulüpleriyle kafa kafaya mücadele etmiştir.', 'Real Madrid ve Barcelona gibi devlere karşı alınan galibiyetler, kulübün "Devler Ligi"ndeki saygınlığını perçinlemiştir.', $adminId),
            $this->makeHistoryEventRow('turkiyenin-tartismasiz-kupa-beyi', 'Türkiye’nin Tartışmasız "Kupa Beyi"', 'achievement', '2024-01-01', false, false, 82, 'cup-lord-18', 'Eleme usulü turnuvalardaki başarısıyla bilinen Galatasaray, Türkiye Kupası’nı müzesine en çok götüren takımdır.', 'Finallerdeki yüksek kazanma oranı, Galatasaray\'ın "final oynamayı ve kupa kaldırmayı bilen" karakterini ortaya koymaktadır.', $adminId),
        ];
    }

    private function legendPayloads(array $userMap): array
    {
        $adminId = $userMap['admin_id'] ?? null;

        return [
            $this->makeLegendRow('ali-sami-yen', 'Ali Sami Yen', '1 Numaralı Üye ve Vizyoner', '1905 yılında Mektep-i Sultani’de "Türk olmayan takımları yenmek" hedefiyle kulübü kuran kişidir.', '1905 yılında Mektep-i Sultani’de "Türk olmayan takımları yenmek" hedefiyle kulübü kuran kişidir. Sadece bir kurucu değil, Türk sporunun teşkilatlanmasında öncü bir spor adamıdır. Galatasaray’ın genlerindeki "Avrupa Fatihi" vizyonunun mimarıdır.', 1905, 1930, $adminId),
            $this->makeLegendRow('metin-oktay', 'Metin Oktay', 'Sadakat ve Zarafetin Sembolü', 'Attığı goller kadar Galatasaraylılık duruşuyla da efsanedir.', 'Attığı 608 golle değil, Galatasaraylılık duruşuyla efsanedir. "Galatasaraylılık bir din gibi bir şeydir" sözüyle camianın manevi babası olmuştur. Formasına olan aşkı için servetleri reddetmiş, centilmenliğiyle rakip taraftarların bile saygısını kazanmıştır.', 1955, 1969, $adminId),
            $this->makeLegendRow('fatih-terim', 'Fatih Terim', 'Kazanma Geninin Sahibi', 'Hem futbolcu hem teknik direktör olarak kulüp tarihinin en çok kupa kazanan ismidir.', 'Hem futbolcu hem teknik direktör olarak kulüp tarihinin en çok kupa kazanan ismidir. 1996-2000 arasındaki 4 üst üste şampiyonluk ve UEFA Kupası zaferiyle Galatasaray’ı dünya markası yapmıştır. "Aslan" hırsının sahadaki temsilcisidir.', 1996, 2022, $adminId),
            $this->makeLegendRow('gheorghe-hagi', 'Gheorghe Hagi', 'Tarihin En İyi Yabancısı', 'Galatasaray formasıyla büyü yapan, 10 numarayı kutsallaştıran isimdir.', 'Galatasaray formasıyla büyü yapan, 10 numarayı kutsallaştıran isimdir. UEFA Kupası ve Süper Kupa kazanılırken takımın saha içi lideriydi. Uzaktan attığı "imkansız" goller ve futbol zekasıyla bir nesle Galatasaraylılığı sevdiren sihirbazdır.', 1996, 2001, $adminId),
            $this->makeLegendRow('bulent-korkmaz', 'Bülent Korkmaz', 'Cesaretin ve Bağlılığın Simgesi', 'Altyapıdan çıkıp tüm kariyerini Galatasaray’da geçiren büyük kaptandır.', 'Altyapıdan çıkıp tüm kariyerini Galatasaray’da geçiren, UEFA Kupası finalinde çıkık omuzuyla bandajlı halde savaşan efsanedir. Müzesindeki 29 kupayla dünyanın en çok kupa kazanan oyuncularından biridir. Kulübün sarsılmaz savunma hattıdır.', 1987, 2005, $adminId),
            $this->makeLegendRow('fernando-muslera', 'Fernando Muslera', 'Modern Zamanların Efsanesi', '2011’den bu yana kaleyi koruyan kaptandır.', '2011\'den bu yana kaleyi koruyan, kazanılan sayısız şampiyonlukta başrol oynayan kaptandır. Galatasaray tarihinin en çok forma giyen ve en çok kupa kazanan yabancı oyuncusu olarak, sadece yeteneğiyle değil karakteriyle de yaşayan bir efsanedir.', 2011, null, $adminId),
            $this->makeLegendRow('claudio-taffarel', 'Claudio Taffarel', 'Kopenhag Kahramanı', '2000 yılındaki Avrupa zaferlerinin gizli kahramanıdır.', '2000 yılındaki Avrupa zaferlerinin gizli kahramanıdır. Henry\'nin kafasını çıkardığı o an, kulüp tarihinin yönünü değiştirmiştir. Sempatik tavırları ve kalecilik ekolüyle Florya\'nın ruhuna işlemiş, antrenör olarak da kulübe hizmet etmiştir.', 1998, 2001, $adminId),
            $this->makeLegendRow('cevad-prekazi', 'Cevad Prekazi', 'Monaco Fatihi', '1980’li yılların sonunda Tanju Çolak ile kurduğu ortaklıkla öne çıktı.', '1980\'li yılların sonunda Tanju Çolak ile kurduğu ortaklık ve Monaco\'ya attığı o efsanevi frikik golüyle hatırlanır. Galatasaray\'ın Avrupa serüveninin ilk büyük kahramanlarından biridir. O asil sol ayağı, tribünlerin unutamadığı bir melodi gibidir.', 1985, 1991, $adminId),
            $this->makeLegendRow('jupp-derwall', 'Jupp Derwall', 'Alman Ekolü ve Devrimci', '1984 yılında Galatasaray’ın başına geçerek modern futbolu getiren adamdır.', '1984 yılında Galatasaray\'ın başına geçerek Türk futboluna profesyonelliği, antrenman metodlarını ve modern futbolu getiren adamdır. 14 yıllık şampiyonluk hasretini bitiren ve bugünkü Avrupa başarılarının temelini atan vizyonerdir.', 1984, 1987, $adminId),
            $this->makeLegendRow('mauro-icardi', 'Mauro Icardi', 'Yeni Neslin Kahramanı', 'Sadece iki sezonda attığı kritik gollerle efsaneler arasına adını yazdırdı.', 'Sadece iki sezonda attığı kritik gollerle ve derbi performansıyla efsaneler arasına adını yazdırdı. Çocukların sevgilisi haline gelen, "Aşkın Olayım" şarkısıyla özdeşleşen Arjantinli, 23. ve 24. şampiyonlukların en büyük mimarı olarak tarihe geçti.', 2022, null, $adminId),
        ];
    }

    private function historicalMatchPayloads(array $userMap): array
    {
        $adminId = $userMap['admin_id'] ?? null;
        $base = CarbonImmutable::now();

        return [
            $this->makeHistoricalMatchRow('kopenhag-destani-uefa-kupasi-sampiyonlugu', 'Kopenhag Destanı: UEFA Kupası Şampiyonluğu', '2000-05-17', 'Arsenal', 'UEFA Kupası', 0, 0, 'win', 'Türk futbol tarihinin en büyük başarısı. 120 dakikası nefes kesen, Taffarel’in Henry’nin kafasını çizgiden çıkardığı ve kaptan Bülent Korkmaz’ın çıkık omuzla savaştığı o maç.', 'Türk futbol tarihinin en büyük başarısı. 120 dakikası nefes kesen, Taffarel’in Henry’nin kafasını çizgiden çıkardığı ve kaptan Bülent Korkmaz’ın çıkık omuzla savaştığı o maç. Penaltılarda Popescu’nun son vuruşuyla gelen kupa, Galatasaray’ın adını dünyaya ezberletti.', true, 100, $base, $adminId),
            $this->makeHistoricalMatchRow('super-kupa-bizim-dunyanin-en-buyugu-cimbom', 'Süper Kupa Bizim: Dünyanın En Büyüğü Cimbom!', '2000-08-25', 'Real Madrid', 'UEFA Süper Kupa', 2, 1, 'win', 'Monaco’da dünyanın zirvesine çıkılan gece.', 'Monaco’da Şampiyonlar Ligi şampiyonu Real Madrid’e karşı verilen muazzam mücadele. Mario Jardel’in uzatmalarda attığı "Altın Gol", Galatasaray’ı Avrupa’nın ve dünyanın zirvesine taşıdı. Los Galacticos’un dize geldiği o gece unutulmazlar arasında.', true, 99, $base->subDay(), $adminId),
            $this->makeHistoricalMatchRow('ali-sami-yende-mucize-uefa-yolu-aciliyor', 'Ali Sami Yen’de Mucize: UEFA Yolu Açılıyor', '1999-11-03', 'AC Milan', 'Şampiyonlar Ligi', 3, 2, 'win', 'Son dakikalarda gelen tarihi geri dönüş.', 'Şampiyonlar Ligi grubunda son dakikalara 2-1 geride giren Galatasaray, 87\'de Hakan Şükür ve 90\'da Ümit Davala’nın penaltısıyla maçı 3-2 kazandı. Bu galibiyet takımı UEFA Kupası\'na gönderdi ve Kopenhag’a giden o efsanevi yolun ilk taşı döşendi.', true, 95, $base->subDays(2), $adminId),
            $this->makeHistoricalMatchRow('old-traffordda-tarih-yazildi-cehenneme-hos-geldiniz', 'Old Trafford’da Tarih Yazıldı: "Cehenneme Hoş Geldiniz"', '1993-10-20', 'Manchester United', 'Şampiyonlar Ligi', 3, 3, 'draw', 'Old Trafford’da geri dönüşle yazılan tarih.', 'Manchester United deplasmanında 2-0 geriye düşen Aslan, Arif Erdem ve Kubilay Türkyılmaz’ın (2) golleriyle 3-3\'ü yakaladı. İstanbul’daki 0-0\'lık rövanşla bir dev elendi ve Galatasaray, Şampiyonlar Ligi formatında gruplara kalan ilk Türk takımı oldu.', true, 94, $base->subDays(3), $adminId),
            $this->makeHistoricalMatchRow('karanlikta-parlayan-kupa-kadikoy-sampiyonlugu', 'Karanlıkta Parlayan Kupa: Kadıköy Şampiyonluğu', '2012-05-12', 'Fenerbahçe', 'Süper Lig', 0, 0, 'draw', 'Ezeli rakibin sahasında gelen şampiyonluk.', 'Süper Final sisteminde şampiyonun belirleneceği son maç ezeli rakibin sahasındaydı. 0-0 biten maçın ardından Galatasaray, Fenerbahçe’nin stadında kupayı havaya kaldırdı. Stat ışıkları kapatılsa da sarı-kırmızılıların zaferi tüm Türkiye’yi aydınlattı.', true, 96, $base->subDays(4), $adminId),
            $this->makeHistoricalMatchRow('drogba-ve-sneijderden-madride-kabus', 'Drogba ve Sneijder’den Madrid’e Kabus', '2013-04-09', 'Real Madrid', 'Şampiyonlar Ligi', 3, 2, 'win', 'Tur geçilemese de Avrupa’yı sallayan rövanş.', 'Şampiyonlar Ligi çeyrek final rövanşında Real Madrid karşısında 1-0 geriye düşen Galatasaray; Eboue, Sneijder ve Drogba’nın golleriyle skoru 3-1’e getirdi. Tur geçilemese de Jose Mourinho’nun ekibine yaşatılan o 15 dakikalık korku, Avrupa basınının manşetlerini süsledi.', false, 88, $base->subDays(5), $adminId),
            $this->makeHistoricalMatchRow('karlar-icinden-gelen-zafer-sneijderin-imzasi', 'Karlar İçinden Gelen Zafer: Sneijder’in İmzası', '2013-12-11', 'Juventus', 'Şampiyonlar Ligi', 1, 0, 'win', 'Karlar altında gelen unutulmaz galibiyet.', 'Kar yağışı nedeniyle ertelenen ve ertesi gün devam eden "buzdan maç". 85. dakikada Wesley Sneijder’in Buffon’u avladığı çapraz vuruş, Juventus’u elerken Galatasaray’ı Şampiyonlar Ligi’nde son 16 turuna taşıdı.', false, 87, $base->subDays(6), $adminId),
            $this->makeHistoricalMatchRow('3-0in-rovansinda-5-0lik-inanilmaz-geri-donus', '3-0\'ın Rövanşında 5-0\'lık İnanılmaz Geri Dönüş', '1988-11-09', 'Neuchâtel Xamax', 'Avrupa Kupası', 5, 0, 'win', 'İmkansızı başaran ilk büyük Avrupa mucizesi.', 'İlk maçı deplasmanda 3-0 kaybeden Galatasaray, İstanbul’da Tanju Çolak (3) ve Metin Yıldız’ın golleriyle maçı 5-0 kazandı. Bu maç, Türk takımlarının Avrupa\'da "imkansızı başarabileceğini" kanıtlayan ilk büyük mucizedir.', false, 98, $base->subDays(7), $adminId),
            $this->makeHistoricalMatchRow('old-traffordda-30-yil-sonra-yeniden', 'Old Trafford’da 30 Yıl Sonra Yeniden!', '2023-10-03', 'Manchester United', 'Şampiyonlar Ligi', 3, 2, 'win', 'Modern dönemde gelen büyük Avrupa gecesi.', 'Modern dönemde Şampiyonlar Ligi gruplarında Manchester United’ı kendi evinde deviren Aslan. Zaha, Kerem Aktürkoğlu ve Icardi’nin golleriyle gelen 3-2\'lik zafer, Galatasaray’ın Avrupa genlerinin hala ne kadar güçlü olduğunu tüm dünyaya hatırlattı.', false, 90, $base->subDays(8), $adminId),
            $this->makeHistoricalMatchRow('turkiye-kupasi-finalinde-tarihi-skor', 'Türkiye Kupası Finalinde Tarihi Skor', '2005-05-11', 'Fenerbahçe', 'Türkiye Kupası', 5, 1, 'win', 'Derbi finalleri tarihine geçen farklı zafer.', 'Atatürk Olimpiyat Stadı\'ndaki kupa finalinde Galatasaray, ezeli rakibi Fenerbahçe\'yi Ribery, Necati Ateş ve Hakan Şükür\'ün (3) golleriyle 5-1 mağlup etti. Bu skor, derbi finalleri tarihindeki en farklı galibiyetlerden biri olarak kayıtlara geçti.', false, 86, $base->subDays(9), $adminId),
        ];
    }

    private function seasonArchivePayloads(array $userMap): array
    {
        $adminId = $userMap['admin_id'] ?? null;

        return [
            $this->makeSeasonArchiveRow('1905-kurucu-sezon', 'Güneşin Doğuşu: Mektep-i Sultani’den Sahalara', '1905', 1905, 1905, 'Ali Sami Yen ve arkadaşlarının "Türk olmayan takımları yenmek" hedefiyle kulübü kurduğu ilk yıl.', 'Ali Sami Yen ve arkadaşlarının "Türk olmayan takımları yenmek" hedefiyle kulübü kurduğu ilk yıl. Galatasaray’ın asaletinin ve vizyonunun temellerinin atıldığı, Türk spor tarihinin başlangıç noktası sayılan en kritik sezon.', 'Kuruluş ve ilk örgütlenme dönemi.', null, null, null, false, 70, null, $adminId),
            $this->makeSeasonArchiveRow('1986-1987-14-yillik-hasretin-sonu', 'Modern Galatasaray\'ın Doğuşu: Jupp Derwall Devrimi', '1986-1987', 1986, 1987, '14 yıllık şampiyonluk özleminin bittiği sezon.', '14 yıl süren şampiyonluk özleminin bittiği, Alman ekolüyle tesisleşmenin ve taktiksel disiplinin kulübe girdiği sezon. Bu şampiyonluk, 90\'lı yıllardaki büyük Avrupa yürüyüşünün ilk kıvılcımıdır.', 'Lig şampiyonluğuyla sonuçlanan dönüş sezonu.', null, null, null, false, 84, 'Jupp Derwall', $adminId),
            $this->makeSeasonArchiveRow('1992-1993-feldkamp-ile-gelen-cifte-kupa', 'Gençleşme Operasyonu ve "Kupa Beyi" Unvanı', '1992-1993', 1992, 1993, 'Feldkamp ile yenilenen kadro çifte kupaya uzandı.', 'Karl-Heinz Feldkamp\'ın takımı baştan aşağı yenilediği, Hakan Şükür gibi gençlerin parladığı sezon. Hem lig hem de Türkiye Kupası\'nın kazanılması, Galatasaray’ın 90\'lı yıllara damga vuracağının habercisiydi.', 'Lig şampiyonluğu ve Türkiye Kupası ile tamamlandı.', null, 'Çifte kupa.', null, false, 82, 'Karl-Heinz Feldkamp', $adminId),
            $this->makeSeasonArchiveRow('1996-1997-fatih-terim-donemi-basliyor', '"Dörtte Dört" Serisinin İlk Adımı', '1996-1997', 1996, 1997, 'Fatih Terim dönemi ve büyük serinin başlangıcı.', 'Fatih Terim’in teknik direktörlüğe gelişi ve Hagi’nin transferiyle başlayan yeni çağ. Bu sezon kazanılan şampiyonluk, Türk futbol tarihinin en büyük dominasyon dönemini başlatan ilk halkadır.', 'Lig zaferiyle yeni çağ açıldı.', null, null, null, false, 86, 'Fatih Terim', $adminId),
            $this->makeSeasonArchiveRow('1999-2000-altin-yil-the-golden-season', 'Tarihin Zirvesi: UEFA Kupası ve "Triple"', '1999-2000', 1999, 2000, 'Türk futbolunun kulüpler bazında ulaştığı en yüksek sezon.', 'Galatasaray’ın hem Lig, hem Türkiye Kupası hem de UEFA Kupası\'nı kazanarak "üçleme" yaptığı, Türk futbolunun kulüpler bazında ulaştığı en yüksek nokta. Dünyanın Galatasaray\'ı hayranlıkla izlediği efsanevi sezon.', 'Lig şampiyonluğu.', 'UEFA Kupası ile zirve.', 'Türkiye Kupası kazanıldı.', null, true, 100, 'Fatih Terim', $adminId),
            $this->makeSeasonArchiveRow('2005-2006-16-dakikalik-mucize', 'İnancın Zaferi: Denizli’den Gelen Şampiyonluk', '2005-2006', 2005, 2006, 'Efsane 16 dakikalık bekleyişin sezonu.', 'Maddi imkansızlıklara rağmen Eric Gerets yönetiminde sergilenen muazzam performans. Ligin son maçında sahadaki 90 dakika bittikten sonra, şampiyonluk için Denizli’den gelecek haberin beklendiği o efsanevi 16 dakikalık bekleyişin sezonu.', 'Lig şampiyonluğu mucizeyle geldi.', null, null, null, false, 84, 'Eric Gerets', $adminId),
            $this->makeSeasonArchiveRow('2011-2012-yeniden-dogus-ve-kadikoy-zaferi', 'Süper Final ve Karanlıkta Kalkan Kupa', '2011-2012', 2011, 2012, 'Yıldızlar karmasıyla gelen yeniden doğuş.', 'Üst üste gelen başarısızlıkların ardından Fatih Terim’in 3. döneminde kurulan "Yıldızlar Karması" (Muslera, Selçuk İnan, Elmander, Melo). Ezeli rakibin sahasında ışıklar altında kaldırılan o kupa, kulüp tarihinin en epik şampiyonluk sezonudur.', 'Süper Final ile gelen şampiyonluk.', null, null, null, true, 95, 'Fatih Terim', $adminId),
            $this->makeSeasonArchiveRow('2013-2014-avrupada-istikrar-ve-drogba-etkisi', 'Juventus’u Eleyen Aslan ve Şampiyonlar Ligi Çeyrek Finali', '2013-2014', 2013, 2014, 'Dünya yıldızlarıyla gelen Avrupa görünürlüğü.', 'Dünya yıldızları Drogba ve Sneijder’in takıma gelişi, Juventus’u karlar altında eleyip Şampiyonlar Ligi’nde son 16\'ya kalma başarısı. Galatasaray’ın global bir marka olarak zirve yaptığı modern dönem sezonu.', null, 'Şampiyonlar Ligi’nde güçlü yürüyüş.', null, null, false, 88, 'Roberto Mancini', $adminId),
            $this->makeSeasonArchiveRow('2014-2015-4-yildizin-takildigi-yil', 'Türkiye’de Bir İlk: 20. Şampiyonluk ve 4. Yıldız', '2014-2015', 2014, 2015, '4. yıldızın takıldığı tarihi sezon.', 'Hamza Hamzaoğlu yönetiminde "3 Kupa" ile tamamlanan sezon. Galatasaray’ın Türkiye’de 4. yıldızı göğsüne takan ilk kulüp olarak ezeli rekabette farkı açtığı tarihi dönemeç.', '20. şampiyonluk geldi.', null, 'Türkiye Kupası da kazanıldı.', null, false, 90, 'Hamza Hamzaoğlu', $adminId),
            $this->makeSeasonArchiveRow('2022-2023-cumhuriyetin-100-yil-sampiyonlugu-sezonu', '100. Yılda En Büyük Cimbom: Okan Buruk ve Rekorlar', '2022-2023', 2022, 2023, 'Cumhuriyetin 100. yılında gelen unutulmaz şampiyonluk.', 'Cumhuriyetin 100. yılında şampiyonluk parolasıyla çıkılan, 14 maçlık galibiyet serisiyle rekorların kırıldığı ve Icardi’nin ikonikleştiği sezon. Bu zafer, kulübün modern çağdaki yükselişinin ve yeni hegemonyasının başlangıcıdır.', 'Lig şampiyonluğu.', null, null, null, true, 96, 'Okan Buruk', $adminId),
        ];
    }

    private function trophyPayloads(): array
    {
        return [
            $this->makeTrophyRow('super-lig', 'Süper Lig', 'futbol', 'ulusal', 1),
            $this->makeTrophyRow('turkiye-kupasi', 'Türkiye Kupası', 'futbol', 'ulusal', 2),
            $this->makeTrophyRow('uefa-kupasi', 'UEFA Kupası', 'futbol', 'uluslararasi', 3),
            $this->makeTrophyRow('uefa-super-kupa', 'UEFA Süper Kupa', 'futbol', 'uluslararasi', 4),
            $this->makeTrophyRow('euroleague-women', 'EuroLeague Women', 'basketbol', 'uluslararasi', 5),
            $this->makeTrophyRow('turkiye-basketbol-sampiyonlugu', 'Türkiye Basketbol Şampiyonluğu', 'basketbol', 'ulusal', 6),
            $this->makeTrophyRow('avrupa-kupasi-finali', 'Avrupa Kupası Finali', 'basketbol', 'uluslararasi', 7),
            $this->makeTrophyRow('tsb-avrupa-kupasi', 'Tekerlekli Sandalye Basketbol Avrupa Kupası', 'basketbol', 'uluslararasi', 8),
        ];
    }

    private function historyEventLegendRelations(): array
    {
        return [
            ['history_event_slug' => 'aglari-yirtan-gol-metin-oktay-1959', 'legend_slug' => 'metin-oktay', 'is_primary' => true, 'relation_type' => 'main_subject', 'notes' => null, 'sort_order' => 0],
            ['history_event_slug' => 'taffarelin-henryye-dur-dedigi-an-17-mayis-2000', 'legend_slug' => 'claudio-taffarel', 'is_primary' => true, 'relation_type' => 'main_subject', 'notes' => null, 'sort_order' => 0],
            ['history_event_slug' => 'popescunun-son-penaltisi-ve-kupa-17-mayis-2000', 'legend_slug' => 'fatih-terim', 'is_primary' => true, 'relation_type' => 'associated', 'notes' => null, 'sort_order' => 0],
            ['history_event_slug' => 'popescunun-son-penaltisi-ve-kupa-17-mayis-2000', 'legend_slug' => 'gheorghe-hagi', 'is_primary' => false, 'relation_type' => 'associated', 'notes' => null, 'sort_order' => 1],
            ['history_event_slug' => 'popescunun-son-penaltisi-ve-kupa-17-mayis-2000', 'legend_slug' => 'bulent-korkmaz', 'is_primary' => false, 'relation_type' => 'associated', 'notes' => null, 'sort_order' => 2],
            ['history_event_slug' => 'jardelin-altin-goluyle-super-kupa-25-agustos-2000', 'legend_slug' => 'fatih-terim', 'is_primary' => false, 'relation_type' => 'associated', 'notes' => null, 'sort_order' => 0],
            ['history_event_slug' => 'kadikoyde-karanlikta-kalkan-kupa-12-mayis-2012', 'legend_slug' => 'fernando-muslera', 'is_primary' => false, 'relation_type' => 'associated', 'notes' => null, 'sort_order' => 0],
            ['history_event_slug' => 'icardinin-old-traffordu-susturusu-2023', 'legend_slug' => 'mauro-icardi', 'is_primary' => true, 'relation_type' => 'main_subject', 'notes' => null, 'sort_order' => 0],
        ];
    }

    private function historyEventTrophyRelations(): array
    {
        return [
            ['history_event_slug' => 'popescunun-son-penaltisi-ve-kupa-17-mayis-2000', 'trophy_slug' => 'uefa-kupasi', 'is_primary' => true, 'relation_type' => 'won_trophy', 'notes' => null, 'sort_order' => 0],
            ['history_event_slug' => 'jardelin-altin-goluyle-super-kupa-25-agustos-2000', 'trophy_slug' => 'uefa-super-kupa', 'is_primary' => true, 'relation_type' => 'won_trophy', 'notes' => null, 'sort_order' => 0],
            ['history_event_slug' => 'namaglup-avrupa-sampiyonu-ilk-ve-tek-2000', 'trophy_slug' => 'uefa-kupasi', 'is_primary' => true, 'relation_type' => 'won_trophy', 'notes' => null, 'sort_order' => 0],
            ['history_event_slug' => 'real-madridi-deviren-dunyanin-en-buyugu-2000', 'trophy_slug' => 'uefa-super-kupa', 'is_primary' => true, 'relation_type' => 'won_trophy', 'notes' => null, 'sort_order' => 0],
            ['history_event_slug' => 'yildiz-savaslarinin-galibi-ilk-20-sampiyonluk-2015', 'trophy_slug' => 'super-lig', 'is_primary' => true, 'relation_type' => 'won_trophy', 'notes' => null, 'sort_order' => 0],
            ['history_event_slug' => 'sarayin-sultanlari-avrupanin-zirvesinde-2014', 'trophy_slug' => 'euroleague-women', 'is_primary' => true, 'relation_type' => 'won_trophy', 'notes' => null, 'sort_order' => 0],
            ['history_event_slug' => 'dortte-dort-yapan-ilk-ve-tek-takim-1996-2000', 'trophy_slug' => 'super-lig', 'is_primary' => true, 'relation_type' => 'won_trophy', 'notes' => null, 'sort_order' => 0],
            ['history_event_slug' => 'engelsiz-aslanlardan-dunya-dominasyonu', 'trophy_slug' => 'tsb-avrupa-kupasi', 'is_primary' => true, 'relation_type' => 'won_trophy', 'notes' => null, 'sort_order' => 0],
            ['history_event_slug' => 'turkiyenin-tartismasiz-kupa-beyi', 'trophy_slug' => 'turkiye-kupasi', 'is_primary' => true, 'relation_type' => 'won_trophy', 'notes' => null, 'sort_order' => 0],
        ];
    }

    private function makeNewsRow(
        string $slug,
        string $title,
        ?int $categoryId,
        ?int $authorId,
        string $branch,
        string $summary,
        string $content,
        CarbonImmutable $publishedAt,
        bool $heroEligible,
        ?string $sourceUrl
    ): array {
        return [
            'unique' => ['slug' => $slug],
            'payload' => [
                'category_id' => $categoryId,
                'author_user_id' => $authorId,
                'branch' => $branch,
                'title' => $title,
                'slug' => $slug,
                'summary' => $summary,
                'content' => $content,
                'cover_image_path' => null,
                'source_url' => $sourceUrl,
                'published_at' => $publishedAt->toDateTimeString(),
                'status' => 'published',
                'hero_eligible' => $heroEligible,
                'is_ai_generated' => false,
                'is_demo' => true,
            ],
        ];
    }

    private function makeHistoryEventRow(
        string $slug,
        string $title,
        string $type,
        string $eventDate,
        bool $isOnThisDay,
        bool $isFeatured,
        int $importanceScore,
        string $canonicalKey,
        string $description,
        string $content,
        ?int $createdBy
    ): array {
        $date = CarbonImmutable::parse($eventDate);

        return [
            'unique' => ['slug' => $slug],
            'payload' => [
                'month' => (int) $date->format('m'),
                'day' => (int) $date->format('d'),
                'year' => (int) $date->format('Y'),
                'event_date' => $date->toDateString(),
                'start_date' => null,
                'end_date' => null,
                'title' => $title,
                'slug' => $slug,
                'type' => $type,
                'description' => $description,
                'excerpt' => $description,
                'content' => $content,
                'source_url' => null,
                'is_on_this_day' => $isOnThisDay,
                'on_this_day_month' => $isOnThisDay ? (int) $date->format('m') : null,
                'on_this_day_day' => $isOnThisDay ? (int) $date->format('d') : null,
                'is_published' => true,
                'published_at' => now(),
                'importance_score' => $importanceScore,
                'is_featured' => $isFeatured,
                'is_canonical' => true,
                'canonical_key' => $canonicalKey,
                'created_by' => $createdBy,
                'is_demo' => true,
            ],
        ];
    }

    private function makeLegendRow(
        string $slug,
        string $name,
        string $title,
        string $summary,
        string $content,
        ?int $eraStartYear,
        ?int $eraEndYear,
        ?int $createdBy
    ): array {
        return [
            'unique' => ['slug' => $slug],
            'payload' => [
                'name' => $name,
                'slug' => $slug,
                'title' => $title,
                'summary' => $summary,
                'content' => $content,
                'cover_image_path' => null,
                'era_start_year' => $eraStartYear,
                'era_end_year' => $eraEndYear,
                'created_by' => $createdBy,
            ],
        ];
    }

    private function makeHistoricalMatchRow(
        string $slug,
        string $title,
        ?string $matchDate,
        string $opponent,
        string $competition,
        int $scoreFor,
        int $scoreAgainst,
        string $result,
        string $summary,
        string $content,
        bool $isFeatured,
        int $importanceScore,
        CarbonImmutable $publishedAt,
        ?int $createdBy
    ): array {
        return [
            'unique' => ['slug' => $slug],
            'payload' => [
                'title' => $title,
                'slug' => $slug,
                'summary' => $summary,
                'content' => $content,
                'match_date' => $matchDate,
                'opponent' => $opponent,
                'competition' => $competition,
                'score_for' => $scoreFor,
                'score_against' => $scoreAgainst,
                'result' => $result,
                'cover_image_path' => null,
                'importance_score' => $importanceScore,
                'is_featured' => $isFeatured,
                'is_published' => true,
                'published_at' => $publishedAt->toDateTimeString(),
                'is_demo' => true,
            ],
        ];
    }

    private function makeSeasonArchiveRow(
        string $slug,
        string $title,
        string $seasonLabel,
        int $startYear,
        int $endYear,
        string $summary,
        string $content,
        ?string $leagueSummary,
        ?string $europeSummary,
        ?string $cupSummary,
        ?string $notes,
        bool $isFeatured,
        int $importanceScore,
        ?string $managerName,
        ?int $createdBy
    ): array {
        return [
            'unique' => ['slug' => $slug],
            'payload' => [
                'title' => $title,
                'slug' => $slug,
                'summary' => $summary,
                'content' => $content,
                'season_label' => $seasonLabel,
                'start_year' => $startYear,
                'end_year' => $endYear,
                'season_overview' => $content,
                'league_summary' => $leagueSummary,
                'europe_summary' => $europeSummary,
                'cup_summary' => $cupSummary,
                'notes' => $notes,
                'manager_name' => $managerName,
                'cover_image_path' => null,
                'importance_score' => $importanceScore,
                'is_featured' => $isFeatured,
                'is_published' => true,
                'created_by' => $createdBy,
            ],
        ];
    }

    private function makeTrophyRow(
        string $slug,
        string $name,
        string $branch,
        string $scope,
        int $sortOrder
    ): array {
        return [
            'unique' => ['slug' => $slug],
            'payload' => [
                'name' => $name,
                'slug' => $slug,
                'branch' => $branch,
                'trophy_scope' => $scope,
                'description' => $name . ' için demo referans kaydı.',
                'content' => $name . ' için demo referans içeriği.',
                'is_active' => true,
                'sort_order' => $sortOrder,
                'is_demo' => true,
            ],
        ];
    }

    private function safeUpdateOrInsert(string $table, array $unique, array $payload): void
    {
        $uniqueFiltered = $this->filterByExistingColumns($table, $unique);
        $payloadFiltered = $this->filterByExistingColumns($table, $payload);

        $now = now();
        if (in_array('updated_at', $this->getColumns($table), true)) {
            $payloadFiltered['updated_at'] = $now;
        }
        if (in_array('created_at', $this->getColumns($table), true)) {
            $payloadFiltered['created_at'] = $payloadFiltered['created_at'] ?? $now;
        }

        DB::table($table)->updateOrInsert($uniqueFiltered, $payloadFiltered);
    }

    private function safeFindIdBy(string $table, string $column, mixed $value): ?int
    {
        if (! Schema::hasTable($table)) {
            return null;
        }

        if (! in_array($column, $this->getColumns($table), true)) {
            return null;
        }

        $row = DB::table($table)->select('id')->where($column, $value)->first();

        return $row?->id ? (int) $row->id : null;
    }

    /**
     * @return array<int, string>
     */
    private function getColumns(string $table): array
    {
        if (isset($this->columnsCache[$table])) {
            return $this->columnsCache[$table];
        }

        if (! Schema::hasTable($table)) {
            $this->columnsCache[$table] = [];
            return [];
        }

        $this->columnsCache[$table] = Schema::getColumnListing($table);

        return $this->columnsCache[$table];
    }

    private function filterByExistingColumns(string $table, array $data): array
    {
        $columns = $this->getColumns($table);

        if (empty($columns)) {
            return [];
        }

        $out = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $columns, true)) {
                $out[$key] = $value;
            }
        }

        return $out;
    }
}
