# SSOT BOOTSTRAP RULE

This project uses a strict SSOT (Single Source of Truth) system.

ENTRY POINT:
C:\laragon\www\Docs\PROJECT_LOG\SSOT_INDEX.md

MANDATORY:
- All work must start from SSOT_INDEX.md
- No assumption is allowed without verification (Repo-First)

---

## AGENT-SSOT GÜNCELLEME PROTOKOLÜ (V1.0)

Bu oturumda ve gelecekteki SSOT güncellemelerinde aşağıdaki kurallar katı bir şekilde uygulanır:

1. **Repo Doğrulaması:** Herhangi bir bilgi eklemeden önce `C:\laragon\www\cadde1905` içindeki gerçek kod kontrol edilir. SSOT sadece doğrulanmış gerçeğe dayanır.
2. **SSOT Kök Dizini:** `C:\laragon\www\Docs\PROJECT_LOG` dizini ana çalışma alanıdır.
3. **Kapsam Sınırı:** Sadece belirtilen SSOT dosyalarında çalışılır. Yeni dosyalar için onay alınır.
4. **Uygulama İzolasyonu:** Bu görev kapsamında uygulama koduna (`app`, `resources` vb.) dokunulmaz.
5. **Yapı Koruma:** Başlık hiyerarşisi, markdown düzeni, karar/görev numaraları ve tarih blokları korunur.
6. **Silme Kısıtı:** Sadece hatalı, çelişen veya gereksiz tekrarlar silinir. Keyfi silme yapılamaz.
7. **Semantik Yerleşim:** Bilgiler rastgele sona eklenmez; ilgili ve doğru bölüme yerleştirilir.
8. **Teknik Doğrulama Zorunluluğu:** Aşağıdaki maddeler repo üzerinden bizzat doğrulanır:
    - Snapshot persistence / `sports_snapshots` tablosu.
    - Snapshot-first serving ve canonical key seti.
    - Scheduler (10dk/30dk) frekansları.
    - Public path'te live API bulunmaması.
    - API-off test senaryoları.
9. **Çalışma Sırası:** `DECISIONS.md` → `PROJE_DURUMU.md` → `KODLAMA_GOREVLERI.md` → `SESSION_START.md`.
10. **Karar Kuralı:** Mimari kararlar detaylı olarak `DECISIONS.md`'de yer alır; diğer dosyalarda etkileri özetlenir.
11. **Geliştirme İlkesi:** Dağınık ifadeler yerine mevcut bölümler güçlendirilir.
12. **Dil:** Tüm yazışma ve dokümantasyon Türkçe yapılır.
13. **Kesinlik:** Emin olunmayan bilgi SSOT'a girilmez; gerekirse repo tekrar kontrol edilir.
14. **Raporlama:** İşlem sonunda; dosyalar, eklenen/düzeltilen kısımlar ve doğrulanan dosyaları içeren kısa bir rapor sunulur.

---

CORE PRINCIPLE:
This layer does not define the system features; it only ensures the system's state and decisions are correctly reflected in the SSOT.

