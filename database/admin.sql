-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2024 at 06:56 PM
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
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `short_des` text DEFAULT NULL,
  `long_des` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `banner` text DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `banner_alt` text DEFAULT NULL,
  `alt` text DEFAULT NULL,
  `featured1` int(11) DEFAULT NULL,
  `featured2` int(11) DEFAULT 0,
  `featured3` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `image`, `meta_title`, `meta_description`, `category_id`, `meta_keywords`, `short_des`, `long_des`, `created_at`, `updated_at`, `banner`, `sort`, `banner_alt`, `alt`, `featured1`, `featured2`, `featured3`) VALUES
(6, 'Test 1', 'test-1', 'blog_65a57bb2d4a72.jpg', 'Meta Title', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 8, '1as,asd,asdasda,a,sda', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly.', '<p><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</span></p><p><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</span></p><p><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available</span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available</span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available</span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available</span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\"><br></span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\"><br></span><br></p>', '2024-01-13 09:39:27', '2024-01-19 17:24:14', 'blog_banner_65aaf68695f3b.jpg', 5, 'test', '11', 1, 0, 0),
(7, 'Title', 'title', 'blog_65a57df2b329a.jpg', 'Meta Title', 'Meta Description', 4, 'Meta Description,12', '<p><span style=\"color: rgb(121, 121, 121);\">Short Description</span><br></p>', '<p><span style=\"color: rgb(121, 121, 121);\">Long Description</span><br></p>', '2024-01-15 13:48:18', '2024-01-15 13:48:18', 'blog_banner_65a57df2bddf0.jpg', 1, 'Banner Alt', 'Image Alt', 0, 1, 1),
(8, 'Title', 'title-2', 'blog_65a57df2b329a.jpg', 'Meta Title', 'Meta Description', 4, 'Meta Description,12', '<p><span style=\"color: rgb(121, 121, 121);\">Short Description</span><br></p>', '<p><span style=\"color: rgb(121, 121, 121);\">Long Description</span><br></p>', '2024-01-15 13:48:18', '2024-01-15 13:48:18', 'blog_banner_65a57df2bddf0.jpg', 1, 'Banner Alt', 'Image Alt', 1, 0, 0),
(9, 'Title', 'title-3', 'blog_65a57df2b329a.jpg', 'Meta Title', 'Meta Description', 4, 'Meta Description,12', '<p><span style=\"color: rgb(121, 121, 121);\">Short Description</span><br></p>', '<p><span style=\"color: rgb(121, 121, 121);\">Long Description</span><br></p>', '2024-01-15 13:48:18', '2024-01-15 13:48:18', 'blog_banner_65a57df2bddf0.jpg', 1, 'Banner Alt', 'Image Alt', 0, 1, 0),
(10, 'Title 4', 'title-4', 'blog_65a57df2b329a.jpg', 'Meta Title', 'Meta Description', 4, 'Meta Description,12', '<p><span style=\"color: rgb(121, 121, 121);\">Short Description</span><br></p>', '<p><span style=\"color: rgb(121, 121, 121);\">Long Description</span><br></p>', '2024-01-15 13:48:18', '2024-01-15 13:48:18', 'blog_banner_65a57df2bddf0.jpg', 1, 'Banner Alt', 'Image Alt', 1, 0, 0),
(11, 'Title 5', 'title-5', 'blog_65a57df2b329a.jpg', 'Meta Title', 'Meta Description', 4, 'Meta Description,12', '<p><span style=\"color: rgb(121, 121, 121);\">Short Description</span><br></p>', '<p><span style=\"color: rgb(121, 121, 121);\">Long Description</span><br></p>', '2024-01-15 13:48:18', '2024-01-15 13:48:18', 'blog_banner_65a57df2bddf0.jpg', 1, 'Banner Alt', 'Image Alt', NULL, 0, 1),
(12, 'Title 6', 'title-6', 'blog_65a57df2b329a.jpg', 'Meta Title', 'Meta Description', 4, 'Meta Description,12', '<p><span style=\"color: rgb(121, 121, 121);\">Short Description</span><br></p>', '<p><span style=\"color: rgb(121, 121, 121);\">Long Description</span><br></p>', '2024-01-15 13:48:18', '2024-01-15 13:48:18', 'blog_banner_65a57df2bddf0.jpg', 1, 'Banner Alt', 'Image Alt', 0, 0, 0),
(13, 'Title 7', 'title-7', 'blog_65a57df2b329a.jpg', 'Meta Title', 'Meta Description', 4, 'Meta Description,12', '<p><span style=\"color: rgb(121, 121, 121);\">Short Description</span><br></p>', '<p><span style=\"color: rgb(121, 121, 121);\">Long Description</span><br></p>', '2024-01-15 13:48:18', '2024-01-15 13:48:18', 'blog_banner_65a57df2bddf0.jpg', 1, 'Banner Alt', 'Image Alt', NULL, 1, 0),
(14, 'Title 8', 'title-8', 'blog_65a57df2b329a.jpg', 'Meta Title', 'Meta Description', 4, 'Meta Description,12', '<p><span style=\"color: rgb(121, 121, 121);\">Short Description</span><br></p>', '<p><span style=\"color: rgb(121, 121, 121);\">Long Description</span><br></p>', '2024-01-15 13:48:18', '2024-01-15 13:48:18', 'blog_banner_65a57df2bddf0.jpg', 1, 'Banner Alt', 'Image Alt', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_enable` int(11) NOT NULL DEFAULT 1,
  `sort` int(11) DEFAULT NULL,
  `alt` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `title`, `slug`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`, `is_enable`, `sort`, `alt`) VALUES
(4, 'Food & Health', 'food-health', 'blog_category_65a56ff5885e4.jpg', 'Meta Title', 'Meta Description', 'test1', '2024-01-15 12:55:20', '2024-01-15 12:55:20', 1, 0, '11'),
(5, 'Travel', 'travel', 'blog_category_65a56fe757bd5.jpg', NULL, NULL, NULL, '2024-01-15 12:48:23', '2024-01-15 12:48:23', 1, 0, NULL),
(6, 'Science & Technology', 'science-technology', 'blog_category_65a56fd68c169.jpg', 'Meta Title', 'Meta Description', 'keywords', '2024-01-15 12:48:06', '2024-01-15 12:48:06', 1, 3, NULL),
(8, 'Beauty & Fashion', 'beauty-fashion', 'blog_category_65a56fa665803.jpg', 'Meta Title', 'Meta Description', 'keyword1,keyword2,keyword3', '2024-01-19 17:20:18', '2024-01-19 17:20:18', 1, 2, 'Beauty & Fashion'),
(9, 'Food & Health1', 'food-health1', 'blog_category_65aaf511401f4.jpg', 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_enable` int(11) NOT NULL DEFAULT 1,
  `sort` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `title`, `slug`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`, `is_enable`, `sort`) VALUES
(1, 'logo-text1', 'logo-text1', 'assets/images/logo/brandlogo1.png', NULL, NULL, NULL, '2024-02-15 10:56:59', '2024-02-15 10:56:59', 1, NULL),
(2, 'logo-text2', 'logo-text2', 'assets/images/logo/brandlogo2.png', NULL, NULL, NULL, '2024-02-15 10:56:59', '2024-02-15 10:56:59', 1, NULL),
(3, 'logo-text3', 'logo-text3', 'assets/images/logo/brandlogo3.png', NULL, NULL, NULL, '2024-02-15 10:56:59', '2024-02-15 10:56:59', 1, NULL),
(4, 'logo-text4', 'logo-text4', 'assets/images/logo/brandlogo4.png', NULL, NULL, NULL, '2024-02-15 10:56:59', '2024-02-15 10:56:59', 1, NULL),
(5, 'logo-text5', 'logo-text5', 'assets/images/logo/brandlogo5.png', NULL, NULL, NULL, '2024-02-15 10:56:59', '2024-02-15 10:56:59', 1, NULL),
(6, 'logo-text6', 'logo-text6', 'assets/images/logo/brandlogo6.png', NULL, NULL, NULL, '2024-02-15 10:56:59', '2024-02-15 10:56:59', 1, NULL),
(7, 'logo-text7', 'logo-text7', 'assets/images/logo/brandlogo3.png', NULL, NULL, NULL, '2024-02-15 10:56:59', '2024-02-15 10:56:59', 1, NULL),
(8, 'logo-text8', 'logo-text8', 'assets/images/logo/brandlogo2.png', NULL, NULL, NULL, '2024-02-15 10:56:59', '2024-02-15 10:56:59', 1, NULL),
(9, 'logo-text9', 'logo-text9', 'assets/images/logo/brandlogo1.png', NULL, NULL, NULL, '2024-02-15 10:56:59', '2024-02-15 10:56:59', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) NOT NULL,
  `offer_name` varchar(255) DEFAULT NULL,
  `offer_box` varchar(255) DEFAULT NULL,
  `offer_details` text DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `code` text DEFAULT NULL,
  `tracking_link` text DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_enable` int(11) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiry` timestamp NULL DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `image` text DEFAULT NULL,
  `alt` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `offer_name`, `offer_box`, `offer_details`, `store_id`, `code`, `tracking_link`, `type`, `created_at`, `is_enable`, `updated_at`, `expiry`, `sort`, `image`, `alt`) VALUES
(14, 'Offer Name 1', 'Offer Box 1', 'Offer Details 1', 18, NULL, 'Direct URL', 'active', '2024-01-14 05:17:13', 1, '2024-01-14 05:18:49', '2024-01-30 19:00:00', 0, 'coupon_65ab8e5f590d5.png', NULL),
(15, 'Offer Name', 'Offer Box', 'Offer Details', 19, '98406', 'www.google11.com', 'code', '2024-01-15 15:12:49', 1, '2024-01-20 04:11:59', '2024-01-30 19:00:00', 0, 'coupon_65ab8e5f590d5.png', NULL),
(16, 'Offer Name 1', 'Offer Box 1', 'Offer Details', 19, '98406', 'www.google11.com', 'code', '2024-01-15 15:12:49', 1, '2024-01-20 04:12:11', '2024-01-30 19:00:00', 0, 'coupon_65ab8e6b4bc5b.png', NULL),
(17, 'Offer Name 2', 'Offer Box 2', 'Offer Details', 19, '98406', 'www.google1.com', 'code', '2024-01-15 15:12:49', 1, '2024-01-15 15:13:27', '2024-01-30 19:00:00', 0, 'coupon_65ab8e5f590d5.png', NULL),
(18, 'Offer Name 3', 'Offer Box 3', 'Offer Details', 19, '98406', 'www.google1.com', 'code', '2024-01-15 15:12:49', 1, '2024-01-15 15:13:27', '2024-01-30 19:00:00', 0, 'coupon_65ab8e5f590d5.png', NULL),
(19, 'Offer Name 4', 'Offer Box 4', 'Offer Details', 19, '98406', 'www.google1.com', 'code', '2024-01-15 15:12:49', 1, '2024-01-15 15:13:27', '2024-01-30 19:00:00', 0, 'coupon_65ab8e5f590d5.png', NULL),
(20, 'COUPON 1', 'COUPON 1', 'COUPON 1', 20, '1', 'www.google1.com', 'code', '2024-01-20 02:46:07', 1, '2024-01-20 02:46:07', NULL, 0, 'coupon_65ab7a3fd0818.jpg', 'Image Alt');

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
-- Table structure for table `filemanager`
--

CREATE TABLE `filemanager` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `preview` text DEFAULT NULL,
  `size` double DEFAULT NULL,
  `extension` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_enable` int(11) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filemanager`
--

INSERT INTO `filemanager` (`id`, `title`, `description`, `filename`, `preview`, `size`, `extension`, `type`, `path`, `created_by`, `created_at`, `is_enable`, `updated_at`) VALUES
(12, 'collection7', NULL, '1708785770.jpg', 'http://localhost/admin/public/filemanager/1708785770.jpg', 38497, 'jpg', 'image/jpeg', 'filemanager/1708785770.jpg', NULL, '2024-02-24 09:42:50', 1, '2024-02-24 09:42:50'),
(13, 'collection8', NULL, '1708785796.jpg', 'http://localhost/admin/public/filemanager/1708785796.jpg', 34969, 'jpg', 'image/jpeg', 'filemanager/1708785796.jpg', NULL, '2024-02-24 09:43:16', 1, '2024-02-24 09:43:16'),
(14, 'demo8-img1', NULL, '1708785835.jpg', 'http://localhost/admin/public/filemanager/1708785835.jpg', 16636, 'jpg', 'image/jpeg', 'filemanager/1708785835.jpg', NULL, '2024-02-24 09:43:55', 1, '2024-02-24 09:43:55'),
(15, 'demo8-img2', NULL, '1708785868.jpg', 'http://localhost/admin/public/filemanager/1708785868.jpg', 77939, 'jpg', 'image/jpeg', 'filemanager/1708785868.jpg', NULL, '2024-02-24 09:44:28', 1, '2024-02-24 09:44:28'),
(16, 'home2-collection1', NULL, '1708785892.jpg', 'http://localhost/admin/public/filemanager/1708785892.jpg', 35459, 'jpg', 'image/jpeg', 'filemanager/1708785892.jpg', NULL, '2024-02-24 09:44:52', 1, '2024-02-24 09:44:52'),
(17, 'home4-collection3', NULL, '1708785970.jpg', 'http://localhost/admin/public/filemanager/1708785970.jpg', 32146, 'jpg', 'image/jpeg', 'filemanager/1708785970.jpg', NULL, '2024-02-24 09:46:10', 1, '2024-02-24 09:46:10'),
(18, 'home5-collection1', NULL, '1708786019.jpg', 'http://localhost/admin/public/filemanager/1708786019.jpg', 115393, 'jpg', 'image/jpeg', 'filemanager/1708786019.jpg', NULL, '2024-02-24 09:46:59', 1, '2024-02-24 09:46:59'),
(19, 'home7-collection1', NULL, '1708786043.jpg', 'http://localhost/admin/public/filemanager/1708786043.jpg', 34800, 'jpg', 'image/jpeg', 'filemanager/1708786043.jpg', NULL, '2024-02-24 09:47:23', 1, '2024-02-24 09:47:23'),
(20, 'home8-collection2', NULL, '1708786070.jpg', 'http://localhost/admin/public/filemanager/1708786070.jpg', 56407, 'jpg', 'image/jpeg', 'filemanager/1708786070.jpg', NULL, '2024-02-24 09:47:50', 1, '2024-02-24 09:47:50'),
(21, 'home10-collection3', NULL, '1708786094.jpg', 'http://localhost/admin/public/filemanager/1708786094.jpg', 33588, 'jpg', 'image/jpeg', 'filemanager/1708786094.jpg', NULL, '2024-02-24 09:48:14', 1, '2024-02-24 09:48:14'),
(22, 'home11-collection5', NULL, '1708786130.jpg', 'http://localhost/admin/public/filemanager/1708786130.jpg', 33866, 'jpg', 'image/jpeg', 'filemanager/1708786130.jpg', NULL, '2024-02-24 09:48:50', 1, '2024-02-24 09:48:50'),
(23, '1708786229.jpg', NULL, '1708786229.jpg', 'http://localhost/admin/public/filemanager/1708786229.jpg', 76011, 'jpg', 'image/jpeg', 'filemanager/1708786229.jpg', NULL, '2024-02-24 09:50:29', 1, '2024-02-24 09:50:29'),
(24, '1708786246.jpg', NULL, '1708786246.jpg', 'http://localhost/admin/public/filemanager/1708786246.jpg', 85717, 'jpg', 'image/jpeg', 'filemanager/1708786246.jpg', NULL, '2024-02-24 09:50:46', 1, '2024-02-24 09:50:46'),
(25, '1708786292.jpg', NULL, '1708786292.jpg', 'http://localhost/admin/public/filemanager/1708786292.jpg', 18533, 'jpg', 'image/jpeg', 'filemanager/1708786292.jpg', NULL, '2024-02-24 09:51:32', 1, '2024-02-24 09:51:32'),
(26, '1708786331.jpg', NULL, '1708786331.jpg', 'http://localhost/admin/public/filemanager/1708786331.jpg', 40314, 'jpg', 'image/jpeg', 'filemanager/1708786331.jpg', NULL, '2024-02-24 09:52:11', 1, '2024-02-24 09:52:11'),
(27, '1708953342.jpg', NULL, '1708953342.jpg', 'http://localhost/admin/public/filemanager/1708953342.jpg', 87553, 'jpg', 'image/jpeg', 'filemanager/1708953342.jpg', NULL, '2024-02-26 08:15:42', 1, '2024-02-26 08:15:42'),
(28, '1708953401.jpg', NULL, '1708953401.jpg', 'http://localhost/admin/public/filemanager/1708953401.jpg', 77454, 'jpg', 'image/jpeg', 'filemanager/1708953401.jpg', NULL, '2024-02-26 08:16:41', 1, '2024-02-26 08:16:41'),
(29, '1708953417.jpg', NULL, '1708953417.jpg', 'http://localhost/admin/public/filemanager/1708953417.jpg', 109986, 'jpg', 'image/jpeg', 'filemanager/1708953417.jpg', NULL, '2024-02-26 08:16:57', 1, '2024-02-26 08:16:57'),
(30, '1708953434.jpg', NULL, '1708953434.jpg', 'http://localhost/admin/public/filemanager/1708953434.jpg', 113123, 'jpg', 'image/jpeg', 'filemanager/1708953434.jpg', NULL, '2024-02-26 08:17:14', 1, '2024-02-26 08:17:14'),
(31, '1708953460.jpg', NULL, '1708953460.jpg', 'http://localhost/admin/public/filemanager/1708953460.jpg', 81486, 'jpg', 'image/jpeg', 'filemanager/1708953460.jpg', NULL, '2024-02-26 08:17:40', 1, '2024-02-26 08:17:40');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `title` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `price` double DEFAULT NULL,
  `selling_price` double DEFAULT NULL,
  `sku` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `subchildcategory_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `hover_image` text DEFAULT NULL,
  `is_featured` int(11) DEFAULT 0,
  `is_popular` int(11) DEFAULT 0,
  `details` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `is_enable` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `price`, `selling_price`, `sku`, `category_id`, `subcategory_id`, `subchildcategory_id`, `brand_id`, `tags`, `image`, `images`, `type`, `hover_image`, `is_featured`, `is_popular`, `details`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `is_enable`, `created_at`, `updated_at`) VALUES
(1, 'Floral Sleeveless Dress', 'floral-sleeveless-dress', 3801, 4001, '19115-rdxs1', 11, NULL, NULL, 1, 'kjk,kl,jj', '28', '2,2,4,5,2,1,2,3,12,13,14,16', 'variation', '28', 0, 1, 'Diva is a minimalist modern shopify theme that will give you and your customers a smooth shopping experience which can be used for various kinds of stores such as fashion,...', '<p>Floral Sleeveless Dress</p>', 'Floral Sleeveless Dress', 'Floral Sleeveless Dress', 'Floral Sleeveless Dress', 0, '2024-02-15 11:10:35', '2024-02-26 08:18:17'),
(2, 'Button Up Dress', 'Button Up Dress', 400, 500, '19115-rdxs', 11, NULL, NULL, 1, NULL, '28', 'assets/images/product-images/product-image10.jpg,assets/images/product-images/product-image10-1.jpg', 'single', '28', 1, 0, 'Diva is a minimalist modern shopify theme that will give you and your customers a smooth shopping experience which can be used for various kinds of stores such as fashion,...', '<p>Button Up Dress</p>', 'Button Up Dress', 'Button Up Dress', NULL, 1, '2024-02-15 11:10:35', '2024-02-26 08:20:04'),
(3, 'Lexie Shirt', 'Lexie Shirt', 200, 300, '19115-rdxs', 19, NULL, NULL, 1, NULL, '27', 'assets/images/product-images/product-image11.jpg,assets/images/product-images/product-image11-1.jpg,28,29,30', 'single', '27', 1, 0, 'Diva is a minimalist modern shopify theme that will give you and your customers a smooth shopping experience which can be used for various kinds of stores such as fashion,...', '<p>Lexie Shirt</p>', 'Lexie Shirt', 'Lexie Shirt', NULL, 1, '2024-02-15 11:10:35', '2024-02-26 08:41:38'),
(4, 'One Shoulder Dress in Navy', 'One Shoulder Dress in Navy', 1048.6, 1200, '19115-rdxs', 11, NULL, NULL, 1, NULL, '28', 'assets/images/product-images/product-image12.jpg,assets/images/product-images/product-image12-1.jpg', 'single', '28', 1, 1, 'Diva is a minimalist modern shopify theme that will give you and your customers a smooth shopping experience which can be used for various kinds of stores such as fashion,...', '<p>One Shoulder Dress in Navy</p>', 'One Shoulder Dress in Navy', 'One Shoulder Dress in Navy', NULL, 1, '2024-02-15 11:10:35', '2024-02-26 08:19:03'),
(5, '3/4 Sleeve Kimono Dress', '3/4 Sleeve Kimono Dress', 1048.6, 1200, '19115-rdxs', 11, NULL, NULL, 1, NULL, '28', 'assets/images/product-images/product-image3.jpg,assets/images/product-images/product-image3-1.jpg', 'single', '28', 1, 0, 'Diva is a minimalist modern shopify theme that will give you and your customers a smooth shopping experience which can be used for various kinds of stores such as fashion,...', '<p>3/4 Sleeve Kimono Dress</p>', '3/4 Sleeve Kimono Dress', '3/4 Sleeve Kimono Dress', NULL, 1, '2024-02-15 11:10:35', '2024-02-26 08:19:10'),
(6, 'A-Line Jacket', 'A-Line Jacket', 1048.6, 1200, '19115-rdxs', 11, NULL, NULL, 1, NULL, '28', 'assets/images/product-images/product-image15.jpg,assets/images/product-images/product-image15-1.jpg', 'single', '28', 1, 0, 'Diva is a minimalist modern shopify theme that will give you and your customers a smooth shopping experience which can be used for various kinds of stores such as fashion,...', '<p>A-Line Jacket</p>', 'A-Line Jacket', 'A-Line Jacket', 'A-Line Jacket', 1, '2024-02-15 11:10:35', '2024-02-26 08:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Size', '2024-02-16 07:49:17', '2024-02-16 07:49:17'),
(2, 'Color', '2024-02-16 07:49:31', '2024-02-16 07:49:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_values`
--

CREATE TABLE `product_attribute_values` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `product_attribute_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_attribute_values`
--

INSERT INTO `product_attribute_values` (`id`, `title`, `product_attribute_id`, `created_at`, `updated_at`) VALUES
(1, 'xl', 1, '2024-02-16 07:55:17', '2024-02-16 07:55:17'),
(2, 'l', 1, '2024-02-16 07:55:17', '2024-02-16 07:55:17'),
(3, 'm', 1, '2024-02-16 07:55:17', '2024-02-16 07:55:17'),
(4, 's', 1, '2024-02-16 07:55:17', '2024-02-16 07:55:17'),
(5, 'red', 2, '2024-02-16 07:55:17', '2024-02-16 07:55:17'),
(6, 'blue', 2, '2024-02-16 07:55:17', '2024-02-16 07:55:17'),
(7, 'green', 2, '2024-02-16 07:55:17', '2024-02-16 07:55:17'),
(8, 'pink', 2, '2024-02-16 07:55:17', '2024-02-16 07:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_enable` int(11) NOT NULL DEFAULT 1,
  `sort` int(11) DEFAULT NULL,
  `alt` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `title`, `slug`, `image`, `parent_id`, `level`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`, `is_enable`, `sort`, `alt`) VALUES
(11, 'Jewellery', 'Jewellery', 'assets/images/collection/home9-collection6.jpg', 0, 1, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(12, 'Clothing', 'Clothing', 'assets/images/collection/home9-collection6.jpg', 0, 1, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(13, 'Men', 'Men', 'assets/images/collection/home9-collection6.jpg', 12, 2, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(14, 'Women', 'Women', 'assets/images/collection/home9-collection6.jpg', 12, 2, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(15, 'Child', 'Child', 'assets/images/collection/home9-collection6.jpg', 12, 2, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(16, 'View All Clothing', 'View All Clothing', 'assets/images/collection/home9-collection6.jpg', 12, 2, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(18, 'Ring', 'Ring', 'assets/images/collection/home9-collection6.jpg', 11, 2, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(19, 'Neckalses', 'Neckalses', 'assets/images/collection/home9-collection6.jpg', 11, 2, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(20, 'Eaarings', 'Eaarings', 'assets/images/collection/home9-collection6.jpg', 11, 2, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(21, 'View All Jewellery', 'View All Jewellery', 'assets/images/collection/home9-collection6.jpg', 11, 2, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(22, 'Shoes', 'Shoes', 'assets/images/collection/home9-collection6.jpg', 0, 1, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(23, 'Accessories', 'Accessories', 'assets/images/collection/home9-collection6.jpg', 0, 1, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(24, 'Collections', 'Collections', 'assets/images/collection/home9-collection6.jpg', 0, 1, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(25, 'Sale', 'Sale', 'assets/images/collection/home9-collection6.jpg', 0, 1, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(26, 'Page', 'Page', 'assets/images/collection/home9-collection6.jpg', 0, 1, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_collections`
--

CREATE TABLE `product_collections` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_enable` int(11) NOT NULL DEFAULT 1,
  `sort` int(11) DEFAULT NULL,
  `alt` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_collections`
--

INSERT INTO `product_collections` (`id`, `title`, `slug`, `image`, `parent_id`, `level`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`, `is_enable`, `sort`, `alt`) VALUES
(4, 'Women\'s Clothing', 'Women\'s Clothing', 'assets/images/collection/home9-collection1.jpg', NULL, NULL, 'Meta Title', 'Meta Description', 'test1', '2024-01-15 12:55:20', '2024-01-15 12:55:20', 1, 0, '11'),
(5, 'Women\'s Shoes', 'Women\'s Shoes', 'assets/images/collection/home9-collection2.jpg', NULL, NULL, NULL, NULL, NULL, '2024-01-15 12:48:23', '2024-01-15 12:48:23', 1, 0, NULL),
(6, 'Jewellery', 'Jewellery', 'assets/images/collection/home9-collection3.jpg', NULL, NULL, 'Meta Title', 'Meta Description', 'keywords', '2024-01-15 12:48:06', '2024-01-15 12:48:06', 1, 3, NULL),
(8, 'Men\'s Clothing', 'Men\'s Clothing', 'assets/images/collection/home9-collection4.jpg', NULL, NULL, 'Meta Title', 'Meta Description', 'keyword1,keyword2,keyword3', '2024-01-19 17:20:18', '2024-01-19 17:20:18', 1, 2, 'Beauty & Fashion'),
(9, 'Watches', 'Watches', 'assets/images/collection/home9-collection5.jpg', NULL, NULL, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(10, 'Baby', 'Baby', 'assets/images/collection/home9-collection6.jpg', NULL, NULL, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL),
(11, 'Jewellery', 'Jewellery', 'assets/images/collection/home9-collection6.jpg', 0, 1, 'Meta Title', 'Meta Description', 'keyword1', '2024-01-19 17:17:53', '2024-01-19 17:17:53', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` int(11) NOT NULL,
  `product_id` bigint(11) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `sku`, `quantity`, `price`, `image`, `created_at`, `updated_at`) VALUES
(127, 3, 'xl-red', 1, 12, NULL, '2024-02-25 06:33:46', '2024-02-26 08:41:38'),
(128, 3, 'xl-blue', 1, 2, NULL, '2024-02-25 06:33:46', '2024-02-26 08:41:38'),
(129, 3, 'l-red', 1, 12, NULL, '2024-02-25 06:33:46', '2024-02-26 08:41:38'),
(130, 3, 'l-blue', 1, 2, NULL, '2024-02-25 06:33:46', '2024-02-26 08:41:38'),
(166, 1, 'xl-blue', 1, 1, '1', '2024-02-26 06:43:44', '2024-02-26 08:18:17'),
(167, 1, 'xl-green', 1, 1, '1', '2024-02-26 06:43:44', '2024-02-26 08:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_variation_attributes`
--

CREATE TABLE `product_variation_attributes` (
  `id` int(11) NOT NULL,
  `product_variation_id` int(11) DEFAULT NULL,
  `product_attribute_id` int(50) DEFAULT NULL,
  `product_attribute_value_id` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variation_attributes`
--

INSERT INTO `product_variation_attributes` (`id`, `product_variation_id`, `product_attribute_id`, `product_attribute_value_id`, `value`, `created_at`, `updated_at`) VALUES
(151, 127, 1, 1, 'xl', '2024-02-25 06:33:46', '2024-02-25 06:33:46'),
(152, 127, 2, 5, 'red', '2024-02-25 06:33:46', '2024-02-25 06:33:46'),
(153, 128, 1, 1, 'xl', '2024-02-25 06:33:46', '2024-02-25 06:33:46'),
(154, 128, 2, 6, 'blue', '2024-02-25 06:33:46', '2024-02-25 06:33:46'),
(155, 129, 1, 2, 'l', '2024-02-25 06:33:46', '2024-02-25 06:33:46'),
(156, 129, 2, 5, 'red', '2024-02-25 06:33:46', '2024-02-25 06:33:46'),
(157, 130, 1, 2, 'l', '2024-02-25 06:33:46', '2024-02-25 06:33:46'),
(158, 130, 2, 6, 'blue', '2024-02-25 06:33:46', '2024-02-25 06:33:46'),
(225, 166, 1, 1, 'xl', '2024-02-26 06:43:44', '2024-02-26 06:43:44'),
(226, 166, 2, 6, 'blue', '2024-02-26 06:43:44', '2024-02-26 06:43:44'),
(227, 167, 1, 1, 'xl', '2024-02-26 06:43:44', '2024-02-26 06:43:44'),
(228, 167, 2, 7, 'green', '2024-02-26 06:43:44', '2024-02-26 06:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Admin1', 1, '2024-01-27 09:11:35', '2024-01-27 04:45:22', 1, 1),
(2, 'Super Admin', 1, '2024-01-27 09:11:35', '0000-00-00 00:00:00', 1, NULL),
(3, 'Title 1', 1, '2024-01-27 04:27:59', '2024-01-27 04:27:59', 1, NULL),
(4, 'customer1', 0, '2024-01-27 04:28:38', '2024-01-27 04:45:29', 1, 1),
(5, 'New Role', 1, '2024-02-14 04:43:19', '2024-02-14 04:45:07', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `field` text NOT NULL,
  `value` text DEFAULT NULL,
  `type` text NOT NULL DEFAULT 'text',
  `sort` int(11) NOT NULL DEFAULT 0,
  `grouping` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `field`, `value`, `type`, `sort`, `grouping`) VALUES
(1, 'site_title', 'GET FINAL CHOICE', 'text', 1, 'site_settings'),
(2, 'blog_meta_tags', 'Meta Tags 1', 'text', 2, 'blog_settings'),
(3, 'blog_meta_description', 'Meta Description', 'text', 3, 'blog_settings'),
(4, 'blog_keywords', 'keyword1,keyword2,keyword3,keyword4', 'keywords', 4, 'blog_settings'),
(5, 'footer_credits', 'Copyright: 2024 <a href=\"#.\"><span class=\"color_red\">website name Here</span></a>. All Rights Reserved', 'text', 5, 'site_settings'),
(6, 'phone_number', '03333906535', 'text', 5, 'site_settings'),
(7, 'email_address', 'info@iGetFinalchoice.com', 'text', 4, 'site_settings'),
(8, 'address', 'Address Will come here.', 'text', 4, 'site_settings'),
(9, 'domain', 'www.yourdomain.com', 'text', 4, 'site_settings'),
(10, 'blog_banner', 'settings_blog_banner_65aaf35652433.jpg', 'image', 4, 'blog_settings'),
(11, 'store_banner', 'settings_store_banner_65ab830991c15.jpg', 'image', 4, 'store_settings'),
(12, 'store_meta_tags', 'Meta Tags 1', 'text', 2, 'store_settings'),
(13, 'store_keywords', 'keyword1,keyword2,keyword3,keyword4', 'keywords', 4, 'store_settings'),
(14, 'store_meta_description', 'Meta Description', 'text', 3, 'store_settings'),
(15, 'logo', 'settings_logo_65aadb59abf33.png', 'image', 1, 'site_settings'),
(16, 'fav_icon', 'settings_fav_icon_65aadb3928a64.png', 'image', 1, 'site_settings'),
(18, 'about_us', '<p>11111111</p>', 'textarea', 4, 'site_settings'),
(19, 'privacy_policy', '<p>sdasd</p>', 'textarea', 4, 'site_settings'),
(20, 'terms_&_conditions', '<p>sddssdsd</p>', 'textarea', 4, 'site_settings'),
(21, 'blog_banner_title', 'Well Come in <span>GET FINAL CHOICE</span>', 'text', 4, 'blog_settings'),
(22, 'facebook_link', '..', 'text', 1, 'site_settings'),
(23, 'youtube_link', '..', 'text', 1, 'site_settings'),
(24, 'twitter_link', '..', 'text', 1, 'site_settings'),
(25, 'instagram_link', '..', 'text', 1, 'site_settings'),
(26, 'store_banner_title', 'Well Come in <span>GET FINAL CHOICE</span>', 'text', 4, 'store_settings');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) NOT NULL,
  `title` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL,
  `heading` text DEFAULT NULL,
  `tracking_url` text DEFAULT NULL,
  `direct_url` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `short_des` text DEFAULT NULL,
  `long_des` text DEFAULT NULL,
  `is_enable` int(11) NOT NULL DEFAULT 1,
  `alt` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `title`, `slug`, `image`, `meta_title`, `meta_description`, `created_at`, `updated_at`, `category_id`, `heading`, `tracking_url`, `direct_url`, `meta_keywords`, `short_des`, `long_des`, `is_enable`, `alt`) VALUES
(19, 'Store Name', 'store-name', 'store_65a590dcc5393.jpg', 'Meta Title', 'Meta Description', '2024-01-15 15:07:12', '2024-01-20 03:54:31', 11, 'promo_codes_coupon', 'www.google11.com', 'www.google11.com', 'Meta Description', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia', '<p><font color=\"#797979\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia</font></p><div><div>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia</div></div><div><br></div><div><div>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia</div></div><div><br></div><div><div>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia</div></div><div><br></div>', 1, NULL),
(20, 'a store Name', 'a-store-name', 'store_65a590dcc5393.jpg', 'Meta Title', 'Meta Description', '2024-01-15 15:07:12', '2024-01-15 15:09:00', 11, 'promo_codes_coupon', 'www.google1.com', 'www.google1.com', 'Meta Description', '<p><span style=\"color: rgb(121, 121, 121);\">Short Description</span><br></p>', '<p><span style=\"color: rgb(121, 121, 121);\">Long Description</span><br></p>', 1, NULL),
(21, 'b store Name', 'b-store-name', 'store_65a590dcc5393.jpg', 'Meta Title', 'Meta Description', '2024-01-15 15:07:12', '2024-01-15 15:09:00', 11, 'promo_codes_coupon', 'www.google1.com', 'www.google1.com', 'Meta Description', '<p><span style=\"color: rgb(121, 121, 121);\">Short Description</span><br></p>', '<p><span style=\"color: rgb(121, 121, 121);\">Long Description</span><br></p>', 1, NULL),
(22, 'c store Name', 'c-store-name', 'store_65a590dcc5393.jpg', 'Meta Title', 'Meta Description', '2024-01-15 15:07:12', '2024-01-15 15:09:00', 11, 'promo_codes_coupon', 'www.google1.com', 'www.google1.com', 'Meta Description', '<p><span style=\"color: rgb(121, 121, 121);\">Short Description</span><br></p>', '<p><span style=\"color: rgb(121, 121, 121);\">Long Description</span><br></p>', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store_categories`
--

CREATE TABLE `store_categories` (
  `id` bigint(20) NOT NULL,
  `title` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_enable` int(11) NOT NULL DEFAULT 1,
  `alt` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store_categories`
--

INSERT INTO `store_categories` (`id`, `title`, `slug`, `image`, `created_at`, `updated_at`, `is_enable`, `alt`) VALUES
(4, 'Furniture', NULL, '4.png', '2024-01-06 10:45:29', '2024-01-06 10:45:29', 1, NULL),
(5, 'Games and Toys', NULL, '5.png', '2024-01-06 10:45:45', '2024-01-06 10:45:45', 1, NULL),
(7, 'Hobbie', NULL, '7.png', '2024-01-06 10:45:09', '2024-01-06 10:45:09', 1, NULL),
(10, 'Shoes', 'shoes', 'store_category_65a583ab44eca.jpg', '2024-01-16 13:27:14', '2024-01-16 13:27:14', 1, 'alt'),
(11, 'Accessories', 'accessories', 'store_category_65ab8630732e0.jpg', '2024-01-20 03:37:04', '2024-01-20 03:37:04', 1, NULL),
(17, 'tetst', 'tetst', 'store_category_65ab861ac614c.jpg', '2024-01-20 03:36:42', '2024-01-20 03:36:42', 1, 'Image Alt');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `permissions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role_id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `created_by`, `permissions`) VALUES
(1, 'Owais Azam', NULL, 'admin@gmail.com', NULL, '$2y$10$xhPEybNF4n6iu.wTTK/V3OilB31PZwiaM8BjUdWWsHKoo4nrtqtGq', NULL, NULL, NULL, 1, 1, 'dashboard_management,store_category_management,store_management,coupons_management,blogs_category_management,blogs_management,site_management,user_rights_management'),
(2, 'Owais Azam 1', NULL, 'iamowaisazam221@gmail.com', NULL, '$2y$10$Rx7ppVgpkUz.BEsxqv4P2.o6F4BGJxuQ.Yws1YxdnY.RUzmMvjZIS', NULL, '2024-01-03 12:25:47', '2024-01-03 12:25:47', 1, 2, 'store_management,coupons_management,blogs_management,site_management,user_rights_management'),
(3, 'User 1', NULL, 'user1@gmail.com', NULL, '$2y$10$ZlbiEzXleDKGKZkcztA4eeQ5grxA2d0Esd3692x0ZNvP7y5ynzQ.2', NULL, '2024-01-03 10:48:55', '2024-01-03 10:48:55', 1, 1, NULL),
(4, 'Title 1', NULL, 'admin1@gmail.com', NULL, '$2y$10$uQxrxCxNOeWE729Tm85iUO705DAHwdK1zLRTPvVwjhpvvIyJ2NcUa', NULL, '2024-01-03 10:51:41', '2024-01-03 10:51:41', 1, 1, NULL),
(5, 'admin1', NULL, 'superadmin@example.com', NULL, '$2y$10$EfBxTv7n0BLsT4MqTzsJteDRtxz1wjFr92H0HpDEJRS5SJcMQOPu6', NULL, '2024-01-03 10:52:44', '2024-01-03 10:52:44', 1, 1, 'store_management,coupons_management,site_management'),
(7, 'Owais Azam 1', NULL, 'iamowaisazam1@gmail.com', NULL, '$2y$10$Rx7ppVgpkUz.BEsxqv4P2.o6F4BGJxuQ.Yws1YxdnY.RUzmMvjZIS', NULL, '2024-01-03 12:25:47', '2024-01-03 12:25:47', 1, 2, 'store_management,coupons_management,blogs_management,site_management,user_rights_management'),
(8, 'Owais Azam 2', NULL, 'iamowaisazam2@gmail.com', NULL, '$2y$10$Rx7ppVgpkUz.BEsxqv4P2.o6F4BGJxuQ.Yws1YxdnY.RUzmMvjZIS', NULL, '2024-01-03 12:25:47', '2024-01-03 12:25:47', 1, 2, 'store_management,coupons_management,blogs_management,site_management,user_rights_management'),
(9, 'Owais Azam 3', NULL, 'iamowaisazam3@gmail.com', NULL, '$2y$10$Rx7ppVgpkUz.BEsxqv4P2.o6F4BGJxuQ.Yws1YxdnY.RUzmMvjZIS', NULL, '2024-01-03 12:25:47', '2024-01-03 12:25:47', 1, 2, 'store_management,coupons_management,blogs_management,site_management,user_rights_management'),
(10, 'Owais Azam 4', NULL, 'iamowaisazam4@gmail.com', NULL, '$2y$10$Rx7ppVgpkUz.BEsxqv4P2.o6F4BGJxuQ.Yws1YxdnY.RUzmMvjZIS', NULL, '2024-01-03 12:25:47', '2024-01-03 12:25:47', 1, 2, 'store_management,coupons_management,blogs_management,site_management,user_rights_management'),
(11, 'Owais Azam 5', NULL, 'iamowaisazam5@gmail.com', NULL, '$2y$10$Rx7ppVgpkUz.BEsxqv4P2.o6F4BGJxuQ.Yws1YxdnY.RUzmMvjZIS', NULL, '2024-01-03 12:25:47', '2024-01-03 12:25:47', 1, 2, 'store_management,coupons_management,blogs_management,site_management,user_rights_management'),
(12, 'Owais Azam 6', NULL, 'iamowaisazam6@gmail.com', NULL, '$2y$10$Rx7ppVgpkUz.BEsxqv4P2.o6F4BGJxuQ.Yws1YxdnY.RUzmMvjZIS', NULL, '2024-01-03 12:25:47', '2024-01-03 12:25:47', 1, 2, 'store_management,coupons_management,blogs_management,site_management,user_rights_management'),
(13, 'Owais Azam 7', NULL, 'iamowaisazam7@gmail.com', NULL, '$2y$10$Rx7ppVgpkUz.BEsxqv4P2.o6F4BGJxuQ.Yws1YxdnY.RUzmMvjZIS', NULL, '2024-01-03 12:25:47', '2024-01-03 12:25:47', 1, 2, 'store_management,coupons_management,blogs_management,site_management,user_rights_management'),
(14, 'Owais Azam 8', NULL, 'iamowaisazam8@gmail.com', NULL, '$2y$10$Rx7ppVgpkUz.BEsxqv4P2.o6F4BGJxuQ.Yws1YxdnY.RUzmMvjZIS', NULL, '2024-01-03 12:25:47', '2024-01-03 12:25:47', 1, 2, 'store_management,coupons_management,blogs_management,site_management,user_rights_management'),
(15, 'Owais Azam 9', NULL, 'iamowaisazam9@gmail.com', NULL, '$2y$10$Rx7ppVgpkUz.BEsxqv4P2.o6F4BGJxuQ.Yws1YxdnY.RUzmMvjZIS', NULL, '2024-01-03 12:25:47', '2024-01-03 12:25:47', 1, 2, 'store_management,coupons_management,blogs_management,site_management,user_rights_management'),
(16, 'Owais Azam 10', NULL, 'iamowaisazam10@gmail.com', NULL, '$2y$10$Rx7ppVgpkUz.BEsxqv4P2.o6F4BGJxuQ.Yws1YxdnY.RUzmMvjZIS', NULL, '2024-01-03 12:25:47', '2024-01-03 12:25:47', 1, 2, 'store_management,coupons_management,blogs_management,site_management,user_rights_management');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `filemanager`
--
ALTER TABLE `filemanager`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_collections`
--
ALTER TABLE `product_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_variation_attributes`
--
ALTER TABLE `product_variation_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pva_product_variation_id_to_variation_id` (`product_variation_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_categories`
--
ALTER TABLE `store_categories`
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
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filemanager`
--
ALTER TABLE `filemanager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_collections`
--
ALTER TABLE `product_collections`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `product_variation_attributes`
--
ALTER TABLE `product_variation_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `store_categories`
--
ALTER TABLE `store_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_to_product_variation_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variation_attributes`
--
ALTER TABLE `product_variation_attributes`
  ADD CONSTRAINT `pva_product_variation_id_to_variation_id` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
