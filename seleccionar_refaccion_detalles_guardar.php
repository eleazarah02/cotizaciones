<?php
include 'inc/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $refaccion_proveedor_id_seleccionado_post = strtoupper($_POST['refaccion_proveedor_id_seleccionado']);
    $incremento_precio_post = strtoupper($_POST['incremento_precio']);
    $numero_piezas_post = strtoupper($_POST['numero_piezas']);
    $mano_obra_post = strtoupper($_POST['mano_obra']);
    $id_cotizacion_detalle_post='';
    $id_cotizacion_post='';
    $ins=$con->prepare("INSERT INTO cotizacion_detalle_temporal VALUES(?,?,?,?,?,?)");
    $ins->bind_param("iiidid",$id_cotizacion_detalle_post,$id_cotizacion_post,$refaccion_proveedor_id_seleccionado_post,$incremento_precio_post,$numero_piezas_post,$mano_obra_post);
    if($ins->execute()){
        header("Location: alerta.php?tipo=exito&operacion=Se ha agregado la cotizacion&destino=cotizacion_en_curso.php");
    }
    else{
        header("Location: alerta.php?tipo=fracaso&operacion=Error al insertar cotizacion&destino=cotizacion_en_curso.php");
    }
    $ins->close();
    $con->close();
}
?>