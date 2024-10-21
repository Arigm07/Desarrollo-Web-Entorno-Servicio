<?php

require_once 'Modelo.php';
session_start();

//SI NO HAY SESIÓN INICIADA, REDIRIGIMOS A LOGIN
if(!isset($_SESSION['usuario'])){
    header('location:login.php');

}
//CREAMOS OBJETO DE ACESSO A LA BD
$bd = new Modelo();
if($_POST['cerrar']){
    session_destroy();
    header('location:login.php');
}
?> Cerrar