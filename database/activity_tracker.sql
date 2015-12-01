-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2015 at 06:37 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `activity_tracker`
--
CREATE DATABASE IF NOT EXISTS `activity_tracker` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `activity_tracker`;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `activity_name` varchar(60) DEFAULT NULL,
  `priority` varchar(30) DEFAULT NULL,
  `estimate` decimal(10,0) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `user_id`, `activity_name`, `priority`, `estimate`, `status`) VALUES
(1, 1, 'Create tracking.php start/stop', 'A1', 4, 'In Progress'),
(2, 1, 'Create tracking.php pause/resume', 'A2', 1, 'Not Started'),
(3, 1, 'Create tracking.php save/discard', 'A3', 1, 'Not Started'),
(4, 1, 'Paginate activity list page', 'A1', 2, 'Not Started'),
(5, 1, 'Update Activity page', 'B1', 1, 'Not Started');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `start_time` datetime NOT NULL,
  `elapsed_time` decimal(10,4) DEFAULT NULL,
  `confirmed` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `activity_id`, `start_time`, `elapsed_time`, `confirmed`) VALUES
(1, 1, 1, '2015-11-29 21:20:27', 0.0000, 'N'),
(2, 1, 2, '2015-11-29 21:23:25', 0.0000, 'N'),
(3, 1, 2, '2015-11-29 21:40:24', 0.0000, 'N'),
(4, 1, 1, '2015-11-29 21:40:36', 0.0000, 'N'),
(5, 1, 2, '2015-12-01 16:56:50', 0.0000, 'N'),
(6, 1, 2, '2015-12-01 17:19:33', 0.0706, 'N'),
(7, 1, 2, '2015-12-01 17:40:30', 0.0661, 'N'),
(8, 1, 2, '2015-12-01 17:50:52', 0.1617, 'Y'),
(9, 1, 1, '2015-12-01 18:05:56', 0.5056, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) DEFAULT NULL,
  `real_name` varchar(60) DEFAULT NULL,
  `email_address` varchar(60) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `username`, `real_name`, `email_address`, `password`) VALUES
(1, 'jaydeejaye', 'JulieJohnson', 'jaydeejaye@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(2, 'derosaj', 'JohnDeRosa', 'derosaj@mailinator.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
