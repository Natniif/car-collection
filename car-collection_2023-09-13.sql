# ************************************************************
# Sequel Ace SQL dump
# Version 20050
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 11.0.3-MariaDB-1:11.0.3+maria~ubu2204)
# Database: car-collection
# Generation Time: 2023-09-13 09:09:21 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cars
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cars`;

CREATE TABLE `cars` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `year_made` year(4) DEFAULT NULL,
  `zero_sixty` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;

INSERT INTO `cars` (`id`, `name`, `year_made`, `zero_sixty`, `price`, `brand`, `deleted`)
VALUES
	(1,'bughatti veryron','2010',2.3,2000000,'bughatti',b'1'),
	(2,'Car 1','2020',5.2,25000,'Brand A',b'1'),
	(3,'Car 2','2019',6,30000,'Brand B',b'1'),
	(4,'Car 3','2021',4.8,28000,'Brand A',b'0'),
	(5,'Car 4','2018',6.5,22000,'Brand C',b'0'),
	(6,'Car 5','2022',4.2,35000,'Brand B',b'0'),
	(7,'Ferrari spyder','2000',2.3,200000,'ferrari',b'0'),
	(8,'Ferrari','2000',2.3,200000,'ferrari',b'0'),
	(9,'fin','2020',23.2,12390,'fin',b'1'),
	(10,'Ferrari Spyder','2010',2.5,200000,'Ferrari',b'1'),
	(11,'fin','2000',23,234,'lkjdsf',b'1'),

/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
