-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 01:04 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `flightbooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `idNumber` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `martialStatus` varchar(20) DEFAULT NULL,
  `DoB` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `airline`
--

CREATE TABLE IF NOT EXISTS `airline` (
  `airlineid` int(11) NOT NULL AUTO_INCREMENT,
  `airlinecode` varchar(10) NOT NULL,
  `airlinename` varchar(255) NOT NULL,
  PRIMARY KEY (`airlineid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `airline`
--

INSERT INTO `airline` (`airlineid`, `airlinecode`, `airlinename`) VALUES
(1, 'AA', 'American Airlines'),
(2, 'DL', 'Delta Air Lines'),
(4, '76', 'kanombe');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE IF NOT EXISTS `flights` (
  `flightid` int(11) NOT NULL AUTO_INCREMENT,
  `airlineid` int(11) DEFAULT NULL,
  `ticketprice` decimal(10,2) NOT NULL,
  `availableseats` int(11) NOT NULL,
  PRIMARY KEY (`flightid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flightid`, `airlineid`, `ticketprice`, `availableseats`) VALUES
(1, 1, 250.00, 150),
(2, 2, 200.50, 200),
(3, 3, 300.75, 100),
(4, 2, 10000.00, 160),
(6, 2, 10000.00, 160),
(7, 8, 1600.00, 200),
(9, 6, 500.00, 120),
(10, 2, 100.00, 4);

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE IF NOT EXISTS `passengers` (
  `passengerid` int(11) NOT NULL AUTO_INCREMENT,
  `flightid` int(11) DEFAULT NULL,
  `passengername` varchar(255) NOT NULL,
  `passengergender` char(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`passengerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`passengerid`, `flightid`, `passengername`, `passengergender`, `email`) VALUES
(1, 1, 'John Doe', 'M', 'john.doe@example.com'),
(2, 2, 'Jane Smith', 'F', 'jane.smith@example.com'),
(3, 3, 'Bob Johnson', 'M', 'bob.johnson@example.com'),
(4, 3, 'mbn', 'm', 'lo');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `transactionid` int(11) NOT NULL AUTO_INCREMENT,
  `reservationid` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`transactionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`transactionid`, `reservationid`, `date`, `amount`) VALUES
(1, 1, '2024-02-18', 150.00),
(2, 2, '2024-02-19', 200.50),
(3, 3, '2024-02-20', 300.75),
(4, 30, '2024-08-12', 300.00),
(5, 30, '2024-08-12', 300.00),
(6, 30, '2024-08-12', 300.00),
(7, 30, '2024-08-12', 300.00),
(8, 30, '2024-08-12', 300.00),
(9, 2, '0000-00-00', 50000.00);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `reservationid` int(11) NOT NULL AUTO_INCREMENT,
  `passengerid` int(11) DEFAULT NULL,
  `reservationtime` time NOT NULL,
  `reservationdate` date NOT NULL,
  PRIMARY KEY (`reservationid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservationid`, `passengerid`, `reservationtime`, `reservationdate`) VALUES
(1, 1, '12:00:00', '2024-02-18'),
(3, 3, '09:45:00', '2024-02-20'),
(4, 56, '20:00:00', '2024-03-12'),
(5, 3, '20:00:00', '2024-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
