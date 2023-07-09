-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2023 at 12:53 PM
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
  `role` varchar(11) NOT NULL DEFAULT 'Patient',
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email_address`, `password`, `contact_number`, `full_address`, `role`, `token`) VALUES
(1, 'Gene Lloyd Tabunggao', 'genelloyd@gmail.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '925119375', 'Cembo Makati City', 'Doctor', NULL),
(2, 'Staff', 'staff@healteeth.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '2147483647', 'taguig', 'Staff', NULL),
(3, 'Labio Tabunggao', 'gltab@gmail.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '2147483647', 'makati', 'Patient', NULL),
(4, 'Lloyd Tabunggao', 'lloydtab@gmail.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '09212575670', 'Cembo Makati', 'Patient', NULL),
(5, 'Joshua Lumelay', 'joshualumelay@gmail.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '2147483647', 'emq ep apartment south side makati city', 'Patient', NULL),
(6, 'Laika Mae Amano', 'lamano@gmail.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '09182409635', 'Pembo Makati', 'Doctor', NULL),
(7, 'erwin ons', 'erwinson@gmail.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '09509972084', 'Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'Patient', NULL),
(8, 'Labio Tabunggao', 'ltabunggao@gmail.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '09289768084', 'University of Makati', 'Patient', NULL),
(9, 'Tallulah Ballard', 'qinococy@mailinator.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '+1 (717) 661-2154', 'A adipisci repudiand', 'Patient', NULL),
(10, 'John Benedict Gabriel Areta', 'jbareta2@gmail.com', '$2y$10$lsF50iEXx8ty0HANTN/qBuD1iNgNJkugU6MiIu3GA/OfM.nNa7lJC', '09760590742', 'Unit 431 bldg 4 guadalupe bliss', 'Patient', '2e7d2413449e67c95877fa689bb9d3a2f247d4a7962549d339cf9667d5336696'),
(11, 'John Benedict Gabriel Areta', 'aretabenedict201@gmail.com', '$2y$10$6mZo8VUQb28FUR8J8CTM5uFnVUff24UAjhzrftFY21QGivzUdEuyS', '09760590742', 'Unit 431 bldg 4 guadalupe bliss', 'Patient', '54d9b7861a65dcf58e438c28c3ceca6f15c5c7e65bd49086556fbf4bcde9ea54'),
(12, 'Christian Horne', 'jirygeko@mailinator.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '+1 (596) 146-4651', 'Provident nisi aspe', 'Patient', NULL),
(13, 'Vaughan Schroeder', 'qofeni@mailinator.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '+1 (303) 923-8661', 'Cupidatat culpa anim', 'Patient', NULL),
(14, 'Lael Fry', 'defecoco@mailinator.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '+1 (206) 502-2246', 'Aliquid modi aperiam', 'Patient', NULL),
(15, 'Desirae Williamson', 'sawacefah@mailinator.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '+1 (859) 564-2155', 'Sint nostrum aliqua', 'Patient', NULL),
(16, 'hebehebe', 'Jbareta22@gmail.com', '$2y$10$fUpbsUwPJWRuz7CbH7KtV.3d1KASiCIuoI47xI.to4FH1M5OIFWVa', '09760590742', 'Unit 431 bldg 4 guadalupe bliss', 'Patient', NULL),
(17, 'Ralph Flores', 'vitoqigog@mailinator.com', '$2y$10$zhTeiMaqs21E/GpT3hy0C.YU7nOtBKdwoMAUKSD6cyEpUiVhXyuE2', '+1 (445) 152-4144', 'Officiis consequatur', 'Patient', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
