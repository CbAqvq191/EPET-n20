<?php

require_once ("conexion.php");


class SocioModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT * FROM socios");
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $soc = new Socio();

                   $soc->set_idsocio($r->IDsocio);
                   $soc->set_nombre($r->Nombre);
                   $soc->set_apellido($r->Apellido);
                   $soc->set_direccion($r->Direccion);
                   $soc->set_telefono($r->Telefono);
                   $soc->set_fechanacimiento($r->Fechanacimiento);
                   $soc->set_dni($r->Dni);

                   $result[]=$soc;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  
      public function Obtener($IDsocio){

           try{

              $stm=$this->pdo->prepare("SELECT * FROM socios WHERE IDsocio=?");
              $stm->execute(array($IDsocio));  

              $r=$stm->fetch(PDO::FETCH_OBJ);

              $soc=new Socio();

                   $soc->set_idsocio($r->IDsocio);
                   $soc->set_nombre($r->Nombre);
                   $soc->set_apellido($r->Apellido);
                   $soc->set_direccion($r->Direccion);
                   $soc->set_telefono($r->Telefono);
                   $soc->set_fechanacimiento($r->Fechanacimiento);
                   $soc->set_dni($r->Dni);
                   
                   return $soc;
           }

           catch(Exception $e){

               die($e->getMessage());
           }

      }

      public function Eliminar ($IDsocio){

            try{

                $stm=$this->pdo->prepare("DELETE FROM socios WHERE IDsocio=?");
                $stm->execute(array($IDsocio));
            }
               catch (Exception $e){

                die($e->getMessage());
               }
      }

      public function Actualizar (Socio $data){

        try{

            $sql = "UPDATE socios SET 

                    Nombre=?,
                    Apellido=?,
                    Direccion=?,
                    Telefono=?,
                    Fechanacimiento=?,
                    Dni=?
                    WHERE IDsocio=?";

                    $this->pdo->prepare($sql)
                       ->execute(
                          array(
                            $data->get_nombre(),
                            $data->get_apellido(),
                            $data->get_direccion(),
                            $data->get_telefono(),
                            $data->get_fechanacimiento(),
                            $data->get_dni(),
                            $data->get_idsocio()

                        )
                       );
            }

              catch (Exception $e){

                die($e->getMessage());
              }

      }

      public function Registrar (Socio $data){

               try{

                   $sql="INSERT INTO socios (Nombre,Apellido,Direccion,Telefono,Fechanacimiento,Dni) VALUES (?,?,?,?,?,?)";

                   $this->pdo->prepare($sql)
                          ->execute(
                             array(
                            $data->get_nombre(),
                            $data->get_apellido(),
                            $data->get_direccion(),
                            $data->get_telefono(),
                            $data->get_fechanacimiento(),
                            $data->get_dni(),
                           )
                          );

               }    
                      catch (Exception $e){

                        die($e->getMessage());
                      }


      }

     }
?>
