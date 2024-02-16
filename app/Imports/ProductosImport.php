<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductosImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
        
            //Validate if product exist in table productos with codigo.
            $producto = Product::where('codigo_producto', $row['codigoproducto'])->first();
            if ($producto) {

                //If someone atributte is null, next producto
                if ($row['nombreproducto'] == null || $row['precioventa2'] == null || $row['precioventa3'] == null || $row['codigoproducto'] == null ) {
                    continue;
                }

                $producto->update([
                    'nombre' => $row['nombreproducto'],
                    'precioventa3' => (float)$row['precioventa3'],
                    'precioventa2' => (float)$row['precioventa2'],
                ]);


            } else {

                if ($row['nombreproducto'] == null || $row['precioventa2'] == null || $row['precioventa3'] == null || $row['codigoproducto'] == null ) {
                    continue;
                }
                
                Product::create([
                    'nombre' => $row['nombreproducto'],
                    'precioventa3' => (float)$row['precioventa3'],
                    'precioventa2' => (float)$row['precioventa2'],
                    'codigo_producto' => $row['codigoproducto'],
                    'estado' => '0'
                ]);
            }
        }
    }
}