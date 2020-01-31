<?php

 class Area {

    private $_IDArea;
	private $_Area;

     
    public function set_idarea($idarea) {
  
           $this->_IDArea=$idarea;
    }
    public function set_area ($area){

           $this->_Area=$area;
    }




    public function get_idarea(){
  
           return $this->_IDArea;
    }
    public function get_area(){

           return $this->_Area;
    }
 }
 ?>