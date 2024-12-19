<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Cliente;
use App\Models\Configuracione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class wspController extends Controller
{



    //blacklist
    public function blacklist()
    {

        $clientes = Cliente::where('blacklist', 1)->get();
        if ($clientes->count() > 0) {
            foreach ($clientes as $cliente) {
                try {
                    $response = Http::post(env('BOT_WHATSAPP') . 'v1/blacklist', [
                        'number' => $cliente->telefono,
                        'intent' => 'add',
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Error al agregar a la blacklist',
                        'error' => $e->getMessage(),
                    ], 500);
                }
            }
        }
    
        $chats = Chat::whereIn('status', [1, 2])
        ->orderBy('updated_at')->get();

        if ($chats->count() > 0) {
            foreach ($chats as $chat) {
                try {
                    $response = Http::post(env('BOT_WHATSAPP') . 'v1/blacklist', [
                        'number' => $chat->cliente->telefono,
                        'intent' => 'add',
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Error al agregar a la blacklist',
                        'error' => $e->getMessage(),
                    ], 500);
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Clientes agregados a la blacklist',
        ], 200);
    }

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
                $cantEsperando = $cantEsperando = Chat::whereIn('status', [0, 1, 2])
                ->orderBy('updated_at')->count();

                $chat->status = $request->status;
                $chat->tipo = $request->tipo;
                $chat->consulta = $request->consulta;
                $chat->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Chat actualizado',
                    'cantEsperando' => $cantEsperando + 10,
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
                'nombre' => 'max:255',
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

            $chat = $cliente->chats()
                ->whereIn('status', [0, 1, 2])
                ->orderBy('updated_at', 'desc')
                ->first();

            if ($chat) {
                return response()->json([
                    'id' => $chat->id,
                    'status' => 'success',
                    'message' => 'Ya existe un chat en espera',
                ], 200);
            }

            try {
                $chat = Chat::create([
                    'client_id' => $cliente->id,
                    'consulta' => $request->consulta,
                    'tipo' => $request->tipo,
                    'status' => $request->status,
                ]);

                $cantEsperando = Chat::whereIn('status', [0, 1, 2])
                    ->orderBy('updated_at')->count();

                return response()->json([
                    'id' => $chat->id,
                    'status' => 'success',
                    'message' => 'Cliente enviado a la cola de espera',
                    'cantEsperando' => $cantEsperando + 10,
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

    //getConfig
    public function getConfig()
    {
        $config = Configuracione::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Configuraciones',
            'data' => $config,
        ], 200);
    }
}
