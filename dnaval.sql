-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 26, 2021 at 10:51 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dnaval`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `idcontent` int(11) NOT NULL AUTO_INCREMENT,
  `twitter` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `about` varchar(4096) DEFAULT NULL,
  `skills` varchar(4096) DEFAULT NULL,
  `resume` varchar(5120) DEFAULT NULL,
  `portfolio` varchar(4096) DEFAULT NULL,
  PRIMARY KEY (`idcontent`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `idproject` int(11) NOT NULL AUTO_INCREMENT,
  `project` varchar(160) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `category` varchar(160) DEFAULT NULL,
  `company` varchar(160) DEFAULT NULL,
  `projectdate` date DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `gif` varchar(255) NOT NULL,
  `idtype` int(11) NOT NULL,
  PRIMARY KEY (`idproject`),
  KEY `fk_project_type_idx` (`idtype`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleid`, `role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `idskills` int(11) NOT NULL AUTO_INCREMENT,
  `skills` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idskills`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `idtype` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `filter` varchar(45) NOT NULL,
  PRIMARY KEY (`idtype`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`idtype`, `type`, `filter`) VALUES
(1, 'PHP', 'filter-php'),
(2, 'LARAVEL', 'filter-laravel'),
(3, 'WORDPRESS', 'filter-wp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idusr` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(160) DEFAULT NULL,
  `picture` varchar(160) DEFAULT NULL,
  `active` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `chpwd` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idusr`),
  KEY `fk_users_role1_idx` (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusr`, `fullname`, `email`, `password`, `phone`, `picture`, `active`, `roleid`, `chpwd`) VALUES
(1, 'admin', 'admin@dnaval.com', '$2y$10$LteafaUeeOhveeAfrBjOeukVYWVLmsixih/FnYordqGeWntZTWpXe', '1234567891', 'DNAVAL_1629073639_admin-avatar.png', 1, 1, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_project_type` FOREIGN KEY (`idtype`) REFERENCES `type` (`idtype`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
