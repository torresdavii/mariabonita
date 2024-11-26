CREATE DATABASE  IF NOT EXISTS `mariabonita` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `mariabonita`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mariabonita
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `bebidas`
--

DROP TABLE IF EXISTS `bebidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bebidas` (
  `idbebidas` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `condicao` varchar(45) NOT NULL,
  PRIMARY KEY (`idbebidas`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bebidas`
--

LOCK TABLES `bebidas` WRITE;
/*!40000 ALTER TABLE `bebidas` DISABLE KEYS */;
INSERT INTO `bebidas` VALUES (1,'Água natural','500 ml','agua','images/aguanatural.png',1.99,'enabled'),(2,'Água com gás','500 ml','agua','images/aguacomgas.png',2.99,'enabled'),(3,'Coca-cola','Lata 250 ml','refrigerante','images/coca250.png',3.00,'enabled'),(4,'Coca-cola','Lata 350 ml','refrigerante','images/coca350.jpg',3.50,'enabled'),(5,'Coca-cola','600 ml','refrigerante','images/coca600ml.png',5.00,'enabled'),(6,'Guaraná Antártica','Lata 350 ml','refrigerante','images/guaranaantartica350.png',3.50,'enabled'),(7,'Guaraná Antártica','600 ml','refrigerante','images/guaranaantartica600.png',5.00,'enabled'),(8,'Fanta Uva','Lata 350 ml','refrigerante','images/fantauva350.png',3.50,'enabled'),(9,'Fanta Uva','600 ml','refrigerante','images/fantauva600.png',5.00,'enabled'),(10,'Fanta Laranja','Lata 350 ml','refrigerante','images/fantalaranja350.png',3.50,'enabled'),(11,'Fanta Laranja','600 ml','refrigerante','images/fantalaranja600.png',5.00,'enabled'),(12,'Sprite','Lata 350 ml','refrigerante','images/sprite350.png',3.50,'enabled'),(13,'Suco de Laranja','Copo','suco','images/sucolaranja.jpg',4.00,'enabled'),(14,'Suco de Laranja','Jarra','suco','images/sucolaranja.jpg',8.00,'enabled'),(15,'Suco de Abacaxi','Copo','suco','images/sucoabacaxi.jpg',4.00,'enabled'),(16,'Suco de Abacaxi','Jarra','suco','images/sucoabacaxi.jpg',8.00,'enabled'),(17,'Suco de Goiaba','Copo','suco','images/sucogoiaba.png',4.00,'enabled'),(18,'Suco de Goiaba','Jarra','suco','images/sucogoiaba.png',8.00,'enabled'),(19,'Suco de Maracujá','Copo','suco','images/sucomaracuja.png',4.00,'enabled'),(20,'Suco de Maracujá','Jarra','suco','images/imagem_2024-10-24_232804205.png',8.00,'enabled'),(21,'Suco de Limão','Copo','suco','images/sucolimao.jpeg',4.00,'enabled'),(22,'Suco de Limão','Jarra','suco','images/sucolimao.jpeg',8.00,'enabled');
/*!40000 ALTER TABLE `bebidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `idclientes` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  PRIMARY KEY (`usuario`),
  UNIQUE KEY `idclientes_UNIQUE` (`idclientes`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Administrador','ADM@adm','7G!kLz#pQ9xB&2sW'),(3,'Davi','davi','davi@davi123'),(6,'Ícaro','icaro','icaro7020'),(4,'Patrick','pk','patrick0'),(5,'Vinicius','Potoqueiro','emanuel1'),(2,'Everson','SorrisoNow','everson123'),(7,'Alisson','telles','alisson123');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_pedidos`
--

DROP TABLE IF EXISTS `itens_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `itens_pedidos` (
  `iditens_pedidos` int(11) NOT NULL AUTO_INCREMENT,
  `pedidos_idpedidos` int(11) NOT NULL,
  `quantidade_bebida` varchar(45) NOT NULL,
  `quantidade_prato` varchar(45) NOT NULL,
  `nome_prato` varchar(255) NOT NULL,
  `nome_bebida` varchar(255) NOT NULL,
  PRIMARY KEY (`iditens_pedidos`),
  KEY `fk_itens_pedidos_pedidos1_idx` (`pedidos_idpedidos`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_pedidos`
--

LOCK TABLES `itens_pedidos` WRITE;
/*!40000 ALTER TABLE `itens_pedidos` DISABLE KEYS */;
INSERT INTO `itens_pedidos` VALUES (1,1,'1','1','Frango assado','Guaraná Antártica'),(2,2,'1,1','1','Churrasco','Água com gás,Coca-cola'),(3,3,'1','1','Costela','Coca-cola'),(4,4,'1','1','Feijoada','Suco de Laranja'),(5,5,'2','1','Frango ao molho','Fanta Laranja'),(6,6,'1,1','1','Pernil Frito','Coca-cola,Guaraná Antártica'),(7,7,'','1','Costela','');
/*!40000 ALTER TABLE `itens_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `idpedidos` int(11) NOT NULL AUTO_INCREMENT,
  `clientes_usuario` varchar(45) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `pagamento` varchar(45) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idpedidos`),
  KEY `fk_pedidos_clientes_idx` (`clientes_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,'Administrador','ETB','pix',22.00),(2,'Everson','QN 05 Arniqueiras ','pix',22.99),(3,'Davi','Riacho Fundo - Quadra 7','pix',20.50),(4,'Patrick','Samambaia Sul - Quadra 300','dinheiro',21.00),(5,'Vinicius','Estrutural - Quadra central','credito',24.00),(6,'Ícaro','Samambaia Sul - Quadra 500','pix',27.00),(7,'Alisson','ETB','debito',17.00);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pratos`
--

DROP TABLE IF EXISTS `pratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pratos` (
  `idpratos` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `acompanhamentos` varchar(200) NOT NULL,
  `diaSemana` varchar(45) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `tipoCarne` varchar(200) NOT NULL,
  `condicao` varchar(45) NOT NULL,
  PRIMARY KEY (`idpratos`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pratos`
--

LOCK TABLES `pratos` WRITE;
/*!40000 ALTER TABLE `pratos` DISABLE KEYS */;
INSERT INTO `pratos` VALUES (1,'Strogonoff','Arroz, Feijão, Salada, Macarrão, Farofa','segunda','images/strogonoff.png',17.00,'Peito de frango, Carne Moída','enabled'),(2,'Churrasco','Arroz, Feijão, Salada, Macarrão, Farofa','segunda','images/churrasco.png',17.00,'Linguiça, Peito com bacon, Alcatra','enabled'),(3,'Frango assado','Arroz, Feijão, Salada, Macarrão, Farofa','segunda','images/frangoAssado.png',17.00,'Frango assado','enabled'),(4,'Frango ao molho','Arroz, Feijão, Salada, Macarrão, Farofa','segunda','images/frangoaomolho.png',17.00,'Frango ao molho','enabled'),(5,'Linguiça','Arroz, Feijão, Salada, Macarrão, Farofa','segunda','images/linguica.png',17.00,'Linguiça apimentada, Linguiça de frango, Linguiça calabresa','enabled'),(6,'Mocotó','Arroz, Feijão, Salada, Macarrão, Farofa','terca','images/mocoto.jpg',17.00,'Pé de boi, Carne-seca, Bucho','enabled'),(7,'Churrasco','Arroz, Feijão, Salada, Macarrão, Farofa','terca','images/churrasco.png',17.00,'Linguiça, Peito com bacon, Alcatra','enabled'),(8,'Frango assado','Arroz, Feijão, Salada, Macarrão, Farofa','terca','images/frangoAssado.png',17.00,'Frango assado','enabled'),(9,'Costela','Arroz, Feijão, Salada, Macarrão, Farofa','terca','images/costela.jpg',17.00,'Costela bovina assada, Costela suína','enabled'),(10,'Dobradinha','Arroz, Feijão, Salada, Macarrão, Farofa','terça','images/dobradinha.jpg',17.00,'Bucho, Linguiça calabresa, Bacon, Carne-seca','enabled'),(11,'Fígado','Arroz, Feijão, Salada, Macarrão, Farofa','terça','images/figado.png',17.00,'Fígado acebolado, Fígado com pimentão','enabled'),(12,'Churrasco','Arroz, Feijão, Salada, Macarrão, Farofa','quarta','images/churrasco.png',17.00,'Linguiça, Peito com bacon, Alcatra','enabled'),(13,'Frango assado','Arroz, Feijão, Salada, Macarrão, Farofa','quarta','images/frangoAssado.png',17.00,'Frango assado','enabled'),(14,'Frango ao molho','Arroz, Feijão, Salada, Macarrão, Farofa','quarta','images/frangoaomolho.png',17.00,'Frango ao molho','enabled'),(15,'Peixe Frito','Arroz, Feijão, Salada, Macarrão, Farofa','quarta','images/peixefrito.jpg',17.00,'Filé de tilápia, Filé de merluza, Filé de traíra ou pintado','enabled'),(16,'Filé de frango empanado','Arroz, Feijão, Salada, Macarrão, Farofa','quarta','images/filedefrango.jpg',17.00,'Filé de frango','enabled'),(17,'Pernil Frito','Arroz, Feijão, Salada, Macarrão, Farofa','quinta','images/pernilfrito.png',17.00,'Pernil Frito','enabled'),(18,'Churrasco','Arroz, Feijão, Salada, Macarrão, Farofa','quinta','images/churrasco.png',17.00,'Asa de frango, alcatra, linguiça','enabled'),(19,'Frango assado','Arroz, Feijão, Salada, Macarrão, Farofa','quinta','images/frangoAssado.png',17.00,'Frango assado','enabled'),(20,'Costela','Arroz, Feijão, Salada, Macarrão, Farofa','quinta','images/costela.jpg',17.00,'Costela bovina assada, Costela suína','enabled'),(21,'Churrasco','Arroz, Feijão, Salada, Macarrão, Farofa','sexta','images/churrasco.png',17.00,'Linguiça, Peito com bacon, Alcatra','enabled'),(22,'Frango assado','Arroz, Feijão, Salada, Macarrão, Farofa','sexta','images/frangoAssado.png',17.00,'Coxinha da asa, Asa de frango, Coxa, Sobrecoxa','enabled'),(23,'Frango ao molho','Arroz, Feijão, Salada, Macarrão, Farofa','sexta','images/frangoaomolho.png',17.00,'Frango ao molho','enabled'),(24,'Feijoada','Arroz, Feijão, Salada, Macarrão, Farofa','sexta','images/feijoada.png',17.00,'Carne seca, Costela de porco, Lombo de porco, Pé e orelha de porco','enabled'),(25,'Filé de frango empanado','Arroz, Feijão, Salada, Macarrão, Farofa','sabado','images/filedefrango.jpg',17.00,'Filé de frango','enabled'),(26,'Churrasco','Arroz, Feijão, Salada, Macarrão, Farofa','sabado','images/churrasco.png',17.00,'Linguiça, Peito com bacon, Alcatra','enabled'),(27,'Frango assado','Arroz, Feijão, Salada, Macarrão, Farofa','sabado','images/frangoAssado.png',17.00,'Asa de Frango, Coxinha de Asa, Coxa com Sobrecoxa','enabled'),(28,'Costela','Arroz, Feijão, Salada, Macarrão, Farofa','sabado','images/costela.jpg',17.00,'Costela bovina assada, Costela suína','enabled'),(29,'Pernil ','Arroz, Feijão, Salada, Macarrão, Farofa','sexta','images/pernilfrito.png',17.00,'Pernil','enabled');
/*!40000 ALTER TABLE `pratos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'mariabonita'
--

--
-- Dumping routines for database 'mariabonita'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-25  0:03:32
