<!– PARA EJEMPLO DASC — >
<!DOCTYPE html>
<html>
    <head>
        <title>Registrar Sucursal</title>
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
        <?php
            //Consulta sin parámetros
                $sel = $con->prepare("SELECT *from proveedor");
                $sel->execute();
                $res = $sel->get_result();
                $row = mysqli_num_rows($res);
            ?>

        <!--termina código que incluye el menú responsivo-->
        <div class="container">
            <div class="jumbotron">
                <h1>Registrar una sucursal</h1>
                <form role="form" id="login-form" 
                      method="post" class="form-signin" 
                      action="sucursal_guardar.php">
                    
                    <div class="h2">
                        DATOS DE LA SUCURSAL
                    </div>
                     <div class="form-group">
                        <label for="nombre_del_proveedor">Nombre del proveedor:</label>
                        <select id="proveedor" name="proveedor" class="form-control">
                <?php while ($r = $res->fetch_assoc()) { ?>
                    <option value="<?php echo $r['proveedor_id'] ?>"><?php echo $r['proveedor_nombre'] ?></option>
                <?php } ?>
            </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre_sucursal">Nombre de la Sucursal (requerido)</label>
                        <input type="text" class="form-control" id="nombre_sucursal" name="nombre_sucursal"
                               placeholder="Ingresa nombre de la sucursal" style="text-transform:uppercase;" required>
                    </div>
                    <div class="form-group">
                        <label>Direcci&oacute;n</label>
                        <input type="text" class="form-control" id="direccion_sucursal" name="direccion_sucursal"
                               placeholder="Ingresa direcci&oacute;n de sucursal" style="text-transform:uppercase;">
                    </div>
                    <script type="text/javascript">
                        function Numeros(string){
                        var out = '';
                        var filtro = '1234567890';
                        for (var i=0; i<string.length; i++)
                            if (filtro.indexOf(string.charAt(i)) != -1)
                                out += string.charAt(i);
                            return out;
                        } 
                    </script>

                    <div class="form-group">
                        <label>Tel&eacute;fono 1</label>
                        <input type="tel" class="form-control" id="telefono_1" name="telefono_1"
                               placeholder="Ingresa primer tel&eacute;fono" maxlength="10" onkeyup="this.value=Numeros(this.value)" style="text-transform:uppercase;">
                    </div>

                    <label>Tel&eacute;fono 2</label>
                    <input type="tel" class="form-control" id="telefono_2" name="telefono_2"
                           placeholder="Ingresa segundo tel&eacute;fono" maxlength="10" onkeyup="this.value=Numeros(this.value)" style="text-transform:uppercase;">
                    <br>
                    <div class="form-group">
                        <label for="correo_sucursal">Correo electr&oacute;nico</label>

                        <input type="email" class="form-control" id="correo_sucursal" name="correo_sucursal"
                               placeholder="Ingresa correo electr&oacute;nico" style="text-transform:uppercase;">

                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <input type="reset" class="btn btn-danger" value="Limpiar">
                </form>
            </div>
        </div>

    </body>
</html>

