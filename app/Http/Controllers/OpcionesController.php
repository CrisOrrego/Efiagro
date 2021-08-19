<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\Opcion;
use App\Functions\Helper;

class OpcionesController extends Controller
{
    public function postOpciones()
 	{
 		$CRUD = new CRUD('App\Models\Opcion');
        return $CRUD->call(request()->fn, request()->ops);
	}

	public function postIndex()
	{
		$Opciones = Opcion::where('organizacion_id', 1)->get()->keyBy('opcion')->transform(function($Op){
			if($Op->tipo == 'Numero') $Op->valor = intval($Op->valor);
			return $Op;

			if($Op->tipo == 'Correo') $Op->valor = intval($Op->valor);
			return $Op;

			if($Op->tipo == 'WhatsApp') $Op->valor = intval($Op->valor);
			return $Op;
		});

		return $Opciones;
	}
	public function postActualizaropcion(Request $req)
	{
		// dd($req);

		// $opcion = Opcion::where('organizacion_id', $req['organizacion'])
		// 	->where('tipo', $req['opcion']);
		// 	$opcion->valor = $req['valor'];
		// 	$opcion->save('valor', $req['valor']);
			
	}
		
}