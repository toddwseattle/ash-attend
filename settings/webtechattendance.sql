-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 14, 2020 at 07:22 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtechattendance`
--
CREATE DATABASE IF NOT EXISTS `webtechattendance` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `webtechattendance`;

-- --------------------------------------------------------

--
-- Table structure for table `attend_class`
--

CREATE TABLE `attend_class` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `class_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attend_mark`
--

CREATE TABLE `attend_mark` (
  `mark_class_id` int(11) NOT NULL,
  `mark_student_id` int(11) NOT NULL,
  `mark_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attend_roles`
--

CREATE TABLE `attend_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attend_roles`
--

INSERT INTO `attend_roles` (`role_id`, `role_name`) VALUES
(1, 'Faculty'),
(2, 'Faculty Intern'),
(3, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `attend_status`
--

CREATE TABLE `attend_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attend_status`
--

INSERT INTO `attend_status` (`status_id`, `status_name`) VALUES
(1, 'Active'),
(2, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `attend_users`
--

CREATE TABLE `attend_users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(20) NOT NULL,
  `user_lname` varchar(20) NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_pass` varchar(200) DEFAULT NULL,
  `user_role` int(11) NOT NULL,
  `user_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attend_class`
--
ALTER TABLE `attend_class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `attend_mark`
--
ALTER TABLE `attend_mark`
  ADD KEY `mark_class_id` (`mark_class_id`),
  ADD KEY `mark_student_id` (`mark_student_id`),
  ADD KEY `mark_status` (`mark_status`);

--
-- Indexes for table `attend_roles`
--
ALTER TABLE `attend_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `attend_status`
--
ALTER TABLE `attend_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `attend_users`
--
ALTER TABLE `attend_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_role` (`user_role`),
  ADD KEY `user_status` (`user_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attend_class`
--
ALTER TABLE `attend_class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attend_roles`
--
ALTER TABLE `attend_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attend_status`
--
ALTER TABLE `attend_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attend_users`
--
ALTER TABLE `attend_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attend_mark`
--
ALTER TABLE `attend_mark`
  ADD CONSTRAINT `attend_mark_ibfk_1` FOREIGN KEY (`mark_class_id`) REFERENCES `attend_class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attend_mark_ibfk_2` FOREIGN KEY (`mark_student_id`) REFERENCES `attend_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attend_mark_ibfk_3` FOREIGN KEY (`mark_status`) REFERENCES `attend_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attend_users`
--
ALTER TABLE `attend_users`
  ADD CONSTRAINT `attend_users_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `attend_roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attend_users_ibfk_2` FOREIGN KEY (`user_status`) REFERENCES `attend_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
