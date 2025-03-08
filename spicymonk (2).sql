-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 07, 2025 at 02:28 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spicymonk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_email`, `admin_password`) VALUES
('abhijit@gmail.com', 'abhi879687@');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `quantity` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `email`, `title`, `quantity`) VALUES
(42, 'abhijit@gmail.com', 'Green lemonade', 10),
(43, 'abhijit@gmail.com', 'Orange Olif', 5),
(46, 'abhijit@gmail.com', 'Spicy O\'tel saga', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart_status`
--

DROP TABLE IF EXISTS `cart_status`;
CREATE TABLE IF NOT EXISTS `cart_status` (
  `id` int NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_status`
--

INSERT INTO `cart_status` (`id`, `status`) VALUES
(1, 'open');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `description`) VALUES
(1, 'All Menus', 'Represents all menus provided'),
(2, 'Burgers', 'Burger category consists with 100% delight taste'),
(3, 'Pizza', 'Pizza\'s that sure your taste to next level'),
(4, 'Noodles', 'Noodles that make you taste better'),
(5, 'Pasta', 'Pasta that makes your taste better'),
(6, 'Bowls', 'Spicy variety of category bowls'),
(7, 'Beverages', 'Make your thrust peaceful with Beverages'),
(8, 'Desserts', 'Sweet touch to cravings'),
(22, 'Fish', 'Experience the taste of Ocean');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `name`, `email`, `phone`, `message`) VALUES
(1, 'Abhijit Tikone', 'abhijit@gmail.com', 8796873220, 'Nice service! Happy with the food'),
(2, 'Sanket', 'sanket@gmail.com', 768764534, 'Nice service, hope taste remains same!'),
(3, 'Sanket', 'sanket@gmail.com', 768764534, 'Nice service, hope taste remains same!');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`ID`, `title`, `stock`) VALUES
(1, 'Spicy O\'tel saga', 19),
(2, 'Spicy Noodles', 14),
(3, 'Spicy Hunger\' Bowl', 19),
(4, 'Green lemonade', 20),
(5, 'Orange Olif', 19),
(6, 'Lemonade Rush', 19),
(7, 'Spicy Red O\' Nod', 20),
(8, 'Asian Noodles', 18),
(9, 'Korean Spicy Stew', 3),
(10, 'Spicy O\'il Haka', 16),
(11, 'Red Souce Noodles', 19),
(12, 'Spaghetti Aglio e Olio', 19),
(16, 'Fish', 20);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `id` int NOT NULL,
  `location_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location_name`) VALUES
(1, 'copa villa, pune, maharashtra');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `amount` int NOT NULL,
  `contact` varchar(15) NOT NULL,
  `order_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `email`, `username`, `title`, `quantity`, `amount`, `contact`, `order_date`) VALUES
(11, 'ODD0498585', 'abhijit@gmail.com', 'abhijit', 'Spicy Noodles', 1, 1379, '8796873220', '2025-02-21 20:19:13'),
(12, 'ODD0498585', 'abhijit@gmail.com', 'abhijit', 'Spicy Hunger\' Bowl', 2, 1379, '8796873220', '2025-02-21 20:19:13'),
(13, 'ODD0498585', 'abhijit@gmail.com', 'abhijit', 'Spicy O\'tel saga', 1, 1379, '8796873220', '2025-02-21 20:19:13'),
(14, 'ODD0675669', 'abhijit@gmail.com', 'abhijit', 'Green lemonade', 3, 299, '8796873220', '2025-02-21 20:51:31'),
(15, 'ODD0196809', 'abhijit@gmail.com', 'abhijit', 'Spicy Red O\' Nod', 1, 691, '8796873220', '2025-02-21 20:52:11'),
(16, 'ODD0196809', 'abhijit@gmail.com', 'abhijit', 'Spicy O\'il Haka', 2, 691, '8796873220', '2025-02-21 20:52:11'),
(17, 'ODD0948025', 'abhijit@gmail.com', 'abhijit', 'Spicy Noodles', 6, 998, '8796873220', '2025-02-21 21:31:11'),
(18, 'ODD0948025', 'abhijit@gmail.com', 'abhijit', 'Green lemonade', 10, 998, '8796873220', '2025-02-21 21:31:11'),
(19, 'ODD0495435', 'abhijit@gmail.com', 'abhijit', 'Spicy Noodles', 2, 703, '8796873220', '2025-02-21 21:47:32'),
(20, 'ODD0625795', 'abhijit@gmail.com', 'abhijit', 'Spicy O\'tel saga', 35, 10695, '8796873220', '2025-02-21 22:43:24'),
(21, 'ODD0625795', 'abhijit@gmail.com', 'abhijit', 'Spicy Noodles', 6, 10695, '8796873220', '2025-02-21 22:43:24'),
(22, 'ODD0978078', 'ajinkya@gmail.com', 'ajinkya', 'Spicy O\'tel saga', 6, 4174, '7685764534', '2025-02-22 02:26:14'),
(23, 'ODD0978078', 'ajinkya@gmail.com', 'ajinkya', 'Orange Olif', 10, 4174, '7685764534', '2025-02-22 02:26:14'),
(24, 'ODD0978078', 'ajinkya@gmail.com', 'ajinkya', 'Green lemonade', 1, 4174, '7685764534', '2025-02-22 02:26:14'),
(25, 'ODD0978078', 'ajinkya@gmail.com', 'ajinkya', 'Lemonade Rush', 3, 4174, '7685764534', '2025-02-22 02:26:14'),
(26, 'ODD0978078', 'ajinkya@gmail.com', 'ajinkya', 'Spicy Noodles', 2, 4174, '7685764534', '2025-02-22 02:26:14'),
(27, 'ODD0978078', 'ajinkya@gmail.com', 'ajinkya', 'Spicy Hunger\' Bowl', 1, 4174, '7685764534', '2025-02-22 02:26:14'),
(28, 'ODD0620804', 'ajinkya@gmail.com', 'ajinkya', 'Spicy Noodles', 2, 814, '7685764534', '2025-02-22 05:42:30'),
(29, 'ODD0620804', 'ajinkya@gmail.com', 'ajinkya', 'Orange Olif', 1, 814, '7685764534', '2025-02-22 05:42:30'),
(30, 'ODD0968662', 'ajinkya@gmail.com', 'ajinkya', 'Green lemonade', 1, 100, '7685764534', '2025-02-22 05:49:23'),
(31, 'ODD0318793', 'ajinkya@gmail.com', 'ajinkya', 'Spicy Noodles', 1, 597, '7685764534', '2025-02-22 05:56:13'),
(32, 'ODD0318793', 'ajinkya@gmail.com', 'ajinkya', 'Spicy O\'tel saga', 1, 597, '7685764534', '2025-02-22 05:56:13'),
(33, 'ODD0839286', 'ajinkya@gmail.com', 'ajinkya', 'Spicy O\'tel saga', 14, 3434, '7685764534', '2025-02-22 13:22:13'),
(34, 'ODD0119273', 'ajinkya@gmail.com', 'ajinkya', 'Asian Noodles', 2, 1194, '7685764534', '2025-02-23 07:06:31'),
(35, 'ODD0119273', 'ajinkya@gmail.com', 'ajinkya', 'Korean Spicy Stew', 1, 1194, '7685764534', '2025-02-23 07:06:31'),
(36, 'ODD0119273', 'ajinkya@gmail.com', 'ajinkya', 'Spicy Red O\' Nod', 1, 1194, '7685764534', '2025-02-23 07:06:31'),
(37, 'ODD0384333', 'ajinkya@gmail.com', 'ajinkya', 'Spicy Noodles', 7, 3128, '7685764534', '2025-02-24 04:34:07'),
(38, 'ODD0384333', 'ajinkya@gmail.com', 'ajinkya', 'Lemonade Rush', 5, 3128, '7685764534', '2025-02-24 04:34:07'),
(39, 'oddtest', 'ajinkya@gmail.com', 'ajinkya', 'Spicy noodles', 1, 219, '8796874367', '2025-02-24 19:18:28'),
(40, 'ODD0839546', 'ajinkya@gmail.com', 'ajinkya', 'Spicy Noodles', 1, 352, '7685764534', '2025-02-24 19:41:37'),
(48, 'ODD0554481', 'ajinkya@gmail.com', 'ajinkya', 'Spicy Hunger\' Bowl', 3, 1173, '7685764534', '2025-02-24 20:04:13'),
(49, 'ODD0780286', 'ajinkya@gmail.com', 'ajinkya', 'Spicy O\'tel saga', 1, 245, '7685764534', '2025-02-24 20:07:14'),
(50, 'ODD0462931', 'ajinkya@gmail.com', 'ajinkya', 'Orange Olif', 1, 111, '7685764534', '2025-02-24 20:08:19'),
(51, 'ODD0130290', 'ajinkya@gmail.com', 'ajinkya', 'Korean Spicy Stew', 1, 368, '7685764534', '2025-02-24 20:10:25'),
(52, 'ODD0828375', 'ajinkya@gmail.com', 'ajinkya', 'Korean Spicy Stew', 4, 1474, '7685764534', '2025-02-24 20:54:42'),
(53, 'ODD0468772', 'ajinkya@gmail.com', 'ajinkya', 'Asian Noodles', 2, 558, '7685764534', '2025-02-24 21:53:22'),
(54, 'ODD0256727', 'sujal@gmail.com', 'sujal99', 'Spicy Noodles', 1, 352, '6789879876', '2025-02-25 14:54:55'),
(55, 'ODD0239229', 'sujal@gmail.com', 'sujal99', 'Spicy O\'tel saga', 1, 245, '6789879876', '2025-02-25 15:33:11'),
(56, 'ODD0339050', 'ajinkya@gmail.com', 'ajinkya', 'Spicy O\'il Haka', 4, 1198, '7685764534', '2025-03-01 16:18:10'),
(57, 'ODD0339050', 'ajinkya@gmail.com', 'ajinkya', 'Spicy Noodles', 1, 1198, '7685764534', '2025-03-01 16:18:10'),
(58, 'ODD0861572', 'ajinkya@gmail.com', 'ajinkya', 'Spaghetti Aglio e Olio', 1, 256, '7685764534', '2025-03-01 16:19:24'),
(59, 'ODD0286400', 'ajinkya@gmail.com', 'ajinkya', 'Spicy Noodles', 4, 1798, '7685764534', '2025-03-03 13:34:26'),
(60, 'ODD0286400', 'ajinkya@gmail.com', 'ajinkya', 'Spicy Hunger\' Bowl', 1, 1798, '7685764534', '2025-03-03 13:34:26'),
(61, 'ODD0898424', 'shiv@gmail.com', 'shiv99', 'Orange Olif', 1, 111, '6754675643', '2025-03-03 13:43:49'),
(62, 'ODD0476601', 'ajinkya@gmail.com', 'ajinkya', 'Red Souce Noodles', 1, 391, '7685764531', '2025-03-03 14:05:34'),
(63, 'ODD0617910', 'sanket@gmail.com', 'sanket99', 'Lemonade Rush', 1, 133, '7685764356', '2025-03-03 14:11:24');

--
-- Triggers `orders`
--
DROP TRIGGER IF EXISTS `after_order_insert`;
DELIMITER $$
CREATE TRIGGER `after_order_insert` AFTER INSERT ON `orders` FOR EACH ROW BEGIN
    INSERT INTO order_status (order_id, status) VALUES (NEW.id, 'Pending');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `status` enum('Pending','Done') DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `order_id`, `status`) VALUES
(1, 48, 'Done'),
(2, 49, 'Pending'),
(3, 50, 'Done'),
(4, 51, 'Done'),
(5, 52, 'Done'),
(6, 53, 'Done'),
(7, 54, 'Pending'),
(8, 55, 'Done'),
(9, 56, 'Pending'),
(10, 57, 'Pending'),
(11, 58, 'Pending'),
(12, 59, 'Done'),
(13, 60, 'Pending'),
(14, 61, 'Done'),
(15, 62, 'Pending'),
(16, 63, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) NOT NULL,
  `rating` float NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` enum('Veg','Non Veg') NOT NULL,
  `persons` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image_path`, `rating`, `title`, `description`, `type`, `persons`, `price`, `category`) VALUES
(1, 'assets/images/dish/Dish-2', 4.3, 'Spicy O\'tel saga', 'Spicy dish with sauces and greens make it more delicious and spicy 100% veg.', 'Veg', 2, 219.00, 'Burgers'),
(2, 'assets/images/dish/Dish-3', 4.9, 'Spicy Noodles', 'Spicy Noodles with green chutney serving 2 adding spicy touch to taste.', 'Veg', 2, 314.00, 'Pizza'),
(3, 'assets/images/dish/Dish-4', 4.9, 'Spicy Hunger\' Bowl', 'Spicy hunger bowl serves you best taste with 100% hygiene and ingredients', 'Non Veg', 2, 349.00, 'Bowls'),
(4, 'assets/images/dish/bev-1', 4.1, 'Green lemonade', 'Makes you chill with green healthy ingredients sure you your taste', 'Veg', 1, 89.00, 'Beverages'),
(5, 'assets/images/dish/bev-2', 4.3, 'Orange Olif', 'Taste of Oranges with hygiene ingredients makes mood fresh', 'Veg', 1, 99.00, 'Beverages'),
(6, 'assets/images/dish/bev-3', 4.9, 'Lemonade Rush', 'Yellow Lemon integration with delight taste ensures your mood', 'Veg', 1, 119.00, 'Beverages'),
(7, 'assets/images/dish/4', 4.3, 'Spicy Red O\' Nod', 'Inspired by the deep reds of chili and the warmth of handcrafted seasonings.', 'Veg', 2, 239.00, 'noodles'),
(8, 'assets/images/dish/Dish-5', 4.1, 'Asian Noodles', 'Inspired by the deep reds of chili and the warmth of handcrafted seasonings.', 'Veg', 2, 249.00, 'noodles'),
(9, 'assets/images/dish/spicy-noodles-black', 4.9, 'Korean Spicy Stew', 'Deep reds of chili and the warmth of handcrafted seasonings and flavours.', 'Non Veg', 1, 329.00, 'Bowls'),
(10, 'assets/images/dish/spicy-noodles-black', 4.1, 'Spicy O\'il Haka', 'Inspired by the chili and the warmth of handcrafted seasonings and taste touch.', 'Non Veg', 2, 189.00, 'Bowls'),
(11, 'assets/images/dish/Dish-5', 4.1, 'Red Souce Noodles', 'From the smoky wok-kissed taste of chow mein to the comforting warmth', 'Non Veg', 2, 349.00, 'noodles'),
(12, 'assets/images/dish/4', 4.3, 'Spaghetti Aglio e Olio', 'Spaghetti Aglio e Olio is a classic Italian pasta dish that embraces simplicity', 'Veg', 2, 229.00, 'noodles'),
(20, 'assets/images/dish/fish-1 (1) (1).png', 4.5, 'Fish', 'feel the taste of Ocean with spice and slicee', 'Non Veg', 2, 239.00, 'Fish');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`) VALUES
(1, 'ajinkya@gmail.com'),
(4, 'atikone31@gmail.com'),
(12, 'monkeyydlufyy3121@gmail.com'),
(22, 'shinde@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `contact`) VALUES
(1, 'abhijit', 'abhijit@gmail.com', '8796873221'),
(3, 'Shivprasad', 'shiv@gmail.com', '7898098767');

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

DROP TABLE IF EXISTS `todos`;
CREATE TABLE IF NOT EXISTS `todos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `task` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `task`) VALUES
(10, 'Next target crossing sales of 1 lakh'),
(11, 'Increase marketing'),
(12, 'Abhijit is great developer'),
(13, 'Upcoming biggest site');

-- --------------------------------------------------------

--
-- Table structure for table `usernotification`
--

DROP TABLE IF EXISTS `usernotification`;
CREATE TABLE IF NOT EXISTS `usernotification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usernotification`
--

INSERT INTO `usernotification` (`id`, `email`, `message`) VALUES
(1, 'abhijit@gmail.com', 'Order is successful'),
(6, 'ajinkya@gmail.com', 'Order is ready! 🍜  ORDER ID: #ODD0130290'),
(7, 'ajinkya@gmail.com', 'Order is ready! 🍜  ORDER ID: #ODD0468772'),
(8, 'sujal@gmail.com', 'Order is ready! 🍜  ORDER ID: #ODD0239229'),
(9, 'ajinkya@gmail.com', 'Order is ready! 🍜  ORDER ID: #ODD0286400'),
(10, 'shiv@gmail.com', 'Order is ready! 🍜  ORDER ID: #ODD0898424');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`) VALUES
('user_67b93aed8855b', 'ajinkya@gmail.com', '$2y$10$a5Hq5k/xkw89q.pqwxF.VeE/FIsaB7CITRMBW.mkK0fViLVHO2yZm'),
('user_67b93fa53a9dd', 'abhijit@gmail.com', '$2y$10$FLjUAVkgAdrCIWea0.TrPuG3xLo1abUDUfeA2vq/ncrdDMgOLX4oa'),
('user_67bdd9792d5aa', 'sujal@gmail.com', '$2y$10$GyuEoFxhZvNiTFlF48OL5uOxc1wpC.k3EJBujYAHepgwWeSBfS0E2'),
('user_67c5b1ca6e7c0', 'shiv@gmail.com', '$2y$10$2OZ33JC0lA5x.FC86l8DRemF8Xr0q3d0khvk2Y0uQBCV/Xwb0f5la'),
('user_67c5b7753d071', 'sanket@gmail.com', '$2y$10$2/ciPRP8Q3sSikuk1fRUO.lpDxjepBCKDDKas0YUiAi1c3poFbT2q');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `Uaddress` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `contact` bigint NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`username`, `firstname`, `lastname`, `Uaddress`, `contact`, `email`) VALUES
('abhijit', 'Abhijit', 'Tikone', 'Punjab national bank, Kaspate Vasti, Wakad', 8796873224, 'abhijit@gmail.com'),
('ajinkya', 'ajinkya', 'mohite', 'Punjab national bank, Kaspate Vasti, Wakad', 7685764536, 'ajinkya@gmail.com'),
('sanket99', 'sanket', 'shinde', 'pimple gurav, Pune, maharashtra', 7685764351, 'sanket@gmail.com'),
('shiv99', 'shivprasad', 'suryawanshi', 'sangvi, pune, maharashtra', 6754675643, 'shiv@gmail.com'),
('sujal99', 'sujal', 'hinge', 'katraj, pune , maharashtra', 6789879876, 'sujal@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_status`
--
ALTER TABLE `order_status`
  ADD CONSTRAINT `order_status_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
