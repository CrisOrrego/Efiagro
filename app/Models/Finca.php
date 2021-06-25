<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finca extends Model
{
    use HasFactory;
    protected $table = 'fincas';
    protected $guarded = ['id'];
    protected $appends = [];

    public function columns()
    { $usuarios = \App\Models\Usuario::all()->keyBy('id')->map(function($u){
        return $u['nombres'];
    })->toArray();
        $zonas = \App\Models\Zona::all()->keyBy('id')->map(function($z){
            return $z['descripcion'];
        })->toArray();
        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
            ['usuario_id',                     'Usuario',                       'select',    false,  false, null, 100, [ 'options' => $usuarios] ],
            ['nombre',                         'Finca',                        null,       true,   false, null, 100],
            ['direccion',                      'Dirección',                     null,       false,  false, null, 100],
            ['departamento_id',                'Departamento:',                 'select',   true,   false, null, 100, [ 'options' => [] ]],
            ['municipio_id',                   'Municipio:',                    'select',   true,   false, null, 100, [ 'options' => [] ]],
            ['area_total',                     'Área total',                    null,       false,  false, null, 100],
            ['tipo_cultivo',                   'Tipo de cultivo',              'select',    true,   false, null, 100, [ 'options' => [] ]],
            ['total_lotes',                    'Total Lotes',                   null,       false,  false, null, 100],
            ['tipo_suelo',                     'Tipo de suelo',                'select',    true,   false, null, 100, [ 'options' => [] ]],
            ['zona_id',                        'Zona',                         'select',    false,  false, null, 100, [ 'options' => $zonas] ],
            ['latitud',                        'Latitud',                       null,       true,   false, null, 100],
            ['longitud',                       'Longitud',                      null,       true,   false, null, 100],
            ['hectareas',                      'Hectareas',                     null,       true,   false, null, 100],
            ['sitios',                         'Sitios',                        null,       true,   false, null, 100],
            ['temperatura',                    'Temperatura (C°):',             null,       false,  false, null, 100],
            ['humedad_relativa',               'Humedad Relativa (%):',         null,       true,   false, null, 100],
            ['precipitacion',                  'Precipitacion (Mm):',           null,       true,   false, null, 100],
            ['altimetria_min',                 'Altimetria Minima (Mt):',       null,       false,  false, null, 100],
            ['altimetria_max',                 'Altimetria Maxima (Mt):',       null,       true,   false, null, 100],
            ['brillo_solar',                   'Brillo Solar (H):',             null,       true,   false, null, 100],
           
        ];

    }

    public function scopeId($q, $id)
    {
        return $q->where('id', $id);
    }

    public function zona()
    {
        return $this->belongsTo('App\Models\Zona', 'zona_id');
    }
    
    public function usuarios()
    {
        return $this->belongsTo('App\Models\Usuario', 'usuario_id');
    }
}
