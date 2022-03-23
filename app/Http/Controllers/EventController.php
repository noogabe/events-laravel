<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Event;
use App\User;
use App\Exceptions\EventNotFoundException;  

class EventController extends Controller
{
    /* Exibe todos os eventos 
    ** Busca  pelo título
    */
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



    /* Exibe view de criação de novo evento */
    public function create(){
        return view('events.create');
    }



    /* Armazena dados da requisição no banco de dados */
    public function store(Request $request){

        // Instancia novo evento e recebe dados da requisição
        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        // Image upload
        if($request->hasFile('image') && $request->file('image')->isValid()){
            
            $requestImage = $request->image;

            // Armazenando a extensão da imagem
            $extension = $requestImage->extension();
            
            // Armazenando o nome da imagem
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;

            // Movendo a imagem que veio do request para uma pasta e salvando com o nome definido anteriormente
            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;

        }

        //Recebendo id de usuário logado e passando pra instancia de event
        $user = auth()->user();
        $event->user_id = $user->id;

        //Salva evento no db
        $event->saveOrFail();

        //Redireciona à pagina inicial e envia uma mensagem através do metodo with()
        return redirect('/dashboard')->with('msg', 'Evento criado com sucesso!');
    }



    /* Exibe um evento específico através do parâmetro id */
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



    /* Dashboard que exibe todos os eventos
    ** Do usuário logado
    */
    public function dashboard(){

        $user = auth()->user();

        $events = $user->events;

        return view('events.dashboard', ['events' => $events]);
    }


    /* Exibe view para atualizar evento */
    public function edit($id){

        $event = Event::findOrFail($id);

        return view('events.edit', ['event' => $event]);
    }

    /* Atualiza um evento */
    public function update(Request $request, $id){

        $data = $request->all();

        // Image upload
        if($request->hasFile('image') && $request->file('image')->isValid()){
            
            $requestImage = $request->image;

            // Armazenando a extensão da imagem
            $extension = $requestImage->extension();
            
            // Armazenando o nome da imagem
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;

            // Movendo a imagem que veio do request para uma pasta e salvando com o nome definido anteriormente
            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;

        }

        $event = Event::findOrFail($id);   
        
        File::delete(public_path('img\\events\\') . $event->image);

        $event->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }



    /* Deleta um evento */
    public function delete($id){

        $events = auth()->user()->events;
        foreach ($events as $event) {
            if ($event->id == $id) {
                Event::findOrFail($id)->delete();
                File::delete(public_path('img\\events\\') . $event->image);
                return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
            }
        }

        return redirect('/dashboard')->with('msg', 'Sem permissão para exclusão desse evento!');
    }
}
