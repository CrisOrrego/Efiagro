<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;
    protected $table = 'zonas';
    protected $guarded = ['id'];
    protected $appends = [];

    public function columns()
    {
        //Name, Desc, Type, Required, Unique, Default, Width, Options linea_productiva_id
        return [
            ['descripcion',             'Descripcion:',                                     null, true,     false, null, 100],
            ['linea_productiva_id',     'Linea productiva (1-Platano, 2-Café, 3-Mora):',    null, true,     false, null, 255],
            ['temperatura_min',         'Temperatura Min (C°):',                            null, false,    false, null, 100],
            ['temperatura_max',         'Temperatura Max (C°):',                            null, false,    false, null, 100],
            ['humedad_relativa_min',    'Humedad Relativa Min (%):',                        null, true,     false, null, 100],
            ['humedad_relativa_max',    'Humedad Relativa Max (%):',                        null, true,     false, null, 100],
            ['precipitacion_min',       'Precipitacion Min (Mm):',                          null, true,     false, null, 100],
            ['precipitacion_max',       'Precipitacion Max (Mm):',                          null, true,     false, null, 100],
            ['altimetria_min',          'Altimetria Minima (Mt):',                          null, false,    false, null, 100],
            ['altimetria_max',          'Altimetria Maxima (Mt):',                          null, true,     false, null, 100],
            ['brillo_solar_min',        'Brillo Solar Min (H):',                            null, true,     false, null, 100],
            ['brillo_solar_max',        'Brillo Solar Max (H):',                            null, true,     false, null, 100],
            ['pendiente',               'Pendiente (m):',                                   null, true,     false, null, 100],

        ];
    }

}
