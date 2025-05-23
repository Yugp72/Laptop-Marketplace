-- MySQL dump 10.13  Distrib 5.7.24, for osx11.1 (x86_64)
--
-- Host: localhost    Database: laptop_marketplace
-- ------------------------------------------------------
-- Server version	9.2.0

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
-- Table structure for table `product_visit_counter`
--

DROP TABLE IF EXISTS `product_visit_counter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_visit_counter` (
  `product_id` int NOT NULL,
  `visit_count` int DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_visit_counter`
--

LOCK TABLES `product_visit_counter` WRITE;
/*!40000 ALTER TABLE `product_visit_counter` DISABLE KEYS */;
INSERT INTO `product_visit_counter` VALUES (1,3);
/*!40000 ALTER TABLE `product_visit_counter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_visits`
--

DROP TABLE IF EXISTS `product_visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_visits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `token` varchar(255) NOT NULL,
  `visited_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_visits`
--

LOCK TABLES `product_visits` WRITE;
/*!40000 ALTER TABLE `product_visits` DISABLE KEYS */;
INSERT INTO `product_visits` VALUES (1,1,'12424','2025-05-23 01:19:45'),(2,1,'temp1212','2025-05-23 01:19:52'),(3,1,'temp1213','2025-05-23 01:21:18');
/*!40000 ALTER TABLE `product_visits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `brand` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Dell XPS 15','High-performance laptop with 12th Gen Intel Core i7, 16GB RAM, and 512GB SSD.','Dell',1499.99,'images/dell-xps-15.jpg','2025-05-21 21:05:48'),(2,'Dell XPS 15','High-end laptop with Core i7 and 16GB RAM','Dell',1499.99,'images/dell-xps-15.jpg','2025-05-21 21:11:01'),(3,'HP Spectre x360','Convertible laptop with touch display','HP',1299.99,'images/hp-spectre.jpg','2025-05-21 21:11:01'),(4,'MacBook Air M2','Apple silicon powered thin laptop','Apple',1199.00,'images/macbook-air.jpg','2025-05-21 21:11:01');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` int DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `reviews_chk_1` CHECK (((`rating` >= 1) and (`rating` <= 5)))
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (6,1,101,5,'Fantastic performance!','2025-05-21 21:11:08'),(7,2,102,4,'Solid choice for students.','2025-05-21 21:11:08'),(8,1,103,4,'Battery life could be better.','2025-05-21 21:11:08'),(9,3,104,5,'Excellent display quality.','2025-05-21 21:11:08'),(10,2,105,3,'Good, but a bit heavy.','2025-05-21 21:11:08');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_reviews`
--

DROP TABLE IF EXISTS `service_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_key` varchar(100) NOT NULL,
  `marketplace_user_id` varchar(100) NOT NULL,
  `marketplace_username` varchar(100) NOT NULL,
  `rating` int DEFAULT NULL,
  `review_text` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_review` (`service_key`,`marketplace_user_id`),
  CONSTRAINT `service_reviews_chk_1` CHECK ((`rating` between 1 and 5))
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_reviews`
--

LOCK TABLES `service_reviews` WRITE;
/*!40000 ALTER TABLE `service_reviews` DISABLE KEYS */;
INSERT INTO `service_reviews` VALUES (1,'dell-xps-15','u001','yugpatel',5,'Excellent performance, great display.'),(2,'macbook-air-m2','u002','janesmith',4,'Very fast and lightweight, but pricey.'),(3,'hp-spectre-x360','u003','john_doe',5,'Touchscreen is responsive and battery lasts all day.'),(4,'thinkpad-x1','u004','pro_user',4,'Reliable and durable. Keyboard is best in class.'),(5,'asus-rog-g14','u005','gamerz',5,'Crushes every game I throw at it.'),(6,'acer-aspire-5','u006','student01',3,'Decent for the price, but build quality is average.'),(7,'dell-xps-15','123','yugpatel12',5,'Excellent performance and display and xyz.'),(8,'macbook-air-m2','u003','yugpatel1212',5,'Excellent performance and display and xyz.'),(9,'dell-xps-15','u002','yugpatel1212',5,'Excellent laptop. Very responsive and powerful.');
/*!40000 ALTER TABLE `service_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Yug Patel','xyz@gmail.com','$2y$12$8sdoRbLf3GzsfVViSsRmN.BAdb6n4ijfv5f7eIEBV3QlMCRWuOnnK','2025-03-21 22:56:00','admin'),(2,'Yug Patel12','xyz12@gmail.com','$2y$12$4uTxDr6yALtRTYtq.x1OGuADk0IhcHhsWv4OvP/vfj2N4pQVTvKqW','2025-03-21 23:02:16','admin'),(3,'Yug Patel12','xyz1211@gmail.com','$2y$12$/Y30IcrxX40RrkyVnaCB9etgBpIaS2jfnfIfblIx6PosaL.SZAnMO','2025-04-24 05:44:48','admin'),(4,'Xyz1212','xyz1212@gmail.com','$2y$12$ZfMvZn2GnkojhZmzga3y/.Hxfw.L5t4c5Gk6sSPpeLk0XeWstFMpC','2025-04-30 01:07:11',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visit_counter`
--

DROP TABLE IF EXISTS `visit_counter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visit_counter` (
  `id` int NOT NULL DEFAULT '1',
  `visit_count` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visit_counter`
--

LOCK TABLES `visit_counter` WRITE;
/*!40000 ALTER TABLE `visit_counter` DISABLE KEYS */;
INSERT INTO `visit_counter` VALUES (1,0);
/*!40000 ALTER TABLE `visit_counter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visit_tokens`
--

DROP TABLE IF EXISTS `visit_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visit_tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `visited_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visit_tokens`
--

LOCK TABLES `visit_tokens` WRITE;
/*!40000 ALTER TABLE `visit_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `visit_tokens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-23  1:26:16
