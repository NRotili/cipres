<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'nombre' => 'Bombita Defumacion "Sagrada Madre"',
            'precioventa2'=>69,
        ]);

        Product::create([
            'nombre' => 'Carbones Redondos "Sagrada Madre"',
            'precioventa2'=>6,
        ]);
    }
}
