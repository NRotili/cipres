<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Product;
use PDF;


class HomeController extends Controller
{
    public function index()
    {
        $cantProduct=Product::all()->count();
        $cantCata= Catalogue::all()->count();
        return view('panel.index', compact('cantProduct','cantCata'));
    }


    public function catalogue($tipo, $catalogue)
    {

        // $data = [
        //     'titulo' => 'Styde.net'
        // ];

        // if(!empty($catalogue)){
        //     // $catalog = Catalogue::find(1)
        //                 // ->get();

        //     $catalog = Catalogue::where('nombre', $catalogue)->get(); 
        //     foreach ($catalog as $item) {
        //         $id = $item->id;
        //     }


        //     $products = Catalogue::find($id)->products()->orderBy('nombre')->get();

        //     // $products = Product::all()->catalogues($cataloguemodel->id);
            
        //     return view('panel.catalogue2', compact('products', 'catalogue'));
        // } else {
        //     $products = Product::orderBy('nombre')->get();
        //     $catalogue = "Catálogo";
        //     return view('panel.catalogue2', compact('products','catalogue'));
        // }  

        Catalogue::where('nombre', $catalogue)->firstOrFail();

        if (($tipo != 'revendedor' && $tipo != 'consfinal') || $catalogue == null) {
            //return 404
            abort(404);
        }

        return view('panel.catalogue2', compact('tipo', 'catalogue'));

    }
}
