<?php


use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\AktorController;
use App\Http\Controllers\Api\FilmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController ::class,'authenticate']);
Route::post('register', [LoginController::class, 'register']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout']);

// route login


// route kategori
Route::get('kategori', [KategoriController::class, 'index']);
Route::post('kategori', [KategoriController::class, 'store']);
Route::get('kategori/{id}', [KategoriController::class, 'show']);
Route::put('kategori/{id}', [KategoriController::class, 'update']);
Route::delete('kategori/{id}', [KategoriController::class, 'destroy']);

// route gender
Route::get('genre', [GenreController::class, 'index']);
Route::post('genre', [GenreController::class, 'store']);
Route::get('genre/{id}', [GenreController::class, 'show']);
Route::put('genre/{id}', [GenreController::class, 'update']);
Route::delete('genre/{id}', [GenreController::class, 'destroy']);

// route aktor
Route::get('aktor', [AktorController::class, 'index']);
Route::post('aktor', [AktorController::class, 'store']);
Route::get('aktor/{id}', [AktorController::class, 'show']);
Route::put('aktor/{id}', [AktorController::class, 'update']);
Route::delete('aktor/{id}', [AktorController::class, 'destroy']);

//
Route::get('film', [FilmController::class, 'index']);
Route::post('film', [FilmController::class, 'store']);
Route::get('film/{id}', [FilmController::class, 'show']);
Route::put('film/{id}', [FilmController::class, 'update']);
Route::delete('film/{id}', [FilmController::class, 'destroy']);

});
