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
            ['finca_id',            'Finca',            null, true,     false,  null,       100],
            ['organizacion_id',     'Organización',     null, true,     false,  null,       100],
            ['linea_productiva_id', 'Linea Productiva', null, false,    false,  null,       100],
            ['labores_id',          'Labores',          null, false,    false,  null,       100], 
            ['hectareas',           'Hectareas',        null, true,     false,  null,       100],
            ['sitios',              'Sitios',           null, true,     false,  null,       100],
            ['coordenadas',         'Coordenadas',      null, true,     false,  null,       100],
            
        ];

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

