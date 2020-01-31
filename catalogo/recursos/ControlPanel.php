


<?php 
if(isset ($_SESSION['user'])){ //detectamos si se inicio sesion:
//si existe algun usuario identificamos cual:
if (($_SESSION['user'] == "ROOT")or($_SESSION['user'] == "DEV")or($_SESSION['user'] == "ADMIN") ){ 
?>

<p class="violeta center">.:ADMIN. PRODUCTOS:.</p>
<a href="../categorias/categoria.php">Categorias</a><br/>
<a href="../productos/producto.php">Productos (admin.)</a><br/><br/>

<?php } ?>

<?php if($_SESSION['user'] == "ROOT"){ ?>
<p class="violeta center">.:USUARIOS:.</p>
<a href="../usuarios/usuario.php">Usuarios</a><br/>
<a href="../cargos/cargo.php">Cargos</a><br/>
<a href="../areas/area.php">Areas</a><br/><br/>

<?php 
}
}
?>

<p class="violeta center">.:INVITADO:.</p>
<a href="../invitado/UIproductos.php">Productos</a></br>
<a href="../invitado/contacto.php">Contacto</a><br/>
<a href="../invitado/quienesSomos.php">¿Quienes somos?</a>
<br/><br/>
<?php
if(!isset ($_SESSION['user'])){
	?>
	<hr/><br/>
	
<p class="center"><a href="../login">iniciar sesion</a> <br/><br/></p>
<?php } ?>

