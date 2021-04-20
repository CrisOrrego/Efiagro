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
    {
        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
            ['usuario_id', 'Usuario', null, true, false, null, 100],
            ['nombre', 'Nombre', null, true, false, null, 100],
            ['direccion', 'Dirección', null, false, false, null, 100],
            ['departamento_id', 'Departamento', null, false, false, null, 100],
            ['municipio_id', 'Municipio', null, false, false, null, 100],
            ['area_total', 'Área total', null, false, false, null, 100],
            ['tipo_cultivo', 'Tipo de cultivo', null, false, false, null, 100],
            ['total_lotes', 'Total Lotes', null, false, false, null, 100],
            ['tipo_suelo', 'Tipo de suelo', null, false, false, null, 100],
            ['zona_id', 'Zona', null, false, false, null, 100],
            ['latitud', 'Latitud', null, true, false, null, 100],
            ['longitud', 'Longitud', null, true, false, null, 100],
            ['hectareas', 'Hectareas', null, true, false, null, 100],
            ['sitios', 'Sitios', null, true, false, null, 100],
            ['temperatura',         'Temperatura (C°):',          null, false,    false, null, 100],
            ['humedad_relativa',    'Humedad Relativa (%):',     null, true,     false, null, 100],
            ['precipitacion',       'Precipitacion (Mm):',        null, true,     false, null, 100],
            ['altimetria_min',      'Altimetria Minima (Mt):',       null, false,    false, null, 100],
            ['altimetria_max',      'Altimetria Maxima (Mt):',       null, true,     false, null, 100],
            ['brillo_solar',        'Brillo Solar (H):',         null, true,     false, null, 100],
           
        ];

    }

    public function scopeId($q, $id)
    {
        return $q->where('id', $id);
    }

    public function zona()
    {
        return $this->belongsTo('App\Models\Zona',  'zona_id');
    }

}
