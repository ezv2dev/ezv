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

/*Table structure for table `collaborator` */

DROP TABLE IF EXISTS `collaborator`;

CREATE TABLE `collaborator` (
  `id_collab` int(10) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) DEFAULT NULL,
  `description` text,
  `id_location` int(10) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` int(10) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `views` bigint(20) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) NOT NULL,
  PRIMARY KEY (`id_collab`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

/*Data for the table `collaborator` */

insert  into `collaborator`(`id_collab`,`uid`,`description`,`id_location`,`address`,`latitude`,`longitude`,`phone`,`email`,`price`,`discount`,`image`,`status`,`views`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`) values 
(1,'1','Lorem ipsum dolor sit amet consectetur adipisicing elit. Est alias rerum nisi eaque dignissimos molestias corporis sapiente at accusantium et aliquam excepturi suscipit tempore laborum inventore saepe deserunt ullam, consectetur eius, totam quia ad doloremque consequatur molestiae? Ab impedit saepe pariatur qui, recusandae in explicabo dolore cupiditate maxime sed exercitationem?\r\n',1,'Tukad Pancoran',-8.6478175,115.1385192,'0812313214123123123','gedeanggakp@gmail.com',800000,30,'1653040737_ian-dooley-d1UPkiFd04A-unsplash.webp',1,0,'2022-05-11 08:17:48','2022-05-21 01:58:58',NULL,30,30),
(2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 14:55:00','2022-07-12 14:55:00',NULL,1,0),
(3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 14:57:02','2022-07-12 14:57:02',NULL,278,278),
(4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 14:59:45','2022-07-12 14:59:45',NULL,279,279),
(5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 15:00:26','2022-07-12 15:00:26',NULL,280,280),
(6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 15:00:50','2022-07-12 15:00:50',NULL,281,281),
(7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 15:02:59','2022-07-12 15:02:59',NULL,282,282),
(8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 15:03:32','2022-07-12 15:03:32',NULL,283,283),
(9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 15:04:46','2022-07-12 15:04:46',NULL,284,284),
(10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 15:07:09','2022-07-12 15:07:09',NULL,285,285),
(11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 15:07:46','2022-07-12 15:07:46',NULL,286,286),
(12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 15:08:46','2022-07-12 15:08:46',NULL,287,287),
(13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 15:09:39','2022-07-12 15:09:39',NULL,288,288),
(14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 15:12:46','2022-07-12 15:12:46',NULL,289,289),
(15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-07-12 15:20:19','2022-07-12 15:20:19',NULL,290,290),
(16,'7792744912',NULL,1,NULL,NULL,NULL,NULL,'okeyan@yan.com',NULL,NULL,NULL,2,0,'2022-07-12 15:42:38','2022-07-12 15:43:51',NULL,292,292),
(17,'3924460475',NULL,NULL,NULL,NULL,NULL,NULL,'sat@exe.com',NULL,NULL,NULL,0,0,'2022-07-12 15:50:38','2022-07-12 15:50:38',NULL,293,293),
(18,'2693533006',NULL,NULL,NULL,NULL,NULL,NULL,'hahaa@ex.co',NULL,NULL,NULL,0,0,'2022-07-12 15:52:21','2022-07-12 15:52:21',NULL,294,294),
(19,'6670174484',NULL,NULL,NULL,NULL,NULL,NULL,'burung@s.com',NULL,NULL,NULL,0,0,'2022-07-12 15:53:44','2022-07-12 15:53:44',NULL,295,295),
(20,'162306719',NULL,NULL,NULL,NULL,NULL,NULL,'arah@ex.com',NULL,NULL,NULL,0,0,'2022-07-12 15:57:04','2022-07-12 15:57:04',NULL,296,296),
(21,'7191458025',NULL,NULL,NULL,NULL,NULL,NULL,'yangenyol@haha.com',NULL,NULL,NULL,0,0,'2022-07-12 16:12:08','2022-07-12 16:12:08',NULL,297,297),
(22,'155487086',NULL,NULL,NULL,NULL,NULL,NULL,'collaborator@example.com',NULL,NULL,NULL,0,0,'2022-07-12 16:41:34','2022-07-12 16:41:34',NULL,298,298),
(23,'4838109089','Okee',1,NULL,NULL,NULL,NULL,'yanbotel@example.com',NULL,NULL,NULL,0,0,'2022-07-13 15:04:04','2022-07-13 15:23:11',NULL,299,299);

/*Table structure for table `collaborator_availability` */

DROP TABLE IF EXISTS `collaborator_availability`;

CREATE TABLE `collaborator_availability` (
  `id_collab_availability` int(11) NOT NULL AUTO_INCREMENT,
  `id_collab` int(10) unsigned NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `text` varchar(50) NOT NULL DEFAULT 'Not Available',
  `color` varchar(20) NOT NULL DEFAULT '#EB5353',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id_collab_availability`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `collaborator_availability` */

insert  into `collaborator_availability`(`id_collab_availability`,`id_collab`,`start`,`end`,`text`,`color`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,1,'2022-07-08','2022-07-10','Not Available','#EB5353','2022-07-09 01:03:18','2022-07-09 01:03:22',1,1);

/*Table structure for table `collaborator_category` */

DROP TABLE IF EXISTS `collaborator_category`;

CREATE TABLE `collaborator_category` (
  `id_collab_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `order` int(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_collab_category`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `collaborator_category` */

insert  into `collaborator_category`(`id_collab_category`,`name`,`order`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,'Videographer',1,'2022-05-11 16:23:15','2022-05-11 16:23:18',1,1),
(2,'Photographer',2,'2022-05-11 16:24:35','2022-05-11 16:24:36',1,1),
(3,'Model',3,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(4,'Food Influencer',4,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(5,'Travel Influencer',5,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(6,'Drone Pilot',6,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(7,'Editor',7,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(8,'CopyWriter',8,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(9,'Water',9,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(10,'Presenter',10,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(11,'Property Influencer',11,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(12,'Hotel Influencer',12,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(13,'Activity Influencer',13,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(14,'Tik Tok Creator',14,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(15,'General Influencer',15,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(16,'Public Figure',16,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(17,'Family Influencer',17,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(18,'Fitness Infuencer',18,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1),
(19,'Outdoor Influencer',19,'2022-05-11 16:24:35','2022-05-11 16:24:35',1,1);

/*Table structure for table `collaborator_filter` */

DROP TABLE IF EXISTS `collaborator_filter`;

CREATE TABLE `collaborator_filter` (
  `id_collab_filter` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `order` int(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_collab_filter`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `collaborator_filter` */

insert  into `collaborator_filter`(`id_collab_filter`,`icon`,`name`,`order`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,'om','Price',1,'2022-07-08 22:37:17','2022-07-08 22:37:19',1,1),
(2,'person-dress','Age',2,'2022-07-08 22:37:17','2022-07-08 22:37:17',1,1),
(3,'om','Man',3,'2022-07-08 22:37:17','2022-07-08 22:37:17',1,1),
(4,'person-dress','Women',4,'2022-07-08 22:37:17','2022-07-08 22:37:17',1,1),
(5,'om','Social Media Followers',5,'2022-07-08 22:37:17','2022-07-08 22:37:17',1,1),
(6,'person-dress','Barter',6,'2022-07-08 22:37:17','2022-07-08 22:37:17',1,1);

/*Table structure for table `collaborator_has_category` */

DROP TABLE IF EXISTS `collaborator_has_category`;

CREATE TABLE `collaborator_has_category` (
  `id_collab` int(11) DEFAULT NULL,
  `id_collab_category` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `collaborator_has_category` */

insert  into `collaborator_has_category`(`id_collab`,`id_collab_category`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(2,1,'2022-05-12 02:36:54','2022-05-12 02:36:54',1,1),
(1,1,'2022-05-12 02:53:40','2022-05-12 02:53:40',1,1),
(1,2,'2022-05-12 02:53:40','2022-05-12 02:53:40',1,1),
(23,1,'2022-07-14 11:33:14','2022-07-14 11:33:14',299,299),
(23,2,'2022-07-14 11:33:14','2022-07-14 11:33:14',299,299),
(23,4,'2022-07-14 11:33:14','2022-07-14 11:33:14',299,299);

/*Table structure for table `collaborator_has_filter` */

DROP TABLE IF EXISTS `collaborator_has_filter`;

CREATE TABLE `collaborator_has_filter` (
  `id_collab` int(11) DEFAULT NULL,
  `id_collab_filter` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `collaborator_has_filter` */

insert  into `collaborator_has_filter`(`id_collab`,`id_collab_filter`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,1,'2022-07-09 00:04:59','2022-07-09 00:05:00',1,1);

/*Table structure for table `collaborator_language` */

DROP TABLE IF EXISTS `collaborator_language`;

CREATE TABLE `collaborator_language` (
  `id_collab` int(11) DEFAULT NULL,
  `id_language` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `collaborator_language` */

insert  into `collaborator_language`(`id_collab`,`id_language`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,1,NULL,NULL,30,30),
(1,2,NULL,NULL,30,30),
(23,1,NULL,NULL,299,299),
(23,2,NULL,NULL,299,299),
(23,3,NULL,NULL,299,299);

/*Table structure for table `collaborator_photo` */

DROP TABLE IF EXISTS `collaborator_photo`;

CREATE TABLE `collaborator_photo` (
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `id_collab` int(11) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id_photo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `collaborator_photo` */

insert  into `collaborator_photo`(`id_photo`,`name`,`id_collab`,`order`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,'1.jpg',1,1,'2022-05-12 17:40:49','2022-05-12 17:40:53',30,30),
(2,'2.jpg',1,2,'2022-05-12 17:41:07','2022-05-12 17:41:08',30,30),
(3,'3.jpg',1,3,'2022-05-12 17:41:22','2022-05-12 17:41:24',30,30);

/*Table structure for table `collaborator_save` */

DROP TABLE IF EXISTS `collaborator_save`;

CREATE TABLE `collaborator_save` (
  `id_collaboratorsave` int(11) NOT NULL AUTO_INCREMENT,
  `id_collab` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id_collaboratorsave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `collaborator_save` */

/*Table structure for table `collaborator_social_media` */

DROP TABLE IF EXISTS `collaborator_social_media`;

CREATE TABLE `collaborator_social_media` (
  `id_collab_social` int(11) NOT NULL AUTO_INCREMENT,
  `id_collab` int(11) DEFAULT NULL,
  `instagram_link` varchar(200) DEFAULT NULL,
  `instagram_follower` bigint(20) DEFAULT NULL,
  `facebook_link` varchar(200) DEFAULT NULL,
  `facebook_follower` bigint(20) DEFAULT NULL,
  `twitter_link` varchar(200) DEFAULT NULL,
  `twitter_follower` bigint(20) DEFAULT NULL,
  `tiktok_link` varchar(200) DEFAULT NULL,
  `tiktok_follower` bigint(20) DEFAULT NULL,
  `follower_amount` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_collab_social`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `collaborator_social_media` */

insert  into `collaborator_social_media`(`id_collab_social`,`id_collab`,`instagram_link`,`instagram_follower`,`facebook_link`,`facebook_follower`,`twitter_link`,`twitter_follower`,`tiktok_link`,`tiktok_follower`,`follower_amount`,`updated_at`,`created_at`) values 
(6,23,'https://www.instagram.com/anggakusumap_/',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-07-14 10:39:40','2022-07-14 10:39:40');

/*Table structure for table `collaborator_story` */

DROP TABLE IF EXISTS `collaborator_story`;

CREATE TABLE `collaborator_story` (
  `id_story` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_collab` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id_story`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `collaborator_story` */

insert  into `collaborator_story`(`id_story`,`title`,`name`,`id_collab`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,'video1','vid.mp4',1,'2022-05-12 17:47:46','2022-05-12 17:47:50',30,30);

/*Table structure for table `collaborator_video` */

DROP TABLE IF EXISTS `collaborator_video`;

CREATE TABLE `collaborator_video` (
  `id_video` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `id_collab` int(11) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id_video`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `collaborator_video` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
