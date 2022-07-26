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

/*Table structure for table `hotel` */

DROP TABLE IF EXISTS `hotel`;

CREATE TABLE `hotel` (
  `id_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(20) DEFAULT NULL,
  `star` enum('1','2','3','4','5') DEFAULT NULL,
  `grade` enum('AA','A','B','C','D') DEFAULT NULL,
  `id_property_type` int(11) DEFAULT NULL,
  `id_suitable` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `original_name` varchar(100) DEFAULT NULL,
  `description` text,
  `short_description` varchar(255) DEFAULT NULL,
  `as_feature` int(1) DEFAULT NULL,
  `adult` int(10) DEFAULT NULL,
  `children` int(10) DEFAULT NULL,
  `size` int(10) DEFAULT NULL,
  `bedroom` int(10) DEFAULT NULL,
  `bathroom` int(11) DEFAULT NULL,
  `beds` int(11) DEFAULT NULL,
  `parking` int(11) DEFAULT NULL,
  `min_stay` int(10) DEFAULT NULL,
  `booking` int(10) DEFAULT NULL,
  `id_location` int(10) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` int(10) DEFAULT NULL,
  `cancel` int(5) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `image_path` varchar(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `step` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `hotel` */

insert  into `hotel`(`id_hotel`,`uid`,`star`,`grade`,`id_property_type`,`id_suitable`,`name`,`original_name`,`description`,`short_description`,`as_feature`,`adult`,`children`,`size`,`bedroom`,`bathroom`,`beds`,`parking`,`min_stay`,`booking`,`id_location`,`address`,`latitude`,`longitude`,`phone`,`email`,`price`,`discount`,`cancel`,`image`,`image_path`,`status`,`step`,`views`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`) values 
(1,'zzzzz','3','AA',4,1,'zzzzz',NULL,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','A great hotel with beautiful sunset view.',NULL,4,2,NULL,2,4,3,NULL,3,NULL,4,'Jalan udayana no 11',-8.1166114,115.0872865,'081234567890','putu.tangkas17@gmail.com',1,NULL,NULL,'hotel.jpg','',0,0,NULL,'2022-01-16 17:35:23','2022-07-26 09:36:20',NULL,1,1),
(2,'Hotel Nyoman','3','AA',4,1,'Hotel Nyoman',NULL,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','A great hotel with beautiful sunset view.',NULL,4,2,NULL,2,4,3,NULL,3,NULL,4,'Jalan udayana no 11',-8.1166114,115.0872865,'081234567890','putu.tangkas17@gmail.com',2,NULL,NULL,'1658717621_jason-leung-poI7DelFiVA-unsplash.webp','',1,0,NULL,'2022-01-16 17:35:23','2022-07-25 16:52:56',NULL,1,1),
(8,'Hotel Name Here',NULL,'B',4,NULL,'Hotel Name Here',NULL,NULL,'Make your short description here',NULL,1,0,NULL,1,1,NULL,NULL,NULL,NULL,1,NULL,-8.6492553,115.1478746,NULL,NULL,3,NULL,NULL,'1652696964_edvin-johansson-rlwE8f8anOc-unsplash.jpg','',0,NULL,NULL,'2022-05-16 18:29:36','2022-07-25 09:32:12',NULL,1,1),
(9,NULL,NULL,NULL,4,NULL,'Hotel Name Here',NULL,NULL,'Make your short description here',NULL,1,0,NULL,1,1,NULL,NULL,NULL,NULL,1,NULL,-8.4553718,114.7913786,NULL,NULL,4,NULL,NULL,NULL,'',0,NULL,NULL,'2022-05-24 19:09:00','2022-07-01 16:55:49',NULL,1,1),
(10,NULL,NULL,NULL,4,NULL,'Double - Six, Luxury Hotel - Seminyak','Double - Six, Luxury Hotel - Seminyak',NULL,'Suite Junior Leisure King',NULL,1,0,NULL,1,1,NULL,NULL,NULL,NULL,1,NULL,-8.4553718,114.7913786,NULL,NULL,5,NULL,NULL,'1653983043_171415993.webp','',0,NULL,NULL,'2022-05-31 23:36:34','2022-07-25 14:44:34',NULL,212,212),
(11,NULL,NULL,NULL,4,NULL,'Hotel Name Here',NULL,NULL,'Make your short description here',NULL,1,0,NULL,1,1,NULL,NULL,NULL,NULL,1,NULL,-8.4553718,114.7913786,NULL,NULL,6,NULL,NULL,NULL,'',0,NULL,NULL,'2022-05-31 23:47:40','2022-07-25 14:32:29',NULL,212,212),
(12,NULL,NULL,NULL,4,NULL,'100 Sunset Hotel & Boutique Bali','100 Sunset Hotel & Boutique Bali',NULL,'Sunset Kuta Hotel & Ballroom boasts a stunning central location in midtown Kuta Legian. The property not only offers consistency and high standards to meet the demands of the most, but also provides extra amenities and services set in stylish and charming',NULL,2,0,NULL,1,1,NULL,NULL,NULL,NULL,9,NULL,-8.716901499999999,115.1847658,NULL,NULL,7,NULL,NULL,'1654071752_5 (1).webp','',0,NULL,NULL,'2022-06-02 00:14:41','2022-07-25 12:21:42',NULL,214,214),
(13,'611341658199356',NULL,NULL,4,NULL,'Hotel Name Here',NULL,NULL,'Make your short description here',NULL,1,0,NULL,1,1,NULL,NULL,NULL,NULL,1,NULL,-8.4553718,114.7913786,NULL,NULL,8,NULL,NULL,NULL,NULL,0,NULL,NULL,'2022-07-19 10:55:56','2022-07-25 15:15:23',NULL,300,300),
(14,'112311658199371',NULL,NULL,4,NULL,'Hotel Name Here',NULL,NULL,'Make your short description here',NULL,1,0,NULL,1,1,NULL,NULL,NULL,NULL,1,NULL,-8.4553718,114.7913786,NULL,NULL,9,NULL,NULL,NULL,NULL,0,NULL,NULL,'2022-07-19 10:56:11','2022-07-23 16:56:17',NULL,300,300),
(15,'732511658199378',NULL,NULL,4,NULL,'Hotel Name Here',NULL,NULL,'Make your short description here',NULL,1,0,NULL,1,1,NULL,NULL,NULL,NULL,1,NULL,-8.4553718,114.7913786,NULL,NULL,10,NULL,NULL,NULL,NULL,0,NULL,NULL,'2022-07-19 10:56:18','2022-07-25 15:18:31',NULL,300,300);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
