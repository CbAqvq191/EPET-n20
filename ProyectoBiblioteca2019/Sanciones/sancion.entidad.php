<?php

 class Sancion {
    
    private $_IDsancion;
    private $_Nombre;
    private $_Apellido;
    private $_Monto;
    private $_Descripcion;
    private $_Pago;


     
    public function set_idsancion($idsan) {
  
           $this->_IDsancion=$idsan;
    }
    public function set_nombre ($nom){

           $this->_Nombre=$nom;
    }
    public function set_apellido ($ape){

           $this->_Apellido=$ape;
    }
    public function set_monto ($mon){

           $this->_Monto=$mon;
    }
    public function set_descripcion ($des){

           $this->_Descripcion=$des;
    }
    public function set_pago ($pag){

           $this->_Pago=$pag;
    }



    public function get_idsancion(){
  
           return $this->_IDsancion;
    }
    public function get_nombre(){

           return $this->_Nombre;
    }
    public function get_apellido(){

           return $this->_Apellido;
    }
    public function get_monto(){

           return $this->_Monto;
    }
    public function get_descripcion(){

           return $this->_Descripcion;
    }
    public function get_pago(){

           return $this->_Pago;
    }



 }