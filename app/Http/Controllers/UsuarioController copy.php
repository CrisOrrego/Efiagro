<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Functions\CRUD;

use Illuminate\Support\Facades\Crypt;

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
        $claveSesion = $Credenciales['Password'];
        $usuarioSesion = $Credenciales['Correo'];
    	$Usuario = Usuario::where('correo', $usuarioSesion)
            ->orWhere('documento', $usuarioSesion)
            ->first();
        $dato = Crypt::encrypt($Usuario['contrasena']);
        // $dato = $Usuario['contrasena'];

    	if ( $Usuario ) {
            if ( Crypt::decryptString($Usuario['contrasena']) == $claveSesion ) {
            // if ( $Usuario['contrasena'] == $claveSesion ) {
                return Crypt::encrypt($Usuario->id);
            } else {
                return response()->json(['Msg' => 'Error en la contraseña registrada'], 500);
            }
    	} else {
    		return response()->json(['Msg' => 'Error en el usuario registrado'], 500);
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
        $usuario->contrasena = Crypt::encryptString(trim($contrasena), false);
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

    // Medoto para la actualizacion de cualquier campo de la tabla del usuario. // Luigi
    public function postActualizarcampo()
    {
        $usuario_id = request('usuario');
        $campo      = request('campo');
        $valor      = request('valor');
        $usuario = Usuario::where('id', $usuario_id)->first();
        $usuario->$campo = $valor;
        $usuario->save();
    }

}
