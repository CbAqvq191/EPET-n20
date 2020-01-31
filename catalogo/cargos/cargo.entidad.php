<?php

 class Cargo {

    private $_IDCargo;
    private $_Cargo;
    private $_IDArea;
	private $_Area;

     
    public function set_idcargo($idcar) {
  
           $this->_IDCargo=$idcar;
    }
    public function set_cargo ($carg){

           $this->_Cargo=$carg;
    }
    public function set_idarea ($idare){

           $this->_IDArea=$idare;
    }
    public function set_area ($area){

           $this->_Area=$area;
    }
	




    public function get_idcargo(){
  
           return $this->_IDCargo;
    }
    public function get_cargo(){

           return $this->_Cargo;
    }
    public function get_idarea(){

           return $this->_IDArea;
    }
	public function get_area(){

           return $this->_Area;
    }


 }
 ?>