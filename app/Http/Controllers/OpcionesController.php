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
			
			if($Op->tipo == 'Boolean') $Op->valor = intval($Op->valor);

			if($Op->tipo == 'Lista') $Op->valor = json_decode($Op->valor);

			if($Op->tipo == 'Decimal') $Op->valor = json_decode($Op->valor);
			return $Op;
		});

		return $Opciones;
	}
	public function postActualizar()
	{
		$Opciones = request('Opciones');
		foreach($Opciones as $O){
			$Opcion = Opcion::where('organizacion_id', 1)
			->where('opcion', $O['opcion'])->first();
			$Opcion->valor = $O['valor'];
			$Opcion->save();

		}
		// dd($req);		
	}
		
}