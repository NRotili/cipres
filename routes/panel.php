<?php

use App\Http\Controllers\Panel\CatalogueController;
use App\Http\Controllers\Panel\HomeController;
use App\Http\Controllers\Panel\ProductController;
use App\Http\Controllers\Panel\Whatsapp\Clientes\ClienteController;
use Illuminate\Support\Facades\Route;



// Route::get('', [HomeController::class,'index'])->name('admin.home');
Route::get('', [HomeController::class, 'index'])->name('panel.index');
Route::get('createcatalogue', [HomeController::class, 'catalogue'])->name('panel.createcatalogue');

Route::resource('products', ProductController::class)->names('panel.products');
Route::resource('catalogues', CatalogueController::class)->names('panel.catalogues');

Route::get('productos/importar', [ProductController::class, 'importar'])->name('panel.productos.importar');

// --------------- ********  EXCEL ******* --------------- //
Route::post('productos/importar', [ProductController::class, 'importarproductos'])->name('administracion.productos.importarproductos');

// --------------- ********  WSP ******* --------------- //
Route::resource('wsp/clientes', ClienteController::class)->names('panel.wsp.clientes');


use Illuminate\Support\Facades\Artisan;

Route::get('/artisan/{command}', function ($command) {
    // Ejecutar el comando Artisan proporcionado en la URL
    $output = Artisan::call($command);

    // Obtener la salida del comando
    $output = Artisan::output();

    return response()->json(['output' => $output]);
});

Route::get('/crear-enlace-storage', function () {
    // Ejecutar el comando Artisan para crear el enlace simbólico storage:link
    Artisan::call('storage:link');

    return 'Enlace simbólico creado correctamente.';
});