<?php

require_once 'modelo.php';
require_once 'datos.php';
$modelo = new modelo('datos.dat');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>

<body>

<form action="#" method="post">
    <label for="titulo">Titulo de la pelicula</label>
        <input type="text" name="titulo" id="titulo" 
        value="<?php echo (!empty($_POST['titulo']) ? ($_POST['titulo']) : ''); ?>"><br>

    <label for="fechaRegist">Fecha de registro</label>
        <input type="date" name="fechaRegist" id="fechaRegist" 
        value="<?php echo date('Y-m-d', strtotime('2023-06-07')) ?>"><br>

<div>
    <label for="gen">Genero</label><br>
        <select name="gen" id="gen" multiple="multiple">
    
            <option> Comedia </option>
            <option> Drama </option>
            <option> Terror </option>
            <option> Aventura </option>
        </select><br>
</div>


<div>
    <label>Tipo</label><br/>

    <label for="pelicula">Pelicula</label>
        <input type="radio" name="tipo" id="pelicula" value="pelicula" checked="checked"></input>

    <label for="serie">Serie</label>
        <input type="radio" name="tipo" id="serie" value="serie"></input>
</div>


    <label for="caps">Nº de Capitulos</label><br>
        <input type="text" name="caps" id="caps" 
        value="<?php echo (!empty($_POST['caps']) ? ($_POST['caps']) : ''); ?>"><br>


        <input type="submit" value="Guardar" name="guardar"></input>
        


</form>
    
<?php

if(isset($_POST['guardar'])){

        if(empty($_POST['titulo']) || empty($_POST['fechaRegist'] ) ||
         empty($_POST['gen']) || empty($_POST['caps'] )){
            echo "Rellena/marca TODOS los campos";
         }else{
            $datos["titulo"] = $_POST['titulo'];
            $datos["fechaRegist"] = $_POST['fechaRegist'];
            $datos["caps"] = $_POST['caps'];


    echo "Titulo: " .$_POST['titulo'];
    //Chequear si se ha marcado alguno
        if(isset($_POST['titulo']))
        foreach($_POST['titulo'] as $ti){
            echo $ti.'';
        }

    echo "<br/> Fecha de registro: " .$_POST['fechaRegist'];
        if(isset($_POST['fechaRegist']))
        foreach($_POST['fechaRegist'] as $fr){
            echo $fr.'';
        }

    echo "<br/> Genero: " .$_POST['gen'];
    if(isset($_POST['gen']))
    foreach($_POST['gen'] as $g){
        echo $g.'';
    }


    echo "<br/> Tipo: " .$_POST['tipo'];
        if(isset($_POST['tipo']))
        foreach($_POST['tipo'] as $s){
            echo $s.'';

    echo "<br/> Nº capitulos: " .$_POST['caps'];
    if(isset($_POST['caps']))
    foreach($_POST['caps'] as $c){
        echo $c.'';
    }
}else{

    //Chequear si ya hay un cdato
    $texto = $modelo->obtenerDatos($_POST['titulo']);

    if($text==null){

    $d = new Datos($id,$_POST['titulo'],$_POST['fechaRegist'],
    $_POST['gen'], $_POST['tipo'], $_POST['caps'],$titulo);


    //Guardar en el fichero
    $modelo-> guardarDatos($d);



    }else{
        echo '<h3 style="color:red;"> Error:Ya existe un dato con ese nombre'
        .$persona->getTitulo().'</h3>';
    }
}
     }

 //Crear la tabla
 echo '<table border="1"';
 echo '<tr>';
 echo '<th>Titulo pelicula</th>';
 echo '<th>Fecha de registro</th>';
 echo '<th>Genero</th>';
 echo '<th>Tipo</th>';
 echo '<th> Numero de capitulos</th>';
 echo '</tr>';

  //Mostrar 
  $datos = $modelo->obtenerDatos();
  foreach($datos as $d){
      echo '<tr>';
      echo '<td>'.$d->getTitulo().'</td>';
      echo '<td>'.$d->getFechaRegist().'</td>';
      echo '<td>'.$d->getGen().'</td>';
      echo '<td>'.$d->getTipo().'</td>';
      echo '<td>'.$d->getCaps().'</td>';
      echo '</tr>';
  }

        }
?>


</body>
</html>