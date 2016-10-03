-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 03 okt 2016 om 13:57
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
  `verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `mail`
--

INSERT INTO `mail` (`id`, `onderwerp`, `verstuurder`, `beschrijving`, `naam`, `email`, `key`, `verified`) VALUES
(1, 'Invent Portal', 'Alexander', 'Dit is een test', 'Kevin', 'kevin.herdershof@hotmail.com', '90e06086c6cdd00ea0eb70264768285c', 1),
(2, 'tef', 'jef', 'lef', 'kef', 'ke', '2831c11e2ce297cb68e01f0aba163cf4', 127),
(3, 'tef', 'jef', 'lef', 'kef', 'kevin.herdershof@hotmail.com', '516934831bb4749a97ce6715035dbd36', 127),
(4, 'tef', 'jef', 'lef', 'kef', 'kevin.herdershof@hotmail.com', '336daf11d1cbe55f88b2c253ad80d922', 127),
(5, 'tef', 'jef', 'lef', 'kef', 'kevin.herdershof@hotmail.com', '125b3618a4e2377134f493d9333cdeac', 125),
(6, 'tef', 'jef', 'lef', 'kef', 'kevin.herdershof@hotmail.com', '3a400bbdc7f8902082562ed1971fd139', 3),
(7, 'tef', 'jef', 'lef', 'kef', 'kevin.herdershof@hotmail.com', '0354c7593cad9d56d7daacfffaf01e0b', 127),
(8, 'Promise', 'Jeffrey', 'is broken', 'Kevin', 'kevin.herdershof@hotmail.com', 'eb41d2a9ff4eb929bfa7672b809f7d0e', 0),
(9, 'tef', 'jef', 'kef', 'kef', 'kevin.herdershof@hotmail.com', '864f117ceb1a792d793d90985a85ef6f', 127),
(10, 'tef', 'jef', 'kef', 'kef', 'kevin.herdershof@hotmail.com', '43ecc2bd463d59aa977d98edf2d9d1ad', 43);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
