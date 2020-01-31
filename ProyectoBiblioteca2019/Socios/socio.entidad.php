<?php

 class Socio {
    
    private $_IDsocio;
    private $_Nombre;
    private $_Apellido;
    private $_Direccion;
    private $_Telefono;
    private $_Fechanacimiento;
    private $_Dni;


     
    public function set_idsocio($idsoc) {
  
           $this->_IDsocio=$idsoc;
    }
    public function set_nombre ($nom){

           $this->_Nombre=$nom;
    }
    public function set_apellido ($ape){

           $this->_Apellido=$ape;
    }
    public function set_direccion ($dire){

           $this->_Direccion=$dire;
    }
    public function set_telefono ($tel){

           $this->_Telefono=$tel;
    }
    public function set_fechanacimiento ($fecha){

           $this->_Fechanacimiento=$fecha;
    }
    public function set_dni ($d){

           $this->_Dni=$d;
    }



    public function get_idsocio(){
  
           return $this->_IDsocio;
    }
    public function get_nombre(){

           return $this->_Nombre;
    }
    public function get_apellido(){

           return $this->_Apellido;
    }
    public function get_direccion(){

           return $this->_Direccion;
    }
    public function get_telefono(){

           return $this->_Telefono;
    }
    public function get_fechanacimiento(){

           return $this->_Fechanacimiento;
    }
    public function get_dni(){

           return $this->_Dni;
    }



 }