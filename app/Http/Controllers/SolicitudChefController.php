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
        $chef = Chef::findOrFail($request->chef_id);
        foreach ($data as $res) {
            $chef->ingredientes()->attach($res['id'], [
                'cantidad' => $request->cantidad,
                'status' =>  $request->status,
                'fecha' =>  $request->fecha
            ]);
            $chef->save();
        }
        $msg = "se creo la solicitud";
        return response()->json([
            "message" => $msg
        ]);
    }
}
