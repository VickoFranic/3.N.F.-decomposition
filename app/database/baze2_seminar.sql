-- phpMyAdmin SQL Dump
-- version 4.3.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 28, 2015 at 04:10 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `baze2_seminar`
--

-- --------------------------------------------------------

--
-- Table structure for table `func_depend`
--

CREATE TABLE IF NOT EXISTS `func_depend` (
  `ID` int(11) NOT NULL,
  `Schema_ID` int(11) NOT NULL,
  `fd_L` varchar(50) CHARACTER SET utf8 NOT NULL,
  `fd_R` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `func_depend`
--

INSERT INTO `func_depend` (`ID`, `Schema_ID`, `fd_L`, `fd_R`) VALUES
(5, 4, 'A', 'D'),
(7, 4, 'B', 'E'),
(8, 4, 'E', 'B'),
(9, 6, 'Z', 'X'),
(10, 6, 'XY', 'Z'),
(11, 7, 'A', 'BC'),
(12, 7, 'AB', 'D'),
(13, 7, 'CD', 'A'),
(14, 7, 'CD', 'B'),
(16, 8, 'P', 'U'),
(17, 8, 'VS', 'P'),
(18, 8, 'VU', 'S'),
(19, 8, 'VR', 'S'),
(20, 8, 'PR', 'O'),
(24, 10, 'A', 'D'),
(25, 10, 'AG', 'B'),
(26, 10, 'B', 'G'),
(27, 10, 'B', 'E'),
(28, 10, 'E', 'B'),
(29, 10, 'E', 'F'),
(30, 11, 'O', 'M'),
(31, 11, 'M', 'P'),
(32, 12, 'A', 'B'),
(33, 12, 'A', 'C'),
(35, 13, 'P', 'M'),
(36, 14, 'B', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `primary_key`
--

CREATE TABLE IF NOT EXISTS `primary_key` (
  `ID` int(11) NOT NULL,
  `Schema_ID` int(11) NOT NULL,
  `pr_key` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `primary_key`
--

INSERT INTO `primary_key` (`ID`, `Schema_ID`, `pr_key`) VALUES
(4, 4, 'ABC'),
(5, 4, 'AEC'),
(8, 6, 'YZ'),
(9, 6, 'XY'),
(10, 7, 'A'),
(11, 7, 'CD'),
(12, 8, 'VR'),
(15, 10, 'ACG'),
(16, 10, 'ACB'),
(17, 10, 'ACE'),
(18, 11, 'O'),
(19, 12, 'A'),
(22, 14, 'AB');

-- --------------------------------------------------------

--
-- Table structure for table `rel_schema`
--

CREATE TABLE IF NOT EXISTS `rel_schema` (
  `ID` int(11) NOT NULL,
  `rschema` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rel_schema`
--

INSERT INTO `rel_schema` (`ID`, `rschema`) VALUES
(4, 'ABCDE'),
(6, 'XYZ'),
(7, 'ABCD'),
(8, 'PUVSRO'),
(10, 'ABCDEFG'),
(11, 'OMP'),
(12, 'ABC'),
(14, 'ABC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `func_depend`
--
ALTER TABLE `func_depend`
  ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Depend_ID` (`ID`), ADD KEY `Schema_ID` (`Schema_ID`), ADD KEY `Schema_ID_2` (`Schema_ID`);

--
-- Indexes for table `primary_key`
--
ALTER TABLE `primary_key`
  ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `PK_ID` (`ID`), ADD KEY `Schema_ID` (`Schema_ID`);

--
-- Indexes for table `rel_schema`
--
ALTER TABLE `rel_schema`
  ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Schema_ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `func_depend`
--
ALTER TABLE `func_depend`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `primary_key`
--
ALTER TABLE `primary_key`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `rel_schema`
--
ALTER TABLE `rel_schema`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
