<!– PARA EJEMPLO DASC — >

<?php
$id_refaccion_seleccionada = $_GET['refaccion_id'];
$nombre_refaccion_seleccionada = $_GET['refaccion_nombre'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Agregar refacci&oacute;n</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--código que incluye Bootstrap-->
        <?php 
        include'inc/incluye_bootstrap.php';
        include 'inc/conexion.php';
        include 'inc/incluye_datatable_head.php'; 
        ?>
        <!--termina código que incluye Bootstrap-->

    </head>
    <body>
        <!--código que incluye el menú responsivo-->
        <?php include'inc/incluye_menu.php' ?>
        <!--termina código que incluye el menú responsivo-->
        <?php
            //Consulta sin parámetros
                $sel = $con->prepare("SELECT *from proveedor");
                $sel->execute();
                $res = $sel->get_result();
                $row = mysqli_num_rows($res);
            ?>
        <div class="container">
            <div class="jumbotron">
                 <h1>Cotizar con el proveedor</h1>
                <form role="form" id="login-form" method="post" class="form-signin" action="refaccion_proveedor.php">

                    <div class="form-group">
                        <label>ID de la refacci&oacute; seleccionada (<?php echo $nombre_refaccion_seleccionada ?>)</label>
                        <input type="text" id="marca_id" class="form-control" name="refaccion_id" value="<?php echo $id_refaccion_seleccionada ?>" readonly="" 
                               placeholder="<?php echo $nombre_refaccion_seleccionada ?>">
                    </div>

                    <div class="form-group">
                        <label for="proveedor">Nombre del proveedor:</label>
                        <select id="proveedor" name="proveedor" class="form-control">
                            <option value="" disabled selected>SELECCIONE PROVEEDOR</option>
                <?php while ($r = $res->fetch_assoc()) { ?>
                    <option value="<?php echo $r['proveedor_id'] ?>"><?php echo $r['proveedor_nombre'] ?></option>
                <?php } ?>
            </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha de solicitud de precio (requerido)</label>
                        <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud"
                               step="1" value="<?php echo date("Y-m-d"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label >Precio $ (requerido)</label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" placeholder="Precio actual" style="text-transform: uppercase;" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <input type="reset" class="btn btn-danger" value="Limpiar">
                </form>
            </div>
        </div>
    </body>
</html>

