-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 08 dec 2016 om 11:42
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
-- Tabelstructuur voor tabel `image`
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

--
-- Gegevens worden geëxporteerd voor tabel `image`
--

INSERT INTO `image` (`id`, `mailid`, `fakename`, `images`, `version`, `verify`, `downloadable`) VALUES
(1, 1, '', 'TmT5UPrT_1.jpg', 1, 0, 0),
(2, 2, '', 'xbox-logo_318-53731_2.jpg', 1, 3, 0),
(3, 3, '', '83900a5b6d403ddbfd4e843ea70828f4_3.jpg', 1, 0, 0),
(4, 4, '', 'xbox-logo_318-53731_4.jpg', 1, 0, 0),
(5, 5, '', 'Logo_TV_2015_5.png', 1, 1, 1),
(6, 6, '', 'xbox-logo_318-53731_6.jpg', 1, 0, 0),
(7, 7, '', 'xbox-logo_318-53731_7.jpg', 1, 0, 0),
(8, 8, '', 'TmT5UPrT_8.jpg', 1, 0, 0),
(9, 9, '', 'xbox-logo_318-53731_9.jpg', 1, 0, 0),
(10, 10, '', '2fc5229b52aa228de5931ad4a6fc3e7a_10.png', 1, 0, 0),
(11, 11, '', 'xbox-logo_318-53731_11.jpg', 1, 0, 0),
(12, 12, '', '2fc5229b52aa228de5931ad4a6fc3e7a_12.png', 1, 0, 0),
(13, 13, '', 'Logo_TV_2015_13.png', 1, 0, 0),
(14, 14, '', 'xbox-logo_318-53731_14.jpg', 1, 2, 0),
(15, 15, '', '2fc5229b52aa228de5931ad4a6fc3e7a_15.png', 1, 3, 0),
(16, 15, '', '83900a5b6d403ddbfd4e843ea70828f4_15.jpg', 2, 0, 0),
(17, 13, '', 'xbox-logo_318-53731_13.jpg', 2, 0, 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
