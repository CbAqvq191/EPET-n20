<?php

 class Costo {

    private $_IDCosto;
    private $_Costo;
    private $_Ciclolectivo;

     
    public function set_idcosto($idcos) {
  
           $this->_IDCosto=$idcos;
    }
    public function set_costo ($cost){

           $this->_Costo=$cost;
    }
    public function set_ciclolectivo ($idciclo){

           $this->_Ciclolectivo=$idciclo;
    }




    public function get_idcosto(){
  
           return $this->_IDCosto;
    }
    public function get_costo(){

           return $this->_Costo;
    }
    public function get_ciclolectivo(){

           return $this->_Ciclolectivo;
    }


 }
 ?>