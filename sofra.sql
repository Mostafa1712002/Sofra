-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2021 at 08:56 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sofra`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `name`) VALUES
(2, '2021-07-23 20:49:02', '2021-07-20 20:49:02', 'الخضروات'),
(3, '2021-08-17 22:00:00', '2021-08-04 22:00:00', 'cahn'),
(6, '2021-09-02 16:21:11', '2021-09-02 16:21:23', 'قسم البلح');

-- --------------------------------------------------------

--
-- Table structure for table `category_restaurant`
--

CREATE TABLE `category_restaurant` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `restaurant_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_restaurant`
--

INSERT INTO `category_restaurant` (`id`, `created_at`, `updated_at`, `category_id`, `restaurant_id`) VALUES
(2, NULL, NULL, 2, 5),
(4, NULL, NULL, 2, 6),
(6, NULL, NULL, 2, 7),
(8, NULL, NULL, 2, 8),
(10, NULL, NULL, 2, 9),
(12, NULL, NULL, 2, 10),
(14, NULL, NULL, 2, 11),
(17, NULL, NULL, 3, 12),
(19, NULL, NULL, 2, 13),
(21, NULL, NULL, 2, 14),
(23, NULL, NULL, 2, 15),
(25, NULL, NULL, 2, 16),
(27, NULL, NULL, 2, 17),
(29, NULL, NULL, 2, 18),
(31, NULL, NULL, 2, 19),
(33, NULL, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1, '2021-07-09 20:49:02', '2021-07-16 20:48:03', 'رياض'),
(2, '2021-07-10 20:48:21', '2021-07-15 20:48:03', 'المنصوره'),
(5, '2021-09-02 13:50:06', '2021-09-02 13:50:06', 'شبيسيسبؤ'),
(7, '2021-09-02 13:54:23', '2021-09-02 13:54:23', 'يبشسبيشسبي'),
(12, '2021-09-02 15:13:03', '2021-09-02 15:13:03', 'ljljfdslalkjlasdf');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pin_code` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `district_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `created_at`, `updated_at`, `name`, `email`, `password`, `pin_code`, `phone`, `image`, `active`, `district_id`) VALUES
(5, '2021-08-30 17:32:59', '2021-09-05 08:56:33', 'Mostafa1', 'mostafa@gmai.fda', '$2y$10$ZDBwfXOOGY4W5qIfS4kbmePK9eweWcBLnIZn2moB759bIjcTP2BEO', NULL, '010111236456;', 'images/clients/profile/16303519790d242ce97ece7e88a5417e6a7bdfe586.jpg', 0, 1),
(35, '2021-08-30 17:42:47', '2021-08-30 17:42:47', 'alsayeddasf', 'mostafa@gmai.fdaaaaasdf', '$2y$10$ru.YlBRqUdM.r2Guyhp85.jIKLpaqz0fGCnILueGNgZe75ntA25Qm', NULL, '010111236456a', 'images/clients/profile/16303525677ea1028950c14149ef5969983d8e3f02.jpg', 0, 2),
(38, '2021-08-30 17:42:47', '2021-08-30 17:42:47', 'alsayed', 'mostafa@gmai.fdaaaa', '$2y$10$ru.YlBRqUdM.r2Guyhp85.jIKLpaqz0fGCnILueGNgZe75ntA25Qm', NULL, '010111236456a', 'images/clients/profile/16303525677ea1028950c14149ef5969983d8e3f02.jpg', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` text NOT NULL,
  `rating` enum('star1','star2','star3','star4','star5') NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `restaurant_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `created_at`, `updated_at`, `content`, `rating`, `client_id`, `restaurant_id`) VALUES
(1, '2021-07-09 20:49:02', '2021-07-01 21:09:26', 'kj', 'star3', 1, 1),
(2, '2021-08-23 12:32:51', '2021-08-23 12:32:51', 'content test', 'star4', 1, 1),
(3, '2021-08-23 13:06:58', '2021-08-23 13:06:58', 'content test', 'star4', 1, 1),
(4, '2021-08-23 13:18:52', '2021-08-23 13:18:52', 'content test', 'star4', 1, 1),
(5, '2021-08-30 18:00:55', '2021-08-30 18:00:55', 'content test', 'star4', 37, 1),
(6, '2021-08-30 18:01:32', '2021-08-30 18:01:32', 'content test', 'star4', 37, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` enum('complaint','suggest','query') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `created_at`, `updated_at`, `full_name`, `email`, `phone`, `message`, `type`) VALUES
(1, '2021-08-23 14:29:37', '2021-08-23 14:29:37', 'one', 'emai@gmail.com', '1', 'three', 'complaint'),
(2, '2021-08-27 10:12:48', '2021-08-27 10:12:48', 'content test', 'emai@gmail.com', '2', '1', 'suggest'),
(3, '2021-08-21 10:16:23', '2021-08-27 10:16:23', 'two', 'emailone', '654654', 'two', 'query'),
(4, '2021-08-27 10:16:58', '2021-08-27 10:16:58', 'content test', 'emailtwo', '264662', '1', 'query');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `created_at`, `updated_at`, `name`, `city_id`) VALUES
(1, '2021-08-17 09:50:46', '2021-07-20 20:49:02', 'حي شرق', 1),
(2, '2021-09-02 15:15:07', '2021-09-02 15:28:27', 'الدقهليه', 2),
(4, '2021-09-02 15:13:30', '2021-09-02 15:13:30', 'restaurant_id', 5),
(5, '2021-09-02 15:13:43', '2021-09-02 15:13:43', 'restaurant_id', 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_08_22_202921_create_categories_table', 1),
(6, '2021_08_22_202921_create_category_restaurant_table', 1),
(7, '2021_08_22_202921_create_cities_table', 1),
(8, '2021_08_22_202921_create_clients_table', 1),
(9, '2021_08_22_202921_create_comments_table', 1),
(10, '2021_08_22_202921_create_contacts_table', 1),
(11, '2021_08_22_202921_create_districts_table', 1),
(12, '2021_08_22_202921_create_notifications_table', 1),
(13, '2021_08_22_202921_create_offers_table', 1),
(14, '2021_08_22_202921_create_order_product_table', 1),
(15, '2021_08_22_202921_create_orders_table', 1),
(16, '2021_08_22_202921_create_payments_table', 1),
(17, '2021_08_22_202921_create_products_table', 1),
(18, '2021_08_22_202921_create_restaurants_table', 1),
(19, '2021_08_22_202921_create_settings_table', 1),
(20, '2021_08_22_202921_create_tokens_table', 1),
(21, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(22, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(23, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(24, '2016_06_01_000004_create_oauth_clients_table', 2),
(25, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(26, '2021_09_02_093233_create_permission_tables', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 8),
(4, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(4) DEFAULT 0,
  `order_id` int(11) NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`created_at`, `updated_at`, `id`, `title`, `content`, `is_read`, `order_id`, `notifiable_id`, `notifiable_type`) VALUES
('2021-08-28 17:06:48', '2021-08-28 17:06:48', 1, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 35, 1, 'App\\Models\\Restaurant'),
('2021-08-28 17:24:33', '2021-08-28 17:24:33', 2, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 36, 5, 'App\\Models\\Restaurant'),
('2021-08-28 17:26:43', '2021-08-28 17:26:43', 3, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 37, 5, 'App\\Models\\Restaurant'),
('2021-08-28 17:29:18', '2021-08-28 17:29:18', 4, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 38, 5, 'App\\Models\\Restaurant'),
('2021-08-28 17:29:28', '2021-08-28 17:29:28', 5, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 39, 5, 'App\\Models\\Restaurant'),
('2021-08-28 17:31:12', '2021-08-28 17:31:12', 6, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 40, 5, 'App\\Models\\Restaurant'),
('2021-08-28 17:33:31', '2021-08-28 17:33:31', 7, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 41, 5, 'App\\Models\\Restaurant'),
('2021-08-28 17:34:35', '2021-08-28 17:34:35', 8, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 42, 5, 'App\\Models\\Restaurant'),
('2021-08-28 17:36:42', '2021-08-28 17:36:42', 9, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 43, 5, 'App\\Models\\Restaurant'),
('2021-08-28 17:38:58', '2021-08-28 17:38:58', 10, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 45, 5, 'App\\Models\\Restaurant'),
('2021-08-28 17:42:29', '2021-08-28 17:42:29', 11, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 47, 5, 'App\\Models\\Restaurant'),
('2021-08-28 18:11:37', '2021-08-28 18:11:37', 12, 'Mostafa1عملينا العزيز   ', 'نأسف تم حدف طلبك لاسباب خاصه بسياسة المطعم حاول مره آخر', 0, 13, 35, 'App\\Models\\Client'),
('2021-08-28 18:40:22', '2021-08-28 18:40:22', 13, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 48, 5, 'App\\Models\\Restaurant'),
('2021-08-28 18:48:04', '2021-08-28 18:48:04', 14, 'Mostafa1عملينا العزيز   ', 'سوف يصل طلبك خلال 02:14:27', 0, 48, 35, 'App\\Models\\Client'),
('2021-08-28 18:49:13', '2021-08-28 18:49:13', 15, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 49, 5, 'App\\Models\\Restaurant'),
('2021-08-28 18:49:15', '2021-08-28 18:49:15', 16, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 50, 5, 'App\\Models\\Restaurant'),
('2021-08-28 18:49:16', '2021-08-28 18:49:16', 17, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 51, 5, 'App\\Models\\Restaurant'),
('2021-08-28 19:26:15', '2021-08-28 19:26:15', 18, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 52, 1, 'App\\Models\\Restaurant'),
('2021-08-28 19:26:40', '2021-08-28 19:26:40', 19, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 53, 5, 'App\\Models\\Restaurant'),
('2021-08-28 19:28:16', '2021-08-28 19:28:16', 20, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 54, 5, 'App\\Models\\Restaurant'),
('2021-08-28 19:29:29', '2021-08-28 19:29:29', 21, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 55, 5, 'App\\Models\\Restaurant'),
('2021-08-28 19:31:21', '2021-08-28 19:31:21', 22, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 56, 5, 'App\\Models\\Restaurant'),
('2021-08-28 19:31:22', '2021-08-28 19:31:22', 23, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 57, 5, 'App\\Models\\Restaurant'),
('2021-08-28 19:31:24', '2021-08-28 19:31:24', 24, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 58, 5, 'App\\Models\\Restaurant'),
('2021-08-28 19:31:25', '2021-08-28 19:31:25', 25, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 59, 5, 'App\\Models\\Restaurant'),
('2021-08-28 19:31:27', '2021-08-28 19:31:27', 26, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 60, 5, 'App\\Models\\Restaurant'),
('2021-08-28 19:32:24', '2021-08-28 19:32:24', 27, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 61, 5, 'App\\Models\\Restaurant'),
('2021-08-28 19:38:28', '2021-08-28 19:38:28', 28, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 62, 5, 'App\\Models\\Restaurant'),
('2021-08-28 19:39:23', '2021-08-28 19:39:23', 29, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-28 19:40:38', '2021-08-28 19:40:38', 30, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 64, 5, 'App\\Models\\Restaurant'),
('2021-08-28 20:15:43', '2021-08-28 20:15:43', 31, 'Mostafa1 عملينا العزيز   ', 'سوف يصل طلبك خلال 02:14:27', 0, 63, 35, 'App\\Models\\Client'),
('2021-08-28 20:17:01', '2021-08-28 20:17:01', 32, 'Mostafa1 عملينا العزيز   ', 'سوف يصل طلبك خلال 02:14:27', 0, 63, 35, 'App\\Models\\Client'),
('2021-08-28 20:22:36', '2021-08-28 20:22:36', 33, 'Mostafa1 عملينا العزيز   ', ' سوف يصل طلبك خلال بضع دقائق ', 0, 60, 35, 'App\\Models\\Client'),
('2021-08-28 20:55:08', '2021-08-28 20:55:08', 34, 'Mostafa13 عملينا العزيز   ', 'قم العميل رقم adsf بالغاء الطلب رقم  63', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-28 20:55:44', '2021-08-28 20:55:44', 35, 'Mostafa13 عملينا العزيز   ', ' بالغاء الطلب رقم  63قم العميل رقم adsf', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-28 20:59:59', '2021-08-28 20:59:59', 36, 'Mostafa13 عملينا العزيز   ', 'قام العميل  {{ adsf }} بالغاء الطلب {{ 63 }}', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-28 21:00:13', '2021-08-28 21:00:13', 37, 'Mostafa13 عملينا العزيز   ', 'قام العميل   adsf  بالغاء الطلب  63 ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-28 21:00:27', '2021-08-28 21:00:27', 38, 'Mostafa13 عملينا العزيز   ', 'قام العميل     بالغاء الطلبadsf  63 ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-28 21:00:32', '2021-08-28 21:00:32', 39, 'Mostafa13 عملينا العزيز   ', 'قام العميل   adsf  بالغاء الطلب  63 ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-28 21:01:12', '2021-08-28 21:01:12', 40, 'Mostafa13 عملينا العزيز   ', 'قام العميل      الطلبadsf   ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-28 21:01:26', '2021-08-28 21:01:26', 41, 'Mostafa13 عملينا العزيز   ', 'قام العميل    63 بالغاء الطلبadsf   ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-28 21:01:50', '2021-08-28 21:01:50', 42, 'Mostafa13 عملينا العزيز   ', '   63 بالغاء الطلبadsf قام العميل   ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-28 21:01:57', '2021-08-28 21:01:57', 43, 'Mostafa13 عملينا العزيز   ', '   63 بالغاء الطلب adsf قام العميل       ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-28 21:02:23', '2021-08-28 21:02:23', 44, 'Mostafa13 عملينا العزيز   ', '   63  بالغاء الطلب رقم   adsf قام العميل ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-28 21:03:02', '2021-08-28 21:03:02', 45, 'Mostafa13 عملينا العزيز   ', '   63  بالغاء الطلب رقم   adsf قام العميل ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-28 21:25:24', '2021-08-28 21:25:24', 46, 'Mostafa13 عملينا العزيز   ', ' 63   بأستلام الطلب رقم   adsf قام العميل ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-29 07:17:55', '2021-08-29 07:17:55', 47, 'Mostafa13 عملينا العزيز   ', '   63  بالغاء الطلب رقم   adsf قام العميل ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-29 07:18:27', '2021-08-29 07:18:27', 48, 'Mostafa13 عملينا العزيز   ', '   63  بالغاء الطلب رقم   adsf قام العميل ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-29 07:18:31', '2021-08-29 07:18:31', 49, 'Mostafa13 عملينا العزيز   ', '   62  بالغاء الطلب رقم   adsf قام العميل ', 0, 62, 5, 'App\\Models\\Restaurant'),
('2021-08-29 07:24:42', '2021-08-29 07:24:42', 50, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 65, 5, 'App\\Models\\Restaurant'),
('2021-08-29 07:25:11', '2021-08-29 07:25:11', 51, 'Mostafa13 عملينا العزيز   ', ' 63   بأستلام الطلب رقم   adsf قام العميل ', 0, 63, 5, 'App\\Models\\Restaurant'),
('2021-08-30 16:37:18', '2021-08-30 16:37:18', 52, 'adsf عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 16:37:30', '2021-08-30 16:37:30', 53, 'adsf عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 16:37:37', '2021-08-30 16:37:37', 54, 'adsf عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 16:37:47', '2021-08-30 16:37:47', 55, 'adsf عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 16:37:58', '2021-08-30 16:37:58', 56, 'adsf عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 16:38:14', '2021-08-30 16:38:14', 57, 'adsf عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 16:38:28', '2021-08-30 16:38:28', 58, 'adsf عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 16:39:00', '2021-08-30 16:39:00', 59, 'adsf عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 18:32:36', '2021-08-30 18:32:36', 60, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 66, 5, 'App\\Models\\Restaurant'),
('2021-08-30 18:33:22', '2021-08-30 18:33:22', 61, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 67, 5, 'App\\Models\\Restaurant'),
('2021-08-30 18:33:51', '2021-08-30 18:33:51', 62, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 68, 5, 'App\\Models\\Restaurant'),
('2021-08-30 18:34:09', '2021-08-30 18:34:09', 63, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 69, 5, 'App\\Models\\Restaurant'),
('2021-08-30 18:42:55', '2021-08-30 18:42:55', 64, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 70, 5, 'App\\Models\\Restaurant'),
('2021-08-30 18:42:58', '2021-08-30 18:42:58', 65, ' لديك اشعار من عميل  ', 'Mostafa1هناك طلب من  ', 0, 71, 5, 'App\\Models\\Restaurant'),
('2021-08-30 18:52:22', '2021-08-30 18:52:22', 66, 'Mostafa13 عملينا العزيز   ', '  71  بالغاء الطلب رقم   Mostafa1 قام العميل ', 0, 71, 5, 'App\\Models\\Restaurant'),
('2021-08-30 18:57:29', '2021-08-30 18:57:29', 67, 'Mostafa13 عملينا العزيز   ', '  71  بالغاء الطلب رقم   Mostafa1 قام العميل ', 0, 71, 5, 'App\\Models\\Restaurant'),
('2021-08-30 18:57:41', '2021-08-30 18:57:41', 68, 'Mostafa13 عملينا العزيز   ', '  71  بالغاء الطلب رقم   Mostafa1 قام العميل ', 0, 71, 5, 'App\\Models\\Restaurant'),
('2021-08-30 19:00:00', '2021-08-30 19:00:00', 69, 'Mostafa13 عملينا العزيز   ', ' 71   بأستلام الطلب رقم   Mostafa1 قام العميل ', 0, 71, 5, 'App\\Models\\Restaurant'),
('2021-08-30 19:00:30', '2021-08-30 19:00:30', 70, 'Mostafa13 عملينا العزيز   ', ' 71   بأستلام الطلب رقم   Mostafa1 قام العميل ', 0, 71, 5, 'App\\Models\\Restaurant'),
('2021-08-30 19:20:22', '2021-08-30 19:20:22', 71, 'Mostafa1 عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 19:20:36', '2021-08-30 19:20:36', 72, 'Mostafa1 عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 19:22:14', '2021-08-30 19:22:14', 73, 'Mostafa1 عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 19:22:44', '2021-08-30 19:22:44', 74, 'Mostafa1 عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 19:23:33', '2021-08-30 19:23:33', 75, 'Mostafa1 عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 19:23:39', '2021-08-30 19:23:39', 76, 'Mostafa1 عملينا العزيز   ', 'تم استلام طلبك  ', 0, 63, 5, 'App\\Models\\Client'),
('2021-08-30 19:35:07', '2021-08-30 19:35:07', 77, 'Mostafa1 عملينا العزيز   ', ' سوف يصل طلبك خلال بضع دقائق ', 0, 60, 5, 'App\\Models\\Client'),
('2021-08-30 19:35:37', '2021-08-30 19:35:37', 78, 'Mostafa1 عملينا العزيز   ', ' سوف يصل طلبك خلال بضع دقائق ', 0, 60, 5, 'App\\Models\\Client'),
('2021-08-30 19:35:53', '2021-08-30 19:35:53', 79, 'Mostafa1 عملينا العزيز   ', ' سوف يصل طلبك خلال بضع دقائق ', 0, 60, 5, 'App\\Models\\Client'),
('2021-08-30 19:35:58', '2021-08-30 19:35:58', 80, 'Mostafa1 عملينا العزيز   ', ' سوف يصل طلبك خلال بضع دقائق ', 0, 60, 5, 'App\\Models\\Client'),
('2021-08-30 19:37:52', '2021-08-30 19:37:52', 81, 'Mostafa1 عملينا العزيز   ', ' سوف يصل طلبك خلال بضع دقائق ', 0, 60, 5, 'App\\Models\\Client'),
('2021-08-30 19:38:35', '2021-08-30 19:38:35', 82, 'Mostafa1عملينا العزيز   ', 'نأسف تم حدف طلبك لاسباب خاصه بسياسة المطعم حاول مره آخر', 0, 60, 5, 'App\\Models\\Client'),
('2021-09-06 01:58:01', '2021-09-06 01:58:01', 83, 'restaurant name عملينا العزيز   ', '  71  بالغاء الطلب رقم   alsayed قام العميل ', 0, 71, 5, 'App\\Models\\Restaurant'),
('2021-09-06 02:00:07', '2021-09-06 02:00:07', 84, 'restaurant name عملينا العزيز   ', '  71  بالغاء الطلب رقم   alsayed قام العميل ', 0, 71, 5, 'App\\Models\\Restaurant');

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
('05d65dda01dc07f6e8471d7c51f7839bcadd3c7e2654b227550839bf427aa0c42e352857d5ce5545', 3, 3, 'authToken', '[]', 0, '2021-08-26 18:53:30', '2021-08-26 18:53:30', '2022-08-26 20:53:30'),
('06a6fc350438719ec2aa42f502ca3c758890629855573fa76350ba1eed29fb687be8efd513e472da', 37, 3, 'authToken', '[]', 0, '2021-08-30 17:32:59', '2021-08-30 17:32:59', '2022-08-30 19:32:59'),
('0758b1b33a0aed89afa8afbf663f355cc89ac1d37982b2e08a5015c9dae8f410e06638972b820a9f', 6, 3, 'authToken', '[]', 0, '2021-08-26 19:00:37', '2021-08-26 19:00:37', '2022-08-26 21:00:37'),
('07a1a8870f6e394e742dee2f7960a689940988b2d09147fc8f186ee2d3a64f135d9f5203bd8078f5', 25, 3, 'authToken', '[]', 0, '2021-08-26 19:26:58', '2021-08-26 19:26:58', '2022-08-26 21:26:58'),
('0b0ed1387333aeb7f670f0b024dab06ec07b46eb35fdcdb2782061f6b8da0397070e4d083604f500', 8, 3, 'authToken', '[]', 0, '2021-08-26 19:06:49', '2021-08-26 19:06:49', '2022-08-26 21:06:49'),
('0bfaf21fbc6348a7e9b66c4550f8da9ec55455f729ba2647440516230c21aabad4e77fcb36e81ec9', 5, 3, 'authToken', '[]', 0, '2021-08-28 13:34:42', '2021-08-28 13:34:42', '2022-08-28 15:34:42'),
('0c7b257dff483ac983b4ee3e1a8eab59825140d332393558e067db3731bf585f27dcc2fa71d959a4', 39, 3, 'authToken', '[]', 0, '2021-09-05 03:34:17', '2021-09-05 03:34:17', '2022-09-05 05:34:17'),
('0d326f7368be72ee998df28a865348b0977f4ea444918850af00d33234da3681905622f4c016ada4', 10, 3, 'authToken', '[]', 0, '2021-08-26 19:08:50', '2021-08-26 19:08:50', '2022-08-26 21:08:50'),
('0e57776ee9c162ea4fd5a3be20cf7f8d77a797371c38d9f364fbbba8aede513ef62e81d04e45cdb1', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:18:12', '2021-08-27 02:18:12', '2022-08-27 04:18:12'),
('0e5cef293d7e5629397d38e807455b4cc3df40ac167c220331dcedd545bafbf4de7d726b34543dee', 35, 3, 'authToken', '[]', 0, '2021-09-05 19:12:57', '2021-09-05 19:12:57', '2022-09-05 21:12:57'),
('10798bebf32cd32c354df916ffe95ecb549ebe459f460b9f6a00a574c4277a034f426951fcdf60eb', 35, 3, 'authToken', '[]', 0, '2021-08-28 10:04:38', '2021-08-28 10:04:38', '2022-08-28 12:04:38'),
('10891f13e361466ba76feeef728a574af8c3311a774de1b2ffda7ac0c49962c9300b5b5c4e4bd370', 30, 3, 'authToken', '[]', 0, '2021-08-26 19:34:36', '2021-08-26 19:34:36', '2022-08-26 21:34:36'),
('10c565becda890208041a1bc84ba94e6dc71c95960528765b21819a6084db6a437786dd975572d22', 7, 3, 'authToken', '[]', 0, '2021-08-26 19:06:01', '2021-08-26 19:06:01', '2022-08-26 21:06:01'),
('12a4c7e34e9bf80d0ee04c7bc63916eac11724d588be7d3d3b9b8aa1182092eaafb31c02889f0640', 5, 3, 'authToken', '[]', 0, '2021-08-27 01:50:34', '2021-08-27 01:50:34', '2022-08-27 03:50:34'),
('130ecf02209da2dc89e1b7eb07bf4b1ba7fd31736efcd8c80198410da030da05a69f728b14906cd3', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:15:44', '2021-08-27 02:15:44', '2022-08-27 04:15:44'),
('14b3973070c5c3b8458198372437178774d78e6fc9405735db38404277785b15ddae0cf656e5a3a5', 5, 3, 'authToken', '[]', 0, '2021-08-26 18:59:37', '2021-08-26 18:59:37', '2022-08-26 20:59:37'),
('1736c25feedc48c1e076cfb47d2f0f5fb540e0c6074fa3f8d7be50e5b2cd4b0238060a0660d143e4', 4, 3, 'authToken', '[]', 0, '2021-08-26 18:56:49', '2021-08-26 18:56:49', '2022-08-26 20:56:49'),
('1ef2db8fd428d8f0f01f045146a13951fc24a719c3337ec67f5d845a66dfa6c3bcd0bbb4e332e878', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:17:48', '2021-08-27 02:17:48', '2022-08-27 04:17:48'),
('1f44629ebcdafa37e1bd655102a6ef339ae634bf90c6381dad20f9cfb1edb4b8541e1927ae72181f', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:10:56', '2021-08-27 02:10:56', '2022-08-27 04:10:56'),
('1ff06e05597f886c395cf995def86f0cd0dfbc40b1c33111d9dff4106c81e6a211bf7ef404520f44', 12, 3, 'authToken', '[]', 0, '2021-08-28 09:19:11', '2021-08-28 09:19:11', '2022-08-28 11:19:11'),
('20a179b61bfa6d7b608caa975aed3f4aa929bcdf2579f0be396ff37ace1d5d7c88d8dae7b152658d', 14, 3, 'authToken', '[]', 0, '2021-08-30 10:10:19', '2021-08-30 10:10:19', '2022-08-30 12:10:19'),
('20d0e02a21043d8f84f25aa8fb49dea62e2ed6b936467ed483ade0d664f2d26d02a209ea24fc1391', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:15:12', '2021-08-27 02:15:12', '2022-08-27 04:15:12'),
('23a86a6a106f799c25823e794580b02efbe109291aa8953f21fbf5c73bbbecaf3afa145c05ef80a3', 5, 3, 'authToken', '[]', 0, '2021-09-05 19:20:43', '2021-09-05 19:20:43', '2022-09-05 21:20:43'),
('2810d7bd198f551770d530c422572bd9292a62a5ab1fd108aed873146fef64df0a75bb31742bb82d', 27, 3, 'authToken', '[]', 0, '2021-08-26 19:30:00', '2021-08-26 19:30:00', '2022-08-26 21:30:00'),
('28e6479fc75645fe0a8f9bc26437a4b9e08acfc6f2ff77e326bdc1d10c8d1a04bae29c5a6f830c6f', 32, 3, 'authToken', '[]', 0, '2021-08-28 09:49:18', '2021-08-28 09:49:18', '2022-08-28 11:49:18'),
('2ad4ba581df05689974add796793efbe5251e92f1bf9035a1530aedc140969a3a8b8cc895d8b1ae9', 5, 3, 'authToken', '[]', 0, '2021-08-28 13:39:58', '2021-08-28 13:39:58', '2022-08-28 15:39:58'),
('2c45dcc0a396d7b0afe4353e037cbcd31a15099aa366b4582225bcaaef89286c9dddc2dc8aee3538', 5, 3, 'authToken', '[]', 0, '2021-08-28 13:40:02', '2021-08-28 13:40:02', '2022-08-28 15:40:02'),
('2c72ea16b2dc7c13c3e4a690cfd03bc73cc385e635dd2e54cd1792278afa0260e16e3bd559f79dd8', 26, 3, 'authToken', '[]', 0, '2021-08-26 19:28:09', '2021-08-26 19:28:09', '2022-08-26 21:28:09'),
('2d218e281add50201dc34ed2b891c81f8ed64e9ee5f3aa3a0c3598e004a0453df08f8ec1a615cbd1', 5, 3, 'authToken', '[]', 0, '2021-08-30 17:17:05', '2021-08-30 17:17:05', '2022-08-30 19:17:05'),
('2d55d40bb261b5282dd767bfb1bcf7ac4f2b739cdbf1d8caa7ff84a58c4b247ad246d83a7ed1a30c', 1, 3, 'authToken', '[]', 0, '2021-08-29 08:56:42', '2021-08-29 08:56:42', '2022-08-29 10:56:42'),
('307bda45ffe2d41c49800457c5541d89bf3a151188a5a6a75ad8cc82ac667662f9b8e528047daa55', 7, 3, 'authToken', '[]', 0, '2021-08-27 01:54:52', '2021-08-27 01:54:52', '2022-08-27 03:54:52'),
('32c8d9a7c7dddf98e4bfa5a7c1e261bf78e162f7f05a4943cadadea8ad312208defbe473f55da660', 2, 3, 'authToken', '[]', 0, '2021-08-30 17:16:31', '2021-08-30 17:16:31', '2022-08-30 19:16:31'),
('33794023d713e86df01d050255a5ee3ed67419a5a73015f8aa4ac7dd0080083e345850d8fd44a388', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:18:52', '2021-08-27 02:18:52', '2022-08-27 04:18:52'),
('338025e29e2214af3ad3b42da0561a7aaa9af1f2534ec386a5b9ba6e68daf8c09142ea74f0293f99', 9, 3, 'authToken', '[]', 0, '2021-08-26 19:07:22', '2021-08-26 19:07:22', '2022-08-26 21:07:22'),
('33cc01996034d1a90881c0407460c184a7e5837602c3a7162fef82ac6ca9dc5ffc2ccc9301ea9545', 5, 3, 'authToken', '[]', 0, '2021-08-30 10:31:40', '2021-08-30 10:31:40', '2022-08-30 12:31:40'),
('342b28f27d0cf848b61a35b203d2be3e75f77c218eff9da920845bf2b8fe11b2dfbc8649f6b8d76c', 5, 3, 'authToken', '[]', 0, '2021-08-27 02:04:51', '2021-08-27 02:04:51', '2022-08-27 04:04:51'),
('350efc4d5621d195433dbbe634da2d960bd5d7b6c556e41cdb8ddf6307941ac8b3abfac69db77411', 16, 3, 'authToken', '[]', 0, '2021-08-26 19:14:55', '2021-08-26 19:14:55', '2022-08-26 21:14:55'),
('36e0edd949010e33fc0fa14331d606dec0f9380091718a51682c30c25183c110aa5713e1e2dc7f6d', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:18:45', '2021-08-27 02:18:45', '2022-08-27 04:18:45'),
('38f6f0bbbd2a47da2e616d9edcbcc9ded240258bf5338c7cb0a9407e5cdafae1e81b258b224c2c7a', 38, 3, 'authToken', '[]', 0, '2021-08-30 18:28:02', '2021-08-30 18:28:02', '2022-08-30 20:28:02'),
('3c583995ceb62dcb04e7b3e8598d26adb94bd426409f575987e10f0513ee3c56cac0925617915dda', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:20:31', '2021-08-27 02:20:31', '2022-08-27 04:20:31'),
('3fbd13a1078155fdea4a560db32b58a3ce8f1dff75093fc87afe0221423106000857d8d3a60639a2', 5, 3, 'authToken', '[]', 0, '2021-08-28 13:36:29', '2021-08-28 13:36:29', '2022-08-28 15:36:29'),
('4014344d9eb68301df0a63cbc8e3f11b4d125591f6d4ab88cc135eec1c92d822755353df829dd91b', 20, 3, 'authToken', '[]', 0, '2021-08-26 19:22:45', '2021-08-26 19:22:45', '2022-08-26 21:22:45'),
('4426c1014e639a921a84d0e31716468722d457c07ec9c1cc955a2741a48cfeba79efad1a7dc12c03', 12, 3, 'authToken', '[]', 0, '2021-08-26 19:11:52', '2021-08-26 19:11:52', '2022-08-26 21:11:52'),
('46235300baa4d411a29f1fceb283034ea16ca6e7d58e6d6aac707208331ac00b0c816bd4132ce052', 34, 3, 'authToken', '[]', 0, '2021-08-28 09:54:48', '2021-08-28 09:54:48', '2022-08-28 11:54:48'),
('468dd38e8bdffcb527ed9da8757b47b918eb949cc2de1841845dd8589c7ac02ee2690053f58d757e', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:20:58', '2021-08-27 02:20:58', '2022-08-27 04:20:58'),
('4739a6ad084a2d0607a13200d779fe938836ef0c1e02d88bd94ed9f90c7164bec7bd3f01d5f35ab8', 5, 3, 'authToken', '[]', 0, '2021-08-27 02:08:30', '2021-08-27 02:08:30', '2022-08-27 04:08:30'),
('4b556db8cf34d6e4c10a007ff1680ecee8900f8a04f009a9cab69660100464db37782681c46a0335', 15, 3, 'authToken', '[]', 0, '2021-08-26 19:14:22', '2021-08-26 19:14:22', '2022-08-26 21:14:22'),
('4e530fe193379c210b706b5537d198aafd8c655c38235b3486cc7eca1d870406352925ecb5e57b8d', 2, 3, 'authToken', '[]', 0, '2021-08-30 17:24:13', '2021-08-30 17:24:13', '2022-08-30 19:24:13'),
('5503af96321b3f5627ecffbc5e5a2143237b1d6381f49541c0356942c78337b4ded1358bb4afc31c', 5, 3, 'authToken', '[]', 0, '2021-08-28 13:40:00', '2021-08-28 13:40:00', '2022-08-28 15:40:00'),
('55367efd71e3a74bff01abc76c9432a99aaf556af1332d8b37d889b9772941d96293560bf3dab34f', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:16:48', '2021-08-27 02:16:48', '2022-08-27 04:16:48'),
('5717751050b736a260d6a21a8c3daee7d69bfcf00782098cf1da03bf3f1abef70e7e6a13c53fe756', 2, 3, 'authToken', '[]', 0, '2021-08-26 15:48:26', '2021-08-26 15:48:26', '2022-08-26 17:48:26'),
('57330f4a315ef4fcc236775eb4830eb7d6e8a9e9292ea7653afab563d627086512a67b74b5731654', 5, 3, 'authToken', '[]', 0, '2021-08-28 13:54:48', '2021-08-28 13:54:48', '2022-08-28 15:54:48'),
('580ac5c5d22c0cddf0e72ae8bd73b4d8218925410efa03cea1249ff2d1f97e9df72680f074d2e19a', 1, 3, 'authToken', '[]', 0, '2021-08-29 09:13:07', '2021-08-29 09:13:07', '2022-08-29 11:13:07'),
('5ad3fc56410fadb0faf70088ec60f6485f9099629fba25525b51c7a4b285dfc2ce70ff5cb7f9c203', 1, 3, 'authToken', '[]', 0, '2021-08-29 09:11:54', '2021-08-29 09:11:54', '2022-08-29 11:11:54'),
('60e88031966e77812bbff419109c64c2ac593699124055d0e14bddd6b64741f1b27fd6692b45946d', 15, 3, 'authToken', '[]', 0, '2021-08-30 10:13:57', '2021-08-30 10:13:57', '2022-08-30 12:13:57'),
('61d2292b1d3231880438c230f9293d3be3aba6778eda8cd7b4294c29e9d05d7aab2391ba1ca30139', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:11:58', '2021-08-27 02:11:58', '2022-08-27 04:11:58'),
('65acc2acfc3015557a7924b51b1c8b7a48a11fcf1e413cc304fe823dc07bad8ba1299844e081e118', 13, 3, 'authToken', '[]', 0, '2021-08-28 10:00:43', '2021-08-28 10:00:43', '2022-08-28 12:00:43'),
('6781d4b59c5153a3e0537d7585bfd14f70a40dbc040761e627444b9e69e0d01e968a543f978256eb', 13, 3, 'authToken', '[]', 0, '2021-08-26 19:12:14', '2021-08-26 19:12:14', '2022-08-26 21:12:14'),
('6806ebbc7962f8fa76d785c0667e13cb3022e00030bf16e3328ee35d220932a60aa7837795fcfe9e', 2, 3, 'authToken', '[]', 0, '2021-08-26 18:49:05', '2021-08-26 18:49:05', '2022-08-26 20:49:05'),
('6b039ce21cd179e7f3f8f23eb973198d0ad71fccc43a92b378cfa1e997b03d251d7f3550eac97737', 19, 3, 'authToken', '[]', 0, '2021-08-26 19:22:19', '2021-08-26 19:22:19', '2022-08-26 21:22:19'),
('6f5968257dd7c18928455967828b9d061c21e38464e4e149809a9cd73b80a1d38cdc031edcb2d465', 2, 3, 'authToken', '[]', 0, '2021-08-26 16:37:59', '2021-08-26 16:37:59', '2022-08-26 18:37:59'),
('6f691f9af4b6d1c6a75dc1dd1f67780c6e8d6a6466da3d309b161ec0e8c1fd03231339d2c1a76ba4', 16, 3, 'authToken', '[]', 0, '2021-08-30 10:15:34', '2021-08-30 10:15:34', '2022-08-30 12:15:34'),
('71e9dc75abac45fa8de2c329d8629b856a1ec8ca439705d6e4b19ff264e4d9fe0d8dd62d9422c7ab', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:16:58', '2021-08-27 02:16:58', '2022-08-27 04:16:58'),
('7f0f38b34a8700bed5488b7fc2eccea7cc9af3c35a96610816a73af64463b70ca8512492de19ef89', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:19:07', '2021-08-27 02:19:07', '2022-08-27 04:19:07'),
('7f27fde2a0bcd7798fb2e4e29257e2c843e4d2f0d09e86f4bbd8ebaf73ef80b645f140d034e31ec9', 5, 3, 'authToken', '[]', 0, '2021-08-27 02:22:14', '2021-08-27 02:22:14', '2022-08-27 04:22:14'),
('82613a231ec67b55f11290867695f3e849e8d240bece8fe768163b7ed4b0267eb38c87a62a6e4465', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:11:32', '2021-08-27 02:11:32', '2022-08-27 04:11:32'),
('84a5ab41116625befa7215a57d3756140cdc0272f9a8c4049643101dc5fd76274bc5c25a7b797009', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:20:43', '2021-08-27 02:20:43', '2022-08-27 04:20:43'),
('84ba533368c478da64f9a3b6e0a029a9348efbfbfc30bed08ed313679c7411ebcb970bffc816cf1f', 36, 3, 'authToken', '[]', 0, '2021-08-29 07:37:04', '2021-08-29 07:37:04', '2022-08-29 09:37:04'),
('84f6dda584eeada7a0e88561738772014721d72dd60de0d43c3d54fba1b508b4768ec1a549a79035', 1, 3, 'authToken', '[]', 0, '2021-08-29 08:55:50', '2021-08-29 08:55:50', '2022-08-29 10:55:50'),
('855f9281b3797c277790454cf7adac0d30c1cf0431ad77fd447f7dd600c357b14e951beff3179710', 5, 3, 'authToken', '[]', 0, '2021-08-28 13:40:03', '2021-08-28 13:40:03', '2022-08-28 15:40:03'),
('8dff41456b43c1f34582b0bdcfe498a13aaa188b422cd5153f5de2cc5af76a8030ae5c17ba66b8ff', 17, 3, 'authToken', '[]', 0, '2021-08-26 19:17:43', '2021-08-26 19:17:43', '2022-08-26 21:17:43'),
('90a3533f91fd4cef05cb91315c10836847896fc5136b1da9c0b40b3efd0627b8b2c659e4668a6a0e', 31, 3, 'authToken', '[]', 0, '2021-08-26 19:45:55', '2021-08-26 19:45:55', '2022-08-26 21:45:55'),
('91f11f229ec590a9c65804f50a281dca85f2efd0acf05db840b20a532144f04b3e44bd7edcd2e732', 5, 3, 'authToken', '[]', 0, '2021-08-29 07:44:45', '2021-08-29 07:44:45', '2022-08-29 09:44:45'),
('931396fc4bab6def38336d12daad0fdbd89706a5edb7e1671dec35fa568f727d9f9efbe2647371a8', 19, 3, 'authToken', '[]', 0, '2021-08-30 10:18:22', '2021-08-30 10:18:22', '2022-08-30 12:18:22'),
('95048e8500e25770c04afe8ea673c7303d21cc15f000ba6885949d34d26a67017d399e85ab4ad592', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:17:36', '2021-08-27 02:17:36', '2022-08-27 04:17:36'),
('972bf6600684e4368381715ec64966858adca0faedbbf0207637755c18574627cfae82298e82b2ea', 21, 3, 'authToken', '[]', 0, '2021-08-26 19:23:05', '2021-08-26 19:23:05', '2022-08-26 21:23:05'),
('9778ee7f90fa1f4c5e58ee39b7349da19b4a191f6e3990dc9f1ae857c9e1de2fd8ab46abbc19cdc7', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:20:18', '2021-08-27 02:20:18', '2022-08-27 04:20:18'),
('9a9d8b085429ad576fa4588c469e1146a47c8827d2813e6d2ea4ea0bc9e247c86d7c0eea219302b2', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:15:03', '2021-08-27 02:15:03', '2022-08-27 04:15:03'),
('a48cd967d76e0eb07c570b2c1b38b899e2af8de33addaa8b1ce92870b030708abcbe947dd845fa11', 1, 3, 'authToken', '[]', 0, '2021-08-29 09:11:25', '2021-08-29 09:11:25', '2022-08-29 11:11:25'),
('a8acc18d6c54fdbc779f810deefead58f3b95c37ee95a620ab496b8f6642bf5ab66f2bd465ede458', 35, 3, 'authToken', '[]', 0, '2021-09-06 01:36:36', '2021-09-06 01:36:36', '2022-09-06 03:36:36'),
('af20d0f9bc571fdf31c100aed6bd2119d8c835638615de73edece292d1050070330383053b50f5e8', 11, 3, 'authToken', '[]', 0, '2021-08-28 09:15:51', '2021-08-28 09:15:51', '2022-08-28 11:15:51'),
('b1ecf4800b16820e513b091211a7e656322dd5a1999b2d885235e265e6d41a5b1555c0d531ec4f31', 5, 3, 'authToken', '[]', 0, '2021-08-28 13:40:01', '2021-08-28 13:40:01', '2022-08-28 15:40:01'),
('b8d1fe80e84cf8a6a169f25687448491e64af39a2e58c1a3bcb5bd7925de373f1f86be33aa9efb10', 14, 3, 'authToken', '[]', 0, '2021-08-26 19:12:47', '2021-08-26 19:12:47', '2022-08-26 21:12:47'),
('c05b1f2d99cad84d2cba5fbd05ef747c29ff71b8cdf7784905b89161a9375468004a918ccdc34fc5', 29, 3, 'authToken', '[]', 0, '2021-08-26 19:30:47', '2021-08-26 19:30:47', '2022-08-26 21:30:47'),
('c11fcbd1d328a4e58ba8cd945109e624163d8c2789224dbe7841f3ea7a2e4290e29098d32f047f9b', 28, 3, 'authToken', '[]', 0, '2021-08-26 19:30:23', '2021-08-26 19:30:23', '2022-08-26 21:30:23'),
('d4be959152939a46a446fd34cf0447375a6e8991040c7e2bea41977bbf720075da681cbba0883034', 9, 3, 'authToken', '[]', 0, '2021-08-27 02:10:41', '2021-08-27 02:10:41', '2022-08-27 04:10:41'),
('da98885b6d6bea16a0e99306b5178ab688b8ffd0cf7cc69409705185569485bc31e1f20aa21a65ad', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:07:01', '2021-08-27 02:07:01', '2022-08-27 04:07:01'),
('decb81fc5a498e2be804cc3728bf7ed2cf18ccf33ce5f84f02ae722b3954f1fb03119600ebfef8a9', 5, 3, 'authToken', '[]', 0, '2021-08-28 13:38:04', '2021-08-28 13:38:04', '2022-08-28 15:38:04'),
('dff70bdda164e4218b1f9720bbedf86578c7271c85493be73a4506ea59d7812b1fd74b71aa18a97f', 1, 3, 'authToken', '[]', 0, '2021-08-29 09:13:03', '2021-08-29 09:13:03', '2022-08-29 11:13:03'),
('e49e92e17741080669318783d3389a8404027a87396c28e399d9539f3ff88ac52b7c3c7bca4f0ac9', 38, 3, 'authToken', '[]', 0, '2021-08-30 17:42:48', '2021-08-30 17:42:48', '2022-08-30 19:42:48'),
('e5fa10964b067a73b8b421bb2fb46cddd49606d117ea23a3bc2e5cb3b8240a1db6d3d7bff4d9ab9f', 18, 3, 'authToken', '[]', 0, '2021-08-30 10:17:42', '2021-08-30 10:17:42', '2022-08-30 12:17:42'),
('e7d60a7285020ab268e8ccd28b6a4515107d91ba7d0af458a31bddb2d14a45dd19c3b0b3e23a6d49', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:08:48', '2021-08-27 02:08:48', '2022-08-27 04:08:48'),
('e815b014745cf65bdce82c6f835abea95c9ce23cb430b60dc253691e6cbb4bcde87ea9268242064b', 2, 3, 'authToken', '[]', 0, '2021-08-26 11:17:15', '2021-08-26 11:17:15', '2022-08-26 13:17:15'),
('ebd4ff0483c7647e5e4b44fdbf01dfd92338d2fa2d43dc34f96b2a0960eec1f099fd06b56ce66a23', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:19:34', '2021-08-27 02:19:34', '2022-08-27 04:19:34'),
('ee061e13f110916b2a1f00ce40a9732e999cb2dd4f5619ad3f94b671e1f19ef24af4e9cab4acb0dc', 5, 3, 'authToken', '[]', 0, '2021-08-27 10:35:15', '2021-08-27 10:35:15', '2022-08-27 12:35:15'),
('f0ae4b3cfbfaae0b74108a987e74ad8bd3c8aac1f7a159bc70221bd3fc944f3e728874528eac0d47', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:05:03', '2021-08-27 02:05:03', '2022-08-27 04:05:03'),
('f1248948c155988a86b7b47370560563bf034c6a64afb41fdd4d1bca63a22f201fa03226b23bfbc4', 6, 3, 'authToken', '[]', 0, '2021-08-27 01:53:13', '2021-08-27 01:53:13', '2022-08-27 03:53:13'),
('f240d0b624a983c78d85b680346bc515e913773a0480176d7f93ef7f7aa38fa038de2f50e9f9aee6', 11, 3, 'authToken', '[]', 0, '2021-08-26 19:10:37', '2021-08-26 19:10:37', '2022-08-26 21:10:37'),
('f4386721d528f7b5c350ffece20c415cdebe1a8425b833393f35ddd56f6c2efaf9e8ba9f422265af', 33, 3, 'authToken', '[]', 0, '2021-08-28 09:54:01', '2021-08-28 09:54:01', '2022-08-28 11:54:01'),
('f5673ec597a31f868973c6a17d92c759e3a6379ab880713fb2d36c48d7f40c5242f2d2e61ab2384c', 38, 3, 'authToken', '[]', 0, '2021-08-30 17:43:24', '2021-08-30 17:43:24', '2022-08-30 19:43:24'),
('f5b588f0b1e66df77cb6a29cb51e5829b8e4b5cf7b454aef98823b8142b03d0a2d86ad18f52e0a63', 5, 3, 'authToken', '[]', 0, '2021-08-27 02:38:58', '2021-08-27 02:38:58', '2022-08-27 04:38:58'),
('f73d2bb8f154d75e028ecd56382605a9a8e9ec139e501b86da0bf7b921ded70fba66784d437f95bf', 8, 3, 'authToken', '[]', 0, '2021-08-27 01:56:33', '2021-08-27 01:56:33', '2022-08-27 03:56:33'),
('f7a0a453a36886a851b26a58006ee9ee72cf2d69d487346e8484d971fb9cc79259a132b5da4533dd', 5, 3, 'authToken', '[]', 0, '2021-09-05 19:19:44', '2021-09-05 19:19:44', '2022-09-05 21:19:44'),
('f8e540775d910ea1cab6d80c476386e0528e14a7a9939a310e2f1f77b380a7ac53c5ff3d6d66b37e', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:19:22', '2021-08-27 02:19:22', '2022-08-27 04:19:22'),
('fa603f05da4b9ba7cb94230ad87c59d8f87513daa54cd432efad82afc3e200dab97d7e819db59358', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:19:54', '2021-08-27 02:19:54', '2022-08-27 04:19:54'),
('fc84ef2b78d44969d2957f445127e63b3db1df3c8755ca7b3066979a11aaaaf182f265dfdc03c54c', 10, 3, 'authToken', '[]', 0, '2021-08-27 02:23:17', '2021-08-27 02:23:17', '2022-08-27 04:23:17'),
('fd4a9bbaac9cb7da55ba03ff87d01831796e1d308a6070b75d6b63dac29cc5ed427ca36b24a7b45d', 2, 3, 'authToken', '[]', 0, '2021-08-27 02:06:45', '2021-08-27 02:06:45', '2022-08-27 04:06:45');

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
(1, NULL, 'Sofra Personal Access Client', 'Qif6wth3Zqu2AvPTfl7aNht1hZPj82QQPI9BAa57', NULL, 'http://localhost', 1, 0, 0, '2021-08-23 17:00:37', '2021-08-23 17:00:37'),
(2, NULL, 'Sofra Password Grant Client', 'e2noTeeQGfWPecuIU1jXNcnWh1RmLeUZAfjmpWsQ', 'users', 'http://localhost', 0, 1, 0, '2021-08-23 17:00:37', '2021-08-23 17:00:37'),
(3, NULL, 'Sofra Personal Access Client', 'bPWLH1Cm3WBgVe72prp4e0R3yBW6jG6KLmit9fYH', NULL, 'http://localhost', 1, 0, 0, '2021-08-26 10:39:28', '2021-08-26 10:39:28'),
(4, NULL, 'Sofra Password Grant Client', '6l9grgu90X9cK7goshQNoMfB5qn4vIo4BSIMQSEw', 'users', 'http://localhost', 0, 1, 0, '2021-08-26 10:39:28', '2021-08-26 10:39:28');

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
(1, 1, '2021-08-23 17:00:37', '2021-08-23 17:00:37'),
(2, 3, '2021-08-26 10:39:28', '2021-08-26 10:39:28');

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
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `date_to` date NOT NULL,
  `date_from` date NOT NULL,
  `restaurant_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `created_at`, `updated_at`, `name`, `image`, `description`, `date_to`, `date_from`, `restaurant_id`) VALUES
(8, '2021-08-30 09:43:38', '2021-08-30 09:43:38', 'ha', 'images/restaurant/offers/16303238182d20fe148962fe5f8304f86ded7ca603.png', 'no', '2021-06-03', '2021-06-04', 5),
(9, '2021-08-30 09:43:38', '2021-08-30 09:43:38', 'offer three', 'images/restaurant/offers/16303238182d20fe148962fe5f8304f86ded7ca603.png', 'the description, yes man it\'s the description', '2021-06-03', '2021-06-03', 5),
(10, '2021-08-30 09:43:38', '2021-08-30 09:43:38', 'offer three', 'images/restaurant/offers/16303238182d20fe148962fe5f8304f86ded7ca603.png', 'the description, yes man it\'s the description', '2021-06-03', '2021-06-03', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `payment_method` enum('cash','online') NOT NULL,
  `state` enum('pending','accepted','rejected','client_delivered','declined','finished') NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `restaurant_id` int(10) UNSIGNED NOT NULL,
  `cost` decimal(8,2) DEFAULT NULL,
  `delivery_cost` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `commission` decimal(8,2) DEFAULT NULL,
  `net` decimal(8,2) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `updated_at`, `address`, `payment_method`, `state`, `client_id`, `restaurant_id`, `cost`, `delivery_cost`, `total`, `commission`, `net`, `notes`) VALUES
(52, '2021-08-27 19:26:15', '2021-08-28 19:26:15', 'adslkfjlak', 'cash', 'client_delivered', 35, 5, '2071.00', '64.00', '2135.00', '207.10', '1927.90', 'fasdfsd'),
(53, '2021-08-28 19:26:40', '2021-08-28 19:26:40', 'adslkfjlak', 'online', 'client_delivered', 35, 5, '2071.00', '314.40', '2385.40', '207.10', '2178.30', 'afdsa'),
(54, '2021-08-28 19:28:16', '2021-08-28 19:28:16', 'adslkfjlak', 'cash', 'rejected', 35, 5, '2071.00', '314.40', '2385.40', '207.10', '2178.30', 'adsfafd'),
(55, '2021-08-28 19:29:28', '2021-08-28 19:29:29', 'adslkfjlak', 'cash', 'declined', 35, 5, '2071.00', '314.40', '2385.40', '207.10', '2178.30', 'afdasd'),
(56, '2021-08-28 19:31:21', '2021-08-28 19:31:21', 'adslkfjlak', 'online', 'finished', 35, 5, '2071.00', '314.40', '2385.40', '207.10', '2178.30', 'fads'),
(57, '2021-08-28 19:31:22', '2021-08-28 19:31:22', 'adslkfjlak', 'cash', 'pending', 35, 5, '2071.00', '314.40', '2385.40', '207.10', '2178.30', 'afds'),
(58, '2021-08-28 19:31:24', '2021-08-28 19:31:24', 'adslkfjlak', 'cash', 'accepted', 35, 5, '2071.00', '314.40', '2385.40', '207.10', '2178.30', 'afsdasdf'),
(59, '2021-08-28 19:31:25', '2021-08-28 19:31:25', 'adslkfjlak', 'cash', 'accepted', 35, 5, '2071.00', '314.40', '2385.40', '207.10', '2178.30', 'adsfad'),
(63, '2021-08-28 19:39:22', '2021-08-30 16:37:18', 'adslkfjlak', 'cash', 'accepted', 5, 5, '2071.00', '314.40', '2385.40', '207.10', '2178.30', NULL),
(64, '2021-08-28 19:40:37', '2021-08-28 19:40:38', 'adslkfjlak', 'cash', 'rejected', 35, 5, '2071.00', '314.40', '2385.40', '207.10', '2178.30', 'null'),
(65, '2021-08-29 07:24:41', '2021-08-29 07:24:42', 'adslkfjlak', 'cash', 'pending', 35, 5, '2071.00', '314.40', '2385.40', '207.10', '2178.30', 'afds'),
(66, '2021-08-30 18:32:35', '2021-08-30 18:32:36', 'adslkfjlak', 'cash', 'pending', 38, 5, '2071.00', '314.40', '2385.40', '1035.50', '1349.90', 'adfsa'),
(67, '2021-08-30 18:33:22', '2021-08-30 18:33:22', 'adslkfjlak', 'cash', 'pending', 38, 5, '2071.00', '314.40', '2385.40', '1035.50', '1349.90', 'afsd'),
(68, '2021-08-30 18:33:50', '2021-08-30 18:33:51', 'adslkfjlak', 'cash', 'pending', 38, 5, '2071.00', '314.40', '2385.40', '1035.50', '1349.90', 'afds'),
(69, '2021-08-30 18:34:09', '2021-08-30 18:34:09', 'adslkfjlak', 'cash', 'pending', 38, 5, '2071.00', '314.40', '2385.40', '1035.50', '1349.90', 'fasd'),
(70, '2021-08-30 18:42:55', '2021-08-30 18:42:55', 'adslkfjlak', 'cash', 'client_delivered', 38, 5, '2071.00', '314.40', '2385.40', '1035.50', '1349.90', 'asfd'),
(71, '2021-08-30 18:42:57', '2021-09-06 01:58:00', 'adslkfjlak', 'cash', 'declined', 38, 5, '2071.00', '314.40', '2385.40', '1035.50', '1349.90', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `created_at`, `updated_at`, `product_id`, `quantity`, `price`, `notes`, `order_id`) VALUES
(24, NULL, NULL, 2, 2, '68.00', '', 42),
(25, NULL, NULL, 2, 2, '68.00', '', 43),
(26, NULL, NULL, 3, 45, '43.00', '', 43),
(27, NULL, NULL, 2, 2, '68.00', '', 44),
(28, NULL, NULL, 3, 45, '43.00', '', 44),
(29, NULL, NULL, 2, 2, '68.00', '', 45),
(30, NULL, NULL, 3, 45, '43.00', '', 45),
(31, NULL, NULL, 2, 2, '68.00', '', 46),
(32, NULL, NULL, 3, 45, '43.00', '', 46),
(33, NULL, NULL, 2, 2, '68.00', '', 47),
(34, NULL, NULL, 3, 45, '43.00', '', 47),
(35, NULL, NULL, 2, 2, '68.00', '', 48),
(36, NULL, NULL, 3, 45, '43.00', '', 48),
(37, NULL, NULL, 2, 2, '68.00', '', 49),
(38, NULL, NULL, 3, 45, '43.00', '', 49),
(39, NULL, NULL, 2, 2, '68.00', '', 50),
(40, NULL, NULL, 3, 45, '43.00', '', 50),
(41, NULL, NULL, 2, 2, '68.00', '', 51),
(42, NULL, NULL, 3, 45, '43.00', '', 51),
(43, NULL, NULL, 2, 2, '68.00', '', 52),
(44, NULL, NULL, 3, 45, '43.00', '', 52),
(45, NULL, NULL, 2, 2, '68.00', '', 53),
(46, NULL, NULL, 3, 45, '43.00', '', 53),
(47, NULL, NULL, 2, 2, '68.00', '', 54),
(48, NULL, NULL, 3, 45, '43.00', '', 54),
(49, NULL, NULL, 2, 2, '68.00', '', 55),
(50, NULL, NULL, 3, 45, '43.00', '', 55),
(51, NULL, NULL, 2, 2, '68.00', '', 56),
(52, NULL, NULL, 3, 45, '43.00', '', 56),
(53, NULL, NULL, 2, 2, '68.00', '', 57),
(54, NULL, NULL, 3, 45, '43.00', '', 57),
(55, NULL, NULL, 2, 2, '68.00', '', 58),
(56, NULL, NULL, 3, 45, '43.00', '', 58),
(57, NULL, NULL, 2, 2, '68.00', '', 59),
(58, NULL, NULL, 3, 45, '43.00', '', 59),
(59, NULL, NULL, 2, 2, '68.00', '', 60),
(60, NULL, NULL, 3, 45, '43.00', '', 60),
(61, NULL, NULL, 2, 2, '68.00', '', 61),
(62, NULL, NULL, 3, 45, '43.00', '', 61),
(63, NULL, NULL, 2, 2, '68.00', '', 62),
(64, NULL, NULL, 3, 45, '43.00', '', 62),
(65, NULL, NULL, 2, 2, '68.00', '', 63),
(66, NULL, NULL, 3, 45, '43.00', '', 63),
(67, NULL, NULL, 2, 2, '68.00', '', 64),
(68, NULL, NULL, 3, 45, '43.00', '', 64),
(69, NULL, NULL, 2, 2, '68.00', '', 65),
(70, NULL, NULL, 3, 45, '43.00', '', 65),
(71, NULL, NULL, 2, 2, '68.00', '', 66),
(72, NULL, NULL, 3, 45, '43.00', '', 66),
(73, NULL, NULL, 2, 2, '68.00', '', 67),
(74, NULL, NULL, 3, 45, '43.00', '', 67),
(75, NULL, NULL, 2, 2, '68.00', '', 68),
(76, NULL, NULL, 3, 45, '43.00', '', 68),
(77, NULL, NULL, 2, 2, '68.00', '', 69),
(78, NULL, NULL, 3, 45, '43.00', '', 69),
(79, NULL, NULL, 2, 2, '68.00', '', 70),
(80, NULL, NULL, 3, 45, '43.00', '', 70),
(81, NULL, NULL, 2, 2, '68.00', '', 71),
(82, NULL, NULL, 3, 45, '43.00', '', 71);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@admingmail.com', '$2y$10$0L9MygJ826yL.LofaeVV3ObvnWiTWeE6jh6nn.YDQdPC.w5IppHv6', '2021-09-02 07:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `restaurant_id` int(10) UNSIGNED NOT NULL,
  `paid` decimal(8,2) NOT NULL,
  `payment_date` date NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `created_at`, `updated_at`, `restaurant_id`, `paid`, `payment_date`, `notes`) VALUES
(1, '2021-08-29 10:00:03', '2021-09-05 02:11:03', 13, '654.00', '2021-08-29', '456464afda456464afda456464afda456464afda'),
(2, '2021-08-29 10:00:55', '2021-08-29 10:00:55', 6, '65.00', '2021-08-29', 'adsfasdfasddf'),
(3, '2021-08-29 10:01:29', '2021-08-29 10:01:29', 5, '564.40', '2021-08-29', 'fsadasfsf'),
(4, '2021-08-29 10:01:39', '2021-09-05 02:10:37', 5, '654.00', '2021-08-29', 'adfsadsfikjlkj;lk;lk;lk;lk;lj'),
(6, '2021-09-05 01:58:45', '2021-09-05 01:58:45', 12, '423421.00', '2006-02-09', 'Elit omnis laborumasfdasfasdfasdfafasfdfasfasfds'),
(7, '2021-09-05 01:59:45', '2021-09-05 01:59:45', 10, '5442.00', '2004-09-25', 'Eum temporibus ducim'),
(8, '2021-09-05 02:00:46', '2021-09-05 02:00:46', 5, '56454.00', '1993-04-03', 'Inventore totam exer'),
(9, '2021-09-05 02:02:10', '2021-09-05 02:02:10', 8, '654.00', '2021-09-16', 'Non laborum Exceptulkjhjklhkjgghji');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `routes` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `display_name`, `name`, `routes`, `guard_name`, `created_at`, `updated_at`, `group`) VALUES
(1, 'عرض الصلاحيات', 'role-index', 'role.index', 'web', '2021-08-17 07:47:04', NULL, 1),
(2, 'تعديل الصلاحيات', 'role-edit', 'role.update,role.edit', 'web', '2021-08-17 07:47:04', NULL, 1),
(3, 'إنشاء الصلاحيات', 'role-create', 'role.create', 'web', '2021-08-17 07:47:04', NULL, 1),
(4, 'حذف الصلاحيات', 'role-destroy', 'role.destroy', 'web', '2021-08-17 07:47:04', NULL, 1),
(5, 'إنشاء المستخدمين', 'user-create', 'user.store,user.create', 'web', '2021-08-17 07:47:04', NULL, 2),
(6, 'تعديل المستخدمين', 'user-edit', 'user.edit,user.update', 'web', '2021-08-17 07:47:04', NULL, 2),
(7, 'حذف المستخدمين', 'user-destroy', 'user.destroy', 'web', '2021-08-17 07:47:04', NULL, 2),
(8, 'عرض المستخدمين', 'user-index', 'user.index', 'web', '2021-08-17 07:47:04', NULL, 2),
(9, 'عرض العملاء', 'client-index', 'client.index, client.show', 'web', '2021-08-17 07:47:04', NULL, 3),
(10, 'حذف العملاء', 'client-destroy', 'client.destroy', 'web', '2021-08-17 07:47:04', NULL, 3),
(11, 'تفعيل العملاء', 'client-active', 'client.active', 'web', '2021-08-17 07:47:04', NULL, 3),
(12, 'عرض المطاعم', 'restaurant-index', 'restaurant.index,restaurant.show', 'web', '2021-08-17 07:47:04', NULL, 4),
(13, 'حذف المطاعم', 'restaurant-destroy', 'restaurant.destroy', 'web', '2021-08-17 07:47:04', NULL, 4),
(14, 'تفعيل المطاعم', 'restaurant-active', 'restaurant.active', 'web', '2021-08-17 07:47:04', NULL, 4),
(15, 'حذف الطلبات', 'order-destroy', 'order.destroy', 'web', '2021-08-17 07:47:04', NULL, 5),
(16, 'عرض الطلبات', 'order-index', 'order.index', 'web', '2021-08-17 07:47:04', NULL, 5),
(17, 'إنشاء دفعات', 'payment-create', 'payment.create,payment.store', 'web', '2021-08-17 07:47:04', NULL, 6),
(18, ' تعديل دفعات', 'payment-edit', 'payment.update,payment.edit', 'web', '2021-08-17 07:47:04', NULL, 6),
(19, 'عرض دفعات', 'payment-index', 'payment.index', 'web', '2021-08-17 07:47:04', NULL, 6),
(20, 'حذف دفعات', 'payment-destroy', 'payment.destroy', 'web', '2021-08-17 07:47:04', NULL, 6),
(21, 'عرض الرسائل المستلمه', 'contact-index', 'contact.index', 'web', '2021-08-17 07:47:04', NULL, 7),
(22, 'حذف الرسائل المستلمه', 'contact-destroy', 'contact.destroy', 'web', '2021-08-17 07:47:04', NULL, 7),
(23, 'إنشاء مناطق', 'district-create', 'district.create,district.store', 'web', '2021-08-17 07:47:04', NULL, 9),
(24, ' تعديل مناطق', 'district-edit', 'district.update,district.edit', 'web', '2021-08-17 07:47:04', NULL, 9),
(25, 'عرض مناطق', 'district-index', 'district.index', 'web', '2021-08-17 07:47:04', NULL, 9),
(26, 'حذف مناطق', 'district-destroy', 'district.destroy', 'web', '2021-08-17 07:47:04', NULL, 9),
(27, 'إنشاء الأقسام', 'category-create', 'category.create,category.store', 'web', '2021-08-17 07:47:04', NULL, 10),
(28, ' تعديل الأقسام', 'category-edit', 'category.update,category.edit', 'web', '2021-08-17 07:47:04', NULL, 10),
(29, 'عرض الأقسام', 'category-index', 'category.index', 'web', '2021-08-17 07:47:04', NULL, 10),
(30, 'إنشاء المدن', 'city-create', 'city.create,city.store', 'web', '2021-08-17 07:47:04', NULL, 8),
(31, ' تعديل المدن', 'city-edit', 'city.update,city.edit', 'web', '2021-08-17 07:47:04', NULL, 8),
(32, 'عرض المدن', 'city-index', 'city.index', 'web', '2021-08-17 07:47:04', NULL, 8),
(33, 'حذف المدن', 'city-destroy', 'city.destroy', 'web', '2021-08-17 07:47:04', NULL, 8),
(34, 'حذف الأقسام', 'category-destroy', 'category.destroy', 'web', '2021-08-17 07:47:04', NULL, 10),
(38, 'حذف العروض', 'offer-destroy', 'offer.destroy', 'web', '2021-08-17 07:47:04', NULL, 11),
(39, 'عرض العروض', 'offer-index', 'offer.index', 'web', '2021-08-17 07:47:04', NULL, 11),
(40, 'الاعدادت العامه', 'setting-index', 'setting.index', 'web', '2021-07-13 21:09:26', '2021-07-25 07:53:29', 12);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'authToken', '5bd1b9b32e11c569af58bc2bdf69c29ac285b0df996877abd5a12fab8268400a', '[\"*\"]', NULL, '2021-08-29 08:55:00', '2021-08-29 08:55:00'),
(2, 'App\\Models\\User', 1, 'authToken', '08e25076a20a92811e23b4f5e3570dc1f1a0ad94e43a1fa72e6576692803db1e', '[\"*\"]', NULL, '2021-08-29 08:55:26', '2021-08-29 08:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price_offer` decimal(8,2) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `request_time` time NOT NULL,
  `restaurant_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image`, `price_offer`, `active`, `request_time`, `restaurant_id`) VALUES
(2, '2021-08-27 11:06:59', '2021-08-27 11:06:59', 'المنتح الثاني', 'lfajlfjlajflkajflkajlskfjdas', '68.00', '', '75.00', 0, '13:06:59', 5),
(3, '2021-08-27 11:07:28', '2021-08-30 09:27:59', 'hiafdsdsf', 'lfajlfjlajflkajflkajlskfjdas', '43.00', '', '75.00', 0, '13:07:28', 5),
(5, '2021-08-30 09:18:27', '2021-08-30 09:28:16', 'hiafdsdsf', 'lfajlfjlajflkajflkajlskfjdas', '43.54', '', '75.00', 0, '04:04:55', 5),
(10, NULL, NULL, 'fad', 'adfs', '0.00', 'fda', '5.00', 0, '00:00:00', 5),
(11, NULL, NULL, 'fad', 'adfs', '0.00', 'fda', '5.00', 0, '00:00:00', 5),
(12, NULL, '2021-09-06 02:36:17', 'fad', 'adfs', '0.00', 'fda', '5.00', 0, '00:00:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 0,
  `minimum` decimal(8,2) NOT NULL,
  `image_restaurant` varchar(255) DEFAULT NULL,
  `whats_app` varchar(255) NOT NULL,
  `phone_restaurant` varchar(255) NOT NULL,
  `delivery_fee` decimal(8,2) NOT NULL,
  `district_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `pin_code` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `created_at`, `updated_at`, `name`, `email`, `phone`, `state`, `minimum`, `image_restaurant`, `whats_app`, `phone_restaurant`, `delivery_fee`, `district_id`, `image`, `password`, `pin_code`, `active`) VALUES
(4, '2021-08-27 01:44:33', '2021-09-07 13:48:08', 'Mostafa132', 'mostafa@gmai.fd', '01011123644', 0, '41.10', 'images/restaurant/app/restaurant/163032659506cb97807e1d2637cb8044df8b7e07ac.jpg', '53436736746', '53436736745', '314.40', 1, 'images/restaurant/app/restaurant/163032659506cb97807e1d2637cb8044df8b7e07ac.jpg', '$2y$10$sMkKybbtuVP4Rdv6c7c5aOi.2ZvTE.iSnmI4czt16EvAtLmusbQfi', NULL, 0),
(5, '2021-08-27 01:50:33', '2021-09-05 03:34:50', 'restaurant name', 'test1712002@gmail.com', '01011123s644', 1, '41.10', '', '534673674665', '534367367414', '314.40', 2, 'images/restaurant/app/restaurant/163032659506cb97807e1d2637cb8044df8b7e07ac.jpg', '$2y$10$FgSjTsxCoRrniOtL9CF0BeKauCNWF3nHG4ec2mceuCgyPsxbBzMZu', NULL, 0),
(6, '2021-08-27 01:53:13', '2021-09-04 03:29:33', 'Mostaf2a13', 'mos4tafa@gmai.fds', '010111231s644', 0, '41.10', '', '53673674665', '53367367414', '314.40', 1, 'images/restaurant/app/restaurant/163032659506cb97807e1d2637cb8044df8b7e07ac.jpg', '$2y$10$7plJnQ1.tM3pHQkixdnmNONuQ8JnQxMtqGRxXRT6j2Yvz7Rd6Sd1K', NULL, 1),
(7, '2021-08-27 01:54:52', '2021-09-04 05:27:07', 'Mostaf2a135', 'mos4tafa@gmai.fd', '010111231s6', 0, '41.10', '', '536736766554', '533673674142', '314.40', 1, 'images/restaurant/app/restaurant/163032659506cb97807e1d2637cb8044df8b7e07ac.jpg', '$2y$10$w1b4dyo4BaNW4Dof1QEQ2.Y1vr5NPHuhiu8kKnmCr5fdzCI7V6IUC', NULL, 0),
(8, '2021-08-27 01:56:32', '2021-09-04 05:27:24', 'Mostaf2a137', 'mo4tafa@gmai.fd', '010111231s60', 0, '41.10', '', '5367367665542', '5336473674142', '314.40', 2, '', '$2y$10$1XR543XZoEVqLO3OHlJatuJeYh/pnAUuI923XHp9pMwkRPnVHC25e', NULL, 0),
(9, '2021-08-27 02:10:41', '2021-09-04 05:27:22', 'Ebrahim', 'm4tafa@gmai.fd', '0104111231s60', 0, '41.10', '', '536367665542', '536473674142', '314.40', 1, '', '$2y$10$nKwC1Ltv42YVdSvEJ5JuauomWSsDEcxOqbkFNvcdcLjVFTQQoCAdu', NULL, 0),
(10, '2021-08-27 02:23:17', '2021-09-04 05:27:19', 'Ebrahim4', 'm4tafa@gmai.fd4', '0104111231s604', 0, '41.10', '', '5363676655426', '5364736741424', '314.40', 1, '', '$2y$10$m.fxbnPRs4v8fTouR5SYjuz1O.jA9ZPIKyvxQjtzO3MTrZjye1aWG', NULL, 0),
(12, '2021-08-28 09:19:11', '2021-08-28 09:42:07', 'Ebrahiddmaf', 'm4tfa@gmai.fd4dd', '010dd11231s60a', 1, '41.10', '', '53ddd76655426', '53dd36741424', '314.40', 1, '', '$2y$10$huz3ZBDw4EvvbsW9TLyS.erqKvFTnFCioFXMB4TjeaCI5QxxpvfSS', NULL, 0),
(13, '2021-08-28 10:00:43', '2021-09-04 05:26:27', 'Ebrahiddmaf1', 'm4tfa@gmai.fd4dd1', '010dd11231s60', 0, '41.10', '', '53ddd766554261', '53d36741424', '314.40', 1, '', '$2y$10$noKpV.q3A0rThJy3R1DveOpUjoIsgVFCq886LpftkuDcFKTOEeaNW', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(3, 'admin', 'web', 'الرئيس', 'المتحكم بكل شئ و أي شئ', '2021-09-07 07:19:15', '2021-09-07 07:19:15'),
(4, 'Editor', 'web', 'المحرر', 'المسئول عن تعديل كل شئ', '2021-09-07 07:20:11', '2021-09-07 07:41:15');

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
(1, 3),
(2, 3),
(2, 4),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(6, 4),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(18, 4),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(24, 4),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(28, 4),
(29, 3),
(30, 3),
(31, 3),
(31, 4),
(32, 3),
(33, 3),
(34, 3),
(38, 3),
(39, 3),
(40, 3);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `about_us` text NOT NULL,
  `commission` decimal(8,2) NOT NULL,
  `num_bank_alahli` varchar(100) NOT NULL,
  `num_bank_alrakhi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `about_us`, `commission`, `num_bank_alahli`, `num_bank_alrakhi`) VALUES
(1, '2021-08-03 22:00:00', '2021-09-04 10:53:32', 'we are the best of the best', '0.50', '434564654', '2313213213583');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `platform` enum('android','ios') NOT NULL,
  `tokable_id` int(10) UNSIGNED NOT NULL,
  `tokable_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `created_at`, `updated_at`, `token`, `platform`, `tokable_id`, `tokable_type`) VALUES
(43, '2021-08-30 19:21:58', '2021-08-30 19:21:58', 'fadskhakflkjafjasaf', 'ios', 5, 'App\\Models\\Restaurant'),
(44, '2021-08-30 19:21:58', '2021-08-30 19:21:58', 'asldfjklasdkjflajfl;askjfl;kdsj', 'ios', 5, 'App\\Models\\Restaurant'),
(45, '2021-08-30 19:21:58', '2021-08-30 19:21:58', 'alfj;alfjdlksasdf', 'ios', 5, 'App\\Models\\Restaurant'),
(50, '2021-09-06 01:51:11', '2021-09-06 01:51:11', 'adlskjfl;asjf;lasjfljadsl;kfj;', 'android', 38, 'App\\Models\\Client'),
(51, '2021-09-06 01:51:11', '2021-09-06 01:51:11', 'alkjfl;kaJFL;ASJF;LKASJFL;KAJ;SLKFJLASJFL;KAS', 'android', 38, 'App\\Models\\Client');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'admin', 'admin@admingmail.com', NULL, '$2y$10$tQwhkSZLosbL8MQURbVaq.nZ5wEysjCZWkiOzYu4/LgRX3Oon9Nym', 'WTssidkMcbZ8Qr5bD6BHlxv4wmtZCl1xOrhSGsw0Wryu6b8tDGhxeX5vs6UH', '2021-07-09 20:49:02', '2021-09-07 10:47:01', 1),
(6, 'Aimee Ferrell', 'ruwyl@mailinator.com', NULL, '$2y$10$lsfHC138yBa.FjgzqjedkeyJId/8JkZHr3gsQjGlQk4vfSIt26yae', NULL, '2021-09-07 09:24:05', '2021-09-07 09:35:40', 0),
(7, 'Nayda Meadows', 'pawyz@mailinator.com', NULL, '$2y$10$yGhJrmgaz3L1VxYZn/PfYe.uwBenwdpNJAtq94WxMR8YbnNZs2ihm', NULL, '2021-09-07 09:29:57', '2021-09-07 09:29:57', 0),
(8, 'Alexis Gill', 'dikysomu@mailinator.com', NULL, '$2y$10$1hLMtl.Pf7z.ho/xA4BGv.siBitibvm.7S3LzcNZ5VWMR13jJ/ys2', NULL, '2021-09-07 09:34:44', '2021-09-07 09:34:44', 0),
(9, 'Mostafa Ebrahim', 'mostafaibrahim1712002@gmail.com', NULL, '$2y$10$JedzMNzZHj3POjdyDj2o6e32kG6d6sCYHV6Tq5yqix1dDImoZSOMG', NULL, '2021-09-07 09:38:54', '2021-09-07 09:38:54', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_restaurant`
--
ALTER TABLE `category_restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_section_id_foreign` (`city_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
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
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_ibfk_1` (`restaurant_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `restaurants_name_unique` (`name`),
  ADD UNIQUE KEY `restaurants_whats_app_unique` (`whats_app`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `restaurants_phone_restaurant_index` (`phone_restaurant`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category_restaurant`
--
ALTER TABLE `category_restaurant`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `district_section_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON UPDATE CASCADE;

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
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
