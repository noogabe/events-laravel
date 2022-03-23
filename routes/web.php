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
Route::get('/', 'EventController@index')->name('index');

// Exibe view com formulário para criar evento, retrinsgindo acesso a usuários autenticados
Route::get('/events/create', 'EventController@create')->name('create')->middleware('auth');

// Armazena evento no db
Route::post('/events/create', 'EventController@store')->name('store');

// Exibe home
Route::get('/dashboard', 'EventController@dashboard')->name('dashboard')->middleware('auth');

// Exibe um evento específico pelo parâmetro id
Route::get('/events/{id}', 'EventController@show')->name('show');

// Deleta um evento específico pelo parâmetro id
Route::delete('/events/{id}', 'EventController@delete')->name('delete');

// Rotas da autenticação padrão
Auth::routes();

