-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 30, 2022 at 08:23 AM
-- Server version: 5.7.33
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `student_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`student_id`, `student_name`, `gender`, `ic`, `created_at`, `updated_at`) VALUES
('S00001', 'John Dae', 'Male', '810106-01-5119', '2022-03-29 20:15:54', '2022-03-29 23:22:07'),
('S00002', 'Mike Ross', 'Male', '910106-01-3111', '2022-03-29 21:24:13', '2022-03-29 23:22:16'),
('S00003', 'Rachel Zane', 'Female', '810106-01-5118', '2022-03-29 23:07:15', '2022-03-29 23:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `student_result`
--

CREATE TABLE `student_result` (
  `result_id` bigint(20) UNSIGNED NOT NULL,
  `course` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mark` float NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_result`
--

INSERT INTO `student_result` (`result_id`, `course`, `mark`, `student_id`, `created_at`, `updated_at`) VALUES
(5, 'CSC645', 87, 'S00001', '2022-03-29 23:05:32', '2022-03-29 23:24:05'),
(10, 'CSC645', 89, 'S00003', '2022-03-29 23:19:25', '2022-03-29 23:19:25'),
(11, 'CSC566', 41, 'S00003', '2022-03-29 23:19:38', '2022-03-29 23:19:38'),
(12, 'CSC645', 100, 'S00002', '2022-03-29 23:19:48', '2022-03-29 23:23:08'),
(13, 'CSC566', 89, 'S00002', '2022-03-29 23:19:55', '2022-03-29 23:19:55'),
(14, 'CSC566', 67, 'S00001', '2022-03-29 23:22:38', '2022-03-29 23:22:38'),
(15, 'CSC662', 34, 'S00002', '2022-03-29 23:22:52', '2022-03-29 23:22:52'),
(16, 'CSC662', 81, 'S00003', '2022-03-29 23:23:24', '2022-03-29 23:23:30'),
(17, 'CSC662', 77, 'S00001', '2022-03-29 23:23:53', '2022-03-29 23:23:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_result`
--
ALTER TABLE `student_result`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `student_result_student_id_foreign` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_result`
--
ALTER TABLE `student_result`
  MODIFY `result_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_result`
--
ALTER TABLE `student_result`
  ADD CONSTRAINT `student_result_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
