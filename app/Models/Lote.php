<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'lotes';
    protected $guarded = ['id'];
    protected $appends = [];
    public function columns()
    {
        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
            ['finca_id', 'Finca', null, true, false, null, 100],
            ['organizacion_id', 'Organización', null, true, false, null, 100],
            ['linea_productiva_id', 'Linea Productiva', null, false, false, null, 100],
            ['hectareas', 'Hectareas', null, true, false, null, 100],
            ['sitios', 'Sitios', null, true, false, null, 100],
            ['tarea_id', 'Tarea', null, true, false, null, 100],
            ['coordenadas', 'Coordenadas', null, true, false, null, 100],
            
        ];

    }
    public function finca()
    {
        return $this->belongsTo('App\Models\Finca', 'finca_id', 'id');
    }

    public function tareas()
    {
        return $this->hasMany('App\Models\TareasLote', 'lote_id');
    }
}

