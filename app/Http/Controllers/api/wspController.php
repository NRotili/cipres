<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class wspController extends Controller
{

    public function registrarCliente(Request $request)
    {
        //Validar recepcion de datos
        $validatedData = Validator::make(
            [
                'nombre' => $request->nombre,
                'telefono' => $request->telefono,
            ],
            [
                'nombre' => 'required|max:255',
                'telefono' => 'required|numeric',
            ],
        );

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Datos incorrectos',
                'errors' => $validatedData->errors(),
            ], 400);
        } else {
            try {
                $cliente = Cliente::create([
                    'nombre' => $request->nombre,
                    'telefono' => $request->telefono,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error al guardar el cliente',
                    'error' => $e->getMessage(),
                ], 500);
            }

            if ($cliente) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Cliente registrado',
                    'data' => $cliente,
                ], 200);
            }
        }
    }

    public function listaEspera(Request $request)
    {


        //Validar recepcion de datos
        $validatedData = Validator::make(
            [
                'tipo' => $request->tipo,
                'nombre' => $request->nombre,
                'telefono' => $request->telefono,
                'consulta' => $request->consulta,
                'tipo' => $request->tipo,
                'status' => $request->status,

            ],
            [
                'nombre' => 'required|max:255',
                'telefono' => 'required|numeric',
                'consulta' => 'required|max:255',
                'tipo' => 'required|max:255',
                'status' => 'required|numeric',
            ],
        );

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Datos incorrectos',
                'errors' => $validatedData->errors(),
            ], 400);
        } else {

            $cliente = Cliente::where('telefono', $request->telefono)->first();

            if (!$cliente) {
                $response = $this->registrarCliente($request);
                $cliente = $response->original['data'];
            }

            try {
                $chat = Chat::create([
                    'client_id' => $cliente->id,
                    'consulta' => $request->consulta,
                    'tipo' => $request->tipo,
                    'status' => $request->status,
                ]);

                $cantEsperando = Chat::where('status', 1)->orderBy('created_at')->count();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Cliente enviado a la cola de espera',
                    'cantEsperando' => $cantEsperando,
                ], 200);
                
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error al guardar el chat',
                    'error' => $e->getMessage(),
                ], 500);
            }

        }
    }
}
