<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatkulController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/matkul', [MatkulController::class, 'index']);
Route::get('/matkul/{id}', [MatkulController::class, 'show']);
