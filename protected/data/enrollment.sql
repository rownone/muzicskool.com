-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2013 at 05:43 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_band`
--

CREATE TABLE IF NOT EXISTS `tbl_band` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `contact_first_name` varchar(255) NOT NULL,
  `contact_last_name` varchar(255) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `contact_address` varchar(255) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_band`
--

INSERT INTO `tbl_band` (`id`, `name`, `contact_first_name`, `contact_last_name`, `contact_number`, `contact_address`, `contact_email`, `notes`) VALUES
(1, 'kombo lata', 'serok', 'serok', '123213', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `datetime_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `course` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE IF NOT EXISTS `tbl_course` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`id`, `name`, `description`) VALUES
(1, 'Piano', 'Piano');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enrollment`
--

CREATE TABLE IF NOT EXISTS `tbl_enrollment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `datetime_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fee` float NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `group_id` bigint(20) NOT NULL,
  `band_id` bigint(20) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

CREATE TABLE IF NOT EXISTS `tbl_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`id`, `name`, `notes`) VALUES
(2, 'Group1', ''),
(3, 'Group2', '2'),
(4, 'Group3', ''),
(5, 'Group5', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_items`
--

CREATE TABLE IF NOT EXISTS `tbl_group_items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tbl_group_items`
--

INSERT INTO `tbl_group_items` (`id`, `group_id`, `student_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(5, 4, 1),
(6, 4, 3),
(8, 2, 5),
(9, 2, 4),
(12, 3, 5),
(13, 3, 1),
(19, 5, 5),
(20, 5, 3),
(21, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE IF NOT EXISTS `tbl_student` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `datetime_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `home_address` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `datetime_created`, `first_name`, `last_name`, `middle_name`, `name`, `contact_number`, `home_address`, `email`, `notes`) VALUES
(1, '2013-07-14 22:07:40', 'student1a', 'student1b', 'student1c', 'student1b, student1a s.', '34242432c', 'd', 'e', 'g'),
(2, '2013-07-14 22:07:40', 'student2', 'student2', 'student2', 'student2, student2 s.', '3232', 'dsfawef', 'g@a.com', ''),
(3, '2013-07-14 22:07:40', 'student3', 'student3', 'student3', 'student3, student3 s.', '342', '', '', ''),
(4, '2013-07-14 22:07:40', 'student4', 'student4', 'student4', 'student4, student4 s.', '43423', '', '', 'vsvr'),
(5, '2013-07-14 22:05:41', 'aaa', 'ccc', 'bbb', 'ccc, aaa b.', '43243', 'qqq', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studio`
--

CREATE TABLE IF NOT EXISTS `tbl_studio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_studio`
--

INSERT INTO `tbl_studio` (`id`, `code`, `name`, `description`, `notes`) VALUES
(1, 'studio1', 'studio1', 'studio1', ''),
(2, 'studio2', 'studio2', 'desc', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE IF NOT EXISTS `tbl_teacher` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `datetime_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`id`, `datetime_created`, `first_name`, `last_name`, `middle_name`, `name`, `contact_number`, `email`, `active`, `notes`) VALUES
(1, '2013-07-18 00:03:05', 'Teacher1', 'Teacher1', 'Teacher1', 'Teacher1, Teacher1 T', '321', '', 0, ''),
(2, '2013-07-18 00:03:05', 'Teacher2', 'Teacher2', 'Teacher2', 'Teacher2, Teacher2 T', '4324', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher_schedule`
--

CREATE TABLE IF NOT EXISTS `tbl_teacher_schedule` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) NOT NULL,
  `day` varchar(20) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_teacher_schedule`
--

INSERT INTO `tbl_teacher_schedule` (`id`, `teacher_id`, `day`, `time_from`, `time_to`) VALUES
(1, 1, 'Mon', '09:00:00', '10:00:00'),
(2, 1, 'Tue', '09:00:00', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test`
--

CREATE TABLE IF NOT EXISTS `tbl_test` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL,
  `studio_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`) VALUES
(22, 'debugger', 'debugger', 'debugger@debugger.com'),
(23, 'test1', 'pass1', 'test1@example.com'),
(24, 'test2a', 'pass2', 'test2@example.com'),
(25, 'test3', 'pass3', 'test3@example.com'),
(26, 'test4', 'pass4', 'test4@example.com'),
(27, 'test5', 'pass5', 'test5@example.com'),
(28, 'test6', 'pass6', 'test6@example.com'),
(29, 'test7', 'pass7', 'test7@example.com'),
(30, 'test8', 'pass8', 'test8@example.com'),
(31, 'test9', 'pass9', 'test9@example.com'),
(32, 'test10', 'pass10', 'test10@example.com'),
(33, 'test11', 'pass11', 'test11@example.com'),
(34, 'test12', 'pass12', 'test12@example.com'),
(35, 'test13', 'pass13', 'test13@example.com'),
(36, 'test14', 'pass14', 'test14@example.com'),
(37, 'test15', 'pass15', 'test15@example.com'),
(38, 'test16', 'pass16', 'test16@example.com'),
(39, 'test17', 'pass17', 'test17@example.com'),
(40, 'test18', 'pass18', 'test18@example.com'),
(41, 'test19', 'pass19', 'test19@example.com'),
(42, 'test20', 'pass20', 'test20@example.com'),
(43, 'test21', 'pass21', 'test21@example.com'),
(44, 'admin', 'admin', 'row_none@yahoo.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
