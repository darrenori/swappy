-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 26, 2021 at 05:14 AM
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
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mydb`;

-- --------------------------------------------------------

--
-- Table structure for table `cart_typevariants`
--

DROP TABLE IF EXISTS `cart_typevariants`;
CREATE TABLE IF NOT EXISTS `cart_typevariants` (
  `cart_typevariants_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_typevariants_type` varchar(45) DEFAULT NULL,
  `cart_typevariants_variant` varchar(45) DEFAULT NULL,
  `cart_additionalcosts` varchar(45) DEFAULT NULL,
  `cart_id` int(11) NOT NULL,
  PRIMARY KEY (`cart_typevariants_id`),
  KEY `cart_typevariants_card_id_idx` (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart_typevariants`
--

INSERT INTO `cart_typevariants` (`cart_typevariants_id`, `cart_typevariants_type`, `cart_typevariants_variant`, `cart_additionalcosts`, `cart_id`) VALUES
(160, 'Additional_Server_Rack', 'Yes', '1242.99', 52346371);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_type` varchar(65) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employees_task`
--

DROP TABLE IF EXISTS `employees_task`;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees_task`
--

INSERT INTO `employees_task` (`task_id`, `working_id`, `task_name`, `task_details`, `task_progress`, `task_assignedby`, `task_dateassigned`, `task_datetofinish`, `task_dateedited`) VALUES
(2, 2, 'bring', 'hotpot', '1', 'root', '2021-12-11 23:52:30', '2021-12-25 23:52:00', '2021-12-11 23:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

DROP TABLE IF EXISTS `employee_attendance`;
CREATE TABLE IF NOT EXISTS `employee_attendance` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `working_id` int(11) NOT NULL,
  `attendance_date` varchar(45) NOT NULL,
  `attendance_in_time` varchar(4) NOT NULL,
  `attendance_out_time` varchar(4) NOT NULL,
  `attendance_valid_absence` int(1) DEFAULT NULL,
  PRIMARY KEY (`attendance_id`),
  KEY `working_id_idx` (`working_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
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

DROP TABLE IF EXISTS `likedby`;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likedby`
--

INSERT INTO `likedby` (`likedby_id`, `review_id`, `user_id`, `product_id`, `liked`) VALUES
(7, 4, 2, 1, 1),
(8, 14, 2, 1, 0),
(9, 13, 2, 1, 0),
(10, 6, 2, 1, 1),
(11, 16, 2, 1, 1),
(12, 18, 2, 1, 1),
(13, 8, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
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

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `idnotification` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notification` varchar(200) DEFAULT NULL,
  `header` varchar(65) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idnotification`),
  KEY `user_noti_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
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
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
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

DROP TABLE IF EXISTS `product_type`;
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

DROP TABLE IF EXISTS `reviews`;
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `review_product_id`, `review_user_id`, `review_comment`, `review_rating`, `review_pic`, `review_total_likes`, `review_total_dislikes`, `review_date`, `childof_id`, `edited`) VALUES
(3, 1, 2, 'Good', 3, 'uploads/IMG-61c20de67b4624.73151653.png', 0, 0, '2021-12-22 01:24:54', NULL, NULL),
(4, 1, 2, 'my', 3, 'uploads/IMG-61c211abd00168.44052608.png', 1, 0, '2021-12-22 01:40:59', 3, NULL),
(6, 1, 2, 'is', 3, 'uploads/IMG-61c211b721ac55.19516752.png', 1, 0, '2021-12-22 01:41:11', NULL, NULL),
(8, 1, 2, 'ong', 3, 'uploads/IMG-61c211c01930d0.39734886.png', 1, 0, '2021-12-22 01:41:20', NULL, NULL),
(13, 1, 2, 'hmm', 1, 'uploads/IMG-61c2f49ed95d26.40608661.png', 0, 1, '2021-12-22 17:49:18', NULL, NULL),
(14, 1, 2, 'super idl', 1, 'uploads/IMG-61c348d7c06c29.03415812.png', 0, 1, '2021-12-22 23:48:39', NULL, NULL),
(16, 1, 3, 'test a', 0, 'uploads/IMG-61c3528d1be1d4.62885062.jpg', 1, 0, '2021-12-23 00:18:45', NULL, 1),
(18, 1, 2, 'ads', 0, '', 1, 0, '2021-12-24 00:19:39', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review_parent_child`
--

DROP TABLE IF EXISTS `review_parent_child`;
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

DROP TABLE IF EXISTS `store`;
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
-- Table structure for table `storecat`
--

DROP TABLE IF EXISTS `storecat`;
CREATE TABLE IF NOT EXISTS `storecat` (
  `cat_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  KEY `cat_id_idx` (`cat_id`),
  KEY `store_id_idx` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `storeprod`
--

DROP TABLE IF EXISTS `storeprod`;
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

DROP TABLE IF EXISTS `total_people_in_lab`;
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

DROP TABLE IF EXISTS `type`;
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

DROP TABLE IF EXISTS `users`;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_fname`, `user_lname`, `user_role`, `username_email`, `user_number`, `date_of_signup`, `user_security_primaryschool`, `user_security_favoritefood`, `user_secret`, `user_profilepicture`) VALUES
(2, 'root', '$2y$10$v8EVclcnMvtkqracc5zIV.gg47gMKsM78KDBTLH1GH6v9Wyhjm4tW', 'root', 'root', 6, 'root@gmail.com', '1', '12/19/2021 07:53:08 pm', 'root', '123', 'NR32XESQHYRR7ERX', ''),
(3, 'darrenori', '$2y$10$Mkw79cj2EmqaNhW/nQDN6OHu6QyZjKJ4mIcvxNNtw4f34NgiJwtHe', 'darren', 'darren', 0, 'darrenoria@gmail.com', '123', '2021-12-23 00:13:09', '1', '1', 'UXT2MBWYUAJTTM2D', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_booking`
--

DROP TABLE IF EXISTS `user_booking`;
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

DROP TABLE IF EXISTS `user_cart`;
CREATE TABLE IF NOT EXISTS `user_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `productcode` varchar(45) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `product_id_cart_idx` (`product_id`),
  KEY `user_id_cart_idx` (`user_id`),
  KEY `product_code_cart_idx` (`productcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`cart_id`, `user_id`, `product_id`, `productcode`, `quantity`, `price`) VALUES
(52346371, 2, 2, '3c771bf8d75fb729a61fd38cdf7e08c2', 1, 1433.2);

-- --------------------------------------------------------

--
-- Table structure for table `user_creditcardinfo`
--

DROP TABLE IF EXISTS `user_creditcardinfo`;
CREATE TABLE IF NOT EXISTS `user_creditcardinfo` (
  `user_creditcardinfo_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_creditcardinfo_userid` int(11) NOT NULL,
  `user_creditcardinfo_nameoncard` varchar(45) DEFAULT NULL,
  `user_creditcardinfo_cardnumber` varchar(45) DEFAULT NULL,
  `user_creditcardinfo_expiry` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_creditcardinfo_id`),
  KEY `user_creditcardinfo_id_idx` (`user_creditcardinfo_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_favoritedproducts`
--

DROP TABLE IF EXISTS `user_favoritedproducts`;
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

DROP TABLE IF EXISTS `user_past_purchases`;
CREATE TABLE IF NOT EXISTS `user_past_purchases` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `user_shipping` int(11) NOT NULL,
  `user_creditcards` int(11) NOT NULL,
  `purchase_time` varchar(45) NOT NULL,
  `purchase_quantity` varchar(45) NOT NULL,
  `purchase_cost` float NOT NULL,
  `purchase_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `user_id_idx` (`user_id`),
  KEY `cart_id_purchases_idx` (`cart_id`),
  KEY `user_creditcards_idx` (`user_creditcards`),
  KEY `user_shipping_idx` (`user_shipping`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_shippinginformation`
--

DROP TABLE IF EXISTS `user_shippinginformation`;
CREATE TABLE IF NOT EXISTS `user_shippinginformation` (
  `user_shipping_id` int(11) NOT NULL,
  `user_shipping_firstname` varchar(45) DEFAULT NULL,
  `user_shipping_lastname` varchar(45) DEFAULT NULL,
  `user_shipping_number` varchar(45) DEFAULT NULL,
  `user_shipping_email` varchar(45) DEFAULT NULL,
  `user_shipping_address` varchar(45) DEFAULT NULL,
  `user_shipping_postalcode` varchar(45) DEFAULT NULL,
  `user_shipping_unitnumber` varchar(45) DEFAULT NULL,
  `purchase_id` int(11) NOT NULL,
  PRIMARY KEY (`user_shipping_id`),
  KEY `user_shipping_purchase_id_idx` (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `working_booking`
--

DROP TABLE IF EXISTS `working_booking`;
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

DROP TABLE IF EXISTS `working_employees`;
CREATE TABLE IF NOT EXISTS `working_employees` (
  `working_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `working_role` varchar(45) NOT NULL,
  `working_number` varchar(45) DEFAULT NULL,
  `working_department` text NOT NULL,
  `working_perhourpay` int(11) NOT NULL,
  PRIMARY KEY (`working_id`),
  KEY `user_id_working_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `working_employees`
--

INSERT INTO `working_employees` (`working_id`, `user_id`, `working_role`, `working_number`, `working_department`, `working_perhourpay`) VALUES
(2, 2, 'Engineer', '1232', 'tech', 123);

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
  ADD CONSTRAINT `working_id_attendance` FOREIGN KEY (`working_id`) REFERENCES `working_employees` (`working_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `user_noti` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Constraints for table `storecat`
--
ALTER TABLE `storecat`
  ADD CONSTRAINT `cat_id_storecat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `store_id_storecat` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `storeprod`
--
ALTER TABLE `storeprod`
  ADD CONSTRAINT `storeprod_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `storeprod_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `cart_id_purchases` FOREIGN KEY (`cart_id`) REFERENCES `user_cart` (`cart_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_creditcards` FOREIGN KEY (`user_creditcards`) REFERENCES `user_creditcardinfo` (`user_creditcardinfo_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_purchase` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_shipping` FOREIGN KEY (`user_shipping`) REFERENCES `user_shippinginformation` (`user_shipping_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user_shippinginformation`
--
ALTER TABLE `user_shippinginformation`
  ADD CONSTRAINT `user_shipping_purchase_id` FOREIGN KEY (`purchase_id`) REFERENCES `user_past_purchases` (`purchase_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `working_employees`
--
ALTER TABLE `working_employees`
  ADD CONSTRAINT `user_id_working` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
