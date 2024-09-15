<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TesteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TesteController::class, 'index']);

