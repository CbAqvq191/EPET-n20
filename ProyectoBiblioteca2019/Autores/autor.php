<?php
  require_once 'autor.entidad.php';
  require_once 'autor.model.php';
//creo los objetos con sus atributos y sus metodos
  $aut = new Autor ();
  $model = new AutorModel();
  //isset pregunta si llega esta variable a este archivo al cargar
  if(isset($_POST['operacion'])){

    //cambiar los REQUEST a POST.

   switch($_POST['operacion']){

       case 'actualizar':
          //se graba un valor al atributo del objeto
          $aut->set_idautor($_POST['IDAutor']);
          $aut->set_autor($_POST['Autor']);
          //se ejecuta el metodo pasandole un objeto por parametro
          $model->Actualizar($aut);
          header ('Location: autor.php');
          break;

          case 'registrar';
              $aut->set_autor($_POST['Autor']);

              $model->Registrar($aut);
              header('Location: autor.php');
            break;

          case 'eliminar':
                // Se ejecuta el metodo
                $model->Eliminar($_POST['IDAutor']);
                header('Location: autor.php');
            break;
            
            case 'editar':

                 $aut=$model->Obtener($_POST['IDAutor']);
            break;    

    
        }
 }
 ?>


<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="../recursos/pure-min.css">
<link rel="stylesheet" type="text/css" href="../recursos/estilos2.css">

<title>Autores</title>
</head>
<body>
<br/>
<br/>
<br/>

<table id="contenido">
<th class="lat_izq">
<a href="">Cargo de autores</a>
</th>
<th id="contenido">


	<h1>Administracion de autores</h1>

      <form action="autor.php" method="post" class="pure-form pure-form-stacked form">

        <input type="hidden"  name="IDAutor" value="<?php echo $aut->get_idautor(); ?>" />
        <input type="hidden"  name="operacion" value="<?php echo $aut->get_idautor() > 0 ? 'actualizar' : 'registrar'; ?>" />

        <table class="table">
          <tr>
            <th class="table"><pre>Autor: </pre></th>
            <td><input type="text"  name="Autor" value="<?php echo $aut->get_autor(); ?>" /></td>
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

            <table class="pure-table pure-table-horizontal table">
              <thead>
                <tr>
                  <th><pre class="corr-pre">Autor</pre></th>
                </tr>
              </thead>


            <?php foreach($model->Listar() as $r): ?>

              <tr>
                <td><?php echo $r->get_autor(); ?></td>
                <td>
                  <!-- <a href="?operacion=editar&IDCargo=<?php //echo $r->get_idcargo(); ?>">Editar</a>-->
                  <form action="autor.php" method="POST">
                      <input type="hidden" name="operacion" value="editar">
                      <input type="hidden" name="IDAutor" value="<?php echo $r->get_idautor(); ?>">
                      <input type="submit" value="EDITAR" class="btn_editar"> <!--  boton editar con image, prueba --> 
					  
                  </form>
                </td>
                <td>
                 

                 <form action="autor.php" method="POST">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="IDAutor" value="<?php echo $r->get_idautor(); ?>">
                      <input type="submit" value="ELIMINAR">

                  </form>
                </td>
              </tr>
          <?php endforeach; ?>
        </table>

</th>
<th class="lat_der">
<p>fkdlñsahfadklñdsflñkdsaflñkfdljñkdskljsaljkdfljkdsalsajñkdsdd
</p>
</th>
</table>
</body>
</html>