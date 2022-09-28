<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use App\Models\Ingrediente;
use Illuminate\Http\Request;


class SolicitudChefController extends Controller
{

    public function Solicitud(Request $request)
    {
        $data = json_decode($request->items, true);

        $ingrediente = Ingrediente::findOrFail($request);

        $chef = Chef::findOrFail($request);

        foreach ($data as $res) {

            $chef->ingredientes()->attach($res['id'], [
                'cantidad' => $res['qty'],
                'status' => $res['status'],
                'fecha' => date('j/n/Y')
            ]);
            $chef->save();
        }
        $msg = "se creo la solicitud";
        return response()->json([
            "message" => $msg
        ]);
    }
}
