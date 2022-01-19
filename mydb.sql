-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 19, 2022 at 03:51 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

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

CREATE TABLE IF NOT EXISTS `cart_typevariants` (
  `cart_typevariants_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_typevariants_type` varchar(45) DEFAULT NULL,
  `cart_typevariants_variant` varchar(45) DEFAULT NULL,
  `cart_additionalcosts` varchar(45) DEFAULT NULL,
  `cart_id` int(11) NOT NULL,
  PRIMARY KEY (`cart_typevariants_id`),
  KEY `cart_typevariants_card_id_idx` (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart_typevariants`
--

INSERT INTO `cart_typevariants` (`cart_typevariants_id`, `cart_typevariants_type`, `cart_typevariants_variant`, `cart_additionalcosts`, `cart_id`) VALUES
(204, 'Size', 'Large', '2.3', 71776166),
(205, 'Color', 'White', '3.1', 71776166),
(206, 'Size', 'Large', '2.3', 37323656),
(207, 'Color', 'Black', '0', 37323656),
(208, 'Additional_Server_Rack', 'Yes', '1242.99', 21520909),
(209, 'Length', '100m', '20', 45864688),
(210, 'Length', '100m', '20', 42682064),
(211, 'Size', 'Large', '2.3', 86324416),
(212, 'Color', 'White', '3.1', 86324416),
(213, 'Length', '100m', '20', 67869677),
(214, 'Size', 'Large', '50', 36916921),
(215, 'Additional_Server_Rack', 'Yes', '1242.99', 34781975),
(216, 'Size', 'Large', '2.3', 88901636),
(217, 'Color', 'White', '3.1', 88901636),
(218, 'Additional_Server_Rack', 'Yes', '1242.99', 34313007),
(219, 'Size', 'Large', '50', 52484361),
(220, 'Additional_Server_Rack', 'Yes', '1242.99', 20540189);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_type` varchar(65) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employees_task`
--

CREATE TABLE IF NOT EXISTS `employees_task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `working_id` int(11) NOT NULL,
  `task_name` text NOT NULL,
  `task_details` varchar(45) NOT NULL,
  `task_progress` varchar(9) NOT NULL,
  `task_assignedby` varchar(45) NOT NULL,
  `task_dateassigned` varchar(45) NOT NULL,
  `task_datetofinish` varchar(45) NOT NULL,
  `task_dateedited` varchar(45) NOT NULL,
  PRIMARY KEY (`task_id`),
  KEY `task_working_id_idx` (`working_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees_task`
--

INSERT INTO `employees_task` (`task_id`, `working_id`, `task_name`, `task_details`, `task_progress`, `task_assignedby`, `task_dateassigned`, `task_datetofinish`, `task_dateedited`) VALUES
(4, 3, 'buy v', 'dasani', '2', 'root', '2021-12-30 21:15:11', '2022-01-01 21:15:00', '2021-12-30 23:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

CREATE TABLE IF NOT EXISTS `employee_attendance` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `attendance_date` varchar(45) NOT NULL,
  `attendance_in_time` varchar(45) NOT NULL,
  `attendance_out_time` varchar(45) NOT NULL,
  `attendance_status` varchar(45) NOT NULL,
  `attendance_userid` int(11) NOT NULL,
  `attendance_break` varchar(45) NOT NULL,
  `attendance_current_month` varchar(45) NOT NULL,
  `attendance_current_year` varchar(45) NOT NULL,
  `attendance_workingid` int(11) DEFAULT NULL,
  PRIMARY KEY (`attendance_id`),
  KEY `working_id_idx_idx` (`attendance_workingid`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_attendance`
--

INSERT INTO `employee_attendance` (`attendance_id`, `attendance_date`, `attendance_in_time`, `attendance_out_time`, `attendance_status`, `attendance_userid`, `attendance_break`, `attendance_current_month`, `attendance_current_year`, `attendance_workingid`) VALUES
(19, '14/01/2022', '01:04:22 am', '10:05:02 pm', 'Valid', 2, '60', '01', '2022', 3),
(40, '15/01/2022', '02:07:45 pm', '05:07:47 pm', 'Valid', 2, '60', '01', '2022', 3),
(41, '15/01/2022', '09:10:10 pm', '11:10:10 pm', 'Valid', 2, '60', '01', '2022', 3),
(43, '16/01/2022', '10:00:55 pm', '10:04:23 pm', 'Valid', 2, '60', '01', '2022', 3),
(45, '17/01/2022', '01:55:12 pm', '01:55:13 pm', 'Valid', 2, '60', '01', '2022', 3),
(47, '18/01/2022', '04:05:04 pm', '04:05:08 pm', 'Valid', 2, '60', '01', '2022', 3),
(48, '19/01/2022', '11:23:39 am', '11:42:47 am', 'To be Reviewed', 2, '60', '01', '2022', 3);

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave`
--

CREATE TABLE IF NOT EXISTS `employee_leave` (
  `leave_id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_date` varchar(45) NOT NULL,
  `leave_status` varchar(45) NOT NULL,
  `leave_userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`leave_id`),
  KEY `leave_userid_useridx_idx` (`leave_userid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_leave`
--

INSERT INTO `employee_leave` (`leave_id`, `leave_date`, `leave_status`, `leave_userid`) VALUES
(1, '11/01/2022', 'Approved', 2),
(22, '20/01/2022', 'Approved', 2),
(23, '19/01/2022', 'Approved', 2),
(24, '27/01/2022', 'Approved', 2),
(25, '31/01/2022', 'Invalid', 2),
(26, '25/02/2022', 'Invalid', 2),
(27, '25/01/2022', 'Approved', 2);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `product_id` int(11) NOT NULL,
  `productcode` varchar(45) NOT NULL,
  `quantityleft` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productcode`),
  KEY `inventory_product_id_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`product_id`, `productcode`, `quantityleft`) VALUES
(1, '05bbf12433b036df8b503f774db14486', '42'),
(1, '0d783821eeb637b7b245f0c5b53bb191', '21'),
(1, '2b22d78d21ff5850b75ed3d38c0111fb', '35'),
(5, '38fc554ba26a85cc454f3a4b8ec7b301', '15'),
(2, '3c771bf8d75fb729a61fd38cdf7e08c2', '12'),
(5, '63fbb9b1eb1701eb3ab328f218ba65df', '10'),
(1, '7588ffe7c10af6736e7f1095d6433ea1', '12'),
(2, '7a661e7347e9d0a868cc9cdf91f634ce', '41'),
(4, 'bd8dd1cda82f264d6a392e161e290dfa', '21'),
(3, 'c9ca592076cfdc0f97ea3132e770c1f6', '12'),
(3, 'f40d7fba5e93532f0c84a3a874b47889', '42');

-- --------------------------------------------------------

--
-- Table structure for table `likedby`
--

CREATE TABLE IF NOT EXISTS `likedby` (
  `likedby_id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `liked` int(1) NOT NULL,
  PRIMARY KEY (`likedby_id`),
  KEY `liked_user_id_idx` (`user_id`),
  KEY `liked_product_id_idx` (`product_id`),
  KEY `liked_review_id` (`review_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likedby`
--

INSERT INTO `likedby` (`likedby_id`, `review_id`, `user_id`, `product_id`, `liked`) VALUES
(20, 47, 2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `review_id` int(11) NOT NULL,
  `likenumber` int(11) DEFAULT NULL,
  `dislikenumber` int(11) DEFAULT NULL,
  KEY `likes_review_id` (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `idnotification` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notification` varchar(200) NOT NULL,
  `header` varchar(65) NOT NULL,
  `level` int(1) NOT NULL,
  `type` int(1) NOT NULL,
  PRIMARY KEY (`idnotification`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`idnotification`, `user_id`, `notification`, `header`, `level`, `type`) VALUES
(1, 0, 'uwu', 'HARLO NOTI', 0, 0),
(2, 2, 'um root i am testing groot', 'ee', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE IF NOT EXISTS `place` (
  `place_id` int(11) NOT NULL AUTO_INCREMENT,
  `place_name` varchar(45) NOT NULL,
  `place_status` varchar(45) NOT NULL,
  `place_limit` int(11) NOT NULL,
  `time_start` varchar(4) NOT NULL,
  `time_end` varchar(4) NOT NULL,
  PRIMARY KEY (`place_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prodcat`
--

CREATE TABLE IF NOT EXISTS `prodcat` (
  `cat_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  KEY `cat_id_idx` (`cat_id`),
  KEY `store_id_storecat_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` text DEFAULT NULL,
  `product_price` float DEFAULT NULL,
  `product_about` text DEFAULT NULL,
  `product_picone` varchar(200) DEFAULT NULL,
  `product_pictwo` varchar(200) DEFAULT NULL,
  `product_picthree` varchar(200) DEFAULT NULL,
  `total_quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_about`, `product_picone`, `product_pictwo`, `product_picthree`, `total_quantity`) VALUES
(1, 'Torchlight', 7.99, 'A portable light source that comes in varying sizes. These are made to-order and warranties will be included', NULL, NULL, NULL, 110),
(2, 'Cisco SG250-08 8 Port Gigabit Smart Switch SG250', 190.21, 'The Cisco 250 Series is the next generation of affordable smart switches that combine powerful network performance and reliability with a complete suite of the network features you need for a solid business network. These powerful Fast Ethernet or Gigabit Ethernet switches, with Gigabit or 10 Gigabit Ethernet uplinks, provide multiple management options, sophisticated security capabilities, fine-tuned Quality-of-Service (QoS) and Layer 3 static routing features far beyond those of an unmanaged or consumer-grade switch, at a lower cost than for fully managed switches. And with an easy-to-use web user interface, Smart Network Application, and Power over Ethernet Plus (PoE+) capability, you can deploy and configure a complete business network in minutes.', NULL, NULL, NULL, 53),
(3, 'LAN CABLE CAT 6 UTP', 10.9, 'Cat 6, is a standardized twisted pair cable for Ethernet and other network physical layers that is backward compatible with the Category 5/5e and Category 3 cable standards. Compared with Cat 5 and Cat 5e, Cat 6 features more stringent specifications for crosstalk and system noise. The cable standard specifies performance of up to 250 MHz.', NULL, NULL, NULL, 53),
(4, 'Robotic Arm', 412.42, 'Reduces the front-end investment of your automation projects and gives you a quick ROI. Collaborative robot with 5kg payload, 700mm reach, free software, open-source platform. Simplify Complex Tasks. Schedule A Demo. Boost Productivity', NULL, NULL, NULL, 21),
(5, 'Router', 600.21, 'A router is a networking device that forwards data packets between computer networks. Routers perform the traffic directing functions on the Internet.', NULL, NULL, NULL, 25);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE IF NOT EXISTS `product_type` (
  `product_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`type_id`),
  KEY `prodtype_product_id_idx` (`product_id`),
  KEY `prodtype_type_id_idx` (`type_id`)
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
(3, 7),
(3, 8),
(5, 11),
(5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `review_product_id` int(11) NOT NULL,
  `review_user_id` int(11) NOT NULL,
  `review_comment` varchar(45) DEFAULT NULL,
  `review_rating` int(11) DEFAULT NULL,
  `review_pic` varchar(45) DEFAULT NULL,
  `review_total_likes` int(11) DEFAULT NULL,
  `review_total_dislikes` int(11) DEFAULT NULL,
  `review_date` varchar(45) DEFAULT NULL,
  `childof_id` int(11) DEFAULT NULL,
  `edited` int(11) DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `review_user_id_idx` (`review_user_id`),
  KEY `review_product_id_idx` (`review_product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `review_product_id`, `review_user_id`, `review_comment`, `review_rating`, `review_pic`, `review_total_likes`, `review_total_dislikes`, `review_date`, `childof_id`, `edited`) VALUES
(42, 1, 2, 'ead', 2, 'uploads/IMG-61cea8bab469c9.94053952.jpg', 0, 0, '2021-12-31 14:52:42', NULL, NULL),
(43, 1, 2, 'uwu', 0, '', 0, 0, '2021-12-31 14:54:36', 42, NULL),
(44, 1, 2, 'huh', 0, '', 0, 0, '2021-12-31 14:54:48', 42, NULL),
(45, 3, 2, 'a', 2, 'uploads/IMG-61d092a3024967.81706745.jpg', 0, 0, '2022-01-02 01:42:59', NULL, NULL),
(46, 4, 2, 'dar', 2, 'uploads/IMG-61d27bbf4c5e92.66886824.png', 0, 0, '2022-01-03 12:29:51', NULL, NULL),
(47, 4, 2, 'sucks', 0, '', 1, 0, '2022-01-03 12:29:58', 46, NULL),
(48, 2, 2, 'katamine', 2, 'uploads/IMG-61d400cc221287.01194408.jpg', 0, 0, '2022-01-04 16:09:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review_parent_child`
--

CREATE TABLE IF NOT EXISTS `review_parent_child` (
  `review_id_parent` int(11) NOT NULL,
  `review_id_child` int(11) NOT NULL,
  KEY `review_id_parent_idx` (`review_id_parent`),
  KEY `review_id_parent_idx1` (`review_id_child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_name` text NOT NULL,
  `store_pricepoint` int(1) NOT NULL,
  `store_about` text NOT NULL,
  `store_picone` varchar(200) DEFAULT NULL,
  `store_pictwo` varchar(200) DEFAULT NULL,
  `store_picethree` varchar(200) DEFAULT NULL,
  `store_address` varchar(100) DEFAULT NULL,
  `store_number` varchar(45) DEFAULT NULL,
  `store_url` varchar(150) DEFAULT NULL,
  `store_status` int(1) DEFAULT NULL,
  `store_rating` int(1) DEFAULT NULL,
  PRIMARY KEY (`store_id`),
  UNIQUE KEY `store_id_UNIQUE` (`store_id`),
  UNIQUE KEY `store_name_UNIQUE` (`store_name`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `store_pricepoint`, `store_about`, `store_picone`, `store_pictwo`, `store_picethree`, `store_address`, `store_number`, `store_url`, `store_status`, `store_rating`) VALUES
(1, 'TPAMC', 1, 'Industry 4.0 is set to transform Singapore’s manufacturing sector, as more companies embrace advanced manufacturing technologies to increase their productivity and efficiency.', NULL, NULL, NULL, '21 Tampines Ave 1, Singapore 529757', '6788 2000', 'https://www.tp.edu.sg/research-and-industry/centres-of-excellence/centres-under-school-of-engineering/advanced-manufacturing-centre.html', 1, NULL),
(2, 'Cisco', 1, 'Cisco Systems, Inc. is an American multinational technology conglomerate corporation headquartered in San Jose, California. Integral to the growth of Silicon Valley, Cisco develops, manufactures and sells networking hardware, software, telecommunications equipment and other high-technology services and products', NULL, NULL, NULL, '80 Pasir Panjang Rd, Building 80, Lvl 25 Mapletree Biz City, Singapore 117372', '6721 2111', 'https://www.cisco.com/c/en_sg/index.html', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `storeprod`
--

CREATE TABLE IF NOT EXISTS `storeprod` (
  `store_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`store_id`,`product_id`),
  KEY `storeprod_product_id_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `storeprod`
--

INSERT INTO `storeprod` (`store_id`, `product_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(1, 5),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `total_people_in_lab`
--

CREATE TABLE IF NOT EXISTS `total_people_in_lab` (
  `total_id` int(11) NOT NULL AUTO_INCREMENT,
  `total_maximum` int(11) NOT NULL,
  `total_current` int(11) NOT NULL,
  PRIMARY KEY (`total_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `type_choice` varchar(45) NOT NULL,
  `additional_costs` float DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type`, `type_choice`, `additional_costs`) VALUES
(1, 'Size', 'Small', 0),
(2, 'Size', 'Large', 2.3),
(3, 'Color', 'Black', 0),
(4, 'Color', 'White', 3.1),
(5, 'Additional Server Rack', 'No', 0),
(6, 'Additional Server Rack', 'Yes', 1242.99),
(7, 'Length', '10m', 0),
(8, 'Length', '100m', 20),
(11, 'Size', 'Small', 0),
(12, 'Size', 'Large', 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `user_profilepicture` text NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `user_username_UNIQUE` (`user_username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_fname`, `user_lname`, `user_role`, `username_email`, `user_number`, `date_of_signup`, `user_security_primaryschool`, `user_security_favoritefood`, `user_secret`, `user_profilepicture`) VALUES
(2, 'root', '$2y$10$de65hhknQkDw6C.ai9CssuFm.ibPILhoD9E3Pm9zsuA8/wDZWAoKe', 'root', 'root', 6, 'root@gmail.com', '1', '12/19/2021 07:53:08 pm', 'root', '123', 'NR32XESQHYRR7ERX', ''),
(4, 'tester', '$2y$10$1miKrdsJ6O7MIYXWaBfF7uuzFDa1VqJGJtGRXCU.mvwKqpirdj636', 'tester', 'tester', 6, 'tester@gmail.com', '213aa', '2022-01-04 16:56:49', 'tester', 'tester', 'VSOARC5JUW5O5UM7', 'uploads/IMG-61d41294d13813.99076896.png'),
(5, 'darrenori', '$2y$10$X5SzfUxvo7BH5yFWfVE9YOZMl0mii4AZxLMv5E.E53LrweUNsMxqG', 'darren', 'ong', 6, 'darrennorii@gmail.com', '12311232', '2022-01-07 00:27:30', 'ed', 'as', '5W5JRR2HCZHG2HSF', 'uploads/IMG-DEFAULTPROFILE.jpg'),
(6, 'uwu', '$2y$10$5CtQeNMv8ZjRTFhyJT8SIOfOsEXl.HgHZWz0SQXOQH2dOo1DJIY/i', 'uwu', 'uwu', 0, 'uwu@gmail.com', '91922121', '2022-01-07 14:38:14', '123', '123', 'G6ZZUTKR5S3UNV4Y', 'uploads/IMG-DEFAULTPROFILE.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `usersfavorite`
--

CREATE TABLE IF NOT EXISTS `usersfavorite` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `favorite_product_id_idx` (`product_id`),
  KEY `favorite_user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usersfavorite`
--

INSERT INTO `usersfavorite` (`product_id`, `user_id`) VALUES
(1, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_booking`
--

CREATE TABLE IF NOT EXISTS `user_booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `booking_start` varchar(4) DEFAULT NULL,
  `booking_end` varchar(4) DEFAULT NULL,
  `booking_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `user_id_idx` (`user_id`),
  KEY `place_id_idx` (`place_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE IF NOT EXISTS `user_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `productcode` varchar(45) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `bundled` int(11) DEFAULT NULL,
  `purchased` int(11) DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `product_id_cart_idx` (`product_id`),
  KEY `user_id_cart_idx` (`user_id`),
  KEY `product_code_cart_idx` (`productcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`cart_id`, `user_id`, `product_id`, `productcode`, `quantity`, `price`, `bundled`, `purchased`) VALUES
(20540189, 5, 2, '3c771bf8d75fb729a61fd38cdf7e08c2', 1, 1433.2, 44238904, 1),
(21520909, 2, 2, '3c771bf8d75fb729a61fd38cdf7e08c2', 2, 2866.4, 65038689, 1),
(34313007, 5, 2, '3c771bf8d75fb729a61fd38cdf7e08c2', 1, 1433.2, 96137789, 1),
(34781975, 2, 2, '3c771bf8d75fb729a61fd38cdf7e08c2', 2, 2866.4, 0, 0),
(36916921, 2, 5, '38fc554ba26a85cc454f3a4b8ec7b301', 1, 650.21, 41074234, 1),
(37323656, 2, 1, '0d783821eeb637b7b245f0c5b53bb191', 2, 20.58, 39102838, 1),
(42682064, 2, 3, 'c9ca592076cfdc0f97ea3132e770c1f6', 1, 30.9, 91226347, 1),
(45864688, 2, 3, 'c9ca592076cfdc0f97ea3132e770c1f6', 9, 278.1, 78749148, 1),
(52484361, 5, 5, '38fc554ba26a85cc454f3a4b8ec7b301', 1, 650.21, 13626326, 1),
(63250878, 5, 4, 'bd8dd1cda82f264d6a392e161e290dfa', 1, 412.42, 83719910, 1),
(67869677, 2, 3, 'c9ca592076cfdc0f97ea3132e770c1f6', 2, 61.8, 93906941, 1),
(71776166, 2, 1, '2b22d78d21ff5850b75ed3d38c0111fb', 13, 174.07, 10849871, 1),
(86324416, 2, 1, '2b22d78d21ff5850b75ed3d38c0111fb', 2, 26.78, 29692911, 1),
(88901636, 5, 1, '2b22d78d21ff5850b75ed3d38c0111fb', 1, 13.39, 90644407, 1),
(93551889, 5, 4, 'bd8dd1cda82f264d6a392e161e290dfa', 1, 412.42, 90644407, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_creditcardinfo`
--

CREATE TABLE IF NOT EXISTS `user_creditcardinfo` (
  `user_creditcardinfo_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_creditcardinfo_userid` int(11) NOT NULL,
  `user_creditcardinfo_nameoncard` varchar(45) NOT NULL,
  `user_creditcardinfo_expirymonth` varchar(45) NOT NULL,
  `user_creditcardinfo_expiryyear` varchar(45) NOT NULL,
  `user_creditcardinfo_cardtype` varchar(45) NOT NULL,
  `user_creditcardinfo_cardnumb` varchar(45) NOT NULL,
  PRIMARY KEY (`user_creditcardinfo_id`),
  KEY `user_creditcardinfo_id_idx` (`user_creditcardinfo_userid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_creditcardinfo`
--

INSERT INTO `user_creditcardinfo` (`user_creditcardinfo_id`, `user_creditcardinfo_userid`, `user_creditcardinfo_nameoncard`, `user_creditcardinfo_expirymonth`, `user_creditcardinfo_expiryyear`, `user_creditcardinfo_cardtype`, `user_creditcardinfo_cardnumb`) VALUES
(1, 2, 'Darren', '12', '2023', 'visa', ''),
(2, 2, 'darren', '12', '2023', 'visa', ''),
(3, 2, 'darren', '12', '2023', 'visa', ''),
(4, 2, 'darren', '12', '2023', 'visa', ''),
(5, 2, 'darren', '12', '2023', 'visa', ''),
(6, 2, 'darren', '12', '2023', 'visa', ''),
(7, 2, 'darren', '12', '2023', 'visa', ''),
(8, 2, 'darren', '12', '2023', 'visa', ''),
(9, 2, 'darren', '12', '2023', 'visa', ''),
(10, 2, 'danre', '12', '2023', 'visa', ''),
(11, 2, 'darren', '12', '2023', 'visa', ''),
(12, 2, 'sean lim', '12', '2023', 'visa', ''),
(13, 2, 'darren', '12', '2023', 'visa', ''),
(14, 2, 'd', '12', '2023', 'visa', ''),
(15, 2, 'drn', '12', '2023', 'visa', ''),
(16, 2, 'darremmgp', '12', '2023', 'visa', '1111'),
(17, 2, 'darmrekm', '12', '2022', 'visa', '1111'),
(18, 5, 'darren', '12', '2023', 'visa', '1111'),
(19, 5, 'uwu', '12', '2023', 'visa', '1111'),
(20, 5, 'jasnjdnadsjn', '12', '2023', 'visa', '1111'),
(21, 5, 'aksmdamsmd', '12', '2024', 'visa', '1111'),
(22, 5, 'asdkmaskmd', '12', '2024', 'visa', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `user_favoritedproducts`
--

CREATE TABLE IF NOT EXISTS `user_favoritedproducts` (
  `favorited_userid` int(11) NOT NULL,
  `favoried_productid` int(11) NOT NULL,
  KEY `favorited_userid_idx` (`favorited_userid`),
  KEY `favoried_productid_idx` (`favoried_productid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_past_purchases`
--

CREATE TABLE IF NOT EXISTS `user_past_purchases` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_shipping` int(11) NOT NULL,
  `user_creditcards` int(11) NOT NULL,
  `purchase_time` varchar(45) NOT NULL,
  `purchase_cost` float NOT NULL,
  `purchase_status` int(1) DEFAULT NULL,
  `cart_bundled` int(11) DEFAULT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `user_id_idx` (`user_id`),
  KEY `user_creditcards_idx` (`user_creditcards`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_past_purchases`
--

INSERT INTO `user_past_purchases` (`purchase_id`, `user_id`, `user_shipping`, `user_creditcards`, `purchase_time`, `purchase_cost`, `purchase_status`, `cart_bundled`) VALUES
(13, 5, 4, 21, '2022-01-06 18:25:49', 441.289, 1, 83719910),
(14, 5, 6, 22, '2022-01-06 18:28:48', 1533.52, 1, 44238904);

-- --------------------------------------------------------

--
-- Table structure for table `user_shippinginformation`
--

CREATE TABLE IF NOT EXISTS `user_shippinginformation` (
  `user_shipping_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_shipping_number` varchar(45) DEFAULT NULL,
  `user_shipping_email` varchar(45) DEFAULT NULL,
  `user_shipping_address` varchar(45) DEFAULT NULL,
  `user_shipping_postalcode` varchar(45) DEFAULT NULL,
  `user_shipping_unitnumber` varchar(45) DEFAULT NULL,
  `user_shipping_userid` int(11) NOT NULL,
  `user_shipping_default` int(11) NOT NULL,
  `user_shipping_name` varchar(45) NOT NULL,
  `deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`user_shipping_id`),
  KEY `shipping_userid_idx` (`user_shipping_userid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_shippinginformation`
--

INSERT INTO `user_shippinginformation` (`user_shipping_id`, `user_shipping_number`, `user_shipping_email`, `user_shipping_address`, `user_shipping_postalcode`, `user_shipping_unitnumber`, `user_shipping_userid`, `user_shipping_default`, `user_shipping_name`, `deleted`) VALUES
(4, '12313212', 'kmasdm@gmail.com', 'sad', '123123', '1231', 5, 0, 'darrem', '1'),
(5, '12312222', 'dskmd@gmail.com', 'qwe', '123112', '1231', 5, 0, 'amsda', '1'),
(6, '12311231', 'new@gmail.com', 'kmasdkm', '123123', '12312', 5, 1, 'new', ''),
(7, '12312312', 'root@gmail.com', '123', '123123', '123', 2, 0, 'root', '');

-- --------------------------------------------------------

--
-- Table structure for table `working_booking`
--

CREATE TABLE IF NOT EXISTS `working_booking` (
  `idworking_booking` int(11) NOT NULL AUTO_INCREMENT,
  `working_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `booking_start` varchar(4) DEFAULT NULL,
  `booking_end` varchar(4) DEFAULT NULL,
  `booking_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`idworking_booking`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `working_employees`
--

CREATE TABLE IF NOT EXISTS `working_employees` (
  `working_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `working_role` varchar(45) NOT NULL,
  `working_number` varchar(45) DEFAULT NULL,
  `working_department` text NOT NULL,
  `working_perhourpay` int(11) NOT NULL,
  PRIMARY KEY (`working_id`),
  KEY `user_id_working_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `working_employees`
--

INSERT INTO `working_employees` (`working_id`, `user_id`, `working_role`, `working_number`, `working_department`, `working_perhourpay`) VALUES
(3, 2, 'Engineers', '123', 'sd', 12);

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
  ADD CONSTRAINT `task_working_id` FOREIGN KEY (`working_id`) REFERENCES `working_employees` (`working_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  ADD CONSTRAINT `working_id_idx` FOREIGN KEY (`attendance_workingid`) REFERENCES `working_employees` (`working_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD CONSTRAINT `leave_userid_useridx` FOREIGN KEY (`leave_userid`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `likedby`
--
ALTER TABLE `likedby`
  ADD CONSTRAINT `liked_product_id1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `liked_review_id` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`review_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `liked_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_review_id` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`review_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prodcat`
--
ALTER TABLE `prodcat`
  ADD CONSTRAINT `cat_id_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cat_id_storecat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `product_type`
--
ALTER TABLE `product_type`
  ADD CONSTRAINT `prodtype_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `prodtype_type_id` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `review_product_id` FOREIGN KEY (`review_product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `review_user_id` FOREIGN KEY (`review_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `review_parent_child`
--
ALTER TABLE `review_parent_child`
  ADD CONSTRAINT `review_id_child` FOREIGN KEY (`review_id_child`) REFERENCES `reviews` (`review_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `review_id_parent` FOREIGN KEY (`review_id_parent`) REFERENCES `reviews` (`review_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `storeprod`
--
ALTER TABLE `storeprod`
  ADD CONSTRAINT `storeprod_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `storeprod_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `usersfavorite`
--
ALTER TABLE `usersfavorite`
  ADD CONSTRAINT `favorite_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `favorite_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user_booking`
--
ALTER TABLE `user_booking`
  ADD CONSTRAINT `place_id_booking` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_booking` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `product_code_carter` FOREIGN KEY (`productcode`) REFERENCES `inventory` (`productcode`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_id_cart` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_cart` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user_creditcardinfo`
--
ALTER TABLE `user_creditcardinfo`
  ADD CONSTRAINT `user_creditcardinfo_id` FOREIGN KEY (`user_creditcardinfo_userid`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_favoritedproducts`
--
ALTER TABLE `user_favoritedproducts`
  ADD CONSTRAINT `favoried_productid` FOREIGN KEY (`favoried_productid`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `favorited_userid` FOREIGN KEY (`favorited_userid`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_past_purchases`
--
ALTER TABLE `user_past_purchases`
  ADD CONSTRAINT `user_creditcards` FOREIGN KEY (`user_creditcards`) REFERENCES `user_creditcardinfo` (`user_creditcardinfo_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_purchase` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user_shippinginformation`
--
ALTER TABLE `user_shippinginformation`
  ADD CONSTRAINT `shipping_userid` FOREIGN KEY (`user_shipping_userid`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `working_employees`
--
ALTER TABLE `working_employees`
  ADD CONSTRAINT `user_id_working` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
