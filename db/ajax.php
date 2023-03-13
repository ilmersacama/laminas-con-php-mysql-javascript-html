<?php 


    $bd = "laminas";
    $server ="localhost";
    $user = "root";
    $password = "";
    
    $conexion = @mysqli_connect($server, $user, $password, $bd);
    
    if( ! $conexion )   die( "Error de conexion ".mysqli_connect_error() );

    $buscar = $_REQUEST['buscar'];
    
    $sql = "SELECT * FROM laminas where (titulo LIKE '%$buscar%') OR (descripcion LIKE '%$buscar%') OR (cantidad LIKE '%$buscar%') OR (editorial LIKE '%$buscar%') OR (precio LIKE '%$buscar%') OR (ubicacion LIKE '%$buscar%')";
    //$sql = "SELECT titulo, cantidad, descripcion FROM laminas where titulo LIKE '%$search%'";

    $result = mysqli_query($conexion, $sql);
    $array_user = array();
    while($data = mysqli_fetch_assoc($result)){
        $array_user[] = $data;
    }
    
    echo json_encode($array_user);
