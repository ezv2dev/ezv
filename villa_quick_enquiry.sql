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

/*Table structure for table `villa_quick_enquiry` */

DROP TABLE IF EXISTS `villa_quick_enquiry`;

CREATE TABLE `villa_quick_enquiry` (
  `id_quick_enquiry` int(11) NOT NULL AUTO_INCREMENT,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `adult` int(11) DEFAULT NULL,
  `child` int(11) DEFAULT NULL,
  `additional_information` text,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_sender` varchar(255) DEFAULT NULL,
  `email_receiver` varchar(255) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_quick_enquiry`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `villa_quick_enquiry` */

insert  into `villa_quick_enquiry`(`id_quick_enquiry`,`check_in`,`check_out`,`adult`,`child`,`additional_information`,`first_name`,`last_name`,`email_sender`,`email_receiver`,`phone`,`created_at`,`updated_at`) values 
(1,'2023-08-09','2023-08-17',1,0,'ada','Angga','Kusuma','superadmin@example.com',NULL,8102812121,'2022-07-18 11:48:12','2022-07-18 11:48:12');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
