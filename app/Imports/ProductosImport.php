<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Product;
use Error;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductosImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $categorias = Categoria::all();
        $productos = Product::all();

        foreach ($rows as $row){
        
            //Valido si existe el producto en la base de datos
            $producto = $productos->where('codigo_producto', $row['codigoproducto'])->first();
            //Si existe el producto, actualizo los datos
            if ($producto) {
                //Si alguno de los campos es nulo, no actualizo el producto
                if ($row['nombreproducto'] == null || $row['precioventa2'] == null || $row['precioventa3'] == null || $row['codigoproducto'] == null) {
                    continue;
                }

                //Si categoria existe en tabla categorias, obtengo id, sino creo nueva categoria y obtengo id.
                $categoria = $categorias->where('nombre', $row['nombresubrubro'])->first();
                if ($categoria) {
                    $categoria_id = $categoria->id;
                } elseif (!$row['nombresubrubro'] == null) {
                    $categoria = Categoria::create([
                        'nombre' => $row['nombresubrubro'],
                        'descripcion' => $row['nombresubrubro']
                    ]);
                    $categoria_id = $categoria->id;
                    $categorias = Categoria::all();
                } else {
                    $categoria_id = null;
                }

                //Actualizo producto
                $producto->update([
                    'nombre' => $row['nombreproducto'],
                    'precioventa3' => (float)$row['precioventa3'],
                    'precioventa2' => (float)$row['precioventa2'],
                    'categoria_id' => $categoria_id,
                ]);


            } else {

                if ($row['nombreproducto'] == null || $row['precioventa2'] == null || $row['precioventa3'] == null || $row['codigoproducto'] == null) {
                    continue;
                }

                $categoria = $categorias->where('nombre', $row['nombresubrubro'])->first();
                if ($categoria) {
                    $categoria_id = $categoria->id;
                } elseif (!$row['nombresubrubro'] == null) {
                    $categoria = Categoria::create([
                        'nombre' => $row['nombresubrubro'],
                        'descripcion' => $row['nombresubrubro']
                    ]);
                    $categoria_id = $categoria->id;
                    $categorias = Categoria::all();
                } else {
                    $categoria_id = null;
                }

                //Creo producto
                Product::create([
                    'nombre' => $row['nombreproducto'],
                    'precioventa3' => (float)$row['precioventa3'],
                    'precioventa2' => (float)$row['precioventa2'],
                    'codigo_producto' => $row['codigoproducto'],
                    'categoria_id' => $categoria_id,
                    'estado' => '0'
                ]);

            }
        }
    }
}