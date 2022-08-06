/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.7.33 : Database - db_ezv
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_ezv` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_ezv`;

/*Table structure for table `house_rules` */

DROP TABLE IF EXISTS `house_rules`;

CREATE TABLE `house_rules` (
  `id_house_rules` int(11) NOT NULL AUTO_INCREMENT,
  `id_villa` int(11) NOT NULL,
  `children` enum('yes','no') DEFAULT NULL,
  `infants` enum('yes','no') DEFAULT NULL,
  `pets` enum('yes','no') DEFAULT NULL,
  `smoking` enum('yes','no') DEFAULT NULL,
  `events` enum('yes','no') DEFAULT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `additional_rules` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_house_rules`),
  KEY `id_villa` (`id_villa`),
  CONSTRAINT `house_rules_ibfk_1` FOREIGN KEY (`id_villa`) REFERENCES `villa` (`id_villa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `house_rules` */

insert  into `house_rules`(`id_house_rules`,`id_villa`,`children`,`infants`,`pets`,`smoking`,`events`,`check_in`,`check_out`,`additional_rules`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,14,'yes','yes','no','yes','yes','01:04:00','13:04:00','kkoko','2022-05-08 09:07:06','2022-08-06 13:04:37',1,1),
(2,242,'yes','yes','yes','yes','no',NULL,NULL,NULL,'2022-06-17 00:54:49','2022-06-17 00:54:49',NULL,NULL),
(3,196,'yes','yes','yes','yes','no',NULL,NULL,NULL,'2022-06-17 00:54:49','2022-06-17 00:54:49',NULL,NULL),
(4,327,'yes','no','yes','yes','no',NULL,NULL,NULL,'2022-07-21 15:48:17','2022-07-21 15:48:17',NULL,NULL),
(5,29,'yes','yes','yes','no','no',NULL,NULL,NULL,'2022-08-03 16:36:40','2022-08-03 16:36:40',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
