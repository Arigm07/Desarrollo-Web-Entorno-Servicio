<?php

$numAcceso=1;
$fechaUA='';


//Recuperamos valores de cookies si existen
if(isset($_COOKIE['numAccesos'])){
    $numAcceso=$_COOKIE['numAccesos'];
    $fechaUA=$_COOKIE['fechaUA'];
}


//Cada vez que accedo a la pág, incremento el nº de accesos y la fecha
//creando/modificando dos cookies.
setcookie('numAccesos',$numAcceso);
setcookie('fechaUA', date('d/m/Y h:m:s'));

if(isset($_POST['borrar'])){
    setcookie('numAccesos','',time()-1);
    setcookie('fechaUA',);


        //Recargar la pág para actualizar $_COOKIE
        header('location:02Ejercicio1.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">

        <h3>Nº de accesos: <?php echo $numAcceso;?></h3>
        <h3>Fecha ultimo acceso: <?php echo $fechaUA;?></h3>

        <input type="submit" name="borrar" value="Borrar">
    </form>


</body>

</html>