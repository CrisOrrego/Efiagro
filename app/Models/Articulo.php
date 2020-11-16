<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulos';
    protected $guarded = ['id'];
    protected $appends = [];

    public function scopeActivos($q)
    {
    	return $q->where('estado', 'A');
    }

    public function scopeAccesibles($q)
    {
    	return $q;
    }

    public function secciones()
    {
    	return $this->hasMany('App\Models\ArticuloSeccion', 'articulo_id', 'id');
    }

}
