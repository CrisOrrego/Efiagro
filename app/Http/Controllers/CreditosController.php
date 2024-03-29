<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\Helper;
use App\Models\Credito;
use App\Models\CreditoSaldo;
use App\Models\CreditoRecibo;
use App\Models\CreditoAbono;
use App\Functions\CRUD;
use Carbon\Carbon;

class CreditosController extends Controller
{
	public function postCrud()
	{
		$CRUD = new CRUD('App\Models\Credito');
        return $CRUD->call(request()->fn, request()->ops);
	}


	/**
	 * Obtener el listado de créditos
	 * @return array Creditos
	 */
	public function postGet()
	{
		return Credito::where('afiliado_id', request('asociado_id'))
			//->with(['saldos'])
			->orderBy('id', 'Desc')->get();
	}


	/**
	 * Obtener un crédito específico
	 * @return Object Credito
	 */
	public function getIndex()
	{
		$I = request()->all();

		$Cred = Credito::where('id', $I['id'])
			->with(['saldos', 'recibos'])
			->first();
		$Cred->CalcSaldos();
		
		//Calcular saldo pendiente
		$Cred->Saldo = $Cred->saldos->sum('pendiente') + $Cred->saldos->sum('mora');

		//Determinar el estado
		$Cred->CalcEstado();

		Credito::where('id', $I['id'])->update([ 
											'saldo' => $Cred->saldo, 
											'estado' => $Cred->Estado, 
											'estado_color' => $Cred->Estado_color, 
											'proximo_pago' => $Cred->proximo_pago, 
										]);

		return $Cred;
	}


	public function postAdd()
	{
		$I = request()->all();

		$Usuario = Helper::getUsuario();

		$C = new Credito([
			'organizacion_id' 	=> $Usuario->organizacion_id,
			'afiliado_id' 		=> $I['Asociado']['id'], 	
			'estado' 			=> 'Normal', 		
			'linea' 			=> $I['Credit']['Linea'], 			
			'monto' 			=> $I['Credit']['Monto'], 			
			'interes' 			=> floatval($I['Credit']['Interes']) * 100, 		
			'pagos' 			=> $I['Credit']['Cada']['Nombre'], 			
			'periodos' 			=> $I['Credit']['Periodos'], 		
			'periodos_gracia' 	=> $I['Credit']['Periodos_Gracia'],
			'cuota' 			=> $I['Credit']['Cuota'], 			
			'saldo' 			=> $I['AmortableRes']['Total'], 			
			'proximo_pago' 		=> null, 	
			'usuario_id' 		=> $Usuario->id	
		]);

		$C->save();

		//Crear los pagos
		foreach ($I['Amortable'] as $k => $A) {
			$S = new CreditoSaldo([
				'credito_id' 	=> $C->id,
				'tipo' 			=> 'CREDITO',
				'num_pago' 		=> $A['Num_Pago'],
				'fecha' 		=> $A['Fecha'],
				'capital' 		=> $A['Capital'],
				'interes' 		=> $A['Interes'],
				'total' 		=> $A['Total'],
				'deuda' 		=> $A['Deuda'],
				'usuario_id' 	=> $Usuario->id	
			]);
			
			$S->save();
		}

		//return $C;
	}


	public function addAbono($credito_id, $recibo_id, $saldo_id, $paga, $tipo, $valor)
	{
		$Abono 				= new CreditoAbono();
		$Abono->credito_id	= $credito_id;
		$Abono->recibo_id	= $recibo_id;
		$Abono->saldo_id 	= $saldo_id;
		$Abono->paga 		= $paga;
		$Abono->tipo 		= $tipo;
		$Abono->valor 		= $valor;
		$Abono->save();

		return $Abono;
	}


	public function postTemplatePrep()
	{
		$file = \Input::file('file');
		$Rows = \Excel::load($file, function($reader) {})->get()[0];

		$Pagos = ['Mensuales','Bimestrales','Trimestrales','Cuatrimestrales','Semestrales','Anuales'];

		$Rows->transform(function($Row) use ($Pagos){

			//Ajustes
			$Row['Estado'] = '';
			$Row['Documento'] = intval($Row['Documento']);
			$Row['Monto']	  = intval($Row['Monto']);
			$Row['Interes']	  = floatval($Row['Interes']);
			$Row['Periodos']	      = intval($Row['Periodos']);
			$Row['Periodos_Gracia']	  = intval($Row['Periodos_Gracia']);


			//Usuario
			if($Row['Documento'] < 1){
				$Row['Estado'] .= 'Documento Inválido ';
			}else{
				$Asociado = User::where('Documento', $Row['Documento'])->first();
				if(is_null($Asociado)){
					$Row['Estado'] .= 'Asociado no encontrado ';
				}else{
					$Row['Asociado'] = $Asociado;
				}
			}

			if($Row['Interes'] > 1) $Row['Interes'] = $Row['Interes'] / 100;
			
			
			if($Row['Monto'] < 1) $Row['Estado'] .= 'Monto Inválido ';
			if($Row['Linea'] == '') $Row['Estado'] .= 'Falta línea ';
			if($Row['Interes'] < 0.0001) $Row['Estado'] .= 'Interés Inválido ';
			if(!in_array($Row['Pagos'], $Pagos)) $Row['Estado'] .= 'Pagos Inválidos ';
			if($Row['Periodos'] < 1) $Row['Estado'] .= 'Periodos Inválido ';
			if($Row['Periodos_Gracia'] < 0) $Row['Estado'] .= 'Periodos de Gracia Inválido ';
			if($Row['Fecha_Inicio'] == null){ 
				$Row['Estado'] .= 'Fecha de Inicio Inválida ';
			}else{
				$Row['Fecha_Inicio'] = $Row['Fecha_Inicio']->toDateString();
			};

			if($Row['Estado'] !== ''){ $Row['Color'] = '#fdd1d1'; }
			return $Row;
		});

		return compact('Rows');
	}


	public function postPay()
	{
		$I = request()->all();
		extract($I); //$Pago, $CredSel, $Pagos, $Amortable

		$usuario_id = Helper::getUsuarioId();

		if($Pago['Medio'] == 'Efectivo') $Pago['NoConsignacion'] = null;

		//Iniciaremos por registrar el recibo
		$Recibo = new CreditoRecibo;
		$Recibo->credito_id = $CredSel['id'];
        $Recibo->user_id = $usuario_id;
        $Recibo->medio = $Pago['Medio'];
        $Recibo->no_consignacion = $Pago['NoConsignacion'];
        $Recibo->valor_recibido = $Pago['Valor'];
        $Recibo->valor_devuelto = $Pago['Devolver'];
        $Recibo->valor = $Recibo->valor_recibido - $Recibo->valor_devuelto;
        $Recibo->save();
        

		//Ahora registrar los abonos correspondientes
		foreach ($Pagos as $P) {
			if(!array_key_exists('saldo_id', $P)) $P['saldo_id'] = null;
			$this->addAbono($CredSel['id'], $Recibo->id, $P['saldo_id'], $P['Paga'], $P['Tipo'], $P['Valor']);
		}

		//Si hay que eliminar cuotas
		if($Pago['Num_Pago_Elim']){
			CreditoSaldo::where('credito_id', $CredSel['id'])
				->where('Num_Pago', '>=', $Pago['Num_Pago_Elim'])->delete();
		}

		//Si se requiere reamortizar
		if(!is_null($Amortable)){
			foreach ($Amortable as $A) {
				$S = new CreditoSaldo();
				$S->credito_id = $CredSel['id'];
				$S->usuario_id = $usuario_id;
				$S->tipo = 'CREDITO';
				$S->num_pago = $A['Num_Pago'];
				$S->fecha = $A['Fecha'];
				$S->capital = $A['Capital'];
				$S->interes = $A['Interes'];
				$S->total = $A['Total'];
				$S->deuda = $A['Deuda'];

				$S->save();
			}
		}

		return $Recibo->id;
	}

	public function deleteRecibo($recibo_id)
	{
		Recibo::where('id', $recibo_id)->delete();
		Abono::where('recibo_id', $recibo_id)->delete();
	}

	public function postDelete(){
		$I = request()->all();
		$Cred = Credito::where('id', $I['id'])->first();
		$Cred->delete();

		//Borrar los recibos
		$Recibo = Recibo::where('credito_id', $I['id'])->first();
		$this->deleteRecibo($Recibo->id);
	}

	public function postDeleteRecibo(){
		$I = request()->all();
		$this->deleteRecibo($I['id']);
	}


	//Resultados
	public function postRepResultados(Reps $Reps)
	{
		$f = request()->input('f');
		$DateIni = Carbon::parse($f['DateIni']);
		$DateFin = Carbon::parse($f['DateFin']);
		$Sede = Auth::user()->sede_sel_id;
		$R = [
			'Titulo' => 'Resultados',
			'Subtitulo' => '',
			'Template' => '/Frag/Estadisticas.Sections.Data_Remark',
		];
		$Creds = Credito::sede($Sede);
		$NoCreditos = $Creds->entre( $f['DateIni'], $f['DateFin'] )->count();
		$ValCreditos = $Creds->entre( $f['DateIni'], $f['DateFin'] )->sum('Monto');

		$R['data'] = [
			[ 'key' => 	'Creditos',  'color' => '#3B9E9F', 'value' => number_format($NoCreditos, 0) ],
			[ 'key' => 	'Asignados', 'color' => '#0BA002', 'value' => "$".number_format($ValCreditos, 0) ],
		];

		return $R;
	}


	//Cred No por mes
	public function postRepCredNMes(Reps $Reps)
	{
		$f = request()->input('f');
		$DateIni = Carbon::parse($f['DateIni']);
		$DateFin = Carbon::parse($f['DateFin']);
		$Sede = Auth::user()->sede_sel_id;
		$R = [
			'Titulo' => 'No de Creditos por mes',
			'Subtitulo' => $DateIni->format('d/m/Y').' a '.$DateFin->format('d/m/Y'),
			'Template' => '/Frag/Estadisticas.Sections.Chart_Col',
			'chart' => [ 'xAxisFormat' => null, 'yAxisFormat' => 'Number', 'margin' => ['top' => 0, 'right' => 40, 'bottom' => 30, 'left' => 40 ], 'height' => 300,  ]
		];

		//$DiasEntre = $Reps->generateDateRangeArr($DateIni, $DateFin, 'd/m/Y', 0);

		$NoCredMes = Credito::sede($Sede)->entre( $f['DateIni'], $f['DateFin'] )->orderBy('created_at')->get()->groupBy('periodo')->transform(function($Dia){
			return $Dia->count();
		});
		$NoCredMes = $Reps->keyValueToArr($NoCredMes->toArray());

		$R['data'] = [
			[ 'key' => 	'Creditos', 'color' => '#3B9E9F', 'values' => $NoCredMes ],
		];

		return $R;
	}


	//Cred Val por mes
	public function postRepCredVMes(Reps $Reps)
	{
		$f = request()->input('f');
		$DateIni = Carbon::parse($f['DateIni']);
		$DateFin = Carbon::parse($f['DateFin']);
		$Sede = Auth::user()->sede_sel_id;
		$R = [
			'Titulo' => 'Asignación por mes',
			'Subtitulo' => $DateIni->format('d/m/Y').' a '.$DateFin->format('d/m/Y'),
			'Template' => '/Frag/Estadisticas.Sections.Chart_Col',
			'chart' => [ 'xAxisFormat' => null, 'yAxisFormat' => 'Money', 'margin' => ['top' => 0, 'right' => 40, 'bottom' => 30, 'left' => 80 ], 'height' => 300, ],
		];

		//$DiasEntre = $Reps->generateDateRangeArr($DateIni, $DateFin, 'd/m/Y', 0);

		$ValCredMes = Credito::sede($Sede)->entre( $f['DateIni'], $f['DateFin'] )->orderBy('created_at')->get()->groupBy('periodo')->transform(function($Dia){
			return $Dia->sum('Monto');
		});
		$ValCredMes = $Reps->keyValueToArr($ValCredMes->toArray());

		$R['data'] = [
			[ 'key' => 	'Asignación', 'color' => '#0BA002', 'values' => $ValCredMes ],
		];

		return $R;
	}


	//Creditos por linea
	public function postRepLinea(Reps $Reps, $Mode)
	{
		$f = request()->input('f');
		$DateIni = Carbon::parse($f['DateIni']);
		$DateFin = Carbon::parse($f['DateFin']);
		$Sede = Auth::user()->sede_sel_id;
		$R = [
			'Titulo' => '',
			'Subtitulo' => $DateIni->format('d/m/Y').' a '.$DateFin->format('d/m/Y'),
			'Template' => '/Frag/Estadisticas.Sections.Chart_Bar',
			'chart' => [ 'xAxisFormat' => null ],
		];

		if($Mode == 'n'){ 
			$R['Titulo'] = 'No de Creditos por línea';
			$R['chart']['yAxisFormat'] = 'Number';
			$R['chart']['margin'] = ['top' => 0, 'right' => 30, 'bottom' => 30, 'left' => 130 ];
			$key = 'Creditos';
			$color = '#3B9E9F';
		}else if($Mode == 'v'){
			$R['Titulo'] = 'Asignación por línea';
			$R['chart']['yAxisFormat'] = 'Money';
			$R['chart']['margin'] = ['top' => 0, 'right' => 30, 'bottom' => 30, 'left' => 130 ];
			$key = 'Asignación';
			$color = '#0BA002';
		}

		$CredLinea = Credito::sede($Sede)->entre( $f['DateIni'], $f['DateFin'] )->get()->groupBy('Linea')->transform(function($E) use ($Mode){
			if($Mode == 'n'){ return $E->count(); }else if($Mode == 'v'){ return $E->sum('Monto'); }
		})->toArray();
		arsort($CredLinea);
		$CredLinea = $Reps->keyValueToArr($CredLinea);

		$R['data'] = [
			[ 'key' => $key, 'color' => $color, 'values' => $CredLinea ],
		];

		return $R;
	}


	//Creditos por estado
	public function postRepEstado(Reps $Reps, $Mode)
	{
		$f = request()->input('f');
		$DateIni = Carbon::parse($f['DateIni']);
		$DateFin = Carbon::parse($f['DateFin']);
		$Sede = Auth::user()->sede_sel_id;
		$R = [
			'Titulo' => '',
			'Subtitulo' => $DateIni->format('d/m/Y').' a '.$DateFin->format('d/m/Y'),
			'Template' => '/Frag/Estadisticas.Sections.Chart_Pie',
			'chart' => [ 'xAxisFormat' => null ],
		];

		if($Mode == 'n'){ 
			$R['Titulo'] = 'No de Creditos por estado';
			$R['chart']['yAxisFormat'] = 'Number';
		}else if($Mode == 'v'){
			$R['Titulo'] = 'Asignación por estado';
			$R['chart']['yAxisFormat'] = 'Money';
		}

		$R['data'] = Credito::sede($Sede)->entre( $f['DateIni'], $f['DateFin'] )->orderBy('Estado')->get()->groupBy('Estado')->transform(function($E) use ($Mode){
			if($Mode == 'n'){ 
				return [ 'key' => $E->first()->Estado, 'color' => $E->first()->Estado_color, 'value' => $E->count() ];
			}else if($Mode == 'v'){
				return [ 'key' => $E->first()->Estado, 'color' => $E->first()->Estado_color, 'value' => $E->sum('Monto') ];
			}
		})->values()->toArray();

		return $R;
	}

	//Detalle de Creditos
	public function postRepDetCreditos()
	{
		$f = [ 'DateIni' => '1900-01-01', 'DateFin' => '2900-01-01', 'Incluir' => 'Activos', 'Asociado_id' => null, 'Credito_id' => null, 'orderBy' => 'Estado', 'orderSort' => 'ASC' ];
		$f = array_merge($f, request()->input('f'));
		$DateIni = Carbon::parse($f['DateIni']);
		$DateFin = Carbon::parse($f['DateFin']);
		$R = [
			'Titulo' => 'Creditos',
			'Subtitulo' => $DateIni->format('d/m/Y').' a '.$DateFin->format('d/m/Y'),
			'Template' => '/Frag/Estadisticas.Sections.Table_WithSubtables',
		];

		$Headers = [
			'id' => 'Id',
			'Estado' => 'Estado',
			'Linea' => 'Línea',
			'Monto' => 'Monto',
			'Interes' => 'Interés (E.A.)',
			'Pagos' => 'Pagos',
			'Periodos' => 'Periodos',
			'Periodos_Gracia' => 'Periodos de Gracia',
			'Cuota' => 'Cuota',
			'Saldo' => 'Saldo',
			'ProximoPago' => 'Proximo Pago',
			'solicitado' => 'Fecha Solicitud',
			'Documento' => 'Documento',
			'Asociado' => 'Asociado',
			'Email' => 'Email',
			'Telefono' => 'Teléfono'
		];

		$Eliminated = ($f['Incluir'] == 'Eliminados');

		$Creds = Credito::eliminated($Eliminated)->ofAsoc($f['Asociado_id'])->byId($f['Credito_id'])
				 ->entre( $f['DateIni'], $f['DateFin'] )->orderBy($f['orderBy'], $f['orderSort'])
				 ->get()->transform(function($Row){
			//return $Row;
			$o = [ 'color' => $Row->Estado_color ];
			//dd($RowOpts);
			$r = [];
			$r['id'] = $Row->id;
			$r['Estado'] = $Row->estado;
			$r['Linea'] = $Row->linea;
			$r['Monto'] = $Row->monto;
			$r['Interes'] = $Row->interes."%";
			$r['Pagos'] = $Row->pagos;
			$r['Periodos'] = $Row->periodos;
			$r['Periodos_Gracia'] = $Row->periodos_gracia;
			$r['Cuota'] = $Row->cuota;
			$r['Saldo'] = $Row->saldo;
			$r['ProximoPago'] = $Row->proximo_pago;
			$r['solicitado'] = $Row->solicitado;
			$r['Documento'] = $Row->asociado->documento;
			$r['Asociado'] = $Row->asociado->nombre;
			$r['Email'] = $Row->asociado->correo;
			$r['Telefono'] = $Row->asociado->celular;

			return [ 'opts' => $o, 'data' => $r ];
			
		});

		$Creditos = $Creds->pluck('data')->toArray();
		$RowOpts = $Creds->pluck('opts')->toArray();

		$Buttons = [
			[ 'Class' => 'md-icon-button', 'Name' => 'Cuotas', 'Icon' => 'fa-list-ol', 'Action' => 'Rep', 'Url' => '/api/Credito/Creditos/rep-det-cuotas' ],
			[ 'Class' => 'md-icon-button', 'Name' => 'Recibos',  'Icon' => 'fa-money',  'Action' => 'Rep', 'Url' => '/api/Credito/Creditos/rep-det-recibos' ],
			[ 'Class' => 'md-icon-button', 'Name' => 'Pagos',  'Icon' => 'fa-usd',  'Action' => 'Rep', 'Url' => '/api/Credito/Creditos/rep-det-pagos' ],
		];

		$R['data'] = [ 'Headers' => $Headers, 'Rows' => $Creditos, 'RowOpts' => $RowOpts, 'Buttons' => $Buttons, 'Filename' => 'Creditos', 'Ext' => 'xls' ];

		return $R;
	}

	//Detalle de Cuotas
	public function postRepDetCuotas(Reps $Reps)
	{
		$f = request()->input('f');
		$Cred = Credito::where('id', $f['selectedRow']['id'])->first();
		$Cred->CalcSaldos();
		$Sal = $Cred->saldos->transform(function($Row){
			$Row->CalcMora();
            $Row->CalcEstado();
			//return $Row;
            $o = [ 'color' => $Row->estado_color ];

			$r = [];
			$r['.'] = null;
			$r['estado'] = $Row->estado;
			$r['Num_Pago'] = $Row->Num_Pago;
			$r['date'] = $Row->date;
			$r['Capital'] = "$".number_format($Row->Capital,0);
			$r['Interes'] = "$".number_format($Row->Interes,0);
			$r['Total'] = "$".number_format($Row->Total,0);
			$r['Deuda'] = "$".number_format($Row->Deuda,0);
			$r['pendiente'] = "$".number_format($Row->pendiente,0);
			$r['mora'] = "$".number_format($Row->mora,0);
			$r['dias_mora'] = $Row->dias_mora;
			
			return [ 'opts' => $o, 'data' => $r ];

		});

		$Saldos  = $Sal->pluck('data')->toArray();
		$RowOpts = $Sal->pluck('opts')->toArray();

		$Headers = [			
			'.' => '',
			'estado' => 'Estado',
			'Num_Pago' => 'No.',
			'date' => 'Fecha',
			'Capital' => 'Capital',
			'Interes' => 'Interés',
			'Total' => 'Total',
			'Deuda' => 'Deuda',
			'pendiente' => 'Pendiente',
			'mora' => 'Mora',
			'dias_mora' => 'Días Mora',
		];

		$R = [
			'Titulo' => 'Cuotas de crédito Cod. '.$Cred->id,
			'Subtitulo' => '',
			'Template' => '/Frag/Estadisticas.Sections.Table_Basic',
			'data' => [ 'Headers' => $Headers, 'Rows' => $Saldos, 'RowOpts' => $RowOpts, 'Filename' => 'Cuotas del crédito Cod. '.$Cred->id, 'Ext' => 'xls' ],
		];
		return $R;
	}

	//Detalle de Recibos
	public function postRepDetRecibos(Reps $Reps)
	{
		$f = request()->input('f');
		$Cred = Credito::where('id', $f['selectedRow']['id'])->first();
		$Cred->CalcSaldos();
		//return $Cred->recibos;
		$Recibos = [];

		foreach ($Cred->recibos as $Recibo) {
			$r = [];
			$r['.'] = null;
			$r['id'] = $Recibo->id;
			$r['fecha'] = $Recibo->fecha;
			$r['Medio'] = $Recibo->Medio;
			$r['NoConsignacion'] = $Recibo->NoConsignacion;
			$r['Recibo_Valor'] = "$".number_format($Recibo->Valor, 0);
			$r['Valor_Recibido'] = "$".number_format($Recibo->Valor_Recibido, 0);
			$r['Valor_Devuelto'] = "$".number_format($Recibo->Valor_Devuelto, 0);
			$r['Cajero'] = $Recibo->user->Nombres .' '. $Recibo->user->Apellidos;
			$Recibos[] = $r;
		};

		$Headers = [
			'.' => '',
			'id' => 'Id Recibo',
			'fecha' => 'Fecha Recibo',
			'Medio' => 'Medio',
			'NoConsignacion' => 'No Consignación',
			'Recibo_Valor' => 'Total Pagado',
			'Valor_Recibido' => 'Recibido',
			'Valor_Devuelto' => 'Devuelto',
			'Cajero' => 'Cajero',
		];

		$R = [
			'Titulo' => 'Pagos de crédito Cod. '.$Cred->id,
			'Subtitulo' => '',
			'Template' => '/Frag/Estadisticas.Sections.Table_Basic',
			'data' => [ 'Headers' => $Headers, 'Rows' => $Recibos, 'RowOpts' => [], 'Filename' => 'Recibos del crédito Cod. '.$Cred->id, 'Ext' => 'xls' ],
		];
		return $R;
	}

	//Detalle de Pagos
	public function postRepDetPagos(Reps $Reps)
	{
		$f = request()->input('f');
		$Cred = Credito::where('id', $f['selectedRow']['id'])->first();
		$Cred->CalcSaldos();
		//return $Cred->recibos;
		$Pagos = [];
		$RowOpts = [];

		foreach ($Cred->recibos as $Recibo) {
			foreach ($Recibo->abonos as $Abono) {
				$r = [];
				$o = [ 'background' => $Abono->color ];
				$r['.'] = null;
				$r['id'] = $Recibo->id;
				$r['fecha'] = $Recibo->fecha;
				$r['Medio'] = $Recibo->Medio;
				$r['NoConsignacion'] = $Recibo->NoConsignacion;
				$r['Recibo_Valor'] = "$".number_format($Recibo->Valor, 0);
				$r['Valor_Recibido'] = "$".number_format($Recibo->Valor_Recibido, 0);
				$r['Valor_Devuelto'] = "$".number_format($Recibo->Valor_Devuelto, 0);
				$r['Cajero'] = $Recibo->user->Nombres .' '. $Recibo->user->Apellidos;
				$r['..'] = null;
				$r['id_pago'] = $Abono->id;
				$r['saldo_Num_Pago'] = $Abono->saldo->Num_Pago;
				$r['saldo_Fecha'] = $Abono->saldo->Fecha;
				$r['saldo_Valor'] = "$".number_format($Abono->saldo->Total, 0);
				$r['Paga'] = $Abono->Paga;
				$r['Tipo'] = $Abono->Tipo;
				$r['Valor'] = "$".number_format($Abono->Valor, 0);

				$Pagos[] = $r;
				$RowOpts[] = $o;
			}
		};

		$Headers = [
			'.' => '',
			'id' => 'Id Recibo',
			'fecha' => 'Fecha Recibo',
			'Medio' => 'Medio',
			'NoConsignacion' => 'No Consignación',
			'Recibo_Valor' => 'Total Pagado',
			'Valor_Recibido' => 'Recibido',
			'Valor_Devuelto' => 'Devuelto',
			'Cajero' => 'Cajero',
			'..' => '',
			'id_pago' => 'Id Pago',
			'saldo_Num_Pago' => 'No. Cuota',
			'saldo_Fecha' => 'Fecha Cuota',
			'saldo_Valor' => 'Valor Cuota',
			'Paga' => 'Paga',
			'Tipo' => 'Tipo',
			'Valor' => 'Valor Pagado',
		];

		$R = [
			'Titulo' => 'Pagos de crédito Cod. '.$Cred->id,
			'Subtitulo' => '',
			'Template' => '/Frag/Estadisticas.Sections.Table_Basic',
			'data' => [ 'Headers' => $Headers, 'Rows' => $Pagos, 'RowOpts' => $RowOpts, 'Filename' => 'Pagos del crédito Cod. '.$Cred->id, 'Ext' => 'xls' ],
		];
		return $R;
	}

	//Cred Ingresos por mes
	public function postRepIng(Reps $Reps, $Period)
	{
		$f = request()->input('f');
		$DateIni = Carbon::parse($f['DateIni']);
		$DateFin = Carbon::parse($f['DateFin']);
		$Sede = Auth::user()->sede_sel_id;
		$R = [
			'Titulo' => 'Ingresos por '.$Period,
			'Subtitulo' => $DateIni->format('d/m/Y').' a '.$DateFin->format('d/m/Y'),
			'Template' => '/Frag/Estadisticas.Sections.Chart_Col',
			'chart' => [ 'xAxisFormat' => null, 'yAxisFormat' => 'Money', 'margin' => ['top' => 0, 'right' => 40, 'bottom' => 30, 'left' => 80 ],  ],
		];

		//$DiasEntre = $Reps->generateDateRangeArr($DateIni, $DateFin, 'd/m/Y', 0);
		if($Period == 'mes'){
			$Per = 'periodo';
		}else{
			$DiasEntre = $Reps->generateDateRangeArr($DateIni, $DateFin, 'Y-m-d', 0);
			$Per = 'dia';
		}

		$Values = Credito::with('recibos')->sede($Sede)->entre( $f['DateIni'], $f['DateFin'] )->orderBy('created_at')->get()->groupBy($Per)->transform(function($Dia){
			$Ing = 0;
			foreach ($Dia as $Cred) {
				$Ing += $Cred->recibos->sum('Valor');
			}
			return $Ing;
		});
		if($Period == 'mes'){
			$Values = $Reps->keyValueToArr($Values->toArray());
		}else{
			$Values = $Reps->keyValueToArr(array_merge($DiasEntre, $Values->toArray()));
		}
		

		$R['data'] = [
			[ 'key' => 	'Ingresos', 'color' => '#4CAF50', 'values' => $Values ],
		];

		return $R;
	}

	//Cred Ingresos por tipo pago
	public function postRepIngTipopago(Reps $Reps)
	{
		$f = request()->input('f');
		$DateIni = Carbon::parse($f['DateIni']);
		$DateFin = Carbon::parse($f['DateFin']);
		$Sede = Auth::user()->sede_sel_id;
		$R = [
			'Titulo' => 'Ingresos por tipo',
			'Subtitulo' => '',
			'Template' => '/Frag/Estadisticas.Sections.Chart_Pie',
			'chart' => [ 'xAxisFormat' => null, 'yAxisFormat' => 'Money' ],
		];

		//$DiasEntre = $Reps->generateDateRangeArr($DateIni, $DateFin, 'd/m/Y', 0);

		$Values = Credito::with('recibos')->sede($Sede)->entre( $f['DateIni'], $f['DateFin'] )->get()->transform(function($Cred){
			$TiposPago = [
				'Cuota Total' => 0,
				'Cuota Parcial' => 0,
				'Mora Total' => 0,
				'Mora Parcial' => 0,
				'Capital Parcial' => 0,
				'Capital Total' => 0,
			];
			foreach ($Cred->recibos as $Recibo) {
				$Recibo->getAbonos();
				foreach ($Recibo->abonos as $Abono) {
					$TiposPago[$Abono->Paga.' '.$Abono->Tipo] += $Abono->Valor;
				}
			}
			return $TiposPago;
		});
		//dd($Values);

		$R['data'] = [
			[ 'key' => 	'Cuota Total',      'color' => '#8ecead',    'value' => $Values->sum('Cuota Total')   ],
			[ 'key' => 	'Cuota Parcial',    'color' => '#d8f1e4',    'value' => $Values->sum('Cuota Parcial') ],
			[ 'key' => 	'Mora Total',       'color' => '#f9ebed',    'value' => $Values->sum('Mora Total')    ],
			[ 'key' => 	'Mora Parcial',     'color' => '#ead3d7',    'value' => $Values->sum('Mora Parcial')  ],
			[ 'key' => 	'Capital Total',    'color' => '#acdaf1',    'value' => $Values->sum('Capital Total')  ],
			[ 'key' => 	'Capital Parcial',  'color' => '#cfe7f3',    'value' => $Values->sum('Capital Parcial')  ],
		];

		return $R;
	}

	//Proyección de ingresos por día
	public function postRepProyDia(Reps $Reps)
	{
		$f = request()->input('f');
		$DateIni = Carbon::today();
		$DateFin = Carbon::today()->addDays(intval($f['Dias']));
		$Sede = Auth::user()->sede_sel_id;
		$R = [
			'Titulo' => 'Ingresos proyectados por día',
			'Subtitulo' => $DateIni->format('d/m/Y').' a '.$DateFin->format('d/m/Y'),
			'Template' => '/Frag/Estadisticas.Sections.Chart_Col',
			'chart' => [ 'xAxisFormat' => null, 'yAxisFormat' => 'Money', 'height' => 250,  ]
		];

		$DiasEntre = $Reps->generateDateRangeArr($DateIni, $DateFin, 'Y-m-d', 0);

		$Rows = Credito::with('saldos')->sede($Sede)->whereBetween('ProximoPago', [$DateIni, $DateFin])->get()->transform(function($Cred) use ($DateIni, $DateFin){
			return $Cred->saldos->filter(function($Saldo) use ($DateIni, $DateFin){
				return $Saldo->Fecha->between($DateIni, $DateFin);
			});
		})->collapse()->sortBy('date')->groupBy('date')->transform(function($Dia)
			{
				return $Dia->sum('pendiente');
			});

		$Values = $Reps->keyValueToArr(array_merge($DiasEntre, $Rows->toArray()));

		$R['data'] = [
			[ 'key' => 	'Ingresos proyectados', 'color' => '#6DAF25', 'values' => $Values ],
		];

		return $R;
	}

	//Proyección de ingresos detallado
	public function postRepProyCreditos(Reps $Reps)
	{
		$f = request()->input('f');
		$DateIni = Carbon::today();
		$DateFin = Carbon::today()->addDays(intval($f['Dias']));
		$Sede = Auth::user()->sede_sel_id;
		$R = [
			'Titulo' => "Creditos con pago dentro de los próximos {$f['Dias']} días",
			'Subtitulo' => '',
			'Template' => '/Frag/Estadisticas.Sections.Table_WithSubtables',
		];

		$Headers = [
			'id' => 'Id',
			'ProximoPago' => 'Proximo Pago',
			'Documento' => 'Documento',
			'Asociado' => 'Asociado',
			'Email' => 'Email',
			'Telefono' => 'Teléfono',
			'Field_1' => 'Finca',
			'Field_2' => 'Vereda',
			'Field_3' => 'Distrito o Corregimiento',
			'Field_4' => 'Municipio',
			'Estado' => 'Estado',
			'Cuota' => 'Cuota',
			'Linea' => 'Línea',
			'Monto' => 'Monto',
			'Interes' => 'Interés (E.A.)',
			'Pagos' => 'Pagos',
			'Periodos' => 'Periodos',
			'Periodos_Gracia' => 'Periodos de Gracia',
			'Saldo' => 'Saldo',
			'solicitado' => 'Fecha Solicitud',
		];

		$Rows = Credito::sede($Sede)->whereBetween('ProximoPago', [$DateIni, $DateFin])->orderBy('ProximoPago')->get()->transform(function($Row){
			$o = [ 'color' => $Row->Estado_color ];
			//dd($RowOpts);
			$r = [];
			$r['id'] = $Row->id;
			$r['ProximoPago'] = $Row->ProximoPago;
			$r['Documento'] = $Row->asociado->Documento;
			$r['Asociado'] = $Row->asociado->Nombres . ' ' . $Row->asociado->Apellidos;
			$r['Email'] = $Row->asociado->Email;
			$r['Telefono'] = $Row->asociado->Telefono;
			$r['Field_1'] = $Row->asociado->Field_1;
			$r['Field_2'] = $Row->asociado->Field_2;
			$r['Field_3'] = $Row->asociado->Field_3;
			$r['Field_4'] = $Row->asociado->Field_4;
			$r['Estado'] = $Row->Estado;
			$r['Cuota'] = "$".number_format($Row->Cuota,0);
			$r['Linea'] = $Row->Linea;
			$r['Monto'] = "$".number_format($Row->Monto,0);
			$r['Interes'] = $Row->Interes."%";
			$r['Pagos'] = $Row->Pagos;
			$r['Periodos'] = $Row->Periodos;
			$r['Periodos_Gracia'] = $Row->Periodos_Gracia;
			$r['Saldo'] = "$".number_format($Row->Saldo,0);
			$r['solicitado'] = $Row->solicitado;

			return [ 'opts' => $o, 'data' => $r ];
			
		});

		$Creditos = $Rows->pluck('data')->toArray();
		$RowOpts =  $Rows->pluck('opts')->toArray();

		$Buttons = [
			[ 'Class' => 'md-icon-button', 'Name' => 'Cuotas', 'Icon' => 'fa-list-ol', 'Action' => 'Rep', 'Url' => '/api/Credito/Creditos/rep-det-cuotas' ],
			[ 'Class' => 'md-icon-button', 'Name' => 'Recibos',  'Icon' => 'fa-money',  'Action' => 'Rep', 'Url' => '/api/Credito/Creditos/rep-det-recibos' ],
			[ 'Class' => 'md-icon-button', 'Name' => 'Pagos',  'Icon' => 'fa-usd',  'Action' => 'Rep', 'Url' => '/api/Credito/Creditos/rep-det-pagos' ],
		];

		$R['data'] = [ 'Headers' => $Headers, 'Rows' => $Creditos, 'RowOpts' => $RowOpts, 'Buttons' => $Buttons, 'Filename' => 'Creditos_'.$Sede, 'Ext' => 'xls' ];

		return $R;
	}

	//Creditos en mora
	public function postRepMora(Reps $Reps)
	{
		$f = request()->input('f');
		$Sede = Auth::user()->sede_sel_id;
		$R = [
			'Titulo' => "Creditos que presentan mora",
			'Subtitulo' => '',
			'Template' => '/Frag/Estadisticas.Sections.Table_WithSubtables',
		];

		$Headers = [
			'id' => 'Id',
			'ProximoPago' => 'Proximo Pago',
			'Documento' => 'Documento',
			'Asociado' => 'Asociado',
			'Email' => 'Email',
			'Telefono' => 'Teléfono',
			'Field_1' => 'Finca',
			'Field_2' => 'Vereda',
			'Field_3' => 'Distrito o Corregimiento',
			'Field_4' => 'Municipio',
			'Estado' => 'Estado',
			'Cuota' => 'Cuota',
			'Linea' => 'Línea',
			'Monto' => 'Monto',
			'Interes' => 'Interés (E.A.)',
			'Pagos' => 'Pagos',
			'Periodos' => 'Periodos',
			'Periodos_Gracia' => 'Periodos de Gracia',
			'Saldo' => 'Saldo',
			'solicitado' => 'Fecha Solicitud',
		];

		$Rows = Credito::sede($Sede)->where('Estado', 'En Mora')->orderBy('ProximoPago')->get()->transform(function($Row){
			$o = [ 'color' => $Row->Estado_color ];
			$r = [];
			$r['id'] = $Row->id;
			$r['ProximoPago'] = $Row->ProximoPago;
			$r['Documento'] = $Row->asociado->Documento;
			$r['Asociado'] = $Row->asociado->Nombres . ' ' . $Row->asociado->Apellidos;
			$r['Email'] = $Row->asociado->Email;
			$r['Telefono'] = $Row->asociado->Telefono;
			$r['Field_1'] = $Row->asociado->Field_1;
			$r['Field_2'] = $Row->asociado->Field_2;
			$r['Field_3'] = $Row->asociado->Field_3;
			$r['Field_4'] = $Row->asociado->Field_4;
			$r['Estado'] = $Row->Estado;
			$r['Cuota'] = "$".number_format($Row->Cuota,0);
			$r['Linea'] = $Row->Linea;
			$r['Monto'] = "$".number_format($Row->Monto,0);
			$r['Interes'] = $Row->Interes."%";
			$r['Pagos'] = $Row->Pagos;
			$r['Periodos'] = $Row->Periodos;
			$r['Periodos_Gracia'] = $Row->Periodos_Gracia;
			$r['Saldo'] = "$".number_format($Row->Saldo,0);
			$r['solicitado'] = $Row->solicitado;

			return [ 'opts' => $o, 'data' => $r ];
		});

		$Creditos = $Rows->pluck('data')->toArray();
		$RowOpts =  $Rows->pluck('opts')->toArray();

		$Buttons = [
			[ 'Class' => 'md-icon-button', 'Name' => 'Cuotas', 'Icon' => 'fa-list-ol', 'Action' => 'Rep', 'Url' => '/api/Credito/Creditos/rep-det-cuotas' ],
			[ 'Class' => 'md-icon-button', 'Name' => 'Recibos',  'Icon' => 'fa-money',  'Action' => 'Rep', 'Url' => '/api/Credito/Creditos/rep-det-recibos' ],
			[ 'Class' => 'md-icon-button', 'Name' => 'Pagos',  'Icon' => 'fa-usd',  'Action' => 'Rep', 'Url' => '/api/Credito/Creditos/rep-det-pagos' ],
		];

		$R['data'] = [ 'Headers' => $Headers, 'Rows' => $Creditos, 'RowOpts' => $RowOpts, 'Buttons' => $Buttons, 'Filename' => 'Creditos_'.$Sede, 'Ext' => 'xls' ];

		return $R;
	}
}
