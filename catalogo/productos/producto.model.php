<?php

require_once ("../recursos/conexion.php");


class ProductoModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               //$stm=$this->pdo->prepare("SELECT * FROM Productos ORDER BY Producto ASC");
			   $stm=$this->pdo->prepare("SELECT pro.* , cat.* FROM productos as pro 
			   INNER JOIN categorias as cat on pro.IDCategoria = cat.IDCategoria ORDER BY producto ASC");
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $prod = new Producto();

                   $prod->set_idproducto($r->IDProducto);
                   $prod->set_producto($r->Producto);
				   $prod->set_marca($r->Marca);
				   $prod->set_precio($r->Precio);
				   $prod->set_idcategoria($r->IDCategoria);
				   $prod->set_categoria($r->Categoria);

                   $result[]=$prod;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  
      public function Obtener ($IDProducto){

           try{

              $stm=$this->pdo->prepare("SELECT * FROM productos WHERE IDProducto=?");
              $stm->execute(array($IDProducto));  

              $r=$stm->fetch(PDO::FETCH_OBJ);

              $prod=new Producto();

              $prod->set_idproducto($r->IDProducto);
              $prod->set_producto($r->Producto);
			  $prod->set_marca($r->Marca);
			  $prod->set_precio($r->Precio);
			  $prod->set_idcategoria($r->IDCategoria);
			  $prod->set_categoria($r->Categoria);
                 
                   return $prod;
           }

           catch(Exception $e){

               die($e->getMessage());
           }

      }


      public function Eliminar ($IDProducto){

            try{

                $stm=$this->pdo->prepare("DELETE FROM productos WHERE IDProducto=?");
                $stm->execute(array($IDProducto));
            }
               catch (Exception $e){

                die($e->getMessage());
               }
      }

      public function Actualizar (Producto $data){
        try{

            $sql = "UPDATE productos SET 

                    Producto=?,
					Marca=?,
					Precio=?,
					IDCategoria=?
                    WHERE IDProducto=?";

                    $this->pdo->prepare($sql)
                       ->execute(
                          array(
                            $data->get_producto(),
							$data->get_marca(),
							$data->get_precio(),
							$data->get_idcategoria(),
                            $data->get_idproducto()
                        )
                       );
            }

              catch (Exception $e){

                die($e->getMessage());
              }

      }

      public function Registrar (Producto $data){

               try{

                   $sql="INSERT INTO productos (Producto,Marca,Precio,IDCategoria) VALUES (?,?,?,?)";

                   $this->pdo->prepare($sql)
                          ->execute(
                             array(
							 
                               $data->get_producto(),
							   $data->get_marca(),
							   $data->get_precio(),
							   $data->get_idcategoria()
							   
							   
							   
                           )
                          );

               }    
                      catch (Exception $e){

                        die($e->getMessage());
                      }


      }

     }
?>
