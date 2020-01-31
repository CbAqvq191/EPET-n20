<?php

require_once ("../recursos/conexion.php");


class CargoModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT car.*, are.* FROM cargos as car 
			   INNER JOIN areas as are on car.IDArea=are.IDArea
			   ORDER BY are.areas
			   "); /* inner join areas ares on car.Area=ares.Area */
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $car = new Cargo();

                   $car->set_idcargo($r->IDCargo);
                   $car->set_cargo($r->Cargo);
                   $car->set_area($r->Area);

                   $result[]=$car;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  
      public function Obtener($IDCargo){

           try{

              $stm=$this->pdo->prepare("SELECT * FROM cargos WHERE IDCargo=?");
              $stm->execute(array($IDCargo));  

              $r=$stm->fetch(PDO::FETCH_OBJ);

              $car=new Cargo();

              $car->set_idcargo($r->IDCargo);
              $car->set_cargo($r->Cargo);
              $car->set_idarea($r->IDArea);
			  $car->set_area($r->Area);
                   
                   return $car;
           }

           catch(Exception $e){

               die($e->getMessage());
           }

      }

      public function Eliminar ($IDCargo){

            try{

                $stm=$this->pdo->prepare("DELETE FROM cargos WHERE IDCargo=?");
                $stm->execute(array($IDCargo));
            }
               catch (Exception $e){

                die($e->getMessage());
               }
      }

      public function Actualizar (Cargo $data){
        //TRY O BEGIN TRANSACTION (creo q este ultimo es p/proceddimientos almacenado en el motor de DB)
        try{

            $sql = "UPDATE cargos SET 

                    Cargo=?,
                    IDArea=?
                    WHERE IDCargo=?";

                    $this->pdo->prepare($sql)
                       ->execute(
                          array(
                            $data->get_cargo(),
                            $data->get_idarea(),
                            $data->get_idcargo()
                        )
                       );
            }

              catch (Exception $e){

                die($e->getMessage());
              }

      }

      public function Registrar (Cargo $data){

               try{

                   $sql="INSERT INTO cargos (Cargo,IDArea) VALUES (?,?)";

                   $this->pdo->prepare($sql)
                          ->execute(
                             array(
                               $data->get_cargo(),
                               $data->get_idarea()
                           )
                          );

               }    
                      catch (Exception $e){

                        die($e->getMessage());
                      }


      }

     }
?>



