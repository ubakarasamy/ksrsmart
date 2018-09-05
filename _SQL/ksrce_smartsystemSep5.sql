-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2018 at 05:40 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.0.31-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ksrce_smartsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `academics`
--

CREATE TABLE `academics` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_start` date NOT NULL,
  `year_end` date DEFAULT NULL,
  `semester_start` date NOT NULL,
  `semester_end` date DEFAULT NULL,
  `staff_cl` int(11) NOT NULL,
  `staff_od` int(11) NOT NULL,
  `staff_permission` int(11) NOT NULL,
  `staff_lateregister` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academics`
--

INSERT INTO `academics` (`id`, `year_start`, `year_end`, `semester_start`, `semester_end`, `staff_cl`, `staff_od`, `staff_permission`, `staff_lateregister`, `created_at`, `updated_at`) VALUES
(1, '2018-09-01', NULL, '2018-09-01', NULL, 10, 10, 2, 2, NULL, NULL);

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
(3, '2018_08_31_121106_create_student_table', 2),
(11, '2018_09_01_055550_create_student_subjects_table', 3),
(12, '2018_09_01_055630_create_student_schedules_table', 3),
(15, '2018_09_01_095258_create_academics_table', 4),
(16, '2018_09_03_083418_create_student_attendances_table', 5),
(17, '2018_09_03_115230_create_student_attendance_records_table', 6),
(18, '2018_09_05_075038_create_student_attendance_dates_table', 7),
(20, '2018_09_05_101333_create_student_date_attendances_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('smuba4@gmail.com', '$2y$10$u78sKEABGgSlTTYRyiRU4.FoMe.V4yNwZiE7n.viDU41S4u3r8oSK', '2018-08-31 04:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `email`, `reg_no`, `degree`, `department`, `year`, `semester`, `section`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uba', 'smuba4@gmail.com', 'fdsgfcdchthhy', 'be', 'ece', 1, 1, 'a', 'current', '2018-08-31 11:14:38', '2018-08-31 13:10:38'),
(2, 'uba', 'uba2682@gmail.com', 'vf123', 'be', 'ece', 1, 1, 'a', 'current', '2018-08-31 11:15:11', '2018-08-31 11:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendances`
--

CREATE TABLE `student_attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `edit_permission` tinyint(1) NOT NULL,
  `alternate_staff` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_attendances`
--

INSERT INTO `student_attendances` (`id`, `schedule_id`, `date`, `edit_permission`, `alternate_staff`, `created_at`, `updated_at`) VALUES
(24, 22, '2018-09-01', 1, 'null', '2018-09-05 05:12:21', '2018-09-05 05:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance_dates`
--

CREATE TABLE `student_attendance_dates` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `total_hours` int(11) NOT NULL,
  `semester_start` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_attendance_dates`
--

INSERT INTO `student_attendance_dates` (`id`, `date`, `total_hours`, `semester_start`, `created_at`, `updated_at`) VALUES
(3, '2018-09-01', 0, '2018-09-01', '2018-09-05 05:12:21', '2018-09-05 05:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance_records`
--

CREATE TABLE `student_attendance_records` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `student_attendance_id` int(10) UNSIGNED NOT NULL,
  `present` tinyint(1) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_attendance_records`
--

INSERT INTO `student_attendance_records` (`id`, `student_id`, `schedule_id`, `date`, `student_attendance_id`, `present`, `status`, `created_at`, `updated_at`) VALUES
(26, 1, 22, '2018-09-01', 24, 1, 'present', '2018-09-05 05:16:52', '2018-09-05 05:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `student_date_attendances`
--

CREATE TABLE `student_date_attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `student_id` int(11) NOT NULL,
  `total_hours` int(11) NOT NULL DEFAULT '0',
  `semester_start` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_date_attendances`
--

INSERT INTO `student_date_attendances` (`id`, `date`, `student_id`, `total_hours`, `semester_start`, `created_at`, `updated_at`) VALUES
(2, '2018-09-01', 1, 1, '2018-09-01', '2018-09-05 05:16:52', '2018-09-05 05:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `student_schedules`
--

CREATE TABLE `student_schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `degree` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hour` int(11) NOT NULL,
  `student_subject_id` int(10) UNSIGNED NOT NULL,
  `semester_start` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_schedules`
--

INSERT INTO `student_schedules` (`id`, `degree`, `department`, `year`, `semester`, `section`, `day`, `hour`, `student_subject_id`, `semester_start`, `created_at`, `updated_at`) VALUES
(22, 'be', 'ece', 1, 1, 'a', 'mon', 1, 8, '2018-09-01', '2018-09-04 01:09:02', '2018-09-04 01:09:02'),
(23, 'be', 'ece', 1, 1, 'a', 'mon', 2, 14, '2018-09-01', '2018-09-04 01:09:28', '2018-09-04 01:09:28'),
(24, 'be', 'ece', 1, 1, 'a', 'mon', 3, 14, '2018-09-01', '2018-09-04 01:09:34', '2018-09-04 01:09:34'),
(25, 'be', 'ece', 1, 1, 'a', 'mon', 4, 14, '2018-09-01', '2018-09-04 01:09:37', '2018-09-04 01:09:37'),
(26, 'be', 'ece', 1, 1, 'a', 'mon', 5, 11, '2018-09-01', '2018-09-04 01:09:52', '2018-09-04 01:09:52'),
(27, 'be', 'ece', 1, 1, 'a', 'mon', 6, 10, '2018-09-01', '2018-09-04 01:10:06', '2018-09-04 01:10:06'),
(28, 'be', 'ece', 1, 1, 'a', 'mon', 7, 9, '2018-09-01', '2018-09-04 01:10:14', '2018-09-04 01:10:14'),
(29, 'be', 'ece', 1, 1, 'a', 'tue', 1, 9, '2018-09-01', '2018-09-04 01:10:25', '2018-09-04 01:10:25'),
(30, 'be', 'ece', 1, 1, 'a', 'tue', 2, 11, '2018-09-01', '2018-09-04 01:10:31', '2018-09-04 01:32:30'),
(38, 'be', 'ece', 1, 1, 'a', 'tue', 3, 10, '2018-09-01', '2018-09-04 01:29:50', '2018-09-04 01:32:34'),
(39, 'be', 'ece', 1, 1, 'a', 'tue', 4, 12, '2018-09-01', '2018-09-04 01:30:11', '2018-09-04 01:32:38'),
(40, 'be', 'ece', 1, 1, 'a', 'tue', 5, 15, '2018-09-01', '2018-09-04 01:30:17', '2018-09-04 01:30:17'),
(41, 'be', 'ece', 1, 1, 'a', 'tue', 6, 15, '2018-09-01', '2018-09-04 01:30:19', '2018-09-04 01:30:19'),
(42, 'be', 'ece', 1, 1, 'a', 'tue', 7, 15, '2018-09-01', '2018-09-04 01:30:23', '2018-09-04 01:30:23'),
(43, 'be', 'ece', 1, 1, 'a', 'thu', 7, 14, '2018-09-01', '2018-09-04 01:30:45', '2018-09-04 01:30:45'),
(44, 'be', 'ece', 1, 1, 'a', 'thu', 6, 14, '2018-09-01', '2018-09-04 01:30:48', '2018-09-04 01:30:48'),
(45, 'be', 'ece', 1, 1, 'a', 'thu', 5, 14, '2018-09-01', '2018-09-04 01:30:50', '2018-09-04 01:30:50'),
(46, 'be', 'ece', 1, 1, 'a', 'fri', 2, 13, '2018-09-01', '2018-09-04 01:31:00', '2018-09-04 01:31:28'),
(47, 'be', 'ece', 1, 1, 'a', 'fri', 3, 13, '2018-09-01', '2018-09-04 01:31:03', '2018-09-04 01:31:26'),
(48, 'be', 'ece', 1, 1, 'a', 'fri', 4, 13, '2018-09-01', '2018-09-04 01:31:06', '2018-09-04 01:31:23'),
(49, 'be', 'ece', 1, 1, 'a', 'fri', 1, 8, '2018-09-01', '2018-09-04 01:31:36', '2018-09-04 01:31:36'),
(50, 'be', 'ece', 1, 1, 'a', 'fri', 7, 8, '2018-09-01', '2018-09-04 01:31:42', '2018-09-04 01:31:42'),
(51, 'be', 'ece', 1, 1, 'a', 'fri', 6, 10, '2018-09-01', '2018-09-04 01:31:46', '2018-09-04 01:31:46'),
(52, 'be', 'ece', 1, 1, 'a', 'fri', 5, 11, '2018-09-01', '2018-09-04 01:31:50', '2018-09-04 01:31:50'),
(53, 'be', 'ece', 1, 1, 'a', 'thu', 4, 10, '2018-09-01', '2018-09-04 01:32:00', '2018-09-04 01:32:00'),
(54, 'be', 'ece', 1, 1, 'a', 'thu', 3, 11, '2018-09-01', '2018-09-04 01:32:04', '2018-09-04 01:32:04'),
(55, 'be', 'ece', 1, 1, 'a', 'thu', 2, 8, '2018-09-01', '2018-09-04 01:32:08', '2018-09-04 01:32:08'),
(56, 'be', 'ece', 1, 1, 'a', 'thu', 1, 12, '2018-09-01', '2018-09-04 01:32:13', '2018-09-04 01:32:13'),
(57, 'be', 'ece', 1, 1, 'a', 'wed', 1, 12, '2018-09-01', '2018-09-04 01:32:59', '2018-09-04 01:32:59'),
(58, 'be', 'ece', 1, 1, 'a', 'wed', 2, 11, '2018-09-01', '2018-09-04 01:33:03', '2018-09-04 01:33:03'),
(59, 'be', 'ece', 1, 1, 'a', 'wed', 3, 8, '2018-09-01', '2018-09-04 01:33:11', '2018-09-04 01:33:11'),
(60, 'be', 'ece', 1, 1, 'a', 'wed', 4, 9, '2018-09-01', '2018-09-04 01:33:24', '2018-09-04 01:33:24'),
(61, 'be', 'ece', 1, 1, 'a', 'wed', 7, 9, '2018-09-01', '2018-09-04 01:33:28', '2018-09-04 01:33:28'),
(62, 'be', 'ece', 1, 1, 'a', 'wed', 6, 12, '2018-09-01', '2018-09-04 01:33:38', '2018-09-04 01:33:38'),
(63, 'be', 'ece', 1, 1, 'a', 'wed', 5, 8, '2018-09-01', '2018-09-04 01:33:53', '2018-09-04 01:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `student_subjects`
--

CREATE TABLE `student_subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `degree` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester_start` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_subjects`
--

INSERT INTO `student_subjects` (`id`, `degree`, `department`, `year`, `semester`, `section`, `subject_id`, `subject_name`, `user_id`, `semester_start`, `created_at`, `updated_at`) VALUES
(8, 'be', 'ece', 1, 1, 'a', 'HS8151', 'Communicative English', '1', '2018-09-01', '2018-09-04 00:42:08', '2018-09-04 00:42:08'),
(9, 'be', 'ece', 1, 1, 'a', 'MA8151', 'Engineering Mathematics - I', '1', '2018-09-01', '2018-09-04 00:55:17', '2018-09-04 00:55:17'),
(10, 'be', 'ece', 1, 1, 'a', 'PH8151', 'Engineering Physics', '1', '2018-09-01', '2018-09-04 01:00:31', '2018-09-04 01:00:31'),
(11, 'be', 'ece', 1, 1, 'a', 'CY8151', 'Engineering Chemistry', '1', '2018-09-01', '2018-09-04 01:03:30', '2018-09-04 01:03:30'),
(12, 'be', 'ece', 1, 1, 'a', 'GE8151', 'P S P P', '1', '2018-09-01', '2018-09-04 01:06:10', '2018-09-04 01:06:10'),
(13, 'be', 'ece', 1, 1, 'a', 'GE8152', 'Engineering Graphics', '1', '2018-09-01', '2018-09-04 01:06:59', '2018-09-04 01:06:59'),
(14, 'be', 'ece', 1, 1, 'a', 'GE8161', 'P S P P Lab', '1', '2018-09-01', '2018-09-04 01:07:35', '2018-09-04 01:07:35'),
(15, 'be', 'ece', 1, 1, 'a', 'BS8161', 'P & C Lab', '1', '2018-09-01', '2018-09-04 01:08:21', '2018-09-04 01:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dashboard_role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `eid`, `email`, `working_department`, `dashboard_role`, `occupation`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ubakarasamy', 'KSRCE123', 'smub4@gmail.com', 'ece', 'hod', 'hod', 'current', '$2y$10$niOUx/U1CLn1TkJXEGfCTeIe3foBn/jqn7yy7EuntpiCsO3m0yhSO', 'TZm8IoYOVPAfueMLrdwpxWavGnr3RIYoMuhpkdG7Ld3K0Lyv0TU2ixhG21sB', '2018-08-31 04:07:37', '2018-08-31 04:09:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academics`
--
ALTER TABLE `academics`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_email_unique` (`email`),
  ADD UNIQUE KEY `student_reg_no_unique` (`reg_no`);

--
-- Indexes for table `student_attendances`
--
ALTER TABLE `student_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendance_dates`
--
ALTER TABLE `student_attendance_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendance_records`
--
ALTER TABLE `student_attendance_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_attendance_records_student_attendance_id_foreign` (`student_attendance_id`);

--
-- Indexes for table `student_date_attendances`
--
ALTER TABLE `student_date_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_schedules`
--
ALTER TABLE `student_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_schedules_student_subject_id_foreign` (`student_subject_id`);

--
-- Indexes for table `student_subjects`
--
ALTER TABLE `student_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_eid_unique` (`eid`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academics`
--
ALTER TABLE `academics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student_attendances`
--
ALTER TABLE `student_attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `student_attendance_dates`
--
ALTER TABLE `student_attendance_dates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `student_attendance_records`
--
ALTER TABLE `student_attendance_records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `student_date_attendances`
--
ALTER TABLE `student_date_attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student_schedules`
--
ALTER TABLE `student_schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `student_subjects`
--
ALTER TABLE `student_subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_attendance_records`
--
ALTER TABLE `student_attendance_records`
  ADD CONSTRAINT `student_attendance_records_student_attendance_id_foreign` FOREIGN KEY (`student_attendance_id`) REFERENCES `student_attendances` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_schedules`
--
ALTER TABLE `student_schedules`
  ADD CONSTRAINT `student_schedules_student_subject_id_foreign` FOREIGN KEY (`student_subject_id`) REFERENCES `student_subjects` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
