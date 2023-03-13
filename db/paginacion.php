<?php

  /**
 * Autor: Rodrigo Chambi Q.
 * Mail:  filvovmax@gmail.com
 * web:   www.gitmedio.com
 * Script para hacer Paginacion en PHP, Mysql y HTML5
 */
$CantidadMostrar=5;
//Conexion  al servidor mysql
$conetar = new mysqli("localhost", "root", "", "laminas");
if ($conetar->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
}else{
                    // Validado de la variable GET
    $compag         =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
    $TotalReg       =$conetar->query("SELECT * FROM laminas");
    //Se divide la cantidad de registro de la BD con la cantidad a mostrar 
    $TotalRegistro  =ceil($TotalReg->num_rows/$CantidadMostrar);
    echo "<b>La cantidad de registro se dividió a: </b>".$TotalRegistro." para mostrar 5 en 5<br>";
    //Consulta SQL
    $consultavistas ="SELECT
                        *
                        FROM
                        laminas
                        ORDER BY
                        id ASC
                        LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
    $consulta=$conetar->query($consultavistas);
         echo "<table><tr><th>Codigo</th><th>Nombre</th><th>Apellido</th></tr>";
    while ($lista=$consulta->fetch_row()) {
         echo "<tr><td>".$lista[0]."</td><td>".$lista[1]."</td><td>".$lista[2]."</td></tr>";
    }
        echo "</table>";
     
    /*Sector de Paginacion */
    
    //Operacion matematica para botón siguiente y atrás 
    $IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
    $DecrementNum =(($compag -1))<1?1:($compag -1);
  
    echo "<ul><li class=\"btn\"><a href=\"?pag=".$DecrementNum."\">◀</a></li>";
    //Se resta y suma con el numero de pag actual con el cantidad de 
    //números  a mostrar
     $Desde=$compag-(ceil($CantidadMostrar/2)-1);
     $Hasta=$compag+(ceil($CantidadMostrar/2)-1);
     
     //Se valida
     $Desde=($Desde<1)?1: $Desde;
     $Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
     //Se muestra los números de paginas
     for($i=$Desde; $i<=$Hasta;$i++){
        //Se valida la paginacion total
        //de registros
        if($i<=$TotalRegistro){
            //Validamos la pag activo
          if($i==$compag){
           echo "<li class=\"active\"><a href=\"?pag=".$i."\">".$i."</a></li>";
          }else {
            echo "<li><a href=\"?pag=".$i."\">".$i."</a></li>";
          }             
        }
     }
    echo "<li class=\"btn\"><a href=\"?pag=".$IncrimentNum."\">▶</a></li></ul>";
  
}