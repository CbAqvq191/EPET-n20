<?php

require_once("clasePersona.php");

class User extends Persona{
     protected $username;
     protected $password;

     public function set_username($valor){
             $this->username=$valor;
     }
     public function set_password($valor){
             $this->password=$valor;
     }

     public function get_username(){
             return $this->username;
     }
     public function get_password(){
             return $this->password;
     } 

}
?>
