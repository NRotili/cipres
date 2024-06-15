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



        if ($this->file) {
    
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
