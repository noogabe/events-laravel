<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('welcome', ['events' => $events]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){

        //Instancia novo evento e recebe dados
        $event = new Event;

        $event->title = $request->title;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;

        //Salva no db
        $event->save();

        return redirect('/');
    }
}
