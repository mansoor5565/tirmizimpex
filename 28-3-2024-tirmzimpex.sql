-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2024 at 05:48 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tirmizimpex`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_per_unit` int NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accessories_inventory`
--

CREATE TABLE `accessories_inventory` (
  `id` bigint UNSIGNED NOT NULL,
  `accessories_id` bigint UNSIGNED NOT NULL,
  `quantity_on_hand` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leather`
--

CREATE TABLE `leather` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leather`
--

INSERT INTO `leather` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Cow Wool', '2024-03-21 07:43:37', '2024-03-21 07:43:37'),
(2, 'China Wool', '2024-03-25 00:08:09', '2024-03-25 00:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `leather_colors`
--

CREATE TABLE `leather_colors` (
  `id` bigint UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leather_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leather_colors`
--

INSERT INTO `leather_colors` (`id`, `color`, `leather_id`, `created_at`, `updated_at`) VALUES
(1, 'White', 1, '2024-03-21 07:43:37', '2024-03-21 07:43:37'),
(2, 'Brown', 1, '2024-03-21 07:43:37', '2024-03-21 07:43:37'),
(3, 'Antique Brown', 1, '2024-03-21 07:43:37', '2024-03-21 07:43:37'),
(4, 'Brown', 2, '2024-03-25 00:08:09', '2024-03-25 00:08:09'),
(5, 'Antique Brown', 2, '2024-03-25 00:08:09', '2024-03-25 00:08:09'),
(6, 'Off-White', 2, '2024-03-25 00:08:09', '2024-03-25 00:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `leather_inventory`
--

CREATE TABLE `leather_inventory` (
  `id` bigint UNSIGNED NOT NULL,
  `lot_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leathercolor_id` bigint UNSIGNED NOT NULL,
  `quantity_on_hand` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leather_transaction`
--

CREATE TABLE `leather_transaction` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_leather_id` bigint UNSIGNED NOT NULL,
  `transaction_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_type` enum('purchase','payment','return') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leather_vendor`
--

CREATE TABLE `leather_vendor` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leather_vendor`
--

INSERT INTO `leather_vendor` (`id`, `name`, `address`, `contact_number`, `created_at`, `updated_at`) VALUES
(1, 'Lyle Love', 'Eu atque aliquam dic', '445', '2024-03-21 07:43:58', '2024-03-21 07:43:58'),
(2, 'Mansoor', 'Eu atque aliquam dic', '445', '2024-03-25 00:08:41', '2024-03-25 00:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `order` int NOT NULL,
  `route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `icon_class`, `parent_id`, `order`, `route`, `created_at`, `updated_at`) VALUES
(1, 'Accessories', 'bi bi-box', NULL, 5, 'accessories.index', '2024-03-15 02:23:17', '2024-03-15 03:47:39'),
(2, 'Leather', 'bi bi-box', NULL, 2, 'leather.index', '2024-03-15 02:33:46', '2024-03-15 03:35:27'),
(3, 'Venues', 'bi bi-box', NULL, 3, 'venue.index', '2024-03-15 02:35:07', '2024-03-25 05:24:17'),
(4, 'Products', 'bi bi-box', NULL, 1, 'product.index', '2024-03-15 03:38:16', '2024-03-24 12:56:47'),
(6, 'Purchase Management', 'bi bi-box', NULL, 3, 'purchase', '2024-03-15 03:45:13', '2024-03-15 03:59:48'),
(8, 'Purchase Accessories', 'bi bi-box', 6, 1, 'purchase_accessories.index', '2024-03-15 03:52:37', '2024-03-19 18:35:26'),
(9, 'Inventory Management', 'bi bi-box', NULL, 6, 'inventory', '2024-03-15 03:54:39', '2024-03-15 03:54:39'),
(10, 'Accessories Inventory', 'bi bi-box', 9, 2, 'accessories_inventory.index', '2024-03-15 04:00:45', '2024-03-15 04:00:45'),
(11, 'Leather Inventory', 'bi bi-box', 20, 1, 'leather_inventory.index', '2024-03-15 04:01:27', '2024-03-25 00:03:02'),
(20, 'Leather Management', 'bi bi-box', NULL, 4, 'leather', '2024-03-20 10:50:44', '2024-03-20 10:50:44'),
(21, 'Leather Vendors', 'bi bi-box', 20, 1, 'leather_vendor.index', '2024-03-20 10:51:12', '2024-03-28 08:22:44'),
(22, 'Purchase Leather', 'bi bi-box', 20, 2, 'purchase_leather.index', '2024-03-20 10:51:42', '2024-03-20 10:51:42'),
(23, 'Leather Transaction', 'bi bi-box', 20, 3, 'leather_transaction.index', '2024-03-20 10:52:16', '2024-03-20 10:52:16'),
(26, 'Vendor Bills', 'bi bi-box', 20, 6, 'leather_vendor_bill.index', '2024-03-29 04:53:07', '2024-03-29 04:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_03_03_073221_create_permission_tables', 1),
(7, '2024_03_03_100024_create_accessories_table', 1),
(8, '2024_03_04_082853_create_product_table', 1),
(9, '2024_03_04_090126_create_productimage_table', 1),
(10, '2024_03_04_091010_create_productaccessories_table', 1),
(11, '2024_03_04_091513_create_productsize_table', 1),
(12, '2024_03_04_105404_create_leather_table', 1),
(13, '2024_03_07_130637_create_venue_table', 1),
(14, '2024_03_09_155459_create_leather_colors_table', 1),
(15, '2024_03_10_095904_create_product_colors_table', 1),
(16, '2024_03_10_100000_create_leather_vendor_table', 1),
(17, '2024_03_10_114845_create_purchase_leather_table', 1),
(18, '2024_03_12_085951_create_purchase_accessories_table', 1),
(19, '2024_03_12_100553_create_accessories_inventory_table', 1),
(20, '2024_03_13_095209_create_leather_inventory_table', 1),
(21, '2024_03_14_184947_create_menus_table', 1),
(23, '2024_03_18_214043_add_profile_image_to_users_table', 1),
(24, '2024_03_19_095452_create_purchase_leather_color_table', 1),
(25, '2024_03_20_193648_create_vendor_bill_table', 1),
(27, '2024_03_18_100542_create_leather_transaction_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 1),
(7, 'App\\Models\\User', 1),
(9, 'App\\Models\\User', 1),
(10, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 1),
(12, 'App\\Models\\User', 1),
(13, 'App\\Models\\User', 1),
(14, 'App\\Models\\User', 1),
(15, 'App\\Models\\User', 1),
(16, 'App\\Models\\User', 1),
(17, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 4),
(7, 'App\\Models\\User', 4),
(9, 'App\\Models\\User', 4),
(10, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'users.list', 'web', '2024-03-21 07:14:37', '2024-03-21 07:14:37'),
(2, 'users.view', 'web', '2024-03-21 07:14:37', '2024-03-21 07:14:37'),
(3, 'users.create', 'web', '2024-03-21 07:14:37', '2024-03-21 07:14:37'),
(4, 'users.edit', 'web', '2024-03-21 07:14:37', '2024-03-21 07:14:37'),
(5, 'users.delete', 'web', '2024-03-21 07:14:37', '2024-03-21 07:14:37'),
(6, 'permissions.list', 'web', '2024-03-24 11:11:41', '2024-03-24 11:32:44'),
(7, 'permissions.create', 'web', '2024-03-24 11:11:59', '2024-03-24 11:36:12'),
(9, 'permissions.update', 'web', '2024-03-24 11:35:50', '2024-03-24 11:36:18'),
(10, 'permissions.delete', 'web', '2024-03-24 11:36:04', '2024-03-24 11:36:04'),
(11, 'products.list', 'web', '2024-03-24 12:29:36', '2024-03-24 12:29:36'),
(12, 'menu.list', 'web', '2024-03-25 05:18:33', '2024-03-25 05:18:33'),
(13, 'venues.list', 'web', '2024-03-25 05:23:16', '2024-03-25 05:23:16'),
(14, 'venues.view', 'web', '2024-03-25 05:26:36', '2024-03-25 05:26:36'),
(15, 'venues.create', 'web', '2024-03-25 05:26:45', '2024-03-25 05:26:45'),
(16, 'venues.edit', 'web', '2024-03-25 05:26:54', '2024-03-25 05:26:54'),
(17, 'venues.delete', 'web', '2024-03-25 05:27:04', '2024-03-25 05:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cutting_cost` int NOT NULL,
  `stitching_cost` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `model_no`, `notes`, `image`, `cutting_cost`, `stitching_cost`, `created_at`, `updated_at`) VALUES
(1, 'Iris Slater', 'ABC-123', 'Quo aliquam atque se', '1710967066_portfolio4.png', 6, 7, '2024-03-21 08:37:46', '2024-03-21 08:37:46'),
(2, 'Ebony Carson', 'ABC-126', 'Blanditiis et quia t', '1710967120_portdolio5.png', 64, 17, '2024-03-21 08:38:40', '2024-03-21 08:38:40'),
(3, 'Aileen Mann', 'ABC-121', 'Facilis incidunt an', '1710967317_portfolio4.png', 84, 6, '2024-03-21 08:41:57', '2024-03-21 08:41:57'),
(4, 'Dorian Fitzgerald', 'ABC-102', 'Ratione odit quasi l', '1710967573_portfolio3.png', 13, 73, '2024-03-21 08:46:13', '2024-03-21 08:46:13'),
(5, 'Janna Cherry', 'ABC-129', 'Sequi error reprehen', '1710967650_hero-3.png', 85, 49, '2024-03-21 08:47:30', '2024-03-21 08:47:30'),
(6, 'Lacota Fuentes', 'ABC-127', 'In sint repudiandae', '1710967723_blog-1.png', 73, 26, '2024-03-21 08:48:43', '2024-03-21 08:48:43'),
(7, 'Kieran Jenkins', 'ABC-103', 'Quis ab fugit conse', '1710967810_portfolio-1.png', 99, 24, '2024-03-21 08:50:10', '2024-03-21 08:50:10'),
(8, 'Cara Wall', 'ABC-123', 'Adipisci deserunt Na', '1710967935_portfolio4.png', 100, 37, '2024-03-21 08:52:15', '2024-03-21 08:52:15'),
(10, 'Carly Craft', 'ABC-111', 'Excepturi in et reru', '1710968201_portfolio3.png', 36, 95, '2024-03-21 08:56:41', '2024-03-21 08:56:41'),
(11, 'Steel Flores', 'ABC-100', 'Similique iure repud', '1710968251_portdolio5.png', 10, 88, '2024-03-21 08:57:31', '2024-03-21 08:57:31'),
(12, 'Sylvia Strong', 'ABC-133', 'Sequi amet in maxim', '1710968302_carousel-item-2.jpg', 100, 23, '2024-03-21 08:58:22', '2024-03-21 08:58:22'),
(13, 'Hanna Hendrix', 'ABC-999', 'Rerum eos in exerci', '1711118275_portfolio4.png', 81, 18, '2024-03-23 02:37:55', '2024-03-23 02:37:55'),
(14, 'Maxine Forbes', 'ABC-114', 'Natus deserunt numqu', '1711125421_1711125404_1711120042_portfolio4.png', 62, 56, '2024-03-23 03:07:22', '2024-03-23 04:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `productaccessories`
--

CREATE TABLE `productaccessories` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `accessories_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productimage`
--

CREATE TABLE `productimage` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productimage`
--

INSERT INTO `productimage` (`id`, `product_id`, `product_image`, `created_at`, `updated_at`) VALUES
(1, 12, '1710968302_1carousel-item-1.png', '2024-03-21 08:58:22', '2024-03-21 08:58:22'),
(2, 13, '1711118275_1portfolio3.png', '2024-03-23 02:37:55', '2024-03-23 02:37:55'),
(3, 13, '1711118275_1portfolio2.png', '2024-03-23 02:37:55', '2024-03-23 02:37:55'),
(4, 13, '1711118275_1portfolio-1.png', '2024-03-23 02:37:55', '2024-03-23 02:37:55'),
(13, 14, '1711125421_1711125404_1711120042_portfolio4.png', '2024-03-23 04:37:01', '2024-03-23 04:37:01'),
(14, 14, '1711125421_11711125404_11711120042_1portfolio3.png', '2024-03-23 04:37:01', '2024-03-23 04:37:01'),
(15, 14, '1711125421_11711125404_11711120042_1portfolio2.png', '2024-03-23 04:37:01', '2024-03-23 04:37:01'),
(16, 14, '1711125421_11711125404_11711120042_1portfolio-1.png', '2024-03-23 04:37:01', '2024-03-23 04:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `productsize`
--

CREATE TABLE `productsize` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productsize`
--

INSERT INTO `productsize` (`id`, `product_id`, `size`, `created_at`, `updated_at`) VALUES
(1, 13, 'Custom', '2024-03-23 02:37:55', '2024-03-23 02:37:55'),
(16, 14, 'XS', '2024-03-23 04:37:01', '2024-03-23 04:37:01'),
(17, 14, 'S', '2024-03-23 04:37:01', '2024-03-23 04:37:01'),
(18, 14, 'M', '2024-03-23 04:37:01', '2024-03-23 04:37:01'),
(19, 14, 'L', '2024-03-23 04:37:01', '2024-03-23 04:37:01'),
(20, 14, 'XL', '2024-03-23 04:37:01', '2024-03-23 04:37:01'),
(21, 14, '2XL', '2024-03-23 04:37:01', '2024-03-23 04:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `productcolor_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_accessories`
--

CREATE TABLE `purchase_accessories` (
  `id` bigint UNSIGNED NOT NULL,
  `accessories_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `cost_per_unit` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_leather`
--

CREATE TABLE `purchase_leather` (
  `id` bigint UNSIGNED NOT NULL,
  `leather_vendor_id` bigint UNSIGNED NOT NULL,
  `total_cost` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_leather_color`
--

CREATE TABLE `purchase_leather_color` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_leather_id` bigint UNSIGNED NOT NULL,
  `leather_color_id` bigint UNSIGNED NOT NULL,
  `cost_per_unit` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-03-21 07:14:37', '2024-03-21 07:14:37'),
(2, 'intern', 'web', '2024-03-21 07:14:37', '2024-03-21 07:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `profile_image`) VALUES
(1, 'mansoor', 'mansoor@gmail.com', NULL, '$2y$12$VwfHVM09v/BFVlcHmyWYMex5VD20i8l.2xpOlvC4wqETs1LBlokja', NULL, '2024-03-21 07:14:37', '2024-03-21 07:14:37', NULL),
(2, 'haris', 'haris@gmail.com', NULL, '$2y$12$T3qxE2j6JI92a5KJbKVW1.IaEZQ9Gk1tLRvzBptNnmLqk1OiJwORi', NULL, '2024-03-21 07:14:37', '2024-03-21 07:14:37', NULL),
(3, 'ashad', 'ashad@gmail.com', NULL, '$2y$12$uz1me8YrQbb13b2uq6Itie7UG14icKfT7Ga8.O36dNPoH4zTK.Dd6', NULL, '2024-03-24 12:34:03', '2024-03-24 12:52:39', NULL),
(4, 'Dahlia Fulton', 'melip@mailinator.com', NULL, '$2y$12$fx4ZleSxkQKnyxsUPS.YVuryXZN.mSKSrsPufHSSgTeJVV34Qa0I.', NULL, '2024-03-24 12:34:49', '2024-03-24 12:34:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_bill`
--

CREATE TABLE `vendor_bill` (
  `id` bigint UNSIGNED NOT NULL,
  `leather_purchase_id` bigint UNSIGNED NOT NULL,
  `leather_vendor_id` bigint UNSIGNED NOT NULL,
  `remaining_balance` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'A1', '2024-03-25 05:22:21', '2024-03-25 05:22:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accessories_name_unique` (`name`);

--
-- Indexes for table `accessories_inventory`
--
ALTER TABLE `accessories_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accessories_inventory_accessories_id_foreign` (`accessories_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `leather`
--
ALTER TABLE `leather`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `leather_type_unique` (`type`);

--
-- Indexes for table `leather_colors`
--
ALTER TABLE `leather_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leather_colors_leather_id_foreign` (`leather_id`);

--
-- Indexes for table `leather_inventory`
--
ALTER TABLE `leather_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leather_inventory_leathercolor_id_foreign` (`leathercolor_id`);

--
-- Indexes for table `leather_transaction`
--
ALTER TABLE `leather_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leather_transaction_purchase_leather_id_foreign` (`purchase_leather_id`);

--
-- Indexes for table `leather_vendor`
--
ALTER TABLE `leather_vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_name_unique` (`name`);

--
-- Indexes for table `productaccessories`
--
ALTER TABLE `productaccessories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productaccessories_product_id_foreign` (`product_id`),
  ADD KEY `productaccessories_accessories_id_foreign` (`accessories_id`);

--
-- Indexes for table `productimage`
--
ALTER TABLE `productimage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productimage_product_id_foreign` (`product_id`);

--
-- Indexes for table `productsize`
--
ALTER TABLE `productsize`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productsize_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_colors_product_id_foreign` (`product_id`),
  ADD KEY `product_colors_productcolor_id_foreign` (`productcolor_id`);

--
-- Indexes for table `purchase_accessories`
--
ALTER TABLE `purchase_accessories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_accessories_accessories_id_foreign` (`accessories_id`);

--
-- Indexes for table `purchase_leather`
--
ALTER TABLE `purchase_leather`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_leather_leather_vendor_id_foreign` (`leather_vendor_id`);

--
-- Indexes for table `purchase_leather_color`
--
ALTER TABLE `purchase_leather_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_leather_color_purchase_leather_id_foreign` (`purchase_leather_id`),
  ADD KEY `purchase_leather_color_leather_color_id_foreign` (`leather_color_id`);

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
-- Indexes for table `vendor_bill`
--
ALTER TABLE `vendor_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_bill_leather_purchase_id_foreign` (`leather_purchase_id`),
  ADD KEY `vendor_bill_leather_vendor_id_foreign` (`leather_vendor_id`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accessories_inventory`
--
ALTER TABLE `accessories_inventory`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leather`
--
ALTER TABLE `leather`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leather_colors`
--
ALTER TABLE `leather_colors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leather_inventory`
--
ALTER TABLE `leather_inventory`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leather_transaction`
--
ALTER TABLE `leather_transaction`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leather_vendor`
--
ALTER TABLE `leather_vendor`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `productaccessories`
--
ALTER TABLE `productaccessories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productimage`
--
ALTER TABLE `productimage`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `productsize`
--
ALTER TABLE `productsize`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_accessories`
--
ALTER TABLE `purchase_accessories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_leather`
--
ALTER TABLE `purchase_leather`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_leather_color`
--
ALTER TABLE `purchase_leather_color`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendor_bill`
--
ALTER TABLE `vendor_bill`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessories_inventory`
--
ALTER TABLE `accessories_inventory`
  ADD CONSTRAINT `accessories_inventory_accessories_id_foreign` FOREIGN KEY (`accessories_id`) REFERENCES `accessories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leather_colors`
--
ALTER TABLE `leather_colors`
  ADD CONSTRAINT `leather_colors_leather_id_foreign` FOREIGN KEY (`leather_id`) REFERENCES `leather` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leather_inventory`
--
ALTER TABLE `leather_inventory`
  ADD CONSTRAINT `leather_inventory_leathercolor_id_foreign` FOREIGN KEY (`leathercolor_id`) REFERENCES `leather_colors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leather_transaction`
--
ALTER TABLE `leather_transaction`
  ADD CONSTRAINT `leather_transaction_purchase_leather_id_foreign` FOREIGN KEY (`purchase_leather_id`) REFERENCES `purchase_leather` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `productaccessories`
--
ALTER TABLE `productaccessories`
  ADD CONSTRAINT `productaccessories_accessories_id_foreign` FOREIGN KEY (`accessories_id`) REFERENCES `accessories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productaccessories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `productimage`
--
ALTER TABLE `productimage`
  ADD CONSTRAINT `productimage_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `productsize`
--
ALTER TABLE `productsize`
  ADD CONSTRAINT `productsize_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `product_colors_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_colors_productcolor_id_foreign` FOREIGN KEY (`productcolor_id`) REFERENCES `leather_colors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_accessories`
--
ALTER TABLE `purchase_accessories`
  ADD CONSTRAINT `purchase_accessories_accessories_id_foreign` FOREIGN KEY (`accessories_id`) REFERENCES `accessories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_leather`
--
ALTER TABLE `purchase_leather`
  ADD CONSTRAINT `purchase_leather_leather_vendor_id_foreign` FOREIGN KEY (`leather_vendor_id`) REFERENCES `leather_vendor` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_leather_color`
--
ALTER TABLE `purchase_leather_color`
  ADD CONSTRAINT `purchase_leather_color_leather_color_id_foreign` FOREIGN KEY (`leather_color_id`) REFERENCES `leather_colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_leather_color_purchase_leather_id_foreign` FOREIGN KEY (`purchase_leather_id`) REFERENCES `purchase_leather` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendor_bill`
--
ALTER TABLE `vendor_bill`
  ADD CONSTRAINT `vendor_bill_leather_purchase_id_foreign` FOREIGN KEY (`leather_purchase_id`) REFERENCES `purchase_leather` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vendor_bill_leather_vendor_id_foreign` FOREIGN KEY (`leather_vendor_id`) REFERENCES `purchase_leather` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
