-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: student_subjects
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'anthony','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),(2,'mikko','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),(3,'wendell','66b1b5f5504f3357c503617f6070edf85af9dc7a'),(4,'lyn','66b1b5f5504f3357c503617f6070edf85af9dc7a'),(12,'eric','cc8c4809cee3ad5d81133c28b6d82dea96ab8f03'),(17,'ryan corpin','99979be4c95acc307c583a82751c02c7058e93a5'),(19,'zandro.dizon','9e0aa27a4124a47e604cdaa47fc31bf51a763419'),(23,'amanda','amanda'),(22,'sundays','9376c9326f1e7000ca60ac6b6a45363295dd8439');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'phillipines','2017-03-09 18:53:54','2017-03-09 18:53:57'),(2,'usa','2017-03-09 18:54:14','2017-03-09 18:54:16'),(3,'india','2017-03-09 18:54:36','2017-03-09 18:54:38'),(4,'canada','2017-03-09 18:54:45','2017-03-09 18:54:46'),(5,'uk','2017-03-09 18:54:53','2017-03-09 18:54:54'),(6,'israel','2017-03-09 18:55:00','2017-03-09 18:55:02');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2017_03_09_050028_create_post_table',1),('2017_03_09_184422_create_countries_table',2),('2017_03_09_184603_add_country_id_column_to_users',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,115,20001,1,'2016-12-15 01:39:07',1),(2,52,19501,1,'2016-12-15 01:39:49',1),(3,50,19501,1,'2016-12-15 01:40:22',1),(4,172,20001,1,'2016-12-15 01:40:55',1),(5,174,20001,1,'2016-12-15 01:41:55',1),(6,160,20501,1,'2016-12-15 01:42:22',1),(7,49,20001,1,'2016-12-15 01:42:59',1),(8,125,23001,1,'2016-12-15 01:43:32',1),(9,115,20001,1,'2015-02-15 01:46:45',1),(10,174,20001,1,'2015-02-15 01:47:15',1),(11,172,20001,1,'2015-02-15 01:47:51',1),(12,52,19501,1,'2015-02-15 01:48:16',1),(13,51,20001,1,'2015-02-15 01:48:41',1),(14,117,23001,1,'2015-02-15 01:49:06',1),(15,106,20001,1,'2015-02-15 01:49:38',1),(16,173,23001,1,'2015-02-15 01:50:22',1),(17,125,23001,1,'2015-06-15 01:51:12',1),(18,115,20001,1,'2015-06-15 01:51:35',1),(19,106,20001,1,'2015-06-15 01:51:54',1),(20,49,20001,1,'2015-06-15 01:52:19',1),(21,174,20001,1,'2015-06-15 01:53:16',1),(22,52,19501,1,'2015-06-15 01:53:38',1),(23,173,23001,1,'2015-06-15 01:54:05',1),(24,172,20001,1,'2015-06-15 01:54:31',1),(25,115,20001,1,'2015-10-15 01:55:09',1),(26,117,23001,1,'2015-10-15 01:55:34',1),(27,106,20001,1,'2015-10-15 01:55:56',1),(28,51,20001,1,'2015-10-15 01:56:23',1),(29,50,19501,1,'2015-10-15 01:56:52',1),(30,172,20001,1,'2015-10-15 01:57:24',1),(31,173,23001,1,'2015-10-15 01:57:45',1),(32,49,20001,1,'2015-10-15 01:58:57',1),(33,50,19501,1,'2016-02-15 01:59:41',1),(34,52,19501,1,'2016-02-15 02:00:04',1),(35,174,20001,1,'2016-02-15 02:00:38',1),(36,49,20001,1,'2016-02-15 02:01:07',1),(37,125,23001,1,'2016-02-15 02:01:23',1),(38,143,19501,1,'2016-02-15 02:01:40',1),(39,160,20501,1,'2016-02-15 02:02:24',1),(40,117,23001,1,'2016-02-15 02:02:45',1),(41,125,23001,1,'2016-06-15 02:03:12',1),(42,117,23001,1,'2016-06-15 02:03:29',1),(43,115,20001,1,'2016-06-15 02:03:45',1),(44,160,20501,1,'2016-06-15 02:04:05',1),(45,174,20001,1,'2016-06-15 02:04:27',1),(46,49,20001,1,'2016-06-15 02:04:45',1),(47,52,19501,1,'2016-06-15 02:05:15',1),(48,143,19501,1,'2016-06-15 02:05:41',1),(49,106,20001,1,'2016-12-15 02:08:18',1),(81,174,20001,1,'2017-01-27 04:38:59',0),(80,174,20001,1,'2017-01-27 04:14:28',0),(79,160,20501,1,'2016-12-26 19:05:57',0),(76,117,23001,1,'2017-01-19 08:03:37',1),(78,106,20001,1,'2016-12-26 19:05:29',1),(77,115,20001,1,'2017-01-19 08:01:45',1),(124,223,23500,1,'2015-08-12 16:47:14',1),(123,223,23500,1,'2017-03-12 16:44:22',1),(122,115,22000,2200222,'2017-03-11 23:33:56',1);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,'amanda','cabrera','2017-03-09 04:18:57','2017-03-09 04:21:32'),(2,2,'anthony','cabrera','2017-03-09 04:19:08','2017-03-09 04:19:08'),(3,3,'ronaldo','cabrera','2017-03-09 04:19:10','2017-03-09 04:19:10'),(4,4,'anthony','dela cruz','2017-03-09 04:40:11','2017-03-09 04:50:40'),(5,5,'oscar','cabrera','2017-03-09 04:40:16','2017-03-09 04:40:16');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester`
--

LOCK TABLES `semester` WRITE;
/*!40000 ALTER TABLE `semester` DISABLE KEYS */;
INSERT INTO `semester` VALUES (9,'2016-01-04','2016-04-24'),(7,'2015-01-05','2015-04-21'),(35,'2016-09-12','2016-12-21'),(6,'2015-05-05','2015-08-31'),(10,'2016-05-04','2016-08-30'),(47,'2017-03-01','2017-04-18'),(39,'2015-09-13','2015-12-20'),(53,'2017-06-25','2017-12-13');
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
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `facebook_id` varchar(100) DEFAULT NULL,
  `google_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=231 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (106,0,0,0,'Amanda','Cabrera',NULL,NULL,'',''),(174,0,0,0,'Michael','Guttierrez',NULL,NULL,'',''),(49,2,1,1,'Lyn','Banzon','','','',''),(50,1,3,3,'Michael ','Magtira',NULL,NULL,'',''),(51,1,3,1,'Christian','Magtira',NULL,NULL,'',''),(52,3,3,3,'Jr','Montezon',NULL,NULL,'',''),(125,0,0,0,'cesar','sanglitan',NULL,NULL,'',''),(115,0,0,0,'kevin','nash',NULL,NULL,'',''),(143,0,0,0,'ed','dno',NULL,NULL,'',''),(117,0,0,0,'scott','hall',NULL,NULL,'',''),(160,0,0,0,'Sunday','bostonterrier',NULL,NULL,'',''),(172,0,0,0,'Ronaldo','Cabrera',NULL,NULL,'',''),(215,0,0,0,'boy','Cabrera',NULL,'10a34637ad661d98ba3344717656fcc76209c2f8','',''),(225,0,0,0,'gerald','kupal','gerald','d0e75148e85bcccebd0dafc9f1e2f78707b579bd','',''),(220,0,0,0,'eric ','albano',NULL,NULL,'',''),(221,0,0,0,'amy','sitchon',NULL,NULL,'',''),(222,0,0,0,'dennis','jacobe','dennis','15afc15301f669017837a87977d777efff6865ca','',''),(223,0,0,0,'adolf','hitler','adolf','cecafb4d7ac21fe0c872533bc45e17fe39f3e433','',''),(224,0,0,0,'tests','tests','test','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','',''),(226,0,0,0,'arnold','spiritu','arnold','37857929647ce9d4c2c68e27ea26c9bbc45b2712','',''),(228,0,0,0,'Anthony','Cabrera',NULL,NULL,'10212293349758483',''),(229,0,0,0,'Omnithopter1','Anthony',NULL,NULL,NULL,'113401627230397266723'),(230,0,0,0,'Anthony','Cabrera',NULL,NULL,NULL,'108638933120139723951');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_grade`
--

DROP TABLE IF EXISTS `student_grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_grade` (
  `student_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `mid_term` int(11) DEFAULT NULL,
  `final_term` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_grade`
--

LOCK TABLES `student_grade` WRITE;
/*!40000 ALTER TABLE `student_grade` DISABLE KEYS */;
INSERT INTO `student_grade` VALUES (115,4,NULL,NULL),(115,2,NULL,NULL),(115,3,NULL,NULL),(115,42,NULL,NULL),(115,6,NULL,NULL),(115,5,NULL,NULL),(115,7,NULL,NULL),(50,2,NULL,NULL),(50,1,NULL,NULL),(50,3,NULL,NULL),(174,1,NULL,NULL),(174,2,NULL,NULL),(174,3,NULL,NULL),(174,4,NULL,NULL),(174,5,NULL,NULL),(174,6,NULL,NULL),(174,7,NULL,NULL),(174,8,NULL,NULL),(49,1,NULL,NULL),(49,2,NULL,NULL),(49,3,NULL,NULL),(49,4,NULL,NULL),(49,5,NULL,NULL),(49,6,NULL,NULL),(49,7,NULL,NULL),(49,8,NULL,NULL),(125,1,NULL,NULL),(125,2,NULL,NULL),(125,3,NULL,NULL),(125,5,NULL,NULL),(125,4,NULL,NULL),(172,1,NULL,NULL),(172,5,NULL,NULL),(172,9,NULL,NULL),(172,10,NULL,NULL),(172,2,NULL,NULL),(172,4,NULL,NULL),(172,8,NULL,NULL),(106,1,NULL,NULL),(106,2,NULL,NULL),(106,3,NULL,NULL),(106,4,NULL,NULL),(106,5,NULL,NULL),(106,6,NULL,NULL),(106,7,NULL,NULL),(106,8,NULL,NULL),(50,8,NULL,NULL),(50,10,NULL,NULL),(50,11,NULL,NULL),(50,5,NULL,NULL),(160,2,NULL,NULL),(160,1,NULL,NULL),(160,8,NULL,NULL),(160,11,NULL,NULL),(160,12,NULL,NULL),(160,5,NULL,NULL),(160,4,NULL,NULL),(117,2,NULL,NULL),(117,5,NULL,NULL),(117,7,NULL,NULL),(117,9,NULL,NULL),(117,11,NULL,NULL),(117,12,NULL,NULL),(117,1,NULL,NULL),(117,6,NULL,NULL),(173,2,NULL,NULL),(173,5,NULL,NULL),(173,7,NULL,NULL),(173,9,NULL,NULL),(173,11,NULL,NULL),(173,12,NULL,NULL),(173,3,NULL,NULL),(173,6,NULL,NULL),(125,9,NULL,NULL),(125,11,NULL,NULL),(143,2,NULL,NULL),(143,6,NULL,NULL),(143,8,NULL,NULL),(143,9,NULL,NULL),(143,11,NULL,NULL),(143,7,NULL,NULL),(143,12,NULL,NULL),(143,1,NULL,NULL),(52,2,NULL,NULL),(52,6,NULL,NULL),(52,8,NULL,NULL),(52,10,NULL,NULL),(52,11,NULL,NULL),(52,12,NULL,NULL),(52,7,NULL,NULL),(52,1,NULL,NULL),(51,1,NULL,NULL),(51,2,NULL,NULL),(51,3,NULL,NULL),(51,4,NULL,NULL),(51,5,NULL,NULL),(51,6,NULL,NULL),(51,7,NULL,NULL),(51,8,NULL,NULL),(115,12,NULL,NULL),(222,1,NULL,NULL),(222,2,NULL,NULL),(222,3,NULL,NULL),(222,4,NULL,NULL),(222,5,NULL,NULL),(222,6,NULL,NULL),(222,7,NULL,NULL),(222,8,NULL,NULL);
/*!40000 ALTER TABLE `student_grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_subject_match`
--

DROP TABLE IF EXISTS `student_subject_match`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_subject_match` (
  `student_id` int(9) DEFAULT NULL,
  `subject_id` int(9) DEFAULT NULL,
  `mid_term` float DEFAULT NULL,
  `final_term` float DEFAULT NULL,
  `semester_id` int(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_subject_match`
--

LOCK TABLES `student_subject_match` WRITE;
/*!40000 ALTER TABLE `student_subject_match` DISABLE KEYS */;
INSERT INTO `student_subject_match` VALUES (115,4,2.75,2.5,6),(115,2,2.75,NULL,6),(115,3,NULL,NULL,6),(115,42,NULL,NULL,6),(223,2,NULL,NULL,6),(115,5,NULL,NULL,6),(50,2,NULL,NULL,9),(50,1,NULL,NULL,9),(50,3,NULL,NULL,9),(174,1,NULL,NULL,6),(174,2,NULL,NULL,6),(174,3,NULL,NULL,6),(174,4,NULL,NULL,6),(174,5,NULL,NULL,6),(174,6,NULL,NULL,6),(174,7,NULL,NULL,6),(174,8,NULL,NULL,6),(49,1,NULL,NULL,6),(49,2,NULL,NULL,6),(49,3,NULL,NULL,6),(49,4,NULL,NULL,6),(49,5,NULL,NULL,6),(49,6,NULL,NULL,6),(49,7,NULL,NULL,6),(49,8,NULL,NULL,6),(125,1,NULL,NULL,6),(125,2,NULL,NULL,6),(125,3,NULL,NULL,6),(125,5,NULL,NULL,6),(125,4,NULL,NULL,6),(172,1,NULL,NULL,6),(172,5,NULL,NULL,6),(172,9,NULL,NULL,6),(172,10,NULL,NULL,6),(172,2,NULL,NULL,6),(172,4,NULL,NULL,6),(172,8,NULL,NULL,6),(106,1,NULL,NULL,6),(106,2,NULL,NULL,6),(106,3,NULL,NULL,6),(106,4,NULL,NULL,6),(106,5,NULL,NULL,6),(106,6,NULL,NULL,6),(106,7,NULL,NULL,6),(106,8,NULL,NULL,6),(50,8,NULL,NULL,9),(50,10,NULL,NULL,9),(50,11,NULL,NULL,9),(50,5,NULL,NULL,9),(160,2,NULL,NULL,9),(160,1,NULL,NULL,9),(160,8,NULL,NULL,9),(160,11,NULL,NULL,9),(160,12,NULL,NULL,9),(160,5,NULL,NULL,9),(160,4,NULL,NULL,9),(117,2,NULL,NULL,7),(117,5,NULL,NULL,7),(117,7,NULL,NULL,7),(117,9,NULL,NULL,7),(117,11,NULL,NULL,7),(117,12,NULL,NULL,7),(117,1,NULL,NULL,7),(117,6,NULL,NULL,7),(173,2,NULL,NULL,6),(173,5,NULL,NULL,6),(173,7,NULL,NULL,6),(173,9,NULL,NULL,6),(173,11,NULL,NULL,6),(173,12,NULL,NULL,6),(173,3,NULL,NULL,6),(173,6,NULL,NULL,6),(125,9,NULL,NULL,6),(125,11,NULL,NULL,6),(143,2,NULL,NULL,9),(143,6,NULL,NULL,9),(143,8,NULL,NULL,9),(143,9,NULL,NULL,9),(143,11,NULL,NULL,9),(143,7,NULL,NULL,9),(143,12,NULL,NULL,9),(143,1,NULL,NULL,9),(52,2,NULL,NULL,6),(52,6,NULL,NULL,6),(52,8,NULL,NULL,6),(52,10,NULL,NULL,6),(52,11,NULL,NULL,6),(52,12,NULL,NULL,6),(52,7,NULL,NULL,6),(52,1,NULL,NULL,6),(51,1,NULL,NULL,7),(51,2,NULL,NULL,7),(51,3,NULL,NULL,7),(51,4,NULL,NULL,7),(51,5,NULL,NULL,7),(51,6,NULL,NULL,7),(51,7,NULL,NULL,7),(51,8,NULL,NULL,7),(115,12,NULL,NULL,6),(222,1,NULL,NULL,NULL),(222,2,NULL,NULL,NULL),(222,3,NULL,NULL,NULL),(222,4,NULL,NULL,NULL),(222,5,NULL,NULL,NULL),(222,6,NULL,NULL,NULL),(222,7,NULL,NULL,NULL),(222,8,NULL,NULL,NULL),(223,6,NULL,NULL,6),(223,11,NULL,NULL,6),(223,12,NULL,NULL,6),(223,4,NULL,NULL,6),(223,44,NULL,NULL,6),(223,3,NULL,NULL,6),(49,5,NULL,NULL,9),(49,4,NULL,NULL,9),(49,3,NULL,NULL,9),(49,2,NULL,NULL,9),(49,1,NULL,NULL,9),(49,8,NULL,NULL,9),(49,7,NULL,NULL,9),(49,6,NULL,NULL,9),(49,7,NULL,NULL,10),(49,6,NULL,NULL,10),(49,5,NULL,NULL,10),(49,4,NULL,NULL,10),(49,3,NULL,NULL,10),(49,2,NULL,NULL,10),(49,1,NULL,NULL,10),(49,8,NULL,NULL,10),(49,2,NULL,NULL,35),(49,1,NULL,NULL,35),(49,8,NULL,NULL,35),(49,7,NULL,NULL,35),(49,6,NULL,NULL,35),(49,5,NULL,NULL,35),(49,4,NULL,NULL,35),(49,3,NULL,NULL,35),(49,4,NULL,NULL,39),(49,3,NULL,NULL,39),(49,2,NULL,NULL,39),(49,1,NULL,NULL,39),(49,8,NULL,NULL,39),(49,7,NULL,NULL,39),(49,6,NULL,NULL,39),(49,5,NULL,NULL,39),(50,1,NULL,NULL,35),(50,10,NULL,NULL,35),(50,5,NULL,NULL,35),(50,2,NULL,NULL,35),(50,3,NULL,NULL,35),(50,8,NULL,NULL,35),(50,11,NULL,NULL,35),(50,11,NULL,NULL,39),(50,1,NULL,NULL,39),(50,10,NULL,NULL,39),(50,5,NULL,NULL,39),(50,2,NULL,NULL,39),(50,3,NULL,NULL,39),(50,8,NULL,NULL,39),(51,1,NULL,NULL,39),(51,4,NULL,NULL,39),(51,7,NULL,NULL,39),(51,2,NULL,NULL,39),(51,5,NULL,NULL,39),(51,8,NULL,NULL,39),(51,3,NULL,NULL,39),(51,6,NULL,NULL,39),(52,8,NULL,NULL,7),(52,6,NULL,NULL,7),(52,2,NULL,NULL,7),(52,1,NULL,NULL,7),(52,7,NULL,NULL,7),(52,12,NULL,NULL,7),(52,11,NULL,NULL,7),(52,10,NULL,NULL,7),(52,12,NULL,NULL,9),(52,11,NULL,NULL,9),(52,10,NULL,NULL,9),(52,8,NULL,NULL,9),(52,6,NULL,NULL,9),(52,2,NULL,NULL,9),(52,1,NULL,NULL,9),(52,7,NULL,NULL,9),(52,7,NULL,NULL,10),(52,12,NULL,NULL,10),(52,11,NULL,NULL,10),(52,10,NULL,NULL,10),(52,8,NULL,NULL,10),(52,6,NULL,NULL,10),(52,2,NULL,NULL,10),(52,1,NULL,NULL,10),(52,6,NULL,NULL,35),(52,2,NULL,NULL,35),(52,1,NULL,NULL,35),(52,7,NULL,NULL,35),(52,12,NULL,NULL,35),(52,11,NULL,NULL,35),(52,10,NULL,NULL,35),(52,8,NULL,NULL,35),(106,5,NULL,NULL,7),(106,8,NULL,NULL,7),(106,1,NULL,NULL,7),(106,4,NULL,NULL,7),(106,7,NULL,NULL,7),(106,3,NULL,NULL,7),(106,6,NULL,NULL,7),(106,2,NULL,NULL,7),(106,3,NULL,NULL,35),(106,6,NULL,NULL,35),(106,2,NULL,NULL,35),(106,5,NULL,NULL,35),(106,8,NULL,NULL,35),(106,1,NULL,NULL,35),(106,4,NULL,NULL,35),(106,7,NULL,NULL,35),(106,3,NULL,NULL,39),(106,6,NULL,NULL,39),(106,2,NULL,NULL,39),(106,5,NULL,NULL,39),(106,8,NULL,NULL,39),(106,1,NULL,NULL,39),(106,4,NULL,NULL,39),(106,7,NULL,NULL,39),(115,12,NULL,NULL,7),(115,4,NULL,NULL,7),(115,2,NULL,NULL,7),(115,3,NULL,NULL,7),(115,42,NULL,NULL,7),(115,5,NULL,NULL,7),(115,3,NULL,NULL,10),(115,42,NULL,NULL,10),(115,5,NULL,NULL,10),(115,12,NULL,NULL,10),(115,4,NULL,NULL,10),(115,2,NULL,NULL,10),(115,4,NULL,NULL,35),(115,2,NULL,NULL,35),(115,3,NULL,NULL,35),(115,42,NULL,NULL,35),(115,5,NULL,NULL,35),(115,12,NULL,NULL,35),(115,5,NULL,NULL,39),(115,12,NULL,NULL,39),(115,4,NULL,NULL,39),(115,2,NULL,NULL,39),(115,3,NULL,NULL,39),(115,42,NULL,NULL,39),(115,4,NULL,NULL,47),(115,2,NULL,NULL,47),(115,3,NULL,NULL,47),(115,11,NULL,NULL,47),(115,5,NULL,NULL,47),(115,7,NULL,NULL,47),(117,7,NULL,NULL,9),(117,12,NULL,NULL,9),(117,5,NULL,NULL,9),(117,11,NULL,NULL,9),(117,6,NULL,NULL,9),(117,2,NULL,NULL,9),(117,9,NULL,NULL,9),(117,1,NULL,NULL,9),(117,9,NULL,NULL,10),(117,1,NULL,NULL,10),(117,7,NULL,NULL,10),(117,12,NULL,NULL,10),(117,5,NULL,NULL,10),(117,11,NULL,NULL,10),(117,6,NULL,NULL,10),(117,2,NULL,NULL,10),(117,7,NULL,NULL,39),(117,12,NULL,NULL,39),(117,5,NULL,NULL,39),(117,11,NULL,NULL,39),(117,6,NULL,NULL,39),(117,2,NULL,NULL,39),(117,9,NULL,NULL,39),(117,1,NULL,NULL,39),(125,2,NULL,NULL,9),(125,11,NULL,NULL,9),(125,4,NULL,NULL,9),(125,1,NULL,NULL,9),(125,9,NULL,NULL,9),(125,5,NULL,NULL,9),(125,3,NULL,NULL,9),(125,2,NULL,NULL,10),(125,11,NULL,NULL,10),(125,4,NULL,NULL,10),(125,1,NULL,NULL,10),(125,9,NULL,NULL,10),(125,5,NULL,NULL,10),(125,3,NULL,NULL,10),(125,1,NULL,NULL,35),(125,9,NULL,NULL,35),(125,5,NULL,NULL,35),(125,3,NULL,NULL,35),(125,2,NULL,NULL,35),(125,11,NULL,NULL,35),(125,4,NULL,NULL,35),(143,11,NULL,NULL,10),(143,1,NULL,NULL,10),(143,8,NULL,NULL,10),(143,7,NULL,NULL,10),(143,2,NULL,NULL,10),(143,9,NULL,NULL,10),(143,12,NULL,NULL,10),(143,6,NULL,NULL,10),(160,2,NULL,NULL,10),(160,8,NULL,NULL,10),(160,12,NULL,NULL,10),(160,4,NULL,NULL,10),(160,1,NULL,NULL,10),(160,11,NULL,NULL,10),(160,5,NULL,NULL,10),(160,1,NULL,NULL,35),(160,11,NULL,NULL,35),(160,5,NULL,NULL,35),(160,2,NULL,NULL,35),(160,8,NULL,NULL,35),(160,12,NULL,NULL,35),(160,4,NULL,NULL,35),(172,9,NULL,NULL,7),(172,4,NULL,NULL,7),(172,5,NULL,NULL,7),(172,2,NULL,NULL,7),(172,1,NULL,NULL,7),(172,10,NULL,NULL,7),(172,8,NULL,NULL,7),(172,5,NULL,NULL,35),(172,2,NULL,NULL,35),(172,1,NULL,NULL,35),(172,10,NULL,NULL,35),(172,8,NULL,NULL,35),(172,9,NULL,NULL,35),(172,4,NULL,NULL,35),(172,1,NULL,NULL,39),(172,10,NULL,NULL,39),(172,8,NULL,NULL,39),(172,9,NULL,NULL,39),(172,4,NULL,NULL,39),(172,5,NULL,NULL,39),(172,2,NULL,NULL,39),(173,7,NULL,NULL,7),(173,11,NULL,NULL,7),(173,3,NULL,NULL,7),(173,5,NULL,NULL,7),(173,9,NULL,NULL,7),(173,12,NULL,NULL,7),(173,6,NULL,NULL,7),(173,2,NULL,NULL,7),(173,2,NULL,NULL,39),(173,7,NULL,NULL,39),(173,11,NULL,NULL,39),(173,3,NULL,NULL,39),(173,5,NULL,NULL,39),(173,9,NULL,NULL,39),(173,12,NULL,NULL,39),(173,6,NULL,NULL,39),(174,4,NULL,NULL,7),(174,3,NULL,NULL,7),(174,2,NULL,NULL,7),(174,1,NULL,NULL,7),(174,8,NULL,NULL,7),(174,7,NULL,NULL,7),(174,6,NULL,NULL,7),(174,5,NULL,NULL,7),(174,6,NULL,NULL,9),(174,5,NULL,NULL,9),(174,4,NULL,NULL,9),(174,3,NULL,NULL,9),(174,2,NULL,NULL,9),(174,1,NULL,NULL,9),(174,8,NULL,NULL,9),(174,7,NULL,NULL,9),(174,8,NULL,NULL,10),(174,7,NULL,NULL,10),(174,6,NULL,NULL,10),(174,5,NULL,NULL,10),(174,4,NULL,NULL,10),(174,3,NULL,NULL,10),(174,2,NULL,NULL,10),(174,1,NULL,NULL,10),(174,3,NULL,NULL,35),(174,2,NULL,NULL,35),(174,1,NULL,NULL,35),(174,8,NULL,NULL,35),(174,7,NULL,NULL,35),(174,6,NULL,NULL,35),(174,5,NULL,NULL,35),(174,4,NULL,NULL,35),(223,6,NULL,NULL,47),(223,4,NULL,NULL,47),(223,11,NULL,NULL,47),(223,44,NULL,NULL,47),(223,2,NULL,NULL,47),(223,12,NULL,NULL,47),(223,3,NULL,NULL,47),(115,9,NULL,NULL,47),(115,6,NULL,NULL,47),(50,2,NULL,NULL,47),(50,8,NULL,NULL,47),(50,11,NULL,NULL,47),(50,42,NULL,NULL,47);
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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'Communication Skills 1',3,0,3),(2,'College Algebra',3,0,3),(3,'Plane and Spherical Trigonometry',3,0,3),(4,'Introduction to Computing',2,1,3),(5,'Knowledge Work Software and Presentation Skills',2,1,3),(6,'Physical Fitness',2,0,2),(7,'Euthenics 1',1,0,1),(8,'National Service Training Program 1',0,0,3),(9,'Communication Skills 2',3,0,3),(10,'Komunikasyon sa Akademikong Filipino',3,0,3),(11,'Analytic Geometry',3,0,3),(12,'Computer Programming 1',2,1,3),(44,'bostons',3,1,4),(38,'test',1,1,2),(42,'teats',3,1,4);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'google','108638933120139723951','Anthony','Cabrera','omnithopter22@gmail.com','','en','https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg','','2017-03-30 08:11:26','2017-03-30 09:03:16');
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

-- Dump completed on 2017-04-11 10:06:13
