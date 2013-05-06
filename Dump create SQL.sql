-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 06 Mai 2013 à 16:52
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `mmc`
--

-- --------------------------------------------------------

--
-- Structure de la table `Creature`
--

CREATE TABLE `Creature` (
  `CR_id` int(11) NOT NULL AUTO_INCREMENT,
  `CR_nom` varchar(200) NOT NULL,
  `CR_vie` int(11) NOT NULL,
  `CR_faim` int(11) NOT NULL,
  `HU_id` int(11) NOT NULL,
  PRIMARY KEY (`CR_id`),
  KEY `HU_id` (`HU_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Humeur`
--

CREATE TABLE `Humeur` (
  `HU_id` int(11) NOT NULL AUTO_INCREMENT,
  `HU_nom` varchar(200) NOT NULL,
  `HU_img` varchar(300) NOT NULL,
  PRIMARY KEY (`HU_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `US_id` int(11) NOT NULL AUTO_INCREMENT,
  `US_twitter` varchar(250) NOT NULL,
  `US_mail` varchar(250) NOT NULL,
  `US_pw` varchar(250) NOT NULL,
  `US_point` int(11) NOT NULL,
  `CR_id` int(11) NOT NULL,
  PRIMARY KEY (`US_id`),
  KEY `CR_id` (`CR_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Creature`
--
ALTER TABLE `Creature`
  ADD CONSTRAINT `Creature_ibfk_1` FOREIGN KEY (`HU_id`) REFERENCES `Humeur` (`HU_id`);

--
-- Contraintes pour la table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`CR_id`) REFERENCES `Creature` (`CR_id`);
