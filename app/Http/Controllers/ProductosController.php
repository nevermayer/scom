<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Productos;


class ProductosController extends Controller
{
    
    public function leer()
    {
        $productos= Productos::getall();
        return $productos;
    }
    public function guardar(Request $request)
    {
        $produto = new Productos();
        $produto->nombre = $request->nombre;
        $produto->descripcion = $request->descripcion;
        $produto->precio = $request->precio;
        $produto->cantidad = $request->cantidad;

        $produto->save();

    }
    public function editar(Request $request, $id)
    {
         $producto = Productos::findOrFail($request->id);
         $produto->nombre = $request->nombre;
         $produto->descripcion = $request->descripcion;
         $produto->precio = $request->precio;
         $produto->cantidad = $request->cantidad;

         $producto->save();
         return $producto;
    }
    public function eliminar($id)
    {
         $producto = Productos::destroy($id);
         return $producto;
    }

}
