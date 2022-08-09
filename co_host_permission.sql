/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.7.33 : Database - ezv2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ezv2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ezv2`;

/*Table structure for table `co_host_permission` */

DROP TABLE IF EXISTS `co_host_permission`;

CREATE TABLE `co_host_permission` (
  `id_co_host_permission` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_detail` bigint(20) DEFAULT NULL,
  `listing` enum('no','yes') DEFAULT NULL,
  `reservation` enum('no','yes') DEFAULT NULL,
  `calendar` enum('no','yes') DEFAULT NULL,
  `statistic` enum('no','yes') DEFAULT NULL,
  `finance` enum('no','yes') DEFAULT NULL,
  `inbox` enum('no','yes') DEFAULT NULL,
  `collaboration` enum('no','yes') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_co_host_permission`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `co_host_permission` */

insert  into `co_host_permission`(`id_co_host_permission`,`id_detail`,`listing`,`reservation`,`calendar`,`statistic`,`finance`,`inbox`,`collaboration`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(2,22,'no','yes','no','no','no','no','no','2022-08-08 17:18:42','2022-08-08 17:18:42',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
