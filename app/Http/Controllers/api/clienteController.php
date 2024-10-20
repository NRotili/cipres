<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class clienteController extends Controller
{
    //getClientByTelefono
    public function getClientByTelefono($telefono){
        $cliente = Cliente::select( 'nombre', 'telefono', 'email', 'localidad', 'apellido')
            ->where('telefono', $telefono)
            ->first();

        if(!$cliente){
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        
        return response()->json($cliente);
    }
}
