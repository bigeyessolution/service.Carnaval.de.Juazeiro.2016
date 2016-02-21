DROP TABLE IF EXISTS `pesquisa` ;

CREATE TABLE IF NOT EXISTS `pesquisa` (
  `idpesquisa` INT NOT NULL AUTO_INCREMENT,
  `q1` INT NULL DEFAULT 0,
  `q2` INT NULL DEFAULT 0,
  `q3` INT NULL DEFAULT 0,
  `q4` VARCHAR(150) NULL,
  `q5` INT NULL DEFAULT 0,
  `q6` INT NULL DEFAULT 0,
  `q7` INT NULL DEFAULT 0,
  `q8` INT NULL DEFAULT 0,
  `q9a` INT NULL DEFAULT 0,
  `q9b` TINYINT(1) NULL DEFAULT 0,
  `q9c` TINYINT(1) NULL DEFAULT 0,
  `q9d` TINYINT(1) NULL DEFAULT 0,
  `q10a` TINYINT(1) NULL DEFAULT 0,
  `q10b` TINYINT(1) NULL DEFAULT 0,
  `q10c` TINYINT(1) NULL DEFAULT 0,
  `q10d` TINYINT(1) NULL DEFAULT 0,
  `q11a` TINYINT(1) NULL DEFAULT 0,
  `q11b` TINYINT(1) NULL DEFAULT 0,
  `q11c` TINYINT(1) NULL DEFAULT 0,
  `q11d` TINYINT(1) NULL DEFAULT 0,
  `q11e` TINYINT(1) NULL DEFAULT 0,
  `q11f` TINYINT(1) NULL DEFAULT 0,
  `q11g` TINYINT(1) NULL DEFAULT 0,
  `q11h` TINYINT(1) NULL DEFAULT 0,
  `q11i` TINYINT(1) NULL DEFAULT 0,
  `q12` VARCHAR(150) NULL,
  PRIMARY KEY (`idpesquisa`))
ENGINE = InnoDB;

DROP VIEW IF EXISTS `count_q1` ;
CREATE  OR REPLACE VIEW `count_q1` AS
SELECT 
	(SELECT count(q1) FROM pesquisa WHERE q1=1) as 'pessimo',
    (SELECT count(q1) FROM pesquisa WHERE q1=2) as 'ruim',
    (SELECT count(q1) FROM pesquisa WHERE q1=3) as 'razoável',
    (SELECT count(q1) FROM pesquisa WHERE q1=4) as 'bom',
    (SELECT count(q1) FROM pesquisa WHERE q1=5) as 'excelente'
;

DROP VIEW IF EXISTS `count_q2` ;
CREATE  OR REPLACE VIEW `count_q2` AS
SELECT 
	(SELECT count(q2) FROM pesquisa WHERE q2=1) as 'pessimo',
    (SELECT count(q2) FROM pesquisa WHERE q2=2) as 'ruim',
    (SELECT count(q2) FROM pesquisa WHERE q2=3) as 'razoável',
    (SELECT count(q2) FROM pesquisa WHERE q2=4) as 'bom',
    (SELECT count(q2) FROM pesquisa WHERE q2=5) as 'excelente'
;

DROP VIEW IF EXISTS `count_q3` ;
CREATE  OR REPLACE VIEW `count_q3` AS
SELECT 
	(SELECT count(q3) FROM pesquisa WHERE q3=1) as 'pessimo',
    (SELECT count(q3) FROM pesquisa WHERE q3=2) as 'ruim',
    (SELECT count(q3) FROM pesquisa WHERE q3=3) as 'razoável',
    (SELECT count(q3) FROM pesquisa WHERE q3=4) as 'bom',
    (SELECT count(q3) FROM pesquisa WHERE q3=5) as 'excelente'
;

DROP VIEW IF EXISTS `count_q4` ;
CREATE  OR REPLACE VIEW `count_q4` AS
SELECT DISTINCT q4, count(q4) as 'Total' FROM pesquisa;

DROP VIEW IF EXISTS `count_q5` ;
CREATE  OR REPLACE VIEW `count_q5` AS
SELECT 
	(SELECT count(q5) FROM pesquisa WHERE q5=1) as 'pessimo',
    (SELECT count(q5) FROM pesquisa WHERE q5=2) as 'ruim',
    (SELECT count(q5) FROM pesquisa WHERE q5=3) as 'razoável',
    (SELECT count(q5) FROM pesquisa WHERE q5=4) as 'bom',
    (SELECT count(q5) FROM pesquisa WHERE q5=5) as 'excelente'
;

DROP VIEW IF EXISTS `count_q6` ;
CREATE  OR REPLACE VIEW `count_q6` AS
SELECT 
	(SELECT count(q6) FROM pesquisa WHERE q6=1) as 'pessimo',
    (SELECT count(q6) FROM pesquisa WHERE q6=2) as 'ruim',
    (SELECT count(q6) FROM pesquisa WHERE q6=3) as 'razoável',
    (SELECT count(q6) FROM pesquisa WHERE q6=4) as 'bom',
    (SELECT count(q6) FROM pesquisa WHERE q6=5) as 'excelente'
;

DROP VIEW IF EXISTS `count_q7` ;
CREATE  OR REPLACE VIEW `count_q7` AS
SELECT 
	(SELECT count(q7) FROM pesquisa WHERE q7=1) as 'pessimo',
    (SELECT count(q7) FROM pesquisa WHERE q7=2) as 'ruim',
    (SELECT count(q7) FROM pesquisa WHERE q7=3) as 'razoável',
    (SELECT count(q7) FROM pesquisa WHERE q7=4) as 'bom',
    (SELECT count(q7) FROM pesquisa WHERE q7=5) as 'excelente'
;

DROP VIEW IF EXISTS `count_q8` ;
CREATE  OR REPLACE VIEW `count_q8` AS
SELECT 
	(SELECT count(q8) FROM pesquisa WHERE q8=1) as 'pessimo',
    (SELECT count(q8) FROM pesquisa WHERE q8=2) as 'ruim',
    (SELECT count(q8) FROM pesquisa WHERE q8=3) as 'razoável',
    (SELECT count(q8) FROM pesquisa WHERE q8=4) as 'bom',
    (SELECT count(q8) FROM pesquisa WHERE q8=5) as 'excelente'
;

DROP VIEW IF EXISTS `count_q9` ;
CREATE  OR REPLACE VIEW `count_q9` AS
SELECT 
	(SELECT count(q9a) FROM pesquisa WHERE q9a=1) as 'qui, sex e sab',
    (SELECT count(q9b) FROM pesquisa WHERE q9b=1) as 'qua, qui, sex e sab',
    (SELECT count(q9c) FROM pesquisa WHERE q9c=1) as 'qui, sex, sab e dom',
    (SELECT count(q9d) FROM pesquisa WHERE q9d=1) as 'tanto faz'
;

DROP VIEW IF EXISTS `count_q10` ;
CREATE  OR REPLACE VIEW `count_q10` AS
SELECT 
	(SELECT count(q10a) FROM pesquisa WHERE q10a=1) as 'Av Adolfo Viana',
    (SELECT count(q10b) FROM pesquisa WHERE q10b=1) as 'Antiga pc do Vaporzinho',
    (SELECT count(q10c) FROM pesquisa WHERE q10c=1) as 'Orla 1',
    (SELECT count(q10d) FROM pesquisa WHERE q10d=1) as 'tanto faz'
;

DROP VIEW IF EXISTS `count_q11` ;
CREATE  OR REPLACE VIEW `count_q11` AS
SELECT 
	(SELECT count(q11a) FROM pesquisa WHERE q11a=1) as 'Ivete Sangalo',
    (SELECT count(q11b) FROM pesquisa WHERE q11b=1) as 'Saulo',
    (SELECT count(q11c) FROM pesquisa WHERE q11c=1) as 'Bell',
    (SELECT count(q11d) FROM pesquisa WHERE q11d=1) as 'Daniela Mercury',
    (SELECT count(q11e) FROM pesquisa WHERE q11e=1) as 'Psirico',
    (SELECT count(q11f) FROM pesquisa WHERE q11f=1) as 'Luiz Caldas',
    (SELECT count(q11g) FROM pesquisa WHERE q11g=1) as 'Armandinho, Dodô e Osmar',
    (SELECT count(q11h) FROM pesquisa WHERE q11h=1) as 'Selva Branca',
    (SELECT count(q11i) FROM pesquisa WHERE q11i=1) as 'Katê'
;

DROP VIEW IF EXISTS `count_q12` ;
CREATE  OR REPLACE VIEW `count_q12` AS
SELECT DISTINCT q12, count(q12) as 'Total' FROM pesquisa;