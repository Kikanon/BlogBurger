-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2019 at 03:54 PM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `main`
--
CREATE DATABASE IF NOT EXISTS `main` DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci;
USE `main`;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `PostID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `PostID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Text` text NOT NULL,
  `ImagePath` varchar(200) DEFAULT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Likes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`PostID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`PostID`, `UserID`, `Title`, `Text`, `ImagePath`, `Time`, `Likes`) VALUES
(1, 1, 'First Test post.', 'I like cats and weed.', '_user_photos/doggo.jpg', '2019-05-08 17:06:30', 0),
(2, 1, 'Drugi post', 'Stari stuff', '/_user_photos/60c7ce15-6791-4dc4-aad8-742da1546d0e.png', '2019-05-22 10:09:14', 0),
(3, 1, 'Burger', 'Nekaj napiÅ¡em pac', '/_user_photos/04fe2f90-896b-481d-ac51-6b2e19b72569.jpg', '2019-06-03 11:27:19', 0),
(4, 3, 'Not to influence anyone', 'Took this pic this morning omg <3 <3 :D :/ ;)', '/_user_photos/58a7e92e-98e0-4944-befc-ac81c7a1230a.jpg', '2019-06-03 12:03:27', 419);

-- --------------------------------------------------------

--
-- Table structure for table `stuff_to_sell`
--

CREATE TABLE IF NOT EXISTS `stuff_to_sell` (
  `UserID` int(11) NOT NULL,
  `UserIP` varchar(11) NOT NULL,
  `TimesVisited` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(200) NOT NULL,
  `UserMail` varchar(200) NOT NULL,
  `UserPass` varchar(200) NOT NULL,
  `UserType` int(11) NOT NULL,
  `UserRegistration` varchar(100) NOT NULL,
  `UserLastVisit` varchar(200) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `UserMail`, `UserPass`, `UserType`, `UserRegistration`, `UserLastVisit`) VALUES
(1, 'Admin', 'admin@jst.si', 'geslo123', 2, '0000-00-00', '05/08/2019, 12:38:09'),
(2, 'NotAnAdmin', 'notadmin@jst.si', 'geslo123', 1, '05/22/2019, 16:59:02', '05/22/2019, 16:59:02'),
(3, 'PMaister', 'pmaiser@pussy.m', 'geslo123', 1, '05/29/2019, 14:56:38', '05/29/2019, 14:56:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
