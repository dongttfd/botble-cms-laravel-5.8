-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 30, 2019 at 07:56 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `botble`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE `activations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'ZLKcLRxzQH9E8XMMWd6NITIH1J8Qdljb', 1, '2017-11-15 06:57:09', '2017-11-15 06:57:09', '2017-11-15 06:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `audit_history`
--

CREATE TABLE `audit_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `module` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request` text COLLATE utf8mb4_unicode_ci,
  `action` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_user` int(10) UNSIGNED NOT NULL,
  `reference_id` int(10) UNSIGNED NOT NULL,
  `reference_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_history`
--

INSERT INTO `audit_history` (`id`, `user_id`, `module`, `request`, `action`, `user_agent`, `ip_address`, `reference_user`, `reference_id`, `reference_name`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-04-06 03:52:00', '2019-04-06 03:52:00'),
(2, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-04-06 03:52:07', '2019-04-06 03:52:07'),
(3, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-04-06 04:26:11', '2019-04-06 04:26:11'),
(4, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-04-07 17:22:09', '2019-04-07 17:22:09'),
(5, 1, 'page', '{\"_token\":\"8wjqgEE6ZdvkQyPfxCxgjUYJoprLY57SlDHHP4kd\",\"name\":\"test\",\"slug\":\"test\",\"slug_id\":\"0\",\"slug-screen\":\"page\",\"description\":null,\"content\":\"<p>xxx<\\/p>\",\"gallery\":null,\"seo_meta\":{\"seo_title\":null,\"seo_description\":null},\"submit\":\"save\",\"language\":\"en_US\",\"ref_from\":null,\"status\":\"publish\",\"template\":\"default\",\"image\":null}', 'created', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '::1', 1, 18, 'test', 'info', '2019-04-07 17:29:06', '2019-04-07 17:29:06'),
(6, 1, 'page', '[]', 'deleted', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '::1', 1, 18, 'test', 'danger', '2019-04-07 17:29:11', '2019-04-07 17:29:11'),
(7, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-04-12 01:33:18', '2019-04-12 01:33:18'),
(8, 1, 'test', '{\"_token\":\"AXveqdoHy3kPnX2ZanEM5Zoe1FuA6ZYTR0h5WC0B\",\"name\":\"aaaa\",\"submit\":\"save\",\"status\":\"publish\"}', 'created', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '::1', 1, 1, 'aaaa', 'info', '2019-04-12 01:34:27', '2019-04-12 01:34:27'),
(9, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-04-18 18:14:45', '2019-04-18 18:14:45'),
(10, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-04-19 19:21:17', '2019-04-19 19:21:17'),
(11, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-04-21 02:28:54', '2019-04-21 02:28:54'),
(12, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-04-23 08:01:21', '2019-04-23 08:01:21'),
(13, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-05-10 01:57:02', '2019-05-10 01:57:02'),
(14, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-05-12 02:26:08', '2019-05-12 02:26:08'),
(15, 1, 'demo', '{\"_token\":\"1ODsIbjsJmKGOr82tZJ6CDP3ZXhy7NEERa6x4zgk\",\"name\":\"Test\",\"submit\":\"save\",\"status\":\"publish\"}', 'created', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '::1', 1, 1, 'Test', 'info', '2019-05-12 02:34:19', '2019-05-12 02:34:19'),
(16, 1, 'demo', '{\"_token\":\"1ODsIbjsJmKGOr82tZJ6CDP3ZXhy7NEERa6x4zgk\",\"name\":\"aaa\",\"dob\":\"2019-05-13\",\"content\":\"<p>bbb<\\/p>\",\"submit\":\"apply\",\"status\":\"publish\"}', 'created', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '::1', 1, 2, 'aaa', 'info', '2019-05-12 02:37:04', '2019-05-12 02:37:04'),
(17, 1, 'demo', '{\"_token\":\"1ODsIbjsJmKGOr82tZJ6CDP3ZXhy7NEERa6x4zgk\",\"name\":\"aaa\",\"dob\":\"2019-05-13\",\"content\":\"<p>bbb<\\/p>\",\"submit\":\"apply\",\"status\":\"publish\",\"image\":\"\\/storage\\/uploads\\/img-0334.JPG\"}', 'updated', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '::1', 1, 2, 'aaa', 'primary', '2019-05-12 02:39:10', '2019-05-12 02:39:10'),
(18, 1, 'demo', '{\"_token\":\"1ODsIbjsJmKGOr82tZJ6CDP3ZXhy7NEERa6x4zgk\",\"name\":\"aaa\",\"dob\":\"2019-05-13\",\"content\":\"<p>bbb<\\/p>\",\"submit\":\"save\",\"status\":\"publish\",\"image\":\"\\/storage\\/uploads\\/img-0334.JPG\"}', 'updated', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '::1', 1, 2, 'aaa', 'primary', '2019-05-12 02:39:17', '2019-05-12 02:39:17'),
(19, 1, 'demo', '[]', 'deleted', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '::1', 1, 1, 'Test', 'danger', '2019-05-12 02:40:00', '2019-05-12 02:40:00'),
(20, 1, 'demo', '{\"ids\":[\"2\"],\"key\":\"demos.name\",\"value\":\"Test 2\",\"class\":\"Botble\\\\Demo\\\\Tables\\\\DemoTable\"}', 'updated', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '::1', 1, 2, 'aaa', 'primary', '2019-05-12 02:40:10', '2019-05-12 02:40:10'),
(21, 1, 'demo', '{\"ids\":[\"2\"],\"class\":\"Botble\\\\Demo\\\\Tables\\\\DemoTable\"}', 'deleted', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '::1', 1, 2, 'Test 2', 'danger', '2019-05-12 02:40:17', '2019-05-12 02:40:17'),
(22, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-05-16 08:58:49', '2019-05-16 08:58:49'),
(23, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-05-22 04:43:28', '2019-05-22 04:43:28'),
(24, 1, 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', '::1', 0, 1, 'Sang Nguyen', 'info', '2019-05-29 17:54:28', '2019-05-29 17:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `name`, `alias`, `description`, `content`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Sample block', 'sample-block', 'This is a sample block', '<p><span style=\"color:#e67e22;\">This block will be shown on the contact page!</span></p>', 'published', 1, '2019-03-11 19:30:01', '2019-03-11 19:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `author_id` int(10) UNSIGNED NOT NULL,
  `author_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `order` tinyint(4) NOT NULL DEFAULT '0',
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `description`, `status`, `author_id`, `author_type`, `icon`, `is_featured`, `order`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Uncategorized', 0, 'Demo', 'published', 0, 'Botble\\ACL\\Models\\User', '', 0, 0, 1, '2016-07-09 16:32:39', '2016-11-25 07:31:58'),
(6, 'Events', 0, 'Event description', 'published', 1, 'Botble\\ACL\\Models\\User', '', 1, 0, 0, '2016-08-02 22:13:34', '2016-11-25 07:32:02'),
(7, 'Projects', 6, 'Projects description', 'published', 1, 'Botble\\ACL\\Models\\User', NULL, 0, 3, 0, '2016-08-02 22:13:52', '2017-04-30 19:58:41'),
(8, 'Portfolio', 9, 'Description', 'published', 1, 'Botble\\ACL\\Models\\User', NULL, 0, 0, 0, '2016-09-27 09:32:06', '2017-04-30 19:58:21'),
(9, 'Business', 0, 'Business', 'published', 1, 'Botble\\ACL\\Models\\User', NULL, 1, 2, 0, '2016-09-28 09:38:25', '2017-04-30 19:59:12'),
(10, 'Resources', 11, 'Resource', 'published', 1, 'Botble\\ACL\\Models\\User', NULL, 0, 4, 0, '2016-09-28 09:39:46', '2017-04-30 19:58:55'),
(11, 'New & Updates', 0, 'News and Update', 'published', 1, 'Botble\\ACL\\Models\\User', '', 1, 5, 0, '2016-09-28 09:40:25', '2016-11-25 07:31:56'),
(12, 'Chưa phân loại', 0, 'Chuyên mục chưa phân loại', 'published', 1, 'Botble\\ACL\\Models\\User', NULL, 0, 0, 1, '2018-04-13 09:02:12', '2018-04-13 09:02:12'),
(13, 'Sự kiện', 0, 'Sự kiện', 'published', 1, 'Botble\\ACL\\Models\\User', NULL, 1, 0, 0, '2018-04-13 09:04:30', '2018-04-13 10:01:11'),
(14, 'Doanh nghiệp', 0, 'Chuyên mục doanh nghiệp', 'published', 1, 'Botble\\ACL\\Models\\User', NULL, 0, 0, 0, '2018-04-13 09:04:49', '2018-04-13 09:04:49'),
(15, 'Tin tức & cập nhật', 0, 'Chuyên mục tin tức và cập nhật', 'published', 1, 'Botble\\ACL\\Models\\User', NULL, 0, 0, 0, '2018-04-13 09:05:06', '2018-04-13 09:05:06'),
(16, 'Dự án', 13, 'Chuyên mục dự án', 'published', 1, 'Botble\\ACL\\Models\\User', NULL, 1, 0, 0, '2018-04-13 09:05:23', '2018-04-13 10:05:52'),
(17, 'Đầu tư', 14, 'Chuyên mục doanh nghiệp', 'published', 1, 'Botble\\ACL\\Models\\User', NULL, 0, 0, 0, '2018-04-13 09:06:44', '2018-04-13 09:06:44'),
(18, 'Nguồn lực', 15, 'Chuyên mục nguồn lực', 'published', 1, 'Botble\\ACL\\Models\\User', NULL, 0, 0, 0, '2018-04-13 09:08:01', '2018-04-13 09:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `address`, `content`, `subject`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Demo contact', 'admin@admin.com', '0123456789', 'Somewhere in the world', 'The sample content', NULL, '2017-01-15 21:19:27', '2017-01-15 21:25:47', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `contact_replies`
--

CREATE TABLE `contact_replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `use_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_for_id` int(10) UNSIGNED NOT NULL,
  `field_item_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_widgets`
--

CREATE TABLE `dashboard_widgets` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dashboard_widgets`
--

INSERT INTO `dashboard_widgets` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'widget_posts_recent', '2017-11-30 18:26:50', '2017-11-30 18:26:50'),
(2, 'widget_analytics_general', '2017-11-30 18:26:50', '2017-11-30 18:26:50'),
(3, 'widget_analytics_page', '2017-11-30 18:26:50', '2017-11-30 18:26:50'),
(4, 'widget_analytics_browser', '2017-11-30 18:26:50', '2017-11-30 18:26:50'),
(5, 'widget_analytics_referrer', '2017-11-30 18:26:50', '2017-11-30 18:26:50'),
(6, 'widget_audit_logs', '2017-11-30 18:26:50', '2017-11-30 18:26:50'),
(7, 'widget_request_errors', '2017-11-30 18:26:50', '2017-11-30 18:26:50'),
(8, 'widget_total_plugins', '2019-03-11 19:29:10', '2019-03-11 19:29:10'),
(9, 'widget_total_pages', '2019-03-11 19:29:10', '2019-03-11 19:29:10'),
(10, 'widget_total_users', '2019-03-11 19:29:10', '2019-03-11 19:29:10'),
(11, 'widget_total_themes', '2019-03-11 19:29:10', '2019-03-11 19:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_widget_settings`
--

CREATE TABLE `dashboard_widget_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(10) UNSIGNED NOT NULL,
  `widget_id` int(10) UNSIGNED NOT NULL,
  `order` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dashboard_widget_settings`
--

INSERT INTO `dashboard_widget_settings` (`id`, `settings`, `user_id`, `widget_id`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, 1, 1, '2017-11-30 18:27:00', '2017-11-30 18:27:18'),
(2, NULL, 1, 3, 2, 1, '2017-11-30 18:27:00', '2017-11-30 18:27:18'),
(3, NULL, 1, 4, 3, 1, '2017-11-30 18:27:00', '2017-11-30 18:27:14'),
(4, NULL, 1, 5, 4, 1, '2017-11-30 18:27:00', '2017-11-30 18:27:14'),
(5, NULL, 1, 6, 5, 1, '2017-11-30 18:27:00', '2017-11-30 18:27:10'),
(6, NULL, 1, 7, 6, 1, '2017-11-30 18:27:00', '2017-11-30 18:27:10'),
(7, NULL, 1, 2, 0, 1, '2017-11-30 18:27:00', '2017-11-30 18:27:18');

-- --------------------------------------------------------

--
-- Table structure for table `field_groups`
--

CREATE TABLE `field_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rules` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `field_items`
--

CREATE TABLE `field_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `field_group_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci,
  `options` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `order` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `name`, `description`, `status`, `is_featured`, `order`, `image`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Photography', 'This is description', 'published', 1, 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476521053-volkswagen-id-paris-motor-show-4k-1280x720.jpg', 1, '2016-10-13 09:49:13', '2017-12-16 09:48:19'),
(2, 'Nature', 'Nature gallery', 'published', 1, 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513483-misty-mountains-1280x720.jpg', 1, '2016-10-13 09:56:07', '2017-12-16 16:59:53'),
(3, 'New Day', 'This is demo gallery', 'published', 1, 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520418-supergirl-season-2-1280x720.jpg', 1, '2016-10-13 09:56:44', '2017-12-16 09:48:19'),
(4, 'Morning', 'Hello', 'published', 1, 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513486-power-rangers-red-ranger-4k-1280x720.jpg', 1, '2016-10-13 09:57:30', '2017-12-16 09:48:19'),
(5, 'Happy day', 'Demo', 'published', 1, 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513488-spectacular-sunrise-4k-1280x720.jpg', 1, '2016-10-13 09:58:11', '2017-12-16 09:48:19'),
(6, 'Perfect', 'This is perfect description', 'published', 1, 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513493-world-of-tanks-football-event-1280x720.jpg', 1, '2016-10-13 09:58:40', '2017-12-16 09:48:20'),
(7, 'Nhiếp ảnh', 'Bộ sưu tập nhiếp ảnh', 'published', 1, 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476521053-volkswagen-id-paris-motor-show-4k-1280x720.jpg', 1, '2017-12-16 17:02:39', '2017-12-16 17:03:25'),
(8, 'Thiên nhiên', 'Bộ sưu tập ảnh thiên nhiên', 'published', 1, 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513483-misty-mountains-1280x720.jpg', 1, '2017-12-16 17:03:19', '2017-12-16 17:03:19'),
(9, 'Ngày mới', 'Bộ sưu tập ảnh ngày mới', 'published', 1, 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520418-supergirl-season-2-1280x720.jpg', 1, '2017-12-16 17:03:48', '2017-12-16 17:03:48'),
(10, 'Buổi sáng', 'Bộ sưu tập ảnh buổi sáng', 'published', 1, 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513486-power-rangers-red-ranger-4k-1280x720.jpg', 1, '2017-12-16 17:04:20', '2017-12-16 17:04:20'),
(11, 'Ngày hạnh phúc', 'Bộ sưu tập ảnh ngày hạnh phúc', 'published', 1, 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513488-spectacular-sunrise-4k-1280x720.jpg', 1, '2017-12-16 17:04:43', '2017-12-16 17:04:43'),
(12, 'Hoàn hảo', 'Bộ sưu tập ảnh hoàn hảo', 'published', 1, 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513493-world-of-tanks-football-event-1280x720.jpg', 1, '2017-12-16 17:05:01', '2017-12-16 17:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_meta`
--

CREATE TABLE `gallery_meta` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_id` int(10) UNSIGNED NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci,
  `reference` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_meta`
--

INSERT INTO `gallery_meta` (`id`, `content_id`, `images`, `reference`, `created_at`, `updated_at`) VALUES
(70, 1, '[{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476521053-volkswagen-id-paris-motor-show-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520641-elena-siberian-tigress-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520418-supergirl-season-2-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513493-world-of-tanks-football-event-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513490-tulips-4k-8k-768x1280.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513488-spectacular-sunrise-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513486-power-rangers-red-ranger-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513484-power-rangers-blue-ranger-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513483-misty-mountains-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513478-bmw-x2-paris-auto-show-2016-4k-1280x720.jpg\",\"description\":null}]', 'gallery', '2017-12-16 10:00:24', '2018-01-17 18:33:32'),
(71, 2, '[{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476521053-volkswagen-id-paris-motor-show-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520641-elena-siberian-tigress-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520418-supergirl-season-2-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513493-world-of-tanks-football-event-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513490-tulips-4k-8k-768x1280.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513488-spectacular-sunrise-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513486-power-rangers-red-ranger-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513484-power-rangers-blue-ranger-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513483-misty-mountains-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513478-bmw-x2-paris-auto-show-2016-4k-1280x720.jpg\",\"description\":null}]', 'gallery', '2017-12-16 10:04:54', '2017-12-16 16:59:53'),
(72, 3, '[{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476521053-volkswagen-id-paris-motor-show-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520641-elena-siberian-tigress-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520418-supergirl-season-2-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513493-world-of-tanks-football-event-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513490-tulips-4k-8k-768x1280.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513488-spectacular-sunrise-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513486-power-rangers-red-ranger-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513484-power-rangers-blue-ranger-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513483-misty-mountains-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513478-bmw-x2-paris-auto-show-2016-4k-1280x720.jpg\",\"description\":null}]', 'gallery', '2017-12-16 10:05:05', '2017-12-16 10:05:05'),
(73, 4, '[{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476521053-volkswagen-id-paris-motor-show-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520641-elena-siberian-tigress-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520418-supergirl-season-2-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513493-world-of-tanks-football-event-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513490-tulips-4k-8k-768x1280.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513488-spectacular-sunrise-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513486-power-rangers-red-ranger-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513484-power-rangers-blue-ranger-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513483-misty-mountains-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513478-bmw-x2-paris-auto-show-2016-4k-1280x720.jpg\",\"description\":null}]', 'gallery', '2017-12-16 10:05:13', '2017-12-16 10:05:13'),
(74, 5, '[{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476521053-volkswagen-id-paris-motor-show-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520641-elena-siberian-tigress-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520418-supergirl-season-2-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513493-world-of-tanks-football-event-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513490-tulips-4k-8k-768x1280.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513488-spectacular-sunrise-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513486-power-rangers-red-ranger-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513484-power-rangers-blue-ranger-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513483-misty-mountains-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513478-bmw-x2-paris-auto-show-2016-4k-1280x720.jpg\",\"description\":null}]', 'gallery', '2017-12-16 10:05:21', '2017-12-16 10:05:21'),
(75, 6, '[{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476521053-volkswagen-id-paris-motor-show-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520641-elena-siberian-tigress-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520418-supergirl-season-2-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513493-world-of-tanks-football-event-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513490-tulips-4k-8k-768x1280.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513488-spectacular-sunrise-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513486-power-rangers-red-ranger-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513484-power-rangers-blue-ranger-4k-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513483-misty-mountains-1280x720.jpg\",\"description\":null},{\"img\":\"https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513478-bmw-x2-paris-auto-show-2016-4k-1280x720.jpg\",\"description\":null}]', 'gallery', '2017-12-16 10:05:28', '2017-12-16 10:05:28'),
(77, 8, NULL, 'gallery', '2017-12-16 17:03:19', '2017-12-16 17:03:19'),
(78, 7, NULL, 'gallery', '2017-12-16 17:03:25', '2017-12-16 17:03:25'),
(79, 9, NULL, 'gallery', '2017-12-16 17:03:48', '2017-12-16 17:03:48'),
(80, 10, NULL, 'gallery', '2017-12-16 17:04:20', '2017-12-16 17:04:20'),
(81, 11, NULL, 'gallery', '2017-12-16 17:04:43', '2017-12-16 17:04:43'),
(82, 12, NULL, 'gallery', '2017-12-16 17:05:01', '2017-12-16 17:05:01'),
(85, 79, NULL, 'post', '2017-12-16 17:56:46', '2017-12-16 17:56:46'),
(86, 80, NULL, 'post', '2017-12-16 18:07:16', '2017-12-16 18:07:16'),
(87, 75, NULL, 'post', '2017-12-17 18:37:49', '2017-12-17 18:37:49'),
(88, 81, NULL, 'post', '2017-12-18 18:43:36', '2017-12-18 18:43:36'),
(89, 82, NULL, 'post', '2017-12-18 18:44:57', '2017-12-18 18:44:57'),
(92, 44, NULL, 'post', '2018-04-13 09:38:58', '2018-04-13 09:38:58'),
(94, 48, NULL, 'post', '2018-04-13 09:40:18', '2018-04-13 09:40:18'),
(96, 49, NULL, 'post', '2018-04-13 09:41:32', '2018-04-13 09:41:32'),
(98, 50, NULL, 'post', '2018-04-13 09:42:27', '2018-04-13 09:42:27'),
(122, 51, NULL, 'post', '2018-04-13 09:58:23', '2018-04-13 09:58:23'),
(123, 52, NULL, 'post', '2018-04-13 10:02:20', '2018-04-13 10:02:20'),
(125, 53, NULL, 'post', '2018-04-13 10:03:07', '2018-04-13 10:03:07'),
(129, 54, NULL, 'post', '2018-04-13 10:04:20', '2018-04-13 10:04:20'),
(130, 55, NULL, 'post', '2018-04-13 10:06:40', '2018-04-13 10:06:40'),
(131, 1, NULL, 'page', '2019-03-11 19:30:22', '2019-03-11 19:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `lang_id` int(10) UNSIGNED NOT NULL,
  `lang_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_locale` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_flag` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `lang_order` int(11) NOT NULL DEFAULT '0',
  `lang_is_rtl` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`lang_id`, `lang_name`, `lang_locale`, `lang_code`, `lang_flag`, `lang_is_default`, `lang_order`, `lang_is_rtl`) VALUES
(44, 'English', 'en', 'en_US', 'us', 1, 0, 0),
(45, 'Tiếng Việt', 'vi', 'vi', 'vn', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `language_meta`
--

CREATE TABLE `language_meta` (
  `lang_meta_id` int(10) UNSIGNED NOT NULL,
  `lang_meta_content_id` int(10) UNSIGNED NOT NULL,
  `lang_meta_code` text COLLATE utf8mb4_unicode_ci,
  `lang_meta_reference` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_meta_origin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language_meta`
--

INSERT INTO `language_meta` (`lang_meta_id`, `lang_meta_content_id`, `lang_meta_code`, `lang_meta_reference`, `lang_meta_origin`) VALUES
(3, 4, 'en_US', 'post', 'a9d40e38f773df46bfe3857c89404a5f'),
(4, 5, 'en_US', 'post', '9cf3508b0becc5829411b251ab1d7d68'),
(5, 6, 'en_US', 'post', '14ea2c977bff486d5d93caeeddb25433'),
(6, 7, 'en_US', 'post', '1e3d1a0e8a2d0b0a820f6fa5ff37913b'),
(7, 8, 'en_US', 'post', 'efa2fcd9b0bc7221fc37de650db1095d'),
(8, 9, 'en_US', 'post', '5aa291a9490cf5a6b770e4ef67eecf51'),
(9, 10, 'en_US', 'post', 'ddf6b2634ac599fca598c9f707d7e967'),
(10, 11, 'en_US', 'post', '0162b0f534be9b5c0de3a2c21ee12a22'),
(11, 12, 'en_US', 'post', '58d24bc8ca3ef58e26b6f5f2e97feb52'),
(13, 14, 'en_US', 'post', '6a95efc9f3493402f6edc17125a5f621'),
(14, 19, 'en_US', 'post', 'be26223edcf68e5f63a1a6437ba0be15'),
(15, 15, 'en_US', 'post', '36292b94b5bc330e88721f87c05e3d1c'),
(16, 16, 'en_US', 'post', 'e4bc15912ab7551f41dda75cab017005'),
(17, 17, 'en_US', 'post', '73bd326091a134d6eb79570db924bb3d'),
(18, 18, 'en_US', 'post', '77999a905526eb38febac6a1e0f1f5d9'),
(19, 20, 'en_US', 'post', '26af70c0ef781166972928bd181ab10b'),
(20, 21, 'en_US', 'post', '3856d68ccb4721e6432dcc1ee7001e20'),
(21, 44, 'vi', 'post', 'a9d40e38f773df46bfe3857c89404a5f'),
(22, 45, 'vi', 'post', '9cf3508b0becc5829411b251ab1d7d68'),
(23, 47, 'vi', 'post', '14ea2c977bff486d5d93caeeddb25433'),
(24, 46, 'vi', 'post', 'efa2fcd9b0bc7221fc37de650db1095d'),
(25, 11, 'en_US', 'category', '4703171c553ee525c3a5436c254619cf'),
(26, 1, 'en_US', 'category', 'ff750ed85cf1ac627f2b323889f78dd6'),
(27, 6, 'en_US', 'category', '5d21f76eddb6b3d536cb390f4cda77bc'),
(28, 7, 'en_US', 'category', 'cd22dfa504c9bf620938f913773df770'),
(29, 8, 'en_US', 'category', 'da650dfca58083229317df283b16fa02'),
(30, 9, 'en_US', 'category', 'faa61a3d1e5630da1dc2cdcb4f11b552'),
(31, 10, 'en_US', 'category', '55be2035a27da7bfcc8ed4aeab28f4f1'),
(32, 5, 'en_US', 'tag', 'f0698ed728cc9c18387840b72346e005'),
(33, 6, 'en_US', 'tag', 'e4ef34ee9099a01fcec8f45a79c5d4ba'),
(34, 1, 'en_US', 'gallery', 'b5956d5eec65f9edeb008fdd97771f3e'),
(35, 2, 'en_US', 'gallery', '4367a6d49e1eb6e5fb64d77052997e9c'),
(36, 3, 'en_US', 'gallery', '0cc8e19b35bb9b0a6b0b45d8a358ee6c'),
(37, 4, 'en_US', 'gallery', 'a2879f55a54f0e629851df6b48f61241'),
(38, 5, 'en_US', 'gallery', 'e6ceb4ae110f3d66f9444211a2ac8337'),
(39, 6, 'en_US', 'gallery', '9f2f8e1a4752378951cc1312b419c102'),
(40, 1, 'en_US', 'menu', '19848c17b2e0b8fd374ae6f4741599c4'),
(41, 3, 'en_US', 'menu', '5d79633980667117eaee456018277ad8'),
(42, 7, 'en_US', 'menu', 'b1ae8e07383b5d47e821dac905c86e6d'),
(43, 8, 'en_US', 'menu', '78d39e8989bebaa53bac83ff0fedc678'),
(44, 9, 'en_US', 'menu', '33a202bdbd1d82470cc1837e85622c5e'),
(45, 10, 'vi', 'menu', '19848c17b2e0b8fd374ae6f4741599c4'),
(47, 23, 'en_US', 'page', '0bff9f3639cec70a3f65fc0149ad2b24'),
(48, 1, 'en_US', 'page', '3e971ce162e3737ae2b7af1e78c4bca2'),
(49, 17, 'vi', 'page', '3e971ce162e3737ae2b7af1e78c4bca2'),
(50, 7, 'vi', 'tag', 'f5a7aacaa745d7b1df533180f61bab95'),
(51, 1, 'en_US', 'block', '671424045986775272d0ceb6aab7139a'),
(52, 7, 'vi', 'gallery', 'b5956d5eec65f9edeb008fdd97771f3e'),
(53, 8, 'vi', 'gallery', '4367a6d49e1eb6e5fb64d77052997e9c'),
(54, 9, 'vi', 'gallery', '0cc8e19b35bb9b0a6b0b45d8a358ee6c'),
(55, 10, 'vi', 'gallery', 'a2879f55a54f0e629851df6b48f61241'),
(56, 11, 'vi', 'gallery', 'e6ceb4ae110f3d66f9444211a2ac8337'),
(57, 12, 'vi', 'gallery', '9f2f8e1a4752378951cc1312b419c102'),
(58, 12, 'vi', 'category', 'ff750ed85cf1ac627f2b323889f78dd6'),
(59, 13, 'vi', 'category', '5d21f76eddb6b3d536cb390f4cda77bc'),
(60, 14, 'vi', 'category', 'faa61a3d1e5630da1dc2cdcb4f11b552'),
(61, 15, 'vi', 'category', '4703171c553ee525c3a5436c254619cf'),
(62, 16, 'vi', 'category', 'cd22dfa504c9bf620938f913773df770'),
(63, 17, 'vi', 'category', 'da650dfca58083229317df283b16fa02'),
(64, 18, 'vi', 'category', '55be2035a27da7bfcc8ed4aeab28f4f1'),
(65, 48, 'vi', 'post', '1e3d1a0e8a2d0b0a820f6fa5ff37913b'),
(66, 49, 'vi', 'post', '5aa291a9490cf5a6b770e4ef67eecf51'),
(67, 50, 'vi', 'post', 'ddf6b2634ac599fca598c9f707d7e967'),
(68, 51, 'vi', 'post', '0162b0f534be9b5c0de3a2c21ee12a22'),
(69, 11, 'vi', 'tag', 'f0698ed728cc9c18387840b72346e005'),
(75, 24, 'vi', 'tag', 'e4ef34ee9099a01fcec8f45a79c5d4ba'),
(76, 25, 'en_US', 'tag', 'f5a7aacaa745d7b1df533180f61bab95'),
(77, 52, 'vi', 'post', '58d24bc8ca3ef58e26b6f5f2e97feb52'),
(78, 53, 'vi', 'post', '6a95efc9f3493402f6edc17125a5f621'),
(79, 54, 'vi', 'post', '36292b94b5bc330e88721f87c05e3d1c'),
(80, 55, 'vi', 'post', 'e4bc15912ab7551f41dda75cab017005'),
(81, 6, 'en_US', 'menu', '3deb9e726e379790dcb23e6b0cf26e8f'),
(82, 2, 'vi', 'menu_location', 'b8c6f006a28da7585aef81e9405306bd'),
(83, 3, 'en_US', 'menu_location', '3e08298053dbd3ea6ae1a6673f14f305'),
(84, 1, 'en_US', 'menu_location', '9b3f18ba090b776d3bbac1b450c9ab6a');

-- --------------------------------------------------------

--
-- Table structure for table `media_files`
--

CREATE TABLE `media_files` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `mime_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_files`
--

INSERT INTO `media_files` (`id`, `user_id`, `name`, `folder_id`, `mime_type`, `size`, `url`, `options`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '33901979_1657601214357098_274575820419235840_n', 0, 'image/jpeg', 236833, '/uploads/1/33901979-1657601214357098-274575820419235840-n.jpg', '[]', '2018-07-04 00:48:22', '2018-07-04 00:48:35', '2018-07-04 00:48:35'),
(2, 1, 'IMG_0334', 0, 'image/jpeg', 1359089, 'storage/uploads/img-0334.JPG', '[]', '2019-05-12 02:38:40', '2019-05-12 02:38:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media_folders`
--

CREATE TABLE `media_folders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_settings`
--

CREATE TABLE `media_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `media_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `last_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_activity_logs`
--

CREATE TABLE `member_activity_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `action` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `reference_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_password_resets`
--

CREATE TABLE `member_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Main menu', 'main-menu', 'published', '2016-06-17 17:53:45', '2016-08-14 20:25:34'),
(3, 'Top Right Menu', 'right-menu', 'published', '2016-08-03 03:20:10', '2016-09-27 08:30:46'),
(6, 'Social', 'social', 'published', '2016-10-19 23:26:54', '2016-10-19 23:26:54'),
(7, 'Favorite website', 'favorite-website', 'published', '2016-10-21 10:21:23', '2016-10-21 10:21:23'),
(8, 'My links', 'my-links', 'published', '2016-10-21 10:24:36', '2016-10-21 10:24:36'),
(9, 'Featured Categories', 'featured-categories', 'published', '2016-10-21 10:52:59', '2016-10-21 10:52:59'),
(10, 'Menu chính', 'menu-chinh', 'published', '2016-11-15 00:56:14', '2016-11-15 00:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `menu_locations`
--

CREATE TABLE `menu_locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `location` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_locations`
--

INSERT INTO `menu_locations` (`id`, `menu_id`, `location`, `created_at`, `updated_at`) VALUES
(1, 1, 'main-menu', '2018-11-29 09:19:48', '2018-11-29 09:19:48'),
(2, 10, 'main-menu', '2018-11-29 09:19:55', '2018-11-29 09:19:55'),
(3, 6, 'header-menu', '2018-11-29 09:20:42', '2018-11-29 09:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `menu_nodes`
--

CREATE TABLE `menu_nodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `related_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `type` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_font` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_class` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `has_child` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_nodes`
--

INSERT INTO `menu_nodes` (`id`, `menu_id`, `parent_id`, `related_id`, `type`, `url`, `icon_font`, `position`, `title`, `css_class`, `target`, `has_child`, `created_at`, `updated_at`) VALUES
(543, 3, 0, 5, 'page', '', '', 4, '', '', '_self', 0, '2016-09-27 08:40:29', '2016-11-06 18:35:31'),
(544, 3, 0, 1, 'page', '', '', 5, 'Contact', '', '_self', 0, '2016-09-27 08:40:29', '2016-10-15 18:45:57'),
(545, 1, 0, 0, 'custom-link', '', '', 0, 'Home', '', '_self', 0, '2016-09-27 09:16:52', '2016-09-27 09:27:13'),
(557, 3, 0, 7, 'category', '', '', 3, 'Projects', '', '_self', 0, '2016-09-27 09:31:43', '2016-10-15 18:45:57'),
(558, 3, 0, 8, 'category', '', '', 2, 'Portfolio', '', '_self', 0, '2016-09-27 09:32:22', '2016-10-15 18:45:57'),
(559, 3, 0, 0, 'custom-link', '/downloads', '', 1, 'Downloads', '', '_self', 0, '2016-09-30 21:32:32', '2016-10-15 18:45:57'),
(560, 3, 0, 0, 'custom-link', '/galleries', '', 0, 'Galleries', '', '_self', 0, '2016-10-15 18:45:57', '2016-10-15 18:45:57'),
(562, 1, 561, 6, 'category', '', '', 0, 'Events', '', '_self', 0, '2016-10-19 08:09:16', '2016-10-19 08:09:16'),
(563, 1, 566, 8, 'category', '', '', 0, 'Portfolio', '', '_self', 0, '2016-10-19 08:09:16', '2016-10-21 10:26:25'),
(564, 1, 566, 7, 'category', '', '', 1, 'Projects', '', '_self', 0, '2016-10-19 08:09:16', '2016-10-21 10:26:25'),
(565, 1, 561, 10, 'category', '', '', 2, 'Resources', '', '_self', 0, '2016-10-19 08:09:16', '2016-10-19 08:10:27'),
(566, 1, 0, 0, 'custom-link', '/galleries', '', 3, 'Galleries', '', '_self', 0, '2016-10-19 08:09:16', '2017-12-08 19:39:34'),
(567, 1, 561, 9, 'category', '', '', 1, 'Business', '', '_self', 0, '2016-10-19 08:09:50', '2016-10-19 08:09:50'),
(568, 1, 0, 1, 'page', '', '', 4, 'Contact', '', '_self', 0, '2016-10-19 08:10:27', '2017-12-08 19:39:34'),
(569, 1, 0, 0, 'custom-link', 'https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182?ref=botble', '', 1, 'Purchase', '', '_blank', 0, '2016-10-19 08:11:43', '2016-11-19 02:26:19'),
(571, 6, 0, 0, 'custom-link', 'https://facebook.com', 'fa fa-facebook', 0, 'Facebook', '', '_self', 0, '2016-10-19 23:28:25', '2016-10-19 23:28:25'),
(572, 6, 0, 0, 'custom-link', 'https://twitter.com', 'fa fa-twitter', 1, 'Twitter', '', '_self', 0, '2016-10-19 23:28:26', '2016-10-19 23:28:26'),
(573, 6, 0, 0, 'custom-link', 'https://plus.google.com', 'fa fa-google-plus', 2, 'Google Plus', '', '_self', 0, '2016-10-19 23:29:24', '2016-10-19 23:29:24'),
(574, 6, 0, 0, 'custom-link', 'https://github.com', 'fa fa-github', 3, 'Github', '', '_self', 0, '2016-10-19 23:29:24', '2016-10-19 23:29:24'),
(575, 7, 0, 0, 'custom-link', 'http://speckyboy.com', '', 0, 'Speckyboy Magazine', '', '_self', 0, '2016-10-21 10:24:16', '2016-10-21 10:24:16'),
(576, 7, 0, 0, 'custom-link', 'http://tympanus.com', '', 1, 'Tympanus-Codrops', '', '_self', 0, '2016-10-21 10:24:16', '2016-10-21 10:24:16'),
(577, 7, 0, 0, 'custom-link', 'https://kipalog.com/', '', 2, 'Kipalog Blog', '', '_self', 0, '2016-10-21 10:24:16', '2016-10-21 10:24:16'),
(578, 7, 0, 0, 'custom-link', 'http://www.sitepoint.com', '', 3, 'SitePoint', '', '_self', 0, '2016-10-21 10:24:16', '2016-10-21 10:24:16'),
(579, 7, 0, 0, 'custom-link', 'http://www.creativebloq.com/', '', 4, 'CreativeBloq', '', '_self', 0, '2016-10-21 10:24:16', '2016-10-21 10:24:16'),
(580, 7, 0, 0, 'custom-link', 'http://techtalk.vn', '', 5, 'Techtalk', '', '_self', 0, '2016-10-21 10:24:16', '2016-10-21 10:24:16'),
(581, 8, 0, 0, 'custom-link', '/', '', 0, 'Homepage', '', '_self', 0, '2016-10-21 10:25:49', '2016-10-21 10:25:49'),
(582, 8, 0, 11, 'category', '', '', 1, 'New & Updates', '', '_self', 0, '2016-10-21 10:25:49', '2016-10-21 10:25:49'),
(583, 8, 0, 0, 'custom-link', '/galleries', '', 2, 'Galleries', '', '_self', 0, '2016-10-21 10:25:49', '2016-10-21 10:25:49'),
(584, 8, 0, 1, 'page', '', '', 3, 'Contact', '', '_self', 0, '2016-10-21 10:25:49', '2016-10-21 10:25:49'),
(585, 8, 0, 11, 'category', '', '', 4, 'New & Updates', '', '_self', 0, '2016-10-21 10:25:49', '2016-10-21 10:25:49'),
(586, 8, 0, 7, 'category', '', '', 5, 'Projects', '', '_self', 0, '2016-10-21 10:25:49', '2016-10-21 10:25:49'),
(587, 9, 0, 9, 'category', '', '', 0, 'Business', '', '_self', 0, '2016-10-21 10:53:16', '2016-10-21 10:53:16'),
(588, 9, 0, 6, 'category', '', '', 1, 'Events', '', '_self', 0, '2016-10-21 10:53:16', '2016-10-21 10:53:16'),
(589, 9, 0, 11, 'category', '', '', 2, 'New & Updates', '', '_self', 0, '2016-10-21 10:53:16', '2016-10-21 10:53:16'),
(590, 9, 0, 8, 'category', '', '', 3, 'Portfolio', '', '_self', 0, '2016-10-21 10:53:16', '2016-10-21 10:53:16'),
(591, 9, 0, 7, 'category', '', '', 4, 'Projects', '', '_self', 0, '2016-10-21 10:53:16', '2016-10-21 10:53:16'),
(592, 9, 0, 10, 'category', '', '', 5, 'Resources', '', '_self', 0, '2016-10-21 10:53:16', '2016-10-21 10:53:16'),
(594, 10, 0, 17, 'page', '', '', 4, 'Liên hệ', '', '_self', 0, '2016-11-15 01:12:57', '2016-11-19 02:19:35'),
(600, 10, 0, 0, 'custom-link', '/vi', '', 0, 'Trang chủ', '', '_self', 0, '2016-11-19 02:26:19', '2018-08-03 00:55:50'),
(601, 10, 0, 0, 'custom-link', 'https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182?ref=botble', '', 1, 'Mua ngay', '', '_blank', 0, '2016-11-19 02:26:19', '2016-11-19 02:26:19'),
(602, 10, 0, 11, 'category', '', '', 2, 'Tin tức', '', '_self', 0, '2016-11-19 02:26:19', '2016-11-25 07:52:21'),
(603, 10, 602, 6, 'category', '', '', 0, 'Sự kiện', '', '_self', 0, '2016-11-19 02:26:19', '2016-11-25 07:52:21'),
(604, 10, 602, 9, 'category', '', '', 1, 'Doanh nghiệp', '', '_self', 0, '2016-11-19 02:26:19', '2016-11-25 07:52:21'),
(605, 10, 602, 10, 'category', '', '', 2, 'Tài nguyên', '', '_self', 0, '2016-11-19 02:26:19', '2016-11-25 07:52:21'),
(606, 10, 0, 0, 'custom-link', '/vi/galleries', '', 3, 'Thư viện ảnh', '', '_self', 0, '2016-11-19 02:26:19', '2018-08-03 00:55:50'),
(607, 10, 606, 8, 'category', '', '', 0, 'Cá nhân', '', '_self', 0, '2016-11-19 02:26:19', '2016-11-25 07:52:21'),
(608, 10, 606, 7, 'category', '', '', 1, 'Dự án', '', '_self', 0, '2016-11-19 02:26:19', '2016-11-25 07:52:21'),
(609, 1, 0, 11, 'category', '', '', 2, 'New & Updates', '', '_self', 0, '2017-12-08 19:39:34', '2018-01-17 18:35:53');

-- --------------------------------------------------------

--
-- Table structure for table `meta_boxes`
--

CREATE TABLE `meta_boxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_id` int(10) UNSIGNED NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci,
  `reference` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meta_boxes`
--

INSERT INTO `meta_boxes` (`id`, `content_id`, `meta_key`, `meta_value`, `reference`, `created_at`, `updated_at`) VALUES
(1, 4, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'post', '2017-12-11 09:07:56', '2017-12-11 09:07:56'),
(2, 1, 'seo_meta', '[{\"seo_title\":null,\"seo_description\":null}]', 'page', '2018-01-17 18:35:24', '2019-03-11 19:30:22'),
(3, 12, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'category', '2018-04-13 09:02:12', '2018-04-13 09:02:12'),
(4, 13, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'category', '2018-04-13 09:04:30', '2018-04-13 09:04:30'),
(5, 14, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'category', '2018-04-13 09:04:49', '2018-04-13 09:04:49'),
(6, 15, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'category', '2018-04-13 09:05:06', '2018-04-13 09:05:06'),
(7, 16, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'category', '2018-04-13 09:05:23', '2018-04-13 09:05:23'),
(8, 17, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'category', '2018-04-13 09:06:44', '2018-04-13 09:06:44'),
(9, 18, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'category', '2018-04-13 09:08:01', '2018-04-13 09:08:01'),
(10, 44, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'post', '2018-04-13 09:38:58', '2018-04-13 09:38:58'),
(11, 48, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'post', '2018-04-13 09:40:11', '2018-04-13 09:40:11'),
(12, 49, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'post', '2018-04-13 09:41:28', '2018-04-13 09:41:28'),
(13, 7, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'tag', '2018-04-13 09:41:28', '2018-04-13 09:41:28'),
(14, 50, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'post', '2018-04-13 09:42:20', '2018-04-13 09:42:20'),
(15, 8, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'tag', '2018-04-13 09:42:20', '2018-04-13 09:42:20'),
(16, 9, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'tag', '2018-04-13 09:42:20', '2018-04-13 09:42:20'),
(17, 51, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'post', '2018-04-13 09:43:09', '2018-04-13 09:43:09'),
(18, 10, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'tag', '2018-04-13 09:43:09', '2018-04-13 09:43:09'),
(19, 11, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'tag', '2018-04-13 09:45:22', '2018-04-13 09:45:22'),
(22, 24, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'tag', '2018-04-13 09:59:52', '2018-04-13 09:59:52'),
(23, 25, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'tag', '2018-04-13 10:00:35', '2018-04-13 10:00:35'),
(24, 52, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'post', '2018-04-13 10:02:20', '2018-04-13 10:02:20'),
(25, 53, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'post', '2018-04-13 10:02:59', '2018-04-13 10:02:59'),
(26, 54, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'post', '2018-04-13 10:03:46', '2018-04-13 10:03:46'),
(27, 55, 'seo_meta', '[{\"seo_title\":null,\"seo_keyword\":null,\"seo_description\":null}]', 'post', '2018-04-13 10:06:40', '2018-04-13 10:06:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_04_09_032329_create_base_tables', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(7, '2016_06_01_000004_create_oauth_clients_table', 1),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(9, '2016_06_10_230148_create_acl_tables', 1),
(10, '2016_06_14_230857_create_menus_table', 1),
(11, '2016_06_28_221418_create_pages_table', 1),
(12, '2016_10_05_074239_create_setting_table', 1),
(13, '2016_11_28_032840_create_dashboard_widget_tables', 1),
(14, '2016_12_16_084601_create_widgets_table', 1),
(15, '2017_05_09_070343_create_media_tables', 1),
(16, '2017_11_03_070450_create_slug_table', 1),
(17, '2018_11_03_054815_create_menu_locations_table', 1),
(18, '2018_11_07_151241_update_column_status_for_pages_table', 1),
(19, '2018_11_07_151701_update_column_status_for_menus_table', 1),
(21, '2015_06_29_025744_create_audit_history', 2),
(24, '2015_06_18_033822_create_blog_table', 4),
(25, '2018_11_07_051340_change_status_column_for_blog', 4),
(26, '2018_11_07_154204_remove_unused_column_in_blog_table', 4),
(28, '2016_06_17_091537_create_contacts_table', 5),
(29, '2018_11_08_001804_update_column_status_in_contacts_table', 5),
(32, '2016_10_03_032336_create_languages_table', 7),
(33, '2016_10_13_150201_create_galleries_table', 8),
(34, '2018_11_08_005616_update_status_column_in_galleries_table', 8),
(36, '2017_10_04_140938_create_member_table', 9),
(38, '2016_05_28_112028_create_system_request_logs_table', 11),
(40, '2018_11_24_012701_rename_column_featured_in_blog_tables', 12),
(41, '2018_11_24_012823_rename_column_featured_in_galleries_table', 12),
(42, '2018_11_24_013406_rename_column_featured_in_pages_table', 12),
(43, '2013_04_09_062329_create_revisions_table', 13),
(44, '2019_01_05_053554_create_jobs_table', 13),
(45, '2019_01_18_155032_update_members_table', 13),
(46, '2019_01_20_071422_add_author_type_to_posts_table', 13),
(47, '2019_02_11_055127_create_member_activity_logs_table', 13),
(48, '2019_02_23_064533_create_contact_replies_table', 13),
(49, '2017_02_13_034601_create_blocks_table', 14),
(50, '2018_11_07_150746_update_column_status_for_blocks_table', 14),
(51, '2017_03_27_150646_re_create_custom_field_tables', 15),
(52, '2018_11_08_004530_update_status_column_in_field_groups_table', 15),
(53, '2019_03_14_082019_update_blog_table_name', 16),
(54, '2019_04_05_112137_update_table_members', 17),
(55, '2019_04_06_103857_update_profile_image_column_in_users_table', 17),
(56, '2019_05_27_133842_change_column_status_menus_table', 18),
(57, '2019_05_27_134005_change_column_status_pages_table', 18),
(58, '2019_05_27_134310_change_column_status_blocks_table', 18),
(59, '2019_05_27_134410_change_column_status_posts_table', 18),
(60, '2019_05_27_134446_change_column_status_categories_table', 18),
(61, '2019_05_27_134633_change_column_status_field_groups_table', 18),
(62, '2019_05_27_134724_change_column_status_tags_table', 18),
(63, '2019_05_27_134802_change_column_status_galleries_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'nPvD6nCdZ4u5VDofwCaCrg9DTBpkMOJopp2JjdjR', 'http://localhost', 1, 0, 0, '2018-03-20 21:07:20', '2018-03-20 21:07:20'),
(2, NULL, 'Laravel Password Grant Client', 'yoMn1m1jBDOZAAfwX7qOagkGrAoazmzujgLAfpyI', 'http://localhost', 0, 1, 0, '2018-03-20 21:07:20', '2018-03-20 21:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-03-20 21:07:20', '2018-03-20 21:07:20');

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

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('09a880ccdf4f35761565b221378b611954a090fd48a2a710b1531feccced42a104d7208d38508258', '6ec25d436833eb08e9c574e208ce65ee59561517d49f0ac952d292eb80d976bfb11805a6e28f94dc', 0, '2018-04-20 04:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `user_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `content`, `status`, `user_id`, `image`, `template`, `parent_id`, `is_featured`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Contact', '<p>This is contact page</p>\r\n\r\n<p>[static-block alias=&quot;sample-block&quot;]</p>\r\n\r\n<p>[contact-form][/contact-form]</p>', 'published', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476520641-elena-siberian-tigress-4k-1280x720.jpg', 'default', 0, 0, NULL, '2016-07-09 01:05:39', '2019-03-11 19:30:22'),
(17, 'Liên hệ', '<p>Đ&acirc;y l&agrave; trang li&ecirc;n hệ</p>', 'published', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/galleries/1476513483-misty-mountains-1280x720.jpg', 'default', 0, 0, 'Đây là trang liên hệ', '2016-11-06 18:17:25', '2017-03-20 10:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('minhsang2603@gmail.com', '$2y$10$kWX7Vm.TR02TvQ426QLR2uzK6/JjiYIwE.ruTXH6eBQdS8mV5aL0a', '2018-01-24 03:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `author_id` int(11) NOT NULL,
  `author_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `format_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `name`, `description`, `content`, `status`, `author_id`, `author_type`, `is_featured`, `image`, `views`, `format_type`, `created_at`, `updated_at`) VALUES
(4, '13,000+ People Have Bought Our Theme', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p><iframe src=\"https://www.youtube.com/embed/7MxyPHjyu9A\" width=\"420\" height=\"315\"></iframe></p>\r\n<p>Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There’s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n<p> </p>\r\n<p>Still, she’s got a lot of spirit. I don’t know, what do you think? What!? I don’t know what you’re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan– What good is a reward if you ain’t around to use it? Besides, attacking that battle station ain’t my idea of courage. It’s more like…suicide.</p>\r\n<p>You don’t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you’re going. What?! The Force is strong with this one. I have you now.</p>\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander. There’ll be no one to stop us this time! You’re all clear, kid. Let’s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n<ul>\r\n<li>Dantooine. They’re on Dantooine.</li>\r\n<li>He is here.</li>\r\n<li>Don’t underestimate the Force.</li>\r\n</ul>\r\n<p><img style=\"height: 683px; width: 1024px;\" alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master. But with the blast shield down, I can’t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can’t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n<p>Still, she’s got a lot of spirit. I don’t know, what do you think? What!? I don’t know what you’re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan– What good is a reward if you ain’t around to use it? Besides, attacking that battle station ain’t my idea of courage. It’s more like…suicide.<br /> You don’t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you’re going. What?! The Force is strong with this one. I have you now.</p>\r\n<p> </p>\r\n<ol>\r\n<li>I care. So, what do you think of her, Han?</li>\r\n<li>You mean it controls your actions?</li>\r\n<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you’re going.</li>\r\n<li>I’m trying not to, kid.</li>\r\n</ol>\r\n<h2>Revenge of the Sith</h2>\r\n<p><img style=\"height: 300px; width: 180px;\" alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can’t get involved! I’ve got work to do! It’s not that I like the Empire, I hate it, but there’s nothing I can do about it right now. It’s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I’m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can’t possibly…</p>\r\n<p>Your eyes can deceive you. Don’t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I’m trying not to, kid.</p>\r\n<p>I’m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They’re on Dantooine.</p>\r\n<p> </p>\r\n<p>Still, she’s got a lot of spirit. I don’t know, what do you think? What!? I don’t know what you’re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan– What good is a reward if you ain’t around to use it? Besides, attacking that battle station ain’t my idea of courage. It’s more like…suicide.</p>\r\n<p>Hey, Luke! May the Force be with you. Kid, I’ve flown from one side of this galaxy to the other. I’ve seen a lot of strange stuff, but I’ve never seen anything to make me believe there’s one all-powerful Force controlling everything. There’s no mystical energy field that controls my destiny. It’s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n<p>You don’t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you’re going. What?! The Force is strong with this one. I have you now.</p>\r\n<p> </p>\r\n<p><img style=\"height: 563px; width: 1000px;\" alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n<p> </p>\r\n<p>Hey, Luke! May the Force be with you. Kid, I’ve flown from one side of this galaxy to the other. I’ve seen a lot of strange stuff, but I’ve never seen anything to make me believe there’s one all-powerful Force controlling everything. There’s no mystical energy field that controls my destiny. It’s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain’t in this for your revolution, and I’m not in it for you, Princess. I expect to be well paid. I’m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n<p>All right. Well, take care of yourself, Han. I guess that’s what you’re best at, ain’t it? Alderaan? I’m not going to Alderaan. I’ve got to go home. It’s late, I’m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n<p> </p>\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img style=\"height: 300px; width: 200px;\" alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n<p>WOW, Nice photo !</p>\r\n<p>I need your help, Luke. She needs your help. I’m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can’t possibly… As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you’re going.</p>\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They’re on Dantooine. You’re all clear, kid. Let’s blow this thing and go home! I’m surprised you had the courage to take the responsibility yourself. I’m trying not to, kid.</p>\r\n<p>I care. So, what do you think of her, Han? Don’t underestimate the Force. I don’t know what you’re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan– I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n<p>You’re all clear, kid. Let’s blow this thing and go home! But with the blast shield down, I can’t even see! How am I supposed to fight? Alderaan? I’m not going to Alderaan. I’ve got to go home. It’s late, I’m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476893533-02.jpg', 8, NULL, '2016-08-02 21:34:18', '2017-12-11 09:07:56'),
(5, 'Top Search Engine Optimization Strategies!', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/nmnkzkiyqsygikfjinsb-20140717-212636-3-660x330.jpg', 6, NULL, '2016-08-02 21:36:45', '2017-04-30 19:59:58'),
(6, 'Which Company Would You Choose?', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476893532-01.jpg', 4, NULL, '2016-08-02 21:38:34', '2017-03-21 07:30:39'),
(7, 'Used Car Dealer Sales Tricks Exposed', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/old-car-660x330.jpg', 6, NULL, '2016-08-02 21:39:50', '2017-04-30 20:03:27'),
(8, '20 Ways To Sell Your Product Faster', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476890034-hero04.jpg', 3, NULL, '2016-08-02 21:40:56', '2017-03-21 07:25:09');
INSERT INTO `posts` (`id`, `name`, `description`, `content`, `status`, `author_id`, `author_type`, `is_featured`, `image`, `views`, `format_type`, `created_at`, `updated_at`) VALUES
(9, 'The Secrets Of Rich And Famous Writers', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476890036-hero05.jpg', 0, NULL, '2016-08-02 21:42:45', '2017-03-21 07:26:07'),
(10, 'Imagine Losing 20 Pounds In 14 Days!', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>\r\n', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476890033-hero03.jpg', 7, NULL, '2016-08-02 21:44:20', '2019-04-21 02:32:14'),
(11, 'Are You Still Using That Slow, Old Typewriter?', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476890034-hero04.jpg', 12, NULL, '2016-08-02 21:45:16', '2017-07-06 08:16:25'),
(12, 'A Skin Cream That’s Proven To Work', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476890031-hero02.jpg', 12, NULL, '2016-08-02 21:46:22', '2017-12-10 18:07:55'),
(13, '10 Reasons To Start Your Own, Profitable Website!', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>\r\n', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476890029-hero01.jpg', 15, NULL, '2016-08-02 21:47:18', '2016-12-04 08:07:53');
INSERT INTO `posts` (`id`, `name`, `description`, `content`, `status`, `author_id`, `author_type`, `is_featured`, `image`, `views`, `format_type`, `created_at`, `updated_at`) VALUES
(14, 'Simple Ways To Reduce Your Unwanted Wrinkles!', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/4381851322-d46fd7d75e-b-660x330.jpg', 1, NULL, '2016-08-02 21:50:39', '2019-04-21 02:32:04'),
(15, 'Apple iMac with Retina 5K display review', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476891195-02.jpg', 1, NULL, '2016-08-02 21:51:49', '2017-04-30 20:11:06'),
(16, '10 Reasons To Start Your Own, Profitable Website!', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476891035-01.jpg', 3, NULL, '2016-08-02 21:52:39', '2017-04-30 20:10:12'),
(17, 'Unlock The Secrets Of Selling High Ticket Items', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476891198-04.jpg', 2, NULL, '2016-08-02 21:53:49', '2017-04-30 20:04:28'),
(18, '10,000 Web Site Visitors In One Month:Guaranteed', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476893533-02.jpg', 6, NULL, '2016-08-02 21:54:31', '2019-04-21 02:32:28');
INSERT INTO `posts` (`id`, `name`, `description`, `content`, `status`, `author_id`, `author_type`, `is_featured`, `image`, `views`, `format_type`, `created_at`, `updated_at`) VALUES
(19, 'Are You Still Using That Slow, Old Typewriter?', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476891195-02.jpg', 3, NULL, '2016-08-02 21:55:28', '2017-04-30 20:15:13'),
(20, 'A Skin Cream That’s Proven To Work', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>\r\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476890031-hero02.jpg', 12, NULL, '2016-08-02 21:56:32', '2019-04-21 02:32:10'),
(21, 'Top Search Engine Optimization Strategies!', 'Don’t act so surprised, Your Highness. You weren’t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck.', '<p>Don&rsquo;t act so surprised, Your Highness. You weren&rsquo;t on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. In my experience, there is no such thing as luck. Partially, but it also obeys your commands. I want to come with you to Alderaan. There&rsquo;s nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<blockquote>\r\n<p>We hire people who want to make the best things in the world. -Steve Jobs</p>\r\n</blockquote>\r\n\r\n<p>She must have hidden the plans in the escape pod. Send a detachment down to retrieve them, and see to it personally, Commander.&nbsp;There&rsquo;ll be no one to stop us this time!&nbsp;You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! Partially, but it also obeys your commands.</p>\r\n\r\n<ul>\r\n	<li>Dantooine. They&rsquo;re on Dantooine.</li>\r\n	<li>He is here.</li>\r\n	<li>Don&rsquo;t underestimate the Force.</li>\r\n</ul>\r\n\r\n<p><img alt=\"5825871567_4d477202ce_b\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/5825871567_4d477202ce_b.jpg\" /></p>\r\n\r\n<p>I care. So, what do you think of her, Han? A tremor in the Force. The last time I felt it was in the presence of my old master.&nbsp;But with the blast shield down,&nbsp;I can&rsquo;t even see! How am I supposed to fight? Obi-Wan is here. The Force is with him. But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? You are a part of the Rebel Alliance and a traitor! Take her away!</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.<br />\r\nYou don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I care. So, what do you think of her, Han?</li>\r\n	<li>You mean it controls your actions?</li>\r\n	<li>Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</li>\r\n	<li>I&rsquo;m trying not to, kid.</li>\r\n</ol>\r\n\r\n<h2>Revenge of the Sith</h2>\r\n\r\n<p><img alt=\"post-image\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-180x300.jpg\" />I can&rsquo;t get involved! I&rsquo;ve got work to do! It&rsquo;s not that I like the Empire, I hate it, but there&rsquo;s nothing I can do about it right now. It&rsquo;s such a long way from here. Leave that to me. Send a distress signal, and inform the Senate that all on board were killed. I&rsquo;m surprised you had the courage to take the responsibility yourself. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip;</p>\r\n\r\n<p>Your eyes can deceive you. Don&rsquo;t trust them. He is here. What?! Hokey religions and ancient weapons are no match for a good blaster at your side, kid. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I&rsquo;m trying not to, kid. I have traced the Rebel spies to her. Now she is my only link to finding their secret base. He is here. You are a part of the Rebel Alliance and a traitor! Take her away! Dantooine. They&rsquo;re on Dantooine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Still, she&rsquo;s got a lot of spirit. I don&rsquo;t know, what do you think? What!? I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; What good is a reward if you ain&rsquo;t around to use it? Besides, attacking that battle station ain&rsquo;t my idea of courage. It&rsquo;s more like&hellip;suicide.</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You don&rsquo;t believe in the Force, do you? Obi-Wan is here. The Force is with him. I call it luck. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going. What?! The Force is strong with this one. I have you now.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"9FybtVFNSEOxogGzIvHJ_IMG_2226\" src=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/9FybtVFNSEOxogGzIvHJ_IMG_2226.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hey, Luke! May the Force be with you. Kid, I&rsquo;ve flown from one side of this galaxy to the other. I&rsquo;ve seen a lot of strange stuff, but I&rsquo;ve never seen anything to make me believe there&rsquo;s one all-powerful Force controlling everything. There&rsquo;s no mystical energy field that controls my destiny. It&rsquo;s all a lot of simple tricks and nonsense. Remember, a Jedi can feel the Force flowing through him. He is here. Ye-ha! I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>Oh God, my uncle. How am I ever gonna explain this? Look, I ain&rsquo;t in this for your revolution, and I&rsquo;m not in it for you, Princess. I expect to be well paid. I&rsquo;m in it for the money. A tremor in the Force. The last time I felt it was in the presence of my old master.</p>\r\n\r\n<p>All right. Well, take care of yourself, Han.&nbsp;I guess that&rsquo;s what you&rsquo;re best at,&nbsp;ain&rsquo;t it? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is. The plans you refer to will soon be back in our hands.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://themes.tielabs.com/wp-content/uploads/sites/3/2015/01/post-image-2.jpg\"><img alt=\"WOW, Nice photo !\" src=\"http://themes.tielabs.com/sahifa5/wp-content/uploads/sites/3/2015/01/post-image-2-200x300.jpg\" /></a></p>\r\n\r\n<p>WOW, Nice photo !</p>\r\n\r\n<p>I need your help, Luke. She needs your help. I&rsquo;m getting too old for this sort of thing. Oh God, my uncle. How am I ever gonna explain this? Hey, Luke! May the Force be with you. No! Alderaan is peaceful. We have no weapons. You can&rsquo;t possibly&hellip; As you wish. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you&rsquo;re going.</p>\r\n\r\n<p>I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. Dantooine. They&rsquo;re on Dantooine. You&rsquo;re all clear, kid. Let&rsquo;s blow this thing and go home! I&rsquo;m surprised you had the courage to take the responsibility yourself. I&rsquo;m trying not to, kid.</p>\r\n\r\n<p>I care. So, what do you think of her, Han? Don&rsquo;t underestimate the Force. I don&rsquo;t know what you&rsquo;re talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan&ndash; I have traced the Rebel spies to her. Now she is my only link to finding their secret base.</p>\r\n\r\n<p>You&rsquo;re all clear, kid.&nbsp;Let&rsquo;s blow this thing and go home!&nbsp;But with the blast shield down, I can&rsquo;t even see! How am I supposed to fight? Alderaan? I&rsquo;m not going to Alderaan. I&rsquo;ve got to go home. It&rsquo;s late, I&rsquo;m in for it as it is.</p>\r\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476891035-01.jpg', 7, NULL, '2016-08-02 21:57:29', '2016-12-10 12:04:30'),
(44, '13000 người đã mua Theme của chúng tôi', 'Đây là bài viết mẫu, nội dung của những bài viết demo đều giống nhau, nó được dùng với mục đích làm ví dụ, các bài viết hiện tại trên trang demo đều có nội dung giống nhau về phần nội dung và mô tả ngắn.', '<p>Hi mọi người,  dạo gần đây mình không viết blog mới vì tập trung phát triển Botble CMS. Sau bao cố gắng thì hôm nay mình đã có thể release version 2.0 với nhiều tính năng mới.</p>\r\n<p>Ở bản 1.0, mình cảm thấy nó có quá nhiều tính năng phức tạp, chỉ phù hợp với hệ thống lớn mà đa số các website nhỏ không cần đến, vì vậy mình đã đơn giản bớt đi trong phần này và tập trung làm sao cho Botble CMS dễ sử dụng nhất.</p>\r\n<p>Botble CMS đang sử dụng Laravel phiên bản mới nhất tại thời điểm này 5.3.</p>\r\n<h3>Demo:</h3>\r\n<p>Homepage: <a href=\"http://cms.botble.com/\">http://cms.botble.com</a></p>\r\n<p>Admin: <a href=\"http://cms.botble.com/admin\">http://cms.botble.com/admin</a></p>\r\n<p>Account: botble - 159357</p>\r\n<p> </p>\r\n<h3>Cấu trúc thư mục:</h3>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Core-700x328.png\" alt=\"core\" /></p>\r\n<p>Botble version 2 đã được tổ chức thành từng module theo dạng HMVC và nằm hoàn toàn trong thư mục /core. Những thư mục khác hầu hết được giữ nguyên hiện trạng như bản cài mới laravel. Điều này giúp dễ dàng hơn trong việc cập nhật, nâng cấp sau này.</p>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Theme-700x326.png\" alt=\"theme\" /></p>\r\n<p>Tách biệt thư mục theme và chuẩn cấu trúc theme.</p>\r\n<p> </p>\r\n<p>Mình xin nói sơ qua một số tính năng mới trong bản này.</p>\r\n<ol>\r\n<li>\r\n<h3>Hỗ trợ cài đặt.</h3>\r\n</li>\r\n</ol>\r\n<p>Nhiều người gặp khó khăn trong việc cài đặt Botble, đa số đó là những người mới làm quen laravel. Vì vậy mình đã viết 1 đoạn script để hỗ trợ cài đặt nhanh chóng qua command line.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/DAZe2V_A0wo?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<h3>2. Tạo 1 module/plugin mới một cách nhanh chóng với CRUD và permissions.</h3>\r\n<p><iframe src=\"https://www.youtube.com/embed/8F4wfrS9svs?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Việc loại bỏ 1 module không cần thiết cũng đơn giản hơn bao giờ hết.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/jmex2G4eC18?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Do hơi bận rộn nên mình chỉ có thể quay một số video hướng dẫn trên, sẽ bổ sung sau :D</p>\r\n<h3>3. Theme mới</h3>\r\n<p>Trong bản cập nhật này, nhờ sự giúp đỡ của bạn <a href=\"http://nghiadev.com/\">Minh Nghĩa</a>, Botble front page đã được khoác lên bộ áo mới mà mình đánh giá là đẹp hơn rất nhiều so với theme mặc định cũ.</p>\r\n<p>Một số hình ảnh:</p>\r\n<p><img src=\"https://lh3.googleusercontent.com/GuJDOdVnDbOVIneN9Qwvo5G_CkX8lx09S0fqifpEvWODI5vFPk4qdvqHITQFbKbdlUoZhB1FMaiTS4-qG2c0qKNGnOoj0oe5Gh9bv9xLg_wp_mWFysuKj9R-WQEufFXzYMrwQ30HRnvebvJqeGCBXhU5RatFHTBbv-8lwoWXZVXd3G1eUSOPKn1S1dVTsoXf7XxzFzN-Vny8uypcJxT2ZenVA1jDQ4doIPky0LHLra08TnMJZ8zh4lMSm8r5PiWXPCpLhBr4OhFTWjYk4dMgo19rggDGJvFZnvFwl682bD0EBqbhITdR4tAni-CTiprbroUuBo5aKX3MFnKIMyVQcc5H5tNuJgtieDuVDe0ZjePxvQzwbG-Vzoz7cEMOLp7G23fTG3L_w3Czpt2p8TzE8nsa8xYdu5yWIetxoYfWRGMYQCHtINnbglYDKuK1wFnXu41rzOO8p4y7NF5rksoAuNleDD9RB24JR3a6J2zhOnvRL5EWlq3HlZbUdn7cybXn3rnJY9rWqBjubFUz8d-lPtObLi4dHzYxT6KfDMRzwMXcPx_RxZVc-6ZOEn2e051DsccRfb-IvurAzppoqnYlfxFEUYZMq8c5s-GNeRKOwqXFhEs4=w655-h324-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/0S7CR_aFNK7QzUEf8Oo6gnwBU1htFdqYLWmX5VQHMZusY47Xyk_jim18FiAwWlVz4WVtn56AMhlhTqtNDMdBpVi2w8pc4yShEYs2-5gr9qIDPxylbCOKfQqj-zzGS8kR7v5xBBph55FE5YFXWEnDQEYo0udhhoNAY-nDpmIi3t3Ho_BqUf8U0E13WDUf-Iu-UQSrvUfFqdqmVubGBuuSx6xXtnj3RBwUcoFdHkFihdXneylcNppQRnTPg3bMOcbhPaJt3JQNQmM3SJIS40fG4W1Yc9ALpK1N7GYt2sRcczWQTQRJveezh-zoPY-HACeQIViWXR_hktNrILo5o-3lhvlDy1kiB60elO3mWKA6bmHZstJ5pqEuBNR6A0DlpBJ-bbtqZBDqMVrjVoromcvucN3ybY3zUOWonD5g1_5kRfRo9C451BAMZ0W1uH4u5pmr3qNTcoxJJ55K_cT4X8ZFuqIV3DOooFuXOYQiXqPFpEgl--px4vvdQycJyhdtgrxb4FBff1vyMskx00rmA33a5DSqoBxt_HzzXqBWNTw6VXj0CLhXft6FQ-ojvWaxMMlzFqmB93heEtSrAczb8nTRIlT7fb6q-2MlCr3LxCjd9VhkVyzL=w1344-h662-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/mv9qalSsV8wrJjeugYDvhdVF-WEVfsNahKVIVg8CZ6NfN9tisVjGPch-VyQG4Ij4fCG6Z_LY5B-uwX30pI2BXBre3SxsWHF_v2pF-CwNGiB9Z5jj-_zEbqL5p2vGj3YRsUG2fY9TO1eAWZ-Pf3YiuS55cPdpc52cprwtRFpGBZ0NjpDAefNZYBHvabj5H_Rgg29U7R8KVvJj95bA_Dj12kqbxZFZB6otTfyikWskXTQa6Vy5yEqv7-KlU96jrowouyIQsXER0FaedD2X6aHPvA6dFhVmK5lJ9LwVr01Ani16vqjOcDf__FCh6o5iPTkLFPCccLPBhtT4kd2AotQCyopvmH8wyewYLFeG6mNi6bEnh35UfPix500VPTviZkW4UVMy5dIOWHalfdO7VXkbGIq--dsO7H9OPQ3BHLA5MKmjmER4Wg1Mi8vxI8xm7Rx6mTo8BQBNixAuVBPjgVIEjgUKJGTOFeXNrNVL685EuWTMVfhJSepjxjSNUtEjkeHxy03NjWd_8JUgfVFpr1Yer_5qGjg7zAFOB0XDbNn_nhl-CRZW_pRj4GQ_NwumV2ICD0IMPxOj17bxbA8tpf8rqWo9x__pgyWeeuYUMBWrnH1NfozG=w1345-h670-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/lF39CW32xGI1aCvNJU7eZmIKn94wkt9qiWqjqsaO7DR60azWq94_SnVPWG3cx0bDY-oX-vaZKCa_hA1jvjpZ7JTLVPo1HtYobNArbvP6HcrsBn0oTLs7I25ChfLsdlMI-GywLSMgrx4paTLJxEWuiqXBxkRGA7S59BH_CQ1w53H3cPvD34k3Ps9HxvTetDwjx6YiVe0JAMXGLHjtUYKDwaAi4pSxVnTRDwS84KSm9dTyhdU-I014QSP_RA6gHR8krt2Ddlwr9CaPWc2yAe214G1_gN1inUoTMmI6mZr3vY9qdB5JVLodTNEGtfqgpzy8s-wAGHhjI7JPsWbsa0UEOzS3WBpzbfiOR66L1ops7PiTRjvhr9HMS5er0a3P_lQUK8r7hq37lDMk9nflkyOkzcFhSvRGP6TS83TJR4X95tcal0uTP6pYPeC0C41IpomtXRalqIB9dx1tAQfBWlY9WRhZADnwLIkWxm5U8vqEhXBq6RQFhRBiWlInMwOI01bmInLvioAwd0bohHtNd2yP_pU-WeCu2slVxpG-HTRacW14vvpcBJKGy2k0sjCnngI1FFb8X7NHSdQy_etGkaggWJ2mfgAvD8DzSfNvScchUhbkcqq4=w1353-h669-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>4. Quản lý plugin</h3>\r\n<p><img src=\"https://lh3.googleusercontent.com/03ZeATliabVof9wqnXaoI4a3m52QOYhC7bPpAyUihUpthcH2yilmrA45oX4w5PbG_99bDvy9tKPD0iOrDCqEpEMR0xfHxczuBxLISD96inWaZW6fHo9YMeHZm_8ULpZSQxK5bvORy9iQ2FBT6xBGuYPeVjVOzNcO839cC0ZjnaTxQUozTm8SA4Fe938L4kT4xeNAVYMHourqELmoC1tjgIr8oq66Wze_loZuY35kBZlX8iFGoFiC4gkjO_yT16q4wpeqRzP7rWOdztqmZpZ5wrbTSusbfi1Dn2ghIABvS4uqrF7gi_JIL9AlSEhnFTHY7QaDH4Q7N8m3r3n2rZWD43iaRIauOm4mXgP1XpaTzZjVjehXLfgG8BNNIq56KldAlroHbGblojOS_gPHuYCvsxk3mckq6oHvGLh4_HyxYl7JAuG0hYxN0sIimEd8GehVV-EqNnbPWAocxytigYnX4SiMndGOtVet6o2XvrDLMlHN8ASKxcO59IJ8Se7hzaCfcJ6wQpl5kvJE4oITxA4R-5_1ezvnZDPGt7jyPuIv1wGsks2YJ1apYIBMQEOhKdlCDkqQC_hBx0vLhq8zxgNgptZKv2opfPGZ9j6KQPqNL3khGoRv=w1352-h666-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>5. Sử dụng một số concept của Wordpress</h3>\r\n<p>Như các bạn đã biết, Wordpress có rất nhiều tính năng hay. Vì vậy mình đã áp dụng Filter, Action hook và Metabox vào Botble để có thể dễ dàng hơn cho các bạn can thiệp vào core sau này.</p>\r\n<h3>Kết luận:</h3>\r\n<p>Trên đây là một số tính năng mới của Botble version 2.0, hi vọng các bạn cảm thấy hứng thú với CMS này.</p>\r\n<p>Các bạn có thể mua ủng hộ mình trên Codecanyon https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182 hoặc liên hệ trực tiếp với mình qua skype live:minhsang2603 để được hỗ trợ.</p>\r\n<p> </p>', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476893533-02.jpg', 1, NULL, '2016-11-12 18:25:08', '2018-04-13 09:38:58'),
(45, 'Lên trên Công cụ Tìm kiếm Tối ưu hóa các chiến lược!', 'Đây là bài viết mẫu, nội dung của những bài viết demo đều giống nhau, nó được dùng với mục đích làm ví dụ, các bài viết hiện tại trên trang demo đều có nội dung giống nhau về phần nội dung và mô tả ngắn.', '<p>Hi mọi người, &nbsp;dạo gần đ&acirc;y m&igrave;nh kh&ocirc;ng viết blog mới v&igrave; tập trung ph&aacute;t triển Botble CMS. Sau bao cố gắng th&igrave; h&ocirc;m nay m&igrave;nh đ&atilde; c&oacute; thể release version 2.0 với nhiều t&iacute;nh năng mới.</p>\r\n\r\n<p>Ở bản 1.0, m&igrave;nh cảm thấy n&oacute; c&oacute; qu&aacute; nhiều t&iacute;nh năng phức tạp, chỉ ph&ugrave; hợp với hệ thống lớn m&agrave; đa số c&aacute;c website nhỏ kh&ocirc;ng cần đến, v&igrave; vậy m&igrave;nh đ&atilde; đơn giản bớt đi trong phần n&agrave;y v&agrave; tập trung l&agrave;m sao cho Botble CMS dễ sử dụng nhất.</p>\r\n\r\n<p>Botble CMS đang sử dụng Laravel&nbsp;phi&ecirc;n bản mới nhất tại thời điểm n&agrave;y 5.3.</p>\r\n\r\n<h3>Demo:</h3>\r\n\r\n<p>Homepage:&nbsp;<a href=\"http://cms.botble.com/\">http://cms.botble.com</a></p>\r\n\r\n<p>Admin:&nbsp;<a href=\"http://cms.botble.com/admin\">http://cms.botble.com/admin</a></p>\r\n\r\n<p>Account: botble - 159357</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Cấu tr&uacute;c thư mục:</h3>\r\n\r\n<p><img alt=\"core\" src=\"http://sangplus.com/wp-content/uploads/2016/10/Core-700x328.png\" /></p>\r\n\r\n<p>Botble version 2 đ&atilde; được tổ chức th&agrave;nh từng module theo dạng HMVC v&agrave; nằm ho&agrave;n to&agrave;n trong thư mục /core. Những thư mục kh&aacute;c hầu hết được giữ nguy&ecirc;n hiện trạng như bản c&agrave;i mới laravel. Điều n&agrave;y gi&uacute;p dễ d&agrave;ng hơn trong việc cập nhật, n&acirc;ng cấp sau n&agrave;y.</p>\r\n\r\n<p><img alt=\"theme\" src=\"http://sangplus.com/wp-content/uploads/2016/10/Theme-700x326.png\" /></p>\r\n\r\n<p>T&aacute;ch biệt thư mục theme v&agrave; chuẩn cấu tr&uacute;c theme.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>M&igrave;nh xin n&oacute;i sơ qua một số t&iacute;nh năng mới trong bản n&agrave;y.</p>\r\n\r\n<ol>\r\n	<li>\r\n	<h3>Hỗ trợ c&agrave;i đặt.</h3>\r\n	</li>\r\n</ol>\r\n\r\n<p>Nhiều người gặp kh&oacute; khăn trong việc c&agrave;i đặt Botble, đa số đ&oacute; l&agrave; những người mới l&agrave;m quen laravel. V&igrave; vậy m&igrave;nh đ&atilde; viết 1 đoạn script để hỗ trợ c&agrave;i đặt nhanh ch&oacute;ng qua command line.</p>\r\n\r\n<p><iframe frameborder=\"0\" height=\"506\" src=\"https://www.youtube.com/embed/DAZe2V_A0wo?feature=oembed\" width=\"900\"></iframe></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>2. Tạo 1 module/plugin mới một c&aacute;ch nhanh ch&oacute;ng với CRUD v&agrave; permissions.</h3>\r\n\r\n<p><iframe frameborder=\"0\" height=\"506\" src=\"https://www.youtube.com/embed/8F4wfrS9svs?feature=oembed\" width=\"900\"></iframe></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Việc loại bỏ 1 module kh&ocirc;ng cần thiết cũng đơn giản hơn bao giờ hết.</p>\r\n\r\n<p><iframe frameborder=\"0\" height=\"506\" src=\"https://www.youtube.com/embed/jmex2G4eC18?feature=oembed\" width=\"900\"></iframe></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Do hơi bận rộn n&ecirc;n m&igrave;nh chỉ c&oacute; thể quay một số video hướng dẫn tr&ecirc;n, sẽ bổ sung sau :D</p>\r\n\r\n<h3>3. Theme mới</h3>\r\n\r\n<p>Trong bản cập nhật n&agrave;y, nhờ sự gi&uacute;p đỡ của bạn&nbsp;<a href=\"http://nghiadev.com/\">Minh Nghĩa</a>, Botble front page đ&atilde; được kho&aacute;c l&ecirc;n bộ &aacute;o mới m&agrave; m&igrave;nh đ&aacute;nh gi&aacute; l&agrave; đẹp hơn rất nhiều so với theme mặc định cũ.</p>\r\n\r\n<p>Một số h&igrave;nh ảnh:</p>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/GuJDOdVnDbOVIneN9Qwvo5G_CkX8lx09S0fqifpEvWODI5vFPk4qdvqHITQFbKbdlUoZhB1FMaiTS4-qG2c0qKNGnOoj0oe5Gh9bv9xLg_wp_mWFysuKj9R-WQEufFXzYMrwQ30HRnvebvJqeGCBXhU5RatFHTBbv-8lwoWXZVXd3G1eUSOPKn1S1dVTsoXf7XxzFzN-Vny8uypcJxT2ZenVA1jDQ4doIPky0LHLra08TnMJZ8zh4lMSm8r5PiWXPCpLhBr4OhFTWjYk4dMgo19rggDGJvFZnvFwl682bD0EBqbhITdR4tAni-CTiprbroUuBo5aKX3MFnKIMyVQcc5H5tNuJgtieDuVDe0ZjePxvQzwbG-Vzoz7cEMOLp7G23fTG3L_w3Czpt2p8TzE8nsa8xYdu5yWIetxoYfWRGMYQCHtINnbglYDKuK1wFnXu41rzOO8p4y7NF5rksoAuNleDD9RB24JR3a6J2zhOnvRL5EWlq3HlZbUdn7cybXn3rnJY9rWqBjubFUz8d-lPtObLi4dHzYxT6KfDMRzwMXcPx_RxZVc-6ZOEn2e051DsccRfb-IvurAzppoqnYlfxFEUYZMq8c5s-GNeRKOwqXFhEs4=w655-h324-no\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/0S7CR_aFNK7QzUEf8Oo6gnwBU1htFdqYLWmX5VQHMZusY47Xyk_jim18FiAwWlVz4WVtn56AMhlhTqtNDMdBpVi2w8pc4yShEYs2-5gr9qIDPxylbCOKfQqj-zzGS8kR7v5xBBph55FE5YFXWEnDQEYo0udhhoNAY-nDpmIi3t3Ho_BqUf8U0E13WDUf-Iu-UQSrvUfFqdqmVubGBuuSx6xXtnj3RBwUcoFdHkFihdXneylcNppQRnTPg3bMOcbhPaJt3JQNQmM3SJIS40fG4W1Yc9ALpK1N7GYt2sRcczWQTQRJveezh-zoPY-HACeQIViWXR_hktNrILo5o-3lhvlDy1kiB60elO3mWKA6bmHZstJ5pqEuBNR6A0DlpBJ-bbtqZBDqMVrjVoromcvucN3ybY3zUOWonD5g1_5kRfRo9C451BAMZ0W1uH4u5pmr3qNTcoxJJ55K_cT4X8ZFuqIV3DOooFuXOYQiXqPFpEgl--px4vvdQycJyhdtgrxb4FBff1vyMskx00rmA33a5DSqoBxt_HzzXqBWNTw6VXj0CLhXft6FQ-ojvWaxMMlzFqmB93heEtSrAczb8nTRIlT7fb6q-2MlCr3LxCjd9VhkVyzL=w1344-h662-no\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/mv9qalSsV8wrJjeugYDvhdVF-WEVfsNahKVIVg8CZ6NfN9tisVjGPch-VyQG4Ij4fCG6Z_LY5B-uwX30pI2BXBre3SxsWHF_v2pF-CwNGiB9Z5jj-_zEbqL5p2vGj3YRsUG2fY9TO1eAWZ-Pf3YiuS55cPdpc52cprwtRFpGBZ0NjpDAefNZYBHvabj5H_Rgg29U7R8KVvJj95bA_Dj12kqbxZFZB6otTfyikWskXTQa6Vy5yEqv7-KlU96jrowouyIQsXER0FaedD2X6aHPvA6dFhVmK5lJ9LwVr01Ani16vqjOcDf__FCh6o5iPTkLFPCccLPBhtT4kd2AotQCyopvmH8wyewYLFeG6mNi6bEnh35UfPix500VPTviZkW4UVMy5dIOWHalfdO7VXkbGIq--dsO7H9OPQ3BHLA5MKmjmER4Wg1Mi8vxI8xm7Rx6mTo8BQBNixAuVBPjgVIEjgUKJGTOFeXNrNVL685EuWTMVfhJSepjxjSNUtEjkeHxy03NjWd_8JUgfVFpr1Yer_5qGjg7zAFOB0XDbNn_nhl-CRZW_pRj4GQ_NwumV2ICD0IMPxOj17bxbA8tpf8rqWo9x__pgyWeeuYUMBWrnH1NfozG=w1345-h670-no\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/lF39CW32xGI1aCvNJU7eZmIKn94wkt9qiWqjqsaO7DR60azWq94_SnVPWG3cx0bDY-oX-vaZKCa_hA1jvjpZ7JTLVPo1HtYobNArbvP6HcrsBn0oTLs7I25ChfLsdlMI-GywLSMgrx4paTLJxEWuiqXBxkRGA7S59BH_CQ1w53H3cPvD34k3Ps9HxvTetDwjx6YiVe0JAMXGLHjtUYKDwaAi4pSxVnTRDwS84KSm9dTyhdU-I014QSP_RA6gHR8krt2Ddlwr9CaPWc2yAe214G1_gN1inUoTMmI6mZr3vY9qdB5JVLodTNEGtfqgpzy8s-wAGHhjI7JPsWbsa0UEOzS3WBpzbfiOR66L1ops7PiTRjvhr9HMS5er0a3P_lQUK8r7hq37lDMk9nflkyOkzcFhSvRGP6TS83TJR4X95tcal0uTP6pYPeC0C41IpomtXRalqIB9dx1tAQfBWlY9WRhZADnwLIkWxm5U8vqEhXBq6RQFhRBiWlInMwOI01bmInLvioAwd0bohHtNd2yP_pU-WeCu2slVxpG-HTRacW14vvpcBJKGy2k0sjCnngI1FFb8X7NHSdQy_etGkaggWJ2mfgAvD8DzSfNvScchUhbkcqq4=w1353-h669-no\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>4. Quản l&yacute; plugin</h3>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/03ZeATliabVof9wqnXaoI4a3m52QOYhC7bPpAyUihUpthcH2yilmrA45oX4w5PbG_99bDvy9tKPD0iOrDCqEpEMR0xfHxczuBxLISD96inWaZW6fHo9YMeHZm_8ULpZSQxK5bvORy9iQ2FBT6xBGuYPeVjVOzNcO839cC0ZjnaTxQUozTm8SA4Fe938L4kT4xeNAVYMHourqELmoC1tjgIr8oq66Wze_loZuY35kBZlX8iFGoFiC4gkjO_yT16q4wpeqRzP7rWOdztqmZpZ5wrbTSusbfi1Dn2ghIABvS4uqrF7gi_JIL9AlSEhnFTHY7QaDH4Q7N8m3r3n2rZWD43iaRIauOm4mXgP1XpaTzZjVjehXLfgG8BNNIq56KldAlroHbGblojOS_gPHuYCvsxk3mckq6oHvGLh4_HyxYl7JAuG0hYxN0sIimEd8GehVV-EqNnbPWAocxytigYnX4SiMndGOtVet6o2XvrDLMlHN8ASKxcO59IJ8Se7hzaCfcJ6wQpl5kvJE4oITxA4R-5_1ezvnZDPGt7jyPuIv1wGsks2YJ1apYIBMQEOhKdlCDkqQC_hBx0vLhq8zxgNgptZKv2opfPGZ9j6KQPqNL3khGoRv=w1352-h666-no\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>5. Sử dụng một số concept của Wordpress</h3>\r\n\r\n<p>Như c&aacute;c bạn đ&atilde; biết, Wordpress c&oacute; rất nhiều t&iacute;nh năng hay. V&igrave; vậy m&igrave;nh đ&atilde; &aacute;p dụng Filter, Action hook v&agrave; Metabox v&agrave;o Botble để c&oacute; thể dễ d&agrave;ng hơn cho c&aacute;c bạn can thiệp v&agrave;o core sau n&agrave;y.</p>\r\n\r\n<h3>Kết luận:</h3>\r\n\r\n<p>Tr&ecirc;n đ&acirc;y l&agrave; một số t&iacute;nh năng mới của Botble version 2.0, hi vọng c&aacute;c bạn cảm thấy hứng th&uacute; với CMS n&agrave;y.</p>\r\n\r\n<p>C&aacute;c bạn c&oacute; thể mua ủng hộ m&igrave;nh tr&ecirc;n Codecanyon https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182 hoặc li&ecirc;n hệ trực tiếp với m&igrave;nh qua skype live:minsang2603 để được hỗ trợ.</p>\r\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/nmnkzkiyqsygikfjinsb-20140717-212636-3-660x330.jpg', 1, NULL, '2016-11-12 18:27:06', '2018-04-13 09:39:32');
INSERT INTO `posts` (`id`, `name`, `description`, `content`, `status`, `author_id`, `author_type`, `is_featured`, `image`, `views`, `format_type`, `created_at`, `updated_at`) VALUES
(46, 'Bạn sẽ chọn công ty nào', 'Đây là bài viết mẫu, nội dung của những bài viết demo đều giống nhau, nó được dùng với mục đích làm ví dụ, các bài viết hiện tại trên trang demo đều có nội dung giống nhau về phần nội dung và mô tả ngắn.', '<p>Hi mọi người, &nbsp;dạo gần đ&acirc;y m&igrave;nh kh&ocirc;ng viết blog mới v&igrave; tập trung ph&aacute;t triển Botble CMS. Sau bao cố gắng th&igrave; h&ocirc;m nay m&igrave;nh đ&atilde; c&oacute; thể release version 2.0 với nhiều t&iacute;nh năng mới.</p>\r\n\r\n<p>Ở bản 1.0, m&igrave;nh cảm thấy n&oacute; c&oacute; qu&aacute; nhiều t&iacute;nh năng phức tạp, chỉ ph&ugrave; hợp với hệ thống lớn m&agrave; đa số c&aacute;c website nhỏ kh&ocirc;ng cần đến, v&igrave; vậy m&igrave;nh đ&atilde; đơn giản bớt đi trong phần n&agrave;y v&agrave; tập trung l&agrave;m sao cho Botble CMS dễ sử dụng nhất.</p>\r\n\r\n<p>Botble CMS đang sử dụng Laravel&nbsp;phi&ecirc;n bản mới nhất tại thời điểm n&agrave;y 5.3.</p>\r\n\r\n<h3>Demo:</h3>\r\n\r\n<p>Homepage:&nbsp;<a href=\"http://cms.botble.com/\">http://cms.botble.com</a></p>\r\n\r\n<p>Admin:&nbsp;<a href=\"http://cms.botble.com/admin\">http://cms.botble.com/admin</a></p>\r\n\r\n<p>Account: botble - 159357</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Cấu tr&uacute;c thư mục:</h3>\r\n\r\n<p><img alt=\"core\" src=\"http://sangplus.com/wp-content/uploads/2016/10/Core-700x328.png\" /></p>\r\n\r\n<p>Botble version 2 đ&atilde; được tổ chức th&agrave;nh từng module theo dạng HMVC v&agrave; nằm ho&agrave;n to&agrave;n trong thư mục /core. Những thư mục kh&aacute;c hầu hết được giữ nguy&ecirc;n hiện trạng như bản c&agrave;i mới laravel. Điều n&agrave;y gi&uacute;p dễ d&agrave;ng hơn trong việc cập nhật, n&acirc;ng cấp sau n&agrave;y.</p>\r\n\r\n<p><img alt=\"theme\" src=\"http://sangplus.com/wp-content/uploads/2016/10/Theme-700x326.png\" /></p>\r\n\r\n<p>T&aacute;ch biệt thư mục theme v&agrave; chuẩn cấu tr&uacute;c theme.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>M&igrave;nh xin n&oacute;i sơ qua một số t&iacute;nh năng mới trong bản n&agrave;y.</p>\r\n\r\n<ol>\r\n	<li>\r\n	<h3>Hỗ trợ c&agrave;i đặt.</h3>\r\n	</li>\r\n</ol>\r\n\r\n<p>Nhiều người gặp kh&oacute; khăn trong việc c&agrave;i đặt Botble, đa số đ&oacute; l&agrave; những người mới l&agrave;m quen laravel. V&igrave; vậy m&igrave;nh đ&atilde; viết 1 đoạn script để hỗ trợ c&agrave;i đặt nhanh ch&oacute;ng qua command line.</p>\r\n\r\n<p><iframe frameborder=\"0\" height=\"506\" src=\"https://www.youtube.com/embed/DAZe2V_A0wo?feature=oembed\" width=\"900\"></iframe></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>2. Tạo 1 module/plugin mới một c&aacute;ch nhanh ch&oacute;ng với CRUD v&agrave; permissions.</h3>\r\n\r\n<p><iframe frameborder=\"0\" height=\"506\" src=\"https://www.youtube.com/embed/8F4wfrS9svs?feature=oembed\" width=\"900\"></iframe></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Việc loại bỏ 1 module kh&ocirc;ng cần thiết cũng đơn giản hơn bao giờ hết.</p>\r\n\r\n<p><iframe frameborder=\"0\" height=\"506\" src=\"https://www.youtube.com/embed/jmex2G4eC18?feature=oembed\" width=\"900\"></iframe></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Do hơi bận rộn n&ecirc;n m&igrave;nh chỉ c&oacute; thể quay một số video hướng dẫn tr&ecirc;n, sẽ bổ sung sau :D</p>\r\n\r\n<h3>3. Theme mới</h3>\r\n\r\n<p>Trong bản cập nhật n&agrave;y, nhờ sự gi&uacute;p đỡ của bạn&nbsp;<a href=\"http://nghiadev.com/\">Minh Nghĩa</a>, Botble front page đ&atilde; được kho&aacute;c l&ecirc;n bộ &aacute;o mới m&agrave; m&igrave;nh đ&aacute;nh gi&aacute; l&agrave; đẹp hơn rất nhiều so với theme mặc định cũ.</p>\r\n\r\n<p>Một số h&igrave;nh ảnh:</p>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/GuJDOdVnDbOVIneN9Qwvo5G_CkX8lx09S0fqifpEvWODI5vFPk4qdvqHITQFbKbdlUoZhB1FMaiTS4-qG2c0qKNGnOoj0oe5Gh9bv9xLg_wp_mWFysuKj9R-WQEufFXzYMrwQ30HRnvebvJqeGCBXhU5RatFHTBbv-8lwoWXZVXd3G1eUSOPKn1S1dVTsoXf7XxzFzN-Vny8uypcJxT2ZenVA1jDQ4doIPky0LHLra08TnMJZ8zh4lMSm8r5PiWXPCpLhBr4OhFTWjYk4dMgo19rggDGJvFZnvFwl682bD0EBqbhITdR4tAni-CTiprbroUuBo5aKX3MFnKIMyVQcc5H5tNuJgtieDuVDe0ZjePxvQzwbG-Vzoz7cEMOLp7G23fTG3L_w3Czpt2p8TzE8nsa8xYdu5yWIetxoYfWRGMYQCHtINnbglYDKuK1wFnXu41rzOO8p4y7NF5rksoAuNleDD9RB24JR3a6J2zhOnvRL5EWlq3HlZbUdn7cybXn3rnJY9rWqBjubFUz8d-lPtObLi4dHzYxT6KfDMRzwMXcPx_RxZVc-6ZOEn2e051DsccRfb-IvurAzppoqnYlfxFEUYZMq8c5s-GNeRKOwqXFhEs4=w655-h324-no\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/0S7CR_aFNK7QzUEf8Oo6gnwBU1htFdqYLWmX5VQHMZusY47Xyk_jim18FiAwWlVz4WVtn56AMhlhTqtNDMdBpVi2w8pc4yShEYs2-5gr9qIDPxylbCOKfQqj-zzGS8kR7v5xBBph55FE5YFXWEnDQEYo0udhhoNAY-nDpmIi3t3Ho_BqUf8U0E13WDUf-Iu-UQSrvUfFqdqmVubGBuuSx6xXtnj3RBwUcoFdHkFihdXneylcNppQRnTPg3bMOcbhPaJt3JQNQmM3SJIS40fG4W1Yc9ALpK1N7GYt2sRcczWQTQRJveezh-zoPY-HACeQIViWXR_hktNrILo5o-3lhvlDy1kiB60elO3mWKA6bmHZstJ5pqEuBNR6A0DlpBJ-bbtqZBDqMVrjVoromcvucN3ybY3zUOWonD5g1_5kRfRo9C451BAMZ0W1uH4u5pmr3qNTcoxJJ55K_cT4X8ZFuqIV3DOooFuXOYQiXqPFpEgl--px4vvdQycJyhdtgrxb4FBff1vyMskx00rmA33a5DSqoBxt_HzzXqBWNTw6VXj0CLhXft6FQ-ojvWaxMMlzFqmB93heEtSrAczb8nTRIlT7fb6q-2MlCr3LxCjd9VhkVyzL=w1344-h662-no\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/mv9qalSsV8wrJjeugYDvhdVF-WEVfsNahKVIVg8CZ6NfN9tisVjGPch-VyQG4Ij4fCG6Z_LY5B-uwX30pI2BXBre3SxsWHF_v2pF-CwNGiB9Z5jj-_zEbqL5p2vGj3YRsUG2fY9TO1eAWZ-Pf3YiuS55cPdpc52cprwtRFpGBZ0NjpDAefNZYBHvabj5H_Rgg29U7R8KVvJj95bA_Dj12kqbxZFZB6otTfyikWskXTQa6Vy5yEqv7-KlU96jrowouyIQsXER0FaedD2X6aHPvA6dFhVmK5lJ9LwVr01Ani16vqjOcDf__FCh6o5iPTkLFPCccLPBhtT4kd2AotQCyopvmH8wyewYLFeG6mNi6bEnh35UfPix500VPTviZkW4UVMy5dIOWHalfdO7VXkbGIq--dsO7H9OPQ3BHLA5MKmjmER4Wg1Mi8vxI8xm7Rx6mTo8BQBNixAuVBPjgVIEjgUKJGTOFeXNrNVL685EuWTMVfhJSepjxjSNUtEjkeHxy03NjWd_8JUgfVFpr1Yer_5qGjg7zAFOB0XDbNn_nhl-CRZW_pRj4GQ_NwumV2ICD0IMPxOj17bxbA8tpf8rqWo9x__pgyWeeuYUMBWrnH1NfozG=w1345-h670-no\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/lF39CW32xGI1aCvNJU7eZmIKn94wkt9qiWqjqsaO7DR60azWq94_SnVPWG3cx0bDY-oX-vaZKCa_hA1jvjpZ7JTLVPo1HtYobNArbvP6HcrsBn0oTLs7I25ChfLsdlMI-GywLSMgrx4paTLJxEWuiqXBxkRGA7S59BH_CQ1w53H3cPvD34k3Ps9HxvTetDwjx6YiVe0JAMXGLHjtUYKDwaAi4pSxVnTRDwS84KSm9dTyhdU-I014QSP_RA6gHR8krt2Ddlwr9CaPWc2yAe214G1_gN1inUoTMmI6mZr3vY9qdB5JVLodTNEGtfqgpzy8s-wAGHhjI7JPsWbsa0UEOzS3WBpzbfiOR66L1ops7PiTRjvhr9HMS5er0a3P_lQUK8r7hq37lDMk9nflkyOkzcFhSvRGP6TS83TJR4X95tcal0uTP6pYPeC0C41IpomtXRalqIB9dx1tAQfBWlY9WRhZADnwLIkWxm5U8vqEhXBq6RQFhRBiWlInMwOI01bmInLvioAwd0bohHtNd2yP_pU-WeCu2slVxpG-HTRacW14vvpcBJKGy2k0sjCnngI1FFb8X7NHSdQy_etGkaggWJ2mfgAvD8DzSfNvScchUhbkcqq4=w1353-h669-no\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>4. Quản l&yacute; plugin</h3>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/03ZeATliabVof9wqnXaoI4a3m52QOYhC7bPpAyUihUpthcH2yilmrA45oX4w5PbG_99bDvy9tKPD0iOrDCqEpEMR0xfHxczuBxLISD96inWaZW6fHo9YMeHZm_8ULpZSQxK5bvORy9iQ2FBT6xBGuYPeVjVOzNcO839cC0ZjnaTxQUozTm8SA4Fe938L4kT4xeNAVYMHourqELmoC1tjgIr8oq66Wze_loZuY35kBZlX8iFGoFiC4gkjO_yT16q4wpeqRzP7rWOdztqmZpZ5wrbTSusbfi1Dn2ghIABvS4uqrF7gi_JIL9AlSEhnFTHY7QaDH4Q7N8m3r3n2rZWD43iaRIauOm4mXgP1XpaTzZjVjehXLfgG8BNNIq56KldAlroHbGblojOS_gPHuYCvsxk3mckq6oHvGLh4_HyxYl7JAuG0hYxN0sIimEd8GehVV-EqNnbPWAocxytigYnX4SiMndGOtVet6o2XvrDLMlHN8ASKxcO59IJ8Se7hzaCfcJ6wQpl5kvJE4oITxA4R-5_1ezvnZDPGt7jyPuIv1wGsks2YJ1apYIBMQEOhKdlCDkqQC_hBx0vLhq8zxgNgptZKv2opfPGZ9j6KQPqNL3khGoRv=w1352-h666-no\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>5. Sử dụng một số concept của Wordpress</h3>\r\n\r\n<p>Như c&aacute;c bạn đ&atilde; biết, Wordpress c&oacute; rất nhiều t&iacute;nh năng hay. V&igrave; vậy m&igrave;nh đ&atilde; &aacute;p dụng Filter, Action hook v&agrave; Metabox v&agrave;o Botble để c&oacute; thể dễ d&agrave;ng hơn cho c&aacute;c bạn can thiệp v&agrave;o core sau n&agrave;y.</p>\r\n\r\n<h3>Kết luận:</h3>\r\n\r\n<p>Tr&ecirc;n đ&acirc;y l&agrave; một số t&iacute;nh năng mới của Botble version 2.0, hi vọng c&aacute;c bạn cảm thấy hứng th&uacute; với CMS n&agrave;y.</p>\r\n\r\n<p>C&aacute;c bạn c&oacute; thể mua ủng hộ m&igrave;nh tr&ecirc;n Codecanyon https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182 hoặc li&ecirc;n hệ trực tiếp với m&igrave;nh qua skype live:minsang2603 để được hỗ trợ.</p>\r\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476893532-01.jpg', 0, NULL, '2016-11-12 18:32:57', '2016-11-25 07:30:22'),
(47, 'Sử dụng xe Đại lý bán hàng Tricks xúc', 'Đây là bài viết mẫu, nội dung của những bài viết demo đều giống nhau, nó được dùng với mục đích làm ví dụ, các bài viết hiện tại trên trang demo đều có nội dung giống nhau về phần nội dung và mô tả ngắn.', '<p>Hi mọi người, &nbsp;dạo gần đ&acirc;y m&igrave;nh kh&ocirc;ng viết blog mới v&igrave; tập trung ph&aacute;t triển Botble CMS. Sau bao cố gắng th&igrave; h&ocirc;m nay m&igrave;nh đ&atilde; c&oacute; thể release version 2.0 với nhiều t&iacute;nh năng mới.</p>\r\n\r\n<p>Ở bản 1.0, m&igrave;nh cảm thấy n&oacute; c&oacute; qu&aacute; nhiều t&iacute;nh năng phức tạp, chỉ ph&ugrave; hợp với hệ thống lớn m&agrave; đa số c&aacute;c website nhỏ kh&ocirc;ng cần đến, v&igrave; vậy m&igrave;nh đ&atilde; đơn giản bớt đi trong phần n&agrave;y v&agrave; tập trung l&agrave;m sao cho Botble CMS dễ sử dụng nhất.</p>\r\n\r\n<p>Botble CMS đang sử dụng Laravel&nbsp;phi&ecirc;n bản mới nhất tại thời điểm n&agrave;y 5.3.</p>\r\n\r\n<h3>Demo:</h3>\r\n\r\n<p>Homepage:&nbsp;<a href=\"http://cms.botble.com/\">http://cms.botble.com</a></p>\r\n\r\n<p>Admin:&nbsp;<a href=\"http://cms.botble.com/admin\">http://cms.botble.com/admin</a></p>\r\n\r\n<p>Account: botble - 159357</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Cấu tr&uacute;c thư mục:</h3>\r\n\r\n<p><img alt=\"core\" src=\"http://sangplus.com/wp-content/uploads/2016/10/Core-700x328.png\" /></p>\r\n\r\n<p>Botble version 2 đ&atilde; được tổ chức th&agrave;nh từng module theo dạng HMVC v&agrave; nằm ho&agrave;n to&agrave;n trong thư mục /core. Những thư mục kh&aacute;c hầu hết được giữ nguy&ecirc;n hiện trạng như bản c&agrave;i mới laravel. Điều n&agrave;y gi&uacute;p dễ d&agrave;ng hơn trong việc cập nhật, n&acirc;ng cấp sau n&agrave;y.</p>\r\n\r\n<p><img alt=\"theme\" src=\"http://sangplus.com/wp-content/uploads/2016/10/Theme-700x326.png\" /></p>\r\n\r\n<p>T&aacute;ch biệt thư mục theme v&agrave; chuẩn cấu tr&uacute;c theme.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>M&igrave;nh xin n&oacute;i sơ qua một số t&iacute;nh năng mới trong bản n&agrave;y.</p>\r\n\r\n<ol>\r\n	<li>\r\n	<h3>Hỗ trợ c&agrave;i đặt.</h3>\r\n	</li>\r\n</ol>\r\n\r\n<p>Nhiều người gặp kh&oacute; khăn trong việc c&agrave;i đặt Botble, đa số đ&oacute; l&agrave; những người mới l&agrave;m quen laravel. V&igrave; vậy m&igrave;nh đ&atilde; viết 1 đoạn script để hỗ trợ c&agrave;i đặt nhanh ch&oacute;ng qua command line.</p>\r\n\r\n<p><iframe frameborder=\"0\" height=\"506\" src=\"https://www.youtube.com/embed/DAZe2V_A0wo?feature=oembed\" width=\"900\"></iframe></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>2. Tạo 1 module/plugin mới một c&aacute;ch nhanh ch&oacute;ng với CRUD v&agrave; permissions.</h3>\r\n\r\n<p><iframe frameborder=\"0\" height=\"506\" src=\"https://www.youtube.com/embed/8F4wfrS9svs?feature=oembed\" width=\"900\"></iframe></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Việc loại bỏ 1 module kh&ocirc;ng cần thiết cũng đơn giản hơn bao giờ hết.</p>\r\n\r\n<p><iframe frameborder=\"0\" height=\"506\" src=\"https://www.youtube.com/embed/jmex2G4eC18?feature=oembed\" width=\"900\"></iframe></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Do hơi bận rộn n&ecirc;n m&igrave;nh chỉ c&oacute; thể quay một số video hướng dẫn tr&ecirc;n, sẽ bổ sung sau :D</p>\r\n\r\n<h3>3. Theme mới</h3>\r\n\r\n<p>Trong bản cập nhật n&agrave;y, nhờ sự gi&uacute;p đỡ của bạn&nbsp;<a href=\"http://nghiadev.com/\">Minh Nghĩa</a>, Botble front page đ&atilde; được kho&aacute;c l&ecirc;n bộ &aacute;o mới m&agrave; m&igrave;nh đ&aacute;nh gi&aacute; l&agrave; đẹp hơn rất nhiều so với theme mặc định cũ.</p>\r\n\r\n<p>Một số h&igrave;nh ảnh:</p>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/GuJDOdVnDbOVIneN9Qwvo5G_CkX8lx09S0fqifpEvWODI5vFPk4qdvqHITQFbKbdlUoZhB1FMaiTS4-qG2c0qKNGnOoj0oe5Gh9bv9xLg_wp_mWFysuKj9R-WQEufFXzYMrwQ30HRnvebvJqeGCBXhU5RatFHTBbv-8lwoWXZVXd3G1eUSOPKn1S1dVTsoXf7XxzFzN-Vny8uypcJxT2ZenVA1jDQ4doIPky0LHLra08TnMJZ8zh4lMSm8r5PiWXPCpLhBr4OhFTWjYk4dMgo19rggDGJvFZnvFwl682bD0EBqbhITdR4tAni-CTiprbroUuBo5aKX3MFnKIMyVQcc5H5tNuJgtieDuVDe0ZjePxvQzwbG-Vzoz7cEMOLp7G23fTG3L_w3Czpt2p8TzE8nsa8xYdu5yWIetxoYfWRGMYQCHtINnbglYDKuK1wFnXu41rzOO8p4y7NF5rksoAuNleDD9RB24JR3a6J2zhOnvRL5EWlq3HlZbUdn7cybXn3rnJY9rWqBjubFUz8d-lPtObLi4dHzYxT6KfDMRzwMXcPx_RxZVc-6ZOEn2e051DsccRfb-IvurAzppoqnYlfxFEUYZMq8c5s-GNeRKOwqXFhEs4=w655-h324-no\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/0S7CR_aFNK7QzUEf8Oo6gnwBU1htFdqYLWmX5VQHMZusY47Xyk_jim18FiAwWlVz4WVtn56AMhlhTqtNDMdBpVi2w8pc4yShEYs2-5gr9qIDPxylbCOKfQqj-zzGS8kR7v5xBBph55FE5YFXWEnDQEYo0udhhoNAY-nDpmIi3t3Ho_BqUf8U0E13WDUf-Iu-UQSrvUfFqdqmVubGBuuSx6xXtnj3RBwUcoFdHkFihdXneylcNppQRnTPg3bMOcbhPaJt3JQNQmM3SJIS40fG4W1Yc9ALpK1N7GYt2sRcczWQTQRJveezh-zoPY-HACeQIViWXR_hktNrILo5o-3lhvlDy1kiB60elO3mWKA6bmHZstJ5pqEuBNR6A0DlpBJ-bbtqZBDqMVrjVoromcvucN3ybY3zUOWonD5g1_5kRfRo9C451BAMZ0W1uH4u5pmr3qNTcoxJJ55K_cT4X8ZFuqIV3DOooFuXOYQiXqPFpEgl--px4vvdQycJyhdtgrxb4FBff1vyMskx00rmA33a5DSqoBxt_HzzXqBWNTw6VXj0CLhXft6FQ-ojvWaxMMlzFqmB93heEtSrAczb8nTRIlT7fb6q-2MlCr3LxCjd9VhkVyzL=w1344-h662-no\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/mv9qalSsV8wrJjeugYDvhdVF-WEVfsNahKVIVg8CZ6NfN9tisVjGPch-VyQG4Ij4fCG6Z_LY5B-uwX30pI2BXBre3SxsWHF_v2pF-CwNGiB9Z5jj-_zEbqL5p2vGj3YRsUG2fY9TO1eAWZ-Pf3YiuS55cPdpc52cprwtRFpGBZ0NjpDAefNZYBHvabj5H_Rgg29U7R8KVvJj95bA_Dj12kqbxZFZB6otTfyikWskXTQa6Vy5yEqv7-KlU96jrowouyIQsXER0FaedD2X6aHPvA6dFhVmK5lJ9LwVr01Ani16vqjOcDf__FCh6o5iPTkLFPCccLPBhtT4kd2AotQCyopvmH8wyewYLFeG6mNi6bEnh35UfPix500VPTviZkW4UVMy5dIOWHalfdO7VXkbGIq--dsO7H9OPQ3BHLA5MKmjmER4Wg1Mi8vxI8xm7Rx6mTo8BQBNixAuVBPjgVIEjgUKJGTOFeXNrNVL685EuWTMVfhJSepjxjSNUtEjkeHxy03NjWd_8JUgfVFpr1Yer_5qGjg7zAFOB0XDbNn_nhl-CRZW_pRj4GQ_NwumV2ICD0IMPxOj17bxbA8tpf8rqWo9x__pgyWeeuYUMBWrnH1NfozG=w1345-h670-no\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/lF39CW32xGI1aCvNJU7eZmIKn94wkt9qiWqjqsaO7DR60azWq94_SnVPWG3cx0bDY-oX-vaZKCa_hA1jvjpZ7JTLVPo1HtYobNArbvP6HcrsBn0oTLs7I25ChfLsdlMI-GywLSMgrx4paTLJxEWuiqXBxkRGA7S59BH_CQ1w53H3cPvD34k3Ps9HxvTetDwjx6YiVe0JAMXGLHjtUYKDwaAi4pSxVnTRDwS84KSm9dTyhdU-I014QSP_RA6gHR8krt2Ddlwr9CaPWc2yAe214G1_gN1inUoTMmI6mZr3vY9qdB5JVLodTNEGtfqgpzy8s-wAGHhjI7JPsWbsa0UEOzS3WBpzbfiOR66L1ops7PiTRjvhr9HMS5er0a3P_lQUK8r7hq37lDMk9nflkyOkzcFhSvRGP6TS83TJR4X95tcal0uTP6pYPeC0C41IpomtXRalqIB9dx1tAQfBWlY9WRhZADnwLIkWxm5U8vqEhXBq6RQFhRBiWlInMwOI01bmInLvioAwd0bohHtNd2yP_pU-WeCu2slVxpG-HTRacW14vvpcBJKGy2k0sjCnngI1FFb8X7NHSdQy_etGkaggWJ2mfgAvD8DzSfNvScchUhbkcqq4=w1353-h669-no\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>4. Quản l&yacute; plugin</h3>\r\n\r\n<p><img alt=\"\" src=\"https://lh3.googleusercontent.com/03ZeATliabVof9wqnXaoI4a3m52QOYhC7bPpAyUihUpthcH2yilmrA45oX4w5PbG_99bDvy9tKPD0iOrDCqEpEMR0xfHxczuBxLISD96inWaZW6fHo9YMeHZm_8ULpZSQxK5bvORy9iQ2FBT6xBGuYPeVjVOzNcO839cC0ZjnaTxQUozTm8SA4Fe938L4kT4xeNAVYMHourqELmoC1tjgIr8oq66Wze_loZuY35kBZlX8iFGoFiC4gkjO_yT16q4wpeqRzP7rWOdztqmZpZ5wrbTSusbfi1Dn2ghIABvS4uqrF7gi_JIL9AlSEhnFTHY7QaDH4Q7N8m3r3n2rZWD43iaRIauOm4mXgP1XpaTzZjVjehXLfgG8BNNIq56KldAlroHbGblojOS_gPHuYCvsxk3mckq6oHvGLh4_HyxYl7JAuG0hYxN0sIimEd8GehVV-EqNnbPWAocxytigYnX4SiMndGOtVet6o2XvrDLMlHN8ASKxcO59IJ8Se7hzaCfcJ6wQpl5kvJE4oITxA4R-5_1ezvnZDPGt7jyPuIv1wGsks2YJ1apYIBMQEOhKdlCDkqQC_hBx0vLhq8zxgNgptZKv2opfPGZ9j6KQPqNL3khGoRv=w1352-h666-no\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>5. Sử dụng một số concept của Wordpress</h3>\r\n\r\n<p>Như c&aacute;c bạn đ&atilde; biết, Wordpress c&oacute; rất nhiều t&iacute;nh năng hay. V&igrave; vậy m&igrave;nh đ&atilde; &aacute;p dụng Filter, Action hook v&agrave; Metabox v&agrave;o Botble để c&oacute; thể dễ d&agrave;ng hơn cho c&aacute;c bạn can thiệp v&agrave;o core sau n&agrave;y.</p>\r\n\r\n<h3>Kết luận:</h3>\r\n\r\n<p>Tr&ecirc;n đ&acirc;y l&agrave; một số t&iacute;nh năng mới của Botble version 2.0, hi vọng c&aacute;c bạn cảm thấy hứng th&uacute; với CMS n&agrave;y.</p>\r\n\r\n<p>C&aacute;c bạn c&oacute; thể mua ủng hộ m&igrave;nh tr&ecirc;n Codecanyon https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182 hoặc li&ecirc;n hệ trực tiếp với m&igrave;nh qua skype live:minsang2603 để được hỗ trợ.</p>\r\n', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/old-car-660x330.jpg', 4, NULL, '2016-11-12 18:35:25', '2016-11-28 22:10:54'),
(48, 'Chiến lược phát triển phần mềm', 'Chiến lược phát triển phần mềm', '<p>Hi mọi người,  dạo gần đây mình không viết blog mới vì tập trung phát triển Botble CMS. Sau bao cố gắng thì hôm nay mình đã có thể release version 2.0 với nhiều tính năng mới.</p>\r\n<p>Ở bản 1.0, mình cảm thấy nó có quá nhiều tính năng phức tạp, chỉ phù hợp với hệ thống lớn mà đa số các website nhỏ không cần đến, vì vậy mình đã đơn giản bớt đi trong phần này và tập trung làm sao cho Botble CMS dễ sử dụng nhất.</p>\r\n<p>Botble CMS đang sử dụng Laravel phiên bản mới nhất tại thời điểm này 5.3.</p>\r\n<h3>Demo:</h3>\r\n<p>Homepage: <a href=\"http://cms.botble.com/\">http://cms.botble.com</a></p>\r\n<p>Admin: <a href=\"http://cms.botble.com/admin\">http://cms.botble.com/admin</a></p>\r\n<p>Account: botble - 159357</p>\r\n<p> </p>\r\n<h3>Cấu trúc thư mục:</h3>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Core-700x328.png\" alt=\"core\" /></p>\r\n<p>Botble version 2 đã được tổ chức thành từng module theo dạng HMVC và nằm hoàn toàn trong thư mục /core. Những thư mục khác hầu hết được giữ nguyên hiện trạng như bản cài mới laravel. Điều này giúp dễ dàng hơn trong việc cập nhật, nâng cấp sau này.</p>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Theme-700x326.png\" alt=\"theme\" /></p>\r\n<p>Tách biệt thư mục theme và chuẩn cấu trúc theme.</p>\r\n<p> </p>\r\n<p>Mình xin nói sơ qua một số tính năng mới trong bản này.</p>\r\n<ol>\r\n<li>\r\n<h3>Hỗ trợ cài đặt.</h3>\r\n</li>\r\n</ol>\r\n<p>Nhiều người gặp khó khăn trong việc cài đặt Botble, đa số đó là những người mới làm quen laravel. Vì vậy mình đã viết 1 đoạn script để hỗ trợ cài đặt nhanh chóng qua command line.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/DAZe2V_A0wo?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<h3>2. Tạo 1 module/plugin mới một cách nhanh chóng với CRUD và permissions.</h3>\r\n<p><iframe src=\"https://www.youtube.com/embed/8F4wfrS9svs?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Việc loại bỏ 1 module không cần thiết cũng đơn giản hơn bao giờ hết.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/jmex2G4eC18?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Do hơi bận rộn nên mình chỉ có thể quay một số video hướng dẫn trên, sẽ bổ sung sau :D</p>\r\n<h3>3. Theme mới</h3>\r\n<p>Trong bản cập nhật này, nhờ sự giúp đỡ của bạn <a href=\"http://nghiadev.com/\">Minh Nghĩa</a>, Botble front page đã được khoác lên bộ áo mới mà mình đánh giá là đẹp hơn rất nhiều so với theme mặc định cũ.</p>\r\n<p>Một số hình ảnh:</p>\r\n<p><img src=\"https://lh3.googleusercontent.com/GuJDOdVnDbOVIneN9Qwvo5G_CkX8lx09S0fqifpEvWODI5vFPk4qdvqHITQFbKbdlUoZhB1FMaiTS4-qG2c0qKNGnOoj0oe5Gh9bv9xLg_wp_mWFysuKj9R-WQEufFXzYMrwQ30HRnvebvJqeGCBXhU5RatFHTBbv-8lwoWXZVXd3G1eUSOPKn1S1dVTsoXf7XxzFzN-Vny8uypcJxT2ZenVA1jDQ4doIPky0LHLra08TnMJZ8zh4lMSm8r5PiWXPCpLhBr4OhFTWjYk4dMgo19rggDGJvFZnvFwl682bD0EBqbhITdR4tAni-CTiprbroUuBo5aKX3MFnKIMyVQcc5H5tNuJgtieDuVDe0ZjePxvQzwbG-Vzoz7cEMOLp7G23fTG3L_w3Czpt2p8TzE8nsa8xYdu5yWIetxoYfWRGMYQCHtINnbglYDKuK1wFnXu41rzOO8p4y7NF5rksoAuNleDD9RB24JR3a6J2zhOnvRL5EWlq3HlZbUdn7cybXn3rnJY9rWqBjubFUz8d-lPtObLi4dHzYxT6KfDMRzwMXcPx_RxZVc-6ZOEn2e051DsccRfb-IvurAzppoqnYlfxFEUYZMq8c5s-GNeRKOwqXFhEs4=w655-h324-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/0S7CR_aFNK7QzUEf8Oo6gnwBU1htFdqYLWmX5VQHMZusY47Xyk_jim18FiAwWlVz4WVtn56AMhlhTqtNDMdBpVi2w8pc4yShEYs2-5gr9qIDPxylbCOKfQqj-zzGS8kR7v5xBBph55FE5YFXWEnDQEYo0udhhoNAY-nDpmIi3t3Ho_BqUf8U0E13WDUf-Iu-UQSrvUfFqdqmVubGBuuSx6xXtnj3RBwUcoFdHkFihdXneylcNppQRnTPg3bMOcbhPaJt3JQNQmM3SJIS40fG4W1Yc9ALpK1N7GYt2sRcczWQTQRJveezh-zoPY-HACeQIViWXR_hktNrILo5o-3lhvlDy1kiB60elO3mWKA6bmHZstJ5pqEuBNR6A0DlpBJ-bbtqZBDqMVrjVoromcvucN3ybY3zUOWonD5g1_5kRfRo9C451BAMZ0W1uH4u5pmr3qNTcoxJJ55K_cT4X8ZFuqIV3DOooFuXOYQiXqPFpEgl--px4vvdQycJyhdtgrxb4FBff1vyMskx00rmA33a5DSqoBxt_HzzXqBWNTw6VXj0CLhXft6FQ-ojvWaxMMlzFqmB93heEtSrAczb8nTRIlT7fb6q-2MlCr3LxCjd9VhkVyzL=w1344-h662-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/mv9qalSsV8wrJjeugYDvhdVF-WEVfsNahKVIVg8CZ6NfN9tisVjGPch-VyQG4Ij4fCG6Z_LY5B-uwX30pI2BXBre3SxsWHF_v2pF-CwNGiB9Z5jj-_zEbqL5p2vGj3YRsUG2fY9TO1eAWZ-Pf3YiuS55cPdpc52cprwtRFpGBZ0NjpDAefNZYBHvabj5H_Rgg29U7R8KVvJj95bA_Dj12kqbxZFZB6otTfyikWskXTQa6Vy5yEqv7-KlU96jrowouyIQsXER0FaedD2X6aHPvA6dFhVmK5lJ9LwVr01Ani16vqjOcDf__FCh6o5iPTkLFPCccLPBhtT4kd2AotQCyopvmH8wyewYLFeG6mNi6bEnh35UfPix500VPTviZkW4UVMy5dIOWHalfdO7VXkbGIq--dsO7H9OPQ3BHLA5MKmjmER4Wg1Mi8vxI8xm7Rx6mTo8BQBNixAuVBPjgVIEjgUKJGTOFeXNrNVL685EuWTMVfhJSepjxjSNUtEjkeHxy03NjWd_8JUgfVFpr1Yer_5qGjg7zAFOB0XDbNn_nhl-CRZW_pRj4GQ_NwumV2ICD0IMPxOj17bxbA8tpf8rqWo9x__pgyWeeuYUMBWrnH1NfozG=w1345-h670-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/lF39CW32xGI1aCvNJU7eZmIKn94wkt9qiWqjqsaO7DR60azWq94_SnVPWG3cx0bDY-oX-vaZKCa_hA1jvjpZ7JTLVPo1HtYobNArbvP6HcrsBn0oTLs7I25ChfLsdlMI-GywLSMgrx4paTLJxEWuiqXBxkRGA7S59BH_CQ1w53H3cPvD34k3Ps9HxvTetDwjx6YiVe0JAMXGLHjtUYKDwaAi4pSxVnTRDwS84KSm9dTyhdU-I014QSP_RA6gHR8krt2Ddlwr9CaPWc2yAe214G1_gN1inUoTMmI6mZr3vY9qdB5JVLodTNEGtfqgpzy8s-wAGHhjI7JPsWbsa0UEOzS3WBpzbfiOR66L1ops7PiTRjvhr9HMS5er0a3P_lQUK8r7hq37lDMk9nflkyOkzcFhSvRGP6TS83TJR4X95tcal0uTP6pYPeC0C41IpomtXRalqIB9dx1tAQfBWlY9WRhZADnwLIkWxm5U8vqEhXBq6RQFhRBiWlInMwOI01bmInLvioAwd0bohHtNd2yP_pU-WeCu2slVxpG-HTRacW14vvpcBJKGy2k0sjCnngI1FFb8X7NHSdQy_etGkaggWJ2mfgAvD8DzSfNvScchUhbkcqq4=w1353-h669-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>4. Quản lý plugin</h3>\r\n<p><img src=\"https://lh3.googleusercontent.com/03ZeATliabVof9wqnXaoI4a3m52QOYhC7bPpAyUihUpthcH2yilmrA45oX4w5PbG_99bDvy9tKPD0iOrDCqEpEMR0xfHxczuBxLISD96inWaZW6fHo9YMeHZm_8ULpZSQxK5bvORy9iQ2FBT6xBGuYPeVjVOzNcO839cC0ZjnaTxQUozTm8SA4Fe938L4kT4xeNAVYMHourqELmoC1tjgIr8oq66Wze_loZuY35kBZlX8iFGoFiC4gkjO_yT16q4wpeqRzP7rWOdztqmZpZ5wrbTSusbfi1Dn2ghIABvS4uqrF7gi_JIL9AlSEhnFTHY7QaDH4Q7N8m3r3n2rZWD43iaRIauOm4mXgP1XpaTzZjVjehXLfgG8BNNIq56KldAlroHbGblojOS_gPHuYCvsxk3mckq6oHvGLh4_HyxYl7JAuG0hYxN0sIimEd8GehVV-EqNnbPWAocxytigYnX4SiMndGOtVet6o2XvrDLMlHN8ASKxcO59IJ8Se7hzaCfcJ6wQpl5kvJE4oITxA4R-5_1ezvnZDPGt7jyPuIv1wGsks2YJ1apYIBMQEOhKdlCDkqQC_hBx0vLhq8zxgNgptZKv2opfPGZ9j6KQPqNL3khGoRv=w1352-h666-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>5. Sử dụng một số concept của Wordpress</h3>\r\n<p>Như các bạn đã biết, Wordpress có rất nhiều tính năng hay. Vì vậy mình đã áp dụng Filter, Action hook và Metabox vào Botble để có thể dễ dàng hơn cho các bạn can thiệp vào core sau này.</p>\r\n<h3>Kết luận:</h3>\r\n<p>Trên đây là một số tính năng mới của Botble version 2.0, hi vọng các bạn cảm thấy hứng thú với CMS này.</p>\r\n<p>Các bạn có thể mua ủng hộ mình trên Codecanyon https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182 hoặc liên hệ trực tiếp với mình qua skype live:minsang2603 để được hỗ trợ.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/lock-660x330.jpg', 0, NULL, '2018-04-13 09:40:11', '2018-04-13 09:40:18'),
(49, 'Nền tảng mã nguồn mở PHP', 'Nền tảng', '<p>Hi mọi người,  dạo gần đây mình không viết blog mới vì tập trung phát triển Botble CMS. Sau bao cố gắng thì hôm nay mình đã có thể release version 2.0 với nhiều tính năng mới.</p>\r\n<p>Ở bản 1.0, mình cảm thấy nó có quá nhiều tính năng phức tạp, chỉ phù hợp với hệ thống lớn mà đa số các website nhỏ không cần đến, vì vậy mình đã đơn giản bớt đi trong phần này và tập trung làm sao cho Botble CMS dễ sử dụng nhất.</p>\r\n<p>Botble CMS đang sử dụng Laravel phiên bản mới nhất tại thời điểm này 5.3.</p>\r\n<h3>Demo:</h3>\r\n<p>Homepage: <a href=\"http://cms.botble.com/\">http://cms.botble.com</a></p>\r\n<p>Admin: <a href=\"http://cms.botble.com/admin\">http://cms.botble.com/admin</a></p>\r\n<p>Account: botble - 159357</p>\r\n<p> </p>\r\n<h3>Cấu trúc thư mục:</h3>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Core-700x328.png\" alt=\"core\" /></p>\r\n<p>Botble version 2 đã được tổ chức thành từng module theo dạng HMVC và nằm hoàn toàn trong thư mục /core. Những thư mục khác hầu hết được giữ nguyên hiện trạng như bản cài mới laravel. Điều này giúp dễ dàng hơn trong việc cập nhật, nâng cấp sau này.</p>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Theme-700x326.png\" alt=\"theme\" /></p>\r\n<p>Tách biệt thư mục theme và chuẩn cấu trúc theme.</p>\r\n<p> </p>\r\n<p>Mình xin nói sơ qua một số tính năng mới trong bản này.</p>\r\n<ol>\r\n<li>\r\n<h3>Hỗ trợ cài đặt.</h3>\r\n</li>\r\n</ol>\r\n<p>Nhiều người gặp khó khăn trong việc cài đặt Botble, đa số đó là những người mới làm quen laravel. Vì vậy mình đã viết 1 đoạn script để hỗ trợ cài đặt nhanh chóng qua command line.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/DAZe2V_A0wo?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<h3>2. Tạo 1 module/plugin mới một cách nhanh chóng với CRUD và permissions.</h3>\r\n<p><iframe src=\"https://www.youtube.com/embed/8F4wfrS9svs?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Việc loại bỏ 1 module không cần thiết cũng đơn giản hơn bao giờ hết.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/jmex2G4eC18?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Do hơi bận rộn nên mình chỉ có thể quay một số video hướng dẫn trên, sẽ bổ sung sau :D</p>\r\n<h3>3. Theme mới</h3>\r\n<p>Trong bản cập nhật này, nhờ sự giúp đỡ của bạn <a href=\"http://nghiadev.com/\">Minh Nghĩa</a>, Botble front page đã được khoác lên bộ áo mới mà mình đánh giá là đẹp hơn rất nhiều so với theme mặc định cũ.</p>\r\n<p>Một số hình ảnh:</p>\r\n<p><img src=\"https://lh3.googleusercontent.com/GuJDOdVnDbOVIneN9Qwvo5G_CkX8lx09S0fqifpEvWODI5vFPk4qdvqHITQFbKbdlUoZhB1FMaiTS4-qG2c0qKNGnOoj0oe5Gh9bv9xLg_wp_mWFysuKj9R-WQEufFXzYMrwQ30HRnvebvJqeGCBXhU5RatFHTBbv-8lwoWXZVXd3G1eUSOPKn1S1dVTsoXf7XxzFzN-Vny8uypcJxT2ZenVA1jDQ4doIPky0LHLra08TnMJZ8zh4lMSm8r5PiWXPCpLhBr4OhFTWjYk4dMgo19rggDGJvFZnvFwl682bD0EBqbhITdR4tAni-CTiprbroUuBo5aKX3MFnKIMyVQcc5H5tNuJgtieDuVDe0ZjePxvQzwbG-Vzoz7cEMOLp7G23fTG3L_w3Czpt2p8TzE8nsa8xYdu5yWIetxoYfWRGMYQCHtINnbglYDKuK1wFnXu41rzOO8p4y7NF5rksoAuNleDD9RB24JR3a6J2zhOnvRL5EWlq3HlZbUdn7cybXn3rnJY9rWqBjubFUz8d-lPtObLi4dHzYxT6KfDMRzwMXcPx_RxZVc-6ZOEn2e051DsccRfb-IvurAzppoqnYlfxFEUYZMq8c5s-GNeRKOwqXFhEs4=w655-h324-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/0S7CR_aFNK7QzUEf8Oo6gnwBU1htFdqYLWmX5VQHMZusY47Xyk_jim18FiAwWlVz4WVtn56AMhlhTqtNDMdBpVi2w8pc4yShEYs2-5gr9qIDPxylbCOKfQqj-zzGS8kR7v5xBBph55FE5YFXWEnDQEYo0udhhoNAY-nDpmIi3t3Ho_BqUf8U0E13WDUf-Iu-UQSrvUfFqdqmVubGBuuSx6xXtnj3RBwUcoFdHkFihdXneylcNppQRnTPg3bMOcbhPaJt3JQNQmM3SJIS40fG4W1Yc9ALpK1N7GYt2sRcczWQTQRJveezh-zoPY-HACeQIViWXR_hktNrILo5o-3lhvlDy1kiB60elO3mWKA6bmHZstJ5pqEuBNR6A0DlpBJ-bbtqZBDqMVrjVoromcvucN3ybY3zUOWonD5g1_5kRfRo9C451BAMZ0W1uH4u5pmr3qNTcoxJJ55K_cT4X8ZFuqIV3DOooFuXOYQiXqPFpEgl--px4vvdQycJyhdtgrxb4FBff1vyMskx00rmA33a5DSqoBxt_HzzXqBWNTw6VXj0CLhXft6FQ-ojvWaxMMlzFqmB93heEtSrAczb8nTRIlT7fb6q-2MlCr3LxCjd9VhkVyzL=w1344-h662-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/mv9qalSsV8wrJjeugYDvhdVF-WEVfsNahKVIVg8CZ6NfN9tisVjGPch-VyQG4Ij4fCG6Z_LY5B-uwX30pI2BXBre3SxsWHF_v2pF-CwNGiB9Z5jj-_zEbqL5p2vGj3YRsUG2fY9TO1eAWZ-Pf3YiuS55cPdpc52cprwtRFpGBZ0NjpDAefNZYBHvabj5H_Rgg29U7R8KVvJj95bA_Dj12kqbxZFZB6otTfyikWskXTQa6Vy5yEqv7-KlU96jrowouyIQsXER0FaedD2X6aHPvA6dFhVmK5lJ9LwVr01Ani16vqjOcDf__FCh6o5iPTkLFPCccLPBhtT4kd2AotQCyopvmH8wyewYLFeG6mNi6bEnh35UfPix500VPTviZkW4UVMy5dIOWHalfdO7VXkbGIq--dsO7H9OPQ3BHLA5MKmjmER4Wg1Mi8vxI8xm7Rx6mTo8BQBNixAuVBPjgVIEjgUKJGTOFeXNrNVL685EuWTMVfhJSepjxjSNUtEjkeHxy03NjWd_8JUgfVFpr1Yer_5qGjg7zAFOB0XDbNn_nhl-CRZW_pRj4GQ_NwumV2ICD0IMPxOj17bxbA8tpf8rqWo9x__pgyWeeuYUMBWrnH1NfozG=w1345-h670-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/lF39CW32xGI1aCvNJU7eZmIKn94wkt9qiWqjqsaO7DR60azWq94_SnVPWG3cx0bDY-oX-vaZKCa_hA1jvjpZ7JTLVPo1HtYobNArbvP6HcrsBn0oTLs7I25ChfLsdlMI-GywLSMgrx4paTLJxEWuiqXBxkRGA7S59BH_CQ1w53H3cPvD34k3Ps9HxvTetDwjx6YiVe0JAMXGLHjtUYKDwaAi4pSxVnTRDwS84KSm9dTyhdU-I014QSP_RA6gHR8krt2Ddlwr9CaPWc2yAe214G1_gN1inUoTMmI6mZr3vY9qdB5JVLodTNEGtfqgpzy8s-wAGHhjI7JPsWbsa0UEOzS3WBpzbfiOR66L1ops7PiTRjvhr9HMS5er0a3P_lQUK8r7hq37lDMk9nflkyOkzcFhSvRGP6TS83TJR4X95tcal0uTP6pYPeC0C41IpomtXRalqIB9dx1tAQfBWlY9WRhZADnwLIkWxm5U8vqEhXBq6RQFhRBiWlInMwOI01bmInLvioAwd0bohHtNd2yP_pU-WeCu2slVxpG-HTRacW14vvpcBJKGy2k0sjCnngI1FFb8X7NHSdQy_etGkaggWJ2mfgAvD8DzSfNvScchUhbkcqq4=w1353-h669-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>4. Quản lý plugin</h3>\r\n<p><img src=\"https://lh3.googleusercontent.com/03ZeATliabVof9wqnXaoI4a3m52QOYhC7bPpAyUihUpthcH2yilmrA45oX4w5PbG_99bDvy9tKPD0iOrDCqEpEMR0xfHxczuBxLISD96inWaZW6fHo9YMeHZm_8ULpZSQxK5bvORy9iQ2FBT6xBGuYPeVjVOzNcO839cC0ZjnaTxQUozTm8SA4Fe938L4kT4xeNAVYMHourqELmoC1tjgIr8oq66Wze_loZuY35kBZlX8iFGoFiC4gkjO_yT16q4wpeqRzP7rWOdztqmZpZ5wrbTSusbfi1Dn2ghIABvS4uqrF7gi_JIL9AlSEhnFTHY7QaDH4Q7N8m3r3n2rZWD43iaRIauOm4mXgP1XpaTzZjVjehXLfgG8BNNIq56KldAlroHbGblojOS_gPHuYCvsxk3mckq6oHvGLh4_HyxYl7JAuG0hYxN0sIimEd8GehVV-EqNnbPWAocxytigYnX4SiMndGOtVet6o2XvrDLMlHN8ASKxcO59IJ8Se7hzaCfcJ6wQpl5kvJE4oITxA4R-5_1ezvnZDPGt7jyPuIv1wGsks2YJ1apYIBMQEOhKdlCDkqQC_hBx0vLhq8zxgNgptZKv2opfPGZ9j6KQPqNL3khGoRv=w1352-h666-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>5. Sử dụng một số concept của Wordpress</h3>\r\n<p>Như các bạn đã biết, Wordpress có rất nhiều tính năng hay. Vì vậy mình đã áp dụng Filter, Action hook và Metabox vào Botble để có thể dễ dàng hơn cho các bạn can thiệp vào core sau này.</p>\r\n<h3>Kết luận:</h3>\r\n<p>Trên đây là một số tính năng mới của Botble version 2.0, hi vọng các bạn cảm thấy hứng thú với CMS này.</p>\r\n<p>Các bạn có thể mua ủng hộ mình trên Codecanyon https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182 hoặc liên hệ trực tiếp với mình qua skype live:minsang2603 để được hỗ trợ.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/7998125906-4489ed8a2f-b-660x330.jpg', 0, NULL, '2018-04-13 09:41:28', '2018-04-13 09:41:32'),
(50, 'Xây dựng website một cách nhanh chóng', 'Nội dung mô tả', '<p>Hi mọi người,  dạo gần đây mình không viết blog mới vì tập trung phát triển Botble CMS. Sau bao cố gắng thì hôm nay mình đã có thể release version 2.0 với nhiều tính năng mới.</p>\r\n<p>Ở bản 1.0, mình cảm thấy nó có quá nhiều tính năng phức tạp, chỉ phù hợp với hệ thống lớn mà đa số các website nhỏ không cần đến, vì vậy mình đã đơn giản bớt đi trong phần này và tập trung làm sao cho Botble CMS dễ sử dụng nhất.</p>\r\n<p>Botble CMS đang sử dụng Laravel phiên bản mới nhất tại thời điểm này 5.3.</p>\r\n<h3>Demo:</h3>\r\n<p>Homepage: <a href=\"http://cms.botble.com/\">http://cms.botble.com</a></p>\r\n<p>Admin: <a href=\"http://cms.botble.com/admin\">http://cms.botble.com/admin</a></p>\r\n<p>Account: botble - 159357</p>\r\n<p> </p>\r\n<h3>Cấu trúc thư mục:</h3>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Core-700x328.png\" alt=\"core\" /></p>\r\n<p>Botble version 2 đã được tổ chức thành từng module theo dạng HMVC và nằm hoàn toàn trong thư mục /core. Những thư mục khác hầu hết được giữ nguyên hiện trạng như bản cài mới laravel. Điều này giúp dễ dàng hơn trong việc cập nhật, nâng cấp sau này.</p>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Theme-700x326.png\" alt=\"theme\" /></p>\r\n<p>Tách biệt thư mục theme và chuẩn cấu trúc theme.</p>\r\n<p> </p>\r\n<p>Mình xin nói sơ qua một số tính năng mới trong bản này.</p>\r\n<ol>\r\n<li>\r\n<h3>Hỗ trợ cài đặt.</h3>\r\n</li>\r\n</ol>\r\n<p>Nhiều người gặp khó khăn trong việc cài đặt Botble, đa số đó là những người mới làm quen laravel. Vì vậy mình đã viết 1 đoạn script để hỗ trợ cài đặt nhanh chóng qua command line.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/DAZe2V_A0wo?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<h3>2. Tạo 1 module/plugin mới một cách nhanh chóng với CRUD và permissions.</h3>\r\n<p><iframe src=\"https://www.youtube.com/embed/8F4wfrS9svs?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Việc loại bỏ 1 module không cần thiết cũng đơn giản hơn bao giờ hết.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/jmex2G4eC18?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Do hơi bận rộn nên mình chỉ có thể quay một số video hướng dẫn trên, sẽ bổ sung sau :D</p>\r\n<h3>3. Theme mới</h3>\r\n<p>Trong bản cập nhật này, nhờ sự giúp đỡ của bạn <a href=\"http://nghiadev.com/\">Minh Nghĩa</a>, Botble front page đã được khoác lên bộ áo mới mà mình đánh giá là đẹp hơn rất nhiều so với theme mặc định cũ.</p>\r\n<p>Một số hình ảnh:</p>\r\n<p><img src=\"https://lh3.googleusercontent.com/GuJDOdVnDbOVIneN9Qwvo5G_CkX8lx09S0fqifpEvWODI5vFPk4qdvqHITQFbKbdlUoZhB1FMaiTS4-qG2c0qKNGnOoj0oe5Gh9bv9xLg_wp_mWFysuKj9R-WQEufFXzYMrwQ30HRnvebvJqeGCBXhU5RatFHTBbv-8lwoWXZVXd3G1eUSOPKn1S1dVTsoXf7XxzFzN-Vny8uypcJxT2ZenVA1jDQ4doIPky0LHLra08TnMJZ8zh4lMSm8r5PiWXPCpLhBr4OhFTWjYk4dMgo19rggDGJvFZnvFwl682bD0EBqbhITdR4tAni-CTiprbroUuBo5aKX3MFnKIMyVQcc5H5tNuJgtieDuVDe0ZjePxvQzwbG-Vzoz7cEMOLp7G23fTG3L_w3Czpt2p8TzE8nsa8xYdu5yWIetxoYfWRGMYQCHtINnbglYDKuK1wFnXu41rzOO8p4y7NF5rksoAuNleDD9RB24JR3a6J2zhOnvRL5EWlq3HlZbUdn7cybXn3rnJY9rWqBjubFUz8d-lPtObLi4dHzYxT6KfDMRzwMXcPx_RxZVc-6ZOEn2e051DsccRfb-IvurAzppoqnYlfxFEUYZMq8c5s-GNeRKOwqXFhEs4=w655-h324-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/0S7CR_aFNK7QzUEf8Oo6gnwBU1htFdqYLWmX5VQHMZusY47Xyk_jim18FiAwWlVz4WVtn56AMhlhTqtNDMdBpVi2w8pc4yShEYs2-5gr9qIDPxylbCOKfQqj-zzGS8kR7v5xBBph55FE5YFXWEnDQEYo0udhhoNAY-nDpmIi3t3Ho_BqUf8U0E13WDUf-Iu-UQSrvUfFqdqmVubGBuuSx6xXtnj3RBwUcoFdHkFihdXneylcNppQRnTPg3bMOcbhPaJt3JQNQmM3SJIS40fG4W1Yc9ALpK1N7GYt2sRcczWQTQRJveezh-zoPY-HACeQIViWXR_hktNrILo5o-3lhvlDy1kiB60elO3mWKA6bmHZstJ5pqEuBNR6A0DlpBJ-bbtqZBDqMVrjVoromcvucN3ybY3zUOWonD5g1_5kRfRo9C451BAMZ0W1uH4u5pmr3qNTcoxJJ55K_cT4X8ZFuqIV3DOooFuXOYQiXqPFpEgl--px4vvdQycJyhdtgrxb4FBff1vyMskx00rmA33a5DSqoBxt_HzzXqBWNTw6VXj0CLhXft6FQ-ojvWaxMMlzFqmB93heEtSrAczb8nTRIlT7fb6q-2MlCr3LxCjd9VhkVyzL=w1344-h662-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/mv9qalSsV8wrJjeugYDvhdVF-WEVfsNahKVIVg8CZ6NfN9tisVjGPch-VyQG4Ij4fCG6Z_LY5B-uwX30pI2BXBre3SxsWHF_v2pF-CwNGiB9Z5jj-_zEbqL5p2vGj3YRsUG2fY9TO1eAWZ-Pf3YiuS55cPdpc52cprwtRFpGBZ0NjpDAefNZYBHvabj5H_Rgg29U7R8KVvJj95bA_Dj12kqbxZFZB6otTfyikWskXTQa6Vy5yEqv7-KlU96jrowouyIQsXER0FaedD2X6aHPvA6dFhVmK5lJ9LwVr01Ani16vqjOcDf__FCh6o5iPTkLFPCccLPBhtT4kd2AotQCyopvmH8wyewYLFeG6mNi6bEnh35UfPix500VPTviZkW4UVMy5dIOWHalfdO7VXkbGIq--dsO7H9OPQ3BHLA5MKmjmER4Wg1Mi8vxI8xm7Rx6mTo8BQBNixAuVBPjgVIEjgUKJGTOFeXNrNVL685EuWTMVfhJSepjxjSNUtEjkeHxy03NjWd_8JUgfVFpr1Yer_5qGjg7zAFOB0XDbNn_nhl-CRZW_pRj4GQ_NwumV2ICD0IMPxOj17bxbA8tpf8rqWo9x__pgyWeeuYUMBWrnH1NfozG=w1345-h670-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/lF39CW32xGI1aCvNJU7eZmIKn94wkt9qiWqjqsaO7DR60azWq94_SnVPWG3cx0bDY-oX-vaZKCa_hA1jvjpZ7JTLVPo1HtYobNArbvP6HcrsBn0oTLs7I25ChfLsdlMI-GywLSMgrx4paTLJxEWuiqXBxkRGA7S59BH_CQ1w53H3cPvD34k3Ps9HxvTetDwjx6YiVe0JAMXGLHjtUYKDwaAi4pSxVnTRDwS84KSm9dTyhdU-I014QSP_RA6gHR8krt2Ddlwr9CaPWc2yAe214G1_gN1inUoTMmI6mZr3vY9qdB5JVLodTNEGtfqgpzy8s-wAGHhjI7JPsWbsa0UEOzS3WBpzbfiOR66L1ops7PiTRjvhr9HMS5er0a3P_lQUK8r7hq37lDMk9nflkyOkzcFhSvRGP6TS83TJR4X95tcal0uTP6pYPeC0C41IpomtXRalqIB9dx1tAQfBWlY9WRhZADnwLIkWxm5U8vqEhXBq6RQFhRBiWlInMwOI01bmInLvioAwd0bohHtNd2yP_pU-WeCu2slVxpG-HTRacW14vvpcBJKGy2k0sjCnngI1FFb8X7NHSdQy_etGkaggWJ2mfgAvD8DzSfNvScchUhbkcqq4=w1353-h669-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>4. Quản lý plugin</h3>\r\n<p><img src=\"https://lh3.googleusercontent.com/03ZeATliabVof9wqnXaoI4a3m52QOYhC7bPpAyUihUpthcH2yilmrA45oX4w5PbG_99bDvy9tKPD0iOrDCqEpEMR0xfHxczuBxLISD96inWaZW6fHo9YMeHZm_8ULpZSQxK5bvORy9iQ2FBT6xBGuYPeVjVOzNcO839cC0ZjnaTxQUozTm8SA4Fe938L4kT4xeNAVYMHourqELmoC1tjgIr8oq66Wze_loZuY35kBZlX8iFGoFiC4gkjO_yT16q4wpeqRzP7rWOdztqmZpZ5wrbTSusbfi1Dn2ghIABvS4uqrF7gi_JIL9AlSEhnFTHY7QaDH4Q7N8m3r3n2rZWD43iaRIauOm4mXgP1XpaTzZjVjehXLfgG8BNNIq56KldAlroHbGblojOS_gPHuYCvsxk3mckq6oHvGLh4_HyxYl7JAuG0hYxN0sIimEd8GehVV-EqNnbPWAocxytigYnX4SiMndGOtVet6o2XvrDLMlHN8ASKxcO59IJ8Se7hzaCfcJ6wQpl5kvJE4oITxA4R-5_1ezvnZDPGt7jyPuIv1wGsks2YJ1apYIBMQEOhKdlCDkqQC_hBx0vLhq8zxgNgptZKv2opfPGZ9j6KQPqNL3khGoRv=w1352-h666-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>5. Sử dụng một số concept của Wordpress</h3>\r\n<p>Như các bạn đã biết, Wordpress có rất nhiều tính năng hay. Vì vậy mình đã áp dụng Filter, Action hook và Metabox vào Botble để có thể dễ dàng hơn cho các bạn can thiệp vào core sau này.</p>\r\n<h3>Kết luận:</h3>\r\n<p>Trên đây là một số tính năng mới của Botble version 2.0, hi vọng các bạn cảm thấy hứng thú với CMS này.</p>\r\n<p>Các bạn có thể mua ủng hộ mình trên Codecanyon https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182 hoặc liên hệ trực tiếp với mình qua skype live:minsang2603 để được hỗ trợ.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476890033-hero03.jpg', 0, NULL, '2018-04-13 09:42:20', '2018-04-13 09:42:27'),
(51, 'Sản phẩm trí tuệ Việt Nam', 'Mô tả', '<p>Hi mọi người,  dạo gần đây mình không viết blog mới vì tập trung phát triển Botble CMS. Sau bao cố gắng thì hôm nay mình đã có thể release version 2.0 với nhiều tính năng mới.</p>\r\n<p>Ở bản 1.0, mình cảm thấy nó có quá nhiều tính năng phức tạp, chỉ phù hợp với hệ thống lớn mà đa số các website nhỏ không cần đến, vì vậy mình đã đơn giản bớt đi trong phần này và tập trung làm sao cho Botble CMS dễ sử dụng nhất.</p>\r\n<p>Botble CMS đang sử dụng Laravel phiên bản mới nhất tại thời điểm này 5.3.</p>\r\n<h3>Demo:</h3>\r\n<p>Homepage: <a href=\"http://cms.botble.com/\">http://cms.botble.com</a></p>\r\n<p>Admin: <a href=\"http://cms.botble.com/admin\">http://cms.botble.com/admin</a></p>\r\n<p>Account: botble - 159357</p>\r\n<p> </p>\r\n<h3>Cấu trúc thư mục:</h3>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Core-700x328.png\" alt=\"core\" /></p>\r\n<p>Botble version 2 đã được tổ chức thành từng module theo dạng HMVC và nằm hoàn toàn trong thư mục /core. Những thư mục khác hầu hết được giữ nguyên hiện trạng như bản cài mới laravel. Điều này giúp dễ dàng hơn trong việc cập nhật, nâng cấp sau này.</p>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Theme-700x326.png\" alt=\"theme\" /></p>\r\n<p>Tách biệt thư mục theme và chuẩn cấu trúc theme.</p>\r\n<p> </p>\r\n<p>Mình xin nói sơ qua một số tính năng mới trong bản này.</p>\r\n<ol>\r\n<li>\r\n<h3>Hỗ trợ cài đặt.</h3>\r\n</li>\r\n</ol>\r\n<p>Nhiều người gặp khó khăn trong việc cài đặt Botble, đa số đó là những người mới làm quen laravel. Vì vậy mình đã viết 1 đoạn script để hỗ trợ cài đặt nhanh chóng qua command line.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/DAZe2V_A0wo?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<h3>2. Tạo 1 module/plugin mới một cách nhanh chóng với CRUD và permissions.</h3>\r\n<p><iframe src=\"https://www.youtube.com/embed/8F4wfrS9svs?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Việc loại bỏ 1 module không cần thiết cũng đơn giản hơn bao giờ hết.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/jmex2G4eC18?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Do hơi bận rộn nên mình chỉ có thể quay một số video hướng dẫn trên, sẽ bổ sung sau :D</p>\r\n<h3>3. Theme mới</h3>\r\n<p>Trong bản cập nhật này, nhờ sự giúp đỡ của bạn <a href=\"http://nghiadev.com/\">Minh Nghĩa</a>, Botble front page đã được khoác lên bộ áo mới mà mình đánh giá là đẹp hơn rất nhiều so với theme mặc định cũ.</p>\r\n<p>Một số hình ảnh:</p>\r\n<p><img src=\"https://lh3.googleusercontent.com/GuJDOdVnDbOVIneN9Qwvo5G_CkX8lx09S0fqifpEvWODI5vFPk4qdvqHITQFbKbdlUoZhB1FMaiTS4-qG2c0qKNGnOoj0oe5Gh9bv9xLg_wp_mWFysuKj9R-WQEufFXzYMrwQ30HRnvebvJqeGCBXhU5RatFHTBbv-8lwoWXZVXd3G1eUSOPKn1S1dVTsoXf7XxzFzN-Vny8uypcJxT2ZenVA1jDQ4doIPky0LHLra08TnMJZ8zh4lMSm8r5PiWXPCpLhBr4OhFTWjYk4dMgo19rggDGJvFZnvFwl682bD0EBqbhITdR4tAni-CTiprbroUuBo5aKX3MFnKIMyVQcc5H5tNuJgtieDuVDe0ZjePxvQzwbG-Vzoz7cEMOLp7G23fTG3L_w3Czpt2p8TzE8nsa8xYdu5yWIetxoYfWRGMYQCHtINnbglYDKuK1wFnXu41rzOO8p4y7NF5rksoAuNleDD9RB24JR3a6J2zhOnvRL5EWlq3HlZbUdn7cybXn3rnJY9rWqBjubFUz8d-lPtObLi4dHzYxT6KfDMRzwMXcPx_RxZVc-6ZOEn2e051DsccRfb-IvurAzppoqnYlfxFEUYZMq8c5s-GNeRKOwqXFhEs4=w655-h324-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/0S7CR_aFNK7QzUEf8Oo6gnwBU1htFdqYLWmX5VQHMZusY47Xyk_jim18FiAwWlVz4WVtn56AMhlhTqtNDMdBpVi2w8pc4yShEYs2-5gr9qIDPxylbCOKfQqj-zzGS8kR7v5xBBph55FE5YFXWEnDQEYo0udhhoNAY-nDpmIi3t3Ho_BqUf8U0E13WDUf-Iu-UQSrvUfFqdqmVubGBuuSx6xXtnj3RBwUcoFdHkFihdXneylcNppQRnTPg3bMOcbhPaJt3JQNQmM3SJIS40fG4W1Yc9ALpK1N7GYt2sRcczWQTQRJveezh-zoPY-HACeQIViWXR_hktNrILo5o-3lhvlDy1kiB60elO3mWKA6bmHZstJ5pqEuBNR6A0DlpBJ-bbtqZBDqMVrjVoromcvucN3ybY3zUOWonD5g1_5kRfRo9C451BAMZ0W1uH4u5pmr3qNTcoxJJ55K_cT4X8ZFuqIV3DOooFuXOYQiXqPFpEgl--px4vvdQycJyhdtgrxb4FBff1vyMskx00rmA33a5DSqoBxt_HzzXqBWNTw6VXj0CLhXft6FQ-ojvWaxMMlzFqmB93heEtSrAczb8nTRIlT7fb6q-2MlCr3LxCjd9VhkVyzL=w1344-h662-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/mv9qalSsV8wrJjeugYDvhdVF-WEVfsNahKVIVg8CZ6NfN9tisVjGPch-VyQG4Ij4fCG6Z_LY5B-uwX30pI2BXBre3SxsWHF_v2pF-CwNGiB9Z5jj-_zEbqL5p2vGj3YRsUG2fY9TO1eAWZ-Pf3YiuS55cPdpc52cprwtRFpGBZ0NjpDAefNZYBHvabj5H_Rgg29U7R8KVvJj95bA_Dj12kqbxZFZB6otTfyikWskXTQa6Vy5yEqv7-KlU96jrowouyIQsXER0FaedD2X6aHPvA6dFhVmK5lJ9LwVr01Ani16vqjOcDf__FCh6o5iPTkLFPCccLPBhtT4kd2AotQCyopvmH8wyewYLFeG6mNi6bEnh35UfPix500VPTviZkW4UVMy5dIOWHalfdO7VXkbGIq--dsO7H9OPQ3BHLA5MKmjmER4Wg1Mi8vxI8xm7Rx6mTo8BQBNixAuVBPjgVIEjgUKJGTOFeXNrNVL685EuWTMVfhJSepjxjSNUtEjkeHxy03NjWd_8JUgfVFpr1Yer_5qGjg7zAFOB0XDbNn_nhl-CRZW_pRj4GQ_NwumV2ICD0IMPxOj17bxbA8tpf8rqWo9x__pgyWeeuYUMBWrnH1NfozG=w1345-h670-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/lF39CW32xGI1aCvNJU7eZmIKn94wkt9qiWqjqsaO7DR60azWq94_SnVPWG3cx0bDY-oX-vaZKCa_hA1jvjpZ7JTLVPo1HtYobNArbvP6HcrsBn0oTLs7I25ChfLsdlMI-GywLSMgrx4paTLJxEWuiqXBxkRGA7S59BH_CQ1w53H3cPvD34k3Ps9HxvTetDwjx6YiVe0JAMXGLHjtUYKDwaAi4pSxVnTRDwS84KSm9dTyhdU-I014QSP_RA6gHR8krt2Ddlwr9CaPWc2yAe214G1_gN1inUoTMmI6mZr3vY9qdB5JVLodTNEGtfqgpzy8s-wAGHhjI7JPsWbsa0UEOzS3WBpzbfiOR66L1ops7PiTRjvhr9HMS5er0a3P_lQUK8r7hq37lDMk9nflkyOkzcFhSvRGP6TS83TJR4X95tcal0uTP6pYPeC0C41IpomtXRalqIB9dx1tAQfBWlY9WRhZADnwLIkWxm5U8vqEhXBq6RQFhRBiWlInMwOI01bmInLvioAwd0bohHtNd2yP_pU-WeCu2slVxpG-HTRacW14vvpcBJKGy2k0sjCnngI1FFb8X7NHSdQy_etGkaggWJ2mfgAvD8DzSfNvScchUhbkcqq4=w1353-h669-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>4. Quản lý plugin</h3>\r\n<p><img src=\"https://lh3.googleusercontent.com/03ZeATliabVof9wqnXaoI4a3m52QOYhC7bPpAyUihUpthcH2yilmrA45oX4w5PbG_99bDvy9tKPD0iOrDCqEpEMR0xfHxczuBxLISD96inWaZW6fHo9YMeHZm_8ULpZSQxK5bvORy9iQ2FBT6xBGuYPeVjVOzNcO839cC0ZjnaTxQUozTm8SA4Fe938L4kT4xeNAVYMHourqELmoC1tjgIr8oq66Wze_loZuY35kBZlX8iFGoFiC4gkjO_yT16q4wpeqRzP7rWOdztqmZpZ5wrbTSusbfi1Dn2ghIABvS4uqrF7gi_JIL9AlSEhnFTHY7QaDH4Q7N8m3r3n2rZWD43iaRIauOm4mXgP1XpaTzZjVjehXLfgG8BNNIq56KldAlroHbGblojOS_gPHuYCvsxk3mckq6oHvGLh4_HyxYl7JAuG0hYxN0sIimEd8GehVV-EqNnbPWAocxytigYnX4SiMndGOtVet6o2XvrDLMlHN8ASKxcO59IJ8Se7hzaCfcJ6wQpl5kvJE4oITxA4R-5_1ezvnZDPGt7jyPuIv1wGsks2YJ1apYIBMQEOhKdlCDkqQC_hBx0vLhq8zxgNgptZKv2opfPGZ9j6KQPqNL3khGoRv=w1352-h666-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>5. Sử dụng một số concept của Wordpress</h3>\r\n<p>Như các bạn đã biết, Wordpress có rất nhiều tính năng hay. Vì vậy mình đã áp dụng Filter, Action hook và Metabox vào Botble để có thể dễ dàng hơn cho các bạn can thiệp vào core sau này.</p>\r\n<h3>Kết luận:</h3>\r\n<p>Trên đây là một số tính năng mới của Botble version 2.0, hi vọng các bạn cảm thấy hứng thú với CMS này.</p>\r\n<p>Các bạn có thể mua ủng hộ mình trên Codecanyon https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182 hoặc liên hệ trực tiếp với mình qua skype live:minsang2603 để được hỗ trợ.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476891198-04.jpg', 0, NULL, '2018-04-13 09:43:09', '2018-04-13 09:58:23');
INSERT INTO `posts` (`id`, `name`, `description`, `content`, `status`, `author_id`, `author_type`, `is_featured`, `image`, `views`, `format_type`, `created_at`, `updated_at`) VALUES
(52, 'Cuộc sống tuổi 30', 'Cuộc sống tuổi 30', '<p>Hi mọi người,  dạo gần đây mình không viết blog mới vì tập trung phát triển Botble CMS. Sau bao cố gắng thì hôm nay mình đã có thể release version 2.0 với nhiều tính năng mới.</p>\r\n<p>Ở bản 1.0, mình cảm thấy nó có quá nhiều tính năng phức tạp, chỉ phù hợp với hệ thống lớn mà đa số các website nhỏ không cần đến, vì vậy mình đã đơn giản bớt đi trong phần này và tập trung làm sao cho Botble CMS dễ sử dụng nhất.</p>\r\n<p>Botble CMS đang sử dụng Laravel phiên bản mới nhất tại thời điểm này 5.3.</p>\r\n<h3>Demo:</h3>\r\n<p>Homepage: <a href=\"http://cms.botble.com/\">http://cms.botble.com</a></p>\r\n<p>Admin: <a href=\"http://cms.botble.com/admin\">http://cms.botble.com/admin</a></p>\r\n<p>Account: botble - 159357</p>\r\n<p> </p>\r\n<h3>Cấu trúc thư mục:</h3>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Core-700x328.png\" alt=\"core\" /></p>\r\n<p>Botble version 2 đã được tổ chức thành từng module theo dạng HMVC và nằm hoàn toàn trong thư mục /core. Những thư mục khác hầu hết được giữ nguyên hiện trạng như bản cài mới laravel. Điều này giúp dễ dàng hơn trong việc cập nhật, nâng cấp sau này.</p>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Theme-700x326.png\" alt=\"theme\" /></p>\r\n<p>Tách biệt thư mục theme và chuẩn cấu trúc theme.</p>\r\n<p> </p>\r\n<p>Mình xin nói sơ qua một số tính năng mới trong bản này.</p>\r\n<ol>\r\n<li>\r\n<h3>Hỗ trợ cài đặt.</h3>\r\n</li>\r\n</ol>\r\n<p>Nhiều người gặp khó khăn trong việc cài đặt Botble, đa số đó là những người mới làm quen laravel. Vì vậy mình đã viết 1 đoạn script để hỗ trợ cài đặt nhanh chóng qua command line.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/DAZe2V_A0wo?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<h3>2. Tạo 1 module/plugin mới một cách nhanh chóng với CRUD và permissions.</h3>\r\n<p><iframe src=\"https://www.youtube.com/embed/8F4wfrS9svs?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Việc loại bỏ 1 module không cần thiết cũng đơn giản hơn bao giờ hết.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/jmex2G4eC18?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Do hơi bận rộn nên mình chỉ có thể quay một số video hướng dẫn trên, sẽ bổ sung sau :D</p>\r\n<h3>3. Theme mới</h3>\r\n<p>Trong bản cập nhật này, nhờ sự giúp đỡ của bạn <a href=\"http://nghiadev.com/\">Minh Nghĩa</a>, Botble front page đã được khoác lên bộ áo mới mà mình đánh giá là đẹp hơn rất nhiều so với theme mặc định cũ.</p>\r\n<p>Một số hình ảnh:</p>\r\n<p><img src=\"https://lh3.googleusercontent.com/GuJDOdVnDbOVIneN9Qwvo5G_CkX8lx09S0fqifpEvWODI5vFPk4qdvqHITQFbKbdlUoZhB1FMaiTS4-qG2c0qKNGnOoj0oe5Gh9bv9xLg_wp_mWFysuKj9R-WQEufFXzYMrwQ30HRnvebvJqeGCBXhU5RatFHTBbv-8lwoWXZVXd3G1eUSOPKn1S1dVTsoXf7XxzFzN-Vny8uypcJxT2ZenVA1jDQ4doIPky0LHLra08TnMJZ8zh4lMSm8r5PiWXPCpLhBr4OhFTWjYk4dMgo19rggDGJvFZnvFwl682bD0EBqbhITdR4tAni-CTiprbroUuBo5aKX3MFnKIMyVQcc5H5tNuJgtieDuVDe0ZjePxvQzwbG-Vzoz7cEMOLp7G23fTG3L_w3Czpt2p8TzE8nsa8xYdu5yWIetxoYfWRGMYQCHtINnbglYDKuK1wFnXu41rzOO8p4y7NF5rksoAuNleDD9RB24JR3a6J2zhOnvRL5EWlq3HlZbUdn7cybXn3rnJY9rWqBjubFUz8d-lPtObLi4dHzYxT6KfDMRzwMXcPx_RxZVc-6ZOEn2e051DsccRfb-IvurAzppoqnYlfxFEUYZMq8c5s-GNeRKOwqXFhEs4=w655-h324-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/0S7CR_aFNK7QzUEf8Oo6gnwBU1htFdqYLWmX5VQHMZusY47Xyk_jim18FiAwWlVz4WVtn56AMhlhTqtNDMdBpVi2w8pc4yShEYs2-5gr9qIDPxylbCOKfQqj-zzGS8kR7v5xBBph55FE5YFXWEnDQEYo0udhhoNAY-nDpmIi3t3Ho_BqUf8U0E13WDUf-Iu-UQSrvUfFqdqmVubGBuuSx6xXtnj3RBwUcoFdHkFihdXneylcNppQRnTPg3bMOcbhPaJt3JQNQmM3SJIS40fG4W1Yc9ALpK1N7GYt2sRcczWQTQRJveezh-zoPY-HACeQIViWXR_hktNrILo5o-3lhvlDy1kiB60elO3mWKA6bmHZstJ5pqEuBNR6A0DlpBJ-bbtqZBDqMVrjVoromcvucN3ybY3zUOWonD5g1_5kRfRo9C451BAMZ0W1uH4u5pmr3qNTcoxJJ55K_cT4X8ZFuqIV3DOooFuXOYQiXqPFpEgl--px4vvdQycJyhdtgrxb4FBff1vyMskx00rmA33a5DSqoBxt_HzzXqBWNTw6VXj0CLhXft6FQ-ojvWaxMMlzFqmB93heEtSrAczb8nTRIlT7fb6q-2MlCr3LxCjd9VhkVyzL=w1344-h662-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/mv9qalSsV8wrJjeugYDvhdVF-WEVfsNahKVIVg8CZ6NfN9tisVjGPch-VyQG4Ij4fCG6Z_LY5B-uwX30pI2BXBre3SxsWHF_v2pF-CwNGiB9Z5jj-_zEbqL5p2vGj3YRsUG2fY9TO1eAWZ-Pf3YiuS55cPdpc52cprwtRFpGBZ0NjpDAefNZYBHvabj5H_Rgg29U7R8KVvJj95bA_Dj12kqbxZFZB6otTfyikWskXTQa6Vy5yEqv7-KlU96jrowouyIQsXER0FaedD2X6aHPvA6dFhVmK5lJ9LwVr01Ani16vqjOcDf__FCh6o5iPTkLFPCccLPBhtT4kd2AotQCyopvmH8wyewYLFeG6mNi6bEnh35UfPix500VPTviZkW4UVMy5dIOWHalfdO7VXkbGIq--dsO7H9OPQ3BHLA5MKmjmER4Wg1Mi8vxI8xm7Rx6mTo8BQBNixAuVBPjgVIEjgUKJGTOFeXNrNVL685EuWTMVfhJSepjxjSNUtEjkeHxy03NjWd_8JUgfVFpr1Yer_5qGjg7zAFOB0XDbNn_nhl-CRZW_pRj4GQ_NwumV2ICD0IMPxOj17bxbA8tpf8rqWo9x__pgyWeeuYUMBWrnH1NfozG=w1345-h670-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/lF39CW32xGI1aCvNJU7eZmIKn94wkt9qiWqjqsaO7DR60azWq94_SnVPWG3cx0bDY-oX-vaZKCa_hA1jvjpZ7JTLVPo1HtYobNArbvP6HcrsBn0oTLs7I25ChfLsdlMI-GywLSMgrx4paTLJxEWuiqXBxkRGA7S59BH_CQ1w53H3cPvD34k3Ps9HxvTetDwjx6YiVe0JAMXGLHjtUYKDwaAi4pSxVnTRDwS84KSm9dTyhdU-I014QSP_RA6gHR8krt2Ddlwr9CaPWc2yAe214G1_gN1inUoTMmI6mZr3vY9qdB5JVLodTNEGtfqgpzy8s-wAGHhjI7JPsWbsa0UEOzS3WBpzbfiOR66L1ops7PiTRjvhr9HMS5er0a3P_lQUK8r7hq37lDMk9nflkyOkzcFhSvRGP6TS83TJR4X95tcal0uTP6pYPeC0C41IpomtXRalqIB9dx1tAQfBWlY9WRhZADnwLIkWxm5U8vqEhXBq6RQFhRBiWlInMwOI01bmInLvioAwd0bohHtNd2yP_pU-WeCu2slVxpG-HTRacW14vvpcBJKGy2k0sjCnngI1FFb8X7NHSdQy_etGkaggWJ2mfgAvD8DzSfNvScchUhbkcqq4=w1353-h669-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>4. Quản lý plugin</h3>\r\n<p><img src=\"https://lh3.googleusercontent.com/03ZeATliabVof9wqnXaoI4a3m52QOYhC7bPpAyUihUpthcH2yilmrA45oX4w5PbG_99bDvy9tKPD0iOrDCqEpEMR0xfHxczuBxLISD96inWaZW6fHo9YMeHZm_8ULpZSQxK5bvORy9iQ2FBT6xBGuYPeVjVOzNcO839cC0ZjnaTxQUozTm8SA4Fe938L4kT4xeNAVYMHourqELmoC1tjgIr8oq66Wze_loZuY35kBZlX8iFGoFiC4gkjO_yT16q4wpeqRzP7rWOdztqmZpZ5wrbTSusbfi1Dn2ghIABvS4uqrF7gi_JIL9AlSEhnFTHY7QaDH4Q7N8m3r3n2rZWD43iaRIauOm4mXgP1XpaTzZjVjehXLfgG8BNNIq56KldAlroHbGblojOS_gPHuYCvsxk3mckq6oHvGLh4_HyxYl7JAuG0hYxN0sIimEd8GehVV-EqNnbPWAocxytigYnX4SiMndGOtVet6o2XvrDLMlHN8ASKxcO59IJ8Se7hzaCfcJ6wQpl5kvJE4oITxA4R-5_1ezvnZDPGt7jyPuIv1wGsks2YJ1apYIBMQEOhKdlCDkqQC_hBx0vLhq8zxgNgptZKv2opfPGZ9j6KQPqNL3khGoRv=w1352-h666-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>5. Sử dụng một số concept của Wordpress</h3>\r\n<p>Như các bạn đã biết, Wordpress có rất nhiều tính năng hay. Vì vậy mình đã áp dụng Filter, Action hook và Metabox vào Botble để có thể dễ dàng hơn cho các bạn can thiệp vào core sau này.</p>\r\n<h3>Kết luận:</h3>\r\n<p>Trên đây là một số tính năng mới của Botble version 2.0, hi vọng các bạn cảm thấy hứng thú với CMS này.</p>\r\n<p>Các bạn có thể mua ủng hộ mình trên Codecanyon https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182 hoặc liên hệ trực tiếp với mình qua skype live:minsang2603 để được hỗ trợ.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476890029-hero01.jpg', 0, NULL, '2018-04-13 10:02:20', '2018-04-13 10:02:20'),
(53, 'Hành trình tìm kiếm sự khác biệt', 'Hành trình tìm kiếm sự khác biệt', '<p>Hi mọi người,  dạo gần đây mình không viết blog mới vì tập trung phát triển Botble CMS. Sau bao cố gắng thì hôm nay mình đã có thể release version 2.0 với nhiều tính năng mới.</p>\r\n<p>Ở bản 1.0, mình cảm thấy nó có quá nhiều tính năng phức tạp, chỉ phù hợp với hệ thống lớn mà đa số các website nhỏ không cần đến, vì vậy mình đã đơn giản bớt đi trong phần này và tập trung làm sao cho Botble CMS dễ sử dụng nhất.</p>\r\n<p>Botble CMS đang sử dụng Laravel phiên bản mới nhất tại thời điểm này 5.3.</p>\r\n<h3>Demo:</h3>\r\n<p>Homepage: <a href=\"http://cms.botble.com/\">http://cms.botble.com</a></p>\r\n<p>Admin: <a href=\"http://cms.botble.com/admin\">http://cms.botble.com/admin</a></p>\r\n<p>Account: botble - 159357</p>\r\n<p> </p>\r\n<h3>Cấu trúc thư mục:</h3>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Core-700x328.png\" alt=\"core\" /></p>\r\n<p>Botble version 2 đã được tổ chức thành từng module theo dạng HMVC và nằm hoàn toàn trong thư mục /core. Những thư mục khác hầu hết được giữ nguyên hiện trạng như bản cài mới laravel. Điều này giúp dễ dàng hơn trong việc cập nhật, nâng cấp sau này.</p>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Theme-700x326.png\" alt=\"theme\" /></p>\r\n<p>Tách biệt thư mục theme và chuẩn cấu trúc theme.</p>\r\n<p> </p>\r\n<p>Mình xin nói sơ qua một số tính năng mới trong bản này.</p>\r\n<ol>\r\n<li>\r\n<h3>Hỗ trợ cài đặt.</h3>\r\n</li>\r\n</ol>\r\n<p>Nhiều người gặp khó khăn trong việc cài đặt Botble, đa số đó là những người mới làm quen laravel. Vì vậy mình đã viết 1 đoạn script để hỗ trợ cài đặt nhanh chóng qua command line.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/DAZe2V_A0wo?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<h3>2. Tạo 1 module/plugin mới một cách nhanh chóng với CRUD và permissions.</h3>\r\n<p><iframe src=\"https://www.youtube.com/embed/8F4wfrS9svs?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Việc loại bỏ 1 module không cần thiết cũng đơn giản hơn bao giờ hết.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/jmex2G4eC18?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Do hơi bận rộn nên mình chỉ có thể quay một số video hướng dẫn trên, sẽ bổ sung sau :D</p>\r\n<h3>3. Theme mới</h3>\r\n<p>Trong bản cập nhật này, nhờ sự giúp đỡ của bạn <a href=\"http://nghiadev.com/\">Minh Nghĩa</a>, Botble front page đã được khoác lên bộ áo mới mà mình đánh giá là đẹp hơn rất nhiều so với theme mặc định cũ.</p>\r\n<p>Một số hình ảnh:</p>\r\n<p><img src=\"https://lh3.googleusercontent.com/GuJDOdVnDbOVIneN9Qwvo5G_CkX8lx09S0fqifpEvWODI5vFPk4qdvqHITQFbKbdlUoZhB1FMaiTS4-qG2c0qKNGnOoj0oe5Gh9bv9xLg_wp_mWFysuKj9R-WQEufFXzYMrwQ30HRnvebvJqeGCBXhU5RatFHTBbv-8lwoWXZVXd3G1eUSOPKn1S1dVTsoXf7XxzFzN-Vny8uypcJxT2ZenVA1jDQ4doIPky0LHLra08TnMJZ8zh4lMSm8r5PiWXPCpLhBr4OhFTWjYk4dMgo19rggDGJvFZnvFwl682bD0EBqbhITdR4tAni-CTiprbroUuBo5aKX3MFnKIMyVQcc5H5tNuJgtieDuVDe0ZjePxvQzwbG-Vzoz7cEMOLp7G23fTG3L_w3Czpt2p8TzE8nsa8xYdu5yWIetxoYfWRGMYQCHtINnbglYDKuK1wFnXu41rzOO8p4y7NF5rksoAuNleDD9RB24JR3a6J2zhOnvRL5EWlq3HlZbUdn7cybXn3rnJY9rWqBjubFUz8d-lPtObLi4dHzYxT6KfDMRzwMXcPx_RxZVc-6ZOEn2e051DsccRfb-IvurAzppoqnYlfxFEUYZMq8c5s-GNeRKOwqXFhEs4=w655-h324-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/0S7CR_aFNK7QzUEf8Oo6gnwBU1htFdqYLWmX5VQHMZusY47Xyk_jim18FiAwWlVz4WVtn56AMhlhTqtNDMdBpVi2w8pc4yShEYs2-5gr9qIDPxylbCOKfQqj-zzGS8kR7v5xBBph55FE5YFXWEnDQEYo0udhhoNAY-nDpmIi3t3Ho_BqUf8U0E13WDUf-Iu-UQSrvUfFqdqmVubGBuuSx6xXtnj3RBwUcoFdHkFihdXneylcNppQRnTPg3bMOcbhPaJt3JQNQmM3SJIS40fG4W1Yc9ALpK1N7GYt2sRcczWQTQRJveezh-zoPY-HACeQIViWXR_hktNrILo5o-3lhvlDy1kiB60elO3mWKA6bmHZstJ5pqEuBNR6A0DlpBJ-bbtqZBDqMVrjVoromcvucN3ybY3zUOWonD5g1_5kRfRo9C451BAMZ0W1uH4u5pmr3qNTcoxJJ55K_cT4X8ZFuqIV3DOooFuXOYQiXqPFpEgl--px4vvdQycJyhdtgrxb4FBff1vyMskx00rmA33a5DSqoBxt_HzzXqBWNTw6VXj0CLhXft6FQ-ojvWaxMMlzFqmB93heEtSrAczb8nTRIlT7fb6q-2MlCr3LxCjd9VhkVyzL=w1344-h662-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/mv9qalSsV8wrJjeugYDvhdVF-WEVfsNahKVIVg8CZ6NfN9tisVjGPch-VyQG4Ij4fCG6Z_LY5B-uwX30pI2BXBre3SxsWHF_v2pF-CwNGiB9Z5jj-_zEbqL5p2vGj3YRsUG2fY9TO1eAWZ-Pf3YiuS55cPdpc52cprwtRFpGBZ0NjpDAefNZYBHvabj5H_Rgg29U7R8KVvJj95bA_Dj12kqbxZFZB6otTfyikWskXTQa6Vy5yEqv7-KlU96jrowouyIQsXER0FaedD2X6aHPvA6dFhVmK5lJ9LwVr01Ani16vqjOcDf__FCh6o5iPTkLFPCccLPBhtT4kd2AotQCyopvmH8wyewYLFeG6mNi6bEnh35UfPix500VPTviZkW4UVMy5dIOWHalfdO7VXkbGIq--dsO7H9OPQ3BHLA5MKmjmER4Wg1Mi8vxI8xm7Rx6mTo8BQBNixAuVBPjgVIEjgUKJGTOFeXNrNVL685EuWTMVfhJSepjxjSNUtEjkeHxy03NjWd_8JUgfVFpr1Yer_5qGjg7zAFOB0XDbNn_nhl-CRZW_pRj4GQ_NwumV2ICD0IMPxOj17bxbA8tpf8rqWo9x__pgyWeeuYUMBWrnH1NfozG=w1345-h670-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/lF39CW32xGI1aCvNJU7eZmIKn94wkt9qiWqjqsaO7DR60azWq94_SnVPWG3cx0bDY-oX-vaZKCa_hA1jvjpZ7JTLVPo1HtYobNArbvP6HcrsBn0oTLs7I25ChfLsdlMI-GywLSMgrx4paTLJxEWuiqXBxkRGA7S59BH_CQ1w53H3cPvD34k3Ps9HxvTetDwjx6YiVe0JAMXGLHjtUYKDwaAi4pSxVnTRDwS84KSm9dTyhdU-I014QSP_RA6gHR8krt2Ddlwr9CaPWc2yAe214G1_gN1inUoTMmI6mZr3vY9qdB5JVLodTNEGtfqgpzy8s-wAGHhjI7JPsWbsa0UEOzS3WBpzbfiOR66L1ops7PiTRjvhr9HMS5er0a3P_lQUK8r7hq37lDMk9nflkyOkzcFhSvRGP6TS83TJR4X95tcal0uTP6pYPeC0C41IpomtXRalqIB9dx1tAQfBWlY9WRhZADnwLIkWxm5U8vqEhXBq6RQFhRBiWlInMwOI01bmInLvioAwd0bohHtNd2yP_pU-WeCu2slVxpG-HTRacW14vvpcBJKGy2k0sjCnngI1FFb8X7NHSdQy_etGkaggWJ2mfgAvD8DzSfNvScchUhbkcqq4=w1353-h669-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>4. Quản lý plugin</h3>\r\n<p><img src=\"https://lh3.googleusercontent.com/03ZeATliabVof9wqnXaoI4a3m52QOYhC7bPpAyUihUpthcH2yilmrA45oX4w5PbG_99bDvy9tKPD0iOrDCqEpEMR0xfHxczuBxLISD96inWaZW6fHo9YMeHZm_8ULpZSQxK5bvORy9iQ2FBT6xBGuYPeVjVOzNcO839cC0ZjnaTxQUozTm8SA4Fe938L4kT4xeNAVYMHourqELmoC1tjgIr8oq66Wze_loZuY35kBZlX8iFGoFiC4gkjO_yT16q4wpeqRzP7rWOdztqmZpZ5wrbTSusbfi1Dn2ghIABvS4uqrF7gi_JIL9AlSEhnFTHY7QaDH4Q7N8m3r3n2rZWD43iaRIauOm4mXgP1XpaTzZjVjehXLfgG8BNNIq56KldAlroHbGblojOS_gPHuYCvsxk3mckq6oHvGLh4_HyxYl7JAuG0hYxN0sIimEd8GehVV-EqNnbPWAocxytigYnX4SiMndGOtVet6o2XvrDLMlHN8ASKxcO59IJ8Se7hzaCfcJ6wQpl5kvJE4oITxA4R-5_1ezvnZDPGt7jyPuIv1wGsks2YJ1apYIBMQEOhKdlCDkqQC_hBx0vLhq8zxgNgptZKv2opfPGZ9j6KQPqNL3khGoRv=w1352-h666-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>5. Sử dụng một số concept của Wordpress</h3>\r\n<p>Như các bạn đã biết, Wordpress có rất nhiều tính năng hay. Vì vậy mình đã áp dụng Filter, Action hook và Metabox vào Botble để có thể dễ dàng hơn cho các bạn can thiệp vào core sau này.</p>\r\n<h3>Kết luận:</h3>\r\n<p>Trên đây là một số tính năng mới của Botble version 2.0, hi vọng các bạn cảm thấy hứng thú với CMS này.</p>\r\n<p>Các bạn có thể mua ủng hộ mình trên Codecanyon https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182 hoặc liên hệ trực tiếp với mình qua skype live:minsang2603 để được hỗ trợ.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476891195-02.jpg', 0, NULL, '2018-04-13 10:02:59', '2018-04-13 10:02:59'),
(54, 'Thế giới động vật muôn màu', 'Thế giới động vật muôn màu', '<p>Hi mọi người,  dạo gần đây mình không viết blog mới vì tập trung phát triển Botble CMS. Sau bao cố gắng thì hôm nay mình đã có thể release version 2.0 với nhiều tính năng mới.</p>\r\n<p>Ở bản 1.0, mình cảm thấy nó có quá nhiều tính năng phức tạp, chỉ phù hợp với hệ thống lớn mà đa số các website nhỏ không cần đến, vì vậy mình đã đơn giản bớt đi trong phần này và tập trung làm sao cho Botble CMS dễ sử dụng nhất.</p>\r\n<p>Botble CMS đang sử dụng Laravel phiên bản mới nhất tại thời điểm này 5.3.</p>\r\n<h3>Demo:</h3>\r\n<p>Homepage: <a href=\"http://cms.botble.com/\">http://cms.botble.com</a></p>\r\n<p>Admin: <a href=\"http://cms.botble.com/admin\">http://cms.botble.com/admin</a></p>\r\n<p>Account: botble - 159357</p>\r\n<p> </p>\r\n<h3>Cấu trúc thư mục:</h3>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Core-700x328.png\" alt=\"core\" /></p>\r\n<p>Botble version 2 đã được tổ chức thành từng module theo dạng HMVC và nằm hoàn toàn trong thư mục /core. Những thư mục khác hầu hết được giữ nguyên hiện trạng như bản cài mới laravel. Điều này giúp dễ dàng hơn trong việc cập nhật, nâng cấp sau này.</p>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Theme-700x326.png\" alt=\"theme\" /></p>\r\n<p>Tách biệt thư mục theme và chuẩn cấu trúc theme.</p>\r\n<p> </p>\r\n<p>Mình xin nói sơ qua một số tính năng mới trong bản này.</p>\r\n<ol>\r\n<li>\r\n<h3>Hỗ trợ cài đặt.</h3>\r\n</li>\r\n</ol>\r\n<p>Nhiều người gặp khó khăn trong việc cài đặt Botble, đa số đó là những người mới làm quen laravel. Vì vậy mình đã viết 1 đoạn script để hỗ trợ cài đặt nhanh chóng qua command line.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/DAZe2V_A0wo?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<h3>2. Tạo 1 module/plugin mới một cách nhanh chóng với CRUD và permissions.</h3>\r\n<p><iframe src=\"https://www.youtube.com/embed/8F4wfrS9svs?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Việc loại bỏ 1 module không cần thiết cũng đơn giản hơn bao giờ hết.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/jmex2G4eC18?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Do hơi bận rộn nên mình chỉ có thể quay một số video hướng dẫn trên, sẽ bổ sung sau :D</p>\r\n<h3>3. Theme mới</h3>\r\n<p>Trong bản cập nhật này, nhờ sự giúp đỡ của bạn <a href=\"http://nghiadev.com/\">Minh Nghĩa</a>, Botble front page đã được khoác lên bộ áo mới mà mình đánh giá là đẹp hơn rất nhiều so với theme mặc định cũ.</p>\r\n<p>Một số hình ảnh:</p>\r\n<p><img src=\"https://lh3.googleusercontent.com/GuJDOdVnDbOVIneN9Qwvo5G_CkX8lx09S0fqifpEvWODI5vFPk4qdvqHITQFbKbdlUoZhB1FMaiTS4-qG2c0qKNGnOoj0oe5Gh9bv9xLg_wp_mWFysuKj9R-WQEufFXzYMrwQ30HRnvebvJqeGCBXhU5RatFHTBbv-8lwoWXZVXd3G1eUSOPKn1S1dVTsoXf7XxzFzN-Vny8uypcJxT2ZenVA1jDQ4doIPky0LHLra08TnMJZ8zh4lMSm8r5PiWXPCpLhBr4OhFTWjYk4dMgo19rggDGJvFZnvFwl682bD0EBqbhITdR4tAni-CTiprbroUuBo5aKX3MFnKIMyVQcc5H5tNuJgtieDuVDe0ZjePxvQzwbG-Vzoz7cEMOLp7G23fTG3L_w3Czpt2p8TzE8nsa8xYdu5yWIetxoYfWRGMYQCHtINnbglYDKuK1wFnXu41rzOO8p4y7NF5rksoAuNleDD9RB24JR3a6J2zhOnvRL5EWlq3HlZbUdn7cybXn3rnJY9rWqBjubFUz8d-lPtObLi4dHzYxT6KfDMRzwMXcPx_RxZVc-6ZOEn2e051DsccRfb-IvurAzppoqnYlfxFEUYZMq8c5s-GNeRKOwqXFhEs4=w655-h324-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/0S7CR_aFNK7QzUEf8Oo6gnwBU1htFdqYLWmX5VQHMZusY47Xyk_jim18FiAwWlVz4WVtn56AMhlhTqtNDMdBpVi2w8pc4yShEYs2-5gr9qIDPxylbCOKfQqj-zzGS8kR7v5xBBph55FE5YFXWEnDQEYo0udhhoNAY-nDpmIi3t3Ho_BqUf8U0E13WDUf-Iu-UQSrvUfFqdqmVubGBuuSx6xXtnj3RBwUcoFdHkFihdXneylcNppQRnTPg3bMOcbhPaJt3JQNQmM3SJIS40fG4W1Yc9ALpK1N7GYt2sRcczWQTQRJveezh-zoPY-HACeQIViWXR_hktNrILo5o-3lhvlDy1kiB60elO3mWKA6bmHZstJ5pqEuBNR6A0DlpBJ-bbtqZBDqMVrjVoromcvucN3ybY3zUOWonD5g1_5kRfRo9C451BAMZ0W1uH4u5pmr3qNTcoxJJ55K_cT4X8ZFuqIV3DOooFuXOYQiXqPFpEgl--px4vvdQycJyhdtgrxb4FBff1vyMskx00rmA33a5DSqoBxt_HzzXqBWNTw6VXj0CLhXft6FQ-ojvWaxMMlzFqmB93heEtSrAczb8nTRIlT7fb6q-2MlCr3LxCjd9VhkVyzL=w1344-h662-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/mv9qalSsV8wrJjeugYDvhdVF-WEVfsNahKVIVg8CZ6NfN9tisVjGPch-VyQG4Ij4fCG6Z_LY5B-uwX30pI2BXBre3SxsWHF_v2pF-CwNGiB9Z5jj-_zEbqL5p2vGj3YRsUG2fY9TO1eAWZ-Pf3YiuS55cPdpc52cprwtRFpGBZ0NjpDAefNZYBHvabj5H_Rgg29U7R8KVvJj95bA_Dj12kqbxZFZB6otTfyikWskXTQa6Vy5yEqv7-KlU96jrowouyIQsXER0FaedD2X6aHPvA6dFhVmK5lJ9LwVr01Ani16vqjOcDf__FCh6o5iPTkLFPCccLPBhtT4kd2AotQCyopvmH8wyewYLFeG6mNi6bEnh35UfPix500VPTviZkW4UVMy5dIOWHalfdO7VXkbGIq--dsO7H9OPQ3BHLA5MKmjmER4Wg1Mi8vxI8xm7Rx6mTo8BQBNixAuVBPjgVIEjgUKJGTOFeXNrNVL685EuWTMVfhJSepjxjSNUtEjkeHxy03NjWd_8JUgfVFpr1Yer_5qGjg7zAFOB0XDbNn_nhl-CRZW_pRj4GQ_NwumV2ICD0IMPxOj17bxbA8tpf8rqWo9x__pgyWeeuYUMBWrnH1NfozG=w1345-h670-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/lF39CW32xGI1aCvNJU7eZmIKn94wkt9qiWqjqsaO7DR60azWq94_SnVPWG3cx0bDY-oX-vaZKCa_hA1jvjpZ7JTLVPo1HtYobNArbvP6HcrsBn0oTLs7I25ChfLsdlMI-GywLSMgrx4paTLJxEWuiqXBxkRGA7S59BH_CQ1w53H3cPvD34k3Ps9HxvTetDwjx6YiVe0JAMXGLHjtUYKDwaAi4pSxVnTRDwS84KSm9dTyhdU-I014QSP_RA6gHR8krt2Ddlwr9CaPWc2yAe214G1_gN1inUoTMmI6mZr3vY9qdB5JVLodTNEGtfqgpzy8s-wAGHhjI7JPsWbsa0UEOzS3WBpzbfiOR66L1ops7PiTRjvhr9HMS5er0a3P_lQUK8r7hq37lDMk9nflkyOkzcFhSvRGP6TS83TJR4X95tcal0uTP6pYPeC0C41IpomtXRalqIB9dx1tAQfBWlY9WRhZADnwLIkWxm5U8vqEhXBq6RQFhRBiWlInMwOI01bmInLvioAwd0bohHtNd2yP_pU-WeCu2slVxpG-HTRacW14vvpcBJKGy2k0sjCnngI1FFb8X7NHSdQy_etGkaggWJ2mfgAvD8DzSfNvScchUhbkcqq4=w1353-h669-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>4. Quản lý plugin</h3>\r\n<p><img src=\"https://lh3.googleusercontent.com/03ZeATliabVof9wqnXaoI4a3m52QOYhC7bPpAyUihUpthcH2yilmrA45oX4w5PbG_99bDvy9tKPD0iOrDCqEpEMR0xfHxczuBxLISD96inWaZW6fHo9YMeHZm_8ULpZSQxK5bvORy9iQ2FBT6xBGuYPeVjVOzNcO839cC0ZjnaTxQUozTm8SA4Fe938L4kT4xeNAVYMHourqELmoC1tjgIr8oq66Wze_loZuY35kBZlX8iFGoFiC4gkjO_yT16q4wpeqRzP7rWOdztqmZpZ5wrbTSusbfi1Dn2ghIABvS4uqrF7gi_JIL9AlSEhnFTHY7QaDH4Q7N8m3r3n2rZWD43iaRIauOm4mXgP1XpaTzZjVjehXLfgG8BNNIq56KldAlroHbGblojOS_gPHuYCvsxk3mckq6oHvGLh4_HyxYl7JAuG0hYxN0sIimEd8GehVV-EqNnbPWAocxytigYnX4SiMndGOtVet6o2XvrDLMlHN8ASKxcO59IJ8Se7hzaCfcJ6wQpl5kvJE4oITxA4R-5_1ezvnZDPGt7jyPuIv1wGsks2YJ1apYIBMQEOhKdlCDkqQC_hBx0vLhq8zxgNgptZKv2opfPGZ9j6KQPqNL3khGoRv=w1352-h666-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>5. Sử dụng một số concept của Wordpress</h3>\r\n<p>Như các bạn đã biết, Wordpress có rất nhiều tính năng hay. Vì vậy mình đã áp dụng Filter, Action hook và Metabox vào Botble để có thể dễ dàng hơn cho các bạn can thiệp vào core sau này.</p>\r\n<h3>Kết luận:</h3>\r\n<p>Trên đây là một số tính năng mới của Botble version 2.0, hi vọng các bạn cảm thấy hứng thú với CMS này.</p>\r\n<p>Các bạn có thể mua ủng hộ mình trên Codecanyon https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182 hoặc liên hệ trực tiếp với mình qua skype live:minsang2603 để được hỗ trợ.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/7717834982-bbd7e12b8c-b-660x330.jpg', 0, NULL, '2018-04-13 10:03:46', '2018-04-13 10:04:20'),
(55, 'Đi tìm hồi ức tuổi thơ', 'Đi tìm hồi ức tuổi thơ', '<p>Hi mọi người,  dạo gần đây mình không viết blog mới vì tập trung phát triển Botble CMS. Sau bao cố gắng thì hôm nay mình đã có thể release version 2.0 với nhiều tính năng mới.</p>\r\n<p>Ở bản 1.0, mình cảm thấy nó có quá nhiều tính năng phức tạp, chỉ phù hợp với hệ thống lớn mà đa số các website nhỏ không cần đến, vì vậy mình đã đơn giản bớt đi trong phần này và tập trung làm sao cho Botble CMS dễ sử dụng nhất.</p>\r\n<p>Botble CMS đang sử dụng Laravel phiên bản mới nhất tại thời điểm này 5.3.</p>\r\n<h3>Demo:</h3>\r\n<p>Homepage: <a href=\"http://cms.botble.com/\">http://cms.botble.com</a></p>\r\n<p>Admin: <a href=\"http://cms.botble.com/admin\">http://cms.botble.com/admin</a></p>\r\n<p>Account: botble - 159357</p>\r\n<p> </p>\r\n<h3>Cấu trúc thư mục:</h3>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Core-700x328.png\" alt=\"core\" /></p>\r\n<p>Botble version 2 đã được tổ chức thành từng module theo dạng HMVC và nằm hoàn toàn trong thư mục /core. Những thư mục khác hầu hết được giữ nguyên hiện trạng như bản cài mới laravel. Điều này giúp dễ dàng hơn trong việc cập nhật, nâng cấp sau này.</p>\r\n<p><img src=\"http://sangplus.com/wp-content/uploads/2016/10/Theme-700x326.png\" alt=\"theme\" /></p>\r\n<p>Tách biệt thư mục theme và chuẩn cấu trúc theme.</p>\r\n<p> </p>\r\n<p>Mình xin nói sơ qua một số tính năng mới trong bản này.</p>\r\n<ol>\r\n<li>\r\n<h3>Hỗ trợ cài đặt.</h3>\r\n</li>\r\n</ol>\r\n<p>Nhiều người gặp khó khăn trong việc cài đặt Botble, đa số đó là những người mới làm quen laravel. Vì vậy mình đã viết 1 đoạn script để hỗ trợ cài đặt nhanh chóng qua command line.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/DAZe2V_A0wo?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<h3>2. Tạo 1 module/plugin mới một cách nhanh chóng với CRUD và permissions.</h3>\r\n<p><iframe src=\"https://www.youtube.com/embed/8F4wfrS9svs?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Việc loại bỏ 1 module không cần thiết cũng đơn giản hơn bao giờ hết.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/jmex2G4eC18?feature=oembed\" width=\"900\" height=\"506\" frameborder=\"0\"></iframe></p>\r\n<p> </p>\r\n<p>Do hơi bận rộn nên mình chỉ có thể quay một số video hướng dẫn trên, sẽ bổ sung sau :D</p>\r\n<h3>3. Theme mới</h3>\r\n<p>Trong bản cập nhật này, nhờ sự giúp đỡ của bạn <a href=\"http://nghiadev.com/\">Minh Nghĩa</a>, Botble front page đã được khoác lên bộ áo mới mà mình đánh giá là đẹp hơn rất nhiều so với theme mặc định cũ.</p>\r\n<p>Một số hình ảnh:</p>\r\n<p><img src=\"https://lh3.googleusercontent.com/GuJDOdVnDbOVIneN9Qwvo5G_CkX8lx09S0fqifpEvWODI5vFPk4qdvqHITQFbKbdlUoZhB1FMaiTS4-qG2c0qKNGnOoj0oe5Gh9bv9xLg_wp_mWFysuKj9R-WQEufFXzYMrwQ30HRnvebvJqeGCBXhU5RatFHTBbv-8lwoWXZVXd3G1eUSOPKn1S1dVTsoXf7XxzFzN-Vny8uypcJxT2ZenVA1jDQ4doIPky0LHLra08TnMJZ8zh4lMSm8r5PiWXPCpLhBr4OhFTWjYk4dMgo19rggDGJvFZnvFwl682bD0EBqbhITdR4tAni-CTiprbroUuBo5aKX3MFnKIMyVQcc5H5tNuJgtieDuVDe0ZjePxvQzwbG-Vzoz7cEMOLp7G23fTG3L_w3Czpt2p8TzE8nsa8xYdu5yWIetxoYfWRGMYQCHtINnbglYDKuK1wFnXu41rzOO8p4y7NF5rksoAuNleDD9RB24JR3a6J2zhOnvRL5EWlq3HlZbUdn7cybXn3rnJY9rWqBjubFUz8d-lPtObLi4dHzYxT6KfDMRzwMXcPx_RxZVc-6ZOEn2e051DsccRfb-IvurAzppoqnYlfxFEUYZMq8c5s-GNeRKOwqXFhEs4=w655-h324-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/0S7CR_aFNK7QzUEf8Oo6gnwBU1htFdqYLWmX5VQHMZusY47Xyk_jim18FiAwWlVz4WVtn56AMhlhTqtNDMdBpVi2w8pc4yShEYs2-5gr9qIDPxylbCOKfQqj-zzGS8kR7v5xBBph55FE5YFXWEnDQEYo0udhhoNAY-nDpmIi3t3Ho_BqUf8U0E13WDUf-Iu-UQSrvUfFqdqmVubGBuuSx6xXtnj3RBwUcoFdHkFihdXneylcNppQRnTPg3bMOcbhPaJt3JQNQmM3SJIS40fG4W1Yc9ALpK1N7GYt2sRcczWQTQRJveezh-zoPY-HACeQIViWXR_hktNrILo5o-3lhvlDy1kiB60elO3mWKA6bmHZstJ5pqEuBNR6A0DlpBJ-bbtqZBDqMVrjVoromcvucN3ybY3zUOWonD5g1_5kRfRo9C451BAMZ0W1uH4u5pmr3qNTcoxJJ55K_cT4X8ZFuqIV3DOooFuXOYQiXqPFpEgl--px4vvdQycJyhdtgrxb4FBff1vyMskx00rmA33a5DSqoBxt_HzzXqBWNTw6VXj0CLhXft6FQ-ojvWaxMMlzFqmB93heEtSrAczb8nTRIlT7fb6q-2MlCr3LxCjd9VhkVyzL=w1344-h662-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/mv9qalSsV8wrJjeugYDvhdVF-WEVfsNahKVIVg8CZ6NfN9tisVjGPch-VyQG4Ij4fCG6Z_LY5B-uwX30pI2BXBre3SxsWHF_v2pF-CwNGiB9Z5jj-_zEbqL5p2vGj3YRsUG2fY9TO1eAWZ-Pf3YiuS55cPdpc52cprwtRFpGBZ0NjpDAefNZYBHvabj5H_Rgg29U7R8KVvJj95bA_Dj12kqbxZFZB6otTfyikWskXTQa6Vy5yEqv7-KlU96jrowouyIQsXER0FaedD2X6aHPvA6dFhVmK5lJ9LwVr01Ani16vqjOcDf__FCh6o5iPTkLFPCccLPBhtT4kd2AotQCyopvmH8wyewYLFeG6mNi6bEnh35UfPix500VPTviZkW4UVMy5dIOWHalfdO7VXkbGIq--dsO7H9OPQ3BHLA5MKmjmER4Wg1Mi8vxI8xm7Rx6mTo8BQBNixAuVBPjgVIEjgUKJGTOFeXNrNVL685EuWTMVfhJSepjxjSNUtEjkeHxy03NjWd_8JUgfVFpr1Yer_5qGjg7zAFOB0XDbNn_nhl-CRZW_pRj4GQ_NwumV2ICD0IMPxOj17bxbA8tpf8rqWo9x__pgyWeeuYUMBWrnH1NfozG=w1345-h670-no\" alt=\"\" /></p>\r\n<p><img src=\"https://lh3.googleusercontent.com/lF39CW32xGI1aCvNJU7eZmIKn94wkt9qiWqjqsaO7DR60azWq94_SnVPWG3cx0bDY-oX-vaZKCa_hA1jvjpZ7JTLVPo1HtYobNArbvP6HcrsBn0oTLs7I25ChfLsdlMI-GywLSMgrx4paTLJxEWuiqXBxkRGA7S59BH_CQ1w53H3cPvD34k3Ps9HxvTetDwjx6YiVe0JAMXGLHjtUYKDwaAi4pSxVnTRDwS84KSm9dTyhdU-I014QSP_RA6gHR8krt2Ddlwr9CaPWc2yAe214G1_gN1inUoTMmI6mZr3vY9qdB5JVLodTNEGtfqgpzy8s-wAGHhjI7JPsWbsa0UEOzS3WBpzbfiOR66L1ops7PiTRjvhr9HMS5er0a3P_lQUK8r7hq37lDMk9nflkyOkzcFhSvRGP6TS83TJR4X95tcal0uTP6pYPeC0C41IpomtXRalqIB9dx1tAQfBWlY9WRhZADnwLIkWxm5U8vqEhXBq6RQFhRBiWlInMwOI01bmInLvioAwd0bohHtNd2yP_pU-WeCu2slVxpG-HTRacW14vvpcBJKGy2k0sjCnngI1FFb8X7NHSdQy_etGkaggWJ2mfgAvD8DzSfNvScchUhbkcqq4=w1353-h669-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>4. Quản lý plugin</h3>\r\n<p><img src=\"https://lh3.googleusercontent.com/03ZeATliabVof9wqnXaoI4a3m52QOYhC7bPpAyUihUpthcH2yilmrA45oX4w5PbG_99bDvy9tKPD0iOrDCqEpEMR0xfHxczuBxLISD96inWaZW6fHo9YMeHZm_8ULpZSQxK5bvORy9iQ2FBT6xBGuYPeVjVOzNcO839cC0ZjnaTxQUozTm8SA4Fe938L4kT4xeNAVYMHourqELmoC1tjgIr8oq66Wze_loZuY35kBZlX8iFGoFiC4gkjO_yT16q4wpeqRzP7rWOdztqmZpZ5wrbTSusbfi1Dn2ghIABvS4uqrF7gi_JIL9AlSEhnFTHY7QaDH4Q7N8m3r3n2rZWD43iaRIauOm4mXgP1XpaTzZjVjehXLfgG8BNNIq56KldAlroHbGblojOS_gPHuYCvsxk3mckq6oHvGLh4_HyxYl7JAuG0hYxN0sIimEd8GehVV-EqNnbPWAocxytigYnX4SiMndGOtVet6o2XvrDLMlHN8ASKxcO59IJ8Se7hzaCfcJ6wQpl5kvJE4oITxA4R-5_1ezvnZDPGt7jyPuIv1wGsks2YJ1apYIBMQEOhKdlCDkqQC_hBx0vLhq8zxgNgptZKv2opfPGZ9j6KQPqNL3khGoRv=w1352-h666-no\" alt=\"\" /></p>\r\n<p> </p>\r\n<h3>5. Sử dụng một số concept của Wordpress</h3>\r\n<p>Như các bạn đã biết, Wordpress có rất nhiều tính năng hay. Vì vậy mình đã áp dụng Filter, Action hook và Metabox vào Botble để có thể dễ dàng hơn cho các bạn can thiệp vào core sau này.</p>\r\n<h3>Kết luận:</h3>\r\n<p>Trên đây là một số tính năng mới của Botble version 2.0, hi vọng các bạn cảm thấy hứng thú với CMS này.</p>\r\n<p>Các bạn có thể mua ủng hộ mình trên Codecanyon https://codecanyon.net/item/botble-cms-php-platform-based-on-laravel-framework/16928182 hoặc liên hệ trực tiếp với mình qua skype live:minsang2603 để được hỗ trợ.</p>', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/1476890036-hero05.jpg', 0, NULL, '2018-04-13 10:06:40', '2018-04-13 10:06:40');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `category_id`, `post_id`) VALUES
(14, 1, 3),
(37, 1, 1),
(48, 1, 2),
(94, 1, 22),
(162, 8, 22),
(164, 6, 23),
(165, 9, 26),
(166, 7, 27),
(167, 7, 28),
(168, 8, 29),
(171, 7, 30),
(172, 8, 31),
(173, 6, 37),
(175, 8, 38),
(176, 7, 39),
(177, 8, 40),
(179, 9, 41),
(181, 7, 42),
(186, 8, 43),
(252, 11, 10),
(255, 11, 13),
(262, 1, 20),
(263, 1, 21),
(265, 7, 45),
(266, 7, 47),
(267, 6, 46),
(279, 1, 8),
(280, 11, 9),
(287, 6, 6),
(289, 1, 5),
(290, 1, 7),
(295, 8, 17),
(302, 6, 18),
(303, 7, 16),
(306, 8, 15),
(308, 1, 19),
(310, 9, 14),
(313, 11, 12),
(314, 9, 11),
(315, 6, 4),
(316, 16, 44),
(318, 17, 48),
(320, 13, 49),
(322, 15, 50),
(333, 15, 51),
(334, 13, 52),
(336, 13, 53),
(337, 16, 53),
(341, 13, 54),
(342, 16, 55);

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`id`, `tag_id`, `post_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 1),
(4, 4, 1),
(5, 1, 1),
(6, 5, 6),
(7, 6, 6),
(8, 5, 8),
(9, 6, 8),
(10, 5, 9),
(11, 6, 9),
(12, 5, 10),
(13, 6, 10),
(14, 5, 11),
(15, 6, 11),
(16, 5, 12),
(17, 6, 12),
(18, 5, 13),
(19, 6, 13),
(20, 5, 14),
(21, 6, 14),
(22, 5, 15),
(23, 6, 15),
(24, 5, 16),
(25, 6, 16),
(26, 5, 17),
(27, 6, 17),
(28, 5, 18),
(29, 6, 18),
(30, 5, 19),
(31, 6, 19),
(32, 5, 20),
(33, 6, 20),
(34, 5, 21),
(35, 6, 21),
(36, 7, 22),
(40, 7, 5),
(41, 7, 7),
(42, 7, 49),
(43, 8, 50),
(44, 9, 50),
(92, 10, 51),
(93, 12, 51),
(94, 16, 51),
(95, 17, 51),
(96, 19, 51),
(97, 23, 51);

-- --------------------------------------------------------

--
-- Table structure for table `request_logs`
--

CREATE TABLE `request_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `status_code` int(11) DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_logs`
--

INSERT INTO `request_logs` (`id`, `status_code`, `url`, `count`, `user_id`, `referrer`, `created_at`, `updated_at`) VALUES
(1, 404, 'http://botble.local/vendor/core/images/flags/us.png', 2, NULL, NULL, '2019-05-22 04:43:29', '2019-05-22 04:43:36'),
(2, 404, 'http://botble.local/vendor/core/images/flags/vn.png', 2, NULL, NULL, '2019-05-22 04:43:29', '2019-05-22 04:43:40'),
(3, 404, 'http://botble.local/vendor/core/images/logo_white.png', 2, NULL, NULL, '2019-05-22 04:43:29', '2019-05-22 04:43:36'),
(4, 404, 'http://botble.local/vendor/core/libraries/simple-line-icons/css/simple-line-icons.css', 1, NULL, NULL, '2019-05-22 04:43:35', '2019-05-22 04:43:35'),
(5, 404, 'http://botble.local/vendor/core/libraries/bootstrap/css/bootstrap.min.css', 1, NULL, NULL, '2019-05-22 04:43:35', '2019-05-22 04:43:35'),
(6, 404, 'http://botble.local/vendor/core/libraries/select2/css/select2-bootstrap.min.css', 1, NULL, NULL, '2019-05-22 04:43:35', '2019-05-22 04:43:35'),
(7, 404, 'http://botble.local/vendor/core/libraries/pace/pace-theme-minimal.css', 1, NULL, NULL, '2019-05-22 04:43:35', '2019-05-22 04:43:35'),
(8, 404, 'http://botble.local/vendor/core/libraries/select2/css/select2.min.css', 1, NULL, NULL, '2019-05-22 04:43:35', '2019-05-22 04:43:35'),
(9, 404, 'http://botble.local/vendor/core/libraries/font-awesome/css/fontawesome.min.css', 1, NULL, NULL, '2019-05-22 04:43:35', '2019-05-22 04:43:35'),
(10, 404, 'http://botble.local/vendor/core/libraries/mcustom-scrollbar/jquery.mCustomScrollbar.css', 1, NULL, NULL, '2019-05-22 04:43:35', '2019-05-22 04:43:35'),
(11, 404, 'http://botble.local/vendor/core/libraries/bootstrap-datepicker/css/bootstrap-datepicker3.min.css', 1, NULL, NULL, '2019-05-22 04:43:35', '2019-05-22 04:43:35'),
(12, 404, 'http://botble.local/vendor/core/libraries/toastr/toastr.min.css', 1, NULL, NULL, '2019-05-22 04:43:35', '2019-05-22 04:43:35'),
(13, 404, 'http://botble.local/vendor/core/libraries/spectrum/spectrum.css', 1, NULL, NULL, '2019-05-22 04:43:35', '2019-05-22 04:43:35'),
(14, 404, 'http://botble.local/vendor/core/libraries/fancybox/jquery.fancybox.min.css', 1, NULL, NULL, '2019-05-22 04:43:35', '2019-05-22 04:43:35'),
(15, 404, 'http://botble.local/vendor/core/libraries/jvectormap/jquery-jvectormap-1.2.2.css', 1, NULL, NULL, '2019-05-22 04:43:35', '2019-05-22 04:43:35'),
(16, 404, 'http://botble.local/vendor/core/libraries/morris/morris.css', 1, NULL, NULL, '2019-05-22 04:43:36', '2019-05-22 04:43:36'),
(17, 404, 'http://botble.local/vendor/core/libraries/respond.min.js', 1, NULL, NULL, '2019-05-22 04:43:37', '2019-05-22 04:43:37'),
(18, 404, 'http://botble.local/vendor/core/libraries/excanvas.min.js', 2, NULL, NULL, '2019-05-22 04:43:37', '2019-05-22 04:43:38'),
(19, 404, 'http://botble.local/vendor/core/libraries/modernizr/modernizr.min.js', 2, NULL, NULL, '2019-05-22 04:43:37', '2019-05-22 04:43:38'),
(20, 404, 'http://botble.local/vendor/core/libraries/select2/js/select2.min.js', 2, NULL, NULL, '2019-05-22 04:43:37', '2019-05-22 04:43:39'),
(21, 404, 'http://botble.local/vendor/core/images/portlet-remove-icon.png', 1, NULL, NULL, '2019-05-22 04:43:37', '2019-05-22 04:43:37'),
(22, 404, 'http://botble.local/vendor/core/images/portlet-expand-icon.png', 1, NULL, NULL, '2019-05-22 04:43:37', '2019-05-22 04:43:37'),
(23, 404, 'http://botble.local/vendor/core/images/portlet-reload-icon.png', 1, NULL, NULL, '2019-05-22 04:43:37', '2019-05-22 04:43:37'),
(24, 404, 'http://botble.local/vendor/core/libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js', 2, NULL, NULL, '2019-05-22 04:43:37', '2019-05-22 04:43:40'),
(25, 404, 'http://botble.local/vendor/core/libraries/jquery-cookie/jquery.cookie.js', 2, NULL, NULL, '2019-05-22 04:43:38', '2019-05-22 04:43:41'),
(26, 404, 'http://botble.local/vendor/core/libraries/toastr/toastr.min.js', 2, NULL, NULL, '2019-05-22 04:43:38', '2019-05-22 04:43:41'),
(27, 404, 'http://botble.local/vendor/core/libraries/pace/pace.min.js', 2, NULL, NULL, '2019-05-22 04:43:38', '2019-05-22 04:43:42'),
(28, 404, 'http://botble.local/vendor/core/libraries/mcustom-scrollbar/jquery.mCustomScrollbar.js', 2, NULL, NULL, '2019-05-22 04:43:38', '2019-05-22 04:43:42'),
(29, 404, 'http://botble.local/vendor/core/libraries/stickytableheaders/jquery.stickytableheaders.js', 2, NULL, NULL, '2019-05-22 04:43:38', '2019-05-22 04:43:43'),
(30, 404, 'http://botble.local/vendor/core/libraries/jquery-waypoints/jquery.waypoints.min.js', 2, NULL, NULL, '2019-05-22 04:43:38', '2019-05-22 04:43:44'),
(31, 404, 'http://botble.local/vendor/core/libraries/spectrum/spectrum.js', 2, NULL, NULL, '2019-05-22 04:43:38', '2019-05-22 04:43:44'),
(32, 404, 'http://botble.local/vendor/core/libraries/fancybox/jquery.fancybox.min.js', 2, NULL, NULL, '2019-05-22 04:43:38', '2019-05-22 04:43:45'),
(33, 404, 'http://botble.local/vendor/core/libraries/jquery.blockui.min.js', 2, NULL, NULL, '2019-05-22 04:43:39', '2019-05-22 04:43:45'),
(34, 404, 'http://botble.local/vendor/core/libraries/sortable/sortable.min.js', 2, NULL, NULL, '2019-05-22 04:43:39', '2019-05-22 04:43:46'),
(35, 404, 'http://botble.local/vendor/core/libraries/jQuery.equalHeights/jquery.equalheights.min.js', 2, NULL, NULL, '2019-05-22 04:43:39', '2019-05-22 04:43:46'),
(36, 404, 'http://botble.local/vendor/core/libraries/counterup/jquery.counterup.min.js', 2, NULL, NULL, '2019-05-22 04:43:39', '2019-05-22 04:43:47'),
(37, 404, 'http://botble.local/vendor/core/libraries/jvectormap/jquery-jvectormap-1.2.2.min.js', 2, NULL, NULL, '2019-05-22 04:43:39', '2019-05-22 04:43:47'),
(38, 404, 'http://botble.local/vendor/core/libraries/jvectormap/jquery-jvectormap-world-mill-en.js', 2, NULL, NULL, '2019-05-22 04:43:40', '2019-05-22 04:43:48'),
(39, 404, 'http://botble.local/vendor/core/libraries/raphael-min.js', 2, NULL, NULL, '2019-05-22 04:43:40', '2019-05-22 04:43:49'),
(40, 404, 'http://botble.local/vendor/core/libraries/morris/morris.min.js', 2, NULL, NULL, '2019-05-22 04:43:40', '2019-05-22 04:43:49'),
(41, 404, 'http://botble.local/vendor/core/images/flags/cn.png', 1, NULL, NULL, '2019-05-22 04:43:40', '2019-05-22 04:43:40'),
(42, 404, 'http://botble.local/vendor/core/images/favicon.png', 1, NULL, NULL, '2019-05-22 04:43:50', '2019-05-22 04:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `revisions`
--

CREATE TABLE `revisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `revisionable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revisionable_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci,
  `new_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `revisions`
--

INSERT INTO `revisions` (`id`, `revisionable_type`, `revisionable_id`, `user_id`, `key`, `old_value`, `new_value`, `created_at`, `updated_at`) VALUES
(1, 'Botble\\Blog\\Models\\Post', 44, 1, 'featured', '0', '1', '2018-04-13 09:38:58', '2018-04-13 09:38:58'),
(2, 'Botble\\Blog\\Models\\Post', 48, 1, 'image', NULL, 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/news/lock-660x330.jpg', '2018-04-13 09:40:18', '2018-04-13 09:40:18'),
(3, 'Botble\\Blog\\Models\\Post', 49, 1, 'featured', '0', '1', '2018-04-13 09:41:32', '2018-04-13 09:41:32'),
(4, 'Botble\\Blog\\Models\\Post', 50, 1, 'featured', '0', '1', '2018-04-13 09:42:27', '2018-04-13 09:42:27'),
(5, 'Botble\\Blog\\Models\\Post', 54, 1, 'featured', '1', '0', '2018-04-13 10:04:12', '2018-04-13 10:04:12'),
(6, 'Botble\\Blog\\Models\\Post', 54, 1, 'featured', '0', '1', '2018-04-13 10:04:20', '2018-04-13 10:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `description`, `is_default`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'administrators', 'Administrators', '{\"analytics.general\":true,\"analytics.page\":true,\"analytics.browser\":true,\"analytics.referrer\":true,\"backups.list\":true,\"backups.create\":true,\"backups.restore\":true,\"backups.delete\":true,\"block.list\":true,\"block.create\":true,\"block.edit\":true,\"block.delete\":true,\"categories.list\":true,\"categories.create\":true,\"categories.edit\":true,\"categories.delete\":true,\"contacts.list\":true,\"contacts.create\":true,\"contacts.edit\":true,\"contacts.delete\":true,\"custom-fields.list\":true,\"custom-fields.create\":true,\"custom-fields.edit\":true,\"custom-fields.delete\":true,\"dashboard.index\":true,\"galleries.list\":true,\"galleries.create\":true,\"galleries.edit\":true,\"galleries.delete\":true,\"languages.list\":true,\"languages.create\":true,\"languages.edit\":true,\"languages.delete\":true,\"logs.list\":true,\"logs.delete\":true,\"media.index\":true,\"files.list\":true,\"files.create\":true,\"files.edit\":true,\"files.trash\":true,\"files.delete\":true,\"folders.list\":true,\"folders.create\":true,\"folders.edit\":true,\"folders.trash\":true,\"folders.delete\":true,\"member.list\":true,\"member.create\":true,\"member.edit\":true,\"member.delete\":true,\"menus.list\":true,\"menus.create\":true,\"menus.edit\":true,\"menus.delete\":true,\"pages.list\":true,\"pages.create\":true,\"pages.edit\":true,\"pages.delete\":true,\"plugins.list\":true,\"posts.list\":true,\"posts.create\":true,\"posts.edit\":true,\"posts.delete\":true,\"roles.list\":true,\"roles.create\":true,\"roles.edit\":true,\"roles.delete\":true,\"settings.options\":true,\"tags.list\":true,\"tags.create\":true,\"tags.edit\":true,\"tags.delete\":true,\"translations.list\":true,\"translations.create\":true,\"translations.edit\":true,\"translations.delete\":true,\"users.list\":true,\"users.create\":true,\"users.edit\":true,\"users.delete\":true,\"widgets.list\":true}', 'Highest role in system', 0, 1, 1, '2018-01-17 18:00:45', '2018-03-14 21:49:45'),
(2, 'members', 'Members', '{\"analytics.general\":true,\"analytics.page\":true,\"analytics.browser\":true,\"analytics.referrer\":true,\"block.list\":true,\"block.create\":true,\"block.edit\":true,\"block.delete\":true,\"categories.list\":true,\"categories.create\":true,\"categories.edit\":true,\"categories.delete\":true,\"contacts.list\":true,\"contacts.create\":true,\"contacts.edit\":true,\"contacts.delete\":true,\"custom-fields.list\":true,\"custom-fields.create\":true,\"custom-fields.edit\":true,\"custom-fields.delete\":true,\"dashboard.index\":true,\"galleries.list\":true,\"galleries.create\":true,\"galleries.edit\":true,\"galleries.delete\":true,\"media.index\":true,\"files.list\":true,\"files.create\":true,\"files.edit\":true,\"files.trash\":true,\"files.delete\":true,\"folders.list\":true,\"folders.create\":true,\"folders.edit\":true,\"folders.trash\":true,\"folders.delete\":true,\"menus.list\":true,\"menus.create\":true,\"menus.edit\":true,\"menus.delete\":true,\"pages.list\":true,\"pages.create\":true,\"pages.edit\":true,\"pages.delete\":true,\"posts.list\":true,\"posts.create\":true,\"posts.edit\":true,\"posts.delete\":true,\"tags.list\":true,\"tags.create\":true,\"tags.edit\":true,\"tags.delete\":true}', 'Member role', 1, 1, 1, '2018-01-17 18:01:32', '2018-03-14 21:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '2018-01-18 08:11:34', '2018-01-18 08:11:34');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'site_title', 'PHP platform based on Laravel Framework'),
(2, 'copyright', '© 2016 Botble Technologies. All right reserved. Designed by <a href=\"http://nghiadev.com\" target=\"_blank\">Nghia Minh</a>'),
(3, 'admin_email', 'sangnguyenplus@gmail.com'),
(4, 'google_analytics', 'UA-42586526-15'),
(5, 'google_site_verification', 'hs2Js3WGGpf1pzyhUNehvVDSIrmO3XZpm7PggNZECxE'),
(6, 'seo_title', 'Botble Platform'),
(7, 'seo_description', 'Botble Platform - PHP platform base on Laravel Framework'),
(8, 'seo_keywords', 'botble, botble team, botble platform, php platform, php framework, web development'),
(9, 'contact_address', 'Elinext Building, 37 Phan Xich Long, ward 3, Phu Nhuan district, Ho Chi Minh, Vietnam'),
(10, 'contact_email', 'sangnguyenplus@gmail.com'),
(11, 'email_support', 'sangnguyenplus@gmail.com'),
(12, 'contact_phone', '+84988606928'),
(13, 'contact_hotline', '+84988606928'),
(14, 'enable_captcha', '0'),
(15, 'about', '<p>Content here</p>\r\n'),
(16, 'show_admin_bar', '1'),
(17, 'theme', 'ripple'),
(18, 'enable_change_admin_theme', '1'),
(19, 'enable_multi_language_in_admin', '1'),
(20, 'enable_https', '0'),
(21, 'google_plus', 'https://plus.google.com'),
(22, 'facebook', 'https://www.facebook.com/botble.technologies'),
(23, 'twitter', 'https://twitter.com/botble'),
(24, 'enable_cache', '0'),
(25, 'cache_time', '10'),
(26, 'cache_time_site_map', '3600'),
(27, 'language_hide_default', '1'),
(28, 'language_switcher_display', 'dropdown'),
(29, 'language_display', 'all'),
(30, 'language_hide_languages', '[]'),
(31, 'theme-ripple-site_title', '© 2016 Botble Technologies. All right reserved. Designed by <a href=\"http://nghiadev.com\" target=\"_blank\">Nghia Minh</a>'),
(34, 'theme-ripple-copyright', '© 2018 Botble Technologies. All right reserved. Designed by <a href=\"http://nghiadev.com\" target=\"_blank\">Nghia Minh</a>'),
(35, 'theme-newstv-copyright', '© Copyright 2017 Botble Technologies. All Rights Reserved.'),
(36, 'theme-newstv-theme_color', 'red'),
(38, 'theme-newstv-logo', 'https://s3-ap-southeast-1.amazonaws.com/botble/cms/logo/logo.png'),
(39, 'rich_editor', 'ckeditor'),
(41, 'admin_title', 'Botble Technologies'),
(42, 'analytics_view_id', '125311257'),
(43, 'analytics_service_account_credentials', '{\r\n  \"type\": \"service_account\",\r\n  \"project_id\": \"botble-cms\",\r\n  \"private_key_id\": \"f40c1c44478ec4161e141731f2289639b0292500\",\r\n  \"private_key\": \"-----BEGIN PRIVATE KEY-----\\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCm5eDiIW363mtW\\na/omcDTBkMvJLGwrkslsza0mod3Z1OhBmTEPNKYXznlcguzWqg/i8mJJ+pxjt4AT\\nHyunwjTnw8bDjcawH9jH7jbNTPx1ZNlRjXL8e19k/TG09LfJ4jnX0ZbHNZGZCU3l\\nzNKD0pynhR/X+R634YzYN2P9aIG+7Fd8YmswLmvRub2QUC28m3wmJzsKP3hyAzYy\\nixP2ebAfyB0/H4SmODEliznqRD/WDWwqpUDaiMYhX0I+xF8bvzdot+4BmTZ+KCLj\\n+9kE+MHxLWNXjER+n8wCDjQSTQjyQHY0NVanNS7g6qJLZNo99q3BF52zoZVdD5Ee\\nloOjjQBXAgMBAAECggEAG3sIb1N/z2nmFKHM251oImMcGvDUkswlnGO1WgIXDHIR\\nGBQITu+lVZAqzX/FTYdM/FpassGwFH83eG6Oep3wpiTHSpXCnGdyA2GG5oEBpLbJ\\nTbNTtpz91RwXnisZRAWa7p1VDVIVujQc/nSeSRRZtP+ngaFEXJSn40YjkasuiegO\\nXETgRlF3fSlVZmPd3kGy1Bq9MAfp2iylbM/pwrKCKJk9ZQUmIciTU1eQ6mqxI3/x\\nEyarQ74Vc6RQ/wZxMbAJcLPHYWJgdZvSr8VUvvOeCgDGP8jyjP2/f2CnEZBPNpoO\\nknISU/s4y7pBwu+FTVz82Ac+XokGznHTNsap7JaPUQKBgQDT7UqxxkjoSfTqvaTF\\nxX7mD7jkOwt4X+IitNWUYy1s1QVPOCMl7CxM+xyDd99auJV8HuhBfJESz8KSXnen\\nv3ICCGVmAIHcAoNoopPJvzwXTu95eC6oV2pJmtc1s9a7eeSxBvjjc2WAjPdSppPV\\nfzb9sX5ZqQHQNWh43nlRfnnM6QKBgQDJm039nTFcwFRunxy0CyUBj0PR2ENaJZIU\\nnnB5IcBAFjpM0rXKAYIshjid9vJMJEBjLHWCQ2+8k9RsCuucYkZBJjfpXI0Mn3WO\\n7B7D/bpFS8xFq0m4w98rBtKh/BJoim3qID5+34I6p0osxAel5sNuXskbSjGRBfNN\\neL6wTN8bPwKBgHlknzidv/1u/5/G6a9vpXTa5Km3OKbHJZ2DwCOze72vd88c9OUw\\nF2AxJvAXphUtTlM+0QNR+zevUmDNQ/UOsJuBe7Ol7ry7o9I37jfOFvmy+XG26eL7\\nz6JB06yrSwEwnVLaD48Z9rZgCPuK93t/11wSY7GwIZ3GOgWiShPoQpShAoGAGXid\\nqeUqT2WdRTylC7o8uq23C9Qe7kzA4AoEe8lf2Lj2NK6KeTMnlyh+DrccdbI+0EjV\\nr9eFTnX+6IeYrPFdnu2NMtaWm3mqCJycZnawCgFBlavGbKmSkIUUJ5MJYFvc9y+L\\ntcvXUEHChVVfAf7dwhwHnIMLMB9oVeljbjLIHVECgYEAulBNrt+dIFnXNYrPhvY1\\nJ+Hx444lPIO7XnVrN7Q8d+stBk4CtbU3nPYkIiaV8uucgE5ZSxVG5Fef2clSbjOk\\n3wmltVSXSs21s40Ti8XKzvgg1QUrNLIQbHA3xoa5qFiFtxwV+m+IUZKvZmNj1y3l\\nbHAjWQ4Sj+EM1MXMrrEGZP0=\\n-----END PRIVATE KEY-----\\n\",\r\n  \"client_email\": \"botble-cms@botble-cms.iam.gserviceaccount.com\",\r\n  \"client_id\": \"113101231196374159892\",\r\n  \"auth_uri\": \"https://accounts.google.com/o/oauth2/auth\",\r\n  \"token_uri\": \"https://accounts.google.com/o/oauth2/token\",\r\n  \"auth_provider_x509_cert_url\": \"https://www.googleapis.com/oauth2/v1/certs\",\r\n  \"client_x509_cert_url\": \"https://www.googleapis.com/robot/v1/metadata/x509/botble-cms%40botble-cms.iam.gserviceaccount.com\"\r\n}'),
(44, 'activated_plugins', '[\"analytics\",\"audit-log\",\"backup\",\"captcha\",\"log-viewer\",\"language\",\"request-log\",\"social-login\",\"block\",\"custom-field\",\"member\",\"contact\",\"blog\",\"gallery\"]'),
(45, 'theme-ripple-vi-copyright', '© 2018 Botble Technologies. Tất cả quyền đã được bảo hộ. Thiết kế bởi <a href=\"http://nghiadev.com\" target=\"_blank\">Minh Nghĩa</a>'),
(47, 'theme-newstv-vi-copyright', '© 2017 Botble Technologies. Tất cả quyền đã được bảo hộ.'),
(48, 'theme-newstv-vi-theme_color', 'red'),
(49, 'theme-newstv-vi-top_banner', '/themes/newstv/assets/images/banner.png'),
(51, 'time_zone', 'UTC'),
(52, 'optimize_page_speed_enable', '0'),
(53, 'enable_send_error_reporting_via_email', '1'),
(54, 'default_admin_theme', 'default'),
(55, 'cache_admin_menu_enable', '1'),
(56, 'language_show_default_item_if_current_version_not_existed', '1'),
(57, 'show_site_name', '0'),
(62, 'captcha_site_key', 'no-captcha-site-key'),
(63, 'captcha_secret', 'no-captcha-secret'),
(64, 'social_utilities_enable', '1'),
(85, 'submit', 'save'),
(106, 'social_utilities_facebook_url', 'botble.technologies'),
(107, 'social_utilities_twitter_url', 'sangnguyen2603'),
(108, 'social_utilities_google-plus_url', 'sangnguyen2603'),
(109, 'social_utilities_linkedin_url', 'sangnguyen2603'),
(110, 'social_utilities_pinterest_url', 'sangnguyen2603');

-- --------------------------------------------------------

--
-- Table structure for table `slugs`
--

CREATE TABLE `slugs` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `prefix` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slugs`
--

INSERT INTO `slugs` (`id`, `key`, `reference_id`, `reference`, `created_at`, `updated_at`, `prefix`) VALUES
(1, '13000-people-have-bought-our-theme', 4, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(2, 'top-search-engine-optimization-strategies', 5, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(3, 'which-company-would-you-choose', 6, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(4, 'used-car-dealer-sales-tricks-exposed', 7, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(5, '20-ways-to-sell-your-product-faster', 8, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(6, 'the-secrets-of-rich-and-famous-writers', 9, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(7, 'imagine-losing-20-pounds-in-14-days', 10, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(8, 'are-you-still-using-that-slow-old-typewriter', 11, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(9, 'a-skin-cream-thats-proven-to-work', 12, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(10, '10-reasons-to-start-your-own-profitable-website', 13, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(11, 'simple-ways-to-reduce', 14, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(12, 'apple-imac-with-retina-5k-display-review', 15, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(13, '10-reasons-to-start-your-own-profitable-website-1', 16, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(14, 'unlock-the-secrets-of-selling-high-ticket-items', 17, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(15, '10000-web-site-visitors-in-one-monthguaranteed', 18, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(16, 'are-you-still-using-that-slow-old-typewriter-1', 19, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(17, 'a-skin-cream-thats-proven-to-work-1', 20, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(18, 'top-search-engine-optimization-strategies-1', 21, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(19, '13000-nguoi-da-mua-theme-cua-chung-toi', 44, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(20, 'len-tren-cong-cu-tim-kiem-toi-uu-hoa-cac-chien-luoc', 45, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(21, 'ban-se-chon-cong-ty-nao', 46, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(22, 'su-dung-xe-dai-ly-ban-hang-tricks-xuc', 47, 'post', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(23, 'uncategorized', 1, 'category', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(24, 'events', 6, 'category', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(25, 'projects', 7, 'category', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(26, 'portfolio', 8, 'category', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(27, 'business', 9, 'category', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(28, 'resources', 10, 'category', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(29, 'new-update', 11, 'category', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(30, 'botble', 5, 'tag', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(31, 'botble-cms', 6, 'tag', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(32, 'contact', 1, 'page', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(33, 'lien-he', 17, 'page', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(34, 'photography', 1, 'gallery', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(35, 'selfie', 2, 'gallery', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(36, 'new-day', 3, 'gallery', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(37, 'morning', 4, 'gallery', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(38, 'happy-day', 5, 'gallery', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(39, 'perfect', 6, 'gallery', '2017-11-30 18:26:09', '2017-11-30 18:26:09', ''),
(40, 'chua-phan-loai', 12, 'category', '2018-04-13 09:02:12', '2018-04-13 09:02:12', ''),
(41, 'su-kien', 13, 'category', '2018-04-13 09:04:30', '2018-04-13 09:04:30', ''),
(42, 'doanh-nghiep', 14, 'category', '2018-04-13 09:04:49', '2018-04-13 09:04:49', ''),
(43, 'tin-tuc-cap-nhat', 15, 'category', '2018-04-13 09:05:06', '2018-04-13 09:05:06', ''),
(44, 'du-an', 16, 'category', '2018-04-13 09:05:23', '2018-04-13 09:05:23', ''),
(45, 'dau-tu', 17, 'category', '2018-04-13 09:06:44', '2018-04-13 09:06:44', ''),
(46, 'nguon-luc', 18, 'category', '2018-04-13 09:08:01', '2018-04-13 09:08:01', ''),
(47, 'chien-luoc-phat-trien-phan-mem', 48, 'post', '2018-04-13 09:40:11', '2018-04-13 09:40:11', ''),
(48, 'nen-tang-ma-nguon-mo-php', 49, 'post', '2018-04-13 09:41:28', '2018-04-13 09:41:28', ''),
(49, 'nen-tang-ma-nguon-mo-php-1', 7, 'tag', '2018-04-13 09:41:28', '2018-04-13 09:41:28', ''),
(50, 'xay-dung-website-mot-cach-nhanh-chong', 50, 'post', '2018-04-13 09:42:20', '2018-04-13 09:42:20', ''),
(51, 'xay-dung-website-mot-cach-nhanh-chong-1', 8, 'tag', '2018-04-13 09:42:20', '2018-04-13 09:42:20', ''),
(52, 'xay-dung-website-mot-cach-nhanh-chong-2', 9, 'tag', '2018-04-13 09:42:20', '2018-04-13 09:42:20', ''),
(53, 'san-pham-tri-tue-viet-nam', 51, 'post', '2018-04-13 09:43:09', '2018-04-13 09:43:09', ''),
(54, 'san-pham-tri-tue-viet-nam-1', 10, 'tag', '2018-04-13 09:43:09', '2018-04-13 09:43:09', ''),
(55, 'tai-ve', 11, 'tag', '2018-04-13 09:45:22', '2018-04-13 09:45:22', ''),
(58, 'tag-su-kien', 24, 'tag', '2018-04-13 09:59:52', '2018-04-13 09:59:52', ''),
(59, 'popular', 25, 'tag', '2018-04-13 10:00:35', '2018-04-13 10:00:35', ''),
(60, 'cuoc-song-tuoi-30', 52, 'post', '2018-04-13 10:02:20', '2018-04-13 10:02:20', ''),
(61, 'hanh-trinh-tim-kiem-su-khac-biet', 53, 'post', '2018-04-13 10:02:59', '2018-04-13 10:02:59', ''),
(62, 'the-gioi-dong-vat-muon-mau', 54, 'post', '2018-04-13 10:03:46', '2018-04-13 10:03:46', ''),
(63, 'di-tim-hoi-uc-tuoi-tho', 55, 'post', '2018-04-13 10:06:40', '2018-04-13 10:06:40', ''),
(64, 'nhiep-anh', 7, 'gallery', '2018-05-11 07:44:54', '2018-05-11 07:44:54', ''),
(65, 'thien-nhien', 8, 'gallery', '2018-05-11 07:45:11', '2018-05-11 07:45:11', ''),
(66, 'ngay-moi', 9, 'gallery', '2018-05-11 07:45:36', '2018-05-11 07:45:36', ''),
(67, 'buoi-sang', 10, 'gallery', '2018-05-11 07:45:42', '2018-05-11 07:45:42', ''),
(68, 'ngay-hanh-phuc', 11, 'gallery', '2018-05-11 07:45:46', '2018-05-11 07:45:46', ''),
(69, 'hoan-hao', 12, 'gallery', '2018-05-11 07:45:51', '2018-05-11 07:45:51', '');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `author_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `author_id`, `author_type`, `description`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 'download', 1, 'Botble\\ACL\\Models\\User', '', 0, 'published', '2016-08-02 21:38:34', '2016-09-27 09:30:37'),
(6, 'event', 1, 'Botble\\ACL\\Models\\User', '', 0, 'published', '2016-08-02 21:38:34', '2016-09-27 09:30:50'),
(7, 'nổi bật', 1, 'Botble\\ACL\\Models\\User', NULL, 0, 'published', '2018-04-13 09:41:28', '2018-04-13 10:00:09'),
(11, 'tải về', 1, 'Botble\\ACL\\Models\\User', NULL, 0, 'published', '2018-04-13 09:45:22', '2018-04-13 09:45:22'),
(24, 'sự kiện', 1, 'Botble\\ACL\\Models\\User', NULL, 0, 'published', '2018-04-13 09:59:52', '2018-04-13 09:59:52'),
(25, 'popular', 1, 'Botble\\ACL\\Models\\User', NULL, 0, 'published', '2018-04-13 10:00:35', '2018-04-13 10:00:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_position` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `website` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_plus` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `super_user` tinyint(1) NOT NULL DEFAULT '0',
  `manage_supers` tinyint(1) NOT NULL DEFAULT '0',
  `completed_profile` tinyint(1) NOT NULL DEFAULT '0',
  `avatar_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `permissions`, `last_login`, `first_name`, `last_name`, `username`, `dob`, `address`, `secondary_address`, `job_position`, `phone`, `secondary_phone`, `secondary_email`, `gender`, `website`, `skype`, `facebook`, `twitter`, `google_plus`, `youtube`, `github`, `interest`, `about`, `super_user`, `manage_supers`, `completed_profile`, `avatar_id`) VALUES
(1, 'minhsang2603@gmail.com', '$2y$10$A.uOgqPJthpIKaaUQ3QaueO19/dtXbntkRuNCRM4DA1D0wN33Jsd6', 'T6oMhHkxtgcWaK5vAGmrYZydpt4wfGcRPmk9JNAK8lrXbsMyrbAN1QHBXExJ', '2017-11-15 06:57:09', '2019-04-06 03:52:25', '{\"analytics.general\":true,\"analytics.page\":true,\"analytics.browser\":true,\"analytics.referrer\":true,\"backups.list\":true,\"backups.create\":true,\"backups.restore\":true,\"backups.delete\":true,\"block.list\":true,\"block.create\":true,\"block.edit\":true,\"block.delete\":true,\"categories.list\":true,\"categories.create\":true,\"categories.edit\":true,\"categories.delete\":true,\"contacts.list\":true,\"contacts.create\":true,\"contacts.edit\":true,\"contacts.delete\":true,\"custom-fields.list\":true,\"custom-fields.create\":true,\"custom-fields.edit\":true,\"custom-fields.delete\":true,\"dashboard.index\":true,\"galleries.list\":true,\"galleries.create\":true,\"galleries.edit\":true,\"galleries.delete\":true,\"languages.list\":true,\"languages.create\":true,\"languages.edit\":true,\"languages.delete\":true,\"logs.list\":true,\"logs.delete\":true,\"media.index\":true,\"files.list\":true,\"files.create\":true,\"files.edit\":true,\"files.trash\":true,\"files.delete\":true,\"folders.list\":true,\"folders.create\":true,\"folders.edit\":true,\"folders.trash\":true,\"folders.delete\":true,\"member.list\":true,\"member.create\":true,\"member.edit\":true,\"member.delete\":true,\"menus.list\":true,\"menus.create\":true,\"menus.edit\":true,\"menus.delete\":true,\"pages.list\":true,\"pages.create\":true,\"pages.edit\":true,\"pages.delete\":true,\"plugins.list\":true,\"posts.list\":true,\"posts.create\":true,\"posts.edit\":true,\"posts.delete\":true,\"roles.list\":true,\"roles.create\":true,\"roles.edit\":true,\"roles.delete\":true,\"settings.options\":true,\"tags.list\":true,\"tags.create\":true,\"tags.edit\":true,\"tags.delete\":true,\"translations.list\":true,\"translations.create\":true,\"translations.edit\":true,\"translations.delete\":true,\"users.list\":true,\"users.create\":true,\"users.edit\":true,\"users.delete\":true,\"widgets.list\":true,\"superuser\":true,\"manage_supers\":true}', '2019-03-13 00:15:13', 'Sang', 'Nguyen', 'botble', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_meta`
--

INSERT INTO `user_meta` (`id`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'languages_current_data_language', 'en_US', 1, '2017-11-30 18:27:51', '2018-04-13 10:00:39'),
(2, 'admin-theme', 'default', 1, '2018-03-07 03:42:13', '2018-03-13 20:02:36'),
(3, 'admin-locale', 'en', 1, '2018-03-07 03:42:14', '2018-07-04 03:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `id` int(10) UNSIGNED NOT NULL,
  `widget_id` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sidebar_id` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `data` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `widget_id`, `sidebar_id`, `theme`, `position`, `data`, `created_at`, `updated_at`) VALUES
(2, 'Botble\\Widget\\Widgets\\Text', 'second_sidebar', 'demo', 0, '{\"id\":\"Botble\\\\Widget\\\\Widgets\\\\Text\",\"name\":\"Text\",\"content\":\"\"}', '2016-12-18 04:47:20', '2016-12-18 04:47:20'),
(7, 'RecentPostsWidget', 'top_sidebar', 'ripple', 0, '{\"id\":\"RecentPostsWidget\",\"name\":\"Recent Posts\",\"number_display\":\"5\"}', '2016-12-18 04:48:00', '2016-12-18 04:48:00'),
(9, 'Botble\\Widget\\Widgets\\Text', 'primary_sidebar', 'demo', 0, '{\"id\":\"Botble\\\\Widget\\\\Widgets\\\\Text\",\"name\":\"Text\",\"content\":\"\"}', '2016-12-18 04:50:57', '2016-12-18 04:50:57'),
(19, 'TagsWidget', 'primary_sidebar', 'ripple', 0, '{\"id\":\"TagsWidget\",\"name\":\"Tags\",\"number_display\":\"5\"}', '2016-12-24 07:41:57', '2016-12-24 07:41:57'),
(20, 'CustomMenuWidget', 'primary_sidebar', 'ripple', 1, '{\"id\":\"CustomMenuWidget\",\"name\":\"Categories\",\"menu_id\":\"featured-categories\"}', '2016-12-24 07:41:57', '2016-12-24 07:41:57'),
(21, 'CustomMenuWidget', 'primary_sidebar', 'ripple', 2, '{\"id\":\"CustomMenuWidget\",\"name\":\"Social\",\"menu_id\":\"social\"}', '2016-12-24 07:41:57', '2016-12-24 07:41:57'),
(30, 'RecentPostsWidget', 'footer_sidebar', 'ripple', 0, '{\"id\":\"RecentPostsWidget\",\"name\":\"Recent Posts\",\"number_display\":\"5\"}', '2016-12-24 07:42:58', '2016-12-24 07:42:58'),
(31, 'CustomMenuWidget', 'footer_sidebar', 'ripple', 1, '{\"id\":\"CustomMenuWidget\",\"name\":\"Favorite website\",\"menu_id\":\"favorite-website\"}', '2016-12-24 07:42:58', '2016-12-24 07:42:58'),
(32, 'CustomMenuWidget', 'footer_sidebar', 'ripple', 2, '{\"id\":\"CustomMenuWidget\",\"name\":\"My links\",\"menu_id\":\"my-links\"}', '2016-12-24 07:42:58', '2016-12-24 07:42:58'),
(42, 'PopularPostsWidget', 'primary_sidebar', 'newstv', 0, '{\"id\":\"PopularPostsWidget\",\"name\":\"Top Views\",\"number_display\":\"5\"}', '2017-04-30 19:55:10', '2017-04-30 19:55:10'),
(43, 'VideoPostsWidget', 'primary_sidebar', 'newstv', 1, '{\"id\":\"VideoPostsWidget\",\"name\":\"Videos\",\"number_display\":\"1\"}', '2017-04-30 19:55:10', '2017-04-30 19:55:10'),
(44, 'FacebookWidget', 'primary_sidebar', 'newstv', 2, '{\"id\":\"FacebookWidget\",\"name\":\"Facebook\",\"facebook_name\":\"T\\u00f4i y\\u00eau l\\u1eadp tr\\u00ecnh\",\"facebook_id\":\"https:\\/\\/www.facebook.com\\/LoveCodingFC\\/\"}', '2017-04-30 19:55:10', '2017-04-30 19:55:10'),
(61, 'RecentPostsWidget', 'footer_sidebar', 'newstv', 0, '{\"id\":\"RecentPostsWidget\",\"name\":\"Recent posts\",\"number_display\":\"6\"}', '2017-04-30 19:56:39', '2017-04-30 19:56:39'),
(62, 'CustomMenuWidget', 'footer_sidebar', 'newstv', 1, '{\"id\":\"CustomMenuWidget\",\"name\":\"Favorite websites\",\"menu_id\":\"favorite-website\"}', '2017-04-30 19:56:39', '2017-04-30 19:56:39'),
(63, 'CustomMenuWidget', 'footer_sidebar', 'newstv', 2, '{\"id\":\"CustomMenuWidget\",\"name\":\"My links\",\"menu_id\":\"my-links\"}', '2017-04-30 19:56:39', '2017-04-30 19:56:39'),
(64, 'CustomMenuWidget', 'footer_sidebar', 'newstv', 3, '{\"id\":\"CustomMenuWidget\",\"name\":\"Categories\",\"menu_id\":\"featured-categories\"}', '2017-04-30 19:56:39', '2017-04-30 19:56:39'),
(74, 'TagsWidget', 'primary_sidebar', 'ripple-vi', 0, '{\"id\":\"TagsWidget\",\"name\":\"Th\\u1ebb\",\"number_display\":\"5\"}', '2018-04-13 08:52:05', '2018-04-13 08:52:05'),
(75, 'CustomMenuWidget', 'primary_sidebar', 'ripple-vi', 1, '{\"id\":\"CustomMenuWidget\",\"name\":\"Chuy\\u00ean m\\u1ee5c n\\u1ed5i b\\u1eadt\",\"menu_id\":\"featured-categories\"}', '2018-04-13 08:52:05', '2018-04-13 08:52:05'),
(76, 'CustomMenuWidget', 'primary_sidebar', 'ripple-vi', 2, '{\"id\":\"CustomMenuWidget\",\"name\":\"M\\u1ea1ng x\\u00e3 h\\u1ed9i \",\"menu_id\":\"social\"}', '2018-04-13 08:52:05', '2018-04-13 08:52:05'),
(78, 'RecentPostsWidget', 'top_sidebar', 'ripple-vi', 0, '{\"id\":\"RecentPostsWidget\",\"name\":\"B\\u00e0i vi\\u1ebft n\\u1ed5i b\\u1eadt\",\"number_display\":\"5\"}', '2018-04-13 08:52:59', '2018-04-13 08:52:59'),
(89, 'RecentPostsWidget', 'footer_sidebar', 'ripple-vi', 0, '{\"id\":\"RecentPostsWidget\",\"name\":\"B\\u00e0i vi\\u1ebft n\\u1ed5i b\\u1eadt\",\"number_display\":\"5\"}', '2018-04-13 08:54:28', '2018-04-13 08:54:28'),
(90, 'CustomMenuWidget', 'footer_sidebar', 'ripple-vi', 1, '{\"id\":\"CustomMenuWidget\",\"name\":\"Website \\u01b0a th\\u00edch\",\"menu_id\":\"favorite-website\"}', '2018-04-13 08:54:28', '2018-04-13 08:54:28'),
(91, 'CustomMenuWidget', 'footer_sidebar', 'ripple-vi', 2, '{\"id\":\"CustomMenuWidget\",\"name\":\"Li\\u00ean k\\u1ebft \",\"menu_id\":\"main-menu\"}', '2018-04-13 08:54:28', '2018-04-13 08:54:28'),
(103, 'PopularPostsWidget', 'primary_sidebar', 'newstv-vi', 0, '{\"id\":\"PopularPostsWidget\",\"name\":\"B\\u00e0i vi\\u1ebft n\\u1ed5i b\\u1eadt\",\"number_display\":\"5\"}', '2018-04-13 10:10:24', '2018-04-13 10:10:24'),
(104, 'VideoPostsWidget', 'primary_sidebar', 'newstv-vi', 1, '{\"id\":\"VideoPostsWidget\",\"name\":\"Video \",\"number_display\":\"4\"}', '2018-04-13 10:10:24', '2018-04-13 10:10:24'),
(105, 'FacebookWidget', 'primary_sidebar', 'newstv-vi', 2, '{\"id\":\"FacebookWidget\",\"name\":\"Facebook\",\"facebook_name\":\"Botble Technologies \",\"facebook_id\":\"https:\\/\\/www.facebook.com\\/botble.technologies\\/\"}', '2018-04-13 10:10:24', '2018-04-13 10:10:24'),
(131, 'CustomMenuWidget', 'footer_sidebar', 'newstv-vi', 0, '{\"id\":\"CustomMenuWidget\",\"name\":\"\\u001fWebsite \\u01b0a th\\u00edch \",\"menu_id\":\"favorite-website\"}', '2018-04-13 10:12:50', '2018-04-13 10:12:50'),
(132, 'CustomMenuWidget', 'footer_sidebar', 'newstv-vi', 1, '{\"id\":\"CustomMenuWidget\",\"name\":\"Li\\u00ean k\\u1ebft \",\"menu_id\":\"my-links\"}', '2018-04-13 10:12:50', '2018-04-13 10:12:50'),
(133, 'CustomMenuWidget', 'footer_sidebar', 'newstv-vi', 2, '{\"id\":\"CustomMenuWidget\",\"name\":\"\\u001fChuy\\u00ean m\\u1ee5c n\\u1ed5i b\\u1eadt \",\"menu_id\":\"featured-categories\"}', '2018-04-13 10:12:50', '2018-04-13 10:12:50'),
(134, 'CustomMenuWidget', 'footer_sidebar', 'newstv-vi', 3, '{\"id\":\"CustomMenuWidget\",\"name\":\"M\\u1ea1ng x\\u00e3 h\\u1ed9i \",\"menu_id\":\"social\"}', '2018-04-13 10:12:50', '2018-04-13 10:12:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activations_user_id_index` (`user_id`);

--
-- Indexes for table `audit_history`
--
ALTER TABLE `audit_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_history_user_id_index` (`user_id`),
  ADD KEY `audit_history_module_index` (`module`);

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_index` (`parent_id`),
  ADD KEY `categories_user_id_index` (`author_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_replies`
--
ALTER TABLE `contact_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_fields_field_item_id_foreign` (`field_item_id`);

--
-- Indexes for table `dashboard_widgets`
--
ALTER TABLE `dashboard_widgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboard_widget_settings`
--
ALTER TABLE `dashboard_widget_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dashboard_widget_settings_user_id_index` (`user_id`),
  ADD KEY `dashboard_widget_settings_widget_id_index` (`widget_id`);

--
-- Indexes for table `field_groups`
--
ALTER TABLE `field_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_groups_created_by_foreign` (`created_by`),
  ADD KEY `field_groups_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `field_items`
--
ALTER TABLE `field_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_items_field_group_id_foreign` (`field_group_id`),
  ADD KEY `field_items_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_user_id_index` (`user_id`);

--
-- Indexes for table `gallery_meta`
--
ALTER TABLE `gallery_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_meta_content_id_index` (`content_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`lang_id`);

--
-- Indexes for table `language_meta`
--
ALTER TABLE `language_meta`
  ADD PRIMARY KEY (`lang_meta_id`),
  ADD KEY `language_meta_lang_meta_content_id_index` (`lang_meta_content_id`);

--
-- Indexes for table `media_files`
--
ALTER TABLE `media_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_files_user_id_index` (`user_id`);

--
-- Indexes for table `media_folders`
--
ALTER TABLE `media_folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_folders_user_id_index` (`user_id`);

--
-- Indexes for table `media_settings`
--
ALTER TABLE `media_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_email_unique` (`email`);

--
-- Indexes for table `member_activity_logs`
--
ALTER TABLE `member_activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_activity_logs_member_id_index` (`member_id`);

--
-- Indexes for table `member_password_resets`
--
ALTER TABLE `member_password_resets`
  ADD KEY `member_password_resets_email_index` (`email`),
  ADD KEY `member_password_resets_token_index` (`token`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_slug_unique` (`slug`);

--
-- Indexes for table `menu_locations`
--
ALTER TABLE `menu_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_nodes`
--
ALTER TABLE `menu_nodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_nodes_menu_id_index` (`menu_id`),
  ADD KEY `menu_nodes_parent_id_index` (`parent_id`),
  ADD KEY `menu_nodes_related_id_index` (`related_id`);

--
-- Indexes for table `meta_boxes`
--
ALTER TABLE `meta_boxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meta_boxes_content_id_index` (`content_id`);

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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_parent_id_index` (`parent_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_category_category_id_index` (`category_id`),
  ADD KEY `post_category_post_id_index` (`post_id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tag_tag_id_index` (`tag_id`),
  ADD KEY `post_tag_post_id_index` (`post_id`);

--
-- Indexes for table `request_logs`
--
ALTER TABLE `request_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revisions`
--
ALTER TABLE `revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `revisions_revisionable_type_index` (`revisionable_type`),
  ADD KEY `revisions_revisionable_id_index` (`revisionable_id`),
  ADD KEY `revisions_user_id_index` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`),
  ADD KEY `roles_created_by_index` (`created_by`),
  ADD KEY `roles_updated_by_index` (`updated_by`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_users_user_id_index` (`user_id`),
  ADD KEY `role_users_role_id_index` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_key_index` (`key`);

--
-- Indexes for table `slugs`
--
ALTER TABLE `slugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_user_id_index` (`author_id`),
  ADD KEY `tags_parent_id_index` (`parent_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_meta_user_id_index` (`user_id`);

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audit_history`
--
ALTER TABLE `audit_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_replies`
--
ALTER TABLE `contact_replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dashboard_widgets`
--
ALTER TABLE `dashboard_widgets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dashboard_widget_settings`
--
ALTER TABLE `dashboard_widget_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `field_groups`
--
ALTER TABLE `field_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field_items`
--
ALTER TABLE `field_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gallery_meta`
--
ALTER TABLE `gallery_meta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `lang_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `language_meta`
--
ALTER TABLE `language_meta`
  MODIFY `lang_meta_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `media_files`
--
ALTER TABLE `media_files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media_folders`
--
ALTER TABLE `media_folders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_settings`
--
ALTER TABLE `media_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_activity_logs`
--
ALTER TABLE `member_activity_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu_locations`
--
ALTER TABLE `menu_locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_nodes`
--
ALTER TABLE `menu_nodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=610;

--
-- AUTO_INCREMENT for table `meta_boxes`
--
ALTER TABLE `meta_boxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;

--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `request_logs`
--
ALTER TABLE `request_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `revisions`
--
ALTER TABLE `revisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `slugs`
--
ALTER TABLE `slugs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD CONSTRAINT `custom_fields_field_item_id_foreign` FOREIGN KEY (`field_item_id`) REFERENCES `field_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `field_groups`
--
ALTER TABLE `field_groups`
  ADD CONSTRAINT `field_groups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `field_groups_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `field_items`
--
ALTER TABLE `field_items`
  ADD CONSTRAINT `field_items_field_group_id_foreign` FOREIGN KEY (`field_group_id`) REFERENCES `field_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `field_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `field_items` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
