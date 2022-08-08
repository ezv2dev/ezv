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

/*Table structure for table `activity_statistic` */

DROP TABLE IF EXISTS `activity_statistic`;

CREATE TABLE `activity_statistic` (
  `id_activity_statistic` int(11) NOT NULL AUTO_INCREMENT,
  `id_activity` int(11) DEFAULT NULL,
  `activity_views` bigint(20) DEFAULT '0',
  `video_views` bigint(20) DEFAULT '0',
  `photo_views` bigint(20) DEFAULT '0',
  `month` tinyint(4) DEFAULT '0',
  `year` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_activity_statistic`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `activity_statistic` */

insert  into `activity_statistic`(`id_activity_statistic`,`id_activity`,`activity_views`,`video_views`,`photo_views`,`month`,`year`,`created_at`,`updated_at`) values
(1,4,2,0,0,8,2022,'2022-08-08 13:28:44','2022-08-08 13:28:53');

/*Table structure for table `hotel_statistic` */

DROP TABLE IF EXISTS `hotel_statistic`;

CREATE TABLE `hotel_statistic` (
  `id_hotel_statistic` int(11) NOT NULL AUTO_INCREMENT,
  `id_hotel` int(11) DEFAULT NULL,
  `hotel_views` bigint(20) DEFAULT '0',
  `video_views` bigint(20) DEFAULT '0',
  `photo_views` bigint(20) DEFAULT '0',
  `month` tinyint(4) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_hotel_statistic`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `hotel_statistic` */

insert  into `hotel_statistic`(`id_hotel_statistic`,`id_hotel`,`hotel_views`,`video_views`,`photo_views`,`month`,`year`,`created_at`,`updated_at`) values
(1,2,2,0,0,8,2022,'2022-08-08 13:29:21','2022-08-08 13:29:35');

/*Table structure for table `restaurant_statistic` */

DROP TABLE IF EXISTS `restaurant_statistic`;

CREATE TABLE `restaurant_statistic` (
  `id_restaurant_statistic` int(11) NOT NULL AUTO_INCREMENT,
  `id_restaurant` int(11) DEFAULT NULL,
  `restaurant_views` bigint(20) DEFAULT '0',
  `video_views` bigint(20) DEFAULT '0',
  `photo_views` bigint(20) DEFAULT '0',
  `month` tinyint(4) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_restaurant_statistic`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `restaurant_statistic` */

insert  into `restaurant_statistic`(`id_restaurant_statistic`,`id_restaurant`,`restaurant_views`,`video_views`,`photo_views`,`month`,`year`,`created_at`,`updated_at`) values
(1,2,2,0,0,8,2022,'2022-08-08 13:27:58','2022-08-08 13:28:23');

/*Table structure for table `villa_statistic` */

DROP TABLE IF EXISTS `villa_statistic`;

CREATE TABLE `villa_statistic` (
  `id_villa_statistic` int(11) NOT NULL AUTO_INCREMENT,
  `id_villa` int(11) DEFAULT NULL,
  `villa_views` bigint(20) DEFAULT '0',
  `video_views` bigint(20) DEFAULT '0',
  `photo_views` bigint(20) DEFAULT '0',
  `month` tinyint(4) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_villa_statistic`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `villa_statistic` */

insert  into `villa_statistic`(`id_villa_statistic`,`id_villa`,`villa_views`,`video_views`,`photo_views`,`month`,`year`,`created_at`,`updated_at`) values
(1,14,4,0,0,7,2022,'2022-08-08 13:18:33','2022-08-08 13:19:18'),
(2,14,4,0,0,6,2022,'2022-08-08 13:19:06','2022-08-08 13:20:30'),
(3,14,8,0,0,8,2022,'2022-08-08 13:21:36','2022-08-08 13:27:31');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
