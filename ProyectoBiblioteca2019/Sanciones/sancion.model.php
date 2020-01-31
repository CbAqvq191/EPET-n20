<?php

require_once ("conexion.php");


class SancionModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT * FROM sanciones");
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $san = new Sancion();

                   $san->set_idsancion($r->IDsancion);
                   $san->set_nombre($r->Nombre);
                   $san->set_apellido($r->Apellido);
                   $san->set_monto($r->Monto);
                   $san->set_descripcion($r->Descripcion);
                   $san->set_pago($r->Pago);

                   $result[]=$san;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  
      public function Obtener($IDsancion){

           try{

              $stm=$this->pdo->prepare("SELECT * FROM sanciones WHERE IDsancion=?");
              $stm->execute(array($IDsancion));  

              $r=$stm->fetch(PDO::FETCH_OBJ);

              $san=new Sancion();

                   $san->set_idsancion($r->IDsancion);
                   $san->set_nombre($r->Nombre);
                   $san->set_apellido($r->Apellido);
                   $san->set_monto($r->Monto);
                   $san->set_descripcion($r->Descripcion);
                   $san->set_pago($r->Pago);
                   
                   return $san;
           }

           catch(Exception $e){

               die($e->getMessage());
           }

      }

      public function Eliminar ($IDsancion){

            try{

                $stm=$this->pdo->prepare("DELETE FROM sanciones WHERE IDsancion=?");
                $stm->execute(array($IDsancion));
            }
               catch (Exception $e){

                die($e->getMessage());
               }
      }

      public function Actualizar (Sancion $data){

        try{

            $sql = "UPDATE sanciones SET 

                    Nombre=?,
                    Apellido=?,
                    Monto=?,
                    Descripcion=?,
                    Pago=?
                    WHERE IDsancion=?";

                    $this->pdo->prepare($sql)
                       ->execute(
                          array(
                            $data->get_nombre(),
                            $data->get_apellido(),
                            $data->get_monto(),
                            $data->get_descripcion(),
                            $data->get_pago(),
                            $data->get_idsancion()

                        )
                       );
            }

              catch (Exception $e){

                die($e->getMessage());
              }

      }

      public function Registrar (Sancion $data){

               try{

                   $sql="INSERT INTO sanciones (Nombre,Apellido,Monto,Descripcion,Pago) VALUES (?,?,?,?,?)";

                   $this->pdo->prepare($sql)
                          ->execute(
                             array(
                            $data->get_nombre(),
                            $data->get_apellido(),
                            $data->get_monto(),
                            $data->get_Descripcion(),
                            $data->get_pago(),
                           )
                          );

               }    
                      catch (Exception $e){

                        die($e->getMessage());
                      }


      }

     }
?>
