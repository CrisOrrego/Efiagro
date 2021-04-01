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
    	$Usuario = Usuario::where('correo', $Credenciales['Correo'])->orWhere('documento', $Credenciales['Correo'])->first();
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
        $Usuario = Usuario::where('id', $id)->with([ 'fincas', 'organizaciones' ])->first();

        return $Usuario;
    }
    // Medoto para la actualizacion solo de la clave del usuario.
    public function postActualizarClave()
    {
        $usuario_id = request('usuario_id');
        $contrasena = request('contrasena');

        $usuario = Usuario::where('id', $usuario_id)->first();
        $usuario->contrasena = Crypt::encrypt($contrasena);
        $usuario->save();
    }

    public function postBuscarUsuario()
    {
        $query = request('query');
        return Usuario::where('nombres',   'LIKE', "%$query%")
                    ->orWhere('apellidos', 'LIKE', "%$query%")
                    ->orWhere('documento',    'LIKE', "$query%")
                    ->get();
    }

}
