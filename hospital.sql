CREATE DATABASE  IF NOT EXISTS `hospital` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `hospital`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: hospital
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.19-MariaDB

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
  `time` datetime NOT NULL,
  `meds` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment`
--

LOCK TABLES `appointment` WRITE;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;
INSERT INTO `appointment` VALUES (1,3,3,1,'2017-10-11 00:00:00',''),(2,4,18,2,'2017-10-14 00:00:00',''),(3,1,0,2,'2017-11-03 00:00:00',''),(4,1,7,3,'2018-05-29 00:00:00','sfsf'),(5,4,17,1,'2018-06-20 00:00:00','aaa'),(6,4,17,1,'2018-07-11 02:44:09','aaa'),(7,5,17,2,'2018-06-19 17:09:05','ghg'),(8,0,0,-4,'2018-06-21 00:17:59',''),(9,0,0,0,'2018-07-09 22:49:59',''),(10,1,0,0,'2018-07-11 18:04:25',''),(11,1,50,1,'2018-07-11 19:07:58',''),(12,1,2,1,'2018-07-11 19:58:09',''),(13,1,53,2,'2018-07-12 22:09:39','');
/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor` (
  `docid` int(10) NOT NULL AUTO_INCREMENT,
  `docname` char(150) DEFAULT NULL,
  PRIMARY KEY (`docid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (1,'a'),(2,'Kasun'),(3,'Amila');
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `onlineappointment`
--

DROP TABLE IF EXISTS `onlineappointment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `onlineappointment` (
  `appointmentid` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `doc` int(11) DEFAULT NULL,
  `contact` varchar(12) NOT NULL,
  `appointmenttype` int(5) NOT NULL,
  PRIMARY KEY (`appointmentid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `onlineappointment`
--

LOCK TABLES `onlineappointment` WRITE;
/*!40000 ALTER TABLE `onlineappointment` DISABLE KEYS */;
INSERT INTO `onlineappointment` VALUES (1,'Tushara','Perera',28,1,'awdawd','kurunegala',1,'0766500626',1);
/*!40000 ALTER TABLE `onlineappointment` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (1,'Dilan','Chathuranga',23,1,1,'12312313','my name','aw da dawdad,\nawd aw dd a'),(4,'dilan','Ruwan',23,1,2,'943012960V','','sada'),(7,'Amila','Perera',0,1,0,'7812378232','',''),(8,'Suresh','Kumara',23,1,0,'','','');
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
  `spec` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','6ffcc0d3641930e3d8980ec43343ccc5','Chathuranga','Dilan',0,'943012997V',23,'Kurunegala',1,NULL,1),(53,'doctor','6ffcc0d3641930e3d8980ec43343ccc5','Sampath','Amila',1,'837537543543',37,'Kurunegala',1,'Sergeon',0),(54,'nurse','6ffcc0d3641930e3d8980ec43343ccc5','Kumara','Saman',2,'7853578347V',22,'Kandy',1,'',0),(55,'atendent','6ffcc0d3641930e3d8980ec43343ccc5','Alwis','Amith',3,'6723472332V',22,'Colombo',1,'',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'hospital'
--

--
-- Dumping routines for database 'hospital'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-13  9:28:43
