<<?php 


    $bd = "laminas";
    $server ="localhost";
    $user = "root";
    $password = "";
    
    $conexion = @mysqli_connect($server, $user, $password, $bd);
    
    if( ! $conexion )   die( "Error de conexion ".mysqli_connect_error() );

    $id = $_REQUEST['id'];
    
    $sql = "DELETE FROM laminas where id_lamina = '$id'";
    $result = mysqli_query($conexion, $sql);
    if(!($result)){
        echo('Error al eliminar la lamina');
    }
    header('Location: ../index.php');
 ?>