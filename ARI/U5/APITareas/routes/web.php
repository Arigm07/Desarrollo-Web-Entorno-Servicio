<?php

use App\Http\Controllers\TareaController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;



Route::apiResource('tareas',TareaController::class)
    ->withoutMiddleware([VerifyCsrfToken::class]);
