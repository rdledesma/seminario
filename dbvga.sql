-- MySQL Script generated by MySQL Workbench
-- Sat Sep  1 14:50:43 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema dbvga
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbvga
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbvga` DEFAULT CHARACTER SET utf8 ;
USE `dbvga` ;

-- -----------------------------------------------------
-- Table `dbvga`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbvga`.`categoria` (
  `idcategoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(256) NULL,
  `condicion` TINYINT NOT NULL,
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbvga`.`escala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbvga`.`escala` (
  `idescala` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idescala`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbvga`.`articulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbvga`.`articulo` (
  `idarticulo` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(50) NOT NULL,
  `perecedero` TINYINT NOT NULL,
  `stock` INT NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `imagen` VARCHAR(50) NULL,
  `estado` VARCHAR(20) NOT NULL,
  `precio_venta` DOUBLE NOT NULL,
  `idcategoria` INT NOT NULL,
  `idescala` INT NOT NULL,
  PRIMARY KEY (`idarticulo`),
  INDEX `fk_articulo_categoria_idx` (`idcategoria` ASC),
  INDEX `fk_articulo_escala_idx` (`idescala` ASC),
  CONSTRAINT `fk_articulo_categoria`
    FOREIGN KEY (`idcategoria`)
    REFERENCES `dbvga`.`categoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articulo_escala`
    FOREIGN KEY (`idescala`)
    REFERENCES `dbvga`.`escala` (`idescala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbvga`.`persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbvga`.`persona` (
  `idpersona` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `direccion` VARCHAR(90) NOT NULL,
  `tel` VARCHAR(12) NULL,
  `numero_documento` VARCHAR(15) NULL,
  `email` VARCHAR(45) NULL,
  `saldo` FLOAT NULL,
  `estado` VARCHAR(15) NULL,
  `tipo_persona` VARCHAR(45) NULL DEFAULT 'Cliente',
  PRIMARY KEY (`idpersona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbvga`.`venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbvga`.`venta` (
  `idventa` INT NOT NULL AUTO_INCREMENT,
  `estado` VARCHAR(20) NULL,
  `idpersona` INT NOT NULL,
  `descuento` FLOAT NULL DEFAULT 0,
  `tipo_pago` VARCHAR(45) NULL,
  `factura` VARCHAR(45) NULL,
  `forma_pago` VARCHAR(15) NULL,
  `precioventatotal` FLOAT NULL,
  `total` FLOAT NULL,
  `saldo` DOUBLE NULL,
  `fecha_venta` DATETIME NULL,
  `fecha_registro` DATETIME NULL,
  PRIMARY KEY (`idventa`),
  INDEX `venta_persona_idx` (`idpersona` ASC),
  CONSTRAINT `venta_persona`
    FOREIGN KEY (`idpersona`)
    REFERENCES `dbvga`.`persona` (`idpersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbvga`.`detalleVenta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbvga`.`detalleVenta` (
  `iddetalleVenta` INT NOT NULL AUTO_INCREMENT,
  `idventa` INT NOT NULL,
  `idarticulo` INT NOT NULL,
  `precio_venta` FLOAT NULL,
  `cantidad` INT NULL,
  `subtotal` FLOAT NULL,
  `descuento` DOUBLE NULL,
  PRIMARY KEY (`iddetalleVenta`),
  INDEX `detalle_venta_idx` (`idventa` ASC),
  INDEX `detalle_articulo_idx` (`idarticulo` ASC),
  CONSTRAINT `detalle_venta`
    FOREIGN KEY (`idventa`)
    REFERENCES `dbvga`.`venta` (`idventa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `detalle_articulo`
    FOREIGN KEY (`idarticulo`)
    REFERENCES `dbvga`.`articulo` (`idarticulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbvga`.`precio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbvga`.`precio` (
  `idlista_precio` INT NOT NULL AUTO_INCREMENT,
  `fecha_mod` DATETIME NULL,
  `cantidad_mod` INT NULL,
  PRIMARY KEY (`idlista_precio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbvga`.`stock`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbvga`.`stock` (
  `idstock` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NOT NULL,
  `cant_mod` INT NULL,
  PRIMARY KEY (`idstock`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbvga`.`detalle_precio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbvga`.`detalle_precio` (
  `idprecio` INT NOT NULL AUTO_INCREMENT,
  `idlista_precio` INT NOT NULL,
  `idarticulo` INT NOT NULL,
  `antiguo_precio` FLOAT NULL,
  `nuevo_precio` FLOAT NULL,
  PRIMARY KEY (`idprecio`),
  INDEX `precio_lista_precio_idx` (`idlista_precio` ASC),
  INDEX `precio_articulo_idx` (`idarticulo` ASC),
  CONSTRAINT `precio_lista_precio`
    FOREIGN KEY (`idlista_precio`)
    REFERENCES `dbvga`.`precio` (`idlista_precio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `precio_articulo`
    FOREIGN KEY (`idarticulo`)
    REFERENCES `dbvga`.`articulo` (`idarticulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbvga`.`detalle_stock`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbvga`.`detalle_stock` (
  `iddetalle_stock` INT NOT NULL AUTO_INCREMENT,
  `idarticulo` INT NOT NULL,
  `antigua_cantidad` INT NULL,
  `nueva_cantidad` INT NULL,
  `motivo` VARCHAR(45) NULL,
  `idstock` INT NULL,
  PRIMARY KEY (`iddetalle_stock`),
  INDEX `fk_detalle_stock_idx` (`idstock` ASC),
  INDEX `fk_articulo_detalle_stock_idx` (`idarticulo` ASC),
  CONSTRAINT `fk_detalle_stock`
    FOREIGN KEY (`idstock`)
    REFERENCES `dbvga`.`stock` (`idstock`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articulo_detalle_stock`
    FOREIGN KEY (`idarticulo`)
    REFERENCES `dbvga`.`articulo` (`idarticulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbvga`.`ingreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbvga`.`ingreso` (
  `idingreso` INT NOT NULL AUTO_INCREMENT,
  `fecha_ingreso` DATETIME NULL,
  `fecha_registro` DATETIME NULL,
  `idpersona` INT NULL,
  `nro_factura` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  `total` FLOAT NULL,
  PRIMARY KEY (`idingreso`),
  INDEX `ingreso_persona_idx` (`idpersona` ASC),
  CONSTRAINT `ingreso_persona`
    FOREIGN KEY (`idpersona`)
    REFERENCES `dbvga`.`persona` (`idpersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbvga`.`detalle_ingreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbvga`.`detalle_ingreso` (
  `iddetalle_ingreso` INT NOT NULL AUTO_INCREMENT,
  `idingreso` INT NULL,
  `idarticulo` INT NULL,
  `cantidad` INT NULL,
  `precio_compra` DOUBLE NULL,
  `fecha_vencimiento` DATETIME NULL,
  `precio_venta` DOUBLE NULL,
  `subtotal` DOUBLE NULL,
  PRIMARY KEY (`iddetalle_ingreso`),
  INDEX `ingreso_detalle_idx` (`idingreso` ASC),
  INDEX `ingreso_articulo_idx` (`idarticulo` ASC),
  CONSTRAINT `ingreso_detalle`
    FOREIGN KEY (`idingreso`)
    REFERENCES `dbvga`.`ingreso` (`idingreso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `ingreso_articulo`
    FOREIGN KEY (`idarticulo`)
    REFERENCES `dbvga`.`articulo` (`idarticulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbvga`.`pago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbvga`.`pago` (
  `idpago` INT NOT NULL,
  `idventa` INT NULL,
  `importe` DOUBLE NULL,
  `fecha` DATE NULL,
  `paga_con` DOUBLE NULL,
  `vuelto` DOUBLE NULL,
  PRIMARY KEY (`idpago`),
  INDEX `pago_venta_idx` (`idventa` ASC),
  CONSTRAINT `pago_venta`
    FOREIGN KEY (`idventa`)
    REFERENCES `dbvga`.`venta` (`idventa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `dbvga`;

DELIMITER $$
USE `dbvga`$$
CREATE DEFINER = CURRENT_USER TRIGGER `dbvga`.`detalleVenta_BEFORE_INSERT` BEFORE INSERT ON `detalleVenta` FOR EACH ROW
BEGIN
	UPDATE articulo SET stock = stock - NEw.cantidad
    WHERE idarticulo = NEW.idarticulo;
END$$

USE `dbvga`$$
CREATE DEFINER = CURRENT_USER TRIGGER `dbvga`.`detalle_precio_AFTER_INSERT` AFTER INSERT ON `detalle_precio` FOR EACH ROW
BEGIN
	UPDATE articulo SET precio_venta = NEW.nuevo_precio
    WHERE articulo.idarticulo = NEW.idarticulo;
END$$

USE `dbvga`$$
CREATE DEFINER = CURRENT_USER TRIGGER `dbvga`.`detalle_stock_AFTER_INSERT` AFTER INSERT ON `detalle_stock` FOR EACH ROW
BEGIN
	UPDATE articulo SET stock = NEw.nueva_cantidad
    WHERE idarticulo = NEW.idarticulo;
END$$

USE `dbvga`$$
CREATE DEFINER = CURRENT_USER TRIGGER `dbvga`.`detalle_ingreso_BEFORE_INSERT` BEFORE INSERT ON `detalle_ingreso` FOR EACH ROW
BEGIN
	UPDATE articulos SET stock = stock + NEW.cantidad
    WHERE articulos.idarticulo = NEW.idarticulo;
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
