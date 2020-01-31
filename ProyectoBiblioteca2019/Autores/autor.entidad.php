<?php

 class Autor {

    private $_IDAutor;
    private $_Autor;

     
    public function set_idautor($idaut) {
  
           $this->_IDAutor=$idaut;
    }
    public function set_autor ($aut){

           $this->_Autor=$aut;
    }




    public function get_idautor(){
  
           return $this->_IDAutor;
    }
    public function get_autor(){

           return $this->_Autor;
    }


 }
 ?>