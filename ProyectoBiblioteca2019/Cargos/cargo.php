<?php
  require_once 'cargo.entidad.php';
  require_once 'cargo.model.php';
//creo los objetos con sus atributos y sus metodos
  $car = new Cargo ();
  $model = new CargoModel();
  //isset pregunta si llega esta variable a este archivo al cargar
  if(isset($_POST['operacion'])){

   switch($_POST['operacion']){

       case 'actualizar':
          //se graba un valor al atributo del objeto
          $car->set_idcargo($_POST['IDCargo']);
          $car->set_cargo($_POST['Cargo']);
          $car->set_idsuperior($_POST['IDSuperior']);
          //se ejecuta el metodo pasandole un objeto por parametro
          $model->Actualizar($car);
          header ('Location: cargo.php');
          break;

          case 'registrar';
              $car->set_idcargo($_POST['IDCargo']);
              $car->set_cargo($_POST['Cargo']);
              $car->set_idsuperior($_POST['IDSuperior']);

              $model->Registrar($car);
              header('Location: cargo.php');
            break;

          case 'eliminar':
                // Se ejecuta el metodo
                $model->Eliminar($_POST['IDCargo']);
                header('Location: cargo.php');
            break;
            
            case 'editar':

                 $car=$model->Obtener($_POST['IDCargo']);
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

      <form action="cargo.php" method="post" class="pure-form pure-form-stacked">

        <input type="hidden" name="IDCargo" value="<?php echo $car->get_idcargo(); ?>" />
        <input type="hidden" name="operacion" value="<?php echo $car->get_idcargo() > 0 ? 'actualizar' : 'registrar'; ?>" />

        <table>
          <tr>
            <th>Cargo:</th>
            <td><input type="text" name="Cargo" value="<?php echo $car->get_cargo(); ?>" /></td>
          </tr>
          <tr>
            <th>Superior:</th>
            <td>
              <!--               Identificacion de cargo                  -->
              <select name="IDSuperior">
                <option>Seleccione...</option>
                <option
                <?php 
                if($car->get_idsuperior()==0){
                  echo 'selected="selected"';
                }
                 ?>
                 value='0'>Ninguno</option>

                <?php foreach($model->listar() as $r):?>
                    <option 
                    <?php if($car->get_idsuperior()==$r->get_idcargo()){
                      echo 'selected="selected"';
                    } ?>
                     value="<?php echo $r->get_idcargo();?>"><?php echo $r->get_cargo();?></option>
                <?php endforeach; ?>
              </select>
            </td>
          </tr>
             <tr>
              <td colspan="2">
                   <button type="submit" class="pure-button pure-button-primary">Guardar</button>
              </td>

          </tr>
        </table>
      </form>

            <table class="pure-table pure-table-horizontal">
              <thead>
                <tr>
                  <th>Cargo</th>
                  <th>Superior</th>
                </tr>
              </thead>


            <?php foreach($model->Listar() as $r): ?>

              <tr>
                <td><?php echo $r->get_cargo(); ?></td>
                <!--<td><?php // echo $r->get_idsuperior() == 0 ? 0 : 1; ?></td>-->
                <td><?php
                echo $r -> get_superior();
                
                  ?></td>
                <td>
                  <!-- <a href="?operacion=editar&IDCargo=<?php //echo $r->get_idcargo(); ?>">Editar</a>-->
                  <form action="cargo.php" method="POST">
                      <input type="hidden" name="operacion" value="editar">
                      <input type="hidden" name="IDCargo" value="<?php echo $r->get_idcargo(); ?>">
                      <input type="submit" value="EDITAR">

                  </form>

                         <!--cambiar el ? por index.php?-->
                </td>
                <td>
                 

                 <form action="cargo.php" method="POST">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="IDCargo" value="<?php echo $r->get_idcargo(); ?>">
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











