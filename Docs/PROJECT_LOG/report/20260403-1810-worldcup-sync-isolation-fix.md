# World Cup Sync Isolation Fix Report

**Date:** 2026-04-03
**Scope:** SyncMatchesStage Isolation Bug

## Sorun Neydi?
`SyncMatchesStage` sınıfı, `run()` metodu içinde senkronizasyonun hedefi olan turnuvayı (`tournament_id`) `context` üzerinden almak yerine, veritabanındaki global aktif turnuvayı (`is_active = true`) sorgulayarak belirliyordu. Bu durum, senkronizasyon emrini veren ana servisin (`WorldCupSyncService`) niyeti ile alt aşamanın (stage) gerçekleştirdiği eylemin sapmasına neden oluyordu.

## Neden Riskliydi?
Bu mantık hatası, sistemde veri sızıntısına (data leakage) ve üzerine yazma (overwrite) sorunlarına yol açıyordu:
1.  **Yanlış Hedef:** Örneğin 2026 turnuvası aktifken, arka planda veya manuel olarak 2022 turnuvası için bir sync çalıştırıldığında, 2022 verileri 2026 turnuvasının veritabanı "bucket"larına (ID=4) yazılıyordu.
2.  **Veri Bozulması:** Bu durum, aktif turnuvanın gerçek olmayan (eski) verilerle dolmasına ve istatistiklerin bozulmasına neden olmaktaydı.
3.  **Log Tutarsızlığı:** `SyncLog` kayıtlarında doğru turnuva ID'si görünürken, gerçek veritabanı işlemlerinin başka bir ID altında yapılması hata takibini imkansız kılıyordu.

## Ne Değiştirildi?
- `SyncMatchesStage::run()` metodu içindeki `WorldCup::query()->where('is_active', true)->firstOrFail()` sorgusu tamamen kaldırıldı.
- `tournamentId` değişkeni artık doğrudan `$context['tournament_id']` üzerinden alınmaktadır.
- Geçersiz bir `tournament_id` durumunda (<= 0) senkronizasyonu durdurmak için `RuntimeException` fırlatılmaktadır.
- Artık kullanılmayan `App\Models\WorldCup\WorldCup` import'u dosyadan temizlendi.

## Özellikle Ne Değiştirilmedi?
- **Zero Refactor Stratejisi:** Mevcut veri işleme mantığı, mapping'ler, stadium resolve fallback'leri ve save akışına dokunulmadı.
- **Mevcut Veriler:** Veritabanındaki halihazırda bozulmuş olan (2026 altına yazılmış 2022 verileri vb.) kayıtlar bu işlemle düzeltilmedi.
- **Sync Tetikleyici:** Sync motoru çalıştırılmadı, sadece motorun "parçası" olan bu stage'in mantığı düzeltildi.

## Sonraki Adım
Bu aşamadan sonraki teknik adım bir "veri düzeltme" (data correction) değil, **"veri kurtarma" (data recovery)** planı olmalıdır. 2026 altına hatalı yazılan 2022 verileri temizlenmeli ve izolasyon sağlandığı için 2026 için temiz bir sync çekilmelidir.
