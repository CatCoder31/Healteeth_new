-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2022 at 05:27 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `phone` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL,
  `category` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(100) NOT NULL,
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
(1, 'Oral Prophylaxis', 'Cleaning', '4413898801654471636images.jpg'),
(2, 'Tooth Filling', 'Pasta', '3067076781654493120tooth-filling.jpg'),
(3, 'Tooth Extraction', 'Bunot', '939622754165449322322120-tooth-extraction.jpg'),
(4, 'Root Canal', 'Root Canal Treatment', '11850234521654493471rct.jpg'),
(5, 'Periapical Xray', 'Xray for the Root Canal', '19726716281654503371xray.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `category_id`, `service_name`, `service_price`) VALUES
(1, 1, 'Ordinary Cleaning', '800'),
(2, 1, 'Stain Removal with Cleaning', '2000'),
(3, 1, 'Deep Scaling with Gum Treatment', '2000'),
(4, 1, 'Topical Fluoride', '400'),
(5, 1, 'Fluoride Varnish', '1200'),
(6, 2, 'Per Surface', '600'),
(7, 2, 'Class III or IV of Anterior Teeth', '1800'),
(8, 3, 'Simple Tooth Extraction', '800'),
(9, 3, 'Complicated Extraction', '1500'),
(10, 3, 'Wisdom or Impacted Tooth Removal', '9000'),
(11, 4, 'RCT Including 4 XRays', '7000'),
(12, 4, 'Per Additional Canal Within the Same Tooth', '4000'),
(13, 4, 'Composite Build-up', '2500'),
(14, 4, 'Fiber Post', '2500'),
(15, 5, 'Per XRay', '400');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact_number` int(100) NOT NULL,
  `full_address` varchar(100) NOT NULL,
  `role` varchar(11) NOT NULL DEFAULT 'Patient'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email_address`, `password`, `contact_number`, `full_address`, `role`) VALUES
(1, 'Lloyd Tabunggao', 'genelloyd@gmail.com', '9da7aab36914c1f0b586c39e889160bd', 123123, 'Cembo Makati', 'Doctor'),
(2, 'Gene Tabunggao', 'gene13@gmail.com', 'b40776c28fa06e8983d17061e34e50cf', 124, 'Cembo Makati', 'Patient'),
(3, 'Gene Lloyd', 'gene137@gmail.com', 'a4a5c99f1d6e29bf56b2fcaa20a390f8', 312123, 'Makati', 'Staff'),
(4, 'doctor gene', 'doctor@healteeth.com', '4297f44b13955235245b2497399d7a93', 925119375, 'Cembo Makati City', 'Doctor'),
(5, 'staff', 'staff@healteeth.com', '4297f44b13955235245b2497399d7a93', 2147483647, 'taguig', 'Staff'),
(6, 'user', 'user@healteeth.com', '4297f44b13955235245b2497399d7a93', 2147483647, 'makati', 'Patient');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_pat_date_time` (`appointment_date`,`appointment_time`) USING BTREE;

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

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
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
