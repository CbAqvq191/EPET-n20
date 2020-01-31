<?php
  require_once 'usuario.entidad.php';
  require_once 'usuario.model.php';

  $usu = new Usuario();
  $model = new UsuarioModel();

  require_once '../Cargos/cargo.entidad.php';
  require_once '../Cargos/cargo.model.php';

  $cargo = new Cargo ();
  $modelcargo = new CargoModel();

  if(isset($_POST['IDcargo'])){
    $idcargo=$_POST['IDcargo'];
  }
  if(isset($_POST['operacion'])){

   switch($_POST['operacion']){

   	   case 'actualizar':
   	      $usu->set_idusuario($_POST['IDusuario']);
          $usu->set_idcargo($_POST['IDcargo']);
   	      $usu->set_nombre($_POST['Nombre']);
          $usu->set_apellido($_POST['Apellido']);
          $usu->set_usuario($_POST['Usuario']);
          $usu->set_clave($_POST['Clave']);
          $usu->set_activo($_POST['Activo']);

   	      $model->Actualizar($usu);
   	      //header ('Location:usuario.php');
   	      break;

   	    case 'registrar';
   	      $usu->set_idusuario($_POST['IDusuario']);
          $usu->set_idcargo($_POST['IDcargo']);
          $usu->set_nombre($_POST['Nombre']);
          $usu->set_apellido($_POST['Apellido']);
          $usu->set_usuario($_POST['Usuario']);
          $usu->set_clave($_POST['Clave']);
          $usu->set_activo($_POST['Activo']);

   	          $model->Registrar($usu);
   	          //header('Location: usuario.php');
   	        break;

          case 'eliminar':

                $model->Eliminar($_POST['IDusuario']);
          break;
            
            case 'editar':

                 $usu=$model->Obtener($_POST['IDusuario']);
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
      <form action="usuario.php" method="POST" class="pure-form pure-form-stacked">
  <table>
          <tr>
            <th>Cargos:</th>
            <td>
               <select name="IDcargo" onChange="this.form.submit();">
                <option>Seleccione...</option>
                <?php foreach($modelcargo->Listar() as $r):?>
                    <option 
                    <?php if(isset($_POST['IDcargo']) && $idcargo==$r->get_idcargo()){
                      echo 'selected="selected"';
                    } ?>
                     value="<?php echo $r->get_idcargo();?>"><?php echo $r->get_cargo();?></option>
                <?php endforeach; ?>
              </select>
            </form>            
            </td>
          </tr>
          <form action="usuario.php" method="POST" class="pure-form pure-form-stacked">


        <input type="hidden" name="operacion" value="<?php echo $usu->get_idusuario() > 0 ? 'actualizar' : 'registrar'; ?>" />
<input type="hidden" name="IDusuario" value="<?php echo $usu->get_idusuario(); ?>" />

      
          <tr>
            <th>Nombre:</th>
            <td><input type="text" name="Nombre" value="<?php echo $usu->get_nombre(); ?>" /></td>
          </tr>
          <tr>
            <th>Apellido:</th>
            <td><input type="text" name="Apellido" value="<?php echo $usu->get_apellido(); ?>" /></td>
          </tr>
          <tr>
            <th>Usuario:</th>
            <td><input type="text" name="Usuario" value="<?php echo $usu->get_usuario(); ?>" /></td>
          </tr>
          <tr>
            <th>Clave:</th>
            <td><input type="password" name="Clave" value="<?php echo $usu->get_clave(); ?>" /></td>
          </tr>
          <tr>
            <th>Activo:</th>
            <?php 
              if(isset($_POST['operacion']) && $_POST['operacion']=='editar'){
                if($usu->get_activo()=='SI'){ ?>
                  <td><input type="radio" name="Activo" value="SI" checked="checked"/>Si</td>
                  <td><input type="radio" name="Activo" value="NO"/>No</td>      
                <?php }else{
                  ?>
                  <td><input type="radio" name="Activo" value="SI"/>Si</td>
                  <td><input type="radio" name="Activo" value="NO" checked="checked"/>No</td>
               <?php }
              }else{
                ?>
                  <td><input type="radio" name="Activo" value="SI" checked="checked"/>Si</td>
                  <td><input type="radio" name="Activo" value="NO"/>No</td>      
                <?php
              }
             ?>
            
          </tr>
             <tr>
              <td colspan="2">
              <?php if(isset($_POST['IDcargo'])){ ?>
                   <input type="hidden" name="IDcargo" value="<?php echo $idcargo; ?>" />
                   <button type="submit" class="pure-button pure-button-primary">Guardar</button>
              <?php } ?>
              </td>

          </tr>
        </table>
      </form>

            <table class="pure-table pure-table-horizontal">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Usuario</th>
                  <th>Activo</th>
                </tr>
              </thead>


            <?php 
            if(isset($_POST['IDcargo'])){ 
              
            foreach($model->ListarXCargo($idcargo) as $r): ?>

              <tr>
                <td><?php echo $r->get_nombre(); ?></td>
                <td><?php echo $r->get_apellido(); ?></td>
                <td><?php echo $r->get_usuario(); ?></td>
                <td><?php echo $r->get_activo(); ?></td>
                <td>
                <form action="usuario.php" method="POST">
                      <input type="hidden" name="operacion" value="editar">
                      <input type="hidden" name="IDcargo" value="<?php echo $idcargo; ?>" />
                      <input type="hidden" name="IDusuario" value="<?php echo $r->get_idusuario(); ?>">
                      <input type="submit" value="EDITAR">

                  </form>
                </td>
                <td>
                <form action="usuario.php" method="POST">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="IDcargo" value="<?php echo $idcargo; ?>" />
                      <input type="hidden" name="IDusuario" value="<?php echo $r->get_idusuario(); ?>">
                      <input type="submit" value="ELIMINAR">

                  </form>
                </td>
              </tr>
          <?php endforeach; 
          } ?>
        </table>

      </div>
    </div>

  </body>
  </html>