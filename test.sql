-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 23, 2019 at 07:50 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`ID`, `firstname`, `lastname`) VALUES
(1, 'LSD', 'Group'),
(2, 'The Beach', 'Boys'),
(3, 'Robbie', 'Williams'),
(4, 'Филип', 'Киркоров'),
(5, 'Dinah', 'Washington'),
(6, 'Kate', 'Bush'),
(7, 'Natasha', 'Bedingfield'),
(8, 'Unknown', 'Author');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE IF NOT EXISTS `songs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `authorID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `authorID` (`authorID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`ID`, `name`, `year`, `authorID`) VALUES
(1, 'No more friends', 2019, 1),
(2, 'California Girls', 1965, 2),
(3, 'God Only Knows', 1966, 2),
(4, 'Good Vibrations', 1966, 2),
(5, 'Rock DJ', 2000, 3),
(6, 'Килиманджаро', 2000, 4),
(7, 'Огонь и вода', 2000, 4),
(8, 'Help Me, Rhonda', 1965, 2),
(9, 'I Could Write a Book', 1940, 5),
(10, 'Wuthering Heights', 1978, 6),
(11, 'Unwritten', 2006, 1),
(12, 'Game On', 2010, 8);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `FK_Authors_Songs` FOREIGN KEY (`authorID`) REFERENCES `authors` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
