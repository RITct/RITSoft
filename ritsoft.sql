-- MySQL dump 10.13  Distrib 5.7.31, for Linux (x86_64)
--

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `academic_year`
--

DROP TABLE IF EXISTS `academic_year`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `academic_year` (
  `year_id` int(11) NOT NULL AUTO_INCREMENT,
  `acd_year` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `admission_status`
--

DROP TABLE IF EXISTS `admission_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admission_status` (
  `id` int(11) DEFAULT NULL,
  `course` varchar(2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance` (
  `attid` int(40) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(11) NOT NULL,
  `subjectid` varchar(50) NOT NULL,
  `classid` varchar(50) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`attid`),
  KEY `subjectid` (`subjectid`,`classid`,`studid`),
  KEY `classid` (`classid`),
  KEY `studid` (`studid`),
  KEY `studid_2` (`studid`),
  CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`subjectid`, `classid`) REFERENCES `subject_class` (`subjectid`, `classid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`studid`) REFERENCES `stud_details` (`admissionno`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1497528 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `attendanceold`
--

DROP TABLE IF EXISTS `attendanceold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendanceold` (
  `attid` int(40) NOT NULL,
  `date` date NOT NULL,
  `hour` int(11) NOT NULL,
  `subjectid` varchar(50) NOT NULL,
  `classid` varchar(50) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `status` char(1) NOT NULL,
  `acd_year` text,
  PRIMARY KEY (`attid`),
  KEY `subjectid` (`subjectid`,`classid`,`studid`),
  KEY `classid` (`classid`),
  KEY `studid` (`studid`),
  KEY `studid_2` (`studid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cc`
--

DROP TABLE IF EXISTS `cc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cc` (
  `cc_no` int(5) NOT NULL AUTO_INCREMENT,
  `adm_no` varchar(50) NOT NULL,
  `chrctr` text NOT NULL,
  PRIMARY KEY (`cc_no`),
  KEY `adm_no` (`adm_no`)
) ENGINE=InnoDB AUTO_INCREMENT=1858 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `class_details`
--

DROP TABLE IF EXISTS `class_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_details` (
  `classid` varchar(50) NOT NULL,
  `courseid` varchar(50) NOT NULL,
  `semid` int(11) NOT NULL,
  `branch_or_specialisation` varchar(100) NOT NULL,
  `deptname` varchar(100) NOT NULL,
  `active` text NOT NULL,
  PRIMARY KEY (`classid`),
  KEY `deptname` (`deptname`),
  KEY `branch_or_specialisation` (`branch_or_specialisation`),
  KEY `courseid` (`courseid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complaint` (
  `id_com` int(20) NOT NULL AUTO_INCREMENT,
  `stud_id` varchar(20) NOT NULL,
  `fid` varchar(20) NOT NULL,
  `com_type` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `content` varchar(250) NOT NULL,
  `com_time` datetime NOT NULL,
  `response` varchar(300) DEFAULT NULL,
  `res_time` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `designation` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_com`),
  KEY `stud_id` (`stud_id`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_academic`
--

DROP TABLE IF EXISTS `course_academic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_academic` (
  `course_id` varchar(100) NOT NULL,
  `year_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` varchar(5) NOT NULL,
  `course` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `no_of_semesters` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `current_class`
--

DROP TABLE IF EXISTS `current_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `current_class` (
  `classid` varchar(50) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `rollno` int(11) NOT NULL,
  `adm_status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`studid`),
  KEY `classid` (`classid`,`studid`),
  CONSTRAINT `current_class_ibfk_1` FOREIGN KEY (`studid`) REFERENCES `stud_details` (`admissionno`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `current_class_semreg`
--

DROP TABLE IF EXISTS `current_class_semreg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `current_class_semreg` (
  `classid` varchar(50) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `rollno` int(11) NOT NULL,
  `adm_status` varchar(100) NOT NULL,
  PRIMARY KEY (`studid`),
  KEY `classid` (`classid`),
  KEY `studid` (`studid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `current_classold`
--

DROP TABLE IF EXISTS `current_classold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `current_classold` (
  `classid` varchar(50) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `rollno` int(11) NOT NULL,
  `year` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `deptname` varchar(100) NOT NULL,
  `hod` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`deptname`),
  KEY `hod` (`hod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `duty_leave`
--

DROP TABLE IF EXISTS `duty_leave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `duty_leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studid` varchar(100) NOT NULL,
  `subjectid` varchar(100) NOT NULL,
  `leave_date` date NOT NULL,
  `hour` int(11) NOT NULL,
  `remark` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `studid` (`studid`),
  KEY `subjectid` (`subjectid`),
  CONSTRAINT `duty_leave_ibfk_1` FOREIGN KEY (`studid`) REFERENCES `stud_details` (`admissionno`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `duty_leave_ibfk_2` FOREIGN KEY (`subjectid`) REFERENCES `subject_class` (`subjectid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `duty_leaveold`
--

DROP TABLE IF EXISTS `duty_leaveold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `duty_leaveold` (
  `id` int(11) NOT NULL,
  `studid` varchar(100) NOT NULL,
  `subjectid` varchar(100) NOT NULL,
  `leave_date` date NOT NULL,
  `hour` int(11) NOT NULL,
  `remark` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `acd_year` text NOT NULL,
  `classid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `each_sessional_marks`
--

DROP TABLE IF EXISTS `each_sessional_marks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `each_sessional_marks` (
  `series_no` int(11) NOT NULL DEFAULT '1',
  `classid` varchar(50) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `subjectid` varchar(50) NOT NULL,
  `sessional_marks` float NOT NULL,
  `sessional_remark` text,
  `status` varchar(30) DEFAULT '',
  `sessional_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`series_no`,`classid`,`studid`,`subjectid`),
  KEY `classid` (`classid`),
  KEY `studid` (`studid`),
  KEY `subjectid` (`subjectid`),
  CONSTRAINT `each_sessional_marks_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `class_details` (`classid`) ON UPDATE CASCADE,
  CONSTRAINT `each_sessional_marks_ibfk_2` FOREIGN KEY (`studid`) REFERENCES `stud_details` (`admissionno`) ON UPDATE CASCADE,
  CONSTRAINT `each_sessional_marks_ibfk_3` FOREIGN KEY (`subjectid`) REFERENCES `subject_class` (`subjectid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `each_sessional_marksold`
--

DROP TABLE IF EXISTS `each_sessional_marksold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `each_sessional_marksold` (
  `series_no` int(11) NOT NULL DEFAULT '1',
  `classid` varchar(50) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `subjectid` varchar(50) NOT NULL,
  `sessional_marks` float NOT NULL,
  `sessional_remark` text,
  `status` varchar(30) DEFAULT NULL,
  `sessional_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acd_year` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `elective_student`
--

DROP TABLE IF EXISTS `elective_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `elective_student` (
  `sub_code` varchar(50) NOT NULL,
  `stud_id` varchar(50) NOT NULL,
  KEY `stud_id` (`stud_id`),
  KEY `sub_code` (`sub_code`),
  CONSTRAINT `elective_student_ibfk_1` FOREIGN KEY (`stud_id`) REFERENCES `stud_details` (`admissionno`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `elective_student_ibfk_2` FOREIGN KEY (`sub_code`) REFERENCES `subject_class` (`subjectid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `elective_studentold`
--

DROP TABLE IF EXISTS `elective_studentold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `elective_studentold` (
  `sub_code` varchar(50) NOT NULL,
  `stud_id` varchar(50) NOT NULL,
  `acd_year` text NOT NULL,
  `classid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `faculty_designation`
--

DROP TABLE IF EXISTS `faculty_designation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty_designation` (
  `fid` varchar(50) NOT NULL,
  `designation` text NOT NULL,
  KEY `fid` (`fid`),
  CONSTRAINT `faculty_designation_ibfk_2` FOREIGN KEY (`fid`) REFERENCES `faculty_details` (`fid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `faculty_details`
--

DROP TABLE IF EXISTS `faculty_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty_details` (
  `fid` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `deptname` varchar(100) NOT NULL,
  `phoneno` text NOT NULL,
  `email` text NOT NULL,
  `photo` longblob NOT NULL,
  PRIMARY KEY (`fid`),
  KEY `deptname` (`deptname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `feedback_index`
--

DROP TABLE IF EXISTS `feedback_index`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback_index` (
  `indexno` int(50) NOT NULL AUTO_INCREMENT,
  `deptname` varchar(100) NOT NULL,
  `fid` varchar(50) NOT NULL,
  `subjectid` varchar(50) NOT NULL,
  `acdyear` varchar(10) NOT NULL,
  `indexmark` double NOT NULL,
  `classid` varchar(50) NOT NULL,
  PRIMARY KEY (`indexno`),
  UNIQUE KEY `indexno` (`indexno`,`deptname`,`fid`,`subjectid`,`indexmark`),
  UNIQUE KEY `indexno_2` (`indexno`,`deptname`,`fid`,`subjectid`,`indexmark`),
  KEY `deptname` (`deptname`),
  KEY `fid` (`fid`),
  KEY `subjectid` (`subjectid`)
) ENGINE=InnoDB AUTO_INCREMENT=2023 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `feedback_status`
--

DROP TABLE IF EXISTS `feedback_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback_status` (
  `classid` varchar(50) NOT NULL,
  `deptname` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`classid`),
  KEY `deptname` (`deptname`),
  CONSTRAINT `feedback_status_ibfk_1` FOREIGN KEY (`deptname`) REFERENCES `department` (`deptname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `feedback_stud`
--

DROP TABLE IF EXISTS `feedback_stud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback_stud` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `studid` varchar(50) NOT NULL,
  `acdyear` varchar(10) NOT NULL,
  `subjectid` varchar(20) NOT NULL,
  `fid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36198 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hostel_stud_reg`
--

DROP TABLE IF EXISTS `hostel_stud_reg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hostel_stud_reg` (
  `ADMNO` varchar(50) NOT NULL,
  `parent_address` varchar(100) NOT NULL,
  `parent_mob` varchar(13) NOT NULL,
  `present_res_adress` varchar(100) DEFAULT NULL,
  `priority1` tinyint(1) DEFAULT NULL,
  `priority2a` tinyint(1) DEFAULT NULL,
  `priority2d` tinyint(1) DEFAULT NULL,
  `priority2e` tinyint(1) DEFAULT NULL,
  `income` bigint(20) DEFAULT NULL,
  `distance` float DEFAULT NULL,
  `sgpa` float DEFAULT NULL,
  `disci_action` varchar(55) DEFAULT NULL,
  `admn_status` varchar(15) DEFAULT NULL,
  `hos_rank` float DEFAULT NULL,
  `distance_metric` float DEFAULT NULL,
  `rank_metric` float DEFAULT NULL,
  `Entrance_rank` int(5) DEFAULT NULL,
  `SC` int(1) NOT NULL,
  `ST` int(1) NOT NULL,
  `PH` int(1) NOT NULL,
  `BPL` int(1) NOT NULL,
  `other_state` int(1) NOT NULL,
  `CENTRAL` int(1) NOT NULL,
  `priority2b` int(11) NOT NULL,
  `priority2c` int(11) NOT NULL,
  `priority2f` int(11) NOT NULL,
  `final_rank` varchar(5) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `Permanent_add` varchar(100) DEFAULT NULL,
  `Permanent_mob` varchar(13) DEFAULT NULL,
  `category` varchar(13) DEFAULT NULL,
  `postoffice` varchar(50) DEFAULT NULL,
  `acd_year` text,
  `status` int(11) DEFAULT '1',
  `app_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lab_batch`
--

DROP TABLE IF EXISTS `lab_batch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_batch` (
  `batch_id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_name` varchar(50) NOT NULL,
  `sub_code` varchar(50) NOT NULL,
  `classid` varchar(50) NOT NULL,
  PRIMARY KEY (`batch_id`),
  KEY `batch_id` (`batch_id`),
  KEY `sub_code` (`sub_code`),
  CONSTRAINT `lab_batch_ibfk_1` FOREIGN KEY (`sub_code`) REFERENCES `subject_class` (`subjectid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=268 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lab_batch_student`
--

DROP TABLE IF EXISTS `lab_batch_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_batch_student` (
  `studid` varchar(50) NOT NULL,
  `batch_id` int(11) NOT NULL,
  KEY `admissionno` (`studid`),
  KEY `batch_id` (`batch_id`),
  CONSTRAINT `lab_batch_student_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `lab_batch` (`batch_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lab_batch_studentold`
--

DROP TABLE IF EXISTS `lab_batch_studentold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_batch_studentold` (
  `studid` varchar(50) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `acd_year` text NOT NULL,
  `classid` varchar(50) NOT NULL,
  KEY `batch_id` (`batch_id`),
  KEY `admissionno` (`studid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lab_batchold`
--

DROP TABLE IF EXISTS `lab_batchold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_batchold` (
  `batch_id` int(11) NOT NULL,
  `batch_name` varchar(50) NOT NULL,
  `sub_code` varchar(50) NOT NULL,
  `acd_year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `last_adm_no`
--

DROP TABLE IF EXISTS `last_adm_no`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `last_adm_no` (
  `ug` int(11) NOT NULL,
  `pg` int(11) NOT NULL,
  `phd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mainfeedback`
--

DROP TABLE IF EXISTS `mainfeedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mainfeedback` (
  `deptname` varchar(50) NOT NULL,
  `semid` varchar(5) NOT NULL,
  `subjectid` varchar(20) NOT NULL,
  `acdyear` varchar(10) NOT NULL,
  `responseid` int(10) NOT NULL AUTO_INCREMENT,
  `qs1` double NOT NULL,
  `qs2` double NOT NULL,
  `qs3` double NOT NULL,
  `qs4` double NOT NULL,
  `qs5` double NOT NULL,
  `qs6` double NOT NULL,
  `qs7` double NOT NULL,
  `qs8` double NOT NULL,
  `qs9` double NOT NULL,
  `qs10` double NOT NULL,
  `qs11` double NOT NULL,
  `qs12` text NOT NULL,
  `fid` varchar(50) NOT NULL,
  PRIMARY KEY (`responseid`)
) ENGINE=InnoDB AUTO_INCREMENT=36048 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `nid` bigint(20) NOT NULL AUTO_INCREMENT,
  `data` text NOT NULL,
  `send_id` varchar(50) NOT NULL,
  `rec_id` varchar(50) NOT NULL,
  `send_type` text NOT NULL,
  `rec_type` text NOT NULL,
  `date` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB AUTO_INCREMENT=7855 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parent`
--

DROP TABLE IF EXISTS `parent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parent` (
  `parentid` int(11) NOT NULL AUTO_INCREMENT,
  `name_guard` text NOT NULL,
  `guard_contactno` text NOT NULL,
  `relation` text NOT NULL,
  `occupation` text NOT NULL,
  `guard_email` text NOT NULL,
  `income` int(20) NOT NULL,
  PRIMARY KEY (`parentid`)
) ENGINE=InnoDB AUTO_INCREMENT=3751 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parent_student`
--

DROP TABLE IF EXISTS `parent_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parent_student` (
  `psid` bigint(20) NOT NULL AUTO_INCREMENT,
  `admissionno` varchar(50) NOT NULL,
  `parentid` bigint(20) NOT NULL,
  PRIMARY KEY (`psid`),
  KEY `admissionno` (`admissionno`),
  KEY `parentid` (`parentid`),
  CONSTRAINT `parent_student_ibfk_1` FOREIGN KEY (`admissionno`) REFERENCES `stud_details` (`admissionno`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3759 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pgstudent_qual`
--

DROP TABLE IF EXISTS `pgstudent_qual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pgstudent_qual` (
  `admissionno` varchar(50) NOT NULL,
  `degree_course` text,
  `degree_regno` text,
  `degree_marks` int(11) DEFAULT NULL,
  `degree_percent` int(11) DEFAULT NULL,
  `college_name` varchar(50) DEFAULT NULL,
  `university` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`admissionno`),
  CONSTRAINT `pgstudent_qual_ibfk_1` FOREIGN KEY (`admissionno`) REFERENCES `stud_details` (`admissionno`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rit_keys`
--

DROP TABLE IF EXISTS `rit_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rit_keys` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `key_email` varchar(255) NOT NULL,
  `key_username` varchar(255) NOT NULL,
  `key_key` varchar(255) NOT NULL,
  `key_remark` varchar(255) DEFAULT NULL,
  `key_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `scholarship`
--

DROP TABLE IF EXISTS `scholarship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scholarship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schol_id` int(11) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `schol_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `schol_id` (`schol_id`),
  KEY `studid` (`studid`),
  CONSTRAINT `scholarship_ibfk_1` FOREIGN KEY (`schol_id`) REFERENCES `scholarship_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `scholarship_ibfk_2` FOREIGN KEY (`studid`) REFERENCES `stud_details` (`admissionno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=523 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `scholarship_type`
--

DROP TABLE IF EXISTS `scholarship_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scholarship_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schol_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `semregstatus`
--

DROP TABLE IF EXISTS `semregstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semregstatus` (
  `curr_sem` varchar(50) NOT NULL,
  `next_sem` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `current_class` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `serialno`
--

DROP TABLE IF EXISTS `serialno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serialno` (
  `rcpt_no` int(20) NOT NULL AUTO_INCREMENT,
  `classid` varchar(50) NOT NULL,
  `issued_by` varchar(20) NOT NULL,
  `issued_to` varchar(20) NOT NULL,
  PRIMARY KEY (`rcpt_no`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sessional_marks`
--

DROP TABLE IF EXISTS `sessional_marks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessional_marks` (
  `classid` varchar(50) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `subjectid` varchar(50) NOT NULL,
  `sessional_marks` float NOT NULL,
  `sessional_remark` text,
  `verification_status` int(11) NOT NULL DEFAULT '0',
  `sessional_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`classid`,`studid`,`subjectid`),
  KEY `subjectid` (`subjectid`),
  KEY `studid` (`studid`),
  CONSTRAINT `sessional_marks_ibfk_1` FOREIGN KEY (`studid`) REFERENCES `stud_details` (`admissionno`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `sessional_marks_ibfk_2` FOREIGN KEY (`subjectid`) REFERENCES `subject_class` (`subjectid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sessional_marksold`
--

DROP TABLE IF EXISTS `sessional_marksold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessional_marksold` (
  `classid` varchar(50) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `subjectid` varchar(50) NOT NULL,
  `sessional_marks` float NOT NULL,
  `sessional_remark` text,
  `verification_status` int(11) NOT NULL DEFAULT '0',
  `sessional_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acd_year` text,
  PRIMARY KEY (`classid`,`studid`,`subjectid`),
  KEY `studid` (`studid`),
  KEY `subjectid` (`subjectid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sessional_status`
--

DROP TABLE IF EXISTS `sessional_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessional_status` (
  `classid` varchar(50) NOT NULL,
  `subjectid` varchar(50) NOT NULL,
  `sessional_status` varchar(255) NOT NULL,
  `verification_status` int(11) NOT NULL DEFAULT '0',
  `sessional_remark` text,
  `sessional_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `subjectid` (`subjectid`),
  CONSTRAINT `sessional_status_ibfk_1` FOREIGN KEY (`subjectid`) REFERENCES `subject_class` (`subjectid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sessional_statusold`
--

DROP TABLE IF EXISTS `sessional_statusold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessional_statusold` (
  `classid` varchar(50) NOT NULL,
  `subjectid` varchar(50) NOT NULL,
  `sessional_status` varchar(255) NOT NULL,
  `verification_status` int(11) NOT NULL,
  `sessional_remark` text,
  `sessional_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acd_year` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `staff_advisor`
--

DROP TABLE IF EXISTS `staff_advisor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_advisor` (
  `classid` varchar(50) NOT NULL,
  `fid` varchar(50) NOT NULL,
  `students_list` text NOT NULL,
  PRIMARY KEY (`classid`,`fid`),
  KEY `fid` (`fid`),
  CONSTRAINT `staff_advisor_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `faculty_details` (`fid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stud_details`
--

DROP TABLE IF EXISTS `stud_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stud_details` (
  `admissionno` varchar(50) NOT NULL,
  `name` text,
  `dob` text,
  `gender` text,
  `religion` text,
  `caste` text,
  `year_of_admission` text,
  `email` text,
  `mobile_phno` text,
  `land_phno` text NOT NULL,
  `address` text,
  `rollno` text,
  `rank` text,
  `quota` text,
  `school_1` text,
  `regno_1` text,
  `board_1` text,
  `percentage_1` text NOT NULL,
  `school_2` text,
  `regno_2` text,
  `board_2` text,
  `percentage_2` text NOT NULL,
  `no_chance1` text,
  `name_last_studied` text NOT NULL,
  `courseid` text,
  `branch_or_specialisation` text,
  `branch_code` varchar(20) NOT NULL,
  `image` longblob NOT NULL,
  `gate_score` int(11) NOT NULL,
  `admission_type` varchar(30) NOT NULL,
  `entry_sem` int(2) NOT NULL,
  `exit_sem` int(2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `blood` varchar(5) NOT NULL,
  `image_status` varchar(50) DEFAULT 'Not Verified',
  `tc_no_adm` varchar(100) DEFAULT NULL,
  `tc_date_adm` date DEFAULT NULL,
  `date_of_admission` date DEFAULT NULL,
  PRIMARY KEY (`admissionno`),
  UNIQUE KEY `adm_no` (`admissionno`),
  KEY `admissionno` (`admissionno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stud_sem_registration`
--

DROP TABLE IF EXISTS `stud_sem_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stud_sem_registration` (
  `reg_id` int(50) NOT NULL AUTO_INCREMENT,
  `adm_no` varchar(10) DEFAULT NULL,
  `classid` varchar(50) NOT NULL,
  `apl_status` varchar(35) NOT NULL,
  `apl_date` date NOT NULL,
  `apv_status` varchar(35) NOT NULL DEFAULT 'Not Approved',
  `apv_date` date NOT NULL,
  `batch_id` int(50) NOT NULL,
  `previous_sem` varchar(4) DEFAULT NULL,
  `new_sem` varchar(4) DEFAULT NULL,
  `remarks` text,
  `form_data` longtext,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`reg_id`),
  KEY `classid_ibfk_1abc` (`classid`),
  KEY `adm_no` (`adm_no`)
) ENGINE=InnoDB AUTO_INCREMENT=7696 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stud_sem_registrationold`
--

DROP TABLE IF EXISTS `stud_sem_registrationold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stud_sem_registrationold` (
  `reg_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_no` varchar(10) NOT NULL,
  `classid` varchar(50) NOT NULL,
  `apl_status` varchar(35) NOT NULL,
  `apl_date` date NOT NULL,
  `apv_status` varchar(35) NOT NULL DEFAULT 'Not Approved',
  `apv_date` date NOT NULL,
  `batch_id` int(50) NOT NULL,
  `previous_sem` varchar(4) NOT NULL,
  `new_sem` varchar(4) NOT NULL,
  `remarks` text NOT NULL,
  `form_data` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `acd_year` text NOT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6447 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subject_allocation`
--

DROP TABLE IF EXISTS `subject_allocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject_allocation` (
  `classid` varchar(50) NOT NULL,
  `subjectid` varchar(50) NOT NULL,
  `fid` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`classid`,`subjectid`,`fid`,`type`),
  KEY `fid` (`fid`),
  KEY `subjectid_classid` (`subjectid`,`classid`),
  CONSTRAINT `subject_allocation_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `faculty_details` (`fid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subject_allocation_ibfk_3` FOREIGN KEY (`subjectid`, `classid`) REFERENCES `subject_class` (`subjectid`, `classid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subject_allocationold`
--

DROP TABLE IF EXISTS `subject_allocationold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject_allocationold` (
  `classid` varchar(50) NOT NULL,
  `subjectid` varchar(50) NOT NULL,
  `fid` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `acd_year` varchar(50) NOT NULL,
  PRIMARY KEY (`classid`,`subjectid`,`fid`,`type`,`acd_year`),
  KEY `fid` (`fid`),
  KEY `subjectid` (`subjectid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subject_class`
--

DROP TABLE IF EXISTS `subject_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject_class` (
  `subjectid` varchar(50) NOT NULL,
  `subject_title` text NOT NULL,
  `classid` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `internal_passmark` int(20) NOT NULL,
  `internal_mark` int(20) NOT NULL,
  `external_pass_mark` int(10) NOT NULL,
  `external_mark` int(10) NOT NULL,
  PRIMARY KEY (`subjectid`,`classid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subject_classold`
--

DROP TABLE IF EXISTS `subject_classold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject_classold` (
  `subjectid` varchar(50) NOT NULL,
  `subject_title` text NOT NULL,
  `classid` varchar(50) NOT NULL,
  PRIMARY KEY (`subjectid`,`classid`),
  KEY `classid` (`classid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tc`
--

DROP TABLE IF EXISTS `tc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tc` (
  `tc_no` int(5) NOT NULL AUTO_INCREMENT,
  `adm_no` varchar(10) NOT NULL,
  `tc_date` text NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY (`tc_no`),
  KEY `adm_no` (`adm_no`)
) ENGINE=InnoDB AUTO_INCREMENT=1875 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp`
--

DROP TABLE IF EXISTS `temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp` (
  `temp_no` bigint(50) NOT NULL,
  `name` text NOT NULL,
  `dob` date NOT NULL,
  `gender` text NOT NULL,
  `religion` text NOT NULL,
  `caste` text NOT NULL,
  `year_of_admission` int(50) NOT NULL,
  `email` text NOT NULL,
  `mobile_phno` text NOT NULL,
  `land_phno` text NOT NULL,
  `address` text NOT NULL,
  `rollno` text NOT NULL,
  `rank` int(11) NOT NULL,
  `quota` text NOT NULL,
  `school_1` text NOT NULL,
  `regno_1` text NOT NULL,
  `board_1` text NOT NULL,
  `percentage_1` float NOT NULL,
  `school_2` text NOT NULL,
  `regno_2` text NOT NULL,
  `board_2` text NOT NULL,
  `percentage_2` float NOT NULL,
  `no_chance1` text NOT NULL,
  `courseid` varchar(50) NOT NULL,
  `branch_or_specialisation` varchar(100) NOT NULL,
  `image` longblob NOT NULL,
  `gate_score` int(11) DEFAULT NULL,
  `admission_type` varchar(30) NOT NULL,
  `entry_sem` int(2) NOT NULL,
  `exit_sem` int(2) DEFAULT NULL,
  `blood` varchar(5) NOT NULL,
  `name_guardian` text NOT NULL,
  `relation` text NOT NULL,
  `occupation` text NOT NULL,
  `income` int(11) NOT NULL,
  `guard_contactno` text NOT NULL,
  `guard_email` text NOT NULL,
  `physics` int(11) NOT NULL,
  `chemistry` int(11) NOT NULL,
  `maths` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `percentage` float NOT NULL,
  `school_3` text NOT NULL,
  `degree_course` varchar(50) NOT NULL,
  `degree_regno` varchar(50) NOT NULL,
  `degree_marks` int(11) NOT NULL,
  `degree_percent` float DEFAULT NULL,
  `board_3` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Submitted',
  `last_institution` text NOT NULL,
  `tc_no_adm` varchar(100) NOT NULL,
  `tc_date_adm` date NOT NULL,
  PRIMARY KEY (`temp_no`),
  KEY `branch_or_specialisation` (`branch_or_specialisation`),
  KEY `branch_or_specialisation_2` (`branch_or_specialisation`),
  KEY `courseid` (`courseid`),
  KEY `courseid_2` (`courseid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ugstudent_qual`
--

DROP TABLE IF EXISTS `ugstudent_qual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ugstudent_qual` (
  `admissionno` varchar(50) NOT NULL,
  `physics` text,
  `chemistry` text,
  `maths` text,
  `total_marks` int(11) DEFAULT NULL,
  `percentage` int(11) DEFAULT NULL,
  PRIMARY KEY (`admissionno`),
  CONSTRAINT `ugstudent_qual_ibfk_1` FOREIGN KEY (`admissionno`) REFERENCES `stud_details` (`admissionno`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `university_mark`
--

DROP TABLE IF EXISTS `university_mark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `university_mark` (
  `semester` varchar(50) NOT NULL,
  `registerno` int(10) NOT NULL,
  `subject_code` varchar(100) NOT NULL,
  `mark` varchar(50) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-10  3:10:59
