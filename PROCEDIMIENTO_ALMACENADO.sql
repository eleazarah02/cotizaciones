DROP PROCEDURE IF EXISTS guardar_co;

DELIMITER $$
create procedure guardar_co(
	nombre_cliente varchar(30)
    ,descripcion_coche varchar(30)
    ,fecha_realizacion varchar(20))
BEGIN
	insert into cotizacion values (NULL,nombre_cliente,descripcion_coche,fecha_realizacion,'0');
    
	SELECT @idultimo := max(cotizacion_id) from cotizacion AS id_ultimo;
    
	INSERT INTO cotizacion_detalle 
		SELECT 
			NULL AS algun_id,
			@idultimo AS id_obtenid,
            cotizacion_detalle_temporal.refaccion_proveedor_id_temporal,
            cotizacion_detalle_temporal.cotizacion_detalle_incremento_temporal,
            cotizacion_detalle_temporal.cotizacion_detalle_numero_piezas_temporal,
            cotizacion_detalle_temporal.cotizacion_detalle_mano_obra, (((precio)+(cotizacion_detalle_incremento_temporal))*(cotizacion_detalle_numero_piezas_temporal))+(cotizacion_detalle_mano_obra) AS costo_parcial
			FROM refaccion INNER JOIN ((proveedor INNER JOIN refaccion_proveedor ON proveedor.proveedor_id = refaccion_proveedor.id_proveedor) INNER JOIN cotizacion_detalle_temporal ON refaccion_proveedor.refaccion_proveedor_id = cotizacion_detalle_temporal.refaccion_proveedor_id_temporal) ON refaccion.refaccion_id = refaccion_proveedor.id_refaccion;



    TRUNCATE TABLE cotizacion_detalle_temporal;
END $$
DELIMITER ;

DELIMITER $$
create procedure eliminar_temporal()
BEGIN
    TRUNCATE TABLE cotizacion_detalle_temporal;
END $$
DELIMITER ;

CALL guardar_co("ee","ee","20200406");

insert into cotizacion values ('bb','bb','06042020','0');