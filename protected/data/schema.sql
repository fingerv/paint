SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `heads`;
CREATE TABLE `heads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `paints`;
CREATE TABLE `paints` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `C` varchar(255) DEFAULT NULL,
  `M` varchar(255) DEFAULT NULL,
  `Y` varchar(255) DEFAULT NULL,
  `K` varchar(255) DEFAULT NULL,
  `Lc` varchar(255) DEFAULT NULL,
  `Lm` varchar(255) DEFAULT NULL,
  `Or` varchar(255) DEFAULT NULL,
  `Gr` varchar(255) DEFAULT NULL,
  `W` varchar(255) DEFAULT NULL,
  `V` varchar(255) DEFAULT NULL,
  `P` varchar(255) DEFAULT NULL,
  `F` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `printers`;
CREATE TABLE `printers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `scheme` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;