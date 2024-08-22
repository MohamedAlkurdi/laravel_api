<?php

use App\Http\Controllers\api\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/data', [TestController::class, 'data']);
Route::post('/data', [TestController::class, 'store']);
