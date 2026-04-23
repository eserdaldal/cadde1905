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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('cadde1905-cache-page.match_center.team_645.season_2025','a:5:{s:6:\"status\";s:2:\"ok\";s:5:\"match\";a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:997;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/997.png\";s:4:\"name\";s:21:\"Gençlerbirliği S.K.\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:206;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/206.png\";s:4:\"name\";s:16:\"Türkiye Kupası\";s:5:\"round\";s:14:\"Quarter-finals\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:0;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1531969;s:4:\"date\";s:25:\"2026-04-22T17:30:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";N;s:4:\"city\";s:8:\"Istanbul\";s:4:\"name\";s:9:\"Rams Park\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1776879000;}}s:7:\"away_id\";i:997;s:7:\"home_id\";i:645;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/997.png\";s:9:\"away_name\";s:21:\"Gençlerbirliği S.K.\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"home_name\";s:11:\"Galatasaray\";s:9:\"league_id\";i:206;s:10:\"detail_url\";s:12:\"/mac/1531969\";s:10:\"fixture_id\";i:1531969;s:10:\"venue_city\";s:8:\"Istanbul\";s:10:\"venue_name\";s:9:\"Rams Park\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/206.png\";s:11:\"league_name\";s:16:\"Türkiye Kupası\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"22.04.2026 17:30\";}s:8:\"upcoming\";a:5:{i:0;a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:997;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/997.png\";s:4:\"name\";s:21:\"Gençlerbirliği S.K.\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:206;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/206.png\";s:4:\"name\";s:16:\"Türkiye Kupası\";s:5:\"round\";s:14:\"Quarter-finals\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:0;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1531969;s:4:\"date\";s:25:\"2026-04-22T17:30:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";N;s:4:\"city\";s:8:\"Istanbul\";s:4:\"name\";s:9:\"Rams Park\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1776879000;}}s:7:\"away_id\";i:997;s:7:\"home_id\";i:645;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/997.png\";s:9:\"away_name\";s:21:\"Gençlerbirliği S.K.\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"home_name\";s:11:\"Galatasaray\";s:9:\"league_id\";i:206;s:10:\"detail_url\";s:12:\"/mac/1531969\";s:10:\"fixture_id\";i:1531969;s:10:\"venue_city\";s:8:\"Istanbul\";s:10:\"venue_name\";s:9:\"Rams Park\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/206.png\";s:11:\"league_name\";s:16:\"Türkiye Kupası\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"22.04.2026 17:30\";}i:1;a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:611;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/611.png\";s:4:\"name\";s:11:\"Fenerbahçe\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 31\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394707;s:4:\"date\";s:25:\"2026-04-26T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";N;s:4:\"city\";s:8:\"Istanbul\";s:4:\"name\";s:9:\"Rams Park\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1777222800;}}s:7:\"away_id\";i:611;s:7:\"home_id\";i:645;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/611.png\";s:9:\"away_name\";s:11:\"Fenerbahçe\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"home_name\";s:11:\"Galatasaray\";s:9:\"league_id\";i:203;s:10:\"detail_url\";s:12:\"/mac/1394707\";s:10:\"fixture_id\";i:1394707;s:10:\"venue_city\";s:8:\"Istanbul\";s:10:\"venue_name\";s:9:\"Rams Park\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"26.04.2026 17:00\";}i:2;a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:3603;s:4:\"logo\";s:51:\"https://media.api-sports.io/football/teams/3603.png\";s:4:\"name\";s:10:\"Samsunspor\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 32\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394719;s:4:\"date\";s:25:\"2026-05-03T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";i:11925;s:4:\"city\";s:6:\"Samsun\";s:4:\"name\";s:24:\"Samsun 19 Mayis Stadyumu\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1777827600;}}s:7:\"away_id\";i:645;s:7:\"home_id\";i:3603;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"away_name\";s:11:\"Galatasaray\";s:9:\"home_logo\";s:51:\"https://media.api-sports.io/football/teams/3603.png\";s:9:\"home_name\";s:10:\"Samsunspor\";s:9:\"league_id\";i:203;s:10:\"detail_url\";s:12:\"/mac/1394719\";s:10:\"fixture_id\";i:1394719;s:10:\"venue_city\";s:6:\"Samsun\";s:10:\"venue_name\";s:24:\"Samsun 19 Mayis Stadyumu\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"03.05.2026 17:00\";}i:3;a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:1005;s:4:\"logo\";s:51:\"https://media.api-sports.io/football/teams/1005.png\";s:4:\"name\";s:11:\"Antalyaspor\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 33\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394725;s:4:\"date\";s:25:\"2026-05-10T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";N;s:4:\"city\";s:8:\"Istanbul\";s:4:\"name\";s:9:\"Rams Park\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1778432400;}}s:7:\"away_id\";i:1005;s:7:\"home_id\";i:645;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:51:\"https://media.api-sports.io/football/teams/1005.png\";s:9:\"away_name\";s:11:\"Antalyaspor\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"home_name\";s:11:\"Galatasaray\";s:9:\"league_id\";i:203;s:10:\"detail_url\";s:12:\"/mac/1394725\";s:10:\"fixture_id\";i:1394725;s:10:\"venue_city\";s:8:\"Istanbul\";s:10:\"venue_name\";s:9:\"Rams Park\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"10.05.2026 17:00\";}i:4;a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:1004;s:4:\"logo\";s:51:\"https://media.api-sports.io/football/teams/1004.png\";s:4:\"name\";s:11:\"Kasımpaşa\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 34\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394734;s:4:\"date\";s:25:\"2026-05-17T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";i:1585;s:4:\"city\";s:8:\"Istanbul\";s:4:\"name\";s:30:\"Recep Tayyip Erdoğan Stadyumu\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1779037200;}}s:7:\"away_id\";i:645;s:7:\"home_id\";i:1004;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"away_name\";s:11:\"Galatasaray\";s:9:\"home_logo\";s:51:\"https://media.api-sports.io/football/teams/1004.png\";s:9:\"home_name\";s:11:\"Kasımpaşa\";s:9:\"league_id\";i:203;s:10:\"detail_url\";s:12:\"/mac/1394734\";s:10:\"fixture_id\";i:1394734;s:10:\"venue_city\";s:8:\"Istanbul\";s:10:\"venue_name\";s:30:\"Recep Tayyip Erdoğan Stadyumu\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"17.05.2026 17:00\";}}s:12:\"last_matches\";a:5:{i:0;a:22:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";i:2;s:4:\"home\";i:1;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";i:2;s:4:\"home\";i:1;}s:8:\"halftime\";a:2:{s:4:\"away\";i:2;s:4:\"home\";i:0;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";b:1;}s:4:\"home\";a:4:{s:2:\"id\";i:997;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/997.png\";s:4:\"name\";s:21:\"Gençlerbirliği S.K.\";s:6:\"winner\";b:0;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 30\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394697;s:4:\"date\";s:25:\"2026-04-18T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";i:2378;s:4:\"city\";s:6:\"Ankara\";s:4:\"name\";s:15:\"Eryaman Stadium\";}s:6:\"status\";a:4:{s:4:\"long\";s:14:\"Match Finished\";s:5:\"extra\";i:7;s:5:\"short\";s:2:\"FT\";s:7:\"elapsed\";i:90;}s:7:\"periods\";a:2:{s:5:\"first\";i:1776531600;s:6:\"second\";i:1776535200;}s:7:\"referee\";s:23:\"Batuhan Kolak, Türkiye\";s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1776531600;}}s:5:\"score\";s:5:\"1 - 2\";s:6:\"result\";s:3:\"win\";s:7:\"away_id\";i:645;s:7:\"home_id\";i:997;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"away_name\";s:11:\"Galatasaray\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/997.png\";s:9:\"home_name\";s:21:\"Gençlerbirliği S.K.\";s:9:\"league_id\";i:203;s:10:\"away_goals\";i:2;s:10:\"detail_url\";s:12:\"/mac/1394697\";s:10:\"fixture_id\";i:1394697;s:10:\"home_goals\";i:1;s:10:\"venue_city\";s:6:\"Ankara\";s:10:\"venue_name\";s:15:\"Eryaman Stadium\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:14:\"Match Finished\";s:12:\"status_short\";s:2:\"FT\";s:14:\"match_datetime\";s:16:\"18.04.2026 17:00\";}i:1;a:22:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";i:1;s:4:\"home\";i:1;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";i:1;s:4:\"home\";i:1;}s:8:\"halftime\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:1;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:7411;s:4:\"logo\";s:51:\"https://media.api-sports.io/football/teams/7411.png\";s:4:\"name\";s:11:\"Kocaelispor\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 29\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394689;s:4:\"date\";s:25:\"2026-04-12T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";N;s:4:\"city\";s:8:\"Istanbul\";s:4:\"name\";s:18:\"Rams Park Stadyumu\";}s:6:\"status\";a:4:{s:4:\"long\";s:14:\"Match Finished\";s:5:\"extra\";i:6;s:5:\"short\";s:2:\"FT\";s:7:\"elapsed\";i:90;}s:7:\"periods\";a:2:{s:5:\"first\";i:1776013200;s:6:\"second\";i:1776016800;}s:7:\"referee\";s:23:\"Oguzhan Cakir, Türkiye\";s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1776013200;}}s:5:\"score\";s:5:\"1 - 1\";s:6:\"result\";s:4:\"draw\";s:7:\"away_id\";i:7411;s:7:\"home_id\";i:645;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:51:\"https://media.api-sports.io/football/teams/7411.png\";s:9:\"away_name\";s:11:\"Kocaelispor\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"home_name\";s:11:\"Galatasaray\";s:9:\"league_id\";i:203;s:10:\"away_goals\";i:1;s:10:\"detail_url\";s:12:\"/mac/1394689\";s:10:\"fixture_id\";i:1394689;s:10:\"home_goals\";i:1;s:10:\"venue_city\";s:8:\"Istanbul\";s:10:\"venue_name\";s:18:\"Rams Park Stadyumu\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:14:\"Match Finished\";s:12:\"status_short\";s:2:\"FT\";s:14:\"match_datetime\";s:16:\"12.04.2026 17:00\";}i:2;a:22:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";i:3;s:4:\"home\";i:1;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";i:3;s:4:\"home\";i:1;}s:8:\"halftime\";a:2:{s:4:\"away\";i:2;s:4:\"home\";i:0;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";b:1;}s:4:\"home\";a:4:{s:2:\"id\";i:994;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/994.png\";s:4:\"name\";s:8:\"Göztepe\";s:6:\"winner\";b:0;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 27\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394672;s:4:\"date\";s:25:\"2026-04-08T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";i:22441;s:4:\"city\";s:5:\"Izmir\";s:4:\"name\";s:22:\"Gürsel Aksel Stadyumu\";}s:6:\"status\";a:4:{s:4:\"long\";s:14:\"Match Finished\";s:5:\"extra\";i:4;s:5:\"short\";s:2:\"FT\";s:7:\"elapsed\";i:90;}s:7:\"periods\";a:2:{s:5:\"first\";i:1775667600;s:6:\"second\";i:1775671200;}s:7:\"referee\";s:22:\"Alper Akarsu, Türkiye\";s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1775667600;}}s:5:\"score\";s:5:\"1 - 3\";s:6:\"result\";s:3:\"win\";s:7:\"away_id\";i:645;s:7:\"home_id\";i:994;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"away_name\";s:11:\"Galatasaray\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/994.png\";s:9:\"home_name\";s:8:\"Göztepe\";s:9:\"league_id\";i:203;s:10:\"away_goals\";i:3;s:10:\"detail_url\";s:12:\"/mac/1394672\";s:10:\"fixture_id\";i:1394672;s:10:\"home_goals\";i:1;s:10:\"venue_city\";s:5:\"Izmir\";s:10:\"venue_name\";s:22:\"Gürsel Aksel Stadyumu\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:14:\"Match Finished\";s:12:\"status_short\";s:2:\"FT\";s:14:\"match_datetime\";s:16:\"08.04.2026 17:00\";}i:3;a:22:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";i:1;s:4:\"home\";i:2;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";i:1;s:4:\"home\";i:2;}s:8:\"halftime\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:1;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";b:0;}s:4:\"home\";a:4:{s:2:\"id\";i:998;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/998.png\";s:4:\"name\";s:11:\"Trabzonspor\";s:6:\"winner\";b:1;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 28\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394684;s:4:\"date\";s:25:\"2026-04-04T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";i:20189;s:4:\"city\";s:7:\"Trabzon\";s:4:\"name\";s:11:\"Papara Park\";}s:6:\"status\";a:4:{s:4:\"long\";s:14:\"Match Finished\";s:5:\"extra\";i:4;s:5:\"short\";s:2:\"FT\";s:7:\"elapsed\";i:90;}s:7:\"periods\";a:2:{s:5:\"first\";i:1775322000;s:6:\"second\";i:1775325600;}s:7:\"referee\";s:21:\"Cihan Aydin, Türkiye\";s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1775322000;}}s:5:\"score\";s:5:\"2 - 1\";s:6:\"result\";s:4:\"loss\";s:7:\"away_id\";i:645;s:7:\"home_id\";i:998;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"away_name\";s:11:\"Galatasaray\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/998.png\";s:9:\"home_name\";s:11:\"Trabzonspor\";s:9:\"league_id\";i:203;s:10:\"away_goals\";i:1;s:10:\"detail_url\";s:12:\"/mac/1394684\";s:10:\"fixture_id\";i:1394684;s:10:\"home_goals\";i:2;s:10:\"venue_city\";s:7:\"Trabzon\";s:10:\"venue_name\";s:11:\"Papara Park\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:14:\"Match Finished\";s:12:\"status_short\";s:2:\"FT\";s:14:\"match_datetime\";s:16:\"04.04.2026 17:00\";}i:4;a:22:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:4;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:4;}s:8:\"halftime\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:1;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";b:0;}s:4:\"home\";a:4:{s:2:\"id\";i:40;s:4:\"logo\";s:49:\"https://media.api-sports.io/football/teams/40.png\";s:4:\"name\";s:9:\"Liverpool\";s:6:\"winner\";b:1;}}s:6:\"league\";a:8:{s:2:\"id\";i:2;s:4:\"flag\";N;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/leagues/2.png\";s:4:\"name\";s:21:\"UEFA Champions League\";s:5:\"round\";s:11:\"Round of 16\";s:6:\"season\";i:2025;s:7:\"country\";s:5:\"World\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1528329;s:4:\"date\";s:25:\"2026-03-18T20:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";N;s:4:\"city\";s:9:\"Liverpool\";s:4:\"name\";s:7:\"Anfield\";}s:6:\"status\";a:4:{s:4:\"long\";s:14:\"Match Finished\";s:5:\"extra\";i:7;s:5:\"short\";s:2:\"FT\";s:7:\"elapsed\";i:90;}s:7:\"periods\";a:2:{s:5:\"first\";i:1773864000;s:6:\"second\";i:1773867600;}s:7:\"referee\";s:13:\"P. Raczkowski\";s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1773864000;}}s:5:\"score\";s:5:\"4 - 0\";s:6:\"result\";s:4:\"loss\";s:7:\"away_id\";i:645;s:7:\"home_id\";i:40;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"away_name\";s:11:\"Galatasaray\";s:9:\"home_logo\";s:49:\"https://media.api-sports.io/football/teams/40.png\";s:9:\"home_name\";s:9:\"Liverpool\";s:9:\"league_id\";i:2;s:10:\"away_goals\";i:0;s:10:\"detail_url\";s:12:\"/mac/1528329\";s:10:\"fixture_id\";i:1528329;s:10:\"home_goals\";i:4;s:10:\"venue_city\";s:9:\"Liverpool\";s:10:\"venue_name\";s:7:\"Anfield\";s:11:\"league_logo\";s:50:\"https://media.api-sports.io/football/leagues/2.png\";s:11:\"league_name\";s:21:\"UEFA Champions League\";s:11:\"status_long\";s:14:\"Match Finished\";s:12:\"status_short\";s:2:\"FT\";s:14:\"match_datetime\";s:16:\"18.03.2026 20:00\";}}s:4:\"meta\";a:4:{s:6:\"source\";s:16:\"sports_snapshots\";s:14:\"snapshot_stale\";b:1;s:7:\"team_id\";i:645;s:6:\"season\";i:2025;}}',1776774175),('cadde1905-cache-widgets:league_table:league:95a9f66464e5','a:10:{i:0;a:12:{s:3:\"won\";i:22;s:4:\"form\";s:5:\"WDWLW\";s:4:\"lost\";i:3;s:4:\"rank\";i:1;s:5:\"drawn\";i:5;s:6:\"played\";i:30;s:6:\"points\";i:71;s:7:\"team_id\";i:645;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"team_name\";s:11:\"Galatasaray\";s:10:\"goals_diff\";i:46;s:14:\"is_galatasaray\";b:1;}i:1;a:12:{s:3:\"won\";i:19;s:4:\"form\";s:5:\"DWWWL\";s:4:\"lost\";i:1;s:4:\"rank\";i:2;s:5:\"drawn\";i:10;s:6:\"played\";i:30;s:6:\"points\";i:67;s:7:\"team_id\";i:611;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/611.png\";s:9:\"team_name\";s:11:\"Fenerbahçe\";s:10:\"goals_diff\";i:38;s:14:\"is_galatasaray\";b:0;}i:2;a:12:{s:3:\"won\";i:19;s:4:\"form\";s:5:\"DDWWW\";s:4:\"lost\";i:3;s:4:\"rank\";i:3;s:5:\"drawn\";i:8;s:6:\"played\";i:30;s:6:\"points\";i:65;s:7:\"team_id\";i:998;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/998.png\";s:9:\"team_name\";s:11:\"Trabzonspor\";s:10:\"goals_diff\";i:25;s:14:\"is_galatasaray\";b:0;}i:3;a:12:{s:3:\"won\";i:16;s:4:\"form\";s:5:\"LWLWW\";s:4:\"lost\";i:7;s:4:\"rank\";i:4;s:5:\"drawn\";i:7;s:6:\"played\";i:30;s:6:\"points\";i:55;s:7:\"team_id\";i:549;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/549.png\";s:9:\"team_name\";s:10:\"Beşiktaş\";s:10:\"goals_diff\";i:18;s:14:\"is_galatasaray\";b:0;}i:4;a:12:{s:3:\"won\";i:13;s:4:\"form\";s:5:\"DWDDL\";s:4:\"lost\";i:8;s:4:\"rank\";i:5;s:5:\"drawn\";i:9;s:6:\"played\";i:30;s:6:\"points\";i:48;s:7:\"team_id\";i:564;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/564.png\";s:9:\"team_name\";s:12:\"Başakşehir\";s:10:\"goals_diff\";i:17;s:14:\"is_galatasaray\";b:0;}i:5;a:12:{s:3:\"won\";i:12;s:4:\"form\";s:5:\"DDLWD\";s:4:\"lost\";i:6;s:4:\"rank\";i:6;s:5:\"drawn\";i:12;s:6:\"played\";i:30;s:6:\"points\";i:48;s:7:\"team_id\";i:994;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/994.png\";s:9:\"team_name\";s:8:\"Göztepe\";s:10:\"goals_diff\";i:10;s:14:\"is_galatasaray\";b:0;}i:6;a:12:{s:3:\"won\";i:10;s:4:\"form\";s:5:\"WWLDW\";s:4:\"lost\";i:8;s:4:\"rank\";i:7;s:5:\"drawn\";i:12;s:6:\"played\";i:30;s:6:\"points\";i:42;s:7:\"team_id\";i:3603;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/3603.png\";s:9:\"team_name\";s:10:\"Samsunspor\";s:10:\"goals_diff\";i:-3;s:14:\"is_galatasaray\";b:0;}i:7;a:12:{s:3:\"won\";i:9;s:4:\"form\";s:5:\"DWWLL\";s:4:\"lost\";i:11;s:4:\"rank\";i:8;s:5:\"drawn\";i:10;s:6:\"played\";i:30;s:6:\"points\";i:37;s:7:\"team_id\";i:1007;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/1007.png\";s:9:\"team_name\";s:8:\"Rizespor\";s:10:\"goals_diff\";i:-1;s:14:\"is_galatasaray\";b:0;}i:8;a:12:{s:3:\"won\";i:9;s:4:\"form\";s:5:\"WWDWW\";s:4:\"lost\";i:11;s:4:\"rank\";i:9;s:5:\"drawn\";i:10;s:6:\"played\";i:30;s:6:\"points\";i:37;s:7:\"team_id\";i:607;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/607.png\";s:9:\"team_name\";s:9:\"Konyaspor\";s:10:\"goals_diff\";i:-3;s:14:\"is_galatasaray\";b:0;}i:9;a:12:{s:3:\"won\";i:9;s:4:\"form\";s:5:\"WLDLW\";s:4:\"lost\";i:11;s:4:\"rank\";i:10;s:5:\"drawn\";i:10;s:6:\"played\";i:30;s:6:\"points\";i:37;s:7:\"team_id\";i:3573;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/3573.png\";s:9:\"team_name\";s:12:\"Gaziantep FK\";s:10:\"goals_diff\";i:-8;s:14:\"is_galatasaray\";b:0;}}',1776776868),('cadde1905-cache-widgets:next_match:team:1e07e854680f','a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:997;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/997.png\";s:4:\"name\";s:21:\"Gençlerbirliği S.K.\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:206;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/206.png\";s:4:\"name\";s:16:\"Türkiye Kupası\";s:5:\"round\";s:14:\"Quarter-finals\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:0;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1531969;s:4:\"date\";s:25:\"2026-04-22T17:30:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";N;s:4:\"city\";s:8:\"Istanbul\";s:4:\"name\";s:9:\"Rams Park\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1776879000;}}s:7:\"away_id\";i:997;s:7:\"home_id\";i:645;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/997.png\";s:9:\"away_name\";s:21:\"Gençlerbirliği S.K.\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"home_name\";s:11:\"Galatasaray\";s:9:\"league_id\";i:206;s:10:\"detail_url\";s:12:\"/mac/1531969\";s:10:\"fixture_id\";i:1531969;s:10:\"venue_city\";s:8:\"Istanbul\";s:10:\"venue_name\";s:9:\"Rams Park\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/206.png\";s:11:\"league_name\";s:16:\"Türkiye Kupası\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"22.04.2026 17:30\";}',1776774168),('cadde1905-cache-widgets:on_this_day:global:595169677316','a:3:{s:5:\"title\";s:15:\"Tarihten Bir An\";s:8:\"strategy\";s:13:\"fallback_past\";s:4:\"item\";a:5:{s:5:\"title\";s:49:\"Avrupa’nın En İyi 4 Takımı Arasında (1989)\";s:4:\"slug\";s:39:\"avrupanin-en-iyi-4-takimi-arasinda-1989\";s:3:\"url\";s:73:\"http://localhost:8080/miras/anlar/avrupanin-en-iyi-4-takimi-arasinda-1989\";s:4:\"year\";i:1989;s:7:\"excerpt\";s:68:\"Türk futbolunun kıta çapındaki ilk büyük kulüp yürüyüşü.\";}}',1776776868),('cadde1905-cache-widgets:popular_content:global:8af9b00334ff','a:3:{i:0;a:5:{s:2:\"id\";i:4;s:5:\"title\";s:72:\"Galatasaray’dan beklenmeyen puan kaybı: Kocaelispor karşısında 1-1\";s:4:\"slug\";s:64:\"galatasaraydan-beklenmeyen-puan-kaybi-kocaelispor-karsisinda-1-1\";s:10:\"image_path\";s:90:\"http://localhost:8080/storage/media/news/2026/04/d6ff5d7b-50ec-4a02-85a2-4590a4be0d81.webp\";s:12:\"published_at\";s:19:\"2026-04-12 19:11:00\";}i:1;a:5:{s:2:\"id\";i:13;s:5:\"title\";s:68:\"Galatasaray\'da Halkbank maçı için bilet satış süreci başladı\";s:4:\"slug\";s:59:\"galatasarayda-halkbank-maci-icin-bilet-satis-sureci-basladi\";s:10:\"image_path\";s:63:\"http://localhost:8080/images/placeholders/news-placeholder.webp\";s:12:\"published_at\";s:19:\"2026-04-13 17:05:00\";}i:2;a:5:{s:2:\"id\";i:6;s:5:\"title\";s:51:\"Galatasaray’da gözler Gençlerbirliği maçında\";s:4:\"slug\";s:43:\"galatasarayda-gozler-genclerbirligi-macinda\";s:10:\"image_path\";s:63:\"http://localhost:8080/images/placeholders/news-placeholder.webp\";s:12:\"published_at\";s:19:\"2026-04-13 13:27:00\";}}',1776774168);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `campaigns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cta_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cta_route_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cta_route_params` json DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `priority` int NOT NULL DEFAULT '100',
  `starts_at` datetime DEFAULT NULL,
  `ends_at` datetime DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `campaigns_key_unique` (`key`),
  KEY `campaigns_created_by_foreign` (`created_by`),
  KEY `campaigns_updated_by_foreign` (`updated_by`),
  CONSTRAINT `campaigns_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `campaigns_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaigns`
--

LOCK TABLES `campaigns` WRITE;
/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_type_index` (`type`),
  KEY `categories_parent_id_index` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Genel','genel','genel',NULL,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(2,'Futbol','futbol','futbol',NULL,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(3,'Basketbol','basketbol','basketbol',NULL,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_tag`
--

DROP TABLE IF EXISTS `category_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_tag` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `tag_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_tag_category_id_tag_id_unique` (`category_id`,`tag_id`),
  KEY `category_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `category_tag_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_tag`
--

LOCK TABLES `category_tag` WRITE;
/*!40000 ALTER TABLE `category_tag` DISABLE KEYS */;
INSERT INTO `category_tag` VALUES (1,1,1,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(2,1,2,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(3,1,3,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(4,1,4,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(5,1,5,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(6,1,6,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(7,1,7,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(8,1,10,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(9,2,1,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(10,2,2,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(11,2,3,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(12,2,4,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(13,2,5,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(14,2,6,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(15,2,7,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(16,2,10,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(17,3,1,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(18,3,2,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(19,3,3,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(20,3,4,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(21,3,5,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(22,3,6,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(23,3,7,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(24,3,10,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(25,2,11,'2026-02-28 00:25:59','2026-02-28 00:25:59'),(26,3,12,'2026-02-28 00:28:15','2026-02-28 00:28:15'),(27,1,13,'2026-02-28 00:29:16','2026-02-28 00:29:16');
/*!40000 ALTER TABLE `category_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historical_match_history_event`
--

DROP TABLE IF EXISTS `historical_match_history_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historical_match_history_event` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `historical_match_id` bigint unsigned NOT NULL,
  `history_event_id` bigint unsigned NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `relation_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `historical_match_history_event_unique` (`historical_match_id`,`history_event_id`),
  KEY `historical_match_history_event_history_event_id_foreign` (`history_event_id`),
  KEY `historical_match_history_event_is_primary_index` (`is_primary`),
  KEY `historical_match_history_event_relation_type_index` (`relation_type`),
  KEY `historical_match_history_event_sort_order_index` (`sort_order`),
  CONSTRAINT `historical_match_history_event_historical_match_id_foreign` FOREIGN KEY (`historical_match_id`) REFERENCES `historical_matches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `historical_match_history_event_history_event_id_foreign` FOREIGN KEY (`history_event_id`) REFERENCES `history_events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historical_match_history_event`
--

LOCK TABLES `historical_match_history_event` WRITE;
/*!40000 ALTER TABLE `historical_match_history_event` DISABLE KEYS */;
/*!40000 ALTER TABLE `historical_match_history_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historical_match_legend`
--

DROP TABLE IF EXISTS `historical_match_legend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historical_match_legend` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `historical_match_id` bigint unsigned NOT NULL,
  `legend_id` bigint unsigned NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `relation_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `historical_match_legend_unique` (`historical_match_id`,`legend_id`),
  KEY `historical_match_legend_legend_id_foreign` (`legend_id`),
  KEY `historical_match_legend_is_primary_index` (`is_primary`),
  KEY `historical_match_legend_relation_type_index` (`relation_type`),
  KEY `historical_match_legend_sort_order_index` (`sort_order`),
  CONSTRAINT `historical_match_legend_historical_match_id_foreign` FOREIGN KEY (`historical_match_id`) REFERENCES `historical_matches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `historical_match_legend_legend_id_foreign` FOREIGN KEY (`legend_id`) REFERENCES `legends` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historical_match_legend`
--

LOCK TABLES `historical_match_legend` WRITE;
/*!40000 ALTER TABLE `historical_match_legend` DISABLE KEYS */;
/*!40000 ALTER TABLE `historical_match_legend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historical_match_season_archive`
--

DROP TABLE IF EXISTS `historical_match_season_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historical_match_season_archive` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `historical_match_id` bigint unsigned NOT NULL,
  `season_archive_id` bigint unsigned NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `relation_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `historical_match_season_archive_unique` (`historical_match_id`,`season_archive_id`),
  KEY `historical_match_season_archive_season_archive_id_foreign` (`season_archive_id`),
  KEY `historical_match_season_archive_is_primary_index` (`is_primary`),
  KEY `historical_match_season_archive_relation_type_index` (`relation_type`),
  KEY `historical_match_season_archive_sort_order_index` (`sort_order`),
  CONSTRAINT `historical_match_season_archive_historical_match_id_foreign` FOREIGN KEY (`historical_match_id`) REFERENCES `historical_matches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `historical_match_season_archive_season_archive_id_foreign` FOREIGN KEY (`season_archive_id`) REFERENCES `season_archives` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historical_match_season_archive`
--

LOCK TABLES `historical_match_season_archive` WRITE;
/*!40000 ALTER TABLE `historical_match_season_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `historical_match_season_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historical_match_trophy`
--

DROP TABLE IF EXISTS `historical_match_trophy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historical_match_trophy` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `historical_match_id` bigint unsigned NOT NULL,
  `trophy_id` bigint unsigned NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `relation_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `historical_match_trophy_unique` (`historical_match_id`,`trophy_id`),
  KEY `historical_match_trophy_trophy_id_foreign` (`trophy_id`),
  KEY `historical_match_trophy_is_primary_index` (`is_primary`),
  KEY `historical_match_trophy_relation_type_index` (`relation_type`),
  KEY `historical_match_trophy_sort_order_index` (`sort_order`),
  CONSTRAINT `historical_match_trophy_historical_match_id_foreign` FOREIGN KEY (`historical_match_id`) REFERENCES `historical_matches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `historical_match_trophy_trophy_id_foreign` FOREIGN KEY (`trophy_id`) REFERENCES `trophies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historical_match_trophy`
--

LOCK TABLES `historical_match_trophy` WRITE;
/*!40000 ALTER TABLE `historical_match_trophy` DISABLE KEYS */;
/*!40000 ALTER TABLE `historical_match_trophy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historical_matches`
--

DROP TABLE IF EXISTS `historical_matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historical_matches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `match_date` date DEFAULT NULL,
  `opponent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `competition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score_for` smallint unsigned DEFAULT NULL,
  `score_against` smallint unsigned DEFAULT NULL,
  `result` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `importance_score` int unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_demo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `historical_matches_slug_unique` (`slug`),
  KEY `1` (`created_by`),
  KEY `historical_matches_competition_match_date_index` (`competition`,`match_date`),
  KEY `historical_matches_opponent_match_date_index` (`opponent`,`match_date`),
  KEY `historical_matches_is_published_index` (`is_published`),
  KEY `historical_matches_published_at_index` (`published_at`),
  KEY `historical_matches_match_date_index` (`match_date`),
  KEY `historical_matches_opponent_index` (`opponent`),
  KEY `historical_matches_competition_index` (`competition`),
  KEY `historical_matches_result_index` (`result`),
  KEY `historical_matches_importance_score_index` (`importance_score`),
  KEY `historical_matches_is_featured_index` (`is_featured`),
  CONSTRAINT `1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historical_matches`
--

LOCK TABLES `historical_matches` WRITE;
/*!40000 ALTER TABLE `historical_matches` DISABLE KEYS */;
INSERT INTO `historical_matches` VALUES (1,'Galatasaray 2 - 1 Eskişehirspor (7 Haziran 1987)','galatasaray-2-1-eskisehirspor-7-haziran-1987',0,NULL,'1987-06-07','Eskişehirspor','Türkiye Birinci Futbol Ligi',2,1,'win','7 Haziran 1987 tarihinde Ali Sami Yen Stadı’nda oynanan ve Galatasaray’ın tam 14 yıl süren şampiyonluk hasretine son verdiği efsanevi maç. Prekazi ve Cüneyt Tanman’ın golleriyle gelen 2-1’lik galibiyet, sadece bir lig şampiyonluğu değil, Galatasaray’ın modern dönemdeki şampiyonluk dominasyonunun başladığı tarihtir.','1980’li yılların ortasına kadar Galatasaray taraftarı için şampiyonluk, siyah beyaz fotoğraflarda kalmış uzak bir hatıraydı. Ancak 1986-1987 sezonu, Alman hoca Jupp Derwall’in Florya’da ektiği disiplin ve modern futbol tohumlarının filizlendiği yıl oldu. Ligin son haftasına girilirken Ali Sami Yen Stadı, tarihinin en büyük kalabalıklarından birine ev sahipliği yapıyordu. Tribünlerdeki tek bir pankart o günün ruhunu özetliyordu: \"14 yılın çilesi bugün bitsin!\"\n\nPrekazi’nin Füzesi ve Tribünlerin İniltisi\nMaç başladığında sahada sadece 11 futbolcu değil, 14 yıllık birikmiş bir özlem ve devasa bir enerji vardı. Maçın en kritik anında sahneye çıkan Cevad Prekazi, o meşhur sol ayağıyla Eskişehirspor kalesine adeta bir füze gönderdi. Top ağlarla buluştuğunda Ali Sami Yen’de yer yerinden oynadı. Ancak heyecan bitmemişti; Eskişehirspor beraberliği yakalasa da kaptan Cüneyt Tanman’ın kafa vuruşu, şampiyonluk kupasının sapını Galatasaray’ın eline tutuşturdu.\n\nYıkılan Tabular ve Başlayan Yeni Çağ\nMaç bittiğinde binlerce taraftar sahaya girdi; o gün sadece bir kupa kazanılmadı, Galatasaray üzerindeki kazanamama lanetini sonsuza dek yırtıp attı. Futbolcular omuzlarda taşınırken, Galatasaray camiası bir daha asla bu kadar uzun süre şampiyonluktan uzak kalmayacağını tüm Türkiye’ye ilan ediyordu. Bu maç, bugünkü 4 yıldızlı Galatasaray\'ın temellerinin atıldığı, sarı-kırmızılı ruhun yeniden uyandığı milat noktasıdır. Eğer bugün Galatasaray Türkiye\'nin en çok şampiyon olan takımı ise, bu yürüyüşün ilk ve en zorlu adımı bu maçtır.',100,1,NULL,'2026-03-23 19:56:54','2026-04-13 10:34:51',0),(2,'Real Madrid 1 - 2 Galatasaray (25 Ağustos 2000)','real-madrid-1-2-galatasaray-25-agustos-2000',0,NULL,'2000-08-25','Real Madrid','UEFA Süper Kupa',2,1,'win','25 Ağustos 2000\'de Monaco\'da oynanan UEFA Süper Kupa finalinde Galatasaray, Real Madrid’i 2-1 mağlup ederek Avrupa\'daki büyük zaferini bir kez daha tescilledi. Bu maç, sarı-kırmızılıların dünyanın en büyüklerine karşı zirvede kalabildiğini gösteren tarihi karşılaşmalardan biridir.','UEFA Kupası zaferinin ardından Galatasaray, Avrupa\'daki başarısının tesadüf olmadığını kanıtlamak için bu kez UEFA Süper Kupa finalinde sahaya çıktı. Rakip, dönemin yıldızlarla dolu kadrosuna sahip olan Real Madrid\'di. Figo, Raul ve Roberto Carlos gibi isimlerle sahaya çıkan İspanyol devi, kağıt üzerinde favori görünüyordu. Ancak Galatasaray, sahaya korkmadan çıkan ve ne oynadığını bilen bir takım görüntüsü veriyordu.\n\nKarşılaşmada Galatasaray öne geçti, Real Madrid skoru dengeledi, fakat sarı-kırmızılılar oyun disiplininden kopmadı. Maç uzatmalara gittiğinde baskıyı daha iyi yöneten taraf Galatasaray oldu. Mario Jardel’in altın golü, sadece kupayı değil, Galatasaray\'ın dünya futbolundaki saygınlığını da mühürledi.\n\nBu galibiyet, Galatasaray için yalnızca bir kupa daha kazanmak değildi. Real Madrid gibi bir devi finalde yenmek, Avrupa başarısının bir anlık parıltı olmadığını; güçlü yapı, karakter ve özgüvenin sonucu olduğunu gösterdi. Monaco\'daki bu gece, kulüp tarihinin en yüksek uluslararası zirvelerinden biri olarak hafızalara kazındı.',100,1,NULL,'2026-03-23 19:56:54','2026-04-13 10:58:32',0),(3,'Galatasaray 3 - 2 AC Milan (3 Kasım 1999)','galatasaray-3-2-ac-milan-3-kasim-1999',0,NULL,'1999-11-03','AC Milan','UEFA Şampiyonlar Ligi',3,2,'win','3 Kasım 1999\'da Ali Sami Yen Stadı’nda oynanan ve Galatasaray’ın Avrupa devlerinden AC Milan karşısında 2-0 geriden gelerek 3-2 kazandığı unutulmaz karşılaşma. Bu galibiyet, sarı-kırmızılıların Avrupa sahnesinde gerçek anlamda iddialı olduğunu tüm kıtaya ilan ettiği maçlardan biridir.','1999-2000 sezonu Galatasaray için sadece bir Avrupa macerası değil, bir kimlik inşasıydı. Şampiyonlar Ligi grup aşamasında karşılaşılan AC Milan, o dönemin en güçlü takımlarından biri olarak Ali Sami Yen\'e gelmişti. Maç başladığında İtalyan devi kısa sürede 2-0 öne geçti ve karşılaşma Galatasaray adına kabusa dönüşmek üzereydi.\n\nAncak Ali Sami Yen\'de o gece farklı bir şey vardı. Tribünlerin baskısı ve takımın inancı birleşince oyun tamamen değişti. Galatasaray önce farkı bire indirdi, ardından beraberliği yakaladı. Dakikalar ilerledikçe Milan çözülmeye başladı ve sarı-kırmızılılar son darbeyi vurdu.\n\n3-2\'lik galibiyet sadece bir maç kazanmak değildi. Bu karşılaşma, Galatasaray\'ın Avrupa\'da büyük takımlara karşı geri adım atmayacağını gösterdiği, özgüven kazandığı ve ileride gelecek UEFA Kupası zaferinin habercisi olan kritik bir dönüm noktasıydı.',95,1,NULL,'2026-03-23 19:56:54','2026-04-13 10:49:04',0),(4,'Manchester United 3 - 3 Galatasaray (20 Ekim 1993)','manchester-united-3-3-galatasaray-20-ekim-1993',0,NULL,'1993-10-20','Manchester United','UEFA Şampiyonlar Ligi',3,3,'draw','20 Ekim 1993\'te Old Trafford\'da oynanan ve Galatasaray\'ın 2-0 geriden gelip 3-3 berabere kaldığı tarihi maç. Bu sonuç, sarı-kırmızılıların Avrupa\'da devlere karşı geri adım atmayacağını tüm kıtaya gösteren en önemli dönüm noktalarından biridir.','1993 sonbaharında Galatasaray, Avrupa futbolunun en büyük sahnelerinden birine çıktı. Rakip, Sir Alex Ferguson yönetimindeki Manchester United’dı. Old Trafford atmosferi, o dönemde birçok takım için sindirici bir baskı demekti. Maçın başında İngiliz ekibi kısa sürede 2-0 üstünlüğü yakalayınca, birçok kişi karşılaşmanın tek taraflı biteceğini düşündü.\n\nAncak Galatasaray o gece teslim olmadı. Takım önce oyuna ortak oldu, ardından bulduğu gollerle skoru çevirmeyi başardı ve bir anda 3-2 öne geçti. Old Trafford tribünlerinde şaşkınlık hakimken, Galatasaray sahada cesaret, karakter ve inanç sergiliyordu. Manchester United son bölümde beraberliği yakalasa da maçın ruhunu belirleyen taraf sarı-kırmızılılardı.\n\n3-3\'lük bu sonuç, sıradan bir beraberlik değildi. Galatasaray bu maçla Avrupa\'da büyük takımlara karşı sadece direnebilen değil, onları kendi sahasında sarsabilen bir kulüp olduğunu gösterdi. Old Trafford\'daki bu gece, ileride Ali Sami Yen\'de yaşanacak Welcome to Hell atmosferinin ve Galatasaray\'ın Avrupa kimliğinin güçlü başlangıç taşlarından biri oldu.',95,1,NULL,'2026-03-23 19:56:54','2026-04-13 10:50:01',0),(5,'Fenerbahçe 0 - 0 Galatasaray (12 Mayıs 2012)','fenerbahce-0-0-galatasaray-12-mayis-2012',0,NULL,'2012-05-12','Fenerbahçe','Süper Lig',0,0,'draw','12 Mayıs 2012\'de oynanan ve Galatasaray\'ın Kadıköy\'de aldığı 0-0\'lık sonuçla şampiyonluğunu ilan ettiği tarihi karşılaşma. Skor tabelası golsüz kalsa da bu maç, psikolojik ağırlığı ve sonuç etkisi nedeniyle kulüp tarihinin en unutulmaz mücadelelerinden biridir.','2011-2012 sezonu Galatasaray için yeniden yapılanma, toparlanma ve zirveye dönüş yılıydı. Sezonun son büyük düğümü, Süper Final uygulamasının son haftasında Kadıköy\'de çözülecekti. Rakip ezeli rakipti ve atmosfer yalnızca sportif değil, psikolojik açıdan da son derece ağırdı. Galatasaray bu maça yalnızca puan tablosu için değil, bütün sezonun emeğini taçlandırmak için çıktı.\n\nKarşılaşma boyunca oyun büyük bir gerilim içinde geçti. Temponun, tansiyonun ve baskının yüksek olduğu maçta Galatasaray savunma disiplini, orta saha direnci ve kaleci performansıyla oyundan kopmadı. Her top, her ikili mücadele, her dakika şampiyonluk ağırlığı taşıyordu. Skor değişmedi ama son düdükle birlikte tabelada yazan 0-0, sarı-kırmızılılar için bir beraberlikten çok daha büyük anlam taşıdı.\n\nBu maç, Galatasaray\'ın rakip saha ve zorlu atmosfer altında dahi hedefinden sapmadığını gösteren bir karakter sınavıydı. Şampiyonluk ilanı, sahadaki oyun kadar sonrasındaki görüntülerle de hafızalara kazındı. Kadıköy\'de alınan bu sonuç, modern dönem Galatasaray tarihinin en simgesel lig gecelerinden biri olarak yerini aldı.',100,1,NULL,'2026-03-23 19:56:54','2026-04-13 11:01:35',0),(6,'Galatasaray 3 - 2 Real Madrid (9 Nisan 2013)','galatasaray-3-2-real-madrid-9-nisan-2013',0,NULL,'2013-04-09','Real Madrid','UEFA Şampiyonlar Ligi',3,2,'win','9 Nisan 2013\'te Ali Sami Yen Spor Kompleksi\'nde oynanan ve Galatasaray\'ın Real Madrid\'i 3-2 mağlup ettiği tarihi karşılaşma. Her ne kadar toplam skor nedeniyle tur atlanamasa da, bu galibiyet Avrupa sahnesinde karakter ve direnç göstergesi olarak hafızalara kazınmıştır.','2012-2013 sezonunda Galatasaray, Şampiyonlar Ligi çeyrek finalinde Avrupa\'nın en güçlü ekiplerinden Real Madrid ile eşleşti. İlk maçta alınan sonucun ardından İstanbul\'daki rövanş, yalnızca bir formalite olarak görülüyordu. Ancak Galatasaray sahaya böyle çıkmadı. Takım, tribünlerin büyük desteğiyle ilk dakikadan itibaren oyuna ortak olduğunu gösterdi.\n\nKarşılaşma boyunca sarı-kırmızılılar oyunun temposunu yükseltti, rakibin yıldızlar topluluğuna karşı geri adım atmadı. Emmanuel Eboue\'nin golüyle umut artarken, Wesley Sneijder ve Didier Drogba\'nın attığı goller stadyumdaki atmosferi zirveye taşıdı. Real Madrid gibi bir rakibe karşı 3 gol bulmak, bu seviyede oynanan bir eşleşmede başlı başına büyük bir başarıydı.\n\nBu maç, Galatasaray\'ın modern dönemde Avrupa\'daki rekabet gücünü gösteren özel gecelerden biri olarak hatırlanır. Tur geçilememiş olsa da sahadaki mücadele, cesaret ve karakter çok netti. Ali Sami Yen\'de alınan bu 3-2\'lik galibiyet, büyük rakiplere karşı baş eğmeyen Galatasaray kimliğinin güçlü örneklerinden biri oldu.',90,0,NULL,'2026-03-23 19:56:54','2026-04-13 11:00:27',0),(7,'Galatasaray 1 - 0 Juventus (11 Aralık 2013)','galatasaray-1-0-juventus-11-aralik-2013',0,NULL,'2013-12-11','Juventus','UEFA Şampiyonlar Ligi',1,0,'win','11 Aralık 2013\'te yoğun kar yağışı altında iki güne yayılan maçta Galatasaray, Juventus\'u 1-0 mağlup ederek Şampiyonlar Ligi\'nde son 16\'ya kaldı. Bu karşılaşma, zorlu koşullar altında alınmış en simgesel Avrupa zaferlerinden biri olarak hatırlanır.','2013 yılının Aralık ayında İstanbul, ağır kış şartlarının etkisi altındaydı. Galatasaray ile Juventus arasında oynanan Şampiyonlar Ligi maçı da bu sert hava koşullarından doğrudan etkilendi. Kar yağışı nedeniyle yarıda kalan karşılaşma ertesi gün devam etti ve mücadele alışılmış bir futbol maçından çok dayanıklılık, sabır ve karakter sınavına dönüştü.\n\nSahanın ağırlaştığı, top kontrolünün zorlaştığı ve her mücadelenin fiziksel bir savaşa dönüştüğü ortamda Galatasaray oyundan kopmadı. Takım, rakibinin yıldızlarla dolu kadrosuna rağmen inancını korudu. Dakikalar ilerledikçe maçın tek bir anla çözüleceği hissi güçlendi. O an geldiğinde Wesley Sneijder sahneye çıktı ve attığı golle Juventus\'u turnuvanın dışına itti.\n\nBu galibiyet yalnızca bir üst tura çıkış anlamına gelmiyordu. Galatasaray, bu maçla Avrupa\'da en zor şartlar altında bile büyük takımları saf dışı bırakabilecek karaktere sahip olduğunu bir kez daha gösterdi. Kar altındaki bu zafer, kulübün modern dönem Avrupa hafızasında en özel gecelerden biri olarak yerini aldı.',95,0,NULL,'2026-03-23 19:56:54','2026-04-13 10:59:33',0),(8,'Neuchâtel Xamax 3 - 0 Galatasaray (26 Ekim 1988)','neuchatel-xamax-3-0-galatasaray-26-ekim-1988',0,NULL,'1988-10-26','Neuchâtel Xamax','UEFA Şampiyon Kulüpler Kupası',0,3,'loss','26 Ekim 1988\'de İsviçre\'de oynanan ve Galatasaray\'ın Neuchâtel Xamax karşısında 3-0 mağlup olduğu ilk maç. Bu ağır yenilgi, sarı-kırmızılıların Avrupa\'da en unutulmaz geri dönüş hikâyelerinden birine zemin hazırlamıştır.','1988-1989 sezonu Galatasaray için Avrupa\'da büyük hayallerin kurulduğu bir dönemdi. Ancak UEFA Şampiyon Kulüpler Kupası çeyrek finalinde karşılaşılan Neuchâtel Xamax, İsviçre\'de oynanan ilk maçta sarı-kırmızılılara adeta bir şok yaşattı. Galatasaray, deplasmanda 3-0\'lık ağır bir yenilgi alarak tur şansını neredeyse tamamen yitirmiş gibi görünüyordu.\n\nBu maç, skor tabelası açısından bir hayal kırıklığıydı. Ancak Galatasaray camiası için bu sonuç, aynı zamanda karakterin ve inancın test edildiği bir dönüm noktası oldu. Takım, İstanbul\'da oynanacak rövanş öncesinde umutsuzluğa kapılmak yerine tarihe geçecek bir geri dönüşe inanmayı seçti.\n\nİsviçre\'deki bu 3-0\'lık mağlubiyet, tek başına bir başarısızlık olarak değil, birkaç hafta sonra Ali Sami Yen Stadı\'nda yazılacak destanın başlangıcı olarak hatırlanır. Çünkü bu maç olmasaydı, Galatasaray\'ın Avrupa tarihindeki en büyük geri dönüş hikâyelerinden biri de asla yazılamazdı.',85,0,NULL,'2026-03-23 19:56:54','2026-04-13 10:37:40',0),(9,'Monaco 0 - 1 Galatasaray (1 Mart 1989)','monaco-0-1-galatasaray-1-mart-1989',0,NULL,'1989-03-01','Monaco','Şampiyon Kulüpler Kupası',1,0,'win','1 Mart 1989 tarihinde Şampiyon Kulüpler Kupası çeyrek final ilk maçında Galatasaray, deplasmanda Fransız devi Monaco\'yu 1-0 mağlup ederek tüm dünyayı şoka uğrattı. Arsène Wenger yönetimindeki yıldızlar topluluğu Monaco’yu kendi evinde yıkan bu galibiyet, Türk futbolunun Avrupa\'daki en yüksek irtifaya ulaştığı anlardan biridir.','Neuchâtel Xamax mucizesinden sonra Galatasaray\'ın karşısında, dönemin en korkutucu kadrolarından birine sahip olan Monaco vardı. Kadrosunda George Weah, Glenn Hoddle ve Manuel Amoros gibi dünya yıldızlarını barındıran, başında ise genç dahi Arsène Wenger’in bulunduğu Fransız ekibi, mutlak favori gösteriliyordu. Ancak Mustafa Denizli’nin Galatasaray’ı, Monaco’nun lüks semtindeki II. Louis Stadyumu’na teslim olmaya değil, tarih yazmaya gitmişti.\n\nII. Louis’de Stratejik Deha\nMaç başladığında Galatasaray, Avrupa tecrübesini sahaya yansıtarak disiplinli bir savunma ve hızlı hücum stratejisi izledi. Maçın en kritik anında, sağ kanattan yapılan ortaya Avrupa Gol Kralı Tanju Çolak, öyle bir kafa vuruşu yaptı ki; top adeta iğne deliğinden geçerek ağlarla buluştu. Bu gol, sadece maçı kazandırmakla kalmadı, Fransızların geçilmez denilen savunmasını darmadağın etti. Kalede Zoran Simovic’in devleştiği, defansta Cüneyt Tanman’ın geçit vermediği o gece, Galatasaray Avrupa’nın en elit takımlarından biri olduğunu kanıtladı.\n\nYarı Finalin Habercisi\nBu galibiyet, sadece bir maç sonucu değil, Türk futbolu için bir saygı duruşuydu. Deplasmanda alınan bu 1-0’lık avantaj, rövanş için büyük bir umut ışığı yaktı. Monaco gibi bir devi deplasmanda devirmek, Galatasaray’ın genlerindeki Avrupa Fatihi ruhunun sadece bir sezonluk bir tesadüf olmadığını, kalıcı bir kimlik olduğunu gösterdi. Bu kupa yolculuğu, Galatasaray’ı Avrupa\'nın en büyük 4 takımı arasına taşıyarak tarihin en parlak sayfalarından birini oluşturdu.',94,1,NULL,'2026-03-23 19:56:54','2026-04-13 11:29:15',0),(10,'Galatasaray 1 - 1 Monaco (15 Mart 1989)','galatasaray-1-1-monaco-15-mart-1989',0,NULL,'1989-03-15','Monaco','Şampiyon Kulüpler Kupası',1,1,'draw','15 Mart 1989 tarihinde, cezası nedeniyle İstanbul yerine Almanya\'nın Köln şehrinde oynanan rövanş maçında Galatasaray, Monaco ile 1-1 berabere kalarak Şampiyon Kulüpler Kupası’nda yarı finale yükseldi. Bu başarı, Türk futbol tarihinde bir kulübün Avrupa\'nın en büyük kupasında ulaştığı ilk yarı final seviyesidir.','Fransa\'da alınan 1-0\'lık galibiyetin ardından tüm Türkiye tek yürek olmuştu. Ancak UEFA\'nın verdiği ceza nedeniyle maçın Köln\'deki Müngersdorfer Stadı\'na alınması, Galatasaray\'ı evinden uzaklaştırmamış; aksine Avrupa\'daki binlerce gurbetçinin stadı sarı-kırmızı bir cehenneme çevirmesini sağlamıştı. Tribünlerdeki 60 bini aşkın taraftarın yarattığı atmosfer, Alman basınında Köln değil, Ali Sami Yen başlıklarıyla yankılandı.\n\nPrekazi’nin Unutulmaz Füzesi\nMaçın 51. dakikasında kazanılan serbest vuruşta topun başına geçen Cevad Prekazi, yaklaşık 30 metreden öyle bir vuruş yaptı ki; top adeta bir mermi gibi Monaco ağlarına takıldı. Bu gol, sadece maçın skorunu değiştirmekle kalmadı, Galatasaray\'ın yarı final biletini mühürledi. Maçın son bölümlerinde Weah’ın golüyle gelen 1-1’lik beraberlik tansiyonu yükseltse de, kalede devleşen Zoran Simovic ve savunmanın sarsılmaz direnci Monaco\'ya geçit vermedi.\n\nTürk Futbolunun Zirve Noktası\nBitiş düdüğüyle birlikte sadece Köln\'de değil, tüm Türkiye\'de yer yerinden oynadı. Galatasaray; Steaua Bükreş, Real Madrid ve Milan ile birlikte Avrupa\'nın en büyük 4 takımı arasına girerek imkansız denileni başarmıştı. Mustafa Denizli ve öğrencileri, Türk futbolunun vizyonunu sonsuza dek değiştirmiş ve Avrupa Fatihi kimliğini Galatasaray’ın alnına silinmemek üzere kazımıştı. Bu maç, 2000 yılına giden yolun en büyük ilham kaynaklarından biri olarak müze tarihindeki yerini aldı.',95,1,NULL,'2026-03-23 19:56:54','2026-04-13 11:29:20',0),(11,'Galatasaray 5 - 0 Neuchâtel Xamax (9 Kasım 1988)','galatasaray-5-0-neuchatel-xamax-9-kasim-1988',0,NULL,'1988-11-09','Neuchâtel Xamax','UEFA Şampiyon Kulüpler Kupası',5,0,'win','9 Kasım 1988\'de Ali Sami Yen Stadı’nda oynanan ve Galatasaray’ın Avrupa tarihinin en büyük geri dönüşlerinden birine imza attığı efsanevi maç. İlk maçta alınan 3-0\'lık yenilginin ardından gelen 5-0\'lık galibiyet, sarı-kırmızılıların Avrupa\'da adını duyurduğu tarihi bir dönüm noktasıdır.','26 Ekim 1988\'de İsviçre\'de oynanan ilk maçta alınan 3-0\'lık mağlubiyet, Galatasaray için Avrupa defterinin kapanmak üzere olduğu anlamına geliyordu. Ancak Ali Sami Yen Stadı\'nda oynanacak rövanş öncesinde ne takım ne de taraftarlar umudunu kaybetti. Tribünlerdeki atmosfer, daha maç başlamadan bunun sıradan bir karşılaşma olmayacağını gösteriyordu.\n\nMaçın başlamasıyla birlikte Galatasaray, tarihe geçecek bir performans sergilemeye başladı. İlk dakikalardan itibaren rakip kaleyi abluka altına alan sarı-kırmızılılar, bulduğu gollerle farkı kapatmakla kalmadı, adeta oyunu tek kaleye çevirdi. Her gol, tribünlerdeki inancı daha da büyütüyor, oyuncular sahada bir destan yazıyordu.\n\nBeşinci gol geldiğinde Ali Sami Yen artık bir stadyum değil, bir volkan gibiydi. Maç sona erdiğinde tabelada yazan 5-0, sadece bir skor değil, Galatasaray\'ın Avrupa sahnesinde kim olduğunu ilan ettiği bir manifestoydu. Bu karşılaşma, Türk futbol tarihinin en büyük geri dönüşlerinden biri olarak hafızalara kazındı ve Galatasaray\'ın Avrupa yolculuğunda bir dönüm noktası oldu.',100,1,NULL,'2026-04-13 10:48:32','2026-04-13 10:48:32',0),(12,'Galatasaray 2 - 1 Barcelona (23 Kasım 1994)','galatasaray-2-1-barcelona-23-kasim-1994',0,NULL,'1994-11-23','Barcelona','UEFA Şampiyonlar Ligi',2,1,'win','23 Kasım 1994 tarihinde Şampiyonlar Ligi grup aşamasında Galatasaray, Johan Cruyff yönetimindeki Barcelona\'yı 2-1 mağlup etti. Bu galibiyet, sarı-kırmızılıların Avrupa\'nın en büyük devlerine karşı başa baş oynayabildiğini gösteren en prestijli zaferlerden biridir.','1994 yılında Barcelona, Avrupa futbolunun mutlak hakimi ve taktiksel devrimin merkezi konumundaydı. Bir önceki sezonun finalisti olan Katalan ekibi, İstanbul’a mutlak favori olarak gelmişti. Ancak Galatasaray, o gece sahaya imkansız diye bir şey yoktur inancıyla çıktı. Ali Sami Yen tribünlerinin yarattığı baskı, dünya yıldızlarını bile sarsacak seviyedeydi.\n\nHakan Şükür ve Busquets’in Hatası\nBarcelona, Romario ile öne geçse de Galatasaray pes etmedi. Maçın dönüm noktası, Hakan Şükür’ün baskısı ve Barcelona kalecisi Carles Busquets’in hatasıyla gelen beraberlik golüydü. Bu golle birlikte statta inanç zirveye çıktı. Maçın son bölümlerinde kazanılan penaltıyı Arif Erdem gole çevirince, dünya futbolu o gece büyük bir sarsıntı yaşadı.\n\nKatalanları Dize Getiren Ruh\nMaç bittiğinde tabelada yazan 2-1, sadece bir galibiyet değil; Galatasaray’ın Avrupa’nın en büyük devleriyle başa baş oynayabileceğinin kanıtıydı. Bu zafer, kulübün 2000 yılına giden yolda devleri yenme alışkanlığını pekiştiren en prestijli Şampiyonlar Ligi sayfalarından biri olarak kaldı.',92,1,NULL,'2026-04-13 11:34:28','2026-04-13 11:34:28',0),(13,'Juventus 2 - 2 Galatasaray (16 Eylül 1998)','juventus-2-2-galatasaray-16-eylul-1998',0,NULL,'1998-09-16','Juventus','UEFA Şampiyonlar Ligi',2,2,'draw','16 Eylül 1998 tarihinde Galatasaray, Şampiyonlar Ligi grup aşamasının açılış maçında Juventus ile deplasmanda 2-2 berabere kaldı. Bu sonuç, Galatasaray\'ın Avrupa\'da elit takımlar arasında yer alma iddiasının en güçlü erken sinyallerinden biri oldu.','1998 yılının Eylül ayında Galatasaray, Fatih Terim yönetiminde Avrupa’da herkesi her yerde yenebiliriz mottosuyla yola çıkmıştı. Grubun ilk maçında rakip, Zidane ve Del Piero’lu Juventus idi. Torino’daki Delle Alpi’de oynanan maçta İtalyanlar rahat bir galibiyet bekliyordu. Ancak sahada, taktik disiplini ve özgüveni yüksek bir Galatasaray vardı.\n\nHakan Şükür ve Ümit Davala ile Sessizleşen Delle Alpi\nGalatasaray, Hakan Şükür’ün kafa golüyle öne geçtiğinde tüm İtalya şaşkına döndü. Juventus skoru 2-1\'e getirip maçı kopardığını sandığı anda sahneye Ümit Davala çıktı. Son dakikalarda gelen beraberlik golü, Delle Alpi’nin sessizliğe gömülmesine neden oldu.\n\nBir Efsanenin Ayak Sesleri\nBu maç sadece 1 puan değil, 2000 yılına giden yolda Galatasaray’ın Avrupa Fatihi kimliğinin prototipiydi. İtalyan basını maçın ardından Galatasaray’ın hücum gücünden ve Fatih Terim’in taktiksel cesaretinden övgüyle bahsetti.',90,0,NULL,'2026-04-13 11:34:33','2026-04-13 11:34:33',0),(14,'Galatasaray 2 - 1 Athletic Bilbao (30 Eylül 1998)','galatasaray-2-1-athletic-bilbao-30-eylul-1998',0,NULL,'1998-09-30','Athletic Bilbao','UEFA Şampiyonlar Ligi',2,1,'win','30 Eylül 1998 tarihinde Galatasaray, Şampiyonlar Ligi grup aşamasında Athletic Bilbao\'yu 2-1 mağlup etti. Bu galibiyet, Juventus deplasmanındaki beraberliğin tesadüf olmadığını gösteren kritik bir Avrupa virajıydı.','Juventus deplasmanından alınan 2-2’lik sonucun ardından tüm Avrupa’nın gözü Ali Sami Yen’e çevrilmişti. Rakip, İspanya’nın sert ve dirençli takımlarından Athletic Bilbao’ydu. Fatih Terim’in öğrencileri için bu maç, gruptaki iddiayı somutlaştırmak adına büyük önem taşıyordu.\n\nOkan Buruk ve Hagi’nin Resitali\nGalatasaray maçın başından itibaren oyunu rakip yarı sahaya yıktı. Okan Buruk’un golüyle öne geçti, Bilbao’nun cevabına rağmen oyundan kopmadı. Son bölümlerde Hakan Şükür’ün golü Ali Sami Yen’i yeniden ayağa kaldırdı.\n\nKusursuz Takım Oyunu\nBu galibiyet, Galatasaray’ın sadece deplasmanda değil, kendi evinde de bir Avrupa kalesi olduğunu gösterdi. Takımın yüksek presi, pas trafiği ve savunma liderliği, 2000 ruhunun temellerini daha da güçlendirdi.',88,0,NULL,'2026-04-13 11:34:38','2026-04-13 11:34:38',0),(15,'Galatasaray 1 - 1 Juventus (2 Aralık 1998)','galatasaray-1-1-juventus-2-aralik-1998',0,NULL,'1998-12-02','Juventus','UEFA Şampiyonlar Ligi',1,1,'draw','2 Aralık 1998 tarihinde Galatasaray, yoğun siyasi gerilim ortamında Juventus ile 1-1 berabere kaldı. Bu mücadele, saha dışı baskıya rağmen karakterini koruyan takımın güçlü Avrupa duruşunu simgeleyen maçlardan biri oldu.','1998 yılının son ayları Türkiye ve İtalya arasındaki diplomatik kriz nedeniyle oldukça gergindi. Juventus kafilesinin İstanbul’a gelip gelmeyeceği günlerce tartışılmış, maç ertelenmiş ve sonunda yoğun güvenlik önlemleri altında oynanmıştı. Tribünlerdeki taraftar yalnızca takımını değil, bir ülkenin onurunu temsil ettiğine inanıyordu.\n\nSuat Kaya’nın Unutulmaz Kafası\nJuventus 78. dakikada öne geçtiğinde stadyum kısa süreli sessizliğe büründü. Ancak Galatasaray teslim olmadı. Son dakikalarda Suat Kaya’nın attığı kafa golü, sadece beraberliği değil, tüm baskılara karşı kazanılmış bir direnci temsil etti.\n\nGrubun En Mağrur Takımı\nBu maç, Galatasaray’ın her türlü dış etkene rağmen başarıya odaklanma becerisini ve Avrupa’daki özgüvenini gösteren tarihi bir eşik olarak kaldı.',87,0,NULL,'2026-04-13 11:34:46','2026-04-13 11:34:46',0),(16,'Bologna 1 - 1 Galatasaray (23 Kasım 1999)','bologna-1-1-galatasaray-23-kasim-1999',0,NULL,'1999-11-23','Bologna','UEFA Kupası',1,1,'draw','23 Kasım 1999 tarihinde UEFA Kupası 3. tur ilk maçında Galatasaray, Bologna deplasmanında 1-1 berabere kaldı. Bu stratejik sonuç, İstanbul\'daki rövanş öncesinde tur kapısını aralayan kritik bir Avrupa deplasmanıydı.','Milan karşısında alınan destansı galibiyetin ardından Galatasaray, rotasını UEFA Kupası’na kırmıştı. İlk ciddi engel İtalyan futbolunun dişli ekiplerinden Bologna oldu. Renato Dall\'Ara Stadı’nda oynanan mücadele, tam bir taktik savaşı şeklinde geçti.\n\nStratejik Beraberlik ve Hakan Şükür\nMaçın 68. dakikasında geriye düşen Galatasaray, panik yapmadı. Fatih Terim’in kenardan verdiği direktiflerle oyun disiplinini koruyan takım, 81. dakikada Hakan Şükür’ün kafa golüyle dengeyi sağladı. Bu gol, yalnızca beraberliği getirmedi; deplasman golü avantajını da sarı-kırmızılıların cebine koydu.\n\nTurun Yarısı İtalya\'da Geçildi\nBologna gibi savunmasıyla nam salmış bir takıma karşı deplasmanda yenilmeden dönmek, Galatasaray’ın Avrupa’daki yenilmezlik karakterini pekiştirdi. Bu maç, UEFA Kupası yolculuğunda yalnız büyük gecelerin değil, zor deplasmanların da takımı olunduğunu gösteren önemli bir adımdı.',86,0,NULL,'2026-04-13 11:38:26','2026-04-13 11:38:26',0),(17,'Galatasaray 2 - 1 Bologna (9 Aralık 1999)','galatasaray-2-1-bologna-9-aralik-1999',0,NULL,'1999-12-09','Bologna','UEFA Kupası',2,1,'win','9 Aralık 1999 tarihinde Galatasaray, UEFA Kupası 3. tur rövanşında Bologna\'yı 2-1 mağlup ederek bir üst tura yükseldi. Bu galibiyet, sarı-kırmızılıların Avrupa\'daki özgüvenini daha da büyüten kritik eşiklerden biri oldu.','İtalya’da alınan 1-1’lik beraberliğin ardından İstanbul’da tam bir final havası vardı. Ali Sami Yen’in ağırlaşan zemininde, Bologna’nın sert savunma disiplini karşısında sabırlı ve akıllı oynamak gerekiyordu.\n\nHasan Şaş ve Ümit Davala ile Gelen Tur\nMaçın hemen başında Hasan Şaş’ın golü stadyumu ayağa kaldırdı. Bologna skoru eşitlese de Galatasaray oyundan düşmedi. 30. dakikada Ümit Davala’nın attığı gol, turun kapısını açan belirleyici vuruş oldu. Kalan dakikalarda savunma hattı ve takım disiplini İtalyan ekibine fazla alan bırakmadı.\n\nKorku Duvarı Aşılıyor\nMilan’ın ardından Bologna’nın da saf dışı bırakılması, Galatasaray’ın UEFA Kupası hedefinin bir hayalden ibaret olmadığını gösterdi. Yağmur, çamur ve baskının içinden çıkan bu galibiyet, Kopenhag yolunun ne kadar zorlu ama ne kadar gerçek olduğunu kanıtladı.',87,0,NULL,'2026-04-13 11:39:13','2026-04-13 11:39:13',0),(18,'Borussia Dortmund 0 - 2 Galatasaray (2 Mart 2000)','borussia-dortmund-0-2-galatasaray-2-mart-2000',0,NULL,'2000-03-02','Borussia Dortmund','UEFA Kupası',2,0,'win','2 Mart 2000 tarihinde UEFA Kupası 4. tur ilk maçında Galatasaray, Borussia Dortmund\'u deplasmanda 2-0 mağlup etti. Bu zafer, kupaya giden yolda Avrupa\'ya verilmiş en net güç mesajlarından biriydi.','2000 yılının Mart ayı başında Galatasaray, Avrupa’da durdurulamaz bir yürüyüş içindeydi. Rakip, taraftar gücü ve kadro kalitesiyle aşılması zor görülen Borussia Dortmund’du. Westfalenstadion’daki baskı atmosferine rağmen sarı-kırmızılı takım sahaya yalnız savunma yapmak için değil, oyunu ele geçirmek için çıktı.\n\nHakan Şükür ve Hagi’nin Resitali\nGalatasaray ilk dakikalardan itibaren presi yukarı taşıdı. Hakan Şükür’ün golü statta sessizlik yarattı, hemen ardından Hagi’nin uzaklardan bulduğu gol Dortmund’u tamamen çözdü. Sadece skor değil, oyunun kontrolü de Galatasaray’ın elindeydi.\n\nAvrupa’nın Yeni Favorisi\nBu 2-0’lık sonuç, yalnızca tur avantajı değil, UEFA Kupası’nda şampiyonluk adaylığının güçlü ilanıydı. Westfalen’de alınan bu galibiyet, Galatasaray tarihinin en etkileyici deplasman performanslarından biri olarak hafızalara kazındı.',94,1,NULL,'2026-04-13 11:39:19','2026-04-13 11:39:19',0),(19,'Galatasaray 0 - 0 Borussia Dortmund (9 Mart 2000)','galatasaray-0-0-borussia-dortmund-9-mart-2000',0,NULL,'2000-03-09','Borussia Dortmund','UEFA Kupası',0,0,'draw','9 Mart 2000 tarihinde Galatasaray, Borussia Dortmund ile 0-0 berabere kalarak UEFA Kupası\'nda çeyrek finale yükseldi. Bu maç, takımın gerektiğinde nasıl kusursuz bir savunma disipliniyle oynayabildiğini gösteren profesyonel bir Avrupa gecesiydi.','Almanya’da alınan 2-0’lık galibiyetin ardından Ali Sami Yen’de tarihi bir gece yaşanıyordu. Borussia Dortmund kadro kalitesiyle her an sonucu değiştirebilecek bir rakipti, fakat Galatasaray bu eşleşmeye yalnızca hücum değil, olgun savunma aklı da eklemişti.\n\nTaktiksel Olgunluk ve Sarsılmaz Savunma\nGalatasaray maç boyunca tur avantajını son derece akıllıca kullandı. Dortmund risk aldıkça orta saha rakibi durdurdu, savunma hattı ise Alman forvetlere net alan bırakmadı. Taffarel’in güven veren duruşu ve savunmanın konsantrasyonu, maçı baştan sona kontrol altında tuttu.\n\nÇeyrek Finale Merhaba\nGolsüz beraberlik tabelada sade görünebilir, ancak bu sonuç Galatasaray’ın Avrupa’daki büyük yürüyüşünde önemli bir profesyonellik göstergesiydi. Takım, yalnız coşkulu galibiyetlerle değil, gerektiğinde duvar gibi savunmayla da tur geçebileceğini kanıtladı.',89,0,NULL,'2026-04-13 11:39:24','2026-04-13 11:39:24',0),(20,'Real Mallorca 1 - 4 Galatasaray (16 Mart 2000)','real-mallorca-1-4-galatasaray-16-mart-2000',0,NULL,'2000-03-16','Real Mallorca','UEFA Kupası',4,1,'win','16 Mart 2000 tarihinde UEFA Kupası çeyrek final ilk maçında Galatasaray, Real Mallorca\'yı deplasmanda 4-1 mağlup ederek turu büyük ölçüde ilk maçtan bitirdi. Bu sonuç, Avrupa\'daki en görkemli deplasman performanslarından biri olarak hafızalara kazındı.','2000 yılının Mart ayında Galatasaray, Avrupa’da durdurulamaz bir ritim yakalamıştı. Çeyrek finaldeki rakip, İspanya’nın kendi sahasında kolay kolay teslim olmayan ekiplerinden Real Mallorca idi. Ancak Fatih Terim’in takımı Son Moix Stadı’na yalnız kazanmak için değil, üstünlüğünü kabul ettirmek için çıktı.\n\nHagi, Arif ve Hakan: Şiir Gibi Futbol\nİlk yarının sonlarında Arif Erdem’in aşırtma golüyle perde açıldı. İkinci yarıda Galatasaray vitesi daha da yükseltti. Hakan Şükür, Tugay Kerimoğlu ve Hakan Ünsal’ın golleriyle skor bir anda 4-0’a geldi. Bu bölümde oyun yalnızca kazanılmadı; rakip adeta çözülmeye zorlandı.\n\nFinal Artık Hayal Değil\n4-1’lik bu sonuç, Galatasaray’ın UEFA Kupası’nda yalnızca favorilerden biri değil, kupanın en güçlü adayı olduğunu gösterdi. Deplasmanda bir İspanyol takımına karşı alınan bu skor, kulüp tarihinin en baskın Avrupa gecelerinden biri oldu.',95,1,NULL,'2026-04-13 11:42:30','2026-04-13 11:42:30',0),(21,'Galatasaray 2 - 1 Real Mallorca (23 Mart 2000)','galatasaray-2-1-real-mallorca-23-mart-2000',0,NULL,'2000-03-23','Real Mallorca','UEFA Kupası',2,1,'win','23 Mart 2000 tarihinde Galatasaray, Real Mallorca\'yı İstanbul\'da 2-1 mağlup ederek UEFA Kupası\'nda yarı finale yükseldi. Bu galibiyet, İspanya\'daki büyük üstünlüğün tesadüf olmadığını gösteren güçlü bir teyitti.','İspanya’daki 4-1’lik galibiyetin ardından Ali Sami Yen’de adeta bir festival havası vardı. Buna rağmen Galatasaray maça ciddiyetle başladı ve turun rahatlığını rehavete dönüştürmedi.\n\nCapone ve Hakan Şükür ile Perde Kapanıyor\nMaçın 33. dakikasında Capone sahneye çıktı ve attığı golle tribünleri ayağa kaldırdı. Mallorca dengeyi bulsa da Galatasaray’ın Kral’ı Hakan Şükür son sözü söyledi. Böylece sarı-kırmızılılar, eşleşmenin iki ayağında da rakibini mağlup etmiş oldu.\n\nArtık Durdurulamaz Bir Güç\nBu maçın ardından Galatasaray yarı finalde Leeds United ile eşleşti. Mallorca serisi, takımın yalnızca fiziksel değil, zihinsel olarak da kupaya ne kadar hazır olduğunu gösteren önemli bir eşikti.',90,0,NULL,'2026-04-13 11:42:36','2026-04-13 11:42:36',0),(22,'Galatasaray 2 - 0 Leeds United (6 Nisan 2000)','galatasaray-2-0-leeds-united-6-nisan-2000',0,NULL,'2000-04-06','Leeds United','UEFA Kupası',2,0,'win','6 Nisan 2000 tarihinde UEFA Kupası yarı final ilk maçında Galatasaray, Leeds United\'ı 2-0 mağlup ederek final yolunda dev bir adım attı. Bu galibiyet, Ali Sami Yen\'de kurulan baskının ve takım disiplininin en güçlü örneklerinden biridir.','2000 yılının Nisan ayında İstanbul, Avrupa futbolunun merkezlerinden biriydi. Yarı finaldeki rakip, Premier Lig’in formda ve genç ekiplerinden Leeds United’dı. Ali Sami Yen’in atmosferi ise İngiliz temsilcisi için daha baştan ağır bir sınavdı.\n\nHakan Şükür ve Capone ile Gelen Zafer\nGalatasaray maça yüksek tempoyla başladı. 13. dakikada Hakan Şükür’ün kafa golüyle gelen üstünlük, rakibin planını bozdu. İlk yarının sonlarına doğru Capone’nun golü farkı ikiye çıkardı ve rövanş öncesi önemli bir güven sağladı.\n\nFinalin Ayak Sesleri\nBu 2-0’lık galibiyet, yalnızca skor avantajı değil, Avrupa finaline giden yolda büyük bir karakter göstergesiydi. Takım, hem hücumda hem savunmada kusursuza yakın bir yarı final performansı sergiledi.',93,1,NULL,'2026-04-13 11:42:42','2026-04-13 11:42:42',0),(23,'Leeds United 2 - 2 Galatasaray (20 Nisan 2000)','leeds-united-2-2-galatasaray-20-nisan-2000',0,NULL,'2000-04-20','Leeds United','UEFA Kupası',2,2,'draw','20 Nisan 2000 tarihinde Galatasaray, Leeds United deplasmanında 2-2 berabere kalarak Türk futbol tarihinin ilk Avrupa kupası finaline yükseldi. Bu maç, baskı ve gerilim altında alınmış en değerli sonuçlardan biridir.','İstanbul’daki 2-0’lık galibiyetin ardından İngiltere’deki rövanş, yalnızca sportif değil psikolojik açıdan da son derece ağır bir atmosfere sahipti. Galatasaray o gece sadece rakibiyle değil, tüm stadyum baskısıyla mücadele etti.\n\nHagi’nin Soğukkanlılığı ve Hakan’ın Bitiriciliği\nErken gelen penaltıda Hagi’nin golü, maçın dengesini sarı-kırmızılılar lehine çevirdi. Leeds cevap verse de Hakan Şükür’ün golü İngiliz ekibinin umutlarını büyük ölçüde kırdı. Kalan bölümde 10 kişiyle mücadele edilmesine rağmen takım savunması ve Taffarel’in kritik kurtarışları skoru taşıdı.\n\nFinal Bileti\nBitiş düdüğüyle birlikte Galatasaray, UEFA Kupası finaline yükselen ilk Türk takımı oldu. Elland Road’daki bu 2-2, kulüp tarihinin en büyük uluslararası eşiklerinden biridir.',96,1,NULL,'2026-04-13 11:42:48','2026-04-13 11:42:48',0),(24,'Galatasaray 0 - 0 Arsenal (P. 4-1) (17 Mayıs 2000)','galatasaray-0-0-arsenal-p-4-1-17-mayis-2000',0,NULL,'2000-05-17','Arsenal','UEFA Kupası Finali',0,0,'win','17 Mayıs 2000 tarihinde Kopenhag\'da oynanan UEFA Kupası finalinde Galatasaray, Arsenal\'i penaltılarla 4-1 mağlup ederek Avrupa\'da kupa kazanan ilk Türk takımı oldu. Bu maç, kulüp tarihinin en büyük zirvesidir.','Kopenhag’daki o akşam, yalnız bir final değil, bir ülkenin makus talihini yenme hikayesiydi. Karşıda Bergkamp, Henry, Vieira ve Overmars gibi yıldızlarla dolu Arsenal vardı. Galatasaray ise sahaya yalnız bir takım olarak değil, tüm Türkiye’nin umudu olarak çıktı.\n\nTaffarel’in Mucizesi ve On Kişi Kalan Devler\nMaç boyunca süren taktik savaşında Galatasaray rakibine kolay alan bırakmadı. Uzatmalarda Henry’nin kafa vuruşunu Taffarel’in kurtarışı, finalin en unutulmaz anlarından biri oldu. Bülent Korkmaz’ın sakatlığına rağmen direnmesi, Hagi’nin kırmızı kartına rağmen takımın ayakta kalması, bu kupanın neden emekle kazanıldığını gösterdi.\n\nPopescu’nun Son Vuruşu ve Tarihi Zafer\nPenaltılarda Galatasaray hata yapmadı, Arsenal ise çözüldü. Son topun başına geçen Gica Popescu ağları bulduğunda, Galatasaray Avrupa’nın en büyük kupalarından birini müzesine götürdü. Bu zafer, kulüp tarihinin en büyük uluslararası başarı anıdır.',100,1,NULL,'2026-04-13 11:42:53','2026-04-13 11:42:53',0),(25,'Galatasaray 3 - 2 Monaco (12 Eylül 2000)','galatasaray-3-2-monaco-12-eylul-2000',0,NULL,'2000-09-12','Monaco','UEFA Şampiyonlar Ligi',3,2,'win','12 Eylül 2000 tarihinde Galatasaray, Şampiyonlar Ligi grup aşamasının açılış maçında Monaco\'yu 3-2 mağlup etti. Bu galibiyet, UEFA Süper Kupa zaferinin tesadüf olmadığını gösteren güçlü bir Avrupa mesajıydı.','Galatasaray, Real Madrid’i devirip Avrupa’nın en büyüğü olduktan sonra Şampiyonlar Ligi’ne büyük özgüvenle başladı. Ali Sami Yen Stadı’ndaki rakip, Fransız futbolunun güçlü temsilcilerinden Monaco’ydu. Lucescu yönetimindeki takım, hücum karakteriyle taktik disiplini birleştiren yeni bir yapı sergiliyordu.\n\nGeri Dönüşün Mimarları: Jardel, Hagi ve Capone\nMonaco ilk yarıda bulduğu gollerle İstanbul’daki atmosferi kısa süreliğine susturdu. Ancak Galatasaray pes etmedi. Jardel’in bitiriciliği, Hagi’nin oyun zekası ve Capone’nun belirleyici golüyle maç 3-2’ye çevrildi. Bu geri dönüş, takımın Avrupa’daki karakterini bir kez daha ortaya koydu.\n\nAvrupa’nın Değişmeyen Hakimi\nBu galibiyet, Galatasaray’ın hoca değişse de, oyun kimliği ve Avrupa cesaretini koruduğunu gösterdi. Süper Kupa’nın ardından gelen bu sonuç, yeni sezonun büyük hedefler taşıdığını açık biçimde ilan etti.',89,0,NULL,'2026-04-13 11:46:45','2026-04-13 11:46:45',0),(26,'Galatasaray 3 - 2 Real Madrid (3 Nisan 2001)','galatasaray-3-2-real-madrid-3-nisan-2001',0,NULL,'2001-04-03','Real Madrid','UEFA Şampiyonlar Ligi',3,2,'win','3 Nisan 2001 tarihinde Galatasaray, Şampiyonlar Ligi çeyrek final ilk maçında Real Madrid\'i 3-2 mağlup etti. Bu geri dönüş, sarı-kırmızılıların Avrupa\'daki dev katili kimliğinin en güçlü örneklerinden biridir.','Real Madrid, bir önceki yıl Süper Kupa’da kaybettiği Galatasaray’dan intikam almak için İstanbul’a gelmişti. İlk yarı bittiğinde tabela 0-2’yi gösteriyordu ve İspanyollar turun büyük ölçüde çözüldüğünü düşünüyordu. Ancak ikinci yarıda sahaya bambaşka bir Galatasaray çıktı.\n\nHasan Şaş, Jardel ve Ümit Davala İhtilali\nÖnce Ümit Davala’nın penaltı golüyle umut yeniden doğdu. Ardından Hasan Şaş kariyerinin en iyi bölümlerinden birini oynayarak dengeyi sağladı. Maçın sonlarında Mario Jardel’in golü, Real Madrid’i bir kez daha İstanbul’da çaresiz bıraktı.\n\nDünya Manşetlerinde Galatasaray\nBu maç, Galatasaray’ın yalnızca bir sezonluk Avrupa parlaması yaşamadığını; aksine yeni dönemde de Avrupa’nın en büyüklerine sorun çıkaran kalıcı bir güç olduğunu gösterdi. 2-0’dan dönülen bu 3-2, kulüp hafızasında özel bir yer tuttu.',94,1,NULL,'2026-04-13 11:46:54','2026-04-13 11:46:54',0),(27,'Galatasaray 1 - 0 Lazio (11 Eylül 2001)','galatasaray-1-0-lazio-11-eylul-2001',0,NULL,'2001-09-11','Lazio','UEFA Şampiyonlar Ligi',1,0,'win','11 Eylül 2001 tarihinde Galatasaray, Şampiyonlar Ligi grup maçında Lazio\'yu 1-0 mağlup etti. Dünyanın sarsıldığı o günde alınan bu galibiyet, sahadaki disiplin ve olgunluğun güçlü bir örneğiydi.','Bu maç, futbol tarihine yalnız skorla değil, dünyanın değiştiği bir gün oynanmış olmasıyla da geçti. Ali Sami Yen’de atmosfer hüzünlü ve gergindi. Rakip ise Nesta, Nedved ve Crespo gibi yıldızlarla dolu Lazio’ydu.\n\nÜmit Karan’ın Bitiriciliği ve Lucescu Taktiği\nGalatasaray maç boyunca Lucescu’nun sabır ve savunma planını kusursuz uyguladı. Lazio’nun yıldızlarına alan bırakılmadı. 79. dakikada Ümit Karan’ın golü, yalnızca skoru değil, maçın kaderini de belirledi.\n\nYıldızlar Topluluğuna Ders\nLazio bütçesi ve yıldız gücüne rağmen Galatasaray’ın takım organizasyonu karşısında etkisiz kaldı. Bu galibiyet, 2000 sonrası Avrupa devamlılığının önemli işaretlerinden biriydi.',86,0,NULL,'2026-04-13 11:46:59','2026-04-13 11:46:59',0),(28,'Liverpool 0 - 0 Galatasaray (20 Şubat 2002)','liverpool-0-0-galatasaray-20-subat-2002',0,NULL,'2002-02-20','Liverpool','UEFA Şampiyonlar Ligi',0,0,'draw','20 Şubat 2002 tarihinde Galatasaray, Anfield Road\'da Liverpool ile 0-0 berabere kaldı. Bu sonuç, taktik disiplinin ve savunma direncinin Avrupa\'daki en güçlü örneklerinden biri olarak kayda geçti.','2000’li yılların başında Galatasaray, Avrupa’da nereye giderse gitsin saygı gören bir rakip haline gelmişti. Liverpool deplasmanı ise her takım için ayrı bir sınavdı. Ancak Lucescu’nun ekibi sahaya adeta bir satranç ustası gibi çıktı.\n\nMondragon’un Devleştiği Gece\nLiverpool, Owen ve Heskey ile baskı kurmaya çalışsa da karşısında devleşen bir Mondragon buldu. Savunma hattı ve orta saha organizasyonu İngiliz ekibine geniş alan vermedi. Galatasaray da zaman zaman kontra ataklarla tehlike yarattı.\n\nAnfield’da Alkışlanan Takım\n0-0’lık skor, tabelada sade görünse de bu maç Galatasaray’ın Avrupa’daki saygınlığını güçlendiren önemli gecelerden biriydi. Taktik olgunluk ve savunma disiplini, alınan puanın gerçek anahtarı oldu.',85,0,NULL,'2026-04-13 11:47:06','2026-04-13 11:47:06',0),(29,'Galatasaray 1 - 1 Liverpool (26 Şubat 2002)','galatasaray-1-1-liverpool-26-subat-2002',0,NULL,'2002-02-26','Liverpool','UEFA Şampiyonlar Ligi',1,1,'draw','26 Şubat 2002 tarihinde Galatasaray, Ali Sami Yen\'de Liverpool ile 1-1 berabere kaldı. Bu maç, skor kadar maç sonundaki büyük gerilim ve saha içi arbede ile hafızalara kazındı.','Liverpool, Anfield’daki golsüz beraberliğin ardından İstanbul’a tedbirli geldi. Galatasaray ise yine yüksek baskı ve dirençle oynadı. Tribün atmosferi, maçın tansiyonunu baştan sona yukarıda tuttu.\n\nNiculae’nin Golü ve Heskey’nin Cevabı\n71. dakikada Radu Niculae’nin golüyle Galatasaray öne geçtiğinde Ali Sami Yen ayağa kalktı. Liverpool kısa süre sonra yanıt verdi ve skor 1-1’e geldi. Kalan bölümde iki taraf da üstünlük aradı, ancak tabelada değişiklik olmadı.\n\nSahada Gerilim\nBu maçı unutulmaz yapan yalnız skor değildi. Bitiş düdüğü sonrası yaşanan büyük arbede, karşılaşmayı kulüp hafızasında ayrı bir yere taşıdı. O gece, Galatasaray’ın rakibine yalnız futbol olarak değil, psikolojik olarak da boyun eğmediği bir mücadeleydi.',84,0,NULL,'2026-04-13 11:47:12','2026-04-13 11:47:12',0),(30,'Barcelona 2 - 2 Galatasaray (5 Aralık 2001)','barcelona-2-2-galatasaray-5-aralik-2001',0,NULL,'2001-12-05','Barcelona','UEFA Şampiyonlar Ligi',2,2,'draw','5 Aralık 2001 tarihinde Galatasaray, Nou Camp\'ta Barcelona ile 2-2 berabere kaldı. İlk yarıyı 2-0 önde kapatan sarı-kırmızılılar, Avrupa klasmanındaki ağırlığını bir kez daha tüm kıtaya hissettirdi.','Lucescu’nun taktik disipliniyle Galatasaray, Nou Camp’a korkmadan çıktı. Barcelona yıldızlarla dolu pahalı bir kadroya sahipti, ancak ilk düdükten itibaren sahada oyunun yönünü değiştirebilen bir Galatasaray vardı. İlk yarı sona erdiğinde tabela Barcelona 0 - 2 Galatasaray yazıyordu.\n\nÜmit Karan ve Fleurquin ile Tarih Yazımı\nÜmit Karan’ın erken golü ve Fleurquin’in ikinci vuruşu, Nou Camp’ı şaşkına çevirdi. İkinci yarıda Barcelona geri dönmeyi başarsa da Galatasaray oyundan hiç kopmadı ve galibiyeti kaçıran taraf hissi bıraktı.\n\nEfsanevi Direniş ve Kaçan Galibiyet\nBu maç, bir Türk takımının Barcelona deplasmanında sergilediği en etkileyici oyunlardan biri olarak hatırlanır. Sonuç beraberlik olsa da performans, Avrupa’daki saygınlığın zirve anlarından biriydi.',91,0,NULL,'2026-04-13 11:47:17','2026-04-13 11:47:17',0),(31,'Galatasaray 5 - 2 Juventus (17 Şubat 2026)','galatasaray-5-2-juventus-17-subat-2026',0,NULL,'2026-02-17','Juventus','UEFA Şampiyonlar Ligi',5,2,'win','17 Şubat 2026 tarihinde UEFA Şampiyonlar Ligi knockout phase play-off ilk maçında Galatasaray, Juventus\'u RAMS Park\'ta 5-2 mağlup ederek modern dönemin en çarpıcı Avrupa gecelerinden birine imza attı.','2026 yılının Şubat ayında İstanbul, bir kez daha bir İtalyan devinin diz çöküşüne tanıklık etti. Şampiyonlar Ligi knockout phase play-off turunda RAMS Park\'ta ağırlanan Juventus, Galatasaray\'ın yüksek temposu ve kararlı oyunu karşısında sarsıldı. İlk yarıda skor dalgalansa da ikinci yarıda üstünlük tamamen sarı-kırmızılı ekibin eline geçti.\n\nModern Çağın En Farklı Zaferi\nKarşılaşmada Galatasaray adına Gabriel Sara, Noa Lang, Davinson Sánchez ve Sacha Boey skora katkı verdi. Juventus, Koopmeiners ile karşılık verse de ikinci yarıda oyunun yönünü çeviremedi. Juan Cabal\'ın kırmızı kartı sonrası baskı daha da arttı ve skor 5-2\'ye geldi.\n\nAvrupa\'ya Mesaj\nBu sonuç, Galatasaray\'ın Avrupa sahnesinde yeniden güçlü bir ağırlık kurduğunu gösteren en dikkat çekici modern zaferlerden biri oldu. Juventus karşısında alınan 5-2\'lik galibiyet, kulübün Avrupa hafızasında özel bir yer edinmeye aday büyük gecelerden biri olarak kayda geçti.',97,1,NULL,'2026-04-13 11:53:47','2026-04-13 11:53:47',0),(32,'Galatasaray 1 - 0 Liverpool (10 Mart 2026)','galatasaray-1-0-liverpool-10-mart-2026',0,NULL,'2026-03-10','Liverpool','UEFA Şampiyonlar Ligi',1,0,'win','10 Mart 2026 tarihinde UEFA Şampiyonlar Ligi son 16 turu ilk maçında Galatasaray, Liverpool\'u İstanbul\'da 1-0 mağlup ederek rövanş öncesi değerli bir avantaj elde etti.','2026 baharında oynanan bu son 16 eşleşmesinde Galatasaray, Avrupa\'nın en güçlü ekiplerinden biri olan Liverpool\'u İstanbul\'da ağırladı. Maç boyunca savunma disiplini ve orta saha direnci ön plana çıktı. RAMS Park\'taki atmosfer, karşılaşmanın temposunu baştan sona yukarıda tuttu.\n\nStratejik Deha ve Tek Gol\nGalatasaray, Liverpool\'un baskılı oyununa karşı kontrollü ve sabırlı kaldı. Maçın tek golü Mario Lemina\'dan geldi ve bu gol karşılaşmanın kaderini belirledi. Kalan dakikalarda takım savunması avantajı korumayı başardı.\n\nKilit Zafer\nTabeladaki 1-0 yalnızca bir skor değil, Galatasaray\'ın Avrupa\'nın zirve ekipleriyle rekabet gücünün güncel bir kanıtı oldu. Liverpool karşısında alınan bu galibiyet, kulübün modern Avrupa hikâyesinde öne çıkan stratejik zaferlerden biri olarak kayda geçti.',94,1,NULL,'2026-04-13 11:53:54','2026-04-13 11:53:54',0);
/*!40000 ALTER TABLE `historical_matches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history_event_legend`
--

DROP TABLE IF EXISTS `history_event_legend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `history_event_legend` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `history_event_id` bigint unsigned NOT NULL,
  `legend_id` bigint unsigned NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `relation_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `history_event_legend_history_event_id_legend_id_unique` (`history_event_id`,`legend_id`),
  KEY `history_event_legend_legend_id_foreign` (`legend_id`),
  KEY `history_event_legend_is_primary_index` (`is_primary`),
  KEY `history_event_legend_relation_type_index` (`relation_type`),
  KEY `history_event_legend_sort_order_index` (`sort_order`),
  CONSTRAINT `history_event_legend_history_event_id_foreign` FOREIGN KEY (`history_event_id`) REFERENCES `history_events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `history_event_legend_legend_id_foreign` FOREIGN KEY (`legend_id`) REFERENCES `legends` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_event_legend`
--

LOCK TABLES `history_event_legend` WRITE;
/*!40000 ALTER TABLE `history_event_legend` DISABLE KEYS */;
/*!40000 ALTER TABLE `history_event_legend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history_event_season_archive`
--

DROP TABLE IF EXISTS `history_event_season_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `history_event_season_archive` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `season_archive_id` bigint unsigned NOT NULL,
  `history_event_id` bigint unsigned NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `relation_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `history_event_season_archive_unique` (`season_archive_id`,`history_event_id`),
  KEY `history_event_season_archive_history_event_id_foreign` (`history_event_id`),
  CONSTRAINT `history_event_season_archive_history_event_id_foreign` FOREIGN KEY (`history_event_id`) REFERENCES `history_events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `history_event_season_archive_season_archive_id_foreign` FOREIGN KEY (`season_archive_id`) REFERENCES `season_archives` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_event_season_archive`
--

LOCK TABLES `history_event_season_archive` WRITE;
/*!40000 ALTER TABLE `history_event_season_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `history_event_season_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history_event_trophy`
--

DROP TABLE IF EXISTS `history_event_trophy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `history_event_trophy` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `history_event_id` bigint unsigned NOT NULL,
  `trophy_id` bigint unsigned NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `relation_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `history_event_trophy_history_event_id_trophy_id_unique` (`history_event_id`,`trophy_id`),
  KEY `history_event_trophy_trophy_id_foreign` (`trophy_id`),
  KEY `history_event_trophy_sort_order_index` (`sort_order`),
  CONSTRAINT `history_event_trophy_history_event_id_foreign` FOREIGN KEY (`history_event_id`) REFERENCES `history_events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `history_event_trophy_trophy_id_foreign` FOREIGN KEY (`trophy_id`) REFERENCES `trophies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_event_trophy`
--

LOCK TABLES `history_event_trophy` WRITE;
/*!40000 ALTER TABLE `history_event_trophy` DISABLE KEYS */;
/*!40000 ALTER TABLE `history_event_trophy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history_events`
--

DROP TABLE IF EXISTS `history_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `history_events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `month` tinyint unsigned NOT NULL,
  `day` tinyint unsigned NOT NULL,
  `year` smallint unsigned DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `title` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'moment',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `source_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_on_this_day` tinyint(1) NOT NULL DEFAULT '1',
  `on_this_day_month` tinyint unsigned DEFAULT NULL,
  `on_this_day_day` tinyint unsigned DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `importance_score` int NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_canonical` tinyint(1) NOT NULL DEFAULT '1',
  `canonical_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `is_demo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `history_events_slug_unique` (`slug`),
  KEY `history_events_month_day_index` (`month`,`day`),
  KEY `history_events_year_index` (`year`),
  KEY `history_events_created_by_index` (`created_by`),
  KEY `history_events_event_date_index` (`event_date`),
  KEY `history_events_start_date_index` (`start_date`),
  KEY `history_events_end_date_index` (`end_date`),
  KEY `history_events_published_at_index` (`published_at`),
  KEY `history_events_type_index` (`type`),
  KEY `history_events_is_on_this_day_index` (`is_on_this_day`),
  KEY `history_events_on_this_day_month_index` (`on_this_day_month`),
  KEY `history_events_on_this_day_day_index` (`on_this_day_day`),
  KEY `history_events_is_published_index` (`is_published`),
  KEY `history_events_is_canonical_index` (`is_canonical`),
  KEY `history_events_canonical_key_index` (`canonical_key`),
  CONSTRAINT `history_events_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_events`
--

LOCK TABLES `history_events` WRITE;
/*!40000 ALTER TABLE `history_events` DISABLE KEYS */;
INSERT INTO `history_events` VALUES (1,10,1,1905,'1905-10-01',NULL,NULL,'Kuruluş: Bir Vizyonun Doğuşu (1905)','kurulus-bir-vizyonun-dogusu-1905','moment','Ali Sami Yen ve arkadaşlarının Galatasaray Lisesi\'nde kurduğu kulübün doğuşu.','Galatasaray\'ın temellerinin atıldığı tarihi başlangıç.','Önemi: Bu olay sadece bir kulübün kuruluşu değil, Türk spor tarihinin en önemli yapı taşlarından birinin doğuşudur.',NULL,0,NULL,NULL,1,'2026-04-13 13:49:48',92,1,1,'metin-oktay-net-breaker-1959','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(2,1,1,1909,'1909-01-01',NULL,NULL,'İlk Şampiyonluk: İstanbul Ligi Zaferi (1909)','ilk-sampiyonluk-istanbul-ligi-1909','moment','Galatasaray\'ın ilk resmi lig şampiyonluğu.','Kulüp tarihinin ilk kupası.','Önemi: Galatasaray\'ın rekabetçi kimliğinin başlangıcıdır.',NULL,0,NULL,NULL,1,'2026-04-13 13:49:48',90,1,1,'prekazi-free-kick-1989','2026-03-23 19:56:54','2026-03-30 17:50:50',1,0),(3,12,1,1922,'1922-12-01',NULL,NULL,'Atatürk ve Galatasaray (1922)','ataturk-ve-galatasaray-1922','moment','Mustafa Kemal Atatürk\'ün Galatasaray Lisesi ziyareti.','Cumhuriyetin kurucusunun kulüple bağı.','Önemi: Kulübün milli kimlik ile olan bağını güçlendiren simgesel bir olaydır.',NULL,0,NULL,NULL,1,'2026-04-13 13:49:48',98,1,1,'taffarel-save-henry-2000','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(4,1,1,1923,'1923-01-01',NULL,NULL,'Gazi Büstü Kupası (1923)','gazi-bustu-kupasi-1923','moment','Atatürk adına düzenlenen kupanın kazanılması.','Cumhuriyetin ilk yıllarında önemli bir zafer.','Önemi: Yeni kurulan Cumhuriyet ile sporun birleştiği sembolik bir başarıdır.',NULL,0,NULL,NULL,1,'2026-04-13 13:49:48',100,1,1,'popescu-penalty-2000','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(5,1,1,1951,'1951-01-01',NULL,NULL,'Berlin Panteri Turgay Şeren (1951)','berlin-panteri-turgay-seren-1951','moment','Turgay Şeren\'in Berlin\'de gösterdiği tarihi performans.','Efsane kalecinin doğuşu.','Önemi: Galatasaray\'ın uluslararası sahnede tanınmasını sağlayan ilk büyük bireysel performanslardan biridir.',NULL,0,NULL,NULL,1,'2026-04-13 13:49:48',99,1,1,'jardel-golden-goal-2000','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(6,6,10,1959,'1959-06-10',NULL,NULL,'Ağları Yırtan Gol: Metin Oktay (1959)','aglari-yirtan-gol-metin-oktay-1959','moment','Metin Oktay\'ın ezeli rekabet tarihine geçen ve ağları delen şutu.','Taçsız Kral\'ın Galatasaray hafızasına kazınan en ikonik anlarından biri.','Önemi: Bu an sadece bir gol değil, Metin Oktay efsanesinin ve Galatasaray\'ın ezeli rekabetteki simgesel üstünlüğünün en güçlü görsellerinden biridir.',NULL,1,6,10,1,'2026-04-13 13:49:48',96,1,1,'kadikoy-title-2012','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(7,6,1,1963,'1963-06-01',NULL,NULL,'105 Gollü Rekor: Gündüz Kılıç Dönemi (1963)','105-gollu-rekor-gunduz-kilic-1963','moment','Galatasaray\'ın 1962-63 sezonunda lig tarihine geçen 105 gollü hücum performansı.','Baba Gündüz yönetiminde kırılan tarihi hücum rekoru.','Önemi: Bu sezon, Galatasaray\'ın sadece kazanan değil, oyuna hükmeden ve hücum gücüyle rakiplerini ezen takım kimliğinin tarihsel zirvelerinden biridir.',NULL,0,NULL,NULL,1,'2026-04-13 13:49:48',87,0,1,'drogba-backheel-2013','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(8,5,27,1973,'1973-05-27',NULL,NULL,'İlk Hanedanlık: Brian Birch ile Üçte Üç (1973)','ilk-hanedanlik-brian-birch-ucte-uc-1973','moment','Brian Birch yönetiminde üst üste üçüncü lig şampiyonluğuna ulaşılması.','Galatasaray\'ın lig tarihinde ilk büyük seri şampiyonluk dönemi.','Önemi: Bu başarı, Galatasaray\'ın seri şampiyonluk kültürünün başlangıcı ve modern disiplin anlayışının ilk büyük meyvesidir.',NULL,1,5,27,1,'2026-04-13 13:49:48',88,0,1,'sneijder-juventus-snow-2013','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(9,7,1,1984,'1984-07-01',NULL,NULL,'Jupp Derwall Devrimi (1984)','jupp-derwall-devrimi-1984','moment','Jupp Derwall\'in Galatasaray\'ın başına geçerek yapısal dönüşüm sürecini başlatması.','Florya, profesyonellik ve Avrupa vizyonunun başlangıcı.','Önemi: Derwall dönemi, Galatasaray\'ın 1990\'lar ve 2000\'lerdeki büyük başarılarının altyapısını kuran tarihsel kırılma noktasıdır.',NULL,0,NULL,NULL,1,'2026-04-13 13:49:48',89,1,1,'fourth-star-2015','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(10,6,7,1987,'1987-06-07',NULL,NULL,'14 Yıllık Hasretin Sonu (1987)','14-yillik-hasretin-sonu-1987','moment','Eskişehirspor galibiyetiyle gelen ve 14 yıllık lig özlemini bitiren şampiyonluk.','Galatasaray\'ın modern çağdaki yeniden doğuş anı.','Önemi: Bu şampiyonluk, Derwall ile atılan yapısal adımların sahadaki ilk büyük sonucu ve Avrupa\'ya uzanacak yeni dönemin başlangıcıdır.',NULL,1,6,7,1,'2026-04-13 13:49:48',90,1,1,'icardi-old-trafford-2023','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(11,11,9,1988,'1988-11-09',NULL,NULL,'İmkansızın İmzası: Neuchâtel Xamax 5-0 (1988)','imkansizin-imzasi-neuchatel-xamax-5-0-1988','moment','İsviçre\'deki 3-0\'lık yenilginin ardından Ali Sami Yen\'de gelen tarihi 5-0\'lık geri dönüş.','Galatasaray\'ın Avrupa\'da imkansızı başardığını kanıtladığı gece.','Önemi: Bu maç, kulübün Avrupa özgüveninin doğduğu ve “imkansız” kelimesinin Galatasaray hafızasında anlamını yitirdiği en büyük kırılma noktalarından biridir.',NULL,1,11,9,1,'2026-04-13 13:49:48',100,1,1,'uefa-cup-title-2000','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(14,4,5,1989,'1989-04-05',NULL,NULL,'Avrupa’nın En İyi 4 Takımı Arasında (1989)','avrupanin-en-iyi-4-takimi-arasinda-1989','moment','Galatasaray\'ın Şampiyon Kulüpler Kupası\'nda yarı finale yükselerek Avrupa\'nın en iyi dört takımı arasına girmesi.','Türk futbolunun kıta çapındaki ilk büyük kulüp yürüyüşü.','Önemi: Bu başarı, Galatasaray\'ın Avrupa\'da tesadüfi değil kalıcı bir güç olabileceğini gösteren ilk büyük uluslararası tescildir.',NULL,1,4,5,1,'2026-04-13 13:49:48',100,1,1,'europe-semi-1989','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(16,5,17,2000,'2000-05-17',NULL,NULL,'Kopenhag Destanı: UEFA Kupası Zaferi (2000)','kopenhag-destani-uefa-kupasi-zaferi-2000','moment','Galatasaray\'ın Arsenal\'i yenerek UEFA Kupası\'nı kazandığı tarihi final.','Türk futbol tarihinin kulüpler düzeyindeki en büyük zaferi.','Önemi: Bu zafer, Galatasaray\'ı ve Türk futbolunu Avrupa\'nın zirvesine taşıyan en büyük sportif başarıdır.',NULL,1,5,17,1,'2026-04-13 13:49:48',88,1,1,'wheelchair-basketball-dominance','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(17,8,25,2000,'2000-08-25',NULL,NULL,'Dünyanın En Büyüğü: Süper Kupa Zaferi (2000)','dunyanin-en-buyugu-super-kupa-zaferi-2000','moment','Galatasaray\'ın Real Madrid\'i mağlup ederek UEFA Süper Kupa\'yı kazanması.','Avrupa zaferinin dünya sahnesindeki en güçlü teyidi.','Önemi: Bu kupa, Galatasaray\'ın yalnızca Avrupa\'da değil, dünya futbolunda da en üst seviyeye çıktığının simgesidir.',NULL,1,8,25,1,'2026-04-13 13:49:48',89,1,1,'euroleague-women-2014','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(18,1,1,2001,'2001-01-01',NULL,NULL,'IFFHS Dünya Kulüpler Sıralaması 1.liği (2001)','iffhs-dunya-kulupler-siralamasi-1-ligi-2001','moment','Galatasaray\'ın IFFHS tarafından dünyanın en iyi kulübü olarak zirveye yerleştirilmesi.','Avrupa zaferlerinin istatistiksel ve küresel teyidi.','Önemi: Bu derece, Galatasaray\'ın 2000 yılındaki başarılarının tesadüf olmadığını ve dünya futbolunda zirveye çıktığını matematiksel olarak da kanıtladı.',NULL,0,NULL,NULL,1,'2026-04-13 13:49:48',85,0,1,'four-in-a-row-1996-2000','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(19,1,1,2024,'2024-01-01',NULL,NULL,'Engelsiz Aslanlar: Dünya Dominasyonu','engelsiz-aslanlar-dunya-dominasyonu','moment','Galatasaray Tekerlekli Sandalye Basketbol Takımı\'nın dünya çapındaki üstün başarıları.','Kulübün sadece futbolda değil, farklı branşlarda da zirveye çıkan karakteri.','Önemi: Engelsiz Aslanlar, Galatasaray\'ın mücadele ruhunun ve çok branşlı büyük kulüp kimliğinin en güçlü çağdaş temsilcilerinden biridir.',NULL,0,NULL,NULL,1,'2026-04-13 13:49:48',81,0,1,'ucl-quarterfinal-tradition','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(20,5,12,2012,'2012-05-12',NULL,NULL,'Kadıköy’de Karanlıkta Gelen Kupa (2012)','kadikoyde-karanlikta-gelen-kupa-2012','moment','Süper Final sonunda Kadıköy\'de gelen şampiyonluk ve karanlıkta kaldırılan kupa.','Yakın dönem Galatasaray tarihinin en simgesel şampiyonluk anlarından biri.','Önemi: Bu olay, Galatasaray\'ın baskı altında bile sahada ve psikolojik savaşta üstün gelebilen karakterinin modern dönem sembollerinden biridir.',NULL,1,5,12,1,'2026-04-13 13:49:48',82,0,1,'cup-lord-18','2026-03-23 19:56:54','2026-03-23 19:56:54',1,0),(21,12,11,2013,'2013-12-11',NULL,NULL,'İstanbul\'un Beyaz Destanı: Kar Altında Juventus Zaferi (2013)','istanbulun-beyaz-destani-kar-altinda-juventus-zaferi-2013','moment','Yoğun kar altında ertelenip devam eden maçta Galatasaray\'ın Juventus\'u yenerek tur atlaması.','Şampiyonlar Ligi tarihimizin en atmosferik ve en simgesel galibiyetlerinden biri.','Önemi: Bu zafer, Galatasaray\'ın Avrupa gecelerinde saha şartları ne olursa olsun oyunun psikolojisini ve ritmini yönetebilen büyük kulüp refleksini gösterdi.',NULL,1,12,11,1,'2026-04-13 13:49:48',94,1,1,'juventus-snow-victory-2013','2026-04-13 12:16:34','2026-04-13 12:16:34',1,0),(22,1,1,2014,'2014-01-01',NULL,NULL,'Sarayın Sultanları Avrupa\'nın Zirvesinde (2014)','sarayin-sultanlari-avrupanin-zirvesinde-2014','moment','Galatasaray Kadın Basketbol Takımı\'nın EuroLeague Women şampiyonluğuna ulaşması.','Kulübün kadın basketboldaki en büyük Avrupa zaferi.','Önemi: Bu başarı, Galatasaray\'ın büyüklüğünün yalnızca futbolla sınırlı olmadığını ve Avrupa\'da çok branşlı bir güç olduğunu açık biçimde gösterdi.',NULL,0,NULL,NULL,1,'2026-04-13 13:49:48',95,1,1,'womens-euroleague-title-2014','2026-04-13 12:16:34','2026-04-13 12:16:34',1,0),(23,5,25,2015,'2015-05-25',NULL,NULL,'Zirvenin Tek Hakimi: Dördüncü Yıldız ve 20. Şampiyonluk (2015)','dorduncu-yildiz-ve-20-sampiyonluk-2015','moment','Galatasaray\'ın 20. lig şampiyonluğuna ulaşarak formasına 4. yıldızı takması.','Türk futbolunda yıldız yarışında tarihi üstünlüğün ilanı.','Önemi: 4. yıldız, yalnızca bir sembol değil; Galatasaray\'ın Türkiye\'deki tarihsel şampiyonluk standardını belirleyen kulüp olduğunun açık teyididir.',NULL,1,5,25,1,'2026-04-13 13:49:48',98,1,1,'fourth-star-20th-title-2015','2026-04-13 12:16:34','2026-04-13 12:16:34',1,0),(25,1,1,2026,'2026-01-01',NULL,NULL,'Zirvenin Tek Sahibi: Türkiye\'nin Tartışmasız Kupa Beyi','turkiyenin-tartismasiz-kupa-beyi','moment','Galatasaray\'ın yerel kupalar ve toplam resmi başarılar bakımından Türkiye\'nin en güçlü kulübü konumunu sürdürmesi.','Kulüp tarihinin toplam başarı bilançosunu özetleyen üst kimlik kaydı.','Önemi: Bu kayıt tek bir maçı değil, Galatasaray\'ın bir asrı aşan kupacılık geleneğini ve Türkiye futbolundaki kurumsal üstünlüğünü temsil eder.',NULL,0,NULL,NULL,1,'2026-04-13 13:49:48',90,0,1,'turkeys-undisputed-cup-king','2026-04-13 12:16:34','2026-04-13 12:16:34',1,0),(26,11,3,1993,'1993-11-03',NULL,NULL,'Welcome to Hell: Manchester United Gecesi (1993)','welcome-to-hell-manchester-united-1993','moment','Galatasaray’ın Manchester United’ı eleyerek Avrupa sahnesinde büyük çıkış yaptığı gece.','Avrupa kimliğinin doğuş anlarından biri.','Onemi: Bu mac, Galatasarayin Avrupa sahnesinde kalici bir guc oldugunu gosteren en kritik esiklerden biridir.',NULL,1,11,3,1,'2026-04-13 13:49:48',100,1,1,NULL,'2026-04-13 12:42:57','2026-04-13 12:42:57',1,0),(27,4,24,1996,'1996-04-24',NULL,NULL,'Kadıköy’de Bayrak: Graeme Souness (1996)','kadikoyde-bayrak-graeme-souness-1996','moment','Türkiye Kupası sonrası Souness’in rakip sahaya bayrak dikmesi.','Rekabet tarihinin en ikonik anlarindan biri.','Onemi: Bu olay Galatasarayin psikolojik ustunlugunun sembollerinden biri haline gelmistir.',NULL,1,4,24,1,'2026-04-13 13:49:48',100,1,1,NULL,'2026-04-13 12:42:57','2026-04-13 12:42:57',1,0),(28,5,21,2000,'2000-05-21',NULL,NULL,'Dörtte Dört: Üst Üste 4 Şampiyonluk (2000)','dortte-dort-ust-uste-4-sampiyonluk-2000','moment','Galatasaray’ın 4 yıl üst üste lig şampiyonu olması.','Turk futbolunda dominasyon donemi.','Onemi: Bu seri, kulubun kazanan kimligini zirveye tasimistir.',NULL,1,5,21,1,'2026-04-13 13:49:48',100,1,1,NULL,'2026-04-13 12:42:57','2026-04-13 12:42:57',1,0),(29,1,15,2011,'2011-01-15',NULL,NULL,'Ali Sami Yen Stadi\'na Veda (2011)','ali-sami-yen-stadina-veda-2011','moment','Efsane stadin son maciyla tarihe karismasi.','Bir donemin kapanisi.','Onemi: Galatasaray tarihinin en duygusal ve sembolik gecelerinden biridir.',NULL,0,NULL,NULL,1,'2026-04-13 13:49:48',95,1,1,NULL,'2026-04-13 12:42:57','2026-04-13 12:42:57',1,0);
/*!40000 ALTER TABLE `history_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homepage_hero_overrides`
--

DROP TABLE IF EXISTS `homepage_hero_overrides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `homepage_hero_overrides` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` bigint unsigned NOT NULL,
  `content_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `starts_at` datetime DEFAULT NULL,
  `ends_at` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned NOT NULL,
  `notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_hho_active_window` (`is_active`,`starts_at`,`ends_at`),
  KEY `idx_hho_item` (`item_type`,`item_id`),
  KEY `idx_hho_content_key` (`content_key`),
  KEY `idx_hho_created_by` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homepage_hero_overrides`
--

LOCK TABLES `homepage_hero_overrides` WRITE;
/*!40000 ALTER TABLE `homepage_hero_overrides` DISABLE KEYS */;
INSERT INTO `homepage_hero_overrides` VALUES (4,'news',26,'news:26',NULL,'2026-12-31 23:59:00',0,1,NULL,'2026-03-25 16:57:35','2026-03-30 13:26:45'),(5,'news',25,'news:17',NULL,'2026-03-31 17:26:23',1,1,NULL,'2026-03-30 13:26:48','2026-03-30 16:34:00');
/*!40000 ALTER TABLE `homepage_hero_overrides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legend_trophy`
--

DROP TABLE IF EXISTS `legend_trophy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `legend_trophy` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `legend_id` bigint unsigned NOT NULL,
  `trophy_id` bigint unsigned NOT NULL,
  `year` smallint NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `legend_trophy_legend_id_trophy_id_year_unique` (`legend_id`,`trophy_id`,`year`),
  KEY `legend_trophy_trophy_id_foreign` (`trophy_id`),
  KEY `legend_trophy_year_index` (`year`),
  CONSTRAINT `legend_trophy_legend_id_foreign` FOREIGN KEY (`legend_id`) REFERENCES `legends` (`id`) ON DELETE CASCADE,
  CONSTRAINT `legend_trophy_trophy_id_foreign` FOREIGN KEY (`trophy_id`) REFERENCES `trophies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legend_trophy`
--

LOCK TABLES `legend_trophy` WRITE;
/*!40000 ALTER TABLE `legend_trophy` DISABLE KEYS */;
/*!40000 ALTER TABLE `legend_trophy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legends`
--

DROP TABLE IF EXISTS `legends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `legends` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_by` bigint unsigned DEFAULT NULL,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `era_start_year` smallint unsigned DEFAULT NULL,
  `era_end_year` smallint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_demo` tinyint(1) DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` datetime DEFAULT NULL,
  `importance_score` int unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `legends_slug_unique` (`slug`),
  KEY `legends_era_start_year_index` (`era_start_year`),
  KEY `legends_created_by_foreign` (`created_by`),
  KEY `legends_is_published_index` (`is_published`),
  KEY `legends_importance_score_index` (`importance_score`),
  KEY `legends_is_featured_index` (`is_featured`),
  CONSTRAINT `legends_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legends`
--

LOCK TABLES `legends` WRITE;
/*!40000 ALTER TABLE `legends` DISABLE KEYS */;
INSERT INTO `legends` VALUES (1,1,'Ali Sami Yen','ali-sami-yen','1 Numaralı Üye ve Vizyoner Kurucu','1905 yılında Galatasaray Spor Kulübünün temellerini atan, Türk sporunun en büyük öncülerinden biridir.','<p>Ali Sami Yen, Galatasarayın kurucu iradesini ve Türk sporunun modernleşme vizyonunu temsil eder. 1905 yılında kulübü kurarken ortaya koyduğu hedef, yalnızca bir futbol takımı kurmak değil; bir kültür, terbiye ve rekabet ruhu inşa etmekti.</p><p>Milli takım, olimpik hareket ve spor teşkilatı alanındaki katkılarıyla Galatasaray tarihinin ötesine taşan kurucu bir figürdür. Bugün kulübün taşıdığı Avrupa iddiasının ilk cümlesi onun vizyonunda yazılmıştır.</p>',1886,1951,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(2,1,'Gündüz Kılıç','gunduz-kilic','Galatasarayın Pusulası ve Modern Mimarı','Hem futbolcu hem teknik direktör olarak kulübün karakterini ve oyun aklını şekillendiren Baba Gündüz, Galatasaray ruhunun ana taşıyıcılarından biridir.','<p>Gündüz Kılıç, Galatasarayı yalnızca maç kazanan bir takım değil, bir yaşam biçimi olarak gören çizginin en güçlü temsilcilerindendir. Futbolcu, kaptan ve hoca kimliklerini aynı vakar içinde taşıdı.</p><p>Metin Oktayın keşfi, modern oyun anlayışı ve Galatasaraylılık ruhuna dair düşünsel etkisiyle kulübün pusulası olmuştur. Camia içinde Baba unvanı boşuna doğmamıştır.</p>',1934,1967,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(3,1,'Coşkun Özarı','coskun-ozari','Galatasarayın Bilge Savunucusu ve Teknik Stratejisti','Hem futbolcu hem teknik direktör olarak kulübe uzun yıllar hizmet eden, Galatasaraylılık ruhunu saha içine taşıyan büyük stratejisttir.','<p>Coşkun Özarı, Galatasarayın hem savunmadaki güven hem teknik akıldaki süreklilik figürlerinden biridir. Mektepli duruşu ve futbol bilgisiyle kuşaklar boyunca saygı görmüştür.</p><p>Şampiyonluk dönemlerinde taktiksel omurgayı kurmuş, kulübün etik değerlerini başarıyla birleştiren bir okul yaratmıştır. Hocaların hocası tanımı onun için tesadüfi değildir.</p>',1953,1986,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(4,1,'Turgay Şeren','turgay-seren','Kaledeki Dev ve Sadakat Sembolü','Berlin Panteri lakabıyla anılan Turgay Şeren, Galatasaray kalesinde uzun yıllar boyunca güvenin ve sadakatin simgesi olmuştur.','<p>Turgay Şeren, Galatasaray tarihindeki tek kulüp adamı kimliğinin en parlak örneklerinden biridir. Berlin Panteri unvanı, onun uluslararası sahnede kazandığı saygının sembolüdür.</p><p>Derbi rekorları, kaptanlığı ve sarsılmaz karakteriyle yalnızca bir kaleci değil, kulübün hafızasında yer etmiş bir duruş figürüdür.</p>',1947,1967,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(5,1,'Metin Oktay','metin-oktay','Zarafetin, Sadakatin ve Golün Efendisi','Taçsız Kral Metin Oktay, Galatasaray tarihinin en büyük golcü sembollerinden biri ve kulüp aidiyetinin en güçlü temsilcisidir.','<p>Metin Oktay, attığı goller kadar karakteriyle de efsanedir. Ağları delen şutu, derbilerdeki ağırlığı ve formaya bağlılığı onu yalnızca büyük bir futbolcu değil, kültürel bir figür haline getirmiştir.</p><p>Parayı değil armayı seçen tavrı, centilmenliği ve Galatasaraylılık duruşu nedeniyle bugün hâlâ kulübün en güçlü simgelerinden biri olarak anılır.</p>',1955,1969,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(6,1,'Brian Birch','brian-birch','İngiliz Disiplini ve Üçleme Mimarı','Galatasarayın ilk büyük seri şampiyonluk dönemini inşa eden, kondisyon ve disiplin devrimini getiren teknik adamdır.','<p>Brian Birch, 1970li yılların başında Galatasaraya modern profesyonellik, fiziksel güç ve seri şampiyonluk kültürü kazandırdı. Üst üste üç lig şampiyonluğu kulüp tarihinde yeni bir standardın başlangıcı oldu.</p><p>Onun dönemi, Galatasarayın sadece yetenekle değil, sistem ve disiplinle de büyük olabileceğini gösteren temel kırılma noktalarından biridir.</p>',1970,1981,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(7,1,'Jupp Derwall','jupp-derwall','Modern Galatasarayın Mimarı ve Alman Ekolünün Öncüsü','Derwall, Galatasaraya tesisleşme, profesyonellik ve modern futbol aklını taşıyarak 90lı yılların temelini atan büyük devrimcidir.','<p>Jupp Derwallin gelişi, yalnızca teknik direktör değişimi değil, kurumsal bir dönüşüm anlamına gelmiştir. Florya, altyapı vizyonu ve disiplin onun bıraktığı yapısal mirasın ana başlıklarıdır.</p><p>14 yıllık hasreti bitiren şampiyonluk kadar, gelecekte gelecek Avrupa başarılarının temel taşlarını döşemesiyle de efsaneleşmiştir.</p>',1984,1990,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(8,1,'Cüneyt Tanman','cuneyt-tanman','İstikrarın, Sadakatin ve Centilmenliğin Simgesi','Galatasaray altyapısından çıkıp uzun yıllar kaptanlık yapan Cüneyt Tanman, tek kulüp adamı çizgisinin örnek ismidir.','<p>Cüneyt Tanman, kulübün zorlu dönemlerinde taşıdığı liderlik ve sakin otorite ile Galatasarayın omurgasını temsil etmiştir. 1987 şampiyonluğunun kaptanı olarak modern dönemin eşik figürlerinden biridir.</p><p>Çok yönlü oyunu, centilmenliği ve kulübe sadakati onu yalnızca bir futbolcu değil, bir karakter ölçüsü haline getirmiştir.</p>',1974,1991,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(9,1,'Zoran Simovic','zoran-simovic','80lerin Dev Kalecisi ve Oyun Kurucu Eldiven','Šimović, 80’li yılların sonundaki yükselişte kalede mutlak güven yaratan ve Avrupa yürüyüşünün ana kahramanlarından biri olan efsane isimdir.','<p>Zoran Simovic, klasik kaleci kalıplarını aşan tarzı, liderliği ve kritik kurtarışlarıyla Galatasarayın Avrupa özgüvenini büyüten isimlerden biri oldu.</p><p>1989 yürüyüşünde ve 1987 şampiyonluğunda bıraktığı iz, onu Galatasaray kaleci geleneğinin en önemli halkalarından biri yapmıştır.</p>',1984,1990,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(10,1,'Cevad Prekazi','cevad-prekazi','Sol Ayağın Büyücüsü ve Estetik Ustası','Monaco golü ile ölümsüzleşen Cevad Prekazi, Galatasaray’ın Avrupa atılımındaki en estetik ve en akıl dolu figürlerinden biridir.','<p>Cevad Prekazi, duran toplardaki ustalığı, oyun zekası ve sahadaki asaletiyle Galatasaray tarihinin en özel yabancı oyuncularından biri oldu.</p><p>1989 sezonunda Avrupa yolculuğuna damga vuran meşhur frikik golü, kulübün kıta çapındaki kimlik dönüşümünün en sembolik anlarından biridir.</p>',1985,1991,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(11,1,'Fatih Terim','fatih-terim','Kazanma Geninin Sahibi ve Ebedi İmparator','Hem büyük kaptan hem de tarihi baştan yazan teknik adam olarak Fatih Terim, Galatasarayın modern çağdaki en baskın figürüdür.','<p>Fatih Terim, futbolculuk dönemindeki liderliğini teknik direktörlükte küresel ölçekte başarıya çevirdi. 2000 UEFA Kupası zaferi ve sayısız lig şampiyonluğu onun mirasının merkezindedir.</p><p>Galatasarayın yüksek özgüven, tam saha baskı ve asla teslim olmama karakteri büyük ölçüde onun çağında kurumsallaşmıştır.</p>',1974,2022,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(12,1,'Gheorghe Hagi','gheorghe-hagi','Tarihin En İyi Yabancısı ve Comandante','Hagi, sihirli sol ayağı ve saha içi liderliğiyle Galatasaray’ı Avrupa zirvesine taşıyan en büyük yabancı efsanedir.','<p>Gheorghe Hagi, Galatasaray taraftarı için yalnızca yıldız bir oyuncu değil, bir futbol duygusudur. İmkansız goller, Avrupa geceleri ve 10 numara mirası onun adıyla anılır.</p><p>UEFA Kupası, Süper Kupa ve dört şampiyonluk döneminde saha içindeki komutan olarak kulübün altın çağının ana yüzlerinden biri olmuştur.</p>',1996,2001,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(13,1,'Claudio Taffarel','claudio-taffarel','Dünya Şampiyonu Eldiven ve Kopenhag Kahramanı','Taffarel, 2000 finalindeki kritik kurtarışları ve pozitif liderliğiyle Galatasaray tarihinin en özel kalecilerinden biridir.','<p>Claudio Taffarel, Galatasaray kalesine yalnızca kalite değil, mutlak güven de getirdi. Kopenhag finalinde yaptığı kurtarışlarla Türk spor tarihinin en büyük gecelerinden birinin baş kahramanlarından biri oldu.</p><p>Saha içindeki sakinliği ve saha dışındaki karakteriyle kulübün sevilen aile figürlerinden biri haline geldi.</p>',1998,2001,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(14,1,'Bülent Korkmaz','bulent-korkmaz','Cesaretin, Sadakatin ve Direnişin Simgesi','Büyük Kaptan Bülent Korkmaz, tek kulüp adamı sadakati ve UEFA finalindeki sargılı kol hikayesiyle Galatasaray ruhunun kristal halidir.','<p>Bülent Korkmaz, Floryadan çıkıp kariyeri boyunca yalnızca Galatasaray için savaşan büyük kaptandır. Onun adı fedakarlık, direnç ve kulübe mutlak sadakat ile birlikte anılır.</p><p>UEFA Kupası finalinde omzu çıkmış halde sahada kalması, Galatasaray tarihinin en güçlü karakter sahnelerinden biridir.</p>',1979,2005,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(15,1,'Hakan Şükür','hakan-sukur','Türk Futbolunun ve Galatasarayın En Büyük Golcülerinden Biri','Kral lakabıyla anılan Hakan Şükür, Galatasarayın hücum hattındaki büyük bitirici gücü ve altın çağın ana gol figürüdür.','<p>Hakan Şükür, hava toplarındaki üstünlüğü, büyük maçlardaki golleri ve uzun yıllara yayılan istikrarıyla Galatasaray tarihinin en ağır hücum miraslarından birini bıraktı.</p><p>2000 ruhunda ve dört şampiyonluk döneminde takımın skor üretim merkezi olarak çok belirleyici bir rol oynadı.</p>',1992,2008,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(16,1,'Mircea Lucescu','mircea-lucescu','Taktik Deha ve Süper Kupa Şampiyonu','Lucescu, geçiş dönemindeki Galatasaray’ı Avrupa zirvesinde tutmayı başaran ve Real Madrid karşısında Süper Kupa getiren strateji ustasıdır.','<p>Mircea Lucescu, çok zor bir dönemde takımı yeniden organize ederek Galatasarayın Avrupa saygınlığını sürdürmesini sağladı. Taktik zekası ve oyunu okuma becerisi onun temel imzasıdır.</p><p>2000 Süper Kupa zaferi ve Şampiyonlar Ligi seviyesindeki rekabet gücü, onu kulüp tarihinde özel bir teknik adam konumuna taşımıştır.</p>',2000,2002,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(17,1,'Ümit Davala','umit-davala','Büyük Maçların Soğukkanlı Kahramanı','Çok yönlü oyunu ve kritik an performansıyla Ümit Davala, 2000 kuşağının en güvenilir parçalarından biridir.','<p>Ümit Davala, sağ bekten hücum hattına kadar birçok bölgede görev yapabilen, büyük maçlarda sorumluluk alan özel bir oyuncuydu. Milan karşısındaki 90+3 penaltısı kulüp tarihinin dönüm anlarından biridir.</p><p>UEFA ve Süper Kupa yolculuğundaki kritik katkıları onu Galatasarayın altın jenerasyonunda özel bir yere taşımıştır.</p>',1996,2003,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(18,1,'Fernando Muslera','fernando-muslera','Kalenin Sarsılmaz Kilidi ve Yaşayan Efsane','Muslera, modern dönemde kupa, sadakat ve kaptanlık kimliğini bir araya getiren en büyük Galatasaray figürlerinden biridir.','<p>Fernando Muslera, Galatasarayın yakın dönem tarihindeki en güvenilir ve en sevilen liderlerden biridir. Kurtarışları kadar karakteri, aile duygusu ve camiayı sahiplenişi ile öne çıktı.</p><p>Uzun yıllara yayılan başarılarıyla kulüp tarihinin en güçlü yabancı miraslarından birini oluşturdu.</p>',2011,2025,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(19,1,'Hasan Şaş','hasan-sas','Kanatlardaki İhtilal ve Dünya Kupası Yıldızı','Hasan Şaş, 2000 sonrası Avrupa yürüyüşünde ve 2002 dünya sahnesinde Galatasaray karakterini hız, hırs ve teknikle temsil eden yıldızdır.','<p>Hasan Şaş, büyük maçlarda rakipleri yıpratan, adam eksilten ve oyunun ritmini bozan enerjik yapısıyla 2000 kuşağının vazgeçilmez parçalarından biri oldu.</p><p>Real Madrid gibi devlere karşı sahne alışı ve 2002 Dünya Kupasındaki performansı onun etkisini kulüp sınırlarının dışına taşımıştır.</p>',1998,2009,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(20,1,'Tugay Kerimoğlu','tugay-kerimoglu','Orta Sahadaki Zarafet ve Avrupa Vizyonu','Tugay, oyun zekası, uzun pas kalitesi ve altyapı kökenli liderliğiyle 90lı yılların teknik beynidir.','<p>Tugay Kerimoğlu, Galatasaray altyapısının dünya futboluna sunduğu en rafine orta saha oyuncularından biridir. Oyunu iki yönlü okuması ve estetik paslarıyla dönemin teknik omurgasını oluşturdu.</p><p>Sonrasında Avrupa kariyerinde gösterdiği kalite, Galatasaray ekolünün dış dünyadaki saygınlığını da yükseltti.</p>',1987,2000,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(21,1,'Okan Buruk','okan-buruk','Altyapıdan Zirveye Uzanan Şampiyon Lider','Okan Buruk, hem futbolcu hem teknik direktör olarak Galatasaray tarihine başarıyı alışkanlık haline getiren figürlerden biri olarak geçti.','<p>Okan Buruk, saha içindeki dinamizmi ve kupalarla dolu futbolculuk kariyerinin ardından teknik adam olarak da Galatasarayı zirveye taşımayı başardı.</p><p>UEFA kuşağının atom karıncası olarak başlayan hikayesi, modern dönemde şampiyon teknik direktör kimliğiyle ikinci bir efsane halkasına dönüştü.</p>',1991,NULL,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0),(22,1,'Ergin Ataman','ergin-ataman','Basketbolun İmparatoru ve Avrupa Kupası Mimarı','Ergin Ataman, Galatasaray erkek basketbolunu yeniden zirveye taşıyan ve EuroCup zaferini getiren büyük liderdir.','<p>Ergin Ataman, Galatasaray basketbol tarihinde öncesi ve sonrası olan bir kırılma yaratmıştır. 23 yıllık hasreti bitiren şampiyonluk ve Avrupa kupası onun döneminin en güçlü başlıklarıdır.</p><p>Kazanma kültürünü parkeye taşıyarak Galatasaray vizyonunun yalnızca futbolda değil, basketbolda da Avrupa ölçeğinde büyük olabileceğini göstermiştir.</p>',2012,2017,'2026-04-13 13:24:31','2026-04-13 13:24:31',NULL,0,1,'2026-04-13 13:24:31',0,0);
/*!40000 ALTER TABLE `legends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legends_backup_before_reset_20260413`
--

DROP TABLE IF EXISTS `legends_backup_before_reset_20260413`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `legends_backup_before_reset_20260413` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_by` bigint unsigned DEFAULT NULL,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `era_start_year` smallint unsigned DEFAULT NULL,
  `era_end_year` smallint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_demo` tinyint(1) DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `legends_slug_unique` (`slug`),
  KEY `legends_era_start_year_index` (`era_start_year`),
  KEY `legends_created_by_foreign` (`created_by`),
  KEY `legends_is_published_index` (`is_published`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legends_backup_before_reset_20260413`
--

LOCK TABLES `legends_backup_before_reset_20260413` WRITE;
/*!40000 ALTER TABLE `legends_backup_before_reset_20260413` DISABLE KEYS */;
INSERT INTO `legends_backup_before_reset_20260413` VALUES (1,1,'Ali Sami Yen','ali-sami-yen','1 Numaralı Üye ve Vizyoner','1905 yılında Mektep-i Sultani’de \"Türk olmayan takımları yenmek\" hedefiyle kulübü kuran kişidir.','<p>Turk sporunun en onemli figurlerinden biri olan Ali Sami Yen vefatinin yil donumunde spor camiasi tarafindan buyuk bir saygiyla aniliyor. Galatasaray Spor Kulubu nun bir numarali kurucusu ve Turk futbolunun oncusu olan Ali Sami Yen sadece bir kulup baskani degil ayni zamanda Turk sporunun modernlesme surecinin mimari olarak kabul ediliyor.<br><br>1905 yilinda Galatasaray Lisesi ogrencisiyken arkadaslariyla birlikte kulubu kuran Ali Sami Yen Turk olmayan takimlari yenmek amaciyla yola cikmis ve bu vizyonuyla Turk sporuna uluslararasi bir kimlik kazandirmistir. Kendisi sadece futbol sahasiyla sinirli kalmamis Turkiye Milli Olimpiyat Komitesi baskanligi yapmis ve Turkiye nin ilk milli macinda teknik direktorluk gorevini ustlenmistir.</p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;alisami.jpeg&quot;,&quot;filesize&quot;:43559,&quot;height&quot;:273,&quot;href&quot;:&quot;http://localhost:8080/storage/editor-content/4aouTah8QHscuG9Ctb4gkEKzmVFT6emcNkYMnSQo.jpg&quot;,&quot;url&quot;:&quot;http://localhost:8080/storage/editor-content/4aouTah8QHscuG9Ctb4gkEKzmVFT6emcNkYMnSQo.jpg&quot;,&quot;width&quot;:620}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;caption&quot;:&quot;Ali Sami Yen&quot;,&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpeg\"><a href=\"http://localhost:8080/storage/editor-content/4aouTah8QHscuG9Ctb4gkEKzmVFT6emcNkYMnSQo.jpg\"><img src=\"http://localhost:8080/storage/editor-content/4aouTah8QHscuG9Ctb4gkEKzmVFT6emcNkYMnSQo.jpg\" width=\"620\" height=\"273\"><figcaption class=\"attachment__caption attachment__caption--edited\">Ali Sami Yen</figcaption></a></figure><br>Ali Sami Yen in spor kulturune en buyuk katkilarindan biri de sporun sadece fiziksel bir aktivite degil ayni zamanda bir disiplin ve kultur oldugunu savunmasidir. Turkiye nin ilk spor muzesini kurarak basarilarin kayit altina alinmasini saglamis ve spor kurallarinin Turkcelestirilmesi icin calismalar yurutmustur. Mecidiyekoy de uzun yillar boyunca adini tasiyan stadyum Galatasaray taraftarlari icin bir yuvadan daha fazlasi olan ve sampiyonluklarin kutlandigi tarihi bir mekan olmustur.<br><br>Bugun Turk futbolu ve diger branslarda elde edilen basarilarin temelinde Ali Sami Yen in yuz yildan fazla bir sure once attigi saglam temeller yatmaktadir. Ferikoy deki kabri basinda her yil duzenlenen anma torenleri onun centilmenlik ve rekabet anlayisinin hala ne kadar gecerli oldugunu kanitlamaktadir. Turk sporu Ali Sami Yen in bir asir once ortaya koydugu hedeflerin pesinde kosmaya ve onun mirasini yasatmaya devam ediyor.<br><br>Galatasaray in kurulus yillarindaki diger onemli isimler veya Ali Sami Yen in hayati hakkinda daha fazla bilgi vermemi ister misiniz?</p>',1886,1951,'2026-03-23 19:56:54','2026-03-30 09:35:27',NULL,1,1,'2026-04-12 13:00:09'),(2,1,'Metin Oktay','metin-oktay','Sadakat ve Zarafetin Sembolü','Attığı goller kadar Galatasaraylılık duruşuyla da efsanedir.','Attığı 608 golle değil, Galatasaraylılık duruşuyla efsanedir. \"Galatasaraylılık bir din gibi bir şeydir\" sözüyle camianın manevi babası olmuştur. Formasına olan aşkı için servetleri reddetmiş, centilmenliğiyle rakip taraftarların bile saygısını kazanmıştır.',1955,1969,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1,1,'2026-04-12 13:00:09'),(3,1,'Fatih Terim','fatih-terim','Kazanma Geninin Sahibi','Hem futbolcu hem teknik direktör olarak kulüp tarihinin en çok kupa kazanan ismidir.','<p>Hem futbolcu hem teknik direktör olarak kulüp tarihinin en çok kupa kazanan ismidir. 1996-2000 arasındaki 4 üst üste şampiyonluk ve UEFA Kupası zaferiyle Galatasaray’ı dünya markası yapmıştır. \"Aslan\" hırsının sahadaki temsilcisidir. ...</p>',1996,2022,'2026-03-23 19:56:54','2026-03-30 17:37:13',NULL,1,1,'2026-04-12 13:00:09'),(4,1,'Gheorghe Hagi','gheorghe-hagi','Tarihin En İyi Yabancısı','Galatasaray formasıyla büyü yapan, 10 numarayı kutsallaştıran isimdir.','<p>Galatasaray formasıyla büyü yapan, 10 numarayı kutsallaştıran isimdir. UEFA Kupası ve Süper Kupa kazanılırken takımın saha içi lideriydi. Uzaktan attığı \"imkansız\" goller ve futbol zekasıyla bir nesle Galatasaraylılığı sevdiren sihirbazdır...</p>',1996,2001,'2026-03-23 19:56:54','2026-03-30 17:51:09',NULL,1,1,'2026-04-12 13:00:09'),(5,1,'Bülent Korkmaz','bulent-korkmaz','Cesaretin ve Bağlılığın Simgesi','Altyapıdan çıkıp tüm kariyerini Galatasaray’da geçiren büyük kaptandır.','Altyapıdan çıkıp tüm kariyerini Galatasaray’da geçiren, UEFA Kupası finalinde çıkık omuzuyla bandajlı halde savaşan efsanedir. Müzesindeki 29 kupayla dünyanın en çok kupa kazanan oyuncularından biridir. Kulübün sarsılmaz savunma hattıdır.',1987,2005,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1,1,'2026-04-12 13:00:09'),(6,1,'Fernando Muslera','fernando-muslera','Modern Zamanların Efsanesi','2011’den bu yana kaleyi koruyan kaptandır.','2011\'den bu yana kaleyi koruyan, kazanılan sayısız şampiyonlukta başrol oynayan kaptandır. Galatasaray tarihinin en çok forma giyen ve en çok kupa kazanan yabancı oyuncusu olarak, sadece yeteneğiyle değil karakteriyle de yaşayan bir efsanedir.',2011,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1,1,'2026-04-12 13:00:09'),(7,1,'Claudio Taffarel','claudio-taffarel','Kopenhag Kahramanı','2000 yılındaki Avrupa zaferlerinin gizli kahramanıdır.','2000 yılındaki Avrupa zaferlerinin gizli kahramanıdır. Henry\'nin kafasını çıkardığı o an, kulüp tarihinin yönünü değiştirmiştir. Sempatik tavırları ve kalecilik ekolüyle Florya\'nın ruhuna işlemiş, antrenör olarak da kulübe hizmet etmiştir.',1998,2001,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1,1,'2026-04-12 13:00:09'),(8,1,'Cevad Prekazi','cevad-prekazi','Monaco Fatihi','1980’li yılların sonunda Tanju Çolak ile kurduğu ortaklıkla öne çıktı.','1980\'li yılların sonunda Tanju Çolak ile kurduğu ortaklık ve Monaco\'ya attığı o efsanevi frikik golüyle hatırlanır. Galatasaray\'ın Avrupa serüveninin ilk büyük kahramanlarından biridir. O asil sol ayağı, tribünlerin unutamadığı bir melodi gibidir.',1985,1991,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1,1,'2026-04-12 13:00:09'),(9,1,'Jupp Derwall','jupp-derwall','Alman Ekolü ve Devrimci','1984 yılında Galatasaray’ın başına geçerek modern futbolu getiren adamdır.','1984 yılında Galatasaray\'ın başına geçerek Türk futboluna profesyonelliği, antrenman metodlarını ve modern futbolu getiren adamdır. 14 yıllık şampiyonluk hasretini bitiren ve bugünkü Avrupa başarılarının temelini atan vizyonerdir.',1984,1987,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1,1,'2026-04-12 13:00:09'),(10,1,'Mauro Icardi','mauro-icardi','Yeni Neslin Kahramanı','Sadece iki sezonda attığı kritik gollerle efsaneler arasına adını yazdırdı.','Sadece iki sezonda attığı kritik gollerle ve derbi performansıyla efsaneler arasına adını yazdırdı. Çocukların sevgilisi haline gelen, \"Aşkın Olayım\" şarkısıyla özdeşleşen Arjantinli, 23. ve 24. şampiyonlukların en büyük mimarı olarak tarihe geçti.',2022,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1,0,NULL);
/*!40000 ALTER TABLE `legends_backup_before_reset_20260413` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `mediaables`
--

DROP TABLE IF EXISTS `mediaables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mediaables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `media_id` bigint unsigned NOT NULL,
  `mediable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mediable_id` bigint unsigned NOT NULL,
  `usage_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `title_override` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `credit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `watermark_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_usage_unique` (`media_id`,`mediable_type`,`mediable_id`,`usage_type`),
  KEY `mediaables_mediable_type_mediable_id_index` (`mediable_type`,`mediable_id`),
  KEY `mediaables_usage_type_index` (`usage_type`),
  KEY `mediaables_sort_order_index` (`sort_order`),
  KEY `mediaables_is_primary_index` (`is_primary`),
  CONSTRAINT `mediaables_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mediaables`
--

LOCK TABLES `mediaables` WRITE;
/*!40000 ALTER TABLE `mediaables` DISABLE KEYS */;
INSERT INTO `mediaables` VALUES (8,7,'App\\Models\\News',4,'cover',0,1,NULL,NULL,NULL,NULL,0,'2026-04-14 17:42:21','2026-04-14 17:42:21'),(10,9,'App\\Models\\News',4,'gallery',0,0,NULL,NULL,NULL,NULL,0,'2026-04-14 18:49:34','2026-04-14 18:49:34'),(12,10,'App\\Models\\News',4,'cover',0,0,NULL,NULL,NULL,NULL,0,'2026-04-14 18:50:15','2026-04-14 18:50:15'),(13,10,'App\\Models\\News',4,'gallery',0,0,NULL,NULL,NULL,NULL,0,'2026-04-14 18:50:16','2026-04-14 18:50:16');
/*!40000 ALTER TABLE `mediaables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_02_22_181104_add_rank_and_cp_score_to_users_table',1),(5,'2026_02_22_183220_create_categories_table',1),(6,'2026_02_22_183220_create_legends_table',1),(7,'2026_02_22_183221_create_efsane_moments_table',1),(8,'2026_02_22_183221_create_history_events_table',1),(9,'2026_02_22_183222_create_news_table',1),(10,'2026_02_24_000000_add_role_to_users_table',1),(11,'2026_02_24_075258_add_role_to_users_table',1),(12,'2026_02_25_112523_alter_branch_length_on_news_table',1),(13,'2026_02_25_150303_add_status_and_drop_is_published_from_news_table',1),(14,'2026_02_25_181126_create_tags_table',1),(15,'2026_02_25_181127_create_news_tag_table',1),(16,'2026_02_25_183930_create_category_tag_table',1),(17,'2026_02_26_104332_add_is_super_admin_to_users_table',1),(18,'2026_02_27_114940_add_created_by_to_legends_table',1),(19,'2026_02_27_124655_add_created_by_to_history_events',1),(20,'2026_02_27_125100_add_created_by_to_efsane_moments',1),(21,'2026_02_27_131006_drop_legend_id_from_efsane_moments_table',1),(22,'2026_02_27_131044_create_efsane_moment_tag_table',1),(23,'2026_02_27_142602_ensure_type_on_tags_table',1),(24,'2026_02_27_144537_add_type_to_tags_table',2),(25,'2026_02_27_160254_add_fk_created_by_to_content_tables',3),(26,'2026_03_09_210000_create_sports_snapshots_table',4),(27,'2026_03_09_220000_expand_sports_snapshots_for_league_scope',5),(28,'2026_03_13_094118_create_trophies_table',6),(33,'2026_03_13_095358_create_legend_trophy_table',7),(34,'2026_03_13_095859_create_events_table',7),(35,'2026_03_13_100006_create_event_legend_table',7),(36,'2026_03_13_100325_create_event_trophy_table',7),(37,'2026_03_13_101500_add_wave1_fields_to_history_events_table',8),(38,'2026_03_13_121144_create_history_event_legend_table',9),(39,'2026_03_13_170500_create_history_event_trophy_table',10),(41,'2026_03_14_000000_create_historical_matches_table',11),(42,'2026_03_14_000050_create_season_archives_table',12),(43,'2026_03_14_000100_create_historical_match_pivot_tables',12),(44,'2026_03_14_040153_create_season_archive_legend_table',13),(45,'2026_03_14_040154_create_season_archive_trophy_table',13),(46,'2026_03_14_040156_create_history_event_season_archive_table',13),(47,'2026_03_14_000200_create_season_archive_legend_table',1),(48,'2026_03_14_000300_add_metadata_to_history_event_legend_table',14),(49,'2026_03_14_000310_add_sort_order_to_history_event_trophy_table',14),(52,'2026_03_14_211844_create_media_table',15),(53,'2026_03_14_211848_create_mediaables_table',15),(54,'2026_03_17_210000_create_timeline_entries_table',16),(55,'2026_03_19_140247_add_content_to_trophies_table',17),(56,'2026_03_20_000001_add_unique_index_to_timeline_entries',18),(57,'2026_03_21_212800_update_news_status_enum',19),(58,'2026_03_21_183344_drop_can_write_from_users_table',20),(59,'2026_03_22_120000_add_hero_eligible_to_news_table',21),(60,'2026_03_22_120100_create_homepage_hero_overrides_table',21),(61,'2026_03_21_214726_create_archive_items_table',22),(62,'2026_03_23_000001_add_is_demo_to_content_tables',23),(63,'2026_03_25_173345_create_taggables_table',23),(64,'2026_03_25_200000_create_settings_table',24),(65,'2026_03_25_210210_add_is_demo_to_moments_and_archives',25),(66,'2026_03_30_174106_remove_cover_image_path_columns_batch1',26),(67,'2026_03_30_181943_remove_unused_efsane_moment_tables',27),(68,'2026_03_30_193844_remove_unused_archive_items_table',28),(69,'2026_03_30_194322_remove_unused_event_tables',29),(70,'2026_03_31_102558_backfill_news_tag_to_taggables',30),(71,'2026_03_31_102917_backfill_news_tag_to_taggables_retry',31),(72,'2026_03_31_113023_add_is_active_and_can_write_to_users_table',32),(73,'2026_04_02_100232_create_world_cup_tournaments_table',100),(74,'2026_04_02_100234_create_world_cup_groups_table',100),(75,'2026_04_02_100236_create_world_cup_teams_table',100),(76,'2026_04_02_100238_create_world_cup_stadiums_table',100),(77,'2026_04_02_100240_create_world_cup_matches_table',100),(78,'2026_04_02_100242_create_world_cup_players_table',100),(79,'2026_04_02_100243_create_world_cup_group_standings_table',100),(80,'2026_04_02_100245_create_world_cup_content_relations_table',100),(81,'2026_04_02_100247_create_world_cup_sync_logs_table',100),(82,'2026_04_02_100249_create_world_cup_settings_table',100),(83,'2026_04_01_173500_create_widget_overrides_table',100),(84,'2026_04_01_214500_create_campaigns_table',100),(85,'2026_04_07_132520_add_stadium_canonical_tables_and_columns',101),(86,'2026_04_07_182037_add_is_locked_to_world_cup_matches',999),(87,'2026_04_07_230000_add_content_fields_to_world_cup_stadiums',999),(88,'2026_04_10_010000_add_missing_content_fields_to_world_cup_stadiums_safe',1000),(89,'2026_04_12_162547_add_publish_to_legends_table',1001),(90,'2026_04_12_151300_add_publish_fields_to_legends_table',1002),(91,'2026_04_14_115200_add_checksum_index_to_media_table',1003),(92,'2026_04_14_141354_add_watermark_enabled_to_mediaables_table',1003);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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

--
-- Table structure for table `news_backup_before_clear_20260414`
--

DROP TABLE IF EXISTS `news_backup_before_clear_20260414`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news_backup_before_clear_20260414` (
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
  KEY `news_status_published_at_index` (`status`,`published_at`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_backup_before_clear_20260414`
--

LOCK TABLES `news_backup_before_clear_20260414` WRITE;
/*!40000 ALTER TABLE `news_backup_before_clear_20260414` DISABLE KEYS */;
INSERT INTO `news_backup_before_clear_20260414` VALUES (11,2,1,'futbol','Parçalı Formayı Giymeye Hazır: İlkay Gündoğan Geliyor','parcali-formayi-giymeye-hazir-ilkay-gundogan-geliyor','Sarı-kırmızılı camiada beklenen transfer müjdesi sonunda geliyor.','Sarı-kırmızılı camiada beklenen transfer müjdesi sonunda geliyor. Barcelona ve Manchester City kariyerlerinin ardından çocukluk aşkı Galatasaray ile görüşmelere başlayan tecrübeli yıldız İlkay Gündoğan ile prensip anlaşmasına varıldı. Yönetimin, Şampiyonlar Ligi tecrübesiyle orta sahayı orkestra şefi gibi yönetecek olan yıldız oyuncuyu önümüzdeki hafta İstanbul\'a getirmesi bekleniyor.','https://youtu.be/Hmx1fSY6uDE?si=2vRCyIOWUGyNDoI0',NULL,'draft',1,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(12,2,1,'futbol','Durdurulamayan Aslan: Victor Osimhen’den 3 Gol Birden','durdurulamayan-aslan-victor-osimhenden-3-gol-birden','Süper Lig’in 26. haftasında Kasımpaşa’yı konuk eden Galatasaray, yıldız forvetinin şovuyla kazandı.','Süper Lig’in 26. haftasında Kasımpaşa’yı konuk eden Galatasaray, Nijeryalı süper golcüsü Victor Osimhen’in yıldızlaştığı maçta sahadan 4-1 galip ayrıldı. Maçın ardından tribünlere \"üçlü\" çektiren Osimhen, gol krallığı yarışında rakipleriyle arasındaki farkı açarken, taraftarların sevgisini bir kez daha perçinledi.','https://youtu.be/8hJIvwbM1vQ?si=_Qhh7G9bXiu2x1qK',NULL,'draft',1,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(13,2,1,'futbol','Şampiyonlar Ligi Çeyrek Finalinde Rakip: Bayern Münih','sampiyonlar-ligi-ceyrek-finalinde-rakip-bayern-munih','Avrupa arenasında dev randevu yaklaşıyor.','<p>UEFA Şampiyonlar Ligi son 16 turunda Portekiz ekibi Porto\'yu eleyerek adını çeyrek finale yazdıran Galatasaray\'ın rakibi belli oldu. Nyon\'da çekilen kurada sarı-kırmızılılar, Alman devi Bayern Münih ile eşleşti. İlk maçın Rams Park\'ta oynanacak olması, İstanbul\'da şimdiden \"Cehennem\" atmosferi hazırlıklarını başlattı...</p>','https://youtu.be/K_Jj4DIYaaE?si=syDZNblZovxwbA7U',NULL,'draft',1,0,'2026-03-23 19:56:54','2026-03-30 17:50:17',NULL,1),(14,1,1,'genel','Galatasaray Daikin CEV Kupası Yarı Finalinde Avantajı Kaptı','galatasaray-daikin-cev-kupasi-yari-finalinde-avantaji-kapti','Filenin Aslanları finale bir adım daha yaklaştı.','Kadın voleybolunun yükselen değeri Galatasaray Daikin, CEV Kupası yarı final ilk maçında İtalyan rakibini deplasmanda 3-1 mağlup ederek final kapısını araladı. Kaptan İlkin Aydın ve pasör çaprazı Alexia Carutasu’nun muazzam oyunuyla dönen takımımız, Burhan Felek’teki rövanş öncesi taraftarına büyük umut verdi.','https://youtu.be/uGFNuxy4OOc?si=eW7aMHX3m3VbCp0u',NULL,'draft',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(15,2,1,'futbol','Akademi Meyvelerini Veriyor: 3 Genç Yıldız A Takıma Çıktı','akademi-meyvelerini-veriyor-3-genc-yildiz-a-takima-cikti','Florya’da altyapı devrimi sahaya yansıyor.','Galatasaray Akademisi, teknik direktör Okan Buruk’un raporu doğrultusunda U19 takımından öne çıkan 3 yeteneği (Emirhan, Caner ve Yusuf) profesyonel kadroya dahil etti. \"Florya’nın suyuyla büyüyen\" gençlerin, önümüzdeki kupa maçlarında şans bulması bekleniyor.','https://youtu.be/hmcRnVoE2BE?si=7z2Dph_bj30tDyyE',NULL,'draft',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(16,3,1,'basketbol','Parkenin Aslanları Derbide Geri Döndü!','parkenin-aslanlari-derbide-geri-dondu','Basketbolda derbi zaferi geldi.','Basketbol Süper Ligi’nin dev derbisinde Galatasaray, deplasmanda geriye düştüğü maçta son periyot performansı ile ezeli rakibini 89-84 mağlup etti. Koç Pozzecco’nun teknik faul sonrası tribünleri ateşlemesi ve takımın savunma direnci, galibiyetin anahtarı oldu.','https://youtu.be/6PU-_xX5wAk?si=oZ_tUS4N99AiATmj',NULL,'draft',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(17,2,1,'futbol','Icardi’nin Galatasaray Aşkı Bitmiyor: Sosyal Medya Sallandı','icardinin-galatasaray-aski-bitmiyor-sosyal-medya-sallandi','Yıldız oyuncunun paylaşımı taraftarı heyecanlandırdı.','Arjantinli yıldız Mauro Icardi, Instagram hesabından yaptığı \"Burada kendimi evimde hissediyorum, hikaye henüz bitmedi\" paylaşımıyla taraftarı heyecanlandırdı. Sözleşme uzatma sinyali olarak yorumlanan bu paylaşım, dakikalar içinde binlerce beğeni alarak gündeme oturdu.','https://youtu.be/LBv_x4Pv6t8?si=4KGgJhYQUUR5u0YC',NULL,'draft',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(18,1,1,'genel','Kombineler Tükendi, Maç Günü Gelirlerinde Tarihi Zirve','kombineler-tukendi-mac-gunu-gelirlerinde-tarihi-zirve','Rams Park’ta gelir rekoru kapıda.','Galatasaray yönetimi, 2025-2026 sezonu loca ve kombine gelirlerinin tarihin en yüksek seviyesine ulaştığını açıkladı. Şampiyonlar Ligi ve ligdeki başarılarla birlikte kulübün kasasına giren rakamlar, yeni sezon transfer bütçesinin de habercisi oldu.','https://youtu.be/a2wR1tBCKmQ?si=WyVGz7FPWDQdLxt3',NULL,'draft',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(19,1,1,'genel','Tekerlekli Sandalye Basketbolda Final-Four Heyecanı Başlıyor','tekerlekli-sandalye-basketbolda-final-four-heyecani-basliyor','Engelsiz Aslanlar Avrupa yolunda.','Dünya şampiyonu unvanlı Galatasaray Fuzul, Avrupa Şampiyonlar Ligi’nde gruplardan lider çıkarak Final-Four’a kalmayı başardı. Nisan ayında düzenlenecek finallerde Aslanlar, 6. kez Avrupa’nın en büyüğü olmak için sahaya çıkacak.','https://youtu.be/mU8GGpoe75s?si=nR50BkkuvcHI91B9',NULL,'draft',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(20,1,1,'genel','Efsane UEFA Kupası Forması Yeniden Satışta!','efsane-uefa-kupasi-formasi-yeniden-satista','GS Store’da retro çılgınlığı başladı.','Taraftarların yoğun isteği üzerine 2000 yılındaki UEFA şampiyonluğunda giyilen ikonik \"Beyaz Yaka Parçalı\" formanın sınırlı sayıda üretilen retro versiyonu GS Store’larda satışa sunuldu. Mağazalarda uzun kuyruklar oluşurken, online satış sitesi yoğunluktan kısa süreliğine erişime kapandı.','https://youtu.be/C1uhC8EZsmI?si=KBilbB7fYvollDvt',NULL,'draft',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(21,2,1,NULL,'Florya’da Milli Ara Mesaisi: Okan Buruk’tan Gençlere Yakın Markaj','floryada-milli-ara-mesaisi-okan-buruktan-genclere-yakin-markaj',NULL,'<p><strong>İSTANBUL</strong> – Trendyol Süper Lig’de şampiyonluk yolunda emin adımlarla ilerleyen Galatasaray, milli maçlar nedeniyle lige verilen arayı Florya Metin Oktay Tesisleri’nde yoğun bir tempoyla değerlendiriyor.&nbsp;</p><p>Teknik direktör <strong>Okan Buruk</strong> yönetiminde gerçekleştirilen bugünkü antrenmanda, taktik ağırlıklı çift kale maç ön plana çıktı. Milli takımlara giden 12 oyuncunun eksikliğinde, akademi liglerinden A takıma davet edilen genç yeteneklerin performansı teknik heyetin yüzünü güldürdü.&nbsp; &nbsp;</p>',NULL,NULL,'draft',0,0,'2026-03-24 07:53:13','2026-03-24 17:04:35',NULL,1),(24,2,1,NULL,'Florya\'da Trabzonspor Mesaisi Başladı: Icardi Bilmecesi!','floryada-trabzonspor-mesaisi-basladi-icardi-bilmecesi','Şampiyonlar Ligi’ndeki Liverpool serüveninin ardından rotayı tamamen lige kıran Galatasaray, 4 Nisan’daki kritik Trabzonspor derbisinin hazırlıklarına başladı.','<p>Şampiyonlar Ligi’ndeki Liverpool serüveninin ardından rotayı tamamen lige kıran Galatasaray, 4 Nisan’daki kritik <strong>Trabzonspor</strong> derbisinin hazırlıklarına başladı. Takımda en çok merak edilen konu ise antrenmanlarda yer almayan <strong>Mauro Icardi</strong>’nin durumu. Sağlık heyeti, Arjantinli yıldızı derbiye yetiştirmek için yoğun bir mesai harcıyor.</p><p>Teknik direktör Okan Buruk\'un, hücum hattında Osimhen ve Icardi ikilisini aynı anda sahaya sürüp sürmeyeceği taktik idmanlarda netleşecek.</p>',NULL,NULL,'draft',0,0,'2026-03-25 16:44:06','2026-03-25 16:44:07',NULL,1),(25,2,1,NULL,'Osimhen’den Kötü Haber: Ameliyat Edildi!','osimhenden-kotu-haber-ameliyat-edildi','Liverpool ile oynanan Şampiyonlar Ligi son 16 turu rövanş maçında talihsiz bir sakatlık yaşayan Victor Osimhen\'den camiayı üzen haber geldi.','<p>Liverpool ile oynanan Şampiyonlar Ligi son 16 turu rövanş maçında talihsiz bir sakatlık yaşayan <strong>Victor Osimhen</strong>\'den camiayı üzen haber geldi. Kolunda kırık tespit edilen Nijeryalı yıldız, başarılı bir operasyon geçirdi. Yıldız golcünün sahalardan en az 4 hafta uzak kalması bekleniyor.</p><p>Trabzonspor derbisinde forma giyemeyecek olan Osimhen\'in yerine forvet hattında tüm sorumluluk Icardi ve takıma yeni ısınan genç yeteneklerin omuzlarında olacak.</p>',NULL,NULL,'draft',0,0,'2026-03-25 16:47:43','2026-03-25 16:47:43',NULL,1),(26,2,1,NULL,'Renato Nhaga A Takım Kadrosuna Dahil Edildi','renato-nhaga-a-takim-kadrosuna-dahil-edildi','Liverpool ile oynanan Avrupa maçlarında statü gereği kadroda yer alamayan genç yetenek Renato Nhaga, ligdeki Trabzonspor maçı kafilesine dahil edildi','<p>Liverpool ile oynanan Avrupa maçlarında statü gereği kadroda yer alamayan genç yetenek Renato Nhaga, ligdeki Trabzonspor maçı kafilesine dahil edildi. Antrenman performansıyla Okan Buruk’un gözüne giren genç sol bek, sol bek rotasyonunda rekabeti artıracak.<br><br>Önemli Detay: Genç oyuncunun, milli ara süresince as takım ile çıktığı çift kale maçlardaki enerjisi, teknik heyetten tam not aldı...</p>',NULL,NULL,'draft',0,0,'2026-03-25 16:52:38','2026-03-30 17:02:37',NULL,1),(27,2,1,NULL,'Noa Lang\'dan Müjde: \"PlayStation Oynayamıyorum Ama Sahadayım!\"','noa-langdan-mujde-playstation-oynayamiyorum-ama-sahadayim','Liverpool maçında reklam panolarına çarparak parmağından ciddi bir operasyon geçiren Noa Lang, korkutan sakatlığı sonrası ilk kez konuştu.','<p>Liverpool maçında reklam panolarına çarparak parmağından ciddi bir operasyon geçiren <strong>Noa Lang</strong>, korkutan sakatlığı sonrası ilk kez konuştu. Hollandalı yıldız, parmağının yerinde olduğunu ve durumunun iyiye gittiğini esprili bir dille anlattı: <em>\"Şu an PlayStation oynayamıyorum ama futbol oynamak için sadece bacaklarıma ihtiyacım var.\"</em> *&nbsp;</p><p>Kulüp doktoru Yener İnce, yıldız oyuncunun özel bir bandajla Trabzonspor derbisinde sahada olabileceğini doğruladı. Lang, milli takım kampına da davet edildi.&nbsp;</p>',NULL,NULL,'draft',0,0,'2026-03-25 16:56:31','2026-03-25 16:59:02',NULL,1),(28,1,1,NULL,'Galatasaray 2025-2026 Sezonu Panoraması','galatasaray-2025-2026-sezonu-panoramasi-test','Galatasaray, 2025-2026 sezonuna hem yerel ligde tarih yazma (5. yıldız) hedefiyle hem de UEFA Şampiyonlar Ligi’nin yeni formatında ses getirme parolasıyla başladı.','<h1>🦁 Galatasaray 2025-2026 Sezonu Panoraması: Beşinci Yıldız ve Avrupa Heyecanı</h1>\n<p><strong>Tarih:</strong> 29 Mart 2026<br />\n<strong>Rapor:</strong> Sezon Sonu Değerlendirmesi ve Mevcut Durum Analizi</p>\n<p>Galatasaray, 2025-2026 sezonuna hem yerel ligde tarih yazma (5. yıldız) hedefiyle hem de UEFA Şampiyonlar Ligi’nin yeni formatında ses getirme parolasıyla başladı. Teknik direktör Okan Buruk yönetimindeki sarı-kırmızılılar, Mart sonu itibarıyla hedeflerine emin adımlarla ilerliyor.</p>\n<hr />\n<h2>🇹🇷 Trendyol Süper Lig: Zirvede Tek Başına</h2>\n<p>Süper Lig\'de sezonun bitimine az bir süre kala Galatasaray, şampiyonluk yarışının en güçlü adayı konumunda. Takım, &quot;25. Şampiyonluk ve 5. Yıldız&quot; motivasyonuyla sahada domine edici bir oyun sergiliyor.</p>\n<ul>\n<li><strong>Puan Durumu:</strong> 26 hafta sonunda toplanan <strong>64 puanla</strong> liderlik koltuğu korunuyor.</li>\n<li><strong>İstatistiksel Üstünlük:</strong> Oynanan maçlarda atılan <strong>62 golle</strong> ligin en golcü takımı olan Cimbom, kalesinde gördüğü sadece <strong>18 golle</strong> savunma disiplininden taviz vermediğini kanıtladı.</li>\n<li><strong>Kritik Eşikler:</strong> Beşiktaş deplasmanında alınan galibiyet ve iç sahadaki Başakşehir zaferi, şampiyonluk yolundaki psikolojik üstünlüğü perçinledi. Şimdi gözler, Nisan sonunda oynanacak ve şampiyonun düğümünü çözecek olan Fenerbahçe derbisinde.</li>\n</ul>\n<hr />\n<h2>🇪🇺 UEFA Şampiyonlar Ligi: Devlerin Arasında Bir Aslan</h2>\n<p>Bu sezon yeni &quot;Lig Formatı&quot; ile oynanan Şampiyonlar Ligi’nde Galatasaray, Türk futbolu adına unutulmaz bir yürüyüş gerçekleştirdi.</p>\n<ul>\n<li><strong>Grup (Lig) Aşaması:</strong> Sezona Frankfurt deplasmanındaki şanssız mağlubiyetle başlansa da, İstanbul\'da devleşen bir Galatasaray izledik. Özellikle <strong>Liverpool karşısında alınan 1-0\'lık galibiyet</strong> ve deplasmandaki <strong>3-0\'lık Ajax zaferi</strong>, Avrupa basınında geniş yankı buldu.</li>\n<li><strong>Play-Off Destanı:</strong> Lig aşamasını geçtikten sonra Play-Off turunda İtalyan devi <strong>Juventus</strong> ile eşleşen sarı-kırmızılılar, İstanbul\'da 5-2\'lik skorla rakibini sahadan sildi ve Son 16 turuna adını yazdırdı.</li>\n<li><strong>Veda:</strong> Son 16 turunda tekrar Liverpool ile eşleşen temsilcimiz, Anfield\'daki rövanşta 4-0 mağlup olarak turnuvaya veda etti. Ancak sergilenen futbol, Galatasaray\'ın Avrupa elitleri arasındaki yerini sağlamlaştırdı.</li>\n</ul>\n<hr />\n<h2>🏆 Ziraat Türkiye Kupası: Çift Kupa Hedefi</h2>\n<p>Galatasaray, rotasyonlu kadrosuyla Türkiye Kupası\'nda da hata yapmadan ilerliyor. Okan Buruk, bu sezonu &quot;Double&quot; (Lig + Kupa) yaparak tamamlamayı hedefliyor.</p>\n<ul>\n<li><strong>Yolculuk:</strong> Grup aşamasında Başakşehir, İstanbulspor ve Alanyaspor gibi zorlu rakipleri geride bırakan takım, grup lideri olarak çeyrek finale yükseldi.</li>\n<li><strong>Sıradaki Rakip:</strong> 22 Nisan 2026 tarihinde oynanacak olan çeyrek final müsabakasında rakip <strong>Gençlerbirliği</strong>. Takımın bu turu da kayıpsız geçerek finale yürümesi bekleniyor.</li>\n</ul>\n<hr />\n<h2>📊 Öne Çıkan Yıldızlar</h2>\n<table>\n<thead>\n<tr>\n<th align=\"left\">Oyuncu</th>\n<th align=\"left\">Performans Notu</th>\n<th align=\"left\">Öne Çıkan Özelliği</th>\n</tr>\n</thead>\n<tbody>\n<tr>\n<td align=\"left\"><strong>Victor Osimhen</strong></td>\n<td align=\"left\">⭐⭐⭐⭐⭐</td>\n<td align=\"left\">Avrupa ve ligde toplam 28 golle takımın sürükleyicisi.</td>\n</tr>\n<tr>\n<td align=\"left\"><strong>Yunus Akgün</strong></td>\n<td align=\"left\">⭐⭐⭐⭐</td>\n<td align=\"left\">Sezonun asist kralı adayı; oyun kurucu rolünde devleşti.</td>\n</tr>\n<tr>\n<td align=\"left\"><strong>Mauro Icardi</strong></td>\n<td align=\"left\">⭐⭐⭐⭐</td>\n<td align=\"left\">Kritik derbi golleri ve liderlik karakteriyle vazgeçilmez.</td>\n</tr>\n<tr>\n<td align=\"left\"><strong>Davinson Sánchez</strong></td>\n<td align=\"left\">⭐⭐⭐⭐⭐</td>\n<td align=\"left\">Savunmanın sigortası; ligin en az gol yiyen defans hattının lideri.</td>\n</tr>\n</tbody>\n</table>\n<hr />\n<p><strong>Sonuç olarak;</strong> Galatasaray 2025-2026 sezonunu hem sportif başarı hem de mali gelir anlamında zirvede tamamlamaya çok yakın. Taraftarlar şimdiden 5. yıldız kutlamaları için hazırlıklara başlamış durumda.</p>\n<blockquote>\n<p>&quot;Galatasaray bir his takımıdır; bu sezon o his zirveye ulaştı.&quot;</p>\n</blockquote>\n<hr />\n<p><strong>Bu analizle ilgili belirli bir oyuncunun detaylı istatistiklerini veya kalan fikstürün zorluk derecesini incelememi ister misin?</strong></p>\n',NULL,'2026-03-29 08:59:51','published',1,0,'2026-03-29 08:59:51','2026-03-29 08:59:51',NULL,0);
/*!40000 ALTER TABLE `news_backup_before_clear_20260414` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_tag`
--

DROP TABLE IF EXISTS `news_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news_tag` (
  `news_id` bigint unsigned NOT NULL,
  `tag_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`news_id`,`tag_id`),
  KEY `news_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `news_tag_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  CONSTRAINT `news_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_tag`
--

LOCK TABLES `news_tag` WRITE;
/*!40000 ALTER TABLE `news_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `news_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `season_archive_legend`
--

DROP TABLE IF EXISTS `season_archive_legend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `season_archive_legend` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `season_archive_id` bigint unsigned NOT NULL,
  `legend_id` bigint unsigned NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `relation_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `season_archive_legend_unique` (`season_archive_id`,`legend_id`),
  KEY `season_archive_legend_legend_id_foreign` (`legend_id`),
  CONSTRAINT `season_archive_legend_legend_id_foreign` FOREIGN KEY (`legend_id`) REFERENCES `legends` (`id`) ON DELETE CASCADE,
  CONSTRAINT `season_archive_legend_season_archive_id_foreign` FOREIGN KEY (`season_archive_id`) REFERENCES `season_archives` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `season_archive_legend`
--

LOCK TABLES `season_archive_legend` WRITE;
/*!40000 ALTER TABLE `season_archive_legend` DISABLE KEYS */;
/*!40000 ALTER TABLE `season_archive_legend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `season_archive_trophy`
--

DROP TABLE IF EXISTS `season_archive_trophy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `season_archive_trophy` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `season_archive_id` bigint unsigned NOT NULL,
  `trophy_id` bigint unsigned NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `relation_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `season_archive_trophy_unique` (`season_archive_id`,`trophy_id`),
  KEY `season_archive_trophy_trophy_id_foreign` (`trophy_id`),
  CONSTRAINT `season_archive_trophy_season_archive_id_foreign` FOREIGN KEY (`season_archive_id`) REFERENCES `season_archives` (`id`) ON DELETE CASCADE,
  CONSTRAINT `season_archive_trophy_trophy_id_foreign` FOREIGN KEY (`trophy_id`) REFERENCES `trophies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `season_archive_trophy`
--

LOCK TABLES `season_archive_trophy` WRITE;
/*!40000 ALTER TABLE `season_archive_trophy` DISABLE KEYS */;
/*!40000 ALTER TABLE `season_archive_trophy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `season_archives`
--

DROP TABLE IF EXISTS `season_archives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `season_archives` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `season_label` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_year` smallint unsigned DEFAULT NULL,
  `end_year` smallint unsigned DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `season_overview` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `league_summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `europe_summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cup_summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `manager_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `editorial_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `importance_score` int unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_demo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `season_archives_slug_unique` (`slug`),
  KEY `season_archives_start_end_year_index` (`start_year`,`end_year`),
  KEY `season_archives_season_label_index` (`season_label`),
  KEY `season_archives_start_year_index` (`start_year`),
  KEY `season_archives_end_year_index` (`end_year`),
  KEY `season_archives_is_published_index` (`is_published`),
  KEY `season_archives_published_at_index` (`published_at`),
  KEY `season_archives_importance_score_index` (`importance_score`),
  KEY `season_archives_is_featured_index` (`is_featured`),
  KEY `season_archives_created_by_index` (`created_by`),
  CONSTRAINT `fk_season_archives_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `season_archives`
--

LOCK TABLES `season_archives` WRITE;
/*!40000 ALTER TABLE `season_archives` DISABLE KEYS */;
/*!40000 ALTER TABLE `season_archives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `season_archives_backup_before_clear_20260413`
--

DROP TABLE IF EXISTS `season_archives_backup_before_clear_20260413`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `season_archives_backup_before_clear_20260413` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `season_label` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_year` smallint unsigned DEFAULT NULL,
  `end_year` smallint unsigned DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `season_overview` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `league_summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `europe_summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cup_summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `manager_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `editorial_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `importance_score` int unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_demo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `season_archives_slug_unique` (`slug`),
  KEY `season_archives_start_end_year_index` (`start_year`,`end_year`),
  KEY `season_archives_season_label_index` (`season_label`),
  KEY `season_archives_start_year_index` (`start_year`),
  KEY `season_archives_end_year_index` (`end_year`),
  KEY `season_archives_is_published_index` (`is_published`),
  KEY `season_archives_published_at_index` (`published_at`),
  KEY `season_archives_importance_score_index` (`importance_score`),
  KEY `season_archives_is_featured_index` (`is_featured`),
  KEY `season_archives_created_by_index` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `season_archives_backup_before_clear_20260413`
--

LOCK TABLES `season_archives_backup_before_clear_20260413` WRITE;
/*!40000 ALTER TABLE `season_archives_backup_before_clear_20260413` DISABLE KEYS */;
INSERT INTO `season_archives_backup_before_clear_20260413` VALUES (1,'Güneşin Doğuşu: Mektep-i Sultani’den Sahalara','1905-kurucu-sezon','1905',1905,1905,0,NULL,'Ali Sami Yen ve arkadaşlarının \"Türk olmayan takımları yenmek\" hedefiyle kulübü kurduğu ilk yıl.','Ali Sami Yen ve arkadaşlarının \"Türk olmayan takımları yenmek\" hedefiyle kulübü kurduğu ilk yıl. Galatasaray’ın asaletinin ve vizyonunun temellerinin atıldığı, Türk spor tarihinin başlangıç noktası sayılan en kritik sezon.','Ali Sami Yen ve arkadaşlarının \"Türk olmayan takımları yenmek\" hedefiyle kulübü kurduğu ilk yıl. Galatasaray’ın asaletinin ve vizyonunun temellerinin atıldığı, Türk spor tarihinin başlangıç noktası sayılan en kritik sezon.','Kuruluş ve ilk örgütlenme dönemi.',NULL,NULL,NULL,NULL,NULL,70,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(2,'Modern Galatasaray\'ın Doğuşu: Jupp Derwall Devrimi','1986-1987-14-yillik-hasretin-sonu','1986-1987',1986,1987,0,NULL,'14 yıllık şampiyonluk özleminin bittiği sezon.','14 yıl süren şampiyonluk özleminin bittiği, Alman ekolüyle tesisleşmenin ve taktiksel disiplinin kulübe girdiği sezon. Bu şampiyonluk, 90\'lı yıllardaki büyük Avrupa yürüyüşünün ilk kıvılcımıdır.','14 yıl süren şampiyonluk özleminin bittiği, Alman ekolüyle tesisleşmenin ve taktiksel disiplinin kulübe girdiği sezon. Bu şampiyonluk, 90\'lı yıllardaki büyük Avrupa yürüyüşünün ilk kıvılcımıdır.','Lig şampiyonluğuyla sonuçlanan dönüş sezonu.',NULL,NULL,'Jupp Derwall',NULL,NULL,84,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(3,'Gençleşme Operasyonu ve \"Kupa Beyi\" Unvanı','1992-1993-feldkamp-ile-gelen-cifte-kupa','1992-1993',1992,1993,0,NULL,'Feldkamp ile yenilenen kadro çifte kupaya uzandı.','Karl-Heinz Feldkamp\'ın takımı baştan aşağı yenilediği, Hakan Şükür gibi gençlerin parladığı sezon. Hem lig hem de Türkiye Kupası\'nın kazanılması, Galatasaray’ın 90\'lı yıllara damga vuracağının habercisiydi.','Karl-Heinz Feldkamp\'ın takımı baştan aşağı yenilediği, Hakan Şükür gibi gençlerin parladığı sezon. Hem lig hem de Türkiye Kupası\'nın kazanılması, Galatasaray’ın 90\'lı yıllara damga vuracağının habercisiydi.','Lig şampiyonluğu ve Türkiye Kupası ile tamamlandı.',NULL,'Çifte kupa.','Karl-Heinz Feldkamp',NULL,NULL,82,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(4,'\"Dörtte Dört\" Serisinin İlk Adımı','1996-1997-fatih-terim-donemi-basliyor','1996-1997',1996,1997,0,NULL,'Fatih Terim dönemi ve büyük serinin başlangıcı...','Fatih Terim’in teknik direktörlüğe gelişi ve Hagi’nin transferiyle başlayan yeni çağ. Bu sezon kazanılan şampiyonluk, Türk futbol tarihinin en büyük dominasyon dönemini başlatan ilk halkadır.','Fatih Terim’in teknik direktörlüğe gelişi ve Hagi’nin transferiyle başlayan yeni çağ. Bu sezon kazanılan şampiyonluk, Türk futbol tarihinin en büyük dominasyon dönemini başlatan ilk halkadır.','Lig zaferiyle yeni çağ açıldı.',NULL,NULL,'Fatih Terim',NULL,NULL,86,0,1,'2026-03-23 19:56:54','2026-03-30 17:51:02',1),(5,'Tarihin Zirvesi: UEFA Kupası ve \"Triple\"','1999-2000-altin-yil-the-golden-season','1999-2000',1999,2000,0,NULL,'Türk futbolunun kulüpler bazında ulaştığı en yüksek sezon.','Galatasaray’ın hem Lig, hem Türkiye Kupası hem de UEFA Kupası\'nı kazanarak \"üçleme\" yaptığı, Türk futbolunun kulüpler bazında ulaştığı en yüksek nokta. Dünyanın Galatasaray\'ı hayranlıkla izlediği efsanevi sezon.','Galatasaray’ın hem Lig, hem Türkiye Kupası hem de UEFA Kupası\'nı kazanarak \"üçleme\" yaptığı, Türk futbolunun kulüpler bazında ulaştığı en yüksek nokta. Dünyanın Galatasaray\'ı hayranlıkla izlediği efsanevi sezon.','Lig şampiyonluğu.','UEFA Kupası ile zirve.','Türkiye Kupası kazanıldı.','Fatih Terim',NULL,NULL,100,1,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(6,'İnancın Zaferi: Denizli’den Gelen Şampiyonluk','2005-2006-16-dakikalik-mucize','2005-2006',2005,2006,0,NULL,'Efsane 16 dakikalık bekleyişin sezonu.','Maddi imkansızlıklara rağmen Eric Gerets yönetiminde sergilenen muazzam performans. Ligin son maçında sahadaki 90 dakika bittikten sonra, şampiyonluk için Denizli’den gelecek haberin beklendiği o efsanevi 16 dakikalık bekleyişin sezonu.','Maddi imkansızlıklara rağmen Eric Gerets yönetiminde sergilenen muazzam performans. Ligin son maçında sahadaki 90 dakika bittikten sonra, şampiyonluk için Denizli’den gelecek haberin beklendiği o efsanevi 16 dakikalık bekleyişin sezonu.','Lig şampiyonluğu mucizeyle geldi.',NULL,NULL,'Eric Gerets',NULL,NULL,84,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(7,'Süper Final ve Karanlıkta Kalkan Kupa','2011-2012-yeniden-dogus-ve-kadikoy-zaferi','2011-2012',2011,2012,0,NULL,'Yıldızlar karmasıyla gelen yeniden doğuş.','Üst üste gelen başarısızlıkların ardından Fatih Terim’in 3. döneminde kurulan \"Yıldızlar Karması\" (Muslera, Selçuk İnan, Elmander, Melo). Ezeli rakibin sahasında ışıklar altında kaldırılan o kupa, kulüp tarihinin en epik şampiyonluk sezonudur.','Üst üste gelen başarısızlıkların ardından Fatih Terim’in 3. döneminde kurulan \"Yıldızlar Karması\" (Muslera, Selçuk İnan, Elmander, Melo). Ezeli rakibin sahasında ışıklar altında kaldırılan o kupa, kulüp tarihinin en epik şampiyonluk sezonudur.','Süper Final ile gelen şampiyonluk.',NULL,NULL,'Fatih Terim',NULL,NULL,95,1,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(8,'Juventus’u Eleyen Aslan ve Şampiyonlar Ligi Çeyrek Finali','2013-2014-avrupada-istikrar-ve-drogba-etkisi','2013-2014',2013,2014,0,NULL,'Dünya yıldızlarıyla gelen Avrupa görünürlüğü.','Dünya yıldızları Drogba ve Sneijder’in takıma gelişi, Juventus’u karlar altında eleyip Şampiyonlar Ligi’nde son 16\'ya kalma başarısı. Galatasaray’ın global bir marka olarak zirve yaptığı modern dönem sezonu.','Dünya yıldızları Drogba ve Sneijder’in takıma gelişi, Juventus’u karlar altında eleyip Şampiyonlar Ligi’nde son 16\'ya kalma başarısı. Galatasaray’ın global bir marka olarak zirve yaptığı modern dönem sezonu.',NULL,'Şampiyonlar Ligi’nde güçlü yürüyüş.',NULL,'Roberto Mancini',NULL,NULL,88,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(9,'Türkiye’de Bir İlk: 20. Şampiyonluk ve 4. Yıldız','2014-2015-4-yildizin-takildigi-yil','2014-2015',2014,2015,0,NULL,'4. yıldızın takıldığı tarihi sezon.','Hamza Hamzaoğlu yönetiminde \"3 Kupa\" ile tamamlanan sezon. Galatasaray’ın Türkiye’de 4. yıldızı göğsüne takan ilk kulüp olarak ezeli rekabette farkı açtığı tarihi dönemeç.','Hamza Hamzaoğlu yönetiminde \"3 Kupa\" ile tamamlanan sezon. Galatasaray’ın Türkiye’de 4. yıldızı göğsüne takan ilk kulüp olarak ezeli rekabette farkı açtığı tarihi dönemeç.','20. şampiyonluk geldi.',NULL,'Türkiye Kupası da kazanıldı.','Hamza Hamzaoğlu',NULL,NULL,90,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(10,'100. Yılda En Büyük Cimbom: Okan Buruk ve Rekorlar','2022-2023-cumhuriyetin-100-yil-sampiyonlugu-sezonu','2022-2023',2022,2023,0,NULL,'Cumhuriyetin 100. yılında gelen unutulmaz şampiyonluk...','Cumhuriyetin 100. yılında şampiyonluk parolasıyla çıkılan, 14 maçlık galibiyet serisiyle rekorların kırıldığı ve Icardi’nin ikonikleştiği sezon. Bu zafer, kulübün modern çağdaki yükselişinin ve yeni hegemonyasının başlangıcıdır.','Cumhuriyetin 100. yılında şampiyonluk parolasıyla çıkılan, 14 maçlık galibiyet serisiyle rekorların kırıldığı ve Icardi’nin ikonikleştiği sezon. Bu zafer, kulübün modern çağdaki yükselişinin ve yeni hegemonyasının başlangıcıdır.','Lig şampiyonluğu.',NULL,NULL,'Okan Buruk',NULL,NULL,96,1,1,'2026-03-23 19:56:54','2026-03-30 17:02:29',1);
/*!40000 ALTER TABLE `season_archives_backup_before_clear_20260413` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('AyAWUpdbPeplL9Hg9U8YE6Fisn3C2rNqQaD7HLPU',1,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUXpZdk1CcjFzUGhscXR5QVJQZnM2Sm1EUGlqNVY0dkxsS1NZbDVtNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6OTY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC9oYWJlcmxlci9iYXJpcy1hbHBlci15aWxtYXotZ2FsYXRhc2FyYXktZm9ybWFzaW5kYS1iaXIta2V6LWRhaGEtZGFseWEtZGVkaSI7czo1OiJyb3V0ZSI7czo5OiJuZXdzLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjY0OiI3OTY1NTFlODI1YzI4MGVjNzQ4ZmE3ZDAxZTliMzA4YTJjZGQwYWY5YjQ0NjgxYTU4MzIyZTI4OWI4ZjUwNTMzIjtzOjg6ImZpbGFtZW50IjthOjA6e319',1776773305);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site_mode','ghost','2026-03-25 19:38:18','2026-04-10 17:04:12'),(2,'theme_mode','light',NULL,'2026-04-10 17:04:12');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sports_snapshots`
--

DROP TABLE IF EXISTS `sports_snapshots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sports_snapshots` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `snapshot_key` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `scope_type` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'team',
  `scope_id` bigint unsigned DEFAULT NULL,
  `team_id` bigint unsigned NOT NULL,
  `season` int unsigned NOT NULL,
  `result_limit` int unsigned NOT NULL DEFAULT '0',
  `payload` json NOT NULL,
  `checksum` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_success_at` timestamp NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sports_snapshots_unique_scope` (`snapshot_key`,`scope_type`,`scope_id`,`season`,`result_limit`),
  KEY `sports_snapshots_team_season_index` (`team_id`,`season`),
  KEY `sports_snapshots_expires_at_index` (`expires_at`),
  KEY `sports_snapshots_last_success_at_index` (`last_success_at`),
  KEY `sports_snapshots_scope_index` (`scope_type`,`scope_id`,`season`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sports_snapshots`
--

LOCK TABLES `sports_snapshots` WRITE;
/*!40000 ALTER TABLE `sports_snapshots` DISABLE KEYS */;
INSERT INTO `sports_snapshots` VALUES (1,'next_match','team',645,645,2025,0,'{\"raw\": {\"goals\": {\"away\": null, \"home\": null}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": null, \"home\": null}, \"halftime\": {\"away\": null, \"home\": null}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 997, \"logo\": \"https://media.api-sports.io/football/teams/997.png\", \"name\": \"Gençlerbirliği S.K.\", \"winner\": null}, \"home\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}}, \"league\": {\"id\": 206, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/206.png\", \"name\": \"Türkiye Kupası\", \"round\": \"Quarter-finals\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": false}, \"fixture\": {\"id\": 1531969, \"date\": \"2026-04-22T17:30:00+00:00\", \"venue\": {\"id\": null, \"city\": \"Istanbul\", \"name\": \"Rams Park\"}, \"status\": {\"long\": \"Not Started\", \"extra\": null, \"short\": \"NS\", \"elapsed\": null}, \"periods\": {\"first\": null, \"second\": null}, \"referee\": null, \"timezone\": \"UTC\", \"timestamp\": 1776879000}}, \"away_id\": 997, \"home_id\": 645, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/997.png\", \"away_name\": \"Gençlerbirliği S.K.\", \"home_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"home_name\": \"Galatasaray\", \"league_id\": 206, \"detail_url\": \"/mac/1531969\", \"fixture_id\": 1531969, \"venue_city\": \"Istanbul\", \"venue_name\": \"Rams Park\", \"league_logo\": \"https://media.api-sports.io/football/leagues/206.png\", \"league_name\": \"Türkiye Kupası\", \"status_long\": \"Not Started\", \"status_short\": \"NS\", \"match_datetime\": \"22.04.2026 17:30\"}','97969566f22f3f72ceeaa768d94e5d3ee30b9802','2026-04-21 11:47:58','2026-04-21 12:02:58','2026-03-09 16:49:37','2026-04-21 11:47:59'),(2,'upcoming_fixtures','team',645,645,2025,0,'[{\"raw\": {\"goals\": {\"away\": null, \"home\": null}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": null, \"home\": null}, \"halftime\": {\"away\": null, \"home\": null}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 997, \"logo\": \"https://media.api-sports.io/football/teams/997.png\", \"name\": \"Gençlerbirliği S.K.\", \"winner\": null}, \"home\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}}, \"league\": {\"id\": 206, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/206.png\", \"name\": \"Türkiye Kupası\", \"round\": \"Quarter-finals\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": false}, \"fixture\": {\"id\": 1531969, \"date\": \"2026-04-22T17:30:00+00:00\", \"venue\": {\"id\": null, \"city\": \"Istanbul\", \"name\": \"Rams Park\"}, \"status\": {\"long\": \"Not Started\", \"extra\": null, \"short\": \"NS\", \"elapsed\": null}, \"periods\": {\"first\": null, \"second\": null}, \"referee\": null, \"timezone\": \"UTC\", \"timestamp\": 1776879000}}, \"away_id\": 997, \"home_id\": 645, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/997.png\", \"away_name\": \"Gençlerbirliği S.K.\", \"home_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"home_name\": \"Galatasaray\", \"league_id\": 206, \"detail_url\": \"/mac/1531969\", \"fixture_id\": 1531969, \"venue_city\": \"Istanbul\", \"venue_name\": \"Rams Park\", \"league_logo\": \"https://media.api-sports.io/football/leagues/206.png\", \"league_name\": \"Türkiye Kupası\", \"status_long\": \"Not Started\", \"status_short\": \"NS\", \"match_datetime\": \"22.04.2026 17:30\"}, {\"raw\": {\"goals\": {\"away\": null, \"home\": null}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": null, \"home\": null}, \"halftime\": {\"away\": null, \"home\": null}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 611, \"logo\": \"https://media.api-sports.io/football/teams/611.png\", \"name\": \"Fenerbahçe\", \"winner\": null}, \"home\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 31\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394707, \"date\": \"2026-04-26T17:00:00+00:00\", \"venue\": {\"id\": null, \"city\": \"Istanbul\", \"name\": \"Rams Park\"}, \"status\": {\"long\": \"Not Started\", \"extra\": null, \"short\": \"NS\", \"elapsed\": null}, \"periods\": {\"first\": null, \"second\": null}, \"referee\": null, \"timezone\": \"UTC\", \"timestamp\": 1777222800}}, \"away_id\": 611, \"home_id\": 645, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/611.png\", \"away_name\": \"Fenerbahçe\", \"home_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"home_name\": \"Galatasaray\", \"league_id\": 203, \"detail_url\": \"/mac/1394707\", \"fixture_id\": 1394707, \"venue_city\": \"Istanbul\", \"venue_name\": \"Rams Park\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Not Started\", \"status_short\": \"NS\", \"match_datetime\": \"26.04.2026 17:00\"}, {\"raw\": {\"goals\": {\"away\": null, \"home\": null}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": null, \"home\": null}, \"halftime\": {\"away\": null, \"home\": null}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}, \"home\": {\"id\": 3603, \"logo\": \"https://media.api-sports.io/football/teams/3603.png\", \"name\": \"Samsunspor\", \"winner\": null}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 32\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394719, \"date\": \"2026-05-03T17:00:00+00:00\", \"venue\": {\"id\": 11925, \"city\": \"Samsun\", \"name\": \"Samsun 19 Mayis Stadyumu\"}, \"status\": {\"long\": \"Not Started\", \"extra\": null, \"short\": \"NS\", \"elapsed\": null}, \"periods\": {\"first\": null, \"second\": null}, \"referee\": null, \"timezone\": \"UTC\", \"timestamp\": 1777827600}}, \"away_id\": 645, \"home_id\": 3603, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"away_name\": \"Galatasaray\", \"home_logo\": \"https://media.api-sports.io/football/teams/3603.png\", \"home_name\": \"Samsunspor\", \"league_id\": 203, \"detail_url\": \"/mac/1394719\", \"fixture_id\": 1394719, \"venue_city\": \"Samsun\", \"venue_name\": \"Samsun 19 Mayis Stadyumu\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Not Started\", \"status_short\": \"NS\", \"match_datetime\": \"03.05.2026 17:00\"}, {\"raw\": {\"goals\": {\"away\": null, \"home\": null}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": null, \"home\": null}, \"halftime\": {\"away\": null, \"home\": null}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 1005, \"logo\": \"https://media.api-sports.io/football/teams/1005.png\", \"name\": \"Antalyaspor\", \"winner\": null}, \"home\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 33\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394725, \"date\": \"2026-05-10T17:00:00+00:00\", \"venue\": {\"id\": null, \"city\": \"Istanbul\", \"name\": \"Rams Park\"}, \"status\": {\"long\": \"Not Started\", \"extra\": null, \"short\": \"NS\", \"elapsed\": null}, \"periods\": {\"first\": null, \"second\": null}, \"referee\": null, \"timezone\": \"UTC\", \"timestamp\": 1778432400}}, \"away_id\": 1005, \"home_id\": 645, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/1005.png\", \"away_name\": \"Antalyaspor\", \"home_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"home_name\": \"Galatasaray\", \"league_id\": 203, \"detail_url\": \"/mac/1394725\", \"fixture_id\": 1394725, \"venue_city\": \"Istanbul\", \"venue_name\": \"Rams Park\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Not Started\", \"status_short\": \"NS\", \"match_datetime\": \"10.05.2026 17:00\"}, {\"raw\": {\"goals\": {\"away\": null, \"home\": null}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": null, \"home\": null}, \"halftime\": {\"away\": null, \"home\": null}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}, \"home\": {\"id\": 1004, \"logo\": \"https://media.api-sports.io/football/teams/1004.png\", \"name\": \"Kasımpaşa\", \"winner\": null}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 34\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394734, \"date\": \"2026-05-17T17:00:00+00:00\", \"venue\": {\"id\": 1585, \"city\": \"Istanbul\", \"name\": \"Recep Tayyip Erdoğan Stadyumu\"}, \"status\": {\"long\": \"Not Started\", \"extra\": null, \"short\": \"NS\", \"elapsed\": null}, \"periods\": {\"first\": null, \"second\": null}, \"referee\": null, \"timezone\": \"UTC\", \"timestamp\": 1779037200}}, \"away_id\": 645, \"home_id\": 1004, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"away_name\": \"Galatasaray\", \"home_logo\": \"https://media.api-sports.io/football/teams/1004.png\", \"home_name\": \"Kasımpaşa\", \"league_id\": 203, \"detail_url\": \"/mac/1394734\", \"fixture_id\": 1394734, \"venue_city\": \"Istanbul\", \"venue_name\": \"Recep Tayyip Erdoğan Stadyumu\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Not Started\", \"status_short\": \"NS\", \"match_datetime\": \"17.05.2026 17:00\"}]','214a295e61cf8a1b68eb92db9fa54efbc0f8639d','2026-04-21 11:47:59','2026-04-21 12:47:59','2026-03-09 16:49:37','2026-04-21 11:47:59'),(3,'last_matches','team',645,645,2025,0,'[{\"raw\": {\"goals\": {\"away\": 2, \"home\": 1}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": 2, \"home\": 1}, \"halftime\": {\"away\": 2, \"home\": 0}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": true}, \"home\": {\"id\": 997, \"logo\": \"https://media.api-sports.io/football/teams/997.png\", \"name\": \"Gençlerbirliği S.K.\", \"winner\": false}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 30\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394697, \"date\": \"2026-04-18T17:00:00+00:00\", \"venue\": {\"id\": 2378, \"city\": \"Ankara\", \"name\": \"Eryaman Stadium\"}, \"status\": {\"long\": \"Match Finished\", \"extra\": 7, \"short\": \"FT\", \"elapsed\": 90}, \"periods\": {\"first\": 1776531600, \"second\": 1776535200}, \"referee\": \"Batuhan Kolak, Türkiye\", \"timezone\": \"UTC\", \"timestamp\": 1776531600}}, \"score\": \"1 - 2\", \"result\": \"win\", \"away_id\": 645, \"home_id\": 997, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"away_name\": \"Galatasaray\", \"home_logo\": \"https://media.api-sports.io/football/teams/997.png\", \"home_name\": \"Gençlerbirliği S.K.\", \"league_id\": 203, \"away_goals\": 2, \"detail_url\": \"/mac/1394697\", \"fixture_id\": 1394697, \"home_goals\": 1, \"venue_city\": \"Ankara\", \"venue_name\": \"Eryaman Stadium\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Match Finished\", \"status_short\": \"FT\", \"match_datetime\": \"18.04.2026 17:00\"}, {\"raw\": {\"goals\": {\"away\": 1, \"home\": 1}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": 1, \"home\": 1}, \"halftime\": {\"away\": 0, \"home\": 1}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 7411, \"logo\": \"https://media.api-sports.io/football/teams/7411.png\", \"name\": \"Kocaelispor\", \"winner\": null}, \"home\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 29\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394689, \"date\": \"2026-04-12T17:00:00+00:00\", \"venue\": {\"id\": null, \"city\": \"Istanbul\", \"name\": \"Rams Park Stadyumu\"}, \"status\": {\"long\": \"Match Finished\", \"extra\": 6, \"short\": \"FT\", \"elapsed\": 90}, \"periods\": {\"first\": 1776013200, \"second\": 1776016800}, \"referee\": \"Oguzhan Cakir, Türkiye\", \"timezone\": \"UTC\", \"timestamp\": 1776013200}}, \"score\": \"1 - 1\", \"result\": \"draw\", \"away_id\": 7411, \"home_id\": 645, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/7411.png\", \"away_name\": \"Kocaelispor\", \"home_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"home_name\": \"Galatasaray\", \"league_id\": 203, \"away_goals\": 1, \"detail_url\": \"/mac/1394689\", \"fixture_id\": 1394689, \"home_goals\": 1, \"venue_city\": \"Istanbul\", \"venue_name\": \"Rams Park Stadyumu\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Match Finished\", \"status_short\": \"FT\", \"match_datetime\": \"12.04.2026 17:00\"}, {\"raw\": {\"goals\": {\"away\": 3, \"home\": 1}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": 3, \"home\": 1}, \"halftime\": {\"away\": 2, \"home\": 0}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": true}, \"home\": {\"id\": 994, \"logo\": \"https://media.api-sports.io/football/teams/994.png\", \"name\": \"Göztepe\", \"winner\": false}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 27\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394672, \"date\": \"2026-04-08T17:00:00+00:00\", \"venue\": {\"id\": 22441, \"city\": \"Izmir\", \"name\": \"Gürsel Aksel Stadyumu\"}, \"status\": {\"long\": \"Match Finished\", \"extra\": 4, \"short\": \"FT\", \"elapsed\": 90}, \"periods\": {\"first\": 1775667600, \"second\": 1775671200}, \"referee\": \"Alper Akarsu, Türkiye\", \"timezone\": \"UTC\", \"timestamp\": 1775667600}}, \"score\": \"1 - 3\", \"result\": \"win\", \"away_id\": 645, \"home_id\": 994, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"away_name\": \"Galatasaray\", \"home_logo\": \"https://media.api-sports.io/football/teams/994.png\", \"home_name\": \"Göztepe\", \"league_id\": 203, \"away_goals\": 3, \"detail_url\": \"/mac/1394672\", \"fixture_id\": 1394672, \"home_goals\": 1, \"venue_city\": \"Izmir\", \"venue_name\": \"Gürsel Aksel Stadyumu\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Match Finished\", \"status_short\": \"FT\", \"match_datetime\": \"08.04.2026 17:00\"}, {\"raw\": {\"goals\": {\"away\": 1, \"home\": 2}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": 1, \"home\": 2}, \"halftime\": {\"away\": 0, \"home\": 1}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": false}, \"home\": {\"id\": 998, \"logo\": \"https://media.api-sports.io/football/teams/998.png\", \"name\": \"Trabzonspor\", \"winner\": true}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 28\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394684, \"date\": \"2026-04-04T17:00:00+00:00\", \"venue\": {\"id\": 20189, \"city\": \"Trabzon\", \"name\": \"Papara Park\"}, \"status\": {\"long\": \"Match Finished\", \"extra\": 4, \"short\": \"FT\", \"elapsed\": 90}, \"periods\": {\"first\": 1775322000, \"second\": 1775325600}, \"referee\": \"Cihan Aydin, Türkiye\", \"timezone\": \"UTC\", \"timestamp\": 1775322000}}, \"score\": \"2 - 1\", \"result\": \"loss\", \"away_id\": 645, \"home_id\": 998, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"away_name\": \"Galatasaray\", \"home_logo\": \"https://media.api-sports.io/football/teams/998.png\", \"home_name\": \"Trabzonspor\", \"league_id\": 203, \"away_goals\": 1, \"detail_url\": \"/mac/1394684\", \"fixture_id\": 1394684, \"home_goals\": 2, \"venue_city\": \"Trabzon\", \"venue_name\": \"Papara Park\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Match Finished\", \"status_short\": \"FT\", \"match_datetime\": \"04.04.2026 17:00\"}, {\"raw\": {\"goals\": {\"away\": 0, \"home\": 4}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": 0, \"home\": 4}, \"halftime\": {\"away\": 0, \"home\": 1}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": false}, \"home\": {\"id\": 40, \"logo\": \"https://media.api-sports.io/football/teams/40.png\", \"name\": \"Liverpool\", \"winner\": true}}, \"league\": {\"id\": 2, \"flag\": null, \"logo\": \"https://media.api-sports.io/football/leagues/2.png\", \"name\": \"UEFA Champions League\", \"round\": \"Round of 16\", \"season\": 2025, \"country\": \"World\", \"standings\": true}, \"fixture\": {\"id\": 1528329, \"date\": \"2026-03-18T20:00:00+00:00\", \"venue\": {\"id\": null, \"city\": \"Liverpool\", \"name\": \"Anfield\"}, \"status\": {\"long\": \"Match Finished\", \"extra\": 7, \"short\": \"FT\", \"elapsed\": 90}, \"periods\": {\"first\": 1773864000, \"second\": 1773867600}, \"referee\": \"P. Raczkowski\", \"timezone\": \"UTC\", \"timestamp\": 1773864000}}, \"score\": \"4 - 0\", \"result\": \"loss\", \"away_id\": 645, \"home_id\": 40, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"away_name\": \"Galatasaray\", \"home_logo\": \"https://media.api-sports.io/football/teams/40.png\", \"home_name\": \"Liverpool\", \"league_id\": 2, \"away_goals\": 0, \"detail_url\": \"/mac/1528329\", \"fixture_id\": 1528329, \"home_goals\": 4, \"venue_city\": \"Liverpool\", \"venue_name\": \"Anfield\", \"league_logo\": \"https://media.api-sports.io/football/leagues/2.png\", \"league_name\": \"UEFA Champions League\", \"status_long\": \"Match Finished\", \"status_short\": \"FT\", \"match_datetime\": \"18.03.2026 20:00\"}]','8c971fb5a8d8663fcabac93789f97968ba8a1a4d','2026-04-21 11:47:59','2026-04-21 12:17:59','2026-03-09 16:49:37','2026-04-21 11:47:59'),(4,'league_standings_full','league',203,0,2025,20,'[{\"won\": 22, \"form\": \"WDWLW\", \"lost\": 3, \"rank\": 1, \"drawn\": 5, \"played\": 30, \"points\": 71, \"team_id\": 645, \"team_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"team_name\": \"Galatasaray\", \"goals_diff\": 46, \"is_galatasaray\": true}, {\"won\": 19, \"form\": \"DWWWL\", \"lost\": 1, \"rank\": 2, \"drawn\": 10, \"played\": 30, \"points\": 67, \"team_id\": 611, \"team_logo\": \"https://media.api-sports.io/football/teams/611.png\", \"team_name\": \"Fenerbahçe\", \"goals_diff\": 38, \"is_galatasaray\": false}, {\"won\": 19, \"form\": \"DDWWW\", \"lost\": 3, \"rank\": 3, \"drawn\": 8, \"played\": 30, \"points\": 65, \"team_id\": 998, \"team_logo\": \"https://media.api-sports.io/football/teams/998.png\", \"team_name\": \"Trabzonspor\", \"goals_diff\": 25, \"is_galatasaray\": false}, {\"won\": 16, \"form\": \"LWLWW\", \"lost\": 7, \"rank\": 4, \"drawn\": 7, \"played\": 30, \"points\": 55, \"team_id\": 549, \"team_logo\": \"https://media.api-sports.io/football/teams/549.png\", \"team_name\": \"Beşiktaş\", \"goals_diff\": 18, \"is_galatasaray\": false}, {\"won\": 13, \"form\": \"DWDDL\", \"lost\": 8, \"rank\": 5, \"drawn\": 9, \"played\": 30, \"points\": 48, \"team_id\": 564, \"team_logo\": \"https://media.api-sports.io/football/teams/564.png\", \"team_name\": \"Başakşehir\", \"goals_diff\": 17, \"is_galatasaray\": false}, {\"won\": 12, \"form\": \"DDLWD\", \"lost\": 6, \"rank\": 6, \"drawn\": 12, \"played\": 30, \"points\": 48, \"team_id\": 994, \"team_logo\": \"https://media.api-sports.io/football/teams/994.png\", \"team_name\": \"Göztepe\", \"goals_diff\": 10, \"is_galatasaray\": false}, {\"won\": 10, \"form\": \"WWLDW\", \"lost\": 8, \"rank\": 7, \"drawn\": 12, \"played\": 30, \"points\": 42, \"team_id\": 3603, \"team_logo\": \"https://media.api-sports.io/football/teams/3603.png\", \"team_name\": \"Samsunspor\", \"goals_diff\": -3, \"is_galatasaray\": false}, {\"won\": 9, \"form\": \"DWWLL\", \"lost\": 11, \"rank\": 8, \"drawn\": 10, \"played\": 30, \"points\": 37, \"team_id\": 1007, \"team_logo\": \"https://media.api-sports.io/football/teams/1007.png\", \"team_name\": \"Rizespor\", \"goals_diff\": -1, \"is_galatasaray\": false}, {\"won\": 9, \"form\": \"WWDWW\", \"lost\": 11, \"rank\": 9, \"drawn\": 10, \"played\": 30, \"points\": 37, \"team_id\": 607, \"team_logo\": \"https://media.api-sports.io/football/teams/607.png\", \"team_name\": \"Konyaspor\", \"goals_diff\": -3, \"is_galatasaray\": false}, {\"won\": 9, \"form\": \"WLDLW\", \"lost\": 11, \"rank\": 10, \"drawn\": 10, \"played\": 30, \"points\": 37, \"team_id\": 3573, \"team_logo\": \"https://media.api-sports.io/football/teams/3573.png\", \"team_name\": \"Gaziantep FK\", \"goals_diff\": -8, \"is_galatasaray\": false}, {\"won\": 9, \"form\": \"DDDLL\", \"lost\": 12, \"rank\": 11, \"drawn\": 9, \"played\": 30, \"points\": 36, \"team_id\": 7411, \"team_logo\": \"https://media.api-sports.io/football/teams/7411.png\", \"team_name\": \"Kocaelispor\", \"goals_diff\": -9, \"is_galatasaray\": false}, {\"won\": 6, \"form\": \"LDDWD\", \"lost\": 9, \"rank\": 12, \"drawn\": 15, \"played\": 30, \"points\": 33, \"team_id\": 996, \"team_logo\": \"https://media.api-sports.io/football/teams/996.png\", \"team_name\": \"Alanyaspor\", \"goals_diff\": 0, \"is_galatasaray\": false}, {\"won\": 7, \"form\": \"WDWLW\", \"lost\": 13, \"rank\": 13, \"drawn\": 10, \"played\": 30, \"points\": 31, \"team_id\": 1004, \"team_logo\": \"https://media.api-sports.io/football/teams/1004.png\", \"team_name\": \"Kasımpaşa\", \"goals_diff\": -12, \"is_galatasaray\": false}, {\"won\": 7, \"form\": \"LLWDL\", \"lost\": 16, \"rank\": 14, \"drawn\": 7, \"played\": 30, \"points\": 28, \"team_id\": 1005, \"team_logo\": \"https://media.api-sports.io/football/teams/1005.png\", \"team_name\": \"Antalyaspor\", \"goals_diff\": -19, \"is_galatasaray\": false}, {\"won\": 6, \"form\": \"LLLLL\", \"lost\": 17, \"rank\": 15, \"drawn\": 7, \"played\": 30, \"points\": 25, \"team_id\": 997, \"team_logo\": \"https://media.api-sports.io/football/teams/997.png\", \"team_name\": \"Gençlerbirliği S.K.\", \"goals_diff\": -15, \"is_galatasaray\": false}, {\"won\": 6, \"form\": \"WLLLL\", \"lost\": 17, \"rank\": 16, \"drawn\": 7, \"played\": 30, \"points\": 25, \"team_id\": 3588, \"team_logo\": \"https://media.api-sports.io/football/teams/3588.png\", \"team_name\": \"Eyüpspor\", \"goals_diff\": -22, \"is_galatasaray\": false}, {\"won\": 4, \"form\": \"LLLWL\", \"lost\": 15, \"rank\": 17, \"drawn\": 11, \"played\": 30, \"points\": 23, \"team_id\": 1001, \"team_logo\": \"https://media.api-sports.io/football/teams/1001.png\", \"team_name\": \"Kayserispor\", \"goals_diff\": -36, \"is_galatasaray\": false}, {\"won\": 5, \"form\": \"LLWLW\", \"lost\": 20, \"rank\": 18, \"drawn\": 5, \"played\": 30, \"points\": 20, \"team_id\": 3589, \"team_logo\": \"https://media.api-sports.io/football/teams/3589.png\", \"team_name\": \"Fatih Karagümrük\", \"goals_diff\": -26, \"is_galatasaray\": false}]','5700817a26a5890920d9705fdc409e3c60927823','2026-04-21 11:47:45','2026-04-21 12:47:45','2026-03-09 17:49:57','2026-04-21 11:47:45');
/*!40000 ALTER TABLE `sports_snapshots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taggables`
--

DROP TABLE IF EXISTS `taggables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `taggables` (
  `tag_id` bigint unsigned NOT NULL,
  `taggable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `taggables_tag_id_taggable_id_taggable_type_unique` (`tag_id`,`taggable_id`,`taggable_type`),
  KEY `taggables_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`),
  CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taggables`
--

LOCK TABLES `taggables` WRITE;
/*!40000 ALTER TABLE `taggables` DISABLE KEYS */;
INSERT INTO `taggables` VALUES (1,'App\\Models\\Category',1,NULL,NULL),(1,'App\\Models\\Category',2,NULL,NULL),(1,'App\\Models\\Category',3,NULL,NULL),(1,'App\\Models\\News',22,NULL,NULL),(2,'App\\Models\\Category',1,NULL,NULL),(2,'App\\Models\\Category',2,NULL,NULL),(2,'App\\Models\\Category',3,NULL,NULL),(3,'App\\Models\\Category',1,NULL,NULL),(3,'App\\Models\\Category',2,NULL,NULL),(3,'App\\Models\\Category',3,NULL,NULL),(4,'App\\Models\\Category',1,NULL,NULL),(4,'App\\Models\\Category',2,NULL,NULL),(4,'App\\Models\\Category',3,NULL,NULL),(4,'App\\Models\\News',22,NULL,NULL),(5,'App\\Models\\Category',1,NULL,NULL),(5,'App\\Models\\Category',2,NULL,NULL),(5,'App\\Models\\Category',3,NULL,NULL),(6,'App\\Models\\Category',1,NULL,NULL),(6,'App\\Models\\Category',2,NULL,NULL),(6,'App\\Models\\Category',3,NULL,NULL),(7,'App\\Models\\Category',1,NULL,NULL),(7,'App\\Models\\Category',2,NULL,NULL),(7,'App\\Models\\Category',3,NULL,NULL),(7,'App\\Models\\News',22,NULL,NULL),(10,'App\\Models\\Category',1,NULL,NULL),(10,'App\\Models\\Category',2,NULL,NULL),(10,'App\\Models\\Category',3,NULL,NULL),(11,'App\\Models\\Category',2,NULL,NULL),(11,'App\\Models\\News',27,'2026-03-31 10:40:31','2026-03-31 10:40:31'),(12,'App\\Models\\Category',3,NULL,NULL),(12,'App\\Models\\News',22,NULL,NULL),(13,'App\\Models\\Category',1,NULL,NULL),(14,'App\\Models\\News',27,'2026-03-31 10:40:31','2026-03-31 10:40:31');
/*!40000 ALTER TABLE `taggables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_name_unique` (`name`),
  UNIQUE KEY `tags_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Duyuru','duyuru','genel','2026-03-23 19:56:54','2026-03-23 19:56:54'),(2,'Kulüp','kulup','genel','2026-03-23 19:56:54','2026-03-23 19:56:54'),(3,'Tarihçe','tarihce','genel','2026-03-23 19:56:54','2026-03-23 19:56:54'),(4,'Maç','mac','genel','2026-03-23 19:56:54','2026-03-23 19:56:54'),(5,'Transfer','transfer','genel','2026-03-23 19:56:54','2026-03-23 19:56:54'),(6,'Sakatlık','sakatlik','genel','2026-03-23 19:56:54','2026-03-23 19:56:54'),(7,'EuroLeague','euroleague','genel','2026-03-23 19:56:54','2026-03-23 19:56:54'),(10,'Kadro','kadro','genel','2026-03-23 19:56:54','2026-03-23 19:56:54'),(11,'Futbol','futbol','general','2026-02-28 00:23:50','2026-02-28 00:23:50'),(12,'Basketbol','basketbol','general','2026-02-28 00:27:52','2026-02-28 00:27:52'),(13,'Genel','genel','general','2026-02-28 00:28:54','2026-02-28 00:28:54'),(14,'Galatasaray','galatasaray','general',NULL,NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timeline_entries`
--

DROP TABLE IF EXISTS `timeline_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `timeline_entries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `timeline_date` date NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'moment',
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_id` bigint unsigned DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `position` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referenced_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci GENERATED ALWAYS AS ((case when ((`source_type` is not null) and (`source_id` is not null)) then concat(`source_type`,_utf8mb4'#',`source_id`,_utf8mb4'#',cast(`timeline_date` as date)) else NULL end)) STORED,
  `is_demo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `timeline_entries_referenced_unique` (`referenced_key`),
  KEY `timeline_entries_source_type_source_id_index` (`source_type`,`source_id`),
  KEY `timeline_entries_date_position_idx` (`timeline_date`,`position`),
  KEY `timeline_entries_type_visible_idx` (`type`,`is_visible`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timeline_entries`
--

LOCK TABLES `timeline_entries` WRITE;
/*!40000 ALTER TABLE `timeline_entries` DISABLE KEYS */;
INSERT INTO `timeline_entries` (`id`, `timeline_date`, `title`, `excerpt`, `type`, `icon`, `source_type`, `source_id`, `is_visible`, `position`, `created_at`, `updated_at`, `is_demo`) VALUES (1,'1905-10-01','Kuruluş: Bir Vizyonun Doğuşu (1905)','Galatasaray\'ın temellerinin atıldığı tarihi başlangıç.','moment',NULL,'App\\Models\\HistoryEvent',1,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(2,'1909-01-01','İlk Şampiyonluk: İstanbul Ligi Zaferi (1909)','Kulüp tarihinin ilk kupası.','moment',NULL,'App\\Models\\HistoryEvent',2,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(3,'1930-12-02','Atatürk ve Galatasaray (1922)','Cumhuriyetin kurucusunun kulüple bağı.','moment',NULL,'App\\Models\\HistoryEvent',3,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(4,'1928-08-31','Gazi Büstü Kupası (1923)','Cumhuriyetin ilk yıllarında önemli bir zafer.','moment',NULL,'App\\Models\\HistoryEvent',4,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(5,'1951-06-17','Berlin Panteri Turgay Şeren (1951)','Efsane kalecinin doğuşu.','moment',NULL,'App\\Models\\HistoryEvent',5,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(6,'1963-01-01','105 Gollü Rekor: Gündüz Kılıç Dönemi (1963)','Baba Gündüz yönetiminde kırılan tarihi hücum rekoru.','moment',NULL,'App\\Models\\HistoryEvent',7,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(7,'1973-01-01','İlk Hanedanlık: Brian Birch ile Üçte Üç (1973)','Galatasaray\'ın lig tarihinde ilk büyük seri şampiyonluk dönemi.','moment',NULL,'App\\Models\\HistoryEvent',8,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(8,'1987-06-07','Galatasaray 2 - 1 Eskişehirspor (7 Haziran 1987)','7 Haziran 1987 tarihinde Ali Sami Yen Stadı’nda oynanan ve Galatasaray’ın tam 14 yıl süren şampiyonluk hasretine son verdiği efsanevi maç. Prekazi ve Cüneyt Tanman’ın golleriyle gelen 2-1’lik galibiyet, sadece bir lig şampiyonluğu değil, Galatasaray’ın modern dönemdeki şampiyonluk dominasyonunun başladığı tarihtir.','match',NULL,'App\\Models\\HistoricalMatch',1,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(9,'1987-06-07','14 Yıllık Hasretin Sonu (1987)','Galatasaray\'ın modern çağdaki yeniden doğuş anı.','moment',NULL,'App\\Models\\HistoryEvent',10,1,3,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(10,'1988-11-09','Galatasaray 5 - 0 Neuchâtel Xamax (9 Kasım 1988)','9 Kasım 1988\'de Ali Sami Yen Stadı’nda oynanan ve Galatasaray’ın Avrupa tarihinin en büyük geri dönüşlerinden birine imza attığı efsanevi maç. İlk maçta alınan 3-0\'lık yenilginin ardından gelen 5-0\'lık galibiyet, sarı-kırmızılıların Avrupa\'da adını duyurduğu tarihi bir dönüm noktasıdır.','match',NULL,'App\\Models\\HistoricalMatch',11,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(11,'1988-11-09','İmkansızın İmzası: Neuchâtel Xamax 5-0 (1988)','Galatasaray\'ın Avrupa\'da imkansızı başardığını kanıtladığı gece.','moment',NULL,'App\\Models\\HistoryEvent',11,1,3,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(12,'1989-03-01','Monaco 0 - 1 Galatasaray (1 Mart 1989)','1 Mart 1989 tarihinde Şampiyon Kulüpler Kupası çeyrek final ilk maçında Galatasaray, deplasmanda Fransız devi Monaco\'yu 1-0 mağlup ederek tüm dünyayı şoka uğrattı. Arsène Wenger yönetimindeki yıldızlar topluluğu Monaco’yu kendi evinde yıkan bu galibiyet, Türk futbolunun Avrupa\'daki en yüksek irtifaya ulaştığı anlardan biridir.','match',NULL,'App\\Models\\HistoricalMatch',9,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(13,'1989-03-15','Galatasaray 1 - 1 Monaco (15 Mart 1989)','15 Mart 1989 tarihinde, cezası nedeniyle İstanbul yerine Almanya\'nın Köln şehrinde oynanan rövanş maçında Galatasaray, Monaco ile 1-1 berabere kalarak Şampiyon Kulüpler Kupası’nda yarı finale yükseldi. Bu başarı, Türk futbol tarihinde bir kulübün Avrupa\'nın en büyük kupasında ulaştığı ilk yarı final seviyesidir.','match',NULL,'App\\Models\\HistoricalMatch',10,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(14,'1989-03-15','Avrupa’nın En İyi 4 Takımı Arasında (1989)','Türk futbolunun kıta çapındaki ilk büyük kulüp yürüyüşü.','moment',NULL,'App\\Models\\HistoryEvent',14,1,3,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(15,'1993-10-20','Manchester United 3 - 3 Galatasaray (20 Ekim 1993)','20 Ekim 1993\'te Old Trafford\'da oynanan ve Galatasaray\'ın 2-0 geriden gelip 3-3 berabere kaldığı tarihi maç. Bu sonuç, sarı-kırmızılıların Avrupa\'da devlere karşı geri adım atmayacağını tüm kıtaya gösteren en önemli dönüm noktalarından biridir.','match',NULL,'App\\Models\\HistoricalMatch',4,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(16,'1993-11-03','Welcome to Hell: Manchester United Gecesi (1993)','Avrupa kimliginin dogus anlarindan biri.','moment',NULL,'App\\Models\\HistoryEvent',26,1,3,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(17,'1994-11-23','Galatasaray 2 - 1 Barcelona (23 Kasım 1994)','23 Kasım 1994 tarihinde Şampiyonlar Ligi grup aşamasında Galatasaray, Johan Cruyff yönetimindeki Barcelona\'yı 2-1 mağlup etti. Bu galibiyet, sarı-kırmızılıların Avrupa\'nın en büyük devlerine karşı başa baş oynayabildiğini gösteren en prestijli zaferlerden biridir.','match',NULL,'App\\Models\\HistoricalMatch',12,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(18,'1996-04-24','Kadikoyde Bayrak: Graeme Souness (1996)','Rekabet tarihinin en ikonik anlarindan biri.','moment',NULL,'App\\Models\\HistoryEvent',27,1,3,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(19,'1999-11-03','Galatasaray 3 - 2 AC Milan (3 Kasım 1999)','3 Kasım 1999\'da Ali Sami Yen Stadı’nda oynanan ve Galatasaray’ın Avrupa devlerinden AC Milan karşısında 2-0 geriden gelerek 3-2 kazandığı unutulmaz karşılaşma. Bu galibiyet, sarı-kırmızılıların Avrupa sahnesinde gerçek anlamda iddialı olduğunu tüm kıtaya ilan ettiği maçlardan biridir.','match',NULL,'App\\Models\\HistoricalMatch',3,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(20,'2000-05-14','Dörtte Dört: Üst Üste 4 Şampiyonluk (2000)','Turk futbolunda dominasyon donemi.','moment',NULL,'App\\Models\\HistoryEvent',28,1,3,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(21,'2000-05-17','Galatasaray 0 - 0 Arsenal (P. 4-1) (17 Mayıs 2000)','17 Mayıs 2000 tarihinde Kopenhag\'da oynanan UEFA Kupası finalinde Galatasaray, Arsenal\'i penaltılarla 4-1 mağlup ederek Avrupa\'da kupa kazanan ilk Türk takımı oldu. Bu maç, kulüp tarihinin en büyük zirvesidir.','match',NULL,'App\\Models\\HistoricalMatch',24,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(22,'2000-05-17','UEFA Kupası Şampiyonluğu (2000)','Turkiyenin ilk ve tek namaglup Avrupa sampiyonlugu. 17 Mayis 2000de Arsenale karsi kazanilan tarihi zafer.','trophy',NULL,'App\\Models\\Trophy',1,1,2,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(23,'2000-05-17','Kopenhag Destanı: UEFA Kupası Zaferi (2000)','Türk futbol tarihinin kulüpler düzeyindeki en büyük zaferi.','moment',NULL,'App\\Models\\HistoryEvent',16,1,3,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(24,'2000-08-25','Real Madrid 1 - 2 Galatasaray (25 Ağustos 2000)','25 Ağustos 2000\'de Monaco\'da oynanan UEFA Süper Kupa finalinde Galatasaray, Real Madrid’i 2-1 mağlup ederek Avrupa\'daki büyük zaferini bir kez daha tescilledi. Bu maç, sarı-kırmızılıların dünyanın en büyüklerine karşı zirvede kalabildiğini gösteren tarihi karşılaşmalardan biridir.','match',NULL,'App\\Models\\HistoricalMatch',2,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(25,'2000-08-25','UEFA Süper Kupa Şampiyonluğu (2000)','25 Agustos 2000de Monacoda Real Madridin yenilmesiyle gelen Avrupa zirvesi.','trophy',NULL,'App\\Models\\Trophy',2,1,2,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(26,'2000-08-25','Dünyanın En Büyüğü: Süper Kupa Zaferi (2000)','Avrupa zaferinin dünya sahnesindeki en güçlü teyidi.','moment',NULL,'App\\Models\\HistoryEvent',17,1,3,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(27,'2001-01-01','IFFHS Dünya Kulüpler Sıralaması 1.liği (2001)','Avrupa zaferlerinin istatistiksel ve küresel teyidi.','moment',NULL,'App\\Models\\HistoryEvent',18,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(28,'2001-04-03','Galatasaray 3 - 2 Real Madrid (3 Nisan 2001)','3 Nisan 2001 tarihinde Galatasaray, Şampiyonlar Ligi çeyrek final ilk maçında Real Madrid\'i 3-2 mağlup etti. Bu geri dönüş, sarı-kırmızılıların Avrupa\'daki dev katili kimliğinin en güçlü örneklerinden biridir.','match',NULL,'App\\Models\\HistoricalMatch',26,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(29,'2008-05-04','IWBF Şampiyonlar Kupası (Engelsiz Aslanlar)','Engelsiz Aslanlarin 2008, 2009, 2011, 2013 ve 2014te kazandigi Avrupa zirvesi.','trophy',NULL,'App\\Models\\Trophy',6,1,2,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(30,'2008-10-19','Kitakyushu Kupası Kıtalararası Şampiyonluğu','Engelsiz Aslanlarin Japonyada dort kez dunyanin en iyisi oldugunu tescilledigi kitalararasi zafer serisi.','trophy',NULL,'App\\Models\\Trophy',9,1,2,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(31,'2011-01-11','Ali Sami Yen Stadi\'na Veda (2011)','Bir donemin kapanisi.','moment',NULL,'App\\Models\\HistoryEvent',29,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(32,'2012-05-12','Fenerbahçe 0 - 0 Galatasaray (12 Mayıs 2012)','12 Mayıs 2012\'de oynanan ve Galatasaray\'ın Kadıköy\'de aldığı 0-0\'lık sonuçla şampiyonluğunu ilan ettiği tarihi karşılaşma. Skor tabelası golsüz kalsa da bu maç, psikolojik ağırlığı ve sonuç etkisi nedeniyle kulüp tarihinin en unutulmaz mücadelelerinden biridir.','match',NULL,'App\\Models\\HistoricalMatch',5,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(33,'2012-05-12','Kadıköy Şampiyonluğu (2011-2012)','12 Mayis 2012de rakip sahada kazanilan ve karanlikta kaldirilan unutulmaz sampiyonluk kupasi.','trophy',NULL,'App\\Models\\Trophy',7,1,2,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(34,'2012-05-12','Kadıköy’de Karanlıkta Gelen Kupa (2012)','Yakın dönem Galatasaray tarihinin en simgesel şampiyonluk anlarından biri.','moment',NULL,'App\\Models\\HistoryEvent',20,1,3,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(35,'2013-04-09','Galatasaray 3 - 2 Real Madrid (9 Nisan 2013)','9 Nisan 2013\'te Ali Sami Yen Spor Kompleksi\'nde oynanan ve Galatasaray\'ın Real Madrid\'i 3-2 mağlup ettiği tarihi karşılaşma. Her ne kadar toplam skor nedeniyle tur atlanamasa da, bu galibiyet Avrupa sahnesinde karakter ve direnç göstergesi olarak hafızalara kazınmıştır.','match',NULL,'App\\Models\\HistoricalMatch',6,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(36,'2013-06-15','Türkiye Basketbol Ligi Şampiyonluğu (2012-2013)','15 Haziran 2013te gelen ve 23 yillik hasreti bitiren basketbol ligi sampiyonlugu.','trophy',NULL,'App\\Models\\Trophy',8,1,2,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(37,'2013-12-11','Galatasaray 1 - 0 Juventus (11 Aralık 2013)','11 Aralık 2013\'te yoğun kar yağışı altında iki güne yayılan maçta Galatasaray, Juventus\'u 1-0 mağlup ederek Şampiyonlar Ligi\'nde son 16\'ya kaldı. Bu karşılaşma, zorlu koşullar altında alınmış en simgesel Avrupa zaferlerinden biri olarak hatırlanır.','match',NULL,'App\\Models\\HistoricalMatch',7,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(38,'2013-12-11','İstanbul\'un Beyaz Destanı: Kar Altında Juventus Zaferi (2013)','Şampiyonlar Ligi tarihimizin en atmosferik ve en simgesel galibiyetlerinden biri.','moment',NULL,'App\\Models\\HistoryEvent',21,1,3,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(39,'2014-04-13','EuroLeague Women Şampiyonluğu (2014)','13 Nisan 2014te kazanilan ve bir Turk kulubunun kadin basketboldaki en buyuk Avrupa zaferlerinden biri olan sampiyonluk.','trophy',NULL,'App\\Models\\Trophy',3,1,2,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(40,'2014-04-13','Sarayın Sultanları Avrupa\'nın Zirvesinde (2014)','Kulübün kadın basketboldaki en büyük Avrupa zaferi.','moment',NULL,'App\\Models\\HistoryEvent',22,1,3,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(41,'2015-05-25','Zirvenin Tek Hakimi: Dördüncü Yıldız ve 20. Şampiyonluk (2015)','Türk futbolunda yıldız yarışında tarihi üstünlüğün ilanı.','moment',NULL,'App\\Models\\HistoryEvent',23,1,1,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(42,'2016-04-27','EuroCup Şampiyonluğu (2016)','27 Nisan 2016da Abdi Ipekcide kazanilan erkek basketbol Avrupa sampiyonlugu.','trophy',NULL,'App\\Models\\Trophy',4,1,2,'2026-04-13 16:43:39','2026-04-13 16:43:39',0),(43,'2026-04-08','CEV Kupası Şampiyonluğu (2026)','8 Nisan 2026da Italyada gelen tarihi kadin voleybol Avrupa kupasi.','trophy',NULL,'App\\Models\\Trophy',5,1,2,'2026-04-13 16:43:39','2026-04-13 16:43:39',0);
/*!40000 ALTER TABLE `timeline_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timeline_entries_backup_before_import_20260413`
--

DROP TABLE IF EXISTS `timeline_entries_backup_before_import_20260413`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `timeline_entries_backup_before_import_20260413` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `timeline_date` date NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'moment',
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_id` bigint unsigned DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `position` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referenced_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci GENERATED ALWAYS AS ((case when ((`source_type` is not null) and (`source_id` is not null)) then concat(`source_type`,_utf8mb4'#',`source_id`,_utf8mb4'#',cast(`timeline_date` as date)) else NULL end)) STORED,
  `is_demo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `timeline_entries_referenced_unique` (`referenced_key`),
  KEY `timeline_entries_source_type_source_id_index` (`source_type`,`source_id`),
  KEY `timeline_entries_date_position_idx` (`timeline_date`,`position`),
  KEY `timeline_entries_type_visible_idx` (`type`,`is_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timeline_entries_backup_before_import_20260413`
--

LOCK TABLES `timeline_entries_backup_before_import_20260413` WRITE;
/*!40000 ALTER TABLE `timeline_entries_backup_before_import_20260413` DISABLE KEYS */;
/*!40000 ALTER TABLE `timeline_entries_backup_before_import_20260413` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trophies`
--

DROP TABLE IF EXISTS `trophies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trophies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trophy_scope` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_demo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `trophies_slug_unique` (`slug`),
  KEY `trophies_branch_index` (`branch`),
  KEY `trophies_trophy_scope_index` (`trophy_scope`),
  KEY `trophies_is_active_index` (`is_active`),
  KEY `trophies_sort_order_index` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trophies`
--

LOCK TABLES `trophies` WRITE;
/*!40000 ALTER TABLE `trophies` DISABLE KEYS */;
INSERT INTO `trophies` VALUES (1,'UEFA Kupası Şampiyonluğu (2000)','uefa-kupasi-sampiyonlugu-2000','futbol','uluslararasi','Türkiye’nin ilk ve tek namağlup Avrupa şampiyonluğu. 17 Mayıs 2000’de Arsenal’e karşı kazanılan tarihi zafer.','<p>17 Mayis 2000 tarihinde Kopenhag Parken Stadinda yazilan bu zafer, Turk spor tarihinin en buyuk kulup basarilarindan biridir. Galatasaray, Arsenal\'i penaltilarla yenerek UEFA Kupasini kazandi ve Avrupa Fatihi unvanini tum dunyaya namaglup sekilde tescil etti.</p><p>Sampiyonlar Ligi grubundaki Milan zaferiyle baslayan yolculukta Bologna, Borussia Dortmund, Mallorca ve Leeds United gibi rakipler saf disi birakildi. Finalde 120 dakikalik irade savasi ve penaltilarda gelen sogukkanli bitiris, bu kupayi Galatasaray tarihinin en buyuk kilometre taslarindan biri haline getirdi.</p><p>Bu basari, Turk futbolunun vizyonunu degistiren ve nesilden nesile aktarilacak bir imkansizin basarilma hikayesidir.</p>',1,1,'2026-04-13 13:39:52','2026-04-13 13:39:52',0),(2,'UEFA Süper Kupa Şampiyonluğu (2000)','uefa-super-kupa-sampiyonlugu-2000','futbol','uluslararasi','25 Ağustos 2000’de Monaco’da Real Madrid’in yenilmesiyle gelen Avrupa zirvesi.','<p>25 Agustos 2000 tarihinde Monaco\'da oynanan tarihi macta Galatasaray, Sampiyonlar Ligi sampiyonu Real Madrid\'i 2-1 maglup ederek UEFA Super Kupasini kazandi. Bu zafer, Galatasarayin sadece kupa kazanan degil, o donemde dunyanin en iyi takimlarindan biri oldugunu da gosteren zirve noktalarindan biridir.</p><p>Mircea Lucescu yonetimindeki takim, Mario Jardelin golleri ve taktik disiplinle Avrupa futbol hiyerarsisini sarsmis, ayni yil icinde iki buyuk Avrupa kupasini da muzeye goturmustur.</p><p>Bu kupa, Turk futbolunun dunyanin buyuklerini devirerek zirveye cikabilecegini gosteren en guclu belgelerden biridir.</p>',1,2,'2026-04-13 13:39:52','2026-04-13 13:39:52',0),(3,'EuroLeague Women Şampiyonluğu (2014)','euroleague-women-sampiyonlugu-2014','basketbol','uluslararasi','13 Nisan 2014’te kazanılan ve bir Türk kulübünün kadın basketboldaki en büyük Avrupa zaferlerinden biri olan şampiyonluk.','<p>Galatasaray Kadin Basketbol Takimi, 13 Nisan 2014te Rusyada oynanan finalde rakibini yenerek EuroLeague Women kupasini muzeye goturen ilk Turk kulubu oldu. Sarayin Sultanlari bu zaferle Avrupa kadin basketbolunun zirvesine cikti.</p><p>Ekrem Memnun yonetiminde, Alba Torrens ve takim arkadaslarinin liderligiyle gelen bu sampiyonluk ayni sezon icindeki diger basarilarla birlikte tarihi bir uclemeyi de temsil etti.</p><p>Bu kupa, Galatasarayin Avrupa Fatihi kimliginin sadece futbolla sinirli olmadigini gosteren en guclu basketbol kanitidir.</p>',1,3,'2026-04-13 13:39:52','2026-04-13 13:39:52',0),(4,'EuroCup Şampiyonluğu (2016)','eurocup-sampiyonlugu-2016','basketbol','uluslararasi','27 Nisan 2016’da Abdi İpekçi’de kazanılan erkek basketbol Avrupa şampiyonluğu.','<p>Galatasaray erkek basketbol takimi, 27 Nisan 2016 tarihinde Strasbourg karsisinda oynanan final rovansinda tarihi bir zafere imza atarak EuroCup sampiyonu oldu. Abdi Ipekci Arena o gece Kupa Bizim sloganinin gercege donustugu bir mabede donustu.</p><p>Ergin Ataman yonetimindeki takim, Stephane Lasme, Errick McCollum ve arkadaslarinin buyuk performanslariyla kulup tarihinin en buyuk erkek basketbol Avrupa kupasini kazandi.</p><p>Bu sampiyonluk, Galatasarayin basketbolda da Avrupa kupasi kaldirabilen bir kulup oldugunu kalici bicimde tescilledi.</p>',1,4,'2026-04-13 13:39:52','2026-04-13 13:39:52',0),(5,'CEV Kupası Şampiyonluğu (2026)','cev-kupasi-sampiyonlugu-2026','voleybol','uluslararasi','8 Nisan 2026’da İtalya’da gelen tarihi kadın voleybol Avrupa kupası.','<p>Galatasaray Daikin Kadin Voleybol Takimi, 8 Nisan 2026 tarihinde Italya\'nin Chieri kentinde oynanan final rovansinda rakibini 3-1 maglup ederek tarihinde ilk kez CEV Kupasini kazandi.</p><p>Bu zafer, Sarayin Sultanlarinin voleybolda Avrupa zirvesine cikis hikayesini yazdi ve Galatasarayin her bransda uluslararasi iddia tasiyan bir kulup oldugunu bir kez daha kanitladi.</p><p>Kupa, futbol ve basketboldaki Avrupa basarilarinin yanina eklenen yeni bir uluslararasi gurur halkasi oldu.</p>',1,5,'2026-04-13 13:39:52','2026-04-13 13:39:52',0),(6,'IWBF Şampiyonlar Kupası (Engelsiz Aslanlar)','iwbf-sampiyonlar-kupasi-engelsiz-aslanlar','basketbol','uluslararasi','Engelsiz Aslanların 2008, 2009, 2011, 2013 ve 2014’te kazandığı Avrupa zirvesi.','<p>Galatasaray Tekerlekli Sandalye Basketbol Takimi, Engelsiz Aslanlar kimligiyle IWBF Sampiyonlar Kupasini tam bes kez kazanarak bransta dunyanin en prestijli ekiplerinden biri haline geldi.</p><p>2008, 2009, 2011, 2013 ve 2014 yillarindaki bu kupalar, sadece sportif basari degil; azim, irade ve Galatasaray armasinin engelsiz gucunun sembolu haline geldi.</p><p>Bu seri, kulubun kapsayici ve cok bransli buyukluk iddiasinin en etkileyici basliklarindan biridir.</p>',1,6,'2026-04-13 13:39:52','2026-04-13 13:39:52',0),(7,'Kadıköy Şampiyonluğu (2011-2012)','kadikoy-sampiyonlugu-2011-2012','futbol','ulusal','12 Mayıs 2012’de rakip sahada kazanılan ve karanlıkta kaldırılan unutulmaz şampiyonluk kupası.','<p>12 Mayis 2012 tarihinde Galatasaray, ezeli rakibinin sahasinda oynanan son mac sonunda sampiyonlugunu ilan etti. Supper Final duzeni icinde gelen bu sonuc, sezonun en gerilimli gecesini Galatasaray tarihinin en karakterli zaferlerinden birine donusturdu.</p><p>Mac sonrasi yasanan karanlik kupa toreni, kupanin manevi degerini daha da buyuttu. Selcuk Inan ve Tomas Ujfalusinin ellerinde yukselen bu kupa, her turlu zorlugu asan Galatasaray karakterinin simgesidir.</p><p>Bu basari yalnizca bir lig sampiyonlugu degil, rakip sahada geri adim atmayan Galatasaray durusunun anitsal bir sahnesidir.</p>',1,7,'2026-04-13 13:39:52','2026-04-13 13:39:52',0),(8,'Türkiye Basketbol Ligi Şampiyonluğu (2012-2013)','turkiye-basketbol-ligi-sampiyonlugu-2012-2013','basketbol','ulusal','15 Haziran 2013’te gelen ve 23 yıllık hasreti bitiren basketbol ligi şampiyonluğu.','<p>Galatasaray erkek basketbol takimi, 15 Haziran 2013te Banviti final serisinde yenerek 23 yillik lig sampiyonlugu hasretine son verdi. Bu zafer, Yenilmez Armada ruhunun modern cagdaki geri donusunu temsil etti.</p><p>Ergin Ataman yonetiminde gelen bu basari, sonraki Avrupa basarilarinin da temelini atan bir yeniden dogus hikayesiydi.</p><p>Hasretin bitisi, kupanin sportif degerinin otesinde duygusal ve tarihsel bir agirlik kazanmasini sagladi.</p>',1,8,'2026-04-13 13:39:52','2026-04-13 13:39:52',0),(9,'Kitakyushu Kupası Kıtalararası Şampiyonluğu','kitakyushu-kupasi-kitalararasi-sampiyonluk','basketbol','uluslararasi','Engelsiz Aslanların Japonya’da dört kez dünyanın en iyisi olduğunu tescillediği kıtalararası zafer serisi.','<p>Galatasaray Tekerlekli Sandalye Basketbol Takimi, Kitakyushu Kupasini 2008, 2009, 2011 ve 2013 yillarinda kazanarak dunyanin en iyi takimi oldugunu Uzak Doguda da ilan etti.</p><p>Bu kupalar, Avrupa sampiyonluklarini dunyanin geri kalanina karsi da dogrulayan bir kuresel dominasyon anlatisi kurdu. Galatasaray markasi Japonyada centilmenlik, disiplin ve ust duzey performansla anildi.</p><p>Kitakyushu serisi, Engelsiz Aslanlarin sadece Avrupa degil dunya sahnesindeki buyuklugunu gosteren en guclu basarilardan biridir.</p>',1,9,'2026-04-13 13:39:52','2026-04-13 13:39:52',0);
/*!40000 ALTER TABLE `trophies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trophies_backup_before_reset_20260413`
--

DROP TABLE IF EXISTS `trophies_backup_before_reset_20260413`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trophies_backup_before_reset_20260413` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trophy_scope` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_demo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `trophies_slug_unique` (`slug`),
  KEY `trophies_branch_index` (`branch`),
  KEY `trophies_trophy_scope_index` (`trophy_scope`),
  KEY `trophies_is_active_index` (`is_active`),
  KEY `trophies_sort_order_index` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trophies_backup_before_reset_20260413`
--

LOCK TABLES `trophies_backup_before_reset_20260413` WRITE;
/*!40000 ALTER TABLE `trophies_backup_before_reset_20260413` DISABLE KEYS */;
INSERT INTO `trophies_backup_before_reset_20260413` VALUES (1,'Süper Lig','super-lig','futbol','ulusal','Süper Lig için demo referans kaydı.','Süper Lig için demo referans içeriği.',0,1,'2026-03-23 19:56:54','2026-03-30 09:53:30',1),(2,'Türkiye Kupası','turkiye-kupasi','futbol','ulusal','Türkiye Kupası için demo referans kaydı.','<p>Türkiye Kupası için demo referans içeriği...</p>',0,2,'2026-03-23 19:56:54','2026-03-30 17:51:20',1),(3,'UEFA Kupası','uefa-kupasi','futbol','uluslararasi','UEFA Kupası için demo referans kaydı.','<p>GALATASARAYIN TARIHI UEFA KUPASI ZAFERI KOPENHAG DESTANI</p><p>Turk spor tarihinin en parlak sayfalarindan biri 17 Mayis 2000 gecesi Danimarkanin Kopenhag sehrinde yazildi. Fatih Terim yonetimindeki Galatasaray, Avrupa futbolunun en buyuk organizasyonlarindan biri olan UEFA Kupasi finalinde Ingiliz devi Arsenali devirerek kupayi muzesine goturmeyi basardi. Bu zafer, Turk futbol tarihinde bir kulup takiminin kazandigi ilk Avrupa kupasi olarak kayitlara gecti.</p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/png&quot;,&quot;filename&quot;:&quot;terim34.png&quot;,&quot;filesize&quot;:705382,&quot;height&quot;:851,&quot;href&quot;:&quot;http://localhost:8080/storage/editor-content/UuagQJPl2gbX7HwCueueDImY2GYOwzrKz01min0M.png&quot;,&quot;url&quot;:&quot;http://localhost:8080/storage/editor-content/UuagQJPl2gbX7HwCueueDImY2GYOwzrKz01min0M.png&quot;,&quot;width&quot;:401}\" data-trix-content-type=\"image/png\" data-trix-attributes=\"{&quot;caption&quot;:&quot;Fatih Terim&quot;,&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--png\"><a href=\"http://localhost:8080/storage/editor-content/UuagQJPl2gbX7HwCueueDImY2GYOwzrKz01min0M.png\"><img src=\"http://localhost:8080/storage/editor-content/UuagQJPl2gbX7HwCueueDImY2GYOwzrKz01min0M.png\" width=\"401\" height=\"851\"><figcaption class=\"attachment__caption attachment__caption--edited\">Fatih Terim</figcaption></a></figure>SAMPIYONLAR LIGINDEN GELEN ZAFER</p><p>Galatasarayin 1999-2000 sezonundaki Avrupa yolculugu aslinda Sampiyonlar Liginde baslamisti. Milan karsisinda alinan epik 3-2lik galibiyetle grubunu ucuncu sirada tamamlayan sari kirmizililar, yoluna UEFA Kupasinda devam etme hakki kazandi. Kimse bu yolun sonunun sampiyonluk olacagini tahmin etmiyordu ancak Fatih Terim ve ogrencileri her turda rakiplerini tek tek saf disi birakarak finale kadar yukseldi.</p><p>FINALE GIDEN YOLDA DEVLERI DEVIRDI</p><p>Galatasaray finale gelene kadar Avrupa futbolunun onemli ekiplerini eledi. Sirasiyla Bologna, Borussia Dortmund, Real Mallorca ve son olarak Leeds Unitedi eleyen temsilcimiz, finalde Dunya yildizlariyla dolu Arsenalin rakibi oldu. Kadrosunda Thierry Henry, Dennis Bergkamp ve Patrick Vieira gibi isimleri barindiran Arsenal karsisinda Galatasaray; Taffarel, Popescu, Bulent Korkmaz, Hagi ve Hakan Sukur gibi efsane isimleriyle sahadaydi.</p><p>120 DAKIKALIK SINIR HARBI</p><p>Kopenhagdaki Parken Stadinda oynanan final macinin normal suresi ve uzatma bolumleri 0-0 esitlikle sona erdi. Macin en kritik anlarindan biri, takimin beyni Gheorghe Haginin kirmizi kart gorerek oyun disi kalmasiydi. 10 kisi kalan Galatasaray, kalesinde devlesen Claudio Taffarelin inanilmaz kurtarislariyla maci penaltilara tasimayi basardi.</p><p>POPESCUNUN SON VURUSU VE GELEN KUPA</p><p>Penalti atislarinda Galatasaray hata yapmadi. Ergun Penbe, Hakan Sukur ve Umit Davala topu aglarla bulustururken, Arsenalli oyuncular Suker ve Vieiranin vuruslari direkten dondu. Son penalti icin topun basina gecen Rumen savunmaci Gheorghe Popescu, sogukkanli bir vurusla David Seamani maglup etti. Bu golle Galatasaray, UEFA Kupasini kazanan ilk ve tek Turk takimi unvanini alarak milyonlari sokaga doktu.</p><p>Karsilasma sonrasi yasanan buyuk sevinç, sadece Kopenhagda degil tum Turkiyede kutlandi. Bu basari ayni yil icerisinde Real Madridi devirerek kazanilacak olan UEFA Super Kupasinin da habercisi oldu.</p>',0,3,'2026-03-23 19:56:54','2026-03-29 15:53:04',1),(4,'UEFA Süper Kupa','uefa-super-kupa','futbol','uluslararasi','UEFA Süper Kupa için demo referans kaydı.','UEFA Süper Kupa için demo referans içeriği.',0,4,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(5,'EuroLeague Women','euroleague-women','basketbol','uluslararasi','EuroLeague Women için demo referans kaydı.','EuroLeague Women için demo referans içeriği.',0,5,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(6,'Türkiye Basketbol Şampiyonluğu','turkiye-basketbol-sampiyonlugu','basketbol','ulusal','Türkiye Basketbol Şampiyonluğu için demo referans kaydı.','Türkiye Basketbol Şampiyonluğu için demo referans içeriği.',0,6,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(7,'Avrupa Kupası Finali','avrupa-kupasi-finali','basketbol','uluslararasi','Avrupa Kupası Finali için demo referans kaydı.','Avrupa Kupası Finali için demo referans içeriği.',0,7,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(8,'Tekerlekli Sandalye Basketbol Avrupa Kupası','tsb-avrupa-kupasi','basketbol','uluslararasi','Tekerlekli Sandalye Basketbol Avrupa Kupası için demo referans kaydı.','Tekerlekli Sandalye Basketbol Avrupa Kupası için demo referans içeriği.',0,8,'2026-03-23 19:56:54','2026-03-23 19:56:54',1);
/*!40000 ALTER TABLE `trophies_backup_before_reset_20260413` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `is_super_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `can_write` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rank` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nev_zuhur',
  `cp_score` int unsigned NOT NULL DEFAULT '0',
  `avatar_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_rank_index` (`rank`),
  KEY `users_cp_score_index` (`cp_score`),
  KEY `users_last_login_at_index` (`last_login_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@cadde1905.test','admin',1,1,1,NULL,'$2y$12$8llOlYyrlvys2jjxJdY.SuMSrIZytSKclNZnzz2.wCZKsncLfogI2',NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54','nev_zuhur',0,NULL,NULL),(2,'Editor','editor@cadde1905.test','editor',0,1,1,NULL,'$2y$12$HFLqk/8ul2knpJyK6Xup4OWT5twfH0RFe777ZrR4yP/wfAb/toPQS',NULL,'2026-03-23 19:56:54','2026-03-31 11:35:51','nev_zuhur',0,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget_overrides`
--

DROP TABLE IF EXISTS `widget_overrides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `widget_overrides` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `widget_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_enabled` tinyint(1) DEFAULT NULL,
  `priority_override` int DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `widget_overrides_widget_key_unique` (`widget_key`),
  KEY `widget_overrides_updated_by_foreign` (`updated_by`),
  CONSTRAINT `widget_overrides_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widget_overrides`
--

LOCK TABLES `widget_overrides` WRITE;
/*!40000 ALTER TABLE `widget_overrides` DISABLE KEYS */;
/*!40000 ALTER TABLE `widget_overrides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_cup_content_relations`
--

DROP TABLE IF EXISTS `world_cup_content_relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `world_cup_content_relations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` bigint unsigned NOT NULL,
  `related_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `related_id` bigint unsigned NOT NULL,
  `relation_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `world_cup_content_relations_tournament_id_foreign` (`tournament_id`),
  KEY `world_cup_content_relations_related_type_related_id_index` (`related_type`,`related_id`),
  KEY `world_cup_content_relations_is_featured_index` (`is_featured`),
  KEY `world_cup_content_relations_is_visible_index` (`is_visible`),
  KEY `world_cup_content_relations_sort_order_index` (`sort_order`),
  CONSTRAINT `world_cup_content_relations_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `world_cup_tournaments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_cup_content_relations`
--

LOCK TABLES `world_cup_content_relations` WRITE;
/*!40000 ALTER TABLE `world_cup_content_relations` DISABLE KEYS */;
/*!40000 ALTER TABLE `world_cup_content_relations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_cup_group_standings`
--

DROP TABLE IF EXISTS `world_cup_group_standings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `world_cup_group_standings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` bigint unsigned NOT NULL,
  `group_id` bigint unsigned NOT NULL,
  `team_id` bigint unsigned NOT NULL,
  `played` int NOT NULL DEFAULT '0',
  `won` int NOT NULL DEFAULT '0',
  `drawn` int NOT NULL DEFAULT '0',
  `lost` int NOT NULL DEFAULT '0',
  `goals_for` int NOT NULL DEFAULT '0',
  `goals_against` int NOT NULL DEFAULT '0',
  `goal_difference` int NOT NULL DEFAULT '0',
  `points` int NOT NULL DEFAULT '0',
  `position` int NOT NULL DEFAULT '0',
  `qualified_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility_override` tinyint(1) DEFAULT NULL,
  `snapshot_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `world_cup_group_standings_tournament_id_group_id_team_id_unique` (`tournament_id`,`group_id`,`team_id`),
  KEY `world_cup_group_standings_group_id_foreign` (`group_id`),
  KEY `world_cup_group_standings_team_id_foreign` (`team_id`),
  KEY `world_cup_group_standings_points_index` (`points`),
  KEY `world_cup_group_standings_position_index` (`position`),
  CONSTRAINT `world_cup_group_standings_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `world_cup_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `world_cup_group_standings_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `world_cup_teams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `world_cup_group_standings_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `world_cup_tournaments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_cup_group_standings`
--

LOCK TABLES `world_cup_group_standings` WRITE;
/*!40000 ALTER TABLE `world_cup_group_standings` DISABLE KEYS */;
INSERT INTO `world_cup_group_standings` VALUES (51,4,11,109,0,0,0,0,0,0,0,0,1,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(52,4,11,98,0,0,0,0,0,0,0,0,2,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(53,4,11,119,0,0,0,0,0,0,0,0,3,'Ranking of third-placed teams',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(54,4,11,99,0,0,0,0,0,0,0,0,4,NULL,NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(55,4,12,97,0,0,0,0,0,0,0,0,1,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(56,4,12,114,0,0,0,0,0,0,0,0,2,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(57,4,12,131,0,0,0,0,0,0,0,0,3,'Ranking of third-placed teams',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(58,4,12,125,0,0,0,0,0,0,0,0,4,NULL,NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(59,4,13,113,0,0,0,0,0,0,0,0,1,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(60,4,13,89,0,0,0,0,0,0,0,0,2,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(61,4,13,129,0,0,0,0,0,0,0,0,3,'Ranking of third-placed teams',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(62,4,13,107,0,0,0,0,0,0,0,0,4,NULL,NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(63,4,14,111,0,0,0,0,0,0,0,0,1,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(64,4,14,126,0,0,0,0,0,0,0,0,2,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(65,4,14,128,0,0,0,0,0,0,0,0,3,'Ranking of third-placed teams',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(66,4,14,100,0,0,0,0,0,0,0,0,4,NULL,NULL,'2026-04-12 10:34:49','2026-04-03 14:41:51','2026-04-12 10:34:49'),(67,4,15,103,0,0,0,0,0,0,0,0,1,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:52','2026-04-12 10:34:49'),(68,4,15,127,0,0,0,0,0,0,0,0,2,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:52','2026-04-12 10:34:49'),(69,4,15,116,0,0,0,0,0,0,0,0,3,'Ranking of third-placed teams',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:52','2026-04-12 10:34:49'),(70,4,15,132,0,0,0,0,0,0,0,0,4,NULL,NULL,'2026-04-12 10:34:49','2026-04-03 14:41:52','2026-04-12 10:34:49'),(71,4,16,88,0,0,0,0,0,0,0,0,1,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:52','2026-04-12 10:34:49'),(72,4,16,115,0,0,0,0,0,0,0,0,2,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:52','2026-04-12 10:34:49'),(73,4,16,106,0,0,0,0,0,0,0,0,3,'Ranking of third-placed teams',NULL,'2026-04-12 10:34:49','2026-04-03 14:41:52','2026-04-12 10:34:49'),(74,4,16,95,0,0,0,0,0,0,0,0,4,NULL,NULL,'2026-04-12 10:34:49','2026-04-03 14:41:52','2026-04-12 10:34:49'),(75,4,17,85,0,0,0,0,0,0,0,0,1,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(76,4,17,108,0,0,0,0,0,0,0,0,2,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(77,4,17,101,0,0,0,0,0,0,0,0,3,'Ranking of third-placed teams',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(78,4,17,130,0,0,0,0,0,0,0,0,4,NULL,NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(79,4,18,92,0,0,0,0,0,0,0,0,1,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(80,4,18,90,0,0,0,0,0,0,0,0,2,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(81,4,18,121,0,0,0,0,0,0,0,0,3,'Ranking of third-placed teams',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(82,4,18,102,0,0,0,0,0,0,0,0,4,NULL,NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(83,4,19,86,0,0,0,0,0,0,0,0,1,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(84,4,19,112,0,0,0,0,0,0,0,0,2,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(85,4,19,96,0,0,0,0,0,0,0,0,3,'Ranking of third-placed teams',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(86,4,19,123,0,0,0,0,0,0,0,0,4,NULL,NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(87,4,20,110,0,0,0,0,0,0,0,0,1,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(88,4,20,104,0,0,0,0,0,0,0,0,2,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(89,4,20,120,0,0,0,0,0,0,0,0,3,'Ranking of third-placed teams',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(90,4,20,122,0,0,0,0,0,0,0,0,4,NULL,NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(91,4,21,105,0,0,0,0,0,0,0,0,1,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(92,4,21,91,0,0,0,0,0,0,0,0,2,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(93,4,21,118,0,0,0,0,0,0,0,0,3,'Ranking of third-placed teams',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(94,4,21,124,0,0,0,0,0,0,0,0,4,NULL,NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(95,4,22,87,0,0,0,0,0,0,0,0,1,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(96,4,22,93,0,0,0,0,0,0,0,0,2,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(97,4,22,117,0,0,0,0,0,0,0,0,3,'Ranking of third-placed teams',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(98,4,22,94,0,0,0,0,0,0,0,0,4,NULL,NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(99,4,23,128,0,0,0,0,0,0,0,0,1,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(100,4,23,131,0,0,0,0,0,0,0,0,2,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(101,4,23,129,0,0,0,0,0,0,0,0,3,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(102,4,23,120,0,0,0,0,0,0,0,0,4,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(103,4,23,96,0,0,0,0,0,0,0,0,5,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(104,4,23,117,0,0,0,0,0,0,0,0,6,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(105,4,23,119,0,0,0,0,0,0,0,0,7,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(106,4,23,121,0,0,0,0,0,0,0,0,8,'Promotion - World Cup (Play Offs)',NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(107,4,23,106,0,0,0,0,0,0,0,0,9,NULL,NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(108,4,23,116,0,0,0,0,0,0,0,0,10,NULL,NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(109,4,23,118,0,0,0,0,0,0,0,0,11,NULL,NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50'),(110,4,23,101,0,0,0,0,0,0,0,0,12,NULL,NULL,'2026-04-12 10:34:50','2026-04-03 14:41:52','2026-04-12 10:34:50');
/*!40000 ALTER TABLE `world_cup_group_standings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_cup_groups`
--

DROP TABLE IF EXISTS `world_cup_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `world_cup_groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` bigint unsigned NOT NULL,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `title_override` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `world_cup_groups_tournament_id_code_unique` (`tournament_id`,`code`),
  KEY `world_cup_groups_external_id_index` (`external_id`),
  KEY `world_cup_groups_is_visible_index` (`is_visible`),
  CONSTRAINT `world_cup_groups_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `world_cup_tournaments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_cup_groups`
--

LOCK TABLES `world_cup_groups` WRITE;
/*!40000 ALTER TABLE `world_cup_groups` DISABLE KEYS */;
INSERT INTO `world_cup_groups` VALUES (11,4,'1_2026_A','A','Group A',NULL,0,NULL,1,'2026-04-03 14:41:51','2026-04-03 14:41:51'),(12,4,'1_2026_B','B','Group B',NULL,0,NULL,1,'2026-04-03 14:41:51','2026-04-03 14:41:51'),(13,4,'1_2026_C','C','Group C',NULL,0,NULL,1,'2026-04-03 14:41:51','2026-04-03 14:41:51'),(14,4,'1_2026_D','D','Group D',NULL,0,NULL,1,'2026-04-03 14:41:51','2026-04-03 14:41:51'),(15,4,'1_2026_E','E','Group E',NULL,0,NULL,1,'2026-04-03 14:41:51','2026-04-03 14:41:51'),(16,4,'1_2026_F','F','Group F',NULL,0,NULL,1,'2026-04-03 14:41:52','2026-04-03 14:41:52'),(17,4,'1_2026_G','G','Group G',NULL,0,NULL,1,'2026-04-03 14:41:52','2026-04-03 14:41:52'),(18,4,'1_2026_H','H','Group H',NULL,0,NULL,1,'2026-04-03 14:41:52','2026-04-03 14:41:52'),(19,4,'1_2026_I','I','Group I',NULL,0,NULL,1,'2026-04-03 14:41:52','2026-04-03 14:41:52'),(20,4,'1_2026_J','J','Group J',NULL,0,NULL,1,'2026-04-03 14:41:52','2026-04-03 14:41:52'),(21,4,'1_2026_K','K','Group K',NULL,0,NULL,1,'2026-04-03 14:41:52','2026-04-03 14:41:52'),(22,4,'1_2026_L','L','Group L',NULL,0,NULL,1,'2026-04-03 14:41:52','2026-04-03 14:41:52'),(23,4,'1_2026_Ranking of third-placed teams','Ranking of third-placed teams','Ranking of third-placed teams',NULL,0,NULL,1,'2026-04-03 14:41:52','2026-04-03 14:41:52');
/*!40000 ALTER TABLE `world_cup_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_cup_match_stadium_map`
--

DROP TABLE IF EXISTS `world_cup_match_stadium_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `world_cup_match_stadium_map` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` bigint unsigned NOT NULL,
  `slot_number` int NOT NULL,
  `stadium_id` bigint unsigned NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `world_cup_match_stadium_map_tournament_id_slot_number_unique` (`tournament_id`,`slot_number`),
  KEY `world_cup_match_stadium_map_stadium_id_foreign` (`stadium_id`),
  CONSTRAINT `world_cup_match_stadium_map_stadium_id_foreign` FOREIGN KEY (`stadium_id`) REFERENCES `world_cup_stadiums` (`id`) ON DELETE CASCADE,
  CONSTRAINT `world_cup_match_stadium_map_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `world_cup_tournaments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_cup_match_stadium_map`
--

LOCK TABLES `world_cup_match_stadium_map` WRITE;
/*!40000 ALTER TABLE `world_cup_match_stadium_map` DISABLE KEYS */;
INSERT INTO `world_cup_match_stadium_map` VALUES (1,4,104,32,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(2,4,103,40,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(3,4,102,38,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(4,4,101,42,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(5,4,100,40,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(6,4,99,41,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(7,4,98,31,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(8,4,97,33,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(9,4,96,38,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(10,4,95,32,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(11,4,94,36,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(12,4,93,42,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(13,4,92,35,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(14,4,91,28,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(15,4,90,34,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(16,4,89,39,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(17,4,88,29,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(18,4,87,40,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(19,4,86,41,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(20,4,85,38,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(21,4,84,34,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(22,4,83,39,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(23,4,82,28,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(24,4,81,42,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(25,4,80,35,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(26,4,79,36,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(27,4,78,32,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(28,4,77,30,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(29,4,76,33,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(30,4,75,43,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(31,4,74,31,'canonical_2026_knockout',1,'2026-04-07 16:07:25','2026-04-07 16:07:25'),(32,4,73,37,'canonical_2026_knockout',1,'2026-04-07 16:07:26','2026-04-07 16:07:26');
/*!40000 ALTER TABLE `world_cup_match_stadium_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_cup_matches`
--

DROP TABLE IF EXISTS `world_cup_matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `world_cup_matches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` bigint unsigned NOT NULL,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `round_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_number` int DEFAULT NULL,
  `slot_number` int DEFAULT NULL,
  `home_team_id` bigint unsigned NOT NULL,
  `away_team_id` bigint unsigned NOT NULL,
  `stadium_id` bigint unsigned DEFAULT NULL,
  `stadium_mapping_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stadium_mapping_source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `winner_team_id` bigint unsigned DEFAULT NULL,
  `kickoff_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_score` int DEFAULT NULL,
  `away_score` int DEFAULT NULL,
  `home_penalty_score` int DEFAULT NULL,
  `away_penalty_score` int DEFAULT NULL,
  `referee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendance` int DEFAULT NULL,
  `summary_api` text COLLATE utf8mb4_unicode_ci,
  `editor_note` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `featured_lock` tinyint(1) NOT NULL DEFAULT '0',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `venue_name_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_city_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_external_id_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `world_cup_matches_tournament_id_foreign` (`tournament_id`),
  KEY `world_cup_matches_home_team_id_foreign` (`home_team_id`),
  KEY `world_cup_matches_away_team_id_foreign` (`away_team_id`),
  KEY `world_cup_matches_stadium_id_foreign` (`stadium_id`),
  KEY `world_cup_matches_winner_team_id_foreign` (`winner_team_id`),
  KEY `world_cup_matches_external_id_index` (`external_id`),
  KEY `world_cup_matches_stage_index` (`stage`),
  KEY `world_cup_matches_kickoff_at_index` (`kickoff_at`),
  KEY `world_cup_matches_status_index` (`status`),
  KEY `world_cup_matches_is_featured_index` (`is_featured`),
  KEY `world_cup_matches_is_visible_index` (`is_visible`),
  CONSTRAINT `world_cup_matches_away_team_id_foreign` FOREIGN KEY (`away_team_id`) REFERENCES `world_cup_teams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `world_cup_matches_home_team_id_foreign` FOREIGN KEY (`home_team_id`) REFERENCES `world_cup_teams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `world_cup_matches_stadium_id_foreign` FOREIGN KEY (`stadium_id`) REFERENCES `world_cup_stadiums` (`id`) ON DELETE SET NULL,
  CONSTRAINT `world_cup_matches_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `world_cup_tournaments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `world_cup_matches_winner_team_id_foreign` FOREIGN KEY (`winner_team_id`) REFERENCES `world_cup_teams` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=507 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_cup_matches`
--

LOCK TABLES `world_cup_matches` WRITE;
/*!40000 ALTER TABLE `world_cup_matches` DISABLE KEYS */;
INSERT INTO `world_cup_matches` VALUES (435,4,'1489369','Group Stage - 1','Group Stage - 1',1489369,1,98,119,28,NULL,NULL,NULL,'2026-06-11 19:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Estadio Azteca','Mexico City',NULL),(436,4,'1538999','Group Stage - 1','Group Stage - 1',1538999,2,99,109,29,NULL,NULL,NULL,'2026-06-12 02:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Estadio Akron','Zapopan',NULL),(437,4,'1539000','Group Stage - 1','Group Stage - 1',1539000,3,131,114,30,NULL,NULL,NULL,'2026-06-12 19:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','BMO Field',NULL,NULL),(438,4,'1489370','Group Stage - 1','Group Stage - 1',1489370,4,128,126,31,NULL,NULL,NULL,'2026-06-13 01:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','SoFi Stadium',NULL,NULL),(439,4,'1489373','Group Stage - 1','Group Stage - 1',1489373,5,125,97,NULL,NULL,NULL,NULL,'2026-06-13 19:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48',NULL,NULL,NULL),(440,4,'1489371','Group Stage - 1','Group Stage - 1',1489371,6,89,107,32,NULL,NULL,NULL,'2026-06-13 22:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','MetLife Stadium',NULL,NULL),(441,4,'1489372','Group Stage - 1','Group Stage - 1',1489372,7,129,113,33,NULL,NULL,NULL,'2026-06-14 01:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Gillette Stadium',NULL,NULL),(442,4,'1539001','Group Stage - 1','Group Stage - 1',1539001,8,100,111,34,NULL,NULL,NULL,'2026-06-14 04:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','BC Place',NULL,NULL),(443,4,'1489374','Group Stage - 1','Group Stage - 1',1489374,9,103,132,35,NULL,NULL,NULL,'2026-06-14 17:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','NRG Stadium',NULL,NULL),(444,4,'1489376','Group Stage - 1','Group Stage - 1',1489376,10,115,95,NULL,NULL,NULL,NULL,'2026-06-14 20:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48',NULL,NULL,NULL),(445,4,'1489375','Group Stage - 1','Group Stage - 1',1489375,11,116,127,36,NULL,NULL,NULL,'2026-06-14 23:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Lincoln Financial Field',NULL,NULL),(446,4,'1539002','Group Stage - 1','Group Stage - 1',1539002,12,88,106,37,NULL,NULL,NULL,'2026-06-15 02:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Estadio BBVA','Monterrey',NULL),(447,4,'1489380','Group Stage - 1','Group Stage - 1',1489380,13,92,121,38,NULL,NULL,NULL,'2026-06-15 16:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Mercedes-Benz Stadium',NULL,NULL),(448,4,'1489377','Group Stage - 1','Group Stage - 1',1489377,14,85,108,39,NULL,NULL,NULL,'2026-06-15 19:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Lumen Field',NULL,NULL),(449,4,'1489379','Group Stage - 1','Group Stage - 1',1489379,15,102,90,40,NULL,NULL,NULL,'2026-06-15 22:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Hard Rock Stadium',NULL,NULL),(450,4,'1489378','Group Stage - 1','Group Stage - 1',1489378,16,101,130,31,NULL,NULL,NULL,'2026-06-16 01:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','SoFi Stadium',NULL,NULL),(451,4,'1489382','Group Stage - 1','Group Stage - 1',1489382,17,110,122,NULL,NULL,NULL,NULL,'2026-06-17 04:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48',NULL,NULL,NULL),(452,4,'1489383','Group Stage - 1','Group Stage - 1',1489383,18,86,96,32,NULL,NULL,NULL,'2026-06-16 19:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','MetLife Stadium',NULL,NULL),(453,4,'1539016','Group Stage - 1','Group Stage - 1',1539016,19,123,112,33,NULL,NULL,NULL,'2026-06-16 22:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Gillette Stadium',NULL,NULL),(454,4,'1489381','Group Stage - 1','Group Stage - 1',1489381,20,104,120,41,NULL,NULL,NULL,'2026-06-17 01:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Arrowhead Stadium',NULL,NULL),(455,4,'1539003','Group Stage - 1','Group Stage - 1',1539003,21,105,118,35,NULL,NULL,NULL,'2026-06-17 17:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','NRG Stadium',NULL,NULL),(456,4,'1489384','Group Stage - 1','Group Stage - 1',1489384,22,93,87,NULL,NULL,NULL,NULL,'2026-06-17 20:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48',NULL,NULL,NULL),(457,4,'1489385','Group Stage - 1','Group Stage - 1',1489385,23,117,94,30,NULL,NULL,NULL,'2026-06-17 23:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','BMO Field',NULL,NULL),(458,4,'1489386','Group Stage - 1','Group Stage - 1',1489386,24,124,91,28,NULL,NULL,NULL,'2026-06-18 02:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Estadio Azteca','Mexico City',NULL),(459,4,'1539004','Group Stage - 2','Group Stage - 2',1539004,25,109,119,38,NULL,NULL,NULL,'2026-06-18 16:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Mercedes-Benz Stadium',NULL,NULL),(460,4,'1539005','Group Stage - 2','Group Stage - 2',1539005,26,97,114,31,NULL,NULL,NULL,'2026-06-18 19:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','SoFi Stadium',NULL,NULL),(461,4,'1489387','Group Stage - 2','Group Stage - 2',1489387,27,131,125,34,NULL,NULL,NULL,'2026-06-18 22:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','BC Place',NULL,NULL),(462,4,'1489388','Group Stage - 2','Group Stage - 2',1489388,28,98,99,29,NULL,NULL,NULL,'2026-06-19 01:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Estadio Akron','Zapopan',NULL),(463,4,'1539006','Group Stage - 2','Group Stage - 2',1539006,29,111,126,NULL,NULL,NULL,NULL,'2026-06-20 03:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48',NULL,NULL,NULL),(464,4,'1489391','Group Stage - 2','Group Stage - 2',1489391,30,128,100,39,NULL,NULL,NULL,'2026-06-19 19:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Lumen Field',NULL,NULL),(465,4,'1489390','Group Stage - 2','Group Stage - 2',1489390,31,113,107,33,NULL,NULL,NULL,'2026-06-19 22:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Gillette Stadium',NULL,NULL),(466,4,'1489389','Group Stage - 2','Group Stage - 2',1489389,32,89,129,36,NULL,NULL,NULL,'2026-06-20 00:30:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Lincoln Financial Field',NULL,NULL),(467,4,'1489394','Group Stage - 2','Group Stage - 2',1489394,33,106,95,37,NULL,NULL,NULL,'2026-06-21 04:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Estadio BBVA','Monterrey',NULL),(468,4,'1539007','Group Stage - 2','Group Stage - 2',1539007,34,115,88,35,NULL,NULL,NULL,'2026-06-20 17:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','NRG Stadium',NULL,NULL),(469,4,'1489393','Group Stage - 2','Group Stage - 2',1489393,35,103,116,30,NULL,NULL,NULL,'2026-06-20 20:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','BMO Field',NULL,NULL),(470,4,'1489392','Group Stage - 2','Group Stage - 2',1489392,36,127,132,41,NULL,NULL,NULL,'2026-06-21 00:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Arrowhead Stadium',NULL,NULL),(471,4,'1489397','Group Stage - 2','Group Stage - 2',1489397,37,92,102,38,NULL,NULL,NULL,'2026-06-21 16:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Mercedes-Benz Stadium',NULL,NULL),(472,4,'1489395','Group Stage - 2','Group Stage - 2',1489395,38,85,101,31,NULL,NULL,NULL,'2026-06-21 19:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','SoFi Stadium',NULL,NULL),(473,4,'1489398','Group Stage - 2','Group Stage - 2',1489398,39,90,121,40,NULL,NULL,NULL,'2026-06-21 22:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Hard Rock Stadium',NULL,NULL),(474,4,'1489396','Group Stage - 2','Group Stage - 2',1489396,40,130,108,34,NULL,NULL,NULL,'2026-06-22 01:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','BC Place',NULL,NULL),(475,4,'1489399','Group Stage - 2','Group Stage - 2',1489399,41,104,110,NULL,NULL,NULL,NULL,'2026-06-22 17:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48',NULL,NULL,NULL),(476,4,'1539017','Group Stage - 2','Group Stage - 2',1539017,42,86,123,36,NULL,NULL,NULL,'2026-06-22 21:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Lincoln Financial Field',NULL,NULL),(477,4,'1489401','Group Stage - 2','Group Stage - 2',1489401,43,112,96,32,NULL,NULL,NULL,'2026-06-23 00:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','MetLife Stadium',NULL,NULL),(478,4,'1489400','Group Stage - 2','Group Stage - 2',1489400,44,122,120,NULL,NULL,NULL,NULL,'2026-06-23 03:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48',NULL,NULL,NULL),(479,4,'1489404','Group Stage - 2','Group Stage - 2',1489404,45,105,124,35,NULL,NULL,NULL,'2026-06-23 17:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','NRG Stadium',NULL,NULL),(480,4,'1489402','Group Stage - 2','Group Stage - 2',1489402,46,93,117,33,NULL,NULL,NULL,'2026-06-23 20:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Gillette Stadium',NULL,NULL),(481,4,'1489403','Group Stage - 2','Group Stage - 2',1489403,47,94,87,30,NULL,NULL,NULL,'2026-06-23 23:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','BMO Field',NULL,NULL),(482,4,'1539008','Group Stage - 2','Group Stage - 2',1539008,48,91,118,29,NULL,NULL,NULL,'2026-06-24 02:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Estadio Akron','Zapopan',NULL),(483,4,'1489408','Group Stage - 3','Group Stage - 3',1489408,49,97,131,34,NULL,NULL,NULL,'2026-06-24 19:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','BC Place',NULL,NULL),(484,4,'1539009','Group Stage - 3','Group Stage - 3',1539009,50,114,125,39,NULL,NULL,NULL,'2026-06-24 19:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Lumen Field',NULL,NULL),(485,4,'1489405','Group Stage - 3','Group Stage - 3',1489405,51,107,129,38,NULL,NULL,NULL,'2026-06-24 22:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Mercedes-Benz Stadium',NULL,NULL),(486,4,'1489406','Group Stage - 3','Group Stage - 3',1489406,52,113,89,40,NULL,NULL,NULL,'2026-06-24 22:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Hard Rock Stadium',NULL,NULL),(487,4,'1539010','Group Stage - 3','Group Stage - 3',1539010,53,109,98,28,NULL,NULL,NULL,'2026-06-25 01:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Estadio Azteca','Mexico City',NULL),(488,4,'1489407','Group Stage - 3','Group Stage - 3',1489407,54,119,99,37,NULL,NULL,NULL,'2026-06-25 01:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Estadio BBVA','Monterrey',NULL),(489,4,'1489410','Group Stage - 3','Group Stage - 3',1489410,55,127,103,32,NULL,NULL,NULL,'2026-06-25 20:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','MetLife Stadium',NULL,NULL),(490,4,'1489409','Group Stage - 3','Group Stage - 3',1489409,56,132,116,36,NULL,NULL,NULL,'2026-06-25 20:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Lincoln Financial Field',NULL,NULL),(491,4,'1539011','Group Stage - 3','Group Stage - 3',1539011,57,95,88,NULL,NULL,NULL,NULL,'2026-06-25 23:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48',NULL,NULL,NULL),(492,4,'1489412','Group Stage - 3','Group Stage - 3',1489412,58,106,115,41,NULL,NULL,NULL,'2026-06-25 23:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Arrowhead Stadium',NULL,NULL),(493,4,'1539012','Group Stage - 3','Group Stage - 3',1539012,59,111,128,31,NULL,NULL,NULL,'2026-06-26 02:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','SoFi Stadium',NULL,NULL),(494,4,'1489411','Group Stage - 3','Group Stage - 3',1489411,60,126,100,NULL,NULL,NULL,NULL,'2026-06-26 02:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48',NULL,NULL,NULL),(495,4,'1539074','Group Stage - 3','Group Stage - 3',1539074,61,96,123,30,NULL,NULL,NULL,'2026-06-26 19:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','BMO Field',NULL,NULL),(496,4,'1489416','Group Stage - 3','Group Stage - 3',1489416,62,112,86,33,NULL,NULL,NULL,'2026-06-26 19:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Gillette Stadium',NULL,NULL),(497,4,'1489417','Group Stage - 3','Group Stage - 3',1489417,63,90,92,29,NULL,NULL,NULL,'2026-06-27 00:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Estadio Akron','Zapopan',NULL),(498,4,'1489413','Group Stage - 3','Group Stage - 3',1489413,64,121,102,35,NULL,NULL,NULL,'2026-06-27 00:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','NRG Stadium',NULL,NULL),(499,4,'1489414','Group Stage - 3','Group Stage - 3',1489414,65,108,101,39,NULL,NULL,NULL,'2026-06-27 03:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Lumen Field',NULL,NULL),(500,4,'1489415','Group Stage - 3','Group Stage - 3',1489415,66,130,85,34,NULL,NULL,NULL,'2026-06-27 03:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','BC Place',NULL,NULL),(501,4,'1489420','Group Stage - 3','Group Stage - 3',1489420,67,87,117,36,NULL,NULL,NULL,'2026-06-27 21:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Lincoln Financial Field',NULL,NULL),(502,4,'1489422','Group Stage - 3','Group Stage - 3',1489422,68,94,93,32,NULL,NULL,NULL,'2026-06-27 21:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','MetLife Stadium',NULL,NULL),(503,4,'1489419','Group Stage - 3','Group Stage - 3',1489419,69,91,105,40,NULL,NULL,NULL,'2026-06-27 23:30:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Hard Rock Stadium',NULL,NULL),(504,4,'1539013','Group Stage - 3','Group Stage - 3',1539013,70,118,124,38,NULL,NULL,NULL,'2026-06-27 23:30:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Mercedes-Benz Stadium',NULL,NULL),(505,4,'1489418','Group Stage - 3','Group Stage - 3',1489418,71,120,110,41,NULL,NULL,NULL,'2026-06-28 02:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:48','Arrowhead Stadium',NULL,NULL),(506,4,'1489421','Group Stage - 3','Group Stage - 3',1489421,72,122,104,NULL,NULL,NULL,NULL,'2026-06-28 02:00:00','NS',NULL,NULL,NULL,NULL,NULL,NULL,'Not Started',NULL,0,0,1,0,'2026-04-03 14:38:53','2026-04-12 10:34:49',NULL,NULL,NULL);
/*!40000 ALTER TABLE `world_cup_matches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_cup_players`
--

DROP TABLE IF EXISTS `world_cup_players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `world_cup_players` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` bigint unsigned NOT NULL,
  `team_id` bigint unsigned NOT NULL,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_api` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_override` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shirt_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `club_name_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `club_name_normalized` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_override` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio_editorial` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `is_galatasaray_related` tinyint(1) NOT NULL DEFAULT '0',
  `galatasaray_relation_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `galatasaray_note` text COLLATE utf8mb4_unicode_ci,
  `gs_relation_lock` tinyint(1) NOT NULL DEFAULT '0',
  `gs_relation_approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `world_cup_players_tournament_id_slug_unique` (`tournament_id`,`slug`),
  KEY `world_cup_players_team_id_foreign` (`team_id`),
  KEY `world_cup_players_external_id_index` (`external_id`),
  KEY `world_cup_players_is_featured_index` (`is_featured`),
  KEY `world_cup_players_is_visible_index` (`is_visible`),
  KEY `world_cup_players_is_galatasaray_related_index` (`is_galatasaray_related`),
  CONSTRAINT `world_cup_players_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `world_cup_teams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `world_cup_players_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `world_cup_tournaments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1530 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_cup_players`
--

LOCK TABLES `world_cup_players` WRITE;
/*!40000 ALTER TABLE `world_cup_players` DISABLE KEYS */;
/*!40000 ALTER TABLE `world_cup_players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_cup_settings`
--

DROP TABLE IF EXISTS `world_cup_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `world_cup_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` bigint unsigned DEFAULT NULL,
  `wc_module_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `home_teaser_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `countdown_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `show_featured_players` tinyint(1) NOT NULL DEFAULT '1',
  `show_featured_matches` tinyint(1) NOT NULL DEFAULT '1',
  `show_featured_stadiums` tinyint(1) NOT NULL DEFAULT '1',
  `show_stat_cards` tinyint(1) NOT NULL DEFAULT '1',
  `stale_data_notice_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `world_cup_settings_tournament_id_foreign` (`tournament_id`),
  CONSTRAINT `world_cup_settings_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `world_cup_tournaments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_cup_settings`
--

LOCK TABLES `world_cup_settings` WRITE;
/*!40000 ALTER TABLE `world_cup_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `world_cup_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_cup_stadium_aliases`
--

DROP TABLE IF EXISTS `world_cup_stadium_aliases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `world_cup_stadium_aliases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stadium_id` bigint unsigned NOT NULL,
  `alias_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `world_cup_stadium_aliases_stadium_id_alias_name_unique` (`stadium_id`,`alias_name`),
  CONSTRAINT `world_cup_stadium_aliases_stadium_id_foreign` FOREIGN KEY (`stadium_id`) REFERENCES `world_cup_stadiums` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_cup_stadium_aliases`
--

LOCK TABLES `world_cup_stadium_aliases` WRITE;
/*!40000 ALTER TABLE `world_cup_stadium_aliases` DISABLE KEYS */;
INSERT INTO `world_cup_stadium_aliases` VALUES (1,42,'Dallas Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(2,43,'San Francisco Bay Area Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(3,32,'New York New Jersey Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(4,28,'Mexico City Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(5,29,'Guadalajara Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(6,37,'Monterrey Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(7,38,'Atlanta Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(8,33,'Boston Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(9,35,'Houston Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(10,41,'Kansas City Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(11,31,'Los Angeles Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(12,40,'Miami Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(13,36,'Philadelphia Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(14,39,'Seattle Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(15,34,'Vancouver Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16'),(16,30,'Toronto Stadium',NULL,NULL,'2026-04-07 15:37:16','2026-04-07 15:37:16');
/*!40000 ALTER TABLE `world_cup_stadium_aliases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_cup_stadiums`
--

DROP TABLE IF EXISTS `world_cup_stadiums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `world_cup_stadiums` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` bigint unsigned NOT NULL,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_api` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_override` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `capacity_override` int DEFAULT NULL,
  `opened_year` int DEFAULT NULL,
  `surface_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `image_override` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seating_plan_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery` json DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `description_editorial` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `world_cup_stadiums_tournament_id_slug_unique` (`tournament_id`,`slug`),
  KEY `world_cup_stadiums_external_id_index` (`external_id`),
  KEY `world_cup_stadiums_is_featured_index` (`is_featured`),
  KEY `world_cup_stadiums_is_visible_index` (`is_visible`),
  CONSTRAINT `world_cup_stadiums_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `world_cup_tournaments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_cup_stadiums`
--

LOCK TABLES `world_cup_stadiums` WRITE;
/*!40000 ALTER TABLE `world_cup_stadiums` DISABLE KEYS */;
INSERT INTO `world_cup_stadiums` VALUES (28,4,'hash:8858e895c1b2e3b53fd8794513c059f5532f5094','Estadio Azteca','Mexico City Stadium','estadio-azteca','Mexico City','Mexico',NULL,72766,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/estadio-azteca/hero/stadium-hero-mexico-city-stadium.webp','stadiums/estadio-azteca/seating/seatmap-mexico-city-stadium.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:32'),(29,4,'hash:234a220aa5c7bae2763d4353359b603227327e30','Estadio Akron','Estadio Guadalajara','estadio-akron','Zapopan','Mexico',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/estadio-akron/hero/stadium-hero-estadio-guadalajara.webp','stadiums/estadio-akron/seating/seatmap-estadio-guadalajara.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:29'),(30,4,'hash:c97d469d083f0f07f936e1a839c858fc5c576bba','BMO Field','Toronto Stadium','bmo-field','Toronto','Canada',NULL,44315,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/bmo-field/hero/stadium-hero-toronto-stadium.webp','stadiums/bmo-field/seating/seatmap-toronto-stadium.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:35'),(31,4,'hash:9bad881ec5f1d030f25b72477c39d4815c112b77','SoFi Stadium','Los Angeles Stadium','sofi-stadium','Inglewood','USA',NULL,69650,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/sofi-stadium/hero/stadium-hero-los-angeles-stadium.webp','stadiums/sofi-stadium/seating/seatmap-los-angeles-stadium.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:31'),(32,4,'hash:9c6573d08d28531af93696232096514c94130e24','MetLife Stadium','New York New Jersey Stadium','metlife-stadium','East Rutherford','USA',NULL,78576,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/metlife-stadium/hero/stadium-hero-new-york-new-jersey-stadium.webp','stadiums/metlife-stadium/seating/seatmap-new-york-new-jersey-stadium.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:33'),(33,4,'hash:6042665812975c3f5f39025538cd027410cbafb4','Gillette Stadium','Boston Stadium','gillette-stadium','Foxborough','USA',NULL,63815,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/gillette-stadium/hero/stadium-hero-boston-stadium.webp','stadiums/gillette-stadium/seating/seatmap-boston-stadium.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:28'),(34,4,'hash:60da6d0d6236ad62376d824f6bc0ab6390acf6c5','BC Place','BC Place Vancouver','bc-place','Vancouver','Canada',NULL,48821,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/bc-place/hero/stadium-hero-bc-place-vancouver.webp','stadiums/bc-place/seating/seatmap-bc-place-vancouver.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:27'),(35,4,'hash:f390c76f1ccc8bd2c22e7a93700da89ea3abb280','NRG Stadium','Houston Stadium','nrg-stadium','Houston','USA',NULL,68311,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/nrg-stadium/hero/stadium-hero-houston-stadium.webp','stadiums/nrg-stadium/seating/seatmap-houston-stadium.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:30'),(36,4,'hash:7a5235959bbc7ca63a191daf943ebeb4a3f17edf','Lincoln Financial Field','Philadelphia Stadium','lincoln-financial-field','Philadelphia','USA',NULL,65827,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/lincoln-financial-field/hero/stadium-hero-philadelphia-stadium.webp','stadiums/lincoln-financial-field/seating/seatmap-philadelphia-stadium.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:33'),(37,4,'hash:2795bf518e975473313357a0438e9ad767326c3a','Estadio BBVA','Estadio Monterrey','estadio-bbva','Guadalupe','Mexico',NULL,50113,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/estadio-bbva/hero/stadium-hero-estadio-monterrey.webp','stadiums/estadio-bbva/seating/seatmap-estadio-monterrey.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:30'),(38,4,'hash:70e9e750408c84cde4d6ad5fe56646a9a616ed32','Mercedes-Benz Stadium','Atlanta Stadium','mercedes-benz-stadium','Atlanta','USA',NULL,67382,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/mercedes-benz-stadium/hero/stadium-hero-atlanta-stadium.webp','stadiums/mercedes-benz-stadium/seating/seatmap-atlanta-stadium.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:27'),(39,4,'hash:32f9992ec8e337fcdfd7fe319943e999a16400f3','Lumen Field','Seattle Stadium','lumen-field','Seattle','USA',NULL,65123,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/lumen-field/hero/stadium-hero-seattle-stadium.webp','stadiums/lumen-field/seating/seatmap-seattle-stadium.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:35'),(40,4,'hash:b1a816fd7fa45f52113159f615eee0be27ea2ca5','Hard Rock Stadium','Miami Stadium','hard-rock-stadium','Miami Gardens','USA',NULL,64091,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/hard-rock-stadium/hero/stadium-hero-miami-stadium.webp','stadiums/hard-rock-stadium/seating/seatmap-miami-stadium.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:32'),(41,4,'hash:ee59324e5f0ba46b22ed9673944d74621fa1a67e','Arrowhead Stadium','Kansas City Stadium','arrowhead-stadium','Kansas City','USA',NULL,67513,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/arrowhead-stadium/hero/stadium-hero-kansas-city-stadium.webp','stadiums/arrowhead-stadium/seating/seatmap-kansas-city-stadium.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-03 14:36:52','2026-04-10 16:02:31'),(42,4,NULL,'AT&T Stadium','Dallas Stadium','att-stadium','Arlington','USA',NULL,70122,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/att-stadium/hero/stadium-hero-dallas-stadium.webp','stadiums/att-stadium/seating/seatmap-dallas-stadium.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-07 13:53:41','2026-04-10 16:02:29'),(43,4,NULL,'Levi\'s Stadium','San Francisco Bay Area Stadium','levis-stadium','Santa Clara','USA',NULL,69391,NULL,NULL,NULL,NULL,NULL,NULL,'stadiums/levis-stadium/hero/stadium-hero-san-francisco-bay-area-stadium.webp','stadiums/levis-stadium/seating/seatmap-san-francisco-bay-area-stadium.webp',NULL,NULL,NULL,NULL,NULL,0,1,'2026-04-07 13:53:41','2026-04-10 16:02:34');
/*!40000 ALTER TABLE `world_cup_stadiums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_cup_sync_logs`
--

DROP TABLE IF EXISTS `world_cup_sync_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `world_cup_sync_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` bigint unsigned DEFAULT NULL,
  `dataset` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'api-football',
  `started_at` timestamp NOT NULL,
  `finished_at` timestamp NULL DEFAULT NULL,
  `records_processed` int NOT NULL DEFAULT '0',
  `records_skipped` int NOT NULL DEFAULT '0',
  `warnings_count` int NOT NULL DEFAULT '0',
  `errors_count` int NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `error_summary` text COLLATE utf8mb4_unicode_ci,
  `batch_uuid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `world_cup_sync_logs_tournament_id_foreign` (`tournament_id`),
  KEY `world_cup_sync_logs_dataset_index` (`dataset`),
  KEY `world_cup_sync_logs_status_index` (`status`),
  KEY `world_cup_sync_logs_batch_uuid_index` (`batch_uuid`),
  CONSTRAINT `world_cup_sync_logs_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `world_cup_tournaments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_cup_sync_logs`
--

LOCK TABLES `world_cup_sync_logs` WRITE;
/*!40000 ALTER TABLE `world_cup_sync_logs` DISABLE KEYS */;
INSERT INTO `world_cup_sync_logs` VALUES (1,NULL,'tournament','api-football','2026-04-02 19:04:51','2026-04-02 19:04:52',1,0,0,0,'success',NULL,'4f2a150e-bd0c-42bb-970e-a27247a2a784','2026-04-02 19:04:52','2026-04-02 19:04:52'),(7,NULL,'tournament','api-football','2026-04-02 20:41:04','2026-04-02 20:41:04',1,0,0,0,'success',NULL,'aa3c6d5f-8704-4f30-8b52-298ddeeff2b2','2026-04-02 20:41:04','2026-04-02 20:41:04'),(17,4,'teams','api-football','2026-04-03 14:35:21','2026-04-03 14:35:22',48,0,0,0,'success',NULL,'fe3830cb-3355-4769-8c59-02792823e06b','2026-04-03 14:35:22','2026-04-03 14:35:22'),(18,4,'stadiums','api-football','2026-04-03 14:36:51','2026-04-03 14:36:52',14,0,14,0,'success',NULL,'ccd93533-dabf-4678-afd1-1833ec0f57e8','2026-04-03 14:36:52','2026-04-03 14:36:52'),(19,4,'matches','api-football','2026-04-03 14:38:53','2026-04-03 14:38:53',72,0,0,0,'success',NULL,'bf895e93-4ba0-40ed-84bf-be7115456652','2026-04-03 14:38:53','2026-04-03 14:38:53'),(20,4,'players','api-football','2026-04-03 14:41:42','2026-04-03 14:41:43',0,0,1,0,'success',NULL,'2ac449cf-5fc4-4907-bc60-7abce21bd9db','2026-04-03 14:41:43','2026-04-03 14:41:43'),(21,4,'standings','api-football','2026-04-03 14:41:51','2026-04-03 14:41:52',60,0,1,0,'success',NULL,'cac95bf0-7b92-40d7-93a5-c2ebe97304af','2026-04-03 14:41:52','2026-04-03 14:41:52'),(22,4,'matches','api-football','2026-04-03 18:19:56','2026-04-03 18:19:56',72,0,0,0,'success',NULL,'a6b186f1-ebfc-4cd5-8c89-8773036dc42f','2026-04-03 18:19:57','2026-04-03 18:19:57'),(23,4,'tournament','api-football','2026-04-12 10:34:48','2026-04-12 10:34:48',1,0,0,0,'success',NULL,'07516315-5748-4da7-965c-fd885faa7f22','2026-04-12 10:34:48','2026-04-12 10:34:48'),(24,4,'teams','api-football','2026-04-12 10:34:48','2026-04-12 10:34:48',0,1,0,0,'success','[STATIC_DATA_CONSERVATIVE] Statik veri mevcut, otomatik güncelleme devre dışı.','07516315-5748-4da7-965c-fd885faa7f22','2026-04-12 10:34:48','2026-04-12 10:34:48'),(25,4,'stadiums','api-football','2026-04-12 10:34:48','2026-04-12 10:34:48',0,1,0,0,'success','[STATIC_DATA_CONSERVATIVE] Statik veri mevcut, otomatik güncelleme devre dışı.','07516315-5748-4da7-965c-fd885faa7f22','2026-04-12 10:34:48','2026-04-12 10:34:48'),(26,4,'matches','api-football','2026-04-12 10:34:48','2026-04-12 10:34:49',72,0,0,0,'success',NULL,'07516315-5748-4da7-965c-fd885faa7f22','2026-04-12 10:34:49','2026-04-12 10:34:49'),(27,4,'players','api-football','2026-04-12 10:34:49','2026-04-12 10:34:49',0,0,1,0,'success',NULL,'07516315-5748-4da7-965c-fd885faa7f22','2026-04-12 10:34:49','2026-04-12 10:34:49'),(28,4,'standings','api-football','2026-04-12 10:34:49','2026-04-12 10:34:50',60,0,1,0,'success',NULL,'07516315-5748-4da7-965c-fd885faa7f22','2026-04-12 10:34:50','2026-04-12 10:34:50');
/*!40000 ALTER TABLE `world_cup_sync_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_cup_teams`
--

DROP TABLE IF EXISTS `world_cup_teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `world_cup_teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` bigint unsigned NOT NULL,
  `group_id` bigint unsigned DEFAULT NULL,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_api` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_override` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_name_override` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fifa_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confederation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coach_name_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_image_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_override` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_editorial` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `featured_lock` tinyint(1) NOT NULL DEFAULT '0',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `world_cup_teams_tournament_id_slug_unique` (`tournament_id`,`slug`),
  KEY `world_cup_teams_group_id_foreign` (`group_id`),
  KEY `world_cup_teams_external_id_index` (`external_id`),
  KEY `world_cup_teams_fifa_code_index` (`fifa_code`),
  KEY `world_cup_teams_is_featured_index` (`is_featured`),
  KEY `world_cup_teams_is_visible_index` (`is_visible`),
  KEY `world_cup_teams_sort_order_index` (`sort_order`),
  CONSTRAINT `world_cup_teams_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `world_cup_groups` (`id`) ON DELETE SET NULL,
  CONSTRAINT `world_cup_teams_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `world_cup_tournaments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_cup_teams`
--

LOCK TABLES `world_cup_teams` WRITE;
/*!40000 ALTER TABLE `world_cup_teams` DISABLE KEYS */;
INSERT INTO `world_cup_teams` VALUES (85,4,17,'1','Belgium','BEL',NULL,NULL,'belgium','BEL',NULL,NULL,'https://media.api-sports.io/football/teams/1.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(86,4,19,'2','France','FRA',NULL,NULL,'france','FRA',NULL,NULL,'https://media.api-sports.io/football/teams/2.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(87,4,22,'3','Croatia','CRO',NULL,NULL,'croatia','CRO',NULL,NULL,'https://media.api-sports.io/football/teams/3.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(88,4,16,'5','Sweden','SWE',NULL,NULL,'sweden','SWE',NULL,NULL,'https://media.api-sports.io/football/teams/5.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(89,4,13,'6','Brazil','BRA',NULL,NULL,'brazil','BRA',NULL,NULL,'https://media.api-sports.io/football/teams/6.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:51'),(90,4,18,'7','Uruguay','URU',NULL,NULL,'uruguay','URU',NULL,NULL,'https://media.api-sports.io/football/teams/7.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(91,4,21,'8','Colombia','COL',NULL,NULL,'colombia','COL',NULL,NULL,'https://media.api-sports.io/football/teams/8.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(92,4,18,'9','Spain','SPA',NULL,NULL,'spain','SPA',NULL,NULL,'https://media.api-sports.io/football/teams/9.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(93,4,22,'10','England','ENG',NULL,NULL,'england','ENG',NULL,NULL,'https://media.api-sports.io/football/teams/10.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(94,4,22,'11','Panama','PAN',NULL,NULL,'panama','PAN',NULL,NULL,'https://media.api-sports.io/football/teams/11.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(95,4,16,'12','Japan','JAP',NULL,NULL,'japan','JAP',NULL,NULL,'https://media.api-sports.io/football/teams/12.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(96,4,23,'13','Senegal','SEN',NULL,NULL,'senegal','SEN',NULL,NULL,'https://media.api-sports.io/football/teams/13.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-12 10:34:50'),(97,4,12,'15','Switzerland','SWI',NULL,NULL,'switzerland','SWI',NULL,NULL,'https://media.api-sports.io/football/teams/15.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:51'),(98,4,11,'16','Mexico','MEX',NULL,NULL,'mexico','MEX',NULL,NULL,'https://media.api-sports.io/football/teams/16.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:51'),(99,4,11,'17','South Korea','SOU',NULL,NULL,'south-korea','SOU',NULL,NULL,'https://media.api-sports.io/football/teams/17.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:51'),(100,4,14,'20','Australia','AUS',NULL,NULL,'australia','AUS',NULL,NULL,'https://media.api-sports.io/football/teams/20.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:51'),(101,4,23,'22','Iran','IRA',NULL,NULL,'iran','IRA',NULL,NULL,'https://media.api-sports.io/football/teams/22.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-12 10:34:50'),(102,4,18,'23','Saudi Arabia','SAU',NULL,NULL,'saudi-arabia','SAU',NULL,NULL,'https://media.api-sports.io/football/teams/23.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(103,4,15,'25','Germany','GER',NULL,NULL,'germany','GER',NULL,NULL,'https://media.api-sports.io/football/teams/25.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(104,4,20,'26','Argentina','ARG',NULL,NULL,'argentina','ARG',NULL,NULL,'https://media.api-sports.io/football/teams/26.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(105,4,21,'27','Portugal','POR',NULL,NULL,'portugal','POR',NULL,NULL,'https://media.api-sports.io/football/teams/27.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(106,4,23,'28','Tunisia','TUN',NULL,NULL,'tunisia','TUN',NULL,NULL,'https://media.api-sports.io/football/teams/28.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-12 10:34:50'),(107,4,13,'31','Morocco','MOR',NULL,NULL,'morocco','MOR',NULL,NULL,'https://media.api-sports.io/football/teams/31.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:51'),(108,4,17,'32','Egypt','EGY',NULL,NULL,'egypt','EGY',NULL,NULL,'https://media.api-sports.io/football/teams/32.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(109,4,11,'770','Czech Republic','CZE',NULL,NULL,'czech-republic','CZE',NULL,NULL,'https://media.api-sports.io/football/teams/770.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:51'),(110,4,20,'775','Austria','AUS',NULL,NULL,'austria','AUS',NULL,NULL,'https://media.api-sports.io/football/teams/775.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(111,4,14,'777','Türkiye','TUR',NULL,NULL,'turkiye','TUR',NULL,NULL,'https://media.api-sports.io/football/teams/777.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:51'),(112,4,19,'1090','Norway','NOR',NULL,NULL,'norway','NOR',NULL,NULL,'https://media.api-sports.io/football/teams/1090.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(113,4,13,'1108','Scotland','SCO',NULL,NULL,'scotland','SCO',NULL,NULL,'https://media.api-sports.io/football/teams/1108.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:51'),(114,4,12,'1113','Bosnia & Herzegovina','BOS',NULL,NULL,'bosnia-herzegovina','BOS',NULL,NULL,'https://media.api-sports.io/football/teams/1113.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:51'),(115,4,16,'1118','Netherlands','NET',NULL,NULL,'netherlands','NET',NULL,NULL,'https://media.api-sports.io/football/teams/1118.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(116,4,23,'1501','Ivory Coast','IVO',NULL,NULL,'ivory-coast','IVO',NULL,NULL,'https://media.api-sports.io/football/teams/1501.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-12 10:34:50'),(117,4,23,'1504','Ghana','GHA',NULL,NULL,'ghana','GHA',NULL,NULL,'https://media.api-sports.io/football/teams/1504.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-12 10:34:50'),(118,4,23,'1508','Congo DR','CON',NULL,NULL,'congo-dr','CON',NULL,NULL,'https://media.api-sports.io/football/teams/1508.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-12 10:34:50'),(119,4,23,'1531','South Africa','SOU',NULL,NULL,'south-africa','SOU',NULL,NULL,'https://media.api-sports.io/football/teams/1531.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-12 10:34:50'),(120,4,23,'1532','Algeria','ALG',NULL,NULL,'algeria','ALG',NULL,NULL,'https://media.api-sports.io/football/teams/1532.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-12 10:34:50'),(121,4,23,'1533','Cape Verde Islands','CAP',NULL,NULL,'cape-verde-islands','CAP',NULL,NULL,'https://media.api-sports.io/football/teams/1533.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-12 10:34:50'),(122,4,20,'1548','Jordan','JOR',NULL,NULL,'jordan','JOR',NULL,NULL,'https://media.api-sports.io/football/teams/1548.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(123,4,19,'1567','Iraq','IRA',NULL,NULL,'iraq','IRA',NULL,NULL,'https://media.api-sports.io/football/teams/1567.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(124,4,21,'1568','Uzbekistan','UZB',NULL,NULL,'uzbekistan','UZB',NULL,NULL,'https://media.api-sports.io/football/teams/1568.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(125,4,12,'1569','Qatar','QAT',NULL,NULL,'qatar','QAT',NULL,NULL,'https://media.api-sports.io/football/teams/1569.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:51'),(126,4,14,'2380','Paraguay','PAR',NULL,NULL,'paraguay','PAR',NULL,NULL,'https://media.api-sports.io/football/teams/2380.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:51'),(127,4,15,'2382','Ecuador','ECU',NULL,NULL,'ecuador','ECU',NULL,NULL,'https://media.api-sports.io/football/teams/2382.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(128,4,23,'2384','USA','USA',NULL,NULL,'usa','USA',NULL,NULL,'https://media.api-sports.io/football/teams/2384.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-12 10:34:50'),(129,4,23,'2386','Haiti','HAI',NULL,NULL,'haiti','HAI',NULL,NULL,'https://media.api-sports.io/football/teams/2386.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-12 10:34:50'),(130,4,17,'4673','New Zealand','ZEA',NULL,NULL,'new-zealand','ZEA',NULL,NULL,'https://media.api-sports.io/football/teams/4673.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52'),(131,4,23,'5529','Canada','CAN',NULL,NULL,'canada','CAN',NULL,NULL,'https://media.api-sports.io/football/teams/5529.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-12 10:34:50'),(132,4,15,'5530','Curaçao',NULL,NULL,NULL,'curacao',NULL,NULL,NULL,'https://media.api-sports.io/football/teams/5530.png',NULL,NULL,0,0,1,0,'2026-04-03 14:35:22','2026-04-03 14:41:52');
/*!40000 ALTER TABLE `world_cup_teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_cup_tournaments`
--

DROP TABLE IF EXISTS `world_cup_tournaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `world_cup_tournaments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year NOT NULL,
  `host_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `hero_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `world_cup_tournaments_year_slug_unique` (`year`,`slug`),
  UNIQUE KEY `world_cup_tournaments_slug_unique` (`slug`),
  KEY `world_cup_tournaments_external_id_index` (`external_id`),
  KEY `world_cup_tournaments_year_index` (`year`),
  KEY `world_cup_tournaments_status_index` (`status`),
  KEY `world_cup_tournaments_is_active_index` (`is_active`),
  KEY `world_cup_tournaments_is_visible_index` (`is_visible`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_cup_tournaments`
--

LOCK TABLES `world_cup_tournaments` WRITE;
/*!40000 ALTER TABLE `world_cup_tournaments` DISABLE KEYS */;
INSERT INTO `world_cup_tournaments` VALUES (4,'1_2026','World Cup','world-cup-2026',2026,NULL,'2026-06-11 00:00:00','2026-06-28 00:00:00','Cup',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-04-12 10:34:48');
/*!40000 ALTER TABLE `world_cup_tournaments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-21 14:35:55
