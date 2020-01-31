<?php

 class Editorial {

    private $_IDEditorial;
    private $_Editorial;

     
    public function set_ideditorial($idedi) {
  
           $this->_IDEditorial=$idedi;
    }
    public function set_editorial ($edi){

           $this->_Editorial=$edi;
    }




    public function get_ideditorial(){
  
           return $this->_IDEditorial;
    }
    public function get_editorial(){

           return $this->_Editorial;
    }


 }
 ?>