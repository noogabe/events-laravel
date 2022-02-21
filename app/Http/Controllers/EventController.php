<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $nome = 'Gabriele';
        $idade = 29;
        $profissao = 'Programadora';

        $array = [1, 2, 3, 4, 5];

        $nomes = ['Gabriele', 'Pedro', 'Bibi', 'Gata'];

        return view(
            'welcome',
            [
                'nome' => $nome,
                'idade' => $idade,
                'profissao' => $profissao,
                'array' => $array,
                'nomes' => $nomes
            ]
        );
    }

    public function create(){
        return view('events.create');
    }
}
