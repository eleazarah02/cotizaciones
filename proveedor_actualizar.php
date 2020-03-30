<!DOCTYPE html>
<html>
    <head>
        <title>Actualizar proveedor</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--código que incluye Bootstrap-->
        <?php include'inc/incluye_bootstrap.php' ?>
        <!--termina código que incluye Bootstrap-->

    </head>
    <body>
        <!--código que incluye el menú responsivo-->
        <?php include'inc/incluye_menu.php' ?>
        <!--termina código que incluye el menú responsivo-->
        <div class="container">
            <div class="jumbotron">
                <?php
                //Consulta con parámetros
                $id = $_GET["proveedor_id"];
                include 'inc/conexion.php';
                $sel = $con->prepare("SELECT *from proveedor where proveedor_id=?");
                $sel->bind_param("i",$id);
                $sel->execute();
                $res = $sel->get_result();
                $r=$res->fetch_assoc()
                ?>
                <h1>Actualizar un Proveedor</h1>
                <form role="form" id="login-form" 
                      method="post" class="form-signin" 
                      action="proveedor_update.php">
                    
                    <div class="h2">
                        DATOS DEL PROVEEDOR
                    </div>
                    <div class="form-group">
                        <label for="id_del_proveedor">Id del Proveedor</label>
                        <input type="text" class="form-control" id="id_del_proveedor" name="id_del_proveedor"
                               value="<?php echo $r['proveedor_id'] ?>" style="text-transform:uppercase;" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nombre_del_proveedor">Nombre del Proveedor (requerido)</label>
                        <input type="text" class="form-control" id="nombre_del_proveedor" name="nombre_del_proveedor"
                               value="<?php echo $r['proveedor_nombre'] ?>" style="text-transform:uppercase;">
                    </div>
                    <div class="form-group">
                        <label>Direcci&oacute;n</label>
                        <input type="text" class="form-control" id="direccion_del_proveedor" name="direccion_del_proveedor"
                               value="<?php echo $r['proveedor_direccion'] ?>" style="text-transform:uppercase;">
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
                               placeholder="Ingresa primer tel&eacute;fono" maxlength="10" onkeyup="this.value=Numeros(this.value)" value="<?php echo $r['proveedor_telefono'] ?>" style="text-transform:uppercase; ">
                    </div>

                    <label>Tel&eacute;fono 2</label>
                    <input type="tel" class="form-control" id="telefono_2" name="telefono_2"
                           placeholder="Ingresa segundo tel&eacute;fono" maxlength="10" onkeyup="this.value=Numeros(this.value)" value="<?php echo $r['proveedor_telefono2'] ?>" style="text-transform:uppercase;">
                    <br>
                    <div class="form-group">
                        <label for="correo_proveedor">Correo electr&oacute;nico</label>

                        <input type="email" class="form-control" id="correo_proveedor" name="correo_proveedor"
                               value="<?php echo $r['proveedor_correo_e'] ?>" style="text-transform:uppercase;">

                    </div>
                    <br>
                    <?php
                        $sel->close();
                        $con->close();
                        ?>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a class="btn btn-danger" href="ver_proveedores.php">Cancelar</a>
                </form>
            </div>
        </div>

    </body>
</html>