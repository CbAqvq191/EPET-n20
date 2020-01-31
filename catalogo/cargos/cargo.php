<?php
  require_once 'cargo.entidad.php';
  require_once 'cargo.model.php';
  require_once '../areas/area.entidad.php';
  require_once '../areas/area.model.php';
//creo los objetos con sus atributos y sus metodos
  $car = new Cargo ();
  $model = new CargoModel();
  $are = new Area();
  $modelAre = new AreaModel();
  //isset pregunta si llega esta variable a este archivo al cargar
  if(isset($_POST['operacion'])){

   switch($_POST['operacion']){

       case 'actualizar':
          //se graba un valor al atributo del objeto
          $car->set_idcargo($_POST['IDCargo']);
          $car->set_cargo($_POST['Cargo']);
          $car->set_idarea($_POST['IDArea']);

          //se ejecuta el metodo pasandole un objeto por parametro
          $model->Actualizar($car);
          header ('Location: cargo.php');
          break;

          case 'registrar';
              $car->set_idcargo($_POST['IDCargo']);
              $car->set_cargo($_POST['Cargo']);
			  $car->set_idarea($_POST['IDArea']);

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

<?php $titulo= "Cargos" ; include_once "../recursos/includes-cabeza.php";?>

      <form action="cargo.php" method="post" class="pure-form pure-form-stacked">

        <input type="hidden" name="IDCargo" value="<?php echo $car->get_idcargo(); ?>" />
        <input type="hidden" name="operacion" value="<?php echo $car->get_idcargo() > 0 ? 'actualizar' : 'registrar'; ?>" />

        <table>
		<th>Area:</th><!-- EDITAR ESTO -->
            <td>
            <select name="IDArea">
            <option>Seleccione</option>
			
             <?php foreach($modelAre->Listar() as $rr):
                  echo '<option value="'.$rr->get_idarea().'-'.$rr->get_area().'"';
                  if($rr->get_idarea()==$car->get_idarea()){
                    echo ' selected=selected ';
                  }
                  echo '>'.$rr->get_area().'</option>';
             endforeach; ?>
			 
            </td><!-- HASTA ESTE -->
          <tr>
            <th>Cargo:</th>
            <td><input type="text" name="Cargo" value="<?php echo $car->get_cargo(); ?>" required='required'/></td>
          </tr>
		  <tr>
		  
		  
			
		  </tr>
		  
		  <!-- boton guardar -->
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
                </tr>
              </thead>


            <?php foreach($model->Listar() as $r): ?>

              <tr>
                <td><?php echo $r->get_cargo(); ?></td>
                
                <td><?php
                echo $r -> get_area();
                
                  ?></td>
                <td>
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

<?php include_once "../recursos/includes-pie.php";?>





















