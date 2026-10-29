-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 07, 2026 at 01:10 PM
-- Server version: 8.4.7
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_28_115317_create_personal_access_tokens_table', 1),
(5, '2026_03_30_054122_add_handshake_fields_to_users_table', 1),
(6, '2026_03_30_054502_create_tbl_register', 1),
(7, '2026_03_31_075535_create_tbl_employee_table', 1),
(8, '2026_03_31_075651_create_roles_table', 1),
(9, '2026_03_31_080727_add_role_to_users_table', 1),
(10, '2026_04_02_070919_add_phone_and_image_to_users_table', 1),
(11, '2026_04_02_113345_create_tbl_session_table', 1),
(12, '2026_04_02_114921_create_tbl_programme_table', 1),
(13, '2026_04_02_121959_add_created_by_updated_by_to_tbl_programme_table', 1),
(14, '2026_04_02_124208_create_tbl_technology_table', 1),
(15, '2026_04_02_130249_create_tbl_batch_table', 1),
(16, '2026_04_02_132510_create_tbl_subject_table', 1),
(17, '2026_04_03_053245_create_tbl_centers_table', 1),
(18, '2026_04_03_072559_create_tbl_branches_table', 1),
(19, '2026_04_03_114920_create_tbl_courses_table', 2),
(20, '2026_04_03_125152_add_approval_status_to_tbl_register_table', 3),
(21, '2026_04_03_130528_create_tbl_student_table', 4),
(22, '2026_04_04_052821_create_tbl_student_session_table', 5),
(23, '2026_04_04_052929_create_tbl_student_programme_table', 6),
(24, '2026_04_04_053002_create_tbl_student_technology_table', 7),
(25, '2026_04_04_053116_create_tbl_student_batch_table', 8),
(26, '2026_04_04_074253_add_center_id_to_tbl_student_table', 9),
(27, '2026_04_04_122107_add_is_block_to_users_table', 10),
(28, '2026_04_06_093245_alter_tbl_student_batch_add_shift_fields', 11),
(29, '2026_04_06_102046_create_tbl_employee', 12),
(30, '2026_04_06_000001_create_tbl_employee_table', 13),
(31, '2026_04_06_000002_create_tbl_employee_session_table', 13),
(32, '2026_04_06_000003_create_tbl_employee_programme_table', 13),
(33, '2026_04_06_000004_create_tbl_employee_technology_table', 13),
(34, '2026_04_06_000005_create_tbl_employee_batch_table', 13),
(35, '2026_04_06_112436_create_tbl_employee_table', 14),
(36, '2026_04_06_112604_create_tbl_employee_session_table', 14),
(37, '2026_04_06_112711_create_tbl_employee_programme_table', 15),
(38, '2026_04_06_112754_create_tbl_employee_technology_table', 15),
(39, '2026_04_06_112821_create_tbl_employee_batch_table', 15),
(40, '2026_04_06_113956_add_status_to_tbl_employee_table', 16),
(41, '2026_04_07_060239_create_tbl_programme_centers_table', 17),
(42, '2026_04_07_071638_create_tbl_session_programmes_table', 17),
(43, '2026_04_07_091752_add_soft_delete_columns_to_tbl_programme_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(4, 'student', '2026-04-03 07:23:51', '2026-04-03 07:23:51'),
(2, 'admin', '2026-04-03 07:23:26', '2026-04-04 01:28:43'),
(3, 'employee', '2026-04-03 07:23:31', '2026-04-03 07:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gLeMNxdRFMG1amS4WUlPiNxXpqxa4IaPOmsZnYT2', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoia05tZUJ1aVU5VHo0bFhBOU5LNFJmbmZSUXVDN09wN3JsSzd6REUzeSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvdmlldy1zdHVkZW50cyI7czo1OiJyb3V0ZSI7czoxODoiYWRtaW4udmlld3N0dWRlbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1775566872);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch`
--

DROP TABLE IF EXISTS `tbl_batch`;
CREATE TABLE IF NOT EXISTS `tbl_batch` (
  `batch_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` bigint UNSIGNED NOT NULL,
  `programme_id` bigint UNSIGNED NOT NULL,
  `technology_id` bigint UNSIGNED NOT NULL,
  `batch_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`batch_id`),
  UNIQUE KEY `uq_technology_batch_name` (`technology_id`,`batch_name`),
  KEY `tbl_batch_session_id_foreign` (`session_id`),
  KEY `tbl_batch_programme_id_foreign` (`programme_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_batch`
--

INSERT INTO `tbl_batch` (`batch_id`, `session_id`, `programme_id`, `technology_id`, `batch_name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Full-Stack 11', 'admin', 'admin', '2026-04-03 07:25:50', '2026-04-03 07:25:50'),
(2, 1, 1, 3, 'Full-Stack 5', 'admin', 'admin', '2026-04-03 07:26:07', '2026-04-03 07:26:07'),
(3, 1, 1, 2, 'Full-Stack 1', 'admin', 'admin', '2026-04-03 07:26:23', '2026-04-03 07:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branches`
--

DROP TABLE IF EXISTS `tbl_branches`;
CREATE TABLE IF NOT EXISTS `tbl_branches` (
  `branch_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` bigint UNSIGNED NOT NULL,
  `branch_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`branch_id`),
  KEY `tbl_branches_course_id_foreign` (`course_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_branches`
--

INSERT INTO `tbl_branches` (`branch_id`, `course_id`, `branch_name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'CSE', 'Admin', 'Admin', '2026-04-03 07:30:12', '2026-04-03 07:30:12'),
(2, 2, 'IT', 'Admin', 'Admin', '2026-04-03 07:30:21', '2026-04-03 07:30:21'),
(3, 1, 'CSE', 'Admin', 'Admin', '2026-04-03 07:30:29', '2026-04-03 07:30:29'),
(4, 1, 'IT', 'Admin', 'Admin', '2026-04-03 07:30:39', '2026-04-03 07:30:39'),
(5, 2, 'ME', 'Admin', 'Admin', '2026-04-03 07:30:48', '2026-04-03 07:30:48'),
(6, 2, 'ELx', 'Admin', 'Admin', '2026-04-03 07:30:56', '2026-04-03 07:30:56'),
(7, 2, 'Civil Engineering', 'Admin', 'Admin', '2026-04-03 07:31:15', '2026-04-03 07:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_centers`
--

DROP TABLE IF EXISTS `tbl_centers`;
CREATE TABLE IF NOT EXISTS `tbl_centers` (
  `center_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `center_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `radius` decimal(10,2) NOT NULL COMMENT 'Radius in meter',
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`center_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_centers`
--

INSERT INTO `tbl_centers` (`center_id`, `center_name`, `latitude`, `longitude`, `radius`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Softpro House', 26.9236100, 80.9647054, 100.00, 'Admin', 'Admin', '2026-04-03 07:29:21', '2026-04-03 07:29:21'),
(2, 'Softpro Noida', 26.9236100, 80.9647054, 10.00, 'Admin', 'Admin', '2026-04-07 01:12:35', '2026-04-07 01:12:35'),
(3, 'Full Stack Academy', 26.9236100, 80.9647054, 20.00, 'Admin', 'Admin', '2026-04-07 03:35:21', '2026-04-07 03:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courses`
--

DROP TABLE IF EXISTS `tbl_courses`;
CREATE TABLE IF NOT EXISTS `tbl_courses` (
  `course_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int NOT NULL COMMENT 'Duration in years',
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`course_id`, `course_name`, `duration`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Diploma', 2, 'Admin', 'Admin', '2026-04-03 07:29:48', '2026-04-03 23:20:07'),
(2, 'B. Tech.', 4, 'Admin', 'Admin', '2026-04-03 07:29:59', '2026-04-03 07:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

DROP TABLE IF EXISTS `tbl_employee`;
CREATE TABLE IF NOT EXISTS `tbl_employee` (
  `emp_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `emp_role` int NOT NULL DEFAULT '5',
  `emp_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_regid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `center_id` bigint UNSIGNED NOT NULL,
  `emp_mobile` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_password` text COLLATE utf8mb4_unicode_ci,
  `emp_gender` enum('Male','Female','Other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_type` enum('Internal','External') COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_pic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `del_status` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `is_block` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`emp_id`),
  UNIQUE KEY `tbl_employee_emp_regid_unique` (`emp_regid`),
  UNIQUE KEY `tbl_employee_emp_mobile_unique` (`emp_mobile`),
  UNIQUE KEY `tbl_employee_emp_email_unique` (`emp_email`),
  KEY `tbl_employee_center_id_index` (`center_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`emp_id`, `emp_role`, `emp_name`, `emp_regid`, `center_id`, `emp_mobile`, `emp_email`, `emp_password`, `emp_gender`, `emp_type`, `emp_pic`, `status`, `del_status`, `is_block`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 5, 'Aditya Pratap', 'Emp-101', 1, '8009423208', 'employee05@gmail.com', '$2y$12$XtEZdjlCIkMw2Gm2riEY4.lD/seHMRyZBkkIjnP918H8P1P69fi1u', 'Male', 'Internal', '1775475741_Screenshot_2025-12-11_164959.png', 1, 'N', 'N', 'Admin', 'Admin', '2026-04-06 06:11:56', '2026-04-06 07:51:33'),
(2, 5, 'Aditya Pratap', 'Emp-102', 1, '8009434652', 'adityapratap0567@gmail.com', '$2y$12$1YxSyPPHzcvi/ixyvOTBBOR1TWXJ6JYIWyaI5XX2zt3ZUKu8aMCcm', 'Male', 'External', '1775483286_WhatsApp_Image_2026-01-13_at_10.44.53_PM.jpeg', 1, 'N', 'N', 'Admin', 'Admin', '2026-04-06 08:18:07', '2026-04-06 08:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_batch`
--

DROP TABLE IF EXISTS `tbl_employee_batch`;
CREATE TABLE IF NOT EXISTS `tbl_employee_batch` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `emp_id` bigint UNSIGNED NOT NULL,
  `batch_id` bigint UNSIGNED NOT NULL,
  `is_active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_employee_batch_emp_id_batch_id_unique` (`emp_id`,`batch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_employee_batch`
--

INSERT INTO `tbl_employee_batch` (`id`, `emp_id`, `batch_id`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(7, 1, 1, 'Y', 'Admin', 'Admin', '2026-04-06 07:50:46', '2026-04-06 07:50:46'),
(8, 1, 2, 'Y', 'Admin', 'Admin', '2026-04-06 07:50:46', '2026-04-06 07:50:46'),
(9, 1, 3, 'Y', 'Admin', 'Admin', '2026-04-06 07:50:46', '2026-04-06 07:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_programme`
--

DROP TABLE IF EXISTS `tbl_employee_programme`;
CREATE TABLE IF NOT EXISTS `tbl_employee_programme` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `emp_id` bigint UNSIGNED NOT NULL,
  `programme_id` bigint UNSIGNED NOT NULL,
  `is_active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_employee_programme_emp_id_programme_id_unique` (`emp_id`,`programme_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_employee_programme`
--

INSERT INTO `tbl_employee_programme` (`id`, `emp_id`, `programme_id`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(5, 1, 1, 'Y', 'Admin', 'Admin', '2026-04-06 07:50:46', '2026-04-06 07:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_session`
--

DROP TABLE IF EXISTS `tbl_employee_session`;
CREATE TABLE IF NOT EXISTS `tbl_employee_session` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `emp_id` bigint UNSIGNED NOT NULL,
  `session_id` bigint UNSIGNED NOT NULL,
  `is_active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_employee_session_emp_id_session_id_unique` (`emp_id`,`session_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_employee_session`
--

INSERT INTO `tbl_employee_session` (`id`, `emp_id`, `session_id`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 'Y', 'Admin', 'Admin', '2026-04-06 07:50:46', '2026-04-06 07:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_technology`
--

DROP TABLE IF EXISTS `tbl_employee_technology`;
CREATE TABLE IF NOT EXISTS `tbl_employee_technology` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `emp_id` bigint UNSIGNED NOT NULL,
  `technology_id` bigint UNSIGNED NOT NULL,
  `is_active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_employee_technology_emp_id_technology_id_unique` (`emp_id`,`technology_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_employee_technology`
--

INSERT INTO `tbl_employee_technology` (`id`, `emp_id`, `technology_id`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(7, 1, 1, 'Y', 'Admin', 'Admin', '2026-04-06 07:50:46', '2026-04-06 07:50:46'),
(8, 1, 3, 'Y', 'Admin', 'Admin', '2026-04-06 07:50:46', '2026-04-06 07:50:46'),
(9, 1, 2, 'Y', 'Admin', 'Admin', '2026-04-06 07:50:46', '2026-04-06 07:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_programme`
--

DROP TABLE IF EXISTS `tbl_programme`;
CREATE TABLE IF NOT EXISTS `tbl_programme` (
  `programme_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` bigint UNSIGNED NOT NULL,
  `programme_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `restored_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`programme_id`),
  UNIQUE KEY `uq_programme_session_name` (`session_id`,`programme_name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_programme`
--

INSERT INTO `tbl_programme` (`programme_id`, `session_id`, `programme_name`, `duration`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Full-Stack Development', '6 Month', 'admin', 'admin', NULL, NULL, '2026-04-07 05:46:39', 'admin', '2026-04-03 07:24:40', '2026-04-07 05:46:39'),
(4, 1, 'Industrial Training', '1.5 Month', 'admin', 'admin', NULL, NULL, NULL, NULL, '2026-04-07 03:34:26', '2026-04-07 03:34:26'),
(5, 1, 'Web Technology', '6 Month', 'admin', 'admin', NULL, NULL, NULL, NULL, '2026-04-07 05:26:03', '2026-04-07 05:26:03'),
(6, 1, 'Summar Training', '1.5 Month', 'admin', 'admin', NULL, NULL, NULL, NULL, '2026-04-07 05:48:47', '2026-04-07 05:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_programme_centers`
--

DROP TABLE IF EXISTS `tbl_programme_centers`;
CREATE TABLE IF NOT EXISTS `tbl_programme_centers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` bigint UNSIGNED NOT NULL,
  `programme_id` bigint UNSIGNED NOT NULL,
  `center_id` bigint UNSIGNED NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_programme_center_session` (`session_id`,`programme_id`,`center_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_programme_centers`
--

INSERT INTO `tbl_programme_centers` (`id`, `session_id`, `programme_id`, `center_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(41, 1, 4, 1, 'Admin', 'Admin', '2026-04-07 05:47:01', '2026-04-07 05:47:01'),
(34, 1, 5, 3, 'Admin', 'Admin', '2026-04-07 05:26:18', '2026-04-07 05:26:18'),
(40, 1, 4, 3, 'Admin', 'Admin', '2026-04-07 05:47:01', '2026-04-07 05:47:01'),
(39, 1, 4, 2, 'Admin', 'Admin', '2026-04-07 05:46:28', '2026-04-07 05:46:28'),
(47, 1, 1, 3, 'Admin', 'Admin', '2026-04-07 05:47:30', '2026-04-07 05:47:30'),
(35, 1, 5, 1, 'Admin', 'Admin', '2026-04-07 05:26:18', '2026-04-07 05:26:18'),
(36, 1, 5, 2, 'Admin', 'Admin', '2026-04-07 05:26:18', '2026-04-07 05:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_register`
--

DROP TABLE IF EXISTS `tbl_register`;
CREATE TABLE IF NOT EXISTS `tbl_register` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_register_regno_unique` (`regno`),
  UNIQUE KEY `tbl_register_mobile_unique` (`mobile`),
  UNIQUE KEY `tbl_register_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_register`
--

INSERT INTO `tbl_register` (`id`, `name`, `college`, `regno`, `course`, `branch`, `year`, `mobile`, `email`, `password`, `gender`, `program`, `location`, `photo`, `approval_status`, `created_at`, `updated_at`) VALUES
(1, 'Aditya pratap Vishwakarma', 'CSJM GOVERNMENT POLYTECHNIC AMBEDKARNAGAR', '07390916220', '3', 'Computer Application', 'First Year', '7390916220', 'aditya@gmail.com', '$2y$12$tiPzlwd00E2kB5KqHqSOfeQ8J9sTLhqbmcdLeufEw4103VLDskgpe', 'male', '16', 'House', 'students/H1mTlx32c7YxYE9cdABFSNQwr9mjmXBjYaR0sqgj.jpg', 'Approved', '2026-04-04 05:57:24', '2026-04-04 05:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session`
--

DROP TABLE IF EXISTS `tbl_session`;
CREATE TABLE IF NOT EXISTS `tbl_session` (
  `session_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('old','current','upcomming') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'upcomming',
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`session_id`),
  UNIQUE KEY `tbl_session_session_name_unique` (`session_name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_session`
--

INSERT INTO `tbl_session` (`session_id`, `session_name`, `status`, `created_by`, `updated_by`) VALUES
(1, '2026-27', 'current', 'admin', 'admin'),
(2, '2025-26', 'old', 'admin', 'admin'),
(3, '2027-28', 'upcomming', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

DROP TABLE IF EXISTS `tbl_student`;
CREATE TABLE IF NOT EXISTS `tbl_student` (
  `stu_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `stu_role` bigint UNSIGNED NOT NULL DEFAULT '2',
  `stu_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stu_regid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stu_college` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `center_id` bigint UNSIGNED DEFAULT NULL,
  `stu_course` bigint UNSIGNED NOT NULL,
  `stu_course_year` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stu_branch` bigint UNSIGNED NOT NULL,
  `stu_mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stu_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stu_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stu_gender` enum('Male','Female','Other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `stu_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stu_pro` bigint UNSIGNED DEFAULT NULL,
  `stu_session` bigint UNSIGNED DEFAULT NULL,
  `del_status` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `is_block` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`stu_id`),
  UNIQUE KEY `tbl_student_stu_regid_unique` (`stu_regid`),
  UNIQUE KEY `tbl_student_stu_mobile_unique` (`stu_mobile`),
  UNIQUE KEY `tbl_student_stu_email_unique` (`stu_email`),
  KEY `tbl_student_stu_course_index` (`stu_course`),
  KEY `tbl_student_stu_branch_index` (`stu_branch`),
  KEY `tbl_student_stu_pro_index` (`stu_pro`),
  KEY `tbl_student_stu_session_index` (`stu_session`),
  KEY `tbl_student_del_status_index` (`del_status`),
  KEY `tbl_student_is_block_index` (`is_block`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`stu_id`, `stu_role`, `stu_name`, `stu_regid`, `stu_college`, `center_id`, `stu_course`, `stu_course_year`, `stu_branch`, `stu_mobile`, `stu_email`, `stu_password`, `stu_gender`, `stu_pic`, `stu_pro`, `stu_session`, `del_status`, `is_block`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(9, 4, 'Aditya pratap Vishwakarma', 'aditya-7390', 'CSJM Government Polytechnic Ambedkarnagar', 1, 1, '2nd Year', 3, '7390916222', 'adityapratap05072005@gmail.com', '$2y$12$q19SHtpBLq2G4o3UhML9s.hiJ2tLV0o7KjbjSJbn7ghfp/nTMBa52', 'Male', '1775458106_Screenshot_2025-12-01_000955.png', 1, 1, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:18:26', '2026-04-06 08:39:39'),
(10, 4, 'Priya Sharma', 'aditya-1004', 'Government Polytechnic Ayodhya', 1, 2, '2nd Year', 1, '8800000004', 'priya4@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(11, 4, 'Sneha Verma', 'aditya-1005', 'Government Polytechnic Prayagraj', 1, 2, '2nd Year', 1, '8800000005', 'sneha5@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(12, 4, 'Ankit Mishra', 'aditya-1006', 'CSJM Government Polytechnic Ambedkarnagar', 1, 2, '2nd Year', 1, '8800000006', 'ankit6@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(13, 4, 'Neha Gupta', 'aditya-1007', 'Government Polytechnic Lucknow', 1, 2, '2nd Year', 1, '8800000007', 'neha7@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(14, 4, 'Vikas Patel', 'aditya-1008', 'Government Polytechnic Kanpur', 1, 2, '2nd Year', 1, '8800000008', 'vikas8@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(15, 4, 'Pooja Kumari', 'aditya-1009', 'Government Polytechnic Ayodhya', 1, 2, '2nd Year', 1, '8800000009', 'pooja9@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(16, 4, 'Shivam Tiwari', 'aditya-1010', 'Government Polytechnic Prayagraj', 1, 2, '2nd Year', 1, '8800000010', 'shivam10@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(17, 4, 'Ritika Singh', 'aditya-1011', 'CSJM Government Polytechnic Ambedkarnagar', 1, 2, '2nd Year', 1, '8800000011', 'ritika11@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(18, 4, 'Ayush Srivastava', 'aditya-1012', 'Government Polytechnic Lucknow', 1, 2, '2nd Year', 1, '8800000012', 'ayush12@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(19, 4, 'Kajal Maurya', 'aditya-1013', 'Government Polytechnic Kanpur', 1, 2, '2nd Year', 1, '8800000013', 'kajal13@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(20, 4, 'Saurabh Pandey', 'aditya-1014', 'Government Polytechnic Ayodhya', 1, 2, '2nd Year', 1, '8800000014', 'saurabh14@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(21, 4, 'Nisha Yadav', 'aditya-1015', 'Government Polytechnic Prayagraj', 1, 2, '2nd Year', 1, '8800000015', 'nisha15@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(22, 4, 'Deepak Kumar', 'aditya-1016', 'CSJM Government Polytechnic Ambedkarnagar', 1, 2, '2nd Year', 1, '8800000016', 'deepak16@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(23, 4, 'Anjali Gupta', 'aditya-1017', 'Government Polytechnic Lucknow', 1, 2, '2nd Year', 1, '8800000017', 'anjali17@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(24, 4, 'Abhishek Singh', 'aditya-1018', 'Government Polytechnic Kanpur', 1, 2, '2nd Year', 1, '8800000018', 'abhishek18@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(25, 4, 'Komal Verma', 'aditya-1019', 'Government Polytechnic Ayodhya', 1, 2, '2nd Year', 1, '8800000019', 'komal19@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(26, 4, 'Harshita Mishra', 'aditya-1020', 'Government Polytechnic Prayagraj', 1, 2, '2nd Year', 1, '8800000020', 'harshita20@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(27, 4, 'Rahul Patel', 'aditya-1021', 'CSJM Government Polytechnic Ambedkarnagar', 1, 2, '2nd Year', 1, '8800000021', 'rahul21@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(28, 4, 'Swati Sharma', 'aditya-1022', 'Government Polytechnic Lucknow', 1, 2, '2nd Year', 1, '8800000022', 'swati22@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(29, 4, 'Manish Yadav', 'aditya-1023', 'Government Polytechnic Kanpur', 1, 2, '2nd Year', 1, '8800000023', 'manish23@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(30, 4, 'Aarti Singh', 'aditya-1024', 'Government Polytechnic Ayodhya', 1, 2, '2nd Year', 1, '8800000024', 'aarti24@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(31, 4, 'Gaurav Tiwari', 'aditya-1025', 'Government Polytechnic Prayagraj', 1, 2, '2nd Year', 1, '8800000025', 'gaurav25@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(32, 4, 'Muskan Gupta', 'aditya-1026', 'CSJM Government Polytechnic Ambedkarnagar', 1, 2, '2nd Year', 1, '8800000026', 'muskan26@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(33, 4, 'Vivek Kumar', 'aditya-1027', 'Government Polytechnic Lucknow', 1, 2, '2nd Year', 1, '8800000027', 'vivek27@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(34, 4, 'Payal Verma', 'aditya-1028', 'Government Polytechnic Kanpur', 1, 2, '2nd Year', 1, '8800000028', 'payal28@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(35, 4, 'Arjun Pandey', 'aditya-1029', 'Government Polytechnic Ayodhya', 1, 2, '2nd Year', 1, '8800000029', 'arjun29@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(36, 4, 'Simran Patel', 'aditya-1030', 'Government Polytechnic Prayagraj', 1, 2, '2nd Year', 1, '8800000030', 'simran30@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(37, 4, 'Sachin Maurya', 'aditya-1031', 'CSJM Government Polytechnic Ambedkarnagar', 1, 2, '2nd Year', 1, '8800000031', 'sachin31@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(38, 4, 'Monika Singh', 'aditya-1032', 'Government Polytechnic Lucknow', 1, 2, '2nd Year', 1, '8800000032', 'monika32@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(39, 4, 'Nitin Sharma', 'aditya-1033', 'Government Polytechnic Kanpur', 1, 2, '2nd Year', 1, '8800000033', 'nitin33@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(40, 4, 'Riya Yadav', 'aditya-1034', 'Government Polytechnic Ayodhya', 1, 2, '2nd Year', 1, '8800000034', 'riya34@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(41, 4, 'Prashant Mishra', 'aditya-1035', 'Government Polytechnic Prayagraj', 1, 2, '2nd Year', 1, '8800000035', 'prashant35@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(42, 4, 'Akash Gupta', 'aditya-1036', 'CSJM Government Polytechnic Ambedkarnagar', 1, 2, '2nd Year', 1, '8800000036', 'akash36@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(43, 4, 'Shreya Singh', 'aditya-1037', 'Government Polytechnic Lucknow', 1, 2, '2nd Year', 1, '8800000037', 'shreya37@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(44, 4, 'Mohit Verma', 'aditya-1038', 'Government Polytechnic Kanpur', 1, 2, '2nd Year', 1, '8800000038', 'mohit38@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(45, 4, 'Tanya Patel', 'aditya-1039', 'Government Polytechnic Ayodhya', 1, 2, '2nd Year', 1, '8800000039', 'tanya39@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(46, 4, 'Varun Kumar', 'aditya-1040', 'Government Polytechnic Prayagraj', 1, 2, '2nd Year', 1, '8800000040', 'varun40@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(47, 4, 'Kirti Sharma', 'aditya-1041', 'CSJM Government Polytechnic Ambedkarnagar', 1, 2, '2nd Year', 1, '8800000041', 'kirti41@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:49:38'),
(48, 4, 'Naveen Yadav', 'aditya-1042', 'Government Polytechnic Lucknow', 1, 2, '2nd Year', 1, '8800000042', 'naveen42@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(49, 4, 'Ishita Singh', 'aditya-1043', 'Government Polytechnic Kanpur', 1, 2, '2nd Year', 1, '8800000043', 'ishita43@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(50, 4, 'Karan Gupta user', 'aditya-1044', 'Government Polytechnic Ayodhya', 1, 2, '2nd Year', 1, '8800000044', 'karan44@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, 1, 1, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 04:27:02'),
(51, 4, 'Sakshi Verma', 'aditya-1045', 'Government Polytechnic Prayagraj', 1, 2, '2nd Year', 1, '8800000045', 'sakshi45@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(52, 4, 'Yash Patel', 'aditya-1046', 'CSJM Government Polytechnic Ambedkarnagar', 1, 2, '2nd Year', 1, '8800000046', 'yash46@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 02:27:07'),
(53, 4, 'Divya Mishra', 'aditya-1047', 'Government Polytechnic Lucknow', 1, 2, '2nd Year', 1, '8800000047', 'divya47@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', NULL, 1, 1, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 08:39:46'),
(54, 4, 'Ujjwal Kumar', 'aditya-1048', 'Government Polytechnic Kanpur', 1, 2, '2nd Year', 1, '8800000048', 'ujjwal48@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', NULL, NULL, NULL, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 08:39:44'),
(55, 4, 'Megha Singh', 'aditya-1049', 'Government Polytechnic Ayodhya', 1, 2, '2nd Year', 1, '8800000049', 'megha49@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Female', '1775466929_Screenshot_2026-01-05_000522.png', 1, 1, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 03:45:29'),
(56, 4, 'Anurag Tiwari User', 'aditya-1050', 'Government Polytechnic Prayagraj', 1, 2, '2nd Year', 1, '8800000050', 'anurag50@example.com', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', 'Male', '1775466694_project.png', 1, 1, 'N', 'N', 'Admin', 'Admin', '2026-04-06 01:26:52', '2026-04-06 08:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_batch`
--

DROP TABLE IF EXISTS `tbl_student_batch`;
CREATE TABLE IF NOT EXISTS `tbl_student_batch` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `stu_id` bigint UNSIGNED NOT NULL,
  `batch_id` bigint UNSIGNED NOT NULL,
  `is_active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `assigned_at` datetime DEFAULT NULL,
  `removed_at` datetime DEFAULT NULL,
  `shift_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_student_batch` (`stu_id`,`batch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_student_batch`
--

INSERT INTO `tbl_student_batch` (`id`, `stu_id`, `batch_id`, `is_active`, `assigned_at`, `removed_at`, `shift_reason`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(20, 3, 1, 'Y', NULL, NULL, NULL, 'Admin', 'Admin', '2026-04-04 00:28:01', '2026-04-04 00:28:01'),
(9, 1, 2, 'Y', NULL, NULL, NULL, 'Admin', 'Admin', '2026-04-04 00:12:37', '2026-04-04 00:12:37'),
(19, 3, 3, 'Y', NULL, NULL, NULL, 'Admin', 'Admin', '2026-04-04 00:28:01', '2026-04-04 00:28:01'),
(21, 3, 2, 'Y', NULL, NULL, NULL, 'Admin', 'Admin', '2026-04-04 00:28:01', '2026-04-04 00:28:01'),
(31, 5, 1, 'Y', NULL, NULL, NULL, 'Admin', 'Admin', '2026-04-04 05:29:31', '2026-04-04 05:29:31'),
(32, 5, 2, 'Y', NULL, NULL, NULL, 'Admin', 'Admin', '2026-04-04 05:29:31', '2026-04-04 05:29:31'),
(33, 5, 3, 'Y', NULL, NULL, NULL, 'Admin', 'Admin', '2026-04-04 05:29:31', '2026-04-04 05:29:31'),
(45, 56, 1, 'Y', NULL, NULL, NULL, 'Admin', 'Admin', '2026-04-06 08:39:57', '2026-04-06 08:39:57'),
(38, 6, 3, 'Y', NULL, NULL, NULL, 'Admin', 'Admin', '2026-04-04 06:12:08', '2026-04-04 06:12:08'),
(41, 55, 1, 'Y', NULL, NULL, NULL, 'Admin', 'Admin', '2026-04-06 03:11:44', '2026-04-06 03:11:44'),
(43, 53, 2, 'Y', NULL, NULL, NULL, 'Admin', 'Admin', '2026-04-06 03:45:51', '2026-04-06 03:45:51'),
(44, 50, 1, 'Y', NULL, NULL, NULL, 'Admin', 'Admin', '2026-04-06 04:27:02', '2026-04-06 04:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_programme`
--

DROP TABLE IF EXISTS `tbl_student_programme`;
CREATE TABLE IF NOT EXISTS `tbl_student_programme` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `stu_id` bigint UNSIGNED NOT NULL,
  `programme_id` bigint UNSIGNED NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_student_programme` (`stu_id`,`programme_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_student_programme`
--

INSERT INTO `tbl_student_programme` (`id`, `stu_id`, `programme_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(5, 1, 1, 'Admin', 'Admin', '2026-04-04 00:12:37', '2026-04-04 00:12:37'),
(6, 3, 1, 'Admin', 'Admin', '2026-04-04 00:28:01', '2026-04-04 00:28:01'),
(14, 5, 1, 'Admin', 'Admin', '2026-04-04 05:29:31', '2026-04-04 05:29:31'),
(19, 6, 1, 'Admin', 'Admin', '2026-04-04 06:12:08', '2026-04-04 06:12:08'),
(39, 56, 1, 'Admin', 'Admin', '2026-04-06 08:39:57', '2026-04-06 08:39:57'),
(35, 55, 1, 'Admin', 'Admin', '2026-04-06 03:45:29', '2026-04-06 03:45:29'),
(37, 53, 1, 'Admin', 'Admin', '2026-04-06 03:46:02', '2026-04-06 03:46:02'),
(38, 50, 1, 'Admin', 'Admin', '2026-04-06 04:27:02', '2026-04-06 04:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_session`
--

DROP TABLE IF EXISTS `tbl_student_session`;
CREATE TABLE IF NOT EXISTS `tbl_student_session` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `stu_id` bigint UNSIGNED NOT NULL,
  `session_id` bigint UNSIGNED NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_student_session` (`stu_id`,`session_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_student_session`
--

INSERT INTO `tbl_student_session` (`id`, `stu_id`, `session_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(14, 1, 2, 'Admin', 'Admin', '2026-04-04 00:12:37', '2026-04-04 00:12:37'),
(13, 1, 3, 'Admin', 'Admin', '2026-04-04 00:12:37', '2026-04-04 00:12:37'),
(12, 1, 1, 'Admin', 'Admin', '2026-04-04 00:12:37', '2026-04-04 00:12:37'),
(21, 3, 1, 'Admin', 'Admin', '2026-04-04 00:28:01', '2026-04-04 00:28:01'),
(22, 3, 3, 'Admin', 'Admin', '2026-04-04 00:28:01', '2026-04-04 00:28:01'),
(23, 3, 2, 'Admin', 'Admin', '2026-04-04 00:28:01', '2026-04-04 00:28:01'),
(39, 5, 1, 'Admin', 'Admin', '2026-04-04 05:29:31', '2026-04-04 05:29:31'),
(44, 6, 1, 'Admin', 'Admin', '2026-04-04 06:12:08', '2026-04-04 06:12:08'),
(55, 56, 1, 'Admin', 'Admin', '2026-04-06 08:39:57', '2026-04-06 08:39:57'),
(49, 55, 1, 'Admin', 'Admin', '2026-04-06 03:11:44', '2026-04-06 03:11:44'),
(53, 53, 1, 'Admin', 'Admin', '2026-04-06 03:45:51', '2026-04-06 03:45:51'),
(54, 50, 1, 'Admin', 'Admin', '2026-04-06 04:27:02', '2026-04-06 04:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_technology`
--

DROP TABLE IF EXISTS `tbl_student_technology`;
CREATE TABLE IF NOT EXISTS `tbl_student_technology` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `stu_id` bigint UNSIGNED NOT NULL,
  `technology_id` bigint UNSIGNED NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_student_technology` (`stu_id`,`technology_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_student_technology`
--

INSERT INTO `tbl_student_technology` (`id`, `stu_id`, `technology_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(9, 1, 1, 'Admin', 'Admin', '2026-04-04 00:12:37', '2026-04-04 00:12:37'),
(10, 1, 3, 'Admin', 'Admin', '2026-04-04 00:12:37', '2026-04-04 00:12:37'),
(17, 3, 1, 'Admin', 'Admin', '2026-04-04 00:28:01', '2026-04-04 00:28:01'),
(18, 3, 3, 'Admin', 'Admin', '2026-04-04 00:28:01', '2026-04-04 00:28:01'),
(19, 3, 2, 'Admin', 'Admin', '2026-04-04 00:28:01', '2026-04-04 00:28:01'),
(29, 5, 1, 'Admin', 'Admin', '2026-04-04 05:29:31', '2026-04-04 05:29:31'),
(30, 5, 3, 'Admin', 'Admin', '2026-04-04 05:29:31', '2026-04-04 05:29:31'),
(31, 5, 2, 'Admin', 'Admin', '2026-04-04 05:29:31', '2026-04-04 05:29:31'),
(43, 56, 1, 'Admin', 'Admin', '2026-04-06 08:39:57', '2026-04-06 08:39:57'),
(36, 6, 2, 'Admin', 'Admin', '2026-04-04 06:12:08', '2026-04-04 06:12:08'),
(39, 55, 1, 'Admin', 'Admin', '2026-04-06 03:11:44', '2026-04-06 03:11:44'),
(41, 53, 3, 'Admin', 'Admin', '2026-04-06 03:45:51', '2026-04-06 03:45:51'),
(42, 50, 1, 'Admin', 'Admin', '2026-04-06 04:27:02', '2026-04-06 04:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

DROP TABLE IF EXISTS `tbl_subject`;
CREATE TABLE IF NOT EXISTS `tbl_subject` (
  `subject_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `syllabus` longtext COLLATE utf8mb4_unicode_ci,
  `subject_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`subject_id`, `subject_name`, `syllabus`, `subject_image`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'PHP', '<p>ith the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p><br>&nbsp;</p><h2>Where does it come from?</h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><h2>Where can I get some?</h2><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which loo</p>', '1775221139_Screenshot_2026-03-19_233655.png', 'admin', 'admin', '2026-04-03 07:28:59', '2026-04-03 07:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_technology`
--

DROP TABLE IF EXISTS `tbl_technology`;
CREATE TABLE IF NOT EXISTS `tbl_technology` (
  `technology_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` bigint UNSIGNED NOT NULL,
  `programme_id` bigint UNSIGNED NOT NULL,
  `technology_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `technology_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`technology_id`),
  UNIQUE KEY `uq_programme_technology_name` (`programme_id`,`technology_name`),
  KEY `tbl_technology_session_id_foreign` (`session_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_technology`
--

INSERT INTO `tbl_technology` (`technology_id`, `session_id`, `programme_id`, `technology_name`, `technology_image`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Java Technology', '1775220897_project.png', 'admin', 'admin', '2026-04-03 07:24:57', '2026-04-03 07:24:57'),
(2, 1, 1, 'Pyhton Technology', '1775220918_Screenshot_2025-12-01_000955.png', 'admin', 'admin', '2026-04-03 07:25:18', '2026-04-03 07:25:18'),
(3, 1, 1, 'PHP Technology', '1775220936_migration.png', 'admin', 'admin', '2026-04-03 07:25:36', '2026-04-03 07:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `is_block` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `is_block`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(12, 'Aman Kumar Yadav', 'aman2@example.com', '8800000002', 'student', 'N', '2026-04-06 01:23:07', '$2y$12$hPl34PPymrlOurBaF1EmCeBqIFmHUUOQpCsIA5Lo9bEU0yXgBjFKi', NULL, NULL, '2026-04-06 01:23:07', '2026-04-06 01:23:07'),
(10, 'Aditya pratap Vishwakarma', 'adityapratap05072005@gmail.com', '7390916222', 'student', 'N', '2026-04-06 01:18:26', '$2y$12$q19SHtpBLq2G4o3UhML9s.hiJ2tLV0o7KjbjSJbn7ghfp/nTMBa52', '1775458106_Screenshot_2025-12-01_000955.png', NULL, '2026-04-06 01:18:26', '2026-04-06 08:39:39'),
(11, 'Aditya Pratap Vishwakarma', 'aditya1@example.com', '8800000001', 'student', 'N', '2026-04-06 01:21:54', '$2y$12$tQCqqkSvJXCFsFgT5JqNL.2VY37Jechq.pUonG1FdhAoOSgf7I3NG', NULL, NULL, '2026-04-06 01:21:54', '2026-04-06 01:21:54'),
(6, 'Admin', 'admin@gmail.com', '7390916220', 'admin', 'N', '0000-00-00 00:00:00', '$2y$12$zv8ICBQX.LUvHF3k2sWolO9PklBV83ZolkhXXoI8TGqHDo7x9iYm.', 'NULL', '7pUF5ZFCdKSIQEXm9KRxYiWEDAqBJvjWxRxL0Mx7ZZVAgkGvVL9C0nWiPL3l', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Rohit Singh', 'rohit3@example.com', '8800000003', 'student', 'N', '2026-04-06 01:23:56', '$2y$12$5AX10oZD/n2rgHLu2dSMVOSELs1lVx3/LrLAStN33x22x189i8e1y', NULL, NULL, '2026-04-06 01:23:56', '2026-04-06 01:23:56'),
(14, 'Priya Sharma', 'priya4@example.com', '8800000004', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(15, 'Sneha Verma', 'sneha5@example.com', '8800000005', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(16, 'Ankit Mishra', 'ankit6@example.com', '8800000006', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(17, 'Neha Gupta', 'neha7@example.com', '8800000007', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(18, 'Vikas Patel', 'vikas8@example.com', '8800000008', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(19, 'Pooja Kumari', 'pooja9@example.com', '8800000009', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(20, 'Shivam Tiwari', 'shivam10@example.com', '8800000010', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(21, 'Ritika Singh', 'ritika11@example.com', '8800000011', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(22, 'Ayush Srivastava', 'ayush12@example.com', '8800000012', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(23, 'Kajal Maurya', 'kajal13@example.com', '8800000013', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(24, 'Saurabh Pandey', 'saurabh14@example.com', '8800000014', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(25, 'Nisha Yadav', 'nisha15@example.com', '8800000015', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(26, 'Deepak Kumar', 'deepak16@example.com', '8800000016', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(27, 'Anjali Gupta', 'anjali17@example.com', '8800000017', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(28, 'Abhishek Singh', 'abhishek18@example.com', '8800000018', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(29, 'Komal Verma', 'komal19@example.com', '8800000019', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(30, 'Harshita Mishra', 'harshita20@example.com', '8800000020', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(31, 'Rahul Patel', 'rahul21@example.com', '8800000021', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(32, 'Swati Sharma', 'swati22@example.com', '8800000022', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(33, 'Manish Yadav', 'manish23@example.com', '8800000023', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(34, 'Aarti Singh', 'aarti24@example.com', '8800000024', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(35, 'Gaurav Tiwari', 'gaurav25@example.com', '8800000025', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(36, 'Muskan Gupta', 'muskan26@example.com', '8800000026', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(37, 'Vivek Kumar', 'vivek27@example.com', '8800000027', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(38, 'Payal Verma', 'payal28@example.com', '8800000028', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(39, 'Arjun Pandey', 'arjun29@example.com', '8800000029', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(40, 'Simran Patel', 'simran30@example.com', '8800000030', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(41, 'Sachin Maurya', 'sachin31@example.com', '8800000031', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(42, 'Monika Singh', 'monika32@example.com', '8800000032', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(43, 'Nitin Sharma', 'nitin33@example.com', '8800000033', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(44, 'Riya Yadav', 'riya34@example.com', '8800000034', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(45, 'Prashant Mishra', 'prashant35@example.com', '8800000035', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(46, 'Akash Gupta', 'akash36@example.com', '8800000036', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(47, 'Shreya Singh', 'shreya37@example.com', '8800000037', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(48, 'Mohit Verma', 'mohit38@example.com', '8800000038', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(49, 'Tanya Patel', 'tanya39@example.com', '8800000039', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(50, 'Varun Kumar', 'varun40@example.com', '8800000040', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(51, 'Kirti Sharma', 'kirti41@example.com', '8800000041', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 02:49:38'),
(52, 'Naveen Yadav', 'naveen42@example.com', '8800000042', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(53, 'Ishita Singh', 'ishita43@example.com', '8800000043', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(54, 'Karan Gupta user', 'karan44@example.com', '8800000044', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 03:42:45'),
(55, 'Sakshi Verma', 'sakshi45@example.com', '8800000045', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(56, 'Yash Patel', 'yash46@example.com', '8800000046', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 01:26:52'),
(57, 'Divya Mishra', 'divya47@example.com', '8800000047', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 08:39:46'),
(58, 'Ujjwal Kumar', 'ujjwal48@example.com', '8800000048', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', NULL, NULL, '2026-04-06 01:26:52', '2026-04-06 08:39:44'),
(59, 'Megha Singh', 'megha49@example.com', '8800000049', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', '1775466929_Screenshot_2026-01-05_000522.png', NULL, '2026-04-06 01:26:52', '2026-04-06 03:45:29'),
(60, 'Anurag Tiwari User', 'anurag50@example.com', '8800000050', 'student', 'N', '2026-04-06 01:26:52', '$2y$12$2AQlMigt6hUEJpPrtI/ouOg6QxiiK/cNM8B6gL0q0N9lC.S8pDfkW', '1775466694_project.png', NULL, '2026-04-06 01:26:52', '2026-04-06 08:39:41'),
(61, 'Aditya Pratap', 'employee@gmail.com', '8009423207', 'employee', 'N', '2026-04-06 05:33:01', '$2y$12$JRWBbrcEt5FmIZzPcg92guLlcUEyIkK5sbEBe3QmIHd.1yJzA6TTG', '1775473381_WhatsApp_Image_2025-12-20_at_3.13.03_PM.jpeg', NULL, '2026-04-06 05:33:01', '2026-04-06 05:39:09'),
(62, 'Aditya Pratap', 'employee05@gmail.com', '8009423208', 'employee', 'N', '2026-04-06 06:11:56', '$2y$12$XtEZdjlCIkMw2Gm2riEY4.lD/seHMRyZBkkIjnP918H8P1P69fi1u', '1775475741_Screenshot_2025-12-11_164959.png', NULL, '2026-04-06 06:11:56', '2026-04-06 07:51:33'),
(63, 'Aditya Pratap', 'adityapratap0567@gmail.com', '8009434652', 'employee', 'N', '2026-04-06 08:18:06', '$2y$12$1YxSyPPHzcvi/ixyvOTBBOR1TWXJ6JYIWyaI5XX2zt3ZUKu8aMCcm', '1775483286_WhatsApp_Image_2026-01-13_at_10.44.53_PM.jpeg', NULL, '2026-04-06 08:18:06', '2026-04-06 08:18:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
