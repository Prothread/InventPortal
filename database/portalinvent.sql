-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 18 okt 2016 om 11:53
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
  `verify` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `image`
--

INSERT INTO `image` (`id`, `mailid`, `fakename`, `images`, `verify`) VALUES
(1, 1, '', '6b4_1.jpg', 0),
(2, 1, '', 'sword-art-online-201601228_1.jpg', 0),
(3, 2, '', '6b4_2.jpg', 0),
(4, 2, '', 'sword-art-online-201601228_2.jpg', 0),
(5, 3, '', '6b4_3.jpg', 0),
(6, 3, '', 'sword-art-online-201601228_3.jpg', 0),
(7, 4, '', '6b4_4.jpg', 1),
(8, 4, '', 'sword-art-online-201601228_4.jpg', 1),
(9, 5, '', '005_charmeleon_by_rayo123000-d8mriq9_5.png', 0),
(10, 5, '', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(11, 5, '', 'Celeste0502-image-celeste0502-36795437-1200-960_5.jpg', 0),
(12, 5, '', 'Goodra_5.jpg', 0),
(13, 5, '', 'Hatsune3_5.png', 0),
(14, 5, '', 'Kangaroo-in-Sunset-photos_5.jpg', 0),
(15, 5, '', 'lina_5.jpg', 0),
(16, 6, '', '005_charmeleon_by_rayo123000-d8mriq9_6.png', 0),
(17, 6, '', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(18, 6, '', 'Celeste0502-image-celeste0502-36795437-1200-960_6.jpg', 0),
(19, 6, '', 'Goodra_6.jpg', 0),
(20, 6, '', 'Hatsune3_6.png', 0),
(21, 6, '', 'Kangaroo-in-Sunset-photos_6.jpg', 0),
(22, 6, '', 'lina_6.jpg', 0),
(23, 7, '', '005_charmeleon_by_rayo123000-d8mriq9_7.png', 0),
(24, 7, '', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(25, 7, '', 'Celeste0502-image-celeste0502-36795437-1200-960_7.jpg', 0),
(26, 7, '', 'Goodra_7.jpg', 0),
(27, 7, '', 'Hatsune3_7.png', 0),
(28, 7, '', 'Kangaroo-in-Sunset-photos_7.jpg', 0),
(29, 7, '', 'lina_7.jpg', 0),
(30, 7, '', 'maxresdefault_7.jpg', 0),
(31, 7, '', 'saomusicmodpic_7.jpg', 0),
(32, 8, '', '005_charmeleon_by_rayo123000-d8mriq9_8.png', 0),
(33, 8, '', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(34, 8, '', 'Celeste0502-image-celeste0502-36795437-1200-960_8.jpg', 0),
(35, 8, '', 'Goodra_8.jpg', 0),
(36, 8, '', 'Hatsune3_8.png', 0),
(37, 8, '', 'Kangaroo-in-Sunset-photos_8.jpg', 0),
(38, 8, '', 'lina_8.jpg', 0),
(39, 8, '', 'maxresdefault_8.jpg', 0),
(40, 8, '', 'saomusicmodpic_8.jpg', 0),
(41, 9, '', 'Celeste0502-image-celeste0502-36795437-1200-960_9.jpg', 0),
(42, 9, '', 'Goodra_9.jpg', 1),
(43, 10, '', '', 0),
(44, 11, '', '', 0),
(45, 12, '', '4k_12.jpg', 0),
(46, 12, '', 'NCLdctC_12.jpg', 0),
(47, 13, '', '4k_13.jpg', 0),
(48, 13, '', 'NCLdctC_13.jpg', 0),
(49, 14, '', '4k_14.jpg', 0),
(50, 14, '', 'NCLdctC_14.jpg', 0),
(51, 15, '', '4k_15.jpg', 0),
(52, 15, '', 'NCLdctC_15.jpg', 0),
(53, 16, '', '4k_16.jpg', 0),
(54, 17, '', '4k_17.jpg', 0),
(55, 17, '', 'NCLdctC_17.jpg', 0),
(56, 18, '', '4k_18.jpg', 1),
(57, 18, '', 'NCLdctC_18.jpg', 2),
(58, 19, '', '4k_19.jpg', 0),
(59, 19, '', 'NCLdctC_19.jpg', 0),
(60, 20, '', '4k_20.jpg', 1),
(61, 20, '', 'NCLdctC_20.jpg', 2),
(62, 21, '', '4k_21.jpg', 0),
(63, 22, '', '4k_22.jpg', 1),
(64, 22, '', 'NCLdctC_22.jpg', 2),
(65, 23, '6b4.jpg', '6b4_23.jpg', 1),
(66, 23, 'sword-art-online-201601228.jpg', 'sword-art-online-201601228_23.jpg', 1),
(67, 24, '', 'sword-art-online-201601228_24.jpg', 0),
(68, 25, '6b4.jpg', '6b4_25.jpg', 1),
(69, 25, 'sword-art-online-201601228.jpg', 'sword-art-online-201601228_25.jpg', 2);

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

--
-- Gegevens worden geëxporteerd voor tabel `mail`
--

INSERT INTO `mail` (`id`, `onderwerp`, `verstuurder`, `beschrijving`, `naam`, `email`, `key`, `answer`, `datum`, `verified`) VALUES
(1, 'jef', 'Gijs van den Abeele', 'tef', 'Jeffrey', 'valckxj@outlook.com', '307a9b0f43132ed13355ce742cd11746', '', '2016-10-10', 0),
(2, 'jef', 'Gijs van den Abeele', 'tef', 'Jeffrey', 'valckxj@outlook.com', 'f20311cf54667c53f0510731409426a1', '', '2016-10-10', 0),
(3, 'jef', 'Gijs van den Abeele', 'tef', 'Jeffrey', 'valckxj@outlook.com', '829f03e695f276edeaae4e0f541b7341', '', '2016-10-10', 0),
(4, 'Nieuwe test', 'Gijs van den Abeele', 'mm', 'Jeffrey', 'valckxj@outlook.com', '6bb3cef6a14ac19fbc9cb3fee88c9387', '', '2016-10-10', 0),
(5, 'MHAHAHA', 'Gijs van den Abeele', 'haha', 'Jeffrey', 'valckxj@outlook.com', '52e07617cf1f0a6ac33c6f14b726ea9e', '', '2016-10-10', 0),
(6, 'MHAHAHA', 'Gijs van den Abeele', 'haha', 'Jeffrey', 'valckxj@outlook.com', 'e64607f36b83d22ac673c9ff19d999ed', '', '2016-10-10', 0),
(7, 'MHAHAHA', 'Gijs van den Abeele', 'haha', 'Jeffrey', 'valckxj@outlook.com', '7a47c74ccb4d7aed881a2e24824dd9bb', '', '2016-10-10', 0),
(8, 'NU DAN UGH', 'Gijs van den Abeele', 'ehehehehehe', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'b381841aa5df029b9bb50ed4619bf1c6', '', '2016-10-10', 1),
(9, 'another one', 'Gijs van den Abeele', 'LOOK AT IT', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'a282921703187ee179494a33d93f6d00', '', '2016-10-10', 1),
(10, 'I PRAY PREASE', 'Gijs van den Abeele', 'PE LE EASE', 'Jeffrey', 'valckxj@outlook.com', '2c4735d5c1b405a549064ccb0d55d7ff', '', '2016-10-11', 0),
(11, 'I PRAY PREASE', 'Gijs van den Abeele', 'PE LE EASE', 'Jeffrey', 'valckxj@outlook.com', 'd9991b67552f320f040f15a2b8506c71', '', '2016-10-11', 0),
(12, 'fsd', 'Gijs van den Abeele', 'test', 'Jeffrey', 'valckxj@outlook.com', 'c1f69d3204c54ac58eb770c32b6188b3', '', '2016-10-11', 0),
(13, 'Stupid boy', 'Gijs van den Abeele', 'hello', 'Jeffrey', 'valckxj@outlook.com', 'c71a720bda4343417d056ba352bd8ccd', '', '2016-10-12', 0),
(14, 'Stupid boy', 'Gijs van den Abeele', 'hello', 'Jeffrey', 'valckxj@outlook.com', '5b40309763e8d46367f182b14f483643', '', '2016-10-12', 0),
(15, 'Stupid boy', 'Gijs van den Abeele', 'hello', 'Jeffrey', 'kevin.herdershof@hotmail.com', '9063ea6bb1ebb3bc8146cf75998c82e2', '', '2016-10-12', 1),
(16, 'j', 'Gijs van den Abeele', 'hu', 'Jeffrey', 'gijsvdabeele@gmail.com', '752af5d61fe4525f6559d2381d441383', '', '2016-10-13', 0),
(17, 'New Kids : Turbo', 'Gijs van den Abeele', 'JONGE', 'Jeffrey', 'gijsvdabeele@gmail.com', '76bd9b616db81207dcd14288031db914', '', '2016-10-13', 0),
(18, 'Gijs jonge', 'Gijs van den Abeele', 'godddd', 'Jeffrey', 'kevin.herdershof@hotmail.com', '8971a236df95b01eeab4bf34d2902e3e', 'dit is een test', '2016-10-13', 1),
(19, 'test', 'Gijs van den Abeele', 'wew', 'Jeffrey', 'gijsvdabeele@gmail.com', '5e0bdb0bf94b2e5b7b872d5d58588d39', '', '2016-10-14', 0),
(20, 'Dangit gijs', 'Gijs van den Abeele', 'tss', 'Jeffrey', 'kevin.herdershof@hotmail.com', '106e8f3db1d81dfb6dbbc6bf33e7b51b', '', '2016-10-14', 1),
(21, 'Test', 'Gijs van den Abeele', 'afsd', 'Jeffrey', 'kevin.herdershof@hotmail.com', '81baa77f63675e4673eaf31466e256b6', '', '2016-10-14', 1),
(22, 'Tester', 'Gijs van den Abeele', 'vg', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'a26d505e6ce536b9136a2a9ed993eb2b', '', '2016-10-17', 1),
(23, 'ugh', 'Gijs van den Abeele', 'test', 'Jeffrey', 'kevin.herdershof@hotmail.com', '18102016-11.10.33-192.08.1.124', 'Het is allemaal goed hoor!', '2016-10-17', 2),
(24, 'hg', 'Gijs van den Abeele', 'hg', 'Jeffrey', 'kevin.herdershof@hotmail.com', '4e94b7ab0309260589ed0aadfb3d815d', '', '2016-10-17', 1),
(25, 'trestst', 'Gijs van den Abeele', 'beteer', 'Jeffrey', 'kevin.herdershof@hotmail.com', '24e5e77c2175ac216be7799e70582d6f', '', '2016-10-17', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `usermail`
--

CREATE TABLE `usermail` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `mailid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `usermail`
--

INSERT INTO `usermail` (`id`, `userid`, `mailid`) VALUES
(2, 12, 23),
(3, 12, 23);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(7, '', '', 'd243da637503b04f6aeb432a774fb99b'),
(8, 'kevin', 'kevin.herdershof@hotmail.com', 'd243da637503b04f6aeb432a774fb99b'),
(10, 'jef', 'valckxj@outlook.com', '6a27f10aef159701c7a5ff07f0fb0a78'),
(11, 'kevin', 'hoi@hoi.nl', '60474c9c10d7142b7508ce7a50acf414'),
(12, 'kevin', 'hey@hotmail.com', 'd243da637503b04f6aeb432a774fb99b'),
(13, 'Kevin', 'hey@hoi.nl', '60474c9c10d7142b7508ce7a50acf414');

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
-- AUTO_INCREMENT voor een tabel `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT voor een tabel `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT voor een tabel `usermail`
--
ALTER TABLE `usermail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
