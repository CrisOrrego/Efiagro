<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\Finca;

class FincaController extends Controller
{
    public function postFincas()
 	{
 		$CRUD = new CRUD('App\Models\Finca');
        return $CRUD->call(request()->fn, request()->ops);
	 }

	 public function zonasFincas()
    {
      
        $Finca = Finca::where('id', $id)->with([ 'zonas' ])->first();

        return $Finca;
    }
}