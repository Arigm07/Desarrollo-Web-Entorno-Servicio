<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return view('welcome');
    return view('holaMundo');
});

Route::get('/alumnos', function () {
    return 'Bienvenidos Alumnos';
});


Route::get('/alumnos/{nombre}', function ($nombreA) {
    return 'Bienvenid@ '.$nombreA;
});
