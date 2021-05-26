<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\LoteLabores;
use App\Functions\Helper;

class LoteLaboresController extends Controller
{
    public function postlotelabores()
 	{
 		$CRUD = new CRUD('App\Models\LoteLabores');
        return $CRUD->call(request()->fn, request()->ops);
	}
	public function postObtener()
	 {
		 $LoteLabores = LoteLabores::All();
		 return $LoteLabores;
	 } 
}
