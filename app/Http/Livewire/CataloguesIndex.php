<?php

namespace App\Http\Livewire;

use App\Models\Catalogue;
use App\Models\Product;
use Livewire\Component;

class CataloguesIndex extends Component
{


    public $search;

    public $catalogue;

    
    public function render()
    {
        
        if(!empty($this->catalogue)){
            // $catalog = Catalogue::find(1)
                        // ->get();

            $catalog = Catalogue::where('nombre', $this->catalogue)->get(); 
            foreach ($catalog as $item) {
                $id = $item->id;
            }

            

            $products = Catalogue::find($id)->products()
                        ->where('nombre','LIKE','%'.$this->search.'%')
                        ->orderBy('nombre')
                        ->get();

            // $products = Product::all()->catalogues($cataloguemodel->id);
            return view('livewire.catalogues-index', compact('products'));
            
            // return view('panel.catalogue2', compact('products', 'catalogue'));
        } else {

            $products = Product::where('nombre','LIKE','%'.$this->search.'%')
                        ->orderBy('nombre')->get();
            $catalogue = "Catálogo";
            return view('livewire.catalogues-index', compact('products','catalogue'));

            // return view('panel.catalogue2', compact('products','catalogue'));
        }

    }
}
