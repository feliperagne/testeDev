CREATE DATABASE  IF NOT EXISTS `projetodev` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `projetodev`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: projetodev
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (10,'2024-02-24-174613','App\\Database\\Migrations\\CreateUsuariosTable','default','App',1708888515,1),(11,'2024-02-24-174623','App\\Database\\Migrations\\CreatePostsTable','default','App',1708888515,1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `foto` varchar(1000) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (9,'Felipe Ragne Silveira','http://localhost:8080/uploads/1708950631_14d6bfa3e2f118f47f29.jpeg','\"Esse é seu Dashboard do integrador, aqui pode ter controle total da integração\r\n\r\nEssa primeira seção informe a quantidade de produtos integrados:\r\n\r\nA primeira caixa é a quantidade de produtos que esta disponível na sua loja;\r\nA segunda se refere a quantidade integrada com o app;\r\nA terceira é referente a árvore de categorias, o app baixa sua árvore de categorias que se torna uma tela de acesso ao catálogo, você pode forçar a atualização da árvore clicando em atualizar.\"'),(10,'Felipe Ragne Silveira434123432','http://localhost:8080/uploads/1708899459_2e9a58991924903fb8e5.png','eeeeeeeeeeeeeeeeeee'),(12,'felipe santista programador','http://localhost:8080/uploads/1708899515_b5cabcfb560e06d27b94.png','santos!!'),(13,'Proteja suas vendas no App com a Clear Sale','http://localhost:8080/uploads/1708951299_90d07f308b1338fa3bc4.png','Vamos la:\r\n\r\n1 - Para que o Módulo apareça para ser ativado, clique no link Integrações logo abaixo\r\n\r\n2 - Você será redirecionado para a tela de integrações, agora no campo de busca informe Clear Sale e clique em Instalar\r\n\r\n3 - Informe os dados de acesso da sua loja e em seguida clique em autorizar\r\n\r\n4 - Agora é necessário informar os dados de acesso da sua conta na Clear Sale\r\n');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Felipe Ragne Silveira','felipesilveira','$2y$10$A.ud4vQTzi0xG.Fca9C9Y.h8TC5LV/f7IO5OUMBnbRzluaV9AGKXu'),(2,'wesley ceresa','wesley','$2y$10$34NNg2mcZdxOzNSgfLKZM.uzrTM9YdIrzuCy1WoXbmgrdETs2C5K.');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-01  8:36:20
