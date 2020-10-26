-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2020 at 04:17 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psa`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_classes`
--

CREATE TABLE `account_classes` (
  `class_code` varchar(10) NOT NULL,
  `class_desc` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `fr_mod` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_classes`
--

INSERT INTO `account_classes` (`class_code`, `class_desc`, `user_id`, `entry_date`, `is_deleted`, `fr_mod`) VALUES
('10', 'ASSETS', 999999, '2017-04-12 05:35:01', 0, 'Settings | Chart of Accounts'),
('20', 'LIABILITIES AND EQUITY', 999999, '2020-04-08 10:42:33', 0, 'AUTO'),
('30', 'INCOME & EXPENSE ACCOUNTS', 999999, '2020-04-08 10:46:53', 0, 'Settings | Chart of Accounts');

-- --------------------------------------------------------

--
-- Table structure for table `account_groups`
--

CREATE TABLE `account_groups` (
  `group_code` varchar(10) NOT NULL,
  `group_desc` varchar(100) NOT NULL,
  `class_code` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `fr_mod` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_groups`
--

INSERT INTO `account_groups` (`group_code`, `group_desc`, `class_code`, `user_id`, `entry_date`, `is_deleted`, `fr_mod`) VALUES
('10-00', 'CURRENT ASSETS', '10', 1, '2020-04-24 19:25:09', 0, 'ENTRY'),
('10-01', 'FIXED ASSETS', '10', 1, '2020-04-24 19:13:40', 0, 'ENTRY'),
('20-00', 'Liabilities', '20', 1, '2020-04-06 16:00:00', 0, 'ENTRY'),
('20-01', 'Equity', '20', 1, '2020-04-06 16:00:00', 0, 'ENTRY'),
('30-00', 'Income', '30', 1, '2020-04-06 16:00:00', 0, 'ENTRY'),
('30-01', 'Benefit Claims', '30', 1, '2020-04-06 16:00:00', 0, 'ENTRY'),
('30-02', 'Operating Expenses', '30', 1, '2020-04-06 16:00:00', 0, 'ENTRY');

-- --------------------------------------------------------

--
-- Table structure for table `account_main`
--

CREATE TABLE `account_main` (
  `main_code` varchar(15) NOT NULL,
  `main_desc` varchar(250) NOT NULL,
  `group_code` varchar(10) NOT NULL,
  `normal_bal` varchar(2) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `fr_mod` varchar(250) NOT NULL,
  `code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_main`
--

INSERT INTO `account_main` (`main_code`, `main_desc`, `group_code`, `normal_bal`, `user_id`, `entry_date`, `is_deleted`, `fr_mod`, `code`) VALUES
('10-00-00', 'PETTY CASH FUND', '10-00', 'Dr', 1, '2020-05-12 13:55:46', 0, '', '100'),
('10-00-01', 'CASH ON HAND', '10-00', 'Dr', 1, '2020-04-29 12:28:01', 0, '', '101'),
('10-00-02', 'TEST ACCTS', '10-00', 'Dr', 1, '2020-04-24 19:25:35', 1, '', '9999'),
('10-00-03', 'CASH IN BANKS', '10-00', 'Dr', 1, '2020-04-29 12:28:07', 1, '', '200'),
('10-00-04', 'CASH IN BANK - 3694205959', '10-00', 'Dr', 1, '2020-05-12 13:50:19', 1, '', '103'),
('10-00-05', 'CASH IN BANK - LBP NO. 001442-1023-13', '10-00', 'Dr', 1, '2020-05-12 13:58:04', 0, '', '102'),
('10-00-06', 'Cash in Bank - PNB Account No 235-830465-9', '10-00', 'Dr', 1, '2020-05-11 19:56:35', 0, '', '103'),
('10-01-00', 'Office Equipment', '10-01', 'Dr', 1, '2020-05-11 19:58:37', 0, '', '118'),
('10-01-01', 'Accum. Depreciation- Office Equipment', '10-01', 'Dr', 1, '2020-05-11 19:58:56', 0, '', '119'),
('20-00-00', 'Deferred Credits', '20-00', 'Cr', 1, '2020-05-11 19:59:49', 0, '', '200'),
('20-00-01', 'Unearned Interest Income', '20-00', 'Cr', 1, '2020-05-11 20:00:09', 0, '', '201'),
('20-00-02', 'Benefit Claim Payable', '20-00', 'Cr', 1, '2020-05-11 20:00:32', 0, '', '202'),
('10-00-07', 'Cash in Bank - MBTC No.3-28380077-7', '10-00', 'Dr', 1, '2020-05-11 20:01:48', 0, '', '104'),
('10-00-08', 'Cash in Bank - Special Savings Deposits', '10-00', 'Dr', 1, '2020-05-11 20:02:46', 0, '', '105'),
('10-00-09', 'Time Deposit', '10-00', 'Dr', 1, '2020-05-11 20:03:03', 0, '', '106'),
('10-00-10', 'Short-Term Investment', '10-00', 'Dr', 1, '2020-05-11 20:03:18', 0, '', '107'),
('10-00-11', 'Loans Receivable', '10-00', 'Dr', 1, '2020-05-11 20:03:29', 0, '', '108'),
('10-00-12', 'Allowance for Doubtful Accounts', '10-00', 'Dr', 1, '2020-05-11 20:03:45', 0, '', '109'),
('10-00-13', 'Interest Receivable', '10-00', 'Dr', 1, '2020-05-11 20:04:00', 0, '', '110'),
('10-00-14', 'Cash Advance', '10-00', 'Dr', 1, '2020-05-11 20:04:17', 0, '', '111'),
('10-00-15', 'Due from NSO', '10-00', 'Dr', 1, '2020-05-11 20:04:32', 0, '', '112'),
('10-00-16', 'Tax Refund', '10-00', 'Dr', 1, '2020-05-11 20:04:44', 0, '', '113'),
('10-00-17', 'Accounts Receivable', '10-00', 'Dr', 1, '2020-05-11 20:04:57', 0, '', '114'),
('10-00-18', 'Accounts Receivable-others', '10-00', 'Dr', 1, '2020-05-11 20:05:09', 0, '', '115'),
('10-00-19', 'Accrued Income ( Stall )', '10-00', 'Dr', 1, '2020-05-11 20:05:27', 0, '', '116'),
('10-00-20', 'Supplies Inventory', '10-00', 'Dr', 1, '2020-05-11 20:05:39', 0, '', '117'),
('10-01-02', 'Office Furniture', '10-01', 'Dr', 1, '2020-05-11 20:06:01', 0, '', '120'),
('10-01-03', 'Accum. Depreciation- Office Furniture', '10-01', 'Dr', 1, '2020-05-11 20:06:14', 0, '', '121'),
('20-00-03', 'Withholding Tax Payable', '20-00', 'Cr', 1, '2020-05-12 14:08:44', 0, '', '203'),
('20-00-04', 'PAG-IBIG Payable', '20-00', 'Cr', 1, '2020-05-12 14:08:44', 0, '', '204'),
('20-00-05', 'SSS Payable', '20-00', 'Cr', 1, '2020-05-11 20:09:00', 0, '', '205'),
('20-00-06', 'Philhealth Payable', '20-00', 'Cr', 1, '2020-05-11 20:09:22', 0, '', '206'),
('20-00-07', 'PEPO Premiums Payable', '20-00', 'Cr', 1, '2020-05-11 20:09:50', 0, '', '207'),
('20-00-08', 'Other Payables', '20-00', 'Cr', 1, '2020-05-11 20:10:10', 0, '', '208'),
('20-00-09', 'Accrued Expenses', '20-00', 'Cr', 1, '2020-05-11 20:10:31', 0, '', '209'),
('20-00-10', 'Income Tax Payable', '20-00', 'Cr', 1, '2020-05-11 20:10:55', 0, '', '210'),
('20-01-00', 'Members\' Contribution', '20-01', 'Cr', 1, '2020-05-11 20:11:26', 0, '', '300'),
('20-01-01', 'Loan Redemption Insurance (LRI)', '20-01', 'Cr', 1, '2020-05-11 20:11:55', 0, '', '301'),
('20-01-02', 'Reserved for Benefit Claim', '20-01', 'Cr', 1, '2020-05-11 20:12:16', 0, '', '302'),
('20-01-03', 'Personnel Assistance Fund', '20-01', 'Cr', 1, '2020-05-11 20:12:40', 0, '', '303'),
('20-01-04', 'Results of Operation', '20-01', 'Cr', 1, '2020-05-11 20:12:58', 0, '', '304'),
('30-00-00', 'Interest Income - Loans', '30-00', 'Cr', 1, '2020-05-11 20:14:10', 0, '', '500'),
('30-00-01', 'Service Charge', '30-00', 'Cr', 1, '2020-05-11 20:14:29', 0, '', '501'),
('30-00-02', 'Donations - Service Allowance', '30-00', 'Cr', 1, '2020-05-11 20:15:06', 0, '', '502'),
('30-00-03', 'PEPO Premiums Income', '30-00', 'Cr', 1, '2020-05-11 20:15:23', 0, '', '503'),
('30-00-04', 'COMM. PHONE RENTAL', '30-00', 'Cr', 1, '2020-05-12 14:18:06', 0, '', '504'),
('30-00-05', 'COMM. KEY CHAIN', '30-00', 'Cr', 1, '2020-05-12 14:18:15', 0, '', '505'),
('30-00-06', 'COMM. STALL', '30-00', 'Cr', 1, '2020-05-12 14:18:21', 0, '', '506'),
('30-00-07', 'Interest on Bank Deposits', '30-00', 'Cr', 1, '2020-05-11 20:18:40', 0, '', '507'),
('30-00-08', 'Interest on Investment', '30-00', 'Cr', 1, '2020-05-11 20:21:31', 0, '', '508'),
('30-00-09', 'Other Income', '30-00', 'Cr', 1, '2020-05-11 20:21:56', 0, '', '509'),
('30-01-00', 'Retirement - CPF Share', '30-01', 'Cr', 1, '2020-05-11 20:24:43', 0, '', '400'),
('30-01-01', 'Death  of Member', '30-01', 'Cr', 1, '2020-05-11 20:25:03', 0, '', '401'),
('30-01-02', 'Death of Immediate Family', '30-01', 'Cr', 1, '2020-05-11 20:25:23', 0, '', '402'),
('30-01-03', 'Sickness Benefit', '30-01', 'Cr', 1, '2020-05-11 20:25:37', 0, '', '403'),
('30-01-04', 'Calamity Benefit', '30-01', 'Cr', 1, '2020-05-11 20:26:01', 0, '', '404'),
('30-01-05', 'Health Care Assistance', '30-01', 'Cr', 1, '2020-05-11 20:31:29', 0, '', '405'),
('30-02-00', 'PEPO Premiums', '30-02', 'Dr', 1, '2020-05-11 20:31:56', 0, '', '406'),
('30-02-01', 'Service Allowance', '30-02', 'Dr', 1, '2020-05-11 20:32:15', 0, '', '407'),
('30-02-02', 'Salaries & Wages', '30-02', 'Dr', 1, '2020-05-11 20:32:30', 0, '', '408');

-- --------------------------------------------------------

--
-- Table structure for table `account_subsidiary`
--

CREATE TABLE `account_subsidiary` (
  `account_subsidiary_id` bigint(20) NOT NULL,
  `code` varchar(50) NOT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL,
  `sub_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_subsidiary`
--

INSERT INTO `account_subsidiary` (`account_subsidiary_id`, `code`, `employee_id`, `name`, `users_id`, `is_deleted`, `entry_date`, `sub_code`) VALUES
(1, '103', '000934', 'Dondon', NULL, 0, '2020-05-12', '934'),
(2, '102', '002422', 'Peter', NULL, 0, '2020-05-12', '823');

-- --------------------------------------------------------

--
-- Table structure for table `asset_category`
--

CREATE TABLE `asset_category` (
  `asset_category_id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asset_category`
--

INSERT INTO `asset_category` (`asset_category_id`, `code`, `name`, `is_deleted`, `entry_date`) VALUES
(1, '00293', 'CATEGORY 1', 0, '2020-10-22');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `beneficiaries_id` int(11) NOT NULL,
  `relationship_type_id` int(11) NOT NULL,
  `members_id` varchar(11) NOT NULL,
  `name` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`beneficiaries_id`, `relationship_type_id`, `members_id`, `name`, `is_deleted`, `entry_date`) VALUES
(1, 2, '00000002', 'alfonso', 0, '2020-04-25'),
(3, 2, '00000002', 'Alfreds', 1, '2020-04-25'),
(4, 2, '00000002', 'Rey', 0, '2020-04-26'),
(5, 1, '00000001', 'Jenny De Juan', 0, '2020-04-26'),
(6, 2, '00000001', 'Arnold', 0, '2020-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `benefit_settings`
--

CREATE TABLE `benefit_settings` (
  `benefit_settings_id` int(11) NOT NULL,
  `sickness` decimal(12,2) DEFAULT 0.00,
  `doif` decimal(12,2) DEFAULT 0.00,
  `accident` decimal(12,2) DEFAULT 0.00,
  `calamity` decimal(12,2) DEFAULT 0.00,
  `users_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `benefit_settings`
--

INSERT INTO `benefit_settings` (`benefit_settings_id`, `sickness`, `doif`, `accident`, `calamity`, `users_id`, `is_deleted`, `entry_date`) VALUES
(1, '10000.00', '2000.00', '3000.00', '5000.00', 1, 0, '2020-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `benefit_type`
--

CREATE TABLE `benefit_type` (
  `benefit_type_id` int(11) NOT NULL,
  `type_of_benefit` text DEFAULT NULL,
  `min_amnt` decimal(12,2) DEFAULT NULL,
  `multi_claim` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `benefit_type`
--

INSERT INTO `benefit_type` (`benefit_type_id`, `type_of_benefit`, `min_amnt`, `multi_claim`, `entry_date`, `is_deleted`) VALUES
(1, 'Retirement', '1000.00', 1, '2020-05-03', 0),
(2, 'Retirements', '400.00', 1, '2020-04-26', 1),
(3, 'Retirements', '400.00', 1, '2020-04-26', 1),
(4, 'Resignation', '1000.00', 1, '2020-05-03', 0),
(5, 'Separation for a cause', '1000.00', 1, '2020-05-03', 0),
(6, 'Death of a Member', '1000.00', 1, '2020-05-03', 0),
(7, 'Sickness', '10000.00', 0, '2020-05-05', 0),
(8, 'Death of an Immediate Family', '2000.00', 0, '2020-05-05', 0),
(9, 'Accident', '3000.00', 0, '2020-05-05', 0),
(10, 'Calamity or Fire', '5000.00', 0, '2020-05-05', 0),
(11, 'Health Care Assistance', '1000.00', 0, '2020-05-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cash_gift`
--

CREATE TABLE `cash_gift` (
  `cash_gift_id` int(11) NOT NULL,
  `members_id` varchar(11) NOT NULL,
  `amount` decimal(12,2) DEFAULT 0.00,
  `rate` decimal(12,2) DEFAULT 0.00,
  `is_deleted` tinyint(1) DEFAULT 0,
  `date_applied` date DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `tot_contribution` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_gift`
--

INSERT INTO `cash_gift` (`cash_gift_id`, `members_id`, `amount`, `rate`, `is_deleted`, `date_applied`, `entry_date`, `status`, `remarks`, `tot_contribution`) VALUES
(21, '00000001', '153.01', '2.00', 0, '2020-06-24', '2020-06-10', NULL, 'TEST', '7650.56'),
(22, '00000002', '85.20', '2.00', 0, '2020-06-24', '2020-06-10', NULL, 'TEST', '4259.84'),
(23, '00000004', '48.00', '2.00', 0, '2020-06-24', '2020-06-10', NULL, 'TEST', '2400.00'),
(24, '00000005', '0.00', '2.00', 0, '2020-06-24', '2020-06-10', NULL, 'TEST', NULL),
(25, '00000006', '0.00', '2.00', 0, '2020-06-24', '2020-06-10', NULL, 'TEST', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `civil_status`
--

CREATE TABLE `civil_status` (
  `civil_status_id` int(11) NOT NULL,
  `status` text DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `civil_status`
--

INSERT INTO `civil_status` (`civil_status_id`, `status`, `entry_date`, `is_deleted`) VALUES
(1, 'Single', '2020-04-07', 0),
(2, 'Married', '2020-04-07', 0),
(3, 'Widowed', '2020-04-07', 0),
(6, 'Divorce', '2020-04-25', 1),
(7, 'Seperated', '2020-04-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `claim_benefit`
--

CREATE TABLE `claim_benefit` (
  `claimed_benefit_id` int(11) NOT NULL,
  `members_id` varchar(11) NOT NULL,
  `benefit_type_id` int(11) NOT NULL,
  `claim_date` date NOT NULL,
  `accum_contrib` decimal(12,2) DEFAULT 0.00,
  `share` decimal(12,2) DEFAULT 0.00 COMMENT 'percentage of accum_contrib',
  `tot_share_contrib` decimal(12,2) DEFAULT 0.00,
  `other_benefit` decimal(12,2) DEFAULT 0.00 COMMENT 'percentage of other benefit',
  `clmd_sickness` decimal(12,2) DEFAULT 0.00,
  `clmd_dif` decimal(12,2) DEFAULT 0.00,
  `clmd_accident` decimal(12,2) DEFAULT 0.00,
  `clmd_calamity` decimal(12,2) DEFAULT 0.00,
  `total_claim` decimal(12,2) DEFAULT 0.00,
  `claim_all` tinyint(1) DEFAULT 0,
  `users_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL,
  `lri_from_loan_balance` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claim_benefit`
--

INSERT INTO `claim_benefit` (`claimed_benefit_id`, `members_id`, `benefit_type_id`, `claim_date`, `accum_contrib`, `share`, `tot_share_contrib`, `other_benefit`, `clmd_sickness`, `clmd_dif`, `clmd_accident`, `clmd_calamity`, `total_claim`, `claim_all`, `users_id`, `is_deleted`, `entry_date`, `lri_from_loan_balance`) VALUES
(12, '00000001', 10, '2022-02-22', '0.00', '0.00', '0.00', '20.00', '0.00', '0.00', '0.00', '0.00', '1000.00', 0, 1, 0, '2020-05-09', NULL),
(20, '00000001', 7, '2023-02-23', '0.00', '0.00', '0.00', '40.00', '0.00', '0.00', '0.00', '0.00', '4000.00', 0, 1, 0, '2020-05-09', NULL),
(23, '00000001', 1, '2030-02-28', '440.00', '100.00', '440.00', '100.00', '10000.00', '2000.00', '3000.00', '5000.00', '-239730.06', 1, 1, 0, '2020-05-09', '0.00'),
(24, '00000002', 9, '2022-09-30', '0.00', '0.00', '0.00', '40.00', '0.00', '0.00', '0.00', '0.00', '1200.00', 0, 1, 0, '2020-05-09', NULL),
(25, '00000005', 7, '2023-02-23', '0.00', '0.00', '0.00', '40.00', '0.00', '0.00', '0.00', '0.00', '4000.00', 0, 1, 0, '2020-05-15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contributions`
--

CREATE TABLE `contributions` (
  `contributions_id` int(11) NOT NULL,
  `members_id` varchar(11) NOT NULL,
  `total` decimal(12,2) DEFAULT 0.00,
  `balance` decimal(12,2) DEFAULT 0.00,
  `deduction` decimal(12,2) DEFAULT 0.00,
  `orno` varchar(50) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL,
  `date_applied` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `adjusted_amnt` decimal(12,2) DEFAULT 0.00,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contributions`
--

INSERT INTO `contributions` (`contributions_id`, `members_id`, `total`, `balance`, `deduction`, `orno`, `is_deleted`, `entry_date`, `date_applied`, `status`, `adjusted_amnt`, `remarks`) VALUES
(1, '00000001', '0.00', '0.00', '250.00', '0023948', 0, '2020-05-05', '2020-05-20', 'CASUAL', '0.00', NULL),
(3, '00000001', '0.00', '0.00', '190.00', '292938', 0, '2020-05-05', '2020-05-28', 'REGULAR', '0.00', NULL),
(20, '00000001', '0.00', '0.00', '1802.64', '11223344', 0, '2020-05-29', '2020-06-16', 'REGULAR', '0.00', NULL),
(21, '00000002', '0.00', '0.00', '1064.96', '11223344', 0, '2020-05-29', '2020-06-16', 'REGULAR', '0.00', NULL),
(22, '00000003', '0.00', '0.00', '600.00', '11223344', 0, '2020-05-29', '2020-06-16', 'REGULAR', '0.00', NULL),
(23, '00000004', '0.00', '0.00', '600.00', '11223344', 0, '2020-05-29', '2020-06-16', 'REGULAR', '0.00', NULL),
(24, '00000003', '0.00', '0.00', '600.00', '112233', 0, '2020-05-31', '2020-07-22', 'REGULAR', '0.00', NULL),
(25, '00000001', '0.00', '0.00', '1802.64', NULL, 0, '2020-05-31', '2020-08-01', 'CASUAL', '0.00', NULL),
(26, '00000002', '0.00', '0.00', '1064.96', NULL, 0, '2020-05-31', '2020-08-01', 'CASUAL', '0.00', NULL),
(27, '00000004', '0.00', '0.00', '600.00', NULL, 0, '2020-05-31', '2020-08-01', 'CASUAL', '0.00', NULL),
(28, '00000001', '0.00', '0.00', '1802.64', NULL, 0, '2020-05-31', '2020-09-23', 'REGULAR', '0.00', NULL),
(29, '00000002', '0.00', '0.00', '1064.96', NULL, 0, '2020-05-31', '2020-09-23', 'REGULAR', '0.00', NULL),
(30, '00000004', '0.00', '0.00', '600.00', NULL, 0, '2020-05-31', '2020-09-23', 'REGULAR', '0.00', NULL),
(31, '00000003', '0.00', '0.00', '600.00', NULL, 0, '2020-06-01', '2020-10-22', 'CASUAL', '0.00', 'TEST REMARKS'),
(32, '00000001', '0.00', '0.00', '1802.64', '0283746482', 0, '2020-06-01', '2020-11-25', 'REGULAR', '2000.00', 'test remark2'),
(33, '00000002', '0.00', '0.00', '1064.96', '0283746482', 0, '2020-06-01', '2020-11-25', 'REGULAR', '0.00', 'test remark2'),
(34, '00000004', '0.00', '0.00', '600.00', '0283746482', 0, '2020-06-01', '2020-11-25', 'REGULAR', '0.00', 'test remark2');

-- --------------------------------------------------------

--
-- Table structure for table `contribution_rate`
--

CREATE TABLE `contribution_rate` (
  `contribution_rate_id` int(11) NOT NULL,
  `rate` decimal(12,2) DEFAULT 0.00,
  `entry_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `cash_gift` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contribution_rate`
--

INSERT INTO `contribution_rate` (`contribution_rate_id`, `rate`, `entry_date`, `is_deleted`, `cash_gift`) VALUES
(1, '2.00', '2020-05-20', 0, '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `co_maker`
--

CREATE TABLE `co_maker` (
  `co_maker_id` int(11) NOT NULL,
  `members_id` varchar(11) DEFAULT NULL,
  `co_maker_members_id` varchar(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `co_maker`
--

INSERT INTO `co_maker` (`co_maker_id`, `members_id`, `co_maker_members_id`, `first_name`, `is_deleted`, `entry_date`, `last_name`) VALUES
(20, '00000002', '00000004', NULL, 0, '2020-04-23', NULL),
(25, '00000001', '00000003', NULL, 0, '2020-05-02', NULL),
(26, '00000005', '00000001', NULL, 0, '2020-05-10', NULL),
(27, '00000005', '00000002', NULL, 0, '2020-05-10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `departments_id` int(11) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `short` varchar(50) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL,
  `cash_gift_rate` decimal(12,2) DEFAULT 0.00,
  `contribution_rate` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`departments_id`, `region`, `short`, `place`, `is_deleted`, `entry_date`, `cash_gift_rate`, `contribution_rate`) VALUES
(1, 'CIVIL REGISTRATION & CENTRAL SUPPORT OFFICE', 'CRCSOSSS', 'CENTRAL OFFICE', 0, '2020-08-17', '2.00', '3.00'),
(2, 'FINANCE AND ADMINISTRATIVE SERVICE', 'FAS', 'CENTRAL OFFICE', 0, '2020-06-05', '10.00', '2.00'),
(3, 'INFORMATION TECHNOLOGY AND DISSEMINATION SERVICE', 'ITDS', 'CENTRAL OFFICE', 0, '2020-06-05', '7.00', '4.00'),
(4, 'INDUSTRY & TRADE STATISTICS DEPARTMENT', 'ITSD', 'CENTRAL OFFICE', 0, '2020-06-05', '2.00', '9.00'),
(5, 'SOCIAL SECTOR STATISTICS SERVICE', 'SSSS', 'CENTRAL OFFICE', 0, '2020-06-05', '15.00', '7.00'),
(6, 'CIVIL REGISTRATION SERVICE', 'CRS', 'CENTRAL OFFICE', 0, '2020-06-05', '7.00', '4.00'),
(7, 'REGION I', 'REGION I', 'REGION OFFICE', 0, '2020-06-05', '7.00', '9.00'),
(8, 'REGION II', 'REGION II', 'REGION OFFICE', 0, '2020-06-05', '5.00', '6.00'),
(9, 'test', 'test', 'REGION OFFICE', 0, '2020-08-17', '2.00', '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `identifiers`
--

CREATE TABLE `identifiers` (
  `identifiers_id` int(11) NOT NULL,
  `members_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `identifiers`
--

INSERT INTO `identifiers` (`identifiers_id`, `members_id`) VALUES
(1, '00000007');

-- --------------------------------------------------------

--
-- Table structure for table `immediate_family`
--

CREATE TABLE `immediate_family` (
  `immediate_family_id` int(11) NOT NULL,
  `relationship_type_id` int(11) NOT NULL,
  `members_id` varchar(11) NOT NULL,
  `name` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `immediate_family`
--

INSERT INTO `immediate_family` (`immediate_family_id`, `relationship_type_id`, `members_id`, `name`, `is_deleted`, `entry_date`) VALUES
(1, 3, '00000002', 'Teresitas', 0, '2020-04-26'),
(2, 2, '00000002', 'ANTONIO', 1, '2020-04-26'),
(3, 2, '00000002', 'ANTONIO', 0, '2020-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `j_details`
--

CREATE TABLE `j_details` (
  `j_details_id` bigint(20) NOT NULL,
  `j_master_id` bigint(20) NOT NULL,
  `acct_code` varchar(50) NOT NULL,
  `subsidiary` varchar(50) DEFAULT NULL,
  `debit` decimal(12,2) DEFAULT 0.00,
  `credit` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `j_details`
--

INSERT INTO `j_details` (`j_details_id`, `j_master_id`, `acct_code`, `subsidiary`, `debit`, `credit`) VALUES
(97, 27, '101', NULL, '20000.00', '0.00'),
(98, 27, '209', NULL, '0.00', '20000.00'),
(99, 28, '103', NULL, '12500.00', '0.00'),
(100, 28, '209', NULL, '0.00', '12500.00'),
(101, 29, '102', NULL, '12000000.00', '0.00'),
(102, 29, '105', NULL, '0.00', '12000000.00'),
(103, 30, '103', NULL, '200000.00', '0.00'),
(104, 30, '111', NULL, '0.00', '200000.00'),
(105, 31, '200', NULL, '20000.00', '0.00'),
(106, 31, '114', '823', '0.00', '20000.00'),
(107, 32, '101', NULL, '20000.00', '0.00'),
(108, 32, '108', NULL, '0.00', '20000.00'),
(109, 33, '103', NULL, '30000.00', '0.00'),
(110, 33, '108', NULL, '0.00', '30000.00'),
(111, 34, '102', NULL, '20000.00', '0.00'),
(112, 34, '108', NULL, '0.00', '20000.00'),
(113, 35, '200', NULL, '20000.00', '0.00'),
(114, 35, '108', NULL, '0.00', '20000.00'),
(115, 36, '103', NULL, '100000.00', '0.00'),
(116, 36, '108', NULL, '0.00', '100000.00'),
(117, 37, '200', NULL, '200000.00', '0.00'),
(118, 37, '108', NULL, '0.00', '200000.00');

-- --------------------------------------------------------

--
-- Table structure for table `j_master`
--

CREATE TABLE `j_master` (
  `j_master_id` bigint(20) NOT NULL,
  `j_type_id` int(11) NOT NULL,
  `account_no` varchar(50) DEFAULT NULL,
  `journal_ref` varchar(50) DEFAULT NULL,
  `check_voucher_no` varchar(50) DEFAULT NULL,
  `check_no` varchar(50) DEFAULT NULL,
  `reference_no` varchar(50) DEFAULT NULL,
  `payee_type` tinyint(1) DEFAULT NULL COMMENT '1=member, 2=others',
  `payee_members_id` varchar(11) DEFAULT NULL COMMENT 'to get id number and name of a member',
  `payee` varchar(255) DEFAULT NULL,
  `particulars` longtext DEFAULT NULL,
  `loan_computation_id` int(11) DEFAULT NULL,
  `date_posted` date DEFAULT NULL COMMENT 'if null = not posted else posted',
  `journal_date` date DEFAULT NULL,
  `credits_cash_in_bank` decimal(12,2) DEFAULT 0.00,
  `credits_unearned_income` decimal(12,2) DEFAULT 0.00,
  `credits_interest_income` decimal(12,2) DEFAULT 0.00,
  `credits_deferred_credits` decimal(12,2) DEFAULT 0.00,
  `credits_lri` decimal(12,2) DEFAULT 0.00,
  `credits_loan_receivable` decimal(12,2) DEFAULT 0.00,
  `credits_interest` decimal(12,2) DEFAULT 0.00,
  `credits_service_charge` decimal(12,2) DEFAULT 0.00,
  `debits_loan_receivable` decimal(12,2) DEFAULT 0.00,
  `debits_interest_receivable` decimal(12,2) DEFAULT 0.00,
  `debits_deferred_credits` decimal(12,2) DEFAULT 0.00,
  `debits_benefit_claim` decimal(12,2) DEFAULT 0.00,
  `debits_members_contr` decimal(12,2) DEFAULT 0.00,
  `users_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `j_master`
--

INSERT INTO `j_master` (`j_master_id`, `j_type_id`, `account_no`, `journal_ref`, `check_voucher_no`, `check_no`, `reference_no`, `payee_type`, `payee_members_id`, `payee`, `particulars`, `loan_computation_id`, `date_posted`, `journal_date`, `credits_cash_in_bank`, `credits_unearned_income`, `credits_interest_income`, `credits_deferred_credits`, `credits_lri`, `credits_loan_receivable`, `credits_interest`, `credits_service_charge`, `debits_loan_receivable`, `debits_interest_receivable`, `debits_deferred_credits`, `debits_benefit_claim`, `debits_members_contr`, `users_id`, `is_deleted`, `entry_date`) VALUES
(27, 6, '00292385', 'CRJ-00000006', '00000006', NULL, 'FMP-029234', 2, NULL, 'TEST2', 'PLDT PAYMENT', NULL, '2020-05-31', '2020-05-31', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, '2020-05-20'),
(28, 5, NULL, 'GJ-00000005', NULL, NULL, '0029292', 2, NULL, 'PLDT', 'PAYMENT FOR PLDT', NULL, '2020-05-26', '2020-05-13', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, '2020-05-21'),
(29, 5, NULL, 'GJ-00000006', NULL, NULL, '092288', 2, NULL, 'BACOLOD BRANCH', 'FUNDS TRANSFER', NULL, '2020-05-26', '2020-05-26', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, '2020-05-21'),
(30, 5, NULL, 'GJ-00000007', NULL, NULL, '029228227', 1, '00000001', NULL, 'cash advance for members  DONDON', NULL, '2020-05-27', '2020-05-31', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, '2020-05-21'),
(31, 6, '023231512', 'CRJ-00000007', '00000007', NULL, '231323', 1, '00000003', NULL, 'TEST PAYMENT', NULL, '2020-05-31', '2020-05-27', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, '2020-05-22'),
(32, 3, NULL, 'CDJ-00000009', '00000009', '00292381', 'EMP-203939', 1, '00000005', NULL, 'SAMPLE RELEASES', NULL, '2020-05-31', '2020-05-31', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, '2020-05-22'),
(33, 3, NULL, 'CDJ-00000010', '00000010', '9384520', 'MEP-0220220', 1, '00000005', NULL, 'SAMPLE RELEASES 2', NULL, '2020-05-31', '2020-05-26', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, '2020-05-22'),
(34, 3, NULL, 'CDJ-00000011', '00000011', '292929282', 'MPEl-2029239', 1, '00000006', NULL, 'EMPLOYEE RELEASES', NULL, '2020-05-29', '2020-07-16', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, '2020-05-22'),
(35, 4, '00292882', 'PACS-00000004', NULL, NULL, '001', 1, '00000003', NULL, 'RELEASES', NULL, '2020-05-19', '2020-05-31', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, '2020-05-22'),
(36, 4, '029288342', 'PACS-00000005', NULL, NULL, '002', 1, '00000004', NULL, 'RELEASES AGAIN', NULL, '2020-05-11', '2020-07-16', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, '2020-05-22'),
(37, 4, '020942910', 'PACS-00000006', NULL, NULL, '003', 1, '00000001', NULL, 'RELEASES AGAIN', NULL, '2020-05-19', '2020-07-29', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, '2020-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `j_type`
--

CREATE TABLE `j_type` (
  `j_type_id` int(11) NOT NULL,
  `type` text DEFAULT NULL,
  `ref` varchar(25) DEFAULT NULL,
  `key_word` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `j_type`
--

INSERT INTO `j_type` (`j_type_id`, `type`, `ref`, `key_word`, `is_deleted`, `entry_date`) VALUES
(1, 'CV', '00000000', 'CHECK VOUCHER', 0, '2020-03-04'),
(2, 'JV', '00000000', 'JOURNAL VOUCHER', 0, '2020-03-04'),
(3, 'CDJ', '00000012', 'CHECK DISBURSEMENT JOURNAL', 0, '2020-03-04'),
(4, 'PACS', '00000007', 'PAYROLL ACCOUNT CREDIT SYSTEM', 0, '2020-03-04'),
(5, 'GJ', '00000008', 'GENERAL JOURNAL', 0, '2020-05-20'),
(6, 'CRJ', '00000008', 'CASH RECEIPT JOURNAL', 0, '2020-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `level_permission`
--

CREATE TABLE `level_permission` (
  `level_permission_id` int(11) NOT NULL,
  `level` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level_permission`
--

INSERT INTO `level_permission` (`level_permission_id`, `level`, `type`, `entry_date`, `is_deleted`) VALUES
(1, '1', 'Administrator', '2020-04-07', 0),
(2, '2', 'User -Loans', '2020-04-07', 0),
(3, '3', 'User - Collections', '2020-04-07', 0),
(4, '4', 'User - Benefits', '2020-04-07', 0),
(5, '5', 'Guest', '2020-04-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_code`
--

CREATE TABLE `loan_code` (
  `loan_code_id` int(11) NOT NULL,
  `loan_code` text DEFAULT NULL,
  `loan_type_name` text DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_code`
--

INSERT INTO `loan_code` (`loan_code_id`, `loan_code`, `loan_type_name`, `entry_date`, `is_deleted`) VALUES
(1, 'EMLN', 'Emegency Loan', '2020-04-07', 0),
(2, 'GPLN', 'GPLN', '2020-04-07', 0),
(3, 'SLMV', 'SLMV', '2020-04-07', 0),
(4, 'XML2', 'CROSS-SIDE SCRIPT2', '2020-04-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan_computation`
--

CREATE TABLE `loan_computation` (
  `loan_computation_id` int(11) NOT NULL,
  `members_id` varchar(11) NOT NULL,
  `loan_settings_id` int(11) NOT NULL,
  `loan_release_mode` text DEFAULT NULL COMMENT 'check or atm',
  `purpose_of_loan` text DEFAULT NULL,
  `net_take_home_pay` decimal(12,2) DEFAULT 0.00,
  `is_approved` tinyint(1) DEFAULT 0,
  `ref_no` text DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `amnt_of_loan` decimal(12,2) DEFAULT 0.00,
  `add_interest` decimal(12,2) DEFAULT 0.00,
  `gross_amnt` decimal(12,2) DEFAULT 0.00,
  `first_yr_int_ded` decimal(12,2) DEFAULT 0.00,
  `total_amnt_to_be_amort` decimal(12,2) DEFAULT 0.00,
  `monthly_amortization` decimal(12,2) DEFAULT 0.00,
  `ded_interest` decimal(12,2) DEFAULT 0.00,
  `lri_comp` decimal(12,2) DEFAULT 0.00,
  `svc_comp` decimal(12,2) DEFAULT 0.00,
  `total_deductions` decimal(12,2) DEFAULT 0.00,
  `net_proceeds` decimal(12,2) DEFAULT 0.00,
  `col_period_start` text DEFAULT NULL,
  `col_period_end` text DEFAULT NULL,
  `breakdown_ma_principal` decimal(12,2) DEFAULT 0.00 COMMENT 'bdown monthly amort',
  `breakdown_ma_interest` decimal(12,2) DEFAULT 0.00 COMMENT 'bdown monthly amort',
  `breakdown_ma_total` decimal(12,2) DEFAULT 0.00 COMMENT 'bdown monthly amort',
  `breakdown_lb_principal` decimal(12,2) DEFAULT 0.00 COMMENT 'bdown loan bal',
  `breakdown_lb_interest` decimal(12,2) DEFAULT 0.00 COMMENT 'bdown loan bal',
  `breakdown_lb_total` decimal(12,2) DEFAULT 0.00 COMMENT 'bdown loan bal',
  `date_processed` date DEFAULT NULL,
  `posted_date` date DEFAULT NULL,
  `balance` decimal(12,2) DEFAULT 0.00,
  `current_orno` text DEFAULT NULL,
  `prev_loan_computation_id` int(11) DEFAULT NULL,
  `is_posted` tinyint(1) DEFAULT 0,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_computation`
--

INSERT INTO `loan_computation` (`loan_computation_id`, `members_id`, `loan_settings_id`, `loan_release_mode`, `purpose_of_loan`, `net_take_home_pay`, `is_approved`, `ref_no`, `remarks`, `amnt_of_loan`, `add_interest`, `gross_amnt`, `first_yr_int_ded`, `total_amnt_to_be_amort`, `monthly_amortization`, `ded_interest`, `lri_comp`, `svc_comp`, `total_deductions`, `net_proceeds`, `col_period_start`, `col_period_end`, `breakdown_ma_principal`, `breakdown_ma_interest`, `breakdown_ma_total`, `breakdown_lb_principal`, `breakdown_lb_interest`, `breakdown_lb_total`, `date_processed`, `posted_date`, `balance`, `current_orno`, `prev_loan_computation_id`, `is_posted`, `is_deleted`, `entry_date`, `users_id`) VALUES
(39, '00000001', 7, 'atm', '', '0.00', 1, '001', 'FOR FUNDS', '75000.00', '22500.00', '97500.00', '7500.00', '98350.00', '2731.95', '0.00', '750.00', '100.00', '0.00', '75000.00', '2020-06', '2023-05', '2101.50', '630.45', '2731.95', '0.00', '0.00', '0.00', '2020-05-27', NULL, '0.00', '', NULL, 1, 0, '2020-05-21', 1),
(40, '00000001', 7, 'atm', '', '0.00', 1, '002', 'FUNDS ONLY', '90132.00', '27039.60', '117171.60', '9013.20', '118172.92', '3282.59', '0.00', '901.32', '100.00', '87422.40', '2709.60', '2020-06', '2023-05', '2525.07', '757.52', '3282.59', '0.00', '0.00', '0.00', '2020-05-27', NULL, '0.00', '0101010', 39, 1, 0, '2020-05-21', 1),
(41, '00000003', 7, 'atm', '', '0.00', 1, '003', 'FOR FUNDS', '75000.00', '22500.00', '97500.00', '7500.00', '98350.00', '2731.95', '0.00', '750.00', '100.00', '0.00', '75000.00', '2020-06', '2023-05', '2101.50', '630.45', '2731.95', '0.00', '0.00', '0.00', '2020-05-27', NULL, '0.00', '', NULL, 1, 0, '2020-05-21', 1),
(42, '00000003', 7, 'atm', '', '0.00', 1, '004', 'FOR FUNDS AGAIN', '75000.00', '22500.00', '97500.00', '7500.00', '98350.00', '2731.95', '0.00', '750.00', '100.00', '98350.00', '-23350.00', '2020-07', '2023-06', '2101.50', '630.45', '2731.95', '0.00', '0.00', '0.00', '2020-06-03', NULL, '0.00', '', 41, 0, 0, '2020-05-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan_receipt`
--

CREATE TABLE `loan_receipt` (
  `loan_receipt_id` int(11) NOT NULL,
  `loan_schedule_id` int(11) NOT NULL,
  `orno` varchar(25) DEFAULT NULL,
  `amnt_paid` decimal(12,2) DEFAULT 0.00,
  `interest_paid` decimal(12,2) DEFAULT 0.00,
  `date_paid` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_receipt`
--

INSERT INTO `loan_receipt` (`loan_receipt_id`, `loan_schedule_id`, `orno`, `amnt_paid`, `interest_paid`, `date_paid`, `is_deleted`, `entry_date`) VALUES
(39, 679, '0101010', '2731.95', '630.45', '2020-05-27', 0, NULL),
(40, 680, '0101010', '2731.95', '630.45', '2020-05-27', 0, NULL),
(41, 681, '0101010', '2731.95', '630.45', '2020-05-27', 0, NULL),
(42, 682, '0101010', '2731.95', '630.45', '2020-05-27', 0, NULL),
(44, 715, '11', '2100.00', '630.00', '2020-06-17', 0, NULL),
(45, 716, '22', '2525.07', '757.52', '2020-07-23', 0, NULL),
(46, 717, '33', '2525.07', '757.52', '2020-08-19', 0, NULL),
(47, 718, '44', '2525.07', '757.52', '2020-09-23', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_receipt_temp`
--

CREATE TABLE `loan_receipt_temp` (
  `loan_receipt_temp_id` int(11) NOT NULL,
  `loan_schedule_id` int(11) DEFAULT NULL,
  `orno` varchar(25) NOT NULL,
  `amnt_paid` decimal(12,2) DEFAULT 0.00,
  `interest_paid` decimal(12,2) DEFAULT 0.00,
  `date_paid` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loan_schedule`
--

CREATE TABLE `loan_schedule` (
  `loan_schedule_id` int(11) NOT NULL,
  `loan_computation_id` int(11) NOT NULL,
  `payment_schedule` text DEFAULT NULL,
  `monthly_amortization` decimal(12,2) DEFAULT 0.00,
  `principal` decimal(12,2) DEFAULT 0.00,
  `monthly_interest` decimal(12,2) DEFAULT 0.00,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_schedule`
--

INSERT INTO `loan_schedule` (`loan_schedule_id`, `loan_computation_id`, `payment_schedule`, `monthly_amortization`, `principal`, `monthly_interest`, `is_deleted`, `entry_date`) VALUES
(679, 39, '2020-06', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(680, 39, '2020-07', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(681, 39, '2020-08', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(682, 39, '2020-09', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(683, 39, '2020-10', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(684, 39, '2020-11', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(685, 39, '2020-12', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(686, 39, '2021-01', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(687, 39, '2021-02', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(688, 39, '2021-03', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(689, 39, '2021-04', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(690, 39, '2021-05', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(691, 39, '2021-06', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(692, 39, '2021-07', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(693, 39, '2021-08', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(694, 39, '2021-09', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(695, 39, '2021-10', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(696, 39, '2021-11', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(697, 39, '2021-12', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(698, 39, '2022-01', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(699, 39, '2022-02', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(700, 39, '2022-03', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(701, 39, '2022-04', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(702, 39, '2022-05', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(703, 39, '2022-06', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(704, 39, '2022-07', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(705, 39, '2022-08', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(706, 39, '2022-09', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(707, 39, '2022-10', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(708, 39, '2022-11', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(709, 39, '2022-12', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(710, 39, '2023-01', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(711, 39, '2023-02', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(712, 39, '2023-03', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(713, 39, '2023-04', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(714, 39, '2023-05', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(715, 40, '2020-06', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(716, 40, '2020-07', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(717, 40, '2020-08', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(718, 40, '2020-09', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(719, 40, '2020-10', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(720, 40, '2020-11', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(721, 40, '2020-12', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(722, 40, '2021-01', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(723, 40, '2021-02', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(724, 40, '2021-03', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(725, 40, '2021-04', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(726, 40, '2021-05', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(727, 40, '2021-06', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(728, 40, '2021-07', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(729, 40, '2021-08', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(730, 40, '2021-09', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(731, 40, '2021-10', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(732, 40, '2021-11', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(733, 40, '2021-12', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(734, 40, '2022-01', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(735, 40, '2022-02', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(736, 40, '2022-03', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(737, 40, '2022-04', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(738, 40, '2022-05', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(739, 40, '2022-06', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(740, 40, '2022-07', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(741, 40, '2022-08', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(742, 40, '2022-09', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(743, 40, '2022-10', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(744, 40, '2022-11', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(745, 40, '2022-12', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(746, 40, '2023-01', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(747, 40, '2023-02', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(748, 40, '2023-03', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(749, 40, '2023-04', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(750, 40, '2023-05', '3282.59', '2525.07', '757.52', 0, '2020-05-21'),
(751, 41, '2020-06', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(752, 41, '2020-07', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(753, 41, '2020-08', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(754, 41, '2020-09', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(755, 41, '2020-10', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(756, 41, '2020-11', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(757, 41, '2020-12', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(758, 41, '2021-01', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(759, 41, '2021-02', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(760, 41, '2021-03', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(761, 41, '2021-04', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(762, 41, '2021-05', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(763, 41, '2021-06', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(764, 41, '2021-07', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(765, 41, '2021-08', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(766, 41, '2021-09', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(767, 41, '2021-10', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(768, 41, '2021-11', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(769, 41, '2021-12', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(770, 41, '2022-01', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(771, 41, '2022-02', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(772, 41, '2022-03', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(773, 41, '2022-04', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(774, 41, '2022-05', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(775, 41, '2022-06', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(776, 41, '2022-07', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(777, 41, '2022-08', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(778, 41, '2022-09', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(779, 41, '2022-10', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(780, 41, '2022-11', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(781, 41, '2022-12', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(782, 41, '2023-01', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(783, 41, '2023-02', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(784, 41, '2023-03', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(785, 41, '2023-04', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(786, 41, '2023-05', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(787, 42, '2020-07', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(788, 42, '2020-08', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(789, 42, '2020-09', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(790, 42, '2020-10', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(791, 42, '2020-11', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(792, 42, '2020-12', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(793, 42, '2021-01', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(794, 42, '2021-02', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(795, 42, '2021-03', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(796, 42, '2021-04', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(797, 42, '2021-05', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(798, 42, '2021-06', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(799, 42, '2021-07', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(800, 42, '2021-08', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(801, 42, '2021-09', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(802, 42, '2021-10', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(803, 42, '2021-11', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(804, 42, '2021-12', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(805, 42, '2022-01', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(806, 42, '2022-02', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(807, 42, '2022-03', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(808, 42, '2022-04', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(809, 42, '2022-05', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(810, 42, '2022-06', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(811, 42, '2022-07', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(812, 42, '2022-08', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(813, 42, '2022-09', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(814, 42, '2022-10', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(815, 42, '2022-11', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(816, 42, '2022-12', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(817, 42, '2023-01', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(818, 42, '2023-02', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(819, 42, '2023-03', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(820, 42, '2023-04', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(821, 42, '2023-05', '2731.95', '2101.50', '630.45', 0, '2020-05-21'),
(822, 42, '2023-06', '2731.95', '2101.50', '630.45', 0, '2020-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `loan_settings`
--

CREATE TABLE `loan_settings` (
  `loan_settings_id` int(11) NOT NULL,
  `loan_code_id` int(11) NOT NULL,
  `number_of_month` int(11) DEFAULT NULL,
  `int_per_annum` decimal(12,4) DEFAULT 0.0000,
  `lri` decimal(12,4) DEFAULT 0.0000 COMMENT 'insurance',
  `svc` decimal(12,2) DEFAULT 0.00 COMMENT 'service charge',
  `repymnt_period` decimal(12,2) DEFAULT 0.00 COMMENT 'count of years (ex. ½ year = .5, 1 year = 1) ',
  `monthly_interest` decimal(12,2) DEFAULT 0.00,
  `entry_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_settings`
--

INSERT INTO `loan_settings` (`loan_settings_id`, `loan_code_id`, `number_of_month`, `int_per_annum`, `lri`, `svc`, `repymnt_period`, `monthly_interest`, `entry_date`, `is_deleted`) VALUES
(1, 2, 1, '8.0000', '0.5000', '100.00', '1.00', '1.00', '2020-04-11', 0),
(2, 2, 2, '8.0000', '0.7500', '100.00', '1.50', '1.04', '2020-04-10', 0),
(3, 2, 3, '8.0000', '1.0000', '100.00', '2.00', '1.08', '2020-04-10', 0),
(4, 2, 4, '8.0000', '1.2500', '100.00', '2.50', '1.12', '2020-04-10', 0),
(5, 2, 5, '8.0000', '1.5000', '100.00', '3.00', '1.16', '2020-04-10', 0),
(6, 2, 6, '8.0000', '1.7500', '100.00', '3.50', '1.20', '2020-04-10', 0),
(7, 3, 1, '10.0000', '1.0000', '100.00', '3.00', '1.30', '2020-05-20', 0),
(8, 3, 69, '12.0000', '12.0000', '122.00', '2.00', '1.12', '2020-05-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan_types`
--

CREATE TABLE `loan_types` (
  `loan_types_id` int(11) NOT NULL,
  `type` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_types`
--

INSERT INTO `loan_types` (`loan_types_id`, `type`, `is_deleted`, `entry_date`) VALUES
(1, 'Emergency Loan', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `members_id` varchar(11) NOT NULL,
  `last_name` text DEFAULT NULL,
  `first_name` text DEFAULT NULL,
  `middle_name` text DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `id_no` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `civil_status_id` int(11) NOT NULL,
  `monthly_salary` decimal(12,2) DEFAULT 0.00,
  `designation` text DEFAULT NULL,
  `office_management_id` int(11) NOT NULL,
  `date_of_effectivity` date DEFAULT NULL,
  `member_type_id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `bank_account` text DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `retired_date` date DEFAULT NULL,
  `benefit_type` int(11) DEFAULT NULL,
  `salary_grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`members_id`, `last_name`, `first_name`, `middle_name`, `entry_date`, `is_deleted`, `id_no`, `dob`, `address`, `civil_status_id`, `monthly_salary`, `designation`, `office_management_id`, `date_of_effectivity`, `member_type_id`, `users_id`, `bank_account`, `contact_no`, `retired_date`, `benefit_type`, `salary_grade`) VALUES
('00000001', 'baisac', 'andolino', 'gallardo', '2020-06-05', 0, '000934', '1990-11-06', 'Makati', 1, '90132.00', 'Developer', 1, '2018-03-08', 1, 1, 'BPI -09239442', '09773656715', '2030-02-28', 1, NULL),
('00000002', 'dela cruz', 'alvins', 'antonio', '2020-04-12', 0, '000584', '1992-02-03', 'Marikina', 1, '53248.00', 'System Analyst', 1, '2020-02-01', 1, 1, 'BDO - 023494458', '09424924594', NULL, NULL, NULL),
('00000003', 'mora', 'peter', 'billones', '2020-05-31', 0, '002422', '1978-02-02', 'Makati', 1, '30000.00', 'Developer', 5, '2020-03-02', 1, 1, '', '', NULL, NULL, NULL),
('00000004', 'casera', 'queenie', 'paniamogan', '2020-04-10', 0, '0027339', '1995-07-08', 'Matinao', 1, '30000.00', 'Accounting', 1, '2020-04-23', 1, 1, 'BDO - 092938400', '09992304209', NULL, NULL, NULL),
('00000005', 'honteveros', 'dondon', 'G', '2020-05-02', 0, '00293', '1990-11-06', 'Makati Cit', 1, '30000.00', 'Developer', 1, '2020-05-06', 1, 1, 'BDO - 2020304059', '7509934', NULL, NULL, NULL),
('00000006', 'dela cruz', 'juan', '', '2020-05-19', 0, '2123123', '2020-05-06', 'makati', 1, '25000.00', 'Developer', 1, '2020-05-29', 1, 1, 'BDO -20295224', '09238425753', NULL, NULL, NULL),
('00000007', 'as32', 'dasdas32', 'asdas', '2020-08-15', 0, '12312332', '2020-08-27', 'asdas32', 2, '0.00', 'asdasd', 6, '2020-08-18', 1, 1, '1231231232', '123123123', NULL, NULL, 1212232);

--
-- Triggers `members`
--
DELIMITER $$
CREATE TRIGGER `after_members_insert` AFTER INSERT ON `members` FOR EACH ROW update identifiers set members_id = new.members_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `member_type`
--

CREATE TABLE `member_type` (
  `member_type_id` int(11) NOT NULL,
  `type` text DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_type`
--

INSERT INTO `member_type` (`member_type_id`, `type`, `entry_date`, `is_deleted`) VALUES
(1, 'Active', '2020-04-25', 0),
(2, 'Deactive', '2020-04-25', 1),
(3, 'Deactives', '2020-04-25', 1),
(4, 'Active', '2020-04-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `office_management`
--

CREATE TABLE `office_management` (
  `office_management_id` int(11) NOT NULL,
  `office_code` text DEFAULT NULL,
  `office_name` text DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `departments_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `office_management`
--

INSERT INTO `office_management` (`office_management_id`, `office_code`, `office_name`, `entry_date`, `is_deleted`, `departments_id`) VALUES
(1, '010000', 'OFFICE OF THE DEPUTY NATIONAL STATISTICIANS', '2020-05-04', 0, 1),
(5, '010100', 'OFFICE OF THE ASSISTANT NATIONAL STATISTICIAN', '2020-05-04', 0, 2),
(6, '010105', 'ACCOUNTING DIVISION', '2020-05-04', 0, 2),
(7, '1111', '11123', '2020-05-12', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `official_receipt`
--

CREATE TABLE `official_receipt` (
  `official_receipt_id` int(11) NOT NULL,
  `departments_id` int(11) DEFAULT NULL,
  `amount_type` int(1) DEFAULT 0 COMMENT '1 = Cash, 2 = Check, 3 = Bank',
  `orno` varchar(255) DEFAULT NULL,
  `check_no` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tin` varchar(255) DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT 0.00,
  `senior_citizen_tin` varchar(255) DEFAULT NULL,
  `osca_pwd_citizen_tin` varchar(255) DEFAULT NULL,
  `contribution` decimal(12,2) DEFAULT 0.00,
  `gpln` decimal(12,2) DEFAULT 0.00,
  `emln` decimal(12,2) DEFAULT 0.00,
  `slmv` decimal(12,2) DEFAULT 0.00,
  `others` decimal(12,2) DEFAULT 0.00,
  `remarks` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `date_applied` date DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `received_by` varchar(255) DEFAULT NULL,
  `business_style` varchar(255) DEFAULT NULL,
  `sc_pw_discount` decimal(12,2) DEFAULT 0.00,
  `total_due` decimal(12,2) DEFAULT 0.00,
  `withholding_tax` decimal(12,2) DEFAULT 0.00,
  `payment_due` decimal(12,2) DEFAULT 0.00,
  `total` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `official_receipt`
--

INSERT INTO `official_receipt` (`official_receipt_id`, `departments_id`, `amount_type`, `orno`, `check_no`, `address`, `tin`, `amount`, `senior_citizen_tin`, `osca_pwd_citizen_tin`, `contribution`, `gpln`, `emln`, `slmv`, `others`, `remarks`, `is_deleted`, `date_applied`, `entry_date`, `status`, `received_by`, `business_style`, `sc_pw_discount`, `total_due`, `withholding_tax`, `payment_due`, `total`) VALUES
(15, 1, 1, '112233', NULL, '127 Caimito St. Blk 5 West Rembo Makati City', NULL, '0.00', '33', '44', '3467.60', '100.00', '200.00', '300.00', '400.00', 'TEST', 1, '2020-07-01', '2020-06-10', NULL, NULL, '22', '400.00', '4067.60', '67.60', '1000.00', '5000.40'),
(16, 1, 1, '11223344', NULL, '', NULL, '0.00', '23123123', '124124', '3467.60', '400.00', '200.00', '120.00', '50.00', 'TEST', 0, '2020-06-10', '2020-06-10', NULL, NULL, 'TEST', '37.00', '4200.60', '1200.00', '3000.00', '6000.60');

-- --------------------------------------------------------

--
-- Table structure for table `relationship_type`
--

CREATE TABLE `relationship_type` (
  `relationship_type_id` int(11) NOT NULL,
  `rel_type` text DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `relationship_type`
--

INSERT INTO `relationship_type` (`relationship_type_id`, `rel_type`, `entry_date`, `is_deleted`) VALUES
(1, 'Daughter', '2020-04-07', 0),
(2, 'Son', '2020-04-07', 0),
(3, 'Spouse', '2020-04-07', 0),
(4, 'Ampon', '2020-04-25', 1),
(5, 'Ampon', '2020-04-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `signatory`
--

CREATE TABLE `signatory` (
  `signatory_id` int(11) NOT NULL,
  `signatory_name` text DEFAULT NULL,
  `designation` text DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signatory`
--

INSERT INTO `signatory` (`signatory_id`, `signatory_name`, `designation`, `entry_date`, `is_deleted`) VALUES
(1, 'Apolinario Mabini', 'Admin', '2020-04-25', 0),
(4, 'test', 'test', '2020-04-25', 1),
(6, 'Apolinario', 'test', '2020-04-25', 1),
(7, 'TEST 1S', 'TEST 2', '2020-04-25', 1),
(8, '', '', '2020-04-25', 1);

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
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `log_meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `target_child_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `physical` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT 0,
  `warranty_months` int(11) DEFAULT NULL,
  `depreciate` tinyint(1) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `requestable` tinyint(4) NOT NULL DEFAULT 0,
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
  `checkin_counter` int(11) NOT NULL DEFAULT 0,
  `checkout_counter` int(11) NOT NULL DEFAULT 0,
  `requests_counter` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) DEFAULT 0,
  `checkout_user_id` int(2) DEFAULT NULL,
  `office_management_id` int(11) DEFAULT NULL,
  `departments_id` int(11) DEFAULT NULL,
  `sibling` int(11) DEFAULT NULL,
  `asset_category_id` int(11) DEFAULT NULL,
  `property_tag` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_asset`
--

INSERT INTO `tbl_asset` (`id`, `name`, `asset_tag`, `model_id`, `serial`, `purchase_date`, `purchase_cost`, `order_number`, `assigned_to`, `notes`, `image`, `user_id`, `created_at`, `updated_at`, `physical`, `deleted_at`, `status_id`, `archived`, `warranty_months`, `depreciate`, `supplier_id`, `requestable`, `rtd_location_id`, `_snipeit_mac_address_1`, `accepted`, `last_checkout`, `expected_checkin`, `company_id`, `assigned_type`, `last_audit_date`, `next_audit_date`, `location_id`, `checkin_counter`, `checkout_counter`, `requests_counter`, `is_deleted`, `checkout_user_id`, `office_management_id`, `departments_id`, `sibling`, `asset_category_id`, `property_tag`) VALUES
(29, 'AORUS RTX Geforce 2080 Super Gaming', 'RTX 2080', 8, '5256124', '2020-09-24', '24500.00', '26124124', NULL, 'TEST', NULL, 1, '2020-09-27 16:00:00', NULL, 1, NULL, 1, 0, 24, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 21, NULL, NULL, NULL, 4, 0, 0, 0, 1, 8, 5, 1, NULL, NULL, NULL),
(30, 'MSI Tomahawk Max B450 ATX', 'Motherboard', 5, '562WTWT', '2020-09-09', '24500.00', '0125646874', NULL, 'TEST', NULL, 1, '2020-09-27 16:00:00', '2020-10-21 16:00:00', 1, NULL, 1, 0, 24, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, 20, NULL, NULL, NULL, 2, 0, 0, 0, 0, 8, 1, 4, 34, 1, NULL),
(31, 'AORUS RTX Geforce 2080 Super Gaming', 'MOBO 2080', NULL, '6125125', '2020-09-11', '25000.00', '516124124', NULL, 'test', NULL, 1, '2020-09-29 16:00:00', NULL, 1, NULL, 1, 0, 48, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, 23, NULL, NULL, NULL, 0, 0, 0, 0, 1, 6, 1, 1, NULL, NULL, NULL),
(32, 'CORSAIR RAM 3200', 'Corsair RAM 16GB', NULL, '5611WTWY', '2020-10-21', '25000.00', '26124124', NULL, 'TEST', NULL, 1, '2020-10-02 16:00:00', NULL, 1, NULL, 1, 0, 25, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, 20, NULL, NULL, NULL, 2, 0, 0, 0, 0, 6, 1, 2, NULL, NULL, NULL),
(33, 'AORUS RTX Geforce 2080 Super Gaming', 'GPU 100', NULL, '116121251', '2020-07-22', '24500.00', '005925924', NULL, 'TEST', NULL, 1, '2020-10-20 16:00:00', '2020-10-24 16:00:00', 1, NULL, 1, 0, 24, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, 20, NULL, NULL, NULL, 2, 0, 0, 0, 0, 1, 1, 1, NULL, 1, '0022093'),
(34, 'MSI Tomahawk Max B450 ATX', '0066687', NULL, '515124124', '2020-11-06', '24000.00', '0056897', NULL, 'TEST', NULL, 1, '2020-10-21 16:00:00', NULL, 1, NULL, 1, 0, 48, NULL, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 8, 1, 2, 30, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_asset_repair_request`
--

CREATE TABLE `tbl_asset_repair_request` (
  `id` int(11) NOT NULL,
  `asset_category_id` int(11) DEFAULT NULL,
  `serial` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_tag` text DEFAULT NULL,
  `property_tag` text DEFAULT NULL,
  `tbl_child_asset_id` text DEFAULT NULL,
  `regkits_no` text DEFAULT NULL,
  `custodian` int(11) DEFAULT NULL,
  `date_reported` datetime DEFAULT NULL,
  `problem_desc` text DEFAULT NULL,
  `file_upload` text DEFAULT NULL,
  `image_upload` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `approved_by` int(11) DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `disapproved_by` int(11) DEFAULT NULL,
  `disapproved_date` datetime DEFAULT NULL,
  `requestor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_asset_repair_request`
--

INSERT INTO `tbl_asset_repair_request` (`id`, `asset_category_id`, `serial`, `asset_tag`, `property_tag`, `tbl_child_asset_id`, `regkits_no`, `custodian`, `date_reported`, `problem_desc`, `file_upload`, `image_upload`, `remarks`, `is_deleted`, `entry_date`, `status`, `approved_by`, `approved_date`, `disapproved_by`, `disapproved_date`, `requestor`) VALUES
(6, 1, '562WTWT', 'Motherboard', '', '9,11', NULL, NULL, '2020-10-01 00:00:00', 'TEST1', 'Asset-Bug-and-Revision-in-Crud7.docx', 'Screen_Shot_2020-10-25_at_6.06.20_PM6.png', 'TEST2', 0, '2020-10-25 13:48:44', 3, NULL, NULL, NULL, NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_asset_request`
--

CREATE TABLE `tbl_asset_request` (
  `tbl_asset_request_id` int(11) NOT NULL,
  `office_management_id` int(11) DEFAULT NULL,
  `asset_category_id` int(11) DEFAULT NULL,
  `qty` int(255) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `other_location` varchar(255) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `entry_date` datetime DEFAULT NULL,
  `date_need` datetime DEFAULT NULL,
  `date_return` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `approved_by` int(11) DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `disapproved_by` int(11) DEFAULT NULL,
  `disapproved_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_asset_request`
--

INSERT INTO `tbl_asset_request` (`tbl_asset_request_id`, `office_management_id`, `asset_category_id`, `qty`, `location_id`, `other_location`, `users_id`, `purpose`, `remarks`, `is_deleted`, `entry_date`, `date_need`, `date_return`, `status`, `approved_by`, `approved_date`, `disapproved_by`, `disapproved_date`) VALUES
(11, 1, 1, 2, 4, 'TEST1', 9, 'TEST1', 'TEST2', 0, '2020-10-25 06:41:27', '2020-10-16 00:00:00', '2020-10-28 00:00:00', 3, NULL, NULL, NULL, NULL),
(12, 5, 1, 2, 4, '', 9, 'TEST1', 'TEST2', 0, '2020-10-25 08:45:29', '2020-10-02 00:00:00', '2020-10-17 00:00:00', 0, NULL, NULL, NULL, NULL),
(13, 1, 1, 2, 4, '2', 9, 'TEST', 'TEST2', 0, '2020-10-25 16:51:44', '2020-10-13 00:00:00', '2020-11-06 00:00:00', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_child_asset`
--

CREATE TABLE `tbl_child_asset` (
  `id` int(10) UNSIGNED NOT NULL,
  `tbl_asset_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_tag` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `serial` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_cost` decimal(20,2) DEFAULT NULL,
  `order_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `physical` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT 0,
  `warranty_months` int(11) DEFAULT NULL,
  `depreciate` tinyint(1) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `requestable` tinyint(4) NOT NULL DEFAULT 0,
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
  `checkin_counter` int(11) NOT NULL DEFAULT 0,
  `checkout_counter` int(11) NOT NULL DEFAULT 0,
  `requests_counter` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) DEFAULT 0,
  `checkout_user_id` int(2) DEFAULT NULL,
  `office_management_id` int(11) DEFAULT NULL,
  `departments_id` int(11) DEFAULT NULL,
  `asset_category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_child_asset`
--

INSERT INTO `tbl_child_asset` (`id`, `tbl_asset_id`, `name`, `asset_tag`, `model_id`, `serial`, `purchase_date`, `purchase_cost`, `order_number`, `assigned_to`, `notes`, `image`, `user_id`, `created_at`, `updated_at`, `physical`, `deleted_at`, `status_id`, `archived`, `warranty_months`, `depreciate`, `supplier_id`, `requestable`, `rtd_location_id`, `_snipeit_mac_address_1`, `accepted`, `last_checkout`, `expected_checkin`, `company_id`, `assigned_type`, `last_audit_date`, `next_audit_date`, `location_id`, `checkin_counter`, `checkout_counter`, `requests_counter`, `is_deleted`, `checkout_user_id`, `office_management_id`, `departments_id`, `asset_category_id`) VALUES
(6, 29, 'AORUS RTX Geforce 3090 Super Gaming', 'GPU 2080', 6, '526124', '2020-09-04', '45000.00', '56124124', NULL, 'TEST', NULL, 1, '2020-09-27 16:00:00', '2020-09-27 16:00:00', 1, NULL, 1, 0, 48, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 23, NULL, NULL, NULL, 2, 0, 0, 0, 1, 6, 5, 2, NULL),
(7, 29, 'MSI Tomahawk Max B450 ATX', 'Motherboard b450', 5, '51251254', '2020-09-11', '25000.00', '16125125', NULL, 'TEST', NULL, 1, '2020-09-27 16:00:00', NULL, 1, NULL, 1, 0, 24, NULL, 2, 0, NULL, NULL, NULL, NULL, NULL, 20, NULL, NULL, NULL, 2, 0, 0, 0, 1, 6, 1, 3, NULL),
(8, 29, 'MSI Tomahawk Max B450 ATX', 'Motherboard b456', 5, '51251254', '2020-09-11', '25000.00', '16125125', NULL, 'TEST', NULL, 1, '2020-09-27 16:00:00', NULL, 1, NULL, 1, 0, 24, NULL, 2, 0, NULL, NULL, NULL, NULL, NULL, 20, NULL, NULL, NULL, 2, 0, 0, 0, 1, 6, 1, 3, NULL),
(9, 30, 'AORUS RTX Geforce 2080 Super Gaming', 'RTX 3090', 8, '01065654', '2020-10-01', '35000.00', '9874987561', NULL, 'TEST', NULL, 1, '2020-09-27 16:00:00', NULL, 1, NULL, 1, 0, 48, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, 21, NULL, NULL, NULL, 4, 0, 0, 0, 0, 6, 5, 2, NULL),
(10, 29, 'NVIDIA GEFORCE RTX 2060', 'RTX 2060', 8, '51612125', '2020-09-17', '25000.00', '612512154', NULL, 'TEST', NULL, 1, '2020-09-27 16:00:00', NULL, 1, NULL, 1, 0, 48, NULL, 2, 0, NULL, NULL, NULL, NULL, NULL, 21, NULL, NULL, NULL, NULL, 0, 0, 0, 1, NULL, NULL, NULL, NULL),
(11, 30, 'AORUS RTX Geforce 2080 Super Gaming', 'Motherboard b550', 6, '6125125', '2020-09-04', '15000.00', '6212415', NULL, '', NULL, 1, '2020-09-27 16:00:00', NULL, 1, NULL, 1, 0, 24, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, 21, NULL, NULL, NULL, 2, 0, 0, 0, 0, 8, 1, 4, NULL),
(12, 30, 'TEST', 'TEST1', 5, 'TEST', '2020-10-08', '2500.00', '5121245152', NULL, 'TEST', NULL, 1, '2020-10-04 16:00:00', NULL, 1, NULL, 1, 0, 24, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, 21, NULL, NULL, NULL, 2, 0, 0, 0, 0, 6, 5, 2, NULL);

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
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_companies`
--

INSERT INTO `tbl_companies` (`id`, `name`, `created_at`, `updated_at`, `image`, `is_deleted`) VALUES
(20, 'MSI', NULL, NULL, 'ha2oy81.png', 0),
(21, 'GIGABYTE', NULL, NULL, 'ha2oy8.png', 0),
(22, 'TEST2', NULL, NULL, 'f2uz1o1.png', 1),
(23, 'AORUS', NULL, NULL, 'ha2oy82.png', 0);

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
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `address` text DEFAULT NULL,
  `child_asset_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(10) DEFAULT NULL,
  `current_custodian_id` int(11) DEFAULT NULL,
  `previous_custodian_id` int(11) DEFAULT NULL,
  `current_location_id` int(11) DEFAULT NULL,
  `previous_location_id` int(11) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `asset_child_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_history`
--

INSERT INTO `tbl_history` (`id`, `asset_id`, `current_custodian_id`, `previous_custodian_id`, `current_location_id`, `previous_location_id`, `description`, `created_at`, `updated_at`, `deleted_at`, `status_id`, `is_deleted`, `user_id`, `asset_child_id`) VALUES
(30, 29, 8, NULL, 4, NULL, 'create', '2020-09-28 04:29:11', NULL, NULL, NULL, 0, 1, NULL),
(31, 30, 8, NULL, 2, NULL, 'create', '2020-09-28 04:32:09', NULL, NULL, NULL, 0, 1, NULL),
(32, NULL, 6, NULL, 2, NULL, 'create', '2020-09-28 04:33:23', NULL, NULL, NULL, 0, 1, 29),
(33, NULL, 6, 6, 2, 2, 'update', '2020-09-28 04:33:23', '2020-09-28 04:33:45', NULL, NULL, 0, 1, 29),
(34, NULL, 6, NULL, 2, NULL, 'create', '2020-09-28 05:14:44', NULL, NULL, NULL, 0, 1, 29),
(35, NULL, 6, NULL, 2, NULL, 'create', '2020-09-28 05:15:48', NULL, NULL, NULL, 0, 1, 29),
(36, NULL, 6, NULL, 4, NULL, 'create', '2020-09-28 05:27:31', NULL, NULL, NULL, 0, 1, 30),
(37, NULL, NULL, NULL, NULL, NULL, 'create', '2020-09-28 07:07:45', NULL, NULL, NULL, 0, 1, 29),
(38, NULL, 8, NULL, 2, NULL, 'create', '2020-09-28 07:17:33', NULL, NULL, NULL, 0, 1, 30),
(39, 31, 6, NULL, 0, NULL, 'create', '2020-09-30 08:59:47', NULL, NULL, NULL, 0, 1, NULL),
(40, 32, 6, NULL, 2, NULL, 'create', '2020-10-03 09:00:46', NULL, NULL, NULL, 0, 1, NULL),
(41, NULL, 6, NULL, 2, NULL, 'create', '2020-10-05 05:09:07', NULL, NULL, NULL, 0, 1, 30),
(42, 33, 1, NULL, 2, NULL, 'create', '2020-10-20 22:22:58', NULL, NULL, NULL, 0, 1, NULL),
(43, 34, 8, NULL, 2, NULL, 'create', '2020-10-22 02:37:18', NULL, NULL, NULL, 0, 1, NULL),
(44, 30, 8, 8, 2, 2, 'update', '2020-09-28 04:32:09', '2020-10-22 02:41:00', NULL, NULL, 0, 1, NULL),
(45, 33, 1, 1, 2, 2, 'update', '2020-10-20 22:22:58', '2020-10-25 12:06:15', NULL, NULL, 0, 1, NULL),
(46, 33, 1, 1, 2, 2, 'update', '2020-10-20 22:22:58', '2020-10-25 12:06:48', NULL, NULL, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locations`
--

CREATE TABLE `tbl_locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `contact_person` text DEFAULT NULL,
  `contact_number` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_locations`
--

INSERT INTO `tbl_locations` (`id`, `name`, `image`, `is_deleted`, `lat`, `lng`, `contact_person`, `contact_number`, `email`, `address`) VALUES
(1, 'Metro Manila', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'NATIONAL CAPITAL REGION', NULL, 0, '14.560344', '121.058747', 'Andolino', '09773656715', 'dondonpentavia@gmail.com', '129 T. Alonzo Ext West Rembo Makati City'),
(3, 'REGION 5', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'REGION 5', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '127 caimito st blk 5 west rembo makati city', NULL, 0, '14.563273', '121.050572', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_models`
--

CREATE TABLE `tbl_models` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `qr_code` text DEFAULT NULL,
  `code` varchar(25) DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `child_asset_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_qrcodes`
--

INSERT INTO `tbl_qrcodes` (`id`, `asset_id`, `qr_code`, `code`, `image`, `is_deleted`, `child_asset_id`) VALUES
(12, 29, '{\"result\":{\"shorturl\":\"https:\\/\\/mbyongson.qrd.by\\/b98ix0\",\"qr\":\"https:\\/\\/mbyongson.qrd.by\\/i\\/b98ix0\",\"url\":\"http:\\/\\/localhost\\/template\\/get-assets\\/MFRWc0R5RmpWaWk4WDA2MHNOUVRuZz09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-09-28 12:29:10\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', 'b98ix0', NULL, 0, NULL),
(13, 30, '{\"result\":{\"shorturl\":\"https:\\/\\/mbyongson.qrd.by\\/3wa1ro\",\"qr\":\"https:\\/\\/mbyongson.qrd.by\\/i\\/3wa1ro\",\"url\":\"http:\\/\\/localhost\\/template\\/get-assets\\/cTRFaG5qZ1RtbmROYTlDUGgxdWZaZz09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-09-28 12:32:09\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', '3wa1ro', NULL, 0, NULL),
(14, 0, '{\"result\":{\"shorturl\":\"https:\\/\\/mbyongson.qrd.by\\/n4i3z2\",\"qr\":\"https:\\/\\/mbyongson.qrd.by\\/i\\/n4i3z2\",\"url\":\"http:\\/\\/localhost\\/template\\/get-assets\\/K3Z1Yko1RUg4emZ0c0g5VDIySXA1Zz09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-09-28 12:33:23\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', 'n4i3z2', NULL, 0, 6),
(15, 0, '{\"result\":{\"shorturl\":\"https:\\/\\/mbyongson.qrd.by\\/tbk4i2\",\"qr\":\"https:\\/\\/mbyongson.qrd.by\\/i\\/tbk4i2\",\"url\":\"http:\\/\\/localhost\\/template\\/get-assets\\/TnIwNlVUcEJVNkhkeG5JR3FxL0YyUT09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-09-28 13:27:31\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', 'tbk4i2', NULL, 0, 9),
(16, 31, '{\"result\":{\"shorturl\":\"https:\\/\\/mamary.qrd.by\\/a6vomh\",\"qr\":\"https:\\/\\/mamary.qrd.by\\/i\\/a6vomh\",\"url\":\"http:\\/\\/localhost\\/template\\/get-assets\\/WTNVaXJYMjZIMjgwR1o2RWlhS0kzdz09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-09-30 16:59:46\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', 'a6vomh', NULL, 0, NULL),
(17, 32, '{\"result\":{\"shorturl\":\"https:\\/\\/mamary.qrd.by\\/doevz0\",\"qr\":\"https:\\/\\/mamary.qrd.by\\/i\\/doevz0\",\"url\":\"http:\\/\\/localhost\\/template\\/get-assets\\/K2t0YTVyYTdZQ0dxUy9CMGNia01Ndz09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-10-03 17:00:47\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', 'doevz0', NULL, 0, NULL),
(18, 0, '{\"result\":{\"shorturl\":\"https:\\/\\/mamary.qrd.by\\/r74nj6\",\"qr\":\"https:\\/\\/mamary.qrd.by\\/i\\/r74nj6\",\"url\":\"http:\\/\\/localhost\\/template\\/get-assets-child\\/ZlRWaWd5L084NFQwb3JONlNsMVJSUT09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-10-05 13:09:06\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', 'r74nj6', NULL, 0, 12),
(19, 33, '{\"result\":{\"shorturl\":\"https:\\/\\/mamary.qrd.by\\/f16m23\",\"qr\":\"https:\\/\\/mamary.qrd.by\\/i\\/f16m23\",\"url\":\"http:\\/\\/localhost\\/template\\/get-assets\\/eUNwZHlOTzRrU0JXT0VOZjMyV28vUT09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-10-21 06:22:59\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', 'f16m23', NULL, 0, NULL),
(20, 34, '{\"result\":{\"shorturl\":\"https:\\/\\/mamary.qrd.by\\/1qv2yi\",\"qr\":\"https:\\/\\/mamary.qrd.by\\/i\\/1qv2yi\",\"url\":\"http:\\/\\/localhost\\/template\\/get-assets\\/L0IybVNoOGRabEtuQVNCVWNRZUtDQT09\",\"title\":\"\",\"description\":\"\",\"creationdate\":\"2020-10-22 10:37:18\",\"image\":\"\",\"gps\":\"1\",\"sms\":\"0\",\"notify\":\"\",\"medium\":\"\",\"folder\":\"\",\"color\":\"\",\"bgcolor\":\"\",\"location\":{\"address\":\"\",\"lng\":\"\",\"lat\":\"\"}}}', '1qv2yi', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status_labels`
--

CREATE TABLE `tbl_status_labels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deployable` tinyint(1) NOT NULL DEFAULT 0,
  `pending` tinyint(1) NOT NULL DEFAULT 0,
  `archived` tinyint(1) NOT NULL DEFAULT 0,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_in_nav` tinyint(1) NOT NULL DEFAULT 0,
  `default_label` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_status_labels`
--

INSERT INTO `tbl_status_labels` (`id`, `name`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `deployable`, `pending`, `archived`, `notes`, `color`, `show_in_nav`, `default_label`, `is_deleted`) VALUES
(1, 'Pending', 1, NULL, NULL, NULL, 0, 1, 0, 'These assets are not yet ready to be deployed, usually because of configuration or waiting on parts.', NULL, 0, 0, 0),
(2, 'Ready to Deploy', 1, NULL, NULL, NULL, 1, 0, 0, 'These assets are ready to deploy.', NULL, 0, 0, 0),
(3, 'Dispatch', 1, NULL, NULL, NULL, 0, 0, 1, 'These assets are Dispatch By User', NULL, 0, 0, 0),
(4, 'Deployed', 1, NULL, NULL, NULL, 1, 0, 0, 'These assets are Deployed By User', NULL, 0, 0, 0);

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
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_suppliers`
--

INSERT INTO `tbl_suppliers` (`id`, `name`, `address`, `contact_name`, `contact_no`, `email`, `web`, `notes`, `image`, `is_deleted`) VALUES
(1, 'DYNAQUEST PC', 'CASH N CARRY PASAY ROAD MAKATI CITY', 'Jenny', '0983232552', 'info@dynaquestpc.com', 'dynaquestpc.com', 'TEST', NULL, 0),
(2, 'TIPID PC', 'DELPAN JP RIZAL EXTENSION MAKATI CITY', 'ROBERT JOBERT', '098879784254', 'info@tipidpc.com', 'tipidpc.com', 'TEST', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_uploads`
--

CREATE TABLE `tbl_uploads` (
  `uploads_id` int(11) NOT NULL,
  `asset_id` int(10) NOT NULL,
  `image_name` text DEFAULT NULL,
  `image_path` text DEFAULT NULL,
  `file_name` text DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `child_asset_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_uploads`
--

INSERT INTO `tbl_uploads` (`uploads_id`, `asset_id`, `image_name`, `image_path`, `file_name`, `file_path`, `transaction_date`, `child_asset_id`) VALUES
(21, 27, 'NVIDIA-GeForce-RTX-3090.jpg', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-09-28', NULL),
(22, 28, 'tomahawk7.jpg', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-09-28', NULL),
(23, 0, '41KH7PiXOXL.jpg', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-09-28', 5),
(24, 29, 'geforce_rtx_20607.jpg', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-09-28', NULL),
(25, 30, 'tomahawk8.jpg', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-09-28', NULL),
(26, 0, '41KH7PiXOXL1.jpg', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-09-28', 6),
(27, 0, 'tomahawk9.jpg', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-09-28', 7),
(28, 0, 'tomahawk10.jpg', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-09-28', 8),
(29, 0, '41KH7PiXOXL2.jpg', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-09-28', 9),
(30, 0, '13-145-090-V01.jpg', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-09-28', 11),
(31, 31, '3P.png', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-09-30', NULL),
(32, 33, 'IMG_20200627_152512.jpg', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-10-21', NULL),
(33, 34, '3P1.png', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-10-22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `uploads_id` int(11) NOT NULL,
  `members_id` varchar(11) NOT NULL,
  `image_name` text DEFAULT NULL,
  `image_path` text DEFAULT NULL,
  `file_name` text DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `transaction_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`uploads_id`, `members_id`, `image_name`, `image_path`, `file_name`, `file_path`, `transaction_date`) VALUES
(1, '00000001', 'tobi__the_masked_ninja_from_akatsuki_by_beu2v_dbtmcz6-fullview6.jpg', 'C:/xampp/htdocs/cpfi/assets/image/uploads/', NULL, NULL, '2020-04-23'),
(2, '00000002', '84217667_548898739065440_6328985649004661540_n4.jpg', 'C:/xampp/htdocs/cpfi/assets/image/uploads/', NULL, NULL, '2020-04-09'),
(3, '00000003', 'Capture2.PNG', 'C:/xampp/htdocs/cpfi/assets/image/uploads/', NULL, NULL, '2020-04-09'),
(4, '00000004', '89260743_2658694764411607_948672185790002051_n3.jpg', 'C:/xampp/htdocs/cpfi/assets/image/uploads/', NULL, NULL, '2020-04-10'),
(5, '00000007', 'color-2174065_1280.png', 'X:/Localhost/htdocs/template/assets/image/uploads/', NULL, NULL, '2020-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `screen_name` text DEFAULT NULL,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `txt_password` text DEFAULT NULL,
  `trans_date` date DEFAULT NULL,
  `trans_desc` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `last_name` text DEFAULT NULL,
  `first_name` text DEFAULT NULL,
  `middle_name` text DEFAULT NULL,
  `level` tinyint(4) DEFAULT 0 COMMENT '0=Administrator,1=Manager,2=Tech Support,3=User - Requestor',
  `email` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `fp_time` varchar(50) DEFAULT NULL,
  `is_pw_updated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `screen_name`, `username`, `password`, `txt_password`, `trans_date`, `trans_desc`, `is_deleted`, `last_name`, `first_name`, `middle_name`, `level`, `email`, `designation`, `fp_time`, `is_pw_updated`) VALUES
(1, 'Admins', 'user1', '$2y$10$RdmlOAPf.LPNqb8AvqE9leqPnasEOAmAERZtYXpNEdH4jUdcptemG', '1234567', '2020-08-15', 'add', 0, 'Pentavia', 'Dondon', 'Hammet', 0, 'dondonpentavia@gmail.com', 'Developer', '1596212804', 0),
(5, 'Dondon', 'user2', '$2y$10$GetAQ4qm7q8.d0YSYLWteeG1E3bFu7m0u94oENHugwmnOrGk060ja', '123456', '2020-04-25', NULL, 1, 'Baisac', 'Andolino', 'Gallardo', 4, 'baisac.andolino@gmail.com', 'Programmer', NULL, 0),
(6, 'Robin', 'user3', '$2y$10$FYDYA..42Ex6w0xKy1NK0Ow2gCkCxxwZ2TEiXRdoC.rdKO6oYASwO', 'Asd_06', '2020-04-25', NULL, 0, 'Cardo', 'Dalisay', 'Mendoza', 2, 'robinpadilla@gmail.com', 'Staff', NULL, 0),
(7, 'Mardyon', 'user4', '$2y$10$6373IZTPGcWskK/pY3gBWOrW7C5SCzxURVc7XjIWjpc5icQv.ZDqy', '12345678', '2020-04-29', NULL, 1, 'Congzon', 'Mardyon', 'G', 0, 'mardyon@gmail.com', 'Programmer', NULL, 0),
(8, 'Peter', 'peteAdmin', '$2y$10$D/gp043WINZDAHrdSQOryu8gUfGbYBlv/fDMdkthgmJs3BoTAyKM6', '!@#QWEASDZXC', '2020-08-15', NULL, 0, 'Mora', 'Peter', 'BIllones', 0, 'peterbillonesmora@gmail.com', 'Programmer', NULL, 0),
(9, 'Dondon', 'pentavia6', '$2y$10$j73kucFVhisbDyQRW2llheGpPTo9I/J23Q6V.wMF6WqN/q14YRtRW', '123456', '2020-10-23', NULL, 0, 'Baisac', 'Andolino', 'Gallardo', 3, 'dpentavia@gmail.com', 'Administrator', NULL, 0),
(10, 'Nonie', 'nonie', '$2y$10$msYIPfXgbQz7y/MtlQ9FOeOJMYCZxHfgMzMlMra17w8nK1fz9/GxG', '123456', '2020-10-24', NULL, 0, 'advincula', 'nonie', 'oowa', 2, 'mardyon.yongson1026@gmail.com', 'IT Dept.', NULL, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_acct_chart`
-- (See below for the actual view)
--
CREATE TABLE `v_acct_chart` (
`id` varchar(15)
,`parent_id` varchar(250)
,`class_code` varchar(10)
,`class_desc` varchar(100)
,`group_code` varchar(10)
,`group_desc` varchar(100)
,`main_code` varchar(15)
,`main_desc` varchar(250)
,`code` varchar(50)
,`is_deleted` int(4)
);

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
,`target_child_id` int(11)
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
,`asset_name2` varchar(191)
,`screen_name` text
,`target` text
,`target2` text
,`lat` varchar(191)
,`lng` varchar(191)
,`address` text
,`default_location` varchar(191)
,`scanned_lat` varchar(255)
,`scanned_lng` varchar(255)
,`default_location2` varchar(191)
,`scanned_lat2` varchar(255)
,`scanned_lng2` varchar(255)
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
,`property_tag` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_asset_child`
-- (See below for the actual view)
--
CREATE TABLE `v_asset_child` (
`id` int(10) unsigned
,`tbl_asset_id` int(10) unsigned
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
-- Stand-in structure for view `v_asset_report`
-- (See below for the actual view)
--
CREATE TABLE `v_asset_report` (
`id` int(10) unsigned
,`parent` varchar(191)
,`name` varchar(191)
,`serial` varchar(191)
,`asset_tag` varchar(191)
,`office_name` mediumtext
,`end_user` mediumtext
,`location_id` int(11)
,`users_id` int(11)
,`is_deleted` tinyint(4)
,`counter` bigint(21)
,`last_name` mediumtext
,`first_name` mediumtext
,`middle_name` mediumtext
,`designation` varchar(255)
,`short` varchar(50)
,`sibling` int(11)
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
-- Stand-in structure for view `v_balance`
-- (See below for the actual view)
--
CREATE TABLE `v_balance` (
`members_id` varchar(11)
,`loan_computation_id` int(11)
,`loan_type_name` text
,`ref_no` text
,`col_period_start` text
,`col_period_end` text
,`amnt_of_loan` decimal(12,2)
,`mo_amortization` decimal(12,2)
,`mo_principal` decimal(12,2)
,`interest_per_mo` decimal(12,2)
,`tot_amount_paid` decimal(34,2)
,`tot_interest_paid` decimal(34,2)
,`tot_monthly_interest` decimal(34,2)
,`tot_principal` decimal(34,2)
,`tot_mo_amortization` decimal(34,2)
,`first_date_of_paid` mediumtext
,`last_date_of_paid` mediumtext
,`first_sched_id` int(11)
,`last_sched_id` int(11)
,`type` text
,`is_approved` tinyint(1)
,`is_posted` tinyint(1)
,`is_deleted` tinyint(1)
,`office_management_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_beneficiaries`
-- (See below for the actual view)
--
CREATE TABLE `v_beneficiaries` (
`beneficiaries_id` int(11)
,`members_id` varchar(11)
,`rel_type` text
,`last_name` text
,`first_name` text
,`relationship_name` text
,`is_deleted` tinyint(1)
,`entry_date` date
,`relationship_type_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_benefit_claimed_by_member`
-- (See below for the actual view)
--
CREATE TABLE `v_benefit_claimed_by_member` (
`claimed_benefit_id` int(11)
,`members_id` varchar(11)
,`benefit_type_id` int(11)
,`claim_date` date
,`accum_contrib` decimal(12,2)
,`share` decimal(12,2)
,`tot_share_contrib` decimal(12,2)
,`other_benefit` decimal(12,2)
,`clmd_sickness` decimal(12,2)
,`clmd_dif` decimal(12,2)
,`clmd_accident` decimal(12,2)
,`clmd_calamity` decimal(12,2)
,`total_claim` decimal(12,2)
,`claim_all` tinyint(1)
,`users_id` int(11)
,`is_deleted` tinyint(1)
,`entry_date` date
,`lri_from_loan_balance` decimal(12,2)
,`name` mediumtext
,`id_no` text
,`type_of_benefit` text
,`office_name` text
,`place` varchar(50)
,`retired_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bs_assets`
-- (See below for the actual view)
--
CREATE TABLE `v_bs_assets` (
`id` varchar(15)
,`parent_id` varchar(250)
,`class_code` varchar(10)
,`class_desc` varchar(100)
,`group_code` varchar(10)
,`group_desc` varchar(100)
,`main_code` varchar(15)
,`main_desc` varchar(250)
,`code` varchar(50)
,`is_deleted` int(4)
,`debit` decimal(12,2)
,`credit` decimal(12,2)
,`journal_date` date
,`normal_bal` varchar(2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bs_liabilities`
-- (See below for the actual view)
--
CREATE TABLE `v_bs_liabilities` (
`id` varchar(15)
,`parent_id` varchar(250)
,`class_code` varchar(10)
,`class_desc` varchar(100)
,`group_code` varchar(10)
,`group_desc` varchar(100)
,`main_code` varchar(15)
,`main_desc` varchar(250)
,`code` varchar(50)
,`is_deleted` int(4)
,`debit` decimal(12,2)
,`credit` decimal(12,2)
,`journal_date` date
,`normal_bal` varchar(2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_cash_gift`
-- (See below for the actual view)
--
CREATE TABLE `v_cash_gift` (
`last_name` text
,`first_name` text
,`middle_name` text
,`date_of_effectivity` date
,`office_name` text
,`cash_gift_id` int(11)
,`members_id` varchar(11)
,`amount` decimal(12,2)
,`rate` decimal(12,2)
,`is_deleted` tinyint(1)
,`date_applied` date
,`entry_date` date
,`status` varchar(20)
,`remarks` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_contribution_and_payments`
-- (See below for the actual view)
--
CREATE TABLE `v_contribution_and_payments` (
`ofc_id` int(11)
,`parent_ofc` mediumtext
,`office_name` mediumtext
,`parent_mem` mediumtext
,`members_name` mediumtext
,`monthly_salary` decimal(12,2)
,`cont_date` varchar(7)
,`deduction` decimal(34,2)
,`adjusted_amnt` decimal(34,2)
,`total_cont` decimal(35,2)
,`ref_no` mediumtext
,`collection_period` mediumtext
,`gpln` decimal(56,2)
,`emln` decimal(56,2)
,`slmv` decimal(56,2)
,`total` decimal(56,2)
,`total_deduction` decimal(57,2)
,`remarks` varchar(255)
,`date_applied` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_crj_report`
-- (See below for the actual view)
--
CREATE TABLE `v_crj_report` (
`j_master_id` bigint(20)
,`j_type_id` int(11)
,`account_no` varchar(50)
,`journal_ref` varchar(50)
,`check_voucher_no` varchar(50)
,`check_no` varchar(50)
,`reference_no` varchar(50)
,`payee_type` tinyint(1)
,`payee_members_id` varchar(11)
,`payee` varchar(255)
,`particulars` longtext
,`loan_computation_id` int(11)
,`date_posted` date
,`journal_date` date
,`cash_on_hand_debit` decimal(34,2)
,`cash_in_bank_lbp_debit` decimal(34,2)
,`cash_in_bank_mbtc_debit` decimal(34,2)
,`deferred_credits_debit` decimal(34,2)
,`sundry_accounts_debit` varchar(250)
,`sundry_amount_debit` decimal(34,2)
,`cash_on_hand_credit` decimal(34,2)
,`loan_receivable_credit` decimal(34,2)
,`interest_receivable_credit` decimal(34,2)
,`interest_income_credit` decimal(34,2)
,`due_from_psa_credit` decimal(34,2)
,`donation_serv_allow_credit` decimal(34,2)
,`sundry_accounts_credit` varchar(250)
,`sundry_amount_credit` decimal(34,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_general_ledger`
-- (See below for the actual view)
--
CREATE TABLE `v_general_ledger` (
`journal_ref` varchar(50)
,`particulars` longtext
,`debit` decimal(34,2)
,`credit` decimal(34,2)
,`balance` decimal(35,2)
,`date_posted` date
,`is_deleted` tinyint(1)
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
-- Stand-in structure for view `v_immediate_family`
-- (See below for the actual view)
--
CREATE TABLE `v_immediate_family` (
`immediate_family_id` int(11)
,`members_id` varchar(11)
,`rel_type` text
,`last_name` text
,`first_name` text
,`relationship_name` text
,`is_deleted` tinyint(1)
,`entry_date` date
,`relationship_type_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_is_income_expense`
-- (See below for the actual view)
--
CREATE TABLE `v_is_income_expense` (
`id` varchar(15)
,`parent_id` varchar(250)
,`class_code` varchar(10)
,`class_desc` varchar(100)
,`group_code` varchar(10)
,`group_desc` varchar(100)
,`main_code` varchar(15)
,`main_desc` varchar(250)
,`code` varchar(50)
,`is_deleted` int(4)
,`debit` decimal(12,2)
,`credit` decimal(12,2)
,`journal_date` date
,`normal_bal` varchar(2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_loans_by_member`
-- (See below for the actual view)
--
CREATE TABLE `v_loans_by_member` (
`members_id` varchar(11)
,`fname` mediumtext
,`loan_computation_id` int(11)
,`type` text
,`ref_no` text
,`col_period_start` text
,`col_period_end` text
,`amnt_of_loan` decimal(12,2)
,`payment` decimal(34,2)
,`is_approved` tinyint(1)
,`is_posted` tinyint(1)
,`is_deleted` tinyint(1)
,`is_approved_txt` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_loans_list`
-- (See below for the actual view)
--
CREATE TABLE `v_loans_list` (
`loan_computation_id` int(11)
,`members_id` varchar(11)
,`ref_no` text
,`date_processed` date
,`fname` mediumtext
,`is_approved` tinyint(1)
,`is_posted` tinyint(1)
,`is_deleted` tinyint(1)
,`is_approved_txt` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_loan_sched_choices`
-- (See below for the actual view)
--
CREATE TABLE `v_loan_sched_choices` (
`loan_schedule_id` int(11)
,`loan_computation_id` int(11)
,`payment_schedule` text
,`monthly_amortization` decimal(12,2)
,`principal` decimal(12,2)
,`monthly_interest` decimal(12,2)
,`is_deleted` tinyint(1)
,`entry_date` date
,`amnt_paid` decimal(34,2)
,`interest_paid` decimal(34,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_loan_settings`
-- (See below for the actual view)
--
CREATE TABLE `v_loan_settings` (
`loan_settings_id` int(11)
,`loan_code` text
,`monthly_interest` decimal(12,2)
,`number_of_month` int(11)
,`repymnt_period` decimal(12,2)
,`svc` decimal(12,2)
,`lri` decimal(12,4)
,`int_per_annum` decimal(12,4)
,`entry_date` date
,`is_deleted` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_members`
-- (See below for the actual view)
--
CREATE TABLE `v_members` (
`members_id` varchar(11)
,`id_no` text
,`last_name` text
,`first_name` text
,`middle_name` text
,`dob` date
,`address` text
,`status` text
,`date_of_effectivity` date
,`designation` text
,`type` text
,`monthly_salary` decimal(12,2)
,`office_name` text
,`entry_date` date
,`bank_account` text
,`contact_no` varchar(50)
,`is_deleted` tinyint(1)
,`retired_date` date
,`type_of_benefit` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_official_receipt`
-- (See below for the actual view)
--
CREATE TABLE `v_official_receipt` (
`official_receipt_id` int(11)
,`departments_id` int(11)
,`amount_type` int(1)
,`orno` varchar(255)
,`check_no` varchar(255)
,`address` varchar(255)
,`tin` varchar(255)
,`amount` decimal(12,2)
,`senior_citizen_tin` varchar(255)
,`osca_pwd_citizen_tin` varchar(255)
,`contribution` decimal(12,2)
,`gpln` decimal(12,2)
,`emln` decimal(12,2)
,`slmv` decimal(12,2)
,`others` decimal(12,2)
,`remarks` varchar(255)
,`is_deleted` tinyint(1)
,`date_applied` date
,`entry_date` date
,`status` varchar(20)
,`received_by` varchar(255)
,`business_style` varchar(255)
,`sc_pw_discount` decimal(12,2)
,`total_due` decimal(12,2)
,`withholding_tax` decimal(12,2)
,`payment_due` decimal(12,2)
,`total` decimal(12,2)
,`region` varchar(255)
,`short` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pacs`
-- (See below for the actual view)
--
CREATE TABLE `v_pacs` (
`j_master_id` bigint(20)
,`j_type_id` int(11)
,`account_no` text
,`journal_ref` varchar(50)
,`check_voucher_no` varchar(50)
,`check_no` varchar(50)
,`reference_no` varchar(50)
,`payee_type` tinyint(1)
,`payee_members_id` varchar(11)
,`payee` varchar(255)
,`payee_member` mediumtext
,`official_station` text
,`col_period_start` text
,`col_period_end` text
,`monthly_amortization` decimal(12,2)
,`date_posted` date
,`journal_date` date
,`cash_on_hand_credit` decimal(34,2)
,`cash_in_bank_lbp_credit` decimal(34,2)
,`cash_in_bank_mbtc_credit` decimal(34,2)
,`unearned_interest_credit` decimal(34,2)
,`interest_income_credit` decimal(34,2)
,`deferred_credits_credit` decimal(34,2)
,`lri_credit` decimal(34,2)
,`loan_receivable_credit` decimal(34,2)
,`interest_credit` decimal(34,2)
,`service_charge_credit` decimal(34,2)
,`loan_receivable_debit` decimal(34,2)
,`interest_income_debit` decimal(34,2)
,`deferred_credits_debit` decimal(34,2)
,`benefit_claim_debit` decimal(34,2)
,`members_contribution_debit` decimal(34,2)
,`sundry_accounts_credit` varchar(250)
,`sundry_amount_credit` decimal(34,2)
,`sundry_accounts_debit` varchar(250)
,`sundry_amount_debit` decimal(34,2)
,`comaker` mediumtext
,`remarks` longtext
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_portal_request`
-- (See below for the actual view)
--
CREATE TABLE `v_portal_request` (
`tbl_asset_request_id` int(11)
,`office_management_id` int(11)
,`asset_category_id` int(11)
,`qty` int(255)
,`location_id` int(11)
,`other_location` varchar(255)
,`users_id` int(11)
,`purpose` text
,`remarks` text
,`is_deleted` tinyint(1)
,`entry_date` datetime
,`date_need` datetime
,`date_return` datetime
,`status` tinyint(1)
,`approved_by` text
,`approved_date` datetime
,`disapproved_by` text
,`disapproved_date` datetime
,`office_name` text
,`category_name` varchar(50)
,`location_name` varchar(191)
,`screen_name` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_repair_request`
-- (See below for the actual view)
--
CREATE TABLE `v_repair_request` (
`id` int(11)
,`serial` varchar(191)
,`asset_tag` text
,`asset_category` varchar(50)
,`asset_name` varchar(191)
,`property_tag` text
,`tbl_child_asset_id` text
,`regkits_no` text
,`custodian` int(11)
,`date_reported` datetime
,`problem_desc` text
,`file_upload` text
,`image_upload` text
,`remarks` text
,`is_deleted` tinyint(1)
,`entry_date` datetime
,`status` tinyint(1)
,`approved_by` int(11)
,`approved_date` datetime
,`disapproved_by` int(11)
,`disapproved_date` datetime
,`requestor` int(11)
,`custodian_name` text
,`requestor_name` text
,`approver_name` text
,`disapprover_name` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_subsidiary`
-- (See below for the actual view)
--
CREATE TABLE `v_subsidiary` (
`account_subsidiary_id` bigint(20)
,`code` varchar(50)
,`employee_id` varchar(50)
,`name` varchar(255)
,`users_id` int(11)
,`is_deleted` tinyint(1)
,`entry_date` date
,`main_desc` varchar(250)
,`sub_code` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_trial_balance`
-- (See below for the actual view)
--
CREATE TABLE `v_trial_balance` (
`id` varchar(15)
,`parent_id` varchar(250)
,`class_code` varchar(10)
,`class_desc` varchar(100)
,`group_code` varchar(10)
,`group_desc` varchar(100)
,`main_code` varchar(15)
,`main_desc` varchar(250)
,`code` varchar(50)
,`is_deleted` int(4)
,`debit` decimal(12,2)
,`credit` decimal(12,2)
,`journal_date` date
);

-- --------------------------------------------------------

--
-- Structure for view `v_acct_chart`
--
DROP TABLE IF EXISTS `v_acct_chart`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_acct_chart`  AS  select `ac`.`class_code` AS `id`,`ac`.`class_desc` AS `parent_id`,`ac`.`class_code` AS `class_code`,`ac`.`class_desc` AS `class_desc`,NULL AS `group_code`,NULL AS `group_desc`,NULL AS `main_code`,NULL AS `main_desc`,NULL AS `code`,coalesce(`ac`.`is_deleted`,0) AS `is_deleted` from ((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) where `ac`.`is_deleted` = 0 union select `ag`.`group_code` AS `id`,`ag`.`group_desc` AS `parent_id`,NULL AS `class_code`,NULL AS `class_desc`,`ag`.`group_code` AS `group_code`,`ag`.`group_desc` AS `group_desc`,NULL AS `main_code`,NULL AS `main_desc`,NULL AS `code`,coalesce(`ag`.`is_deleted`,0) AS `is_deleted` from ((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) where `ag`.`is_deleted` = 0 union select `am`.`main_code` AS `id`,`am`.`main_desc` AS `parent_id`,NULL AS `class_code`,NULL AS `class_desc`,NULL AS `group_code`,NULL AS `group_desc`,`am`.`main_code` AS `main_code`,`am`.`main_desc` AS `main_desc`,`am`.`code` AS `code`,coalesce(`am`.`is_deleted`,0) AS `is_deleted` from ((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) where `am`.`is_deleted` = 0 order by 1,2 ;

-- --------------------------------------------------------

--
-- Structure for view `v_activity_logs`
--
DROP TABLE IF EXISTS `v_activity_logs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_activity_logs`  AS  select `tal`.`id` AS `id`,`tal`.`user_id` AS `user_id`,`tal`.`action_type` AS `action_type`,`tal`.`target_id` AS `target_id`,`tal`.`target_child_id` AS `target_child_id`,`tal`.`target_type` AS `target_type`,`tal`.`location_id` AS `location_id`,`tal`.`note` AS `note`,`tal`.`filename` AS `filename`,`tal`.`item_type` AS `item_type`,`tal`.`item_id` AS `item_id`,`tal`.`expected_checkin` AS `expected_checkin`,`tal`.`accepted_id` AS `accepted_id`,`tal`.`created_at` AS `created_at`,`tal`.`updated_at` AS `updated_at`,`tal`.`deleted_at` AS `deleted_at`,`tal`.`thread_id` AS `thread_id`,`tal`.`company_id` AS `company_id`,`tal`.`accept_signature` AS `accept_signature`,`tal`.`log_meta` AS `log_meta`,`tal`.`is_deleted` AS `is_deleted`,`ta`.`name` AS `asset_name`,`tca`.`name` AS `asset_name2`,`u`.`screen_name` AS `screen_name`,`u2`.`screen_name` AS `target`,`u3`.`screen_name` AS `target2`,`tg`.`lat` AS `lat`,`tg`.`lng` AS `lng`,`tg`.`address` AS `address`,`tl`.`name` AS `default_location`,`tl`.`lat` AS `scanned_lat`,`tl`.`lng` AS `scanned_lng`,`tl2`.`name` AS `default_location2`,`tl2`.`lat` AS `scanned_lat2`,`tl2`.`lng` AS `scanned_lng2`,`tg`.`code` AS `code` from ((((((((`tbl_action_logs` `tal` left join `tbl_asset` `ta` on(`ta`.`id` = `tal`.`target_id`)) left join `tbl_child_asset` `tca` on(`tca`.`id` = `tal`.`target_child_id`)) left join `users` `u` on(`u`.`users_id` = `tal`.`user_id`)) left join `users` `u2` on(`u2`.`users_id` = `ta`.`checkout_user_id`)) left join `users` `u3` on(`u3`.`users_id` = `tca`.`checkout_user_id`)) left join `tbl_gps` `tg` on(`tg`.`asset_id` = `ta`.`id` or `tg`.`child_asset_id` = `tca`.`id`)) left join `tbl_locations` `tl` on(`tl`.`id` = `ta`.`location_id`)) left join `tbl_locations` `tl2` on(`tl2`.`id` = `tca`.`location_id`)) where `ta`.`is_deleted` = 0 or `tca`.`is_deleted` = 0 group by `tal`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_asset`
--
DROP TABLE IF EXISTS `v_asset`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_asset`  AS  select `ta`.`id` AS `id`,`ta`.`name` AS `name`,`tc`.`name` AS `company`,`ta`.`asset_tag` AS `asset_tag`,`tm`.`name` AS `model`,`tsl`.`name` AS `status`,`ta`.`serial` AS `serial`,`ta`.`name` AS `asset_name`,`ta`.`purchase_date` AS `purchase_date`,`ts`.`name` AS `supplier`,`ta`.`order_number` AS `order_number`,`ta`.`purchase_cost` AS `purchase_cost`,`ta`.`warranty_months` AS `warranty_months`,`tl`.`name` AS `default_location`,`ta`.`notes` AS `notes`,`ta`.`requestable` AS `requestable`,`ta`.`is_deleted` AS `is_deleted`,`ta`.`status_id` AS `status_id`,`u`.`screen_name` AS `screen_name`,`om`.`office_name` AS `office_name`,`d`.`region` AS `region`,`ta`.`property_tag` AS `property_tag` from ((((((((`tbl_asset` `ta` left join `tbl_companies` `tc` on(`tc`.`id` = `ta`.`company_id`)) left join `tbl_models` `tm` on(`tm`.`id` = `ta`.`model_id`)) left join `tbl_status_labels` `tsl` on(`tsl`.`id` = `ta`.`status_id`)) left join `tbl_suppliers` `ts` on(`ts`.`id` = `ta`.`supplier_id`)) left join `tbl_locations` `tl` on(`tl`.`id` = `ta`.`location_id`)) left join `users` `u` on(`u`.`users_id` = `ta`.`checkout_user_id`)) left join `office_management` `om` on(`om`.`office_management_id` = `ta`.`office_management_id`)) left join `departments` `d` on(`d`.`departments_id` = `ta`.`departments_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_asset_child`
--
DROP TABLE IF EXISTS `v_asset_child`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_asset_child`  AS  select `ta`.`id` AS `id`,`ta`.`tbl_asset_id` AS `tbl_asset_id`,`ta`.`name` AS `name`,`tc`.`name` AS `company`,`ta`.`asset_tag` AS `asset_tag`,`tm`.`name` AS `model`,`tsl`.`name` AS `status`,`ta`.`serial` AS `serial`,`ta`.`name` AS `asset_name`,`ta`.`purchase_date` AS `purchase_date`,`ts`.`name` AS `supplier`,`ta`.`order_number` AS `order_number`,`ta`.`purchase_cost` AS `purchase_cost`,`ta`.`warranty_months` AS `warranty_months`,`tl`.`name` AS `default_location`,`ta`.`notes` AS `notes`,`ta`.`requestable` AS `requestable`,`ta`.`is_deleted` AS `is_deleted`,`ta`.`status_id` AS `status_id`,`u`.`screen_name` AS `screen_name`,`om`.`office_name` AS `office_name`,`d`.`region` AS `region` from ((((((((`tbl_child_asset` `ta` left join `tbl_companies` `tc` on(`tc`.`id` = `ta`.`company_id`)) left join `tbl_models` `tm` on(`tm`.`id` = `ta`.`model_id`)) left join `tbl_status_labels` `tsl` on(`tsl`.`id` = `ta`.`status_id`)) left join `tbl_suppliers` `ts` on(`ts`.`id` = `ta`.`supplier_id`)) left join `tbl_locations` `tl` on(`tl`.`id` = `ta`.`location_id`)) left join `users` `u` on(`u`.`users_id` = `ta`.`checkout_user_id`)) left join `office_management` `om` on(`om`.`office_management_id` = `ta`.`office_management_id`)) left join `departments` `d` on(`d`.`departments_id` = `ta`.`departments_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_asset_report`
--
DROP TABLE IF EXISTS `v_asset_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_asset_report`  AS  select `ta`.`id` AS `id`,`ta`.`asset_tag` AS `parent`,`ta`.`name` AS `name`,`ta`.`serial` AS `serial`,`ta`.`asset_tag` AS `asset_tag`,`om`.`office_name` AS `office_name`,`u1`.`screen_name` AS `end_user`,`ta`.`location_id` AS `location_id`,`u1`.`users_id` AS `users_id`,`ta`.`is_deleted` AS `is_deleted`,NULL AS `counter`,`u1`.`last_name` AS `last_name`,`u1`.`first_name` AS `first_name`,`u1`.`middle_name` AS `middle_name`,`u1`.`designation` AS `designation`,`d2`.`short` AS `short`,`ta`.`sibling` AS `sibling` from (((`tbl_asset` `ta` left join `office_management` `om` on(`om`.`office_management_id` = `ta`.`office_management_id`)) left join `departments` `d2` on(`d2`.`departments_id` = `om`.`departments_id`)) left join `users` `u1` on(`u1`.`users_id` = `ta`.`checkout_user_id`)) where `ta`.`is_deleted` = 0 union select `tca`.`tbl_asset_id` AS `id`,NULL AS `parent`,`tca`.`name` AS `name`,`tca`.`serial` AS `serial`,`tca`.`asset_tag` AS `asset_tag`,`om`.`office_name` AS `office_name`,`u2`.`screen_name` AS `end_user`,`tca`.`location_id` AS `location_id`,`u2`.`users_id` AS `users_id`,`tca`.`is_deleted` AS `is_deleted`,count(case when `tca`.`is_deleted` = 0 then `tca`.`name` else 0 end) AS `counter`,`u2`.`last_name` AS `last_name`,`u2`.`first_name` AS `first_name`,`u2`.`middle_name` AS `middle_name`,`u2`.`designation` AS `designation`,`d3`.`short` AS `short`,NULL AS `sibling` from (((`tbl_child_asset` `tca` left join `office_management` `om` on(`om`.`office_management_id` = `tca`.`office_management_id`)) left join `departments` `d3` on(`d3`.`departments_id` = `om`.`departments_id`)) left join `users` `u2` on(`u2`.`users_id` = `tca`.`checkout_user_id`)) where `tca`.`is_deleted` = 0 group by `tca`.`id` order by 1 ;

-- --------------------------------------------------------

--
-- Structure for view `v_asset_request`
--
DROP TABLE IF EXISTS `v_asset_request`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_asset_request`  AS  select `ta`.`name` AS `asset_name`,`tg`.`timestamp` AS `timestamp`,`tg`.`device` AS `device`,`tg`.`os` AS `os`,`tg`.`country` AS `country`,`tg`.`lng` AS `lng`,`tg`.`lat` AS `lat`,`tg`.`user` AS `user`,`tg`.`email` AS `email`,`tg`.`mobile` AS `mobile`,`tg`.`type` AS `type`,`tg`.`is_deleted` AS `is_deleted`,`u`.`screen_name` AS `screen_name` from ((`tbl_gps` `tg` left join `tbl_asset` `ta` on(`ta`.`id` = `tg`.`asset_id`)) left join `users` `u` on(`u`.`users_id` = `ta`.`checkout_user_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_balance`
--
DROP TABLE IF EXISTS `v_balance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_balance`  AS  select `m`.`members_id` AS `members_id`,`lc`.`loan_computation_id` AS `loan_computation_id`,`lcc`.`loan_type_name` AS `loan_type_name`,`lc`.`ref_no` AS `ref_no`,`lc`.`col_period_start` AS `col_period_start`,`lc`.`col_period_end` AS `col_period_end`,`lc`.`amnt_of_loan` AS `amnt_of_loan`,`lscd`.`monthly_amortization` AS `mo_amortization`,`lscd`.`principal` AS `mo_principal`,`lscd`.`monthly_interest` AS `interest_per_mo`,sum(`lr`.`amnt_paid`) AS `tot_amount_paid`,sum(`lr`.`interest_paid`) AS `tot_interest_paid`,sum(`lscd`.`monthly_interest`) AS `tot_monthly_interest`,sum(`lscd`.`principal`) AS `tot_principal`,sum(`lscd`.`monthly_amortization`) AS `tot_mo_amortization`,(select `ls2`.`payment_schedule` from `loan_schedule` `ls2` where `ls2`.`loan_schedule_id` = min(`lr`.`loan_schedule_id`)) AS `first_date_of_paid`,(select `ls2`.`payment_schedule` from `loan_schedule` `ls2` where `ls2`.`loan_schedule_id` = max(`lr`.`loan_schedule_id`)) AS `last_date_of_paid`,min(`lr`.`loan_schedule_id`) AS `first_sched_id`,max(`lr`.`loan_schedule_id`) AS `last_sched_id`,`lcc`.`loan_type_name` AS `type`,`lc`.`is_approved` AS `is_approved`,`lc`.`is_posted` AS `is_posted`,`lc`.`is_deleted` AS `is_deleted`,`m`.`office_management_id` AS `office_management_id` from (((((`members` `m` left join `loan_computation` `lc` on(`lc`.`members_id` = `m`.`members_id`)) left join `loan_settings` `ls` on(`ls`.`loan_settings_id` = `lc`.`loan_settings_id`)) left join `loan_code` `lcc` on(`lcc`.`loan_code_id` = `ls`.`loan_code_id`)) left join `loan_schedule` `lscd` on(`lscd`.`loan_computation_id` = `lc`.`loan_computation_id`)) left join `loan_receipt` `lr` on(`lr`.`loan_schedule_id` = `lscd`.`loan_schedule_id`)) where `lc`.`loan_computation_id` is not null group by `lc`.`loan_computation_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_beneficiaries`
--
DROP TABLE IF EXISTS `v_beneficiaries`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_beneficiaries`  AS  select `b`.`beneficiaries_id` AS `beneficiaries_id`,`b`.`members_id` AS `members_id`,`rt`.`rel_type` AS `rel_type`,`m`.`last_name` AS `last_name`,`m`.`first_name` AS `first_name`,`b`.`name` AS `relationship_name`,`b`.`is_deleted` AS `is_deleted`,`b`.`entry_date` AS `entry_date`,`b`.`relationship_type_id` AS `relationship_type_id` from ((`beneficiaries` `b` left join `relationship_type` `rt` on(`rt`.`relationship_type_id` = `b`.`relationship_type_id`)) left join `members` `m` on(`m`.`members_id` = `b`.`members_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_benefit_claimed_by_member`
--
DROP TABLE IF EXISTS `v_benefit_claimed_by_member`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_benefit_claimed_by_member`  AS  select `cb`.`claimed_benefit_id` AS `claimed_benefit_id`,`cb`.`members_id` AS `members_id`,`cb`.`benefit_type_id` AS `benefit_type_id`,`cb`.`claim_date` AS `claim_date`,`cb`.`accum_contrib` AS `accum_contrib`,`cb`.`share` AS `share`,`cb`.`tot_share_contrib` AS `tot_share_contrib`,`cb`.`other_benefit` AS `other_benefit`,`cb`.`clmd_sickness` AS `clmd_sickness`,`cb`.`clmd_dif` AS `clmd_dif`,`cb`.`clmd_accident` AS `clmd_accident`,`cb`.`clmd_calamity` AS `clmd_calamity`,`cb`.`total_claim` AS `total_claim`,`cb`.`claim_all` AS `claim_all`,`cb`.`users_id` AS `users_id`,`cb`.`is_deleted` AS `is_deleted`,`cb`.`entry_date` AS `entry_date`,`cb`.`lri_from_loan_balance` AS `lri_from_loan_balance`,concat(`m`.`last_name`,', ',`m`.`first_name`,' ',`m`.`middle_name`) AS `name`,`m`.`id_no` AS `id_no`,`bt`.`type_of_benefit` AS `type_of_benefit`,`om`.`office_name` AS `office_name`,`dp`.`place` AS `place`,`m`.`retired_date` AS `retired_date` from ((((`claim_benefit` `cb` left join `members` `m` on(`m`.`members_id` = `cb`.`members_id`)) left join `benefit_type` `bt` on(`bt`.`benefit_type_id` = `cb`.`benefit_type_id`)) left join `office_management` `om` on(`m`.`office_management_id` = `om`.`office_management_id`)) left join `departments` `dp` on(`dp`.`departments_id` = `om`.`departments_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_bs_assets`
--
DROP TABLE IF EXISTS `v_bs_assets`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bs_assets`  AS  select `ac`.`class_code` AS `id`,`ac`.`class_desc` AS `parent_id`,`ac`.`class_code` AS `class_code`,`ac`.`class_desc` AS `class_desc`,NULL AS `group_code`,NULL AS `group_desc`,NULL AS `main_code`,NULL AS `main_desc`,NULL AS `code`,coalesce(`ac`.`is_deleted`,0) AS `is_deleted`,NULL AS `debit`,NULL AS `credit`,NULL AS `journal_date`,NULL AS `normal_bal` from ((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) where `ac`.`is_deleted` = 0 and `ac`.`class_code` = '10' union select `ag`.`group_code` AS `id`,`ag`.`group_desc` AS `parent_id`,NULL AS `class_code`,NULL AS `class_desc`,`ag`.`group_code` AS `group_code`,`ag`.`group_desc` AS `group_desc`,NULL AS `main_code`,NULL AS `main_desc`,NULL AS `code`,coalesce(`ag`.`is_deleted`,0) AS `is_deleted`,NULL AS `debit`,NULL AS `credit`,NULL AS `journal_date`,NULL AS `normal_bal` from ((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) where `ag`.`is_deleted` = 0 and `ac`.`class_code` = '10' union select `am`.`main_code` AS `id`,`am`.`main_desc` AS `parent_id`,NULL AS `class_code`,NULL AS `class_desc`,NULL AS `group_code`,NULL AS `group_desc`,`am`.`main_code` AS `main_code`,`am`.`main_desc` AS `main_desc`,`am`.`code` AS `code`,coalesce(`am`.`is_deleted`,0) AS `is_deleted`,coalesce(`jd`.`debit`,0) AS `debit`,coalesce(`jd`.`credit`,0) AS `credit`,`jm`.`journal_date` AS `journal_date`,`am`.`normal_bal` AS `normal_bal` from ((((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) left join `j_details` `jd` on(`jd`.`acct_code` = `am`.`code`)) left join `j_master` `jm` on(`jm`.`j_master_id` = `jd`.`j_master_id`)) where `am`.`is_deleted` = 0 and `ac`.`class_code` = '10' order by 1,2 ;

-- --------------------------------------------------------

--
-- Structure for view `v_bs_liabilities`
--
DROP TABLE IF EXISTS `v_bs_liabilities`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bs_liabilities`  AS  select `ac`.`class_code` AS `id`,`ac`.`class_desc` AS `parent_id`,`ac`.`class_code` AS `class_code`,`ac`.`class_desc` AS `class_desc`,NULL AS `group_code`,NULL AS `group_desc`,NULL AS `main_code`,NULL AS `main_desc`,NULL AS `code`,coalesce(`ac`.`is_deleted`,0) AS `is_deleted`,NULL AS `debit`,NULL AS `credit`,NULL AS `journal_date`,NULL AS `normal_bal` from ((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) where `ac`.`is_deleted` = 0 and `ac`.`class_code` = '20' union select `ag`.`group_code` AS `id`,`ag`.`group_desc` AS `parent_id`,NULL AS `class_code`,NULL AS `class_desc`,`ag`.`group_code` AS `group_code`,`ag`.`group_desc` AS `group_desc`,NULL AS `main_code`,NULL AS `main_desc`,NULL AS `code`,coalesce(`ag`.`is_deleted`,0) AS `is_deleted`,NULL AS `debit`,NULL AS `credit`,NULL AS `journal_date`,NULL AS `normal_bal` from ((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) where `ag`.`is_deleted` = 0 and `ac`.`class_code` = '20' union select `am`.`main_code` AS `id`,`am`.`main_desc` AS `parent_id`,NULL AS `class_code`,NULL AS `class_desc`,NULL AS `group_code`,NULL AS `group_desc`,`am`.`main_code` AS `main_code`,`am`.`main_desc` AS `main_desc`,`am`.`code` AS `code`,coalesce(`am`.`is_deleted`,0) AS `is_deleted`,coalesce(`jd`.`debit`,0) AS `debit`,coalesce(`jd`.`credit`,0) AS `credit`,`jm`.`journal_date` AS `journal_date`,`am`.`normal_bal` AS `normal_bal` from ((((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) left join `j_details` `jd` on(`jd`.`acct_code` = `am`.`code`)) left join `j_master` `jm` on(`jm`.`j_master_id` = `jd`.`j_master_id`)) where `am`.`is_deleted` = 0 and `ac`.`class_code` = '20' order by 1,2 ;

-- --------------------------------------------------------

--
-- Structure for view `v_cash_gift`
--
DROP TABLE IF EXISTS `v_cash_gift`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cash_gift`  AS  select `m`.`last_name` AS `last_name`,`m`.`first_name` AS `first_name`,`m`.`middle_name` AS `middle_name`,`m`.`date_of_effectivity` AS `date_of_effectivity`,`om`.`office_name` AS `office_name`,`cg`.`cash_gift_id` AS `cash_gift_id`,`cg`.`members_id` AS `members_id`,`cg`.`amount` AS `amount`,`cg`.`rate` AS `rate`,`cg`.`is_deleted` AS `is_deleted`,`cg`.`date_applied` AS `date_applied`,`cg`.`entry_date` AS `entry_date`,`cg`.`status` AS `status`,`cg`.`remarks` AS `remarks` from ((`members` `m` left join `cash_gift` `cg` on(`cg`.`members_id` = `m`.`members_id`)) left join `office_management` `om` on(`om`.`office_management_id` = `m`.`office_management_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_contribution_and_payments`
--
DROP TABLE IF EXISTS `v_contribution_and_payments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_contribution_and_payments`  AS  select `om`.`office_management_id` AS `ofc_id`,`om`.`office_name` AS `parent_ofc`,`om`.`office_name` AS `office_name`,NULL AS `parent_mem`,NULL AS `members_name`,NULL AS `monthly_salary`,NULL AS `cont_date`,NULL AS `deduction`,NULL AS `adjusted_amnt`,NULL AS `total_cont`,NULL AS `ref_no`,NULL AS `collection_period`,NULL AS `gpln`,NULL AS `emln`,NULL AS `slmv`,NULL AS `total`,NULL AS `total_deduction`,NULL AS `remarks`,NULL AS `date_applied` from ((((`members` `m` left join `office_management` `om` on(`m`.`office_management_id` = `om`.`office_management_id`)) left join `contributions` `cont` on(`cont`.`members_id` = `m`.`members_id`)) left join `loan_computation` `lc` on(`lc`.`members_id` = `m`.`members_id`)) left join `v_balance` `vb` on(`vb`.`loan_computation_id` = `lc`.`loan_computation_id`)) group by `lc`.`ref_no` union select `om`.`office_management_id` AS `ofc_id`,NULL AS `parent_ofc`,`om`.`office_name` AS `office_name`,concat(`m`.`last_name`,', ',`m`.`first_name`,' ',`m`.`middle_name`) AS `parent_mem`,concat(`m`.`last_name`,', ',`m`.`first_name`,' ',`m`.`middle_name`) AS `members_name`,NULL AS `monthly_salary`,NULL AS `cont_date`,NULL AS `deduction`,NULL AS `adjusted_amnt`,NULL AS `total_cont`,NULL AS `ref_no`,NULL AS `collection_period`,NULL AS `gpln`,NULL AS `emln`,NULL AS `slmv`,NULL AS `total`,NULL AS `total_deduction`,NULL AS `remarks`,NULL AS `date_applied` from ((((`members` `m` left join `office_management` `om` on(`m`.`office_management_id` = `om`.`office_management_id`)) left join `contributions` `cont` on(`cont`.`members_id` = `m`.`members_id`)) left join `loan_computation` `lc` on(`lc`.`members_id` = `m`.`members_id`)) left join `v_balance` `vb` on(`vb`.`loan_computation_id` = `lc`.`loan_computation_id`)) group by `lc`.`ref_no` union select `om`.`office_management_id` AS `ofc_id`,NULL AS `parent_ofc`,`om`.`office_name` AS `office_name`,concat(`m`.`last_name`,', ',`m`.`first_name`,' ',`m`.`middle_name`) AS `parent_mem`,NULL AS `members_name`,`m`.`monthly_salary` AS `monthly_salary`,date_format(`cont`.`date_applied`,'%Y-%m') AS `cont_date`,sum(coalesce(`cont`.`deduction`,0)) AS `deduction`,sum(coalesce(`cont`.`adjusted_amnt`,0)) AS `adjusted_amnt`,sum(coalesce(`cont`.`deduction`,0)) + sum(coalesce(`cont`.`adjusted_amnt`,0)) AS `total_cont`,`lc`.`ref_no` AS `ref_no`,concat(`vb`.`col_period_start`,' to ',`vb`.`col_period_end`) AS `collection_period`,case when `vb`.`loan_type_name` = 'GPLN' then `vb`.`tot_amount_paid` else 0 end AS `gpln`,case when `vb`.`loan_type_name` = 'EMLN' then `vb`.`tot_amount_paid` else 0 end AS `emln`,case when `vb`.`loan_type_name` = 'SLMV' then `vb`.`tot_amount_paid` else 0 end AS `slmv`,(case when `vb`.`loan_type_name` = 'GPLN' then `vb`.`tot_amount_paid` else 0 end) + (case when `vb`.`loan_type_name` = 'EMLN' then `vb`.`tot_amount_paid` else 0 end) + (case when `vb`.`loan_type_name` = 'SLMV' then `vb`.`tot_amount_paid` else 0 end) AS `total`,sum(coalesce(`cont`.`deduction`,0)) + sum(coalesce(`cont`.`adjusted_amnt`,0)) + case when `vb`.`loan_type_name` = 'GPLN' then coalesce(`vb`.`tot_amount_paid`,0) else 0 end + case when `vb`.`loan_type_name` = 'EMLN' then coalesce(`vb`.`tot_amount_paid`,0) else 0 end + case when `vb`.`loan_type_name` = 'SLMV' then coalesce(`vb`.`tot_amount_paid`,0) else 0 end AS `total_deduction`,max(`cont`.`remarks`) AS `remarks`,max(`cont`.`date_applied`) AS `date_applied` from ((((`members` `m` left join `office_management` `om` on(`m`.`office_management_id` = `om`.`office_management_id`)) left join `contributions` `cont` on(`cont`.`members_id` = `m`.`members_id`)) left join `loan_computation` `lc` on(`lc`.`members_id` = `m`.`members_id`)) left join `v_balance` `vb` on(`vb`.`loan_computation_id` = `lc`.`loan_computation_id`)) group by `lc`.`ref_no` union select `om`.`office_management_id` AS `ofc_id`,NULL AS `parent_ofc`,'TOTAL' AS `office_name`,NULL AS `parent_mem`,NULL AS `members_name`,NULL AS `monthly_salary`,NULL AS `cont_date`,sum(`cont`.`deduction`) AS `deduction`,sum(`cont`.`adjusted_amnt`) AS `adjusted_amnt`,sum(coalesce(`cont`.`deduction`,0)) + sum(coalesce(`cont`.`adjusted_amnt`,0)) AS `total_cont`,NULL AS `ref_no`,NULL AS `collection_period`,case when `vb`.`loan_type_name` = 'GPLN' then (select sum(coalesce(`vb2`.`tot_amount_paid`,0)) from `v_balance` `vb2` where `vb2`.`loan_type_name` = `vb`.`loan_type_name` and `vb2`.`office_management_id` = `m`.`office_management_id`) else 0 end AS `gpln`,case when `vb`.`loan_type_name` = 'EMLN' then (select sum(coalesce(`vb2`.`tot_amount_paid`,0)) from `v_balance` `vb2` where `vb2`.`loan_type_name` = `vb`.`loan_type_name` and `vb2`.`office_management_id` = `m`.`office_management_id`) else 0 end AS `emln`,case when `vb`.`loan_type_name` = 'SLMV' then (select sum(coalesce(`vb2`.`tot_amount_paid`,0)) from `v_balance` `vb2` where `vb2`.`loan_type_name` = `vb`.`loan_type_name` and `vb2`.`office_management_id` = `m`.`office_management_id`) else 0 end AS `slmv`,(select sum(coalesce(`vb2`.`tot_amount_paid`,0)) from `v_balance` `vb2` where `vb2`.`loan_type_name` = `vb`.`loan_type_name` and `vb2`.`office_management_id` = `m`.`office_management_id`) AS `total`,sum(coalesce(`cont`.`deduction`,0)) + sum(coalesce(`cont`.`adjusted_amnt`,0)) + (select sum(coalesce(`vb2`.`tot_amount_paid`,0)) from `v_balance` `vb2` where `vb2`.`loan_type_name` = `vb`.`loan_type_name` and `vb2`.`office_management_id` = `m`.`office_management_id`) AS `total_deduction`,NULL AS `remarks`,max(`cont`.`date_applied`) AS `date_applied` from ((((`members` `m` left join `office_management` `om` on(`m`.`office_management_id` = `om`.`office_management_id`)) left join `contributions` `cont` on(`cont`.`members_id` = `m`.`members_id`)) left join `loan_computation` `lc` on(`lc`.`members_id` = `m`.`members_id`)) left join `v_balance` `vb` on(`vb`.`loan_computation_id` = `lc`.`loan_computation_id`)) group by `om`.`office_management_id` order by 1,3,4 ;

-- --------------------------------------------------------

--
-- Structure for view `v_crj_report`
--
DROP TABLE IF EXISTS `v_crj_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_crj_report`  AS  select `jm`.`j_master_id` AS `j_master_id`,`jm`.`j_type_id` AS `j_type_id`,`jm`.`account_no` AS `account_no`,`jm`.`journal_ref` AS `journal_ref`,`jm`.`check_voucher_no` AS `check_voucher_no`,`jm`.`check_no` AS `check_no`,`jm`.`reference_no` AS `reference_no`,`jm`.`payee_type` AS `payee_type`,`jm`.`payee_members_id` AS `payee_members_id`,`jm`.`payee` AS `payee`,`jm`.`particulars` AS `particulars`,`jm`.`loan_computation_id` AS `loan_computation_id`,`jm`.`date_posted` AS `date_posted`,`jm`.`journal_date` AS `journal_date`,sum(case when `jd`.`acct_code` = '101' then coalesce(`jd`.`debit`,0) else 0 end) AS `cash_on_hand_debit`,sum(case when `jd`.`acct_code` = '102' then coalesce(`jd`.`debit`,0) else 0 end) AS `cash_in_bank_lbp_debit`,sum(case when `jd`.`acct_code` = '104' then coalesce(`jd`.`debit`,0) else 0 end) AS `cash_in_bank_mbtc_debit`,sum(case when `jd`.`acct_code` = '200' then coalesce(`jd`.`debit`,0) else 0 end) AS `deferred_credits_debit`,case when (`jd`.`subsidiary` <> '' and coalesce(`jd`.`debit`,0) > 0) then `am`.`main_desc` else NULL end AS `sundry_accounts_debit`,sum(case when `jd`.`subsidiary` <> '' then coalesce(`jd`.`debit`,0) else 0 end) AS `sundry_amount_debit`,sum(case when `jd`.`acct_code` = '101' then coalesce(`jd`.`credit`,0) else 0 end) AS `cash_on_hand_credit`,sum(case when `jd`.`acct_code` = '108' then coalesce(`jd`.`credit`,0) else 0 end) AS `loan_receivable_credit`,sum(case when `jd`.`acct_code` = '110' then coalesce(`jd`.`credit`,0) else 0 end) AS `interest_receivable_credit`,sum(case when `jd`.`acct_code` = '500' then coalesce(`jd`.`credit`,0) else 0 end) AS `interest_income_credit`,sum(case when `jd`.`acct_code` = '112' then coalesce(`jd`.`credit`,0) else 0 end) AS `due_from_psa_credit`,sum(case when `jd`.`acct_code` = '502' then coalesce(`jd`.`credit`,0) else 0 end) AS `donation_serv_allow_credit`,case when (`jd`.`subsidiary` <> '' and coalesce(`jd`.`credit`,0) > 0) then `am`.`main_desc` else NULL end AS `sundry_accounts_credit`,sum(case when `jd`.`subsidiary` <> '' then coalesce(`jd`.`credit`,0) else 0 end) AS `sundry_amount_credit` from (((`j_master` `jm` left join `j_details` `jd` on(`jd`.`j_master_id` = `jm`.`j_master_id`)) left join `account_subsidiary` `asb` on(`asb`.`sub_code` = `jd`.`subsidiary`)) left join `account_main` `am` on(`am`.`code` = `asb`.`code`)) where `jm`.`j_type_id` = 6 group by `jm`.`journal_ref` ;

-- --------------------------------------------------------

--
-- Structure for view `v_general_ledger`
--
DROP TABLE IF EXISTS `v_general_ledger`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_general_ledger`  AS  select `jm`.`journal_ref` AS `journal_ref`,`jm`.`particulars` AS `particulars`,sum(`jd`.`debit`) AS `debit`,sum(`jd`.`credit`) AS `credit`,case when `am`.`normal_bal` = 'Dr' then sum(`jd`.`debit`) - sum(`jd`.`credit`) else sum(`jd`.`credit`) - sum(`jd`.`debit`) end AS `balance`,`jm`.`date_posted` AS `date_posted`,`jm`.`is_deleted` AS `is_deleted` from ((((`j_master` `jm` left join `j_details` `jd` on(`jm`.`j_master_id` = `jd`.`j_master_id`)) left join `account_main` `am` on(`jd`.`acct_code` = `am`.`code`)) left join `account_groups` `ag` on(`ag`.`group_code` = `am`.`group_code`)) left join `account_classes` `ac` on(`ac`.`class_code` = `ag`.`class_code`)) where `am`.`is_deleted` = 0 and `jm`.`date_posted` is not null group by `jm`.`journal_ref` order by 1,2 ;

-- --------------------------------------------------------

--
-- Structure for view `v_history_logs`
--
DROP TABLE IF EXISTS `v_history_logs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_history_logs`  AS  select `th`.`id` AS `id`,`th`.`description` AS `description`,`ta`.`asset_tag` AS `asset_tag`,`u1`.`screen_name` AS `current_custodian`,`u2`.`screen_name` AS `previous_custodian`,`tl1`.`name` AS `current_location`,`tl2`.`name` AS `previous_location`,`th`.`created_at` AS `created_at`,`th`.`updated_at` AS `updated_at`,`th`.`is_deleted` AS `is_deleted` from (((((`tbl_history` `th` left join `tbl_asset` `ta` on(`ta`.`id` = `th`.`asset_id`)) left join `users` `u1` on(`u1`.`users_id` = `th`.`current_custodian_id`)) left join `users` `u2` on(`u2`.`users_id` = `th`.`previous_custodian_id`)) left join `tbl_locations` `tl1` on(`tl1`.`id` = `th`.`current_location_id`)) left join `tbl_locations` `tl2` on(`tl2`.`id` = `th`.`previous_location_id`)) order by `th`.`id` desc ;

-- --------------------------------------------------------

--
-- Structure for view `v_immediate_family`
--
DROP TABLE IF EXISTS `v_immediate_family`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_immediate_family`  AS  select `b`.`immediate_family_id` AS `immediate_family_id`,`b`.`members_id` AS `members_id`,`rt`.`rel_type` AS `rel_type`,`m`.`last_name` AS `last_name`,`m`.`first_name` AS `first_name`,`b`.`name` AS `relationship_name`,`b`.`is_deleted` AS `is_deleted`,`b`.`entry_date` AS `entry_date`,`b`.`relationship_type_id` AS `relationship_type_id` from ((`immediate_family` `b` left join `relationship_type` `rt` on(`rt`.`relationship_type_id` = `b`.`relationship_type_id`)) left join `members` `m` on(`m`.`members_id` = `b`.`members_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_is_income_expense`
--
DROP TABLE IF EXISTS `v_is_income_expense`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_is_income_expense`  AS  select `ac`.`class_code` AS `id`,`ac`.`class_desc` AS `parent_id`,`ac`.`class_code` AS `class_code`,`ac`.`class_desc` AS `class_desc`,NULL AS `group_code`,NULL AS `group_desc`,NULL AS `main_code`,NULL AS `main_desc`,NULL AS `code`,coalesce(`ac`.`is_deleted`,0) AS `is_deleted`,NULL AS `debit`,NULL AS `credit`,NULL AS `journal_date`,NULL AS `normal_bal` from ((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) where `ac`.`is_deleted` = 0 and `ac`.`class_code` = '30' union select `ag`.`group_code` AS `id`,`ag`.`group_desc` AS `parent_id`,NULL AS `class_code`,NULL AS `class_desc`,`ag`.`group_code` AS `group_code`,`ag`.`group_desc` AS `group_desc`,NULL AS `main_code`,NULL AS `main_desc`,NULL AS `code`,coalesce(`ag`.`is_deleted`,0) AS `is_deleted`,NULL AS `debit`,NULL AS `credit`,NULL AS `journal_date`,NULL AS `normal_bal` from ((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) where `ag`.`is_deleted` = 0 and `ac`.`class_code` = '30' union select `am`.`main_code` AS `id`,`am`.`main_desc` AS `parent_id`,NULL AS `class_code`,NULL AS `class_desc`,NULL AS `group_code`,NULL AS `group_desc`,`am`.`main_code` AS `main_code`,`am`.`main_desc` AS `main_desc`,`am`.`code` AS `code`,coalesce(`am`.`is_deleted`,0) AS `is_deleted`,coalesce(`jd`.`debit`,0) AS `debit`,coalesce(`jd`.`credit`,0) AS `credit`,`jm`.`journal_date` AS `journal_date`,`am`.`normal_bal` AS `normal_bal` from ((((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) left join `j_details` `jd` on(`jd`.`acct_code` = `am`.`code`)) left join `j_master` `jm` on(`jm`.`j_master_id` = `jd`.`j_master_id`)) where `am`.`is_deleted` = 0 and `ac`.`class_code` = '30' order by 1,2 ;

-- --------------------------------------------------------

--
-- Structure for view `v_loans_by_member`
--
DROP TABLE IF EXISTS `v_loans_by_member`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_loans_by_member`  AS  select `m`.`members_id` AS `members_id`,concat(ucase(`m`.`last_name`),', ',ucase(`m`.`first_name`),' ',ucase(`m`.`middle_name`)) AS `fname`,`lc`.`loan_computation_id` AS `loan_computation_id`,`lcc`.`loan_type_name` AS `type`,`lc`.`ref_no` AS `ref_no`,`lc`.`col_period_start` AS `col_period_start`,`lc`.`col_period_end` AS `col_period_end`,`lc`.`amnt_of_loan` AS `amnt_of_loan`,sum(`lr`.`amnt_paid`) AS `payment`,`lc`.`is_approved` AS `is_approved`,`lc`.`is_posted` AS `is_posted`,`lc`.`is_deleted` AS `is_deleted`,case when `lc`.`is_approved` = 1 then 'Approved' else 'Dispproved' end AS `is_approved_txt` from (((((`members` `m` left join `loan_computation` `lc` on(`lc`.`members_id` = `m`.`members_id`)) left join `loan_settings` `ls` on(`ls`.`loan_settings_id` = `lc`.`loan_settings_id`)) left join `loan_code` `lcc` on(`lcc`.`loan_code_id` = `ls`.`loan_code_id`)) left join `loan_schedule` `lscd` on(`lscd`.`loan_computation_id` = `lc`.`loan_computation_id`)) left join `loan_receipt` `lr` on(`lr`.`loan_schedule_id` = `lscd`.`loan_schedule_id`)) where `lc`.`loan_computation_id` is not null group by `lc`.`loan_computation_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_loans_list`
--
DROP TABLE IF EXISTS `v_loans_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_loans_list`  AS  select `lc`.`loan_computation_id` AS `loan_computation_id`,`m`.`members_id` AS `members_id`,`lc`.`ref_no` AS `ref_no`,`lc`.`date_processed` AS `date_processed`,concat(ucase(`m`.`last_name`),', ',ucase(`m`.`first_name`),' ',ucase(`m`.`middle_name`)) AS `fname`,`lc`.`is_approved` AS `is_approved`,`lc`.`is_posted` AS `is_posted`,`lc`.`is_deleted` AS `is_deleted`,case when `lc`.`is_approved` = 1 then 'Approved' else 'Dispproved' end AS `is_approved_txt` from (((`loan_computation` `lc` left join `loan_settings` `ls` on(`ls`.`loan_settings_id` = `lc`.`loan_settings_id`)) left join `loan_code` `lcc` on(`lcc`.`loan_code_id` = `ls`.`loan_code_id`)) left join `members` `m` on(`lc`.`members_id` = `m`.`members_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_loan_sched_choices`
--
DROP TABLE IF EXISTS `v_loan_sched_choices`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_loan_sched_choices`  AS  select `ls`.`loan_schedule_id` AS `loan_schedule_id`,`ls`.`loan_computation_id` AS `loan_computation_id`,`ls`.`payment_schedule` AS `payment_schedule`,`ls`.`monthly_amortization` AS `monthly_amortization`,`ls`.`principal` AS `principal`,`ls`.`monthly_interest` AS `monthly_interest`,`ls`.`is_deleted` AS `is_deleted`,`ls`.`entry_date` AS `entry_date`,sum(`lr`.`amnt_paid`) AS `amnt_paid`,sum(`lr`.`interest_paid`) AS `interest_paid` from (`loan_schedule` `ls` left join `loan_receipt` `lr` on(`lr`.`loan_schedule_id` = `ls`.`loan_schedule_id`)) group by `ls`.`loan_schedule_id` order by `ls`.`loan_schedule_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_loan_settings`
--
DROP TABLE IF EXISTS `v_loan_settings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_loan_settings`  AS  select `ls`.`loan_settings_id` AS `loan_settings_id`,`lt`.`loan_code` AS `loan_code`,`ls`.`monthly_interest` AS `monthly_interest`,`ls`.`number_of_month` AS `number_of_month`,`ls`.`repymnt_period` AS `repymnt_period`,`ls`.`svc` AS `svc`,`ls`.`lri` AS `lri`,`ls`.`int_per_annum` AS `int_per_annum`,`ls`.`entry_date` AS `entry_date`,`ls`.`is_deleted` AS `is_deleted` from (`loan_settings` `ls` left join `loan_code` `lt` on(`ls`.`loan_code_id` = `lt`.`loan_code_id`)) where `ls`.`is_deleted` = 0 ;

-- --------------------------------------------------------

--
-- Structure for view `v_members`
--
DROP TABLE IF EXISTS `v_members`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_members`  AS  select `m`.`members_id` AS `members_id`,`m`.`id_no` AS `id_no`,`m`.`last_name` AS `last_name`,`m`.`first_name` AS `first_name`,`m`.`middle_name` AS `middle_name`,`m`.`dob` AS `dob`,`m`.`address` AS `address`,`cs`.`status` AS `status`,`m`.`date_of_effectivity` AS `date_of_effectivity`,`m`.`designation` AS `designation`,`mt`.`type` AS `type`,`m`.`monthly_salary` AS `monthly_salary`,`om`.`office_name` AS `office_name`,`m`.`entry_date` AS `entry_date`,`m`.`bank_account` AS `bank_account`,`m`.`contact_no` AS `contact_no`,`m`.`is_deleted` AS `is_deleted`,`m`.`retired_date` AS `retired_date`,`bt`.`type_of_benefit` AS `type_of_benefit` from ((((`members` `m` left join `civil_status` `cs` on(`cs`.`civil_status_id` = `m`.`civil_status_id`)) left join `office_management` `om` on(`m`.`office_management_id` = `om`.`office_management_id`)) left join `member_type` `mt` on(`m`.`member_type_id` = `mt`.`member_type_id`)) left join `benefit_type` `bt` on(`bt`.`benefit_type_id` = `m`.`benefit_type`)) where `m`.`is_deleted` = 0 ;

-- --------------------------------------------------------

--
-- Structure for view `v_official_receipt`
--
DROP TABLE IF EXISTS `v_official_receipt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_official_receipt`  AS  select `orr`.`official_receipt_id` AS `official_receipt_id`,`orr`.`departments_id` AS `departments_id`,`orr`.`amount_type` AS `amount_type`,`orr`.`orno` AS `orno`,`orr`.`check_no` AS `check_no`,`orr`.`address` AS `address`,`orr`.`tin` AS `tin`,`orr`.`amount` AS `amount`,`orr`.`senior_citizen_tin` AS `senior_citizen_tin`,`orr`.`osca_pwd_citizen_tin` AS `osca_pwd_citizen_tin`,`orr`.`contribution` AS `contribution`,`orr`.`gpln` AS `gpln`,`orr`.`emln` AS `emln`,`orr`.`slmv` AS `slmv`,`orr`.`others` AS `others`,`orr`.`remarks` AS `remarks`,`orr`.`is_deleted` AS `is_deleted`,`orr`.`date_applied` AS `date_applied`,`orr`.`entry_date` AS `entry_date`,`orr`.`status` AS `status`,`orr`.`received_by` AS `received_by`,`orr`.`business_style` AS `business_style`,`orr`.`sc_pw_discount` AS `sc_pw_discount`,`orr`.`total_due` AS `total_due`,`orr`.`withholding_tax` AS `withholding_tax`,`orr`.`payment_due` AS `payment_due`,`orr`.`total` AS `total`,`d`.`region` AS `region`,`d`.`short` AS `short` from (`official_receipt` `orr` left join `departments` `d` on(`d`.`departments_id` = `orr`.`departments_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_pacs`
--
DROP TABLE IF EXISTS `v_pacs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pacs`  AS  select `jm`.`j_master_id` AS `j_master_id`,`jm`.`j_type_id` AS `j_type_id`,`m`.`bank_account` AS `account_no`,`jm`.`journal_ref` AS `journal_ref`,`jm`.`check_voucher_no` AS `check_voucher_no`,`jm`.`check_no` AS `check_no`,`jm`.`reference_no` AS `reference_no`,`jm`.`payee_type` AS `payee_type`,`jm`.`payee_members_id` AS `payee_members_id`,`jm`.`payee` AS `payee`,concat(`m`.`last_name`,', ',`m`.`first_name`,' ',`m`.`middle_name`) AS `payee_member`,`om`.`office_name` AS `official_station`,`lc`.`col_period_start` AS `col_period_start`,`lc`.`col_period_end` AS `col_period_end`,`lc`.`monthly_amortization` AS `monthly_amortization`,`jm`.`date_posted` AS `date_posted`,`jm`.`journal_date` AS `journal_date`,sum(case when `jd`.`acct_code` = '101' then coalesce(`jd`.`credit`,0) else 0 end) AS `cash_on_hand_credit`,sum(case when `jd`.`acct_code` = '102' then coalesce(`jd`.`credit`,0) else 0 end) AS `cash_in_bank_lbp_credit`,sum(case when `jd`.`acct_code` = '104' then coalesce(`jd`.`credit`,0) else 0 end) AS `cash_in_bank_mbtc_credit`,sum(case when `jd`.`acct_code` = '201' then coalesce(`jd`.`credit`,0) else 0 end) AS `unearned_interest_credit`,sum(case when `jd`.`acct_code` = '500' then coalesce(`jd`.`credit`,0) else 0 end) AS `interest_income_credit`,sum(case when `jd`.`acct_code` = '200' then coalesce(`jd`.`credit`,0) else 0 end) AS `deferred_credits_credit`,sum(case when `jd`.`acct_code` = '301' then coalesce(`jd`.`credit`,0) else 0 end) AS `lri_credit`,sum(case when `jd`.`acct_code` = '108' then coalesce(`jd`.`credit`,0) else 0 end) AS `loan_receivable_credit`,sum(case when `jd`.`acct_code` = '500' then coalesce(`jd`.`credit`,0) else 0 end) AS `interest_credit`,sum(case when `jd`.`acct_code` = '501' then coalesce(`jd`.`credit`,0) else 0 end) AS `service_charge_credit`,sum(case when `jd`.`acct_code` = '108' then coalesce(`jd`.`debit`,0) else 0 end) AS `loan_receivable_debit`,sum(case when `jd`.`acct_code` = '500' then coalesce(`jd`.`debit`,0) else 0 end) AS `interest_income_debit`,sum(case when `jd`.`acct_code` = '200' then coalesce(`jd`.`debit`,0) else 0 end) AS `deferred_credits_debit`,sum(case when `jd`.`acct_code` = '202' then coalesce(`jd`.`debit`,0) else 0 end) AS `benefit_claim_debit`,sum(case when `jd`.`acct_code` = '300' then coalesce(`jd`.`debit`,0) else 0 end) AS `members_contribution_debit`,case when (`jd`.`subsidiary` <> '' and coalesce(`jd`.`credit`,0) > 0) then `am`.`main_desc` else NULL end AS `sundry_accounts_credit`,sum(case when `jd`.`subsidiary` <> '' then coalesce(`jd`.`credit`,0) else 0 end) AS `sundry_amount_credit`,case when (`jd`.`subsidiary` <> '' and coalesce(`jd`.`debit`,0) > 0) then `am`.`main_desc` else NULL end AS `sundry_accounts_debit`,sum(case when `jd`.`subsidiary` <> '' then coalesce(`jd`.`debit`,0) else 0 end) AS `sundry_amount_debit`,group_concat(distinct concat(ucase(`m2`.`last_name`),', ',ucase(`m2`.`first_name`),' ',ucase(`m2`.`middle_name`)),'|' separator ',') AS `comaker`,`jm`.`particulars` AS `remarks` from ((((((((`j_master` `jm` left join `j_details` `jd` on(`jd`.`j_master_id` = `jm`.`j_master_id`)) left join `account_subsidiary` `asb` on(`asb`.`sub_code` = `jd`.`subsidiary`)) left join `account_main` `am` on(`am`.`code` = `asb`.`code`)) left join `loan_computation` `lc` on(`lc`.`ref_no` = `jm`.`reference_no`)) left join `members` `m` on(`m`.`members_id` = `lc`.`members_id`)) left join `office_management` `om` on(`om`.`office_management_id` = `m`.`office_management_id`)) left join `co_maker` `cmkr` on(`cmkr`.`members_id` = `m`.`members_id`)) left join `members` `m2` on(`m2`.`members_id` = `cmkr`.`co_maker_members_id`)) where `jm`.`j_type_id` = 4 group by `jm`.`journal_ref` ;

-- --------------------------------------------------------

--
-- Structure for view `v_portal_request`
--
DROP TABLE IF EXISTS `v_portal_request`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_portal_request`  AS  select `tr`.`tbl_asset_request_id` AS `tbl_asset_request_id`,`tr`.`office_management_id` AS `office_management_id`,`tr`.`asset_category_id` AS `asset_category_id`,`tr`.`qty` AS `qty`,`tr`.`location_id` AS `location_id`,`tr`.`other_location` AS `other_location`,`tr`.`users_id` AS `users_id`,`tr`.`purpose` AS `purpose`,`tr`.`remarks` AS `remarks`,`tr`.`is_deleted` AS `is_deleted`,`tr`.`entry_date` AS `entry_date`,`tr`.`date_need` AS `date_need`,`tr`.`date_return` AS `date_return`,`tr`.`status` AS `status`,`u2`.`screen_name` AS `approved_by`,`tr`.`approved_date` AS `approved_date`,`u3`.`screen_name` AS `disapproved_by`,`tr`.`disapproved_date` AS `disapproved_date`,`om`.`office_name` AS `office_name`,`ac`.`name` AS `category_name`,`tl`.`name` AS `location_name`,`u`.`screen_name` AS `screen_name` from ((((((`tbl_asset_request` `tr` left join `office_management` `om` on(`om`.`office_management_id` = `tr`.`office_management_id`)) left join `asset_category` `ac` on(`ac`.`asset_category_id` = `tr`.`asset_category_id`)) left join `tbl_locations` `tl` on(`tl`.`id` = `tr`.`location_id`)) left join `users` `u` on(`u`.`users_id` = `tr`.`users_id`)) left join `users` `u2` on(`u2`.`users_id` = `tr`.`approved_by`)) left join `users` `u3` on(`u3`.`users_id` = `tr`.`disapproved_by`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_repair_request`
--
DROP TABLE IF EXISTS `v_repair_request`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_repair_request`  AS  select `tar`.`id` AS `id`,`tar`.`serial` AS `serial`,`tar`.`asset_tag` AS `asset_tag`,`ac`.`name` AS `asset_category`,`ta`.`name` AS `asset_name`,`tar`.`property_tag` AS `property_tag`,`tar`.`tbl_child_asset_id` AS `tbl_child_asset_id`,`tar`.`regkits_no` AS `regkits_no`,`tar`.`custodian` AS `custodian`,`tar`.`date_reported` AS `date_reported`,`tar`.`problem_desc` AS `problem_desc`,`tar`.`file_upload` AS `file_upload`,`tar`.`image_upload` AS `image_upload`,`tar`.`remarks` AS `remarks`,`tar`.`is_deleted` AS `is_deleted`,`tar`.`entry_date` AS `entry_date`,`tar`.`status` AS `status`,`tar`.`approved_by` AS `approved_by`,`tar`.`approved_date` AS `approved_date`,`tar`.`disapproved_by` AS `disapproved_by`,`tar`.`disapproved_date` AS `disapproved_date`,`tar`.`requestor` AS `requestor`,`u1`.`screen_name` AS `custodian_name`,`u2`.`screen_name` AS `requestor_name`,`u3`.`screen_name` AS `approver_name`,`u3`.`screen_name` AS `disapprover_name` from ((((((`tbl_asset_repair_request` `tar` left join `tbl_asset` `ta` on(`ta`.`serial` = `tar`.`serial`)) left join `asset_category` `ac` on(`ac`.`asset_category_id` = `tar`.`asset_category_id`)) left join `users` `u1` on(`u1`.`users_id` = `tar`.`custodian`)) left join `users` `u2` on(`u2`.`users_id` = `tar`.`requestor`)) left join `users` `u3` on(`u3`.`users_id` = `tar`.`approved_by`)) left join `users` `u4` on(`u4`.`users_id` = `tar`.`disapproved_by`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_subsidiary`
--
DROP TABLE IF EXISTS `v_subsidiary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_subsidiary`  AS  select `asb`.`account_subsidiary_id` AS `account_subsidiary_id`,`asb`.`code` AS `code`,`asb`.`employee_id` AS `employee_id`,`asb`.`name` AS `name`,`asb`.`users_id` AS `users_id`,`asb`.`is_deleted` AS `is_deleted`,`asb`.`entry_date` AS `entry_date`,`am`.`main_desc` AS `main_desc`,`asb`.`sub_code` AS `sub_code` from (`account_subsidiary` `asb` left join `account_main` `am` on(`asb`.`code` = `am`.`code`)) where `am`.`is_deleted` = 0 ;

-- --------------------------------------------------------

--
-- Structure for view `v_trial_balance`
--
DROP TABLE IF EXISTS `v_trial_balance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_trial_balance`  AS  select `ac`.`class_code` AS `id`,`ac`.`class_desc` AS `parent_id`,`ac`.`class_code` AS `class_code`,`ac`.`class_desc` AS `class_desc`,NULL AS `group_code`,NULL AS `group_desc`,NULL AS `main_code`,NULL AS `main_desc`,NULL AS `code`,coalesce(`ac`.`is_deleted`,0) AS `is_deleted`,NULL AS `debit`,NULL AS `credit`,NULL AS `journal_date` from ((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) where `ac`.`is_deleted` = 0 union select `ag`.`group_code` AS `id`,`ag`.`group_desc` AS `parent_id`,NULL AS `class_code`,NULL AS `class_desc`,`ag`.`group_code` AS `group_code`,`ag`.`group_desc` AS `group_desc`,NULL AS `main_code`,NULL AS `main_desc`,NULL AS `code`,coalesce(`ag`.`is_deleted`,0) AS `is_deleted`,NULL AS `debit`,NULL AS `credit`,NULL AS `journal_date` from ((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) where `ag`.`is_deleted` = 0 union select `am`.`main_code` AS `id`,`am`.`main_desc` AS `parent_id`,NULL AS `class_code`,NULL AS `class_desc`,NULL AS `group_code`,NULL AS `group_desc`,`am`.`main_code` AS `main_code`,`am`.`main_desc` AS `main_desc`,`am`.`code` AS `code`,coalesce(`am`.`is_deleted`,0) AS `is_deleted`,`jd`.`debit` AS `debit`,`jd`.`credit` AS `credit`,`jm`.`journal_date` AS `journal_date` from ((((`account_classes` `ac` left join `account_groups` `ag` on(`ac`.`class_code` = `ag`.`class_code`)) left join `account_main` `am` on(`ag`.`group_code` = `am`.`group_code`)) left join `j_details` `jd` on(`jd`.`acct_code` = `am`.`code`)) left join `j_master` `jm` on(`jm`.`j_master_id` = `jd`.`j_master_id`)) where `am`.`is_deleted` = 0 order by 1,2 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_classes`
--
ALTER TABLE `account_classes`
  ADD PRIMARY KEY (`class_code`);

--
-- Indexes for table `account_main`
--
ALTER TABLE `account_main`
  ADD KEY `code` (`code`);

--
-- Indexes for table `account_subsidiary`
--
ALTER TABLE `account_subsidiary`
  ADD PRIMARY KEY (`account_subsidiary_id`),
  ADD KEY `accnt_main_code_rel_ibfk_1` (`code`);

--
-- Indexes for table `asset_category`
--
ALTER TABLE `asset_category`
  ADD PRIMARY KEY (`asset_category_id`);

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`beneficiaries_id`),
  ADD KEY `beneficiaries_rel_ibfk_1` (`relationship_type_id`),
  ADD KEY `beneficiaries_mem_ibfk_1` (`members_id`);

--
-- Indexes for table `benefit_settings`
--
ALTER TABLE `benefit_settings`
  ADD PRIMARY KEY (`benefit_settings_id`);

--
-- Indexes for table `benefit_type`
--
ALTER TABLE `benefit_type`
  ADD PRIMARY KEY (`benefit_type_id`);

--
-- Indexes for table `cash_gift`
--
ALTER TABLE `cash_gift`
  ADD PRIMARY KEY (`cash_gift_id`),
  ADD KEY `cash_gift_mid_ibfk_1` (`members_id`);

--
-- Indexes for table `civil_status`
--
ALTER TABLE `civil_status`
  ADD PRIMARY KEY (`civil_status_id`);

--
-- Indexes for table `claim_benefit`
--
ALTER TABLE `claim_benefit`
  ADD PRIMARY KEY (`claimed_benefit_id`),
  ADD KEY `claimed_benefit_mid_ibfk_1` (`members_id`),
  ADD KEY `claimed_benefit_bid_ibfk_1` (`benefit_type_id`);

--
-- Indexes for table `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`contributions_id`),
  ADD KEY `contributions_mid_ibfk_1` (`members_id`);

--
-- Indexes for table `contribution_rate`
--
ALTER TABLE `contribution_rate`
  ADD PRIMARY KEY (`contribution_rate_id`);

--
-- Indexes for table `co_maker`
--
ALTER TABLE `co_maker`
  ADD PRIMARY KEY (`co_maker_id`),
  ADD KEY `co_maker_memberidtmp_ibfk_1` (`members_id`),
  ADD KEY `co_maker_memberidtmp_ibfk_2` (`co_maker_members_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departments_id`);

--
-- Indexes for table `identifiers`
--
ALTER TABLE `identifiers`
  ADD PRIMARY KEY (`identifiers_id`);

--
-- Indexes for table `immediate_family`
--
ALTER TABLE `immediate_family`
  ADD PRIMARY KEY (`immediate_family_id`),
  ADD KEY `immediatefam_rel_ibfk_1` (`relationship_type_id`),
  ADD KEY `immediatefam_mem_ibfk_1` (`members_id`);

--
-- Indexes for table `j_details`
--
ALTER TABLE `j_details`
  ADD PRIMARY KEY (`j_details_id`),
  ADD KEY `j_master_rel_ibfk_1` (`j_master_id`);

--
-- Indexes for table `j_master`
--
ALTER TABLE `j_master`
  ADD PRIMARY KEY (`j_master_id`),
  ADD KEY `j_type_rel_ibfk_1` (`j_type_id`);

--
-- Indexes for table `j_type`
--
ALTER TABLE `j_type`
  ADD PRIMARY KEY (`j_type_id`);

--
-- Indexes for table `level_permission`
--
ALTER TABLE `level_permission`
  ADD PRIMARY KEY (`level_permission_id`);

--
-- Indexes for table `loan_code`
--
ALTER TABLE `loan_code`
  ADD PRIMARY KEY (`loan_code_id`);

--
-- Indexes for table `loan_computation`
--
ALTER TABLE `loan_computation`
  ADD PRIMARY KEY (`loan_computation_id`),
  ADD KEY `loan_mem_ibfk_1` (`members_id`),
  ADD KEY `loan_sett_ibfk_1` (`loan_settings_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `loan_receipt`
--
ALTER TABLE `loan_receipt`
  ADD PRIMARY KEY (`loan_receipt_id`),
  ADD KEY `loan_lsched_ibfk_1` (`loan_schedule_id`);

--
-- Indexes for table `loan_receipt_temp`
--
ALTER TABLE `loan_receipt_temp`
  ADD PRIMARY KEY (`loan_receipt_temp_id`),
  ADD KEY `loan_lschedtmp_ibfk_1` (`loan_schedule_id`);

--
-- Indexes for table `loan_schedule`
--
ALTER TABLE `loan_schedule`
  ADD PRIMARY KEY (`loan_schedule_id`),
  ADD KEY `loan_ls_comp_ibfk_1` (`loan_computation_id`);

--
-- Indexes for table `loan_settings`
--
ALTER TABLE `loan_settings`
  ADD PRIMARY KEY (`loan_settings_id`),
  ADD KEY `loan_settingsltloan_settings_idype_rel_ibfk_1` (`loan_code_id`);

--
-- Indexes for table `loan_types`
--
ALTER TABLE `loan_types`
  ADD PRIMARY KEY (`loan_types_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`members_id`),
  ADD KEY `membersciv_rel_ibfk_1` (`civil_status_id`),
  ADD KEY `membersofcmgmnt_rel_ibfk_1` (`office_management_id`),
  ADD KEY `membersmemtyp_rel_ibfk_1` (`member_type_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `member_type`
--
ALTER TABLE `member_type`
  ADD PRIMARY KEY (`member_type_id`);

--
-- Indexes for table `office_management`
--
ALTER TABLE `office_management`
  ADD PRIMARY KEY (`office_management_id`),
  ADD KEY `ofc_mgmnt_depid_fk_name` (`departments_id`);

--
-- Indexes for table `official_receipt`
--
ALTER TABLE `official_receipt`
  ADD PRIMARY KEY (`official_receipt_id`),
  ADD KEY `depts_id_ibfk_1` (`departments_id`);

--
-- Indexes for table `relationship_type`
--
ALTER TABLE `relationship_type`
  ADD PRIMARY KEY (`relationship_type_id`);

--
-- Indexes for table `signatory`
--
ALTER TABLE `signatory`
  ADD PRIMARY KEY (`signatory_id`);

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
-- Indexes for table `tbl_asset_repair_request`
--
ALTER TABLE `tbl_asset_repair_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_asset_request`
--
ALTER TABLE `tbl_asset_request`
  ADD PRIMARY KEY (`tbl_asset_request_id`);

--
-- Indexes for table `tbl_child_asset`
--
ALTER TABLE `tbl_child_asset`
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
  ADD KEY `assets_deleted_at_name_index` (`deleted_at`,`name`),
  ADD KEY `asset_child_id_ibfk_1` (`tbl_asset_id`);

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
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`uploads_id`),
  ADD KEY `members_id` (`members_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_subsidiary`
--
ALTER TABLE `account_subsidiary`
  MODIFY `account_subsidiary_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `asset_category`
--
ALTER TABLE `asset_category`
  MODIFY `asset_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `beneficiaries_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `benefit_settings`
--
ALTER TABLE `benefit_settings`
  MODIFY `benefit_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `benefit_type`
--
ALTER TABLE `benefit_type`
  MODIFY `benefit_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cash_gift`
--
ALTER TABLE `cash_gift`
  MODIFY `cash_gift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `civil_status`
--
ALTER TABLE `civil_status`
  MODIFY `civil_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `claim_benefit`
--
ALTER TABLE `claim_benefit`
  MODIFY `claimed_benefit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `contributions`
--
ALTER TABLE `contributions`
  MODIFY `contributions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `contribution_rate`
--
ALTER TABLE `contribution_rate`
  MODIFY `contribution_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `co_maker`
--
ALTER TABLE `co_maker`
  MODIFY `co_maker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `departments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `identifiers`
--
ALTER TABLE `identifiers`
  MODIFY `identifiers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `immediate_family`
--
ALTER TABLE `immediate_family`
  MODIFY `immediate_family_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `j_details`
--
ALTER TABLE `j_details`
  MODIFY `j_details_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `j_master`
--
ALTER TABLE `j_master`
  MODIFY `j_master_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `j_type`
--
ALTER TABLE `j_type`
  MODIFY `j_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `level_permission`
--
ALTER TABLE `level_permission`
  MODIFY `level_permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loan_code`
--
ALTER TABLE `loan_code`
  MODIFY `loan_code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan_computation`
--
ALTER TABLE `loan_computation`
  MODIFY `loan_computation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `loan_receipt`
--
ALTER TABLE `loan_receipt`
  MODIFY `loan_receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `loan_receipt_temp`
--
ALTER TABLE `loan_receipt_temp`
  MODIFY `loan_receipt_temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `loan_schedule`
--
ALTER TABLE `loan_schedule`
  MODIFY `loan_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=823;

--
-- AUTO_INCREMENT for table `loan_settings`
--
ALTER TABLE `loan_settings`
  MODIFY `loan_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loan_types`
--
ALTER TABLE `loan_types`
  MODIFY `loan_types_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member_type`
--
ALTER TABLE `member_type`
  MODIFY `member_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `office_management`
--
ALTER TABLE `office_management`
  MODIFY `office_management_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `official_receipt`
--
ALTER TABLE `official_receipt`
  MODIFY `official_receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `relationship_type`
--
ALTER TABLE `relationship_type`
  MODIFY `relationship_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `signatory`
--
ALTER TABLE `signatory`
  MODIFY `signatory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_action_logs`
--
ALTER TABLE `tbl_action_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_asset`
--
ALTER TABLE `tbl_asset`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_asset_repair_request`
--
ALTER TABLE `tbl_asset_repair_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_asset_request`
--
ALTER TABLE `tbl_asset_request`
  MODIFY `tbl_asset_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_child_asset`
--
ALTER TABLE `tbl_child_asset`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_companies`
--
ALTER TABLE `tbl_companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_gps`
--
ALTER TABLE `tbl_gps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `uploads_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `uploads_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_subsidiary`
--
ALTER TABLE `account_subsidiary`
  ADD CONSTRAINT `accnt_main_code_rel_ibfk_1` FOREIGN KEY (`code`) REFERENCES `account_main` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD CONSTRAINT `beneficiaries_mem_ibfk_1` FOREIGN KEY (`members_id`) REFERENCES `members` (`members_id`),
  ADD CONSTRAINT `beneficiaries_rel_ibfk_1` FOREIGN KEY (`relationship_type_id`) REFERENCES `relationship_type` (`relationship_type_id`);

--
-- Constraints for table `cash_gift`
--
ALTER TABLE `cash_gift`
  ADD CONSTRAINT `cash_gift_mid_ibfk_1` FOREIGN KEY (`members_id`) REFERENCES `members` (`members_id`) ON UPDATE CASCADE;

--
-- Constraints for table `claim_benefit`
--
ALTER TABLE `claim_benefit`
  ADD CONSTRAINT `claimed_benefit_bid_ibfk_1` FOREIGN KEY (`benefit_type_id`) REFERENCES `benefit_type` (`benefit_type_id`),
  ADD CONSTRAINT `claimed_benefit_mid_ibfk_1` FOREIGN KEY (`members_id`) REFERENCES `members` (`members_id`);

--
-- Constraints for table `contributions`
--
ALTER TABLE `contributions`
  ADD CONSTRAINT `contributions_mid_ibfk_1` FOREIGN KEY (`members_id`) REFERENCES `members` (`members_id`) ON UPDATE CASCADE;

--
-- Constraints for table `co_maker`
--
ALTER TABLE `co_maker`
  ADD CONSTRAINT `co_maker_memberidtmp_ibfk_1` FOREIGN KEY (`members_id`) REFERENCES `members` (`members_id`),
  ADD CONSTRAINT `co_maker_memberidtmp_ibfk_2` FOREIGN KEY (`co_maker_members_id`) REFERENCES `members` (`members_id`);

--
-- Constraints for table `immediate_family`
--
ALTER TABLE `immediate_family`
  ADD CONSTRAINT `immediatefam_mem_ibfk_1` FOREIGN KEY (`members_id`) REFERENCES `members` (`members_id`),
  ADD CONSTRAINT `immediatefam_rel_ibfk_1` FOREIGN KEY (`relationship_type_id`) REFERENCES `relationship_type` (`relationship_type_id`);

--
-- Constraints for table `j_details`
--
ALTER TABLE `j_details`
  ADD CONSTRAINT `j_master_rel_ibfk_1` FOREIGN KEY (`j_master_id`) REFERENCES `j_master` (`j_master_id`);

--
-- Constraints for table `j_master`
--
ALTER TABLE `j_master`
  ADD CONSTRAINT `j_type_rel_ibfk_1` FOREIGN KEY (`j_type_id`) REFERENCES `j_type` (`j_type_id`);

--
-- Constraints for table `loan_computation`
--
ALTER TABLE `loan_computation`
  ADD CONSTRAINT `loan_computation_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `loan_mem_ibfk_1` FOREIGN KEY (`members_id`) REFERENCES `members` (`members_id`),
  ADD CONSTRAINT `loan_sett_ibfk_1` FOREIGN KEY (`loan_settings_id`) REFERENCES `loan_settings` (`loan_settings_id`);

--
-- Constraints for table `loan_receipt`
--
ALTER TABLE `loan_receipt`
  ADD CONSTRAINT `loan_lsched_ibfk_1` FOREIGN KEY (`loan_schedule_id`) REFERENCES `loan_schedule` (`loan_schedule_id`);

--
-- Constraints for table `loan_receipt_temp`
--
ALTER TABLE `loan_receipt_temp`
  ADD CONSTRAINT `loan_lschedtmp_ibfk_1` FOREIGN KEY (`loan_schedule_id`) REFERENCES `loan_schedule` (`loan_schedule_id`);

--
-- Constraints for table `loan_schedule`
--
ALTER TABLE `loan_schedule`
  ADD CONSTRAINT `loan_ls_comp_ibfk_1` FOREIGN KEY (`loan_computation_id`) REFERENCES `loan_computation` (`loan_computation_id`);

--
-- Constraints for table `loan_settings`
--
ALTER TABLE `loan_settings`
  ADD CONSTRAINT `loan_settingsltloan_settings_idype_rel_ibfk_1` FOREIGN KEY (`loan_code_id`) REFERENCES `loan_code` (`loan_code_id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `membersciv_rel_ibfk_1` FOREIGN KEY (`civil_status_id`) REFERENCES `civil_status` (`civil_status_id`),
  ADD CONSTRAINT `membersmemtyp_rel_ibfk_1` FOREIGN KEY (`member_type_id`) REFERENCES `member_type` (`member_type_id`),
  ADD CONSTRAINT `membersofcmgmnt_rel_ibfk_1` FOREIGN KEY (`office_management_id`) REFERENCES `office_management` (`office_management_id`);

--
-- Constraints for table `office_management`
--
ALTER TABLE `office_management`
  ADD CONSTRAINT `ofc_mgmnt_depid_fk_name` FOREIGN KEY (`departments_id`) REFERENCES `departments` (`departments_id`) ON UPDATE CASCADE;

--
-- Constraints for table `official_receipt`
--
ALTER TABLE `official_receipt`
  ADD CONSTRAINT `depts_id_ibfk_1` FOREIGN KEY (`departments_id`) REFERENCES `departments` (`departments_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_child_asset`
--
ALTER TABLE `tbl_child_asset`
  ADD CONSTRAINT `asset_child_id_ibfk_1` FOREIGN KEY (`tbl_asset_id`) REFERENCES `tbl_asset` (`id`);

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`members_id`) REFERENCES `members` (`members_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
