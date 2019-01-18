-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 18, 2019 at 11:50 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kitchen_kits`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_type`
--

DROP TABLE IF EXISTS `activity_type`;
CREATE TABLE IF NOT EXISTS `activity_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_type`
--

INSERT INTO `activity_type` (`id`, `name`) VALUES
(1, 'Order'),
(2, 'View'),
(3, 'Rating'),
(4, 'Comment');

-- --------------------------------------------------------

--
-- Table structure for table `add_ingredient`
--

DROP TABLE IF EXISTS `add_ingredient`;
CREATE TABLE IF NOT EXISTS `add_ingredient` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) DEFAULT NULL,
  `ingredient_id` int(10) DEFAULT NULL,
  `ingredient_amount` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `user_id`, `name`) VALUES
(1, 1, 'Karan Hull'),
(2, 17, 'Darcie-Mae Carter'),
(3, 18, 'Wren Mcmahon');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `manager_id` int(10) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `branch_address` varchar(100) DEFAULT NULL,
  `status` varchar(5) DEFAULT 'I',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `manager_id`, `code`, `name`, `branch_address`, `status`, `created_date`, `updated_date`) VALUES
(1, 1, 'BR00001', 'Branch_1', '06A Brown Mill, Poblacion, Bago 9322 Sultan Kudarat', 'A', '2018-12-04 11:42:54', '2018-12-04 11:42:54'),
(2, 2, 'BR00002', 'Branch_2', '38A/69 Kirlin Way Apt. 830, Jimalalud 2342 Nueva E', 'A', '2018-12-04 11:42:54', '2018-12-04 11:42:54'),
(3, 3, 'BR00003', 'Branch_3', '02A/76 Nienow Field Apt. 081, Pinamalayan 8393 Isa', 'A', '2018-12-04 11:42:54', '2018-12-04 11:42:54'),
(4, 9, 'BR00004', 'Branch_4', '03A Block Garden Apt. 569, Oroquieta City 4066 Cot', 'I', '2018-12-04 11:42:54', '2019-01-08 14:59:32'),
(5, 10, 'BR00005', 'Branch_5', '35A/44 Nolan Mews Apt. 283, Poblacion, Ilagan 2836', 'A', '2018-12-04 11:42:54', '2019-01-06 22:17:41'),
(6, 5, 'BR00006', 'Branch_6', '51A Kessler Crescent Apt. 709, Bacacay 6960 Laguna', 'A', '2018-12-05 20:20:34', '2019-01-08 14:58:06'),
(7, 7, 'BR00007', 'Branch_7', '68A/94 Bednar Field, Poblacion, Naga 4664 Batanes', 'A', '2018-12-05 20:20:37', '2019-01-08 14:58:17'),
(10, 0, 'BR00008', 'Branch_8', '66A Cummings Meadow Apt. 241, Pililla 5006 Quezon', 'I', '2018-12-05 21:06:14', '2018-12-05 21:06:14'),
(11, 0, 'BR00009', 'Branch_9', '07 Huel Landing, Poblacion, Las Piñas 1102 Norther', 'I', '2018-12-05 21:24:07', '2018-12-05 21:24:07'),
(12, 0, 'BR00012', 'Branch_10', '96 Marvin Burgs, Poblacion, Urdaneta 1609 Aklan', 'I', '2018-12-11 13:51:59', '2018-12-11 13:51:59'),
(13, 0, 'BR00013', 'Branch_11', '30A Barton Cliffs, Poblacion, Samal 1572 Apayao', 'I', '2018-12-11 13:55:30', '2019-01-08 14:57:52'),
(14, 0, 'BR00014', 'Branch_12', '27 Pfeffer Motorway, San Fernando 1430 Surigao del Sur', 'I', '2018-12-11 14:01:13', '2019-01-06 22:17:28');

-- --------------------------------------------------------

--
-- Table structure for table `branch_ingredients`
--

DROP TABLE IF EXISTS `branch_ingredients`;
CREATE TABLE IF NOT EXISTS `branch_ingredients` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ingredient_id` int(10) DEFAULT NULL,
  `branch_id` int(10) DEFAULT NULL,
  `supply` int(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch_ingredients`
--

INSERT INTO `branch_ingredients` (`id`, `ingredient_id`, `branch_id`, `supply`, `updated_date`) VALUES
(1, 1, 1, 100, '2019-01-08 16:43:15'),
(2, 2, 1, 500, '2019-01-08 16:43:15'),
(3, 3, 1, 500, '2019-01-08 16:43:15'),
(4, 4, 2, 200, '2019-01-08 16:43:15'),
(5, 5, 2, 600, '2019-01-08 16:43:15'),
(6, 6, 2, 600, '2019-01-08 16:43:15'),
(7, 7, 3, 300, '2019-01-08 16:43:15'),
(8, 8, 3, 700, '2019-01-08 16:43:15'),
(9, 9, 3, 700, '2019-01-08 16:43:15'),
(10, 10, 4, 400, '2019-01-08 16:43:15'),
(11, 11, 4, 800, '2019-01-08 16:43:15'),
(12, 12, 4, 800, '2019-01-08 16:43:15'),
(13, 13, 5, 500, '2019-01-08 16:43:15'),
(14, 14, 5, 900, '2019-01-08 16:43:15'),
(15, 15, 5, 900, '2019-01-08 16:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `branch_manager`
--

DROP TABLE IF EXISTS `branch_manager`;
CREATE TABLE IF NOT EXISTS `branch_manager` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` varchar(5) DEFAULT 'U',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch_manager`
--

INSERT INTO `branch_manager` (`id`, `user_id`, `code`, `name`, `status`) VALUES
(1, 2, 'BM00001', 'Valerie Burke', 'A'),
(2, 3, 'BM00002', 'Tymoteusz Greer', 'A'),
(3, 4, 'BM00003', 'Mahir Leigh', 'A'),
(4, 5, 'BM00004', 'Blake Irwin', 'U'),
(5, 6, 'BM00005', 'Rhianna Key', 'A'),
(6, 19, 'BM00006', 'Ilayda Burt', 'U'),
(7, 20, 'BM00007', 'Ellie-Mae Storey', 'A'),
(8, 21, 'BM00008', 'Rian Lindsey', 'U'),
(9, 22, 'BM00009', 'Sabrina Jacobs', 'A'),
(10, 23, 'BM00010', 'Robert Estopace', 'A'),
(11, 24, 'BM00011', 'Charlone Poserio', 'U');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `activity_id`, `message`) VALUES
(1, 15, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(2, 16, 'Aliquam erat volutpat. Curabitur quis enim vehicula, porta magna sed, consectetur nunc.'),
(3, 17, 'Donec in lacinia mauris. Aenean mi nisi, suscipit convallis augue eget, facilisis imperdiet velit.');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

DROP TABLE IF EXISTS `counter`;
CREATE TABLE IF NOT EXISTS `counter` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) DEFAULT NULL,
  `count` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id`, `code`, `count`) VALUES
(1, 'BR', 14),
(2, 'BM', 11),
(3, 'CS', 12);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `region_id` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `region_id`, `name`) VALUES
(1, 1, 'China'),
(2, 1, 'India'),
(3, 1, 'Japan'),
(4, 1, 'Philippines'),
(5, 1, 'South Korea'),
(6, 1, 'Thailand'),
(7, 2, 'France'),
(8, 2, 'Greece'),
(9, 2, 'Italy'),
(10, 2, 'Mexico'),
(11, 2, 'Spain'),
(12, 2, 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `first_name` char(50) DEFAULT NULL,
  `last_name` char(50) DEFAULT NULL,
  `image` blob,
  `email_address` varchar(50) DEFAULT NULL,
  `home_address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `user_id`, `code`, `first_name`, `last_name`, `image`, `email_address`, `home_address`) VALUES
(1, 7, 'CS00001', 'Devon', 'Marsh', NULL, 'devmar@gmail.com', '89 McGlynn Parkways, Poblacion, Samal 5867 Biliran'),
(2, 8, 'CS00002', 'Sinead', 'Downs', NULL, 'sindow@gmail.com', '22/68 Nader Mission, Poblacion, Dasmariñas 9105 Co'),
(3, 9, 'CS00003', 'Patsy', 'Gardiner', NULL, 'patgar@gmail.com', '53 Hirthe Unions, Poblacion, Malolos 0893 Pangasin'),
(4, 10, 'CS00004', 'Javier', 'Nieves', NULL, 'javnie@gmail.com', '11 Haley Causeway, Molave 5749 Bulacan'),
(5, 11, 'CS00005', 'Yusha', 'England', NULL, 'yuseng@gmail.com', '53/28 Osinski Crossroad Apt. 778, Poblacion, Talis'),
(6, 12, 'CS00006', 'Ashwin', 'Jaramillo', NULL, 'ashjar@gmail.com', '16 Ruecker Tunnel, Poblacion, Catbalogan 2334 Isab'),
(7, 13, 'CS00007', 'Poppy', 'Harper', NULL, 'pophar@gmail.com', '11/83 Bergstrom Inlet, Poblacion, Ligao 9088 Negro'),
(8, 14, 'CS00008', 'Celeste', 'Calderon', NULL, 'celcal@gmail.com', '26 Stoltenberg Terrace, Sadanga 0080 Ilocos Sur'),
(9, 15, 'CS00009', 'Izzy', 'Curry', NULL, 'izzcur@gmail.com', '74 Pfannerstill Causeway, Bakun 8640 Antique'),
(10, 16, 'CS00010', 'Greg', 'Koch', NULL, 'grekoc@gmail.com', '58/32 Ledner Estates, Poblacion, Tagaytay 8983 Ilo');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `branch_id` int(10) DEFAULT NULL,
  `activity_id` int(10) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `customer_id`, `branch_id`, `activity_id`, `code`, `status`) VALUES
(1, 1, 1, 1, 'OR00001', 'I'),
(2, 2, 1, 2, 'OR00002', 'I'),
(3, 3, 2, 3, 'OR00003', 'I'),
(4, 4, 2, 4, 'OR00004', 'C'),
(5, 5, 3, 5, 'OR00005', 'I'),
(6, 6, 3, 6, 'OR00006', 'C'),
(7, 7, 4, 7, 'OR00007', 'C'),
(8, 8, 4, 8, 'OR00008', 'I'),
(9, 9, 5, 9, 'OR00009', 'C'),
(10, 10, 5, 10, 'OR00010', 'I'),
(11, 1, 1, 11, 'OR00011', 'I'),
(12, 2, 1, 12, 'OR00012', 'P'),
(13, 3, 2, 13, 'OR00013', 'I'),
(14, 1, 0, 0, '0', 'I');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `unit_id` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `unit_id`, `name`) VALUES
(1, 1, 'Chicken'),
(2, 2, 'Garlic'),
(3, 2, 'Onion'),
(4, 1, 'Pork'),
(5, 2, 'Red Bell Pepper'),
(6, 2, 'Green Bell Pepper'),
(7, 1, 'Beef'),
(8, 2, 'Potato'),
(9, 2, 'Carrot'),
(10, 1, 'Salmon'),
(11, 2, 'Tomato'),
(12, 2, 'Potato'),
(13, 1, 'Tuna'),
(14, 2, 'Salt'),
(15, 2, 'Pepper');

-- --------------------------------------------------------

--
-- Table structure for table `order_content`
--

DROP TABLE IF EXISTS `order_content`;
CREATE TABLE IF NOT EXISTS `order_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `recipe_id` int(10) DEFAULT NULL,
  `order_id` int(10) DEFAULT NULL,
  `quantity` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_content`
--

INSERT INTO `order_content` (`id`, `recipe_id`, `order_id`, `quantity`) VALUES
(1, 1, 1, 2),
(2, 2, 2, 2),
(3, 3, 3, 1),
(4, 4, 4, 3),
(5, 5, 5, 2),
(6, 6, 6, 1),
(7, 7, 7, 1),
(8, 8, 8, 2),
(9, 9, 9, 3),
(10, 10, 10, 1),
(11, 11, 11, 1),
(12, 4, 11, 2),
(13, 12, 12, 2),
(14, 6, 13, 1),
(15, 1, 13, 3),
(16, 2, 14, 3),
(17, 3, 14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `activity_id`, `rating`) VALUES
(1, 1, 4),
(2, 2, 5),
(3, 3, 3),
(4, 1, 5),
(5, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `country_id` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `instructions` text,
  `cooking_time` varchar(10) DEFAULT '00:00:00',
  `servings` int(10) DEFAULT NULL,
  `image` blob,
  `status` varchar(5) DEFAULT 'I',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `country_id`, `name`, `price`, `instructions`, `cooking_time`, `servings`, `image`, `status`, `created_date`, `updated_date`) VALUES
(1, 1, 'Spinach-and-Pork Wantons', '300', NULL, '01:00:00', 8, NULL, 'A', '2018-11-28 16:43:56', '2018-11-28 16:43:56'),
(2, 1, 'Stir-Fried Chicken With Chinese Cabbage ', '350', NULL, '00:30:00', 4, NULL, 'A', '2018-11-28 16:43:57', '2018-11-28 16:43:57'),
(3, 3, 'Yakitori-Style Pan-Roasted Duck Breast', '400', NULL, '01:35:00', 6, NULL, 'A', '2018-11-28 16:43:58', '2018-11-28 16:43:58'),
(4, 3, 'Eggplant Tempura', '200', NULL, '00:30:00', 4, NULL, 'A', '2018-11-28 16:43:59', '2018-11-28 16:43:59'),
(5, 4, 'Chicken-And-Pork Adobo', '250', NULL, '01:20:00', 6, NULL, 'A', '2018-11-28 16:43:59', '2018-11-28 16:43:59'),
(6, 4, 'Filipino Pork Barbecue', '300', NULL, '00:50:00', 6, NULL, 'A', '2018-11-28 16:44:01', '2018-11-28 16:44:01'),
(7, 12, 'Baked Beans', '150', NULL, '04:15:00', 8, NULL, 'A', '2018-11-28 16:44:03', '2018-11-28 16:44:03'),
(8, 12, 'Meat Loaf With Bacon', '200', NULL, '02:00:00', 8, NULL, 'A', '2018-11-28 16:44:04', '2018-11-28 16:44:04'),
(9, 7, 'Chicken Dijon', '250', NULL, '00:45:00', 4, NULL, 'A', '2018-11-28 16:44:04', '2018-11-28 16:44:04'),
(10, 7, 'Potatos Lyonnaise With Lemon And Chile', '300', NULL, '00:50:00', 4, NULL, 'A', '2018-11-28 16:44:06', '2018-11-28 16:44:06'),
(11, 10, 'Grilled-Chicken Tacos', '250', '', '00:30:00', 6, NULL, 'A', '2018-11-28 17:27:05', '2019-01-16 13:14:49'),
(12, 10, 'Baked Huevos Rancheros ', '150', NULL, '00:45:00', 4, NULL, 'A', '2018-11-28 17:27:06', '2018-11-28 17:27:06'),
(13, 4, 'Sinigang Na Lanz', '250', NULL, '00:01:20', 3, NULL, 'A', '2018-12-05 19:02:19', '2018-12-05 19:02:19'),
(14, 4, 'Adobong Quail Eggs', '250', NULL, '00:01:20', 5, NULL, 'A', '2018-12-05 19:05:24', '2018-12-05 19:05:24'),
(15, 4, 'Nilagang Sibuyas', '200', '', '180', 8, NULL, 'A', '2018-12-05 19:18:37', '2019-01-16 13:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

DROP TABLE IF EXISTS `recipe_ingredients`;
CREATE TABLE IF NOT EXISTS `recipe_ingredients` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ingredient_id` int(10) DEFAULT NULL,
  `recipe_id` int(10) DEFAULT NULL,
  `ingredient_amount` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`id`, `ingredient_id`, `recipe_id`, `ingredient_amount`) VALUES
(1, 1, 1, '10'),
(2, 2, 2, '11'),
(3, 3, 3, '12'),
(4, 4, 4, '13'),
(5, 5, 5, '14'),
(6, 6, 6, '15'),
(7, 7, 7, '16'),
(8, 8, 8, '17'),
(9, 9, 9, '18'),
(10, 10, 10, '19'),
(11, 11, 11, '20'),
(12, 12, 12, '21'),
(13, 13, 13, '22'),
(14, 14, 14, '23'),
(15, 15, 15, '24'),
(16, 2, 1, '25'),
(17, 3, 1, '26'),
(18, 4, 1, '27');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `name`) VALUES
(1, 'East'),
(2, 'West');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) DEFAULT NULL,
  `total_cost` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `order_id`, `total_cost`) VALUES
(1, 1, NULL),
(2, 2, NULL),
(3, 3, NULL),
(4, 4, NULL),
(5, 5, NULL),
(6, 6, NULL),
(7, 7, NULL),
(8, 8, NULL),
(9, 9, NULL),
(10, 10, NULL),
(11, 11, NULL),
(12, 12, NULL),
(13, 13, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
CREATE TABLE IF NOT EXISTS `unit` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `name`) VALUES
(1, 'Kilos'),
(2, 'Grams');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `logged_in` varchar(5) DEFAULT '0',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_type_id`, `username`, `password`, `status`, `logged_in`, `created_date`, `updated_date`) VALUES
(1, 1, 'admin01', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:22', '2019-01-16 20:30:11'),
(2, 2, 'manager01', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:25', '2019-01-16 20:28:47'),
(3, 2, 'manager02', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:31', '2019-01-16 20:29:26'),
(4, 2, 'manager03', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:37', '2018-11-28 15:02:37'),
(5, 2, 'manager04', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:59', '2018-11-28 15:02:59'),
(6, 2, 'manager05', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:03:03', '2018-11-28 15:03:03'),
(7, 3, 'customer01', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '1', '2018-11-28 15:02:05', '2019-01-16 19:45:03'),
(8, 3, 'customer02', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:06', '2018-11-28 15:02:06'),
(9, 3, 'customer03', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:06', '2018-11-28 15:02:06'),
(10, 3, 'customer04', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:07', '2018-11-28 15:02:07'),
(11, 3, 'customer05', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'I', '0', '2018-11-28 15:02:09', '2018-11-28 15:02:09'),
(12, 3, 'customer06', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:10', '2018-11-28 15:02:10'),
(13, 3, 'customer07', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:10', '2018-11-28 15:02:10'),
(14, 3, 'customer08', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:11', '2018-11-28 15:02:11'),
(15, 3, 'customer09', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'I', '0', '2018-11-28 15:02:11', '2018-11-28 15:02:11'),
(16, 3, 'customer10', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:12', '2018-11-28 15:02:12'),
(17, 1, 'admin02', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:57:20', '2018-11-28 15:57:20'),
(18, 1, 'admin03', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:57:22', '2019-01-16 20:31:04'),
(19, 2, 'manager06', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'I', '0', '2018-12-05 20:09:53', '2018-12-05 20:09:53'),
(20, 2, 'manager07', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-12-05 20:09:55', '2018-12-05 20:09:55'),
(21, 2, 'manager08', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-12-05 20:36:20', '2018-12-05 20:36:20'),
(22, 2, 'manager09', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-12-05 20:36:23', '2018-12-05 20:36:23'),
(23, 2, 'manager10', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-12-11 13:58:01', '2019-01-06 21:23:30'),
(24, 2, 'manager11', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'I', '0', '2018-12-11 13:58:34', '2018-12-11 13:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE IF NOT EXISTS `user_activity` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `recipe_id` int(10) DEFAULT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `activity_type_id` int(10) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id`, `recipe_id`, `customer_id`, `activity_type_id`, `created_date`) VALUES
(1, 1, 1, 1, '2019-01-10 22:06:47'),
(2, 2, 2, 1, '2019-01-11 22:06:47'),
(3, 3, 3, 1, '2019-01-12 22:06:47'),
(4, 4, 4, 1, '2019-01-10 22:06:47'),
(5, 5, 5, 1, '2019-01-11 22:06:47'),
(6, 6, 6, 1, '2019-01-12 22:06:47'),
(7, 7, 7, 1, '2019-01-10 22:06:47'),
(8, 8, 8, 1, '2019-01-06 22:06:47'),
(9, 9, 9, 1, '2019-01-06 22:06:47'),
(10, 10, 10, 1, '2019-01-06 22:06:47'),
(11, 11, 1, 1, '2019-01-06 22:06:47'),
(12, 12, 2, 1, '2019-01-06 22:06:47'),
(13, 13, 3, 1, '2019-01-06 22:06:47'),
(15, 1, 1, 4, '2019-01-06 22:06:47'),
(16, 1, 2, 4, '2019-01-06 22:06:47'),
(17, 2, 3, 4, '2019-01-06 22:06:47'),
(18, 1, 1, 3, '2019-01-06 22:06:47'),
(19, 2, 1, 3, '2019-01-06 22:06:47'),
(20, 3, 1, 3, '2019-01-06 22:06:47'),
(21, 1, 2, 3, '2019-01-06 22:06:47'),
(22, 2, 3, 3, '2019-01-06 22:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(1, 'Administrator'),
(2, 'Branch Manager'),
(3, 'Customer');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
