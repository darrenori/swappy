-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 12, 2021 at 05:27 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_typevariants`
--

CREATE TABLE `cart_typevariants` (
  `cart_typevariants_id` int(11) NOT NULL,
  `cart_typevariants_type` varchar(45) DEFAULT NULL,
  `cart_typevariants_variant` varchar(45) DEFAULT NULL,
  `cart_additionalcosts` varchar(45) DEFAULT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart_typevariants`
--

INSERT INTO `cart_typevariants` (`cart_typevariants_id`, `cart_typevariants_type`, `cart_typevariants_variant`, `cart_additionalcosts`, `cart_id`) VALUES
(4, 'Length', '100m', '20', 45762466),
(5, 'Additional_Server_Rack', 'Yes', '1242.99', 70851778),
(8, 'Size', 'Small', '0', 93914864),
(9, 'Color', 'Black', '0', 93914864),
(10, 'Size', 'Large', '50', 99561954);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_typevariants`
--
ALTER TABLE `cart_typevariants`
  ADD PRIMARY KEY (`cart_typevariants_id`),
  ADD KEY `cart_typevariants_card_id_idx` (`cart_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_typevariants`
--
ALTER TABLE `cart_typevariants`
  MODIFY `cart_typevariants_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_typevariants`
--
ALTER TABLE `cart_typevariants`
  ADD CONSTRAINT `cart_typevariants_card_id` FOREIGN KEY (`cart_id`) REFERENCES `user_cart` (`cart_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
