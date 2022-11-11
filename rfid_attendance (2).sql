-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 11, 2022 at 11:04 AM
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
-- Database: `rfid_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `fullname` tinytext NOT NULL,
  `date_in` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time DEFAULT NULL,
  `instructor` tinytext NOT NULL,
  `subject` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `fullname`, `date_in`, `time_in`, `time_out`, `instructor`, `subject`) VALUES
(4, 'Jobert Gosuico Simbre', '2022-11-08', '16:40:31', '08:47:36', '', ''),
(5, 'Jobert Gosuico Simbre', '2022-11-11', '08:25:56', '08:52:54', '', ''),
(6, 'Jobert Gosuico Simbre', '2022-11-11', '08:47:07', '08:52:54', '', ''),
(7, 'Jobert Gosuico Simbre', '2022-11-11', '08:47:19', '08:52:54', '', ''),
(8, 'Jobert Gosuico Simbre', '2022-11-11', '08:48:39', '08:52:54', '', ''),
(9, 'Jobert Gosuico Simbre', '2022-11-11', '09:06:08', '09:06:17', '', ''),
(10, 'Jobert Gosuico Simbre', '2022-11-11', '09:22:46', '09:23:03', '', ''),
(11, 'Jobert Gosuico Simbre', '2022-11-11', '16:38:51', '16:39:42', '', ''),
(12, 'Jobert Gosuico Simbre', '2022-11-11', '17:47:05', '17:47:09', '', ''),
(13, 'Jobert Gosuico Simbre', '2022-11-11', '17:47:17', '17:47:21', '', ''),
(14, 'Jobert Gosuico Simbre', '2022-11-11', '17:47:25', '17:47:36', '', ''),
(15, 'Jobert Gosuico Simbre', '2022-11-11', '17:47:44', '17:47:52', '', ''),
(16, 'Jobert Gosuico Simbre', '2022-11-11', '17:47:54', '17:47:58', '', ''),
(17, 'Jobert Gosuico Simbre', '2022-11-11', '17:48:10', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `class_list`
--

CREATE TABLE `class_list` (
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rfid`
--

CREATE TABLE `rfid` (
  `id` int(11) NOT NULL,
  `cardid` varchar(250) NOT NULL,
  `logdate` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rfid`
--

INSERT INTO `rfid` (`id`, `cardid`, `logdate`) VALUES
(37, '2348130', '1667893879'),
(38, '2348130', '1667893885');

-- --------------------------------------------------------

--
-- Table structure for table `rfid_card`
--

CREATE TABLE `rfid_card` (
  `card_id` int(11) NOT NULL,
  `card_number` int(11) NOT NULL,
  `status` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rfid_card`
--

INSERT INTO `rfid_card` (`card_id`, `card_number`, `status`) VALUES
(1, 1390710, ''),
(2, 2348130, '');

-- --------------------------------------------------------

--
-- Table structure for table `studentclasses_list`
--

CREATE TABLE `studentclasses_list` (
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `student_id` int(11) NOT NULL,
  `student_firstname` tinytext NOT NULL,
  `student_middlename` tinytext NOT NULL,
  `student_lastname` tinytext NOT NULL,
  `year_group` tinyint(4) DEFAULT NULL,
  `department` tinytext DEFAULT NULL,
  `section` tinytext DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`student_id`, `student_firstname`, `student_middlename`, `student_lastname`, `year_group`, `department`, `section`, `image`) VALUES
(85, 'Jobert', 'Gosuico', 'Simbre', NULL, 'BSIT', NULL, NULL),
(100, 'Student', 'Uno', 'One', NULL, 'BSIT', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject_list`
--

CREATE TABLE `subject_list` (
  `subject_id` int(11) NOT NULL,
  `subject_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_list`
--

CREATE TABLE `teacher_list` (
  `teacher_id` int(11) NOT NULL,
  `teacher_firstname` tinytext NOT NULL,
  `teacher_middlename` tinytext NOT NULL,
  `teacher_lastname` tinytext NOT NULL,
  `subject_taught` tinytext DEFAULT NULL,
  `department` tinytext DEFAULT NULL,
  `rfid_card_id` int(11) DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_list`
--

CREATE TABLE `user_list` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `position` tinytext DEFAULT NULL,
  `card_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_list`
--

INSERT INTO `user_list` (`id`, `username`, `password`, `email`, `create_at`, `position`, `card_number`) VALUES
(57, 'admin', '$2y$10$jCBPKsCOVo6LKlMHZDOZdOHQ.7Lo3Z2e6ZkLyeYDxI63f7qOfZE0K', 'admin@example.com', '2022-11-01 05:24:14', 'Administrator', 0),
(85, 'qwertys', '$2y$10$WfEkBJBwC3M15dr7V3mI7uZKACqs7xvEIRsFGOmJsDfOagmWf8EPy', 'jobert.simbre14@gmail.com', '2022-11-01 05:23:44', 'Student', 2348130),
(100, 'student1', '$2y$10$7s74YKI7a4enaGpkUvDCv.UFzZCdZhuemZlxZCZO5u2vJV7g8LXFu', 'student1@example.com', '2022-11-10 13:15:46', 'Student', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_list`
--
ALTER TABLE `class_list`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `rfid`
--
ALTER TABLE `rfid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rfid_card`
--
ALTER TABLE `rfid_card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `studentclasses_list`
--
ALTER TABLE `studentclasses_list`
  ADD KEY `class_id` (`class_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subject_list`
--
ALTER TABLE `subject_list`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher_list`
--
ALTER TABLE `teacher_list`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rfid`
--
ALTER TABLE `rfid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `rfid_card`
--
ALTER TABLE `rfid_card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject_list`
--
ALTER TABLE `subject_list`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_list`
--
ALTER TABLE `user_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_list`
--
ALTER TABLE `student_list`
  ADD CONSTRAINT `student_id_fk` FOREIGN KEY (`student_id`) REFERENCES `user_list` (`id`);

--
-- Constraints for table `teacher_list`
--
ALTER TABLE `teacher_list`
  ADD CONSTRAINT `teacher_id_fk` FOREIGN KEY (`teacher_id`) REFERENCES `user_list` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
