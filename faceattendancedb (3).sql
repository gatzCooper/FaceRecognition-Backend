-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 12:18 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faceattendancedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendances`
--

CREATE TABLE `tbl_attendances` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `clock_in` time DEFAULT NULL,
  `lunch_start` time DEFAULT NULL,
  `lunch_end` time DEFAULT NULL,
  `clock_out` time DEFAULT NULL,
  `total_hours` time DEFAULT NULL,
  `undertime` time DEFAULT NULL,
  `overtime` time DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_attendances`
--

INSERT INTO `tbl_attendances` (`id`, `user_id`, `date`, `clock_in`, `lunch_start`, `lunch_end`, `clock_out`, `total_hours`, `undertime`, `overtime`, `created_at`) VALUES
(1, 5, '2023-03-20', '14:43:00', '14:43:06', '14:47:21', '14:47:28', NULL, NULL, NULL, '2023-03-20 14:43:00'),
(2, 5, '2023-03-20', '14:49:48', '14:49:56', '19:15:27', '19:15:32', NULL, NULL, NULL, '2023-03-20 14:49:47'),
(3, 5, '2023-03-20', '19:15:37', '19:15:41', '19:15:46', '19:15:51', '00:00:09', NULL, NULL, '2023-03-20 19:15:37'),
(4, 5, '2023-03-20', '19:16:00', '19:16:10', '19:16:16', '19:16:21', '00:00:15', NULL, NULL, '2023-03-20 19:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_constants`
--

CREATE TABLE `tbl_constants` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `sub_value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_constants`
--

INSERT INTO `tbl_constants` (`id`, `category`, `value`, `sub_value`) VALUES
(1, 'Role', 'Admin', ''),
(2, 'Role', 'Teacher', ''),
(3, 'Role', 'Utility', ''),
(4, 'Role', 'Registrar', ''),
(5, 'Role', 'Deans Staff', ''),
(6, 'Role', 'Guidance Counselor ', ''),
(7, 'Role', 'School Nurse', ''),
(8, 'Role', 'Librarian', ''),
(9, 'Department', 'New partment', ''),
(10, 'Department', 'D2', ''),
(11, 'Schedule', '9:00am-6:00pm', ''),
(12, 'Schedule', '8:00am- 5:00pm', ''),
(13, 'Status', 'Active', ''),
(14, 'Status', 'Inactive', ''),
(15, 'Department', 'DEP IT', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `userNo` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `bday` date DEFAULT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `emailCode` varchar(255) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL DEFAULT 'default.png',
  `department` varchar(100) NOT NULL,
  `schedule` varchar(100) NOT NULL,
  `trackFace` varchar(100) NOT NULL,
  `TrainedFaces` varchar(100) NOT NULL,
  `attempt_no` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `userNo`, `role`, `fname`, `lname`, `mname`, `bday`, `age`, `gender`, `email`, `emailCode`, `contact`, `address`, `pic`, `department`, `schedule`, `trackFace`, `TrainedFaces`, `attempt_no`, `username`, `password`, `status`, `created_at`) VALUES
(1, '123', 'Admin', 'admin', 'lvl', 'mna', NULL, 0, '', 'asd@yahoo.com', '', '09834521', 'address', '', 'DEP IT', '8:00am- 5:00pm', '', '', 0, 'asd', 'S2lWbWlXNThnQXRFQzd3VWdiZVl6dz09', 'Active', '2023-02-16 18:29:41'),
(5, '2019-0390', 'Admin', ' Jacqueline', 'Gatacelo', '', '1999-02-10', 0, '', 'jacqueline.gatacelo@gmail.com', '1cb420cde04239d64af2fd51688e5604', '09353379825', 'dgfhgjhj', 'default.png', 'DEP IT', '8:00am- 4:02pm', 'System.Byte[]', '4', 0, 'jacqueline.gatacelo@gmail.com', 'OGEvNXFrR0tSWkVwbWhEbCtSNk9FQT09', 'Active', '2023-03-16 18:16:27'),
(6, '2019-0324', 'Teacher', 'Xyrelle Ann', 'Angeles', 'Frias', NULL, 0, '', 'xyrelleannangeles@gmail.com', 'b223dc20008bb199bfb4f1cc8b31e3f4', '09265172896', 'sfgbdf', 'default.png', 'DEP IT', '8:00am- 5:00pm', 'System.Byte[]', '3', 0, 'xyrelleannangeles@gmail.com', 'UkdNK0p1TVEzbFg0MXBIdzF1MThEZz09', 'Active', '2023-03-17 14:03:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendances`
--
ALTER TABLE `tbl_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_constants`
--
ALTER TABLE `tbl_constants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendances`
--
ALTER TABLE `tbl_attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_constants`
--
ALTER TABLE `tbl_constants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
