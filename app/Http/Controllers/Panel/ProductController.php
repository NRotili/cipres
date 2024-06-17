<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Imports\ProductosImport;
use App\Models\Catalogue;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;
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
            'precioventa2' => 'required|numeric',
            'precioventa3' => 'required|numeric',
            'codigo_producto' => 'required',
        ]);


        $product = Product::create($request->all());

        if ($request->file('file')) {
            $url = Storage::put('products', $request->file('file'));

            $product->image()->create([
                'url' => $url
            ]);
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
        $request->validate([
            'nombre' => 'required',
            'precioventa2' => 'required|numeric',
            'precioventa3' => 'required|numeric',
            'codigo_producto' => 'required',
        ]);

        $product->update($request->all());
        if ($request->file('file')) {
            $url = Storage::put('products', $request->file('file'));
            if ($product->image) {
                Storage::delete($product->image->url);

                $product->image->update([
                    'url' => $url
                ]);
            } else {
                $product->image()->create([
                    'url' => $url
                ]);
            }
        }

        return redirect()->route('panel.products.index', $product)->with('info', 'El producto se actualizó con éxito');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('panel.products.index')->with('info', 'El producto se eliminó con éxito');
    }

    public function importar()
    {
        return view('panel.productos.import');
    }

    public function importarproductos(Request $request)
    {
        $request->validate([
            'file' => 'required', 'mimes:xls,xlsx',
        ]);

        //Execute command php artisan backup:run --only-db
        // try {
        //     // Artisan::call('backup:run', ['--only-db' => true]);

        //     //mostrar toast 
        //     toastr()->title('Información')
        //         ->success('Backup creado correctamente.')
        //         ->timeOut(2000)
        //         ->progressBar()
        //         ->flash();
        // } catch (\Throwable $th) {
        //     toastr()->title('Error')
        //         ->error('Error al crear backup.')
        //         ->timeOut(2000)
        //         ->progressBar()
        //         ->flash();
        //     return redirect()->route('panel.products.index');
        // }


        if ($request->hasFile('file')) {
            // $path = $request->file->getRealPath();
            // $path1 = $request->file('mcafile')->store('temp');
            // $path = storage_path('app') . '/' . $path1;
            $data = Excel::import(new ProductosImport, $request->file);
            if ($data) {
                toastr()->title('Información')
                    ->success('Productos importados correctamente.')
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();
                return redirect()->route('panel.products.index');
            } else {

                toastr()->title('Error')
                    ->error('Error al importar productos.')
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();

                return redirect()->route('administracion.products.index');
            }
        }
    }
}
