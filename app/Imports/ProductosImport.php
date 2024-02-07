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
            $producto = Product::where('codigo_producto', $row['codigoproducto'])->where('codigo_subproducto', $row['codigosubproducto'])->first();
            if ($producto) {

                //If someone atributte is null, next producto
                if ($row['nombreproducto'] == null || $row['precioventa2'] == null || $row['precioventa3'] == null || $row['codigoproducto'] == null ) {
                    continue;
                }

                $producto->update([
                    'nombre' => $row['nombreproducto'],
                    'costo_minorista' => (float)$row['precioventa3'],
                    'costo_mayorista' => (float)$row['precioventa2'],
                    'codigo_producto' => $row['codigoproducto'],
                    'codigo_subproducto' => $row['codigosubproducto'],
                ]);


            } else {

                if ($row['nombreproducto'] == null || $row['precioventa2'] == null || $row['precioventa3'] == null || $row['codigoproducto'] == null ) {
                    continue;
                }
                
                Product::create([
                    'nombre' => $row['nombreproducto'],
                    'costo_minorista' => (float)$row['precioventa3'],
                    'costo_mayorista' => (float)$row['precioventa2'],
                    'codigo_producto' => $row['codigoproducto'],
                    'codigo_subproducto' => $row['codigosubproducto'],
                    'estado' => '0'
                ]);
            }
        }
    }
}