-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Lug 15, 2013 alle 11:43
-- Versione del server: 5.5.31
-- Versione PHP: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `italfrutta`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `autista`
--

CREATE TABLE IF NOT EXISTS `autista` (
  `CodAut` tinyint(3) NOT NULL AUTO_INCREMENT,
  `Nome` char(20) COLLATE utf8_roman_ci NOT NULL,
  `Cognome` char(20) COLLATE utf8_roman_ci DEFAULT NULL,
  `Telefono1` char(15) COLLATE utf8_roman_ci DEFAULT NULL,
  `Telefono2` char(15) COLLATE utf8_roman_ci DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=27 ;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`CodCliente`, `NomeCliente`) VALUES
(001, 'Bennet'),
(002, 'Conad'),
(024, 'Coop'),
(025, 'Pippo'),
(026, 'Prova');

-- --------------------------------------------------------

--
-- Struttura della tabella `imballo`
--

CREATE TABLE IF NOT EXISTS `imballo` (
  `CodImb` tinyint(3) NOT NULL AUTO_INCREMENT,
  `TipoImballo` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodImb`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `imballo`
--

INSERT INTO `imballo` (`CodImb`, `TipoImballo`) VALUES
(1, 'T32'),
(2, 'T31');

-- --------------------------------------------------------

--
-- Struttura della tabella `lavorazione`
--

CREATE TABLE IF NOT EXISTS `lavorazione` (
  `CodLav` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `TipoLav` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodLav`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `lavorazione`
--

INSERT INTO `lavorazione` (`CodLav`, `TipoLav`) VALUES
(001, 'Sfuso'),
(002, 'Alveolo'),
(003, 'Natura'),
(004, 'Prezzato'),
(005, 'Cacca'),
(006, 'Prova'),
(007, 'Mela');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE IF NOT EXISTS `ordine` (
  `CodOrd` int(10) NOT NULL AUTO_INCREMENT,
  `Commenti` char(30) COLLATE utf8_roman_ci DEFAULT NULL,
  `data` date NOT NULL,
  `OraPartenza` time NOT NULL,
  `Modificato` tinyint(1) NOT NULL DEFAULT '0',
  `CodTrasp` tinyint(3) NOT NULL,
  `CodCliente` tinyint(3) unsigned zerofill NOT NULL,
  PRIMARY KEY (`CodOrd`),
  KEY `ord_ibfk_1` (`CodTrasp`),
  KEY `ord_ibfk_2` (`CodCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `pallet`
--

CREATE TABLE IF NOT EXISTS `pallet` (
  `CodPallet` tinyint(3) NOT NULL AUTO_INCREMENT,
  `TipoPallet` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodPallet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `pallet`
--

INSERT INTO `pallet` (`CodPallet`, `TipoPallet`) VALUES
(1, 'T33'),
(2, 'T31');

-- --------------------------------------------------------

--
-- Struttura della tabella `pezzatura`
--

CREATE TABLE IF NOT EXISTS `pezzatura` (
  `CodPez` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `TipoPez` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodPez`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `pezzatura`
--

INSERT INTO `pezzatura` (`CodPez`, `TipoPez`) VALUES
(001, '6/10'),
(002, '2 F');

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE IF NOT EXISTS `prodotto` (
  `CodProd` int(100) NOT NULL AUTO_INCREMENT,
  `NomeProd` char(250) COLLATE utf8_roman_ci NOT NULL,
  `Colli` int(5) NOT NULL,
  `CodLav` tinyint(3) unsigned zerofill NOT NULL,
  `CodPez` tinyint(3) unsigned zerofill NOT NULL,
  `CodImb` tinyint(3) NOT NULL,
  `CodPallet` tinyint(3) NOT NULL,
  `CodOrd` int(10) NOT NULL,
  `vuoto1` tinyint(3) DEFAULT NULL,
  `vuoto2` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`CodProd`),
  KEY `prod_ibfk_1` (`CodPez`),
  KEY `prod_ibfk_2` (`CodLav`),
  KEY `prod_ibfk_3` (`CodOrd`),
  KEY `prod_ibfk_4` (`CodImb`),
  KEY `prod_ibfk_5` (`CodPallet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `trasporto`
--

CREATE TABLE IF NOT EXISTS `trasporto` (
  `CodTrasp` tinyint(3) NOT NULL AUTO_INCREMENT,
  `Portata` char(20) COLLATE utf8_roman_ci DEFAULT NULL,
  `SeqCarico` char(20) COLLATE utf8_roman_ci DEFAULT NULL,
  `Arrivato` char(5) COLLATE utf8_roman_ci DEFAULT NULL,
  `CodVett` tinyint(3) unsigned NOT NULL,
  `CodAut` tinyint(3) NOT NULL,
  PRIMARY KEY (`CodTrasp`),
  KEY `CodVett` (`CodVett`),
  KEY `CodAut` (`CodAut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `CodUtente` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `NomeUtente` char(15) COLLATE utf8_roman_ci NOT NULL,
  `Password` char(15) COLLATE utf8_roman_ci NOT NULL,
  `vuoto` tinyint(3) NOT NULL,
  PRIMARY KEY (`CodUtente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`CodUtente`, `NomeUtente`, `Password`, `vuoto`) VALUES
(001, 'amministrazione', 'apass1+', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `vettore`
--

CREATE TABLE IF NOT EXISTS `vettore` (
  `CodVett` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `NomeVettore` char(25) COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodVett`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ord_ibfk_2` FOREIGN KEY (`CodCliente`) REFERENCES `cliente` (`CodCliente`),
  ADD CONSTRAINT `ord_ibfk_1` FOREIGN KEY (`CodTrasp`) REFERENCES `trasporto` (`CodTrasp`);

--
-- Limiti per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  ADD CONSTRAINT `prod_ibfk_1` FOREIGN KEY (`CodPez`) REFERENCES `pezzatura` (`CodPez`),
  ADD CONSTRAINT `prod_ibfk_2` FOREIGN KEY (`CodLav`) REFERENCES `lavorazione` (`CodLav`),
  ADD CONSTRAINT `prod_ibfk_3` FOREIGN KEY (`CodOrd`) REFERENCES `ordine` (`CodOrd`),
  ADD CONSTRAINT `prod_ibfk_4` FOREIGN KEY (`CodImb`) REFERENCES `imballo` (`CodImb`),
  ADD CONSTRAINT `prod_ibfk_5` FOREIGN KEY (`CodPallet`) REFERENCES `pallet` (`CodPallet`);

--
-- Limiti per la tabella `trasporto`
--
ALTER TABLE `trasporto`
  ADD CONSTRAINT `trasporto_ibfk_1` FOREIGN KEY (`CodVett`) REFERENCES `vettore` (`CodVett`),
  ADD CONSTRAINT `trasporto_ibfk_2` FOREIGN KEY (`CodAut`) REFERENCES `autista` (`CodAut`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
