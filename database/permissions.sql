-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2017 at 11:09 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portalinvent`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission` varchar(32) NOT NULL,
  `Klant` tinyint(1) NOT NULL,
  `Gebruiker` tinyint(1) NOT NULL,
  `Beheerder` tinyint(1) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `SuperAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission`, `Klant`, `Gebruiker`, `Beheerder`, `Admin`, `SuperAdmin`) VALUES
(1, 'CAN_SHOW_HOME', 0, 1, 1, 1, 1),
(2, 'CAN_UPLOAD', 0, 1, 1, 1, 1),
(3, 'CAN_SHOW_OVERZICHT', 0, 1, 1, 1, 1),
(4, 'CAN_SHOW_USEROVERZICHT', 1, 1, 1, 1, 1),
(5, 'CAN_EDIT_SETTINGS', 0, 0, 0, 1, 1),
(6, 'CAN_SHOW_KLANTPAGINA', 0, 1, 1, 1, 1),
(7, 'CAN_CREATE_CLIENT', 0, 1, 1, 1, 1),
(8, 'CAN_EDIT_CLIENT', 0, 0, 1, 1, 1),
(9, 'CAN_ACCORD', 1, 0, 0, 0, 1),
(10, 'CAN_EDIT_ACCORD', 0, 0, 1, 1, 1),
(11, 'CAN_SHOW_ITEM', 1, 1, 1, 1, 1),
(12, 'CAN_SHOW_USERS', 0, 1, 1, 1, 1),
(13, 'CAN_CREATE_USER', 0, 0, 0, 1, 1),
(14, 'CAN_EDIT_USER', 0, 0, 0, 1, 1),
(15, 'CAN_ADD_INTERN_COMMENT', 0, 0, 1, 1, 1),
(16, 'CAN_USE_STATUSPORTAL', 0, 0, 1, 1, 1),
(17, 'CAN_BE_EDITED', 1, 1, 1, 1, 0),
(18, 'CAN_RESET_CLIENT_PASSWORD', 0, 1, 1, 1, 1),
(19, 'CAN_RESET_USER_PASSWORD', 0, 0, 1, 1, 1),
(20, 'CAN_SHOW_USERIP', 0, 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
