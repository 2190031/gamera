CREATE DATABASE  IF NOT EXISTS `document` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `document`;
-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: document
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `help`
--

DROP TABLE IF EXISTS `help`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `help` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `help`
--

LOCK TABLES `help` WRITE;
/*!40000 ALTER TABLE `help` DISABLE KEYS */;
INSERT INTO `help` VALUES (4,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(5,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(6,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(7,'','<p>幸せは歩いてこないだから歩いてゆくんだね 一日一歩三日で散歩</p>'),(8,'','<p>幸せは歩いてこないだから歩いてゆくんだね 一日一歩三日で散歩</p>'),(9,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(10,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(11,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(12,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(13,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(14,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(15,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(16,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(17,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(18,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(19,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(20,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(21,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(22,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(23,'','<h1>Hello World!</h1><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(24,'','<h1>Hello Wold!</h1><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(25,'','<h1>Placeholder text</h1><h2><span style=\"color: rgb(32, 33, 34);\">Lorem ipsum </span></h2><h3>Common form of the text</h3><p><a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\" target=\"_blank\" style=\"color: rgb(32, 33, 34);\"><strong><em><u>Lorem ipsum</u></em></strong></a><em style=\"color: rgb(32, 33, 34);\"> dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</em><span style=\"color: rgb(32, 33, 34);\"> </span><u style=\"color: rgb(32, 33, 34);\">Ut enim ad minim veniam,</u><span style=\"color: rgb(32, 33, 34);\"> quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p><p><br></p>'),(26,'','<h1>Placeholder text</h1><h2><span style=\"color: rgb(32, 33, 34);\">Lorem ipsum </span></h2><h3>Common form of the text</h3><p><a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\" target=\"_blank\" style=\"color: rgb(32, 33, 34);\"><strong><em><u>Lorem ipsum</u></em></strong></a><em style=\"color: rgb(32, 33, 34);\"> dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</em><span style=\"color: rgb(32, 33, 34);\"> </span><u style=\"color: rgb(32, 33, 34);\">Ut enim ad minim veniam,</u><span style=\"color: rgb(32, 33, 34);\"> quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.gggggggggg</span></p><p><br></p>'),(27,'','<h1>Placeholder text</h1><h2><span style=\"color: rgb(32, 33, 34);\">Lorem ipsum </span></h2><h3>Common form of the text</h3><p><a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\" target=\"_blank\" style=\"color: rgb(32, 33, 34);\"><strong><em><u>Lorem ipsum</u></em></strong></a><em style=\"color: rgb(32, 33, 34);\"> dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</em><span style=\"color: rgb(32, 33, 34);\"> </span><u style=\"color: rgb(32, 33, 34);\">Ut enim ad minim veniam,</u><span style=\"color: rgb(32, 33, 34);\"> quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p><p><br></p>'),(28,'','<h1>Placeholder text</h1><h2><span style=\"color: rgb(32, 33, 34);\">Lorem ipsum </span></h2><h3>Common form of the text</h3><p><a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\" target=\"_blank\" style=\"color: rgb(32, 33, 34);\"><strong><em><u>Lorem ipsum</u></em></strong></a><em style=\"color: rgb(32, 33, 34);\"> dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</em><span style=\"color: rgb(32, 33, 34);\"> </span><u style=\"color: rgb(32, 33, 34);\">Ut enim ad minim veniam,</u><span style=\"color: rgb(32, 33, 34);\"> quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est </span><a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\" target=\"_blank\" style=\"color: rgb(32, 33, 34);\">laborum</a><span style=\"color: rgb(32, 33, 34);\">.</span></p><p><br></p>'),(29,'','<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(30,'','<p>Hello World!</p><p>Some initial</p>'),(31,'','<p>AA<strong>AA<em>AA<u>AA</u></em></strong></p><p><br></p>'),(32,NULL,'<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(33,NULL,'<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(34,NULL,'<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(35,NULL,'<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(36,NULL,'<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(37,NULL,'<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>'),(38,NULL,'<p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>');
/*!40000 ALTER TABLE `help` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-27 11:21:52
