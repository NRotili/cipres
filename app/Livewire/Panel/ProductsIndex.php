<?php

namespace App\Livewire\Panel;

use App\Models\Catalogue;
use App\Models\Categoria;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
{

    use WithPagination;
    protected $paginationTheme= "bootstrap";

    public $nombre, $codigo, $productoEliminar, $cantPagina, $categorias, $categoria_id;

    public function updatingNombre()
    {
        $this->resetPage();
    }

    public function updatingCodigo()
    {
        $this->resetPage();
    }

  
    public function updatingCatalogo()
    {
        $this->resetPage();
    }


    //mount
    public function mount()
    {
        $this->cantPagina = 10;
        $this->categorias = Categoria::orderBy('nombre', 'asc')->get();

    }
    
    public function render()
    {


        $products = Product::when($this->nombre, function($query, $nombre){
            $query->where('nombre','LIKE','%' . $nombre . '%');
        })
        ->when($this->codigo, function($query, $codigo){
            $query->where('codigo_producto','LIKE','%' . $codigo . '%');
        })
        ->when($this->categoria_id, function($query, $categoria_id){
            $query->where('categoria_id', $categoria_id);
        })
        ->orderBy('nombre', 'asc')
        ->paginate($this->cantPagina);

        return view('livewire.panel.products-index', compact('products'));
    }

    public function change_status($id)
    {
        $product = Product::find($id);
        $product->estado = !$product->estado;
        $product->save();
    }
}