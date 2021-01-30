<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareasLote extends Model
{
    use HasFactory;

    protected $table = 'tareas_lote';
    protected $guarded = ['id'];
    protected $appends = [];
    protected $cast = [
        //'objeto' => 'array'
    ];

    public function columns()
    {
        //      Name,       Desc,       Type,   Required, Unique, Default, Width, Options
        return [
            [ 'usuario_id', 'Usuario',   null,   true,  false, null, 11 ],
            [ 'lote_id',    'Lote',      null,   true,  false, null, 11 ],
            [ 'tarea',  	'Tarea',         null,   false, false, null, 100 ],
            [ 'estado',    'Estado',      null,   true,  false, null, 1000 ],
            [ 'semana',    'Semana',      null,   true,  false, null, 1000 ],
        ];
    }

    public function lote()
    {
    	return $this->belongsTo('App\Models\Lote', 'lote_id', 'id');
    }

    public function scopeEllote($q, $id_lote)
    {
    	return $q->where('lote_id', $id_lote);
    }

    public static function boot()
    {
        parent::boot();

        self::saving(function($model){
            if(!is_string($model->attributes['tarea']) AND !is_null($model->attributes['tarea'])) 
                $model->attributes['tarea'] = json_encode($model->attributes['tarea']);
        });
    }

    public function getTareaAttribute($tarea)
    {
        if($this->estado == 'Tabla') return json_decode($tarea);
        return $tarea;
    }
}
