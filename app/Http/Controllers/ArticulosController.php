<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Articulo;
use App\Models\ArticuloSeccion;

class ArticulosController extends Controller
{
 	public function postObtener()
	{
		$Articulos = Articulo::with(['secciones'])->activos()->accesibles()->get();
		return $Articulos;
	}   
}
