<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\FincaEvento;
use App\Functions\Helper;

class FincaEventoController extends Controller
{
    public function postFincaEventos()
 	{
 		$CRUD = new CRUD('App\Models\FincaEvento');
        return $CRUD->call(request()->fn, request()->ops);
	}


	// public function postFinca()
    // {
	// 	$finca = request('finca');
	// 	return Lote::where('finca_id', $finca)->get();
    // }

	// public function postEvento()
    // {
	// 	$evento = request('evento');
	// 	return Evento::where('evento_id', $evento)->get();
    // }

	public function postObtener()
	{
		$FincaEvento = FincaEvento::All();
		return $FincaEvento;
	} 

	
}
