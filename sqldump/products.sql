-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 20, 2020 at 10:38 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `description`, `price`, `quantity`) VALUES
(48, 'test', 'test', 1, 2),
(47, 'test222', 'test2222', 3, 2),
(46, 'test222', 'test2222', 2, 2),
(45, 'test', 'test', 2, 2),
(32, 'test', 'test', 50, 50),
(31, 'test', 'test', 2, 2),
(30, 'product', 'description', 2, 2),
(29, 'Max', 'description', 4, 1),
(44, 'test', 'test', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `image_id` int(10) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(100) NOT NULL,
  `product_id` int(10) NOT NULL,
  `insert_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `image_name`, `product_id`, `insert_time`) VALUES
(1, 'images/1.jpg', 26, '2020-05-19 11:05:06'),
(2, 'images/1589804885.jpg', 27, '2020-05-19 11:05:06'),
(25, 'images/15899623925464.jpg', 47, '2020-05-20 08:13:12'),
(4, 'images/1589805312.jpg', 29, '2020-05-19 11:05:06'),
(5, 'images/1589815926.jpg', 30, '2020-05-19 11:05:06'),
(6, 'images/0.91838600 1589816065.jpg', 31, '2020-05-19 11:05:06'),
(7, 'images/357.jpg', 32, '2020-05-19 11:05:06'),
(24, 'images/15899276662010.jpg', 46, '2020-05-19 22:34:26'),
(9, 'images/15898163964488.jpg', 34, '2020-05-19 11:05:06'),
(10, 'images/15898164248285.jpg', 35, '2020-05-19 11:05:06'),
(11, 'images/15898173367163.jpg', 36, '2020-05-19 11:05:06'),
(12, 'images/15898173367167.jpg', 36, '2020-05-19 11:05:06'),
(13, 'images/15898206693662.jpg', 37, '2020-05-19 11:05:06'),
(14, 'images/15898869319241.jpg', 41, '2020-05-19 11:15:31'),
(15, '', 42, '2020-05-19 20:28:16'),
(23, 'images/15899276661995.jpg', 46, '2020-05-19 22:34:26'),
(22, 'images/15899265760717.jpg', 45, '2020-05-19 22:16:16'),
(26, 'images/15899623925470.jpg', 47, '2020-05-20 08:13:12'),
(27, 'images/15899668673244.jpg', 47, '2020-05-20 09:27:47'),
(28, 'images/15899683809093.jpg', 48, '2020-05-20 09:53:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
