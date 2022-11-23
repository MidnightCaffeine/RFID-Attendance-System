-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 23, 2022 at 06:46 PM
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
  `time_out` time NOT NULL,
  `remark` tinytext NOT NULL,
  `instructor` tinytext NOT NULL,
  `subject` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `fullname`, `date_in`, `time_in`, `time_out`, `remark`, `instructor`, `subject`) VALUES
(63, 'Jobert Gosuico Simbre', '2022-11-22', '10:53:38', '10:53:54', 'On Time', 'Teacher Instructor Example', ''),
(64, 'Jobert Gosuico Simbre', '2022-11-22', '11:19:09', '11:19:20', 'Late', 'Teacher Instructor Example', ''),
(65, 'Jobert Gosuico Simbre', '2022-11-22', '11:32:45', '11:34:43', 'On Time', 'Teacher Instructor Example', ''),
(66, 'Jobert Gosuico Simbre', '2022-11-22', '11:36:14', '01:43:08', 'On Time', 'Teacher Instructor Example', ''),
(67, 'Jobert Gosuico Simbre', '2022-11-23', '11:16:10', '00:00:00', 'On Time', 'Teacher Instructor Example', ''),
(68, 'Jobert Gosuico Simbre', '2022-11-24', '12:10:36', '12:21:41', 'On Time', 'Teacher Instructor Example', ''),
(69, 'Jobert Gosuico Simbre', '2022-11-24', '12:24:54', '12:32:40', 'On Time', 'Teacher Instructor Example', ''),
(70, 'Jobert Gosuico Simbre', '2022-11-24', '12:32:44', '12:33:20', 'Late', 'Teacher Instructor Example', ''),
(71, 'Jobert Gosuico Simbre', '2022-11-24', '12:33:24', '12:34:00', 'Late', 'Teacher Instructor Example', ''),
(72, 'Jobert Gosuico Simbre', '2022-11-24', '12:34:09', '12:42:16', 'Late', 'Teacher Instructor Example', ''),
(73, 'Jobert Gosuico Simbre', '2022-11-24', '12:42:22', '12:42:44', 'Late', 'Teacher Instructor Example', ''),
(74, 'Jobert Gosuico Simbre', '2022-11-24', '12:42:52', '12:45:37', 'Late', 'Teacher Instructor Example', ''),
(75, 'Jobert Gosuico Simbre', '2022-11-24', '12:45:48', '12:46:33', 'Late', 'Teacher Instructor Example', ''),
(76, 'Jobert Gosuico Simbre', '2022-11-24', '12:46:45', '12:53:14', 'Late', 'Teacher Instructor Example', ''),
(77, 'Jobert Gosuico Simbre', '2022-11-24', '12:53:24', '01:05:25', 'Late', 'Teacher Instructor Example', ''),
(78, 'Jobert Gosuico Simbre', '2022-11-24', '01:05:33', '01:06:13', 'On Time', 'Teacher Instructor Example', ''),
(79, 'Jobert Gosuico Simbre', '2022-11-24', '01:06:23', '01:15:32', 'On Time', 'Teacher Instructor Example', ''),
(80, 'Jobert Gosuico Simbre', '2022-11-24', '01:15:46', '00:00:00', 'On Time', 'Teacher Instructor Example', '');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_instructor`
--

CREATE TABLE `attendance_instructor` (
  `id` int(11) NOT NULL,
  `fullname` tinytext NOT NULL,
  `date_in` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `remark` tinytext NOT NULL,
  `subject` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_instructor`
--

INSERT INTO `attendance_instructor` (`id`, `fullname`, `date_in`, `time_in`, `time_out`, `remark`, `subject`) VALUES
(8, 'Teacher Instructor Example', '2022-11-22', '10:45:43', '11:36:29', '', ''),
(9, 'Teacher Instructor Example', '2022-11-22', '11:19:50', '11:36:24', '', ''),
(10, 'Teacher Instructor Example', '2022-11-22', '11:20:29', '11:35:52', '', ''),
(11, 'Teacher Instructor Example', '2022-11-22', '11:22:04', '11:35:29', '', ''),
(12, 'Teacher Instructor Example', '2022-11-22', '11:23:21', '11:33:58', '', ''),
(13, 'Teacher Instructor Example', '2022-11-22', '11:23:39', '11:33:11', '', ''),
(14, 'Teacher Instructor Example', '2022-11-24', '12:10:16', '00:00:00', '', '');

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
(38, '2348130', '1667893885'),
(39, '2250590', '1669207403'),
(40, '1609090', '1669207460'),
(41, '1606890', '1669207493'),
(42, '1855000', '1669207519'),
(43, '2152890', '1669207546'),
(44, '2049790', '1669207578'),
(45, '2111690', '1669207642'),
(46, '1717590', '1669207673'),
(47, '1716400', '1669207702'),
(48, '1768290', '1669207721'),
(49, '2348130', '1669207745');

-- --------------------------------------------------------

--
-- Table structure for table `rfid_card`
--

CREATE TABLE `rfid_card` (
  `card_id` int(11) NOT NULL,
  `card_number` int(11) NOT NULL,
  `card_status` tinytext NOT NULL,
  `card_holder` tinytext NOT NULL,
  `card_holder_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rfid_card`
--

INSERT INTO `rfid_card` (`card_id`, `card_number`, `card_status`, `card_holder`, `card_holder_id`) VALUES
(2, 2348130, 'Assigned', 'Jobert Padilla Simbre', 0),
(5, 1768290, 'Available', '', 0);

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
  `phone` tinytext NOT NULL,
  `year_group` tinyint(4) DEFAULT NULL,
  `department` tinytext DEFAULT NULL,
  `section` tinytext DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  `guardian_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`student_id`, `student_firstname`, `student_middlename`, `student_lastname`, `phone`, `year_group`, `department`, `section`, `image`, `guardian_email`) VALUES
(113, 'Jobert', 'Gosuico', 'Simbre', '09163218023', 4, 'BSIT', 'AP', NULL, 'ignacio.khiana13@gmail.com');

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
  `rfid_card_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_list`
--

INSERT INTO `teacher_list` (`teacher_id`, `teacher_firstname`, `teacher_middlename`, `teacher_lastname`, `subject_taught`, `department`, `rfid_card_id`) VALUES
(112, 'Teacher', 'Instructor', 'Example', NULL, 'BSIT', NULL);

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
(112, 'teacher1', '$2y$10$IdMRLy901/MBIZ6wl5Ntm.I/5WX/VrzLJUYHRFCqWUKTb71Gb1Hea', 'kljokas@gmail.com', '2022-11-23 16:09:04', 'Instructor', 1768290),
(113, 'student1', '$2y$10$qq4vFOTeyJJItoaaVtVrg..7CGmtB2PMsZcyI.t6qBxFded7bbV/W', 'asdasdas@gmail.com', '2022-11-18 01:21:03', 'Student', 2348130);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_instructor`
--
ALTER TABLE `attendance_instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_list`
--
ALTER TABLE `class_list`
  ADD PRIMARY KEY (`class_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `attendance_instructor`
--
ALTER TABLE `attendance_instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rfid`
--
ALTER TABLE `rfid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `rfid_card`
--
ALTER TABLE `rfid_card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subject_list`
--
ALTER TABLE `subject_list`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_list`
--
ALTER TABLE `user_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

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
