<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index(Request $request){
        $fecha = date('Y-m-d');
        $factura = Factura::where('fecha','=', $fecha)->where('fecha','=', $fecha)->sum('total');
        $semana=500;
        return response()->json([
            "hoy" => $factura,
        "semana"=>$semana]);
    }
}