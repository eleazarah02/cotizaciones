<!– PARA EJEMPLO DASC — >
<!DOCTYPE html>
<html>
    <head>
        <title>Seleccionar Refacci&oacute;n</title>
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
            <?php
            //Consulta sin parámetros
                $sel = $con->prepare("SELECT *from refaccion");
                $sel->execute();
                $res = $sel->get_result();
                $row = mysqli_num_rows($res);
            ?>
    Elementos devueltos por la consulta: <?php echo $row ?>
 
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <th>ID REFACCION</th>
            <th>NOMBRE REFACCION</th>
        </thead>
        <tfoot>
            <th>ID REFACCION</th>
            <th>NOMBRE REFACCION</th>
        </tfoot>
        <tbody>
            <?php 
                $sel->execute();
                $res = $sel->get_result();
            while ($f = $res->fetch_assoc()) { ?>
            <tr>
            <td><?php echo $f['refaccion_id'] ?></td>
            <td><a href="refacciones_agregar_proveedor.php?refaccion_id=<?php echo $f['refaccion_id']?>&refaccion_nombre=<?php echo $f['refaccion_nombre'] ?>"><?php echo $f['refaccion_nombre'] ?></a>
            </td>
            </tr>
            <?php
                }
                $sel->close();
                $con->close();
            ?>
        </tbody>
    </table>

    </div>
</div>
            <?php include'inc/incluye_datatable_pie.php' ?>
    </body>
</html>

