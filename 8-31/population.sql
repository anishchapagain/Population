-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2014 at 01:28 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `population`
--

-- --------------------------------------------------------

--
-- Table structure for table `age`
--

CREATE TABLE IF NOT EXISTS `age` (
  `ageId` int(6) NOT NULL AUTO_INCREMENT,
  `agegroup` varchar(32) NOT NULL,
  PRIMARY KEY (`ageId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `age`
--

INSERT INTO `age` (`ageId`, `agegroup`) VALUES
(1, 'young'),
(2, 'middle'),
(3, 'old');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `cityId` int(6) NOT NULL AUTO_INCREMENT,
  `countryId` int(6) NOT NULL,
  `cityname` varchar(32) NOT NULL,
  PRIMARY KEY (`cityId`),
  UNIQUE KEY `cityId` (`cityId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityId`, `countryId`, `cityname`) VALUES
(1, 2, 'kathmandu'),
(2, 3, 'delhi'),
(3, 2, 'pokhara'),
(4, 2, 'biratnagar');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `countryId` int(11) NOT NULL AUTO_INCREMENT,
  `countryname` varchar(32) NOT NULL,
  PRIMARY KEY (`countryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryId`, `countryname`) VALUES
(2, 'nepal'),
(3, 'india'),
(7, 'usa'),
(8, 'uk');

-- --------------------------------------------------------

--
-- Table structure for table `population`
--

CREATE TABLE IF NOT EXISTS `population` (
  `pId` int(6) NOT NULL AUTO_INCREMENT,
  `male` int(255) NOT NULL,
  `female` int(255) NOT NULL,
  `cityId` int(6) NOT NULL,
  `ageId` int(6) NOT NULL,
  PRIMARY KEY (`pId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `population`
--

INSERT INTO `population` (`pId`, `male`, `female`, `cityId`, `ageId`) VALUES
(1, 2000, 1800, 1, 1),
(2, 20010, 1200, 4, 1),
(3, 6500, 4800, 3, 1),
(4, 180000, 165000, 2, 1),
(5, 68000, 72000, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`) VALUES
(1, 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
