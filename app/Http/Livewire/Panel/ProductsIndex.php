<?php

namespace App\Http\Livewire\Panel;

use App\Models\Catalogue;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
{

    use WithPagination;
    protected $paginationTheme= "bootstrap";

    public $nombre, $codigo, $productoEliminar, $cantPagina, $catalogos, $catalogo_id;

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
        $this->catalogos = Catalogue::orderBy('nombre', 'asc')->get();

    }
    
    public function render()
    {


        $products = Product::when($this->nombre, function($query, $nombre){
            $query->where('nombre','LIKE','%' . $nombre . '%');
        })
        ->when($this->codigo, function($query, $codigo){
            $query->where('codigo_producto','LIKE','%' . $codigo . '%');
        })
        ->when($this->catalogo_id, function ($query, $catalogo_id) {
            // Filtrar por catálogo
            $query->whereHas('catalogues', function ($query) use ($catalogo_id) {
                $query->where('catalogue_id', $catalogo_id);
            });
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