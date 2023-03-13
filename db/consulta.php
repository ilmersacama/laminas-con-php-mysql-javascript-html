<?php 

	include_once('class.database.php');

	/**
	 * Realizado por Ilmer Sacama
	 */
	class Consulta
	{
		public $db;
		function __construct()
		{
			$this->db =  new  Database('localhost', 'root', '', 'laminas');
		}

		public function listar_laminas(){
			$lista = $this->$db->query('select * from laminas');
			return $lista;
		}

		public function editar_laminas(){
			$lista = $this->$db->query('select * from laminas');
			return $lista;
		}

		public function eliminar_laminas(){
			$lista = $this->$db->query('select * from laminas');
			return $lista;
		}

		public function actualizar_laminas(){
			$lista = $this->$db->query('select * from laminas');
			return $lista;
		}
	}