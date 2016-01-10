-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema carnaval2016
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `device`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `device` ;

CREATE TABLE IF NOT EXISTS `device` (
  `iddevice` INT NOT NULL AUTO_INCREMENT,
  `hash_key` VARCHAR(255) NOT NULL,
  `model` VARCHAR(45) NULL,
  `platform` VARCHAR(45) NULL,
  `uuid` VARCHAR(45) NULL,
  `version` VARCHAR(45) NULL,
  `serial` VARCHAR(45) NULL,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` TIMESTAMP NULL,
  `nome` VARCHAR(255) NULL,
  `celular` INT UNSIGNED NULL,
  PRIMARY KEY (`iddevice`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `momo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `momo` ;

CREATE TABLE IF NOT EXISTS `momo` (
  `idmomo` INT NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idmomo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `votos_momo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `votos_momo` ;

CREATE TABLE IF NOT EXISTS `votos_momo` (
  `idmomo` INT NOT NULL AUTO_INCREMENT,
  CONSTRAINT `fk_votos_momo_momo1`
    FOREIGN KEY (`idmomo`)
    REFERENCES `momo` (`idmomo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rainha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rainha` ;

CREATE TABLE IF NOT EXISTS `rainha` (
  `idrainha` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idrainha`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `votos_rainha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `votos_rainha` ;

CREATE TABLE IF NOT EXISTS `votos_rainha` (
  `idrainha` INT NOT NULL AUTO_INCREMENT,
  CONSTRAINT `fk_votos_rainha_rainha1`
    FOREIGN KEY (`idrainha`)
    REFERENCES `rainha` (`idrainha`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `device_votou_momo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `device_votou_momo` ;

CREATE TABLE IF NOT EXISTS `device_votou_momo` (
  `iddevice` INT NOT NULL,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`iddevice`),
  CONSTRAINT `fk_device_votou_momo_device`
    FOREIGN KEY (`iddevice`)
    REFERENCES `device` (`iddevice`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `device_votou_rainha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `device_votou_rainha` ;

CREATE TABLE IF NOT EXISTS `device_votou_rainha` (
  `iddevice` INT NOT NULL,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`iddevice`),
  CONSTRAINT `fk_device_votou_rainha_device1`
    FOREIGN KEY (`iddevice`)
    REFERENCES `device` (`iddevice`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `artista`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `artista` ;

CREATE TABLE IF NOT EXISTS `artista` (
  `idartista` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idartista`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `promocao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `promocao` ;

CREATE TABLE IF NOT EXISTS `promocao` (
  `iddevice` INT NOT NULL,
  `idartista` INT NOT NULL,
  `texto` VARCHAR(200) NOT NULL,
  `escolhido` TINYINT(1) NOT NULL DEFAULT 0,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`iddevice`, `idartista`),
  INDEX `fk_device_has_artista_artista1_idx` (`idartista` ASC),
  INDEX `fk_device_has_artista_device1_idx` (`iddevice` ASC),
  CONSTRAINT `fk_device_has_artista_device1`
    FOREIGN KEY (`iddevice`)
    REFERENCES `device` (`iddevice`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_device_has_artista_artista1`
    FOREIGN KEY (`idartista`)
    REFERENCES `artista` (`idartista`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Placeholder table for view `resultado_momo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `resultado_momo` (`idmomo` INT, `'votos'` INT);

-- -----------------------------------------------------
-- Placeholder table for view `resultado_rainha`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `resultado_rainha` (`idrainha` INT, `'votos'` INT);

-- -----------------------------------------------------
-- Placeholder table for view `vencedores_promocao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vencedores_promocao` (`iddevice` INT, `nome` INT, `celular` INT, `idartista` INT, `'artista'` INT, `texto` INT);

-- -----------------------------------------------------
-- View `resultado_momo`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `resultado_momo` ;
DROP TABLE IF EXISTS `resultado_momo`;
CREATE  OR REPLACE VIEW `resultado_momo` AS
SELECT m.idmomo, COUNT(v.idmomo) AS 'votos'
FROM 
	momo AS m LEFT JOIN votos_momo AS v ON (v.idmomo = m.idmomo)
GROUP BY 
	m.idmomo
ORDER BY 
	votos DESC;

-- -----------------------------------------------------
-- View `resultado_rainha`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `resultado_rainha` ;
DROP TABLE IF EXISTS `resultado_rainha`;
CREATE  OR REPLACE VIEW `resultado_rainha` AS
SELECT r.idrainha, COUNT(v.idrainha) AS 'votos'
FROM 
	rainha AS r LEFT JOIN votos_rainha AS v ON (v.idrainha = r.idrainha)
GROUP BY 
	r.idrainha
ORDER BY 
	votos DESC;

-- -----------------------------------------------------
-- View `vencedores_promocao`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `vencedores_promocao` ;
DROP TABLE IF EXISTS `vencedores_promocao`;
CREATE  OR REPLACE VIEW `vencedores_promocao` AS
SELECT 
	p.iddevice, 
    d.nome, 
    d.celular, 
    p.idartista, 
    a.nome AS 'artista',
    p.texto
FROM
	promocao AS p INNER JOIN device AS d ON(p.iddevice = d.iddevice)
		INNER JOIN artista AS a ON (p.idartista = a.idartista)
WHERE
	p.escolhido = TRUE
ORDER BY
	p.idartista;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `momo`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `momo` (`idmomo`, `nome`) VALUES (1, 'Tierre Uesdle Ribeiro dos Santos');

COMMIT;


-- -----------------------------------------------------
-- Data for table `rainha`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `rainha` (`idrainha`, `nome`) VALUES (1, 'Bárbara Santana Masceno');
INSERT INTO `rainha` (`idrainha`, `nome`) VALUES (2, 'Adelania Nicacio da Silva');
INSERT INTO `rainha` (`idrainha`, `nome`) VALUES (3, 'Cicera Eliene dos Santos Bitencourt');

COMMIT;


-- -----------------------------------------------------
-- Data for table `artista`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `artista` (`idartista`, `nome`) VALUES (1, 'Ivete Sangalo');
INSERT INTO `artista` (`idartista`, `nome`) VALUES (2, 'Saulo Fernandes');
INSERT INTO `artista` (`idartista`, `nome`) VALUES (3, 'Bell Marques');
INSERT INTO `artista` (`idartista`, `nome`) VALUES (4, 'Daniela Mercury');
INSERT INTO `artista` (`idartista`, `nome`) VALUES (5, 'Psirico');
INSERT INTO `artista` (`idartista`, `nome`) VALUES (6, 'Luiz Caldas');
INSERT INTO `artista` (`idartista`, `nome`) VALUES (7, 'Katê');
INSERT INTO `artista` (`idartista`, `nome`) VALUES (8, 'Selva Branca');
INSERT INTO `artista` (`idartista`, `nome`) VALUES (9, 'Armandinho');

COMMIT;

