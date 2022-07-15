-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 15, 2022 at 12:33 PM
-- Server version: 10.3.35-MariaDB-cll-lve
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swisicfc_ainhoa`
--

-- --------------------------------------------------------

--
-- Table structure for table `captions`
--

CREATE TABLE `captions` (
  `path` varchar(200) NOT NULL,
  `caption` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `captions`
--

INSERT INTO `captions` (`path`, `caption`) VALUES
('26.jpg', 'daaaaaaaamn ðŸ™ˆ'),
('3B91A154-DC6C-4161-A6B6-A7C621D5469C.jpeg', 'ikjikjin'),
('cover.jpg', 'Yes! ðŸ˜Ž'),
('cover2.jpg', 'One day...'),
('https://www.ainhoa.studio/style/images/gallery/32.jpg', 'A que parte del corazÃ³n van los recuerdos?'),
('https://www.ainhoa.studio/style/images/gallery/3B91A154-DC6C-4161-A6B6-A7C621D5469C.jpeg', 'No tears left to cry');

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE `stats` (
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`views`) VALUES
(5335);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `captions`
--
ALTER TABLE `captions`
  ADD PRIMARY KEY (`path`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
