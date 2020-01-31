<?php session_start();




if(!isset ($_SESSION['user'])){
	if(($validar <> 1)and($validar <> 2)){
	header ('Location: ../login');
	}
}else{
	if($_SESSION['Time']){
	if((time () - $_SESSION['Time']) > 300){
		session_destroy();
		header ('Refresh: 2; url=../login');
		echo "la sesión a caducado. Redireccionando";
	}else{
		$_SESSION['Time'] =time ();
	}
}else{
	header("refresh:2; url=../login");
}
}

if($validar = 2){
?>
<!DOCTYPE html>
 <html lang="es">
   <head>
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" href="../recursos/estilos.css">
	<link rel="stylesheet" href="recursos/estilos.css">
	<link rel="stylesheet" href="estilos.css">
   </head>
   <body>
	  <div class="cabeza">
	  
      <br/><br/>
	  </div> <!--  cabeza  -->
	  <div class="centrado">
	  <table class="vista">
	  <tr >
	  </td> <!--  contenido  -->


<td class="lateral">
<h2><a href="../" class="center">Home</a></h2><br/><br/>
<?php if(isset ($_SESSION['user'])){ ?>
<table>
<tr>
<td>

<img src="../recursos/imag/users/user(Normal).png" title="imagen" width="64px" class="avatar" alt=""/>
</td>
<td>
<div class="violeta"><?php echo $_SESSION['user'];?><br/></div>
<a href="../login/cerrarSesion.php">Cerrar Sesion</a><br/>
</td>
</tr>

</table>

<br/><br/>

<?php }?>
<?php include_once "ControlPanel.php";?>


</td>

	  <td class="contenido">
	  <h1><?php echo $titulo;?></h1>
	  <div class="tablas">
	  <br/>
	  
	  
<?php } ?>	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  