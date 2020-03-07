/*CREACION DE LA BASE DE DATOS Y LA DIRECTIVA PARA USARLA*/
CREATE DATABASE tallerbd;
USE tallerbd;
/*TABLA DE PROVEEDORES*/
CREATE TABLE `tallerbd`.`proveedor` (
  `proveedor_id` INT NOT NULL AUTO_INCREMENT,
  `proveedor_nombre` VARCHAR(100) NOT NULL DEFAULT 'nombre sin asignar',
  `proveedor_direccion` VARCHAR(255) NULL DEFAULT 'direccion sin asignar',
  `proveedor_telefono` VARCHAR(45) NULL DEFAULT 'telefono sin asignar',
  `proveedor_telefono2` VARCHAR(45) NULL DEFAULT 'telefono sin asignar',
  `proveedor_correo_e` VARCHAR(45) NULL DEFAULT 'email sin asignar',
  PRIMARY KEY (`proveedor_id`),
  UNIQUE INDEX `proveedor_id_UNIQUE` (`proveedor_id` ASC));
  
ALTER TABLE `tallerbd`.`proveedor` 
ADD UNIQUE INDEX `proveedor_nombre_UNIQUE` (`proveedor_nombre` ASC);

/*TABLA DE MARCAS*/
CREATE TABLE `tallerbd`.`marca` (
  `marca_id` INT NOT NULL AUTO_INCREMENT,
  `marca_nombre` VARCHAR(20) NULL,
  PRIMARY KEY (`marca_id`),
  UNIQUE INDEX `marca_id_UNIQUE` (`marca_id` ASC),
  UNIQUE INDEX `marca_nombre_UNIQUE` (`marca_nombre` ASC));

/*TABLA SUCURSALES*/
CREATE TABLE `tallerbd`.`sucursal_prov` (
  `sucursal_id` INT NOT NULL AUTO_INCREMENT,
  `proveedor_id` INT NOT NULL,
  `sucursal_nombre` VARCHAR(100) NOT NULL DEFAULT 'Sin asignar',
  `sucursal_direccion` VARCHAR(255) NULL DEFAULT 'Sin asignar',
  `sucursal_telefono` VARCHAR(45) NULL DEFAULT 'Sin asignar',
  `sucursal_telefono_2` VARCHAR(45) NULL DEFAULT 'Sin asignar',
  `sucursal_correo` VARCHAR(45) NULL DEFAULT 'Sin asignar',
  PRIMARY KEY (`sucursal_id`),
  UNIQUE INDEX `sucursal_id_UNIQUE` (`sucursal_id` ASC),
  INDEX `proveedor_id_idx` (`proveedor_id` ASC),
  CONSTRAINT `fk_proveedor_id`
    FOREIGN KEY (`proveedor_id`)
    REFERENCES `tallerbd`.`proveedor` (`proveedor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
   /*TABLA REFACCION*/
    CREATE TABLE `tallerbd`.`refaccion` (
  `refaccion_id` INT NOT NULL AUTO_INCREMENT,
  `marca_id` INT NOT NULL,
  `refaccion_nombre` VARCHAR(255) NOT NULL,
  `refaccion_descripcion` VARCHAR(255) NULL,
  `refaccion_imagen` VARCHAR(255) NULL,
  PRIMARY KEY (`refaccion_id`),
  UNIQUE INDEX `refaccion_id_UNIQUE` (`refaccion_id` ASC),
  INDEX `fk_marca_id_idx` (`marca_id` ASC),
  CONSTRAINT `fk_marca_id`
    FOREIGN KEY (`marca_id`)
    REFERENCES `tallerbd`.`marca` (`marca_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
       /*TABLA REFACCION_PROVEEDOR*/
    CREATE TABLE `tallerbd`.`refaccion_proveedor` (
  `refaccion_proveedor_id` INT NOT NULL AUTO_INCREMENT,
  `id_refaccion` INT NOT NULL,
  `id_proveedor` INT NOT NULL,
  `fecha_solicitud` DATE NOT NULL,
  `precio` DECIMAL(8,2) NULL,
  PRIMARY KEY (`refaccion_proveedor_id`),
  UNIQUE INDEX `refaccion_proveedor_id_UNIQUE` (`refaccion_proveedor_id` ASC),
  INDEX `fk_id_refaccion_idx` (`id_refaccion` ASC),
  INDEX `fk_id_proveedor_idx` (`id_proveedor` ASC),
  CONSTRAINT `fk_id_refaccion`
    FOREIGN KEY (`id_refaccion`)
    REFERENCES `tallerbd`.`refaccion` (`refaccion_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_proveedor`
    FOREIGN KEY (`id_proveedor`)
    REFERENCES `tallerbd`.`proveedor` (`proveedor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
       /*TABLA COTIZACION*/
    CREATE TABLE `tallerbd`.`cotizacion` (
  `cotizacion_id` INT NOT NULL AUTO_INCREMENT,
  `cotizacion_nombre_cliente` VARCHAR(45) NOT NULL,
  `cotizacion_descripcion_coche` VARCHAR(45) NOT NULL,
  `cotizacion_fecha` VARCHAR(45) NOT NULL,
  `cotizacion_costo_total` DECIMAL(8,2) NULL,
  PRIMARY KEY (`cotizacion_id`),
  UNIQUE INDEX `cotizacion_id_UNIQUE` (`cotizacion_id` ASC));
/*TABLA COTIZACION_DETALLE*/
CREATE TABLE `tallerbd`.`cotizacion_detalle` (
  `cotizacion_detalle_id` INT NOT NULL AUTO_INCREMENT,
  `cotizacion_id` INT NOT NULL,
  `refaccion_proveedor_id` INT NOT NULL,
  `cotizacion_detalle_incremento` DECIMAL(8,2) NOT NULL,
  `cotizacion_detalle_numero_piezas` INT NOT NULL,
  `cotizacion_detalle_mano_obra` DECIMAL(8,2) NOT NULL,
  `cotizacion_detalle_costo_parcial` DECIMAL(8,2) NULL,
  PRIMARY KEY (`cotizacion_detalle_id`),
  UNIQUE INDEX `cotizacion_detalle_id_UNIQUE` (`cotizacion_detalle_id` ASC),
  INDEX `fk_cotizacion_id_idx` (`cotizacion_id` ASC),
  INDEX `fk_refaccion_proveedor_id_idx` (`refaccion_proveedor_id` ASC),
  CONSTRAINT `fk_cotizacion_id`
    FOREIGN KEY (`cotizacion_id`)
    REFERENCES `tallerbd`.`cotizacion` (`cotizacion_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_refaccion_proveedor_id`
    FOREIGN KEY (`refaccion_proveedor_id`)
    REFERENCES `tallerbd`.`refaccion_proveedor` (`refaccion_proveedor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

/*TABLA TEMPORAL la llave foranea necesita otro nombre*/
CREATE TABLE `tallerbd`.`cotizacion_detalle_temporal` (
  `cotizacion_detalle_temporal_id` INT NOT NULL,
  `cotizacion_id_temporal` INT NOT NULL,
  `refaccion_proveedor_id_temporal` INT NOT NULL,
  `cotizacion_detalle_incremento_temporal` DECIMAL(8,2) NOT NULL,
  `cotizacion_detalle_numero_piezas_temporal` INT NOT NULL,
  `cotizacion_detalle_mano_obra` DECIMAL(8,2) NOT NULL,
  PRIMARY KEY (`cotizacion_detalle_temporal_id`),
  UNIQUE INDEX `cotizacion_detalle_temporal_id_UNIQUE` (`cotizacion_detalle_temporal_id` ASC),
  INDEX `pk_refaccion_proveedor_id_temporal_idx` (`refaccion_proveedor_id_temporal` ASC),
  CONSTRAINT `pk_refaccion_proveedor_id_temporal`
    FOREIGN KEY (`refaccion_proveedor_id_temporal`)
    REFERENCES `tallerbd`.`refaccion_proveedor` (`refaccion_proveedor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
    /*ME FALTO  =) */
    ALTER TABLE `tallerbd`.`cotizacion_detalle_temporal` 
CHANGE COLUMN `cotizacion_detalle_temporal_id` `cotizacion_detalle_temporal_id` INT(11) NOT NULL AUTO_INCREMENT ;


CREATE TABLE `tallerbd`.`usuarios` ( `usuarios_id` INT NOT NULL AUTO_INCREMENT , `usuarios_nombre` VARCHAR(50) NOT NULL , `usuarios_pass` VARCHAR(50) NOT NULL , `usuarios_tipo` VARCHAR(50) NOT NULL , PRIMARY KEY (`usuarios_id`)) ENGINE = InnoDB;

