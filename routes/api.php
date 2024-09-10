<?php

use App\Http\Controllers\AgenceController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\Documents_demandeController;
use App\Http\Controllers\EmployeurController;
use App\Http\Controllers\IndependantController;
use App\Http\Controllers\RegimeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Situation_matrimonialsController;
use App\Http\Controllers\UploadFileController;
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

Route::get('/categories_independants', [IndependantController::class, 'allCategorie']);
Route::prefix('user')->group(function () {
    Route::post('/create', [UserController::class, 'create']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/profil/{id}', [UserController::class, 'profil']);
    Route::put('/update/{id}', [UserController::class, 'update']);
})->where(['id' => '[0-9]+']);

Route::prefix('matrimonial')->group(function () {
    Route::get('/{id_user}', [Situation_matrimonialsController::class, 'getMatrimonial']);
    Route::post('/create/{id_user}', [Situation_matrimonialsController::class, 'create']);
    route::put('/update/{id_user}', [Situation_matrimonialsController::class, 'update']);
})->where(['id_user' => '[0-9]+']);

Route::get('/service/{id_regime}', [ServiceController::class, 'show']);

Route::prefix('demande')->group(function () {

    //renvoie une demande
   Route::get('/{id_demande}', [DemandeController::class, 'getDemande'])->where(['id_demande' => '[0-9]+']);

   //renvoie toutes demandes d'user si status egal a all sinon renvoie toute demande concernant le status
    Route::get('/user/{id_user}/{status}', [DemandeController::class, 'getDemandeUser'])->where(['id_user' => '[0-9]+']);

    //cree un brouillon pour gerer la demande
    Route::post('/create/{id_user}', [DemandeController::class, 'create'])->where(['id_user' => '[0-9]+']);

    //permet d'uploader les documents pour la demande
    Route::post('/upload_document/{prefix}/{id_demande}', [Documents_demandeController::class, 'upload'])->where(['id_demande' => '[0-9]+']);

    //supprime ou annule une demande qui n'est pas encore valide ou approuve
    route::delete('/annuler/{id_demande}', [DemandeController::class, 'delete'])->where(['id_demande' => '[0-9]+']);

    //renvoie tout les documents relatif a une demande si prefix = all sinon renvoie tout document concernat le prefix
    Route::get('/document/{id_demande}/{prefix}', [Documents_demandeController::class, 'getDocumentDemande'])->where(['id_demande' => '[0-9]+']);

    //finaliser une demande
    Route::post('/final/{id_demande}', [DemandeController::class, 'submitDemande'])->where(['id_demande' => '[0-9]+']);
});

Route::get('/domaines_activites', [EmployeurController::class, 'get_domaines_activites']);

Route::get('/employeurs', [EmployeurController::class, 'allEmployeur']);

Route::post('upload/{typeFile}/{action}/{prefix}/{id_user}', [UploadFileController::class, 'upload']);