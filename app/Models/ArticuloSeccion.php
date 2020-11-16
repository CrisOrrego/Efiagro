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

    public function articulo()
    {
    	return $this->belongsTo('App\Models\Articulo', 'articulo_id', 'id');
    }

}
