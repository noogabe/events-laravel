<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Exceptions\EventNotFoundException;

class EventController extends Controller
{
    public function index()
    {
        $search = request('search');

        if($search){

            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();

        } else {
            $events = Event::all();
        }

        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    //==============================================================================

    public function create(){
        return view('events.create');
    }

    //==============================================================================

    public function store(Request $request){

        //Instancia novo evento e recebe dados
        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        //Image upload
        if($request->hasFile('image') && $request->file('image')->isValid()){
            
            $requestImage = $request->image;

            //Armazenando a extensão da imagem
            $extension = $requestImage->extension();
            
            //Armazenando o nome da imagem
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;

            //Movendo a imagem que veio do request para uma pasta e salvando com o nome definido anteriormente
            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;

        }

        //Recebendo id de usuário logado e passando pra instancia de event
        $user = auth()->user();
        $event->user_id = $user->id;

        //Salva no db
        $event->saveOrFail();

        //Redireciona à pagina inicial e envia uma mensagem através do metodo with()
        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    //==============================================================================

    public function show($id) {

        //Tenta achar o evento através do findOrFail
        //Caso não ache, captura a exceção e lança a exceção personalizada
        try {
            $event = Event::findOrFail($id);
        } catch (\Exception $exception){
            throw new EventNotFoundException();
        }

        //Buscando no banco o usuário que possui este id
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
    }
}
