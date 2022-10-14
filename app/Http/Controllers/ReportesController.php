<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index(Request $request)
    {
        $fecha = date('Y-m-d');
        $mes = date("Y-m");
        /*  $from = date('2018-01-01');
        $to = date('Y-m-d');
        $factura = Factura::where('fecha','=', $fecha)->where('fecha','=', $fecha)->sum('total');
        $semana=Factura::whereBetween('fecha',[$from, $to])->sum('total');
        return response()->json([
            "hoy" => $factura,
        "semana"=>$semana]);
        */
        $dia2 = date("d");
        // Día del mes, sin ceros iniciales, de 1 a 31
        $dia = date("j");
        // Día de la semana en inglés, con 3 letras, de Mon a Sun
        $diasemana = date("D");
        // Día de la semana en inglés, de Sunday a Saturday
        $diasemana2 = date("l");
        // del día de la semana, desde 1 (lunes) hasta 7 (domingo)
        $diasemana3 = date("N");
        $meses = Factura::where('fecha', $mes)->sum('total');
        return response()->json([
            "dia" => $meses,
            "mes"=>$meses
        ]);
    }
}
