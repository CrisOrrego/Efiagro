<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function Login()
    {
    	$Credenciales = request('Credenciales');
    	return $Credenciales;
    }
}
