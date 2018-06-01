-- MySQL Workbench Synchronization
-- Generated: 2018-05-15 13:58
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Jérémy

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema CaveWine
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS caveWine;
CREATE SCHEMA IF NOT EXISTS CaveWine DEFAULT CHARACTER SET utf8;
USE CaveWine;

CREATE TABLE IF NOT EXISTS users (
  id_users INT(11) NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(45) NULL DEFAULT NULL,
  last_name VARCHAR(45) NULL DEFAULT NULL,
  login VARCHAR(45) NULL DEFAULT NULL,
  password VARCHAR(45) NULL DEFAULT NULL,
  role VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (id_users))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS vintage (
  id_vintage INT(11) NOT NULL AUTO_INCREMENT,
  fk_wine INT(11) NOT NULL,
  year INT(11) NULL DEFAULT NULL,
  qr_code INT(11) NULL DEFAULT NULL,
  price INT(11) NULL DEFAULT NULL,
  date DATETIME NULL DEFAULT now(),  
  PRIMARY KEY (id_vintage, fk_wine),
  INDEX fk_vintage_wine1_idx (fk_wine ASC),
  CONSTRAINT fk_vintage_wine1
    FOREIGN KEY (fk_wine)
    REFERENCES wine (id_wine)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS wine (
  id_wine INT(11) NOT NULL AUTO_INCREMENT,
  fk_typeWine INT(11) NOT NULL,
  name VARCHAR(45) NULL DEFAULT NULL,
  provider VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (id_wine, fk_typeWine),
  INDEX fk_wine_typeWine1_idx (fk_typeWine ASC),
  CONSTRAINT fk_wine_typeWine1
    FOREIGN KEY (fk_typeWine)
    REFERENCES typeWine (id_typeWine)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS typeWine (
  id_typeWine INT(11) NOT NULL AUTO_INCREMENT,
  typeWine VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (id_typeWine))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS movement (
  id_movement INT(11) NOT NULL AUTO_INCREMENT,
  fk_users INT(11) NOT NULL,
  fk_vintage INT(11) NOT NULL,
  nb_bottles INT(11) NULL DEFAULT NULL,
  movement_type INT(11) NULL DEFAULT NULL COMMENT '-1 : out\n0 : inventory\n1 : in',
  provider_other VARCHAR(45) NULL DEFAULT NULL,
  date DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_movement, fk_users, fk_vintage),
  INDEX fk_users_has_vintage_vintage1_idx (fk_vintage ASC),
  INDEX fk_users_has_vintage_users_idx (fk_users ASC),
  CONSTRAINT fk_users_has_vintage_users
    FOREIGN KEY (fk_users)
    REFERENCES users (id_users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_users_has_vintage_vintage1
    FOREIGN KEY (fk_vintage)
    REFERENCES vintage (id_vintage)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO typewine (typeWine) VALUES ('Blanc');
INSERT INTO typewine (typeWine) VALUES ('Rouge');
INSERT INTO typewine (typeWine) VALUES ('Rosé');
INSERT INTO typewine (typeWine) VALUES ('Mousseu');
INSERT INTO typewine (typeWine) VALUES ('Liquoreu');

INSERT INTO wine (fk_typeWine, name, provider) VALUES ('2', 'Merlot', 'Coop');
INSERT INTO wine (fk_typeWine, name, provider) VALUES ('2', 'Porto', 'Portugal');
INSERT INTO wine (fk_typeWine, name, provider) VALUES ('2', 'Chateau', 'Migros');
INSERT INTO wine (fk_typeWine, name, provider) VALUES ('2', 'Chénas', 'Cave');
INSERT INTO wine (fk_typeWine, name, provider) VALUES ('2', 'Chinon', 'Cave');
INSERT INTO wine (fk_typeWine, name, provider) VALUES ('2', 'luberon', 'Cave');
INSERT INTO wine (fk_typeWine, name, provider) VALUES ('2', 'loupiac', 'Cave');

INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('1', '2015', '1', '10');
INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('1', '2012', '2', '10');
INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('2', '2015', '3', '10');
INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('2', '2012', '4', '10');
INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('3', '2015', '5', '10');
INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('3', '2012', '6', '10');
INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('4', '2015', '7', '10');
INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('4', '2012', '8', '10');
INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('5', '2015', '9', '10');
INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('5', '2012', '10', '10');
INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('6', '2015', '11', '10');
INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('6', '2012', '12', '10');
INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('7', '2015', '13', '10');
INSERT INTO vintage (fk_wine, year, qr_code, price) VALUES ('7', '2012', '14', '10');

INSERT INTO users (first_name, last_name, login, password, role) VALUES ('jeremy', 'gfeller', 'jeremy', '123', '1');
INSERT INTO users (login, password, role) VALUES ('louis', '123', '1');

INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '1', '10', '0');
INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '2', '10', '0');
INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '3', '10', '0');
INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '4', '10', '0');
INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '5', '10', '0');
INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '6', '10', '0');
INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '7', '10', '0');
INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '8', '10', '0');
INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '9', '10', '0');
INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '10', '10', '0');
INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '11', '10', '0');
INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '12', '10', '0');
INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '13', '10', '0');
INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '14', '10', '0');
