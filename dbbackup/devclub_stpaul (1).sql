-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 28, 2021 at 04:31 AM
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
-- Database: `devclub_stpaul`
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

INSERT INTO `admins` (`id`, `name`, `username`, `email`, `password`, `phone`, `address`, `rember_token`, `status`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '$2y$10$6YXBXWOIzqXpyvvnnqY/5uoc84LryRYEC4YoAUuKctJZVgi3oSKdC', '123456789', 'Noida,UP', NULL, 1, '2021-08-04 11:28:13', '2021-09-28 02:17:02', '280921074701-logo.jpeg');

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
(18, '240921092158-logo.jpeg', NULL, 'web', 1, '2021-09-24 15:51:58', '2021-09-24 15:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Test', '220921112736-image_2021_09_13T05_00_38_890Z.png', 1, '2021-09-22 07:07:23', '2021-09-22 07:07:23'),
(2, 'Test1', NULL, 1, '2021-09-22 09:58:41', '2021-09-22 09:58:41'),
(3, 'Java', '280921074924-logo.jpeg', 1, '2021-09-28 02:19:24', '2021-09-28 02:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `course_id` varchar(255) DEFAULT NULL,
  `description` longtext,
  `status` int(11) NOT NULL DEFAULT '1',
  `price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `start_date`, `end_date`, `start_time`, `end_time`, `course_id`, `description`, `status`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Exam-1', '2021-09-21', '2021-09-23', '11:03:56', '25:03:56', '1', 'Exam1', 1, '300', '2021-09-21 05:34:27', '2021-09-21 05:34:27'),
(2, 'Exam-211', '2021-09-21', '2021-09-23', '00:00:00', '15:03:00', '2', '<p>Exam2</p>', 1, '3000', '2021-09-21 05:34:27', '2021-09-23 09:33:23'),
(3, 'Test Video', '2021-09-24', '2021-09-25', '16:00:00', '22:00:00', '1', '<p>asdfsdaf</p>', 1, '1000', '2021-09-24 10:30:51', '2021-09-24 10:30:51'),
(4, 'Test Exam', '2021-09-24', '2021-09-30', '17:15:00', '23:15:00', '2', '<p>Test Exam</p>', 1, '300', '2021-09-24 11:46:30', '2021-09-24 11:46:30'),
(5, 'Java Exam', '2021-09-30', '2021-09-30', '10:00:00', '11:00:00', '3', '<p>This exam is for Vidhnikethan collage&nbsp;</p>', 1, '50', '2021-09-24 11:49:28', '2021-09-25 02:18:25');

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
  `question_name` varchar(255) DEFAULT NULL,
  `option_1` varchar(255) DEFAULT NULL,
  `option_2` varchar(255) DEFAULT NULL,
  `option_3` varchar(255) DEFAULT NULL,
  `option_4` varchar(255) DEFAULT NULL,
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
(1, '5', '<p>Here Question Name Test</p>', 'Option 1', 'Option 2', 'Option 2', 'Option 4', '1', 1, '1', 0, '2021-09-25 02:40:48', '2021-09-25 03:46:27'),
(2, '5', '<p>Here</p>', 'sdsadsad', 'sadsad', 'sadsad', 'asdasd', '3', 1, '1', 0, '2021-09-25 03:46:42', '2021-09-25 03:46:42'),
(3, '5', '<p>Herefdgergrtreterfgdfvbdfgfdgdfg</p>', 'sdsadsad', 'sadsad', 'sadsad', 'asdasd', '2', 1, '2', 0, '2021-09-25 03:46:58', '2021-09-25 03:47:44');

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
(1, '4', '260921013851-logo.jpeg', '<p>St. Paul&rsquo;s Education Academy has been a golden chapter in my life. The course material is&nbsp; top-notch, and the faculty is professional yet friendly. With them, I was able to understand even the most complicated of concepts</p>', 1, '2', '2021-09-26 05:41:57', '2021-09-26 08:08:51'),
(2, '4', '260921013851-logo.jpeg', '<p>St. Paul&rsquo;s Education Academy has been a golden chapter in my life. The course material is&nbsp; top-notch, and the faculty is professional yet friendly. With them, I was able to understand even the most complicated of concepts</p>', 1, '5', '2021-09-26 05:41:57', '2021-09-26 08:08:51');

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
(8, 'Praveen Kumar', '$2y$10$I4qsilkGK2eU1cmeviiBsO1eHX.Wvds98qNro2Yk.HJFEN0FzBJ0i', 'bobby.praveen27@gmail.com', '9591726991', NULL, NULL, NULL, 1, 'URWRIVUO', NULL, NULL, NULL, '0', NULL, '0', 0, NULL, '2021-09-24 11:38:07', '2021-09-24 15:45:30');

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
-- Dumping data for table `wallet_transaction`
--

INSERT INTO `wallet_transaction` (`id`, `user_id`, `type`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(1, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:01:56', '2021-08-24 12:01:56'),
(2, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:07', '2021-08-24 12:02:07'),
(3, 6, 'DEBIT', '200', 'xcvs', '2021-08-24 12:02:07', '2021-08-24 12:02:07'),
(4, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:07', '2021-08-24 12:02:07'),
(5, 6, 'DEBIT', '200', 'xcvs', '2021-08-24 12:02:07', '2021-08-24 12:02:07'),
(6, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:07', '2021-08-24 12:02:07'),
(7, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:07', '2021-08-24 12:02:07'),
(8, 6, 'DEBIT', '200', 'xcvs', '2021-08-24 12:02:07', '2021-08-24 12:02:07'),
(9, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:07', '2021-08-24 12:02:07'),
(10, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:07', '2021-08-24 12:02:07'),
(11, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:07', '2021-08-24 12:02:07'),
(12, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(13, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(14, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(15, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(16, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(17, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(18, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(19, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(20, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(21, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(22, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(23, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(24, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(25, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(26, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(27, 6, 'CREDIT', '200', 'xcvs', '2021-08-24 12:02:17', '2021-08-24 12:02:17'),
(28, 12, 'CREDIT', '20', 'xcvxcv', '2021-08-27 06:56:14', '2021-08-27 06:56:14'),
(29, 12, 'CREDIT', '20', 'xcvxcv', '2021-08-27 06:56:35', '2021-08-27 06:56:35'),
(30, 12, 'DEBIT', '10', 'vcbcv', '2021-08-27 06:56:58', '2021-08-27 06:56:58'),
(31, 12, 'DEBIT', '50', '', '2021-08-27 06:57:14', '2021-08-27 06:57:14'),
(32, 12, 'DEBIT', '10', '', '2021-08-27 06:58:59', '2021-08-27 06:58:59'),
(33, 12, 'CREDIT', '50', '', '2021-08-27 07:11:03', '2021-08-27 07:11:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_versions`
--
ALTER TABLE `app_versions`
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
-- Indexes for table `exams`
--
ALTER TABLE `exams`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_versions`
--
ALTER TABLE `app_versions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions_not_valid`
--
ALTER TABLE `questions_not_valid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_exam`
--
ALTER TABLE `user_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
