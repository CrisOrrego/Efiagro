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
	
}
