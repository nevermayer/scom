<?php

namespace App\Http\Controllers;

use App\Models\SolicitudChef;
use Illuminate\Http\Request;

class SolicitudChefController extends Controller
{
    public function index(){
        $solicitudChef = SolicitudChef::all();
        return $solicitudChef;
    }

    public function store( Request $request){
        $solicitudChef = new  SolicitudChef();
        $solicitudChef->cantidad = $request->cantidad;
        $solicitudChef->status= $request->status;
        $solicitudChef->fecha = $request->fecha;
        $solicitudChef->chef_id = $request->chef_id;
        $solicitudChef->ingredientes_id = $request->ingredientes_id;
        $solicitudChef->save();
    }

    public function show( $id){

       $solicitudChef = SolicitudChef::find($id);
        return $solicitudChef;
    }

    public function update( Request $request,$id){

        $solicitudChef = SolicitudChef::findOrFail($id);
        $solicitudChef->cantidad = $request->cantidad;
        $solicitudChef->status= $request->status;
        $solicitudChef->fecha = $request->fecha;
        $solicitudChef->chef_id = $request->chef_id;
        $solicitudChef->ingredientes_id = $request->ingredientes_id;
        $solicitudChef->save();
        return $solicitudChef;
     }

    public function destroy($id){
        $solicitudChef = SolicitudChef::destroy($id);
        return $solicitudChef;
    }
}
