-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2018 at 08:01 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tawfik`
--

-- --------------------------------------------------------

--
-- Table structure for table `hr_as_adv_info`
--

CREATE TABLE `hr_as_adv_info` (
  `emp_adv_info_id` int(11) NOT NULL,
  `emp_adv_info_as_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_stat` tinyint(1) NOT NULL COMMENT '1= Parmanent, 0=probationary',
  `emp_adv_info_birth_cer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_city_corp_cer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_police_veri` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_passport` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_refer_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_refer_contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_biodata` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_fathers_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_mothers_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_marital_stat` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_spouse` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_children` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_religion` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_pre_org` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_work_exp` int(2) DEFAULT NULL,
  `emp_adv_info_per_vill` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_per_po` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_per_dist` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_per_upz` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_pres_house_no` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_pres_road` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_pres_po` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_pres_dist` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_pres_upz` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_nid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_edu_qf` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_job_app` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_cv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_adv_info_emg_con_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_emg_con_num` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_bank_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_bank_num` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_tin` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_finger_print` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_auth_sig` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_adv_info_picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hr_as_adv_info`
--

INSERT INTO `hr_as_adv_info` (`emp_adv_info_id`, `emp_adv_info_as_id`, `emp_adv_info_stat`, `emp_adv_info_birth_cer`, `emp_adv_info_city_corp_cer`, `emp_adv_info_police_veri`, `emp_adv_info_passport`, `emp_adv_info_refer_name`, `emp_adv_info_refer_contact`, `emp_adv_info_biodata`, `emp_adv_info_fathers_name`, `emp_adv_info_mothers_name`, `emp_adv_info_marital_stat`, `emp_adv_info_spouse`, `emp_adv_info_children`, `emp_adv_info_religion`, `emp_adv_info_pre_org`, `emp_adv_info_work_exp`, `emp_adv_info_per_vill`, `emp_adv_info_per_po`, `emp_adv_info_per_dist`, `emp_adv_info_per_upz`, `emp_adv_info_pres_house_no`, `emp_adv_info_pres_road`, `emp_adv_info_pres_po`, `emp_adv_info_pres_dist`, `emp_adv_info_pres_upz`, `emp_adv_info_nid`, `emp_adv_info_edu_qf`, `emp_adv_info_job_app`, `emp_adv_info_cv`, `emp_adv_info_emg_con_name`, `emp_adv_info_emg_con_num`, `emp_adv_info_bank_name`, `emp_adv_info_bank_num`, `emp_adv_info_tin`, `emp_adv_info_finger_print`, `emp_adv_info_signature`, `emp_adv_info_auth_sig`, `emp_adv_info_picture`) VALUES
(1, 'X65YF2CU', 1, 'C:\\xampp\\tmp\\phpDAB3.tmp', 'C:\\xampp\\tmp\\phpDAE3.tmp', 'C:\\xampp\\tmp\\phpDB03.tmp', '2323', 'zyxx', '2323', 'C:\\xampp\\tmp\\phpDB24.tmp', 'zyxx', 'zyxx', 'Unmarried', NULL, NULL, 'Islam', 'zyxx', 2, 'zyxx', 'zyxx', '1', '1', 'zyxx', 'zyxx', 'zyxx', '1', '1', '2432323223', 'zyxx', '/assets/files/advinfo/5ac45b564017e.jpg', '/assets/files/advinfo/5ac45b5640ec6.jpg', 'zyxx', '2323', '23233', '232323', '23232323', '/assets/files/advinfo/5ac45b5642101.jpg', '/assets/files/advinfo/5ac45b5642ef4.jpg', '/assets/files/advinfo/5ac45b5643d18.jpg', '/assets/files/advinfo/5ac45b5644a87.jpg'),
(2, '5J381TMC', 1, 'C:\\xampp\\tmp\\php4183.tmp', 'C:\\xampp\\tmp\\php4184.tmp', 'C:\\xampp\\tmp\\php4185.tmp', '5J381TMC', 'Sakil', '0177777777', 'C:\\xampp\\tmp\\php4196.tmp', 'XYZ', 'xyz', 'Divorced', 'xyz', '3', 'Islam', 'xyz', 4, 'xyz', 'dfg', '1', '1', '313', '1st lane', 'dhanmondi', '1', '1', '12346565656', 'ssc fail', '/assets/files/advinfo/5ac5f2ddc5e5c.pdf', '/assets/files/advinfo/5ac5f2ddc72f7.pdf', 'zxcvvbvb', '12323232', 'DBBL', '2323232', '32323', '/assets/files/advinfo/5ac5f2ddc8423.jpg', '/assets/files/advinfo/5ac5f2ddc9c7d.jpg', '/assets/files/advinfo/5ac5f2ddcb543.jpg', '/assets/files/advinfo/5ac5f2ddcca6e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hr_as_basic_info`
--

CREATE TABLE `hr_as_basic_info` (
  `as_id` int(11) NOT NULL,
  `as_unit_id` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `as_floor_id` varchar(11) NOT NULL,
  `as_line_id` varchar(11) NOT NULL,
  `as_shift_id` varchar(11) NOT NULL,
  `as_department_id` varchar(11) NOT NULL,
  `as_designation_id` int(11) NOT NULL,
  `as_doj` date NOT NULL,
  `associate_id` varchar(8) NOT NULL,
  `as_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `as_gender` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `as_dob` date NOT NULL,
  `as_contact` varchar(20) NOT NULL,
  `as_ot` varchar(10) NOT NULL,
  `as_joining_salary` float NOT NULL DEFAULT '0',
  `as_pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `as_status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1;

--
-- Dumping data for table `hr_as_basic_info`
--

INSERT INTO `hr_as_basic_info` (`as_id`, `as_unit_id`, `as_floor_id`, `as_line_id`, `as_shift_id`, `as_department_id`, `as_designation_id`, `as_doj`, `associate_id`, `as_name`, `as_gender`, `as_dob`, `as_contact`, `as_ot`, `as_joining_salary`, `as_pic`, `as_status`) VALUES
(1, '1', '2', '2', '1', '1', 1, '2018-03-24', 'LIR42JMA', 'John Doe', 'Male', '2018-03-24', '', '1', 0, 'E:\\XAMPP\\tmp\\php8BC9.tmp', 0),
(2, '1', '2', '2', '1', '1', 2, '2018-03-28', 'UA3I7FQ6', 'Alex', 'Male', '2018-03-28', '0123456789', '1', 100000, '/assets/images/employee/5abbab6723fb9.PNG', 1),
(3, '1', '2', '2', '1', '1', 0, '2018-03-24', 'LIR42JMA', 'Jane Doe', 'Female', '2018-03-24', '', '1', 0, 'E:\\XAMPP\\tmp\\php8BC9.tmp', 1),
(4, '1', '2', '2', '1', '1', 2, '2018-03-28', 'UA3I7FQ6', 'Alex', 'Male', '2018-03-28', '0123456789', '1', 100000, '/assets/images/employee/5abbab6723fb9.PNG', 1),
(5, '1', '2', '2', '1', '1', 0, '2018-03-24', 'LIR42JMA', 'Jane Doe', 'Female', '2018-03-24', '', '1', 0, 'E:\\XAMPP\\tmp\\php8BC9.tmp', 1),
(6, '1', '2', '2', '1', '1', 0, '2018-03-24', 'O05F6I4V', 'Alex Goot', 'Male', '2018-03-24', '', '1', 2000, '/assets/images/employee/5ab5eb90dfaaa.PNG', 1),
(7, '1', '2', '2', '1', '1', 0, '2018-03-25', 'WM2ZUQSX', 'Annie', 'Female', '2018-03-25', '', '1', 2000, '/assets/images/employee/5ab73f6d4c35f.PNG', 1),
(8, '1', '2', '2', '1', '1', 0, '2018-03-25', 'BFNY1PT0', 'Wilium Hanna', 'Male', '2018-03-25', '', '1', 100000, '/assets/images/employee/5ab78cb670554.PNG', 1),
(9, '4', '5', '3', '3', '1', 0, '2018-03-25', '03FP2VKN', 'Jonson', 'Male', '2018-03-25', '', '0', 100000, '/assets/images/employee/5ab753f767dc9.PNG', 1),
(10, '1', '2', '2', '1', '1', 0, '2018-03-25', '3XY574O6', 'Jennifer', 'Female', '2018-03-25', '', '1', 1000, '/assets/images/employee/5ab7261527855.PNG', 1),
(11, '4', '5', '5', '6', '3', 4, '2018-04-05', 'DUGBXKF7', 'Test', 'Male', '2018-04-04', '0123456789', '0', 100000, '/assets/images/employee/5ac46def92b53.jpg', 1),
(12, '1', '2', '2', '1', '1', 1, '2018-03-24', 'X65YF2CU', 'John Doe', 'Male', '2018-03-24', '', '1', 0, 'E:\\XAMPP\\tmp\\php8BC9.tmp', 0),
(13, '1', '2', '2', '1', '1', 2, '2018-04-01', '5J381TMC', 'Tawfik Habib', 'Male', '1991-07-08', '01722702878', '0', 100000, '/assets/images/employee/5ac5f1b315806.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_att`
--

CREATE TABLE `hr_att` (
  `at_id` int(11) NOT NULL,
  `at_as_id` int(11) NOT NULL,
  `at_in_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `at_out_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `at_late_auth_id` int(11) NOT NULL,
  `at_supervisor_id` int(11) NOT NULL,
  `at_comments` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `at_alert` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_attendance_manual`
--

CREATE TABLE `hr_attendance_manual` (
  `hr_att_id` int(11) UNSIGNED NOT NULL,
  `hr_att_as_id` varchar(8) NOT NULL,
  `hr_att_date` date NOT NULL,
  `hr_att_punch_time` time NOT NULL,
  `hr_att_night_flag` tinyint(1) NOT NULL DEFAULT '0',
  `hr_att_reason` mediumtext NOT NULL,
  `hr_att_created_at` datetime DEFAULT NULL,
  `hr_att_posted_by` int(11) DEFAULT NULL,
  `device_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `hr_attendance_manual`
--

INSERT INTO `hr_attendance_manual` (`hr_att_id`, `hr_att_as_id`, `hr_att_date`, `hr_att_punch_time`, `hr_att_night_flag`, `hr_att_reason`, `hr_att_created_at`, `hr_att_posted_by`, `device_id`) VALUES
(19, 'OR0T9V1X', '2018-03-31', '00:00:00', 0, 'Test', '2018-03-31 11:15:37', NULL, NULL),
(20, 'OR0T9V1X', '2018-03-31', '09:00:00', 0, 'Test', '2018-03-31 11:15:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hr_benefits`
--

CREATE TABLE `hr_benefits` (
  `ben_id` int(11) NOT NULL,
  `ben_as_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `ben_current_salary` int(11) NOT NULL,
  `ben_joining_salary` int(11) DEFAULT '0',
  `ben_basic` int(11) NOT NULL,
  `ben_house_rent` int(11) NOT NULL,
  `ben_medical` int(11) NOT NULL,
  `ben_transport` int(11) NOT NULL,
  `ben_food` int(11) NOT NULL,
  `ben_bonus_ammount` int(11) NOT NULL,
  `ben_yearly_holiday` int(11) NOT NULL,
  `ben_medical_leave` int(11) NOT NULL,
  `ben_casual_leave` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hr_benefits`
--

INSERT INTO `hr_benefits` (`ben_id`, `ben_as_id`, `ben_current_salary`, `ben_joining_salary`, `ben_basic`, `ben_house_rent`, `ben_medical`, `ben_transport`, `ben_food`, `ben_bonus_ammount`, `ben_yearly_holiday`, `ben_medical_leave`, `ben_casual_leave`) VALUES
(1, 'X65YF2CU', 40000, 30000, 20000, 5000, 1000, 1000, 2000, 500, 100, 300, 100),
(2, '5J381TMC', 50000, 30000, 30000, 10000, 1000, 1000, 2000, 4000, 1000, 500, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `hr_department`
--

CREATE TABLE `hr_department` (
  `hr_department_id` int(11) NOT NULL,
  `hr_department_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `hr_department_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `hr_department_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hr_department`
--

INSERT INTO `hr_department` (`hr_department_id`, `hr_department_name`, `hr_department_code`, `hr_department_status`) VALUES
(1, 'Cutting', 'C', 1),
(2, 'Sewing', 'S', 1),
(3, 'Sewing  Two', 'S2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_designation`
--

CREATE TABLE `hr_designation` (
  `hr_designation_id` int(11) NOT NULL,
  `hr_designation_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `hr_designation_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hr_designation`
--

INSERT INTO `hr_designation` (`hr_designation_id`, `hr_designation_name`, `hr_designation_status`) VALUES
(2, 'CEO', 1),
(3, 'CIO', 1),
(4, 'MD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_dist`
--

CREATE TABLE `hr_dist` (
  `dis_id` int(11) NOT NULL,
  `dis_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `dis_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hr_dist`
--

INSERT INTO `hr_dist` (`dis_id`, `dis_name`, `dis_status`) VALUES
(1, 'Dhaka', 1),
(2, 'Chittagong', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_dis_rec`
--

CREATE TABLE `hr_dis_rec` (
  `dis_re_id` int(11) NOT NULL,
  `dis_re_as_id` int(11) NOT NULL,
  `dis_re_date` date NOT NULL,
  `dis_re_reason` int(11) NOT NULL,
  `dis_re_sup_id` int(11) NOT NULL,
  `dis_re_doe_from` date NOT NULL,
  `dis_re_doe_to` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_emp_join_rec`
--

CREATE TABLE `hr_emp_join_rec` (
  `emp_join_id` int(11) NOT NULL,
  `emp_join_as_id` int(11) NOT NULL,
  `emp_join_designation` int(11) NOT NULL,
  `emp_join_department` int(11) NOT NULL,
  `emp_join_joining_date` date NOT NULL,
  `emp_join_grade` int(11) NOT NULL,
  `emp_join_doj` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `emp_join_condition` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `emp_join_status` int(11) NOT NULL,
  `emp_join_ot` int(11) NOT NULL,
  `emp_join_salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_floor`
--

CREATE TABLE `hr_floor` (
  `hr_floor_id` int(11) NOT NULL,
  `hr_floor_unit_id` int(11) NOT NULL,
  `hr_floor_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `hr_floor_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hr_floor`
--

INSERT INTO `hr_floor` (`hr_floor_id`, `hr_floor_unit_id`, `hr_floor_name`, `hr_floor_status`) VALUES
(1, 2, '5th Floor', 1),
(2, 1, '4th Floor', 1),
(3, 3, '9th Floor', 1),
(4, 1, '5th Floor', 1),
(5, 4, '3rd Floor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_grievance_appeal`
--

CREATE TABLE `hr_grievance_appeal` (
  `hr_griv_appl_id` int(11) NOT NULL,
  `hr_griv_associate_id` varchar(8) DEFAULT NULL,
  `hr_griv_appl_issue_id` int(11) NOT NULL,
  `hr_griv_appl_steps_taken_id` int(11) NOT NULL,
  `hr_griv_appl_discussed_date` date NOT NULL,
  `hr_griv_appl_req_remedy` varchar(255) NOT NULL,
  `hr_griv_appl_offender_names` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_grievance_appeal`
--

INSERT INTO `hr_grievance_appeal` (`hr_griv_appl_id`, `hr_griv_associate_id`, `hr_griv_appl_issue_id`, `hr_griv_appl_steps_taken_id`, `hr_griv_appl_discussed_date`, `hr_griv_appl_req_remedy`, `hr_griv_appl_offender_names`) VALUES
(1, '12345678', 1, 1, '2018-03-15', 'Test', 'Test'),
(2, 'X37D58E0', 1, 2, '2018-03-19', 'Test', 'John Doe - X37D58E0'),
(3, 'X37D58E0', 1, 2, '2018-03-18', 'Test', 'Alex Goot - Y343SD34, John Doe - X37D58E0'),
(4, 'Y343SD34', 2, 4, '2018-03-18', 'Test', 'Y343SD34 - Alex Goot'),
(5, 'X37D58E0', 1, 1, '2018-03-18', 'xzxzz', 'X37D58E0 - John Doe, Y343SD34 - Alex Goot'),
(6, 'LIR42JMA', 1, 3, '2018-03-25', 'Test', 'OR0T9V1X - John Doe'),
(7, 'LIR42JMA', 1, 1, '2018-03-27', 'Test', 'LIR42JMA - xyz, 9JPT0EIB - xyz');

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
-- Table structure for table `hr_interview`
--

CREATE TABLE `hr_interview` (
  `hr_interview_id` int(11) NOT NULL,
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
  `job_po_title` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `job_po_vacancy` int(11) NOT NULL,
  `job_po_description` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `job_po_responsibility` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `job_po_nature` int(11) NOT NULL,
  `job_po_edu_req` int(11) NOT NULL,
  `job_po_experience` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `job_po_age_limit` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `job_po_requirment` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `job_po_location` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `job_po_salary` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `job_po_benefits` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_leave`
--

CREATE TABLE `hr_leave` (
  `hr_le_id` int(11) NOT NULL,
  `hr_le_as_id` int(11) NOT NULL,
  `hr_le_tol` int(11) NOT NULL,
  `hr_le_reason` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `hr_le_pre_date` date NOT NULL,
  `hr_le_gr_date` date NOT NULL,
  `hr_le_un_date` date NOT NULL,
  `hr_le_duration` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `hr_le_comments` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `hr_le_alert` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_leave_approval`
--

CREATE TABLE `hr_leave_approval` (
  `hr_leave_appr_id` int(11) NOT NULL,
  `hr_leave_appr_as_id` varchar(8) NOT NULL,
  `hr_leave_appr_start_date` date NOT NULL,
  `hr_leave_appr_end_date` date DEFAULT NULL,
  `hr_leave_appr_applied_date` date NOT NULL,
  `hr_leave_appr_type` varchar(20) NOT NULL,
  `hr_leave_appr_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_line`
--

CREATE TABLE `hr_line` (
  `hr_line_id` int(11) NOT NULL,
  `hr_line_unit_id` int(11) NOT NULL,
  `hr_line_floor_id` int(11) NOT NULL,
  `hr_line_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `hr_line_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hr_line`
--

INSERT INTO `hr_line` (`hr_line_id`, `hr_line_unit_id`, `hr_line_floor_id`, `hr_line_name`, `hr_line_status`) VALUES
(1, 2, 1, 'A', 1),
(2, 1, 2, 'B', 1),
(3, 4, 5, 'E36', 1),
(4, 4, 5, 'E37', 1),
(5, 4, 5, 'x', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_loan_application`
--

CREATE TABLE `hr_loan_application` (
  `hr_la_id` int(11) NOT NULL,
  `hr_la_as_id` varchar(8) NOT NULL COMMENT 'employee ID No',
  `hr_la_name` varchar(150) NOT NULL,
  `hr_la_designation` varchar(150) NOT NULL,
  `hr_la_date_of_join` date NOT NULL,
  `hr_la_applied_amount` float NOT NULL,
  `hr_la_no_of_installments` int(11) NOT NULL,
  `hr_la_type_of_loan` varchar(64) NOT NULL,
  `hr_la_purpose_of_loan` varchar(512) NOT NULL,
  `hr_la_note` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_loan_application`
--

INSERT INTO `hr_loan_application` (`hr_la_id`, `hr_la_as_id`, `hr_la_name`, `hr_la_designation`, `hr_la_date_of_join`, `hr_la_applied_amount`, `hr_la_no_of_installments`, `hr_la_type_of_loan`, `hr_la_purpose_of_loan`, `hr_la_note`) VALUES
(1, 'OR0T9V1X', 'John Doe', 'CIO', '2018-03-25', 122322, 30, 'Test', 'Children\'s education, Holidays/Travel, Investments, Consumer durable purchase, ', 'Test'),
(2, 'OR0T9V1X', 'John Doe', 'CIO', '2018-03-25', 2456670, 50, 'Test', 'Education, If any other, Please specify, ', 'Test Again'),
(3, 'OR0T9V1X', 'John Doe', 'CIO', '2018-03-25', 20000000, 53, 'Test', 'Education, Investments, Home improvement/Renovation of home or office, ', 'Test'),
(4, 'OR0T9V1X', 'John Doe', 'CIO', '2018-03-25', 1000, 30, 'Test', 'Other, ', 'Update');

-- --------------------------------------------------------

--
-- Table structure for table `hr_maternity`
--

CREATE TABLE `hr_maternity` (
  `hr_mat_id` int(11) NOT NULL,
  `hr_mat_as_id` int(11) NOT NULL,
  `hr_mat_date` date NOT NULL,
  `hr_mat_note` text NOT NULL,
  `hr_mat_prev_leave_history` text NOT NULL,
  `hr_mat_duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_maternity_leave`
--

CREATE TABLE `hr_maternity_leave` (
  `hr_mat_id` int(11) NOT NULL,
  `hr_mat_as_id` varchar(8) NOT NULL,
  `hr_mat_start_date` date NOT NULL,
  `hr_mat_end_date` date NOT NULL,
  `hr_mat_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_maternity_leave`
--

INSERT INTO `hr_maternity_leave` (`hr_mat_id`, `hr_mat_as_id`, `hr_mat_start_date`, `hr_mat_end_date`, `hr_mat_note`) VALUES
(1, 'LIR42JMA', '2018-03-27', '2018-03-27', 'Test'),
(2, 'OR0T9V1X', '2018-03-27', '2018-03-27', 'Test'),
(3, 'BFNY1PT0', '2018-03-27', '2018-03-29', 'Test'),
(4, 'OR0T9V1X', '2018-03-27', '2018-03-27', 'Test'),
(5, 'OR0T9V1X', '2018-03-27', '2018-03-27', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `hr_med_info`
--

CREATE TABLE `hr_med_info` (
  `med_id` int(11) NOT NULL,
  `med_as_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `med_height` int(11) NOT NULL,
  `med_weight` int(11) NOT NULL,
  `med_tooth_str` varchar(124) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N/A',
  `med_blood_group` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `med_ident_mark` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N/A',
  `med_others` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N/A',
  `med_doct_comment` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `med_doct_conf_age` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `med_acceptance` int(11) NOT NULL COMMENT '1=yes, 0=no',
  `med_signature` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `med_auth_signature` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `med_doct_signature` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hr_med_info`
--

INSERT INTO `hr_med_info` (`med_id`, `med_as_id`, `med_height`, `med_weight`, `med_tooth_str`, `med_blood_group`, `med_ident_mark`, `med_others`, `med_doct_comment`, `med_doct_conf_age`, `med_acceptance`, `med_signature`, `med_auth_signature`, `med_doct_signature`) VALUES
(1, 'X65YF2CU', 54, 54, 'Enamel', 'A-', 'Identification Mark', 'Other', 'Doctor\'s Comments', 'Doctor\'s Age Confirmation', 1, 'C:\\xampp\\tmp\\php2832.tmp', 'C:\\xampp\\tmp\\php2842.tmp', 'C:\\xampp\\tmp\\php2853.tmp'),
(2, 'ABCD1234', 54, 45, 'N/A', 'B+', 'N/A', 'N/A', 'sad', 'asda', 0, NULL, NULL, NULL),
(3, '18B0002A', 56, 60, 'dsfds', 'A-', 'sfd', 'dfnmvsd', 'sdnfsd', 'dsnmf', 0, NULL, NULL, NULL),
(4, 'ABCD1234', 54, 45, 'dfsdaf', 'A-', 'asdfas', 'sdfsd', 'asdfsdasdf', 'sadfasd', 1, NULL, NULL, NULL),
(5, 'ABCD1235', 54, 54, 'Enamel', 'B-', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 1, 'C:\\xampp\\tmp\\php76D9.tmp', 'C:\\xampp\\tmp\\php76E9.tmp', 'C:\\xampp\\tmp\\php770A.tmp'),
(6, '5J381TMC', 40, 35, 'baka', 'A+', 'null', 'asdf', 'dfdfds', '28', 1, 'C:\\xampp\\tmp\\php3E2D.tmp', 'C:\\xampp\\tmp\\php3E2E.tmp', 'C:\\xampp\\tmp\\php3E2F.tmp');

-- --------------------------------------------------------

--
-- Table structure for table `hr_nominee`
--

CREATE TABLE `hr_nominee` (
  `nom_id` int(11) NOT NULL,
  `nom_as_id` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nom_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nom_ben` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_nominee`
--

INSERT INTO `hr_nominee` (`nom_id`, `nom_as_id`, `nom_name`, `nom_ben`) VALUES
(1, 'VMAXTJ30', 'xyz', '30%'),
(2, '5J381TMC', 'xyz', '100');

-- --------------------------------------------------------

--
-- Table structure for table `hr_online_cv`
--

CREATE TABLE `hr_online_cv` (
  `on_cv_id` int(11) NOT NULL,
  `on_cv_first_name` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_last_name` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_fname` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_mname` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_pre_add` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_per_add` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_current_location` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_mobile` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_email` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_alternative_email` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_dob` date NOT NULL,
  `on_cv_gender` int(11) NOT NULL,
  `on_cv_religion` int(11) NOT NULL,
  `on_cv_marital` int(11) NOT NULL,
  `on_cv_nationality` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_nid` int(32) NOT NULL,
  `on_cv_objectives` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_pre_salary` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_ex_salary` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_look_job_level` int(11) NOT NULL,
  `on_cv_pre_job_cat` int(11) NOT NULL,
  `on_cv_special_skill` int(11) NOT NULL,
  `on_cv_prejob_location` int(11) NOT NULL,
  `on_cv_carrer_summary` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_sp_qualification` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_academic_summary` int(11) NOT NULL,
  `on_cv_training_summary` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_pro_cer_summary` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_emp_history` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_specialization` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_language` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_refer` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `on_cv_photo` varchar(512) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_ot`
--

CREATE TABLE `hr_ot` (
  `hr_ot_id` int(11) NOT NULL,
  `hr_ot_as_id` int(11) NOT NULL,
  `hr_ot_date` date NOT NULL,
  `hr_ot_hour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_performance_appraisal`
--

CREATE TABLE `hr_performance_appraisal` (
  `id` int(11) UNSIGNED NOT NULL,
  `hr_pa_as_id` varchar(8) DEFAULT NULL,
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
  `hr_pa_remarks_ceo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_shift`
--

CREATE TABLE `hr_shift` (
  `hr_shift_id` int(11) NOT NULL,
  `hr_shift_unit_id` int(11) NOT NULL,
  `hr_shift_floor_id` int(11) NOT NULL,
  `hr_shift_line_id` int(11) NOT NULL,
  `hr_shift_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `hr_shift_start_time` time NOT NULL,
  `hr_shift_end_time` time NOT NULL,
  `hr_shift_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hr_shift`
--

INSERT INTO `hr_shift` (`hr_shift_id`, `hr_shift_unit_id`, `hr_shift_floor_id`, `hr_shift_line_id`, `hr_shift_name`, `hr_shift_start_time`, `hr_shift_end_time`, `hr_shift_status`) VALUES
(1, 1, 2, 2, 'A', '12:00:00', '17:00:00', 1),
(2, 2, 1, 1, 'A', '08:00:00', '13:00:00', 1),
(3, 4, 5, 3, 'A', '12:00:00', '20:00:00', 1),
(4, 4, 5, 4, 'B', '00:00:00', '00:00:00', 1),
(5, 4, 5, 3, 'Test', '00:00:00', '00:00:00', 1),
(6, 4, 5, 5, 'x', '00:00:00', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_skill_matrix`
--

CREATE TABLE `hr_skill_matrix` (
  `hr_sm_id` int(11) NOT NULL,
  `hr_sm_as_id` int(11) NOT NULL,
  `hr_sm_name` varchar(150) NOT NULL,
  `hr_sm_section` varchar(255) NOT NULL,
  `hr_sm_trade` varchar(255) NOT NULL,
  `hr_sm_machine` varchar(255) NOT NULL,
  `hr_sm_grade` int(2) NOT NULL,
  `hr_sm_tr_as_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_status`
--

CREATE TABLE `hr_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `status_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_training`
--

CREATE TABLE `hr_training` (
  `tr_id` int(11) NOT NULL,
  `tr_as_tr_id` int(11) NOT NULL,
  `tr_trainer_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `tr_description` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `tr_start_date` date DEFAULT NULL,
  `tr_start_time` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tr_end_date` date DEFAULT NULL,
  `tr_end_time` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tr_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hr_training`
--

INSERT INTO `hr_training` (`tr_id`, `tr_as_tr_id`, `tr_trainer_name`, `tr_description`, `tr_start_date`, `tr_start_time`, `tr_end_date`, `tr_end_time`, `tr_status`) VALUES
(1, 5, 'Trainor', 'Test Description', '2018-03-18', '10:00', '2018-03-30', '15:00', 1),
(2, 4, 'Test', 'Test', '2018-03-19', '00:00', '2018-03-18', '00:00', 1),
(3, 1, 'XYz', 'tasefasd', '2018-03-19', '04:00', '2018-03-19', '17:00', 1),
(4, 1, 'Jane Doe', 'Test', '2018-03-25', '00:00', '2018-03-25', '00:00', 1),
(5, 1, 'Xyz', 'Xyz', '2018-03-25', '00:00', '2018-03-25', '00:00', 1),
(6, 1, 'San', 'TEst33', '2018-03-25', '00:00', '2018-03-25', '00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_training_assign`
--

CREATE TABLE `hr_training_assign` (
  `tr_as_id` int(11) NOT NULL,
  `tr_as_tr_id` int(11) NOT NULL,
  `tr_as_ass_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `tr_as_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hr_training_assign`
--

INSERT INTO `hr_training_assign` (`tr_as_id`, `tr_as_tr_id`, `tr_as_ass_id`, `tr_as_status`) VALUES
(1, 5, 'X37D58E0', 1),
(2, 5, 'X37D58E0', 1),
(3, 5, 'X37D58E0', 1),
(4, 4, 'X37D58E0', 1),
(5, 1, 'LIR42JMA', 1),
(6, 1, 'LIR42JMA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_training_list`
--

CREATE TABLE `hr_training_list` (
  `hr_tr_list_id` int(11) NOT NULL,
  `hr_tr_list_name` varchar(255) NOT NULL,
  `hr_tr_list_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `hr_unit_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `hr_unit_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hr_unit_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hr_unit`
--

INSERT INTO `hr_unit` (`hr_unit_id`, `hr_unit_name`, `hr_unit_code`, `hr_unit_status`) VALUES
(1, 'MBM', 'M', 1),
(2, 'CUTTING', 'C', 1),
(3, 'WASH', 'W', 1),
(4, 'Sewing', 'S', 1),
(5, 'Test Unit', 'TU', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_upazilla`
--

CREATE TABLE `hr_upazilla` (
  `upa_id` int(11) NOT NULL,
  `upa_dis_id` int(11) NOT NULL,
  `upa_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `upa_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hr_upazilla`
--

INSERT INTO `hr_upazilla` (`upa_id`, `upa_dis_id`, `upa_name`, `upa_status`) VALUES
(1, 1, 'Savar', 1),
(2, 1, 'Tejgaon', 1),
(3, 2, 'Feni', 1),
(4, 2, 'Mirsorai', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_without_pay`
--

CREATE TABLE `hr_without_pay` (
  `hr_wop_id` int(11) NOT NULL,
  `hr_wop_as_id` varchar(8) NOT NULL,
  `hr_wop_start_date` date DEFAULT NULL,
  `hr_wop_end_date` date DEFAULT NULL,
  `hr_wop_reason` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_without_pay`
--

INSERT INTO `hr_without_pay` (`hr_wop_id`, `hr_wop_as_id`, `hr_wop_start_date`, `hr_wop_end_date`, `hr_wop_reason`) VALUES
(7, 'WM2ZUQSX', '2018-03-27', '2018-03-27', 'Test'),
(8, 'OR0T9V1X', '2018-03-27', '2018-04-07', 'Test again');

-- --------------------------------------------------------

--
-- Table structure for table `hr_yearly_holiday_planner`
--

CREATE TABLE `hr_yearly_holiday_planner` (
  `hr_yhp_id` int(11) NOT NULL,
  `hr_yhp_year` year(4) NOT NULL,
  `hr_yhp_month` int(2) NOT NULL,
  `hr_yhp_mng_appr_holidays` int(3) NOT NULL,
  `hr_yhp_dates_of_holidays` text NOT NULL,
  `hr_yhp_comments` text NOT NULL,
  `hr_yhp_attachment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hr_as_adv_info`
--
ALTER TABLE `hr_as_adv_info`
  ADD PRIMARY KEY (`emp_adv_info_id`);

--
-- Indexes for table `hr_as_basic_info`
--
ALTER TABLE `hr_as_basic_info`
  ADD PRIMARY KEY (`as_id`);

--
-- Indexes for table `hr_att`
--
ALTER TABLE `hr_att`
  ADD PRIMARY KEY (`at_id`);

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
-- Indexes for table `hr_emp_join_rec`
--
ALTER TABLE `hr_emp_join_rec`
  ADD PRIMARY KEY (`emp_join_id`);

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
  ADD PRIMARY KEY (`hr_le_id`);

--
-- Indexes for table `hr_leave_approval`
--
ALTER TABLE `hr_leave_approval`
  ADD PRIMARY KEY (`hr_leave_appr_id`);

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
-- Indexes for table `hr_maternity_leave`
--
ALTER TABLE `hr_maternity_leave`
  ADD PRIMARY KEY (`hr_mat_id`);

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
-- Indexes for table `hr_online_cv`
--
ALTER TABLE `hr_online_cv`
  ADD PRIMARY KEY (`on_cv_id`);

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
-- Indexes for table `hr_shift`
--
ALTER TABLE `hr_shift`
  ADD PRIMARY KEY (`hr_shift_id`);

--
-- Indexes for table `hr_skill_matrix`
--
ALTER TABLE `hr_skill_matrix`
  ADD PRIMARY KEY (`hr_sm_id`);

--
-- Indexes for table `hr_status`
--
ALTER TABLE `hr_status`
  ADD PRIMARY KEY (`status_id`);

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
-- Indexes for table `hr_yearly_holiday_planner`
--
ALTER TABLE `hr_yearly_holiday_planner`
  ADD PRIMARY KEY (`hr_yhp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hr_as_adv_info`
--
ALTER TABLE `hr_as_adv_info`
  MODIFY `emp_adv_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hr_as_basic_info`
--
ALTER TABLE `hr_as_basic_info`
  MODIFY `as_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hr_att`
--
ALTER TABLE `hr_att`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_attendance_manual`
--
ALTER TABLE `hr_attendance_manual`
  MODIFY `hr_att_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `hr_benefits`
--
ALTER TABLE `hr_benefits`
  MODIFY `ben_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hr_department`
--
ALTER TABLE `hr_department`
  MODIFY `hr_department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hr_designation`
--
ALTER TABLE `hr_designation`
  MODIFY `hr_designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hr_dist`
--
ALTER TABLE `hr_dist`
  MODIFY `dis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hr_dis_rec`
--
ALTER TABLE `hr_dis_rec`
  MODIFY `dis_re_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_emp_join_rec`
--
ALTER TABLE `hr_emp_join_rec`
  MODIFY `emp_join_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_floor`
--
ALTER TABLE `hr_floor`
  MODIFY `hr_floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hr_grievance_appeal`
--
ALTER TABLE `hr_grievance_appeal`
  MODIFY `hr_griv_appl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `hr_interview`
--
ALTER TABLE `hr_interview`
  MODIFY `hr_interview_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_job_posting`
--
ALTER TABLE `hr_job_posting`
  MODIFY `job_po_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_leave`
--
ALTER TABLE `hr_leave`
  MODIFY `hr_le_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_leave_approval`
--
ALTER TABLE `hr_leave_approval`
  MODIFY `hr_leave_appr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_line`
--
ALTER TABLE `hr_line`
  MODIFY `hr_line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hr_loan_application`
--
ALTER TABLE `hr_loan_application`
  MODIFY `hr_la_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hr_maternity_leave`
--
ALTER TABLE `hr_maternity_leave`
  MODIFY `hr_mat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hr_med_info`
--
ALTER TABLE `hr_med_info`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hr_nominee`
--
ALTER TABLE `hr_nominee`
  MODIFY `nom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hr_online_cv`
--
ALTER TABLE `hr_online_cv`
  MODIFY `on_cv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_ot`
--
ALTER TABLE `hr_ot`
  MODIFY `hr_ot_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_performance_appraisal`
--
ALTER TABLE `hr_performance_appraisal`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_shift`
--
ALTER TABLE `hr_shift`
  MODIFY `hr_shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hr_skill_matrix`
--
ALTER TABLE `hr_skill_matrix`
  MODIFY `hr_sm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_status`
--
ALTER TABLE `hr_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_training`
--
ALTER TABLE `hr_training`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hr_training_assign`
--
ALTER TABLE `hr_training_assign`
  MODIFY `tr_as_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hr_training_names`
--
ALTER TABLE `hr_training_names`
  MODIFY `hr_tr_name_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hr_unit`
--
ALTER TABLE `hr_unit`
  MODIFY `hr_unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hr_upazilla`
--
ALTER TABLE `hr_upazilla`
  MODIFY `upa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hr_without_pay`
--
ALTER TABLE `hr_without_pay`
  MODIFY `hr_wop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hr_yearly_holiday_planner`
--
ALTER TABLE `hr_yearly_holiday_planner`
  MODIFY `hr_yhp_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
