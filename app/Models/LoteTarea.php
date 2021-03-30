<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteTarea extends Model
{
    use HasFactory;
    protected $table = 'lotes_tareas';
    protected $guarded = ['id'];
    protected $appends = [];
    protected $cast = [
        //'objeto' => 'array'
    ];
    public function columns()
    {
        //      Name,       Desc,       Type,   Required, Unique, Default, Width, Options
        return [
            [ 'lote_id',    'Lote',      null,   true,  false, null, 11 ],
            [ 'fecha',      'Fecha',      null,   true,  false, null, 100 ],
            [ 'titulo',  	'Tarea',         null,   false, false, null, 250 ],
            [ 'estado',     'Estado',      null,   true,  false, null, 250 ],
            
        ];
    }

    // public function lote()
    // {
    // 	return $this->belongsTo('App\Models\Lote', 'lote_id', 'id');
    // }

    // public function scopeEllote($q, $id_lote)
    // {
    // 	return $q->where('lote_id', $id_lote);
    // }

    // public static function boot()
    // {
    //     parent::boot();

    //     self::saving(function($model){
    //         if(!is_string($model->attributes['tarea']) AND !is_null($model->attributes['tarea'])) 
    //             $model->attributes['tarea'] = json_encode($model->attributes['tarea']);
    //     });
    // }

    // public function getTareaAttribute($tarea)
    // {
    //     if($this->estado == 'Tabla') return json_decode($tarea);
    //     return $tarea;
    // }
}
