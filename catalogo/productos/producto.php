<?php
  require_once 'producto.entidad.php';
  require_once 'producto.model.php';
  require_once '../categorias/categoria.entidad.php';
  require_once '../categorias/categoria.model.php';
//creo los objetos con sus atributos y sus metodos
  $prod = new Producto ();
  $modelProd = new ProductoModel();
  $cat = new Categoria ();
  $modelCat = new CategoriaModel();
  
  
  if(isset($_POST['IDCategoria'])){
	  $idcat=$_POST['IDCategoria'];
	  
  }else{
	 if(!isset($_POST['operacion']))
	 {
		 
	   $idcat= 0 ;
	 
	 }
  }
  
  //isset pregunta si llega esta variable a este archivo al cargar
  if(isset($_POST['operacion'])){

    //cambiar los REQUEST a POST.

   switch($_POST['operacion']){

       case 'actualizar':
          //se graba un valor al atributo del objeto
          $prod->set_idproducto($_POST['IDProducto']);
          $prod->set_producto($_POST['Producto']);
		  $prod->set_marca($_POST['Marca']);
		  $prod->set_precio($_POST['Precio']);
		  $prod->set_idcategoria($_POST['IDCategoria']);
		  $idcatC=$_POST['IDCategoria'];
          //se ejecuta el metodo pasandole un objeto por parametro
          $modelProd->Actualizar($prod);
          header ('Location: producto.php');
          break;

          case 'registrar';
              $prod->set_producto($_POST['Producto']);
			  $prod->set_marca($_POST['Marca']);
			  $prod->set_precio($_POST['Precio']);
			
			  $prod->set_idcategoria($idcat);
			  $idcatC= 1;

              $modelProd->Registrar($prod);
              header('Location: producto.php');
            break;

          case 'eliminar':
                // Se ejecuta el metodo
                $modelProd->Eliminar($_POST['IDProducto']);
                header('Location: producto.php');
            break;
            
            case 'editar':
				
                 $prod=$modelProd->Obtener($_POST['IDProducto']);
            break;    

    
        }
		
 }
 //al tomar en cuenta la operacion de IDCategoria
   
 ?>

<?php $titulo= "Productos" ; include_once "../recursos/includes-cabeza.php";?>
	  
      <form action="producto.php" method="post" class="pure-form pure-form-stacked">


        <table>
		<th>Categoria:</th><!-- EDITAR ESTO -->
					<td>
					<select name="IDCategoria" onChange="this.form.submit();">
					<option disabled selected="selected" value="seleccione">Seleccione</option>
			
					<?php  foreach($modelCat->Listar() as $rr):
					if( $rr->get_categoria() != " "){
					echo '<option value="'.$rr->get_idcategoria().'"';
					if($rr->get_idcategoria() == $idcat ) {
                    ?> selected="selected" <?php
                    
					}
                  echo '>'.$rr->get_categoria().'</option>';
					}
             endforeach; ?> 
			 <option  value=" ">-Sin Categoria-</option>
			 </select>
			 </form>
            </td><!-- HASTA ESTE -->
          <form action="producto.php" method="post" class="pure-form pure-form-stacked">
        <input type="hidden" name="IDProducto" value="<?php echo $prod->get_idproducto(); ?>" />
        <input type="hidden" name="operacion" value="<?php echo $prod->get_idproducto() > 0 ? 'actualizar' : 'registrar'; ?>" />
			
		  <tr>
            <th>Producto:</th>
            <td><input type="text" name="Producto" value="<?php echo $prod->get_producto(); ?>" 
			<?php if($idcat  == 0) { ?>
						disabled
				   <?php } ?>
				   required
			/></td>
          </tr>
		  <tr>
            <th>Marca:</th>
            <td><input type="text" name="Marca" value="<?php echo $prod->get_marca(); ?>" 
			<?php if($idcat  == 0) { ?>
						disabled 
				   <?php } ?>
				   required
			/></td>
          </tr>
		  <tr>
            <th>precio: $</th>
            <td><input type="number" name="Precio" step="any" value="<?php echo $prod->get_precio(); ?>" 
			<?php if($idcat  == 0) { ?>
						disabled
				   <?php } ?>
				   required
			/></td>
          </tr>
		  <input type="hidden" name="IDCategoria" value="<?php echo $idcat; ?>">
             <tr>
              <td colspan="2">
              <br/>
                   <button type="submit" class="pure-button pure-button-primary"
				   
				   <?php if($idcat  == 0) { ?>
						disabled title="Primero seleccione una categoria"
				   <?php   }  ?>
				   >Guardar</button>
              </td>

          </tr>
        </table>
      </form>

    <br/>
<br/>


            <table class="pure-table pure-table-horizontal">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Marca</th>
                  <th>Precio</th>
				  <th>Categoria</th>
                </tr>
              </thead>


            <?php foreach($modelProd->Listar() as $r): ?>

              <tr>
				<?php 
				//if($idcat == $r->get_idcategoria()) { 
				if(($idcat == $r->get_idcategoria())or($idcat == $r->get_categoria())) { 
				?>
			  
                <td><?php echo $r->get_producto(); ?></td>
				<td><?php echo $r->get_marca(); ?></td>
				<td><?php echo '$'.$r->get_precio(); ?></td>
				<td><?php echo $r->get_categoria(); ?></td>
				
				<?php if ($idcat != $r->get_categoria()){ ?>
                <td>
                  <!-- <a href="?operacion=editar&IDCargo=<?php //echo $r->get_idcargo(); ?>">Editar</a>-->
				  
                  <form action="producto.php" method="POST">
                      <input type="hidden" name="operacion" value="editar">
                      <input type="hidden" name="IDProducto" value="<?php echo $r->get_idproducto(); ?>">
					  <input type="hidden" name="IDCategoria" value="<?php echo $r->get_idcategoria(); ?>">
                      <input type="submit" value="EDITAR">
				  
                  </form>
                </td>
				<?php } ?>
                <td>
                 

                 <form action="producto.php" method="POST">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="IDProducto" value="<?php echo $r->get_idproducto(); ?>">
                      <input type="submit" value="ELIMINAR">

                  </form>
                </td>
				<?php 
				}
				?>
              </tr>
          <?php endforeach; ?>
        </table>
<br/><br/>
<?php include_once "../recursos/includes-pie.php";?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
