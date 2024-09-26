<?php

namespace App\Livewire\Panel\Whatsapp\Chats;

use App\Models\Chat;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class ChatsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $nombre, $apellido, $tipo, $status, $telefono, $cantPagina = 10;

    public function updating($nombre)
    {
        $this->resetPage();
    }

    public function render()
    {

        $chats = Chat::when($this->status, function ($query, $status) {
            $query->where('status', $status);
        })
            ->when($this->tipo, function ($query, $tipo) {
                $query->where('tipo', 'LIKE', '%' . $tipo . '%');
            })
            //Obtener a través de un belongstoMany los chats que pertenecen a un cliente
            ->when($this->nombre, function ($query, $nombre) {
                $query->whereHas('cliente', function ($query) use ($nombre) {
                    $query->where('nombre', 'LIKE', '%' . $nombre . '%');
                });
            })
            ->when($this->telefono, function ($query, $telefono) {
                $query->whereHas('cliente', function ($query) use ($telefono) {
                    $query->where('telefono', 'LIKE', '%' . $telefono . '%');
                });
            })
            ->orderByRaw("FIELD(status, 1, 2, 0, -1, -2)")
            ->orderBy('created_at', 'ASC')
            ->paginate($this->cantPagina);




        return view('livewire.panel.whatsapp.chats.chats-index', compact('chats'));
    }

    //finalizado
    public function finalizado($id)
    {
        $chat = Chat::find($id);
        $chat->status = -1;
        $chat->save();

        try {
            $response = Http::post(env('BOT_WHATSAPP') . 'v1/messages', [
                'number' => $chat->cliente->telefono,
                'message' => "Gracias por comunicarte con CIPRES! \nTu chat ha sido finalizado!\nTe esperamos pronto en Urquiza 721! 👋.",
            ]);
            toastr()->success("Chat con " . $chat->cliente->nombre . " finalizado");
        } catch (\Exception $e) {
            toastr()->error('Error al enviar el mensaje');
        }

        if ($response->status() == 200) {
            try {
                Http::post(env('BOT_WHATSAPP') . 'v1/blacklist', [
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

    //botDetenido
    public function botDetenido($id)
    {
        Debugbar::info(env('BOT_WHATSAPP'));
        $chat = Chat::find($id);

        try {
            $response = Http::post(env('BOT_WHATSAPP') . 'v1/blacklist', [
                'number' => $chat->cliente->telefono,
                'intent' => 'add',
            ]);
            Debugbar::info($response);
        } catch (\Exception $e) {
            toastr()->error('Error al detener el bot');
        }
        
        if ($response->status() == 200) {
            $chat->status = 2;
            $chat->save();
            toastr()->success("Bot con " . $chat->cliente->nombre . " detenido");
        } else {
            toastr()->error('Error al detener el bot');
        }

        $this->render();
    }
}
