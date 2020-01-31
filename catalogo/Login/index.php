<?php $titulo = "Inicio sesion"; $validar = 1; include_once "../recursos/includes-cabeza.php"; 

?>
<table>
<form action="usuarioValidar.php" method="POST">
<tr>
<th>	Usuario: </th>
<td>	<input type="text" placeholder="  Ingrese Usuario" name="user" required /><br/> </td>
</tr> <tr>
<th>	Contraseña: </th>
<td>	<input type="password" placeholder="  Ingrese Contraseña" name="pass" required /><br/> </td>
</tr> <tr>
<td> </td>
<td>	<button type="submit" value="Ingresar">Ingresar</button> </td>
</tr>
</form>
</table>
<?php include_once "../recursos/includes-pie.php";?>