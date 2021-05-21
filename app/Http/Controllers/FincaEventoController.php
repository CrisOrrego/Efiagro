<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\FincaEvento;
use App\Functions\Helper;

class FincaEventoController extends Controller
{
    public function postEvento()
 	{
 		$CRUD = new CRUD('App\Models\FincaEvento');
        return $CRUD->call(request()->fn, request()->ops);
	}
	
}
