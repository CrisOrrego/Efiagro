<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\Lote;
use App\Models\TareaLotes;

class LoteController extends Controller
{
    public function postLotes()
 	{
 		$CRUD = new CRUD('App\Models\Lote');
        return $CRUD->call(request()->fn, request()->ops);
	}
	
	public function postTareasLote()
 	{
 		$CRUD = new CRUD('App\Models\TareaLotes');
        return $CRUD->call(request()->fn, request()->ops);
	}
	
	public function postObtener()
	{
		$Lotes = TareasLotes::with(['tarea'])->activos()->accesibles()->get();
		return $Lotes;
	} 
}
