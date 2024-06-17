<?php

namespace App\Livewire;

use App\Models\Catalogue;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Livewire\Component;

class CataloguesIndex extends Component
{


    public $search;
    public $catalogue;
    public $catalogoWeb;
    public $tipo;


    public function render()
    {

        if ($this->catalogue == 'Catálogo') {
            $catalogueId = 0;
        } else {
            $this->catalogoWeb = Catalogue::where('nombre', $this->catalogue)
                ->first();
            $catalog = Catalogue::where('nombre', $this->catalogue)
                ->first();
            $catalogueId = $catalog->id;
        }

        if ($this->tipo == 'revendedor' || $this->tipo == 'consfinal') {


            $products = Product::whereHas('category.catalogues', function ($query) use ($catalogueId) {
                $query->where('catalogue_id', $catalogueId);
            })
                ->where('nombre', 'LIKE', '%' . $this->search . '%')
                ->where('estado', 1)
                ->orderBy('nombre')
                ->get();
        } else {
            abort(404);
        }

        return view('livewire.catalogues-index', compact('products'));
    }
}
