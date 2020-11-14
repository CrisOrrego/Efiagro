<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Seccion;

class MainController extends Controller
{
    public function postObtenerSecciones()
    {
    	$Secciones = Seccion::get()->groupBy('seccion_slug');
    	return $Secciones;
    }

    public function cargarSeccion($seccion)
    {
    	return "<h1>$seccion</h1>";
    }

    public function cargarSubseccion($seccion, $subseccion)
    {
    	$nombre_vista = $seccion.".".$subseccion;
        if(view()->exists($nombre_vista)){
            return view($nombre_vista);
        }else{
            return "<h2>$nombre_vista no existe...</h2>";
        }
    }

    public function cargarFragmento($vista)
    {
        return view($vista);
    }
}
