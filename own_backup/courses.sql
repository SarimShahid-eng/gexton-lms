-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2025 at 11:44 AM
-- Server version: 8.0.39
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gextoned_internship`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint NOT NULL,
  `course_title` varchar(50) DEFAULT NULL,
  `course_description` text,
  `Duration` varchar(60) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `session_year_id` bigint DEFAULT NULL,
  `test_time` time NOT NULL DEFAULT '00:00:00',
  `questions_limit` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_title`, `course_description`, `Duration`, `created_date`, `session_year_id`, `test_time`, `questions_limit`) VALUES
(1, 'Web Development', 'Internship for Web Development ', '6 Weeks', '2018-06-08 17:46:13', 1, '00:00:00', 1),
(2, 'Graphic Designing', 'Internship for Graphic', '6 Weeks', '2018-06-08 17:46:54', 1, '00:00:00', 1),
(3, 'Search Engine Optimization ', 'internship for seo', '6 Weeks', '2018-06-09 13:39:09', 1, '00:00:00', 1),
(4, 'Web Designing', 'Internship for Web Designing', '6 Weeks', '2018-06-09 14:21:31', 1, '00:00:00', 1),
(5, 'Core Java', 'Internship for core java', '6 Weeks', '2018-06-10 23:21:52', 1, '00:00:00', 1),
(6, 'Android Development', 'Internship for Android ', '6 Weeks', '2018-06-11 00:10:33', 1, '00:00:00', 1),
(7, 'testing email', 'testing email', '1 Week', '2018-06-25 11:46:22', 1, '00:00:00', 1),
(8, 'Computerized Accounting', 'Internship for Computerized Accounting', '6 Weeks', '2018-07-02 17:51:35', 1, '00:00:00', 1),
(16, 'Computerised Accounting', 'No Description', '6 Weeks', '2019-04-11 14:59:21', 13, '00:45:00', 50),
(17, 'Autocad', 'No Description', '6 Weeks', '2019-04-24 12:50:43', 13, '00:45:00', 50),
(18, 'Website Development', 'Internship for Website Development', '6 Weeks', '2022-05-21 15:44:46', 13, '00:45:00', 50),
(19, 'Website Designing', 'Internship for Website Designing', '6 Weeks', '2022-05-21 15:47:38', 13, '00:45:00', 50),
(20, 'Graphic Designing', 'Internship For Graphic Designing', '6 Weeks', '2022-05-21 15:48:47', 13, '00:45:00', 50),
(21, 'Artificial Intelligence', 'Internship in Artificial Intelligence', '6 Weeks', '2022-05-21 15:50:24', 13, '00:45:00', 50),
(22, 'Android App Development', 'Internship in Android App Development', '6 Weeks', '2022-05-30 16:37:46', 13, '00:45:00', 50),
(23, 'Search Engine Optimization', 'Internship Search Engine Optimization', '6 Weeks', '2022-06-01 12:16:09', 13, '00:45:00', 50),
(24, 'Core Java', 'Internship Core Java', '6 Weeks', '2022-06-01 12:24:58', 13, '00:45:00', 50),
(25, 'Python', 'Internship Python', '6 Weeks', '2022-06-01 13:01:50', 13, '00:45:00', 50),
(26, 'Computerized Accounting new', 'Internship Computerized Accounting', '6 Weeks', '2022-06-01 13:05:27', 13, '00:45:00', 50),
(27, 'DUMMY CO', 'INT DUMMY 22', '6 Weeks', '2022-06-16 17:02:38', 13, '01:45:00', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
