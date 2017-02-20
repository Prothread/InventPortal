-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 06 feb 2017 om 11:37
-- Serverversie: 10.1.19-MariaDB
-- PHP-versie: 7.0.13

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
-- Tabelstructuur voor tabel `comments`
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
-- Tabelstructuur voor tabel `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `mailid` int(11) NOT NULL,
  `images` varchar(64) NOT NULL,
  `version` int(11) NOT NULL DEFAULT '1',
  `verify` int(1) NOT NULL,
  `downloadable` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mail`
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
-- Tabelstructuur voor tabel `permgroup`
--

CREATE TABLE `permgroup` (
  `id` int(11) NOT NULL,
  `userperm` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `assignable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `permgroup`
--

INSERT INTO `permgroup` (`id`, `userperm`, `name`, `assignable`) VALUES
(1, 1, 'Klant', 1),
(2, 2, 'Gebruiker', 1),
(3, 3, 'Beheerder', 1),
(4, 4, 'Admin', 1),
(5, 5, 'SuperAdmin', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `permissions`
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
-- Gegevens worden geëxporteerd voor tabel `permissions`
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
(9, 'CAN_ACCORD', 1, 0, 1, 1, 1),
(10, 'CAN_EDIT_ACCORD', 0, 0, 1, 1, 1),
(11, 'CAN_SHOW_ITEM', 1, 1, 1, 1, 1),
(12, 'CAN_SHOW_USERS', 0, 1, 1, 1, 1),
(13, 'CAN_CREATE_USER', 0, 0, 0, 1, 1),
(14, 'CAN_EDIT_USER', 0, 0, 0, 1, 1),
(15, 'CAN_ADD_INTERN_COMMENT', 0, 0, 1, 1, 1),
(16, 'CAN_USE_STATUSPORTAL', 0, 0, 1, 1, 1),
(17, 'CAN_BE_EDITED', 1, 1, 1, 1, 0),
(18, 'CAN_RESET_CLIENT_PASSWORD', 0, 1, 1, 1, 1),
(19, 'CAN_RESET_USER_PASSWORD	', 0, 0, 1, 1, 1),
(20, 'CAN_SHOW_USERIP', 0, 1, 1, 1, 1),
(21, 'CAN_DELETE_CLIENT', 0, 1, 1, 1, 1),
(22, 'CAN_DELETE_USER', 0, 0, 0, 1, 1),
(23, 'CAN_USE_ITEM_DELETE', 0, 1, 1, 1, 1),
(24, 'CAN_CHANGE_LANGUAGE', 1, 1, 1, 1, 1),
(25, 'CAN_CHANGE_USER_LANGUAGE', 0, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `SMTP` varchar(64) NOT NULL,
  `SMTPport` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Mailpass` varchar(64) NOT NULL,
  `Logo` varchar(100) NOT NULL,
  `Header` varchar(64) NOT NULL,
  `Host` varchar(64) NOT NULL,
  `globalmail` tinyint(1) NOT NULL,
  `contactmail` varchar(64) NOT NULL,
  `background` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `settings`
--

INSERT INTO `settings` (`id`, `SMTP`, `SMTPport`, `Email`, `Mailpass`, `Logo`, `Header`, `Host`, `globalmail`, `contactmail`, `background`) VALUES
(0, 'smtp.gmail.com', '587', 'madalcomedia@gmail.com', 'Madalco&Invent', 'madlogo.png', '#dd2c4c', 'http://localhost/InventPortal', 0, 'mmedia@gmail.com', 'invent.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `status_item`
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
-- Tabelstructuur voor tabel `usermail`
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
-- Tabelstructuur voor tabel `users`
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
  `lang` varchar(4) NOT NULL DEFAULT 'nl',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `paswoordvergeten` varchar(256) NOT NULL,
  `passresetdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `profimg`, `naam`, `email`, `altmail`, `paswoord`, `permgroup`, `bedrijfsnaam`, `adres`, `postcode`, `plaats`, `lang`, `active`, `paswoordvergeten`, `passresetdate`) VALUES
(1, 'profile.png', 'Admin', 'madalcomedia@gmail.com', '', 'da1bf1780c5d00bcb03553ebd4b5ae3adb73aa09678b5d58759fba9216a0544d', 5, '', '', '', '', 'nl', 1, '', '0000-00-00 00:00:00');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Indexen voor tabel `permgroup`
--
ALTER TABLE `permgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `status_item`
--
ALTER TABLE `status_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `usermail`
--
ALTER TABLE `usermail`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `permgroup`
--
ALTER TABLE `permgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT voor een tabel `status_item`
--
ALTER TABLE `status_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `usermail`
--
ALTER TABLE `usermail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
