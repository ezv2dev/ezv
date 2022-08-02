/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.7.33 : Database - db_ezv2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_ezv2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_ezv2`;

/*Table structure for table `villa_booking` */

DROP TABLE IF EXISTS `villa_booking`;

CREATE TABLE `villa_booking` (
  `id_booking` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_payment` bigint(20) NOT NULL,
  `id_user` bigint(20) unsigned DEFAULT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `id_villa` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `child` int(11) NOT NULL,
  `id_extra_price` int(11) NOT NULL,
  `number_extra` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `villa_price` int(11) NOT NULL,
  `extra_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `method` int(1) DEFAULT NULL COMMENT '1 = bank trf\r\n2 = paypal',
  `status` int(1) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id_booking`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `villa_booking_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `villa_booking` */

insert  into `villa_booking`(`id_booking`,`id_payment`,`id_user`,`no_invoice`,`firstname`,`lastname`,`email`,`phone`,`id_villa`,`adult`,`child`,`id_extra_price`,`number_extra`,`check_in`,`check_out`,`villa_price`,`extra_price`,`total_price`,`method`,`status`,`ip`,`session_id`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(12,0,29,'EZV-V0001','putu','tangkas','a@gmail.com','12345',14,2,1,0,0,'2022-04-27','2022-04-27',5000000,0,20000000,1,1,'123','123','2022-04-28 23:34:01','2022-04-28 23:34:03',1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
