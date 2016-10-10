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
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
