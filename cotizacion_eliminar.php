<?php
$error_mensaje = "";
include 'inc/conexion.php';
$mysqli = new mysqli("localhost", "talleradmin", "Eleazar,2020", "tallerbd");
session_start();
if (isset($_SESSION['nombre_cliente']) && isset($_SESSION['descripcion_coche']) && !isset($_SESSION['fecha_actual'])) {
    echo 'La sesion exista, se va adestruir';
}
session_destroy();
if (!$mysqli->query("CALL eliminar_temporal()")) {
    $error_mensaje = "Falló la llamada eliminar temporal: (" . $mysqli->errno . ") " . $mysqli->error;
} else {
   
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Seleccionar Refaccion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--código que incluye Bootstrap-->
        <?php
        include'inc/incluye_bootstrap.php';
        include 'inc/conexion.php';
        include 'inc/incluye_datatable_head.php';
        ?>

    </head>
    <body>
        <!--código que incluye el menú responsivo-->
        <?php include'inc/incluye_menu.php' ?>
        <!--termina código que incluye el menú responsivo-->
        <div class="container">
        	 <div class="jumbotron">
                <h3>
                    <?php
                    if (strcmp($error_mensaje, "") == 0) {
                        echo 'Se elimin&oacute; la cotizaci&oacute;n que estaba en curso';
                    } else {
                        echo 'Se gener&oacute un error, avisar al desarrollador error 201';
                    }
                    ?>
                </h3>
                <p>
                    <a href="cotizacion_inicia.php" class="btn btn-primary" role="button">ACEPTAR</a>
                </p>
            </div>
		</div>
            <?php include'inc/incluye_datatable_pie.php' ?>
    </body>
</html>