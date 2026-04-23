-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: localhost    Database: cadde1905
-- ------------------------------------------------------
-- Server version	8.0.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_kind` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned DEFAULT NULL,
  `width` int unsigned DEFAULT NULL,
  `height` int unsigned DEFAULT NULL,
  `duration_seconds` int unsigned DEFAULT NULL,
  `embed_provider` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `embed_url` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poster_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_text` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checksum` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_media_kind_index` (`media_kind`),
  KEY `media_storage_type_index` (`storage_type`),
  KEY `media_is_active_index` (`is_active`),
  KEY `media_created_by_index` (`created_by`),
  KEY `media_checksum_index` (`checksum`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (7,'d6ff5d7b-50ec-4a02-85a2-4590a4be0d81','image','file','public','media/news/2026/04/d6ff5d7b-50ec-4a02-85a2-4590a4be0d81.webp','test_image.png','webp','image/png',223170,1024,1024,NULL,NULL,NULL,NULL,NULL,'e7f0901633b53d00932ce7dcb3c04ebd1b5a2864c839d92d1946ccd75df15702',1,NULL,NULL,'2026-04-14 17:42:21','2026-04-14 17:42:21',NULL),(9,'4dbc12cf-d7ba-4b8e-8781-8b57351c72c1','image','file','public','media/news/2026/04/4dbc12cf-d7ba-4b8e-8781-8b57351c72c1.txt','fake.jpg','txt','image/jpeg',39,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'a7104c0f4f02c75fcccf7ec8908d0b2917790a2d5299efd477db1a8bca7136d6',1,NULL,NULL,'2026-04-14 18:49:34','2026-04-14 18:49:34',NULL),(10,'b5ce0d83-e70f-4163-93bc-81d77a0d1360','image','file','public','media/news/2026/04/b5ce0d83-e70f-4163-93bc-81d77a0d1360.jpg','alpha.png','jpg','image/png',74834,1024,1024,NULL,NULL,NULL,NULL,NULL,'c9b1e148de13e4efcec5881556b98352d72826967a39910355304c08cab1619e',1,NULL,NULL,'2026-04-14 18:50:15','2026-04-14 18:50:15',NULL);
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `author_user_id` bigint unsigned DEFAULT NULL,
  `branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `status` enum('draft','in_review','published') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `hero_eligible` tinyint(1) NOT NULL DEFAULT '0',
  `is_ai_generated` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_demo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `news_slug_unique` (`slug`),
  KEY `news_category_id_published_at_index` (`category_id`,`published_at`),
  KEY `news_author_user_id_published_at_index` (`author_user_id`,`published_at`),
  KEY `news_branch_published_at_index` (`branch`,`published_at`),
  KEY `news_status_published_at_index` (`status`,`published_at`),
  CONSTRAINT `news_author_user_id_foreign` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `news_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (4,1,NULL,'futbol','Galatasaray’dan beklenmeyen puan kaybı: Kocaelispor karşısında 1-1','galatasaraydan-beklenmeyen-puan-kaybi-kocaelispor-karsisinda-1-1','Galatasaray’ımız, Kocaelispor karşısında sahadan 1-1\'lik beraberlikle ayrılarak beklenmedik bir puan kaybı yaşadı. Mücadele sonrası gözler takımın oyununa ve teknik değerlendirmelere çevrildi.','Galatasaray’ımız, Kocaelispor karşısında sahadan 1-1\'lik beraberlikle ayrılarak beklenmeyen bir puan kaybı yaşadı. Sarı-kırmızılılar adına kazanılması beklenen bir karşılaşmadan gelen bu sonuç, hem taraftar hem de teknik ekip açısından önemli bir değerlendirme başlığı oluşturdu.\n\nKarşılaşmanın ardından ortaya çıkan tablo, yalnızca skor anlamında değil, oyun planı ve sahadaki genel görüntü açısından da dikkatle analiz edilmesi gereken bir süreci işaret ediyor. Özellikle son haftalarda yakalanan ritmin ardından gelen bu beraberlik, takımın istikrar arayışını yeniden gündeme taşıdı.\n\nGalatasaray cephesinde bu tür puan kayıpları her zaman kısa vadeli bir kırılma noktası olarak değerlendirilir. Ancak sezon uzun ve bu tür sonuçlar, doğru analiz edildiğinde takımın gelişimi için kritik fırsatlar da barındırır.\n\nŞimdi gözler, teknik heyetin yapacağı değerlendirmelere ve takımın bir sonraki maçta nasıl reaksiyon vereceğine çevrilmiş durumda. Galatasaray için önemli olan, bu puan kaybını bir düşüş değil, yeniden yükselişin başlangıcı haline getirebilmek.',NULL,'2026-04-12 19:11:00','published',1,0,'2026-04-14 09:23:09','2026-04-14 09:23:09',NULL,0),(5,1,NULL,'futbol','Okan Buruk’tan puan kaybı sonrası net mesaj','okan-buruktan-puan-kaybi-sonrasi-net-mesaj','Galatasaray Teknik Direktörü Okan Buruk, Kocaelispor beraberliğinin ardından yaptığı açıklamalarda takımın performansına ve önümüzdeki sürece dair değerlendirmelerde bulundu.','Galatasaray Teknik Direktörü Okan Buruk, Kocaelispor karşısında alınan beraberliğin ardından yaptığı açıklamalarla takımın mevcut durumuna dair önemli mesajlar verdi.\n\nBeklenmeyen puan kaybının ardından konuşan Buruk’un değerlendirmeleri, hem maçın kısa analizini hem de önümüzdeki sürece dair yaklaşımı ortaya koydu. Bu tür sonuçların sezon içindeki doğal dalgalanmalar olduğuna dikkat çekilirken, takımın odak noktasının hızlı bir şekilde toparlanmak olduğu vurgulandı.\n\nGalatasaray’da teknik ekip açısından en kritik başlık, bu tür puan kayıplarının tekrar etmemesi ve takımın istikrarlı bir performans yakalaması. Buruk’un açıklamaları da bu doğrultuda, hatalardan ders çıkarılması ve daha güçlü bir şekilde sahaya dönülmesi gerektiğine işaret ediyor.\n\nSarı-kırmızılı ekip için şimdi önemli olan, bu süreci doğru yöneterek bir sonraki maçta sahaya daha net bir reaksiyon koymak.',NULL,'2026-04-12 20:05:00','published',0,0,'2026-04-14 09:23:09','2026-04-14 09:23:09',NULL,0),(6,1,NULL,'futbol','Galatasaray’da gözler Gençlerbirliği maçında','galatasarayda-gozler-genclerbirligi-macinda','Galatasaray, Kocaelispor beraberliğinin ardından vakit kaybetmeden Gençlerbirliği maçının hazırlıklarına başladı. Takımın hedefi, sahaya güçlü bir reaksiyon koymak.','Galatasaray, Kocaelispor karşısında yaşanan puan kaybının ardından ara vermeden Gençlerbirliği maçının hazırlıklarına başladı. Sarı-kırmızılı ekipte odak tamamen bir sonraki karşılaşmaya çevrilmiş durumda.\n\nBu tür sonuçların ardından verilen ilk reaksiyon, takımın karakterini ortaya koyması açısından büyük önem taşır. Teknik ekip ve oyuncular, bu süreci en doğru şekilde değerlendirerek sahaya daha güçlü bir performans yansıtmayı hedefliyor.\n\nGalatasaray için Gençlerbirliği karşılaşması, yalnızca bir lig maçı değil; aynı zamanda yeniden ritim yakalama fırsatı anlamına geliyor. Takımın antrenman temposu ve hazırlık süreci de bu motivasyonu destekler nitelikte ilerliyor.\n\nTaraftarın beklentisi ise net: sahada daha kararlı, daha istekli ve sonucu almak isteyen bir Galatasaray görmek.',NULL,'2026-04-13 13:27:00','published',0,0,'2026-04-14 09:23:09','2026-04-14 09:23:09',NULL,0),(7,1,NULL,'futbol','Galatasaray, Göztepe deplasmanından 3 puanla döndü','galatasaray-goztepe-deplasmanindan-3-puanla-dondu','Galatasaray\'ımız, Göztepe karşısında aldığı 3-1\'lik galibiyetle önemli bir deplasman engelini kayıpsız geçti. Bu sonuç, takımın yarış içindeki kararlılığını gösteren değerli adımlardan biri oldu.','Galatasaray\'ımız, Göztepe deplasmanında aldığı 3-1\'lik galibiyetle sahadan üç puanla ayrıldı. Resmi kaynakta yer alan sonuç, sarı-kırmızılı ekibin zorlu bir dış saha sınavını başarıyla geçtiğini ortaya koydu.\n\nDeplasmanda alınan bu tür galibiyetler yalnızca puan tablosuna yazılan üç puandan ibaret değildir. Aynı zamanda takımın özgüvenini, oyun disiplinini ve sezon içindeki yürüyüşünü güçlendiren sonuçlardır. Galatasaray açısından da Göztepe karşısında gelen bu skor, yarışın kritik dönemlerinde hata payını azaltan önemli bir kazanım niteliği taşıyor.\n\nTaraftar gözünde bu galibiyetin değeri, sadece skorla sınırlı değil. Takımın dış sahada da karakter koyabilmesi, sezon sonu hedefleri açısından her zaman ayrı bir anlam taşır. Galatasaray yoluna devam ederken bu galibiyet, hafızada güçlü bir deplasman adımı olarak yerini aldı.',NULL,'2026-04-08 19:02:00','published',0,0,'2026-04-14 09:49:47','2026-04-14 09:49:47',NULL,0),(8,1,NULL,'futbol','Barış Alper Yılmaz, Galatasaray formasında bir kez daha dalya dedi','baris-alper-yilmaz-galatasaray-formasinda-bir-kez-daha-dalya-dedi','Barış Alper Yılmaz, Galatasaray kariyerinde bir önemli eşiği daha geride bıraktı. Resmi kaynakta yer alan bu başlık, oyuncunun sarı-kırmızılı forma altındaki istikrarlı yürüyüşünü öne çıkarıyor.','Galatasaray\'da bazı anlar skordan bağımsız şekilde değer taşır. Barış Alper Yılmaz\'ın kulüp kariyerinde bir kez daha dalya demesi de bu özel başlıklardan biri oldu. Resmi kaynakta yer alan duyuru, oyuncunun sarı-kırmızılı formayla ulaştığı yeni kilometre taşını teyit ediyor.\n\nBu tür eşikler, bir oyuncunun yalnızca forma giydiği maç sayısını değil, kulüple kurduğu bağı, istikrarını ve sürekliliğini de yansıtır. Barış Alper Yılmaz\'ın Galatasaray formasıyla bu seviyeye yeniden ulaşmış olması, takım içindeki yerini ve katkısının devamlılığını gösteren güçlü bir işaret olarak öne çıkıyor.\n\nTaraftar açısından da dalya anları her zaman ayrı bir anlam taşır. Çünkü bu başlıklar, bir oyuncunun artık yalnızca kadronun parçası değil, kulübün hikâyesine yazılmış isimlerden biri haline geldiğini hatırlatır. Barış Alper Yılmaz için gelen bu yeni eşik, Galatasaray yolculuğunda dikkat çekici bir not olarak kayda geçti.',NULL,'2026-04-12 19:20:00','published',0,0,'2026-04-14 09:49:47','2026-04-14 09:49:47',NULL,0),(9,1,NULL,'futbol','Galatasaray\'da 2026-2027 sezonu kombine heyecanı başladı','galatasarayda-2026-2027-sezonu-kombine-heyecani-basladi','Galatasaray, 2026-2027 futbol sezonu için kombine satış sürecini başlattı. Yeni sezon öncesi tribünlerde yerini erkenden almak isteyen taraftarlar için önemli dönem resmen açılmış oldu.','Galatasaray\'da yeni sezonun heyecanı, sahadaki hazırlıklar kadar tribünlerdeki hareketlilikle de hissedilmeye başladı. Resmi kaynakta yer alan duyuruya göre 2026-2027 futbol sezonu kombine satışları başladı.\n\nKombine süreci, Galatasaray taraftarı için yalnızca bir biletleme dönemi değil, yeni sezona bağlılık gösterisinin de ilk adımıdır. Tribünde yerini erkenden ayırmak isteyen taraftarlar için bu dönem, sezon başlamadan önce kurulan bağın en görünür örneklerinden biridir.\n\nSarı-kırmızılı camiada tribün kültürü her zaman takımın kimliğinin önemli bir parçası oldu. Bu nedenle kombine satışlarının başlaması, yalnızca organizasyonel bir gelişme değil, aynı zamanda yeni sezon atmosferinin resmi olarak hissedilmeye başlaması anlamına geliyor. Galatasaray\'da yeni yolculuğun çağrısı bu kez tribünlerden geldi.',NULL,'2026-04-10 13:59:00','published',0,0,'2026-04-14 09:49:47','2026-04-14 09:49:47',NULL,0),(10,1,NULL,'futbol','VIP koltuk satışlarında yeni dönem: 2026-2027 genel satışları başladı','vip-koltuk-satislarinda-yeni-donem-2026-2027-genel-satislari-basladi','Galatasaray\'da 2026-2027 sezonu için VIP koltuk genel satış süreci başladı. Yeni sezonda maç deneyimini farklı bir noktadan yaşamak isteyen taraftarlar için önemli bir dönem açıldı.','Galatasaray, 2026-2027 sezonu için VIP koltuk genel satışlarını başlattı. Resmi kaynaktaki bu duyuru, yeni sezon hazırlıklarının saha dışındaki önemli başlıklarından biri olarak öne çıktı.\n\nVIP koltuk süreci, kulübün maç günü deneyimini daha özel bir çerçevede yaşamak isteyen taraftarlar için ayrı bir anlam taşıyor. Bu satış dönemi yalnızca bir erişim modeli sunmuyor; aynı zamanda yeni sezona yönelik ilginin ve beklentinin seviyesini de yansıtıyor.\n\nGalatasaray\'da tribün yalnızca maç izlenen bir alan değil, aidiyetin canlı biçimde hissedildiği bir buluşma noktası. VIP koltuk genel satışlarının başlaması da yeni sezonun kurumsal ve taraftar tarafındaki hazırlıklarının hız kazandığını gösteriyor. Sezon yaklaşırken kulübün etrafındaki hareketlilik giderek daha görünür hale geliyor.',NULL,'2026-04-13 07:57:00','published',0,0,'2026-04-14 09:49:47','2026-04-14 09:49:47',NULL,0),(11,1,NULL,'voleybol','Galatasaray Daikin, Türk Hava Yolları karşısında kritik bir galibiyet aldı','galatasaray-daikin-turk-hava-yollari-karsisinda-kritik-bir-galibiyet-aldi','Galatasaray Daikin, Türk Hava Yolları karşısında sahadan 3-2\'lik galibiyetle ayrıldı. Mücadele, takımın direnç ve karakter koyduğu önemli sonuçlardan biri olarak öne çıktı.','Galatasaray Daikin, Türk Hava Yolları karşısında 3-2 kazanarak önemli bir sonuca imza attı. Resmi kaynakta yer alan skor bilgisi, sarı-kırmızılı ekibin zorlu mücadeleyi galibiyetle tamamladığını gösteriyor.\n\nBeş sete yayılan ya da büyük mücadele gerektiren voleybol maçları, çoğu zaman takımın karakterini daha görünür hale getirir. 3-2\'lik sonuçlar da bu yüzden yalnızca bir galibiyet değil, aynı zamanda direnç testi olarak okunur. Galatasaray Daikin açısından gelen bu skor, hem moral hem de ritim bakımından değerli bir kazanım anlamı taşıyor.\n\nGalatasaray markasının çok branşlı kimliği içinde voleybolun ayrı bir yeri var. Bu galibiyet, o kimliğin sahadaki karşılığını güçlendiren sonuçlardan biri oldu. Taraftar için mesaj net: sarı-kırmızılı mücadele, sadece futbolda değil, parkede ve salonda da aynı inançla devam ediyor.',NULL,'2026-04-12 13:04:00','published',0,0,'2026-04-14 09:49:47','2026-04-14 09:49:47',NULL,0),(12,1,NULL,'voleybol','Galatasaray HDI Sigorta, Halkbank deplasmanında net bir galibiyete ulaştı','galatasaray-hdi-sigorta-halkbank-deplasmaninda-net-bir-galibiyete-ulasti','Galatasaray HDI Sigorta, Halkbank karşısında deplasmanda 3-0 kazanarak güçlü bir sonuç aldı. Bu skor, takımın sahaya koyduğu net iradenin ve oyun üstünlüğünün göstergesi oldu.','Galatasaray HDI Sigorta, Halkbank deplasmanında 3-0 kazanarak dikkat çeken bir galibiyet elde etti. Resmi kaynakta yer alan sonuç bilgisi, sarı-kırmızılı ekibin mücadeleyi set vermeden tamamladığını doğruluyor.\n\nDeplasmanda alınan 3-0\'lık galibiyetler, her branşta ayrı bir ağırlık taşır. Çünkü bu tür skorlar, yalnızca kazanmayı değil, oyunun kontrolünü büyük ölçüde elinde tutmayı da işaret eder. Galatasaray HDI Sigorta açısından da bu sonuç, takımın disiplinini ve hedefe odaklı görüntüsünü öne çıkaran değerli bir veri sundu.\n\nGalatasaray\'ın çok branşlı yapısında bu tip galibiyetler, kulübün genel sportif gücünü destekleyen başlıklardır. Taraftar için de bu sonuç, kulübün farklı alanlarda aynı kararlılıkla varlık göstermeye devam ettiğinin güçlü bir hatırlatması oldu.',NULL,'2026-04-12 18:19:00','published',0,0,'2026-04-14 09:49:47','2026-04-14 09:49:47',NULL,0),(13,1,NULL,'voleybol','Galatasaray\'da Halkbank maçı için bilet satış süreci başladı','galatasarayda-halkbank-maci-icin-bilet-satis-sureci-basladi','Galatasaray\'ın Halkbank karşılaşması için bilet satışları başladı. Sarı-kırmızılı taraftarlar, takımın yanında olmak için yeni maçın tribün hazırlıklarına şimdiden geçti.','Galatasaray\'da Halkbank maçı için bilet satış süreci başladı. Resmi kaynakta yer alan duyuru, yaklaşan karşılaşma öncesinde tribün hareketliliğinin resmen başladığını gösteriyor.\n\nBilet satış haberleri ilk bakışta organizasyonel bir duyuru gibi görünse de Galatasaray kültüründe bunun karşılığı çok daha güçlüdür. Çünkü her satış dönemi, taraftarın takımıyla yeniden buluşacağı günün yaklaşması anlamına gelir. Salondaki ya da stattaki atmosferin temeli, işte bu erken hazırlık sürecinde atılır.\n\nGalatasaray taraftarı için maç günü yalnızca doksan dakika ya da birkaç setten ibaret değildir. O günün heyecanı, biletlerin satışa çıktığı andan itibaren başlar. Halkbank karşılaşması için başlayan bu süreç de sarı-kırmızılı camianın takımıyla kurduğu güçlü bağın yeni bir durağı oldu.',NULL,'2026-04-13 17:05:00','published',0,0,'2026-04-14 09:49:47','2026-04-14 09:49:47',NULL,0);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-22 23:01:07
