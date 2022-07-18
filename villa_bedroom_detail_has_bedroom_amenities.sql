-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 09:07 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ezv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `villa_bedroom_detail_has_bedroom_amenities`
--

CREATE TABLE `villa_bedroom_detail_has_bedroom_amenities` (
  `id_villa_bedroom_detail` int(11) NOT NULL,
  `id_bedroom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `villa_bedroom_detail_has_bedroom_amenities`
--
ALTER TABLE `villa_bedroom_detail_has_bedroom_amenities`
  ADD KEY `id_bedroom` (`id_bedroom`),
  ADD KEY `id_villa_bedroom_detail` (`id_villa_bedroom_detail`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `villa_bedroom_detail_has_bedroom_amenities`
--
ALTER TABLE `villa_bedroom_detail_has_bedroom_amenities`
  ADD CONSTRAINT `villa_bedroom_detail_has_bedroom_amenities_ibfk_1` FOREIGN KEY (`id_bedroom`) REFERENCES `bedroom` (`id_bed`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `villa_bedroom_detail_has_bedroom_amenities_ibfk_2` FOREIGN KEY (`id_villa_bedroom_detail`) REFERENCES `villa_bedroom_detail` (`id_villa_bedroom_detail`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
