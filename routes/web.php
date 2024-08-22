<?php

use App\Http\Controllers\api\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/data', [TestController::class, 'data']);
Route::post('/data', [TestController::class, 'store']);
Route::get('/data/{id}', [TestController::class, 'show']);
Route::get('/data/{id}/edit', [TestController::class, 'edit']);
Route::put('/data/{id}/edit', [TestController::class, 'update']);


