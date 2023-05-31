-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2023 at 02:35 PM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webTemplate`
--

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int NOT NULL,
  `permissionName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `permissionCategory` varchar(20) NOT NULL,
  `page` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dropdown` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `placement` int DEFAULT NULL,
  `permissionDescription` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `permissionName`, `permissionCategory`, `page`, `dropdown`, `placement`, `permissionDescription`) VALUES
(1, 'login', 'login', 'login/login', '', 998, NULL),
(2, 'register', 'login', 'login/register', '', 999, NULL),
(3, 'logout', 'login', 'login/logout', '', 1000, NULL),
(4, 'Profile', 'login', 'login/profile', '', 999, NULL),
(5, 'userAdm.read', 'login.adm', 'adm/users/read', 'adm', 100, NULL),
(6, 'userAdm.create', 'login.adm', 'adm/users/create', 'adm', 110, NULL),
(7, 'userAdm.update', 'login.adm', 'adm/users/update', 'adm', 120, NULL),
(8, 'userAdm.delete', 'login.adm', 'adm/users/delete', 'adm', 130, NULL),
(9, 'registerCodes', 'login.adm', 'adm/registerCodes/list', 'adm', 150, NULL),
(10, 'registerCodes.all', 'login.adm', NULL, NULL, NULL, 'see codes by all users');

-- --------------------------------------------------------

--
-- Table structure for table `registerCodes`
--

CREATE TABLE `registerCodes` (
  `id` int NOT NULL,
  `code` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `createdBy` int NOT NULL,
  `TotalUses` int NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registerCodes`
--

INSERT INTO `registerCodes` (`id`, `code`, `createdBy`, `TotalUses`, `disabled`, `start`, `end`) VALUES
(1, 'awd', 0, 0, 0, '2023-05-19 20:43:43', '2023-05-25 20:43:34'),
(2, 'awdawdawdw', 0, 0, 0, '2023-05-19 20:53:03', '2023-05-26 20:52:41'),
(3, 'awfessfw', 1, 7, 0, '2023-05-19 23:02:25', '2023-05-19 23:59:02'),
(4, 'awgaseg', 1, 0, 0, '2023-05-24 12:30:54', '2023-05-24 12:45:54'),
(5, '646de9f5cd6be', 1, 1, 0, '2023-05-24 12:41:57', '2023-05-24 12:56:57'),
(6, '646dea07d4d64', 1, 6, 0, '2023-05-24 12:42:15', '2023-05-24 12:57:15'),
(7, '646dea4d5a4ce', 1, 0, 0, '2023-05-24 12:43:25', '2023-05-24 12:58:25'),
(8, '646dffe563da5', 1, 4, 0, '2023-05-24 14:15:33', '2023-05-24 14:30:33'),
(9, '6470638e1d6a6', 1, 1, 0, '2023-05-26 09:45:15', '2023-05-26 10:00:15'),
(10, '647078ef35bc4', 1, 1, 0, '2023-05-26 11:16:29', '2023-05-26 11:31:29'),
(11, '64707f237e990', 1, 1, 0, '2023-05-26 11:16:29', '2023-05-26 11:31:29'),
(12, '6470808346d9a', 1, 1, 0, '2023-05-26 11:48:48', '2023-05-26 12:03:48'),
(13, '64709ba563a35', 1, 0, 0, '2023-05-26 13:44:34', '2023-05-26 13:59:34'),
(14, '64709bb37bf4c', 1, 5, 0, '2023-05-26 13:44:37', '2023-05-26 13:59:37'),
(15, '6476e82c1c7bf', 1, 1, 0, '2023-05-31 08:24:42', '2023-05-31 08:39:42'),
(16, '6476e82c1c7bf', 1, 1, 0, '2023-05-31 08:24:42', '2023-05-31 08:39:42'),
(17, '6476e9512f456', 1, 1, 0, '2023-05-31 08:24:42', '2023-05-31 08:39:42'),
(18, '6476e9810651d', 1, 1, 0, '2023-05-31 08:24:42', '2023-05-31 08:39:42'),
(19, '6476ee4e8c06c', 1, 1, 0, '2023-05-31 08:50:50', '2023-05-31 09:05:50'),
(20, '647702883b17c', 1, 1, 0, '2023-05-31 10:17:10', '2023-05-31 10:32:10'),
(21, 'adw', 1, 0, 0, '2023-05-31 12:46:19', '2023-05-31 13:45:47'),
(22, '6477320ad5daf', 1, 1, 0, '2023-05-31 13:39:51', '2023-05-31 13:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `registerCodesUsed`
--

CREATE TABLE `registerCodesUsed` (
  `id` int NOT NULL,
  `codeId` int NOT NULL,
  `userId` int NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registerCodesUsed`
--

INSERT INTO `registerCodesUsed` (`id`, `codeId`, `userId`, `time`) VALUES
(1, 12, 1, '2023-05-26 12:26:47'),
(2, 20, 4, '2023-05-31 10:19:50'),
(3, 21, 5, '2023-05-31 12:46:44'),
(4, 21, 4, '2023-05-31 12:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `description` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `active`, `description`) VALUES
(1, 'registerCode', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int NOT NULL,
  `siteName` varchar(20) NOT NULL,
  `siteDescription` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `siteName`, `siteDescription`) VALUES
(1, 'default', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userPermission`
--

CREATE TABLE `userPermission` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `siteId` int NOT NULL,
  `permissionId` int NOT NULL,
  `header` tinyint(1) NOT NULL DEFAULT '0',
  `dateStart` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateEnd` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userPermission`
--

INSERT INTO `userPermission` (`id`, `userId`, `siteId`, `permissionId`, `header`, `dateStart`, `dateEnd`) VALUES
(1, 0, 1, 1, 1, '2023-05-19 22:31:00', NULL),
(2, 0, 1, 2, 1, '2023-05-19 22:31:00', NULL),
(3, 1, 1, 3, 1, '2023-05-19 22:34:23', NULL),
(4, 1, 1, 9, 1, '2023-05-19 22:34:23', NULL),
(6, 1, 1, 10, 0, '2023-05-20 18:30:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enbled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `date_time`, `enbled`) VALUES
(0, 'default', '', '', '2023-05-11 06:43:20', 0),
(1, 'awd', 'awd@awd.awd', '$2y$12$bwop6jybCK8FD0iv1VTEMe/g0rIanb7mfrZaBjbTbBR5XBJQr4rCa', '2023-05-10 08:55:42', 1),
(4, 'awdawdawd', 'awd@awd.awd', '$2y$12$r5PyvHux1X0K6nFJvm7U9ucUU/pOX9joPmd5hJiIFVWNFnlnaqDxK', '2023-05-31 10:19:50', 1),
(5, 'awfegaegfswaef', 'awd@awd.awd', '$2y$12$02OxGptN5/k50wP2JuS/2.v91/I1jSG0g6VjRuQ04uXTVBXeHllqG', '2023-05-31 12:46:44', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registerCodes`
--
ALTER TABLE `registerCodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `registerCodesUsed`
--
ALTER TABLE `registerCodesUsed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`codeId`),
  ADD KEY `usedBy` (`userId`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userPermission`
--
ALTER TABLE `userPermission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissionId` (`permissionId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `siteId` (`siteId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `registerCodes`
--
ALTER TABLE `registerCodes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `registerCodesUsed`
--
ALTER TABLE `registerCodesUsed`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userPermission`
--
ALTER TABLE `userPermission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registerCodes`
--
ALTER TABLE `registerCodes`
  ADD CONSTRAINT `createdBy` FOREIGN KEY (`createdBy`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `registerCodesUsed`
--
ALTER TABLE `registerCodesUsed`
  ADD CONSTRAINT `code` FOREIGN KEY (`codeId`) REFERENCES `registerCodes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `usedBy` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `userPermission`
--
ALTER TABLE `userPermission`
  ADD CONSTRAINT `permissionId` FOREIGN KEY (`permissionId`) REFERENCES `permission` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `siteId` FOREIGN KEY (`siteId`) REFERENCES `sites` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
