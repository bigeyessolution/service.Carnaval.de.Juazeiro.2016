CREATE TABLE IF NOT EXISTS `carnaval2016`.`pesquisa` (
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

CREATE TABLE IF NOT EXISTS `carnaval2016`.`count_q1` (`'pessimo'` INT, `'ruim'` INT, `'razoável'` INT, `'bom'` INT, `'excelente'` INT);

CREATE TABLE IF NOT EXISTS `carnaval2016`.`count_q2` (`'pessimo'` INT, `'ruim'` INT, `'razoável'` INT, `'bom'` INT, `'excelente'` INT);

CREATE TABLE IF NOT EXISTS `carnaval2016`.`count_q3` (`'pessimo'` INT, `'ruim'` INT, `'razoável'` INT, `'bom'` INT, `'excelente'` INT);

CREATE TABLE IF NOT EXISTS `carnaval2016`.`count_q4` (`q4` INT, `'Total'` INT);

CREATE TABLE IF NOT EXISTS `carnaval2016`.`count_q5` (`'pessimo'` INT, `'ruim'` INT, `'razoável'` INT, `'bom'` INT, `'excelente'` INT);

CREATE TABLE IF NOT EXISTS `carnaval2016`.`count_q6` (`'pessimo'` INT, `'ruim'` INT, `'razoável'` INT, `'bom'` INT, `'excelente'` INT);

CREATE TABLE IF NOT EXISTS `carnaval2016`.`count_q7` (`'pessimo'` INT, `'ruim'` INT, `'razoável'` INT, `'bom'` INT, `'excelente'` INT);

CREATE TABLE IF NOT EXISTS `carnaval2016`.`count_q8` (`'pessimo'` INT, `'ruim'` INT, `'razoável'` INT, `'bom'` INT, `'excelente'` INT);

CREATE TABLE IF NOT EXISTS `carnaval2016`.`count_q9` (`'qui, sex e sab'` INT, `'qua, qui, sex e sab'` INT, `'qui, sex, sab e dom'` INT, `'tanto faz'` INT);

CREATE TABLE IF NOT EXISTS `carnaval2016`.`count_q10` (`'Av Adolfo Viana'` INT, `'Antiga pc do Vaporzinho'` INT, `'Orla 1'` INT, `'tanto faz'` INT);

CREATE TABLE IF NOT EXISTS `carnaval2016`.`count_q11` (`'Ivete Sangalo'` INT, `'Saulo'` INT, `'Bell'` INT, `'Daniela Mercury'` INT, `'Psirico'` INT, `'Luiz Caldas'` INT, `'Armandinho, Dodô e Osmar'` INT, `'Selva Branca'` INT, `'Katê'` INT);

CREATE TABLE IF NOT EXISTS `carnaval2016`.`count_q12` (`q12` INT, `'Total'` INT);
