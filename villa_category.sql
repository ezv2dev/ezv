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

/*Table structure for table `villa_category` */

DROP TABLE IF EXISTS `villa_category`;

CREATE TABLE `villa_category` (
  `id_villa_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_villa_category`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `villa_category` */

insert  into `villa_category`(`id_villa_category`,`name`,`order`,`created_at`,`updated_at`) values 
(1,'Villa',1,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(2,'Luxe',2,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(5,'WOW',5,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(6,'Designer',6,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(7,'Amazing Views',7,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(8,'Apartments',8,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(9,'Bnb',9,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(10,'Boats',10,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(11,'Boutique Hotel',11,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(12,'Bungalow',12,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(13,'Cabins',13,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(14,'Campervan/Caravan',14,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(15,'Camping',15,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(16,'Castle',16,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(17,'Central/City',17,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(18,'Chalet',18,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(19,'Chateau',19,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(20,'Container House',20,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(21,'Cottage',21,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(22,'Countryside',22,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(23,'Domes',23,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(24,'Estate',24,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(25,'Farmhouse',25,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(26,'Glamping',26,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(27,'Guest House',27,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(28,'Homestays',28,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(29,'Hostels',29,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(30,'House',30,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(31,'Houseboat',31,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(32,'Local Styles',32,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(33,'Lodge',33,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(34,'Loft',34,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(35,'Mansion',35,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(36,'Motel',36,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(37,'Penthouse',37,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(38,'RV',38,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(39,'Skiing',39,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(40,'Studio',40,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(41,'Super Yacht',41,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(42,'Tiny Homes',42,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(43,'Town House',43,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(44,'Treehouse',44,'2022-06-29 18:19:05','2022-06-29 18:19:05'),
(45,'Tropical',45,'2022-06-29 18:19:05','2022-06-29 18:19:05');

/*Table structure for table `villa_has_category` */

DROP TABLE IF EXISTS `villa_has_category`;

CREATE TABLE `villa_has_category` (
  `id_villa` int(11) DEFAULT NULL,
  `id_villa_category` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  KEY `id_villa` (`id_villa`),
  KEY `id_villa_category` (`id_villa_category`),
  CONSTRAINT `villa_has_category_ibfk_1` FOREIGN KEY (`id_villa`) REFERENCES `villa` (`id_villa`),
  CONSTRAINT `villa_has_category_ibfk_2` FOREIGN KEY (`id_villa_category`) REFERENCES `villa_category` (`id_villa_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `villa_has_category` */

insert  into `villa_has_category`(`id_villa`,`id_villa_category`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(14,1,'2022-07-11 12:01:36','2022-07-11 12:01:36',1,1),
(14,2,'2022-07-11 12:01:36','2022-07-11 12:01:36',1,1),
(14,5,'2022-07-11 12:01:36','2022-07-11 12:01:36',1,1),
(14,7,'2022-07-11 12:01:36','2022-07-11 12:01:36',1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
