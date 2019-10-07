-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.31-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for mbmerp
CREATE DATABASE IF NOT EXISTS `mbmerp` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mbmerp`;

-- Dumping structure for table mbmerp.checkinout
DROP TABLE IF EXISTS `checkinout`;
CREATE TABLE IF NOT EXISTS `checkinout` (
  `Logid` int(11) NOT NULL AUTO_INCREMENT,
  `Userid` int(11) NOT NULL DEFAULT '0',
  `CheckTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CheckType` int(11) DEFAULT '0',
  `Sensorid` int(11) DEFAULT '0',
  `WorkType` int(11) DEFAULT '0',
  `AttFlag` int(11) DEFAULT '0',
  `Checked` tinyint(1) DEFAULT NULL,
  `Exported` tinyint(1) DEFAULT NULL,
  `OpenDoorFlag` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Logid`),
  UNIQUE KEY `Userid` (`Userid`,`CheckTime`)
) ENGINE=MyISAM AUTO_INCREMENT=288 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.checkinout: 185 rows
DELETE FROM `checkinout`;
/*!40000 ALTER TABLE `checkinout` DISABLE KEYS */;
INSERT INTO `checkinout` (`Logid`, `Userid`, `CheckTime`, `CheckType`, `Sensorid`, `WorkType`, `AttFlag`, `Checked`, `Exported`, `OpenDoorFlag`) VALUES
	(102, 53, '2018-07-19 20:53:37', 0, 1, 0, 1, NULL, NULL, -1),
	(101, 56, '2018-07-19 20:32:25', 0, 1, 0, 1, NULL, NULL, -1),
	(112, 56, '2018-07-19 20:32:24', 0, 1, 0, 1, NULL, NULL, -1),
	(113, 56, '2018-07-20 04:51:40', 0, 1, 0, 1, NULL, NULL, -1),
	(114, 56, '2018-07-20 04:52:03', 0, 1, 0, 1, NULL, NULL, -1),
	(115, 55, '2018-07-20 04:54:35', 0, 1, 0, 1, NULL, NULL, -1),
	(116, 55, '2018-07-20 04:54:37', 0, 1, 0, 1, NULL, NULL, -1),
	(109, 51, '2018-07-19 09:02:57', 0, 1, 0, 1, NULL, NULL, -1),
	(110, 50, '2018-07-19 09:03:22', 0, 1, 0, 1, NULL, NULL, -1),
	(103, 53, '2018-07-19 20:53:39', 0, 1, 0, 1, NULL, NULL, -1),
	(104, 51, '2018-07-19 20:56:11', 0, 1, 0, 1, NULL, NULL, -1),
	(105, 50, '2018-07-19 20:58:48', 0, 1, 0, 1, NULL, NULL, -1),
	(108, 56, '2018-07-19 06:59:47', 0, 1, 0, 1, NULL, NULL, -1),
	(111, 46, '2018-07-19 09:04:45', 0, 1, 0, 1, NULL, NULL, -1),
	(117, 54, '2018-07-20 04:55:03', 0, 1, 0, 1, NULL, NULL, -1),
	(118, 54, '2018-07-20 04:55:04', 0, 1, 0, 1, NULL, NULL, -1),
	(119, 53, '2018-07-20 04:55:09', 0, 1, 0, 1, NULL, NULL, -1),
	(120, 50, '2018-07-20 04:55:16', 0, 1, 0, 1, NULL, NULL, -1),
	(121, 46, '2018-07-20 04:55:44', 0, 1, 0, 1, NULL, NULL, -1),
	(122, 56, '2018-07-20 04:55:53', 0, 1, 0, 1, NULL, NULL, -1),
	(123, 56, '2018-07-20 04:56:06', 0, 1, 0, 1, NULL, NULL, -1),
	(124, 56, '2018-07-20 04:58:09', 0, 1, 0, 1, NULL, NULL, -1),
	(125, 48, '2018-07-20 04:59:17', 0, 1, 0, 1, NULL, NULL, -1),
	(126, 56, '2018-07-20 04:59:32', 0, 1, 0, 1, NULL, NULL, -1),
	(127, 56, '2018-07-20 06:09:34', 0, 1, 0, 1, NULL, NULL, -1),
	(128, 56, '2018-07-20 06:44:03', 0, 1, 0, 1, NULL, NULL, -1),
	(129, 56, '2018-07-20 06:44:32', 0, 1, 0, 1, NULL, NULL, -1),
	(130, 56, '2018-07-20 06:46:39', 0, 1, 0, 1, NULL, NULL, -1),
	(131, 54, '2018-07-20 07:03:46', 0, 1, 0, 1, NULL, NULL, -1),
	(132, 53, '2018-07-20 08:08:17', 0, 1, 0, 1, NULL, NULL, -1),
	(133, 50, '2018-07-20 09:03:23', 0, 1, 0, 1, NULL, NULL, -1),
	(134, 55, '2018-07-20 09:04:02', 0, 1, 0, 1, NULL, NULL, -1),
	(135, 48, '2018-07-20 09:04:57', 0, 1, 0, 1, NULL, NULL, -1),
	(136, 55, '2018-07-20 20:52:18', 0, 1, 0, 1, NULL, NULL, -1),
	(137, 48, '2018-07-20 20:52:30', 0, 1, 0, 1, NULL, NULL, -1),
	(138, 53, '2018-07-20 20:57:17', 0, 1, 0, 1, NULL, NULL, -1),
	(139, 51, '2018-07-20 20:57:35', 0, 1, 0, 1, NULL, NULL, -1),
	(140, 51, '2018-07-20 20:57:36', 0, 1, 0, 1, NULL, NULL, -1),
	(141, 46, '2018-07-20 21:01:13', 0, 1, 0, 1, NULL, NULL, -1),
	(142, 46, '2018-07-20 21:01:14', 0, 1, 0, 1, NULL, NULL, -1),
	(143, 50, '2018-07-20 21:02:51', 0, 1, 0, 1, NULL, NULL, -1),
	(144, 50, '2018-07-20 21:02:52', 0, 1, 0, 1, NULL, NULL, -1),
	(145, 56, '2018-07-21 04:30:41', 0, 1, 0, 1, NULL, NULL, -1),
	(146, 53, '2018-07-21 06:32:26', 0, 1, 0, 1, NULL, NULL, -1),
	(147, 50, '2018-07-21 06:34:44', 0, 1, 0, 1, NULL, NULL, -1),
	(148, 48, '2018-07-21 06:34:59', 0, 1, 0, 1, NULL, NULL, -1),
	(149, 46, '2018-07-21 06:37:04', 0, 1, 0, 1, NULL, NULL, -1),
	(150, 46, '2018-07-21 06:37:05', 0, 1, 0, 1, NULL, NULL, -1),
	(151, 56, '2018-07-21 20:45:07', 0, 1, 0, 1, NULL, NULL, -1),
	(152, 48, '2018-07-21 20:51:26', 0, 1, 0, 1, NULL, NULL, -1),
	(153, 53, '2018-07-21 20:56:21', 0, 1, 0, 1, NULL, NULL, -1),
	(154, 55, '2018-07-21 20:58:03', 0, 1, 0, 1, NULL, NULL, -1),
	(155, 46, '2018-07-21 20:58:17', 0, 1, 0, 1, NULL, NULL, -1),
	(156, 51, '2018-07-21 20:58:29', 0, 1, 0, 1, NULL, NULL, -1),
	(157, 50, '2018-07-21 21:01:39', 0, 1, 0, 1, NULL, NULL, -1),
	(158, 56, '2018-07-22 05:40:26', 0, 1, 0, 1, NULL, NULL, -1),
	(159, 55, '2018-07-22 05:43:28', 0, 1, 0, 1, NULL, NULL, -1),
	(160, 48, '2018-07-22 05:43:38', 0, 1, 0, 1, NULL, NULL, -1),
	(161, 48, '2018-07-22 05:43:39', 0, 1, 0, 1, NULL, NULL, -1),
	(162, 54, '2018-07-22 05:43:59', 0, 1, 0, 1, NULL, NULL, -1),
	(163, 54, '2018-07-22 05:44:01', 0, 1, 0, 1, NULL, NULL, -1),
	(164, 51, '2018-07-22 05:44:22', 0, 1, 0, 1, NULL, NULL, -1),
	(165, 53, '2018-07-22 05:44:53', 0, 1, 0, 1, NULL, NULL, -1),
	(166, 50, '2018-07-22 05:45:38', 0, 1, 0, 1, NULL, NULL, -1),
	(167, 50, '2018-07-22 05:45:39', 0, 1, 0, 1, NULL, NULL, -1),
	(168, 56, '2018-07-22 05:45:41', 0, 1, 0, 1, NULL, NULL, -1),
	(169, 48, '2018-07-22 09:02:15', 0, 1, 0, 1, NULL, NULL, -1),
	(170, 50, '2018-07-22 09:02:51', 0, 1, 0, 1, NULL, NULL, -1),
	(171, 51, '2018-07-22 09:03:00', 0, 1, 0, 1, NULL, NULL, -1),
	(172, 55, '2018-07-22 09:03:37', 0, 1, 0, 1, NULL, NULL, -1),
	(173, 53, '2018-07-22 09:04:12', 0, 1, 0, 1, NULL, NULL, -1),
	(174, 48, '2018-07-22 20:53:27', 0, 1, 0, 1, NULL, NULL, -1),
	(175, 55, '2018-07-22 20:55:00', 0, 1, 0, 1, NULL, NULL, -1),
	(176, 46, '2018-07-22 20:55:19', 0, 1, 0, 1, NULL, NULL, -1),
	(177, 46, '2018-07-22 20:55:20', 0, 1, 0, 1, NULL, NULL, -1),
	(178, 54, '2018-07-22 20:55:26', 0, 1, 0, 1, NULL, NULL, -1),
	(179, 50, '2018-07-22 20:55:33', 0, 1, 0, 1, NULL, NULL, -1),
	(180, 53, '2018-07-22 20:55:52', 0, 1, 0, 1, NULL, NULL, -1),
	(181, 51, '2018-07-22 20:57:39', 0, 1, 0, 1, NULL, NULL, -1),
	(182, 56, '2018-07-23 00:18:17', 0, 1, 0, 1, NULL, NULL, -1),
	(183, 56, '2018-07-23 01:09:59', 0, 1, 0, 1, NULL, NULL, -1),
	(184, 56, '2018-07-23 01:11:31', 0, 1, 0, 1, NULL, NULL, -1),
	(185, 56, '2018-07-23 01:12:15', 0, 1, 0, 1, NULL, NULL, -1),
	(186, 56, '2018-07-23 01:17:35', 0, 1, 0, 1, NULL, NULL, -1),
	(187, 48, '2018-07-23 02:01:16', 0, 1, 0, 1, NULL, NULL, -1),
	(188, 50, '2018-07-23 02:01:23', 0, 1, 0, 1, NULL, NULL, -1),
	(189, 51, '2018-07-23 02:01:31', 0, 1, 0, 1, NULL, NULL, -1),
	(190, 46, '2018-07-23 02:01:42', 0, 1, 0, 1, NULL, NULL, -1),
	(191, 55, '2018-07-23 02:19:18', 0, 1, 0, 1, NULL, NULL, -1),
	(192, 46, '2018-07-23 06:12:28', 0, 1, 0, 1, NULL, NULL, -1),
	(193, 46, '2018-07-23 06:12:29', 0, 1, 0, 1, NULL, NULL, -1),
	(194, 55, '2018-07-23 09:02:10', 0, 1, 0, 1, NULL, NULL, -1),
	(195, 50, '2018-07-23 09:02:22', 0, 1, 0, 1, NULL, NULL, -1),
	(196, 53, '2018-07-23 09:03:55', 0, 1, 0, 1, NULL, NULL, -1),
	(197, 48, '2018-07-23 09:04:27', 0, 1, 0, 1, NULL, NULL, -1),
	(198, 56, '2018-07-23 20:42:43', 0, 1, 0, 1, NULL, NULL, -1),
	(199, 46, '2018-07-23 20:53:44', 0, 1, 0, 1, NULL, NULL, -1),
	(200, 53, '2018-07-23 20:58:13', 0, 1, 0, 1, NULL, NULL, -1),
	(201, 48, '2018-07-23 20:58:49', 0, 1, 0, 1, NULL, NULL, -1),
	(202, 50, '2018-07-23 21:02:25', 0, 1, 0, 1, NULL, NULL, -1),
	(203, 51, '2018-07-23 21:08:50', 0, 1, 0, 1, NULL, NULL, -1),
	(204, 56, '2018-07-25 01:35:25', 0, 1, 0, 1, NULL, NULL, -1),
	(205, 56, '2018-07-25 01:36:46', 0, 1, 0, 1, NULL, NULL, -1),
	(206, 46, '2018-07-25 06:01:40', 0, 1, 0, 1, NULL, NULL, -1),
	(207, 46, '2018-07-25 06:01:42', 0, 1, 0, 1, NULL, NULL, -1),
	(208, 55, '2018-07-25 06:02:39', 0, 1, 0, 1, NULL, NULL, -1),
	(209, 51, '2018-07-25 06:04:18', 0, 1, 0, 1, NULL, NULL, -1),
	(210, 53, '2018-07-25 06:04:34', 0, 1, 0, 1, NULL, NULL, -1),
	(211, 48, '2018-07-25 09:02:18', 0, 1, 0, 1, NULL, NULL, -1),
	(212, 50, '2018-07-25 09:05:14', 0, 1, 0, 1, NULL, NULL, -1),
	(213, 46, '2018-07-25 20:52:48', 0, 1, 0, 1, NULL, NULL, -1),
	(214, 53, '2018-07-25 20:55:58', 0, 1, 0, 1, NULL, NULL, -1),
	(215, 48, '2018-07-25 20:58:04', 0, 1, 0, 1, NULL, NULL, -1),
	(216, 48, '2018-07-25 20:58:06', 0, 1, 0, 1, NULL, NULL, -1),
	(217, 50, '2018-07-25 21:03:00', 0, 1, 0, 1, NULL, NULL, -1),
	(218, 56, '2018-07-26 06:07:00', 0, 1, 0, 1, NULL, NULL, -1),
	(219, 46, '2018-07-26 09:02:11', 0, 1, 0, 1, NULL, NULL, -1),
	(220, 46, '2018-07-26 09:02:12', 0, 1, 0, 1, NULL, NULL, -1),
	(221, 51, '2018-07-26 09:02:24', 0, 1, 0, 1, NULL, NULL, -1),
	(222, 56, '2018-07-26 09:08:25', 0, 1, 0, 1, NULL, NULL, -1),
	(223, 48, '2018-07-26 10:01:57', 0, 1, 0, 1, NULL, NULL, -1),
	(224, 53, '2018-07-26 10:04:12', 0, 1, 0, 1, NULL, NULL, -1),
	(225, 55, '2018-07-26 11:01:39', 0, 1, 0, 1, NULL, NULL, -1),
	(226, 50, '2018-07-26 11:02:09', 0, 1, 0, 1, NULL, NULL, -1),
	(227, 50, '2018-07-26 20:54:15', 0, 1, 0, 1, NULL, NULL, -1),
	(228, 53, '2018-07-26 20:55:26', 0, 1, 0, 1, NULL, NULL, -1),
	(229, 48, '2018-07-26 20:55:35', 0, 1, 0, 1, NULL, NULL, -1),
	(230, 46, '2018-07-26 20:56:06', 0, 1, 0, 1, NULL, NULL, -1),
	(231, 51, '2018-07-26 21:00:47', 0, 1, 0, 1, NULL, NULL, -1),
	(232, 56, '2018-07-27 09:03:09', 0, 1, 0, 1, NULL, NULL, -1),
	(233, 51, '2018-07-27 09:04:04', 0, 1, 0, 1, NULL, NULL, -1),
	(234, 48, '2018-07-27 10:01:41', 0, 1, 0, 1, NULL, NULL, -1),
	(235, 46, '2018-07-27 10:03:25', 0, 1, 0, 1, NULL, NULL, -1),
	(236, 50, '2018-07-27 10:03:34', 0, 1, 0, 1, NULL, NULL, -1),
	(237, 55, '2018-07-27 10:03:52', 0, 1, 0, 1, NULL, NULL, -1),
	(238, 46, '2018-07-27 20:55:20', 0, 1, 0, 1, NULL, NULL, -1),
	(239, 55, '2018-07-27 20:55:55', 0, 1, 0, 1, NULL, NULL, -1),
	(240, 51, '2018-07-27 20:57:10', 0, 1, 0, 1, NULL, NULL, -1),
	(241, 53, '2018-07-27 20:58:52', 0, 1, 0, 1, NULL, NULL, -1),
	(242, 50, '2018-07-27 20:59:51', 0, 1, 0, 1, NULL, NULL, -1),
	(243, 48, '2018-07-27 21:00:30', 0, 1, 0, 1, NULL, NULL, -1),
	(244, 51, '2018-07-28 06:34:19', 0, 1, 0, 1, NULL, NULL, -1),
	(245, 55, '2018-07-28 06:34:25', 0, 1, 0, 1, NULL, NULL, -1),
	(246, 50, '2018-07-28 06:34:32', 0, 1, 0, 1, NULL, NULL, -1),
	(247, 46, '2018-07-28 06:34:58', 0, 1, 0, 1, NULL, NULL, -1),
	(248, 48, '2018-07-28 06:35:40', 0, 1, 0, 1, NULL, NULL, -1),
	(249, 53, '2018-07-28 06:35:57', 0, 1, 0, 1, NULL, NULL, -1),
	(250, 55, '2018-07-28 20:48:24', 0, 1, 0, 1, NULL, NULL, -1),
	(251, 48, '2018-07-28 20:55:13', 0, 1, 0, 1, NULL, NULL, -1),
	(252, 46, '2018-07-28 20:56:57', 0, 1, 0, 1, NULL, NULL, -1),
	(253, 50, '2018-07-28 20:59:02', 0, 1, 0, 1, NULL, NULL, -1),
	(254, 51, '2018-07-28 20:59:56', 0, 1, 0, 1, NULL, NULL, -1),
	(255, 46, '2018-07-29 09:02:22', 0, 1, 0, 1, NULL, NULL, -1),
	(256, 46, '2018-07-29 09:02:23', 0, 1, 0, 1, NULL, NULL, -1),
	(257, 48, '2018-07-29 09:03:42', 0, 1, 0, 1, NULL, NULL, -1),
	(258, 55, '2018-07-29 10:04:13', 0, 1, 0, 1, NULL, NULL, -1),
	(259, 53, '2018-07-29 10:04:19', 0, 1, 0, 1, NULL, NULL, -1),
	(260, 51, '2018-07-29 11:02:44', 0, 1, 0, 1, NULL, NULL, -1),
	(261, 50, '2018-07-29 11:02:55', 0, 1, 0, 1, NULL, NULL, -1),
	(262, 56, '2018-07-29 20:51:23', 0, 1, 0, 1, NULL, NULL, -1),
	(263, 55, '2018-07-29 20:51:27', 0, 1, 0, 1, NULL, NULL, -1),
	(264, 48, '2018-07-29 20:54:39', 0, 1, 0, 1, NULL, NULL, -1),
	(265, 46, '2018-07-29 20:56:56', 0, 1, 0, 1, NULL, NULL, -1),
	(266, 46, '2018-07-29 20:57:00', 0, 1, 0, 1, NULL, NULL, -1),
	(267, 53, '2018-07-29 20:57:18', 0, 1, 0, 1, NULL, NULL, -1),
	(268, 51, '2018-07-29 21:00:44', 0, 1, 0, 1, NULL, NULL, -1),
	(269, 48, '2018-07-30 09:01:06', 0, 1, 0, 1, NULL, NULL, -1),
	(270, 51, '2018-07-30 10:01:46', 0, 1, 0, 1, NULL, NULL, -1),
	(271, 46, '2018-07-30 10:02:02', 0, 1, 0, 1, NULL, NULL, -1),
	(272, 53, '2018-07-30 10:04:51', 0, 1, 0, 1, NULL, NULL, -1),
	(273, 50, '2018-07-30 11:02:38', 0, 1, 0, 1, NULL, NULL, -1),
	(274, 55, '2018-07-30 11:02:42', 0, 1, 0, 1, NULL, NULL, -1),
	(275, 53, '2018-07-30 20:53:29', 0, 1, 0, 1, NULL, NULL, -1),
	(276, 55, '2018-07-30 20:54:07', 0, 1, 0, 1, NULL, NULL, -1),
	(277, 48, '2018-07-30 20:54:23', 0, 1, 0, 1, NULL, NULL, -1),
	(278, 51, '2018-07-30 20:57:11', 0, 1, 0, 1, NULL, NULL, -1),
	(279, 50, '2018-07-30 20:58:31', 0, 1, 0, 1, NULL, NULL, -1),
	(280, 46, '2018-07-30 21:00:35', 0, 1, 0, 1, NULL, NULL, -1),
	(281, 53, '2018-08-01 10:01:14', 0, 1, 0, 1, NULL, NULL, -1),
	(282, 55, '2018-08-01 20:42:53', 0, 1, 0, 1, NULL, NULL, -1),
	(283, 56, '2018-08-01 20:43:01', 0, 1, 0, 1, NULL, NULL, -1),
	(284, 48, '2018-08-01 20:53:03', 0, 1, 0, 1, NULL, NULL, -1),
	(285, 50, '2018-08-01 20:54:57', 0, 1, 0, 1, NULL, NULL, -1),
	(286, 46, '2018-08-01 20:55:35', 0, 1, 0, 1, NULL, NULL, -1),
	(287, 51, '2018-08-01 20:58:43', 0, 1, 0, 1, NULL, NULL, -1);
/*!40000 ALTER TABLE `checkinout` ENABLE KEYS */;

-- Dumping structure for table mbmerp.fin_asset
DROP TABLE IF EXISTS `fin_asset`;
CREATE TABLE IF NOT EXISTS `fin_asset` (
  `fin_asset_id` int(11) NOT NULL AUTO_INCREMENT,
  `fin_asset_product_id` int(11) NOT NULL,
  `fin_asset_serial` varchar(128) NOT NULL,
  PRIMARY KEY (`fin_asset_id`),
  KEY `FK_fin_asset_fin_asset_product` (`fin_asset_product_id`),
  CONSTRAINT `FK_fin_asset_fin_asset_product` FOREIGN KEY (`fin_asset_product_id`) REFERENCES `fin_asset_product` (`fin_asset_product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.fin_asset: ~0 rows (approximately)
DELETE FROM `fin_asset`;
/*!40000 ALTER TABLE `fin_asset` DISABLE KEYS */;
/*!40000 ALTER TABLE `fin_asset` ENABLE KEYS */;

-- Dumping structure for table mbmerp.fin_asset_category
DROP TABLE IF EXISTS `fin_asset_category`;
CREATE TABLE IF NOT EXISTS `fin_asset_category` (
  `fin_asset_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `fin_asset_cat_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fin_asset_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.fin_asset_category: ~0 rows (approximately)
DELETE FROM `fin_asset_category`;
/*!40000 ALTER TABLE `fin_asset_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `fin_asset_category` ENABLE KEYS */;

-- Dumping structure for table mbmerp.fin_asset_product
DROP TABLE IF EXISTS `fin_asset_product`;
CREATE TABLE IF NOT EXISTS `fin_asset_product` (
  `fin_asset_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `fin_asset_product_cat_id` int(11) NOT NULL,
  `fin_asset_product_name` varchar(128) NOT NULL,
  PRIMARY KEY (`fin_asset_product_id`),
  KEY `FK_fin_asset_product_fin_asset_category` (`fin_asset_product_cat_id`),
  CONSTRAINT `FK_fin_asset_product_fin_asset_category` FOREIGN KEY (`fin_asset_product_cat_id`) REFERENCES `fin_asset_category` (`fin_asset_cat_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.fin_asset_product: ~0 rows (approximately)
DELETE FROM `fin_asset_product`;
/*!40000 ALTER TABLE `fin_asset_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `fin_asset_product` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_area
DROP TABLE IF EXISTS `hr_area`;
CREATE TABLE IF NOT EXISTS `hr_area` (
  `hr_area_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_area_name` varchar(128) DEFAULT NULL,
  `hr_area_name_bn` varchar(255) DEFAULT NULL,
  `hr_area_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hr_area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_area: ~4 rows (approximately)
DELETE FROM `hr_area`;
/*!40000 ALTER TABLE `hr_area` DISABLE KEYS */;
INSERT INTO `hr_area` (`hr_area_id`, `hr_area_name`, `hr_area_name_bn`, `hr_area_status`) VALUES
	(1, 'Office', 'অফিস', 1),
	(2, 'Factory', 'ফ্যাক্টরি', 1),
	(3, 'G. Utilities', NULL, 1),
	(4, 'Washing', 'ওয়াশিং', 1);
/*!40000 ALTER TABLE `hr_area` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_asset_assign
DROP TABLE IF EXISTS `hr_asset_assign`;
CREATE TABLE IF NOT EXISTS `hr_asset_assign` (
  `hr_asset_assign_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_associate_id` varchar(10) NOT NULL,
  `hr_fin_asset_id` int(11) NOT NULL,
  `hr_asset_assign_date` date NOT NULL,
  `hr_asset_return_date` date DEFAULT NULL,
  `hr_asset_created_by` int(11) DEFAULT NULL,
  `hr_asset_created_at` date DEFAULT NULL,
  `hr_asset_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-assign, 1-return',
  PRIMARY KEY (`hr_asset_assign_id`),
  KEY `FK_hr_asset_assign_fin_asset` (`hr_fin_asset_id`),
  CONSTRAINT `FK_hr_asset_assign_fin_asset` FOREIGN KEY (`hr_fin_asset_id`) REFERENCES `fin_asset` (`fin_asset_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_asset_assign: ~0 rows (approximately)
DELETE FROM `hr_asset_assign`;
/*!40000 ALTER TABLE `hr_asset_assign` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_asset_assign` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_associate_status_tracker
DROP TABLE IF EXISTS `hr_associate_status_tracker`;
CREATE TABLE IF NOT EXISTS `hr_associate_status_tracker` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_as_id` varchar(10) NOT NULL,
  `status_type` int(1) NOT NULL,
  `status_date` date NOT NULL,
  `status_suspend_start` date DEFAULT NULL,
  `status_suspend_end` date DEFAULT NULL,
  `status_reason` varchar(255) DEFAULT NULL,
  `status_created_date` date NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_associate_status_tracker: ~0 rows (approximately)
DELETE FROM `hr_associate_status_tracker`;
/*!40000 ALTER TABLE `hr_associate_status_tracker` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_associate_status_tracker` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_as_adv_info
DROP TABLE IF EXISTS `hr_as_adv_info`;
CREATE TABLE IF NOT EXISTS `hr_as_adv_info` (
  `emp_adv_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_adv_info_as_id` varchar(10) NOT NULL,
  `emp_adv_info_stat` tinyint(1) DEFAULT NULL COMMENT '1= Parmanent, 0=probationary',
  `emp_adv_info_prob_period` int(11) DEFAULT NULL,
  `emp_adv_info_nationality` varchar(50) DEFAULT NULL,
  `emp_adv_info_birth_cer` varchar(255) DEFAULT NULL,
  `emp_adv_info_city_corp_cer` varchar(255) DEFAULT NULL,
  `emp_adv_info_police_veri` varchar(255) DEFAULT NULL,
  `emp_adv_info_passport` varchar(64) DEFAULT NULL,
  `emp_adv_info_refer_name` varchar(64) DEFAULT NULL,
  `emp_adv_info_refer_contact` varchar(255) DEFAULT NULL,
  `emp_adv_info_biodata` varchar(255) DEFAULT NULL,
  `emp_adv_info_fathers_name` varchar(64) DEFAULT NULL,
  `emp_adv_info_mothers_name` varchar(64) DEFAULT NULL,
  `emp_adv_info_marital_stat` varchar(32) DEFAULT NULL,
  `emp_adv_info_spouse` varchar(64) DEFAULT NULL,
  `emp_adv_info_children` varchar(20) DEFAULT NULL,
  `emp_adv_info_religion` varchar(64) DEFAULT NULL,
  `emp_adv_info_pre_org` varchar(255) DEFAULT NULL,
  `emp_adv_info_work_exp` int(2) DEFAULT NULL,
  `emp_adv_info_per_vill` varchar(255) DEFAULT NULL,
  `emp_adv_info_per_po` varchar(64) DEFAULT NULL,
  `emp_adv_info_per_dist` varchar(64) DEFAULT NULL,
  `emp_adv_info_per_upz` varchar(64) DEFAULT NULL,
  `emp_adv_info_pres_house_no` varchar(128) DEFAULT NULL,
  `emp_adv_info_pres_road` varchar(128) DEFAULT NULL,
  `emp_adv_info_pres_po` varchar(64) DEFAULT NULL,
  `emp_adv_info_pres_dist` varchar(64) DEFAULT NULL,
  `emp_adv_info_pres_upz` varchar(64) DEFAULT NULL,
  `emp_adv_info_nid` varchar(20) DEFAULT NULL,
  `emp_adv_info_job_app` varchar(255) DEFAULT NULL,
  `emp_adv_info_cv` varchar(255) DEFAULT NULL,
  `emp_adv_info_emg_con_name` varchar(64) DEFAULT NULL,
  `emp_adv_info_emg_con_num` varchar(64) DEFAULT NULL,
  `emp_adv_info_bank_name` varchar(128) DEFAULT NULL,
  `emp_adv_info_bank_num` varchar(20) DEFAULT NULL,
  `emp_adv_info_tin` varchar(20) DEFAULT NULL,
  `emp_adv_info_finger_print` varchar(255) DEFAULT NULL,
  `emp_adv_info_signature` varchar(255) DEFAULT NULL,
  `emp_adv_info_auth_sig` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`emp_adv_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_as_adv_info: ~74 rows (approximately)
DELETE FROM `hr_as_adv_info`;
/*!40000 ALTER TABLE `hr_as_adv_info` DISABLE KEYS */;
INSERT INTO `hr_as_adv_info` (`emp_adv_info_id`, `emp_adv_info_as_id`, `emp_adv_info_stat`, `emp_adv_info_prob_period`, `emp_adv_info_nationality`, `emp_adv_info_birth_cer`, `emp_adv_info_city_corp_cer`, `emp_adv_info_police_veri`, `emp_adv_info_passport`, `emp_adv_info_refer_name`, `emp_adv_info_refer_contact`, `emp_adv_info_biodata`, `emp_adv_info_fathers_name`, `emp_adv_info_mothers_name`, `emp_adv_info_marital_stat`, `emp_adv_info_spouse`, `emp_adv_info_children`, `emp_adv_info_religion`, `emp_adv_info_pre_org`, `emp_adv_info_work_exp`, `emp_adv_info_per_vill`, `emp_adv_info_per_po`, `emp_adv_info_per_dist`, `emp_adv_info_per_upz`, `emp_adv_info_pres_house_no`, `emp_adv_info_pres_road`, `emp_adv_info_pres_po`, `emp_adv_info_pres_dist`, `emp_adv_info_pres_upz`, `emp_adv_info_nid`, `emp_adv_info_job_app`, `emp_adv_info_cv`, `emp_adv_info_emg_con_name`, `emp_adv_info_emg_con_num`, `emp_adv_info_bank_name`, `emp_adv_info_bank_num`, `emp_adv_info_tin`, `emp_adv_info_finger_print`, `emp_adv_info_signature`, `emp_adv_info_auth_sig`) VALUES
	(17, '17F005001B', 1, NULL, NULL, NULL, NULL, NULL, '123456789', 'xyz', '123456789', NULL, 'xyz', 'xyz', 'Married', 'xyz', '1', 'Islam', 'xyz', 3, 'Kalabagan', 'Kalabagan', '1', '507', '31', '1st Lane', 'Kalabagan', '1', '507', '123456789', '/assets/files/advinfo/5b4d7a74d518e.png', '/assets/files/advinfo/5b4d7a74d5351.png', 'Mati', '0148965412', 'Tikash', '1234567889', '978456', NULL, NULL, NULL),
	(21, '18A100001N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3313054711295', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, '18A100002N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19974218481003310', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, '18A100003N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2617278997043', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, '18A100004N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3313054714257', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(25, '18A100005N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7228309248354', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(26, '18A100006N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26911649126232', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(27, '18A100007N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3313023000567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(28, '18A100008N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(29, '18A100009N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19951018838018239', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(30, '18A100010N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3313054073105', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(31, '18G100011N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(32, '18G100012N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Anayet Ullah', 'Asraber Nesa', 'Unmarried', NULL, NULL, 'Islam', NULL, NULL, 'Udmara', 'Udmara', '48', '122', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(33, '18M100013N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(34, '18G100014N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Noab ali', 'Rubi Akter', 'Unmarried', NULL, NULL, 'Islam', NULL, NULL, 'Mirer Gau', 'Kaultiya', '3', '154', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(35, '18G100015N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(36, '18A100016N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(37, '18A100017N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(38, '18C100018N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(39, '18A100019N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(40, '18A100020N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(41, '18A100021N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(42, '18A100022N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(43, '18C100023N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(44, '18G100024N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(45, '18A100025N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(46, '18C100026N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(47, '18B100027N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(48, '18C100028N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(49, '18A100029N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(50, '18B100030N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(51, '17K100031N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(52, '18C100032N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(53, '18B100033N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(54, '18B100034N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(55, '18C100035N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(56, '18D100036N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(57, '18A100037N', 1, NULL, NULL, NULL, NULL, NULL, '0000', 'Nazmul', '01918788060', NULL, 'Abdul Hamid', 'Saleha Khatun', 'Married', 'Sakil Hasan', NULL, 'Islam', 'Cutting Edge Industry Limited', NULL, 'Bil Nothar', 'Alangi', '18', '326', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(58, '18G100038N', 1, NULL, NULL, NULL, NULL, NULL, '00000', 'Rashed', '01671772420', NULL, 'Md. Lal Mia', NULL, 'Married', 'Faruk Islam', NULL, 'Islam', NULL, NULL, 'Moddho Konchipara', 'Vhobaaniganj', '27', '403', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(59, '18A100039N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Asab Uddin', 'Bilkiis', 'Married', NULL, NULL, 'Islam', NULL, NULL, 'Khalkhara', 'Ramdi', '6', '181', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(60, '18A100040N', 1, NULL, NULL, NULL, NULL, NULL, '0000', 'Nazmul', '01918788060', NULL, 'Afsar Ali', 'Fullesa', 'Married', 'Joynal Abedin', NULL, 'Islam', 'Cutting Edge Industry Limited', 2, 'Dokxin Gamariya', 'Khorma', '5', '165', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, 'Rashed', '01712863488', NULL, NULL, NULL, NULL, NULL, NULL),
	(61, '18C100041N', 1, NULL, NULL, NULL, NULL, NULL, '0000', 'Nazmul', '01918788060', NULL, 'Mannan', 'Shundori', 'Married', 'Alom', NULL, 'Islam', NULL, NULL, 'Tek Kathora', 'Salna Bazar', '3', '154', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, 'Rashed', '01712863488', NULL, NULL, NULL, NULL, NULL, NULL),
	(62, '18G100042N', 1, NULL, NULL, NULL, NULL, NULL, '00000', 'Nazmul', '01918788060', NULL, 'Rohiduzzaman', 'Somina Begum', 'Married', 'Nur Hossain', NULL, 'Islam', NULL, NULL, 'Modoner Chor', 'Bahadur bad', '5', '165', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, 'Rashed', '01712863488', 'Duch Bangla Bank', '000', '0', NULL, NULL, NULL),
	(63, '18G100043N', 1, NULL, NULL, NULL, NULL, NULL, '00000', 'Nazmul', '01918788060', NULL, 'Nannu Miazi', 'Lovely', 'Married', 'Ershad', NULL, 'Islam', NULL, NULL, 'Uttor Gazipur', 'Uttor Gazipur', '42', '65', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(64, '18D100044N', 1, NULL, NULL, NULL, NULL, NULL, '0000', 'Nazmul', '01918788060', NULL, 'Afaz Uddin', 'Amena', 'Married', 'Salam', NULL, 'Islam', NULL, NULL, 'Tek Kathora', 'Salna Bazar', '3', '154', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(65, '18B100045N', 1, NULL, NULL, NULL, NULL, NULL, '0000', 'Rashed', '01671772420', NULL, 'Sentu Mia', 'Halima', 'Unmarried', NULL, NULL, 'Islam', NULL, NULL, 'Biprobortha', 'Biprobortha', '3', '154', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, '01712863488', '01712863488', NULL, NULL, NULL, NULL, NULL, NULL),
	(66, '18C100046N', 1, NULL, NULL, NULL, NULL, NULL, '00000', 'Nazmul', '01918788060', NULL, 'Miar Uddin', 'Rahima', 'Unmarried', NULL, NULL, 'Islam', 'Cutting Edge Industry Limited', 3, 'Salna', 'Salna Bazar', '3', '154', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, 'Rashed', '01712863488', 'Duch Bangla Bank', '000000000000', '00', NULL, NULL, NULL),
	(67, '18D100047N', 1, NULL, NULL, NULL, NULL, NULL, '0000', 'Nazmul', '01918788060', NULL, 'Jonab Ali', 'Jamina Khatun', 'Married', 'Akikul Islam', NULL, 'Islam', 'Cutting Edge Industry Limited', 3, 'Koyra Hati', 'Dhara', '10', '205', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, 'Rashed', '01712863488', 'Duch Bangla Bank', '000000000000', '00000000', NULL, NULL, NULL),
	(68, '18B100048N', 1, NULL, NULL, NULL, NULL, NULL, '0000', 'Nazmul', '01918788060', NULL, 'Surujj Mia', 'Happy', 'Unmarried', NULL, NULL, 'Islam', NULL, 2, 'Bondor Chorpara', 'Hadira Bazar', '17', '264', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, '01712863488', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(69, '18B100049N', 1, NULL, NULL, NULL, NULL, NULL, '0000', 'Nazmul', '01918788060', NULL, 'Jan Ali', 'Shomola Khatun', 'Married', 'Anowar', NULL, 'Islam', NULL, NULL, 'Gilarchal', 'Gilaberayed', '3', '157', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(70, '18C100050N', 1, NULL, NULL, NULL, NULL, NULL, '0000', 'Rashed', '01671772420', NULL, 'Abul Hossain', 'Afia', 'Married', 'Abu Sayeed', NULL, 'Islam', NULL, 2, 'Horichondi', 'Horichondi', '25', '381', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, '01712863488', NULL, '0000', '0000', '000', NULL, NULL, NULL),
	(71, '18C100051N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Abdul Khalek', 'Rohima Begum', 'Married', NULL, NULL, 'Islam', NULL, NULL, 'Pagla Char', 'Arenda Bari', '27', '403', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(72, '18G100052N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Abdul Kashem', 'Morsheda Khatun', 'Unmarried', NULL, NULL, 'Islam', NULL, NULL, 'Salna', 'Salna Bazar', '3', '154', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(73, '18B100053N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Abdul Mozid', 'Rehana', 'Married', 'Haider Ali', NULL, 'Islam', NULL, NULL, 'Tal Janga', 'Tal Janga', '6', '180', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(74, '18C100054N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Md. Motaleb', 'Momotaz', 'Unmarried', NULL, NULL, 'Islam', NULL, NULL, 'Porabari', 'Gopalpur', '17', '261', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(75, '18D100055N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Mokbul', 'Anjuara', 'Married', 'Saidul', NULL, 'Islam', NULL, NULL, 'Kushmail', 'Fulbaria', '10', '208', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(76, '18A100056N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Abdul Hai Hawlader', 'Halima Begum', 'Married', 'Ismail Hossain', NULL, 'Islam', NULL, NULL, 'Hawlader Kandhi', 'D.M. Khali', '15', '242', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(77, '18C100057N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Ahammod Ali', 'Aador Jaan', 'Married', 'Bacchu Mia', NULL, 'Islam', NULL, NULL, 'Biprobortha', 'Kaultiya', '3', '154', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(78, '18G100058N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Maien Uddin', 'Laily Akter', 'Married', NULL, NULL, 'Islam', NULL, NULL, 'Parulitola', 'Chariya Bazar', '10', '214', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(79, '18C100059N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Mujar Hossain', 'Fulmoti', 'Married', 'Alamgir', NULL, 'Islam', NULL, NULL, 'Tek Kathora', 'Salna Bazar', '3', '154', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(80, '18E100060N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Rajob Ali', 'Rashida Khatun', 'Married', 'Jahangir Alom', NULL, 'Islam', NULL, NULL, 'Paika Shimla', 'Muktagacha', '10', '206', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(81, '18C100061N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Abbash Ali', 'Dulena Akter', 'Married', 'Abdul Sattar', NULL, 'Islam', NULL, NULL, 'Soitra', 'Hilchiya', '6', '183', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(82, '18B100062N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Shahadot Hossain', 'Rahela Khatun', 'Married', 'Rakibul Hasan', NULL, 'Islam', NULL, NULL, 'Kola Bariya', 'Shonapur Bazar', '21', '354', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(83, '18D100063N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Abdul Karim', 'Nazma Begum', 'Married', 'Parvez', NULL, 'Islam', NULL, NULL, 'Telipara', 'Rakhar Para', '5', '170', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(84, '18C100064N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Bellal', 'Hasna', 'Married', NULL, NULL, 'Islam', NULL, NULL, 'Shar Polashiya', 'Nikrail', '17', '263', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(85, '18B100065N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Harunar Rashid', 'Kolpona Begum', 'Married', 'Kazi Emon', NULL, 'Islam', NULL, NULL, 'Konail', 'Mukundiya', '14', '241', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(86, '18G100066N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Abul Bashar Sharder', 'Nilufa', 'Unmarried', NULL, NULL, 'Islam', NULL, NULL, 'Satiyani', 'Konesshor', '15', '243', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(87, '18A100067N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Abdul Owahab', 'Khadiza Akter', 'Married', 'Sajol', NULL, 'Islam', NULL, NULL, 'Tek Kathora', 'Salna Bazar', '3', '154', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(88, '18C100068N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Abdur Razzak', 'Jobeda', 'Married', 'Faruk Ahammed', NULL, 'Islam', NULL, NULL, 'Sadupara', 'Sadupara', '10', '214', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(89, '18D100069N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Yousuf', 'Momota', 'Unmarried', NULL, NULL, 'Islam', NULL, NULL, 'Poschim Doripara', 'Chor Sherpur', '16', '251', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(90, '18G100070N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Jobed Ali', 'Shubuja', 'Married', 'Yakub Ali', NULL, 'Islam', NULL, NULL, 'Gopin Nagar', 'Munshir Hat', '10', '205', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(91, '18A100071N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Aftar Mollah', 'Moriom', 'Married', 'Yousuf Hawlader', NULL, 'Islam', NULL, NULL, 'Salna', 'Salna Bazar', '3', '154', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(92, '18A100072N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Sohrab Uddin', 'Obiron Nesa', 'Unmarried', NULL, NULL, 'Islam', NULL, NULL, 'New Jummapara', 'Rangpur sadar', '32', '439', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(93, '18A100073N', 1, NULL, NULL, NULL, NULL, NULL, '0000', NULL, NULL, NULL, 'Nurul Amin Bepary', 'Parul', 'Married', 'Uzzol', NULL, 'Islam', NULL, NULL, 'Salna', 'Salna Bazar', '3', '154', 'Salna', NULL, 'Salna Bazar', '3', '154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `hr_as_adv_info` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_as_basic_info
DROP TABLE IF EXISTS `hr_as_basic_info`;
CREATE TABLE IF NOT EXISTS `hr_as_basic_info` (
  `as_id` int(11) NOT NULL AUTO_INCREMENT,
  `as_emp_type_id` int(11) DEFAULT NULL,
  `as_designation_id` int(11) NOT NULL,
  `as_unit_id` varchar(11) DEFAULT NULL,
  `as_floor_id` varchar(11) DEFAULT NULL,
  `as_line_id` varchar(11) DEFAULT NULL,
  `as_shift_id` varchar(11) DEFAULT NULL,
  `as_area_id` int(11) NOT NULL,
  `as_department_id` int(11) NOT NULL,
  `as_section_id` int(11) DEFAULT NULL,
  `as_subsection_id` int(11) DEFAULT NULL,
  `as_doj` date NOT NULL,
  `associate_id` varchar(10) NOT NULL,
  `temp_id` varchar(6) NOT NULL,
  `as_name` varchar(64) NOT NULL,
  `as_gender` varchar(10) NOT NULL,
  `as_dob` date NOT NULL,
  `as_contact` varchar(20) NOT NULL,
  `as_ot` varchar(10) NOT NULL,
  `as_pic` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `as_status` tinyint(1) DEFAULT '1' COMMENT '0-delete, 1-active, 2-resign, 3-terminate, 4-suspend',
  PRIMARY KEY (`as_id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_as_basic_info: ~74 rows (approximately)
DELETE FROM `hr_as_basic_info`;
/*!40000 ALTER TABLE `hr_as_basic_info` DISABLE KEYS */;
INSERT INTO `hr_as_basic_info` (`as_id`, `as_emp_type_id`, `as_designation_id`, `as_unit_id`, `as_floor_id`, `as_line_id`, `as_shift_id`, `as_area_id`, `as_department_id`, `as_section_id`, `as_subsection_id`, `as_doj`, `associate_id`, `temp_id`, `as_name`, `as_gender`, `as_dob`, `as_contact`, `as_ot`, `as_pic`, `created_at`, `created_by`, `as_status`) VALUES
	(42, 1, 25, '4', NULL, NULL, '', 1, 19, 20, 19, '2017-06-17', '17F005001B', '005001', 'MBM IT', 'Male', '1994-02-21', '01789654123', '0', NULL, '2018-07-17 05:08:15', '1', 1),
	(46, 3, 37, '3', '21', '25', '', 2, 25, 21, 21, '2018-01-01', '18A100001N', '100001', 'SAHERA KHATUN', 'Female', '1978-02-05', '01688824633', '1', '/assets/images/employee/5b4eee49bf4bc.jpg', '2018-07-18 07:33:51', '8', 1),
	(47, 3, 37, '3', '21', '25', NULL, 2, 25, 21, 21, '2018-01-01', '18A100002N', '100002', 'RUBEL KHAN', 'Male', '1997-05-03', '01688824633', '1', NULL, '2018-07-18 07:56:26', '8', 1),
	(48, 3, 37, '3', '21', '25', NULL, 2, 25, 21, 21, '2018-01-01', '18A100003N', '100003', 'LAILY KHATUN', 'Female', '1985-07-20', '01688824633', '1', NULL, '2018-07-18 08:05:33', '8', 1),
	(49, 3, 37, '3', '21', '25', NULL, 2, 25, 21, 21, '2018-01-01', '18A100004N', '100004', 'SABINA AKTER', 'Female', '1986-12-13', '01688824633', '1', NULL, '2018-07-18 08:05:37', '8', 1),
	(50, 3, 37, '3', '21', '25', NULL, 2, 25, 21, 21, '2018-01-01', '18A100005N', '100005', 'ROUSHONARA', 'Female', '1982-08-25', '01688824633', '1', NULL, '2018-07-18 08:05:42', '8', 1),
	(51, 3, 37, '3', '21', '26', NULL, 2, 25, 21, 21, '2018-01-01', '18A100006N', '100006', 'PARVIN AKTER', 'Female', '1986-05-05', '01688824633', '1', NULL, '2018-07-18 09:34:09', '8', 1),
	(52, 3, 37, '3', '21', '26', NULL, 2, 25, 21, 21, '2018-01-01', '18A100007N', '100007', 'SHABANA', 'Female', '1987-08-17', '01688824633', '1', NULL, '2018-07-18 09:34:14', '8', 1),
	(53, 3, 37, '3', '21', '26', NULL, 2, 25, 21, 21, '2018-01-01', '18A100008N', '100008', 'MST. AKLIMA BEGUM', 'Female', '1982-03-04', '01688824633', '1', NULL, '2018-07-18 09:34:19', '8', 1),
	(54, 3, 37, '3', '21', '26', NULL, 2, 25, 21, 21, '2018-01-01', '18A100009N', '100009', 'MST. HAMIDA AKTER', 'Female', '1995-01-25', '01688824633', '1', NULL, '2018-07-18 09:34:26', '8', 1),
	(55, 3, 37, '3', '21', '26', NULL, 2, 25, 21, 21, '2018-01-01', '18A100010N', '100010', 'MST. SURMA', 'Female', '1989-01-01', '01688824633', '1', NULL, '2018-07-18 09:34:34', '8', 1),
	(56, 1, 28, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-07-18', '18G100011N', '100011', 'RASHED KHAN', 'Male', '1989-11-16', '01712863488', '0', NULL, '2018-07-18 09:43:42', '8', 1),
	(57, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-07-01', '18G100012N', '100012', 'MORIOM', 'Female', '1999-08-25', '01712863488', '1', NULL, '2018-07-27 05:06:20', '9', 1),
	(58, 1, 28, '3', NULL, NULL, NULL, 2, 25, NULL, NULL, '2018-12-13', '18M100013N', '100013', 'MD. NAZMUL HOSSAIN', 'Male', '1992-07-26', '01918788060', '0', NULL, '2018-07-27 05:06:31', '9', 1),
	(59, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-07-08', '18G100014N', '100014', 'RUNA AKTER', 'Female', '1999-03-12', '01712863488', '1', NULL, '2018-07-27 06:16:59', '9', 1),
	(60, 3, 37, '3', NULL, NULL, NULL, 2, 25, NULL, NULL, '2018-07-09', '18G100015N', '100015', 'RITA AKTER', 'Female', '1995-01-01', '01712863488', '1', NULL, '2018-07-27 06:31:29', '9', 1),
	(61, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-10', '18A100016N', '100016', 'LABONI AKTER', 'Female', '1997-09-25', '01712863488', '0', NULL, '2018-07-28 04:34:59', '9', 1),
	(62, 3, 36, '3', NULL, NULL, NULL, 2, 25, NULL, NULL, '2018-01-15', '18A100017N', '100017', 'MST. SHOPNA PARVIN', 'Female', '1993-08-23', '01712863488', '1', NULL, '2018-07-28 04:45:41', '9', 1),
	(63, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-03-01', '18C100018N', '100018', 'MONIR', 'Male', '1983-02-01', '01712863488', '1', NULL, '2018-07-28 04:57:17', '9', 1),
	(64, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-10', '18A100019N', '100019', 'AMENA BEGUM', 'Female', '1985-04-10', '01712863488', '1', NULL, '2018-07-28 05:05:09', '9', 1),
	(65, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-10', '18A100020N', '100020', 'NAZMA BEGUM', 'Female', '1990-04-13', '01712863488', '1', NULL, '2018-07-28 05:12:05', '9', 1),
	(66, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-11', '18A100021N', '100021', 'ABDUR RASHID', 'Male', '1999-01-07', '01712863488', '1', NULL, '2018-07-28 05:27:54', '9', 1),
	(67, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-01', '18A100022N', '100022', 'MST. AKLIMA BEGUM', 'Female', '1982-03-04', '01712863488', '1', NULL, '2018-07-28 05:34:10', '9', 1),
	(68, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-03-08', '18C100023N', '100023', 'MAZHARUL', 'Male', '1997-01-01', '01712863488', '1', NULL, '2018-07-28 05:43:10', '9', 1),
	(69, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-07-01', '18G100024N', '100024', 'RANI', 'Female', '1990-09-08', '01712863488', '1', NULL, '2018-07-28 05:50:38', '9', 1),
	(70, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-10', '18A100025N', '100025', 'RATNA', 'Female', '1988-10-18', '01712863488', '1', NULL, '2018-07-28 05:56:56', '9', 1),
	(71, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-03-12', '18C100026N', '100026', 'JAHANGIR', 'Male', '1993-02-05', '01712863488', '0', NULL, '2018-07-28 06:08:35', '9', 1),
	(72, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-02-12', '18B100027N', '100027', 'HABIBUR RAHMAN', 'Male', '1993-08-10', '01712863488', '1', NULL, '2018-07-28 06:17:08', '9', 1),
	(73, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-03-20', '18C100028N', '100028', 'SAZEDA', 'Female', '1986-03-13', '01712863488', '1', NULL, '2018-07-28 06:23:46', '9', 1),
	(74, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-02', '18A100029N', '100029', 'BEAUTY BEGUM', 'Female', '1988-12-10', '01712863488', '1', NULL, '2018-07-28 06:39:55', '9', 1),
	(75, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-02-27', '18B100030N', '100030', 'HASAN', 'Male', '1995-06-10', '01712863488', '1', NULL, '2018-07-28 06:43:53', '9', 1),
	(76, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2017-10-12', '17K100031N', '100031', 'NASIMA AKTER', 'Female', '1989-02-05', '01712863488', '1', NULL, '2018-07-28 06:51:26', '9', 1),
	(77, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-03-01', '18C100032N', '100032', 'RUPA AKTER', 'Female', '1989-11-10', '01712863488', '1', NULL, '2018-07-28 06:59:23', '9', 1),
	(78, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-02-01', '18B100033N', '100033', 'HENA', 'Female', '1983-08-15', '01712863488', '1', NULL, '2018-07-28 07:24:57', '9', 1),
	(79, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-02-08', '18B100034N', '100034', 'PARUL', 'Female', '1987-01-29', '01712863488', '1', NULL, '2018-07-28 07:30:52', '9', 1),
	(80, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-03-13', '18C100035N', '100035', 'FAHIMA', 'Female', '1980-05-03', '01712863488', '1', NULL, '2018-07-28 07:37:38', '9', 1),
	(81, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-04-02', '18D100036N', '100036', 'SHORIF MIA', 'Male', '1992-11-10', '01712863488', '1', NULL, '2018-07-28 08:00:30', '9', 1),
	(82, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-01', '18A100037N', '100037', 'MST. HAMIDA AKTER', 'Female', '1995-01-25', '01712863488', '1', NULL, '2018-07-28 08:33:02', '9', 1),
	(83, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-07-23', '18G100038N', '100038', 'SHATHI AKTER', 'Female', '1993-03-20', '01712863488', '1', NULL, '2018-07-28 08:38:40', '9', 1),
	(84, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-10', '18A100039N', '100039', 'MST. DINA AKTER', 'Female', '1993-04-18', '01712863488', '1', NULL, '2018-07-28 08:47:03', '9', 1),
	(85, 3, 36, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-11', '18A100040N', '100040', 'NAZMA BEGUM', 'Female', '1991-03-16', '01712863488', '1', NULL, '2018-07-28 09:18:12', '9', 1),
	(86, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-03-01', '18C100041N', '100041', 'LIPI', 'Female', '1990-01-09', '01712863488', '1', NULL, '2018-07-28 09:27:43', '9', 1),
	(87, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-07-08', '18G100042N', '100042', 'MST. RUNA AKTER', 'Female', '1995-01-01', '01712863488', '1', NULL, '2018-07-28 10:03:52', '9', 1),
	(88, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-07-08', '18G100043N', '100043', 'TANIA', 'Female', '1998-01-12', '01712863488', '1', NULL, '2018-07-28 10:08:17', '9', 1),
	(89, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-04-01', '18D100044N', '100044', 'SUFIA', 'Female', '2018-04-01', '01712863488', '1', NULL, '2018-07-28 10:47:18', '9', 1),
	(90, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-02-01', '18B100045N', '100045', 'BOKUL', 'Female', '1998-01-01', '01712863488', '1', NULL, '2018-07-28 10:54:38', '9', 1),
	(91, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-03-06', '18C100046N', '100046', 'FAHIMA', 'Female', '1988-01-01', '01712863488', '1', NULL, '2018-07-28 11:01:08', '9', 1),
	(92, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-04-21', '18D100047N', '100047', 'SALEHA KHATUN', 'Female', '1985-10-08', '01712863488', '1', NULL, '2018-07-28 11:13:11', '9', 1),
	(93, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-02-01', '18B100048N', '100048', 'SHUMITA', 'Female', '1998-02-02', '01712863488', '1', NULL, '2018-07-28 11:38:46', '9', 1),
	(94, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-02-01', '18B100049N', '100049', 'RABIA KHATUN', 'Female', '1988-05-01', '01712863488', '1', NULL, '2018-07-28 11:43:42', '9', 1),
	(95, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-03-01', '18C100050N', '100050', 'ISMOT ARA', 'Female', '1993-05-20', '01712863488', '1', NULL, '2018-07-28 11:51:10', '9', 1),
	(96, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-03-01', '18C100051N', '100051', 'SABANA', 'Female', '1996-01-12', '01712863488', '1', NULL, '2018-07-28 11:56:03', '9', 1),
	(97, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-07-09', '18G100052N', '100052', 'SALMA KHATUN', 'Female', '1999-11-13', '01712863488', '1', NULL, '2018-07-29 03:51:09', '9', 1),
	(98, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-02-01', '18B100053N', '100053', 'PARVIN AKTER', 'Female', '1996-11-12', '01712863488', '1', NULL, '2018-07-29 03:58:18', '9', 1),
	(99, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-03-04', '18C100054N', '100054', 'SHAIFUL', 'Female', '1994-10-26', '01712863488', '0', NULL, '2018-07-29 04:14:27', '9', 1),
	(100, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-04-03', '18D100055N', '100055', 'SHAHNAZ', 'Female', '1997-07-22', '01712863488', '0', NULL, '2018-07-29 04:25:44', '9', 1),
	(101, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-10', '18A100056N', '100056', 'DALIA AKTER', 'Female', '1986-05-05', '01712863488', '1', NULL, '2018-07-29 04:35:27', '9', 1),
	(102, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-03-05', '18C100057N', '100057', 'NUR JAHAN', 'Female', '1988-01-11', '01712863488', '1', NULL, '2018-07-29 04:53:03', '9', 1),
	(103, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-07-29', '18G100058N', '100058', 'JAHANGIR ALOM', 'Male', '1991-02-12', '01712863488', '1', NULL, '2018-07-29 04:57:49', '9', 1),
	(104, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-03-08', '18C100059N', '100059', 'MOZIRON', 'Female', '1981-07-04', '01712863488', '1', NULL, '2018-07-29 05:09:41', '9', 1),
	(105, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-05-13', '18E100060N', '100060', 'ANOWARA', 'Female', '1986-03-04', '01712863488', '1', NULL, '2018-07-29 05:17:21', '9', 1),
	(106, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-03-10', '18C100061N', '100061', 'AKLIMA', 'Female', '1998-03-10', '01712863488', '1', NULL, '2018-07-29 05:24:31', '9', 1),
	(107, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-02-26', '18B100062N', '100062', 'SHATHI AKTER', 'Female', '1992-06-10', '01712863488', '1', NULL, '2018-07-29 05:31:33', '9', 1),
	(108, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-04-16', '18D100063N', '100063', 'SHATHI', 'Female', '1992-02-01', '01712863488', '1', NULL, '2018-07-29 05:41:26', '9', 1),
	(109, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-03-11', '18C100064N', '100064', 'SAIDUL', 'Male', '1998-01-01', '01712863488', '1', NULL, '2018-07-29 06:34:12', '9', 1),
	(110, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-02-01', '18B100065N', '100065', 'KOLPONA BEGUM', 'Female', '1994-06-10', '01712863488', '1', NULL, '2018-07-29 08:19:47', '9', 1),
	(111, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-07-11', '18G100066N', '100066', 'POLY', 'Female', '1998-07-10', '01712863488', '1', NULL, '2018-07-29 08:24:44', '9', 1),
	(112, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-03', '18A100067N', '100067', 'SIMU AKTER', 'Female', '1995-08-12', '01712863488', '1', NULL, '2018-07-29 08:29:37', '9', 1),
	(113, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-03-01', '18C100068N', '100068', 'ASMA', 'Female', '1991-04-03', '01712863488', '1', NULL, '2018-07-29 08:33:40', '9', 1),
	(114, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-04-01', '18D100069N', '100069', 'ROBIUL', 'Male', '1999-06-01', '01712863488', '1', NULL, '2018-07-29 08:43:05', '9', 1),
	(115, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-07-24', '18G100070N', '100070', 'KOLPONA', 'Female', '1990-01-01', '01712863488', '1', NULL, '2018-07-29 08:51:50', '9', 1),
	(116, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-10', '18A100071N', '100071', 'HENA', 'Female', '1981-10-25', '01712863488', '1', NULL, '2018-07-29 09:03:31', '9', 1),
	(117, 3, 37, '3', NULL, NULL, '', 2, 25, 21, 21, '2018-01-10', '18A100072N', '100072', 'FATEMA KHATUN', 'Female', '1993-07-06', '01712863488', '1', NULL, '2018-07-29 10:19:03', '9', 1),
	(118, 3, 37, '3', NULL, NULL, '', 2, 25, 21, 21, '2018-01-13', '18A100073N', '100073', 'RAZIA SULTANA', 'Female', '1988-06-10', '01712863488', '1', NULL, '2018-07-29 10:24:53', '9', 1);
/*!40000 ALTER TABLE `hr_as_basic_info` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_attendance
DROP TABLE IF EXISTS `hr_attendance`;
CREATE TABLE IF NOT EXISTS `hr_attendance` (
  `att_id` int(11) NOT NULL AUTO_INCREMENT,
  `as_id` int(11) NOT NULL,
  `in_time` timestamp NULL DEFAULT NULL,
  `out_time` timestamp NULL DEFAULT NULL,
  `hr_shift_code` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`att_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_attendance: ~91 rows (approximately)
DELETE FROM `hr_attendance`;
/*!40000 ALTER TABLE `hr_attendance` DISABLE KEYS */;
INSERT INTO `hr_attendance` (`att_id`, `as_id`, `in_time`, `out_time`, `hr_shift_code`) VALUES
	(14, 56, '2018-07-18 22:10:00', '2018-07-19 09:08:00', 'A'),
	(15, 51, '2018-07-19 09:02:57', '0000-00-00 00:00:00', 'A'),
	(16, 50, '2018-07-19 09:03:22', NULL, 'A'),
	(17, 46, '2018-07-19 09:04:45', '0000-00-00 00:00:00', 'A'),
	(18, 56, '2018-07-20 04:51:40', '2018-07-20 06:09:34', 'A'),
	(19, 55, '2018-07-20 04:54:35', '2018-07-20 09:04:02', 'A'),
	(20, 54, '2018-07-20 04:55:03', '2018-07-20 07:03:46', 'A'),
	(21, 53, '2018-07-20 04:55:09', '2018-07-20 08:08:17', 'A'),
	(22, 50, '2018-07-20 04:55:16', '2018-07-20 09:03:23', 'A'),
	(23, 46, '2018-07-20 04:55:44', '0000-00-00 00:00:00', 'A'),
	(24, 48, '2018-07-20 04:59:17', '2018-07-20 09:04:57', 'A'),
	(25, 56, '2018-07-17 21:08:00', '2018-07-18 06:00:00', NULL),
	(26, 42, '2018-07-17 21:08:00', '2018-07-18 06:18:00', NULL),
	(27, 56, '2018-07-20 06:44:03', '2018-07-20 06:46:39', 'A'),
	(28, 55, '2018-07-20 20:52:18', '0000-00-00 00:00:00', 'A'),
	(29, 48, '2018-07-20 20:52:30', '2018-07-21 06:34:59', 'A'),
	(30, 53, '2018-07-20 20:57:17', '2018-07-21 06:32:26', 'A'),
	(31, 51, '2018-07-20 20:57:35', '2018-07-20 20:57:36', 'A'),
	(32, 46, '2018-07-20 21:01:13', '2018-07-21 06:37:05', 'A'),
	(33, 50, '2018-07-20 21:02:51', '2018-07-21 06:34:44', 'A'),
	(34, 56, '2018-07-21 04:30:41', '0000-00-00 00:00:00', 'A'),
	(35, 56, '2018-07-21 20:45:07', '2018-07-22 05:45:41', 'A'),
	(36, 48, '2018-07-21 20:51:26', '2018-07-22 09:02:15', 'A'),
	(37, 53, '2018-07-21 20:56:21', '2018-07-22 09:04:12', 'A'),
	(38, 55, '2018-07-21 20:58:03', '2018-07-22 09:03:37', 'A'),
	(39, 46, '2018-07-21 20:58:17', '0000-00-00 00:00:00', 'A'),
	(40, 51, '2018-07-21 20:58:29', '2018-07-22 09:03:00', 'A'),
	(41, 50, '2018-07-21 21:01:39', '2018-07-22 09:02:51', 'A'),
	(42, 54, '2018-07-22 05:43:59', '2018-07-22 05:44:01', 'A'),
	(43, 48, '2018-07-22 20:53:27', '2018-07-23 09:04:27', 'A'),
	(44, 55, '2018-07-22 20:55:00', '2018-07-23 09:02:10', 'A'),
	(45, 46, '2018-07-22 20:55:19', '2018-07-23 06:12:29', 'A'),
	(46, 54, '2018-07-22 20:55:26', NULL, 'A'),
	(47, 50, '2018-07-22 20:55:33', '2018-07-23 09:02:22', 'A'),
	(48, 53, '2018-07-22 20:55:52', '2018-07-23 09:03:55', 'A'),
	(49, 51, '2018-07-22 20:57:39', '2018-07-23 02:01:31', 'A'),
	(50, 56, '2018-07-23 00:18:00', '2018-07-23 01:17:35', NULL),
	(51, 42, '2018-07-22 21:00:00', '2018-07-22 21:00:00', NULL),
	(52, 56, '2018-07-23 20:42:43', NULL, 'A'),
	(53, 46, '2018-07-23 20:53:44', NULL, 'A'),
	(54, 53, '2018-07-23 20:58:13', NULL, 'A'),
	(55, 48, '2018-07-23 20:58:49', NULL, 'A'),
	(56, 50, '2018-07-23 21:02:25', NULL, 'A'),
	(57, 51, '2018-07-23 21:08:50', NULL, 'A'),
	(58, 104, '2018-07-29 19:01:00', '2018-07-29 19:01:00', NULL),
	(59, 56, '2018-07-25 01:35:25', '2018-07-25 01:36:46', 'A'),
	(60, 46, '2018-07-25 06:01:40', '2018-07-25 20:52:48', 'A'),
	(61, 55, '2018-07-25 06:02:39', NULL, 'A'),
	(62, 51, '2018-07-25 06:04:18', NULL, 'A'),
	(63, 53, '2018-07-25 06:04:34', '2018-07-25 20:55:58', 'A'),
	(64, 48, '2018-07-25 09:02:18', '2018-07-25 20:58:06', 'A'),
	(65, 50, '2018-07-25 09:05:14', '2018-07-25 21:03:00', 'A'),
	(66, 56, '2018-07-26 06:07:00', '2018-07-26 09:08:25', 'A'),
	(67, 46, '2018-07-26 09:02:11', '2018-07-26 20:56:06', 'A'),
	(68, 51, '2018-07-26 09:02:24', '2018-07-26 21:00:47', 'A'),
	(69, 48, '2018-07-26 10:01:57', '2018-07-26 20:55:35', 'A'),
	(70, 53, '2018-07-26 10:04:12', '2018-07-26 20:55:26', 'A'),
	(71, 55, '2018-07-26 11:01:39', NULL, 'A'),
	(72, 50, '2018-07-26 11:02:09', '2018-07-26 20:54:15', 'A'),
	(73, 56, '2018-07-27 09:03:09', NULL, 'A'),
	(74, 51, '2018-07-27 09:04:04', '2018-07-27 20:57:10', 'A'),
	(75, 48, '2018-07-27 10:01:41', '2018-07-27 21:00:30', 'A'),
	(76, 46, '2018-07-27 10:03:25', '2018-07-27 20:55:20', 'A'),
	(77, 50, '2018-07-27 10:03:34', '2018-07-27 20:59:51', 'A'),
	(78, 55, '2018-07-27 10:03:52', '2018-07-27 20:55:55', 'A'),
	(79, 53, '2018-07-27 20:58:52', '2018-07-28 06:35:57', 'A'),
	(80, 51, '2018-07-28 06:34:19', '2018-07-28 20:59:56', 'A'),
	(81, 55, '2018-07-28 06:34:25', '2018-07-28 20:48:24', 'A'),
	(82, 50, '2018-07-28 06:34:32', '2018-07-28 20:59:02', 'A'),
	(83, 46, '2018-07-28 06:34:58', '2018-07-28 20:56:57', 'A'),
	(84, 48, '2018-07-28 06:35:40', '2018-07-28 20:55:13', 'A'),
	(85, 46, '2018-07-29 09:02:22', '2018-07-29 20:57:00', 'A'),
	(86, 48, '2018-07-29 09:03:42', '2018-07-29 20:54:39', 'A'),
	(87, 55, '2018-07-29 10:04:13', '2018-07-29 20:51:27', 'A'),
	(88, 53, '2018-07-29 10:04:19', '2018-07-29 20:57:18', 'A'),
	(89, 51, '2018-07-29 11:02:44', '2018-07-29 21:00:44', 'A'),
	(90, 50, '2018-07-29 11:02:55', NULL, 'A'),
	(91, 56, '2018-07-29 20:51:23', NULL, 'A'),
	(92, 48, '2018-07-30 09:01:06', '2018-07-30 20:54:23', 'A'),
	(93, 51, '2018-07-30 10:01:46', '2018-07-30 20:57:11', 'A'),
	(94, 46, '2018-07-30 10:02:02', '2018-07-30 21:00:35', 'A'),
	(95, 53, '2018-07-30 10:04:51', '2018-07-30 20:53:29', 'A'),
	(96, 50, '2018-07-30 11:02:38', '2018-07-30 20:58:31', 'A'),
	(97, 55, '2018-07-30 11:02:42', '2018-07-30 20:54:07', 'A'),
	(98, 53, '2018-08-01 10:01:14', NULL, 'A'),
	(99, 55, '2018-08-01 20:42:53', NULL, 'A'),
	(100, 56, '2018-08-01 20:43:01', NULL, 'A'),
	(101, 48, '2018-08-01 20:53:03', NULL, 'A'),
	(102, 50, '2018-08-01 20:54:57', NULL, 'A'),
	(103, 46, '2018-08-01 20:55:35', NULL, 'A'),
	(104, 51, '2018-08-01 20:58:43', NULL, 'A');
/*!40000 ALTER TABLE `hr_attendance` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_attendance_manual
DROP TABLE IF EXISTS `hr_attendance_manual`;
CREATE TABLE IF NOT EXISTS `hr_attendance_manual` (
  `hr_att_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hr_att_as_id` varchar(10) NOT NULL,
  `hr_att_date` date NOT NULL,
  `hr_att_punch_time` time NOT NULL,
  `hr_att_night_flag` tinyint(1) NOT NULL DEFAULT '0',
  `hr_att_reason` mediumtext NOT NULL,
  `hr_att_created_at` datetime DEFAULT NULL,
  `hr_att_posted_by` int(11) DEFAULT NULL,
  `device_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`hr_att_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_attendance_manual: ~6 rows (approximately)
DELETE FROM `hr_attendance_manual`;
/*!40000 ALTER TABLE `hr_attendance_manual` DISABLE KEYS */;
INSERT INTO `hr_attendance_manual` (`hr_att_id`, `hr_att_as_id`, `hr_att_date`, `hr_att_punch_time`, `hr_att_night_flag`, `hr_att_reason`, `hr_att_created_at`, `hr_att_posted_by`, `device_id`) VALUES
	(9, '09A020002E', '2018-05-31', '08:00:00', 0, 'ddd', '2018-05-31 07:53:12', 9, NULL),
	(10, '09A020002E', '2018-05-31', '06:00:00', 0, 'ddd', '2018-05-31 07:53:12', 9, NULL),
	(11, '18E100001N', '2018-05-31', '08:00:00', 0, 'sdfdf', '2018-05-31 09:22:11', 8, NULL),
	(12, '18E100001N', '2018-05-31', '00:02:00', 0, 'sdfdf', '2018-05-31 09:22:11', 8, NULL),
	(13, '18E100001N', '2018-06-02', '02:00:00', 0, 'rgdfg', '2018-06-02 06:16:45', 8, NULL),
	(14, '18E100001N', '2018-06-02', '00:05:00', 0, 'rgdfg', '2018-06-02 06:16:45', 8, NULL);
/*!40000 ALTER TABLE `hr_attendance_manual` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_benefits
DROP TABLE IF EXISTS `hr_benefits`;
CREATE TABLE IF NOT EXISTS `hr_benefits` (
  `ben_id` int(11) NOT NULL AUTO_INCREMENT,
  `ben_as_id` varchar(10) NOT NULL,
  `ben_joining_salary` float NOT NULL,
  `ben_cash_amount` float DEFAULT NULL,
  `ben_bank_amount` float NOT NULL,
  `ben_current_salary` float NOT NULL,
  `ben_basic` float NOT NULL,
  `ben_house_rent` float NOT NULL,
  `ben_medical` float NOT NULL,
  `ben_transport` float NOT NULL,
  `ben_food` float NOT NULL,
  `ben_status` tinyint(1) DEFAULT '0',
  `ben_updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ben_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_benefits: ~1 rows (approximately)
DELETE FROM `hr_benefits`;
/*!40000 ALTER TABLE `hr_benefits` DISABLE KEYS */;
INSERT INTO `hr_benefits` (`ben_id`, `ben_as_id`, `ben_joining_salary`, `ben_cash_amount`, `ben_bank_amount`, `ben_current_salary`, `ben_basic`, `ben_house_rent`, `ben_medical`, `ben_transport`, `ben_food`, `ben_status`, `ben_updated_at`) VALUES
	(6, '17F005001B', 50000, 45000, 25000, 70000, 42000, 7000, 7000, 7000, 7000, 1, '2018-07-17 18:11:37');
/*!40000 ALTER TABLE `hr_benefits` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_department
DROP TABLE IF EXISTS `hr_department`;
CREATE TABLE IF NOT EXISTS `hr_department` (
  `hr_department_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_department_area_id` int(11) DEFAULT NULL,
  `hr_department_name` varchar(128) NOT NULL,
  `hr_department_name_bn` varchar(255) NOT NULL,
  `hr_department_code` varchar(10) DEFAULT NULL,
  `hr_department_min_range` varchar(6) DEFAULT NULL,
  `hr_department_max_range` varchar(6) DEFAULT NULL,
  `hr_department_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hr_department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_department: ~1 rows (approximately)
DELETE FROM `hr_department`;
/*!40000 ALTER TABLE `hr_department` DISABLE KEYS */;
INSERT INTO `hr_department` (`hr_department_id`, `hr_department_area_id`, `hr_department_name`, `hr_department_name_bn`, `hr_department_code`, `hr_department_min_range`, `hr_department_max_range`, `hr_department_status`) VALUES
	(25, 2, 'Production', 'উৎপাদন', 'N', '100001', '500000', 1);
/*!40000 ALTER TABLE `hr_department` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_designation
DROP TABLE IF EXISTS `hr_designation`;
CREATE TABLE IF NOT EXISTS `hr_designation` (
  `hr_designation_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_designation_emp_type` int(11) NOT NULL,
  `hr_designation_name` varchar(128) DEFAULT NULL,
  `hr_designation_name_bn` varchar(255) DEFAULT NULL,
  `hr_designation_position` int(3) NOT NULL DEFAULT '1',
  `hr_designation_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hr_designation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_designation: ~14 rows (approximately)
DELETE FROM `hr_designation`;
/*!40000 ALTER TABLE `hr_designation` DISABLE KEYS */;
INSERT INTO `hr_designation` (`hr_designation_id`, `hr_designation_emp_type`, `hr_designation_name`, `hr_designation_name_bn`, `hr_designation_position`, `hr_designation_status`) VALUES
	(24, 1, 'AMD', 'এ আমি ডি', 11, 1),
	(25, 1, 'CEO', 'সি ই ও', 10, 1),
	(26, 1, 'Manager', 'ম্যানেজার', 9, 1),
	(27, 1, 'Sr Officer', 'সিনিয়র অফিসার', 8, 1),
	(28, 1, 'Officer', 'অফিসার', 7, 1),
	(29, 2, 'Offiece Boy', 'অফিস বয়', 6, 1),
	(30, 2, 'Cleaner', 'পরিছন্ন কর্মী', 3, 1),
	(31, 3, 'Senior Operator', 'সিনিয়র অপারেটর', 4, 1),
	(32, 3, 'Cutter Man', 'কাটার ম্যান', 5, 1),
	(33, 3, 'Helper', 'হেল্পার', 1, 1),
	(34, 1, 'Washerman', 'ধোপা', 2, 1),
	(35, 1, 'Junior Manager', 'জুনিয়র ম্যানেজার', 1, 1),
	(36, 3, 'Sewing machine operator', 'সেলাই মেশিন অপারেটর', 1, 1),
	(37, 3, 'Ordinary Sewing Machine Operator', 'সাধারণ সেলাই মেশিন অপারেটর', 1, 1);
/*!40000 ALTER TABLE `hr_designation` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_dist
DROP TABLE IF EXISTS `hr_dist`;
CREATE TABLE IF NOT EXISTS `hr_dist` (
  `dis_id` int(2) NOT NULL AUTO_INCREMENT,
  `dis_name` varchar(64) NOT NULL,
  `dis_name_bn` varchar(255) DEFAULT NULL,
  `dis_status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`dis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_dist: ~64 rows (approximately)
DELETE FROM `hr_dist`;
/*!40000 ALTER TABLE `hr_dist` DISABLE KEYS */;
INSERT INTO `hr_dist` (`dis_id`, `dis_name`, `dis_name_bn`, `dis_status`) VALUES
	(1, 'Dhaka', 'ঢাকা', 1),
	(2, 'Faridpur', 'ফরিদপুর', 1),
	(3, 'Gazipur', 'গাজীপুর', 1),
	(4, 'Gopalganj', 'গোপালগঞ্জ', 1),
	(5, 'Jamalpur', 'জামালপুর', 1),
	(6, 'Kishoreganj', 'কিশোরগঞ্জ', 1),
	(7, 'Madaripur', 'মাদারীপুর', 1),
	(8, 'Manikganj', 'মানিকগঞ্জ', 1),
	(9, 'Munshiganj', 'মুন্সিগঞ্জ', 1),
	(10, 'Mymensingh', 'ময়মনসিংহ', 1),
	(11, 'Narayanganj', 'নারায়াণগঞ্জ', 1),
	(12, 'Narsingdi', 'নরসিংদী', 1),
	(13, 'Netrokona', 'নেত্রকোণা', 1),
	(14, 'Rajbari', 'রাজবাড়ি', 1),
	(15, 'Shariatpur', 'শরীয়তপুর', 1),
	(16, 'Sherpur', 'শেরপুর', 1),
	(17, 'Tangail', 'টাঙ্গাইল', 1),
	(18, 'Bogra', 'বগুড়া', 1),
	(19, 'Joypurhat', 'জয়পুরহাট', 1),
	(20, 'Naogaon', 'নওগাঁ', 1),
	(21, 'Natore', 'নাটোর', 1),
	(22, 'Nawabganj', 'নবাবগঞ্জ', 1),
	(23, 'Pabna', 'পাবনা', 1),
	(24, 'Rajshahi', 'রাজশাহী', 1),
	(25, 'Sirajgonj', 'সিরাজগঞ্জ', 1),
	(26, 'Dinajpur', 'দিনাজপুর', 1),
	(27, 'Gaibandha', 'গাইবান্ধা', 1),
	(28, 'Kurigram', 'কুড়িগ্রাম', 1),
	(29, 'Lalmonirhat', 'লালমনিরহাট', 1),
	(30, 'Nilphamari', 'নীলফামারী', 1),
	(31, 'Panchagarh', 'পঞ্চগড়', 1),
	(32, 'Rangpur', 'রংপুর', 1),
	(33, 'Thakurgaon', 'ঠাকুরগাঁও', 1),
	(34, 'Barguna', 'বরগুনা', 1),
	(35, 'Barisal', 'বরিশাল', 1),
	(36, 'Bhola', 'ভোলা', 1),
	(37, 'Jhalokati', 'ঝালকাঠি', 1),
	(38, 'Patuakhali', 'পটুয়াখালী', 1),
	(39, 'Pirojpur', 'পিরোজপুর', 1),
	(40, 'Bandarban', 'বান্দরবান', 1),
	(41, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', 1),
	(42, 'Chandpur', 'চাঁদপুর', 1),
	(43, 'Chittagong', 'চট্টগ্রাম', 1),
	(44, 'Comilla', 'কুমিল্লা', 1),
	(45, 'Cox\'s Bazar', 'কক্সবাজার', 1),
	(46, 'Feni', 'ফেনী', 1),
	(47, 'Khagrachari', 'খাগড়াছড়ি', 1),
	(48, 'Lakshmipur', 'লক্ষ্মীপুর', 1),
	(49, 'Noakhali', 'নোয়াখালী', 1),
	(50, 'Rangamati', 'রাঙ্গামাটি', 1),
	(51, 'Habiganj', 'হবিগঞ্জ', 1),
	(52, 'Maulvibazar', 'মৌলভীবাজার', 1),
	(53, 'Sunamganj', 'সুনামগঞ্জ', 1),
	(54, 'Sylhet', 'সিলেট', 1),
	(55, 'Bagerhat', 'বাগেরহাট', 1),
	(56, 'Chuadanga', 'চুয়াডাঙ্গা', 1),
	(57, 'Jessore', 'যশোর', 1),
	(58, 'Jhenaidah', 'ঝিনাইদহ', 1),
	(59, 'Khulna', 'খুলনা', 1),
	(60, 'Kushtia', 'কুষ্টিয়া', 1),
	(61, 'Magura', 'মাগুরা', 1),
	(62, 'Meherpur', 'মেহেরপুর', 1),
	(63, 'Narail', 'নড়াইল', 1),
	(64, 'Satkhira', 'সাতক্ষীরা', 1);
/*!40000 ALTER TABLE `hr_dist` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_dis_rec
DROP TABLE IF EXISTS `hr_dis_rec`;
CREATE TABLE IF NOT EXISTS `hr_dis_rec` (
  `dis_re_id` int(11) NOT NULL AUTO_INCREMENT,
  `dis_re_offender_id` varchar(10) NOT NULL,
  `dis_re_griever_id` varchar(10) DEFAULT NULL,
  `dis_re_issue_id` int(11) NOT NULL,
  `dis_re_ac_step_id` int(11) NOT NULL,
  `dis_re_req_remedy` varchar(50) DEFAULT NULL,
  `dis_re_discussed_date` date NOT NULL,
  `dis_re_doe_from` date NOT NULL,
  `dis_re_doe_to` date NOT NULL,
  `dis_re_created_by` varchar(10) DEFAULT NULL,
  `dis_re_created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`dis_re_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_dis_rec: ~4 rows (approximately)
DELETE FROM `hr_dis_rec`;
/*!40000 ALTER TABLE `hr_dis_rec` DISABLE KEYS */;
INSERT INTO `hr_dis_rec` (`dis_re_id`, `dis_re_offender_id`, `dis_re_griever_id`, `dis_re_issue_id`, `dis_re_ac_step_id`, `dis_re_req_remedy`, `dis_re_discussed_date`, `dis_re_doe_from`, `dis_re_doe_to`, `dis_re_created_by`, `dis_re_created_at`) VALUES
	(1, '18E100001N', '14J005004B', 2, 1, 'sdfsdf', '2018-05-08', '2018-05-22', '2018-05-28', '8', '2018-05-31 09:59:05'),
	(2, '18D002011H', '18G000002A', 1, 1, 'Need to be warned', '2018-07-16', '2018-07-16', '2018-07-16', '1', '2018-07-16 12:06:01'),
	(3, '18A100009N', '18G100007N', 2, 1, 'Verbal Warning', '2018-07-17', '2018-07-17', '2018-07-17', '1', '2018-07-17 09:18:23'),
	(4, '18G100007N', '18E100003N', 1, 1, 'Verbal Warning', '2018-07-17', '2018-07-17', '2018-07-27', '1', '2018-07-18 04:20:59');
/*!40000 ALTER TABLE `hr_dis_rec` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_education
DROP TABLE IF EXISTS `hr_education`;
CREATE TABLE IF NOT EXISTS `hr_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `education_as_id` varchar(10) NOT NULL,
  `education_level_id` int(11) NOT NULL,
  `education_degree_id_1` int(11) DEFAULT NULL,
  `education_degree_id_2` varchar(128) DEFAULT NULL,
  `education_major_group_concentation` varchar(128) DEFAULT NULL,
  `education_institute_name` varchar(256) NOT NULL,
  `education_result_id` int(11) NOT NULL,
  `education_result_marks` int(11) DEFAULT NULL COMMENT 'in %(percent)',
  `education_result_cgpa` float DEFAULT NULL,
  `education_result_scale` int(11) DEFAULT NULL,
  `education_passing_year` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_education: ~1 rows (approximately)
DELETE FROM `hr_education`;
/*!40000 ALTER TABLE `hr_education` DISABLE KEYS */;
INSERT INTO `hr_education` (`id`, `education_as_id`, `education_level_id`, `education_degree_id_1`, `education_degree_id_2`, `education_major_group_concentation`, `education_institute_name`, `education_result_id`, `education_result_marks`, `education_result_cgpa`, `education_result_scale`, `education_passing_year`) VALUES
	(1, '18C100041N', 1, 1, NULL, NULL, 'R. K. High School', 8, NULL, NULL, NULL, 1950);
/*!40000 ALTER TABLE `hr_education` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_education_degree_title
DROP TABLE IF EXISTS `hr_education_degree_title`;
CREATE TABLE IF NOT EXISTS `hr_education_degree_title` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `education_level_id` int(11) NOT NULL,
  `education_degree_title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_education_degree_title: ~34 rows (approximately)
DELETE FROM `hr_education_degree_title`;
/*!40000 ALTER TABLE `hr_education_degree_title` DISABLE KEYS */;
INSERT INTO `hr_education_degree_title` (`id`, `education_level_id`, `education_degree_title`) VALUES
	(1, 1, 'PSC'),
	(2, 1, 'Ebtedayee (Madrasah)'),
	(3, 1, '5 Pass'),
	(4, 1, 'others'),
	(5, 2, 'JSC'),
	(6, 2, 'JDC (Madrasah)'),
	(7, 2, '8 Pass'),
	(8, 2, 'others'),
	(9, 3, 'SSC'),
	(10, 3, 'O Level'),
	(11, 3, 'Dakhil (Madrasah)'),
	(12, 3, 'SSC (Vocational)'),
	(13, 3, 'others'),
	(14, 4, 'HSC'),
	(15, 4, 'A Level'),
	(16, 4, 'Alim (Madrasah)'),
	(17, 4, 'HSC (Vocational)'),
	(18, 4, 'others'),
	(19, 5, 'Diploma in Engineering'),
	(20, 6, 'Bachelor of Science (BSc)'),
	(21, 7, 'Master of Science (MSc)'),
	(22, 6, 'Bachelor of Arts (BA)'),
	(23, 6, 'Bachelor of Commerce (B.Com)'),
	(24, 6, 'Bachelor of Social Science (BBS)'),
	(25, 6, 'Bachelor of Business Studies (BSS)'),
	(26, 6, 'Degree Pass Course'),
	(27, 6, 'Degree Professional'),
	(28, 7, 'Master of Commerce (M.Com)'),
	(29, 7, 'Master of Arts (MA)'),
	(30, 7, 'Master of Business Administration'),
	(31, 7, 'M.Fill'),
	(32, 7, 'Mphil.'),
	(33, 6, 'BCom'),
	(34, 9, 'M.Phil');
/*!40000 ALTER TABLE `hr_education_degree_title` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_education_level
DROP TABLE IF EXISTS `hr_education_level`;
CREATE TABLE IF NOT EXISTS `hr_education_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `education_level_title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_education_level: ~9 rows (approximately)
DELETE FROM `hr_education_level`;
/*!40000 ALTER TABLE `hr_education_level` DISABLE KEYS */;
INSERT INTO `hr_education_level` (`id`, `education_level_title`) VALUES
	(1, 'PSC/5 Pass'),
	(2, 'JSC/JDC/8 Pass'),
	(3, 'Secondary'),
	(4, 'Higher Secondary'),
	(5, 'Diploma'),
	(6, 'Bachelor/Honors'),
	(7, 'Masters'),
	(8, 'PhD (Doctor of Philosophy)'),
	(9, 'Others');
/*!40000 ALTER TABLE `hr_education_level` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_education_result
DROP TABLE IF EXISTS `hr_education_result`;
CREATE TABLE IF NOT EXISTS `hr_education_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `education_result_title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_education_result: ~9 rows (approximately)
DELETE FROM `hr_education_result`;
/*!40000 ALTER TABLE `hr_education_result` DISABLE KEYS */;
INSERT INTO `hr_education_result` (`id`, `education_result_title`) VALUES
	(1, 'First Division/Class'),
	(2, 'Second Division/Class'),
	(3, 'Third Division/Class'),
	(4, 'Grade'),
	(5, 'Appeared'),
	(6, 'Enrolled'),
	(7, 'Awarded'),
	(8, 'Do Not Mention'),
	(9, 'Pass');
/*!40000 ALTER TABLE `hr_education_result` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_employee_bengali
DROP TABLE IF EXISTS `hr_employee_bengali`;
CREATE TABLE IF NOT EXISTS `hr_employee_bengali` (
  `hr_bn_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_bn_associate_id` varchar(10) NOT NULL,
  `hr_bn_associate_name` varchar(255) DEFAULT NULL,
  `hr_bn_father_name` varchar(255) DEFAULT NULL,
  `hr_bn_mother_name` varchar(255) DEFAULT NULL,
  `hr_bn_spouse_name` varchar(255) DEFAULT NULL,
  `hr_bn_permanent_village` varchar(255) DEFAULT NULL,
  `hr_bn_permanent_po` varchar(255) DEFAULT NULL,
  `hr_bn_present_road` varchar(255) DEFAULT NULL,
  `hr_bn_present_house` varchar(255) DEFAULT NULL,
  `hr_bn_present_po` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`hr_bn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_employee_bengali: ~0 rows (approximately)
DELETE FROM `hr_employee_bengali`;
/*!40000 ALTER TABLE `hr_employee_bengali` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_employee_bengali` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_emp_type
DROP TABLE IF EXISTS `hr_emp_type`;
CREATE TABLE IF NOT EXISTS `hr_emp_type` (
  `emp_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_emp_type_name` varchar(255) NOT NULL,
  `hr_emp_type_code` varchar(10) NOT NULL,
  `hr_emp_type_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`emp_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_emp_type: ~3 rows (approximately)
DELETE FROM `hr_emp_type`;
/*!40000 ALTER TABLE `hr_emp_type` DISABLE KEYS */;
INSERT INTO `hr_emp_type` (`emp_type_id`, `hr_emp_type_name`, `hr_emp_type_code`, `hr_emp_type_status`) VALUES
	(1, 'Management', 'M', 1),
	(2, 'Staff', 'S', 1),
	(3, 'Worker', 'W', 1);
/*!40000 ALTER TABLE `hr_emp_type` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_floor
DROP TABLE IF EXISTS `hr_floor`;
CREATE TABLE IF NOT EXISTS `hr_floor` (
  `hr_floor_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_floor_unit_id` int(11) NOT NULL,
  `hr_floor_name` varchar(128) NOT NULL,
  `hr_floor_name_bn` varchar(255) DEFAULT NULL,
  `hr_floor_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hr_floor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_floor: ~1 rows (approximately)
DELETE FROM `hr_floor`;
/*!40000 ALTER TABLE `hr_floor` DISABLE KEYS */;
INSERT INTO `hr_floor` (`hr_floor_id`, `hr_floor_unit_id`, `hr_floor_name`, `hr_floor_name_bn`, `hr_floor_status`) VALUES
	(21, 3, 'G-Floor', NULL, 1);
/*!40000 ALTER TABLE `hr_floor` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_grievance_appeal
DROP TABLE IF EXISTS `hr_grievance_appeal`;
CREATE TABLE IF NOT EXISTS `hr_grievance_appeal` (
  `hr_griv_appl_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_griv_associate_id` varchar(10) NOT NULL,
  `hr_griv_appl_issue_id` int(11) NOT NULL,
  `hr_griv_appl_step` varchar(255) DEFAULT NULL,
  `hr_griv_appl_discussed_date` date NOT NULL,
  `hr_griv_appl_req_remedy` varchar(255) NOT NULL,
  `hr_griv_appl_offender_as_id` varchar(10) NOT NULL,
  `hr_griv_appl_created_by` varchar(10) DEFAULT NULL,
  `hr_griv_appl_created_at` datetime DEFAULT NULL,
  `hr_griv_appl_status` tinyint(1) DEFAULT '0' COMMENT '0-pending, 1-action',
  PRIMARY KEY (`hr_griv_appl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_grievance_appeal: ~0 rows (approximately)
DELETE FROM `hr_grievance_appeal`;
/*!40000 ALTER TABLE `hr_grievance_appeal` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_grievance_appeal` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_grievance_issue
DROP TABLE IF EXISTS `hr_grievance_issue`;
CREATE TABLE IF NOT EXISTS `hr_grievance_issue` (
  `hr_griv_issue_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_griv_issue_name` varchar(255) NOT NULL,
  `hr_griv_issue_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`hr_griv_issue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_grievance_issue: ~8 rows (approximately)
DELETE FROM `hr_grievance_issue`;
/*!40000 ALTER TABLE `hr_grievance_issue` DISABLE KEYS */;
INSERT INTO `hr_grievance_issue` (`hr_griv_issue_id`, `hr_griv_issue_name`, `hr_griv_issue_status`) VALUES
	(1, 'Verbal Abuse', 1),
	(2, 'Declining Gate Pass', 1),
	(3, 'Declining Leave', 1),
	(4, 'Physical Abuse', 1),
	(5, 'Forcing to Work Extra', 1),
	(6, 'Indecent  Proposal', 1),
	(7, 'Sextual Harassment', 1),
	(8, 'Miscellaneous', 1);
/*!40000 ALTER TABLE `hr_grievance_issue` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_grievance_steps
DROP TABLE IF EXISTS `hr_grievance_steps`;
CREATE TABLE IF NOT EXISTS `hr_grievance_steps` (
  `hr_griv_steps_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_griv_steps_name` varchar(255) NOT NULL,
  `hr_griv_steps_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`hr_griv_steps_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_grievance_steps: ~5 rows (approximately)
DELETE FROM `hr_grievance_steps`;
/*!40000 ALTER TABLE `hr_grievance_steps` DISABLE KEYS */;
INSERT INTO `hr_grievance_steps` (`hr_griv_steps_id`, `hr_griv_steps_name`, `hr_griv_steps_status`) VALUES
	(1, 'Verbal Warning', 1),
	(2, 'Written Warning', 1),
	(3, 'B of I', 1),
	(4, 'With Hold Increment', 1),
	(5, 'Dismiss', 1);
/*!40000 ALTER TABLE `hr_grievance_steps` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_increment
DROP TABLE IF EXISTS `hr_increment`;
CREATE TABLE IF NOT EXISTS `hr_increment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `associate_id` varchar(10) NOT NULL,
  `current_salary` float NOT NULL,
  `increment_amount` float NOT NULL,
  `amount_type` int(11) NOT NULL,
  `eligible_date` datetime NOT NULL,
  `effective_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_increment: ~6 rows (approximately)
DELETE FROM `hr_increment`;
/*!40000 ALTER TABLE `hr_increment` DISABLE KEYS */;
INSERT INTO `hr_increment` (`id`, `associate_id`, `current_salary`, `increment_amount`, `amount_type`, `eligible_date`, `effective_date`, `status`, `created_by`, `created_at`) VALUES
	(5, '17F005001B', 50000, 5000, 1, '2018-06-17 00:00:00', '2018-07-17 00:00:00', 1, '17F005001B', '2018-07-17 07:19:47'),
	(6, '17F005001B', 50000, 5, 2, '2018-06-17 00:00:00', '2018-07-17 00:00:00', 1, '17F005001B', '2018-07-17 07:23:38'),
	(7, '17F005001B', 50000, 5, 2, '2018-06-17 00:00:00', '2018-07-17 00:00:00', 1, '17F005001B', '2018-07-17 07:25:07'),
	(8, '17F005001B', 50000, 10000000000, 1, '2018-06-17 00:00:00', '2018-07-17 00:00:00', 1, '17F005001B', '2018-07-17 07:32:20'),
	(9, '17F005001B', 50000, 20, 2, '2018-06-17 00:00:00', '2018-07-17 00:00:00', 1, '9999999999', '2018-07-17 07:36:39'),
	(10, '17F005001B', 60000, 10000, 1, '2018-06-17 00:00:00', '2018-07-17 00:00:00', 1, '9999999999', '2018-07-17 08:44:54');
/*!40000 ALTER TABLE `hr_increment` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_increment_type
DROP TABLE IF EXISTS `hr_increment_type`;
CREATE TABLE IF NOT EXISTS `hr_increment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `increment_type` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_increment_type: ~2 rows (approximately)
DELETE FROM `hr_increment_type`;
/*!40000 ALTER TABLE `hr_increment_type` DISABLE KEYS */;
INSERT INTO `hr_increment_type` (`id`, `increment_type`) VALUES
	(2, 'Yearly Incriment'),
	(3, 'Special Incriment');
/*!40000 ALTER TABLE `hr_increment_type` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_interview
DROP TABLE IF EXISTS `hr_interview`;
CREATE TABLE IF NOT EXISTS `hr_interview` (
  `hr_interview_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_interview_date` date NOT NULL,
  `hr_interview_name` varchar(255) NOT NULL,
  `hr_interview_contact` varchar(30) NOT NULL,
  `hr_interview_exp_salary` int(11) NOT NULL,
  `hr_interview_board_member` text NOT NULL,
  `hr_interview_note` text NOT NULL,
  PRIMARY KEY (`hr_interview_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_interview: ~0 rows (approximately)
DELETE FROM `hr_interview`;
/*!40000 ALTER TABLE `hr_interview` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_interview` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_job_posting
DROP TABLE IF EXISTS `hr_job_posting`;
CREATE TABLE IF NOT EXISTS `hr_job_posting` (
  `job_po_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_po_title` varchar(124) NOT NULL,
  `job_po_vacancy` int(11) NOT NULL,
  `job_po_description` varchar(512) NOT NULL,
  `job_po_responsibility` varchar(2048) NOT NULL,
  `job_po_nature` int(1) NOT NULL,
  `job_po_edu_req` varchar(255) NOT NULL,
  `job_po_experience` varchar(512) NOT NULL,
  `job_po_age_limit` varchar(32) NOT NULL,
  `job_po_requirment` varchar(512) NOT NULL,
  `job_po_location` varchar(64) NOT NULL,
  `job_po_salary` varchar(124) NOT NULL,
  `job_po_benefits` varchar(256) NOT NULL,
  PRIMARY KEY (`job_po_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_job_posting: ~1 rows (approximately)
DELETE FROM `hr_job_posting`;
/*!40000 ALTER TABLE `hr_job_posting` DISABLE KEYS */;
INSERT INTO `hr_job_posting` (`job_po_id`, `job_po_title`, `job_po_vacancy`, `job_po_description`, `job_po_responsibility`, `job_po_nature`, `job_po_edu_req`, `job_po_experience`, `job_po_age_limit`, `job_po_requirment`, `job_po_location`, `job_po_salary`, `job_po_benefits`) VALUES
	(1, 'SDFDSGFD', 1, '<p>FSDFGFD../\';\\\\</p>', '<p>FJHGHJ;\'\\\'\\</p>', 1, '<p>;L\\\'\';\\IOP</p>', '<p>;L\\\'\';\\IOP</p>', '18-25', '<p>;L\\\'\';\\IOP</p>', 'DHAKA', '10000', '<p>;L\\\'\';\\IOP</p>');
/*!40000 ALTER TABLE `hr_job_posting` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_leave
DROP TABLE IF EXISTS `hr_leave`;
CREATE TABLE IF NOT EXISTS `hr_leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_ass_id` varchar(10) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `leave_applied_date` date NOT NULL,
  `leave_status` int(1) DEFAULT '0',
  `leave_supporting_file` varchar(128) DEFAULT NULL,
  `leave_comment` varchar(128) DEFAULT NULL,
  `leave_updated_at` datetime DEFAULT NULL,
  `leave_updated_by` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_leave: ~4 rows (approximately)
DELETE FROM `hr_leave`;
/*!40000 ALTER TABLE `hr_leave` DISABLE KEYS */;
INSERT INTO `hr_leave` (`id`, `leave_ass_id`, `leave_type`, `leave_from`, `leave_to`, `leave_applied_date`, `leave_status`, `leave_supporting_file`, `leave_comment`, `leave_updated_at`, `leave_updated_by`) VALUES
	(22, '17F005001B', 'Casual', '2018-06-17', '2018-07-20', '2018-07-17', 2, NULL, NULL, '2018-07-17 09:31:42', 'XTQGMOKVJI'),
	(23, '17F005001B', 'Earned', '2018-07-17', '2018-07-20', '2018-07-17', 1, NULL, '22', '2018-07-17 09:38:39', '17F005001B'),
	(24, '18A100002N', 'Earned', '2018-07-09', '2018-07-09', '2018-07-18', 1, NULL, 'fgdg', '2018-07-22 07:03:35', '17F005001B'),
	(25, '17F005001B', 'Maternity', '2018-07-16', '2018-07-16', '2018-07-22', 1, NULL, NULL, '2018-07-22 07:06:06', '17F005001B');
/*!40000 ALTER TABLE `hr_leave` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_letter
DROP TABLE IF EXISTS `hr_letter`;
CREATE TABLE IF NOT EXISTS `hr_letter` (
  `hr_letter_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_letter_as_id` varchar(10) NOT NULL,
  `hr_letter_full` longtext NOT NULL,
  PRIMARY KEY (`hr_letter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_letter: ~4 rows (approximately)
DELETE FROM `hr_letter`;
/*!40000 ALTER TABLE `hr_letter` DISABLE KEYS */;
INSERT INTO `hr_letter` (`hr_letter_id`, `hr_letter_as_id`, `hr_letter_full`) VALUES
	(1, '18D002011H', '<p>তারিখঃ&nbsp;</p>\r\n<p>জনাব/জনাবাঃ</p>\r\n<p>পিতা/স্বামীর নামঃ</p>\r\n<p>মাতার নামঃ</p>\r\n<p>&nbsp;</p>\r\n<p>গ্রামঃ&nbsp; ডাকঘরঃ</p>\r\n<p>থানাঃ জেলাঃ</p>\r\n<p>\\r\\n</p>\r\n<p><span style="text-decoration: underline;"><strong>বিষয়ঃ- নিয়োগপত্র</strong></span></p>\r\n<p>\\r\\n</p>\r\n<p>কতৃপক্ষ অত্যন্ত আনন্দের সহিত আপনাকে......................................................</p>\r\n<p>\\r\\n</p>\r\n<p>১। আপনি চাকুরীতে প্রথম............</p>\r\n<p>\\r\\n</p>\r\n<p>&nbsp;</p>\r\n<p>\\r\\n</p>\r\n<p>২। সাধারন কর্মঘন্টা......।।</p>\r\n<p>\\r\\n</p>\r\n<p>৩। সাধারণ ছুটিঃ</p>\r\n<p>\\r\\n</p>\r\n<ul>\\r\\n\r\n<li>শুক্রবার সাপ্তাহিক ছুটি</li>\r\n\\r\\n\r\n<li>অন্যান্য ছুটি\\r\\n\r\n<ul>\\r\\n\r\n<li>উৎসব</li>\r\n\\r\\n\r\n<li>নৈমিত্তিক</li>\r\n\\r\\n</ul>\r\n\\r\\n</li>\r\n\\r\\n</ul>\r\n<p>\\r\\n</p>\r\n<p>৪। পরিচয়......</p>\r\n<p>\\r\\n</p>\r\n<p>&nbsp;</p>\r\n<p>\\r\\n</p>\r\n<p>ধন্যবাদ&nbsp;</p>\r\n<p>\\r\\n</p>\r\n<p style="text-align: right;">&nbsp;কতৃপক্ষ&nbsp; &nbsp; &nbsp; &nbsp;</p>'),
	(2, '17G100010N', '<center><strong>বেক্সিমকো ফ্যাশন লিমিটেড </strong></center><center><u> ১৭ ধানমন্ডি আর / এ, রোড নং ২, ঢাকা-১২০৫ </u></center>\r\n<p>তারিখঃ&nbsp; ২০১৮-০৭-১৭ ১২:৪৯:০৯</p>\r\n<p>জনাব/জনাবাঃ জান্নাত আরা</p>\r\n<p>পিতা/স্বামীর নামঃ ফজলুল করিম/জলিল উদ্দিন</p>\r\n<p>মাতার নামঃ উম্মে হাবিবা</p>\r\n<p>গ্রামঃনাজিরা-বাপারী পারা&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; ডাকঘরঃ কুড়িগ্রাম</p>\r\n<p>থানাঃ কুড়িগ্রাম সদর &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; জেলাঃ কুড়িগ্রাম</p>\r\n<p><span style="text-decoration: underline;"><strong>বিষয়ঃ- নিয়োগপত্র</strong></span></p>\r\n<p>কতৃপক্ষ অত্যন্ত আনন্দের সহিত আপনাকে নিম্নলিখিত শর্তসাপেক্ষে অত্র কারখানার উৎপাদন বিভাগে সিনিয়র অপারেটর পদে প্রতি মাসে সর্বসাকুল্যে মোট টাকা বেতনে ২০তম গ্রেডে নিয়োগ দেওয়ার সিদ্ধান্ত করিয়াছেন, যাহা ২০১৭-০৭-১৭ তারিখ হইতে কার্যকরী।</p>\r\n<p>১। আপনি চাকুরীতে প্রথম ০৩ (তিন) মাস প্রবেশনারী অবস্থায় থাকিবেন এবং উক্ত সময়ের মধ্যে আপনার কর্মদক্ষতা সন্তোষজনক না হইলে আপনার প্রবেশনকাল আরও তিন মাস বর্ধিত করা যেতে পারে। প্রবেশনকাল তিন মাস অতিবাহিত হওয়ার পর আপনি সরাসরি স্থায়ী বলে গণ্য হবেন।</p>\r\n<p>২। সাধারন কর্মঘন্টা ০৮ (আট) ঘন্টা এবং মধ্যাহ্ন বিরতি ৬০ মিনিট।</p>\r\n<p>৩। অতিরিক্ত সময় (ও.টি) ইহা মূল বেতনের দ্বিগুন। ( মূল বেতন/২০৮*২*মোট অতিরিক্ত ঘন্টা)।</p>\r\n<p>৪। সাধারণ ছুটিঃ-</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;১। শুক্রবার সাপ্তাহিক ছুটি।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;২। অন্যান্য ছুটি, (যাহা পূর্ণ বেতনে ভোগ করিতে পারিবেন।&nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;ক) উৎসব ছুটিঃ- ১১ দিন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;খ) নৈমিত্তিক ছুটিঃ- ১০ দিন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;গ) বার্ষিক ছুটিঃ- ০১ (এক) বৎসর অতিবাহিত হওয়ার পর আপনি প্রতি ১৮ কর্মদিবসের জন্য একদিন করে বার্ষিক ছুটী ভোগ করিতে পারিবেন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;ঘ) অসুস্থতা জনিত ছুটিঃ- অসুস্থতাজনিত ছুটি বৎসরে মোট ১৪ দিন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;ঙ) মাতৃত্ব কালীন ছুটিঃ- কোন মহিলা শ্রমিক যদি অত্র প্রতিষ্ঠানে অকাধিক্রমে ০৬ (ছয়) মাস চাকুরী করেন তাহলে তিনি উক্ত ছুটি ভোগ করিতে &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;পারিবেন।</p>\r\n<p>৪। পরিচয় পত্রঃ- আপনাকে পরিচয়পত্র দেওয়া হইবে। আপনি কারখানায় প্রবেশের পূর্বে এবং বের হওয়ার সময় পরিচয় পতের ইলেক্ট্রনিক হাজিরা মেশিনের দ্বারা পাঞ্চ করিবেন এবং উক্ত পাঞ্চ মেশিন থেকে আপনার মাসিক হাজিরা এবং অতিরিক্ত সময় বের করা হইবে।</p>\r\n<p>৬। প্রবেশনারী থাকাকালীন সময়ে কোম্পানী যে কোন সময় কোন প্রকার কারণ দর্শানো ব্যতীরেকে বিনা নোটিশে আপনার চাকরীর অবসান করিতে পারিবেন, অথবা আপনিও চাকরি থেকে স্বেচ্ছায় ইস্তফা দিতে পারিবেন।</p>\r\n<p>৭।&nbsp;চাকুরী স্থায়ী হইবার পর আপনি স্বেচ্ছায় চাকরী হইতে অব্যহতি নিতে চাইলে কতৃপক্ষ কে ৬০ (ষাট) দিন পূর্বে লিখিত নোটিশের মাধ্যমে জানাইতে হবে।</p>\r\n<p>৮। চাকুরী স্থায়ী হইবার পর কতৃপক্ষ আপনার চাকরীর অবসান করিতে চাহিলে ১২০ (একশত বিশ) দিনের লিখিত নোটিশ অথবা&nbsp;১২০ (একশত বিশ) দিনের বেতন প্রদান করিবেন।</p>\r\n<p>৯। আপনার চাকরী কোম্পানী কতৃক জারিকৃত বিধান ও বাংলাদেশের প্রচলিত শ্রম আইন দ্বারা পরিচালিত হইবে।</p>\r\n<p>১০। কতৃপক্ষ আপনাকে প্রয়োজন বোধে এই প্রতিষ্ঠাবের যে কোন বিভাগে অথবা বাংলাদেশে অবস্থিত যে কোন কারখানায়/অফিসে বদলী করিতে পারিবেন।</p>\r\n<p>১১। কোম্পানীর যাবতীয় নিয়মকানুন পরিবর্তনযোগ্য (যাহা দেশের প্রচলিত আইনের পরিপন্থি নহে) এবং আপনি পরিবর্তিত নিয়ম কানুন সর্বদা মানিয়া চলিতে&nbsp; &nbsp; &nbsp; &nbsp;বাধ্য থাকিবেন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;আপনার আই.ডি. নং- 17G100010N</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;আপনার জাতীয় পরিচয়পত্র নং- 123456789123456</p>\r\n<p>ধন্যবাদান্তে</p>\r\n<p>&nbsp; &nbsp;সংশ্লিষ্ট ব্যবস্থাপক</p>\r\n<p style="text-align: right;">কারখানা কতৃপক্ষ&nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n<p>&nbsp; &nbsp;অনুলিপিঃ</p>\r\n<p>&nbsp; &nbsp;১। হিসাব বিভাগ।</p>\r\n<p>&nbsp; &nbsp;২। ব্যক্তিগত নথি।</p>\r\n<p>আমি অত্র নিয়োগপত্র পাঠ করিয়া এবং ইহাতে বর্ণিত শর্তাদি সম্পূর্ণরুপে অবগত হইয়া এই নিয়োগপত্র গ্রহণ করিয়া স্বাক্ষর করিলাম।</p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: right;">&nbsp;শ্রমিকের স্বক্ষর&nbsp; &nbsp; &nbsp; &nbsp;</p>'),
	(3, '18A100009N', '<center><strong>বেক্সিমকো ফ্যাশন লিমিটেড </strong></center><center><u> ১৭ ধানমন্ডি আর / এ, রোড নং ২, ঢাকা-১২০৫ </u></center>\r\n<p>তারিখঃ&nbsp; ২০১৮-০৭-১৭ ১২:৫১:০৯</p>\r\n<p>জনাব/জনাবাঃ</p>\r\n<p>পিতা/স্বামীর নামঃ /</p>\r\n<p>মাতার নামঃ</p>\r\n<p>গ্রামঃ&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; ডাকঘরঃ</p>\r\n<p>থানাঃ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; জেলাঃ</p>\r\n<p><span style="text-decoration: underline;"><strong>বিষয়ঃ- নিয়োগপত্র</strong></span></p>\r\n<p>কতৃপক্ষ অত্যন্ত আনন্দের সহিত আপনাকে নিম্নলিখিত শর্তসাপেক্ষে অত্র কারখানার উৎপাদন বিভাগে কাটার ম্যান পদে প্রতি মাসে সর্বসাকুল্যে মোট ১০০০০ টাকা বেতনে ২০তম গ্রেডে নিয়োগ দেওয়ার সিদ্ধান্ত করিয়াছেন, যাহা ২০১৮-০১-১৭ তারিখ হইতে কার্যকরী।</p>\r\n<p>১। আপনি চাকুরীতে প্রথম ০৩ (তিন) মাস প্রবেশনারী অবস্থায় থাকিবেন এবং উক্ত সময়ের মধ্যে আপনার কর্মদক্ষতা সন্তোষজনক না হইলে আপনার প্রবেশনকাল আরও তিন মাস বর্ধিত করা যেতে পারে। প্রবেশনকাল তিন মাস অতিবাহিত হওয়ার পর আপনি সরাসরি স্থায়ী বলে গণ্য হবেন।</p>\r\n<p>২। সাধারন কর্মঘন্টা ০৮ (আট) ঘন্টা এবং মধ্যাহ্ন বিরতি ৬০ মিনিট।</p>\r\n<p>৩। অতিরিক্ত সময় (ও.টি) ইহা মূল বেতনের দ্বিগুন। ( মূল বেতন/২০৮*২*মোট অতিরিক্ত ঘন্টা)।</p>\r\n<p>৪। সাধারণ ছুটিঃ-</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;১। শুক্রবার সাপ্তাহিক ছুটি।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;২। অন্যান্য ছুটি, (যাহা পূর্ণ বেতনে ভোগ করিতে পারিবেন।&nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;ক) উৎসব ছুটিঃ- ১১ দিন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;খ) নৈমিত্তিক ছুটিঃ- ১০ দিন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;গ) বার্ষিক ছুটিঃ- ০১ (এক) বৎসর অতিবাহিত হওয়ার পর আপনি প্রতি ১৮ কর্মদিবসের জন্য একদিন করে বার্ষিক ছুটী ভোগ করিতে পারিবেন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;ঘ) অসুস্থতা জনিত ছুটিঃ- অসুস্থতাজনিত ছুটি বৎসরে মোট ১৪ দিন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;ঙ) মাতৃত্ব কালীন ছুটিঃ- কোন মহিলা শ্রমিক যদি অত্র প্রতিষ্ঠানে অকাধিক্রমে ০৬ (ছয়) মাস চাকুরী করেন তাহলে তিনি উক্ত ছুটি ভোগ করিতে &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;পারিবেন।</p>\r\n<p>৪। পরিচয় পত্রঃ- আপনাকে পরিচয়পত্র দেওয়া হইবে। আপনি কারখানায় প্রবেশের পূর্বে এবং বের হওয়ার সময় পরিচয় পতের ইলেক্ট্রনিক হাজিরা মেশিনের দ্বারা পাঞ্চ করিবেন এবং উক্ত পাঞ্চ মেশিন থেকে আপনার মাসিক হাজিরা এবং অতিরিক্ত সময় বের করা হইবে।</p>\r\n<p>৬। প্রবেশনারী থাকাকালীন সময়ে কোম্পানী যে কোন সময় কোন প্রকার কারণ দর্শানো ব্যতীরেকে বিনা নোটিশে আপনার চাকরীর অবসান করিতে পারিবেন, অথবা আপনিও চাকরি থেকে স্বেচ্ছায় ইস্তফা দিতে পারিবেন।</p>\r\n<p>৭।&nbsp;চাকুরী স্থায়ী হইবার পর আপনি স্বেচ্ছায় চাকরী হইতে অব্যহতি নিতে চাইলে কতৃপক্ষ কে ৬০ (ষাট) দিন পূর্বে লিখিত নোটিশের মাধ্যমে জানাইতে হবে।</p>\r\n<p>৮। চাকুরী স্থায়ী হইবার পর কতৃপক্ষ আপনার চাকরীর অবসান করিতে চাহিলে ১২০ (একশত বিশ) দিনের লিখিত নোটিশ অথবা&nbsp;১২০ (একশত বিশ) দিনের বেতন প্রদান করিবেন।</p>\r\n<p>৯। আপনার চাকরী কোম্পানী কতৃক জারিকৃত বিধান ও বাংলাদেশের প্রচলিত শ্রম আইন দ্বারা পরিচালিত হইবে।</p>\r\n<p>১০। কতৃপক্ষ আপনাকে প্রয়োজন বোধে এই প্রতিষ্ঠাবের যে কোন বিভাগে অথবা বাংলাদেশে অবস্থিত যে কোন কারখানায়/অফিসে বদলী করিতে পারিবেন।</p>\r\n<p>১১। কোম্পানীর যাবতীয় নিয়মকানুন পরিবর্তনযোগ্য (যাহা দেশের প্রচলিত আইনের পরিপন্থি নহে) এবং আপনি পরিবর্তিত নিয়ম কানুন সর্বদা মানিয়া চলিতে&nbsp; &nbsp; &nbsp; &nbsp;বাধ্য থাকিবেন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;আপনার আই.ডি. নং-</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;আপনার জাতীয় পরিচয়পত্র নং- 123456</p>\r\n<p>ধন্যবাদান্তে</p>\r\n<p>&nbsp; &nbsp;সংশ্লিষ্ট ব্যবস্থাপক</p>\r\n<p style="text-align: right;">কারখানা কতৃপক্ষ&nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n<p>&nbsp; &nbsp;অনুলিপিঃ</p>\r\n<p>&nbsp; &nbsp;১। হিসাব বিভাগ।</p>\r\n<p>&nbsp; &nbsp;২। ব্যক্তিগত নথি।</p>\r\n<p>আমি অত্র নিয়োগপত্র পাঠ করিয়া এবং ইহাতে বর্ণিত শর্তাদি সম্পূর্ণরুপে অবগত হইয়া এই নিয়োগপত্র গ্রহণ করিয়া স্বাক্ষর করিলাম।</p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: right;">&nbsp;শ্রমিকের স্বক্ষর&nbsp; &nbsp; &nbsp; &nbsp;</p>'),
	(4, '08E020001E', '<center></center><center><u> </u></center>\r\n<p>তারিখঃ&nbsp; ২০১৮-০৭-১৭ ১২:৫২:১৩</p>\r\n<p>জনাব/জনাবাঃ</p>\r\n<p>পিতা/স্বামীর নামঃ /</p>\r\n<p>মাতার নামঃ</p>\r\n<p>গ্রামঃ&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; ডাকঘরঃ</p>\r\n<p>থানাঃ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; জেলাঃ</p>\r\n<p><span style="text-decoration: underline;"><strong>বিষয়ঃ- নিয়োগপত্র</strong></span></p>\r\n<p>কতৃপক্ষ অত্যন্ত আনন্দের সহিত আপনাকে নিম্নলিখিত শর্তসাপেক্ষে অত্র কারখানার বিভাগে পদে প্রতি মাসে সর্বসাকুল্যে মোট টাকা বেতনে ২০তম গ্রেডে নিয়োগ দেওয়ার সিদ্ধান্ত করিয়াছেন, যাহা ২০০৮-০৫-০৮ তারিখ হইতে কার্যকরী।</p>\r\n<p>১। আপনি চাকুরীতে প্রথম ০৩ (তিন) মাস প্রবেশনারী অবস্থায় থাকিবেন এবং উক্ত সময়ের মধ্যে আপনার কর্মদক্ষতা সন্তোষজনক না হইলে আপনার প্রবেশনকাল আরও তিন মাস বর্ধিত করা যেতে পারে। প্রবেশনকাল তিন মাস অতিবাহিত হওয়ার পর আপনি সরাসরি স্থায়ী বলে গণ্য হবেন।</p>\r\n<p>২। সাধারন কর্মঘন্টা ০৮ (আট) ঘন্টা এবং মধ্যাহ্ন বিরতি ৬০ মিনিট।</p>\r\n<p>৩। অতিরিক্ত সময় (ও.টি) ইহা মূল বেতনের দ্বিগুন। ( মূল বেতন/২০৮*২*মোট অতিরিক্ত ঘন্টা)।</p>\r\n<p>৪। সাধারণ ছুটিঃ-</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;১। শুক্রবার সাপ্তাহিক ছুটি।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;২। অন্যান্য ছুটি, (যাহা পূর্ণ বেতনে ভোগ করিতে পারিবেন।&nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;ক) উৎসব ছুটিঃ- ১১ দিন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;খ) নৈমিত্তিক ছুটিঃ- ১০ দিন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;গ) বার্ষিক ছুটিঃ- ০১ (এক) বৎসর অতিবাহিত হওয়ার পর আপনি প্রতি ১৮ কর্মদিবসের জন্য একদিন করে বার্ষিক ছুটী ভোগ করিতে পারিবেন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;ঘ) অসুস্থতা জনিত ছুটিঃ- অসুস্থতাজনিত ছুটি বৎসরে মোট ১৪ দিন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;ঙ) মাতৃত্ব কালীন ছুটিঃ- কোন মহিলা শ্রমিক যদি অত্র প্রতিষ্ঠানে অকাধিক্রমে ০৬ (ছয়) মাস চাকুরী করেন তাহলে তিনি উক্ত ছুটি ভোগ করিতে &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;পারিবেন।</p>\r\n<p>৪। পরিচয় পত্রঃ- আপনাকে পরিচয়পত্র দেওয়া হইবে। আপনি কারখানায় প্রবেশের পূর্বে এবং বের হওয়ার সময় পরিচয় পতের ইলেক্ট্রনিক হাজিরা মেশিনের দ্বারা পাঞ্চ করিবেন এবং উক্ত পাঞ্চ মেশিন থেকে আপনার মাসিক হাজিরা এবং অতিরিক্ত সময় বের করা হইবে।</p>\r\n<p>৬। প্রবেশনারী থাকাকালীন সময়ে কোম্পানী যে কোন সময় কোন প্রকার কারণ দর্শানো ব্যতীরেকে বিনা নোটিশে আপনার চাকরীর অবসান করিতে পারিবেন, অথবা আপনিও চাকরি থেকে স্বেচ্ছায় ইস্তফা দিতে পারিবেন।</p>\r\n<p>৭।&nbsp;চাকুরী স্থায়ী হইবার পর আপনি স্বেচ্ছায় চাকরী হইতে অব্যহতি নিতে চাইলে কতৃপক্ষ কে ৬০ (ষাট) দিন পূর্বে লিখিত নোটিশের মাধ্যমে জানাইতে হবে।</p>\r\n<p>৮। চাকুরী স্থায়ী হইবার পর কতৃপক্ষ আপনার চাকরীর অবসান করিতে চাহিলে ১২০ (একশত বিশ) দিনের লিখিত নোটিশ অথবা&nbsp;১২০ (একশত বিশ) দিনের বেতন প্রদান করিবেন।</p>\r\n<p>৯। আপনার চাকরী কোম্পানী কতৃক জারিকৃত বিধান ও বাংলাদেশের প্রচলিত শ্রম আইন দ্বারা পরিচালিত হইবে।</p>\r\n<p>১০। কতৃপক্ষ আপনাকে প্রয়োজন বোধে এই প্রতিষ্ঠাবের যে কোন বিভাগে অথবা বাংলাদেশে অবস্থিত যে কোন কারখানায়/অফিসে বদলী করিতে পারিবেন।</p>\r\n<p>১১। কোম্পানীর যাবতীয় নিয়মকানুন পরিবর্তনযোগ্য (যাহা দেশের প্রচলিত আইনের পরিপন্থি নহে) এবং আপনি পরিবর্তিত নিয়ম কানুন সর্বদা মানিয়া চলিতে&nbsp; &nbsp; &nbsp; &nbsp;বাধ্য থাকিবেন।</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;আপনার আই.ডি. নং-</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;আপনার জাতীয় পরিচয়পত্র নং-</p>\r\n<p>ধন্যবাদান্তে</p>\r\n<p>&nbsp; &nbsp;সংশ্লিষ্ট ব্যবস্থাপক</p>\r\n<p style="text-align: right;">কারখানা কতৃপক্ষ&nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n<p>&nbsp; &nbsp;অনুলিপিঃ</p>\r\n<p>&nbsp; &nbsp;১। হিসাব বিভাগ।</p>\r\n<p>&nbsp; &nbsp;২। ব্যক্তিগত নথি।</p>\r\n<p>আমি অত্র নিয়োগপত্র পাঠ করিয়া এবং ইহাতে বর্ণিত শর্তাদি সম্পূর্ণরুপে অবগত হইয়া এই নিয়োগপত্র গ্রহণ করিয়া স্বাক্ষর করিলাম।</p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: right;">&nbsp;শ্রমিকের স্বক্ষর&nbsp; &nbsp; &nbsp; &nbsp;</p>');
/*!40000 ALTER TABLE `hr_letter` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_line
DROP TABLE IF EXISTS `hr_line`;
CREATE TABLE IF NOT EXISTS `hr_line` (
  `hr_line_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_line_unit_id` int(11) NOT NULL,
  `hr_line_floor_id` int(11) NOT NULL,
  `hr_line_name` varchar(128) DEFAULT NULL,
  `hr_line_name_bn` varchar(255) DEFAULT NULL,
  `hr_line_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hr_line_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_line: ~2 rows (approximately)
DELETE FROM `hr_line`;
/*!40000 ALTER TABLE `hr_line` DISABLE KEYS */;
INSERT INTO `hr_line` (`hr_line_id`, `hr_line_unit_id`, `hr_line_floor_id`, `hr_line_name`, `hr_line_name_bn`, `hr_line_status`) VALUES
	(25, 3, 21, 'A1', NULL, 1),
	(26, 3, 21, 'A2', NULL, 1);
/*!40000 ALTER TABLE `hr_line` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_loan_application
DROP TABLE IF EXISTS `hr_loan_application`;
CREATE TABLE IF NOT EXISTS `hr_loan_application` (
  `hr_la_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_la_as_id` varchar(10) NOT NULL COMMENT 'employee ID No',
  `hr_la_name` varchar(150) NOT NULL,
  `hr_la_designation` varchar(150) NOT NULL,
  `hr_la_date_of_join` date NOT NULL,
  `hr_la_applied_amount` float NOT NULL,
  `hr_la_approved_amount` float DEFAULT NULL,
  `hr_la_no_of_installments` int(11) NOT NULL,
  `hr_la_no_of_installments_approved` int(11) DEFAULT NULL,
  `hr_la_applied_date` date DEFAULT NULL,
  `hr_la_type_of_loan` varchar(64) DEFAULT NULL,
  `hr_la_purpose_of_loan` varchar(512) NOT NULL,
  `hr_la_note` varchar(1024) DEFAULT NULL,
  `hr_la_supervisors_comment` varchar(255) DEFAULT NULL,
  `hr_la_updated_at` datetime DEFAULT NULL,
  `hr_la_status` int(1) NOT NULL DEFAULT '0' COMMENT '0= Applied, 1= Approved, 2=Declined',
  PRIMARY KEY (`hr_la_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_loan_application: ~1 rows (approximately)
DELETE FROM `hr_loan_application`;
/*!40000 ALTER TABLE `hr_loan_application` DISABLE KEYS */;
INSERT INTO `hr_loan_application` (`hr_la_id`, `hr_la_as_id`, `hr_la_name`, `hr_la_designation`, `hr_la_date_of_join`, `hr_la_applied_amount`, `hr_la_approved_amount`, `hr_la_no_of_installments`, `hr_la_no_of_installments_approved`, `hr_la_applied_date`, `hr_la_type_of_loan`, `hr_la_purpose_of_loan`, `hr_la_note`, `hr_la_supervisors_comment`, `hr_la_updated_at`, `hr_la_status`) VALUES
	(1, '17F005001B', 'MBM IT', 'Offiece Boy', '2017-06-17', 100000, 100000, 5000, 5000, '2018-07-21', 'Home Loan', 'Education, ', NULL, 'ok', '2018-07-25 11:18:40', 1);
/*!40000 ALTER TABLE `hr_loan_application` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_loan_type
DROP TABLE IF EXISTS `hr_loan_type`;
CREATE TABLE IF NOT EXISTS `hr_loan_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_loan_type_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_loan_type: ~2 rows (approximately)
DELETE FROM `hr_loan_type`;
/*!40000 ALTER TABLE `hr_loan_type` DISABLE KEYS */;
INSERT INTO `hr_loan_type` (`id`, `hr_loan_type_name`) VALUES
	(1, 'Home Loan'),
	(2, 'House Building');
/*!40000 ALTER TABLE `hr_loan_type` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_medical_incident
DROP TABLE IF EXISTS `hr_medical_incident`;
CREATE TABLE IF NOT EXISTS `hr_medical_incident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_med_incident_as_id` varchar(10) NOT NULL,
  `hr_med_incident_as_name` varchar(128) NOT NULL,
  `hr_med_incident_date` date DEFAULT NULL,
  `hr_med_incident_details` varchar(256) DEFAULT NULL,
  `hr_med_incident_doctors_name` varchar(128) DEFAULT NULL,
  `hr_med_incident_doctors_recommendation` varchar(128) DEFAULT NULL,
  `hr_med_incident_supporting_file` varchar(128) DEFAULT NULL,
  `hr_med_incident_action` varchar(128) DEFAULT NULL,
  `hr_med_incident_allowance` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_medical_incident: ~3 rows (approximately)
DELETE FROM `hr_medical_incident`;
/*!40000 ALTER TABLE `hr_medical_incident` DISABLE KEYS */;
INSERT INTO `hr_medical_incident` (`id`, `hr_med_incident_as_id`, `hr_med_incident_as_name`, `hr_med_incident_date`, `hr_med_incident_details`, `hr_med_incident_doctors_name`, `hr_med_incident_doctors_recommendation`, `hr_med_incident_supporting_file`, `hr_med_incident_action`, `hr_med_incident_allowance`) VALUES
	(9, '10M005001B', 'Khaled Al Mamun', '2018-07-05', 'Stomach Upset', NULL, NULL, NULL, 'Leave', NULL),
	(10, '18A100001N', 'SAHERA KHATUN', '2018-07-22', 'neck pain\\\\;;', 'Mr. Aminul', 'Full bed rest ,.\\', NULL, 'Give her 10 days leave;;;', 10000),
	(11, '17F005001B', 'MBM IT', '2018-07-22', 'FGFDFGHGF', 'sdfd', 'Full bed rest ,.\\', NULL, 'Give her 10 days leave;;;', 800);
/*!40000 ALTER TABLE `hr_medical_incident` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_med_info
DROP TABLE IF EXISTS `hr_med_info`;
CREATE TABLE IF NOT EXISTS `hr_med_info` (
  `med_id` int(11) NOT NULL AUTO_INCREMENT,
  `med_as_id` varchar(11) NOT NULL,
  `med_height` varchar(50) NOT NULL,
  `med_weight` varchar(50) NOT NULL,
  `med_tooth_str` varchar(124) NOT NULL DEFAULT 'N/A',
  `med_blood_group` varchar(10) NOT NULL,
  `med_ident_mark` varchar(256) DEFAULT NULL,
  `med_others` varchar(256) DEFAULT 'N/A',
  `med_doct_comment` varchar(256) NOT NULL,
  `med_doct_conf_age` varchar(124) NOT NULL,
  `med_signature` varchar(256) DEFAULT NULL,
  `med_auth_signature` varchar(256) DEFAULT NULL,
  `med_doct_signature` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`med_id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_med_info: ~74 rows (approximately)
DELETE FROM `hr_med_info`;
/*!40000 ALTER TABLE `hr_med_info` DISABLE KEYS */;
INSERT INTO `hr_med_info` (`med_id`, `med_as_id`, `med_height`, `med_weight`, `med_tooth_str`, `med_blood_group`, `med_ident_mark`, `med_others`, `med_doct_comment`, `med_doct_conf_age`, `med_signature`, `med_auth_signature`, `med_doct_signature`) VALUES
	(18, '17F005001B', '65', '70', 'Enamel', 'A+', 'N/A', 'N/A', 'fit', '21-25', NULL, NULL, '/assets/images/employee/med_info/5b4d79722fc50.png'),
	(22, '18A100001N', '5 FEET', '60', 'N/A', 'A+', 'N/A', 'N/A', 'N/A', '31-35', NULL, NULL, NULL),
	(23, '18A100002N', '6FEET', '60', 'N/A', 'A+', 'N/A', 'N/A', 'N/A', '26-30', NULL, NULL, NULL),
	(24, '18A100003N', '5 FEET', '45', 'N/A', 'A+', 'N/A', 'N/A', 'N/A', '21-25', NULL, NULL, NULL),
	(25, '18A100004N', '5 FEET', '60', 'N/A', 'A+', 'N/A', 'N/A', 'N/A', '26-30', NULL, NULL, NULL),
	(26, '18A100005N', '5 FEET', '60', 'N/A', 'A+', 'N/A', 'N/A', 'N/A', '21-25', NULL, NULL, NULL),
	(27, '18A100006N', '5 FEET', '60', 'N/A', 'A+', 'N/A', 'N/A', 'N/A', '26-30', NULL, NULL, NULL),
	(28, '18A100007N', '5 FEET', '60', 'N/A', 'A+', 'N/A', 'N/A', 'N/A', '26-30', NULL, NULL, NULL),
	(29, '18A100008N', '5 FEET', '60', 'N/A', 'A+', 'N/A', 'N/A', 'N/A', '26-30', NULL, NULL, NULL),
	(30, '18A100009N', '5 FEET', '60', 'N/A', 'A+', 'N/A', 'N/A', 'N/A', '26-30', NULL, NULL, NULL),
	(31, '18A100010N', '5 FEET', '60', 'N/A', 'A+', 'N/A', 'N/A', 'N/A', '26-30', NULL, NULL, NULL),
	(32, '18G100011N', '6 feet', '65', 'N/A', 'A+', 'N/A', 'N/A', 'N/A', '26-30', NULL, NULL, NULL),
	(33, '18G100012N', '5\'', '50', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
	(34, '18M100013N', '5\'3"', '54', 'N/A', 'O+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(35, '18G100014N', '5\'', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
	(36, '18G100015N', '5\'', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(37, '18A100016N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(38, '18A100017N', '5\'', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(39, '18C100018N', '5\'6"', '60', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
	(40, '18A100019N', '5\'', '54', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
	(41, '18A100020N', '5\'1"', '52', 'N/A', 'O+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(42, '18A100021N', '5\'6"', '60', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
	(43, '18A100022N', '5\'', '53', 'N/A', 'B+', 'N/A', 'N/A', 'Accepted', '36-40', NULL, NULL, NULL),
	(44, '18C100023N', '5\'6"', '65', 'N/A', 'B+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(45, '18G100024N', '5\'1"', '53', 'N/A', 'B+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(46, '18A100025N', '5\'', '56', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(47, '18C100026N', '5\'5"', '65', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(48, '18B100027N', '5\'6"', '65', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(49, '18C100028N', '5\'', '51', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
	(50, '18A100029N', '5\'', '53', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(51, '18B100030N', '5\'6"', '65', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(52, '17K100031N', '5\'', '50', 'N/A', 'AB+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(53, '18C100032N', '5\'', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(54, '18B100033N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
	(55, '18B100034N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
	(56, '18C100035N', '5\'', '53', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '36-40', NULL, NULL, NULL),
	(57, '18D100036N', '5\'6"', '66', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(58, '18A100037N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(59, '18G100038N', '5\'1"', '54', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(60, '18A100039N', '5\'1"', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(61, '18A100040N', '5\'', '53', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(62, '18C100041N', '5\'1"', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(63, '18G100042N', '5\'1"', '61', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(64, '18G100043N', '5\'', '50', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
	(65, '18D100044N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '41-45', NULL, NULL, NULL),
	(66, '18B100045N', '5\'', '51', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
	(67, '18C100046N', '5\'1"', '54', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(68, '18D100047N', '5\'', '53', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
	(69, '18B100048N', '5\'', '58', 'N/A', 'B+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
	(70, '18B100049N', '5\'1"', '52', 'N/A', 'O+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(71, '18C100050N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(72, '18C100051N', '5\'2"', '59', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(73, '18G100052N', '5\'1"', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
	(74, '18B100053N', '5\'1"', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(75, '18C100054N', '5\'1"', '60', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(76, '18D100055N', '5\'1"', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(77, '18A100056N', '5\'2"', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
	(78, '18C100057N', '5\'', '56', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(79, '18G100058N', '5\'1"', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(80, '18C100059N', '5\'1"', '53', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '36-40', NULL, NULL, NULL),
	(81, '18E100060N', '5\'1"', '51', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
	(82, '18C100061N', '5\'', '50', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
	(83, '18B100062N', '5\'1"', '52', 'N/A', 'B+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(84, '18D100063N', '5\'2"', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(85, '18C100064N', '5\'6"', '65', 'N/A', 'A+', 'N/A', 'N/A', 'Acceppted', '18-20', NULL, NULL, NULL),
	(86, '18B100065N', '5\'1"', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(87, '18G100066N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
	(88, '18A100067N', '5\'', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
	(89, '18C100068N', '5\'1"', '58', 'N/A', 'B+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(90, '18D100069N', '5\'6"', '60', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
	(91, '18G100070N', '5\'1"', '55', 'N/A', 'O+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(92, '18A100071N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '36-40', NULL, NULL, NULL),
	(93, '18A100072N', '5\'1"', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
	(94, '18A100073N', '5\'', '54', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL);
/*!40000 ALTER TABLE `hr_med_info` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_nominee
DROP TABLE IF EXISTS `hr_nominee`;
CREATE TABLE IF NOT EXISTS `hr_nominee` (
  `nom_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_as_id` varchar(10) NOT NULL,
  `nom_name` varchar(64) DEFAULT NULL,
  `nom_relation` varchar(64) DEFAULT NULL,
  `nom_ben` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_nominee: ~0 rows (approximately)
DELETE FROM `hr_nominee`;
/*!40000 ALTER TABLE `hr_nominee` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_nominee` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_ot
DROP TABLE IF EXISTS `hr_ot`;
CREATE TABLE IF NOT EXISTS `hr_ot` (
  `hr_ot_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_ot_as_id` varchar(10) NOT NULL,
  `hr_ot_date` date NOT NULL,
  `hr_ot_hour` int(11) NOT NULL,
  PRIMARY KEY (`hr_ot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_ot: ~1 rows (approximately)
DELETE FROM `hr_ot`;
/*!40000 ALTER TABLE `hr_ot` DISABLE KEYS */;
INSERT INTO `hr_ot` (`hr_ot_id`, `hr_ot_as_id`, `hr_ot_date`, `hr_ot_hour`) VALUES
	(1, '18A100006N', '2018-07-18', 3);
/*!40000 ALTER TABLE `hr_ot` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_performance_appraisal
DROP TABLE IF EXISTS `hr_performance_appraisal`;
CREATE TABLE IF NOT EXISTS `hr_performance_appraisal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hr_pa_as_id` varchar(10) DEFAULT NULL,
  `hr_pa_report_from` date DEFAULT NULL,
  `hr_pa_report_to` date DEFAULT NULL,
  `hr_pa_punctuality` tinyint(1) DEFAULT '0',
  `hr_pa_reasoning` tinyint(1) DEFAULT '0',
  `hr_pa_job_acceptance` tinyint(1) DEFAULT '0',
  `hr_pa_owner_sense` tinyint(1) DEFAULT '0',
  `hr_pa_rw_sense` tinyint(1) DEFAULT '0',
  `hr_pa_idea_thought` tinyint(1) DEFAULT '0',
  `hr_pa_coleague_interaction` tinyint(1) DEFAULT '0',
  `hr_pa_meet_kpi` tinyint(1) DEFAULT '0',
  `hr_pa_communication` tinyint(1) DEFAULT '0',
  `hr_pa_cause_analysis` tinyint(1) DEFAULT '0',
  `hr_pa_professionality` tinyint(1) DEFAULT '0',
  `hr_pa_target_set` tinyint(1) DEFAULT '0',
  `hr_pa_job_interest` tinyint(1) DEFAULT '0',
  `hr_pa_out_perform` tinyint(1) DEFAULT '0',
  `hr_pa_team_work` tinyint(1) DEFAULT '0',
  `hr_pa_primary_assesment` tinyint(1) DEFAULT NULL COMMENT '0, 1, 2, 3',
  `hr_pa_first_attribute` varchar(255) DEFAULT NULL,
  `hr_pa_second_attribute` varchar(255) DEFAULT NULL,
  `hr_pa_third_attribute` varchar(255) DEFAULT NULL,
  `hr_pa_long_retention` tinyint(1) DEFAULT '0',
  `hr_pa_promotion_recommendation` tinyint(1) DEFAULT '0',
  `hr_pa_replacement` tinyint(1) DEFAULT '0',
  `hr_pa_remarks_dept_head` varchar(255) DEFAULT NULL,
  `hr_pa_remarks_hr_head` varchar(255) DEFAULT NULL,
  `hr_pa_remarks_incharge` varchar(255) DEFAULT NULL,
  `hr_pa_remarks_ceo` varchar(255) DEFAULT NULL,
  `hr_pa_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_performance_appraisal: ~1 rows (approximately)
DELETE FROM `hr_performance_appraisal`;
/*!40000 ALTER TABLE `hr_performance_appraisal` DISABLE KEYS */;
INSERT INTO `hr_performance_appraisal` (`id`, `hr_pa_as_id`, `hr_pa_report_from`, `hr_pa_report_to`, `hr_pa_punctuality`, `hr_pa_reasoning`, `hr_pa_job_acceptance`, `hr_pa_owner_sense`, `hr_pa_rw_sense`, `hr_pa_idea_thought`, `hr_pa_coleague_interaction`, `hr_pa_meet_kpi`, `hr_pa_communication`, `hr_pa_cause_analysis`, `hr_pa_professionality`, `hr_pa_target_set`, `hr_pa_job_interest`, `hr_pa_out_perform`, `hr_pa_team_work`, `hr_pa_primary_assesment`, `hr_pa_first_attribute`, `hr_pa_second_attribute`, `hr_pa_third_attribute`, `hr_pa_long_retention`, `hr_pa_promotion_recommendation`, `hr_pa_replacement`, `hr_pa_remarks_dept_head`, `hr_pa_remarks_hr_head`, `hr_pa_remarks_incharge`, `hr_pa_remarks_ceo`, `hr_pa_status`) VALUES
	(1, '18G100011N', '2018-07-01', '2018-07-31', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 'sdgd-', 'dgd-', 'xvbxb-', 1, 1, 1, 'xvbxb-', 'good', 'avarage', 'good', 1);
/*!40000 ALTER TABLE `hr_performance_appraisal` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_promotion
DROP TABLE IF EXISTS `hr_promotion`;
CREATE TABLE IF NOT EXISTS `hr_promotion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `associate_id` varchar(10) NOT NULL,
  `previous_designation_id` int(11) NOT NULL,
  `current_designation_id` int(11) NOT NULL,
  `eligible_date` date NOT NULL,
  `effective_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_promotion: ~4 rows (approximately)
DELETE FROM `hr_promotion`;
/*!40000 ALTER TABLE `hr_promotion` DISABLE KEYS */;
INSERT INTO `hr_promotion` (`id`, `associate_id`, `previous_designation_id`, `current_designation_id`, `eligible_date`, `effective_date`, `status`) VALUES
	(5, '17F005001B', 27, 26, '2018-06-17', '2018-07-17', 1),
	(6, '17F005001B', 27, 29, '2018-06-17', '2018-07-17', 1),
	(7, '17F005001B', 29, 26, '2018-06-17', '2018-07-30', 1),
	(8, '17F005001B', 26, 25, '2018-06-17', '2018-07-30', 1);
/*!40000 ALTER TABLE `hr_promotion` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_salary_structure
DROP TABLE IF EXISTS `hr_salary_structure`;
CREATE TABLE IF NOT EXISTS `hr_salary_structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `basic` float NOT NULL,
  `house_rent` float NOT NULL,
  `medical` float NOT NULL,
  `transport` float NOT NULL,
  `food` float NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_salary_structure: ~1 rows (approximately)
DELETE FROM `hr_salary_structure`;
/*!40000 ALTER TABLE `hr_salary_structure` DISABLE KEYS */;
INSERT INTO `hr_salary_structure` (`id`, `basic`, `house_rent`, `medical`, `transport`, `food`, `updated_at`, `updated_by`, `status`) VALUES
	(2, 60, 10, 10, 10, 10, '2018-07-16 11:02:37', '18D002012H', 1);
/*!40000 ALTER TABLE `hr_salary_structure` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_section
DROP TABLE IF EXISTS `hr_section`;
CREATE TABLE IF NOT EXISTS `hr_section` (
  `hr_section_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_section_area_id` int(11) DEFAULT NULL,
  `hr_section_department_id` int(11) DEFAULT NULL,
  `hr_section_name` varchar(128) DEFAULT NULL,
  `hr_section_name_bn` varchar(255) DEFAULT NULL,
  `hr_section_code` varchar(10) DEFAULT NULL,
  `hr_section_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`hr_section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_section: ~1 rows (approximately)
DELETE FROM `hr_section`;
/*!40000 ALTER TABLE `hr_section` DISABLE KEYS */;
INSERT INTO `hr_section` (`hr_section_id`, `hr_section_area_id`, `hr_section_department_id`, `hr_section_name`, `hr_section_name_bn`, `hr_section_code`, `hr_section_status`) VALUES
	(21, 2, 25, 'Sewing', 'সেলাই', 'A', 1);
/*!40000 ALTER TABLE `hr_section` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_shift
DROP TABLE IF EXISTS `hr_shift`;
CREATE TABLE IF NOT EXISTS `hr_shift` (
  `hr_shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_shift_unit_id` int(11) NOT NULL,
  `hr_shift_name` varchar(128) DEFAULT NULL,
  `hr_shift_name_bn` varchar(255) DEFAULT NULL,
  `hr_shift_code` varchar(4) NOT NULL,
  `hr_shift_start_time` time NOT NULL,
  `hr_shift_end_time` time NOT NULL,
  `hr_shift_break_time` int(11) DEFAULT NULL,
  `hr_shift_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hr_shift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_shift: ~1 rows (approximately)
DELETE FROM `hr_shift`;
/*!40000 ALTER TABLE `hr_shift` DISABLE KEYS */;
INSERT INTO `hr_shift` (`hr_shift_id`, `hr_shift_unit_id`, `hr_shift_name`, `hr_shift_name_bn`, `hr_shift_code`, `hr_shift_start_time`, `hr_shift_end_time`, `hr_shift_break_time`, `hr_shift_status`) VALUES
	(3, 3, 'Day', NULL, 'A', '08:00:00', '16:00:00', 60, 1);
/*!40000 ALTER TABLE `hr_shift` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_shift_roaster
DROP TABLE IF EXISTS `hr_shift_roaster`;
CREATE TABLE IF NOT EXISTS `hr_shift_roaster` (
  `shift_roaster_id` int(11) NOT NULL AUTO_INCREMENT,
  `shift_roaster_associate_id` varchar(10) NOT NULL,
  `shift_roaster_user_id` int(11) DEFAULT NULL,
  `shift_roaster_year` int(4) NOT NULL,
  `shift_roaster_month` int(2) NOT NULL,
  `day_1` varchar(4) DEFAULT NULL,
  `day_2` varchar(4) DEFAULT NULL,
  `day_3` varchar(4) DEFAULT NULL,
  `day_4` varchar(4) DEFAULT NULL,
  `day_5` varchar(4) DEFAULT NULL,
  `day_6` varchar(4) DEFAULT NULL,
  `day_7` varchar(4) DEFAULT NULL,
  `day_8` varchar(4) DEFAULT NULL,
  `day_9` varchar(4) DEFAULT NULL,
  `day_10` varchar(4) DEFAULT NULL,
  `day_11` varchar(4) DEFAULT NULL,
  `day_12` varchar(4) DEFAULT NULL,
  `day_13` varchar(4) DEFAULT NULL,
  `day_14` varchar(4) DEFAULT NULL,
  `day_15` varchar(4) DEFAULT NULL,
  `day_16` varchar(4) DEFAULT NULL,
  `day_17` varchar(4) DEFAULT NULL,
  `day_18` varchar(4) DEFAULT NULL,
  `day_19` varchar(4) DEFAULT NULL,
  `day_20` varchar(4) DEFAULT NULL,
  `day_21` varchar(4) DEFAULT NULL,
  `day_22` varchar(4) DEFAULT NULL,
  `day_23` varchar(4) DEFAULT NULL,
  `day_24` varchar(4) DEFAULT NULL,
  `day_25` varchar(4) DEFAULT NULL,
  `day_26` varchar(4) DEFAULT NULL,
  `day_27` varchar(4) DEFAULT NULL,
  `day_28` varchar(4) DEFAULT NULL,
  `day_29` varchar(4) DEFAULT NULL,
  `day_30` varchar(4) DEFAULT NULL,
  `day_31` varchar(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`shift_roaster_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- Dumping data for table mbmerp.hr_shift_roaster: 11 rows
DELETE FROM `hr_shift_roaster`;
/*!40000 ALTER TABLE `hr_shift_roaster` DISABLE KEYS */;
INSERT INTO `hr_shift_roaster` (`shift_roaster_id`, `shift_roaster_associate_id`, `shift_roaster_user_id`, `shift_roaster_year`, `shift_roaster_month`, `day_1`, `day_2`, `day_3`, `day_4`, `day_5`, `day_6`, `day_7`, `day_8`, `day_9`, `day_10`, `day_11`, `day_12`, `day_13`, `day_14`, `day_15`, `day_16`, `day_17`, `day_18`, `day_19`, `day_20`, `day_21`, `day_22`, `day_23`, `day_24`, `day_25`, `day_26`, `day_27`, `day_28`, `day_29`, `day_30`, `day_31`, `updated_at`, `status`) VALUES
	(38, '18A100006N', 51, 2018, 7, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', '2018-07-19 05:25:27', 0),
	(37, '18A100005N', 50, 2018, 7, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', '2018-07-19 05:25:27', 0),
	(36, '18A100004N', 49, 2018, 7, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', '2018-07-19 05:25:27', 0),
	(35, '18A100003N', 48, 2018, 7, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', '2018-07-19 05:25:27', 0),
	(34, '18A100002N', 47, 2018, 7, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', '2018-07-19 05:25:27', 0),
	(33, '18A100001N', 46, 2018, 7, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', '2018-07-19 05:25:27', 0),
	(32, '18G100011N', 56, 2018, 7, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', '2018-07-19 04:48:09', 0),
	(39, '18A100007N', 52, 2018, 7, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', '2018-07-19 05:25:27', 0),
	(40, '18A100008N', 53, 2018, 7, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', '2018-07-19 05:25:27', 0),
	(41, '18A100009N', 54, 2018, 7, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', '2018-07-19 05:25:27', 0),
	(42, '18A100010N', 55, 2018, 7, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', '2018-07-19 05:25:27', 0);
/*!40000 ALTER TABLE `hr_shift_roaster` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_subsection
DROP TABLE IF EXISTS `hr_subsection`;
CREATE TABLE IF NOT EXISTS `hr_subsection` (
  `hr_subsec_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_subsec_area_id` int(11) DEFAULT NULL,
  `hr_subsec_department_id` int(11) DEFAULT NULL,
  `hr_subsec_section_id` int(11) DEFAULT NULL,
  `hr_subsec_name` varchar(128) DEFAULT NULL,
  `hr_subsec_name_bn` varchar(255) DEFAULT NULL,
  `hr_subsec_code` varchar(10) DEFAULT NULL,
  `hr_subsec_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hr_subsec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_subsection: ~1 rows (approximately)
DELETE FROM `hr_subsection`;
/*!40000 ALTER TABLE `hr_subsection` DISABLE KEYS */;
INSERT INTO `hr_subsection` (`hr_subsec_id`, `hr_subsec_area_id`, `hr_subsec_department_id`, `hr_subsec_section_id`, `hr_subsec_name`, `hr_subsec_name_bn`, `hr_subsec_code`, `hr_subsec_status`) VALUES
	(21, 2, 25, 21, 'Operator', 'অপারেটর', 'A', 1);
/*!40000 ALTER TABLE `hr_subsection` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_training
DROP TABLE IF EXISTS `hr_training`;
CREATE TABLE IF NOT EXISTS `hr_training` (
  `tr_id` int(11) NOT NULL AUTO_INCREMENT,
  `tr_as_tr_id` int(11) NOT NULL,
  `tr_trainer_name` varchar(128) NOT NULL,
  `tr_description` varchar(1024) NOT NULL,
  `tr_start_date` date DEFAULT NULL,
  `tr_start_time` varchar(10) DEFAULT NULL,
  `tr_end_date` date DEFAULT NULL,
  `tr_end_time` varchar(10) DEFAULT NULL,
  `tr_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_training: ~1 rows (approximately)
DELETE FROM `hr_training`;
/*!40000 ALTER TABLE `hr_training` DISABLE KEYS */;
INSERT INTO `hr_training` (`tr_id`, `tr_as_tr_id`, `tr_trainer_name`, `tr_description`, `tr_start_date`, `tr_start_time`, `tr_end_date`, `tr_end_time`, `tr_status`) VALUES
	(1, 1, 'SDGTFDG', 'DSGFDG', '2018-07-22', '10:00', '2018-07-25', '02:00', 1);
/*!40000 ALTER TABLE `hr_training` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_training_assign
DROP TABLE IF EXISTS `hr_training_assign`;
CREATE TABLE IF NOT EXISTS `hr_training_assign` (
  `tr_as_id` int(11) NOT NULL AUTO_INCREMENT,
  `tr_as_tr_id` int(11) NOT NULL,
  `tr_as_ass_id` varchar(10) NOT NULL,
  `tr_as_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tr_as_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_training_assign: ~2 rows (approximately)
DELETE FROM `hr_training_assign`;
/*!40000 ALTER TABLE `hr_training_assign` DISABLE KEYS */;
INSERT INTO `hr_training_assign` (`tr_as_id`, `tr_as_tr_id`, `tr_as_ass_id`, `tr_as_status`) VALUES
	(1, 1, '17F005001B', 1),
	(2, 1, '18A100002N', 1);
/*!40000 ALTER TABLE `hr_training_assign` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_training_names
DROP TABLE IF EXISTS `hr_training_names`;
CREATE TABLE IF NOT EXISTS `hr_training_names` (
  `hr_tr_name_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_tr_name` varchar(255) NOT NULL,
  `hr_tr_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hr_tr_name_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_training_names: ~8 rows (approximately)
DELETE FROM `hr_training_names`;
/*!40000 ALTER TABLE `hr_training_names` DISABLE KEYS */;
INSERT INTO `hr_training_names` (`hr_tr_name_id`, `hr_tr_name`, `hr_tr_status`) VALUES
	(1, 'Anti Drug', 1),
	(2, 'Safety Committee', 1),
	(3, 'Freedom of Association', 1),
	(4, 'Root Cause Analysis', 1),
	(5, 'Chemical', 1),
	(6, 'Security', 1),
	(7, 'Waste Management', 1),
	(8, 'Cleaner\'s', 1);
/*!40000 ALTER TABLE `hr_training_names` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_unit
DROP TABLE IF EXISTS `hr_unit`;
CREATE TABLE IF NOT EXISTS `hr_unit` (
  `hr_unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_unit_name` varchar(128) NOT NULL,
  `hr_unit_short_name` varchar(20) DEFAULT NULL,
  `hr_unit_name_bn` varchar(255) DEFAULT NULL,
  `hr_unit_address` varchar(255) DEFAULT NULL,
  `hr_unit_address_bn` varchar(512) DEFAULT NULL,
  `hr_unit_code` varchar(10) DEFAULT NULL,
  `hr_unit_logo` varchar(255) DEFAULT NULL,
  `hr_unit_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hr_unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_unit: ~3 rows (approximately)
DELETE FROM `hr_unit`;
/*!40000 ALTER TABLE `hr_unit` DISABLE KEYS */;
INSERT INTO `hr_unit` (`hr_unit_id`, `hr_unit_name`, `hr_unit_short_name`, `hr_unit_name_bn`, `hr_unit_address`, `hr_unit_address_bn`, `hr_unit_code`, `hr_unit_logo`, `hr_unit_status`) VALUES
	(1, 'MBM Garments Ltd', 'MBM', 'এম বি এম গার্মেন্টস লিমিটেড', 'M-19,M-14 SECTION-14,MIRPUR,DHAKA-1206 .', NULL, 'A', '/assets/idcard/5b0e62898d4d8.png', 1),
	(2, 'Cutting Edge Industries Ltd', 'CEIL', 'কাটিং এজ  ইন্ডাস্ট্রিস লিমিটেড', 'South Salna ,Salna Bazar , Gazipur .', NULL, 'B', '/assets/idcard/5b0e73c79b9c9.png', 1),
	(3, 'Absolute Qualityware Ltd', 'AQL', 'অ্যাবসলিউট  কোয়ালিটি  ওয়ের লিমিটেড', 'Salna Bazar , Gazipur .', NULL, 'C', '/assets/idcard/5b0e768ccd436.png', 1);
/*!40000 ALTER TABLE `hr_unit` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_upazilla
DROP TABLE IF EXISTS `hr_upazilla`;
CREATE TABLE IF NOT EXISTS `hr_upazilla` (
  `upa_id` int(3) NOT NULL AUTO_INCREMENT,
  `upa_dis_id` int(2) NOT NULL,
  `upa_name` varchar(64) NOT NULL,
  `upa_name_bn` varchar(255) DEFAULT NULL,
  `upa_status` int(11) NOT NULL,
  PRIMARY KEY (`upa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=590 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_upazilla: ~589 rows (approximately)
DELETE FROM `hr_upazilla`;
/*!40000 ALTER TABLE `hr_upazilla` DISABLE KEYS */;
INSERT INTO `hr_upazilla` (`upa_id`, `upa_dis_id`, `upa_name`, `upa_name_bn`, `upa_status`) VALUES
	(1, 34, 'Amtali', 'আমতলী', 1),
	(2, 34, 'Bamna ', 'বামনা', 1),
	(3, 34, 'Barguna Sadar ', 'বরগুনা সদর', 1),
	(4, 34, 'Betagi ', 'বেতাগি', 1),
	(5, 34, 'Patharghata ', 'পাথরঘাটা', 1),
	(6, 34, 'Taltali ', 'তালতলী', 1),
	(7, 35, 'Muladi ', 'মুলাদি', 1),
	(8, 35, 'Babuganj ', 'বাবুগঞ্জ', 1),
	(9, 35, 'Agailjhara ', 'আগাইলঝরা', 1),
	(10, 35, 'Barisal Sadar ', 'বরিশাল সদর', 1),
	(11, 35, 'Bakerganj ', 'বাকেরগঞ্জ', 1),
	(12, 35, 'Banaripara ', 'বানাড়িপারা', 1),
	(13, 35, 'Gaurnadi ', 'গৌরনদী', 1),
	(14, 35, 'Hizla ', 'হিজলা', 1),
	(15, 35, 'Mehendiganj ', 'মেহেদিগঞ্জ ', 1),
	(16, 35, 'Wazirpur ', 'ওয়াজিরপুর', 1),
	(17, 36, 'Bhola Sadar ', 'ভোলা সদর', 1),
	(18, 36, 'Burhanuddin ', 'বুরহানউদ্দিন', 1),
	(19, 36, 'Char Fasson ', 'চর ফ্যাশন', 1),
	(20, 36, 'Daulatkhan ', 'দৌলতখান', 1),
	(21, 36, 'Lalmohan ', 'লালমোহন', 1),
	(22, 36, 'Manpura ', 'মনপুরা', 1),
	(23, 36, 'Tazumuddin ', 'তাজুমুদ্দিন', 1),
	(24, 37, 'Jhalokati Sadar ', 'ঝালকাঠি সদর', 1),
	(25, 37, 'Kathalia ', 'কাঁঠালিয়া', 1),
	(26, 37, 'Nalchity ', 'নালচিতি', 1),
	(27, 37, 'Rajapur ', 'রাজাপুর', 1),
	(28, 38, 'Bauphal ', 'বাউফল', 1),
	(29, 38, 'Dashmina ', 'দশমিনা', 1),
	(30, 38, 'Galachipa ', 'গলাচিপা', 1),
	(31, 38, 'Kalapara ', 'কালাপারা', 1),
	(32, 38, 'Mirzaganj ', 'মির্জাগঞ্জ ', 1),
	(33, 38, 'Patuakhali Sadar ', 'পটুয়াখালী সদর', 1),
	(34, 38, 'Dumki ', 'ডুমকি', 1),
	(35, 38, 'Rangabali ', 'রাঙ্গাবালি', 1),
	(36, 39, 'Bhandaria', 'ভান্ডারিয়া', 1),
	(37, 39, 'Kaukhali', 'কাউখালি', 1),
	(38, 39, 'Mathbaria', 'মাঠবাড়িয়া', 1),
	(39, 39, 'Nazirpur', 'নাজিরপুর', 1),
	(40, 39, 'Nesarabad', 'নেসারাবাদ', 1),
	(41, 39, 'Pirojpur Sadar', 'পিরোজপুর সদর', 1),
	(42, 39, 'Zianagar', 'জিয়ানগর', 1),
	(43, 40, 'Bandarban Sadar', 'বান্দরবন সদর', 1),
	(44, 40, 'Thanchi', 'থানচি', 1),
	(45, 40, 'Lama', 'লামা', 1),
	(46, 40, 'Naikhongchhari', 'নাইখংছড়ি ', 1),
	(47, 40, 'Ali kadam', 'আলী কদম', 1),
	(48, 40, 'Rowangchhari', 'রউয়াংছড়ি ', 1),
	(49, 40, 'Ruma', 'রুমা', 1),
	(50, 41, 'Brahmanbaria Sadar ', 'ব্রাহ্মণবাড়িয়া সদর', 1),
	(51, 41, 'Ashuganj ', 'আশুগঞ্জ', 1),
	(52, 41, 'Nasirnagar ', 'নাসির নগর', 1),
	(53, 41, 'Nabinagar ', 'নবীনগর', 1),
	(54, 41, 'Sarail ', 'সরাইল', 1),
	(55, 41, 'Shahbazpur Town', 'শাহবাজপুর টাউন', 1),
	(56, 41, 'Kasba ', 'কসবা', 1),
	(57, 41, 'Akhaura ', 'আখাউরা', 1),
	(58, 41, 'Bancharampur ', 'বাঞ্ছারামপুর', 1),
	(59, 41, 'Bijoynagar ', 'বিজয় নগর', 1),
	(60, 42, 'Chandpur Sadar', 'চাঁদপুর সদর', 1),
	(61, 42, 'Faridganj', 'ফরিদগঞ্জ', 1),
	(62, 42, 'Haimchar', 'হাইমচর', 1),
	(63, 42, 'Haziganj', 'হাজীগঞ্জ', 1),
	(64, 42, 'Kachua', 'কচুয়া', 1),
	(65, 42, 'Matlab Uttar', 'মতলব উত্তর', 1),
	(66, 42, 'Matlab Dakkhin', 'মতলব দক্ষিণ', 1),
	(67, 42, 'Shahrasti', 'শাহরাস্তি', 1),
	(68, 43, 'Anwara ', 'আনোয়ারা', 1),
	(69, 43, 'Banshkhali ', 'বাশখালি', 1),
	(70, 43, 'Boalkhali ', 'বোয়ালখালি', 1),
	(71, 43, 'Chandanaish ', 'চন্দনাইশ', 1),
	(72, 43, 'Fatikchhari ', 'ফটিকছড়ি', 1),
	(73, 43, 'Hathazari ', 'হাঠহাজারী', 1),
	(74, 43, 'Lohagara ', 'লোহাগারা', 1),
	(75, 43, 'Mirsharai ', 'মিরসরাই', 1),
	(76, 43, 'Patiya ', 'পটিয়া', 1),
	(77, 43, 'Rangunia ', 'রাঙ্গুনিয়া', 1),
	(78, 43, 'Raozan ', 'রাউজান', 1),
	(79, 43, 'Sandwip ', 'সন্দ্বীপ', 1),
	(80, 43, 'Satkania ', 'সাতকানিয়া', 1),
	(81, 43, 'Sitakunda ', 'সীতাকুণ্ড', 1),
	(82, 44, 'Barura ', 'বড়ুরা', 1),
	(83, 44, 'Brahmanpara ', 'ব্রাহ্মণপাড়া', 1),
	(84, 44, 'Burichong ', 'বুড়িচং', 1),
	(85, 44, 'Chandina ', 'চান্দিনা', 1),
	(86, 44, 'Chauddagram ', 'চৌদ্দগ্রাম', 1),
	(87, 44, 'Daudkandi ', 'দাউদকান্দি', 1),
	(88, 44, 'Debidwar ', 'দেবীদ্বার', 1),
	(89, 44, 'Homna ', 'হোমনা', 1),
	(90, 44, 'Comilla Sadar ', 'কুমিল্লা সদর', 1),
	(91, 44, 'Laksam ', 'লাকসাম', 1),
	(92, 44, 'Monohorgonj ', 'মনোহরগঞ্জ', 1),
	(93, 44, 'Meghna ', 'মেঘনা', 1),
	(94, 44, 'Muradnagar ', 'মুরাদনগর', 1),
	(95, 44, 'Nangalkot ', 'নাঙ্গালকোট', 1),
	(96, 44, 'Comilla Sadar South ', 'কুমিল্লা সদর দক্ষিণ', 1),
	(97, 44, 'Titas ', 'তিতাস', 1),
	(98, 45, 'Chakaria ', 'চকরিয়া', 1),
	(99, 45, 'Chakaria ', 'চকরিয়া', 1),
	(100, 45, 'Cox\'s Bazar Sadar ', 'কক্সবাজার সদর', 1),
	(101, 45, 'Kutubdia ', 'কুতুবদিয়া', 1),
	(102, 45, 'Maheshkhali ', 'মহেশখালী', 1),
	(103, 45, 'Ramu ', 'রামু', 1),
	(104, 45, 'Teknaf ', 'টেকনাফ', 1),
	(105, 45, 'Ukhia ', 'উখিয়া', 1),
	(106, 45, 'Pekua ', 'পেকুয়া', 1),
	(107, 46, 'Feni Sadar', 'ফেনী সদর', 1),
	(108, 46, 'Chagalnaiya', 'ছাগল নাইয়া', 1),
	(109, 46, 'Daganbhyan', 'দাগানভিয়া', 1),
	(110, 46, 'Parshuram', 'পরশুরাম', 1),
	(111, 46, 'Fhulgazi', 'ফুলগাজি', 1),
	(112, 46, 'Sonagazi', 'সোনাগাজি', 1),
	(113, 47, 'Dighinala ', 'দিঘিনালা ', 1),
	(114, 47, 'Khagrachhari ', 'খাগড়াছড়ি', 1),
	(115, 47, 'Lakshmichhari ', 'লক্ষ্মীছড়ি', 1),
	(116, 47, 'Mahalchhari ', 'মহলছড়ি', 1),
	(117, 47, 'Manikchhari ', 'মানিকছড়ি', 1),
	(118, 47, 'Matiranga ', 'মাটিরাঙ্গা', 1),
	(119, 47, 'Panchhari ', 'পানছড়ি', 1),
	(120, 47, 'Ramgarh ', 'রামগড়', 1),
	(121, 48, 'Lakshmipur Sadar ', 'লক্ষ্মীপুর সদর', 1),
	(122, 48, 'Raipur ', 'রায়পুর', 1),
	(123, 48, 'Ramganj ', 'রামগঞ্জ', 1),
	(124, 48, 'Ramgati ', 'রামগতি', 1),
	(125, 48, 'Komol Nagar ', 'কমল নগর', 1),
	(126, 49, 'Noakhali Sadar ', 'নোয়াখালী সদর', 1),
	(127, 49, 'Begumganj ', 'বেগমগঞ্জ', 1),
	(128, 49, 'Chatkhil ', 'চাটখিল', 1),
	(129, 49, 'Companyganj ', 'কোম্পানীগঞ্জ', 1),
	(130, 49, 'Shenbag ', 'সেনবাগ', 1),
	(131, 49, 'Hatia ', 'হাতিয়া', 1),
	(132, 49, 'Kobirhat ', 'কবিরহাট ', 1),
	(133, 49, 'Sonaimuri ', 'সোনাইমুরি', 1),
	(134, 49, 'Suborno Char ', 'সুবর্ণ চর ', 1),
	(135, 50, 'Rangamati Sadar ', 'রাঙ্গামাটি সদর', 1),
	(136, 50, 'Belaichhari ', 'বেলাইছড়ি', 1),
	(137, 50, 'Bagaichhari ', 'বাঘাইছড়ি', 1),
	(138, 50, 'Barkal ', 'বরকল', 1),
	(139, 50, 'Juraichhari ', 'জুরাইছড়ি', 1),
	(140, 50, 'Rajasthali ', 'রাজাস্থলি', 1),
	(141, 50, 'Kaptai ', 'কাপ্তাই', 1),
	(142, 50, 'Langadu ', 'লাঙ্গাডু', 1),
	(143, 50, 'Nannerchar ', 'নান্নেরচর ', 1),
	(144, 50, 'Kaukhali ', 'কাউখালি', 1),
	(145, 2, 'Faridpur Sadar ', 'ফরিদপুর সদর', 1),
	(146, 2, 'Boalmari ', 'বোয়ালমারী', 1),
	(147, 2, 'Alfadanga ', 'আলফাডাঙ্গা', 1),
	(148, 2, 'Madhukhali ', 'মধুখালি', 1),
	(149, 2, 'Bhanga ', 'ভাঙ্গা', 1),
	(150, 2, 'Nagarkanda ', 'নগরকান্ড', 1),
	(151, 2, 'Charbhadrasan ', 'চরভদ্রাসন ', 1),
	(152, 2, 'Sadarpur ', 'সদরপুর', 1),
	(153, 2, 'Shaltha ', 'শালথা', 1),
	(154, 3, 'Gazipur Sadar-Joydebpur', 'গাজীপুর সদর', 1),
	(155, 3, 'Kaliakior', 'কালিয়াকৈর', 1),
	(156, 3, 'Kapasia', 'কাপাসিয়া', 1),
	(157, 3, 'Sripur', 'শ্রীপুর', 1),
	(158, 3, 'Kaliganj', 'কালীগঞ্জ', 1),
	(159, 3, 'Tongi', 'টঙ্গি', 1),
	(160, 4, 'Gopalganj Sadar ', 'গোপালগঞ্জ সদর', 1),
	(161, 4, 'Kashiani ', 'কাশিয়ানি', 1),
	(162, 4, 'Kotalipara ', 'কোটালিপাড়া', 1),
	(163, 4, 'Muksudpur ', 'মুকসুদপুর', 1),
	(164, 4, 'Tungipara ', 'টুঙ্গিপাড়া', 1),
	(165, 5, 'Dewanganj ', 'দেওয়ানগঞ্জ', 1),
	(166, 5, 'Baksiganj ', 'বকসিগঞ্জ', 1),
	(167, 5, 'Islampur ', 'ইসলামপুর', 1),
	(168, 5, 'Jamalpur Sadar ', 'জামালপুর সদর', 1),
	(169, 5, 'Madarganj ', 'মাদারগঞ্জ', 1),
	(170, 5, 'Melandaha ', 'মেলানদাহা', 1),
	(171, 5, 'Sarishabari ', 'সরিষাবাড়ি ', 1),
	(172, 5, 'Narundi Police I.C', 'নারুন্দি', 1),
	(173, 6, 'Astagram ', 'অষ্টগ্রাম', 1),
	(174, 6, 'Bajitpur ', 'বাজিতপুর', 1),
	(175, 6, 'Bhairab ', 'ভৈরব', 1),
	(176, 6, 'Hossainpur ', 'হোসেনপুর ', 1),
	(177, 6, 'Itna ', 'ইটনা', 1),
	(178, 6, 'Karimganj ', 'করিমগঞ্জ', 1),
	(179, 6, 'Katiadi ', 'কতিয়াদি', 1),
	(180, 6, 'Kishoreganj Sadar ', 'কিশোরগঞ্জ সদর', 1),
	(181, 6, 'Kuliarchar ', 'কুলিয়ারচর', 1),
	(182, 6, 'Mithamain ', 'মিঠামাইন', 1),
	(183, 6, 'Nikli ', 'নিকলি', 1),
	(184, 6, 'Pakundia ', 'পাকুন্ডা', 1),
	(185, 6, 'Tarail ', 'তাড়াইল', 1),
	(186, 7, 'Madaripur Sadar', 'মাদারীপুর সদর', 1),
	(187, 7, 'Kalkini', 'কালকিনি', 1),
	(188, 7, 'Rajoir', 'রাজইর', 1),
	(189, 7, 'Shibchar', 'শিবচর', 1),
	(190, 8, 'Manikganj Sadar ', 'মানিকগঞ্জ সদর', 1),
	(191, 8, 'Singair ', 'সিঙ্গাইর', 1),
	(192, 8, 'Shibalaya ', 'শিবালয়', 1),
	(193, 8, 'Saturia ', 'সাটুরিয়া', 1),
	(194, 8, 'Harirampur ', 'হরিরামপুর', 1),
	(195, 8, 'Ghior ', 'ঘিওর', 1),
	(196, 8, 'Daulatpur ', 'দৌলতপুর', 1),
	(197, 9, 'Lohajang ', 'লোহাজং', 1),
	(198, 9, 'Sreenagar ', 'শ্রীনগর', 1),
	(199, 9, 'Munshiganj Sadar ', 'মুন্সিগঞ্জ সদর', 1),
	(200, 9, 'Sirajdikhan ', 'সিরাজদিখান', 1),
	(201, 9, 'Tongibari ', 'টঙ্গিবাড়ি', 1),
	(202, 9, 'Gazaria ', 'গজারিয়া', 1),
	(203, 10, 'Bhaluka', 'ভালুকা', 1),
	(204, 10, 'Trishal', 'ত্রিশাল', 1),
	(205, 10, 'Haluaghat', 'হালুয়াঘাট', 1),
	(206, 10, 'Muktagachha', 'মুক্তাগাছা', 1),
	(207, 10, 'Dhobaura', 'ধোবাউরা', 1),
	(208, 10, 'Fulbaria', 'ফুলবাড়িয়া', 1),
	(209, 10, 'Gaffargaon', 'গফরগাঁও', 1),
	(210, 10, 'Gauripur', 'গৌরিপুর', 1),
	(211, 10, 'Ishwarganj', 'ঈশ্বরগঞ্জ', 1),
	(212, 10, 'Mymensingh Sadar', 'ময়মনসিং সদর', 1),
	(213, 10, 'Nandail', 'নন্দাইল', 1),
	(214, 10, 'Phulpur', 'ফুলপুর', 1),
	(215, 11, 'Araihazar ', 'আড়াইহাজার', 1),
	(216, 11, 'Sonargaon ', 'সোনারগাঁও', 1),
	(217, 11, 'Bandar', 'বন্দর', 1),
	(218, 11, 'Naryanganj Sadar ', 'নারায়ানগঞ্জ সদর', 1),
	(219, 11, 'Rupganj ', 'রূপগঞ্জ', 1),
	(220, 11, 'Siddirgonj ', 'সিদ্ধিরগঞ্জ', 1),
	(221, 12, 'Belabo ', 'বেলাবো', 1),
	(222, 12, 'Monohardi ', 'মনোহরদি', 1),
	(223, 12, 'Narsingdi Sadar ', 'নরসিংদী সদর', 1),
	(224, 12, 'Palash ', 'পলাশ', 1),
	(225, 12, 'Raipura', 'Narsingdi', 1),
	(226, 12, 'Shibpur ', 'শিবপুর', 1),
	(227, 13, 'Kendua Upazilla', 'কেন্দুয়া', 1),
	(228, 13, 'Atpara Upazilla', 'আটপাড়া', 1),
	(229, 13, 'Barhatta', 'বরহাট্টা', 1),
	(230, 13, 'Durgapur Upazilla', 'দুর্গাপুর', 1),
	(231, 13, 'Kalmakanda Upazilla', 'কলমাকান্দা', 1),
	(232, 13, 'Madan Upazilla', 'মদন', 1),
	(233, 13, 'Mohanganj Upazilla', 'মোহনগঞ্জ', 1),
	(234, 13, 'Netrakona-S Upazilla', 'নেত্রকোনা সদর', 1),
	(235, 13, 'Purbadhala Upazilla', 'পূর্বধলা', 1),
	(236, 13, 'Khaliajuri Upazilla', 'খালিয়াজুরি', 1),
	(237, 14, 'Baliakandi ', 'বালিয়াকান্দি', 1),
	(238, 14, 'Goalandaghat ', 'গোয়ালন্দ ঘাট', 1),
	(239, 14, 'Pangsha ', 'পাংশা', 1),
	(240, 14, 'Kalukhali ', 'কালুখালি', 1),
	(241, 14, 'Rajbari Sadar ', 'রাজবাড়ি সদর', 1),
	(242, 15, 'Shariatpur Sadar -Palong', 'শরীয়তপুর সদর ', 1),
	(243, 15, 'Damudya ', 'ডামুড্ডা', 1),
	(244, 15, 'Naria ', 'নড়িয়া', 1),
	(245, 15, 'Jajira ', 'জাজিরা', 1),
	(246, 15, 'Bhedarganj ', 'ভেদারগঞ্জ', 1),
	(247, 15, 'Gosairhat ', 'গোসাইর হাট ', 1),
	(248, 16, 'Jhenaigati ', 'ঝিনাইগাতি', 1),
	(249, 16, 'Nakla ', 'নাকলা', 1),
	(250, 16, 'Nalitabari ', 'নালিতাবাড়ি', 1),
	(251, 16, 'Sherpur Sadar ', 'শেরপুর সদর', 1),
	(252, 16, 'Sreebardi ', 'শ্রীবরদি', 1),
	(253, 17, 'Tangail Sadar ', 'টাঙ্গাইল সদর', 1),
	(254, 17, 'Sakhipur ', 'সখিপুর', 1),
	(255, 17, 'Basail ', 'বসাইল', 1),
	(256, 17, 'Madhupur ', 'মধুপুর', 1),
	(257, 17, 'Ghatail ', 'ঘাটাইল', 1),
	(258, 17, 'Kalihati ', 'কালিহাতি', 1),
	(259, 17, 'Nagarpur ', 'নগরপুর', 1),
	(260, 17, 'Mirzapur ', 'মির্জাপুর', 1),
	(261, 17, 'Gopalpur ', 'গোপালপুর', 1),
	(262, 17, 'Delduar ', 'দেলদুয়ার', 1),
	(263, 17, 'Bhuapur ', 'ভুয়াপুর', 1),
	(264, 17, 'Dhanbari ', 'ধানবাড়ি', 1),
	(265, 55, 'Bagerhat Sadar ', 'বাগেরহাট সদর', 1),
	(266, 55, 'Chitalmari ', 'চিতলমাড়ি', 1),
	(267, 55, 'Fakirhat ', 'ফকিরহাট', 1),
	(268, 55, 'Kachua ', 'কচুয়া', 1),
	(269, 55, 'Mollahat ', 'মোল্লাহাট ', 1),
	(270, 55, 'Mongla ', 'মংলা', 1),
	(271, 55, 'Morrelganj ', 'মরেলগঞ্জ', 1),
	(272, 55, 'Rampal ', 'রামপাল', 1),
	(273, 55, 'Sarankhola ', 'স্মরণখোলা', 1),
	(274, 56, 'Damurhuda ', 'দামুরহুদা', 1),
	(275, 56, 'Chuadanga Shadar', 'চুয়াডাঙ্গা সদর', 1),
	(276, 56, 'Jibannagar ', 'জীবন নগর ', 1),
	(277, 56, 'Alamdanga ', 'আলমডাঙ্গা', 1),
	(278, 57, 'Abhaynagar ', 'অভয়নগর', 1),
	(279, 57, 'Keshabpur ', 'কেশবপুর', 1),
	(280, 57, 'Bagherpara ', 'বাঘের পাড়া ', 1),
	(281, 57, 'Jessore Sadar ', 'যশোর সদর', 1),
	(282, 57, 'Chaugachha ', 'চৌগাছা', 1),
	(283, 57, 'Manirampur ', 'মনিরামপুর ', 1),
	(284, 57, 'Jhikargachha ', 'ঝিকরগাছা', 1),
	(285, 57, 'Sharsha ', 'সারশা', 1),
	(286, 58, 'Jhenaidah Sadar ', 'ঝিনাইদহ সদর', 1),
	(287, 58, 'Maheshpur ', 'মহেশপুর', 1),
	(288, 58, 'Kaliganj ', 'কালীগঞ্জ', 1),
	(289, 58, 'Kotchandpur ', 'কোট চাঁদপুর ', 1),
	(290, 58, 'Shailkupa ', 'শৈলকুপা', 1),
	(291, 58, 'Harinakunda ', 'হাড়িনাকুন্দা', 1),
	(292, 59, 'Terokhada ', 'তেরোখাদা', 1),
	(293, 59, 'Batiaghata ', 'বাটিয়াঘাটা ', 1),
	(294, 59, 'Dacope ', 'ডাকপে', 1),
	(295, 59, 'Dumuria ', 'ডুমুরিয়া', 1),
	(296, 59, 'Dighalia ', 'দিঘলিয়া', 1),
	(297, 59, 'Koyra ', 'কয়ড়া', 1),
	(298, 59, 'Paikgachha ', 'পাইকগাছা', 1),
	(299, 59, 'Phultala ', 'ফুলতলা', 1),
	(300, 59, 'Rupsa ', 'রূপসা', 1),
	(301, 60, 'Kushtia Sadar', 'কুষ্টিয়া সদর', 1),
	(302, 60, 'Kumarkhali', 'কুমারখালি', 1),
	(303, 60, 'Daulatpur', 'দৌলতপুর', 1),
	(304, 60, 'Mirpur', 'মিরপুর', 1),
	(305, 60, 'Bheramara', 'ভেরামারা', 1),
	(306, 60, 'Khoksa', 'খোকসা', 1),
	(307, 61, 'Magura Sadar ', 'মাগুরা সদর', 1),
	(308, 61, 'Mohammadpur ', 'মোহাম্মাদপুর', 1),
	(309, 61, 'Shalikha ', 'শালিখা', 1),
	(310, 61, 'Sreepur ', 'শ্রীপুর', 1),
	(311, 62, 'Angni', 'আংনি', 1),
	(312, 62, 'Mujib Nagar ', 'মুজিব নগর', 1),
	(313, 62, 'Meherpur-S ', 'মেহেরপুর সদর', 1),
	(314, 63, 'Narail-S Upazilla', 'নড়াইল সদর', 1),
	(315, 63, 'Lohagara Upazilla', 'লোহাগাড়া', 1),
	(316, 63, 'Kalia Upazilla', 'কালিয়া', 1),
	(317, 64, 'Satkhira Sadar ', 'সাতক্ষীরা সদর', 1),
	(318, 64, 'Assasuni ', 'আসসাশুনি ', 1),
	(319, 64, 'Debhata ', 'দেভাটা', 1),
	(320, 64, 'Tala ', 'তালা', 1),
	(321, 64, 'Kalaroa ', 'কলরোয়া', 1),
	(322, 64, 'Kaliganj ', 'কালীগঞ্জ', 1),
	(323, 64, 'Shyamnagar ', 'শ্যামনগর', 1),
	(324, 18, 'Adamdighi', 'আদমদিঘী', 1),
	(325, 18, 'Bogra Sadar', 'বগুড়া সদর', 1),
	(326, 18, 'Sherpur', 'শেরপুর', 1),
	(327, 18, 'Dhunat', 'ধুনট', 1),
	(328, 18, 'Dhupchanchia', 'দুপচাচিয়া', 1),
	(329, 18, 'Gabtali', 'গাবতলি', 1),
	(330, 18, 'Kahaloo', 'কাহালু', 1),
	(331, 18, 'Nandigram', 'নন্দিগ্রাম', 1),
	(332, 18, 'Sahajanpur', 'শাহজাহানপুর', 1),
	(333, 18, 'Sariakandi', 'সারিয়াকান্দি', 1),
	(334, 18, 'Shibganj', 'শিবগঞ্জ', 1),
	(335, 18, 'Sonatala', 'সোনাতলা', 1),
	(336, 19, 'Joypurhat S', 'জয়পুরহাট সদর', 1),
	(337, 19, 'Akkelpur', 'আক্কেলপুর', 1),
	(338, 19, 'Kalai', 'কালাই', 1),
	(339, 19, 'Khetlal', 'খেতলাল', 1),
	(340, 19, 'Panchbibi', 'পাঁচবিবি', 1),
	(341, 20, 'Naogaon Sadar ', 'নওগাঁ সদর', 1),
	(342, 20, 'Mohadevpur ', 'মহাদেবপুর', 1),
	(343, 20, 'Manda ', 'মান্দা', 1),
	(344, 20, 'Niamatpur ', 'নিয়ামতপুর', 1),
	(345, 20, 'Atrai ', 'আত্রাই', 1),
	(346, 20, 'Raninagar ', 'রাণীনগর', 1),
	(347, 20, 'Patnitala ', 'পত্নীতলা', 1),
	(348, 20, 'Dhamoirhat ', 'ধামইরহাট ', 1),
	(349, 20, 'Sapahar ', 'সাপাহার', 1),
	(350, 20, 'Porsha ', 'পোরশা', 1),
	(351, 20, 'Badalgachhi ', 'বাদলগাছি', 1),
	(352, 21, 'Natore Sadar ', 'নাটোর সদর', 1),
	(353, 21, 'Baraigram ', 'বড়াইগ্রাম', 1),
	(354, 21, 'Bagatipara ', 'বাগাতিপাড়া', 1),
	(355, 21, 'Lalpur ', 'লালপুর', 1),
	(356, 21, 'Natore Sadar ', 'নাটোর সদর', 1),
	(357, 21, 'Baraigram ', 'বড়াইগ্রাম', 1),
	(358, 22, 'Bholahat ', 'ভোলাহাট', 1),
	(359, 22, 'Gomastapur ', 'গোমস্তাপুর', 1),
	(360, 22, 'Nachole ', 'নাচোল', 1),
	(361, 22, 'Nawabganj Sadar ', 'নবাবগঞ্জ সদর', 1),
	(362, 22, 'Shibganj ', 'শিবগঞ্জ', 1),
	(363, 23, 'Atgharia ', 'আটঘরিয়া', 1),
	(364, 23, 'Bera ', 'বেড়া', 1),
	(365, 23, 'Bhangura ', 'ভাঙ্গুরা', 1),
	(366, 23, 'Chatmohar ', 'চাটমোহর', 1),
	(367, 23, 'Faridpur ', 'ফরিদপুর', 1),
	(368, 23, 'Ishwardi ', 'ঈশ্বরদী', 1),
	(369, 23, 'Pabna Sadar ', 'পাবনা সদর', 1),
	(370, 23, 'Santhia ', 'সাথিয়া', 1),
	(371, 23, 'Sujanagar ', 'সুজানগর', 1),
	(372, 24, 'Bagha', 'বাঘা', 1),
	(373, 24, 'Bagmara', 'বাগমারা', 1),
	(374, 24, 'Charghat', 'চারঘাট', 1),
	(375, 24, 'Durgapur', 'দুর্গাপুর', 1),
	(376, 24, 'Godagari', 'গোদাগারি', 1),
	(377, 24, 'Mohanpur', 'মোহনপুর', 1),
	(378, 24, 'Paba', 'পবা', 1),
	(379, 24, 'Puthia', 'পুঠিয়া', 1),
	(380, 24, 'Tanore', 'তানোর', 1),
	(381, 25, 'Sirajganj Sadar ', 'সিরাজগঞ্জ সদর', 1),
	(382, 25, 'Belkuchi ', 'বেলকুচি', 1),
	(383, 25, 'Chauhali ', 'চৌহালি', 1),
	(384, 25, 'Kamarkhanda ', 'কামারখান্দা', 1),
	(385, 25, 'Kazipur ', 'কাজীপুর', 1),
	(386, 25, 'Raiganj ', 'রায়গঞ্জ', 1),
	(387, 25, 'Shahjadpur ', 'শাহজাদপুর', 1),
	(388, 25, 'Tarash ', 'তারাশ', 1),
	(389, 25, 'Ullahpara ', 'উল্লাপাড়া', 1),
	(390, 26, 'Birampur ', 'বিরামপুর', 1),
	(391, 26, 'Birganj', 'বীরগঞ্জ', 1),
	(392, 26, 'Biral ', 'বিড়াল', 1),
	(393, 26, 'Bochaganj ', 'বোচাগঞ্জ', 1),
	(394, 26, 'Chirirbandar ', 'চিরিরবন্দর', 1),
	(395, 26, 'Phulbari ', 'ফুলবাড়ি', 1),
	(396, 26, 'Ghoraghat ', 'ঘোড়াঘাট', 1),
	(397, 26, 'Hakimpur ', 'হাকিমপুর', 1),
	(398, 26, 'Kaharole ', 'কাহারোল', 1),
	(399, 26, 'Khansama ', 'খানসামা', 1),
	(400, 26, 'Dinajpur Sadar ', 'দিনাজপুর সদর', 1),
	(401, 26, 'Nawabganj', 'নবাবগঞ্জ', 1),
	(402, 26, 'Parbatipur ', 'পার্বতীপুর', 1),
	(403, 27, 'Fulchhari', 'ফুলছড়ি', 1),
	(404, 27, 'Gaibandha sadar', 'গাইবান্ধা সদর', 1),
	(405, 27, 'Gobindaganj', 'গোবিন্দগঞ্জ', 1),
	(406, 27, 'Palashbari', 'পলাশবাড়ী', 1),
	(407, 27, 'Sadullapur', 'সাদুল্যাপুর', 1),
	(408, 27, 'Saghata', 'সাঘাটা', 1),
	(409, 27, 'Sundarganj', 'সুন্দরগঞ্জ', 1),
	(410, 28, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', 1),
	(411, 28, 'Nageshwari', 'নাগেশ্বরী', 1),
	(412, 28, 'Bhurungamari', 'ভুরুঙ্গামারি', 1),
	(413, 28, 'Phulbari', 'ফুলবাড়ি', 1),
	(414, 28, 'Rajarhat', 'রাজারহাট', 1),
	(415, 28, 'Ulipur', 'উলিপুর', 1),
	(416, 28, 'Chilmari', 'চিলমারি', 1),
	(417, 28, 'Rowmari', 'রউমারি', 1),
	(418, 28, 'Char Rajibpur', 'চর রাজিবপুর', 1),
	(419, 29, 'Lalmanirhat Sadar', 'লালমনিরহাট সদর', 1),
	(420, 29, 'Aditmari', 'আদিতমারি', 1),
	(421, 29, 'Kaliganj', 'কালীগঞ্জ', 1),
	(422, 29, 'Hatibandha', 'হাতিবান্ধা', 1),
	(423, 29, 'Patgram', 'পাটগ্রাম', 1),
	(424, 30, 'Nilphamari Sadar', 'নীলফামারী সদর', 1),
	(425, 30, 'Saidpur', 'সৈয়দপুর', 1),
	(426, 30, 'Jaldhaka', 'জলঢাকা', 1),
	(427, 30, 'Kishoreganj', 'কিশোরগঞ্জ', 1),
	(428, 30, 'Domar', 'ডোমার', 1),
	(429, 30, 'Dimla', 'ডিমলা', 1),
	(430, 31, 'Panchagarh Sadar', 'পঞ্চগড় সদর', 1),
	(431, 31, 'Debiganj', 'দেবীগঞ্জ', 1),
	(432, 31, 'Boda', 'বোদা', 1),
	(433, 31, 'Atwari', 'আটোয়ারি', 1),
	(434, 31, 'Tetulia', 'তেতুলিয়া', 1),
	(435, 32, 'Badarganj', 'বদরগঞ্জ', 1),
	(436, 32, 'Mithapukur', 'মিঠাপুকুর', 1),
	(437, 32, 'Gangachara', 'গঙ্গাচরা', 1),
	(438, 32, 'Kaunia', 'কাউনিয়া', 1),
	(439, 32, 'Rangpur Sadar', 'রংপুর সদর', 1),
	(440, 32, 'Pirgachha', 'পীরগাছা', 1),
	(441, 32, 'Pirganj', 'পীরগঞ্জ', 1),
	(442, 32, 'Taraganj', 'তারাগঞ্জ', 1),
	(443, 33, 'Thakurgaon Sadar ', 'ঠাকুরগাঁও সদর', 1),
	(444, 33, 'Pirganj ', 'পীরগঞ্জ', 1),
	(445, 33, 'Baliadangi ', 'বালিয়াডাঙ্গি', 1),
	(446, 33, 'Haripur ', 'হরিপুর', 1),
	(447, 33, 'Ranisankail ', 'রাণীসংকইল', 1),
	(448, 51, 'Ajmiriganj', 'আজমিরিগঞ্জ', 1),
	(449, 51, 'Baniachang', 'বানিয়াচং', 1),
	(450, 51, 'Bahubal', 'বাহুবল', 1),
	(451, 51, 'Chunarughat', 'চুনারুঘাট', 1),
	(452, 51, 'Habiganj Sadar', 'হবিগঞ্জ সদর', 1),
	(453, 51, 'Lakhai', 'লাক্ষাই', 1),
	(454, 51, 'Madhabpur', 'মাধবপুর', 1),
	(455, 51, 'Nabiganj', 'নবীগঞ্জ', 1),
	(456, 51, 'Shaistagonj ', 'শায়েস্তাগঞ্জ', 1),
	(457, 52, 'Moulvibazar Sadar', 'মৌলভীবাজার', 1),
	(458, 52, 'Barlekha', 'বড়লেখা', 1),
	(459, 52, 'Juri', 'জুড়ি', 1),
	(460, 52, 'Kamalganj', 'কামালগঞ্জ', 1),
	(461, 52, 'Kulaura', 'কুলাউরা', 1),
	(462, 52, 'Rajnagar', 'রাজনগর', 1),
	(463, 52, 'Sreemangal', 'শ্রীমঙ্গল', 1),
	(464, 53, 'Bishwamvarpur', 'বিসশম্ভারপুর', 1),
	(465, 53, 'Chhatak', 'ছাতক', 1),
	(466, 53, 'Derai', 'দেড়াই', 1),
	(467, 53, 'Dharampasha', 'ধরমপাশা', 1),
	(468, 53, 'Dowarabazar', 'দোয়ারাবাজার', 1),
	(469, 53, 'Jagannathpur', 'জগন্নাথপুর', 1),
	(470, 53, 'Jamalganj', 'জামালগঞ্জ', 1),
	(471, 53, 'Sulla', 'সুল্লা', 1),
	(472, 53, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', 1),
	(473, 53, 'Shanthiganj', 'শান্তিগঞ্জ', 1),
	(474, 53, 'Tahirpur', 'তাহিরপুর', 1),
	(475, 54, 'Sylhet Sadar', 'সিলেট সদর', 1),
	(476, 54, 'Beanibazar', 'বিয়ানিবাজার', 1),
	(477, 54, 'Bishwanath', 'বিশ্বনাথ', 1),
	(478, 54, 'Dakshin Surma ', 'দক্ষিণ সুরমা', 1),
	(479, 54, 'Balaganj', 'বালাগঞ্জ', 1),
	(480, 54, 'Companiganj', 'কোম্পানিগঞ্জ', 1),
	(481, 54, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', 1),
	(482, 54, 'Golapganj', 'গোলাপগঞ্জ', 1),
	(483, 54, 'Gowainghat', 'গোয়াইনঘাট', 1),
	(484, 54, 'Jaintiapur', 'জয়ন্তপুর', 1),
	(485, 54, 'Kanaighat', 'কানাইঘাট', 1),
	(486, 54, 'Zakiganj', 'জাকিগঞ্জ', 1),
	(487, 54, 'Nobigonj', 'নবীগঞ্জ', 1),
	(488, 1, 'Adabor', 'আদাবর,', 1),
	(489, 1, 'Airport', 'বিমানবন্দর', 1),
	(490, 1, 'Badda', 'বাড্ডা', 1),
	(491, 1, 'Banani', 'বনানী', 1),
	(492, 1, 'Bangshal', 'বংশাল', 1),
	(493, 1, 'Bhashantek', 'ভাষানটেক', 1),
	(494, 1, 'Cantonment', 'সেনানিবাস', 1),
	(495, 1, 'Chackbazar', 'চকবাজার', 1),
	(496, 1, 'Darussalam', 'দারুসালাম', 1),
	(497, 1, 'Daskhinkhan', 'দক্ষিনখান', 1),
	(498, 1, 'Demra', 'ডেমরা', 1),
	(499, 1, 'Dhamrai', 'ধামরাই', 1),
	(500, 1, 'Dhanmondi', 'ধানমন্ডি,', 1),
	(501, 1, 'Dohar', 'দোহার', 1),
	(502, 1, 'Gandaria', 'গেন্ডারিয়া', 1),
	(503, 1, 'Gulshan', 'গুলশান', 1),
	(504, 1, 'Hazaribag', 'হাজারিবাগ,', 1),
	(505, 1, 'Jatrabari', 'যাত্রাবাড়ী', 1),
	(506, 1, 'Kafrul', 'কাফরুল', 1),
	(507, 1, 'Kalabagan', 'কলাবাগান', 1),
	(508, 1, 'Kamrangirchar', 'কামরাঙ্গীরচর', 1),
	(509, 1, 'Keraniganj', 'কেরানীগঞ্জ', 1),
	(510, 1, 'Khilgaon', 'খিলগাঁ', 1),
	(511, 1, 'Khilkhet', 'খিলক্ষেত', 1),
	(512, 1, 'Kotwali', 'কোতোয়ালী', 1),
	(513, 1, 'Lalbag', 'লালবাগ', 1),
	(514, 1, 'Mirpur Model', 'মিরপুর', 1),
	(515, 1, 'Mohammadpur', 'মোহাম্মাদপুর', 1),
	(516, 1, 'Motijheel', 'মতিঝিল', 1),
	(517, 1, 'Mugda', 'মুগদা', 1),
	(518, 1, 'Nawabganj', 'নবাবগঞ্জ', 1),
	(519, 1, 'New Market', 'নিউ মার্কেট', 1),
	(520, 1, 'Pallabi', 'পল্লবী', 1),
	(521, 1, 'Paltan', 'পল্টন', 1),
	(522, 1, 'Ramna', 'রমনা', 1),
	(523, 1, 'Rampura', 'রামপুরা', 1),
	(524, 1, 'Rupnagar', 'রূপনগর', 1),
	(525, 1, 'Sabujbag', 'সবুজবাগ', 1),
	(526, 1, 'Savar', 'সাভার', 1),
	(527, 1, 'Shah Ali', 'শাহ আলী', 1),
	(528, 1, 'Shahbag', 'শাহবাগ', 1),
	(529, 1, 'Shahjahanpur', 'শাহজাহানপুর', 1),
	(530, 1, 'Sherebanglanagar', 'শেরেবাংলা নগর', 1),
	(531, 1, 'Shyampur', 'শ্যামপুর', 1),
	(532, 1, 'Sutrapur', 'সূত্রাপুর', 1),
	(533, 1, 'Tejgaon', 'তেজগাঁও,', 1),
	(534, 1, 'Tejgaon I/A', 'তেজগাঁও', 1),
	(535, 1, 'Turag', 'তুরাগ', 1),
	(536, 1, 'Uttara', 'উত্তরা', 1),
	(537, 1, 'Uttara West', 'উত্তরা পশ্চিম', 1),
	(538, 1, 'Uttarkhan', 'উত্তরখান', 1),
	(539, 1, 'Vatara', 'ভাটারা', 1),
	(540, 1, 'Wari', 'ওয়ারী', 1),
	(541, 1, 'Others', 'অন্যান্য', 1),
	(542, 35, 'Airport', 'এয়ারপোর্ট', 1),
	(543, 35, 'Kawnia', 'কাউনিয়া', 1),
	(544, 35, 'Bondor', 'বন্দর', 1),
	(545, 35, 'Others', 'অন্যান্য', 1),
	(546, 24, 'Boalia', 'বোয়ালিয়া', 1),
	(547, 24, 'Motihar', 'মতিহার', 1),
	(548, 24, 'Shahmokhdum', 'শাহ্ মকখদুম ', 1),
	(549, 24, 'Rajpara', 'রাজপারা ', 1),
	(550, 24, 'Others', 'অন্যান্য', 1),
	(551, 43, 'Akborsha', 'আকবরশা', 1),
	(552, 43, 'Baijid bostami', 'বাইজিদ বোস্তামী', 1),
	(553, 43, 'Bakolia', 'বাকোলিয়া', 1),
	(554, 43, 'Bandar', 'বন্দর', 1),
	(555, 43, 'Chandgaon', 'চাঁদগাও', 1),
	(556, 43, 'Chokbazar', 'চকবাজার', 1),
	(557, 43, 'Doublemooring', 'ডাবল মুরিং', 1),
	(558, 43, 'EPZ', 'ইপিজেড', 1),
	(559, 43, 'Hali Shohor', 'হালী শহর', 1),
	(560, 43, 'Kornafuli', 'কর্ণফুলি', 1),
	(561, 43, 'Kotwali', 'কোতোয়ালী', 1),
	(562, 43, 'Kulshi', 'কুলশি', 1),
	(563, 43, 'Pahartali', 'পাহাড়তলী', 1),
	(564, 43, 'Panchlaish', 'পাঁচলাইশ', 1),
	(565, 43, 'Potenga', 'পতেঙ্গা', 1),
	(566, 43, 'Shodhorgat', 'সদরঘাট', 1),
	(567, 43, 'Others', 'অন্যান্য', 1),
	(568, 44, 'Others', 'অন্যান্য', 1),
	(569, 59, 'Aranghata', 'আড়াংঘাটা', 1),
	(570, 59, 'Daulatpur', 'দৌলতপুর', 1),
	(571, 59, 'Harintana', 'হারিন্তানা ', 1),
	(572, 59, 'Horintana', 'হরিণতানা ', 1),
	(573, 59, 'Khalishpur', 'খালিশপুর', 1),
	(574, 59, 'Khanjahan Ali', 'খানজাহান আলী', 1),
	(575, 59, 'Khulna Sadar', 'খুলনা সদর', 1),
	(576, 59, 'Labanchora', 'লাবানছোরা', 1),
	(577, 59, 'Sonadanga', 'সোনাডাঙ্গা', 1),
	(578, 59, 'Others', 'অন্যান্য', 1),
	(579, 2, 'Others', 'অন্যান্য', 1),
	(580, 4, 'Others', 'অন্যান্য', 1),
	(581, 5, 'Others', 'অন্যান্য', 1),
	(582, 54, 'Airport', 'বিমানবন্দর', 1),
	(583, 54, 'Hazrat Shah Paran', 'হযরত শাহ পরাণ', 1),
	(584, 54, 'Jalalabad', 'জালালাবাদ', 1),
	(585, 54, 'Kowtali', 'কোতোয়ালী', 1),
	(586, 54, 'Moglabazar', 'মোগলাবাজার', 1),
	(587, 54, 'Osmani Nagar', 'ওসমানী নগর', 1),
	(588, 54, 'South Surma', 'দক্ষিণ সুরমা', 1),
	(589, 54, 'Others', 'অন্যান্য', 1);
/*!40000 ALTER TABLE `hr_upazilla` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_without_pay
DROP TABLE IF EXISTS `hr_without_pay`;
CREATE TABLE IF NOT EXISTS `hr_without_pay` (
  `hr_wop_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_wop_as_id` varchar(10) NOT NULL,
  `hr_wop_start_date` date DEFAULT NULL,
  `hr_wop_end_date` date DEFAULT NULL,
  `hr_wop_reason` text,
  PRIMARY KEY (`hr_wop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_without_pay: ~0 rows (approximately)
DELETE FROM `hr_without_pay`;
/*!40000 ALTER TABLE `hr_without_pay` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_without_pay` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_worker_recruitment
DROP TABLE IF EXISTS `hr_worker_recruitment`;
CREATE TABLE IF NOT EXISTS `hr_worker_recruitment` (
  `worker_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `worker_name` varchar(64) DEFAULT NULL,
  `worker_doj` date DEFAULT NULL,
  `worker_emp_type_id` tinyint(1) DEFAULT NULL,
  `worker_designation_id` int(11) DEFAULT NULL,
  `worker_unit_id` int(11) DEFAULT NULL,
  `worker_area_id` int(11) DEFAULT NULL,
  `worker_department_id` int(11) DEFAULT NULL,
  `worker_section_id` int(11) DEFAULT NULL,
  `worker_subsection_id` int(11) DEFAULT NULL,
  `worker_dob` date DEFAULT NULL,
  `worker_ot` varchar(10) DEFAULT NULL,
  `worker_gender` varchar(15) DEFAULT NULL,
  `worker_contact` varchar(15) DEFAULT NULL,
  `worker_nid` varchar(30) DEFAULT NULL,
  `worker_finger_print` varchar(128) DEFAULT NULL,
  `worker_height` varchar(10) DEFAULT NULL,
  `worker_weight` varchar(10) DEFAULT NULL,
  `worker_tooth_structure` varchar(64) DEFAULT NULL,
  `worker_blood_group` varchar(10) DEFAULT NULL,
  `worker_identification_mark` varchar(255) DEFAULT NULL,
  `worker_doctor_age_confirm` varchar(20) DEFAULT NULL,
  `worker_doctor_comments` varchar(255) DEFAULT NULL,
  `worker_doctor_signature` varchar(255) DEFAULT NULL,
  `worker_doctor_acceptance` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-no-change, 1-accept, 2-no-accept',
  `worker_pigboard_test` tinyint(1) NOT NULL DEFAULT '0',
  `worker_finger_test` tinyint(1) NOT NULL DEFAULT '0',
  `worker_color_join` tinyint(1) NOT NULL DEFAULT '0',
  `worker_color_band_join` tinyint(1) NOT NULL DEFAULT '0',
  `worker_box_pleat_join` tinyint(1) NOT NULL DEFAULT '0',
  `worker_color_top_stice` tinyint(1) unsigned DEFAULT '0',
  `worker_urmol_join` tinyint(1) NOT NULL DEFAULT '0',
  `worker_clip_join` tinyint(1) NOT NULL DEFAULT '0',
  `worker_salary` float NOT NULL DEFAULT '0',
  `worker_is_migrated` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`worker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_worker_recruitment: ~74 rows (approximately)
DELETE FROM `hr_worker_recruitment`;
/*!40000 ALTER TABLE `hr_worker_recruitment` DISABLE KEYS */;
INSERT INTO `hr_worker_recruitment` (`worker_id`, `worker_name`, `worker_doj`, `worker_emp_type_id`, `worker_designation_id`, `worker_unit_id`, `worker_area_id`, `worker_department_id`, `worker_section_id`, `worker_subsection_id`, `worker_dob`, `worker_ot`, `worker_gender`, `worker_contact`, `worker_nid`, `worker_finger_print`, `worker_height`, `worker_weight`, `worker_tooth_structure`, `worker_blood_group`, `worker_identification_mark`, `worker_doctor_age_confirm`, `worker_doctor_comments`, `worker_doctor_signature`, `worker_doctor_acceptance`, `worker_pigboard_test`, `worker_finger_test`, `worker_color_join`, `worker_color_band_join`, `worker_box_pleat_join`, `worker_color_top_stice`, `worker_urmol_join`, `worker_clip_join`, `worker_salary`, `worker_is_migrated`) VALUES
	(25, 'SAHERA KHATUN', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1978-02-05', '1', 'Female', '01688824633', '3313054711295', NULL, '5 FEET', '60', 'N/A', 'A+', 'N/A', '31-35', 'N/A', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7000, 1),
	(26, 'ROUSHONARA', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1982-08-25', '1', 'Female', '01688824633', '7228309248354', NULL, '5 FEET', '60', 'N/A', 'A+', NULL, '21-25', 'N/A', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7000, 1),
	(27, 'RUBEL KHAN', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1997-05-03', '1', 'Male', '01688824633', '19974218481003310', NULL, '6FEET', '60', 'N/A', 'A+', NULL, '26-30', 'N/A', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7000, 1),
	(28, 'SABINA AKTER', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1986-12-13', '1', 'Female', '01688824633', '3313054714257', NULL, '5 FEET', '60', 'N/A', 'A+', NULL, '26-30', 'N/A', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7000, 1),
	(29, 'LAILY KHATUN', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1985-07-20', '1', 'Female', '01688824633', '2617278997043', NULL, '5 FEET', '45', 'N/A', 'A+', NULL, '21-25', 'N/A', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7000, 1),
	(30, 'MST. SURMA', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1989-01-01', '1', 'Female', '01688824633', '3313054073105', NULL, '5 FEET', '60', 'N/A', 'A+', NULL, '26-30', 'N/A', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7000, 1),
	(31, 'MST. HAMIDA AKTER', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1995-01-25', '1', 'Female', '01688824633', '19951018838018239', NULL, '5 FEET', '60', 'N/A', 'A+', NULL, '26-30', 'N/A', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7000, 1),
	(32, 'MST. AKLIMA BEGUM', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1982-03-04', '1', 'Female', '01688824633', NULL, NULL, '5 FEET', '60', 'N/A', 'A+', NULL, '26-30', 'N/A', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7000, 1),
	(33, 'SHABANA', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1987-08-17', '1', 'Female', '01688824633', '3313023000567', NULL, '5 FEET', '60', 'N/A', 'A+', NULL, '26-30', 'N/A', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7000, 1),
	(34, 'PARVIN AKTER', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1986-05-05', '1', 'Female', '01688824633', '26911649126232', NULL, '5 FEET', '60', 'N/A', 'A+', NULL, '26-30', 'N/A', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7000, 1),
	(35, 'RASHED KHAN', '2018-07-18', 1, 28, 3, 2, 25, 21, 21, '1989-11-16', '0', 'Male', '01712863488', NULL, NULL, '6 feet', '65', 'N/A', 'A+', NULL, '26-30', 'N/A', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(36, 'AMINUL IT', '2018-07-21', 1, 26, 3, 2, 25, 21, 21, '2018-07-05', '1', 'Male', '01713401125', '123456789', NULL, '55', '55', 'N/A', 'A+', '55', '21-25', '55', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(37, 'MD. NAZMUL HOSSAIN', '2018-12-13', 1, 28, 3, 2, 25, NULL, NULL, '1992-07-26', '0', 'Male', '01918788060', NULL, NULL, '5\'3"', '54', 'N/A', 'O+', NULL, '26-30', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(38, 'MORIOM', '2018-07-01', 3, 33, 3, 2, 25, 21, NULL, '1999-08-25', '1', 'Female', '01712863488', NULL, NULL, '5\'', '50', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 5300, 1),
	(39, 'RUNA AKTER', '2018-07-08', 3, 33, 3, 2, 25, 21, NULL, '1999-03-12', '1', 'Female', '01712863488', NULL, NULL, '5\'', '52', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 5300, 1),
	(40, 'RITA AKTER', '2018-07-09', 3, 37, 3, 2, 25, NULL, NULL, '1995-01-01', '1', 'Female', '01712863488', NULL, NULL, '5\'', '52', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1),
	(41, 'LABONI AKTER', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1997-09-25', '0', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7300, 1),
	(42, 'MST. SHOPNA PARVIN', '2018-01-15', 3, 36, 3, 2, 25, NULL, NULL, '1993-08-23', '1', 'Female', '01712863488', NULL, NULL, '5\'', '52', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8100, 1),
	(43, 'MONIR', '2018-03-01', 3, 37, 3, 2, 25, 21, 21, '1983-02-01', '1', 'Male', '01712863488', NULL, NULL, '5\'6"', '60', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8100, 1),
	(44, 'AMENA BEGUM', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1985-04-10', '1', 'Female', '01712863488', NULL, NULL, '5\'', '54', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8100, 1),
	(45, 'NAZMA BEGUM', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1990-04-13', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '52', 'N/A', 'O+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8100, 1),
	(46, 'ABDUR RASHID', '2018-01-11', 3, 37, 3, 2, 25, 21, 21, '1999-01-07', '1', 'Male', '01712863488', NULL, NULL, '5\'6"', '60', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8300, 1),
	(47, 'MST. AKLIMA BEGUM', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1982-03-04', '1', 'Female', '01712863488', NULL, NULL, '5\'', '53', 'N/A', 'B+', NULL, '36-40', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8000, 1),
	(48, 'MAZHARUL', '2018-03-08', 3, 37, 3, 2, 25, 21, 21, '1997-01-01', '1', 'Male', '01712863488', NULL, NULL, '5\'6"', '65', 'N/A', 'B+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1),
	(49, 'RANI', '2018-07-01', 3, 37, 3, 2, 25, 21, 21, '1990-09-08', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '53', 'N/A', 'B+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8200, 1),
	(50, 'RATNA', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1988-10-18', '1', 'Female', '01712863488', NULL, NULL, '5\'', '56', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8300, 1),
	(51, 'JAHANGIR', '2018-03-12', 3, 37, 3, 2, 25, 21, 21, '1993-02-05', '0', 'Male', '01712863488', NULL, NULL, '5\'5"', '65', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8200, 1),
	(52, 'HABIBUR RAHMAN', '2018-02-12', 3, 37, 3, 2, 25, 21, 21, '1993-08-10', '1', 'Male', '01712863488', NULL, NULL, '5\'6"', '65', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7800, 1),
	(53, 'SAZEDA', '2018-03-20', 3, 37, 3, 2, 25, 21, 21, '1986-03-13', '1', 'Female', '01712863488', NULL, NULL, '5\'', '51', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8400, 1),
	(54, 'BEAUTY BEGUM', '2018-01-02', 3, 37, 3, 2, 25, 21, 21, '1988-12-10', '1', 'Female', '01712863488', NULL, NULL, '5\'', '53', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7800, 1),
	(55, 'HASAN', '2018-02-27', 3, 37, 3, 2, 25, 21, 21, '1995-06-10', '1', 'Male', '01712863488', NULL, NULL, '5\'6"', '65', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1),
	(56, 'NASIMA AKTER', '2017-10-12', 3, 37, 3, 2, 25, 21, 21, '1989-02-05', '1', 'Female', '01712863488', NULL, NULL, '5\'', '50', 'N/A', 'AB+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7800, 1),
	(57, 'RUPA AKTER', '2018-03-01', 3, 37, 3, 2, 25, 21, 21, '1989-11-10', '1', 'Female', '01712863488', NULL, NULL, '5\'', '52', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7500, 1),
	(58, 'HENA', '2018-02-01', 3, 37, 3, 2, 25, 21, 21, '1983-08-15', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7900, 1),
	(59, 'PARUL', '2018-02-08', 3, 37, 3, 2, 25, 21, 21, '1987-01-29', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8200, 1),
	(60, 'FAHIMA', '2018-03-13', 3, 37, 3, 2, 25, 21, 21, '1980-05-03', '1', 'Female', '01712863488', NULL, NULL, '5\'', '53', 'N/A', 'A+', NULL, '36-40', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8200, 1),
	(61, 'SHORIF MIA', '2018-04-02', 3, 37, 3, 2, 25, 21, 21, '1992-11-10', '1', 'Male', '01712863488', NULL, NULL, '5\'6"', '66', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7800, 1),
	(62, 'MST. HAMIDA AKTER', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1995-01-25', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7500, 1),
	(63, 'SHATHI AKTER', '2018-07-23', 3, 37, 3, 2, 25, 21, 21, '1993-03-20', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '54', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8400, 1),
	(64, 'MST. DINA AKTER', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1993-04-18', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '55', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7700, 1),
	(65, 'NAZMA BEGUM', '2018-01-11', 3, 36, 3, 2, 25, 21, 21, '1991-03-16', '1', 'Female', '01712863488', NULL, NULL, '5\'', '53', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7900, 1),
	(66, 'LIPI', '2018-03-01', 3, 37, 3, 2, 25, 21, 21, '1990-01-09', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '55', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 5300, 1),
	(67, 'MST. RUNA AKTER', '2018-07-08', 3, 37, 3, 2, 25, 21, 21, '1995-01-01', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '61', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(68, 'TANIA', '2018-07-08', 3, 33, 3, 2, 25, 21, NULL, '1998-01-12', '1', 'Female', '01712863488', NULL, NULL, '5\'', '50', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(69, 'SUFIA', '2018-04-01', 3, 37, 3, 2, 25, 21, 21, '2018-04-01', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '41-45', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(70, 'BOKUL', '2018-02-01', 3, 33, 3, 2, 25, 21, 21, '1998-01-01', '1', 'Female', '01712863488', NULL, NULL, '5\'', '51', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(71, 'FAHIMA', '2018-03-06', 3, 33, 3, 2, 25, 21, NULL, '1988-01-01', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '54', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(72, 'SALEHA KHATUN', '2018-04-21', 3, 33, 3, 2, 25, 21, NULL, '1985-10-08', '1', 'Female', '01712863488', NULL, NULL, '5\'', '53', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(73, 'SHUMITA', '2018-02-01', 3, 33, 3, 2, 25, 21, NULL, '1998-02-02', '1', 'Female', '01712863488', NULL, NULL, '5\'', '58', 'N/A', 'B+', NULL, '18-20', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(74, 'RABIA KHATUN', '2018-02-01', 3, 33, 3, 2, 25, 21, NULL, '1988-05-01', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '52', 'N/A', 'O+', NULL, '26-30', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(75, 'ISMOT ARA', '2018-03-01', 3, 33, 3, 2, 25, 21, NULL, '1993-05-20', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(76, 'SABANA', '2018-03-01', 3, 33, 3, 2, 25, 21, NULL, '1996-01-12', '1', 'Female', '01712863488', NULL, NULL, '5\'2"', '59', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(77, 'SALMA KHATUN', '2018-07-09', 3, 33, 3, 2, 25, 21, NULL, '1999-11-13', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '52', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(78, 'PARVIN AKTER', '2018-02-01', 3, 33, 3, 2, 25, 21, NULL, '1996-11-12', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '52', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(79, 'SHAIFUL', '2018-03-04', 3, 33, 3, 2, 25, 21, NULL, '1994-10-26', '0', 'Female', '01712863488', NULL, NULL, '5\'1"', '60', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(80, 'SHAHNAZ', '2018-04-03', 3, 37, 3, 2, 25, 21, NULL, '1997-07-22', '0', 'Female', '01712863488', NULL, NULL, '5\'1"', '55', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(81, 'DALIA AKTER', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1986-05-05', '1', 'Female', '01712863488', NULL, NULL, '5\'2"', '52', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(82, 'NUR JAHAN', '2018-03-05', 3, 37, 3, 2, 25, 21, 21, '1988-01-11', '1', 'Female', '01712863488', NULL, NULL, '5\'', '56', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(83, 'JAHANGIR ALOM', '2018-07-29', 3, 37, 3, 2, 25, 21, 21, '1991-02-12', '1', 'Male', '01712863488', NULL, NULL, '5\'1"', '52', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8000, 1),
	(84, 'MOZIRON', '2018-03-08', 3, 37, 3, 2, 25, 21, 21, '1981-07-04', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '53', 'N/A', 'A+', NULL, '36-40', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7900, 1),
	(85, 'ANOWARA', '2018-05-13', 3, 37, 3, 2, 25, 21, 21, '1986-03-04', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '51', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7400, 1),
	(86, 'AKLIMA', '2018-03-10', 3, 37, 3, 2, 25, 21, 21, '1998-03-10', '1', 'Female', '01712863488', NULL, NULL, '5\'', '50', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7500, 1),
	(87, 'SHATHI AKTER', '2018-02-26', 3, 37, 3, 2, 25, 21, 21, '1992-06-10', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '52', 'N/A', 'B+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7800, 1),
	(88, 'SHATHI', '2018-04-16', 3, 37, 3, 2, 25, 21, 21, '1992-02-01', '1', 'Female', '01712863488', NULL, NULL, '5\'2"', '55', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7100, 1),
	(89, 'SAIDUL', '2018-03-11', 3, 37, 3, 2, 25, 21, 21, '1998-01-01', '1', 'Male', '01712863488', NULL, NULL, '5\'6"', '65', 'N/A', 'A+', NULL, '18-20', 'Acceppted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8000, 1),
	(90, 'KOLPONA BEGUM', '2018-02-01', 3, 37, 3, 2, 25, 21, 21, '1994-06-10', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '52', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8100, 1),
	(91, 'POLY', '2018-07-11', 3, 37, 3, 2, 25, 21, 21, '1998-07-10', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8500, 1),
	(92, 'SIMU AKTER', '2018-01-03', 3, 37, 3, 2, 25, 21, 21, '1995-08-12', '1', 'Female', '01712863488', NULL, NULL, '5\'', '52', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7100, 1),
	(93, 'ASMA', '2018-03-01', 3, 37, 3, 2, 25, 21, 21, '1991-04-03', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '58', 'N/A', 'B+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7900, 1),
	(94, 'ROBIUL', '2018-04-01', 3, 37, 3, 2, 25, 21, 21, '1999-06-01', '1', 'Male', '01712863488', NULL, NULL, '5\'6"', '60', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8400, 1),
	(95, 'KOLPONA', '2018-07-24', 3, 37, 3, 2, 25, 21, 21, '1990-01-01', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '55', 'N/A', 'O+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8400, 1),
	(96, 'HENA', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1981-10-25', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '36-40', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8300, 1),
	(97, 'FATEMA KHATUN', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1993-07-06', '1', 'Female', '01712863488', NULL, NULL, '5\'1"', '52', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7600, 1),
	(98, 'RAZIA SULTANA', '2018-01-13', 3, 37, 3, 2, 25, 21, 21, '1988-06-10', '1', 'Female', '01712863488', NULL, NULL, '5\'', '54', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7900, 1);
/*!40000 ALTER TABLE `hr_worker_recruitment` ENABLE KEYS */;

-- Dumping structure for table mbmerp.hr_yearly_holiday_planner
DROP TABLE IF EXISTS `hr_yearly_holiday_planner`;
CREATE TABLE IF NOT EXISTS `hr_yearly_holiday_planner` (
  `hr_yhp_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hr_yhp_unit` int(11) DEFAULT NULL,
  `hr_yhp_dates_of_holidays` date NOT NULL,
  `hr_yhp_comments` text NOT NULL,
  `hr_yhp_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`hr_yhp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.hr_yearly_holiday_planner: ~4 rows (approximately)
DELETE FROM `hr_yearly_holiday_planner`;
/*!40000 ALTER TABLE `hr_yearly_holiday_planner` DISABLE KEYS */;
INSERT INTO `hr_yearly_holiday_planner` (`hr_yhp_id`, `hr_yhp_unit`, `hr_yhp_dates_of_holidays`, `hr_yhp_comments`, `hr_yhp_status`) VALUES
	(1, 3, '2018-07-06', 'Weekend', 0),
	(2, 3, '2018-07-13', 'Weekend', 1),
	(3, 3, '2018-07-20', 'Weekend', 1),
	(4, 3, '2018-07-27', 'Weekend', 1);
/*!40000 ALTER TABLE `hr_yearly_holiday_planner` ENABLE KEYS */;

-- Dumping structure for table mbmerp.model_has_permissions
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.model_has_permissions: ~0 rows (approximately)
DELETE FROM `model_has_permissions`;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table mbmerp.model_has_roles
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.model_has_roles: ~13 rows (approximately)
DELETE FROM `model_has_roles`;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_id`, `model_type`) VALUES
	(4, 1, 'App\\User'),
	(4, 3, 'App\\User'),
	(4, 6, 'App\\User'),
	(4, 8, 'App\\User'),
	(5, 1, 'App\\User'),
	(5, 2, 'App\\User'),
	(5, 3, 'App\\User'),
	(5, 5, 'App\\User'),
	(5, 6, 'App\\User'),
	(5, 8, 'App\\User'),
	(8, 9, 'App\\User'),
	(14, 4, 'App\\User'),
	(16, 10, 'App\\User');
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_action_type
DROP TABLE IF EXISTS `mr_action_type`;
CREATE TABLE IF NOT EXISTS `mr_action_type` (
  `act_id` int(11) NOT NULL AUTO_INCREMENT,
  `act_name` varchar(50) NOT NULL,
  `act_code` varchar(20) NOT NULL,
  PRIMARY KEY (`act_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_action_type: ~0 rows (approximately)
DELETE FROM `mr_action_type`;
/*!40000 ALTER TABLE `mr_action_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_action_type` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_brand
DROP TABLE IF EXISTS `mr_brand`;
CREATE TABLE IF NOT EXISTS `mr_brand` (
  `br_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `br_name` varchar(255) NOT NULL,
  `br_shortname` varchar(255) NOT NULL,
  PRIMARY KEY (`br_id`),
  UNIQUE KEY `br_shortname` (`br_shortname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_brand: ~0 rows (approximately)
DELETE FROM `mr_brand`;
/*!40000 ALTER TABLE `mr_brand` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_brand` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_brand_contact
DROP TABLE IF EXISTS `mr_brand_contact`;
CREATE TABLE IF NOT EXISTS `mr_brand_contact` (
  `brcon_id` int(11) NOT NULL AUTO_INCREMENT,
  `br_id` int(11) NOT NULL,
  `brcontact_person` varchar(255) NOT NULL,
  PRIMARY KEY (`brcon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_brand_contact: ~0 rows (approximately)
DELETE FROM `mr_brand_contact`;
/*!40000 ALTER TABLE `mr_brand_contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_brand_contact` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_buyer
DROP TABLE IF EXISTS `mr_buyer`;
CREATE TABLE IF NOT EXISTS `mr_buyer` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_name` varchar(255) NOT NULL,
  `b_shortname` varchar(255) NOT NULL,
  `b_address` varchar(255) NOT NULL,
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `b_shortname` (`b_shortname`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_buyer: ~2 rows (approximately)
DELETE FROM `mr_buyer`;
/*!40000 ALTER TABLE `mr_buyer` DISABLE KEYS */;
INSERT INTO `mr_buyer` (`b_id`, `b_name`, `b_shortname`, `b_address`) VALUES
	(1, 'trty', 'tyrty', 'asdad'),
	(2, 'dsrgsd', 'dfsdf', 'fsdfsdfsdf');
/*!40000 ALTER TABLE `mr_buyer` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_buyer_contact
DROP TABLE IF EXISTS `mr_buyer_contact`;
CREATE TABLE IF NOT EXISTS `mr_buyer_contact` (
  `bcont_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `bcontact_person` varchar(255) NOT NULL,
  PRIMARY KEY (`bcont_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_buyer_contact: ~4 rows (approximately)
DELETE FROM `mr_buyer_contact`;
/*!40000 ALTER TABLE `mr_buyer_contact` DISABLE KEYS */;
INSERT INTO `mr_buyer_contact` (`bcont_id`, `b_id`, `bcontact_person`) VALUES
	(1, 1, 'fdvdg'),
	(2, 1, 'dfgd'),
	(3, 1, '5456'),
	(4, 2, 'sdfs');
/*!40000 ALTER TABLE `mr_buyer_contact` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_country
DROP TABLE IF EXISTS `mr_country`;
CREATE TABLE IF NOT EXISTS `mr_country` (
  `cnt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cnt_name` varchar(50) NOT NULL,
  PRIMARY KEY (`cnt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_country: 246 rows
DELETE FROM `mr_country`;
/*!40000 ALTER TABLE `mr_country` DISABLE KEYS */;
INSERT INTO `mr_country` (`cnt_id`, `cnt_name`) VALUES
	(1, 'Afghanistan'),
	(2, 'Albania'),
	(3, 'Algeria'),
	(4, 'American Samoa'),
	(5, 'Andorra'),
	(6, 'Angola'),
	(7, 'Anguilla'),
	(8, 'Antarctica'),
	(9, 'Antigua and Barbuda'),
	(10, 'Argentina'),
	(11, 'Armenia'),
	(12, 'Aruba'),
	(13, 'Australia'),
	(14, 'Austria'),
	(15, 'Azerbaijan'),
	(16, 'Bahamas'),
	(17, 'Bahrain'),
	(18, 'Bangladesh'),
	(19, 'Barbados'),
	(20, 'Belarus'),
	(21, 'Belgium'),
	(22, 'Belize'),
	(23, 'Benin'),
	(24, 'Bermuda'),
	(25, 'Bhutan'),
	(26, 'Bolivia'),
	(27, 'Bosnia and Herzegovina'),
	(28, 'Botswana'),
	(29, 'Bouvet Island'),
	(30, 'Brazil'),
	(31, 'British Indian Ocean Territory'),
	(32, 'Brunei Darussalam'),
	(33, 'Bulgaria'),
	(34, 'Burkina Faso'),
	(35, 'Burundi'),
	(36, 'Cambodia'),
	(37, 'Cameroon'),
	(38, 'Canada'),
	(39, 'Cape Verde'),
	(40, 'Cayman Islands'),
	(41, 'Central African Republic'),
	(42, 'Chad'),
	(43, 'Chile'),
	(44, 'China'),
	(45, 'Christmas Island'),
	(46, 'Cocos (Keeling) Islands'),
	(47, 'Colombia'),
	(48, 'Comoros'),
	(49, 'Congo'),
	(50, 'Cook Islands'),
	(51, 'Costa Rica'),
	(52, 'Croatia (Hrvatska)'),
	(53, 'Cuba'),
	(54, 'Cyprus'),
	(55, 'Czech Republic'),
	(56, 'Denmark'),
	(57, 'Djibouti'),
	(58, 'Dominica'),
	(59, 'Dominican Republic'),
	(60, 'East Timor'),
	(61, 'Ecuador'),
	(62, 'Egypt'),
	(63, 'El Salvador'),
	(64, 'Equatorial Guinea'),
	(65, 'Eritrea'),
	(66, 'Estonia'),
	(67, 'Ethiopia'),
	(68, 'Falkland Islands (Malvinas)'),
	(69, 'Faroe Islands'),
	(70, 'Fiji'),
	(71, 'Finland'),
	(72, 'France'),
	(73, 'France, Metropolitan'),
	(74, 'French Guiana'),
	(75, 'French Polynesia'),
	(76, 'French Southern Territories'),
	(77, 'Gabon'),
	(78, 'Gambia'),
	(79, 'Georgia'),
	(80, 'Germany'),
	(81, 'Ghana'),
	(82, 'Gibraltar'),
	(83, 'Guernsey'),
	(84, 'Greece'),
	(85, 'Greenland'),
	(86, 'Grenada'),
	(87, 'Guadeloupe'),
	(88, 'Guam'),
	(89, 'Guatemala'),
	(90, 'Guinea'),
	(91, 'Guinea-Bissau'),
	(92, 'Guyana'),
	(93, 'Haiti'),
	(94, 'Heard and Mc Donald Islands'),
	(95, 'Honduras'),
	(96, 'Hong Kong'),
	(97, 'Hungary'),
	(98, 'Iceland'),
	(99, 'India'),
	(100, 'Isle of Man'),
	(101, 'Indonesia'),
	(102, 'Iran (Islamic Republic of)'),
	(103, 'Iraq'),
	(104, 'Ireland'),
	(105, 'Israel'),
	(106, 'Italy'),
	(107, 'Ivory Coast'),
	(108, 'Jersey'),
	(109, 'Jamaica'),
	(110, 'Japan'),
	(111, 'Jordan'),
	(112, 'Kazakhstan'),
	(113, 'Kenya'),
	(114, 'Kiribati'),
	(115, 'Korea, Democratic People\'s Republic of'),
	(116, 'Korea, Republic of'),
	(117, 'Kosovo'),
	(118, 'Kuwait'),
	(119, 'Kyrgyzstan'),
	(120, 'Lao People\'s Democratic Republic'),
	(121, 'Latvia'),
	(122, 'Lebanon'),
	(123, 'Lesotho'),
	(124, 'Liberia'),
	(125, 'Libyan Arab Jamahiriya'),
	(126, 'Liechtenstein'),
	(127, 'Lithuania'),
	(128, 'Luxembourg'),
	(129, 'Macau'),
	(130, 'Macedonia'),
	(131, 'Madagascar'),
	(132, 'Malawi'),
	(133, 'Malaysia'),
	(134, 'Maldives'),
	(135, 'Mali'),
	(136, 'Malta'),
	(137, 'Marshall Islands'),
	(138, 'Martinique'),
	(139, 'Mauritania'),
	(140, 'Mauritius'),
	(141, 'Mayotte'),
	(142, 'Mexico'),
	(143, 'Micronesia, Federated States of'),
	(144, 'Moldova, Republic of'),
	(145, 'Monaco'),
	(146, 'Mongolia'),
	(147, 'Montenegro'),
	(148, 'Montserrat'),
	(149, 'Morocco'),
	(150, 'Mozambique'),
	(151, 'Myanmar'),
	(152, 'Namibia'),
	(153, 'Nauru'),
	(154, 'Nepal'),
	(155, 'Netherlands'),
	(156, 'Netherlands Antilles'),
	(157, 'New Caledonia'),
	(158, 'New Zealand'),
	(159, 'Nicaragua'),
	(160, 'Niger'),
	(161, 'Nigeria'),
	(162, 'Niue'),
	(163, 'Norfolk Island'),
	(164, 'Northern Mariana Islands'),
	(165, 'Norway'),
	(166, 'Oman'),
	(167, 'Pakistan'),
	(168, 'Palau'),
	(169, 'Palestine'),
	(170, 'Panama'),
	(171, 'Papua New Guinea'),
	(172, 'Paraguay'),
	(173, 'Peru'),
	(174, 'Philippines'),
	(175, 'Pitcairn'),
	(176, 'Poland'),
	(177, 'Portugal'),
	(178, 'Puerto Rico'),
	(179, 'Qatar'),
	(180, 'Reunion'),
	(181, 'Romania'),
	(182, 'Russian Federation'),
	(183, 'Rwanda'),
	(184, 'Saint Kitts and Nevis'),
	(185, 'Saint Lucia'),
	(186, 'Saint Vincent and the Grenadines'),
	(187, 'Samoa'),
	(188, 'San Marino'),
	(189, 'Sao Tome and Principe'),
	(190, 'Saudi Arabia'),
	(191, 'Senegal'),
	(192, 'Serbia'),
	(193, 'Seychelles'),
	(194, 'Sierra Leone'),
	(195, 'Singapore'),
	(196, 'Slovakia'),
	(197, 'Slovenia'),
	(198, 'Solomon Islands'),
	(199, 'Somalia'),
	(200, 'South Africa'),
	(201, 'South Georgia South Sandwich Islands'),
	(202, 'South Sudan'),
	(203, 'Spain'),
	(204, 'Sri Lanka'),
	(205, 'St. Helena'),
	(206, 'St. Pierre and Miquelon'),
	(207, 'Sudan'),
	(208, 'Suriname'),
	(209, 'Svalbard and Jan Mayen Islands'),
	(210, 'Swaziland'),
	(211, 'Sweden'),
	(212, 'Switzerland'),
	(213, 'Syrian Arab Republic'),
	(214, 'Taiwan'),
	(215, 'Tajikistan'),
	(216, 'Tanzania, United Republic of'),
	(217, 'Thailand'),
	(218, 'Togo'),
	(219, 'Tokelau'),
	(220, 'Tonga'),
	(221, 'Trinidad and Tobago'),
	(222, 'Tunisia'),
	(223, 'Turkey'),
	(224, 'Turkmenistan'),
	(225, 'Turks and Caicos Islands'),
	(226, 'Tuvalu'),
	(227, 'Uganda'),
	(228, 'Ukraine'),
	(229, 'United Arab Emirates'),
	(230, 'United Kingdom'),
	(231, 'United States'),
	(232, 'United States minor outlying islands'),
	(233, 'Uruguay'),
	(234, 'Uzbekistan'),
	(235, 'Vanuatu'),
	(236, 'Vatican City State'),
	(237, 'Venezuela'),
	(238, 'Vietnam'),
	(239, 'Virgin Islands (British)'),
	(240, 'Virgin Islands (U.S.)'),
	(241, 'Wallis and Futuna Islands'),
	(242, 'Western Sahara'),
	(243, 'Yemen'),
	(244, 'Zaire'),
	(245, 'Zambia'),
	(246, 'Zimbabwe');
/*!40000 ALTER TABLE `mr_country` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_element
DROP TABLE IF EXISTS `mr_element`;
CREATE TABLE IF NOT EXISTS `mr_element` (
  `el_id` int(11) NOT NULL AUTO_INCREMENT,
  `act_id` int(11) NOT NULL,
  `el_name` varchar(50) NOT NULL,
  `el_code` varchar(20) NOT NULL,
  `el_offset_day` int(11) DEFAULT NULL,
  `el_offset_based_on` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`el_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_element: ~0 rows (approximately)
DELETE FROM `mr_element`;
/*!40000 ALTER TABLE `mr_element` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_element` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_garment_type
DROP TABLE IF EXISTS `mr_garment_type`;
CREATE TABLE IF NOT EXISTS `mr_garment_type` (
  `gmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `stp_id` int(11) NOT NULL,
  `gmt_name` varchar(50) NOT NULL,
  `gmt_code` varchar(20) NOT NULL,
  `gmt_desc` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`gmt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_garment_type: ~0 rows (approximately)
DELETE FROM `mr_garment_type`;
/*!40000 ALTER TABLE `mr_garment_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_garment_type` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_material_category
DROP TABLE IF EXISTS `mr_material_category`;
CREATE TABLE IF NOT EXISTS `mr_material_category` (
  `mcat_id` int(11) NOT NULL AUTO_INCREMENT,
  `mcat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`mcat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_material_category: ~0 rows (approximately)
DELETE FROM `mr_material_category`;
/*!40000 ALTER TABLE `mr_material_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_material_category` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_material_item
DROP TABLE IF EXISTS `mr_material_item`;
CREATE TABLE IF NOT EXISTS `mr_material_item` (
  `matitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `mcat_id` int(11) NOT NULL,
  `msubcat_id` int(11) NOT NULL,
  `matitem_name` varchar(50) NOT NULL,
  `matitem_mill_name` varchar(50) DEFAULT NULL,
  `matitem_mill_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`matitem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_material_item: ~0 rows (approximately)
DELETE FROM `mr_material_item`;
/*!40000 ALTER TABLE `mr_material_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_material_item` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_material_sub_cat
DROP TABLE IF EXISTS `mr_material_sub_cat`;
CREATE TABLE IF NOT EXISTS `mr_material_sub_cat` (
  `msubcat_id` int(11) NOT NULL AUTO_INCREMENT,
  `mcat_id` int(11) NOT NULL,
  `msubcat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`msubcat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_material_sub_cat: ~0 rows (approximately)
DELETE FROM `mr_material_sub_cat`;
/*!40000 ALTER TABLE `mr_material_sub_cat` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_material_sub_cat` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_season
DROP TABLE IF EXISTS `mr_season`;
CREATE TABLE IF NOT EXISTS `mr_season` (
  `se_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `se_name` varchar(50) NOT NULL,
  `se_code` varchar(20) NOT NULL,
  `se_mm_start` int(11) DEFAULT NULL,
  `se_yy_start` int(11) DEFAULT NULL,
  `se_mm_end` int(11) DEFAULT NULL,
  `se_yy_end` int(11) DEFAULT NULL,
  PRIMARY KEY (`se_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_season: ~0 rows (approximately)
DELETE FROM `mr_season`;
/*!40000 ALTER TABLE `mr_season` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_season` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_style_type
DROP TABLE IF EXISTS `mr_style_type`;
CREATE TABLE IF NOT EXISTS `mr_style_type` (
  `stp_id` int(11) NOT NULL AUTO_INCREMENT,
  `stp_name` varchar(50) NOT NULL,
  PRIMARY KEY (`stp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_style_type: ~0 rows (approximately)
DELETE FROM `mr_style_type`;
/*!40000 ALTER TABLE `mr_style_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_style_type` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_supplier
DROP TABLE IF EXISTS `mr_supplier`;
CREATE TABLE IF NOT EXISTS `mr_supplier` (
  `sup_id` int(11) NOT NULL AUTO_INCREMENT,
  `cnt_id` int(11) NOT NULL,
  `sup_name` varchar(50) NOT NULL,
  `sup_address` varchar(128) DEFAULT NULL,
  `sup_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`sup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_supplier: ~0 rows (approximately)
DELETE FROM `mr_supplier`;
/*!40000 ALTER TABLE `mr_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_supplier` ENABLE KEYS */;

-- Dumping structure for table mbmerp.mr_sup_contact_person_info
DROP TABLE IF EXISTS `mr_sup_contact_person_info`;
CREATE TABLE IF NOT EXISTS `mr_sup_contact_person_info` (
  `scp_id` int(11) NOT NULL AUTO_INCREMENT,
  `sup_id` int(11) NOT NULL,
  `scp_details` varchar(50) NOT NULL,
  PRIMARY KEY (`scp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.mr_sup_contact_person_info: ~0 rows (approximately)
DELETE FROM `mr_sup_contact_person_info`;
/*!40000 ALTER TABLE `mr_sup_contact_person_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_sup_contact_person_info` ENABLE KEYS */;

-- Dumping structure for table mbmerp.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.permissions: ~41 rows (approximately)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'users_management', 'web', '2018-04-17 09:56:03', '2018-05-24 06:39:00'),
	(24, 'hr_recruitment_employer_list', 'web', '2018-05-30 08:05:53', '2018-05-30 08:05:53'),
	(25, 'hr_recruitment_job_posting', 'web', '2018-05-30 08:25:43', '2018-05-30 08:25:43'),
	(26, 'hr_recruitment_job_interview', 'web', '2018-05-30 08:30:50', '2018-05-30 08:30:50'),
	(27, 'hr_recruitment_job_letter', 'web', '2018-05-30 08:40:23', '2018-05-30 08:40:23'),
	(29, 'hr_recruitment_op_medical_list', 'web', '2018-05-30 08:55:50', '2018-05-30 08:58:41'),
	(31, 'hr_recruitment_op_adv_list', 'web', '2018-05-30 09:07:11', '2018-05-30 09:07:11'),
	(32, 'hr_recruitment_op_benefit', 'web', '2018-05-30 09:22:55', '2018-05-30 09:22:55'),
	(33, 'hr_recruitment_op_medical_incident', 'web', '2018-05-31 05:26:13', '2018-05-31 05:26:13'),
	(34, 'hr_training_add', 'web', '2018-05-31 05:34:51', '2018-05-31 05:34:51'),
	(35, 'hr_training_list', 'web', '2018-05-31 05:35:13', '2018-05-31 05:35:13'),
	(36, 'hr_training_assign', 'web', '2018-05-31 05:39:11', '2018-05-31 05:39:11'),
	(37, 'hr_training_assign_list', 'web', '2018-05-31 05:39:17', '2018-05-31 05:39:17'),
	(38, 'hr_asset_assign_list', 'web', '2018-05-31 05:50:16', '2018-05-31 05:50:16'),
	(39, 'hr_asset_assign', 'web', '2018-05-31 05:50:22', '2018-05-31 05:50:22'),
	(40, 'hr_time_daily_att_list', 'web', '2018-05-31 06:02:15', '2018-05-31 06:02:15'),
	(41, 'hr_time_manual_att', 'web', '2018-05-31 06:05:41', '2018-05-31 06:05:41'),
	(42, 'hr_time_worker_leave', 'web', '2018-05-31 06:09:36', '2018-05-31 06:09:36'),
	(43, 'hr_time_leaves', 'web', '2018-05-31 06:17:23', '2018-05-31 06:17:23'),
	(44, 'hr_time_shift_assign', 'web', '2018-05-31 06:29:36', '2018-05-31 06:29:36'),
	(45, 'hr_time_shift_roaster', 'web', '2018-05-31 06:29:45', '2018-05-31 06:29:45'),
	(46, 'hr_time_op_holiday', 'web', '2018-05-31 06:33:10', '2018-05-31 06:33:10'),
	(47, 'hr_time_op_without_pay', 'web', '2018-05-31 06:36:28', '2018-05-31 06:36:28'),
	(48, 'hr_time_id_card', 'web', '2018-05-31 06:39:19', '2018-05-31 06:39:19'),
	(49, 'hr_payroll_ot', 'web', '2018-05-31 06:45:41', '2018-05-31 06:45:41'),
	(50, 'hr_payroll_benefit_list', 'web', '2018-05-31 06:49:04', '2018-05-31 06:49:04'),
	(51, 'hr_payroll_loan_list', 'web', '2018-05-31 06:56:25', '2018-05-31 06:56:25'),
	(52, 'hr_ess_grievance_appeal', 'web', '2018-05-31 07:11:53', '2018-05-31 07:11:53'),
	(53, 'hr_ess_grievance_list', 'web', '2018-05-31 07:12:10', '2018-05-31 07:12:10'),
	(54, 'hr_ess_loan_application', 'web', '2018-05-31 07:16:46', '2018-05-31 07:16:46'),
	(55, 'hr_ess_leave_application', 'web', '2018-05-31 07:19:52', '2018-05-31 07:19:52'),
	(56, 'hr_performance_appraisal', 'web', '2018-05-31 07:36:28', '2018-05-31 07:36:28'),
	(57, 'hr_performance_list', 'web', '2018-05-31 07:41:46', '2018-05-31 07:41:46'),
	(58, 'hr_performance_op_disc', 'web', '2018-05-31 07:46:49', '2018-05-31 07:46:49'),
	(59, 'hr_performance_op_disc_list', 'web', '2018-05-31 07:46:56', '2018-05-31 07:46:56'),
	(60, 'hr_setup', 'web', '2018-05-31 07:55:50', '2018-05-31 07:55:50'),
	(61, 'hr_time_op_hdoliday', 'web', '2018-06-06 09:25:43', '2018-06-06 09:25:43'),
	(62, 'hr_recruitment_worker', 'web', '2018-06-27 04:39:56', '2018-06-27 04:39:56'),
	(63, 'hr_payroll_salary', 'web', '2018-06-28 11:53:55', '2018-06-28 11:53:55'),
	(64, 'hr_notification', 'web', '2018-07-16 19:00:50', '2018-07-16 19:00:50'),
	(65, 'hr_recruitment_medical', 'web', '2018-07-18 23:23:50', '2018-07-18 23:23:50');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table mbmerp.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.roles: ~13 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(4, 'users_management', 'web', NULL, '2018-05-30 08:07:30'),
	(5, 'hr_admin', 'web', '2018-05-30 08:06:59', '2018-05-30 08:18:50'),
	(6, 'hr_management', 'web', '2018-06-04 03:50:16', '2018-06-04 03:50:16'),
	(7, 'hr_supervisor', 'web', '2018-06-04 05:37:33', '2018-06-04 05:37:33'),
	(8, 'hr_executive', 'web', '2018-06-04 05:46:13', '2018-06-04 05:46:13'),
	(9, 'hr_executive_recruitment', 'web', '2018-06-04 05:48:10', '2018-06-04 05:48:10'),
	(10, 'hr_executive_training', 'web', '2018-06-04 05:48:45', '2018-06-04 05:48:45'),
	(11, 'hr_executive_asset', 'web', '2018-06-04 05:49:35', '2018-06-04 05:49:35'),
	(12, 'hr_executive_time_att', 'web', '2018-06-04 05:54:56', '2018-06-04 05:54:56'),
	(13, 'hr_executive_payroll', 'web', '2018-06-04 05:56:11', '2018-06-04 05:56:11'),
	(14, 'hr_associate', 'web', '2018-06-04 05:57:12', '2018-06-04 05:57:12'),
	(15, 'hr_executive_performance', 'web', '2018-06-04 05:58:27', '2018-06-04 05:58:27'),
	(16, 'hr_medical', 'web', '2018-07-18 23:25:00', '2018-07-18 23:25:00');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table mbmerp.role_has_permissions
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.role_has_permissions: ~147 rows (approximately)
DELETE FROM `role_has_permissions`;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 4),
	(24, 5),
	(24, 6),
	(24, 7),
	(24, 8),
	(24, 9),
	(25, 5),
	(25, 7),
	(25, 8),
	(25, 9),
	(26, 5),
	(26, 6),
	(26, 7),
	(26, 8),
	(26, 9),
	(27, 5),
	(27, 7),
	(27, 8),
	(27, 9),
	(29, 5),
	(29, 6),
	(29, 7),
	(29, 8),
	(29, 9),
	(29, 16),
	(31, 5),
	(31, 6),
	(31, 7),
	(31, 8),
	(31, 9),
	(32, 5),
	(32, 7),
	(32, 8),
	(32, 9),
	(33, 5),
	(33, 7),
	(33, 8),
	(33, 9),
	(33, 16),
	(34, 5),
	(34, 7),
	(34, 8),
	(34, 10),
	(35, 5),
	(35, 6),
	(35, 7),
	(35, 8),
	(35, 10),
	(36, 5),
	(36, 7),
	(36, 8),
	(36, 10),
	(37, 5),
	(37, 6),
	(37, 7),
	(37, 8),
	(37, 10),
	(38, 5),
	(38, 7),
	(38, 8),
	(38, 11),
	(39, 5),
	(39, 7),
	(39, 8),
	(39, 11),
	(40, 5),
	(40, 6),
	(40, 7),
	(40, 8),
	(40, 12),
	(41, 5),
	(41, 7),
	(41, 8),
	(41, 12),
	(42, 5),
	(42, 7),
	(42, 8),
	(42, 12),
	(43, 5),
	(43, 7),
	(43, 8),
	(43, 12),
	(44, 5),
	(44, 7),
	(44, 8),
	(44, 12),
	(45, 5),
	(45, 6),
	(45, 7),
	(45, 8),
	(45, 12),
	(46, 5),
	(46, 7),
	(46, 8),
	(46, 12),
	(47, 5),
	(47, 7),
	(47, 8),
	(47, 12),
	(48, 5),
	(48, 7),
	(48, 8),
	(48, 12),
	(49, 5),
	(49, 7),
	(49, 13),
	(50, 5),
	(50, 6),
	(50, 7),
	(50, 13),
	(51, 5),
	(51, 6),
	(51, 7),
	(51, 13),
	(52, 5),
	(53, 5),
	(54, 5),
	(54, 6),
	(54, 14),
	(55, 5),
	(55, 6),
	(55, 14),
	(56, 5),
	(56, 7),
	(56, 8),
	(56, 15),
	(57, 5),
	(57, 7),
	(57, 8),
	(57, 15),
	(58, 5),
	(58, 7),
	(58, 8),
	(58, 15),
	(59, 5),
	(59, 6),
	(59, 7),
	(59, 8),
	(59, 15),
	(60, 5),
	(62, 5),
	(62, 7),
	(62, 8),
	(62, 9),
	(63, 5),
	(64, 5),
	(65, 16);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table mbmerp.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `associate_id` varchar(10) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `password_request` tinyint(1) DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table mbmerp.users: ~4 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `associate_id`, `email`, `password`, `password_request`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', '9999999999', 'admin@muktiventures.com', '$2y$10$6XJ4DU.vlHO8zXtTw3MtpejzOmvXvTMNgniH.JnU5codmHaf.fMeC', 0, 'bKFfmQ3RsbSaU2UZbSbVk0K4fIOao2tsJAsTElADpcwlJASWrbc2z80SdAxJ', '2018-04-29 11:30:41', '2018-06-12 04:03:26'),
	(8, 'MBM IT', '17F005001B', 'mbmit@example.com', '$2y$10$YRVZsgt1ULZRRE8th1GHgeMOvv3lwJcF8x7p5/Ca.IrUJ6m3B2DFy', 0, 'TEBYA8ha12KgQW9AOpQV4Z8q5WwPkKNb9O1XfCTgSgZQ0aPIrZYb10d8abQo', '2018-07-17 18:13:29', '2018-07-17 18:13:29'),
	(9, 'RASHED KHAN', '18G100011N', 'hr@aql-bd.com', '$2y$10$8AqcqZkEkN0zEMVZOnvnCuQf25g3nO556iQqPvNCxy3WJZaqwGgqu', 0, NULL, '2018-07-18 22:46:17', '2018-07-18 22:46:17'),
	(10, 'RUBEL KHAN', '18A100002N', 'rubel@example.com', '$2y$10$jjZ3ajwZJCYMF57X59cdTeiE1MJ86sAf9Dy9kgLhPM5Op.6YDiDzy', 0, '2EUWV5MAsd31hVC19NheawmhJT1P1B6O4b78HbAH4PWwHGNqn1lHDGCiA19x', '2018-07-18 23:26:58', '2018-07-18 23:26:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for trigger mbmerp.test_1
DROP TRIGGER IF EXISTS `test_1`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `test_1` BEFORE INSERT ON `checkinout` FOR EACH ROW BEGIN
IF ((SELECT TIMESTAMPDIFF(hour,(SELECT in_time FROM hr_attendance WHERE as_id=new.Userid ORDER BY att_id DESC LIMIT 1), new.CheckTime))<= 14) THEN
UPDATE hr_attendance SET out_time= new.CheckTime WHERE as_id=new.Userid ORDER BY att_id DESC LIMIT 1;
ELSE
INSERT INTO hr_attendance (as_id, in_time, hr_shift_code) SELECT new.Userid, new.CheckTime, (SELECT (Case
        When (day(new.CheckTime)=1) Then hr_shift_roaster.day_1
 When (day(new.CheckTime)=2) Then hr_shift_roaster.day_2
 When (day(new.CheckTime)=3) Then hr_shift_roaster.day_3
 When (day(new.CheckTime)=4) Then hr_shift_roaster.day_4
 When (day(new.CheckTime)=5) Then hr_shift_roaster.day_5
 When (day(new.CheckTime)=6) Then hr_shift_roaster.day_6
 When (day(new.CheckTime)=7) Then hr_shift_roaster.day_7
 When (day(new.CheckTime)=8) Then hr_shift_roaster.day_8
 When (day(new.CheckTime)=9) Then hr_shift_roaster.day_9
 When (day(new.CheckTime)=10) Then hr_shift_roaster.day_10
 When (day(new.CheckTime)=11) Then hr_shift_roaster.day_11
 When (day(new.CheckTime)=12) Then hr_shift_roaster.day_12
 When (day(new.CheckTime)=13) Then hr_shift_roaster.day_13
 When (day(new.CheckTime)=14) Then hr_shift_roaster.day_14
 When (day(new.CheckTime)=15) Then hr_shift_roaster.day_15
 When (day(new.CheckTime)=16) Then hr_shift_roaster.day_16
 When (day(new.CheckTime)=17) Then hr_shift_roaster.day_17
 When (day(new.CheckTime)=18) Then hr_shift_roaster.day_18
 When (day(new.CheckTime)=19) Then hr_shift_roaster.day_19
 When (day(new.CheckTime)=20) Then hr_shift_roaster.day_20
 When (day(new.CheckTime)=21) Then hr_shift_roaster.day_21
 When (day(new.CheckTime)=22) Then hr_shift_roaster.day_22
 When (day(new.CheckTime)=23) Then hr_shift_roaster.day_23
 When (day(new.CheckTime)=24) Then hr_shift_roaster.day_24
 When (day(new.CheckTime)=25) Then hr_shift_roaster.day_25
 When (day(new.CheckTime)=26) Then hr_shift_roaster.day_26
 When (day(new.CheckTime)=27) Then hr_shift_roaster.day_27
 When (day(new.CheckTime)=28) Then hr_shift_roaster.day_28
 When (day(new.CheckTime)=29) Then hr_shift_roaster.day_29
 When (day(new.CheckTime)=30) Then hr_shift_roaster.day_30
 When (day(new.CheckTime)=31) Then hr_shift_roaster.day_31
       End)FROM hr_shift_roaster WHERE shift_roaster_user_id=new.Userid) FROM hr_shift_roaster s WHERE s.shift_roaster_user_id= new.Userid;
END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
