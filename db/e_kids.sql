-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2018 at 11:02 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `e_kids`
--
CREATE DATABASE IF NOT EXISTS `e_kids` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `e_kids`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `adminID` varchar(255) NOT NULL,
  `userID` varchar(255) NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_answers`
--

CREATE TABLE IF NOT EXISTS `tbl_answers` (
  `answersOptionID` varchar(255) NOT NULL,
  `optionA` varchar(255) NOT NULL,
  `optionB` varchar(255) NOT NULL,
  `optionC` varchar(255) NOT NULL,
  `optionD` varchar(255) NOT NULL,
  `correctAnswer` varchar(255) NOT NULL,
  PRIMARY KEY (`answersOptionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_answers`
--

INSERT INTO `tbl_answers` (`answersOptionID`, `optionA`, `optionB`, `optionC`, `optionD`, `correctAnswer`) VALUES
('ANgrade4french20', 'a3', 'b3', 'c3', 'd3', 'c3'),
('ANgrade4french34', 'a4', 'b4', 'c4', 'd4', 'd4'),
('ANgrade4french64', 'a1', 'b1', 'c1', 'd1', 'a1'),
('ANgrade4french70', 'a2', 'b2', 'c2', 'd2', 'b2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_child`
--

CREATE TABLE IF NOT EXISTS `tbl_child` (
  `childID` varchar(255) NOT NULL,
  `childFullName` varchar(255) NOT NULL,
  `childClass` int(1) NOT NULL,
  `parentID` varchar(255) NOT NULL,
  PRIMARY KEY (`childID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_child`
--

INSERT INTO `tbl_child` (`childID`, `childFullName`, `childClass`, `parentID`) VALUES
('C918578q', 'q', 1, 'U151152q');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE IF NOT EXISTS `tbl_course` (
  `courseID` varchar(255) NOT NULL,
  `creatorID` varchar(255) NOT NULL,
  `courseSubject` varchar(255) NOT NULL,
  `courseClass` varchar(255) NOT NULL,
  `courseNumberOfQuestion` int(1) NOT NULL,
  PRIMARY KEY (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`courseID`, `creatorID`, `courseSubject`, `courseClass`, `courseNumberOfQuestion`) VALUES
('grade420', 'q', 'french', 'grade4', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parent`
--

CREATE TABLE IF NOT EXISTS `tbl_parent` (
  `parentID` varchar(255) NOT NULL,
  `parentFullName` varchar(255) NOT NULL,
  `childID` varchar(255) NOT NULL,
  PRIMARY KEY (`parentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE IF NOT EXISTS `tbl_question` (
  `courseID` varchar(255) NOT NULL,
  `questionID` varchar(255) NOT NULL,
  `questionNumber` int(1) NOT NULL,
  `assessmentQuestion` varchar(255) NOT NULL,
  `chapterTitle` varchar(255) NOT NULL,
  `videoURL` varchar(255) NOT NULL,
  `answersOptionID` varchar(255) NOT NULL,
  PRIMARY KEY (`questionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`courseID`, `questionID`, `questionNumber`, `assessmentQuestion`, `chapterTitle`, `videoURL`, `answersOptionID`) VALUES
('grade420', 'QUgrade4french100', 0, 'q1', 't1', 'u1', 'ANgrade4french64'),
('grade420', 'QUgrade4french17', 3, 'q4', 't4', 'u4', 'ANgrade4french34'),
('grade420', 'QUgrade4french60', 2, 'q3', 't3', 'u3', 'ANgrade4french20'),
('grade420', 'QUgrade4french92', 1, 'q2', 't2', 'u2', 'ANgrade4french70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE IF NOT EXISTS `tbl_teacher` (
  `teacherID` varchar(255) NOT NULL,
  `userID` varchar(255) NOT NULL,
  PRIMARY KEY (`teacherID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `userID` varchar(255) NOT NULL,
  `userFullName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPhoneNumber` varchar(10) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userID`, `userFullName`, `userEmail`, `userPhoneNumber`, `userPassword`, `userType`) VALUES
('U151152q', 'q', 'q@email.com', 'q', 'q', 'parent');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
