-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2021 at 08:49 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `course_section_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `info`, `notes`, `teacher_id`, `course_section_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1,2,5,9,11,25,8,47,48', 'Most of students are absent', 4, 2, NULL, '2020-09-20 18:49:42', '2020-11-12 05:00:38'),
(6, '1,2,5', 'rwqe', 4, 2, NULL, '2020-11-13 05:01:06', '2020-11-13 05:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `card_number` bigint(20) UNSIGNED NOT NULL,
  `cardable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cardable_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `card_number`, `cardable_type`, `cardable_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 62, 'App\\Models\\V1\\Student\\Student', 1, NULL, '2020-10-28 07:53:24', '2020-11-12 04:01:43'),
(2, 55, 'App\\Models\\V1\\Student\\Student', 2, NULL, '2020-10-28 07:54:16', '2020-11-03 08:23:47'),
(3, 55, 'App\\Models\\V1\\Student\\Student', 2, NULL, '2020-11-04 04:03:39', '2020-11-04 04:03:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_by_id`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'school', 0, 4, 'school', NULL, '2020-11-02 03:29:31', '2020-11-12 15:01:47'),
(2, 'hr high school', 1, 4, 'hr high school', NULL, '2020-11-12 04:17:28', '2020-11-12 15:02:11'),
(3, 'coaching center', 0, 4, 'coaching center', NULL, '2020-11-12 04:21:04', '2020-11-12 04:21:04'),
(4, 'rongdhonu coaching center', 3, 4, 'rongdhonu coaching center', NULL, '2020-11-12 13:21:26', '2020-11-12 13:21:26'),
(5, 'hr coaching center', 3, 4, 'hr coaching center', NULL, '2020-11-12 13:21:45', '2020-11-12 13:21:45');

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`id`, `name`, `image`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '(a)5', NULL, 4, NULL, '2020-09-21 02:36:22', '2020-09-21 02:39:23'),
(2, '(b)4', NULL, 4, NULL, '2020-09-21 02:38:34', '2020-10-12 20:11:09'),
(6, '(c)8', NULL, 4, NULL, '2020-11-01 03:39:01', '2020-11-02 03:39:09'),
(7, '(a)1.2', NULL, 4, NULL, '2020-11-03 03:39:15', '2020-11-04 03:39:20'),
(8, '(b)-2', NULL, 4, NULL, '2020-11-05 03:39:25', '2020-11-06 03:39:31'),
(9, '(c)9', NULL, 4, NULL, '2020-11-07 03:39:38', '2020-11-08 03:39:44'),
(10, '(a)a', NULL, 4, NULL, '2020-11-09 05:52:14', '2020-11-17 05:52:27'),
(13, '(b)an', NULL, 4, NULL, '2020-11-12 05:52:33', '2020-11-15 05:52:38'),
(14, '(c)on', NULL, 4, NULL, '2020-11-13 05:52:42', '2020-11-14 05:52:48'),
(15, '(a)i eat rice.', NULL, 4, NULL, '2020-11-18 05:52:58', '2020-11-25 03:53:05'),
(17, '(b)eat rice i.', NULL, 4, NULL, '2020-11-25 05:53:30', '2020-11-26 05:53:44'),
(18, '(c)as', 'E:\\xamp\\tmp\\phpEB7C.tmp', 4, NULL, '2020-11-04 06:58:33', '2020-11-04 06:58:33'),
(19, '(ক) ৫ টাকা', NULL, 4, NULL, NULL, NULL),
(20, '(খ) ৬ টাকা', NULL, 4, NULL, NULL, NULL),
(21, '(গ) ৮ টাকা', NULL, 4, NULL, NULL, NULL),
(22, '(ঘ) ৭ টাকা', NULL, 4, NULL, NULL, NULL),
(23, '(ক) কায়স্ত\r\n\r\n', NULL, 4, NULL, NULL, NULL),
(24, '(খ) সদগোপ\r\n\r\n', NULL, 4, NULL, NULL, NULL),
(25, '\r\n	\r\n(গ) ব্রাহ্মণ\r\n\r\n	\r\n\r\n', NULL, 4, NULL, NULL, NULL),
(26, '(ঘ) ক্ষত্রিয়\r\n', NULL, 4, NULL, NULL, NULL),
(27, '(ক) বিরক্তি\r\n\r\n\r\n\r\n	\r\n\r\n', NULL, 4, NULL, NULL, NULL),
(28, '(খ) বিদ্রূপ\r\n\r\n	', NULL, 4, NULL, NULL, NULL),
(29, '	\r\n(গ) ক্রোধ\r\n\r\n	', NULL, 4, NULL, NULL, NULL),
(30, '\r\n(ঘ) ঘৃণা\r\n', NULL, 4, NULL, NULL, NULL),
(31, '(ক) অবজ্ঞা\r\n', NULL, 4, NULL, NULL, NULL),
(32, '\r\n(খ) নিন্দা\r\n\r\n\r\n', NULL, 4, NULL, NULL, NULL),
(33, '\r\n	\r\n(গ) উপহাস\r\n\r\n		\r\n', NULL, 4, NULL, NULL, NULL),
(34, '(ঘ) প্রশংসা', NULL, 4, NULL, NULL, NULL),
(35, '(ক) বই পড়া\r\n\r\n', NULL, 4, NULL, NULL, NULL),
(36, '(খ) লাইব্রেরি', NULL, 4, NULL, NULL, NULL),
(37, '(গ) শিক্ষা ও মনুষ্যত্ব', NULL, 4, NULL, NULL, NULL),
(38, '(ঘ) জাগো গো ভগিনী\r\n\r\n', NULL, 4, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `choice_question`
--

CREATE TABLE `choice_question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `choice_id` bigint(20) UNSIGNED NOT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `choice_question`
--

INSERT INTO `choice_question` (`id`, `question_id`, `choice_id`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, NULL, NULL, NULL),
(2, 1, 7, 4, NULL, NULL, '2020-11-13 08:47:04'),
(3, 1, 6, 4, NULL, NULL, NULL),
(4, 2, 7, 4, NULL, NULL, NULL),
(5, 2, 8, 4, NULL, NULL, NULL),
(6, 2, 9, 4, NULL, NULL, NULL),
(7, 3, 10, 4, NULL, NULL, NULL),
(8, 3, 13, 4, NULL, NULL, NULL),
(9, 3, 14, 4, NULL, NULL, NULL),
(10, 4, 15, 4, NULL, NULL, NULL),
(11, 4, 16, 4, NULL, NULL, NULL),
(12, 4, 17, 4, NULL, NULL, NULL),
(17, 5, 19, 4, NULL, NULL, NULL),
(18, 5, 20, 4, NULL, NULL, NULL),
(19, 5, 21, 4, NULL, NULL, NULL),
(20, 5, 22, 4, NULL, NULL, NULL),
(21, 6, 23, 4, NULL, NULL, NULL),
(22, 6, 24, 4, NULL, NULL, NULL),
(23, 6, 25, 4, NULL, NULL, NULL),
(24, 6, 26, 4, NULL, NULL, NULL),
(27, 8, 27, 4, NULL, NULL, NULL),
(28, 8, 28, 4, NULL, NULL, NULL),
(29, 8, 29, 4, NULL, NULL, NULL),
(30, 8, 30, 4, NULL, NULL, NULL),
(31, 9, 31, 4, NULL, NULL, NULL),
(32, 9, 32, 4, NULL, NULL, NULL),
(33, 9, 33, 4, NULL, NULL, NULL),
(34, 9, 34, 4, NULL, NULL, NULL),
(35, 10, 35, 4, NULL, NULL, NULL),
(36, 10, 36, 4, NULL, NULL, NULL),
(37, 10, 37, 4, NULL, NULL, NULL),
(38, 10, 38, 4, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `property_id`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'higher math', 1, 4, NULL, '2020-09-20 16:46:35', '2020-09-20 18:22:16'),
(2, 'general math', 1, 4, NULL, '2020-09-20 16:48:01', '2020-09-20 16:48:01'),
(4, 'bangla', 1, 4, NULL, '2020-09-20 22:19:59', '2020-09-20 22:19:59'),
(5, 'islamic stadies', 1, 4, NULL, '2020-09-20 22:20:33', '2020-11-11 09:36:00'),
(6, 'math', 2, 4, NULL, '2020-10-31 22:20:02', '2020-11-11 09:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `course_section`
--

CREATE TABLE `course_section` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_section`
--

INSERT INTO `course_section` (`id`, `course_id`, `section_id`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 4, NULL, '2020-11-01 05:15:15', '2020-11-13 21:58:54'),
(2, 2, 1, 4, NULL, '2020-11-03 05:15:27', '2020-11-05 05:15:31'),
(4, 6, 5, 4, NULL, '2020-11-02 05:53:22', '2020-11-13 21:57:50'),
(8, 2, 1, 4, NULL, '2020-11-03 05:15:27', '2020-11-05 05:15:31'),
(9, 5, 1, 4, NULL, '2020-11-03 05:15:27', '2020-11-05 05:15:31'),
(10, 6, 2, 4, NULL, '2020-11-01 05:15:15', '2020-11-13 21:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `course_section_teachers`
--

CREATE TABLE `course_section_teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_section_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_section_teachers`
--

INSERT INTO `course_section_teachers` (`id`, `course_section_id`, `teacher_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(10, 2, 4, NULL, '2020-11-13 23:56:50', '2020-11-13 23:56:50'),
(11, 1, 4, NULL, '2020-11-14 00:06:31', '2020-11-14 00:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_by_id`, `property_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Science Dep', 4, 1, NULL, '2020-09-20 09:10:46', '2020-11-11 09:16:54'),
(2, 'Humanities Depart', 4, 2, NULL, '2020-09-20 09:12:03', '2020-11-11 07:43:53'),
(3, 'general department', 4, 1, NULL, '2020-09-20 09:12:18', '2020-09-20 09:13:50'),
(4, 'abc', 4, 2, NULL, '2020-10-31 01:02:57', '2020-10-31 01:02:57'),
(5, 'eee', 4, 1, NULL, '2020-11-03 21:45:01', '2020-11-03 21:45:01'),
(6, 'abc dept', 4, 1, NULL, '2020-11-11 07:44:57', '2020-11-11 07:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_07_22_170305_create_property_types_table', 1),
(10, '2020_07_23_090704_create_properties_table', 1),
(11, '2020_08_20_155648_create_sessions_table', 1),
(12, '2020_07_24_103719_create_user_contacts_table', 2),
(13, '2020_08_06_095738_create_departments_table', 3),
(14, '2020_08_06_101027_create_sections_table', 3),
(18, '2020_08_10_124454_create_students_table', 4),
(19, '2020_08_10_134532_create_cards_table', 4),
(20, '2020_08_12_105614_create_courses_table', 4),
(21, '2020_08_14_140341_create_course_section_table', 4),
(22, '2020_08_15_101251_create_course_section_teachers_table', 5),
(23, '2020_08_15_104517_create_attendances_table', 5),
(24, '2020_08_19_133543_create_quizzes_table', 5),
(25, '2020_08_19_134445_create_questions_table', 5),
(26, '2020_08_22_055756_create_question_quiz_table', 5),
(27, '2020_08_22_104915_create_choices_table', 5),
(28, '2020_08_25_104212_create_choice_question_table', 5),
(29, '2020_08_26_133802_create_tag_tables', 5),
(33, '2020_09_23_080854_create_quiz_sessions_table', 6),
(36, '2020_09_24_092649_create_quiz_session_answers_table', 7),
(37, '2020_09_30_154412_create_quiz_results_table', 8),
(44, '2020_10_04_144442_create_categories_table', 9),
(45, '2020_11_19_133543_create_quizzes_table', 10),
(46, '2020_10_30_154412_create_quiz_results_table', 11),
(49, '2020_10_28_093027_add_cardable_to_cards', 12),
(50, '2020_10_28_104442_create_cards_table', 13),
(51, '2020_10_31_061641_create_courses_table', 14),
(52, '2020_10_31_064500_create_courses_table', 15),
(53, '2020_11_06_094002_add_softdelete_to_course_section', 16),
(54, '2020_11_06_094454_add_softdelete_to_choice_question', 17),
(55, '2020_11_06_094726_add_softdelete_to_question_quiz', 18),
(56, '2020_11_10_105824_create_quiz_results_table', 19),
(57, '2020_11_12_021454_create_course_section_table', 20),
(58, '2020_11_12_153148_create_quiz_results_table', 21),
(59, '2020_11_13_111639_create_question_quiz_table', 22),
(60, '2020_11_13_143956_create_choice_question_table', 23),
(61, '2020_11_16_012628_create_quiz_session_answers_table', 24),
(62, '2021_01_24_162059_create_questions_table', 25),
(63, '2021_01_26_055801_create_property_types_table', 26),
(64, '2021_01_26_081903_create_properties_table', 27),
(65, '2021_01_26_082752_create_categories_table', 28),
(66, '2021_01_26_091133_create_quizzes_table', 29),
(67, '2021_01_26_091914_create_quiz_sessions_table', 30);

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
('284f408458cdadc21c93c19901cec3ca751bd6f8989d6b27ff206a1fd4e72402217e32794a9fb72c', 4, 2, NULL, '[]', 0, '2020-09-22 05:18:02', '2020-09-22 05:18:02', '2021-09-22 11:18:02'),
('36e5844baa2da9c24f44ca71cbf99889af3bcee06603ce32cde08c3f85e474d8ea11653472bbe549', 1, 2, NULL, '[]', 0, '2020-09-20 04:01:10', '2020-09-20 04:01:10', '2021-09-20 10:01:10'),
('3b02683f8df1cc53c4560a46fe204bf5863ed653a62d43af28f92643328b96f5a32d45c30af476a8', 4, 2, NULL, '[]', 0, '2020-09-20 04:30:16', '2020-09-20 04:30:16', '2021-09-20 10:30:16'),
('67b196fbaec71de7c656ee387474adafd88f2ad6ccb8b2b360c7beddd1e85cd044c501cc444eea2d', 4, 2, NULL, '[]', 0, '2020-09-21 00:42:02', '2020-09-21 00:42:02', '2021-09-21 06:42:02'),
('8843ecaac5679efd7fa2b018a37d8717aec523e1ed1a2df2461d4f2c36064fee828b2d09dbbd8a78', 4, 2, NULL, '[]', 0, '2020-09-23 02:32:50', '2020-09-23 02:32:50', '2021-09-23 08:32:50'),
('b45ef7d8f1f04f0701cc421056975086d3bb9631a8dfbbb652b7a31969a2d3413f67c588bd66781c', 3, 2, NULL, '[]', 0, '2020-09-22 05:17:43', '2020-09-22 05:17:43', '2021-09-22 11:17:43'),
('cf6e06d50064151910afab35e967650e97cb66503d070700325dc0a514cb79ee8ffae57b0f92a9ca', 1, 2, NULL, '[]', 0, '2020-09-20 04:21:12', '2020-09-20 04:21:12', '2021-09-20 10:21:12'),
('ff5fcd7301a92f078853cf87ae008547cae2b3e141f50f2057b7e5e84e515330d0aeb03fa0e97776', 4, 2, NULL, '[]', 0, '2020-09-19 04:09:37', '2020-09-19 04:09:37', '2021-09-19 10:09:37');

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
(1, NULL, 'Laravel Personal Access Client', 'C1hNOLQ3Rg3B8ZKTP1MG5cdBmSo3Kwg2xWH2WVif', NULL, 'http://localhost', 1, 0, 0, '2020-09-19 04:02:26', '2020-09-19 04:02:26'),
(2, NULL, 'Laravel Password Grant Client', 'u8R0eFx8rOvoq9B2mAAp04I53M7xroRcmbrRWpJJ', 'users', 'http://localhost', 0, 1, 0, '2020-09-19 04:02:27', '2020-09-19 04:02:27');

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
(1, 1, '2020-09-19 04:02:27', '2020-09-19 04:02:27');

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
('1cb9a341cf2da965e7bb210a2009c5f06dcbbe3d29db14cc6310665b68eae24122cfd1ae503731c1', '67b196fbaec71de7c656ee387474adafd88f2ad6ccb8b2b360c7beddd1e85cd044c501cc444eea2d', 0, '2021-09-21 06:42:02'),
('4782019e7d39e8071beb9250fe8e613ba98c361f7bd857fb0ff524aa3731e6550d130905f8e1fb2e', '8843ecaac5679efd7fa2b018a37d8717aec523e1ed1a2df2461d4f2c36064fee828b2d09dbbd8a78', 0, '2021-09-23 08:32:51'),
('52cc64b9721b0f186bc414e79e76b6a22cc50e56f619ea4b8f02bc941dfa45689c979321465010e7', '36e5844baa2da9c24f44ca71cbf99889af3bcee06603ce32cde08c3f85e474d8ea11653472bbe549', 0, '2021-09-20 10:01:11'),
('721469cdd1d9d69a9bfac6f2085852294a15cce5c06ddbb2b534a6dc7c10aa99decb8dab6ffa43f3', 'ff5fcd7301a92f078853cf87ae008547cae2b3e141f50f2057b7e5e84e515330d0aeb03fa0e97776', 0, '2021-09-19 10:09:37'),
('7db9e607aa50903456c3a7224e4d239e5b7c71af0613ffe55f9d639e97d07b692aebcde3b0268972', 'cf6e06d50064151910afab35e967650e97cb66503d070700325dc0a514cb79ee8ffae57b0f92a9ca', 0, '2021-09-20 10:21:12'),
('898ca8751b9188a79b4cb310fe1228edbee09e381692abbf9fda232d39442918a8e7d215e9f70419', 'b45ef7d8f1f04f0701cc421056975086d3bb9631a8dfbbb652b7a31969a2d3413f67c588bd66781c', 0, '2021-09-22 11:17:44'),
('9844fd78f7531ec67816d0ab4caecd2b5a69ef0629813dace9addbd5030dff92ce293e3c16289169', '284f408458cdadc21c93c19901cec3ca751bd6f8989d6b27ff206a1fd4e72402217e32794a9fb72c', 0, '2021-09-22 11:18:02'),
('dce854bd15e2e5c4973812656b2a261d20504f77374b3c8ef1c9a91cc15119083b374f3bd8bb92ce', '3b02683f8df1cc53c4560a46fe204bf5863ed653a62d43af28f92643328b96f5a32d45c30af476a8', 0, '2021-09-20 10:30:16');

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
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `private_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_type_id` bigint(20) UNSIGNED NOT NULL,
  `visibility` tinyint(4) NOT NULL DEFAULT 0,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name`, `private_name`, `description`, `property_type_id`, `visibility`, `slug`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'HR high school', 'boys school', 'education is our vision', 1, 0, 'hr-high- school', 4, NULL, '2020-09-20 01:15:51', '2020-09-20 01:15:51'),
(2, 'Rongdhonu Coaching Center', 'habibur\'s educare', 'Education is ours goal.', 2, 0, 'rongdhonu coaching center', 4, NULL, '2020-09-20 01:20:55', '2020-09-20 02:47:46'),
(3, 'HR Coaching Center', 'habibur\'s educare', 'Education is ours goal.', 2, 0, 'hr coaching center', 6, NULL, '2020-09-20 01:20:55', '2020-09-20 02:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suggested` tinyint(4) NOT NULL DEFAULT 0,
  `user_interface` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `name`, `description`, `suggested`, `user_interface`, `slug`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'school', 'private school', 0, NULL, 'school', 4, NULL, '2020-09-19 21:56:29', '2020-10-12 12:56:16'),
(2, 'coaching center', 'private coaching', 0, NULL, 'coaching center', 4, NULL, '2020-09-19 21:57:31', '2020-11-02 05:38:48'),
(3, 'college', 'public college', 0, NULL, 'college', 4, NULL, '2020-09-19 21:59:07', '2020-11-02 05:38:53'),
(4, 'university', 'public university', 0, NULL, 'university', 4, NULL, '2020-09-19 21:59:34', '2020-09-19 21:59:34'),
(5, 'madrasa', 'private institution', 0, NULL, 'madrasa', 4, NULL, '2020-09-19 22:02:06', '2020-09-19 22:02:06'),
(6, 'alia madrasa', 'private institution', 0, NULL, 'alia madrasa', 1, NULL, '2020-09-19 22:22:43', '2020-09-19 22:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `config` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `explanation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suggested` tinyint(4) NOT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `name`, `image`, `config`, `explanation`, `question_type`, `suggested`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'which is the prime number?', NULL, '1', 'Prime numbers are the numbers that are only divisible by themselves and 1, in other words, if we try to divide them by another number, the result is not a whole number. So, if you divide the number by anything other than one or itself, you will get a remainder that is not zero.', 'Multiple Quesiton', 0, 4, NULL, '2020-09-20 14:33:18', '2020-11-12 11:56:48'),
(2, 'which is the normal number?', NULL, '9', 'A natural number is an integer greater than 0. Natural numbers begin at 1 and increment to infinity: 1, 2, 3, 4, 5, etc. Natural numbers are also called \"counting numbers\" because they are used for counting', 'Multiple Quesiton', 1, 4, NULL, '2020-09-20 14:34:20', '2020-09-20 14:34:20'),
(3, 'which is not articles?', NULL, '1', NULL, 'Multiple', 1, 4, NULL, '2020-09-20 14:34:20', '2020-11-21 22:21:45'),
(4, 'which is  a correct sentance?', NULL, '15', NULL, 'Multiple Quesiton', 1, 4, NULL, '2020-09-20 14:34:20', '2020-09-20 14:34:20'),
(5, '‘আম আঁটির ভেঁপু’ গল্পে সর্বজয়াদের রায়বাড়ির কত টাকার উপর নির্ভর করতে হয়?\r\n\r\n', NULL, '21', NULL, 'mcq', 0, 4, NULL, '2020-11-02 09:19:43', '2020-11-02 09:22:41'),
(6, '	\r\nমাতবর গোছের লোকটি কী জাতের ছিল?\r\n\r\n', NULL, '24', NULL, 'mcq', -1, 4, NULL, '2020-11-12 11:49:32', '2020-11-12 11:49:32'),
(8, '‘সব ব্যাটারাই এখন বামুন-কায়েত হতে চায়।’ এ কথায় প্রকাশিত হয়েছে -\r\n\r\n', NULL, '28', NULL, 'slk', 1, 4, NULL, '2020-11-14 16:58:16', '2020-11-14 16:58:16'),
(9, '‘আহা কী শ্রী! বউয়ের মুখখানি দেখিলে চোখ জুড়াইয়া যায়’ - বাক্যটিতে কী অর্থ প্রকাশ পেয়েছে?\r\n\r\n', NULL, '34', NULL, 'simple', 1, 4, NULL, '2020-11-20 06:48:27', '2020-11-20 06:48:27'),
(10, '	\r\n‘আমরা যত বেশি লাইব্রেরি প্রতিষ্ঠা করব দেশের তত বেশি উপকার হবে।’ - এই অংশটি কোন প্রবন্ধের?\r\n\r\n', NULL, '35', NULL, 'simple', 1, 4, NULL, '2020-11-20 06:48:27', '2020-11-20 06:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `question_quiz`
--

CREATE TABLE `question_quiz` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED DEFAULT NULL,
  `question_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_quiz`
--

INSERT INTO `question_quiz` (`id`, `quiz_id`, `question_id`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, 5, 4, NULL, '2020-11-13 07:43:00', '2020-11-13 07:57:28'),
(3, 2, 1, 4, NULL, '2020-11-13 20:55:44', '2020-11-13 20:55:44'),
(4, 3, 1, 4, NULL, '2020-11-13 20:57:36', '2020-11-13 20:57:36'),
(5, 2, 2, 4, NULL, '2020-11-13 20:58:16', '2020-11-13 20:58:16'),
(6, 3, 2, 4, NULL, NULL, NULL),
(8, 1, 6, 4, NULL, NULL, NULL),
(9, 1, 8, 4, NULL, NULL, NULL),
(10, 1, 9, 4, NULL, NULL, NULL),
(11, 1, 10, 4, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `config` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `description`, `image`, `config`, `category_id`, `slug`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'bangla 1st part', 'ans all', NULL, '2', 2, 'bangla 1st part', 4, NULL, '2020-11-13 01:29:50', '2020-11-13 01:29:50'),
(2, 'higher math', 'multiple question', NULL, 'k', 2, 'higher math', 4, NULL, '2020-11-13 01:36:44', '2020-11-13 01:36:44'),
(3, 'general math', 'akls', NULL, 'ks', 4, 'general math', 4, NULL, '2020-11-13 14:56:44', '2020-11-13 14:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_question` bigint(20) UNSIGNED NOT NULL,
  `total_right_ans` bigint(20) UNSIGNED NOT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `session_id`, `total_question`, `total_right_ans`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 4, NULL, '2021-01-26 04:14:29', '2021-01-26 04:14:29'),
(2, 1, 2, 2, 4, NULL, '2021-01-26 04:14:46', '2021-01-26 04:14:46'),
(3, 2, 2, 1, 4, NULL, '2021-01-26 04:16:02', '2021-01-26 04:16:02'),
(4, 3, 4, 1, 4, NULL, '2021-01-26 07:59:45', '2021-01-26 07:59:45'),
(5, 3, 4, 1, 4, NULL, '2021-01-26 08:00:19', '2021-01-26 08:00:19'),
(6, 1, 2, 2, 4, NULL, '2021-01-26 08:00:28', '2021-01-26 08:00:28'),
(7, 1, 2, 2, 4, NULL, '2021-01-26 08:00:29', '2021-01-26 08:00:29'),
(8, 2, 2, 1, 4, NULL, '2021-01-26 08:06:30', '2021-01-26 08:06:30'),
(9, 2, 2, 1, 4, NULL, '2021-01-26 11:34:51', '2021-01-26 11:34:51'),
(10, 1, 2, 2, 4, NULL, '2021-01-26 23:05:19', '2021-01-26 23:05:19'),
(11, 1, 2, 2, 4, NULL, '2021-01-26 23:05:37', '2021-01-26 23:05:37'),
(12, 4, 2, 2, 4, NULL, '2021-01-26 23:06:28', '2021-01-26 23:06:28'),
(13, 5, 5, 2, 4, NULL, '2021-01-28 13:33:49', '2021-01-28 13:33:49'),
(14, 5, 5, 2, 4, NULL, '2021-01-28 13:37:19', '2021-01-28 13:37:19'),
(15, 7, 5, 5, 4, NULL, '2021-01-28 13:47:46', '2021-01-28 13:47:46'),
(16, 6, 5, 3, 4, NULL, '2021-01-28 13:48:14', '2021-01-28 13:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_sessions`
--

CREATE TABLE `quiz_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_sessions`
--

INSERT INTO `quiz_sessions` (`id`, `quiz_name`, `quiz_id`, `slug`, `status`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'general math', 3, 'general-math', 1, 4, NULL, '2021-01-26 04:14:23', '2021-01-26 04:14:29'),
(2, 'general math', 3, 'general-math-1', 1, 4, NULL, '2021-01-26 04:15:47', '2021-01-26 04:16:02'),
(3, 'bangla 1st part', 1, 'bangla-1st-part', 1, 4, NULL, '2021-01-26 07:59:30', '2021-01-26 07:59:45'),
(4, 'general math', 3, 'general-math-2', 1, 4, NULL, '2021-01-26 23:04:44', '2021-01-26 23:06:27'),
(5, 'bangla 1st part', 1, 'bangla-1st-part-1', 1, 4, NULL, '2021-01-28 13:33:17', '2021-01-28 13:33:49'),
(6, 'bangla 1st part', 1, 'bangla-1st-part-2', 1, 4, NULL, '2021-01-28 13:37:54', '2021-01-28 13:48:14'),
(7, 'bangla 1st part', 1, 'bangla-1st-part-3', 1, 4, NULL, '2021-01-28 13:47:32', '2021-01-28 13:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_session_answers`
--

CREATE TABLE `quiz_session_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `selected_choice_id` bigint(20) UNSIGNED NOT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_session_answers`
--

INSERT INTO `quiz_session_answers` (`id`, `session_id`, `question_id`, `selected_choice_id`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 4, NULL, '2021-01-26 04:14:29', '2021-01-26 04:14:29'),
(2, 1, 2, 9, 4, NULL, '2021-01-26 04:14:29', '2021-01-26 04:14:29'),
(3, 2, 1, 7, 4, NULL, '2021-01-26 04:15:52', '2021-01-26 04:15:52'),
(4, 2, 2, 9, 4, NULL, '2021-01-26 04:16:02', '2021-01-26 04:16:02'),
(5, 3, 5, 19, 4, NULL, '2021-01-26 07:59:44', '2021-01-26 07:59:44'),
(6, 3, 6, 24, 4, NULL, '2021-01-26 07:59:44', '2021-01-26 07:59:44'),
(7, 3, 8, 28, 4, NULL, '2021-01-26 07:59:45', '2021-01-26 07:59:45'),
(8, 3, 9, 31, 4, NULL, '2021-01-26 07:59:45', '2021-01-26 07:59:45'),
(9, 4, 1, 1, 4, NULL, '2021-01-26 23:05:04', '2021-01-26 23:05:04'),
(10, 4, 2, 9, 4, NULL, '2021-01-26 23:06:27', '2021-01-26 23:06:27'),
(11, 5, 5, 20, 4, NULL, '2021-01-28 13:33:48', '2021-01-28 13:33:48'),
(12, 5, 6, 24, 4, NULL, '2021-01-28 13:33:48', '2021-01-28 13:33:48'),
(13, 5, 8, 28, 4, NULL, '2021-01-28 13:33:48', '2021-01-28 13:33:48'),
(14, 5, 9, 34, 4, NULL, '2021-01-28 13:33:48', '2021-01-28 13:33:48'),
(15, 5, 10, 35, 4, NULL, '2021-01-28 13:33:49', '2021-01-28 13:33:49'),
(16, 7, 5, 21, 4, NULL, '2021-01-28 13:47:45', '2021-01-28 13:47:45'),
(17, 7, 6, 24, 4, NULL, '2021-01-28 13:47:46', '2021-01-28 13:47:46'),
(18, 7, 8, 28, 4, NULL, '2021-01-28 13:47:46', '2021-01-28 13:47:46'),
(19, 7, 9, 34, 4, NULL, '2021-01-28 13:47:46', '2021-01-28 13:47:46'),
(20, 7, 10, 35, 4, NULL, '2021-01-28 13:47:46', '2021-01-28 13:47:46'),
(21, 6, 5, 21, 4, NULL, '2021-01-28 13:48:14', '2021-01-28 13:48:14'),
(22, 6, 6, 24, 4, NULL, '2021-01-28 13:48:14', '2021-01-28 13:48:14'),
(23, 6, 8, 29, 4, NULL, '2021-01-28 13:48:14', '2021-01-28 13:48:14'),
(24, 6, 9, 33, 4, NULL, '2021-01-28 13:48:14', '2021-01-28 13:48:14'),
(25, 6, 10, 35, 4, NULL, '2021-01-28 13:48:14', '2021-01-28 13:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `created_by_id`, `department_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Class Nine Sec-A', 4, 1, NULL, '2020-09-20 09:33:47', '2020-11-11 08:59:50'),
(2, 'Class Nine Sec-B', 4, 2, NULL, '2020-09-20 19:28:51', '2020-09-20 19:28:51'),
(4, 'd', 4, 1, NULL, '2020-10-31 02:18:04', '2020-11-11 09:16:48'),
(5, 'abc', 4, 1, NULL, '2020-11-11 09:00:14', '2020-11-11 09:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0gfE4uW4JtGN59UZ1C1xTQ9FmjqogCbCc5LqxA9U', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibFJ2NGlqZjg2N3FvVHpLMWswcW5GdkJLV3gwaUZOZEVJbk1pZzI5NCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665174),
('1i9YLypyf7YHHJujW93B9xtqSA5akRCSjIsaNH7B', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTHlsNE5yWGxnOER3ZDBsUmZ2VUNCUUZJRjFjTmpNS3doVFVUelFOUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665939),
('2huuRrHMVMcQIlQKFbx3njt0SNFnOU5vuaEbSs7B', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWnNISkJNMmZiZ3RqemlLTzRxTnlYUkJQMlFrNWxuSE80QnlBME82TSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665692),
('3904ssYcezUrWP4OheYMeTm8KEBpHhyqg396MBRd', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmFVZ0laeW5Nc0Fzdnl3RUVxUkk5ZFZOSFNFdFdrZkpCZkpUUlc2cCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665975),
('3BYpFDmtsdavdCzynAkkBpVKDFQwHCEpQPalfwtS', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGZZSHdJcmE5VnBnWHMzVVFXMjJqS25ZSEx5cTZtTWdJRUdPY3V3RyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611666070),
('5ZGvpYoOKBlNOSUF7zuUbb9tAXulBAafa6RPtV0b', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN215TzNTd1k4UzI2MzhOZThnNkJlVEVrVzljZWQwR2NrV3JuZWJBQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665999),
('685zo09SiRkVMxlWgHJV7nWx2ia1rHKVxqoQY3Ww', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWdJa1dURzg5MkFmTUxhbjJQOG1QeVpaV2gwTkwzNHhRNEJaM0p0QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611664963),
('9sh5XXWHCkv89zOAzvQrb8TF3zeKBZ5QrHLE8XHc', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicHoxNlMyUVI0RzlrdTI1R0JEbkhqbVhOdnlaVkR3NUhMdjhQbThMQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665897),
('9wTJIgQtvOQVEgMJczI2ufpzi9vqJ4vAp2nMYGmc', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3dxY1FRQ3JMaGFydzRtUHR6a1VOS3J6dTNrbEpEdkJ2REtOOWVSMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611666351),
('A87a3ytWdwvvCC0fHy8lMnlzfvhIg4CFD8TJtwku', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmNta1N4SUYzUGY4eGxpM3JVMGNFeXBrOXljMkN4dWJyZ0J1WVpZeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611666897),
('aC50erXXEUXxbLrxiA443H2UwHRMCudO3CGQF7XV', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic2FLMTgyZlFvbU10OUlRaHpxZmxmODlzZkZsWFBmZ1g4Rm4waGxHTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611669300),
('ALKVX19maEUyAju6PRxY3UKi3Tgzkjekzr55nZd7', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieUFIQjlCRTYyQXpFOTZQM09kTEFjUlljWEJLWE5nVVNCRmc1TTBZMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611669409),
('bAfX9a5NgyMWd0MTTb56NZ4B7Vi6B1YwqJoVQw9H', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUdSV3pGWlJ3UlRYU2FyeEZPakphR0lGbTdOWXVmQ0hCbThnemw3ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611666402),
('Bio5yxgEpFESfiiwC6lB5qlgG2AtsyeObLlw5as1', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQTVtaU9lT1hOOHhNN01TVm5UU29yWEpqQTRGRmRzSmxsa2xvQ204cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611666416),
('bLKCV1OTLDNx6TJNh37IYfjsMLrn6NyuVpNIVImk', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ09pSDJGdUVCT2o0OHlMNk1ZV1VBZVE2OGxvTXBjYjl1dkFxOUVvMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611722125),
('BVY2b5TXeJ1DZb3kY8SZ7FI4MhadoOchuYZvv6oo', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZE9nV0lORE9VQWdhbTlGTGt3UXh2UnBJcklYSncxQ2F0Uk9iWjVHOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611664717),
('bydOJcR4OV18zrwjhPa8yO4lpMqyEHVmQ9agkQHP', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTDVKd0VDMjl2ZjA4TE1nc1lWYnBFblVOem9oTXhXRk1hNFlibTRWUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611666889),
('C83lMdvWDL1KrqSsFmPCv1oxK8G6UTHlwN5TunDM', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNTFYdTh5NVpia0JCN05GWXZaTTVLWnFaUWYxN3EwUG5Wbk1lOERMayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611666746),
('D3D9zdj6hH7r5pszB6HT7VBHABePXiI83lxwCgni', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTd0NFBCTU96VVZMd3FhblRBendSQ0xHTjRIVXRBZ3dIZkFrZWNBUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611666584),
('d9GUiZzlFZbkYDKBi0DpCmGMWqdiXinAde0GZ81J', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVzBobUlsZ1RicmtZbXNKZTBNNmpnWTFKZjRjRXdEWU5CRWFsTkpOVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611682738),
('dcz6ve780a6n4REuqyMdh3lWtqP4eMVfrfFZ7aPG', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicWtqaWlaS0d6SDBWMzk5UWxiRjBDeFhGQ2h6RTVhNW1uT2wyQVJxOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611666958),
('EfjuEziL7OIcy8pWde9Mi5fOZiKypSNbtqp7S7Ii', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV09FMGI0OWhTdmJsUmJTWXpocXZ1WHU4SDJ5eXpHQU5HMmQ0NXpyaCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NDoiaHR0cDovL3F1aXoudGVzdC9xdWl6LXJlc3VsdHMvcXVpei1zZXNzaW9uLzIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611682492),
('eVtU5j2ShOYJq72Cbzl5Kui0PavMry8rGeBYHxi0', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSHNSb1g3UUNMVVRUUEtITHowdmtoS0NGdktySVAydUliaUpqQ1E0SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665066),
('fUVIldnikMTfsjE5i0twMO0NaSkTGpZ5hw4I5xvM', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmdLOXpvMGxYS25ZWnE4clRHT2J6dWFRYmZQeExBRnFWdUJFOWV2cCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665712),
('GGYdw9Jfeq5m0nuAYKQtZb2yXrsqEtzOGAomEKuG', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGZqOFhXYTVRUkVmMkdyOWZhb01vTnBkQlRLUm9JTHlyOVFnd0FlTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665648),
('h0zqZiW9W6oBVM8hPDNzXHkNifS9B161DuxhCjh1', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTBzbnk4TkNoeEx3SXlUYVVON1NHMzlrMmtnbE12ZkdydXJsZE1LMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665878),
('hgqBvL4DMDwALG4pwgVHlHjbNfxfJuuAwrCSPPZz', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWh3TmptNjlIaldkSlFVVXhJZDNiY3VVVGpXWFVNR0xBRG5jSDIzcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611666364),
('Huj3wb9pQlYwmIFXXcpeX2lftDVaSp5GqpuOVml9', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTdnM29NNmZQYThnVmVNSk9FY1IwdmVGWmwzMzlDODE5ZnFCaDY2diI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665608),
('hWgNfVyshGLmlWUrMibJ9SIteQXWlDjc1vg61FYm', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUUwwNWE4ek1YRjhxdGxPRmR0T25CVkh1cGVEQnhJVExvYWhURHVPZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611669244),
('HyO3FZhqj1sKAYJWjOZG76LyJIT6sndExtbqPuza', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUHBmWHdzcXRpWERZYlBsRjB3WVVDc2xHWWVZcHo1ZXVnbk1ycXBMcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665850),
('iJL8t3A3Nl5CdDPWtKQQ6lvvQz0HfeI2yX36A0gg', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidUtLbWFrdDEwTXNWN1pITEY1cG1uZW9kMmZKOU0zdnZFSFRCRTRmeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611664857),
('iyGD3qQBNqe8LRnCk73aeoIrgeeCE80bEuRcY9pB', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnNSVEM3cENwOTRiaGZrU1dNSjFvNEhmZlpNdlQ0VFhqejc5QTJ3QiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611666695),
('IznRJft6wdBWmMcGUD1UJpjedNiCrk09Wz7PHjsu', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXZRT0F5TmRjSXdjSHhVWlNWOGpGV0taN0Z2QW5vZUk1dmpxOEYzUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611669362),
('L0RaUCyfODAOR9mjutfXMLHzpyvth6ryWpH5Anf0', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibDB4Zld5bkNOTEVDakVLNHpuTGltT0l2VEVlVGZpTlhHdGk0SHFUQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611669213),
('lHkxM1hc1RbqjddaevTiDVAvB8kNRGlSiCBqU1v2', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV3JtTEhtaEZidDgzR2ZMWHhpS1h1NWN2TzRJOFI1WXNjMGh1d3BTVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665686),
('MAhMX7478N41f7PMAYyJwO8aUwVvISgVvg7S1eB4', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQW82aGRCQ1kyRWZTczhiMEtHQkNyU2N3a2FGa3JLS2gzbmZYcnNpTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611669306),
('Oah4zLY5kI2gZFqMdVUz5QiI0yHK8p2iFOCJOEIv', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUdNU1F0WmRFbHVhT3F4TnNtNWs2NHZFdWtqaEVGNm8xSWtOZUhWWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665272),
('q8BVSk5vt3kYWRFqngUxiMYPGb8I70G4vWKcFryA', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSlhISjdHeXI2RFplS0YzWHY0c1p3cDlnUkdVTjZGeXVCVThob1ZyeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9xdWl6LnRlc3QvcXVpei1yZXN1bHRzL3F1aXotc2Vzc2lvbi8yIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1611669990),
('qppa11G1FkeTlZMZwUpBa1AcpCQCX8l31WFcnovt', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQlc2amh4R2FzY1Z2VHVEZU0yeUJCd2JWdFRQaDB0TmNkRlg2Z1pmOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611669510),
('Rofv5YrosituzJA5nxo27uOVw5uo1m9J28Wu32Vh', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWNWZTFHcFpFU2pFSDRJTlZlMzNaWkRsbno4U2ViQk42cG0wSXZ2TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665319),
('rPVEGXet5AkOePW1k4BZjzAm0vKOr1zauF741rde', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTHR3amV6dU81b1FMU2xlZXV5Tjd5VXc5MWtOMEI0cVVJbVlWeHBSQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611667348),
('UK0RlHal2W00jc7l8E15150Wi3jT9uVEis2GxZ5m', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDl2WmliVkphZTU1MTllTldLbDRIbXQxMFlIanhJTnMxWkRqTVU3NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665995),
('UMs2vr90HI7qR1ogiC3dKNMlNjfS85V0yjzHAWRT', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTNKdUlrZDROMFprdjc0Rk1FcDdsTXhtTjVidGpLSUhkV215dVljYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9xdWl6LnRlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611861728),
('USWjvjiunJrKwhmDqJ9KxKBLj9WEak4Rsn1sh1ig', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmlJMFhuUkI5Vm5pS3Q1MWJDNUZYU3F6cVRFWENFejdxTXo5ZHFUNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611669563),
('vvmHb2vpTWCWYo3AaaN2XP4DYPXFLIn6agj5WY9K', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnVtTnhFTURaVXg1bTVidDA3d3JTTVNYZE9YTXc1Tzg5c281d0FoWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611664620),
('WFKksksBkxsPxfmWwkIrP15AP3787GGamB86sL3d', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRW1wQjh0SVQwRDJQdXFPTlhIRW1ucGRPZ0ZtMVIxWmF4VFk3ZGhSYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611666359),
('wiviPeHngg8PlVFc9MLkjFfSUMXAw5pT1NLt9YVj', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT2F6c2FFMWpaQ0owM3hBVTUwM1BZSXUwYkRxTk9ybm9RSG9YaVZHbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611669783),
('WmELXAc8UcX0kc8VPIKkpMhtsbqEIvBat86ZyDy5', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ08wa2pFWFNFNU9yRmxxM0xXYjBBZHpGRFpWeDlTdXZSb3dYSmxaNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9xdWl6LnRlc3QvcXVpei1zZXNzaW9uLzYvaW5jb21wbGV0ZS1xdWl6Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1611863294),
('WuN9FdItSX93rG7v36XL9qehpy60I2sjkxWCM2sp', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYlRRUlVld3F5RElyc2NPOEFYTWpKejQxVlp5ajhKTHY4R1RsWE9DNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9xdWl6LnRlc3QvcXVpei1zZXNzaW9uLzQvaW5jb21wbGV0ZS1xdWl6Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1611723988),
('XdXdbt5m7mtRXJMmj1v1UICIAfJEGSlFOkodBfFu', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTZQWVUyOG9PaVVRcURIU0RHdFNvd2lDbzV0OThNdzRkY1NNWWg0MyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611666290),
('Y8r32yAu7cFJixZmFi9hJd9oKH7ZuKW7t1Nl69PY', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXptNHpsVUI4U2RBNm81b1JpY1lYZ2NmQUNZTXljekR4V0FpYWVybCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665188),
('yzUFWRfLk1UwNwmiT8rTH3rPdUM0RllSmXmRznjJ', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidnNpbnNGeGtETzBkdnREZHU0M0xxQ0t2WFM0cDluTGNWUTdTOE5zbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665957),
('ZAbiwEEdEsO32BQdpLmn9WoTIFR0dJdQcLPD3RiG', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWnZOdDVjOVZONmQ0ZmRYSEFWQWNzRGw5R3NjZjhhMW5QMUNVM0VLcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1611665179);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `prefix` bigint(20) UNSIGNED NOT NULL,
  `roll_number` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `property_id`, `section_id`, `user_id`, `prefix`, `roll_number`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 4, 16097, 255, NULL, '2020-09-20 23:22:20', '2020-11-01 21:36:39'),
(2, 1, 1, 4, 1609, 2, NULL, '2020-09-20 23:23:08', '2020-11-01 21:36:43'),
(4, 1, 2, 4, 1247, 4, NULL, '2020-11-01 21:35:37', '2020-11-01 21:36:16'),
(5, 2, 4, 4, 1524, 26, NULL, '2020-11-03 08:48:26', '2020-11-03 08:48:26'),
(7, 1, 1, 4, 212, 9052541, NULL, '2020-11-12 03:48:58', '2020-11-12 03:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `tag_id` int(10) UNSIGNED NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taggables`
--

INSERT INTO `taggables` (`tag_id`, `taggable_type`, `taggable_id`) VALUES
(1, 'App\\Models\\V1\\Question\\Question', 10),
(2, 'App\\Models\\V1\\Question\\Question', 1),
(2, 'App\\Models\\V1\\Question\\Question', 15),
(3, 'App\\Models\\V1\\Question\\Question', 2),
(4, 'App\\Models\\V1\\Question\\Question', 3),
(4, 'App\\Models\\V1\\Question\\Question', 15),
(5, 'App\\Models\\V1\\Question\\Question', 11),
(5, 'App\\Models\\V1\\Question\\Question', 15),
(6, 'App\\Models\\V1\\Question\\Question', 3),
(6, 'App\\Models\\V1\\Question\\Question', 14),
(7, 'App\\Models\\V1\\Question\\Question', 1),
(7, 'App\\Models\\V1\\Question\\Question', 3),
(7, 'App\\Models\\V1\\Question\\Question', 14),
(8, 'App\\Models\\V1\\Question\\Question', 16),
(9, 'App\\Models\\V1\\Question\\Question', 16),
(10, 'App\\Models\\V1\\Question\\Question', 16),
(11, 'App\\Models\\V1\\Question\\Question', 17),
(12, 'App\\Models\\V1\\Question\\Question', 17),
(13, 'App\\Models\\V1\\Question\\Question', 17),
(14, 'App\\Models\\V1\\Question\\Question', 17),
(15, 'App\\Models\\V1\\Question\\Question', 1),
(15, 'App\\Models\\V1\\Question\\Question', 3),
(16, 'App\\Models\\V1\\Question\\Question', 3),
(17, 'App\\Models\\V1\\Question\\Question', 8),
(18, 'App\\Models\\V1\\Question\\Question', 8),
(19, 'App\\Models\\V1\\Question\\Question', 8),
(20, 'App\\Models\\V1\\Question\\Question', 8),
(21, 'App\\Models\\V1\\Question\\Question', 8),
(22, 'App\\Models\\V1\\Question\\Question', 11),
(23, 'App\\Models\\V1\\Question\\Question', 11),
(24, 'App\\Models\\V1\\Question\\Question', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_column` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `type`, `order_column`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"year\"}', '{\"en\":\"year\"}', NULL, 1, '2020-11-20 18:48:28', '2020-11-20 18:48:28'),
(2, '{\"en\":\"class-9\"}', '{\"en\":\"class-9\"}', NULL, 2, '2020-11-20 19:57:58', '2020-11-20 19:57:58'),
(3, '{\"en\":\"easy\"}', '{\"en\":\"easy\"}', NULL, 3, '2020-11-20 19:59:27', '2020-11-20 19:59:27'),
(4, '{\"en\":\"article\"}', '{\"en\":\"article\"}', NULL, 4, '2020-11-20 19:59:58', '2020-11-20 19:59:58'),
(5, '{\"en\":\"name\"}', '{\"en\":\"name\"}', NULL, 5, '2020-11-20 22:32:34', '2020-11-20 22:32:34'),
(6, '{\"en\":\"2\"}', '{\"en\":\"2\"}', NULL, 6, '2020-11-20 23:21:08', '2020-11-20 23:21:08'),
(7, '{\"en\":\"5\"}', '{\"en\":\"5\"}', NULL, 7, '2020-11-20 23:21:08', '2020-11-20 23:21:08'),
(8, '{\"en\":\"hellow\"}', '{\"en\":\"hellow\"}', NULL, 8, '2020-11-20 23:23:52', '2020-11-20 23:23:52'),
(9, '{\"en\":\"are\"}', '{\"en\":\"are\"}', NULL, 9, '2020-11-20 23:23:52', '2020-11-20 23:23:52'),
(10, '{\"en\":\"kyou\"}', '{\"en\":\"kyou\"}', NULL, 10, '2020-11-20 23:23:52', '2020-11-20 23:23:52'),
(11, '{\"en\":\"abs\"}', '{\"en\":\"abs\"}', NULL, 11, '2020-11-21 09:40:13', '2020-11-21 09:40:13'),
(12, '{\"en\":\"agsl\"}', '{\"en\":\"agsl\"}', NULL, 12, '2020-11-21 09:40:13', '2020-11-21 09:40:13'),
(13, '{\"en\":\"sklf\"}', '{\"en\":\"sklf\"}', NULL, 13, '2020-11-21 09:40:14', '2020-11-21 09:40:14'),
(14, '{\"en\":\"lksj\"}', '{\"en\":\"lksj\"}', NULL, 14, '2020-11-21 09:40:14', '2020-11-21 09:40:14'),
(15, '{\"en\":\"3\"}', '{\"en\":\"3\"}', NULL, 15, '2020-11-21 22:43:46', '2020-11-21 22:43:46'),
(16, '{\"en\":\"4\"}', '{\"en\":\"4\"}', NULL, 16, '2020-11-22 10:14:53', '2020-11-22 10:14:53'),
(17, '{\"en\":\"economics\"}', '{\"en\":\"economics\"}', NULL, 17, '2020-11-22 22:03:29', '2020-11-22 22:03:29'),
(18, '{\"en\":\"econo\"}', '{\"en\":\"econo\"}', NULL, 18, '2020-11-22 22:03:29', '2020-11-22 22:03:29'),
(19, '{\"en\":\"17\"}', '{\"en\":\"17\"}', NULL, 19, '2020-11-22 22:04:12', '2020-11-22 22:04:12'),
(20, '{\"en\":\"18\"}', '{\"en\":\"18\"}', NULL, 20, '2020-11-22 22:04:12', '2020-11-22 22:04:12'),
(21, '{\"en\":\"man\"}', '{\"en\":\"man\"}', NULL, 21, '2020-11-22 22:04:13', '2020-11-22 22:04:13'),
(22, '{\"en\":\"habibur\"}', '{\"en\":\"habibur\"}', NULL, 22, '2020-11-22 22:06:39', '2020-11-22 22:06:39'),
(23, '{\"en\":\"ibn\"}', '{\"en\":\"ibn\"}', NULL, 23, '2020-11-22 22:06:53', '2020-11-22 22:06:53'),
(24, '{\"en\":\"anwar\"}', '{\"en\":\"anwar\"}', NULL, 24, '2020-11-22 22:06:53', '2020-11-22 22:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mostafizur Rahman', 'mostafiza@gmail.com', '2020-09-19 03:17:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KaHQ62QS2U', '2020-09-19 03:17:54', '2020-09-19 03:17:54'),
(2, 'Dipayan Biswas', 'dipayan@gmail.com', '2020-09-19 03:17:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mBovfJ7Guc', '2020-09-19 03:17:55', '2020-09-19 03:17:55'),
(3, 'Rezwanul Islam', 'rezwanul7@gmail.com', '2020-09-19 03:17:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'HbQX13tSKe', '2020-09-19 03:17:55', '2020-09-19 03:17:55'),
(4, 'Habibur Rahman', 'habibur@gmail.com', '2020-09-19 03:17:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '86jVnzYu6BMfhPAkocDbSbwXfe3gY3VvlGInxVLaUf2No3slsSSDIbKFJCBz', '2020-09-19 03:17:56', '2020-09-19 03:17:56'),
(5, 'Souvik Kar', 'souvik@gmail.com', '2020-09-19 03:17:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KjJDl73E8oaNhLueFtIsN4Lx3O94XdYHXa5TwyLUERePQ6dmZDWcdsNNs5DY', '2020-09-19 03:17:56', '2020-09-19 03:17:56'),
(6, 'Koushik Roy', 'koushik@gmail.com', '2020-09-19 03:17:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ixmULnuMld', '2020-09-19 03:17:56', '2020-09-19 03:17:56'),
(7, 'Minhazul Arnab', 'minhazul@gmail.com', '2020-09-19 03:17:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qlHnf140e2', '2020-09-19 03:17:56', '2020-09-19 03:17:56'),
(8, 'Toufikur Rahman', 'toufikur@gmail.com', '2020-09-19 03:17:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'LMTjJSTK6f', '2020-09-19 03:17:56', '2020-09-19 03:17:56'),
(9, 'Reazul Rahi', 'reazul@gmail.com', '2020-09-19 03:17:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wuSla04kca', '2020-09-19 03:17:56', '2020-09-19 03:17:56'),
(10, 'Kamrun Nisha', 'kamrunnisha@gmail.com', '2020-09-19 03:17:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'D0ISgrSKz5', '2020-09-19 03:17:56', '2020-09-19 03:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_contacts`
--

CREATE TABLE `user_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_contacts`
--

INSERT INTO `user_contacts` (`id`, `name`, `email`, `description`, `visibility`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Adbul khalek', 'abdulkhalek@gmail.com', 'farmar', 1, 4, NULL, '2020-09-21 01:07:11', '2020-09-21 02:24:09'),
(2, 'anwar hossain', 'anwarhossain@gamil.com', 'farmar', 1, 4, NULL, '2020-09-21 01:09:34', '2020-09-21 02:11:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_info_index` (`info`(768)),
  ADD KEY `attendances_teacher_id_index` (`teacher_id`),
  ADD KEY `attendances_course_section_id_index` (`course_section_id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cards_cardable_type_cardable_id_index` (`cardable_type`,`cardable_id`),
  ADD KEY `cards_card_number_index` (`card_number`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_created_by_id_index` (`created_by_id`);

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `choices_created_by_id_index` (`created_by_id`);

--
-- Indexes for table `choice_question`
--
ALTER TABLE `choice_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `choice_question_question_id_index` (`question_id`),
  ADD KEY `choice_question_choice_id_index` (`choice_id`),
  ADD KEY `choice_question_created_by_id_index` (`created_by_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_property_id_index` (`property_id`),
  ADD KEY `courses_created_by_id_index` (`created_by_id`);

--
-- Indexes for table `course_section`
--
ALTER TABLE `course_section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_section_course_id_index` (`course_id`),
  ADD KEY `course_section_section_id_index` (`section_id`),
  ADD KEY `course_section_created_by_id_index` (`created_by_id`);

--
-- Indexes for table `course_section_teachers`
--
ALTER TABLE `course_section_teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_section_teachers_course_section_id_index` (`course_section_id`),
  ADD KEY `course_section_teachers_teacher_id_index` (`teacher_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_created_by_id_index` (`created_by_id`),
  ADD KEY `departments_property_id_index` (`property_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_property_type_id_index` (`property_type_id`),
  ADD KEY `properties_created_by_id_index` (`created_by_id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_types_created_by_id_index` (`created_by_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_created_by_id_index` (`created_by_id`);

--
-- Indexes for table `question_quiz`
--
ALTER TABLE `question_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_quiz_quiz_id_index` (`quiz_id`),
  ADD KEY `question_quiz_question_id_index` (`question_id`),
  ADD KEY `question_quiz_created_by_id_index` (`created_by_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizzes_category_id_index` (`category_id`),
  ADD KEY `quizzes_created_by_id_index` (`created_by_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_results_session_id_index` (`session_id`),
  ADD KEY `quiz_results_created_by_id_index` (`created_by_id`);

--
-- Indexes for table `quiz_sessions`
--
ALTER TABLE `quiz_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_sessions_quiz_name_index` (`quiz_name`),
  ADD KEY `quiz_sessions_quiz_id_index` (`quiz_id`),
  ADD KEY `quiz_sessions_created_by_id_index` (`created_by_id`);

--
-- Indexes for table `quiz_session_answers`
--
ALTER TABLE `quiz_session_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_session_answers_session_id_index` (`session_id`),
  ADD KEY `quiz_session_answers_question_id_index` (`question_id`),
  ADD KEY `quiz_session_answers_selected_choice_id_index` (`selected_choice_id`),
  ADD KEY `quiz_session_answers_created_by_id_index` (`created_by_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_created_by_id_index` (`created_by_id`),
  ADD KEY `sections_department_id_index` (`department_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_property_id_index` (`property_id`),
  ADD KEY `students_section_id_index` (`section_id`),
  ADD KEY `students_user_id_index` (`user_id`),
  ADD KEY `students_prefix_index` (`prefix`),
  ADD KEY `students_roll_number_index` (`roll_number`);

--
-- Indexes for table `taggables`
--
ALTER TABLE `taggables`
  ADD UNIQUE KEY `taggables_tag_id_taggable_id_taggable_type_unique` (`tag_id`,`taggable_id`,`taggable_type`),
  ADD KEY `taggables_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_contacts_email_unique` (`email`),
  ADD KEY `user_contacts_created_by_index` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `choice_question`
--
ALTER TABLE `choice_question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_section`
--
ALTER TABLE `course_section`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course_section_teachers`
--
ALTER TABLE `course_section_teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `question_quiz`
--
ALTER TABLE `question_quiz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `quiz_sessions`
--
ALTER TABLE `quiz_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quiz_session_answers`
--
ALTER TABLE `quiz_session_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_contacts`
--
ALTER TABLE `user_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_course_section_id_foreign` FOREIGN KEY (`course_section_id`) REFERENCES `course_section` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `choice_question`
--
ALTER TABLE `choice_question`
  ADD CONSTRAINT `choice_question_choice_id_foreign` FOREIGN KEY (`choice_id`) REFERENCES `choices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `choice_question_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `choice_question_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_section`
--
ALTER TABLE `course_section`
  ADD CONSTRAINT `course_section_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_section_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_section_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_section_teachers`
--
ALTER TABLE `course_section_teachers`
  ADD CONSTRAINT `course_section_teachers_course_section_id_foreign` FOREIGN KEY (`course_section_id`) REFERENCES `course_section` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_section_teachers_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `departments_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_property_type_id_foreign` FOREIGN KEY (`property_type_id`) REFERENCES `property_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_types`
--
ALTER TABLE `property_types`
  ADD CONSTRAINT `property_types_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_quiz`
--
ALTER TABLE `question_quiz`
  ADD CONSTRAINT `question_quiz_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_quiz_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_quiz_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quizzes_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_results_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `quiz_sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_sessions`
--
ALTER TABLE `quiz_sessions`
  ADD CONSTRAINT `quiz_sessions_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_sessions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_session_answers`
--
ALTER TABLE `quiz_session_answers`
  ADD CONSTRAINT `quiz_session_answers_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_session_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sections_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `taggables`
--
ALTER TABLE `taggables`
  ADD CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD CONSTRAINT `user_contacts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
