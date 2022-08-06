/*
SQLyog Professional v13.1.1 (64 bit)
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

/*Table structure for table `restaurant_has_subcategory` */

DROP TABLE IF EXISTS `restaurant_has_subcategory`;

CREATE TABLE `restaurant_has_subcategory` (
  `id_restaurant` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_photo` int(11) DEFAULT NULL,
  `id_subcategory` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `restaurant_has_subcategory` */

insert  into `restaurant_has_subcategory`(`id_restaurant`,`id_menu`,`id_photo`,`id_subcategory`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(76,446,NULL,11,'2022-08-06 11:31:04','2022-08-06 11:31:04',1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
