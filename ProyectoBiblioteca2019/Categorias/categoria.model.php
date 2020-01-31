<?php

require_once ("conexion.php");


class CategoriaModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT * FROM categorias");
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $cat = new Categoria();

                   $cat->set_idcategoria($r->IDCategoria);
                   $cat->set_categoria($r->Categoria);

                   $result[]=$cat;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  
      public function Obtener($IDCategoria){

           try{

              $stm=$this->pdo->prepare("SELECT * FROM Categorias WHERE IDCategoria=?");
              $stm->execute(array($IDCategoria));  

              $r=$stm->fetch(PDO::FETCH_OBJ);

              $cat=new Categoria();

              $cat->set_idcategoria($r->IDCategoria);
              $cat->set_categoria($r->Categoria);
                   
                   return $cat;
           }

           catch(Exception $e){

               die($e->getMessage());
           }

      }

      public function Eliminar ($IDCategoria){

            try{

                $stm=$this->pdo->prepare("DELETE FROM categorias WHERE IDCategoria=?");
                $stm->execute(array($IDCategoria));
            }
               catch (Exception $e){

                die($e->getMessage());
               }
      }

      public function Actualizar (Categoria $data){
        try{

            $sql = "UPDATE categorias SET 

                    Categoria=?
                    WHERE IDCategoria=?";

                    $this->pdo->prepare($sql)
                       ->execute(
                          array(
                            $data->get_categoria(),
                            $data->get_idcategoria()
                        )
                       );
            }

              catch (Exception $e){

                die($e->getMessage());
              }

      }

      public function Registrar (Categoria $data){

               try{

                   $sql="INSERT INTO categorias (Categoria) VALUES (?)";

                   $this->pdo->prepare($sql)
                          ->execute(
                             array(
                               $data->get_categoria()
                           )
                          );

               }    
                      catch (Exception $e){

                        die($e->getMessage());
                      }


      }

     }
?>
