-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 04:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(2, 'JAMES', '111', '2024-10-10', '2024-10-09 22:51:50', '2024-10-09 22:51:50'),
(3, 'CYNON', '222', '2024-10-10', '2024-10-09 22:53:56', '2024-10-09 22:53:56'),
(4, '333', '333', '2024-10-10', '2024-10-09 23:39:55', '2024-10-09 23:39:55'),
(5, 'JAMES', '111', '2024-10-14', '2024-10-13 17:38:51', '2024-10-13 17:38:51');

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
(8, 'BOOK 4', '333', 'Available', 'James', 'special character , . / ? \" ; -- + \' : ! @ # $ % ( )', '2024-10-10 04:52:57', '2024-10-10 04:52:57', ''),
(9, 'JUAN', '112', 'Available', 'james', 'qweqwe asd asd a', '2024-10-13 17:39:20', '2024-10-13 17:41:00', ''),
(10, 'TEST IMAGE', '12345', 'Available', 'James', 'Luna test image upload from add book module', '2024-10-13 18:41:44', '2024-10-13 18:41:44', '1728873704-12345-jpg'),
(11, 'TEST IMAGE', '12345123123', 'Available', 'James', 'qwek jqhwekj qw', '2024-10-13 18:50:42', '2024-10-13 18:50:42', '1728874242-12345123123-jpg');

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
(1, 'CYNON', '222', 'BOOK 3', '333', '2024-10-10', NULL, '2024-10-09 22:55:17', NULL, 'Rejected', '2024-10-09 22:55:17', '2024-10-09 22:55:17'),
(2, 'CYNON', '222', 'BOOK 4', '444', '2024-10-10', '2024-10-10', '2024-10-09 22:59:15', 'Lost', 'Approved', '2024-10-09 22:59:15', '2024-10-09 22:59:15'),
(3, 'JAMES', '111', 'BOOK 1', '111', '2024-10-10', '2024-10-10', '2024-10-09 23:00:20', 'Lost', 'Approved', '2024-10-09 23:00:20', '2024-10-09 23:00:20'),
(4, 'CYNON', '222', 'BOOK 2', '222', '2024-10-10', '2024-10-10', '2024-10-09 23:03:39', 'Lost', 'Approved', '2024-10-09 23:03:39', '2024-10-09 23:03:39'),
(5, 'CYNON', '222', 'BOOK 3', '333', '2024-10-10', '2024-10-10', '2024-10-09 23:10:15', 'Returned', 'Approved', '2024-10-09 23:10:15', '2024-10-09 23:10:15'),
(6, 'JAMES', '111', 'BOOK 3', '333', '2024-10-10', '2024-10-10', '2024-10-09 23:13:57', 'Lost', 'Approved', '2024-10-09 23:13:57', '2024-10-09 23:13:57'),
(7, 'JAMES', '111', 'BOOK 4', '111', '2024-10-10', '2024-10-10', '2024-10-09 23:25:24', 'Lost', 'Approved', '2024-10-09 23:25:24', '2024-10-09 23:25:24'),
(8, 'JAMES', '111', 'BOOK 4', '111', '2024-10-10', '2024-10-10', '2024-10-09 23:25:24', 'Lost', 'Phased Out', '2024-10-09 23:25:24', '2024-10-09 23:25:24'),
(9, 'JAMES', '111', 'BOOK 4', '222', '2024-10-10', '2024-10-10', '2024-10-09 23:26:17', 'Lost', 'Approved', '2024-10-09 23:26:17', '2024-10-09 23:26:17'),
(10, 'JAMES', '111', 'BOOK 4', '222', '2024-10-10', '2024-10-10', '2024-10-09 23:26:17', 'Lost', 'Phased Out', '2024-10-09 23:26:17', '2024-10-09 23:26:17'),
(11, 'CYNON', '222', 'BOOK 4', '222', '2024-10-10', NULL, '2024-10-09 23:26:17', NULL, 'Phased Out', '2024-10-09 23:26:17', '2024-10-09 23:26:17'),
(12, 'JAMES', '111', 'BOOK 4', '333', '2024-10-10', '2024-10-10', '2024-10-09 23:40:33', 'Lost', 'Approved', '2024-10-09 23:40:33', '2024-10-09 23:40:33'),
(13, 'JAMES', '111', 'BOOK 4', '333', '2024-10-10', '2024-10-10', '2024-10-09 23:40:33', 'Lost', 'Phased Out', '2024-10-09 23:40:33', '2024-10-09 23:40:33'),
(14, 'CYNON', '222', 'BOOK 4', '333', '2024-10-10', NULL, '2024-10-09 23:40:33', NULL, 'Phased Out', '2024-10-09 23:40:33', '2024-10-09 23:40:33'),
(15, '333', '333', 'BOOK 4', '333', '2024-10-10', NULL, '2024-10-09 23:40:33', NULL, 'Phased Out', '2024-10-09 23:40:33', '2024-10-09 23:40:33'),
(16, 'JAMES', '111', 'JUAN', '112', '2024-10-14', '2024-10-14', '2024-10-13 17:41:00', 'Returned', 'Approved', '2024-10-13 17:41:00', '2024-10-13 17:41:00');

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

--
-- Dumping data for table `suggfeed`
--

INSERT INTO `suggfeed` (`id`, `info`, `userId`, `date`, `created_at`, `updated_at`) VALUES
(1, 'test', '111', '2024-10-10', '2024-10-10 04:51:23', '2024-10-10 04:51:23'),
(2, '222', '222', '2024-10-10', '2024-10-10 04:53:35', '2024-10-10 04:53:35');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `libraryId`, `pass`, `accLevel`, `created_at`, `updated_at`) VALUES
(2, 'librarian', '000001', '$2y$10$PYWO53BNaIFSrHqPYjBceuGKq4dup4hKF2LFhSQnHs8hKike8MtwO', 'librarian', NULL, NULL),
(3, 'JAMES', '111', '$2y$10$51xBXAx3LUmoIs/VF5.7n.A0vCRLM1GDdKzVFYr5p9SFV9vUfr75G', 'user', '2024-10-09 22:49:16', '2024-10-09 22:49:16'),
(4, 'CYNON', '222', '$2y$10$Mg4/wn5K.DMz/CF4TSB1guYv/08jLpG4JvAU21Utzh789SmIGTcsa', 'user', '2024-10-09 22:49:23', '2024-10-09 22:49:23'),
(5, '333', '333', '$2y$10$yDUdtTW0QqvV3uvy9PmQZuJkIQXPJdN66vilh2Xu35bNN9UgTvf82', 'user', '2024-10-09 23:26:47', '2024-10-09 23:26:47'),
(6, 'developer', '999999', '$2y$10$be5GBVbW0FDQeClOdvpDe.s2tzl2i/zDCYf.gmpQNz5q3cJCsXzmK', 'developer', NULL, NULL);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowedbooks`
--
ALTER TABLE `borrowedbooks`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `borrowedbooks`
--
ALTER TABLE `borrowedbooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `suggfeed`
--
ALTER TABLE `suggfeed`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
