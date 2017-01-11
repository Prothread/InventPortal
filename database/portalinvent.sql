-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2017 at 01:42 PM
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `mailid` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `commentgroep` int(11) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `mailid` int(11) NOT NULL,
  `fakename` varchar(64) NOT NULL,
  `images` varchar(64) NOT NULL,
  `version` int(11) NOT NULL DEFAULT '1',
  `verify` int(1) NOT NULL,
  `downloadable` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` int(32) NOT NULL,
  `onderwerp` varchar(32) NOT NULL,
  `verstuurder` varchar(32) NOT NULL,
  `beschrijving` varchar(250) NOT NULL,
  `naam` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `key` varchar(32) NOT NULL,
  `answer` varchar(250) NOT NULL,
  `datum` date NOT NULL,
  `verified` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permgroup`
--

CREATE TABLE `permgroup` (
  `id` int(11) NOT NULL,
  `userperm` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `assignable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permgroup`
--

INSERT INTO `permgroup` (`id`, `userperm`, `name`, `assignable`) VALUES
(1, 1, 'Klant', 1),
(2, 2, 'Gebruiker', 1),
(3, 3, 'Beheerder', 1),
(4, 4, 'Admin', 1),
(5, 5, 'SuperAdmin', 0);

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
(17, 'CAN_BE_EDITED', 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `SMTP` varchar(64) NOT NULL,
  `SMTPport` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Mailpass` varchar(64) NOT NULL,
  `Logo` varchar(100) NOT NULL,
  `Header` varchar(64) NOT NULL,
  `Host` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `SMTP`, `SMTPport`, `Email`, `Mailpass`, `Logo`, `Header`, `Host`) VALUES
(0, 'smtp.gmail.com', '587', 'madalcomedia@gmail.com', 'Madalco&Invent', 'madlogo.png', '#dd2c4c', 'http://localhost/InventPortal');

-- --------------------------------------------------------

--
-- Table structure for table `status_item`
--

CREATE TABLE `status_item` (
  `id` int(11) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `person` int(11) NOT NULL,
  `deadline` date NOT NULL,
  `category` varchar(40) NOT NULL,
  `comment` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usermail`
--

CREATE TABLE `usermail` (
  `id` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `mailid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `profimg` varchar(100) NOT NULL DEFAULT 'profile.png',
  `naam` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `altmail` varchar(60) NOT NULL,
  `paswoord` varchar(256) NOT NULL,
  `permgroup` int(11) NOT NULL DEFAULT '2',
  `bedrijfsnaam` varchar(64) NOT NULL,
  `adres` varchar(64) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `plaats` varchar(64) NOT NULL,
  `paswoordvergeten` varchar(256) NOT NULL,
  `passresetdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profimg`, `naam`, `email`, `altmail`, `paswoord`, `permgroup`, `bedrijfsnaam`, `adres`, `postcode`, `plaats`, `paswoordvergeten`, `passresetdate`) VALUES
(1, 'profile.png', 'Admin', 'madalcomedia@gmail.com', '', 'da1bf1780c5d00bcb03553ebd4b5ae3adb73aa09678b5d58759fba9216a0544d', 4, '', '', '', '', '', '0000-00-00 00:00:00'),
(2, 'profile.png', 'Beheerder', 'kevin.herdershof@hotmail.com', '', 'f6ed7a7e5c17493408200f770c915d88441daeb5bb39a28fefdd9e4a2f6a117f', 5, '', 'Nieuwe Karnemelkstraat 27', '4576BT', 'Koewacht', '', '0000-00-00 00:00:00'),
(3, 'profile.png', 'fasd', 'ffsad@hofdas.nl', '', 'ddba4b93d111c8993f64f23f373b90c417cebaa98492305fc2a5f35495ff0a2f', 1, '', '', '', '', '', '0000-00-00 00:00:00'),
(4, 'profile.png', 'fasd', 'fsda@Jfldas.nl', '', 'a38d0a5b36636968ceadcdda4fbd04a499e4c189a8c661a06a2ba35aef60ac28', 1, '', '', '', '', '', '0000-00-00 00:00:00'),
(5, 'profile.png', 'captain jack', 'captainjackers@jackkkk.nl', '', '6d5a8ebcccf09ae1276bd219ef6a6cbfc48010e12f33cf793cd49bcf3a501618', 1, '', '', '', '', '', '0000-00-00 00:00:00'),
(6, 'profile.png', 'newone', 'newone@asdf.nl', '', '4df2671984e3fd26524c66efacacc119432c2b3aa370493a5066288ee9c868bb', 1, '', '', '', '', '', '0000-00-00 00:00:00'),
(7, 'profile.png', 'fsda', 'fasd@fdsa.nl', '', 'c3167bb0aa72117b954060bf9668746027189a357d9b86108dd727c785a30d9f', 1, '', '', '', '', '', '0000-00-00 00:00:00'),
(8, 'profile.png', 'fdsa', 'fafdsasd@fdsa.nl', '', '853963c3a1d911fbce779d55692f056dbba9a4a914e8f460fbb395c9585e6a8c', 1, '', '', '', '', '', '0000-00-00 00:00:00'),
(9, 'profile.png', 'fsda', 'ripjer@fd.nl', '', '36dc84507928fb57cfc85a579690376d1d602e1caee72c1fecff9d73e3fc2fd9', 1, '', '', '', '', '', '0000-00-00 00:00:00'),
(10, 'profile.png', 'need more', 'clients@lel.nl', '', 'fbda1b79ef9153e8ef324f6542f791d543608f5ee056a55ff7587467dcfbf2e0', 1, '', '', '', '', '', '0000-00-00 00:00:00'),
(11, 'profile.png', 'k boi', 'maareh@ja.nl', '', '6da09a9a7a9fa101f0cd33bd298fa8c426058ba8c11aa09e862f861ac5592570', 1, '', '', '', '', '', '0000-00-00 00:00:00'),
(12, 'profile.png', 'k beyy', 'datester@yeaboy.nl', '', '1fb722df47deb9ed623a7bdb052fe9a7059dc4346741d8b700aa98e305bb17c4', 1, '', '', '', '', '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Indexes for table `permgroup`
--
ALTER TABLE `permgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_item`
--
ALTER TABLE `status_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usermail`
--
ALTER TABLE `usermail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permgroup`
--
ALTER TABLE `permgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `status_item`
--
ALTER TABLE `status_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usermail`
--
ALTER TABLE `usermail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
