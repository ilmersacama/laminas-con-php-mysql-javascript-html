<?php

	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // put your code here
    class Conectar
    {
        protected $host= "localhost";
        protected $user = "root";
        protected $pass = "";
        protected $db = "laminas";
        protected $conecta;
        public function __construct()
        {
            try{
                $this->conecta = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->user, $this->pass);
                $this->conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conecta->exec('SET CHARACTER SET utf8');
            }
            catch(PDOException $e){
                exit('error :'.$e->getMessage());
            }
        }
        public function query($arg)
        {
            $result = $this->conecta->prepare('SELECT * FROM '.$arg);
            $result->execute();
            return $result->fetchAll();
        }
        public function mostrar($query)
        {
            echo $query;
            $result = $this->conecta->prepare('SELECT * FROM laminas where titulo = $query');
            $result->execute();
            $valor = $result->fetchAll();
            $valores = array();
            foreach ($valor as $key => $value) {
                $valores[] = $value;
            }
            var_dump($valores);
            echo $valores;
            echo json_encode($valores);
            //echo $jsonstring;
        }
        public function insert()
        {
            $in = $this->conecta->prepare('INSERT INTO resto() VALUES()');
        }
    }

   
   
    

?>