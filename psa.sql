-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2020 at 06:42 AM
-- Server version: 5.6.49-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `departments_id` int(11) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `short` varchar(50) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `entry_date` date DEFAULT NULL,
  `cash_gift_rate` decimal(12,2) DEFAULT '0.00',
  `contribution_rate` decimal(12,2) DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`departments_id`, `region`, `short`, `place`, `is_deleted`, `entry_date`, `cash_gift_rate`, `contribution_rate`) VALUES
(1, 'REGION ONE TEST', 'REGION 1 @', 'CENTRAL OFFICE', 0, '2020-08-21', 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `office_management`
--

CREATE TABLE `office_management` (
  `office_management_id` int(11) NOT NULL,
  `office_code` text,
  `office_name` text,
  `entry_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `departments_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office_management`
--

INSERT INTO `office_management` (`office_management_id`, `office_code`, `office_name`, `entry_date`, `is_deleted`, `departments_id`) VALUES
(1, '00958', 'TEST OFFICE NAME S', '2020-08-21', 1, 1),
(2, '515125', 'TEST OFFICE NAME S', '2020-08-21', 1, 1),
(3, '01125654', 'MANDALUYONG PASIG CITY', '2020-08-21', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_action_logs`
--

CREATE TABLE `tbl_action_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` int(11) DEFAULT NULL,
  `target_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `filename` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `item_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` int(11) NOT NULL,
  `expected_checkin` date DEFAULT NULL,
  `accepted_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `thread_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `accept_signature` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log_meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_action_logs`
--

INSERT INTO `tbl_action_logs` (`id`, `user_id`, `action_type`, `target_id`, `target_type`, `location_id`, `note`, `filename`, `item_type`, `item_id`, `expected_checkin`, `accepted_id`, `created_at`, `updated_at`, `deleted_at`, `thread_id`, `company_id`, `accept_signature`, `log_meta`, `is_deleted`) VALUES
(56, NULL, 'scanned asset to dispatch', 13, 'asset', NULL, NULL, NULL, '', 0, NULL, NULL, '2020-08-27 12:56:50', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(57, NULL, 'scanned asset to dispatch', 12, 'asset', NULL, NULL, NULL, '', 0, NULL, NULL, '2020-08-27 16:04:13', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(58, NULL, 'scanned asset to dispatch', 13, 'asset', NULL, NULL, NULL, '', 0, NULL, NULL, '2020-08-28 14:16:53', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(59, NULL, 'scanned asset to dispatch', 13, 'asset', NULL, NULL, NULL, '', 0, NULL, NULL, '2020-09-10 21:16:41', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(60, NULL, 'scanned asset to dispatch', 13, 'asset', NULL, NULL, NULL, '', 0, NULL, NULL, '2020-09-10 21:16:46', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(61, NULL, 'scanned asset to dispatch', 13, 'asset', NULL, NULL, NULL, '', 0, NULL, NULL, '2020-09-10 21:16:48', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(62, NULL, 'scanned asset to dispatch', 15, 'asset', NULL, NULL, NULL, '', 0, NULL, NULL, '2020-09-17 17:26:14', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(63, NULL, 'scanned asset to dispatch', 15, 'asset', NULL, NULL, NULL, '', 0, NULL, NULL, '2020-09-17 18:00:21', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(64, NULL, 'scanned asset to deploy', 15, 'asset', NULL, NULL, NULL, '', 0, NULL, NULL, '2020-09-17 18:01:26', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(65, NULL, 'scanned asset to deploy', 15, 'asset', NULL, NULL, NULL, '', 0, NULL, NULL, '2020-09-17 18:03:41', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(66, NULL, 'scanned asset to dispatch', 13, 'asset', NULL, NULL, NULL, '', 0, NULL, NULL, '2020-09-18 17:07:05', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(67, NULL, 'scanned asset to dispatch', 13, 'asset', NULL, NULL, NULL, '', 0, NULL, NULL, '2020-09-18 17:07:26', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(68, NULL, 'scanned asset to deploy', 15, 'asset', NULL, NULL, NULL, '', 0, NULL, NULL, '2020-09-26 14:56:08', NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_asset`
--

CREATE TABLE `tbl_asset` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_tag` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `serial` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_cost` decimal(20,2) DEFAULT NULL,
  `order_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `physical` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT '0',
  `warranty_months` int(11) DEFAULT NULL,
  `depreciate` tinyint(1) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `requestable` tinyint(4) NOT NULL DEFAULT '0',
  `rtd_location_id` int(11) DEFAULT NULL,
  `_snipeit_mac_address_1` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accepted` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_checkout` datetime DEFAULT NULL,
  `expected_checkin` date DEFAULT NULL,
  `company_id` int(10) UNSIGNED DEFAULT NULL,
  `assigned_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_audit_date` datetime DEFAULT NULL,
  `next_audit_date` date DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `checkin_counter` int(11) NOT NULL DEFAULT '0',
  `checkout_counter` int(11) NOT NULL DEFAULT '0',
  `requests_counter` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  `checkout_user_id` int(2) DEFAULT NULL,
  `office_management_id` int(11) DEFAULT NULL,
  `departments_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_asset`
--

INSERT INTO `tbl_asset` (`id`, `name`, `asset_tag`, `model_id`, `serial`, `purchase_date`, `purchase_cost`, `order_number`, `assigned_to`, `notes`, `image`, `user_id`, `created_at`, `updated_at`, `physical`, `deleted_at`, `status_id`, `archived`, `warranty_months`, `depreciate`, `supplier_id`, `requestable`, `rtd_location_id`, `_snipeit_mac_address_1`, `accepted`, `last_checkout`, `expected_checkin`, `company_id`, `assigned_type`, `last_audit_date`, `next_audit_date`, `location_id`, `checkin_counter`, `checkout_counter`, `requests_counter`, `is_deleted`, `checkout_user_id`, `office_management_id`, `departments_id`) VALUES
(13, 'MSI Tomahawk Max B450 ATX', '12345678', 5, '112233', '2020-08-28', 24500.00, '223344', NULL, 'TEST', NULL, 6, '2020-08-27 07:00:00', '2020-09-24 07:00:00', 1, NULL, 3, 0, 12, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 5, 0, 0, 0, 0, 5, 3, 1),
(14, '127 caimito st blk 5 west rembo makati city', 'Graphic Card', 8, '1234', '2020-09-23', 24600.00, '2345', NULL, 'TEST LOREM IPSUM', NULL, 1, '2020-09-01 07:00:00', NULL, 1, NULL, 2, 0, 12, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 5, 0, 0, 0, 0, 5, 3, 1),
(15, 'Asset PRO1', '12313', 5, '123142345452', '2020-09-02', 100000.00, '23423523', NULL, 'TEST', NULL, 6, '2020-09-17 07:00:00', NULL, 1, NULL, 4, 0, 10, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, 0, 0, 0, 0, 1, 3, 1),
(16, 'Mardyon C Yongson', '342', 5, '123142345452', '1990-02-10', 100000.00, '2434', NULL, '2424', NULL, 6, '2020-09-26 07:00:00', NULL, 1, NULL, 1, 0, 10, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 2, 0, 0, 0, 0, 1, 3, 1),
(17, 'Mardyon C Yongson', '342', 5, '123142345452', '1990-02-10', 100000.00, '2434', NULL, '2424', NULL, 6, '2020-09-26 07:00:00', NULL, 1, NULL, 1, 0, 10, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 2, 0, 0, 0, 0, 1, 3, 1),
(18, 'Mardyon C Yongson', '1236779', 5, '4324', '1992-02-10', 100000.00, '23423523', NULL, 'tesst', NULL, 6, '2020-09-26 07:00:00', NULL, 1, NULL, 1, 0, 10, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, 0, 0, 0, 0, 1, 3, 1),
(19, 'Mardyon C Yongson', '1236779', 5, '4324', '1992-02-10', 100000.00, '23423523', NULL, 'tesst', NULL, 6, '2020-09-26 07:00:00', NULL, 1, NULL, 1, 0, 10, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, 0, 0, 0, 0, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_companies`
--

CREATE TABLE `tbl_companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_companies`
--

INSERT INTO `tbl_companies` (`id`, `name`, `created_at`, `updated_at`, `image`, `is_deleted`) VALUES
(1, 'MSI', NULL, NULL, 'ha2oy81.png', 0),
(2, 'GIGABYTE', NULL, NULL, 'ha2oy8.png', 0),
(3, 'TEST2', NULL, NULL, 'f2uz1o1.png', 1),
(4, 'AORUS', NULL, NULL, 'ha2oy82.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gps`
--

CREATE TABLE `tbl_gps` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(10) DEFAULT NULL,
  `event` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timestamp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirects` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitors` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secrettoken` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_deleted` tinyint(1) DEFAULT '0',
  `address` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gps`
--

INSERT INTO `tbl_gps` (`id`, `asset_id`, `event`, `timestamp`, `redirects`, `visitors`, `device`, `os`, `country`, `lng`, `lat`, `user`, `email`, `mobile`, `type`, `code`, `secrettoken`, `image`, `is_deleted`, `address`) VALUES
(69, 15, 'QR_CODE_SCANNED', '2020-09-26 09:56:07', '3', '2', 'Samsung SM-A015F', 'Chrome Mobile - Android', 'Philippines', NULL, NULL, 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'URL', '8vughx', '02b91879826bd600ff76aded7465af76', NULL, 0, NULL),
(67, 13, 'QR_CODE_SCANNED', '2020-09-18 12:07:03', '8', '3', 'PC ', 'BOT - ', 'Philippines', '121.0509', '14.6488', 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'URL', '0bk12l', '02b91879826bd600ff76aded7465af76', NULL, 0, 'Kalayaan Ave, Diliman, Quezon City, Metro Manila, Philippines'),
(68, 13, 'QR_CODE_SCANNED', '2020-09-18 12:07:24', '9', '4', 'OPPO F9 Pro', 'Opera Mobile - Android', 'Philippines', '121.0344059', '14.6479576', 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'URL', '0bk12l', '02b91879826bd600ff76aded7465af76', NULL, 0, '12 E Maya Dr, Quezon City, Metro Manila, Philippines'),
(66, 15, 'QR_CODE_SCANNED', '2020-09-17 13:03:39', '2', '1', 'OPPO F9 Pro', 'Chrome Mobile - Android', 'Philippines', NULL, NULL, 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'URL', '8vughx', '02b91879826bd600ff76aded7465af76', NULL, 0, NULL),
(65, 15, 'QR_CODE_SCANNED', '2020-09-17 13:01:22', '1', '1', 'OPPO F9 Pro', 'Chrome Mobile - Android', 'Philippines', NULL, NULL, 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'URL', '8vughx', '02b91879826bd600ff76aded7465af76', NULL, 0, NULL),
(64, 15, 'QR_CODE_SCANNED', '2020-09-17 13:00:19', '1', '1', 'PC ', 'BOT - ', 'Philippines', '121.0509', '14.6488', 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'URL', '8vughx', '02b91879826bd600ff76aded7465af76', NULL, 0, 'Kalayaan Ave, Diliman, Quezon City, Metro Manila, Philippines'),
(63, 15, 'QR_CODE_SCANNED', '2020-09-17 12:26:12', '1', '1', 'PC ', 'BOT - ', 'Philippines', '121.0509', '14.6488', 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'URL', '8vughx', '02b91879826bd600ff76aded7465af76', NULL, 0, 'Kalayaan Ave, Diliman, Quezon City, Metro Manila, Philippines'),
(46, 13, 'QR_CODE_SCANNED', '2020-08-27 07:56:49', '2', '1', 'Xiaomi Redmi Note 6', 'Chrome Mobile - Android', 'Philippines', '121.0586171', '14.5603423', 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'URL', '0bk12l', '02b91879826bd600ff76aded7465af76', NULL, 0, '129 T. Alonzo Ext, Makati, 1215 Metro Manila, Philippines'),
(47, NULL, 'QR_CODE_CREATED', '2020-08-27 10:52:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dondonpentavia', NULL, NULL, NULL, 's1g23b', '02b91879826bd600ff76aded7465af76', NULL, 0, NULL),
(48, 12, 'QR_CODE_SCANNED', '2020-08-27 11:04:11', '1', '1', 'Huawei Nova 3i', 'Chrome Mobile - Android', 'Spain', '2.1885389', '41.3728891', 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'URL', '3ql8g5', '02b91879826bd600ff76aded7465af76', NULL, 0, 'Passeig de Joan de Borbó, 79, 08039 Barcelona, Spain'),
(49, NULL, 'QR_CODE_SCANNED', '2020-08-27 11:12:06', '1', '1', 'Apple ', 'Chrome - Mac', '', NULL, NULL, 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'PLAIN', 's1g23b', '02b91879826bd600ff76aded7465af76', NULL, 0, NULL),
(50, NULL, 'QR_CODE_CREATED', '2020-08-27 11:47:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dondonpentavia', NULL, NULL, NULL, '1i5swz', '02b91879826bd600ff76aded7465af76', NULL, 0, NULL),
(51, NULL, 'QR_CODE_CREATED', '2020-08-27 11:47:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dondonpentavia', NULL, NULL, NULL, '4itfha', '02b91879826bd600ff76aded7465af76', NULL, 0, NULL),
(52, NULL, 'QR_CODE_SCANNED', '2020-08-27 11:50:06', '1', '1', 'Apple ', 'Chrome - Mac', '', NULL, NULL, 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'PLAIN', 's1g23b', '02b91879826bd600ff76aded7465af76', NULL, 0, NULL),
(53, NULL, 'QR_CODE_SCANNED', '2020-08-27 11:50:28', '2', '2', 'Apple ', 'Chrome - Mac', '', NULL, NULL, 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'PLAIN', 's1g23b', '02b91879826bd600ff76aded7465af76', NULL, 0, NULL),
(54, NULL, 'QR_CODE_SCANNED', '2020-08-27 11:51:18', '3', '2', 'Apple ', 'Chrome - Mac', '', NULL, NULL, 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'PLAIN', 's1g23b', '02b91879826bd600ff76aded7465af76', NULL, 0, NULL),
(55, NULL, 'QR_CODE_SCANNED', '2020-08-27 13:26:04', '4', '2', 'PC ', 'Firefox - Windows', 'Philippines', '121.0521', '14.4827', 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'PLAIN', 's1g23b', '02b91879826bd600ff76aded7465af76', NULL, 0, '19 Rd 10, josephsett bagumbayan, Taguig, Metro Manila, Philippines'),
(56, NULL, 'QR_CODE_CREATED', '2020-08-27 14:12:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dondonpentavia', NULL, NULL, NULL, 'oz5c2l', '02b91879826bd600ff76aded7465af76', NULL, 0, NULL),
(57, NULL, 'QR_CODE_SCANNED', '2020-08-28 07:55:03', '5', '3', 'PC ', 'Firefox - Windows', 'Philippines', '121.0521', '14.4827', 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'PLAIN', 's1g23b', '02b91879826bd600ff76aded7465af76', NULL, 0, '19 Rd 10, josephsett bagumbayan, Taguig, Metro Manila, Philippines'),
(58, NULL, 'QR_CODE_SCANNED', '2020-08-28 07:59:39', '6', '3', 'PC ', 'BOT - Windows', 'United States', '-97.822', '37.751', 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'PLAIN', 's1g23b', '02b91879826bd600ff76aded7465af76', NULL, 0, 'Ninnescah, KS, USA'),
(59, 13, 'QR_CODE_SCANNED', '2020-08-28 09:16:52', '3', '1', 'PC ', 'Chrome - Windows', 'Philippines', '120.9842', '14.4525', 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'URL', '0bk12l', '02b91879826bd600ff76aded7465af76', NULL, 0, '26 5th St, Las Pinas, Metro Manila, Philippines'),
(60, 13, 'QR_CODE_SCANNED', '2020-09-10 16:16:37', '5', '3', 'PC ', 'Chrome - Windows', 'Philippines', '120.9704', '14.4546', 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'URL', '0bk12l', '02b91879826bd600ff76aded7465af76', NULL, 0, '130 Molino Rd, Bacoor, Cavite, Philippines'),
(61, 13, 'QR_CODE_SCANNED', '2020-09-10 16:16:44', '6', '3', 'PC ', 'Chrome - Windows', 'Philippines', '120.9704', '14.4546', 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'URL', '0bk12l', '02b91879826bd600ff76aded7465af76', NULL, 0, '130 Molino Rd, Bacoor, Cavite, Philippines'),
(62, 13, 'QR_CODE_SCANNED', '2020-09-10 16:16:47', '7', '3', 'PC ', 'Chrome - Windows', 'Philippines', '120.9704', '14.4546', 'dondonpentavia', 'dondonpentavia@gmail.com', '09773656715', 'URL', '0bk12l', '02b91879826bd600ff76aded7465af76', NULL, 0, '130 Molino Rd, Bacoor, Cavite, Philippines');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(10) NOT NULL,
  `current_custodian_id` int(11) DEFAULT NULL,
  `previous_custodian_id` int(11) DEFAULT NULL,
  `current_location_id` int(11) DEFAULT NULL,
  `previous_location_id` int(11) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_history`
--

INSERT INTO `tbl_history` (`id`, `asset_id`, `current_custodian_id`, `previous_custodian_id`, `current_location_id`, `previous_location_id`, `description`, `created_at`, `updated_at`, `deleted_at`, `status_id`, `is_deleted`, `user_id`) VALUES
(4, 13, 3, 5, 5, 5, 'update', '2020-08-27 11:16:21', '2020-08-27 11:16:54', NULL, NULL, 0, 1),
(3, 13, 5, NULL, 5, NULL, 'create', '2020-08-27 11:16:21', NULL, NULL, NULL, 0, 1),
(5, 13, 5, 3, 4, 5, 'update', '2020-08-27 11:16:21', '2020-08-27 11:21:03', NULL, NULL, 0, 1),
(6, 13, 5, 5, 5, 4, 'update', '2020-08-27 11:16:21', '2020-08-28 01:38:08', NULL, NULL, 0, 1),
(7, 14, 5, NULL, 5, NULL, 'create', '2020-09-01 10:32:39', NULL, NULL, NULL, 0, 1),
(8, 15, 1, NULL, 2, NULL, 'create', '2020-09-17 17:24:41', NULL, NULL, NULL, 0, 6),
(9, 13, 5, 5, 5, 5, 'update', '2020-08-27 11:16:21', '2020-09-24 23:51:30', NULL, NULL, 0, 6),
(10, 16, 1, NULL, 2, NULL, 'create', '2020-09-26 14:48:20', NULL, NULL, NULL, 0, 6),
(11, 17, 1, NULL, 2, NULL, 'create', '2020-09-26 14:48:40', NULL, NULL, NULL, 0, 6),
(12, 18, 1, NULL, 2, NULL, 'create', '2020-09-26 14:49:53', NULL, NULL, NULL, 0, 6),
(13, 19, 1, NULL, 2, NULL, 'create', '2020-09-26 14:50:32', NULL, NULL, NULL, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locations`
--

CREATE TABLE `tbl_locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_locations`
--

INSERT INTO `tbl_locations` (`id`, `name`, `image`, `is_deleted`, `lat`, `lng`) VALUES
(1, 'Metro Manila', '', 1, '', ''),
(2, 'NATIONAL CAPITAL REGION', '', 0, '', ''),
(3, 'REGION 5', '', 1, '', ''),
(4, 'REGION 5', '', 0, '', ''),
(5, '127 T. Alonzo Ext. Makati City 1215', '', 0, '14.5604791', '121.0586711');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_models`
--

CREATE TABLE `tbl_models` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_models`
--

INSERT INTO `tbl_models` (`id`, `name`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'TEST12', NULL, NULL, 1),
(2, 'TEST2', NULL, NULL, 1),
(3, 'TEST2', NULL, NULL, 1),
(4, 'test', NULL, NULL, 1),
(5, 'TOMAHAWK B450 MAX', NULL, NULL, 0),
(6, 'AORUS B450 ELITE', NULL, NULL, 0),
(7, 'MORTAR MAX B450', NULL, NULL, 0),
(8, 'GEFORCE RTX', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qrcodes`
--

CREATE TABLE `tbl_qrcodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(10) NOT NULL,
  `qr_code` text,
  `code` varchar(25) DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_qrcodes`
--

INSERT INTO `tbl_qrcodes` (`id`, `asset_id`, `qr_code`, `code`, `image`, `is_deleted`) VALUES
(13, 13, '{\"result\":{\"shorturl\":\"https:\\/\\/mbyongson.qrd.by\\/0bk12l\",\"qr\":\"https:\\/\\/mbyongson.qrd.by\\/i\\/0bk12l\",\"url\":\"https:\\/\\/psapro-itasset.com\\/get-assets\\/dTMxcm1WUk4rZ2c5QlFRNFN2NE9Ddz09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-08-27 06:16:21\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', '0bk12l', NULL, 0),
(12, 12, '{\"result\":{\"shorturl\":\"https:\\/\\/mbyongson.qrd.by\\/3ql8g5\",\"qr\":\"https:\\/\\/mbyongson.qrd.by\\/i\\/3ql8g5\",\"url\":\"https:\\/\\/psapro-itasset.com\\/get-assets\\/ZlRWaWd5L084NFQwb3JONlNsMVJSUT09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-08-27 06:09:40\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', '3ql8g5', NULL, 0),
(14, 14, '{\"result\":{\"shorturl\":\"https:\\/\\/mbyongson.qrd.by\\/9nk735\",\"qr\":\"https:\\/\\/mbyongson.qrd.by\\/i\\/9nk735\",\"url\":\"https:\\/\\/psapro-itasset.com\\/get-assets\\/MXFMSVZSZEgvYU1wUlFFTlRtK2h2Zz09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-09-01 05:32:39\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', '9nk735', NULL, 0),
(15, 15, '{\"result\":{\"shorturl\":\"https:\\/\\/mbyongson.qrd.by\\/8vughx\",\"qr\":\"https:\\/\\/mbyongson.qrd.by\\/i\\/8vughx\",\"url\":\"https:\\/\\/psapro-itasset.com\\/get-assets\\/QkR5N2Z5K09haUREeFA3UHhlMExtdz09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-09-17 12:24:41\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', '8vughx', NULL, 0),
(16, 16, '{\"result\":{\"shorturl\":\"https:\\/\\/mbyongson.qrd.by\\/w4a729\",\"qr\":\"https:\\/\\/mbyongson.qrd.by\\/i\\/w4a729\",\"url\":\"https:\\/\\/psapro-itasset.com\\/get-assets\\/ek83N0pkaXVoemlDeHBaRXZWdmVrdz09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-09-26 09:48:20\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', 'w4a729', NULL, 0),
(17, 17, '{\"result\":{\"shorturl\":\"https:\\/\\/mbyongson.qrd.by\\/u5z7gx\",\"qr\":\"https:\\/\\/mbyongson.qrd.by\\/i\\/u5z7gx\",\"url\":\"https:\\/\\/psapro-itasset.com\\/get-assets\\/UytEbGhUQXVwWHFFU3NqMXdrdkg3UT09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-09-26 09:48:39\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', 'u5z7gx', NULL, 0),
(18, 18, '{\"result\":{\"shorturl\":\"https:\\/\\/mbyongson.qrd.by\\/of06cl\",\"qr\":\"https:\\/\\/mbyongson.qrd.by\\/i\\/of06cl\",\"url\":\"https:\\/\\/psapro-itasset.com\\/get-assets\\/NHVFZmlsdWpYS3NyTEY1MTA2Tjh6QT09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-09-26 09:49:52\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', 'of06cl', NULL, 0),
(19, 19, '{\"result\":{\"shorturl\":\"https:\\/\\/mbyongson.qrd.by\\/nz01x8\",\"qr\":\"https:\\/\\/mbyongson.qrd.by\\/i\\/nz01x8\",\"url\":\"https:\\/\\/psapro-itasset.com\\/get-assets\\/OURjRzR0OFhza1FBZG1ERG5lMXZqZz09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-09-26 09:50:32\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', 'nz01x8', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status_labels`
--

CREATE TABLE `tbl_status_labels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deployable` tinyint(1) NOT NULL DEFAULT '0',
  `pending` tinyint(1) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_in_nav` tinyint(1) NOT NULL DEFAULT '0',
  `default_label` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status_labels`
--

INSERT INTO `tbl_status_labels` (`id`, `name`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `deployable`, `pending`, `archived`, `notes`, `color`, `show_in_nav`, `default_label`, `is_deleted`) VALUES
(1, 'Pending', 1, NULL, NULL, NULL, 0, 1, 0, 'These assets are not yet ready to be deployed, usually because of configuration or waiting on parts.', '', 0, 0, 0),
(2, 'Ready to Deploy', 1, NULL, NULL, NULL, 1, 0, 0, 'These assets are ready to deploy.', '', 0, 0, 0),
(3, 'Dispatch', 1, NULL, NULL, NULL, 0, 0, 1, 'These assets are Dispatch By User', '', 0, 0, 0),
(4, 'Deployed', 1, NULL, NULL, NULL, 1, 0, 0, 'These assets are Deployed By User', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suppliers`
--

CREATE TABLE `tbl_suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_suppliers`
--

INSERT INTO `tbl_suppliers` (`id`, `name`, `address`, `contact_name`, `contact_no`, `email`, `web`, `notes`, `image`, `is_deleted`) VALUES
(1, 'DYNAQUEST PC', 'CASH N CARRY PASAY ROAD MAKATI CITY', 'Jenny', '0983232552', 'info@dynaquestpc.com', 'dynaquestpc.com', 'TEST', '', 0),
(2, 'TIPID PC', 'DELPAN JP RIZAL EXTENSION MAKATI CITY', 'ROBERT JOBERT', '098879784254', 'info@tipidpc.com', 'tipidpc.com', 'TEST', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_uploads`
--

CREATE TABLE `tbl_uploads` (
  `uploads_id` int(11) NOT NULL,
  `asset_id` int(10) NOT NULL,
  `image_name` text,
  `image_path` text,
  `file_name` text,
  `file_path` text,
  `transaction_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_uploads`
--

INSERT INTO `tbl_uploads` (`uploads_id`, `asset_id`, `image_name`, `image_path`, `file_name`, `file_path`, `transaction_date`) VALUES
(13, 14, 'geforce_rtx_20605.jpg', '/home/c0jh0qwz8ppg/public_html/assets/image/uploads/', NULL, NULL, '2020-09-01'),
(12, 13, 'tomahawk8.jpg', '/home/c0jh0qwz8ppg/public_html/assets/image/uploads/', NULL, NULL, '2020-08-27'),
(11, 12, 'tomahawk7.jpg', '/home/c0jh0qwz8ppg/public_html/assets/image/uploads/', NULL, NULL, '2020-08-27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `screen_name` text,
  `username` text,
  `password` text,
  `txt_password` text,
  `trans_date` date DEFAULT NULL,
  `trans_desc` text,
  `is_deleted` tinyint(1) DEFAULT '0',
  `last_name` text,
  `first_name` text,
  `middle_name` text,
  `level` tinyint(4) DEFAULT '0' COMMENT '0=Administrator,1=Manager,2=Tech Support,3=User - Requestor',
  `email` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `fp_time` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `screen_name`, `username`, `password`, `txt_password`, `trans_date`, `trans_desc`, `is_deleted`, `last_name`, `first_name`, `middle_name`, `level`, `email`, `designation`, `fp_time`) VALUES
(1, 'Admins', 'user1', '$2y$10$RdmlOAPf.LPNqb8AvqE9leqPnasEOAmAERZtYXpNEdH4jUdcptemG', '1234567', '2020-08-15', 'add', 0, 'Pentavia', 'Dondon', 'Hammet', 0, 'dondonpentavia@gmail.com', 'Developer', '1596212804'),
(2, 'Dondon', 'user2', '$2y$10$GetAQ4qm7q8.d0YSYLWteeG1E3bFu7m0u94oENHugwmnOrGk060ja', '123456', '2020-04-25', '', 1, 'Baisac', 'Andolino', 'Gallardo', 4, 'baisac.andolino@gmail.com', 'Programmer', ''),
(3, 'Robin', 'user3', '$2y$10$Y01UZfLD/j.GAFpOK0HQ.eYffCKQNZKHEV94MIz5y/CHxMBs498fG', '123456', '2020-04-25', '', 0, 'Cardo', 'Dalisay', 'Mendoza', 2, 'robinpadilla@gmail.com', 'Staff', ''),
(4, 'Mardyon', 'user4', '$2y$10$6373IZTPGcWskK/pY3gBWOrW7C5SCzxURVc7XjIWjpc5icQv.ZDqy', '12345678', '2020-04-29', '', 1, 'Congzon', 'Mardyon', 'G', 0, 'mardyon@gmail.com', 'Programmer', ''),
(5, 'Peter', 'peteAdmin', '$2y$10$D/gp043WINZDAHrdSQOryu8gUfGbYBlv/fDMdkthgmJs3BoTAyKM6', '!@#QWEASDZXC', '2020-08-15', '', 0, 'Mora', 'Peter', 'BIllones', 0, 'peterbillonesmora@gmail.com', 'TEST', NULL),
(6, 'Aris', 'aris', '$2y$10$GDYWbNo6fGvTyeY2DgH6UO8EJo9u/JtrZOw8TGF4.1.wsxIoHMdHW', '123456', '2020-09-26', NULL, 0, 'Ramos', 'Aris', 'C', 2, 'mardyon.yongson1026@gmail.com', 'Administrative Officer', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_activity_logs`
-- (See below for the actual view)
--
CREATE TABLE `v_activity_logs` (
`id` int(10) unsigned
,`user_id` int(11)
,`action_type` varchar(191)
,`target_id` int(11)
,`target_type` varchar(191)
,`location_id` int(11)
,`note` text
,`filename` text
,`item_type` varchar(191)
,`item_id` int(11)
,`expected_checkin` date
,`accepted_id` int(11)
,`created_at` timestamp
,`updated_at` timestamp
,`deleted_at` timestamp
,`thread_id` int(11)
,`company_id` int(11)
,`accept_signature` varchar(100)
,`log_meta` text
,`is_deleted` tinyint(1)
,`asset_name` varchar(191)
,`screen_name` text
,`target` text
,`lat` varchar(191)
,`lng` varchar(191)
,`address` text
,`default_location` varchar(191)
,`scanned_lat` varchar(255)
,`scanned_lng` varchar(255)
,`code` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_asset`
-- (See below for the actual view)
--
CREATE TABLE `v_asset` (
`id` int(10) unsigned
,`name` varchar(191)
,`company` varchar(191)
,`asset_tag` varchar(191)
,`model` varchar(191)
,`status` varchar(100)
,`serial` varchar(191)
,`asset_name` varchar(191)
,`purchase_date` date
,`supplier` varchar(191)
,`order_number` varchar(191)
,`purchase_cost` decimal(20,2)
,`warranty_months` int(11)
,`default_location` varchar(191)
,`notes` text
,`requestable` tinyint(4)
,`is_deleted` tinyint(1)
,`status_id` int(11)
,`screen_name` text
,`office_name` text
,`region` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_asset_request`
-- (See below for the actual view)
--
CREATE TABLE `v_asset_request` (
`asset_name` varchar(191)
,`timestamp` varchar(191)
,`device` varchar(191)
,`os` varchar(191)
,`country` varchar(191)
,`lng` varchar(191)
,`lat` varchar(191)
,`user` varchar(191)
,`email` varchar(191)
,`mobile` varchar(191)
,`type` varchar(191)
,`is_deleted` tinyint(1)
,`screen_name` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_history_logs`
-- (See below for the actual view)
--
CREATE TABLE `v_history_logs` (
`id` int(10) unsigned
,`description` varchar(255)
,`asset_tag` varchar(191)
,`current_custodian` text
,`previous_custodian` text
,`current_location` varchar(191)
,`previous_location` varchar(191)
,`created_at` timestamp
,`updated_at` timestamp
,`is_deleted` tinyint(1)
);

-- --------------------------------------------------------

--
-- Structure for view `v_activity_logs`
--
DROP TABLE IF EXISTS `v_activity_logs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dondonpentavia`@`%.%.%.%` SQL SECURITY DEFINER VIEW `v_activity_logs`  AS  select `tal`.`id` AS `id`,`tal`.`user_id` AS `user_id`,`tal`.`action_type` AS `action_type`,`tal`.`target_id` AS `target_id`,`tal`.`target_type` AS `target_type`,`tal`.`location_id` AS `location_id`,`tal`.`note` AS `note`,`tal`.`filename` AS `filename`,`tal`.`item_type` AS `item_type`,`tal`.`item_id` AS `item_id`,`tal`.`expected_checkin` AS `expected_checkin`,`tal`.`accepted_id` AS `accepted_id`,`tal`.`created_at` AS `created_at`,`tal`.`updated_at` AS `updated_at`,`tal`.`deleted_at` AS `deleted_at`,`tal`.`thread_id` AS `thread_id`,`tal`.`company_id` AS `company_id`,`tal`.`accept_signature` AS `accept_signature`,`tal`.`log_meta` AS `log_meta`,`tal`.`is_deleted` AS `is_deleted`,`ta`.`name` AS `asset_name`,`u`.`screen_name` AS `screen_name`,`u2`.`screen_name` AS `target`,`tg`.`lat` AS `lat`,`tg`.`lng` AS `lng`,`tg`.`address` AS `address`,`tl`.`name` AS `default_location`,`tl`.`lat` AS `scanned_lat`,`tl`.`lng` AS `scanned_lng`,`tg`.`code` AS `code` from (((((`tbl_action_logs` `tal` left join `tbl_asset` `ta` on((`ta`.`id` = `tal`.`target_id`))) left join `users` `u` on((`u`.`users_id` = `tal`.`user_id`))) left join `users` `u2` on((`u2`.`users_id` = `ta`.`checkout_user_id`))) left join `tbl_gps` `tg` on((`tg`.`asset_id` = `ta`.`id`))) left join `tbl_locations` `tl` on((`tl`.`id` = `ta`.`location_id`))) where (`ta`.`is_deleted` = 0) group by `tal`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_asset`
--
DROP TABLE IF EXISTS `v_asset`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dondonpentavia`@`%.%.%.%` SQL SECURITY DEFINER VIEW `v_asset`  AS  select `ta`.`id` AS `id`,`ta`.`name` AS `name`,`tc`.`name` AS `company`,`ta`.`asset_tag` AS `asset_tag`,`tm`.`name` AS `model`,`tsl`.`name` AS `status`,`ta`.`serial` AS `serial`,`ta`.`name` AS `asset_name`,`ta`.`purchase_date` AS `purchase_date`,`ts`.`name` AS `supplier`,`ta`.`order_number` AS `order_number`,`ta`.`purchase_cost` AS `purchase_cost`,`ta`.`warranty_months` AS `warranty_months`,`tl`.`name` AS `default_location`,`ta`.`notes` AS `notes`,`ta`.`requestable` AS `requestable`,`ta`.`is_deleted` AS `is_deleted`,`ta`.`status_id` AS `status_id`,`u`.`screen_name` AS `screen_name`,`om`.`office_name` AS `office_name`,`d`.`region` AS `region` from ((((((((`tbl_asset` `ta` left join `tbl_companies` `tc` on((`tc`.`id` = `ta`.`company_id`))) left join `tbl_models` `tm` on((`tm`.`id` = `ta`.`model_id`))) left join `tbl_status_labels` `tsl` on((`tsl`.`id` = `ta`.`status_id`))) left join `tbl_suppliers` `ts` on((`ts`.`id` = `ta`.`supplier_id`))) left join `tbl_locations` `tl` on((`tl`.`id` = `ta`.`location_id`))) left join `users` `u` on((`u`.`users_id` = `ta`.`checkout_user_id`))) left join `office_management` `om` on((`om`.`office_management_id` = `ta`.`office_management_id`))) left join `departments` `d` on((`d`.`departments_id` = `ta`.`departments_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_asset_request`
--
DROP TABLE IF EXISTS `v_asset_request`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dondonpentavia`@`130.105.52.15` SQL SECURITY DEFINER VIEW `v_asset_request`  AS  select `ta`.`name` AS `asset_name`,`tg`.`timestamp` AS `timestamp`,`tg`.`device` AS `device`,`tg`.`os` AS `os`,`tg`.`country` AS `country`,`tg`.`lng` AS `lng`,`tg`.`lat` AS `lat`,`tg`.`user` AS `user`,`tg`.`email` AS `email`,`tg`.`mobile` AS `mobile`,`tg`.`type` AS `type`,`tg`.`is_deleted` AS `is_deleted`,`u`.`screen_name` AS `screen_name` from ((`tbl_gps` `tg` left join `tbl_asset` `ta` on((`ta`.`id` = `tg`.`asset_id`))) left join `users` `u` on((`u`.`users_id` = `ta`.`checkout_user_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_history_logs`
--
DROP TABLE IF EXISTS `v_history_logs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dondonpentavia`@`%.%.%.%` SQL SECURITY DEFINER VIEW `v_history_logs`  AS  select `th`.`id` AS `id`,`th`.`description` AS `description`,`ta`.`asset_tag` AS `asset_tag`,`u1`.`screen_name` AS `current_custodian`,`u2`.`screen_name` AS `previous_custodian`,`tl1`.`name` AS `current_location`,`tl2`.`name` AS `previous_location`,`th`.`created_at` AS `created_at`,`th`.`updated_at` AS `updated_at`,`th`.`is_deleted` AS `is_deleted` from (((((`tbl_history` `th` left join `tbl_asset` `ta` on((`ta`.`id` = `th`.`asset_id`))) left join `users` `u1` on((`u1`.`users_id` = `th`.`current_custodian_id`))) left join `users` `u2` on((`u2`.`users_id` = `th`.`previous_custodian_id`))) left join `tbl_locations` `tl1` on((`tl1`.`id` = `th`.`current_location_id`))) left join `tbl_locations` `tl2` on((`tl2`.`id` = `th`.`previous_location_id`))) order by `th`.`id` desc ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departments_id`);

--
-- Indexes for table `office_management`
--
ALTER TABLE `office_management`
  ADD PRIMARY KEY (`office_management_id`),
  ADD KEY `ofc_mgmnt_depid_fk_name` (`departments_id`);

--
-- Indexes for table `tbl_action_logs`
--
ALTER TABLE `tbl_action_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_logs_thread_id_index` (`thread_id`),
  ADD KEY `action_logs_target_id_target_type_index` (`target_id`,`target_type`),
  ADD KEY `action_logs_created_at_index` (`created_at`),
  ADD KEY `action_logs_item_type_item_id_action_type_index` (`item_type`,`item_id`,`action_type`),
  ADD KEY `action_logs_target_type_target_id_action_type_index` (`target_type`,`target_id`,`action_type`);

--
-- Indexes for table `tbl_asset`
--
ALTER TABLE `tbl_asset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assets_rtd_location_id_index` (`rtd_location_id`),
  ADD KEY `assets_assigned_type_assigned_to_index` (`assigned_type`,`assigned_to`),
  ADD KEY `assets_created_at_index` (`created_at`),
  ADD KEY `assets_deleted_at_status_id_index` (`deleted_at`,`status_id`),
  ADD KEY `assets_deleted_at_model_id_index` (`deleted_at`,`model_id`),
  ADD KEY `assets_deleted_at_assigned_type_assigned_to_index` (`deleted_at`,`assigned_type`,`assigned_to`),
  ADD KEY `assets_deleted_at_supplier_id_index` (`deleted_at`,`supplier_id`),
  ADD KEY `assets_deleted_at_location_id_index` (`deleted_at`,`location_id`),
  ADD KEY `assets_deleted_at_rtd_location_id_index` (`deleted_at`,`rtd_location_id`),
  ADD KEY `assets_deleted_at_asset_tag_index` (`deleted_at`,`asset_tag`),
  ADD KEY `assets_deleted_at_name_index` (`deleted_at`,`name`);

--
-- Indexes for table `tbl_companies`
--
ALTER TABLE `tbl_companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_companies_name_unique` (`name`);

--
-- Indexes for table `tbl_gps`
--
ALTER TABLE `tbl_gps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_asset_id_index` (`asset_id`);

--
-- Indexes for table `tbl_locations`
--
ALTER TABLE `tbl_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_models`
--
ALTER TABLE `tbl_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_qrcodes`
--
ALTER TABLE `tbl_qrcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_status_labels`
--
ALTER TABLE `tbl_status_labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_suppliers`
--
ALTER TABLE `tbl_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_uploads`
--
ALTER TABLE `tbl_uploads`
  ADD PRIMARY KEY (`uploads_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `departments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `office_management`
--
ALTER TABLE `office_management`
  MODIFY `office_management_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_action_logs`
--
ALTER TABLE `tbl_action_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_asset`
--
ALTER TABLE `tbl_asset`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_companies`
--
ALTER TABLE `tbl_companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_gps`
--
ALTER TABLE `tbl_gps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_locations`
--
ALTER TABLE `tbl_locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_models`
--
ALTER TABLE `tbl_models`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_qrcodes`
--
ALTER TABLE `tbl_qrcodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_status_labels`
--
ALTER TABLE `tbl_status_labels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_suppliers`
--
ALTER TABLE `tbl_suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_uploads`
--
ALTER TABLE `tbl_uploads`
  MODIFY `uploads_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
