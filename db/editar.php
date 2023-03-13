<?php 


    $bd = "laminas";
    $server ="localhost";
    $user = "root";
    $password = "";
    
    $conexion = @mysqli_connect($server, $user, $password, $bd);
    
    if( ! $conexion )   die( "Error de conexion ".mysqli_connect_error() );

    $id = $_REQUEST['id'];
    
    $sql = "SELECT * FROM laminas WHERE id_lamina = '$id'";
    $result = mysqli_query($conexion, $sql);
    $array_user = array();
    while($data = mysqli_fetch_assoc($result)){
        $array_user[] = $data;
    }
    
    echo json_encode($array_user);
 ?>