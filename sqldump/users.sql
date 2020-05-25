-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 25, 2020 at 02:14 PM
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
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(25) NOT NULL,
  `l_name` varchar(25) NOT NULL,
  `gender` int(1) NOT NULL DEFAULT 2,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `f_name`, `l_name`, `gender`, `email`, `password`, `avatar`) VALUES
(1, 'Hermine', 'Militonyan', 2, 'militonyan.hermine@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(2, 'Garegin', 'Tadevosyan', 2, 'mstvir@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(3, 'Garegin', 'Tadevosyan', 2, 'mstvir@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(4, 'test', 'test', 2, 'user1admin@test.com', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(5, 'Hermine', 'Militonyan', 2, 'militonyan.hermine@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(6, 'Hermine', 'Militonyan', 2, 'militonyan.hermine@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(7, 'user', 'user', 2, 'user@test.com', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(8, 'user', 'user', 2, 'user@test.com', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(9, 'Hermine', 'Militonyan', 2, 'hermine@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(10, 'test', 'test', 2, 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', ''),
(11, 'Hermine', 'Militonyan', 2, 'hermine_m@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', ''),
(12, 'test', 'test', 2, 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', ''),
(13, 'test3', 'test3', 2, 'test3@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'profile-pictures/15904136193093.jpg'),
(14, 'test5', 'test5', 1, 'test5@gmail.com', '098f6bcd4621d373cade4e832627b4f6', NULL),
(15, 'test6', 'test6', 0, 'test6@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'profile-pictures/15904148810841.jpg'),
(16, 'Hermine', 'Militonyan', 2, 'militonyanhermine@mail.ru', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(17, 'test', 'test', 1, 'test@mail.ru', '098f6bcd4621d373cade4e832627b4f6', 'profile-pictures/15904155402569.jpg'),
(18, 'test', 'test', 1, 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
