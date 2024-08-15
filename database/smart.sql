-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 01:55 PM
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
-- Database: `smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `available_seat` int(11) NOT NULL,
  `capacity_machine` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `image_url`, `code`, `name`, `price`, `color`, `available_seat`, `capacity_machine`, `created_at`, `updated_at`) VALUES
(1, 'Brio Satya.png', 'P1', 'Brio Satya', 187600000, 'Kuningg', 5, 1199, NULL, '2024-07-29 04:22:50'),
(2, 'HR-V.png', 'P2', 'HR-V', 383900000, 'Platinum White Pearl', 5, 1498, NULL, NULL),
(3, 'BR-V.png', 'P3', 'BR-V', 285000000, 'Putih', 8, 1198, NULL, NULL),
(4, 'civic.png', 'P4', 'Civic', 606400000, 'Putih', 4, 1500, NULL, NULL),
(5, 'WR-V.png', 'P5', 'WR-V', 274900000, 'Merah', 5, 1498, NULL, NULL),
(6, 'city.png', 'P6', 'City', 352500000, 'Putih', 5, 1498, NULL, NULL),
(7, 'CR-V.png', 'P7', 'CR-V', 749100000, 'Canyon River Blue Metallic', 5, 1993, NULL, NULL),
(8, 'mobilio.png', 'P8', 'Mobilio', 239600000, 'Putih', 8, 1496, NULL, NULL),
(9, 'accord.png', 'P9', 'Accord', 959900000, 'Platinum White Pearl', 5, 1993, NULL, NULL),
(10, 'brio.png', 'P10', 'Brio RS', 243100000, 'Kuning', 5, 1200, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `criterias`
--

CREATE TABLE `criterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `bobot` varchar(255) NOT NULL,
  `normalisasi` decimal(5,2) NOT NULL,
  `type` enum('benefit','cost') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `criterias`
--

INSERT INTO `criterias` (`id`, `code`, `name`, `slug`, `bobot`, `normalisasi`, `type`, `created_at`, `updated_at`) VALUES
(1, 'C1', 'Price', 'price', '35%', 0.35, 'cost', '2024-07-07 02:57:51', '2024-07-07 02:57:51'),
(2, 'C2', 'Available Seat', 'available_seat', '30%', 0.30, 'benefit', '2024-07-07 02:57:51', '2024-07-07 02:57:51'),
(3, 'C3', 'Color', 'color', '15%', 0.15, 'benefit', '2024-07-07 02:57:51', '2024-07-07 02:57:51'),
(4, 'C4', 'Capacity Machine', 'capacity_machine', '20%', 0.20, 'benefit', '2024-07-07 02:57:51', '2024-07-07 02:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2024-07-07 03:10:33', '2024-07-07 03:10:33'),
(2, 2, '2024-07-07 03:22:14', '2024-07-07 03:22:14'),
(3, 2, '2024-07-08 00:33:36', '2024-07-08 00:33:36'),
(4, 2, '2024-07-08 08:31:08', '2024-07-08 08:31:08'),
(5, 2, '2024-07-08 08:31:31', '2024-07-08 08:31:31'),
(6, 2, '2024-07-08 18:59:44', '2024-07-08 18:59:44'),
(7, 2, '2024-07-10 01:50:45', '2024-07-10 01:50:45'),
(8, 2, '2024-07-10 01:51:15', '2024-07-10 01:51:15'),
(9, 4, '2024-07-11 18:01:11', '2024-07-11 18:01:11'),
(10, 4, '2024-07-12 00:32:33', '2024-07-12 00:32:33'),
(11, 4, '2024-07-12 00:33:08', '2024-07-12 00:33:08'),
(12, 4, '2024-07-17 06:20:16', '2024-07-17 06:20:16'),
(13, 4, '2024-07-17 06:21:34', '2024-07-17 06:21:34'),
(14, 4, '2024-07-17 06:22:44', '2024-07-17 06:22:44'),
(15, 4, '2024-07-17 06:23:11', '2024-07-17 06:23:11'),
(16, 4, '2024-07-17 06:26:37', '2024-07-17 06:26:37'),
(17, 4, '2024-07-17 06:26:58', '2024-07-17 06:26:58'),
(18, 4, '2024-07-18 19:57:59', '2024-07-18 19:57:59'),
(19, 5, '2024-07-23 20:06:33', '2024-07-23 20:06:33'),
(20, 5, '2024-07-29 04:21:32', '2024-07-29 04:21:32'),
(21, 5, '2024-08-06 21:52:20', '2024-08-06 21:52:20'),
(22, 5, '2024-08-06 21:52:31', '2024-08-06 21:52:31'),
(23, 5, '2024-08-06 21:52:44', '2024-08-06 21:52:44'),
(24, 5, '2024-08-06 21:53:00', '2024-08-06 21:53:00'),
(25, 5, '2024-08-07 04:28:31', '2024-08-07 04:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `history_details`
--

CREATE TABLE `history_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `history_id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `total_score` decimal(8,2) NOT NULL,
  `ranking` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_details`
--

INSERT INTO `history_details` (`id`, `history_id`, `car_id`, `total_score`, `ranking`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 0.83, 1, '2024-07-07 03:10:33', '2024-07-07 03:10:33'),
(2, 1, 7, 0.65, 2, '2024-07-07 03:10:33', '2024-07-07 03:10:33'),
(3, 1, 9, 0.65, 3, '2024-07-07 03:10:33', '2024-07-07 03:10:33'),
(4, 1, 6, 0.62, 4, '2024-07-07 03:10:33', '2024-07-07 03:10:33'),
(5, 1, 2, 0.47, 5, '2024-07-07 03:10:33', '2024-07-07 03:10:33'),
(6, 1, 1, 0.47, 6, '2024-07-07 03:10:33', '2024-07-07 03:10:33'),
(7, 1, 3, 0.47, 7, '2024-07-07 03:10:34', '2024-07-07 03:10:34'),
(8, 1, 10, 0.44, 8, '2024-07-07 03:10:34', '2024-07-07 03:10:34'),
(9, 1, 5, 0.36, 9, '2024-07-07 03:10:34', '2024-07-07 03:10:34'),
(10, 1, 8, 0.24, 10, '2024-07-07 03:10:34', '2024-07-07 03:10:34'),
(11, 2, 4, 1.00, 1, '2024-07-07 03:22:14', '2024-07-07 03:22:14'),
(12, 3, 4, 0.80, 1, '2024-07-08 00:33:36', '2024-07-08 00:33:36'),
(13, 3, 1, 0.50, 2, '2024-07-08 00:33:36', '2024-07-08 00:33:36'),
(14, 3, 10, 0.46, 3, '2024-07-08 00:33:36', '2024-07-08 00:33:36'),
(15, 3, 5, 0.34, 4, '2024-07-08 00:33:36', '2024-07-08 00:33:36'),
(16, 3, 8, 0.23, 5, '2024-07-08 00:33:36', '2024-07-08 00:33:36'),
(17, 4, 4, 0.80, 1, '2024-07-08 08:31:08', '2024-07-08 08:31:08'),
(18, 4, 1, 0.50, 2, '2024-07-08 08:31:08', '2024-07-08 08:31:08'),
(19, 4, 10, 0.46, 3, '2024-07-08 08:31:08', '2024-07-08 08:31:08'),
(20, 4, 5, 0.34, 4, '2024-07-08 08:31:08', '2024-07-08 08:31:08'),
(21, 4, 8, 0.23, 5, '2024-07-08 08:31:08', '2024-07-08 08:31:08'),
(23, 5, 4, 0.71, 2, '2024-07-08 08:31:31', '2024-07-08 08:31:31'),
(24, 5, 1, 0.50, 3, '2024-07-08 08:31:31', '2024-07-08 08:31:31'),
(25, 5, 10, 0.46, 4, '2024-07-08 08:31:31', '2024-07-08 08:31:31'),
(26, 5, 5, 0.34, 5, '2024-07-08 08:31:31', '2024-07-08 08:31:31'),
(27, 5, 8, 0.23, 6, '2024-07-08 08:31:31', '2024-07-08 08:31:31'),
(28, 6, 1, 0.85, 1, '2024-07-08 18:59:44', '2024-07-08 18:59:44'),
(29, 6, 10, 0.80, 2, '2024-07-08 18:59:44', '2024-07-08 18:59:44'),
(30, 6, 5, 0.65, 3, '2024-07-08 18:59:44', '2024-07-08 18:59:44'),
(31, 6, 8, 0.55, 4, '2024-07-08 18:59:44', '2024-07-08 18:59:44'),
(32, 7, 4, 1.00, 1, '2024-07-10 01:50:45', '2024-07-10 01:50:45'),
(33, 8, 4, 1.00, 1, '2024-07-10 01:51:15', '2024-07-10 01:51:15'),
(34, 8, 7, 0.65, 2, '2024-07-10 01:51:15', '2024-07-10 01:51:15'),
(35, 8, 9, 0.65, 3, '2024-07-10 01:51:15', '2024-07-10 01:51:15'),
(36, 9, 6, 0.80, 1, '2024-07-11 18:01:11', '2024-07-11 18:01:11'),
(37, 9, 3, 0.70, 2, '2024-07-11 18:01:11', '2024-07-11 18:01:11'),
(38, 9, 2, 0.65, 3, '2024-07-11 18:01:11', '2024-07-11 18:01:11'),
(39, 10, 1, 0.85, 1, '2024-07-12 00:32:33', '2024-07-12 00:32:33'),
(40, 10, 10, 0.80, 2, '2024-07-12 00:32:33', '2024-07-12 00:32:33'),
(41, 10, 5, 0.65, 3, '2024-07-12 00:32:33', '2024-07-12 00:32:33'),
(42, 10, 8, 0.55, 4, '2024-07-12 00:32:33', '2024-07-12 00:32:33'),
(43, 11, 1, 0.85, 1, '2024-07-12 00:33:08', '2024-07-12 00:33:08'),
(44, 11, 10, 0.80, 2, '2024-07-12 00:33:08', '2024-07-12 00:33:08'),
(45, 11, 5, 0.65, 3, '2024-07-12 00:33:08', '2024-07-12 00:33:08'),
(46, 11, 8, 0.55, 4, '2024-07-12 00:33:08', '2024-07-12 00:33:08'),
(47, 12, 4, 0.80, 1, '2024-07-17 06:20:16', '2024-07-17 06:20:16'),
(48, 12, 6, 0.60, 2, '2024-07-17 06:20:16', '2024-07-17 06:20:16'),
(49, 12, 1, 0.47, 3, '2024-07-17 06:20:16', '2024-07-17 06:20:16'),
(50, 12, 3, 0.47, 4, '2024-07-17 06:20:16', '2024-07-17 06:20:16'),
(51, 12, 10, 0.43, 5, '2024-07-17 06:20:16', '2024-07-17 06:20:16'),
(52, 12, 5, 0.33, 6, '2024-07-17 06:20:16', '2024-07-17 06:20:16'),
(53, 12, 8, 0.22, 7, '2024-07-17 06:20:16', '2024-07-17 06:20:16'),
(54, 13, 6, 0.80, 1, '2024-07-17 06:21:35', '2024-07-17 06:21:35'),
(55, 13, 3, 0.70, 2, '2024-07-17 06:21:35', '2024-07-17 06:21:35'),
(56, 13, 2, 0.65, 3, '2024-07-17 06:21:35', '2024-07-17 06:21:35'),
(57, 13, 1, 0.46, 4, '2024-07-17 06:21:35', '2024-07-17 06:21:35'),
(58, 14, 4, 0.80, 1, '2024-07-17 06:22:44', '2024-07-17 06:22:44'),
(59, 14, 6, 0.60, 2, '2024-07-17 06:22:44', '2024-07-17 06:22:44'),
(60, 14, 1, 0.47, 3, '2024-07-17 06:22:44', '2024-07-17 06:22:44'),
(61, 14, 3, 0.47, 4, '2024-07-17 06:22:44', '2024-07-17 06:22:44'),
(62, 14, 2, 0.45, 5, '2024-07-17 06:22:44', '2024-07-17 06:22:44'),
(63, 14, 8, 0.22, 6, '2024-07-17 06:22:44', '2024-07-17 06:22:44'),
(64, 15, 1, 0.85, 1, '2024-07-17 06:23:11', '2024-07-17 06:23:11'),
(65, 15, 10, 0.80, 2, '2024-07-17 06:23:11', '2024-07-17 06:23:11'),
(66, 15, 5, 0.65, 3, '2024-07-17 06:23:11', '2024-07-17 06:23:11'),
(67, 15, 8, 0.55, 4, '2024-07-17 06:23:11', '2024-07-17 06:23:11'),
(68, 16, 1, 0.85, 1, '2024-07-17 06:26:37', '2024-07-17 06:26:37'),
(69, 16, 10, 0.80, 2, '2024-07-17 06:26:37', '2024-07-17 06:26:37'),
(70, 16, 5, 0.65, 3, '2024-07-17 06:26:37', '2024-07-17 06:26:37'),
(71, 16, 8, 0.55, 4, '2024-07-17 06:26:37', '2024-07-17 06:26:37'),
(72, 17, 1, 0.85, 1, '2024-07-17 06:26:58', '2024-07-17 06:26:58'),
(73, 17, 10, 0.80, 2, '2024-07-17 06:26:58', '2024-07-17 06:26:58'),
(74, 17, 5, 0.65, 3, '2024-07-17 06:26:58', '2024-07-17 06:26:58'),
(75, 17, 8, 0.55, 4, '2024-07-17 06:26:58', '2024-07-17 06:26:58'),
(76, 18, 1, 0.85, 1, '2024-07-18 19:57:59', '2024-07-18 19:57:59'),
(77, 18, 10, 0.80, 2, '2024-07-18 19:57:59', '2024-07-18 19:57:59'),
(78, 18, 5, 0.65, 3, '2024-07-18 19:57:59', '2024-07-18 19:57:59'),
(79, 18, 8, 0.55, 4, '2024-07-18 19:57:59', '2024-07-18 19:57:59'),
(80, 19, 1, 0.85, 1, '2024-07-23 20:06:33', '2024-07-23 20:06:33'),
(81, 19, 10, 0.80, 2, '2024-07-23 20:06:33', '2024-07-23 20:06:33'),
(82, 19, 5, 0.65, 3, '2024-07-23 20:06:33', '2024-07-23 20:06:33'),
(83, 19, 8, 0.55, 4, '2024-07-23 20:06:33', '2024-07-23 20:06:33'),
(84, 20, 1, 0.85, 1, '2024-07-29 04:21:32', '2024-07-29 04:21:32'),
(85, 20, 10, 0.80, 2, '2024-07-29 04:21:32', '2024-07-29 04:21:32'),
(86, 20, 5, 0.65, 3, '2024-07-29 04:21:32', '2024-07-29 04:21:32'),
(87, 20, 8, 0.55, 4, '2024-07-29 04:21:32', '2024-07-29 04:21:32'),
(88, 22, 4, 1.00, 1, '2024-08-06 21:52:31', '2024-08-06 21:52:31'),
(89, 23, 1, 0.85, 1, '2024-08-06 21:52:44', '2024-08-06 21:52:44'),
(90, 23, 10, 0.80, 2, '2024-08-06 21:52:44', '2024-08-06 21:52:44'),
(91, 23, 5, 0.65, 3, '2024-08-06 21:52:44', '2024-08-06 21:52:44'),
(92, 23, 8, 0.55, 4, '2024-08-06 21:52:44', '2024-08-06 21:52:44'),
(93, 24, 4, 0.80, 1, '2024-08-06 21:53:00', '2024-08-06 21:53:00'),
(94, 24, 1, 0.50, 2, '2024-08-06 21:53:00', '2024-08-06 21:53:00'),
(95, 24, 10, 0.46, 3, '2024-08-06 21:53:00', '2024-08-06 21:53:00'),
(96, 24, 5, 0.34, 4, '2024-08-06 21:53:00', '2024-08-06 21:53:00'),
(97, 24, 8, 0.23, 5, '2024-08-06 21:53:00', '2024-08-06 21:53:00'),
(98, 25, 1, 0.85, 1, '2024-08-07 04:28:31', '2024-08-07 04:28:31'),
(99, 25, 10, 0.80, 2, '2024-08-07 04:28:31', '2024-08-07 04:28:31'),
(100, 25, 5, 0.65, 3, '2024-08-07 04:28:31', '2024-08-07 04:28:31'),
(101, 25, 8, 0.55, 4, '2024-08-07 04:28:31', '2024-08-07 04:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `interval_criterias`
--

CREATE TABLE `interval_criterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criteria_id` bigint(20) UNSIGNED NOT NULL,
  `range` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interval_criterias`
--

INSERT INTO `interval_criterias` (`id`, `criteria_id`, `range`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, '> 500000000', 1, NULL, NULL),
(2, 1, '390000000 - 500000000', 2, NULL, NULL),
(3, 1, '280000000 - 390000000', 3, NULL, NULL),
(4, 1, '180000000 - 280000000', 4, NULL, NULL),
(5, 2, '8 - 9', 1, NULL, NULL),
(6, 2, '7 - 8', 2, NULL, NULL),
(7, 2, '4 - 5', 3, NULL, NULL),
(8, 2, '2 - 3', 4, NULL, NULL),
(9, 3, 'Putih', 4, NULL, NULL),
(10, 3, 'Pearl Gray Metallic', 3, NULL, NULL),
(11, 3, 'Hitam', 2, NULL, NULL),
(12, 3, 'Lainnya', 1, NULL, NULL),
(13, 4, '1198', 8, NULL, NULL),
(14, 4, '1199', 7, NULL, NULL),
(15, 4, '1200', 6, NULL, NULL),
(16, 4, '1408', 5, NULL, NULL),
(17, 4, '1496', 4, NULL, NULL),
(18, 4, '1498', 3, NULL, NULL),
(19, 4, '1500', 2, NULL, NULL),
(20, 4, '1993', 1, NULL, NULL),
(21, 3, 'Biru', 3, '2024-07-08 08:24:42', '2024-07-16 10:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(2, 'login', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(3, 'profile.index', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(4, 'profile.update', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(5, 'logout', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(6, 'password.request', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(7, 'password.email', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(8, 'password.reset', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(9, 'password.update', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(10, 'password.confirm', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(11, 'list-cars.index', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(12, 'list-cars.create', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(13, 'list-cars.store', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(14, 'list-cars.show', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(15, 'list-cars.edit', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(16, 'list-cars.update', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(17, 'list-cars.destroy', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(18, 'recomendation.index', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(19, 'recomendation.create', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(20, 'recomendation.store', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(21, 'recomendation.show', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(22, 'recomendation.edit', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(23, 'recomendation.update', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(24, 'recomendation.destroy', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(25, 'recomendation.calculate', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(26, 'hasil-akhir.index', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(27, 'hasil-akhir.create', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(28, 'hasil-akhir.store', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(29, 'hasil-akhir.show', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(30, 'hasil-akhir.edit', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(31, 'hasil-akhir.update', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(32, 'hasil-akhir.destroy', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(33, 'hasil-akhir.download', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(34, 'history.index', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(35, 'history.download', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(36, 'evaluation.index', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(37, 'evaluation.create', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(38, 'evaluation.store', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(39, 'evaluation.show', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(40, 'evaluation.edit', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(41, 'evaluation.update', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(42, 'evaluation.destroy', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(43, 'subcriteria.update', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(44, 'subcriteria.destroy', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(45, 'subcriteria.create', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(46, 'subcriteria.store', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(47, 'subcriteria.index', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(48, 'subcriteria.show', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(49, 'subcriteria.edit', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(50, 'criteria.update', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(51, 'criteria.edit', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(52, 'criteria.show', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(53, 'criteria.destroy', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(54, 'criteria.create', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(55, 'criteria.store', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(56, 'criteria.index', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(57, 'cars.destroy', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(58, 'cars.create', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(59, 'cars.store', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(60, 'cars.index', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(61, 'cars.show', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(62, 'cars.edit', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(63, 'cars.update', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(64, 'users.index', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(65, 'users.create', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(66, 'users.store', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(67, 'users.show', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(68, 'users.edit', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(69, 'users.update', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(70, 'users.destroy', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(71, 'users.roles.index', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(72, 'users.roles.create', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(73, 'users.roles.store', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(74, 'users.roles.show', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(75, 'users.roles.edit', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(76, 'users.roles.update', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(77, 'users.roles.destroy', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(78, 'users.permissions.index', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(79, 'users.permissions.create', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(80, 'users.permissions.store', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(81, 'users.permissions.show', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(82, 'users.permissions.edit', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(83, 'users.permissions.update', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(84, 'users.permissions.destroy', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(2, 'user', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(3, 'manager', 'web', '2024-07-07 02:57:50', '2024-07-07 02:57:50');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 1),
(34, 3),
(35, 1),
(35, 3),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator@gmail.com', NULL, '$2y$10$WVhsF5GS8GBrpzsdUas2rebJWzwoG/CB.FcdbhFEXNXWKWRz4G0UW', NULL, '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(2, 'Firman', 'user@gmail.com', NULL, '$2y$10$7fOlCkFd5j6aXtqy9TtTZeq.y3k0LvB6OEnK8lC3ZgVTu8V9.V/c6', NULL, '2024-07-07 02:57:50', '2024-07-07 09:24:08'),
(3, 'Manager', 'manager@gmail.com', NULL, '$2y$10$O1JogSl/Gz6GHzpnPr1rXudKADazjYhK/31CUzVyRzu74Tfx/.Gtm', NULL, '2024-07-07 02:57:50', '2024-07-07 02:57:50'),
(4, 'Aaal', 'alumam@gmail.com', NULL, '$2y$10$eEFMSyhw.BK5eXDJx.xz6OImxKCOAoR5koG9J6C7/A8wT0t8cHBii', NULL, '2024-07-07 19:31:06', '2024-07-10 06:17:09'),
(5, 'Faiz', 'mfaizz@gmail.com', NULL, '$2y$10$U36HclMeWUatY7Y9MBLYSuoSVHLadqtSbd9VO2oeqLiOTJpovQ8gi', NULL, '2024-07-23 20:06:04', '2024-07-23 20:15:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criterias`
--
ALTER TABLE `criterias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `history_details`
--
ALTER TABLE `history_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_details_history_id_foreign` (`history_id`),
  ADD KEY `history_details_car_id_foreign` (`car_id`);

--
-- Indexes for table `interval_criterias`
--
ALTER TABLE `interval_criterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interval_criterias_criteria_id_foreign` (`criteria_id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `criterias`
--
ALTER TABLE `criterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `history_details`
--
ALTER TABLE `history_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `interval_criterias`
--
ALTER TABLE `interval_criterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `histories`
--
ALTER TABLE `histories`
  ADD CONSTRAINT `histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history_details`
--
ALTER TABLE `history_details`
  ADD CONSTRAINT `history_details_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_details_history_id_foreign` FOREIGN KEY (`history_id`) REFERENCES `histories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interval_criterias`
--
ALTER TABLE `interval_criterias`
  ADD CONSTRAINT `interval_criterias_criteria_id_foreign` FOREIGN KEY (`criteria_id`) REFERENCES `criterias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
