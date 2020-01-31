<?php

require_once ("../recursos/conexion.php");


class UsuarioModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT usu.*, car.* FROM usuarios as usu 
			   INNER JOIN cargos as car on usu.IDCargo=car.IDCargo
			   "); /* inner join cargos ares on usu.Cargo=ares.Cargo */
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $usu = new Usuario();

                   $usu->set_idusuario($r->IDUsuario);
                   $usu->set_usuario($r->Usuario);
				   $usu->set_nombre($r->Nombre);
				   $usu->set_apellido($r->Apellido);
				   $usu->set_clave($r->Clave);
				   $usu->set_idcargo($r->IDCargo);
				   $usu->set_cargo($r->Cargo);
				   
				   // no son de otra tabla:
                   $usu->set_cargo($r->Cargo);

                   $result[]=$usu;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  
      public function Obtener($IDUsuario){

           try{

              $stm=$this->pdo->prepare("SELECT * FROM usuarios WHERE IDUsuario=?");
              $stm->execute(array($IDUsuario));  

              $r=$stm->fetch(PDO::FETCH_OBJ);

              $usu=new Usuario();

              $usu->set_idusuario($r->IDUsuario);
              $usu->set_usuario($r->Usuario);
			  $usu->set_nombre($r->Nombre);
			  $usu->set_apellido($r->Apellido);
			  $usu->set_clave($r->Clave);
			  $usu->set_idcargo($r->IDCargo);
			  $usu->set_cargo($r->Cargo);
                  
                   return $usu;
           }

           catch(Exception $e){

               die($e->getMessage());
           }

      }

      public function Eliminar ($IDUsuario){

            try{

                $stm=$this->pdo->prepare("DELETE FROM usuarios WHERE IDUsuario=?");
                $stm->execute(array($IDUsuario));
            }
               catch (Exception $e){

                die($e->getMessage());
               }
      }

      public function Actualizar (Usuario $data){
        //TRY O BEGIN TRANSACTION (creo q este ultimo es p/proceddimientos almacenado en el motor de DB)
        try{

            $sql = "UPDATE usuarios SET 

                    Usuario=?,
					Nombre=?,
					Apellido=?,
					Clave=?,
                    IDCargo=?
                    WHERE IDUsuario=?";

                    $this->pdo->prepare($sql)
                       ->execute(
                          array(
                            $data->get_usuario(),
                            $data->get_nombre(),
							$data->get_apellido(),
							$data->get_clave(),
							$data->get_idcargo(),
							$data->get_idusuario(),
                        )
                       );
            }

              catch (Exception $e){

                die($e->getMessage());
              }

      }

      public function Registrar (Usuario $data){

               try{

                   $sql="INSERT INTO usuarios (Usuario,Nombre,Apellido,Clave,IDCargo) VALUES (?,?,?,?,?)";

                   $this->pdo->prepare($sql)
                          ->execute(
                             array(
								$data->get_usuario(),
								$data->get_nombre(),
								$data->get_apellido(),
								$data->get_clave(),
								$data->get_idcargo(),
                           )
                          );

               }    
                      catch (Exception $e){

                        die($e->getMessage());
                      }


      }

     }
?>



