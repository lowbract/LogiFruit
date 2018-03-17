-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Giu 28, 2013 alle 16:36
-- Versione del server: 5.5.31
-- Versione PHP: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Italfrutta`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `lavorazione`
--

INSERT INTO `lavorazione` (`CodLav`, `TipoLav`) VALUES
(001, 'Sfuso'),
(002, 'Alveolo'),
(003, 'Natura'),
(004, 'Prezzato');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
