<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Factura;

class FacturaController extends Controller
{

    public function index()
    {
        $facturas = Factura::all();
        return response()->json([
            "success" => true,
            "data" => $facturas
        ]);
    }
    public function store(Request $request)
    {
        $fecha = date('Y-m-d');
        $factura = Factura::where('orden_id', '=', $request->orden_id)->first();
        if (!isset($factura->id)) {
            $factura = Factura::create([
                'total' => $request->total,
                'fecha' => $fecha,
                'orden_id' => $request->orden_id,
            ]);
        }
        return response()->json([
            "data" => $factura->id]);
    }
    public function show($id)
    {
        $factura = Factura::find($id);
        return response()->json([
            "success" => true,
            "data" => $factura
        ]);
    }
    public function update(Request $request, $id)
    {
        $factura = Factura::findOrFail($request->id);
        $factura->total = $request->total;
        $factura->fecha = $request->fecha;
        $factura->cajero_id = $request->cajero_id;
        $factura->orden_id = $request->orden_id;
        $factura->cliente_id = $request->cliente_id;

        $factura->save();
        return response()->json([
            "success" => true,
            "data" => $factura
        ]);
    }
    public function destroy($id)
    {
        $factura = Factura::destroy($id);
        return response()->json([
            "success" => true,
            "data" => $factura
        ]);
    }
}
