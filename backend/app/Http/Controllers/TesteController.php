<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class TesteController extends Controller
{
    public function index(Request $request)
    {

        $clientes = Cliente::all();

        $database = Config::get('database.connections.' . Config::get('database.default') . '.database');

        $applicationId = $request->header('X-Application-ID');

        return response()->json([
            'app' => $applicationId,
            'db' => $database,
            'status' => 'success',
            'message' => 'Endpoint de teste funcionando corretamente!',
            'data' => $clientes
        ]);
    }
}
