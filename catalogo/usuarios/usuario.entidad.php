<?php

 class Usuario {

	private $_IDUsuario;
	private $_Usuario;
	private $_Nombre;
	private $_Apellido;
	private $_Clave;
	
	//otra tabla:
	private $_IDCargo;
	private $_Cargo;
     
    public function set_idusuario($idusuario) {
  
           $this->_IDUsuario=$idusuario;
    }
    public function set_usuario ($usuario){

           $this->_Usuario=$usuario;
    }
	public function set_nombre ($nombre){

           $this->_Nombre=$nombre;
    }
	public function set_apellido ($apellido){

           $this->_Apellido=$apellido;
    }
	public function set_clave ($clave){

           $this->_Clave=$clave;
    }
	//otra tabla:
	public function set_idcargo ($idcargo){

           $this->_IDCargo=$idcargo;
    }
	public function set_cargo ($cargo){

           $this->_Cargo=$cargo;
    }



    public function get_idusuario(){
  
           return $this->_IDUsuario;
    }
    public function get_usuario(){

           return $this->_Usuario;
    }
	public function get_nombre (){

           return $this->_Nombre;
    }
	public function get_apellido (){

           return $this->_Apellido;
    }
	public function get_clave (){

           return $this->_Clave;
    }
	//otra tabla:
	public function get_idcargo (){

           return $this->_IDCargo;
    }
	public function get_cargo (){

           return $this->_Cargo;
    }
 }
 ?>