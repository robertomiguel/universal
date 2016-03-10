-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: universal
-- ------------------------------------------------------
-- Server version	5.5.47-0+deb7u1

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
-- Dumping data for table `productor`
--

LOCK TABLES `productor` WRITE;
/*!40000 ALTER TABLE `productor` DISABLE KEYS */;
INSERT INTO `productor` (`id`, `localidad_id`, `codigo`, `zona`, `apellido`, `nombre`, `domicilio`, `tel`, `celular`, `created_at`, `updated_at`) VALUES (1,724,'1','','Debelo','Alexis','Maestro Mazza 369','','153 230316','2014-09-01 14:44:00','2015-09-28 13:43:13'),(2,724,'2','','Alberttazzi','Juan Carlos','Pasco 4607','153 361307','','2014-09-01 14:48:00','2014-09-01 14:48:00'),(3,724,'3','','Napoli','Gustavo','Constitucion 891','156 502204','','2014-09-01 14:50:00','2014-09-01 14:50:00'),(4,724,'4','','Rodriguez','Pablo','Zolizz 1072','155 953737','','2014-09-01 14:50:00','2014-09-01 14:50:00'),(5,724,'5','','Alberttazzi','Nestor','Lima 1422','0341 6791831','','2014-09-01 14:51:00','2014-09-09 10:40:59'),(6,724,'6','','Paniagua','Marcelo Claudio','Pje. Boman 3490','0341 4661442','156656959/152829998','2014-09-03 09:47:00','2014-09-05 09:06:07'),(7,724,'7','','Martinez','Alvaro German','Pueyrredon 215','0341 4352660','341 6832117','2014-09-05 09:06:00','2014-09-05 09:06:00');
/*!40000 ALTER TABLE `productor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-10 17:52:30
