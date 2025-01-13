<?php

require_once 'modelo.php';
require_once 'datos.php';
require_once 'Entrada.php';
$modelo = new modelo('datos.dat');

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta de entradas</title>
</head>

<body>
    <h1>CULTURA NAVALMORAL</h1>
    <form action="#" method="post">
        <fieldset>
            <legend>Venta de Entradas</legend>

               <!-- Campo rellenar nombre -->
               <div>
                <label for="nombre">Nombre completo</label><br />
                <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" />
            </div>


            <!-- Selección tipo -->
            <div>
                <label>Tipo Entrada</label><br/>

                    <label for="general">General</label>
                        <input type="radio" name="tipo" id="general" value="general" checked="checked"></input>

                    <label for="mayor">Mayor de 60</label>
                        <input type="radio" name="tipo" id="mayor" value="mayor"></input>

                    <label for="menor">Menor de 6 años</label>
                        <input type="radio" name="tipo" id="menor" value="menor"></input>
            </div>
        
            
            <!-- Campo fecha -->
            <div>
                <label for="fecha">Fecha del evento</label><br />
                <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d') ?>" />
            </div>


            <!-- Campo rellenar nº -->
           <div>
                <label for="num">Número de Entradas</label><br />
                <input type="number" id="num" name="num" value="3" />
            </div>


            <!-- Campo seleccionar descuentos con arrays -->
            <div>
                <label for="descuento">Descuentos</label><br />
                <select name="descuento" id="descuento">
                    <option <?php 
                    echo (isset($_POST['descuento']) && $_POST['descuento']=='SIn descuento'?:'')
                    ?>>Sin descuento</option>
                    <option <?php 
                    echo (isset($_POST['descuento']) && $_POST['descuento']=='Familia Numerosa'?:'')
                    ?>>Familia Numerosa</option>
                    <option <?php 
                    echo (isset($_POST['descuento']) && $_POST['descuento']=='Abonado'?'selected="selected"':'')
                    ?>>Abonado</option>
                    <option <?php 
                    echo (isset($_POST['descuento']) && $_POST['descuento']=='Dia del Espectador'?'selected="selected"':'')
                    ?>>Dia del Espectador</option>
                </select>
            </div>
           

            <div>
                <input type="submit" name="Comprar" value="comprar"></input>
        </div>
        </fieldset>
    </form>

    <?php 
	if(isset($_POST["Comprar"])){

	    
	    if(empty($_POST["nombre"]) or 
	        empty($_POST["tipo"]) or empty($_POST["fecha"]) or empty($_POST["num"])){
	        $mensaje="Error, el nombre, el tipo de entrada, la fecha y el número de entradas deben estar rellenos";
	    }
	    
	    if($_POST["num"] > "4" || $_POST["num"] < "1"){
	        $mensaje="Error, el número de entradas debe ser entre 1 y 4";
	    }

        if(($_POST["tipo"]=="mayor" ) and 
        $_POST["descuento"]=="Familia Numerosa"){
        $mensaje="Error, si la entrada es para mayores de 60, no puede ser descuento de Familia NUmerosa";
    }
	    if(isset($mensaje)){
	        echo $mensaje;
	    }
	    
	}

    //Crear la tabla
 echo '<table border="1"';
 echo '<tr>';
 echo '<th>Nombre</th>';
 echo '<th>Tipo de entrada</th>';
 echo '<th>Nº de entradas</th>';
 echo '<th>Descuebtos</th>';
 echo '<th> Total a pagar</th>';
 echo '</tr>';

  //Mostrar 
  $datos = $modelo->obtenerDatos();
  foreach($datos as $d){
      echo '<tr>';
      echo '<td>'.$d->getNombre().'</td>';
      echo '<td>'.$d->getFecha().'</td>';
      echo '<td>'.$d->getTipo().'</td>';
      echo '<td>'.$d->getNum().'</td>';
      echo '<td>'.$d->getDescuento().'</td>';
      echo '</tr>';
  }
	?>
    
</body>
</html>