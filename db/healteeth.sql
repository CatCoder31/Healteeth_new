-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 04:14 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healteeth`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `doctor_Id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `time_finish` time NOT NULL,
  `cancel_reason` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(55) NOT NULL,
  `descr` varchar(55) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `descr`, `image`) VALUES
(1, 'Oral Prophylaxis', 'Professional dental cleaning to maintain oral health ', '1549066042168812406217511687190774cleaning.png'),
(2, 'Tooth Filling', 'Repairing tooth decay or damage with material.', '16938797091688124124150211687190781filling.png'),
(3, 'Tooth Extraction', 'Removing a tooth for dental treatment purposes.', '8237505131688124150147071687190788extraction.png'),
(4, 'Root Canal', 'Dental procedure to save an infected tooth.', '6764905541688124186216731687190793rootcanal.png'),
(5, 'Periapical Xray', 'Tooth root and surrounding structure X-ray.', '2120664087168812421921611687190320xray.png');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sched_Id` int(11) NOT NULL,
  `doctor_Id` int(11) NOT NULL,
  `date_sched` varchar(100) NOT NULL,
  `time_sched_start` time NOT NULL,
  `time_sched_end` time NOT NULL,
  `breaktime_start` time NOT NULL,
  `breaktime_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `category_id`, `service_name`, `service_duration`) VALUES
(1, 1, 'Ordinary Cleaning', '00:20:00'),
(2, 1, 'Stain Removal with Cleaning', '00:30:00'),
(3, 1, 'Deep Scaling with Gum Treatment', '02:00:00'),
(4, 1, 'Topical Fluoride', '00:10:00'),
(5, 1, 'Fluoride Varnish', '00:20:00'),
(6, 2, 'Tooth Filling Per Surface', '01:00:00'),
(7, 2, 'Class III or IV of Anterior Teeth', '02:00:00'),
(8, 3, 'Simple Tooth Extraction', '00:40:00'),
(9, 3, 'Complicated Extraction', '01:00:00'),
(10, 3, 'Wisdom or Impacted Tooth Removal', '01:00:00'),
(11, 4, 'RCT Including 4 XRays', '00:30:00'),
(12, 4, 'Composite Build-up', '01:30:00'),
(13, 4, 'Fiber Post', '01:00:00'),
(14, 5, 'Periapical Xray', '00:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `full_address` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `emergency_contact_name` varchar(100) NOT NULL,
  `emergency_contact_number` varchar(100) NOT NULL,
  `profile_photo` varchar(555) DEFAULT NULL,
  `medical_record` text DEFAULT NULL,
  `role` varchar(11) NOT NULL DEFAULT 'Patient',
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verification_token` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `token_created_at` datetime NOT NULL,
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email_address`, `password`, `contact_number`, `full_address`, `gender`, `birthdate`, `emergency_contact_name`, `emergency_contact_number`, `profile_photo`, `medical_record`, `role`, `email_verified`, `verification_token`, `username`, `token_created_at`, `token`) VALUES
(1, 'Syfer Smith', 'ssmith@gmail.com', '$2y$10$7vdzFxndw6eqR/VALb5sAez/4UVFPWcPQB/E8xtaRyV1BGUsF3dTa', '09173910481', 'Isle City', '', '', '', '', NULL, NULL, 'Doctor', 1, NULL, '', '0000-00-00 00:00:00', NULL),
(2, 'Lucinda Jones', 'ljones@gmail.com', '$2y$10$7vdzFxndw6eqR/VALb5sAez/4UVFPWcPQB/E8xtaRyV1BGUsF3dTa', '09173841058', 'Isle City', '', '', '', '', NULL, NULL, 'Doctor', 1, NULL, '', '0000-00-00 00:00:00', NULL),
(3, 'Maggie Davis', 'mdavis@gmail.com', '$2y$10$7vdzFxndw6eqR/VALb5sAez/4UVFPWcPQB/E8xtaRyV1BGUsF3dTa', '09182840104', 'Isle City', '', '', '', '', NULL, NULL, 'Doctor', 1, NULL, '', '0000-00-00 00:00:00', NULL),
(4, 'Dominic Miller', 'dmiller@gmail.com', '$2y$10$7vdzFxndw6eqR/VALb5sAez/4UVFPWcPQB/E8xtaRyV1BGUsF3dTa', '09174810492', 'Isle City', '', '', '', '', NULL, NULL, 'Doctor', 1, NULL, '', '0000-00-00 00:00:00', NULL),
(5, 'Lloyd Tabunggao', 'lloydtab@gmail.com', '$2y$10$7vdzFxndw6eqR/VALb5sAez/4UVFPWcPQB/E8xtaRyV1BGUsF3dTa', '0917284011', 'Cembo Makati', 'Male', '1999-11-01', 'Francis Tadena', '09182038501', 'assets/upload_images/64a7ef9b6cd32.png', NULL, 'Patient', 1, 'a911f119bb7d39e69e621ada06f17da11f97d12c01758e0bafb38728af7e0dd0', 'lloydzkie', '2023-07-07 09:55:39', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_pat_date_time` (`appointment_date`,`appointment_time`,`time_finish`) USING BTREE;

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sched_Id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
