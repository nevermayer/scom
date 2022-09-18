<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    public function index(){
        $orden = Orden::all();
        return $orden;
    }

    //funcion para guardar/almacenar
    public function store( Request $request){
        $orden = new  Orden();
        $orden->nombre = $request->nombre;
        $orden->apellido_pat = $request->apellido_pat;
        $orden->total = $request->total;
        $orden->estado = $request->estado;
        $orden-> fecha= $request->fecha;
        $orden-> hora= $request->hora;
        $orden-> telefono= $request->telefono;
        $orden-> chef_id= $request->chef_id;
        $orden-> camarero_id= $request->camarero_id;
        $orden->save();
    }

    // Para capturar por id cada orden
    public function show( $id){

       $orden = Orden::find($id);
        return $orden;
    }

    public function update( Request $request,$id){

        $orden = Orden::findOrFail($id);
        $orden->nombre = $request->nombre;
        $orden->apellido_pat = $request->apellido_pat;
        $orden->total = $request->total;
        $orden->estado = $request->estado;
        $orden-> fecha= $request->fecha;
        $orden-> hora= $request->hora;
        $orden-> telefono= $request->telefono;
        $orden-> chef_id= $request->chef_id;
        $orden-> camarero_id= $request->camarero_id;
        $orden->save();
        return $orden;
     }

     //Para eliminar

     public function destroy($id){
        $orden = Orden::destroy($id);
        return $orden;
     }
}
