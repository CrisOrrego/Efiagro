<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
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

        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
            ['finca_id',            'Finca',            'select',   true,   false,  null, 50, ['options' => $fincas] ],
            ['organizacion_id',     'Organización',     'select',   true,   false,  null, 50, ['options' => $organizaciones] ],
            ['linea_productiva_id', 'Linea Productiva', 'select',   true,   false,  null, 50, ['options' => $lineasproductivas] ],
            ['labores_id',          'Labores',         'select',    true,   false,  null, 50, ['options' => $labores] ], 
            ['hectareas',           'Hectareas',        null,       true,     false,  null,       100],
            ['sitios',              'Sitios',           null,       true,     false,  null,       100],
            ['coordenadas',         'Coordenadas',      null,       true,     false,  null,       100],
            
        ];

    }

    public function scopeFinca_id($q, $id)
    {
        return $q->where('finca_id', $id);
    }

    public function finca()
    {
        return $this->belongsTo('App\Models\Finca', 'finca_id');
    }
    public function organizacion()
    {
        return $this->belongsTo('App\Models\Organizacion', 'organizacion_id');
    }

    public function linea_productiva()
    {
        return $this->belongsTo('App\Models\LineaProductiva', 'linea_productiva_id');
    }
    
    public function labor()
    {
        return $this->belongsTo('App\Models\Labor', 'labores_id');
    }

    public function tareas()
    {
        return $this->hasMany('App\Models\TareasLote', 'lote_id');
    }
}

