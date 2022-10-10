<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contacto;

class ContactoController extends Controller
{

    
    public function enviar(Request $request)
    {
        $contacto = new Contacto();
        $contacto->nombre = $request->nombre;
        $contacto->email = $request->email;
        $contacto->mensaje = $request->mensaje;
        $contacto->save();
        return 
    }
    
   
    
}
