-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2016 at 12:27 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpclass`
--
CREATE DATABASE IF NOT EXISTS `phpclass` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `phpclass`;

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `text` varchar(5000) DEFAULT NULL,
  `picturepath` varchar(240) DEFAULT NULL,
  `customerid` int(11) NOT NULL,
  `createdate` int(11) NOT NULL,
  `expiredate` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `transactionid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `advertisement`:
--   `customerid`
--       `customers` -> `id`
--   `transactionid`
--       `transactions` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement2category`
--

CREATE TABLE `advertisement2category` (
  `advertisementid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `advertisement2category`:
--   `categoryid`
--       `category` -> `id`
--   `advertisementid`
--       `advertisement` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `category`:
--

-- --------------------------------------------------------

--
-- Table structure for table `customerpaymentmethods`
--

CREATE TABLE `customerpaymentmethods` (
  `id` int(20) NOT NULL,
  `customerid` int(20) NOT NULL,
  `paymentmethod` int(20) NOT NULL,
  `cardnumber` varchar(60) NOT NULL,
  `cardname` varchar(60) NOT NULL,
  `expires` varchar(60) NOT NULL,
  `secnumber` varchar(60) DEFAULT NULL,
  `billingaddress` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `customerpaymentmethods`:
--   `customerid`
--       `customers` -> `id`
--   `paymentmethod`
--       `paymentoptions` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `emailaddress` varchar(55) NOT NULL,
  `address1` varchar(55) NOT NULL,
  `houseNumber` varchar(55) NOT NULL,
  `zipcode` varchar(55) NOT NULL,
  `city` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `customers`:
--

-- --------------------------------------------------------

--
-- Table structure for table `paymentoptions`
--

CREATE TABLE `paymentoptions` (
  `id` int(11) NOT NULL,
  `paymenttype` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `paymentoptions`:
--

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `price` double NOT NULL,
  `paymentoptionid` int(11) NOT NULL,
  `advertisementid` int(11) NOT NULL,
  `paymentdate` date NOT NULL,
  `paymentmethodid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `transactions`:
--   `customerid`
--       `customers` -> `id`
--   `paymentoptionid`
--       `paymentoptions` -> `id`
--   `paymentmethodid`
--       `customerpaymentmethods` -> `id`
--   `advertisementid`
--       `advertisement` -> `id`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerid` (`customerid`),
  ADD KEY `transactionid` (`transactionid`);

--
-- Indexes for table `advertisement2category`
--
ALTER TABLE `advertisement2category`
  ADD KEY `categoryid` (`categoryid`),
  ADD KEY `advertisementid` (`advertisementid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerpaymentmethods`
--
ALTER TABLE `customerpaymentmethods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerid` (`customerid`),
  ADD KEY `paymentmethod` (`paymentmethod`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentoptions`
--
ALTER TABLE `paymentoptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerid` (`customerid`),
  ADD KEY `paymentoptionid` (`paymentoptionid`),
  ADD KEY `paymentmethodid` (`paymentmethodid`),
  ADD KEY `advertisementid` (`advertisementid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customerpaymentmethods`
--
ALTER TABLE `customerpaymentmethods`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD CONSTRAINT `advertisement_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `advertisement_ibfk_2` FOREIGN KEY (`transactionid`) REFERENCES `transactions` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `advertisement2category`
--
ALTER TABLE `advertisement2category`
  ADD CONSTRAINT `advertisement2category_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `advertisement2category_ibfk_2` FOREIGN KEY (`advertisementid`) REFERENCES `advertisement` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `customerpaymentmethods`
--
ALTER TABLE `customerpaymentmethods`
  ADD CONSTRAINT `customerpaymentmethods_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `customerpaymentmethods_ibfk_2` FOREIGN KEY (`paymentmethod`) REFERENCES `paymentoptions` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`paymentoptionid`) REFERENCES `paymentoptions` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`paymentmethodid`) REFERENCES `customerpaymentmethods` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`advertisementid`) REFERENCES `advertisement` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
