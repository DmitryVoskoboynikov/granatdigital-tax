<?php

use yii\db\Schema;
use yii\db\Migration;

class m151102_120715_init extends Migration
{
    public function up()
    {
        $this->execute(<<<SQL
CREATE DATABASE  IF NOT EXISTS `taxi` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `taxi`;

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
-- Table structure for table `car`
--

DROP TABLE IF EXISTS `car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `car` (
  `brand` varchar(45) NOT NULL,
  `model` varchar(100) NOT NULL,
  `color_id` tinyint(2) NOT NULL,
  `number` varchar(10) NOT NULL,
  `class` tinyint(2) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cars_1_idx` (`owner_id`),
  CONSTRAINT `fk_cars_1` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `car`
--

LOCK TABLES `car` WRITE;
/*!40000 ALTER TABLE `car` DISABLE KEYS */;
/*!40000 ALTER TABLE `car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_message`
--

DROP TABLE IF EXISTS `client_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_message` (
  `client_id` int(11) NOT NULL,
  `message` varchar(500) DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`client_id`),
  KEY `fk_client_message_2_idx` (`owner_id`),
  KEY `fk_client_message_3_idx` (`company_id`),
  CONSTRAINT `fk_client_message_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_client_message_2` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_client_message_3` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_message`
--

LOCK TABLES `client_message` WRITE;
/*!40000 ALTER TABLE `client_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `status_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  CONSTRAINT `fk_company_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_balance_log`
--

DROP TABLE IF EXISTS `company_balance_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_balance_log` (
  `company_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `message` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`company_id`),
  CONSTRAINT `fk_company_balance_log_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_balance_log`
--

LOCK TABLES `company_balance_log` WRITE;
/*!40000 ALTER TABLE `company_balance_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_balance_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_message`
--

DROP TABLE IF EXISTS `company_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_message` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `message` text,
  `status_id` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_message`
--

LOCK TABLES `company_message` WRITE;
/*!40000 ALTER TABLE `company_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_setting`
--

DROP TABLE IF EXISTS `company_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_setting` (
  `company_id` int(11) NOT NULL,
  `settings` text,
  PRIMARY KEY (`company_id`),
  CONSTRAINT `fk_company_settings_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_setting`
--

LOCK TABLES `company_setting` WRITE;
/*!40000 ALTER TABLE `company_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `option`
--

DROP TABLE IF EXISTS `option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `option` (
  `id` tinyint(5) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option`
--

LOCK TABLES `option` WRITE;
/*!40000 ALTER TABLE `option` DISABLE KEYS */;
/*!40000 ALTER TABLE `option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `city` tinyint(2) NOT NULL,
  `client_name` varchar(45) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `order_start` datetime NOT NULL,
  `car_class` tinyint(2) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `address_destination` varchar(45) DEFAULT NULL,
  `comment` varchar(45) DEFAULT NULL,
  `status_id` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_orders_1_idx` (`owner_id`),
  KEY `fk_orders_2_idx` (`client_id`),
  CONSTRAINT `fk_orders_1` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_history`
--

DROP TABLE IF EXISTS `order_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_history` (
  `order_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `prev_status` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `fk_order_history_1_idx` (`owner_id`),
  CONSTRAINT `fk_order_history_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_history_2` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_history`
--

LOCK TABLES `order_history` WRITE;
/*!40000 ALTER TABLE `order_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_message`
--

DROP TABLE IF EXISTS `order_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_message` (
  `owner_id` int(11) NOT NULL,
  `message` varchar(500) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status_id` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_messages_1_idx` (`order_id`),
  KEY `fk_order_messages_2_idx` (`owner_id`),
  CONSTRAINT `fk_order_messages_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_messages_2` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_message`
--

LOCK TABLES `order_message` WRITE;
/*!40000 ALTER TABLE `order_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_option`
--

DROP TABLE IF EXISTS `order_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_option` (
  `order_id` int(11) NOT NULL,
  `option_id` tinyint(5) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `fk_order_options_2_idx` (`option_id`),
  CONSTRAINT `fk_order_options_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_options_2` FOREIGN KEY (`option_id`) REFERENCES `option` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_option`
--

LOCK TABLES `order_option` WRITE;
/*!40000 ALTER TABLE `order_option` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penalty`
--

DROP TABLE IF EXISTS `penalty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penalty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penalty`
--

LOCK TABLES `penalty` WRITE;
/*!40000 ALTER TABLE `penalty` DISABLE KEYS */;
/*!40000 ALTER TABLE `penalty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penalty_log`
--

DROP TABLE IF EXISTS `penalty_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penalty_log` (
  `id` int(11) NOT NULL,
  `penalty_id` int(11) DEFAULT NULL,
  `summ` decimal(10,2) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penalty_log`
--

LOCK TABLES `penalty_log` WRITE;
/*!40000 ALTER TABLE `penalty_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `penalty_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploaded_file`
--

DROP TABLE IF EXISTS `uploaded_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uploaded_file` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `mime` varchar(100) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_uploaded_file_1_idx` (`company_id`),
  KEY `fk_uploaded_file_2_idx` (`owner_id`),
  CONSTRAINT `fk_uploaded_file_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_uploaded_file_2` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uploaded_file`
--

LOCK TABLES `uploaded_file` WRITE;
/*!40000 ALTER TABLE `uploaded_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `uploaded_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `group_id` tinyint(5) NOT NULL,
  `login` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` char(32) NOT NULL,
  `company_id` tinyint(5) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `second_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `salt` char(10) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-02 15:37:38
SQL
        );
    }

    public function down()
    {
       return true;
    }
}
