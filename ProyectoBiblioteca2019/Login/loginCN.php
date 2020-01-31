<?php
require_once("includes/conexion.php");
require_once("claseUser.php");

session_start();

$message="";

$user= new User();
if(isset($_SESSION["session_username"])){
	header("Location: intropage.php");
}
if(isset($_POST["login"])){

echo "isset POST login";

	if(!empty($_POST['username']) && !empty($_POST['password'])){

          echo "estoy en distinto vacio user y pass";

          $user->set_username($_POST['username']);
          $user->set_password(md5($_POST['password']));   

          $con = new conexion();

          $stm = $con->getConexion()->prepare("SELECT * FROM usuarios WHERE username = ? AND password = ?");
          $stm->execute(array($user->get_username(),
                              $user->get_password()
             )
      );
          $r = $stm->fetch(PDO::FETCH_OBJ);

          if(!empty($r)){
          	echo "r esta dentro";
            $_SESSION['session_username']=$user->get_username();
            header("Location: intropage.php");
          }
          else{
             $message = "Nombre de usuario o contraseña invalida!";
          }
	}
   else{
   	$message = "Todos los campos son requeridos!";
   }
}
if ($message!=""){
	$_SESSION['mensaje']=$message;
	//header ("Location:login.php");
}

?>