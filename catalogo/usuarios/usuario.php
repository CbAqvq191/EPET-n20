<?php
  require_once 'usuario.entidad.php';
  require_once 'usuario.model.php';
  require_once '../cargos/cargo.entidad.php';
  require_once '../cargos/cargo.model.php';
//creo los objetos con sus atributos y sus metodos
  $usu = new Usuario ();
  $model = new UsuarioModel();
  $car = new Cargo ();
  $modelCar = new CargoModel();
  //isset pregunta si llega esta variable a este archivo al cargar
  if(isset($_POST['operacion'])){

    //cambiar los REQUEST a POST.

   switch($_POST['operacion']){

       case 'actualizar':
          //se graba un valor al atributo del objeto
          $usu->set_idusuario($_POST['IDUsuario']);
          $usu->set_usuario($_POST['Usuario']);
		  $usu->set_nombre($_POST['Nombre']);
		  
		  $clave=md5($_POST['Clave']);
		  $usu->set_clave($clave);
		  
		  $usu->set_apellido($_POST['Apellido']);
		  
		  $usu->set_idcargo($_POST['IDCargo']);
		  
		  
          //se ejecuta el metodo pasandole un objeto por parametro
          $model->Actualizar($usu);
          header ('Location: usuario.php');
          break;

          case 'registrar';
          $usu->set_usuario($_POST['Usuario']);
		  $usu->set_nombre($_POST['Nombre']); 
		  $clave=md5($_POST['Clave']);
		  $usu->set_clave($clave);
		  $usu->set_apellido($_POST['Apellido']);

		  $usu->set_idcargo($_POST['IDCargo']);
		  

              $model->Registrar($usu);
              header('Location: usuario.php');
            break;

          case 'eliminar':
                // Se ejecuta el metodo
                $model->Eliminar($_POST['IDUsuario']);
                header('Location: usuario.php');
            break;
            
            case 'editar':

                 $usu=$model->Obtener($_POST['IDUsuario']);
            break;    

    
        }
 }
 ?>


<?php $titulo= "Usuarios" ; include_once "../recursos/includes-cabeza.php";?>

      <form action="usuario.php" method="post" class="pure-form pure-form-stacked">

        <input type="hidden" name="IDUsuario" value="<?php echo $usu->get_idusuario(); ?>" />
        <input type="hidden" name="operacion" value="<?php echo $usu->get_idusuario() > 0 ? 'actualizar' : 'registrar'; ?>" />

        <table>
		
		
		<th>Cargo:</th><!-- EDITAR ESTO -->
            <td>
            <select name="IDCargo">
            <option disabled selected="selected" value="">Seleccione</option>
			
             <?php foreach($modelCar->Listar() as $r):
                  echo '<option value="'.$r->get_idcargo().'-'.$r->get_cargo().'"';
                  if($r->get_idcargo()==$usu->get_idcargo()){
                    echo ' selected="selected" ';
                  }
                  echo '>'.$r->get_area().' / '.$r->get_cargo().'</option>';
             endforeach; ?>
			 
			<?php echo ''
			?>
			 
			 </select>
            </td><!-- HASTA ESTE -->
		
		
          <tr>
            <th>Usuario:</th>
            <td><input type="text" name="Usuario" value="<?php echo $usu->get_usuario(); ?>" required /></td>
          </tr>
		  <tr>
            <th>Nombre:</th>
            <td><input type="text" name="Nombre" value="<?php echo $usu->get_nombre(); ?>" required /></td>
          </tr>
		  <tr>
            <th>Apellido:</th>
            <td><input type="text" name="Apellido" value="<?php echo $usu->get_apellido(); ?>" required /></td>
          </tr>
		  <tr>
            <th>Clave:</th>
            <td><input type="password" name="Clave" value="<?php //echo $usu->get_clave(); ?>" required /></td>
          </tr>
             <tr>
              <td colspan="2">
              <br/>
                   <button type="submit" class="pure-button pure-button-primary">Guardar</button>
              </td>

          </tr>
        </table>
      </form>

    <br/>
<br/>


            <table class="pure-table pure-table-horizontal">
              <thead>
                <tr>
                  <th>Nombre</th>
				  <th>Apellido</th>
				  <th>Usuario</th>
				  <th>Cargo</th>
                </tr>
              </thead>


            <?php foreach($model->Listar() as $r): ?>

              <tr>
                <td><?php echo $r->get_nombre(); ?></td>
				<td><?php echo $r->get_apellido(); ?></td>
				<td><?php echo $r->get_usuario(); ?></td>
				<td><?php echo $r->get_cargo();?></td>
				
				
                <td>
                  <!-- <a href="?operacion=usutar&IDCargo=<?php //echo $r->get_idcargo(); ?>">Editar</a>-->
                  <form action="usuario.php" method="POST">
                      <input type="hidden" name="operacion" value="editar">
                      <input type="hidden" name="IDUsuario" value="<?php echo $r->get_idusuario(); ?>">
                      <input type="submit" value="EDITAR">

                  </form>
                </td>
                <td>
                 

                 <form action="usuario.php" method="POST">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="IDUsuario" value="<?php echo $r->get_idusuario(); ?>">
                      <input type="submit" value="ELIMINAR">

                  </form>
                </td>
              </tr>
          <?php endforeach; ?>
        </table>

<?php include_once "../recursos/includes-pie.php";?>