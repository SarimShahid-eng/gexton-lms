-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2025 at 09:01 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livewire_alpine_bootstrap`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch_groups`
--

CREATE TABLE `batch_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` int DEFAULT NULL,
  `teacher_id` int DEFAULT NULL,
  `from` time DEFAULT NULL,
  `to` time DEFAULT NULL,
  `session_year_id` bigint DEFAULT NULL,
  `group_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_completed` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch_groups`
--

INSERT INTO `batch_groups` (`id`, `course_id`, `teacher_id`, `from`, `to`, `session_year_id`, `group_name`, `is_completed`, `created_at`, `updated_at`) VALUES
(1, 20, 3, '04:08:00', '22:14:00', 13, 'Web Development Saeed Iqbal', 0, '2025-05-20 18:09:03', '2025-05-20 18:09:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch_groups`
--
ALTER TABLE `batch_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch_groups`
--
ALTER TABLE `batch_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
