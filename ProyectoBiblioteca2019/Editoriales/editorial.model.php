<?php

require_once ("conexion.php");


class EditorialModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT * FROM Editoriales");
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $edi = new Editorial();

                   $edi->set_ideditorial($r->IDEditorial);
                   $edi->set_editorial($r->Editorial);

                   $result[]=$edi;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  
      public function Obtener($IDEditorial){

           try{

              $stm=$this->pdo->prepare("SELECT * FROM Editoriales WHERE IDEditorial=?");
              $stm->execute(array($IDEditorial));  

              $r=$stm->fetch(PDO::FETCH_OBJ);

              $edi=new Editorial();

              $edi->set_ideditorial($r->IDEditorial);
              $edi->set_editorial($r->Editorial);
                   
                   return $edi;
           }

           catch(Exception $e){

               die($e->getMessage());
           }

      }

      public function Eliminar ($IDEditorial){

            try{

                $stm=$this->pdo->prepare("DELETE FROM editoriales WHERE IDEditorial=?");
                $stm->execute(array($IDEditorial));
            }
               catch (Exception $e){

                die($e->getMessage());
               }
      }

      public function Actualizar (Editorial $data){
        try{

            $sql = "UPDATE Editoriales SET 

                    Editorial=?
                    WHERE IDEditorial=?";

                    $this->pdo->prepare($sql)
                       ->execute(
                          array(
                            $data->get_editorial(),
                            $data->get_ideditorial()
                        )
                       );
            }

              catch (Exception $e){

                die($e->getMessage());
              }

      }

      public function Registrar (Editorial $data){

               try{

                   $sql="INSERT INTO editoriales (Editorial) VALUES (?)";

                   $this->pdo->prepare($sql)
                          ->execute(
                             array(
                               $data->get_editorial()
                           )
                          );

               }    
                      catch (Exception $e){

                        die($e->getMessage());
                      }


      }

     }
?>
