<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Redirect;

/**
 * Este archivo de rutas no se emplea para poder así poder cargar las rutas de los
 * módulos, antes de la carga de las rutas del core.
 *
 * Las rutas del core se agregan en el archivo general.php
 */

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return Redirect::to('/Dashboard');
});