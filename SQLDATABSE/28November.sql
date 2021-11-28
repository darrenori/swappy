-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 28, 2021 at 12:56 PM
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
(53, 'Additional_Server_Rack', 'yes', '1020.43', 90418243),
(54, 'Size', 'small', '0', 90418243),
(55, 'Additional_Server_Rack', 'yes', '1020.43', 58103419),
(56, 'Size', 'small', '0', 58103419),
(57, 'Additional_Server_Rack', 'yes', '1020.43', 62148203),
(58, 'Size', 'small', '0', 62148203),
(59, 'Size', 'small', '0', 11311331),
(60, 'Color', 'red', '1.2', 73029438),
(61, 'Size', 'Small', '0', 73029438),
(62, 'Color', 'blue', '0', 41657335),
(63, 'Size', 'Large', '2.1', 41657335);

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
-- Table structure for table `employees_task`
--

CREATE TABLE `employees_task` (
  `task_id` int(11) NOT NULL,
  `working_id` int(11) NOT NULL,
  `task_name` text NOT NULL,
  `task_progress` varchar(9) NOT NULL,
  `task_employees_taskcol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

CREATE TABLE `employee_attendance` (
  `attendance_id` int(11) NOT NULL,
  `working_id` int(11) NOT NULL,
  `attendance_date` varchar(45) NOT NULL,
  `attendance_in_time` varchar(4) NOT NULL,
  `attendance_out_time` varchar(4) NOT NULL,
  `attendance_valid_absence` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(45) NOT NULL,
  `place_status` varchar(45) NOT NULL,
  `place_limit` int(11) NOT NULL,
  `time_start` varchar(4) NOT NULL,
  `time_end` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` text DEFAULT NULL,
  `product_price` float DEFAULT NULL,
  `product_about` text DEFAULT NULL,
  `product_picone` varchar(200) DEFAULT NULL,
  `product_pictwo` varchar(200) DEFAULT NULL,
  `product_picthree` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_about`, `product_picone`, `product_pictwo`, `product_picthree`) VALUES
(1, 'Torchlight', 5.99, 'Simply press the+ or- dimmer switch to adjust the brightness of this portable work light for the desired brightness', NULL, NULL, NULL),
(2, 'Unmanaged switch', 210.21, 'SWITCH PORTS: 16 -Port 10/100/1000', NULL, NULL, NULL),
(3, 'Cisco Catalyst 9200L-24P-4X 24-Port Gigabit PoE+ Compliant Managed Switch', 1921.94, 'Enjoy reliability, speed, and flexibility as you expand your business\\\'s network capacity to support powered devices such as IP security cameras, wireless access points, VoIP phones, and more with the Catalyst 9200L-24P-4X 24-Port Gigabit PoE+ Compliant Managed Switch from Cisco. This managed switch offers high versatility with Field-Replaceable Units (FRU), which allow you to quickly install a redundant power supply to fit your needs. It features 24 PoE+ compliant Gigabit Ethernet ports with a 370W budget to operate compatible devices alongside four 10GbE SFP ports high-speed fiber uplink connections to compatible devices', NULL, NULL, NULL),
(4, 'Comprehensive 25\\\' (7.6m) Cat 6 550 MHz Snagless Patch Cable (Black)', 12.48, 'The 25\\\' (7.6m) Cat 6 550 MHz Snagless Patch Cable (Black) from Comprehensive is an Ethernet patch cable, suitable for use in professional network installations. It features a male-to-male design, using standard gold-plated RJ45 connectors on each end. The cable\\\'s 550 MHz greatly reduces loss when compared to standard 1000 MHz cable. It is suitable for use in Gigabit Ethernet networks.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `product_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`product_id`, `type_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(2, 6),
(2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `store_name` text NOT NULL,
  `store_pricepoint` int(1) NOT NULL,
  `store_about` text NOT NULL,
  `store_picone` varchar(200) DEFAULT NULL,
  `store_pictwo` varchar(200) DEFAULT NULL,
  `store_picethree` varchar(200) DEFAULT NULL,
  `store_address` varchar(100) DEFAULT NULL,
  `store_number` varchar(45) DEFAULT NULL,
  `store_url` varchar(150) DEFAULT NULL,
  `store_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `store_pricepoint`, `store_about`, `store_picone`, `store_pictwo`, `store_picethree`, `store_address`, `store_number`, `store_url`, `store_status`) VALUES
(1, 'TPAMC', 1, 'Developed by Temasek Polytechnic, TPAMC offers a range of products that are engineered on-site. It is a multi-million dollar facility with a range of components such as the Nerve Centre.', NULL, NULL, NULL, '21 Tampines Ave 1, Singapore 529757', '6788 2000', 'https://www.tp.edu.sg/research-and-industry/centres-of-excellence/centres-under-school-of-engineering/advanced-manufacturing-centre.html', NULL),
(2, 'SC360', 1, 'As a nationwide provider of converged datacom and telecom network infrastructure solutions, our expertise covers the full spectrum of services.', NULL, NULL, NULL, '2425 Boulevard Pitfield', '514 735 8557', 'https://sc360.com/', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `storecat`
--

CREATE TABLE `storecat` (
  `cat_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `storeprod`
--

CREATE TABLE `storeprod` (
  `store_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `storeprod`
--

INSERT INTO `storeprod` (`store_id`, `product_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4);

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
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `type_choice` varchar(45) NOT NULL,
  `additional_costs` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type`, `type_choice`, `additional_costs`) VALUES
(1, 'Color', 'red', 1.2),
(2, 'Color', 'blue', NULL),
(3, 'Size', 'Large', 2.1),
(4, 'Size', 'Small', NULL),
(5, 'Additional Server Rack', 'yes', 1020.43),
(6, 'Size', 'large', NULL),
(7, 'Size', 'small', NULL);

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
  `user_role` int(11) NOT NULL,
  `username_email` varchar(200) NOT NULL,
  `user_number` varchar(45) NOT NULL,
  `date_of_signup` varchar(45) NOT NULL,
  `user_security_primaryschool` varchar(45) NOT NULL,
  `user_security_favoritefood` varchar(45) NOT NULL,
  `user_secret` varchar(255) NOT NULL,
  `user_card_type` varchar(45) DEFAULT NULL,
  `user_card_number` varchar(16) DEFAULT NULL,
  `user_card_expiry` varchar(45) DEFAULT NULL,
  `user_card_code` varchar(3) DEFAULT NULL,
  `userscol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_fname`, `user_lname`, `user_role`, `username_email`, `user_number`, `date_of_signup`, `user_security_primaryschool`, `user_security_favoritefood`, `user_secret`, `user_card_type`, `user_card_number`, `user_card_expiry`, `user_card_code`, `userscol`) VALUES
(1, 'darrennorii', '$2y$10$UcqCdokFcpOqpGyVNrX0wOlI7KTznaXwuddD/DHR3hq3FZdJVGaQa', 'darrennorii', 'darrennorii', 0, 'darrennorii@gmail.com', 'iamafunnydawg', 'iamafunnydawg', 'iamafunnydawg', 'iamafunnydawg', 'IL7OTDZ3QXGZXX75', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_booking`
--

CREATE TABLE `user_booking` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `booking_start` varchar(4) DEFAULT NULL,
  `booking_end` varchar(4) DEFAULT NULL,
  `booking_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `price`) VALUES
(11311331, 1, 2, 300, 63063),
(41657335, 1, 1, 2, 16.18),
(58103419, 1, 2, 300, 369192),
(62148203, 1, 2, 300, 369192),
(73029438, 1, 1, 3, 21.57),
(90418243, 1, 2, 300, 369192);

-- --------------------------------------------------------

--
-- Table structure for table `user_past_purchases`
--

CREATE TABLE `user_past_purchases` (
  `purchase_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `purchase_time` varchar(45) NOT NULL,
  `purchase_quantity` varchar(45) NOT NULL,
  `purchase_cost` float NOT NULL,
  `purchase_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `working_employees`
--

CREATE TABLE `working_employees` (
  `working_id` int(11) NOT NULL,
  `working_fname` varchar(45) NOT NULL,
  `working_lname` varchar(45) NOT NULL,
  `working_role` varchar(45) NOT NULL,
  `working_number` varchar(45) DEFAULT NULL,
  `working_address` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `employees_task`
--
ALTER TABLE `employees_task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `task_working_id_idx` (`working_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_id`,`type_id`),
  ADD KEY `prodtype_product_id_idx` (`product_id`),
  ADD KEY `prodtype_type_id_idx` (`type_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`),
  ADD UNIQUE KEY `store_id_UNIQUE` (`store_id`),
  ADD UNIQUE KEY `store_name_UNIQUE` (`store_name`) USING HASH;

--
-- Indexes for table `storecat`
--
ALTER TABLE `storecat`
  ADD KEY `cat_id_idx` (`cat_id`),
  ADD KEY `store_id_idx` (`store_id`);

--
-- Indexes for table `storeprod`
--
ALTER TABLE `storeprod`
  ADD PRIMARY KEY (`store_id`,`product_id`),
  ADD KEY `storeprod_product_id_idx` (`product_id`);

--
-- Indexes for table `total_people_in_lab`
--
ALTER TABLE `total_people_in_lab`
  ADD PRIMARY KEY (`total_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

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
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id_cart_idx` (`product_id`),
  ADD KEY `user_id_cart_idx` (`user_id`);

--
-- Indexes for table `user_past_purchases`
--
ALTER TABLE `user_past_purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `user_id_idx` (`user_id`),
  ADD KEY `store_id_idx` (`store_id`),
  ADD KEY `product_id_idx` (`product_id`),
  ADD KEY `type_id_purchase_idx` (`type_id`);

--
-- Indexes for table `working_employees`
--
ALTER TABLE `working_employees`
  ADD PRIMARY KEY (`working_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_typevariants`
--
ALTER TABLE `cart_typevariants`
  MODIFY `cart_typevariants_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees_task`
--
ALTER TABLE `employees_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `total_people_in_lab`
--
ALTER TABLE `total_people_in_lab`
  MODIFY `total_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_booking`
--
ALTER TABLE `user_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_past_purchases`
--
ALTER TABLE `user_past_purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `working_employees`
--
ALTER TABLE `working_employees`
  MODIFY `working_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_typevariants`
--
ALTER TABLE `cart_typevariants`
  ADD CONSTRAINT `cart_typevariants_card_id` FOREIGN KEY (`cart_id`) REFERENCES `user_cart` (`cart_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `employees_task`
--
ALTER TABLE `employees_task`
  ADD CONSTRAINT `task_working_id` FOREIGN KEY (`working_id`) REFERENCES `working_employees` (`working_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  ADD CONSTRAINT `working_id_attendance` FOREIGN KEY (`working_id`) REFERENCES `working_employees` (`working_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_type`
--
ALTER TABLE `product_type`
  ADD CONSTRAINT `prodtype_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `prodtype_type_id` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `storecat`
--
ALTER TABLE `storecat`
  ADD CONSTRAINT `cat_id_storecat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `store_id_storecat` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `storeprod`
--
ALTER TABLE `storeprod`
  ADD CONSTRAINT `storeprod_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `storeprod_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_booking`
--
ALTER TABLE `user_booking`
  ADD CONSTRAINT `place_id_booking` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_booking` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `product_id_cart` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_cart` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user_past_purchases`
--
ALTER TABLE `user_past_purchases`
  ADD CONSTRAINT `product_id_purchase` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `store_id_purchase` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `type_id_purchase` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_purchase` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
