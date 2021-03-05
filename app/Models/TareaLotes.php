<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaLotes extends Model
{
    use HasFactory;
    protected $table = 'casos_novedades';
    protected $guarded = ['id'];
    protected $appends = [];
    protected $cast = [
        //'objeto' => 'array'
    ];

    public function columns()
    {
        //      Name,       Desc,       Type,   Required, Unique, Default, Width, Options
        return [
            [ 'nombre_tarea',   'Tarea',        null,   true,  false, null, 11 ],
            [ 'semana',         'Semana',       'date', true,       false, null, 100 ],
            [ 'estado',  	    'Estado',       null,   false, false, null, 100 ]   
        ];
    }
}
