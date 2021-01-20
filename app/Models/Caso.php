<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    use HasFactory;

    protected $table = 'casos';
    protected $guarded = ['id'];
    protected $appends = [];

    public function columns()
    {
        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
            ['caso',            'Caso',        null, true, false, null, 100],
            ['titulo',          'Titulo',      null, true, false, null, 100],
            ['tipo',            'Tipo',        null, true, false, null, 100],
            ['estado',          'Estado',      null, true, false, null, 100],
            ['asignados',       'Asignados',   null, true, false, null, 100],
            ['solicitante_id',  'Solicitante', null, false, false, null, 100],
        ];
    }

    public function solicitante()
    {
        return $this->belongsTo('App\Models\Usuario', 'solicitante_id', 'id');
    }
    
}
