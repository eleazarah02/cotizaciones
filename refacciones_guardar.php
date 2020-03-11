<?php
include 'inc/conexion.php';
$refaccion_id = "";
$marca_id_post = $_POST['marca_id'];
$nombre_refaccion_post = strtoupper($_POST['nombre_de_refaccion']);
$descripcion_refaccion_post = strtoupper($_POST['descripcion_de_refaccion']);
$refaccion_imagen="sin imagen";

$sel = $con->prepare("SELECT refaccion_id,marca_id,refaccion_nombre FROM refaccion where marca_id=? AND refaccion_nombre=?");
$sel->bind_param('is', $marca_id_post, $nombre_refaccion_post);
$sel->execute();
$res = $sel->get_result();
$row = mysqli_num_rows($res);

if ($row != 0) {
    header("Location: alerta.php?tipo=fracaso&operacion=YA EXISTE LA REFACCIÓN PARA LA MARCA SELECCIONADA&destino=refacciones_seleccionar_marca.php");
    /*echo "YA EXISTE LA REFACCI&Oacute;N " . $nombre_refaccion_post . " PARA LA MARCA SELECCIONADA";
    echo "¿Deseas agregarle un nuevo precio de proveedor?";
    echo "<a href=\"refacciones_proveedores.php?refaccion_id=" . $refaccion_id . "&refaccion_nombre=" . $nombre_refaccion_post . "\" class=\"btn btn-primary\" role=\"button\"> AGREGAR </a>";
    echo "<a href=\"index_refacciones.php\" class=\"btn btn-default\" role=\"button\"> CANCELAR </a>";*/
} else {
    $ins = $con->prepare("INSERT INTO refaccion VALUES(?,?,?,?,?)");
    $ins->bind_param("iisss", $id, $marca_id_post, $nombre_refaccion_post, $descripcion_refaccion_post, $refaccion_imagen);
    if ($ins->execute()) {
        header("Location: alerta.php?tipo=exito&operacion=Refacción Guardada&destino=refacciones_seleccionar_marca.php");
       /* echo "Refacci&oacute;n guardada <br> Ahora debes agregarle un precio de proveedor (si no lo haces puedes provocar p&eacute;rdida de informaci&oacute;n) --";
        echo "Registrado Refaccion";*/
    } else {
        header("Location: alerta.php?tipo=fracaso&operacion=Error al insertar Refacción&destino=refacciones_seleccionar_marca.php");
        // echo "Error al insertar Refaccion";
    }
    $ins->close();
    $con->close();
}
?>
