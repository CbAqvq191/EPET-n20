<?php
  require_once 'costo.entidad.php';
  require_once 'costo.model.php';
//creo los objetos con sus atributos y sus metodos
  $cos = new Costo();
  $model = new CostoModel();
  //isset pregunta si llega esta variable a este archivo al cargar
  if(isset($_POST['operacion'])){

   switch($_POST['operacion']){

       case 'actualizar':
          //se graba un valor al atributo del objeto
          $cos->set_idcosto($_POST['IDCosto']);
          $cos->set_costo($_POST['Costo']);
          $cos->set_ciclolectivo($_POST['Ciclolectivo']);
          //se ejecuta el metodo pasandole un objeto por parametro
          $model->Actualizar($cos);
          header ('Location: costo.php');
          break;

          case 'registrar';
              $cos->set_idcosto($_POST['IDCosto']);
              $cos->set_costo($_POST['Costo']);
              $cos->set_ciclolectivo($_POST['Ciclolectivo']);

              $model->Registrar($cos);
              header('Location: costo.php');
            break;

          case 'eliminar':
                // Se ejecuta el metodo
                $model->Eliminar($_POST['IDCosto']);
                header('Location: costo.php');
            break;
            
            case 'editar':

                 $cos=$model->Obtener($_POST['IDCosto']);
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

      <form action="costo.php" method="post" class="pure-form pure-form-stacked">

        <input type="hidden" name="IDCosto" value="<?php echo $cos->get_idcosto(); ?>" />
        <input type="hidden" name="operacion" value="<?php echo $cos->get_idcosto() > 0 ? 'actualizar' : 'registrar'; ?>" />

        <table>
          <tr>
            <th>Costo:$</th>
            <td><input type="text" name="Costo" value="<?php echo $cos->get_costo(); ?>" /></td>
          </tr>
          <tr>
            <th>Ciclo Lectivo:</th>
            <td>
              <!--               Identificacion de cargo                  -->
              <select name="Ciclolectivo">
                 <option>Seleccione...</option>
                 <?php 
                  $year=date("Y");
                 for($i=$year; $i<$year+15; $i++){
                    echo '<option value"'.$i.'">'.$i.'</option>';
                  }
                  ?>
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
                  <th>Costo</th>
                  <th>Ciclo Lectivo</th>
                </tr>
              </thead>


            <?php foreach($model->Listar() as $r): ?>

              <tr>
                <td><?php echo $r->get_costo(); ?></td>
                <!--<td><?php // echo $r->get_idsuperior() == 0 ? 0 : 1; ?></td>-->
                <td><?php
                echo $r -> get_ciclolectivo();
                
                  ?></td>
                <td>
                  <!-- <a href="?operacion=editar&IDCargo=<?php //echo $r->get_idcargo(); ?>">Editar</a>-->
                  <form action="costo.php" method="POST">
                      <input type="hidden" name="operacion" value="editar">
                      <input type="hidden" name="IDCosto" value="<?php echo $r->get_idcosto(); ?>">
                      <input type="submit" value="EDITAR">

                  </form>

                         <!--cambiar el ? por index.php?-->
                </td>
                <td>
                 

                 <form action="costo.php" method="POST">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="IDCosto" value="<?php echo $r->get_idcosto(); ?>">
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