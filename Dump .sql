-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 13 Mai 2013 à 12:50
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `Creature`
--

INSERT INTO `Creature` (`CR_id`, `CR_nom`, `CR_vie`, `CR_faim`, `HU_id`) VALUES
(1, 'Cain', 100, 100, 2),
(2, 'Yaoi', 100, 100, 1),
(3, 'Uke', 30, 50, 2),
(4, 'Seme', 51, 88, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Humeur`
--

CREATE TABLE `Humeur` (
  `HU_id` int(11) NOT NULL AUTO_INCREMENT,
  `HU_nom` varchar(200) NOT NULL,
  `HU_img` varchar(300) NOT NULL,
  PRIMARY KEY (`HU_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Humeur`
--

INSERT INTO `Humeur` (`HU_id`, `HU_nom`, `HU_img`) VALUES
(1, 'Joie', ''),
(2, 'Tristesse', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`US_id`, `US_twitter`, `US_mail`, `US_pw`, `US_point`, `CR_id`) VALUES
(1, 'Cainael', 'cainael@hotmail.fr', 'toto', 1000, 1),
(2, 'Nadium', 'nadium@gmail.com', 'titi', 10, 2),
(3, 'Loveless', 'loveless@re.com', 'loveless', 67, 2),
(4, 'Manga', 'mangas@hr.com', 'mangas', 2500, 4);

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
