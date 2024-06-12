<?php

namespace App\Livewire\Panel\Productos;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductosImport;

class ProductsImport extends Component
{

    use WithFileUploads;

    public $file;


    public function updated($property)
    {
        if ($property == 'file') {
            $this->validate([
                'file' => 'required|mimes:xlsx,xls,csv'
            ]);
        }
    }
    

    public function render()
    {
        return view('livewire.panel.productos.products-import');
    }

    public function importarproductos()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
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


        if ($this->file) {
            // $path = $request->file->getRealPath();
            // $path1 = $request->file('mcafile')->store('temp');
            // $path = storage_path('app') . '/' . $path1;
            $data = Excel::import(new ProductosImport, $this->file);
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
