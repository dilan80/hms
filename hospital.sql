-- MySQL dump 10.16  Distrib 10.1.21-MariaDB, for osx10.6 (i386)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.21-MariaDB

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
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient` int(11) NOT NULL,
  `doc` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `time` date NOT NULL,
  `meds` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment`
--

LOCK TABLES `appointment` WRITE;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;
/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `gurdian` varchar(250) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (1,'awdawd','123',23,1,1,'12312313','my name','aw da dawdad,\nawd aw dd a');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `type` int(11) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `age` int(11) NOT NULL,
  `address` text NOT NULL,
  `gender` int(11) NOT NULL,
  `spec` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'a','0cc175b9c0f1b6a831c399e269772661','new','updat',0,'',23,'New',1,'');
INSERT INTO `user` VALUES (3,'dila','dilan6370','Chathuranga','Dilan',1,'19231823',23,'awdawawdadw,\nawdawdawd awd aw ,\nawdawdawda.',1,'');
INSERT INTO `user` VALUES (6,'a3','0cc175b9c0f1b6a831c399e269772661','newawd awd ','updataw dawd',0,'',23,'New',0,'');
INSERT INTO `user` VALUES (7,'a4','0cc175b9c0f1b6a831c399e269772661','new','updat',0,'',23,'New',1,'');
INSERT INTO `user` VALUES (8,'a5','0cc175b9c0f1b6a831c399e269772661','new','updat',0,'',23,'New',1,'');
INSERT INTO `user` VALUES (9,'a6','0cc175b9c0f1b6a831c399e269772661','new','updat',0,'',23,'New',1,'');
INSERT INTO `user` VALUES (10,'a7','0cc175b9c0f1b6a831c399e269772661','new','updat',0,'',23,'New',1,'');
INSERT INTO `user` VALUES (11,'a8','0cc175b9c0f1b6a831c399e269772661','new','updat',0,'',23,'New',1,'');
INSERT INTO `user` VALUES (12,'a9','0cc175b9c0f1b6a831c399e269772661','new','updat',0,'',23,'New',1,'');
INSERT INTO `user` VALUES (13,'b1','0cc175b9c0f1b6a831c399e269772661','awd','awdawd',0,'12312313',23,'awdawdwd awdawd ,awdawd awd awd \r\n',0,'');
INSERT INTO `user` VALUES (14,'b2','0cc175b9c0f1b6a831c399e269772661','awd','awdawd',0,'12312313',23,'awdawdwd awdawd ,awdawd awd awd \r\n',0,'');
INSERT INTO `user` VALUES (15,'b3','0cc175b9c0f1b6a831c399e269772661','awd','awdawd',0,'12312313',23,'awdawdwd awdawd ,awdawd awd awd \r\n',0,'');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-02  8:26:25
