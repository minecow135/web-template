-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2023 at 08:54 AM
-- Server version: 8.0.34-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

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
  `comment` varchar(100) DEFAULT NULL,
  `dateStart` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateEnd` datetime NOT NULL,
  `dateBack` datetime DEFAULT NULL,
  `siteId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `asset_borrowed`
--

INSERT INTO `asset_borrowed` (`id`, `itemId`, `userId`, `borrowedBy`, `comment`, `dateStart`, `dateEnd`, `dateBack`, `siteId`) VALUES
(1, 1, 1, 1, NULL, '2023-06-01 14:03:11', '2023-07-01 02:03:11', '2023-06-01 15:14:50', 1),
(2, 1, 1, 1, NULL, '2023-06-01 14:03:11', '2023-07-01 02:03:11', '2023-06-01 15:14:50', 1),
(3, 1, 1, 1, NULL, '2023-06-01 14:20:17', '2023-07-01 02:20:17', '2023-06-01 15:14:50', 1),
(4, 1, 4, 1, NULL, '2023-06-01 14:48:36', '2023-07-01 02:48:36', '2023-06-01 15:14:50', 1),
(5, 1, 5, 1, NULL, '2023-06-01 14:53:00', '2023-07-01 02:53:00', '2023-06-01 15:14:50', 1),
(6, 1, 1, 1, NULL, '2023-06-01 15:05:59', '2023-07-01 03:05:59', '2023-06-02 07:58:51', 1),
(7, 1, 1, 1, NULL, '2023-06-02 07:58:55', '2023-07-02 07:58:55', '2023-06-02 08:14:15', 1),
(8, 1, 1, 1, NULL, '2023-06-02 08:30:44', '2023-07-02 08:30:44', '2023-06-02 11:18:48', 1),
(9, 2, 1, 1, NULL, '2023-06-02 11:08:41', '2023-07-02 11:08:41', '2023-06-02 11:20:18', 1),
(10, 3, 12, 1, NULL, '2023-06-02 11:08:53', '2023-07-02 11:08:53', '2023-06-02 11:20:23', 1),
(11, 3, 12, 1, NULL, '2023-06-02 11:08:53', '2023-07-02 11:08:53', '2023-06-02 11:20:23', 1),
(12, 1, 13, 1, NULL, '2023-06-02 11:20:31', '2023-07-02 11:20:31', '2023-06-02 12:16:42', 1),
(13, 1, 1, 1, NULL, '2023-06-02 12:21:54', '2023-07-02 12:21:54', '2023-06-05 08:04:47', 1),
(14, 2, 1, 1, NULL, '2023-06-05 08:04:24', '2023-07-05 08:04:24', '2023-06-05 08:06:43', 1),
(15, 1, 1, 1, NULL, '2023-06-08 08:35:24', '2023-07-08 08:35:24', '2023-06-08 10:06:49', 1),
(16, 3, 1, 1, NULL, '2023-06-08 09:59:03', '2023-07-08 09:59:03', '2023-06-08 10:06:58', 1),
(17, 1, 1, 1, NULL, '2023-06-09 09:55:33', '2023-07-09 09:55:33', '2023-06-09 10:13:50', 1),
(18, 1, 1, 1, NULL, '2023-06-09 11:01:02', '2023-07-09 11:01:02', '2023-06-09 11:01:27', 1),
(19, 1, 1, 1, NULL, '2023-06-09 11:04:19', '2023-07-09 11:04:19', '2023-06-09 11:04:29', 1),
(20, 1, 1, 1, NULL, '2023-06-09 12:07:03', '2023-07-09 12:07:03', NULL, 1),
(21, 1, 1, 1, NULL, '2023-06-12 08:03:58', '2023-07-12 08:03:58', NULL, 1),
(22, 3, 5, 1, NULL, '2023-06-12 08:04:10', '2023-07-12 08:04:10', NULL, 1),
(23, 3, 14, 1, NULL, '2023-06-12 08:38:37', '2023-07-12 08:38:37', NULL, 1);

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
  `siteId` int NOT NULL,
  `removed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `asset_items`
--

INSERT INTO `asset_items` (`id`, `name`, `category`, `code`, `date`, `siteId`, `removed`) VALUES
(1, 'usb-c til usb-a', 'Adaptere', '001', '2023-06-01 12:15:34', 1, 0),
(2, 'usb-c til usb-a', 'Adaptere', '002', '2023-06-01 12:15:34', 1, 0),
(3, 'usb-c til usb-a', 'Adaptere', '003', '2023-06-01 12:15:34', 1, 0),
(4, 'usb-c til usb-a', 'Adaptere', '004', '2023-06-01 12:15:34', 1, 0),
(5, 'usb-c til usb-a', 'Adaptere', '005', '2023-06-01 12:15:34', 1, 0),
(10, 'awd', 'awd', '9', '2023-06-05 10:56:14', 1, 0),
(11, 'awd', 'awd', '10', '2023-06-05 11:01:31', 1, 0),
(12, 'awd', 'awd', '11', '2023-06-05 11:01:31', 1, 0),
(13, 'awd', 'awd', '12', '2023-06-05 11:01:31', 1, 0),
(14, 'awd', 'awd', '13', '2023-06-05 11:01:31', 1, 0),
(15, 'awd', 'awd', '14', '2023-06-05 11:01:31', 1, 0),
(16, 'awd', 'awd', '10', '2023-06-05 11:03:28', 1, 0),
(17, 'awd', 'awd', '11', '2023-06-05 11:03:28', 1, 0),
(18, 'awd', 'awd', '12', '2023-06-05 11:03:28', 1, 0),
(19, 'awd', 'awd', '13', '2023-06-05 11:03:28', 1, 0),
(20, 'awd', 'awd', '14', '2023-06-05 11:03:28', 1, 0),
(21, 'awd', 'awd', '10', '2023-06-05 11:06:25', 1, 0),
(22, 'awd', 'awd', '11', '2023-06-05 11:06:25', 1, 1),
(23, 'awd', 'awd', '12', '2023-06-05 11:06:25', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `asset_user`
--

CREATE TABLE `asset_user` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mail` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `internalId` int DEFAULT NULL,
  `siteId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `asset_user`
--

INSERT INTO `asset_user` (`id`, `name`, `mail`, `internalId`, `siteId`) VALUES
(1, 'awd', 'awd@awd.awd', 1, 1),
(4, 'iosedu', 'awd1@awd.awd', NULL, 1),
(5, 'rpgjdg', 'awd2@awd.awd', NULL, 1),
(11, 'aaaaaaaaaaaaaa', 'awd3@awd.awd', NULL, 1),
(12, 'awdawd', 'awd5@awd.awd', NULL, 1),
(13, 'lkfdgsrekplåodgftrkolpgtdrffkgtrdse', 'awd6@awd.awd', NULL, 1),
(14, NULL, '', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `group_groups`
--

CREATE TABLE `group_groups` (
  `id` int NOT NULL,
  `groupName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `siteId` int NOT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `group_groups`
--

INSERT INTO `group_groups` (`id`, `groupName`, `siteId`, `description`) VALUES
(1, 'global.default', 0, NULL),
(2, 'global.loggedin', 0, NULL),
(3, 'global.all', 0, NULL),
(4, 'global.admin', 0, NULL),
(5, 'site.default', 1, NULL),
(6, 'site.loggedin', 1, NULL),
(7, 'site.all', 1, NULL),
(8, 'site.admin', 1, NULL),
(9, 'site.assetAdm', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_permissions`
--

CREATE TABLE `group_permissions` (
  `id` int NOT NULL,
  `groupId` int NOT NULL,
  `permissionId` int NOT NULL,
  `header` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `group_permissions`
--

INSERT INTO `group_permissions` (`id`, `groupId`, `permissionId`, `header`) VALUES
(7, 9, 12, 1),
(8, 9, 14, 0),
(9, 9, 15, 0),
(10, 9, 13, 0),
(11, 1, 1, 1),
(12, 1, 2, 0),
(13, 2, 3, 1),
(14, 8, 17, 1),
(17, 8, 18, 0),
(18, 4, 19, 0),
(19, 4, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `group_userGroup`
--

CREATE TABLE `group_userGroup` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `groupId` int NOT NULL,
  `dateStart` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateEnd` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `group_userGroup`
--

INSERT INTO `group_userGroup` (`id`, `userId`, `groupId`, `dateStart`, `dateEnd`) VALUES
(4, 1, 8, '2023-08-30 08:51:33', NULL),
(5, 1, 4, '2023-08-30 15:05:12', NULL),
(6, 1, 8, '2023-08-30 15:13:51', NULL),
(7, 1, 2, '2023-08-31 11:28:07', NULL),
(8, 1, 3, '2023-08-31 11:29:22', NULL),
(9, 1, 7, '2023-09-01 09:21:47', NULL),
(10, 1, 7, '2023-09-01 09:21:47', NULL),
(14, 1, 9, '2023-09-14 09:01:28', NULL);

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
(12, 'Asset', 'asset', 'asset/itemList', NULL, 90, NULL),
(13, 'asset.itemList', 'asset', NULL, NULL, NULL, NULL),
(14, 'asset.borrow', 'asset', NULL, NULL, NULL, NULL),
(15, 'asset.create', 'asset', NULL, NULL, NULL, NULL),
(16, 'login.discord', 'login', NULL, NULL, NULL, NULL),
(17, 'permissions', 'permissions', 'adm/permissions/index', NULL, 170, NULL),
(18, 'permissions.groups', 'permissions', NULL, NULL, NULL, NULL),
(19, 'permissions.list.global', 'permissions', NULL, NULL, NULL, NULL),
(20, 'permissions.list.all', 'permissions', NULL, NULL, NULL, NULL),
(21, 'permissions.delete.userPerm', 'permissions', NULL, NULL, NULL, NULL),
(22, 'permissions.delete.groupPerm', 'permissions', NULL, NULL, NULL, NULL),
(23, 'permissions.delete.groupUser', 'permissions', NULL, NULL, NULL, NULL);

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
(33, '64785ec321155', 1, 0, 0, '2023-06-01 11:02:53', '2023-06-01 11:17:53'),
(34, '647d7d08bbeaa', 1, 1, 0, '2023-06-05 08:13:27', '2023-06-05 08:28:27');

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
  `siteDescription` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `link` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `siteName`, `siteDescription`, `link`) VALUES
(0, 'global', NULL, NULL),
(1, 'default', NULL, NULL),
(2, 'test', NULL, 'test');

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
(1, 0, 0, 1, 1, '2023-05-19 22:31:00', NULL),
(2, 0, 0, 2, 1, '2023-05-19 22:31:00', NULL),
(3, 1, 0, 3, 1, '2023-05-19 22:34:23', NULL),
(4, 1, 0, 9, 1, '2023-05-19 22:34:23', NULL),
(6, 1, 0, 10, 0, '2023-05-20 18:30:21', NULL),
(8, 4, 1, 3, 1, '2023-06-01 09:21:44', NULL),
(9, 4, 1, 9, 1, '2023-06-01 09:21:44', NULL),
(10, 5, 1, 3, 1, '2023-06-01 11:06:51', NULL),
(11, 5, 1, 9, 1, '2023-06-01 11:06:51', NULL),
(12, 1, 1, 12, 1, '2023-06-01 12:09:43', NULL),
(13, 1, 1, 13, 0, '2023-06-01 12:09:43', NULL),
(14, 1, 1, 14, 0, '2023-06-08 11:39:29', NULL),
(15, 1, 1, 15, 0, '2023-06-08 11:39:29', NULL),
(17, 0, 0, 16, 0, '2023-06-16 09:35:40', NULL),
(19, 1, 2, 12, 1, '2023-08-30 12:48:29', NULL),
(23, 7, 0, 3, 1, '2023-09-18 10:30:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `discordId` varchar(50) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enbled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `discordId`, `date_time`, `enbled`) VALUES
(0, 'default', '', '', '0', '2023-05-11 06:43:20', 0),
(1, 'awd', 'awd@awd.awd', '$2y$12$bwop6jybCK8FD0iv1VTEMe/g0rIanb7mfrZaBjbTbBR5XBJQr4rCa', '0', '2023-05-10 08:55:42', 1),
(4, 'awdawdawd', 'awd@awd.awd', '$2y$12$r5PyvHux1X0K6nFJvm7U9ucUU/pOX9joPmd5hJiIFVWNFnlnaqDxK', '0', '2023-05-31 10:19:50', 1),
(5, 'awfegaegfswaef', 'awd@awd.awd', '$2y$12$02OxGptN5/k50wP2JuS/2.v91/I1jSG0g6VjRuQ04uXTVBXeHllqG', '0', '2023-05-31 12:46:44', 1),
(7, 'mine_cow135', 'krivig123@gmail.com', NULL, '170813552586653696', '2023-06-14 11:58:35', 1),
(8, 'test', 'tedryhdr@awegfseg.awd', '$2y$12$U7MfhQf.LUNvIpWAyOMdkOhNMEMi.I8Xz4risuEZiswsjMTtP8b7S', NULL, '2023-09-14 11:45:05', 1),
(9, 'awdawdawdawd', 'awdawdawdawd@awd', '$2y$12$48.q/x7j1cXraqVrhuieTOfyIRT5RVFwExKLHdZk18w.fVwsDRV5.', NULL, '2023-09-14 11:47:58', 1),
(10, 'a', 'a@a', '$2y$12$1mTJLpjYKfCtHeuwhJUOMuzzePae/FxdqCn7zGrU4E67LRrZnjjwa', NULL, '2023-09-14 11:51:13', 1),
(11, 'aa', 'aa@a', '$2y$12$n9.tliXpl3xsmKnMcMf5qOdtTB7PuGKQ0CPP2A3thrGdqSyOLYL3i', NULL, '2023-09-14 11:57:34', 1),
(12, 'aaa', 'aaa@a', '$2y$12$0sL0LYTRezWuTs2LCQadBeqkcDyqNpx6Q7pfALWVlxeA0c6nlDIa.', NULL, '2023-09-14 12:01:44', 1),
(13, 'aaaa', 'aaaa@a', '$2y$12$QRGGxtwtEWE8FsWN9vsSFePUcPQykw2vSQzyt7cnVtSJheWzqopzi', NULL, '2023-09-14 12:02:29', 1),
(14, 'aaaaa', 'aaaaa@a', '$2y$12$XeLWSCeGsH31UlTYvLqLwe8NqSz2mON1uWWsA6Cx0BZttHhhLtHfS', NULL, '2023-09-14 12:08:03', 1),
(15, 'aaaaaa', 'aaaaaa@a', '$2y$12$riWa2Mdams7FvxDKEWalCugCVB7ijBGHci6rXqwPgHjZ2QhWvKUcW', NULL, '2023-09-14 12:10:29', 1),
(16, 'aaaaaaa', 'aaaaaaa@a', '$2y$12$3zCMbWpbHv1rNr9V24QVsOjAVgakmYygr9GDxITTFW5ecfnJe1RNG', NULL, '2023-09-14 12:15:38', 1),
(17, 'aaaaaaaa', 'aaaaaaaa@a', '$2y$12$S9sT7E1riE/X1jnjl5O8Ru2F/4PSwt82YDw48VxC5u/EWBcihAKlu', NULL, '2023-09-14 12:16:59', 1),
(18, 'aaaaaaaaa', 'aaaaaaaaa@a', '$2y$12$LwhqLQEI4SWu1NloBs0/v.uXbWQgOqR7nvwlBrKHJJArQheTI4ECy', NULL, '2023-09-14 12:18:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashed_validator` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `selector`, `hashed_validator`, `user_id`, `expiry`) VALUES
(10, 'ac3c7947391f07eb64d96f385cc8af81', '$2y$10$oirX8SFuRq7puxQiCVnPkeVbbw0l7Sdi5O/m8xH/0daPx415a9Su.', 1, '2023-07-13 09:08:37'),
(11, '0889dcd957f02f804a98d32ef146da66', '$2y$10$eRlJKfVjaPfF0IYSEYt5Fec3r8Ra4I9TOtrvI0UM6k4o4bT6jEve2', 1, '2023-09-29 08:36:03');

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
-- Indexes for table `group_groups`
--
ALTER TABLE `group_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_siteId` (`siteId`);

--
-- Indexes for table `group_permissions`
--
ALTER TABLE `group_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group` (`groupId`),
  ADD KEY `groupPermission` (`permissionId`);

--
-- Indexes for table `group_userGroup`
--
ALTER TABLE `group_userGroup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userGroup_group` (`groupId`),
  ADD KEY `userGroup_user` (`userId`);

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
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset_borrowed`
--
ALTER TABLE `asset_borrowed`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `asset_items`
--
ALTER TABLE `asset_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `asset_user`
--
ALTER TABLE `asset_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `group_groups`
--
ALTER TABLE `group_groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `group_permissions`
--
ALTER TABLE `group_permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `group_userGroup`
--
ALTER TABLE `group_userGroup`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `registerCodes`
--
ALTER TABLE `registerCodes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `registerCodesUsed`
--
ALTER TABLE `registerCodesUsed`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userPermission`
--
ALTER TABLE `userPermission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Constraints for table `group_groups`
--
ALTER TABLE `group_groups`
  ADD CONSTRAINT `group_siteId` FOREIGN KEY (`siteId`) REFERENCES `sites` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `group_permissions`
--
ALTER TABLE `group_permissions`
  ADD CONSTRAINT `group` FOREIGN KEY (`groupId`) REFERENCES `group_groups` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `groupPermission` FOREIGN KEY (`permissionId`) REFERENCES `permission` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `group_userGroup`
--
ALTER TABLE `group_userGroup`
  ADD CONSTRAINT `userGroup_group` FOREIGN KEY (`groupId`) REFERENCES `group_groups` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `userGroup_user` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
