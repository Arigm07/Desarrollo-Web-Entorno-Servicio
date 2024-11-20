<?php

use App\Http\Controllers\LoginC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginC::class)->group(
    function(){
        Route::get('login','vistaLogin')->name('visitaLogin');
        Route::post('login','loguear')->name('loguear');
        Route::get('registrar','vistaRegistro')->name('visitaRegistro');
        Route::post('registrar','registrar')->name('registrar');
        Route::get('cerrar','cerrarSesion')->name('cerrar');
    }
);
