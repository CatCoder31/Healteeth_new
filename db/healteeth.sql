-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2023 at 07:49 PM
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
  `status` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `doctor_Id`, `patient_id`, `patient_name`, `email`, `phone`, `address`, `category`, `service`, `schedule`, `appointment_date`, `appointment_time`, `time_finish`, `status`) VALUES
(54, 17, 11, 'John Benedict Gabriel Areta', 'jbareta2@gmail.com', '09760590742', 'Unit 431 bldg 4 guadalupe bliss', 4, 11, 'Schedule 1', '0000-00-00', '08:00:00', '08:30:00', 'Cancel'),
(57, 17, 11, 'John Benedict Gabriel Areta', 'jbareta2@gmail.com', '09760590742', 'Unit 431 bldg 4 guadalupe bliss', 3, 8, 'Schedule 1', '0000-00-00', '08:00:00', '08:40:00', 'Approved'),
(58, 17, 11, 'John Benedict Gabriel Areta', 'jbareta2@gmail.com', '09760590742', 'Unit 431 bldg 4 guadalupe bliss', 2, 6, 'Schedule 1', '0000-00-00', '08:40:00', '09:40:00', 'Approved'),
(59, 17, 61, 'Sierra Snider', 'Jbareta2@gmail.com', '+1 (775) 902-1171', 'Nisi dolor eligendi', 2, 6, 'Schedule 1', '0000-00-00', '09:40:00', '10:40:00', 'Approved'),
(60, 17, 61, 'Sierra Snider', 'Jbareta2@gmail.com', '+1 (775) 902-1171', 'Nisi dolor eligendi', 2, 6, 'Schedule 1', '0000-00-00', '10:40:00', '11:40:00', 'Approved'),
(61, 17, 61, 'Sierra Snider', 'Jbareta2@gmail.com', '+1 (775) 902-1171', 'Nisi dolor eligendi', 1, 2, 'Schedule 1', '0000-00-00', '11:40:00', '12:10:00', 'Approved'),
(62, 17, 61, 'Sierra Snider', 'Jbareta2@gmail.com', '+1 (775) 902-1171', 'Nisi dolor eligendi', 2, 6, 'Schedule 1', '0000-00-00', '12:10:00', '13:10:00', 'Approved'),
(63, 17, 61, 'Sierra Snider', 'Jbareta2@gmail.com', '+1 (775) 902-1171', 'Nisi dolor eligendi', 3, 8, 'Schedule 1', '0000-00-00', '13:10:00', '13:50:00', 'Approved'),
(64, 17, 61, 'Sierra Snider', 'Jbareta2@gmail.com', 'Uma Byers', 'Wesley Winters', 3, 8, 'Schedule 1', '0000-00-00', '13:50:00', '14:30:00', 'Approved'),
(65, 17, 61, 'Sierra Snider', 'Jbareta2@gmail.com', '+1 (775) 902-1171', 'Nisi dolor eligendi', 2, 6, 'Schedule 1', '0000-00-00', '14:30:00', '15:30:00', 'Approved'),
(66, 17, 61, 'Benedict', 'Jbareta2@gmail.com', '+1 (775) 902-1171', 'Nisi dolor eligendi', 2, 6, '', '2023-08-01', '07:55:00', '08:55:00', 'Approved'),
(67, 17, 63, 'Merritt Farmer', 'Jbareta2@gmail.com', 'Beck Schwartz', 'Blythe Curtis', 4, 11, 'Schedule 1', '0000-00-00', '15:30:00', '16:00:00', 'Approved'),
(68, 17, 11, 'Mia Schneider', 'aretabenedict201@gmail.com', '09760590742', 'Unit 431 bldg 4 guadalupe bliss', 3, 8, 'Schedule 1', '0000-00-00', '16:00:00', '16:40:00', 'Approved'),
(69, 17, 11, 'Mia Schneider', 'aretabenedict201@gmail.com', '09760590742', 'Unit 431 bldg 4 guadalupe bliss', 3, 8, 'Schedule 1', '0000-00-00', '16:40:00', '17:20:00', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(55) NOT NULL,
  `descr` varchar(55) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sched_Id`, `doctor_Id`, `date_sched`, `time_sched_start`, `time_sched_end`, `breaktime_start`, `breaktime_end`) VALUES
(1, 17, '2023-08-01', '07:55:00', '11:29:00', '15:14:00', '16:33:00'),
(2, 17, '2023-11-15', '13:09:00', '15:52:00', '15:35:00', '17:03:00'),
(3, 17, '2023-12-13', '14:29:00', '19:45:00', '16:37:00', '17:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_price` varchar(100) NOT NULL,
  `service_duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `category_id`, `service_name`, `service_price`, `service_duration`) VALUES
(1, 1, 'Ordinary Cleaning', '800', '00:20:00'),
(2, 1, 'Stain Removal with Cleaning', '2000', '00:30:00'),
(3, 1, 'Deep Scaling with Gum Treatment', '2000', '02:00:00'),
(4, 1, 'Topical Fluoride', '400', '00:10:00'),
(5, 1, 'Fluoride Varnish', '1200', '00:20:00'),
(6, 2, 'Tooth Filling Per Surface', '600', '01:00:00'),
(7, 2, 'Class III or IV of Anterior Teeth', '1800', '02:00:00'),
(8, 3, 'Simple Tooth Extraction', '800', '00:40:00'),
(9, 3, 'Complicated Extraction', '1500', '01:00:00'),
(10, 3, 'Wisdom or Impacted Tooth Removal', '9000', '01:00:00'),
(11, 4, 'RCT Including 4 XRays', '7000', '00:30:00'),
(12, 4, 'Composite Build-up', '2500', '01:30:00'),
(13, 4, 'Fiber Post', '2500', '01:00:00'),
(14, 5, 'Periapical Xray', '400', '00:30:00');

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
  `language` varchar(70) NOT NULL,
  `emergency_contact_name` varchar(100) NOT NULL,
  `emergency_contact_number` varchar(100) NOT NULL,
  `profile_photo` varchar(555) DEFAULT NULL,
  `role` varchar(11) NOT NULL DEFAULT 'Patient',
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verification_token` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `token_created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email_address`, `password`, `contact_number`, `full_address`, `gender`, `language`, `emergency_contact_name`, `emergency_contact_number`, `profile_photo`, `role`, `email_verified`, `verification_token`, `username`, `token_created_at`) VALUES
(12, 'Valentine Pace', 'jaroqu@mailinator.com', '$2y$10$nEUZ83gMKs1upui0eS4EWOH0I43gu8iA/fuVvOQqF/uBkK77NoHSy', '', 'Culpa officiis veni', '', '', '', '', NULL, 'Patient', 0, '4bbd0840548f7c28826868b17f3346d7353386016748872dea0f173f793c154e', 'gisavi', '2023-07-06 18:36:18'),
(13, 'Naomi Guerra', 'ruqaxycupe@mailinator.com', '$2y$10$Hl3eucBCSMKKJcIiZr2nS.9aOX92HJQ1z5epu01iVCANJWipy67jC', '', 'Culpa officiis veni', '', '', '', '', NULL, 'Patient', 0, 'bdf49d0cfa6f3403b9a2bcd5388d815cbad0aa5c9fcb2c81b8139494dac1093b', 'bipuzo', '2023-07-06 18:37:43'),
(14, 'Xantha Lott', 'laikamaea@gmail.com', '$2y$10$Z.4lusSgvN5JKf7xrUztLeSqbzzj9MF4rJLGqmDuUCdZibtNQr5Cu', '+1 (619) 162-9842', 'Culpa officiis veni', '', '', '', '', NULL, 'Patient', 0, 'aae1340fe852b0e92cf4edec054e0f3e8005776c7b5a493d818505a7585f9cb1', 'hojekori', '2023-07-06 19:13:43'),
(15, 'Joelle Lawrence', 'ligac@mailinator.com', '$2y$10$Eh2AqlP9HLk.Z7WzYd4O0eGEmCTZrgGAlWjNyjcH5dToWjYW/MWbe', '+1 (619) 162-9842', 'Culpa officiis veni', '', '', '', '', NULL, 'Patient', 0, '6f36671f55c35760f8a5f29cb074db5db19c4663f5f9763352eb64c3f2e956a0', 'gisavi', '2023-07-06 19:29:41'),
(16, 'Patrick Edwards', 'lyjybobob@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '+1 (619) 162-9842', 'Culpa officiis veni', '', '', '', '', NULL, 'Patient', 0, NULL, '', '0000-00-00 00:00:00'),
(17, 'Kennan Moon', 'Jbareta2@gmail.com', '$2y$10$DElRXkIEI96ac304Pfa6oewEo6hoeRWn5l5D9nSo7MEdI69uTSV2.', '863', 'Consectetur veniam', 'male', 'English', 'Damon Burris', '33', 'assets/upload_images/64a6fe77b6c4b.png', 'Patient', 1, '1c895bc5cc5da38c2bacc5706eefb2f0088d6df1cba260b435de44dfef85844b', 'vaxyx', '2023-07-06 21:04:12'),
(18, 'Angela Franklineee', 'aretabenedict201@gmail.com', 'asdf', '970', 'Eum illum tenetur i', 'Female', 'Bicolano', 'Eaton Dennis', '679', 'assets/upload_images/64a6f7c3cc8ee.png', 'Patient', 1, '8d20a6729d6000fc355b1abd4133239e24df8a4a262eb9c2ca0aa0c4090c0186', 'woriribosa', '2023-07-06 23:57:59');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

