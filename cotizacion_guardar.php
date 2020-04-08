<?php
$mysqli = new mysqli("localhost", "talleradmin", "Eleazar,2020", "tallerbd");
$mysqli2 = new mysqli("localhost", "talleradmin", "Eleazar,2020", "tallerbd");
session_start();
$mensaje = "Sin mensajes";
if (!isset($_SESSION['nombre_cliente']) && !isset($_SESSION['descripcion_coche']) && !isset($_SESSION['fecha_actual'])) {
    header('Location: cotizacion_inicia.php');
} else {
    include 'inc/conexion.php';
    if (!$mysqli->query("CALL guardar_co('" . $_SESSION['nombre_cliente'] . "','" . $_SESSION['descripcion_coche'] . "','" .
$_SESSION['fecha_actual'] . "')")) {
        echo "Falló la llamada procedimiento principal: (" . $mysqli->errno . ") " . $mysqli->error;
    } else {
        $mensaje = "La cotizacion se guardó correctamente";
        session_destroy();
        if (!$mysqli2->query("CALL eliminar_temporal()")) {
            echo "Falló la llamada eliminar temporal: (" . $mysqli2->errno . ") " . $mysqli2->error;
        } else {
           
        }
    }
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
                    <?php echo $mensaje ?>
                </h3>
                <p>
                    <a href="cotizacion_inicia.php" class="btn btn-primary" role="button">ACEPTAR</a>
                </p>
            </div>
        </div>
            <?php include'inc/incluye_datatable_pie.php' ?>
    </body>
</html>