<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginC extends Controller{
    
    function vistaLogin(){
        return view('usuarios/login');
    }


    function loguear(){
        echo 'Proceso de logueo';
    }


    function vistaRegistro(){
        return view('usuarios/registro');
    }


    function registrar(){
        
    }


    function cerrarSesion(){
        echo 'Cerrar sesión';
    }
}
