<?php

require_once ("../recursos/conexion.php");


class AreaModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT * FROM areas ORDER BY Area ASC");
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $edi = new Area();

                   $edi->set_idarea($r->IDArea);
                   $edi->set_area($r->Area);

                   $result[]=$edi;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  
      public function Obtener($IDArea){

           try{

              $stm=$this->pdo->prepare("SELECT * FROM areas WHERE IDArea=?");
              $stm->execute(array($IDArea));  

              $r=$stm->fetch(PDO::FETCH_OBJ);

              $edi=new Area();

              $edi->set_idarea($r->IDArea);
              $edi->set_area($r->Area);
                   
                   return $edi;
           }

           catch(Exception $e){

               die($e->getMessage());
           }

      }

      public function Eliminar ($IDArea){

            try{

                $stm=$this->pdo->prepare("DELETE FROM areas WHERE IDArea=?");
                $stm->execute(array($IDArea));
            }
               catch (Exception $e){

                die($e->getMessage());
               }
      }

      public function Actualizar (Area $data){
        try{

            $sql = "UPDATE Areas SET 

                    Area=?
                    WHERE IDArea=?";

                    $this->pdo->prepare($sql)
                       ->execute(
                          array(
                            $data->get_area(),
                            $data->get_idarea()
                        )
                       );
            }

              catch (Exception $e){

                die($e->getMessage());
              }

      }

      public function Registrar (Area $data){

               try{

                   $sql="INSERT INTO areas (Area) VALUES (?)";

                   $this->pdo->prepare($sql)
                          ->execute(
                             array(
                               $data->get_area()
                           )
                          );

               }    
                      catch (Exception $e){

                        die($e->getMessage());
                      }


      }

     }
?>
