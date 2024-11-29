<?php

use App\Http\Controllers\api\clienteController;
use App\Http\Controllers\api\wspController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route POST /chats
Route::post('/wsp/listaEspera', [wspController::class, 'listaEspera']);
Route::put('/wsp/listaEspera/{id}', [wspController::class, 'actualizarListaEspera']);
Route::post('/wsp/registrarCliente', [wspController::class, 'registrarCliente']);
Route::get('/wsp/finChat/{id}', [wspController::class, 'finchat']);

//Route Cliente
Route::get('/cliente/{telefono}', [clienteController::class, 'getClientByTelefono']);

//Config
Route::get('/wsp/config', [wspController::class, 'getConfig']);