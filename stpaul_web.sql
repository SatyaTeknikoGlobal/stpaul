-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 29, 2021 at 08:32 AM
-- Server version: 10.1.47-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stpaul_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `forgot_token` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `rember_token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `email`, `password`, `forgot_token`, `phone`, `address`, `rember_token`, `status`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '$2y$10$6YXBXWOIzqXpyvvnnqY/5uoc84LryRYEC4YoAUuKctJZVgi3oSKdC', NULL, '123456789', 'Noida,UP', NULL, 1, '2021-08-04 11:28:13', '2021-11-10 11:36:05', '280921074701-logo.jpeg'),
(2, 'Admin', 'admin11', 'satyatekniko@gmail.com', '$2y$10$tC4im5CiNt0zmSIPCJtNROAyt9tdz4pqAX8E1TqwI/LbKRMYCHJj6', '', '123456789', 'Noida,UP', NULL, 1, '2021-08-04 11:28:13', '2021-11-11 07:28:43', '280921074701-logo.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `question_id` varchar(255) NOT NULL,
  `option_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `user_id`, `exam_id`, `question_id`, `option_no`, `status`, `created_at`, `updated_at`) VALUES
(1, '39', '5', '21', '1', '1', '2021-11-10 11:29:45', '2021-11-10 11:29:45'),
(2, '39', '5', '9', '1', '1', '2021-11-10 11:29:49', '2021-11-10 11:29:49'),
(3, '39', '5', '6', '1', '0', '2021-11-10 11:29:53', '2021-11-10 11:29:53'),
(4, '39', '5', '2', '2', '0', '2021-11-10 11:29:55', '2021-11-10 11:29:55'),
(5, '39', '5', '16', '2', '0', '2021-11-10 11:29:57', '2021-11-10 11:29:57'),
(6, '39', '5', '12', '2', '0', '2021-11-10 11:30:00', '2021-11-10 11:30:00'),
(7, '39', '5', '11', '1', '1', '2021-11-10 11:30:02', '2021-11-10 11:30:02'),
(8, '39', '5', '3', '2', '1', '2021-11-10 11:30:06', '2021-11-10 11:30:06'),
(9, '20', '3', '19', '1', '1', '2021-11-11 06:20:18', '2021-11-11 06:20:18'),
(10, '20', '3', '3', '', '0', '2021-11-11 06:21:24', '2021-11-11 06:21:24'),
(11, '20', '3', '3', '', '0', '2021-11-11 06:21:44', '2021-11-11 06:21:44'),
(12, '20', '3', '16', '', '0', '2021-11-11 06:21:55', '2021-11-11 06:21:55'),
(13, '20', '3', '13', '3', '0', '2021-11-11 06:21:58', '2021-11-11 06:21:58'),
(14, '20', '3', '8', '4', '0', '2021-11-11 06:22:01', '2021-11-11 06:22:01'),
(15, '20', '3', '11', '3', '0', '2021-11-11 06:22:08', '2021-11-11 06:22:08'),
(16, '20', '3', '18', '3', '0', '2021-11-11 06:22:17', '2021-11-11 06:22:17'),
(17, '20', '3', '21', '2', '0', '2021-11-11 06:22:21', '2021-11-11 06:22:21'),
(18, '20', '3', '12', '1', '1', '2021-11-11 06:22:24', '2021-11-11 06:22:24'),
(19, '20', '3', '9', '3', '0', '2021-11-11 06:22:34', '2021-11-11 06:22:34'),
(20, '20', '3', '15', '3', '0', '2021-11-11 06:22:41', '2021-11-11 06:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `app_versions`
--

CREATE TABLE `app_versions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `android_cur` int(11) NOT NULL,
  `android_man` int(11) NOT NULL,
  `ios_cur` int(11) NOT NULL,
  `ios_man` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_versions`
--

INSERT INTO `app_versions` (`id`, `android_cur`, `android_man`, `ios_cur`, `ios_man`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2020-12-17 00:18:37', '2020-12-17 00:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `attempted_exam`
--

CREATE TABLE `attempted_exam` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `exam_status` varchar(255) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attempted_exam`
--

INSERT INTO `attempted_exam` (`id`, `user_id`, `exam_id`, `status`, `exam_status`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, '39', '5', 1, 'completed', '2021-11-10 11:29:39', '2021-11-10 11:30:06', '2021-11-10 11:29:39', '2021-11-10 11:30:06'),
(2, '20', '3', 1, 'completed', '2021-11-11 06:19:16', '2021-11-11 06:22:58', '2021-11-11 06:19:16', '2021-11-11 06:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL COMMENT 'app,web',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner`, `link`, `type`, `status`, `created_at`, `updated_at`) VALUES
(19, '011021050311-education_101.png', NULL, 'web', 1, '2021-10-01 11:33:12', '2021-10-01 11:33:12'),
(20, '011021050338-education_100.png', NULL, 'web', 1, '2021-10-01 11:33:39', '2021-10-01 11:33:39'),
(21, '011021050427-education_100.png', NULL, 'app', 1, '2021-10-01 11:34:29', '2021-10-01 11:34:29'),
(22, '111121072132-BEBTECH.jpeg', NULL, 'app', 1, '2021-11-11 13:51:33', '2021-11-11 13:51:33'),
(23, '111121072333-BEBTECH.jpeg', NULL, 'app', 1, '2021-11-11 13:53:34', '2021-11-11 13:53:34'),
(24, '111121072347-BEBTECH.jpeg', NULL, 'web', 1, '2021-11-11 13:53:47', '2021-11-11 13:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `is_delete`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test', '220921112736-image_2021_09_13T05_00_38_890Z.png', 0, '2021-11-04 03:10:06', '2021-11-04 03:10:06'),
(2, 1, 'Test1', NULL, 0, '2021-11-04 03:09:58', '2021-11-04 03:09:58'),
(3, 1, 'Java', '280921074924-logo.jpeg', 0, '2021-11-04 03:09:54', '2021-11-04 03:09:54'),
(4, 1, 'php', NULL, 0, '2021-11-04 03:09:51', '2021-11-04 03:09:51'),
(5, 0, 'Exams Dec-2021', NULL, 1, '2021-11-04 03:10:46', '2021-11-04 03:10:46'),
(6, 0, 'Group payment', NULL, 1, '2021-11-20 12:59:12', '2021-11-20 12:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `demo`
--

CREATE TABLE `demo` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demo`
--

INSERT INTO `demo` (`id`, `name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'B'),
(4, 'C'),
(5, 'D'),
(6, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `marks_per_question` varchar(255) NOT NULL DEFAULT '1',
  `negetive_mark` varchar(255) NOT NULL DEFAULT '0',
  `course_id` varchar(255) DEFAULT NULL,
  `no_of_questions` varchar(255) DEFAULT '1',
  `description` longtext,
  `status` int(11) NOT NULL DEFAULT '1',
  `time_per_question` varchar(255) DEFAULT '10',
  `price` varchar(255) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `start_date`, `end_date`, `start_time`, `end_time`, `marks_per_question`, `negetive_mark`, `course_id`, `no_of_questions`, `description`, `status`, `time_per_question`, `price`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Java Test', '2021-10-30', NULL, '14:35:00', NULL, '2', '0.5', '3', '10', '<p>Java Test</p>', 1, '30', '10', 1, '2021-10-28 09:05:41', '2021-10-28 09:14:24'),
(2, 'BE/B.TECH', '2021-12-23', NULL, '11:00:00', NULL, '1', '0.25', '5', '100', '<p>INDIA&rsquo;S MOST TRUSTED EDUCATION ACADEMY IS COMING UP WITH PAN INDIA COMPETITIVE &nbsp;ONLINE EXAM FOR BE/B.TECH COMPLETED GRADUATES<br />\nCASH PRIZE:</p>\n\n<p><br />\nRANK 1: RS.20 LAKHS CASH PRIZE<br />\n(TOP 5 RANKERS &nbsp;WILL GET TRANING CUM JOB PLACEMENT IN REPUTED COMPANIES*)</p>\n\n<p><br />\nRANK 2 TO 20: RS.50000 FOR EACH WINNER</p>\n\n<p>&nbsp;<br />\nRANK 21 TO 100: RS.20000 FOR EACH WINNER</p>\n\n<p><br />\nFIELD OF STUDY: GENERAL KNOWLEDGE AND RESPECTIVE SUBJECT RELATED QUESTIONS</p>\n\n<p>ELIGIBILITY CRITERIA: BE OR B.TECH PASSED OUT</p>\n\n<p><br />\nAGE LIMIT: MAX. 34 YEARS</p>\n\n<p><br />\nTYPE OF QUESTIONS: 100 OBJECTIVE TYPE</p>', 1, '60', '2000', 0, '2021-10-28 09:16:30', '2021-11-04 03:09:26'),
(3, 'SSLC', '2021-12-18', NULL, '11:00:00', NULL, '1', '0.25', '5', '100', '<p>INDIA&rsquo;S MOST TRUSTED EDUCATION ACADEMY IS COMING UP WITH PAN INDIA COMPETITIVE &nbsp;ONLINE EXAM FOR SSLC&nbsp;COMPLETED GRADUATES<br />\r\nCASH PRIZE:</p>\r\n\r\n<p><br />\r\nRANK 1: RS.10 LAKHS CASH PRIZE<br />\r\n<br />\r\nRANK 2 TO 20: RS.50000 FOR EACH WINNER</p>\r\n\r\n<p>RANK 21 TO 100: RS.20000 FOR EACH WINNER</p>\r\n\r\n<p><br />\r\nFIELD OF STUDY: GENERAL KNOWLEDGE AND RESPECTIVE SUBJECT RELATED QUESTIONS</p>\r\n\r\n<p>ELIGIBILITY CRITERIA: SSLC PASSED OUT</p>\r\n\r\n<p><br />\r\nAGE LIMIT: MAX. 24 YEARS</p>\r\n\r\n<p><br />\r\nTYPE OF QUESTIONS: 100 OBJECTIVE TYPE</p>', 1, '60', '1000', 0, '2021-11-04 03:13:01', '2021-11-13 13:03:14'),
(4, 'Intermediate', '2021-12-15', NULL, '11:00:00', NULL, '1', '0.25', '5', '100', '<p>INDIA&rsquo;S MOST TRUSTED EDUCATION ACADEMY IS COMING UP WITH PAN INDIA COMPETITIVE &nbsp;ONLINE EXAM FOR&nbsp;INTERMEDIATE COMPLETED&nbsp;<br />\r\nCASH PRIZE:</p>\r\n\r\n<p><br />\r\nRANK 1: RS.10 LAKHS CASH PRIZE</p>\r\n\r\n<p>RANK 2 TO 20: RS.50000 FOR EACH WINNER</p>\r\n\r\n<p>RANK 21 TO 100: RS.20000 FOR EACH WINNER</p>\r\n\r\n<p>FIELD OF STUDY: GENERAL KNOWLEDGE AND RESPECTIVE SUBJECT RELATED QUESTIONS</p>\r\n\r\n<p>ELIGIBILITY CRITERIA: INTERMEDIATE&nbsp;PASSED OUT</p>\r\n\r\n<p><br />\r\nAGE LIMIT: MAX. 25&nbsp;YEARS</p>\r\n\r\n<p><br />\r\nTYPE OF QUESTIONS: 100 OBJECTIVE TYPE</p>', 1, '60', '1500', 0, '2021-11-04 03:16:37', '2021-11-13 13:02:52'),
(5, 'Test', '2021-11-10', NULL, '16:58:00', NULL, '2', '1', '5', '10', '<p>Test</p>', 1, '60', '1', 1, '2021-11-10 11:29:04', '2021-11-11 06:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` longtext,
  `answer` longtext,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(21, '<p>How and on which dates will the exam be conducted?</p>', '<p>The exam will be conducted in two Stages:</p>\r\n\r\n<p>Stage 1 would comprise of reasoning, aptitude and basic general knowledge and will be conducted on:</p>\r\n\r\n<p>Stage 2 is the thorough assessment of ones respective subject, and will be conducted on the:</p>', 1, '2021-10-02 04:05:29', '2021-10-11 05:40:20'),
(22, '<p>Who all can apply for this test?</p>', '<p>&nbsp;</p>\r\n\r\n<p>This two tiered test program by St Paul&#39;s Education Academy, is for intermediate, BE/ BTech students, graduation level students in the fields of arts, law and engineering.</p>', 1, '2021-10-02 04:05:29', '2021-10-11 05:33:39'),
(23, '<p>What is St Paul&#39;s Education Academy exams?</p>\r\n\r\n<p>&nbsp;</p>', '<p>St Paul&#39;s Education Academy&#39;s competitive test, is an attempt to boost the confidence and encourage young minds to prepare for national and international level exams. Young minds are thereby rewarded with cash prizes, scholarships and even placement offers from our honorable institution.</p>', 1, '2021-10-11 05:42:54', '2021-10-11 05:42:54'),
(24, '<p>&nbsp;How to apply for this exam?</p>', '<p>&nbsp;</p>\r\n\r\n<p>For applying, you have to kindly visit our link and register yourself for the examination.</p>\r\n\r\n<p>Link: https://stpaulseducationacademy.com/register</p>', 1, '2021-10-11 05:43:26', '2021-10-11 05:43:26'),
(25, '<p>What is the fee for registration?</p>\r\n\r\n<p>&nbsp;</p>', '<p>A generous amount of 2000 is applicable for registration.</p>', 0, '2021-10-11 05:43:48', '2021-11-08 05:20:42'),
(26, '<p>&nbsp;What is the fee for registration?</p>', '<p>A generous amount of 2000 is applicable for registration.</p>', 1, '2021-10-11 05:46:08', '2021-10-11 05:46:08'),
(27, '<p>&nbsp;How do you know that you are registered?</p>', '<p>We send you a confirmation message on both your number and email. The text message would comprise of your roll no, confirmation receipt and the examination timeline. You will further receive a confirmation call from our call center.</p>', 1, '2021-10-11 05:46:29', '2021-10-11 05:46:29'),
(28, '<p>What is the marking scheme for St Paul Education Academy exam?</p>', '<p>The marking scheme for all the students appearing for the examination is: 1 mark for each correct answer.</p>\r\n\r\n<p>There is negative marking as well. 0.25 marks shall be deducted for each wrong answer.</p>', 1, '2021-10-11 05:46:57', '2021-10-11 08:18:10'),
(29, '<p>What is the last day of registration for this examination?</p>', '<p>1 week before exam date</p>', 1, '2021-10-11 05:47:16', '2021-10-11 08:16:54'),
(30, '<p>&nbsp;What is the syllabus for the examination?</p>', '<p>The syllabus comprises of basic general knowledge questions and respective subject related</p>\r\n\r\n<p>You should be thorough with your respective subject that will be held in Stage 2.</p>', 1, '2021-10-11 05:48:04', '2021-10-11 05:48:04'),
(31, '<p>What is the Tiebreaker rule for the examination?</p>', '<p>Incase any two students or more than two students receive equal marks, we shall use their respective subject&#39;s mark held in Stage 2 for tiebreaker. But if both the students have received the same in Stage 2 as well, the student belonging to a lower age group shall secure the highest mark.</p>', 1, '2021-10-11 05:48:15', '2021-10-11 08:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `text`, `image`, `description`, `created_at`, `updated_at`, `title`) VALUES
(1, 9, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:04:01', '2021-09-06 09:04:01', NULL),
(2, 18, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:04:01', '2021-09-06 09:04:01', NULL),
(3, 19, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:04:02', '2021-09-06 09:04:02', NULL),
(4, 9, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:04:25', '2021-09-06 09:04:25', NULL),
(5, 18, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:04:25', '2021-09-06 09:04:25', NULL),
(6, 19, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:04:26', '2021-09-06 09:04:26', NULL),
(7, 9, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification/060921023516-gallery_three.png', 'test', '2021-09-06 09:05:18', '2021-09-06 09:05:18', NULL),
(8, 18, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification/060921023516-gallery_three.png', 'test', '2021-09-06 09:05:18', '2021-09-06 09:05:18', NULL),
(9, 19, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification/060921023516-gallery_three.png', 'test', '2021-09-06 09:05:19', '2021-09-06 09:05:19', NULL),
(10, 19, 'test pushpendra', 'https://fansstudio.devclub.co.in/public/storage/notification/060921024010-popular_two.jpg', 'test pushpendra', '2021-09-06 09:10:11', '2021-09-06 09:10:11', NULL),
(11, 19, 'test pushpendra', 'https://fansstudio.devclub.co.in/public/storage/notification/060921024048-gallery_four.png', 'test Pushpendra', '2021-09-06 09:10:51', '2021-09-06 09:10:51', NULL),
(12, 19, 'test pushpendra', 'https://fansstudio.devclub.co.in/public/storage/notification/060921024134-popular_three.jpg', 'test', '2021-09-06 09:11:35', '2021-09-06 09:11:35', NULL),
(13, 9, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:19:59', '2021-09-06 09:19:59', NULL),
(14, 18, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:19:59', '2021-09-06 09:19:59', NULL),
(15, 19, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:19:59', '2021-09-06 09:19:59', NULL),
(16, 9, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'tbh', '2021-09-06 09:21:32', '2021-09-06 09:21:32', NULL),
(17, 18, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'tbh', '2021-09-06 09:21:33', '2021-09-06 09:21:33', NULL),
(18, 19, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'tbh', '2021-09-06 09:21:33', '2021-09-06 09:21:33', NULL),
(19, 18, 'test pushpendra', 'https://fansstudio.devclub.co.in/public/storage/notification/060921030206-popular_three.jpg', 'test', '2021-09-06 09:32:07', '2021-09-06 09:32:07', NULL),
(20, 9, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:32:30', '2021-09-06 09:32:30', NULL),
(21, 18, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:32:31', '2021-09-06 09:32:31', NULL),
(22, 19, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:32:31', '2021-09-06 09:32:31', NULL),
(23, 18, 'test pushpendra', 'https://fansstudio.devclub.co.in/public/storage/notification', 'tfdsgg', '2021-09-06 09:33:21', '2021-09-06 09:33:21', NULL),
(24, 19, 'test pushpendra', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:42:02', '2021-09-06 09:42:02', NULL),
(25, 9, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:42:41', '2021-09-06 09:42:41', NULL),
(26, 18, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:42:41', '2021-09-06 09:42:41', NULL),
(27, 19, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification', 'test', '2021-09-06 09:42:42', '2021-09-06 09:42:42', NULL),
(28, 9, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification/060921031330-popular_two.jpg', 'testing bro', '2021-09-06 09:43:31', '2021-09-06 09:43:31', NULL),
(29, 18, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification/060921031330-popular_two.jpg', 'testing bro', '2021-09-06 09:43:31', '2021-09-06 09:43:31', NULL),
(30, 19, 'test', 'https://fansstudio.devclub.co.in/public/storage/notification/060921031330-popular_two.jpg', 'testing bro', '2021-09-06 09:43:31', '2021-09-06 09:43:31', NULL),
(31, 18, 'test pushpendra', 'https://fansstudio.devclub.co.in/public/storage/notification/060921031439-popular_three.jpg', 'test', '2021-09-06 09:44:40', '2021-09-06 09:44:40', NULL),
(32, 19, 'test pushpendra', 'https://fansstudio.devclub.co.in/public/storage/notification/060921031439-popular_three.jpg', 'test', '2021-09-06 09:44:40', '2021-09-06 09:44:40', NULL),
(33, 9, 'Fans Studio', 'https://fansstudio.devclub.co.in/public/storage/notification/060921053632-app_logo.png', 'Fans Studio', '2021-09-06 12:06:33', '2021-09-06 12:06:33', NULL),
(34, 18, 'Fans Studio', 'https://fansstudio.devclub.co.in/public/storage/notification/060921053632-app_logo.png', 'Fans Studio', '2021-09-06 12:06:33', '2021-09-06 12:06:33', NULL),
(35, 19, 'Fans Studio', 'https://fansstudio.devclub.co.in/public/storage/notification/060921053632-app_logo.png', 'Fans Studio', '2021-09-06 12:06:33', '2021-09-06 12:06:33', NULL),
(36, 9, 'Fans Studio', 'https://fansstudio.devclub.co.in/public/storage/notification', 'Fans StudioFans StudioFans StudioFans StudioFans StudioFans StudioFans Studio', '2021-09-06 13:04:11', '2021-09-06 13:04:11', NULL),
(37, 9, 'Fans Studio', 'https://fansstudio.devclub.co.in/public/storage/notification/140921040805-image_2021_09_13T05_00_38_890Z (1).png', 'Satya', '2021-09-14 10:38:06', '2021-09-14 10:38:06', NULL),
(38, 18, 'Fans Studio', 'https://fansstudio.devclub.co.in/public/storage/notification/140921040805-image_2021_09_13T05_00_38_890Z (1).png', 'Satya', '2021-09-14 10:38:06', '2021-09-14 10:38:06', NULL),
(39, 19, 'Fans Studio', 'https://fansstudio.devclub.co.in/public/storage/notification/140921040805-image_2021_09_13T05_00_38_890Z (1).png', 'Satya', '2021-09-14 10:38:07', '2021-09-14 10:38:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `exam_id` varchar(255) DEFAULT NULL,
  `question_name` longtext,
  `option_1` longtext,
  `option_2` longtext,
  `option_3` longtext,
  `option_4` longtext,
  `right_option` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `difficulti_level` varchar(255) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `exam_id`, `question_name`, `option_1`, `option_2`, `option_3`, `option_4`, `right_option`, `status`, `difficulti_level`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, NULL, '<p>10 typists can type 600 pages in 8 hours.Find the average number of pages typed by each typist in an hour.</p>', 'Option 1', 'Option 2', 'Option 2', 'Option 4', '1', 1, '1', 0, '2021-09-25 02:40:48', '2021-09-25 03:46:27'),
(2, NULL, '<p>Here</p>', 'sdsadsad', 'sadsad', 'sadsad', 'asdasd', '3', 1, '2', 0, '2021-09-25 03:46:42', '2021-09-25 03:46:42'),
(3, NULL, '<p>Herefdgergrtreterfgdfvbdfgfdgdfg</p>', 'sdsadsad', 'sadsad', 'sadsad', 'asdasd', '2', 1, '2', 0, '2021-09-25 03:46:58', '2021-10-25 07:12:07'),
(5, NULL, '<p>dsfgsdfds</p>', 'sdfsdfsd', 'fsdfsd', 'fsdfsdf', 'sdfsdf', '3', 1, '1', 0, '2021-10-01 06:06:59', '2021-10-01 06:06:59'),
(6, NULL, '<p>Here Question Name</p>', 'Option 1', 'Option 2', 'Option 2', 'Option 4', '3', 1, '3', 0, '2021-10-01 06:23:40', '2021-10-01 06:23:54'),
(7, NULL, 'Here Question Name', 'Option 1', 'Option 2 ', 'Option 2', 'Option 4', '1', 1, '1', 0, '2021-10-01 06:27:18', '2021-10-01 06:27:18'),
(8, NULL, 'Here Question Name', 'Option 1', 'Option 2 ', 'Option 2', 'Option 4', '1', 1, '1', 0, '2021-10-01 06:40:25', '2021-10-01 06:40:25'),
(9, NULL, '<p>sadasdsadsadsadsadsadasdsadsadsadsad</p>', 'asdsadsadsadsads', 'sadsadsad', 'sadsadsad', 'sadasdsadsadasd', '1', 1, '2', 0, '2021-10-01 08:44:55', '2021-10-01 08:45:20'),
(10, NULL, '<p>Here Question Name</p>', 'Option 1', 'Option 2', 'Option 2', 'Option 4', '1', 1, '3', 0, '2021-06-01 08:49:19', '2021-06-01 08:57:42'),
(11, '', '<p>fdgd</p>', '<p>g</p>', '<p>f</p>', '<p>f</p>', '<p>f</p>', '1', 1, '1', 0, '2021-10-23 11:08:14', '2021-10-23 11:08:14'),
(12, '', '<p>sdfsdf</p>', '<p>etetet</p>', '<p>d</p>', '<p>dd</p>', '<p>d</p>', '1', 1, '1', 0, '2021-10-23 11:08:36', '2021-10-23 11:08:36'),
(13, '', '<p>cf</p>', '<p>fc</p>', '<p>f</p>', '<p>fc</p>', '<p>cf</p>', '1', 1, '1', 0, '2021-10-23 11:08:52', '2021-10-23 11:08:52'),
(14, '', '<p>&nbsp; ffdd</p>', '<p>dfd</p>', '<p>dfd</p>', '<p>df</p>', '<p>df</p>', '1', 1, '1', 0, '2021-10-23 11:09:20', '2021-10-23 11:09:20'),
(15, '', '<p>fsddddddd</p>', '<p>dsssssd</p>', '<p>sd</p>', '<p>sdd</p>', '<p>sd</p>', '1', 1, '1', 0, '2021-10-26 06:19:40', '2021-10-26 06:19:40'),
(16, '', '<p>gdg</p>', '<p>df</p>', '<p>df</p>', '<p>dsf</p>', '<p>dfds</p>', '1', 1, '1', 0, '2021-10-26 06:31:42', '2021-10-26 06:31:42'),
(17, '', '<p>fsfad</p>', '<p>xz</p>', '<p>zxcz</p>', '<p>zxczx</p>', '<p>xzcz</p>', '1', 1, '1', 0, '2021-10-26 06:38:59', '2021-10-26 06:38:59'),
(18, '', '<p>ged</p>', '<p>df</p>', '<p>df</p>', '<p>fgd</p>', '<p>dgf</p>', '1', 1, '1', 0, '2021-10-26 09:03:16', '2021-10-26 09:03:16'),
(19, '', '<p>dfs</p>', '<p>xcx</p>', '<p>dss</p>', '<p>sdda</p>', '<p>cxz</p>', '1', 1, '1', 0, '2021-10-26 09:48:59', '2021-10-26 09:48:59'),
(20, '', '<p>cds</p>', '<p>xccccxc</p>', '<p>xc</p>', '<p>xc</p>', '<p>cxvx</p>', '1', 1, '1', 0, '2021-10-26 09:51:17', '2021-10-26 09:51:17'),
(21, '', '<p>dsf</p>', '<p>dsf</p>', '<p>sdf</p>', '<p>dsf</p>', '<p>dfs</p>', '1', 1, '1', 0, '2021-10-26 09:51:39', '2021-10-26 09:51:39'),
(22, '', '<p>dxc</p>', '<p>xc</p>', '<p>xc</p>', '<p>xc</p>', '<p>xc</p>', '1', 1, '1', 0, '2021-10-26 10:00:26', '2021-10-26 10:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `questions_not_valid`
--

CREATE TABLE `questions_not_valid` (
  `id` int(11) NOT NULL,
  `exam_id` varchar(255) DEFAULT NULL,
  `question_name` varchar(255) DEFAULT NULL,
  `option_1` varchar(255) DEFAULT NULL,
  `option_2` varchar(255) DEFAULT NULL,
  `option_3` varchar(255) DEFAULT NULL,
  `option_4` varchar(255) DEFAULT NULL,
  `right_option` varchar(255) DEFAULT NULL,
  `difficulti_level` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

CREATE TABLE `ranking` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `correct_ans` varchar(255) NOT NULL,
  `wrong_ans` varchar(255) NOT NULL,
  `skipped_ans` varchar(255) NOT NULL,
  `time_taken` varchar(255) NOT NULL,
  `rank` int(11) DEFAULT NULL,
  `marks` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ranking`
--

INSERT INTO `ranking` (`id`, `user_id`, `exam_id`, `correct_ans`, `wrong_ans`, `skipped_ans`, `time_taken`, `rank`, `marks`, `status`, `created_at`, `updated_at`) VALUES
(1, '39', '5', '4', '4', '2', '27', 1, '4', '1', '2021-11-10 11:30:06', '2021-11-10 11:30:06'),
(2, '20', '3', '2', '10', '88', '222', 1, '-0.5', '1', '2021-11-11 06:22:58', '2021-11-11 06:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `refer` varchar(255) DEFAULT NULL,
  `about` longtext,
  `privacy` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `refer`, `about`, `privacy`, `created_at`, `updated_at`) VALUES
(1, '10', NULL, NULL, '2021-09-23 06:41:20', '2021-09-23 06:41:20');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  `mrp` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `duration` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `name`, `description`, `status`, `mrp`, `price`, `is_delete`, `duration`, `date`, `created_at`, `updated_at`) VALUES
(1, 'Test', '<p>Test</p>', 1, '200', '169', 0, '365', '2021-08-04', '2021-08-22 23:35:48', '2021-09-04 09:37:11'),
(2, 'Test1', '<p>Test1</p>', 1, '500', '459', 0, '356', '2021-08-23', '2021-08-22 23:49:42', '2021-08-22 23:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `status` int(100) NOT NULL DEFAULT '1',
  `rating` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `user_name`, `image`, `text`, `status`, `rating`, `created_at`, `updated_at`) VALUES
(1, '3', '280921101143-logo.jpeg', '<p>St. Paul&rsquo;s Education Academy has been a golden chapter in my life. The course material is&nbsp; top-notch, and the faculty is professional yet friendly. With them, I was able to understand even the most complicated of concepts</p>', 1, '2', '2021-09-26 05:41:57', '2021-09-28 04:41:43'),
(2, '3', '280921101121-logo.jpeg', '<p>St. Paul&rsquo;s Education Academy has been a golden chapter in my life. The course material is&nbsp; top-notch, and the faculty is professional yet friendly. With them, I was able to understand even the most complicated of concepts</p>', 1, '5', '2021-09-26 05:41:57', '2021-10-21 07:16:05'),
(3, '6', NULL, '<p>St. Paul&rsquo;s Education Academy has been a golden chapter in my life. The course material is&amp;nbsp; top-notch, and the faculty is professional yet friendly. With them, I was able to understand even the most complicated of concepts</p>', 1, NULL, '2021-10-11 06:45:15', '2021-10-11 06:45:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `referral_code` varchar(255) DEFAULT NULL,
  `referral_userID` varchar(255) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `wallet` varchar(255) NOT NULL DEFAULT '0',
  `referal_code` varchar(255) DEFAULT NULL,
  `refer_id` varchar(255) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `photo`, `gender`, `dob`, `status`, `referral_code`, `referral_userID`, `id_card`, `transaction_id`, `wallet`, `referal_code`, `refer_id`, `is_delete`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test1', '$2y$10$PQSFG23ST9hyzJm3zPYycuHX7uEqsFWMS3Y.UBlhZyBI3Mzprm3q6', 'admin@gmail.com', '6370371406', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '0', NULL, NULL, 0, NULL, '2021-09-21 07:32:51', '2021-09-24 07:35:03'),
(3, 'Praveen Kumar', '$2y$10$wu6arhVfQYMs9sJnyO2trOhS4cN90Lap9oIewoTYWVUuhdwF6DE1i', 'bobby.praveen@gmail.com', '+919591726991', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '0', NULL, NULL, 0, NULL, '2021-09-23 03:31:22', '2021-09-23 03:31:22'),
(4, 'Vibhas', '$2y$10$D4IEGqElbroDTthbcnJD5uYdEjJ7rlrHYUYMCnY72k/rd.ojB4K3S', 'vibhas1326@gmail.com', '9311620027', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '0', NULL, NULL, 0, NULL, '2021-09-23 05:38:09', '2021-09-23 05:38:09'),
(5, 'Vibhas', '$2y$10$sNhyP9LJtIizJ9Hc0BTZzucw1z/0PVPHtHW/OAqqLxTk8cVdaxITm', 'vibhas1326@gmail.com', '9311620027', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '0', NULL, NULL, 0, NULL, '2021-09-23 05:42:40', '2021-09-23 05:42:40'),
(6, 'Test1', '$2y$10$AGafy43ZYwMRRd1AyDSIFuLrP1qVvQK.pIK6vjEwRVHJ5t5bbNAte', 'admin11@gmail.com', '775196717511', '230921121850-plumber-work-bathroom-260nw-267609398.jpg', NULL, NULL, 1, 'ZYPVGWKV', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-09-23 06:48:50', '2021-09-23 06:48:50'),
(8, 'Praveen Kumar', '$2y$10$I4qsilkGK2eU1cmeviiBsO1eHX.Wvds98qNro2Yk.HJFEN0FzBJ0i', 'bobby.praveen27@gmail.com', '9591726991', NULL, NULL, NULL, 1, 'URWRIVUO', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-09-24 11:38:07', '2021-09-24 15:45:30'),
(10, 'Test', 'e19d5cd5af0378da05f63f891c7467af', 'testnew@gmail.com', '1234512345', '011021090846-andrew-pons-9713-2000x1333.jpg', NULL, NULL, 1, '0UKEKGE5', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-09-28 05:04:47', '2021-10-01 15:38:47'),
(11, 'anisha', '$2y$10$oIc24w8OpD8iAOn94kIUVOqVn9v0GoL/VShXt0VRCm4q9uN3qdpU2', 'anisha@teknikoglobal.com', '7733930397', NULL, NULL, NULL, 1, '7LRUAK5C', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-09-28 11:59:47', '2021-10-04 12:59:51'),
(13, 'user2', '$2y$10$o9L6LcohgPNUo42mbcPEA.WYQ9ekBk3yrZS5iWDl77fuX0kqEekd6', 'user2@gmail.com', '1231230201', NULL, 'male', '2006-05-11', 1, '5CWOEFCZ', NULL, NULL, NULL, '0', NULL, NULL, 0, NULL, '2021-10-12 06:38:49', '2021-10-12 06:38:49'),
(14, 'anisha', '$2y$10$g4NCVZa/7JC.Le.V5Yzvsuag1P59Rujx/GzQ.aP6N5Is35StTlLwe', 'admin11@gmnnm.fvg', '7906823911', NULL, NULL, NULL, 1, 'SIKP4WRT', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-13 11:34:27', '2021-10-13 11:34:27'),
(15, 'student1', '$2y$10$MMGLLpsEDR3OmlOt1FWQjua/ata70tnZguYYCRky6BAqf0JtSrO1S', 'std1001@gmail.com', '4561230120', NULL, 'male', NULL, 1, 'MNSOLB4Y', NULL, NULL, NULL, '0', NULL, NULL, 0, NULL, '2021-10-16 06:00:24', '2021-10-16 06:00:24'),
(16, 'Satya', '$2y$10$/KdIX9trbkd0SGLqStg5QedEcW.bENR8V9sYSB4yBz5mGUqJiynKW', 'satya@gmail.com', '1234567890', NULL, NULL, NULL, 1, 'AXK0L3PP', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-20 10:34:30', '2021-10-20 10:34:30'),
(17, 'd', '$2y$10$gNORhFIYnPoi7XIvpOaEBuA.GeuG2tCt9WSOyD/..NpIxixjVX1L2', 'd@gmail.d', 'dd', NULL, NULL, NULL, 1, 'EQ7KSALU', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-20 11:20:46', '2021-10-20 11:20:46'),
(18, 'test_user', '$2y$10$z4EtPsYo8gA6x5QcmH5Ef.KaexUl/zWDa7eKVXdvkROqjA5pxWKxm', 'test_user121@gmail.com', '4564564500', NULL, 'male', '2021-10-22', 1, 'P4YAAWGR', NULL, NULL, NULL, '0', NULL, NULL, 0, NULL, '2021-10-20 11:47:35', '2021-10-20 11:47:35'),
(19, 'vibhas', '$2y$10$q8X2RvOpPerFY4WGnDRzj.aAM8CKKYd6/zUViOFGPhDvjbIhjj4LO', 'vibhas13261@gmail.com', '1231231234', '211021020002-education_101.png', NULL, NULL, 1, '42GT3986', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-21 05:34:22', '2021-10-21 08:30:03'),
(20, 'anisha', '$2y$10$K/j8LK8yqz69gt3RHEQVGuS6bO8hUV5kMRXiyzUxZzw40B/AUM.aS', 'anisha@gmail.com', '8282828282', '111121124628-user.png', NULL, NULL, 1, 'WGDFZQL8', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-21 08:30:58', '2021-11-11 07:16:28'),
(21, 'testing', '$2y$10$DUpsnmXT.lhnOQkpxUGgJuMiAuoZE04oAtu1vqzOFYz9U5gmAToTS', 'testing121@gmail.com', '1200000000', NULL, NULL, NULL, 1, 'A00LDNDF', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-22 04:34:22', '2021-10-22 04:34:22'),
(22, 'testing user1', '$2y$10$r1/TNQjYKvTxUaXkTCL41eG5jJe1FnfOAMOYq90x0mAbApcyVth1u', 'testinguser1@gmail.com', '6666666666', NULL, NULL, NULL, 1, '0SV1FKBC', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-22 04:46:01', '2021-10-22 04:46:01'),
(23, 'mansha', '$2y$10$QXXz1c/g4deu18wiSmd.lOdYC0EJ4ItVtEhEJiOAJzugeIp5vsRYC', 'mansha@gmail', '7557448060', '251021031152-image50 (1).png', NULL, NULL, 1, 'Y6J49SXY', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-25 09:41:52', '2021-10-25 09:41:52'),
(24, 'man', '$2y$10$RfXcCXQsg4mHmXO2.2JKa.1nNTgdxVSAXD9V7MkHIk5rbdFghs6YS', 'man@gmail.com', '5656', NULL, NULL, NULL, 1, 'R7PA5T35', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-25 11:03:06', '2021-10-25 11:03:06'),
(25, 'linke', '$2y$10$wOs.1deqruI3HHI3azg3aOCk.2WZB7y8Hr12Z6z4rBmfWVw5yvRzO', 'linke@gmail.com', '7557448066', NULL, NULL, NULL, 1, 'YU38S8S1', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-25 12:20:03', '2021-10-25 12:20:03'),
(26, 'Vibhas', '$2y$10$9KrmI4kFa2K6cKTSeHeNZuMbqATQ1Yh0P6g9LbuD8wENdM4vK2WH2', 'vibhas0026@gmail.com', '9310025022', '251021060242-PHOTO.jpg', NULL, NULL, 1, 'R7WQWL6J', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-25 12:31:48', '2021-10-25 12:32:42'),
(27, 'Vibhas', '$2y$10$J7oCsvLALH/7OOnaFZ1DIOU6ceJsNsEsGfR6FsqsLJrQ3pL1yUfMO', 'vibhas1126@gmail.com', '1234567897', NULL, NULL, NULL, 1, 'YOY39YMK', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-25 12:36:19', '2021-10-25 12:36:19'),
(28, 'sonal gupta1111111', '$2y$10$baOtSBa.YVfEd/aYKk.38ezPKcduYueySTg71/EEPYYJ9azecdzYK', 'sss@gmail.com', '12331213123', NULL, NULL, NULL, 1, '9PLQ2NQR', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-25 12:54:47', '2021-10-25 12:54:47'),
(29, 'Vibhas', '$2y$10$tGE8NFK6lnT.CTwIkKtt6ODpdXYE.8zVC7MWE0I3RGynrmE.GQhbG', 'vibhas0326@gmail.com', '9311620028', NULL, NULL, NULL, 1, 'BZPAS57L', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-25 13:32:06', '2021-10-25 13:32:06'),
(30, 'man', '$2y$10$a76UXGxIt5MkmQ5rfjt3b./IM2lMhSxBx7KBOPSYFVRpPEEBtsQcq', 'man4@gmail.com', '123365587', NULL, NULL, NULL, 1, 'PK3B4IPD', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-26 04:35:01', '2021-10-26 04:35:01'),
(31, 'linke2', '$2y$10$xsdXtHBctuUBrWtA4nPfN.o4F1IuEPEIqkcw4hnxra6tdHkxadKY.', 'linke2@gmail.com', '7557448063', NULL, NULL, NULL, 1, '22MDVIGS', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-26 04:38:19', '2021-10-26 04:38:19'),
(32, 'Sudhakar reddy', '$2y$10$Yt70GsN.4KxCS38W9NnD9.XIQjo3DNw7OB4U9SvuN5Z/HX1OCetLO', 'isr.induri@gmail.com', '94945301315', NULL, NULL, NULL, 1, '6KAVHHFW', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-26 07:13:46', '2021-10-26 07:13:46'),
(33, 'Vibhas', '$2y$10$Fw/kt0ea/QS/4HPPTfxTU.9crxTHdv8mMwda7gkZs4eDhoAd3bnw2', 'vibhas3326@gmail.com', '7321961084', '261021042228-PHOTO.jpg', NULL, NULL, 1, 'G2GTM6KD', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-26 10:51:48', '2021-10-26 10:52:28'),
(34, 'Rajanaraimulu', '$2y$10$KLDLDkq68IAdtm09ymrS/eR2.wuPVE.GT1QkGzJrkDjsDUbiMOq7W', 'ssenterprises2428@gmail.com', '9959992172', NULL, NULL, NULL, 1, 'G5KFZR1Z', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-10-28 13:42:01', '2021-10-28 13:42:01'),
(35, 'Rinku', '$2y$10$0wG3hEaNhu6kmtxB3KvdheswIYKWTx6jKd9bh5FHIau9qVks2SP8K', 'Sravanthi2904kourolla@gmail.com', '9652818780', NULL, NULL, NULL, 1, 'NSJ8HPUP', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-11-04 15:25:55', '2021-11-04 15:25:55'),
(36, 'Testing', '$2y$10$WshG.alxLVhJAY0Hj81rHuNoepjvS24Js/iAW0dK2iqby1KUys1EG', 'testing@gmail.com', '9999999999', NULL, NULL, NULL, 1, 'MLCEY9GU', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-11-06 08:45:49', '2021-11-06 08:45:49'),
(37, 'Shirisha', '$2y$10$JDZvxXwyYb5K9y5RmTXtGOOaxwSG79QX/lKRRtSZFJDkPx.mn8.VC', 'mekalashirisha1999@gmail.com', '9398375210', NULL, NULL, NULL, 1, 'EG0G1I4V', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-11-06 08:47:12', '2021-11-06 08:47:12'),
(38, 'asha', '$2y$10$5IToH4QFEmhXAuWSNP.pg.apjU4e1xQY40zG7dJxgE0G19ouW4.02', 'kumarileka052@gmail.com', '9494530315', NULL, NULL, NULL, 1, 'YDV2PN6D', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-11-08 08:39:16', '2021-11-08 08:39:16'),
(39, 'Satyanarayan Sahoo', '$2y$10$DkFtWlcIUmtaR/ip1VTuCe6ck0.Ys5qdQKSbnX8XaFr89HjeVlBCy', 'satyasahoo7751@gmail.com', '1234512348', '101121050507-nopizzaimage.jpg', NULL, NULL, 1, 'VB2C2QFF', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-11-10 11:27:11', '2021-11-10 11:35:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_exam`
--

CREATE TABLE `user_exam` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `amount` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_exam`
--

INSERT INTO `user_exam` (`id`, `exam_id`, `user_id`, `status`, `amount`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 1, '10', 'pay_IEhctNeXiciWsE', '2021-10-28 09:12:53', '2021-10-28 09:12:53'),
(2, 2, 8, 1, '30', 'pay_IEhmn6wK8M6xPT', '2021-10-28 09:22:25', '2021-10-28 09:22:25'),
(3, 2, 19, 1, NULL, 'admin_added', '2021-10-28 09:26:19', '2021-10-28 09:26:19'),
(4, 2, 19, 1, NULL, 'admin_added', '2021-10-28 09:26:26', '2021-10-28 09:26:26'),
(5, 2, 39, 1, NULL, 'admin_added', '2021-11-10 11:28:10', '2021-11-10 11:28:10'),
(6, 5, 39, 1, NULL, 'admin_added', '2021-11-10 11:29:26', '2021-11-10 11:29:26'),
(7, 3, 20, 1, '1', 'pay_IKC76PIgNZZBbE', '2021-11-11 06:17:25', '2021-11-11 06:17:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deviceType` varchar(255) DEFAULT NULL,
  `deviceID` varchar(255) DEFAULT NULL,
  `deviceToken` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `deviceType`, `deviceID`, `deviceToken`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 6, 'ANDROID', '35388f323b06d646', 'caNj6cY0SyeUk4jSosTuSY:APA91bHGrFp05fOvH8QhYCeYPpHA9lKrxA_2w6MYlJvkOdP0hLv8yfQ6GQwmF6iYyk6tPIaLunkX_Re46Qo40TXxVT1TW-hfEKHJ65CUH1KES2Sk-u0HJ7EaJ1mBXHBKTe42NEIEd5Ns', '122.177.131.60', '2021-09-03 07:00:18', '2021-09-03 07:00:18'),
(2, 9, 'ANDROID', 'dsa', 'cSKH1v4HSHi7sDLlwCwTJR:APA91bFcreiSG8sfcwdlWseiawowQjG1pcH4C0-61DIdWugr_Clcuj8Fc2Efnu3WKysXFR4BKIrx84W0YZPjIGQilw8954YzpdfVUK8TjyP43pCEn9vwicG78vi1pXQ_UK7StmjUpzNE', '122.177.131.60', '2021-09-03 07:00:20', '2021-09-06 12:47:10'),
(3, 19, 'ANDROID', 'df91630ecd8724df', 'eW4AzfkdTT6-JUKJ9Wz_lt:APA91bHAmCUbZS9rk2bV34_0RaDkUV6p13oxR2n68B4oBuEmmkTSaVIttKjbRQSA9wKBA183YEpU4N-4a5mgRiQLXA64RrRXS5b9Cy19ZRL2g_3oM7ISQCSW9QefMHTPnPN_E9jgt-yD', '122.177.131.60', '2021-09-03 07:10:34', '2021-09-06 10:42:57'),
(4, 18, 'ANDROID', 'df91630ecd8724df', 'fIRHyd-vRnSmKxTRrZfhP6:APA91bEDgpwd7TwQCEnc6CjP9_krasa1vbLTUegMm7cJUI7y0bxqgH7XXYg9ufJCHdb74m655rnapOoGRyi_XGq4hzQ49JHLKOcPlVmsFkMGQau9Yb-OibaeBKDmfM__o3u2v4bBBlNQ', '122.177.88.235', '2021-09-06 04:55:32', '2021-09-13 10:29:08'),
(5, 12, 'ANDROID', '00cf07021a944f80', 'fY17Hi1KSieUxv06Ayj2nh:APA91bGyTjDENSGcfBnbpUmV9DA88cMl3SFbkel85vj8RPdFeGM76wq1vxEs_aq2nq4JQdme4zK0t85B4Hx6rbDp-Sv7sM0IBNVGFx8eKHZaCHo3-PnI-EKsxvFUqfjKufbGNhxKqbBh', '47.31.177.117', '2021-09-17 13:42:03', '2021-09-17 13:42:03'),
(6, 20, 'ANDROID', '42ebbc4cb53a5656', 'fQvnop66SCG0SZlESKEJ6O:APA91bE1Iykwq7usPd9sfdeKQF3jRUFSAIey1XS-qTRwXh9mTbMY7AU-f9LPx-Mn91ShmT9InAffKl390zHW-PCDzQSlDT32P0ILeCoImQpSvgpfqCx7SgJ9ahLnf8fsBOidiiK9xrKs', '103.214.60.201', '2021-09-18 07:24:51', '2021-09-18 07:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_otp`
--

CREATE TABLE `user_otp` (
  `id` int(11) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `otp` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timestamp` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_otp`
--

INSERT INTO `user_otp` (`id`, `mobile`, `email`, `otp`, `created_at`, `timestamp`, `updated_at`) VALUES
(1, '7751967175', NULL, '1234', '2021-09-24 07:11:14', NULL, '2021-09-24 07:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `subscription_id` int(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_subscriptions`
--

INSERT INTO `user_subscriptions` (`id`, `user_id`, `subscription_id`, `start_date`, `end_date`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 6, 2, '2021-08-24', '2021-08-24', 1, 0, '2021-08-24 04:36:11', '2021-08-24 04:36:11'),
(2, 9, 2, '2021-08-24', '2021-08-24', 1, 0, '2021-08-24 04:36:11', '2021-08-24 04:36:11'),
(3, 12, 1, '2021-09-04', '2021-09-04', 1, 0, '2021-09-04 09:37:27', '2021-09-04 09:37:27');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transaction`
--

CREATE TABLE `wallet_transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_versions`
--
ALTER TABLE `app_versions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attempted_exam`
--
ALTER TABLE `attempted_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demo`
--
ALTER TABLE `demo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions_not_valid`
--
ALTER TABLE `questions_not_valid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_exam`
--
ALTER TABLE `user_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_otp`
--
ALTER TABLE `user_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_transaction`
--
ALTER TABLE `wallet_transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `app_versions`
--
ALTER TABLE `app_versions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attempted_exam`
--
ALTER TABLE `attempted_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `demo`
--
ALTER TABLE `demo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `questions_not_valid`
--
ALTER TABLE `questions_not_valid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ranking`
--
ALTER TABLE `ranking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_exam`
--
ALTER TABLE `user_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_otp`
--
ALTER TABLE `user_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wallet_transaction`
--
ALTER TABLE `wallet_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
