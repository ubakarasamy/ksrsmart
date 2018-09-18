-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2018 at 08:21 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_08_31_121106_create_student_table', 1),
(4, '2018_09_01_055550_create_student_subjects_table', 1),
(5, '2018_09_01_055630_create_student_schedules_table', 1),
(6, '2018_09_01_095258_create_academics_table', 1),
(7, '2018_09_05_122216_create_student_attendance_dates_table', 1),
(8, '2018_09_05_122233_create_student_attendance_hours_table', 1),
(9, '2018_09_05_122250_create_student_attendance_records_table', 1),
(10, '2018_09_05_134246_add_staff_id_to_schedules_table', 1),
(11, '2018_09_05_143328_add_student_id_to_records_table', 1),
(12, '2018_09_06_140126_add_schedule_id_to_student_records_table', 1),
(13, '2018_09_07_041207_create_roles_table', 1),
(14, '2018_09_07_041737_create_role_user_table', 1),
(17, '2018_09_08_071400_create_staff_attendance_dates_table', 2),
(18, '2018_09_08_071422_create_staff_attendance_records_table', 2),
(19, '2018_09_10_164113_create_staff_approvals_table', 3),
(20, '2018_09_16_180553_add_api_token', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin User', '2018-09-06 23:16:36', '2018-09-06 23:16:36'),
(2, 'admin', 'admin User', '2018-09-06 23:16:37', '2018-09-06 23:16:37'),
(3, 'subadmin', 'subadmin User', '2018-09-06 23:16:37', '2018-09-06 23:16:37'),
(4, 'user', 'User', '2018-09-06 23:16:37', '2018-09-06 23:16:37'),
(5, 'subuser', 'subuser User', '2018-09-06 23:16:37', '2018-09-06 23:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `staff_approvals`
--

CREATE TABLE `staff_approvals` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `approval_for` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` int(11) NOT NULL,
  `year_start` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_approvals`
--

INSERT INTO `staff_approvals` (`id`, `date`, `staff_id`, `approval_for`, `status`, `approved_by`, `year_start`, `created_at`, `updated_at`) VALUES
(7, '2018-09-20', 1, 'cpl', 'disapproved', 1, '2018-09-01', '2018-09-16 11:45:54', '2018-09-16 12:46:25'),
(8, '2018-09-21', 1, 'od', 'disapproved', 1, '2018-09-01', '2018-09-16 12:56:36', '2018-09-16 12:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendance_dates`
--

CREATE TABLE `staff_attendance_dates` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `at_staff` int(11) NOT NULL,
  `year_start` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_attendance_dates`
--

INSERT INTO `staff_attendance_dates` (`id`, `date`, `at_staff`, `year_start`, `created_at`, `updated_at`) VALUES
(1, '2018-09-01', 1, '2018-09-01', '2018-09-08 02:33:10', '2018-09-09 22:31:04'),
(2, '2018-09-02', 1, '2018-09-01', '2018-09-10 02:58:46', '2018-09-10 02:58:46'),
(3, '2018-09-11', 6, '2018-09-01', '2018-09-16 09:44:04', '2018-09-16 09:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendance_records`
--

CREATE TABLE `staff_attendance_records` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_present` int(11) NOT NULL,
  `year_start` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_attendance_records`
--

INSERT INTO `staff_attendance_records` (`id`, `date`, `staff_id`, `status`, `is_present`, `year_start`, `created_at`, `updated_at`) VALUES
(1, '2018-09-01', 1, 'cl', 1, '2018-09-01', '2018-09-08 02:38:07', '2018-09-10 01:34:06'),
(2, '2018-09-01', 2, 'absent', 1, '2018-09-01', '2018-09-09 22:20:56', '2018-09-10 01:37:53'),
(3, '2018-09-01', 3, 'present', 1, '2018-09-01', '2018-09-09 22:21:03', '2018-09-10 01:33:52'),
(4, '2018-09-01', 4, 'present', 1, '2018-09-01', '2018-09-10 00:57:34', '2018-09-10 01:33:52'),
(5, '2018-09-01', 5, 'present', 1, '2018-09-01', '2018-09-10 01:33:52', '2018-09-10 01:33:52'),
(6, '2018-09-01', 6, 'present', 1, '2018-09-01', '2018-09-10 01:33:52', '2018-09-10 01:33:52'),
(7, '2018-09-02', 1, 'present', 1, '2018-09-01', '2018-09-10 02:58:48', '2018-09-10 02:58:48'),
(8, '2018-09-02', 2, 'present', 1, '2018-09-01', '2018-09-10 02:58:48', '2018-09-10 02:58:48'),
(9, '2018-09-02', 3, 'present', 1, '2018-09-01', '2018-09-10 02:58:48', '2018-09-10 02:58:48'),
(10, '2018-09-02', 4, 'present', 1, '2018-09-01', '2018-09-10 02:58:49', '2018-09-10 02:58:49'),
(11, '2018-09-02', 5, 'present', 1, '2018-09-01', '2018-09-10 02:58:49', '2018-09-10 02:58:49'),
(12, '2018-09-02', 6, 'present', 1, '2018-09-01', '2018-09-10 02:58:49', '2018-09-10 02:58:49');

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
(1, 'Ubakara Samy', 'smuba4@gmail.com', 'vf123', 'BE', 'ECE', 1, 1, 'a', 'current', '2018-09-17 03:47:56', '2018-09-17 03:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance_dates`
--

CREATE TABLE `student_attendance_dates` (
  `id` int(10) UNSIGNED NOT NULL,
  `degree` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `total_hours` int(11) NOT NULL,
  `semester_start` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance_hours`
--

CREATE TABLE `student_attendance_hours` (
  `id` int(10) UNSIGNED NOT NULL,
  `degree` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `hour` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `is_sheduled_staff` tinyint(1) NOT NULL,
  `alternate_staff` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester_start` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance_records`
--

CREATE TABLE `student_attendance_records` (
  `id` int(10) UNSIGNED NOT NULL,
  `degree` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `hour` int(11) NOT NULL,
  `is_present` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL,
  `semester_start` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'be', 'ece', 1, 1, 'a', 'ec0123', 'Engineering Physics', '1', '2018-09-01', '2018-09-10 08:25:03', '2018-09-10 08:25:03');

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
  `api_token` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `eid`, `email`, `working_department`, `dashboard_role`, `occupation`, `status`, `password`, `api_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin Name', 'Eid1', 'sadmin@app.com', 'ece', 'superadmin', 'Occupation', 'current', '$2y$10$7LthSiA/AkKCrBz2LyKnc.eKt/fDOlYjsF.2qVpxk6rNZuf0xtk9y', 'tewxaHYupNyHjZtyrJGHWh6ptBtR1wpGcNRFfJ4KcsUK80oF23zOHkEzeBsH', 'sybBEJ9g0eMKeIDjwbvTigzf5t8tNMgxSRxNHeBknY1QEe4DB8DNj2eXGOsY', '2018-09-06 23:16:37', '2018-09-16 12:42:14'),
(2, 'admin Name', 'Eid2', 'admin@app.com', 'eee', 'admin', 'Occupation', 'current', '$2y$10$1kfuAwwMXNbk7HR9as3KAuNmg9nXhC4dzrFYid89bSnBnaeczBPNi', NULL, NULL, '2018-09-06 23:16:37', '2018-09-06 23:16:37'),
(3, 'subadmin Name', 'Eid3', 'subadmin@app.com', 'cse', 'subadmin', 'Occupation', 'current', '$2y$10$rSgWQbfUiUOOhGSrpnFrQ.TpfwUpxsoOTTGQTrAZk/uHJjLB36H2C', NULL, NULL, '2018-09-06 23:16:37', '2018-09-06 23:16:37'),
(4, 'user Name', 'Eid4', 'user@app.com', 'mech', 'user', 'Occupation', 'current', '$2y$10$1rxJRjObQRoU3IS3VxN7cOnLc/5iqZJNoXbRBpsNUJhAjUmntehzm', NULL, NULL, '2018-09-06 23:16:38', '2018-09-06 23:16:38'),
(5, 'subuser Name', 'Eid5', 'subuser@app.com', 'it', 'subuser', 'Occupation', 'current', '$2y$10$3vo9wVbu32y8mYojmWAxZO51e1wYvkoSuCth8i8d0GnLUp71lP6kS', NULL, NULL, '2018-09-06 23:16:38', '2018-09-06 23:16:38'),
(6, 'Ubakara Samy', 'KSRCE01', 'smuba4@gmail.com', 'ece', 'superadmin', 'hod', 'current', '$2y$10$48nLAwx0vVnvy76gQnnHv.YAV7mYU2szM3sgO7y5smflQih9TIyrq', NULL, NULL, '2018-09-07 21:01:39', '2018-09-07 21:01:39');

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_approvals`
--
ALTER TABLE `staff_approvals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_attendance_dates`
--
ALTER TABLE `staff_attendance_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_attendance_records`
--
ALTER TABLE `staff_attendance_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_email_unique` (`email`),
  ADD UNIQUE KEY `student_reg_no_unique` (`reg_no`);

--
-- Indexes for table `student_attendance_dates`
--
ALTER TABLE `student_attendance_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendance_hours`
--
ALTER TABLE `student_attendance_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendance_records`
--
ALTER TABLE `student_attendance_records`
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
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff_approvals`
--
ALTER TABLE `staff_approvals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff_attendance_dates`
--
ALTER TABLE `staff_attendance_dates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff_attendance_records`
--
ALTER TABLE `staff_attendance_records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_attendance_dates`
--
ALTER TABLE `student_attendance_dates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_attendance_hours`
--
ALTER TABLE `student_attendance_hours`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_attendance_records`
--
ALTER TABLE `student_attendance_records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_schedules`
--
ALTER TABLE `student_schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_subjects`
--
ALTER TABLE `student_subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_schedules`
--
ALTER TABLE `student_schedules`
  ADD CONSTRAINT `student_schedules_student_subject_id_foreign` FOREIGN KEY (`student_subject_id`) REFERENCES `student_subjects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
