<?php

use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\VotacionController;
use App\Http\Controllers\VotarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('norma/pdf', [CandidatoController::class, 'pdf'])->name('norma.pdf'); ruta para un caso hipotético de un pdf
Route::resource('candidato', CandidatoController::class);

Route::get('/presentacion', function() {
    return view('presentacion');
})->name("presentacion");

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('votacion', VotacionController::class);

Route::get('/votar', [VotarController::class, 'index'])->name('votar.index');
Route::get('/votar/{id}', [VotarController::class, 'show'])->name('votar.show');
Route::post('/votar/{id}', [VotarController::class, 'store'])->name('votar.store');
