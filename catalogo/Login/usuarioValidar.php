
<?php $titulo = "Validacion"; include_once "../recursos/includes-cabeza.php"; ?>

<?php 
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		$USER = strtoupper($_POST['user']);
		$PASS = md5($_POST['pass']);
		
		require('../recursos/conexion.php');
		$con = new conexion();
		$conexion = $con->getConexion();
		
		$query = $conexion -> prepare ("SELECT * FROM usuarios WHERE Usuario = ? AND Clave = ?"); //primero preparamos la consulta.
		$query -> execute (array($USER,$PASS)); //ejecutamos aparte para que no se den fallos con el fetch()
		$resultado = $query -> fetch();
		
		if($resultado >> 0){
			session_start();
			$_SESSION['user']= $USER;
			$_SESSION['Time']= time();
			
			include_once "../index";
		}			
		}
		
	
?>
