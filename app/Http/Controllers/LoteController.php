<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\Lote;
use App\Functions\Helper;
use App\Models\Finca;

class LoteController extends Controller
{
    public function postLotes()
 	{
 		$CRUD = new CRUD('App\Models\Lote');
        return $CRUD->call(request()->fn, request()->ops);
	}
	
<<<<<<< HEAD
	public function postTareasLote()
 	{
 		$CRUD = new CRUD('App\Models\LoteTarea');
        return $CRUD->call(request()->fn, request()->ops);
	}
	
	public function postObtener()
	{
		$Lotes = TareasLotes::with(['tarea'])->activos()->accesibles()->get();
		return $Lotes;
	}

	// Funcion para obtener los lotes de las fincas segun el id :: Luigi
	public function postFinca()
    {
		$finca = request('finca');
		return Lote::where('finca_id', $finca)->get();
    }

	// Funcion para obtener las fincas y luego los lotes de las fincas que corresponden a un usuario_id :: Luigi
	public function postFincas()
    {
		$usuario = request('usuario');
		$fincas = Finca::where('usuario_id', $usuario)->get('id');
		return Lote::whereIn('finca_id', $fincas)->get();
    }

	public function postActualizar(Request $req)
	{
		$campos = $req->Datos;
		$lote = Lote::findOrFail($campos['id']);
            $lote->linea_productiva_id 	= $campos['linea_productiva_id'];
            $lote->labores_id       	= $campos['labores_id'];
            $lote->hectareas 			= $campos['hectareas'];
            $lote->sitios    			= $campos['sitios'];
            $lote->coordenadas      	= $campos['coordenadas'];
        $lote->save();
	}

	public function postCrear(Request $req)
	{
		$campos = $req->Datos;
        $lote = new Lote();
            $lote->finca_id      		= $req->finca;
            $lote->organizacion_id   	= $req->organizacion;
            $lote->linea_productiva_id 	= $campos['linea_productiva_id'];
            $lote->labores_id       	= $campos['labores_id'];
            $lote->hectareas 			= $campos['hectareas'];
            $lote->sitios    			= $campos['sitios'];
            $lote->coordenadas      	= $campos['coordenadas'];
        $lote->save();
	}
=======
>>>>>>> 0d654d3d864c9d58c3c80c8cfd0c6455403f99cb
}
