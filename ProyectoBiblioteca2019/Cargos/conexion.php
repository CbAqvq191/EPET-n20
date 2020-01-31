<?php

require_once ("constante.php");

class conexion extends PDO{

       protected $pdo;

       public function getConexion(){

       	      return $this->pdo;
       }

       public function __construct(){

            try {

            	$this->pdo = new PDO ('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

            	$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                   //echo "Conexion con exito";
            }       

            catch(Exception $e){

            	die($e->getMessage());
            }	
       }

}

?>