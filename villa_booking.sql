-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2022 at 09:46 AM
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
-- Table structure for table `villa_booking`
--

CREATE TABLE `villa_booking` (
  `id_booking` bigint(20) NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `id_payment` bigint(20) DEFAULT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `id_villa` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `infant` int(11) DEFAULT NULL,
  `pet` int(11) DEFAULT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `id_extra` int(11) DEFAULT NULL,
  `number_extra` int(11) DEFAULT NULL,
  `type_extra` int(11) DEFAULT NULL,
  `price_extra` int(11) DEFAULT NULL,
  `villa_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `service_price` int(11) NOT NULL,
  `cleaning_fee_price` int(11) DEFAULT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `total_all_price` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `villa_booking`
--
ALTER TABLE `villa_booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_payment` (`id_payment`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `villa_booking`
--
ALTER TABLE `villa_booking`
  MODIFY `id_booking` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `villa_booking`
--
ALTER TABLE `villa_booking`
  ADD CONSTRAINT `villa_booking_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
