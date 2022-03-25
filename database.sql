-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 06:19 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trello`
--

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `set_time` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`id`, `name`, `set_time`, `created_at`, `updated_at`) VALUES
(3, 'SUF', '09:49', '2022-03-24 09:52:44', '2022-03-24 23:48:37'),
(6, 'Office', NULL, '2022-03-24 21:39:12', '2022-03-24 21:39:12'),
(7, 'Admin', NULL, '2022-03-24 21:57:41', '2022-03-24 21:57:41'),
(8, 'Web Development Projects', '10:14', '2022-03-25 00:04:51', '2022-03-25 00:13:31'),
(9, 'Mobile App Development', NULL, '2022-03-25 00:11:30', '2022-03-25 00:11:30');

-- --------------------------------------------------------

--
-- Table structure for table `board_users`
--

CREATE TABLE `board_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `board_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `creator` int(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `board_users`
--

INSERT INTO `board_users` (`id`, `board_id`, `user_id`, `creator`, `created_at`, `updated_at`) VALUES
(3, 3, 4, 1, '2022-03-24 09:52:44', '2022-03-24 09:52:44'),
(6, 3, 7, 1, '2022-03-24 21:39:12', '2022-03-24 21:39:12'),
(7, 6, 4, 0, NULL, NULL),
(8, 7, 4, 1, '2022-03-24 21:57:41', '2022-03-24 21:57:41'),
(9, 3, 6, 0, '2022-03-24 23:18:42', '2022-03-24 23:18:42'),
(10, 3, 5, 0, '2022-03-24 23:20:08', '2022-03-24 23:20:08'),
(11, 8, 9, 1, '2022-03-25 00:04:51', '2022-03-25 00:04:51'),
(12, 8, 4, 0, '2022-03-25 00:06:05', '2022-03-25 00:06:05'),
(13, 8, 6, 0, '2022-03-25 00:06:39', '2022-03-25 00:06:39'),
(14, 9, 9, 1, '2022-03-25 00:11:30', '2022-03-25 00:11:30'),
(15, 9, 4, 0, '2022-03-25 00:12:19', '2022-03-25 00:12:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Low Priority', NULL, NULL),
(2, 'Medium Priority', NULL, NULL),
(3, 'High Priority', NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(6, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(7, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(8, '2016_06_01_000004_create_oauth_clients_table', 2),
(9, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(10, '2022_03_24_100322_create_boards_table', 3),
(11, '2022_03_24_100329_create_task_lists_table', 3),
(12, '2022_03_24_123226_create_board_users_table', 4),
(13, '2022_03_24_145759_create_tasks_table', 5),
(14, '2022_03_24_150022_create_labels_table', 6),
(15, '2022_03_24_150040_create_task_updates_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('2199a3cd9368ab8e50a8729622fa847fe915e1e797b2bde86f59bc6375e06d14bb26cf424ad41b23', 4, 1, 'WebToken', '[]', 0, '2022-03-24 07:30:05', '2022-03-24 07:30:05', '2023-03-24 12:30:05'),
('27b6bd32612d8266e957b008abe5ebe18a2f5a4b55cef885b90aa8dc350feaa4ca0758f82e08933b', 4, 1, 'WebToken', '[]', 0, '2022-03-24 05:48:31', '2022-03-24 05:48:31', '2023-03-24 10:48:31'),
('51090fa4f03b3a34102054d085fba63023c640553a248fd0952939e0aa27472528c37a6a5fae365f', 4, 1, 'WebToken', '[]', 0, '2022-03-24 05:42:21', '2022-03-24 05:42:21', '2023-03-24 10:42:21'),
('789c59934342c56f25d22e63f1da8da00719b39927768c93aae5c48a3e823b2833c5fd6060396840', 4, 1, 'WebToken', '[]', 0, '2022-03-24 19:44:21', '2022-03-24 19:44:21', '2023-03-25 00:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'jhun6Qats2plJPyXFDE4FnSvynRnIm96QLBhiA8D', NULL, 'http://localhost', 1, 0, 0, '2022-03-24 05:00:49', '2022-03-24 05:00:49'),
(2, NULL, 'Laravel Password Grant Client', 'vuXNs7KCP6w6YxkjULysPcQvwPxGDflglllZ1AM1', 'users', 'http://localhost', 0, 1, 0, '2022-03-24 05:00:49', '2022-03-24 05:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-03-24 05:00:49', '2022-03-24 05:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'MyApp', '9004ad7c5be6873fdcd56df227a900f3b45bda839fc182da35ecf9caa666590d', '[\"*\"]', NULL, '2022-03-24 05:16:45', '2022-03-24 05:16:45'),
(2, 'App\\Models\\User', 3, 'MyApp', '7558dd9e2c950028241b4728da7247d47e047a7d8dcbaccdf98ab979ccf211b4', '[\"*\"]', NULL, '2022-03-24 05:18:21', '2022-03-24 05:18:21'),
(3, 'App\\Models\\User', 4, 'Web Token', '032254b8aa1eb57db964c8db868510cd1348f88bbc96e01ab0b30a94e4c94c0c', '[\"*\"]', NULL, '2022-03-24 05:19:32', '2022-03-24 05:19:32'),
(4, 'App\\Models\\User', 4, 'authToken', '5fc7c47c90d4150fa37c98e12bee2b7caa54e7e13af671e95300a5385049a6bf', '[\"*\"]', NULL, '2022-03-24 05:23:06', '2022-03-24 05:23:06'),
(5, 'App\\Models\\User', 4, 'authToken', 'a450d5cd6e759d52738242a67bf05d45aca4176ae7895127ba3bf18b8fdf2fb5', '[\"*\"]', NULL, '2022-03-24 05:24:00', '2022-03-24 05:24:00'),
(6, 'App\\Models\\User', 4, 'authToken', '0fbe11b6ff8542232e7aa032a2b223fb385d3485531af2b900cb1b7af13db1d1', '[\"*\"]', NULL, '2022-03-24 05:26:16', '2022-03-24 05:26:16'),
(7, 'App\\Models\\User', 4, 'authToken', '7f6598aada79252e8d73c712433daac2675c7ac1ade3f4ad077304e209fe8cdb', '[\"*\"]', NULL, '2022-03-24 05:28:15', '2022-03-24 05:28:15'),
(8, 'App\\Models\\User', 4, 'WebToken', 'bc1ebed8ec51b72c9cbbe622ee1138fdb8fee4a5dd564d72c81f9fd902c577a2', '[\"*\"]', NULL, '2022-03-24 05:35:49', '2022-03-24 05:35:49'),
(9, 'App\\Models\\User', 4, 'WebToken', 'cce2cbbca7ad5e7de80f0f8be5ab3cbc166565b48157de18870e15d7f3521392', '[\"*\"]', NULL, '2022-03-24 05:39:27', '2022-03-24 05:39:27'),
(10, 'App\\Models\\User', 4, 'WebToken', '310530689d0ad5b43a0feea9811506a190f88fb5b0de8ddda866cf7f45cfb594', '[\"*\"]', NULL, '2022-03-24 05:39:58', '2022-03-24 05:39:58'),
(11, 'App\\Models\\User', 4, 'WebToken', '07720c942b7eeb9bd38e237a18b3d20a4c6441f9e963e84e99a331e4fb17ad81', '[\"*\"]', NULL, '2022-03-24 05:40:10', '2022-03-24 05:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `list_id` int(10) NOT NULL,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label_id` int(10) DEFAULT NULL,
  `member_id` int(10) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `list_id`, `title`, `description`, `label_id`, `member_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 'Figma Design or XD', 'Create figma design very well', 1, 5, 4, '2022-03-24 10:13:28', '2022-03-25 00:03:51'),
(2, 1, 'Microsoft Design', 'Microsoft Software Design', NULL, NULL, 4, '2022-03-24 19:44:34', '2022-03-25 00:03:58'),
(3, 2, 'New task for All', 'New task for All', NULL, NULL, 4, '2022-03-24 20:34:16', '2022-03-25 00:03:57'),
(4, 4, 'Testing Awesome', 'Testing Awesome', NULL, 6, 4, '2022-03-24 21:07:58', '2022-03-25 00:03:54'),
(5, 15, 'Design For Website', 'Design For Website', 3, 7, 7, '2022-03-24 21:39:32', '2022-03-24 22:45:19'),
(6, 15, 'Developement Start', NULL, NULL, NULL, 4, '2022-03-24 22:48:39', '2022-03-24 22:48:39'),
(7, 14, 'Developement Start', 'Developement Start', 1, NULL, 4, '2022-03-24 22:48:47', '2022-03-24 22:49:30'),
(8, 22, 'Xd Design For Website', 'Xd Design For Website', 2, 6, 9, '2022-03-25 00:05:25', '2022-03-25 00:08:49'),
(9, 24, 'Design For Developemnt', 'Design For Developemnt', 3, 9, 9, '2022-03-25 00:05:47', '2022-03-25 00:09:42'),
(10, 23, 'QA Require', 'QA Require', 1, 4, 9, '2022-03-25 00:09:14', '2022-03-25 00:09:38'),
(11, 25, 'React Native App', 'XD Designs Require', 1, 4, 9, '2022-03-25 00:11:59', '2022-03-25 00:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `task_lists`
--

CREATE TABLE `task_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `board_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_lists`
--

INSERT INTO `task_lists` (`id`, `name`, `board_id`, `created_at`, `updated_at`) VALUES
(1, 'Todo', 3, '2022-03-24 09:52:44', '2022-03-24 09:52:44'),
(2, 'Progress', 3, '2022-03-24 09:52:44', '2022-03-24 09:52:44'),
(3, 'Code Review', 3, '2022-03-24 09:52:44', '2022-03-24 09:52:44'),
(4, 'Done', 3, '2022-03-24 09:52:44', '2022-03-24 09:52:44'),
(5, 'Todo', 4, '2022-03-24 21:38:49', '2022-03-24 21:38:49'),
(6, 'Progress', 4, '2022-03-24 21:38:49', '2022-03-24 21:38:49'),
(7, 'Code Review', 4, '2022-03-24 21:38:49', '2022-03-24 21:38:49'),
(8, 'Done', 4, '2022-03-24 21:38:50', '2022-03-24 21:38:50'),
(9, 'Todo', 5, '2022-03-24 21:38:59', '2022-03-24 21:38:59'),
(10, 'Progress', 5, '2022-03-24 21:38:59', '2022-03-24 21:38:59'),
(11, 'Code Review', 5, '2022-03-24 21:38:59', '2022-03-24 21:38:59'),
(12, 'Done', 5, '2022-03-24 21:38:59', '2022-03-24 21:38:59'),
(13, 'Todo', 6, '2022-03-24 21:39:12', '2022-03-24 21:39:12'),
(14, 'Progress', 6, '2022-03-24 21:39:12', '2022-03-24 21:39:12'),
(15, 'Code Review', 6, '2022-03-24 21:39:12', '2022-03-24 21:39:12'),
(16, 'Done', 6, '2022-03-24 21:39:12', '2022-03-24 21:39:12'),
(17, 'Todo', 7, '2022-03-24 21:57:41', '2022-03-24 21:57:41'),
(18, 'Progress', 7, '2022-03-24 21:57:42', '2022-03-24 21:57:42'),
(19, 'Code Review', 7, '2022-03-24 21:57:42', '2022-03-24 21:57:42'),
(20, 'Done', 7, '2022-03-24 21:57:42', '2022-03-24 21:57:42'),
(21, 'Todo', 8, '2022-03-25 00:04:51', '2022-03-25 00:04:51'),
(22, 'Progress', 8, '2022-03-25 00:04:51', '2022-03-25 00:04:51'),
(23, 'Code Review', 8, '2022-03-25 00:04:52', '2022-03-25 00:04:52'),
(24, 'Done', 8, '2022-03-25 00:04:52', '2022-03-25 00:04:52'),
(25, 'Todo', 9, '2022-03-25 00:11:30', '2022-03-25 00:11:30'),
(26, 'Progress', 9, '2022-03-25 00:11:31', '2022-03-25 00:11:31'),
(27, 'Code Review', 9, '2022-03-25 00:11:31', '2022-03-25 00:11:31'),
(28, 'Done', 9, '2022-03-25 00:11:31', '2022-03-25 00:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `task_updates`
--

CREATE TABLE `task_updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `updateText` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_updates`
--

INSERT INTO `task_updates` (`id`, `updateText`, `task_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'New Update Here..', 1, 5, NULL, NULL),
(2, 'All Data Complete', 2, 4, '2022-03-24 21:06:15', '2022-03-24 21:06:15'),
(3, 'Good Awesome', 3, 4, '2022-03-24 21:07:39', '2022-03-24 21:07:39'),
(4, 'Working Very Well', 4, 4, '2022-03-24 21:08:08', '2022-03-24 21:08:08'),
(5, 'Early Complete this project', 5, 7, '2022-03-24 21:39:45', '2022-03-24 21:39:45'),
(6, 'Work Progress', 8, 9, '2022-03-25 00:07:51', '2022-03-25 00:07:51'),
(7, 'This is development', 9, 9, '2022-03-25 00:08:23', '2022-03-25 00:08:23'),
(8, 'Whats the update', 11, 9, '2022-03-25 00:12:33', '2022-03-25 00:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Syed Umer', 'Fayyaz', 'admin@gmail.com', NULL, '$2y$10$MPKubb118rVDykcqYpRyTedHBmF0RU6JDNaHygZ4MHVmZiOU8ChFW', NULL, '2022-03-24 05:19:32', '2022-03-24 05:19:32'),
(5, 'Jazzel', 'Ali', 'admin1@gmail.com', NULL, '$2y$10$l19YDrHDgO/S18.LOmA6Du4DMPEP1TpNGYpk3lIAX1loWcgx8Gevm', NULL, '2022-03-24 10:23:51', '2022-03-24 10:23:51'),
(6, 'shahyar', 'Ali', 'admin2@gmail.com', NULL, '$2y$10$BQtyX/0WLe3jhhvjMEeqUucioAiNhhSKWiNklaP7Dz2GcubKulcLy', NULL, '2022-03-24 21:17:47', '2022-03-24 21:17:47'),
(7, 'Javed', 'Ali', 'admin3@gmail.com', NULL, '$2y$10$bXWsve5GoSFLa.aV6ipfheFLkLfYti0JS6iZO/qKNKvDMqllbp4Um', NULL, '2022-03-24 21:18:19', '2022-03-24 21:18:19'),
(8, 'Ali', 'Khan', 'ali@gmail.com', NULL, '$2y$10$vfT4j1669cMRHomls4yxMOACNpcczeq6QSudp48NZPCc3xINClh.m', NULL, '2022-03-24 23:54:59', '2022-03-24 23:54:59'),
(9, 'Abdul', 'Rafay', 'rafay@gmail.com', NULL, '$2y$10$N1/Q4JAL857u2xoYyGx4seji5XT2KKhGEBbFFMeGm/K9rL7HGDz6O', NULL, '2022-03-25 00:04:18', '2022-03-25 00:04:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `board_users`
--
ALTER TABLE `board_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_lists`
--
ALTER TABLE `task_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_updates`
--
ALTER TABLE `task_updates`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `board_users`
--
ALTER TABLE `board_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `task_lists`
--
ALTER TABLE `task_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `task_updates`
--
ALTER TABLE `task_updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
