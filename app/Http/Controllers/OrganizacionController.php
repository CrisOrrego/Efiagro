<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\Organizacion;
use App\Models\UsuarioOrganizacion;
use App\Models\Departamento;
use App\Functions\Helper;

class OrganizacionController extends Controller
{
    public function postOrganizaciones()
	{
		$CRUD = new CRUD('App\Models\Organizacion');
        return $CRUD->call(request()->fn, request()->ops);
	}

	public function postDepartamentos()
 	{
 		$CRUD = new CRUD('App\Models\Departamento');
        return $CRUD->call(request()->fn, request()->ops);
	}

	public function postObtenerOrganizacion()
	{
		$Usuario = Helper::getUsuario();

		$Organizacion = Organizacion::where('id', $Usuario->organizacion_id)->first();

		return $Organizacion;
	}

	// Funcion para obtener las organizaciones que corresponden a un usuario_id
	public function postUsuario()
    {
		$usuario = request('usuario');
		return UsuarioOrganizacion::
            join('organizaciones', 'organizaciones.id', '=', 'organizacion_id')
            ->where("usuario_organizacion.usuario_id", $usuario)
            ->get();
    }

	// Funcion para obtener las organizaciones que corresponden a un usuario_id
	public function postUsuarios()
    {
		$organizacion = request('organizacion');
		return UsuarioOrganizacion::
            join('usuarios', 'usuarios.id', '=', 'usuario_id')
            ->where("usuario_organizacion.organizacion_id", $organizacion)
            ->get();
    }

	// Funcion para obtener las organizaciones que no se han asignado a un usuario_id
	public function postNoasignada()
    {
		$usuario = request('usuario');
		$organizaciones = UsuarioOrganizacion::select('organizacion_id')
            ->where("usuario_id", $usuario)
            ->get();

		return Organizacion::whereNotIn("id", $organizaciones)
            ->get();
    }

	public function postCrearusuarioorganizacion(Request $req)
	{
        $OU = new UsuarioOrganizacion();
            $OU->usuario_id		= $req['usuario'];
            $OU->organizacion_id= $req['organizacion'];
        $OU->save();
	}

	public function postLinea(Request $req)
	{
		return Organizacion::where('linea_productiva_id', $req['linea'])
			->get();
	}

}
