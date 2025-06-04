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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `user_type` enum('admin','teacher','student') COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_year_id` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `phone`, `email`, `password`, `is_active`, `user_type`, `session_year_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sarim Shahid', 'Morissette', '1-251-393-5784', 'admin@example.com', '$2y$12$U8hWXm5sEH3Z96/zOKUgJOtn/bybz.2rdZWeDnIEkFB.jZrG5mhT6', '0', 'admin', 13, 'SrxcoplJld64yBuexpSAf4DvztGeYYyaWh6v95OK209i7DdajkvWquQnJNab', '2025-05-20 18:06:37', '2025-05-20 18:06:37'),
(2, 'Sarim', 'Shahid', '03130459255', 'sarimshah3234@gmail.com', '$2y$12$VELHaKmNgfO2gXiFXYn5AOxxzjzfJGLTeMJgZZoKfO46L25mMoJlm', '1', 'student', 1, NULL, '2025-05-20 18:09:51', '2025-05-20 18:09:51'),
(3, 'teacher', 'latest', '030377888732', 'teacher34@gmail.com', '$2y$10$6Le/oEBFcKjyFL89ovy25OTVHHrtClivl7JS9DgvE4QtkMN9XObT.', '1', 'teacher', 13, NULL, '2025-05-20 11:12:01', '2025-05-20 11:12:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_session_year_id_foreign` (`session_year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_session_year_id_foreign` FOREIGN KEY (`session_year_id`) REFERENCES `custom_sessions` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
