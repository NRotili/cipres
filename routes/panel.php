<?php

use App\Http\Controllers\Panel\CatalogueController;
use App\Http\Controllers\Panel\HomeController;
use App\Http\Controllers\Panel\ProductController;
use Illuminate\Support\Facades\Route;



// Route::get('', [HomeController::class,'index'])->name('admin.home');
Route::get('', [HomeController::class, 'index'])->name('panel.index');
Route::get('createcatalogue', [HomeController::class, 'catalogue'])->name('panel.createcatalogue');

Route::resource('products', ProductController::class)->names('panel.products');
Route::resource('catalogues', CatalogueController::class)->names('panel.catalogues');