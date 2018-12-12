-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 12, 2018 at 12:49 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lv_gym_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `alias`, `parent_id`, `description`, `status`, `created_at`) VALUES
(4, 'Mens', 'mens', 0, '<p>Menly &amp; Strongs</p>\r\n', 0, '2018-12-05 03:05:56'),
(5, 'Shirts', 'shirts', 4, '<p>ok</p>\r\n', 0, '2018-12-05 03:06:45'),
(6, 'Womens', 'womens', 0, '<p>Pretty</p>\r\n', 0, '2018-12-05 03:07:07'),
(7, 'Pants', 'pants', 6, '<p>ok</p>\r\n', 0, '2018-12-05 03:07:24'),
(8, 'Shoes', 'shoes', 4, '<p>shoes</p>\r\n', 0, '2018-12-05 03:07:37'),
(9, 'Equipment', 'equipment', 0, '<p>equipment</p>\r\n', 0, '2018-12-05 03:07:55'),
(10, 'Shorts', 'shorts', 6, '<p>comfortable &amp; nices</p>\r\n', 0, '2018-12-06 13:38:35'),
(11, 'Shorts', 'shorts', 4, '<p>mens</p>\r\n', 0, '2018-12-09 12:48:57'),
(12, 'Hoodie & Jacket', 'hoodie--jacket', 4, '<p>mens</p>\r\n', 0, '2018-12-09 13:19:54'),
(13, 'Base Layers', 'base-layers', 4, '<p>base</p>\r\n', 0, '2018-12-09 13:38:08'),
(14, 'Hoodie & Jacket', 'hoodie--jacket', 6, '', 0, '2018-12-09 14:36:47'),
(15, 'T-shirt', 'tshirt', 6, '', 0, '2018-12-09 14:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `like` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pro_id` (`pro_id`),
  KEY `user_id` (`user_id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `pro_id`, `user_id`, `comment`, `parent`, `like`, `created_at`) VALUES
(3, 4, 4, 'nice', 0, 0, '2018-12-05 05:55:52'),
(4, 4, 4, 'tks', 3, 0, '2018-12-05 05:55:57'),
(5, 1, 4, 'nice short', 0, 0, '2018-12-08 03:47:28'),
(6, 1, 4, 'Love it', 0, 0, '2018-12-08 03:47:44'),
(7, 1, 5, 'tks so much!!!', 5, 0, '2018-12-08 03:50:26'),
(8, 1, 4, 'Jack You\'re Welcome', 5, 0, '2018-12-08 03:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `destroy_product`
--

DROP TABLE IF EXISTS `destroy_product`;
CREATE TABLE IF NOT EXISTS `destroy_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `size` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destroy_product`
--

INSERT INTO `destroy_product` (`id`, `user_id`, `pro_id`, `size`, `quantity`, `created_at`) VALUES
(1, 1, 58, '{\"XS\":\"2\"}', 2, '2018-12-10 05:40:59'),
(2, 1, 4, 'null', 2, '2018-12-10 05:41:17'),
(3, 1, 4, 'null', 45, '2018-12-10 07:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `detail_stock`
--

DROP TABLE IF EXISTS `detail_stock`;
CREATE TABLE IF NOT EXISTS `detail_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_in` decimal(10,2) NOT NULL,
  `size` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `stock_id` (`stock_id`),
  KEY `pro_id` (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `detail_stock`
--

INSERT INTO `detail_stock` (`id`, `stock_id`, `pro_id`, `quantity`, `price_in`, `size`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 33, '10.00', '{\"XS\":\"22\",\"L\":\"11\"}', 0, '2018-12-05 04:13:38', '2018-12-05 04:13:38'),
(2, 2, 2, 31, '17.00', '{\"XS\":\"10\",\"S\":\"11\"}', 0, '2018-12-05 04:16:20', '2018-12-05 04:16:20'),
(3, 2, 3, 20, '12.00', '{\"XS\":\"10\"}', 0, '2018-12-05 04:18:51', '2018-12-05 04:18:51'),
(4, 2, 4, 20, '10.00', 'null', 0, '2018-12-05 04:24:12', '2018-12-05 04:24:12'),
(5, 2, 5, 31, '16.00', '{\"XS\":\"11\",\"S\":\"20\"}', 0, '2018-12-05 04:30:06', '2018-12-05 04:30:06'),
(6, 3, 4, 20, '10.00', 'null', 2, '2018-12-05 04:32:15', '2018-12-05 04:32:15'),
(7, 3, 3, 10, '12.00', '{\"XS\":\"10\"}', 2, '2018-12-05 04:32:24', '2018-12-05 04:32:24'),
(8, 3, 4, 20, '10.00', 'null', 1, '2018-12-05 04:36:10', '2018-12-05 04:36:10'),
(9, 3, 3, 20, '12.00', '{\"XS\":\"20\"}', 1, '2018-12-05 04:39:37', '2018-12-05 04:39:37'),
(10, 4, 6, 42, '10.00', '{\"XS\":\"15\",\"S\":\"15\",\"XL\":\"12\"}', 0, '2018-12-06 13:47:07', '2018-12-06 13:47:07'),
(11, 4, 4, 50, '10.00', 'null', 2, '2018-12-06 13:47:28', '2018-12-06 13:47:28'),
(12, 5, 7, 30, '15.00', '{\"XS\":\"10\",\"S\":\"20\"}', 0, '2018-12-08 12:57:12', '2018-12-08 12:57:12'),
(13, 5, 6, 40, '10.00', '{\"XS\":\"10\",\"2XL\":\"30\"}', 1, '2018-12-08 12:58:17', '2018-12-08 12:58:17'),
(14, 7, 8, 70, '15.00', '{\"XS\":\"15\",\"S\":\"15\",\"M\":\"15\",\"L\":\"13\",\"2XL\":\"12\"}', 0, '2018-12-09 12:59:57', '2018-12-09 12:59:57'),
(15, 7, 9, 46, '15.00', '{\"XS\":\"15\",\"S\":\"20\",\"3XL\":\"11\"}', 0, '2018-12-09 13:02:21', '2018-12-09 13:02:21'),
(16, 7, 10, 59, '15.00', '{\"XS\":\"12\",\"S\":\"32\",\"XL\":\"15\"}', 0, '2018-12-09 13:04:03', '2018-12-09 13:04:03'),
(17, 7, 11, 75, '17.00', '{\"XS\":\"13\",\"XL\":\"22\",\"2XL\":\"40\"}', 0, '2018-12-09 13:05:58', '2018-12-09 13:05:58'),
(18, 7, 12, 45, '20.00', '{\"XS\":\"15\",\"M\":\"15\",\"2XL\":\"15\"}', 0, '2018-12-09 13:08:06', '2018-12-09 13:08:06'),
(19, 7, 13, 30, '30.00', '{\"XS\":\"15\",\"M\":\"15\"}', 0, '2018-12-09 13:10:06', '2018-12-09 13:10:06'),
(20, 7, 14, 110, '15.00', '{\"XS\":\"30\",\"S\":\"30\",\"L\":\"20\",\"2XL\":\"30\"}', 0, '2018-12-09 13:12:02', '2018-12-09 13:12:02'),
(21, 7, 15, 50, '30.00', '{\"XS\":\"10\",\"L\":\"20\",\"2XL\":\"20\"}', 0, '2018-12-09 13:14:15', '2018-12-09 13:14:15'),
(22, 7, 16, 60, '20.00', '{\"M\":\"30\",\"L\":\"20\",\"2XL\":\"10\"}', 0, '2018-12-09 13:15:50', '2018-12-09 13:15:50'),
(23, 7, 17, 60, '20.00', '{\"XS\":\"20\",\"M\":\"30\",\"XL\":\"10\"}', 0, '2018-12-09 13:17:30', '2018-12-09 13:17:30'),
(24, 8, 18, 60, '45.00', '{\"XS\":\"10\",\"M\":\"30\",\"2XL\":\"20\"}', 0, '2018-12-09 13:21:31', '2018-12-09 13:21:31'),
(25, 8, 19, 40, '45.00', '{\"XS\":\"30\",\"XL\":\"10\"}', 0, '2018-12-09 13:23:13', '2018-12-09 13:23:13'),
(26, 8, 20, 53, '40.00', '{\"XS\":\"12\",\"S\":\"20\",\"M\":\"10\",\"XL\":\"11\"}', 0, '2018-12-09 13:25:23', '2018-12-09 13:25:23'),
(27, 8, 21, 40, '40.00', '{\"XS\":\"20\",\"M\":\"20\"}', 0, '2018-12-09 13:26:53', '2018-12-09 13:26:53'),
(28, 8, 22, 40, '40.00', '{\"L\":\"40\"}', 0, '2018-12-09 13:28:25', '2018-12-09 13:28:25'),
(29, 8, 23, 60, '40.00', '{\"M\":\"30\",\"XL\":\"30\"}', 0, '2018-12-09 13:30:05', '2018-12-09 13:30:05'),
(30, 8, 24, 33, '70.00', '{\"XL\":\"33\"}', 0, '2018-12-09 13:31:28', '2018-12-09 13:31:28'),
(31, 8, 25, 42, '50.00', '{\"XS\":\"20\",\"S\":\"12\",\"XL\":\"10\"}', 0, '2018-12-09 13:33:01', '2018-12-09 13:33:01'),
(32, 8, 26, 31, '50.00', '{\"XS\":\"11\",\"2XL\":\"20\"}', 0, '2018-12-09 13:34:54', '2018-12-09 13:34:54'),
(33, 8, 27, 43, '40.00', '{\"XS\":\"20\",\"L\":\"12\",\"M\":\"11\"}', 0, '2018-12-09 13:36:37', '2018-12-09 13:36:37'),
(34, 9, 28, 40, '25.00', '{\"XS\":\"10\",\"M\":\"30\"}', 0, '2018-12-09 13:40:19', '2018-12-09 13:40:19'),
(35, 9, 29, 42, '20.00', '{\"XS\":\"12\",\"M\":\"10\",\"3XL\":\"20\"}', 0, '2018-12-09 13:42:30', '2018-12-09 13:42:30'),
(36, 9, 30, 30, '20.00', '{\"XS\":\"10\",\"L\":\"20\"}', 0, '2018-12-09 13:43:56', '2018-12-09 13:43:56'),
(37, 9, 31, 60, '25.00', '{\"L\":\"30\",\"XL\":\"20\",\"M\":\"10\"}', 0, '2018-12-09 13:46:17', '2018-12-09 13:46:17'),
(38, 9, 32, 20, '20.00', '{\"XS\":\"20\"}', 0, '2018-12-09 13:47:54', '2018-12-09 13:47:54'),
(39, 9, 33, 25, '20.00', '{\"XS\":\"12\",\"M\":\"13\"}', 0, '2018-12-09 13:49:23', '2018-12-09 13:49:23'),
(40, 10, 34, 60, '25.00', '{\"M\":\"20\",\"L\":\"20\",\"XL\":\"20\"}', 0, '2018-12-09 13:52:08', '2018-12-09 13:52:08'),
(41, 10, 35, 70, '25.00', '{\"XS\":\"30\",\"S\":\"20\",\"M\":\"20\"}', 0, '2018-12-09 13:53:42', '2018-12-09 13:53:42'),
(42, 10, 36, 20, '30.00', '{\"L\":\"20\"}', 0, '2018-12-09 13:55:14', '2018-12-09 13:55:14'),
(43, 10, 37, 20, '15.00', '{\"XS\":\"10\",\"L\":\"10\"}', 0, '2018-12-09 13:56:41', '2018-12-09 13:56:41'),
(44, 10, 38, 60, '30.00', '{\"XS\":\"20\",\"M\":\"30\",\"XL\":\"10\"}', 0, '2018-12-09 13:58:13', '2018-12-09 13:58:13'),
(45, 10, 39, 30, '20.00', '{\"XS\":\"30\"}', 0, '2018-12-09 14:00:11', '2018-12-09 14:00:11'),
(46, 10, 40, 44, '20.00', '{\"XS\":\"12\",\"S\":\"20\",\"L\":\"12\"}', 0, '2018-12-09 14:01:46', '2018-12-09 14:01:46'),
(47, 10, 41, 40, '20.00', '{\"XS\":\"10\",\"L\":\"10\",\"M\":\"10\",\"3XL\":\"10\"}', 0, '2018-12-09 14:03:36', '2018-12-09 14:03:36'),
(48, 10, 42, 44, '20.00', '{\"XS\":\"44\"}', 0, '2018-12-09 14:05:09', '2018-12-09 14:05:09'),
(49, 10, 43, 42, '25.00', '{\"XS\":\"12\",\"L\":\"20\",\"S\":\"10\"}', 0, '2018-12-09 14:06:50', '2018-12-09 14:06:50'),
(50, 11, 44, 60, '45.00', '{\"XS\":\"10\",\"L\":\"20\",\"2XL\":\"30\"}', 0, '2018-12-09 14:41:15', '2018-12-09 14:41:15'),
(51, 11, 45, 62, '40.00', '{\"XS\":\"20\",\"XL\":\"12\",\"S\":\"30\"}', 0, '2018-12-09 14:42:29', '2018-12-09 14:42:29'),
(52, 11, 46, 30, '30.00', '{\"XS\":\"10\",\"M\":\"20\"}', 0, '2018-12-09 14:44:27', '2018-12-09 14:44:27'),
(53, 11, 47, 20, '40.00', '{\"XS\":\"20\"}', 0, '2018-12-09 14:45:52', '2018-12-09 14:45:52'),
(54, 11, 48, 30, '40.00', '{\"XS\":\"10\",\"M\":\"20\"}', 0, '2018-12-09 14:47:30', '2018-12-09 14:47:30'),
(55, 12, 49, 52, '30.00', '{\"XS\":\"12\",\"M\":\"20\",\"L\":\"20\"}', 0, '2018-12-09 14:50:42', '2018-12-09 14:50:42'),
(56, 12, 50, 66, '20.00', '{\"XS\":\"11\",\"S\":\"55\"}', 0, '2018-12-09 14:52:22', '2018-12-09 14:52:22'),
(57, 12, 51, 42, '25.00', '{\"XS\":\"10\",\"S\":\"12\",\"M\":\"20\"}', 0, '2018-12-09 14:54:01', '2018-12-09 14:54:01'),
(58, 12, 52, 40, '30.00', '{\"XS\":\"20\",\"S\":\"10\",\"XL\":\"10\"}', 0, '2018-12-09 14:55:40', '2018-12-09 14:55:40'),
(59, 12, 53, 50, '30.00', '{\"S\":\"50\"}', 0, '2018-12-09 14:57:06', '2018-12-09 14:57:06'),
(60, 12, 54, 32, '40.00', '{\"XS\":\"10\",\"M\":\"12\",\"XL\":\"10\"}', 0, '2018-12-09 15:00:15', '2018-12-09 15:00:15'),
(61, 12, 55, 35, '20.00', '{\"XS\":\"35\"}', 0, '2018-12-09 15:01:35', '2018-12-09 15:01:35'),
(62, 12, 56, 30, '25.00', '{\"XS\":\"10\",\"S\":\"10\",\"L\":\"10\"}', 0, '2018-12-09 15:03:06', '2018-12-09 15:03:06'),
(63, 12, 57, 30, '40.00', '{\"XS\":\"10\",\"M\":\"20\"}', 0, '2018-12-09 15:04:36', '2018-12-09 15:04:36'),
(64, 12, 58, 10, '20.00', '{\"XS\":\"10\"}', 0, '2018-12-09 15:06:08', '2018-12-09 15:06:08'),
(65, 13, 4, 30, '10.00', 'null', 1, '2018-12-10 05:43:08', '2018-12-10 05:43:08'),
(66, 13, 58, 40, '20.00', '{\"XS\":\"10\",\"M\":\"10\",\"L\":\"20\"}', 1, '2018-12-10 05:43:54', '2018-12-10 05:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `content` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `customer_id`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'hi', 1, '2018-12-05 05:30:34', '2018-12-05 05:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `group_permission`
--

DROP TABLE IF EXISTS `group_permission`;
CREATE TABLE IF NOT EXISTS `group_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `per_id` int(11) NOT NULL,
  `list_product` int(11) DEFAULT '0',
  `insert_product` int(11) DEFAULT '0',
  `edit_product` int(11) DEFAULT '0',
  `delete_product` int(11) DEFAULT '0',
  `list_category` int(11) DEFAULT '0',
  `insert_category` int(11) DEFAULT '0',
  `edit_category` int(11) DEFAULT '0',
  `delete_category` int(11) DEFAULT '0',
  `list_user` int(11) DEFAULT '0',
  `insert_user` int(11) DEFAULT '0',
  `edit_user` int(11) DEFAULT '0',
  `delete_user` int(11) DEFAULT '0',
  `list_permission` int(11) DEFAULT '0',
  `insert_permission` int(11) DEFAULT '0',
  `edit_permission` int(11) DEFAULT '0',
  `delete_permission` int(11) DEFAULT '0',
  `list_order` int(11) DEFAULT '0',
  `edit_order` int(11) DEFAULT '0',
  `list_ship` int(11) DEFAULT '0',
  `edit_ship` int(11) DEFAULT '0',
  `list_stock` int(11) DEFAULT '0',
  `insert_stock` int(11) DEFAULT '0',
  `edit_stock` int(11) DEFAULT '0',
  `delete_stock` int(11) DEFAULT '0',
  `list_detail_stock` int(11) DEFAULT '0',
  `insert_detail_stock` int(11) DEFAULT '0',
  `edit_detail_stock` int(11) DEFAULT '0',
  `delete_detail_stock` int(11) DEFAULT '0',
  `list_promotion` int(11) DEFAULT '0',
  `insert_promotion` int(11) DEFAULT '0',
  `edit_promotion` int(11) DEFAULT '0',
  `delete_promotion` int(11) DEFAULT '0',
  `list_promotion_detail` int(11) DEFAULT '0',
  `insert_promotion_detail` int(11) DEFAULT '0',
  `edit_promotion_detail` int(11) DEFAULT '0',
  `delete_promotion_detail` int(11) DEFAULT '0',
  `list_supplier` int(11) NOT NULL DEFAULT '0',
  `insert_supplier` int(11) NOT NULL DEFAULT '0',
  `edit_supplier` int(11) NOT NULL DEFAULT '0',
  `delete_supplier` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `per_id` (`per_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_permission`
--

INSERT INTO `group_permission` (`id`, `per_id`, `list_product`, `insert_product`, `edit_product`, `delete_product`, `list_category`, `insert_category`, `edit_category`, `delete_category`, `list_user`, `insert_user`, `edit_user`, `delete_user`, `list_permission`, `insert_permission`, `edit_permission`, `delete_permission`, `list_order`, `edit_order`, `list_ship`, `edit_ship`, `list_stock`, `insert_stock`, `edit_stock`, `delete_stock`, `list_detail_stock`, `insert_detail_stock`, `edit_detail_stock`, `delete_detail_stock`, `list_promotion`, `insert_promotion`, `edit_promotion`, `delete_promotion`, `list_promotion_detail`, `insert_promotion_detail`, `edit_promotion_detail`, `delete_promotion_detail`, `list_supplier`, `insert_supplier`, `edit_supplier`, `delete_supplier`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-12-05 03:00:43', '2018-12-05 03:00:43'),
(2, 2, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-12-05 08:29:02', '2018-12-05 08:29:02'),
(3, 2, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-12-05 08:30:19', '2018-12-05 08:30:19'),
(4, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-12-05 08:32:00', '2018-12-05 08:32:00'),
(5, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-12-05 08:32:03', '2018-12-05 08:32:03'),
(6, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-12-05 08:37:39', '2018-12-05 08:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

DROP TABLE IF EXISTS `like`;
CREATE TABLE IF NOT EXISTS `like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `comment_id` (`comment_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`id`, `comment_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 3, 4, '2018-12-05 05:55:58', '2018-12-05 05:55:58'),
(3, 5, 4, '2018-12-08 03:47:48', '2018-12-08 03:47:48'),
(4, 5, 5, '2018-12-08 03:50:29', '2018-12-08 03:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `area` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_place` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_cost` decimal(10,2) NOT NULL,
  `payment` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `area`, `delivery_place`, `delivery_cost`, `payment`, `status`, `created_at`) VALUES
(11, 4, 'hcm', 'Q1', '2.00', 0, 5, '2018-12-05 05:47:30'),
(12, 4, 'hcm', 'Q1', '2.00', 1, 4, '2018-12-05 05:48:27'),
(13, 4, 'hcm', 'Q1', '2.00', 0, 4, '2018-12-05 05:51:00'),
(14, 4, 'hcm', 'Q1', '2.00', 0, 5, '2018-12-05 05:52:20'),
(15, 4, 'other', 'Q1', '4.00', 1, 4, '2018-12-05 05:53:12'),
(16, 4, 'other', 'Q1', '4.00', 0, 4, '2018-12-05 13:42:49'),
(17, 4, 'hcm', 'Q1', '2.00', 1, 4, '2018-12-05 13:43:40'),
(18, 4, 'hcm', 'Q1', '2.00', 1, 4, '2018-12-08 03:42:01'),
(19, 4, 'hcm', 'Q1', '2.00', 1, 4, '2018-12-08 06:31:49'),
(20, 4, 'hcm', 'Q1', '2.00', 0, 4, '2018-12-08 12:39:55'),
(21, 4, 'hcm', 'Q1', '2.00', 0, 4, '2018-12-08 12:42:40'),
(22, 4, 'hcm', 'Q1', '2.00', 0, 3, '2018-12-08 13:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `size` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`,`pro_id`),
  KEY `pro_id` (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `pro_id`, `price`, `size`, `quantity`, `created_at`) VALUES
(1, 11, 4, '22.00', 'none', 1, '2018-11-05 05:47:30'),
(2, 12, 1, '17.00', 'XS', 2, '2018-11-05 05:48:27'),
(3, 12, 2, '17.20', 'XS', 3, '2018-11-05 05:48:27'),
(4, 13, 4, '22.00', 'none', 2, '2018-10-05 05:51:00'),
(5, 13, 5, '30.00', 'XS', 2, '2018-10-05 05:51:00'),
(6, 14, 4, '22.00', 'none', 1, '2018-09-05 05:52:20'),
(7, 15, 4, '22.00', 'none', 3, '2018-08-05 05:53:12'),
(8, 15, 5, '30.00', 'XS', 3, '2018-08-05 05:53:12'),
(9, 16, 2, '17.20', 'XS', 2, '2018-05-05 13:42:50'),
(10, 16, 4, '22.00', 'none', 2, '2018-05-05 13:42:50'),
(11, 16, 5, '30.00', 'XS', 1, '2018-05-05 13:42:50'),
(12, 17, 1, '17.00', 'XS', 2, '2018-04-05 13:43:40'),
(13, 17, 5, '30.00', 'XS', 1, '2018-04-05 13:43:41'),
(14, 18, 4, '22.00', 'none', 1, '2018-02-08 03:42:01'),
(15, 18, 6, '10.68', 'XS', 3, '2018-02-08 03:42:01'),
(16, 19, 6, '10.68', 'XS', 3, '2018-01-08 06:31:49'),
(17, 19, 4, '22.00', 'none', 1, '2018-01-08 06:31:50'),
(18, 20, 1, '16.00', 'XS', 1, '2017-12-08 12:39:55'),
(19, 21, 2, '20.00', 'XS', 1, '2018-12-08 12:42:40'),
(20, 21, 4, '22.00', 'none', 5, '2018-12-08 12:42:40'),
(21, 22, 2, '18.00', 'S', 1, '2018-12-08 13:11:05'),
(22, 22, 1, '16.00', 'XS', 1, '2018-12-08 13:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`, `position`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, '2018-12-05 02:56:38', '2018-12-05 02:56:38'),
(2, 'EnterData', NULL, '2018-12-05 04:41:49', '2018-12-05 04:41:49'),
(3, 'Sale Management', NULL, '2018-12-05 04:42:58', '2018-12-05 04:42:58'),
(4, 'Customer', NULL, '2018-12-05 04:43:59', '2018-12-05 04:43:59'),
(5, 'Saler', NULL, '2018-12-05 04:44:12', '2018-12-05 04:44:12'),
(6, 'Shipper', NULL, '2018-12-05 04:44:17', '2018-12-05 04:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cate_id` int(11) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `price_in` decimal(10,2) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sub_image` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cate_id` (`cate_id`),
  KEY `sup_id` (`sup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `alias`, `cate_id`, `sup_id`, `price_in`, `price`, `quantity`, `size`, `image`, `sub_image`, `intro`, `description`, `view`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BASIC TRAINING SHORTS', 'basic-training-shorts', 5, 9, '10.00', '17.00', 26, '{\"XS\":15,\"L\":\"11\"}', 't5-41544366178.jpg', '[]', 'All the basics and all you need.', '• Relaxed fit \r\n• Overlapping side seam split \r\n• Zip pocket with fusing \r\n• Branded flat drawcord \r\n• 95% Polyester, 5% Elastane \r\n• Model is 6\'0\" and wears size M\r\n\r\nThe Basic Training Shorts work with you in the gym and support you out of it. A loose fit gives complete freedom to squat, sprint and jump for a fully focused workout.', 5, 0, '2018-12-05 04:13:38', '2018-12-05 04:13:38'),
(2, 'FLAWLESS KNIT TIGHTS', 'flawless-knit-tights', 5, 10, '17.00', '20.00', 10, '{\"XS\":0,\"S\":10}', 't1-11544366068.jpg', '[\"t2-11544366068.jpg\"]', 'Designed as part of our lifestyle collection, the Heather Dual Band Shorts boast a classic, relaxed fit with split hem design for ultimate comfort.', 'Designed as part of our lifestyle collection, the Heather Dual Band Shorts boast a classic, relaxed fit with split hem design for ultimate comfort. Concealed pockets offer an easy, safe way to store essentials on the move, whilst a dual waistband provides customisable support to help you find the perfect fit.\r\n\r\nFocusing on detail, the Heather Dual Band Shorts are crafted from ultra-soft French Terry fabric for consistent comfort that lasts all day.\r\n\r\nFinished with woven tag logo.\r\n\r\nMain: 78% Cotton, 22% Polyester\r\n\r\nPocket Bag: 69% Polyester, 31% Cotton\r\n\r\nModel is 5\'7\" and wears a size S.', 6, 0, '2018-12-05 04:16:20', '2018-12-05 04:16:20'),
(3, 'FLAWLESS KNIT LONG SLEEVE CROP TOP', 'flawless-knit-long-sleeve-crop-top', 7, 9, '12.00', '16.00', 30, '{\"XS\":30}', 't1-11544366154.jpg', '[]', 'Designed as part of our lifestyle collection, the Heather Dual Band Shorts boast a classic, relaxed fit with split hem design for ultimate comfort.', 'nice & Designed as part of our lifestyle collection, the Heather Dual Band Shorts boast a classic, relaxed fit with split hem design for ultimate comfort. Concealed pockets offer an easy, safe way to store essentials on the move, whilst a dual waistband provides customisable support to help you find the perfect fit.\r\n\r\nFocusing on detail, the Heather Dual Band Shorts are crafted from ultra-soft French Terry fabric for consistent comfort that lasts all day.\r\n\r\nFinished with woven tag logo.\r\n\r\nMain: 78% Cotton, 22% Polyester\r\n\r\nPocket Bag: 69% Polyester, 31% Cotton\r\n\r\nModel is 5\'7\" and wears a size S. ', 0, 0, '2018-12-05 04:18:51', '2018-12-05 04:18:51'),
(4, 'FLEUR TEXTURE LONG SLEEVE CROP', 'fleur-texture-long-sleeve-crop', 5, 10, '10.00', '22.00', 0, 'null', 't7-31544366134.jpg', '[]', 'Designed as part of our lifestyle collection, the Heather Dual Band Shorts boast a classic, relaxed fit with split hem design for ultimate comfort.', 'Designed as part of our lifestyle collection, the Heather Dual Band Shorts boast a classic, relaxed fit with split hem design for ultimate comfort. Concealed pockets offer an easy, safe way to store essentials on the move, whilst a dual waistband provides customisable support to help you find the perfect fit.\r\n\r\nFocusing on detail, the Heather Dual Band Shorts are crafted from ultra-soft French Terry fabric for consistent comfort that lasts all day.\r\n\r\nFinished with woven tag logo.\r\n\r\nMain: 78% Cotton, 22% Polyester\r\n\r\nPocket Bag: 69% Polyester, 31% Cotton\r\n\r\nModel is 5\'7\" and wears a size S.\r\n', 14, 0, '2018-12-05 04:24:12', '2018-12-05 04:24:12'),
(5, 'Product 55', 'product-55', 8, 9, '16.00', '30.00', 24, '{\"XS\":4,\"S\":\"20\"}', 'h10-1153258053315439835311543984206.jpg', '[\"b1-315325770231544103371.jpg\",\"b1-115326595871544103396.jpg\"]', 'nicec', 'nices', 4, 1, '2018-12-05 04:30:06', '2018-12-05 04:30:06'),
(6, 'Black Shirt', 'black-shirt', 5, 9, '10.00', '12.00', 76, '{\"XS\":19,\"S\":\"15\",\"XL\":\"12\",\"2XL\":\"30\"}', 't3-31544366111.jpg', '[]', 'nice', 'nice', 2, 0, '2018-12-06 13:47:07', '2018-12-06 13:47:07'),
(7, 'Pink Short Shirt', 'pink-short-shirt', 8, 10, '15.00', '16.00', 30, '{\"XS\":\"10\",\"S\":\"20\"}', 't2-51544366089.jpg', '[]', 'soft & comfortable', 'soft & comfortable', 0, 0, '2018-12-08 12:57:12', '2018-12-08 12:57:12'),
(8, 'BASIC TRAINING SHORTS', 'basic-training-shorts', 11, 2, '15.00', '30.00', 70, '{\"XS\":\"15\",\"S\":\"15\",\"M\":\"15\",\"L\":\"13\",\"2XL\":\"12\"}', 's1-41544360397.jpg', '[\"s1-11544360397.jpg\",\"s1-21544360397.jpg\",\"s1-31544360397.jpg\",\"s1-51544360397.jpg\"]', 'All the basics and all you need. ', ' Relaxed fit \r\n• Overlapping side seam split \r\n• Zip pocket with fusing \r\n• Branded flat drawcord \r\n• 95% Polyester, 5% Elastane \r\n• Model is 6\'0\" and wears size M\r\n\r\nThe Basic Training Shorts work with you in the gym and support you out of it. A loose fit gives complete freedom to squat, sprint and jump for a fully focused workout', 0, 0, '2018-12-09 12:59:57', '2018-12-09 12:59:57'),
(9, 'PRIMARY SHORTS BLACK', 'primary-shorts-black', 11, 10, '15.00', '30.00', 46, '{\"XS\":\"15\",\"S\":\"20\",\"3XL\":\"11\"}', 's2-41544360540.jpg', '[\"s2-11544360540.jpg\",\"s2-21544360540.jpg\",\"s2-31544360540.jpg\",\"s2-51544360540.jpg\"]', 'Nothing less than first.', ' Unique angled side seam \r\n• Grown on waistband \r\n• Branded flat drawcord \r\n• Printed Gymshark logo \r\n• 100% Polyester \r\n• Model is 6\'0\" and wears a size M.\r\n\r\nInnovative in design but customary in elite performance, the Primary Shorts are lightweight and supple while maintaining a supportive and covering fit. Featuring a unique side seam and contemporary split hem, these gym shorts are built to look and perform at the top level', 0, 0, '2018-12-09 13:02:20', '2018-12-09 13:02:20'),
(10, 'PRIMARY SHORTS SMOKEY GREY', 'primary-shorts-smokey-grey', 11, 2, '15.00', '30.00', 59, '{\"XS\":\"12\",\"S\":\"32\",\"XL\":\"15\"}', 's3-41544360642.jpg', '[\"s3-11544360642.jpg\",\"s3-21544360642.jpg\",\"s3-31544360642.jpg\",\"s3-51544360642.jpg\"]', 'Nothing less than first.', ' Unique angled side seam \r\n• Grown on waistband \r\n• Branded flat drawcord \r\n• Printed Gymshark logo \r\n• 100% Polyester \r\n• Model is 6\'0\" and wears a size M.\r\n\r\nInnovative in design but customary in elite performance, the Primary Shorts are lightweight and supple while maintaining a supportive and covering fit. Featuring a unique side seam and contemporary split hem, these gym shorts are built to look and perform at the top level', 0, 0, '2018-12-09 13:04:02', '2018-12-09 13:04:02'),
(11, '2 IN 1 TRAINING SHORTS SAPPHIRE BLUE', '2-in-1-training-shorts-sapphire-blue', 11, 9, '17.00', '32.00', 75, '{\"XS\":\"13\",\"XL\":\"22\",\"2XL\":\"40\"}', 's4-41544360758.jpg', '[\"s4-11544360758.jpg\",\"s4-21544360758.jpg\",\"s4-31544360758.jpg\",\"s4-51544360758.jpg\"]', 'Internal support and external style.', 'Inner base layer shorts \r\n• Mesh panels with in step at hem \r\n• Concealed side pocket \r\n• Flat drawcord to waist \r\n• Printed logo \r\n• Main: 87% Polyester, 13% Elastane. Inner Short: 90% Polyester, 10% Elastane. Mesh: 85% Nylon, 15% Elastane. \r\n• Model is 6\'1\" and wears a size M. \r\n\r\nThe support to assure gym performance; the detailing to do it in style. Featuring ventilation enhancement for breathability, a compressive base short and a discreet design, the Two-In-One Training Shorts are optimised for your workout', 0, 0, '2018-12-09 13:05:58', '2018-12-09 13:05:58'),
(12, 'PINNACLE KNIT SHORTS BLACK MARL', 'pinnacle-knit-shorts-black-marl', 11, 10, '20.00', '35.00', 45, '{\"XS\":\"15\",\"M\":\"15\",\"2XL\":\"15\"}', 's5-41544360886.jpg', '[\"s5-11544360886.jpg\",\"s5-21544360886.jpg\",\"s5-31544360886.jpg\",\"s5-51544360886.jpg\"]', 'Reach new heights.', 'Lightweight and relaxed fit\r\n• Fully knitted design\r\n• Ventilation detailing\r\n• Concealed side pockets\r\n• 64% Cotton, 36% Nylon\r\n• Model is 6\'1\" and wears a size M. \r\n\r\nThe Pinnacle Knit Shorts, featuring a fully knitted fabric design, are a minimalistic everyday essential that style with ease making them rest day ready. While ventilating details and concealed pockets ensure function for a gym workout', 0, 0, '2018-12-09 13:08:06', '2018-12-09 13:08:06'),
(13, 'TAKE OVER SHORTS BLACK MARL', 'take-over-shorts-black-marl', 11, 9, '30.00', '40.00', 30, '{\"XS\":\"15\",\"M\":\"15\"}', 's6-41544361006.jpg', '[\"s6-11544361006.jpg\",\"s6-21544361006.jpg\",\"s6-31544361006.jpg\",\"s6-51544361006.jpg\"]', 'Built for the urban champion, fit for the fashion forward.', 'The Take Over Shorts are a contemporary take on an enduring design. Its silhouette adapts to your lifestyle with reverse-style zip pockets to store your go-to essentials and articulated seams to ensure a relaxed and comfortable fit.\r\n\r\nEngineered from a mid-weight cotton blend, the Take Over Shorts offer a slightly heavier foundation to build outfits around. An elasticated, drawcord waistband allows for a customisable fit whist panel detailing to the inner leg guarantees a sleek aesthetic. Complete with fused, matt taping to seams.\r\n\r\nMain: 74% Cotton, 26% Polyester.\r\nPocket Bag: 69% Polyester, 31% Cotton.\r\n\r\nModel is 6\'0\" and wears size M.', 0, 0, '2018-12-09 13:10:06', '2018-12-09 13:10:06'),
(14, 'ARK SHORTS AEGEAN BLUE', 'ark-shorts-aegean-blue', 11, 1, '15.00', '26.00', 110, '{\"XS\":\"30\",\"S\":\"30\",\"L\":\"20\",\"2XL\":\"30\"}', 's7-51544361122.jpg', '[\"s7-11544361122.jpg\",\"s7-21544361122.jpg\",\"s7-31544361122.jpg\",\"s7-51544361122.jpg\"]', 'No-nonsense.', '• Loosely tapered fit\r\n• Drawstring waist and concealed side pockets\r\n• Jersey blend fabric\r\n• Minimalist design\r\n• 60% Polyester, 35% Cotton, 5% Elastane\r\n• Model is 6\'0\" and wears size M\r\n\r\nThe workhorse of your workout wardrobe. The Ark Gym Shorts are understated yet striking. They promise to support you through running and squatting and comfort you through rest days.', 0, 0, '2018-12-09 13:12:02', '2018-12-09 13:12:02'),
(15, 'FREE FLOW SHORTS SLATE LAVENDER', 'free-flow-shorts-slate-lavender', 11, 9, '30.00', '34.00', 50, '{\"XS\":\"10\",\"L\":\"20\",\"2XL\":\"20\"}', 's8-41544361255.jpg', '[\"s8-11544361255.jpg\",\"s8-21544361255.jpg\",\"s8-31544361255.jpg\",\"s8-51544361255.jpg\"]', 'Constructed from a lightweight perforated fabric, the Free Flow Shorts are engineered for enhanced ventilation and breathability, providing you with a distraction-free workout.', 'Constructed from a lightweight perforated fabric, the Free Flow Shorts are engineered for enhanced ventilation and breathability, providing you with a distraction-free workout.\r\n\r\nDesigned as part of our lifestyle range, the Free Flow Shorts integrate soft stretch fabric to allow for a full range of movement. Complete with concealed zip pockets to store your essentials safely and cut-out reflective logo.\r\n\r\n48% Polyester, 21% Viscose,13% Pima Cotton, 11% Poly propylene, 7% Nylon.\r\n\r\nModel is 6\'2\" and wears size L.', 0, 0, '2018-12-09 13:14:15', '2018-12-09 13:14:15'),
(16, 'SPORT SHORTS PORT', 'sport-shorts-port', 11, 10, '20.00', '25.00', 60, '{\"M\":\"30\",\"L\":\"20\",\"2XL\":\"10\"}', 's10-41544361350.jpg', '[\"s10-11544361350.jpg\",\"s10-21544361350.jpg\",\"s10-31544361350.jpg\"]', 'Your new go to shorts for any type of activity.', 'Your new go to shorts for any type of activity. The Men\'s Sports Shorts are a gym bag essential.\r\n\r\n- Adjustable waistband\r\n- Mesh ventilation\r\n- Gymshark logo\r\n\r\n100% Polyester\r\n\r\nModel is 6\'2\" and wears size L', 0, 0, '2018-12-09 13:15:50', '2018-12-09 13:15:50'),
(17, 'ELEMENT+ BASELAYER SHORTS SAPPHIRE BLUE MARL', 'element+-baselayer-shorts-sapphire-blue-marl', 11, 10, '20.00', '25.00', 60, '{\"XS\":\"20\",\"M\":\"30\",\"XL\":\"10\"}', 's9-41544361450.jpg', '[\"s9-11544361450.jpg\",\"s9-21544361450.jpg\",\"s9-31544361450.jpg\"]', 'Primed for performance.', '• Muscle shaping cover stitch seam\r\n• Raised rubber print waistband\r\n• Mesh panels and DRY technology\r\n• Printed Gymshark logo\r\n• Main: 90% Polyester, 10% Elastane. Mesh: 90% Polyester, 10% Elastane.\r\n• Model is 6\'0\" and wears a size M. \r\n\r\nSupportive, functional and physique-enhancing, the Element+ Baselayer Shorts have been crafted for pristine performance. Maintain freshness and focus with sweat-wicking fabrics and maintain strength and endurance with supportive compression. Element+, assisting your training every rep of the way.', 0, 0, '2018-12-09 13:17:30', '2018-12-09 13:17:30'),
(18, 'FRESH PULLOVER BLACK', 'fresh-pullover-black', 12, 2, '45.00', '50.00', 60, '{\"XS\":\"10\",\"M\":\"30\",\"2XL\":\"20\"}', 'h10-41544361691.jpg', '[\"h10-11544361691.jpg\",\"h10-21544361691.jpg\",\"h10-31544361691.jpg\",\"h10-51544361691.jpg\"]', 'A pioneer in casual wear.', '- Straight, relaxed fit\r\n- Funnel neck hood\r\n- Dropped shoulder design\r\n- Discreet embroidered Gymshark logo\r\n- 99% Cotton, 1% Viscose\r\n- Model is 6\'1\" and wears a size M.\r\n\r\nCurrent and contemporary, the Fresh Pullover is a design to talk about. An introverted aest', 0, 0, '2018-12-09 13:21:31', '2018-12-09 13:21:31'),
(19, 'FRESH PULLOVER WHITE', 'fresh-pullover-white', 12, 10, '45.00', '50.00', 40, '{\"XS\":\"30\",\"XL\":\"10\"}', 'h9-41544361793.jpg', '[\"h9-11544361793.jpg\",\"h-21544361793.jpg\",\"h9-31544361793.jpg\",\"h9-51544361793.jpg\"]', 'A pioneer in casual wear.', '- Straight, relaxed fit\r\n- Funnel neck hood\r\n- Dropped shoulder design\r\n- Discreet embroidered Gymshark logo\r\n- 99% Cotton, 1% Viscose\r\n- Model is 6\'1\" and wears a size M. \r\n\r\nCurrent and contemporary, the Fresh Pullover is a design to talk about. An introverted aesthetic with a style-focused design makes this hoodie a truly unique article.', 0, 0, '2018-12-09 13:23:13', '2018-12-09 13:23:13'),
(20, 'FLATLOCK TRACK TOP SAPPHIRE BLUE', 'flatlock-track-top-sapphire-blue', 12, 9, '40.00', '45.00', 53, '{\"XS\":\"12\",\"S\":\"20\",\"M\":\"10\",\"XL\":\"11\"}', 'h8-41544361923.jpg', '[\"h8-11544361923.jpg\",\"h8-21544361923.jpg\",\"h8-31544361923.jpg\",\"h8-51544361923.jpg\"]', ' Sleek, lightweight and form-fitting.', 'Sleek, lightweight and form-fitting.\r\n\r\n\r\n• Athletic fit\r\n• Flat lock covered seams\r\n• Self fabric cuffs and hem\r\n• Concealed zip pockets\r\n• 100% Polyester\r\n• Model is 6\'4\" and wears a size L\r\n\r\nMoving with you and your workout, the Flatlock Track Top is a covering layer that completes your look and supports your training. Fitted with flat lock seams and concealed side pockets, its aesthetic is as sleek as its performance.', 0, 0, '2018-12-09 13:25:23', '2018-12-09 13:25:23'),
(21, 'JACQUARD PULLOVER WOODLAND GREEN MARL', 'jacquard-pullover-woodland-green-marl', 12, 9, '40.00', '45.00', 40, '{\"XS\":\"20\",\"M\":\"20\"}', 'h7-41544362013.jpg', '[\"h7-11544362013.jpg\",\"h7-21544362013.jpg\",\"h7-31544362013.jpg\",\"h7-51544362013.jpg\"]', 'Enviable streetwear styling and comfort that lasts.', '\r\n• Jacquard-style fabric\r\n• Contrasting back panel and dipped hem\r\n• Open hood neckline\r\n• Concealed side zip pocket\r\n• Main: 50% Viscose, 45% Polyester, 5% Elastane. Lining: 69% Polyester, 31% Cotton\r\n• Model is 6\'1\" and wears a size M. \r\n\r\nThe Jacquard Pullover’s design is soft to the touch providing ultimate comfort and with a distinctive hoodie design, streetwear has never looked so good.', 0, 0, '2018-12-09 13:26:53', '2018-12-09 13:26:53'),
(22, 'JACQUARD PULLOVER BLACK MARL', 'jacquard-pullover-black-marl', 12, 10, '40.00', '45.00', 40, '{\"L\":\"40\"}', 'h6-41544362105.jpg', '[\"h6-11544362105.jpg\",\"h6-21544362105.jpg\",\"h6-31544362105.jpg\",\"h6-51544362105.jpg\"]', 'Enviable streetwear styling and comfort that lasts.', 'Crafted from a premium, textured jacquard-style fabric, its design is soft to the touch allowing for ultimate comfort.\r\n\r\nWith a contrasting back panel, dropped hem and short sleeve design, streetwear never looked so good. Finished with standard, open hood neckline and a side concealed zip pocket for a sleek, clean aesthetic.\r\n\r\nMain: 50% Viscose, 45% Polyester, 5% Elastane. Lining: 69% Polyester, 31% Cotton.\r\n\r\nModel is 6\'0\" and wears size M', 0, 0, '2018-12-09 13:28:25', '2018-12-09 13:28:25'),
(23, 'JACQUARD PULLOVER AEGEAN BLUE MARL', 'jacquard-pullover-aegean-blue-marl', 12, 9, '40.00', '45.00', 60, '{\"M\":\"30\",\"XL\":\"30\"}', 'h5-41544362205.jpg', '[\"h5-11544362205.jpg\",\"h5-21544362205.jpg\",\"h5-31544362205.jpg\",\"h5-51544362205.jpg\",\"h5-61544362205.jpg\"]', 'Enviable streetwear styling and comfort that lasts.', '• Jacquard-style fabric\r\n• Contrasting back panel and dipped hem\r\n• Open hood neckline\r\n• Concealed side zip pocket\r\n• Main: 50% Viscose, 45% Polyester, 5% Elastane. Lining: 69% Polyester, 31% Cotton\r\n• Model is 6\'4\" and wears a size L. \r\n\r\nThe Jacquard Pullover’s design is soft to the touch providing ultimate comfort and with a distinctive hoodie design, streetwear has never looked so good.', 0, 0, '2018-12-09 13:30:05', '2018-12-09 13:30:05'),
(24, 'VORTEX WATERPROOF JACKET BLACK', 'vortex-waterproof-jacket-black', 12, 9, '70.00', '85.00', 33, '{\"XL\":\"33\"}', 'h4-41544362288.jpg', '[\"h4-11544362288.jpg\",\"h4-21544362288.jpg\",\"h4-31544362288.jpg\",\"h4-51544362288.jpg\"]', 'Conquer the climate.', '• Textured waterproof fabric\r\n• Concealed zip and popper opening\r\n• Funnel neck and hood\r\n• Split hem at back\r\n• Contouring panels to inside arm\r\n• Main: 100% Polyester. Lining: 100% Polyester.\r\n• Model is 6\'4\" and wears a size L. \r\n\r\nThe Vortex Waterproof Jacket is with you through any weather. Fully-lined and fully water repellent, this rain jacket is complete with a sleek aesthetic featuring reverse welt pockets, durable textured fabric and a hidden zip and pop-button opening.', 0, 0, '2018-12-09 13:31:28', '2018-12-09 13:31:28'),
(25, 'ACID WASH PULLOVER BLACK', 'acid-wash-pullover-black', 12, 9, '50.00', '55.00', 42, '{\"XS\":\"20\",\"S\":\"12\",\"XL\":\"10\"}', 'h3-41544362381.jpg', '[\"h3-11544362381.jpg\",\"h3-21544362381.jpg\",\"h3-31544362381.jpg\",\"h3-51544362381.jpg\"]', 'A minimalisitc, everyday essential.', 'Crafted from soft, lightweight cotton and cut to a relaxed fit, its raw edge finish emanates a worn-in, deconstructured edge for versatile, urban wear.\r\n\r\nFocusing on detail, its design features a 3-piece, cross-front hood with adjustable drawcord, stitched eyelet detailing and a kangaroo pocket for your convenience.\r\n\r\nComplete with ribbed cuffs and hem for ultimate comfort.\r\n\r\nMain: 100% Cotton.\r\n\r\nModel is 5\'11\" and wears size M', 0, 0, '2018-12-09 13:33:01', '2018-12-09 13:33:01'),
(26, 'TAKE OVER PULLOVER SLATE LAVENDER MARL', 'take-over-pullover-slate-lavender-marl', 12, 9, '50.00', '55.00', 31, '{\"XS\":\"11\",\"2XL\":\"20\"}', 'h2-41544362494.jpg', '[\"h2-11544362494.jpg\",\"h2-21544362494.jpg\",\"h2-31544362494.jpg\",\"h2-51544362494.jpg\"]', 'Built for the urban champion, fit for the fashion forward.', 'The Take Over Pullover is a contemporary take on an enduring design. Its silhouette adapts to your lifestyle with an urban funnel neck design, fully lined 3-piece hood and reverse-style zip pockets to store your go-to essentials.\r\n\r\nEngineered from a mid-weight cotton blend, it offers a slightly heavier foundation to build outfits around. With a curved, split hem and fused bartack stitch detailing, a sleek aesthetic is guaranteed. Complete with fused matt taping to seams.\r\n\r\nMain: 74% Cotton, 26% Polyester.\r\nLining: 69% Polyester, 31% Cotton.\r\n\r\nModel is 6\'0\" and wears size M', 0, 0, '2018-12-09 13:34:54', '2018-12-09 13:34:54'),
(27, 'GHOST 1/4 ZIP PULLOVER BLACK MARL', 'ghost-14-zip-pullover-black-marl', 12, 2, '40.00', '45.00', 43, '{\"XS\":\"20\",\"L\":\"12\",\"M\":\"11\"}', 'h1-51544362597.jpg', '[\"h1-11544362597.jpg\",\"h1-21544362597.jpg\",\"h1-31544362597.jpg\",\"h1-51544362597.jpg\"]', 'Lightweight, breathable and performance-enhancing.', 'Lightweight, breathable and performance-enhancing. The men’s Ghost 1/4 Zip Pullover is designed with your workout in mind, boasting breathable fabric with sweat-wicking capabilities to keep you ever cool and dry.\r\n\r\nPerforated back panel provides targeted ventilation, whilst DRY moisture management ensures a cool and comfortable workout. Complete with printed Gymshark logo and 1/4 zip funnel neck\r\n\r\n65% Nylon, 35% Polyester.\r\n\r\nModel is 6\'0\" and wears size S', 0, 0, '2018-12-09 13:36:37', '2018-12-09 13:36:37'),
(28, 'ELEMENT+ BASELAYER LONG SLEEVE TOP BLACK MARL', 'element+-baselayer-long-sleeve-top-black-marl', 13, 10, '25.00', '30.00', 40, '{\"XS\":\"10\",\"M\":\"30\"}', 'b10-41544362819.jpg', '[\"b10-31544362819.jpg\",\"b10-21544362819.jpg\",\"b1-11544362819.jpg\"]', 'Primed for performance.', ' Muscle shaping cover stitch seam\r\n• Mesh panels and DRY technology\r\n• Printed Gymshark logo\r\n• Main: 90% Polyester, 10% Elastane. Mesh: 90% Polyester, 10% Elastane.\r\n• Model is 6\'4\" and wears a size L. \r\n\r\nThe Element+ Baselayer Long Sleeve Top is the ultimate in athletic performance. With sweat-wicking fabrics, a compressive fit and a form-enhancing build, you can workout confident of support, function and focus. Element+, assisting your training every rep of the way.', 0, 0, '2018-12-09 13:40:19', '2018-12-09 13:40:19'),
(29, 'ELEMENT+ BASELAYER T-SHIRT SAPPHIRE BLUE MARL', 'element+-baselayer-tshirt-sapphire-blue-marl', 13, 10, '20.00', '25.00', 42, '{\"XS\":\"12\",\"M\":\"10\",\"3XL\":\"20\"}', 'h9-41544362950.jpg', '[\"h9-11544362950.jpg\",\"h9-31544362950.jpg\",\"h921544362950.jpg\",\"h9-51544362950.jpg\"]', 'Primed for performance.', ' Muscle shaping cover stitch seam\r\n• Mesh panels and DRY technology\r\n• Printed Gymshark logo\r\n• Main: 90% Polyester, 10% Elastane. Mesh: 90% Polyester, 10% Elastane.\r\n• Model is 6\'1\" and wears a size M. \r\n\r\nAthletic performance is guaranteed with the Element+ Baselayer Short Sleeve Top. Focus your attention on execution with the sweat-wicking fabric and compressive fit of this gym t-shirt, and maintain your form throughout with its physique-accentuating muscle shape build. Element+, assisting your training every rep of the way.', 0, 0, '2018-12-09 13:42:30', '2018-12-09 13:42:30'),
(30, 'ELEMENT+ BASELAYER T-SHIRT SMOKEY GREY MARL', 'element+-baselayer-tshirt-smokey-grey-marl', 13, 9, '20.00', '25.00', 30, '{\"XS\":\"10\",\"L\":\"20\"}', 'b8-41544363035.jpg', '[\"b8-11544363035.jpg\",\"b8-21544363035.jpg\",\"b8-31544363035.jpg\"]', 'Primed for performance.', '• Muscle shaping cover stitch seam\r\n• Mesh panels and DRY technology\r\n• Printed Gymshark logo\r\n• Main: 90% Polyester, 10% Elastane. Mesh: 90% Polyester, 10% Elastane.\r\n• Model is 6\'1\" and wears a size M. \r\n\r\nAthletic performance is guaranteed with the Element+ Baselayer Short Sleeve Top. Focus your attention on execution with the sweat-wicking fabric and compressive fit of this gym t-shirt, and maintain your form throughout with its physique-accentuating muscle shape build. Element+, assisting your training every rep of the way.', 0, 0, '2018-12-09 13:43:55', '2018-12-09 13:43:55'),
(31, 'ELEMENT+ BASELAYER LEGGINGS BLACK MARL', 'element+-baselayer-leggings-black-marl', 13, 10, '25.00', '30.00', 60, '{\"L\":\"30\",\"XL\":\"20\",\"M\":\"10\"}', 'b7-41544363176.jpg', '[\"b7-11544363176.jpg\",\"b7-21544363176.jpg\",\"b7-31544363176.jpg\"]', 'Primed for performance.', '• Muscle shaping cover stitch seam\r\n• Raised rubber print waistband\r\n• Mesh panels and DRY technology\r\n• Printed Gymshark logo\r\n• Main: 90% Polyester, 10% Elastane. Mesh: 90% Polyester, 10%    Elastane.\r\n• Model is 6\'1\" and wears a size M. \r\n\r\nEvery step of the Element+ Baselayer Leggings’ creation revolved around performance. These compressive base layer leggings have been sculpted for support, function and focus with sweat-wicking technology, breathable fabrics and a stay-put fit. Element+, assisting your training every rep of the way.', 0, 0, '2018-12-09 13:46:16', '2018-12-09 13:46:16'),
(32, 'ELEMENT+ BASELAYER SHORTS SMOKEY GREY MARL', 'element+-baselayer-shorts-smokey-grey-marl', 13, 10, '20.00', '25.00', 20, '{\"XS\":\"20\"}', 'b6-41544363274.jpg', '[\"b6-11544363274.jpg\",\"b6-21544363274.jpg\",\"b6-31544363274.jpg\",\"b6-51544363274.jpg\"]', 'Primed for performance.', ' Muscle shaping cover stitch seam\r\n• Raised rubber print waistband\r\n• Mesh panels and DRY technology\r\n• Printed Gymshark logo\r\n• Main: 90% Polyester, 10% Elastane. Mesh: 90% Polyester, 10% Elastane.\r\n• Model is 6\'0\" and wears a size M. \r\n\r\nSupportive, functional and physique-enhancing, the Element+ Baselayer Shorts have been crafted for pristine performance. Maintain freshness and focus with sweat-wicking fabrics and maintain strength and endurance with supportive compression. Element+, assisting your training every rep of the way.', 0, 0, '2018-12-09 13:47:54', '2018-12-09 13:47:54'),
(33, 'ELEMENT+ BASELAYER LONG SLEEVE TOP SAPPHIRE BLUE MARL', 'element+-baselayer-long-sleeve-top-sapphire-blue-marl', 13, 10, '20.00', '30.00', 25, '{\"XS\":\"12\",\"M\":\"13\"}', 'b5-41544363363.jpg', '[\"b5-11544363363.jpg\",\"b5-21544363363.jpg\",\"b5-31544363363.jpg\"]', 'Primed for performance.', '• Muscle shaping cover stitch seam\r\n• Mesh panels and DRY technology\r\n• Printed Gymshark logo\r\n• Main: 90% Polyester, 10% Elastane. Mesh: 90% Polyester, 10% Elastane.\r\n• Model is 6\'1\" and wears a size M. \r\n\r\nThe Element+ Baselayer Long Sleeve Top is the ultimate in athletic performance. With sweat-wicking fabrics, a compressive fit and a form-enhancing build, you can workout confident of support, function and focus. Element+, assisting your training every rep of the way', 0, 0, '2018-12-09 13:49:23', '2018-12-09 13:49:23'),
(34, 'FRESH T-SHIRT BLACK', 'fresh-tshirt-black', 5, 10, '25.00', '30.00', 60, '{\"M\":\"20\",\"L\":\"20\",\"XL\":\"20\"}', 't10-41544363528.jpg', '[\"t10-21544363528.jpg\",\"t10-31544363528.jpg\",\"t10-11544363528.jpg\"]', 'A pioneer in casual wear.', '- Straight fit\r\n- Side split hem\r\n- Dropped shoulder design\r\n- Discreet embroidered Gymshark logo\r\n- 100% Cotton\r\n- Model is 6\'1\" and wears a size M.\r\n\r\nThe Fresh Short Sleeve T-Shirt is exactly that: current and contemporary. We’ve kept the visual reserved but the design unique to make one of our most distinctive tops to ', 0, 0, '2018-12-09 13:52:08', '2018-12-09 13:52:08'),
(35, 'FRESH T-SHIRT WHITE', 'fresh-tshirt-white', 5, 2, '25.00', '30.00', 70, '{\"XS\":\"30\",\"S\":\"20\",\"M\":\"20\"}', 't9-51544363622.jpg', '[\"t9-31544363622.jpg\",\"t9-21544363622.jpg\",\"t9-11544363622.jpg\",\"t9-51544363622.jpg\"]', 'A pioneer in casual wear.', '- Straight fit\r\n- Side split hem\r\n- Dropped shoulder design\r\n- Discreet embroidered Gymshark logo\r\n- 100% Cotton\r\n- Model is 6\'1\" and wears a size M.', 0, 0, '2018-12-09 13:53:42', '2018-12-09 13:53:42'),
(36, 'FRESH LONG SLEEVE T-SHIRT BLACK', 'fresh-long-sleeve-tshirt-black', 5, 10, '30.00', '35.00', 20, '{\"L\":\"20\"}', 't8-31544363714.jpg', '[\"t8-11544363714.jpg\",\"t8-41544363714.jpg\",\"t8-51544363714.jpg\"]', ' A pioneer in casual wear.', '• Straight fit\r\n• Side split hem\r\n• Dropped shoulder design\r\n• Discreet embroidered Gymshark logo\r\n• 100% Cotton\r\n• Model is 6\'1\" and wears a size M. \r\n\r\nThe Fresh Long Sleeve T-Shirt is a distinctive Gymshark top design. It\'s both current and contemporary with a relaxed, slightly oversized fit and minimalistic design.', 0, 0, '2018-12-09 13:55:14', '2018-12-09 13:55:14'),
(37, 'APOLLO T-SHIRT FULL RED', 'apollo-tshirt-full-red', 5, 10, '15.00', '18.00', 20, '{\"XS\":\"10\",\"L\":\"10\"}', 't7-41544363801.jpg', '[\"t7-11544363801.jpg\",\"t7-21544363801.jpg\",\"t7-31544363801.jpg\",\"t7-51544363801.jpg\"]', 'The Apollo T-Shirt.', 'The Apollo T-Shirt. We made it for the Gymshark Expo World Tour. It was so good we brought it back.\r\n\r\n• Relaxed fit\r\n• Raglan sleeves\r\n• Classic Gymshark chest logo\r\n• 95% Cotton, 5% Elastane\r\n• Model is 6\'4\" and wears a size L. \r\n\r\nWhoever you are, however you train, the Apollo T-Shirt is the ideal workout top for you. With a statement Gymshark design, it works just as well out the gym as it does in it.', 0, 0, '2018-12-09 13:56:41', '2018-12-09 13:56:41'),
(38, 'BREATHE LONG SLEEVE T-SHIRT PALE GREEN', 'breathe-long-sleeve-tshirt-pale-green', 5, 10, '30.00', '35.00', 60, '{\"XS\":\"20\",\"M\":\"30\",\"XL\":\"10\"}', 't6-41544363893.jpg', '[\"t6-11544363893.jpg\",\"t6-21544363893.jpg\",\"t6-31544363893.jpg\",\"t6-51544363893.jpg\"]', 'Lifestyle with a contemporary twist.', 'Lifestyle with a contemporary twist. \r\n\r\n• 3/4 perforated back panel\r\n• Layered split hem\r\n• Fused bartack stitch\r\n• Marl-effect fabric\r\n• Main: 74% Polyester, 17% Viscose, 9% Elastane. Mesh: 55% Nylon, 41% Polyester, 4% Elastane\r\n• Model is 6\'0\" and wears a size M. \r\n\r\nBreak away from standard streetwear and boost your lifestyle wardrobe with the Breathe Long Sleeve T-Shirt, a top boasting stylish versatility and comfort that lasts.', 0, 0, '2018-12-09 13:58:13', '2018-12-09 13:58:13'),
(39, 'BOLD T-SHIRT BLACK', 'bold-tshirt-black', 5, 10, '20.00', '25.00', 30, '{\"XS\":\"30\"}', 't5-31544364011.jpg', '[\"t5-11544364011.jpg\",\"t5-21544364011.jpg\",\"t5-41544364011.jpg\",\"t5-51544364011.jpg\"]', 'The Bold Graphic T-Shirt: the extrovert.', 'The Bold Graphic T-Shirt: the extrovert.\r\n\r\n• Flat fit and crew neck\r\n• Straight hem\r\n• Gym and lifestyle hybrid\r\n• Regular: 95% Cotton, 5% Elastane. \r\n• Model is 6\'1\" and wears a size M. \r\n\r\nAdaptable and versatile, the Bold T-Shirt is a loud graphic on a signature cut. Boasting liberated movement, supple fabrics and a sleek design, be supported in the gym and styled out of it with this top.', 0, 0, '2018-12-09 14:00:11', '2018-12-09 14:00:11'),
(40, 'BOLD T-SHIRT SAPPHIRE BLUE', 'bold-tshirt-sapphire-blue', 5, 10, '20.00', '25.00', 44, '{\"XS\":\"12\",\"S\":\"20\",\"L\":\"12\"}', 't4-31544364106.jpg', '[\"t4-11544364106.jpg\",\"t4-21544364106.jpg\",\"t4-41544364106.jpg\",\"t4-51544364106.jpg\"]', 'The Bold Graphic T-Shirt: the extrovert.', 'The Bold Graphic T-Shirt: the extrovert.\r\n\r\n• Flat fit and crew neck\r\n• Straight hem\r\n• Gym and lifestyle hybrid\r\n• Regular: 95% Cotton, 5% Elastane. \r\n• Model is 6\'1\" and wears a size M. \r\n\r\nAdaptable and versatile, the Bold T-Shirt is a loud graphic on a signature cut. Boasting liberated movement, supple fabrics and a sleek design, be supported in the gym and styled out of it with this top.', 0, 0, '2018-12-09 14:01:46', '2018-12-09 14:01:46'),
(41, 'ARK SLEEVELESS T-SHIRT WARM BEIGE', 'ark-sleeveless-tshirt-warm-beige', 5, 10, '20.00', '22.00', 40, '{\"XS\":\"10\",\"L\":\"10\",\"M\":\"10\",\"3XL\":\"10\"}', 't3-41544364216.jpg', '[\"t3-11544364216.jpg\",\"t3-21544364216.jpg\",\"t3-31544364216.jpg\",\"t3-51544364216.jpg\"]', 'No-nonsense.', '• Loosely tapered fit\r\n• Soft stretch fabrics\r\n• Minimalist design\r\n• 95% Cotton, 5% Elastane\r\n• Model is 6\'4\" and wears a size L.\r\n\r\nThe workhorse of your workout wardrobe. The Ark Sleeveless Gym T-Shirt is understated yet striking. Relaxed, refined and effortless. It boasts a physique-enhancing fit and a free range of movement.', 0, 0, '2018-12-09 14:03:36', '2018-12-09 14:03:36'),
(42, 'ALIGN T-SHIRT BLACK', 'align-tshirt-black', 5, 10, '20.00', '25.00', 44, '{\"XS\":\"44\"}', 't2-51544364309.jpg', '[\"t2-11544364309.jpg\",\"t2-21544364309.jpg\",\"t2-31544364309.jpg\",\"t2-41544364309.jpg\"]', 'The Align Graphic T-Shirt: a Gymshark canvas.', '• Straight fit and crew neck\r\n• Flat hem\r\n• Gym and lifestyle hybrid\r\n• 95% Cotton, 5% Elastane.\r\n• Model is 6\'0\" and wears size M.\r\n\r\nAvailable in four colours, the Align T-shirt is radiating Gymshark with a bold debossed print down the side of the body. The cut was designed with function and form in mind with supple fabrics and a stylish straight fit, making it ideal for a gym workout or a rest day.', 0, 0, '2018-12-09 14:05:09', '2018-12-09 14:05:09'),
(43, 'DEFINE SEAMLESS T-SHIRT SMOKEY GREY MARL', 'define-seamless-tshirt-smokey-grey-marl', 5, 10, '25.00', '30.00', 42, '{\"XS\":\"12\",\"L\":\"20\",\"S\":\"10\"}', 't1-41544364410.jpg', '[\"t1-11544364410.jpg\",\"t1-21544364410.jpg\",\"t1-31544364410.jpg\",\"t1-51544364410.jpg\"]', 'A seamless performance.', 'Supple fabrics supporting your movement\r\n• Physique-enhancing seamless pattern\r\n• Weightless fit\r\n• DRY technology\r\n• 67% Nylon, 33% Polyester.\r\n\r\nThe Define Seamless workout T-Shirt brings our classic seamless technology to the guys, providing all the support and allowing all the movement you need in the gym.\r\n\r\nModel is 6\'0\" and wears a size M. ', 0, 0, '2018-12-09 14:06:50', '2018-12-09 14:06:50'),
(44, 'ISLA KNIT SWEATER', 'isla-knit-sweater', 14, 10, '45.00', '50.00', 60, '{\"XS\":\"10\",\"L\":\"20\",\"2XL\":\"30\"}', 'h5-31544366475.jpg', '[\"h5-11544366475.jpg\",\"h5-21544366475.jpg\",\"h5-41544366475.jpg\",\"h5-51544366475.jpg\"]', 'Commute in comfort.', '• Soft merino wool fabric\r\n• High neckline\r\n• Split hem at bottom of back\r\n• 100% Wool\r\n• Model is 5\'7\" and wears a size XS. \r\n\r\nIsla Knit is every bit as soft as it looks; experience a new world of comfort. The Isla Knit Sweater is constructed from merino wool to make one of our softest, snuggest ', 0, 0, '2018-12-09 14:41:15', '2018-12-09 14:41:15'),
(45, 'ISLA KNIT SLEEVELESS HOODIE', 'isla-knit-sleeveless-hoodie', 14, 10, '40.00', '50.00', 62, '{\"XS\":\"20\",\"XL\":\"12\",\"S\":\"30\"}', 'h4-41544366549.jpg', '[\"h4-11544366549.jpg\",\"h4-21544366549.jpg\",\"h4-31544366549.jpg\",\"h4-51544366549.jpg\"]', 'Commute in comfort.', 'Soft merino wool fabric\r\n• Drop armhole design\r\n• Cropped fit\r\n• Bungee drawcord to hood\r\n• 100% Wool\r\n• Model is 5\'7\" and wears a size XS.\r\n\r\nExperience a new world of comfort; Isla Knit is every bit as soft as it looks. With a merino wool base and contemporary drop arm silhouette, the Isla Knit Sleeveless Hoodie hybrids ultimate comfort and sleek style', 0, 0, '2018-12-09 14:42:29', '2018-12-09 14:42:29'),
(46, 'ISLA KNIT OPEN CARDIGAN BLACK', 'isla-knit-open-cardigan-black', 14, 10, '30.00', '40.00', 30, '{\"XS\":\"10\",\"M\":\"20\"}', 'h3-41544366667.jpg', '[\"h3-11544366667.jpg\",\"h3-21544366667.jpg\",\"h3-31544366667.jpg\",\"h3-51544366667.jpg\"]', 'Commute in comfort.', '\r\n• Soft merino wool fabric\r\n• Large patch pockets\r\n• Long sleeve\r\n• No-fasten, open design\r\n• Cuffed at wrists\r\n• 100% Wool\r\n• Model is 5\'7\" and wears a size S. \r\n\r\nIt\'s every bit as soft as it looks. The Isla Knit Open Cardigan is that final layer and finishing touch to any outfit. Made from luxurious merino wool fabric, it’s a new world of comfort', 0, 0, '2018-12-09 14:44:27', '2018-12-09 14:44:27'),
(47, 'SLOUNGE CROPPED HOODIE LIGHT GREY MARL', 'slounge-cropped-hoodie-light-grey-marl', 14, 10, '40.00', '42.00', 20, '{\"XS\":\"20\"}', 'h2-41544366752.jpg', '[\"h2-11544366752.jpg\",\"h2-21544366752.jpg\",\"h2-31544366752.jpg\",\"h2-41544366752.jpg\"]', 'The perfect rest day.', ' Our softest fabric blend yet\r\n• Flattering midriff crop\r\n• Ribbed marl design\r\n• Oversized three-piece hood\r\n• 60% Polyester, 38% Viscose, 2% Elastane\r\n• Model is 5\'6\" and wears a size XS. \r\n\r\nThe Slounge Cropped Hoodie’s slim fit enhances your figure and follows your shape closely to ensure freedom of movement. Soft and supple fabrics promise a customisable feel for consistent comfort.', 0, 0, '2018-12-09 14:45:52', '2018-12-09 14:45:52'),
(48, 'SOLACE SWEATER 2.0 BLACK', 'solace-sweater-20-black', 14, 10, '40.00', '45.00', 30, '{\"XS\":\"10\",\"M\":\"20\"}', 'h1-41544366850.jpg', '[\"h1-11544366850.jpg\",\"h1-21544366850.jpg\",\"h1-31544366850.jpg\",\"h1-51544366850.jpg\"]', 'Solace, softer.', '• Regular, straight fit \r\n• Crew neckline \r\n• Cuffed at wrists \r\n• Main: 46% Viscose, 42% Polyester, 12% Elastane. Rib: 95% Viscose, 5% Elastane. \r\n• Model is 5\'7\" and wears a size S. \r\n\r\nSofter, comfier and better than before, we’ve taken relaxation down a gear with the Solace Sweater 2.0. Boasting luxuriously soft fabrics and a roomy, covering fit, it’s been refined to make your experience exceptional.', 0, 0, '2018-12-09 14:47:30', '2018-12-09 14:47:30'),
(49, 'HEATHER DUAL BAND SHORTS LIGHT GREY MARL', 'heather-dual-band-shorts-light-grey-marl', 10, 10, '30.00', '35.00', 52, '{\"XS\":\"12\",\"M\":\"20\",\"L\":\"20\"}', 's5-41544367042.jpg', '[\"s5-11544367042.jpg\",\"s5-21544367042.jpg\",\"s5-31544367042.jpg\",\"s5-51544367042.jpg\"]', 'Designed as part of our lifestyle collection, the Heather Dual Band Shorts boast a classic, relaxed fit with split hem design for ultimate comfort.', 'Designed as part of our lifestyle collection, the Heather Dual Band Shorts boast a classic, relaxed fit with split hem design for ultimate comfort. Concealed pockets offer an easy, safe way to store essentials on the move, whilst a dual waistband provides customisable support to help you find the perfect fit.\r\n\r\nFocusing on detail, the Heather Dual Band Shorts are crafted from ultra-soft French Terry fabric for consistent comfort that lasts all day.\r\n\r\nFinished with woven tag logo.\r\n\r\nMain: 78% Cotton, 22% Polyester\r\n\r\nPocket Bag: 69% Polyester, 31% Cotton\r\n\r\nModel is 5\'7\" and wears a size S. ', 0, 0, '2018-12-09 14:50:42', '2018-12-09 14:50:42'),
(50, 'FIT SHORTS CHARCOAL/DUSKY PINK', 'fit-shorts-charcoaldusky-pink', 11, 10, '20.00', '26.00', 66, '{\"XS\":\"11\",\"S\":\"55\"}', 's4-41544367142.jpg', '[\"s4-11544367142.jpg\",\"s4-21544367142.jpg\",\"s4-31544367142.jpg\",\"s4-51544367142.jpg\"]', 'Your favourite Fit Leggings made in to your new favourite shorts.', 'Your favourite Fit Leggings made in to your new favourite shorts. Designed with the same soft blend material, to provide that stretchy, supple fit.\r\n\r\n• Elasticated printed waistband\r\n• 4-way stretch fit\r\n \r\n80% Nylon, 20% Elastane\r\n \r\nModel is 5’7” and wears a size S.', 0, 0, '2018-12-09 14:52:22', '2018-12-09 14:52:22'),
(51, 'PASTEL CYCLING SHORTS ICE BLUE', 'pastel-cycling-shorts-ice-blue', 10, 10, '25.00', '30.00', 42, '{\"XS\":\"10\",\"S\":\"12\",\"M\":\"20\"}', 's3-41544367241.jpg', '[\"s3-11544367241.jpg\",\"s3-21544367241.jpg\",\"s3-31544367241.jpg\",\"s3-51544367241.jpg\"]', 'Sometimes simple’s best.', '• High waisted fit \r\n• One-tone pastel shade \r\n• Logo to front and back of waistband \r\n• 87% Nylon, 13% Elastane \r\n• Model is 5\'6\" and wears a size XS. \r\n\r\nSimplicity doesn’t mean forgoing function or style with the Pastel Cycling Shorts. Workout-ready, these gym shorts promote an elegant look as well as training support.', 0, 0, '2018-12-09 14:54:01', '2018-12-09 14:54:01'),
(52, 'ELEVATE CYCLING SHORTS BLACK', 'elevate-cycling-shorts-black', 10, 10, '30.00', '36.00', 40, '{\"XS\":\"20\",\"S\":\"10\",\"XL\":\"10\"}', 's2-41544367340.jpg', '[\"s2-11544367340.jpg\",\"s2-21544367340.jpg\",\"s2-31544367340.jpg\",\"s2-51544367340.jpg\"]', 'Elevate your performance.', 'Crafted from soft-stretch, supple fabric blends, the Elevate Cycling Shorts provide a body-hugging fit that offers ease of movement when your workout intensifies. Optimising breathability, mesh panel detailing to the leg prevents distraction and allows for an effortless ride.\r\n\r\nThe back waist panel is finished with double branded, elasticated jacquard detailing which stays in place whilst you cycle. Complete with side pockets.\r\n\r\nMain: 76% Nylon, 24% Elastane. Mesh: 92% Nylon, 8% Elastane.\r\n\r\nModel is 5\'7\" and wears size S', 0, 0, '2018-12-09 14:55:40', '2018-12-09 14:55:40'),
(53, 'RUNNING SHORTS KHAKI', 'running-shorts-khaki', 10, 10, '30.00', '34.00', 50, '{\"S\":\"50\"}', 's1-41544367426.jpg', '[\"s1-11544367426.jpg\",\"s1-21544367426.jpg\",\"s1-31544367426.jpg\"]', 'Stay cool and collected, no matter how intense the run.', 'Stay cool and collected, no matter how intense the run. Designed with a relaxed, lightweight material, the Running Shorts provide superior comfort and optimum ventilation to ensure a distraction free workout.\r\n\r\nBoasting a detailed elasticated waistband, the Women’s Running Shorts are designed to keep up with you.\r\n\r\nComplete with a concealed pocket to store all of your essentials and reflective Gymshark logo.\r\n\r\nMain: 88% Polyester, 12% Elastane.\r\n\r\nMesh: 89% Polyester, 11% Elastane.\r\n\r\nModel 5\'8\" and wears a S', 0, 0, '2018-12-09 14:57:06', '2018-12-09 14:57:06'),
(54, 'FLAWLESS KNIT LONG SLEEVE CROP TOP BLACK', 'flawless-knit-long-sleeve-crop-top-black', 15, 10, '40.00', '45.00', 32, '{\"XS\":\"10\",\"M\":\"12\",\"XL\":\"10\"}', 't5-41544367615.jpg', '[\"t5-11544367615.jpg\",\"t5-21544367615.jpg\",\"t5-31544367615.jpg\",\"t5-51544367615.jpg\"]', 'Settle for nothing less than Flawless.', '• Fitted design with midriff crop\r\n• Eyelet and rib patterns\r\n• Crew neckline\r\n• Ventilation detailing\r\n• Thumbholes\r\n• 95% Nylon, 5% Elastane\r\n• Model is 5\'7\" and wears a size S. \r\n\r\nExperience the Flawless performance. The features of the Flawless Knit Long Sleeve Crop Top have been designed to deliver workout support and a stunning aesthetic alike; this gym top boasts flattering contours, enhanced breathability ', 0, 0, '2018-12-09 15:00:15', '2018-12-09 15:00:15'),
(55, 'FLEUR TEXTURE VEST WASHED KHAKI MARL', 'fleur-texture-vest-washed-khaki-marl', 15, 10, '20.00', '30.00', 35, '{\"XS\":\"35\"}', 't4-41544367695.jpg', '[\"t4-31544367695.jpg\",\"t4-21544367695.jpg\",\"t4-11544367695.jpg\"]', 'Get tough with training.', '• Thick, jacquard fabric\r\n• Double layered back feature\r\n• Keyhole cut out to back\r\n• Front seam\r\n• 46% Polyester, 43% Nylon, 11% Elastane\r\n• Model is 5\'7\" and wears a size S.\r\n\r\nBuilt with jacquard for when training gets hard. The Fleur Texture Vest is constructed from thick yet supple fabrics to move with your through your workout; but with a contemporary cut out design to the back, it’s a gym style ', 0, 0, '2018-12-09 15:01:35', '2018-12-09 15:01:35'),
(56, 'ASYMMETRIC VEST SMOKEY GREY/BLACK', 'asymmetric-vest-smokey-greyblack', 15, 10, '25.00', '30.00', 30, '{\"XS\":\"10\",\"S\":\"10\",\"L\":\"10\"}', 't3-31544367786.jpg', '[\"t3-41544367786.jpg\",\"t3-21544367786.jpg\",\"t3-11544367786.jpg\"]', 'Abstract art meets performance technology.', '• Relaxed fit\r\n• Asymmetric colour panels\r\n• Cross over panels\r\n• Wrap front details\r\n• 85% Nylon, 15% Elastane\r\n• Model is 5\'7\" and wears a size S.\r\n\r\nDesigned to stand out, assembled to workout, the Asymmetric Vest provides a loose fit to allow you to exercise free of restriction but full of coverage. In unique, bold colourways, get ahead of the rest in style', 0, 0, '2018-12-09 15:03:06', '2018-12-09 15:03:06'),
(57, 'SOLACE JUMPSUIT CHARCOAL MARL', 'solace-jumpsuit-charcoal-marl', 15, 10, '40.00', '50.00', 30, '{\"XS\":\"10\",\"M\":\"20\"}', 't2-41544367876.jpg', '[\"t2-21544367876.jpg\",\"t2-11544367876.jpg\",\"t2-31544367876.jpg\"]', 'Solace, softer.', '• High neck design with non-functional drawcords \r\n• Functional drawcords to waist \r\n• Keyhole cut out to back with button fastening \r\n• Bulk seams and elastication \r\n• Main: 46% Viscose, 42% Polyester, 12% Elastane. Rib: 95% Viscose, 5% Elastane. \r\n• Model is 5\'7\" and size XS.\r\n\r\nAll-in-one, all for rest day. Experience comfort like no other in the Solace Jumpsuit boasting a luxuriously soft fabric blend and flattering close fit: shaped for you', 0, 0, '2018-12-09 15:04:36', '2018-12-09 15:04:36'),
(58, 'FLORAL GRAPHIC TANK WHITE', 'floral-graphic-tank-white', 15, 10, '20.00', '25.00', 48, '{\"XS\":18,\"M\":\"10\",\"L\":\"20\"}', 't1-41544367968.jpg', '[\"t1-31544367968.jpg\",\"t1-21544367968.jpg\",\"t1-11544367968.jpg\"]', 'Subtly Gymshark.', 'Subtly Gymshark. The Graphic Floral Tank disguises our famous Gymshark logo within an elegant floral print.\r\n\r\n• Midriff crop and curved side split\r\n\r\n• Crew neck and drop armhole\r\n\r\n• Lightweight, unrestrictive fit\r\n\r\n65% Polyester, 35% Viscose.\r\n\r\nModel is 5\'5\" and wears size XS', 0, 0, '2018-12-09 15:06:08', '2018-12-09 15:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

DROP TABLE IF EXISTS `promotion`;
CREATE TABLE IF NOT EXISTS `promotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id`, `name`, `description`, `image`, `date_from`, `date_to`, `status`, `created_at`) VALUES
(1, 'First promotion', '<p>description</p>\r\n', 'apple15390030891543987262.jpg', '2018-12-05', '2018-12-08', 1, '2018-12-05 05:21:02'),
(2, 'Black friday', '<p>hi</p>\r\n', 'apple15302017531544104524.jpg', '2018-12-06', '2018-12-09', 0, '2018-12-06 13:55:24'),
(3, 'Promotion for new year', '', '', '2018-12-10', '2018-12-29', 0, '2018-12-08 13:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_detail`
--

DROP TABLE IF EXISTS `promotion_detail`;
CREATE TABLE IF NOT EXISTS `promotion_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promotion_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `promotion_id` (`promotion_id`),
  KEY `pro_id` (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promotion_detail`
--

INSERT INTO `promotion_detail` (`id`, `promotion_id`, `pro_id`, `price`, `status`, `created_at`) VALUES
(2, 1, 2, '17.20', 0, '2018-12-05 05:21:57'),
(3, 1, 3, '14.40', 0, '2018-12-05 05:21:57'),
(4, 2, 1, '16.00', 0, '2018-12-06 13:56:30'),
(6, 2, 6, '10.68', 0, '2018-12-06 13:56:30'),
(7, 2, 3, '15.00', 0, '2018-12-08 03:03:36'),
(8, 2, 2, '18.00', 0, '2018-12-08 13:09:43'),
(9, 3, 1, '15.00', 0, '2018-12-10 07:07:24'),
(10, 3, 6, '11.00', 0, '2018-12-10 07:07:25'),
(11, 3, 7, '15.50', 0, '2018-12-10 07:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `ship`
--

DROP TABLE IF EXISTS `ship`;
CREATE TABLE IF NOT EXISTS `ship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`order_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ship`
--

INSERT INTO `ship` (`id`, `user_id`, `order_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 13, 1, '2018-12-05 05:51:28', '2018-12-05 05:51:28'),
(2, 2, 16, 1, '2018-12-05 13:44:14', '2018-12-05 13:44:14'),
(3, 2, 22, 0, '2018-12-08 13:13:43', '2018-12-08 13:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'New', '2018-12-05 05:33:06', '2018-12-05 05:33:06'),
(2, 'Confirm', '2018-12-05 05:33:06', '2018-12-05 05:33:06'),
(3, 'Delivering', '2018-12-05 05:33:23', '2018-12-05 05:33:23'),
(4, 'Completed', '2018-12-05 05:33:23', '2018-12-05 05:33:23'),
(5, 'Cancel', '2018-12-05 05:33:31', '2018-12-05 05:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `stock_receipt`
--

DROP TABLE IF EXISTS `stock_receipt`;
CREATE TABLE IF NOT EXISTS `stock_receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock_receipt`
--

INSERT INTO `stock_receipt` (`id`, `user_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>First Stock</p>\r\n', 1, '2018-12-05 04:10:35', '2018-12-05 04:10:35'),
(2, 1, '<p>Sencond Stock</p>\r\n', 1, '2018-12-05 04:11:03', '2018-12-05 04:11:03'),
(3, 1, '<p>stock thirst</p>\r\n', 1, '2018-12-05 04:31:52', '2018-12-05 04:31:52'),
(4, 3, '<p>hi</p>\r\n', 1, '2018-12-06 13:42:51', '2018-12-06 13:42:51'),
(5, 1, '<p>VIP stock</p>\r\n', 1, '2018-12-08 12:54:52', '2018-12-08 12:54:52'),
(6, 1, '', 0, '2018-12-08 13:55:11', '2018-12-08 13:55:11'),
(7, 1, '<p>enter</p>\r\n\r\n<p>&nbsp;</p>\r\n', 1, '2018-12-09 12:46:26', '2018-12-09 12:46:26'),
(8, 1, '<p>Mens Hoodie &amp; jacket</p>\r\n', 1, '2018-12-09 13:18:54', '2018-12-09 13:18:54'),
(9, 1, '<p>base layers</p>\r\n', 1, '2018-12-09 13:38:34', '2018-12-09 13:38:34'),
(10, 1, '<p>mens t shirt</p>\r\n\r\n<p>&nbsp;</p>\r\n', 1, '2018-12-09 13:50:11', '2018-12-09 13:50:11'),
(11, 1, '<p>hoodie &amp; jacket womens</p>\r\n', 1, '2018-12-09 14:38:22', '2018-12-09 14:38:22'),
(12, 1, '<p>women&nbsp;shorts</p>\r\n', 1, '2018-12-09 14:48:12', '2018-12-09 14:48:12'),
(13, 1, '<p>update_product</p>\r\n', 1, '2018-12-10 05:41:53', '2018-12-10 05:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `phone`, `status`, `created_at`) VALUES
(1, 'Adidas', 'Q1', '01653247', 0, '2018-12-05 03:43:26'),
(2, 'Gyms', 'Q2', '0123647', 0, '2018-12-05 03:44:29'),
(6, 'Adidass', 'Q1', '1234567890', 1, '2018-12-05 04:01:13'),
(7, 'Adidasss', 'Q1', '1234567890', 1, '2018-12-05 04:01:44'),
(9, 'Adidass', 'Q1', '1234567890', 0, '2018-12-05 04:07:55'),
(10, 'Adida', 'Q1', '1234567890', 0, '2018-12-05 04:08:10'),
(11, 'Pumaa', 'FA', '01654787458', 1, '2018-12-06 13:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permission_id` int(11) NOT NULL,
  `phone_number` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `image`, `permission_id`, `phone_number`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Harrik', 'Uchi', 'ha@gmail.com', '$2y$10$tOwvTp1kXhd30yD17LxEXeWiPixxKj4qzRcleo7VOljDrJPWyR.Ja', '27848131_167563094021853_1262747358_n1543985589.jpg', 1, '0168886853', 'Q2', 0, '2018-12-05 02:57:06', '2018-12-05 02:57:06'),
(2, 'Ken', 'Delivery', 'ken@gmail.com', '$2y$10$ffJTnfRQ/mHhHaJyQ.f0yufmQkfP2SyrLGFu/oJ/T4ZzGdT5YHkn.', '', 6, '123', '', 0, '2018-12-05 04:50:37', '2018-12-05 04:50:37'),
(3, 'Haley', 'Data', 'data@gmail.com', '$2y$10$l.JMGqIZFG61DQohXhjQTe.M.TRlEX1AoigUte6U.cXpOPOEp5EKW', 'user1543985540.jpg', 2, '1234567890', 'Q2', 0, '2018-12-05 04:52:20', '2018-12-05 04:52:20'),
(4, 'Harry', 'Potter', 'harry@gmail.com', '$2y$10$ChX.0yx3PslX2k50N3C4Jepnovja/2d1cpRs0i9dn6drw/G.3Swf.', '', 4, '1234567890', 'Q1', 0, '2018-12-05 05:27:35', '2018-12-05 05:27:35'),
(5, 'Henry', 'Jack', 'acc01@gmail.com', '$2y$10$5zb3YTTiJEfUURK8F.0n9OLFoD2kIpY/7n52RN0k/JGrH5ow4zALG', 'apple15432369911544241000.jpg', 4, '01688868553', 'Q2', 0, '2018-12-08 03:50:00', '2018-12-08 03:50:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `detail_stock`
--
ALTER TABLE `detail_stock`
  ADD CONSTRAINT `detail_stock_ibfk_1` FOREIGN KEY (`stock_id`) REFERENCES `stock_receipt` (`id`),
  ADD CONSTRAINT `detail_stock_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `group_permission`
--
ALTER TABLE `group_permission`
  ADD CONSTRAINT `group_permission_ibfk_1` FOREIGN KEY (`per_id`) REFERENCES `permission` (`id`);

--
-- Constraints for table `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `like_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cate_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`sup_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `promotion_detail`
--
ALTER TABLE `promotion_detail`
  ADD CONSTRAINT `promotion_detail_ibfk_1` FOREIGN KEY (`promotion_id`) REFERENCES `promotion` (`id`),
  ADD CONSTRAINT `promotion_detail_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `ship`
--
ALTER TABLE `ship`
  ADD CONSTRAINT `ship_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `ship_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
