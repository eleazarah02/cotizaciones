<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Iniciar Sesion</title>
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
        <form role="form" id="login-form" method="post" class="form-signin" action="login_verificar.php">
        <div class="h2">
            LOGIN DEL SISTEMA
        </div>
        <div class="form-group">
            <label>Usuario</label>
            <input type="text" class="form-control" id="user" name="user" placeholder="Ingresa nombre de usuario" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa password">
        </div>
            <br>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
    </body>
</html>