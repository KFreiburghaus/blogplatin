-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Jun 2019 um 00:31
-- Server-Version: 10.1.37-MariaDB
-- PHP-Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `blogplatin`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blog`
--

CREATE TABLE `blog` (
  `bid` int(11) NOT NULL,
  `text` varchar(1500) NOT NULL,
  `user` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `blog`
--

INSERT INTO `blog` (`bid`, `text`, `user`, `created`) VALUES
(1, 'dasdas dasdas', 1, '2019-06-03 12:54:56'),
(2, 'hallo zusammen', 1, '2019-06-03 13:35:05');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comment`
--

CREATE TABLE `comment` (
  `cid` int(11) NOT NULL,
  `text` varchar(1500) NOT NULL,
  `blog` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `comment`
--

INSERT INTO `comment` (`cid`, `text`, `blog`, `user`, `created`) VALUES
(1, 'fsdfsd', 1, 1, '2019-06-03 13:32:24'),
(2, 'fsadfsa', 1, 1, '2019-06-03 13:48:58'),
(3, 'fdsfs', 2, 1, '2019-06-03 16:26:06'),
(4, 'test', 2, 1, '2019-06-03 16:46:03'),
(5, 'fsdfas', 1, 1, '2019-06-03 16:46:16'),
(6, 'dasdas', 2, 1, '2019-06-03 16:47:04'),
(7, 'daniel', 1, 1, '2019-06-03 16:47:09'),
(8, 'hallo', 1, 1, '2019-06-03 16:54:37'),
(9, 'asfdas', 1, 1, '2019-06-06 21:58:02');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `like_blog`
--

CREATE TABLE `like_blog` (
  `lbid` int(11) NOT NULL,
  `liked_disliked` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `blog` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `like_blog`
--

INSERT INTO `like_blog` (`lbid`, `liked_disliked`, `user`, `blog`, `created`) VALUES
(61, 1, 1, 2, '2019-06-06 20:32:31'),
(72, 1, 1, 1, '2019-06-06 21:29:43');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `created`) VALUES
(1, 'danieltrifunovic', 'daniel.trifunovic@hotmail.com', 'hallo12', '2019-06-02 11:42:57');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `user` (`user`);

--
-- Indizes für die Tabelle `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `user` (`user`),
  ADD KEY `blog` (`blog`);

--
-- Indizes für die Tabelle `like_blog`
--
ALTER TABLE `like_blog`
  ADD PRIMARY KEY (`lbid`),
  ADD KEY `blog` (`blog`),
  ADD KEY `liked_disliked` (`liked_disliked`),
  ADD KEY `user` (`user`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `blog`
--
ALTER TABLE `blog`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `comment`
--
ALTER TABLE `comment`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `like_blog`
--
ALTER TABLE `like_blog`
  MODIFY `lbid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`blog`) REFERENCES `blog` (`bid`);

--
-- Constraints der Tabelle `like_blog`
--
ALTER TABLE `like_blog`
  ADD CONSTRAINT `like_blog_ibfk_1` FOREIGN KEY (`blog`) REFERENCES `blog` (`bid`),
  ADD CONSTRAINT `like_blog_ibfk_3` FOREIGN KEY (`user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
