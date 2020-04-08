<?php
session_start();
if (!isset($_SESSION['usuario_tipo']) && !isset($_SESSION['usuario_nombre'])) {
header('Location: login.php');
}
else {
if($_SESSION['usuario_tipo']=="director"){
echo "PUEDES VER LAS TAREAS DE ADMINISTRADOR";
header('Location: index.php');
}
else{
header('Location: operaciones_empleado.php');
}
}