-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 05, 2023 at 08:12 AM
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
-- Table structure for table `asset_borrowed`
--

CREATE TABLE `asset_borrowed` (
  `id` int NOT NULL,
  `itemId` int NOT NULL,
  `userId` int NOT NULL,
  `borrowedBy` int NOT NULL,
  `dateStart` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateEnd` datetime NOT NULL,
  `dateBack` datetime DEFAULT NULL,
  `siteId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `asset_borrowed`
--

INSERT INTO `asset_borrowed` (`id`, `itemId`, `userId`, `borrowedBy`, `dateStart`, `dateEnd`, `dateBack`, `siteId`) VALUES
(1, 1, 1, 1, '2023-06-01 14:03:11', '2023-07-01 02:03:11', '2023-06-01 15:14:50', 1),
(2, 1, 1, 1, '2023-06-01 14:03:11', '2023-07-01 02:03:11', '2023-06-01 15:14:50', 1),
(3, 1, 1, 1, '2023-06-01 14:20:17', '2023-07-01 02:20:17', '2023-06-01 15:14:50', 1),
(4, 1, 4, 1, '2023-06-01 14:48:36', '2023-07-01 02:48:36', '2023-06-01 15:14:50', 1),
(5, 1, 5, 1, '2023-06-01 14:53:00', '2023-07-01 02:53:00', '2023-06-01 15:14:50', 1),
(6, 1, 1, 1, '2023-06-01 15:05:59', '2023-07-01 03:05:59', '2023-06-02 07:58:51', 1),
(7, 1, 1, 1, '2023-06-02 07:58:55', '2023-07-02 07:58:55', '2023-06-02 08:14:15', 1),
(8, 1, 1, 1, '2023-06-02 08:30:44', '2023-07-02 08:30:44', '2023-06-02 11:18:48', 1),
(9, 2, 1, 1, '2023-06-02 11:08:41', '2023-07-02 11:08:41', '2023-06-02 11:20:18', 1),
(10, 3, 12, 1, '2023-06-02 11:08:53', '2023-07-02 11:08:53', '2023-06-02 11:20:23', 1),
(11, 3, 12, 1, '2023-06-02 11:08:53', '2023-07-02 11:08:53', '2023-06-02 11:20:23', 1),
(12, 1, 13, 1, '2023-06-02 11:20:31', '2023-07-02 11:20:31', '2023-06-02 12:16:42', 1),
(13, 1, 1, 1, '2023-06-02 12:21:54', '2023-07-02 12:21:54', '2023-06-05 08:04:47', 1),
(14, 2, 1, 1, '2023-06-05 08:04:24', '2023-07-05 08:04:24', '2023-06-05 08:06:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `asset_items`
--

CREATE TABLE `asset_items` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `code` varchar(30) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `siteId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `asset_items`
--

INSERT INTO `asset_items` (`id`, `name`, `category`, `code`, `date`, `siteId`) VALUES
(1, 'usb-c til usb-a', 'Adaptere', '001', '2023-06-01 12:15:34', 1),
(2, 'usb-c til usb-a', 'Adaptere', '002', '2023-06-01 12:15:34', 1),
(3, 'usb-c til usb-a', 'Adaptere', '003', '2023-06-01 12:15:34', 1),
(4, 'usb-c til usb-a', 'Adaptere', '004', '2023-06-01 12:15:34', 1),
(5, 'usb-c til usb-a', 'Adaptere', '005', '2023-06-01 12:15:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `asset_user`
--

CREATE TABLE `asset_user` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `mail` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `internalId` int DEFAULT NULL,
  `siteId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `asset_user`
--

INSERT INTO `asset_user` (`id`, `name`, `mail`, `internalId`, `siteId`) VALUES
(1, 'awd', '', 1, 1),
(4, 'iosedu', '', NULL, 1),
(5, 'rpgjdg', '', NULL, 1),
(11, 'aaaaaaaaaaaaaa', NULL, NULL, 1),
(12, 'awdawd', NULL, NULL, 1),
(13, 'lkfdgsrekplåodgftrkolpgtdrffkgtrdse', NULL, NULL, 1);

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
(10, 'registerCodes.all', 'login.adm', NULL, NULL, NULL, 'see codes by all users'),
(11, 'register.code', 'login', NULL, NULL, NULL, NULL),
(12, 'Asset', 'asset', 'asset/itemList', NULL, NULL, NULL),
(13, 'asset.itemList', 'asset', NULL, NULL, NULL, NULL);

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
(22, '6477320ad5daf', 1, 1, 0, '2023-05-31 13:39:51', '2023-05-31 13:54:51'),
(23, '647847a1e6398', 4, 0, 0, '2023-06-01 09:23:59', '2023-06-01 09:38:59'),
(24, '6478511830a6d', 1, 1, 0, '2023-06-01 10:01:30', '2023-06-01 10:16:30'),
(25, '6478551ed86ba', 1, 1, 0, '2023-06-01 10:21:48', '2023-06-01 10:36:48'),
(26, '64785530e0239', 1, 1, 0, '2023-06-01 10:21:48', '2023-06-01 10:36:48'),
(27, '6478555da59de', 1, 1, 0, '2023-06-01 10:22:08', '2023-06-01 10:37:08'),
(28, '6478556659e12', 1, 1, 0, '2023-06-01 10:22:08', '2023-06-01 10:37:08'),
(29, '6478556d2ee4d', 1, 1, 0, '2023-06-01 10:22:08', '2023-06-01 10:37:08'),
(30, '6478556f85aba', 1, 1, 0, '2023-06-01 10:22:08', '2023-06-01 10:37:08'),
(31, '647855a1101be', 1, 1, 0, '2023-06-01 10:22:08', '2023-06-01 10:37:08'),
(32, '64785b29d30ca', 1, 0, 0, '2023-06-01 10:47:35', '2023-06-01 11:02:35'),
(33, '64785ec321155', 1, 0, 0, '2023-06-01 11:02:53', '2023-06-01 11:17:53');

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
(6, 1, 1, 10, 0, '2023-05-20 18:30:21', NULL),
(7, 0, 1, 11, 0, '2023-05-31 15:07:46', NULL),
(8, 4, 1, 3, 1, '2023-06-01 09:21:44', NULL),
(9, 4, 1, 9, 1, '2023-06-01 09:21:44', NULL),
(10, 5, 1, 3, 1, '2023-06-01 11:06:51', NULL),
(11, 5, 1, 9, 1, '2023-06-01 11:06:51', NULL),
(12, 1, 1, 12, 1, '2023-06-01 12:09:43', NULL),
(13, 1, 1, 13, 0, '2023-06-01 12:09:43', NULL);

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
-- Indexes for table `asset_borrowed`
--
ALTER TABLE `asset_borrowed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assetItem` (`itemId`),
  ADD KEY `assetUser` (`userId`),
  ADD KEY `borrowedBy` (`borrowedBy`);

--
-- Indexes for table `asset_items`
--
ALTER TABLE `asset_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_user`
--
ALTER TABLE `asset_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assetInternalUser` (`internalId`);

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
-- AUTO_INCREMENT for table `asset_borrowed`
--
ALTER TABLE `asset_borrowed`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `asset_items`
--
ALTER TABLE `asset_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `asset_user`
--
ALTER TABLE `asset_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `registerCodes`
--
ALTER TABLE `registerCodes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `registerCodesUsed`
--
ALTER TABLE `registerCodesUsed`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userPermission`
--
ALTER TABLE `userPermission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asset_borrowed`
--
ALTER TABLE `asset_borrowed`
  ADD CONSTRAINT `assetItem` FOREIGN KEY (`itemId`) REFERENCES `asset_items` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `assetUser` FOREIGN KEY (`userId`) REFERENCES `asset_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `borrowedBy` FOREIGN KEY (`borrowedBy`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `asset_user`
--
ALTER TABLE `asset_user`
  ADD CONSTRAINT `assetInternalUser` FOREIGN KEY (`internalId`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
