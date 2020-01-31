<?php
  require_once 'socio.entidad.php';
  require_once 'socio.model.php';

  $soc = new Socio ();
  $model = new SocioModel();

  if(isset($_POST['operacion'])){

   switch($_POST['operacion']){

   	   case 'actualizar':
   	      $soc->set_idsocio($_POST['IDsocio']);
   	      $soc->set_nombre($_POST['Nombre']);
          $soc->set_apellido($_POST['Apellido']);
          $soc->set_direccion($_POST['Direccion']);
          $soc->set_telefono($_POST['Telefono']);
          $soc->set_fechanacimiento($_POST['Fechanacimiento']);
          $soc->set_dni($_POST['Dni']);
   	      $model->Actualizar($soc);
   	      header ('Location:socio.php');
   	      break;

   	    case 'registrar';
        echo "aaaaaaa";
          $soc->set_idsocio($_POST['IDsocio']);
          $soc->set_nombre($_POST['Nombre']);
          $soc->set_apellido($_POST['Apellido']);
          $soc->set_direccion($_POST['Direccion']);
          $soc->set_telefono($_POST['Telefono']);
          $soc->set_fechanacimiento($_POST['Fechanacimiento']);
          $soc->set_dni($_POST['Dni']);

   	          $model->Registrar($soc);
   	          header('Location: socio.php');
   	        break;

          case 'eliminar':

                $model->Eliminar($_POST['IDsocio']);
                header('Location: socio.php');
            break;
            
            case 'editar':

                 $soc=$model->Obtener($_POST['IDsocio']);
            break;    

    
        }
 }
 ?>


<!DOCTYPE html>
 <html lang="es">
   <head>
    <title>Anexsoft</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
   </head>
   <body>
      <div class="pure-g">
      <div class="pure-u-1-12">
      <form action="socio.php" method="POST" class="pure-form pure-form-stacked">


        <input type="hidden" name="operacion" value="<?php echo $soc->get_idsocio() > 0 ? 'actualizar' : 'registrar'; ?>" />
<input type="hidden" name="IDsocio" value="<?php echo $soc->get_idsocio(); ?>" />

        <table>
          <tr>
            <th>Nombre:</th>
            <td><input type="text" name="Nombre" value="<?php echo $soc->get_nombre(); ?>" /></td>
          </tr>
          <tr>
            <th>Apellido:</th>
            <td><input type="text" name="Apellido" value="<?php echo $soc->get_apellido(); ?>" /></td>
          </tr>
          <tr>
            <th>Direccion:</th>
            <td><input type="text" name="Direccion" value="<?php echo $soc->get_direccion(); ?>" /></td>
          </tr>
          <tr>
            <th>Telefono:</th>
            <td><input type="text" name="Telefono" value="<?php echo $soc->get_telefono(); ?>" /></td>
          </tr>
          <tr>
            <th>Fecha de Nacimiento:</th>
            <td><input type="date" name="Fechanacimiento" value="<?php echo $soc->get_fechanacimiento(); ?>" /></td>
          </tr>
          <tr>
            <th>DNI:</th>
            <td><input type="int" name="Dni" value="<?php echo $soc->get_dni(); ?>" /></td>
          </tr>
             <tr>
              <td colspan="2">
              <br/>
                   <button type="submit" class="pure-button pure-button-primary">Agregar</button>
              </td>

          </tr>
        </table>
      </form>
<br/>
<br/>
<br/>


            <table class="pure-table pure-table-horizontal">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Direccion</th>
                  <th>Telefono</th>
                  <th>Fecha de Nacimiento</th>
                  <th>DNI</th>
                </tr>
              </thead>


            <?php foreach($model->Listar() as $r): ?>

              <tr>
                <td><?php echo $r->get_nombre(); ?></td>
                <td><?php echo $r->get_apellido(); ?></td>
                <td><?php echo $r->get_direccion(); ?></td>
                <td><?php echo $r->get_telefono(); ?></td>
                <td><?php echo $r->get_fechanacimiento(); ?></td>
                <td><?php echo $r->get_dni(); ?></td>
                <td>
                <form action="socio.php" method="POST">
                      <input type="hidden" name="operacion" value="editar">
                      <input type="hidden" name="IDsocio" value="<?php echo $r->get_idsocio(); ?>">
                      <input type="submit" value="EDITAR">

                  </form>
                </td>
                <td>
                <form action="socio.php" method="POST">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="IDsocio" value="<?php echo $r->get_idsocio(); ?>">
                      <input type="submit" value="ELIMINAR">

                  </form>
                </td>
              </tr>
          <?php endforeach; ?>
        </table>

      </div>
    </div>

  </body>
  </html>











