<?php
session_start();
$nombre_cliente;
if (isset($_SESSION['nombre_cliente']) && isset($_SESSION['descripcion_coche'])) {
    header('Location: cotizacion_en_curso.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Crear cotizaci&oacute;n</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--código que incluye Bootstrap-->
        <?php 
        include'inc/incluye_bootstrap.php';
        include 'inc/conexion.php';
        ?>
        <!--termina código que incluye Bootstrap-->

    </head>
    <body>
        <!--código que incluye el menú responsivo-->
        <?php include'inc/incluye_menu.php' ?>
        <!--termina código que incluye el menú responsivo-->
        <div class="container">
             <div class="jumbotron">
                <form role="form" id="login-form" method="post" class="form-signin" action="cotizacion_guardar_inicia.php">
                    <div class="h2">
                        Iniciar una nueva cotizaci&oacute;n
                    </div>
                    <div class="form-group">
                        <label>Nombre del cliente (requerido)</label>
                        <input type="text" class="form-control" id="nombre_del_cliente" name="nombre_del_cliente"
                       placeholder="Ingresa nombre del cliente" style="text-transform:uppercase;" required>
                    </div>
                    <div class="form-group">
                        <label>Descripcion del coche (requerido)</label>
                        <input type="text" class="form-control" id="descripcion_del_coche" name="descripcion_del_coche"
                       placeholder="Ingresa descripcion general del coche" style="text-transform:uppercase;" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha Actual (requerido)</label>
                        <input type="date" class="form-control" id="fecha_actual" name="fecha_actual" step="1" value="<?php echo date("Y-m-d"); ?>" required>
                    </div>
                    <br>
                        <button type="submit" class="btn btn-primary">Siguiente</button>
                        <input type="reset" class="btn btn-danger" value="Limpiar">
                </form>
            </div>
        </div>

    </body>
</html>