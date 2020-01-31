<?php
require_once("includes/conexion.php");
require_once("claseUser.php");

session_start();

$message="";

$instanciaUser = new User();

if(isset($_POST["register"])){
     if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])){

       $instanciaUser->set_full_name($_POST['full_name']);
       $instanciaUser->set_email($_POST['email']);
       $instanciaUser->set_username($_POST['username']);
       $instanciaUser->set_password(md5($_POST['password']));

       $con=new conexion();

       $stm= $con->getConexion()->prepare("SELECT * FROM usuarios WHERE username = ?");
       $stm->execute(array($instanciaUser->get_username() ));

       $r=$stm->fetch(PDO::FETCH_OBJ);
           if(empty($r)){

           	 $con=new conexion();

           	 $sql="INSERT INTO usuarios(full_name,email,username,password)
           	 VALUES (?,?,?,?)";

           	 $result=$con->getConexion()->prepare($sql)
           	     ->execute(
           	         array(
           	         	$instanciaUser->get_full_name(),
           	            $instanciaUser->get_email(),
           	            $instanciaUser->get_username(),
           	            $instanciaUser->get_password()
           	        )
           	     );
           	     if($result){
           	     	$message="Cuenta Correctamente Creada";
           	     }
           	     else{
           	     	$message="Error al ingresar datos del Usuario!";
           	     }

           	     } else{
           	     	$message="El nombre de usuario ya existe! Por favor, intenta con otro!";
           	     }

           	     } else{

           	     	$message ="Todos los campos deben ser completados!";
           	     }
           	  }

           	  if ($message!=""){
           	  	$_SESSION['mensaje']=$message;
           	  }
           	  header("Location:register.php");

?>