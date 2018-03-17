-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Ago 02, 2013 alle 18:29
-- Versione del server: 5.5.32
-- Versione PHP: 5.3.10-1ubuntu3.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db-italfrutta`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `autista`
--

CREATE TABLE IF NOT EXISTS `autista` (
  `CodAut` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Nome` char(20) COLLATE utf8_roman_ci NOT NULL,
  `Cognome` char(20) COLLATE utf8_roman_ci NOT NULL,
  `Telefono1` char(15) COLLATE utf8_roman_ci NOT NULL,
  `Telefono2` char(15) COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodAut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `CodCliente` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `NomeCliente` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`CodCliente`, `NomeCliente`) VALUES
(001, 'BENNET TURATE'),
(002, 'NORDCONAD MO'),
(003, 'BOSCOLO TV');

-- --------------------------------------------------------

--
-- Struttura della tabella `imballo`
--

CREATE TABLE IF NOT EXISTS `imballo` (
  `CodImb` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `TipoImballo` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodImb`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `imballo`
--

INSERT INTO `imballo` (`CodImb`, `TipoImballo`) VALUES
(001, 'T32'),
(002, 'T31'),
(003, 'BCPR'),
(004, 'T27');

-- --------------------------------------------------------

--
-- Struttura della tabella `lavorazione`
--

CREATE TABLE IF NOT EXISTS `lavorazione` (
  `CodLav` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `TipoLav` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodLav`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `lavorazione`
--

INSERT INTO `lavorazione` (`CodLav`, `TipoLav`) VALUES
(001, 'SFUSO'),
(002, 'NASTRATO'),
(003, 'ALVEOLO'),
(004, 'A. Q.');

-- --------------------------------------------------------

--
-- Struttura della tabella `nomeprod`
--

CREATE TABLE IF NOT EXISTS `nomeprod` (
  `CodNP` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `NomeProd` char(20) COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodNP`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `nomeprod`
--

INSERT INTO `nomeprod` (`CodNP`, `NomeProd`) VALUES
(001, 'CRIMSON'),
(002, 'MEL RETATO'),
(003, 'MEL FILIERA');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE IF NOT EXISTS `ordine` (
  `CodOrd` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Codice` int(3) unsigned zerofill NOT NULL,
  `Commenti` char(30) COLLATE utf8_roman_ci DEFAULT NULL,
  `FP` tinytext COLLATE utf8_roman_ci,
  `data` date NOT NULL,
  `OraPartenza` tinytext COLLATE utf8_roman_ci NOT NULL,
  `Modificato` tinyint(1) DEFAULT '0',
  `CodCliente` tinyint(3) unsigned zerofill NOT NULL,
  PRIMARY KEY (`CodOrd`),
  KEY `ordine_ibfk_1` (`CodCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=37 ;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`CodOrd`, `Codice`, `Commenti`, `FP`, `data`, `OraPartenza`, `Modificato`, `CodCliente`) VALUES
(0000000003, 324, 'commenti', 'X', '1970-01-01', '06:30', 0, 002),
(0000000014, 2342, 'commenti', 'X', '1970-01-01', '20:30', 0, 003),
(0000000015, 12334, 'commenti', 'X', '1970-01-01', '04:30', 0, 003),
(0000000016, 567, 'commenti', 'X', '1970-01-01', '17:00', 0, 003),
(0000000017, 3245, 'commenti', 'X', '1970-01-01', '16:00', 0, 003),
(0000000018, 32423, 'c', 'X', '1970-01-01', '06:30', 0, 003),
(0000000019, 876, 'commenti', 'X', '1970-01-01', '22:00', 0, 002),
(0000000020, 673, 'commenti', 'x', '1970-01-01', '16:00', 0, 001),
(0000000021, 298, 'commenti', 'x', '1970-01-01', '15:30', 0, 001),
(0000000022, 908, 'commenti', 'X', '1970-01-01', '17:30', 0, 003),
(0000000023, 3454, 'commenti', 'X', '1970-01-01', '07:30', 0, 001),
(0000000024, 563, 'commenti', 'x', '1970-01-01', '08:30', 0, 001),
(0000000025, 234, 'commenti', 'X', '1970-01-01', '02:00', 0, 001),
(0000000026, 324, 'commenti', 'X', '1970-01-01', '01:00', 0, 003),
(0000000027, 3454, 'commenti', '', '1970-01-01', '04:30', 0, 003),
(0000000028, 3454, 'commenti', 'x', '1970-01-01', '02:30', 0, 001),
(0000000029, 5632, 'commenti', 'X', '1970-01-01', '03:00', 0, 003),
(0000000030, 3454, 'commenti', '', '1970-01-01', '08:00', 0, 003),
(0000000031, 673, 'commenti', '', '1970-01-01', '04:00', 0, 001),
(0000000032, 2342, 'commenti', '', '1970-01-01', '08:30', 0, 001),
(0000000033, 2342, 'commenti', 'x', '1970-01-01', '08:30', 0, 003),
(0000000034, 345, 'commenti', '', '1970-01-01', '09:00', 0, 002),
(0000000035, 673, 'commenti', 'X', '1970-01-01', '09:00', 0, 002),
(0000000036, 4353, 'commenti', 'X', '1970-01-01', '15:00', 0, 002);

-- --------------------------------------------------------

--
-- Struttura della tabella `pallet`
--

CREATE TABLE IF NOT EXISTS `pallet` (
  `CodPallet` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `TipoPallet` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodPallet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `pallet`
--

INSERT INTO `pallet` (`CodPallet`, `TipoPallet`) VALUES
(001, 'N.P.'),
(002, 'T33'),
(003, 'CPR EPAL');

-- --------------------------------------------------------

--
-- Struttura della tabella `pezzatura`
--

CREATE TABLE IF NOT EXISTS `pezzatura` (
  `CodPez` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `TipoPez` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodPez`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `pezzatura`
--

INSERT INTO `pezzatura` (`CodPez`, `TipoPez`) VALUES
(001, '6/10'),
(002, '2 F'),
(003, '9/10');

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE IF NOT EXISTS `prodotto` (
  `CodProd` int(100) NOT NULL AUTO_INCREMENT,
  `CodNP` int(3) unsigned zerofill NOT NULL,
  `Colli` int(5) NOT NULL,
  `Stive` tinyint(4) unsigned zerofill NOT NULL,
  `CodLav` tinyint(3) unsigned zerofill NOT NULL,
  `CodPez` tinyint(3) unsigned zerofill NOT NULL,
  `CodImb` tinyint(3) unsigned zerofill NOT NULL,
  `CodPallet` tinyint(3) unsigned zerofill NOT NULL,
  `CodOrd` int(10) unsigned zerofill NOT NULL,
  `vuoto1` tinyint(3) unsigned zerofill DEFAULT NULL,
  `vuoto2` tinyint(3) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`CodProd`),
  KEY `prodotto_ibfk_2` (`CodPez`),
  KEY `prodotto_ibfk_3` (`CodOrd`),
  KEY `prodotto_ibfk_4` (`CodPallet`),
  KEY `prodotto_ibfk_5` (`CodLav`),
  KEY `prodotto_ibfk_6` (`CodImb`),
  KEY `prodotto_ibfk_1` (`CodNP`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=31 ;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`CodProd`, `CodNP`, `Colli`, `Stive`, `CodLav`, `CodPez`, `CodImb`, `CodPallet`, `CodOrd`, `vuoto1`, `vuoto2`) VALUES
(7, 001, 23, 0043, 002, 001, 002, 002, 0000000003, NULL, NULL),
(8, 003, 23, 0003, 004, 001, 004, 002, 0000000014, NULL, NULL),
(9, 003, 45, 0047, 002, 001, 003, 001, 0000000015, NULL, NULL),
(10, 001, 45, 0003, 004, 002, 002, 003, 0000000016, NULL, NULL),
(11, 001, 456, 0023, 003, 001, 001, 001, 0000000017, NULL, NULL),
(12, 001, 34, 0002, 002, 002, 004, 001, 0000000018, NULL, NULL),
(13, 001, 45, 0024, 002, 001, 002, 003, 0000000019, NULL, NULL),
(14, 001, 21, 0005, 001, 002, 004, 003, 0000000020, NULL, NULL),
(15, 001, 8, 0007, 001, 003, 004, 003, 0000000021, NULL, NULL),
(16, 001, 67, 0004, 003, 002, 002, 002, 0000000022, NULL, NULL),
(17, 001, 46, 0066, 002, 001, 003, 003, 0000000023, NULL, NULL),
(18, 001, 98, 0032, 004, 001, 002, 002, 0000000024, NULL, NULL),
(19, 003, 56, 0004, 003, 002, 004, 001, 0000000025, NULL, NULL),
(20, 002, 45, 0034, 003, 002, 004, 003, 0000000026, NULL, NULL),
(21, 003, 45, 0034, 002, 001, 002, 001, 0000000027, NULL, NULL),
(22, 003, 45, 0003, 002, 001, 003, 003, 0000000028, NULL, NULL),
(23, 001, 45, 0087, 004, 001, 003, 003, 0000000029, NULL, NULL),
(24, 001, 4, 0003, 003, 001, 003, 001, 0000000030, NULL, NULL),
(25, 002, 45, 0004, 002, 002, 003, 001, 0000000031, NULL, NULL),
(26, 001, 12, 0034, 001, 001, 004, 002, 0000000032, NULL, NULL),
(27, 003, 54, 0003, 003, 002, 004, 001, 0000000033, NULL, NULL),
(28, 003, 32, 0003, 003, 001, 004, 003, 0000000034, NULL, NULL),
(29, 003, 32, 0042, 003, 001, 004, 003, 0000000035, NULL, NULL),
(30, 002, 43, 0042, 002, 002, 001, 003, 0000000036, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `trasporto`
--

CREATE TABLE IF NOT EXISTS `trasporto` (
  `CodTrasp` tinyint(3) NOT NULL AUTO_INCREMENT,
  `Portata` char(20) COLLATE utf8_roman_ci DEFAULT NULL,
  `SeqCarico` char(20) COLLATE utf8_roman_ci DEFAULT NULL,
  `Arrivato` char(5) COLLATE utf8_roman_ci DEFAULT NULL,
  `Note` char(20) COLLATE utf8_roman_ci DEFAULT NULL,
  `Cronologia` tinytext COLLATE utf8_roman_ci,
  `CodVett` tinyint(3) unsigned zerofill NOT NULL,
  `CodAut` tinyint(3) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`CodTrasp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `CodUtente` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `NomeUtente` text COLLATE utf8_roman_ci NOT NULL,
  `Password` text COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodUtente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`CodUtente`, `NomeUtente`, `Password`) VALUES
(001, 'francesco', 'francesco'),
(002, 'andrea', 'andrea');

-- --------------------------------------------------------

--
-- Struttura della tabella `vettore`
--

CREATE TABLE IF NOT EXISTS `vettore` (
  `CodVett` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `NomeVettore` char(25) COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodVett`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `vettore`
--

INSERT INTO `vettore` (`CodVett`, `NomeVettore`) VALUES
(1, 'UNITRANS'),
(2, 'VIGNOL TRANS'),
(3, 'TRANSLUSIA');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`CodCliente`) REFERENCES `cliente` (`CodCliente`);

--
-- Limiti per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  ADD CONSTRAINT `prodotto_ibfk_1` FOREIGN KEY (`CodNP`) REFERENCES `nomeprod` (`CodNP`),
  ADD CONSTRAINT `prodotto_ibfk_2` FOREIGN KEY (`CodPez`) REFERENCES `pezzatura` (`CodPez`),
  ADD CONSTRAINT `prodotto_ibfk_3` FOREIGN KEY (`CodOrd`) REFERENCES `ordine` (`CodOrd`),
  ADD CONSTRAINT `prodotto_ibfk_4` FOREIGN KEY (`CodPallet`) REFERENCES `pallet` (`CodPallet`),
  ADD CONSTRAINT `prodotto_ibfk_5` FOREIGN KEY (`CodLav`) REFERENCES `lavorazione` (`CodLav`),
  ADD CONSTRAINT `prodotto_ibfk_6` FOREIGN KEY (`CodImb`) REFERENCES `imballo` (`CodImb`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
