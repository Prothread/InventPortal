-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 okt 2016 om 10:56
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
-- Tabelstructuur voor tabel `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `paswoord` varchar(256) NOT NULL,
  `bedrijfsnaam` varchar(64) NOT NULL,
  `adres` varchar(64) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `plaats` varchar(64) NOT NULL,
  `permgroup` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `clients`
--

INSERT INTO `clients` (`id`, `naam`, `email`, `paswoord`, `bedrijfsnaam`, `adres`, `postcode`, `plaats`, `permgroup`) VALUES
(1, 'Dylan', 'Dylan', '', 'Madalco', 'Invent ICT', '4829AF', 'Terneuzen', 1),
(2, 'test', 'test', '', 'nogwta', 'wefjsakl', 'fdsa9as', 'test', 1),
(3, 'Dylan', 'nogeenker@invent-ict.nl', '', 'Invent', 'Veilenlaan 2', '4292ba', 'Terneuzen', 1),
(4, 'test', 'ditiseentest@gmail.com', '', 'nogwta', 'wefjsakl', 'fdsa9as', 'test', 1),
(6, 'jfsi', 'fs@hoi.nl', 'd9ff39430e47208f5b12e6901d9fd830', 'jfais', 'freestylers', '32802', 'KEOwacht', 1),
(7, 'prank gaat fout', 'test@hoi.nl', 'f1d934443b7a7faaf6b07a57d494ade5', 'test', 'fsda', 'fsd', 'fsda', 1),
(8, 'prank gaat fout', 'test1@hoi.nl', '5cd6891c6904348dc268370e405f0d2f', 'test', 'fsda', 'fsd', 'fsda', 1),
(9, 'Kevin', 'kevin@hoi.nl', 'f7e843dbd31d37a8485af3017fec5085', 'test', 'test', 'test', 'dsfa', 1),
(11, 'Jef', 'kevin@hotmail.com', '0a5f7eb4a036adf966615a0182dcb0a9', 'Invent', 'nieuwe karnemelkstraat 27', '4576BT', 'koewacht', 1),
(12, 'test', 'kevi@hotmail.com', 'cb3595ef74b19f5cceaa310f1424d3f5', 'test', 'nieuwe karnemelkstraat 27', '4576BT', 'koewacht', 1),
(13, 'Kevin', 'keffiedebass12x@live.nl', 'edada7de4356ec9e9f4a9f70cd5b02aaaa9fa114dd50bc6e6707cb7626568fef', 'Invent test', 'Testlaan 5', '3284BD', 'Terneuzen', 1),
(15, 'Kevin', 'testingemail@hotmail.com', '81dc54b41d50d3e415ead89466d260a36f0d2c0c8ad801eb339c91e60c87acde', 'Invent', 'nieuwe karnemelkstraat 27', '4576BT', 'koewacht', 1),
(17, 'Klant', 'kevin.herdershof@hotmail.com', '82685ff0082733179251692c041abdd343029189e7ba6661287f295852595a83', 'klant bv', 'nieuwe karnemelkstraat 27', '4576BT', 'koewacht', 1);

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
(1, 1, '', '6b4_1.jpg', 3),
(2, 1, '', 'sword-art-online-201601228_1.jpg', 3),
(3, 2, '', '6b4_2.jpg', 0),
(4, 2, '', 'sword-art-online-201601228_2.jpg', 3),
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
(43, 10, '', '', 3),
(44, 11, '', '', 3),
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
(69, 25, 'sword-art-online-201601228.jpg', 'sword-art-online-201601228_25.jpg', 2),
(70, 26, '6b4.jpg', '6b4_26.jpg', 0),
(71, 27, 'failfive.png', 'failfive_27.png', 0),
(72, 28, 'failfive.png', 'failfive_28.png', 0),
(73, 29, '6b4.jpg', '6b4_29.jpg', 0),
(74, 30, '6b4.jpg, failfive.png, sword-art-online-201601228.jpg', '6b4_30.jpg', 1),
(75, 30, '6b4.jpg, failfive.png, sword-art-online-201601228.jpg', 'failfive_30.png', 1),
(76, 30, '6b4.jpg, failfive.png, sword-art-online-201601228.jpg', 'sword-art-online-201601228_30.jpg', 1),
(77, 31, '6b4.jpg, failfive.png', '6b4_31.jpg', 0),
(78, 31, '6b4.jpg, failfive.png', 'failfive_31.png', 0),
(79, 32, '', '', 0),
(80, 33, '6b4.jpg, failfive.png, sword-art-online-201601228.jpg', '6b4_33.jpg', 0),
(81, 33, '6b4.jpg, failfive.png, sword-art-online-201601228.jpg', 'failfive_33.png', 0),
(82, 33, '6b4.jpg, failfive.png, sword-art-online-201601228.jpg', 'sword-art-online-201601228_33.jpg', 0),
(83, 34, '6b4.jpg, failfive.png, sword-art-online-201601228.jpg', '6b4_34.jpg', 0),
(84, 34, '6b4.jpg, failfive.png, sword-art-online-201601228.jpg', 'failfive_34.png', 0),
(85, 34, '6b4.jpg, failfive.png, sword-art-online-201601228.jpg', 'sword-art-online-201601228_34.jpg', 0),
(86, 35, '005_charmeleon_by_rayo123000-d8mriq9.png, 131Lapras_Pokemon_Myst', '005_charmeleon_by_rayo123000-d8mriq9_35.png', 0),
(87, 35, '005_charmeleon_by_rayo123000-d8mriq9.png, 131Lapras_Pokemon_Myst', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(88, 35, '005_charmeleon_by_rayo123000-d8mriq9.png, 131Lapras_Pokemon_Myst', 'Celeste0502-image-celeste0502-36795437-1200-960_35.jpg', 0),
(89, 36, '005_charmeleon_by_rayo123000-d8mriq9.png, 131Lapras_Pokemon_Myst', '005_charmeleon_by_rayo123000-d8mriq9_36.png', 0),
(90, 36, '005_charmeleon_by_rayo123000-d8mriq9.png, 131Lapras_Pokemon_Myst', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(91, 36, '005_charmeleon_by_rayo123000-d8mriq9.png, 131Lapras_Pokemon_Myst', 'Celeste0502-image-celeste0502-36795437-1200-960_36.jpg', 0),
(92, 37, '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(93, 37, 'Celeste0502-image-celeste0502-36795437-1200-960_37.jpg', 'Celeste0502-image-celeste0502-36795437-1200-960_37.jpg', 0),
(94, 37, 'Goodra_37.jpg', 'Goodra_37.jpg', 0),
(95, 38, '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(96, 38, 'Celeste0502-image-celeste0502-36795437-1200-960_38.jpg', 'Celeste0502-image-celeste0502-36795437-1200-960_38.jpg', 0),
(97, 38, 'Goodra_38.jpg', 'Goodra_38.jpg', 0),
(98, 39, '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(99, 39, 'Celeste0502-image-celeste0502-36795437-1200-960_39.jpg', 'Celeste0502-image-celeste0502-36795437-1200-960_39.jpg', 0),
(100, 39, 'Goodra_39.jpg', 'Goodra_39.jpg', 0),
(101, 40, '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(102, 40, 'Celeste0502-image-celeste0502-36795437-1200-960_40.jpg', 'Celeste0502-image-celeste0502-36795437-1200-960_40.jpg', 0),
(103, 40, 'Goodra_40.jpg', 'Goodra_40.jpg', 0),
(104, 41, '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(105, 41, 'Celeste0502-image-celeste0502-36795437-1200-960_41.jpg', 'Celeste0502-image-celeste0502-36795437-1200-960_41.jpg', 0),
(106, 41, 'Goodra_41.jpg', 'Goodra_41.jpg', 0),
(107, 42, '005_charmeleon_by_rayo123000-d8mriq9.png', '005_charmeleon_by_rayo123000-d8mriq9_42.png', 0),
(108, 42, '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', 0),
(109, 42, 'Celeste0502-image-celeste0502-36795437-1200-960.jpg', 'Celeste0502-image-celeste0502-36795437-1200-960_42.jpg', 0),
(110, 42, 'Goodra.jpg', 'Goodra_42.jpg', 0),
(111, 43, '2fc5229b52aa228de5931ad4a6fc3e7a.png', '2fc5229b52aa228de5931ad4a6fc3e7a_43.png', 1),
(112, 43, '83900a5b6d403ddbfd4e843ea70828f4.jpg', '83900a5b6d403ddbfd4e843ea70828f4_43.jpg', 3),
(113, 43, 'Logo_TV_2015.png', 'Logo_TV_2015_43.png', 1),
(114, 44, '2fc5229b52aa228de5931ad4a6fc3e7a - kopie.png', '2fc5229b52aa228de5931ad4a6fc3e7a - kopie_44.png', 1),
(115, 44, '2fc5229b52aa228de5931ad4a6fc3e7a.png', '2fc5229b52aa228de5931ad4a6fc3e7a_44.png', 3),
(116, 44, '83900a5b6d403ddbfd4e843ea70828f4.jpg', '83900a5b6d403ddbfd4e843ea70828f4_44.jpg', 1),
(117, 0, 'Logo_TV_2015.png', 'Logo_TV_2015_44.png', 0),
(118, 0, 'Logo_TV_2015.png', 'Logo_TV_2015_44.png', 0),
(119, 0, 'Logo_TV_2015.png', 'Logo_TV_2015_44.png', 0),
(120, 0, 'Logo_TV_2015.png', 'Logo_TV_2015_44.png', 0),
(121, 0, 'Logo_TV_2015.png', 'Logo_TV_2015_44.png', 0),
(122, 0, 'Vanamo_Logo.png', 'Vanamo_Logo_44.png', 0),
(123, 0, 'Logo_TV_2015.png', 'Logo_TV_2015_44.png', 0),
(124, 44, 'xbox-logo_318-53731.jpg', 'xbox-logo_318-53731_44.jpg', 0),
(125, 44, 'Vanamo_Logo.png', 'Vanamo_Logo_44.png', 0),
(126, 45, 'Vanamo_Logo.png', 'Vanamo_Logo_45.png', 0),
(127, 45, 'xbox-logo_318-53731.jpg', 'xbox-logo_318-53731_45.jpg', 0),
(128, 43, 'Vanamo_Logo.png', 'Vanamo_Logo_43.png', 0);

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
(25, 'trestst', 'Gijs van den Abeele', 'beteer', 'Jeffrey', 'kevin.herdershof@hotmail.com', '24e5e77c2175ac216be7799e70582d6f', '', '2016-10-17', 1),
(26, 'tes', 'Gijs van den Abeele', 'fdsa', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'a93711aa230a485a6056151272d270a0', '', '2016-10-19', 1),
(27, 'another', 'Gijs van den Abeele', 'one', 'Jeffrey', 'kevin.herdershof@hotmail.com', '0c1b8ceeb6ae1028a8aea7b84efc3ba9', '', '2016-10-19', 1),
(28, 'hb', 'Gijs van den Abeele', 'bkh', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'hfsdkhgasd', '', '2016-10-19', 1),
(29, 'dit is een upload', 'Gijs van den Abeele', 'asdf', 'Jeffrey', 'kevin.herdershof@hotmail.com', '9bb990e07ca10ac6c9028631d6409f4d', '', '2016-10-19', 1),
(30, 'Test meerdere uploads', 'Gijs van den Abeele', 'test', 'Jeffrey', 'kevin.herdershof@hotmail.com', '20102016-8.47.24-192.08.1.124', 'Is goed hoor!', '2016-10-20', 2),
(31, 'prank gaat fout', 'Gijs van den Abeele', 'fsa', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'f0b7c3d454a45ee1b7978a88f85283ff', '', '2016-10-20', 1),
(32, 'test', 'Gijs van den Abeele', 'Fix error', 'Jeffrey', 'kevin.herdershof@hotmail.com', '367a7fbfa78bec775c6d84dfada30f5d', '', '2016-10-20', 1),
(33, 'Fix error', 'Gijs van den Abeele', 'mate', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'ae3ca26a5d1076ae187f5389a127bdfa', '', '2016-10-20', 1),
(34, 'tes', 'Gijs van den Abeele', 'fsad', 'Jeffrey', 'kevin.herdershof@hotmail.com', '4519f27ea41995c004512cc897bd4f3d', '', '2016-10-20', 1),
(35, 'fsda', 'Gijs van den Abeele', 'fasd', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'ca3dc0ad3d2db2121f56bc59eefe54f1', '', '2016-10-20', 0),
(36, 'fsda', 'Gijs van den Abeele', 'fasd', 'Jeffrey', 'kevin.herdershof@hotmail.com', '81973a76dde975903ea55459bdc2dfb1', '', '2016-10-20', 1),
(37, 'fsda', 'Gijs van den Abeele', 'test', 'Jeffrey', 'kevin.herdershof@hotmail.com', '47b0d4424b9fc01fbdc3f25599f165cd', '', '2016-10-20', 1),
(38, 'fsda', 'Gijs van den Abeele', 'test', 'Jeffrey', 'kevin.herdershof@hotmail.com', '531372162f90b6305ea0594f90877fc8', '', '2016-10-20', 0),
(39, 'fsda', 'Gijs van den Abeele', 'test', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'f49d22dd8d582d2054419c8b93e094a6', '', '2016-10-20', 0),
(40, 'fsda', 'Gijs van den Abeele', 'test', 'Jeffrey', 'kevin.herdershof@hotmail.com', '8a87dde993f601807bc8f8d938aa510c', '', '2016-10-20', 0),
(41, 'fsda', 'Gijs van den Abeele', 'test', 'Jeffrey', 'kevin.herdershof@hotmail.com', '2951f4277fda84ed4bc4376613f8ebdf', '', '2016-10-20', 0),
(42, 'test', 'Gijs van den Abeele', 'fsad', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'b4d4dab3e957b7572ddb614aba574c3d', '', '2016-10-21', 1),
(43, 'Proef producten', 'Gijs van den Abeele', 'Dit zijn de proefproducten!', 'Jeffrey', 'kevin.herdershof@hotmail.com', '12d6e88723c40afd95854e39bfa0542b', 'Het fanta logo mag wel anders', '2016-10-24', 0),
(44, 'voorbeeld5', 'Gijs van den Abeele', 'Dit is een voorbeeld', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'c3b453e58d33aae5dce81a7f52bf5810', 'hi', '2016-10-24', 0),
(45, 'Gijs', 'Gijs van den Abeele', 'agh im back', 'Jeffrey', 'kevin.herdershof@hotmail.com', 'ef1ddf58783369b01d1998714fa50b8d', '', '2016-10-24', 0);

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
('CAN_SHOW_HOME', 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `usermail`
--

CREATE TABLE `usermail` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `mailid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `usermail`
--

INSERT INTO `usermail` (`id`, `userid`, `clientid`, `mailid`) VALUES
(2, 12, 0, 23),
(3, 12, 0, 23),
(4, 18, 0, 30),
(5, 18, 0, 43),
(6, 20, 0, 44);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(256) NOT NULL,
  `permgroup` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `permgroup`) VALUES
(7, '', '', 'd243da637503b04f6aeb432a774fb99b', 2),
(10, 'jef', 'valckxj@outlook.com', '6a27f10aef159701c7a5ff07f0fb0a78', 2),
(11, 'He', 'hoi@hoi.nl', '60474c9c10d7142b7508ce7a50acf414', 2),
(12, 'kevin', 'hey@hotmail.com', 'd243da637503b04f6aeb432a774fb99b', 2),
(13, 'Kevin', 'hey@hoi.nl', '60474c9c10d7142b7508ce7a50acf414', 2),
(15, 'Ed ONeil', 'hey@heyy.nl', 'a98ec5c5044800c88e862f007b98d89815fc40ca', 2),
(16, 'Kevin', 'kef@hotmail.com', '60474c9c10d7142b7508ce7a50acf414', 2),
(17, 'kef', 'keffer@test.nl', 'ecd71870d1963316a97e3ac3408c9835ad8cf0f3', 2),
(18, 'keffer', 'keffie@hotmail.com', 'a98ec5c5044800c88e862f007b98d89815fc40ca155d6ce7909530d792e909ce', 2),
(20, 'Kevin', 'kevin.herdershof@hotmail.com', 'a98ec5c5044800c88e862f007b98d89815fc40ca155d6ce7909530d792e909ce', 2);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
-- AUTO_INCREMENT voor een tabel `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT voor een tabel `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT voor een tabel `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT voor een tabel `usermail`
--
ALTER TABLE `usermail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
