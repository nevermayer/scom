<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre_cuenta' => 'required|unique:users',
            'password' => 'required|confirmed',
            'nombre' => 'required',
            'apellido_pat' => 'required',
            'apellido_mat' => 'required',
            'activo' => 'required',
            'super_usuario' => 'required',
            'turno' => 'required'
        ]);
        $usuario = new User();
        $usuario->nombre_cuenta = $request->nombre_cuenta;
        $usuario->password = Hash::make($request->password);
        $usuario->nombre = $request->nombre;
        $usuario->apellido_pat = $request->apellido_pat;
        $usuario->apellido_mat = $request->apellido_mat;
        $usuario->activo = $request->activo;
        $usuario->super_usuario = $request->super_usuario;
        $usuario->turno = $request->turno;
        $usuario->save();
        return response()->json([
            "success" =>true,
            "message" => "Registro de usuario exitoso",
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'nombre_cuenta' => 'required',
            'password' => 'required'
        ]);
        $usuario = User::where("nombre_cuenta", "=", $request->nombre_cuenta)->first();
        if (isset($usuario->id)) {
            if (Hash::check($request->password, $usuario->password)) {
                //creando token 
                $token = $usuario->createToken("auth_token")->plainTextToken;
                return response()->json([
                    "success" => true,
                    "message" => "Usuario logueado exitosamente",
                    "access_token" => $token,
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "el password es incorrecto",
                ], 404);
            }
        } else {
            return response()->json([
                "success" => false,
                "message" => "usuario no registrado",
            ], 404);
        }
    }
    public function userprofile()
    {
        return response()->json([
            "success" => true,
            "message" => "perfil del usuario",
            "data" => auth()->user()
        ]);
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            "success" => true,
            "message" => "cierre de session",
        ]);
    }
}
