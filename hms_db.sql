-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2019 at 07:18 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_tb`
--

CREATE TABLE `bill_tb` (
  `bill_id` int(11) NOT NULL,
  `patient_id` int(200) NOT NULL,
  `total_bill` int(200) NOT NULL,
  `total_paid` int(200) NOT NULL,
  `total_due` int(200) NOT NULL,
  `payment_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_tb`
--

INSERT INTO `bill_tb` (`bill_id`, `patient_id`, `total_bill`, `total_paid`, `total_due`, `payment_status`) VALUES
(1, 1, 5050, 2500, 2550, 'Due'),
(2, 2, 15000, 10000, 5000, 'Due'),
(3, 3, 5000, 5000, 0, 'Paid'),
(4, 4, 3000, 3000, 0, 'Paid'),
(5, 5, 2000, 1500, 500, 'Due');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_tb`
--

CREATE TABLE `doctor_tb` (
  `doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_tb`
--

INSERT INTO `doctor_tb` (`doctor_id`, `doctor_name`) VALUES
(1, 'Zinia Nur'),
(2, 'Shamim Reza'),
(3, 'Romana'),
(4, 'Nadia'),
(5, 'Esha');

-- --------------------------------------------------------

--
-- Table structure for table `pathology`
--

CREATE TABLE `pathology` (
  `id` int(11) NOT NULL,
  `patient_id` int(200) NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `cost` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pathology`
--

INSERT INTO `pathology` (`id`, `patient_id`, `test_name`, `cost`) VALUES
(1, 1, 'Blood Test', 500),
(2, 2, 'Urine Test', 250),
(3, 3, 'Hemoglobin Test ', 400),
(4, 4, 'CBC', 1200),
(5, 5, 'Diabetics ', 700);

-- --------------------------------------------------------

--
-- Table structure for table `patient_tb`
--

CREATE TABLE `patient_tb` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `doctor_id` int(200) NOT NULL,
  `p_address` text,
  `p_contact` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_tb`
--

INSERT INTO `patient_tb` (`p_id`, `p_name`, `doctor_id`, `p_address`, `p_contact`) VALUES
(1, 'Mahady Hasan Milon', 1, 'Sector-10, Uttara, Dhaka 1230', 1997655933),
(2, 'Rokibul Islam', 2, 'Sector-10, Uttara, Dhaka 1230', 1756433234),
(3, 'Nasir Uddin', 3, 'Sector-10, Uttara, Dhaka 1230', 1975644333),
(4, 'Rahela Khatun', 4, 'Sector-10, Uttara, Dhaka 1230', 788645533),
(5, 'Rokshana Begum', 5, 'Sector-10, Uttara, Dhaka 1230', 1227544355);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_tb`
--
ALTER TABLE `bill_tb`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `doctor_tb`
--
ALTER TABLE `doctor_tb`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `pathology`
--
ALTER TABLE `pathology`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_tb`
--
ALTER TABLE `patient_tb`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_tb`
--
ALTER TABLE `bill_tb`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctor_tb`
--
ALTER TABLE `doctor_tb`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pathology`
--
ALTER TABLE `pathology`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient_tb`
--
ALTER TABLE `patient_tb`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
