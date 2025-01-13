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
	if(isset($_POST["Guardar"])){
	    
	    if(empty($_POST["nombreC"]) or 
	        empty($_POST["precio"]) or empty($_POST["emailC"])){
	        $mensaje="Error, el nombre, el precio y el email deben estar rellenos";
	    }
	    if(($_POST["tipoM"]=="Diesel" or $_POST["tipoM"]=="Gasolina") and 
	        $_POST["promocion"]=="PGE"){
	        $mensaje="Error, si el motor es diesel o gasolina no puede ser PGE";
	    }
	    
	    if($_POST["tipoC"]=="Organismo Público" and $_POST["precio"] > "15000"){
	        $mensaje="Error, el precio no puede ser > 15000";
	    }
	    if(isset($mensaje)){
	        echo $mensaje;
	    }
	    else{
	        if($_POST["promocion"]=="SP"){
	         $importe=$_POST["precio"];   
	        }
	        elseif($_POST["promocion"]=="PR"){
	            $importe=$_POST["precio"]-2000;   
	        }
	        elseif($_POST["promocion"]=="PGE"){
	            $importe=$_POST["precio"]-2500;
	        }
	        echo "Su presupuesto será enviado a ".$_POST["emailC"].
	             ". El importe de este presupuesto es de ".$importe;
	    }
	    
	}
	?>

</body>
</html>