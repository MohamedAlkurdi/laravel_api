<?php

use App\Http\Controllers\api\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/data', [TestController::class, 'data']);