<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\Finca;

class FincaController extends Controller
{
    public function postFincas()
 	{
 		$CRUD = new CRUD('App\Models\Finca');
        return $CRUD->call(request()->fn, request()->ops);
	}

	public function zonasFincas()
    {
        $Finca = Finca::where('id', $id)->with([ 'zonas' ])->first();
        return $Finca;
    }

    // Funcion para obtener las fincas que corresponden a un usuario_id
	public function postUsuario()
    {
        $usuario = request('usuario');
        $Fincas = Finca::where('usuario_id', $usuario)->get();
        return $Fincas;
    }

    public function postActualizar(Request $req)
	{
		$campos = $req->Datos;
		$finca = Finca::findOrFail($campos['id']);
            $finca->nombre          = $campos['nombre'];
            $finca->direccion       = $campos['direccion'];
            $finca->departamento_id = $campos['departamento_id'];
            $finca->municipio_id    = $campos['municipio_id'];
            $finca->area_total      = $campos['area_total'];
            $finca->tipo_cultivo    = $campos['tipo_cultivo'];
            $finca->total_lotes     = $campos['total_lotes'];
            $finca->tipo_suelo      = $campos['tipo_suelo'];
            $finca->zona_id         = $campos['zona_id'];
            $finca->latitud         = $campos['latitud'];
            $finca->longitud        = $campos['longitud'];
            $finca->hectareas       = $campos['hectareas'];
            $finca->sitios          = $campos['sitios'];
            $finca->temperatura     = $campos['temperatura'];
            $finca->humedad_relativa= $campos['humedad_relativa'];
            $finca->precipitacion   = $campos['precipitacion'];
            $finca->altimetria_min  = $campos['altimetria_min'];
            $finca->altimetria_max  = $campos['altimetria_max'];
            $finca->brillo_solar    = $campos['brillo_solar'];
        $finca->save();
	}

    public function postCrear(Request $req)
	{
		$campos = $req->Datos;
        $finca = new Finca();
            $finca->usuario_id      = $req->usuario;
            $finca->nombre          = $campos['nombre'];
            $finca->direccion       = $campos['direccion'];
            $finca->departamento_id = $campos['departamento_id'];
            $finca->municipio_id    = $campos['municipio_id'];
            $finca->area_total      = $campos['area_total'];
            $finca->tipo_cultivo    = $campos['tipo_cultivo'];
            $finca->total_lotes     = $campos['total_lotes'];
            $finca->tipo_suelo      = $campos['tipo_suelo'];
            $finca->zona_id         = $campos['zona_id'];
            $finca->latitud         = $campos['latitud'];
            $finca->longitud        = $campos['longitud'];
            $finca->hectareas       = $campos['hectareas'];
            $finca->sitios          = $campos['sitios'];
            $finca->temperatura     = $campos['temperatura'];
            $finca->humedad_relativa= $campos['humedad_relativa'];
            $finca->precipitacion   = $campos['precipitacion'];
            $finca->altimetria_min  = $campos['altimetria_min'];
            $finca->altimetria_max  = $campos['altimetria_max'];
            $finca->brillo_solar    = $campos['brillo_solar'];
        $finca->save();
	}
}