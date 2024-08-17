<?php

use App\Http\Controllers\AgenceController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\RegimeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/agences', [AgenceController::class, 'allAgences']);
Route::get('/agence/{id}', [AgenceController::class, 'agence'])->where(['id' => '[0-9]+']);

Route::get('/communes', [CommuneController::class, 'allCommunes']);
Route::get('/commune/{id}', [CommuneController::class, 'commune'])->where(['id' => '[0-9]+']);

Route::get('/regimes', [RegimeController::class, 'allRegimes']);
Route::get('/regime/{id}', [RegimeController::class, 'regime'])->where(['id' => '[0-9]+']);

Route::prefix('user')->group(function () {
    route::post('/create', [UserController::class, 'create']);
    route::post('/login', [UserController::class, 'login']);
    route::get('/profil/{id}', [UserController::class, 'profil']);
});
