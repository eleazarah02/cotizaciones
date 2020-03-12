<?php
include 'inc/conexion.php';
$refaccion_proveedor_id = "";
$refaccion_id_post = $_POST['refaccion_id'];
$nombre_proveedor_post = ($_POST['proveedor']);
$fecha_solicitud_post = strtoupper($_POST['fecha_solicitud']);
$precio_post=$_POST['precio'];

$sel = $con->prepare("SELECT refaccion_proveedor_id,id_refaccion,id_proveedor FROM refaccion_proveedor where id_proveedor=? AND id_refaccion=?");
$sel->bind_param('ii', $nombre_proveedor_post, $id_refaccion);
$sel->execute();
$res = $sel->get_result();
$row = mysqli_num_rows($res);

if ($row != 0) {
    header("Location: alerta.php?tipo=fracaso&operacion=YA EXISTE LA REFACCIÓN PARA EL PROVEEDOR SELECCIONADO&destino=refacciones_seleccionar_refaccion.php");
    /*echo "YA EXISTE LA REFACCI&Oacute;N " . $nombre_refaccion_post . " PARA LA MARCA SELECCIONADA";
    echo "¿Deseas agregarle un nuevo precio de proveedor?";
    echo "<a href=\"refacciones_proveedores.php?refaccion_id=" . $refaccion_id . "&refaccion_nombre=" . $nombre_refaccion_post . "\" class=\"btn btn-primary\" role=\"button\"> AGREGAR </a>";
    echo "<a href=\"index_refacciones.php\" class=\"btn btn-default\" role=\"button\"> CANCELAR </a>";*/
} else {
    $ins = $con->prepare("INSERT INTO refaccion_proveedor VALUES(?,?,?,?,?)");
    $ins->bind_param("iiidi", $refaccion_proveedor_id, $refaccion_id_post, $nombre_proveedor_post, $fecha_solicitud_post, $precio_post);
    if ($ins->execute()) {
        header("Location: alerta.php?tipo=exito&operacion=Refacción Guardada&destino=refacciones_seleccionar_refaccion.php");
       /* echo "Refacci&oacute;n guardada <br> Ahora debes agregarle un precio de proveedor (si no lo haces puedes provocar p&eacute;rdida de informaci&oacute;n) --";
        echo "Registrado Refaccion";*/
    } else {
        header("Location: alerta.php?tipo=fracaso&operacion=Error al insertar Refacción&destino=refacciones_seleccionar_refaccion.php");
        // echo "Error al insertar Refaccion";
    }
    $ins->close();
    $con->close();
}
?>
