<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CreditoSaldo extends Model
{
    use HasFactory;

    protected $table = 'credito__saldos';
    protected $guarded = [];
    protected $appends = [
        'date', 
        'due', 
        'abonos', 
        'abonado', 
        'abonadomora',
        'pendiente',
    ];
    protected $dates = ['created_at', 'updated_at', 'fecha'];

    public function columns()
    {
        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
			[ 'credito_id', 	null, true, false, null, 100 ],
			[ 'activo', 		null, true, false, null, 100 ],
			[ 'tipo', 			null, true, false, null, 100 ],
			[ 'num_pago', 		null, true, false, null, 100 ],
			[ 'fecha', 			null, true, false, null, 100 ],
			[ 'capital', 		null, true, false, null, 100 ],
			[ 'interes', 		null, true, false, null, 100 ],
			[ 'total', 			null, true, false, null, 100 ],
			[ 'deuda', 			null, true, false, null, 100 ],
        ];
    }

    public function getDateAttribute()
    {
        return $this->fecha->format('Y-m-d');
    }

	public function getDueAttribute()
	{
		return $this->fecha->lt(Carbon::now());
	}

    public function getAbonosAttribute()
    {
        return $this->hasMany('App\Models\CreditoAbono', 'saldo_id', 'id')->get();
    }

    public function getAbonadoAttribute()
    {
        return $this->abonos->sum(function ($Abono) {
            return ( $Abono['paga'] == 'Cuota' ) ? $Abono['valor'] : 0;
        });
    }

    public function getAbonadomoraAttribute()
    {
        return $this->abonos->sum(function ($Abono) {
            return ( $Abono['paga'] == 'Mora' ) ? $Abono['valor'] : 0;
        });
    }

    public function CalcMora()
    {
        $this->mora = 0;
        if(!$this->due OR $this->pendiente == 0){ return false; }

        
        
        $this->dias_mora = $Dias = $this->fecha->diffInDays(Carbon::today());
        /*
        $Vars = new Vars();
        $Var = $Vars->get(['Credito']);
        $Interes;

             if($Dias <= 30)                { $Interes = $Var['INTERES_MORA_MENOS_30D']; }
        else if($Dias >= 31 && $Dias <=  60){ $Interes = $Var['INTERES_MORA_31D_60D'];   }
        else if($Dias >= 61 && $Dias <=  90){ $Interes = $Var['INTERES_MORA_61D_90D'];   }
        else if($Dias >= 91 && $Dias <= 120){ $Interes = $Var['INTERES_MORA_91D_120D'];  }
                       else if($Dias >= 121){ $Interes = $Var['INTERES_MORA_MAS_120D'];  }
        */
        $Interes = 0;

        $ValMora = CEIL($this->pendiente * $Interes);  

        $this->mora = $ValMora - $this->abonadomora;
        if($this->mora < 0){ $this->mora = 0; }
    }

    public function getPendienteAttribute()
    {
        return $this->total - $this->abonado;
    }

    public function CalcEstado()
    {
        $Estado = 'Pendiente';

        if($this->pendiente == 0){
            $Estado = 'Pagado';
        }else{
            if($this->due){ //si ya debió haber pagado
                $Estado = 'Mora';
            }

            if($this->abonado > 0){
                $Estado .= ' Pago Parcial';
            }
        }

        $this->estado = trim($Estado);

        //Agregar colores
        $Colors = [
            'Pendiente' => '#a2a2a2',
            'Pendiente Pago Parcial' => '#008E7D',
            'Pagado'    => '#00695c',
            'Mora'      => '#ce0202',
            'Mora Pago Parcial' => '#D32F2F',
        ];

        $this->estado_color = $Colors[$this->estado];

    }

}