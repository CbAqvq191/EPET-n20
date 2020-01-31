<?php

 class Producto {

	private $_IDProducto;
	private $_Producto;
	private $_Marca;
	private $_Precio;
	
	//agenos:
    private $_IDCategoria;
	private $_Categoria;
	//private $_IDUsuario;
	//private $_Usuario;

    
	//SET:
	
	public function set_idproducto($idproducto) {
  
           $this->_IDProducto=$idproducto;
    }
	public function set_producto($producto) {
  
           $this->_Producto=$producto;
    }
	public function set_marca($marca) {
  
           $this->_Marca=$marca;
    }
	public function set_precio($precio) {
  
           $this->_Precio=$precio;
    }

	
	//agenos:
	
    public function set_idcategoria($idcategoria) {
  
           $this->_IDCategoria=$idcategoria;
    }
    public function set_categoria ($categoria){

           $this->_Categoria=$categoria;
    }
	
	//GET:

	public function get_idproducto(){
  
           return $this->_IDProducto;
    }
    public function get_producto(){

           return $this->_Producto;
    }
	public function get_marca(){

           return $this->_Marca;
    }
	public function get_precio(){

           return $this->_Precio;
    }

	//agenos
	
    public function get_idcategoria(){
  
           return $this->_IDCategoria;
    }
    public function get_categoria(){

           return $this->_Categoria;
    }
	
	/*public function get_idusuario(){
  
           return $this->_IDUsuario;
    }
    public function get_usuario(){

           return $this->_Usuario;
    }*/
 }
 ?>