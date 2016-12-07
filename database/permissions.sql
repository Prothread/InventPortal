-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 07 dec 2016 om 09:21
-- Serverversie: 10.1.13-MariaDB
-- PHP-versie: 7.0.6

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
-- Tabelstructuur voor tabel `permissions`
--

CREATE TABLE `permissions` (
  `permission` varchar(32) NOT NULL,
  `Klant` tinyint(1) NOT NULL,
  `Gebruiker` tinyint(1) NOT NULL,
  `Beheerder` tinyint(1) NOT NULL,
  `Admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `permissions`
--

INSERT INTO `permissions` (`permission`, `Klant`, `Gebruiker`, `Beheerder`, `Admin`) VALUES
('CAN_SHOW_HOME', 0, 1, 1, 1),
('CAN_UPLOAD', 0, 1, 1, 1),
('CAN_SHOW_OVERZICHT', 0, 1, 1, 1),
('CAN_SHOW_USEROVERZICHT', 1, 1, 1, 1),
('CAN_EDIT_SETTINGS', 0, 0, 0, 1),
('CAN_SHOW_KLANTPAGINA', 0, 1, 1, 1),
('CAN_CREATE_CLIENT', 0, 0, 1, 1),
('CAN_EDIT_CLIENT', 0, 0, 1, 1),
('CAN_ACCORD', 1, 0, 0, 0),
('CAN_EDIT_ACCORD', 0, 0, 1, 1),
('CAN_SHOW_ITEM', 1, 1, 1, 1),
('CAN_SHOW_USERS', 0, 1, 1, 1),
('CAN_CREATE_USER', 0, 0, 0, 1),
('CAN_EDIT_USER', 0, 0, 0, 1),
('CAN_ADD_INTERN_COMMENT', 0, 0, 1, 1),
('CAN_USE_STATUSPORTAL', 0, 0, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
