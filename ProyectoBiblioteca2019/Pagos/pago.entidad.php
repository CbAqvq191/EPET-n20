<?php

 class Pago {

    private $_IDDebe;
    private $_Debe;
    private $_Nombre;

     
    public function set_iddebe($iddebe) {
  
           $this->_IDDebe=$iddebe;
    }
    public function set_debe ($debe){

           $this->_Debe=$debe;
    }
    public function set_nombre ($nom){

           $this->_Nombre=$nom;
    }




    public function get_iddebe(){
  
           return $this->_IDDebe;
    }
    public function get_debe(){

           return $this->_Debe;
    }
    public function get_nombre(){

           return $this->_Nombre;
    }


 }
 ?>