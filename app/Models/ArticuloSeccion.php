<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloSeccion extends Model
{
    use HasFactory;

    protected $table = 'articulos_secciones';
    protected $guarded = ['id'];
    protected $appends = [];
    protected $cast = [
        //'objeto' => 'array'
    ];

    public function columns()
    {
        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
            [ 'articulo_id',        'articulo_id',          null,    true,  false, null,  100 ],
            [ 'tipo',  				'tipo',  null,    false,  false, null, 100 ],
            [ 'contenido',          'contenido',          null,    true,  false, null,  100 ],
            [ 'ruta',               'ruta',      null,    true,  false, null,  100 ],
            //[ 'objeto',      	    'objeto',      null,    true,  false, null,  100 ],
        ];
    }

    public function articulo()
    {
    	return $this->belongsTo('App\Models\Articulo', 'articulo_id', 'id');
    }

    public function scopeElarticulo($q, $id_articulo)
    {
    	return $q->where('articulo_id', $id_articulo);
    }

    public static function boot()
    {
        parent::boot();

        self::saving(function($model){
            if(!is_string($model->attributes['contenido']) AND !is_null($model->attributes['contenido'])) 
                $model->attributes['contenido'] = json_encode($model->attributes['contenido']);
        });
    }

    public function getContenidoAttribute($contenido)
    {
        if($this->tipo == 'Tabla') return json_decode($contenido);
        //if($contenido == 'null') $contenido = '';
        return $contenido;
    }


}
