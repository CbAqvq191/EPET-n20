<?php

require_once ("conexion.php");


class CostoModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT * FROM costosmatriculas");
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $cos = new Costo();

                   $cos->set_idcosto($r->IDCosto);
                   $cos->set_costo($r->Costo);
                   $cos->set_ciclolectivo($r->Ciclolectivo);

                   $result[]=$cos;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  
      public function Obtener($IDCosto){

           try{

              $stm=$this->pdo->prepare("SELECT * FROM costosmatriculas WHERE IDCosto=?");
              $stm->execute(array($IDCosto));  

              $r=$stm->fetch(PDO::FETCH_OBJ);

              $cos=new Costo();

              $cos->set_idcosto($r->IDCosto);
              $cos->set_costo($r->Costo);
              $cos->set_ciclolectivo($r->Ciclolectivo);
                   
                   return $cos;
           }

           catch(Exception $e){

               die($e->getMessage());
           }

      }

      public function Eliminar ($IDCosto){

            try{

                $stm=$this->pdo->prepare("DELETE FROM costosmatriculas WHERE IDCosto=?");
                $stm->execute(array($IDCosto));
            }
               catch (Exception $e){

                die($e->getMessage());
               }
      }

      public function Actualizar (Costo $data){
        //TRY O BEGIN TRANSACTION (creo q este ultimo es p/proceddimientos almacenado en el motor de DB)
        try{

            $sql = "UPDATE costosmatriculas SET 

                    Costo=?,
                    Ciclolectivo=?
                    WHERE IDCosto=?";

                    $this->pdo->prepare($sql)
                       ->execute(
                          array(
                            $data->get_costo(),
                            $data->get_ciclolectivo(),
                            $data->get_idcosto()
                        )
                       );
            }

              catch (Exception $e){

                die($e->getMessage());
              }

      }

      public function Registrar (Costo $data){

               try{

                   $sql="INSERT INTO costosmatriculas (Costo,Ciclolectivo) VALUES (?,?)";

                   $this->pdo->prepare($sql)
                          ->execute(
                             array(
                               $data->get_costo(),
                               $data->get_ciclolectivo()
                           )
                          );

               }    
                      catch (Exception $e){

                        die($e->getMessage());
                      }


      }

     }
?>
