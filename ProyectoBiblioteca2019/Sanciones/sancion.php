<?php
  require_once 'sancion.entidad.php';
  require_once 'sancion.model.php';

  $san = new Sancion ();
  $model = new SancionModel();

  if(isset($_POST['operacion'])){

   switch($_POST['operacion']){

   	   case 'actualizar':
   	      $san->set_idsancion($_POST['IDssancion']);
   	      $san->set_nombre($_POST['Nombre']);
          $san->set_apellido($_POST['Apellido']);
          $san->set_monto($_POST['Monto']);
          $san->set_descripcion($_POST['Descripcion']);
          $san->set_pago($_POST['Pago']);
   	      $model->Actualizar($san);
   	      header ('Location:sancion.php');
   	      break;

   	    case 'registrar';
          $san->set_idsancion($_POST['IDsancion']);
          $san->set_nombre($_POST['Nombre']);
          $san->set_apellido($_POST['Apellido']);
          $san->set_monto($_POST['Monto']);
          $san->set_descripcion($_POST['Descripcion']);
          $san->set_pago($_POST['Pago']);

   	          $model->Registrar($san);
   	          header('Location: sancion.php');
   	        break;

          case 'eliminar':

                $model->Eliminar($_POST['IDsancion']);
                header('Location: sancion.php');
            break;
            
            case 'editar':

                 $san=$model->Obtener($_POST['IDsancion']);
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
      <form action="sancion.php" method="POST" class="pure-form pure-form-stacked">


        <input type="hidden" name="operacion" value="<?php echo $san->get_idsancion() > 0 ? 'actualizar' : 'registrar'; ?>" />
<input type="hidden" name="IDsancion" value="<?php echo $san->get_idsancion(); ?>" />

        <table>
          <tr>
            <th>Nombre:</th>
            <td><input type="text" name="Nombre" value="<?php echo $san->get_nombre(); ?>" /></td>
          </tr>
          <tr>
            <th>Apellido:</th>
            <td><input type="text" name="Apellido" value="<?php echo $san->get_apellido(); ?>" /></td>
          </tr>
          <tr>
            <th>Monto:$</th>
            <td><input type="text" name="Monto" value="<?php echo $san->get_monto(); ?>" /></td>
          </tr>
          <tr>
            <th>Descripcion:</th>
            <td><input type="text" name="Descripcion" value="<?php echo $san->get_descripcion(); ?>" /></td>
          </tr>
          <tr>
            <th>Pago:</th>
            <?php 
              if(isset($_POST['operacion']) && $_POST['operacion']=='editar'){
                if($san->get_pago()=='SI'){ ?>
                  <td><input type="radio" name="Pago" value="SI" checked="checked"/>Si</td>
                  <td><input type="radio" name="Pago" value="NO"/>No</td>      
                <?php }else{
                  ?>
                  <td><input type="radio" name="Pago" value="SI"/>Si</td>
                  <td><input type="radio" name="Pago" value="NO" checked="checked"/>No</td>
               <?php }
              }else{
                ?>
                  <td><input type="radio" name="Pago" value="SI" checked="checked"/>Si</td>
                  <td><input type="radio" name="Pago" value="NO"/>No</td>      
                <?php
              }
             ?>
            
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
                  <th>Monto</th>
                  <th>Descripcion</th>
                  <th>Pago</th>
                </tr>
              </thead>


            <?php foreach($model->Listar() as $r): ?>

              <tr>
                <td><?php echo $r->get_nombre(); ?></td>
                <td><?php echo $r->get_apellido(); ?></td>
                <td><?php echo $r->get_monto(); ?></td>
                <td><?php echo $r->get_descripcion(); ?></td>
                <td><?php echo $r->get_pago(); ?></td>
                <td>
                <form action="sancion.php" method="POST">
                      <input type="hidden" name="operacion" value="editar">
                      <input type="hidden" name="IDsancion" value="<?php echo $r->get_idsancion(); ?>">
                      <input type="submit" value="EDITAR">

                  </form>
                </td>
                <td>
                <form action="sancion.php" method="POST">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="IDsancion" value="<?php echo $r->get_idsancion(); ?>">
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











