<?php

namespace App\Livewire\Panel\Categorias;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriasIndex extends Component
{

    use WithPagination;
    protected $categorias;
    protected $paginationTheme= "bootstrap";

    public $categoriaModal;

    public function editCategoria(Categoria $categoria)
    {
        $this->categoriaModal = $categoria;
    }

    //mount
    public function mount()
    {
        $this->categoriaModal = Categoria::first();
        $this->categorias = Categoria::orderBy('nombre', 'asc')->paginate(10);
    }

    
    public function render()
    {
        $this->categorias = Categoria::orderBy('nombre', 'asc')->paginate(10);
        return view('livewire.panel.categorias.categorias-index', ['categorias' => $this->categorias]);
    }
}
