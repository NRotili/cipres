<?php

use App\Http\Controllers\Panel\HomeController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth:sanctum'])->get('/', [HomeController::class, 'index']);

Route::get('catalogo/{tipo}/{catalogue}', [HomeController::class, 'catalogue']);


