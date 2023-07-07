-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 03:46 PM
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
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `time_finish` time NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Pending'
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
(1, 'Oral Prophylaxis', 'Cleaning', '17511687190774cleaning.png'),
(2, 'Tooth Filling', 'Pasta', '150211687190781filling.png'),
(3, 'Tooth Extraction', 'Bunot', '147071687190788extraction.png'),
(4, 'Root Canal', 'Root Canal Treatment', '216731687190793rootcanal.png'),
(5, 'Periapical Xray', 'Xray for the Root Canal', '21611687190320xray.png');

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
  `service_price` varchar(100) NOT NULL,
  `service_duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

INSERT INTO `user` (`id`, `full_name`, `email_address`, `password`, `contact_number`, `full_address`, `gender`, `language`, `emergency_contact_name`, `emergency_contact_number`, `profile_photo`, `medical_record`, `role`, `email_verified`, `verification_token`, `username`, `token_created_at`, `token`) VALUES
(1, 'Valentine Pace', 'jaroqu@mailinator.com', '$2y$10$nEUZ83gMKs1upui0eS4EWOH0I43gu8iA/fuVvOQqF/uBkK77NoHSy', '', 'Culpa officiis veni', '', '', '', '', NULL, NULL, 'Patient', 0, '4bbd0840548f7c28826868b17f3346d7353386016748872dea0f173f793c154e', 'gisavi', '2023-07-06 18:36:18', NULL),
(2, 'Naomi Guerra', 'ruqaxycupe@mailinator.com', '$2y$10$Hl3eucBCSMKKJcIiZr2nS.9aOX92HJQ1z5epu01iVCANJWipy67jC', '', 'Culpa officiis veni', '', '', '', '', NULL, NULL, 'Patient', 0, 'bdf49d0cfa6f3403b9a2bcd5388d815cbad0aa5c9fcb2c81b8139494dac1093b', 'bipuzo', '2023-07-06 18:37:43', NULL),
(3, 'Xantha Lott', 'laikamaea@gmail.com', '$2y$10$Z.4lusSgvN5JKf7xrUztLeSqbzzj9MF4rJLGqmDuUCdZibtNQr5Cu', '+1 (619) 162-9842', 'Culpa officiis veni', '', '', '', '', NULL, NULL, 'Patient', 0, 'aae1340fe852b0e92cf4edec054e0f3e8005776c7b5a493d818505a7585f9cb1', 'hojekori', '2023-07-06 19:13:43', NULL),
(4, 'Joelle Lawrence', 'ligac@mailinator.com', '$2y$10$Eh2AqlP9HLk.Z7WzYd4O0eGEmCTZrgGAlWjNyjcH5dToWjYW/MWbe', '+1 (619) 162-9842', 'Culpa officiis veni', '', '', '', '', NULL, NULL, 'Patient', 0, '6f36671f55c35760f8a5f29cb074db5db19c4663f5f9763352eb64c3f2e956a0', 'gisavi', '2023-07-06 19:29:41', NULL),
(5, 'Patrick Edwards', 'lyjybobob@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '+1 (619) 162-9842', 'Culpa officiis veni', '', '', '', '', NULL, NULL, 'Patient', 0, NULL, '', '0000-00-00 00:00:00', NULL),
(6, 'John Benedict Areta', 'Jbareta2@gmail.com', '$2y$10$vwpNpfPCeF3QiHVVVBJDouzSrkNzFpR97aSFopZKlqcTwYpm52Wu.', '09760590742', 'Unit 431 bldg 4 guadalupe bliss', 'Male', 'English', 'Laika Mae Amano', '09760590742', 'assets/upload_images/64a74e1e662ed.jpg', NULL, 'Patient', 1, '1c895bc5cc5da38c2bacc5706eefb2f0088d6df1cba260b435de44dfef85844b', 'Benedict', '2023-07-06 21:04:12', 'c772eb427d44dc040b9b468fa3f9e154afc5050f65fcde0a9f75d704ce3c5bfb'),
(7, 'John Benedict Gabriel Areta', 'aretabenedict01@gmail.com', '$2y$10$77XUW52SRDqagKI95nBQDewHpPUhhG.Op5ryoHRZOe5Zp8.SAi66m', '09760590742', 'Unit 431 bldg 4 guadalupe bliss', 'Male', 'Filipino', 'Eaton Dennis', 'username', 'assets/upload_images/64a7922f4f50a.png', NULL, 'Patient', 1, '8d20a6729d6000fc355b1abd4133239e24df8a4a262eb9c2ca0aa0c4090c0186', 'benedict', '2023-07-06 23:57:59', '867412d481c94a18b2addcc648f244a172ea09eb5cf61102e0d823a44d86aa50'),
(8, 'Josephine Garcia', 'keravyfub@mailinator.com', '$2y$10$MP1LZ/P.Xq7u8u6MmYQAleqe.TY8sHvUaI.0o2VpvfsIV.iptEdi.', '', '', '', '', '', '', NULL, NULL, 'Patient', 0, 'bef54e40d83a36954d5ecce1811a42ebe50af20b4aded77673558f84f51eceeb', 'zukajypeha', '2023-07-07 09:47:06', NULL),
(9, 'Lloyd Tabunggao', 'lloydtab@gmail.com', '$2y$10$7vdzFxndw6eqR/VALb5sAez/4UVFPWcPQB/E8xtaRyV1BGUsF3dTa', '0917284013', 'Forbes Park Makati', 'Male', 'Bicolano', 'Dawn Bentley', '09182038501', 'assets/upload_images/64a7ef9b6cd32.png', NULL, 'Patient', 1, 'a911f119bb7d39e69e621ada06f17da11f97d12c01758e0bafb38728af7e0dd0', 'lloydzkie', '2023-07-07 09:55:39', NULL),
(10, 'Gene Lloyd Tabunggao', 'genelloyd@gmail.com', '$2y$10$7vdzFxndw6eqR/VALb5sAez/4UVFPWcPQB/E8xtaRyV1BGUsF3dTa', '431', 'Repellendus Corpori', 'Male', 'Bicolano', 'Jolie Jones', '864', 'assets/upload_images/64a7af70c9e7e.jpg', NULL, 'Doctor', 1, '4ed9d6561cb2f6f67ce4b3d4ae940060c1c71126cabedaa6730b099da892ebfd', 'nopyv', '2023-07-07 14:17:47', NULL),
(11, 'GL Tabunggao', 'gtabunggao.a61816078@umak.edu.ph', '$2y$10$r1G0yPkaFvxrsFasURyiFet.yXsn3t7ABUaBmvsHtvNdJGj3gcdia', '09189768084', 'Cembo Makati', 'Male', 'Ilocano', 'Lloyd', '091284912041', NULL, NULL, 'Patient', 1, 'faabaeaa4ff3f6d03a0c0957eff56268ea7ece6b8916e0cd6dfd104d3161e03d', 'genezkie', '2023-07-07 21:26:30', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
