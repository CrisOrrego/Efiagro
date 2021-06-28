<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\LoteLabores;
use App\Models\LotesLabores;
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

	 //INICIO DEV ANGELICA
	 public function getLotelaborsemana($loteid, $lineaproductivaid, $numsemana)
	 {
		//var_dump($loteid); die(); 
		$result = array();
		$L = LotesLabores::join('labores','loteslabores.labor_id', '=', 'labores.id')
		->select('loteslabores.labor', 'loteslabores.inicio', 'loteslabores.frecuencia', 'labores.labor AS otraLabor')
		->where('labores.linea_productiva_id', $lineaproductivaid)
		->where('lote_id', $loteid)->get();

		foreach($L as $lotelabor){
			if($numsemana - $lotelabor->inicio >= 0){
				if(($numsemana - $lotelabor->inicio) % $lotelabor->frecuencia==0){
					array_push($result, $lotelabor);
				}
			}
		}
		return $result;
	 }
	 //FIN DEV ANGELICA
}
