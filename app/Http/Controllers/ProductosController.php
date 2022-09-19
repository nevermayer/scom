<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\Bebida;
use App\Models\Platillo;
use App\Models\Postre;


class ProductosController extends Controller
{
    
    public function index()
    {
        $productos= Producto::all();
        return $productos;
    }
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->save();

        if($request->producto =="platillo"){
            $temp = new Platillo();
            $temp ->producto_id = $producto->id;
            $temp->tiempo_elaboracion=$request->tiempo_elaboracion;
        }
        if($request->producto =="postre"){
            $temp = new Postre();
            $temp ->producto_id = $producto->id;
            $temp->tiempo_elaboracion=$request->tiempo_elaboracion;
        }
        if($request->producto =="bebida"){
            $temp = new Bebida();
            $temp ->producto_id = $producto->id;
            $temp ->grado_alcoholico = $request->grado_alcoholico;
        }
        $temp->save();

    }
    public function show($id)
    {
        $producto=Producto::find($id);
        isset($producto->platillos);
        isset($producto->postres);
        isset($producto->bebidas);
        return $producto;
    }
    public function update(Request $request, $id)
    {
         $producto = Producto::findOrFail($request->id);
         $producto->nombre = $request->nombre;
         $producto->descripcion = $request->descripcion;
         $producto->precio = $request->precio;
         $producto->cantidad = $request->cantidad;

         $producto->save();
         return $producto;
    }
    public function destroy($id)
    {
         $producto = Producto::destroy($id);
         return $producto;
    }

}
