<?php
  require_once '../productos/producto.entidad.php';
  require_once '../productos/producto.model.php';
  require_once '../categorias/categoria.entidad.php';
  require_once '../categorias/categoria.model.php';
//creo los objetos con sus atributos y sus metodos
  $prod = new Producto ();
  $modelProd = new ProductoModel();
  $cat = new Categoria ();
  $modelCat = new CategoriaModel();
  
  $idcat = 0;
  if(isset($_POST['IDCategoria'])){
	  $idcat=$_POST['IDCategoria'];
	  
  }/*else{
	 if(!isset($_POST['operacion']))
	 {
		 
	   $idcat= 0 ;
	 
	 }
  }*/
  
 //al tomar en cuenta la operacion de IDCategoria
   
 ?>

<?php $titulo= "Productos"; $validar = 2; include_once "../recursos/includes-cabeza.php";?>
	  
      <form action="#" method="post" class="pure-form pure-form-stacked">


        <table>
		<th>Categoria:</th><!-- EDITAR ESTO -->
					<td>
					<select name="IDCategoria" onChange="this.form.submit();">
					<option selected><?php echo '< Todos >'; ?></option>
			
					<?php  foreach($modelCat->Listar() as $rr):
					echo '<option value="'.$rr->get_idcategoria().'"';
					if($rr->get_idcategoria() == $idcat ){
                    ?> selected="selected" <?php
                  }
				 
                  echo '>'.$rr->get_categoria().'</option>';
				  
             endforeach; ?> 
			 </select>
			 </form>
            </td><!-- HASTA ESTE -->


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
				  
                </tr>
              </thead>


            <?php foreach($modelProd->Listar() as $r): ?>

              <tr>
				<?php if(($idcat == $r->get_idcategoria()) or ($idcat == 0)) { ?>
			  
                <td><?php echo $r->get_producto(); ?></td>
				<td><?php echo $r->get_marca(); ?></td>
				<td><?php echo '$'.$r->get_precio(); ?></td>
				
				
				<?php 
				}
				?>
              </tr>
          <?php endforeach; ?>
        </table>

<?php include_once "../recursos/includes-pie.php";?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
