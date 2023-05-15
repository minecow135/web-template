-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 15, 2023 at 01:28 PM
-- Server version: 8.0.33-0ubuntu0.22.04.1
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
(1, 'login', 'login/login', '', 0, NULL),
(2, 'register', 'login/register', '', 0, NULL);

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
  `dateGiven` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateEnd` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userPermission`
--

INSERT INTO `userPermission` (`id`, `userId`, `siteId`, `permissionId`, `header`, `dateGiven`, `DateEnd`) VALUES
(1, 1, 1, 1, 1, '2023-05-15 10:19:36', NULL),
(3, 1, 1, 2, 1, '2023-05-15 12:18:06', NULL);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userPermission`
--
ALTER TABLE `userPermission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
