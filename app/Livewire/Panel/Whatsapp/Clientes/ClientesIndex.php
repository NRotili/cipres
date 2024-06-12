<?php

namespace App\Livewire\Panel\Whatsapp\Clientes;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class ClientesIndex extends Component
{


    use WithPagination;
    protected $paginationTheme= "bootstrap";
    public $nombre, $apellido, $email, $telefono, $cantPagina = 10;



    public function render()
    {

        $clientes = Cliente::when($this->nombre, function($query, $nombre){
            $query->where('nombre','LIKE','%' . $nombre . '%');
        })
        ->when($this->apellido, function($query, $apellido){
            $query->where('apellido','LIKE','%' . $apellido . '%');
        })
        ->when($this->email, function($query, $email){
            $query->where('email','LIKE','%' . $email . '%');
        })
        ->when($this->telefono, function($query, $telefono){
            $query->where('telefono','LIKE','%' . $telefono . '%');
        })
        ->orderBy('nombre', 'asc')
        ->paginate($this->cantPagina);

        return view('livewire.panel.whatsapp.clientes.clientes-index', compact('clientes'));
    }
}
