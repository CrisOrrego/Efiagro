<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cultivo extends Model
{
    use HasFactory;
    protected $table = 'cultivos';
    protected $guarded = ['id'];
    protected $appends = [];
    public function columns()
    {
        $zonas = \App\Models\Zona::all()->keyBy('id')->map(function($z){
            return $z['descripcion'];
        })->toArray();
        // // dd($zonas);

        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
            ['fechas',                      'Fechas',                  'date', false, false, null, 255],
            ['zona_id',                     'Zona',                   'select',   true,   false,  null, 50, ['options' => $zonas] ],
            ['produccion',                  'Produccion',              null, false, false, null, 255],
            ['produccion_estimada',          'Producion Estimada',      null, false, false, null, 100],
            ['eventos',                     'Eventos',                 null, false, false, null, 100],
            ['creditos_colocados',          'Creditos Colocados',      null, false, false, null, 100], 
            ['cartera_vencida',             'Cartera Vencida',         null, false, false, null, 100],     
        ];
    }

    public function scopeLazona($q, $zona_id){
        return $q->where('zona_id', $zona_id);
     }
     
    // public function linea_productiva()
    // {
    //     return $this->belongsTo('App\Models\LineaProductiva',  'linea_productiva_id');
    // }
    public function zona()
    {
        return $this->belongsTo('App\Models\Zona',  'zona_id');
    }
}