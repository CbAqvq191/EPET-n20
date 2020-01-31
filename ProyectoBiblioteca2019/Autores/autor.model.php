<?php

require_once ("conexion.php");


class AutorModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT * FROM autores");
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $aut = new Autor();

                   $aut->set_idautor($r->IDAutor);
                   $aut->set_autor($r->Autor);

                   $result[]=$aut;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  
      public function Obtener($IDAutor){

           try{

              $stm=$this->pdo->prepare("SELECT * FROM Autores WHERE IDAutor=?");
              $stm->execute(array($IDAutor));  

              $r=$stm->fetch(PDO::FETCH_OBJ);

              $aut=new Autor();

              $aut->set_idautor($r->IDAutor);
              $aut->set_autor($r->Autor);
                   
                   return $aut;
           }

           catch(Exception $e){

               die($e->getMessage());
           }

      }

      public function Eliminar ($IDAutor){

            try{

                $stm=$this->pdo->prepare("DELETE FROM autores WHERE IDAutor=?");
                $stm->execute(array($IDAutor));
            }
               catch (Exception $e){

                die($e->getMessage());
               }
      }

      public function Actualizar (Autor $data){
        try{

            $sql = "UPDATE autores SET 

                    Autor=?
                    WHERE IDAutor=?";

                    $this->pdo->prepare($sql)
                       ->execute(
                          array(
                            $data->get_autor(),
                            $data->get_idautor()
                        )
                       );
            }

              catch (Exception $e){

                die($e->getMessage());
              }

      }

      public function Registrar (Autor $data){

               try{

                   $sql="INSERT INTO autores (Autor) VALUES (?)";

                   $this->pdo->prepare($sql)
                          ->execute(
                             array(
                               $data->get_autor()
                           )
                          );

               }    
                      catch (Exception $e){

                        die($e->getMessage());
                      }


      }

     }
?>
