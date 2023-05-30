-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: locauto
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorie` (
  `id_categorie` varchar(1) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `prix` int(11) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` VALUES ('A','Citadine',60),('B','Economique',72),('C','Compact',80),('D','Intermédiaire',95),('E','Berline',120),('F','Grande berline',150),('G','Sport SUV',230),('V','Luxe',350);
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `choix_option`
--

DROP TABLE IF EXISTS `choix_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `choix_option` (
  `id_option` int(11) NOT NULL,
  `id_location` int(11) NOT NULL,
  PRIMARY KEY (`id_option`,`id_location`),
  KEY `choix_Location0_FK` (`id_location`),
  CONSTRAINT `choix_Location0_FK` FOREIGN KEY (`id_location`) REFERENCES `location` (`id_location`),
  CONSTRAINT `choix_Option_FK` FOREIGN KEY (`id_option`) REFERENCES `option` (`id_option`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `choix_option`
--

LOCK TABLES `choix_option` WRITE;
/*!40000 ALTER TABLE `choix_option` DISABLE KEYS */;
INSERT INTO `choix_option` VALUES (1,1),(2,8),(3,2),(3,3),(4,4);
/*!40000 ALTER TABLE `choix_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `id_type_de_client` int(11) NOT NULL,
  PRIMARY KEY (`id_client`),
  KEY `Client_Type_de_client_FK` (`id_type_de_client`),
  CONSTRAINT `Client_Type_de_client_FK` FOREIGN KEY (`id_type_de_client`) REFERENCES `type_de_client` (`id_type_de_client`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'malkovitch','john','paradise street',1),(2,'smith','bill','hell. city',2),(3,'murray','bill','les fleurs du mal',3),(4,'nature','gwendal','rennes',1),(5,'Bidon','Client','adresse bidon',1);
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `compteur_debut` int(11) NOT NULL,
  `compteur_fin` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_voiture` int(11) NOT NULL,
  PRIMARY KEY (`id_location`),
  KEY `Location_Client_FK` (`id_client`),
  KEY `Location_Voiture0_FK` (`id_voiture`),
  CONSTRAINT `Location_Client_FK` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  CONSTRAINT `Location_Voiture0_FK` FOREIGN KEY (`id_voiture`) REFERENCES `voiture` (`id_voiture`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (1,'2022-01-01','2022-01-02',2001,2055,1,1),(2,'2022-03-01','2022-03-02',19345,19867,1,4),(3,'2022-03-30','2022-04-01',6453,6548,2,11),(4,'2022-01-15','2022-01-18',6345,6543,2,16),(8,'2023-05-26','2023-05-27',400,800,5,8);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marque`
--

DROP TABLE IF EXISTS `marque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marque` (
  `id_marque` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id_marque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marque`
--

LOCK TABLES `marque` WRITE;
/*!40000 ALTER TABLE `marque` DISABLE KEYS */;
INSERT INTO `marque` VALUES (1,'Alfa Romeo'),(2,'Ford'),(3,'BMW'),(4,'Volkswagen'),(5,'Peugeot'),(6,'Fiat'),(7,'Mercedes'),(8,'Infinity'),(9,'Opel'),(10,'Smart'),(11,'Skoda'),(12,'Jaguar'),(13,'Mini'),(14,'Porsche'),(15,'Citroen');
/*!40000 ALTER TABLE `marque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modele`
--

DROP TABLE IF EXISTS `modele`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modele` (
  `id_modele` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `id_categorie` varchar(1) NOT NULL,
  `id_marque` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id_modele`),
  KEY `Modele_Categorie_FK` (`id_categorie`),
  KEY `Modele_Marque0_FK` (`id_marque`),
  CONSTRAINT `Modele_Categorie_FK` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`),
  CONSTRAINT `Modele_Marque0_FK` FOREIGN KEY (`id_marque`) REFERENCES `marque` (`id_marque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modele`
--

LOCK TABLES `modele` WRITE;
/*!40000 ALTER TABLE `modele` DISABLE KEYS */;
INSERT INTO `modele` VALUES (1,'Giulietta','D',1,'alfa-romeo-giulietta.jpg'),(2,'S-MAX','E',2,'ford-smax.jpg'),(3,'Série 3','D',3,'bmw-3.jpg'),(4,'Série 7','F',3,'bmw-7.jpg'),(5,'Polo','B',4,'vw-polo.jpg'),(6,'Kuga','G',2,'ford-kuga.jpg'),(7,'308','B',5,'peugeot-308.jpg'),(8,'Cinquecento','A',6,'fiat-500.jpg'),(9,'Classe E','F',7,'mercedes-e.jpg'),(10,'308 Break','C',5,'peugeot-308-break.jpg'),(11,'Q50','G',8,'infiniti-q50.jpg'),(12,'X5','V',3,'bmw-x5.jpg'),(13,'Astra Break','D',9,'opel-astra-break.jpg'),(14,'For Two','A',10,'smart-fortwo.jpg'),(15,'Classe B','E',7,'mercedes-b.jpg'),(16,'C-Max','D',2,'ford-cmax.jpg'),(17,'Passat Break','C',4,'vw-passat-break.jpg'),(18,'Jumpy 9 places','E',15,'citroen-jumpy.jpg'),(19,'Octavia Break','D',11,'skoda-octavia-break.jpg'),(20,'3008','D',5,'peugeot-3008.jpg'),(21,'X1','G',3,'bmw-x1.jpg'),(22,'Scirocco','D',4,'vw-scirocco.jpg'),(23,'XF','V',12,'jaguar-xf.jpg'),(24,'Série 3 Break','E',3,'bmw-3-break.jpg'),(25,'Cooper','C',13,'mini-cooper.jpg'),(26,'Panamera','V',14,'porsche-panamera.jpg'),(27,'Cinquecento','A',6,'fiat-500.jpg');
/*!40000 ALTER TABLE `modele` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `option`
--

DROP TABLE IF EXISTS `option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `option` (
  `id_option` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_option`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option`
--

LOCK TABLES `option` WRITE;
/*!40000 ALTER TABLE `option` DISABLE KEYS */;
INSERT INTO `option` VALUES (1,'Assurance complémentaire',50),(2,'Nettoyage',75),(3,'Complément carburant',30),(4,'Retour autre ville',250),(5,'Rabais dimanche',-40),(6,'tout propre',100);
/*!40000 ALTER TABLE `option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_de_client`
--

DROP TABLE IF EXISTS `type_de_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_de_client` (
  `id_type_de_client` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id_type_de_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_de_client`
--

LOCK TABLES `type_de_client` WRITE;
/*!40000 ALTER TABLE `type_de_client` DISABLE KEYS */;
INSERT INTO `type_de_client` VALUES (1,'Particulier'),(2,'Entreprise'),(3,'Administration'),(4,'Association'),(5,'Longue duree');
/*!40000 ALTER TABLE `type_de_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voiture`
--

DROP TABLE IF EXISTS `voiture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `voiture` (
  `id_voiture` int(11) NOT NULL AUTO_INCREMENT,
  `immatriculation` varchar(50) NOT NULL,
  `compteur` int(11) NOT NULL,
  `id_modele` int(11) NOT NULL,
  PRIMARY KEY (`id_voiture`),
  KEY `Voiture_Modele_FK` (`id_modele`),
  CONSTRAINT `Voiture_Modele_FK` FOREIGN KEY (`id_modele`) REFERENCES `modele` (`id_modele`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voiture`
--

LOCK TABLES `voiture` WRITE;
/*!40000 ALTER TABLE `voiture` DISABLE KEYS */;
INSERT INTO `voiture` VALUES (1,'123 ABC 456',2055,1),(2,'215 QKX 284',27655,2),(3,'234 ATV 765',5789,3),(4,'238 SFG 387',19867,4),(5,'241 GST 356',21765,5),(6,'293 LXU 428',3682,6),(7,'349 DES 974',6548,7),(8,'426 DEH 935',12546,8),(9,'427 XHQ 765',23768,9),(10,'470 DKJ 639',28476,10),(11,'537 QSD 276',6548,11),(12,'542 SQU 387',128,12),(13,'543 KDE 735',43276,13),(14,'634 DJH 724',23102,14),(15,'654 HDY 528',8545,10),(16,'732 HFD 383',6543,14),(17,'734 SED 359',12345,7),(18,'744 HFS 296',44346,5),(19,'753 FSC 945',7654,19),(20,'753 SUR 871',21865,7),(21,'754 GYH 749',250,21),(22,'765 HDW 347',7534,22),(23,'765 KJH 364',7652,23),(24,'765 SRC 234',9864,24),(25,'853 DJY 284',76443,25),(26,'857 HDE 248',7538,26),(27,'863 NBS 738',28765,8),(28,'864 LQD 482',7646,19),(29,'865 KSC 912',27486,16),(30,'873 MHF 487',76534,15),(31,'934 KDS 452',12635,17),(32,'985 FSZ 238',8543,20);
/*!40000 ALTER TABLE `voiture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'locauto'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-26 14:37:46
