<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    ray('hola desde el archivo web.php');
    return view('welcome');
});
