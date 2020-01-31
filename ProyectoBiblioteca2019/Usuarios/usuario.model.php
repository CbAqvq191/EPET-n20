<?php

require_once ("conexion.php");


class UsuarioModel{

     private $pdo;

     public function __construct(){

       $con = new conexion();
       $this->pdo = $con->getConexion();
     }
    
     public function Listar(){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT * FROM usuarios");
               $stm->execute ();

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $usu = new Usuario();

                   $usu->set_idusuario($r->IDusuario);
                   $usu->set_idcargo($r->IDcargo);
                   $usu->set_nombre($r->Nombre);
                   $usu->set_apellido($r->Apellido);
                   $usu->set_usuario($r->Usuario);
                   $usu->set_clave($r->Clave);
                   $usu->set_activo($r->Activo);

                   $result[]=$usu;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  //----------------------------- LISTAR X CARGO -----------------------------------------

     public function ListarXCargo($idcar){

        try{

            $result = array();

               $stm=$this->pdo->prepare("SELECT * FROM usuarios where IDcargo=?");
               $stm->execute (array($idcar));

               foreach ($stm -> fetchAll (PDO::FETCH_OBJ) as $r) {
                   $usu = new Usuario();

                   $usu->set_idusuario($r->IDusuario);
                   $usu->set_nombre($r->Nombre);
                   $usu->set_apellido($r->Apellido);
                   $usu->set_usuario($r->Usuario);
                   $usu->set_clave($r->Clave);
                   $usu->set_activo($r->Activo);

                   $result[]=$usu;
               }

               return $result;
               }

               catch (Exception $e){

                    die($e->getMessage());
               }

          }
  
  //--------------------------------------------------------------------------------------
      public function Obtener($IDusuario){

           try{

              $stm=$this->pdo->prepare("SELECT * FROM usuarios WHERE IDusuario=?");
              $stm->execute(array($IDusuario));  

              $r=$stm->fetch(PDO::FETCH_OBJ);

              $usu=new Usuario();
                   $usu->set_idusuario($r->IDusuario);
                   $usu->set_idcargo($r->IDcargo);
                   $usu->set_nombre($r->Nombre);
                   $usu->set_apellido($r->Apellido);
                   $usu->set_usuario($r->Usuario);
                   $usu->set_clave($r->Clave);
                   $usu->set_activo($r->Activo);
                   
                   return $usu;
           }

           catch(Exception $e){

               die($e->getMessage());
           }

      }

      public function Eliminar ($IDusuario){

            try{

                $stm=$this->pdo->prepare("DELETE FROM usuarios WHERE IDusuario=?");
                $stm->execute(array($IDusuario));
            }
               catch (Exception $e){

                die($e->getMessage());
               }
      }

      public function Actualizar (Usuario $data){

        try{

            $sql = "UPDATE usuarios SET 

                    IDcargo=?,
                    Nombre=?,
                    Apellido=?,
                    Usuario=?,
                    Clave=?,
                    Activo=?
                    WHERE IDusuario=?";

                    $this->pdo->prepare($sql)
                       ->execute(
                          array(
                            $data->get_idcargo(),
                            $data->get_nombre(),
                            $data->get_apellido(),
                            $data->get_usuario(),
                            $data->get_clave(),
                            $data->get_activo(),
                            $data->get_idusuario()

                        )
                       );
            }

              catch (Exception $e){

                die($e->getMessage());
              }

      }

      public function Registrar (Usuario $data){

               try{
                   $sql="INSERT INTO usuarios (IDcargo,Nombre,Apellido,Usuario,Clave,Activo) VALUES (?,?,?,?,?,?)";

                   $this->pdo->prepare($sql)
                          ->execute(
                             array(
                               $data->get_idcargo(),
                               $data->get_nombre(),
                               $data->get_apellido(),
                               $data->get_usuario(),
                               $data->get_clave(),
                               $data->get_activo()
                           )
                          );

               }    
                      catch (Exception $e){

                        die($e->getMessage());
                      }


      }

     }
?>
