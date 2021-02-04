<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Functions\CRUD;

use Crypt;

class UsuarioController extends Controller
{
    public function postUsuarios()
    {
        $CRUD = new CRUD('App\Models\Usuario');
        return $CRUD->call(request()->fn, request()->ops);
    }

    public function postLogin()
    {
    	$Credenciales = request('Credenciales');
    	$Usuario = Usuario::where('correo', $Credenciales['Correo'])->orWhere('cedula', $Credenciales['Correo'])->first();
    	if($Usuario){
    		return Crypt::encrypt($Usuario->id);
    	}else{
    		return response()->json(['Msg' => 'Error en usuario o contraseña'], 500);
    	}
    }
 
    public function postRevisarToken()
    {
        $token = request('token');
        if(!$token) return response()->json(['Msg' => 'Usuario no autorizado'], 412);

        $id = Crypt::decrypt($token);
        $Usuario = Usuario::where('id', $id)->first();
 
        return $Usuario;
    }

}
