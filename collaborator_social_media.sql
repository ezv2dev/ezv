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

/*Table structure for table `collaborator_social_media` */

DROP TABLE IF EXISTS `collaborator_social_media`;

CREATE TABLE `collaborator_social_media` (
  `id_collab_social` int(11) NOT NULL AUTO_INCREMENT,
  `id_collab` int(11) DEFAULT NULL,
  `instagram_name` varchar(200) DEFAULT NULL,
  `instagram_follower` bigint(20) DEFAULT NULL,
  `facebook_name` varchar(200) DEFAULT NULL,
  `facebook_follower` bigint(20) DEFAULT NULL,
  `twitter_name` varchar(200) DEFAULT NULL,
  `twitter_follower` bigint(20) DEFAULT NULL,
  `tiktok_name` varchar(200) DEFAULT NULL,
  `tiktok_follower` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_collab_social`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `collaborator_social_media` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
