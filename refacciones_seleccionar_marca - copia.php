<!– PARA EJEMPLO DASC — >
<!DOCTYPE html>
<html>
    <head>
        <title>Seleccionar una Marca para agregar nueva Refacci&oacute;n</title>
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
                $sel = $con->prepare("SELECT *from marca");
                $sel->execute();
                $res = $sel->get_result();
                $row = mysqli_num_rows($res);
            ?>
        Selecciona marca: 
            <select class="form-control">
                <?php while ($r = $res->fetch_assoc()) { ?>
                    <option <?php echo $r['marca_id'] ?>><?php echo $r['marca_nombre'] ?></option>
                <?php } ?>
            </select>
    Elementos devueltos por la consulta: <?php echo $row ?>
 
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <th>ID MARCA</th>
            <th>NOMBRE MARCA</th>
        </thead>
        <tfoot>
            <th>ID MARCA</th>
            <th>NOMBRE MARCA</th>
        </tfoot>
        <tbody>
            <?php 
                $sel->execute();
                $res = $sel->get_result();
            while ($f = $res->fetch_assoc()) { ?>
            <tr>
            <td><?php echo $f['marca_id'] ?></td>
            <td><a href="refacciones_agregar.php?marca_id=<?php echo $f['marca_id']?>&marca_nombre=<?php echo $f['marca_nombre'] ?>"><?php echo $f['marca_nombre'] ?></a>
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
