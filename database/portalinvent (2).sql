-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 okt 2016 om 08:53
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
  `images` varchar(64) NOT NULL,
  `verify` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `image`
--

INSERT INTO `image` (`id`, `mailid`, `images`, `verify`) VALUES
(1, 1, '6b4_1.jpg', 0),
(2, 1, 'sword-art-online-201601228_1.jpg', 0),
(3, 2, '6b4_2.jpg', 0),
(4, 2, 'sword-art-online-201601228_2.jpg', 0),
(5, 3, '6b4_3.jpg', 0),
(6, 3, 'sword-art-online-201601228_3.jpg', 0),
(7, 4, '6b4_4.jpg', 1),
(8, 4, 'sword-art-online-201601228_4.jpg', 1),
(9, 5, '005_charmeleon_by_rayo123000-d8mriq9_5.png', 0),
(10, 5, '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(11, 5, 'Celeste0502-image-celeste0502-36795437-1200-960_5.jpg', 0),
(12, 5, 'Goodra_5.jpg', 0),
(13, 5, 'Hatsune3_5.png', 0),
(14, 5, 'Kangaroo-in-Sunset-photos_5.jpg', 0),
(15, 5, 'lina_5.jpg', 0),
(16, 6, '005_charmeleon_by_rayo123000-d8mriq9_6.png', 0),
(17, 6, '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(18, 6, 'Celeste0502-image-celeste0502-36795437-1200-960_6.jpg', 0),
(19, 6, 'Goodra_6.jpg', 0),
(20, 6, 'Hatsune3_6.png', 0),
(21, 6, 'Kangaroo-in-Sunset-photos_6.jpg', 0),
(22, 6, 'lina_6.jpg', 0),
(23, 7, '005_charmeleon_by_rayo123000-d8mriq9_7.png', 0),
(24, 7, '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(25, 7, 'Celeste0502-image-celeste0502-36795437-1200-960_7.jpg', 0),
(26, 7, 'Goodra_7.jpg', 0),
(27, 7, 'Hatsune3_7.png', 0),
(28, 7, 'Kangaroo-in-Sunset-photos_7.jpg', 0),
(29, 7, 'lina_7.jpg', 0),
(30, 7, 'maxresdefault_7.jpg', 0),
(31, 7, 'saomusicmodpic_7.jpg', 0),
(32, 8, '005_charmeleon_by_rayo123000-d8mriq9_8.png', 0),
(33, 8, '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(34, 8, 'Celeste0502-image-celeste0502-36795437-1200-960_8.jpg', 0),
(35, 8, 'Goodra_8.jpg', 0),
(36, 8, 'Hatsune3_8.png', 0),
(37, 8, 'Kangaroo-in-Sunset-photos_8.jpg', 0),
(38, 8, 'lina_8.jpg', 0),
(39, 8, 'maxresdefault_8.jpg', 0),
(40, 8, 'saomusicmodpic_8.jpg', 0),
(41, 9, 'Celeste0502-image-celeste0502-36795437-1200-960_9.jpg', 0),
(42, 9, 'Goodra_9.jpg', 1);

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
  `imgname` varchar(64) NOT NULL,
  `uniquename` varchar(250) NOT NULL,
  `datum` date NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `mail`
--

INSERT INTO `mail` (`id`, `onderwerp`, `verstuurder`, `beschrijving`, `naam`, `email`, `key`, `imgname`, `uniquename`, `datum`, `verified`) VALUES
(1, 'jef', 'Gijs van den Abeele', 'tef', 'Jeffrey', 'valckxj@outlook.com', '307a9b0f43132ed13355ce742cd11746', '6b4.jpg, sword-art-online-201601228.jpg', '6b4_1.jpg, sword-art-online-201601228_1.jpg', '2016-10-10', 0),
(2, 'jef', 'Gijs van den Abeele', 'tef', 'Jeffrey', 'valckxj@outlook.com', 'f20311cf54667c53f0510731409426a1', '6b4.jpg, sword-art-online-201601228.jpg', '6b4_2.jpg, sword-art-online-201601228_2.jpg', '2016-10-10', 0),
(3, 'jef', 'Gijs van den Abeele', 'tef', 'Jeffrey', 'valckxj@outlook.com', '829f03e695f276edeaae4e0f541b7341', '6b4.jpg, sword-art-online-201601228.jpg', '6b4_3.jpg, sword-art-online-201601228_3.jpg', '2016-10-10', 0),
(4, 'Nieuwe test', 'Gijs van den Abeele', 'mm', 'Jeffrey', 'valckxj@outlook.com', '6bb3cef6a14ac19fbc9cb3fee88c9387', '6b4.jpg, sword-art-online-201601228.jpg', '6b4_4.jpg, sword-art-online-201601228_4.jpg', '2016-10-10', 0),
(5, 'MHAHAHA', 'Gijs van den Abeele', 'haha', 'Jeffrey', 'valckxj@outlook.com', '52e07617cf1f0a6ac33c6f14b726ea9e', '005_charmeleon_by_rayo123000-d8mriq9.png, 131Lapras_Pokemon_Myst', '005_charmeleon_by_rayo123000-d8mriq9_5.png, 131Lapras_Pokemon_My', '2016-10-10', 0),
(6, 'MHAHAHA', 'Gijs van den Abeele', 'haha', 'Jeffrey', 'valckxj@outlook.com', 'e64607f36b83d22ac673c9ff19d999ed', '005_charmeleon_by_rayo123000-d8mriq9.png, 131Lapras_Pokemon_Myst', '005_charmeleon_by_rayo123000-d8mriq9_6.png, 131Lapras_Pokemon_My', '2016-10-10', 0),
(7, 'MHAHAHA', 'Gijs van den Abeele', 'haha', 'Jeffrey', 'valckxj@outlook.com', '7a47c74ccb4d7aed881a2e24824dd9bb', '005_charmeleon_by_rayo123000-d8mriq9.png, 131Lapras_Pokemon_Myst', '005_charmeleon_by_rayo123000-d8mriq9_7.png, 131Lapras_Pokemon_My', '2016-10-10', 0),
(8, 'NU DAN UGH', 'Gijs van den Abeele', 'ehehehehehe', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'b381841aa5df029b9bb50ed4619bf1c6', '005_charmeleon_by_rayo123000-d8mriq9.png, 131Lapras_Pokemon_Myst', '005_charmeleon_by_rayo123000-d8mriq9_8.png, 131Lapras_Pokemon_My', '2016-10-10', 1),
(9, 'another one', 'Gijs van den Abeele', 'LOOK AT IT', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'a282921703187ee179494a33d93f6d00', 'Celeste0502-image-celeste0502-36795437-1200-960.jpg, Goodra.jpg', 'Celeste0502-image-celeste0502-36795437-1200-960_9.jpg, Goodra_9.jpg', '2016-10-10', 1);

--
-- Indexen voor geëxporteerde tabellen
--

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
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT voor een tabel `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
