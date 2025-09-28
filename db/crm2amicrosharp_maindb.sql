-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 28, 2025 at 03:41 PM
-- Server version: 5.7.44
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm2amicrosharp_maindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `user_role_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `activity` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `business_area`
--

CREATE TABLE `business_area` (
  `id` int(10) UNSIGNED NOT NULL,
  `area_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_area`
--

INSERT INTO `business_area` (`id`, `area_name`, `area_code`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Shop', 'BA 001', '2025-09-11 17:06:40', '2025-09-11 17:06:40', NULL, 1),
(2, 'Restaurant', 'BA 002', '2025-09-11 17:06:54', '2025-09-17 12:58:45', NULL, 0),
(3, 'HOS', 'BA 003', '2025-09-11 17:07:52', '2025-09-17 12:59:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `business_partners`
--

CREATE TABLE `business_partners` (
  `id` int(10) UNSIGNED NOT NULL,
  `prefix` tinyint(3) NOT NULL,
  `poc_first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poc_last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poc_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poc_mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_area_id` int(10) NOT NULL,
  `business_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_id` int(10) NOT NULL,
  `country_id` int(10) NOT NULL,
  `state_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `zip_code` int(10) NOT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luckydraw_id` varchar(100) DEFAULT NULL,
  `open_password` varchar(100) DEFAULT NULL,
  `discount_status` tinyint(1) DEFAULT '0',
  `default_discount` int(3) NOT NULL DEFAULT '0',
  `tax_status` tinyint(3) NOT NULL DEFAULT '0',
  `default_tax` int(3) NOT NULL DEFAULT '0',
  `wallet_amount` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_partners`
--

INSERT INTO `business_partners` (`id`, `prefix`, `poc_first_name`, `poc_last_name`, `poc_email`, `poc_mobile`, `business_area_id`, `business_name`, `address_line_1`, `address_line_2`, `region_id`, `country_id`, `state_id`, `city_id`, `zip_code`, `profile_image`, `luckydraw_id`, `open_password`, `discount_status`, `default_discount`, `tax_status`, `default_tax`, `wallet_amount`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 1, 'Naresh', 'Reddy', 'cnareshreddy@gmail.com', '23058524334', 1, 'My Choice', 'Sodnac Quatre Bornes Mauritius', 'A13 7th Floor Dreamton Park', 2, 3, 5, 6, 72249, 'image/profile_image/1757592471.png', '1,2,3', '$2y$10$37sLwJluG5urHEgUMncxEe0mEqhOBFkXCw1Hdg4k4xtkFD1uG4wi6', 0, 0, 0, 0, 1343, '2025-09-11 17:37:52', '2025-09-17 00:07:11', NULL, 1),
(2, 1, 'UBG', 'UBG', 'unitedbusinessesgroup@gmail.com', '23058524335', 2, 'safrongril', 'Sodnac Quatre Bornes Mauritius', 'A13 7th Floor Dreamton Park', 1, 2, 4, 5, 72249, NULL, '3,2,1', '$2y$10$nQGm5MxIWIOuAnOeXrsAcem3zt5g2g2DPD4nbqML2onEgI8ECAmf.', 0, 0, 0, 0, 100, '2025-09-12 11:44:58', '2025-09-17 00:06:48', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `description` text,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `country_id`, `state_id`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hyderabad', 1, 1, NULL, '1', '2025-09-11 11:44:04', '2025-09-17 05:05:41', NULL),
(2, 'Warangal', 1, 1, NULL, '1', '2025-09-11 11:44:15', '2025-09-17 05:05:41', NULL),
(3, 'Bangalore', 1, 2, NULL, '1', '2025-09-11 11:44:23', '2025-09-17 05:05:41', NULL),
(4, 'Mysore', 1, 2, NULL, '1', '2025-09-11 11:44:32', '2025-09-17 05:05:41', NULL),
(5, 'Singapore City', 2, 4, NULL, '1', '2025-09-11 11:44:40', '2025-09-17 05:05:41', NULL),
(6, 'Port Louis', 3, 5, NULL, '1', '2025-09-11 11:44:50', '2025-09-11 11:44:50', NULL),
(7, 'Namibia City', 4, 6, NULL, '1', '2025-09-11 11:45:04', '2025-09-11 11:45:04', NULL),
(8, 'Glasgow', 5, 7, NULL, '1', '2025-09-11 11:46:02', '2025-09-11 11:46:02', NULL),
(9, 'Stolkholm', 6, 8, NULL, '1', '2025-09-11 11:46:16', '2025-09-11 11:46:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `country_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `region_id`, `country_name`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 1, 'India', '2025-09-11 11:39:05', '2025-09-17 05:05:41', NULL, 1),
(2, 1, 'Singapore', '2025-09-11 11:39:12', '2025-09-17 05:05:41', NULL, 1),
(3, 2, 'Mauritius', '2025-09-11 11:39:20', '2025-09-11 11:39:20', NULL, 1),
(4, 2, 'Namibia', '2025-09-11 11:39:28', '2025-09-11 11:39:28', NULL, 1),
(5, 3, 'United Kingdom', '2025-09-11 11:40:00', '2025-09-11 11:40:00', NULL, 1),
(6, 3, 'Sweden', '2025-09-11 11:40:14', '2025-09-11 11:40:14', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `bp_id` int(10) UNSIGNED NOT NULL,
  `customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` tinyint(3) DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(250) NOT NULL,
  `address_line_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `state_id` int(10) UNSIGNED DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `zip_code` int(10) UNSIGNED DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `timezone` varchar(100) DEFAULT NULL,
  `national_id_number` varchar(255) DEFAULT NULL,
  `national_id_photo` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `bp_id`, `customer_id`, `prefix`, `first_name`, `last_name`, `email`, `mobile`, `password`, `address_line_1`, `address_line_2`, `country_id`, `state_id`, `city_id`, `zip_code`, `profile_image`, `dob`, `timezone`, `national_id_number`, `national_id_photo`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, '25000001', 0, 'UBG', NULL, 'unitedbusinessesgroup@gmail.com', '23058524336', '$2y$10$3wBQnoARb6L5VFfqs2MAhOI9eS8iUjAOZmYx3faS4sodR1Q0AeshK', NULL, NULL, 1, NULL, NULL, NULL, '1757657100.png', '2025-09-12', NULL, 'ABC12345', '1757657100.png', '2025-09-12 11:03:00', '2025-09-17 09:55:18', 1),
(2, 1, '25000002', 1, 'Swetha', 'Kusam', 'kusamswetha@gmail.com', '23058524335', '$2y$10$iVLn/T.XXLGYSp.qLTe3vOihFAg4mh3ZLs1mi1h861CL3ZqAQavIi', '713, 1st Floor, 12th Main', 'Behind ICICI Bank, Singasandra', 1, 2, 3, 560100, '1757947918.png', '2025-09-01', NULL, 'ABC123456', '1757947918.jpg', '2025-09-12 11:06:27', '2025-09-15 14:51:58', 1),
(3, 2, '25000003', NULL, 'XYS', NULL, 'xyz@gmail.com', '919030041499', '$2y$10$WiUzTae2gBuflMeu9j3DBe7gpaD2mM.6Ota10iwuPSZ4A3e5O7KYO', NULL, NULL, NULL, NULL, NULL, NULL, '1757657100.png', NULL, NULL, 'ABC1234578', '1757657100.png', '2025-09-12 11:47:43', '2025-09-12 11:47:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers_groups`
--

CREATE TABLE `customers_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bp_id` tinyint(3) UNSIGNED NOT NULL,
  `customer_ids` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers_groups`
--

INSERT INTO `customers_groups` (`id`, `group_name`, `bp_id`, `customer_ids`, `created_at`, `updated_at`, `status`) VALUES
(1, 'UBG Group', 1, '1,2', '2025-09-12 11:09:49', '2025-09-12 11:09:49', 1);

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `for` tinyint(3) UNSIGNED NOT NULL COMMENT '1=BP, 2=Customers, 3=Staff 9=Others',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_payment_gateway`
--

CREATE TABLE `general_payment_gateway` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `default_time_zone` varchar(50) DEFAULT NULL,
  `default_currency` int(11) DEFAULT NULL,
  `site_global_currency` varchar(50) DEFAULT NULL,
  `site_currency_symbol_position` varchar(50) DEFAULT NULL,
  `site_inr_to_usd_exchange_rate` int(11) DEFAULT NULL,
  `site_inr_to_idr_exchange_rate` varchar(50) DEFAULT NULL,
  `site_inr_to_zar_exchange_rate` varchar(50) DEFAULT NULL,
  `site_inr_to_brl_exchange_rate` varchar(50) DEFAULT NULL,
  `site_inr_to_myr_exchange_rate` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_payment_gateway`
--

INSERT INTO `general_payment_gateway` (`id`, `user_id`, `default_time_zone`, `default_currency`, `site_global_currency`, `site_currency_symbol_position`, `site_inr_to_usd_exchange_rate`, `site_inr_to_idr_exchange_rate`, `site_inr_to_zar_exchange_rate`, `site_inr_to_brl_exchange_rate`, `site_inr_to_myr_exchange_rate`, `created_at`, `updated_at`) VALUES
(1, '2', 'Africa/Ouagadougou GMT+00:00', 26, 'AUD', 'left', 1, '2', '3', '4', '5', '2025-05-30 15:56:35', '2025-09-17 10:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `luckydraws`
--

CREATE TABLE `luckydraws` (
  `id` int(10) UNSIGNED NOT NULL,
  `luckydraw_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `frequency` tinyint(3) UNSIGNED NOT NULL,
  `format` tinyint(3) UNSIGNED NOT NULL,
  `region_id` varchar(100) NOT NULL,
  `country_id` varchar(100) NOT NULL,
  `state_id` varchar(100) NOT NULL,
  `template_option` int(11) DEFAULT NULL,
  `template_group_id` varchar(255) DEFAULT NULL,
  `template_id` varchar(220) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `method` tinyint(4) NOT NULL,
  `no_of_prizes` int(11) NOT NULL DEFAULT '1',
  `luckydraw_wise_allocation` varchar(255) DEFAULT NULL,
  `template_luckydraw_id` varchar(100) DEFAULT NULL,
  `country_luckydraw_id` varchar(100) DEFAULT NULL,
  `state_luckydraw_id` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `ticket_id` varchar(155) NOT NULL DEFAULT '0',
  `winner_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `luckydraws`
--

INSERT INTO `luckydraws` (`id`, `luckydraw_name`, `frequency`, `format`, `region_id`, `country_id`, `state_id`, `template_option`, `template_group_id`, `template_id`, `start_date`, `end_date`, `price`, `method`, `no_of_prizes`, `luckydraw_wise_allocation`, `template_luckydraw_id`, `country_luckydraw_id`, `state_luckydraw_id`, `created_at`, `updated_at`, `deleted_at`, `status`, `ticket_id`, `winner_status`) VALUES
(1, 'UBG Lucky Draw', 2, 2, '1', '1,2', '1,2,3,4', 1, NULL, '1,2,3,4', '2025-09-11', '2025-09-26', 0, 1, 3, '', '', '', '', '2025-09-11 17:31:09', '2025-09-11 18:22:16', NULL, 1, '0', 0),
(2, 'UBG LD 2', 3, 2, '1,2,3', '1,2,3,4,5,6', '1,2,3,4,5,6,7,8', 1, NULL, '5,6,7', '2025-10-01', '2025-12-31', 0, 1, 2, '', '', '', '', '2025-09-11 17:36:14', '2025-09-11 17:36:14', NULL, 1, '0', 0),
(3, 'Mixed LuckyDraw', 2, 2, '1,2,3', '1,2,3,4,5,6', '1,2,3,4,5,6,7,8', 2, '3,4', '1,3,2,4,1,8', '2025-09-12', '2025-10-11', 0, 1, 1, '', '', '', '', '2025-09-12 00:22:13', '2025-09-12 11:07:33', NULL, 1, '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `luckydraw_template`
--

CREATE TABLE `luckydraw_template` (
  `id` int(10) NOT NULL,
  `template_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `luckydraw_template`
--

INSERT INTO `luckydraw_template` (`id`, `template_name`, `template_code`, `template_image`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'UBG TEMP A', 'T 001', '1757591372.png', '2025-09-11 17:19:32', '2025-09-12 00:28:04', NULL, 1),
(2, 'UBG Temp B', 'T 002', '1757591390.png', '2025-09-11 17:19:50', '2025-09-11 17:19:50', NULL, 1),
(3, 'UBG Temp C', 'T 003', '1757591409.png', '2025-09-11 17:20:09', '2025-09-11 17:20:09', NULL, 1),
(4, 'UBG Temp D', 'T 004', '1757591444.png', '2025-09-11 17:20:44', '2025-09-11 17:20:44', NULL, 1),
(5, 'UBG Temp E', 'T 005', '1757591463.png', '2025-09-11 17:21:03', '2025-09-11 17:21:03', NULL, 1),
(6, 'UBG Temp F', 'T 006', '1757591528.png', '2025-09-11 17:22:08', '2025-09-11 17:22:08', NULL, 1),
(7, 'UBG Temp G', 'T 007', '1757591606.png', '2025-09-11 17:23:26', '2025-09-11 17:23:26', NULL, 1),
(8, 'UBG Temp H', 'T 008', '1757591629.png', '2025-09-11 17:23:49', '2025-09-11 17:23:49', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `smtp_mailer` varchar(50) DEFAULT NULL,
  `smtp_host` varchar(50) DEFAULT NULL,
  `smtp_port` varchar(50) DEFAULT NULL,
  `smtp_encryption` varchar(50) DEFAULT NULL,
  `smtp_username` varchar(50) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `user_id`, `smtp_mailer`, `smtp_host`, `smtp_port`, `smtp_encryption`, `smtp_username`, `smtp_password`, `created_at`, `updated_at`) VALUES
(1, 2, 'smtp', 'smtp.gmail.com', '587', 'tls', 'afzal1503a@aptechgdn.net', '$2y$10$4PzwzC3qyXmcaoEhz9Psf.cs7hXQHMtM73qCi5npoRf6rtlGPqmXC', '2025-06-09 12:46:42', '2025-07-02 10:59:29');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_payment_gateway` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_gateway` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_mode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_sandbox_client_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_sandbox_client_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_sandbox_app_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_live_client_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_live_client_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_live_app_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_payment_action` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_notify_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_validate_ssl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_gateway` text COLLATE utf8mb4_unicode_ci,
  `razorpay_mode` text COLLATE utf8mb4_unicode_ci,
  `razorpay_api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_api_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instamojo_gateway` text COLLATE utf8mb4_unicode_ci,
  `instamojo_mode` text COLLATE utf8mb4_unicode_ci,
  `instamojo_client_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instamojo_client_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instamojo_username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instamojo_password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instamojo_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_gateway` text COLLATE utf8mb4_unicode_ci,
  `stripe_mode` text COLLATE utf8mb4_unicode_ci,
  `stripe_public_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mollie_gateway` text COLLATE utf8mb4_unicode_ci,
  `mollie_mode` text COLLATE utf8mb4_unicode_ci,
  `mollie_public_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mollie_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flw_gateway` text COLLATE utf8mb4_unicode_ci,
  `flw_mode` text COLLATE utf8mb4_unicode_ci,
  `flw_public_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flw_secret_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flw_secret_hash` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flw_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authorizenet_gateway` text COLLATE utf8mb4_unicode_ci,
  `authorizenet_mode` text COLLATE utf8mb4_unicode_ci,
  `authorizenet_merchant_login_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authorizenet_merchant_transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authorizenet_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_gateway` text COLLATE utf8mb4_unicode_ci,
  `midtrans_mode` text COLLATE utf8mb4_unicode_ci,
  `midtrans_merchant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_server_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_client_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_environment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payfast_gateway` text COLLATE utf8mb4_unicode_ci,
  `payfast_mode` text COLLATE utf8mb4_unicode_ci,
  `payfast_merchant_env` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payfast_itn_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payfast_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cashfree_gateway` text COLLATE utf8mb4_unicode_ci,
  `cashfree_mode` text COLLATE utf8mb4_unicode_ci,
  `cashfree_app_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cashfree_secret_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cashfree_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marcado_pago_gateway` text COLLATE utf8mb4_unicode_ci,
  `marcado_pago_mode` text COLLATE utf8mb4_unicode_ci,
  `marcado_pago_client_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marcado_pago_client_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marcadopago_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `squareup_gateway` text COLLATE utf8mb4_unicode_ci,
  `squareup_mode` text COLLATE utf8mb4_unicode_ci,
  `squareup_access_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `squareup_location_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `squareup_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flutterwave_gateway` text COLLATE utf8mb4_unicode_ci,
  `flutterwave_mode` text COLLATE utf8mb4_unicode_ci,
  `flutterwave_client_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flutterwave_client_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flutterwave_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paystack_gateway` text COLLATE utf8mb4_unicode_ci,
  `paystack_mode` text COLLATE utf8mb4_unicode_ci,
  `paystack_client_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paystack_client_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paystack_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cinetpay_gateway` text COLLATE utf8mb4_unicode_ci,
  `cinetpay_mode` text COLLATE utf8mb4_unicode_ci,
  `cinetpay_api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cinetpay_site_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cinetpay_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zitopay_gateway` text COLLATE utf8mb4_unicode_ci,
  `zitopay_mode` text COLLATE utf8mb4_unicode_ci,
  `zitopay_username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zitopay_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sitesway_gateway` text COLLATE utf8mb4_unicode_ci,
  `sitesway_mode` text COLLATE utf8mb4_unicode_ci,
  `sitesway_brand_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sitesway_api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sitesway_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_tabs_gateway` text COLLATE utf8mb4_unicode_ci,
  `pay_tabs_mode` text COLLATE utf8mb4_unicode_ci,
  `pay_tabs_currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_tabs_profile_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_tabs_region` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_tabs_server_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_tabs_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billplz_gateway` text COLLATE utf8mb4_unicode_ci,
  `billplz_mode` text COLLATE utf8mb4_unicode_ci,
  `billplz_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billplz_version` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billplz_x_signature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billplz_collection_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billplz_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `toyyibpay_gateway` text COLLATE utf8mb4_unicode_ci,
  `toyyibpay_mode` text COLLATE utf8mb4_unicode_ci,
  `toyyibpay_secret_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `toyyibpay_category_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `toyyibpay_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pagali_gateway` text COLLATE utf8mb4_unicode_ci,
  `pagali_mode` text COLLATE utf8mb4_unicode_ci,
  `pagali_page_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pagali_entity_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pagali_preview_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_idr_to_usd_exchange_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_idr_to_idr_exchange_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_idr_to_inr_exchange_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_idr_to_ngn_exchange_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_idr_to_zar_exchange_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `user_id`, `default_payment_gateway`, `paypal_gateway`, `paypal_mode`, `paypal_sandbox_client_id`, `paypal_sandbox_client_secret`, `paypal_sandbox_app_id`, `paypal_live_client_id`, `paypal_live_client_secret`, `paypal_live_app_id`, `paypal_payment_action`, `paypal_currency`, `paypal_notify_url`, `paypal_locale`, `paypal_validate_ssl`, `paypal_preview_logo`, `razorpay_gateway`, `razorpay_mode`, `razorpay_api_key`, `razorpay_api_secret`, `razorpay_preview_logo`, `instamojo_gateway`, `instamojo_mode`, `instamojo_client_id`, `instamojo_client_secret`, `instamojo_username`, `instamojo_password`, `instamojo_preview_logo`, `stripe_gateway`, `stripe_mode`, `stripe_public_key`, `stripe_preview_logo`, `mollie_gateway`, `mollie_mode`, `mollie_public_key`, `mollie_preview_logo`, `flw_gateway`, `flw_mode`, `flw_public_key`, `flw_secret_key`, `flw_secret_hash`, `flw_preview_logo`, `authorizenet_gateway`, `authorizenet_mode`, `authorizenet_merchant_login_id`, `authorizenet_merchant_transaction_id`, `authorizenet_preview_logo`, `midtrans_gateway`, `midtrans_mode`, `midtrans_merchant_id`, `midtrans_server_key`, `midtrans_client_key`, `midtrans_environment`, `midtrans_preview_logo`, `payfast_gateway`, `payfast_mode`, `payfast_merchant_env`, `payfast_itn_url`, `payfast_preview_logo`, `cashfree_gateway`, `cashfree_mode`, `cashfree_app_id`, `cashfree_secret_key`, `cashfree_preview_logo`, `marcado_pago_gateway`, `marcado_pago_mode`, `marcado_pago_client_id`, `marcado_pago_client_secret`, `marcadopago_preview_logo`, `squareup_gateway`, `squareup_mode`, `squareup_access_token`, `squareup_location_id`, `squareup_preview_logo`, `flutterwave_gateway`, `flutterwave_mode`, `flutterwave_client_id`, `flutterwave_client_secret`, `flutterwave_preview_logo`, `paystack_gateway`, `paystack_mode`, `paystack_client_id`, `paystack_client_secret`, `paystack_preview_logo`, `cinetpay_gateway`, `cinetpay_mode`, `cinetpay_api_key`, `cinetpay_site_id`, `cinetpay_preview_logo`, `zitopay_gateway`, `zitopay_mode`, `zitopay_username`, `zitopay_preview_logo`, `sitesway_gateway`, `sitesway_mode`, `sitesway_brand_id`, `sitesway_api_key`, `sitesway_preview_logo`, `pay_tabs_gateway`, `pay_tabs_mode`, `pay_tabs_currency`, `pay_tabs_profile_id`, `pay_tabs_region`, `pay_tabs_server_key`, `pay_tabs_preview_logo`, `billplz_gateway`, `billplz_mode`, `billplz_key`, `billplz_version`, `billplz_x_signature`, `billplz_collection_name`, `billplz_preview_logo`, `toyyibpay_gateway`, `toyyibpay_mode`, `toyyibpay_secret_key`, `toyyibpay_category_code`, `toyyibpay_preview_logo`, `pagali_gateway`, `pagali_mode`, `pagali_page_id`, `pagali_entity_id`, `pagali_preview_logo`, `site_idr_to_usd_exchange_rate`, `site_idr_to_idr_exchange_rate`, `site_idr_to_inr_exchange_rate`, `site_idr_to_ngn_exchange_rate`, `site_idr_to_zar_exchange_rate`, `created_at`, `updated_at`) VALUES
(1, '2', NULL, 'Yes', 'sandbox', 'TESTAUP7AuZMwJbkee-2OmsSZrU-ID1XUJYE-YB-2JOrxeKV-q9ZJZYmsr-UoKuJn4kwyCv5ak26lrZyb-gb', 'EEIxCuVnbgING9EyzcF2q-gpacLneVbngQtJ1mbx-42Lbq-6Uf6PEjgzF7HEayNsI4IFmB9_CZkECc3y', '641651651958', 'AaSfSSKZ-PnRXnjIDjOQwjw-vOZUcWZSLbAxM7Cu2DQFwQm33VTI15tqrtzjxw_shuweGuQ0GWKevuui', 'EKaSpUBZmLQmGul4_whNhNfEkvX3gJbM6C8b3RmIa-kXUft1nPpc88NrXi3aAlMkeOPdm7ob4JWhXI-O', 'dsfdsfd', NULL, NULL, NULL, NULL, NULL, '../../uploads/payment/paypal_1750358908_68545b7cd64ee.png', 'Yes', 'Test', 'sdsasd', 'ass', '../../uploads/payment/razorpay_1750358908_68545b7cd6637.png', 'No', 'Test', 'sad', 'sds', 'sd', 'sdsa', '../../uploads/payment/instamojo_1750358908_68545b7cd66b8.png', 'No', 'Test', 'adkghiu', '../../uploads/payment/strip_1750358908_68545b7cd671a.png', 'No', 'Test', 'asdsa', '../../uploads/payment/mobile_1750358908_68545b7cd6780.png', 'Yes', 'Test', 'sds', 'sdsad', NULL, '../../uploads/payment/flw_1750358920_68545b88407d2.png', 'No', 'Test', 'sada', 'sd', '../../uploads/payment/authorizenet_1750358908_68545b7cd686a.png', 'No', 'Live', 'ss', 'sd', NULL, 'sd', '../../uploads/payment/midtrans_1750358908_68545b7cd68e3.png', 'No', NULL, 'sa', 'sasd', '../../uploads/payment/payfast_1750358908_68545b7cd6954.png', NULL, 'Live', 'sdssa', 'adsd', '../../uploads/payment/cashfree_1750358908_68545b7cd69b7.png', 'No', 'Live', 'ads', NULL, '../../uploads/payment/marcadopago_1750358908_68545b7cd6a3a.png', 'Yes', 'Live', 'sdsas', 'saas', '../../uploads/payment/squareup_1750362472_6854696843572.png', 'No', 'Live', 'sasad', 'sadsad', '../../uploads/payment/flutterwave_1750358908_68545b7cd6b26.jpg', 'No', 'Live', 'sasd', 'sadsd', '../../uploads/payment/paystack_1750358908_68545b7cd6b92.png', 'No', 'Live', 'sas', 'sasd', '../../uploads/payment/cinetpay_1750358908_68545b7cd6c1c.jpg', 'Yes', 'Live', 'dsdkkss', '../../uploads/payment/zitopay_1750361346_68546502c0976.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-03 15:38:30', '2025-06-26 15:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `prizes`
--

CREATE TABLE `prizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `luckydraw_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prize_type` tinyint(3) DEFAULT NULL COMMENT '1: Cash Prize, 2: Item',
  `prize_number` int(11) NOT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `item` varchar(100) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prizes`
--

INSERT INTO `prizes` (`id`, `luckydraw_id`, `prize_type`, `prize_number`, `amount`, `item`, `image`, `created_at`, `updated_at`, `status`) VALUES
(1, '1', 1, 0, '€ 100', NULL, NULL, '2025-09-11 17:31:09', '2025-09-11 17:31:09', NULL),
(2, '1', 1, 1, '€ 50', NULL, NULL, '2025-09-11 17:31:09', '2025-09-11 17:31:09', NULL),
(3, '1', 1, 2, '€ 25', NULL, NULL, '2025-09-11 17:31:09', '2025-09-11 17:31:09', NULL),
(4, '2', 1, 0, '$ 500', NULL, NULL, '2025-09-11 17:36:14', '2025-09-11 17:36:14', NULL),
(5, '2', 1, 1, '$ 250', NULL, NULL, '2025-09-11 17:36:14', '2025-09-11 17:36:14', NULL),
(6, '3', 1, 0, '$ 100', NULL, NULL, '2025-09-12 00:22:13', '2025-09-12 00:22:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prize_distribution`
--

CREATE TABLE `prize_distribution` (
  `id` int(10) NOT NULL,
  `luckydraw_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_id` varchar(255) NOT NULL,
  `prize_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `tx_remarks` text,
  `tx_proof` varchar(191) DEFAULT NULL,
  `tx_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prize_distribution`
--

INSERT INTO `prize_distribution` (`id`, `luckydraw_id`, `ticket_id`, `prize_id`, `created_at`, `updated_at`, `status`, `tx_remarks`, `tx_proof`, `tx_status`) VALUES
(1, '1', 'ABC0023', 1, '2025-09-15 00:13:32', NULL, 0, NULL, NULL, 0),
(2, '1', 'ABC0022', 2, '2025-09-15 00:13:33', '2025-09-15 20:53:18', 0, 'Delivered', '1757949798.png', 1),
(3, '1', 'ABC0027', 3, '2025-09-15 00:13:33', '2025-09-15 15:55:48', 0, 'Paid through test paypal sdhs kdjskl jklsdj', '1757931948.jpg', 1),
(4, '1', 'ABC0041', 1, '2025-09-15 00:14:34', NULL, 1, NULL, NULL, 0),
(5, '1', 'ABC0015', 2, '2025-09-15 00:14:34', '2025-09-15 20:52:53', 1, 'Delivered', '1757949773.png', 1),
(6, '1', 'ABC0030', 3, '2025-09-15 00:14:35', NULL, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prize_manager`
--

CREATE TABLE `prize_manager` (
  `id` int(10) NOT NULL,
  `template_id` int(10) NOT NULL,
  `prize_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prize_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prize_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(10) UNSIGNED NOT NULL,
  `region_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `region_name`, `region_code`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Asia', 'R 001', '2025-09-11 17:08:22', '2025-09-17 10:35:41', NULL, 1),
(2, 'Africa', 'R 002', '2025-09-11 17:08:34', '2025-09-11 17:08:34', NULL, 1),
(3, 'Europe', 'R 003', '2025-09-11 17:08:46', '2025-09-11 17:08:46', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) NOT NULL,
  `ticket_id` varchar(255) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `partner_id` int(10) NOT NULL,
  `luckydraw_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_id` int(11) NOT NULL,
  `price` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `discount` int(10) DEFAULT NULL,
  `tax` int(10) DEFAULT NULL,
  `amount` varchar(50) NOT NULL,
  `sale_image_path` text,
  `ticket_download_id` varchar(251) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `draw_date` varchar(100) DEFAULT NULL,
  `declare_date` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `winner_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `ticket_id`, `customer_id`, `partner_id`, `luckydraw_id`, `template_id`, `price`, `qty`, `discount`, `tax`, `amount`, `sale_image_path`, `ticket_download_id`, `created_at`, `updated_at`, `draw_date`, `declare_date`, `status`, `winner_status`) VALUES
(1, 'ABC0001', 25000001, 1, '3', 1, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0001_68c3b34ed390f.jpg', 'WXWMiOxw9oPK', '2025-09-12 11:14:44', '2025-09-12 11:14:47', '12-09-2025-At 9:30pm', NULL, 0, 0),
(2, 'ABC0002', 25000001, 1, '3', 3, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0002_68c3b350ab553.jpg', 'HY8LtTVeev2G', '2025-09-12 11:14:48', '2025-09-12 11:14:48', '12-09-2025-At 9:30pm', NULL, 0, 0),
(3, 'ABC0003', 25000001, 1, '3', 2, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0003_68c3b3510595a.jpg', 'YtnaVETglcaI', '2025-09-12 11:14:48', '2025-09-12 11:14:49', '12-09-2025-At 9:30pm', NULL, 0, 0),
(4, 'ABC0004', 25000002, 1, '3', 4, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0004_68c3b35167462.jpg', 'nGtyhiTtdRY2', '2025-09-12 11:14:49', '2025-09-12 11:14:49', '12-09-2025-At 9:30pm', NULL, 0, 0),
(5, 'ABC0005', 25000001, 1, '3', 1, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0005_68c3b351c75ca.jpg', 'vUMuvVB0WlGe', '2025-09-12 11:14:49', '2025-09-12 11:14:49', '12-09-2025-At 9:30pm', NULL, 0, 0),
(6, 'ABC0006', 25000002, 1, '3', 8, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0006_68c3b35247a72.jpg', 'hF8TqUx9Uqcl', '2025-09-12 11:14:50', '2025-09-12 11:14:50', '12-09-2025-At 9:30pm', NULL, 0, 0),
(7, 'ABC0007', 25000001, 1, '3', 1, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0007_68c3b352af10b.jpg', 'Ectwfyj2Qh1i', '2025-09-12 11:14:50', '2025-09-12 11:14:52', '12-09-2025-At 9:30pm', NULL, 0, 0),
(8, 'ABC0008', 25000002, 1, '3', 3, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0008_68c3b3554ae64.jpg', 'Za7SMD2Smq3R', '2025-09-12 11:14:53', '2025-09-12 11:14:53', '12-09-2025-At 9:30pm', NULL, 0, 0),
(9, 'ABC0009', 25000002, 1, '3', 2, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0009_68c3b355d2f5f.jpg', 'MXdkAHsfuSLU', '2025-09-12 11:14:53', '2025-09-12 11:14:53', '12-09-2025-At 9:30pm', NULL, 0, 0),
(10, 'ABC0010', 25000002, 1, '3', 4, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0010_68c3b3565a90a.jpg', 'Jp3GMWva4aJ6', '2025-09-12 11:14:54', '2025-09-12 11:14:54', '12-09-2025-At 9:30pm', NULL, 0, 0),
(11, 'ABC0011', 25000002, 1, '3', 1, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0011_68c3b356c5ff4.jpg', 'MToB8FBnuSJT', '2025-09-12 11:14:54', '2025-09-12 11:14:54', '12-09-2025-At 9:30pm', NULL, 0, 0),
(12, 'ABC0012', 25000001, 1, '3', 8, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0012_68c3b3572e7e2.jpg', '0gL07JCQlxmx', '2025-09-12 11:14:54', '2025-09-12 11:14:55', '12-09-2025-At 9:30pm', NULL, 0, 0),
(13, 'ABC0013', 25000001, 1, '3', 1, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0013_68c3b3578a7d1.jpg', 'iiSmFpRDHNQl', '2025-09-12 11:14:55', '2025-09-12 11:14:56', '12-09-2025-At 9:30pm', NULL, 0, 0),
(14, 'ABC0014', 25000001, 1, '3', 3, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0014_68c3b3594017d.jpg', '5c6lNj1G6SIA', '2025-09-12 11:14:57', '2025-09-12 11:14:57', '12-09-2025-At 9:30pm', NULL, 0, 0),
(15, 'ABC0015', 25000002, 2, '3', 2, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0015_68c3b359c52cf.jpg', 'oebukEp0QYzj', '2025-09-12 11:14:57', '2025-09-12 11:14:57', '12-09-2025-At 9:30pm', NULL, 0, 0),
(16, 'ABC0016', 25000002, 2, '3', 4, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0016_68c3b35a91f6e.jpg', 'lDWNo3vAnlzt', '2025-09-12 11:14:58', '2025-09-12 11:14:58', '12-09-2025-At 9:30pm', NULL, 0, 0),
(17, 'ABC0017', 25000001, 2, '3', 1, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0017_68c3b35b358a6.jpg', 'oTQF8ABoD7om', '2025-09-12 11:14:59', '2025-09-12 11:14:59', '12-09-2025-At 9:30pm', NULL, 0, 0),
(18, 'ABC0018', 25000001, 1, '3', 8, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0018_68c3b35be9a81.jpg', 'PdmvZNi2mGkC', '2025-09-12 11:14:59', '2025-09-12 11:14:59', '12-09-2025-At 9:30pm', NULL, 0, 0),
(19, 'ABC0019', 25000001, 1, '3', 1, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0019_68c3b35da5115.jpg', 'EivLNqDIlbGr', '2025-09-12 11:15:01', '2025-09-12 11:15:01', '12-09-2025-At 9:30pm', NULL, 0, 0),
(20, 'ABC0020', 25000001, 1, '3', 3, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0020_68c3b35e709a4.jpg', 'pADtAB5s2SEb', '2025-09-12 11:15:02', '2025-09-12 11:15:02', '12-09-2025-At 9:30pm', NULL, 0, 0),
(21, 'ABC0021', 25000001, 1, '1', 1, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0021_68c3b91397c7b.jpg', '8Ln88W5XWbm0', '2025-09-12 21:32:08', '2025-09-12 11:39:24', '12-09-2025-At 9:30pm', NULL, 0, 0),
(22, 'ABC0022', 25000001, 1, '1', 2, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0022_68c3b9150fc46.jpg', 'GJ7mimeO84b4', '2025-09-12 21:32:08', '2025-09-12 11:39:25', '12-09-2025-At 9:30pm', NULL, 0, 0),
(23, 'ABC0023', 25000001, 1, '1', 3, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0023_68c3b915d3816.jpg', 'zKgajjsA06CY', '2025-09-12 21:32:08', '2025-09-12 11:39:25', '12-09-2025-At 9:30pm', NULL, 0, 0),
(24, 'ABC0024', 25000001, 1, '1', 4, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0024_68c3b916ea9c3.jpg', 'wHl4yNLqWUoW', '2025-09-12 11:39:26', '2025-09-12 11:39:27', '12-09-2025-At 9:30pm', NULL, 0, 0),
(25, 'ABC0025', 25000001, 1, '1', 1, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0025_68c3b91788659.jpg', 'IKjZ9xLDwFs1', '2025-09-12 21:32:08', '2025-09-12 11:39:27', '12-09-2025-At 9:30pm', NULL, 0, 0),
(26, 'ABC0026', 25000002, 1, '1', 2, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0026_68c3b9184c232.jpg', 'RouPnhjB9dpC', '2025-09-12 11:39:28', '2025-09-12 11:39:28', '12-09-2025-At 9:30pm', NULL, 0, 0),
(27, 'ABC0027', 25000002, 1, '1', 3, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0027_68c3b918d8f2d.jpg', '7agNKGvXBVc5', '2025-09-12 21:32:08', '2025-09-12 11:39:30', '12-09-2025-At 9:30pm', NULL, 0, 0),
(28, 'ABC0028', 25000002, 2, '1', 4, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0028_68c3b91bbeb70.jpg', 'tEt0gCKeWIRe', '2025-09-12 11:39:31', '2025-09-12 11:39:31', '12-09-2025-At 9:30pm', NULL, 0, 0),
(29, 'ABC0029', 25000002, 2, '1', 1, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0029_68c3b91c7c338.jpg', 'I1Bn7UNzPu7J', '2025-09-12 11:39:32', '2025-09-12 11:39:32', '12-09-2025-At 9:30pm', NULL, 0, 0),
(30, 'ABC0030', 25000001, 2, '1', 2, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0030_68c3b91d42885.jpg', 'y6mevxq4tngJ', '2025-09-12 21:32:08', '2025-09-12 11:39:33', '12-09-2025-At 9:30pm', NULL, 0, 0),
(31, 'ABC0031', 25000003, 2, '3', 2, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0031_68c3bc518f73a.jpg', 'dkHYYCv8aBo3', '2025-09-12 11:53:13', '2025-09-12 11:53:13', '12-09-2025-At 9:30pm', NULL, 0, 0),
(32, 'ABC0032', 25000003, 2, '3', 4, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0032_68c3bc5233e49.jpg', 'hCmXtdnm3o2H', '2025-09-12 11:53:14', '2025-09-12 11:53:14', '12-09-2025-At 9:30pm', NULL, 0, 0),
(33, 'ABC0033', 25000003, 2, '3', 1, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0033_68c3bc52b85fa.jpg', 'SNZn0YDh7cmg', '2025-09-12 11:53:14', '2025-09-12 11:53:14', '12-09-2025-At 9:30pm', NULL, 0, 0),
(34, 'ABC0034', 25000003, 2, '3', 8, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0034_68c3bc5358968.jpg', 'ouNKCWTAHJxK', '2025-09-12 11:53:15', '2025-09-12 11:53:15', '12-09-2025-At 9:30pm', NULL, 0, 0),
(35, 'ABC0035', 25000003, 2, '3', 1, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0035_68c3bc53d8242.jpg', 'LT30ah2W6O2P', '2025-09-12 11:53:15', '2025-09-12 11:53:15', '12-09-2025-At 9:30pm', NULL, 0, 0),
(36, 'ABC0036', 25000001, 2, '1', 3, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0036_68c3bcce1e90a.jpg', 'YhlOiXGDhrmy', '2025-09-12 11:55:17', '2025-09-12 11:55:18', '12-09-2025-At 9:30pm', NULL, 0, 0),
(37, 'ABC0037', 25000003, 2, '1', 4, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0037_68c3bcce97fe5.jpg', '1YL4trKqPkLk', '2025-09-12 11:55:18', '2025-09-12 11:55:18', '12-09-2025-At 9:30pm', NULL, 0, 0),
(38, 'ABC0038', 25000003, 2, '1', 1, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0038_68c3bccf0b3d1.jpg', 'teAKYMsPTV9D', '2025-09-12 11:55:18', '2025-09-12 11:55:19', '12-09-2025-At 9:30pm', NULL, 0, 0),
(39, 'ABC0039', 25000003, 2, '1', 2, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0039_68c3bccf6d48b.jpg', 'ronA4hiKzZ1i', '2025-09-12 21:32:08', '2025-09-12 11:55:19', '12-09-2025-At 9:30pm', NULL, 0, 0),
(40, 'ABC0040', 25000003, 2, '1', 3, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0040_68c3bccfe6fe4.jpg', 'QGogtaq3SrJM', '2025-09-12 11:55:19', '2025-09-12 11:55:19', '12-09-2025-At 9:30pm', NULL, 0, 0),
(41, 'ABC0041', 25000001, 2, '1', 4, 0, 1, 0, 0, '0.00', 'sales/photos/ABC0041_68c444038a213.jpg', 'ZMF5OzvLs4Cy', '2025-09-12 21:32:08', '2025-09-12 21:32:11', '19-09-2025-At 9:30pm', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `first_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Make unique with country phone code',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date NOT NULL,
  `aadhar_number` int(12) NOT NULL,
  `pan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `pincode` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` int(12) NOT NULL,
  `doj` date NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_type` int(11) NOT NULL,
  `bank_ifsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_title` varchar(100) NOT NULL,
  `state_description` text,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `country_id`, `state_title`, `state_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Telangana', NULL, '1', '2025-09-11 11:40:36', '2025-09-17 05:05:41', NULL),
(2, 1, 'Karnataka', NULL, '1', '2025-09-11 11:40:44', '2025-09-17 05:05:41', NULL),
(3, 1, 'Andhra Pradesh', NULL, '1', '2025-09-11 11:40:52', '2025-09-17 05:05:41', NULL),
(4, 2, 'Singapore State', NULL, '1', '2025-09-11 11:41:05', '2025-09-17 05:05:41', NULL),
(5, 3, 'Mauritius State', NULL, '1', '2025-09-11 11:41:14', '2025-09-11 11:41:14', NULL),
(6, 4, 'Namibia State', NULL, '1', '2025-09-11 11:42:58', '2025-09-11 11:42:58', NULL),
(7, 5, 'Scotland', NULL, '1', '2025-09-11 11:45:29', '2025-09-11 11:45:29', NULL),
(8, 6, 'Sweden State', NULL, '1', '2025-09-11 11:45:43', '2025-09-11 11:45:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(10) UNSIGNED NOT NULL,
  `support_ticket_id` varchar(150) CHARACTER SET utf8mb4 DEFAULT NULL,
  `raised_by_id` varchar(150) CHARACTER SET utf8mb4 DEFAULT NULL,
  `raised_by` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryid` int(10) UNSIGNED NOT NULL,
  `subject` varchar(150) CHARACTER SET utf8mb4 DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci,
  `updated_by` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_categories`
--

CREATE TABLE `support_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_categories`
--

INSERT INTO `support_categories` (`id`, `name`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Payment', '2025-04-09 09:02:55', '2025-04-09 09:02:55', 1),
(2, 'Prize', '2025-04-09 09:02:55', '2025-04-09 09:02:55', 1),
(3, 'luckydraw', '2025-04-09 09:02:55', '2025-04-09 09:02:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `template_groups`
--

CREATE TABLE `template_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_ids` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `template_groups`
--

INSERT INTO `template_groups` (`id`, `group_name`, `template_ids`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'New', '1,4,5,6', '2025-09-12 00:03:35', '2025-09-12 08:51:13', NULL, 0),
(2, 'Test1GroupAll', '1,2,3,4,5,6,7,8', '2025-09-12 00:20:41', '2025-09-12 04:23:54', '2025-09-12 04:23:54', 1),
(3, 'NewFriday2Temp', '1,2', '2025-09-12 10:13:27', '2025-09-12 10:13:27', NULL, 1),
(4, 'NewSaturday2Temp', '3,4,8', '2025-09-12 10:14:10', '2025-09-12 10:21:04', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_currency` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_time_zone` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_language` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_website` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_logo` varchar(151) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `mobile`, `password`, `remember_token`, `profile_pic`, `default_currency`, `default_time_zone`, `default_language`, `company_name`, `address`, `company_website`, `company_logo`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@gmail.com', NULL, '99726465678', '$2y$10$DIIwaMGbF.pww66lkM.Uy.xl9v4YpU8lpgD/d7cr9PD2zb6NLKex2', '$2y$10$AKT71a.V4xGnxu6y0vTFXuVnlas6LUg3.hLKB5rIkdKiQYgeHvCbS', '../../uploads/profile/1741976285.jpg', '2', 'America/Scoresbysund	GMT-1:00', 'English', 'Demo Luckydraw Company', '713, 1st Floor, 12th Main, 1st Cross', 'https://www,luckydrawnamegoeshere.com', '../../uploads/profile/1755351916.png', '2025-01-17 21:40:26', '2025-08-16 13:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(10) UNSIGNED NOT NULL,
  `bp_id` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tx_id` varchar(150) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tx_date` datetime NOT NULL,
  `amount` int(10) NOT NULL,
  `tx_type` tinyint(3) DEFAULT NULL COMMENT '1: Online, 2: Offline',
  `tx_mode` tinyint(3) DEFAULT NULL COMMENT '1=Paypal 2=Razorpay 3=Instamojo 4=Stripe 5=Mollie 6=FLW 7=Authorizenet 8=Midtrans  9=Payfast 10=Cashfree 11=Marcadopago 12=Squareup 13=Flutterwave 14=Paystack 15=Cinetpay 16=Zitopay',
  `tx_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payer_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payer_email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `bp_id`, `tx_id`, `tx_date`, `amount`, `tx_type`, `tx_mode`, `tx_proof`, `remarks`, `payment_id`, `payer_id`, `payer_email`, `created_at`, `updated_at`, `status`) VALUES
(1, '1', 'ABC1234', '2025-09-16 00:00:00', 1000, 1, 1, '1758028245.jpg', 'Some text', NULL, NULL, NULL, '2025-09-16 18:40:45', '2025-09-16 18:40:45', 1),
(2, '2', 'AKJGSHDI', '2025-09-10 00:00:00', 100, 1, 2, NULL, NULL, NULL, NULL, NULL, '2025-09-17 00:06:48', '2025-09-17 00:06:48', 1),
(3, '1', 'SKFDNH3U9', '2025-09-08 00:00:00', 343, 2, 2, NULL, NULL, NULL, NULL, NULL, '2025-09-17 00:07:11', '2025-09-17 00:07:11', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_area`
--
ALTER TABLE `business_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_partners`
--
ALTER TABLE `business_partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers_groups`
--
ALTER TABLE `customers_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_payment_gateway`
--
ALTER TABLE `general_payment_gateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `luckydraws`
--
ALTER TABLE `luckydraws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `luckydraw_template`
--
ALTER TABLE `luckydraw_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prizes`
--
ALTER TABLE `prizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prize_distribution`
--
ALTER TABLE `prize_distribution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prize_manager`
--
ALTER TABLE `prize_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_categories`
--
ALTER TABLE `support_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_groups`
--
ALTER TABLE `template_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_area`
--
ALTER TABLE `business_area`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `business_partners`
--
ALTER TABLE `business_partners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers_groups`
--
ALTER TABLE `customers_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_payment_gateway`
--
ALTER TABLE `general_payment_gateway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `luckydraws`
--
ALTER TABLE `luckydraws`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `luckydraw_template`
--
ALTER TABLE `luckydraw_template`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prizes`
--
ALTER TABLE `prizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prize_distribution`
--
ALTER TABLE `prize_distribution`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prize_manager`
--
ALTER TABLE `prize_manager`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_categories`
--
ALTER TABLE `support_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template_groups`
--
ALTER TABLE `template_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
