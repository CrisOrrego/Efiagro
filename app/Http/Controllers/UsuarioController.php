<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function postLogin()
    {
    	$Credenciales = request('Credenciales');
    	
    	$Usuario = Usuario::where('correo', $Credenciales['Correo'])->orWhere('cedula', $Credenciales['Correo'])->first();

    	if($Usuario){
    		return $Usuario;
    	}else{
    		return response()->json(['Msg' => 'Error en usuario o contraseña'], 500);
    	}
    }
}
