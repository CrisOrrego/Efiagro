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
            ['zona_id', 'Zona', null, false, false, null, 100],
            ['latitud', 'Latitud', null, true, false, null, 100],
            ['longitud', 'Longitud', null, true, false, null, 100],
            ['hectareas', 'Hectareas', null, true, false, null, 100],
            ['sitios', 'Sitios', null, true, false, null, 100],

        ];

    }

    public function scopeId($q, $id)
    {
        return $q->where('id', $id);
    }

}
