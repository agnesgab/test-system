-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: test_system
-- ------------------------------------------------------
-- Server version	8.0.34-0ubuntu0.22.04.1

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
-- Table structure for table `question_answer_options`
--

DROP TABLE IF EXISTS `question_answer_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_answer_options` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `option_text` varchar(255) NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `question_answer_options_id_uindex` (`id`),
  KEY `question_answer_options_questions_id_fk` (`question_id`),
  CONSTRAINT `question_answer_options_questions_id_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_answer_options`
--

LOCK TABLES `question_answer_options` WRITE;
/*!40000 ALTER TABLE `question_answer_options` DISABLE KEYS */;
INSERT INTO `question_answer_options` VALUES (18,5,'Berlin',0),(19,5,'Madrid',0),(20,5,'Rome',0),(21,5,'Paris',1),(22,6,'Nile',1),(23,6,'Amazon',0),(24,6,'Mississippi',0),(25,6,'Yangtze',0),(26,7,'6',0),(27,7,'7',1),(28,8,'Steven Spielberg',1),(29,8,'Steven Spielberg',0),(30,8,'Christopher Nolan',0),(31,8,'Quentin Tarantino',0),(32,9,'Tom Hanks',0),(33,9,'Brad Pitt',0),(34,9,'Johnny Depp',0),(35,9,'Leonardo DiCaprio',1),(36,10,'6',0),(37,10,'3',1),(42,12,'Go',0),(43,12,'Au',1),(44,12,'Ag',0),(45,12,'Gd',0),(46,13,'Oxygen',1),(47,13,'Hydrogen',0),(48,14,'Earth',0),(49,14,'Venus',0),(50,14,'Mars',1),(51,14,'Jupiter',0),(52,15,'Atom',1),(53,15,'Molecule',0);
/*!40000 ALTER TABLE `question_answer_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `test_id` int NOT NULL,
  `question_text` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `questions_id_uindex` (`id`),
  KEY `questions_tests_id_fk` (`test_id`),
  CONSTRAINT `questions_tests_id_fk` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (5,4,'What is the capital of France?'),(6,4,'Which river is the longest in the world?'),(7,4,'How many continents are there in the world?'),(8,5,'Who directed the movie Jurassic Park?'),(9,5,'Which actor played the character Jack Dawson in the movie Titanic?'),(10,5,'How many Star Wars movies were released in the original trilogy?'),(12,3,'What is the chemical symbol for gold?'),(13,3,'Which gas is most abundant in the Earths atmosphere?'),(14,3,'Which planet is known as the Red Planet?'),(15,3,'What is the smallest unit of matter?');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tests_id_uindex` (`id`),
  UNIQUE KEY `tests_name_uindex` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` VALUES (4,'Geography test'),(5,'Movie test'),(3,'Science test');
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_test_answers`
--

DROP TABLE IF EXISTS `user_test_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_test_answers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_uuid` varchar(255) NOT NULL,
  `test_id` int NOT NULL,
  `question_id` int NOT NULL,
  `answer_option_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_test_answers_id_uindex` (`id`),
  KEY `user_test_answers_question_answer_options_id_fk` (`answer_option_id`),
  KEY `user_test_answers_questions_id_fk` (`question_id`),
  KEY `user_test_answers_tests_id_fk` (`test_id`),
  KEY `user_test_answers_users_uuid_fk` (`user_uuid`),
  CONSTRAINT `user_test_answers_question_answer_options_id_fk` FOREIGN KEY (`answer_option_id`) REFERENCES `question_answer_options` (`id`),
  CONSTRAINT `user_test_answers_questions_id_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  CONSTRAINT `user_test_answers_tests_id_fk` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`),
  CONSTRAINT `user_test_answers_users_uuid_fk` FOREIGN KEY (`user_uuid`) REFERENCES `users` (`uuid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_test_answers`
--

LOCK TABLES `user_test_answers` WRITE;
/*!40000 ALTER TABLE `user_test_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_test_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_test_results`
--

DROP TABLE IF EXISTS `user_test_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_test_results` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_uuid` varchar(255) NOT NULL,
  `test_id` int NOT NULL,
  `correct_answers` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_test_results_id_uindex` (`id`),
  KEY `user_test_results_tests_id_fk` (`test_id`),
  KEY `user_test_results_users_uuid_fk` (`user_uuid`),
  CONSTRAINT `user_test_results_tests_id_fk` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_test_results_users_uuid_fk` FOREIGN KEY (`user_uuid`) REFERENCES `users` (`uuid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_test_results`
--

LOCK TABLES `user_test_results` WRITE;
/*!40000 ALTER TABLE `user_test_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_test_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_id_uindex` (`id`),
  UNIQUE KEY `users_uuid_uindex` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2023-09-18  0:09:30
