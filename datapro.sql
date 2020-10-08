-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2019 at 03:20 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datapro`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `Password`) VALUES
(1, 'soni', '3331e8d1992e9dceb8f3ce8c69d8c2fb'),
(2, 'dizzi', '3331e8d1992e9dceb8f3ce8c69d8c2fb');

-- --------------------------------------------------------

--
-- Table structure for table `class_type`
--

CREATE TABLE `class_type` (
  `class_type_id` int(11) NOT NULL,
  `class_nm` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_type`
--

INSERT INTO `class_type` (`class_type_id`, `class_nm`) VALUES
(1, 'class A'),
(2, 'Gazetted'),
(3, 'Non-Gazetted');

-- --------------------------------------------------------

--
-- Table structure for table `family_details`
--

CREATE TABLE `family_details` (
  `fid` bigint(11) NOT NULL,
  `emp_id` bigint(20) NOT NULL,
  `Full_name` varchar(50) NOT NULL,
  `Age` int(50) NOT NULL,
  `relationship` text NOT NULL,
  `Id_Proof` varchar(50) NOT NULL,
  `Medical_Proof` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `family_details`
--

INSERT INTO `family_details` (`fid`, `emp_id`, `Full_name`, `Age`, `relationship`, `Id_Proof`, `Medical_Proof`) VALUES
(11, 4, 'test1', 21, 'test', '4_test1_id.pdf', '4_test_med.pdf'),
(12, 4, 'sfdgh', 23, 'fvgbhjn', '4_sfdgh_id.pdf', '4_sfdgh_med.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `passes`
--

CREATE TABLE `passes` (
  `pass_id` bigint(20) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `apply_date` date NOT NULL,
  `approval_date` date NOT NULL,
  `issue_year` int(4) NOT NULL,
  `start_station` text NOT NULL,
  `dest_station` text NOT NULL,
  `pass_type` int(11) NOT NULL,
  `half_full` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passes`
--

INSERT INTO `passes` (`pass_id`, `emp_id`, `apply_date`, `approval_date`, `issue_year`, `start_station`, `dest_station`, `pass_type`, `half_full`, `status`) VALUES
(1, 4, '2019-10-31', '2019-11-02', 2019, 'delhi', 'kolkata', 1, '1', 'approved'),
(2, 4, '2019-11-01', '2019-11-01', 2019, 'agartala', 'jsr', 1, '2', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `pass_family`
--

CREATE TABLE `pass_family` (
  `pass_fam_id` int(11) NOT NULL,
  `pass_id` bigint(20) NOT NULL,
  `family_id` bigint(20) NOT NULL,
  `self_or_family` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pass_family`
--

INSERT INTO `pass_family` (`pass_fam_id`, `pass_id`, `family_id`, `self_or_family`) VALUES
(1, 1, 0, 'self'),
(2, 1, 12, 'family'),
(3, 2, 0, 'self'),
(4, 2, 11, 'family');

-- --------------------------------------------------------

--
-- Table structure for table `pass_type`
--

CREATE TABLE `pass_type` (
  `pass_type_id` int(11) NOT NULL,
  `pass_type_nm` text NOT NULL,
  `class_type_id` int(11) NOT NULL,
  `max_pass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pass_type`
--

INSERT INTO `pass_type` (`pass_type_id`, `pass_type_nm`, `class_type_id`, `max_pass`) VALUES
(1, 'privileged', 1, 6),
(2, 'pto', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE `personal` (
  `emp_id` bigint(20) NOT NULL,
  `emp_unique_id` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `age` int(11) NOT NULL,
  `date_of_joining` date NOT NULL,
  `class_type_id` int(11) NOT NULL,
  `office_zone` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` bigint(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Zip` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`emp_id`, `emp_unique_id`, `password`, `first_name`, `last_name`, `gender`, `age`, `date_of_joining`, `class_type_id`, `office_zone`, `Email`, `Phone`, `Address`, `City`, `State`, `Zip`) VALUES
(1, 'test1', '81dc9bdb52d04dc20036dbd8313ed055', 'tst1', 'test1', 'f', 25, '2019-09-01', 1, 'agartala', 'nuvg@gmail.com', 908765432, 'cxgvhjk', 'afghjkl', 'dfghjkl', 234567),
(2, '17017', '74577335b4a220d9605d8218d8b39d5b', 'bhawna', 'soni', 'm', 30, '2019-10-17', 2, 'agartala', 'bhawna@gmail.com', 9876543210, 'diamond crossing', 'agartala', 'agartala', 790046),
(3, '1011', '89a4b5bd7d02ad1e342c960e6a98365c', 'anu', 'urkade', 'f', 25, '2019-10-01', 2, 'agartala', 'anu@gmail.com', 4567891230, 'dfran', 'sdklsadn', 'fsdfsdf', 465123),
(4, 'soni', '3331e8d1992e9dceb8f3ce8c69d8c2fb', 'soni', 'soni', 'f', 25, '2019-10-01', 1, 'agartala', 'sdfg@gmail.com', 9087654321, 'sdfgh fhgfjhh', 'fghnmj', 'rghjk', 123456);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `class_type`
--
ALTER TABLE `class_type`
  ADD PRIMARY KEY (`class_type_id`);

--
-- Indexes for table `family_details`
--
ALTER TABLE `family_details`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `passes`
--
ALTER TABLE `passes`
  ADD PRIMARY KEY (`pass_id`);

--
-- Indexes for table `pass_family`
--
ALTER TABLE `pass_family`
  ADD PRIMARY KEY (`pass_fam_id`);

--
-- Indexes for table `pass_type`
--
ALTER TABLE `pass_type`
  ADD PRIMARY KEY (`pass_type_id`);

--
-- Indexes for table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_type`
--
ALTER TABLE `class_type`
  MODIFY `class_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `family_details`
--
ALTER TABLE `family_details`
  MODIFY `fid` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `passes`
--
ALTER TABLE `passes`
  MODIFY `pass_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pass_family`
--
ALTER TABLE `pass_family`
  MODIFY `pass_fam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pass_type`
--
ALTER TABLE `pass_type`
  MODIFY `pass_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal`
--
ALTER TABLE `personal`
  MODIFY `emp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
