-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2020 at 08:44 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dating_web_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `dislike_users`
--

CREATE TABLE `dislike_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dislike_by` int(10) UNSIGNED NOT NULL,
  `dislike_to` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dislike_users`
--

INSERT INTO `dislike_users` (`id`, `dislike_by`, `dislike_to`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2020-09-04 09:16:06', '2020-09-04 09:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `like_users`
--

CREATE TABLE `like_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `like_by` int(10) UNSIGNED NOT NULL,
  `like_to` int(10) UNSIGNED NOT NULL,
  `match_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `like_users`
--

INSERT INTO `like_users` (`id`, `like_by`, `like_to`, `match_status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2020-09-04 05:30:30', '2020-09-04 09:32:43'),
(2, 1, 3, 0, '2020-09-04 09:16:12', '2020-09-04 09:16:12'),
(3, 1, 5, 0, '2020-09-04 09:20:12', '2020-09-04 09:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `long` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `user_id`, `name`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '23.23064330', '90.94862230', '2020-09-02 14:32:07', '2020-09-02 14:32:07'),
(2, 2, NULL, '23.12820500', '90.97182300', '2020-09-02 14:32:07', '2020-09-02 14:32:07'),
(3, 3, NULL, '23.12781000', '90.96984800', '2020-09-02 14:32:07', '2020-09-02 14:32:07'),
(4, 4, NULL, '23.81033100', '90.41252100', '2020-09-02 14:32:07', '2020-09-02 14:32:07'),
(5, 5, NULL, '23.05779300', '90.97251100', '2020-09-02 14:32:07', '2020-09-02 14:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2020_09_02_185045_create_locations_table', 1),
(9, '2020_09_04_062951_create_like_users_table', 2),
(10, '2020_09_04_063258_create_dislike_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` datetime NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `image`, `gender`, `password`, `dob`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'REZAUL ALAM', 'oni.cse21@gmail.com', NULL, '1599232172Oni_PP.jpg', 'male', '$2y$10$NuQmfeAiCCvMWO.Yty/CguXdM9cNWFO1flnc/Fe7nETuGQQNDf0G.', '1996-03-10 00:00:00', 'TiJy6nFRWx8WQRAyj7ZJNI9eNmYUmorsvwbK6xR8mTliEFKlPtDOKqFZAhNr', '2020-09-02 14:32:07', '2020-09-04 09:09:33'),
(2, 'Oni', 'oni@gmail.com', NULL, 'default.png', 'male', '$2y$10$NuQmfeAiCCvMWO.Yty/CguXdM9cNWFO1flnc/Fe7nETuGQQNDf0G.', '1990-03-10 00:00:00', 'qjxkh7q0PudfvzDv6J3yNDbo9ptjj8d1Q1FPlvxpJW0w9A0YjVO9VgcI4e47', '2020-09-02 14:32:07', '2020-09-02 14:32:07'),
(3, 'ALAM', 'se21@gmail.com', NULL, 'default.png', 'male', '$2y$10$NuQmfeAiCCvMWO.Yty/CguXdM9cNWFO1flnc/Fe7nETuGQQNDf0G.', '2010-03-10 00:00:00', 'qjxkh7q0PudfvzDv6J3yNDbo9ptjj8d1Q1FPlvxpJW0w9A0YjVO9VgcI4e47', '2020-09-02 14:32:07', '2020-09-02 14:32:07'),
(4, 'Zilani', 'zilani@gmail.com', NULL, 'default.png', 'male', '$2y$10$NuQmfeAiCCvMWO.Yty/CguXdM9cNWFO1flnc/Fe7nETuGQQNDf0G.', '1991-03-10 00:00:00', 'qjxkh7q0PudfvzDv6J3yNDbo9ptjj8d1Q1FPlvxpJW0w9A0YjVO9VgcI4e47', '2020-09-02 14:32:07', '2020-09-02 14:32:07'),
(5, 'Zilani Oni', 'zilani333@gmail.com', NULL, 'default.png', 'male', '$2y$10$NuQmfeAiCCvMWO.Yty/CguXdM9cNWFO1flnc/Fe7nETuGQQNDf0G.', '2000-03-19 00:00:00', 'qjxkh7q0PudfvzDv6J3yNDbo9ptjj8d1Q1FPlvxpJW0w9A0YjVO9VgcI4e47', '2020-09-02 14:32:07', '2020-09-02 14:32:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dislike_users`
--
ALTER TABLE `dislike_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dislike_users_dislike_by_foreign` (`dislike_by`),
  ADD KEY `dislike_users_dislike_to_foreign` (`dislike_to`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_users`
--
ALTER TABLE `like_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `like_users_like_by_foreign` (`like_by`),
  ADD KEY `like_users_like_to_foreign` (`like_to`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locations_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dislike_users`
--
ALTER TABLE `dislike_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `like_users`
--
ALTER TABLE `like_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dislike_users`
--
ALTER TABLE `dislike_users`
  ADD CONSTRAINT `dislike_users_dislike_by_foreign` FOREIGN KEY (`dislike_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dislike_users_dislike_to_foreign` FOREIGN KEY (`dislike_to`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `like_users`
--
ALTER TABLE `like_users`
  ADD CONSTRAINT `like_users_like_by_foreign` FOREIGN KEY (`like_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `like_users_like_to_foreign` FOREIGN KEY (`like_to`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
