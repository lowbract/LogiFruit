-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Set 09, 2013 alle 16:12
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `autista`
--

INSERT INTO `autista` (`CodAut`, `Nome`, `Cognome`, `Telefono1`, `Telefono2`) VALUES
(001, 'Mario', 'Rossi', '3339087124', '');

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
  `FP` tinytext COLLATE utf8_roman_ci,
  `data` date NOT NULL,
  `OraPartenza` tinytext COLLATE utf8_roman_ci NOT NULL,
  `Modificato` tinyint(1) DEFAULT '0',
  `CodCliente` tinyint(3) unsigned zerofill NOT NULL,
  PRIMARY KEY (`CodOrd`),
  KEY `ordine_ibfk_1` (`CodCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=15 ;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`CodOrd`, `Codice`, `FP`, `data`, `OraPartenza`, `Modificato`, `CodCliente`) VALUES
(0000000001, 008, '', '2013-08-08', '00:00', 0, 001),
(0000000002, 001, 'X', '2013-08-09', '08:30', 0, 003),
(0000000003, 013, '', '2013-08-08', '05:00', 0, 001),
(0000000004, 012, '', '2013-08-08', '05:00', 0, 002),
(0000000005, 002, 'X', '2013-08-06', '05:00', 0, 003),
(0000000006, 006, 'x', '2013-08-08', '07:00', 0, 003),
(0000000007, 004, 'X', '2013-08-06', '18:00', 0, 003),
(0000000008, 003, '', '2013-08-08', '02:30', 0, 001),
(0000000009, 006, 'x', '2013-08-08', '24:30', 0, 001),
(0000000010, 010, '', '2013-08-08', '03:30', 0, 001),
(0000000011, 010, '', '2013-08-08', '03:30', 0, 001),
(0000000012, 011, '', '2013-08-08', '03:00', 0, 003),
(0000000013, 1234, 'X', '2013-08-09', '08:30', 0, 003),
(0000000014, 1234, '', '2013-08-09', '08:30', 0, 002);

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
  `Commenti` char(30) COLLATE utf8_roman_ci DEFAULT NULL,
  `CodLav` tinyint(3) unsigned zerofill NOT NULL,
  `CodPez` tinyint(3) unsigned zerofill NOT NULL,
  `CodImb` tinyint(3) unsigned zerofill NOT NULL,
  `CodPallet` tinyint(3) unsigned zerofill NOT NULL,
  `CodOrd` int(10) unsigned zerofill NOT NULL,
  `Colore` text COLLATE utf8_roman_ci NOT NULL,
  `Cancellazione` tinyint(3) unsigned zerofill DEFAULT '000',
  `Misura` char(15) COLLATE utf8_roman_ci DEFAULT NULL,
  PRIMARY KEY (`CodProd`),
  KEY `prodotto_ibfk_2` (`CodPez`),
  KEY `prodotto_ibfk_3` (`CodOrd`),
  KEY `prodotto_ibfk_4` (`CodPallet`),
  KEY `prodotto_ibfk_5` (`CodLav`),
  KEY `prodotto_ibfk_6` (`CodImb`),
  KEY `prodotto_ibfk_1` (`CodNP`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`CodProd`, `CodNP`, `Colli`, `Stive`, `Commenti`, `CodLav`, `CodPez`, `CodImb`, `CodPallet`, `CodOrd`, `Colore`, `Cancellazione`, `Misura`) VALUES
(1, 003, 1, 0001, 'RIMODIFICA', 003, 003, 003, 003, 0000000008, 'FondoArancio', 000, NULL),
(2, 002, 22, 0003, 'Prova di Modifica', 001, 003, 002, 001, 0000000001, 'FondoRosso', 000, NULL),
(3, 003, 4, 0005, 'MODIFICATO BIS', 002, 003, 004, 003, 0000000003, 'FondoGiallo', 000, NULL),
(5, 003, 3, 0004, 'MODIFICATO', 003, 003, 004, 003, 0000000004, 'FondoGiallo', 001, NULL),
(6, 003, 34, 0003, 'MODIFICATO', 001, 002, 002, 003, 0000000005, 'FondoArancio', 000, NULL),
(7, 003, 3, 0002, 'Commento', 003, 001, 004, 003, 0000000003, 'FondoRosso', 000, NULL),
(8, 001, 3, 0001, 'modificato di nuovo', 003, 001, 004, 001, 0000000006, 'FondoRosso', 000, NULL),
(9, 001, 2, 0003, 'Commento', 004, 001, 004, 003, 0000000010, 'FondoVerde', 000, NULL),
(10, 001, 2, 0003, 'Secondo Ord.n.10', 001, 001, 003, 001, 0000000011, 'FondoVerde', 000, NULL),
(11, 003, 3, 0002, 'commento', 003, 002, 003, 003, 0000000012, 'FondoVerde', 001, NULL),
(12, 001, 2, 0003, 'commento', 003, 003, 003, 002, 0000000013, 'TabelleOrdini', 000, NULL),
(13, 001, 2, 0003, 'commento', 003, 001, 004, 002, 0000000014, 'FondoGiallo', 000, NULL);

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
  `CodOrd` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`CodTrasp`),
  KEY `trasporto_ibfk_1` (`CodOrd`)
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

--
-- Limiti per la tabella `trasporto`
--
ALTER TABLE `trasporto`
  ADD CONSTRAINT `trasporto_ibfk_1` FOREIGN KEY (`CodOrd`) REFERENCES `ordine` (`CodOrd`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
