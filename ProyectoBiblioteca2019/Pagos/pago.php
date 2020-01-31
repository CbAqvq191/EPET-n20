<?php
  require_once 'pago.entidad.php';
  require_once 'pago.model.php';
//creo los objetos con sus atributos y sus metodos
  $pag = new Pago ();
  $model = new PagoModel();
  //isset pregunta si llega esta variable a este archivo al cargar
  if(isset($_POST['operacion'])){

   switch($_POST['operacion']){

       case 'actualizar':
        //se graba un valor al atributo del objeto
          $pag->set_iddebe($_POST['IDDebe']);
          $pag->set_debe($_POST['Debe']);
          $pag->set_nombre($_POST['Nombre']);
          //se ejecuta el metodo pasandole un objeto por parametro
          $model->Actualizar($pag);
          header ('Location: pago.php');
          break;

          case 'registrar';
              $pag->set_debe ($_POST['Debe']);
              $pag->set_nombre($_POST['Nombre']);

              $model->Registrar($pag);
              header('Location: pago.php');
            break;

          case 'eliminar':
                // Se ejecuta el metodo
                $model->Eliminar($_POST['IDDebe']);
                header('Location: pago.php');
            break;
            
            case 'editar':

                 $pag=$model->Obtener($_POST['IDDebe']);
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

      <form action="pago.php" method="post" class="pure-form pure-form-stacked">

        <input type="hidden" name="IDDebe" value="<?php echo $pag->get_iddebe(); ?>" />
        <input type="hidden" name="operacion" value="<?php echo $pag->get_iddebe() > 0 ? 'actualizar' : 'registrar'; ?>" />

        <table>
          <tr>
            <th>Nombre:</th>
            <td><input type="text" name="Nombre" value="<?php echo $pag->get_nombre(); ?>" /></td>
          </tr>
          <tr>
            <th>Debe:</th>
            <td><input type="text" name="Debe" value="<?php echo $pag->get_debe(); ?>" /></td>
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
                  <th>Nombre</th>
                  <th>Debe</th>
                </tr>
              </thead>


            <?php foreach($model->Listar() as $r): ?>

              <tr>
                <td><?php echo $r->get_nombre(); ?></td>
                <!--<td><?php // echo $r->get_idsuperior() == 0 ? 0 : 1; ?></td>-->
                <td><?php
                echo $r -> get_debe();
                
                  ?></td>
                <td>
                  <!-- <a href="?operacion=editar&IDCargo=<?php //echo $r->get_idcargo(); ?>">Editar</a>-->
                  <form action="pago.php" method="POST">
                      <input type="hidden" name="operacion" value="editar">
                      <input type="hidden" name="IDDebe" value="<?php echo $r->get_iddebe(); ?>">
                      <input type="submit" value="EDITAR">

                  </form>

                         <!--cambiar el ? por index.php?-->
                </td>
                <td>
                 

                 <form action="pago.php" method="POST">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="IDDebe" value="<?php echo $r->get_iddebe(); ?>">
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











