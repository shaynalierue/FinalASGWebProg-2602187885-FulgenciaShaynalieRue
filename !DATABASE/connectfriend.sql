-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 11:22 AM
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
-- Database: `connectfriend`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE `avatars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avatars`
--

INSERT INTO `avatars` (`id`, `name`, `price`, `path`, `created_at`, `updated_at`) VALUES
(1, 'Avatar 1', 89422, '/assets/images/avatar/1.jpg', '2025-01-09 02:44:17', '2025-01-09 02:44:17'),
(2, 'Avatar 2', 1000, '/assets/images/avatar/2.jpg', '2025-01-09 02:44:17', '2025-01-09 02:44:17'),
(3, 'Avatar 3', 50, '/assets/images/avatar/3.jpg', '2025-01-09 02:44:17', '2025-01-09 02:44:17'),
(4, 'Avatar 4', 26780, '/assets/images/avatar/4.jpg', '2025-01-09 02:44:17', '2025-01-09 02:44:17'),
(5, 'Avatar 5', 94066, '/assets/images/avatar/5.jpg', '2025-01-09 02:44:17', '2025-01-09 02:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `avatar_transactions`
--

CREATE TABLE `avatar_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `avatar_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avatar_transactions`
--

INSERT INTO `avatar_transactions` (`id`, `buyer_id`, `avatar_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2025-01-09 06:51:34', '2025-01-09 06:51:34'),
(2, 1, 2, '2025-01-09 06:51:39', '2025-01-09 06:51:39'),
(3, 13, 4, '2025-01-09 19:02:09', '2025-01-09 19:02:09'),
(4, 13, 3, '2025-01-09 19:29:37', '2025-01-09 19:29:37'),
(5, 13, 2, '2025-01-09 19:46:34', '2025-01-09 19:46:34'),
(6, 12, 3, '2025-01-10 02:56:41', '2025-01-10 02:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `sender_id`, `receiver_id`, `message`, `seen`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 's', 0, '2025-01-09 06:13:25', '2025-01-09 06:13:25'),
(2, 6, 1, 'yoooooo', 1, '2025-01-09 06:14:58', '2025-01-09 06:40:48'),
(3, 3, 13, 'yoooooo', 1, '2025-01-09 19:03:38', '2025-01-09 19:39:00'),
(4, 3, 13, 'hei', 0, '2025-01-09 19:49:12', '2025-01-09 19:49:12'),
(5, 3, 11, 'bro', 0, '2025-01-09 19:49:33', '2025-01-09 19:49:33'),
(6, 6, 14, 'Halo Sule100', 1, '2025-01-09 20:37:20', '2025-01-09 20:38:33'),
(7, 14, 6, 'Yooo Nunung90', 1, '2025-01-09 20:38:33', '2025-01-09 20:38:33'),
(8, 12, 11, 'Suleee lagi ngapaiin', 0, '2025-01-10 03:01:46', '2025-01-10 03:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `field_of_works`
--

CREATE TABLE `field_of_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `field_of_works`
--

INSERT INTO `field_of_works` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Technology', '2025-01-09 02:44:17', '2025-01-09 02:44:17'),
(2, 'Marketing', '2025-01-09 02:44:17', '2025-01-09 02:44:17'),
(3, 'Design', '2025-01-09 02:44:17', '2025-01-09 02:44:17'),
(4, 'Business', '2025-01-09 02:44:17', '2025-01-09 02:44:17'),
(5, 'Sales', '2025-01-09 02:44:17', '2025-01-09 02:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Pending','Accepted','Declined') NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `sender_id`, `receiver_id`, `status`, `seen`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Accepted', 1, '2025-01-09 04:53:13', '2025-01-09 04:59:43'),
(2, 1, 6, 'Accepted', 1, '2025-01-09 06:12:43', '2025-01-09 06:14:38'),
(3, 13, 3, 'Accepted', 1, '2025-01-09 19:02:39', '2025-01-09 19:03:29'),
(4, 11, 3, 'Accepted', 1, '2025-01-09 19:48:35', '2025-01-09 19:49:03'),
(5, 14, 3, 'Pending', 0, '2025-01-09 20:34:23', '2025-01-09 20:34:23'),
(6, 14, 6, 'Accepted', 1, '2025-01-09 20:35:17', '2025-01-09 20:36:16'),
(7, 11, 12, 'Accepted', 1, '2025-01-10 02:54:52', '2025-01-10 02:59:20');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_03_155155_create_friends_table', 1),
(5, '2025_01_04_163558_create_avatars_table', 1),
(6, '2025_01_04_163833_create_avatar_transactions_table', 1),
(7, '2025_01_06_045702_create_chats_table', 1),
(8, '2025_01_09_093110_create_field_of_works_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0xWVTMWNYJM7aEGOdT5N6yd1F0t3K2CfSpZE24gW', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidEZNV0ZOczJpcGZqWW1ObXZDQ21Cc1lKblRoVE5wTlAyVWRKZ1ZhTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGF0LzExIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTI7czo2OiJsb2NhbGUiO3M6MjoiZW4iO30=', 1736503493);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `linkedin_username` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `coin` int(11) NOT NULL DEFAULT 100,
  `profile_picture` varchar(255) DEFAULT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `linkedin_username`, `phone_number`, `coin`, `profile_picture`, `visibility`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nunung3', 'Nunung3@gmail.com', '$2y$12$CQhSmLMs7sxMvOkKHUBzgeDzqa6ZywuorcVYYjb7i5Jj2r5O7MFtO', 'Male', 'https://www.linkedin.com/in/drake19', '087770356340', 1390, '/assets/images/avatar/2.jpg', 0, NULL, '2025-01-09 03:09:45', '2025-01-09 18:19:02'),
(2, 'Nunung1@gmail.com', 'Nunung1@gmail.com', '$2y$12$kavPGR1byiNtG8B82zqU7.0dooApsJ4CW5ODCZAvVqKlJRVOiY.ny', 'Female', 'https://www.linkedin.com/in/drake11', '087770356349', 2500, NULL, 1, NULL, '2025-01-09 03:10:57', '2025-01-09 05:37:15'),
(3, 'Nunung5', 'Nunung5@gmail.com', '$2y$12$JD22cFV7TQk210N7n1lAlukL4jvOn/E8XeHf.yPmt90rsUUgEbdVq', 'Female', 'https://www.linkedin.com/in/drake14', '087770356389', 100100, NULL, 1, NULL, '2025-01-09 05:10:24', '2025-01-09 05:10:24'),
(4, 'Nunung6', 'Nunung6@gmail.com', '$2y$12$sij5sxG5YGqVx7kcS9EOx.bHvvAb/itVfL4cD4KICETWhcRh/Z08i', 'Female', 'https://www.linkedin.com/in/drake13', '087770356344', 100, NULL, 1, NULL, '2025-01-09 05:11:02', '2025-01-09 05:11:02'),
(5, 'Nunung7', 'Nunung7@gmail.com', '$2y$12$IlVbIvJor4FJhqDGuGOkZuCYnjgJZkaRWeJlhGHf2ShCpmwXARVlu', 'Male', 'https://www.linkedin.com/in/drake20', '087770356341', 200100, NULL, 1, NULL, '2025-01-09 05:11:40', '2025-01-09 05:11:40'),
(6, 'Nunung90', 'Nunung90@gmail.com', '$2y$12$R/N7HNxxlbpyx7x/jiTzhuhT76TBLbBmNbwoOQNZqZ9h2xn2aNZxC', 'Female', 'https://www.linkedin.com/in/drake90', '087770356350', 400100, NULL, 1, NULL, '2025-01-09 05:30:18', '2025-01-09 05:30:18'),
(7, 'Nunung67', 'Nunung67@gmail.com', '$2y$12$knI5I06Rzsz22l6Oec7TkOWlbHTPnpVp7oksYXZ/3rs6wdEeBnsvi', 'Female', 'https://www.linkedin.com/in/drake99', '087770356359', 100, NULL, 1, NULL, '2025-01-09 05:30:49', '2025-01-09 05:30:49'),
(8, 'Nunung77', 'Nunung77@gmail.com', '$2y$12$E3uqNxYxewTf1Ozamd4CUuYA6LGO0VbjU56UDmdW897mtSIINYC46', 'Male', 'https://www.linkedin.com/in/drake100', '087770356343', 100, NULL, 1, NULL, '2025-01-09 18:34:52', '2025-01-09 18:34:52'),
(9, 'Nunung1111', 'Nunung1111@gmail.com', '$2y$12$reXN7p9l3J0erb4Y1bZOm.bO9k9wCxHSYeC9dmBb4CJB0CAz1pUKC', 'Female', 'https://www.linkedin.com/in/cormiercasandras', '087770356345', 101, NULL, 1, NULL, '2025-01-09 18:49:36', '2025-01-09 18:49:36'),
(10, 'Nunung190', 'Nunung190@gmail.com', '$2y$12$XYkjMhfqPoFFc4QNwSyJGOTnDShzkEu2xunU.LaSQDQtRyOaSX0A.', 'Male', 'https://www.linkedin.com/in/sdrake16', '087770356347', 101, NULL, 1, NULL, '2025-01-09 18:53:59', '2025-01-09 18:53:59'),
(11, 'Sule1', 'Sule1@gmail.com', '$2y$12$JR8RuSOK6w5nQ8ghVIu9IO7g/Z7TkqQjopOngZnHb2I.hpIfztncW', 'Male', 'https://www.linkedin.com/in/drakse16', '087770356347', 202, NULL, 1, NULL, '2025-01-09 18:54:46', '2025-01-09 19:47:32'),
(12, 'Sule3', 'Sule3@gmail.com', '$2y$12$ngLjD5FcmBgz2dPgeVdbEekul4T/2XsjQZZchlvpdZ9Jrvyj5FeVS', 'Male', 'https://www.linkedin.com/in/cormierssandras', '087770356347', 50, '/assets/images/avatar/3.jpg', 1, NULL, '2025-01-09 18:58:37', '2025-01-10 02:56:59'),
(13, 'Sule4', 'Sule4@gmail.com', '$2y$12$yYCxmaOWJhdiDiaCSvnTb.WpHlvcFZKOtfZoZVEtz30LqkqYwRuPi', 'Male', 'https://www.linkedin.com/in/cormiercasssandra', '087770356347', 772008, '/assets/images/avatar/3.jpg', 1, NULL, '2025-01-09 19:00:31', '2025-01-09 19:46:34'),
(14, 'Sule100', 'Sule100@gmail.com', '$2y$12$PZrLPSeoaLVi1JEemAP0MeqDq5K8CDAB6VgN75WxchA6irkPbk8EW', 'Male', 'https://www.linkedin.com/in/draksse12', '087770356378', 100100, NULL, 1, NULL, '2025-01-09 20:27:24', '2025-01-09 20:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_field_of_works`
--

CREATE TABLE `user_field_of_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `field_of_work_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_field_of_works`
--

INSERT INTO `user_field_of_works` (`id`, `user_id`, `field_of_work_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 2, 3, NULL, NULL),
(5, 2, 4, NULL, NULL),
(6, 2, 5, NULL, NULL),
(7, 3, 2, NULL, NULL),
(8, 3, 3, NULL, NULL),
(9, 3, 4, NULL, NULL),
(10, 4, 2, NULL, NULL),
(11, 4, 3, NULL, NULL),
(12, 4, 4, NULL, NULL),
(13, 4, 5, NULL, NULL),
(14, 5, 1, NULL, NULL),
(15, 5, 2, NULL, NULL),
(16, 5, 5, NULL, NULL),
(17, 6, 2, NULL, NULL),
(18, 6, 3, NULL, NULL),
(19, 6, 4, NULL, NULL),
(20, 6, 5, NULL, NULL),
(21, 7, 1, NULL, NULL),
(22, 7, 2, NULL, NULL),
(23, 7, 3, NULL, NULL),
(24, 8, 1, NULL, NULL),
(25, 8, 2, NULL, NULL),
(26, 8, 3, NULL, NULL),
(27, 9, 1, NULL, NULL),
(28, 9, 2, NULL, NULL),
(29, 9, 5, NULL, NULL),
(30, 10, 1, NULL, NULL),
(31, 10, 2, NULL, NULL),
(32, 10, 3, NULL, NULL),
(33, 11, 1, NULL, NULL),
(34, 11, 2, NULL, NULL),
(35, 11, 3, NULL, NULL),
(36, 12, 1, NULL, NULL),
(37, 12, 2, NULL, NULL),
(38, 12, 3, NULL, NULL),
(39, 13, 1, NULL, NULL),
(40, 13, 2, NULL, NULL),
(41, 13, 3, NULL, NULL),
(42, 13, 4, NULL, NULL),
(43, 13, 5, NULL, NULL),
(44, 14, 1, NULL, NULL),
(45, 14, 2, NULL, NULL),
(46, 14, 3, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avatar_transactions`
--
ALTER TABLE `avatar_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avatar_transactions_buyer_id_foreign` (`buyer_id`),
  ADD KEY `avatar_transactions_avatar_id_foreign` (`avatar_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_sender_id_foreign` (`sender_id`),
  ADD KEY `chats_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `field_of_works`
--
ALTER TABLE `field_of_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friends_sender_id_foreign` (`sender_id`),
  ADD KEY `friends_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_field_of_works`
--
ALTER TABLE `user_field_of_works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_field_of_works_user_id_foreign` (`user_id`),
  ADD KEY `user_field_of_works_field_of_work_id_foreign` (`field_of_work_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `avatar_transactions`
--
ALTER TABLE `avatar_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field_of_works`
--
ALTER TABLE `field_of_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_field_of_works`
--
ALTER TABLE `user_field_of_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avatar_transactions`
--
ALTER TABLE `avatar_transactions`
  ADD CONSTRAINT `avatar_transactions_avatar_id_foreign` FOREIGN KEY (`avatar_id`) REFERENCES `avatars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avatar_transactions_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friends_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_field_of_works`
--
ALTER TABLE `user_field_of_works`
  ADD CONSTRAINT `user_field_of_works_field_of_work_id_foreign` FOREIGN KEY (`field_of_work_id`) REFERENCES `field_of_works` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_field_of_works_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
