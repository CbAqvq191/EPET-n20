<?php
  require_once 'categoria.entidad.php';
  require_once 'categoria.model.php';
//creo los objetos con sus atributos y sus metodos
  $cat = new Categoria ();
  $model = new CategoriaModel();
  //isset pregunta si llega esta variable a este archivo al cargar
  if(isset($_POST['operacion'])){

    //cambiar los REQUEST a POST.

   switch($_POST['operacion']){

       case 'actualizar':
          //se graba un valor al atributo del objeto
          $cat->set_idcategoria($_POST['IDCategoria']);
          $cat->set_categoria($_POST['Categoria']);
          //se ejecuta el metodo pasandole un objeto por parametro
          $model->Actualizar($cat);
          header ('Location: categoria.php');
          break;

          case 'registrar';
              $cat->set_categoria($_POST['Categoria']);

              $model->Registrar($cat);
              header('Location: categoria.php');
            break;

          case 'eliminar':
                // Se ejecuta el metodo
                $model->Eliminar($_POST['IDCategoria']);
                header('Location: categoria.php');
            break;
            
            case 'editar':

                 $cat=$model->Obtener($_POST['IDCategoria']);
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

      <form action="categoria.php" method="post" class="pure-form pure-form-stacked">

        <input type="hidden" name="IDCategoria" value="<?php echo $cat->get_idcategoria(); ?>" />
        <input type="hidden" name="operacion" value="<?php echo $cat->get_idcategoria() > 0 ? 'actualizar' : 'registrar'; ?>" />

        <table>
          <tr>
            <th>Categoria:</th>
            <td><input type="text" name="Categoria" value="<?php echo $cat->get_categoria(); ?>" /></td>
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

            <table class="pure-table pure-table-horizontal">
              <thead>
                <tr>
                  <th>Categoria</th>
                </tr>
              </thead>

            <?php foreach($model->Listar() as $r): ?>

              <tr>
                <td><?php echo $r->get_categoria(); ?></td>
                <td>
                  <!-- <a href="?operacion=editar&IDCargo=<?php //echo $r->get_idcargo(); ?>">Editar</a>-->
                  <form action="categoria.php" method="POST">
                      <input type="hidden" name="operacion" value="editar">
                      <input type="hidden" name="IDCategoria" value="<?php echo $r->get_idcategoria(); ?>">
                      <input type="submit" value="EDITAR">

                  </form>
                </td>
                <td>
                 

                 <form action="categoria.php" method="POST">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="IDCategoria" value="<?php echo $r->get_idcategoria(); ?>">
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