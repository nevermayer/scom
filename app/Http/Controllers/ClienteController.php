<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::all();
        return response()->json([
            "success" => true,
            "data" => $clientes
        ]);
    }
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellido_pat = $request->apellido_pat;
        $cliente->apellido_mat = $request->apellido_mat;
        $cliente->email = $request->email;
        $cliente->password = $request->password;
        $cliente->telefono = $request->telefono;
        $cliente->activo = $request->activo;
        $cliente->save();
        return response()->json([
            "success" => true,
            "data" => $cliente
        ]);
    }
    public function show($id)
    {
        $cliente = Cliente::find($id);
        return response()->json([
            "success" => true,
            "data" => $cliente
        ]);
    }
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($request->id);
        $cliente->nombre = $request->nombre;
        $cliente->apellido_pat = $request->apellido_pat;
        $cliente->apellido_mat = $request->apellido_mat;
        $cliente->email = $request->email;
        $cliente->password = $request->password;
        $cliente->telefono = $request->telefono;
        $cliente->activo = $request->activo;

        $cliente->save();
        return response()->json([
            "success" => true,
            "data" => $cliente
        ]);
    }
    public function destroy($id)
    {
        $cliente = Cliente::destroy($id);
        return response()->json([
            "success" => true,
            "data" => $cliente
        ]);
    }
}
