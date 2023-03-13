<?php 
     
    require_once 'db/class.AutoPagination.php';
 
    $conexion = new mysqli( '127.0.0.1', 'root', '', 'laminas');
    // $conexion->query("SET NAMES 'utf8'");
    $conexion->set_charset('utf8');
 
    $pagina       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
    $enlaces      = ( isset( $_GET['enlaces'] ) ) ? $_GET['enlaces'] : 5;
    $consulta      = "SELECT * FROM laminas";
    
    $paginar  = new Paginar($conexion, $consulta);
    $resultados    = $paginar->getDatos($pagina);
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8">
   <title>Laminas SRL</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="shortcut icon" href="images/favicon.ico" />
   <link rel="stylesheet" href="css/bootstrap.min.css" />
   <script type="text/javascript" src="js/jquery.min.js"></script>
   <script type="text/javascript" src="js/bootstrap.min.js"></script>
   <style type="text/css"> 
		a:link { 
			text-decoration:none; 
			color: white;
		} 
	</style>
</head>
<body>

	<nav class="navbar navbar-dark bg-primary">
	  <a class="navbar-dark">Navbar</a>
	  <form class="form-inline pull-right" id="buscar">
	    <input class="form-control mr-sm-2" type="search" id="search" value="" placeholder="Buscar" aria-label="Search">
	    <button class="btn btn-success my-2 my-sm-0" type="submit"><span class="glyphicon glyphicon-search">Buscar</button>
	  </form>
	</nav>
    <div class="container">
	   <div class="col-md-12">
	         <button type="button" class="btn btn-success btn-lg pull-right" data-toggle="modal" data-target="#crearLamina"><span class="glyphicon glyphicon-plus"></span>Añadir Lámina</button>
	      
	   </div>
	</div>
    <hr>
   	<div class="container">
   		<div class="row">
		   	<div class="col-md-12" id="lista-general">
		   		<div class="panel panel-primary">
					<div class="panel-heading">Lista de todas las láminas</div>
					<div class="panel-body">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre de Lámina</th>
									<th>Descripcion</th>
									<th>Editorial</th>
									<th>Cantidad</th>
									<th>Precio Unidad</th>
									<th>Ubicación</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody><?php for( $i = 0; $i < count($resultados->datos); $i++ ):  ?>
								<tr>
									<td class=""><?= $i+1; ?></td>
									<td class="active"><?= $resultados->datos[$i]['titulo']; ?></td>
									<td class="success"><?= $resultados->datos[$i]['descripcion']; ?></td>
									<td class="success"><?= $resultados->datos[$i]['editorial']; ?></td>
									<td class="success"><?= $resultados->datos[$i]['cantidad']; ?></td>
									<td class="success"><?= $resultados->datos[$i]['precio']; ?></td>
									<td class="success"><?= $resultados->datos[$i]['ubicacion']; ?></td>
										<td>&nbsp;<span class="label label-default">Ver</span>
										<span class="label label-warning hidden-sm"><a href="db/editar.php?id=<?= $resultados->datos[$i]['id_lamina']; ?>" data-toggle="modal" data-target="#editLamina">Editar</a></span>
					                    <span class="label label-danger hidden-sm"><a href="db/eliminar.php?id=<?= $resultados->datos[$i]['id_lamina']; ?>" class="">Eliminar</a></span>
					                     
		                     		</td>
								</tr><?php endfor; ?>
							</tbody>
							</table>
						<ul class="pagination">
	                        <?php echo $paginar->crearLinks( $enlaces); ?>
	                    </ul>
					</div>
					
				</div>
		   	</div>
		   </div>
		   <div class="row" id="ajax" style="font-size:30px;">
		   	<div class="col-md-12">
		   		<div class="panel panel-primary">
					<div class="panel-heading">Mostrar Laminas</div>
					<div class="panel-body">
						<ul class="list-group" id="lista-search">
						  
						</ul>
					</div>
				</div>
		   	</div>
   		</div>
  	</div>

  	<!-- Modal para crear lamina -->
	<form class="form-horizontal" role="form" name="modal" action="db/crear.php" method="post">
	   <div class="modal fade" id="crearLamina">
	      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info">
	         <div class="modal-content">
	            <div class="modal-header">
	               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	               <h4 class="modal-title">
	                  <span class="glyphicon glyphicon-user"></span>
	                  &nbsp; Nueva Lámina
	               </h4>
	               
	            </div>
	            <div class="modal-body">
	               <div class="form-group">
	                  <label class="col-sm-2 control-label">Nombre Lámina</label>
	                  <div class="col-sm-10">
	                     <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Nombre" autocomplete="off" required=""/>
	                  </div>
	               </div>
	               
	               <div class="form-group">
	                  <label class="col-sm-2 control-label">Descripción</label>
	                  <div class="col-sm-10">
	                  	<textarea class="form-control" id="descripcion" name="descripcion" rows="2" placeholder="Descripción" required></textarea>
	                  </div>
	               </div>
	               <div class="form-group">
	                  <label class="col-sm-2 control-label">Editorial</label>
	                  <div class="col-sm-10">
	                     <input type="text" name="editorial" class="form-control" placeholder="Editorial" autocomplete="off" required=""/>
	                  </div>
	               </div>
	               <div class="form-group">
	                  <label class="col-sm-2 control-label">Cantidad</label>
	                  <div class="col-sm-10">
	                     <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" required="" value="0"/>
	                  </div>
	               </div>
	               <div class="form-group">
	                  <label class="col-sm-2 control-label">Precio (Bs)</label>
	                  <div class="col-sm-10">
	                     <input type="number" name="precio" class="form-control" placeholder="Precio" required="" value="0"/>
	                  </div>
	               </div>
	               <div class="form-group">
	                  <label class="col-sm-2 control-label">Ubicación</label>
	                  <div class="col-sm-10">
	                     <input type="text" name="ubicacion" class="form-control" placeholder="Caja x - Fila x - Columna x" required="" value="Caja # "/>
	                  </div>
	               </div>
	            </div>
	            <div class="modal-footer">
	               <button class="btn btn-sm btn-primary" type="submit">
	                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
	               </button>
	            </div>
	         </div>
	      </div>
	   </div>
	</form>

	<!-- Modal para editar lamina -->
	<form class="form-horizontal" role="form" name="modal" action="db/actualizar.php" method="post">
	   <div class="modal fade" id="editLamina">
	      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info">
	         <div class="modal-content">
	            <div class="modal-header">
	               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	               <h4 class="modal-title">
	                  <span class="glyphicon glyphicon-user"></span>
	                  &nbsp; Nueva Lámina
	               </h4>
	               
	            </div>
	            <div class="modal-body">
	               <div class="form-group">
	                  <label class="col-sm-2 control-label">Nombre Lámina</label>
	                  <div class="col-sm-10">
	                     <input type="text" name="titulo" class="form-control" placeholder="Nombre" autocomplete="off" required=""/>
	                  </div>
	               </div>
	               
	               <div class="form-group">
	                  <label class="col-sm-2 control-label">Descripción</label>
	                  <div class="col-sm-10">
	                  	<textarea class="form-control" name="descripcion" rows="2" placeholder="Descripción" required></textarea>
	                  </div>
	               </div>
	               <div class="form-group">
	                  <label class="col-sm-2 control-label">Categoria</label>
	                  <div class="col-sm-10">
	                     <input type="text" name="editorial" class="form-control" placeholder="Editorial" autocomplete="off" required=""/>
	                  </div>
	               </div>
	               <div class="form-group">
	                  <label class="col-sm-2 control-label">Cantidad</label>
	                  <div class="col-sm-10">
	                     <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" required="" value="0" />
	                  </div>
	               </div>
	               <div class="form-group">
	                  <label class="col-sm-2 control-label">Precio (Bs)</label>
	                  <div class="col-sm-10">
	                     <input type="number" name="precio" class="form-control" placeholder="Precio" required="" value="0" />
	                  </div>
	               </div>
	               <div class="form-group">
	                  <label class="col-sm-2 control-label">Ubicación</label>
	                  <div class="col-sm-10">
	                     <input type="text" name="ubicacion" class="form-control" placeholder="Caja x - Fila x - Columna x" required="" value="Caja # " />
	                  </div>
	               </div>
	            </div>
	            <div class="modal-footer">
	               <button class="btn btn-sm btn-primary" type="submit">
	                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Actualizar
	               </button>
	            </div>
	         </div>
	      </div>
	   </div>
	</form>
  	<div id="txtHint"></div>
 	<script type="text/javascript">
	$(document).ready(function(){
		$('#ajax').hide();
		$('#buscar').submit(function(e){
			e.preventDefault();
	       var str=  $('#search').val();
	       if(str == '') {
	            $('#lista-general').show(); 
	            $('#ajax').hide(); 
	       }else {
	       		$('#lista-search').html('');
	       		$.post('db/ajax.php', {
                    "buscar": str
                }).then(function(respuesta) {
					var valor = JSON.parse(respuesta);
					for(i in valor){
						$('#lista-search').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+valor[i].titulo+'<span class="badge badge-primary badge-pill" style="font-size:30px;">'+valor[i].ubicacion+'</span><input type="number" name="cantidad" class="form-control" value="'+valor[i].cantidad+'"/></li>');
					}
                });
				$('#lista-general').hide();
				$('#ajax').show(); 
	       }
	   }); 


		var $titulo = $('#titulo');
		var $descripcion = $('#descripcion');
		$titulo.on('keyup blur', function () {
		$descripcion.val($titulo.val());
		$descripcion.trigger('blur');
		});
		/*$("#search").keyup(function(){
       var str=  $("#search").val();
       if(str == "") {
            $('#lista-general').show(); 
	        $('#ajax').hide(); 
       }else {
               $.get( "db/ajax.php?buscar="+str, function(respuesta){
                   var valor = JSON.parse(respuesta);
					for(i in valor){
						$('#lista-search').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+valor[i].titulo+'<span class="badge badge-primary badge-pill">'+valor[i].cantidad+'</span><span class="badge badge-primary badge-pill">'+valor[i].descripcion+'</span><span class="badge badge-primary badge-pill">'+valor[i].ubicacion+'</span></li>');
					}
            		
            });
               $('#lista-general').hide(); 
	        $('#ajax').show(); 
       }
   	});   */
});
</script>

</body>
</html>