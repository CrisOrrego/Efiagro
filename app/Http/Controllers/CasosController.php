<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\Caso;

class CasosController extends Controller
{
    public function postCasos()
 	{
 		$CRUD = new CRUD('App\Models\Caso');
        return $CRUD->call(request()->fn, request()->ops);
 	}
}
