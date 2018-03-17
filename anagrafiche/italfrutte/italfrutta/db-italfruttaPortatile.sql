-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Lug 29, 2013 alle 12:31
-- Versione del server: 5.5.31
-- Versione PHP: 5.3.10-1ubuntu3.6

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `imballo`
--

CREATE TABLE IF NOT EXISTS `imballo` (
  `CodImb` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `TipoImballo` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodImb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `lavorazione`
--

CREATE TABLE IF NOT EXISTS `lavorazione` (
  `CodLav` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `TipoLav` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodLav`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `nomeprod`
--

CREATE TABLE IF NOT EXISTS `nomeprod` (
  `CodNP` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `NomeProd` char(20) COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodNP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE IF NOT EXISTS `ordine` (
  `CodOrd` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Commenti` char(30) COLLATE utf8_roman_ci DEFAULT NULL,
  `FP` tinyint(4) unsigned zerofill DEFAULT NULL,
  `data` date NOT NULL,
  `OraPartenza` time NOT NULL,
  `Modificato` tinyint(1) DEFAULT '0',
  `CodCliente` tinyint(3) unsigned zerofill NOT NULL,
  PRIMARY KEY (`CodOrd`),
  KEY `ordine_ibfk_1` (`CodCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `pallet`
--

CREATE TABLE IF NOT EXISTS `pallet` (
  `CodPallet` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `TipoPallet` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodPallet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `pezzatura`
--

CREATE TABLE IF NOT EXISTS `pezzatura` (
  `CodPez` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `TipoPez` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodPez`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE IF NOT EXISTS `prodotto` (
  `CodProd` int(100) NOT NULL AUTO_INCREMENT,
  `CodNP` int(3) unsigned zerofill NOT NULL,
  `Colli` int(5) NOT NULL,
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
  `Note` char(20) COLLATE utf8_roman_ci DEFAULT NULL,
  `Cronologia` tinytext COLLATE utf8_roman_ci,
  `CodVett` tinyint(3) unsigned zerofill NOT NULL,
  `CodAut` tinyint(3) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`CodTrasp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

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
