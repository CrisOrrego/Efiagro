<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListaDetalle;
use App\Models\Lista;
use App\Functions\CRUD;

class ListaController extends Controller
{
    public function postListas()
 	{
 		$CRUD = new CRUD('App\Models\Lista');
        return $CRUD->call(request()->fn, request()->ops);
	}
	
	public function postDetalles()
 	{
 		$CRUD = new CRUD('App\Models\ListaDetalle');
        return $CRUD->call(request()->fn, request()->ops);
	}

	public function getLista()
	{
		//$L = Lista:: with ("listadetalle") -> where ("id", 1); // me trae la lista con los detalles donde el id sea 1
		$L = Lista::with ("listadetalle")->where("id", 1)->first();
		return $L;
	}

	public function postActualizar(Request $req)
	{
		$lista=$req->Lista;
		$listadetalles=$req->Lista['listadetalle'];
		foreach($listadetalles as $d){
			if(isset($d['id'])){
				$listadetalle=ListaDetalle::findOrFail($d['id']);
			}else{
				$listadetalle = new Listadetalle();
			}	
			if(strlen($d['descripcion'])>0){
				$listadetalle->lista_id=$lista['id']; //todos los campos de la tabla
				$listadetalle->codigo=$d['codigo']; 
				$listadetalle->descripcion=$d['descripcion']; 
				$listadetalle->op1=$d['op1']; 
				$listadetalle->op2=$d['op2']; 
				$listadetalle->op3=$d['op3']; 
				$listadetalle->op4=$d['op4']; 
				$listadetalle->op5=$d['op5'];
				$listadetalle->save(); 
			}		
		}
		$L = Lista::with ("listadetalle")->findOrFail($lista['id']); 
		return $L;
	}
	
}
