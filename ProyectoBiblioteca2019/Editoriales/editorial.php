<?php
  require_once 'editorial.entidad.php';
  require_once 'editorial.model.php';
//creo los objetos con sus atributos y sus metodos
  $edi = new Editorial ();
  $model = new EditorialModel();
  //isset pregunta si llega esta variable a este archivo al cargar
  if(isset($_POST['operacion'])){

    //cambiar los REQUEST a POST.

   switch($_POST['operacion']){

       case 'actualizar':
          //se graba un valor al atributo del objeto
          $edi->set_ideditorial($_POST['IDEditorial']);
          $edi->set_editorial($_POST['Editorial']);
          //se ejecuta el metodo pasandole un objeto por parametro
          $model->Actualizar($edi);
          header ('Location: editorial.php');
          break;

          case 'registrar';
              $edi->set_editorial($_POST['Editorial']);

              $model->Registrar($edi);
              header('Location: editorial.php');
            break;

          case 'eliminar':
                // Se ejecuta el metodo
                $model->Eliminar($_POST['IDEditorial']);
                header('Location: editorial.php');
            break;
            
            case 'editar':

                 $edi=$model->Obtener($_POST['IDEditorial']);
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

      <form action="editorial.php" method="post" class="pure-form pure-form-stacked">

        <input type="hidden" name="IDEditorial" value="<?php echo $edi->get_ideditorial(); ?>" />
        <input type="hidden" name="operacion" value="<?php echo $edi->get_ideditorial() > 0 ? 'actualizar' : 'registrar'; ?>" />

        <table>
          <tr>
            <th>Editorial:</th>
            <td><input type="text" name="Editorial" value="<?php echo $edi->get_editorial(); ?>" /></td>
          </tr>
             <tr>
              <td colspan="2">
                   <button type="submit" class="pure-button pure-button-primary">Guardar</button>
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
                  <th>Editorial</th>
                </tr>
              </thead>


            <?php foreach($model->Listar() as $r): ?>

              <tr>
                <td><?php echo $r->get_editorial(); ?></td>
                <td>
                  <!-- <a href="?operacion=editar&IDCargo=<?php //echo $r->get_idcargo(); ?>">Editar</a>-->
                  <form action="editorial.php" method="POST">
                      <input type="hidden" name="operacion" value="editar">
                      <input type="hidden" name="IDEditorial" value="<?php echo $r->get_ideditorial(); ?>">
                      <input type="submit" value="EDITAR">

                  </form>
                </td>
                <td>
                 

                 <form action="editorial.php" method="POST">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="IDEditorial" value="<?php echo $r->get_ideditorial(); ?>">
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