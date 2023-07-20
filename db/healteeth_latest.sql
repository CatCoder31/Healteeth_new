-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 20, 2023 at 05:55 AM
-- Server version: 10.6.14-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u483280624_healteeth`
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
(1, 10, 9, 'Lloyd Tabunggao', 'lloydtab@gmail.com', '0917284013', 'Forbes Park Makati', 2, 6, '', '2023-07-17', '08:00:00', '09:00:00', 'Approved'),
(2, 10, 9, 'Lloyd Tabunggao', 'lloydtab@gmail.com', '0917284013', 'Forbes Park Makati', 2, 6, '', '2023-07-20', '08:00:00', '09:00:00', 'Approved'),
(3, 10, 209, 'joshua lumelay', 'joshualumelay02delrosario@gmail.com', '09212575670', 'ep aparment southside makati city', 2, 7, '', '2023-07-22', '08:00:00', '10:00:00', 'Cancel');

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
(9, 202, '2023-07-13', '13:00:00', '19:00:00', '19:30:00', '20:00:00'),
(10, 10, '2023-07-17', '08:00:00', '19:00:00', '12:00:00', '13:00:00'),
(11, 10, '2023-07-20', '08:00:00', '19:00:00', '12:00:00', '13:00:00'),
(12, 10, '2023-07-22', '08:00:00', '19:00:00', '12:00:00', '13:00:00');

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
  `medical_record` text DEFAULT NULL,
  `role` varchar(11) NOT NULL DEFAULT 'Patient',
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verification_token` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `token_created_at` datetime NOT NULL,
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email_address`, `password`, `contact_number`, `full_address`, `gender`, `language`, `emergency_contact_name`, `emergency_contact_number`, `profile_photo`, `medical_record`, `role`, `email_verified`, `verification_token`, `username`, `token_created_at`, `token`) VALUES
(1, 'Valentine Pace', 'jaroqu@mailinator.com', '$2y$10$nEUZ83gMKs1upui0eS4EWOH0I43gu8iA/fuVvOQqF/uBkK77NoHSy', '', 'Culpa officiis veni', '', '', '', '', NULL, NULL, 'Patient', 0, '4bbd0840548f7c28826868b17f3346d7353386016748872dea0f173f793c154e', 'gisavi', '2023-07-06 18:36:18', NULL),
(2, 'Naomi Guerra', 'ruqaxycupe@mailinator.com', '$2y$10$Hl3eucBCSMKKJcIiZr2nS.9aOX92HJQ1z5epu01iVCANJWipy67jC', '', 'Culpa officiis veni', '', '', '', '', NULL, NULL, 'Patient', 0, 'bdf49d0cfa6f3403b9a2bcd5388d815cbad0aa5c9fcb2c81b8139494dac1093b', 'bipuzo', '2023-07-06 18:37:43', NULL),
(3, 'Xantha Lott', 'laikamaea@gmail.com', '$2y$10$Z.4lusSgvN5JKf7xrUztLeSqbzzj9MF4rJLGqmDuUCdZibtNQr5Cu', '+1 (619) 162-9842', 'Culpa officiis veni', '', '', '', '', NULL, NULL, 'Patient', 0, 'aae1340fe852b0e92cf4edec054e0f3e8005776c7b5a493d818505a7585f9cb1', 'hojekori', '2023-07-06 19:13:43', NULL),
(4, 'Joelle Lawrence', 'ligac@mailinator.com', '$2y$10$Eh2AqlP9HLk.Z7WzYd4O0eGEmCTZrgGAlWjNyjcH5dToWjYW/MWbe', '+1 (619) 162-9842', 'Culpa officiis veni', '', '', '', '', NULL, NULL, 'Patient', 0, '6f36671f55c35760f8a5f29cb074db5db19c4663f5f9763352eb64c3f2e956a0', 'gisavi', '2023-07-06 19:29:41', NULL),
(5, 'Patrick Edwards', 'lyjybobob@mailinator.com', '$2y$10$7vdzFxndw6eqR/VALb5sAez/4UVFPWcPQB/E8xtaRyV1BGUsF3dTa', '+1 (619) 162-9842', 'Culpa officiis veni', '', '', '', '', NULL, NULL, 'Patient', 0, NULL, '', '0000-00-00 00:00:00', NULL),
(6, 'John Benedict Areta', 'Jbareta2@gmail.com', '$2y$10$.lNaAzLzN31NeE9T7KzT6e/8lNkU1hv8ZV3u/0MZbsGX2E2Mm5GLS', '09760590742', 'Unit 431 bldg 4 guadalupe bliss', 'Male', 'Bicolano', 'Laika Mae Amano', '09760590742', 'assets/upload_images/64ae634689ec6.png', NULL, 'Patient', 1, '1c895bc5cc5da38c2bacc5706eefb2f0088d6df1cba260b435de44dfef85844b', 'Benedict', '2023-07-06 21:04:12', 'b3792043a1897da90d4db748eb7653f5f838f2fd813e04189a6f665a75b50999'),
(7, 'John Benedict Gabriel Areta', 'aretabenedict01@gmail.com', '$2y$10$77XUW52SRDqagKI95nBQDewHpPUhhG.Op5ryoHRZOe5Zp8.SAi66m', '09760590742', 'Unit 431 bldg 4 guadalupe bliss', 'Male', 'Filipino', 'Eaton Dennis', 'username', 'assets/upload_images/64a7922f4f50a.png', NULL, 'Patient', 1, '8d20a6729d6000fc355b1abd4133239e24df8a4a262eb9c2ca0aa0c4090c0186', 'benedict', '2023-07-06 23:57:59', '867412d481c94a18b2addcc648f244a172ea09eb5cf61102e0d823a44d86aa50'),
(8, 'Josephine Garcia', 'keravyfub@mailinator.com', '$2y$10$MP1LZ/P.Xq7u8u6MmYQAleqe.TY8sHvUaI.0o2VpvfsIV.iptEdi.', '', '', '', '', '', '', NULL, NULL, 'Patient', 0, 'bef54e40d83a36954d5ecce1811a42ebe50af20b4aded77673558f84f51eceeb', 'zukajypeha', '2023-07-07 09:47:06', NULL),
(9, 'Lloyd Tabunggao', 'lloydtab@gmail.com', '$2y$10$7vdzFxndw6eqR/VALb5sAez/4UVFPWcPQB/E8xtaRyV1BGUsF3dTa', '0917284013', 'Forbes Park Makati', 'Male', 'Bicolano', 'Bernard Tadena', '09182038501', 'assets/upload_images/64a7ef9b6cd32.png', NULL, 'Patient', 1, 'a911f119bb7d39e69e621ada06f17da11f97d12c01758e0bafb38728af7e0dd0', 'lloydzkie', '2023-07-07 09:55:39', '1c7d38463c2dbb227356b5c5738ba1e06a2ed18a6e0b8f4963cf3a80ef3a7b18'),
(10, 'Gene Lloyd Tabunggao', 'genelloyd@gmail.com', '$2y$10$7vdzFxndw6eqR/VALb5sAez/4UVFPWcPQB/E8xtaRyV1BGUsF3dTa', '431', 'Repellendus Corpori', 'Male', 'Bicolano', 'Bernard Tadena', '864', 'assets/upload_images/64a7af70c9e7e.jpg', NULL, 'Doctor', 1, '4ed9d6561cb2f6f67ce4b3d4ae940060c1c71126cabedaa6730b099da892ebfd', 'nopyv', '2023-07-07 14:17:47', 'c25ba330e8350d9cea3558dd7800c24f30b63bdebe6c8eccb1315e4c506f00a4'),
(11, 'GL Tabunggao', 'gtabunggao.a61816078@umak.edu.ph', '$2y$10$r1G0yPkaFvxrsFasURyiFet.yXsn3t7ABUaBmvsHtvNdJGj3gcdia', '09189768084', 'Cembo Makati', 'Male', 'Ilocano', 'Lloyd', '091284912041', NULL, NULL, 'Patient', 1, 'faabaeaa4ff3f6d03a0c0957eff56268ea7ece6b8916e0cd6dfd104d3161e03d', 'genezkie', '2023-07-07 21:26:30', NULL),
(200, 'sample', 'healteeth2023@gmail.com', '$2y$10$YnE/lk13vS3/bYSZvfnTdu7mgXNfN27jWuSU18holDec0VOTqw.wK', '62728282', 'hsjsjak', 'Male', 'Bicolano', 'nsjdmdm', '8383939293', 'assets/upload_images/64afa0b93c866.png', NULL, 'Patient', 1, '5c890bfae5f8e8655545d67ddfff55485baa4625d295f8a9330444b2f55f1f59', '', '2023-07-11 15:08:54', 'ebd08ec4017fc67ff66cc333900b5bb6777b491d56a41c0f2e1705a6195987ce'),
(201, 'regine', 'ricafortjd916@gmail.com', '$2y$10$NvmE32N4l/dN0Ef3wr7VReh02UO.XXTrIQq57LWdhRnh9KKFtdWJa', '09816175102', 'South cembo makati city', 'Female', 'Bicolano', 'Joshua lumelay', '09212575677', 'assets/upload_images/64ad7d361a0e8.jpeg', NULL, 'Patient', 1, '821d6b38b7753fe664ac22b8fb99b6d33c59bf55c36d11fcb11d2d14df5eccd9', 'regine', '2023-07-11 15:57:23', 'd001a89e6009573e3ae91f914305c40c22cda7b3606b5c3cc2f30eb21184262a'),
(203, 'Regine', 'regineee19@gmail.com', '$2y$10$mnpxdM3UxL6/gTUJ.Ppzq.RSQnz0eiuYe8MhNnXfNIAyq9387QFiW', '09461513500', 'issa21savage02@gmail.com', 'Male', 'Bicolano', 'reg', '09164041767', NULL, NULL, 'Patient', 1, '29c2b47bd8c75e0b917bf16807e5dcc137efd7d129954ad1306bb9a8dd017982', '', '2023-07-12 00:04:21', 'c8120dd0815a0d3cc9e8583ed91286c65f43fd71685cbaa4e2636ddd7aa7ab76'),
(204, 'Juswa', 'issa21savage02@gmail.com', '$2y$10$oo5.KloT0t56IzSEA4hlJ.C64D8Y6UbRR5vov/SpfOnYwjvPiXrTW', '', '', '', 'Bicolano', '', '', 'assets/upload_images/64adef6f0fd22.jpeg', NULL, 'Patient', 1, '5f1f8cdaadebf3f878f1e11a1e9c443e14cbec07b99ab7c5153f878d4780bd76', '', '2023-07-12 00:05:55', '26583dac8b1de886c4ba6693ec221aba4063b79bea68fee4b5f77164582f53c9'),
(205, 'Molly Daniels', 'benedict145789@gmail.com', '$2y$10$Ob1JhRaGzpKU4DcH8ETyfeXcc/LhgdAvXDnH9x4yuBfjK5VKwuvGu', '09760590742', 'Unit 431 bldg 4 guadalupe bliss', 'Male', 'Bicolano', 'John Benedict Gabriel Areta', '09760590742', 'assets/upload_images/64ae7f8bb68d8.png', NULL, 'Patient', 1, '94f729c1eca4127a8e2efdd3e854e947f6d7b053f1bef2fb94c767cb1a54576c', '', '2023-07-12 10:22:42', NULL),
(206, 'joshua delrosario', 'jlumelay.a61827019@umak.edu.ph', '$2y$10$r1UDgXrNjb2FIZ21vrQGSewjkUvtHpbnJh2VpwoHsaK1wWdli99t6', '09212575670', 'Ep apartment south side makati city', 'Male', 'Bicolano', 'Regine ricafort', '09146470712', 'assets/upload_images/64af07d281fcb.jpeg', NULL, 'Patient', 1, '8df0003b0cef3c0bf47480458781e776deda5b7606bf07c996531406a0242fe2', '', '2023-07-12 20:00:13', 'a3d4db61be4a9a3c8dac238c1d4575d93702c8fdb0a4c82cf2b9c35015b2f9dc'),
(207, 'Leo Tucker', 'healteethph@gmail.com', '$2y$10$b/G1EcjfFnNb92X1Q5EHme3qhlSx1hbyoga.FgqUFywXZvFKurxTS', '88', 'Eum et excepteur fug', 'Male', 'Bicolano', 'Steel Ayers', '416', 'assets/upload_images/64af5dead3ea7.png', NULL, 'Patient', 1, '54271f10aef57f4b1f400a562372bdb8825a1ff82895fc4940e8affb006d0952', '', '2023-07-13 02:13:22', NULL),
(208, 'Laika Mae', 'laikamaeamano31@gmail.com', '$2y$10$AioTR6uGE5LuTTyeOFDGoOAdDKhJikzo6kpEZcY.r0IqkrovHU8Gi', '09217567679', 'Sta. Ana Manila', 'Female', 'Filipino', 'Edward Amano', '09287587679', NULL, NULL, 'Patient', 1, '50b073dc77158a55ae46d7dc48d5b18ed801c7db65d1176c20e6ed69af51710d', '', '2023-07-18 11:45:45', '14f8fd8c51ef88c51da086ed46cb8cc1c11d6a7fe7cc935f58c5e0f577116d28'),
(209, 'joshua lumelay', 'joshualumelay02delrosario@gmail.com', '$2y$10$GLfgUuLe6NrOzfmUXjsx2OSwONC1GwdRHc2SPmqBJUX2rBzXwY4Ba', '09212575670', 'ep aparment southside makati city', 'Male', 'Filipino', 'regine ricafort', '09164041767', NULL, NULL, 'Patient', 1, '45fd1726511a5eee84c1558a46a743d75c0d26f605b3b425d8a332c6a0ec4258', '', '2023-07-20 02:51:02', NULL),
(210, 'Nehru Brown', 'cemaqixu@mailinator.com', '$2y$10$HO3QpshVlT3KL9lp8pZCNe.id4iNFAdTWLdka5WrBAsEVcjIDBuFO', '', '', '', '', '', '', NULL, NULL, 'Patient', 0, '2c1175dd1a7879d0dee1cb96d5705cb0d211414d96360d185deb7cad5f873765', '', '2023-07-20 05:26:38', NULL),
(211, 'Barbara Adkins', 'kynazodul@mailinator.com', '$2y$10$HwKfVX2UXKH8pCTfLEumGuSkVQS3mNlaphCcJJFA7B9ZppctxKB.m', '', '', '', '', '', '', NULL, NULL, 'Patient', 0, '2d737875103a17cc163733cf313e58d12fb3f156932360e5a5f7daed68532dfb', '', '2023-07-20 05:37:32', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
