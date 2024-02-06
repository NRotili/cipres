<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductosImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
        
            //Validate if product exist in table productos with codigo.
            $producto = Product::where('codigo_producto', $row[7])->where('codigo_subproducto', $row[8])->first();
            if ($producto) {

                //If someone atributte is null, next producto
                if ($row[1] == null || $row[5] == null || $row[6] == null || $row[7] == null ) {
                    continue;
                }

                $producto->update([
                    'nombre' => $row[1],
                    'costo_minorista' => (float)$row[5],
                    'costo_mayorista' => (float)$row[6],
                    'codigo_producto' => $row[7],
                    'codigo_subproducto' => $row[8],
                ]);


            } else {

                if ($row[1] == null || $row[5] == null || $row[6] == null || $row[7] == null ) {
                    continue;
                }
                
                Product::create([
                    'nombre' => $row[1],
                    'costo_minorista' => (float)$row[5],
                    'costo_mayorista' => (float)$row[6],
                    'codigo_producto' => $row[7],
                    'codigo_subproducto' => $row[8],
                    'estado' => '0'
                ]);
            }
        }
    }
}