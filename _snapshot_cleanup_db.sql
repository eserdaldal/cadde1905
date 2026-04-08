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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `cache` VALUES ('cadde1905-cache-356a192b7913b04c54574d18c28d46e6395428ab','i:1;',1774890761),('cadde1905-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1774890761;',1774890761),('cadde1905-cache-livewire-rate-limiter:287b58015ec6ed41cc45119562d7402bb1069aed','i:1;',1774994840),('cadde1905-cache-livewire-rate-limiter:287b58015ec6ed41cc45119562d7402bb1069aed:timer','i:1774994840;',1774994840),('cadde1905-cache-page.match_center.team_645.season_2025','a:5:{s:6:\"status\";s:2:\"ok\";s:5:\"match\";a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:998;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/998.png\";s:4:\"name\";s:11:\"Trabzonspor\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 28\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394684;s:4:\"date\";s:25:\"2026-04-05T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";i:20189;s:4:\"city\";s:7:\"Trabzon\";s:4:\"name\";s:11:\"Papara Park\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1775408400;}}s:7:\"away_id\";i:645;s:7:\"home_id\";i:998;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"away_name\";s:11:\"Galatasaray\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/998.png\";s:9:\"home_name\";s:11:\"Trabzonspor\";s:9:\"league_id\";i:203;s:10:\"detail_url\";s:4:\"/mac\";s:10:\"fixture_id\";i:1394684;s:10:\"venue_city\";s:7:\"Trabzon\";s:10:\"venue_name\";s:11:\"Papara Park\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"05.04.2026 17:00\";}s:8:\"upcoming\";a:5:{i:0;a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:998;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/998.png\";s:4:\"name\";s:11:\"Trabzonspor\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 28\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394684;s:4:\"date\";s:25:\"2026-04-05T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";i:20189;s:4:\"city\";s:7:\"Trabzon\";s:4:\"name\";s:11:\"Papara Park\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1775408400;}}s:7:\"away_id\";i:645;s:7:\"home_id\";i:998;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"away_name\";s:11:\"Galatasaray\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/998.png\";s:9:\"home_name\";s:11:\"Trabzonspor\";s:9:\"league_id\";i:203;s:10:\"detail_url\";s:4:\"/mac\";s:10:\"fixture_id\";i:1394684;s:10:\"venue_city\";s:7:\"Trabzon\";s:10:\"venue_name\";s:11:\"Papara Park\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"05.04.2026 17:00\";}i:1;a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:7411;s:4:\"logo\";s:51:\"https://media.api-sports.io/football/teams/7411.png\";s:4:\"name\";s:11:\"Kocaelispor\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 29\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394689;s:4:\"date\";s:25:\"2026-04-12T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";N;s:4:\"city\";s:8:\"Istanbul\";s:4:\"name\";s:9:\"Rams Park\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1776013200;}}s:7:\"away_id\";i:7411;s:7:\"home_id\";i:645;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:51:\"https://media.api-sports.io/football/teams/7411.png\";s:9:\"away_name\";s:11:\"Kocaelispor\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"home_name\";s:11:\"Galatasaray\";s:9:\"league_id\";i:203;s:10:\"detail_url\";s:4:\"/mac\";s:10:\"fixture_id\";i:1394689;s:10:\"venue_city\";s:8:\"Istanbul\";s:10:\"venue_name\";s:9:\"Rams Park\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"12.04.2026 17:00\";}i:2;a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:997;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/997.png\";s:4:\"name\";s:21:\"Gençlerbirliği S.K.\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 30\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394697;s:4:\"date\";s:25:\"2026-04-19T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";i:2378;s:4:\"city\";s:6:\"Ankara\";s:4:\"name\";s:15:\"Eryaman Stadium\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1776618000;}}s:7:\"away_id\";i:645;s:7:\"home_id\";i:997;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"away_name\";s:11:\"Galatasaray\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/997.png\";s:9:\"home_name\";s:21:\"Gençlerbirliği S.K.\";s:9:\"league_id\";i:203;s:10:\"detail_url\";s:4:\"/mac\";s:10:\"fixture_id\";i:1394697;s:10:\"venue_city\";s:6:\"Ankara\";s:10:\"venue_name\";s:15:\"Eryaman Stadium\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"19.04.2026 17:00\";}i:3;a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:997;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/997.png\";s:4:\"name\";s:21:\"Gençlerbirliği S.K.\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:206;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/206.png\";s:4:\"name\";s:16:\"Türkiye Kupası\";s:5:\"round\";s:14:\"Quarter-finals\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:0;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1531969;s:4:\"date\";s:25:\"2026-04-21T16:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";N;s:4:\"city\";s:8:\"Istanbul\";s:4:\"name\";s:9:\"Rams Park\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1776787200;}}s:7:\"away_id\";i:997;s:7:\"home_id\";i:645;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/997.png\";s:9:\"away_name\";s:21:\"Gençlerbirliği S.K.\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"home_name\";s:11:\"Galatasaray\";s:9:\"league_id\";i:206;s:10:\"detail_url\";s:4:\"/mac\";s:10:\"fixture_id\";i:1531969;s:10:\"venue_city\";s:8:\"Istanbul\";s:10:\"venue_name\";s:9:\"Rams Park\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/206.png\";s:11:\"league_name\";s:16:\"Türkiye Kupası\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"21.04.2026 16:00\";}i:4;a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:611;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/611.png\";s:4:\"name\";s:11:\"Fenerbahçe\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 31\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394707;s:4:\"date\";s:25:\"2026-04-26T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";N;s:4:\"city\";s:8:\"Istanbul\";s:4:\"name\";s:9:\"Rams Park\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1777222800;}}s:7:\"away_id\";i:611;s:7:\"home_id\";i:645;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/611.png\";s:9:\"away_name\";s:11:\"Fenerbahçe\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"home_name\";s:11:\"Galatasaray\";s:9:\"league_id\";i:203;s:10:\"detail_url\";s:4:\"/mac\";s:10:\"fixture_id\";i:1394707;s:10:\"venue_city\";s:8:\"Istanbul\";s:10:\"venue_name\";s:9:\"Rams Park\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"26.04.2026 17:00\";}}s:12:\"last_matches\";a:5:{i:0;a:22:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:4;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:4;}s:8:\"halftime\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:1;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";b:0;}s:4:\"home\";a:4:{s:2:\"id\";i:40;s:4:\"logo\";s:49:\"https://media.api-sports.io/football/teams/40.png\";s:4:\"name\";s:9:\"Liverpool\";s:6:\"winner\";b:1;}}s:6:\"league\";a:8:{s:2:\"id\";i:2;s:4:\"flag\";N;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/leagues/2.png\";s:4:\"name\";s:21:\"UEFA Champions League\";s:5:\"round\";s:11:\"Round of 16\";s:6:\"season\";i:2025;s:7:\"country\";s:5:\"World\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1528329;s:4:\"date\";s:25:\"2026-03-18T20:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";N;s:4:\"city\";s:9:\"Liverpool\";s:4:\"name\";s:7:\"Anfield\";}s:6:\"status\";a:4:{s:4:\"long\";s:14:\"Match Finished\";s:5:\"extra\";i:7;s:5:\"short\";s:2:\"FT\";s:7:\"elapsed\";i:90;}s:7:\"periods\";a:2:{s:5:\"first\";i:1773864000;s:6:\"second\";i:1773867600;}s:7:\"referee\";s:13:\"P. Raczkowski\";s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1773864000;}}s:5:\"score\";s:5:\"4 - 0\";s:6:\"result\";s:4:\"loss\";s:7:\"away_id\";i:645;s:7:\"home_id\";i:40;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"away_name\";s:11:\"Galatasaray\";s:9:\"home_logo\";s:49:\"https://media.api-sports.io/football/teams/40.png\";s:9:\"home_name\";s:9:\"Liverpool\";s:9:\"league_id\";i:2;s:10:\"away_goals\";i:0;s:10:\"detail_url\";s:4:\"/mac\";s:10:\"fixture_id\";i:1528329;s:10:\"home_goals\";i:4;s:10:\"venue_city\";s:9:\"Liverpool\";s:10:\"venue_name\";s:7:\"Anfield\";s:11:\"league_logo\";s:50:\"https://media.api-sports.io/football/leagues/2.png\";s:11:\"league_name\";s:21:\"UEFA Champions League\";s:11:\"status_long\";s:14:\"Match Finished\";s:12:\"status_short\";s:2:\"FT\";s:14:\"match_datetime\";s:16:\"18.03.2026 20:00\";}i:1;a:22:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:994;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/994.png\";s:4:\"name\";s:8:\"Göztepe\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 27\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394672;s:4:\"date\";s:25:\"2026-03-18T18:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";i:22441;s:4:\"city\";s:5:\"Izmir\";s:4:\"name\";s:22:\"Gürsel Aksel Stadyumu\";}s:6:\"status\";a:4:{s:4:\"long\";s:15:\"Match Postponed\";s:5:\"extra\";N;s:5:\"short\";s:3:\"PST\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1773856800;}}s:5:\"score\";N;s:6:\"result\";N;s:7:\"away_id\";i:645;s:7:\"home_id\";i:994;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"away_name\";s:11:\"Galatasaray\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/994.png\";s:9:\"home_name\";s:8:\"Göztepe\";s:9:\"league_id\";i:203;s:10:\"away_goals\";N;s:10:\"detail_url\";s:4:\"/mac\";s:10:\"fixture_id\";i:1394672;s:10:\"home_goals\";N;s:10:\"venue_city\";s:5:\"Izmir\";s:10:\"venue_name\";s:22:\"Gürsel Aksel Stadyumu\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:15:\"Match Postponed\";s:12:\"status_short\";s:3:\"PST\";s:14:\"match_datetime\";s:16:\"18.03.2026 18:00\";}i:2;a:22:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:3;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:3;}s:8:\"halftime\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:0;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:564;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/564.png\";s:4:\"name\";s:12:\"Başakşehir\";s:6:\"winner\";b:0;}s:4:\"home\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";b:1;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 26\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394659;s:4:\"date\";s:25:\"2026-03-14T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";N;s:4:\"city\";s:8:\"Istanbul\";s:4:\"name\";s:18:\"Rams Park Stadyumu\";}s:6:\"status\";a:4:{s:4:\"long\";s:14:\"Match Finished\";s:5:\"extra\";i:3;s:5:\"short\";s:2:\"FT\";s:7:\"elapsed\";i:90;}s:7:\"periods\";a:2:{s:5:\"first\";i:1773507600;s:6:\"second\";i:1773511200;}s:7:\"referee\";s:23:\"Batuhan Kolak, Türkiye\";s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1773507600;}}s:5:\"score\";s:5:\"3 - 0\";s:6:\"result\";s:3:\"win\";s:7:\"away_id\";i:564;s:7:\"home_id\";i:645;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/564.png\";s:9:\"away_name\";s:12:\"Başakşehir\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"home_name\";s:11:\"Galatasaray\";s:9:\"league_id\";i:203;s:10:\"away_goals\";i:0;s:10:\"detail_url\";s:4:\"/mac\";s:10:\"fixture_id\";i:1394659;s:10:\"home_goals\";i:3;s:10:\"venue_city\";s:8:\"Istanbul\";s:10:\"venue_name\";s:18:\"Rams Park Stadyumu\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:14:\"Match Finished\";s:12:\"status_short\";s:2:\"FT\";s:14:\"match_datetime\";s:16:\"14.03.2026 17:00\";}i:3;a:22:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:1;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:1;}s:8:\"halftime\";a:2:{s:4:\"away\";i:0;s:4:\"home\";i:1;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:40;s:4:\"logo\";s:49:\"https://media.api-sports.io/football/teams/40.png\";s:4:\"name\";s:9:\"Liverpool\";s:6:\"winner\";b:0;}s:4:\"home\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";b:1;}}s:6:\"league\";a:8:{s:2:\"id\";i:2;s:4:\"flag\";N;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/leagues/2.png\";s:4:\"name\";s:21:\"UEFA Champions League\";s:5:\"round\";s:11:\"Round of 16\";s:6:\"season\";i:2025;s:7:\"country\";s:5:\"World\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1528321;s:4:\"date\";s:25:\"2026-03-10T17:45:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";N;s:4:\"city\";s:8:\"Istanbul\";s:4:\"name\";s:9:\"Rams Park\";}s:6:\"status\";a:4:{s:4:\"long\";s:14:\"Match Finished\";s:5:\"extra\";i:6;s:5:\"short\";s:2:\"FT\";s:7:\"elapsed\";i:90;}s:7:\"periods\";a:2:{s:5:\"first\";i:1773164700;s:6:\"second\";i:1773168300;}s:7:\"referee\";s:10:\"J. Manzano\";s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1773164700;}}s:5:\"score\";s:5:\"1 - 0\";s:6:\"result\";s:3:\"win\";s:7:\"away_id\";i:40;s:7:\"home_id\";i:645;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:49:\"https://media.api-sports.io/football/teams/40.png\";s:9:\"away_name\";s:9:\"Liverpool\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"home_name\";s:11:\"Galatasaray\";s:9:\"league_id\";i:2;s:10:\"away_goals\";i:0;s:10:\"detail_url\";s:4:\"/mac\";s:10:\"fixture_id\";i:1528321;s:10:\"home_goals\";i:1;s:10:\"venue_city\";s:8:\"Istanbul\";s:10:\"venue_name\";s:9:\"Rams Park\";s:11:\"league_logo\";s:50:\"https://media.api-sports.io/football/leagues/2.png\";s:11:\"league_name\";s:21:\"UEFA Champions League\";s:11:\"status_long\";s:14:\"Match Finished\";s:12:\"status_short\";s:2:\"FT\";s:14:\"match_datetime\";s:16:\"10.03.2026 17:45\";}i:4;a:22:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";i:1;s:4:\"home\";i:0;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";i:1;s:4:\"home\";i:0;}s:8:\"halftime\";a:2:{s:4:\"away\";i:1;s:4:\"home\";i:0;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";b:1;}s:4:\"home\";a:4:{s:2:\"id\";i:549;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/549.png\";s:4:\"name\";s:10:\"Beşiktaş\";s:6:\"winner\";b:0;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 25\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394651;s:4:\"date\";s:25:\"2026-03-07T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";i:20423;s:4:\"city\";s:8:\"Istanbul\";s:4:\"name\";s:14:\"Tupras Stadium\";}s:6:\"status\";a:4:{s:4:\"long\";s:14:\"Match Finished\";s:5:\"extra\";i:12;s:5:\"short\";s:2:\"FT\";s:7:\"elapsed\";i:90;}s:7:\"periods\";a:2:{s:5:\"first\";i:1772902800;s:6:\"second\";i:1772906400;}s:7:\"referee\";s:20:\"Ozan Ergun, Türkiye\";s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1772902800;}}s:5:\"score\";s:5:\"0 - 1\";s:6:\"result\";s:3:\"win\";s:7:\"away_id\";i:645;s:7:\"home_id\";i:549;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"away_name\";s:11:\"Galatasaray\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/549.png\";s:9:\"home_name\";s:10:\"Beşiktaş\";s:9:\"league_id\";i:203;s:10:\"away_goals\";i:1;s:10:\"detail_url\";s:4:\"/mac\";s:10:\"fixture_id\";i:1394651;s:10:\"home_goals\";i:0;s:10:\"venue_city\";s:8:\"Istanbul\";s:10:\"venue_name\";s:14:\"Tupras Stadium\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:14:\"Match Finished\";s:12:\"status_short\";s:2:\"FT\";s:14:\"match_datetime\";s:16:\"07.03.2026 17:00\";}}s:4:\"meta\";a:4:{s:6:\"source\";s:16:\"sports_snapshots\";s:14:\"snapshot_stale\";b:1;s:7:\"team_id\";i:645;s:6:\"season\";i:2025;}}',1774937524),('cadde1905-cache-page.standings.league_203.season_2025.limit_20','a:3:{s:6:\"status\";s:2:\"ok\";s:5:\"table\";a:18:{i:0;a:12:{s:3:\"won\";i:20;s:4:\"form\";s:5:\"WWWLW\";s:4:\"lost\";i:2;s:4:\"rank\";i:1;s:5:\"drawn\";i:4;s:6:\"played\";i:26;s:6:\"points\";i:64;s:7:\"team_id\";i:645;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"team_name\";s:11:\"Galatasaray\";s:10:\"goals_diff\";i:44;s:14:\"is_galatasaray\";b:1;}i:1;a:12:{s:3:\"won\";i:17;s:4:\"form\";s:5:\"WLWDD\";s:4:\"lost\";i:1;s:4:\"rank\";i:2;s:5:\"drawn\";i:9;s:6:\"played\";i:27;s:6:\"points\";i:60;s:7:\"team_id\";i:611;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/611.png\";s:9:\"team_name\";s:11:\"Fenerbahçe\";s:10:\"goals_diff\";i:33;s:14:\"is_galatasaray\";b:0;}i:2;a:12:{s:3:\"won\";i:18;s:4:\"form\";s:5:\"WWWWW\";s:4:\"lost\";i:3;s:4:\"rank\";i:3;s:5:\"drawn\";i:6;s:6:\"played\";i:27;s:6:\"points\";i:60;s:7:\"team_id\";i:998;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/998.png\";s:9:\"team_name\";s:11:\"Trabzonspor\";s:10:\"goals_diff\";i:24;s:14:\"is_galatasaray\";b:0;}i:3;a:12:{s:3:\"won\";i:15;s:4:\"form\";s:5:\"WWLWW\";s:4:\"lost\";i:5;s:4:\"rank\";i:4;s:5:\"drawn\";i:7;s:6:\"played\";i:27;s:6:\"points\";i:52;s:7:\"team_id\";i:549;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/549.png\";s:9:\"team_name\";s:10:\"Beşiktaş\";s:10:\"goals_diff\";i:18;s:14:\"is_galatasaray\";b:0;}i:4;a:12:{s:3:\"won\";i:12;s:4:\"form\";s:5:\"DLWWW\";s:4:\"lost\";i:8;s:4:\"rank\";i:5;s:5:\"drawn\";i:7;s:6:\"played\";i:27;s:6:\"points\";i:43;s:7:\"team_id\";i:564;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/564.png\";s:9:\"team_name\";s:12:\"Başakşehir\";s:10:\"goals_diff\";i:14;s:14:\"is_galatasaray\";b:0;}i:5;a:12:{s:3:\"won\";i:11;s:4:\"form\";s:5:\"DLDLD\";s:4:\"lost\";i:5;s:4:\"rank\";i:6;s:5:\"drawn\";i:10;s:6:\"played\";i:26;s:6:\"points\";i:43;s:7:\"team_id\";i:994;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/994.png\";s:9:\"team_name\";s:8:\"Göztepe\";s:10:\"goals_diff\";i:10;s:14:\"is_galatasaray\";b:0;}i:6;a:12:{s:3:\"won\";i:8;s:4:\"form\";s:5:\"WLDDL\";s:4:\"lost\";i:7;s:4:\"rank\";i:7;s:5:\"drawn\";i:11;s:6:\"played\";i:26;s:6:\"points\";i:35;s:7:\"team_id\";i:3603;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/3603.png\";s:9:\"team_name\";s:10:\"Samsunspor\";s:10:\"goals_diff\";i:-2;s:14:\"is_galatasaray\";b:0;}i:7;a:12:{s:3:\"won\";i:9;s:4:\"form\";s:5:\"LLWLL\";s:4:\"lost\";i:12;s:4:\"rank\";i:8;s:5:\"drawn\";i:6;s:6:\"played\";i:27;s:6:\"points\";i:33;s:7:\"team_id\";i:7411;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/7411.png\";s:9:\"team_name\";s:11:\"Kocaelispor\";s:10:\"goals_diff\";i:-9;s:14:\"is_galatasaray\";b:0;}i:8;a:12:{s:3:\"won\";i:8;s:4:\"form\";s:5:\"LWDDL\";s:4:\"lost\";i:10;s:4:\"rank\";i:9;s:5:\"drawn\";i:9;s:6:\"played\";i:27;s:6:\"points\";i:33;s:7:\"team_id\";i:3573;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/3573.png\";s:9:\"team_name\";s:12:\"Gaziantep FK\";s:10:\"goals_diff\";i:-10;s:14:\"is_galatasaray\";b:0;}i:9;a:12:{s:3:\"won\";i:6;s:4:\"form\";s:5:\"WDDLL\";s:4:\"lost\";i:8;s:4:\"rank\";i:10;s:5:\"drawn\";i:13;s:6:\"played\";i:27;s:6:\"points\";i:31;s:7:\"team_id\";i:996;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/996.png\";s:9:\"team_name\";s:10:\"Alanyaspor\";s:10:\"goals_diff\";i:1;s:14:\"is_galatasaray\";b:0;}i:10;a:12:{s:3:\"won\";i:7;s:4:\"form\";s:5:\"LWWWD\";s:4:\"lost\";i:10;s:4:\"rank\";i:11;s:5:\"drawn\";i:9;s:6:\"played\";i:26;s:6:\"points\";i:30;s:7:\"team_id\";i:1007;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/1007.png\";s:9:\"team_name\";s:8:\"Rizespor\";s:10:\"goals_diff\";i:-4;s:14:\"is_galatasaray\";b:0;}i:11;a:12:{s:3:\"won\";i:7;s:4:\"form\";s:5:\"WWDLW\";s:4:\"lost\";i:11;s:4:\"rank\";i:12;s:5:\"drawn\";i:9;s:6:\"played\";i:27;s:6:\"points\";i:30;s:7:\"team_id\";i:607;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/607.png\";s:9:\"team_name\";s:9:\"Konyaspor\";s:10:\"goals_diff\";i:-8;s:14:\"is_galatasaray\";b:0;}i:12;a:12:{s:3:\"won\";i:6;s:4:\"form\";s:5:\"LLDDL\";s:4:\"lost\";i:14;s:4:\"rank\";i:13;s:5:\"drawn\";i:7;s:6:\"played\";i:27;s:6:\"points\";i:25;s:7:\"team_id\";i:997;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/997.png\";s:9:\"team_name\";s:21:\"Gençlerbirliği S.K.\";s:10:\"goals_diff\";i:-9;s:14:\"is_galatasaray\";b:0;}i:13;a:12:{s:3:\"won\";i:6;s:4:\"form\";s:5:\"DLLDL\";s:4:\"lost\";i:14;s:4:\"rank\";i:14;s:5:\"drawn\";i:7;s:6:\"played\";i:27;s:6:\"points\";i:25;s:7:\"team_id\";i:1005;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/1005.png\";s:9:\"team_name\";s:11:\"Antalyaspor\";s:10:\"goals_diff\";i:-18;s:14:\"is_galatasaray\";b:0;}i:14;a:12:{s:3:\"won\";i:5;s:4:\"form\";s:5:\"LWDLD\";s:4:\"lost\";i:13;s:4:\"rank\";i:15;s:5:\"drawn\";i:9;s:6:\"played\";i:27;s:6:\"points\";i:24;s:7:\"team_id\";i:1004;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/1004.png\";s:9:\"team_name\";s:11:\"Kasımpaşa\";s:10:\"goals_diff\";i:-15;s:14:\"is_galatasaray\";b:0;}i:15;a:12:{s:3:\"won\";i:4;s:4:\"form\";s:5:\"WLLDW\";s:4:\"lost\";i:12;s:4:\"rank\";i:16;s:5:\"drawn\";i:11;s:6:\"played\";i:27;s:6:\"points\";i:23;s:7:\"team_id\";i:1001;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/1001.png\";s:9:\"team_name\";s:11:\"Kayserispor\";s:10:\"goals_diff\";i:-27;s:14:\"is_galatasaray\";b:0;}i:16;a:12:{s:3:\"won\";i:5;s:4:\"form\";s:5:\"LLLDW\";s:4:\"lost\";i:15;s:4:\"rank\";i:17;s:5:\"drawn\";i:7;s:6:\"played\";i:27;s:6:\"points\";i:22;s:7:\"team_id\";i:3588;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/3588.png\";s:9:\"team_name\";s:9:\"Eyüpspor\";s:10:\"goals_diff\";i:-19;s:14:\"is_galatasaray\";b:0;}i:17;a:12:{s:3:\"won\";i:4;s:4:\"form\";s:5:\"LWDLD\";s:4:\"lost\";i:18;s:4:\"rank\";i:18;s:5:\"drawn\";i:5;s:6:\"played\";i:27;s:6:\"points\";i:17;s:7:\"team_id\";i:3589;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/3589.png\";s:9:\"team_name\";s:18:\"Fatih Karagümrük\";s:10:\"goals_diff\";i:-23;s:14:\"is_galatasaray\";b:0;}}s:4:\"meta\";a:5:{s:6:\"source\";s:16:\"sports_snapshots\";s:14:\"snapshot_stale\";b:1;s:9:\"league_id\";i:203;s:6:\"season\";i:2025;s:5:\"limit\";i:20;}}',1774939281),('cadde1905-cache-widgets:league_table:league:95a9f66464e5','a:10:{i:0;a:12:{s:3:\"won\";i:20;s:4:\"form\";s:5:\"WWWLW\";s:4:\"lost\";i:2;s:4:\"rank\";i:1;s:5:\"drawn\";i:4;s:6:\"played\";i:26;s:6:\"points\";i:64;s:7:\"team_id\";i:645;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"team_name\";s:11:\"Galatasaray\";s:10:\"goals_diff\";i:44;s:14:\"is_galatasaray\";b:1;}i:1;a:12:{s:3:\"won\";i:17;s:4:\"form\";s:5:\"WLWDD\";s:4:\"lost\";i:1;s:4:\"rank\";i:2;s:5:\"drawn\";i:9;s:6:\"played\";i:27;s:6:\"points\";i:60;s:7:\"team_id\";i:611;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/611.png\";s:9:\"team_name\";s:11:\"Fenerbahçe\";s:10:\"goals_diff\";i:33;s:14:\"is_galatasaray\";b:0;}i:2;a:12:{s:3:\"won\";i:18;s:4:\"form\";s:5:\"WWWWW\";s:4:\"lost\";i:3;s:4:\"rank\";i:3;s:5:\"drawn\";i:6;s:6:\"played\";i:27;s:6:\"points\";i:60;s:7:\"team_id\";i:998;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/998.png\";s:9:\"team_name\";s:11:\"Trabzonspor\";s:10:\"goals_diff\";i:24;s:14:\"is_galatasaray\";b:0;}i:3;a:12:{s:3:\"won\";i:15;s:4:\"form\";s:5:\"WWLWW\";s:4:\"lost\";i:5;s:4:\"rank\";i:4;s:5:\"drawn\";i:7;s:6:\"played\";i:27;s:6:\"points\";i:52;s:7:\"team_id\";i:549;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/549.png\";s:9:\"team_name\";s:10:\"Beşiktaş\";s:10:\"goals_diff\";i:18;s:14:\"is_galatasaray\";b:0;}i:4;a:12:{s:3:\"won\";i:12;s:4:\"form\";s:5:\"DLWWW\";s:4:\"lost\";i:8;s:4:\"rank\";i:5;s:5:\"drawn\";i:7;s:6:\"played\";i:27;s:6:\"points\";i:43;s:7:\"team_id\";i:564;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/564.png\";s:9:\"team_name\";s:12:\"Başakşehir\";s:10:\"goals_diff\";i:14;s:14:\"is_galatasaray\";b:0;}i:5;a:12:{s:3:\"won\";i:11;s:4:\"form\";s:5:\"DLDLD\";s:4:\"lost\";i:5;s:4:\"rank\";i:6;s:5:\"drawn\";i:10;s:6:\"played\";i:26;s:6:\"points\";i:43;s:7:\"team_id\";i:994;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/994.png\";s:9:\"team_name\";s:8:\"Göztepe\";s:10:\"goals_diff\";i:10;s:14:\"is_galatasaray\";b:0;}i:6;a:12:{s:3:\"won\";i:8;s:4:\"form\";s:5:\"WLDDL\";s:4:\"lost\";i:7;s:4:\"rank\";i:7;s:5:\"drawn\";i:11;s:6:\"played\";i:26;s:6:\"points\";i:35;s:7:\"team_id\";i:3603;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/3603.png\";s:9:\"team_name\";s:10:\"Samsunspor\";s:10:\"goals_diff\";i:-2;s:14:\"is_galatasaray\";b:0;}i:7;a:12:{s:3:\"won\";i:9;s:4:\"form\";s:5:\"LLWLL\";s:4:\"lost\";i:12;s:4:\"rank\";i:8;s:5:\"drawn\";i:6;s:6:\"played\";i:27;s:6:\"points\";i:33;s:7:\"team_id\";i:7411;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/7411.png\";s:9:\"team_name\";s:11:\"Kocaelispor\";s:10:\"goals_diff\";i:-9;s:14:\"is_galatasaray\";b:0;}i:8;a:12:{s:3:\"won\";i:8;s:4:\"form\";s:5:\"LWDDL\";s:4:\"lost\";i:10;s:4:\"rank\";i:9;s:5:\"drawn\";i:9;s:6:\"played\";i:27;s:6:\"points\";i:33;s:7:\"team_id\";i:3573;s:9:\"team_logo\";s:51:\"https://media.api-sports.io/football/teams/3573.png\";s:9:\"team_name\";s:12:\"Gaziantep FK\";s:10:\"goals_diff\";i:-10;s:14:\"is_galatasaray\";b:0;}i:9;a:12:{s:3:\"won\";i:6;s:4:\"form\";s:5:\"WDDLL\";s:4:\"lost\";i:8;s:4:\"rank\";i:10;s:5:\"drawn\";i:13;s:6:\"played\";i:27;s:6:\"points\";i:31;s:7:\"team_id\";i:996;s:9:\"team_logo\";s:50:\"https://media.api-sports.io/football/teams/996.png\";s:9:\"team_name\";s:10:\"Alanyaspor\";s:10:\"goals_diff\";i:1;s:14:\"is_galatasaray\";b:0;}}',1774998349),('cadde1905-cache-widgets:next_match:team:1e07e854680f','a:18:{s:3:\"raw\";a:5:{s:5:\"goals\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:5:\"score\";a:4:{s:7:\"penalty\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"fulltime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:8:\"halftime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}s:9:\"extratime\";a:2:{s:4:\"away\";N;s:4:\"home\";N;}}s:5:\"teams\";a:2:{s:4:\"away\";a:4:{s:2:\"id\";i:645;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:4:\"name\";s:11:\"Galatasaray\";s:6:\"winner\";N;}s:4:\"home\";a:4:{s:2:\"id\";i:998;s:4:\"logo\";s:50:\"https://media.api-sports.io/football/teams/998.png\";s:4:\"name\";s:11:\"Trabzonspor\";s:6:\"winner\";N;}}s:6:\"league\";a:8:{s:2:\"id\";i:203;s:4:\"flag\";s:40:\"https://media.api-sports.io/flags/tr.svg\";s:4:\"logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:4:\"name\";s:10:\"Süper Lig\";s:5:\"round\";s:19:\"Regular Season - 28\";s:6:\"season\";i:2025;s:7:\"country\";s:6:\"Turkey\";s:9:\"standings\";b:1;}s:7:\"fixture\";a:8:{s:2:\"id\";i:1394684;s:4:\"date\";s:25:\"2026-04-05T17:00:00+00:00\";s:5:\"venue\";a:3:{s:2:\"id\";i:20189;s:4:\"city\";s:7:\"Trabzon\";s:4:\"name\";s:11:\"Papara Park\";}s:6:\"status\";a:4:{s:4:\"long\";s:11:\"Not Started\";s:5:\"extra\";N;s:5:\"short\";s:2:\"NS\";s:7:\"elapsed\";N;}s:7:\"periods\";a:2:{s:5:\"first\";N;s:6:\"second\";N;}s:7:\"referee\";N;s:8:\"timezone\";s:3:\"UTC\";s:9:\"timestamp\";i:1775408400;}}s:7:\"away_id\";i:645;s:7:\"home_id\";i:998;s:7:\"is_live\";b:0;s:9:\"away_logo\";s:50:\"https://media.api-sports.io/football/teams/645.png\";s:9:\"away_name\";s:11:\"Galatasaray\";s:9:\"home_logo\";s:50:\"https://media.api-sports.io/football/teams/998.png\";s:9:\"home_name\";s:11:\"Trabzonspor\";s:9:\"league_id\";i:203;s:10:\"detail_url\";s:4:\"/mac\";s:10:\"fixture_id\";i:1394684;s:10:\"venue_city\";s:7:\"Trabzon\";s:10:\"venue_name\";s:11:\"Papara Park\";s:11:\"league_logo\";s:52:\"https://media.api-sports.io/football/leagues/203.png\";s:11:\"league_name\";s:10:\"Süper Lig\";s:11:\"status_long\";s:11:\"Not Started\";s:12:\"status_short\";s:2:\"NS\";s:14:\"match_datetime\";s:16:\"05.04.2026 17:00\";}',1774995649),('cadde1905-cache-widgets:on_this_day:global:717a8b3af6aa','a:3:{s:5:\"title\";s:15:\"Tarihten Bir An\";s:8:\"strategy\";s:13:\"fallback_past\";s:4:\"item\";a:5:{s:5:\"title\";s:41:\"Ağları Yırtan Gol (Metin Oktay - 1959)\";s:4:\"slug\";s:34:\"aglari-yirtan-gol-metin-oktay-1959\";s:3:\"url\";s:68:\"http://localhost:8080/miras/anlar/aglari-yirtan-gol-metin-oktay-1959\";s:4:\"year\";i:1959;s:7:\"excerpt\";s:160:\"Anın Özeti: Fenerbahçe ile oynanan Türkiye Şampiyonluğu finalinde, \"Taçsız Kral\" Metin Oktay’ın vuruşunda topun ağları delip dışarı çıkması.\";}}',1774908390),('cadde1905-cache-widgets:on_this_day:global:fe78a0183fd0','a:3:{s:5:\"title\";s:15:\"Tarihten Bir An\";s:8:\"strategy\";s:13:\"fallback_past\";s:4:\"item\";a:5:{s:5:\"title\";s:41:\"Ağları Yırtan Gol (Metin Oktay - 1959)\";s:4:\"slug\";s:34:\"aglari-yirtan-gol-metin-oktay-1959\";s:3:\"url\";s:68:\"http://localhost:8080/miras/anlar/aglari-yirtan-gol-metin-oktay-1959\";s:4:\"year\";i:1959;s:7:\"excerpt\";s:160:\"Anın Özeti: Fenerbahçe ile oynanan Türkiye Şampiyonluğu finalinde, \"Taçsız Kral\" Metin Oktay’ın vuruşunda topun ağları delip dışarı çıkması.\";}}',1774998350),('cadde1905-cache-widgets:popular_content:global:8af9b00334ff','a:3:{i:0;a:5:{s:2:\"id\";i:28;s:5:\"title\";s:40:\"Galatasaray 2025-2026 Sezonu Panoraması\";s:4:\"slug\";s:44:\"galatasaray-2025-2026-sezonu-panoramasi-test\";s:10:\"image_path\";s:90:\"http://localhost:8080/storage/media/news/2026/03/237ebb82-6a2e-4385-a71c-766899755b29.webp\";s:12:\"published_at\";s:19:\"2026-03-29 08:59:51\";}i:1;a:5:{s:2:\"id\";i:11;s:5:\"title\";s:60:\"Parçalı Formayı Giymeye Hazır: İlkay Gündoğan Geliyor\";s:4:\"slug\";s:52:\"parcali-formayi-giymeye-hazir-ilkay-gundogan-geliyor\";s:10:\"image_path\";s:90:\"http://localhost:8080/storage/media/news/2026/03/237ebb82-6a2e-4385-a71c-766899755b29.webp\";s:12:\"published_at\";s:19:\"2026-03-23 19:56:54\";}i:2;a:5:{s:2:\"id\";i:12;s:5:\"title\";s:55:\"Durdurulamayan Aslan: Victor Osimhen’den 3 Gol Birden\";s:4:\"slug\";s:51:\"durdurulamayan-aslan-victor-osimhenden-3-gol-birden\";s:10:\"image_path\";s:90:\"http://localhost:8080/storage/media/news/2026/03/f42e0c55-b2ea-4049-befd-f57430e67095.webp\";s:12:\"published_at\";s:19:\"2026-03-23 18:56:54\";}}',1774995650);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `relation_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
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
  `relation_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
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
  `relation_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
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
  `relation_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
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
  `title` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `match_date` date DEFAULT NULL,
  `opponent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `competition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score_for` smallint unsigned DEFAULT NULL,
  `score_against` smallint unsigned DEFAULT NULL,
  `result` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historical_matches`
--

LOCK TABLES `historical_matches` WRITE;
/*!40000 ALTER TABLE `historical_matches` DISABLE KEYS */;
INSERT INTO `historical_matches` VALUES (1,'Kopenhag Destanı: UEFA Kupası Şampiyonluğu','kopenhag-destani-uefa-kupasi-sampiyonlugu',1,'2026-03-23 19:56:54','2000-05-17','Arsenal','UEFA Kupası',0,0,'win','Türk futbol tarihinin en büyük başarısı. 120 dakikası nefes kesen, Taffarel’in Henry’nin kafasını çizgiden çıkardığı ve kaptan Bülent Korkmaz’ın çıkık omuzla savaştığı o maç.','Türk futbol tarihinin en büyük başarısı. 120 dakikası nefes kesen, Taffarel’in Henry’nin kafasını çizgiden çıkardığı ve kaptan Bülent Korkmaz’ın çıkık omuzla savaştığı o maç. Penaltılarda Popescu’nun son vuruşuyla gelen kupa, Galatasaray’ın adını dünyaya ezberletti.',100,1,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(2,'Süper Kupa Bizim: Dünyanın En Büyüğü Cimbom!','super-kupa-bizim-dunyanin-en-buyugu-cimbom',1,'2026-03-22 19:56:54','2000-08-25','Real Madrid','UEFA Süper Kupa',2,1,'win','Monaco’da dünyanın zirvesine çıkılan gece.','Monaco’da Şampiyonlar Ligi şampiyonu Real Madrid’e karşı verilen muazzam mücadele. Mario Jardel’in uzatmalarda attığı \"Altın Gol\", Galatasaray’ı Avrupa’nın ve dünyanın zirvesine taşıdı. Los Galacticos’un dize geldiği o gece unutulmazlar arasında.',99,1,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(3,'Ali Sami Yen’de Mucize: UEFA Yolu Açılıyor','ali-sami-yende-mucize-uefa-yolu-aciliyor',1,'2026-03-21 19:56:54','1999-11-03','AC Milan','Şampiyonlar Ligi',3,2,'win','Son dakikalarda gelen tarihi geri dönüş.','Şampiyonlar Ligi grubunda son dakikalara 2-1 geride giren Galatasaray, 87\'de Hakan Şükür ve 90\'da Ümit Davala’nın penaltısıyla maçı 3-2 kazandı. Bu galibiyet takımı UEFA Kupası\'na gönderdi ve Kopenhag’a giden o efsanevi yolun ilk taşı döşendi.',95,1,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(4,'Old Trafford’da Tarih Yazıldı: \"Cehenneme Hoş Geldiniz\"','old-traffordda-tarih-yazildi-cehenneme-hos-geldiniz',1,'2026-03-20 19:56:54','1993-10-20','Manchester United','Şampiyonlar Ligi',3,3,'draw','Old Trafford’da geri dönüşle yazılan tarih.','Manchester United deplasmanında 2-0 geriye düşen Aslan, Arif Erdem ve Kubilay Türkyılmaz’ın (2) golleriyle 3-3\'ü yakaladı. İstanbul’daki 0-0\'lık rövanşla bir dev elendi ve Galatasaray, Şampiyonlar Ligi formatında gruplara kalan ilk Türk takımı oldu.',94,1,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(5,'Karanlıkta Parlayan Kupa: Kadıköy Şampiyonluğu','karanlikta-parlayan-kupa-kadikoy-sampiyonlugu',1,'2026-03-19 19:56:54','2012-05-12','Fenerbahçe','Süper Lig',0,0,'draw','Ezeli rakibin sahasında gelen şampiyonluk.','Süper Final sisteminde şampiyonun belirleneceği son maç ezeli rakibin sahasındaydı. 0-0 biten maçın ardından Galatasaray, Fenerbahçe’nin stadında kupayı havaya kaldırdı. Stat ışıkları kapatılsa da sarı-kırmızılıların zaferi tüm Türkiye’yi aydınlattı.',96,1,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(6,'Drogba ve Sneijder’den Madrid’e Kabus','drogba-ve-sneijderden-madride-kabus',1,'2026-03-18 19:56:54','2013-04-09','Real Madrid','Şampiyonlar Ligi',3,2,'win','Tur geçilemese de Avrupa’yı sallayan rövanş.','Şampiyonlar Ligi çeyrek final rövanşında Real Madrid karşısında 1-0 geriye düşen Galatasaray; Eboue, Sneijder ve Drogba’nın golleriyle skoru 3-1’e getirdi. Tur geçilemese de Jose Mourinho’nun ekibine yaşatılan o 15 dakikalık korku, Avrupa basınının manşetlerini süsledi.',88,0,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(7,'Karlar İçinden Gelen Zafer: Sneijder’in İmzası','karlar-icinden-gelen-zafer-sneijderin-imzasi',1,'2026-03-17 19:56:54','2013-12-11','Juventus','Şampiyonlar Ligi',1,0,'win','Karlar altında gelen unutulmaz galibiyet.','Kar yağışı nedeniyle ertelenen ve ertesi gün devam eden \"buzdan maç\". 85. dakikada Wesley Sneijder’in Buffon’u avladığı çapraz vuruş, Juventus’u elerken Galatasaray’ı Şampiyonlar Ligi’nde son 16 turuna taşıdı.',87,0,NULL,'2026-03-23 19:56:54','2026-03-30 08:57:52',1),(8,'3-0\'ın Rövanşında 5-0\'lık İnanılmaz Geri Dönüş','3-0in-rovansinda-5-0lik-inanilmaz-geri-donus',1,'2026-03-16 19:56:54','1988-11-09','Neuchâtel Xamax','Avrupa Kupası',5,0,'win','İmkansızı başaran ilk büyük Avrupa mucizesi.','İlk maçı deplasmanda 3-0 kaybeden Galatasaray, İstanbul’da Tanju Çolak (3) ve Metin Yıldız’ın golleriyle maçı 5-0 kazandı. Bu maç, Türk takımlarının Avrupa\'da \"imkansızı başarabileceğini\" kanıtlayan ilk büyük mucizedir.',98,0,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(9,'Old Trafford’da 30 Yıl Sonra Yeniden!','old-traffordda-30-yil-sonra-yeniden',1,'2026-03-15 19:56:54','2023-10-03','Manchester United','Şampiyonlar Ligi',3,2,'win','Modern dönemde gelen büyük Avrupa gecesi.','<p>3 Ekim 2023 tarihinde oynanan Manchester United ve Galatasaray karşılaşması, Şampiyonlar Ligi tarihine geçen unutulmaz maçlardan biri oldu. Temsilcimiz Galatasaray, İngiltere\'de rakibini mağlup ederek tarihi bir başarıya imza attı.<br><br>Maçın Özeti<br>Şampiyonlar Ligi A Grubu ikinci haftasında Old Trafford Stadı\'nda oynanan mücadele, büyük bir heyecana sahne oldu. Ev sahibi ekip Manchester United, 17. dakikada Hojlund\'un golüyle öne geçti. Galatasaray bu gole 23. dakikada eski bir Crystal Palace oyuncusu olan Wilfried Zaha ile cevap verdi ve ilk yarı 1-1 sona erdi.</p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;manuicardi.jpg&quot;,&quot;filesize&quot;:351633,&quot;height&quot;:1453,&quot;href&quot;:&quot;http://localhost:8080/storage/historical-matches-content/7jMunHeyiGKr5uCYVi9ZJvFVgPSstLMO7d48Vi66.jpg&quot;,&quot;url&quot;:&quot;http://localhost:8080/storage/historical-matches-content/7jMunHeyiGKr5uCYVi9ZJvFVgPSstLMO7d48Vi66.jpg&quot;,&quot;width&quot;:2048}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"http://localhost:8080/storage/historical-matches-content/7jMunHeyiGKr5uCYVi9ZJvFVgPSstLMO7d48Vi66.jpg\"><img src=\"http://localhost:8080/storage/historical-matches-content/7jMunHeyiGKr5uCYVi9ZJvFVgPSstLMO7d48Vi66.jpg\" width=\"2048\" height=\"1453\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">manuicardi.jpg</span> <span class=\"attachment__size\">343.39 KB</span></figcaption></a></figure><br>İkinci yarıda tempo daha da yükseldi. Manchester United, 67. dakikada yine Hojlund ile skor avantajını ele geçirdi. Ancak pes etmeyen sarı kırmızılılar, 71. dakikada Kerem Aktürkoğlu\'nun şık golüyle durumu 2-2\'ye getirdi.<br><br>İcardi ve Galibiyet<br>Maçın kırılma anı 76. dakikada yaşandı. Mertens\'e ceza sahası içinde yapılan müdahale sonrası Galatasaray penaltı kazandı ve Manchester United\'dan Casemiro kırmızı kart görerek oyun dışı kaldı. Penaltı atışını kullanan Mauro Icardi topu dışarı gönderse de, Arjantinli yıldız sadece birkaç dakika sonra kendisini affettirdi. 81. dakikada kaleciyle karşı karşıya kalan Icardi, yaptığı aşırtma vuruşla skoru 3-2 yaptı ve maçın sonucunu belirledi.<br><br>Tarihi Başarı<br>Bu sonuçla Galatasaray, tarihinde ilk kez bir İngiliz takımını deplasmanda mağlup etmeyi başardı. Old Trafford\'daki bu zafer, Türk futbolu ve sarı kırmızılı camia için büyük bir gurur kaynağı oldu.</p>',90,0,NULL,'2026-03-23 19:56:54','2026-03-30 17:50:36',1),(10,'Türkiye Kupası Finalinde Tarihi Skor','turkiye-kupasi-finalinde-tarihi-skor',1,'2026-03-14 19:56:54','2005-05-11','Fenerbahçe','Türkiye Kupası',5,1,'win','Derbi finalleri tarihine geçen farklı zafer.','Atatürk Olimpiyat Stadı\'ndaki kupa finalinde Galatasaray, ezeli rakibi Fenerbahçe\'yi Ribery, Necati Ateş ve Hakan Şükür\'ün (3) golleriyle 5-1 mağlup etti. Bu skor, derbi finalleri tarihindeki en farklı galibiyetlerden biri olarak kayıtlara geçti.',86,0,NULL,'2026-03-23 19:56:54','2026-03-29 22:18:39',1);
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
  `relation_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
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
INSERT INTO `history_event_legend` VALUES (1,1,2,1,'main_subject',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(2,3,7,1,'main_subject',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(3,4,3,1,'associated',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(4,4,4,0,'associated',NULL,1,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(5,4,5,0,'associated',NULL,2,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(6,5,3,0,'associated',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(7,6,6,0,'associated',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(8,10,10,1,'main_subject',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54');
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
  `relation_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
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
INSERT INTO `history_event_season_archive` VALUES (1,1,1,0,NULL,NULL,0,'2026-03-14 04:30:38','2026-03-14 04:30:38');
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
  `relation_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
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
INSERT INTO `history_event_trophy` VALUES (1,4,3,1,'won_trophy',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(2,5,4,1,'won_trophy',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(3,11,3,1,'won_trophy',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(4,12,4,1,'won_trophy',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(5,15,1,1,'won_trophy',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(6,17,5,1,'won_trophy',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(7,18,1,1,'won_trophy',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(8,16,8,1,'won_trophy',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(9,20,2,1,'won_trophy',NULL,0,'2026-03-23 19:56:54','2026-03-23 19:56:54');
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
  `title` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'moment',
  `description` text COLLATE utf8mb4_unicode_ci,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `source_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_on_this_day` tinyint(1) NOT NULL DEFAULT '1',
  `on_this_day_month` tinyint unsigned DEFAULT NULL,
  `on_this_day_day` tinyint unsigned DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `importance_score` int NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_canonical` tinyint(1) NOT NULL DEFAULT '1',
  `canonical_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_events`
--

LOCK TABLES `history_events` WRITE;
/*!40000 ALTER TABLE `history_events` DISABLE KEYS */;
INSERT INTO `history_events` VALUES (1,1,1,1959,'1959-01-01',NULL,NULL,'Ağları Yırtan Gol (Metin Oktay - 1959)','aglari-yirtan-gol-metin-oktay-1959','moment','Anın Özeti: Fenerbahçe ile oynanan Türkiye Şampiyonluğu finalinde, \"Taçsız Kral\" Metin Oktay’ın vuruşunda topun ağları delip dışarı çıkması.','Anın Özeti: Fenerbahçe ile oynanan Türkiye Şampiyonluğu finalinde, \"Taçsız Kral\" Metin Oktay’ın vuruşunda topun ağları delip dışarı çıkması.','Önemi: Bu an, sadece bir gol değil; Galatasaray asaletinin ve gücünün efsaneleştiği ilk büyük kırılma noktasıdır.',NULL,0,NULL,NULL,1,'2026-03-23 19:56:54',92,1,1,'metin-oktay-net-breaker-1959','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(2,1,1,1989,'1989-01-01',NULL,NULL,'Prekazi’nin Füzeye Dönüşen Serbest Vuruşu (1989)','prekazinin-fuzeye-donusen-serbest-vurusu-1989','moment','Anın Özeti: Şampiyon Kulüpler Kupası çeyrek finalinde Monaco ağlarına yaklaşık 35 metreden gönderilen o inanılmaz gol.','Anın Özeti: Şampiyon Kulüpler Kupası çeyrek finalinde Monaco ağlarına yaklaşık 35 metreden gönderilen o inanılmaz gol...','Önemi: Spikerin \"Aman Allahım!\" çığlığıyla hafızalara kazınan bu an, Galatasaray’ın Avrupa devlerine kafa tutabileceğini gösteren ilk büyük \"modern\" mucizedir.',NULL,0,NULL,NULL,1,'2026-03-23 19:56:54',90,1,1,'prekazi-free-kick-1989','2026-03-23 19:56:54','2026-03-30 17:50:50',1,1),(3,5,17,2000,'2000-05-17',NULL,NULL,'Taffarel’in Henry’ye \"Dur\" Dediği An (17 Mayıs 2000)','taffarelin-henryye-dur-dedigi-an-17-mayis-2000','moment','Anın Özeti: UEFA Kupası finalinin uzatma dakikalarında Thierry Henry’nin yere çarptırarak vurduğu imkansız kafayı Taffarel’in çizgiden çıkarması.','Anın Özeti: UEFA Kupası finalinin uzatma dakikalarında Thierry Henry’nin yere çarptırarak vurduğu imkansız kafayı Taffarel’in çizgiden çıkarması.','Önemi: Eğer o top içeri girseydi, bugün müzemizde UEFA Kupası olmayabilirdi. Bir kalecinin kaderi değiştirdiği en epik andır.',NULL,1,5,17,1,'2026-03-23 19:56:54',98,1,1,'taffarel-save-henry-2000','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(4,5,17,2000,'2000-05-17',NULL,NULL,'Popescu’nun Son Penaltısı ve Kupa (17 Mayıs 2000)','popescunun-son-penaltisi-ve-kupa-17-mayis-2000','achievement','Anın Özeti: Kopenhag’da penaltı atışlarında topun başına geçen Popescu’nun soğukkanlı vuruşu ve ardından gelen \"Kupa bizim!\" haykırışı.','Anın Özeti: Kopenhag’da penaltı atışlarında topun başına geçen Popescu’nun soğukkanlı vuruşu ve ardından gelen \"Kupa bizim!\" haykırışı.','Önemi: Türk futbolunun kulüpler düzeyindeki en büyük başarısının mühürlendiği, milyonların sokağa döküldüğü andır.',NULL,1,5,17,1,'2026-03-23 19:56:54',100,1,1,'popescu-penalty-2000','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(5,8,25,2000,'2000-08-25',NULL,NULL,'Jardel’in Altın Golüyle Süper Kupa (25 Ağustos 2000)','jardelin-altin-goluyle-super-kupa-25-agustos-2000','achievement','Anın Özeti: Real Madrid karşısında uzatmalarda Fatih Akyel’in ortasına Mario Jardel’in dokunuşu ve maçın bitişi.','Anın Özeti: Real Madrid karşısında uzatmalarda Fatih Akyel’in ortasına Mario Jardel’in dokunuşu ve maçın bitişi.','Önemi: Şampiyonlar Ligi şampiyonunu devirip \"Dünyanın En Büyüğü\" unvanının tescillendiği saniyedir.',NULL,1,8,25,1,'2026-03-23 19:56:54',99,1,1,'jardel-golden-goal-2000','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(6,5,12,2012,'2012-05-12',NULL,NULL,'Kadıköy’de Karanlıkta Kalkan Kupa (12 Mayıs 2012)','kadikoyde-karanlikta-kalkan-kupa-12-mayis-2012','milestone','Anın Özeti: Ezeli rakibin sahasında şampiyonluğun ilan edilmesi ve polisin ışıkları söndürmesine rağmen zifiri karanlıkta kupanın havaya yükselmesi.','Anın Özeti: Ezeli rakibin sahasında şampiyonluğun ilan edilmesi ve polisin ışıkları söndürmesine rağmen zifiri karanlıkta kupanın havaya yükselmesi.','Önemi: Galatasaray tarihinin en büyük psikolojik zaferidir; \"Her yerde şampiyonuz\" mesajının somut halidir.',NULL,1,5,12,1,'2026-03-23 19:56:54',96,1,1,'kadikoy-title-2012','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(7,1,1,2013,'2013-01-01',NULL,NULL,'Drogba’nın Real Madrid’e Attığı Topuk Golü (2013)','drogbanin-real-madride-attigi-topuk-golu-2013','moment','Anın Özeti: Şampiyonlar Ligi çeyrek finalinde Didier Drogba’nın Real Madrid ağlarına gönderdiği o klas topuk golüyle stadın yıkılması.','Anın Özeti: Şampiyonlar Ligi çeyrek finalinde Didier Drogba’nın Real Madrid ağlarına gönderdiği o klas topuk golüyle stadın yıkılması.','Önemi: Galatasaray’ın dünya yıldızlarıyla dünya devlerine diz çöktürdüğü, o efsanevi geri dönüş inancının zirve yaptığı andır.',NULL,0,NULL,NULL,1,'2026-03-23 19:56:54',87,0,1,'drogba-backheel-2013','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(8,12,11,2013,'2013-12-11',NULL,NULL,'Sneijder’in Karda Juventus’u Yıktığı An (11 Aralık 2013)','sneijderin-karda-juventusu-yiktigi-an-11-aralik-2013','moment','Anın Özeti: İki güne yayılan, kar yağışı nedeniyle ertelenen maçın 85. dakikasında Sneijder’in Buffon’u avladığı çapraz vuruş.','Anın Özeti: İki güne yayılan, kar yağışı nedeniyle ertelenen maçın 85. dakikasında Sneijder’in Buffon’u avladığı çapraz vuruş.','Önemi: İtalyan devini saf dışı bırakıp karlar arasından Şampiyonlar Ligi’nde üst tura yürümenin destansı öyküsüdür.',NULL,1,12,11,1,'2026-03-23 19:56:54',88,0,1,'sneijder-juventus-snow-2013','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(9,1,1,2015,'2015-01-01',NULL,NULL,'4. Yıldızın Takıldığı An (2015)','4-yildizin-takildigi-an-2015','achievement','Anın Özeti: Wesley Sneijder’in Beşiktaş’a attığı gol sonrası şampiyonluğun garantilenmesi ve Türkiye’de 4 yıldızı takan ilk takım olma başarısı.','Anın Özeti: Wesley Sneijder’in Beşiktaş’a attığı gol sonrası şampiyonluğun garantilenmesi ve Türkiye’de 4 yıldızı takan ilk takım olma başarısı.','Önemi: Ezeli rekabette \"yıldız\" savaşlarını bitiren ve Galatasaray’ın Türkiye’deki hükümdarlığını kanıtlayan andır.',NULL,0,NULL,NULL,1,'2026-03-23 19:56:54',89,1,1,'fourth-star-2015','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(10,10,3,2023,'2023-10-03',NULL,NULL,'Icardi’nin Şampiyonlar Ligi’nde Old Trafford’u Susturuşu (2023)','icardinin-old-traffordu-susturusu-2023','moment','Anın Özeti: Manchester United deplasmanında penaltı kaçırmasına rağmen pes etmeyen Icardi’nin, kalecinin üzerinden aşırttığı golle maçı 3-2’ye getirmesi.','Anın Özeti: Manchester United deplasmanında penaltı kaçırmasına rağmen pes etmeyen Icardi’nin, kalecinin üzerinden aşırttığı golle maçı 3-2’ye getirmesi.','Önemi: Galatasaray’ın Avrupa genlerinin 20 yıl sonra bile hala ne kadar canlı olduğunu dünyaya hatırlattığı andır.',NULL,1,10,3,1,'2026-03-23 19:56:54',90,1,1,'icardi-old-trafford-2023','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(11,5,17,2000,'2000-05-17',NULL,NULL,'Namağlup Avrupa Şampiyonu: İlk ve Tek! (2000 UEFA Kupası Şampiyonluğu)','namaglup-avrupa-sampiyonu-ilk-ve-tek-2000','achievement','17 Mayıs 2000\'de Kopenhag\'da Arsenal\'i devirerek kazanılan bu kupa, Türk futbol tarihinin kulüpler bazındaki en büyük başarısıdır.','17 Mayıs 2000\'de Kopenhag\'da Arsenal\'i devirerek kazanılan bu kupa, Türk futbol tarihinin kulüpler bazındaki en büyük başarısıdır.','Şampiyonlar Ligi\'nden elendikten sonra UEFA Kupası\'na dahil olan ve tek bir maç bile kaybetmeden kupayı müzesine götüren Galatasaray, bir Türk takımının Avrupa\'nın zirvesine çıkabileceğini dünyaya kanıtlamıştır.',NULL,1,5,17,1,'2026-03-23 19:56:54',100,1,1,'uefa-cup-title-2000','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(12,8,25,2000,'2000-08-25',NULL,NULL,'Real Madrid’i Deviren \"Dünyanın En Büyüğü\" (2000 UEFA Süper Kupa Şampiyonluğu)','real-madridi-deviren-dunyanin-en-buyugu-2000','achievement','UEFA Kupası şampiyonu Galatasaray ile Şampiyonlar Ligi şampiyonu Real Madrid’in Monaco’daki randevusu.','UEFA Kupası şampiyonu Galatasaray ile Şampiyonlar Ligi şampiyonu Real Madrid’in Monaco’daki randevusu.','Mario Jardel’in \"Altın Gol\"üyle gelen 2-1’lik zafer, Galatasaray’ı o tarihte IFFHS Dünya Kulüpler Sıralaması\'nda 1 numaraya taşımış ve dünyanın en büyük kulübü unvanını tescillemiştir.',NULL,1,8,25,1,'2026-03-23 19:56:54',99,1,1,'uefa-super-cup-title-2000','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(13,1,1,2001,'2001-01-01',NULL,NULL,'İstatistiklerle Kanıtlanmış Dünya Liderliği (2001)','istatistiklerle-kanitlanmis-dunya-liderligi-2001','achievement','Galatasaray, 2001 yılı Ocak ayında IFFHS tarafından yapılan değerlendirmede, dev rakiplerini geride bırakarak dünyanın 1 numaralı kulübü seçilmiştir.','Galatasaray, 2001 yılı Ocak ayında IFFHS tarafından yapılan değerlendirmede, dev rakiplerini geride bırakarak dünyanın 1 numaralı kulübü seçilmiştir.','Bu başarı, bir Türk takımının global ölçekte ulaştığı en yüksek istatistiksel zirvedir.',NULL,0,NULL,NULL,1,'2026-03-23 19:56:54',84,0,1,'iffhs-first-2001','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(14,1,1,1989,'1989-01-01',NULL,NULL,'Avrupa’nın En İyi 4 Takımı Arasında (1989)','avrupanin-en-iyi-4-takimi-arasinda-1989','achievement','Modern Şampiyonlar Ligi formatı öncesinde, Mustafa Denizli yönetimindeki Galatasaray; Neuchâtel Xamax ve Monaco gibi ekipleri eleyerek yarı finale yükselmiştir.','Modern Şampiyonlar Ligi formatı öncesinde, Mustafa Denizli yönetimindeki Galatasaray; Neuchâtel Xamax ve Monaco gibi ekipleri eleyerek yarı finale yükselmiştir.','Steaua Bükreş’e elenilse de bu başarı, Türk futbolunun makus talihini yenen ilk büyük Avrupa yürüyüşüdür.',NULL,0,NULL,NULL,1,'2026-03-23 19:56:54',83,0,1,'europe-semi-1989','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(15,1,1,2015,'2015-01-01',NULL,NULL,'Yıldız Savaşlarının Galibi: İlk 20. Şampiyonluk (2015)','yildiz-savaslarinin-galibi-ilk-20-sampiyonluk-2015','achievement','2014-2015 sezonunda kazandığı şampiyonlukla 20. şampiyonluğa ulaşan Galatasaray, Türkiye\'de göğsüne 4. yıldızı takan ilk kulüp olmuştur.','2014-2015 sezonunda kazandığı şampiyonlukla 20. şampiyonluğa ulaşan Galatasaray, Türkiye\'de göğsüne 4. yıldızı takan ilk kulüp olmuştur.','Bu başarı, Galatasaray\'ın yerel ligdeki mutlak dominasyonunun ve \"ilklerin takımı\" olma geleneğinin bir simgesidir.',NULL,0,NULL,NULL,1,'2026-03-23 19:56:54',86,0,1,'first-fourth-star-2015','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(16,1,1,2024,'2024-01-01',NULL,NULL,'Engelsiz Aslanlar’dan Dünya Dominasyonu','engelsiz-aslanlardan-dunya-dominasyonu','achievement','Galatasaray Tekerlekli Sandalye Basketbol Takımı, kazandığı 5 Şampiyon Kulüpler Kupası ve 4 Kıtalararası Kupa ile bu branşta dünyanın en başarılı takımlarından biri olmuştur.','Galatasaray Tekerlekli Sandalye Basketbol Takımı, kazandığı 5 Şampiyon Kulüpler Kupası ve 4 Kıtalararası Kupa ile bu branşta dünyanın en başarılı takımlarından biri olmuştur.','\"Engelsiz Aslanlar\", sarı-kırmızılı bayrağı amatör branşlarda dünyanın en yüksek kürsüsüne defalarca taşımıştır.',NULL,0,NULL,NULL,1,'2026-03-23 19:56:54',88,1,1,'wheelchair-basketball-dominance','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(17,1,1,2014,'2014-01-01',NULL,NULL,'Sarayın Sultanları Avrupa’nın Zirvesinde (2014)','sarayin-sultanlari-avrupanin-zirvesinde-2014','achievement','2014 yılında Rusya’nın Ekaterinburg kentinde düzenlenen finalde ezeli rakibi Fenerbahçe’yi yenen Galatasaray, EuroLeague Women kupasını kazanan ilk ve tek Türk takımı olmuştur.','2014 yılında Rusya’nın Ekaterinburg kentinde düzenlenen finalde ezeli rakibi Fenerbahçe’yi yenen Galatasaray, EuroLeague Women kupasını kazanan ilk ve tek Türk takımı olmuştur.','Bu başarı, Türk kadın basketbolunun kulüpler bazındaki zirve noktasıdır.',NULL,0,NULL,NULL,1,'2026-03-23 19:56:54',89,1,1,'euroleague-women-2014','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(18,1,1,2000,'2000-01-01',NULL,NULL,'\"Dörtte Dört\" Yapan İlk ve Tek Takım (1996-2000)','dortte-dort-yapan-ilk-ve-tek-takim-1996-2000','achievement','Fatih Terim yönetimindeki Galatasaray, 1996 ile 2000 yılları arasında ligi adeta ambargo altına almıştır.','Fatih Terim yönetimindeki Galatasaray, 1996 ile 2000 yılları arasında ligi adeta ambargo altına almıştır.','Türkiye ligi tarihinde üst üste 4 kez şampiyon olan başka bir takım bulunmamaktadır. Bu seri, 2000 yılındaki UEFA zaferinin yerel ligdeki temelidir.',NULL,0,NULL,NULL,1,'2026-03-23 19:56:54',85,0,1,'four-in-a-row-1996-2000','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(19,1,1,2013,'2013-01-01',NULL,NULL,'Şampiyonlar Ligi’nin \"Abonesi\" ve Çeyrek Finalisti','sampiyonlar-liginin-abonesi-ve-ceyrek-finalisti','achievement','Galatasaray, 2001 ve 2013 yıllarında Şampiyonlar Ligi\'nde son 8 takım arasına kalarak Avrupa\'nın en elit kulüpleriyle kafa kafaya mücadele etmiştir.','Galatasaray, 2001 ve 2013 yıllarında Şampiyonlar Ligi\'nde son 8 takım arasına kalarak Avrupa\'nın en elit kulüpleriyle kafa kafaya mücadele etmiştir.','Real Madrid ve Barcelona gibi devlere karşı alınan galibiyetler, kulübün \"Devler Ligi\"ndeki saygınlığını perçinlemiştir.',NULL,0,NULL,NULL,1,'2026-03-23 19:56:54',81,0,1,'ucl-quarterfinal-tradition','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1),(20,1,1,2024,'2024-01-01',NULL,NULL,'Türkiye’nin Tartışmasız \"Kupa Beyi\"','turkiyenin-tartismasiz-kupa-beyi','achievement','Eleme usulü turnuvalardaki başarısıyla bilinen Galatasaray, Türkiye Kupası’nı müzesine en çok götüren takımdır.','Eleme usulü turnuvalardaki başarısıyla bilinen Galatasaray, Türkiye Kupası’nı müzesine en çok götüren takımdır.','Finallerdeki yüksek kazanma oranı, Galatasaray\'ın \"final oynamayı ve kupa kaldırmayı bilen\" karakterini ortaya koymaktadır.',NULL,0,NULL,NULL,1,'2026-03-23 19:56:54',82,0,1,'cup-lord-18','2026-03-23 19:56:54','2026-03-23 19:56:54',1,1);
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
  `item_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` bigint unsigned NOT NULL,
  `content_key` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starts_at` datetime DEFAULT NULL,
  `ends_at` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
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
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
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
  `name` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `era_start_year` smallint unsigned DEFAULT NULL,
  `era_end_year` smallint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_demo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `legends_slug_unique` (`slug`),
  KEY `legends_era_start_year_index` (`era_start_year`),
  KEY `legends_created_by_foreign` (`created_by`),
  CONSTRAINT `legends_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legends`
--

LOCK TABLES `legends` WRITE;
/*!40000 ALTER TABLE `legends` DISABLE KEYS */;
INSERT INTO `legends` VALUES (1,1,'Ali Sami Yen','ali-sami-yen','1 Numaralı Üye ve Vizyoner','1905 yılında Mektep-i Sultani’de \"Türk olmayan takımları yenmek\" hedefiyle kulübü kuran kişidir.','<p>Turk sporunun en onemli figurlerinden biri olan Ali Sami Yen vefatinin yil donumunde spor camiasi tarafindan buyuk bir saygiyla aniliyor. Galatasaray Spor Kulubu nun bir numarali kurucusu ve Turk futbolunun oncusu olan Ali Sami Yen sadece bir kulup baskani degil ayni zamanda Turk sporunun modernlesme surecinin mimari olarak kabul ediliyor.<br><br>1905 yilinda Galatasaray Lisesi ogrencisiyken arkadaslariyla birlikte kulubu kuran Ali Sami Yen Turk olmayan takimlari yenmek amaciyla yola cikmis ve bu vizyonuyla Turk sporuna uluslararasi bir kimlik kazandirmistir. Kendisi sadece futbol sahasiyla sinirli kalmamis Turkiye Milli Olimpiyat Komitesi baskanligi yapmis ve Turkiye nin ilk milli macinda teknik direktorluk gorevini ustlenmistir.</p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;alisami.jpeg&quot;,&quot;filesize&quot;:43559,&quot;height&quot;:273,&quot;href&quot;:&quot;http://localhost:8080/storage/editor-content/4aouTah8QHscuG9Ctb4gkEKzmVFT6emcNkYMnSQo.jpg&quot;,&quot;url&quot;:&quot;http://localhost:8080/storage/editor-content/4aouTah8QHscuG9Ctb4gkEKzmVFT6emcNkYMnSQo.jpg&quot;,&quot;width&quot;:620}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;caption&quot;:&quot;Ali Sami Yen&quot;,&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpeg\"><a href=\"http://localhost:8080/storage/editor-content/4aouTah8QHscuG9Ctb4gkEKzmVFT6emcNkYMnSQo.jpg\"><img src=\"http://localhost:8080/storage/editor-content/4aouTah8QHscuG9Ctb4gkEKzmVFT6emcNkYMnSQo.jpg\" width=\"620\" height=\"273\"><figcaption class=\"attachment__caption attachment__caption--edited\">Ali Sami Yen</figcaption></a></figure><br>Ali Sami Yen in spor kulturune en buyuk katkilarindan biri de sporun sadece fiziksel bir aktivite degil ayni zamanda bir disiplin ve kultur oldugunu savunmasidir. Turkiye nin ilk spor muzesini kurarak basarilarin kayit altina alinmasini saglamis ve spor kurallarinin Turkcelestirilmesi icin calismalar yurutmustur. Mecidiyekoy de uzun yillar boyunca adini tasiyan stadyum Galatasaray taraftarlari icin bir yuvadan daha fazlasi olan ve sampiyonluklarin kutlandigi tarihi bir mekan olmustur.<br><br>Bugun Turk futbolu ve diger branslarda elde edilen basarilarin temelinde Ali Sami Yen in yuz yildan fazla bir sure once attigi saglam temeller yatmaktadir. Ferikoy deki kabri basinda her yil duzenlenen anma torenleri onun centilmenlik ve rekabet anlayisinin hala ne kadar gecerli oldugunu kanitlamaktadir. Turk sporu Ali Sami Yen in bir asir once ortaya koydugu hedeflerin pesinde kosmaya ve onun mirasini yasatmaya devam ediyor.<br><br>Galatasaray in kurulus yillarindaki diger onemli isimler veya Ali Sami Yen in hayati hakkinda daha fazla bilgi vermemi ister misiniz?</p>',1886,1951,'2026-03-23 19:56:54','2026-03-30 09:35:27',NULL,1),(2,1,'Metin Oktay','metin-oktay','Sadakat ve Zarafetin Sembolü','Attığı goller kadar Galatasaraylılık duruşuyla da efsanedir.','Attığı 608 golle değil, Galatasaraylılık duruşuyla efsanedir. \"Galatasaraylılık bir din gibi bir şeydir\" sözüyle camianın manevi babası olmuştur. Formasına olan aşkı için servetleri reddetmiş, centilmenliğiyle rakip taraftarların bile saygısını kazanmıştır.',1955,1969,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(3,1,'Fatih Terim','fatih-terim','Kazanma Geninin Sahibi','Hem futbolcu hem teknik direktör olarak kulüp tarihinin en çok kupa kazanan ismidir.','<p>Hem futbolcu hem teknik direktör olarak kulüp tarihinin en çok kupa kazanan ismidir. 1996-2000 arasındaki 4 üst üste şampiyonluk ve UEFA Kupası zaferiyle Galatasaray’ı dünya markası yapmıştır. \"Aslan\" hırsının sahadaki temsilcisidir. ...</p>',1996,2022,'2026-03-23 19:56:54','2026-03-30 17:37:13',NULL,1),(4,1,'Gheorghe Hagi','gheorghe-hagi','Tarihin En İyi Yabancısı','Galatasaray formasıyla büyü yapan, 10 numarayı kutsallaştıran isimdir.','<p>Galatasaray formasıyla büyü yapan, 10 numarayı kutsallaştıran isimdir. UEFA Kupası ve Süper Kupa kazanılırken takımın saha içi lideriydi. Uzaktan attığı \"imkansız\" goller ve futbol zekasıyla bir nesle Galatasaraylılığı sevdiren sihirbazdır...</p>',1996,2001,'2026-03-23 19:56:54','2026-03-30 17:51:09',NULL,1),(5,1,'Bülent Korkmaz','bulent-korkmaz','Cesaretin ve Bağlılığın Simgesi','Altyapıdan çıkıp tüm kariyerini Galatasaray’da geçiren büyük kaptandır.','Altyapıdan çıkıp tüm kariyerini Galatasaray’da geçiren, UEFA Kupası finalinde çıkık omuzuyla bandajlı halde savaşan efsanedir. Müzesindeki 29 kupayla dünyanın en çok kupa kazanan oyuncularından biridir. Kulübün sarsılmaz savunma hattıdır.',1987,2005,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(6,1,'Fernando Muslera','fernando-muslera','Modern Zamanların Efsanesi','2011’den bu yana kaleyi koruyan kaptandır.','2011\'den bu yana kaleyi koruyan, kazanılan sayısız şampiyonlukta başrol oynayan kaptandır. Galatasaray tarihinin en çok forma giyen ve en çok kupa kazanan yabancı oyuncusu olarak, sadece yeteneğiyle değil karakteriyle de yaşayan bir efsanedir.',2011,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(7,1,'Claudio Taffarel','claudio-taffarel','Kopenhag Kahramanı','2000 yılındaki Avrupa zaferlerinin gizli kahramanıdır.','2000 yılındaki Avrupa zaferlerinin gizli kahramanıdır. Henry\'nin kafasını çıkardığı o an, kulüp tarihinin yönünü değiştirmiştir. Sempatik tavırları ve kalecilik ekolüyle Florya\'nın ruhuna işlemiş, antrenör olarak da kulübe hizmet etmiştir.',1998,2001,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(8,1,'Cevad Prekazi','cevad-prekazi','Monaco Fatihi','1980’li yılların sonunda Tanju Çolak ile kurduğu ortaklıkla öne çıktı.','1980\'li yılların sonunda Tanju Çolak ile kurduğu ortaklık ve Monaco\'ya attığı o efsanevi frikik golüyle hatırlanır. Galatasaray\'ın Avrupa serüveninin ilk büyük kahramanlarından biridir. O asil sol ayağı, tribünlerin unutamadığı bir melodi gibidir.',1985,1991,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(9,1,'Jupp Derwall','jupp-derwall','Alman Ekolü ve Devrimci','1984 yılında Galatasaray’ın başına geçerek modern futbolu getiren adamdır.','1984 yılında Galatasaray\'ın başına geçerek Türk futboluna profesyonelliği, antrenman metodlarını ve modern futbolu getiren adamdır. 14 yıllık şampiyonluk hasretini bitiren ve bugünkü Avrupa başarılarının temelini atan vizyonerdir.',1984,1987,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(10,1,'Mauro Icardi','mauro-icardi','Yeni Neslin Kahramanı','Sadece iki sezonda attığı kritik gollerle efsaneler arasına adını yazdırdı.','Sadece iki sezonda attığı kritik gollerle ve derbi performansıyla efsaneler arasına adını yazdırdı. Çocukların sevgilisi haline gelen, \"Aşkın Olayım\" şarkısıyla özdeşleşen Arjantinli, 23. ve 24. şampiyonlukların en büyük mimarı olarak tarihe geçti.',2022,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1);
/*!40000 ALTER TABLE `legends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_kind` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned DEFAULT NULL,
  `width` int unsigned DEFAULT NULL,
  `height` int unsigned DEFAULT NULL,
  `duration_seconds` int unsigned DEFAULT NULL,
  `embed_provider` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `embed_url` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poster_path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_text` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checksum` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (7,'237ebb82-6a2e-4385-a71c-766899755b29','image','file','public','media/news/2026/03/237ebb82-6a2e-4385-a71c-766899755b29.webp','GS2.webp','webp','application/octet-stream',54852,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 17:10:53','2026-03-15 17:10:53',NULL),(8,'6bfa4654-fbb5-4c70-a2e4-cf057447f65d','image','file','public','media/news/2026/03/6bfa4654-fbb5-4c70-a2e4-cf057447f65d.webp','galatasaray.webp','webp','application/octet-stream',20786,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 19:18:14','2026-03-20 19:55:38','2026-03-20 19:55:38'),(9,'f42e0c55-b2ea-4049-befd-f57430e67095','image','file','public','media/news/2026/03/f42e0c55-b2ea-4049-befd-f57430e67095.webp','galatasaray.webp','webp','application/octet-stream',20786,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 19:20:32','2026-03-15 19:20:32',NULL),(21,'1a2b9135-35e4-4622-97b2-0cdb31c9adc2','image','file','public','media/news/2026/03/1a2b9135-35e4-4622-97b2-0cdb31c9adc2.webp','galatasaray.webp','webp','application/octet-stream',20786,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 20:34:00','2026-03-15 20:34:00',NULL),(27,'7426ec14-757a-454b-a0cd-5bfaf090ae4f','image','file','public','media/news/2026/03/7426ec14-757a-454b-a0cd-5bfaf090ae4f.jpg','aba9345abb884560bcf2a8f1b39465de.jpeg','jpg','application/octet-stream',54802,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 20:34:00','2026-03-15 20:34:00',NULL),(28,'3195a7d3-4fb0-410c-90ef-eb18c4f26b32','image','file','public','media/news/2026/03/3195a7d3-4fb0-410c-90ef-eb18c4f26b32.jpg','f4ba5e6a4a774d9892dd8b5a2f94c566.jpeg','jpg','application/octet-stream',81676,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 20:34:00','2026-03-15 20:34:00',NULL),(29,'4d79240c-cfb6-4245-87c6-13eb36c73d18','image','file','public','media/news/2026/03/4d79240c-cfb6-4245-87c6-13eb36c73d18.jpg','c77e07c993864823a57a8c44a9637562.jpeg','jpg','application/octet-stream',82054,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 20:34:00','2026-03-15 20:34:00',NULL),(30,'1e863e14-d3fc-4d90-bb7a-94bff534225f','image','file','public','media/news/2026/03/1e863e14-d3fc-4d90-bb7a-94bff534225f.jpg','5fbe7117238c41b3ba8fa3316a53c27d.jpeg','jpg','application/octet-stream',57097,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 20:34:01','2026-03-15 20:34:01',NULL),(31,'f4f6208a-4ec9-415d-a661-35ca10466ae7','image','file','public','media/news/2026/03/f4f6208a-4ec9-415d-a661-35ca10466ae7.jpg','a687e998b2dd4500a1065d982cf1ef0f.jpeg','jpg','application/octet-stream',64716,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 20:34:01','2026-03-15 20:34:01',NULL),(32,'8f4c2abe-751e-45c9-9227-c3954c3a0f00','image','file','public','media/news/2026/03/8f4c2abe-751e-45c9-9227-c3954c3a0f00.jpg','f4ba5e6a4a774d9892dd8b5a2f94c566.jpeg','jpg','application/octet-stream',81676,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 20:38:26','2026-03-15 20:38:26',NULL),(33,'47e8e346-51d5-4707-98b9-cef119026c26','image','file','public','media/news/2026/03/47e8e346-51d5-4707-98b9-cef119026c26.jpg','a687e998b2dd4500a1065d982cf1ef0f.jpeg','jpg','application/octet-stream',64716,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 20:38:26','2026-03-15 20:38:26',NULL),(34,'e0e0db6a-7206-4acc-bbeb-2923b82c7b66','image','file','public','media/news/2026/03/e0e0db6a-7206-4acc-bbeb-2923b82c7b66.jpg','5fbe7117238c41b3ba8fa3316a53c27d.jpeg','jpg','application/octet-stream',57097,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 20:38:26','2026-03-29 13:07:39','2026-03-29 13:07:39'),(35,'6b880f90-606d-4866-a6e7-489f789137f3','image','file','public','media/news/2026/03/6b880f90-606d-4866-a6e7-489f789137f3.jpg','fecc832e39bc4168b8c720fef5b98239.jpeg','jpg','application/octet-stream',45338,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 20:38:27','2026-03-15 20:38:27',NULL),(36,'85cb9631-674b-4028-ba22-2ea860cc16d2','image','file','public','media/news/2026/03/85cb9631-674b-4028-ba22-2ea860cc16d2.jpg','f4ba5e6a4a774d9892dd8b5a2f94c566.jpeg','jpg','application/octet-stream',81676,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 20:56:33','2026-03-15 20:56:33',NULL),(37,'76e8f4b6-c06c-4cbb-8307-d80024bfc225','image','file','public','media/news/2026/03/76e8f4b6-c06c-4cbb-8307-d80024bfc225.jpg','a687e998b2dd4500a1065d982cf1ef0f.jpeg','jpg','application/octet-stream',64716,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 20:56:33','2026-03-15 20:56:33',NULL),(38,'3ffc48e2-9cec-49a7-a0b4-5aebf40b9ca4','image','file','public','media/news/2026/03/3ffc48e2-9cec-49a7-a0b4-5aebf40b9ca4.jpg','5fbe7117238c41b3ba8fa3316a53c27d.jpeg','jpg','application/octet-stream',57097,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-15 20:56:33','2026-03-15 20:56:33',NULL),(44,'9a85791a-5b1a-4966-9664-9681be44bed5','image','file','public','media/history-events/2026/03/9a85791a-5b1a-4966-9664-9681be44bed5.jpg','ELhVUmRWwAEN4_9.jpg','jpg','application/octet-stream',195274,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-16 16:57:33','2026-03-16 16:57:33',NULL),(46,'64dcc771-4713-4ee6-ae86-92f8a4439b7c','image','file','public','media/history-events/2026/03/64dcc771-4713-4ee6-ae86-92f8a4439b7c.jpg','ELhVUmVXUAEx1BY.jpg','jpg','application/octet-stream',151898,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-16 16:57:33','2026-03-16 16:57:33',NULL),(47,'b3251113-90a9-4ad6-9362-98a500181109','image','file','public','media/history-events/2026/03/b3251113-90a9-4ad6-9362-98a500181109.jpg','ELhVUmdXkAI-3Re.jpg','jpg','application/octet-stream',128137,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-16 16:57:33','2026-03-16 16:57:33',NULL),(48,'aada4e91-f661-464b-82cd-74ba686bd4d5','image','file','public','media/history-events/2026/03/aada4e91-f661-464b-82cd-74ba686bd4d5.jpg','ELhVUmNWsAAsOWv.jpg','jpg','application/octet-stream',107362,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-16 16:57:33','2026-03-16 16:57:33',NULL),(49,'6b491750-d573-4aa4-a384-8fd1e09b76d5','image','file','public','media/history-events/2026/03/6b491750-d573-4aa4-a384-8fd1e09b76d5.jpg','Neuchatel_1.jpg','jpg','application/octet-stream',213913,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-16 17:15:49','2026-03-16 17:15:49',NULL),(54,'c1bee3d0-f0c8-44ba-a299-438b4b966377','image','file','public','media/history-events/2026/03/c1bee3d0-f0c8-44ba-a299-438b4b966377.jpg','Neuchatel_4.jpg','jpg','application/octet-stream',143486,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-16 17:31:49','2026-03-16 17:31:49',NULL),(55,'e5844015-1d75-4bb2-853b-2b7204eaf9d2','image','file','public','media/history-events/2026/03/e5844015-1d75-4bb2-853b-2b7204eaf9d2.png','Neuchatel_3.png','png','application/octet-stream',912680,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-16 17:31:49','2026-03-16 17:31:49',NULL),(56,'f3b9c3cf-06c5-40ec-a4e2-440bd71d99d2','image','file','public','media/history-events/2026/03/f3b9c3cf-06c5-40ec-a4e2-440bd71d99d2.jpg','Neuchatel_2.jpg','jpg','application/octet-stream',300153,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-16 17:31:49','2026-03-16 17:31:49',NULL),(57,'b85477e7-7f73-4e9d-bc4b-98161dacdedd','image','file','public','media/history-events/2026/03/b85477e7-7f73-4e9d-bc4b-98161dacdedd.jpg','Neuchatel_4.jpg','jpg','application/octet-stream',143486,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-16 18:22:49','2026-03-16 18:22:49',NULL),(58,'d0a528fc-17d6-4a38-8e44-4af1bfe8894d','image','file','public','media/history-events/2026/03/d0a528fc-17d6-4a38-8e44-4af1bfe8894d.png','Neuchatel_3.png','png','application/octet-stream',912680,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-16 18:22:49','2026-03-16 18:22:49',NULL),(59,'29fdd16c-308a-42a1-ae88-b6663cbdcd2e','image','file','public','media/history-events/2026/03/29fdd16c-308a-42a1-ae88-b6663cbdcd2e.jpg','Neuchatel_2.jpg','jpg','application/octet-stream',300153,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-16 18:22:50','2026-03-16 18:22:50',NULL),(60,'ac5f2e47-11de-4e4e-be11-53a5cacef2d1','image','file','public','media/history-events/2026/03/ac5f2e47-11de-4e4e-be11-53a5cacef2d1.jpg','gstakim.jpeg','jpg','application/octet-stream',73332,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-16 19:27:40','2026-03-16 19:27:40',NULL),(61,'c7a1739b-652c-40ea-96d3-07249cfbb183','image','file','public','media/history-events/2026/03/c7a1739b-652c-40ea-96d3-07249cfbb183.jpg','manunt.jpeg','jpg','application/octet-stream',61532,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-16 19:27:40','2026-03-16 19:27:40',NULL),(63,'7c31053f-d52b-4369-a845-41d06d0a1254','image','file','public','trophies/01KM0G00QDFAGCB17GBYSZZZGX.webp','01KM0G00QDFAGCB17GBYSZZZGX.webp','webp','image/webp',128910,988,556,NULL,NULL,NULL,NULL,'UEFA Cup',NULL,1,NULL,NULL,'2026-03-18 12:51:11','2026-03-18 12:51:11',NULL),(64,'63d3ccd5-24ea-4164-91b1-f7ac12dd8291','image','file','public','legends/01KM0KEA3MBHK77Z3WBP41AHRD.jpg','01KM0KEA3MBHK77Z3WBP41AHRD.jpg','jpg','image/jpeg',28793,369,504,NULL,NULL,NULL,NULL,'Gheorghe Hagi',NULL,1,NULL,NULL,'2026-03-18 13:51:25','2026-03-18 13:51:25',NULL),(65,'a3279a89-3b8f-4c52-a336-21b651d93b8a','image','file','public','historical-matches/01KM0M7A839E8841HY5ZVGYB41.jpg','01KM0M7A839E8841HY5ZVGYB41.jpg','jpg','image/jpeg',81548,640,359,NULL,NULL,NULL,NULL,'Galatasaray 3-2 Real Madrid',NULL,1,NULL,NULL,'2026-03-18 14:05:04','2026-03-18 14:05:04',NULL),(66,'7adc284a-0d8e-4770-9803-92ea04481166','image','file','public','historical-matches/01KM0M7A839E8841HY5ZVGYB41.jpg','01KM0M7A839E8841HY5ZVGYB41.jpg','jpg','image/jpeg',81548,640,359,NULL,NULL,NULL,NULL,'Galatasaray 3-2 Real Madrid',NULL,1,NULL,NULL,'2026-03-18 14:06:05','2026-03-18 14:06:05',NULL),(67,'842654ee-518a-47fe-ab28-a1b3b4c0a361','image','file','public','season-archives/01KM0NJ5GN6R14QCMPZCGQ50AQ.jpeg','01KM0NJ5GN6R14QCMPZCGQ50AQ.jpeg','jpeg','image/jpeg',131773,753,500,NULL,NULL,NULL,NULL,'2012-2013 Sezonu',NULL,1,NULL,NULL,'2026-03-18 14:28:28','2026-03-18 14:28:28',NULL),(68,'7853986b-7288-4e4d-acd7-fa5f62d3ad43','image','file','public','trophies/01KM0XS5DBWQWCS7E7947SY433.webp','01KM0XS5DBWQWCS7E7947SY433.webp','webp','image/webp',128910,988,556,NULL,NULL,NULL,NULL,'UEFA Cup',NULL,1,NULL,NULL,'2026-03-18 16:52:06','2026-03-18 16:52:06',NULL),(69,'9e5c7e30-f9b4-4c87-ac66-22448a4df8bc','image','file','public','legends/01KM10BJMWMHWWSFYK88MDH73K.jpg','01KM10BJMWMHWWSFYK88MDH73K.jpg','jpg','image/jpeg',247031,1200,1735,NULL,NULL,NULL,NULL,'Gheorghe Hagi',NULL,1,NULL,NULL,'2026-03-18 17:37:07','2026-03-18 17:37:07',NULL),(70,'c5770d9b-e436-4dff-a034-13b1336c0119','image','file','public','historical-matches/01KM174TWM746TME1BB10YP1SK.webp','01KM174TWM746TME1BB10YP1SK.webp','webp','image/webp',25838,731,410,NULL,NULL,NULL,NULL,'Galatasaray 3-2 Real Madrid',NULL,1,NULL,NULL,'2026-03-18 19:35:46','2026-03-18 19:35:46',NULL),(71,'b080d9d7-3054-4b1d-a9a0-c434baeb3c90','image','file','public','season-archives/01KM17XWFR5RHK3JFV3ADYQKZN.jpg','01KM17XWFR5RHK3JFV3ADYQKZN.jpg','jpg','image/jpeg',46475,864,486,NULL,NULL,NULL,NULL,'2012-2013 Sezonu',NULL,1,NULL,NULL,'2026-03-18 19:49:27','2026-03-18 19:49:27',NULL),(72,'137f036d-4762-4f84-91b6-5bcfaaf2274d','image','file','public','trophies/01KM36K7HQET14RZCFWGBP03P6.jpg','01KM36K7HQET14RZCFWGBP03P6.jpg','jpg','image/jpeg',416582,864,486,NULL,NULL,NULL,NULL,'UEFA Cup',NULL,1,NULL,NULL,'2026-03-19 14:04:38','2026-03-19 14:04:38',NULL),(73,'9946d791-8e1a-4777-8e08-408dbfa9de49','image','file','public','legends/01KM3GFYS2BBBEW94PETH1QTZ5.jpg','01KM3GFYS2BBBEW94PETH1QTZ5.jpg','jpg','image/jpeg',585678,1080,811,NULL,NULL,NULL,NULL,'Gheorghe Hagi',NULL,1,NULL,NULL,'2026-03-19 16:57:36','2026-03-19 16:57:36',NULL),(74,'b4e45642-a2e0-4380-af16-aa9c32ec08b7','image','file','public','historical-matches/01KM3HVGW7T4G67ACG4D2ANSH8.webp','01KM3HVGW7T4G67ACG4D2ANSH8.webp','webp','image/webp',86452,750,422,NULL,NULL,NULL,NULL,'Galatasaray 3-2 Real Madrid',NULL,1,NULL,NULL,'2026-03-19 17:21:24','2026-03-19 17:21:24',NULL),(75,'b71ad0ae-eec6-40b3-896b-babb64227492','image','file','public','season-archives/01KM3K5YCNV3J60E2VSK9800H1.webp','01KM3K5YCNV3J60E2VSK9800H1.webp','webp','image/webp',27234,725,410,NULL,NULL,NULL,NULL,'2012-2013 Sezonu',NULL,1,NULL,NULL,'2026-03-19 17:44:34','2026-03-19 17:44:34',NULL),(76,'560994ad-b7e5-433a-b8f9-90dff9facd26','image','file','public','season-archives/01KM3K5YCNV3J60E2VSK9800H1.webp','01KM3K5YCNV3J60E2VSK9800H1.webp','webp','image/webp',27234,725,410,NULL,NULL,NULL,NULL,'2012-2013 Sezonu',NULL,1,NULL,NULL,'2026-03-19 17:44:46','2026-03-19 17:44:46',NULL),(85,'1e651809-4f64-4492-bcec-a3ac54087868','image','file','public','media/history-events/2026/03/1e651809-4f64-4492-bcec-a3ac54087868.webp','galatasaray-liverpool-393446.webp','webp','application/octet-stream',79100,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-21 05:58:51','2026-03-21 05:58:51',NULL),(86,'51642381-757c-4ef3-aa6f-cbd67e3f006d','image','file','public','media/history-events/2026/03/51642381-757c-4ef3-aa6f-cbd67e3f006d.jpg','393311.jpg','jpg','application/octet-stream',971694,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-21 05:58:51','2026-03-21 05:58:51',NULL),(87,'06a77907-9703-490a-8714-af9a9c2b1552','image','file','public','media/history-events/2026/03/06a77907-9703-490a-8714-af9a9c2b1552.webp','1762509944075_www-thesun-co-uk-victor-osimhen-galatasaray-s-poses-1036399512-1-3083.webp','webp','application/octet-stream',158678,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-21 05:58:51','2026-03-21 05:58:51',NULL),(88,'3f9d400f-4a0a-4e83-8caf-d730698dc6b9','image','file','public','media/history-events/2026/03/3f9d400f-4a0a-4e83-8caf-d730698dc6b9.jpg','belcika-basini-union-maci-oncesi-yazdi-galatasaray-psg-inter-ve-bayern-munihi-nasil-geride-birakti-8cnn.jpg','jpg','application/octet-stream',258752,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-21 05:58:51','2026-03-21 05:58:51',NULL),(89,'afea37ab-c242-49af-b19a-dc5e7a81428e','image','file','public','media/history-events/2026/03/afea37ab-c242-49af-b19a-dc5e7a81428e.jpg','thumbs_b_c_83134fc879596bb74ce0b1aaf2bcc53b.jpg','jpg','application/octet-stream',352915,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-21 05:58:51','2026-03-21 05:58:51',NULL),(93,'f2a3aa2d-0758-4b62-a073-43812defaf74','image','file','public','media/news/2026/03/f2a3aa2d-0758-4b62-a073-43812defaf74.jpg','millitakim.jpg','jpg','application/octet-stream',355659,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-24 07:53:13','2026-03-24 07:53:13',NULL),(94,'6ae82671-a193-4440-a439-92eb4126c81f','embed','external',NULL,NULL,'Florya’da Milli Ara Mesaisi: Okan Buruk’tan Gençlere Yakın Markaj video',NULL,NULL,NULL,NULL,NULL,NULL,'youtube','https://www.youtube.com/watch?v=QEvNs-SO26s',NULL,NULL,NULL,1,1,1,'2026-03-24 07:53:13','2026-03-24 07:53:13',NULL),(95,'bbed3887-cc0f-4c27-95ed-6ae0b2de1473','embed','external',NULL,NULL,'Florya’da Milli Ara Mesaisi: Okan Buruk’tan Gençlere Yakın Markaj video',NULL,NULL,NULL,NULL,NULL,NULL,'youtube','https://www.youtube.com/watch?v=QEvNs-SO26s',NULL,NULL,NULL,1,1,1,'2026-03-24 09:00:13','2026-03-29 13:12:27','2026-03-29 13:12:27'),(96,'706c6eab-da1f-4fd8-b520-86cd1a06a872','image','file','public','media/news/2026/03/706c6eab-da1f-4fd8-b520-86cd1a06a872.jpg','buyuk-maclarin-golcusu-mauro-icardi-6qns.jpg','jpg','application/octet-stream',181993,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-25 16:44:07','2026-03-25 16:44:07',NULL),(97,'ddfe7565-b3b4-4a5a-b520-546bc4405d29','image','file','public','media/news/2026/03/ddfe7565-b3b4-4a5a-b520-546bc4405d29.webp','osikol.webp','webp','application/octet-stream',28664,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-25 16:47:43','2026-03-25 16:47:43',NULL),(98,'e65cfaae-8885-4c61-9162-c895133fd969','image','file','public','media/news/2026/03/e65cfaae-8885-4c61-9162-c895133fd969.jpg','renato.jpeg','jpg','application/octet-stream',99602,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-25 16:52:39','2026-03-25 16:52:39',NULL),(99,'c63cf658-c387-4476-84dc-5dbaf82e0ba3','image','file','public','media/news/2026/03/c63cf658-c387-4476-84dc-5dbaf82e0ba3.webp','lang.webp','webp','application/octet-stream',66564,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-25 16:59:01','2026-03-25 16:59:01',NULL),(100,'203f71ed-a8b6-4800-9ef6-a107a2f3f8a8','image','file','public','media/history-events/2026/03/203f71ed-a8b6-4800-9ef6-a107a2f3f8a8.jpg','a4784f9e34c044f1b4471616db3dfe77.jpeg','jpg','application/octet-stream',103335,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-27 14:39:50','2026-03-27 14:39:50',NULL),(101,'a8ee0539-aae2-4f03-9475-d77f4367660b','image','file','public','/tmp/phpdjmlgG','phpdjmlgG',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'UEFA Kupası',NULL,1,NULL,NULL,'2026-03-29 12:41:27','2026-03-29 12:42:30','2026-03-29 12:42:30'),(102,'aa7c4744-fffd-4c71-b20e-36436789c3ee','image','file','public','/tmp/phpbfBHkI','phpbfBHkI',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'UEFA Kupası',NULL,1,NULL,NULL,'2026-03-29 12:41:51','2026-03-29 12:47:38','2026-03-29 12:47:38'),(103,'4e718d9f-1a39-47ff-8d09-f8be47667779','image','file','public','/tmp/phpMeHkFI','phpMeHkFI',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'UEFA Kupası',NULL,1,NULL,NULL,'2026-03-29 12:43:14','2026-03-29 13:03:56','2026-03-29 13:03:56'),(104,'10b923b4-e94d-4927-9a72-83eab8477ba2','image','file','public','media/trophies/2026/03/10b923b4-e94d-4927-9a72-83eab8477ba2.jpg','gettyimages-1205432955-2048x2048.jpg','jpg','application/octet-stream',585375,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-29 13:04:29','2026-03-29 13:12:13','2026-03-29 13:12:13'),(105,'92838a93-d5d0-4f6e-a837-5cbb865c82b0','image','file','public','media/trophies/2026/03/92838a93-d5d0-4f6e-a837-5cbb865c82b0.jpg','gettyimages-1205432955-2048x2048.jpg','jpg','application/octet-stream',585375,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-29 13:04:36','2026-03-29 13:04:36',NULL),(106,'52357744-220d-4237-9967-19d11ddbcb81','image','file','public','media/legends/2026/03/52357744-220d-4237-9967-19d11ddbcb81.jpg','alisamiyen.jpg','jpg','application/octet-stream',333333,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-29 13:08:04','2026-03-29 13:08:04',NULL),(107,'c4fd989b-dfc7-416b-929a-25097cf1213f','image','file','public','editor-content/criBjWkRUMsIWl9Lht85Yc9IuqZIw8gGVfuV8ZjH.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2026-03-29 13:31:52','2026-03-29 14:10:44','2026-03-29 14:10:44'),(108,'6103bc58-c274-488c-89d1-9ff5a1e23812','image','file','public','editor-content/UuagQJPl2gbX7HwCueueDImY2GYOwzrKz01min0M.png','UuagQJPl2gbX7HwCueueDImY2GYOwzrKz01min0M.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2026-03-29 14:05:51','2026-03-29 14:05:51',NULL),(109,'5c1b9af3-12a4-41de-a631-f3cc2d207639','image','file','public','editor-content/4aouTah8QHscuG9Ctb4gkEKzmVFT6emcNkYMnSQo.jpg','4aouTah8QHscuG9Ctb4gkEKzmVFT6emcNkYMnSQo.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2026-03-29 16:55:23','2026-03-29 16:55:23',NULL),(110,'a8758c59-4183-4349-a896-ef52564cbd9d','image','file','public','media/historical-matches/2026/03/a8758c59-4183-4349-a896-ef52564cbd9d.webp','manugs.webp','webp','application/octet-stream',336220,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-29 17:19:03','2026-03-29 17:19:03',NULL),(111,'a81801a0-f35b-493c-a7c7-6a148200f1c5','image','file','public','media/historical-matches/2026/03/a81801a0-f35b-493c-a7c7-6a148200f1c5.webp','manugs.webp','webp','application/octet-stream',336220,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-29 17:19:20','2026-03-29 17:19:20',NULL),(112,'97a4633f-142d-480e-858b-2de065309af0','image','file','public','historical-matches-content/7jMunHeyiGKr5uCYVi9ZJvFVgPSstLMO7d48Vi66.jpg','7jMunHeyiGKr5uCYVi9ZJvFVgPSstLMO7d48Vi66.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2026-03-29 17:19:20','2026-03-29 17:19:20',NULL),(113,'91d52c40-c248-41d7-8ded-88bd1a73e197','image','file','public','media/history-events/2026/03/91d52c40-c248-41d7-8ded-88bd1a73e197.webp','kupa-beyi-galatasaray-zafere-19-kez-ulasti-0tvt.webp','webp','application/octet-stream',244274,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-29 18:03:49','2026-03-29 18:03:49',NULL),(114,'7132e1a0-e654-44e2-b600-02c6bf4b5149','image','file','public','media/history-events/2026/03/7132e1a0-e654-44e2-b600-02c6bf4b5149.jpg','islakkayma.jpg','jpg','application/octet-stream',182547,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-29 18:08:41','2026-03-29 18:08:41',NULL),(115,'57f90a9a-62c8-43ee-927b-740688e7d168','image','file','public','media/historical-matches/2026/03/57f90a9a-62c8-43ee-927b-740688e7d168.webp','wesleyjuve.webp','webp','application/octet-stream',89464,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-30 08:57:52','2026-03-30 08:57:52',NULL),(116,'76b55d9c-9298-486b-b9b0-916582cacf2f','embed','external',NULL,NULL,'Karlar İçinden Gelen Zafer: Sneijder’in İmzası video',NULL,NULL,NULL,NULL,NULL,NULL,'youtube','https://www.youtube.com/shorts/gc4w4ezEwyU',NULL,NULL,NULL,1,1,1,'2026-03-30 08:58:27','2026-03-30 09:06:00','2026-03-30 09:06:00'),(117,'a21df67d-f948-4198-86aa-04c3ae454944','embed','external',NULL,NULL,'Karlar İçinden Gelen Zafer: Sneijder’in İmzası video',NULL,NULL,NULL,NULL,NULL,NULL,'youtube','https://www.youtube.com/watch?v=xOxZ4RudYGM',NULL,NULL,NULL,1,1,1,'2026-03-30 09:04:37','2026-03-30 09:06:00','2026-03-30 09:06:00'),(118,'a93d7117-ab4a-4be1-975b-0afa91d66cb1','embed','external',NULL,NULL,'Karlar İçinden Gelen Zafer: Sneijder’in İmzası video',NULL,NULL,NULL,NULL,NULL,NULL,'youtube','https://www.youtube.com/watch?v=xOxZ4RudYGM',NULL,NULL,NULL,1,1,1,'2026-03-30 09:04:41','2026-03-30 09:04:41',NULL),(119,'862d099e-5a47-4b76-9054-bb6486a6ad62','embed','external',NULL,NULL,'Ali Sami Yen video',NULL,NULL,NULL,NULL,NULL,NULL,'youtube','https://www.youtube.com/watch?v=kTpOmhAlzr4',NULL,NULL,NULL,1,1,1,'2026-03-30 09:41:16','2026-03-30 09:41:16',NULL),(120,'b6f1db13-0510-4637-b3f5-4a21cf54cf63','embed','external',NULL,NULL,'Süper Lig video',NULL,NULL,NULL,NULL,NULL,NULL,'youtube','https://www.youtube.com/watch?v=SSBiNtcREd0',NULL,NULL,NULL,1,1,1,'2026-03-30 09:53:30','2026-03-30 09:53:30',NULL),(121,'39538972-fc57-404c-a15e-976867104041','image','file','public','media/legends/2026/03/39538972-fc57-404c-a15e-976867104041.webp','muslera.webp','webp','application/octet-stream',63276,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-30 14:48:38','2026-03-30 14:48:38',NULL),(122,'c2b661ad-3186-47fb-9072-51371d3c8a6c','image','file','public','media/season-archives/2026/03/c2b661ad-3186-47fb-9072-51371d3c8a6c.png','Galatasaray-1986-87-web-1024x700 (Küçük).png','png','application/octet-stream',840379,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-30 14:55:26','2026-03-30 14:55:26',NULL),(123,'75130d3f-7b99-4d32-a2af-4d20e464a50d','image','file','public','media/news/2026/03/75130d3f-7b99-4d32-a2af-4d20e464a50d.jpg','uefaforma.jpg','jpg','application/octet-stream',354834,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-30 15:07:29','2026-03-30 15:07:29',NULL),(124,'d80606a6-4b87-49a9-aae7-52b0ba71d341','image','file','public','media/season-archives/2026/03/d80606a6-4b87-49a9-aae7-52b0ba71d341.jpg','mancini.jpeg','jpg','application/octet-stream',52081,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-03-30 17:11:55','2026-03-30 17:11:55',NULL),(125,'ccbdc1ed-cd93-4056-a0d5-d28b998f133a','embed','external',NULL,NULL,'Türkiye’de Bir İlk: 20. Şampiyonluk ve 4. Yıldız video',NULL,NULL,NULL,NULL,NULL,NULL,'youtube','https://youtu.be/M8N5IJ-hRks?si=9iGTdmtJ1d4rroLT',NULL,NULL,NULL,1,1,1,'2026-03-30 17:11:55','2026-03-30 17:11:55',NULL);
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
  `mediable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mediable_id` bigint unsigned NOT NULL,
  `usage_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `title_override` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `credit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_usage_unique` (`media_id`,`mediable_type`,`mediable_id`,`usage_type`),
  KEY `mediaables_mediable_type_mediable_id_index` (`mediable_type`,`mediable_id`),
  KEY `mediaables_usage_type_index` (`usage_type`),
  KEY `mediaables_sort_order_index` (`sort_order`),
  KEY `mediaables_is_primary_index` (`is_primary`),
  CONSTRAINT `mediaables_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=337 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mediaables`
--

LOCK TABLES `mediaables` WRITE;
/*!40000 ALTER TABLE `mediaables` DISABLE KEYS */;
INSERT INTO `mediaables` VALUES (145,7,'App\\Models\\News',11,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(146,7,'App\\Models\\News',11,'content',0,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(147,9,'App\\Models\\News',11,'content',1,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(148,21,'App\\Models\\News',11,'content',2,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(149,27,'App\\Models\\News',11,'content',3,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(150,28,'App\\Models\\News',11,'content',4,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(151,29,'App\\Models\\News',11,'content',5,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(152,9,'App\\Models\\News',12,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(153,7,'App\\Models\\News',12,'content',0,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(154,9,'App\\Models\\News',12,'content',1,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(155,21,'App\\Models\\News',12,'content',2,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(156,27,'App\\Models\\News',12,'content',3,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(157,28,'App\\Models\\News',12,'content',4,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(158,29,'App\\Models\\News',12,'content',5,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(159,21,'App\\Models\\News',13,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(160,7,'App\\Models\\News',13,'content',0,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(161,9,'App\\Models\\News',13,'content',1,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(162,21,'App\\Models\\News',13,'content',2,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(163,27,'App\\Models\\News',13,'content',3,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(164,28,'App\\Models\\News',13,'content',4,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(165,29,'App\\Models\\News',13,'content',5,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(166,30,'App\\Models\\News',13,'content',6,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(167,31,'App\\Models\\News',13,'content',7,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(168,27,'App\\Models\\News',14,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(169,28,'App\\Models\\News',15,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(170,29,'App\\Models\\News',16,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(171,30,'App\\Models\\News',17,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(172,31,'App\\Models\\News',18,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(173,32,'App\\Models\\News',19,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(175,7,'App\\Models\\News',20,'content',0,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(176,9,'App\\Models\\News',20,'content',1,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(177,21,'App\\Models\\News',20,'content',2,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(178,27,'App\\Models\\News',20,'content',3,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(179,28,'App\\Models\\News',20,'content',4,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(180,29,'App\\Models\\News',20,'content',5,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(182,35,'App\\Models\\Legend',2,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(183,36,'App\\Models\\Legend',3,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(184,37,'App\\Models\\Legend',4,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(185,38,'App\\Models\\Legend',5,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(187,46,'App\\Models\\Legend',7,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(188,47,'App\\Models\\Legend',8,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(189,48,'App\\Models\\Legend',9,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(190,49,'App\\Models\\Legend',10,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(191,54,'App\\Models\\HistoricalMatch',1,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(192,7,'App\\Models\\HistoricalMatch',1,'content',0,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(193,9,'App\\Models\\HistoricalMatch',1,'content',1,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(194,21,'App\\Models\\HistoricalMatch',1,'content',2,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(195,27,'App\\Models\\HistoricalMatch',1,'content',3,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(196,28,'App\\Models\\HistoricalMatch',1,'content',4,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(197,29,'App\\Models\\HistoricalMatch',1,'content',5,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(198,55,'App\\Models\\HistoricalMatch',2,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(199,7,'App\\Models\\HistoricalMatch',2,'content',0,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(200,9,'App\\Models\\HistoricalMatch',2,'content',1,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(201,21,'App\\Models\\HistoricalMatch',2,'content',2,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(202,27,'App\\Models\\HistoricalMatch',2,'content',3,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(203,28,'App\\Models\\HistoricalMatch',2,'content',4,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(204,29,'App\\Models\\HistoricalMatch',2,'content',5,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(205,56,'App\\Models\\HistoricalMatch',3,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(206,57,'App\\Models\\HistoricalMatch',4,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(207,58,'App\\Models\\HistoricalMatch',5,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(208,7,'App\\Models\\HistoricalMatch',5,'content',0,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(209,9,'App\\Models\\HistoricalMatch',5,'content',1,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(210,21,'App\\Models\\HistoricalMatch',5,'content',2,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(211,27,'App\\Models\\HistoricalMatch',5,'content',3,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(212,59,'App\\Models\\HistoricalMatch',6,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(219,63,'App\\Models\\SeasonArchive',1,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(221,65,'App\\Models\\SeasonArchive',3,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(222,66,'App\\Models\\SeasonArchive',4,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(223,67,'App\\Models\\SeasonArchive',5,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(224,68,'App\\Models\\SeasonArchive',6,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(225,69,'App\\Models\\SeasonArchive',7,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(226,70,'App\\Models\\SeasonArchive',8,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(232,72,'App\\Models\\HistoryEvent',2,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(233,73,'App\\Models\\HistoryEvent',3,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(234,7,'App\\Models\\HistoryEvent',3,'content',0,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(235,9,'App\\Models\\HistoryEvent',3,'content',1,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(236,21,'App\\Models\\HistoryEvent',3,'content',2,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(237,27,'App\\Models\\HistoryEvent',3,'content',3,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(238,28,'App\\Models\\HistoryEvent',3,'content',4,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(239,29,'App\\Models\\HistoryEvent',3,'content',5,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(240,74,'App\\Models\\HistoryEvent',4,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(241,7,'App\\Models\\HistoryEvent',4,'content',0,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(242,9,'App\\Models\\HistoryEvent',4,'content',1,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(243,21,'App\\Models\\HistoryEvent',4,'content',2,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(244,27,'App\\Models\\HistoryEvent',4,'content',3,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(245,28,'App\\Models\\HistoryEvent',4,'content',4,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(246,29,'App\\Models\\HistoryEvent',4,'content',5,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(247,75,'App\\Models\\HistoryEvent',5,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(248,7,'App\\Models\\HistoryEvent',5,'content',0,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(249,9,'App\\Models\\HistoryEvent',5,'content',1,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(250,21,'App\\Models\\HistoryEvent',5,'content',2,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(251,27,'App\\Models\\HistoryEvent',5,'content',3,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(252,28,'App\\Models\\HistoryEvent',5,'content',4,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(253,29,'App\\Models\\HistoryEvent',5,'content',5,0,NULL,NULL,NULL,NULL,'2026-03-23 19:56:54','2026-03-23 19:56:54'),(282,86,'App\\Models\\News',21,'cover',0,1,'Florya’da Milli Ara Mesaisi: Okan Buruk’tan Gençlere Yakın Markaj',NULL,NULL,NULL,'2026-03-24 11:04:26','2026-03-24 11:21:44'),(286,86,'App\\Models\\News',22,'gallery',1,0,'test 1',NULL,NULL,NULL,'2026-03-24 16:17:17','2026-03-24 16:17:17'),(287,87,'App\\Models\\News',22,'gallery',0,0,'test 1',NULL,NULL,NULL,'2026-03-24 16:17:17','2026-03-24 16:17:17'),(288,88,'App\\Models\\News',22,'gallery',2,0,'test 1',NULL,NULL,NULL,'2026-03-24 16:17:17','2026-03-24 16:17:17'),(289,94,'App\\Models\\News',21,'video',0,1,'Florya’da Milli Ara Mesaisi: Okan Buruk’tan Gençlere Yakın Markaj',NULL,NULL,NULL,'2026-03-24 17:45:43','2026-03-24 17:45:43'),(292,93,'App\\Models\\News',21,'gallery',4,0,'Florya’da Milli Ara Mesaisi: Okan Buruk’tan Gençlere Yakın Markaj',NULL,NULL,NULL,'2026-03-24 19:12:51','2026-03-24 19:12:51'),(293,88,'App\\Models\\News',21,'gallery',5,0,'Florya’da Milli Ara Mesaisi: Okan Buruk’tan Gençlere Yakın Markaj',NULL,NULL,NULL,'2026-03-24 19:16:14','2026-03-24 19:16:14'),(294,96,'App\\Models\\News',24,'cover',0,1,'Florya\'da Trabzonspor Mesaisi Başladı: Icardi Bilmecesi!',NULL,NULL,NULL,'2026-03-25 16:44:07','2026-03-25 16:44:07'),(295,97,'App\\Models\\News',25,'cover',0,1,'Osimhen’den Kötü Haber: Ameliyat Edildi!',NULL,NULL,NULL,'2026-03-25 16:47:43','2026-03-25 16:47:43'),(296,98,'App\\Models\\News',26,'cover',0,1,'Renato Nhaga A Takım Kadrosuna Dahil Edildi',NULL,NULL,NULL,'2026-03-25 16:52:39','2026-03-25 16:52:39'),(297,99,'App\\Models\\News',27,'cover',0,1,'Noa Lang\'dan Müjde: \"PlayStation Oynayamıyorum Ama Sahadayım!\"',NULL,NULL,NULL,'2026-03-25 16:59:01','2026-03-25 16:59:01'),(298,100,'App\\Models\\HistoryEvent',1,'cover',0,1,'Ağları Yırtan Gol (Metin Oktay - 1959)',NULL,NULL,NULL,'2026-03-27 14:39:50','2026-03-27 14:39:50'),(299,63,'App\\Models\\HistoryEvent',11,'cover',0,1,'Namağlup Avrupa Şampiyonu: İlk ve Tek! (2000 UEFA Kupası Şampiyonluğu)',NULL,NULL,NULL,'2026-03-29 08:10:12','2026-03-29 08:10:12'),(300,7,'App\\Models\\News',28,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-29 08:59:51','2026-03-29 08:59:54'),(305,105,'App\\Models\\Trophy',3,'cover',0,1,'UEFA Kupası',NULL,NULL,NULL,'2026-03-29 13:04:36','2026-03-29 13:04:36'),(306,106,'App\\Models\\Legend',1,'cover',0,1,'Ali Sami Yen',NULL,NULL,NULL,'2026-03-29 13:08:04','2026-03-29 13:08:04'),(309,108,'App\\Models\\Trophy',3,'content',0,0,NULL,NULL,NULL,NULL,'2026-03-29 15:53:04','2026-03-29 15:53:04'),(310,109,'App\\Models\\Legend',1,'content',0,0,NULL,NULL,NULL,NULL,'2026-03-29 16:55:23','2026-03-30 09:41:16'),(312,111,'App\\Models\\HistoricalMatch',9,'cover',0,1,'Old Trafford’da 30 Yıl Sonra Yeniden!',NULL,NULL,NULL,'2026-03-29 17:19:20','2026-03-29 17:19:20'),(313,112,'App\\Models\\HistoricalMatch',9,'content',0,0,NULL,NULL,NULL,NULL,'2026-03-29 17:19:20','2026-03-30 17:50:36'),(316,76,'App\\Models\\SeasonArchive',10,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-29 17:59:39','2026-03-29 17:59:39'),(318,74,'App\\Models\\Trophy',1,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-29 18:00:49','2026-03-29 18:00:49'),(319,112,'App\\Models\\HistoryEvent',10,'cover',0,1,'Icardi’nin Şampiyonlar Ligi’nde Old Trafford’u Susturuşu (2023)',NULL,NULL,NULL,'2026-03-29 18:01:55','2026-03-29 18:01:55'),(320,113,'App\\Models\\HistoryEvent',20,'cover',0,1,'Türkiye’nin Tartışmasız \"Kupa Beyi\"',NULL,NULL,NULL,'2026-03-29 18:03:49','2026-03-29 18:03:49'),(321,114,'App\\Models\\HistoryEvent',6,'cover',0,1,'Kadıköy’de Karanlıkta Kalkan Kupa (12 Mayıs 2012)',NULL,NULL,NULL,'2026-03-29 18:08:41','2026-03-29 18:08:41'),(322,100,'App\\Models\\HistoricalMatch',10,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-29 22:18:39','2026-03-29 22:18:39'),(323,115,'App\\Models\\HistoricalMatch',7,'cover',0,1,'Karlar İçinden Gelen Zafer: Sneijder’in İmzası',NULL,NULL,NULL,'2026-03-30 08:57:52','2026-03-30 08:57:52'),(326,118,'App\\Models\\HistoricalMatch',7,'video',0,1,'Karlar İçinden Gelen Zafer: Sneijder’in İmzası',NULL,NULL,NULL,'2026-03-30 09:04:41','2026-03-30 09:04:41'),(327,119,'App\\Models\\Legend',1,'video',0,1,'Ali Sami Yen',NULL,NULL,NULL,'2026-03-30 09:41:16','2026-03-30 09:41:16'),(328,120,'App\\Models\\Trophy',1,'video',0,1,'Süper Lig',NULL,NULL,NULL,'2026-03-30 09:53:30','2026-03-30 09:53:30'),(329,94,'App\\Models\\SeasonArchive',10,'video',0,1,'100. Yılda En Büyük Cimbom: Okan Buruk ve Rekorlar',NULL,NULL,NULL,'2026-03-30 09:54:50','2026-03-30 09:54:50'),(331,49,'App\\Models\\HistoricalMatch',8,'cover',0,1,NULL,NULL,NULL,NULL,'2026-03-30 14:31:10','2026-03-30 14:31:10'),(332,121,'App\\Models\\Legend',6,'cover',0,1,'Fernando Muslera',NULL,NULL,NULL,'2026-03-30 14:48:38','2026-03-30 14:48:38'),(333,122,'App\\Models\\SeasonArchive',2,'cover',0,1,'Modern Galatasaray\'ın Doğuşu: Jupp Derwall Devrimi',NULL,NULL,NULL,'2026-03-30 14:55:26','2026-03-30 14:55:26'),(334,123,'App\\Models\\News',20,'cover',0,1,'Efsane UEFA Kupası Forması Yeniden Satışta!',NULL,NULL,NULL,'2026-03-30 15:07:29','2026-03-30 15:07:29'),(335,124,'App\\Models\\SeasonArchive',9,'cover',0,1,'Türkiye’de Bir İlk: 20. Şampiyonluk ve 4. Yıldız',NULL,NULL,NULL,'2026-03-30 17:11:55','2026-03-30 17:11:55'),(336,125,'App\\Models\\SeasonArchive',9,'video',0,1,'Türkiye’de Bir İlk: 20. Şampiyonluk ve 4. Yıldız',NULL,NULL,NULL,'2026-03-30 17:11:55','2026-03-30 17:11:55');
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_02_22_181104_add_rank_and_cp_score_to_users_table',1),(5,'2026_02_22_183220_create_categories_table',1),(6,'2026_02_22_183220_create_legends_table',1),(7,'2026_02_22_183221_create_efsane_moments_table',1),(8,'2026_02_22_183221_create_history_events_table',1),(9,'2026_02_22_183222_create_news_table',1),(10,'2026_02_24_000000_add_role_to_users_table',1),(11,'2026_02_24_075258_add_role_to_users_table',1),(12,'2026_02_25_112523_alter_branch_length_on_news_table',1),(13,'2026_02_25_150303_add_status_and_drop_is_published_from_news_table',1),(14,'2026_02_25_181126_create_tags_table',1),(15,'2026_02_25_181127_create_news_tag_table',1),(16,'2026_02_25_183930_create_category_tag_table',1),(17,'2026_02_26_104332_add_is_super_admin_to_users_table',1),(18,'2026_02_27_114940_add_created_by_to_legends_table',1),(19,'2026_02_27_124655_add_created_by_to_history_events',1),(20,'2026_02_27_125100_add_created_by_to_efsane_moments',1),(21,'2026_02_27_131006_drop_legend_id_from_efsane_moments_table',1),(22,'2026_02_27_131044_create_efsane_moment_tag_table',1),(23,'2026_02_27_142602_ensure_type_on_tags_table',1),(24,'2026_02_27_144537_add_type_to_tags_table',2),(25,'2026_02_27_160254_add_fk_created_by_to_content_tables',3),(26,'2026_03_09_210000_create_sports_snapshots_table',4),(27,'2026_03_09_220000_expand_sports_snapshots_for_league_scope',5),(28,'2026_03_13_094118_create_trophies_table',6),(33,'2026_03_13_095358_create_legend_trophy_table',7),(34,'2026_03_13_095859_create_events_table',7),(35,'2026_03_13_100006_create_event_legend_table',7),(36,'2026_03_13_100325_create_event_trophy_table',7),(37,'2026_03_13_101500_add_wave1_fields_to_history_events_table',8),(38,'2026_03_13_121144_create_history_event_legend_table',9),(39,'2026_03_13_170500_create_history_event_trophy_table',10),(41,'2026_03_14_000000_create_historical_matches_table',11),(42,'2026_03_14_000050_create_season_archives_table',12),(43,'2026_03_14_000100_create_historical_match_pivot_tables',12),(44,'2026_03_14_040153_create_season_archive_legend_table',13),(45,'2026_03_14_040154_create_season_archive_trophy_table',13),(46,'2026_03_14_040156_create_history_event_season_archive_table',13),(47,'2026_03_14_000200_create_season_archive_legend_table',1),(48,'2026_03_14_000300_add_metadata_to_history_event_legend_table',14),(49,'2026_03_14_000310_add_sort_order_to_history_event_trophy_table',14),(52,'2026_03_14_211844_create_media_table',15),(53,'2026_03_14_211848_create_mediaables_table',15),(54,'2026_03_17_210000_create_timeline_entries_table',16),(55,'2026_03_19_140247_add_content_to_trophies_table',17),(56,'2026_03_20_000001_add_unique_index_to_timeline_entries',18),(57,'2026_03_21_212800_update_news_status_enum',19),(58,'2026_03_21_183344_drop_can_write_from_users_table',20),(59,'2026_03_22_120000_add_hero_eligible_to_news_table',21),(60,'2026_03_22_120100_create_homepage_hero_overrides_table',21),(61,'2026_03_21_214726_create_archive_items_table',22),(62,'2026_03_23_000001_add_is_demo_to_content_tables',23),(63,'2026_03_25_173345_create_taggables_table',23),(64,'2026_03_25_200000_create_settings_table',24),(65,'2026_03_25_210210_add_is_demo_to_moments_and_archives',25),(66,'2026_03_30_174106_remove_cover_image_path_columns_batch1',26),(67,'2026_03_30_181943_remove_unused_efsane_moment_tables',27),(68,'2026_03_30_193844_remove_unused_archive_items_table',28),(69,'2026_03_30_194322_remove_unused_event_tables',29),(70,'2026_03_31_102558_backfill_news_tag_to_taggables',30),(71,'2026_03_31_102917_backfill_news_tag_to_taggables_retry',31),(72,'2026_03_31_113023_add_is_active_and_can_write_to_users_table',32);
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
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `status` enum('draft','in_review','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (11,2,1,'futbol','Parçalı Formayı Giymeye Hazır: İlkay Gündoğan Geliyor','parcali-formayi-giymeye-hazir-ilkay-gundogan-geliyor','Sarı-kırmızılı camiada beklenen transfer müjdesi sonunda geliyor.','Sarı-kırmızılı camiada beklenen transfer müjdesi sonunda geliyor. Barcelona ve Manchester City kariyerlerinin ardından çocukluk aşkı Galatasaray ile görüşmelere başlayan tecrübeli yıldız İlkay Gündoğan ile prensip anlaşmasına varıldı. Yönetimin, Şampiyonlar Ligi tecrübesiyle orta sahayı orkestra şefi gibi yönetecek olan yıldız oyuncuyu önümüzdeki hafta İstanbul\'a getirmesi bekleniyor.','https://youtu.be/Hmx1fSY6uDE?si=2vRCyIOWUGyNDoI0','2026-03-23 19:56:54','published',1,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(12,2,1,'futbol','Durdurulamayan Aslan: Victor Osimhen’den 3 Gol Birden','durdurulamayan-aslan-victor-osimhenden-3-gol-birden','Süper Lig’in 26. haftasında Kasımpaşa’yı konuk eden Galatasaray, yıldız forvetinin şovuyla kazandı.','Süper Lig’in 26. haftasında Kasımpaşa’yı konuk eden Galatasaray, Nijeryalı süper golcüsü Victor Osimhen’in yıldızlaştığı maçta sahadan 4-1 galip ayrıldı. Maçın ardından tribünlere \"üçlü\" çektiren Osimhen, gol krallığı yarışında rakipleriyle arasındaki farkı açarken, taraftarların sevgisini bir kez daha perçinledi.','https://youtu.be/8hJIvwbM1vQ?si=_Qhh7G9bXiu2x1qK','2026-03-23 18:56:54','published',1,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(13,2,1,'futbol','Şampiyonlar Ligi Çeyrek Finalinde Rakip: Bayern Münih','sampiyonlar-ligi-ceyrek-finalinde-rakip-bayern-munih','Avrupa arenasında dev randevu yaklaşıyor.','<p>UEFA Şampiyonlar Ligi son 16 turunda Portekiz ekibi Porto\'yu eleyerek adını çeyrek finale yazdıran Galatasaray\'ın rakibi belli oldu. Nyon\'da çekilen kurada sarı-kırmızılılar, Alman devi Bayern Münih ile eşleşti. İlk maçın Rams Park\'ta oynanacak olması, İstanbul\'da şimdiden \"Cehennem\" atmosferi hazırlıklarını başlattı...</p>','https://youtu.be/K_Jj4DIYaaE?si=syDZNblZovxwbA7U','2026-03-23 17:56:54','published',1,0,'2026-03-23 19:56:54','2026-03-30 17:50:17',NULL,1),(14,1,1,'genel','Galatasaray Daikin CEV Kupası Yarı Finalinde Avantajı Kaptı','galatasaray-daikin-cev-kupasi-yari-finalinde-avantaji-kapti','Filenin Aslanları finale bir adım daha yaklaştı.','Kadın voleybolunun yükselen değeri Galatasaray Daikin, CEV Kupası yarı final ilk maçında İtalyan rakibini deplasmanda 3-1 mağlup ederek final kapısını araladı. Kaptan İlkin Aydın ve pasör çaprazı Alexia Carutasu’nun muazzam oyunuyla dönen takımımız, Burhan Felek’teki rövanş öncesi taraftarına büyük umut verdi.','https://youtu.be/uGFNuxy4OOc?si=eW7aMHX3m3VbCp0u','2026-03-23 16:56:54','published',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(15,2,1,'futbol','Akademi Meyvelerini Veriyor: 3 Genç Yıldız A Takıma Çıktı','akademi-meyvelerini-veriyor-3-genc-yildiz-a-takima-cikti','Florya’da altyapı devrimi sahaya yansıyor.','Galatasaray Akademisi, teknik direktör Okan Buruk’un raporu doğrultusunda U19 takımından öne çıkan 3 yeteneği (Emirhan, Caner ve Yusuf) profesyonel kadroya dahil etti. \"Florya’nın suyuyla büyüyen\" gençlerin, önümüzdeki kupa maçlarında şans bulması bekleniyor.','https://youtu.be/hmcRnVoE2BE?si=7z2Dph_bj30tDyyE','2026-03-23 15:56:54','published',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(16,3,1,'basketbol','Parkenin Aslanları Derbide Geri Döndü!','parkenin-aslanlari-derbide-geri-dondu','Basketbolda derbi zaferi geldi.','Basketbol Süper Ligi’nin dev derbisinde Galatasaray, deplasmanda geriye düştüğü maçta son periyot performansı ile ezeli rakibini 89-84 mağlup etti. Koç Pozzecco’nun teknik faul sonrası tribünleri ateşlemesi ve takımın savunma direnci, galibiyetin anahtarı oldu.','https://youtu.be/6PU-_xX5wAk?si=oZ_tUS4N99AiATmj','2026-03-23 14:56:54','published',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(17,2,1,'futbol','Icardi’nin Galatasaray Aşkı Bitmiyor: Sosyal Medya Sallandı','icardinin-galatasaray-aski-bitmiyor-sosyal-medya-sallandi','Yıldız oyuncunun paylaşımı taraftarı heyecanlandırdı.','Arjantinli yıldız Mauro Icardi, Instagram hesabından yaptığı \"Burada kendimi evimde hissediyorum, hikaye henüz bitmedi\" paylaşımıyla taraftarı heyecanlandırdı. Sözleşme uzatma sinyali olarak yorumlanan bu paylaşım, dakikalar içinde binlerce beğeni alarak gündeme oturdu.','https://youtu.be/LBv_x4Pv6t8?si=4KGgJhYQUUR5u0YC','2026-03-23 13:56:54','published',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(18,1,1,'genel','Kombineler Tükendi, Maç Günü Gelirlerinde Tarihi Zirve','kombineler-tukendi-mac-gunu-gelirlerinde-tarihi-zirve','Rams Park’ta gelir rekoru kapıda.','Galatasaray yönetimi, 2025-2026 sezonu loca ve kombine gelirlerinin tarihin en yüksek seviyesine ulaştığını açıkladı. Şampiyonlar Ligi ve ligdeki başarılarla birlikte kulübün kasasına giren rakamlar, yeni sezon transfer bütçesinin de habercisi oldu.','https://youtu.be/a2wR1tBCKmQ?si=WyVGz7FPWDQdLxt3','2026-03-23 12:56:54','published',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(19,1,1,'genel','Tekerlekli Sandalye Basketbolda Final-Four Heyecanı Başlıyor','tekerlekli-sandalye-basketbolda-final-four-heyecani-basliyor','Engelsiz Aslanlar Avrupa yolunda.','Dünya şampiyonu unvanlı Galatasaray Fuzul, Avrupa Şampiyonlar Ligi’nde gruplardan lider çıkarak Final-Four’a kalmayı başardı. Nisan ayında düzenlenecek finallerde Aslanlar, 6. kez Avrupa’nın en büyüğü olmak için sahaya çıkacak.','https://youtu.be/mU8GGpoe75s?si=nR50BkkuvcHI91B9','2026-03-23 11:56:54','published',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(20,1,1,'genel','Efsane UEFA Kupası Forması Yeniden Satışta!','efsane-uefa-kupasi-formasi-yeniden-satista','GS Store’da retro çılgınlığı başladı.','Taraftarların yoğun isteği üzerine 2000 yılındaki UEFA şampiyonluğunda giyilen ikonik \"Beyaz Yaka Parçalı\" formanın sınırlı sayıda üretilen retro versiyonu GS Store’larda satışa sunuldu. Mağazalarda uzun kuyruklar oluşurken, online satış sitesi yoğunluktan kısa süreliğine erişime kapandı.','https://youtu.be/C1uhC8EZsmI?si=KBilbB7fYvollDvt','2026-03-23 10:56:54','published',0,0,'2026-03-23 19:56:54','2026-03-23 19:56:54',NULL,1),(21,2,1,NULL,'Florya’da Milli Ara Mesaisi: Okan Buruk’tan Gençlere Yakın Markaj','floryada-milli-ara-mesaisi-okan-buruktan-genclere-yakin-markaj',NULL,'<p><strong>İSTANBUL</strong> – Trendyol Süper Lig’de şampiyonluk yolunda emin adımlarla ilerleyen Galatasaray, milli maçlar nedeniyle lige verilen arayı Florya Metin Oktay Tesisleri’nde yoğun bir tempoyla değerlendiriyor.&nbsp;</p><p>Teknik direktör <strong>Okan Buruk</strong> yönetiminde gerçekleştirilen bugünkü antrenmanda, taktik ağırlıklı çift kale maç ön plana çıktı. Milli takımlara giden 12 oyuncunun eksikliğinde, akademi liglerinden A takıma davet edilen genç yeteneklerin performansı teknik heyetin yüzünü güldürdü.&nbsp; &nbsp;</p>',NULL,'2026-03-24 07:53:13','published',0,0,'2026-03-24 07:53:13','2026-03-24 17:04:35',NULL,1),(24,2,1,NULL,'Florya\'da Trabzonspor Mesaisi Başladı: Icardi Bilmecesi!','floryada-trabzonspor-mesaisi-basladi-icardi-bilmecesi','Şampiyonlar Ligi’ndeki Liverpool serüveninin ardından rotayı tamamen lige kıran Galatasaray, 4 Nisan’daki kritik Trabzonspor derbisinin hazırlıklarına başladı.','<p>Şampiyonlar Ligi’ndeki Liverpool serüveninin ardından rotayı tamamen lige kıran Galatasaray, 4 Nisan’daki kritik <strong>Trabzonspor</strong> derbisinin hazırlıklarına başladı. Takımda en çok merak edilen konu ise antrenmanlarda yer almayan <strong>Mauro Icardi</strong>’nin durumu. Sağlık heyeti, Arjantinli yıldızı derbiye yetiştirmek için yoğun bir mesai harcıyor.</p><p>Teknik direktör Okan Buruk\'un, hücum hattında Osimhen ve Icardi ikilisini aynı anda sahaya sürüp sürmeyeceği taktik idmanlarda netleşecek.</p>',NULL,'2026-03-25 16:42:31','published',0,0,'2026-03-25 16:44:06','2026-03-25 16:44:07',NULL,1),(25,2,1,NULL,'Osimhen’den Kötü Haber: Ameliyat Edildi!','osimhenden-kotu-haber-ameliyat-edildi','Liverpool ile oynanan Şampiyonlar Ligi son 16 turu rövanş maçında talihsiz bir sakatlık yaşayan Victor Osimhen\'den camiayı üzen haber geldi.','<p>Liverpool ile oynanan Şampiyonlar Ligi son 16 turu rövanş maçında talihsiz bir sakatlık yaşayan <strong>Victor Osimhen</strong>\'den camiayı üzen haber geldi. Kolunda kırık tespit edilen Nijeryalı yıldız, başarılı bir operasyon geçirdi. Yıldız golcünün sahalardan en az 4 hafta uzak kalması bekleniyor.</p><p>Trabzonspor derbisinde forma giyemeyecek olan Osimhen\'in yerine forvet hattında tüm sorumluluk Icardi ve takıma yeni ısınan genç yeteneklerin omuzlarında olacak.</p>',NULL,'2026-03-25 16:45:56','published',0,0,'2026-03-25 16:47:43','2026-03-25 16:47:43',NULL,1),(26,2,1,NULL,'Renato Nhaga A Takım Kadrosuna Dahil Edildi','renato-nhaga-a-takim-kadrosuna-dahil-edildi','Liverpool ile oynanan Avrupa maçlarında statü gereği kadroda yer alamayan genç yetenek Renato Nhaga, ligdeki Trabzonspor maçı kafilesine dahil edildi','<p>Liverpool ile oynanan Avrupa maçlarında statü gereği kadroda yer alamayan genç yetenek Renato Nhaga, ligdeki Trabzonspor maçı kafilesine dahil edildi. Antrenman performansıyla Okan Buruk’un gözüne giren genç sol bek, sol bek rotasyonunda rekabeti artıracak.<br><br>Önemli Detay: Genç oyuncunun, milli ara süresince as takım ile çıktığı çift kale maçlardaki enerjisi, teknik heyetten tam not aldı...</p>',NULL,'2026-03-25 16:48:21','published',0,0,'2026-03-25 16:52:38','2026-03-30 17:02:37',NULL,1),(27,2,1,NULL,'Noa Lang\'dan Müjde: \"PlayStation Oynayamıyorum Ama Sahadayım!\"','noa-langdan-mujde-playstation-oynayamiyorum-ama-sahadayim','Liverpool maçında reklam panolarına çarparak parmağından ciddi bir operasyon geçiren Noa Lang, korkutan sakatlığı sonrası ilk kez konuştu.','<p>Liverpool maçında reklam panolarına çarparak parmağından ciddi bir operasyon geçiren <strong>Noa Lang</strong>, korkutan sakatlığı sonrası ilk kez konuştu. Hollandalı yıldız, parmağının yerinde olduğunu ve durumunun iyiye gittiğini esprili bir dille anlattı: <em>\"Şu an PlayStation oynayamıyorum ama futbol oynamak için sadece bacaklarıma ihtiyacım var.\"</em> *&nbsp;</p><p>Kulüp doktoru Yener İnce, yıldız oyuncunun özel bir bandajla Trabzonspor derbisinde sahada olabileceğini doğruladı. Lang, milli takım kampına da davet edildi.&nbsp;</p>',NULL,'2026-03-25 16:54:58','published',0,0,'2026-03-25 16:56:31','2026-03-25 16:59:02',NULL,1),(28,1,1,NULL,'Galatasaray 2025-2026 Sezonu Panoraması','galatasaray-2025-2026-sezonu-panoramasi-test','Galatasaray, 2025-2026 sezonuna hem yerel ligde tarih yazma (5. yıldız) hedefiyle hem de UEFA Şampiyonlar Ligi’nin yeni formatında ses getirme parolasıyla başladı.','<h1>🦁 Galatasaray 2025-2026 Sezonu Panoraması: Beşinci Yıldız ve Avrupa Heyecanı</h1>\n<p><strong>Tarih:</strong> 29 Mart 2026<br />\n<strong>Rapor:</strong> Sezon Sonu Değerlendirmesi ve Mevcut Durum Analizi</p>\n<p>Galatasaray, 2025-2026 sezonuna hem yerel ligde tarih yazma (5. yıldız) hedefiyle hem de UEFA Şampiyonlar Ligi’nin yeni formatında ses getirme parolasıyla başladı. Teknik direktör Okan Buruk yönetimindeki sarı-kırmızılılar, Mart sonu itibarıyla hedeflerine emin adımlarla ilerliyor.</p>\n<hr />\n<h2>🇹🇷 Trendyol Süper Lig: Zirvede Tek Başına</h2>\n<p>Süper Lig\'de sezonun bitimine az bir süre kala Galatasaray, şampiyonluk yarışının en güçlü adayı konumunda. Takım, &quot;25. Şampiyonluk ve 5. Yıldız&quot; motivasyonuyla sahada domine edici bir oyun sergiliyor.</p>\n<ul>\n<li><strong>Puan Durumu:</strong> 26 hafta sonunda toplanan <strong>64 puanla</strong> liderlik koltuğu korunuyor.</li>\n<li><strong>İstatistiksel Üstünlük:</strong> Oynanan maçlarda atılan <strong>62 golle</strong> ligin en golcü takımı olan Cimbom, kalesinde gördüğü sadece <strong>18 golle</strong> savunma disiplininden taviz vermediğini kanıtladı.</li>\n<li><strong>Kritik Eşikler:</strong> Beşiktaş deplasmanında alınan galibiyet ve iç sahadaki Başakşehir zaferi, şampiyonluk yolundaki psikolojik üstünlüğü perçinledi. Şimdi gözler, Nisan sonunda oynanacak ve şampiyonun düğümünü çözecek olan Fenerbahçe derbisinde.</li>\n</ul>\n<hr />\n<h2>🇪🇺 UEFA Şampiyonlar Ligi: Devlerin Arasında Bir Aslan</h2>\n<p>Bu sezon yeni &quot;Lig Formatı&quot; ile oynanan Şampiyonlar Ligi’nde Galatasaray, Türk futbolu adına unutulmaz bir yürüyüş gerçekleştirdi.</p>\n<ul>\n<li><strong>Grup (Lig) Aşaması:</strong> Sezona Frankfurt deplasmanındaki şanssız mağlubiyetle başlansa da, İstanbul\'da devleşen bir Galatasaray izledik. Özellikle <strong>Liverpool karşısında alınan 1-0\'lık galibiyet</strong> ve deplasmandaki <strong>3-0\'lık Ajax zaferi</strong>, Avrupa basınında geniş yankı buldu.</li>\n<li><strong>Play-Off Destanı:</strong> Lig aşamasını geçtikten sonra Play-Off turunda İtalyan devi <strong>Juventus</strong> ile eşleşen sarı-kırmızılılar, İstanbul\'da 5-2\'lik skorla rakibini sahadan sildi ve Son 16 turuna adını yazdırdı.</li>\n<li><strong>Veda:</strong> Son 16 turunda tekrar Liverpool ile eşleşen temsilcimiz, Anfield\'daki rövanşta 4-0 mağlup olarak turnuvaya veda etti. Ancak sergilenen futbol, Galatasaray\'ın Avrupa elitleri arasındaki yerini sağlamlaştırdı.</li>\n</ul>\n<hr />\n<h2>🏆 Ziraat Türkiye Kupası: Çift Kupa Hedefi</h2>\n<p>Galatasaray, rotasyonlu kadrosuyla Türkiye Kupası\'nda da hata yapmadan ilerliyor. Okan Buruk, bu sezonu &quot;Double&quot; (Lig + Kupa) yaparak tamamlamayı hedefliyor.</p>\n<ul>\n<li><strong>Yolculuk:</strong> Grup aşamasında Başakşehir, İstanbulspor ve Alanyaspor gibi zorlu rakipleri geride bırakan takım, grup lideri olarak çeyrek finale yükseldi.</li>\n<li><strong>Sıradaki Rakip:</strong> 22 Nisan 2026 tarihinde oynanacak olan çeyrek final müsabakasında rakip <strong>Gençlerbirliği</strong>. Takımın bu turu da kayıpsız geçerek finale yürümesi bekleniyor.</li>\n</ul>\n<hr />\n<h2>📊 Öne Çıkan Yıldızlar</h2>\n<table>\n<thead>\n<tr>\n<th align=\"left\">Oyuncu</th>\n<th align=\"left\">Performans Notu</th>\n<th align=\"left\">Öne Çıkan Özelliği</th>\n</tr>\n</thead>\n<tbody>\n<tr>\n<td align=\"left\"><strong>Victor Osimhen</strong></td>\n<td align=\"left\">⭐⭐⭐⭐⭐</td>\n<td align=\"left\">Avrupa ve ligde toplam 28 golle takımın sürükleyicisi.</td>\n</tr>\n<tr>\n<td align=\"left\"><strong>Yunus Akgün</strong></td>\n<td align=\"left\">⭐⭐⭐⭐</td>\n<td align=\"left\">Sezonun asist kralı adayı; oyun kurucu rolünde devleşti.</td>\n</tr>\n<tr>\n<td align=\"left\"><strong>Mauro Icardi</strong></td>\n<td align=\"left\">⭐⭐⭐⭐</td>\n<td align=\"left\">Kritik derbi golleri ve liderlik karakteriyle vazgeçilmez.</td>\n</tr>\n<tr>\n<td align=\"left\"><strong>Davinson Sánchez</strong></td>\n<td align=\"left\">⭐⭐⭐⭐⭐</td>\n<td align=\"left\">Savunmanın sigortası; ligin en az gol yiyen defans hattının lideri.</td>\n</tr>\n</tbody>\n</table>\n<hr />\n<p><strong>Sonuç olarak;</strong> Galatasaray 2025-2026 sezonunu hem sportif başarı hem de mali gelir anlamında zirvede tamamlamaya çok yakın. Taraftarlar şimdiden 5. yıldız kutlamaları için hazırlıklara başlamış durumda.</p>\n<blockquote>\n<p>&quot;Galatasaray bir his takımıdır; bu sezon o his zirveye ulaştı.&quot;</p>\n</blockquote>\n<hr />\n<p><strong>Bu analizle ilgili belirli bir oyuncunun detaylı istatistiklerini veya kalan fikstürün zorluk derecesini incelememi ister misin?</strong></p>\n',NULL,'2026-03-29 08:59:51','published',1,0,'2026-03-29 08:59:51','2026-03-29 08:59:51',NULL,0);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
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
INSERT INTO `news_tag` VALUES (21,1),(21,2),(21,3),(21,4),(21,5),(21,6),(21,7),(21,10),(21,11);
/*!40000 ALTER TABLE `news_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `relation_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
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
  `relation_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
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
  `title` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `season_label` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_year` smallint unsigned DEFAULT NULL,
  `end_year` smallint unsigned DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `season_overview` text COLLATE utf8mb4_unicode_ci,
  `league_summary` text COLLATE utf8mb4_unicode_ci,
  `europe_summary` text COLLATE utf8mb4_unicode_ci,
  `cup_summary` text COLLATE utf8mb4_unicode_ci,
  `manager_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `editorial_note` text COLLATE utf8mb4_unicode_ci,
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `season_archives`
--

LOCK TABLES `season_archives` WRITE;
/*!40000 ALTER TABLE `season_archives` DISABLE KEYS */;
INSERT INTO `season_archives` VALUES (1,'Güneşin Doğuşu: Mektep-i Sultani’den Sahalara','1905-kurucu-sezon','1905',1905,1905,1,NULL,'Ali Sami Yen ve arkadaşlarının \"Türk olmayan takımları yenmek\" hedefiyle kulübü kurduğu ilk yıl.','Ali Sami Yen ve arkadaşlarının \"Türk olmayan takımları yenmek\" hedefiyle kulübü kurduğu ilk yıl. Galatasaray’ın asaletinin ve vizyonunun temellerinin atıldığı, Türk spor tarihinin başlangıç noktası sayılan en kritik sezon.','Ali Sami Yen ve arkadaşlarının \"Türk olmayan takımları yenmek\" hedefiyle kulübü kurduğu ilk yıl. Galatasaray’ın asaletinin ve vizyonunun temellerinin atıldığı, Türk spor tarihinin başlangıç noktası sayılan en kritik sezon.','Kuruluş ve ilk örgütlenme dönemi.',NULL,NULL,NULL,NULL,NULL,70,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(2,'Modern Galatasaray\'ın Doğuşu: Jupp Derwall Devrimi','1986-1987-14-yillik-hasretin-sonu','1986-1987',1986,1987,1,NULL,'14 yıllık şampiyonluk özleminin bittiği sezon.','14 yıl süren şampiyonluk özleminin bittiği, Alman ekolüyle tesisleşmenin ve taktiksel disiplinin kulübe girdiği sezon. Bu şampiyonluk, 90\'lı yıllardaki büyük Avrupa yürüyüşünün ilk kıvılcımıdır.','14 yıl süren şampiyonluk özleminin bittiği, Alman ekolüyle tesisleşmenin ve taktiksel disiplinin kulübe girdiği sezon. Bu şampiyonluk, 90\'lı yıllardaki büyük Avrupa yürüyüşünün ilk kıvılcımıdır.','Lig şampiyonluğuyla sonuçlanan dönüş sezonu.',NULL,NULL,'Jupp Derwall',NULL,NULL,84,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(3,'Gençleşme Operasyonu ve \"Kupa Beyi\" Unvanı','1992-1993-feldkamp-ile-gelen-cifte-kupa','1992-1993',1992,1993,1,NULL,'Feldkamp ile yenilenen kadro çifte kupaya uzandı.','Karl-Heinz Feldkamp\'ın takımı baştan aşağı yenilediği, Hakan Şükür gibi gençlerin parladığı sezon. Hem lig hem de Türkiye Kupası\'nın kazanılması, Galatasaray’ın 90\'lı yıllara damga vuracağının habercisiydi.','Karl-Heinz Feldkamp\'ın takımı baştan aşağı yenilediği, Hakan Şükür gibi gençlerin parladığı sezon. Hem lig hem de Türkiye Kupası\'nın kazanılması, Galatasaray’ın 90\'lı yıllara damga vuracağının habercisiydi.','Lig şampiyonluğu ve Türkiye Kupası ile tamamlandı.',NULL,'Çifte kupa.','Karl-Heinz Feldkamp',NULL,NULL,82,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(4,'\"Dörtte Dört\" Serisinin İlk Adımı','1996-1997-fatih-terim-donemi-basliyor','1996-1997',1996,1997,1,NULL,'Fatih Terim dönemi ve büyük serinin başlangıcı...','Fatih Terim’in teknik direktörlüğe gelişi ve Hagi’nin transferiyle başlayan yeni çağ. Bu sezon kazanılan şampiyonluk, Türk futbol tarihinin en büyük dominasyon dönemini başlatan ilk halkadır.','Fatih Terim’in teknik direktörlüğe gelişi ve Hagi’nin transferiyle başlayan yeni çağ. Bu sezon kazanılan şampiyonluk, Türk futbol tarihinin en büyük dominasyon dönemini başlatan ilk halkadır.','Lig zaferiyle yeni çağ açıldı.',NULL,NULL,'Fatih Terim',NULL,NULL,86,0,1,'2026-03-23 19:56:54','2026-03-30 17:51:02',1),(5,'Tarihin Zirvesi: UEFA Kupası ve \"Triple\"','1999-2000-altin-yil-the-golden-season','1999-2000',1999,2000,1,NULL,'Türk futbolunun kulüpler bazında ulaştığı en yüksek sezon.','Galatasaray’ın hem Lig, hem Türkiye Kupası hem de UEFA Kupası\'nı kazanarak \"üçleme\" yaptığı, Türk futbolunun kulüpler bazında ulaştığı en yüksek nokta. Dünyanın Galatasaray\'ı hayranlıkla izlediği efsanevi sezon.','Galatasaray’ın hem Lig, hem Türkiye Kupası hem de UEFA Kupası\'nı kazanarak \"üçleme\" yaptığı, Türk futbolunun kulüpler bazında ulaştığı en yüksek nokta. Dünyanın Galatasaray\'ı hayranlıkla izlediği efsanevi sezon.','Lig şampiyonluğu.','UEFA Kupası ile zirve.','Türkiye Kupası kazanıldı.','Fatih Terim',NULL,NULL,100,1,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(6,'İnancın Zaferi: Denizli’den Gelen Şampiyonluk','2005-2006-16-dakikalik-mucize','2005-2006',2005,2006,1,NULL,'Efsane 16 dakikalık bekleyişin sezonu.','Maddi imkansızlıklara rağmen Eric Gerets yönetiminde sergilenen muazzam performans. Ligin son maçında sahadaki 90 dakika bittikten sonra, şampiyonluk için Denizli’den gelecek haberin beklendiği o efsanevi 16 dakikalık bekleyişin sezonu.','Maddi imkansızlıklara rağmen Eric Gerets yönetiminde sergilenen muazzam performans. Ligin son maçında sahadaki 90 dakika bittikten sonra, şampiyonluk için Denizli’den gelecek haberin beklendiği o efsanevi 16 dakikalık bekleyişin sezonu.','Lig şampiyonluğu mucizeyle geldi.',NULL,NULL,'Eric Gerets',NULL,NULL,84,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(7,'Süper Final ve Karanlıkta Kalkan Kupa','2011-2012-yeniden-dogus-ve-kadikoy-zaferi','2011-2012',2011,2012,1,NULL,'Yıldızlar karmasıyla gelen yeniden doğuş.','Üst üste gelen başarısızlıkların ardından Fatih Terim’in 3. döneminde kurulan \"Yıldızlar Karması\" (Muslera, Selçuk İnan, Elmander, Melo). Ezeli rakibin sahasında ışıklar altında kaldırılan o kupa, kulüp tarihinin en epik şampiyonluk sezonudur.','Üst üste gelen başarısızlıkların ardından Fatih Terim’in 3. döneminde kurulan \"Yıldızlar Karması\" (Muslera, Selçuk İnan, Elmander, Melo). Ezeli rakibin sahasında ışıklar altında kaldırılan o kupa, kulüp tarihinin en epik şampiyonluk sezonudur.','Süper Final ile gelen şampiyonluk.',NULL,NULL,'Fatih Terim',NULL,NULL,95,1,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(8,'Juventus’u Eleyen Aslan ve Şampiyonlar Ligi Çeyrek Finali','2013-2014-avrupada-istikrar-ve-drogba-etkisi','2013-2014',2013,2014,1,NULL,'Dünya yıldızlarıyla gelen Avrupa görünürlüğü.','Dünya yıldızları Drogba ve Sneijder’in takıma gelişi, Juventus’u karlar altında eleyip Şampiyonlar Ligi’nde son 16\'ya kalma başarısı. Galatasaray’ın global bir marka olarak zirve yaptığı modern dönem sezonu.','Dünya yıldızları Drogba ve Sneijder’in takıma gelişi, Juventus’u karlar altında eleyip Şampiyonlar Ligi’nde son 16\'ya kalma başarısı. Galatasaray’ın global bir marka olarak zirve yaptığı modern dönem sezonu.',NULL,'Şampiyonlar Ligi’nde güçlü yürüyüş.',NULL,'Roberto Mancini',NULL,NULL,88,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(9,'Türkiye’de Bir İlk: 20. Şampiyonluk ve 4. Yıldız','2014-2015-4-yildizin-takildigi-yil','2014-2015',2014,2015,1,NULL,'4. yıldızın takıldığı tarihi sezon.','Hamza Hamzaoğlu yönetiminde \"3 Kupa\" ile tamamlanan sezon. Galatasaray’ın Türkiye’de 4. yıldızı göğsüne takan ilk kulüp olarak ezeli rekabette farkı açtığı tarihi dönemeç.','Hamza Hamzaoğlu yönetiminde \"3 Kupa\" ile tamamlanan sezon. Galatasaray’ın Türkiye’de 4. yıldızı göğsüne takan ilk kulüp olarak ezeli rekabette farkı açtığı tarihi dönemeç.','20. şampiyonluk geldi.',NULL,'Türkiye Kupası da kazanıldı.','Hamza Hamzaoğlu',NULL,NULL,90,0,1,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(10,'100. Yılda En Büyük Cimbom: Okan Buruk ve Rekorlar','2022-2023-cumhuriyetin-100-yil-sampiyonlugu-sezonu','2022-2023',2022,2023,1,NULL,'Cumhuriyetin 100. yılında gelen unutulmaz şampiyonluk...','Cumhuriyetin 100. yılında şampiyonluk parolasıyla çıkılan, 14 maçlık galibiyet serisiyle rekorların kırıldığı ve Icardi’nin ikonikleştiği sezon. Bu zafer, kulübün modern çağdaki yükselişinin ve yeni hegemonyasının başlangıcıdır.','Cumhuriyetin 100. yılında şampiyonluk parolasıyla çıkılan, 14 maçlık galibiyet serisiyle rekorların kırıldığı ve Icardi’nin ikonikleştiği sezon. Bu zafer, kulübün modern çağdaki yükselişinin ve yeni hegemonyasının başlangıcıdır.','Lig şampiyonluğu.',NULL,NULL,'Okan Buruk',NULL,NULL,96,1,1,'2026-03-23 19:56:54','2026-03-30 17:02:29',1);
/*!40000 ALTER TABLE `season_archives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `sessions` VALUES ('JGMtmRscJUzfE6bI3UuhIhgZskeJOBm7SZ89uh57',1,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSFk1bTY4RzNKVUwyajE4NTh4ZVZ1U1A3UlBUTzdsMFJveGRZczdGVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC9taXJhcyI7czo1OiJyb3V0ZSI7czoxMToibWlyYXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjY0OiI3OTY1NTFlODI1YzI4MGVjNzQ4ZmE3ZDAxZTliMzA4YTJjZGQwYWY5YjQ0NjgxYTU4MzIyZTI4OWI4ZjUwNTMzIjt9',1774994832),('s0WhUUjdvPU9WJ8N12dE1Uxp7nbrHOeoe6rVANol',1,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUjlkVHV1aWk4NEdWQ1VCNkdoTzhzcFk5ZTl6cUx4dUo3R0laSlYxRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC9hZG1pbiI7czo1OiJyb3V0ZSI7czozMDoiZmlsYW1lbnQuYWRtaW4ucGFnZXMuZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6Ijc5NjU1MWU4MjVjMjgwZWM3NDhmYTdkMDFlOWIzMDhhMmNkZDBhZjliNDQ2ODFhNTgzMjJlMjg5YjhmNTA1MzMiO30=',1774986092);
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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
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
INSERT INTO `settings` VALUES (1,'site_mode','ghost','2026-03-25 19:38:18','2026-03-27 18:02:23'),(2,'theme_mode','dark',NULL,'2026-03-27 18:02:23');
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
  `snapshot_key` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scope_type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'team',
  `scope_id` bigint unsigned DEFAULT NULL,
  `team_id` bigint unsigned NOT NULL,
  `season` int unsigned NOT NULL,
  `result_limit` int unsigned NOT NULL DEFAULT '0',
  `payload` json NOT NULL,
  `checksum` char(40) COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `sports_snapshots` VALUES (1,'next_match','team',645,645,2025,0,'{\"raw\": {\"goals\": {\"away\": null, \"home\": null}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": null, \"home\": null}, \"halftime\": {\"away\": null, \"home\": null}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}, \"home\": {\"id\": 998, \"logo\": \"https://media.api-sports.io/football/teams/998.png\", \"name\": \"Trabzonspor\", \"winner\": null}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 28\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394684, \"date\": \"2026-04-05T17:00:00+00:00\", \"venue\": {\"id\": 20189, \"city\": \"Trabzon\", \"name\": \"Papara Park\"}, \"status\": {\"long\": \"Not Started\", \"extra\": null, \"short\": \"NS\", \"elapsed\": null}, \"periods\": {\"first\": null, \"second\": null}, \"referee\": null, \"timezone\": \"UTC\", \"timestamp\": 1775408400}}, \"away_id\": 645, \"home_id\": 998, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"away_name\": \"Galatasaray\", \"home_logo\": \"https://media.api-sports.io/football/teams/998.png\", \"home_name\": \"Trabzonspor\", \"league_id\": 203, \"detail_url\": \"/mac\", \"fixture_id\": 1394684, \"venue_city\": \"Trabzon\", \"venue_name\": \"Papara Park\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Not Started\", \"status_short\": \"NS\", \"match_datetime\": \"05.04.2026 17:00\"}','d0a68fb4cd402ed899f47e59fcd24030d592223a','2026-03-21 17:45:37','2026-03-21 18:00:37','2026-03-09 16:49:37','2026-03-21 17:45:37'),(2,'upcoming_fixtures','team',645,645,2025,0,'[{\"raw\": {\"goals\": {\"away\": null, \"home\": null}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": null, \"home\": null}, \"halftime\": {\"away\": null, \"home\": null}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}, \"home\": {\"id\": 998, \"logo\": \"https://media.api-sports.io/football/teams/998.png\", \"name\": \"Trabzonspor\", \"winner\": null}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 28\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394684, \"date\": \"2026-04-05T17:00:00+00:00\", \"venue\": {\"id\": 20189, \"city\": \"Trabzon\", \"name\": \"Papara Park\"}, \"status\": {\"long\": \"Not Started\", \"extra\": null, \"short\": \"NS\", \"elapsed\": null}, \"periods\": {\"first\": null, \"second\": null}, \"referee\": null, \"timezone\": \"UTC\", \"timestamp\": 1775408400}}, \"away_id\": 645, \"home_id\": 998, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"away_name\": \"Galatasaray\", \"home_logo\": \"https://media.api-sports.io/football/teams/998.png\", \"home_name\": \"Trabzonspor\", \"league_id\": 203, \"detail_url\": \"/mac\", \"fixture_id\": 1394684, \"venue_city\": \"Trabzon\", \"venue_name\": \"Papara Park\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Not Started\", \"status_short\": \"NS\", \"match_datetime\": \"05.04.2026 17:00\"}, {\"raw\": {\"goals\": {\"away\": null, \"home\": null}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": null, \"home\": null}, \"halftime\": {\"away\": null, \"home\": null}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 7411, \"logo\": \"https://media.api-sports.io/football/teams/7411.png\", \"name\": \"Kocaelispor\", \"winner\": null}, \"home\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 29\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394689, \"date\": \"2026-04-12T17:00:00+00:00\", \"venue\": {\"id\": null, \"city\": \"Istanbul\", \"name\": \"Rams Park\"}, \"status\": {\"long\": \"Not Started\", \"extra\": null, \"short\": \"NS\", \"elapsed\": null}, \"periods\": {\"first\": null, \"second\": null}, \"referee\": null, \"timezone\": \"UTC\", \"timestamp\": 1776013200}}, \"away_id\": 7411, \"home_id\": 645, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/7411.png\", \"away_name\": \"Kocaelispor\", \"home_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"home_name\": \"Galatasaray\", \"league_id\": 203, \"detail_url\": \"/mac\", \"fixture_id\": 1394689, \"venue_city\": \"Istanbul\", \"venue_name\": \"Rams Park\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Not Started\", \"status_short\": \"NS\", \"match_datetime\": \"12.04.2026 17:00\"}, {\"raw\": {\"goals\": {\"away\": null, \"home\": null}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": null, \"home\": null}, \"halftime\": {\"away\": null, \"home\": null}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}, \"home\": {\"id\": 997, \"logo\": \"https://media.api-sports.io/football/teams/997.png\", \"name\": \"Gençlerbirliği S.K.\", \"winner\": null}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 30\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394697, \"date\": \"2026-04-19T17:00:00+00:00\", \"venue\": {\"id\": 2378, \"city\": \"Ankara\", \"name\": \"Eryaman Stadium\"}, \"status\": {\"long\": \"Not Started\", \"extra\": null, \"short\": \"NS\", \"elapsed\": null}, \"periods\": {\"first\": null, \"second\": null}, \"referee\": null, \"timezone\": \"UTC\", \"timestamp\": 1776618000}}, \"away_id\": 645, \"home_id\": 997, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"away_name\": \"Galatasaray\", \"home_logo\": \"https://media.api-sports.io/football/teams/997.png\", \"home_name\": \"Gençlerbirliği S.K.\", \"league_id\": 203, \"detail_url\": \"/mac\", \"fixture_id\": 1394697, \"venue_city\": \"Ankara\", \"venue_name\": \"Eryaman Stadium\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Not Started\", \"status_short\": \"NS\", \"match_datetime\": \"19.04.2026 17:00\"}, {\"raw\": {\"goals\": {\"away\": null, \"home\": null}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": null, \"home\": null}, \"halftime\": {\"away\": null, \"home\": null}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 997, \"logo\": \"https://media.api-sports.io/football/teams/997.png\", \"name\": \"Gençlerbirliği S.K.\", \"winner\": null}, \"home\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}}, \"league\": {\"id\": 206, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/206.png\", \"name\": \"Türkiye Kupası\", \"round\": \"Quarter-finals\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": false}, \"fixture\": {\"id\": 1531969, \"date\": \"2026-04-21T16:00:00+00:00\", \"venue\": {\"id\": null, \"city\": \"Istanbul\", \"name\": \"Rams Park\"}, \"status\": {\"long\": \"Not Started\", \"extra\": null, \"short\": \"NS\", \"elapsed\": null}, \"periods\": {\"first\": null, \"second\": null}, \"referee\": null, \"timezone\": \"UTC\", \"timestamp\": 1776787200}}, \"away_id\": 997, \"home_id\": 645, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/997.png\", \"away_name\": \"Gençlerbirliği S.K.\", \"home_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"home_name\": \"Galatasaray\", \"league_id\": 206, \"detail_url\": \"/mac\", \"fixture_id\": 1531969, \"venue_city\": \"Istanbul\", \"venue_name\": \"Rams Park\", \"league_logo\": \"https://media.api-sports.io/football/leagues/206.png\", \"league_name\": \"Türkiye Kupası\", \"status_long\": \"Not Started\", \"status_short\": \"NS\", \"match_datetime\": \"21.04.2026 16:00\"}, {\"raw\": {\"goals\": {\"away\": null, \"home\": null}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": null, \"home\": null}, \"halftime\": {\"away\": null, \"home\": null}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 611, \"logo\": \"https://media.api-sports.io/football/teams/611.png\", \"name\": \"Fenerbahçe\", \"winner\": null}, \"home\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 31\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394707, \"date\": \"2026-04-26T17:00:00+00:00\", \"venue\": {\"id\": null, \"city\": \"Istanbul\", \"name\": \"Rams Park\"}, \"status\": {\"long\": \"Not Started\", \"extra\": null, \"short\": \"NS\", \"elapsed\": null}, \"periods\": {\"first\": null, \"second\": null}, \"referee\": null, \"timezone\": \"UTC\", \"timestamp\": 1777222800}}, \"away_id\": 611, \"home_id\": 645, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/611.png\", \"away_name\": \"Fenerbahçe\", \"home_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"home_name\": \"Galatasaray\", \"league_id\": 203, \"detail_url\": \"/mac\", \"fixture_id\": 1394707, \"venue_city\": \"Istanbul\", \"venue_name\": \"Rams Park\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Not Started\", \"status_short\": \"NS\", \"match_datetime\": \"26.04.2026 17:00\"}]','42ac11db94b11544b0d65e3d61dcab068081c30c','2026-03-21 17:45:37','2026-03-21 18:45:37','2026-03-09 16:49:37','2026-03-21 17:45:37'),(3,'last_matches','team',645,645,2025,0,'[{\"raw\": {\"goals\": {\"away\": 0, \"home\": 4}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": 0, \"home\": 4}, \"halftime\": {\"away\": 0, \"home\": 1}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": false}, \"home\": {\"id\": 40, \"logo\": \"https://media.api-sports.io/football/teams/40.png\", \"name\": \"Liverpool\", \"winner\": true}}, \"league\": {\"id\": 2, \"flag\": null, \"logo\": \"https://media.api-sports.io/football/leagues/2.png\", \"name\": \"UEFA Champions League\", \"round\": \"Round of 16\", \"season\": 2025, \"country\": \"World\", \"standings\": true}, \"fixture\": {\"id\": 1528329, \"date\": \"2026-03-18T20:00:00+00:00\", \"venue\": {\"id\": null, \"city\": \"Liverpool\", \"name\": \"Anfield\"}, \"status\": {\"long\": \"Match Finished\", \"extra\": 7, \"short\": \"FT\", \"elapsed\": 90}, \"periods\": {\"first\": 1773864000, \"second\": 1773867600}, \"referee\": \"P. Raczkowski\", \"timezone\": \"UTC\", \"timestamp\": 1773864000}}, \"score\": \"4 - 0\", \"result\": \"loss\", \"away_id\": 645, \"home_id\": 40, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"away_name\": \"Galatasaray\", \"home_logo\": \"https://media.api-sports.io/football/teams/40.png\", \"home_name\": \"Liverpool\", \"league_id\": 2, \"away_goals\": 0, \"detail_url\": \"/mac\", \"fixture_id\": 1528329, \"home_goals\": 4, \"venue_city\": \"Liverpool\", \"venue_name\": \"Anfield\", \"league_logo\": \"https://media.api-sports.io/football/leagues/2.png\", \"league_name\": \"UEFA Champions League\", \"status_long\": \"Match Finished\", \"status_short\": \"FT\", \"match_datetime\": \"18.03.2026 20:00\"}, {\"raw\": {\"goals\": {\"away\": null, \"home\": null}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": null, \"home\": null}, \"halftime\": {\"away\": null, \"home\": null}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": null}, \"home\": {\"id\": 994, \"logo\": \"https://media.api-sports.io/football/teams/994.png\", \"name\": \"Göztepe\", \"winner\": null}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 27\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394672, \"date\": \"2026-03-18T18:00:00+00:00\", \"venue\": {\"id\": 22441, \"city\": \"Izmir\", \"name\": \"Gürsel Aksel Stadyumu\"}, \"status\": {\"long\": \"Match Postponed\", \"extra\": null, \"short\": \"PST\", \"elapsed\": null}, \"periods\": {\"first\": null, \"second\": null}, \"referee\": null, \"timezone\": \"UTC\", \"timestamp\": 1773856800}}, \"score\": null, \"result\": null, \"away_id\": 645, \"home_id\": 994, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"away_name\": \"Galatasaray\", \"home_logo\": \"https://media.api-sports.io/football/teams/994.png\", \"home_name\": \"Göztepe\", \"league_id\": 203, \"away_goals\": null, \"detail_url\": \"/mac\", \"fixture_id\": 1394672, \"home_goals\": null, \"venue_city\": \"Izmir\", \"venue_name\": \"Gürsel Aksel Stadyumu\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Match Postponed\", \"status_short\": \"PST\", \"match_datetime\": \"18.03.2026 18:00\"}, {\"raw\": {\"goals\": {\"away\": 0, \"home\": 3}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": 0, \"home\": 3}, \"halftime\": {\"away\": 0, \"home\": 0}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 564, \"logo\": \"https://media.api-sports.io/football/teams/564.png\", \"name\": \"Başakşehir\", \"winner\": false}, \"home\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": true}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 26\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394659, \"date\": \"2026-03-14T17:00:00+00:00\", \"venue\": {\"id\": null, \"city\": \"Istanbul\", \"name\": \"Rams Park Stadyumu\"}, \"status\": {\"long\": \"Match Finished\", \"extra\": 3, \"short\": \"FT\", \"elapsed\": 90}, \"periods\": {\"first\": 1773507600, \"second\": 1773511200}, \"referee\": \"Batuhan Kolak, Türkiye\", \"timezone\": \"UTC\", \"timestamp\": 1773507600}}, \"score\": \"3 - 0\", \"result\": \"win\", \"away_id\": 564, \"home_id\": 645, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/564.png\", \"away_name\": \"Başakşehir\", \"home_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"home_name\": \"Galatasaray\", \"league_id\": 203, \"away_goals\": 0, \"detail_url\": \"/mac\", \"fixture_id\": 1394659, \"home_goals\": 3, \"venue_city\": \"Istanbul\", \"venue_name\": \"Rams Park Stadyumu\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Match Finished\", \"status_short\": \"FT\", \"match_datetime\": \"14.03.2026 17:00\"}, {\"raw\": {\"goals\": {\"away\": 0, \"home\": 1}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": 0, \"home\": 1}, \"halftime\": {\"away\": 0, \"home\": 1}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 40, \"logo\": \"https://media.api-sports.io/football/teams/40.png\", \"name\": \"Liverpool\", \"winner\": false}, \"home\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": true}}, \"league\": {\"id\": 2, \"flag\": null, \"logo\": \"https://media.api-sports.io/football/leagues/2.png\", \"name\": \"UEFA Champions League\", \"round\": \"Round of 16\", \"season\": 2025, \"country\": \"World\", \"standings\": true}, \"fixture\": {\"id\": 1528321, \"date\": \"2026-03-10T17:45:00+00:00\", \"venue\": {\"id\": null, \"city\": \"Istanbul\", \"name\": \"Rams Park\"}, \"status\": {\"long\": \"Match Finished\", \"extra\": 6, \"short\": \"FT\", \"elapsed\": 90}, \"periods\": {\"first\": 1773164700, \"second\": 1773168300}, \"referee\": \"J. Manzano\", \"timezone\": \"UTC\", \"timestamp\": 1773164700}}, \"score\": \"1 - 0\", \"result\": \"win\", \"away_id\": 40, \"home_id\": 645, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/40.png\", \"away_name\": \"Liverpool\", \"home_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"home_name\": \"Galatasaray\", \"league_id\": 2, \"away_goals\": 0, \"detail_url\": \"/mac\", \"fixture_id\": 1528321, \"home_goals\": 1, \"venue_city\": \"Istanbul\", \"venue_name\": \"Rams Park\", \"league_logo\": \"https://media.api-sports.io/football/leagues/2.png\", \"league_name\": \"UEFA Champions League\", \"status_long\": \"Match Finished\", \"status_short\": \"FT\", \"match_datetime\": \"10.03.2026 17:45\"}, {\"raw\": {\"goals\": {\"away\": 1, \"home\": 0}, \"score\": {\"penalty\": {\"away\": null, \"home\": null}, \"fulltime\": {\"away\": 1, \"home\": 0}, \"halftime\": {\"away\": 1, \"home\": 0}, \"extratime\": {\"away\": null, \"home\": null}}, \"teams\": {\"away\": {\"id\": 645, \"logo\": \"https://media.api-sports.io/football/teams/645.png\", \"name\": \"Galatasaray\", \"winner\": true}, \"home\": {\"id\": 549, \"logo\": \"https://media.api-sports.io/football/teams/549.png\", \"name\": \"Beşiktaş\", \"winner\": false}}, \"league\": {\"id\": 203, \"flag\": \"https://media.api-sports.io/flags/tr.svg\", \"logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"name\": \"Süper Lig\", \"round\": \"Regular Season - 25\", \"season\": 2025, \"country\": \"Turkey\", \"standings\": true}, \"fixture\": {\"id\": 1394651, \"date\": \"2026-03-07T17:00:00+00:00\", \"venue\": {\"id\": 20423, \"city\": \"Istanbul\", \"name\": \"Tupras Stadium\"}, \"status\": {\"long\": \"Match Finished\", \"extra\": 12, \"short\": \"FT\", \"elapsed\": 90}, \"periods\": {\"first\": 1772902800, \"second\": 1772906400}, \"referee\": \"Ozan Ergun, Türkiye\", \"timezone\": \"UTC\", \"timestamp\": 1772902800}}, \"score\": \"0 - 1\", \"result\": \"win\", \"away_id\": 645, \"home_id\": 549, \"is_live\": false, \"away_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"away_name\": \"Galatasaray\", \"home_logo\": \"https://media.api-sports.io/football/teams/549.png\", \"home_name\": \"Beşiktaş\", \"league_id\": 203, \"away_goals\": 1, \"detail_url\": \"/mac\", \"fixture_id\": 1394651, \"home_goals\": 0, \"venue_city\": \"Istanbul\", \"venue_name\": \"Tupras Stadium\", \"league_logo\": \"https://media.api-sports.io/football/leagues/203.png\", \"league_name\": \"Süper Lig\", \"status_long\": \"Match Finished\", \"status_short\": \"FT\", \"match_datetime\": \"07.03.2026 17:00\"}]','6b7b17a417b54f72d9a95f01be0a18fb20645af3','2026-03-21 17:45:37','2026-03-21 18:15:37','2026-03-09 16:49:37','2026-03-21 17:45:37'),(4,'league_standings_full','league',203,0,2025,20,'[{\"won\": 20, \"form\": \"WWWLW\", \"lost\": 2, \"rank\": 1, \"drawn\": 4, \"played\": 26, \"points\": 64, \"team_id\": 645, \"team_logo\": \"https://media.api-sports.io/football/teams/645.png\", \"team_name\": \"Galatasaray\", \"goals_diff\": 44, \"is_galatasaray\": true}, {\"won\": 17, \"form\": \"WLWDD\", \"lost\": 1, \"rank\": 2, \"drawn\": 9, \"played\": 27, \"points\": 60, \"team_id\": 611, \"team_logo\": \"https://media.api-sports.io/football/teams/611.png\", \"team_name\": \"Fenerbahçe\", \"goals_diff\": 33, \"is_galatasaray\": false}, {\"won\": 18, \"form\": \"WWWWW\", \"lost\": 3, \"rank\": 3, \"drawn\": 6, \"played\": 27, \"points\": 60, \"team_id\": 998, \"team_logo\": \"https://media.api-sports.io/football/teams/998.png\", \"team_name\": \"Trabzonspor\", \"goals_diff\": 24, \"is_galatasaray\": false}, {\"won\": 15, \"form\": \"WWLWW\", \"lost\": 5, \"rank\": 4, \"drawn\": 7, \"played\": 27, \"points\": 52, \"team_id\": 549, \"team_logo\": \"https://media.api-sports.io/football/teams/549.png\", \"team_name\": \"Beşiktaş\", \"goals_diff\": 18, \"is_galatasaray\": false}, {\"won\": 12, \"form\": \"DLWWW\", \"lost\": 8, \"rank\": 5, \"drawn\": 7, \"played\": 27, \"points\": 43, \"team_id\": 564, \"team_logo\": \"https://media.api-sports.io/football/teams/564.png\", \"team_name\": \"Başakşehir\", \"goals_diff\": 14, \"is_galatasaray\": false}, {\"won\": 11, \"form\": \"DLDLD\", \"lost\": 5, \"rank\": 6, \"drawn\": 10, \"played\": 26, \"points\": 43, \"team_id\": 994, \"team_logo\": \"https://media.api-sports.io/football/teams/994.png\", \"team_name\": \"Göztepe\", \"goals_diff\": 10, \"is_galatasaray\": false}, {\"won\": 8, \"form\": \"WLDDL\", \"lost\": 7, \"rank\": 7, \"drawn\": 11, \"played\": 26, \"points\": 35, \"team_id\": 3603, \"team_logo\": \"https://media.api-sports.io/football/teams/3603.png\", \"team_name\": \"Samsunspor\", \"goals_diff\": -2, \"is_galatasaray\": false}, {\"won\": 9, \"form\": \"LLWLL\", \"lost\": 12, \"rank\": 8, \"drawn\": 6, \"played\": 27, \"points\": 33, \"team_id\": 7411, \"team_logo\": \"https://media.api-sports.io/football/teams/7411.png\", \"team_name\": \"Kocaelispor\", \"goals_diff\": -9, \"is_galatasaray\": false}, {\"won\": 8, \"form\": \"LWDDL\", \"lost\": 10, \"rank\": 9, \"drawn\": 9, \"played\": 27, \"points\": 33, \"team_id\": 3573, \"team_logo\": \"https://media.api-sports.io/football/teams/3573.png\", \"team_name\": \"Gaziantep FK\", \"goals_diff\": -10, \"is_galatasaray\": false}, {\"won\": 6, \"form\": \"WDDLL\", \"lost\": 8, \"rank\": 10, \"drawn\": 13, \"played\": 27, \"points\": 31, \"team_id\": 996, \"team_logo\": \"https://media.api-sports.io/football/teams/996.png\", \"team_name\": \"Alanyaspor\", \"goals_diff\": 1, \"is_galatasaray\": false}, {\"won\": 7, \"form\": \"LWWWD\", \"lost\": 10, \"rank\": 11, \"drawn\": 9, \"played\": 26, \"points\": 30, \"team_id\": 1007, \"team_logo\": \"https://media.api-sports.io/football/teams/1007.png\", \"team_name\": \"Rizespor\", \"goals_diff\": -4, \"is_galatasaray\": false}, {\"won\": 7, \"form\": \"WWDLW\", \"lost\": 11, \"rank\": 12, \"drawn\": 9, \"played\": 27, \"points\": 30, \"team_id\": 607, \"team_logo\": \"https://media.api-sports.io/football/teams/607.png\", \"team_name\": \"Konyaspor\", \"goals_diff\": -8, \"is_galatasaray\": false}, {\"won\": 6, \"form\": \"LLDDL\", \"lost\": 14, \"rank\": 13, \"drawn\": 7, \"played\": 27, \"points\": 25, \"team_id\": 997, \"team_logo\": \"https://media.api-sports.io/football/teams/997.png\", \"team_name\": \"Gençlerbirliği S.K.\", \"goals_diff\": -9, \"is_galatasaray\": false}, {\"won\": 6, \"form\": \"DLLDL\", \"lost\": 14, \"rank\": 14, \"drawn\": 7, \"played\": 27, \"points\": 25, \"team_id\": 1005, \"team_logo\": \"https://media.api-sports.io/football/teams/1005.png\", \"team_name\": \"Antalyaspor\", \"goals_diff\": -18, \"is_galatasaray\": false}, {\"won\": 5, \"form\": \"LWDLD\", \"lost\": 13, \"rank\": 15, \"drawn\": 9, \"played\": 27, \"points\": 24, \"team_id\": 1004, \"team_logo\": \"https://media.api-sports.io/football/teams/1004.png\", \"team_name\": \"Kasımpaşa\", \"goals_diff\": -15, \"is_galatasaray\": false}, {\"won\": 4, \"form\": \"WLLDW\", \"lost\": 12, \"rank\": 16, \"drawn\": 11, \"played\": 27, \"points\": 23, \"team_id\": 1001, \"team_logo\": \"https://media.api-sports.io/football/teams/1001.png\", \"team_name\": \"Kayserispor\", \"goals_diff\": -27, \"is_galatasaray\": false}, {\"won\": 5, \"form\": \"LLLDW\", \"lost\": 15, \"rank\": 17, \"drawn\": 7, \"played\": 27, \"points\": 22, \"team_id\": 3588, \"team_logo\": \"https://media.api-sports.io/football/teams/3588.png\", \"team_name\": \"Eyüpspor\", \"goals_diff\": -19, \"is_galatasaray\": false}, {\"won\": 4, \"form\": \"LWDLD\", \"lost\": 18, \"rank\": 18, \"drawn\": 5, \"played\": 27, \"points\": 17, \"team_id\": 3589, \"team_logo\": \"https://media.api-sports.io/football/teams/3589.png\", \"team_name\": \"Fatih Karagümrük\", \"goals_diff\": -23, \"is_galatasaray\": false}]','4ece30034448451234334560c1d4577fbc4f8b11','2026-03-21 17:45:46','2026-03-21 18:45:46','2026-03-09 17:49:57','2026-03-21 17:45:46');
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
  `taggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `taggables` VALUES (1,'App\\Models\\Category',1,NULL,NULL),(1,'App\\Models\\Category',2,NULL,NULL),(1,'App\\Models\\Category',3,NULL,NULL),(1,'App\\Models\\News',21,NULL,NULL),(1,'App\\Models\\News',22,NULL,NULL),(2,'App\\Models\\Category',1,NULL,NULL),(2,'App\\Models\\Category',2,NULL,NULL),(2,'App\\Models\\Category',3,NULL,NULL),(2,'App\\Models\\News',21,NULL,NULL),(3,'App\\Models\\Category',1,NULL,NULL),(3,'App\\Models\\Category',2,NULL,NULL),(3,'App\\Models\\Category',3,NULL,NULL),(3,'App\\Models\\News',21,NULL,NULL),(4,'App\\Models\\Category',1,NULL,NULL),(4,'App\\Models\\Category',2,NULL,NULL),(4,'App\\Models\\Category',3,NULL,NULL),(4,'App\\Models\\News',21,NULL,NULL),(4,'App\\Models\\News',22,NULL,NULL),(5,'App\\Models\\Category',1,NULL,NULL),(5,'App\\Models\\Category',2,NULL,NULL),(5,'App\\Models\\Category',3,NULL,NULL),(5,'App\\Models\\News',21,NULL,NULL),(6,'App\\Models\\Category',1,NULL,NULL),(6,'App\\Models\\Category',2,NULL,NULL),(6,'App\\Models\\Category',3,NULL,NULL),(6,'App\\Models\\News',21,NULL,NULL),(7,'App\\Models\\Category',1,NULL,NULL),(7,'App\\Models\\Category',2,NULL,NULL),(7,'App\\Models\\Category',3,NULL,NULL),(7,'App\\Models\\News',21,NULL,NULL),(7,'App\\Models\\News',22,NULL,NULL),(10,'App\\Models\\Category',1,NULL,NULL),(10,'App\\Models\\Category',2,NULL,NULL),(10,'App\\Models\\Category',3,NULL,NULL),(10,'App\\Models\\News',21,NULL,NULL),(11,'App\\Models\\Category',2,NULL,NULL),(11,'App\\Models\\News',21,NULL,NULL),(11,'App\\Models\\News',27,'2026-03-31 10:40:31','2026-03-31 10:40:31'),(12,'App\\Models\\Category',3,NULL,NULL),(12,'App\\Models\\News',22,NULL,NULL),(13,'App\\Models\\Category',1,NULL,NULL),(14,'App\\Models\\News',27,'2026-03-31 10:40:31','2026-03-31 10:40:31');
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'moment',
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_id` bigint unsigned DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `position` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referenced_key` varchar(255) COLLATE utf8mb4_unicode_ci GENERATED ALWAYS AS ((case when ((`source_type` is not null) and (`source_id` is not null)) then concat(`source_type`,_utf8mb4'#',`source_id`,_utf8mb4'#',cast(`timeline_date` as date)) else NULL end)) STORED,
  `is_demo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `timeline_entries_referenced_unique` (`referenced_key`),
  KEY `timeline_entries_source_type_source_id_index` (`source_type`,`source_id`),
  KEY `timeline_entries_date_position_idx` (`timeline_date`,`position`),
  KEY `timeline_entries_type_visible_idx` (`type`,`is_visible`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timeline_entries`
--

LOCK TABLES `timeline_entries` WRITE;
/*!40000 ALTER TABLE `timeline_entries` DISABLE KEYS */;
INSERT INTO `timeline_entries` (`id`, `timeline_date`, `title`, `excerpt`, `type`, `icon`, `source_type`, `source_id`, `is_visible`, `position`, `created_at`, `updated_at`, `is_demo`) VALUES (1,'2024-03-26','Test Timeline Entry',NULL,'moment',NULL,NULL,NULL,1,0,'2026-03-25 21:18:47','2026-03-25 21:18:47',0);
/*!40000 ALTER TABLE `timeline_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trophies`
--

DROP TABLE IF EXISTS `trophies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trophies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trophy_scope` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
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
-- Dumping data for table `trophies`
--

LOCK TABLES `trophies` WRITE;
/*!40000 ALTER TABLE `trophies` DISABLE KEYS */;
INSERT INTO `trophies` VALUES (1,'Süper Lig','super-lig','futbol','ulusal','Süper Lig için demo referans kaydı.','Süper Lig için demo referans içeriği.',1,1,'2026-03-23 19:56:54','2026-03-30 09:53:30',1),(2,'Türkiye Kupası','turkiye-kupasi','futbol','ulusal','Türkiye Kupası için demo referans kaydı.','<p>Türkiye Kupası için demo referans içeriği...</p>',1,2,'2026-03-23 19:56:54','2026-03-30 17:51:20',1),(3,'UEFA Kupası','uefa-kupasi','futbol','uluslararasi','UEFA Kupası için demo referans kaydı.','<p>GALATASARAYIN TARIHI UEFA KUPASI ZAFERI KOPENHAG DESTANI</p><p>Turk spor tarihinin en parlak sayfalarindan biri 17 Mayis 2000 gecesi Danimarkanin Kopenhag sehrinde yazildi. Fatih Terim yonetimindeki Galatasaray, Avrupa futbolunun en buyuk organizasyonlarindan biri olan UEFA Kupasi finalinde Ingiliz devi Arsenali devirerek kupayi muzesine goturmeyi basardi. Bu zafer, Turk futbol tarihinde bir kulup takiminin kazandigi ilk Avrupa kupasi olarak kayitlara gecti.</p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/png&quot;,&quot;filename&quot;:&quot;terim34.png&quot;,&quot;filesize&quot;:705382,&quot;height&quot;:851,&quot;href&quot;:&quot;http://localhost:8080/storage/editor-content/UuagQJPl2gbX7HwCueueDImY2GYOwzrKz01min0M.png&quot;,&quot;url&quot;:&quot;http://localhost:8080/storage/editor-content/UuagQJPl2gbX7HwCueueDImY2GYOwzrKz01min0M.png&quot;,&quot;width&quot;:401}\" data-trix-content-type=\"image/png\" data-trix-attributes=\"{&quot;caption&quot;:&quot;Fatih Terim&quot;,&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--png\"><a href=\"http://localhost:8080/storage/editor-content/UuagQJPl2gbX7HwCueueDImY2GYOwzrKz01min0M.png\"><img src=\"http://localhost:8080/storage/editor-content/UuagQJPl2gbX7HwCueueDImY2GYOwzrKz01min0M.png\" width=\"401\" height=\"851\"><figcaption class=\"attachment__caption attachment__caption--edited\">Fatih Terim</figcaption></a></figure>SAMPIYONLAR LIGINDEN GELEN ZAFER</p><p>Galatasarayin 1999-2000 sezonundaki Avrupa yolculugu aslinda Sampiyonlar Liginde baslamisti. Milan karsisinda alinan epik 3-2lik galibiyetle grubunu ucuncu sirada tamamlayan sari kirmizililar, yoluna UEFA Kupasinda devam etme hakki kazandi. Kimse bu yolun sonunun sampiyonluk olacagini tahmin etmiyordu ancak Fatih Terim ve ogrencileri her turda rakiplerini tek tek saf disi birakarak finale kadar yukseldi.</p><p>FINALE GIDEN YOLDA DEVLERI DEVIRDI</p><p>Galatasaray finale gelene kadar Avrupa futbolunun onemli ekiplerini eledi. Sirasiyla Bologna, Borussia Dortmund, Real Mallorca ve son olarak Leeds Unitedi eleyen temsilcimiz, finalde Dunya yildizlariyla dolu Arsenalin rakibi oldu. Kadrosunda Thierry Henry, Dennis Bergkamp ve Patrick Vieira gibi isimleri barindiran Arsenal karsisinda Galatasaray; Taffarel, Popescu, Bulent Korkmaz, Hagi ve Hakan Sukur gibi efsane isimleriyle sahadaydi.</p><p>120 DAKIKALIK SINIR HARBI</p><p>Kopenhagdaki Parken Stadinda oynanan final macinin normal suresi ve uzatma bolumleri 0-0 esitlikle sona erdi. Macin en kritik anlarindan biri, takimin beyni Gheorghe Haginin kirmizi kart gorerek oyun disi kalmasiydi. 10 kisi kalan Galatasaray, kalesinde devlesen Claudio Taffarelin inanilmaz kurtarislariyla maci penaltilara tasimayi basardi.</p><p>POPESCUNUN SON VURUSU VE GELEN KUPA</p><p>Penalti atislarinda Galatasaray hata yapmadi. Ergun Penbe, Hakan Sukur ve Umit Davala topu aglarla bulustururken, Arsenalli oyuncular Suker ve Vieiranin vuruslari direkten dondu. Son penalti icin topun basina gecen Rumen savunmaci Gheorghe Popescu, sogukkanli bir vurusla David Seamani maglup etti. Bu golle Galatasaray, UEFA Kupasini kazanan ilk ve tek Turk takimi unvanini alarak milyonlari sokaga doktu.</p><p>Karsilasma sonrasi yasanan buyuk sevinç, sadece Kopenhagda degil tum Turkiyede kutlandi. Bu basari ayni yil icerisinde Real Madridi devirerek kazanilacak olan UEFA Super Kupasinin da habercisi oldu.</p>',1,3,'2026-03-23 19:56:54','2026-03-29 15:53:04',1),(4,'UEFA Süper Kupa','uefa-super-kupa','futbol','uluslararasi','UEFA Süper Kupa için demo referans kaydı.','UEFA Süper Kupa için demo referans içeriği.',1,4,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(5,'EuroLeague Women','euroleague-women','basketbol','uluslararasi','EuroLeague Women için demo referans kaydı.','EuroLeague Women için demo referans içeriği.',1,5,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(6,'Türkiye Basketbol Şampiyonluğu','turkiye-basketbol-sampiyonlugu','basketbol','ulusal','Türkiye Basketbol Şampiyonluğu için demo referans kaydı.','Türkiye Basketbol Şampiyonluğu için demo referans içeriği.',1,6,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(7,'Avrupa Kupası Finali','avrupa-kupasi-finali','basketbol','uluslararasi','Avrupa Kupası Finali için demo referans kaydı.','Avrupa Kupası Finali için demo referans içeriği.',1,7,'2026-03-23 19:56:54','2026-03-23 19:56:54',1),(8,'Tekerlekli Sandalye Basketbol Avrupa Kupası','tsb-avrupa-kupasi','basketbol','uluslararasi','Tekerlekli Sandalye Basketbol Avrupa Kupası için demo referans kaydı.','Tekerlekli Sandalye Basketbol Avrupa Kupası için demo referans içeriği.',1,8,'2026-03-23 19:56:54','2026-03-23 19:56:54',1);
/*!40000 ALTER TABLE `trophies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `is_super_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `can_write` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rank` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nev_zuhur',
  `cp_score` int unsigned NOT NULL DEFAULT '0',
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-31 22:18:19
