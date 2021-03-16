<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    use HasFactory;

    protected $table = 'labores';
    protected $guarded = ['id'];
    protected $appends = [];

    public function columns()
    {
        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
            ['labor',            'Labor:',               null, true, false, null, 255],
            ['linea_productiva_id',            'Linea productiva (1-Platano, 2-Café, 3-Mora):',   null, true, false, null, 255],
            ['frecuencia',       'Frecuencia:',          null, true, false, null, 100],
            ['semana_inicio',    'Semana de inicio:',    null, false, false, null, 100],
            ['margen',      'Margen:',      null, false, false, null, 100],   
        ];
    }
}
