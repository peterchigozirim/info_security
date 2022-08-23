-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 12:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2021_info_security`
--
CREATE DATABASE IF NOT EXISTS `project2021_info_security` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `project2021_info_security`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `fullname`, `active`) VALUES
(1, 'admin', 'admin', 'Programmer', '1');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(100) NOT NULL,
  `employee_id` varchar(12) NOT NULL,
  `date_clocked` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date_clocked`) VALUES
(1, 'EM-0001', '2021-04-05 07:23:13'),
(2, 'EM-0002', '2021-04-05 07:23:13'),
(3, 'EM-0001', '2021-04-06 07:23:13'),
(4, 'EM-0002', '2021-04-06 07:23:13'),
(5, 'EM-0001', '2021-04-07 07:23:13'),
(6, 'EM-0001', '2021-04-13 11:14:55'),
(7, 'EM-0002', '2021-04-13 18:11:08'),
(8, 'EM-0003', '2021-04-13 19:45:29'),
(9, 'EM-0001', '2021-07-01 13:45:23'),
(10, 'EM-0001', '2021-07-05 11:00:16'),
(11, 'EM-0002', '2021-07-05 11:49:30'),
(12, 'EM-0003', '2021-07-05 11:57:55'),
(13, 'EM-0001', '2021-07-07 16:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `dob` date NOT NULL,
  `soo` varchar(20) NOT NULL,
  `tax` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `position` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `emp_type` varchar(20) NOT NULL,
  `work_hour` int(20) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `acc_number` int(12) NOT NULL,
  `acc_type` varchar(20) NOT NULL,
  `sort` varchar(20) NOT NULL,
  `status` int(5) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(50) NOT NULL DEFAULT 'default.png',
  `qualification` varchar(30) DEFAULT NULL,
  `date_obtained` date DEFAULT NULL,
  `salary` double(10,2) DEFAULT NULL,
  `allowance` text DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(20) DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `firstname`, `lastname`, `phone`, `gender`, `dob`, `soo`, `tax`, `address`, `position`, `start_date`, `emp_type`, `work_hour`, `bank`, `acc_number`, `acc_type`, `sort`, `status`, `created_at`, `photo`, `qualification`, `date_obtained`, `salary`, `allowance`, `username`, `password`, `role`) VALUES
('EM-0001', 'Destiny', 'Brotobor', '08067683682', 'Male', '2000-04-06', 'Delta', '12345', 'St. Micheals Street', 'Branch Manager', '2021-04-06', 'Part Time', 54, 'Access Bank', 923453422, 'Savings', '12345', 1, '2021-04-06 07:53:57', 'em-00011625556621.jpg', 'PGD', '2021-07-06', 1000000.00, 'Transport/Feeding/Wardrobe Allowance', 'admin', 'admin', '1'),
('EM-0002', 'Silver', 'Destiny', '090123456781', 'Female', '2021-04-05', 'Delta', '12345', 'Ogbon Hills 3', 'Managing Director', '2021-04-01', 'Full Time', 32, 'Access Bank', 2147483647, 'Savings', '32142', 1, '2021-04-06 08:04:08', 'em-0002.jpg', NULL, NULL, NULL, '', '', '', ''),
('EM-0003', 'Akpan', 'Lazarus', '09087634782', 'Male', '2009-04-05', 'Imo', '32145', 'Old road Nekede', 'Human Resource Manager', '2021-04-06', 'Casual', 12, 'United Bank of Africa', 23432123, 'Savings', '12312', 1, '2021-04-06 08:06:30', 'em-00031625555041.jpg', 'PGD', '2021-07-06', 100000.00, 'Transport Allowance', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
