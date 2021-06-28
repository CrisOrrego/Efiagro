<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credito extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'credito__creditos';
    protected $guarded = [];
    protected $appends = [];

    public function columns()
    {
        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
			[ 'organizacion_id', 	null, true, false, null, 100 ],
			[ 'afiliado_id', 		null, true, false, null, 100 ],
			[ 'estado', 			null, true, false, null, 100 ],
			[ 'linea', 				null, true, false, null, 100 ],
			[ 'monto', 				null, true, false, null, 100 ],
			[ 'interes', 			null, true, false, null, 100 ],
			[ 'pagos', 				null, true, false, null, 100 ],
			[ 'periodos', 			null, true, false, null, 100 ],
			[ 'periodos_gracia', 	null, true, false, null, 100 ],
			[ 'cuota', 				null, true, false, null, 100 ],
			[ 'saldo', 				null, true, false, null, 100 ],
			[ 'proximo_pago', 		null, true, false, null, 100 ],
			[ 'usuario_id', 		null, true, false, null, 100 ],
        ];
    }

	public function scopeSede($query, $Sede)
    {
        return $query->where('sede_id', $Sede);
    }

    public function scopeEntre($query, $DIni, $DFin)
    {
        $DIni = Carbon::parse($DIni);
        $DFin = Carbon::parse($DFin)->addDay();
        return $query->where('created_at', '>=', $DIni )->where('created_at', '<=', $DFin );
    }

    public function scopeEliminated($query, $B)
    {
        return $B ? $query->onlyTrashed() : $query;
    }

    public function scopeOfAsoc($query, $id)
    {
        return is_null($id) ? $query : $query->where('asociado_id', $id);
    }

    public function scopeById($query, $id)
    {
        return is_null($id) ? $query : $query->where('id', $id);
    }

    public function getSolicitadoAttribute()
    {
        return $this->created_at->format('Y-m-d h:ia');
    }

    public function getDiaAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }

    public function getPeriodoAttribute()
    {
        return $this->created_at->format('Y-m');
    }

    public function getCommentsAttribute()
    {
        return $this->hasMany('App\Models\Core\Comment', 'Entity_id', 'id')
        ->where('Entity', 'Credito.Credito')
        ->orderBy('created_at', 'DESC')->get();
    }

    public function getAsociadoAttribute()
    {
        return $this->hasOne('App\Models\Core\User', 'id', 'asociado_id')->first();
    }

    public function recibos()
    {
        return $this->hasMany('App\Models\CreditoRecibo', 'credito_id', 'id')->orderBy('created_at', 'DESC');
    }

    public function saldos()
    {
        return $this->hasMany('App\Models\CreditoSaldo',  'credito_id', 'id')->orderBy('Num_Pago', 'ASC');
    }

    public function CalcSaldos()
    {
        $Total_Pendiente = 0;

        //Calcular la mora
        foreach ($this->recibos as $Recibo) {
            $Recibo->getAbonos();
        }

        //Calcular la mora
        foreach ($this->saldos as $Saldo) {
            $Saldo->CalcMora();
            $Saldo->CalcEstado();

            if($Saldo->due){
                $Total_Pendiente += $Saldo->mora;
                $Total_Pendiente += $Saldo->pendiente;
            }
        }
        
        $this->total_pendiente = $Total_Pendiente;
    }

    public function CalcEstado()
    {
        $Estado = 'Normal';
        $ProximoPago  = null;
        $ProximoNum   = null;

        //Calcular estado
        foreach ($this->saldos as $k => $v) {
            if( substr($v['estado'], 0, 4) == 'Mora' ){
                $Estado = 'En Mora';
                break;
            }
        }

        $currState = '';
        //Calcular prox pago
        foreach ($this->saldos as $k => $v) {

            if($v['estado'] == 'Pendiente' AND $v['estado'] == $currState){
                break;
            }else{
                $ProximoPago = $v->Fecha;
                $ProximoNum  = $v->Num_Pago;
            }

            if( !in_array($v['estado'], ['Pendiente','Pagado']) ){
                break;
            }

            $currState = $v['estado'];
        }

        if($this->Saldo == 0) $Estado = "Terminado";

        $this->Estado      = $Estado;
        $this->ProximoPago = is_null($ProximoPago) ? null : $ProximoPago->toDateString();
        $this->ProximoNum  = $ProximoNum;

        

        //Agregar colores
        $Colors = [
            'Normal'  => '#00695c',
            'En Mora' => '#ce0202',
            'Terminado'  => '#979797',
        ];

        $this->Estado_color = $Colors[$Estado];
    }

}