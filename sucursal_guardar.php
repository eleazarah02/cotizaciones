<?php
include 'inc/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_de_sucursal_post = strtoupper($_POST['nombre_sucursal']);
    $direccion_de_sucursal_post = strtoupper($_POST['direccion_sucursal']);
    $telefono_1_post = strtoupper($_POST['telefono_1']);
    $telefono_2_post = strtoupper($_POST['telefono_2']);
    $correo_sucursal_post = strtoupper($_POST['correo_sucursal']);
    $id_sucursal='';
    $id_proveedor=strtoupper($_POST['proveedor']);
    $ins=$con->prepare("INSERT INTO sucursal_prov VALUES(?,?,?,?,?,?,?)");
    $ins->bind_param("iisssss",$id_sucursal,$id_proveedor,$nombre_de_sucursal_post,$direccion_de_sucursal_post,$telefono_1_post,$telefono_2_post,$correo_sucursal_post);
    if($ins->execute()){
        echo "Se ha registrado la sucursal";
    }
    else{
        echo "Error al insertar sucursal";
    }
    $ins->close();
    $con->close();
    /*$nombre_del_proveedor_post = strtoupper($_POST['nombre_del_proveedor']);
    $direccion_del_proveedor_post = strtoupper($_POST['direccion_del_proveedor']);
    $telefono_1_post = strtoupper($_POST['telefono_1']);
    $telefono_2_post = strtoupper($_POST['telefono_2']);
    $correo_proveedor_post = strtoupper($_POST['correo_proveedor']);
    
    $ins=$con->query("INSERT INTO proveedor VALUES(NULL,'$nombre_del_proveedor_post','$direccion_del_proveedor_post','$telefono_1_post','$telefono_2_post','$correo_proveedor_post')");
    if($ins){
        echo "Proveedor Registrado";
    }
    else{
        echo "NO SE HA EFECTUADO EL REGISTRO";
    }
    $con->close();*/
}
