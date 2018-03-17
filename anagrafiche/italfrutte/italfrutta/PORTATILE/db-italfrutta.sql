-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Lug 25, 2013 alle 15:00
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
-- Struttura della tabella `autista`
--

CREATE TABLE IF NOT EXISTS `autista` (
  `CodAut` tinyint(3) NOT NULL AUTO_INCREMENT,
  `Nome` char(20) COLLATE utf8_roman_ci NOT NULL,
  `Cognome` char(15) COLLATE utf8_roman_ci NOT NULL,
  `Telefono1` char(15) COLLATE utf8_roman_ci DEFAULT NULL,
  `Telefono2` char(15) COLLATE utf8_roman_ci DEFAULT NULL,
  PRIMARY KEY (`CodAut`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `CodCliente` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `NomeCliente` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `imballo`
--

CREATE TABLE IF NOT EXISTS `imballo` (
  `CodImb` tinyint(3) NOT NULL AUTO_INCREMENT,
  `TipoImballo` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodImb`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `lavorazione`
--

CREATE TABLE IF NOT EXISTS `lavorazione` (
  `CodLav` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `TipoLav` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodLav`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `pallet`
--

CREATE TABLE IF NOT EXISTS `pallet` (
  `CodPallet` tinyint(3) NOT NULL AUTO_INCREMENT,
  `TipoPallet` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodPallet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `pezzatura`
--

CREATE TABLE IF NOT EXISTS `pezzatura` (
  `CodPez` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `TipoPez` tinytext COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodPez`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `nomeprodotto`
--

CREATE TABLE IF NOT EXISTS `nomeprodotto` (
  `CodNP` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `NomeP` char(150) COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodSp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `vettore`
--

CREATE TABLE IF NOT EXISTS `vettore` (
  `CodVett` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `NomeVettore` char(25) COLLATE utf8_roman_ci NOT NULL,
  PRIMARY KEY (`CodVett`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=4 ;





