<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\DocumentApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
    RESTful Api - HTTP metode za tablicu "Users"

    GET /api/users           - dohvaća sve korisnike
    GET /api/users/{id}      - dohvaća pojedinog korisnika po njegovom ID-u
    POST /api/users          - kreira novog korisnika
    PUT /api/users/{id}      - ažurira postojeđeg korisnika putem njegova ID-a
    DELETE /api/users/{id}   - briše korisnika putem njegova ID-a

    Sve podatke dostavlja u json formatu
*/
Route::get('/users', [UsersApiController::class, 'index']);
Route::get('/users/{user}', [UsersApiController::class, 'getSingleUser']);
Route::post('/users', [UsersApiController::class, 'store']);
Route::put('/users/{user}', [UsersApiController::class, 'update']);
Route::delete('/users/{user}', [UsersApiController::class, 'destroy']);

/*
    RESTful Api - HTTP metode za tablicu "Categories"

    GET /api/categories           - dohvaća sve kategorije
    GET /api/categories/{id}      - dohvaća pojedinu kategoriju po njenom ID-u
    POST /api/categories          - kreira novu kategoriju
    PUT /api/categories/{id}      - ažurira postojeću kategoriju putem njenog ID-a
    DELETE /api/categories/{id}   - briše kategoriju putem njenog ID-a

    Sve podatke dostavlja u json formatu
*/
Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/categories/{category}', [CategoryApiController::class, 'getSingleCategory']);
Route::post('/categories', [CategoryApiController::class, 'store']);
Route::put('/categories/{category}', [CategoryApiController::class, 'update']);
Route::delete('/categories/{category}', [CategoryApiController::class, 'destroy']);


/*
    RESTful Api - HTTP metode za tablicu "Documents"

    GET /api/documents           - dohvaća sve dokumente
    GET /api/documents/{id}      - dohvaća pojedini dokument po njegovog ID-a
    POST /api/documents          - kreira novi dokument
    PUT /api/documents/{id}      - ažurira postojeći dokument putem njegovog ID-a
    DELETE /api/documents/{id}   - briše dokument putem njegovog ID-a

    Sve podatke dostavlja u json formatu
*/
Route::get('/documents', [DocumentApiController::class, 'index']);
Route::get('/documents/{document}', [DocumentApiController::class, 'getSingleDocument']);
Route::post('/documents', [DocumentApiController::class, 'store']);
Route::put('/documents/{document}', [DocumentApiController::class, 'update']);
Route::delete('/documents/{document}', [DocumentApiController::class, 'destroy']);

