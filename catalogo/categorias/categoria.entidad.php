<?php

 class Categoria {

    private $_IDCategoria;
	private $_Categoria;

     
    public function set_idcategoria($idcategoria) {
  
           $this->_IDCategoria=$idcategoria;
    }
    public function set_categoria ($categoria){

           $this->_Categoria=$categoria;
    }




    public function get_idcategoria(){
  
           return $this->_IDCategoria;
    }
    public function get_categoria(){

           return $this->_Categoria;
    }
 }
 ?>