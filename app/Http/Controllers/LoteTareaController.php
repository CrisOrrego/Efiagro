<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\LoteTarea;

class LoteTareaController extends Controller
{
    public function postLoteTarea()
 	{
 		$CRUD = new CRUD('App\Models\LoteTarea');
        return $CRUD->call(request()->fn, request()->ops);
	 }
}
