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
  `imgname` varchar(64) NOT NULL,
  `uniquename` varchar(64) NOT NULL,
  `datum` date NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `mail`
--

INSERT INTO `mail` (`id`, `onderwerp`, `verstuurder`, `beschrijving`, `naam`, `email`, `key`, `imgname`, `uniquename`, `datum`, `verified`) VALUES
(1, 'Stage', 'Gijs', 'test', 'Kevin', 'kevin.herdershof@hotmail.com', '9fe5cfcf06b5989643eaf0ccf64adc26', '', '', '0000-00-00', 0),
(2, 'Stage', 'Gijs', 'test', 'Kevin', 'kevin.herdershof@hotmail.com', '79f5db84afd1dc8d8c68c8483cddeb29', '', '../app/uploads/4k.jpg', '0000-00-00', 0),
(3, 'Stage', 'Gijs', 'test', 'Kevin', 'kevin.herdershof@hotmail.com', '78290be0a75ed8e0cec50a7ccce3f059', '', '../app/uploads/4k.jpg, ../app/uploads/NCLdctC.jpg', '0000-00-00', 0),
(4, 'Stage', 'Gijs', 'test', 'Kevin', 'kevin.herdershof@hotmail.com', '0d99ff8d22f8b2a3450b1de465c10bd6', '', '../app/uploads/NCLdctC.jpg', '0000-00-00', 0),
(5, 'Stage', 'Jeffrey', 'Hoe gaat het?', 'Kevin', 'kevin.herdershof@hotmail.com', '88c54ba7eedd7a64f5b817a91e592e3f', '', '../app/uploads/4k.jpg', '0000-00-00', 0),
(6, 'School', 'Gijs', 'wanner?', 'kef', 'kevin.herdershof@hotmail.com', 'f212f4fc7fed940b767d280c7b0a8160', '', '../app/uploads/NCLdctC.jpg', '0000-00-00', 1),
(7, 'School', 'Gijs', 'wanneer is dit project af?', 'Kevin', 'kevin.herdershof@hotmail.com', '8d3e828fa33be07153b995f07c9629f9', '', '../app/uploads/4k.jpg, ../app/uploads/NCLdctC.jpg', '0000-00-00', 1),
(8, 'tef', 'Jef', 'hef', 'kef', 'kevin.herdershof@hotmail.com', '9b97db2007b74735f7c5cee67355369b', 'NCLdctC.jpg', 'NCLdctC.jpg', '0000-00-00', 0),
(9, 'tester', 'Test', 'exra test', 'Kevin', 'kevin.herdershof@hotmail.com', '94d7e860f12925ad9996c6bdf052ce9f', '4k.jpg', '4k.jpg', '2016-10-05', 1),
(10, 'jef', 'tef', 'kef', 'lef', 'kevin.herdershof@hotmail.com', '2f15f0c23f554a114c8116131e89a53f', '4k.jpg, NCLdctC.jpg', 'Array', '2016-10-05', 0),
(11, 'jef', 'tef', 'kef', 'lef', 'kevin.herdershof@hotmail.com', 'e908bcb5a62dc17f87295ab4dbdd1d37', '4k.jpg, NCLdctC.jpg', '4k_11.jpg, NCLdctC_11.jpg', '2016-10-05', 0),
(12, 'jef', 'tef', 'kef', 'lef', 'kevin.herdershof@hotmail.com', 'fcbb380f8734c262c223f563c5c14cb7', 'NCLdctC.jpg', 'NCLdctC_12.jpg', '2016-10-05', 1),
(13, 'Virtual Reality', 'Dylan', 'BAM! Jonge', 'Kevin Ernst', 'kevin.herdershof@hotmail.com', '220fe692021d3ef54f54c9657b9213e4', '4k.jpg, NCLdctC.jpg', '4k_13.jpg, NCLdctC_13.jpg', '2016-10-05', 1),
(14, 'Muis', 'Jeffrey', 'DUMDMMMDMM', 'Kevin', 'kevin.herdershof@hotmail.com', '246b0f946216f7ff3e23b2171a1734ab', 'sword-art-online-201601228.jpg', 'sword-art-online-201601228_14.jpg', '2016-10-05', 1),
(15, 'Test', 'Gijs', 'Party friend', 'Kevi', 'kevin.herdershof@hotmail.com', '759af743aa8b1df83b455f32c195c583', 'Hatsune3.png', 'Hatsune3_15.png', '2016-10-05', 0),
(16, 'Test', 'Gijs', 'Kangaroo biches', 'Kevin', 'kevin.herdershof@hotmail.com', 'accc2129565d255194a63d21cc47aeb0', 'Kangaroo-in-Sunset-photos.jpg', 'Kangaroo-in-Sunset-photos_16.jpg', '2016-10-05', 0),
(17, 'Test', 'Gijs', 'Omnomnom', 'Kevin', 'kevin.herdershof@hotmail.com', '5962ae0fbaf6564a1ecb75cc19b61b1f', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', '131Lapras_Pokemon_Mystery_Dungeon_Explorers_of_Time_and_Darkness', '2016-10-05', 1),
(18, 'Test', 'Davy', 'ladaa', 'Kevin', 'kevin.herdershof@hotmail.com', 'c7bb81929dc35d0609b2eb891d3d5087', 'saomusicmodpic.jpg', 'saomusicmodpic_18.jpg', '2016-10-05', 1);

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
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
