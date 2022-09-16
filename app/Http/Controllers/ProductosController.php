<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Productos;


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
