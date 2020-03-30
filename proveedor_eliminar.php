<?php
if(!isset($_GET["proveedor_id"])) exit();
$id = $_GET["proveedor_id"];
 include 'inc/conexion.php';
$sentencia = $con->prepare("DELETE FROM proveedor WHERE proveedor_id = ?;");
$sentencia->bind_param("i",$id);
if($sentencia->execute()){
	header("Location: alerta.php?tipo=exito&operacion=Proveedor eliminado&destino=ver_proveedores.php?");
}
else header("Location: alerta.php?tipo=fracaso&operacion=Proveedor no se elimino&destino=ver_proveedores.php?");
?>