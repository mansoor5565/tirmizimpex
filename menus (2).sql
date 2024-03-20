-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 20, 2024 at 11:12 AM
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
-- Database: `tirmizimpex2`
--

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
(3, 'Venue', 'bi bi-box', NULL, 3, 'venue.index', '2024-03-15 02:35:07', '2024-03-15 02:35:07'),
(4, 'Product', 'bi bi-box', NULL, 1, 'product.index', '2024-03-15 03:38:16', '2024-03-15 03:38:16'),
(6, 'Purchase Management', 'bi bi-box', NULL, 3, 'purchase', '2024-03-15 03:45:13', '2024-03-15 03:59:48'),
(8, 'Purchase Accessories', 'bi bi-box', 6, 1, 'purchase_accessories.index', '2024-03-15 03:52:37', '2024-03-19 18:35:26'),
(9, 'Inventory Management', 'bi bi-box', NULL, 6, 'inventory', '2024-03-15 03:54:39', '2024-03-15 03:54:39'),
(10, 'Accessories Inventory', 'bi bi-box', 9, 2, 'accessories_inventory.index', '2024-03-15 04:00:45', '2024-03-15 04:00:45'),
(11, 'Leather Inventory', 'bi bi-box', 9, 1, 'leather_inventory.index', '2024-03-15 04:01:27', '2024-03-15 04:01:27'),
(20, 'Leather Management', 'bi bi-box', NULL, 4, 'leather', '2024-03-20 10:50:44', '2024-03-20 10:50:44'),
(21, 'Leather Vendor', 'bi bi-box', 20, 1, 'leather_vendor.index', '2024-03-20 10:51:12', '2024-03-20 10:51:12'),
(22, 'Purchase Leather', 'bi bi-box', 20, 2, 'purchase_leather.index', '2024-03-20 10:51:42', '2024-03-20 10:51:42'),
(23, 'Leather Transaction', 'bi bi-box', 20, 3, 'leather_transaction.index', '2024-03-20 10:52:16', '2024-03-20 10:52:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
