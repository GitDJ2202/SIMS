-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2023 at 10:41 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sims`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` varchar(20) NOT NULL,
  `phoneNo` varchar(14) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `postcode` varchar(12) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `phoneNo`, `email`, `address`, `postcode`, `city`, `state`, `country`) VALUES
('111111', '0198888888', 'dafadf@gmail.com', 'AAAAA50', '98000', 'SIBU', 'SARAWAK', 'MALAYSIA'),
('ADAD1', '33333333', 'dddddda@gmail.com', 'KKKKKK', '97000', 'BINTULU', 'SARAWAK', 'MALAYSIA'),
('ADDD43', '084555333', 'ASDFA@GMAIL.COM', '55SS', '97000', 'BINTULU', 'SARAWAK', 'MALAYSIA');

-- --------------------------------------------------------

--
-- Table structure for table `itemcat`
--

CREATE TABLE `itemcat` (
  `id` int(10) NOT NULL,
  `categoryDetail` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemcat`
--

INSERT INTO `itemcat` (`id`, `categoryDetail`, `status`) VALUES
(1, 'SPORTS', 'ACTIVE'),
(2, 'CLASSROOM', 'ACTIVE'),
(3, 'OFFICE', 'ACTIVE'),
(4, 'A', 'ACTIVE'),
(5, 'B', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `masterstockrecord`
--

CREATE TABLE `masterstockrecord` (
  `id` int(20) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `categoryId` int(10) DEFAULT NULL,
  `totalQuantity` int(10) DEFAULT NULL,
  `usedQuantity` int(10) DEFAULT NULL,
  `currentQuantity` int(10) DEFAULT NULL,
  `locationId` int(10) DEFAULT NULL,
  `supplierName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masterstockrecord`
--

INSERT INTO `masterstockrecord` (`id`, `name`, `categoryId`, `totalQuantity`, `usedQuantity`, `currentQuantity`, `locationId`, `supplierName`) VALUES
(3, 'Pencil', 3, 3500, 3500, 0, 2, 'STABILO');

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `id` int(20) NOT NULL,
  `itemId` varchar(20) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `receivedBy` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockin`
--

INSERT INTO `stockin` (`id`, `itemId`, `quantity`, `receivedBy`, `date`) VALUES
(1, '1', 40, 'ADMIN123', '0000-00-00'),
(2, '1', 2000, 'ADMIN123', '0000-00-00'),
(3, '2', 200, 'ADMIN123', '0000-00-00'),
(4, '3', 300, 'ADMIN123', '0000-00-00'),
(5, '3', 50, '111111', '2023-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `stocklocation`
--

CREATE TABLE `stocklocation` (
  `id` int(10) NOT NULL,
  `locationName` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stocklocation`
--

INSERT INTO `stocklocation` (`id`, `locationName`, `status`) VALUES
(1, 'STOREROOM A1', 'ACTIVE'),
(2, 'STOREROOM A2', 'ACTIVE'),
(3, 'TESTING', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `stockout`
--

CREATE TABLE `stockout` (
  `id` int(20) NOT NULL,
  `itemId` varchar(20) DEFAULT NULL,
  `stockOutCatId` int(10) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `usedQuantity` int(10) DEFAULT NULL,
  `usedBy` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockout`
--

INSERT INTO `stockout` (`id`, `itemId`, `stockOutCatId`, `description`, `usedQuantity`, `usedBy`, `date`) VALUES
(1, '1', 3, 'FOR 4S1', 40, 'ADMIN123', '2023-10-24'),
(2, '1', 2, 'ERROR TESTING', 2000, 'ADMIN123', '2023-10-26'),
(3, '2', 3, '', 0, 'ADMIN123', '2023-11-05'),
(4, '2', 3, 'ERROR', 200, 'ADMIN123', '2023-11-12'),
(5, '3', 4, 'TESTING', 500, 'ADMIN123', '0000-00-00'),
(6, '3', 3, 'STUDENT', 160, '111111', '0000-00-00'),
(7, '3', 4, 'ERROR', 3190, '111111', '2023-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `stockoutcat`
--

CREATE TABLE `stockoutcat` (
  `id` int(10) NOT NULL,
  `categoryDetail` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockoutcat`
--

INSERT INTO `stockoutcat` (`id`, `categoryDetail`, `status`) VALUES
(1, 'EVENT USE', 'ACTIVE'),
(2, 'FAULTY', 'ACTIVE'),
(3, 'CLASS USE', 'ACTIVE'),
(4, 'TESTING', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` varchar(20) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `pointOfContact` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `pointOfContact`) VALUES
('ADAD1', 'KAWKAW', 'MANAGER'),
('ADDD43', 'STABILO', 'SALES MANAGEMENT');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `id` varchar(20) NOT NULL,
  `pword` varchar(32) DEFAULT NULL,
  `userRole` varchar(40) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `pword`, `userRole`, `status`) VALUES
('111111', '827ccb0eea8a706c4c34a16891f84e7b', 'USER', 'ACTIVE'),
('ADMIN123', '0192023a7bbd73250516f069df18b500', 'SYSTEM ADMINISTRATOR', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `Fname` varchar(30) DEFAULT NULL,
  `Lname` varchar(30) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `gender` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Fname`, `Lname`, `DOB`, `gender`) VALUES
('111111', 'JANE', 'EFFA', '2023-11-14', 'F');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemcat`
--
ALTER TABLE `itemcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masterstockrecord`
--
ALTER TABLE `masterstockrecord`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocklocation`
--
ALTER TABLE `stocklocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockout`
--
ALTER TABLE `stockout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockoutcat`
--
ALTER TABLE `stockoutcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itemcat`
--
ALTER TABLE `itemcat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `masterstockrecord`
--
ALTER TABLE `masterstockrecord`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stocklocation`
--
ALTER TABLE `stocklocation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stockout`
--
ALTER TABLE `stockout`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stockoutcat`
--
ALTER TABLE `stockoutcat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
