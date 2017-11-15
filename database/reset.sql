-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2017 at 10:35 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reset`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `po` smallint(5) UNSIGNED NOT NULL,
  `approve1` tinyint(1) NOT NULL,
  `approve2` tinyint(1) NOT NULL,
  `crteDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `po`, `approve1`, `approve2`, `crteDate`) VALUES
(1, 1, 1, 1, '0000-00-00 00:00:00'),
(2, 1, 0, 0, '2017-11-15 14:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `requisition` smallint(5) UNSIGNED NOT NULL,
  `crteDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Purchase Orders';

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`id`, `requisition`, `crteDate`) VALUES
(1, 1, '0000-00-00 00:00:00'),
(2, 1, '2017-11-15 14:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `customer` tinytext NOT NULL,
  `part` tinytext NOT NULL,
  `qty` float NOT NULL,
  `cost` float NOT NULL,
  `total` float NOT NULL,
  `date` date NOT NULL,
  `crteDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Quotations';

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `customer`, `part`, `qty`, `cost`, `total`, `date`, `crteDate`) VALUES
(1, 'Cliente 1', 'Parte 1', 1.5, 10, 15, '2017-11-22', '0000-00-00 00:00:00'),
(2, 'C1', 'P1', 1.5, 10, 15, '2017-11-22', '0000-00-00 00:00:00'),
(3, 'C1', 'P1', 1.5, 10, 15, '2017-11-22', '2017-11-15 14:30:00'),
(4, 'C1', 'P1', 1.5, 10, 15, '2017-11-22', '2017-11-15 14:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `quotation` smallint(5) UNSIGNED NOT NULL,
  `approve1` tinyint(1) NOT NULL,
  `approve2` tinyint(1) NOT NULL,
  `approve3` tinyint(1) NOT NULL,
  `crteDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Quotations';

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`id`, `quotation`, `approve1`, `approve2`, `approve3`, `crteDate`) VALUES
(1, 5, 1, 1, 1, '0000-00-00 00:00:00'),
(2, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(3, 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4, 1, 0, 0, 0, '2017-11-15 14:31:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
