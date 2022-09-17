<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Productos;
use App\Models\Bebidas;
use App\Models\Platillos;
use App\Models\Postres;


class ProductosController extends Controller
{
    
    public function index()
    {
        $productos= Productos::all();
        return $productos;
    }
    public function store(Request $request)
    {
        $produto = new Productos();
        $produto->nombre = $request->nombre;
        $produto->descripcion = $request->descripcion;
        $produto->precio = $request->precio;
        $produto->cantidad = $request->cantidad;

        $produto->producto = $request->producto;

        $produto->save();

        if($request->producto =="platillo"){
            $producto = new Platillos();
            $producto ->producto_id = $producto->id;
        }
        if($request->producto =="postre"){
            $producto = new Postres();
            $producto ->producto_id = $producto->id;
        }
        if($request->producto =="bebida"){
            $producto = new Bebidas();
            $producto ->producto_id = $producto->id;
        }
        $produto->save();

    }
    public function show($id)
    {
        $producto=Productos::find($id);
        return $producto;
    }
    public function update(Request $request, $id)
    {
         $producto = Productos::findOrFail($request->id);
         $produto->nombre = $request->nombre;
         $produto->descripcion = $request->descripcion;
         $produto->precio = $request->precio;
         $produto->cantidad = $request->cantidad;

         $producto->save();
         return $producto;
    }
    public function destroy($id)
    {
         $producto = Productos::destroy($id);
         return $producto;
    }

}
