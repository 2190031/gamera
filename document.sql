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
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `folder` char(2) NOT NULL DEFAULT '1/',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `help`
--

LOCK TABLES `help` WRITE;
/*!40000 ALTER TABLE `help` DISABLE KEYS */;
INSERT INTO `help` VALUES (50,'\n','<p>qwertyuiopasdfghjklzxcvbnm</p>','1'),(52,'jhkblañboi','<p>,jkhbñaonfóuañib</p>','1');
/*!40000 ALTER TABLE `help` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `help_sec`
--

DROP TABLE IF EXISTS `help_sec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `help_sec` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `prim_parent` int NOT NULL,
  `folder` char(2) NOT NULL DEFAULT '2/',
  PRIMARY KEY (`id`),
  KEY `hierarchy_idx` (`prim_parent`),
  CONSTRAINT `prim_parent` FOREIGN KEY (`prim_parent`) REFERENCES `help` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `help_sec`
--

LOCK TABLES `help_sec` WRITE;
/*!40000 ALTER TABLE `help_sec` DISABLE KEYS */;
INSERT INTO `help_sec` VALUES (16,'nghvj,bhkl','<p>kytoulioogit</p>',52,'2');
/*!40000 ALTER TABLE `help_sec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `help_ter`
--

DROP TABLE IF EXISTS `help_ter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `help_ter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `sec_parent` int NOT NULL,
  `folder` char(2) NOT NULL DEFAULT '3/',
  PRIMARY KEY (`id`),
  KEY `hierarchy_idx` (`sec_parent`),
  CONSTRAINT `sec_parent` FOREIGN KEY (`sec_parent`) REFERENCES `help_sec` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `help_ter`
--

LOCK TABLES `help_ter` WRITE;
/*!40000 ALTER TABLE `help_ter` DISABLE KEYS */;
/*!40000 ALTER TABLE `help_ter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_help_prim_sec`
--

DROP TABLE IF EXISTS `vw_help_prim_sec`;
/*!50001 DROP VIEW IF EXISTS `vw_help_prim_sec`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_help_prim_sec` AS SELECT 
 1 AS `id_help_prim`,
 1 AS `title_prim`,
 1 AS `id_help_sec`,
 1 AS `title_sec`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_help_sec_ter`
--

DROP TABLE IF EXISTS `vw_help_sec_ter`;
/*!50001 DROP VIEW IF EXISTS `vw_help_sec_ter`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_help_sec_ter` AS SELECT 
 1 AS `id_help_sec`,
 1 AS `title_sec`,
 1 AS `id_help_ter`,
 1 AS `title_ter`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'document'
--

--
-- Dumping routines for database 'document'
--

--
-- Final view structure for view `vw_help_prim_sec`
--

/*!50001 DROP VIEW IF EXISTS `vw_help_prim_sec`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = cp850 */;
/*!50001 SET character_set_results     = cp850 */;
/*!50001 SET collation_connection      = cp850_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_help_prim_sec` AS select `help`.`id` AS `id_help_prim`,`help`.`title` AS `title_prim`,`help_sec`.`id` AS `id_help_sec`,`help_sec`.`title` AS `title_sec` from (`help` join `help_sec`) where (`help`.`id` = `help_sec`.`prim_parent`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_help_sec_ter`
--

/*!50001 DROP VIEW IF EXISTS `vw_help_sec_ter`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = cp850 */;
/*!50001 SET character_set_results     = cp850 */;
/*!50001 SET collation_connection      = cp850_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_help_sec_ter` AS select `help_sec`.`id` AS `id_help_sec`,`help_sec`.`title` AS `title_sec`,`help_ter`.`id` AS `id_help_ter`,`help_ter`.`title` AS `title_ter` from (`help_sec` join `help_ter`) where (`help_sec`.`id` = `help_ter`.`sec_parent`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-11  8:24:30
