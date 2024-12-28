-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2024 at 02:35 AM
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
-- Database: `stctilms`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `libraryId` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `name`, `libraryId`, `date`, `created_at`, `updated_at`) VALUES
(10, 'JAMES', '111', '2024-11-05', '2024-11-05 03:53:27', '2024-11-05 03:53:27'),
(11, 'JAMES', '111', '2024-11-06', '2024-11-06 02:07:17', '2024-11-06 02:07:17'),
(12, 'JAMES', '222', '2024-11-09', '2024-11-09 14:42:35', '2024-11-09 14:42:35'),
(13, 'JAMES3', '333', '2024-12-10', '2024-12-09 23:25:06', '2024-12-09 23:25:06'),
(14, 'JAMES', '111', '2024-12-25', '2024-12-24 17:30:15', '2024-12-24 17:30:15'),
(15, 'JAMES', '111', '2024-12-26', '2024-12-25 18:03:23', '2024-12-25 18:03:23'),
(16, 'JAMES', '111', '2024-12-27', '2024-12-26 23:49:19', '2024-12-26 23:49:19'),
(17, 'STUDENT', '444', '2024-12-28', '2024-12-27 23:30:45', '2024-12-27 23:30:45'),
(18, 'INSTRUCTOR', '555', '2024-12-28', '2024-12-27 23:54:19', '2024-12-27 23:54:19'),
(19, 'JAMES', '111', '2024-12-28', '2024-12-28 00:56:56', '2024-12-28 00:56:56');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `accNo` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `synopsis` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `accNo`, `status`, `author`, `synopsis`, `created_at`, `updated_at`, `image_path`) VALUES
(23, 'ABRA KADABRUHHH', '555', 'Phased Out', 'james', 'asdasd', '2024-11-06 02:42:23', '2024-12-26 15:16:46', '1730889743-555-jpg'),
(25, 'CRIMINAL JUSTICE TODAY: AN INTRODUCTORY TEXT FOR THE 21ST CENTURY', '2222', 'Phased Out', 'Frank Schmalleger', 'asdasdasd', '2024-12-09 23:06:24', '2024-12-26 23:56:59', '1733814384-2222-jpg'),
(26, 'CRIMINAL JUSTICE TODAY: AN INTRODUCTORY TEXT FOR THE 21ST CENTURY', '32323232', 'Available', 'Frank Schmalleger', 'qweqw qweqw e', '2024-12-09 23:06:33', '2024-12-27 01:18:30', '1733814393-32323232-jpg'),
(31, 'TEST', '121212', 'Available', 'asdasd', 'asdasd', '2024-12-27 01:36:50', '2024-12-27 01:36:50', '1735263410-121212-png');

-- --------------------------------------------------------

--
-- Table structure for table `borrowedbooks`
--

CREATE TABLE `borrowedbooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `libraryId` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `accNo` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `borrowedDate` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `delay` int(11) DEFAULT NULL,
  `form` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrowedbooks`
--

INSERT INTO `borrowedbooks` (`id`, `name`, `libraryId`, `title`, `date`, `accNo`, `status`, `borrowedDate`, `duration`, `delay`, `form`, `remarks`, `created_at`, `updated_at`) VALUES
(85, 'JAMES', '111', 'CRIMINAL JUSTICE TODAY: AN INTRODUCTORY TEXT FOR THE 21ST CENTURY', '2024-12-28 at 08:56 AM', '32323232', 'Pending', NULL, NULL, NULL, 'Unclaimed', NULL, '2024-12-28 00:57:12', '2024-12-28 00:57:12');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_05_060033_create_attendance_table', 1),
(6, '2024_10_05_060049_create_books_table', 1),
(7, '2024_10_05_060057_create_borrowedbooks_table', 1),
(8, '2024_10_05_060107_create_records_table', 1),
(9, '2024_10_05_060124_create_suggfeed_table', 1),
(10, '2024_10_14_022059_add_image_to_books', 2);

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
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `libraryId` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `accNo` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `borrowedDate` varchar(255) DEFAULT NULL,
  `return_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `name`, `libraryId`, `title`, `accNo`, `date`, `borrowedDate`, `return_date`, `remarks`, `status`, `created_at`, `updated_at`) VALUES
(38, 'JAMES', '111', 'CRIMINAL JUSTICE TODAY: AN INTRODUCTORY TEXT FOR THE 21ST CENTURY', '123344', '2024-12-27 at 07:44 AM', '2024-12-27', '2024-12-26 23:52:26', 'Lost', 'Approved', '2024-12-26 23:52:26', '2024-12-26 23:52:26'),
(39, 'JAMES', '111', 'CRIMINAL JUSTICE TODAY: AN INTRODUCTORY TEXT FOR THE 21ST CENTURY', '2222', '2024-12-27 at 07:56 AM', '2024-12-27', '2024-12-26 23:56:58', 'Lost', 'Approved', '2024-12-26 23:56:58', '2024-12-26 23:56:58');

-- --------------------------------------------------------

--
-- Table structure for table `suggfeed`
--

CREATE TABLE `suggfeed` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `info` varchar(255) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `libraryId` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `accLevel` varchar(255) NOT NULL,
  `accStatus` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `libraryId`, `pass`, `accLevel`, `accStatus`, `created_at`, `updated_at`) VALUES
(2, 'librarian', '000001', '$2y$10$PYWO53BNaIFSrHqPYjBceuGKq4dup4hKF2LFhSQnHs8hKike8MtwO', 'librarian', '', NULL, NULL),
(6, 'developer', '999999', '$2y$10$be5GBVbW0FDQeClOdvpDe.s2tzl2i/zDCYf.gmpQNz5q3cJCsXzmK', 'developer', '', NULL, NULL),
(11, 'JAMES', '111', '$2y$10$5NOh1HmBaWfmSYtaoYehuOxoTUeyTTJ85xkz.4LUjbB9OVHdGxzuC', 'user', 'Active', '2024-11-05 03:53:19', '2024-12-25 17:57:15'),
(14, 'INSTRUCTOR', '555', '$2y$10$AawYLHgvRkmwGy7z6h9zhOY.r9.cCuGCib61rN0Hw1kEE2ojJmhvy', 'Instructor', 'Active', '2024-12-27 23:29:24', '2024-12-27 23:29:24'),
(16, 'STUDENT', '444', '$2y$10$wkQTXsTadeSzEWTP7Or8R.rryHqWgxKZhjjmAcaAz6oi6aSTP7okK', 'user', 'Active', '2024-12-27 23:30:30', '2024-12-27 23:30:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accNo` (`accNo`,`status`);

--
-- Indexes for table `borrowedbooks`
--
ALTER TABLE `borrowedbooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `libraryId` (`libraryId`,`accNo`,`status`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suggfeed`
--
ALTER TABLE `suggfeed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_libraryid_unique` (`libraryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `borrowedbooks`
--
ALTER TABLE `borrowedbooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `suggfeed`
--
ALTER TABLE `suggfeed`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
