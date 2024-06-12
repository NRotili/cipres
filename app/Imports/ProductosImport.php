<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductosImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $categorias = Categoria::all();

        foreach ($rows as $row){
        
            //Validate if product exist in table productos with codigo.
            $producto = Product::where('codigo_producto', $row['codigoproducto'])->first();
            if ($producto) {

                //If someone atributte is null, next producto
                if ($row['nombreproducto'] == null || $row['precioventa2'] == null || $row['precioventa3'] == null || $row['codigoproducto'] == null || $row['nombrerubro'] == null) {
                    continue;
                }

                //If categoria exist in table categorias, get id, else create new categoria and get id.
                $categoria = $categorias->where('nombre', $row['nombrerubro'])->first();
                if ($categoria) {
                    $categoria_id = $categoria->id;
                } else {
                    $categoria = Categoria::create([
                        'nombre' => $row['nombrerubro']
                    ]);
                    $categoria_id = $categoria->id;
                    $categorias = Categoria::all();
                }

                $producto->update([
                    'nombre' => $row['nombreproducto'],
                    'precioventa3' => (float)$row['precioventa3'],
                    'precioventa2' => (float)$row['precioventa2'],
                    'categoria_id' => $categoria_id,
                ]);

                Log::info('Producto actualizado: ' . $producto->nombre);


            } else {

                if ($row['nombreproducto'] == null || $row['precioventa2'] == null || $row['precioventa3'] == null || $row['codigoproducto'] == null || $row['nombrerubro'] == null) {
                    continue;
                }

                $categoria = $categorias->where('nombre', $row['nombrerubro'])->first();
                if ($categoria) {
                    $categoria_id = $categoria->id;
                } else {
                    $categoria = Categoria::create([
                        'nombre' => $row['nombrerubro']
                    ]);
                    $categoria_id = $categoria->id;
                    $categorias = Categoria::all();

                }

                
                Product::create([
                    'nombre' => $row['nombreproducto'],
                    'precioventa3' => (float)$row['precioventa3'],
                    'precioventa2' => (float)$row['precioventa2'],
                    'codigo_producto' => $row['codigoproducto'],
                    'categoria_id' => $categoria_id,
                    'estado' => '0'
                ]);

                Log::info('Producto creado: ' . $row['nombreproducto']);
            }
        }
    }
}