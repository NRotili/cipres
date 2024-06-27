<?php

namespace App\Livewire\Panel\Categorias;

use App\Models\Categoria;
use Illuminate\Support\Facades\Log;

use Livewire\Component;
use Livewire\WithPagination;

class CategoriasIndex extends Component
{

    use WithPagination;
    protected $categorias;
    protected $paginationTheme= "bootstrap";

    public $categoriaModal ;
    public $descripcion;

    public function editCategoria(Categoria $categoria)
    {
        $this->categoriaModal = $categoria;
        $this->descripcion = $categoria->descripcion;
    }

    //mount
    public function mount()
    {
        
        $this->categoriaModal = Categoria::first();
        $this->categorias = Categoria::orderBy('nombre', 'asc')->paginate(10);
    }

    public function updateCategoria()
    {

        $this->categoriaModal->descripcion = $this->descripcion;
        $this->categoriaModal->save();

        $this->render();

        
    }

    
    public function render()
    {
        $this->categorias = Categoria::orderBy('nombre', 'asc')->paginate(10);
        return view('livewire.panel.categorias.categorias-index', ['categorias' => $this->categorias]);
    }
}
