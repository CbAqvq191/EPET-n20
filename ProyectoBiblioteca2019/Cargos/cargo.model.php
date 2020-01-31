<?php

require_once ("conexion.php");


class CargoModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT c1.IDCargo, C1.Cargo, C2.Cargo as Superior FROM `cargos` as C1 LEFT join (Select IDCargo, Cargo from cargos) as C2 on C1.IDSuperior=C2.IDCargo");
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $car = new Cargo();

                   $car->set_idcargo($r->IDCargo);
                   $car->set_cargo($r->Cargo);
                   $car->set_superior($r->Superior);

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
              $car->set_idsuperior($r->IDSuperior);
                   
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
                    IDSuperior=?
                    WHERE IDCargo=?";

                    $this->pdo->prepare($sql)
                       ->execute(
                          array(
                            $data->get_cargo(),
                            $data->get_idsuperior(),
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

                   $sql="INSERT INTO cargos (Cargo,IDSuperior) VALUES (?,?)";

                   $this->pdo->prepare($sql)
                          ->execute(
                             array(
                               $data->get_cargo(),
                               $data->get_idsuperior()
                           )
                          );

               }    
                      catch (Exception $e){

                        die($e->getMessage());
                      }


      }

     }
?>
