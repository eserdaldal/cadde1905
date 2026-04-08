# Hata Çözüm Raporu: Vite CORS / Origin Uyuşmazlığı

**Tarih:** 2026-03-05 02:29
**Güvenli Mod:** Açık (Çalışan sistem bozulmadı, gereksiz paket güncellenmedi)
**Durum:** ✅ Tamamlandı

---

## 1. Analiz ve Teşhis
Kapsamlı bir inceleme yapıldı. Docker içerisindeki Node.js versiyonu `v20.20.0` ve NPM versiyonu `10.8.2` olarak saptandı. Sorun `C:\laragon\www\cadde1905\vite.config.js` dosyasında bulunan `origin: 'http://localhost:5173'` sabit konfigürasyonundan kaynaklanıyordu. Bu kısıtlama, tarayıcının `http://localhost:8080`'den başlattığı isteği reddetmesine yol açıyordu.

Yapılan Curl (Host makine üzerinden simülasyon) teşhis testi gösterdi ki:
`Access-Control-Allow-Origin: http://localhost:5173` şeklinde sabitlenmiş bir header geliyordu.

## 2. Düzeltme İşlemi (Seçenek A Tipi Düzeltme)

Vite sunucusunun yerel geliştirme ortamındaki CORS katı kuralı esnetildi, Origin kilidi kaldırılarak Native Vite CORS motoru devreye alındı.

**Değişen Dosyalar:**

### 1) `C:\laragon\www\cadde1905\vite.config.js`

**Fark (Diff):**
```diff
--- vite.config.js
+++ vite.config.js
@@ -14,8 +14,8 @@
   server: {
     host: '0.0.0.0',
     port: 5173,
     strictPort: true,
-    origin: 'http://localhost:5173',
+    cors: true,
     hmr: {
       host: 'localhost',
       port: 5173,
     },
   },
 });
```

**Final Dosya İçeriği:**
```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    laravel({
      // CSS'i burada entry yapmıyoruz. CSS, app.js içinden import edilecek.
      input: ['resources/js/app.js'],
      refresh: true,
    }),
    tailwindcss(),
  ],
  server: {
    host: '0.0.0.0',
    port: 5173,
    strictPort: true,
    cors: true,
    hmr: {
      host: 'localhost',
      port: 5173,
    },
  },
});
```

## 3. Doğrulama Sonuçları
Değişikliğin ardından Docker Node container'ı yeniden başlatıldı (`docker compose restart node`). Sonrasında yapılan `curl -I -H "Origin: http://localhost:8080" http://localhost:5173/@vite/client` testi sonucunda Vite sunucusu aşağıdaki yanıtı vermeye başladı:

```http
HTTP/1.1 200 OK
Access-Control-Allow-Origin: *
...
```

**Sonuç:** `Access-Control-Allow-Origin` başarılı bir şekilde engeli kalkmış değere dönüştü. Tarayıcıda Asset bloğu artık oluşmayacak, Tailwind stilleri hatasız yüklenecektir.
