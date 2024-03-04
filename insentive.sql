-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 10:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insentive`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `status`) VALUES
(1, 'abhi', '1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phno` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `spm` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `phno`, `email`, `spm`, `address`, `userid`, `password`, `status`) VALUES
(6, 'Abinash', '8249053913', 'aa@gmail.com', '20000', 'Bhubaneswar, Odisha, India', 'abbhi', '123456', 1),
(7, 'Abhi', '824905397', 'aa@gmail.com', '10000', 'Bhubaneswar, Odisha, India', 'aaa', '1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees_incentives`
--

CREATE TABLE `employees_incentives` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sales_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `incentive_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `holiday_package_eligibility` varchar(255) DEFAULT NULL,
  `bonus` decimal(10,2) NOT NULL DEFAULT 0.00,
  `salary` decimal(10,2) NOT NULL,
  `salary_with_incentive_and_bonus` decimal(10,2) NOT NULL,
  `sales_source` varchar(250) NOT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees_incentives`
--

INSERT INTO `employees_incentives` (`id`, `emp_id`, `name`, `sales_amount`, `incentive_percentage`, `holiday_package_eligibility`, `bonus`, `salary`, `salary_with_incentive_and_bonus`, `sales_source`, `status`) VALUES
(1, 6, 'Abinash', 20000.00, 3.00, 'no', 0.00, 20000.00, 20000.00, 'Insurance', 1),
(2, 7, 'Abhi', 30000.00, 3.50, 'no', 1000.00, 10000.00, 10000.00, 'Loans', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `amenities` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `name`, `location`, `amenities`) VALUES
(1, 'Go far', 'USA', '5Night with lucnch and dinner');

-- --------------------------------------------------------

--
-- Table structure for table `sales_incentives`
--

CREATE TABLE `sales_incentives` (
  `id` int(11) NOT NULL,
  `sales_amount` decimal(10,2) DEFAULT NULL,
  `incentive_percentage` decimal(5,2) DEFAULT NULL,
  `bonus` decimal(10,2) DEFAULT NULL,
  `holiday_package_eligibility` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_incentives`
--

INSERT INTO `sales_incentives` (`id`, `sales_amount`, `incentive_percentage`, `bonus`, `holiday_package_eligibility`) VALUES
(1, 10000.00, 1.50, 0.00, 0),
(2, 20000.00, 3.00, 0.00, 0),
(3, 30000.00, 3.50, 1000.00, 0),
(4, 50000.00, 5.00, 0.00, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees_incentives`
--
ALTER TABLE `employees_incentives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_incentives`
--
ALTER TABLE `sales_incentives`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees_incentives`
--
ALTER TABLE `employees_incentives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_incentives`
--
ALTER TABLE `sales_incentives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
