<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="#" method="post">

<div>
    <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre"></input>
</div>



<div>
    <label for="curso">Curso</label>
        <select name="curso" id="curso">

            <option value="Primero Daw"> 1º DAW </option>
            <option selected="selected"> 2º DAW </option>
            <option> 1º DAM </option>
            <option> 2º DAM </option>
        </select>
</div>



<div>
    <label for="asig">Asignatura</label>
        <select name="asig[]" id="asig" multiple="multiple">
    
            <option> DWES </option>
            <option> DIC </option>
            <option> PROG </option>
            <option> BD </option>
        </select>
</div>



<div>
    <label>Sexo</label><br/>

    <label for="hombre">Hombre</label>
        <input type="radio" name="sexo" id="hombre" value="hombre" checked="checked"></input>

    <label for="mujer">Mujer</label>
        <input type="radio" name="sexo" id="mujer" value="mujer"></input>
</div>



<div>
    <label>Otros</label><br/>

    <label for="becaM">Beca MEC</label>
        <input type="checkbox" name="otros[]" id="becaM" value="Beca MEC"></input>

    <label for="transporte">Transporte</label>
        <input type="checkbox" name="otros[]" id="transporte" value="Transporte"></input>

    <label for="delegado">Delegado</label>
        <input type="checkbox" name="otros[]" id="delegado" value="Delegado"></input>
</div>

<input type="submit" value="Enviar" name="enviar"></input>
<input type="reset" value="Cancelar"></input>

</form>




<?php

if(isset($_POST['enviar'])){
    echo "Nombre: " .$_POST['nombre'];

    echo "<br/> Curso: " .$_POST['curso'];

    echo "<br/> Asignatura: " .$_POST['asignatura'];
        //Hay que chequear si se ha marcado alguna asignatura
    if(isset($_POST['asig']))
    foreach($_POST['asig'] as $a){
        echo $a.'';
    }

    echo "<br/> Sexo: " .$_POST['sexo'];

    echo "<br/> Otros: " .$_POST['otros'];
         //Chequear si se ha marcado alguno
    if(isset($_POST['otros']))
    foreach($_POST['otros'] as $o){
        echo $o.'';
    }
}
?>


</body>
</html>