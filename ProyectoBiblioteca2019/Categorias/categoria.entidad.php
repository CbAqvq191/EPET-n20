<?php

 class Categoria {

    private $_IDCategoria;
    private $_Categoria;

     
    public function set_idcategoria($idcat) {
  
           $this->_IDCategoria=$idcat;
    }
    public function set_categoria ($cat){

           $this->_Categoria=$cat;
    }




    public function get_idcategoria(){
  
           return $this->_IDCategoria;
    }
    public function get_categoria(){

           return $this->_Categoria;
    }


 }
 ?>