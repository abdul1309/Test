# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.6.33)
# Datenbank: Bibliothek
# Erstellt am: 2017-10-05 14:15:33 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Export von Tabelle ausleihe
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ausleihe`;

CREATE TABLE `ausleihe` (
  `id_ausleihe` int(11) NOT NULL AUTO_INCREMENT,
  `id_kunde` int(11) DEFAULT NULL,
  `ausleihdatum` date DEFAULT NULL,
  `rückgabedatum` date DEFAULT NULL,
  PRIMARY KEY (`id_ausleihe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ausleihe` WRITE;
/*!40000 ALTER TABLE `ausleihe` DISABLE KEYS */;

INSERT INTO `ausleihe` (`id_ausleihe`, `id_kunde`, `ausleihdatum`, `rückgabedatum`)
VALUES
	(1,155,'2017-09-15','2017-09-15'),
	(2,155,'2017-09-15','2017-09-15'),
	(3,155,'2017-09-15','2017-09-15'),
	(4,155,'2017-09-15','2017-09-15'),
	(5,155,'2017-09-15','2017-09-15'),
	(6,155,'2017-09-15','2017-09-15'),
	(7,155,'2017-09-15','2017-09-15'),
	(8,155,'2017-09-15','2012-06-00'),
	(9,155,'2017-09-15','2012-06-00'),
	(10,155,'2017-09-15','0000-00-00'),
	(11,155,'2017-09-15','0000-00-00'),
	(12,155,'2017-09-15','0000-00-00'),
	(13,155,'2017-09-15','2012-06-00'),
	(14,155,'2017-09-15','2012-06-00'),
	(15,155,'0000-00-00','2012-06-00'),
	(16,155,'2017-09-15','0000-00-00'),
	(17,155,'2017-09-15','0000-00-00'),
	(18,155,'2017-09-15','0000-00-00'),
	(19,155,'2017-09-15','0000-00-00'),
	(20,155,'2017-09-15','0000-00-00'),
	(21,155,'2017-09-18','2017-09-18'),
	(22,155,'2017-09-18','0000-00-00'),
	(23,155,'2017-09-18','0000-00-00'),
	(24,155,'2017-09-18','0000-00-00'),
	(25,155,'2017-09-18','0000-00-00'),
	(26,156,'2017-09-18','0000-00-00');

/*!40000 ALTER TABLE `ausleihe` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle bibliothek
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bibliothek`;

CREATE TABLE `bibliothek` (
  `id_bibliothek` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ort` varchar(50) DEFAULT NULL,
  `plz` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_bibliothek`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `bibliothek` WRITE;
/*!40000 ALTER TABLE `bibliothek` DISABLE KEYS */;

INSERT INTO `bibliothek` (`id_bibliothek`, `name`, `adresse`, `ort`, `plz`)
VALUES
	(2,'asdasdasd','     ','asdasdasdasd',12);

/*!40000 ALTER TABLE `bibliothek` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle buch
# ------------------------------------------------------------

DROP TABLE IF EXISTS `buch`;

CREATE TABLE `buch` (
  `id_buch` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `id_kategorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_buch`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `buch` WRITE;
/*!40000 ALTER TABLE `buch` DISABLE KEYS */;

INSERT INTO `buch` (`id_buch`, `name`, `title`, `id_kategorie`)
VALUES
	(3249,'PHP und MYSQL','  Grundlagen',0),
	(3251,'PHP','      Grund',0),
	(3252,'asdasd','       asdsadsd',0),
	(3253,'PHP','               Grundlagen',16),
	(3254,'MYSQL','      Grundlagen',18);

/*!40000 ALTER TABLE `buch` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle buch_to_ausleihe
# ------------------------------------------------------------

DROP TABLE IF EXISTS `buch_to_ausleihe`;

CREATE TABLE `buch_to_ausleihe` (
  `id_ausleihe` int(11) NOT NULL,
  `id_buch` int(11) NOT NULL,
  PRIMARY KEY (`id_ausleihe`,`id_buch`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Export von Tabelle buch_to_bibliothek
# ------------------------------------------------------------

DROP TABLE IF EXISTS `buch_to_bibliothek`;

CREATE TABLE `buch_to_bibliothek` (
  `id_bibliothek` int(11) NOT NULL,
  `id_buch` int(11) NOT NULL,
  PRIMARY KEY (`id_bibliothek`,`id_buch`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Export von Tabelle kategorie
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kategorie`;

CREATE TABLE `kategorie` (
  `id_kategorie` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `kategorie` WRITE;
/*!40000 ALTER TABLE `kategorie` DISABLE KEYS */;

INSERT INTO `kategorie` (`id_kategorie`, `name`)
VALUES
	(16,'fantasie'),
	(18,'lernen'),
	(19,'Roman');

/*!40000 ALTER TABLE `kategorie` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle kunde
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kunde`;

CREATE TABLE `kunde` (
  `id_kunde` int(11) NOT NULL AUTO_INCREMENT,
  `vorname` varchar(50) DEFAULT NULL,
  `nachname` varchar(50) DEFAULT NULL,
  `geburtsdatum` date DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ort` varchar(50) DEFAULT NULL,
  `plz` int(11) DEFAULT NULL,
  `benutzername` varchar(50) DEFAULT NULL,
  `passwort` varchar(32) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `mitarbeiter` char(5) DEFAULT NULL,
  `kunde` char(5) DEFAULT NULL,
  PRIMARY KEY (`id_kunde`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `kunde` WRITE;
/*!40000 ALTER TABLE `kunde` DISABLE KEYS */;

INSERT INTO `kunde` (`id_kunde`, `vorname`, `nachname`, `geburtsdatum`, `adresse`, `ort`, `plz`, `benutzername`, `passwort`, `email`, `mitarbeiter`, `kunde`)
VALUES
	(194,'Abdul','     Shaddad','1111-11-11','Altonaer Poststraße, 9a','     Hamburg',22767,'qay','c23b2ed66eedb321c5bcfb5e3724b978','abed.shaddad@hotmail.com','ja','nein');

/*!40000 ALTER TABLE `kunde` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
