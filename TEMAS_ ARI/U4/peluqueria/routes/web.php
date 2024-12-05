<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\citaC;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(citaC::class)->group(
    function(){
        Route::get('citas','verCitas')->name('verCitas');               //get para consultar y añadir servicio
        Route::put('citas/{id}','modificarCitas')->name('modificarC');  //put para modificar
        Route::delete('citas/{id}','borrarCita')->name('borrarC');      //delete para borrar
        Route::post('citas','crearCitas')->name('crearC');              //post para crear
        Route::get('detalle/{id}','crearDetalle')->name('crearDetalle');  
    }
);
