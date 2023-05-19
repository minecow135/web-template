-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 19, 2023 at 09:12 PM
-- Server version: 8.0.33-0ubuntu0.23.04.2
-- PHP Version: 8.1.12-1ubuntu4

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
  `permissionName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `page` varchar(50) NOT NULL,
  `dropdown` varchar(20) NOT NULL,
  `placement` int NOT NULL,
  `permissionDescription` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `permissionName`, `page`, `dropdown`, `placement`, `permissionDescription`) VALUES
(1, 'login', 'login/login', '', 998, NULL),
(2, 'register', 'login/register', '', 999, NULL),
(3, 'logout', 'login/logout', '', 1000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registerCodes`
--

CREATE TABLE `registerCodes` (
  `id` int NOT NULL,
  `code` varchar(10) NOT NULL,
  `start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registerCodes`
--

INSERT INTO `registerCodes` (`id`, `code`, `start`, `end`) VALUES
(1, 'awd', '2023-05-19 20:43:43', '2023-05-25 20:43:34'),
(2, 'awdawdawdw', '2023-05-19 20:53:03', '2023-05-26 20:52:41');

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
(1, 'registerCode', 0, NULL);

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
(1, 1, 1, 1, 1, '2023-05-15 10:19:36', NULL),
(3, 1, 1, 2, 1, '2023-05-15 12:18:06', NULL),
(4, 0, 1, 1, 1, '2023-05-16 07:29:23', '2023-10-27 09:28:54'),
(7, 1, 1, 3, 1, '2023-05-16 08:52:23', NULL),
(8, 1, 1, 3, 1, '2023-04-02 11:45:15', '2023-05-08 11:45:15'),
(9, 0, 1, 2, 1, '2023-05-19 20:08:54', NULL);

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
(1, 'awd', 'awd@awd.awd', '$2y$12$bwop6jybCK8FD0iv1VTEMe/g0rIanb7mfrZaBjbTbBR5XBJQr4rCa', '2023-05-10 08:55:42', 1);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registerCodes`
--
ALTER TABLE `registerCodes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

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
