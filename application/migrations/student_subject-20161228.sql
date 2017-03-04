-- MySQL dump 10.13  Distrib 5.7.14, for Win32 (AMD64)
--
-- Host: localhost    Database: student_subjects
-- ------------------------------------------------------
-- Server version 5.7.14

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'anthony','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),(2,'mikko','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),(3,'wendell','66b1b5f5504f3357c503617f6070edf85af9dc7a'),(4,'lyn','66b1b5f5504f3357c503617f6070edf85af9dc7a'),(12,'eric','cc8c4809cee3ad5d81133c28b6d82dea96ab8f03');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `payment_id` int(9) NOT NULL AUTO_INCREMENT,
  `student_id` int(9) NOT NULL DEFAULT '0',
  `total_amount` int(9) NOT NULL DEFAULT '0',
  `change` int(9) NOT NULL DEFAULT '0',
  `transaction_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,115,20001,1,'2016-12-15 01:39:07',1),(2,52,19501,1,'2016-12-15 01:39:49',1),(3,50,19501,1,'2016-12-15 01:40:22',1),(4,172,20001,1,'2016-12-15 01:40:55',1),(5,174,20001,1,'2016-12-15 01:41:55',1),(6,160,20501,1,'2016-12-15 01:42:22',1),(7,49,20001,1,'2016-12-15 01:42:59',1),(8,125,23001,1,'2016-12-15 01:43:32',1),(9,115,20001,1,'2015-02-15 01:46:45',1),(10,174,20001,1,'2015-02-15 01:47:15',1),(11,172,20001,1,'2015-02-15 01:47:51',1),(12,52,19501,1,'2015-02-15 01:48:16',1),(13,51,20001,1,'2015-02-15 01:48:41',1),(14,117,23001,1,'2015-02-15 01:49:06',1),(15,106,20001,1,'2015-02-15 01:49:38',1),(16,173,23001,1,'2015-02-15 01:50:22',1),(17,125,23001,1,'2015-06-15 01:51:12',1),(18,115,20001,1,'2015-06-15 01:51:35',1),(19,106,20001,1,'2015-06-15 01:51:54',1),(20,49,20001,1,'2015-06-15 01:52:19',1),(21,174,20001,1,'2015-06-15 01:53:16',1),(22,52,19501,1,'2015-06-15 01:53:38',1),(23,173,23001,1,'2015-06-15 01:54:05',1),(24,172,20001,1,'2015-06-15 01:54:31',1),(25,115,20001,1,'2015-10-15 01:55:09',1),(26,117,23001,1,'2015-10-15 01:55:34',1),(27,106,20001,1,'2015-10-15 01:55:56',1),(28,51,20001,1,'2015-10-15 01:56:23',1),(29,50,19501,1,'2015-10-15 01:56:52',1),(30,172,20001,1,'2015-10-15 01:57:24',1),(31,173,23001,1,'2015-10-15 01:57:45',1),(32,49,20001,1,'2015-10-15 01:58:57',1),(33,50,19501,1,'2016-02-15 01:59:41',1),(34,52,19501,1,'2016-02-15 02:00:04',1),(35,174,20001,1,'2016-02-15 02:00:38',1),(36,49,20001,1,'2016-02-15 02:01:07',1),(37,125,23001,1,'2016-02-15 02:01:23',1),(38,143,19501,1,'2016-02-15 02:01:40',1),(39,160,20501,1,'2016-02-15 02:02:24',1),(40,117,23001,1,'2016-02-15 02:02:45',1),(41,125,23001,1,'2016-06-15 02:03:12',1),(42,117,23001,1,'2016-06-15 02:03:29',1),(43,115,20001,1,'2016-06-15 02:03:45',1),(44,160,20501,1,'2016-06-15 02:04:05',1),(45,174,20001,1,'2016-06-15 02:04:27',1),(46,49,20001,1,'2016-06-15 02:04:45',1),(47,52,19501,1,'2016-06-15 02:05:15',1),(48,143,19501,1,'2016-06-15 02:05:41',1),(49,106,20001,1,'2016-12-15 02:08:18',1),(79,160,20501,1,'2016-12-26 19:05:57',0),(76,117,23001,1,'2016-12-26 19:03:56',1),(78,106,20001,1,'2016-12-26 19:05:29',1),(77,115,20001,1,'2016-12-26 19:04:46',1);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  PRIMARY KEY (`semester_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester`
--

LOCK TABLES `semester` WRITE;
/*!40000 ALTER TABLE `semester` DISABLE KEYS */;
INSERT INTO `semester` VALUES (9,'2016-01-04','2016-04-24'),(7,'2015-01-05','2015-04-21'),(35,'2016-09-12','2016-12-21'),(6,'2015-05-05','2015-08-31'),(10,'2016-05-04','2016-08-30'),(47,'2016-12-25','2017-04-19'),(39,'2015-09-13','2015-12-20');
/*!40000 ALTER TABLE `semester` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `number_of_allowed_units` int(9) DEFAULT NULL,
  `price_per_unit` int(9) DEFAULT NULL,
  `price_per_lab_unit` int(9) DEFAULT NULL,
  `price_of_misc` int(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (21,1000,1500,1000);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `science_id` int(11) DEFAULT '0',
  `history_id` int(11) DEFAULT '0',
  `math_id` int(11) DEFAULT '0',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=201 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (106,0,0,0,'Amanda','Cabrera'),(174,0,0,0,'Michael','Guttierrez'),(49,2,1,1,'Lyn','Banzon'),(50,1,3,3,'Michael ','Magtira'),(51,1,3,1,'Christian','Magtira'),(52,3,3,3,'Jr','Montezon'),(125,0,0,0,'cesar','sanglitan'),(115,0,0,0,'kevin','nash'),(143,0,0,0,'ed','dno'),(117,0,0,0,'scott','halls'),(160,0,0,0,'Sunday','bostonterrier'),(172,0,0,0,'Ronaldo','Cabrera'),(173,0,0,0,'Boy','Cabrera');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_subject_match`
--

DROP TABLE IF EXISTS `student_subject_match`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_subject_match` (
  `student_id` int(9) DEFAULT NULL,
  `subject_id` int(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_subject_match`
--

LOCK TABLES `student_subject_match` WRITE;
/*!40000 ALTER TABLE `student_subject_match` DISABLE KEYS */;
INSERT INTO `student_subject_match` VALUES (115,1),(115,4),(115,2),(115,3),(115,5),(115,6),(115,8),(115,7),(50,2),(50,1),(50,3),(174,1),(174,2),(174,3),(174,4),(174,5),(174,6),(174,7),(174,8),(49,1),(49,2),(49,3),(49,4),(49,5),(49,6),(49,7),(49,8),(125,1),(125,2),(125,3),(125,5),(125,4),(172,1),(172,5),(172,9),(172,10),(172,2),(172,4),(172,8),(106,1),(106,2),(106,3),(106,4),(106,5),(106,6),(106,7),(106,8),(50,8),(50,10),(50,11),(50,5),(160,2),(160,1),(160,8),(160,11),(160,12),(160,5),(160,4),(117,2),(117,5),(117,7),(117,9),(117,11),(117,12),(117,1),(117,6),(173,2),(173,5),(173,7),(173,9),(173,11),(173,12),(173,3),(173,6),(125,9),(125,11),(143,2),(143,6),(143,8),(143,9),(143,11),(143,7),(143,12),(143,1),(52,2),(52,6),(52,8),(52,10),(52,11),(52,12),(52,7),(52,1),(51,1),(51,2),(51,3),(51,4),(51,5),(51,6),(51,7),(51,8);
/*!40000 ALTER TABLE `student_subject_match` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` char(60) DEFAULT NULL,
  `lec_unit` int(2) DEFAULT '0',
  `lab_unit` int(2) DEFAULT '0',
  `subject_unit` int(2) DEFAULT '0',
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'Communication Skills 1',3,0,3),(2,'College Algebra',3,0,3),(3,'Plane and Spherical Trigonometry',3,0,3),(4,'Introduction to Computing',2,1,3),(5,'Knowledge Work Software and Presentation Skills',2,1,3),(6,'Physical Fitness',2,0,2),(7,'Euthenics 1',1,0,1),(8,'National Service Training Program 1',0,0,3),(9,'Communication Skills 2',3,0,3),(10,'Komunikasyon sa Akademikong Filipino',3,0,3),(11,'Analytic Geometry',3,0,3),(12,'Computer Programming 1',2,1,3);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-28 16:49:07
