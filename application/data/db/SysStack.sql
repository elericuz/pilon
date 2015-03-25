-- MySQL dump 10.13  Distrib 5.6.21, for osx10.8 (x86_64)
--
-- Host: localhost    Database: SysStack
-- ------------------------------------------------------
-- Server version	5.6.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `clii_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliv_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `clid_creation_date` datetime DEFAULT NULL,
  `clii_status` int(1) DEFAULT '1' COMMENT '0=>disabled, 1=>enabled',
  PRIMARY KEY (`clii_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `file_system`
--

DROP TABLE IF EXISTS `file_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_system` (
  `fisi_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fisi_parent_id` int(11) DEFAULT '0',
  `fisi_type` int(1) DEFAULT '1' COMMENT '0=>Folder, 1=>File',
  `fisv_name` varchar(32) COLLATE utf8_bin DEFAULT NULL COMMENT 'the name in md5',
  `fisv_real_name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'the real name as uploaded',
  `fisv_mimetype` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `fisv_extension` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `fist_description` text COLLATE utf8_bin,
  `fisd_upload_date` datetime DEFAULT NULL,
  `fisv_upload_ip` varchar(17) COLLATE utf8_bin DEFAULT NULL,
  `fisv_status` int(1) DEFAULT '1' COMMENT '0=>disable, 1=>enabled',
  PRIMARY KEY (`fisi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `file_system_client`
--

DROP TABLE IF EXISTS `file_system_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_system_client` (
  `fsci_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fsci_parent_id` int(11) DEFAULT NULL,
  `clii_id` int(10) unsigned NOT NULL,
  `fisi_id` int(10) unsigned NOT NULL,
  `fscv_real_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `fscv_friendly_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `fsct_description` text COLLATE utf8_bin,
  `fscd_upload_date` datetime DEFAULT NULL,
  `fsci_status` int(1) DEFAULT '1' COMMENT '0=>disabled, 1=>enabled',
  PRIMARY KEY (`fsci_id`),
  KEY `has_client` (`clii_id`),
  KEY `has_fs` (`fisi_id`),
  CONSTRAINT `has_client` FOREIGN KEY (`clii_id`) REFERENCES `client` (`clii_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `has_fs` FOREIGN KEY (`fisi_id`) REFERENCES `file_system` (`fisi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-24 22:45:42
