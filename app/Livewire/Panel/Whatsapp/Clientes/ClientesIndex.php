<?php

namespace App\Livewire\Panel\Whatsapp\Clientes;

use App\Models\Cliente;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\ErrorHandler\Debug;

class ClientesIndex extends Component
{


    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $nombre, $apellido, $email, $telefono, $cantPagina = 10;



    public function render()
    {

        $clientes = Cliente::when($this->nombre, function ($query, $nombre) {
            $query->where('nombre', 'LIKE', '%' . $nombre . '%');
        })
            ->when($this->apellido, function ($query, $apellido) {
                $query->where('apellido', 'LIKE', '%' . $apellido . '%');
            })
            ->when($this->email, function ($query, $email) {
                $query->where('email', 'LIKE', '%' . $email . '%');
            })
            ->when($this->telefono, function ($query, $telefono) {
                $query->where('telefono', 'LIKE', '%' . $telefono . '%');
            })
            ->orderBy('nombre', 'asc')
            ->paginate($this->cantPagina);

        return view('livewire.panel.whatsapp.clientes.clientes-index', compact('clientes'));
    }

    //stopBot
    public function stopBot(Cliente $cliente)
    {

        try {
            $response = Http::post(env('BOT_WHATSAPP') . 'v1/blacklist', [
                'number' => $cliente->telefono,
                'intent' => 'add',
            ]);

            Debugbar::info($response);

            if ($response->status() == 200) {
                toastr()->title('Información')
                    ->success("Bot con " . $cliente->nombre . " detenido")
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();
            } else {
                toastr()
                    ->title('Error')
                    ->error('Error al detener el bot')
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();
            }
        } catch (\Exception $e) {
            toastr()
                ->title('Error')
                ->error('Error al detener el bot')
                ->timeOut(2000)
                ->progressBar()
                ->flash();
        }

        $this->render();
    }

    //startBot
    public function startBot(Cliente $cliente)
    {

        try {
            $response = Http::post(env('BOT_WHATSAPP') . 'v1/blacklist', [
                'number' => $cliente->telefono,
                'intent' => 'remove',
            ]);

            Debugbar::info($response);

            if ($response->status() == 200) {
                toastr()->title('Información')
                    ->success("Bot con " . $cliente->nombre . " iniciado")
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();
            } else {
                toastr()
                    ->title('Error')
                    ->error('Error al iniciar el bot')
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();
            }
        } catch (\Exception $e) {
            toastr()
                ->title('Error')
                ->error('Error al iniciar el bot')
                ->timeOut(2000)
                ->progressBar()
                ->flash();
        }

        $this->render();
    }

    //blacklist
    public function blacklist(Cliente $cliente)
    {

        if ($cliente->blacklist == 0) {
            $cliente->blacklist = 1;
            $cliente->save();

            try {
                $response = Http::post(env('BOT_WHATSAPP') . 'v1/blacklist', [
                    'number' => $cliente->telefono,
                    'intent' => 'add',
                ]);

                toastr()->title('Información')
                    ->success("Cliente " . $cliente->nombre . " agregado a la blacklist")
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();
            } catch (\Exception $e) {
                toastr()->title('Error')
                    ->error('Error al agregar a la blacklist')
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();
            }
        } else {



            $cliente->blacklist = 0;
            $cliente->save();

            try {
                $response = Http::post(env('BOT_WHATSAPP') . 'v1/blacklist', [
                    'number' => $cliente->telefono,
                    'intent' => 'remove',
                ]);

                toastr()->title('Información')
                    ->success("Cliente " . $cliente->nombre . " eliminado de la blacklist")
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();
            } catch (\Exception $e) {
                toastr()->title('Error')
                    ->error('Error al quitar de la blacklist')
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();
            }
        }

        $this->render();
    }
}
