<?php
	$bd = "laminas";
	$server ="localhost";
	$user = "root";
	$password = "";
	
	$conexion = @mysqli_connect($server, $user, $password, $bd);
	
	if( ! $conexion )	die( "Error de conexion ".mysqli_connect_error() );
	
	$sql = "SELECT titulo, cantidad, descripcion FROM laminas";
	$result = mysqli_query($conexion, $sql);
	$array_user = array();
	while($data = mysqli_fetch_assoc($result)){
		$array_user[] = $data;
	}
	
	echo json_encode($array_user);
	//Creamos el JSON
	//$clientes['clientes'] = $clientes;
	//echo $json_string = json_encode($array_user);
	//echo $json_string;

	//Si queremos crear un archivo json, sería de esta forma:
	
	//$file = 'clientes.json';
	//file_put_contents($file, $json_string);
	

?>