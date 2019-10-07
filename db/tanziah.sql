

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbmerp`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkinout`
--

CREATE TABLE `checkinout` (
  `Logid` int(11) NOT NULL,
  `Userid` int(11) NOT NULL DEFAULT '0',
  `CheckTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CheckType` int(11) DEFAULT '0',
  `Sensorid` int(11) DEFAULT '0',
  `WorkType` int(11) DEFAULT '0',
  `AttFlag` int(11) DEFAULT '0',
  `Checked` tinyint(1) DEFAULT NULL,
  `Exported` tinyint(1) DEFAULT NULL,
  `OpenDoorFlag` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkinout`
--

INSERT INTO `checkinout` (`Logid`, `Userid`, `CheckTime`, `CheckType`, `Sensorid`, `WorkType`, `AttFlag`, `Checked`, `Exported`, `OpenDoorFlag`) VALUES
(102, 53, '2018-07-19 14:53:37', 0, 1, 0, 1, NULL, NULL, -1),
(101, 56, '2018-07-19 14:32:25', 0, 1, 0, 1, NULL, NULL, -1),
(112, 56, '2018-07-19 14:32:24', 0, 1, 0, 1, NULL, NULL, -1),
(113, 56, '2018-07-19 22:51:40', 0, 1, 0, 1, NULL, NULL, -1),
(114, 56, '2018-07-19 22:52:03', 0, 1, 0, 1, NULL, NULL, -1),
(115, 55, '2018-07-19 22:54:35', 0, 1, 0, 1, NULL, NULL, -1),
(116, 55, '2018-07-19 22:54:37', 0, 1, 0, 1, NULL, NULL, -1),
(109, 51, '2018-07-19 03:02:57', 0, 1, 0, 1, NULL, NULL, -1),
(110, 50, '2018-07-19 03:03:22', 0, 1, 0, 1, NULL, NULL, -1),
(103, 53, '2018-07-19 14:53:39', 0, 1, 0, 1, NULL, NULL, -1),
(104, 51, '2018-07-19 14:56:11', 0, 1, 0, 1, NULL, NULL, -1),
(105, 50, '2018-07-19 14:58:48', 0, 1, 0, 1, NULL, NULL, -1),
(108, 56, '2018-07-19 00:59:47', 0, 1, 0, 1, NULL, NULL, -1),
(111, 46, '2018-07-19 03:04:45', 0, 1, 0, 1, NULL, NULL, -1),
(117, 54, '2018-07-19 22:55:03', 0, 1, 0, 1, NULL, NULL, -1),
(118, 54, '2018-07-19 22:55:04', 0, 1, 0, 1, NULL, NULL, -1),
(119, 53, '2018-07-19 22:55:09', 0, 1, 0, 1, NULL, NULL, -1),
(120, 50, '2018-07-19 22:55:16', 0, 1, 0, 1, NULL, NULL, -1),
(121, 46, '2018-07-19 22:55:44', 0, 1, 0, 1, NULL, NULL, -1),
(122, 56, '2018-07-19 22:55:53', 0, 1, 0, 1, NULL, NULL, -1),
(123, 56, '2018-07-19 22:56:06', 0, 1, 0, 1, NULL, NULL, -1),
(124, 56, '2018-07-19 22:58:09', 0, 1, 0, 1, NULL, NULL, -1),
(125, 48, '2018-07-19 22:59:17', 0, 1, 0, 1, NULL, NULL, -1),
(126, 56, '2018-07-19 22:59:32', 0, 1, 0, 1, NULL, NULL, -1),
(127, 56, '2018-07-20 00:09:34', 0, 1, 0, 1, NULL, NULL, -1),
(128, 56, '2018-07-20 00:44:03', 0, 1, 0, 1, NULL, NULL, -1),
(129, 56, '2018-07-20 00:44:32', 0, 1, 0, 1, NULL, NULL, -1),
(130, 56, '2018-07-20 00:46:39', 0, 1, 0, 1, NULL, NULL, -1),
(131, 54, '2018-07-20 01:03:46', 0, 1, 0, 1, NULL, NULL, -1),
(132, 53, '2018-07-20 02:08:17', 0, 1, 0, 1, NULL, NULL, -1),
(133, 50, '2018-07-20 03:03:23', 0, 1, 0, 1, NULL, NULL, -1),
(134, 55, '2018-07-20 03:04:02', 0, 1, 0, 1, NULL, NULL, -1),
(135, 48, '2018-07-20 03:04:57', 0, 1, 0, 1, NULL, NULL, -1),
(136, 55, '2018-07-20 14:52:18', 0, 1, 0, 1, NULL, NULL, -1),
(137, 48, '2018-07-20 14:52:30', 0, 1, 0, 1, NULL, NULL, -1),
(138, 53, '2018-07-20 14:57:17', 0, 1, 0, 1, NULL, NULL, -1),
(139, 51, '2018-07-20 14:57:35', 0, 1, 0, 1, NULL, NULL, -1),
(140, 51, '2018-07-20 14:57:36', 0, 1, 0, 1, NULL, NULL, -1),
(141, 46, '2018-07-20 15:01:13', 0, 1, 0, 1, NULL, NULL, -1),
(142, 46, '2018-07-20 15:01:14', 0, 1, 0, 1, NULL, NULL, -1),
(143, 50, '2018-07-20 15:02:51', 0, 1, 0, 1, NULL, NULL, -1),
(144, 50, '2018-07-20 15:02:52', 0, 1, 0, 1, NULL, NULL, -1),
(145, 56, '2018-07-20 22:30:41', 0, 1, 0, 1, NULL, NULL, -1),
(146, 53, '2018-07-21 00:32:26', 0, 1, 0, 1, NULL, NULL, -1),
(147, 50, '2018-07-21 00:34:44', 0, 1, 0, 1, NULL, NULL, -1),
(148, 48, '2018-07-21 00:34:59', 0, 1, 0, 1, NULL, NULL, -1),
(149, 46, '2018-07-21 00:37:04', 0, 1, 0, 1, NULL, NULL, -1),
(150, 46, '2018-07-21 00:37:05', 0, 1, 0, 1, NULL, NULL, -1),
(151, 56, '2018-07-21 14:45:07', 0, 1, 0, 1, NULL, NULL, -1),
(152, 48, '2018-07-21 14:51:26', 0, 1, 0, 1, NULL, NULL, -1),
(153, 53, '2018-07-21 14:56:21', 0, 1, 0, 1, NULL, NULL, -1),
(154, 55, '2018-07-21 14:58:03', 0, 1, 0, 1, NULL, NULL, -1),
(155, 46, '2018-07-21 14:58:17', 0, 1, 0, 1, NULL, NULL, -1),
(156, 51, '2018-07-21 14:58:29', 0, 1, 0, 1, NULL, NULL, -1),
(157, 50, '2018-07-21 15:01:39', 0, 1, 0, 1, NULL, NULL, -1),
(158, 56, '2018-07-21 23:40:26', 0, 1, 0, 1, NULL, NULL, -1),
(159, 55, '2018-07-21 23:43:28', 0, 1, 0, 1, NULL, NULL, -1),
(160, 48, '2018-07-21 23:43:38', 0, 1, 0, 1, NULL, NULL, -1),
(161, 48, '2018-07-21 23:43:39', 0, 1, 0, 1, NULL, NULL, -1),
(162, 54, '2018-07-21 23:43:59', 0, 1, 0, 1, NULL, NULL, -1),
(163, 54, '2018-07-21 23:44:01', 0, 1, 0, 1, NULL, NULL, -1),
(164, 51, '2018-07-21 23:44:22', 0, 1, 0, 1, NULL, NULL, -1),
(165, 53, '2018-07-21 23:44:53', 0, 1, 0, 1, NULL, NULL, -1),
(166, 50, '2018-07-21 23:45:38', 0, 1, 0, 1, NULL, NULL, -1),
(167, 50, '2018-07-21 23:45:39', 0, 1, 0, 1, NULL, NULL, -1),
(168, 56, '2018-07-21 23:45:41', 0, 1, 0, 1, NULL, NULL, -1),
(169, 48, '2018-07-22 03:02:15', 0, 1, 0, 1, NULL, NULL, -1),
(170, 50, '2018-07-22 03:02:51', 0, 1, 0, 1, NULL, NULL, -1),
(171, 51, '2018-07-22 03:03:00', 0, 1, 0, 1, NULL, NULL, -1),
(172, 55, '2018-07-22 03:03:37', 0, 1, 0, 1, NULL, NULL, -1),
(173, 53, '2018-07-22 03:04:12', 0, 1, 0, 1, NULL, NULL, -1),
(174, 48, '2018-07-22 14:53:27', 0, 1, 0, 1, NULL, NULL, -1),
(175, 55, '2018-07-22 14:55:00', 0, 1, 0, 1, NULL, NULL, -1),
(176, 46, '2018-07-22 14:55:19', 0, 1, 0, 1, NULL, NULL, -1),
(177, 46, '2018-07-22 14:55:20', 0, 1, 0, 1, NULL, NULL, -1),
(178, 54, '2018-07-22 14:55:26', 0, 1, 0, 1, NULL, NULL, -1),
(179, 50, '2018-07-22 14:55:33', 0, 1, 0, 1, NULL, NULL, -1),
(180, 53, '2018-07-22 14:55:52', 0, 1, 0, 1, NULL, NULL, -1),
(181, 51, '2018-07-22 14:57:39', 0, 1, 0, 1, NULL, NULL, -1),
(182, 56, '2018-07-22 18:18:17', 0, 1, 0, 1, NULL, NULL, -1),
(183, 56, '2018-07-22 19:09:59', 0, 1, 0, 1, NULL, NULL, -1),
(184, 56, '2018-07-22 19:11:31', 0, 1, 0, 1, NULL, NULL, -1),
(185, 56, '2018-07-22 19:12:15', 0, 1, 0, 1, NULL, NULL, -1),
(186, 56, '2018-07-22 19:17:35', 0, 1, 0, 1, NULL, NULL, -1),
(187, 48, '2018-07-22 20:01:16', 0, 1, 0, 1, NULL, NULL, -1),
(188, 50, '2018-07-22 20:01:23', 0, 1, 0, 1, NULL, NULL, -1),
(189, 51, '2018-07-22 20:01:31', 0, 1, 0, 1, NULL, NULL, -1),
(190, 46, '2018-07-22 20:01:42', 0, 1, 0, 1, NULL, NULL, -1),
(191, 55, '2018-07-22 20:19:18', 0, 1, 0, 1, NULL, NULL, -1),
(192, 46, '2018-07-23 00:12:28', 0, 1, 0, 1, NULL, NULL, -1),
(193, 46, '2018-07-23 00:12:29', 0, 1, 0, 1, NULL, NULL, -1),
(194, 55, '2018-07-23 03:02:10', 0, 1, 0, 1, NULL, NULL, -1),
(195, 50, '2018-07-23 03:02:22', 0, 1, 0, 1, NULL, NULL, -1),
(196, 53, '2018-07-23 03:03:55', 0, 1, 0, 1, NULL, NULL, -1),
(197, 48, '2018-07-23 03:04:27', 0, 1, 0, 1, NULL, NULL, -1),
(198, 56, '2018-07-23 14:42:43', 0, 1, 0, 1, NULL, NULL, -1),
(199, 46, '2018-07-23 14:53:44', 0, 1, 0, 1, NULL, NULL, -1),
(200, 53, '2018-07-23 14:58:13', 0, 1, 0, 1, NULL, NULL, -1),
(201, 48, '2018-07-23 14:58:49', 0, 1, 0, 1, NULL, NULL, -1),
(202, 50, '2018-07-23 15:02:25', 0, 1, 0, 1, NULL, NULL, -1),
(203, 51, '2018-07-23 15:08:50', 0, 1, 0, 1, NULL, NULL, -1),
(204, 56, '2018-07-24 19:35:25', 0, 1, 0, 1, NULL, NULL, -1),
(205, 56, '2018-07-24 19:36:46', 0, 1, 0, 1, NULL, NULL, -1),
(206, 46, '2018-07-25 00:01:40', 0, 1, 0, 1, NULL, NULL, -1),
(207, 46, '2018-07-25 00:01:42', 0, 1, 0, 1, NULL, NULL, -1),
(208, 55, '2018-07-25 00:02:39', 0, 1, 0, 1, NULL, NULL, -1),
(209, 51, '2018-07-25 00:04:18', 0, 1, 0, 1, NULL, NULL, -1),
(210, 53, '2018-07-25 00:04:34', 0, 1, 0, 1, NULL, NULL, -1),
(211, 48, '2018-07-25 03:02:18', 0, 1, 0, 1, NULL, NULL, -1),
(212, 50, '2018-07-25 03:05:14', 0, 1, 0, 1, NULL, NULL, -1),
(213, 46, '2018-07-25 14:52:48', 0, 1, 0, 1, NULL, NULL, -1),
(214, 53, '2018-07-25 14:55:58', 0, 1, 0, 1, NULL, NULL, -1),
(215, 48, '2018-07-25 14:58:04', 0, 1, 0, 1, NULL, NULL, -1),
(216, 48, '2018-07-25 14:58:06', 0, 1, 0, 1, NULL, NULL, -1),
(217, 50, '2018-07-25 15:03:00', 0, 1, 0, 1, NULL, NULL, -1),
(218, 56, '2018-07-26 00:07:00', 0, 1, 0, 1, NULL, NULL, -1),
(219, 46, '2018-07-26 03:02:11', 0, 1, 0, 1, NULL, NULL, -1),
(220, 46, '2018-07-26 03:02:12', 0, 1, 0, 1, NULL, NULL, -1),
(221, 51, '2018-07-26 03:02:24', 0, 1, 0, 1, NULL, NULL, -1),
(222, 56, '2018-07-26 03:08:25', 0, 1, 0, 1, NULL, NULL, -1),
(223, 48, '2018-07-26 04:01:57', 0, 1, 0, 1, NULL, NULL, -1),
(224, 53, '2018-07-26 04:04:12', 0, 1, 0, 1, NULL, NULL, -1),
(225, 55, '2018-07-26 05:01:39', 0, 1, 0, 1, NULL, NULL, -1),
(226, 50, '2018-07-26 05:02:09', 0, 1, 0, 1, NULL, NULL, -1),
(227, 50, '2018-07-26 14:54:15', 0, 1, 0, 1, NULL, NULL, -1),
(228, 53, '2018-07-26 14:55:26', 0, 1, 0, 1, NULL, NULL, -1),
(229, 48, '2018-07-26 14:55:35', 0, 1, 0, 1, NULL, NULL, -1),
(230, 46, '2018-07-26 14:56:06', 0, 1, 0, 1, NULL, NULL, -1),
(231, 51, '2018-07-26 15:00:47', 0, 1, 0, 1, NULL, NULL, -1),
(232, 56, '2018-07-27 03:03:09', 0, 1, 0, 1, NULL, NULL, -1),
(233, 51, '2018-07-27 03:04:04', 0, 1, 0, 1, NULL, NULL, -1),
(234, 48, '2018-07-27 04:01:41', 0, 1, 0, 1, NULL, NULL, -1),
(235, 46, '2018-07-27 04:03:25', 0, 1, 0, 1, NULL, NULL, -1),
(236, 50, '2018-07-27 04:03:34', 0, 1, 0, 1, NULL, NULL, -1),
(237, 55, '2018-07-27 04:03:52', 0, 1, 0, 1, NULL, NULL, -1),
(238, 46, '2018-07-27 14:55:20', 0, 1, 0, 1, NULL, NULL, -1),
(239, 55, '2018-07-27 14:55:55', 0, 1, 0, 1, NULL, NULL, -1),
(240, 51, '2018-07-27 14:57:10', 0, 1, 0, 1, NULL, NULL, -1),
(241, 53, '2018-07-27 14:58:52', 0, 1, 0, 1, NULL, NULL, -1),
(242, 50, '2018-07-27 14:59:51', 0, 1, 0, 1, NULL, NULL, -1),
(243, 48, '2018-07-27 15:00:30', 0, 1, 0, 1, NULL, NULL, -1),
(244, 51, '2018-07-28 00:34:19', 0, 1, 0, 1, NULL, NULL, -1),
(245, 55, '2018-07-28 00:34:25', 0, 1, 0, 1, NULL, NULL, -1),
(246, 50, '2018-07-28 00:34:32', 0, 1, 0, 1, NULL, NULL, -1),
(247, 46, '2018-07-28 00:34:58', 0, 1, 0, 1, NULL, NULL, -1),
(248, 48, '2018-07-28 00:35:40', 0, 1, 0, 1, NULL, NULL, -1),
(249, 53, '2018-07-28 00:35:57', 0, 1, 0, 1, NULL, NULL, -1),
(250, 55, '2018-07-28 14:48:24', 0, 1, 0, 1, NULL, NULL, -1),
(251, 48, '2018-07-28 14:55:13', 0, 1, 0, 1, NULL, NULL, -1),
(252, 46, '2018-07-28 14:56:57', 0, 1, 0, 1, NULL, NULL, -1),
(253, 50, '2018-07-28 14:59:02', 0, 1, 0, 1, NULL, NULL, -1),
(254, 51, '2018-07-28 14:59:56', 0, 1, 0, 1, NULL, NULL, -1),
(255, 46, '2018-07-29 03:02:22', 0, 1, 0, 1, NULL, NULL, -1),
(256, 46, '2018-07-29 03:02:23', 0, 1, 0, 1, NULL, NULL, -1),
(257, 48, '2018-07-29 03:03:42', 0, 1, 0, 1, NULL, NULL, -1),
(258, 55, '2018-07-29 04:04:13', 0, 1, 0, 1, NULL, NULL, -1),
(259, 53, '2018-07-29 04:04:19', 0, 1, 0, 1, NULL, NULL, -1),
(260, 51, '2018-07-29 05:02:44', 0, 1, 0, 1, NULL, NULL, -1),
(261, 50, '2018-07-29 05:02:55', 0, 1, 0, 1, NULL, NULL, -1),
(262, 56, '2018-07-29 14:51:23', 0, 1, 0, 1, NULL, NULL, -1),
(263, 55, '2018-07-29 14:51:27', 0, 1, 0, 1, NULL, NULL, -1),
(264, 48, '2018-07-29 14:54:39', 0, 1, 0, 1, NULL, NULL, -1),
(265, 46, '2018-07-29 14:56:56', 0, 1, 0, 1, NULL, NULL, -1),
(266, 46, '2018-07-29 14:57:00', 0, 1, 0, 1, NULL, NULL, -1),
(267, 53, '2018-07-29 14:57:18', 0, 1, 0, 1, NULL, NULL, -1),
(268, 51, '2018-07-29 15:00:44', 0, 1, 0, 1, NULL, NULL, -1),
(269, 48, '2018-07-30 03:01:06', 0, 1, 0, 1, NULL, NULL, -1),
(270, 51, '2018-07-30 04:01:46', 0, 1, 0, 1, NULL, NULL, -1),
(271, 46, '2018-07-30 04:02:02', 0, 1, 0, 1, NULL, NULL, -1),
(272, 53, '2018-07-30 04:04:51', 0, 1, 0, 1, NULL, NULL, -1),
(273, 50, '2018-07-30 05:02:38', 0, 1, 0, 1, NULL, NULL, -1),
(274, 55, '2018-07-30 05:02:42', 0, 1, 0, 1, NULL, NULL, -1),
(275, 53, '2018-07-30 14:53:29', 0, 1, 0, 1, NULL, NULL, -1),
(276, 55, '2018-07-30 14:54:07', 0, 1, 0, 1, NULL, NULL, -1),
(277, 48, '2018-07-30 14:54:23', 0, 1, 0, 1, NULL, NULL, -1),
(278, 51, '2018-07-30 14:57:11', 0, 1, 0, 1, NULL, NULL, -1),
(279, 50, '2018-07-30 14:58:31', 0, 1, 0, 1, NULL, NULL, -1),
(280, 46, '2018-07-30 15:00:35', 0, 1, 0, 1, NULL, NULL, -1),
(281, 53, '2018-08-01 04:01:14', 0, 1, 0, 1, NULL, NULL, -1),
(282, 55, '2018-08-01 14:42:53', 0, 1, 0, 1, NULL, NULL, -1),
(283, 56, '2018-08-01 14:43:01', 0, 1, 0, 1, NULL, NULL, -1),
(284, 48, '2018-08-01 14:53:03', 0, 1, 0, 1, NULL, NULL, -1),
(285, 50, '2018-08-01 14:54:57', 0, 1, 0, 1, NULL, NULL, -1),
(286, 46, '2018-08-01 14:55:35', 0, 1, 0, 1, NULL, NULL, -1),
(287, 51, '2018-08-01 14:58:43', 0, 1, 0, 1, NULL, NULL, -1);

--
-- Triggers `checkinout`
--
DELIMITER $$
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
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `com_b2b_entry`
--

CREATE TABLE `com_b2b_entry` (
  `b2b_id` int(11) NOT NULL,
  `exp_lc_fileno` varchar(45) DEFAULT NULL,
  `b2b_item` varchar(45) DEFAULT NULL,
  `b2b_lc_status` varchar(45) DEFAULT NULL,
  `b2b_lc_no` varchar(45) DEFAULT NULL,
  `b2b_lc_date` date DEFAULT NULL,
  `b2b_inco_term` varchar(45) DEFAULT NULL,
  `b2b_lc_sup_code` varchar(45) DEFAULT NULL,
  `sup_id` int(11) NOT NULL,
  `b2b_lc_currency` varchar(45) DEFAULT NULL,
  `b2b_lc_marine_ins_no` varchar(45) DEFAULT NULL,
  `b2b_lc_ins_cover_date` date DEFAULT NULL,
  `lc_period_id` int(11) DEFAULT NULL,
  `from_date_of_id` int(11) DEFAULT NULL,
  `b2b_lc_interest` varchar(45) DEFAULT NULL,
  `lc_id` int(11) DEFAULT NULL,
  `b2b_status` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `b2b_lc_cancel_date` timestamp NULL DEFAULT NULL,
  `com_b2b_entrycol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_b2b_entry`
--

INSERT INTO `com_b2b_entry` (`b2b_id`, `exp_lc_fileno`, `b2b_item`, `b2b_lc_status`, `b2b_lc_no`, `b2b_lc_date`, `b2b_inco_term`, `b2b_lc_sup_code`, `sup_id`, `b2b_lc_currency`, `b2b_lc_marine_ins_no`, `b2b_lc_ins_cover_date`, `lc_period_id`, `from_date_of_id`, `b2b_lc_interest`, `lc_id`, `b2b_status`, `unit_id`, `b2b_lc_cancel_date`, `com_b2b_entrycol`) VALUES
(1, '1', '3', '1', '122', NULL, '1', '1', 1, '1', '1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '3', '2', NULL, 'lc1', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '3', '1', NULL, 'lc2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `com_bank`
--

CREATE TABLE `com_bank` (
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(45) DEFAULT NULL,
  `bank_short_code` varchar(60) DEFAULT NULL,
  `bank_swift_code` varchar(60) DEFAULT NULL,
  `bank_address_1` varchar(256) DEFAULT NULL,
  `bank_address_2` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_bank`
--

INSERT INTO `com_bank` (`bank_id`, `bank_name`, `bank_short_code`, `bank_swift_code`, `bank_address_1`, `bank_address_2`) VALUES
(1, 'DBBL', 'DBBL', '67', 'edwre', 'wewer'),
(6, 'EBL', 'EBL', '67', 'asas', 'AS'),
(7, 'IBL', 'IBL', '67', 'dfgdfg', 'dfgdfg'),
(8, 'IBL', 'IBL', '67', 'dfgdfg', 'dfgdfg'),
(9, 'IBL', 'IBL', '67', 'dfgdfg', 'dfgdfg');

-- --------------------------------------------------------

--
-- Table structure for table `com_bank_accno`
--

CREATE TABLE `com_bank_accno` (
  `acc_id` int(11) NOT NULL,
  `acc_no` varchar(45) DEFAULT NULL,
  `bank_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_bank_accno`
--

INSERT INTO `com_bank_accno` (`acc_id`, `acc_no`, `bank_id`) VALUES
(6, '6545', 1),
(7, '234234', 2),
(8, '234234', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_cash_incentive_status`
--

CREATE TABLE `com_cash_incentive_status` (
  `incentive_status_id` int(11) NOT NULL,
  `incentive_status_country` varchar(45) DEFAULT NULL,
  `incentive_status_y_n` varchar(45) DEFAULT NULL,
  `incentive_status_type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `com_cnf_agent`
--

CREATE TABLE `com_cnf_agent` (
  `cnf_id` int(11) NOT NULL,
  `cnf_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `com_cnf_contact`
--

CREATE TABLE `com_cnf_contact` (
  `cnf_contact_id` int(11) NOT NULL,
  `cnf_contact_person` varchar(45) DEFAULT NULL,
  `cnf_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `com_exp_lc_close`
--

CREATE TABLE `com_exp_lc_close` (
  `exp_lc_close_id` int(11) NOT NULL,
  `exp_lc_fileno` varchar(45) DEFAULT NULL,
  `exp_lc_close_date` date DEFAULT NULL,
  `exp_lc_close_remarks` varchar(145) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_exp_lc_close`
--

INSERT INTO `com_exp_lc_close` (`exp_lc_close_id`, `exp_lc_fileno`, `exp_lc_close_date`, `exp_lc_close_remarks`) VALUES
(1, '001', '2018-10-12', 'dfsd');

-- --------------------------------------------------------

--
-- Table structure for table `com_exp_lc_entry`
--

CREATE TABLE `com_exp_lc_entry` (
  `exp_lc_id` int(11) NOT NULL,
  `exp_lc_fileno` varchar(45) DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `exp_lc_explcno` varchar(45) DEFAULT NULL,
  `exp_lc_elc_date` date DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `exp_lc_type` varchar(45) DEFAULT NULL,
  `exp_lc_expiry_date` date DEFAULT NULL,
  `exp_lc_initial_value` varchar(20) DEFAULT NULL,
  `com_exp_value_currency` varchar(45) DEFAULT NULL,
  `exp_lc_file_status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_exp_lc_entry`
--

INSERT INTO `com_exp_lc_entry` (`exp_lc_id`, `exp_lc_fileno`, `b_id`, `exp_lc_explcno`, `exp_lc_elc_date`, `bank_id`, `exp_lc_type`, `exp_lc_expiry_date`, `exp_lc_initial_value`, `com_exp_value_currency`, `exp_lc_file_status`) VALUES
(1, '1', 1, '100', '2018-10-03', 1, 'ELC', '2018-10-04', '100', 'USD', 1),
(2, '2', 2, '233', '2018-10-10', 2, 'ELC', '2018-10-10', '200', NULL, 1),
(3, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `com_exp_lc_entry_address`
--

CREATE TABLE `com_exp_lc_entry_address` (
  `exp_lc_entry_adr_id` int(11) NOT NULL,
  `cnt_id` int(11) DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `exp_lc_entry_adr_buyer_adr` varchar(145) DEFAULT NULL,
  `exp_lc_entry_adr_notify_adr` varchar(145) DEFAULT NULL,
  `exp_lc_entry_adr_notify_adr2` varchar(145) DEFAULT NULL,
  `exp_lc_entry_adr_notify_adr3` varchar(145) NOT NULL,
  `exp_lc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_exp_lc_entry_address`
--

INSERT INTO `com_exp_lc_entry_address` (`exp_lc_entry_adr_id`, `cnt_id`, `b_id`, `exp_lc_entry_adr_buyer_adr`, `exp_lc_entry_adr_notify_adr`, `exp_lc_entry_adr_notify_adr2`, `exp_lc_entry_adr_notify_adr3`, `exp_lc_id`) VALUES
(1, 34, 1, 'update', 'update', 'update', 'update', 1);

-- --------------------------------------------------------

--
-- Table structure for table `com_exp_lc_entry_ammendment`
--

CREATE TABLE `com_exp_lc_entry_ammendment` (
  `exp_lc_amend_id` int(11) NOT NULL,
  `exp_lc_amend_no` varchar(45) DEFAULT NULL,
  `exp_lc_amend_date` date DEFAULT NULL,
  `exp_lc_amend_expiry_date` date DEFAULT NULL,
  `exp_lc_amend_elc_amount` varchar(45) DEFAULT NULL,
  `exp_lc_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_exp_lc_entry_ammendment`
--

INSERT INTO `com_exp_lc_entry_ammendment` (`exp_lc_amend_id`, `exp_lc_amend_no`, `exp_lc_amend_date`, `exp_lc_amend_expiry_date`, `exp_lc_amend_elc_amount`, `exp_lc_id`) VALUES
(10, '001', '2018-10-01', '2018-10-02', '200', 1);

-- --------------------------------------------------------

--
-- Table structure for table `com_exp_lc_history`
--

CREATE TABLE `com_exp_lc_history` (
  `exp_lc_history_id` int(11) NOT NULL,
  `exp_lc_id` int(11) NOT NULL,
  `exp_lc_history_description` varchar(45) DEFAULT NULL,
  `exp_lc_history_userid` varchar(45) DEFAULT NULL,
  `exp_lc_history_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `exp_lc_previous_value` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_exp_lc_history`
--

INSERT INTO `com_exp_lc_history` (`exp_lc_history_id`, `exp_lc_id`, `exp_lc_history_description`, `exp_lc_history_userid`, `exp_lc_history_datetime`, `exp_lc_previous_value`) VALUES
(1, 1, NULL, '9999999999', '2018-10-07 11:00:30', '300');

-- --------------------------------------------------------

--
-- Table structure for table `com_foc_lc`
--

CREATE TABLE `com_foc_lc` (
  `foc_lc_id` int(11) NOT NULL,
  `exp_lc_fileno` varchar(45) DEFAULT NULL,
  `foc_lc_mode` varchar(45) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `foc_lc_inv_no` varchar(45) DEFAULT NULL,
  `foc_lc_transp_doc1` varchar(45) DEFAULT NULL,
  `foc_lc_transp_doc2` varchar(45) DEFAULT NULL,
  `foc_lc_transp_date` date DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `foc_lc_value` varchar(45) DEFAULT NULL,
  `foc_lc_currency` varchar(45) DEFAULT NULL,
  `foc_lc_qty` varchar(45) DEFAULT NULL,
  `foc_lc_uom` varchar(45) DEFAULT NULL,
  `foc_lc_weight` varchar(45) DEFAULT NULL,
  `foc_lc_package` varchar(45) DEFAULT NULL,
  `foc_lc_doctype` varchar(45) DEFAULT NULL,
  `foc_lc_doc_date` date DEFAULT NULL,
  `foc_lc_dispatch_date` date DEFAULT NULL,
  `port_id` int(11) DEFAULT NULL,
  `foc_lc_berth_date` date DEFAULT NULL,
  `foc_lc_noting_date` date DEFAULT NULL,
  `foc_lc_examine_date` date DEFAULT NULL,
  `foc_lc_assesment_date` date DEFAULT NULL,
  `foc_lc_delivery_date` date DEFAULT NULL,
  `foc_lc_arriving_date` date DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_foc_lc`
--

INSERT INTO `com_foc_lc` (`foc_lc_id`, `exp_lc_fileno`, `foc_lc_mode`, `item_id`, `foc_lc_inv_no`, `foc_lc_transp_doc1`, `foc_lc_transp_doc2`, `foc_lc_transp_date`, `sup_id`, `foc_lc_value`, `foc_lc_currency`, `foc_lc_qty`, `foc_lc_uom`, `foc_lc_weight`, `foc_lc_package`, `foc_lc_doctype`, `foc_lc_doc_date`, `foc_lc_dispatch_date`, `port_id`, `foc_lc_berth_date`, `foc_lc_noting_date`, `foc_lc_examine_date`, `foc_lc_assesment_date`, `foc_lc_delivery_date`, `foc_lc_arriving_date`, `created_by`, `created_at`, `updated_by`, `updated_at`, `unit_id`) VALUES
(1, '001', 'Air', 1, '123', 'tr1', 'tr2', '2018-10-13', 4, '123', 'USD', '4343', 'Feet', '344', '34', 'Original', '2018-10-14', '2018-10-15', 1, '2018-10-16', '2018-10-20', '2018-10-17', '2018-10-18', '2018-10-19', '2018-10-20', NULL, NULL, NULL, NULL, NULL),
(3, '001', 'Air', 1, '3w4324', 'trr1', 'trr2', '2018-10-02', 5, '32432', 'USD', '688', 'Inch', NULL, NULL, 'Others', NULL, NULL, 1, NULL, NULL, NULL, NULL, '2018-10-02', NULL, NULL, NULL, NULL, NULL, NULL),
(5, '001', 'Air', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '001', 'Air', 1, '3w4324', 'trr1', 'trr2', NULL, 4, '324', 'ARP', NULL, NULL, '435', '34', NULL, NULL, NULL, NULL, '2018-10-10', NULL, NULL, '2018-10-27', '2018-10-03', NULL, NULL, NULL, NULL, NULL, NULL),
(7, '001', 'Ship', 1, NULL, 'trr1', 'trr2', '2018-10-02', 3, '324', 'USD', '34', 'Yard', '23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(8, '1', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `com_foc_lc_elcno`
--

CREATE TABLE `com_foc_lc_elcno` (
  `foc_lc_elc_id` int(11) NOT NULL,
  `foc_lc_id` int(11) NOT NULL,
  `exp_lc_fileno` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_foc_lc_elcno`
--

INSERT INTO `com_foc_lc_elcno` (`foc_lc_elc_id`, `foc_lc_id`, `exp_lc_fileno`) VALUES
(5, 1, '2'),
(7, 1, '1'),
(8, 7, '1'),
(15, 6, NULL),
(16, 3, '2');

-- --------------------------------------------------------

--
-- Table structure for table `com_import_data_entry`
--

CREATE TABLE `com_import_data_entry` (
  `imp_data_entry_id` int(11) NOT NULL,
  `imp_data_entry_import_code` varchar(45) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `import_data_entry_bank_type` varchar(45) DEFAULT NULL,
  `imp_data_entry_transp_doc1` varchar(45) DEFAULT NULL,
  `imp_data_entry_transp_doc_date` date DEFAULT NULL,
  `import_data_entry_transp_doc2` varchar(45) DEFAULT NULL,
  `imp_data_entry_shipmode` varchar(45) DEFAULT NULL,
  `imp_data_entry_weight` varchar(45) DEFAULT NULL,
  `import_data_entry_cub_measure` varchar(45) DEFAULT NULL,
  `imp_data_entry_contry_origin` varchar(45) DEFAULT NULL,
  `imp_data_entry_carrier` varchar(45) DEFAULT NULL,
  `import_data_entry_ship_comp` varchar(45) DEFAULT NULL,
  `imp_data_entry_container1` varchar(45) DEFAULT NULL,
  `imp_data_entry_containe2` varchar(45) DEFAULT NULL,
  `imp_data_entry_containe3` varchar(45) DEFAULT NULL,
  `imp_data_entry_package` varchar(45) DEFAULT NULL,
  `import_data_entry_doc_type` varchar(45) DEFAULT NULL,
  `imp_data_entry_doc_recv_date` date DEFAULT NULL,
  `import_data_entry_quantity` varchar(45) DEFAULT NULL,
  `imp_data_entry_value` varchar(45) DEFAULT NULL,
  `imp_data_entry_currency` varchar(45) DEFAULT NULL,
  `port_id` int(11) DEFAULT NULL,
  `imp_data_entry_container_size` varchar(45) DEFAULT NULL,
  `vess_id` int(11) DEFAULT NULL,
  `voyage_id` int(11) DEFAULT NULL,
  `exp_lc_fileno` varchar(45) DEFAULT NULL,
  `imp_data_entry_item` varchar(45) DEFAULT NULL,
  `hr_unit_id` varchar(45) DEFAULT NULL,
  `b2b_id` int(11) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `pi_order_id` int(11) NOT NULL,
  `import_data_entry_type` varchar(45) DEFAULT NULL,
  `unit_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_import_data_entry`
--

INSERT INTO `com_import_data_entry` (`imp_data_entry_id`, `imp_data_entry_import_code`, `bank_id`, `import_data_entry_bank_type`, `imp_data_entry_transp_doc1`, `imp_data_entry_transp_doc_date`, `import_data_entry_transp_doc2`, `imp_data_entry_shipmode`, `imp_data_entry_weight`, `import_data_entry_cub_measure`, `imp_data_entry_contry_origin`, `imp_data_entry_carrier`, `import_data_entry_ship_comp`, `imp_data_entry_container1`, `imp_data_entry_containe2`, `imp_data_entry_containe3`, `imp_data_entry_package`, `import_data_entry_doc_type`, `imp_data_entry_doc_recv_date`, `import_data_entry_quantity`, `imp_data_entry_value`, `imp_data_entry_currency`, `port_id`, `imp_data_entry_container_size`, `vess_id`, `voyage_id`, `exp_lc_fileno`, `imp_data_entry_item`, `hr_unit_id`, `b2b_id`, `sup_id`, `pi_order_id`, `import_data_entry_type`, `unit_id`) VALUES
(1, 'TM00001', 6, NULL, 'trr1', '2018-11-07', 'trr2', 'Ship', '435', NULL, '5', '5564', 'vbcvb', 'con1', 'con2', 'con3', '34', 'Shipment Advice', '2018-11-01', '34', '324', 'USD', 1, 'FCL', 1, 1, '1', 'R45OP', 'MBM Garments Ltd', 122, 0, 0, 'Foreign', '4');

-- --------------------------------------------------------

--
-- Table structure for table `com_import_data_entry_history`
--

CREATE TABLE `com_import_data_entry_history` (
  `imp_data_entry_history_id` int(11) NOT NULL,
  `imp_data_entry_id` int(11) DEFAULT NULL,
  `imp_data_entry_history_desc` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_import_data_entry_history`
--

INSERT INTO `com_import_data_entry_history` (`imp_data_entry_history_id`, `imp_data_entry_id`, `imp_data_entry_history_desc`, `created_by`, `created_at`) VALUES
(1, 1, '1', '4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `com_import_data_entry_import_fab`
--

CREATE TABLE `com_import_data_entry_import_fab` (
  `imp_data_entry_import_fab_id` int(11) NOT NULL,
  `imp_data_entry_invoice_id` int(11) NOT NULL,
  `imp_data_entry_import_fab_code` varchar(45) DEFAULT NULL,
  `clr_id` int(11) DEFAULT NULL,
  `imp_data_entry_import_fab_unit_price` varchar(45) DEFAULT NULL,
  `imp_data_entry_import_fab_qty` varchar(45) DEFAULT NULL,
  `imp_data_entry_import_fab_qty_rcv` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_import_data_entry_import_fab`
--

INSERT INTO `com_import_data_entry_import_fab` (`imp_data_entry_import_fab_id`, `imp_data_entry_invoice_id`, `imp_data_entry_import_fab_code`, `clr_id`, `imp_data_entry_import_fab_unit_price`, `imp_data_entry_import_fab_qty`, `imp_data_entry_import_fab_qty_rcv`) VALUES
(1, 2, '78GU54', 2, '8', '4', '63'),
(2, 3, '133d244', 1, '13', '14', '15'),
(3, 3, '78GU54', 4, '234', '453', '45');

-- --------------------------------------------------------

--
-- Table structure for table `com_import_data_entry_invoice`
--

CREATE TABLE `com_import_data_entry_invoice` (
  `imp_data_entry_invoice_id` int(11) NOT NULL,
  `imp_data_entry_id` int(11) DEFAULT NULL,
  `imp_data_entry_invoice_no` varchar(45) DEFAULT NULL,
  `import_data_entry_invoice_date` date DEFAULT NULL,
  `pi_entry_id` int(11) DEFAULT NULL,
  `order_id` varchar(45) DEFAULT NULL,
  `matitem_id` int(11) DEFAULT NULL,
  `matitem_category` int(11) NOT NULL,
  `imp_data_entry_invoice_qty` varchar(45) DEFAULT NULL,
  `import_data_entry_invoice_unit_price` varchar(45) DEFAULT NULL,
  `stl_id` varchar(45) DEFAULT NULL,
  `imp_data_entry_invoice_stl2` varchar(45) DEFAULT NULL,
  `imp_data_entry_invoice_value` varchar(45) DEFAULT NULL,
  `imp_data_entry_invoice_uom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_import_data_entry_invoice`
--

INSERT INTO `com_import_data_entry_invoice` (`imp_data_entry_invoice_id`, `imp_data_entry_id`, `imp_data_entry_invoice_no`, `import_data_entry_invoice_date`, `pi_entry_id`, `order_id`, `matitem_id`, `matitem_category`, `imp_data_entry_invoice_qty`, `import_data_entry_invoice_unit_price`, `stl_id`, `imp_data_entry_invoice_stl2`, `imp_data_entry_invoice_value`, `imp_data_entry_invoice_uom`) VALUES
(1, 1, '1', '2018-11-07', 1, '1', 1, 0, '23', '9', '4', '3', '3', 'Centimeter'),
(2, 1, '2', '2018-11-07', 1, '1', 1, 0, '89', '1', '3', '7', '3', 'Millimeter'),
(3, 1, '3', '2018-11-07', 1, '1', 1, 0, '25', '9', '7', '9', '0', 'Meter');

-- --------------------------------------------------------

--
-- Table structure for table `com_import_data_entry_machinery`
--

CREATE TABLE `com_import_data_entry_machinery` (
  `imp_data_machinery_id` int(11) NOT NULL,
  `imp_data_machinery_import_code` varchar(45) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `import_data_machinery_bank_type` varchar(45) DEFAULT NULL,
  `imp_data_machinery_tarnsp_doc1` varchar(45) DEFAULT NULL,
  `imp_data_entry_transp_doc_date` date DEFAULT NULL,
  `import_data_machinery_transp_doc2` varchar(45) DEFAULT NULL,
  `imp_data_entry_shipmode` varchar(45) DEFAULT NULL,
  `imp_data_machinery_weight` varchar(45) DEFAULT NULL,
  `import_data_machinery_cub_measure` varchar(45) DEFAULT NULL,
  `cnt_id` varchar(45) DEFAULT NULL,
  `imp_data_machinery_carrier` varchar(45) DEFAULT NULL,
  `import_data_machinery_ship_comp` varchar(45) DEFAULT NULL,
  `imp_data_machinery_container1` varchar(45) DEFAULT NULL,
  `imp_data_machinery_containe2` varchar(45) DEFAULT NULL,
  `imp_data_machinery_containe3` varchar(45) DEFAULT NULL,
  `imp_data_machinery_package` varchar(45) DEFAULT NULL,
  `imp_data_machinery_value` varchar(45) DEFAULT NULL,
  `imp_data_machinery_currency` varchar(45) DEFAULT NULL,
  `port_id` int(11) DEFAULT NULL,
  `import_data_machinery_doc_type` varchar(45) DEFAULT NULL,
  `imp_data_machinery_doc_recv_date` date DEFAULT NULL,
  `import_data_machinery_quantity` varchar(45) DEFAULT NULL,
  `imp_data_machinery_container_size` varchar(45) DEFAULT NULL,
  `vess_id` int(11) DEFAULT NULL,
  `voyage_id` int(11) DEFAULT NULL,
  `machinery_pi_fileno` varchar(45) DEFAULT NULL,
  `imp_data_machinery_item` varchar(45) DEFAULT NULL,
  `hr_unit_id` varchar(45) DEFAULT NULL,
  `imp_data_machinery_master_lc_no` varchar(45) NOT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `pi_order_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_import_data_entry_machinery`
--

INSERT INTO `com_import_data_entry_machinery` (`imp_data_machinery_id`, `imp_data_machinery_import_code`, `bank_id`, `import_data_machinery_bank_type`, `imp_data_machinery_tarnsp_doc1`, `imp_data_entry_transp_doc_date`, `import_data_machinery_transp_doc2`, `imp_data_entry_shipmode`, `imp_data_machinery_weight`, `import_data_machinery_cub_measure`, `cnt_id`, `imp_data_machinery_carrier`, `import_data_machinery_ship_comp`, `imp_data_machinery_container1`, `imp_data_machinery_containe2`, `imp_data_machinery_containe3`, `imp_data_machinery_package`, `imp_data_machinery_value`, `imp_data_machinery_currency`, `port_id`, `import_data_machinery_doc_type`, `imp_data_machinery_doc_recv_date`, `import_data_machinery_quantity`, `imp_data_machinery_container_size`, `vess_id`, `voyage_id`, `machinery_pi_fileno`, `imp_data_machinery_item`, `hr_unit_id`, `imp_data_machinery_master_lc_no`, `sup_id`, `pi_order_id`, `unit_id`) VALUES
(1, 'KM00002', 6, NULL, 'trr1', '2018-11-14', 'trr22', 'Ship', '435', '234', '1', 'carrr', 'Company', '45', '6', '3', '565', '45345', 'USD', 1, 'Email', '2018-11-04', '23', 'LCL', 2, 2, '001', 'reter', 'MBM Garments Ltd', '453', 4, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `com_import_data_entry_machinery_invoice`
--

CREATE TABLE `com_import_data_entry_machinery_invoice` (
  `imp_data_machinery_inv_id` int(11) NOT NULL,
  `imp_data_machinery_id` int(11) DEFAULT NULL,
  `imp_data_machinery_inv_no` varchar(45) DEFAULT NULL,
  `imp_data_machinery_inv_date` date DEFAULT NULL,
  `imp_data_machinery_inv_pi` varchar(45) DEFAULT NULL,
  `machinery_pi_id` int(11) DEFAULT NULL,
  `machinery_pi_item` varchar(45) DEFAULT NULL,
  `imp_data_machinery_inv_value` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_import_data_entry_machinery_invoice`
--

INSERT INTO `com_import_data_entry_machinery_invoice` (`imp_data_machinery_inv_id`, `imp_data_machinery_id`, `imp_data_machinery_inv_no`, `imp_data_machinery_inv_date`, `imp_data_machinery_inv_pi`, `machinery_pi_id`, `machinery_pi_item`, `imp_data_machinery_inv_value`) VALUES
(30, 1, '1', NULL, '1', 1, 'reter', NULL),
(31, 1, '2', NULL, 'Select', 1, NULL, NULL),
(32, 1, '3', NULL, 'Select', 1, NULL, NULL),
(33, 1, '4', NULL, 'Select', 1, NULL, NULL),
(34, 1, '5', NULL, 'Select', 1, NULL, NULL),
(35, 1, '7', NULL, 'Select', 1, NULL, NULL),
(36, 1, '34', NULL, 'Select', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `com_import_data_machinery_history`
--

CREATE TABLE `com_import_data_machinery_history` (
  `imp_data_machn_history_id` int(11) NOT NULL,
  `imp_data_machinery_id` int(11) DEFAULT NULL,
  `imp_data_machn_history_desc` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_import_data_machinery_history`
--

INSERT INTO `com_import_data_machinery_history` (`imp_data_machn_history_id`, `imp_data_machinery_id`, `imp_data_machn_history_desc`, `created_by`, `created_at`) VALUES
(1, 1, '1', '4', NULL),
(2, 2, '2', '4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `com_insurance_company`
--

CREATE TABLE `com_insurance_company` (
  `insurance_comp_id` int(11) NOT NULL,
  `insurance_comp_name` varchar(145) DEFAULT NULL,
  `insurance_comp_code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `com_item`
--

CREATE TABLE `com_item` (
  `com_item_id` int(11) NOT NULL,
  `com_item_code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_item`
--

INSERT INTO `com_item` (`com_item_id`, `com_item_code`) VALUES
(1, '3234'),
(2, 'gg5464'),
(3, 'R45OP');

-- --------------------------------------------------------

--
-- Table structure for table `com_lc_period`
--

CREATE TABLE `com_lc_period` (
  `lc_period_id` int(11) NOT NULL,
  `lc_period_name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `com_lc_type`
--

CREATE TABLE `com_lc_type` (
  `lc_id` int(11) NOT NULL,
  `lc_type_name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `com_machinery_master_info`
--

CREATE TABLE `com_machinery_master_info` (
  `machinery_master_info_id` int(11) NOT NULL,
  `machinery_pi_id` int(11) DEFAULT NULL,
  `machinery_master_info_lc_no` varchar(45) DEFAULT NULL,
  `machinery_master_info_lc_date` date DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `machinery_master_info_created_by` varchar(45) DEFAULT NULL,
  `machinery_master_info_created_on` timestamp NULL DEFAULT NULL,
  `machinery_master_info_updated_by` varchar(45) DEFAULT NULL,
  `machinery_master_info_updated_on` timestamp NULL DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_machinery_master_info`
--

INSERT INTO `com_machinery_master_info` (`machinery_master_info_id`, `machinery_pi_id`, `machinery_master_info_lc_no`, `machinery_master_info_lc_date`, `section_id`, `machinery_master_info_created_by`, `machinery_master_info_created_on`, `machinery_master_info_updated_by`, `machinery_master_info_updated_on`, `unit_id`) VALUES
(1, 1, '123456', '2018-10-14', 2, NULL, NULL, NULL, NULL, NULL),
(2, 1, '453', '2018-10-04', 2, NULL, NULL, NULL, NULL, NULL),
(3, 1, '445', '2018-10-14', 2, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `com_machinery_pi`
--

CREATE TABLE `com_machinery_pi` (
  `machinery_pi_id` int(11) NOT NULL,
  `machinery_pi_fileno` varchar(45) DEFAULT NULL,
  `hr_unit_id` int(11) DEFAULT NULL,
  `machinery_pi_item` varchar(45) DEFAULT NULL,
  `machinery_pi_pi_no` varchar(45) DEFAULT NULL,
  `machinery_pi_pi_date` varchar(45) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `machinery_pi_sup_code` varchar(45) DEFAULT NULL,
  `machinery_pi_active_status` varchar(45) DEFAULT NULL,
  `machinery_pi_lc_status` varchar(45) DEFAULT NULL,
  `machinery_pi_description` varchar(45) DEFAULT NULL,
  `machinery_pi_model_no` varchar(45) DEFAULT NULL,
  `machine_type_id` int(11) NOT NULL,
  `manf_id` int(11) NOT NULL,
  `machinery_pi_marine_insurance_no` varchar(45) DEFAULT NULL,
  `machinery_pi_marine_insurance_date` date DEFAULT NULL,
  `insurance_comp_id` int(11) NOT NULL,
  `machinery_pi_quantity` varchar(45) DEFAULT NULL,
  `machinery_pi_unit_price` varchar(45) DEFAULT NULL,
  `machinery_pi_pi_amount` varchar(45) DEFAULT NULL,
  `machinery_pi_amount_unit` varchar(45) DEFAULT NULL,
  `machinery_pi_pi_lastdate` date DEFAULT NULL,
  `machinery_pi_remarks` varchar(45) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_machinery_pi`
--

INSERT INTO `com_machinery_pi` (`machinery_pi_id`, `machinery_pi_fileno`, `hr_unit_id`, `machinery_pi_item`, `machinery_pi_pi_no`, `machinery_pi_pi_date`, `sup_id`, `machinery_pi_sup_code`, `machinery_pi_active_status`, `machinery_pi_lc_status`, `machinery_pi_description`, `machinery_pi_model_no`, `machine_type_id`, `manf_id`, `machinery_pi_marine_insurance_no`, `machinery_pi_marine_insurance_date`, `insurance_comp_id`, `machinery_pi_quantity`, `machinery_pi_unit_price`, `machinery_pi_pi_amount`, `machinery_pi_amount_unit`, `machinery_pi_pi_lastdate`, `machinery_pi_remarks`, `unit_id`) VALUES
(1, '001', 1, 'reter', '1', '2018-10-02', 4, '234', 'No', 'Foreign', 'fgdfg', '323', 2, 2, '234', '2018-10-13', 234, '342', '3424', '324', 'USD', '2018-10-13', 'rtert', 1);

-- --------------------------------------------------------

--
-- Table structure for table `com_machinery_pi_history`
--

CREATE TABLE `com_machinery_pi_history` (
  `machinery_pi_history_id` int(11) NOT NULL,
  `machinery_pi_id` int(11) NOT NULL,
  `machinery_pi_history_desc` varchar(45) DEFAULT NULL,
  `machinery_pi_history_userid` varchar(45) DEFAULT NULL,
  `machinery_pi_history_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_machinery_pi_history`
--

INSERT INTO `com_machinery_pi_history` (`machinery_pi_history_id`, `machinery_pi_id`, `machinery_pi_history_desc`, `machinery_pi_history_userid`, `machinery_pi_history_datetime`) VALUES
(2, 5, NULL, '9999999999', '2018-10-09 06:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `com_machinery_pi_order`
--

CREATE TABLE `com_machinery_pi_order` (
  `machinery_pi_order_id` int(11) NOT NULL,
  `machinery_pi_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_machinery_pi_order`
--

INSERT INTO `com_machinery_pi_order` (`machinery_pi_order_id`, `machinery_pi_id`, `order_id`) VALUES
(1, 5, 9789),
(2, 5, 4645645);

-- --------------------------------------------------------

--
-- Table structure for table `com_machine_manufacturer`
--

CREATE TABLE `com_machine_manufacturer` (
  `manf_id` int(11) NOT NULL,
  `manf_name` varchar(45) DEFAULT NULL,
  `machine_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_machine_manufacturer`
--

INSERT INTO `com_machine_manufacturer` (`manf_id`, `manf_name`, `machine_type_id`) VALUES
(2, 'manuf 2', 2),
(6, 'manuf 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `com_machine_type`
--

CREATE TABLE `com_machine_type` (
  `machine_type_id` int(11) NOT NULL,
  `machine_type_name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_machine_type`
--

INSERT INTO `com_machine_type` (`machine_type_id`, `machine_type_name`) VALUES
(1, 'type1'),
(2, 'type1');

-- --------------------------------------------------------

--
-- Table structure for table `com_master_pi_accessories`
--

CREATE TABLE `com_master_pi_accessories` (
  `master_pi_acss_id` int(11) NOT NULL,
  `pi_entry_id` int(11) NOT NULL,
  `exp_lc_fileno` varchar(45) NOT NULL,
  `master_pi_acss_sup_code` varchar(45) DEFAULT NULL,
  `sup_id` varchar(45) DEFAULT NULL,
  `master_pi_acss_insurance_no` varchar(45) DEFAULT NULL,
  `master_pi_acss_insurance_date` date DEFAULT NULL,
  `insurance_comp_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_master_pi_accessories`
--

INSERT INTO `com_master_pi_accessories` (`master_pi_acss_id`, `pi_entry_id`, `exp_lc_fileno`, `master_pi_acss_sup_code`, `sup_id`, `master_pi_acss_insurance_no`, `master_pi_acss_insurance_date`, `insurance_comp_id`, `unit_id`) VALUES
(1, 1, '1', '111', '1', '1', '2018-10-04', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `com_master_pi_accessories_item`
--

CREATE TABLE `com_master_pi_accessories_item` (
  `master_pi_acss_item_id` int(11) NOT NULL,
  `master_pi_acss_id` int(11) NOT NULL,
  `pi_order_id` int(11) NOT NULL,
  `matitem_id` int(11) DEFAULT NULL,
  `master_pi_acss_item_type` varchar(45) DEFAULT NULL,
  `master_pi_acss_item_quantity` varchar(45) DEFAULT NULL,
  `master_pi_acss_item_qty_unit` varchar(45) DEFAULT NULL,
  `master_pi_acss_item_unit_price` varchar(45) DEFAULT NULL,
  `master_pi_acss_item_currency` varchar(45) DEFAULT NULL,
  `master_pi_acss_item_price_unit` varchar(45) DEFAULT NULL,
  `master_pi_acss_item_ship_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `com_master_pi_fabric`
--

CREATE TABLE `com_master_pi_fabric` (
  `master_pi_fab_id` int(11) NOT NULL,
  `pi_entry_id` int(11) DEFAULT NULL,
  `exp_lc_fileno` varchar(45) DEFAULT NULL,
  `master_pi_fab_sup_code` varchar(45) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `master_pi_fab_insurance_no` varchar(45) DEFAULT NULL,
  `master_pi_fab_insurance_date` date DEFAULT NULL,
  `insurance_comp_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_master_pi_fabric`
--

INSERT INTO `com_master_pi_fabric` (`master_pi_fab_id`, `pi_entry_id`, `exp_lc_fileno`, `master_pi_fab_sup_code`, `sup_id`, `master_pi_fab_insurance_no`, `master_pi_fab_insurance_date`, `insurance_comp_id`, `unit_id`) VALUES
(1, 1, '1', '111', 1, '1', '0000-00-00', 1, 1),
(2, 2, '3', NULL, 2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `com_master_pi_fabric_item`
--

CREATE TABLE `com_master_pi_fabric_item` (
  `master_pi_fab_item_id` int(11) NOT NULL,
  `master_pi_fab_id` int(11) DEFAULT NULL,
  `pi_order_id` int(11) DEFAULT NULL,
  `matitem_id` int(11) DEFAULT NULL,
  `clr_id` int(11) DEFAULT NULL,
  `master_pi_fab_item_fab_desc` varchar(45) DEFAULT NULL,
  `master_pi_fab_item_fab_construct` varchar(45) DEFAULT NULL,
  `com_master_pi_fab_width` varchar(45) DEFAULT NULL,
  `master_pi_fab_item_fab_color` varchar(45) DEFAULT NULL,
  `master_pi_fab_item_quantity` varchar(45) DEFAULT NULL,
  `master_pi_fab_item_qty_unit` varchar(45) DEFAULT NULL,
  `master_pi_fab_item_unit_price` varchar(45) DEFAULT NULL,
  `master_pi_fab_item_currency` varchar(45) DEFAULT NULL,
  `master_pi_fab_item_price_unit` varchar(45) DEFAULT NULL,
  `master_pi_fab_item_ship_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `com_pi_type`
--

CREATE TABLE `com_pi_type` (
  `pi_id` int(11) NOT NULL,
  `pi_type_name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_pi_type`
--

INSERT INTO `com_pi_type` (`pi_id`, `pi_type_name`) VALUES
(1, 'test pi'),
(2, 'test pi 2');

-- --------------------------------------------------------

--
-- Table structure for table `com_port`
--

CREATE TABLE `com_port` (
  `port_id` int(11) NOT NULL,
  `port_name` varchar(45) DEFAULT NULL,
  `port_address` varchar(45) DEFAULT NULL,
  `cnt_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_port`
--

INSERT INTO `com_port` (`port_id`, `port_name`, `port_address`, `cnt_id`) VALUES
(1, 'port1', 'derwer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `com_section`
--

CREATE TABLE `com_section` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(145) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_section`
--

INSERT INTO `com_section` (`section_id`, `section_name`) VALUES
(1, 'section1'),
(2, 'section2');

-- --------------------------------------------------------

--
-- Table structure for table `com_setup`
--

CREATE TABLE `com_setup` (
  `com_item2` int(11) NOT NULL,
  `test_col` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `com_ud_library_fab_pock`
--

CREATE TABLE `com_ud_library_fab_pock` (
  `id` int(11) NOT NULL,
  `ud_library_fab_pock_code` varchar(45) DEFAULT NULL,
  `ud_library_fab_pock_fab_comp` varchar(45) DEFAULT NULL,
  `ud_library_fab_pock_fab_desc` varchar(145) DEFAULT NULL,
  `ud_library_fab_pock_fab_cons` varchar(45) DEFAULT NULL,
  `ud_library_fab_pock_width` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_ud_library_fab_pock`
--

INSERT INTO `com_ud_library_fab_pock` (`id`, `ud_library_fab_pock_code`, `ud_library_fab_pock_fab_comp`, `ud_library_fab_pock_fab_desc`, `ud_library_fab_pock_fab_cons`, `ud_library_fab_pock_width`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '133d244', 'sffsf', 'sf', NULL, NULL, NULL, NULL, NULL, NULL),
(2, '78GU54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `com_vessel`
--

CREATE TABLE `com_vessel` (
  `vess_id` int(11) NOT NULL,
  `vess_name` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_vessel`
--

INSERT INTO `com_vessel` (`vess_id`, `vess_name`) VALUES
(1, 'vess1'),
(2, 'vess2');

-- --------------------------------------------------------

--
-- Table structure for table `com_voyage_vessel`
--

CREATE TABLE `com_voyage_vessel` (
  `voyage_id` int(11) NOT NULL,
  `voyage_no` varchar(60) DEFAULT NULL,
  `vess_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `com_voyage_vessel`
--

INSERT INTO `com_voyage_vessel` (`voyage_id`, `voyage_no`, `vess_id`) VALUES
(1, '11', 1),
(2, '12', 1),
(3, '21', 2),
(4, '22', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fin_asset`
--

CREATE TABLE `fin_asset` (
  `fin_asset_id` int(11) NOT NULL,
  `fin_asset_product_id` int(11) NOT NULL,
  `fin_asset_serial` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fin_asset_category`
--

CREATE TABLE `fin_asset_category` (
  `fin_asset_cat_id` int(11) NOT NULL,
  `fin_asset_cat_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fin_asset_product`
--

CREATE TABLE `fin_asset_product` (
  `fin_asset_product_id` int(11) NOT NULL,
  `fin_asset_product_cat_id` int(11) NOT NULL,
  `fin_asset_product_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_area`
--

CREATE TABLE `hr_area` (
  `hr_area_id` int(11) NOT NULL,
  `hr_area_name` varchar(128) DEFAULT NULL,
  `hr_area_name_bn` varchar(255) DEFAULT NULL,
  `hr_area_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_area`
--

INSERT INTO `hr_area` (`hr_area_id`, `hr_area_name`, `hr_area_name_bn`, `hr_area_status`) VALUES
(1, 'Office', 'à¦…à¦«à¦¿à¦¸', 1),
(2, 'Factory', 'à¦«à§à¦¯à¦¾à¦•à§à¦Ÿà¦°à¦¿', 1),
(3, 'G. Utilities', NULL, 1),
(4, 'Washing', 'à¦“à§Ÿà¦¾à¦¶à¦¿à¦‚', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_asset_assign`
--

CREATE TABLE `hr_asset_assign` (
  `hr_asset_assign_id` int(11) NOT NULL,
  `hr_associate_id` varchar(10) NOT NULL,
  `hr_fin_asset_id` int(11) NOT NULL,
  `hr_asset_assign_date` date NOT NULL,
  `hr_asset_return_date` date DEFAULT NULL,
  `hr_asset_created_by` int(11) DEFAULT NULL,
  `hr_asset_created_at` date DEFAULT NULL,
  `hr_asset_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-assign, 1-return'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_associate_status_tracker`
--

CREATE TABLE `hr_associate_status_tracker` (
  `status_id` int(11) NOT NULL,
  `status_as_id` varchar(10) NOT NULL,
  `status_type` int(1) NOT NULL,
  `status_date` date NOT NULL,
  `status_suspend_start` date DEFAULT NULL,
  `status_suspend_end` date DEFAULT NULL,
  `status_reason` varchar(255) DEFAULT NULL,
  `status_created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_as_adv_info`
--

CREATE TABLE `hr_as_adv_info` (
  `emp_adv_info_id` int(11) NOT NULL,
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
  `emp_adv_info_auth_sig` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_as_adv_info`
--

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
(29, '18A100009N', 1, NULL, NULL, '/assets/files/advinfo/5befa206e08e8.png', '/assets/files/advinfo/5befa206e104b.jpg', NULL, '123456789', NULL, NULL, NULL, NULL, NULL, 'Married', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19951018838018239', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/assets/files/advinfo/5befa28d97061.png', NULL, NULL),
(30, '18A100010N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3313054073105', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '18G100011N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hr_as_basic_info`
--

CREATE TABLE `hr_as_basic_info` (
  `as_id` int(11) NOT NULL,
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
  `as_status` tinyint(1) DEFAULT '1' COMMENT '0-delete, 1-active, 2-resign, 3-terminate, 4-suspend'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_as_basic_info`
--

INSERT INTO `hr_as_basic_info` (`as_id`, `as_emp_type_id`, `as_designation_id`, `as_unit_id`, `as_floor_id`, `as_line_id`, `as_shift_id`, `as_area_id`, `as_department_id`, `as_section_id`, `as_subsection_id`, `as_doj`, `associate_id`, `temp_id`, `as_name`, `as_gender`, `as_dob`, `as_contact`, `as_ot`, `as_pic`, `created_at`, `created_by`, `as_status`) VALUES
(42, 1, 25, '3', NULL, NULL, '', 1, 3, 20, 19, '2017-06-17', '17F005001B', '005001', 'MBM IT', 'Male', '1994-02-21', '01789654123', '0', NULL, '2018-07-17 05:08:15', '1', 1),
(46, 3, 37, '2', '21', '25', '', 2, 3, 21, 21, '2018-01-01', '18A100001N', '100001', 'SAHERA KHATUN', 'Female', '1978-02-05', '01688824633', '1', '/assets/images/employee/5b4eee49bf4bc.jpg', '2018-07-18 07:33:51', '8', 1),
(47, 2, 37, '2', '21', '25', NULL, 2, 25, 21, 21, '2018-01-01', '18A100002N', '100002', 'RUBEL KHAN', 'Male', '1997-05-03', '01688824633', '1', NULL, '2018-07-18 07:56:26', '8', 1),
(48, 2, 37, '3', '21', '25', NULL, 2, 25, 21, 21, '2018-01-01', '18A100003N', '100003', 'LAILY KHATUN', 'Female', '1985-07-20', '01688824633', '0', NULL, '2018-07-18 08:05:33', '8', 1),
(49, 3, 37, '3', '21', '25', NULL, 2, 25, 21, 21, '2018-01-01', '18A100004N', '100004', 'SABINA AKTER', 'Female', '1986-12-13', '01688824633', '1', NULL, '2018-07-18 08:05:37', '8', 1),
(50, 3, 37, '3', '21', '25', NULL, 2, 25, 21, 21, '2018-01-01', '18A100005N', '100005', 'ROUSHONARA', 'Female', '1982-08-25', '01688824633', '1', NULL, '2018-07-18 08:05:42', '8', 1),
(51, 3, 37, '3', '21', '26', NULL, 2, 25, 21, 21, '2018-01-01', '18A100006N', '100006', 'PARVIN AKTER', 'Female', '1986-05-05', '01688824633', '1', NULL, '2018-07-18 09:34:09', '8', 1),
(52, 3, 37, '3', '21', '26', NULL, 2, 3, 21, 21, '2018-01-01', '18A100007N', '100007', 'SHABANA', 'Female', '1987-08-17', '01688824633', '1', NULL, '2018-07-18 09:34:14', '8', 1),
(53, 3, 37, '3', '21', '26', NULL, 2, 25, 21, 21, '2018-01-01', '18A100008N', '100008', 'MST. AKLIMA BEGUM', 'Female', '1982-03-04', '01688824633', '1', NULL, '2018-07-18 09:34:19', '8', 1),
(54, 3, 37, '3', '21', '26', NULL, 2, 25, 21, 21, '2018-01-01', '18A100009N', '100009', 'MST. HAMIDA AKTER', 'Female', '1995-01-25', '01688824633', '1', NULL, '2018-07-18 09:34:26', '8', 1),
(55, 3, 37, '3', '21', '26', NULL, 2, 1, 21, 21, '2018-01-01', '18A100010N', '100010', 'MST. SURMA', 'Female', '1989-01-01', '01688824633', '1', NULL, '2018-07-18 09:34:34', '8', 1),
(56, 1, 28, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-07-18', '18G100011N', '100011', 'RASHED KHAN', 'Male', '1989-11-16', '01712863488', '0', NULL, '2018-07-18 09:43:42', '8', 1),
(57, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-07-01', '18G100012N', '100012', 'MORIOM', 'Female', '1999-08-25', '01712863488', '1', NULL, '2018-07-27 05:06:20', '9', 1),
(58, 1, 28, '2', NULL, NULL, NULL, 2, 2, NULL, NULL, '2018-12-13', '18M100013N', '100013', 'MD. NAZMUL HOSSAIN', 'Male', '1992-07-26', '01918788060', '0', NULL, '2018-07-27 05:06:31', '9', 1),
(59, 3, 33, '3', NULL, NULL, NULL, 2, 25, 21, NULL, '2018-07-08', '18G100014N', '100014', 'RUNA AKTER', 'Female', '1999-03-12', '01712863488', '1', NULL, '2018-07-27 06:16:59', '9', 1),
(60, 3, 37, '3', NULL, NULL, NULL, 2, 25, NULL, NULL, '2018-07-09', '18G100015N', '100015', 'RITA AKTER', 'Female', '1995-01-01', '01712863488', '1', NULL, '2018-07-27 06:31:29', '9', 1),
(61, 3, 37, '3', NULL, NULL, NULL, 2, 2, 21, 21, '2018-01-10', '18A100016N', '100016', 'LABONI AKTER', 'Female', '1997-09-25', '01712863488', '0', NULL, '2018-07-28 04:34:59', '9', 1),
(62, 3, 36, '3', NULL, NULL, NULL, 2, 25, NULL, NULL, '2018-01-15', '18A100017N', '100017', 'MST. SHOPNA PARVIN', 'Female', '1993-08-23', '01712863488', '0', NULL, '2018-07-28 04:45:41', '9', 1),
(63, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-03-01', '18C100018N', '100018', 'MONIR', 'Male', '1983-02-01', '01712863488', '1', NULL, '2018-07-28 04:57:17', '9', 1),
(64, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-10', '18A100019N', '100019', 'AMENA BEGUM', 'Female', '1985-04-10', '01712863488', '1', NULL, '2018-07-28 05:05:09', '9', 1),
(65, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-10', '18A100020N', '100020', 'NAZMA BEGUM', 'Female', '1990-04-13', '01712863488', '1', NULL, '2018-07-28 05:12:05', '9', 1),
(66, 3, 37, '3', NULL, NULL, NULL, 2, 25, 21, 21, '2018-01-11', '18A100021N', '100021', 'ABDUR RASHID', 'Male', '1999-01-07', '01712863488', '1', NULL, '2018-07-28 05:27:54', '9', 1),
(67, 3, 37, '3', NULL, NULL, NULL, 2, 1, 21, 21, '2018-01-01', '18A100022N', '100022', 'MST. AKLIMA BEGUM', 'Female', '1982-03-04', '01712863488', '1', NULL, '2018-07-28 05:34:10', '9', 1),
(84, 3, 37, '3', NULL, NULL, NULL, 2, 2, 21, 21, '2018-01-10', '18A100039N', '100039', 'MST. DINA AKTER', 'Female', '1993-04-18', '01712863488', '1', NULL, '2018-07-28 08:47:03', '9', 1),
(106, 3, 37, '3', NULL, NULL, NULL, 2, 2, 21, 21, '2018-03-10', '18C100061N', '100061', 'AKLIMA', 'Female', '1998-03-10', '01712863488', '1', NULL, '2018-07-29 05:24:31', '9', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_attendance`
--

CREATE TABLE `hr_attendance` (
  `att_id` int(11) NOT NULL,
  `as_id` int(11) NOT NULL,
  `in_time` timestamp NULL DEFAULT NULL,
  `out_time` timestamp NULL DEFAULT NULL,
  `hr_shift_code` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_attendance`
--

INSERT INTO `hr_attendance` (`att_id`, `as_id`, `in_time`, `out_time`, `hr_shift_code`) VALUES
(14, 56, '2018-07-18 02:15:00', '2018-07-18 11:15:00', 'A'),
(15, 51, '2018-07-18 02:15:00', '2018-07-18 11:15:00', 'A'),
(16, 50, '2018-07-19 03:03:22', NULL, 'A'),
(17, 46, '2018-07-19 17:04:45', '2018-07-19 18:24:45', 'A'),
(18, 56, '2018-07-19 22:51:40', '2018-07-20 00:09:34', 'A'),
(19, 55, '2018-07-19 22:54:35', '2018-07-20 03:04:02', 'A'),
(20, 54, '2018-07-19 22:55:03', '2018-07-20 01:03:46', 'A'),
(21, 53, '2018-07-19 22:55:09', '2018-07-20 02:08:17', 'A'),
(22, 49, '2016-07-19 22:55:16', '2018-07-20 03:03:23', 'A'),
(24, 48, '2018-07-19 22:59:17', '2018-07-20 03:04:57', 'A'),
(25, 56, '2018-07-17 15:08:00', '2018-07-18 00:00:00', 'A'),
(26, 42, '2018-07-17 15:08:00', '2018-07-18 00:18:00', 'A'),
(27, 56, '2018-07-20 00:44:03', '2018-07-20 00:46:39', 'A'),
(29, 46, '2018-07-20 14:52:30', '2018-07-21 00:34:59', 'A'),
(30, 53, '2018-07-20 14:57:17', '2018-07-21 00:32:26', 'A'),
(31, 51, '2012-07-20 14:57:35', '2012-07-20 14:57:36', 'A'),
(32, 46, '2018-07-20 15:01:13', '2018-07-21 00:37:05', 'A'),
(33, 49, '2018-07-20 15:02:51', '2018-07-21 00:34:44', 'A'),
(35, 56, '2018-07-21 14:45:07', '2018-07-21 23:45:41', 'A'),
(36, 48, '2018-07-21 14:51:26', '2018-07-22 03:02:15', 'A'),
(37, 53, '2018-07-21 14:56:21', '2018-07-22 03:04:12', 'A'),
(38, 55, '2018-07-21 14:58:03', '2018-07-22 03:03:37', 'A'),
(40, 51, '2018-07-21 14:58:29', '2018-07-22 03:03:00', 'A'),
(41, 50, '2018-07-21 15:01:39', '2018-07-22 03:02:51', 'A'),
(42, 54, '2018-07-21 23:43:59', '2018-07-21 23:44:01', 'A'),
(43, 48, '2018-07-22 14:53:27', '2018-07-23 03:04:27', 'A'),
(44, 55, '2018-07-22 14:55:00', '2018-07-23 03:02:10', 'A'),
(45, 46, '2018-07-22 14:55:19', '2018-07-23 00:12:29', 'A'),
(46, 54, '2018-07-22 14:55:26', '2011-07-21 23:44:39', 'A'),
(47, 50, '2018-07-22 14:55:33', '2018-07-23 03:02:22', 'A'),
(48, 53, '2018-07-22 14:55:52', '2018-07-23 03:03:55', 'A'),
(49, 51, '2018-07-22 14:57:39', '2018-07-22 20:01:31', 'A'),
(50, 56, '2018-07-22 18:18:00', '2018-07-22 19:17:35', 'A'),
(51, 42, '2018-07-22 15:00:00', '2018-07-22 16:00:00', 'A'),
(52, 56, '2018-07-23 14:42:43', NULL, 'A'),
(53, 46, '2018-07-23 14:53:44', NULL, 'A'),
(54, 53, '2018-07-23 14:58:13', NULL, 'A'),
(55, 48, '2018-07-23 14:58:49', NULL, 'A'),
(56, 50, '2018-07-23 15:02:25', NULL, 'A'),
(57, 51, '2018-07-23 15:08:50', NULL, 'A'),
(58, 104, '2018-07-29 13:01:00', '2018-07-29 13:01:00', 'A'),
(59, 56, '2018-07-24 19:35:25', '2018-07-24 19:36:46', 'A'),
(60, 46, '2018-07-25 00:01:40', '2018-07-25 14:52:48', 'A'),
(61, 55, '2018-07-25 00:02:39', NULL, 'A'),
(62, 51, '2018-07-25 00:04:18', NULL, 'A'),
(63, 53, '2018-07-25 00:04:34', '2018-07-25 14:55:58', 'A'),
(64, 48, '2018-07-25 03:02:18', '2018-07-25 14:58:06', 'A'),
(65, 50, '2018-07-25 03:05:14', '2018-07-25 15:03:00', 'A'),
(66, 56, '2018-07-26 00:07:00', '2018-07-26 03:08:25', 'A'),
(67, 46, '2018-07-26 03:02:11', '2018-07-26 14:56:06', 'A'),
(68, 51, '2018-07-26 03:02:24', '2018-07-26 15:00:47', 'A'),
(69, 48, '2018-07-26 04:01:57', '2018-07-26 14:55:35', 'A'),
(70, 53, '2018-07-26 04:04:12', '2018-07-26 14:55:26', 'A'),
(71, 55, '2018-07-26 05:01:39', NULL, 'A'),
(72, 50, '2018-07-26 05:02:09', '2018-07-26 14:54:15', 'A'),
(73, 56, '2018-07-27 03:03:09', NULL, 'A'),
(74, 51, '2018-07-27 03:04:04', '2018-07-27 14:57:10', 'A'),
(75, 48, '2018-07-27 04:01:41', '2018-07-27 15:00:30', 'A'),
(76, 46, '2018-07-27 04:03:25', '2018-07-27 14:55:20', 'A'),
(77, 50, '2018-07-27 04:03:34', '2018-07-27 14:59:51', 'A'),
(78, 55, '2018-07-27 04:03:52', '2018-07-27 14:55:55', 'A'),
(79, 53, '2018-07-27 14:58:52', '2018-07-28 00:35:57', 'A'),
(80, 51, '2018-07-28 00:34:19', '2018-07-28 14:59:56', 'A'),
(81, 55, '2018-07-28 00:34:25', '2018-07-28 14:48:24', 'A'),
(82, 50, '2018-07-28 00:34:32', '2018-07-28 14:59:02', 'A'),
(83, 46, '2018-07-28 00:34:58', '2018-07-28 14:56:57', 'A'),
(84, 48, '2018-07-28 00:35:40', '2018-07-28 14:55:13', 'A'),
(85, 46, '2018-07-29 03:02:22', '2018-07-29 14:57:00', 'A'),
(86, 48, '2018-07-29 03:03:42', '2018-07-29 14:54:39', 'A'),
(87, 55, '2018-07-29 04:04:13', '2018-07-29 14:51:27', 'A'),
(88, 53, '2018-07-29 04:04:19', '2018-07-29 14:57:18', 'A'),
(89, 51, '2018-07-29 05:02:44', '2018-07-29 15:00:44', 'A'),
(90, 50, '2018-07-29 05:02:55', NULL, 'A'),
(91, 56, '2018-07-29 14:51:23', NULL, 'A'),
(92, 48, '2018-07-30 03:01:06', '2018-07-30 14:54:23', 'A'),
(93, 51, '2018-07-30 04:01:46', '2018-07-30 14:57:11', 'A'),
(94, 46, '2018-07-30 04:02:02', '2018-07-30 15:00:35', 'A'),
(95, 53, '2018-07-30 04:04:51', '2018-07-30 14:53:29', 'A'),
(96, 50, '2018-07-30 05:02:38', '2018-07-30 14:58:31', 'A'),
(97, 55, '2018-07-30 05:02:42', '2018-07-30 14:54:07', 'A'),
(98, 53, '2012-08-01 04:01:14', '2012-08-01 05:01:14', 'A'),
(99, 106, '2018-08-01 04:42:53', '2018-08-01 04:42:53', 'A'),
(100, 58, '2018-08-01 04:43:01', '2018-08-01 05:43:01', 'A'),
(101, 84, '2018-08-01 02:03:03', '2018-08-01 15:53:41', 'A'),
(102, 50, '2018-08-01 02:54:57', '2018-08-01 15:54:24', 'A'),
(103, 46, '2018-08-01 02:55:00', NULL, 'A'),
(104, 51, '2012-08-01 14:58:43', NULL, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `hr_attendance_manual`
--

CREATE TABLE `hr_attendance_manual` (
  `hr_att_id` int(11) UNSIGNED NOT NULL,
  `hr_att_as_id` varchar(10) NOT NULL,
  `hr_att_date` date NOT NULL,
  `hr_att_punch_time` time NOT NULL,
  `hr_att_night_flag` tinyint(1) NOT NULL DEFAULT '0',
  `hr_att_reason` mediumtext NOT NULL,
  `hr_att_created_at` datetime DEFAULT NULL,
  `hr_att_posted_by` int(11) DEFAULT NULL,
  `device_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_attendance_manual`
--

INSERT INTO `hr_attendance_manual` (`hr_att_id`, `hr_att_as_id`, `hr_att_date`, `hr_att_punch_time`, `hr_att_night_flag`, `hr_att_reason`, `hr_att_created_at`, `hr_att_posted_by`, `device_id`) VALUES
(9, '09A020002E', '2018-05-31', '08:00:00', 0, 'ddd', '2018-05-31 07:53:12', 9, NULL),
(10, '09A020002E', '2018-05-31', '06:00:00', 0, 'ddd', '2018-05-31 07:53:12', 9, NULL),
(11, '18E100001N', '2018-05-31', '08:00:00', 0, 'sdfdf', '2018-05-31 09:22:11', 8, NULL),
(12, '18E100001N', '2018-05-31', '00:02:00', 0, 'sdfdf', '2018-05-31 09:22:11', 8, NULL),
(13, '18E100001N', '2018-06-02', '02:00:00', 0, 'rgdfg', '2018-06-02 06:16:45', 8, NULL),
(14, '18E100001N', '2018-06-02', '00:05:00', 0, 'rgdfg', '2018-06-02 06:16:45', 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hr_benefits`
--

CREATE TABLE `hr_benefits` (
  `ben_id` int(11) NOT NULL,
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
  `ben_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_benefits`
--

INSERT INTO `hr_benefits` (`ben_id`, `ben_as_id`, `ben_joining_salary`, `ben_cash_amount`, `ben_bank_amount`, `ben_current_salary`, `ben_basic`, `ben_house_rent`, `ben_medical`, `ben_transport`, `ben_food`, `ben_status`, `ben_updated_at`) VALUES
(6, '18A100003N', 50000, 45000, 25000, 70000, 42000, 7000, 7000, 7000, 7000, 1, '2018-07-17 12:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `hr_department`
--

CREATE TABLE `hr_department` (
  `hr_department_id` int(11) NOT NULL,
  `hr_department_area_id` int(11) DEFAULT NULL,
  `hr_department_name` varchar(128) NOT NULL,
  `hr_department_name_bn` varchar(255) NOT NULL,
  `hr_department_code` varchar(10) DEFAULT NULL,
  `hr_department_min_range` varchar(6) DEFAULT NULL,
  `hr_department_max_range` varchar(6) DEFAULT NULL,
  `hr_department_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_department`
--

INSERT INTO `hr_department` (`hr_department_id`, `hr_department_area_id`, `hr_department_name`, `hr_department_name_bn`, `hr_department_code`, `hr_department_min_range`, `hr_department_max_range`, `hr_department_status`) VALUES
(2, 2, 'IT Section', '', 'I', NULL, NULL, 1),
(3, 2, 'Human Resource', '', NULL, NULL, NULL, 1),
(25, 2, 'Production', 'à¦‰à§Žà¦ªà¦¾à¦¦à¦¨', 'N', '100001', '500000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_designation`
--

CREATE TABLE `hr_designation` (
  `hr_designation_id` int(11) NOT NULL,
  `hr_designation_emp_type` int(11) NOT NULL,
  `hr_designation_name` varchar(128) DEFAULT NULL,
  `hr_designation_name_bn` varchar(255) DEFAULT NULL,
  `hr_designation_position` int(3) NOT NULL DEFAULT '1',
  `hr_designation_status` tinyint(1) NOT NULL DEFAULT '1',
  `hr_designation_grade` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_designation`
--

INSERT INTO `hr_designation` (`hr_designation_id`, `hr_designation_emp_type`, `hr_designation_name`, `hr_designation_name_bn`, `hr_designation_position`, `hr_designation_status`, `hr_designation_grade`) VALUES
(24, 1, 'AMD', 'à¦ à¦†à¦®à¦¿ à¦¡à¦¿', 28, 1, ''),
(25, 1, 'CEO', 'à¦¸à¦¿ à¦‡ à¦“', 27, 1, 'A'),
(26, 1, 'Manager', 'à¦®à§à¦¯à¦¾à¦¨à§‡à¦œà¦¾à¦°', 26, 1, 'B'),
(27, 1, 'Sr Officer', 'à¦¸à¦¿à¦¨à¦¿à§Ÿà¦° à¦…à¦«à¦¿à¦¸à¦¾à¦°', 25, 1, 'A'),
(28, 1, 'Officer', 'à¦…à¦«à¦¿à¦¸à¦¾à¦°', 24, 1, 'A'),
(29, 2, 'Offiece Boy', 'à¦…à¦«à¦¿à¦¸ à¦¬à§Ÿ', 23, 1, 'A'),
(30, 2, 'Cleaner', 'à¦ªà¦°à¦¿à¦›à¦¨à§à¦¨ à¦•à¦°à§à¦®à§€', 20, 1, 'B'),
(31, 3, 'Senior Operator', 'à¦¸à¦¿à¦¨à¦¿à§Ÿà¦° à¦…à¦ªà¦¾à¦°à§‡à¦Ÿà¦°', 21, 1, 'A'),
(32, 3, 'Cutter Man', 'à¦•à¦¾à¦Ÿà¦¾à¦° à¦®à§à¦¯à¦¾à¦¨', 22, 1, 'B'),
(33, 3, 'Helper', 'à¦¹à§‡à¦²à§à¦ªà¦¾à¦°', 4, 1, 'A'),
(34, 1, 'Washerman', 'à¦§à§‹à¦ªà¦¾', 19, 1, 'B'),
(35, 1, 'Junior Manager', 'à¦œà§à¦¨à¦¿à§Ÿà¦° à¦®à§à¦¯à¦¾à¦¨à§‡à¦œà¦¾à¦°', 2, 1, 'A'),
(36, 3, 'Sewing machine operator', 'à¦¸à§‡à¦²à¦¾à¦‡ à¦®à§‡à¦¶à¦¿à¦¨ à¦…à¦ªà¦¾à¦°à§‡à¦Ÿà¦°', 12, 1, 'B'),
(37, 3, 'Ordinary Sewing Machine Operator', 'à¦¸à¦¾à¦§à¦¾à¦°à¦£ à¦¸à§‡à¦²à¦¾à¦‡ à¦®à§‡à¦¶à¦¿à¦¨ à¦…à¦ªà¦¾à¦°à§‡à¦Ÿà¦°', 1, 1, 'C'),
(38, 3, 'Sewing Iron Man', NULL, 9, 1, 'A'),
(39, 3, 'INPUT MAN', NULL, 16, 1, 'B'),
(40, 3, 'JUNIOR PACKER', NULL, 7, 1, 'A'),
(41, 3, 'JUNIOR FOLDING MAN', NULL, 14, 1, 'A'),
(42, 3, 'Needle Man', NULL, 5, 1, 'B'),
(43, 3, 'PACKER', NULL, 13, 1, 'D'),
(44, 3, 'SAMPLE MAN', NULL, 3, 1, 'A'),
(45, 3, 'SECURITY GUARD', NULL, 11, 1, 'A'),
(46, 3, 'Quality Inspector', NULL, 18, 1, 'A'),
(48, 3, 'JUNIOR IRONMAN FINISHING', NULL, 8, 1, 'A'),
(49, 3, 'FINISHING IRONMAN', NULL, 15, 1, 'C'),
(50, 3, 'Labor', NULL, 6, 1, ''),
(51, 1, 'Assistant Manager', NULL, 10, 1, ''),
(52, 1, 'Merchandiser', NULL, 17, 1, ''),
(53, 1, 'Junior Officer QC', NULL, 1, 1, ''),
(54, 1, 'Senior Technician', NULL, 1, 1, ''),
(55, 1, 'Assistant Merchandiser', NULL, 1, 1, ''),
(56, 1, 'Welfare Officer', NULL, 1, 1, ''),
(57, 1, 'Jr Officer Welfare', NULL, 1, 1, ''),
(58, 1, 'Sr. Officer', NULL, 1, 1, ''),
(59, 1, 'Jr Officer', NULL, 1, 1, ''),
(60, 1, 'Patern Assistant', NULL, 1, 1, ''),
(61, 1, 'Line Leader', NULL, 1, 1, ''),
(62, 1, 'Management Trainee', NULL, 1, 1, ''),
(63, 1, 'Officer Marker Man', NULL, 1, 1, ''),
(64, 1, 'Assistant Planner', NULL, 1, 1, ''),
(65, 1, 'Sr. Manager', NULL, 1, 1, ''),
(66, 1, 'Sr.Spendder Operator', NULL, 1, 1, ''),
(67, 1, 'Trainer', NULL, 1, 1, ''),
(68, 2, 'Messenger', NULL, 1, 1, ''),
(69, 1, 'Line Manager', NULL, 1, 1, ''),
(70, 1, 'Quality Controller', NULL, 1, 1, ''),
(71, 1, 'Supervisor', NULL, 1, 1, ''),
(72, 2, 'Driver', NULL, 1, 1, ''),
(73, 2, 'Welder', NULL, 1, 1, ''),
(74, 2, 'Technician', NULL, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `hr_dist`
--

CREATE TABLE `hr_dist` (
  `dis_id` int(2) NOT NULL,
  `dis_name` varchar(64) NOT NULL,
  `dis_name_bn` varchar(255) DEFAULT NULL,
  `dis_status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_dist`
--

INSERT INTO `hr_dist` (`dis_id`, `dis_name`, `dis_name_bn`, `dis_status`) VALUES
(1, 'Dhaka', 'à¦¢à¦¾à¦•à¦¾', 1),
(2, 'Faridpur', 'à¦«à¦°à¦¿à¦¦à¦ªà§à¦°', 1),
(3, 'Gazipur', 'à¦—à¦¾à¦œà§€à¦ªà§à¦°', 1),
(4, 'Gopalganj', 'à¦—à§‹à¦ªà¦¾à¦²à¦—à¦žà§à¦œ', 1),
(5, 'Jamalpur', 'à¦œà¦¾à¦®à¦¾à¦²à¦ªà§à¦°', 1),
(6, 'Kishoreganj', 'à¦•à¦¿à¦¶à§‹à¦°à¦—à¦žà§à¦œ', 1),
(7, 'Madaripur', 'à¦®à¦¾à¦¦à¦¾à¦°à§€à¦ªà§à¦°', 1),
(8, 'Manikganj', 'à¦®à¦¾à¦¨à¦¿à¦•à¦—à¦žà§à¦œ', 1),
(9, 'Munshiganj', 'à¦®à§à¦¨à§à¦¸à¦¿à¦—à¦žà§à¦œ', 1),
(10, 'Mymensingh', 'à¦®à§Ÿà¦®à¦¨à¦¸à¦¿à¦‚à¦¹', 1),
(11, 'Narayanganj', 'à¦¨à¦¾à¦°à¦¾à§Ÿà¦¾à¦£à¦—à¦žà§à¦œ', 1),
(12, 'Narsingdi', 'à¦¨à¦°à¦¸à¦¿à¦‚à¦¦à§€', 1),
(13, 'Netrokona', 'à¦¨à§‡à¦¤à§à¦°à¦•à§‹à¦£à¦¾', 1),
(14, 'Rajbari', 'à¦°à¦¾à¦œà¦¬à¦¾à§œà¦¿', 1),
(15, 'Shariatpur', 'à¦¶à¦°à§€à§Ÿà¦¤à¦ªà§à¦°', 1),
(16, 'Sherpur', 'à¦¶à§‡à¦°à¦ªà§à¦°', 1),
(17, 'Tangail', 'à¦Ÿà¦¾à¦™à§à¦—à¦¾à¦‡à¦²', 1),
(18, 'Bogra', 'à¦¬à¦—à§à§œà¦¾', 1),
(19, 'Joypurhat', 'à¦œà§Ÿà¦ªà§à¦°à¦¹à¦¾à¦Ÿ', 1),
(20, 'Naogaon', 'à¦¨à¦“à¦—à¦¾à¦', 1),
(21, 'Natore', 'à¦¨à¦¾à¦Ÿà§‹à¦°', 1),
(22, 'Nawabganj', 'à¦¨à¦¬à¦¾à¦¬à¦—à¦žà§à¦œ', 1),
(23, 'Pabna', 'à¦ªà¦¾à¦¬à¦¨à¦¾', 1),
(24, 'Rajshahi', 'à¦°à¦¾à¦œà¦¶à¦¾à¦¹à§€', 1),
(25, 'Sirajgonj', 'à¦¸à¦¿à¦°à¦¾à¦œà¦—à¦žà§à¦œ', 1),
(26, 'Dinajpur', 'à¦¦à¦¿à¦¨à¦¾à¦œà¦ªà§à¦°', 1),
(27, 'Gaibandha', 'à¦—à¦¾à¦‡à¦¬à¦¾à¦¨à§à¦§à¦¾', 1),
(28, 'Kurigram', 'à¦•à§à§œà¦¿à¦—à§à¦°à¦¾à¦®', 1),
(29, 'Lalmonirhat', 'à¦²à¦¾à¦²à¦®à¦¨à¦¿à¦°à¦¹à¦¾à¦Ÿ', 1),
(30, 'Nilphamari', 'à¦¨à§€à¦²à¦«à¦¾à¦®à¦¾à¦°à§€', 1),
(31, 'Panchagarh', 'à¦ªà¦žà§à¦šà¦—à§œ', 1),
(32, 'Rangpur', 'à¦°à¦‚à¦ªà§à¦°', 1),
(33, 'Thakurgaon', 'à¦ à¦¾à¦•à§à¦°à¦—à¦¾à¦à¦“', 1),
(34, 'Barguna', 'à¦¬à¦°à¦—à§à¦¨à¦¾', 1),
(35, 'Barisal', 'à¦¬à¦°à¦¿à¦¶à¦¾à¦²', 1),
(36, 'Bhola', 'à¦­à§‹à¦²à¦¾', 1),
(37, 'Jhalokati', 'à¦à¦¾à¦²à¦•à¦¾à¦ à¦¿', 1),
(38, 'Patuakhali', 'à¦ªà¦Ÿà§à§Ÿà¦¾à¦–à¦¾à¦²à§€', 1),
(39, 'Pirojpur', 'à¦ªà¦¿à¦°à§‹à¦œà¦ªà§à¦°', 1),
(40, 'Bandarban', 'à¦¬à¦¾à¦¨à§à¦¦à¦°à¦¬à¦¾à¦¨', 1),
(41, 'Brahmanbaria', 'à¦¬à§à¦°à¦¾à¦¹à§à¦®à¦£à¦¬à¦¾à§œà¦¿à§Ÿà¦¾', 1),
(42, 'Chandpur', 'à¦šà¦¾à¦à¦¦à¦ªà§à¦°', 1),
(43, 'Chittagong', 'à¦šà¦Ÿà§à¦Ÿà¦—à§à¦°à¦¾à¦®', 1),
(44, 'Comilla', 'à¦•à§à¦®à¦¿à¦²à§à¦²à¦¾', 1),
(45, 'Cox\'s Bazar', 'à¦•à¦•à§à¦¸à¦¬à¦¾à¦œà¦¾à¦°', 1),
(46, 'Feni', 'à¦«à§‡à¦¨à§€', 1),
(47, 'Khagrachari', 'à¦–à¦¾à¦—à§œà¦¾à¦›à§œà¦¿', 1),
(48, 'Lakshmipur', 'à¦²à¦•à§à¦·à§à¦®à§€à¦ªà§à¦°', 1),
(49, 'Noakhali', 'à¦¨à§‹à§Ÿà¦¾à¦–à¦¾à¦²à§€', 1),
(50, 'Rangamati', 'à¦°à¦¾à¦™à§à¦—à¦¾à¦®à¦¾à¦Ÿà¦¿', 1),
(51, 'Habiganj', 'à¦¹à¦¬à¦¿à¦—à¦žà§à¦œ', 1),
(52, 'Maulvibazar', 'à¦®à§Œà¦²à¦­à§€à¦¬à¦¾à¦œà¦¾à¦°', 1),
(53, 'Sunamganj', 'à¦¸à§à¦¨à¦¾à¦®à¦—à¦žà§à¦œ', 1),
(54, 'Sylhet', 'à¦¸à¦¿à¦²à§‡à¦Ÿ', 1),
(55, 'Bagerhat', 'à¦¬à¦¾à¦—à§‡à¦°à¦¹à¦¾à¦Ÿ', 1),
(56, 'Chuadanga', 'à¦šà§à§Ÿà¦¾à¦¡à¦¾à¦™à§à¦—à¦¾', 1),
(57, 'Jessore', 'à¦¯à¦¶à§‹à¦°', 1),
(58, 'Jhenaidah', 'à¦à¦¿à¦¨à¦¾à¦‡à¦¦à¦¹', 1),
(59, 'Khulna', 'à¦–à§à¦²à¦¨à¦¾', 1),
(60, 'Kushtia', 'à¦•à§à¦·à§à¦Ÿà¦¿à§Ÿà¦¾', 1),
(61, 'Magura', 'à¦®à¦¾à¦—à§à¦°à¦¾', 1),
(62, 'Meherpur', 'à¦®à§‡à¦¹à§‡à¦°à¦ªà§à¦°', 1),
(63, 'Narail', 'à¦¨à§œà¦¾à¦‡à¦²', 1),
(64, 'Satkhira', 'à¦¸à¦¾à¦¤à¦•à§à¦·à§€à¦°à¦¾', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_dis_rec`
--

CREATE TABLE `hr_dis_rec` (
  `dis_re_id` int(11) NOT NULL,
  `dis_re_offender_id` varchar(10) NOT NULL,
  `dis_re_griever_id` varchar(10) DEFAULT NULL,
  `dis_re_issue_id` int(11) NOT NULL,
  `dis_re_ac_step_id` int(11) NOT NULL,
  `dis_re_req_remedy` varchar(50) DEFAULT NULL,
  `dis_re_discussed_date` date NOT NULL,
  `dis_re_doe_from` date NOT NULL,
  `dis_re_doe_to` date NOT NULL,
  `dis_re_created_by` varchar(10) DEFAULT NULL,
  `dis_re_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_dis_rec`
--

INSERT INTO `hr_dis_rec` (`dis_re_id`, `dis_re_offender_id`, `dis_re_griever_id`, `dis_re_issue_id`, `dis_re_ac_step_id`, `dis_re_req_remedy`, `dis_re_discussed_date`, `dis_re_doe_from`, `dis_re_doe_to`, `dis_re_created_by`, `dis_re_created_at`) VALUES
(1, '18E100001N', '14J005004B', 2, 1, 'sdfsdf', '2018-05-08', '2018-05-22', '2018-05-28', '8', '2018-05-31 09:59:05'),
(2, '18D002011H', '18G000002A', 1, 1, 'Need to be warned', '2018-07-16', '2018-07-16', '2018-07-16', '1', '2018-07-16 12:06:01'),
(3, '18A100009N', '18G100007N', 2, 1, 'Verbal Warning', '2018-07-17', '2018-07-17', '2018-07-17', '1', '2018-07-17 09:18:23'),
(4, '18G100007N', '18E100003N', 1, 1, 'Verbal Warning', '2018-07-17', '2018-07-17', '2018-07-27', '1', '2018-07-18 04:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `hr_earn_leave`
--

CREATE TABLE `hr_earn_leave` (
  `earn_id` int(11) NOT NULL,
  `associate_id` varchar(128) NOT NULL,
  `paid_days` varchar(128) NOT NULL,
  `paid_amount` varchar(128) NOT NULL,
  `duration` varchar(128) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_education`
--

CREATE TABLE `hr_education` (
  `id` int(11) NOT NULL,
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
  `education_passing_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_education`
--

INSERT INTO `hr_education` (`id`, `education_as_id`, `education_level_id`, `education_degree_id_1`, `education_degree_id_2`, `education_major_group_concentation`, `education_institute_name`, `education_result_id`, `education_result_marks`, `education_result_cgpa`, `education_result_scale`, `education_passing_year`) VALUES
(1, '18A100005N', 1, 1, NULL, NULL, 'R. K. High School', 8, NULL, NULL, NULL, 1950),
(2, '18A100003N', 4, 5, '5', NULL, '', 0, NULL, NULL, NULL, 0),
(3, '18A100005N', 5, 19, '5', NULL, '', 0, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hr_education_degree_title`
--

CREATE TABLE `hr_education_degree_title` (
  `id` int(11) NOT NULL,
  `education_level_id` int(11) NOT NULL,
  `education_degree_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_education_degree_title`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `hr_education_level`
--

CREATE TABLE `hr_education_level` (
  `id` int(11) NOT NULL,
  `education_level_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_education_level`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `hr_education_result`
--

CREATE TABLE `hr_education_result` (
  `id` int(11) NOT NULL,
  `education_result_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_education_result`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `hr_employee_bengali`
--

CREATE TABLE `hr_employee_bengali` (
  `hr_bn_id` int(11) NOT NULL,
  `hr_bn_associate_id` varchar(10) NOT NULL,
  `hr_bn_associate_name` varchar(255) DEFAULT NULL,
  `hr_bn_father_name` varchar(255) DEFAULT NULL,
  `hr_bn_mother_name` varchar(255) DEFAULT NULL,
  `hr_bn_spouse_name` varchar(255) DEFAULT NULL,
  `hr_bn_permanent_village` varchar(255) DEFAULT NULL,
  `hr_bn_permanent_po` varchar(255) DEFAULT NULL,
  `hr_bn_present_road` varchar(255) DEFAULT NULL,
  `hr_bn_present_house` varchar(255) DEFAULT NULL,
  `hr_bn_present_po` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_employee_bengali`
--

INSERT INTO `hr_employee_bengali` (`hr_bn_id`, `hr_bn_associate_id`, `hr_bn_associate_name`, `hr_bn_father_name`, `hr_bn_mother_name`, `hr_bn_spouse_name`, `hr_bn_permanent_village`, `hr_bn_permanent_po`, `hr_bn_present_road`, `hr_bn_present_house`, `hr_bn_present_po`) VALUES
(1, '18A100001N', '  à¦¨à¦¾à¦®', 'à¦ªà¦¿à¦¤à¦¾à¦° à¦¨à¦¾à¦®', 'à¦®à¦¾à¦¤à¦¾', NULL, 'à¦ à¦¿à¦•à¦¾à¦¨à¦¾ à¦•à¦²à¦¾à¦¬à¦¾à¦—à¦¾à¦¨ ', 'à¦§à¦¾à¦¨à¦®à¦£à§à¦¡à¦¿ ', 'à¦•à¦²à¦¾à¦¬à¦¾à¦—à¦¾à¦¨ ', 'à¦§à¦¾à¦¨à¦®à¦£à§à¦¡à¦¿ ', 'à¦§à¦¾à¦¨à¦®à¦£à§à¦¡à¦¿ à¦§à¦¾à¦¨à¦®à¦£à§à¦¡à¦¿ '),
(2, '18A100006N', 'à¦¸à¦¾à¦²à§‡à¦¹à¦¾', 'à¦†à¦¬à§à¦¦à§à¦² ', 'à¦¸à§à¦²à¦¤à¦¾à¦¨à¦¾', NULL, 'à¦§à¦¾à¦¨à¦®à¦£à§à¦¡à¦¿ ', 'à¦•à¦²à¦¾à¦¬à¦¾à¦—à¦¾à¦¨', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hr_emp_type`
--

CREATE TABLE `hr_emp_type` (
  `emp_type_id` int(11) NOT NULL,
  `hr_emp_type_name` varchar(255) NOT NULL,
  `hr_emp_type_code` varchar(10) NOT NULL,
  `hr_emp_type_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_emp_type`
--

INSERT INTO `hr_emp_type` (`emp_type_id`, `hr_emp_type_name`, `hr_emp_type_code`, `hr_emp_type_status`) VALUES
(1, 'Management', 'M', 1),
(2, 'Staff', 'S', 1),
(3, 'Worker', 'W', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_floor`
--

CREATE TABLE `hr_floor` (
  `hr_floor_id` int(11) NOT NULL,
  `hr_floor_unit_id` int(11) NOT NULL,
  `hr_floor_name` varchar(128) NOT NULL,
  `hr_floor_name_bn` varchar(255) DEFAULT NULL,
  `hr_floor_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_floor`
--

INSERT INTO `hr_floor` (`hr_floor_id`, `hr_floor_unit_id`, `hr_floor_name`, `hr_floor_name_bn`, `hr_floor_status`) VALUES
(21, 3, 'G-Floor', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_grievance_appeal`
--

CREATE TABLE `hr_grievance_appeal` (
  `hr_griv_appl_id` int(11) NOT NULL,
  `hr_griv_associate_id` varchar(10) NOT NULL,
  `hr_griv_appl_issue_id` int(11) NOT NULL,
  `hr_griv_appl_step` varchar(255) DEFAULT NULL,
  `hr_griv_appl_discussed_date` date NOT NULL,
  `hr_griv_appl_req_remedy` varchar(255) NOT NULL,
  `hr_griv_appl_offender_as_id` varchar(10) NOT NULL,
  `hr_griv_appl_created_by` varchar(10) DEFAULT NULL,
  `hr_griv_appl_created_at` datetime DEFAULT NULL,
  `hr_griv_appl_status` tinyint(1) DEFAULT '0' COMMENT '0-pending, 1-action'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_grievance_issue`
--

CREATE TABLE `hr_grievance_issue` (
  `hr_griv_issue_id` int(11) NOT NULL,
  `hr_griv_issue_name` varchar(255) NOT NULL,
  `hr_griv_issue_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_grievance_issue`
--

INSERT INTO `hr_grievance_issue` (`hr_griv_issue_id`, `hr_griv_issue_name`, `hr_griv_issue_status`) VALUES
(1, 'Verbal Abuse', 1),
(2, 'Declining Gate Pass', 1),
(3, 'Declining Leave', 1),
(4, 'Physical Abuse', 1),
(5, 'Forcing to Work Extra', 1),
(6, 'Indecent  Proposal', 1),
(7, 'Sextual Harassment', 1),
(8, 'Miscellaneous', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_grievance_steps`
--

CREATE TABLE `hr_grievance_steps` (
  `hr_griv_steps_id` int(11) NOT NULL,
  `hr_griv_steps_name` varchar(255) NOT NULL,
  `hr_griv_steps_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_grievance_steps`
--

INSERT INTO `hr_grievance_steps` (`hr_griv_steps_id`, `hr_griv_steps_name`, `hr_griv_steps_status`) VALUES
(1, 'Verbal Warning', 1),
(2, 'Written Warning', 1),
(3, 'B of I', 1),
(4, 'With Hold Increment', 1),
(5, 'Dismiss', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_increment`
--

CREATE TABLE `hr_increment` (
  `id` int(11) NOT NULL,
  `associate_id` varchar(10) NOT NULL,
  `current_salary` float NOT NULL,
  `increment_type` int(11) NOT NULL,
  `increment_amount` float NOT NULL,
  `amount_type` int(11) NOT NULL,
  `eligible_date` datetime NOT NULL,
  `effective_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_increment`
--

INSERT INTO `hr_increment` (`id`, `associate_id`, `current_salary`, `increment_type`, `increment_amount`, `amount_type`, `eligible_date`, `effective_date`, `status`, `created_by`, `created_at`) VALUES
(5, '17F005001B', 50000, 0, 5000, 1, '2018-06-17 00:00:00', '2018-07-17 00:00:00', 1, '17F005001B', '2018-07-17 07:19:47'),
(6, '17F005001B', 50000, 0, 5, 2, '2018-06-17 00:00:00', '2018-07-17 00:00:00', 1, '17F005001B', '2018-07-17 07:23:38'),
(7, '17F005001B', 50000, 0, 5, 2, '2018-06-17 00:00:00', '2018-07-17 00:00:00', 1, '17F005001B', '2018-07-17 07:25:07'),
(8, '17F005001B', 50000, 0, 10000000000, 1, '2018-06-17 00:00:00', '2018-07-17 00:00:00', 1, '17F005001B', '2018-07-17 07:32:20'),
(9, '17F005001B', 50000, 0, 20, 2, '2018-06-17 00:00:00', '2018-07-17 00:00:00', 1, '9999999999', '2018-07-17 07:36:39'),
(10, '17F005001B', 60000, 0, 10000, 1, '2018-06-17 00:00:00', '2018-07-17 00:00:00', 1, '9999999999', '2018-07-17 08:44:54'),
(11, '17F005001B', 70000, 2, 100, 1, '2018-06-17 00:00:00', '2018-08-08 00:00:00', 0, '9999999999', '2018-08-08 10:34:53'),
(12, '18A100001N', 70000, 2, 3, 2, '2019-01-01 00:00:00', '2018-11-30 00:00:00', 0, '17F005001B', '2018-11-17 11:27:04'),
(13, '18A100001N', 70000, 3, 5000, 1, '2019-01-01 00:00:00', '2019-02-01 00:00:00', 0, '17F005001B', '2018-11-17 11:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `hr_increment_type`
--

CREATE TABLE `hr_increment_type` (
  `id` int(11) NOT NULL,
  `increment_type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_increment_type`
--

INSERT INTO `hr_increment_type` (`id`, `increment_type`) VALUES
(2, 'Yearly Incriment'),
(3, 'Special Incriment'),
(4, 'Special Incriment');

-- --------------------------------------------------------

--
-- Table structure for table `hr_interview`
--

CREATE TABLE `hr_interview` (
  `hr_interview_id` int(11) NOT NULL,
  `hr_interview_date` date NOT NULL,
  `hr_interview_name` varchar(255) NOT NULL,
  `hr_interview_contact` varchar(30) NOT NULL,
  `hr_interview_exp_salary` int(11) NOT NULL,
  `hr_interview_board_member` text NOT NULL,
  `hr_interview_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_job_posting`
--

CREATE TABLE `hr_job_posting` (
  `job_po_id` int(11) NOT NULL,
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
  `job_po_benefits` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_job_posting`
--

INSERT INTO `hr_job_posting` (`job_po_id`, `job_po_title`, `job_po_vacancy`, `job_po_description`, `job_po_responsibility`, `job_po_nature`, `job_po_edu_req`, `job_po_experience`, `job_po_age_limit`, `job_po_requirment`, `job_po_location`, `job_po_salary`, `job_po_benefits`) VALUES
(1, 'SDFDSGFD', 1, '<p>FSDFGFD../\';\\\\</p>', '<p>FJHGHJ;\'\\\'\\</p>', 1, '<p>;L\\\'\';\\IOP</p>', '<p>;L\\\'\';\\IOP</p>', '18-25', '<p>;L\\\'\';\\IOP</p>', 'DHAKA', '10000', '<p>;L\\\'\';\\IOP</p>');

-- --------------------------------------------------------

--
-- Table structure for table `hr_leave`
--

CREATE TABLE `hr_leave` (
  `id` int(11) NOT NULL,
  `leave_ass_id` varchar(10) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `leave_applied_date` date NOT NULL,
  `leave_status` int(1) DEFAULT '0',
  `leave_supporting_file` varchar(128) DEFAULT NULL,
  `leave_comment` varchar(128) DEFAULT NULL,
  `leave_updated_at` datetime DEFAULT NULL,
  `leave_updated_by` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_leave`
--

INSERT INTO `hr_leave` (`id`, `leave_ass_id`, `leave_type`, `leave_from`, `leave_to`, `leave_applied_date`, `leave_status`, `leave_supporting_file`, `leave_comment`, `leave_updated_at`, `leave_updated_by`) VALUES
(1, '18A100002N', 'Sick', '2018-11-18', '2018-11-19', '2018-11-16', 1, '/assets/files/leaves/5bef9ef58c0f2.png', 'khghgjgfjh', '2018-11-17 10:54:13', '17F005001B'),
(2, '17F005001B', 'Sick', '2018-11-18', '2018-11-18', '2018-11-17', 0, '/assets/files/leaves/5befe16ac4572.png', NULL, '2018-11-17 15:37:46', 'XTQGMOKVJI');

-- --------------------------------------------------------

--
-- Table structure for table `hr_letter`
--

CREATE TABLE `hr_letter` (
  `hr_letter_id` int(11) NOT NULL,
  `hr_letter_as_id` varchar(10) NOT NULL,
  `hr_letter_full` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_letter`
--

INSERT INTO `hr_letter` (`hr_letter_id`, `hr_letter_as_id`, `hr_letter_full`) VALUES
(1, '18D002011H', '<p>à¦¤à¦¾à¦°à¦¿à¦–à¦ƒ&nbsp;</p>\r\n<p>à¦œà¦¨à¦¾à¦¬/à¦œà¦¨à¦¾à¦¬à¦¾à¦ƒ</p>\r\n<p>à¦ªà¦¿à¦¤à¦¾/à¦¸à§à¦¬à¦¾à¦®à§€à¦° à¦¨à¦¾à¦®à¦ƒ</p>\r\n<p>à¦®à¦¾à¦¤à¦¾à¦° à¦¨à¦¾à¦®à¦ƒ</p>\r\n<p>&nbsp;</p>\r\n<p>à¦—à§à¦°à¦¾à¦®à¦ƒ&nbsp; à¦¡à¦¾à¦•à¦˜à¦°à¦ƒ</p>\r\n<p>à¦¥à¦¾à¦¨à¦¾à¦ƒ à¦œà§‡à¦²à¦¾à¦ƒ</p>\r\n<p>\\r\\n</p>\r\n<p><span style=\"text-decoration: underline;\"><strong>à¦¬à¦¿à¦·à§Ÿà¦ƒ- à¦¨à¦¿à§Ÿà§‹à¦—à¦ªà¦¤à§à¦°</strong></span></p>\r\n<p>\\r\\n</p>\r\n<p>à¦•à¦¤à§ƒà¦ªà¦•à§à¦· à¦…à¦¤à§à¦¯à¦¨à§à¦¤ à¦†à¦¨à¦¨à§à¦¦à§‡à¦° à¦¸à¦¹à¦¿à¦¤ à¦†à¦ªà¦¨à¦¾à¦•à§‡......................................................</p>\r\n<p>\\r\\n</p>\r\n<p>à§§à¥¤ à¦†à¦ªà¦¨à¦¿ à¦šà¦¾à¦•à§à¦°à§€à¦¤à§‡ à¦ªà§à¦°à¦¥à¦®............</p>\r\n<p>\\r\\n</p>\r\n<p>&nbsp;</p>\r\n<p>\\r\\n</p>\r\n<p>à§¨à¥¤ à¦¸à¦¾à¦§à¦¾à¦°à¦¨ à¦•à¦°à§à¦®à¦˜à¦¨à§à¦Ÿà¦¾......à¥¤à¥¤</p>\r\n<p>\\r\\n</p>\r\n<p>à§©à¥¤ à¦¸à¦¾à¦§à¦¾à¦°à¦£ à¦›à§à¦Ÿà¦¿à¦ƒ</p>\r\n<p>\\r\\n</p>\r\n<ul>\\r\\n\r\n<li>à¦¶à§à¦•à§à¦°à¦¬à¦¾à¦° à¦¸à¦¾à¦ªà§à¦¤à¦¾à¦¹à¦¿à¦• à¦›à§à¦Ÿà¦¿</li>\r\n\\r\\n\r\n<li>à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯ à¦›à§à¦Ÿà¦¿\\r\\n\r\n<ul>\\r\\n\r\n<li>à¦‰à§Žà¦¸à¦¬</li>\r\n\\r\\n\r\n<li>à¦¨à§ˆà¦®à¦¿à¦¤à§à¦¤à¦¿à¦•</li>\r\n\\r\\n</ul>\r\n\\r\\n</li>\r\n\\r\\n</ul>\r\n<p>\\r\\n</p>\r\n<p>à§ªà¥¤ à¦ªà¦°à¦¿à¦šà§Ÿ......</p>\r\n<p>\\r\\n</p>\r\n<p>&nbsp;</p>\r\n<p>\\r\\n</p>\r\n<p>à¦§à¦¨à§à¦¯à¦¬à¦¾à¦¦&nbsp;</p>\r\n<p>\\r\\n</p>\r\n<p style=\"text-align: right;\">&nbsp;à¦•à¦¤à§ƒà¦ªà¦•à§à¦·&nbsp; &nbsp; &nbsp; &nbsp;</p>'),
(2, '17G100010N', '<center><strong>à¦¬à§‡à¦•à§à¦¸à¦¿à¦®à¦•à§‹ à¦«à§à¦¯à¦¾à¦¶à¦¨ à¦²à¦¿à¦®à¦¿à¦Ÿà§‡à¦¡ </strong></center><center><u> à§§à§­ à¦§à¦¾à¦¨à¦®à¦¨à§à¦¡à¦¿ à¦†à¦° / à¦, à¦°à§‹à¦¡ à¦¨à¦‚ à§¨, à¦¢à¦¾à¦•à¦¾-à§§à§¨à§¦à§« </u></center>\r\n<p>à¦¤à¦¾à¦°à¦¿à¦–à¦ƒ&nbsp; à§¨à§¦à§§à§®-à§¦à§­-à§§à§­ à§§à§¨:à§ªà§¯:à§¦à§¯</p>\r\n<p>à¦œà¦¨à¦¾à¦¬/à¦œà¦¨à¦¾à¦¬à¦¾à¦ƒ à¦œà¦¾à¦¨à§à¦¨à¦¾à¦¤ à¦†à¦°à¦¾</p>\r\n<p>à¦ªà¦¿à¦¤à¦¾/à¦¸à§à¦¬à¦¾à¦®à§€à¦° à¦¨à¦¾à¦®à¦ƒ à¦«à¦œà¦²à§à¦² à¦•à¦°à¦¿à¦®/à¦œà¦²à¦¿à¦² à¦‰à¦¦à§à¦¦à¦¿à¦¨</p>\r\n<p>à¦®à¦¾à¦¤à¦¾à¦° à¦¨à¦¾à¦®à¦ƒ à¦‰à¦®à§à¦®à§‡ à¦¹à¦¾à¦¬à¦¿à¦¬à¦¾</p>\r\n<p>à¦—à§à¦°à¦¾à¦®à¦ƒà¦¨à¦¾à¦œà¦¿à¦°à¦¾-à¦¬à¦¾à¦ªà¦¾à¦°à§€ à¦ªà¦¾à¦°à¦¾&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; à¦¡à¦¾à¦•à¦˜à¦°à¦ƒ à¦•à§à¦¡à¦¼à¦¿à¦—à§à¦°à¦¾à¦®</p>\r\n<p>à¦¥à¦¾à¦¨à¦¾à¦ƒ à¦•à§à§œà¦¿à¦—à§à¦°à¦¾à¦® à¦¸à¦¦à¦° &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; à¦œà§‡à¦²à¦¾à¦ƒ à¦•à§à§œà¦¿à¦—à§à¦°à¦¾à¦®</p>\r\n<p><span style=\"text-decoration: underline;\"><strong>à¦¬à¦¿à¦·à§Ÿà¦ƒ- à¦¨à¦¿à§Ÿà§‹à¦—à¦ªà¦¤à§à¦°</strong></span></p>\r\n<p>à¦•à¦¤à§ƒà¦ªà¦•à§à¦· à¦…à¦¤à§à¦¯à¦¨à§à¦¤ à¦†à¦¨à¦¨à§à¦¦à§‡à¦° à¦¸à¦¹à¦¿à¦¤ à¦†à¦ªà¦¨à¦¾à¦•à§‡ à¦¨à¦¿à¦®à§à¦¨à¦²à¦¿à¦–à¦¿à¦¤ à¦¶à¦°à§à¦¤à¦¸à¦¾à¦ªà§‡à¦•à§à¦·à§‡ à¦…à¦¤à§à¦° à¦•à¦¾à¦°à¦–à¦¾à¦¨à¦¾à¦° à¦‰à§Žà¦ªà¦¾à¦¦à¦¨ à¦¬à¦¿à¦­à¦¾à¦—à§‡ à¦¸à¦¿à¦¨à¦¿à§Ÿà¦° à¦…à¦ªà¦¾à¦°à§‡à¦Ÿà¦° à¦ªà¦¦à§‡ à¦ªà§à¦°à¦¤à¦¿ à¦®à¦¾à¦¸à§‡ à¦¸à¦°à§à¦¬à¦¸à¦¾à¦•à§à¦²à§à¦¯à§‡ à¦®à§‹à¦Ÿ à¦Ÿà¦¾à¦•à¦¾ à¦¬à§‡à¦¤à¦¨à§‡ à§¨à§¦à¦¤à¦® à¦—à§à¦°à§‡à¦¡à§‡ à¦¨à¦¿à§Ÿà§‹à¦— à¦¦à§‡à¦“à§Ÿà¦¾à¦° à¦¸à¦¿à¦¦à§à¦§à¦¾à¦¨à§à¦¤ à¦•à¦°à¦¿à§Ÿà¦¾à¦›à§‡à¦¨, à¦¯à¦¾à¦¹à¦¾ à§¨à§¦à§§à§­-à§¦à§­-à§§à§­ à¦¤à¦¾à¦°à¦¿à¦– à¦¹à¦‡à¦¤à§‡ à¦•à¦¾à¦°à§à¦¯à¦•à¦°à§€à¥¤</p>\r\n<p>à§§à¥¤ à¦†à¦ªà¦¨à¦¿ à¦šà¦¾à¦•à§à¦°à§€à¦¤à§‡ à¦ªà§à¦°à¦¥à¦® à§¦à§© (à¦¤à¦¿à¦¨) à¦®à¦¾à¦¸ à¦ªà§à¦°à¦¬à§‡à¦¶à¦¨à¦¾à¦°à§€ à¦…à¦¬à¦¸à§à¦¥à¦¾à§Ÿ à¦¥à¦¾à¦•à¦¿à¦¬à§‡à¦¨ à¦à¦¬à¦‚ à¦‰à¦•à§à¦¤ à¦¸à¦®à§Ÿà§‡à¦° à¦®à¦§à§à¦¯à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦•à¦°à§à¦®à¦¦à¦•à§à¦·à¦¤à¦¾ à¦¸à¦¨à§à¦¤à§‹à¦·à¦œà¦¨à¦• à¦¨à¦¾ à¦¹à¦‡à¦²à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦ªà§à¦°à¦¬à§‡à¦¶à¦¨à¦•à¦¾à¦² à¦†à¦°à¦“ à¦¤à¦¿à¦¨ à¦®à¦¾à¦¸ à¦¬à¦°à§à¦§à¦¿à¦¤ à¦•à¦°à¦¾ à¦¯à§‡à¦¤à§‡ à¦ªà¦¾à¦°à§‡à¥¤ à¦ªà§à¦°à¦¬à§‡à¦¶à¦¨à¦•à¦¾à¦² à¦¤à¦¿à¦¨ à¦®à¦¾à¦¸ à¦…à¦¤à¦¿à¦¬à¦¾à¦¹à¦¿à¦¤ à¦¹à¦“à§Ÿà¦¾à¦° à¦ªà¦° à¦†à¦ªà¦¨à¦¿ à¦¸à¦°à¦¾à¦¸à¦°à¦¿ à¦¸à§à¦¥à¦¾à§Ÿà§€ à¦¬à¦²à§‡ à¦—à¦£à§à¦¯ à¦¹à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§¨à¥¤ à¦¸à¦¾à¦§à¦¾à¦°à¦¨ à¦•à¦°à§à¦®à¦˜à¦¨à§à¦Ÿà¦¾ à§¦à§® (à¦†à¦Ÿ) à¦˜à¦¨à§à¦Ÿà¦¾ à¦à¦¬à¦‚ à¦®à¦§à§à¦¯à¦¾à¦¹à§à¦¨ à¦¬à¦¿à¦°à¦¤à¦¿ à§¬à§¦ à¦®à¦¿à¦¨à¦¿à¦Ÿà¥¤</p>\r\n<p>à§©à¥¤ à¦…à¦¤à¦¿à¦°à¦¿à¦•à§à¦¤ à¦¸à¦®à§Ÿ (à¦“.à¦Ÿà¦¿) à¦‡à¦¹à¦¾ à¦®à§‚à¦² à¦¬à§‡à¦¤à¦¨à§‡à¦° à¦¦à§à¦¬à¦¿à¦—à§à¦¨à¥¤ ( à¦®à§‚à¦² à¦¬à§‡à¦¤à¦¨/à§¨à§¦à§®*à§¨*à¦®à§‹à¦Ÿ à¦…à¦¤à¦¿à¦°à¦¿à¦•à§à¦¤ à¦˜à¦¨à§à¦Ÿà¦¾)à¥¤</p>\r\n<p>à§ªà¥¤ à¦¸à¦¾à¦§à¦¾à¦°à¦£ à¦›à§à¦Ÿà¦¿à¦ƒ-</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à§§à¥¤ à¦¶à§à¦•à§à¦°à¦¬à¦¾à¦° à¦¸à¦¾à¦ªà§à¦¤à¦¾à¦¹à¦¿à¦• à¦›à§à¦Ÿà¦¿à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à§¨à¥¤ à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯ à¦›à§à¦Ÿà¦¿, (à¦¯à¦¾à¦¹à¦¾ à¦ªà§‚à¦°à§à¦£ à¦¬à§‡à¦¤à¦¨à§‡ à¦­à§‹à¦— à¦•à¦°à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤&nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦•) à¦‰à§Žà¦¸à¦¬ à¦›à§à¦Ÿà¦¿à¦ƒ- à§§à§§ à¦¦à¦¿à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦–) à¦¨à§ˆà¦®à¦¿à¦¤à§à¦¤à¦¿à¦• à¦›à§à¦Ÿà¦¿à¦ƒ- à§§à§¦ à¦¦à¦¿à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦—) à¦¬à¦¾à¦°à§à¦·à¦¿à¦• à¦›à§à¦Ÿà¦¿à¦ƒ- à§¦à§§ (à¦à¦•) à¦¬à§Žà¦¸à¦° à¦…à¦¤à¦¿à¦¬à¦¾à¦¹à¦¿à¦¤ à¦¹à¦“à§Ÿà¦¾à¦° à¦ªà¦° à¦†à¦ªà¦¨à¦¿ à¦ªà§à¦°à¦¤à¦¿ à§§à§® à¦•à¦°à§à¦®à¦¦à¦¿à¦¬à¦¸à§‡à¦° à¦œà¦¨à§à¦¯ à¦à¦•à¦¦à¦¿à¦¨ à¦•à¦°à§‡ à¦¬à¦¾à¦°à§à¦·à¦¿à¦• à¦›à§à¦Ÿà§€ à¦­à§‹à¦— à¦•à¦°à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦˜) à¦…à¦¸à§à¦¸à§à¦¥à¦¤à¦¾ à¦œà¦¨à¦¿à¦¤ à¦›à§à¦Ÿà¦¿à¦ƒ- à¦…à¦¸à§à¦¸à§à¦¥à¦¤à¦¾à¦œà¦¨à¦¿à¦¤ à¦›à§à¦Ÿà¦¿ à¦¬à§Žà¦¸à¦°à§‡ à¦®à§‹à¦Ÿ à§§à§ª à¦¦à¦¿à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦™) à¦®à¦¾à¦¤à§ƒà¦¤à§à¦¬ à¦•à¦¾à¦²à§€à¦¨ à¦›à§à¦Ÿà¦¿à¦ƒ- à¦•à§‹à¦¨ à¦®à¦¹à¦¿à¦²à¦¾ à¦¶à§à¦°à¦®à¦¿à¦• à¦¯à¦¦à¦¿ à¦…à¦¤à§à¦° à¦ªà§à¦°à¦¤à¦¿à¦·à§à¦ à¦¾à¦¨à§‡ à¦…à¦•à¦¾à¦§à¦¿à¦•à§à¦°à¦®à§‡ à§¦à§¬ (à¦›à§Ÿ) à¦®à¦¾à¦¸ à¦šà¦¾à¦•à§à¦°à§€ à¦•à¦°à§‡à¦¨ à¦¤à¦¾à¦¹à¦²à§‡ à¦¤à¦¿à¦¨à¦¿ à¦‰à¦•à§à¦¤ à¦›à§à¦Ÿà¦¿ à¦­à§‹à¦— à¦•à¦°à¦¿à¦¤à§‡ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§ªà¥¤ à¦ªà¦°à¦¿à¦šà§Ÿ à¦ªà¦¤à§à¦°à¦ƒ- à¦†à¦ªà¦¨à¦¾à¦•à§‡ à¦ªà¦°à¦¿à¦šà§Ÿà¦ªà¦¤à§à¦° à¦¦à§‡à¦“à§Ÿà¦¾ à¦¹à¦‡à¦¬à§‡à¥¤ à¦†à¦ªà¦¨à¦¿ à¦•à¦¾à¦°à¦–à¦¾à¦¨à¦¾à§Ÿ à¦ªà§à¦°à¦¬à§‡à¦¶à§‡à¦° à¦ªà§‚à¦°à§à¦¬à§‡ à¦à¦¬à¦‚ à¦¬à§‡à¦° à¦¹à¦“à§Ÿà¦¾à¦° à¦¸à¦®à§Ÿ à¦ªà¦°à¦¿à¦šà§Ÿ à¦ªà¦¤à§‡à¦° à¦‡à¦²à§‡à¦•à§à¦Ÿà§à¦°à¦¨à¦¿à¦• à¦¹à¦¾à¦œà¦¿à¦°à¦¾ à¦®à§‡à¦¶à¦¿à¦¨à§‡à¦° à¦¦à§à¦¬à¦¾à¦°à¦¾ à¦ªà¦¾à¦žà§à¦š à¦•à¦°à¦¿à¦¬à§‡à¦¨ à¦à¦¬à¦‚ à¦‰à¦•à§à¦¤ à¦ªà¦¾à¦žà§à¦š à¦®à§‡à¦¶à¦¿à¦¨ à¦¥à§‡à¦•à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦®à¦¾à¦¸à¦¿à¦• à¦¹à¦¾à¦œà¦¿à¦°à¦¾ à¦à¦¬à¦‚ à¦…à¦¤à¦¿à¦°à¦¿à¦•à§à¦¤ à¦¸à¦®à§Ÿ à¦¬à§‡à¦° à¦•à¦°à¦¾ à¦¹à¦‡à¦¬à§‡à¥¤</p>\r\n<p>à§¬à¥¤ à¦ªà§à¦°à¦¬à§‡à¦¶à¦¨à¦¾à¦°à§€ à¦¥à¦¾à¦•à¦¾à¦•à¦¾à¦²à§€à¦¨ à¦¸à¦®à§Ÿà§‡ à¦•à§‹à¦®à§à¦ªà¦¾à¦¨à§€ à¦¯à§‡ à¦•à§‹à¦¨ à¦¸à¦®à§Ÿ à¦•à§‹à¦¨ à¦ªà§à¦°à¦•à¦¾à¦° à¦•à¦¾à¦°à¦£ à¦¦à¦°à§à¦¶à¦¾à¦¨à§‹ à¦¬à§à¦¯à¦¤à§€à¦°à§‡à¦•à§‡ à¦¬à¦¿à¦¨à¦¾ à¦¨à§‹à¦Ÿà¦¿à¦¶à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦šà¦¾à¦•à¦°à§€à¦° à¦…à¦¬à¦¸à¦¾à¦¨ à¦•à¦°à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨, à¦…à¦¥à¦¬à¦¾ à¦†à¦ªà¦¨à¦¿à¦“ à¦šà¦¾à¦•à¦°à¦¿ à¦¥à§‡à¦•à§‡ à¦¸à§à¦¬à§‡à¦šà§à¦›à¦¾à§Ÿ à¦‡à¦¸à§à¦¤à¦«à¦¾ à¦¦à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§­à¥¤&nbsp;à¦šà¦¾à¦•à§à¦°à§€ à¦¸à§à¦¥à¦¾à§Ÿà§€ à¦¹à¦‡à¦¬à¦¾à¦° à¦ªà¦° à¦†à¦ªà¦¨à¦¿ à¦¸à§à¦¬à§‡à¦šà§à¦›à¦¾à§Ÿ à¦šà¦¾à¦•à¦°à§€ à¦¹à¦‡à¦¤à§‡ à¦…à¦¬à§à¦¯à¦¹à¦¤à¦¿ à¦¨à¦¿à¦¤à§‡ à¦šà¦¾à¦‡à¦²à§‡ à¦•à¦¤à§ƒà¦ªà¦•à§à¦· à¦•à§‡ à§¬à§¦ (à¦·à¦¾à¦Ÿ) à¦¦à¦¿à¦¨ à¦ªà§‚à¦°à§à¦¬à§‡ à¦²à¦¿à¦–à¦¿à¦¤ à¦¨à§‹à¦Ÿà¦¿à¦¶à§‡à¦° à¦®à¦¾à¦§à§à¦¯à¦®à§‡ à¦œà¦¾à¦¨à¦¾à¦‡à¦¤à§‡ à¦¹à¦¬à§‡à¥¤</p>\r\n<p>à§®à¥¤ à¦šà¦¾à¦•à§à¦°à§€ à¦¸à§à¦¥à¦¾à§Ÿà§€ à¦¹à¦‡à¦¬à¦¾à¦° à¦ªà¦° à¦•à¦¤à§ƒà¦ªà¦•à§à¦· à¦†à¦ªà¦¨à¦¾à¦° à¦šà¦¾à¦•à¦°à§€à¦° à¦…à¦¬à¦¸à¦¾à¦¨ à¦•à¦°à¦¿à¦¤à§‡ à¦šà¦¾à¦¹à¦¿à¦²à§‡ à§§à§¨à§¦ (à¦à¦•à¦¶à¦¤ à¦¬à¦¿à¦¶) à¦¦à¦¿à¦¨à§‡à¦° à¦²à¦¿à¦–à¦¿à¦¤ à¦¨à§‹à¦Ÿà¦¿à¦¶ à¦…à¦¥à¦¬à¦¾&nbsp;à§§à§¨à§¦ (à¦à¦•à¦¶à¦¤ à¦¬à¦¿à¦¶) à¦¦à¦¿à¦¨à§‡à¦° à¦¬à§‡à¦¤à¦¨ à¦ªà§à¦°à¦¦à¦¾à¦¨ à¦•à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§¯à¥¤ à¦†à¦ªà¦¨à¦¾à¦° à¦šà¦¾à¦•à¦°à§€ à¦•à§‹à¦®à§à¦ªà¦¾à¦¨à§€ à¦•à¦¤à§ƒà¦• à¦œà¦¾à¦°à¦¿à¦•à§ƒà¦¤ à¦¬à¦¿à¦§à¦¾à¦¨ à¦“ à¦¬à¦¾à¦‚à¦²à¦¾à¦¦à§‡à¦¶à§‡à¦° à¦ªà§à¦°à¦šà¦²à¦¿à¦¤ à¦¶à§à¦°à¦® à¦†à¦‡à¦¨ à¦¦à§à¦¬à¦¾à¦°à¦¾ à¦ªà¦°à¦¿à¦šà¦¾à¦²à¦¿à¦¤ à¦¹à¦‡à¦¬à§‡à¥¤</p>\r\n<p>à§§à§¦à¥¤ à¦•à¦¤à§ƒà¦ªà¦•à§à¦· à¦†à¦ªà¦¨à¦¾à¦•à§‡ à¦ªà§à¦°à§Ÿà§‹à¦œà¦¨ à¦¬à§‹à¦§à§‡ à¦à¦‡ à¦ªà§à¦°à¦¤à¦¿à¦·à§à¦ à¦¾à¦¬à§‡à¦° à¦¯à§‡ à¦•à§‹à¦¨ à¦¬à¦¿à¦­à¦¾à¦—à§‡ à¦…à¦¥à¦¬à¦¾ à¦¬à¦¾à¦‚à¦²à¦¾à¦¦à§‡à¦¶à§‡ à¦…à¦¬à¦¸à§à¦¥à¦¿à¦¤ à¦¯à§‡ à¦•à§‹à¦¨ à¦•à¦¾à¦°à¦–à¦¾à¦¨à¦¾à§Ÿ/à¦…à¦«à¦¿à¦¸à§‡ à¦¬à¦¦à¦²à§€ à¦•à¦°à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§§à§§à¥¤ à¦•à§‹à¦®à§à¦ªà¦¾à¦¨à§€à¦° à¦¯à¦¾à¦¬à¦¤à§€à§Ÿ à¦¨à¦¿à§Ÿà¦®à¦•à¦¾à¦¨à§à¦¨ à¦ªà¦°à¦¿à¦¬à¦°à§à¦¤à¦¨à¦¯à§‹à¦—à§à¦¯ (à¦¯à¦¾à¦¹à¦¾ à¦¦à§‡à¦¶à§‡à¦° à¦ªà§à¦°à¦šà¦²à¦¿à¦¤ à¦†à¦‡à¦¨à§‡à¦° à¦ªà¦°à¦¿à¦ªà¦¨à§à¦¥à¦¿ à¦¨à¦¹à§‡) à¦à¦¬à¦‚ à¦†à¦ªà¦¨à¦¿ à¦ªà¦°à¦¿à¦¬à¦°à§à¦¤à¦¿à¦¤ à¦¨à¦¿à§Ÿà¦® à¦•à¦¾à¦¨à§à¦¨ à¦¸à¦°à§à¦¬à¦¦à¦¾ à¦®à¦¾à¦¨à¦¿à§Ÿà¦¾ à¦šà¦²à¦¿à¦¤à§‡&nbsp; &nbsp; &nbsp; &nbsp;à¦¬à¦¾à¦§à§à¦¯ à¦¥à¦¾à¦•à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à¦†à¦ªà¦¨à¦¾à¦° à¦†à¦‡.à¦¡à¦¿. à¦¨à¦‚- 17G100010N</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à¦†à¦ªà¦¨à¦¾à¦° à¦œà¦¾à¦¤à§€à§Ÿ à¦ªà¦°à¦¿à¦šà§Ÿà¦ªà¦¤à§à¦° à¦¨à¦‚- 123456789123456</p>\r\n<p>à¦§à¦¨à§à¦¯à¦¬à¦¾à¦¦à¦¾à¦¨à§à¦¤à§‡</p>\r\n<p>&nbsp; &nbsp;à¦¸à¦‚à¦¶à§à¦²à¦¿à¦·à§à¦Ÿ à¦¬à§à¦¯à¦¬à¦¸à§à¦¥à¦¾à¦ªà¦•</p>\r\n<p style=\"text-align: right;\">à¦•à¦¾à¦°à¦–à¦¾à¦¨à¦¾ à¦•à¦¤à§ƒà¦ªà¦•à§à¦·&nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n<p>&nbsp; &nbsp;à¦…à¦¨à§à¦²à¦¿à¦ªà¦¿à¦ƒ</p>\r\n<p>&nbsp; &nbsp;à§§à¥¤ à¦¹à¦¿à¦¸à¦¾à¦¬ à¦¬à¦¿à¦­à¦¾à¦—à¥¤</p>\r\n<p>&nbsp; &nbsp;à§¨à¥¤ à¦¬à§à¦¯à¦•à§à¦¤à¦¿à¦—à¦¤ à¦¨à¦¥à¦¿à¥¤</p>\r\n<p>à¦†à¦®à¦¿ à¦…à¦¤à§à¦° à¦¨à¦¿à§Ÿà§‹à¦—à¦ªà¦¤à§à¦° à¦ªà¦¾à¦  à¦•à¦°à¦¿à§Ÿà¦¾ à¦à¦¬à¦‚ à¦‡à¦¹à¦¾à¦¤à§‡ à¦¬à¦°à§à¦£à¦¿à¦¤ à¦¶à¦°à§à¦¤à¦¾à¦¦à¦¿ à¦¸à¦®à§à¦ªà§‚à¦°à§à¦£à¦°à§à¦ªà§‡ à¦…à¦¬à¦—à¦¤ à¦¹à¦‡à§Ÿà¦¾ à¦à¦‡ à¦¨à¦¿à§Ÿà§‹à¦—à¦ªà¦¤à§à¦° à¦—à§à¦°à¦¹à¦£ à¦•à¦°à¦¿à§Ÿà¦¾ à¦¸à§à¦¬à¦¾à¦•à§à¦·à¦° à¦•à¦°à¦¿à¦²à¦¾à¦®à¥¤</p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: right;\">&nbsp;à¦¶à§à¦°à¦®à¦¿à¦•à§‡à¦° à¦¸à§à¦¬à¦•à§à¦·à¦°&nbsp; &nbsp; &nbsp; &nbsp;</p>'),
(3, '18A100009N', '<center><strong>à¦¬à§‡à¦•à§à¦¸à¦¿à¦®à¦•à§‹ à¦«à§à¦¯à¦¾à¦¶à¦¨ à¦²à¦¿à¦®à¦¿à¦Ÿà§‡à¦¡ </strong></center><center><u> à§§à§­ à¦§à¦¾à¦¨à¦®à¦¨à§à¦¡à¦¿ à¦†à¦° / à¦, à¦°à§‹à¦¡ à¦¨à¦‚ à§¨, à¦¢à¦¾à¦•à¦¾-à§§à§¨à§¦à§« </u></center>\r\n<p>à¦¤à¦¾à¦°à¦¿à¦–à¦ƒ&nbsp; à§¨à§¦à§§à§®-à§¦à§­-à§§à§­ à§§à§¨:à§«à§§:à§¦à§¯</p>\r\n<p>à¦œà¦¨à¦¾à¦¬/à¦œà¦¨à¦¾à¦¬à¦¾à¦ƒ</p>\r\n<p>à¦ªà¦¿à¦¤à¦¾/à¦¸à§à¦¬à¦¾à¦®à§€à¦° à¦¨à¦¾à¦®à¦ƒ /</p>\r\n<p>à¦®à¦¾à¦¤à¦¾à¦° à¦¨à¦¾à¦®à¦ƒ</p>\r\n<p>à¦—à§à¦°à¦¾à¦®à¦ƒ&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; à¦¡à¦¾à¦•à¦˜à¦°à¦ƒ</p>\r\n<p>à¦¥à¦¾à¦¨à¦¾à¦ƒ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; à¦œà§‡à¦²à¦¾à¦ƒ</p>\r\n<p><span style=\"text-decoration: underline;\"><strong>à¦¬à¦¿à¦·à§Ÿà¦ƒ- à¦¨à¦¿à§Ÿà§‹à¦—à¦ªà¦¤à§à¦°</strong></span></p>\r\n<p>à¦•à¦¤à§ƒà¦ªà¦•à§à¦· à¦…à¦¤à§à¦¯à¦¨à§à¦¤ à¦†à¦¨à¦¨à§à¦¦à§‡à¦° à¦¸à¦¹à¦¿à¦¤ à¦†à¦ªà¦¨à¦¾à¦•à§‡ à¦¨à¦¿à¦®à§à¦¨à¦²à¦¿à¦–à¦¿à¦¤ à¦¶à¦°à§à¦¤à¦¸à¦¾à¦ªà§‡à¦•à§à¦·à§‡ à¦…à¦¤à§à¦° à¦•à¦¾à¦°à¦–à¦¾à¦¨à¦¾à¦° à¦‰à§Žà¦ªà¦¾à¦¦à¦¨ à¦¬à¦¿à¦­à¦¾à¦—à§‡ à¦•à¦¾à¦Ÿà¦¾à¦° à¦®à§à¦¯à¦¾à¦¨ à¦ªà¦¦à§‡ à¦ªà§à¦°à¦¤à¦¿ à¦®à¦¾à¦¸à§‡ à¦¸à¦°à§à¦¬à¦¸à¦¾à¦•à§à¦²à§à¦¯à§‡ à¦®à§‹à¦Ÿ à§§à§¦à§¦à§¦à§¦ à¦Ÿà¦¾à¦•à¦¾ à¦¬à§‡à¦¤à¦¨à§‡ à§¨à§¦à¦¤à¦® à¦—à§à¦°à§‡à¦¡à§‡ à¦¨à¦¿à§Ÿà§‹à¦— à¦¦à§‡à¦“à§Ÿà¦¾à¦° à¦¸à¦¿à¦¦à§à¦§à¦¾à¦¨à§à¦¤ à¦•à¦°à¦¿à§Ÿà¦¾à¦›à§‡à¦¨, à¦¯à¦¾à¦¹à¦¾ à§¨à§¦à§§à§®-à§¦à§§-à§§à§­ à¦¤à¦¾à¦°à¦¿à¦– à¦¹à¦‡à¦¤à§‡ à¦•à¦¾à¦°à§à¦¯à¦•à¦°à§€à¥¤</p>\r\n<p>à§§à¥¤ à¦†à¦ªà¦¨à¦¿ à¦šà¦¾à¦•à§à¦°à§€à¦¤à§‡ à¦ªà§à¦°à¦¥à¦® à§¦à§© (à¦¤à¦¿à¦¨) à¦®à¦¾à¦¸ à¦ªà§à¦°à¦¬à§‡à¦¶à¦¨à¦¾à¦°à§€ à¦…à¦¬à¦¸à§à¦¥à¦¾à§Ÿ à¦¥à¦¾à¦•à¦¿à¦¬à§‡à¦¨ à¦à¦¬à¦‚ à¦‰à¦•à§à¦¤ à¦¸à¦®à§Ÿà§‡à¦° à¦®à¦§à§à¦¯à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦•à¦°à§à¦®à¦¦à¦•à§à¦·à¦¤à¦¾ à¦¸à¦¨à§à¦¤à§‹à¦·à¦œà¦¨à¦• à¦¨à¦¾ à¦¹à¦‡à¦²à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦ªà§à¦°à¦¬à§‡à¦¶à¦¨à¦•à¦¾à¦² à¦†à¦°à¦“ à¦¤à¦¿à¦¨ à¦®à¦¾à¦¸ à¦¬à¦°à§à¦§à¦¿à¦¤ à¦•à¦°à¦¾ à¦¯à§‡à¦¤à§‡ à¦ªà¦¾à¦°à§‡à¥¤ à¦ªà§à¦°à¦¬à§‡à¦¶à¦¨à¦•à¦¾à¦² à¦¤à¦¿à¦¨ à¦®à¦¾à¦¸ à¦…à¦¤à¦¿à¦¬à¦¾à¦¹à¦¿à¦¤ à¦¹à¦“à§Ÿà¦¾à¦° à¦ªà¦° à¦†à¦ªà¦¨à¦¿ à¦¸à¦°à¦¾à¦¸à¦°à¦¿ à¦¸à§à¦¥à¦¾à§Ÿà§€ à¦¬à¦²à§‡ à¦—à¦£à§à¦¯ à¦¹à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§¨à¥¤ à¦¸à¦¾à¦§à¦¾à¦°à¦¨ à¦•à¦°à§à¦®à¦˜à¦¨à§à¦Ÿà¦¾ à§¦à§® (à¦†à¦Ÿ) à¦˜à¦¨à§à¦Ÿà¦¾ à¦à¦¬à¦‚ à¦®à¦§à§à¦¯à¦¾à¦¹à§à¦¨ à¦¬à¦¿à¦°à¦¤à¦¿ à§¬à§¦ à¦®à¦¿à¦¨à¦¿à¦Ÿà¥¤</p>\r\n<p>à§©à¥¤ à¦…à¦¤à¦¿à¦°à¦¿à¦•à§à¦¤ à¦¸à¦®à§Ÿ (à¦“.à¦Ÿà¦¿) à¦‡à¦¹à¦¾ à¦®à§‚à¦² à¦¬à§‡à¦¤à¦¨à§‡à¦° à¦¦à§à¦¬à¦¿à¦—à§à¦¨à¥¤ ( à¦®à§‚à¦² à¦¬à§‡à¦¤à¦¨/à§¨à§¦à§®*à§¨*à¦®à§‹à¦Ÿ à¦…à¦¤à¦¿à¦°à¦¿à¦•à§à¦¤ à¦˜à¦¨à§à¦Ÿà¦¾)à¥¤</p>\r\n<p>à§ªà¥¤ à¦¸à¦¾à¦§à¦¾à¦°à¦£ à¦›à§à¦Ÿà¦¿à¦ƒ-</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à§§à¥¤ à¦¶à§à¦•à§à¦°à¦¬à¦¾à¦° à¦¸à¦¾à¦ªà§à¦¤à¦¾à¦¹à¦¿à¦• à¦›à§à¦Ÿà¦¿à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à§¨à¥¤ à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯ à¦›à§à¦Ÿà¦¿, (à¦¯à¦¾à¦¹à¦¾ à¦ªà§‚à¦°à§à¦£ à¦¬à§‡à¦¤à¦¨à§‡ à¦­à§‹à¦— à¦•à¦°à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤&nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦•) à¦‰à§Žà¦¸à¦¬ à¦›à§à¦Ÿà¦¿à¦ƒ- à§§à§§ à¦¦à¦¿à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦–) à¦¨à§ˆà¦®à¦¿à¦¤à§à¦¤à¦¿à¦• à¦›à§à¦Ÿà¦¿à¦ƒ- à§§à§¦ à¦¦à¦¿à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦—) à¦¬à¦¾à¦°à§à¦·à¦¿à¦• à¦›à§à¦Ÿà¦¿à¦ƒ- à§¦à§§ (à¦à¦•) à¦¬à§Žà¦¸à¦° à¦…à¦¤à¦¿à¦¬à¦¾à¦¹à¦¿à¦¤ à¦¹à¦“à§Ÿà¦¾à¦° à¦ªà¦° à¦†à¦ªà¦¨à¦¿ à¦ªà§à¦°à¦¤à¦¿ à§§à§® à¦•à¦°à§à¦®à¦¦à¦¿à¦¬à¦¸à§‡à¦° à¦œà¦¨à§à¦¯ à¦à¦•à¦¦à¦¿à¦¨ à¦•à¦°à§‡ à¦¬à¦¾à¦°à§à¦·à¦¿à¦• à¦›à§à¦Ÿà§€ à¦­à§‹à¦— à¦•à¦°à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦˜) à¦…à¦¸à§à¦¸à§à¦¥à¦¤à¦¾ à¦œà¦¨à¦¿à¦¤ à¦›à§à¦Ÿà¦¿à¦ƒ- à¦…à¦¸à§à¦¸à§à¦¥à¦¤à¦¾à¦œà¦¨à¦¿à¦¤ à¦›à§à¦Ÿà¦¿ à¦¬à§Žà¦¸à¦°à§‡ à¦®à§‹à¦Ÿ à§§à§ª à¦¦à¦¿à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦™) à¦®à¦¾à¦¤à§ƒà¦¤à§à¦¬ à¦•à¦¾à¦²à§€à¦¨ à¦›à§à¦Ÿà¦¿à¦ƒ- à¦•à§‹à¦¨ à¦®à¦¹à¦¿à¦²à¦¾ à¦¶à§à¦°à¦®à¦¿à¦• à¦¯à¦¦à¦¿ à¦…à¦¤à§à¦° à¦ªà§à¦°à¦¤à¦¿à¦·à§à¦ à¦¾à¦¨à§‡ à¦…à¦•à¦¾à¦§à¦¿à¦•à§à¦°à¦®à§‡ à§¦à§¬ (à¦›à§Ÿ) à¦®à¦¾à¦¸ à¦šà¦¾à¦•à§à¦°à§€ à¦•à¦°à§‡à¦¨ à¦¤à¦¾à¦¹à¦²à§‡ à¦¤à¦¿à¦¨à¦¿ à¦‰à¦•à§à¦¤ à¦›à§à¦Ÿà¦¿ à¦­à§‹à¦— à¦•à¦°à¦¿à¦¤à§‡ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§ªà¥¤ à¦ªà¦°à¦¿à¦šà§Ÿ à¦ªà¦¤à§à¦°à¦ƒ- à¦†à¦ªà¦¨à¦¾à¦•à§‡ à¦ªà¦°à¦¿à¦šà§Ÿà¦ªà¦¤à§à¦° à¦¦à§‡à¦“à§Ÿà¦¾ à¦¹à¦‡à¦¬à§‡à¥¤ à¦†à¦ªà¦¨à¦¿ à¦•à¦¾à¦°à¦–à¦¾à¦¨à¦¾à§Ÿ à¦ªà§à¦°à¦¬à§‡à¦¶à§‡à¦° à¦ªà§‚à¦°à§à¦¬à§‡ à¦à¦¬à¦‚ à¦¬à§‡à¦° à¦¹à¦“à§Ÿà¦¾à¦° à¦¸à¦®à§Ÿ à¦ªà¦°à¦¿à¦šà§Ÿ à¦ªà¦¤à§‡à¦° à¦‡à¦²à§‡à¦•à§à¦Ÿà§à¦°à¦¨à¦¿à¦• à¦¹à¦¾à¦œà¦¿à¦°à¦¾ à¦®à§‡à¦¶à¦¿à¦¨à§‡à¦° à¦¦à§à¦¬à¦¾à¦°à¦¾ à¦ªà¦¾à¦žà§à¦š à¦•à¦°à¦¿à¦¬à§‡à¦¨ à¦à¦¬à¦‚ à¦‰à¦•à§à¦¤ à¦ªà¦¾à¦žà§à¦š à¦®à§‡à¦¶à¦¿à¦¨ à¦¥à§‡à¦•à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦®à¦¾à¦¸à¦¿à¦• à¦¹à¦¾à¦œà¦¿à¦°à¦¾ à¦à¦¬à¦‚ à¦…à¦¤à¦¿à¦°à¦¿à¦•à§à¦¤ à¦¸à¦®à§Ÿ à¦¬à§‡à¦° à¦•à¦°à¦¾ à¦¹à¦‡à¦¬à§‡à¥¤</p>\r\n<p>à§¬à¥¤ à¦ªà§à¦°à¦¬à§‡à¦¶à¦¨à¦¾à¦°à§€ à¦¥à¦¾à¦•à¦¾à¦•à¦¾à¦²à§€à¦¨ à¦¸à¦®à§Ÿà§‡ à¦•à§‹à¦®à§à¦ªà¦¾à¦¨à§€ à¦¯à§‡ à¦•à§‹à¦¨ à¦¸à¦®à§Ÿ à¦•à§‹à¦¨ à¦ªà§à¦°à¦•à¦¾à¦° à¦•à¦¾à¦°à¦£ à¦¦à¦°à§à¦¶à¦¾à¦¨à§‹ à¦¬à§à¦¯à¦¤à§€à¦°à§‡à¦•à§‡ à¦¬à¦¿à¦¨à¦¾ à¦¨à§‹à¦Ÿà¦¿à¦¶à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦šà¦¾à¦•à¦°à§€à¦° à¦…à¦¬à¦¸à¦¾à¦¨ à¦•à¦°à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨, à¦…à¦¥à¦¬à¦¾ à¦†à¦ªà¦¨à¦¿à¦“ à¦šà¦¾à¦•à¦°à¦¿ à¦¥à§‡à¦•à§‡ à¦¸à§à¦¬à§‡à¦šà§à¦›à¦¾à§Ÿ à¦‡à¦¸à§à¦¤à¦«à¦¾ à¦¦à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§­à¥¤&nbsp;à¦šà¦¾à¦•à§à¦°à§€ à¦¸à§à¦¥à¦¾à§Ÿà§€ à¦¹à¦‡à¦¬à¦¾à¦° à¦ªà¦° à¦†à¦ªà¦¨à¦¿ à¦¸à§à¦¬à§‡à¦šà§à¦›à¦¾à§Ÿ à¦šà¦¾à¦•à¦°à§€ à¦¹à¦‡à¦¤à§‡ à¦…à¦¬à§à¦¯à¦¹à¦¤à¦¿ à¦¨à¦¿à¦¤à§‡ à¦šà¦¾à¦‡à¦²à§‡ à¦•à¦¤à§ƒà¦ªà¦•à§à¦· à¦•à§‡ à§¬à§¦ (à¦·à¦¾à¦Ÿ) à¦¦à¦¿à¦¨ à¦ªà§‚à¦°à§à¦¬à§‡ à¦²à¦¿à¦–à¦¿à¦¤ à¦¨à§‹à¦Ÿà¦¿à¦¶à§‡à¦° à¦®à¦¾à¦§à§à¦¯à¦®à§‡ à¦œà¦¾à¦¨à¦¾à¦‡à¦¤à§‡ à¦¹à¦¬à§‡à¥¤</p>\r\n<p>à§®à¥¤ à¦šà¦¾à¦•à§à¦°à§€ à¦¸à§à¦¥à¦¾à§Ÿà§€ à¦¹à¦‡à¦¬à¦¾à¦° à¦ªà¦° à¦•à¦¤à§ƒà¦ªà¦•à§à¦· à¦†à¦ªà¦¨à¦¾à¦° à¦šà¦¾à¦•à¦°à§€à¦° à¦…à¦¬à¦¸à¦¾à¦¨ à¦•à¦°à¦¿à¦¤à§‡ à¦šà¦¾à¦¹à¦¿à¦²à§‡ à§§à§¨à§¦ (à¦à¦•à¦¶à¦¤ à¦¬à¦¿à¦¶) à¦¦à¦¿à¦¨à§‡à¦° à¦²à¦¿à¦–à¦¿à¦¤ à¦¨à§‹à¦Ÿà¦¿à¦¶ à¦…à¦¥à¦¬à¦¾&nbsp;à§§à§¨à§¦ (à¦à¦•à¦¶à¦¤ à¦¬à¦¿à¦¶) à¦¦à¦¿à¦¨à§‡à¦° à¦¬à§‡à¦¤à¦¨ à¦ªà§à¦°à¦¦à¦¾à¦¨ à¦•à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§¯à¥¤ à¦†à¦ªà¦¨à¦¾à¦° à¦šà¦¾à¦•à¦°à§€ à¦•à§‹à¦®à§à¦ªà¦¾à¦¨à§€ à¦•à¦¤à§ƒà¦• à¦œà¦¾à¦°à¦¿à¦•à§ƒà¦¤ à¦¬à¦¿à¦§à¦¾à¦¨ à¦“ à¦¬à¦¾à¦‚à¦²à¦¾à¦¦à§‡à¦¶à§‡à¦° à¦ªà§à¦°à¦šà¦²à¦¿à¦¤ à¦¶à§à¦°à¦® à¦†à¦‡à¦¨ à¦¦à§à¦¬à¦¾à¦°à¦¾ à¦ªà¦°à¦¿à¦šà¦¾à¦²à¦¿à¦¤ à¦¹à¦‡à¦¬à§‡à¥¤</p>\r\n<p>à§§à§¦à¥¤ à¦•à¦¤à§ƒà¦ªà¦•à§à¦· à¦†à¦ªà¦¨à¦¾à¦•à§‡ à¦ªà§à¦°à§Ÿà§‹à¦œà¦¨ à¦¬à§‹à¦§à§‡ à¦à¦‡ à¦ªà§à¦°à¦¤à¦¿à¦·à§à¦ à¦¾à¦¬à§‡à¦° à¦¯à§‡ à¦•à§‹à¦¨ à¦¬à¦¿à¦­à¦¾à¦—à§‡ à¦…à¦¥à¦¬à¦¾ à¦¬à¦¾à¦‚à¦²à¦¾à¦¦à§‡à¦¶à§‡ à¦…à¦¬à¦¸à§à¦¥à¦¿à¦¤ à¦¯à§‡ à¦•à§‹à¦¨ à¦•à¦¾à¦°à¦–à¦¾à¦¨à¦¾à§Ÿ/à¦…à¦«à¦¿à¦¸à§‡ à¦¬à¦¦à¦²à§€ à¦•à¦°à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§§à§§à¥¤ à¦•à§‹à¦®à§à¦ªà¦¾à¦¨à§€à¦° à¦¯à¦¾à¦¬à¦¤à§€à§Ÿ à¦¨à¦¿à§Ÿà¦®à¦•à¦¾à¦¨à§à¦¨ à¦ªà¦°à¦¿à¦¬à¦°à§à¦¤à¦¨à¦¯à§‹à¦—à§à¦¯ (à¦¯à¦¾à¦¹à¦¾ à¦¦à§‡à¦¶à§‡à¦° à¦ªà§à¦°à¦šà¦²à¦¿à¦¤ à¦†à¦‡à¦¨à§‡à¦° à¦ªà¦°à¦¿à¦ªà¦¨à§à¦¥à¦¿ à¦¨à¦¹à§‡) à¦à¦¬à¦‚ à¦†à¦ªà¦¨à¦¿ à¦ªà¦°à¦¿à¦¬à¦°à§à¦¤à¦¿à¦¤ à¦¨à¦¿à§Ÿà¦® à¦•à¦¾à¦¨à§à¦¨ à¦¸à¦°à§à¦¬à¦¦à¦¾ à¦®à¦¾à¦¨à¦¿à§Ÿà¦¾ à¦šà¦²à¦¿à¦¤à§‡&nbsp; &nbsp; &nbsp; &nbsp;à¦¬à¦¾à¦§à§à¦¯ à¦¥à¦¾à¦•à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à¦†à¦ªà¦¨à¦¾à¦° à¦†à¦‡.à¦¡à¦¿. à¦¨à¦‚-</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à¦†à¦ªà¦¨à¦¾à¦° à¦œà¦¾à¦¤à§€à§Ÿ à¦ªà¦°à¦¿à¦šà§Ÿà¦ªà¦¤à§à¦° à¦¨à¦‚- 123456</p>\r\n<p>à¦§à¦¨à§à¦¯à¦¬à¦¾à¦¦à¦¾à¦¨à§à¦¤à§‡</p>\r\n<p>&nbsp; &nbsp;à¦¸à¦‚à¦¶à§à¦²à¦¿à¦·à§à¦Ÿ à¦¬à§à¦¯à¦¬à¦¸à§à¦¥à¦¾à¦ªà¦•</p>\r\n<p style=\"text-align: right;\">à¦•à¦¾à¦°à¦–à¦¾à¦¨à¦¾ à¦•à¦¤à§ƒà¦ªà¦•à§à¦·&nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n<p>&nbsp; &nbsp;à¦…à¦¨à§à¦²à¦¿à¦ªà¦¿à¦ƒ</p>\r\n<p>&nbsp; &nbsp;à§§à¥¤ à¦¹à¦¿à¦¸à¦¾à¦¬ à¦¬à¦¿à¦­à¦¾à¦—à¥¤</p>\r\n<p>&nbsp; &nbsp;à§¨à¥¤ à¦¬à§à¦¯à¦•à§à¦¤à¦¿à¦—à¦¤ à¦¨à¦¥à¦¿à¥¤</p>\r\n<p>à¦†à¦®à¦¿ à¦…à¦¤à§à¦° à¦¨à¦¿à§Ÿà§‹à¦—à¦ªà¦¤à§à¦° à¦ªà¦¾à¦  à¦•à¦°à¦¿à§Ÿà¦¾ à¦à¦¬à¦‚ à¦‡à¦¹à¦¾à¦¤à§‡ à¦¬à¦°à§à¦£à¦¿à¦¤ à¦¶à¦°à§à¦¤à¦¾à¦¦à¦¿ à¦¸à¦®à§à¦ªà§‚à¦°à§à¦£à¦°à§à¦ªà§‡ à¦…à¦¬à¦—à¦¤ à¦¹à¦‡à§Ÿà¦¾ à¦à¦‡ à¦¨à¦¿à§Ÿà§‹à¦—à¦ªà¦¤à§à¦° à¦—à§à¦°à¦¹à¦£ à¦•à¦°à¦¿à§Ÿà¦¾ à¦¸à§à¦¬à¦¾à¦•à§à¦·à¦° à¦•à¦°à¦¿à¦²à¦¾à¦®à¥¤</p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: right;\">&nbsp;à¦¶à§à¦°à¦®à¦¿à¦•à§‡à¦° à¦¸à§à¦¬à¦•à§à¦·à¦°&nbsp; &nbsp; &nbsp; &nbsp;</p>'),
(4, '08E020001E', '<center></center><center><u> </u></center>\r\n<p>à¦¤à¦¾à¦°à¦¿à¦–à¦ƒ&nbsp; à§¨à§¦à§§à§®-à§¦à§­-à§§à§­ à§§à§¨:à§«à§¨:à§§à§©</p>\r\n<p>à¦œà¦¨à¦¾à¦¬/à¦œà¦¨à¦¾à¦¬à¦¾à¦ƒ</p>\r\n<p>à¦ªà¦¿à¦¤à¦¾/à¦¸à§à¦¬à¦¾à¦®à§€à¦° à¦¨à¦¾à¦®à¦ƒ /</p>\r\n<p>à¦®à¦¾à¦¤à¦¾à¦° à¦¨à¦¾à¦®à¦ƒ</p>\r\n<p>à¦—à§à¦°à¦¾à¦®à¦ƒ&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; à¦¡à¦¾à¦•à¦˜à¦°à¦ƒ</p>\r\n<p>à¦¥à¦¾à¦¨à¦¾à¦ƒ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; à¦œà§‡à¦²à¦¾à¦ƒ</p>\r\n<p><span style=\"text-decoration: underline;\"><strong>à¦¬à¦¿à¦·à§Ÿà¦ƒ- à¦¨à¦¿à§Ÿà§‹à¦—à¦ªà¦¤à§à¦°</strong></span></p>\r\n<p>à¦•à¦¤à§ƒà¦ªà¦•à§à¦· à¦…à¦¤à§à¦¯à¦¨à§à¦¤ à¦†à¦¨à¦¨à§à¦¦à§‡à¦° à¦¸à¦¹à¦¿à¦¤ à¦†à¦ªà¦¨à¦¾à¦•à§‡ à¦¨à¦¿à¦®à§à¦¨à¦²à¦¿à¦–à¦¿à¦¤ à¦¶à¦°à§à¦¤à¦¸à¦¾à¦ªà§‡à¦•à§à¦·à§‡ à¦…à¦¤à§à¦° à¦•à¦¾à¦°à¦–à¦¾à¦¨à¦¾à¦° à¦¬à¦¿à¦­à¦¾à¦—à§‡ à¦ªà¦¦à§‡ à¦ªà§à¦°à¦¤à¦¿ à¦®à¦¾à¦¸à§‡ à¦¸à¦°à§à¦¬à¦¸à¦¾à¦•à§à¦²à§à¦¯à§‡ à¦®à§‹à¦Ÿ à¦Ÿà¦¾à¦•à¦¾ à¦¬à§‡à¦¤à¦¨à§‡ à§¨à§¦à¦¤à¦® à¦—à§à¦°à§‡à¦¡à§‡ à¦¨à¦¿à§Ÿà§‹à¦— à¦¦à§‡à¦“à§Ÿà¦¾à¦° à¦¸à¦¿à¦¦à§à¦§à¦¾à¦¨à§à¦¤ à¦•à¦°à¦¿à§Ÿà¦¾à¦›à§‡à¦¨, à¦¯à¦¾à¦¹à¦¾ à§¨à§¦à§¦à§®-à§¦à§«-à§¦à§® à¦¤à¦¾à¦°à¦¿à¦– à¦¹à¦‡à¦¤à§‡ à¦•à¦¾à¦°à§à¦¯à¦•à¦°à§€à¥¤</p>\r\n<p>à§§à¥¤ à¦†à¦ªà¦¨à¦¿ à¦šà¦¾à¦•à§à¦°à§€à¦¤à§‡ à¦ªà§à¦°à¦¥à¦® à§¦à§© (à¦¤à¦¿à¦¨) à¦®à¦¾à¦¸ à¦ªà§à¦°à¦¬à§‡à¦¶à¦¨à¦¾à¦°à§€ à¦…à¦¬à¦¸à§à¦¥à¦¾à§Ÿ à¦¥à¦¾à¦•à¦¿à¦¬à§‡à¦¨ à¦à¦¬à¦‚ à¦‰à¦•à§à¦¤ à¦¸à¦®à§Ÿà§‡à¦° à¦®à¦§à§à¦¯à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦•à¦°à§à¦®à¦¦à¦•à§à¦·à¦¤à¦¾ à¦¸à¦¨à§à¦¤à§‹à¦·à¦œà¦¨à¦• à¦¨à¦¾ à¦¹à¦‡à¦²à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦ªà§à¦°à¦¬à§‡à¦¶à¦¨à¦•à¦¾à¦² à¦†à¦°à¦“ à¦¤à¦¿à¦¨ à¦®à¦¾à¦¸ à¦¬à¦°à§à¦§à¦¿à¦¤ à¦•à¦°à¦¾ à¦¯à§‡à¦¤à§‡ à¦ªà¦¾à¦°à§‡à¥¤ à¦ªà§à¦°à¦¬à§‡à¦¶à¦¨à¦•à¦¾à¦² à¦¤à¦¿à¦¨ à¦®à¦¾à¦¸ à¦…à¦¤à¦¿à¦¬à¦¾à¦¹à¦¿à¦¤ à¦¹à¦“à§Ÿà¦¾à¦° à¦ªà¦° à¦†à¦ªà¦¨à¦¿ à¦¸à¦°à¦¾à¦¸à¦°à¦¿ à¦¸à§à¦¥à¦¾à§Ÿà§€ à¦¬à¦²à§‡ à¦—à¦£à§à¦¯ à¦¹à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§¨à¥¤ à¦¸à¦¾à¦§à¦¾à¦°à¦¨ à¦•à¦°à§à¦®à¦˜à¦¨à§à¦Ÿà¦¾ à§¦à§® (à¦†à¦Ÿ) à¦˜à¦¨à§à¦Ÿà¦¾ à¦à¦¬à¦‚ à¦®à¦§à§à¦¯à¦¾à¦¹à§à¦¨ à¦¬à¦¿à¦°à¦¤à¦¿ à§¬à§¦ à¦®à¦¿à¦¨à¦¿à¦Ÿà¥¤</p>\r\n<p>à§©à¥¤ à¦…à¦¤à¦¿à¦°à¦¿à¦•à§à¦¤ à¦¸à¦®à§Ÿ (à¦“.à¦Ÿà¦¿) à¦‡à¦¹à¦¾ à¦®à§‚à¦² à¦¬à§‡à¦¤à¦¨à§‡à¦° à¦¦à§à¦¬à¦¿à¦—à§à¦¨à¥¤ ( à¦®à§‚à¦² à¦¬à§‡à¦¤à¦¨/à§¨à§¦à§®*à§¨*à¦®à§‹à¦Ÿ à¦…à¦¤à¦¿à¦°à¦¿à¦•à§à¦¤ à¦˜à¦¨à§à¦Ÿà¦¾)à¥¤</p>\r\n<p>à§ªà¥¤ à¦¸à¦¾à¦§à¦¾à¦°à¦£ à¦›à§à¦Ÿà¦¿à¦ƒ-</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à§§à¥¤ à¦¶à§à¦•à§à¦°à¦¬à¦¾à¦° à¦¸à¦¾à¦ªà§à¦¤à¦¾à¦¹à¦¿à¦• à¦›à§à¦Ÿà¦¿à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à§¨à¥¤ à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯ à¦›à§à¦Ÿà¦¿, (à¦¯à¦¾à¦¹à¦¾ à¦ªà§‚à¦°à§à¦£ à¦¬à§‡à¦¤à¦¨à§‡ à¦­à§‹à¦— à¦•à¦°à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤&nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦•) à¦‰à§Žà¦¸à¦¬ à¦›à§à¦Ÿà¦¿à¦ƒ- à§§à§§ à¦¦à¦¿à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦–) à¦¨à§ˆà¦®à¦¿à¦¤à§à¦¤à¦¿à¦• à¦›à§à¦Ÿà¦¿à¦ƒ- à§§à§¦ à¦¦à¦¿à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦—) à¦¬à¦¾à¦°à§à¦·à¦¿à¦• à¦›à§à¦Ÿà¦¿à¦ƒ- à§¦à§§ (à¦à¦•) à¦¬à§Žà¦¸à¦° à¦…à¦¤à¦¿à¦¬à¦¾à¦¹à¦¿à¦¤ à¦¹à¦“à§Ÿà¦¾à¦° à¦ªà¦° à¦†à¦ªà¦¨à¦¿ à¦ªà§à¦°à¦¤à¦¿ à§§à§® à¦•à¦°à§à¦®à¦¦à¦¿à¦¬à¦¸à§‡à¦° à¦œà¦¨à§à¦¯ à¦à¦•à¦¦à¦¿à¦¨ à¦•à¦°à§‡ à¦¬à¦¾à¦°à§à¦·à¦¿à¦• à¦›à§à¦Ÿà§€ à¦­à§‹à¦— à¦•à¦°à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦˜) à¦…à¦¸à§à¦¸à§à¦¥à¦¤à¦¾ à¦œà¦¨à¦¿à¦¤ à¦›à§à¦Ÿà¦¿à¦ƒ- à¦…à¦¸à§à¦¸à§à¦¥à¦¤à¦¾à¦œà¦¨à¦¿à¦¤ à¦›à§à¦Ÿà¦¿ à¦¬à§Žà¦¸à¦°à§‡ à¦®à§‹à¦Ÿ à§§à§ª à¦¦à¦¿à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;à¦™) à¦®à¦¾à¦¤à§ƒà¦¤à§à¦¬ à¦•à¦¾à¦²à§€à¦¨ à¦›à§à¦Ÿà¦¿à¦ƒ- à¦•à§‹à¦¨ à¦®à¦¹à¦¿à¦²à¦¾ à¦¶à§à¦°à¦®à¦¿à¦• à¦¯à¦¦à¦¿ à¦…à¦¤à§à¦° à¦ªà§à¦°à¦¤à¦¿à¦·à§à¦ à¦¾à¦¨à§‡ à¦…à¦•à¦¾à¦§à¦¿à¦•à§à¦°à¦®à§‡ à§¦à§¬ (à¦›à§Ÿ) à¦®à¦¾à¦¸ à¦šà¦¾à¦•à§à¦°à§€ à¦•à¦°à§‡à¦¨ à¦¤à¦¾à¦¹à¦²à§‡ à¦¤à¦¿à¦¨à¦¿ à¦‰à¦•à§à¦¤ à¦›à§à¦Ÿà¦¿ à¦­à§‹à¦— à¦•à¦°à¦¿à¦¤à§‡ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§ªà¥¤ à¦ªà¦°à¦¿à¦šà§Ÿ à¦ªà¦¤à§à¦°à¦ƒ- à¦†à¦ªà¦¨à¦¾à¦•à§‡ à¦ªà¦°à¦¿à¦šà§Ÿà¦ªà¦¤à§à¦° à¦¦à§‡à¦“à§Ÿà¦¾ à¦¹à¦‡à¦¬à§‡à¥¤ à¦†à¦ªà¦¨à¦¿ à¦•à¦¾à¦°à¦–à¦¾à¦¨à¦¾à§Ÿ à¦ªà§à¦°à¦¬à§‡à¦¶à§‡à¦° à¦ªà§‚à¦°à§à¦¬à§‡ à¦à¦¬à¦‚ à¦¬à§‡à¦° à¦¹à¦“à§Ÿà¦¾à¦° à¦¸à¦®à§Ÿ à¦ªà¦°à¦¿à¦šà§Ÿ à¦ªà¦¤à§‡à¦° à¦‡à¦²à§‡à¦•à§à¦Ÿà§à¦°à¦¨à¦¿à¦• à¦¹à¦¾à¦œà¦¿à¦°à¦¾ à¦®à§‡à¦¶à¦¿à¦¨à§‡à¦° à¦¦à§à¦¬à¦¾à¦°à¦¾ à¦ªà¦¾à¦žà§à¦š à¦•à¦°à¦¿à¦¬à§‡à¦¨ à¦à¦¬à¦‚ à¦‰à¦•à§à¦¤ à¦ªà¦¾à¦žà§à¦š à¦®à§‡à¦¶à¦¿à¦¨ à¦¥à§‡à¦•à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦®à¦¾à¦¸à¦¿à¦• à¦¹à¦¾à¦œà¦¿à¦°à¦¾ à¦à¦¬à¦‚ à¦…à¦¤à¦¿à¦°à¦¿à¦•à§à¦¤ à¦¸à¦®à§Ÿ à¦¬à§‡à¦° à¦•à¦°à¦¾ à¦¹à¦‡à¦¬à§‡à¥¤</p>\r\n<p>à§¬à¥¤ à¦ªà§à¦°à¦¬à§‡à¦¶à¦¨à¦¾à¦°à§€ à¦¥à¦¾à¦•à¦¾à¦•à¦¾à¦²à§€à¦¨ à¦¸à¦®à§Ÿà§‡ à¦•à§‹à¦®à§à¦ªà¦¾à¦¨à§€ à¦¯à§‡ à¦•à§‹à¦¨ à¦¸à¦®à§Ÿ à¦•à§‹à¦¨ à¦ªà§à¦°à¦•à¦¾à¦° à¦•à¦¾à¦°à¦£ à¦¦à¦°à§à¦¶à¦¾à¦¨à§‹ à¦¬à§à¦¯à¦¤à§€à¦°à§‡à¦•à§‡ à¦¬à¦¿à¦¨à¦¾ à¦¨à§‹à¦Ÿà¦¿à¦¶à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦šà¦¾à¦•à¦°à§€à¦° à¦…à¦¬à¦¸à¦¾à¦¨ à¦•à¦°à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨, à¦…à¦¥à¦¬à¦¾ à¦†à¦ªà¦¨à¦¿à¦“ à¦šà¦¾à¦•à¦°à¦¿ à¦¥à§‡à¦•à§‡ à¦¸à§à¦¬à§‡à¦šà§à¦›à¦¾à§Ÿ à¦‡à¦¸à§à¦¤à¦«à¦¾ à¦¦à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§­à¥¤&nbsp;à¦šà¦¾à¦•à§à¦°à§€ à¦¸à§à¦¥à¦¾à§Ÿà§€ à¦¹à¦‡à¦¬à¦¾à¦° à¦ªà¦° à¦†à¦ªà¦¨à¦¿ à¦¸à§à¦¬à§‡à¦šà§à¦›à¦¾à§Ÿ à¦šà¦¾à¦•à¦°à§€ à¦¹à¦‡à¦¤à§‡ à¦…à¦¬à§à¦¯à¦¹à¦¤à¦¿ à¦¨à¦¿à¦¤à§‡ à¦šà¦¾à¦‡à¦²à§‡ à¦•à¦¤à§ƒà¦ªà¦•à§à¦· à¦•à§‡ à§¬à§¦ (à¦·à¦¾à¦Ÿ) à¦¦à¦¿à¦¨ à¦ªà§‚à¦°à§à¦¬à§‡ à¦²à¦¿à¦–à¦¿à¦¤ à¦¨à§‹à¦Ÿà¦¿à¦¶à§‡à¦° à¦®à¦¾à¦§à§à¦¯à¦®à§‡ à¦œà¦¾à¦¨à¦¾à¦‡à¦¤à§‡ à¦¹à¦¬à§‡à¥¤</p>\r\n<p>à§®à¥¤ à¦šà¦¾à¦•à§à¦°à§€ à¦¸à§à¦¥à¦¾à§Ÿà§€ à¦¹à¦‡à¦¬à¦¾à¦° à¦ªà¦° à¦•à¦¤à§ƒà¦ªà¦•à§à¦· à¦†à¦ªà¦¨à¦¾à¦° à¦šà¦¾à¦•à¦°à§€à¦° à¦…à¦¬à¦¸à¦¾à¦¨ à¦•à¦°à¦¿à¦¤à§‡ à¦šà¦¾à¦¹à¦¿à¦²à§‡ à§§à§¨à§¦ (à¦à¦•à¦¶à¦¤ à¦¬à¦¿à¦¶) à¦¦à¦¿à¦¨à§‡à¦° à¦²à¦¿à¦–à¦¿à¦¤ à¦¨à§‹à¦Ÿà¦¿à¦¶ à¦…à¦¥à¦¬à¦¾&nbsp;à§§à§¨à§¦ (à¦à¦•à¦¶à¦¤ à¦¬à¦¿à¦¶) à¦¦à¦¿à¦¨à§‡à¦° à¦¬à§‡à¦¤à¦¨ à¦ªà§à¦°à¦¦à¦¾à¦¨ à¦•à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§¯à¥¤ à¦†à¦ªà¦¨à¦¾à¦° à¦šà¦¾à¦•à¦°à§€ à¦•à§‹à¦®à§à¦ªà¦¾à¦¨à§€ à¦•à¦¤à§ƒà¦• à¦œà¦¾à¦°à¦¿à¦•à§ƒà¦¤ à¦¬à¦¿à¦§à¦¾à¦¨ à¦“ à¦¬à¦¾à¦‚à¦²à¦¾à¦¦à§‡à¦¶à§‡à¦° à¦ªà§à¦°à¦šà¦²à¦¿à¦¤ à¦¶à§à¦°à¦® à¦†à¦‡à¦¨ à¦¦à§à¦¬à¦¾à¦°à¦¾ à¦ªà¦°à¦¿à¦šà¦¾à¦²à¦¿à¦¤ à¦¹à¦‡à¦¬à§‡à¥¤</p>\r\n<p>à§§à§¦à¥¤ à¦•à¦¤à§ƒà¦ªà¦•à§à¦· à¦†à¦ªà¦¨à¦¾à¦•à§‡ à¦ªà§à¦°à§Ÿà§‹à¦œà¦¨ à¦¬à§‹à¦§à§‡ à¦à¦‡ à¦ªà§à¦°à¦¤à¦¿à¦·à§à¦ à¦¾à¦¬à§‡à¦° à¦¯à§‡ à¦•à§‹à¦¨ à¦¬à¦¿à¦­à¦¾à¦—à§‡ à¦…à¦¥à¦¬à¦¾ à¦¬à¦¾à¦‚à¦²à¦¾à¦¦à§‡à¦¶à§‡ à¦…à¦¬à¦¸à§à¦¥à¦¿à¦¤ à¦¯à§‡ à¦•à§‹à¦¨ à¦•à¦¾à¦°à¦–à¦¾à¦¨à¦¾à§Ÿ/à¦…à¦«à¦¿à¦¸à§‡ à¦¬à¦¦à¦²à§€ à¦•à¦°à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>à§§à§§à¥¤ à¦•à§‹à¦®à§à¦ªà¦¾à¦¨à§€à¦° à¦¯à¦¾à¦¬à¦¤à§€à§Ÿ à¦¨à¦¿à§Ÿà¦®à¦•à¦¾à¦¨à§à¦¨ à¦ªà¦°à¦¿à¦¬à¦°à§à¦¤à¦¨à¦¯à§‹à¦—à§à¦¯ (à¦¯à¦¾à¦¹à¦¾ à¦¦à§‡à¦¶à§‡à¦° à¦ªà§à¦°à¦šà¦²à¦¿à¦¤ à¦†à¦‡à¦¨à§‡à¦° à¦ªà¦°à¦¿à¦ªà¦¨à§à¦¥à¦¿ à¦¨à¦¹à§‡) à¦à¦¬à¦‚ à¦†à¦ªà¦¨à¦¿ à¦ªà¦°à¦¿à¦¬à¦°à§à¦¤à¦¿à¦¤ à¦¨à¦¿à§Ÿà¦® à¦•à¦¾à¦¨à§à¦¨ à¦¸à¦°à§à¦¬à¦¦à¦¾ à¦®à¦¾à¦¨à¦¿à§Ÿà¦¾ à¦šà¦²à¦¿à¦¤à§‡&nbsp; &nbsp; &nbsp; &nbsp;à¦¬à¦¾à¦§à§à¦¯ à¦¥à¦¾à¦•à¦¿à¦¬à§‡à¦¨à¥¤</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à¦†à¦ªà¦¨à¦¾à¦° à¦†à¦‡.à¦¡à¦¿. à¦¨à¦‚-</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;à¦†à¦ªà¦¨à¦¾à¦° à¦œà¦¾à¦¤à§€à§Ÿ à¦ªà¦°à¦¿à¦šà§Ÿà¦ªà¦¤à§à¦° à¦¨à¦‚-</p>\r\n<p>à¦§à¦¨à§à¦¯à¦¬à¦¾à¦¦à¦¾à¦¨à§à¦¤à§‡</p>\r\n<p>&nbsp; &nbsp;à¦¸à¦‚à¦¶à§à¦²à¦¿à¦·à§à¦Ÿ à¦¬à§à¦¯à¦¬à¦¸à§à¦¥à¦¾à¦ªà¦•</p>\r\n<p style=\"text-align: right;\">à¦•à¦¾à¦°à¦–à¦¾à¦¨à¦¾ à¦•à¦¤à§ƒà¦ªà¦•à§à¦·&nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n<p>&nbsp; &nbsp;à¦…à¦¨à§à¦²à¦¿à¦ªà¦¿à¦ƒ</p>\r\n<p>&nbsp; &nbsp;à§§à¥¤ à¦¹à¦¿à¦¸à¦¾à¦¬ à¦¬à¦¿à¦­à¦¾à¦—à¥¤</p>\r\n<p>&nbsp; &nbsp;à§¨à¥¤ à¦¬à§à¦¯à¦•à§à¦¤à¦¿à¦—à¦¤ à¦¨à¦¥à¦¿à¥¤</p>\r\n<p>à¦†à¦®à¦¿ à¦…à¦¤à§à¦° à¦¨à¦¿à§Ÿà§‹à¦—à¦ªà¦¤à§à¦° à¦ªà¦¾à¦  à¦•à¦°à¦¿à§Ÿà¦¾ à¦à¦¬à¦‚ à¦‡à¦¹à¦¾à¦¤à§‡ à¦¬à¦°à§à¦£à¦¿à¦¤ à¦¶à¦°à§à¦¤à¦¾à¦¦à¦¿ à¦¸à¦®à§à¦ªà§‚à¦°à§à¦£à¦°à§à¦ªà§‡ à¦…à¦¬à¦—à¦¤ à¦¹à¦‡à§Ÿà¦¾ à¦à¦‡ à¦¨à¦¿à§Ÿà§‹à¦—à¦ªà¦¤à§à¦° à¦—à§à¦°à¦¹à¦£ à¦•à¦°à¦¿à§Ÿà¦¾ à¦¸à§à¦¬à¦¾à¦•à§à¦·à¦° à¦•à¦°à¦¿à¦²à¦¾à¦®à¥¤</p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: right;\">&nbsp;à¦¶à§à¦°à¦®à¦¿à¦•à§‡à¦° à¦¸à§à¦¬à¦•à§à¦·à¦°&nbsp; &nbsp; &nbsp; &nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `hr_line`
--

CREATE TABLE `hr_line` (
  `hr_line_id` int(11) NOT NULL,
  `hr_line_unit_id` int(11) NOT NULL,
  `hr_line_floor_id` int(11) NOT NULL,
  `hr_line_name` varchar(128) DEFAULT NULL,
  `hr_line_name_bn` varchar(255) DEFAULT NULL,
  `hr_line_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_line`
--

INSERT INTO `hr_line` (`hr_line_id`, `hr_line_unit_id`, `hr_line_floor_id`, `hr_line_name`, `hr_line_name_bn`, `hr_line_status`) VALUES
(25, 3, 21, 'A1', NULL, 1),
(26, 3, 21, 'A2', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_loan_application`
--

CREATE TABLE `hr_loan_application` (
  `hr_la_id` int(11) NOT NULL,
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
  `hr_la_status` int(1) NOT NULL DEFAULT '0' COMMENT '0= Applied, 1= Approved, 2=Declined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_loan_application`
--

INSERT INTO `hr_loan_application` (`hr_la_id`, `hr_la_as_id`, `hr_la_name`, `hr_la_designation`, `hr_la_date_of_join`, `hr_la_applied_amount`, `hr_la_approved_amount`, `hr_la_no_of_installments`, `hr_la_no_of_installments_approved`, `hr_la_applied_date`, `hr_la_type_of_loan`, `hr_la_purpose_of_loan`, `hr_la_note`, `hr_la_supervisors_comment`, `hr_la_updated_at`, `hr_la_status`) VALUES
(1, '17F005001B', 'MBM IT', 'Offiece Boy', '2017-06-17', 100000, 100000, 5000, 5000, '2018-07-21', 'Home Loan', 'Education, ', NULL, 'ok', '2018-07-25 11:18:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_loan_type`
--

CREATE TABLE `hr_loan_type` (
  `id` int(11) NOT NULL,
  `hr_loan_type_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_loan_type`
--

INSERT INTO `hr_loan_type` (`id`, `hr_loan_type_name`) VALUES
(1, 'Home Loan'),
(2, 'House Building');

-- --------------------------------------------------------

--
-- Table structure for table `hr_medical_incident`
--

CREATE TABLE `hr_medical_incident` (
  `id` int(11) NOT NULL,
  `hr_med_incident_as_id` varchar(10) NOT NULL,
  `hr_med_incident_as_name` varchar(128) NOT NULL,
  `hr_med_incident_date` date DEFAULT NULL,
  `hr_med_incident_details` varchar(256) DEFAULT NULL,
  `hr_med_incident_doctors_name` varchar(128) DEFAULT NULL,
  `hr_med_incident_doctors_recommendation` varchar(128) DEFAULT NULL,
  `hr_med_incident_supporting_file` varchar(128) DEFAULT NULL,
  `hr_med_incident_action` varchar(128) DEFAULT NULL,
  `hr_med_incident_allowance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_medical_incident`
--

INSERT INTO `hr_medical_incident` (`id`, `hr_med_incident_as_id`, `hr_med_incident_as_name`, `hr_med_incident_date`, `hr_med_incident_details`, `hr_med_incident_doctors_name`, `hr_med_incident_doctors_recommendation`, `hr_med_incident_supporting_file`, `hr_med_incident_action`, `hr_med_incident_allowance`) VALUES
(9, '10M005001B', 'Khaled Al Mamun', '2018-07-05', 'Stomach Upset', NULL, NULL, NULL, 'Leave', NULL),
(10, '18A100001N', 'SAHERA KHATUN', '2018-07-22', 'neck pain\\\\;;', 'Mr. Aminul', 'Full bed rest ,.\\', '/assets/files/advinfo/5bef9fc7015c0.png', 'Give her 10 days leave;;;', 10000),
(11, '17F005001B', 'MBM IT', '2018-07-22', 'FGFDFGHGF', 'sdfd', 'Full bed rest ,.\\', NULL, 'Give her 10 days leave;;;', 800);

-- --------------------------------------------------------

--
-- Table structure for table `hr_med_info`
--

CREATE TABLE `hr_med_info` (
  `med_id` int(11) NOT NULL,
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
  `med_doct_signature` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_med_info`
--

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
(34, '18M100013N', '5\'3\"', '54', 'N/A', 'O+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(35, '18G100014N', '5\'', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
(36, '18G100015N', '5\'', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(37, '18A100016N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(38, '18A100017N', '5\'', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(39, '18C100018N', '5\'6\"', '60', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
(40, '18A100019N', '5\'', '54', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
(41, '18A100020N', '5\'1\"', '52', 'N/A', 'O+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(42, '18A100021N', '5\'6\"', '60', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
(43, '18A100022N', '5\'', '53', 'N/A', 'B+', 'N/A', 'N/A', 'Accepted', '36-40', NULL, NULL, NULL),
(44, '18C100023N', '5\'6\"', '65', 'N/A', 'B+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(45, '18G100024N', '5\'1\"', '53', 'N/A', 'B+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(46, '18A100025N', '5\'', '56', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(47, '18C100026N', '5\'5\"', '65', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(48, '18B100027N', '5\'6\"', '65', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(49, '18C100028N', '5\'', '51', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
(50, '18A100029N', '5\'', '53', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(51, '18B100030N', '5\'6\"', '65', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(52, '17K100031N', '5\'', '50', 'N/A', 'AB+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(53, '18C100032N', '5\'', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(54, '18B100033N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
(55, '18B100034N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
(56, '18C100035N', '5\'', '53', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '36-40', NULL, NULL, NULL),
(57, '18D100036N', '5\'6\"', '66', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(58, '18A100037N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(59, '18G100038N', '5\'1\"', '54', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(60, '18A100039N', '5\'1\"', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(61, '18A100040N', '5\'', '53', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(62, '18C100041N', '5\'1\"', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(63, '18G100042N', '5\'1\"', '61', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(64, '18G100043N', '5\'', '50', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
(65, '18D100044N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '41-45', NULL, NULL, NULL),
(66, '18B100045N', '5\'', '51', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
(67, '18C100046N', '5\'1\"', '54', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(68, '18D100047N', '5\'', '53', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
(69, '18B100048N', '5\'', '58', 'N/A', 'B+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
(70, '18B100049N', '5\'1\"', '52', 'N/A', 'O+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(71, '18C100050N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(72, '18C100051N', '5\'2\"', '59', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(73, '18G100052N', '5\'1\"', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
(74, '18B100053N', '5\'1\"', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(75, '18C100054N', '5\'1\"', '60', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(76, '18D100055N', '5\'1\"', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(77, '18A100056N', '5\'2\"', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
(78, '18C100057N', '5\'', '56', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(79, '18G100058N', '5\'1\"', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(80, '18C100059N', '5\'1\"', '53', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '36-40', NULL, NULL, NULL),
(81, '18E100060N', '5\'1\"', '51', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '31-35', NULL, NULL, NULL),
(82, '18C100061N', '5\'', '50', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
(83, '18B100062N', '5\'1\"', '52', 'N/A', 'B+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(84, '18D100063N', '5\'2\"', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(85, '18C100064N', '5\'6\"', '65', 'N/A', 'A+', 'N/A', 'N/A', 'Acceppted', '18-20', NULL, NULL, NULL),
(86, '18B100065N', '5\'1\"', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(87, '18G100066N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
(88, '18A100067N', '5\'', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '21-25', NULL, NULL, NULL),
(89, '18C100068N', '5\'1\"', '58', 'N/A', 'B+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(90, '18D100069N', '5\'6\"', '60', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '18-20', NULL, NULL, NULL),
(91, '18G100070N', '5\'1\"', '55', 'N/A', 'O+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(92, '18A100071N', '5\'', '55', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '36-40', NULL, NULL, NULL),
(93, '18A100072N', '5\'1\"', '52', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL),
(94, '18A100073N', '5\'', '54', 'N/A', 'A+', 'N/A', 'N/A', 'Accepted', '26-30', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hr_nominee`
--

CREATE TABLE `hr_nominee` (
  `nom_id` int(11) NOT NULL,
  `nom_as_id` varchar(10) NOT NULL,
  `nom_name` varchar(64) DEFAULT NULL,
  `nom_relation` varchar(64) DEFAULT NULL,
  `nom_ben` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_ot`
--

CREATE TABLE `hr_ot` (
  `hr_ot_id` int(11) NOT NULL,
  `hr_ot_as_id` varchar(10) NOT NULL,
  `hr_ot_date` date NOT NULL,
  `hr_ot_hour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_ot`
--

INSERT INTO `hr_ot` (`hr_ot_id`, `hr_ot_as_id`, `hr_ot_date`, `hr_ot_hour`) VALUES
(1, '18A100006N', '2018-07-18', 3);

-- --------------------------------------------------------

--
-- Table structure for table `hr_performance_appraisal`
--

CREATE TABLE `hr_performance_appraisal` (
  `id` int(11) UNSIGNED NOT NULL,
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
  `hr_pa_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_performance_appraisal`
--

INSERT INTO `hr_performance_appraisal` (`id`, `hr_pa_as_id`, `hr_pa_report_from`, `hr_pa_report_to`, `hr_pa_punctuality`, `hr_pa_reasoning`, `hr_pa_job_acceptance`, `hr_pa_owner_sense`, `hr_pa_rw_sense`, `hr_pa_idea_thought`, `hr_pa_coleague_interaction`, `hr_pa_meet_kpi`, `hr_pa_communication`, `hr_pa_cause_analysis`, `hr_pa_professionality`, `hr_pa_target_set`, `hr_pa_job_interest`, `hr_pa_out_perform`, `hr_pa_team_work`, `hr_pa_primary_assesment`, `hr_pa_first_attribute`, `hr_pa_second_attribute`, `hr_pa_third_attribute`, `hr_pa_long_retention`, `hr_pa_promotion_recommendation`, `hr_pa_replacement`, `hr_pa_remarks_dept_head`, `hr_pa_remarks_hr_head`, `hr_pa_remarks_incharge`, `hr_pa_remarks_ceo`, `hr_pa_status`) VALUES
(1, '18G100011N', '2018-07-01', '2018-07-31', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 'sdgd-', 'dgd-', 'xvbxb-', 1, 1, 1, 'xvbxb-', 'good', 'avarage', 'good', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_promotion`
--

CREATE TABLE `hr_promotion` (
  `id` int(10) UNSIGNED NOT NULL,
  `associate_id` varchar(10) NOT NULL,
  `previous_designation_id` int(11) NOT NULL,
  `current_designation_id` int(11) NOT NULL,
  `eligible_date` date NOT NULL,
  `effective_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_promotion`
--

INSERT INTO `hr_promotion` (`id`, `associate_id`, `previous_designation_id`, `current_designation_id`, `eligible_date`, `effective_date`, `status`) VALUES
(5, '17F005001B', 27, 26, '2018-06-17', '2018-07-17', 1),
(6, '17F005001B', 27, 29, '2018-06-17', '2018-07-17', 1),
(7, '17F005001B', 29, 26, '2018-06-17', '2018-07-30', 1),
(8, '17F005001B', 26, 25, '2018-06-17', '2018-07-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_salary_structure`
--

CREATE TABLE `hr_salary_structure` (
  `id` int(11) NOT NULL,
  `basic` float NOT NULL,
  `house_rent` float NOT NULL,
  `medical` float NOT NULL,
  `transport` float NOT NULL,
  `food` float NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_salary_structure`
--

INSERT INTO `hr_salary_structure` (`id`, `basic`, `house_rent`, `medical`, `transport`, `food`, `updated_at`, `updated_by`, `status`) VALUES
(2, 60, 10, 10, 10, 10, '2018-07-16 05:02:37', '18D002012H', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_section`
--

CREATE TABLE `hr_section` (
  `hr_section_id` int(11) NOT NULL,
  `hr_section_area_id` int(11) DEFAULT NULL,
  `hr_section_department_id` int(11) DEFAULT NULL,
  `hr_section_name` varchar(128) DEFAULT NULL,
  `hr_section_name_bn` varchar(255) DEFAULT NULL,
  `hr_section_code` varchar(10) DEFAULT NULL,
  `hr_section_status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_section`
--

INSERT INTO `hr_section` (`hr_section_id`, `hr_section_area_id`, `hr_section_department_id`, `hr_section_name`, `hr_section_name_bn`, `hr_section_code`, `hr_section_status`) VALUES
(21, 2, 25, 'Sewing', 'à¦¸à§‡à¦²à¦¾à¦‡', 'A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_service_book`
--

CREATE TABLE `hr_service_book` (
  `hr_s_book_id` int(11) NOT NULL,
  `hr_associate_id` varchar(10) NOT NULL,
  `page1_url` varchar(145) NOT NULL,
  `page2_url` varchar(145) DEFAULT NULL,
  `page3_url` varchar(145) DEFAULT NULL,
  `page4_url` varchar(145) DEFAULT NULL,
  `page5_url` varchar(145) DEFAULT NULL,
  `page6_url` varchar(145) DEFAULT NULL,
  `page7_url` varchar(145) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_service_book`
--

INSERT INTO `hr_service_book` (`hr_s_book_id`, `hr_associate_id`, `page1_url`, `page2_url`, `page3_url`, `page4_url`, `page5_url`, `page6_url`, `page7_url`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(5, '18A100005N', '/assets/files/servicebook/5bd6a2888ebf0.png', '/assets/files/servicebook/5bd590392f79e.jpg', '/assets/files/servicebook/5bd590392fcd1.jpg', '/assets/files/servicebook/5bd58b96965a9.jpg', NULL, '/assets/files/servicebook/5bd58b9696a3a.jpg', '/assets/files/servicebook/5bd60ab9cad40.png', '2018-10-28 16:12:38', 17, NULL, 17),
(8, '18A100010N', '/assets/files/servicebook/5bd6083499ada.png', '/assets/files/servicebook/5bd608349a30b.jpg', NULL, NULL, '/assets/files/servicebook/5bd608349a8de.jpg', NULL, NULL, '2018-10-29 01:04:20', 17, NULL, NULL),
(9, '18A100005N', '/assets/files/servicebook/5bd688a1eeefd.png', '/assets/files/servicebook/5bd6881b36434.jpg', NULL, NULL, '/assets/files/servicebook/5bd6881b36a14.png', NULL, NULL, '2018-10-29 10:10:03', 17, NULL, 17),
(10, '18A100001N', '/assets/files/servicebook/5bd80d74ab191.jpg', '/assets/files/servicebook/5bd80d74abbb6.png', '/assets/files/servicebook/5bd80d74ac5bd.jpeg', NULL, NULL, NULL, NULL, '2018-10-30 13:51:16', 17, NULL, 17),
(11, '18A100002N', '/assets/files/servicebook/5bd83be9c45d3.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-30 17:09:29', 17, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hr_shift`
--

CREATE TABLE `hr_shift` (
  `hr_shift_id` int(11) NOT NULL,
  `hr_shift_unit_id` int(11) NOT NULL,
  `hr_shift_name` varchar(128) DEFAULT NULL,
  `hr_shift_name_bn` varchar(255) DEFAULT NULL,
  `hr_shift_code` varchar(4) NOT NULL,
  `hr_shift_start_time` time NOT NULL,
  `hr_shift_end_time` time NOT NULL,
  `hr_shift_break_time` int(11) DEFAULT NULL,
  `hr_shift_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_shift`
--

INSERT INTO `hr_shift` (`hr_shift_id`, `hr_shift_unit_id`, `hr_shift_name`, `hr_shift_name_bn`, `hr_shift_code`, `hr_shift_start_time`, `hr_shift_end_time`, `hr_shift_break_time`, `hr_shift_status`) VALUES
(3, 3, 'Day', NULL, 'A', '08:00:00', '16:00:00', 34, 1),
(6, 3, 'Day', NULL, 'A1', '08:00:00', '16:00:00', 34, 1),
(7, 3, 'Day', 'bangla3', 'A1', '09:00:00', '15:00:00', 34, 1),
(9, 3, 'Day', 'bangla34', 'A2', '01:00:00', '20:00:00', 34, 1),
(10, 3, 'Day', 'bangla34', 'A3', '01:00:00', '20:00:00', 34, 1),
(11, 3, 'Day', NULL, 'A1', '08:00:00', '16:00:00', 34, 1),
(12, 3, 'Day', 'bangla3455', 'A4', '01:00:00', '20:00:00', 34, 1),
(13, 3, 'Day', 'bangla3455', 'A5', '01:00:00', '20:00:00', 35, 1),
(14, 3, 'Morning', 'bangla', 'B', '07:00:00', '00:00:00', 20, 1),
(15, 3, 'Morning', 'bangla2', 'B1', '08:00:00', '00:00:00', 25, 1),
(16, 3, 'Morning', 'bangla3', 'B2', '08:00:00', '00:00:00', 25, 1),
(17, 3, 'Morning', 'bangla33', 'B3', '08:00:00', '00:00:00', 25, 1),
(18, 3, 'Evening', 'bangla', 'C', '16:00:00', '22:00:00', 40, 1),
(19, 3, 'Evening', 'bangla2', 'C1', '17:00:00', '22:00:00', 43, 1),
(20, 3, 'Evening', 'bangla2', 'C2', '18:00:00', '22:00:00', 50, 1),
(21, 3, 'Day', 'bangla', 'A6', '00:00:00', '18:00:00', 30, 1),
(22, 3, 'Day', 'bangla', 'A7', '11:00:00', '18:00:00', 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_shift_roaster`
--

CREATE TABLE `hr_shift_roaster` (
  `shift_roaster_id` int(11) NOT NULL,
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
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_shift_roaster`
--

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
(42, '18A100010N', 55, 2018, 7, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', '2018-07-19 05:25:27', 0),
(43, '17F005001B', 42, 2018, 8, NULL, NULL, NULL, NULL, NULL, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-06 12:51:53', 0),
(44, '18G100011N', 56, 2018, 8, NULL, NULL, NULL, NULL, NULL, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-06 12:51:53', 0),
(45, '18M100013N', 58, 2018, 8, NULL, NULL, NULL, NULL, NULL, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-06 12:51:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hr_subsection`
--

CREATE TABLE `hr_subsection` (
  `hr_subsec_id` int(11) NOT NULL,
  `hr_subsec_area_id` int(11) DEFAULT NULL,
  `hr_subsec_department_id` int(11) DEFAULT NULL,
  `hr_subsec_section_id` int(11) DEFAULT NULL,
  `hr_subsec_name` varchar(128) DEFAULT NULL,
  `hr_subsec_name_bn` varchar(255) DEFAULT NULL,
  `hr_subsec_code` varchar(10) DEFAULT NULL,
  `hr_subsec_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_subsection`
--

INSERT INTO `hr_subsection` (`hr_subsec_id`, `hr_subsec_area_id`, `hr_subsec_department_id`, `hr_subsec_section_id`, `hr_subsec_name`, `hr_subsec_name_bn`, `hr_subsec_code`, `hr_subsec_status`) VALUES
(21, 2, 25, 21, 'Operator', 'à¦…à¦ªà¦¾à¦°à§‡à¦Ÿà¦°', 'A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_training`
--

CREATE TABLE `hr_training` (
  `tr_id` int(11) NOT NULL,
  `tr_as_tr_id` int(11) NOT NULL,
  `tr_trainer_name` varchar(128) NOT NULL,
  `tr_description` varchar(1024) NOT NULL,
  `tr_start_date` date DEFAULT NULL,
  `tr_start_time` varchar(10) DEFAULT NULL,
  `tr_end_date` date DEFAULT NULL,
  `tr_end_time` varchar(10) DEFAULT NULL,
  `tr_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_training`
--

INSERT INTO `hr_training` (`tr_id`, `tr_as_tr_id`, `tr_trainer_name`, `tr_description`, `tr_start_date`, `tr_start_time`, `tr_end_date`, `tr_end_time`, `tr_status`) VALUES
(1, 1, 'SDGTFDG', 'DSGFDG', '2018-07-22', '10:00', '2018-07-25', '02:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_training_assign`
--

CREATE TABLE `hr_training_assign` (
  `tr_as_id` int(11) NOT NULL,
  `tr_as_tr_id` int(11) NOT NULL,
  `tr_as_ass_id` varchar(10) NOT NULL,
  `tr_as_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_training_assign`
--

INSERT INTO `hr_training_assign` (`tr_as_id`, `tr_as_tr_id`, `tr_as_ass_id`, `tr_as_status`) VALUES
(1, 1, '17F005001B', 1),
(2, 1, '18A100002N', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_training_names`
--

CREATE TABLE `hr_training_names` (
  `hr_tr_name_id` int(11) NOT NULL,
  `hr_tr_name` varchar(255) NOT NULL,
  `hr_tr_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_training_names`
--

INSERT INTO `hr_training_names` (`hr_tr_name_id`, `hr_tr_name`, `hr_tr_status`) VALUES
(1, 'Anti Drug', 1),
(2, 'Safety Committee', 1),
(3, 'Freedom of Association', 1),
(4, 'Root Cause Analysis', 1),
(5, 'Chemical', 1),
(6, 'Security', 1),
(7, 'Waste Management', 1),
(8, 'Cleaner\'s', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_unit`
--

CREATE TABLE `hr_unit` (
  `hr_unit_id` int(11) NOT NULL,
  `hr_unit_name` varchar(128) NOT NULL,
  `hr_unit_short_name` varchar(20) DEFAULT NULL,
  `hr_unit_name_bn` varchar(255) DEFAULT NULL,
  `hr_unit_address` varchar(255) DEFAULT NULL,
  `hr_unit_address_bn` varchar(512) DEFAULT NULL,
  `hr_unit_code` varchar(10) DEFAULT NULL,
  `hr_unit_logo` varchar(255) DEFAULT NULL,
  `hr_unit_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_unit`
--

INSERT INTO `hr_unit` (`hr_unit_id`, `hr_unit_name`, `hr_unit_short_name`, `hr_unit_name_bn`, `hr_unit_address`, `hr_unit_address_bn`, `hr_unit_code`, `hr_unit_logo`, `hr_unit_status`) VALUES
(1, 'MBM Garments Ltd', 'MBM', 'à¦à¦® à¦¬à¦¿ à¦à¦® à¦—à¦¾à¦°à§à¦®à§‡à¦¨à§à¦Ÿà¦¸ à¦²à¦¿à¦®à¦¿à¦Ÿà§‡à¦¡', 'M-19,M-14 SECTION-14,MIRPUR,DHAKA-1206 .', 'à¦à¦® -19, à¦à¦® -14 à¦¬à¦¿à¦­à¦¾à¦— 14, à¦®à¦¿à¦°à¦ªà§à¦°, à¦¢à¦¾à¦•à¦¾ -1à§¨6à§¨6', 'A', '/assets/idcard/5b0e62898d4d8.png', 1),
(2, 'Cutting Edge Industries Ltd', 'CEIL', 'à¦•à¦¾à¦Ÿà¦¿à¦‚ à¦à¦œ  à¦‡à¦¨à§à¦¡à¦¾à¦¸à§à¦Ÿà§à¦°à¦¿à¦¸ à¦²à¦¿à¦®à¦¿à¦Ÿà§‡à¦¡', 'South Salna ,Salna Bazar , Gazipur .', 'à¦¸à¦¾à¦‰à¦¥ à¦¸à¦¾à¦²à¦¨à¦¾ ,à¦¸à¦¾à¦²à¦¨à¦¾ à¦¬à¦¾à¦œà¦¾à¦° , à¦—à¦¾à¦œà§€à¦ªà§à¦° ', 'B', '/assets/idcard/5b0e73c79b9c9.png', 1),
(3, 'Absolute Qualityware Ltd', 'AQL', 'à¦…à§à¦¯à¦¾à¦¬à¦¸à¦²à¦¿à¦‰à¦Ÿ  à¦•à§‹à§Ÿà¦¾à¦²à¦¿à¦Ÿà¦¿  à¦“à§Ÿà§‡à¦° à¦²à¦¿à¦®à¦¿à¦Ÿà§‡à¦¡', 'Salna Bazar , Gazipur .', 'à¦¸à¦¾à¦²à¦¨à¦¾ à¦¬à¦¾à¦œà¦¾à¦° , à¦—à¦¾à¦œà§€à¦ªà§à¦°', 'C', '/assets/idcard/5b0e768ccd436.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_upazilla`
--

CREATE TABLE `hr_upazilla` (
  `upa_id` int(3) NOT NULL,
  `upa_dis_id` int(2) NOT NULL,
  `upa_name` varchar(64) NOT NULL,
  `upa_name_bn` varchar(255) DEFAULT NULL,
  `upa_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_upazilla`
--

INSERT INTO `hr_upazilla` (`upa_id`, `upa_dis_id`, `upa_name`, `upa_name_bn`, `upa_status`) VALUES
(1, 34, 'Amtali', 'à¦†à¦®à¦¤à¦²à§€', 1),
(2, 34, 'Bamna ', 'à¦¬à¦¾à¦®à¦¨à¦¾', 1),
(3, 34, 'Barguna Sadar ', 'à¦¬à¦°à¦—à§à¦¨à¦¾ à¦¸à¦¦à¦°', 1),
(4, 34, 'Betagi ', 'à¦¬à§‡à¦¤à¦¾à¦—à¦¿', 1),
(5, 34, 'Patharghata ', 'à¦ªà¦¾à¦¥à¦°à¦˜à¦¾à¦Ÿà¦¾', 1),
(6, 34, 'Taltali ', 'à¦¤à¦¾à¦²à¦¤à¦²à§€', 1),
(7, 35, 'Muladi ', 'à¦®à§à¦²à¦¾à¦¦à¦¿', 1),
(8, 35, 'Babuganj ', 'à¦¬à¦¾à¦¬à§à¦—à¦žà§à¦œ', 1),
(9, 35, 'Agailjhara ', 'à¦†à¦—à¦¾à¦‡à¦²à¦à¦°à¦¾', 1),
(10, 35, 'Barisal Sadar ', 'à¦¬à¦°à¦¿à¦¶à¦¾à¦² à¦¸à¦¦à¦°', 1),
(11, 35, 'Bakerganj ', 'à¦¬à¦¾à¦•à§‡à¦°à¦—à¦žà§à¦œ', 1),
(12, 35, 'Banaripara ', 'à¦¬à¦¾à¦¨à¦¾à§œà¦¿à¦ªà¦¾à¦°à¦¾', 1),
(13, 35, 'Gaurnadi ', 'à¦—à§Œà¦°à¦¨à¦¦à§€', 1),
(14, 35, 'Hizla ', 'à¦¹à¦¿à¦œà¦²à¦¾', 1),
(15, 35, 'Mehendiganj ', 'à¦®à§‡à¦¹à§‡à¦¦à¦¿à¦—à¦žà§à¦œ ', 1),
(16, 35, 'Wazirpur ', 'à¦“à§Ÿà¦¾à¦œà¦¿à¦°à¦ªà§à¦°', 1),
(17, 36, 'Bhola Sadar ', 'à¦­à§‹à¦²à¦¾ à¦¸à¦¦à¦°', 1),
(18, 36, 'Burhanuddin ', 'à¦¬à§à¦°à¦¹à¦¾à¦¨à¦‰à¦¦à§à¦¦à¦¿à¦¨', 1),
(19, 36, 'Char Fasson ', 'à¦šà¦° à¦«à§à¦¯à¦¾à¦¶à¦¨', 1),
(20, 36, 'Daulatkhan ', 'à¦¦à§Œà¦²à¦¤à¦–à¦¾à¦¨', 1),
(21, 36, 'Lalmohan ', 'à¦²à¦¾à¦²à¦®à§‹à¦¹à¦¨', 1),
(22, 36, 'Manpura ', 'à¦®à¦¨à¦ªà§à¦°à¦¾', 1),
(23, 36, 'Tazumuddin ', 'à¦¤à¦¾à¦œà§à¦®à§à¦¦à§à¦¦à¦¿à¦¨', 1),
(24, 37, 'Jhalokati Sadar ', 'à¦à¦¾à¦²à¦•à¦¾à¦ à¦¿ à¦¸à¦¦à¦°', 1),
(25, 37, 'Kathalia ', 'à¦•à¦¾à¦à¦ à¦¾à¦²à¦¿à§Ÿà¦¾', 1),
(26, 37, 'Nalchity ', 'à¦¨à¦¾à¦²à¦šà¦¿à¦¤à¦¿', 1),
(27, 37, 'Rajapur ', 'à¦°à¦¾à¦œà¦¾à¦ªà§à¦°', 1),
(28, 38, 'Bauphal ', 'à¦¬à¦¾à¦‰à¦«à¦²', 1),
(29, 38, 'Dashmina ', 'à¦¦à¦¶à¦®à¦¿à¦¨à¦¾', 1),
(30, 38, 'Galachipa ', 'à¦—à¦²à¦¾à¦šà¦¿à¦ªà¦¾', 1),
(31, 38, 'Kalapara ', 'à¦•à¦¾à¦²à¦¾à¦ªà¦¾à¦°à¦¾', 1),
(32, 38, 'Mirzaganj ', 'à¦®à¦¿à¦°à§à¦œà¦¾à¦—à¦žà§à¦œ ', 1),
(33, 38, 'Patuakhali Sadar ', 'à¦ªà¦Ÿà§à§Ÿà¦¾à¦–à¦¾à¦²à§€ à¦¸à¦¦à¦°', 1),
(34, 38, 'Dumki ', 'à¦¡à§à¦®à¦•à¦¿', 1),
(35, 38, 'Rangabali ', 'à¦°à¦¾à¦™à§à¦—à¦¾à¦¬à¦¾à¦²à¦¿', 1),
(36, 39, 'Bhandaria', 'à¦­à¦¾à¦¨à§à¦¡à¦¾à¦°à¦¿à§Ÿà¦¾', 1),
(37, 39, 'Kaukhali', 'à¦•à¦¾à¦‰à¦–à¦¾à¦²à¦¿', 1),
(38, 39, 'Mathbaria', 'à¦®à¦¾à¦ à¦¬à¦¾à§œà¦¿à§Ÿà¦¾', 1),
(39, 39, 'Nazirpur', 'à¦¨à¦¾à¦œà¦¿à¦°à¦ªà§à¦°', 1),
(40, 39, 'Nesarabad', 'à¦¨à§‡à¦¸à¦¾à¦°à¦¾à¦¬à¦¾à¦¦', 1),
(41, 39, 'Pirojpur Sadar', 'à¦ªà¦¿à¦°à§‹à¦œà¦ªà§à¦° à¦¸à¦¦à¦°', 1),
(42, 39, 'Zianagar', 'à¦œà¦¿à§Ÿà¦¾à¦¨à¦—à¦°', 1),
(43, 40, 'Bandarban Sadar', 'à¦¬à¦¾à¦¨à§à¦¦à¦°à¦¬à¦¨ à¦¸à¦¦à¦°', 1),
(44, 40, 'Thanchi', 'à¦¥à¦¾à¦¨à¦šà¦¿', 1),
(45, 40, 'Lama', 'à¦²à¦¾à¦®à¦¾', 1),
(46, 40, 'Naikhongchhari', 'à¦¨à¦¾à¦‡à¦–à¦‚à¦›à§œà¦¿ ', 1),
(47, 40, 'Ali kadam', 'à¦†à¦²à§€ à¦•à¦¦à¦®', 1),
(48, 40, 'Rowangchhari', 'à¦°à¦‰à§Ÿà¦¾à¦‚à¦›à§œà¦¿ ', 1),
(49, 40, 'Ruma', 'à¦°à§à¦®à¦¾', 1),
(50, 41, 'Brahmanbaria Sadar ', 'à¦¬à§à¦°à¦¾à¦¹à§à¦®à¦£à¦¬à¦¾à§œà¦¿à§Ÿà¦¾ à¦¸à¦¦à¦°', 1),
(51, 41, 'Ashuganj ', 'à¦†à¦¶à§à¦—à¦žà§à¦œ', 1),
(52, 41, 'Nasirnagar ', 'à¦¨à¦¾à¦¸à¦¿à¦° à¦¨à¦—à¦°', 1),
(53, 41, 'Nabinagar ', 'à¦¨à¦¬à§€à¦¨à¦—à¦°', 1),
(54, 41, 'Sarail ', 'à¦¸à¦°à¦¾à¦‡à¦²', 1),
(55, 41, 'Shahbazpur Town', 'à¦¶à¦¾à¦¹à¦¬à¦¾à¦œà¦ªà§à¦° à¦Ÿà¦¾à¦‰à¦¨', 1),
(56, 41, 'Kasba ', 'à¦•à¦¸à¦¬à¦¾', 1),
(57, 41, 'Akhaura ', 'à¦†à¦–à¦¾à¦‰à¦°à¦¾', 1),
(58, 41, 'Bancharampur ', 'à¦¬à¦¾à¦žà§à¦›à¦¾à¦°à¦¾à¦®à¦ªà§à¦°', 1),
(59, 41, 'Bijoynagar ', 'à¦¬à¦¿à¦œà§Ÿ à¦¨à¦—à¦°', 1),
(60, 42, 'Chandpur Sadar', 'à¦šà¦¾à¦à¦¦à¦ªà§à¦° à¦¸à¦¦à¦°', 1),
(61, 42, 'Faridganj', 'à¦«à¦°à¦¿à¦¦à¦—à¦žà§à¦œ', 1),
(62, 42, 'Haimchar', 'à¦¹à¦¾à¦‡à¦®à¦šà¦°', 1),
(63, 42, 'Haziganj', 'à¦¹à¦¾à¦œà§€à¦—à¦žà§à¦œ', 1),
(64, 42, 'Kachua', 'à¦•à¦šà§à§Ÿà¦¾', 1),
(65, 42, 'Matlab Uttar', 'à¦®à¦¤à¦²à¦¬ à¦‰à¦¤à§à¦¤à¦°', 1),
(66, 42, 'Matlab Dakkhin', 'à¦®à¦¤à¦²à¦¬ à¦¦à¦•à§à¦·à¦¿à¦£', 1),
(67, 42, 'Shahrasti', 'à¦¶à¦¾à¦¹à¦°à¦¾à¦¸à§à¦¤à¦¿', 1),
(68, 43, 'Anwara ', 'à¦†à¦¨à§‹à§Ÿà¦¾à¦°à¦¾', 1),
(69, 43, 'Banshkhali ', 'à¦¬à¦¾à¦¶à¦–à¦¾à¦²à¦¿', 1),
(70, 43, 'Boalkhali ', 'à¦¬à§‹à§Ÿà¦¾à¦²à¦–à¦¾à¦²à¦¿', 1),
(71, 43, 'Chandanaish ', 'à¦šà¦¨à§à¦¦à¦¨à¦¾à¦‡à¦¶', 1),
(72, 43, 'Fatikchhari ', 'à¦«à¦Ÿà¦¿à¦•à¦›à§œà¦¿', 1),
(73, 43, 'Hathazari ', 'à¦¹à¦¾à¦ à¦¹à¦¾à¦œà¦¾à¦°à§€', 1),
(74, 43, 'Lohagara ', 'à¦²à§‹à¦¹à¦¾à¦—à¦¾à¦°à¦¾', 1),
(75, 43, 'Mirsharai ', 'à¦®à¦¿à¦°à¦¸à¦°à¦¾à¦‡', 1),
(76, 43, 'Patiya ', 'à¦ªà¦Ÿà¦¿à§Ÿà¦¾', 1),
(77, 43, 'Rangunia ', 'à¦°à¦¾à¦™à§à¦—à§à¦¨à¦¿à§Ÿà¦¾', 1),
(78, 43, 'Raozan ', 'à¦°à¦¾à¦‰à¦œà¦¾à¦¨', 1),
(79, 43, 'Sandwip ', 'à¦¸à¦¨à§à¦¦à§à¦¬à§€à¦ª', 1),
(80, 43, 'Satkania ', 'à¦¸à¦¾à¦¤à¦•à¦¾à¦¨à¦¿à§Ÿà¦¾', 1),
(81, 43, 'Sitakunda ', 'à¦¸à§€à¦¤à¦¾à¦•à§à¦£à§à¦¡', 1),
(82, 44, 'Barura ', 'à¦¬à§œà§à¦°à¦¾', 1),
(83, 44, 'Brahmanpara ', 'à¦¬à§à¦°à¦¾à¦¹à§à¦®à¦£à¦ªà¦¾à§œà¦¾', 1),
(84, 44, 'Burichong ', 'à¦¬à§à§œà¦¿à¦šà¦‚', 1),
(85, 44, 'Chandina ', 'à¦šà¦¾à¦¨à§à¦¦à¦¿à¦¨à¦¾', 1),
(86, 44, 'Chauddagram ', 'à¦šà§Œà¦¦à§à¦¦à¦—à§à¦°à¦¾à¦®', 1),
(87, 44, 'Daudkandi ', 'à¦¦à¦¾à¦‰à¦¦à¦•à¦¾à¦¨à§à¦¦à¦¿', 1),
(88, 44, 'Debidwar ', 'à¦¦à§‡à¦¬à§€à¦¦à§à¦¬à¦¾à¦°', 1),
(89, 44, 'Homna ', 'à¦¹à§‹à¦®à¦¨à¦¾', 1),
(90, 44, 'Comilla Sadar ', 'à¦•à§à¦®à¦¿à¦²à§à¦²à¦¾ à¦¸à¦¦à¦°', 1),
(91, 44, 'Laksam ', 'à¦²à¦¾à¦•à¦¸à¦¾à¦®', 1),
(92, 44, 'Monohorgonj ', 'à¦®à¦¨à§‹à¦¹à¦°à¦—à¦žà§à¦œ', 1),
(93, 44, 'Meghna ', 'à¦®à§‡à¦˜à¦¨à¦¾', 1),
(94, 44, 'Muradnagar ', 'à¦®à§à¦°à¦¾à¦¦à¦¨à¦—à¦°', 1),
(95, 44, 'Nangalkot ', 'à¦¨à¦¾à¦™à§à¦—à¦¾à¦²à¦•à§‹à¦Ÿ', 1),
(96, 44, 'Comilla Sadar South ', 'à¦•à§à¦®à¦¿à¦²à§à¦²à¦¾ à¦¸à¦¦à¦° à¦¦à¦•à§à¦·à¦¿à¦£', 1),
(97, 44, 'Titas ', 'à¦¤à¦¿à¦¤à¦¾à¦¸', 1),
(98, 45, 'Chakaria ', 'à¦šà¦•à¦°à¦¿à§Ÿà¦¾', 1),
(99, 45, 'Chakaria ', 'à¦šà¦•à¦°à¦¿à§Ÿà¦¾', 1),
(100, 45, 'Cox\'s Bazar Sadar ', 'à¦•à¦•à§à¦¸à¦¬à¦¾à¦œà¦¾à¦° à¦¸à¦¦à¦°', 1),
(101, 45, 'Kutubdia ', 'à¦•à§à¦¤à§à¦¬à¦¦à¦¿à§Ÿà¦¾', 1),
(102, 45, 'Maheshkhali ', 'à¦®à¦¹à§‡à¦¶à¦–à¦¾à¦²à§€', 1),
(103, 45, 'Ramu ', 'à¦°à¦¾à¦®à§', 1),
(104, 45, 'Teknaf ', 'à¦Ÿà§‡à¦•à¦¨à¦¾à¦«', 1),
(105, 45, 'Ukhia ', 'à¦‰à¦–à¦¿à§Ÿà¦¾', 1),
(106, 45, 'Pekua ', 'à¦ªà§‡à¦•à§à§Ÿà¦¾', 1),
(107, 46, 'Feni Sadar', 'à¦«à§‡à¦¨à§€ à¦¸à¦¦à¦°', 1),
(108, 46, 'Chagalnaiya', 'à¦›à¦¾à¦—à¦² à¦¨à¦¾à¦‡à§Ÿà¦¾', 1),
(109, 46, 'Daganbhyan', 'à¦¦à¦¾à¦—à¦¾à¦¨à¦­à¦¿à§Ÿà¦¾', 1),
(110, 46, 'Parshuram', 'à¦ªà¦°à¦¶à§à¦°à¦¾à¦®', 1),
(111, 46, 'Fhulgazi', 'à¦«à§à¦²à¦—à¦¾à¦œà¦¿', 1),
(112, 46, 'Sonagazi', 'à¦¸à§‹à¦¨à¦¾à¦—à¦¾à¦œà¦¿', 1),
(113, 47, 'Dighinala ', 'à¦¦à¦¿à¦˜à¦¿à¦¨à¦¾à¦²à¦¾ ', 1),
(114, 47, 'Khagrachhari ', 'à¦–à¦¾à¦—à§œà¦¾à¦›à§œà¦¿', 1),
(115, 47, 'Lakshmichhari ', 'à¦²à¦•à§à¦·à§à¦®à§€à¦›à§œà¦¿', 1),
(116, 47, 'Mahalchhari ', 'à¦®à¦¹à¦²à¦›à§œà¦¿', 1),
(117, 47, 'Manikchhari ', 'à¦®à¦¾à¦¨à¦¿à¦•à¦›à§œà¦¿', 1),
(118, 47, 'Matiranga ', 'à¦®à¦¾à¦Ÿà¦¿à¦°à¦¾à¦™à§à¦—à¦¾', 1),
(119, 47, 'Panchhari ', 'à¦ªà¦¾à¦¨à¦›à§œà¦¿', 1),
(120, 47, 'Ramgarh ', 'à¦°à¦¾à¦®à¦—à§œ', 1),
(121, 48, 'Lakshmipur Sadar ', 'à¦²à¦•à§à¦·à§à¦®à§€à¦ªà§à¦° à¦¸à¦¦à¦°', 1),
(122, 48, 'Raipur ', 'à¦°à¦¾à§Ÿà¦ªà§à¦°', 1),
(123, 48, 'Ramganj ', 'à¦°à¦¾à¦®à¦—à¦žà§à¦œ', 1),
(124, 48, 'Ramgati ', 'à¦°à¦¾à¦®à¦—à¦¤à¦¿', 1),
(125, 48, 'Komol Nagar ', 'à¦•à¦®à¦² à¦¨à¦—à¦°', 1),
(126, 49, 'Noakhali Sadar ', 'à¦¨à§‹à§Ÿà¦¾à¦–à¦¾à¦²à§€ à¦¸à¦¦à¦°', 1),
(127, 49, 'Begumganj ', 'à¦¬à§‡à¦—à¦®à¦—à¦žà§à¦œ', 1),
(128, 49, 'Chatkhil ', 'à¦šà¦¾à¦Ÿà¦–à¦¿à¦²', 1),
(129, 49, 'Companyganj ', 'à¦•à§‹à¦®à§à¦ªà¦¾à¦¨à§€à¦—à¦žà§à¦œ', 1),
(130, 49, 'Shenbag ', 'à¦¸à§‡à¦¨à¦¬à¦¾à¦—', 1),
(131, 49, 'Hatia ', 'à¦¹à¦¾à¦¤à¦¿à§Ÿà¦¾', 1),
(132, 49, 'Kobirhat ', 'à¦•à¦¬à¦¿à¦°à¦¹à¦¾à¦Ÿ ', 1),
(133, 49, 'Sonaimuri ', 'à¦¸à§‹à¦¨à¦¾à¦‡à¦®à§à¦°à¦¿', 1),
(134, 49, 'Suborno Char ', 'à¦¸à§à¦¬à¦°à§à¦£ à¦šà¦° ', 1),
(135, 50, 'Rangamati Sadar ', 'à¦°à¦¾à¦™à§à¦—à¦¾à¦®à¦¾à¦Ÿà¦¿ à¦¸à¦¦à¦°', 1),
(136, 50, 'Belaichhari ', 'à¦¬à§‡à¦²à¦¾à¦‡à¦›à§œà¦¿', 1),
(137, 50, 'Bagaichhari ', 'à¦¬à¦¾à¦˜à¦¾à¦‡à¦›à§œà¦¿', 1),
(138, 50, 'Barkal ', 'à¦¬à¦°à¦•à¦²', 1),
(139, 50, 'Juraichhari ', 'à¦œà§à¦°à¦¾à¦‡à¦›à§œà¦¿', 1),
(140, 50, 'Rajasthali ', 'à¦°à¦¾à¦œà¦¾à¦¸à§à¦¥à¦²à¦¿', 1),
(141, 50, 'Kaptai ', 'à¦•à¦¾à¦ªà§à¦¤à¦¾à¦‡', 1),
(142, 50, 'Langadu ', 'à¦²à¦¾à¦™à§à¦—à¦¾à¦¡à§', 1),
(143, 50, 'Nannerchar ', 'à¦¨à¦¾à¦¨à§à¦¨à§‡à¦°à¦šà¦° ', 1),
(144, 50, 'Kaukhali ', 'à¦•à¦¾à¦‰à¦–à¦¾à¦²à¦¿', 1),
(145, 2, 'Faridpur Sadar ', 'à¦«à¦°à¦¿à¦¦à¦ªà§à¦° à¦¸à¦¦à¦°', 1),
(146, 2, 'Boalmari ', 'à¦¬à§‹à§Ÿà¦¾à¦²à¦®à¦¾à¦°à§€', 1),
(147, 2, 'Alfadanga ', 'à¦†à¦²à¦«à¦¾à¦¡à¦¾à¦™à§à¦—à¦¾', 1),
(148, 2, 'Madhukhali ', 'à¦®à¦§à§à¦–à¦¾à¦²à¦¿', 1),
(149, 2, 'Bhanga ', 'à¦­à¦¾à¦™à§à¦—à¦¾', 1),
(150, 2, 'Nagarkanda ', 'à¦¨à¦—à¦°à¦•à¦¾à¦¨à§à¦¡', 1),
(151, 2, 'Charbhadrasan ', 'à¦šà¦°à¦­à¦¦à§à¦°à¦¾à¦¸à¦¨ ', 1),
(152, 2, 'Sadarpur ', 'à¦¸à¦¦à¦°à¦ªà§à¦°', 1),
(153, 2, 'Shaltha ', 'à¦¶à¦¾à¦²à¦¥à¦¾', 1),
(154, 3, 'Gazipur Sadar-Joydebpur', 'à¦—à¦¾à¦œà§€à¦ªà§à¦° à¦¸à¦¦à¦°', 1),
(155, 3, 'Kaliakior', 'à¦•à¦¾à¦²à¦¿à§Ÿà¦¾à¦•à§ˆà¦°', 1),
(156, 3, 'Kapasia', 'à¦•à¦¾à¦ªà¦¾à¦¸à¦¿à§Ÿà¦¾', 1),
(157, 3, 'Sripur', 'à¦¶à§à¦°à§€à¦ªà§à¦°', 1),
(158, 3, 'Kaliganj', 'à¦•à¦¾à¦²à§€à¦—à¦žà§à¦œ', 1),
(159, 3, 'Tongi', 'à¦Ÿà¦™à§à¦—à¦¿', 1),
(160, 4, 'Gopalganj Sadar ', 'à¦—à§‹à¦ªà¦¾à¦²à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', 1),
(161, 4, 'Kashiani ', 'à¦•à¦¾à¦¶à¦¿à§Ÿà¦¾à¦¨à¦¿', 1),
(162, 4, 'Kotalipara ', 'à¦•à§‹à¦Ÿà¦¾à¦²à¦¿à¦ªà¦¾à§œà¦¾', 1),
(163, 4, 'Muksudpur ', 'à¦®à§à¦•à¦¸à§à¦¦à¦ªà§à¦°', 1),
(164, 4, 'Tungipara ', 'à¦Ÿà§à¦™à§à¦—à¦¿à¦ªà¦¾à§œà¦¾', 1),
(165, 5, 'Dewanganj ', 'à¦¦à§‡à¦“à§Ÿà¦¾à¦¨à¦—à¦žà§à¦œ', 1),
(166, 5, 'Baksiganj ', 'à¦¬à¦•à¦¸à¦¿à¦—à¦žà§à¦œ', 1),
(167, 5, 'Islampur ', 'à¦‡à¦¸à¦²à¦¾à¦®à¦ªà§à¦°', 1),
(168, 5, 'Jamalpur Sadar ', 'à¦œà¦¾à¦®à¦¾à¦²à¦ªà§à¦° à¦¸à¦¦à¦°', 1),
(169, 5, 'Madarganj ', 'à¦®à¦¾à¦¦à¦¾à¦°à¦—à¦žà§à¦œ', 1),
(170, 5, 'Melandaha ', 'à¦®à§‡à¦²à¦¾à¦¨à¦¦à¦¾à¦¹à¦¾', 1),
(171, 5, 'Sarishabari ', 'à¦¸à¦°à¦¿à¦·à¦¾à¦¬à¦¾à§œà¦¿ ', 1),
(172, 5, 'Narundi Police I.C', 'à¦¨à¦¾à¦°à§à¦¨à§à¦¦à¦¿', 1),
(173, 6, 'Astagram ', 'à¦…à¦·à§à¦Ÿà¦—à§à¦°à¦¾à¦®', 1),
(174, 6, 'Bajitpur ', 'à¦¬à¦¾à¦œà¦¿à¦¤à¦ªà§à¦°', 1),
(175, 6, 'Bhairab ', 'à¦­à§ˆà¦°à¦¬', 1),
(176, 6, 'Hossainpur ', 'à¦¹à§‹à¦¸à§‡à¦¨à¦ªà§à¦° ', 1),
(177, 6, 'Itna ', 'à¦‡à¦Ÿà¦¨à¦¾', 1),
(178, 6, 'Karimganj ', 'à¦•à¦°à¦¿à¦®à¦—à¦žà§à¦œ', 1),
(179, 6, 'Katiadi ', 'à¦•à¦¤à¦¿à§Ÿà¦¾à¦¦à¦¿', 1),
(180, 6, 'Kishoreganj Sadar ', 'à¦•à¦¿à¦¶à§‹à¦°à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', 1),
(181, 6, 'Kuliarchar ', 'à¦•à§à¦²à¦¿à§Ÿà¦¾à¦°à¦šà¦°', 1),
(182, 6, 'Mithamain ', 'à¦®à¦¿à¦ à¦¾à¦®à¦¾à¦‡à¦¨', 1),
(183, 6, 'Nikli ', 'à¦¨à¦¿à¦•à¦²à¦¿', 1),
(184, 6, 'Pakundia ', 'à¦ªà¦¾à¦•à§à¦¨à§à¦¡à¦¾', 1),
(185, 6, 'Tarail ', 'à¦¤à¦¾à§œà¦¾à¦‡à¦²', 1),
(186, 7, 'Madaripur Sadar', 'à¦®à¦¾à¦¦à¦¾à¦°à§€à¦ªà§à¦° à¦¸à¦¦à¦°', 1),
(187, 7, 'Kalkini', 'à¦•à¦¾à¦²à¦•à¦¿à¦¨à¦¿', 1),
(188, 7, 'Rajoir', 'à¦°à¦¾à¦œà¦‡à¦°', 1),
(189, 7, 'Shibchar', 'à¦¶à¦¿à¦¬à¦šà¦°', 1),
(190, 8, 'Manikganj Sadar ', 'à¦®à¦¾à¦¨à¦¿à¦•à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', 1),
(191, 8, 'Singair ', 'à¦¸à¦¿à¦™à§à¦—à¦¾à¦‡à¦°', 1),
(192, 8, 'Shibalaya ', 'à¦¶à¦¿à¦¬à¦¾à¦²à§Ÿ', 1),
(193, 8, 'Saturia ', 'à¦¸à¦¾à¦Ÿà§à¦°à¦¿à§Ÿà¦¾', 1),
(194, 8, 'Harirampur ', 'à¦¹à¦°à¦¿à¦°à¦¾à¦®à¦ªà§à¦°', 1),
(195, 8, 'Ghior ', 'à¦˜à¦¿à¦“à¦°', 1),
(196, 8, 'Daulatpur ', 'à¦¦à§Œà¦²à¦¤à¦ªà§à¦°', 1),
(197, 9, 'Lohajang ', 'à¦²à§‹à¦¹à¦¾à¦œà¦‚', 1),
(198, 9, 'Sreenagar ', 'à¦¶à§à¦°à§€à¦¨à¦—à¦°', 1),
(199, 9, 'Munshiganj Sadar ', 'à¦®à§à¦¨à§à¦¸à¦¿à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', 1),
(200, 9, 'Sirajdikhan ', 'à¦¸à¦¿à¦°à¦¾à¦œà¦¦à¦¿à¦–à¦¾à¦¨', 1),
(201, 9, 'Tongibari ', 'à¦Ÿà¦™à§à¦—à¦¿à¦¬à¦¾à§œà¦¿', 1),
(202, 9, 'Gazaria ', 'à¦—à¦œà¦¾à¦°à¦¿à§Ÿà¦¾', 1),
(203, 10, 'Bhaluka', 'à¦­à¦¾à¦²à§à¦•à¦¾', 1),
(204, 10, 'Trishal', 'à¦¤à§à¦°à¦¿à¦¶à¦¾à¦²', 1),
(205, 10, 'Haluaghat', 'à¦¹à¦¾à¦²à§à§Ÿà¦¾à¦˜à¦¾à¦Ÿ', 1),
(206, 10, 'Muktagachha', 'à¦®à§à¦•à§à¦¤à¦¾à¦—à¦¾à¦›à¦¾', 1),
(207, 10, 'Dhobaura', 'à¦§à§‹à¦¬à¦¾à¦‰à¦°à¦¾', 1),
(208, 10, 'Fulbaria', 'à¦«à§à¦²à¦¬à¦¾à§œà¦¿à§Ÿà¦¾', 1),
(209, 10, 'Gaffargaon', 'à¦—à¦«à¦°à¦—à¦¾à¦à¦“', 1),
(210, 10, 'Gauripur', 'à¦—à§Œà¦°à¦¿à¦ªà§à¦°', 1),
(211, 10, 'Ishwarganj', 'à¦ˆà¦¶à§à¦¬à¦°à¦—à¦žà§à¦œ', 1),
(212, 10, 'Mymensingh Sadar', 'à¦®à§Ÿà¦®à¦¨à¦¸à¦¿à¦‚ à¦¸à¦¦à¦°', 1),
(213, 10, 'Nandail', 'à¦¨à¦¨à§à¦¦à¦¾à¦‡à¦²', 1),
(214, 10, 'Phulpur', 'à¦«à§à¦²à¦ªà§à¦°', 1),
(215, 11, 'Araihazar ', 'à¦†à§œà¦¾à¦‡à¦¹à¦¾à¦œà¦¾à¦°', 1),
(216, 11, 'Sonargaon ', 'à¦¸à§‹à¦¨à¦¾à¦°à¦—à¦¾à¦à¦“', 1),
(217, 11, 'Bandar', 'à¦¬à¦¨à§à¦¦à¦°', 1),
(218, 11, 'Naryanganj Sadar ', 'à¦¨à¦¾à¦°à¦¾à§Ÿà¦¾à¦¨à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', 1),
(219, 11, 'Rupganj ', 'à¦°à§‚à¦ªà¦—à¦žà§à¦œ', 1),
(220, 11, 'Siddirgonj ', 'à¦¸à¦¿à¦¦à§à¦§à¦¿à¦°à¦—à¦žà§à¦œ', 1),
(221, 12, 'Belabo ', 'à¦¬à§‡à¦²à¦¾à¦¬à§‹', 1),
(222, 12, 'Monohardi ', 'à¦®à¦¨à§‹à¦¹à¦°à¦¦à¦¿', 1),
(223, 12, 'Narsingdi Sadar ', 'à¦¨à¦°à¦¸à¦¿à¦‚à¦¦à§€ à¦¸à¦¦à¦°', 1),
(224, 12, 'Palash ', 'à¦ªà¦²à¦¾à¦¶', 1),
(225, 12, 'Raipura', 'Narsingdi', 1),
(226, 12, 'Shibpur ', 'à¦¶à¦¿à¦¬à¦ªà§à¦°', 1),
(227, 13, 'Kendua Upazilla', 'à¦•à§‡à¦¨à§à¦¦à§à§Ÿà¦¾', 1),
(228, 13, 'Atpara Upazilla', 'à¦†à¦Ÿà¦ªà¦¾à§œà¦¾', 1),
(229, 13, 'Barhatta', 'à¦¬à¦°à¦¹à¦¾à¦Ÿà§à¦Ÿà¦¾', 1),
(230, 13, 'Durgapur Upazilla', 'à¦¦à§à¦°à§à¦—à¦¾à¦ªà§à¦°', 1),
(231, 13, 'Kalmakanda Upazilla', 'à¦•à¦²à¦®à¦¾à¦•à¦¾à¦¨à§à¦¦à¦¾', 1),
(232, 13, 'Madan Upazilla', 'à¦®à¦¦à¦¨', 1),
(233, 13, 'Mohanganj Upazilla', 'à¦®à§‹à¦¹à¦¨à¦—à¦žà§à¦œ', 1),
(234, 13, 'Netrakona-S Upazilla', 'à¦¨à§‡à¦¤à§à¦°à¦•à§‹à¦¨à¦¾ à¦¸à¦¦à¦°', 1),
(235, 13, 'Purbadhala Upazilla', 'à¦ªà§‚à¦°à§à¦¬à¦§à¦²à¦¾', 1),
(236, 13, 'Khaliajuri Upazilla', 'à¦–à¦¾à¦²à¦¿à§Ÿà¦¾à¦œà§à¦°à¦¿', 1),
(237, 14, 'Baliakandi ', 'à¦¬à¦¾à¦²à¦¿à§Ÿà¦¾à¦•à¦¾à¦¨à§à¦¦à¦¿', 1),
(238, 14, 'Goalandaghat ', 'à¦—à§‹à§Ÿà¦¾à¦²à¦¨à§à¦¦ à¦˜à¦¾à¦Ÿ', 1),
(239, 14, 'Pangsha ', 'à¦ªà¦¾à¦‚à¦¶à¦¾', 1),
(240, 14, 'Kalukhali ', 'à¦•à¦¾à¦²à§à¦–à¦¾à¦²à¦¿', 1),
(241, 14, 'Rajbari Sadar ', 'à¦°à¦¾à¦œà¦¬à¦¾à§œà¦¿ à¦¸à¦¦à¦°', 1),
(242, 15, 'Shariatpur Sadar -Palong', 'à¦¶à¦°à§€à§Ÿà¦¤à¦ªà§à¦° à¦¸à¦¦à¦° ', 1),
(243, 15, 'Damudya ', 'à¦¡à¦¾à¦®à§à¦¡à§à¦¡à¦¾', 1),
(244, 15, 'Naria ', 'à¦¨à§œà¦¿à§Ÿà¦¾', 1),
(245, 15, 'Jajira ', 'à¦œà¦¾à¦œà¦¿à¦°à¦¾', 1),
(246, 15, 'Bhedarganj ', 'à¦­à§‡à¦¦à¦¾à¦°à¦—à¦žà§à¦œ', 1),
(247, 15, 'Gosairhat ', 'à¦—à§‹à¦¸à¦¾à¦‡à¦° à¦¹à¦¾à¦Ÿ ', 1),
(248, 16, 'Jhenaigati ', 'à¦à¦¿à¦¨à¦¾à¦‡à¦—à¦¾à¦¤à¦¿', 1),
(249, 16, 'Nakla ', 'à¦¨à¦¾à¦•à¦²à¦¾', 1),
(250, 16, 'Nalitabari ', 'à¦¨à¦¾à¦²à¦¿à¦¤à¦¾à¦¬à¦¾à§œà¦¿', 1),
(251, 16, 'Sherpur Sadar ', 'à¦¶à§‡à¦°à¦ªà§à¦° à¦¸à¦¦à¦°', 1),
(252, 16, 'Sreebardi ', 'à¦¶à§à¦°à§€à¦¬à¦°à¦¦à¦¿', 1),
(253, 17, 'Tangail Sadar ', 'à¦Ÿà¦¾à¦™à§à¦—à¦¾à¦‡à¦² à¦¸à¦¦à¦°', 1),
(254, 17, 'Sakhipur ', 'à¦¸à¦–à¦¿à¦ªà§à¦°', 1),
(255, 17, 'Basail ', 'à¦¬à¦¸à¦¾à¦‡à¦²', 1),
(256, 17, 'Madhupur ', 'à¦®à¦§à§à¦ªà§à¦°', 1),
(257, 17, 'Ghatail ', 'à¦˜à¦¾à¦Ÿà¦¾à¦‡à¦²', 1),
(258, 17, 'Kalihati ', 'à¦•à¦¾à¦²à¦¿à¦¹à¦¾à¦¤à¦¿', 1),
(259, 17, 'Nagarpur ', 'à¦¨à¦—à¦°à¦ªà§à¦°', 1),
(260, 17, 'Mirzapur ', 'à¦®à¦¿à¦°à§à¦œà¦¾à¦ªà§à¦°', 1),
(261, 17, 'Gopalpur ', 'à¦—à§‹à¦ªà¦¾à¦²à¦ªà§à¦°', 1),
(262, 17, 'Delduar ', 'à¦¦à§‡à¦²à¦¦à§à§Ÿà¦¾à¦°', 1),
(263, 17, 'Bhuapur ', 'à¦­à§à§Ÿà¦¾à¦ªà§à¦°', 1),
(264, 17, 'Dhanbari ', 'à¦§à¦¾à¦¨à¦¬à¦¾à§œà¦¿', 1),
(265, 55, 'Bagerhat Sadar ', 'à¦¬à¦¾à¦—à§‡à¦°à¦¹à¦¾à¦Ÿ à¦¸à¦¦à¦°', 1),
(266, 55, 'Chitalmari ', 'à¦šà¦¿à¦¤à¦²à¦®à¦¾à§œà¦¿', 1),
(267, 55, 'Fakirhat ', 'à¦«à¦•à¦¿à¦°à¦¹à¦¾à¦Ÿ', 1),
(268, 55, 'Kachua ', 'à¦•à¦šà§à§Ÿà¦¾', 1),
(269, 55, 'Mollahat ', 'à¦®à§‹à¦²à§à¦²à¦¾à¦¹à¦¾à¦Ÿ ', 1),
(270, 55, 'Mongla ', 'à¦®à¦‚à¦²à¦¾', 1),
(271, 55, 'Morrelganj ', 'à¦®à¦°à§‡à¦²à¦—à¦žà§à¦œ', 1),
(272, 55, 'Rampal ', 'à¦°à¦¾à¦®à¦ªà¦¾à¦²', 1),
(273, 55, 'Sarankhola ', 'à¦¸à§à¦®à¦°à¦£à¦–à§‹à¦²à¦¾', 1),
(274, 56, 'Damurhuda ', 'à¦¦à¦¾à¦®à§à¦°à¦¹à§à¦¦à¦¾', 1),
(275, 56, 'Chuadanga Shadar', 'à¦šà§à§Ÿà¦¾à¦¡à¦¾à¦™à§à¦—à¦¾ à¦¸à¦¦à¦°', 1),
(276, 56, 'Jibannagar ', 'à¦œà§€à¦¬à¦¨ à¦¨à¦—à¦° ', 1),
(277, 56, 'Alamdanga ', 'à¦†à¦²à¦®à¦¡à¦¾à¦™à§à¦—à¦¾', 1),
(278, 57, 'Abhaynagar ', 'à¦…à¦­à§Ÿà¦¨à¦—à¦°', 1),
(279, 57, 'Keshabpur ', 'à¦•à§‡à¦¶à¦¬à¦ªà§à¦°', 1),
(280, 57, 'Bagherpara ', 'à¦¬à¦¾à¦˜à§‡à¦° à¦ªà¦¾à§œà¦¾ ', 1),
(281, 57, 'Jessore Sadar ', 'à¦¯à¦¶à§‹à¦° à¦¸à¦¦à¦°', 1),
(282, 57, 'Chaugachha ', 'à¦šà§Œà¦—à¦¾à¦›à¦¾', 1),
(283, 57, 'Manirampur ', 'à¦®à¦¨à¦¿à¦°à¦¾à¦®à¦ªà§à¦° ', 1),
(284, 57, 'Jhikargachha ', 'à¦à¦¿à¦•à¦°à¦—à¦¾à¦›à¦¾', 1),
(285, 57, 'Sharsha ', 'à¦¸à¦¾à¦°à¦¶à¦¾', 1),
(286, 58, 'Jhenaidah Sadar ', 'à¦à¦¿à¦¨à¦¾à¦‡à¦¦à¦¹ à¦¸à¦¦à¦°', 1),
(287, 58, 'Maheshpur ', 'à¦®à¦¹à§‡à¦¶à¦ªà§à¦°', 1),
(288, 58, 'Kaliganj ', 'à¦•à¦¾à¦²à§€à¦—à¦žà§à¦œ', 1),
(289, 58, 'Kotchandpur ', 'à¦•à§‹à¦Ÿ à¦šà¦¾à¦à¦¦à¦ªà§à¦° ', 1),
(290, 58, 'Shailkupa ', 'à¦¶à§ˆà¦²à¦•à§à¦ªà¦¾', 1),
(291, 58, 'Harinakunda ', 'à¦¹à¦¾à§œà¦¿à¦¨à¦¾à¦•à§à¦¨à§à¦¦à¦¾', 1),
(292, 59, 'Terokhada ', 'à¦¤à§‡à¦°à§‹à¦–à¦¾à¦¦à¦¾', 1),
(293, 59, 'Batiaghata ', 'à¦¬à¦¾à¦Ÿà¦¿à§Ÿà¦¾à¦˜à¦¾à¦Ÿà¦¾ ', 1),
(294, 59, 'Dacope ', 'à¦¡à¦¾à¦•à¦ªà§‡', 1),
(295, 59, 'Dumuria ', 'à¦¡à§à¦®à§à¦°à¦¿à§Ÿà¦¾', 1),
(296, 59, 'Dighalia ', 'à¦¦à¦¿à¦˜à¦²à¦¿à§Ÿà¦¾', 1),
(297, 59, 'Koyra ', 'à¦•à§Ÿà§œà¦¾', 1),
(298, 59, 'Paikgachha ', 'à¦ªà¦¾à¦‡à¦•à¦—à¦¾à¦›à¦¾', 1),
(299, 59, 'Phultala ', 'à¦«à§à¦²à¦¤à¦²à¦¾', 1),
(300, 59, 'Rupsa ', 'à¦°à§‚à¦ªà¦¸à¦¾', 1),
(301, 60, 'Kushtia Sadar', 'à¦•à§à¦·à§à¦Ÿà¦¿à§Ÿà¦¾ à¦¸à¦¦à¦°', 1),
(302, 60, 'Kumarkhali', 'à¦•à§à¦®à¦¾à¦°à¦–à¦¾à¦²à¦¿', 1),
(303, 60, 'Daulatpur', 'à¦¦à§Œà¦²à¦¤à¦ªà§à¦°', 1),
(304, 60, 'Mirpur', 'à¦®à¦¿à¦°à¦ªà§à¦°', 1),
(305, 60, 'Bheramara', 'à¦­à§‡à¦°à¦¾à¦®à¦¾à¦°à¦¾', 1),
(306, 60, 'Khoksa', 'à¦–à§‹à¦•à¦¸à¦¾', 1),
(307, 61, 'Magura Sadar ', 'à¦®à¦¾à¦—à§à¦°à¦¾ à¦¸à¦¦à¦°', 1),
(308, 61, 'Mohammadpur ', 'à¦®à§‹à¦¹à¦¾à¦®à§à¦®à¦¾à¦¦à¦ªà§à¦°', 1),
(309, 61, 'Shalikha ', 'à¦¶à¦¾à¦²à¦¿à¦–à¦¾', 1),
(310, 61, 'Sreepur ', 'à¦¶à§à¦°à§€à¦ªà§à¦°', 1),
(311, 62, 'Angni', 'à¦†à¦‚à¦¨à¦¿', 1),
(312, 62, 'Mujib Nagar ', 'à¦®à§à¦œà¦¿à¦¬ à¦¨à¦—à¦°', 1),
(313, 62, 'Meherpur-S ', 'à¦®à§‡à¦¹à§‡à¦°à¦ªà§à¦° à¦¸à¦¦à¦°', 1),
(314, 63, 'Narail-S Upazilla', 'à¦¨à§œà¦¾à¦‡à¦² à¦¸à¦¦à¦°', 1),
(315, 63, 'Lohagara Upazilla', 'à¦²à§‹à¦¹à¦¾à¦—à¦¾à§œà¦¾', 1),
(316, 63, 'Kalia Upazilla', 'à¦•à¦¾à¦²à¦¿à§Ÿà¦¾', 1),
(317, 64, 'Satkhira Sadar ', 'à¦¸à¦¾à¦¤à¦•à§à¦·à§€à¦°à¦¾ à¦¸à¦¦à¦°', 1),
(318, 64, 'Assasuni ', 'à¦†à¦¸à¦¸à¦¾à¦¶à§à¦¨à¦¿ ', 1),
(319, 64, 'Debhata ', 'à¦¦à§‡à¦­à¦¾à¦Ÿà¦¾', 1),
(320, 64, 'Tala ', 'à¦¤à¦¾à¦²à¦¾', 1),
(321, 64, 'Kalaroa ', 'à¦•à¦²à¦°à§‹à§Ÿà¦¾', 1),
(322, 64, 'Kaliganj ', 'à¦•à¦¾à¦²à§€à¦—à¦žà§à¦œ', 1),
(323, 64, 'Shyamnagar ', 'à¦¶à§à¦¯à¦¾à¦®à¦¨à¦—à¦°', 1),
(324, 18, 'Adamdighi', 'à¦†à¦¦à¦®à¦¦à¦¿à¦˜à§€', 1),
(325, 18, 'Bogra Sadar', 'à¦¬à¦—à§à§œà¦¾ à¦¸à¦¦à¦°', 1),
(326, 18, 'Sherpur', 'à¦¶à§‡à¦°à¦ªà§à¦°', 1),
(327, 18, 'Dhunat', 'à¦§à§à¦¨à¦Ÿ', 1),
(328, 18, 'Dhupchanchia', 'à¦¦à§à¦ªà¦šà¦¾à¦šà¦¿à§Ÿà¦¾', 1),
(329, 18, 'Gabtali', 'à¦—à¦¾à¦¬à¦¤à¦²à¦¿', 1),
(330, 18, 'Kahaloo', 'à¦•à¦¾à¦¹à¦¾à¦²à§', 1),
(331, 18, 'Nandigram', 'à¦¨à¦¨à§à¦¦à¦¿à¦—à§à¦°à¦¾à¦®', 1),
(332, 18, 'Sahajanpur', 'à¦¶à¦¾à¦¹à¦œà¦¾à¦¹à¦¾à¦¨à¦ªà§à¦°', 1),
(333, 18, 'Sariakandi', 'à¦¸à¦¾à¦°à¦¿à§Ÿà¦¾à¦•à¦¾à¦¨à§à¦¦à¦¿', 1),
(334, 18, 'Shibganj', 'à¦¶à¦¿à¦¬à¦—à¦žà§à¦œ', 1),
(335, 18, 'Sonatala', 'à¦¸à§‹à¦¨à¦¾à¦¤à¦²à¦¾', 1),
(336, 19, 'Joypurhat S', 'à¦œà§Ÿà¦ªà§à¦°à¦¹à¦¾à¦Ÿ à¦¸à¦¦à¦°', 1),
(337, 19, 'Akkelpur', 'à¦†à¦•à§à¦•à§‡à¦²à¦ªà§à¦°', 1),
(338, 19, 'Kalai', 'à¦•à¦¾à¦²à¦¾à¦‡', 1),
(339, 19, 'Khetlal', 'à¦–à§‡à¦¤à¦²à¦¾à¦²', 1),
(340, 19, 'Panchbibi', 'à¦ªà¦¾à¦à¦šà¦¬à¦¿à¦¬à¦¿', 1),
(341, 20, 'Naogaon Sadar ', 'à¦¨à¦“à¦—à¦¾à¦ à¦¸à¦¦à¦°', 1),
(342, 20, 'Mohadevpur ', 'à¦®à¦¹à¦¾à¦¦à§‡à¦¬à¦ªà§à¦°', 1),
(343, 20, 'Manda ', 'à¦®à¦¾à¦¨à§à¦¦à¦¾', 1),
(344, 20, 'Niamatpur ', 'à¦¨à¦¿à§Ÿà¦¾à¦®à¦¤à¦ªà§à¦°', 1),
(345, 20, 'Atrai ', 'à¦†à¦¤à§à¦°à¦¾à¦‡', 1),
(346, 20, 'Raninagar ', 'à¦°à¦¾à¦£à§€à¦¨à¦—à¦°', 1),
(347, 20, 'Patnitala ', 'à¦ªà¦¤à§à¦¨à§€à¦¤à¦²à¦¾', 1),
(348, 20, 'Dhamoirhat ', 'à¦§à¦¾à¦®à¦‡à¦°à¦¹à¦¾à¦Ÿ ', 1),
(349, 20, 'Sapahar ', 'à¦¸à¦¾à¦ªà¦¾à¦¹à¦¾à¦°', 1),
(350, 20, 'Porsha ', 'à¦ªà§‹à¦°à¦¶à¦¾', 1),
(351, 20, 'Badalgachhi ', 'à¦¬à¦¾à¦¦à¦²à¦—à¦¾à¦›à¦¿', 1),
(352, 21, 'Natore Sadar ', 'à¦¨à¦¾à¦Ÿà§‹à¦° à¦¸à¦¦à¦°', 1),
(353, 21, 'Baraigram ', 'à¦¬à§œà¦¾à¦‡à¦—à§à¦°à¦¾à¦®', 1),
(354, 21, 'Bagatipara ', 'à¦¬à¦¾à¦—à¦¾à¦¤à¦¿à¦ªà¦¾à§œà¦¾', 1),
(355, 21, 'Lalpur ', 'à¦²à¦¾à¦²à¦ªà§à¦°', 1),
(356, 21, 'Natore Sadar ', 'à¦¨à¦¾à¦Ÿà§‹à¦° à¦¸à¦¦à¦°', 1),
(357, 21, 'Baraigram ', 'à¦¬à§œà¦¾à¦‡à¦—à§à¦°à¦¾à¦®', 1),
(358, 22, 'Bholahat ', 'à¦­à§‹à¦²à¦¾à¦¹à¦¾à¦Ÿ', 1),
(359, 22, 'Gomastapur ', 'à¦—à§‹à¦®à¦¸à§à¦¤à¦¾à¦ªà§à¦°', 1),
(360, 22, 'Nachole ', 'à¦¨à¦¾à¦šà§‹à¦²', 1),
(361, 22, 'Nawabganj Sadar ', 'à¦¨à¦¬à¦¾à¦¬à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', 1),
(362, 22, 'Shibganj ', 'à¦¶à¦¿à¦¬à¦—à¦žà§à¦œ', 1),
(363, 23, 'Atgharia ', 'à¦†à¦Ÿà¦˜à¦°à¦¿à§Ÿà¦¾', 1),
(364, 23, 'Bera ', 'à¦¬à§‡à§œà¦¾', 1),
(365, 23, 'Bhangura ', 'à¦­à¦¾à¦™à§à¦—à§à¦°à¦¾', 1),
(366, 23, 'Chatmohar ', 'à¦šà¦¾à¦Ÿà¦®à§‹à¦¹à¦°', 1),
(367, 23, 'Faridpur ', 'à¦«à¦°à¦¿à¦¦à¦ªà§à¦°', 1),
(368, 23, 'Ishwardi ', 'à¦ˆà¦¶à§à¦¬à¦°à¦¦à§€', 1),
(369, 23, 'Pabna Sadar ', 'à¦ªà¦¾à¦¬à¦¨à¦¾ à¦¸à¦¦à¦°', 1),
(370, 23, 'Santhia ', 'à¦¸à¦¾à¦¥à¦¿à§Ÿà¦¾', 1),
(371, 23, 'Sujanagar ', 'à¦¸à§à¦œà¦¾à¦¨à¦—à¦°', 1),
(372, 24, 'Bagha', 'à¦¬à¦¾à¦˜à¦¾', 1),
(373, 24, 'Bagmara', 'à¦¬à¦¾à¦—à¦®à¦¾à¦°à¦¾', 1),
(374, 24, 'Charghat', 'à¦šà¦¾à¦°à¦˜à¦¾à¦Ÿ', 1),
(375, 24, 'Durgapur', 'à¦¦à§à¦°à§à¦—à¦¾à¦ªà§à¦°', 1),
(376, 24, 'Godagari', 'à¦—à§‹à¦¦à¦¾à¦—à¦¾à¦°à¦¿', 1),
(377, 24, 'Mohanpur', 'à¦®à§‹à¦¹à¦¨à¦ªà§à¦°', 1),
(378, 24, 'Paba', 'à¦ªà¦¬à¦¾', 1),
(379, 24, 'Puthia', 'à¦ªà§à¦ à¦¿à§Ÿà¦¾', 1),
(380, 24, 'Tanore', 'à¦¤à¦¾à¦¨à§‹à¦°', 1),
(381, 25, 'Sirajganj Sadar ', 'à¦¸à¦¿à¦°à¦¾à¦œà¦—à¦žà§à¦œ à¦¸à¦¦à¦°', 1),
(382, 25, 'Belkuchi ', 'à¦¬à§‡à¦²à¦•à§à¦šà¦¿', 1),
(383, 25, 'Chauhali ', 'à¦šà§Œà¦¹à¦¾à¦²à¦¿', 1),
(384, 25, 'Kamarkhanda ', 'à¦•à¦¾à¦®à¦¾à¦°à¦–à¦¾à¦¨à§à¦¦à¦¾', 1),
(385, 25, 'Kazipur ', 'à¦•à¦¾à¦œà§€à¦ªà§à¦°', 1),
(386, 25, 'Raiganj ', 'à¦°à¦¾à§Ÿà¦—à¦žà§à¦œ', 1),
(387, 25, 'Shahjadpur ', 'à¦¶à¦¾à¦¹à¦œà¦¾à¦¦à¦ªà§à¦°', 1),
(388, 25, 'Tarash ', 'à¦¤à¦¾à¦°à¦¾à¦¶', 1),
(389, 25, 'Ullahpara ', 'à¦‰à¦²à§à¦²à¦¾à¦ªà¦¾à§œà¦¾', 1),
(390, 26, 'Birampur ', 'à¦¬à¦¿à¦°à¦¾à¦®à¦ªà§à¦°', 1),
(391, 26, 'Birganj', 'à¦¬à§€à¦°à¦—à¦žà§à¦œ', 1),
(392, 26, 'Biral ', 'à¦¬à¦¿à§œà¦¾à¦²', 1),
(393, 26, 'Bochaganj ', 'à¦¬à§‹à¦šà¦¾à¦—à¦žà§à¦œ', 1),
(394, 26, 'Chirirbandar ', 'à¦šà¦¿à¦°à¦¿à¦°à¦¬à¦¨à§à¦¦à¦°', 1),
(395, 26, 'Phulbari ', 'à¦«à§à¦²à¦¬à¦¾à§œà¦¿', 1),
(396, 26, 'Ghoraghat ', 'à¦˜à§‹à§œà¦¾à¦˜à¦¾à¦Ÿ', 1),
(397, 26, 'Hakimpur ', 'à¦¹à¦¾à¦•à¦¿à¦®à¦ªà§à¦°', 1),
(398, 26, 'Kaharole ', 'à¦•à¦¾à¦¹à¦¾à¦°à§‹à¦²', 1),
(399, 26, 'Khansama ', 'à¦–à¦¾à¦¨à¦¸à¦¾à¦®à¦¾', 1),
(400, 26, 'Dinajpur Sadar ', 'à¦¦à¦¿à¦¨à¦¾à¦œà¦ªà§à¦° à¦¸à¦¦à¦°', 1),
(401, 26, 'Nawabganj', 'à¦¨à¦¬à¦¾à¦¬à¦—à¦žà§à¦œ', 1),
(402, 26, 'Parbatipur ', 'à¦ªà¦¾à¦°à§à¦¬à¦¤à§€à¦ªà§à¦°', 1),
(403, 27, 'Fulchhari', 'à¦«à§à¦²à¦›à§œà¦¿', 1),
(404, 27, 'Gaibandha sadar', 'à¦—à¦¾à¦‡à¦¬à¦¾à¦¨à§à¦§à¦¾ à¦¸à¦¦à¦°', 1),
(405, 27, 'Gobindaganj', 'à¦—à§‹à¦¬à¦¿à¦¨à§à¦¦à¦—à¦žà§à¦œ', 1),
(406, 27, 'Palashbari', 'à¦ªà¦²à¦¾à¦¶à¦¬à¦¾à§œà§€', 1),
(407, 27, 'Sadullapur', 'à¦¸à¦¾à¦¦à§à¦²à§à¦¯à¦¾à¦ªà§à¦°', 1),
(408, 27, 'Saghata', 'à¦¸à¦¾à¦˜à¦¾à¦Ÿà¦¾', 1),
(409, 27, 'Sundarganj', 'à¦¸à§à¦¨à§à¦¦à¦°à¦—à¦žà§à¦œ', 1),
(410, 28, 'Kurigram Sadar', 'à¦•à§à§œà¦¿à¦—à§à¦°à¦¾à¦® à¦¸à¦¦à¦°', 1),
(411, 28, 'Nageshwari', 'à¦¨à¦¾à¦—à§‡à¦¶à§à¦¬à¦°à§€', 1),
(412, 28, 'Bhurungamari', 'à¦­à§à¦°à§à¦™à§à¦—à¦¾à¦®à¦¾à¦°à¦¿', 1),
(413, 28, 'Phulbari', 'à¦«à§à¦²à¦¬à¦¾à§œà¦¿', 1),
(414, 28, 'Rajarhat', 'à¦°à¦¾à¦œà¦¾à¦°à¦¹à¦¾à¦Ÿ', 1),
(415, 28, 'Ulipur', 'à¦‰à¦²à¦¿à¦ªà§à¦°', 1),
(416, 28, 'Chilmari', 'à¦šà¦¿à¦²à¦®à¦¾à¦°à¦¿', 1),
(417, 28, 'Rowmari', 'à¦°à¦‰à¦®à¦¾à¦°à¦¿', 1),
(418, 28, 'Char Rajibpur', 'à¦šà¦° à¦°à¦¾à¦œà¦¿à¦¬à¦ªà§à¦°', 1),
(419, 29, 'Lalmanirhat Sadar', 'à¦²à¦¾à¦²à¦®à¦¨à¦¿à¦°à¦¹à¦¾à¦Ÿ à¦¸à¦¦à¦°', 1),
(420, 29, 'Aditmari', 'à¦†à¦¦à¦¿à¦¤à¦®à¦¾à¦°à¦¿', 1),
(421, 29, 'Kaliganj', 'à¦•à¦¾à¦²à§€à¦—à¦žà§à¦œ', 1),
(422, 29, 'Hatibandha', 'à¦¹à¦¾à¦¤à¦¿à¦¬à¦¾à¦¨à§à¦§à¦¾', 1),
(423, 29, 'Patgram', 'à¦ªà¦¾à¦Ÿà¦—à§à¦°à¦¾à¦®', 1),
(424, 30, 'Nilphamari Sadar', 'à¦¨à§€à¦²à¦«à¦¾à¦®à¦¾à¦°à§€ à¦¸à¦¦à¦°', 1),
(425, 30, 'Saidpur', 'à¦¸à§ˆà§Ÿà¦¦à¦ªà§à¦°', 1),
(426, 30, 'Jaldhaka', 'à¦œà¦²à¦¢à¦¾à¦•à¦¾', 1),
(427, 30, 'Kishoreganj', 'à¦•à¦¿à¦¶à§‹à¦°à¦—à¦žà§à¦œ', 1),
(428, 30, 'Domar', 'à¦¡à§‹à¦®à¦¾à¦°', 1),
(429, 30, 'Dimla', 'à¦¡à¦¿à¦®à¦²à¦¾', 1),
(430, 31, 'Panchagarh Sadar', 'à¦ªà¦žà§à¦šà¦—à§œ à¦¸à¦¦à¦°', 1),
(431, 31, 'Debiganj', 'à¦¦à§‡à¦¬à§€à¦—à¦žà§à¦œ', 1),
(432, 31, 'Boda', 'à¦¬à§‹à¦¦à¦¾', 1),
(433, 31, 'Atwari', 'à¦†à¦Ÿà§‹à§Ÿà¦¾à¦°à¦¿', 1),
(434, 31, 'Tetulia', 'à¦¤à§‡à¦¤à§à¦²à¦¿à§Ÿà¦¾', 1),
(435, 32, 'Badarganj', 'à¦¬à¦¦à¦°à¦—à¦žà§à¦œ', 1),
(436, 32, 'Mithapukur', 'à¦®à¦¿à¦ à¦¾à¦ªà§à¦•à§à¦°', 1),
(437, 32, 'Gangachara', 'à¦—à¦™à§à¦—à¦¾à¦šà¦°à¦¾', 1),
(438, 32, 'Kaunia', 'à¦•à¦¾à¦‰à¦¨à¦¿à§Ÿà¦¾', 1),
(439, 32, 'Rangpur Sadar', 'à¦°à¦‚à¦ªà§à¦° à¦¸à¦¦à¦°', 1),
(440, 32, 'Pirgachha', 'à¦ªà§€à¦°à¦—à¦¾à¦›à¦¾', 1),
(441, 32, 'Pirganj', 'à¦ªà§€à¦°à¦—à¦žà§à¦œ', 1),
(442, 32, 'Taraganj', 'à¦¤à¦¾à¦°à¦¾à¦—à¦žà§à¦œ', 1),
(443, 33, 'Thakurgaon Sadar ', 'à¦ à¦¾à¦•à§à¦°à¦—à¦¾à¦à¦“ à¦¸à¦¦à¦°', 1),
(444, 33, 'Pirganj ', 'à¦ªà§€à¦°à¦—à¦žà§à¦œ', 1),
(445, 33, 'Baliadangi ', 'à¦¬à¦¾à¦²à¦¿à§Ÿà¦¾à¦¡à¦¾à¦™à§à¦—à¦¿', 1),
(446, 33, 'Haripur ', 'à¦¹à¦°à¦¿à¦ªà§à¦°', 1),
(447, 33, 'Ranisankail ', 'à¦°à¦¾à¦£à§€à¦¸à¦‚à¦•à¦‡à¦²', 1),
(448, 51, 'Ajmiriganj', 'à¦†à¦œà¦®à¦¿à¦°à¦¿à¦—à¦žà§à¦œ', 1),
(449, 51, 'Baniachang', 'à¦¬à¦¾à¦¨à¦¿à§Ÿà¦¾à¦šà¦‚', 1),
(450, 51, 'Bahubal', 'à¦¬à¦¾à¦¹à§à¦¬à¦²', 1),
(451, 51, 'Chunarughat', 'à¦šà§à¦¨à¦¾à¦°à§à¦˜à¦¾à¦Ÿ', 1),
(452, 51, 'Habiganj Sadar', 'à¦¹à¦¬à¦¿à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', 1),
(453, 51, 'Lakhai', 'à¦²à¦¾à¦•à§à¦·à¦¾à¦‡', 1),
(454, 51, 'Madhabpur', 'à¦®à¦¾à¦§à¦¬à¦ªà§à¦°', 1),
(455, 51, 'Nabiganj', 'à¦¨à¦¬à§€à¦—à¦žà§à¦œ', 1),
(456, 51, 'Shaistagonj ', 'à¦¶à¦¾à§Ÿà§‡à¦¸à§à¦¤à¦¾à¦—à¦žà§à¦œ', 1),
(457, 52, 'Moulvibazar Sadar', 'à¦®à§Œà¦²à¦­à§€à¦¬à¦¾à¦œà¦¾à¦°', 1),
(458, 52, 'Barlekha', 'à¦¬à§œà¦²à§‡à¦–à¦¾', 1),
(459, 52, 'Juri', 'à¦œà§à§œà¦¿', 1),
(460, 52, 'Kamalganj', 'à¦•à¦¾à¦®à¦¾à¦²à¦—à¦žà§à¦œ', 1),
(461, 52, 'Kulaura', 'à¦•à§à¦²à¦¾à¦‰à¦°à¦¾', 1),
(462, 52, 'Rajnagar', 'à¦°à¦¾à¦œà¦¨à¦—à¦°', 1),
(463, 52, 'Sreemangal', 'à¦¶à§à¦°à§€à¦®à¦™à§à¦—à¦²', 1),
(464, 53, 'Bishwamvarpur', 'à¦¬à¦¿à¦¸à¦¶à¦®à§à¦­à¦¾à¦°à¦ªà§à¦°', 1),
(465, 53, 'Chhatak', 'à¦›à¦¾à¦¤à¦•', 1),
(466, 53, 'Derai', 'à¦¦à§‡à§œà¦¾à¦‡', 1),
(467, 53, 'Dharampasha', 'à¦§à¦°à¦®à¦ªà¦¾à¦¶à¦¾', 1),
(468, 53, 'Dowarabazar', 'à¦¦à§‹à§Ÿà¦¾à¦°à¦¾à¦¬à¦¾à¦œà¦¾à¦°', 1),
(469, 53, 'Jagannathpur', 'à¦œà¦—à¦¨à§à¦¨à¦¾à¦¥à¦ªà§à¦°', 1),
(470, 53, 'Jamalganj', 'à¦œà¦¾à¦®à¦¾à¦²à¦—à¦žà§à¦œ', 1),
(471, 53, 'Sulla', 'à¦¸à§à¦²à§à¦²à¦¾', 1),
(472, 53, 'Sunamganj Sadar', 'à¦¸à§à¦¨à¦¾à¦®à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', 1),
(473, 53, 'Shanthiganj', 'à¦¶à¦¾à¦¨à§à¦¤à¦¿à¦—à¦žà§à¦œ', 1),
(474, 53, 'Tahirpur', 'à¦¤à¦¾à¦¹à¦¿à¦°à¦ªà§à¦°', 1),
(475, 54, 'Sylhet Sadar', 'à¦¸à¦¿à¦²à§‡à¦Ÿ à¦¸à¦¦à¦°', 1),
(476, 54, 'Beanibazar', 'à¦¬à¦¿à§Ÿà¦¾à¦¨à¦¿à¦¬à¦¾à¦œà¦¾à¦°', 1),
(477, 54, 'Bishwanath', 'à¦¬à¦¿à¦¶à§à¦¬à¦¨à¦¾à¦¥', 1),
(478, 54, 'Dakshin Surma ', 'à¦¦à¦•à§à¦·à¦¿à¦£ à¦¸à§à¦°à¦®à¦¾', 1),
(479, 54, 'Balaganj', 'à¦¬à¦¾à¦²à¦¾à¦—à¦žà§à¦œ', 1),
(480, 54, 'Companiganj', 'à¦•à§‹à¦®à§à¦ªà¦¾à¦¨à¦¿à¦—à¦žà§à¦œ', 1),
(481, 54, 'Fenchuganj', 'à¦«à§‡à¦žà§à¦šà§à¦—à¦žà§à¦œ', 1),
(482, 54, 'Golapganj', 'à¦—à§‹à¦²à¦¾à¦ªà¦—à¦žà§à¦œ', 1),
(483, 54, 'Gowainghat', 'à¦—à§‹à§Ÿà¦¾à¦‡à¦¨à¦˜à¦¾à¦Ÿ', 1),
(484, 54, 'Jaintiapur', 'à¦œà§Ÿà¦¨à§à¦¤à¦ªà§à¦°', 1),
(485, 54, 'Kanaighat', 'à¦•à¦¾à¦¨à¦¾à¦‡à¦˜à¦¾à¦Ÿ', 1),
(486, 54, 'Zakiganj', 'à¦œà¦¾à¦•à¦¿à¦—à¦žà§à¦œ', 1),
(487, 54, 'Nobigonj', 'à¦¨à¦¬à§€à¦—à¦žà§à¦œ', 1),
(488, 1, 'Adabor', 'à¦†à¦¦à¦¾à¦¬à¦°,', 1),
(489, 1, 'Airport', 'à¦¬à¦¿à¦®à¦¾à¦¨à¦¬à¦¨à§à¦¦à¦°', 1),
(490, 1, 'Badda', 'à¦¬à¦¾à¦¡à§à¦¡à¦¾', 1),
(491, 1, 'Banani', 'à¦¬à¦¨à¦¾à¦¨à§€', 1),
(492, 1, 'Bangshal', 'à¦¬à¦‚à¦¶à¦¾à¦²', 1),
(493, 1, 'Bhashantek', 'à¦­à¦¾à¦·à¦¾à¦¨à¦Ÿà§‡à¦•', 1),
(494, 1, 'Cantonment', 'à¦¸à§‡à¦¨à¦¾à¦¨à¦¿à¦¬à¦¾à¦¸', 1),
(495, 1, 'Chackbazar', 'à¦šà¦•à¦¬à¦¾à¦œà¦¾à¦°', 1),
(496, 1, 'Darussalam', 'à¦¦à¦¾à¦°à§à¦¸à¦¾à¦²à¦¾à¦®', 1),
(497, 1, 'Daskhinkhan', 'à¦¦à¦•à§à¦·à¦¿à¦¨à¦–à¦¾à¦¨', 1),
(498, 1, 'Demra', 'à¦¡à§‡à¦®à¦°à¦¾', 1),
(499, 1, 'Dhamrai', 'à¦§à¦¾à¦®à¦°à¦¾à¦‡', 1),
(500, 1, 'Dhanmondi', 'à¦§à¦¾à¦¨à¦®à¦¨à§à¦¡à¦¿,', 1),
(501, 1, 'Dohar', 'à¦¦à§‹à¦¹à¦¾à¦°', 1),
(502, 1, 'Gandaria', 'à¦—à§‡à¦¨à§à¦¡à¦¾à¦°à¦¿à¦¯à¦¼à¦¾', 1),
(503, 1, 'Gulshan', 'à¦—à§à¦²à¦¶à¦¾à¦¨', 1),
(504, 1, 'Hazaribag', 'à¦¹à¦¾à¦œà¦¾à¦°à¦¿à¦¬à¦¾à¦—,', 1),
(505, 1, 'Jatrabari', 'à¦¯à¦¾à¦¤à§à¦°à¦¾à¦¬à¦¾à§œà§€', 1),
(506, 1, 'Kafrul', 'à¦•à¦¾à¦«à¦°à§à¦²', 1),
(507, 1, 'Kalabagan', 'à¦•à¦²à¦¾à¦¬à¦¾à¦—à¦¾à¦¨', 1),
(508, 1, 'Kamrangirchar', 'à¦•à¦¾à¦®à¦°à¦¾à¦™à§à¦—à§€à¦°à¦šà¦°', 1),
(509, 1, 'Keraniganj', 'à¦•à§‡à¦°à¦¾à¦¨à§€à¦—à¦žà§à¦œ', 1),
(510, 1, 'Khilgaon', 'à¦–à¦¿à¦²à¦—à¦¾à¦', 1),
(511, 1, 'Khilkhet', 'à¦–à¦¿à¦²à¦•à§à¦·à§‡à¦¤', 1),
(512, 1, 'Kotwali', 'à¦•à§‹à¦¤à§‹à¦¯à¦¼à¦¾à¦²à§€', 1),
(513, 1, 'Lalbag', 'à¦²à¦¾à¦²à¦¬à¦¾à¦—', 1),
(514, 1, 'Mirpur Model', 'à¦®à¦¿à¦°à¦ªà§à¦°', 1),
(515, 1, 'Mohammadpur', 'à¦®à§‹à¦¹à¦¾à¦®à§à¦®à¦¾à¦¦à¦ªà§à¦°', 1),
(516, 1, 'Motijheel', 'à¦®à¦¤à¦¿à¦à¦¿à¦²', 1),
(517, 1, 'Mugda', 'à¦®à§à¦—à¦¦à¦¾', 1),
(518, 1, 'Nawabganj', 'à¦¨à¦¬à¦¾à¦¬à¦—à¦žà§à¦œ', 1),
(519, 1, 'New Market', 'à¦¨à¦¿à¦‰ à¦®à¦¾à¦°à§à¦•à§‡à¦Ÿ', 1),
(520, 1, 'Pallabi', 'à¦ªà¦²à§à¦²à¦¬à§€', 1),
(521, 1, 'Paltan', 'à¦ªà¦²à§à¦Ÿà¦¨', 1),
(522, 1, 'Ramna', 'à¦°à¦®à¦¨à¦¾', 1),
(523, 1, 'Rampura', 'à¦°à¦¾à¦®à¦ªà§à¦°à¦¾', 1),
(524, 1, 'Rupnagar', 'à¦°à§‚à¦ªà¦¨à¦—à¦°', 1),
(525, 1, 'Sabujbag', 'à¦¸à¦¬à§à¦œà¦¬à¦¾à¦—', 1),
(526, 1, 'Savar', 'à¦¸à¦¾à¦­à¦¾à¦°', 1),
(527, 1, 'Shah Ali', 'à¦¶à¦¾à¦¹ à¦†à¦²à§€', 1),
(528, 1, 'Shahbag', 'à¦¶à¦¾à¦¹à¦¬à¦¾à¦—', 1),
(529, 1, 'Shahjahanpur', 'à¦¶à¦¾à¦¹à¦œà¦¾à¦¹à¦¾à¦¨à¦ªà§à¦°', 1),
(530, 1, 'Sherebanglanagar', 'à¦¶à§‡à¦°à§‡à¦¬à¦¾à¦‚à¦²à¦¾ à¦¨à¦—à¦°', 1),
(531, 1, 'Shyampur', 'à¦¶à§à¦¯à¦¾à¦®à¦ªà§à¦°', 1),
(532, 1, 'Sutrapur', 'à¦¸à§‚à¦¤à§à¦°à¦¾à¦ªà§à¦°', 1),
(533, 1, 'Tejgaon', 'à¦¤à§‡à¦œà¦—à¦¾à¦à¦“,', 1),
(534, 1, 'Tejgaon I/A', 'à¦¤à§‡à¦œà¦—à¦¾à¦à¦“', 1),
(535, 1, 'Turag', 'à¦¤à§à¦°à¦¾à¦—', 1),
(536, 1, 'Uttara', 'à¦‰à¦¤à§à¦¤à¦°à¦¾', 1),
(537, 1, 'Uttara West', 'à¦‰à¦¤à§à¦¤à¦°à¦¾ à¦ªà¦¶à§à¦šà¦¿à¦®', 1),
(538, 1, 'Uttarkhan', 'à¦‰à¦¤à§à¦¤à¦°à¦–à¦¾à¦¨', 1),
(539, 1, 'Vatara', 'à¦­à¦¾à¦Ÿà¦¾à¦°à¦¾', 1),
(540, 1, 'Wari', 'à¦“à§Ÿà¦¾à¦°à§€', 1),
(541, 1, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', 1),
(542, 35, 'Airport', 'à¦à§Ÿà¦¾à¦°à¦ªà§‹à¦°à§à¦Ÿ', 1),
(543, 35, 'Kawnia', 'à¦•à¦¾à¦‰à¦¨à¦¿à§Ÿà¦¾', 1),
(544, 35, 'Bondor', 'à¦¬à¦¨à§à¦¦à¦°', 1),
(545, 35, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', 1),
(546, 24, 'Boalia', 'à¦¬à§‹à¦¯à¦¼à¦¾à¦²à¦¿à¦¯à¦¼à¦¾', 1),
(547, 24, 'Motihar', 'à¦®à¦¤à¦¿à¦¹à¦¾à¦°', 1),
(548, 24, 'Shahmokhdum', 'à¦¶à¦¾à¦¹à§ à¦®à¦•à¦–à¦¦à§à¦® ', 1),
(549, 24, 'Rajpara', 'à¦°à¦¾à¦œà¦ªà¦¾à¦°à¦¾ ', 1),
(550, 24, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', 1),
(551, 43, 'Akborsha', 'à¦†à¦•à¦¬à¦°à¦¶à¦¾', 1),
(552, 43, 'Baijid bostami', 'à¦¬à¦¾à¦‡à¦œà¦¿à¦¦ à¦¬à§‹à¦¸à§à¦¤à¦¾à¦®à§€', 1),
(553, 43, 'Bakolia', 'à¦¬à¦¾à¦•à§‹à¦²à¦¿à§Ÿà¦¾', 1),
(554, 43, 'Bandar', 'à¦¬à¦¨à§à¦¦à¦°', 1),
(555, 43, 'Chandgaon', 'à¦šà¦¾à¦à¦¦à¦—à¦¾à¦“', 1),
(556, 43, 'Chokbazar', 'à¦šà¦•à¦¬à¦¾à¦œà¦¾à¦°', 1),
(557, 43, 'Doublemooring', 'à¦¡à¦¾à¦¬à¦² à¦®à§à¦°à¦¿à¦‚', 1),
(558, 43, 'EPZ', 'à¦‡à¦ªà¦¿à¦œà§‡à¦¡', 1),
(559, 43, 'Hali Shohor', 'à¦¹à¦¾à¦²à§€ à¦¶à¦¹à¦°', 1),
(560, 43, 'Kornafuli', 'à¦•à¦°à§à¦£à¦«à§à¦²à¦¿', 1),
(561, 43, 'Kotwali', 'à¦•à§‹à¦¤à§‹à¦¯à¦¼à¦¾à¦²à§€', 1),
(562, 43, 'Kulshi', 'à¦•à§à¦²à¦¶à¦¿', 1),
(563, 43, 'Pahartali', 'à¦ªà¦¾à¦¹à¦¾à¦¡à¦¼à¦¤à¦²à§€', 1),
(564, 43, 'Panchlaish', 'à¦ªà¦¾à¦à¦šà¦²à¦¾à¦‡à¦¶', 1),
(565, 43, 'Potenga', 'à¦ªà¦¤à§‡à¦™à§à¦—à¦¾', 1),
(566, 43, 'Shodhorgat', 'à¦¸à¦¦à¦°à¦˜à¦¾à¦Ÿ', 1),
(567, 43, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', 1),
(568, 44, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', 1),
(569, 59, 'Aranghata', 'à¦†à¦¡à¦¼à¦¾à¦‚à¦˜à¦¾à¦Ÿà¦¾', 1),
(570, 59, 'Daulatpur', 'à¦¦à§Œà¦²à¦¤à¦ªà§à¦°', 1),
(571, 59, 'Harintana', 'à¦¹à¦¾à¦°à¦¿à¦¨à§à¦¤à¦¾à¦¨à¦¾ ', 1),
(572, 59, 'Horintana', 'à¦¹à¦°à¦¿à¦£à¦¤à¦¾à¦¨à¦¾ ', 1),
(573, 59, 'Khalishpur', 'à¦–à¦¾à¦²à¦¿à¦¶à¦ªà§à¦°', 1),
(574, 59, 'Khanjahan Ali', 'à¦–à¦¾à¦¨à¦œà¦¾à¦¹à¦¾à¦¨ à¦†à¦²à§€', 1),
(575, 59, 'Khulna Sadar', 'à¦–à§à¦²à¦¨à¦¾ à¦¸à¦¦à¦°', 1),
(576, 59, 'Labanchora', 'à¦²à¦¾à¦¬à¦¾à¦¨à¦›à§‹à¦°à¦¾', 1),
(577, 59, 'Sonadanga', 'à¦¸à§‹à¦¨à¦¾à¦¡à¦¾à¦™à§à¦—à¦¾', 1),
(578, 59, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', 1),
(579, 2, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', 1),
(580, 4, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', 1),
(581, 5, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', 1),
(582, 54, 'Airport', 'à¦¬à¦¿à¦®à¦¾à¦¨à¦¬à¦¨à§à¦¦à¦°', 1),
(583, 54, 'Hazrat Shah Paran', 'à¦¹à¦¯à¦°à¦¤ à¦¶à¦¾à¦¹ à¦ªà¦°à¦¾à¦£', 1),
(584, 54, 'Jalalabad', 'à¦œà¦¾à¦²à¦¾à¦²à¦¾à¦¬à¦¾à¦¦', 1),
(585, 54, 'Kowtali', 'à¦•à§‹à¦¤à§‹à¦¯à¦¼à¦¾à¦²à§€', 1),
(586, 54, 'Moglabazar', 'à¦®à§‹à¦—à¦²à¦¾à¦¬à¦¾à¦œà¦¾à¦°', 1),
(587, 54, 'Osmani Nagar', 'à¦“à¦¸à¦®à¦¾à¦¨à§€ à¦¨à¦—à¦°', 1),
(588, 54, 'South Surma', 'à¦¦à¦•à§à¦·à¦¿à¦£ à¦¸à§à¦°à¦®à¦¾', 1),
(589, 54, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_without_pay`
--

CREATE TABLE `hr_without_pay` (
  `hr_wop_id` int(11) NOT NULL,
  `hr_wop_as_id` varchar(10) NOT NULL,
  `hr_wop_start_date` date DEFAULT NULL,
  `hr_wop_end_date` date DEFAULT NULL,
  `hr_wop_reason` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_worker_recruitment`
--

CREATE TABLE `hr_worker_recruitment` (
  `worker_id` int(10) UNSIGNED NOT NULL,
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
  `worker_color_top_stice` tinyint(1) UNSIGNED DEFAULT '0',
  `worker_urmol_join` tinyint(1) NOT NULL DEFAULT '0',
  `worker_clip_join` tinyint(1) NOT NULL DEFAULT '0',
  `worker_salary` float NOT NULL DEFAULT '0',
  `worker_is_migrated` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_worker_recruitment`
--

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
(37, 'MD. NAZMUL HOSSAIN', '2018-12-13', 1, 28, 3, 2, 25, NULL, NULL, '1992-07-26', '0', 'Male', '01918788060', NULL, NULL, '5\'3\"', '54', 'N/A', 'O+', NULL, '26-30', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(38, 'MORIOM', '2018-07-01', 3, 33, 3, 2, 25, 21, NULL, '1999-08-25', '1', 'Female', '01712863488', NULL, NULL, '5\'', '50', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 5300, 1),
(39, 'RUNA AKTER', '2018-07-08', 3, 33, 3, 2, 25, 21, NULL, '1999-03-12', '1', 'Female', '01712863488', NULL, NULL, '5\'', '52', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 5300, 1),
(40, 'RITA AKTER', '2018-07-09', 3, 37, 3, 2, 25, NULL, NULL, '1995-01-01', '1', 'Female', '01712863488', NULL, NULL, '5\'', '52', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1),
(41, 'LABONI AKTER', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1997-09-25', '0', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7300, 1),
(42, 'MST. SHOPNA PARVIN', '2018-01-15', 3, 36, 3, 2, 25, NULL, NULL, '1993-08-23', '1', 'Female', '01712863488', NULL, NULL, '5\'', '52', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8100, 1),
(43, 'MONIR', '2018-03-01', 3, 37, 3, 2, 25, 21, 21, '1983-02-01', '1', 'Male', '01712863488', NULL, NULL, '5\'6\"', '60', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8100, 1),
(44, 'AMENA BEGUM', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1985-04-10', '1', 'Female', '01712863488', NULL, NULL, '5\'', '54', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8100, 1),
(45, 'NAZMA BEGUM', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1990-04-13', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '52', 'N/A', 'O+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8100, 1),
(46, 'ABDUR RASHID', '2018-01-11', 3, 37, 3, 2, 25, 21, 21, '1999-01-07', '1', 'Male', '01712863488', NULL, NULL, '5\'6\"', '60', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8300, 1),
(47, 'MST. AKLIMA BEGUM', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1982-03-04', '1', 'Female', '01712863488', NULL, NULL, '5\'', '53', 'N/A', 'B+', NULL, '36-40', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8000, 1),
(48, 'MAZHARUL', '2018-03-08', 3, 37, 3, 2, 25, 21, 21, '1997-01-01', '1', 'Male', '01712863488', NULL, NULL, '5\'6\"', '65', 'N/A', 'B+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1),
(49, 'RANI', '2018-07-01', 3, 37, 3, 2, 25, 21, 21, '1990-09-08', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '53', 'N/A', 'B+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8200, 1),
(50, 'RATNA', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1988-10-18', '1', 'Female', '01712863488', NULL, NULL, '5\'', '56', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8300, 1),
(51, 'JAHANGIR', '2018-03-12', 3, 37, 3, 2, 25, 21, 21, '1993-02-05', '0', 'Male', '01712863488', NULL, NULL, '5\'5\"', '65', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8200, 1),
(52, 'HABIBUR RAHMAN', '2018-02-12', 3, 37, 3, 2, 25, 21, 21, '1993-08-10', '1', 'Male', '01712863488', NULL, NULL, '5\'6\"', '65', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7800, 1),
(53, 'SAZEDA', '2018-03-20', 3, 37, 3, 2, 25, 21, 21, '1986-03-13', '1', 'Female', '01712863488', NULL, NULL, '5\'', '51', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8400, 1),
(54, 'BEAUTY BEGUM', '2018-01-02', 3, 37, 3, 2, 25, 21, 21, '1988-12-10', '1', 'Female', '01712863488', NULL, NULL, '5\'', '53', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7800, 1),
(55, 'HASAN', '2018-02-27', 3, 37, 3, 2, 25, 21, 21, '1995-06-10', '1', 'Male', '01712863488', NULL, NULL, '5\'6\"', '65', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1),
(56, 'NASIMA AKTER', '2017-10-12', 3, 37, 3, 2, 25, 21, 21, '1989-02-05', '1', 'Female', '01712863488', NULL, NULL, '5\'', '50', 'N/A', 'AB+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7800, 1),
(57, 'RUPA AKTER', '2018-03-01', 3, 37, 3, 2, 25, 21, 21, '1989-11-10', '1', 'Female', '01712863488', NULL, NULL, '5\'', '52', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7500, 1),
(58, 'HENA', '2018-02-01', 3, 37, 3, 2, 25, 21, 21, '1983-08-15', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7900, 1),
(59, 'PARUL', '2018-02-08', 3, 37, 3, 2, 25, 21, 21, '1987-01-29', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8200, 1),
(60, 'FAHIMA', '2018-03-13', 3, 37, 3, 2, 25, 21, 21, '1980-05-03', '1', 'Female', '01712863488', NULL, NULL, '5\'', '53', 'N/A', 'A+', NULL, '36-40', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8200, 1),
(61, 'SHORIF MIA', '2018-04-02', 3, 37, 3, 2, 25, 21, 21, '1992-11-10', '1', 'Male', '01712863488', NULL, NULL, '5\'6\"', '66', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7800, 1),
(62, 'MST. HAMIDA AKTER', '2018-01-01', 3, 37, 3, 2, 25, 21, 21, '1995-01-25', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7500, 1),
(63, 'SHATHI AKTER', '2018-07-23', 3, 37, 3, 2, 25, 21, 21, '1993-03-20', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '54', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8400, 1),
(64, 'MST. DINA AKTER', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1993-04-18', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '55', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7700, 1),
(65, 'NAZMA BEGUM', '2018-01-11', 3, 36, 3, 2, 25, 21, 21, '1991-03-16', '1', 'Female', '01712863488', NULL, NULL, '5\'', '53', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7900, 1),
(66, 'LIPI', '2018-03-01', 3, 37, 3, 2, 25, 21, 21, '1990-01-09', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '55', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 5300, 1),
(67, 'MST. RUNA AKTER', '2018-07-08', 3, 37, 3, 2, 25, 21, 21, '1995-01-01', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '61', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(68, 'TANIA', '2018-07-08', 3, 33, 3, 2, 25, 21, NULL, '1998-01-12', '1', 'Female', '01712863488', NULL, NULL, '5\'', '50', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(69, 'SUFIA', '2018-04-01', 3, 37, 3, 2, 25, 21, 21, '2018-04-01', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '41-45', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(70, 'BOKUL', '2018-02-01', 3, 33, 3, 2, 25, 21, 21, '1998-01-01', '1', 'Female', '01712863488', NULL, NULL, '5\'', '51', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(71, 'FAHIMA', '2018-03-06', 3, 33, 3, 2, 25, 21, NULL, '1988-01-01', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '54', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(72, 'SALEHA KHATUN', '2018-04-21', 3, 33, 3, 2, 25, 21, NULL, '1985-10-08', '1', 'Female', '01712863488', NULL, NULL, '5\'', '53', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(73, 'SHUMITA', '2018-02-01', 3, 33, 3, 2, 25, 21, NULL, '1998-02-02', '1', 'Female', '01712863488', NULL, NULL, '5\'', '58', 'N/A', 'B+', NULL, '18-20', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(74, 'RABIA KHATUN', '2018-02-01', 3, 33, 3, 2, 25, 21, NULL, '1988-05-01', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '52', 'N/A', 'O+', NULL, '26-30', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(75, 'ISMOT ARA', '2018-03-01', 3, 33, 3, 2, 25, 21, NULL, '1993-05-20', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(76, 'SABANA', '2018-03-01', 3, 33, 3, 2, 25, 21, NULL, '1996-01-12', '1', 'Female', '01712863488', NULL, NULL, '5\'2\"', '59', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(77, 'SALMA KHATUN', '2018-07-09', 3, 33, 3, 2, 25, 21, NULL, '1999-11-13', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '52', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(78, 'PARVIN AKTER', '2018-02-01', 3, 33, 3, 2, 25, 21, NULL, '1996-11-12', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '52', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(79, 'SHAIFUL', '2018-03-04', 3, 33, 3, 2, 25, 21, NULL, '1994-10-26', '0', 'Female', '01712863488', NULL, NULL, '5\'1\"', '60', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(80, 'SHAHNAZ', '2018-04-03', 3, 37, 3, 2, 25, 21, NULL, '1997-07-22', '0', 'Female', '01712863488', NULL, NULL, '5\'1\"', '55', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(81, 'DALIA AKTER', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1986-05-05', '1', 'Female', '01712863488', NULL, NULL, '5\'2\"', '52', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(82, 'NUR JAHAN', '2018-03-05', 3, 37, 3, 2, 25, 21, 21, '1988-01-11', '1', 'Female', '01712863488', NULL, NULL, '5\'', '56', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(83, 'JAHANGIR ALOM', '2018-07-29', 3, 37, 3, 2, 25, 21, 21, '1991-02-12', '1', 'Male', '01712863488', NULL, NULL, '5\'1\"', '52', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8000, 1),
(84, 'MOZIRON', '2018-03-08', 3, 37, 3, 2, 25, 21, 21, '1981-07-04', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '53', 'N/A', 'A+', NULL, '36-40', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7900, 1),
(85, 'ANOWARA', '2018-05-13', 3, 37, 3, 2, 25, 21, 21, '1986-03-04', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '51', 'N/A', 'A+', NULL, '31-35', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7400, 1),
(86, 'AKLIMA', '2018-03-10', 3, 37, 3, 2, 25, 21, 21, '1998-03-10', '1', 'Female', '01712863488', NULL, NULL, '5\'', '50', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7500, 1),
(87, 'SHATHI AKTER', '2018-02-26', 3, 37, 3, 2, 25, 21, 21, '1992-06-10', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '52', 'N/A', 'B+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7800, 1),
(88, 'SHATHI', '2018-04-16', 3, 37, 3, 2, 25, 21, 21, '1992-02-01', '1', 'Female', '01712863488', NULL, NULL, '5\'2\"', '55', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7100, 1),
(89, 'SAIDUL', '2018-03-11', 3, 37, 3, 2, 25, 21, 21, '1998-01-01', '1', 'Male', '01712863488', NULL, NULL, '5\'6\"', '65', 'N/A', 'A+', NULL, '18-20', 'Acceppted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8000, 1),
(90, 'KOLPONA BEGUM', '2018-02-01', 3, 37, 3, 2, 25, 21, 21, '1994-06-10', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '52', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8100, 1),
(91, 'POLY', '2018-07-11', 3, 37, 3, 2, 25, 21, 21, '1998-07-10', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8500, 1),
(92, 'SIMU AKTER', '2018-01-03', 3, 37, 3, 2, 25, 21, 21, '1995-08-12', '1', 'Female', '01712863488', NULL, NULL, '5\'', '52', 'N/A', 'A+', NULL, '21-25', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7100, 1),
(93, 'ASMA', '2018-03-01', 3, 37, 3, 2, 25, 21, 21, '1991-04-03', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '58', 'N/A', 'B+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7900, 1),
(94, 'ROBIUL', '2018-04-01', 3, 37, 3, 2, 25, 21, 21, '1999-06-01', '1', 'Male', '01712863488', NULL, NULL, '5\'6\"', '60', 'N/A', 'A+', NULL, '18-20', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8400, 1),
(95, 'KOLPONA', '2018-07-24', 3, 37, 3, 2, 25, 21, 21, '1990-01-01', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '55', 'N/A', 'O+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8400, 1),
(96, 'HENA', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1981-10-25', '1', 'Female', '01712863488', NULL, NULL, '5\'', '55', 'N/A', 'A+', NULL, '36-40', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8300, 1),
(97, 'FATEMA KHATUN', '2018-01-10', 3, 37, 3, 2, 25, 21, 21, '1993-07-06', '1', 'Female', '01712863488', NULL, NULL, '5\'1\"', '52', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7600, 1),
(98, 'RAZIA SULTANA', '2018-01-13', 3, 37, 3, 2, 25, 21, 21, '1988-06-10', '1', 'Female', '01712863488', NULL, NULL, '5\'', '54', 'N/A', 'A+', NULL, '26-30', 'Accepted', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 7900, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_yearly_holiday_planner`
--

CREATE TABLE `hr_yearly_holiday_planner` (
  `hr_yhp_id` int(11) UNSIGNED NOT NULL,
  `hr_yhp_unit` int(11) DEFAULT NULL,
  `hr_yhp_dates_of_holidays` date NOT NULL,
  `hr_yhp_comments` text NOT NULL,
  `hr_yhp_status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_yearly_holiday_planner`
--

INSERT INTO `hr_yearly_holiday_planner` (`hr_yhp_id`, `hr_yhp_unit`, `hr_yhp_dates_of_holidays`, `hr_yhp_comments`, `hr_yhp_status`) VALUES
(1, 3, '2018-07-06', 'Weekend', 0),
(2, 3, '2018-07-13', 'Weekend', 1),
(3, 3, '2018-07-20', 'Weekend', 1),
(4, 3, '2018-07-27', 'Weekend', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_setup`
--

CREATE TABLE `item_setup` (
  `item_id` int(11) NOT NULL,
  `setup_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model_has_roles`
--

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
(16, 10, 'App\\User'),
(17, 1, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `mr_action_type`
--

CREATE TABLE `mr_action_type` (
  `act_id` int(11) NOT NULL,
  `act_name` varchar(50) NOT NULL,
  `act_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_action_type`
--

INSERT INTO `mr_action_type` (`act_id`, `act_name`, `act_code`) VALUES
(1, 'New Action', 'AC1'),
(3, 'New Action1', 'AC2');

-- --------------------------------------------------------

--
-- Table structure for table `mr_artcl_construct_dimen`
--

CREATE TABLE `mr_artcl_construct_dimen` (
  `art_id` int(11) NOT NULL,
  `matitem_id` int(11) NOT NULL,
  `sz_id` int(11) NOT NULL,
  `art_name` varchar(50) NOT NULL,
  `art_construction` varchar(128) NOT NULL,
  `art_dimension` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_artcl_construct_dimen`
--

INSERT INTO `mr_artcl_construct_dimen` (`art_id`, `matitem_id`, `sz_id`, `art_name`, `art_construction`, `art_dimension`) VALUES
(1, 1, 1, 'Article 1', 'Constrcution1', 'Dimension1'),
(2, 23, 12, 'Artcle', 'Button Cot', 'Dimen'),
(3, 1, 1, 'Article 3 updated', 'Constrcution3', 'Dimension3'),
(4, 22, 11, 'NA', 'Fab Const', 'Fab Dimen'),
(5, 24, 14, 'Art 1', 'asdas', 'sadas');

-- --------------------------------------------------------

--
-- Table structure for table `mr_bom_n_costing_booking`
--

CREATE TABLE `mr_bom_n_costing_booking` (
  `bom_id` int(11) NOT NULL,
  `stl_id` int(11) NOT NULL,
  `matitem_id` int(11) NOT NULL,
  `clr_id` int(11) NOT NULL,
  `sz_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `bom_mill` varchar(128) NOT NULL,
  `bom_uom` enum('Millimeter','Centimeter','Meter','Inch','Feet','Yard','Piece') NOT NULL,
  `bom_consumption` varchar(20) NOT NULL,
  `bom_extra` varchar(20) NOT NULL,
  `bom_uom_extra` enum('Millimeter','Centimeter','Meter','Inch','Feet','Yard','Piece') NOT NULL,
  `bom_cost_req_qty` int(11) DEFAULT NULL,
  `bom_cost_unit_price` varchar(20) DEFAULT NULL,
  `bom_cost_value` varchar(20) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `bom_book_source` varchar(128) NOT NULL,
  `bom_book_delivery_on` date NOT NULL,
  `bom_book_status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_bom_n_costing_booking`
--

INSERT INTO `mr_bom_n_costing_booking` (`bom_id`, `stl_id`, `matitem_id`, `clr_id`, `sz_id`, `art_id`, `bom_mill`, `bom_uom`, `bom_consumption`, `bom_extra`, `bom_uom_extra`, `bom_cost_req_qty`, `bom_cost_unit_price`, `bom_cost_value`, `sup_id`, `bom_book_source`, `bom_book_delivery_on`, `bom_book_status`) VALUES
(1, 1, 1, 1, 1, 1, 'mill1', 'Millimeter', '1', '1', 'Millimeter', 2, '1', '2', 3, '', '0000-00-00', ''),
(2, 1, 1, 2, 1, 3, 'mill1', 'Meter', '3', '3', 'Meter', 6, '1', '6', 3, '', '0000-00-00', ''),
(3, 1, 1, 5, 1, 1, 'mill1', 'Inch', '1', '1', 'Inch', 2, '1', '2', 3, '', '0000-00-00', ''),
(4, 1, 23, 1, 12, 2, 'mill2', 'Meter', '1', '2', 'Meter', 3, '1', '3', 4, '', '0000-00-00', ''),
(5, 1, 23, 2, 12, 2, 'mill12', 'Inch', '2', '2', 'Inch', 4, '1', '4', 4, '', '0000-00-00', ''),
(6, 1, 23, 4, 12, 2, 'mill1', 'Meter', '2', '1', 'Meter', 3, '3', '9', 4, '', '0000-00-00', ''),
(7, 3, 23, 1, 12, 2, 'mill1', 'Millimeter', '1', '1', 'Millimeter', 1, '3', '6', 3, '', '2018-09-16', ''),
(8, 3, 23, 2, 12, 2, 'mill3', 'Meter', '4', '5', 'Meter', 20, '3', '27', 4, '', '2018-09-22', ''),
(9, 3, 1, 2, 1, 1, 'mill1', 'Piece', '3', '3', 'Piece', 9, '1', '6', 4, '', '2018-09-26', ''),
(10, 3, 1, 1, 1, 1, 'mill2', 'Centimeter', '5', '5', 'Centimeter', 25, '5', '50', NULL, '', '2018-09-29', ''),
(11, 3, 22, 1, 11, 4, 'mill1', 'Meter', '1', '3', 'Yard', 3, '9', '36', 5, '', '2018-09-30', ''),
(12, 2, 1, 2, 1, 3, 'mill1', 'Feet', '1', '3', 'Inch', 4, '1', '4', 4, '', '0000-00-00', ''),
(13, 2, 23, 1, 12, 2, 'mill2', 'Meter', '3', '3', 'Meter', 6, '3', '18', 5, '', '0000-00-00', ''),
(14, 2, 1, 1, 1, 1, 'mill2', 'Inch', '5', '1', 'Inch', 6, '1', '6', 3, '', '0000-00-00', ''),
(15, 2, 1, 5, 1, 3, 'mill1', 'Inch', '1', '1', 'Inch', 2, '1', '2', 3, '', '0000-00-00', ''),
(16, 2, 23, 4, 12, 2, 'mill5', 'Meter', '3', '3', 'Meter', 6, '1', '6', 4, '', '0000-00-00', ''),
(17, 5, 1, 1, 1, 1, 'mill1', 'Inch', '1', '3', 'Inch', 4, '1', '4', 4, '', '0000-00-00', ''),
(18, 5, 23, 2, 12, 2, 'mill5', 'Millimeter', '3', '3', 'Millimeter', 6, '3', '18', 4, '', '0000-00-00', ''),
(19, 5, 1, 5, 1, 3, 'mill5', 'Meter', '3', '1', 'Meter', 4, '5', '20', 3, '', '0000-00-00', ''),
(20, 5, 24, 2, 14, 5, 'mill1', 'Centimeter', '6', '4', 'Centimeter', 10, '10', '100', 4, '', '0000-00-00', ''),
(21, 5, 24, 5, 14, 5, 'mill5', 'Meter', '7', '8', 'Meter', 15, '5', '75', 5, '', '0000-00-00', ''),
(22, 4, 1, 1, 1, 1, 'mill1', 'Millimeter', '3', '3', 'Centimeter', 6, '2', '12', 3, '', '0000-00-00', ''),
(23, 4, 24, 2, 14, 5, 'mill5', 'Centimeter', '3', '1', 'Centimeter', 4, '5', '20', 5, '', '0000-00-00', ''),
(24, 4, 23, 1, 12, 2, 'mill1', 'Millimeter', '1', '3', 'Meter', 4, '9', '36', 4, '', '0000-00-00', ''),
(25, 4, 24, 1, 14, 5, 'mill5', 'Feet', '3', '3', 'Feet', 6, '3', '18', 3, '', '0000-00-00', ''),
(26, 7, 1, 1, 1, 1, 'mill1', 'Centimeter', '3', '1', 'Centimeter', 4, '6', '24', 4, '', '0000-00-00', ''),
(27, 7, 23, 1, 12, 2, 'mill5', 'Millimeter', '3', '1', 'Millimeter', NULL, NULL, NULL, NULL, '', '0000-00-00', ''),
(28, 7, 22, 1, 11, 4, 'mill1', 'Centimeter', '7', '3', 'Centimeter', NULL, NULL, NULL, NULL, '', '0000-00-00', ''),
(29, 6, 23, 1, 12, 2, 'mill1', 'Millimeter', '3', '1', 'Millimeter', 4, '1', '4', 3, '', '0000-00-00', ''),
(30, 6, 1, 1, 1, 1, 'mill5', 'Millimeter', '1', '3', 'Millimeter', 4, '1', '4', 4, '', '0000-00-00', ''),
(31, 6, 23, 1, 12, 2, 'mill5', 'Feet', '3', '8', 'Feet', 11, '1', '11', 4, '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `mr_bom_n_cost_book_history`
--

CREATE TABLE `mr_bom_n_cost_book_history` (
  `bom_history_id` int(11) NOT NULL,
  `stl_id` int(11) NOT NULL,
  `bom_history_desc` varchar(128) NOT NULL,
  `bom_history_ip` varchar(30) NOT NULL,
  `bom_history_mac` varchar(30) DEFAULT NULL,
  `bom_history_userid` varchar(10) NOT NULL,
  `bom_history_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_bom_n_cost_book_history`
--

INSERT INTO `mr_bom_n_cost_book_history` (`bom_history_id`, `stl_id`, `bom_history_desc`, `bom_history_ip`, `bom_history_mac`, `bom_history_userid`, `bom_history_datetime`) VALUES
(1, 3, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-08 04:35:49'),
(2, 2, 'Bom Costing Update', '192.168.1.20', NULL, '1', '2018-09-08 05:43:11'),
(3, 3, 'Bom Costing Update', '192.168.1.21', NULL, '9999999999', '2018-09-08 05:47:45'),
(4, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-08 06:16:49'),
(5, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-08 07:28:11'),
(6, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-08 07:57:29'),
(7, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-08 07:58:18'),
(8, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-10 07:32:02'),
(9, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-10 07:33:25'),
(10, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-10 08:36:57'),
(11, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-10 09:50:55'),
(12, 3, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-13 12:18:10'),
(13, 3, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-13 12:20:11'),
(14, 3, 'Bom Costing Update', '192.168.0.106', NULL, '9999999999', '2018-09-13 18:35:42'),
(15, 3, 'Bom Costing Update', '192.168.0.106', NULL, '9999999999', '2018-09-13 19:02:54'),
(16, 3, 'Bom Costing Update', '192.168.0.106', NULL, '9999999999', '2018-09-13 19:04:22'),
(17, 3, 'Bom Costing Update', '192.168.0.106', NULL, '9999999999', '2018-09-13 19:07:17'),
(18, 10, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-15 03:48:57'),
(19, 3, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-15 03:51:59'),
(20, 3, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-15 03:55:00'),
(21, 3, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-15 04:08:54'),
(22, 10, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-15 04:21:14'),
(23, 11, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-15 04:31:32'),
(24, 11, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-15 04:32:35'),
(25, 3, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-15 05:40:06'),
(26, 3, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-15 08:28:12'),
(27, 10, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-15 10:23:22'),
(28, 14, 'Create', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 06:06:27'),
(29, 15, 'Create', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 06:10:09'),
(30, 14, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-16 06:11:34'),
(31, 15, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-16 06:29:35'),
(32, 1, 'Create', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 08:19:52'),
(33, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-16 08:20:54'),
(34, 3, 'Create', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 08:24:55'),
(35, 2, 'Create', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 08:45:27'),
(36, 5, 'Bom Costing Update', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 08:49:16'),
(37, 3, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-16 08:50:27'),
(38, 5, 'Update', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 09:27:51'),
(39, 5, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-16 09:31:37'),
(40, 4, 'Bom Costing Update', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 10:02:37'),
(41, 4, 'Update', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 10:05:12'),
(42, 4, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-16 10:09:36'),
(43, 2, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-16 11:34:05'),
(44, 0, 'Bom Costing Update', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-18 04:29:26'),
(45, 0, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-18 04:34:16'),
(46, 7, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-18 04:55:43'),
(47, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-18 06:11:31'),
(48, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-18 06:24:07'),
(49, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-18 06:26:10'),
(50, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-18 06:27:47'),
(51, 1, 'Bom Costing Update', '192.168.1.20', NULL, '9999999999', '2018-09-18 07:16:32'),
(52, 7, 'Update', '::1', '50-5B-C2-D3-67-29', '17F005001B', '2018-10-01 05:40:25'),
(53, 6, 'Bom Costing Update', '192.168.1.13', '50-5B-C2-D3-67-29', '9999999999', '2018-10-01 05:43:24'),
(54, 6, 'Bom Costing Update', '192.168.1.13', NULL, '17F005001B', '2018-10-01 05:53:17');

-- --------------------------------------------------------

--
-- Table structure for table `mr_bom_style_costing`
--

CREATE TABLE `mr_bom_style_costing` (
  `bom_stl_cost_id` int(11) NOT NULL,
  `stl_id` int(11) NOT NULL,
  `bom_stl_cost_wash` varchar(20) NOT NULL,
  `bom_stl_cost_wash_desc` varchar(128) DEFAULT NULL,
  `bom_stl_cost_print` varchar(20) DEFAULT NULL,
  `bom_stl_cost_cm` varchar(20) DEFAULT NULL,
  `bom_stl_cost_embroidery` varchar(20) DEFAULT NULL,
  `bom_stl_cost_commercial_cost` varchar(20) DEFAULT NULL,
  `bom_stl_cost_spc_process_cost` varchar(20) DEFAULT NULL,
  `bom_stl_cost_profit_percent` varchar(20) DEFAULT NULL,
  `bom_stl_cost_remarks` varchar(255) DEFAULT NULL,
  `bom_stl_cost_sp_machine_cost` varchar(20) DEFAULT NULL,
  `bom_stl_cost_status` enum('Approved','Declined','Submitted','') DEFAULT NULL,
  `bom_stl_cost_approve_by` int(11) DEFAULT NULL,
  `bom_stl_cost_approve_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_bom_style_costing`
--

INSERT INTO `mr_bom_style_costing` (`bom_stl_cost_id`, `stl_id`, `bom_stl_cost_wash`, `bom_stl_cost_wash_desc`, `bom_stl_cost_print`, `bom_stl_cost_cm`, `bom_stl_cost_embroidery`, `bom_stl_cost_commercial_cost`, `bom_stl_cost_spc_process_cost`, `bom_stl_cost_profit_percent`, `bom_stl_cost_remarks`, `bom_stl_cost_sp_machine_cost`, `bom_stl_cost_status`, `bom_stl_cost_approve_by`, `bom_stl_cost_approve_on`) VALUES
(2, 3, '1', 'sdfs', '2', '2', '6', '1', '1', '10', 'Approved', '1', 'Approved', NULL, NULL),
(3, 5, '1', 'asdsf', '1', '1', '1', '1', '1', '10', 'approved', '1', 'Approved', NULL, NULL),
(4, 4, '1', 'fgdfg', '1', '1', '1', '1', '1', '10', 'sfsdf', '1', NULL, NULL, NULL),
(5, 2, '1', 'e776em', '1', '2', '1', '1', '1', '5.8', 'Declined', '6', 'Declined', NULL, NULL),
(7, 7, '1', NULL, '6', '2', '6', '26', '6', '1', NULL, '8', NULL, NULL, NULL),
(8, 6, '1', 'hjghg', '1', '1', '1', '1', '1', '1', NULL, '1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mr_brand`
--

CREATE TABLE `mr_brand` (
  `br_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `br_name` varchar(255) NOT NULL,
  `br_shortname` varchar(255) NOT NULL,
  `br_country` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_brand`
--

INSERT INTO `mr_brand` (`br_id`, `b_id`, `br_name`, `br_shortname`, `br_country`) VALUES
(3, 3, 'Brand 12', 'Br123', 'Lebanon'),
(4, 6, 'rtert', 'rteter', 'Djibouti'),
(5, 8, 'Test', '234df', 'Algeria'),
(6, 6, 'tttt3423', 'eefsdfdsdf', 'Algeria'),
(7, 7, '111', 'Br1123', 'Algeria');

-- --------------------------------------------------------

--
-- Table structure for table `mr_brand_contact`
--

CREATE TABLE `mr_brand_contact` (
  `brcon_id` int(11) NOT NULL,
  `br_id` int(11) NOT NULL,
  `brcontact_person` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_brand_contact`
--

INSERT INTO `mr_brand_contact` (`brcon_id`, `br_id`, `brcontact_person`) VALUES
(2, 4, 'htyut'),
(3, 5, 'gj'),
(4, 5, 'ghj'),
(7, 6, 'sdfsddfdsf'),
(17, 3, 'Cp11'),
(18, 3, 'Cp2'),
(19, 7, 'dfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `mr_buyer`
--

CREATE TABLE `mr_buyer` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(255) NOT NULL,
  `b_shortname` varchar(255) NOT NULL,
  `b_address` varchar(255) NOT NULL,
  `b_country` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_buyer`
--

INSERT INTO `mr_buyer` (`b_id`, `b_name`, `b_shortname`, `b_address`, `b_country`) VALUES
(1, 'Buyer 1', 'B1', 'Dhaka', 'Bangladesh'),
(2, 'Buyer 2', 'dfsdf', 'fsdfsdfsdf', ''),
(4, 'H N M', 'HNM', 'Mirpur', 'American Samoa'),
(5, 'Levis', 'LVS', 'CA, USA', 'United States'),
(6, 'Buyer23', 'B23', 'address', 'Chile'),
(7, 'Test', '1234', 'sad', 'Angola'),
(8, 'test 2', 'ete', 'rgdg', 'Algeria'),
(10, 'asdaee', 'etedsdf', 'ads', 'Albania');

-- --------------------------------------------------------

--
-- Table structure for table `mr_buyer_contact`
--

CREATE TABLE `mr_buyer_contact` (
  `bcont_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `bcontact_person` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_buyer_contact`
--

INSERT INTO `mr_buyer_contact` (`bcont_id`, `b_id`, `bcontact_person`) VALUES
(6, 4, '01911518462'),
(8, 5, 'Demo, Demo 01XXXXXXXXX'),
(16, 2, 'sdfs'),
(19, 8, 'dfg'),
(20, 7, 'sdas'),
(21, 3, 'Contact Person 1'),
(22, 3, 'Contact Person 2'),
(23, 6, 'Cp1'),
(24, 10, 'sdf');

-- --------------------------------------------------------

--
-- Table structure for table `mr_capacity_reservation`
--

CREATE TABLE `mr_capacity_reservation` (
  `res_id` int(11) NOT NULL,
  `hr_unit_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `res_month` int(11) NOT NULL,
  `res_year` int(11) NOT NULL,
  `prd_type_id` int(11) NOT NULL,
  `res_quantity` int(11) NOT NULL,
  `res_sah` float NOT NULL,
  `res_status` varchar(20) DEFAULT NULL,
  `res_created_on` timestamp NULL DEFAULT NULL,
  `res_created_by` int(11) DEFAULT NULL,
  `res_updated_on` timestamp NULL DEFAULT NULL,
  `res_updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_capacity_reservation`
--

INSERT INTO `mr_capacity_reservation` (`res_id`, `hr_unit_id`, `b_id`, `res_month`, `res_year`, `prd_type_id`, `res_quantity`, `res_sah`, `res_status`, `res_created_on`, `res_created_by`, `res_updated_on`, `res_updated_by`) VALUES
(1, 1, 5, 1, 2019, 1, 5000, 0.5, NULL, '2018-09-14 18:26:43', 8, '2018-09-14 18:26:43', 8);

-- --------------------------------------------------------

--
-- Table structure for table `mr_country`
--

CREATE TABLE `mr_country` (
  `cnt_id` int(11) NOT NULL,
  `cnt_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_country`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `mr_element`
--

CREATE TABLE `mr_element` (
  `el_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `el_name` varchar(50) NOT NULL,
  `el_code` varchar(20) NOT NULL,
  `el_offset_day` int(11) DEFAULT NULL,
  `el_offset_based_on` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_element`
--

INSERT INTO `mr_element` (`el_id`, `act_id`, `el_name`, `el_code`, `el_offset_day`, `el_offset_based_on`) VALUES
(1, 3, 'EL Name', 'ElC1', 123, 'FOB'),
(4, 1, 'EL Name 2', 'ElC1', 123, 'PCD');

-- --------------------------------------------------------

--
-- Table structure for table `mr_garment_type`
--

CREATE TABLE `mr_garment_type` (
  `gmt_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `gmt_name` varchar(50) NOT NULL,
  `gmt_remarks` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_garment_type`
--

INSERT INTO `mr_garment_type` (`gmt_id`, `prd_id`, `gmt_name`, `gmt_remarks`) VALUES
(1, 1, 'test Garment', 'dsf');

-- --------------------------------------------------------

--
-- Table structure for table `mr_material_category`
--

CREATE TABLE `mr_material_category` (
  `mcat_id` int(11) NOT NULL,
  `mcat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_material_category`
--

INSERT INTO `mr_material_category` (`mcat_id`, `mcat_name`) VALUES
(1, 'Fabric'),
(2, 'Trims'),
(3, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `mr_material_color`
--

CREATE TABLE `mr_material_color` (
  `clr_id` int(11) NOT NULL,
  `clr_name` varchar(64) NOT NULL,
  `clr_code` varchar(20) NOT NULL,
  `clr_description` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_material_color`
--

INSERT INTO `mr_material_color` (`clr_id`, `clr_name`, `clr_code`, `clr_description`) VALUES
(1, 'Crimson', '#DC143C', NULL),
(2, 'Red', '#9087A', NULL),
(4, 'Megenta', '7867689', NULL),
(5, 'Yellow', '#ffff00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mr_material_item`
--

CREATE TABLE `mr_material_item` (
  `matitem_id` int(11) NOT NULL,
  `mcat_id` int(11) NOT NULL,
  `msubcat_id` int(11) NOT NULL,
  `matitem_name` varchar(50) NOT NULL,
  `matitem_code` varchar(20) NOT NULL,
  `matitem_mill_name` varchar(50) DEFAULT NULL,
  `matitem_mill_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_material_item`
--

INSERT INTO `mr_material_item` (`matitem_id`, `mcat_id`, `msubcat_id`, `matitem_name`, `matitem_code`, `matitem_mill_name`, `matitem_mill_code`) VALUES
(1, 1, 8, 'Fabric 1', 'ITC1', 'Mill Name1', 'MIC1'),
(2, 1, 9, 'Item Name 2 ', '2345', 'Mill Name2', 'MIC2'),
(19, 2, 25, 'Aravind Cotton', 'FM00001', NULL, NULL),
(20, 2, 31, '4/3 Coated', 'TT00002', NULL, NULL),
(22, 1, 25, 'Fabric', 'FM00003', NULL, NULL),
(23, 3, 30, 'Button Cotton', 'TB00004', NULL, NULL),
(24, 3, 35, 'poly', 'AP00005', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mr_material_size`
--

CREATE TABLE `mr_material_size` (
  `sz_id` int(11) NOT NULL,
  `matitem_id` int(11) NOT NULL,
  `sz_name` varchar(50) NOT NULL,
  `sz_code` varchar(20) NOT NULL,
  `sz_description` varchar(128) NOT NULL,
  `sz_inseam` varchar(20) NOT NULL,
  `sz_lenght` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_material_size`
--

INSERT INTO `mr_material_size` (`sz_id`, `matitem_id`, `sz_name`, `sz_code`, `sz_description`, `sz_inseam`, `sz_lenght`) VALUES
(1, 1, 'Size1 Updated', 'XL', 'sdfasdf', 'Inseam1', 'Length1'),
(10, 19, 'Aravind Size 1', 'ARVSZ 1', 'Size Desc', '', ''),
(11, 22, 'Fabric SZ1', 'FABSZ1', 'SZ', '', ''),
(12, 23, 'Botton Cotton SZ1', 'BTCT1', 'DESc', '', ''),
(13, 19, 'n/a', 'n/a', 'n/a', '', ''),
(14, 24, 'Large poly', 'L100', 'xdfd', 'sfdfdfg', '100');

-- --------------------------------------------------------

--
-- Table structure for table `mr_material_sub_cat`
--

CREATE TABLE `mr_material_sub_cat` (
  `msubcat_id` int(11) NOT NULL,
  `mcat_id` int(11) NOT NULL,
  `msubcat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_material_sub_cat`
--

INSERT INTO `mr_material_sub_cat` (`msubcat_id`, `mcat_id`, `msubcat_name`) VALUES
(7, 1, 'Sub_1'),
(8, 1, 'Sub_2'),
(9, 1, 'Sub_3'),
(10, 1, 'Sub_4'),
(25, 4, 'Main Fabric'),
(26, 4, 'Shell Fabric'),
(30, 5, 'Button'),
(31, 5, 'Thread'),
(32, 5, 'Zipper'),
(33, 5, 'Metal Button'),
(35, 7, 'Poly Bag'),
(36, 7, 'Hanger');

-- --------------------------------------------------------

--
-- Table structure for table `mr_mat_color_attach`
--

CREATE TABLE `mr_mat_color_attach` (
  `col_attach_id` int(11) NOT NULL,
  `col_attach_url` varchar(128) NOT NULL,
  `clr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_mat_color_attach`
--

INSERT INTO `mr_mat_color_attach` (`col_attach_id`, `col_attach_url`, `clr_id`) VALUES
(45, '/assets/files/materialcolor/5b8e3b637ff38.jpeg', 4),
(53, '/assets/files/materialcolor/5b8e4ab15d10b.png', 2),
(54, '/assets/files/materialcolor/5b8e42a8b58dd.png', 2),
(57, '/assets/files/materialcolor/5b8e4b2ceb8c1.png', 5),
(58, '/assets/files/materialcolor/5b93979403b9e.jpg', 5),
(59, '/assets/files/materialcolor/5b99f5146b61a.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mr_operation`
--

CREATE TABLE `mr_operation` (
  `opr_id` int(11) NOT NULL,
  `opr_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_operation`
--

INSERT INTO `mr_operation` (`opr_id`, `opr_name`) VALUES
(1, 'Op1'),
(2, 'Op2'),
(3, 'Embroidery'),
(5, 'Quelting');

-- --------------------------------------------------------

--
-- Table structure for table `mr_order_entry`
--

CREATE TABLE `mr_order_entry` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(30) NOT NULL,
  `res_id` int(11) NOT NULL,
  `br_id` int(11) NOT NULL,
  `order_month` int(11) NOT NULL,
  `order_year` int(11) NOT NULL,
  `se_id` int(11) NOT NULL,
  `stl_id` int(11) NOT NULL,
  `order_qty` varchar(30) NOT NULL,
  `order_delivery_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_order_entry`
--

INSERT INTO `mr_order_entry` (`order_id`, `order_code`, `res_id`, `br_id`, `order_month`, `order_year`, `se_id`, `stl_id`, `order_qty`, `order_delivery_date`) VALUES
(1, 'B123', 1, 1, 1, 1, 1, 1, '1', '2018-09-05'),
(2, 'V258', 2, 2, 2, 2, 2, 2, '2', '2018-09-15');

-- --------------------------------------------------------

--
-- Table structure for table `mr_pi_entry`
--

CREATE TABLE `mr_pi_entry` (
  `pi_entry_id` int(11) NOT NULL,
  `pi_entry_no` varchar(45) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `pi_entry_date` date DEFAULT NULL,
  `pi_entry_category` varchar(45) DEFAULT NULL,
  `pi_entry_last_date` date DEFAULT NULL,
  `pi_entry_shipmode` varchar(45) DEFAULT NULL,
  `pi_entry_type` int(11) DEFAULT NULL,
  `pi_entry_created_by` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pi_entry_updated_by` varchar(45) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_pi_entry`
--

INSERT INTO `mr_pi_entry` (`pi_entry_id`, `pi_entry_no`, `sup_id`, `pi_entry_date`, `pi_entry_category`, `pi_entry_last_date`, `pi_entry_shipmode`, `pi_entry_type`, `pi_entry_created_by`, `created_at`, `pi_entry_updated_by`, `updated_at`, `unit_id`) VALUES
(1, '1', 1, '2018-10-02', '1', NULL, NULL, NULL, NULL, '2018-10-18 06:59:28', NULL, NULL, 1),
(2, '2', 1, '2018-10-02', '1', NULL, NULL, NULL, NULL, '2018-10-18 06:59:28', NULL, '2018-10-25 07:28:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mr_pi_order`
--

CREATE TABLE `mr_pi_order` (
  `pi_order_id` int(11) NOT NULL,
  `pi_entry_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_pi_order`
--

INSERT INTO `mr_pi_order` (`pi_order_id`, `pi_entry_id`, `order_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mr_po_sub_style`
--

CREATE TABLE `mr_po_sub_style` (
  `po_sub_style_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `po_sub_style_name` varchar(50) NOT NULL,
  `prdsz_id` int(11) NOT NULL,
  `clr_id` int(11) NOT NULL,
  `po_sub_style_qty` int(11) NOT NULL,
  `po_sub_style_deliv_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_po_sub_style`
--

INSERT INTO `mr_po_sub_style` (`po_sub_style_id`, `po_id`, `po_sub_style_name`, `prdsz_id`, `clr_id`, `po_sub_style_qty`, `po_sub_style_deliv_date`) VALUES
(1, 1, 'PO Sub Style Name 1', 1, 1, 100, '2018-08-11'),
(2, 3, 'dasdas', 1, 1, 121, '2018-08-13'),
(3, 4, 'sdfsdf', 1, 1, 343, '2018-08-12'),
(4, 5, 'dasdas', 1, 1, 432, '2018-08-12'),
(5, 5, 'sdfdsa', 1, 1, 34, '2018-08-12');

-- --------------------------------------------------------

--
-- Table structure for table `mr_product_lib`
--

CREATE TABLE `mr_product_lib` (
  `prodlib_id` int(11) NOT NULL,
  `stp_id` int(11) NOT NULL,
  `gmt_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `prdsz_id` int(11) NOT NULL,
  `prodlib_name` varchar(50) NOT NULL,
  `prodlib_description` varchar(128) NOT NULL,
  `prodlib_shortcode` varchar(20) NOT NULL,
  `prodlib_smv` varchar(20) NOT NULL,
  `prodlib_cm` varchar(20) NOT NULL,
  `prodlib_wash` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_product_lib`
--

INSERT INTO `mr_product_lib` (`prodlib_id`, `stp_id`, `gmt_id`, `b_id`, `prdsz_id`, `prodlib_name`, `prodlib_description`, `prodlib_shortcode`, `prodlib_smv`, `prodlib_cm`, `prodlib_wash`) VALUES
(1, 2, 1, 1, 1, 'test prod', 'test prod description', '12345', '112', '22', '87');

-- --------------------------------------------------------

--
-- Table structure for table `mr_product_lib_operarion`
--

CREATE TABLE `mr_product_lib_operarion` (
  `prodlibop_id` int(11) NOT NULL,
  `prodlib_id` int(11) NOT NULL,
  `opr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_product_lib_operarion`
--

INSERT INTO `mr_product_lib_operarion` (`prodlibop_id`, `prodlib_id`, `opr_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mr_product_lib_sp_machine`
--

CREATE TABLE `mr_product_lib_sp_machine` (
  `prodlibspmachine_id` int(11) NOT NULL,
  `prodlib_id` int(11) NOT NULL,
  `spmachine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_product_lib_sp_machine`
--

INSERT INTO `mr_product_lib_sp_machine` (`prodlibspmachine_id`, `prodlib_id`, `spmachine_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mr_product_size`
--

CREATE TABLE `mr_product_size` (
  `prdsz_id` int(11) NOT NULL,
  `prdsz_size` varchar(20) DEFAULT '0',
  `prdsz_group` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_product_size`
--

INSERT INTO `mr_product_size` (`prdsz_id`, `prdsz_size`, `prdsz_group`) VALUES
(8, '0', 'BIG'),
(49, '0', 'LARGE'),
(51, '0', 'MEDIUM'),
(11, '0', 'REGULAR'),
(50, 'BABY', 'LARGE'),
(52, 'M', 'MEDIUM'),
(13, 'M', 'REGULAR'),
(10, 'S', 'BIG'),
(9, 'XL', 'BIG'),
(12, 'XL', 'REGULAR');

-- --------------------------------------------------------

--
-- Table structure for table `mr_product_type`
--

CREATE TABLE `mr_product_type` (
  `prd_type_id` int(11) NOT NULL,
  `prd_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_product_type`
--

INSERT INTO `mr_product_type` (`prd_type_id`, `prd_type_name`) VALUES
(1, 'Top'),
(2, 'Bottom');

-- --------------------------------------------------------

--
-- Table structure for table `mr_purchase_order`
--

CREATE TABLE `mr_purchase_order` (
  `po_id` int(11) NOT NULL,
  `po_no` varchar(20) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `b_id` int(11) NOT NULL,
  `br_id` int(11) NOT NULL,
  `po_file_attachment` varchar(128) NOT NULL,
  `se_id` int(11) NOT NULL,
  `po_agreement_no` int(11) NOT NULL,
  `po_qty` int(11) NOT NULL,
  `po_value` varchar(64) NOT NULL,
  `po_currency` varchar(64) NOT NULL,
  `stl_id` int(11) NOT NULL,
  `po_inco_location` varchar(128) NOT NULL,
  `po_fob_date` datetime NOT NULL,
  `po_ship_date` datetime NOT NULL,
  `po_fabric_code` varchar(20) NOT NULL,
  `po_fab_construct` varchar(128) NOT NULL,
  `po_release_date` datetime NOT NULL,
  `po_doc_type` varchar(20) NOT NULL,
  `po_inco_term` varchar(128) NOT NULL,
  `po_remarks` varchar(128) NOT NULL,
  `po_pcd` datetime NOT NULL,
  `po_planned_ex_fty` datetime NOT NULL,
  `po_original_ex_fty` datetime NOT NULL,
  `po_delivery_address` varchar(128) NOT NULL,
  `po_unit_price` varchar(20) NOT NULL,
  `po_trans_mode` varchar(20) NOT NULL,
  `po_hot_shipment` enum('Y','N') NOT NULL,
  `po_vas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mr_sample_style`
--

CREATE TABLE `mr_sample_style` (
  `sam_stl_id` int(11) NOT NULL,
  `sample_id` int(11) UNSIGNED NOT NULL,
  `stl_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_sample_style`
--

INSERT INTO `mr_sample_style` (`sam_stl_id`, `sample_id`, `stl_id`) VALUES
(1, 1, 1),
(3, 1, 3),
(4, 1, 4),
(29, 4, 10),
(30, 4, 11),
(31, 5, 11),
(34, 4, 12),
(35, 5, 12),
(36, 4, 13),
(37, 5, 13),
(38, 1, 14),
(39, 1, 15),
(40, 1, 1),
(42, 1, 3),
(43, 1, 4),
(44, 1, 5),
(45, 1, 6),
(47, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `mr_sample_type`
--

CREATE TABLE `mr_sample_type` (
  `sample_id` int(11) UNSIGNED NOT NULL,
  `sample_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_sample_type`
--

INSERT INTO `mr_sample_type` (`sample_id`, `sample_name`) VALUES
(1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `mr_season`
--

CREATE TABLE `mr_season` (
  `se_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `se_name` varchar(50) NOT NULL,
  `se_code` varchar(20) NOT NULL,
  `se_mm_start` int(11) DEFAULT NULL,
  `se_yy_start` int(11) DEFAULT NULL,
  `se_mm_end` int(11) DEFAULT NULL,
  `se_yy_end` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_season`
--

INSERT INTO `mr_season` (`se_id`, `b_id`, `se_name`, `se_code`, `se_mm_start`, `se_yy_start`, `se_mm_end`, `se_yy_end`) VALUES
(1, 1, 'Spring 1', 'Sp1', 6, 2018, 12, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `mr_size_lib`
--

CREATE TABLE `mr_size_lib` (
  `sz_lib_id` int(11) NOT NULL,
  `size_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_size_lib`
--

INSERT INTO `mr_size_lib` (`sz_lib_id`, `size_name`) VALUES
(1, 'BABY'),
(2, 'XXS'),
(3, 'XS'),
(4, 'S'),
(5, 'M'),
(6, 'L'),
(7, 'XL'),
(8, 'XXL'),
(9, '3XL'),
(10, '4XL'),
(11, '5XL'),
(12, '6XL'),
(13, '7XL');

-- --------------------------------------------------------

--
-- Table structure for table `mr_special_machine`
--

CREATE TABLE `mr_special_machine` (
  `spmachine_id` int(11) NOT NULL,
  `spmachine_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_special_machine`
--

INSERT INTO `mr_special_machine` (`spmachine_id`, `spmachine_name`) VALUES
(1, 'Machine 1'),
(2, 'Machine 2'),
(4, 'ZSK Embroidery Double Print'),
(5, 'Quelting Machine');

-- --------------------------------------------------------

--
-- Table structure for table `mr_style`
--

CREATE TABLE `mr_style` (
  `stl_id` int(11) NOT NULL,
  `stl_order_type` enum('Bulk','Development') NOT NULL,
  `b_id` int(11) NOT NULL,
  `stl_no` varchar(30) NOT NULL,
  `stl_code` varchar(20) NOT NULL,
  `prd_type_id` int(11) NOT NULL,
  `gmt_id` int(11) NOT NULL,
  `prdsz_id` int(11) NOT NULL,
  `stl_product_name` varchar(50) NOT NULL,
  `stl_description` varchar(128) NOT NULL,
  `se_id` int(11) NOT NULL,
  `stl_smv` varchar(20) NOT NULL,
  `stl_cm` varchar(20) NOT NULL,
  `stl_wash` varchar(20) NOT NULL,
  `stl_addedby` int(11) NOT NULL,
  `stl_added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stl_updated_by` int(11) DEFAULT NULL,
  `stl_updated_on` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_style`
--

INSERT INTO `mr_style` (`stl_id`, `stl_order_type`, `b_id`, `stl_no`, `stl_code`, `prd_type_id`, `gmt_id`, `prdsz_id`, `stl_product_name`, `stl_description`, `se_id`, `stl_smv`, `stl_cm`, `stl_wash`, `stl_addedby`, `stl_added_on`, `stl_updated_by`, `stl_updated_on`) VALUES
(1, 'Development', 1, '0001', 'BP00001', 1, 1, 8, 'Prod1', 'sdsdf', 1, '1', '1', '1', 1, '2018-09-16 08:13:26', NULL, NULL),
(2, 'Development', 1, '0002', 'BP00002', 2, 1, 49, 'Prod2', 'ddfsdf', 1, '2', '1', '1', 1, '2018-09-16 08:14:42', 1, '2018-09-18 10:50:07'),
(3, 'Bulk', 1, '0002', 'BP00002', 2, 1, 49, 'Prod2', 'ddfsdf', 1, '2', '1', '1', 1, '2018-09-16 08:15:05', NULL, NULL),
(4, 'Bulk', 1, '0001', 'BP00001', 1, 1, 8, 'Prod1', 'sdsdf', 1, '1', '1', '1', 1, '2018-09-16 08:15:29', NULL, NULL),
(5, 'Development', 1, '0003', 'BP00002', 1, 1, 11, 'prod 3', 'dfgdf', 1, '2', '2', '1', 1, '2018-09-16 08:47:11', NULL, NULL),
(6, 'Bulk', 1, '0003', 'BP00002', 1, 1, 11, 'prod 3', 'dfgdf', 1, '2', '2', '1', 1, '2018-09-16 08:47:40', NULL, NULL),
(7, 'Development', 1, '123123', 'BS00003', 1, 1, 8, 'sadasdasd', 'dwed', 1, '2', '33', '1', 1, '2018-09-18 04:29:00', 1, '2018-09-18 04:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `mr_style_costing_file_attach`
--

CREATE TABLE `mr_style_costing_file_attach` (
  `cost_style_file_id` int(11) NOT NULL,
  `stl_id` int(11) NOT NULL,
  `cost_style_file_attach` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_style_costing_file_attach`
--

INSERT INTO `mr_style_costing_file_attach` (`cost_style_file_id`, `stl_id`, `cost_style_file_attach`) VALUES
(3, 3, '/assets/files/bomcosting/5b9e1953be6a2.jpg'),
(4, 5, '/assets/files/bomcosting/5b9e22f9759f1.png'),
(5, 1, '/assets/files/bomcosting/5ba09ae3c2b4e.png'),
(6, 1, '/assets/files/bomcosting/5ba09ae3cdda5.png'),
(12, 7, '/assets/files/bomcosting/5ba0e073d8d8d.docx'),
(13, 7, '/assets/files/bomcosting/5ba0e5d63a4cf.docx');

-- --------------------------------------------------------

--
-- Table structure for table `mr_style_history`
--

CREATE TABLE `mr_style_history` (
  `stl_history_id` int(11) UNSIGNED NOT NULL,
  `stl_id` int(11) UNSIGNED NOT NULL,
  `stl_history_desc` enum('Create','Update','Delete') NOT NULL,
  `stl_history_ip` varchar(20) DEFAULT NULL,
  `stl_history_mac` varchar(20) DEFAULT NULL,
  `stl_history_userid` varchar(10) DEFAULT NULL,
  `stl_history_datetime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_style_history`
--

INSERT INTO `mr_style_history` (`stl_history_id`, `stl_id`, `stl_history_desc`, `stl_history_ip`, `stl_history_mac`, `stl_history_userid`, `stl_history_datetime`) VALUES
(1, 1, 'Create', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 14:13:27'),
(2, 2, 'Create', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 14:14:42'),
(3, 3, 'Create', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 14:15:05'),
(4, 4, 'Create', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 14:15:30'),
(5, 5, 'Create', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 14:47:12'),
(6, 6, 'Create', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-16 14:47:40'),
(7, 7, 'Create', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-18 10:29:01'),
(8, 7, 'Update', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-18 10:30:24'),
(9, 7, 'Update', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-18 10:30:59'),
(10, 7, 'Update', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-18 10:34:53'),
(11, 2, 'Update', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-18 16:50:08'),
(12, 2, 'Update', '192.168.1.20', '50-5B-C2-D3-67-29', '9999999999', '2018-09-18 16:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `mr_style_operation`
--

CREATE TABLE `mr_style_operation` (
  `style_op_id` int(11) UNSIGNED NOT NULL,
  `stl_id` int(11) UNSIGNED NOT NULL,
  `opr_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_style_operation`
--

INSERT INTO `mr_style_operation` (`style_op_id`, `stl_id`, `opr_id`) VALUES
(1, 1, 1),
(3, 3, 2),
(4, 4, 2),
(14, 10, 3),
(15, 11, 3),
(17, 12, 3),
(18, 13, 3),
(19, 14, 1),
(20, 15, 1),
(21, 1, 1),
(24, 3, 2),
(25, 3, 1),
(26, 4, 1),
(27, 4, 1),
(28, 5, 2),
(29, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mr_style_sp_machine`
--

CREATE TABLE `mr_style_sp_machine` (
  `stl_sp_machine_id` int(11) UNSIGNED NOT NULL,
  `stl_id` int(11) UNSIGNED NOT NULL,
  `sp_machine_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_style_sp_machine`
--

INSERT INTO `mr_style_sp_machine` (`stl_sp_machine_id`, `stl_id`, `sp_machine_id`) VALUES
(1, 1, 1),
(3, 3, 2),
(4, 4, 2),
(14, 10, 5),
(15, 11, 5),
(17, 12, 4),
(18, 13, 4),
(19, 14, 1),
(20, 15, 1),
(21, 1, 1),
(23, 3, 1),
(24, 4, 1),
(25, 4, 1),
(26, 5, 2),
(27, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mr_style_type`
--

CREATE TABLE `mr_style_type` (
  `stp_id` int(11) NOT NULL,
  `stp_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mr_supplier`
--

CREATE TABLE `mr_supplier` (
  `sup_id` int(11) NOT NULL,
  `cnt_id` int(11) NOT NULL,
  `sup_name` varchar(50) NOT NULL,
  `sup_address` varchar(128) DEFAULT NULL,
  `sup_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_supplier`
--

INSERT INTO `mr_supplier` (`sup_id`, `cnt_id`, `sup_name`, `sup_address`, `sup_type`) VALUES
(1, 97, 'Tifik', 'Hunululu', 'Foreign'),
(3, 3, 'SCRIPT HOUSE LTD.', 'Motijheel', 'Local'),
(4, 227, 'Khan', 'hunululi', 'Foreign');

-- --------------------------------------------------------

--
-- Table structure for table `mr_sup_contact_person_info`
--

CREATE TABLE `mr_sup_contact_person_info` (
  `scp_id` int(11) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `scp_details` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_sup_contact_person_info`
--

INSERT INTO `mr_sup_contact_person_info` (`scp_id`, `sup_id`, `scp_details`) VALUES
(3, 4, 'dfa'),
(4, 4, 'gthgh'),
(5, 4, 'ghgh'),
(23, 5, 'C2'),
(24, 5, 'C3'),
(25, 5, 'C4');

-- --------------------------------------------------------

--
-- Table structure for table `mr_time_action_plan`
--

CREATE TABLE `mr_time_action_plan` (
  `tna_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `el_id` int(11) NOT NULL,
  `tna_offset_day` int(20) NOT NULL,
  `tna_pcd_date` date DEFAULT NULL,
  `tna_fob_date` date DEFAULT NULL,
  `as_id` int(11) NOT NULL,
  `tna_status` enum('Ongoing','Processed','','') NOT NULL DEFAULT 'Ongoing',
  `tna_actual_date` date DEFAULT NULL,
  `tna_remarks` varchar(128) DEFAULT NULL,
  `tna_created_by` int(11) NOT NULL,
  `tna_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tna_updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tna_updated_by` int(11) DEFAULT NULL,
  `unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'users_management', 'web', '2018-04-17 03:56:03', '2018-05-24 00:39:00'),
(24, 'hr_recruitment_employer_list', 'web', '2018-05-30 02:05:53', '2018-05-30 02:05:53'),
(25, 'hr_recruitment_job_posting', 'web', '2018-05-30 02:25:43', '2018-05-30 02:25:43'),
(26, 'hr_recruitment_job_interview', 'web', '2018-05-30 02:30:50', '2018-05-30 02:30:50'),
(27, 'hr_recruitment_job_letter', 'web', '2018-05-30 02:40:23', '2018-05-30 02:40:23'),
(29, 'hr_recruitment_op_medical_list', 'web', '2018-05-30 02:55:50', '2018-05-30 02:58:41'),
(31, 'hr_recruitment_op_adv_list', 'web', '2018-05-30 03:07:11', '2018-05-30 03:07:11'),
(32, 'hr_recruitment_op_benefit', 'web', '2018-05-30 03:22:55', '2018-05-30 03:22:55'),
(33, 'hr_recruitment_op_medical_incident', 'web', '2018-05-30 23:26:13', '2018-05-30 23:26:13'),
(34, 'hr_training_add', 'web', '2018-05-30 23:34:51', '2018-05-30 23:34:51'),
(35, 'hr_training_list', 'web', '2018-05-30 23:35:13', '2018-05-30 23:35:13'),
(36, 'hr_training_assign', 'web', '2018-05-30 23:39:11', '2018-05-30 23:39:11'),
(37, 'hr_training_assign_list', 'web', '2018-05-30 23:39:17', '2018-05-30 23:39:17'),
(38, 'hr_asset_assign_list', 'web', '2018-05-30 23:50:16', '2018-05-30 23:50:16'),
(39, 'hr_asset_assign', 'web', '2018-05-30 23:50:22', '2018-05-30 23:50:22'),
(40, 'hr_time_daily_att_list', 'web', '2018-05-31 00:02:15', '2018-05-31 00:02:15'),
(41, 'hr_time_manual_att', 'web', '2018-05-31 00:05:41', '2018-05-31 00:05:41'),
(42, 'hr_time_worker_leave', 'web', '2018-05-31 00:09:36', '2018-05-31 00:09:36'),
(43, 'hr_time_leaves', 'web', '2018-05-31 00:17:23', '2018-05-31 00:17:23'),
(44, 'hr_time_shift_assign', 'web', '2018-05-31 00:29:36', '2018-05-31 00:29:36'),
(45, 'hr_time_shift_roaster', 'web', '2018-05-31 00:29:45', '2018-05-31 00:29:45'),
(46, 'hr_time_op_holiday', 'web', '2018-05-31 00:33:10', '2018-05-31 00:33:10'),
(47, 'hr_time_op_without_pay', 'web', '2018-05-31 00:36:28', '2018-05-31 00:36:28'),
(48, 'hr_time_id_card', 'web', '2018-05-31 00:39:19', '2018-05-31 00:39:19'),
(49, 'hr_payroll_ot', 'web', '2018-05-31 00:45:41', '2018-05-31 00:45:41'),
(50, 'hr_payroll_benefit_list', 'web', '2018-05-31 00:49:04', '2018-05-31 00:49:04'),
(51, 'hr_payroll_loan_list', 'web', '2018-05-31 00:56:25', '2018-05-31 00:56:25'),
(52, 'hr_ess_grievance_appeal', 'web', '2018-05-31 01:11:53', '2018-05-31 01:11:53'),
(53, 'hr_ess_grievance_list', 'web', '2018-05-31 01:12:10', '2018-05-31 01:12:10'),
(54, 'hr_ess_loan_application', 'web', '2018-05-31 01:16:46', '2018-05-31 01:16:46'),
(55, 'hr_ess_leave_application', 'web', '2018-05-31 01:19:52', '2018-05-31 01:19:52'),
(56, 'hr_performance_appraisal', 'web', '2018-05-31 01:36:28', '2018-05-31 01:36:28'),
(57, 'hr_performance_list', 'web', '2018-05-31 01:41:46', '2018-05-31 01:41:46'),
(58, 'hr_performance_op_disc', 'web', '2018-05-31 01:46:49', '2018-05-31 01:46:49'),
(59, 'hr_performance_op_disc_list', 'web', '2018-05-31 01:46:56', '2018-05-31 01:46:56'),
(60, 'hr_setup', 'web', '2018-05-31 01:55:50', '2018-05-31 01:55:50'),
(61, 'hr_time_op_hdoliday', 'web', '2018-06-06 03:25:43', '2018-06-06 03:25:43'),
(62, 'hr_recruitment_worker', 'web', '2018-06-26 22:39:56', '2018-06-26 22:39:56'),
(63, 'hr_payroll_salary', 'web', '2018-06-28 05:53:55', '2018-06-28 05:53:55'),
(64, 'hr_notification', 'web', '2018-07-16 13:00:50', '2018-07-16 13:00:50'),
(65, 'hr_recruitment_medical', 'web', '2018-07-18 17:23:50', '2018-07-18 17:23:50'),
(66, 'mr_setup', 'web', '2018-08-01 23:21:17', '2018-08-01 23:21:17'),
(67, 'mr_bom_costing_approval_list', 'web', '2018-10-01 02:52:15', '2018-10-01 02:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(4, 'users_management', 'web', NULL, '2018-05-30 02:07:30'),
(5, 'hr_admin', 'web', '2018-05-30 02:06:59', '2018-05-30 02:18:50'),
(6, 'hr_management', 'web', '2018-06-03 21:50:16', '2018-06-03 21:50:16'),
(7, 'hr_supervisor', 'web', '2018-06-03 23:37:33', '2018-06-03 23:37:33'),
(8, 'hr_executive', 'web', '2018-06-03 23:46:13', '2018-06-03 23:46:13'),
(9, 'hr_executive_recruitment', 'web', '2018-06-03 23:48:10', '2018-06-03 23:48:10'),
(10, 'hr_executive_training', 'web', '2018-06-03 23:48:45', '2018-06-03 23:48:45'),
(11, 'hr_executive_asset', 'web', '2018-06-03 23:49:35', '2018-06-03 23:49:35'),
(12, 'hr_executive_time_att', 'web', '2018-06-03 23:54:56', '2018-06-03 23:54:56'),
(13, 'hr_executive_payroll', 'web', '2018-06-03 23:56:11', '2018-06-03 23:56:11'),
(14, 'hr_associate', 'web', '2018-06-03 23:57:12', '2018-06-03 23:57:12'),
(15, 'hr_executive_performance', 'web', '2018-06-03 23:58:27', '2018-06-03 23:58:27'),
(16, 'hr_medical', 'web', '2018-07-18 17:25:00', '2018-07-18 17:25:00'),
(17, 'mr_admin', 'web', '2018-08-01 23:21:59', '2018-08-01 23:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_has_permissions`
--

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
(65, 16),
(66, 17),
(67, 17);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `associate_id` varchar(10) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `password_request` tinyint(1) DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `associate_id`, `email`, `password`, `password_request`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '9999999999', 'admin@muktiventures.com', '$2y$10$NUvyjW1US3mZzAAZ2jkxleNqnJBT8lglHIZhrKFbzyICBC/tvsSka', 0, 'n2y9PklpMtre6D4Eq2E7mNuPp79RiMiMrXF1AeVKpboav8YoaUiX1vPlS35u', '2018-04-29 05:30:41', '2018-08-01 23:22:46'),
(8, 'MBM IT', '17F005001B', 'mbmit@example.com', '$2y$10$YRVZsgt1ULZRRE8th1GHgeMOvv3lwJcF8x7p5/Ca.IrUJ6m3B2DFy', 0, '59ZcK4RGtzG9KBXSUgAeXzyHyMCdkzuZVCi0ZakJPpBrkch9N5qimQ8Asy7s', '2018-07-17 12:13:29', '2018-07-17 12:13:29'),
(9, 'RASHED KHAN', '18G100011N', 'hr@aql-bd.com', '$2y$10$8AqcqZkEkN0zEMVZOnvnCuQf25g3nO556iQqPvNCxy3WJZaqwGgqu', 0, NULL, '2018-07-18 16:46:17', '2018-07-18 16:46:17'),
(10, 'RUBEL KHAN', '18A100002N', 'rubel@example.com', '$2y$10$jjZ3ajwZJCYMF57X59cdTeiE1MJ86sAf9Dy9kgLhPM5Op.6YDiDzy', 0, '2EUWV5MAsd31hVC19NheawmhJT1P1B6O4b78HbAH4PWwHGNqn1lHDGCiA19x', '2018-07-18 17:26:58', '2018-07-18 17:26:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkinout`
--
ALTER TABLE `checkinout`
  ADD PRIMARY KEY (`Logid`),
  ADD UNIQUE KEY `Userid` (`Userid`,`CheckTime`);

--
-- Indexes for table `com_b2b_entry`
--
ALTER TABLE `com_b2b_entry`
  ADD PRIMARY KEY (`b2b_id`);

--
-- Indexes for table `com_bank`
--
ALTER TABLE `com_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `com_bank_accno`
--
ALTER TABLE `com_bank_accno`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `com_exp_lc_close`
--
ALTER TABLE `com_exp_lc_close`
  ADD PRIMARY KEY (`exp_lc_close_id`);

--
-- Indexes for table `com_exp_lc_entry`
--
ALTER TABLE `com_exp_lc_entry`
  ADD PRIMARY KEY (`exp_lc_id`);

--
-- Indexes for table `com_exp_lc_entry_address`
--
ALTER TABLE `com_exp_lc_entry_address`
  ADD PRIMARY KEY (`exp_lc_entry_adr_id`);

--
-- Indexes for table `com_exp_lc_entry_ammendment`
--
ALTER TABLE `com_exp_lc_entry_ammendment`
  ADD PRIMARY KEY (`exp_lc_amend_id`);

--
-- Indexes for table `com_exp_lc_history`
--
ALTER TABLE `com_exp_lc_history`
  ADD PRIMARY KEY (`exp_lc_history_id`);

--
-- Indexes for table `com_foc_lc`
--
ALTER TABLE `com_foc_lc`
  ADD PRIMARY KEY (`foc_lc_id`);

--
-- Indexes for table `com_foc_lc_elcno`
--
ALTER TABLE `com_foc_lc_elcno`
  ADD PRIMARY KEY (`foc_lc_elc_id`);

--
-- Indexes for table `com_import_data_entry`
--
ALTER TABLE `com_import_data_entry`
  ADD PRIMARY KEY (`imp_data_entry_id`);

--
-- Indexes for table `com_import_data_entry_history`
--
ALTER TABLE `com_import_data_entry_history`
  ADD PRIMARY KEY (`imp_data_entry_history_id`);

--
-- Indexes for table `com_import_data_entry_import_fab`
--
ALTER TABLE `com_import_data_entry_import_fab`
  ADD PRIMARY KEY (`imp_data_entry_import_fab_id`);

--
-- Indexes for table `com_import_data_entry_invoice`
--
ALTER TABLE `com_import_data_entry_invoice`
  ADD PRIMARY KEY (`imp_data_entry_invoice_id`);

--
-- Indexes for table `com_import_data_entry_machinery`
--
ALTER TABLE `com_import_data_entry_machinery`
  ADD PRIMARY KEY (`imp_data_machinery_id`),
  ADD KEY `fk_import_data_entry_com_bank1_idx` (`bank_id`),
  ADD KEY `fk_import_data_entry_com_port1_idx` (`port_id`),
  ADD KEY `fk_import_data_entry_com_vessel1_idx` (`vess_id`),
  ADD KEY `fk_import_data_entry_com_voyage_vessel1_idx` (`voyage_id`),
  ADD KEY `fk_com_import_data_entry_mr_pi_order1_idx` (`pi_order_id`),
  ADD KEY `fk_import_data_entry_com_exp_lc_entry1_idx` (`machinery_pi_fileno`),
  ADD KEY `fk_com_import_data_entry_machinery_com_b2b_machinery1_idx` (`imp_data_machinery_master_lc_no`);

--
-- Indexes for table `com_import_data_entry_machinery_invoice`
--
ALTER TABLE `com_import_data_entry_machinery_invoice`
  ADD PRIMARY KEY (`imp_data_machinery_inv_id`);

--
-- Indexes for table `com_import_data_machinery_history`
--
ALTER TABLE `com_import_data_machinery_history`
  ADD PRIMARY KEY (`imp_data_machn_history_id`);

--
-- Indexes for table `com_insurance_company`
--
ALTER TABLE `com_insurance_company`
  ADD PRIMARY KEY (`insurance_comp_id`);

--
-- Indexes for table `com_item`
--
ALTER TABLE `com_item`
  ADD PRIMARY KEY (`com_item_id`);

--
-- Indexes for table `com_machinery_master_info`
--
ALTER TABLE `com_machinery_master_info`
  ADD PRIMARY KEY (`machinery_master_info_id`);

--
-- Indexes for table `com_machinery_pi`
--
ALTER TABLE `com_machinery_pi`
  ADD PRIMARY KEY (`machinery_pi_id`);

--
-- Indexes for table `com_machinery_pi_history`
--
ALTER TABLE `com_machinery_pi_history`
  ADD PRIMARY KEY (`machinery_pi_history_id`);

--
-- Indexes for table `com_machinery_pi_order`
--
ALTER TABLE `com_machinery_pi_order`
  ADD PRIMARY KEY (`machinery_pi_order_id`);

--
-- Indexes for table `com_machine_manufacturer`
--
ALTER TABLE `com_machine_manufacturer`
  ADD PRIMARY KEY (`manf_id`);

--
-- Indexes for table `com_machine_type`
--
ALTER TABLE `com_machine_type`
  ADD PRIMARY KEY (`machine_type_id`);

--
-- Indexes for table `com_master_pi_accessories`
--
ALTER TABLE `com_master_pi_accessories`
  ADD PRIMARY KEY (`master_pi_acss_id`);

--
-- Indexes for table `com_master_pi_accessories_item`
--
ALTER TABLE `com_master_pi_accessories_item`
  ADD PRIMARY KEY (`master_pi_acss_item_id`);

--
-- Indexes for table `com_master_pi_fabric`
--
ALTER TABLE `com_master_pi_fabric`
  ADD PRIMARY KEY (`master_pi_fab_id`);

--
-- Indexes for table `com_pi_type`
--
ALTER TABLE `com_pi_type`
  ADD PRIMARY KEY (`pi_id`);

--
-- Indexes for table `com_port`
--
ALTER TABLE `com_port`
  ADD PRIMARY KEY (`port_id`);

--
-- Indexes for table `com_section`
--
ALTER TABLE `com_section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `com_ud_library_fab_pock`
--
ALTER TABLE `com_ud_library_fab_pock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `com_vessel`
--
ALTER TABLE `com_vessel`
  ADD PRIMARY KEY (`vess_id`);

--
-- Indexes for table `com_voyage_vessel`
--
ALTER TABLE `com_voyage_vessel`
  ADD PRIMARY KEY (`voyage_id`);

--
-- Indexes for table `fin_asset`
--
ALTER TABLE `fin_asset`
  ADD PRIMARY KEY (`fin_asset_id`),
  ADD KEY `FK_fin_asset_fin_asset_product` (`fin_asset_product_id`);

--
-- Indexes for table `fin_asset_category`
--
ALTER TABLE `fin_asset_category`
  ADD PRIMARY KEY (`fin_asset_cat_id`);

--
-- Indexes for table `fin_asset_product`
--
ALTER TABLE `fin_asset_product`
  ADD PRIMARY KEY (`fin_asset_product_id`),
  ADD KEY `FK_fin_asset_product_fin_asset_category` (`fin_asset_product_cat_id`);

--
-- Indexes for table `hr_area`
--
ALTER TABLE `hr_area`
  ADD PRIMARY KEY (`hr_area_id`);

--
-- Indexes for table `hr_asset_assign`
--
ALTER TABLE `hr_asset_assign`
  ADD PRIMARY KEY (`hr_asset_assign_id`),
  ADD KEY `FK_hr_asset_assign_fin_asset` (`hr_fin_asset_id`);

--
-- Indexes for table `hr_associate_status_tracker`
--
ALTER TABLE `hr_associate_status_tracker`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `hr_as_basic_info`
--
ALTER TABLE `hr_as_basic_info`
  ADD PRIMARY KEY (`as_id`);

--
-- Indexes for table `hr_attendance`
--
ALTER TABLE `hr_attendance`
  ADD PRIMARY KEY (`att_id`);

--
-- Indexes for table `hr_attendance_manual`
--
ALTER TABLE `hr_attendance_manual`
  ADD PRIMARY KEY (`hr_att_id`);

--
-- Indexes for table `hr_benefits`
--
ALTER TABLE `hr_benefits`
  ADD PRIMARY KEY (`ben_id`);

--
-- Indexes for table `hr_department`
--
ALTER TABLE `hr_department`
  ADD PRIMARY KEY (`hr_department_id`);

--
-- Indexes for table `hr_designation`
--
ALTER TABLE `hr_designation`
  ADD PRIMARY KEY (`hr_designation_id`);

--
-- Indexes for table `hr_dist`
--
ALTER TABLE `hr_dist`
  ADD PRIMARY KEY (`dis_id`);

--
-- Indexes for table `hr_dis_rec`
--
ALTER TABLE `hr_dis_rec`
  ADD PRIMARY KEY (`dis_re_id`);

--
-- Indexes for table `hr_earn_leave`
--
ALTER TABLE `hr_earn_leave`
  ADD PRIMARY KEY (`earn_id`);

--
-- Indexes for table `hr_education`
--
ALTER TABLE `hr_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_education_degree_title`
--
ALTER TABLE `hr_education_degree_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_education_level`
--
ALTER TABLE `hr_education_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_education_result`
--
ALTER TABLE `hr_education_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_employee_bengali`
--
ALTER TABLE `hr_employee_bengali`
  ADD PRIMARY KEY (`hr_bn_id`);

--
-- Indexes for table `hr_emp_type`
--
ALTER TABLE `hr_emp_type`
  ADD PRIMARY KEY (`emp_type_id`);

--
-- Indexes for table `hr_floor`
--
ALTER TABLE `hr_floor`
  ADD PRIMARY KEY (`hr_floor_id`);

--
-- Indexes for table `hr_grievance_appeal`
--
ALTER TABLE `hr_grievance_appeal`
  ADD PRIMARY KEY (`hr_griv_appl_id`);

--
-- Indexes for table `hr_grievance_issue`
--
ALTER TABLE `hr_grievance_issue`
  ADD PRIMARY KEY (`hr_griv_issue_id`);

--
-- Indexes for table `hr_grievance_steps`
--
ALTER TABLE `hr_grievance_steps`
  ADD PRIMARY KEY (`hr_griv_steps_id`);

--
-- Indexes for table `hr_increment`
--
ALTER TABLE `hr_increment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_increment_type`
--
ALTER TABLE `hr_increment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_interview`
--
ALTER TABLE `hr_interview`
  ADD PRIMARY KEY (`hr_interview_id`);

--
-- Indexes for table `hr_job_posting`
--
ALTER TABLE `hr_job_posting`
  ADD PRIMARY KEY (`job_po_id`);

--
-- Indexes for table `hr_leave`
--
ALTER TABLE `hr_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_letter`
--
ALTER TABLE `hr_letter`
  ADD PRIMARY KEY (`hr_letter_id`);

--
-- Indexes for table `hr_line`
--
ALTER TABLE `hr_line`
  ADD PRIMARY KEY (`hr_line_id`);

--
-- Indexes for table `hr_loan_application`
--
ALTER TABLE `hr_loan_application`
  ADD PRIMARY KEY (`hr_la_id`);

--
-- Indexes for table `hr_loan_type`
--
ALTER TABLE `hr_loan_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_medical_incident`
--
ALTER TABLE `hr_medical_incident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_med_info`
--
ALTER TABLE `hr_med_info`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `hr_nominee`
--
ALTER TABLE `hr_nominee`
  ADD PRIMARY KEY (`nom_id`);

--
-- Indexes for table `hr_ot`
--
ALTER TABLE `hr_ot`
  ADD PRIMARY KEY (`hr_ot_id`);

--
-- Indexes for table `hr_performance_appraisal`
--
ALTER TABLE `hr_performance_appraisal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_promotion`
--
ALTER TABLE `hr_promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_salary_structure`
--
ALTER TABLE `hr_salary_structure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_section`
--
ALTER TABLE `hr_section`
  ADD PRIMARY KEY (`hr_section_id`);

--
-- Indexes for table `hr_service_book`
--
ALTER TABLE `hr_service_book`
  ADD PRIMARY KEY (`hr_s_book_id`);

--
-- Indexes for table `hr_shift`
--
ALTER TABLE `hr_shift`
  ADD PRIMARY KEY (`hr_shift_id`);

--
-- Indexes for table `hr_shift_roaster`
--
ALTER TABLE `hr_shift_roaster`
  ADD PRIMARY KEY (`shift_roaster_id`);

--
-- Indexes for table `hr_subsection`
--
ALTER TABLE `hr_subsection`
  ADD PRIMARY KEY (`hr_subsec_id`);

--
-- Indexes for table `hr_training`
--
ALTER TABLE `hr_training`
  ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `hr_training_assign`
--
ALTER TABLE `hr_training_assign`
  ADD PRIMARY KEY (`tr_as_id`);

--
-- Indexes for table `hr_training_names`
--
ALTER TABLE `hr_training_names`
  ADD PRIMARY KEY (`hr_tr_name_id`);

--
-- Indexes for table `hr_unit`
--
ALTER TABLE `hr_unit`
  ADD PRIMARY KEY (`hr_unit_id`);

--
-- Indexes for table `hr_upazilla`
--
ALTER TABLE `hr_upazilla`
  ADD PRIMARY KEY (`upa_id`);

--
-- Indexes for table `hr_without_pay`
--
ALTER TABLE `hr_without_pay`
  ADD PRIMARY KEY (`hr_wop_id`);

--
-- Indexes for table `hr_worker_recruitment`
--
ALTER TABLE `hr_worker_recruitment`
  ADD PRIMARY KEY (`worker_id`);

--
-- Indexes for table `hr_yearly_holiday_planner`
--
ALTER TABLE `hr_yearly_holiday_planner`
  ADD PRIMARY KEY (`hr_yhp_id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `mr_action_type`
--
ALTER TABLE `mr_action_type`
  ADD PRIMARY KEY (`act_id`);

--
-- Indexes for table `mr_artcl_construct_dimen`
--
ALTER TABLE `mr_artcl_construct_dimen`
  ADD PRIMARY KEY (`art_id`);

--
-- Indexes for table `mr_bom_n_costing_booking`
--
ALTER TABLE `mr_bom_n_costing_booking`
  ADD PRIMARY KEY (`bom_id`);

--
-- Indexes for table `mr_bom_n_cost_book_history`
--
ALTER TABLE `mr_bom_n_cost_book_history`
  ADD PRIMARY KEY (`bom_history_id`);

--
-- Indexes for table `mr_bom_style_costing`
--
ALTER TABLE `mr_bom_style_costing`
  ADD PRIMARY KEY (`bom_stl_cost_id`);

--
-- Indexes for table `mr_brand`
--
ALTER TABLE `mr_brand`
  ADD PRIMARY KEY (`br_id`),
  ADD UNIQUE KEY `br_shortname` (`br_shortname`);

--
-- Indexes for table `mr_brand_contact`
--
ALTER TABLE `mr_brand_contact`
  ADD PRIMARY KEY (`brcon_id`);

--
-- Indexes for table `mr_buyer`
--
ALTER TABLE `mr_buyer`
  ADD PRIMARY KEY (`b_id`),
  ADD UNIQUE KEY `b_shortname` (`b_shortname`);

--
-- Indexes for table `mr_buyer_contact`
--
ALTER TABLE `mr_buyer_contact`
  ADD PRIMARY KEY (`bcont_id`);

--
-- Indexes for table `mr_capacity_reservation`
--
ALTER TABLE `mr_capacity_reservation`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `mr_country`
--
ALTER TABLE `mr_country`
  ADD PRIMARY KEY (`cnt_id`);

--
-- Indexes for table `mr_element`
--
ALTER TABLE `mr_element`
  ADD PRIMARY KEY (`el_id`);

--
-- Indexes for table `mr_garment_type`
--
ALTER TABLE `mr_garment_type`
  ADD PRIMARY KEY (`gmt_id`);

--
-- Indexes for table `mr_material_category`
--
ALTER TABLE `mr_material_category`
  ADD PRIMARY KEY (`mcat_id`);

--
-- Indexes for table `mr_material_color`
--
ALTER TABLE `mr_material_color`
  ADD PRIMARY KEY (`clr_id`);

--
-- Indexes for table `mr_material_item`
--
ALTER TABLE `mr_material_item`
  ADD PRIMARY KEY (`matitem_id`);

--
-- Indexes for table `mr_material_size`
--
ALTER TABLE `mr_material_size`
  ADD PRIMARY KEY (`sz_id`);

--
-- Indexes for table `mr_material_sub_cat`
--
ALTER TABLE `mr_material_sub_cat`
  ADD PRIMARY KEY (`msubcat_id`);

--
-- Indexes for table `mr_mat_color_attach`
--
ALTER TABLE `mr_mat_color_attach`
  ADD PRIMARY KEY (`col_attach_id`);

--
-- Indexes for table `mr_operation`
--
ALTER TABLE `mr_operation`
  ADD PRIMARY KEY (`opr_id`);

--
-- Indexes for table `mr_order_entry`
--
ALTER TABLE `mr_order_entry`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `mr_pi_entry`
--
ALTER TABLE `mr_pi_entry`
  ADD PRIMARY KEY (`pi_entry_id`);

--
-- Indexes for table `mr_pi_order`
--
ALTER TABLE `mr_pi_order`
  ADD PRIMARY KEY (`pi_order_id`);

--
-- Indexes for table `mr_po_sub_style`
--
ALTER TABLE `mr_po_sub_style`
  ADD PRIMARY KEY (`po_sub_style_id`);

--
-- Indexes for table `mr_product_lib`
--
ALTER TABLE `mr_product_lib`
  ADD PRIMARY KEY (`prodlib_id`);

--
-- Indexes for table `mr_product_lib_operarion`
--
ALTER TABLE `mr_product_lib_operarion`
  ADD PRIMARY KEY (`prodlibop_id`);

--
-- Indexes for table `mr_product_lib_sp_machine`
--
ALTER TABLE `mr_product_lib_sp_machine`
  ADD PRIMARY KEY (`prodlibspmachine_id`);

--
-- Indexes for table `mr_product_size`
--
ALTER TABLE `mr_product_size`
  ADD PRIMARY KEY (`prdsz_id`),
  ADD UNIQUE KEY `prdsz_size` (`prdsz_size`,`prdsz_group`);

--
-- Indexes for table `mr_product_type`
--
ALTER TABLE `mr_product_type`
  ADD PRIMARY KEY (`prd_type_id`);

--
-- Indexes for table `mr_purchase_order`
--
ALTER TABLE `mr_purchase_order`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `mr_sample_style`
--
ALTER TABLE `mr_sample_style`
  ADD PRIMARY KEY (`sam_stl_id`);

--
-- Indexes for table `mr_sample_type`
--
ALTER TABLE `mr_sample_type`
  ADD PRIMARY KEY (`sample_id`);

--
-- Indexes for table `mr_season`
--
ALTER TABLE `mr_season`
  ADD PRIMARY KEY (`se_id`);

--
-- Indexes for table `mr_size_lib`
--
ALTER TABLE `mr_size_lib`
  ADD PRIMARY KEY (`sz_lib_id`);

--
-- Indexes for table `mr_special_machine`
--
ALTER TABLE `mr_special_machine`
  ADD PRIMARY KEY (`spmachine_id`);

--
-- Indexes for table `mr_style`
--
ALTER TABLE `mr_style`
  ADD PRIMARY KEY (`stl_id`);

--
-- Indexes for table `mr_style_costing_file_attach`
--
ALTER TABLE `mr_style_costing_file_attach`
  ADD PRIMARY KEY (`cost_style_file_id`);

--
-- Indexes for table `mr_style_history`
--
ALTER TABLE `mr_style_history`
  ADD PRIMARY KEY (`stl_history_id`);

--
-- Indexes for table `mr_style_operation`
--
ALTER TABLE `mr_style_operation`
  ADD PRIMARY KEY (`style_op_id`);

--
-- Indexes for table `mr_style_sp_machine`
--
ALTER TABLE `mr_style_sp_machine`
  ADD PRIMARY KEY (`stl_sp_machine_id`);

--
-- Indexes for table `mr_style_type`
--
ALTER TABLE `mr_style_type`
  ADD PRIMARY KEY (`stp_id`);

--
-- Indexes for table `mr_supplier`
--
ALTER TABLE `mr_supplier`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `mr_sup_contact_person_info`
--
ALTER TABLE `mr_sup_contact_person_info`
  ADD PRIMARY KEY (`scp_id`);

--
-- Indexes for table `mr_time_action_plan`
--
ALTER TABLE `mr_time_action_plan`
  ADD PRIMARY KEY (`tna_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkinout`
--
ALTER TABLE `checkinout`
  MODIFY `Logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT for table `com_b2b_entry`
--
ALTER TABLE `com_b2b_entry`
  MODIFY `b2b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `com_bank`
--
ALTER TABLE `com_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `com_bank_accno`
--
ALTER TABLE `com_bank_accno`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `com_exp_lc_close`
--
ALTER TABLE `com_exp_lc_close`
  MODIFY `exp_lc_close_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `com_exp_lc_entry`
--
ALTER TABLE `com_exp_lc_entry`
  MODIFY `exp_lc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `com_exp_lc_entry_address`
--
ALTER TABLE `com_exp_lc_entry_address`
  MODIFY `exp_lc_entry_adr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `com_exp_lc_entry_ammendment`
--
ALTER TABLE `com_exp_lc_entry_ammendment`
  MODIFY `exp_lc_amend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `com_exp_lc_history`
--
ALTER TABLE `com_exp_lc_history`
  MODIFY `exp_lc_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `com_foc_lc`
--
ALTER TABLE `com_foc_lc`
  MODIFY `foc_lc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `com_foc_lc_elcno`
--
ALTER TABLE `com_foc_lc_elcno`
  MODIFY `foc_lc_elc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `com_import_data_entry`
--
ALTER TABLE `com_import_data_entry`
  MODIFY `imp_data_entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `com_import_data_entry_history`
--
ALTER TABLE `com_import_data_entry_history`
  MODIFY `imp_data_entry_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `com_import_data_entry_import_fab`
--
ALTER TABLE `com_import_data_entry_import_fab`
  MODIFY `imp_data_entry_import_fab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `com_import_data_entry_invoice`
--
ALTER TABLE `com_import_data_entry_invoice`
  MODIFY `imp_data_entry_invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `com_import_data_entry_machinery`
--
ALTER TABLE `com_import_data_entry_machinery`
  MODIFY `imp_data_machinery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `com_import_data_entry_machinery_invoice`
--
ALTER TABLE `com_import_data_entry_machinery_invoice`
  MODIFY `imp_data_machinery_inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `com_import_data_machinery_history`
--
ALTER TABLE `com_import_data_machinery_history`
  MODIFY `imp_data_machn_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `com_insurance_company`
--
ALTER TABLE `com_insurance_company`
  MODIFY `insurance_comp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `com_item`
--
ALTER TABLE `com_item`
  MODIFY `com_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `com_machinery_master_info`
--
ALTER TABLE `com_machinery_master_info`
  MODIFY `machinery_master_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `com_machinery_pi`
--
ALTER TABLE `com_machinery_pi`
  MODIFY `machinery_pi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `com_machinery_pi_history`
--
ALTER TABLE `com_machinery_pi_history`
  MODIFY `machinery_pi_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `com_machinery_pi_order`
--
ALTER TABLE `com_machinery_pi_order`
  MODIFY `machinery_pi_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `com_machine_manufacturer`
--
ALTER TABLE `com_machine_manufacturer`
  MODIFY `manf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `com_machine_type`
--
ALTER TABLE `com_machine_type`
  MODIFY `machine_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `com_master_pi_accessories`
--
ALTER TABLE `com_master_pi_accessories`
  MODIFY `master_pi_acss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `com_master_pi_accessories_item`
--
ALTER TABLE `com_master_pi_accessories_item`
  MODIFY `master_pi_acss_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `com_master_pi_fabric`
--
ALTER TABLE `com_master_pi_fabric`
  MODIFY `master_pi_fab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `com_pi_type`
--
ALTER TABLE `com_pi_type`
  MODIFY `pi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `com_port`
--
ALTER TABLE `com_port`
  MODIFY `port_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `com_section`
--
ALTER TABLE `com_section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `com_ud_library_fab_pock`
--
ALTER TABLE `com_ud_library_fab_pock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `com_vessel`
--
ALTER TABLE `com_vessel`
  MODIFY `vess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `com_voyage_vessel`
--
ALTER TABLE `com_voyage_vessel`
  MODIFY `voyage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fin_asset`
--
ALTER TABLE `fin_asset`
  MODIFY `fin_asset_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fin_asset_category`
--
ALTER TABLE `fin_asset_category`
  MODIFY `fin_asset_cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fin_asset_product`
--
ALTER TABLE `fin_asset_product`
  MODIFY `fin_asset_product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_area`
--
ALTER TABLE `hr_area`
  MODIFY `hr_area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hr_asset_assign`
--
ALTER TABLE `hr_asset_assign`
  MODIFY `hr_asset_assign_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_associate_status_tracker`
--
ALTER TABLE `hr_associate_status_tracker`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_as_basic_info`
--
ALTER TABLE `hr_as_basic_info`
  MODIFY `as_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `hr_attendance`
--
ALTER TABLE `hr_attendance`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `hr_attendance_manual`
--
ALTER TABLE `hr_attendance_manual`
  MODIFY `hr_att_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hr_benefits`
--
ALTER TABLE `hr_benefits`
  MODIFY `ben_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hr_department`
--
ALTER TABLE `hr_department`
  MODIFY `hr_department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `hr_designation`
--
ALTER TABLE `hr_designation`
  MODIFY `hr_designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `hr_dist`
--
ALTER TABLE `hr_dist`
  MODIFY `dis_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `hr_dis_rec`
--
ALTER TABLE `hr_dis_rec`
  MODIFY `dis_re_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hr_earn_leave`
--
ALTER TABLE `hr_earn_leave`
  MODIFY `earn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_education`
--
ALTER TABLE `hr_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hr_education_degree_title`
--
ALTER TABLE `hr_education_degree_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `hr_education_level`
--
ALTER TABLE `hr_education_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hr_education_result`
--
ALTER TABLE `hr_education_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hr_employee_bengali`
--
ALTER TABLE `hr_employee_bengali`
  MODIFY `hr_bn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hr_emp_type`
--
ALTER TABLE `hr_emp_type`
  MODIFY `emp_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hr_floor`
--
ALTER TABLE `hr_floor`
  MODIFY `hr_floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `hr_grievance_appeal`
--
ALTER TABLE `hr_grievance_appeal`
  MODIFY `hr_griv_appl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_grievance_issue`
--
ALTER TABLE `hr_grievance_issue`
  MODIFY `hr_griv_issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hr_grievance_steps`
--
ALTER TABLE `hr_grievance_steps`
  MODIFY `hr_griv_steps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hr_increment`
--
ALTER TABLE `hr_increment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hr_increment_type`
--
ALTER TABLE `hr_increment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hr_interview`
--
ALTER TABLE `hr_interview`
  MODIFY `hr_interview_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_job_posting`
--
ALTER TABLE `hr_job_posting`
  MODIFY `job_po_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hr_leave`
--
ALTER TABLE `hr_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hr_letter`
--
ALTER TABLE `hr_letter`
  MODIFY `hr_letter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hr_line`
--
ALTER TABLE `hr_line`
  MODIFY `hr_line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `hr_loan_application`
--
ALTER TABLE `hr_loan_application`
  MODIFY `hr_la_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hr_loan_type`
--
ALTER TABLE `hr_loan_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hr_medical_incident`
--
ALTER TABLE `hr_medical_incident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hr_med_info`
--
ALTER TABLE `hr_med_info`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `hr_nominee`
--
ALTER TABLE `hr_nominee`
  MODIFY `nom_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_ot`
--
ALTER TABLE `hr_ot`
  MODIFY `hr_ot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hr_performance_appraisal`
--
ALTER TABLE `hr_performance_appraisal`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hr_promotion`
--
ALTER TABLE `hr_promotion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hr_salary_structure`
--
ALTER TABLE `hr_salary_structure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hr_section`
--
ALTER TABLE `hr_section`
  MODIFY `hr_section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `hr_service_book`
--
ALTER TABLE `hr_service_book`
  MODIFY `hr_s_book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hr_shift`
--
ALTER TABLE `hr_shift`
  MODIFY `hr_shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `hr_shift_roaster`
--
ALTER TABLE `hr_shift_roaster`
  MODIFY `shift_roaster_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `hr_subsection`
--
ALTER TABLE `hr_subsection`
  MODIFY `hr_subsec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `hr_training`
--
ALTER TABLE `hr_training`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hr_training_assign`
--
ALTER TABLE `hr_training_assign`
  MODIFY `tr_as_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hr_training_names`
--
ALTER TABLE `hr_training_names`
  MODIFY `hr_tr_name_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hr_unit`
--
ALTER TABLE `hr_unit`
  MODIFY `hr_unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hr_upazilla`
--
ALTER TABLE `hr_upazilla`
  MODIFY `upa_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=590;

--
-- AUTO_INCREMENT for table `hr_without_pay`
--
ALTER TABLE `hr_without_pay`
  MODIFY `hr_wop_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_worker_recruitment`
--
ALTER TABLE `hr_worker_recruitment`
  MODIFY `worker_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `hr_yearly_holiday_planner`
--
ALTER TABLE `hr_yearly_holiday_planner`
  MODIFY `hr_yhp_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mr_action_type`
--
ALTER TABLE `mr_action_type`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mr_artcl_construct_dimen`
--
ALTER TABLE `mr_artcl_construct_dimen`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mr_bom_n_costing_booking`
--
ALTER TABLE `mr_bom_n_costing_booking`
  MODIFY `bom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `mr_bom_n_cost_book_history`
--
ALTER TABLE `mr_bom_n_cost_book_history`
  MODIFY `bom_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `mr_bom_style_costing`
--
ALTER TABLE `mr_bom_style_costing`
  MODIFY `bom_stl_cost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mr_brand`
--
ALTER TABLE `mr_brand`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mr_brand_contact`
--
ALTER TABLE `mr_brand_contact`
  MODIFY `brcon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mr_buyer`
--
ALTER TABLE `mr_buyer`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mr_buyer_contact`
--
ALTER TABLE `mr_buyer_contact`
  MODIFY `bcont_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mr_capacity_reservation`
--
ALTER TABLE `mr_capacity_reservation`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mr_country`
--
ALTER TABLE `mr_country`
  MODIFY `cnt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `mr_element`
--
ALTER TABLE `mr_element`
  MODIFY `el_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mr_garment_type`
--
ALTER TABLE `mr_garment_type`
  MODIFY `gmt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mr_material_category`
--
ALTER TABLE `mr_material_category`
  MODIFY `mcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mr_material_color`
--
ALTER TABLE `mr_material_color`
  MODIFY `clr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mr_material_item`
--
ALTER TABLE `mr_material_item`
  MODIFY `matitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mr_material_size`
--
ALTER TABLE `mr_material_size`
  MODIFY `sz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mr_material_sub_cat`
--
ALTER TABLE `mr_material_sub_cat`
  MODIFY `msubcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `mr_mat_color_attach`
--
ALTER TABLE `mr_mat_color_attach`
  MODIFY `col_attach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `mr_operation`
--
ALTER TABLE `mr_operation`
  MODIFY `opr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mr_order_entry`
--
ALTER TABLE `mr_order_entry`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mr_pi_entry`
--
ALTER TABLE `mr_pi_entry`
  MODIFY `pi_entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mr_pi_order`
--
ALTER TABLE `mr_pi_order`
  MODIFY `pi_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mr_po_sub_style`
--
ALTER TABLE `mr_po_sub_style`
  MODIFY `po_sub_style_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mr_product_lib`
--
ALTER TABLE `mr_product_lib`
  MODIFY `prodlib_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mr_product_lib_operarion`
--
ALTER TABLE `mr_product_lib_operarion`
  MODIFY `prodlibop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mr_product_lib_sp_machine`
--
ALTER TABLE `mr_product_lib_sp_machine`
  MODIFY `prodlibspmachine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mr_product_size`
--
ALTER TABLE `mr_product_size`
  MODIFY `prdsz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `mr_product_type`
--
ALTER TABLE `mr_product_type`
  MODIFY `prd_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mr_purchase_order`
--
ALTER TABLE `mr_purchase_order`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mr_sample_style`
--
ALTER TABLE `mr_sample_style`
  MODIFY `sam_stl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `mr_sample_type`
--
ALTER TABLE `mr_sample_type`
  MODIFY `sample_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mr_season`
--
ALTER TABLE `mr_season`
  MODIFY `se_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mr_size_lib`
--
ALTER TABLE `mr_size_lib`
  MODIFY `sz_lib_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mr_special_machine`
--
ALTER TABLE `mr_special_machine`
  MODIFY `spmachine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mr_style`
--
ALTER TABLE `mr_style`
  MODIFY `stl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mr_style_costing_file_attach`
--
ALTER TABLE `mr_style_costing_file_attach`
  MODIFY `cost_style_file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mr_style_history`
--
ALTER TABLE `mr_style_history`
  MODIFY `stl_history_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mr_style_operation`
--
ALTER TABLE `mr_style_operation`
  MODIFY `style_op_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `mr_style_sp_machine`
--
ALTER TABLE `mr_style_sp_machine`
  MODIFY `stl_sp_machine_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `mr_style_type`
--
ALTER TABLE `mr_style_type`
  MODIFY `stp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mr_supplier`
--
ALTER TABLE `mr_supplier`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mr_sup_contact_person_info`
--
ALTER TABLE `mr_sup_contact_person_info`
  MODIFY `scp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mr_time_action_plan`
--
ALTER TABLE `mr_time_action_plan`
  MODIFY `tna_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fin_asset`
--
ALTER TABLE `fin_asset`
  ADD CONSTRAINT `FK_fin_asset_fin_asset_product` FOREIGN KEY (`fin_asset_product_id`) REFERENCES `fin_asset_product` (`fin_asset_product_id`) ON DELETE CASCADE;

--
-- Constraints for table `fin_asset_product`
--
ALTER TABLE `fin_asset_product`
  ADD CONSTRAINT `FK_fin_asset_product_fin_asset_category` FOREIGN KEY (`fin_asset_product_cat_id`) REFERENCES `fin_asset_category` (`fin_asset_cat_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hr_asset_assign`
--
ALTER TABLE `hr_asset_assign`
  ADD CONSTRAINT `FK_hr_asset_assign_fin_asset` FOREIGN KEY (`hr_fin_asset_id`) REFERENCES `fin_asset` (`fin_asset_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

