<?php 


    $bd = "laminas";
    $server ="localhost";
    $user = "root";
    $password = "";
    
    $conexion = @mysqli_connect($server, $user, $password, $bd);
    
    if( ! $conexion )   die( "Error de conexion ".mysqli_connect_error() );

    $titulo = utf8_decode($_POST['titulo']);
    $descripcion = utf8_decode($_POST['descripcion']);
    $editorial = utf8_decode($_POST['editorial']);
    $cantidad = utf8_decode($_POST['cantidad']);
    $precio = utf8_decode($_POST['precio']);
    $ubicacion = utf8_decode($_POST['ubicacion']);
    $sql = "INSERT INTO laminas VALUES (null, '$titulo', '$descripcion', '$editorial', '$cantidad', '$ubicacion', '$precio')";
    $result = mysqli_query($conexion, $sql);
    if(!($result)){
        echo('Error al ingresar la lamina');
    }
    header('Location: ../index.php');

 ?>