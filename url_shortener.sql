-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 17, 2020 at 08:39 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `url_shortener`
--

-- --------------------------------------------------------

--
-- Table structure for table `short_url`
--

DROP TABLE IF EXISTS `short_url`;
CREATE TABLE IF NOT EXISTS `short_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `long_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shortened_url` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `click_counter` int(11) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `short_url`
--

INSERT INTO `short_url` (`id`, `long_url`, `shortened_url`, `click_counter`, `time`) VALUES
(57, 'https://www.google.com', '26c1b', 0, '2020-08-17 20:35:45'),
(55, 'https://www.youtube.com', '324b0', 1, '2020-08-17 20:01:56'),
(56, 'https://www.ebay.com', '496d1', 0, '2020-08-17 20:12:50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
