<?php

namespace App\Http\Livewire\Panel;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
{

    use WithPagination;
    protected $paginationTheme= "bootstrap";

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $products = Product::where('nombre','LIKE','%' . $this->search . '%')
                ->latest('id')
                ->paginate();

        return view('livewire.panel.products-index', compact('products'));
    }
}
