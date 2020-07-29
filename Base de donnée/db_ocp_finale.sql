-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 29 juil. 2020 à 12:43
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_ocp`
--

-- --------------------------------------------------------

--
-- Structure de la table `bank_accounts`
--

DROP TABLE IF EXISTS `bank_accounts`;
CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `NUM_ACCOUNT` char(255) NOT NULL,
  `CODE_CITY` int(11) DEFAULT NULL,
  `AGENCY` char(255) DEFAULT NULL,
  `ADDRESS` char(255) DEFAULT NULL,
  PRIMARY KEY (`NUM_ACCOUNT`),
  KEY `FK_REFERENCE_4` (`CODE_CITY`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bank_accounts`
--

INSERT INTO `bank_accounts` (`NUM_ACCOUNT`, `CODE_CITY`, `AGENCY`, `ADDRESS`) VALUES
('011590000009210006006980', 46000, 'BMCE BANK', ''),
('007590000935400000001631', 46000, 'ATTIJARIWAFA BANK', '');

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `CODE_CITY` int(11) NOT NULL,
  `CITY_NAME` char(255) DEFAULT NULL,
  PRIMARY KEY (`CODE_CITY`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `N_DOCUMENT` char(255) NOT NULL,
  `NUM_COMPTE` char(255) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `OBJECT` char(255) DEFAULT NULL,
  `CIN_BEN` char(255) DEFAULT NULL,
  `NOM_BEN_PC` char(255) DEFAULT NULL,
  `RIB_BEN` char(255) DEFAULT NULL,
  `OP_TYPE` char(255) DEFAULT NULL,
  `DOC_MONTANT` float DEFAULT NULL,
  `TYPE_DOC` varchar(11) DEFAULT NULL,
  `DOC_MONTANT_LETTRE` varchar(255) NOT NULL,
  `SIGNED` int(11) DEFAULT NULL,
  `LINK_SIGNE1` varchar(255) DEFAULT NULL,
  `LINK_SIGNE2` varchar(255) DEFAULT NULL,
  `SIGNED_BY1` varchar(250) DEFAULT NULL,
  `SIGNED_BY2` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`N_DOCUMENT`),
  KEY `FK_REFERENCE_1` (`NUM_COMPTE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `signatories`
--

DROP TABLE IF EXISTS `signatories`;
CREATE TABLE IF NOT EXISTS `signatories` (
  `N_DOCUMENT` char(255) NOT NULL,
  `EMAIL` char(255) NOT NULL,
  PRIMARY KEY (`N_DOCUMENT`,`EMAIL`),
  KEY `FK_REFERENCE_3` (`EMAIL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `EMAIL` char(255) NOT NULL,
  `USER` varchar(50) NOT NULL,
  `PASSWORD` char(255) DEFAULT NULL,
  `ROLE` int(11) DEFAULT NULL,
  `SALT` varchar(32) NOT NULL,
  PRIMARY KEY (`EMAIL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`EMAIL`, `USER`, `PASSWORD`, `ROLE`, `SALT`) VALUES
('Nadi@gmail.com', 'Nadia Raji', '997f792e3af13a5b1848167bd62240d7c36c2855729168dcab06262f1c5b0468', 1, '”@å‘WŒ×†qúóåP´Ý³T]YH±T›C„ÿ2<'),
('mehdi133@gmail.com', 'Mehdi test css', 'e5672a7fdbed29fb794597253df82dbef12c1c5e03294c39def590a69ca0140d', 3, 'µ7Ïé¼§V«š\rÃ]<H© \rV}ördÖÆ”ÃBµ');

-- --------------------------------------------------------

--
-- Structure de la table `users_session`
--

DROP TABLE IF EXISTS `users_session`;
CREATE TABLE IF NOT EXISTS `users_session` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_EMAIL` varchar(255) NOT NULL,
  `HASH` varchar(150) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users_session`
--

INSERT INTO `users_session` (`ID`, `USER_EMAIL`, `HASH`) VALUES
(31, 'Nadi@gmail.com', '6e59303495cf827241883b2dc94816dccdd827dcfe2f49909c56dc0e9ea87e89'),
(32, '1@gmail.com', '87045a10b7ad5b0cd7b26bbd3c0eccf8e710f764a50e988483d829b991cd6afd'),
(24, 'abdo@gmail.com', 'b6c59beabdf1b734f826cf4d1202324dd74f473a97b994831b1cd9bf88320157');

-- --------------------------------------------------------

--
-- Structure de la table `verified_email`
--

DROP TABLE IF EXISTS `verified_email`;
CREATE TABLE IF NOT EXISTS `verified_email` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(250) NOT NULL,
  `ADDED_BY` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`,`EMAIL`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
