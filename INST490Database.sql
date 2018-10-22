CREATE DATABASE  IF NOT EXISTS `INST_490` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `INST_490`;
-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: INST_490
-- ------------------------------------------------------
-- Server version	5.7.18

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
-- Table structure for table `Core`
--

DROP TABLE IF EXISTS `Core`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Core` (
  `id_Core` int(11) NOT NULL AUTO_INCREMENT,
  `Core_number` varchar(45) NOT NULL,
  `Lock_number` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_Core`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Core`
--

LOCK TABLES `Core` WRITE;
/*!40000 ALTER TABLE `Core` DISABLE KEYS */;
INSERT INTO `Core` VALUES (1,'B',NULL),(2,'B 132',NULL),(3,'B 141X',NULL),(4,'B 151X',NULL),(5,'B 157',NULL),(6,'B110',NULL),(7,'B121',NULL),(8,'B125X',NULL),(9,'B126',NULL),(10,'B128',NULL),(11,'B131',NULL),(12,'B132',NULL),(13,'B141X',NULL),(14,'B144',NULL),(15,'B147',NULL),(16,'B167',NULL),(17,'B209',NULL),(18,'B212',NULL),(19,'B216',NULL),(20,'B66',NULL),(21,'B92',NULL);
/*!40000 ALTER TABLE `Core` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Keys`
--

DROP TABLE IF EXISTS `Keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Keys` (
  `id_keys` int(11) NOT NULL AUTO_INCREMENT,
  `key_number` varchar(45) NOT NULL,
  `id_Core` int(11) NOT NULL,
  `id_Room` int(11) NOT NULL,
  PRIMARY KEY (`id_keys`),
  KEY `fk_Keys_Core1_idx` (`id_Core`),
  KEY `fk_Keys_Room1_idx` (`id_Room`),
  CONSTRAINT `fk_Keys_Core1` FOREIGN KEY (`id_Core`) REFERENCES `Core` (`id_Core`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Keys_Room1` FOREIGN KEY (`id_Room`) REFERENCES `Room` (`id_Room`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Keys`
--

LOCK TABLES `Keys` WRITE;
/*!40000 ALTER TABLE `Keys` DISABLE KEYS */;
INSERT INTO `Keys` VALUES (1,'1067256',17,4),(2,'1173485',20,18),(3,'1279482',15,19),(4,'1385260',15,19),(5,'8732358',5,9),(6,'0316263 D',11,11),(7,'0424730 D',16,2),(8,'0640062 D',1,19),(9,'0744586 D',8,10),(10,'0746801 D',1,19),(11,'0746803 D',1,19),(12,'0747792 D',12,12),(13,'0747793 D',14,17),(14,'0748024 D',20,18),(15,'0748028 D',8,10),(16,'0748428 D',18,5),(17,'0748738 D',17,4),(18,'0852642 D',19,3),(19,'0852928 D',3,10),(20,'0857091 D',8,10),(21,'0958555 D',17,4),(22,'0962184 D',16,13),(23,'1066139 D',17,4),(24,'1066676 D',3,16),(25,'1067277D',17,4),(26,'1067379D',18,5),(27,'1069815 D',18,5),(28,'1069817 D',18,5),(29,'1170725D',19,3),(30,'1173673 D',13,16),(31,'7115857 D',2,12),(32,'7703362 D',3,16),(33,'8118896 D',6,6),(34,'8501319 D',7,7),(35,'8518525 D',1,19),(36,'8710390 D',14,17),(37,'8766165 D',3,16),(38,'9223805 D',4,8),(39,'9623513 D',1,19),(40,'9807178 D',2,12),(41,'9807179 D',9,15),(42,'M853 D',21,1),(43,'M875',10,14);
/*!40000 ALTER TABLE `Keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `People`
--

DROP TABLE IF EXISTS `People`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `People` (
  `id_names` int(11) NOT NULL AUTO_INCREMENT,
  `First_name` varchar(45) NOT NULL,
  `Last_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_names`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `People`
--

LOCK TABLES `People` WRITE;
/*!40000 ALTER TABLE `People` DISABLE KEYS */;
INSERT INTO `People` VALUES (28,'Alvin ','C'),(29,'Andrea',NULL),(30,'Christie',NULL),(31,'Dana',NULL),(32,'David ','Russell'),(33,'Dayo',NULL),(34,'Doug',NULL),(35,'Emily',NULL),(36,'Ferhan',NULL),(37,'G','Craig'),(38,'Heeyoon',NULL),(39,'Jaime',NULL),(40,'Jimmy',NULL),(41,'Joseph',NULL),(42,'Kaitlin',NULL),(43,'Leahkim ','A'),(44,'Lidan',NULL),(45,'Martha',NULL),(46,'Mary',NULL),(47,'Nima',NULL),(48,'R','Scott'),(49,'Rishi',NULL),(50,'Sarah ','Michal'),(51,'Shannon',NULL),(52,'Wendy ',NULL),(53,'William',NULL),(54,'Yan',NULL);
/*!40000 ALTER TABLE `People` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `People_has_Keys`
--

DROP TABLE IF EXISTS `People_has_Keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `People_has_Keys` (
  `id_names` int(11) NOT NULL,
  `id_keys` int(11) NOT NULL,
  PRIMARY KEY (`id_names`,`id_keys`),
  KEY `fk_People_has_Keys_Keys1_idx` (`id_keys`),
  KEY `fk_People_has_Keys_People_idx` (`id_names`),
  CONSTRAINT `fk_People_has_Keys_Keys1` FOREIGN KEY (`id_keys`) REFERENCES `Keys` (`id_keys`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_People_has_Keys_People` FOREIGN KEY (`id_names`) REFERENCES `People` (`id_names`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `People_has_Keys`
--

LOCK TABLES `People_has_Keys` WRITE;
/*!40000 ALTER TABLE `People_has_Keys` DISABLE KEYS */;
INSERT INTO `People_has_Keys` VALUES (47,1),(43,2),(46,3),(42,4),(38,5),(31,6),(49,7),(54,8),(35,9),(33,10),(48,11),(32,12),(39,13),(45,14),(49,15),(30,16),(31,17),(51,18),(31,19),(29,20),(28,21),(29,22),(44,23),(42,24),(36,25),(50,26),(53,27),(41,28),(50,29),(43,30),(49,31),(39,32),(45,32),(52,33),(52,34),(34,35),(39,36),(39,37),(38,38),(40,39),(35,40),(37,41),(39,42),(51,43);
/*!40000 ALTER TABLE `People_has_Keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Room`
--

DROP TABLE IF EXISTS `Room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Room` (
  `id_Room` int(11) NOT NULL AUTO_INCREMENT,
  `Room_number` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_Room`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Room`
--

LOCK TABLES `Room` WRITE;
/*!40000 ALTER TABLE `Room` DISABLE KEYS */;
INSERT INTO `Room` VALUES (1,'4113'),(2,'4120'),(3,'2118B'),(4,'2118D'),(5,'2118G'),(6,'4111 Pod'),(7,'4111A'),(8,'4117 Pod'),(9,'4117E'),(10,'4120 POD'),(11,'4120B'),(12,'4120C'),(13,'4120D'),(14,'4120G'),(15,'4120J'),(16,'4121 Pod'),(17,'4121C'),(18,'4121F'),(19,'Submaster');
/*!40000 ALTER TABLE `Room` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-22 17:49:27
