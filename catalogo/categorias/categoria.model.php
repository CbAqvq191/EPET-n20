<?php

require_once ("../recursos/conexion.php");


class CategoriaModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT * FROM categorias ORDER BY categoria ASC");
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $cate = new Categoria();

                   $cate->set_idcategoria($r->IDCategoria);
                   $cate->set_categoria($r->Categoria);

                   $result[]=$cate;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  
      public function Obtener ($IDCategoria){

           try{

              $stm=$this->pdo->prepare("SELECT * FROM categorias WHERE IDCategoria=?");
              $stm->execute(array($IDCategoria));  

              $r=$stm->fetch(PDO::FETCH_OBJ);

              $cate=new Categoria();

              $cate->set_idcategoria($r->IDCategoria);
              $cate->set_categoria($r->Categoria);
                   
                   return $cate;
           }

           catch(Exception $e){

               die($e->getMessage());
           }

      }


      public function Eliminar ($IDCategoria){

            try{

                $stm=$this->pdo->prepare("UPDATE categorias SET Categoria=' ' WHERE IDCategoria=?");
                $stm->execute(array($IDCategoria));
            }
               catch (Exception $e){

                die($e->getMessage());
               }
      }

      public function Actualizar (Categoria $data){
        try{

            $sql = "UPDATE Categorias SET 

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
