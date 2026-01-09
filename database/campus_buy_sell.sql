-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2025 at 05:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `campus_buy_sell`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `condition` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `user_email`, `title`, `category`, `location`, `condition`, `price`, `contact`, `description`, `created_at`, `image`) VALUES
(6, 'kosisochukwu.nnachi.246705@unn.edu.ng', 'Hot Plate', 'Home', 'Okpara', 'Used', 7000.00, '09038488526', 'Cracked in the middle but working well', '2025-07-14 03:27:26', '6876e75d74dbe_WhatsApp Image 2025-07-13 at 12.01.12_e41fa942.jpg'),
(7, 'kosisochukwu.nnachi.246705@unn.edu.ng', '4 Big window blinds', 'Others', 'Hilltop', 'Used', 80000.00, '07038488526', 'Still in good condition', '2025-07-14 03:35:23', '6876e74caed0b_WhatsApp Image 2025-07-13 at 12.01.09_f4a90341.jpg'),
(8, 'kosisochukwu.nnachi.246705@unn.edu.ng', 'iPhone 12 Pro', 'Electronics', 'Behind Flat', 'Used', 380000.00, '09038488528', 'Direct UK used,\r\n128gb,\r\nFace ID✅ \r\nTrue Tone✅\r\nClean 💯\r\nBH 77%\r\nNo scratch or fault at all💯\r\nReceipt available', '2025-07-14 03:41:51', '6876e740670e1_WhatsApp Image 2025-07-13 at 12.00.57_2698c178.jpg'),
(10, 'kosisochukwu.nnachi.246705@unn.edu.ng', 'Stove', 'Home', 'Hilltop', 'Used', 3500.00, '08078678395', 'Good condition', '2025-07-14 05:51:15', '6876e73300c13_WhatsApp Image 2025-07-13 at 21.23.37_328e59c5.jpg'),
(11, 'kosisochukwu.nnachi.246705@unn.edu.ng', 'Washing machine', 'Appliances', 'Hilltop', 'Used', 135000.00, '07038488526', '7kg (Boscon Brande) washing machine', '2025-07-14 06:00:05', '6876e727e85ed_WhatsApp Image 2025-07-13 at 18.59.14_ff10083e.jpg'),
(12, 'kosisochukwu.nnachi.246705@unn.edu.ng', 'Company bed', 'Others', 'Hilltop', 'Used', 35000.00, '09065232157', 'Size of the bed is 6 by 4', '2025-07-14 06:04:22', '6876e70e84db3_WhatsApp Image 2025-07-13 at 20.15.22_6685a46a.jpg'),
(13, 'kosisochukwu.nnachi.246705@unn.edu.ng', 'Hisense deep freezer', 'Electronics', 'Hilltop', 'Used', 225000.00, '09065232157', 'Barely used \r\nReceipt and carton available✅\r\n180 litres \r\nIn good condition', '2025-07-14 09:10:52', '6876e719be177_WhatsApp Image 2025-07-13 at 10.49.00_13005942.jpg'),
(14, 'kosisochukwu.nnachi.246705@unn.edu.ng', 'Fan', 'Appliances', 'Mozart', 'Used', 40000.00, '09038488528', 'Still in a very good and great condition. No issues at all. Working very perfectly.', '2025-07-16 03:36:51', '68771e538feaf_WhatsApp Image 2025-07-13 at 12.01.05_b003a769.jpg'),
(15, 'kosisochukwu.nnachi.246705@unn.edu.ng', 'Window blind', 'Electronics', 'Hilltop', 'New', 45677.00, '09065232157', 'good', '2025-07-17 17:11:58', '68792edee1d92_WhatsApp Image 2025-07-13 at 12.01.09_f4a90341.jpg'),
(16, 'kosisochukwu.nnachi.246705@unn.edu.ng', 'Generator', 'Electronics', 'Bello', 'New', 40000.00, '07038488526', 'very good', '2025-07-17 17:17:01', '6879300d30b48_WhatsApp Image 2025-07-13 at 12.00.37_eb03b100.jpg'),
(19, 'ikenna.mbaekwe.246226@unn.edu.ng', 'Ringlight', 'Electronics', 'Hilltop', 'Used', 30000.00, '09065232157', 'Great and in perfect condition', '2025-07-27 00:09:53', '68856e51076ef_WhatsApp Image 2025-07-13 at 20.15.27_f43b428f.jpg'),
(20, 'ikenna.mbaekwe.246226@unn.edu.ng', 'Bed', 'Others', 'Hilltop', 'Used', 40000.00, '09065232157', 'Very good', '2025-07-27 00:11:18', '68856ea6c62f1_WhatsApp Image 2025-07-13 at 12.00.48_870eab79.jpg'),
(21, 'ikenna.mbaekwe.246226@unn.edu.ng', 'Generator', 'Electronics', 'Hilltop', 'Used', 50000.00, '09065232157', 'Still working', '2025-07-27 00:12:08', '68856ed88fb70_WhatsApp Image 2025-07-13 at 15.30.46_2641a4c4.jpg'),
(22, 'chimzurumoke.enemuo.244816@unn.edu.ng', 'Camry Car', 'Electronics', 'Mozart', 'Used', 1000000.00, '09038488526', 'In perfect condition', '2025-07-27 10:28:34', '6885ff52f25af_WhatsApp Image 2025-07-13 at 18.59.33_c3163266.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `verification_code` varchar(10) DEFAULT NULL,
  `is_verified` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `verification_code`, `is_verified`, `created_at`, `role`, `profile_pic`) VALUES
(1, 'KOSISOCHUWU', 'kosisochukwu.nnachi.246705@unn.edu.ng', '$2y$10$3uAqUEWFBV.hbttykET4jOegPq2MhbQEB3WfNAjOgHss58FmGaaf2', '', 1, '2025-07-14 01:06:08', 'admin', 'profile_688622d24c2002.41470574.jpg'),
(6, 'Ikenna', 'ikenna.mbaekwe.246226@unn.edu.ng', '$2y$10$Haas.J66dGiBvS3q467uJee5t52cfeiqRqDFcqWEAEve.l00tJYw6', '298832', 1, '2025-07-18 10:53:48', 'user', 'profile_6885f817dfc716.27240907.jpeg'),
(8, 'KOSISOCHUWU', 'kossydaniel021@unn.edu.ng', '$2y$10$03hjHs8bh1GwguAKc0jyK.vgEmcQ5k7hI1KUcrn5aLr00ilH7K2Wi', '295118', 0, '2025-07-22 00:31:51', 'user', NULL),
(10, 'CHIMZURUMOKE', 'chimzurumoke.enemuo.244816@unn.edu.ng', '$2y$10$gEvomVmu9dRI1RE3w8ovyOaOnMKyQn8ISkHXaRsOgKnJEpDBav142', '345610', 1, '2025-07-27 10:15:21', 'user', 'profile_6886004bedda78.69608498.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
