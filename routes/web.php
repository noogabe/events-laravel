<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $nome = 'Gabriele';
    $idade = 29;
    $profissao = 'Programadora';

    $array = [1,2,3,4,5];

    $nomes = ['Gabriele', 'Pedro', 'Bibi', 'Gata'];

    return view('welcome', 
    [
        'nome' => $nome,
        'idade' => $idade,
        'profissao' => $profissao,
        'array' => $array,
        'nomes' => $nomes
    ]);
});

Route::get('/products', function () {
    return view('products');
});


Route::get('/contact', function () {
    return view('contact');
});
