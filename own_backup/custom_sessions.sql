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
-- Table structure for table `custom_sessions`
--

CREATE TABLE `custom_sessions` (
  `id` bigint UNSIGNED NOT NULL,
  `session_year` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `is_selected` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_sessions`
--

INSERT INTO `custom_sessions` (`id`, `session_year`, `created_date`, `is_selected`, `created_at`, `updated_at`) VALUES
(1, '2018', '2018-05-30 12:20:01', 0, NULL, NULL),
(9, '2019', '2018-06-08 17:45:22', 0, NULL, NULL),
(10, '2020', '2018-06-29 14:23:56', 0, NULL, NULL),
(11, '2021', '2018-07-23 23:44:51', 0, NULL, NULL),
(12, '2022', '2018-07-24 15:20:51', 0, NULL, NULL),
(13, '2025', '2022-05-20 14:28:27', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `custom_sessions`
--
ALTER TABLE `custom_sessions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `custom_sessions`
--
ALTER TABLE `custom_sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
