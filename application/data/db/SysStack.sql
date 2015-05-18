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
  `clii_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `clii_type` int(1) DEFAULT '0' COMMENT '0=>client, 1=>owner',
  `cliv_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `clid_creation_date` datetime DEFAULT NULL,
  `clii_status` int(1) DEFAULT '1' COMMENT '0=>disabled, 1=>enabled',
  PRIMARY KEY (`clii_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,1,'Cruz Verde','2015-03-28 20:27:15',1),(2,0,'SysBus','2015-03-31 22:18:46',1);
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_user`
--

DROP TABLE IF EXISTS `client_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_user` (
  `clui_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clii_id` int(11) unsigned NOT NULL,
  `clui_type` int(1) DEFAULT '0' COMMENT '0=>client, 1=>admin',
  `cluv_user` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cluv_password` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cluv_email` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `clui_status` int(1) DEFAULT '1' COMMENT '0=>disabled, 1=>enabled',
  PRIMARY KEY (`clui_id`),
  UNIQUE KEY `cluv_user` (`cluv_user`) USING BTREE,
  KEY `IX_has_user` (`clii_id`),
  CONSTRAINT `has_user` FOREIGN KEY (`clii_id`) REFERENCES `client` (`clii_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_user`
--

LOCK TABLES `client_user` WRITE;
/*!40000 ALTER TABLE `client_user` DISABLE KEYS */;
INSERT INTO `client_user` VALUES (1,1,1,'8a4e8bcd6cc8ae4d3682b517baeaff9f','dd903e1480845ebf0ab43a9907a1cb1f','eric@elericuz.com',1),(2,2,0,'e923d9f088d11e3a1cf8ada93768b669','dd903e1480845ebf0ab43a9907a1cb1f','eric@pragmum.com',1);
/*!40000 ALTER TABLE `client_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_system`
--

DROP TABLE IF EXISTS `file_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_system` (
  `fisi_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fisi_parent_id` int(11) DEFAULT '0',
  `fisi_type` int(1) DEFAULT '1' COMMENT '0=>Folder, 1=>File',
  `fisv_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'the name in md5',
  `fisv_real_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'the real name as uploaded',
  `fisv_mimetype` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `fisv_extension` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `fist_description` text CHARACTER SET utf8 COLLATE utf8_bin,
  `fisd_upload_date` datetime DEFAULT NULL,
  `fisv_upload_ip` varchar(17) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `fisv_status` int(1) DEFAULT '1' COMMENT '0=>disable, 1=>enabled',
  PRIMARY KEY (`fisi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_system`
--

LOCK TABLES `file_system` WRITE;
/*!40000 ALTER TABLE `file_system` DISABLE KEYS */;
INSERT INTO `file_system` VALUES (1,0,0,'3b6bdc0dd5e1a45b217300e044047835','Carpeta Nueva',NULL,NULL,NULL,'2015-03-28 20:28:15','127.0.0.1',1),(2,0,1,'d52d7c7a288674a90ba5c982db636700','Luz del Sur.jpg','image/jpeg',NULL,'luz del sur','2015-03-28 20:28:28','127.0.0.1',1),(3,0,0,'524da9261d7dcd821e3d8a355e317c7a','carpeta uno',NULL,NULL,NULL,'2015-04-01 00:24:46','127.0.0.1',1),(4,0,1,'36cea241ef3bba5ad19290ba2461a091','463f1bfca3b6efae1ea76069533cb5cd.jpg','image/jpeg',NULL,'imagen de frutas','2015-04-01 00:25:32','127.0.0.1',1);
/*!40000 ALTER TABLE `file_system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_system_client`
--

DROP TABLE IF EXISTS `file_system_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_system_client` (
  `fsci_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fsci_parent_id` int(11) DEFAULT NULL,
  `clii_id` int(11) unsigned NOT NULL,
  `fisi_id` int(11) unsigned NOT NULL,
  `fscv_real_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fscv_friendly_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fsct_description` text CHARACTER SET utf8 COLLATE utf8_bin,
  `fscd_upload_date` datetime DEFAULT NULL,
  `fsci_total_download` int(11) DEFAULT '0',
  `fsci_status` int(1) DEFAULT '1' COMMENT '0=>disabled, 1=>enabled',
  PRIMARY KEY (`fsci_id`),
  KEY `has_client` (`clii_id`) USING BTREE,
  KEY `has_fs` (`fisi_id`) USING BTREE,
  CONSTRAINT `has_client` FOREIGN KEY (`clii_id`) REFERENCES `client` (`clii_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `has_fs` FOREIGN KEY (`fisi_id`) REFERENCES `file_system` (`fisi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_system_client`
--

LOCK TABLES `file_system_client` WRITE;
/*!40000 ALTER TABLE `file_system_client` DISABLE KEYS */;
INSERT INTO `file_system_client` VALUES (1,0,1,1,'Carpeta Nueva','Carpeta Nueva',NULL,'2015-03-28 20:28:15',0,1),(2,0,1,2,'Luz del Sur.jpg','Luz del Sur.jpg','luz del sur','2015-03-28 20:28:28',7,1),(3,0,2,3,'carpeta uno','carpeta uno',NULL,'2015-04-01 00:24:46',0,1),(4,0,2,4,'463f1bfca3b6efae1ea76069533cb5cd.jpg','463f1bfca3b6efae1ea76069533cb5cd.jpg','imagen de frutas','2015-04-01 00:25:32',0,1);
/*!40000 ALTER TABLE `file_system_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_system_download`
--

DROP TABLE IF EXISTS `file_system_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_system_download` (
  `fsd_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fsci_id` int(11) unsigned NOT NULL,
  `fsdd_download_date` datetime DEFAULT NULL,
  `fsdv_download_ip` varchar(17) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`fsd_id`),
  KEY `IX_has_file` (`fsci_id`),
  CONSTRAINT `has_file` FOREIGN KEY (`fsci_id`) REFERENCES `file_system_client` (`fsci_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_system_download`
--

LOCK TABLES `file_system_download` WRITE;
/*!40000 ALTER TABLE `file_system_download` DISABLE KEYS */;
INSERT INTO `file_system_download` VALUES (1,2,'2015-03-28 20:33:17','127.0.0.1'),(2,2,'2015-03-28 20:33:25','127.0.0.1'),(3,2,'2015-03-28 20:33:32','127.0.0.1'),(4,2,'2015-03-28 20:34:20','127.0.0.1'),(5,2,'2015-03-28 20:34:27','127.0.0.1'),(6,2,'2015-03-30 22:14:45','127.0.0.1'),(7,2,'2015-04-01 00:01:08','127.0.0.1');
/*!40000 ALTER TABLE `file_system_download` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-01  0:43:14
