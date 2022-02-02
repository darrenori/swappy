-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 02, 2022 at 11:30 AM
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
(268, 'Size', 'Large', '2.3', 33918750),
(269, 'Color', 'Black', '0', 33918750),
(271, 'Size', 'Large', '2.3', 40029523),
(272, 'Color', 'White', '3.1', 40029523);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_type` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_type`) VALUES
(1, 'Routers'),
(2, 'Accessories'),
(3, 'Switches'),
(4, 'Utility'),
(5, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `employees_task`
--

DROP TABLE IF EXISTS `employees_task`;
CREATE TABLE `employees_task` (
  `task_id` int(11) NOT NULL,
  `working_id` int(11) NOT NULL,
  `task_name` text NOT NULL,
  `task_details` varchar(255) NOT NULL,
  `task_progress` varchar(9) NOT NULL,
  `task_assignedby` varchar(125) NOT NULL,
  `task_dateassigned` varchar(45) NOT NULL,
  `task_datetofinish` varchar(45) NOT NULL,
  `task_dateedited` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees_task`
--

INSERT INTO `employees_task` (`task_id`, `working_id`, `task_name`, `task_details`, `task_progress`, `task_assignedby`, `task_dateassigned`, `task_datetofinish`, `task_dateedited`) VALUES
(10, 3, 'uwu', 'chance', '1', 'root', '2022-01-30 16:13:39', '2022-02-02 16:13:00', '2022-02-01 19:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

DROP TABLE IF EXISTS `employee_attendance`;
CREATE TABLE `employee_attendance` (
  `attendance_id` int(11) NOT NULL,
  `attendance_date` varchar(45) NOT NULL,
  `attendance_in_time` varchar(45) NOT NULL,
  `attendance_out_time` varchar(45) NOT NULL,
  `attendance_status` varchar(45) NOT NULL,
  `attendance_userid` int(11) NOT NULL,
  `attendance_break` varchar(45) NOT NULL,
  `attendance_current_month` varchar(45) NOT NULL,
  `attendance_current_year` varchar(45) NOT NULL,
  `attendance_workingid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_attendance`
--

INSERT INTO `employee_attendance` (`attendance_id`, `attendance_date`, `attendance_in_time`, `attendance_out_time`, `attendance_status`, `attendance_userid`, `attendance_break`, `attendance_current_month`, `attendance_current_year`, `attendance_workingid`) VALUES
(1, '24/01/2022', '12:58:43 am', '', 'Clock In Verified', 2, '60', '01', '2022', 3),
(2, '25/01/2022', '11:27:11 pm', '11:27:25 pm', 'Valid', 2, '60', '01', '2022', 3);

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave`
--

DROP TABLE IF EXISTS `employee_leave`;
CREATE TABLE `employee_leave` (
  `leave_id` int(11) NOT NULL,
  `leave_date` varchar(45) NOT NULL,
  `leave_status` varchar(45) NOT NULL,
  `leave_userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_leave`
--

INSERT INTO `employee_leave` (`leave_id`, `leave_date`, `leave_status`, `leave_userid`) VALUES
(1, '25/01/2022', 'Approved', 2),
(2, '29/01/2022', 'Approved', 2);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `product_id` int(11) NOT NULL,
  `productcode` varchar(45) NOT NULL,
  `quantityleft` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`product_id`, `productcode`, `quantityleft`) VALUES
(1, '05bbf12433b036df8b503f774db14486', '42'),
(1, '0d783821eeb637b7b245f0c5b53bb191', '62'),
(1, '2b22d78d21ff5850b75ed3d38c0111fb', '39'),
(5, '38fc554ba26a85cc454f3a4b8ec7b301', '14'),
(2, '3c771bf8d75fb729a61fd38cdf7e08c2', '10'),
(21, '408a1744d8ac2c168bf466c088858cc0', '9'),
(25, '463c84564ef84217c934f75641aafa2f', '5'),
(25, '5b1dbab9438b78c28f756b31d5c7324c', '5'),
(5, '63fbb9b1eb1701eb3ab328f218ba65df', '10'),
(6, '6d30558d5156e1f2e9875fcc1bfaffa8', '24'),
(1, '7588ffe7c10af6736e7f1095d6433ea1', '9'),
(6, '7a05910580d20aa3e139c990b68b3673', '25'),
(2, '7a661e7347e9d0a868cc9cdf91f634ce', '41'),
(4, 'bd8dd1cda82f264d6a392e161e290dfa', '27'),
(21, 'c4a1c4c2054ef9b4f8b53e305bc4fac3', '4'),
(3, 'c9ca592076cfdc0f97ea3132e770c1f6', '1'),
(3, 'f40d7fba5e93532f0c84a3a874b47889', '80');

-- --------------------------------------------------------

--
-- Table structure for table `likedby`
--

DROP TABLE IF EXISTS `likedby`;
CREATE TABLE `likedby` (
  `likedby_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `liked` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likedby`
--

INSERT INTO `likedby` (`likedby_id`, `review_id`, `user_id`, `product_id`, `liked`) VALUES
(22, 65, 2, 3, 1),
(23, 64, 2, 3, 1),
(24, 63, 2, 3, 1),
(25, 62, 2, 3, 1),
(26, 42, 2, 1, 0),
(27, 43, 2, 1, 1),
(29, 67, 2, 1, 1);

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
  `notification` varchar(200) NOT NULL,
  `header` varchar(65) NOT NULL,
  `level` int(1) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`idnotification`, `user_id`, `notification`, `header`, `level`, `type`) VALUES
(1, 0, 'uwu', 'HARLO NOTI', 0, 0),
(2, 2, 'um root i am testing groot', 'ee', 2, 1),
(3, 0, 'wasup nibba', 'harlo', 0, 1);

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
-- Table structure for table `productcat`
--

DROP TABLE IF EXISTS `productcat`;
CREATE TABLE `productcat` (
  `cat_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productcat`
--

INSERT INTO `productcat` (`cat_id`, `product_id`) VALUES
(1, 5),
(2, 1),
(4, 1),
(5, 1),
(3, 2),
(4, 3),
(2, 4),
(5, 4),
(4, 4);

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
  `total_quantity` int(11) DEFAULT NULL,
  `old` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_about`, `product_picone`, `product_pictwo`, `product_picthree`, `total_quantity`, `old`) VALUES
(1, 'Torchlight', 7.99, 'lighter', NULL, NULL, NULL, 154, NULL),
(2, 'Cisco SG250-08 8 Port Gigabit Smart Switch SG250', 190.21, 'The Cisco 250 Series is the next generation of affordable smart switches that combine powerful network performance and reliability with a complete suite of the network features you need for a solid business network. These powerful Fast Ethernet or Gigabit Ethernet switches, with Gigabit or 10 Gigabit Ethernet uplinks, provide multiple management options, sophisticated security capabilities, fine-tuned Quality-of-Service (QoS) and Layer 3 static routing features far beyond those of an unmanaged or consumer-grade switch, at a lower cost than for fully managed switches. And with an easy-to-use web user interface, Smart Network Application, and Power over Ethernet Plus (PoE) capability, you can deploy and configure a complete business network in minutes.', '', '', '', 53, NULL),
(3, 'LAN CABLE CAT 6 UTP', 10.9, 'Cat 6, is a standardized twisted pair cable for Ethernet and other network physical layers that is backward compatible with the Category 5/5e and Category 3 cable standards. Compared with Cat 5 and Cat 5e, Cat 6 features more stringent specifications for crosstalk and system noise. The cable standard specifies performance of up to 250 MHz.', NULL, NULL, NULL, 90, NULL),
(4, 'Robotic Arm', 412.42, 'Reduces the front-end investment of your automation projects and gives you a quick ROI. Collaborative robot with 5kg payload, 700mm reach, free software, open-source platform. Simplify Complex Tasks. Schedule A Demo. Boost Productivity', NULL, NULL, NULL, 21, NULL),
(5, 'Router', 600.21, 'A router is a networking device that forwards data packets between computer networks. Routers perform the traffic directing functions on the Internet.', NULL, NULL, NULL, 25, NULL),
(6, 'Engine', 23.23, 'Monkey, Zoo, Kangaroo, Crocodile Giraffe LiOn engine', NULL, NULL, NULL, 50, NULL),
(21, 'willuwork', 23.1, 'um', NULL, NULL, NULL, 13, NULL),
(25, 'chicken rice', 2.31, 'ansdjansjndn', NULL, NULL, NULL, 10, NULL);

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
(5, 12),
(6, 13),
(6, 14),
(21, 61),
(21, 62),
(21, 63),
(25, 71),
(25, 72),
(25, 73);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `review_product_id` int(11) NOT NULL,
  `review_user_id` int(11) NOT NULL,
  `review_comment` varchar(255) DEFAULT NULL,
  `review_rating` int(11) DEFAULT NULL,
  `review_pic` varchar(45) DEFAULT NULL,
  `review_total_likes` int(11) DEFAULT NULL,
  `review_total_dislikes` int(11) DEFAULT NULL,
  `review_date` varchar(45) DEFAULT NULL,
  `childof_id` int(11) DEFAULT NULL,
  `edited` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `review_product_id`, `review_user_id`, `review_comment`, `review_rating`, `review_pic`, `review_total_likes`, `review_total_dislikes`, `review_date`, `childof_id`, `edited`) VALUES
(42, 1, 2, 'ead', 2, 'uploads/IMG-61cea8bab469c9.94053952.jpg', 0, 1, '2021-12-31 14:52:42', NULL, NULL),
(43, 1, 2, 'uwu', 0, '', 1, 0, '2021-12-31 14:54:36', 42, NULL),
(46, 4, 2, 'dar', 2, 'uploads/IMG-61d27bbf4c5e92.66886824.png', 0, 0, '2022-01-03 12:29:51', NULL, NULL),
(48, 2, 2, 'katamine', 2, 'uploads/IMG-61d400cc221287.01194408.jpg', 0, 0, '2022-01-04 16:09:48', NULL, NULL),
(51, 2, 2, 'asdds', 3, 'uploads/IMG-61f57de7ed4421.06036147.png', 0, 0, '2022-01-30 01:48:24', NULL, NULL),
(52, 2, 2, 'asd', 2, 'uploads/IMG-61f57dfa068300.43887107.png', 0, 0, '2022-01-30 01:48:42', NULL, NULL),
(53, 2, 2, 'asdsd', 3, 'uploads/IMG-61f57e6f9d99c8.73472745.png', 0, 0, '2022-01-30 01:50:39', NULL, NULL),
(54, 6, 2, 'asd', 2, 'uploads/IMG-61f58091b6d7a2.12559038.png', 0, 0, '2022-01-30 01:59:45', NULL, NULL),
(55, 6, 2, 'asd', 0, '', 0, 0, '2022-01-30 02:01:22', 54, NULL),
(62, 3, 2, 'why', 3, 'uploads/IMG-61f589788e6130.64497937.png', 1, 0, '2022-01-30 02:37:44', NULL, 1),
(63, 3, 2, 'yay', 5, '', 1, 0, '2022-01-30 02:37:49', 62, 1),
(64, 3, 2, 's', 0, '', 1, 0, '2022-01-30 03:01:12', 62, NULL),
(65, 3, 2, 'hello reply', 0, '', 1, 0, '2022-01-30 03:23:04', 62, NULL),
(67, 1, 2, 'sd', 0, '', 1, 0, '2022-01-31 02:05:25', 66, NULL);

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
(2, 'Cisco', 1, 'Cisco Systems, Inc. is an American multinational technology conglomerate corporation headquartered in San Jose, California. Integral to the growth of Silicon Valley, Cisco develops, manufactures and sells networking hardware, software, telecommunications equipment and other high-technology services and products', NULL, NULL, NULL, '80 Pasir Panjang Rd, Building 80, Lvl 25 Mapletree Biz City, Singapore 117372', '6721 2111', 'https://www.cisco.com/c/en_sg/index.html', 1, NULL),
(3, 'anjsndjnsdnj', 1, 'njsjdjnsdj', 'uploads/IMG-61f96efcafdee8.46392473.png', NULL, NULL, 'jndnsjnnds', '83810308', 'www.abc.com', 1, 0);

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
(1, 6),
(1, 21),
(1, 25),
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
  `additional_costs` float DEFAULT NULL,
  `automated` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type`, `type_choice`, `additional_costs`, `automated`) VALUES
(1, 'Size', 'Small', 0, NULL),
(2, 'Size', 'Large', 2.3, NULL),
(3, 'Color', 'Black', 0, NULL),
(4, 'Color', 'White', 3.1, NULL),
(5, 'Additional Server Rack', 'No', 0, NULL),
(6, 'Additional Server Rack', 'Yes', 1242.99, NULL),
(7, 'Length', '10m', 0, NULL),
(8, 'Length', '100m', 20, NULL),
(11, 'Size', 'Small', 0, NULL),
(12, 'Size', 'Large', 50, NULL),
(13, 'Size', 'Small', NULL, NULL),
(14, 'Size', 'Medium', 20, NULL),
(39, 'size', 'large', 10, '30068854'),
(40, 'size', 'small', 0, '30068854'),
(41, 'color', 'green', 0, '30068854'),
(42, 'color', 'blue', 2, '30068854'),
(43, 'length', '10m', 0, '30068854'),
(44, 'length', '50m', 5, '30068854'),
(45, 'color', 'black', 2.3, '30068854'),
(46, 'color', 'green', 0, '30068854'),
(47, 'color', 'black', 0, '30068854'),
(48, 'color', 'white', 0, '30068854'),
(49, 'size', 'large', 0, '30068854'),
(50, 'size', 'small', 0, '30068854'),
(51, 'color', 'green', 23.1, '30068854'),
(52, 'color', 'yellow', 0, '30068854'),
(53, 'size', 'large', 1, '30068854'),
(54, 'size', 'small', 0, '30068854'),
(55, 'color', 'grene', 2, '30068854'),
(56, 'size', 'large', 1, '30068854'),
(57, 'size', 'small', 2, '30068854'),
(58, 'color', 'green', 1, '30068854'),
(59, 'color', 'blue', 0, '30068854'),
(60, 'size', 'large', 1, '30068854'),
(61, 'color', 'black', 2, '89344557'),
(62, 'color', 'green', 42, '89344557'),
(63, 'weight', '10kg', 1, '89344557'),
(64, 'color', 'green', 3, '33547592'),
(65, 'color', 'blue', 1, '33547592'),
(66, 'color', 'green', 0, '30824308'),
(67, 'color', 'yelow', 10, '30824308'),
(68, 'size', 'large', 5, '30824308'),
(69, 'asd', 'ueu', 0, '71622024'),
(70, 'ds', '12', 0, '71622024'),
(71, 'Color', 'green', 23, '68363530'),
(72, 'Color', 'yellow', 10, '68363530'),
(73, 'Size', 'large', 12, '68363530');

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
  `user_profilepicture` text NOT NULL,
  `user_suspended` int(11) DEFAULT NULL,
  `user_failedattempts` int(11) DEFAULT NULL,
  `user_warning` int(11) DEFAULT NULL,
  `suspendedfinish` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_fname`, `user_lname`, `user_role`, `username_email`, `user_number`, `date_of_signup`, `user_security_primaryschool`, `user_security_favoritefood`, `user_secret`, `user_profilepicture`, `user_suspended`, `user_failedattempts`, `user_warning`, `suspendedfinish`) VALUES
(2, 'root', '$2y$10$1miKrdsJ6O7MIYXWaBfF7uuzFDa1VqJGJtGRXCU.mvwKqpirdj636', 'root', 'root', 6, 'roos@gmail.com', '91231231', '12/19/2021 07:53:08 pm', 'root', '123', 'NR32XESQHYRR7ERX', 'uploads/IMG-61e1cb8da936a9.05590953.jpg', 0, 3, NULL, 0),
(4, 'tester', '$2y$10$1miKrdsJ6O7MIYXWaBfF7uuzFDa1VqJGJtGRXCU.mvwKqpirdj636', 'tester', 'tester', 6, 'tester@gmail.com', '213aa', '2022-01-04 16:56:49', 'tester', 'tester', 'VSOARC5JUW5O5UM7', 'uploads/IMG-61d41294d13813.99076896.png', NULL, NULL, NULL, NULL),
(5, 'darrenori', '$2y$10$X5SzfUxvo7BH5yFWfVE9YOZMl0mii4AZxLMv5E.E53LrweUNsMxqG', 'darren', 'ong', 6, 'darrennorii@gmail.com', '12311232', '2022-01-07 00:27:30', 'ed', 'as', '5W5JRR2HCZHG2HSF', 'uploads/IMG-DEFAULTPROFILE.jpg', NULL, NULL, NULL, NULL),
(6, 'uwu', '$2y$10$5CtQeNMv8ZjRTFhyJT8SIOfOsEXl.HgHZWz0SQXOQH2dOo1DJIY/i', 'uwu', 'uwu', 0, 'uwu@gmail.com', '91922121', '2022-01-07 14:38:14', '123', '123', 'G6ZZUTKR5S3UNV4Y', 'uploads/IMG-DEFAULTPROFILE.jpg', NULL, NULL, NULL, NULL),
(7, 'darrenasd', '$2y$10$MqKo09oW55SGOxbTze.mB.aFysxF1hu6vkBJ56o.ZJCrOEXdVeZTa', 'darren', 'darren', 0, 'darrenasd@gmail.com', '91031231', '2022-01-31 17:27:11', 'a', 'a', 'HOOTJPVWUD33BZAJ', 'uploads/IMG-DEFAULTPROFILE.jpg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usersfavorite`
--

DROP TABLE IF EXISTS `usersfavorite`;
CREATE TABLE `usersfavorite` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usersfavorite`
--

INSERT INTO `usersfavorite` (`product_id`, `user_id`) VALUES
(3, 2),
(1, 2);

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
  `productcode` varchar(45) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `bundled` int(11) DEFAULT NULL,
  `purchased` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`cart_id`, `user_id`, `product_id`, `productcode`, `quantity`, `price`, `bundled`, `purchased`) VALUES
(33918750, 2, 1, '0d783821eeb637b7b245f0c5b53bb191', 1, 10.29, 95414179, 1),
(40029523, 2, 1, '2b22d78d21ff5850b75ed3d38c0111fb', 1, 13.39, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_creditcardinfo`
--

DROP TABLE IF EXISTS `user_creditcardinfo`;
CREATE TABLE `user_creditcardinfo` (
  `user_creditcardinfo_id` int(11) NOT NULL,
  `user_creditcardinfo_userid` int(11) NOT NULL,
  `user_creditcardinfo_nameoncard` varchar(45) NOT NULL,
  `user_creditcardinfo_expirymonth` varchar(45) NOT NULL,
  `user_creditcardinfo_expiryyear` varchar(45) NOT NULL,
  `user_creditcardinfo_cardtype` varchar(45) NOT NULL,
  `user_creditcardinfo_cardnumb` varchar(45) NOT NULL,
  `user_creditcardinfo_encryptkey` varchar(255) DEFAULT NULL,
  `user_creditcardinfo_iv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_creditcardinfo`
--

INSERT INTO `user_creditcardinfo` (`user_creditcardinfo_id`, `user_creditcardinfo_userid`, `user_creditcardinfo_nameoncard`, `user_creditcardinfo_expirymonth`, `user_creditcardinfo_expiryyear`, `user_creditcardinfo_cardtype`, `user_creditcardinfo_cardnumb`, `user_creditcardinfo_encryptkey`, `user_creditcardinfo_iv`) VALUES
(35, 2, 'darren', '12', '2023', 'visa', 'Xy7WDtY21UuqlZlRIrVwZg==', '294928c71509a94cacd30b53ee81bc286eced837a5e4e8ac', '00fe9b9eee645bbfc64eb586548b9f68');

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
  `purchase_cost` float NOT NULL,
  `purchase_status` int(1) DEFAULT NULL,
  `cart_bundled` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_past_purchases`
--

INSERT INTO `user_past_purchases` (`purchase_id`, `user_id`, `user_shipping`, `user_creditcards`, `purchase_time`, `purchase_cost`, `purchase_status`, `cart_bundled`) VALUES
(27, 2, 9, 35, '2022-02-01 21:24:16', 11.0103, 2, 95414179);

-- --------------------------------------------------------

--
-- Table structure for table `user_shippinginformation`
--

DROP TABLE IF EXISTS `user_shippinginformation`;
CREATE TABLE `user_shippinginformation` (
  `user_shipping_id` int(11) NOT NULL,
  `user_shipping_number` varchar(45) DEFAULT NULL,
  `user_shipping_email` varchar(45) DEFAULT NULL,
  `user_shipping_address` varchar(45) DEFAULT NULL,
  `user_shipping_postalcode` varchar(45) DEFAULT NULL,
  `user_shipping_unitnumber` varchar(45) DEFAULT NULL,
  `user_shipping_userid` int(11) NOT NULL,
  `user_shipping_default` int(11) NOT NULL,
  `user_shipping_name` varchar(45) NOT NULL,
  `deleted` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_shippinginformation`
--

INSERT INTO `user_shippinginformation` (`user_shipping_id`, `user_shipping_number`, `user_shipping_email`, `user_shipping_address`, `user_shipping_postalcode`, `user_shipping_unitnumber`, `user_shipping_userid`, `user_shipping_default`, `user_shipping_name`, `deleted`) VALUES
(4, '12313212', 'kmasdm@gmail.com', 'sad', '123123', '1231', 5, 0, 'darrem', '1'),
(5, '12312222', 'dskmd@gmail.com', 'qwe', '123112', '1231', 5, 0, 'amsda', '1'),
(6, '12311231', 'new@gmail.com', 'kmasdkm', '123123', '12312', 5, 1, 'new', ''),
(7, '83182912', 'asds@gmail.com', '231 sd', '123123', '14-2301', 2, 0, 'asdasd', '1'),
(8, '12312312', 'sndjnjn@gmail.com', 'aksndanjsndj', '123123', '12-230', 2, 0, 'asdasn', '1'),
(9, '83810308', 'jnsadnjdsnj@gmail.com', 'absdhbahsbdbhb', '820123', '14-230', 2, 1, 'darren', ''),
(10, '83180308', 'darren@gmail.com', 'asd', '123123', '14-230', 2, 0, 'darrren', '1'),
(11, '83182312', 'darern@gamil.com', 'asd', '123123', '14-230', 7, 1, 'darren', '');

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
(3, 2, 'Engineers', '91226969', 'Labour', 12312);

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
  ADD KEY `working_id_attendance_idx` (`attendance_workingid`);

--
-- Indexes for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`productcode`),
  ADD KEY `inventory_product_id_idx` (`product_id`);

--
-- Indexes for table `likedby`
--
ALTER TABLE `likedby`
  ADD PRIMARY KEY (`likedby_id`),
  ADD KEY `liked_user_id_idx` (`user_id`),
  ADD KEY `liked_product_id_idx` (`product_id`),
  ADD KEY `liked_review_id` (`review_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD KEY `likes_review_id` (`review_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`idnotification`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `productcat`
--
ALTER TABLE `productcat`
  ADD KEY `cat_id_idx` (`cat_id`),
  ADD KEY `store_id_storecat_idx` (`product_id`);

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
  ADD KEY `review_user_id_idx` (`review_user_id`),
  ADD KEY `review_product_id_idx` (`review_product_id`);

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
-- Indexes for table `usersfavorite`
--
ALTER TABLE `usersfavorite`
  ADD KEY `favorite_product_id_idx` (`product_id`),
  ADD KEY `favorite_user_id_idx` (`user_id`);

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
  ADD KEY `user_id_cart_idx` (`user_id`),
  ADD KEY `product_code_cart_idx` (`productcode`);

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
  ADD KEY `user_creditcards_idx` (`user_creditcards`);

--
-- Indexes for table `user_shippinginformation`
--
ALTER TABLE `user_shippinginformation`
  ADD PRIMARY KEY (`user_shipping_id`),
  ADD KEY `shipping_userid_idx` (`user_shipping_userid`);

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
  MODIFY `cart_typevariants_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees_task`
--
ALTER TABLE `employees_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_leave`
--
ALTER TABLE `employee_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `likedby`
--
ALTER TABLE `likedby`
  MODIFY `likedby_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `idnotification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `total_people_in_lab`
--
ALTER TABLE `total_people_in_lab`
  MODIFY `total_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_booking`
--
ALTER TABLE `user_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_creditcardinfo`
--
ALTER TABLE `user_creditcardinfo`
  MODIFY `user_creditcardinfo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_past_purchases`
--
ALTER TABLE `user_past_purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_shippinginformation`
--
ALTER TABLE `user_shippinginformation`
  MODIFY `user_shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `working_booking`
--
ALTER TABLE `working_booking`
  MODIFY `idworking_booking` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `working_employees`
--
ALTER TABLE `working_employees`
  MODIFY `working_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `working_id_attendance` FOREIGN KEY (`attendance_workingid`) REFERENCES `working_employees` (`working_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
-- Constraints for table `productcat`
--
ALTER TABLE `productcat`
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
