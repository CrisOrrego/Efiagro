<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaDetalle extends Model
{
    use HasFactory;
    protected $table = 'listas_detalle';
    protected $guarded = ['id'];
    protected $appends = [];
}
