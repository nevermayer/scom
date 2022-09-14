<?php

namespace App\Http\Controllers;

use App\Models\Ingredientes;
use Illuminate\Http\Request;



class IngredientesController extends Controller
{
    
    public function index(){
        $ingredientes = Ingredientes::all();
        return $ingredientes;
    }

    //funcion para guardar/almacenar
    public function store( Request $request){
        $ingrediente = new  Ingredientes();
        $ingrediente->stock = $request->stock;
        $ingrediente->nombre = $request->nombre;
        $ingrediente-> fecha_vencimiento= $request->fecha_vencimiento;
        
        $ingrediente->save();
    }

    // Para capturar por id cada ingrediente
    public function show( $id){

       $ingrediente = Ingredientes::find($id);
        return $ingrediente;
    }

    public function update( Request $request,$id){

        $ingrediente = Ingredientes::findOrFail($request->$id);
        $ingrediente->stock = $request->stock;
        $ingrediente->nombre = $request->nombre;
        $ingrediente-> fecha_vencimiento= $request->fecha_vencimiento;
        $ingrediente->save();
        return $ingrediente;
     }

     //Para eliminar

     public function destroy($id){
        $ingrediente = Ingredientes::destroy($id);
        return $ingrediente;
     }

}
