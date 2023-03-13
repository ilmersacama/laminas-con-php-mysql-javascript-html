<?php 


    $bd = "laminas";
    $server ="localhost";
    $user = "root";
    $password = "";
    
    $conexion = @mysqli_connect($server, $user, $password, $bd);
    
    if( ! $conexion )   die( "Error de conexion ".mysqli_connect_error() );
    //  capturando parametros del formulario
    $id = trim($_POST['id']);
    $titulo = mysql_real_escape_string($_REQUEST['titulo']);
    $descripcion = mysql_real_escape_string($_REQUEST['descripcion']);
    $editorial = mysql_real_escape_string($_REQUEST['editorial']);
    $cantidad = mysql_real_escape_string($_REQUEST['cantidad']);
    $precio = mysql_real_escape_string($_REQUEST['precio']);
    $ubicacion = mysql_real_escape_string($_REQUEST['ubicacion']);
    $sql = "UPDATE laminas SET ('$titulo', '$descripcion', '$editorial', '$cantidad', '$ubicacion', '$precio') WHERE id_lamina = '$id'";
    $result = mysqli_query($conexion, $sql);
    if(!($result)){
        echo('Error al actualizar la lamina');
    }
    header('Location: ../index.php');

 ?>