<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FincaEvento extends Model
{
    use HasFactory;
    protected $table = 'finca_eventos';
    protected $guarded = ['id'];
    protected $appends = [];
    
    public function columns()
    {
    
        $fincas = \App\Models\Finca::all()->keyBy('id')->map( function($f){
            return $f['nombre'];
        })->toArray();
        $eventos = \App\Models\Evento::all()->keyBy('id')->map( function($e){
            return $e['evento'];
        })->toArray();

        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
           
            ['finca_id',            'Finca',                'select',   true,   false,  null, 50, ['options' => $fincas] ],
            ['evento_id',           'evento_id',            'select',   true,   false,  null, 50, ['options' => $eventos] ],
            ['fecha',               'fecha',                null,       true,     false,  null,       100],
            ['gravedad',            'gravedad',             null,       true,     false,  null,       100],   
        ];

    }
    public function finca()
    {
        return $this->belongsTo('App\Models\Finca', 'finca_id');
    }
    public function evento()
    {
        return $this->belongsTo('App\Models\Evento', 'evento_id');
    }


   
}

