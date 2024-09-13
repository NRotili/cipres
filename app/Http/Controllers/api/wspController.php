<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class wspController extends Controller
{

    public function actualizarListaEspera(Request $request, $id)
    {
        //Validar recepcion de datos
        $validatedData = Validator::make(
            [
                'id' => $id,
                'status' => $request->status,
                'tipo' => $request->tipo,
                'consulta' => $request->consulta,
            ],
            [
                'id' => 'required|numeric',
                'status' => 'required|numeric',
                'tipo' => 'required|max:255',
                'consulta' => 'required|max:255',
            ],
        );

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Datos incorrectos',
                'errors' => $validatedData->errors(),
            ], 400);
        } else {

            $chat = Chat::find($id);

            if (!$chat) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Chat no encontrado',
                ], 404);
            } else {
                $cantEsperando = Chat::where('status', 1)->orWhere('status', 2)->orderBy('updated_at')->count();
                
                $chat->status = $request->status;
                $chat->tipo = $request->tipo;
                $chat->consulta = $request->consulta;
                $chat->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Chat actualizado',
                    'cantEsperando' => $cantEsperando,
                ], 200);
            }
        }
    }

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

    public function finChat($id)
    {
        //Validar recepcion de datos
        $validatedData = Validator::make(
            [
                'id' => $id,
            ],
            [
                'id' => 'required|numeric',
            ],
        );

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Datos incorrectos',
                'errors' => $validatedData->errors(),
            ], 400);
        } else {

            $chat = Chat::find($id);

            if (!$chat) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Chat no encontrado',
                ], 404);
            } else {
                $chat->status = -2;
                $chat->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Chat finalizado',
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
                'tipo' => $request->tipo,
                'status' => $request->status,

            ],
            [
                'nombre' => 'required|max:255',
                'telefono' => 'required|numeric',
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

                $cantEsperando = Chat::where('status', 1)->orWhere('status', 2)->orderBy('updated_at')->count();
                return response()->json([
                    'id' => $chat->id,
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
