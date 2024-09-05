<?php

namespace App\Livewire\Panel\Whatsapp\Chats;

use App\Models\Chat;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class ChatsIndex extends Component
{
    use WithPagination;
    protected $paginationTheme= "bootstrap";

    public $nombre, $apellido, $tipo, $status = 1, $telefono, $cantPagina = 10;
    
    public function render()
    {

        $chats = Chat::when($this->status, function($query, $status){
            $query->where('status', $status);
        })
        ->when($this->tipo, function($query, $tipo){
            $query->where('tipo','LIKE','%' . $tipo . '%');
        })
        //Obtener a través de un belongstoMany los chats que pertenecen a un cliente
        ->when($this->nombre, function($query, $nombre){
            $query->whereHas('cliente', function($query) use ($nombre){
                $query->where('nombre','LIKE','%' . $nombre . '%');
            });
        })
        ->orderBy('created_at', 'ASC')
        ->paginate($this->cantPagina);




        return view('livewire.panel.whatsapp.chats.chats-index', compact('chats'));
    }

    //finalizado
    public function finalizado($id){
        $chat = Chat::find($id);
        $chat->status = -1;
        $chat->save();

        try{
            $response = Http::post('http://localhost:3008/v1/messages', [
                'number' => $chat->cliente->telefono,
                'message' => 'Gracias por contactarnos, su consulta ha sido finalizada.',
            ]);
            toastr()->success("Chat con " . $chat->cliente->nombre . " finalizado");
        } catch (\Exception $e){
            toastr()->error('Error al enviar el mensaje');
        }

        if($response->status() == 200){
            try {
                Http::post('http://localhost:3008/v1/blacklist', [
                    'number' => $chat->cliente->telefono,
                    'intent' => 'remove',
                ]);
            } catch (\Exception $e) {
                toastr()->error('Error al enviar el mensaje');
            }
        } else {
            toastr()->error('Error al enviar el mensaje');
        }
      

        $this->render();
    }
}
