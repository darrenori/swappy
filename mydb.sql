-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 17, 2021 at 01:30 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

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
-- Table structure for table `all_products`
--

CREATE TABLE `all_products` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_name` varchar(45) DEFAULT NULL,
  `product_pirce` varchar(45) DEFAULT NULL,
  `product_about` varchar(45) DEFAULT NULL,
  `product_picone` varchar(45) DEFAULT NULL,
  `product_pictwo` varchar(45) DEFAULT NULL,
  `product_picthree` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_type` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

CREATE TABLE `employee_attendance` (
  `attendance_id` int(11) NOT NULL,
  `working_id` int(11) NOT NULL,
  `attendance_date` varchar(45) NOT NULL,
  `attendance_in_time` varchar(45) NOT NULL,
  `attendance_out_time` varchar(45) NOT NULL,
  `attendance_absent_reason` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(45) DEFAULT NULL,
  `place_status` varchar(45) DEFAULT NULL,
  `place_limit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(100) NOT NULL,
  `store_pricepoint` varchar(1) NOT NULL,
  `store_about` varchar(1024) NOT NULL,
  `store_picone` varchar(100) DEFAULT NULL,
  `store_pictwo` varchar(100) DEFAULT NULL,
  `store_picethree` varchar(100) DEFAULT NULL,
  `store_address` varchar(45) DEFAULT NULL,
  `store_number` varchar(45) DEFAULT NULL,
  `store_url` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_category`
--

CREATE TABLE `store_category` (
  `storecat_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `total_people_in_lab`
--

CREATE TABLE `total_people_in_lab` (
  `total_id` int(11) NOT NULL,
  `total_maximum` int(11) NOT NULL,
  `total_current` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(60) NOT NULL,
  `user_password` varchar(60) NOT NULL,
  `user_fname` varchar(60) NOT NULL,
  `user_lname` varchar(60) NOT NULL,
  `username_email` varchar(200) NOT NULL,
  `user_number` varchar(45) NOT NULL,
  `date_of_signup` varchar(45) NOT NULL,
  `user_security_primaryschool` varchar(45) NOT NULL,
  `user_security_favoritefood` varchar(45) NOT NULL,
  `user_secret` varchar(255) NOT NULL,
  `user_card_type` varchar(45) DEFAULT NULL,
  `user_card_number` varchar(16) DEFAULT NULL,
  `user_card_expiry` varchar(45) DEFAULT NULL,
  `user_card_code` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_fname`, `user_lname`, `username_email`, `user_number`, `date_of_signup`, `user_security_primaryschool`, `user_security_favoritefood`, `user_secret`, `user_card_type`, `user_card_number`, `user_card_expiry`, `user_card_code`) VALUES
(13, 'darrennorii', '$2y$10$d58v5cXjdTSZL1GlRaUDOeS2e17YugEnF.T8NZh2ivrFaKh/6WF8e', 'darrennorii', 'darrennorii', 'darrennorii@gmail.com', 'iamafunnydawg', 'iamafunnydawg', 'iamafunnydawg', 'iamafunnydawg', 'J2Z3IHOGYBQPFFYF', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_booking`
--

CREATE TABLE `user_booking` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `booking_start` varchar(45) DEFAULT NULL,
  `booking_end` varchar(45) DEFAULT NULL,
  `booking_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_past_purchases`
--

CREATE TABLE `user_past_purchases` (
  `purchase_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `purchase_time` varchar(45) NOT NULL,
  `purchase_quantity` varchar(45) NOT NULL,
  `purchase_cost` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `working_employees`
--

CREATE TABLE `working_employees` (
  `working_id` int(11) NOT NULL,
  `working_fname` varchar(45) NOT NULL,
  `working_lname` varchar(45) NOT NULL,
  `working_number` varchar(45) DEFAULT NULL,
  `working_address` varchar(45) DEFAULT NULL,
  `working_role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_products`
--
ALTER TABLE `all_products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `store_id_product` (`store_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `working_id_idx` (`working_id`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`),
  ADD UNIQUE KEY `store_id_UNIQUE` (`store_id`),
  ADD UNIQUE KEY `store_name_UNIQUE` (`store_name`);

--
-- Indexes for table `store_category`
--
ALTER TABLE `store_category`
  ADD PRIMARY KEY (`storecat_id`),
  ADD KEY `cat_id_idx` (`cat_id`),
  ADD KEY `store_id_idx` (`store_id`);

--
-- Indexes for table `total_people_in_lab`
--
ALTER TABLE `total_people_in_lab`
  ADD PRIMARY KEY (`total_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD UNIQUE KEY `user_username_UNIQUE` (`user_username`);

--
-- Indexes for table `user_booking`
--
ALTER TABLE `user_booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id_idx` (`user_id`),
  ADD KEY `place_id_idx` (`place_id`);

--
-- Indexes for table `user_past_purchases`
--
ALTER TABLE `user_past_purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `user_id_idx` (`user_id`),
  ADD KEY `store_id_idx` (`store_id`),
  ADD KEY `product_id_idx` (`product_id`);

--
-- Indexes for table `working_employees`
--
ALTER TABLE `working_employees`
  ADD PRIMARY KEY (`working_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `all_products`
--
ALTER TABLE `all_products`
  ADD CONSTRAINT `store_id_product` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  ADD CONSTRAINT `working_id_attendance` FOREIGN KEY (`working_id`) REFERENCES `working_employees` (`working_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `store_category`
--
ALTER TABLE `store_category`
  ADD CONSTRAINT `cat_id_storecat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `store_id_storecat` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_booking`
--
ALTER TABLE `user_booking`
  ADD CONSTRAINT `place_id_booking` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_booking` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_past_purchases`
--
ALTER TABLE `user_past_purchases`
  ADD CONSTRAINT `product_id_purchase` FOREIGN KEY (`product_id`) REFERENCES `all_products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `store_id_purchase` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_purchase` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
