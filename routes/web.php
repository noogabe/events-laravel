<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Index página inicial
Route::get('/', [EventController::class, 'index']);

// Exibe view com formulário para criar evento, retrinsgindo acesso a usuários autenticados
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');

// Armazena evento no db
Route::post('/events/create', [EventController::class, 'store']);

// Exibe home
Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');

// Exibe um evento específico pelo parâmetro id
Route::get('/events/{id}', [EventController::class, 'show']);

// Deleta um evento específico pelo parâmetro id
Route::delete('/events/{id}', [EventController::class, 'delete']);

// Exibe view de contato
Route::get('/contact', [ContactController::class, 'contact']);

// Rotas de autenticação
Auth::routes();

