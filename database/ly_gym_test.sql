-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 05, 2018 at 10:29 AM
-- Server version: 5.7.23
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ly_gym_test`
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `alias`, `parent_id`, `description`, `status`, `created_at`) VALUES
(4, 'Mens', 'mens', 0, '<p>Menly &amp; Strongs</p>\r\n', 0, '2018-12-05 03:05:56'),
(5, 'Shirts', 'shirts', 4, '<p>ok</p>\r\n', 0, '2018-12-05 03:06:45'),
(6, 'Womens', 'womens', 0, '<p>Pretty</p>\r\n', 0, '2018-12-05 03:07:07'),
(7, 'Pants', 'pants', 6, '<p>ok</p>\r\n', 0, '2018-12-05 03:07:24'),
(8, 'Shoes', 'shoes', 4, '<p>shoes</p>\r\n', 0, '2018-12-05 03:07:37'),
(9, 'Equipment', 'equipment', 0, '<p>equipment</p>\r\n', 0, '2018-12-05 03:07:55');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `pro_id`, `user_id`, `comment`, `parent`, `like`, `created_at`) VALUES
(3, 4, 4, 'nice', 0, 0, '2018-12-05 05:55:52'),
(4, 4, 4, 'tks', 3, 0, '2018-12-05 05:55:57');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(9, 3, 3, 20, '12.00', '{\"XS\":\"20\"}', 1, '2018-12-05 04:39:37', '2018-12-05 04:39:37');

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
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '2018-12-05 03:00:43', '2018-12-05 03:00:43'),
(2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-12-05 08:29:02', '2018-12-05 08:29:02'),
(3, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-12-05 08:30:19', '2018-12-05 08:30:19'),
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`id`, `comment_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 3, 4, '2018-12-05 05:55:58', '2018-12-05 05:55:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `area`, `delivery_place`, `delivery_cost`, `payment`, `status`, `created_at`) VALUES
(11, 4, 'hcm', 'Q1', '2.00', 0, 5, '2018-12-05 05:47:30'),
(12, 4, 'hcm', 'Q1', '2.00', 1, 4, '2018-12-05 05:48:27'),
(13, 4, 'hcm', 'Q1', '2.00', 0, 4, '2018-12-05 05:51:00'),
(14, 4, 'hcm', 'Q1', '2.00', 0, 5, '2018-12-05 05:52:20'),
(15, 4, 'other', 'Q1', '4.00', 1, 4, '2018-12-05 05:53:12');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `pro_id`, `price`, `size`, `quantity`, `created_at`) VALUES
(1, 11, 4, '22.00', 'none', 1, '2018-12-05 05:47:30'),
(2, 12, 1, '17.00', 'XS', 2, '2018-12-05 05:48:27'),
(3, 12, 2, '17.20', 'XS', 3, '2018-12-05 05:48:27'),
(4, 13, 4, '22.00', 'none', 2, '2018-12-05 05:51:00'),
(5, 13, 5, '30.00', 'XS', 2, '2018-12-05 05:51:00'),
(6, 14, 4, '22.00', 'none', 1, '2018-12-05 05:52:20'),
(7, 15, 4, '22.00', 'none', 3, '2018-12-05 05:53:12'),
(8, 15, 5, '30.00', 'XS', 3, '2018-12-05 05:53:12');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `alias`, `cate_id`, `sup_id`, `price_in`, `price`, `quantity`, `size`, `image`, `sub_image`, `intro`, `description`, `view`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Product 1', 'product-1', 5, 9, '10.00', '17.00', 30, '{\"XS\":19,\"L\":\"11\"}', 'short_515313016611543983218.jpg', '[\"short_515313016611543983218.1\",\"short_515313016611543983218.2\"]', 'nice & soft', 'nice & soft', 2, 0, '2018-12-05 04:13:38', '2018-12-05 04:13:38'),
(2, 'Product 2', 'product-2', 5, 10, '17.00', '20.00', 24, '{\"XS\":3,\"S\":\"11\"}', 'short_315313008931543983380.jpg', '[\"h9-115325806121543983380.jpg\"]', 'nice & soft', 'nice & soft', 3, 0, '2018-12-05 04:16:20', '2018-12-05 04:16:20'),
(3, 'Product 3', 'product-3', 7, 9, '12.00', '16.00', 40, '{\"XS\":30}', 'h10-415325805331543983531.jpg', '[\"h10-115325805331543983531.jpg\"]', 'nice & soft', 'nice & soft', 0, 0, '2018-12-05 04:18:51', '2018-12-05 04:18:51'),
(4, 'first', 'first', 5, 10, '10.00', '22.00', 26, 'null', 'h9-115325806121543983852.jpg', '[\"h6-115325808881543983889.jpg\"]', 'nice & confortable', 'nice & confortable', 10, 0, '2018-12-05 04:24:12', '2018-12-05 04:24:12'),
(5, 'Product 5', 'product-5', 8, 10, '16.00', '30.00', 26, '{\"XS\":6,\"S\":\"20\"}', 'h10-1153258053315439835311543984206.jpg', '[\"h9-215325806121543985843.jpg\"]', 'nice', 'nice', 2, 0, '2018-12-05 04:30:06', '2018-12-05 04:30:06');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id`, `name`, `description`, `image`, `date_from`, `date_to`, `status`, `created_at`) VALUES
(1, 'First promotion', '<p>description</p>\r\n', 'apple15390030891543987262.jpg', '2018-12-05', '2018-12-07', 0, '2018-12-05 05:21:02');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promotion_detail`
--

INSERT INTO `promotion_detail` (`id`, `promotion_id`, `pro_id`, `price`, `status`, `created_at`) VALUES
(2, 1, 2, '17.20', 0, '2018-12-05 05:21:57'),
(3, 1, 3, '14.40', 0, '2018-12-05 05:21:57');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ship`
--

INSERT INTO `ship` (`id`, `user_id`, `order_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 13, 1, '2018-12-05 05:51:28', '2018-12-05 05:51:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock_receipt`
--

INSERT INTO `stock_receipt` (`id`, `user_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>First Stock</p>\r\n', 1, '2018-12-05 04:10:35', '2018-12-05 04:10:35'),
(2, 1, '<p>Sencond Stock</p>\r\n', 1, '2018-12-05 04:11:03', '2018-12-05 04:11:03'),
(3, 1, '<p>stock thirst</p>\r\n', 1, '2018-12-05 04:31:52', '2018-12-05 04:31:52');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `phone`, `status`, `created_at`) VALUES
(1, 'Adidas', 'Q1', '01653247', 0, '2018-12-05 03:43:26'),
(2, 'Gyms', 'Q2', '0123647', 0, '2018-12-05 03:44:29'),
(6, 'Adidass', 'Q1', '1234567890', 1, '2018-12-05 04:01:13'),
(7, 'Adidasss', 'Q1', '1234567890', 1, '2018-12-05 04:01:44'),
(9, 'Adidass', 'Q1', '1234567890', 0, '2018-12-05 04:07:55'),
(10, 'Adida', 'Q1', '1234567890', 0, '2018-12-05 04:08:10');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `image`, `permission_id`, `phone_number`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Harrik', 'Uchi', 'ha@gmail.com', '$2y$10$tOwvTp1kXhd30yD17LxEXeWiPixxKj4qzRcleo7VOljDrJPWyR.Ja', '27848131_167563094021853_1262747358_n1543985589.jpg', 1, '0168886853', 'Q2', 0, '2018-12-05 02:57:06', '2018-12-05 02:57:06'),
(2, 'Ken', 'Delivery', 'ken@gmail.com', '$2y$10$ffJTnfRQ/mHhHaJyQ.f0yufmQkfP2SyrLGFu/oJ/T4ZzGdT5YHkn.', '', 6, '123', '', 0, '2018-12-05 04:50:37', '2018-12-05 04:50:37'),
(3, 'Haley', 'Data', 'data@gmail.com', '$2y$10$l.JMGqIZFG61DQohXhjQTe.M.TRlEX1AoigUte6U.cXpOPOEp5EKW', 'user1543985540.jpg', 2, '1234567890', 'Q2', 0, '2018-12-05 04:52:20', '2018-12-05 04:52:20'),
(4, 'Harry', 'Potter', 'harry@gmail.com', '$2y$10$ChX.0yx3PslX2k50N3C4Jepnovja/2d1cpRs0i9dn6drw/G.3Swf.', '', 4, '1234567890', 'Q1', 0, '2018-12-05 05:27:35', '2018-12-05 05:27:35');

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
