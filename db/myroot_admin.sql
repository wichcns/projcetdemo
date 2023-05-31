-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 11:46 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myroot_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `departmaents`
--

CREATE TABLE `departmaents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departmaents`
--

INSERT INTO `departmaents` (`id`, `user_id`, `department_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Programmer', '2023-05-30 00:44:55', '2023-05-30 00:44:55', NULL),
(2, 1, 'IT Support', '2023-05-30 00:47:28', '2023-05-30 00:47:28', NULL),
(3, 1, 'Admin Support', '2023-05-30 00:49:42', '2023-05-30 00:49:42', NULL),
(4, 1, 'Supper Admin', '2023-05-30 00:50:42', '2023-05-30 00:50:42', NULL),
(5, 1, 'Hr', NULL, NULL, NULL),
(6, 2, 'Marketing', NULL, NULL, NULL),
(7, 1, 'Graphic Design', '2023-05-30 03:29:21', '2023-05-30 03:29:21', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departmaents`
--
ALTER TABLE `departmaents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departmaents`
--
ALTER TABLE `departmaents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
