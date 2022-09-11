-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema coolcolden
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `coolcolden` ;

-- -----------------------------------------------------
-- Schema coolcolden
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `coolcolden` DEFAULT CHARACTER SET utf8mb4 ;
USE `coolcolden` ;

-- -----------------------------------------------------
-- Table `coolcolden`.`annee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coolcolden`.`annee` ;

CREATE TABLE IF NOT EXISTS `coolcolden`.`annee` (
  `idannee` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `section` VARCHAR(60) NOT NULL,
  `annee` CHAR(4) NOT NULL,
  PRIMARY KEY (`idannee`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `coolcolden`.`stagiaires`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coolcolden`.`stagiaires` ;

CREATE TABLE IF NOT EXISTS `coolcolden`.`stagiaires` (
  `idstagiaires` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `points` INT NOT NULL DEFAULT 0,
  `nom` VARCHAR(60) NOT NULL,
  `prenom` VARCHAR(60) NOT NULL,
  `annee_idannee` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idstagiaires`),
  CONSTRAINT `fk_stagiaires_annee`
    FOREIGN KEY (`annee_idannee`)
    REFERENCES `coolcolden`.`annee` (`idannee`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE INDEX `fk_stagiaires_annee_idx` ON `coolcolden`.`stagiaires` (`annee_idannee` ASC);


-- -----------------------------------------------------
-- Table `coolcolden`.`reponseslog`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coolcolden`.`reponseslog` ;

CREATE TABLE IF NOT EXISTS `coolcolden`.`reponseslog` (
  `idreponseslog` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `reponseslogcol` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 => absent\n1 => mal répondu\n2 => bien répondu avec aide ou recherche\n3 => bonne réponse\n',
  `reponseslogdate` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `stagiaires_idstagiaires` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idreponseslog`),
  CONSTRAINT `fk_reponseslog_stagiaires1`
    FOREIGN KEY (`stagiaires_idstagiaires`)
    REFERENCES `coolcolden`.`stagiaires` (`idstagiaires`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE INDEX `fk_reponseslog_stagiaires1_idx` ON `coolcolden`.`reponseslog` (`stagiaires_idstagiaires` ASC);


-- -----------------------------------------------------
-- Table `coolcolden`.`statistiquesannee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coolcolden`.`statistiquesannee` ;

CREATE TABLE IF NOT EXISTS `coolcolden`.`statistiquesannee` (
  `idstatistiquesannee` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nbquestions` INT UNSIGNED NOT NULL DEFAULT 0,
  `nb0` INT UNSIGNED NOT NULL,
  `nb1` INT UNSIGNED NOT NULL,
  `nb2` INT UNSIGNED NOT NULL,
  `nb3` INT UNSIGNED NOT NULL,
  `annee_idannee` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idstatistiquesannee`),
  CONSTRAINT `fk_statistiquesannee_annee1`
    FOREIGN KEY (`annee_idannee`)
    REFERENCES `coolcolden`.`annee` (`idannee`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE INDEX `fk_statistiquesannee_annee1_idx` ON `coolcolden`.`statistiquesannee` (`annee_idannee` ASC);


-- -----------------------------------------------------
-- Table `coolcolden`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coolcolden`.`user` ;

CREATE TABLE IF NOT EXISTS `coolcolden`.`user` (
  `iduser` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(80) NOT NULL,
  `userpwd` VARCHAR(255) NOT NULL,
  `themail` VARCHAR(80) NOT NULL,
  `clefunique` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`iduser`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `username_UNIQUE` ON `coolcolden`.`user` (`username` ASC);

CREATE UNIQUE INDEX `themail_UNIQUE` ON `coolcolden`.`user` (`themail` ASC);

CREATE UNIQUE INDEX `clefunique_UNIQUE` ON `coolcolden`.`user` (`clefunique` ASC);


-- -----------------------------------------------------
-- Table `coolcolden`.`user_has_annee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coolcolden`.`user_has_annee` ;

CREATE TABLE IF NOT EXISTS `coolcolden`.`user_has_annee` (
  `user_iduser` INT UNSIGNED NOT NULL,
  `annee_idannee` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`user_iduser`, `annee_idannee`),
  CONSTRAINT `fk_user_has_annee_user1`
    FOREIGN KEY (`user_iduser`)
    REFERENCES `coolcolden`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_annee_annee1`
    FOREIGN KEY (`annee_idannee`)
    REFERENCES `coolcolden`.`annee` (`idannee`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_user_has_annee_annee1_idx` ON `coolcolden`.`user_has_annee` (`annee_idannee` ASC);

CREATE INDEX `fk_user_has_annee_user1_idx` ON `coolcolden`.`user_has_annee` (`user_iduser` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
