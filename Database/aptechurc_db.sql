-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 11:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aptechurc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(1500) DEFAULT NULL,
  `AFTER_EDIT` varchar(2500) NOT NULL,
  `ACTION_BY` varchar(500) NOT NULL,
  `REMARKS` varchar(500) NOT NULL,
  `DATE_CREATED` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(30) NOT NULL,
  `ef_no` varchar(100) DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `FULL_NAME` varchar(100) DEFAULT NULL,
  `FEE_HEAD` varchar(100) DEFAULT NULL,
  `PAYMENT_MODE` varchar(100) DEFAULT NULL,
  `AMOUNT_IN_WORDS` varchar(100) DEFAULT NULL,
  `Month_Of_Payment` date DEFAULT current_timestamp(),
  `CHEQUE_NO` varchar(50) DEFAULT NULL,
  `TIMINGS` varchar(100) DEFAULT NULL,
  `INPUTTER` varchar(100) DEFAULT NULL,
  `counselor_id` int(11) DEFAULT NULL,
  `Receipt_no` bigint(20) DEFAULT NULL,
  `FEE_TYPE` int(11) DEFAULT NULL,
  `ADMIN_REMARKS` varchar(50) DEFAULT NULL,
  `student_id_FK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(30) NOT NULL,
  `id_no` bigint(20) NOT NULL,
  `ex_id_no` varchar(50) DEFAULT NULL,
  `name` text NOT NULL,
  `father_name` varchar(40) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `timings` varchar(200) NOT NULL,
  `course` varchar(50) NOT NULL,
  `admission_fee` bigint(20) NOT NULL,
  `monthly_fee` bigint(20) NOT NULL,
  `amount_in_words` varchar(200) NOT NULL,
  `student_status` int(11) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `ADMIN_REMARKS` varchar(150) NOT NULL,
  `Original_Booking_Confirmation` varchar(80) NOT NULL,
  `Booking_Confirmation_Date` varchar(80) NOT NULL,
  `Course_Family_Name` varchar(80) NOT NULL,
  `Course_Code` date NOT NULL,
  `Short_Course_Total_Fee` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `status` int(11) DEFAULT 1,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Staff',
  `admin_remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `status`, `email`, `password`, `type`, `admin_remarks`) VALUES
(1, 'Usman Hameed', 'usman@123', 1, 'usmanhameed1790@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Receipt_no` (`Receipt_no`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
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
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
