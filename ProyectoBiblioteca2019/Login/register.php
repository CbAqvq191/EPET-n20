<?php
include("includes/header.php");
session_start();
$message="";
?>

<div class="container mregister">
	<div id="login">
		<h1>Registrar</h1>
		<form name="registerform" id="registerform" action="registerCN.php" method="post">
		   <p>
		   	 <label for="user_login">Nombre Completo<br/>
		   	 <input type="text" name="full_name" id="fullname" class="input" size="32" value="" /></label>
		   </p>
		   <p>
		   	 <label for="user_pass">E-mail<br/>
		   	 <input type="email" name="email" id="email" class="input" size="32" value="" /></label>
		   </p>
		   <p>
		   	<label for="user_pass">Nombre de Usuario<br/>
		   	 <input type="text" name="username" id="username" class="input" size="20" value="" /></label>
		   </p>
		   <p>
		   	<label for="user_login">Contraseña<br/>
		   	 <input type="password" name="password" id="password" class="input" size="32" value="" /></label>
		   </p>
		   <p class="submit">
		   	<input type="submit" name="register" id="register" class="button" value="Registrar" />
		   </p>
		   <p class="regtext">Ya tienen una cuenta?<a href="login.php">Inicia Sesión Aquí</a>!</p>
</form>
</div>
</div>
<?php
   
   if (!empty($_SESSION['mensaje'])){
   	echo "<p class=\"error\">" . "MENSAJE.". $_SESSION['mensaje']."</p>";
   }

 ?>