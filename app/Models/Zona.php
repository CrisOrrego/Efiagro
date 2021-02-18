<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;
    protected $table = 'zonas_agroambientales';
    protected $guarded = ['id'];
    protected $appends = [];

    public function columns()
    {
        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
            ['descripcion',         'Descripcion:',          null, true,     false, null, 100],
            ['temperatura',         'Temperatura (C°):',          null, false,    false, null, 100],
            ['humedad_relativa',    'Humedad Relativa (%):',     null, true,     false, null, 100],
            ['precipitacion',       'Precipitacion Mm:',        null, true,     false, null, 100],
            ['altimetria_min',      'Altimetria Minima (Mt):',       null, false,    false, null, 100],
            ['altimetria_max',      'Altimetria Maxima (Mt):',       null, true,     false, null, 100],
            ['brillo_solar',        'Brillo Solar (H):',         null, true,     false, null, 100],

        ];
    }

}
