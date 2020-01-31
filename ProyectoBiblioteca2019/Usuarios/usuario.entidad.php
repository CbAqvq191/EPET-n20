<?php

 class Usuario {
    
    private $_IDusuario;
    private $_IDcargo;
    private $_Nombre;
    private $_Apellido;
    private $_Usuario;
    private $_Clave;
    private $_Activo;

     
    public function set_idusuario($idusu) {
    
           $this->_IDusuario=$idusu; 
    }
    public function set_idcargo ($car){ 
           
           $this->_IDcargo=$car; 
    }
    public function set_nombre ($nom){

           $this->_Nombre=$nom;
    }
    public function set_apellido ($ape){

           $this->_Apellido=$ape;
    }
    public function set_usuario ($usu){

           $this->_Usuario=$usu;
    }
    public function set_clave ($pass){

           $this->_Clave=$pass;
    }
    public function set_activo ($act){

           $this->_Activo=$act;
    }




    public function get_idusuario(){
  
           return $this->_IDusuario;
    }
    public function get_idcargo(){

           return $this->_IDcargo;
    }
  
    public function get_nombre(){

           return $this->_Nombre;
    }
    public function get_apellido(){

           return $this->_Apellido;
    }
    public function get_usuario(){

           return $this->_Usuario;
    }
    public function get_clave(){

           return $this->_Clave;
    }
    public function get_activo(){

           return $this->_Activo;
    }



 }