-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: SysStack
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,1,'Cruz Verde','2015-03-28 20:27:15',1),(2,0,'SysBus','2015-04-13 01:55:20',1),(3,0,'San Fernando','2015-04-13 02:40:12',1),(4,0,'Global Alimentos','2015-04-14 15:12:43',1),(5,0,'3M','2015-04-14 15:59:40',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_user`
--

LOCK TABLES `client_user` WRITE;
/*!40000 ALTER TABLE `client_user` DISABLE KEYS */;
INSERT INTO `client_user` VALUES (1,1,1,'314fac89494b0a757a5ff2af542f4bea','48451f95523b62283858c52ad24b0b6b','cv@cruzverdeperu.com',1),(2,2,0,'fa5c90bbfe56eb20ed9d8ba527457009','ec06fa1177829c131f2409c7ed8a6fbe','jvaldivia@loretdemola.com',1),(3,3,0,'a770a2e05d11d552ad66b3981db76594','a87ee325d1abc9e303902bb3540e12ff','crevilla@san-fernando.com.pe',1),(4,4,0,'88d731735f57568ff5a8642feb24a6c8','8fb6c5febd62d999f527ad4545d47a10','usuario@global.com.pe',1),(5,5,0,'31e0820a77d79464375604e83a0dd29b','5c826176707f880b73c63f6f018923c8','usuario@eulen.com',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_system`
--

LOCK TABLES `file_system` WRITE;
/*!40000 ALTER TABLE `file_system` DISABLE KEYS */;
INSERT INTO `file_system` VALUES (1,0,0,'e017ad27e4e1edba56bf0e2996d64530','Cruz Verde',NULL,NULL,NULL,'2015-04-12 01:27:29','127.0.0.1',1),(2,0,1,'99f81dec6dd0dc0d9fcf721ce89cce59','Array2XML.php','text/php',NULL,'aaa','2015-04-13 01:54:28','190.232.224.179',1),(3,0,0,'4575c22b8e1523c58944c1bd9a959dac','SysBus',NULL,NULL,NULL,'2015-04-13 01:55:20','190.232.224.179',1),(4,0,1,'ac9500186b603d649cc52fa3677d57f9','generacionpdf.txt','text/plain',NULL,'qqq','2015-04-13 01:56:04','190.232.224.179',1),(5,0,0,'3460c86d05894167ef04035d46aea24f','San Fernando',NULL,NULL,NULL,'2015-04-13 02:40:12','190.232.224.179',1),(6,0,0,'1f1cdb64f34aea28ab31f1bb5f0b3d5a','Global Alimentos',NULL,NULL,NULL,'2015-04-14 15:12:43','190.232.2.201',1),(7,0,0,'759e49f76e2888eb64e679de63c6ba37','Certificados',NULL,NULL,NULL,'2015-04-14 15:14:12','190.232.2.201',1),(8,0,0,'ee1994047bfc4d00618dbda3ab2a537e','Formatos',NULL,NULL,NULL,'2015-04-14 15:14:34','190.232.2.201',1),(9,0,0,'759e49f76e2888eb64e679de63c6ba37','Certificados',NULL,NULL,NULL,'2015-04-14 15:14:57','190.232.2.201',1),(10,0,1,'2c9c7c5f43364c4ea6f2755ec8c9039f','DIAGNOSTICO DE SEGURIDAD DE LA INFORMACION (1).xlsm','application/vnd.ms-excel.sheet',NULL,'excel','2015-04-14 15:16:05','190.232.2.201',1),(11,0,0,'f0df2cc4783d63aa6422c7d43782db0a','Sistemas',NULL,NULL,NULL,'2015-04-14 15:18:02','190.232.2.201',1),(12,0,1,'74ef0415479e35badfe868782a4562f6','hola.pdf','application/pdf',NULL,'pdf','2015-04-14 15:18:46','190.232.2.201',1),(13,0,0,'5bc8c567a89112d5f408a8af4f17970d','Prueba',NULL,NULL,NULL,'2015-04-14 15:19:29','190.232.2.201',1),(14,0,0,'5bc8c567a89112d5f408a8af4f17970d','Prueba',NULL,NULL,NULL,'2015-04-14 15:19:29','190.232.2.201',1),(15,0,1,'2fb62b006ac57c83a88644d521bd7f45','Exportado.pdf','application/pdf',NULL,'excel 2','2015-04-14 15:20:28','190.232.2.201',1),(16,0,0,'9c4be52e49352f630dbca2c1fd01e766','Informes2',NULL,NULL,NULL,'2015-04-14 15:26:06','190.232.2.201',1),(17,0,0,'78424309799cf5be93896cc05eafa250','nueva 2',NULL,NULL,NULL,'2015-04-14 15:28:12','190.113.210.94',1),(18,0,0,'a77b0c65a7d333076fdd43d1cc49dc49','Informes',NULL,NULL,NULL,'2015-04-14 15:48:02','190.239.114.205',1),(19,0,1,'5ec30b8f1c30faf10f4ad01c6bd41deb','Auditoria 2015-1.pdf','application/pdf',NULL,'auditoria','2015-04-14 15:48:22','190.232.2.201',1),(20,0,0,'d8589a20d5ff2f308381aa7aa75b9a27','3M',NULL,NULL,NULL,'2015-04-14 15:59:40','190.232.2.201',1),(21,0,0,'a77b0c65a7d333076fdd43d1cc49dc49','Informes',NULL,NULL,NULL,'2015-04-14 16:00:20','190.232.2.201',1),(22,0,0,'759e49f76e2888eb64e679de63c6ba37','Certificados',NULL,NULL,NULL,'2015-04-14 16:00:32','190.232.2.201',1),(23,0,0,'65d2ea03425887a717c435081cfc5dbb','2015',NULL,NULL,NULL,'2015-04-14 16:00:42','190.232.2.201',1),(24,0,1,'ad047f9b3d9543cb1dd89bfaaa433da5','REGISTRO DIGESA.pdf','application/pdf',NULL,'digesa','2015-04-14 16:01:14','190.232.2.201',1),(25,0,1,'e7d51f210fba4700432cca013b43827a','MARZO.xlsx','application/vnd.openxmlformats',NULL,'','2015-04-14 16:11:16','190.232.2.201',1),(26,0,1,'8a4bed865c48707bccace327fc8e80da','CVI-1042-14 Country Club Ds Dz Agosto.pdf','application/pdf',NULL,'','2015-04-14 16:12:08','190.232.2.201',1),(27,0,1,'98517a84a704b02dc8889d75afdcdab5','Array2XML.php','text/php',NULL,'archivos de prueba','2015-05-18 04:23:08','190.232.224.179',1),(28,0,1,'d48fc0a01ad6b5c8376be59628f71a0d','Editor Temporal.html','text/html',NULL,'archivos de prueba','2015-05-18 04:23:08','190.232.224.179',1),(29,0,1,'990ead975047fa4966cef94bb340efd9','dibujo de los 5 sentidos','application/octet-stream',NULL,'','2015-05-18 04:31:34','190.232.224.179',1),(30,0,1,'4b45aba8233028e5b4feb09d77366ef4','dibujos que empiezan con a','application/octet-stream',NULL,'','2015-05-18 04:31:34','190.232.224.179',1),(31,0,1,'4df227bd04566e7ba8779a4e9dce6e91','dibujo de los 5 sentidos','application/octet-stream',NULL,'','2015-05-18 04:31:34','190.232.224.179',1),(32,0,1,'3bb9b82e93d27047a1b0d3c15e341974','dibujos que empiezan con a','application/octet-stream',NULL,'','2015-05-18 04:31:34','190.232.224.179',1),(33,0,1,'604de15bd052f3536dd57e7e71a2d022','dibujos que empiezan con a','application/octet-stream',NULL,'desde el mÃ³vil ','2015-05-18 04:33:54','190.232.224.179',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_system_client`
--

LOCK TABLES `file_system_client` WRITE;
/*!40000 ALTER TABLE `file_system_client` DISABLE KEYS */;
INSERT INTO `file_system_client` VALUES (1,0,1,1,'Cruz Verde','Cruz Verde',NULL,'2015-04-12 01:27:29',0,1),(2,1,1,2,'Array2XML.php','Array2XML.php','aaa','2015-04-13 01:54:28',0,1),(3,0,2,3,'SysBus','SysBus',NULL,'2015-04-13 01:55:20',0,1),(4,3,2,4,'generacionpdf.txt','generacionpdf.txt','qqq','2015-04-13 01:56:04',1,1),(5,0,3,5,'San Fernando','San Fernando',NULL,'2015-04-13 02:40:12',0,1),(6,0,4,6,'Global Alimentos','Global Alimentos',NULL,'2015-04-14 15:12:43',0,1),(7,6,1,7,'Certificados','Certificados',NULL,'2015-04-14 15:14:12',0,1),(8,6,1,8,'Formatos','Formatos',NULL,'2015-04-14 15:14:34',0,1),(9,6,1,9,'Certificados','Certificados',NULL,'2015-04-14 15:14:57',0,1),(10,6,4,10,'DIAGNOSTICO DE SEGURIDAD DE LA INFORMACION (1).xlsm','DIAGNOSTICO DE SEGURIDAD DE LA INFORMACION (1).xlsm','excel','2015-04-14 15:16:05',0,1),(11,1,1,11,'Sistemas','Sistemas',NULL,'2015-04-14 15:18:02',0,1),(12,1,1,12,'hola.pdf','hola.pdf','pdf','2015-04-14 15:18:46',1,1),(13,6,1,13,'Prueba','Prueba',NULL,'2015-04-14 15:19:29',0,1),(14,6,1,14,'Prueba','Prueba',NULL,'2015-04-14 15:19:29',0,1),(15,5,3,15,'Exportado.pdf','Exportado.pdf','excel 2','2015-04-14 15:20:28',2,1),(16,6,1,16,'Informes2','Informes2',NULL,'2015-04-14 15:26:06',0,1),(17,6,1,17,'nueva 2','nueva 2',NULL,'2015-04-14 15:28:12',0,1),(18,5,1,18,'Informes','Informes',NULL,'2015-04-14 15:48:02',0,1),(19,18,1,19,'Auditoria 2015-1.pdf','Auditoria 2015-1.pdf','auditoria','2015-04-14 15:48:22',0,1),(20,0,5,20,'3M','3M',NULL,'2015-04-14 15:59:40',0,1),(21,20,1,21,'Informes','Informes',NULL,'2015-04-14 16:00:20',0,1),(22,20,1,22,'Certificados','Certificados',NULL,'2015-04-14 16:00:32',0,1),(23,21,1,23,'2015','2015',NULL,'2015-04-14 16:00:42',0,1),(24,22,1,24,'REGISTRO DIGESA.pdf','REGISTRO DIGESA.pdf','digesa','2015-04-14 16:01:14',0,1),(25,22,1,25,'MARZO.xlsx','MARZO.xlsx','','2015-04-14 16:11:16',1,1),(26,22,1,26,'CVI-1042-14 Country Club Ds Dz Agosto.pdf','CVI-1042-14 Country Club Ds Dz Agosto.pdf','','2015-04-14 16:12:08',1,1),(27,3,2,27,'Array2XML.php','Array2XML.php','archivos de prueba','2015-05-18 04:23:08',0,1),(28,3,2,28,'Editor Temporal.html','Editor Temporal.html','archivos de prueba','2015-05-18 04:23:08',0,1),(29,3,2,29,'dibujo de los 5 sentidos','dibujo de los 5 sentidos','','2015-05-18 04:31:34',0,0),(30,3,2,30,'dibujos que empiezan con a','dibujos que empiezan con a','','2015-05-18 04:31:34',0,0),(31,3,2,31,'dibujo de los 5 sentidos','dibujo de los 5 sentidos','','2015-05-18 04:31:34',0,0),(32,3,2,32,'dibujos que empiezan con a','dibujos que empiezan con a','','2015-05-18 04:31:34',0,0),(33,3,2,33,'dibujos que empiezan con a','dibujos que empiezan con a','desde el mÃ³vil ','2015-05-18 04:33:54',1,1);
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
INSERT INTO `file_system_download` VALUES (1,4,'2015-04-13 02:25:16','190.232.224.179'),(2,12,'2015-04-14 15:18:55','190.232.2.201'),(3,15,'2015-04-14 15:53:11','190.113.210.94'),(4,15,'2015-04-14 15:53:13','190.113.210.94'),(5,25,'2015-04-14 16:11:21','190.232.2.201'),(6,26,'2015-04-14 16:15:12','190.232.2.201'),(7,33,'2015-05-20 01:45:38','190.232.224.179');
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

-- Dump completed on 2015-05-20 15:45:57
