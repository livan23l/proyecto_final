<?php

use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\PerfilUsuarioController;
use App\Http\Controllers\UserNoticiaLikeController;
use App\Http\Controllers\VotacionController;
use App\Http\Controllers\VotarController;
use App\Models\UserNoticiaLike;
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
    return view('presentacion');
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

Route::resource('noticia', NoticiaController::class)->parameters(['noticia' => 'noticia']);
Route::resource('votacion', VotacionController::class);

Route::get('/votar', [VotarController::class, 'index'])->name('votar.index');
Route::get('/votar/candidato_{id}', [VotarController::class, 'candidato_show'])->name('votar.candidato_show');
Route::get('/votar/{id}', [VotarController::class, 'show'])->name('votar.show');
Route::post('/votar/{id}', [VotarController::class, 'store'])->name('votar.store');

Route::post('/user-noticia-like/{noticia}', [UserNoticiaLikeController::class, 'toggleLike'])->name("user.noticiaLike");

Route::get('/user/configuration/{id}', [PerfilUsuarioController::class, 'configuration'])->name("profile.configuration");

Route::get('/noticias', [NoticiaController::class, 'ver'])->name("noticias.ver");

Route::get('/periodista', [NoticiaController::class, 'periodista'])->name("noticia.periodista");
Route::post('/periodista/store', [NoticiaController::class, 'periodista_store'])->name("noticia.periodista_store");

Route::delete('/periodista/destroy/{peticion}', [NoticiaController::class, 'periodista_destroy'])->name("noticia.periodista_destroy");