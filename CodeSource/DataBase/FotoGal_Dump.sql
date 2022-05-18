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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Voiture'),(2,'Informatique'),(3,'Meme'),(4,'Nourriture'),(5,'Nature'),(6,'Animaux'),(7,'Art'),(8,'Paysage'),(9,'Transport'),(10,'Humain'),(11,'Couleur'),(12,'Couple'),(13,'Buisness'),(14,'Clipart'),(15,'Jeux Vidéo'),(16,'Logo'),(17,'Icone'),(18,'Fond d&#39;écran'),(19,'Moto'),(20,'Autre');
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
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `like_unlike`
--

LOCK TABLES `like_unlike` WRITE;
/*!40000 ALTER TABLE `like_unlike` DISABLE KEYS */;
INSERT INTO `like_unlike` VALUES (55,1,'2022-05-18 10:32:11',7,58),(56,2,'2022-05-18 10:32:17',7,56),(57,1,'2022-05-18 10:32:20',7,54),(58,1,'2022-05-18 10:32:23',7,52),(59,1,'2022-05-18 10:32:26',7,50),(60,1,'2022-05-18 10:32:36',8,58),(61,1,'2022-05-18 10:32:39',8,56),(62,2,'2022-05-18 10:32:41',8,57),(63,1,'2022-05-18 10:32:42',8,55),(64,2,'2022-05-18 10:32:44',8,53),(65,1,'2022-05-18 10:32:46',8,54),(66,1,'2022-05-18 10:32:48',8,51),(67,2,'2022-05-18 10:32:50',8,52),(68,2,'2022-05-18 10:32:54',8,50),(69,1,'2022-05-18 10:32:56',8,49),(70,2,'2022-05-18 10:33:07',10,58),(71,1,'2022-05-18 10:33:10',10,57),(72,1,'2022-05-18 10:33:11',10,56),(73,1,'2022-05-18 10:33:13',10,55),(74,1,'2022-05-18 10:33:14',10,54),(75,1,'2022-05-18 10:33:16',10,53),(76,1,'2022-05-18 10:33:17',10,52),(77,1,'2022-05-18 10:33:20',10,51),(78,2,'2022-05-18 10:33:23',10,50),(79,1,'2022-05-18 10:33:25',10,49),(80,1,'2022-05-18 10:33:37',9,58),(81,1,'2022-05-18 10:33:38',9,57),(82,1,'2022-05-18 10:33:39',9,56),(83,1,'2022-05-18 10:33:41',9,55),(84,1,'2022-05-18 10:33:42',9,54),(85,1,'2022-05-18 10:33:43',9,53),(86,1,'2022-05-18 10:33:45',9,52),(87,2,'2022-05-18 10:33:46',9,51),(88,2,'2022-05-18 10:33:49',9,50),(89,1,'2022-05-18 10:33:51',9,49),(90,1,'2022-05-18 10:33:59',11,58),(91,2,'2022-05-18 10:34:01',11,57),(92,1,'2022-05-18 10:34:02',11,56),(93,1,'2022-05-18 10:34:04',11,55),(94,2,'2022-05-18 10:34:06',11,54),(95,1,'2022-05-18 10:34:08',11,53),(96,2,'2022-05-18 10:34:10',11,52),(97,2,'2022-05-18 10:34:13',11,51),(98,2,'2022-05-18 10:34:16',11,50),(99,1,'2022-05-18 10:34:18',11,49),(100,1,'2022-05-18 10:34:30',12,58),(101,1,'2022-05-18 10:34:33',12,57),(102,1,'2022-05-18 10:34:35',12,56),(103,2,'2022-05-18 10:34:37',12,55),(104,1,'2022-05-18 10:34:39',12,54),(105,2,'2022-05-18 10:34:40',12,53),(106,2,'2022-05-18 10:34:43',12,52),(107,2,'2022-05-18 10:34:45',12,51),(108,1,'2022-05-18 10:34:47',12,50),(109,1,'2022-05-18 10:34:50',12,49),(110,1,'2022-05-18 10:36:36',12,60),(111,1,'2022-05-18 10:36:37',12,59),(112,2,'2022-05-18 10:38:29',14,62),(113,1,'2022-05-18 10:38:30',14,61),(114,1,'2022-05-18 10:39:13',13,62),(115,1,'2022-05-18 10:39:13',13,61),(116,1,'2022-05-18 10:39:15',13,60),(117,2,'2022-05-18 10:39:16',13,59),(118,2,'2022-05-18 10:39:19',13,58),(119,1,'2022-05-18 10:39:20',13,57),(120,1,'2022-05-18 10:39:23',13,54),(121,2,'2022-05-18 10:39:25',13,55),(122,1,'2022-05-18 10:41:39',8,62),(123,2,'2022-05-18 10:41:40',8,61),(124,1,'2022-05-18 10:41:43',8,59),(125,2,'2022-05-18 10:44:06',8,63);
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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productions`
--

LOCK TABLES `productions` WRITE;
/*!40000 ALTER TABLE `productions` DISABLE KEYS */;
INSERT INTO `productions` VALUES (44,'Repas équilibré','ça à l&#39;air super bon !!!','2022-05-18 09:14:56','2022-05-18 09:28:18','pravkulannzadekgiycaymooaf.jpg',4,7),(45,'Motocross qui lève la roue avant','C&#39;EST IMPRESSIONNANT !','2022-05-18 09:16:12','2022-05-18 09:16:12','hmtbogmljzwpimnmtfsztpbrsa.jpg',19,7),(46,'Une belle œuvre d&#39;art','un bonhomme vert dans une position plutôt spéciale...','2022-05-18 09:16:58','2022-05-18 09:16:58','xmrkuwnjloibjinnqlxcbvsmlm.jpg',7,7),(47,'Magnifique paysage','Je sais pas ou c&#39;est mais j&#39;ai très envie d&#39;y aller !!!','2022-05-18 09:17:26','2022-05-18 09:17:26','wkpjhpnrrtwrdwdjnkjnmsghza.jpg',8,7),(48,'La nature est inroyable','photo prise par : micheline','2022-05-18 09:17:58','2022-05-18 09:17:58','tiobzmrpqhoskbjcweizfmdnxl.jpg',5,7),(49,'Subaru WRX STI','je veux cette voiture !','2022-05-18 09:18:22','2022-05-18 09:18:22','qjgzxkkyyhmvfbyeiykuzvcsrb.jpg',1,7),(50,'Méduse bleue','Elle est jolie ! Même si ça fait mal quand elle vous pique, je trouve ça beau :)','2022-05-18 09:19:20','2022-05-18 09:19:20','yxvqcebinjuultckykoptmlobv.jpg',6,7),(51,'Black & White Photography','Une belle photo portrait en noir et blanc','2022-05-18 09:19:52','2022-05-18 09:19:52','dztkonhljplnnslaaehhynmudl.jpg',10,7),(52,'Mer méditerranée ','l&#39;été me manque, les vacances au bord de la mer aussi !','2022-05-18 09:20:37','2022-05-18 09:20:37','rfopdvrtdrmlixvhsxksiknqxq.jpg',8,7),(53,'Planche de skateboard ','Plutôt petite comme planche dit donc ! Comment vous tenez debout la dessus ?!','2022-05-18 09:21:31','2022-05-18 09:21:31','ptnoiprxygmzumccvqffcdqslg.jpg',9,7),(54,'Avion','J&#39;ai peur de l&#39;avion... et vous ?','2022-05-18 09:22:27','2022-05-18 09:22:27','cawsrtdzddxpviinwpysgyppsw.jpg',9,7),(55,'TCHOU TCHOUUUU','Quand j&#39;étais petit j&#39;adorais les trains, du coup maintenant je prends en photo des trains ! Et j&#39;adore ça','2022-05-18 09:23:30','2022-05-18 09:23:30','imawiofjvhivpqqtpvvxwvljmr.jpg',9,7),(56,'POULE !!','une belle poule, sur un beau décors ','2022-05-18 09:25:38','2022-05-18 09:25:38','xmotsuzqibywlflzncqwjakwda.png',6,7),(57,'Que la foudre s&#39;abatte sur vous !','Photo par : Julien','2022-05-18 09:27:06','2022-05-18 09:27:06','jeclqytgudesmhrlkleelgumew.jpeg',5,7),(58,'Colors everywhere','Une guirlande multicolore ! c&#39;est joli','2022-05-18 09:27:50','2022-05-18 09:27:50','srwpyczblvoftjmqwemogcexys.jpeg',11,7),(59,'Bmw S1000 RR','Incroyable cette bécane ','2022-05-18 10:35:59','2022-05-18 10:35:59','zhemaeppzpczicejiayleaurhr.jpeg',19,12),(60,'Bmw e46','C&#39;est ma voiture !!!!!!! Vous la trouvez comment?','2022-05-18 10:36:33','2022-05-18 10:36:33','jmgkpfogbzplrdcpkmkedzviir.jpeg',1,12),(61,'Dark city','J&#39;aimerai trop habiter la bas, mais bon j&#39;ai pas d&#39;argent donc je reste chez ma maman...','2022-05-18 10:37:29','2022-05-18 10:37:29','dplbeoknqtxeqihajdsuybnfzm.jpeg',18,14),(62,'Smoking in the darkness','un homme qui fume dans une pièce sombre avec des effets de lumière','2022-05-18 10:38:27','2022-05-18 10:38:27','vyudbutpqoegrsgryfsdiqonie.jpeg',10,14),(63,'Première Production De Elias','Boxer en plein entrainement intensif ','2022-05-18 10:44:04','2022-05-18 11:24:30','atisfjraojovpwgnxhzczcpfps.jpeg',10,8);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (7,'Im The Administrator','Admin 1','Admin 1','Admin@gmail.com','f94d3a61fc4b322de134ab222d849e50f4a407f68d201ddd1ff44e57ee20339d',2),(8,'ZeiShoot','Elias','Zaiem','elias.zaiem16@gmail.com','8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320',2),(9,'Black6block','Jules','Florey','jules.flr@eduge.ch','8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320',1),(10,'Leo Sama','Leo','Montagna','leo.mntgn@eduge.ch','8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320',1),(11,'Azrod2k','David','Machado','david.mchdb@eduge.ch','8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320',1),(12,'Mazz','Marcos','Magalhaes','marcos.mglhs@eduge.ch','8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320',1),(13,'Slypps','Mathias','Nieva','mathias.nv@eduge.ch','8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320',1),(14,'EKKI','Mathias','Amato','mathias.amt@eduge.ch','8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320',1);
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

-- Dump completed on 2022-05-18 13:26:10
