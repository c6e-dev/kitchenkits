-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2019 at 01:22 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

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

CREATE TABLE `activity_type` (
  `id` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `add_ingredient` (
  `id` int(10) NOT NULL,
  `order_id` int(10) DEFAULT NULL,
  `ingredient_id` int(10) DEFAULT NULL,
  `ingredient_amount` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `branch` (
  `id` int(10) NOT NULL,
  `manager_id` int(10) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `branch_address` varchar(100) DEFAULT NULL,
  `status` varchar(5) DEFAULT 'I',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `branch_ingredients` (
  `id` int(10) NOT NULL,
  `ingredient_id` int(10) DEFAULT NULL,
  `branch_id` int(10) DEFAULT NULL,
  `supply` int(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `branch_manager` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` varchar(5) DEFAULT 'U'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `branch_reports`
--

CREATE TABLE `branch_reports` (
  `id` int(10) NOT NULL,
  `branch_ingredients_id` int(10) NOT NULL,
  `amount_reduced` int(10) NOT NULL,
  `reason` text,
  `status` int(10) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) NOT NULL,
  `activity_id` int(10) DEFAULT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `counter` (
  `id` int(10) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `count` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `country` (
  `id` int(10) NOT NULL,
  `region_id` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `first_name` char(50) DEFAULT NULL,
  `last_name` char(50) DEFAULT NULL,
  `image` blob,
  `email_address` varchar(50) DEFAULT NULL,
  `home_address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `delivery` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `branch_id` int(10) DEFAULT NULL,
  `activity_id` int(10) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
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
(13, 3, 2, 13, 'OR00013', 'I');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(10) NOT NULL,
  `unit_id` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(15, 2, 'Pepper'),
(16, 2, 'Spinach'),
(17, 4, 'Soy Sauce'),
(18, 3, 'Sesame Oil'),
(19, 2, 'Sugar'),
(20, 2, 'White Pepper'),
(21, 2, 'Ginger'),
(22, 1, 'Wonton Wrappers'),
(23, 3, 'Vinegar'),
(24, 3, 'Sherry'),
(25, 2, 'Cabbage'),
(26, 3, 'Chile Oil'),
(27, 2, 'Cilantro'),
(28, 3, 'Peanut Oil'),
(29, 3, 'Cooking Oil'),
(30, 2, 'Yogurt'),
(31, 2, 'Chilli Powder'),
(32, 2, 'Coriander Leaves'),
(33, 4, 'Honey'),
(34, 2, 'Tofu'),
(35, 2, 'Shallot'),
(36, 2, 'Lemon Grass'),
(37, 4, 'Tandoori Masala'),
(38, 1, 'Lamb'),
(39, 2, 'Cinnamon'),
(40, 2, 'Turmeric Powder'),
(41, 2, 'Cumin Powder'),
(42, 2, 'Chicken Peas'),
(43, 3, 'Japanese Sake'),
(44, 2, 'Dashi Powder'),
(45, 1, 'Duck'),
(46, 2, 'Sesame Seeds'),
(47, 2, 'Flour'),
(48, 2, 'Panko Flakes'),
(49, 2, 'Eggplant'),
(50, 4, 'Banana Ketchup'),
(51, 4, 'Oyster Sauce'),
(52, 2, 'Gabi'),
(53, 2, 'Radish'),
(54, 2, 'Long Beans'),
(55, 2, 'Okra'),
(56, 2, 'Tamarind'),
(57, 2, 'Kimchi'),
(58, 5, 'Eggs'),
(59, 2, 'Paprika'),
(60, 2, 'Noodles'),
(61, 4, 'Hoisin Sauce'),
(62, 2, 'Mushroom'),
(63, 4, 'Butter'),
(64, 4, 'Dijon-style prepared Mustard'),
(65, 5, 'Lemon'),
(66, 5, 'Bay Leaves'),
(67, 2, 'Oregano'),
(68, 5, 'Burger Buns'),
(69, 2, 'Wheat'),
(70, 2, 'Cucumber'),
(71, 2, 'Breadcrumbs'),
(72, 2, 'Cheese'),
(73, 2, 'Flour'),
(74, 2, 'Parmigiano-Reggiano'),
(75, 3, 'Olive Oil'),
(76, 1, 'Rice'),
(77, 2, 'Sausage'),
(78, 2, 'Shrimp'),
(79, 2, 'Raisins'),
(80, 3, 'Wine'),
(81, 2, 'Parsley'),
(82, 2, 'Avocado'),
(83, 2, 'Corn'),
(84, 2, 'Navy Beans'),
(85, 2, 'Bacon'),
(86, 4, 'Milk'),
(87, 5, 'Celery');

-- --------------------------------------------------------

--
-- Table structure for table `order_content`
--

CREATE TABLE `order_content` (
  `id` int(10) NOT NULL,
  `recipe_id` int(10) DEFAULT NULL,
  `order_id` int(10) DEFAULT NULL,
  `quantity` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(15, 1, 13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(10) NOT NULL,
  `activity_id` int(10) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `recipe` (
  `id` int(10) NOT NULL,
  `country_id` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `instructions` text,
  `cooking_time` varchar(10) DEFAULT '00:00:00',
  `servings` int(10) DEFAULT NULL,
  `image` text,
  `status` varchar(5) DEFAULT 'I',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `country_id`, `name`, `price`, `instructions`, `cooking_time`, `servings`, `image`, `status`, `created_date`, `updated_date`) VALUES
(1, 1, 'Spinach-and-Pork Wantons', '300', 'In a skillet, cook the spinach, stirring, until wilted; transfer to a colander and squeeze dry. Finely chop the spinach. In a bowl, combine 1 1/2 teaspoons of the soy sauce, the sesame oil, sherry, salt, sugar and white pepper. Mix in the pork, scallion, ginger and spinach. Chill for 10 minutes. Dust a large baking sheet with cornstarch. Arrange 4 wonton wrappers on a work surface, keeping the other wrappers covered with plastic wrap. Brush the edges of the wrappers with water and spoon 1 teaspoon of filling in the center of each. Fold the wrappers diagonally over the filling to form triangles; seal. Bring the two opposite corners of the triangle together; press to seal. Transfer to the baking sheet and cover. Repeat. In a large saucepan of boiling water, simmer the wontons over moderate heat, stirring occasionally. When they float, cook for 3 minutes longer. Drain the wontons well. In a large bowl, combine the remaining soy sauce with the chile oil, peanut oil and garlic. Add the wontons and toss. Sprinkle with the cilantro and serve', '01:00:00', 8, 'a.jpg', 'A', '2018-11-28 16:43:56', '2018-11-28 16:43:56'),
(2, 1, 'Stir-Fried Chicken With Chinese Cabbage ', '350', 'In a medium bowl, combine the chicken with the 1 tablespoon soy sauce, 1 tablespoon of the sherry, and the cayenne. Let marinate for 10 minutes. In a wok or large frying pan, heat 1 tablespoon of the oil over moderately high heat. Add the chicken and cook, stirring, until almost done, 1 to 2 minutes. Add the remaining 1 tablespoon oil to the pan. Add the onion, garlic, and coriander. Cook, stirring, until the onions are golden, about 4 minutes. Add the remaining 2 tablespoons sherry and the vinegar. Cook, stirring, 1 minute longer. Add the cabbage, water chestnuts, the remaining 4 teaspoons soy sauce, the tomato paste, red-pepper flakes, and water and cook, stirring, for 3 minutes longer. Add the chicken and any accumulated juices, the cilantro, and the salt and cook, stirring, until the chicken is just done, 1 to 2 minutes longer.', '00:30:00', 4, 'a.jpg', 'A', '2018-11-28 16:43:57', '2018-11-28 16:43:57'),
(3, 3, 'Yakitori-Style Pan-Roasted Duck Breast', '400', '	In a small saucepan, stir the dashi powder into 1 cup of water until dissolved. Add the sake, soy sauce, mirin and sugar and bring to boil. Simmer over moderately low heat until syrupy and reduced to 1 cup, about 1 hour. Transfer all but 1/3 cup of the sauce to a jar and reserve for later use.\r\n	In a large skillet, heat the peanut oil over moderate heat until shimmering. Add the duck breasts and cook until almost medium-rare, about 4 minutes per side. Add the reserved 1/3 cup of sauce to the pan and cook the duck breasts for 4 minutes longer, swirling the pan and turning the duck once or twice until glazed. Remove from the heat and let rest for 5 minutes.\r\n	Transfer the duck to a platter and drizzle with the glaze from the pan. Sprinkle the duck with the scallions and sesame seeds and serve.', '01:35:00', 6, 'a.jpg', 'A', '2018-11-28 16:43:58', '2018-11-28 16:43:58'),
(4, 3, 'Eggplant Tempura', '200', 'In a large bowl, whisk together the flour and water until smooth. Set aside. Place the panko in a bowl and set aside.\r\nIn a large saucepan heat 2 inches of oil to 350° over medium-high heat. Dip the eggplant in the flour/water mixture. Shake off excess batter. Roll the coated eggplant in the panko until completely coated. Fry the eggplant until golden brown and crisp, about 3 minutes. Drain on paper towels or a wire rack.', '00:30:00', 4, 'a.jpg', 'A', '2018-11-28 16:43:59', '2018-11-28 16:43:59'),
(5, 4, 'Chicken-And-Pork Adobo', '250', '    In a pot over medium heat, heat oil. Add onions and garlic and cook until limp. Add pork and cook, stirring occasionally, until lightly browned. Add chicken and cook, stirring occasionally, until lightly browned and juices run clear. Add vinegar and bring to a boil, uncovered and without stirring, for about 3 to 5 minutes. Add soy sauce, water and bay leaves. Continue to boil for about 2 to 3 minutes. Lower heat, cover and continue to cook until meat is tender and sauce is reduced. Season with salt and pepper to taste. Serve hot.', '01:20:00', 6, 'a.jpg', 'A', '2018-11-28 16:43:59', '2018-11-28 16:43:59'),
(6, 4, 'Filipino Pork Barbecue', '300', 'Rinse pork strips and drain well. Pat dry. In a large bowl, combine 7-up, soy sauce, vinegar, brown sugar, black pepper, garlic, chili peppers and 1 cup of the oyster sauce. Add pork and massage meat to fully incorporate. Marinate, turning meat once or twice, in the refrigerator for at least 4 hours or overnight for best results. In a bowl, combine remaining 1 cup of oyster sauce, banana ketchup, and sesame oil. Set aside. Thread 2 to 3 meat slices onto each skewer. Grill meat over hot coals for about 2 to 3 minutes each side. When pork starts to lose its pink, baste with oyster sauce-ketchup mixture. Continue to grill and baste, turning on sides, until meat is cooked through. Remove from heat and serve as is or with spicy vinegar dip.', '00:50:00', 6, 'a.jpg', 'A', '2018-11-28 16:44:01', '2018-11-28 16:44:01'),
(7, 12, 'Baked Beans', '150', 'Soak beans overnight in cold water. Simmer the beans in the same water until tender, approximately 1 to 2 hours. Drain and reserve the liquid. Preheat oven to 325 degrees F (165 degrees C). Arrange the beans in a 2 quart bean pot or casserole dish by placing a portion of the beans in the bottom of dish, and layering them with bacon and onion. In a saucepan, combine molasses, salt, pepper, dry mustard, ketchup, Worcestershire sauce and brown sugar. Bring the mixture to a boil and pour over beans. Pour in just enough of the reserved bean water to cover the beans. Cover the dish with a lid or aluminum foil. Bake for 3 to 4 hours in the preheated oven, until beans are tender. Remove the lid about halfway through cooking, and add more liquid if necessary to prevent the beans from getting too dry.', '04:15:00', 8, 'a.jpg', 'A', '2018-11-28 16:44:03', '2018-11-28 16:44:03'),
(8, 12, 'Meat Loaf With Bacon', '200', 'Heat oven to 350° F. In a medium skillet, over medium heat, heat the oil with the onion, celery, garlic, and jalapeño and cook until the vegetables are tender but not browned, about 10 minutes. Add the salt, cumin, and nutmeg. Remove from heat. In a large bowl, whisk the eggs, then blend in the milk, tomato sauce, and bread crumbs. Add the meat and cooked vegetables and stir or work with your hands to combine. Pat into a 9-by-5-inch loaf pan. Cut the bacon strips in half and lay over the loaf, tucking the ends in. Bake 1 hour and 15 minutes or until an instant-read thermometer inserted in the meat loaf registers 150° F. Remove from oven and pour off the fat. Let stand 10 minutes before serving', '02:00:00', 8, 'a.jpg', 'A', '2018-11-28 16:44:04', '2018-11-28 16:44:04'),
(9, 7, 'Chicken Dijon', '250', 'In a large skillet, brown chicken in butter/margarine for about 15 to 20 minutes or until cooked through and juices run clear. Remove from skillet and place on a warm oven-proof platter. Preheat oven to 150 degrees F (65 degrees C). Stir flour into skillet drippings. Add broth and deglaze skillet by stirring vigorously until flour is somewhat dissolved and liquid has the consistency of a sauce. Add cream. Simmer, stirring, over moderate heat for about 10 minutes until sauce is a little thick. Stir in mustard and heat through. Pour mustard sauce over chicken breasts. Put platter in warm preheated oven for about 10 to 15 minutes, then serve!', '00:45:00', 4, 'a.jpg', 'A', '2018-11-28 16:44:04', '2018-11-28 16:44:04'),
(11, 10, 'Grilled-Chicken Tacos', '250', 'Prepare grill for medium-high heat. Toss onion, garlic, chicken, cumin, oil, salt, and pepper in a medium bowl. Grill onion and chicken until cooked through and lightly charred, about 4 minutes per side. Let chicken rest 5 minutes before slicing. Serve with tortillas, avocados, Charred Tomatillo Salsa Verde, cilantro, radishes, and lime wedges. ', '00:30:00', 6, 'a.jpg', 'A', '2018-11-28 17:27:05', '2019-01-16 13:14:49'),
(12, 10, 'Baked Huevos Rancheros ', '150', 'Preheat the oven to 400°. In a saucepan, heat the olive oil. Add the onion, bell pepper, jalapeño, garlic and oregano. Season with salt and pepper and cook over high heat, stirring, until lightly browned, 5 minutes. Add the tomato sauce and water and simmer for 5 minutes, until slightly thickened. Spoon the sauce into 4 individual, shallow baking dishes and arrange the tortilla chips around the sides. Crack 2 eggs into each dish and sprinkle with the cheese. Set the dishes on a baking sheet and bake for 15 to 20 minutes, until the egg whites are set and the yolks are still runny. Sprinkle with cilantro and serve right away.', '00:45:00', 4, 'a.jpg', 'A', '2018-11-28 17:27:06', '2018-11-28 17:27:06'),
(13, 4, 'Sinigang Na Baboy', '250', 'Wash pork ribs. In a pot over medium heat, combine pork and enough water to cover. Bring to a boil, skimming off scum that accumulates on top. Once broth clears, add tomatoes, onions and fish sauce. Lower heat and simmer for about 1 to 1-1/2 hours or until meat is tender, adding more water as necessary to maintain about 10 cups. Add gabi and cook for about 6 to 8 minutes or until soft. Add chili and radish. Continue to simmer for about 2 to 3 minutes. Add long beans. Continue to cook for about 2 minutes. Add eggplant and okra and cook for another 1 to 2 minutes. If using packaged tamarind base, add into pot and stir until completely dissolved. Season with salt and pepper to taste', '01:20:00', 3, 'a.jpg', 'A', '2018-12-05 19:02:19', '2018-12-05 19:02:19'),
(16, 1, 'Peri Peri Chicken Satay ', '280', 'Soak the skewers for at least 60 minutes or more totally submerged in water before using it to prevent burns. You may skip this part if pan grilling. Marinate thigh chicken with yogurt, chilli powder, ginger garlic paste, peri peri sauce, salt and pepper. Refrigerate and use when ready. You may make this a day or more ahead of time. Place in a zip lock bag, or sealed containers and refrigerate for at least 2 hours, preferably overnight. When ready to grill. Using tong remove excess marinates and reserve. Pre heat grill to medium- high heat. Place chicken over medium heat, and then brush with oil to prevent chicken from sticking. Grill for about 10 to 15 minutes, rotating from sides for even cooking. Keep an eye on it -- if they are browning too quickly, turn the heat down. Grill in batches if you have a small grill. Transfer the skewers to a platter. In a small saucepan simmer the remaining peri peri marinade and the one from the chicken for about 7 minutes. Serve with chicken, heat oil and prepare the potatoes fries, serve as a bed for chicken.', '02:25:00', 2, 'a.jpg', 'A', '2019-01-27 05:12:51', NULL),
(17, 1, 'Honey Chilli Potato ', '130', 'For Frying Potatoes: Take two potatoes and cut them into slices in a bowl.Honey Chilli Potato. In the bowl add corn flour, salt and red chilli powder.Honey Chilli Potato. Toss them well so that the mixture coats the sliced potatoes properly. Now heat oil in a broad pan and deep fry the potatoes on medium flame till golden brown and crisp.Honey Chilli Potato. Do not fry on high flame otherwise they will burn from outside and remain uncooked from inside. In another pan dry roast the sesame seeds on low heat till light brown and keep aside.Honey Chilli Potato. For Preparing Honey Chilli Sauce: Heat oil and add garlic, ginger, whole red chillies, chilli flakes and tomato sauce. Stir well.Honey Chilli Potato. Now add chilli sauce, vinegar, honey and salt. Mix all the ingredients well to make a sauce.Honey Chilli Potato. Add the fried potatoes and coat them well with the sauce. Toss well and sprinkle the roasted sesame seeds and spring onions.Honey Chilli Potato. Combine the ingredients well and serve the crunchy honey chilli potatoes immediately.', '00:25:00', 2, 'a.jpg', 'A', '2019-01-27 05:20:50', NULL),
(18, 1, 'Stir Fried Tofu with Rice ', '180', 'Drizzle refined oil in a preheated pan and add chopped mariner and stir well. Then add ginger, garlic, shallots and salt & pepper. Add red chilly paste, soya sauce and honey. Add some coriander leaves and mix it all together. For the fried rice: Drizzle olive oil in a pre-heated pan and add carrots, spring onions, ginger and salt & pepper. Then add fresh red chilly, lemon juice and soya sauce and stir all together. Add some chopped coriander leaves. Cook it away for 5-7 minutes. Serve it on a platter.', '00:40:00', 3, 'a.jpg', 'A', '2019-01-27 05:20:50', NULL),
(19, 2, 'Tandoori Chicken', '500', 'Make shallow diagonal slashes in the chicken pieces and keep aside. Mix the tandoori masala with the yogurt, 2 tbsp. cooking oil, garlic paste and salt to taste to make a smooth paste. Smear this paste all over the chicken pieces, ensuring you rub it well into the slashes you made earlier and that the pieces are well coated. Put all the pieces and marinade into a deep bowl and cover. Refrigerate and allow to marinate for 12 to 18 hours. Preheat your grill to medium. Put the chicken on it and quickly sear (sealing in juices) on both sides. Now allow to brown on both sides, brushing cooking oil on as necessary. Once browned, reduce heat and cover the grill. Cook till the chicken is tender. Do not overcook or the chicken will dry out. When done, place chicken on a plate or platter and sprinkle chaat masala, garnish with lime juice, lime wedges and onion rings. Serve piping hot.', '18:15:00', 6, 'a.jpg', 'A', '2019-01-27 05:34:50', NULL),
(20, 2, 'Indian Lamb Dish', '350', 'In a bowl, mix the lamb and yogurt and keep aside. This will tenderize the lamb. Heat the oil in a deep pan and add the cinnamon, cardamom, cloves, bay leaves, and peppercorns. Fry till they turn slightly darker in color. Now add the onions and fry until they turn light golden. Add the ginger and garlic pastes and fry for a minute. Add the coriander, cumin, turmeric, Kashmiri chilies, and garam masala and fry until the oil separates from the masala. Add the meat and yogurt mix to the masala and fry well. Add the beef stock, water, and salt, to taste. Cook till the gravy is reduced. Stir often. The gravy should be thick when done. Whisk the cream until smooth. Stir it into the curry to mix well. Garnish with coriander leaves and serve with plain boiled rice or pulao and a vegetable side dish.', '01:10:00', 4, 'a.jpg', 'A', '2019-01-27 05:34:50', NULL),
(21, 2, 'Punjabi-Style Chole Chickpea Curry ', '380', 'Grind 2 of the sliced onions, the tomatoes, and the ginger and garlic paste together into a smooth paste in a food processor. Heat the vegetable oil in a deep, thick-bottomed pan on medium heat. Add the bay leaves, cloves, cardamom, and peppercorns and sauté until slightly darker and mildly fragrant. Add the remaining sliced onion and fry until light golden in color. Add the onion-tomato paste you made earlier and fry till the oil begins to separate from the paste. Add the dry, powdered spices—cumin, coriander, red chili, turmeric, and garam masala powders. Sauté, stirring frequently, for 5 more minutes. Drain the water in the can from the chickpeas and rinse them well under running water. Now add the chickpeas to the masala you fried up earlier. Stir to mix everything well. Add salt to taste and enough hot water to make the gravy—about 1 1/2 cups. Simmer and cook covered for 10 minutes. Use a flat spoon or potato masher to mash some of the chickpeas coarsely. Stir to mix everything well. Garnish with juliennes of ginger and finely chopped fresh coriander leaves. A squeeze of lemon and a handful of very finely chopped onion tastes great as a garnish too.', '01:00:00', 3, 'a.jpg', 'A', '2019-01-27 05:34:50', NULL),
(22, 5, 'Spicy Pork and Kimchi Stirfry', '310', '    In a bowl, add 1-4 tbsps of gochujang depending on how you want your level of spiciness. Make up any difference with 1-4 tbsps of soy sauce. For example, if you prefer a mild taste, add 2 tbsps of gochujang and 2 tbsps of soy sauce but the total combination should not be more than 4 tbsps. Add sesame oil, minced garlic, ginger juice or powder, sugar and pinch of black ground pepper. If desired, add 2 tbsps of red pepper flakes to make it spicier. Mix all ingredients well and put aside for later use. For pork loins, use a meat tenderizer and lightly beat on meat until they are become very thin. Cut into desired, bite sized pieces thereafter. For pork bellies, cut thin strips into bite size pieces. Add pork meat to the bowl of sauce that was prepared earlier and thoroughly marinate meat. Optimal time for meat to marinate is 30 minutes put aside to prepare vegetables. Cut onion and carrot into thin strips, and cut green onion diagonally. Bell pepper and jalapeños are optional. In a large pan, stir-fry pork for about 4-5 minutes in med-high heat. Add kimchi along with vegetables into mix. Cook until pork is thoroughly cooked. To prepare tofu, boil water in pot and add entire block of tofu for 3-5 minutes in hot water. Rinse with cool water and cut them into smaller, bite-sized \"blocks.\" Place pork and kimchi stirfry in middle of plate and garnish with tofu around the plate.', '01:20:00', 3, 'a.jpg', 'A', '2019-01-27 06:45:33', NULL),
(23, 5, 'Dae-ji Bul-go-gi', '180', 'Combine all the ingredients except pork to make its base marinating sauce. Stir in a large mixing bowl. Add the pork and marinate for 30-60 minutes. Grill or pan-fry and serve with steamed rice.\r\n', '01:05:00', 2, 'a.jpg', 'A', '2019-01-27 06:45:33', NULL),
(24, 6, 'Sukhothai Pad Thai', '260', 'To prepare Pad Thai sauce: In a medium saucepan over medium heat, blend sugar, vinegar, soy sauce and tamarind pulp. To make Pad Thai: Soak rice noodles in cold water until soft; drain. In a large skillet or wok over medium heat, warm oil and add garlic and eggs; scramble the eggs. Add tofu and stir until well mixed; add noodles and stir until cooked. Stir in Pad Thai sauce, 1 1/2 tablespoons sugar and 1 1/2 teaspoons salt. Stir in peanuts and ground radish. Remove from heat and add chives and paprika. Serve with lime and bean sprouts on the side.', '00:30:00', 8, 'a.jpg', 'A', '2019-01-27 06:53:16', NULL),
(25, 6, 'Thai Chicken with Basil Stir Fry', '330', 'Bring rice and water to a boil in a pot. Cover, reduce heat to low, and simmer 20 minutes. In a bowl, mix the coconut milk, soy sauce, rice wine vinegar, fish sauce, and red pepper flakes. In a skillet or wok, heat the oil over medium-high heat. Stir in the onion, ginger, and garlic, and cook until lightly browned. Mix in chicken strips, and cook about 3 minutes, until browned. Stir in the coconut milk sauce. Continue cooking until sauce is reduced be about 1/3. Mix in mushrooms, green onions, and basil, and cook until heated through. Serve over the cooked rice.', '00:35:00', 6, 'a.jpg', 'A', '2019-01-27 06:53:16', NULL),
(26, 6, 'Spicy Basil Chicken', '290', 'Heat the oil in a skillet over medium-high heat, and cook the garlic and chile peppers until golden brown. Mix in chicken and sugar, and season with garlic salt and pepper. Cook until chicken is no longer pink, but not done. Stir oyster sauce into the skillet. Mix in mushrooms and onions, and continue cooking until onions are tender and chicken juices run clear. Remove from heat, and mix in basil. Let sit 2 minutes before serving.', '00:30:00', 4, 'a.jpg', 'A', '2019-01-27 06:55:36', NULL),
(27, 8, 'Lamb kleftiko', '680', 'Crush together the garlic cloves and 1 tsp salt using a pestle and mortar. Add the herbs, lemon zest, cinnamon, some black pepper, crush a little more, then stir through 2 tbsp of the olive oil. Using a sharp knife, create lots of holes all over the lamb, and rub in the paste, pushing it deep into the holes. Transfer the lamb to a large food bag, pour in the lemon juice and marinate overnight. The next day, take the lamb out of the fridge 1 hr before you want to cook it. Heat oven to 160C/140C fan/gas 3. Lay 2 long pieces of baking parchment on top of 2 long pieces of foil – one widthways, the other lengthways to form a cross. Pop the potatoes in the centre of the parchment and toss with the remaining oil and some seasoning. Bring up the sides of the foil, then pour the marinade from the lamb over the potatoes and throw in the bay leaves.  \r\nSet the lamb on top of the potatoes and scrunch the foil together tightly to completely enclose the lamb. Lift into a roasting tin and roast in the oven for 4½ hrs until very tender. Remove tin from the oven and increase the temperature to 220C/200C fan/gas 7. Unwrap the parcel and scrunch the foil and parchment under the rim of the tin, baste the lamb with the juices and return to the oven for a further 20 mins until browned. Remove the lamb from the tin, wrap in foil and rest. Turn the potatoes over and return to the oven for 30 mins, then season with salt. While the potatoes are cooking, stir together all the ingredients for the yogurt. Combine the red wine vinegar, oil and some seasoning to make a dressing for the salad. Toss together the remaining salad ingredients, adding the dressing when you’re ready to eat. Serve the lamb with the potatoes and meaty juices, with the salad and yogurt on the side.', '05:20:00', 6, 'a.jpg', 'A', '2019-01-27 07:04:28', NULL),
(28, 8, 'Greek-style roast fish', '300', 'Heat oven to 200C/180C fan/gas 6. Tip the potatoes, onion, garlic, oregano and olive oil into a roasting tin, season, then mix together with your hands to coat everything in the oil. Roast for 15 mins, turn everything over and bake for 15 mins more. Add the lemon and tomatoes, and roast for 10 mins, then top with the fish fillets and cook for 10 mins more. Serve with parsley scattered over.', '00:50:00', 2, 'a.jpg', 'I', '2019-01-27 07:04:28', NULL),
(29, 8, 'Lamb burgers with tzatziki', '150', 'Tip the bulghar into a pan, cover with water and boil for 10 mins. Drain really well in a sieve, pressing out any excess water. To make the tzatziki, squeeze and discard the juice from the cucumber, then mix into the yogurt with the chopped mint and a little salt. Work the bulghar into the lamb with the spices, garlic (if using) and seasoning, then shape into 4 burgers. Brush with a little oil and fry or barbecue for about 5 mins each side until cooked all the way through. Serve in the buns (toasted if you like) with the tzatziki, tomatoes, onion and a few mint leaves.', '00:25:00', 4, 'a.jpg', 'A', '2019-01-27 07:04:28', NULL),
(30, 11, 'Paella', '220', 'In a medium bowl, mix together 2 tablespoons olive oil, paprika, oregano, and salt and pepper. Stir in chicken pieces to coat. Cover, and refrigerate.  Heat 2 tablespoons olive oil in a large skillet or paella pan over medium heat. Stir in garlic, red pepper flakes, and rice. Cook, stirring, to coat rice with oil, about 3 minutes. Stir in saffron threads, bay leaf, parsley, chicken stock, and lemon zest. Bring to a boil, cover, and reduce heat to medium low. Simmer 20 minutes. Meanwhile, heat 2 tablespoons olive oil in a separate skillet over medium heat. Stir in marinated chicken and onion; cook 5 minutes. Stir in bell pepper and sausage; cook 5 minutes. Stir in shrimp; cook, turning the shrimp, until both sides are pink. Spread rice mixture onto a serving tray. Top with meat and seafood mixture.', '01:00:00', 8, 'a.jpg', 'A', '2019-01-27 07:12:06', NULL),
(31, 11, 'Fried Empanadas', '365', '1.	In a medium bowl, stir together the flour and salt. Cut in shortening using a pastry blender, or pinching into small pieces using your fingers, until the mixture resembles coarse crumbs. Use a fork to stir in water a few tablespoons at a time, until the mixture forms a ball. Pat into a ball, and flatten slightly. Wrap in plastic wrap and refrigerate for 1 hour. Heat the oil in a large skillet over medium heat. Add the onion and cook until tender. Crumble in the beef, and season with salt, paprika, cumin and black pepper. Cook, stirring frequently, until beef is browned. Drain excess grease, and stir in the raisins and vinegar. Refrigerate until chilled, then stir in the hard-cooked eggs. Form the dough into 2 inch balls. On a floured surface, roll each ball out into a thin circle. Spoon some of the meat mixture onto the center, then fold into half-moon shapes. Seal edges by pressing with your fingers. Heat oil in a deep-fryer to 365 degrees F (180 degrees C). Place one or two pies into the fryer at a time. Cook for about 5 minutes, turning once to brown on both sides. Drain on paper towels, and serve hot.', '02:20:00', 24, 'a.jpg', 'A', '2019-01-27 07:12:06', NULL),
(32, 11, 'Beef Tenderloin Asturias', '420', 'Heat olive oil in a large skillet over medium-high heat until smoking. Season steaks to taste with salt and pepper, then sear on both sides in hot oil. Reduce heat to medium and continue cooking until steaks reach desired doneness, about 6 minutes for medium-rare. Remove steaks from skillet and keep warm. Stir in minced onion and cook until softened and translucent, about 5 minutes. Season with paprika and cook for an additional minute. Increase heat to medium-high, then pour in wine. Simmer until the wine has reduced by half, then add the beef broth, return to a simmer, and cook for 2 minutes. Stir in the crumbled blue cheese until just melted. To serve, pour the sauce over the steaks and sprinkle with chopped parsley. ', '00:35:00', 4, 'a.jpg', 'A', '2019-01-27 07:12:06', NULL),
(33, 9, 'Chicken Parmesan', '400', 'Combine breadcrumbs, flour, and ground red pepper in a small bowl, and set aside. Place chicken between two sheets of heavy-duty plastic wrap, and flatten to 1/4-inch thickness, using a meat mallet or rolling pin. Dip 1 chicken breast in egg whites, and coat with breadcrumb mixture. Dip again in egg mixture, and coat again in breadcrumb mixture. Repeat procedure with remaining chicken breast. Cook chicken in hot oil over medium heat 2 to 3 minutes on each side or until done. Place chicken breasts in a single layer in a lightly greased 8-inch square baking dish. Top evenly with Tomato Sauce and cheeses. Bake at 350° for 20 minutes or until cheeses melt.', '00:36:00', 2, 'a.jpg', 'A', '2019-01-27 07:17:19', NULL),
(34, 9, 'Spaghetti with Pork Bolognese', '500', 'Heat olive oil in a large Dutch oven over medium heat. Add onion, carrot, celery, garlic, 1/4 teaspoon salt, and bay leaf to pan; cook 8 minutes or until vegetables are tender, stirring occasionally. Increase heat to medium-high. Add ground pork tenderloin, ground pork, pancetta, and 1/4 teaspoon salt; sauté 8 minutes or until pork loses its pink color. Stir in tomato paste; cook 1 minute. Add tomato and next 5 ingredients (through rind); bring to a boil. Reduce heat, and simmer 45 minutes. Add cinnamon; simmer 30 minutes or until most of liquid evaporates. Discard bay leaf, rind, and cinnamon stick; stir in remaining 1/2 teaspoon salt and pepper. Arrange 1 cup noodles on each of 8 plates; top each with about 3/4 cup sauce. Sprinkle each serving with 1 tablespoon grated cheese and 1 tablespoon parsley.', '01:20:00', 8, 'a.jpg', 'A', '2019-01-27 07:17:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `id` int(10) NOT NULL,
  `ingredient_id` int(10) DEFAULT NULL,
  `recipe_id` int(10) DEFAULT NULL,
  `ingredient_amount` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`id`, `ingredient_id`, `recipe_id`, `ingredient_amount`) VALUES
(1, 4, 1, '1'),
(2, 2, 2, '11'),
(3, 3, 3, '12'),
(16, 16, 1, '3'),
(17, 17, 1, '50'),
(18, 18, 1, '27'),
(19, 19, 1, '100'),
(20, 20, 1, '200'),
(21, 21, 1, '200'),
(22, 22, 1, '1'),
(23, 15, 2, '5'),
(24, 23, 2, '0.1'),
(25, 11, 2, '110'),
(26, 24, 1, '1'),
(27, 3, 1, '10'),
(28, 28, 1, '0.1'),
(29, 1, 2, '1'),
(30, 25, 2, '80'),
(31, 3, 2, '10'),
(32, 29, 2, '0.02'),
(33, 24, 2, '0.08'),
(34, 27, 2, '35'),
(35, 14, 2, '20'),
(36, 1, 16, '0.2'),
(37, 30, 16, '100'),
(38, 31, 16, '5'),
(39, 32, 16, '5'),
(40, 2, 16, '25'),
(41, 8, 16, '100'),
(42, 14, 16, '10'),
(43, 15, 16, '20'),
(44, 12, 17, '200'),
(45, 14, 17, '120'),
(46, 26, 17, '0.2'),
(47, 2, 17, '80'),
(48, 21, 17, '20'),
(49, 11, 17, '200'),
(50, 23, 17, '0.1'),
(51, 33, 17, '200'),
(52, 3, 17, '90'),
(53, 34, 18, '1000'),
(54, 31, 18, '20'),
(55, 36, 18, '10'),
(56, 35, 18, '20'),
(57, 2, 18, '15'),
(58, 21, 18, '8'),
(59, 3, 18, '5'),
(60, 33, 18, '20'),
(61, 32, 18, '10'),
(62, 1, 19, '1.3'),
(63, 37, 19, '40'),
(64, 2, 19, '10'),
(65, 30, 19, '10'),
(66, 14, 19, '10'),
(67, 18, 19, '0.1'),
(68, 3, 19, '20'),
(69, 38, 20, '1.2'),
(70, 30, 20, '35'),
(71, 18, 20, '0.3'),
(72, 39, 20, '10'),
(73, 40, 20, '8'),
(74, 41, 20, '12'),
(75, 15, 20, '5'),
(76, 3, 20, '20'),
(77, 2, 20, '12'),
(78, 21, 20, '15'),
(79, 32, 20, '10'),
(80, 3, 21, '40'),
(81, 11, 21, '20'),
(82, 21, 21, '10'),
(83, 42, 21, '200'),
(84, 2, 21, '10'),
(85, 18, 21, '0.1'),
(86, 31, 21, '20'),
(87, 41, 21, '20'),
(88, 32, 21, '5'),
(89, 40, 21, '10'),
(90, 14, 21, '10'),
(91, 44, 3, '20'),
(92, 43, 3, '0.3'),
(93, 17, 3, '0.1'),
(94, 19, 3, '50'),
(95, 28, 3, '0.1'),
(96, 45, 3, '1.5'),
(97, 46, 3, '3'),
(98, 49, 4, '300'),
(99, 48, 4, '20'),
(100, 47, 4, '80'),
(101, 29, 4, '0.2'),
(102, 17, 4, '100'),
(103, 1, 5, '1'),
(104, 4, 5, '1'),
(105, 29, 5, '0.1'),
(106, 3, 5, '20'),
(107, 2, 5, '10'),
(108, 17, 5, '200'),
(109, 23, 5, '0.1'),
(110, 14, 5, '20'),
(111, 15, 5, '20'),
(112, 4, 6, '2.5'),
(113, 17, 6, '100'),
(114, 23, 6, '0.1'),
(115, 15, 6, '10'),
(116, 19, 6, '40'),
(117, 2, 6, '20'),
(118, 31, 6, '10'),
(119, 51, 6, '20'),
(120, 50, 6, '20'),
(121, 18, 6, '0.1'),
(122, 4, 13, '2'),
(123, 11, 13, '20'),
(124, 3, 13, '20'),
(125, 52, 13, '20'),
(126, 53, 13, '15'),
(127, 54, 13, '40'),
(128, 55, 13, '30'),
(129, 56, 13, '10'),
(130, 14, 13, '10'),
(131, 15, 13, '10'),
(132, 17, 22, '80'),
(133, 2, 22, '10'),
(134, 18, 22, '0.1'),
(135, 21, 22, '10'),
(136, 19, 22, '10'),
(137, 15, 22, '5'),
(138, 34, 22, '80'),
(139, 4, 22, '1'),
(140, 57, 22, '100'),
(141, 3, 22, '10'),
(142, 9, 22, '20'),
(143, 4, 23, '1'),
(144, 17, 23, '60'),
(145, 2, 23, '10'),
(146, 21, 23, '10'),
(147, 19, 23, '20'),
(148, 3, 23, '15'),
(149, 18, 23, '0.1'),
(150, 43, 23, '0.1'),
(151, 19, 24, '90'),
(152, 23, 24, '0.1'),
(153, 17, 24, '100'),
(154, 56, 24, '20'),
(155, 60, 24, '100'),
(156, 29, 24, '0.1'),
(157, 2, 24, '10'),
(158, 58, 24, '4'),
(159, 34, 24, '10'),
(160, 14, 24, '10'),
(161, 53, 24, '20'),
(162, 54, 24, '20'),
(163, 59, 24, '10'),
(164, 61, 25, '20'),
(165, 19, 25, '20'),
(166, 28, 25, '0.1'),
(167, 2, 25, '10'),
(168, 1, 25, '1'),
(169, 5, 25, '20'),
(170, 21, 25, '10'),
(171, 26, 26, '0.4'),
(172, 2, 26, '10'),
(173, 31, 26, '10'),
(174, 19, 26, '20'),
(175, 1, 26, '1.3'),
(176, 14, 26, '18'),
(177, 15, 26, '10'),
(178, 3, 26, '10'),
(179, 51, 26, '100'),
(180, 32, 26, '5'),
(181, 62, 26, '12'),
(182, 1, 9, '1'),
(183, 63, 9, '10'),
(184, 64, 9, '40'),
(185, 2, 27, '10'),
(186, 67, 27, '15'),
(187, 65, 27, '2'),
(188, 39, 27, '23'),
(189, 18, 27, '0.3'),
(190, 38, 27, '2'),
(191, 8, 27, '40'),
(192, 66, 27, '30'),
(193, 69, 29, '25'),
(194, 38, 29, '0.5'),
(195, 41, 29, '10'),
(196, 32, 29, '10'),
(197, 59, 29, '10'),
(198, 2, 29, '10'),
(199, 29, 29, '0.1'),
(200, 68, 29, '10'),
(201, 30, 29, '20'),
(202, 70, 29, '20'),
(203, 71, 33, '20'),
(204, 73, 33, '10'),
(205, 15, 33, '5'),
(206, 1, 33, '1'),
(207, 58, 33, '2'),
(208, 18, 33, '0.1'),
(209, 11, 33, '30'),
(210, 72, 33, '15'),
(211, 18, 34, '0.4'),
(212, 3, 34, '20'),
(213, 9, 34, '15'),
(214, 2, 34, '10'),
(215, 14, 34, '10'),
(216, 66, 34, '20'),
(217, 4, 34, '1'),
(218, 11, 34, '30'),
(219, 43, 34, '0.1'),
(220, 39, 34, '20'),
(221, 15, 34, '10'),
(222, 60, 34, '1000'),
(223, 74, 34, '12'),
(224, 75, 30, '0.2'),
(225, 59, 30, '20'),
(226, 67, 30, '30'),
(227, 14, 30, '10'),
(228, 15, 30, '10'),
(229, 1, 30, '1.3'),
(230, 2, 30, '10'),
(231, 76, 30, '0.2'),
(232, 66, 30, '10'),
(233, 3, 30, '12'),
(234, 77, 30, '600'),
(235, 78, 30, '600'),
(236, 65, 30, '2'),
(237, 47, 31, '200'),
(238, 14, 31, '10'),
(239, 3, 31, '20'),
(240, 75, 31, '0.1'),
(241, 7, 31, '1'),
(242, 59, 31, '10'),
(243, 41, 31, '10'),
(244, 15, 31, '5'),
(245, 23, 31, '0.1'),
(246, 58, 31, '2'),
(247, 29, 31, '0.1'),
(248, 79, 31, '50'),
(249, 75, 32, '0.25'),
(250, 7, 32, '1'),
(251, 14, 32, '10'),
(252, 15, 32, '10'),
(253, 3, 32, '10'),
(254, 59, 32, '10'),
(255, 80, 32, '0.25'),
(256, 81, 32, '5'),
(257, 72, 32, '20'),
(258, 3, 11, '20'),
(259, 2, 11, '10'),
(260, 1, 11, '1'),
(261, 41, 11, '10'),
(262, 29, 11, '0.2'),
(263, 14, 11, '10'),
(264, 15, 11, '5'),
(265, 53, 11, '8'),
(266, 82, 11, '60'),
(267, 83, 11, '80'),
(268, 75, 12, '0.2'),
(269, 3, 12, '10'),
(270, 6, 12, '15'),
(271, 31, 12, '10'),
(272, 2, 12, '10'),
(273, 67, 12, '14'),
(274, 14, 12, '5'),
(275, 15, 12, '5'),
(276, 11, 12, '100'),
(277, 58, 12, '8'),
(278, 27, 12, '5'),
(279, 84, 7, '40'),
(280, 85, 7, '200'),
(281, 3, 7, '10'),
(282, 14, 7, '20'),
(283, 15, 7, '5'),
(284, 50, 7, '20'),
(285, 19, 7, '35'),
(286, 75, 8, '0.1'),
(287, 3, 8, '10'),
(288, 87, 8, '1'),
(289, 2, 8, '10'),
(290, 31, 8, '10'),
(291, 14, 8, '10'),
(292, 41, 8, '5'),
(293, 58, 8, '2'),
(294, 86, 8, '150'),
(295, 50, 8, '100'),
(296, 71, 8, '200'),
(297, 85, 8, '250'),
(298, 1, 8, '0.25'),
(299, 4, 8, '0.25'),
(300, 38, 8, '0.25'),
(301, 7, 8, '0.5');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `transaction` (
  `id` int(10) NOT NULL,
  `order_id` int(10) DEFAULT NULL,
  `total_cost` varchar(50) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `unit` (
  `id` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `name`) VALUES
(1, 'Kilos'),
(2, 'Grams'),
(3, 'Liters'),
(4, 'mililiters'),
(5, 'Piece/s');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `user_type_id` int(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `logged_in` varchar(5) DEFAULT '0',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_type_id`, `username`, `password`, `status`, `logged_in`, `created_date`, `updated_date`) VALUES
(1, 1, 'admin01', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '1', '2018-11-28 15:02:22', '2019-01-16 20:30:11'),
(2, 2, 'manager01', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:25', '2019-01-16 20:28:47'),
(3, 2, 'manager02', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:31', '2019-01-16 20:29:26'),
(4, 2, 'manager03', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:37', '2018-11-28 15:02:37'),
(5, 2, 'manager04', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:59', '2018-11-28 15:02:59'),
(6, 2, 'manager05', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:03:03', '2018-11-28 15:03:03'),
(7, 3, 'customer01', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'A', '0', '2018-11-28 15:02:05', '2019-01-21 11:48:20'),
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

CREATE TABLE `user_activity` (
  `id` int(10) NOT NULL,
  `recipe_id` int(10) DEFAULT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `activity_type_id` int(10) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `user_type` (
  `id` int(10) NOT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(1, 'Administrator'),
(2, 'Branch Manager'),
(3, 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_type`
--
ALTER TABLE `activity_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_ingredient`
--
ALTER TABLE `add_ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_ingredients`
--
ALTER TABLE `branch_ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_manager`
--
ALTER TABLE `branch_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_reports`
--
ALTER TABLE `branch_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_content`
--
ALTER TABLE `order_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_type`
--
ALTER TABLE `activity_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `add_ingredient`
--
ALTER TABLE `add_ingredient`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `branch_ingredients`
--
ALTER TABLE `branch_ingredients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `branch_manager`
--
ALTER TABLE `branch_manager`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `branch_reports`
--
ALTER TABLE `branch_reports`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `order_content`
--
ALTER TABLE `order_content`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
