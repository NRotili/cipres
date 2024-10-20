<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProxyController extends Controller
{
    public function fetchImage(Request $request)
    {
        $url = $request->query('url'); // Obtén la URL desde la query string

        if (!$url) {
            return response()->json(['error' => 'URL is required'], 400);
        }

        try {
            $response = Http::get($url); // Realiza la petición a la URL remota

            if ($response->successful()) {
                return response($response->body(), 200)
                    ->header('Content-Type', $response->header('Content-Type')); // Devuelve la imagen con su Content-Type
            } else {
                return response()->json(['error' => 'Failed to fetch image'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching image: ' . $e->getMessage()], 500);
        }
    }
}
