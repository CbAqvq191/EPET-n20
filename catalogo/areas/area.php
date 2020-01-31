<?php
  require_once 'area.entidad.php';
  require_once 'area.model.php';
//creo los objetos con sus atributos y sus metodos
  $edi = new Area ();
  $model = new AreaModel();
  //isset pregunta si llega esta variable a este archivo al cargar
  if(isset($_POST['operacion'])){

    //cambiar los REQUEST a POST.

   switch($_POST['operacion']){

       case 'actualizar':
          //se graba un valor al atributo del objeto
          $edi->set_idarea($_POST['IDArea']);
          $edi->set_area($_POST['Area']);
          //se ejecuta el metodo pasandole un objeto por parametro
          $model->Actualizar($edi);
          header ('Location: area.php');
          break;

          case 'registrar';
              $edi->set_area($_POST['Area']);

              $model->Registrar($edi);
              header('Location: area.php');
            break;

          case 'eliminar':
                // Se ejecuta el metodo
                $model->Eliminar($_POST['IDArea']);
                header('Location: area.php');
            break;
            
            case 'editar':

                 $edi=$model->Obtener($_POST['IDArea']);
            break;    

    
        }
 }
 ?>

<?php $titulo= "Areas" ; include_once "../recursos/includes-cabeza.php";?>

      <form action="area.php" method="post" class="pure-form pure-form-stacked">

        <input type="hidden" name="IDArea" value="<?php echo $edi->get_idarea(); ?>" />
        <input type="hidden" name="operacion" value="<?php echo $edi->get_idarea() > 0 ? 'actualizar' : 'registrar'; ?>" />

        <table>
          <tr>
            <th>Area:</th>
            <td><input type="text" name="Area" value="<?php echo $edi->get_area(); ?>" required /></td>
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
                  <th>Area</th>
                </tr>
              </thead>


            <?php foreach($model->Listar() as $r): ?>

              <tr>
                <td><?php echo $r->get_area(); ?></td>
                <td>
                  <!-- <a href="?operacion=editar&IDCargo=<?php //echo $r->get_idcargo(); ?>">Editar</a>-->
                  <form action="area.php" method="POST">
                      <input type="hidden" name="operacion" value="editar">
                      <input type="hidden" name="IDArea" value="<?php echo $r->get_idarea(); ?>">
                      <input type="submit" value="EDITAR">

                  </form>
                </td>
                <td>
                 

                 <form action="area.php" method="POST">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="IDArea" value="<?php echo $r->get_idarea(); ?>">
                      <input type="submit" value="ELIMINAR">

                  </form>
                </td>
              </tr>
          <?php endforeach; ?>
        </table>

<?php include_once "../recursos/includes-pie.php";?>