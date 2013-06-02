-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 02 Juin 2013 à 23:03
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `Creature`
--

INSERT INTO `Creature` (`CR_id`, `CR_nom`, `CR_vie`, `CR_faim`, `HU_id`) VALUES
(1, 'Cain', 100, 100, 2),
(2, 'Yaoi', 100, 100, 1),
(3, 'Uke', 30, 50, 2),
(4, 'Seme', 51, 88, 2),
(5, 'tutu', 12, 34, 4),
(6, 'didoo', 54, 90, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Humeur`
--

CREATE TABLE `Humeur` (
  `HU_id` int(11) NOT NULL AUTO_INCREMENT,
  `HU_nom` varchar(200) NOT NULL,
  `HU_img` varchar(300) NOT NULL,
  PRIMARY KEY (`HU_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `Humeur`
--

INSERT INTO `Humeur` (`HU_id`, `HU_nom`, `HU_img`) VALUES
(1, 'Joie', ''),
(2, 'Tristesse', ''),
(3, 'Faim', ''),
(4, 'calme', '');

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
  `US_music` int(11) NOT NULL,
  `US_food` int(11) NOT NULL,
  `US_photo` int(11) NOT NULL,
  PRIMARY KEY (`US_id`),
  UNIQUE KEY `CR_id` (`CR_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`US_id`, `US_twitter`, `US_mail`, `US_pw`, `US_point`, `CR_id`, `US_music`, `US_food`, `US_photo`) VALUES
(1, 'Cainael', 'cainael@hotmail.fr', 'toto', 1234, 1, 1104, 98, 5),
(2, 'Nadium', 'nadium@gmail.com', 'titi', 2034, 2, 1766, 678, 78),
(3, 'Akajiro', 'loveless@re.com', 'loveless', 1067, 3, 830, 8, 987),
(4, 'Deadmush', 'mangas@hr.com', 'mangas', 2004, 4, 980, 37, 6),
(5, 'Teemo', 'teemo@hotmail.fr', 'teemo', 343, 6, 34, 23, 2),
(6, 'Didoo', 'toto@gmail.fr', 'toto', 459, 5, 300, 23, 45);

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
