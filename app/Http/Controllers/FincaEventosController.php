<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\FincaEvento;

class FincaEventosController extends Controller
{
    public function postFincaEventos()
 	{
 		$CRUD = new CRUD('App\Models\FincaEvento');
        return $CRUD->call(request()->fn, request()->ops);
	}

}
