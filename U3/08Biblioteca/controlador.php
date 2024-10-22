<?php
require_once 'Modelo.php';
session_start();
//Si no hay sessión iniciada, redirigimos a login
if(!isset($_SESSION['usuario'])){
    header('location:login.php');
}

if(isset($_POST['cerrar'])){
    session_destroy();
    header('location:login.php');
}
//Creamos objeto de acceso a la BD
$bd = new Modelo();

if(isset($_POST['pCrear'])){
    //Tenemos que crear un préstamo, usamos la función de la base de datos comprobarSiPrestar
    //para ver si se puede hacer el préstamo
    $resultado = $bd->comprobar($_POST['socio'],$_POST['libro']);
    
    if ($resultado == 'ok'){
        //Hacer el préstamo
        $error='Se puede hacer el prestamo';

    }else{
        $error = $resultado;
    }
}
?>