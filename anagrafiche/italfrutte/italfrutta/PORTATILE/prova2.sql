
------creazione tabella prodotti senza FOREIGN KEY CodOrdine------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `prodotto` (
  `CodProd` int(100) NOT NULL AUTO_INCREMENT,
  `NomeProd` char(250) COLLATE utf8_roman_ci NOT NULL,
  `Colli` int(5) NOT NULL,
  `CodLav` tinyint(3) unsigned zerofill NOT NULL,
  `CodPez` tinyint(3) unsigned zerofill NOT NULL,
  `CodImb` tinyint(3) NOT NULL,
  `CodPallet` tinyint(3) NOT NULL,
  `CodOrd` int(10) NOT NULL,
  `vuoto1` tinyint(3),
  `vuoto2` tinyint(3),
  PRIMARY KEY (`CodProd`),
  FOREIGN KEY (`CodPez`) REFERENCES pezzatura (`CodPez`),
  FOREIGN KEY (`CodOrd`) REFERENCES ordine (`CodOrd`),
  FOREIGN KEY (`CodImb`) REFERENCES imballo (`CodImb`), 
  FOREIGN KEY (`CodPallet`) REFERENCES pallet (`CodPallet`),
  FOREIGN KEY (`CodLav`) REFERENCES lavorazione (`CodLav`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

`NomeProdotto` char(150) COLLATE utf8_roman_ci

ALTER TABLE `prodotto` ADD CONSTRAINT `prodotto_ibfk_1` FOREIGN KEY (`CodNP`) REFERENCES `nomeprod` (`CodNP`);
ALTER TABLE `prodotto` ADD CONSTRAINT `prodotto_ibfk_2` FOREIGN KEY (`CodPez`) REFERENCES `pezzatura` (`CodPez`); OK
ALTER TABLE `prodotto` ADD CONSTRAINT `prodotto_ibfk_3` FOREIGN KEY (`CodOrd`) REFERENCES `ordine` (`CodOrd`); OK
ALTER TABLE `prodotto` ADD CONSTRAINT `prodotto_ibfk_4` FOREIGN KEY (`CodPallet`) REFERENCES `pallet` (`CodPallet`); OK
ALTER TABLE `prodotto` ADD CONSTRAINT `prodotto_ibfk_5` FOREIGN KEY (`CodLav`) REFERENCES `lavorazione` (`CodLav`); OK
ALTER TABLE `prodotto` ADD CONSTRAINT `prodotto_ibfk_6` FOREIGN KEY (`CodImb`) REFERENCES `imballo` (`CodImb`); OK




`CodNP` int(3) unsigned zerofill NOT NULL


------creazione tabella autista -----------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `autista` (
  `CodAut` tinyint(3) NOT NULL AUTO_INCREMENT,
  `Nome` char(20) NOT NULL,
  `Cognome` char(20) NOT NULL,
  `Telefono1` char(15),
  `Telefono2` char(15),
  `CodVett` tinyint(3) NOT NULL,
  PRIMARY KEY (`CodAut`),
  FOREIGN KEY (`CodVett`) REFERENCES vettore (`CodVett`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;


------creazione tabella autista -----------------------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `ordine` (
  `CodOrd` int(10) NOT NULL AUTO_INCREMENT,
  `Commenti` char(30),
  `data` date NOT NULL,
  `OraPartenza` time NOT NULL,
  `Modificato` boolean not null default 0,
  `CodTrasp` tinyint(3) NOT NULL,
  `CodCliente` tinyint(3) unsigned zerofill NOT NULL,
  PRIMARY KEY (`CodOrd`),
  FOREIGN KEY (`CodTrasp`) REFERENCES trasporto (`CodTrasp`),
  FOREIGN KEY (`CodCliente`) REFERENCES cliente (`CodCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

------creazione tabella trasporto -----------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `trasporto` (
  `CodTrasp` tinyint(3) NOT NULL AUTO_INCREMENT,
  `Portata` char(20),
  `SeqCarico` char(20),
  `Arrivato` char(5),
  `CodVett` tinyint(3) unsigned NOT NULL,
  `CodAut` tinyint(3) NOT NULL,
  PRIMARY KEY (`CodTrasp`),
  FOREIGN KEY (`CodVett`) REFERENCES vettore (`CodVett`),
  FOREIGN KEY (`CodAut`) REFERENCES autista (`CodAut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;


-------creazione tabella ordine--------------------------------------------------------------------------------------------


CREATE TABLE IF NOT EXISTS `ordine` (
  `CodOrd` int(10) NOT NULL AUTO_INCREMENT,
  `Commenti` char(30) COLLATE utf8_roman_ci DEFAULT NULL,
  `data` date NOT NULL,
  `OraPartenza` time NOT NULL,
  `Modificato` tinyint(1) NOT NULL DEFAULT '0',
  `CodTrasp` tinyint(3) NOT NULL,
  `CodCliente` tinyint(3) unsigned zerofill NOT NULL, 
  PRIMARY KEY (`CodOrd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1;
 

ALTER TABLE `ordine`
 
  ADD CONSTRAINT `ord_ibfk_2` FOREIGN KEY (`CodCliente`) REFERENCES `cliente` (`CodCliente`);


FOREIGN KEY (`CodTrasp`) REFERENCES trasporto (`CodTrasp`),
  FOREIGN KEY (`CodCliente`) REFERENCES cliente (`CodCliente`)


SELECT 
  constraint_name,
  table_name
FROM 
  information_schema.table_constraints 
WHERE 
  constraint_type = 'FOREIGN KEY' 
  AND table_schema = DATABASE();




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
  KEY `CodPez` (`CodPez`),
  KEY `CodOrd` (`CodOrd`),
  KEY `CodImb` (`CodImb`),
  KEY `CodPallet` (`CodPallet`),
  KEY `CodLav` (`CodLav`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;

