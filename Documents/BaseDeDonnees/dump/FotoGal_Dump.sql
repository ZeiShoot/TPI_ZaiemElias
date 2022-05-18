-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: fotogal
-- ------------------------------------------------------
-- Server version	5.5.5-10.3.34-MariaDB-0ubuntu0.20.04.1

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (7,'Voiture'),(8,'Informatique'),(10,'Meme'),(11,'Nourriture'),(12,'Nature'),(13,'Animaux'),(24,'Art'),(29,'Paysage'),(31,'Transports'),(32,'Autres');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `like_unlike`
--

DROP TABLE IF EXISTS `like_unlike`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `like_unlike` (
  `idLikeUnlike` int(11) NOT NULL AUTO_INCREMENT,
  `like` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  `utilisateurs_idUser` int(11) NOT NULL,
  `production_idProduction` int(11) NOT NULL,
  PRIMARY KEY (`idLikeUnlike`),
  KEY `like_unlike_FK` (`utilisateurs_idUser`),
  KEY `like_unlike_FK_1` (`production_idProduction`),
  CONSTRAINT `like_unlike_FK` FOREIGN KEY (`utilisateurs_idUser`) REFERENCES `utilisateurs` (`idUser`),
  CONSTRAINT `like_unlike_FK_1` FOREIGN KEY (`production_idProduction`) REFERENCES `productions` (`idProduction`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `like_unlike`
--

LOCK TABLES `like_unlike` WRITE;
/*!40000 ALTER TABLE `like_unlike` DISABLE KEYS */;
INSERT INTO `like_unlike` VALUES (39,1,'2022-05-16 13:06:09',3,19),(40,1,'2022-05-16 14:47:45',3,18),(42,1,'2022-05-17 08:51:53',4,21),(43,1,'2022-05-17 08:54:19',4,19),(44,2,'2022-05-17 08:54:32',4,18),(45,1,'2022-05-17 11:30:25',4,31),(46,2,'2022-05-17 11:30:27',4,16),(47,2,'2022-05-17 11:30:29',4,17),(48,1,'2022-05-17 11:30:30',4,15),(49,2,'2022-05-17 11:30:32',4,14),(50,1,'2022-05-17 11:30:33',4,11),(51,1,'2022-05-17 11:30:35',4,10),(52,1,'2022-05-17 11:31:55',4,32),(53,1,'2022-05-17 15:41:12',3,9);
/*!40000 ALTER TABLE `like_unlike` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productions`
--

DROP TABLE IF EXISTS `productions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productions` (
  `idProduction` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_soumission` datetime NOT NULL,
  `date_modification` datetime NOT NULL,
  `filename` varchar(255) NOT NULL,
  `categories_idCategorie` int(11) DEFAULT NULL,
  `utilisateurs_idUser` int(11) NOT NULL,
  PRIMARY KEY (`idProduction`),
  KEY `productions_FK` (`categories_idCategorie`),
  KEY `productions_FK_1` (`utilisateurs_idUser`),
  CONSTRAINT `productions_FK` FOREIGN KEY (`categories_idCategorie`) REFERENCES `categories` (`idCategorie`),
  CONSTRAINT `productions_FK_1` FOREIGN KEY (`utilisateurs_idUser`) REFERENCES `utilisateurs` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productions`
--

LOCK TABLES `productions` WRITE;
/*!40000 ALTER TABLE `productions` DISABLE KEYS */;
INSERT INTO `productions` VALUES (9,'Meme','hahaahaha','2022-05-16 08:25:48','2022-05-16 08:25:48','fomhligbteyrzcvrbtbjoeemes.jpeg',10,4),(10,'Landshaft','Un magnifique paysage','2022-05-16 08:26:40','2022-05-16 08:26:40','slnwcheszwhlylvlbaubwdvvsa.jpeg',29,4),(11,'Repas 5 étoiles','Super dressage !!!','2022-05-16 08:27:29','2022-05-16 08:27:29','pxdjkucceipxowhjbnveibowcn.jpeg',11,4),(14,'Ducati Panigale V4 Sp','C&#39;est un missile cette moto, à tester !','2022-05-16 08:31:16','2022-05-16 08:31:16','waejftcgvaukjskisylfnzttcc.jpeg',NULL,4),(15,'Un avion','Il a pas l&#39;air très à l&#39;aise l&#39;avion... ','2022-05-16 08:32:29','2022-05-16 08:32:29','vtcxyrcubrxgpfmncglhbqixjn.jpeg',31,4),(16,'Nature is beautiful','C&#39;est beau le vert? nan vous aimez pas ? bon ok...','2022-05-16 12:55:57','2022-05-16 12:55:57','vtmcjvwnzhdqxkiazqsffbuwqv.jpeg',12,3),(17,'Mazda Rx-7 Bodykit','magnifique rx7 avec son kit carosserie ','2022-05-16 12:57:01','2022-05-16 12:57:01','jtgrxmxodqmvpqlrucyzelteih.jpeg',7,3),(18,'Lomepal album cover','Couverture de l&#39;allbum de lomepal (allez écoutez, il est ouf !)','2022-05-16 12:58:21','2022-05-16 12:58:21','sfniuxvikpblgwennosfbqpugw.jpeg',32,3),(19,'Porsche 911','Dites qu&#39;elle est pas incroyable cette automobile !!!!!','2022-05-16 13:04:56','2022-05-16 13:04:56','xyrkmmogtzmwavszwumipqlboq.jpeg',7,3),(21,'Un NECUREIL !','on dit écureuil pas necureil mais bon...','2022-05-16 16:32:56','2022-05-16 16:32:56','vbpvlqzwwvvvueqshamskjcehx.jpeg',13,4),(31,'Logo de leo lm9','mon logooo','2022-05-17 11:27:42','2022-05-17 11:27:42','ykttnvgjdmgzyqzlaqrddudmtu.png',32,1),(32,'Un chat avec des lunettes ','waouh il est trop stylé ','2022-05-17 11:31:53','2022-05-17 11:31:53','sskzeopnkujmvtfifwsnwjejsj.jpeg',13,4);
/*!40000 ALTER TABLE `productions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateurs` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(45) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PasswordChiffrer` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL COMMENT '1 = utilisateur, 2 = admin',
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (1,'Leo Sama','Leo','Montagna','leo.mntgn@eduge.ch','8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320',1),(3,'ZeiShoot','Elias','Zaiem','elias.zaiem16@gmail.com','8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320',1),(4,'Im The Admin','administrateur','admin','admin@gmail.com','f94d3a61fc4b322de134ab222d849e50f4a407f68d201ddd1ff44e57ee20339d',2),(5,'black6block','Jules','Florey','jules.flr@eduge.ch','f07b88f037cb3abdd2e7162991e9e3cd04022119db4b812becbccee6b10ff7b7',1),(6,'tester','tester','tester','tester@hotmail.com','9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08',1);
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'fotogal'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-17 16:12:19
