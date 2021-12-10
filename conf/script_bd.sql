-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema sistemabancario
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sistemabancario
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sistemabancario` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema sistemabancario
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sistemabancario
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sistemabancario` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
-- -----------------------------------------------------
-- Schema ds2-7
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ds2-7
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ds2-7` DEFAULT CHARACTER SET utf8 ;
USE `sistemabancario` ;

-- -----------------------------------------------------
-- Table `sistemabancario`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `cpf` VARCHAR(45) NULL,
  `telefone` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemabancario`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`endereco` (
  `cidade` VARCHAR(45) NULL,
  `bairro` VARCHAR(45) NULL,
  `rua` VARCHAR(45) NULL,
  `num` INT NULL,
  `cliente_id` INT NOT NULL,
  INDEX `fk_endereco_cliente_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_endereco_cliente`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `sistemabancario`.`cliente` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemabancario`.`conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`conta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `saldo` DOUBLE NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemabancario`.`tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`tipo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemabancario`.`operacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`operacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `valor` DOUBLE NULL,
  `data` DATE NULL,
  `observacao` VARCHAR(45) NULL,
  `conta_id` INT NOT NULL,
  `tipo_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_operacao_conta1_idx` (`conta_id` ASC),
  INDEX `fk_operacao_tipo1_idx` (`tipo_id` ASC),
  CONSTRAINT `fk_operacao_conta1`
    FOREIGN KEY (`conta_id`)
    REFERENCES `sistemabancario`.`conta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacao_tipo1`
    FOREIGN KEY (`tipo_id`)
    REFERENCES `sistemabancario`.`tipo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemabancario`.`conta_has_cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`conta_has_cliente` (
  `conta_id` INT NOT NULL,
  `cliente_id` INT NOT NULL,
  PRIMARY KEY (`cliente_id`, `conta_id`),
  INDEX `fk_conta_has_cliente_cliente1_idx` (`cliente_id` ASC),
  INDEX `fk_conta_has_cliente_conta1_idx` (`conta_id` ASC),
  CONSTRAINT `fk_conta_has_cliente_conta1`
    FOREIGN KEY (`conta_id`)
    REFERENCES `sistemabancario`.`conta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conta_has_cliente_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `sistemabancario`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `sistemabancario` ;

-- -----------------------------------------------------
-- Table `sistemabancario`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `cpf` VARCHAR(45) NULL DEFAULT NULL,
  `telefone` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sistemabancario`.`conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`conta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sistemabancario`.`cliente_has_conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`cliente_has_conta` (
  `cliente_id` INT NOT NULL,
  `conta_id` INT NOT NULL,
  INDEX `fk_cliente_has_conta_conta1_idx` (`conta_id` ASC),
  INDEX `fk_cliente_has_conta_cliente1_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_cliente_has_conta_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `sistemabancario`.`cliente` (`id`),
  CONSTRAINT `fk_cliente_has_conta_conta1`
    FOREIGN KEY (`conta_id`)
    REFERENCES `sistemabancario`.`conta` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sistemabancario`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`endereco` (
  `cidade` VARCHAR(45) NULL DEFAULT NULL,
  `bairro` VARCHAR(45) NULL DEFAULT NULL,
  `rua` VARCHAR(45) NULL DEFAULT NULL,
  `num` INT NULL DEFAULT NULL,
  `cliente_id` INT NOT NULL,
  INDEX `fk_endereco_cliente_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_endereco_cliente`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `sistemabancario`.`cliente` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sistemabancario`.`tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`tipo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sistemabancario`.`operacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`operacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `valor` DOUBLE NULL DEFAULT NULL,
  `data` DATE NULL DEFAULT NULL,
  `observacao` VARCHAR(45) NULL DEFAULT NULL,
  `conta_id` INT NOT NULL,
  `tipo_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_operacao_conta1_idx` (`conta_id` ASC),
  INDEX `fk_operacao_tipo1_idx` (`tipo_id` ASC),
  CONSTRAINT `fk_operacao_conta1`
    FOREIGN KEY (`conta_id`)
    REFERENCES `sistemabancario`.`conta` (`id`),
  CONSTRAINT `fk_operacao_tipo1`
    FOREIGN KEY (`tipo_id`)
    REFERENCES `sistemabancario`.`tipo` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

USE `ds2-7` ;

-- -----------------------------------------------------
-- Table `ds2-7`.`marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ds2-7`.`marca` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `ds2-7`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ds2-7`.`produto` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NULL DEFAULT NULL,
  `preco` DECIMAL(8,2) NULL DEFAULT NULL,
  `codigodebarra` VARCHAR(45) NULL DEFAULT NULL,
  `marca_codigo` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_produto_marca_idx` (`marca_codigo` ASC),
  CONSTRAINT `fk_produto_marca`
    FOREIGN KEY (`marca_codigo`)
    REFERENCES `ds2-7`.`marca` (`codigo`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `ds2-7`.`venda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ds2-7`.`venda` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `dataVencimento` DATE NULL DEFAULT NULL,
  `dataPagamento` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `ds2-7`.`venda_has_produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ds2-7`.`venda_has_produto` (
  `venda_codigo` INT NOT NULL,
  `produto_codigo` INT NOT NULL,
  `quantidade` INT NOT NULL,
  PRIMARY KEY (`venda_codigo`, `produto_codigo`),
  INDEX `fk_venda_has_produto_produto1_idx` (`produto_codigo` ASC),
  INDEX `fk_venda_has_produto_venda1_idx` (`venda_codigo` ASC),
  CONSTRAINT `fk_venda_has_produto_produto1`
    FOREIGN KEY (`produto_codigo`)
    REFERENCES `ds2-7`.`produto` (`codigo`),
  CONSTRAINT `fk_venda_has_produto_venda1`
    FOREIGN KEY (`venda_codigo`)
    REFERENCES `ds2-7`.`venda` (`codigo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema sistemabancario
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sistemabancario
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sistemabancario` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema sistemabancario
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sistemabancario
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sistemabancario` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
-- -----------------------------------------------------
-- Schema ds2-7
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ds2-7
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ds2-7` DEFAULT CHARACTER SET utf8 ;
USE `sistemabancario` ;

-- -----------------------------------------------------
-- Table `sistemabancario`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `cpf` VARCHAR(45) NULL,
  `telefone` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemabancario`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`endereco` (
  `cidade` VARCHAR(45) NULL,
  `bairro` VARCHAR(45) NULL,
  `rua` VARCHAR(45) NULL,
  `num` INT NULL,
  `cliente_id` INT NOT NULL,
  INDEX `fk_endereco_cliente_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_endereco_cliente`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `sistemabancario`.`cliente` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemabancario`.`conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`conta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `saldo` DOUBLE NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemabancario`.`tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`tipo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemabancario`.`operacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`operacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `valor` DOUBLE NULL,
  `data` DATE NULL,
  `observacao` VARCHAR(45) NULL,
  `conta_id` INT NOT NULL,
  `tipo_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_operacao_conta1_idx` (`conta_id` ASC),
  INDEX `fk_operacao_tipo1_idx` (`tipo_id` ASC),
  CONSTRAINT `fk_operacao_conta1`
    FOREIGN KEY (`conta_id`)
    REFERENCES `sistemabancario`.`conta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacao_tipo1`
    FOREIGN KEY (`tipo_id`)
    REFERENCES `sistemabancario`.`tipo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemabancario`.`conta_has_cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`conta_has_cliente` (
  `conta_id` INT NOT NULL,
  `cliente_id` INT NOT NULL,
  PRIMARY KEY (`cliente_id`, `conta_id`),
  INDEX `fk_conta_has_cliente_cliente1_idx` (`cliente_id` ASC),
  INDEX `fk_conta_has_cliente_conta1_idx` (`conta_id` ASC),
  CONSTRAINT `fk_conta_has_cliente_conta1`
    FOREIGN KEY (`conta_id`)
    REFERENCES `sistemabancario`.`conta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conta_has_cliente_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `sistemabancario`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `sistemabancario` ;

-- -----------------------------------------------------
-- Table `sistemabancario`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `cpf` VARCHAR(45) NULL DEFAULT NULL,
  `telefone` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sistemabancario`.`conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`conta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sistemabancario`.`cliente_has_conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`cliente_has_conta` (
  `cliente_id` INT NOT NULL,
  `conta_id` INT NOT NULL,
  INDEX `fk_cliente_has_conta_conta1_idx` (`conta_id` ASC),
  INDEX `fk_cliente_has_conta_cliente1_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_cliente_has_conta_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `sistemabancario`.`cliente` (`id`),
  CONSTRAINT `fk_cliente_has_conta_conta1`
    FOREIGN KEY (`conta_id`)
    REFERENCES `sistemabancario`.`conta` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sistemabancario`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`endereco` (
  `cidade` VARCHAR(45) NULL DEFAULT NULL,
  `bairro` VARCHAR(45) NULL DEFAULT NULL,
  `rua` VARCHAR(45) NULL DEFAULT NULL,
  `num` INT NULL DEFAULT NULL,
  `cliente_id` INT NOT NULL,
  INDEX `fk_endereco_cliente_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_endereco_cliente`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `sistemabancario`.`cliente` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sistemabancario`.`tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`tipo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sistemabancario`.`operacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistemabancario`.`operacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `valor` DOUBLE NULL DEFAULT NULL,
  `data` DATE NULL DEFAULT NULL,
  `observacao` VARCHAR(45) NULL DEFAULT NULL,
  `conta_id` INT NOT NULL,
  `tipo_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_operacao_conta1_idx` (`conta_id` ASC),
  INDEX `fk_operacao_tipo1_idx` (`tipo_id` ASC),
  CONSTRAINT `fk_operacao_conta1`
    FOREIGN KEY (`conta_id`)
    REFERENCES `sistemabancario`.`conta` (`id`),
  CONSTRAINT `fk_operacao_tipo1`
    FOREIGN KEY (`tipo_id`)
    REFERENCES `sistemabancario`.`tipo` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

USE sistemabancario;
INSERT INTO `tipo` VALUES (1,'Depósito'),(2,'Saque');