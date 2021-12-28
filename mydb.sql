-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2021 at 05:35 PM
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

DROP TABLE IF EXISTS `cart_typevariants`;
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
(10, 'Size', 'Large', '50', 99561954),
(11, 'Additional_Server_Rack', 'Yes', '1242.99', 97812793),
(15, 'Size', 'Large', '50', 38766058),
(16, 'Additional_Server_Rack', 'Yes', '1242.99', 86809160),
(17, 'Additional_Server_Rack', 'Yes', '1242.99', 84878307),
(18, 'Additional_Server_Rack', 'No', '0', 31166802),
(19, 'Size', 'Large', '2.3', 41805568),
(20, 'Size', 'Large', '2.3', 33879654),
(21, 'Color', 'White', '3.1', 33879654);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_type` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employees_task`
--

DROP TABLE IF EXISTS `employees_task`;
CREATE TABLE `employees_task` (
  `task_id` int(11) NOT NULL,
  `working_id` int(11) NOT NULL,
  `task_name` text NOT NULL,
  `task_details` varchar(45) NOT NULL,
  `task_progress` varchar(9) NOT NULL,
  `task_assignedby` varchar(45) NOT NULL,
  `task_dateassigned` varchar(45) NOT NULL,
  `task_datetofinish` varchar(45) NOT NULL,
  `task_dateedited` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `idquantityleft` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `productcode` varchar(45) DEFAULT NULL,
  `quantityleft` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`idquantityleft`, `product_id`, `productcode`, `quantityleft`) VALUES
(1, 1, '094f63cf0351c8502f7f0253310b58a0', '42'),
(2, 1, 'abb4663e2a141f8ff357a2e4901bb017', '12'),
(3, 1, '4e82d7fb552212d5316be1f1f6dfb68b', '35'),
(4, 1, '929d10466f192336d1eeb72084b21108', '21'),
(5, 2, '676d6a6f93db02e2596e49655b114bb0', '12'),
(6, 2, '5d80e53fa14aa2cfd991d29e87f0f7ba', '41'),
(7, 3, 'f40d7fba5e93532f0c84a3a874b47889', '42'),
(8, 3, 'c9ca592076cfdc0f97ea3132e770c1f6', '12'),
(9, 4, 'bd8dd1cda82f264d6a392e161e290dfa', '21'),
(10, 5, '63fbb9b1eb1701eb3ab328f218ba65df', '10'),
(11, 5, '38fc554ba26a85cc454f3a4b8ec7b301', '15');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `review_id` int(11) NOT NULL,
  `likenumber` int(11) DEFAULT NULL,
  `dislikenumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `idnotification` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification` varchar(200) DEFAULT NULL,
  `header` varchar(65) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
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

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` text DEFAULT NULL,
  `product_price` float DEFAULT NULL,
  `product_about` text DEFAULT NULL,
  `product_picone` varchar(200) DEFAULT NULL,
  `product_pictwo` varchar(200) DEFAULT NULL,
  `product_picthree` varchar(200) DEFAULT NULL,
  `total_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(3, 7),
(3, 8),
(5, 11),
(5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `review_store_id` int(11) NOT NULL,
  `review_user_id` int(11) NOT NULL,
  `review_comment` varchar(45) DEFAULT NULL,
  `review_rating` datetime DEFAULT NULL,
  `review_pic` varchar(45) DEFAULT NULL,
  `review_total_likes` int(11) DEFAULT NULL,
  `review_total_dislikes` int(11) DEFAULT NULL,
  `review_date` varchar(45) DEFAULT NULL,
  `childof_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `review_parent_child`
--

DROP TABLE IF EXISTS `review_parent_child`;
CREATE TABLE `review_parent_child` (
  `review_id_parent` int(11) NOT NULL,
  `review_id_child` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
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
  `store_status` int(1) DEFAULT NULL,
  `store_rating` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
CREATE TABLE `storecat` (
  `cat_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `storeprod`
--

DROP TABLE IF EXISTS `storeprod`;
CREATE TABLE `storeprod` (
  `store_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
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
CREATE TABLE `total_people_in_lab` (
  `total_id` int(11) NOT NULL,
  `total_maximum` int(11) NOT NULL,
  `total_current` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
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
  `user_profilepicture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_fname`, `user_lname`, `user_role`, `username_email`, `user_number`, `date_of_signup`, `user_security_primaryschool`, `user_security_favoritefood`, `user_secret`, `user_profilepicture`) VALUES
(1, 'root', '$2y$10$39nmLvIvzvH5MnCAAcAkouXzCUZAEDLbLZZog1hOPbLKUu6ycYuwG', 'root', 'root', 6, 'roto@gmail.com', '123', '12/11/2021 07:57:29 am', 'edgefield', 'hotpot', '64PJFAICL5GXPN4W', ''),
(2, 'a', '$2y$10$45ADAL2zM9axLZSOD9A8quGibUdq6PKUiQTF3MTuC3eVjUGKnd.M2', 'a', 'aa', 0, 'a@gmail.com', 'a', '12/15/2021 08:05:59 am', 'a', 'a', 'ILJNB4BGVRI3Z74Z', ''),
(3, 'aa', '$2y$10$5P4yyDkJE9UHp99j5ajTcuVWep030jTElqXokT8jOyR9kVMRBvAaS', 'a', 'a', 0, 'aa@gmial.com', '213', '12/15/2021 10:35:59 am', 'a', 'a', 'FCZ5BCX5LCV5DS2V', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_booking`
--

DROP TABLE IF EXISTS `user_booking`;
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

DROP TABLE IF EXISTS `user_cart`;
CREATE TABLE `user_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `purchased` int(11) DEFAULT NULL,
  `bundled` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `price`, `purchased`, `bundled`) VALUES
(31166802, 2, 2, 1, 190.21, 0, 0),
(33879654, 2, 1, 100, 1339, 0, 0),
(38766058, 3, 5, 1, 650.21, 0, 0),
(41805568, 2, 1, 1, 10.29, 0, 0),
(45762466, 1, 3, 5, 154.5, 0, 0),
(70851778, 1, 2, 1002, 1436070, 0, 0),
(73815958, 2, 2, 1, 190.21, 0, 0),
(84878307, 2, 2, 1, 1433.2, 0, 0),
(86809160, 2, 2, 1, 1433.2, 1, 25177142),
(89039723, 2, 4, 1, 412.42, 1, 25177142),
(93914864, 1, 1, 2, 15.98, 0, 0),
(97812793, 1, 2, 3, 4299.6, 0, 0),
(99561954, 1, 5, 2, 1300.42, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_creditcardinfo`
--

DROP TABLE IF EXISTS `user_creditcardinfo`;
CREATE TABLE `user_creditcardinfo` (
  `user_creditcardinfo_id` int(11) NOT NULL,
  `user_creditcardinfo_userid` int(11) NOT NULL,
  `user_creditcardinfo_nameoncard` varchar(45) DEFAULT NULL,
  `user_creditcardinfo_expirymonth` varchar(45) DEFAULT NULL,
  `user_creditcardinfo_expiryyear` varchar(45) DEFAULT NULL,
  `user_creditcardinfo_cardtype` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_creditcardinfo`
--

INSERT INTO `user_creditcardinfo` (`user_creditcardinfo_id`, `user_creditcardinfo_userid`, `user_creditcardinfo_nameoncard`, `user_creditcardinfo_expirymonth`, `user_creditcardinfo_expiryyear`, `user_creditcardinfo_cardtype`) VALUES
(7, 3, '123', '12', '2031', NULL),
(8, 2, '123', '12', '2030', NULL),
(9, 2, '123', '12', '2030', NULL),
(44, 2, 'aa', '12', '2023', NULL),
(45, 2, 'aa', '12', '2030', 'visa'),
(46, 2, 'aa', '10', '2025', 'visa'),
(47, 2, 'aa', '12', '2030', 'visa'),
(48, 2, 'aa', '12', '2030', 'visa'),
(49, 2, 'aa', '12', '2030', 'visa'),
(50, 2, 'aa', '12', '2030', 'visa'),
(51, 2, 'aa', '12', '2030', 'visa'),
(52, 2, 'aa', '12', '2030', NULL),
(53, 2, 'aa', '12', '2030', 'visa'),
(54, 2, 'aa', '12', '2030', 'visa'),
(55, 2, 'aa', '12', '2030', 'visa'),
(56, 2, 'aa', '12', '2030', 'visa'),
(57, 2, 'aa', '12', '2030', 'visa'),
(58, 2, 'aa', '12', '2030', 'visa'),
(59, 2, 'aa', '12', '2030', 'visa'),
(60, 2, 'aa', '12', '2030', 'visa'),
(61, 2, 'aa', '12', '2030', 'visa'),
(62, 2, 'aa', '12', '2030', 'visa'),
(63, 2, 'aa', '12', '2030', 'visa'),
(64, 2, 'aa', '12', '2030', 'visa'),
(65, 2, 'sean', '12', '2030', 'visa'),
(66, 2, 'aa', '12', '2030', 'visa'),
(67, 2, 'aa', '12', '2030', 'visa'),
(68, 2, 'a', '12', '2030', 'visa'),
(69, 2, 'aa', '12', '2030', 'visa'),
(70, 2, 'aa', '12', '2030', 'visa'),
(71, 2, 'aa', '12', '2030', 'visa'),
(72, 2, 'aa', '12', '2030', 'visa'),
(73, 2, 'aa', '12', '2025', 'visa'),
(74, 2, 'aa', '12', '2023', 'visa'),
(75, 2, 'aa', '12', '2030', 'visa'),
(76, 2, 'aa', '12', '2030', 'visa'),
(77, 2, 'aa', '12', '2030', 'visa'),
(78, 2, 'aa', '12', '2030', 'visa'),
(79, 2, 'aa', '12', '2030', 'visa'),
(80, 2, 'aa', '12', '2030', 'visa'),
(81, 2, 'aa', '12', '2030', 'visa'),
(82, 2, 'aa', '12', '2030', 'visa'),
(83, 2, 'a', '12', '2030', 'visa'),
(84, 2, 'aa', '12', '2030', 'visa'),
(85, 2, 'aa', '12', '2030', 'visa'),
(86, 2, 'aa', '12', '2030', 'visa'),
(87, 2, 'aa', '12', '2030', 'visa'),
(88, 2, 'aa', '12', '2030', 'visa'),
(89, 2, 'aa', '12', '2030', 'visa'),
(90, 2, 'aa', '12', '2030', 'visa'),
(91, 2, 'aa', '12', '2030', 'visa'),
(92, 2, 'aa', '12', '2030', 'visa'),
(93, 2, 'aa', '12', '2030', 'visa'),
(95, 2, 'aa', '12', '2030', 'visa'),
(96, 2, 'aa', '12', '2030', 'visa'),
(97, 2, 'a', '12', '2030', 'visa'),
(98, 2, 'aa', '12', '2030', 'visa'),
(99, 2, 'aa', '12', '2030', 'visa');

-- --------------------------------------------------------

--
-- Table structure for table `user_favoritedproducts`
--

DROP TABLE IF EXISTS `user_favoritedproducts`;
CREATE TABLE `user_favoritedproducts` (
  `favorited_userid` int(11) NOT NULL,
  `favoried_productid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_past_purchases`
--

DROP TABLE IF EXISTS `user_past_purchases`;
CREATE TABLE `user_past_purchases` (
  `purchase_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_shipping` int(11) NOT NULL,
  `user_creditcards` int(11) NOT NULL,
  `purchase_time` varchar(45) NOT NULL,
  `purchase_quantity` varchar(45) NOT NULL,
  `purchase_cost` float NOT NULL,
  `purchase_status` int(1) DEFAULT NULL,
  `cart_bundled` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_past_purchases`
--

INSERT INTO `user_past_purchases` (`purchase_id`, `user_id`, `user_shipping`, `user_creditcards`, `purchase_time`, `purchase_quantity`, `purchase_cost`, `purchase_status`, `cart_bundled`) VALUES
(36, 2, 44, 99, '2021-12-28 17:23:34', '2', 2772.2, 1, 25177142);

-- --------------------------------------------------------

--
-- Table structure for table `user_shippinginformation`
--

DROP TABLE IF EXISTS `user_shippinginformation`;
CREATE TABLE `user_shippinginformation` (
  `user_shipping_id` int(11) NOT NULL,
  `user_shipping_name` varchar(45) DEFAULT NULL,
  `user_shipping_number` varchar(45) DEFAULT NULL,
  `user_shipping_email` varchar(45) DEFAULT NULL,
  `user_shipping_address` varchar(45) DEFAULT NULL,
  `user_shipping_postalcode` varchar(45) DEFAULT NULL,
  `user_shipping_unitnumber` varchar(45) DEFAULT NULL,
  `user_shipping_userid` int(11) NOT NULL,
  `user_shipping_default` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_shippinginformation`
--

INSERT INTO `user_shippinginformation` (`user_shipping_id`, `user_shipping_name`, `user_shipping_number`, `user_shipping_email`, `user_shipping_address`, `user_shipping_postalcode`, `user_shipping_unitnumber`, `user_shipping_userid`, `user_shipping_default`) VALUES
(44, 'aa', '21321321', 'a@gmail.com', '213', '213213', '132', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `working_booking`
--

DROP TABLE IF EXISTS `working_booking`;
CREATE TABLE `working_booking` (
  `idworking_booking` int(11) NOT NULL,
  `working_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `booking_start` varchar(4) DEFAULT NULL,
  `booking_end` varchar(4) DEFAULT NULL,
  `booking_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `working_employees`
--

DROP TABLE IF EXISTS `working_employees`;
CREATE TABLE `working_employees` (
  `working_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `working_role` varchar(45) NOT NULL,
  `working_number` varchar(45) DEFAULT NULL,
  `working_department` text NOT NULL,
  `working_perhourpay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `working_employees`
--

INSERT INTO `working_employees` (`working_id`, `user_id`, `working_role`, `working_number`, `working_department`, `working_perhourpay`) VALUES
(2, 1, 'Engineer', '1232', 'tech', 123);

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
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`idquantityleft`),
  ADD KEY `inventory_productid_idx` (`product_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD KEY `likes_review_id` (`review_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`idnotification`),
  ADD KEY `user_noti_idx` (`user_id`);

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
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `review_store_id_idx` (`review_store_id`),
  ADD KEY `review_user_id_idx` (`review_user_id`);

--
-- Indexes for table `review_parent_child`
--
ALTER TABLE `review_parent_child`
  ADD KEY `review_id_parent_idx` (`review_id_parent`),
  ADD KEY `review_id_parent_idx1` (`review_id_child`);

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
-- Indexes for table `user_creditcardinfo`
--
ALTER TABLE `user_creditcardinfo`
  ADD PRIMARY KEY (`user_creditcardinfo_id`),
  ADD KEY `user_creditcardinfo_id_idx` (`user_creditcardinfo_userid`);

--
-- Indexes for table `user_favoritedproducts`
--
ALTER TABLE `user_favoritedproducts`
  ADD KEY `favorited_userid_idx` (`favorited_userid`),
  ADD KEY `favoried_productid_idx` (`favoried_productid`);

--
-- Indexes for table `user_past_purchases`
--
ALTER TABLE `user_past_purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `user_id_idx` (`user_id`),
  ADD KEY `user_creditcards_idx` (`user_creditcards`),
  ADD KEY `user_shippingx_idx` (`user_shipping`);

--
-- Indexes for table `user_shippinginformation`
--
ALTER TABLE `user_shippinginformation`
  ADD PRIMARY KEY (`user_shipping_id`),
  ADD KEY `user_shipping_userid_idx` (`user_shipping_userid`);

--
-- Indexes for table `working_booking`
--
ALTER TABLE `working_booking`
  ADD PRIMARY KEY (`idworking_booking`);

--
-- Indexes for table `working_employees`
--
ALTER TABLE `working_employees`
  ADD PRIMARY KEY (`working_id`),
  ADD KEY `user_id_working_idx` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_typevariants`
--
ALTER TABLE `cart_typevariants`
  MODIFY `cart_typevariants_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees_task`
--
ALTER TABLE `employees_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `idquantityleft` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `idnotification` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_booking`
--
ALTER TABLE `user_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_creditcardinfo`
--
ALTER TABLE `user_creditcardinfo`
  MODIFY `user_creditcardinfo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `user_past_purchases`
--
ALTER TABLE `user_past_purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_shippinginformation`
--
ALTER TABLE `user_shippinginformation`
  MODIFY `user_shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `working_booking`
--
ALTER TABLE `working_booking`
  MODIFY `idworking_booking` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `working_employees`
--
ALTER TABLE `working_employees`
  MODIFY `working_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `inventory_productid` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `review_store_id` FOREIGN KEY (`review_store_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
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
  ADD CONSTRAINT `product_id_cart` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_cart` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user_creditcardinfo`
--
ALTER TABLE `user_creditcardinfo`
  ADD CONSTRAINT `user_creditcardinfo_userid` FOREIGN KEY (`user_creditcardinfo_userid`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `user_id_purchase` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_shippingx` FOREIGN KEY (`user_shipping`) REFERENCES `user_shippinginformation` (`user_shipping_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_shippinginformation`
--
ALTER TABLE `user_shippinginformation`
  ADD CONSTRAINT `user_shipping_useridx` FOREIGN KEY (`user_shipping_userid`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `working_employees`
--
ALTER TABLE `working_employees`
  ADD CONSTRAINT `user_id_working` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
