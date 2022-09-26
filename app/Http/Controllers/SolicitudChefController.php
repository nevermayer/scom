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
        $all_ids = array();
        foreach ($data as $el) {
            array_push($all_ids, $el['id']);
        }
        $chef = Chef::create([
            'id_usuario' => $request->id_usuario
        ]);
        foreach($data as $res){
            $chef->ingredientes()->attach($res['id'],[
                'cantidad'=>$res['qty'],
                'status'=>$res['qty'],
                'fecha'=>$res['qty']
            ]);
            Ingrediente::find($res['id'])->decrement('cantidad',$res['qty']);
        }
        $msg="se creo la solicitud";
        return response()->json([
            "message" => $msg
        ]);
    }

}
