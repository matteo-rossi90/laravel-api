<?php

use App\Http\Controllers\Api\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//route che consente di mandare le API dei progetti con tipologie e tecnologie nella view
Route::get('/', [PageController::class, 'index']);

//route per l'elenco dei tipi
Route::get('/type', [PageController::class, 'type']);

//route per l'elenco delle tecnologie
Route::get('/technologies', [PageController::class, 'technologies']);

//route per il singolo progetto con tipi e tecnologie
Route::get('/project-by-slug/{slug}', [PageController::class, 'projectBySlug']);

//route per l'elenco dei progetti per tipo
Route::get('/project-by-type', [PageController::class, 'projectByType']);

//route per l'elenco dei progetti per tecnologia
Route::get('/project-by-technologies', [PageController::class, 'projectByTechnologies']);
