-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema lista_compras
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema lista_compras
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `lista_compras` DEFAULT CHARACTER SET utf8mb4 ;
USE `lista_compras` ;

-- -----------------------------------------------------
-- Table `lista_compras`.`itens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lista_compras`.`itens` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `comprado` CHAR(1) NULL DEFAULT '0',
  `valor` DECIMAL(10,2) NULL DEFAULT NULL,
  `mostrar` CHAR(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
