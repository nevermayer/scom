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
        $producto = new Productos();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;

        $producto->save();

    }
    public function show($id)
    {
        $producto=Productos::find($id);
        return $producto;
    }
    public function update(Request $request, $id)
    {
         $producto = Productos::findOrFail($id);
         $producto->nombre = $request->nombre;
         $producto->descripcion = $request->descripcion;
         $producto->precio = $request->precio;
         $producto->cantidad = $request->cantidad;

         $producto->save();
         return $producto;
    }
    public function destroy($id)
    {
         $producto = Productos::destroy($id);
         return $producto;
    }

}
