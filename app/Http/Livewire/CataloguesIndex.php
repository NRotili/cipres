<?php

namespace App\Http\Livewire;

use App\Models\Catalogue;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Livewire\Component;

class CataloguesIndex extends Component
{


    public $search;
    public $catalogue;
    public $tipo;

    
    public function render()
    {
        


            $catalog = Catalogue::where('nombre', $this->catalogue)
                                ->first(); 

            
            if($this->tipo == 'revendedor') {
                $products = Catalogue::find($catalog->id)->products()
                ->where('nombre','LIKE','%'.$this->search.'%')
                ->where('estado', 1)
                ->orderBy('nombre')
                ->get();

            } elseif($this->tipo == 'consfinal'){
                $products = Catalogue::find($catalog->id)->products()
                ->where('nombre','LIKE','%'.$this->search.'%')
                ->where('estado', 1)
                ->orderBy('nombre')
                ->get();
            } else {
                abort(404);
            }
            // $products = Product::all()->catalogues($cataloguemodel->id);
            return view('livewire.catalogues-index', compact('products'));
            
            // return view('panel.catalogue2', compact('products', 'catalogue'));

    }
}
