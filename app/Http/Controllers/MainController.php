<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Seccion;

use Image;
use File;

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

    public function postUploadImg()
    {
        extract(request()->all()); //Path, Quality

        //dd(Input::file('file'));
        $image = Image::make(request('file')->getRealPath());
        
        $Ruta = dirname($Path);
        if(!File::exists($Ruta)) File::makeDirectory($Ruta, 0775, true, true);

        if(!$image->save($Path, $Quality)){
            return response()->json(['Msg' => 'No se pudo guardar la imagen'], 512);
        }else{
            return response()->json(['Msg' => $Path ], 200);
        };
    }

}
