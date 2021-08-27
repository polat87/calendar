-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Aug 2021 um 12:24
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `terminkalender`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `termine`
--

CREATE TABLE `termine` (
  `TNR` int(10) UNSIGNED NOT NULL,
  `Datum` date NOT NULL,
  `Uhrzeit` time NOT NULL,
  `Beschreibung` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `termine`
--

INSERT INTO `termine` (`TNR`, `Datum`, `Uhrzeit`, `Beschreibung`) VALUES
(52, '2021-08-31', '23:00:00', 'Party Hochzeit'),
(59, '2021-10-15', '14:25:00', 'Autowerkstatt'),
(60, '2021-06-30', '10:38:00', 'Lidl'),
(71, '2021-07-30', '11:23:00', 'Projektabgabe'),
(72, '2021-09-06', '14:12:00', 'Buergeramt'),
(77, '2021-08-20', '08:33:00', 'Autoreifen wechseln'),
(78, '2021-08-20', '15:25:00', 'Klinik'),
(80, '2021-08-15', '16:34:00', 'Corona-Test'),
(83, '2021-08-22', '11:27:00', 'Zahnarzt'),
(86, '2021-08-26', '14:01:00', 'Reparatur'),
(87, '2021-08-28', '14:40:00', 'Theater'),
(91, '2021-07-30', '15:31:00', 'Tierarzt'),
(107, '2021-08-02', '12:12:00', 'Kaufland'),
(110, '2021-08-10', '14:18:00', 'Hautarzt'),
(114, '2021-07-27', '13:24:00', 'Zahnarzt'),
(118, '2021-08-09', '15:34:00', 'schule'),
(122, '2021-08-14', '11:00:00', 'PrÃ¼fung'),
(130, '2021-08-06', '10:13:00', 'Hautarzt'),
(139, '2021-08-12', '16:27:00', 'Untersuchung'),
(143, '2021-08-15', '09:03:00', 'Hautarzt'),
(144, '2021-08-02', '06:07:00', 'Urlaub'),
(151, '2021-08-06', '10:34:00', 'Reparatur'),
(152, '2021-08-20', '09:26:00', 'Corona-Test'),
(155, '2021-09-16', '16:17:00', 'Feier Geburtstag');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `termine`
--
ALTER TABLE `termine`
  ADD PRIMARY KEY (`TNR`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `termine`
--
ALTER TABLE `termine`
  MODIFY `TNR` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
