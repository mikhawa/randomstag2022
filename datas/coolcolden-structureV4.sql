-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 27 oct. 2022 à 13:57
-- Version du serveur : 10.3.35-MariaDB
-- Version de PHP : 8.1.7

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `coolcolden`
--
DROP DATABASE IF EXISTS `coolcolden`;
CREATE DATABASE IF NOT EXISTS `coolcolden` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `coolcolden`;

-- --------------------------------------------------------

--
-- Structure de la table `annee`
--

DROP TABLE IF EXISTS `annee`;
CREATE TABLE IF NOT EXISTS `annee` (
                                       `idannee` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                       `section` varchar(60) NOT NULL,
                                       `annee` char(4) NOT NULL,
                                       PRIMARY KEY (`idannee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reponseslog`
--

DROP TABLE IF EXISTS `reponseslog`;
CREATE TABLE IF NOT EXISTS `reponseslog` (
                                             `idreponseslog` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                                             `reponseslogcol` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 => absent\n1 => mal répondu\n2 => bien répondu avec aide ou recherche\n3 => bonne réponse\n',
                                             `reponseslogdate` datetime DEFAULT current_timestamp(),
                                             `user_iduser` int(10) UNSIGNED NOT NULL,
                                             `stagiaires_idstagiaires` int(10) UNSIGNED NOT NULL,
                                             `annee_idannee` int(10) UNSIGNED NOT NULL,
                                             PRIMARY KEY (`idreponseslog`),
                                             KEY `fk_reponseslog_stagiaires1_idx` (`stagiaires_idstagiaires`),
                                             KEY `fk_reponseslog_user1` (`user_iduser`),
                                             KEY `fk_reponseslog_annee1` (`annee_idannee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `stagiaires`
--

DROP TABLE IF EXISTS `stagiaires`;
CREATE TABLE IF NOT EXISTS `stagiaires` (
                                            `idstagiaires` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                            `points` int(11) NOT NULL DEFAULT 0,
                                            `nom` varchar(60) NOT NULL,
                                            `prenom` varchar(60) NOT NULL,
                                            `annee_idannee` int(10) UNSIGNED NOT NULL,
                                            PRIMARY KEY (`idstagiaires`),
                                            KEY `fk_stagiaires_annee_idx` (`annee_idannee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
                                      `iduser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                      `username` varchar(80) NOT NULL,
                                      `userpwd` varchar(255) NOT NULL,
                                      `themail` varchar(80) NOT NULL,
                                      `clefunique` varchar(25) NOT NULL,
                                      PRIMARY KEY (`iduser`),
                                      UNIQUE KEY `username_UNIQUE` (`username`),
                                      UNIQUE KEY `themail_UNIQUE` (`themail`),
                                      UNIQUE KEY `clefunique_UNIQUE` (`clefunique`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user_has_annee`
--

DROP TABLE IF EXISTS `user_has_annee`;
CREATE TABLE IF NOT EXISTS `user_has_annee` (
                                                `user_iduser` int(10) UNSIGNED NOT NULL,
                                                `annee_idannee` int(10) UNSIGNED NOT NULL,
                                                PRIMARY KEY (`user_iduser`,`annee_idannee`),
                                                KEY `fk_user_has_annee_annee1_idx` (`annee_idannee`),
                                                KEY `fk_user_has_annee_user1_idx` (`user_iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reponseslog`
--
ALTER TABLE `reponseslog`
    ADD CONSTRAINT `fk_reponseslog_annee1` FOREIGN KEY (`annee_idannee`) REFERENCES `annee` (`idannee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_reponseslog_stagiaires1` FOREIGN KEY (`stagiaires_idstagiaires`) REFERENCES `stagiaires` (`idstagiaires`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_reponseslog_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
    ADD CONSTRAINT `fk_stagiaires_annee` FOREIGN KEY (`annee_idannee`) REFERENCES `annee` (`idannee`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_has_annee`
--
ALTER TABLE `user_has_annee`
    ADD CONSTRAINT `fk_user_has_annee_annee1` FOREIGN KEY (`annee_idannee`) REFERENCES `annee` (`idannee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_user_has_annee_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
