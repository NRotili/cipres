<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');


        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
