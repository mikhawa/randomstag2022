-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 19 oct. 2022 à 16:27
-- Version du serveur : 10.3.36-MariaDB-0+deb10u2
-- Version de PHP : 7.4.30

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `coolcolden`
--
DROP DATABASE IF EXISTS `coolcolden`;
CREATE DATABASE IF NOT EXISTS `coolcolden` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `coolcolden`;

-- --------------------------------------------------------

--
-- Structure de la table `annee`
--

DROP TABLE IF EXISTS `annee`;
CREATE TABLE `annee` (
                         `idannee` int(10) UNSIGNED NOT NULL,
                         `section` varchar(60) NOT NULL,
                         `annee` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reponseslog`
--

DROP TABLE IF EXISTS `reponseslog`;
CREATE TABLE `reponseslog` (
                               `idreponseslog` bigint(20) UNSIGNED NOT NULL,
                               `reponseslogcol` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 => absent\n1 => mal répondu\n2 => bien répondu avec aide ou recherche\n3 => bonne réponse\n',
                               `reponseslogdate` datetime DEFAULT current_timestamp(),
                               `user_iduser` int(10) UNSIGNED NOT NULL,
                               `stagiaires_idstagiaires` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `stagiaires`
--

DROP TABLE IF EXISTS `stagiaires`;
CREATE TABLE `stagiaires` (
                              `idstagiaires` int(10) UNSIGNED NOT NULL,
                              `points` int(11) NOT NULL DEFAULT 0,
                              `nom` varchar(60) NOT NULL,
                              `prenom` varchar(60) NOT NULL,
                              `annee_idannee` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `statistiquesannee`
--

DROP TABLE IF EXISTS `statistiquesannee`;
CREATE TABLE `statistiquesannee` (
                                     `idstatistiquesannee` int(10) UNSIGNED NOT NULL,
                                     `nbquestions` int(10) UNSIGNED NOT NULL DEFAULT 0,
                                     `nb0` int(10) UNSIGNED NOT NULL,
                                     `nb1` int(10) UNSIGNED NOT NULL,
                                     `nb2` int(10) UNSIGNED NOT NULL,
                                     `nb3` int(10) UNSIGNED NOT NULL,
                                     `annee_idannee` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
                        `iduser` int(10) UNSIGNED NOT NULL,
                        `username` varchar(80) NOT NULL,
                        `userpwd` varchar(255) NOT NULL,
                        `themail` varchar(80) NOT NULL,
                        `clefunique` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user_has_annee`
--

DROP TABLE IF EXISTS `user_has_annee`;
CREATE TABLE `user_has_annee` (
                                  `user_iduser` int(10) UNSIGNED NOT NULL,
                                  `annee_idannee` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annee`
--
ALTER TABLE `annee`
    ADD PRIMARY KEY (`idannee`);

--
-- Index pour la table `reponseslog`
--
ALTER TABLE `reponseslog`
    ADD PRIMARY KEY (`idreponseslog`),
    ADD KEY `fk_reponseslog_stagiaires1_idx` (`stagiaires_idstagiaires`),
    ADD KEY `fk_reponseslog_user1` (`user_iduser`);

--
-- Index pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
    ADD PRIMARY KEY (`idstagiaires`),
    ADD KEY `fk_stagiaires_annee_idx` (`annee_idannee`);

--
-- Index pour la table `statistiquesannee`
--
ALTER TABLE `statistiquesannee`
    ADD PRIMARY KEY (`idstatistiquesannee`),
    ADD KEY `fk_statistiquesannee_annee1_idx` (`annee_idannee`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`iduser`),
    ADD UNIQUE KEY `username_UNIQUE` (`username`),
    ADD UNIQUE KEY `themail_UNIQUE` (`themail`),
    ADD UNIQUE KEY `clefunique_UNIQUE` (`clefunique`);

--
-- Index pour la table `user_has_annee`
--
ALTER TABLE `user_has_annee`
    ADD PRIMARY KEY (`user_iduser`,`annee_idannee`),
    ADD KEY `fk_user_has_annee_annee1_idx` (`annee_idannee`),
    ADD KEY `fk_user_has_annee_user1_idx` (`user_iduser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annee`
--
ALTER TABLE `annee`
    MODIFY `idannee` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reponseslog`
--
ALTER TABLE `reponseslog`
    MODIFY `idreponseslog` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
    MODIFY `idstagiaires` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statistiquesannee`
--
ALTER TABLE `statistiquesannee`
    MODIFY `idstatistiquesannee` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
    MODIFY `iduser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reponseslog`
--
ALTER TABLE `reponseslog`
    ADD CONSTRAINT `fk_reponseslog_stagiaires1` FOREIGN KEY (`stagiaires_idstagiaires`) REFERENCES `stagiaires` (`idstagiaires`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_reponseslog_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
    ADD CONSTRAINT `fk_stagiaires_annee` FOREIGN KEY (`annee_idannee`) REFERENCES `annee` (`idannee`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `statistiquesannee`
--
ALTER TABLE `statistiquesannee`
    ADD CONSTRAINT `fk_statistiquesannee_annee1` FOREIGN KEY (`annee_idannee`) REFERENCES `annee` (`idannee`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_has_annee`
--
ALTER TABLE `user_has_annee`
    ADD CONSTRAINT `fk_user_has_annee_annee1` FOREIGN KEY (`annee_idannee`) REFERENCES `annee` (`idannee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_user_has_annee_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
