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
DROP DATABASE IF EXISTS `mbmerp`;
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
) ENGINE=MyISAM AUTO_INCREMENT=1143 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_b2b_entry
DROP TABLE IF EXISTS `com_b2b_entry`;
CREATE TABLE IF NOT EXISTS `com_b2b_entry` (
  `b2b_id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_lc_fileno` varchar(45) DEFAULT NULL,
  `b2b_item` int(11) DEFAULT NULL,
  `b2b_lc_status` varchar(45) DEFAULT NULL,
  `b2b_lc_no` varchar(45) DEFAULT NULL,
  `b2b_lc_date` date DEFAULT NULL,
  `b2b_inco_term` varchar(45) DEFAULT NULL,
  `b2b_lc_sup_code` varchar(45) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
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
  PRIMARY KEY (`b2b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_b2b_entry_amendment
DROP TABLE IF EXISTS `com_b2b_entry_amendment`;
CREATE TABLE IF NOT EXISTS `com_b2b_entry_amendment` (
  `b2b_amend_id` int(11) NOT NULL AUTO_INCREMENT,
  `b2b_id` int(11) NOT NULL,
  `b2b_amend_date` date DEFAULT NULL,
  `b2b_amend_reason` varchar(45) DEFAULT NULL,
  `b2b_amend_value` varchar(45) DEFAULT NULL,
  `b2b_amend_total_amount` varchar(50) DEFAULT NULL,
  `b2b_amend_last_ship_date` date DEFAULT NULL,
  `b2b_amend_expiry_date` date DEFAULT NULL,
  `b2b_amend_lca_no` varchar(45) DEFAULT NULL,
  `b2b_amend_remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`b2b_amend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_b2b_entry_history
DROP TABLE IF EXISTS `com_b2b_entry_history`;
CREATE TABLE IF NOT EXISTS `com_b2b_entry_history` (
  `b2b_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `b2b_id` int(11) DEFAULT NULL,
  `b2b_history_desc` varchar(45) DEFAULT NULL,
  `b2b_history_user_id` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`b2b_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_b2b_machinery
DROP TABLE IF EXISTS `com_b2b_machinery`;
CREATE TABLE IF NOT EXISTS `com_b2b_machinery` (
  `b2b_machinery_id` int(11) NOT NULL AUTO_INCREMENT,
  `machinery_pi_fileno` varchar(50) DEFAULT NULL,
  `bank_id` varchar(45) DEFAULT NULL,
  `b2b_machinery_item` varchar(45) DEFAULT NULL,
  `b2b_machinery_lc_status` varchar(45) DEFAULT NULL,
  `b2b_machinery_lc_no` varchar(45) DEFAULT NULL,
  `b2b_machinery_date` date DEFAULT NULL,
  `b2b_machinery_inco_term` varchar(45) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `b2b_machinery_sup_code` varchar(45) DEFAULT NULL,
  `b2b_machinery_currency` varchar(45) DEFAULT NULL,
  `b2b_machinery_marine_ins_no` varchar(45) DEFAULT NULL,
  `b2b_machinery_ins_cover_date` date DEFAULT NULL,
  `lc_period_id` int(11) DEFAULT NULL,
  `from_date_of_id` int(11) DEFAULT NULL,
  `b2b_machinery_interest` varchar(45) DEFAULT NULL,
  `b2b_machinery_lc_type` int(11) DEFAULT NULL,
  `b2b_machinery_status` int(11) DEFAULT NULL,
  `b2b_machinery_cancel_date` timestamp NULL DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`b2b_machinery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_b2b_machinery_amend
DROP TABLE IF EXISTS `com_b2b_machinery_amend`;
CREATE TABLE IF NOT EXISTS `com_b2b_machinery_amend` (
  `b2b_machine_amend_id` int(11) NOT NULL AUTO_INCREMENT,
  `b2b_machinery_id` int(11) NOT NULL,
  `b2b_machine_amend_date` date DEFAULT NULL,
  `b2b_machine_amend_reason` varchar(45) DEFAULT NULL,
  `b2b_machine_amend_value` varchar(45) DEFAULT NULL,
  `b2b_machine_amend_total_amount` varchar(45) DEFAULT NULL,
  `b2b_machine_amend_last_ship_date` date DEFAULT NULL,
  `b2b_machine_amend_expiry_date` date DEFAULT NULL,
  `b2b_machine_amend_lca_no` varchar(45) DEFAULT NULL,
  `b2b_machine_amend_remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`b2b_machine_amend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_b2b_machinery_history
DROP TABLE IF EXISTS `com_b2b_machinery_history`;
CREATE TABLE IF NOT EXISTS `com_b2b_machinery_history` (
  `b2b_machn_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `b2b_machinery_id` int(11) DEFAULT NULL,
  `b2b_machn_history_desc` varchar(45) DEFAULT NULL,
  `b2b_machn_history_user_id` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`b2b_machn_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_bank
DROP TABLE IF EXISTS `com_bank`;
CREATE TABLE IF NOT EXISTS `com_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(45) DEFAULT NULL,
  `bank_short_code` varchar(60) DEFAULT NULL,
  `bank_swift_code` varchar(60) DEFAULT NULL,
  `bank_address_1` varchar(256) DEFAULT NULL,
  `bank_address_2` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_exp_lc_close
DROP TABLE IF EXISTS `com_exp_lc_close`;
CREATE TABLE IF NOT EXISTS `com_exp_lc_close` (
  `exp_lc_close_id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_lc_id` int(11) DEFAULT NULL,
  `exp_lc_close_date` date DEFAULT NULL,
  `exp_lc_close_remarks` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`exp_lc_close_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_exp_lc_entry
DROP TABLE IF EXISTS `com_exp_lc_entry`;
CREATE TABLE IF NOT EXISTS `com_exp_lc_entry` (
  `exp_lc_id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_lc_fileno` varchar(45) DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `exp_lc_explcno` varchar(45) DEFAULT NULL,
  `exp_lc_elc_date` date DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `exp_lc_type` varchar(45) DEFAULT NULL,
  `exp_lc_expiry_date` date DEFAULT NULL,
  `exp_lc_initial_value` varchar(20) DEFAULT NULL,
  `com_exp_value_currency` varchar(45) DEFAULT NULL,
  `exp_lc_file_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`exp_lc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_from_date_of
DROP TABLE IF EXISTS `com_from_date_of`;
CREATE TABLE IF NOT EXISTS `com_from_date_of` (
  `from_date_of_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_date_of_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`from_date_of_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_item
DROP TABLE IF EXISTS `com_item`;
CREATE TABLE IF NOT EXISTS `com_item` (
  `com_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_item_code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`com_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_lc_period
DROP TABLE IF EXISTS `com_lc_period`;
CREATE TABLE IF NOT EXISTS `com_lc_period` (
  `lc_period_id` int(11) NOT NULL AUTO_INCREMENT,
  `lc_period_name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`lc_period_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_lc_type
DROP TABLE IF EXISTS `com_lc_type`;
CREATE TABLE IF NOT EXISTS `com_lc_type` (
  `lc_id` int(11) NOT NULL AUTO_INCREMENT,
  `lc_type_name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`lc_id`),
  UNIQUE KEY `lc_type_name` (`lc_type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_machinery_pi
DROP TABLE IF EXISTS `com_machinery_pi`;
CREATE TABLE IF NOT EXISTS `com_machinery_pi` (
  `machinery_pi_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`machinery_pi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_master_pi_accessories
DROP TABLE IF EXISTS `com_master_pi_accessories`;
CREATE TABLE IF NOT EXISTS `com_master_pi_accessories` (
  `master_pi_acss_id` int(11) NOT NULL AUTO_INCREMENT,
  `pi_entry_id` int(11) NOT NULL,
  `exp_lc_fileno` varchar(45) DEFAULT NULL,
  `master_pi_acss_sup_code` varchar(45) DEFAULT NULL,
  `sup_id` varchar(45) DEFAULT NULL,
  `master_pi_acss_insurance_no` varchar(45) DEFAULT NULL,
  `master_pi_acss_insurance_date` date DEFAULT NULL,
  `insurance_comp_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`master_pi_acss_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_master_pi_accessories_item
DROP TABLE IF EXISTS `com_master_pi_accessories_item`;
CREATE TABLE IF NOT EXISTS `com_master_pi_accessories_item` (
  `master_pi_acss_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `master_pi_acss_id` int(11) NOT NULL,
  `pi_order_id` int(11) NOT NULL,
  `matitem_id` int(11) DEFAULT NULL,
  `master_pi_acss_item_type` varchar(45) DEFAULT NULL,
  `master_pi_acss_item_quantity` varchar(45) DEFAULT NULL,
  `master_pi_acss_item_qty_unit` varchar(45) DEFAULT NULL,
  `master_pi_acss_item_unit_price` varchar(45) DEFAULT NULL,
  `master_pi_acss_item_currency` varchar(45) DEFAULT NULL,
  `master_pi_acss_item_price_unit` varchar(45) DEFAULT NULL,
  `master_pi_fab_item_ship_date` date DEFAULT NULL,
  PRIMARY KEY (`master_pi_acss_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_master_pi_fabric
DROP TABLE IF EXISTS `com_master_pi_fabric`;
CREATE TABLE IF NOT EXISTS `com_master_pi_fabric` (
  `master_pi_fab_id` int(11) NOT NULL AUTO_INCREMENT,
  `pi_entry_id` int(11) NOT NULL,
  `exp_lc_fileno` varchar(45) DEFAULT NULL,
  `master_pi_fab_sup_code` varchar(45) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `master_pi_fab_insurance_no` varchar(45) DEFAULT NULL,
  `master_pi_fab_insurance_date` date DEFAULT NULL,
  `insurance_comp_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`master_pi_fab_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_master_pi_fabric_item
DROP TABLE IF EXISTS `com_master_pi_fabric_item`;
CREATE TABLE IF NOT EXISTS `com_master_pi_fabric_item` (
  `master_pi_fab_item_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `master_pi_fab_item_ship_date` date DEFAULT NULL,
  PRIMARY KEY (`master_pi_fab_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_pi_type
DROP TABLE IF EXISTS `com_pi_type`;
CREATE TABLE IF NOT EXISTS `com_pi_type` (
  `pi_id` int(11) NOT NULL AUTO_INCREMENT,
  `pi_type_name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`pi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.com_port
DROP TABLE IF EXISTS `com_port`;
CREATE TABLE IF NOT EXISTS `com_port` (
  `port_id` int(11) NOT NULL AUTO_INCREMENT,
  `port_name` varchar(45) DEFAULT NULL,
  `port_address` varchar(45) DEFAULT NULL,
  `cnt_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`port_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.fin_asset_category
DROP TABLE IF EXISTS `fin_asset_category`;
CREATE TABLE IF NOT EXISTS `fin_asset_category` (
  `fin_asset_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `fin_asset_cat_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fin_asset_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_area
DROP TABLE IF EXISTS `hr_area`;
CREATE TABLE IF NOT EXISTS `hr_area` (
  `hr_area_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_area_name` varchar(128) DEFAULT NULL,
  `hr_area_name_bn` varchar(255) DEFAULT NULL,
  `hr_area_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hr_area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=668 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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
  `as_remarks` text,
  PRIMARY KEY (`as_id`)
) ENGINE=InnoDB AUTO_INCREMENT=693 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_attendance
DROP TABLE IF EXISTS `hr_attendance`;
CREATE TABLE IF NOT EXISTS `hr_attendance` (
  `att_id` int(11) NOT NULL AUTO_INCREMENT,
  `as_id` int(11) NOT NULL,
  `in_time` timestamp NULL DEFAULT NULL,
  `out_time` timestamp NULL DEFAULT NULL,
  `hr_shift_code` varchar(4) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `updated_by` varchar(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`att_id`)
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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
  `ben_updated_by` varchar(10) DEFAULT NULL,
  `ben_updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ben_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_cost_mapping_floor
DROP TABLE IF EXISTS `hr_cost_mapping_floor`;
CREATE TABLE IF NOT EXISTS `hr_cost_mapping_floor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `floor_amount` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_cost_mapping_line
DROP TABLE IF EXISTS `hr_cost_mapping_line`;
CREATE TABLE IF NOT EXISTS `hr_cost_mapping_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `floor_id` int(11) NOT NULL,
  `line_id` int(11) NOT NULL,
  `line_amount` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_cost_mapping_unit
DROP TABLE IF EXISTS `hr_cost_mapping_unit`;
CREATE TABLE IF NOT EXISTS `hr_cost_mapping_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `associate_id` varchar(10) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `unit_amount` float NOT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_department
DROP TABLE IF EXISTS `hr_department`;
CREATE TABLE IF NOT EXISTS `hr_department` (
  `hr_department_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_department_area_id` int(11) DEFAULT NULL,
  `hr_department_name` varchar(128) NOT NULL,
  `hr_department_name_bn` varchar(255) DEFAULT NULL,
  `hr_department_code` varchar(10) DEFAULT NULL,
  `hr_department_min_range` varchar(6) DEFAULT NULL,
  `hr_department_max_range` varchar(6) DEFAULT NULL,
  `hr_department_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hr_department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_designation
DROP TABLE IF EXISTS `hr_designation`;
CREATE TABLE IF NOT EXISTS `hr_designation` (
  `hr_designation_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_designation_emp_type` int(11) NOT NULL,
  `hr_designation_name` varchar(128) DEFAULT NULL,
  `hr_designation_name_bn` varchar(255) DEFAULT NULL,
  `hr_designation_position` int(3) NOT NULL DEFAULT '1',
  `hr_designation_status` tinyint(1) NOT NULL DEFAULT '1',
  `hr_designation_grade` varchar(10) NOT NULL,
  PRIMARY KEY (`hr_designation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_designation_update_log
DROP TABLE IF EXISTS `hr_designation_update_log`;
CREATE TABLE IF NOT EXISTS `hr_designation_update_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `associate_id` varchar(10) DEFAULT NULL,
  `previous_designation` int(11) DEFAULT NULL,
  `updated_designation` int(11) DEFAULT NULL,
  `updated_by` varchar(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_dist
DROP TABLE IF EXISTS `hr_dist`;
CREATE TABLE IF NOT EXISTS `hr_dist` (
  `dis_id` int(2) NOT NULL AUTO_INCREMENT,
  `dis_name` varchar(64) NOT NULL,
  `dis_name_bn` varchar(255) DEFAULT NULL,
  `dis_status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`dis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_education_degree_title
DROP TABLE IF EXISTS `hr_education_degree_title`;
CREATE TABLE IF NOT EXISTS `hr_education_degree_title` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `education_level_id` int(11) NOT NULL,
  `education_degree_title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_education_level
DROP TABLE IF EXISTS `hr_education_level`;
CREATE TABLE IF NOT EXISTS `hr_education_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `education_level_title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_education_result
DROP TABLE IF EXISTS `hr_education_result`;
CREATE TABLE IF NOT EXISTS `hr_education_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `education_result_title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_emp_type
DROP TABLE IF EXISTS `hr_emp_type`;
CREATE TABLE IF NOT EXISTS `hr_emp_type` (
  `emp_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_emp_type_name` varchar(255) NOT NULL,
  `hr_emp_type_code` varchar(10) NOT NULL,
  `hr_emp_type_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`emp_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_floor
DROP TABLE IF EXISTS `hr_floor`;
CREATE TABLE IF NOT EXISTS `hr_floor` (
  `hr_floor_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_floor_unit_id` int(11) NOT NULL,
  `hr_floor_name` varchar(128) NOT NULL,
  `hr_floor_name_bn` varchar(255) DEFAULT NULL,
  `hr_floor_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hr_floor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_grievance_issue
DROP TABLE IF EXISTS `hr_grievance_issue`;
CREATE TABLE IF NOT EXISTS `hr_grievance_issue` (
  `hr_griv_issue_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_griv_issue_name` varchar(255) NOT NULL,
  `hr_griv_issue_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`hr_griv_issue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_grievance_steps
DROP TABLE IF EXISTS `hr_grievance_steps`;
CREATE TABLE IF NOT EXISTS `hr_grievance_steps` (
  `hr_griv_steps_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_griv_steps_name` varchar(255) NOT NULL,
  `hr_griv_steps_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`hr_griv_steps_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_increment
DROP TABLE IF EXISTS `hr_increment`;
CREATE TABLE IF NOT EXISTS `hr_increment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `associate_id` varchar(10) NOT NULL,
  `current_salary` float NOT NULL,
  `increment_type` varchar(128) DEFAULT NULL,
  `increment_amount` float NOT NULL,
  `amount_type` int(11) NOT NULL,
  `eligible_date` date NOT NULL,
  `effective_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_increment_type
DROP TABLE IF EXISTS `hr_increment_type`;
CREATE TABLE IF NOT EXISTS `hr_increment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `increment_type` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_job_application
DROP TABLE IF EXISTS `hr_job_application`;
CREATE TABLE IF NOT EXISTS `hr_job_application` (
  `job_app_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_app_as_id` varchar(50) DEFAULT NULL,
  `job_app_body` longtext,
  PRIMARY KEY (`job_app_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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
  `job_po_application_deadline` date NOT NULL,
  `job_po_status` int(11) DEFAULT '0',
  PRIMARY KEY (`job_po_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_letter
DROP TABLE IF EXISTS `hr_letter`;
CREATE TABLE IF NOT EXISTS `hr_letter` (
  `hr_letter_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_letter_as_id` varchar(10) NOT NULL,
  `hr_letter_full` longtext NOT NULL,
  PRIMARY KEY (`hr_letter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_loan_type
DROP TABLE IF EXISTS `hr_loan_type`;
CREATE TABLE IF NOT EXISTS `hr_loan_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_loan_type_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=669 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_ot
DROP TABLE IF EXISTS `hr_ot`;
CREATE TABLE IF NOT EXISTS `hr_ot` (
  `hr_ot_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_ot_as_id` varchar(10) NOT NULL,
  `hr_ot_date` date NOT NULL,
  `hr_ot_hour` int(11) NOT NULL,
  PRIMARY KEY (`hr_ot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_other_benefit_assign
DROP TABLE IF EXISTS `hr_other_benefit_assign`;
CREATE TABLE IF NOT EXISTS `hr_other_benefit_assign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `associate_id` varchar(10) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `item_description` varchar(128) NOT NULL,
  `item_amount` int(11) NOT NULL,
  `updated_by` varchar(10) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_other_benefit_item
DROP TABLE IF EXISTS `hr_other_benefit_item`;
CREATE TABLE IF NOT EXISTS `hr_other_benefit_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `benefit_name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_salary_structure
DROP TABLE IF EXISTS `hr_salary_structure`;
CREATE TABLE IF NOT EXISTS `hr_salary_structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `basic` float NOT NULL,
  `house_rent` float DEFAULT NULL,
  `medical` float NOT NULL,
  `transport` float NOT NULL,
  `food` float NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_training_assign
DROP TABLE IF EXISTS `hr_training_assign`;
CREATE TABLE IF NOT EXISTS `hr_training_assign` (
  `tr_as_id` int(11) NOT NULL AUTO_INCREMENT,
  `tr_as_tr_id` int(11) NOT NULL,
  `tr_as_ass_id` varchar(10) NOT NULL,
  `tr_as_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tr_as_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_training_names
DROP TABLE IF EXISTS `hr_training_names`;
CREATE TABLE IF NOT EXISTS `hr_training_names` (
  `hr_tr_name_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_tr_name` varchar(255) NOT NULL,
  `hr_tr_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hr_tr_name_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.hr_without_pay
DROP TABLE IF EXISTS `hr_without_pay`;
CREATE TABLE IF NOT EXISTS `hr_without_pay` (
  `hr_wop_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_wop_as_id` varchar(10) NOT NULL,
  `hr_wop_start_date` date DEFAULT NULL,
  `hr_wop_end_date` date DEFAULT NULL,
  `hr_wop_reason` text,
  PRIMARY KEY (`hr_wop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=689 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_action_type
DROP TABLE IF EXISTS `mr_action_type`;
CREATE TABLE IF NOT EXISTS `mr_action_type` (
  `act_id` int(11) NOT NULL AUTO_INCREMENT,
  `act_name` varchar(50) NOT NULL,
  `act_code` varchar(20) NOT NULL,
  PRIMARY KEY (`act_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_artcl_construct_dimen
DROP TABLE IF EXISTS `mr_artcl_construct_dimen`;
CREATE TABLE IF NOT EXISTS `mr_artcl_construct_dimen` (
  `art_id` int(11) NOT NULL AUTO_INCREMENT,
  `matitem_id` int(11) NOT NULL,
  `sz_id` int(11) NOT NULL,
  `art_name` varchar(50) NOT NULL,
  `art_construction` varchar(128) NOT NULL,
  `art_dimension` varchar(128) NOT NULL,
  PRIMARY KEY (`art_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_bom_n_costing_booking
DROP TABLE IF EXISTS `mr_bom_n_costing_booking`;
CREATE TABLE IF NOT EXISTS `mr_bom_n_costing_booking` (
  `bom_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `bom_book_source` varchar(128) DEFAULT NULL,
  `bom_book_delivery_on` date DEFAULT NULL,
  `bom_book_status` varchar(60) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`bom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_bom_n_cost_book_history
DROP TABLE IF EXISTS `mr_bom_n_cost_book_history`;
CREATE TABLE IF NOT EXISTS `mr_bom_n_cost_book_history` (
  `bom_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `stl_id` int(11) NOT NULL,
  `bom_history_desc` varchar(128) NOT NULL,
  `bom_history_ip` varchar(30) NOT NULL,
  `bom_history_mac` varchar(30) DEFAULT NULL,
  `bom_history_userid` varchar(10) NOT NULL,
  `bom_history_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bom_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_bom_style_costing
DROP TABLE IF EXISTS `mr_bom_style_costing`;
CREATE TABLE IF NOT EXISTS `mr_bom_style_costing` (
  `bom_stl_cost_id` int(11) NOT NULL AUTO_INCREMENT,
  `stl_id` int(11) NOT NULL,
  `bom_stl_cost_wash` varchar(20) NOT NULL,
  `bom_stl_cost_wash_desc` varchar(128) NOT NULL,
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
  `bom_stl_cost_approve_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bom_stl_cost_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_brand
DROP TABLE IF EXISTS `mr_brand`;
CREATE TABLE IF NOT EXISTS `mr_brand` (
  `br_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `br_name` varchar(255) NOT NULL,
  `br_shortname` varchar(255) NOT NULL,
  `br_country` varchar(128) NOT NULL,
  PRIMARY KEY (`br_id`),
  UNIQUE KEY `br_shortname` (`br_shortname`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_brand_contact
DROP TABLE IF EXISTS `mr_brand_contact`;
CREATE TABLE IF NOT EXISTS `mr_brand_contact` (
  `brcon_id` int(11) NOT NULL AUTO_INCREMENT,
  `br_id` int(11) NOT NULL,
  `brcontact_person` varchar(255) NOT NULL,
  PRIMARY KEY (`brcon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_buyer
DROP TABLE IF EXISTS `mr_buyer`;
CREATE TABLE IF NOT EXISTS `mr_buyer` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_name` varchar(255) NOT NULL,
  `b_shortname` varchar(255) NOT NULL,
  `b_address` varchar(255) NOT NULL,
  `b_country` varchar(128) NOT NULL,
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `b_shortname` (`b_shortname`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_buyer_contact
DROP TABLE IF EXISTS `mr_buyer_contact`;
CREATE TABLE IF NOT EXISTS `mr_buyer_contact` (
  `bcont_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `bcontact_person` varchar(255) NOT NULL,
  PRIMARY KEY (`bcont_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_capacity_reservation
DROP TABLE IF EXISTS `mr_capacity_reservation`;
CREATE TABLE IF NOT EXISTS `mr_capacity_reservation` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `res_updated_by` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`res_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_country
DROP TABLE IF EXISTS `mr_country`;
CREATE TABLE IF NOT EXISTS `mr_country` (
  `cnt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cnt_name` varchar(50) NOT NULL,
  PRIMARY KEY (`cnt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_garment_type
DROP TABLE IF EXISTS `mr_garment_type`;
CREATE TABLE IF NOT EXISTS `mr_garment_type` (
  `gmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `prd_id` int(11) NOT NULL,
  `gmt_name` varchar(50) NOT NULL,
  `gmt_remarks` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`gmt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_material_category
DROP TABLE IF EXISTS `mr_material_category`;
CREATE TABLE IF NOT EXISTS `mr_material_category` (
  `mcat_id` int(11) NOT NULL AUTO_INCREMENT,
  `mcat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`mcat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_material_color
DROP TABLE IF EXISTS `mr_material_color`;
CREATE TABLE IF NOT EXISTS `mr_material_color` (
  `clr_id` int(11) NOT NULL AUTO_INCREMENT,
  `clr_name` varchar(64) NOT NULL,
  `clr_code` varchar(20) NOT NULL,
  `clr_description` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`clr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_material_item
DROP TABLE IF EXISTS `mr_material_item`;
CREATE TABLE IF NOT EXISTS `mr_material_item` (
  `matitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `mcat_id` int(11) NOT NULL,
  `msubcat_id` int(11) NOT NULL,
  `matitem_name` varchar(50) NOT NULL,
  `matitem_code` varchar(20) NOT NULL,
  `matitem_mill_name` varchar(50) DEFAULT NULL,
  `matitem_mill_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`matitem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_material_size
DROP TABLE IF EXISTS `mr_material_size`;
CREATE TABLE IF NOT EXISTS `mr_material_size` (
  `sz_id` int(11) NOT NULL AUTO_INCREMENT,
  `matitem_id` int(11) NOT NULL,
  `sz_name` varchar(50) NOT NULL,
  `sz_code` varchar(20) NOT NULL,
  `sz_description` varchar(128) NOT NULL,
  `sz_inseam` varchar(20) DEFAULT NULL,
  `sz_lenght` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`sz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_material_sub_cat
DROP TABLE IF EXISTS `mr_material_sub_cat`;
CREATE TABLE IF NOT EXISTS `mr_material_sub_cat` (
  `msubcat_id` int(11) NOT NULL AUTO_INCREMENT,
  `mcat_id` int(11) NOT NULL,
  `msubcat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`msubcat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_mat_color_attach
DROP TABLE IF EXISTS `mr_mat_color_attach`;
CREATE TABLE IF NOT EXISTS `mr_mat_color_attach` (
  `col_attach_id` int(11) NOT NULL AUTO_INCREMENT,
  `col_attach_url` varchar(128) NOT NULL,
  `clr_id` int(11) NOT NULL,
  PRIMARY KEY (`col_attach_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_operation
DROP TABLE IF EXISTS `mr_operation`;
CREATE TABLE IF NOT EXISTS `mr_operation` (
  `opr_id` int(11) NOT NULL AUTO_INCREMENT,
  `opr_name` varchar(50) NOT NULL,
  PRIMARY KEY (`opr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_order_entry
DROP TABLE IF EXISTS `mr_order_entry`;
CREATE TABLE IF NOT EXISTS `mr_order_entry` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(30) NOT NULL,
  `res_id` int(11) NOT NULL,
  `br_id` int(11) NOT NULL,
  `order_month` int(11) NOT NULL,
  `order_year` int(11) NOT NULL,
  `se_id` int(11) NOT NULL,
  `stl_id` int(11) NOT NULL,
  `order_qty` varchar(30) NOT NULL,
  `order_delivery_date` date NOT NULL,
  `order_status` enum('Ongoing','Completed') NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_order_history
DROP TABLE IF EXISTS `mr_order_history`;
CREATE TABLE IF NOT EXISTS `mr_order_history` (
  `order_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_history_desc` enum('Create','Update','Delete') NOT NULL,
  `order_history_ip` varchar(30) NOT NULL,
  `order_history_mac` varchar(30) NOT NULL,
  `order_history_userid` varchar(10) NOT NULL,
  `order_history_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_pi_entry
DROP TABLE IF EXISTS `mr_pi_entry`;
CREATE TABLE IF NOT EXISTS `mr_pi_entry` (
  `pi_entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `pi_entry_no` varchar(45) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `pi_entry_date` date DEFAULT NULL,
  `pi_entry_category` varchar(45) DEFAULT NULL,
  `pi_last_date` date DEFAULT NULL,
  `pi_entry_shipmode` varchar(45) DEFAULT NULL,
  `pi_entry_type` int(11) DEFAULT NULL,
  `pi_created_by` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `pi_entry_updated_by` varchar(45) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pi_entry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_pi_order
DROP TABLE IF EXISTS `mr_pi_order`;
CREATE TABLE IF NOT EXISTS `mr_pi_order` (
  `pi_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `pi_entry_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pi_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_po_sub_style
DROP TABLE IF EXISTS `mr_po_sub_style`;
CREATE TABLE IF NOT EXISTS `mr_po_sub_style` (
  `po_sub_style_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` int(11) DEFAULT NULL,
  `po_sub_style_name` varchar(50) DEFAULT NULL,
  `prdsz_id` int(11) DEFAULT NULL,
  `po_sub_style_ypp` int(11) DEFAULT NULL,
  `clr_id` int(11) DEFAULT NULL,
  `po_sub_style_qty` int(11) DEFAULT NULL,
  `po_sub_style_deliv_date` date DEFAULT NULL,
  PRIMARY KEY (`po_sub_style_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_product_lib
DROP TABLE IF EXISTS `mr_product_lib`;
CREATE TABLE IF NOT EXISTS `mr_product_lib` (
  `prodlib_id` int(11) NOT NULL AUTO_INCREMENT,
  `stp_id` int(11) NOT NULL,
  `gmt_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `prdsz_id` int(11) NOT NULL,
  `prodlib_name` varchar(50) NOT NULL,
  `prodlib_description` varchar(128) NOT NULL,
  `prodlib_shortcode` varchar(20) NOT NULL,
  `prodlib_smv` varchar(20) NOT NULL,
  `prodlib_cm` varchar(20) NOT NULL,
  `prodlib_wash` varchar(20) NOT NULL,
  PRIMARY KEY (`prodlib_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_product_lib_operarion
DROP TABLE IF EXISTS `mr_product_lib_operarion`;
CREATE TABLE IF NOT EXISTS `mr_product_lib_operarion` (
  `prodlibop_id` int(11) NOT NULL AUTO_INCREMENT,
  `prodlib_id` int(11) NOT NULL,
  `opr_id` int(11) NOT NULL,
  PRIMARY KEY (`prodlibop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_product_lib_sp_machine
DROP TABLE IF EXISTS `mr_product_lib_sp_machine`;
CREATE TABLE IF NOT EXISTS `mr_product_lib_sp_machine` (
  `prodlibspmachine_id` int(11) NOT NULL AUTO_INCREMENT,
  `prodlib_id` int(11) NOT NULL,
  `spmachine_id` int(11) NOT NULL,
  PRIMARY KEY (`prodlibspmachine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_product_size
DROP TABLE IF EXISTS `mr_product_size`;
CREATE TABLE IF NOT EXISTS `mr_product_size` (
  `prdsz_id` int(11) NOT NULL AUTO_INCREMENT,
  `prdsz_size` varchar(20) DEFAULT '0',
  `prdsz_group` varchar(20) NOT NULL,
  PRIMARY KEY (`prdsz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_product_type
DROP TABLE IF EXISTS `mr_product_type`;
CREATE TABLE IF NOT EXISTS `mr_product_type` (
  `prd_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `prd_type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`prd_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_purchase_order
DROP TABLE IF EXISTS `mr_purchase_order`;
CREATE TABLE IF NOT EXISTS `mr_purchase_order` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_no` varchar(20) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `b_id` int(11) NOT NULL,
  `br_id` int(11) NOT NULL,
  `po_file_attachment` varchar(128) DEFAULT NULL,
  `se_id` int(11) NOT NULL,
  `po_agreement_no` varchar(50) DEFAULT NULL,
  `po_qty` int(11) NOT NULL,
  `po_value` varchar(64) NOT NULL,
  `po_currency` varchar(64) NOT NULL,
  `stl_id` int(11) NOT NULL,
  `po_inco_location` varchar(128) DEFAULT NULL,
  `po_fob_date` date DEFAULT NULL,
  `po_ship_date` date DEFAULT NULL,
  `po_fabric_code` varchar(20) DEFAULT NULL,
  `po_fab_construct` varchar(128) DEFAULT NULL,
  `po_release_date` date NOT NULL,
  `po_doc_type` varchar(20) DEFAULT NULL,
  `po_inco_term` varchar(128) DEFAULT NULL,
  `po_remarks` varchar(128) DEFAULT NULL,
  `po_pcd` date DEFAULT NULL,
  `po_planned_ex_fty` date NOT NULL,
  `po_original_ex_fty` date DEFAULT NULL,
  `po_planned_del_date` date DEFAULT NULL,
  `po_delivery_address` varchar(128) DEFAULT NULL,
  `po_delivery_country` int(11) DEFAULT NULL,
  `po_trans_mode` varchar(20) DEFAULT NULL,
  `po_hot_shipment` enum('Y','N') DEFAULT NULL,
  `po_vas` varchar(20) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_sample_style
DROP TABLE IF EXISTS `mr_sample_style`;
CREATE TABLE IF NOT EXISTS `mr_sample_style` (
  `sam_stl_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sample_id` int(11) unsigned NOT NULL,
  `stl_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`sam_stl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_sample_type
DROP TABLE IF EXISTS `mr_sample_type`;
CREATE TABLE IF NOT EXISTS `mr_sample_type` (
  `sample_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sample_name` varchar(50) NOT NULL,
  PRIMARY KEY (`sample_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_season
DROP TABLE IF EXISTS `mr_season`;
CREATE TABLE IF NOT EXISTS `mr_season` (
  `se_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `se_name` varchar(50) NOT NULL,
  `se_mm_start` int(11) DEFAULT NULL,
  `se_yy_start` int(11) DEFAULT NULL,
  `se_mm_end` int(11) DEFAULT NULL,
  `se_yy_end` int(11) DEFAULT NULL,
  PRIMARY KEY (`se_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_special_machine
DROP TABLE IF EXISTS `mr_special_machine`;
CREATE TABLE IF NOT EXISTS `mr_special_machine` (
  `spmachine_id` int(11) NOT NULL AUTO_INCREMENT,
  `spmachine_name` varchar(50) NOT NULL,
  PRIMARY KEY (`spmachine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_style
DROP TABLE IF EXISTS `mr_style`;
CREATE TABLE IF NOT EXISTS `mr_style` (
  `stl_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `stl_updated_on` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`stl_id`),
  UNIQUE KEY `stl_order_type` (`stl_order_type`,`stl_no`,`stl_code`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_style_costing_file_attach
DROP TABLE IF EXISTS `mr_style_costing_file_attach`;
CREATE TABLE IF NOT EXISTS `mr_style_costing_file_attach` (
  `cost_style_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `stl_id` int(11) NOT NULL,
  `cost_style_file_attach` varchar(128) NOT NULL,
  PRIMARY KEY (`cost_style_file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_style_history
DROP TABLE IF EXISTS `mr_style_history`;
CREATE TABLE IF NOT EXISTS `mr_style_history` (
  `stl_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `stl_id` int(11) unsigned NOT NULL,
  `stl_history_desc` enum('Create','Update','Delete') NOT NULL,
  `stl_history_ip` varchar(20) DEFAULT NULL,
  `stl_history_mac` varchar(20) DEFAULT NULL,
  `stl_history_userid` varchar(10) DEFAULT NULL,
  `stl_history_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`stl_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_style_operation
DROP TABLE IF EXISTS `mr_style_operation`;
CREATE TABLE IF NOT EXISTS `mr_style_operation` (
  `style_op_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `stl_id` int(11) unsigned NOT NULL,
  `opr_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`style_op_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_style_sp_machine
DROP TABLE IF EXISTS `mr_style_sp_machine`;
CREATE TABLE IF NOT EXISTS `mr_style_sp_machine` (
  `stl_sp_machine_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `stl_id` int(11) unsigned NOT NULL,
  `sp_machine_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`stl_sp_machine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_style_type
DROP TABLE IF EXISTS `mr_style_type`;
CREATE TABLE IF NOT EXISTS `mr_style_type` (
  `stp_id` int(11) NOT NULL AUTO_INCREMENT,
  `stp_name` varchar(50) NOT NULL,
  PRIMARY KEY (`stp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_supplier
DROP TABLE IF EXISTS `mr_supplier`;
CREATE TABLE IF NOT EXISTS `mr_supplier` (
  `sup_id` int(11) NOT NULL AUTO_INCREMENT,
  `cnt_id` int(11) NOT NULL,
  `sup_name` varchar(50) NOT NULL,
  `sup_address` varchar(128) DEFAULT NULL,
  `sup_type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`sup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_sup_contact_person_info
DROP TABLE IF EXISTS `mr_sup_contact_person_info`;
CREATE TABLE IF NOT EXISTS `mr_sup_contact_person_info` (
  `scp_id` int(11) NOT NULL AUTO_INCREMENT,
  `sup_id` int(11) NOT NULL,
  `scp_details` varchar(50) NOT NULL,
  PRIMARY KEY (`scp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.mr_time_action_plan
DROP TABLE IF EXISTS `mr_time_action_plan`;
CREATE TABLE IF NOT EXISTS `mr_time_action_plan` (
  `tna_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `el_id` int(11) NOT NULL,
  `tna_offset_day` int(20) NOT NULL,
  `tna_pcd_date` date NOT NULL,
  `tna_fob_date` date NOT NULL,
  `as_id` int(11) NOT NULL,
  `tna_status` enum('Ongoing','Processed') NOT NULL DEFAULT 'Ongoing',
  `tna_actual_date` date DEFAULT NULL,
  `tna_remarks` varchar(128) DEFAULT NULL,
  `tna_created_by` int(11) NOT NULL,
  `tna_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tna_updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tna_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`tna_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mbmerp.users_login_activities
DROP TABLE IF EXISTS `users_login_activities`;
CREATE TABLE IF NOT EXISTS `users_login_activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `associate_id` varchar(10) DEFAULT NULL,
  `user_agent` varchar(128) DEFAULT NULL,
  `browser` varchar(64) DEFAULT NULL,
  `platform` varchar(32) DEFAULT NULL,
  `ip_address` varchar(32) DEFAULT NULL,
  `mac_address` varchar(32) DEFAULT NULL,
  `login_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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


-- OT Store for dashboard
DROP TABLE IF EXISTS `hr_ot_dashboard`;
CREATE TABLE `hr_ot_dashboard` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `unit_id` INT(11) NOT NULL,
  `ot_date` DATE NOT NULL,
  `ot_hour` FLOAT NOT NULL,
  PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;