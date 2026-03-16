<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatkulController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/matkul', [MatkulController::class, 'index']);
Route::get('/matkul/{id}', [MatkulController::class, 'show']);

Route::post('/matkul', [MatkulController::class, 'store']);
Route::put('/matkul/{id}', [MatkulController::class, 'update']);
Route::patch('/matkul/{id}', [MatkulController::class, 'update']);
Route::delete('/matkul/{id}', [MatkulController::class, 'destroy']);
