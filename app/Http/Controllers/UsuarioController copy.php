<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticuloEstado;
use App\Functions\CRUD;

use Illuminate\Support\Facades\Crypt;

class UsuarioController extends Controller
{
    public function postArticuloEstado()
    {
        $CRUD = new CRUD('App\Models\ArticuloEstado');
        return $CRUD->call(request()->fn, request()->ops);
    }

    public function postObtener()
	{
		$ArticuloEstado = ArticuloEstado::All();
		return $ArticuloEstado;
	} 

    

}
