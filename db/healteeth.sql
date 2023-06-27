-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2023 at 02:36 PM
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
  `role` varchar(11) NOT NULL DEFAULT 'Patient'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email_address`, `password`, `contact_number`, `full_address`, `role`) VALUES
(1, 'Lloyd Tabunggao', 'genelloyd@gmail.com', '0192023a7bbd73250516f069df18b500', '123123', 'Cembo Makati', 'Doctor'),
(2, 'Gene Tabunggao', 'gene13@gmail.com', '0192023a7bbd73250516f069df18b500', '124', 'Cembo Makati', 'Patient'),
(3, 'Gene Lloyd', 'gene137@gmail.com', '0192023a7bbd73250516f069df18b500', '312123', 'Makati', 'Staff'),
(4, 'Gene Lloyd Tabunggao', 'doctor@healteeth.com', '0192023a7bbd73250516f069df18b500', '925119375', 'Cembo Makati City', 'Doctor'),
(5, 'Staff', 'staff@healteeth.com', '4297f44b13955235245b2497399d7a93', '2147483647', 'taguig', 'Staff'),
(6, 'user', 'user@healteeth.com', '0192023a7bbd73250516f069df18b500', '2147483647', 'makati', 'Patient'),
(7, 'Lloyd Tabunggao', 'lloydtab@gmail.com', '0192023a7bbd73250516f069df18b500', '09212575670', 'Cembo Makati', 'Patient'),
(8, 'Joshua Lumelay', 'joshualumelay@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '2147483647', 'emq ep apartment south side makati city', 'Patient'),
(9, 'Laika Mae Amano', 'lamano@gmail.com', '0192023a7bbd73250516f069df18b500', '09182409635', 'Pembo Makati', 'Doctor'),
(10, 'erwin ons', 'erwinson@gmail.com', '0192023a7bbd73250516f069df18b500', '09509972084', 'Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'Patient'),
(11, 'Labio Tabunggao', 'ltabunggao@gmail.com', '7c5ebba9c7ab1ed409995d91e843f508', '09289768084', 'University of Makati', 'Patient'),
(12, 'Gene Lloyd Tabunggao', 'gltab@gmail.com', 'b40776c28fa06e8983d17061e34e50cf', '09819284123', 'Cembo Makati', 'Patient');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
