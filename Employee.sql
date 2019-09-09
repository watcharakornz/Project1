-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 08, 2019 at 01:53 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE IF NOT EXISTS `Employee` (
  `employee_id` int(255) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surename` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_dtm` date NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_dtm` datetime NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastupd_dtm` datetime DEFAULT NULL,
  `lastupd_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`employee_id`, `name`, `surename`, `sex`, `birth_dtm`, `email`, `address`, `telephone`, `created_dtm`, `created_by`, `lastupd_dtm`, `lastupd_by`) VALUES
(2, 'วัชรากร', 'สกุนะรัตน์', 'M', '1990-09-09', 'lnwzeedz@gmail.com', 'ปทุมธานี', '0866149062', '2019-09-08 19:35:14', 'admin', '2019-09-08 19:39:51', 'admin'),
(5, 'watcharakorn', 'sakunarat', 'F', '2019-09-09', 'watcharakorn@gmail.com', 'watcharakorn', '08661490628', '2019-09-08 20:42:54', 'admin', '2019-09-08 20:43:17', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `ind_employee` (`employee_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Employee`
--
ALTER TABLE `Employee`
  MODIFY `employee_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
