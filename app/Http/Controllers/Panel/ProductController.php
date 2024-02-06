<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{

    public function index()
    {
        return view('panel.productos.index');
    }

    public function create()
    {
        $catalogues = Catalogue::all();
        return view('panel.productos.create', compact('catalogues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'costo_minorista' => 'required'
        ]);


        $product = Product::create($request->all());

        if ($request->file('file')) {
            $url = Storage::put('products', $request->file('file'));

            $product->image()->create([
                'url' => $url
            ]);
        }

        if ($request->catalogues) {
            $product->catalogues()->attach($request->catalogues);
        }


        return redirect()->route('panel.products.index', $product)->with('info', 'El producto se creó con éxito');
    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $catalogues = Catalogue::all();

        return view('panel.productos.edit', compact('catalogues', 'product')); 
    }

    public function update(Request $request, Product $product)
    {

        $product->update($request->all());
        if ($request->file('file')) {
            $url = Storage::put('products', $request->file('file'));
            if ($product->image) {
                Storage::delete($product->image->url);

                $product->image->update([
                    'url'=>$url
                ]);
            } else {
                $product->image()->create([
                    'url'=> $url
                ]);
            }
        }
        $product->catalogues()->sync($request->catalogues);

        return redirect()->route('panel.products.index', $product)->with('info', 'El producto se actualizó con éxito');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('panel.products.index')->with('info','El producto se eliminó con éxito');
    }
}
