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

/*Table structure for table `amenities` */

DROP TABLE IF EXISTS `amenities`;

CREATE TABLE `amenities` (
  `id_amenities` int(10) NOT NULL AUTO_INCREMENT,
  `icon` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) NOT NULL,
  PRIMARY KEY (`id_amenities`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

/*Data for the table `amenities` */

insert  into `amenities`(`id_amenities`,`icon`,`name`,`order`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(5,'parking','Parking',1,'2022-01-21 04:48:23','2022-01-21 04:53:48',1,1),
(6,'wifi','Wifi',6,'2022-01-21 04:50:25','2022-01-21 04:54:10',1,1),
(8,'swimming-pool','Private Pool',3,'2022-01-30 00:28:36','2022-01-30 00:28:36',1,1),
(9,'door-closed','Private Entrance',7,'2022-01-30 00:43:45','2022-01-30 00:43:45',1,1),
(10,'wind','Air Conditioning',8,'2022-01-30 00:51:34','2022-01-30 00:51:34',1,1),
(11,'ban','Free Cancelation',9,'2022-01-30 00:51:34','2022-01-30 00:51:34',1,1),
(12,'building','Ocean View',10,'2022-01-30 00:51:34','2022-01-30 00:51:34',1,1),
(13,'coffee','Breakfast',2,'2022-01-30 00:51:34','2022-01-30 00:51:34',1,1),
(14,'bullseye','Kitchen',11,'2022-01-30 00:51:34','2022-01-30 00:51:34',1,1),
(15,'circle','Books material',12,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(16,'circle','Ethernet connection',13,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(17,'circle','Exercise equipment\r\n',14,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(18,'circle','Game console',15,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(19,'circle','Piano',16,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(20,'circle','Ping pong table',17,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(21,'circle','Pool table',18,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(22,'circle','Record player',19,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(23,'circle','Sound system',20,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(24,'circle','TV',21,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(25,'circle','Ceiling fan',22,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(26,'circle','Heating',23,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(27,'circle','Indoor fireplace',24,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(28,'circle','Portable fans',25,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(29,'circle','Pocket wifi',26,'2022-01-30 08:51:34','2022-01-30 08:51:34',1,1),
(30,'circle','Elevator',27,'2022-05-26 18:58:43','2022-05-26 18:58:43',1,1),
(31,'circle','Electric vehicle charger',28,'2022-05-26 18:59:04','2022-05-26 18:59:04',1,1),
(32,'circle','Gym',29,'2022-05-26 19:05:29','2022-05-26 19:05:29',1,1),
(33,'circle','Hot tub',30,'2022-05-26 19:05:37','2022-05-26 19:05:37',1,1),
(34,'circle','Private living room',31,'2022-05-26 19:05:40','2022-05-26 19:05:40',1,1),
(35,'circle','Washing machine',32,'2022-05-26 19:05:40','2022-05-26 19:05:40',1,1),
(36,'umbrella-beach','Beachfront ',33,'2022-05-26 19:05:40','2022-05-26 19:05:40',1,1),
(37,'circle','Jacuzzi',34,'2022-05-26 19:05:40','2022-05-26 19:05:40',1,1),
(38,'circle','Sauna',35,'2022-05-26 19:05:40','2022-05-26 19:05:40',1,1),
(39,'people-group','Housekeeping',4,'2022-05-26 19:05:40','2022-05-26 19:05:40',1,1),
(40,'umbrella-beach','Beach Front',5,'2022-05-26 19:05:40','2022-05-26 19:05:40',1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
