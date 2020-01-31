<?php

 class Cargo {

    private $_IDCargo;
    private $_Cargo;
    private $_IDSuperior;
    private $_Superior;

     
    public function set_idcargo($idcar) {
  
           $this->_IDCargo=$idcar;
    }
    public function set_cargo ($carg){

           $this->_Cargo=$carg;
    }
    public function set_idsuperior ($idsup){

           $this->_IDSuperior=$idsup;
    }
    public function set_superior ($sup){

           $this->_Superior=$sup;
    }




    public function get_idcargo(){
  
           return $this->_IDCargo;
    }
    public function get_cargo(){

           return $this->_Cargo;
    }
    public function get_idsuperior(){

           return $this->_IDSuperior;
    }
    public function get_superior(){

           return $this->_Superior;
    }


 }
 ?>