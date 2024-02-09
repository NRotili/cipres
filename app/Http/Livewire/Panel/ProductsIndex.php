<?php

namespace App\Http\Livewire\Panel;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
{

    use WithPagination;
    protected $paginationTheme= "bootstrap";

    public $nombre, $codigo;

    public function updatingNombre()
    {
        $this->resetPage();
    }
    
    public function render()
    {

        $codigoBuscar= '';
        $subcodigoBuscar = '';
        if($this->codigo != null){
            list($codigoBuscar, $subcodigoBuscar) = explode('-', $this->codigo);
        }

        $products = Product::when($this->nombre, function($query, $nombre){
            $query->where('nombre','LIKE','%' . $nombre . '%');
        })
        ->when($codigoBuscar, function($query, $codigoBuscar){
            $query->where('codigo_producto','LIKE','%' . $codigoBuscar . '%');
        })
        ->when($subcodigoBuscar, function($query, $subcodigoBuscar){
            $query->where('codigo_subproducto ','LIKE','%' . $subcodigoBuscar . '%');
        })
        ->orderBy('nombre', 'asc')
        ->paginate();

        return view('livewire.panel.products-index', compact('products'));
    }

    public function change_status($id)
    {
        $product = Product::find($id);
        $product->estado = !$product->estado;
        $product->save();
    }

    public function destroy($id)
    {
        //Eliminar

        $product = Product::find($id);
        $product->delete();
        //Mensaje
        session()->flash('message', 'El producto se eliminó con éxito');
        $this->resetPage();
    }
}