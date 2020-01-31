<?php

require_once ("conexion.php");


class PagoModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT * FROM pagos");
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $pag = new Pago();

                   $pag->set_iddebe($r->IDDebe);
                   $pag->set_debe($r->Debe);
                   $pag->set_nombre($r->Nombre);

                   $result[]=$pag;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  
      public function Obtener($IDDebe){

           try{

              $stm=$this->pdo->prepare("SELECT * FROM pagos WHERE IDDebe=?");
              $stm->execute(array($IDDebe));

              $r=$stm->fetch(PDO::FETCH_OBJ);

              $pag=new Pago();

              $pag->set_iddebe($r->IDDebe);
              $pag->set_debe($r->Debe);
              $pag->set_nombre($r->Nombre);
                   
                   return $pag;
           }

           catch(Exception $e){

               die($e->getMessage());
           }

      }

      public function Eliminar ($IDDebe){

            try{

                $stm=$this->pdo->prepare("DELETE FROM pagos WHERE IDDebe=?");
                $stm->execute(array($IDDebe));
            }
               catch (Exception $e){

                die($e->getMessage());
               }
      }

      public function Actualizar (Pago $data){
        //TRY O BEGIN TRANSACTION (creo q este ultimo es p/proceddimientos almacenado en el motor de DB)
        try{

            $sql = "UPDATE pagos SET 

                    Debe=?,
                    Nombre=?
                    WHERE IDDebe=?";

                    $this->pdo->prepare($sql)
                       ->execute(
                          array(
                            $data->get_debe(),
                            $data->get_nombre(),
                            $data->get_iddebe()
                        )
                       );
            }

              catch (Exception $e){

                die($e->getMessage());
              }

      }

      public function Registrar (Pago $data){

               try{

                   $sql="INSERT INTO pagos (Debe,Nombre) VALUES (?,?)";

                   $this->pdo->prepare($sql)
                          ->execute(
                             array(
                               $data->get_debe(),
                               $data->get_nombre()
                           )
                          );

               }    
                      catch (Exception $e){

                        die($e->getMessage());
                      }
      }
     }
?>
