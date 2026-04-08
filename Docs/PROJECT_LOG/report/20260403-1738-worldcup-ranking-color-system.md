# World Cup 2026 Ranking & Color System Report

## 1. Ürün Kararı
World Cup 2026 formatında (12 grup, en iyi 3.’ler kontenjanı) karmaşıklığı azaltmak için ayrı bir "En İyi 3.’ler Sıralaması" tablosu göstermek yerine, bu veriyi doğrudan grup tablolarında renklendirme ve badge sistemi ile sunma kararı alınmıştır.

## 2. Mimari Yaklaşım
- **Arka Plan Hesabı**: Sıralama mantığı `WorldCupRankingService` içinde izole edilmiştir.
- **Source-of-Truth**: Veri kaynağı olarak "Ranking" adlı pseudo-group yerine, A’dan L’ye kadar olan gerçek grupların puan durumları kullanılmaktadır.
- **Dinamik Metadata**: Service katmanı her takım için bir `qualification` nesnesi üretir. Bu nesne `status` ve `label` içerir.

## 3. Config Yapısı (`config/worldcup.php`)
Turnuva kuralları merkezi bir dosyada tutulmaktadır:
```php
'2026' => [
    'best_third_slots' => 8,
    'ranking_sort_fields' => [
        'points' => 'desc',
        'goal_difference' => 'desc',
        'goals_for' => 'desc',
        'won' => 'desc',
    ],
]
```

## 4. Renk Sistemi Kuralları (UX)
- **Qualified Direct (Q)**: Yeşil satır + 'Q' badge. (1. ve 2. sıralar)
- **Qualified Best Third (q)**: Sarı satır + 'q' badge. (Sıralamadaki ilk 8 üçüncü)
- **Eliminated Third (e)**: Turuncu satır + 'e' badge. (Sıralama dışı kalan üçüncüler)
- **Eliminated**: Soluk/Muted satır. (Sonuncular)

## 5. Uygulanan Dosyalar
- `app/Services/WorldCup/WorldCupRankingService.php` (Yeni)
- `config/worldcup.php` (Yeni)
- `app/Services/WorldCup/WorldCupGroupService.php` (Entegrasyon)
- `app/Services/WorldCup/WorldCupHomeService.php` (Entegrasyon)
- `resources/views/worldcup/partials/group-table.blade.php` (Badge + Renk)
- `resources/views/worldcup/partials/group-table-mini.blade.php` (Renk)

## 6. Doğrulama
- ✅ **2026 (TID=4)**: Renkler ve badge'ler aktif, sıralama doğru çalışıyor.
- ✅ **2022 (TID=3)**: Otomatik fallback devrede. Tablo standart (renksiz/badgesiz) formunda sorunsuz görünüyor.
- ✅ **Crash Test**: Tüm partial'lar null-safe (`?->`) hale getirildi.

## 7. Teknik Borçlar & Notlar
- Fair Play puanları şu an DB'de bulunmadığı için tie-break olarak kullanılmamaktadır (FIFA kurallarında son aşamalardan biridir).
- Puan durumları her sayfa yüklemesinde hesaplanmaktadır. Performans için cache eklenebilir ancak mevcut yükte sorun teşkil etmemektedir.
