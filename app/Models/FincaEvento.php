<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;
    protected $table = 'finca_eventos';
    protected $guarded = ['id'];
    protected $appends = [];
    
    public function columns()
    {
    
        $fincas = \App\Models\Finca::all()->keyBy('id')->map( function($f){
            return $f['nombre'];
        })->toArray();

        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
           
            ['finca_id',           'Finca',        null,       true,     false,  null,       100],
            ['evento_id',              'evento_id',           null,       true,     false,  null,       100],
            ['fecha',         'fecha',      null,       true,     false,  null,       100],
            ['gravedad',         'gravedad',      null,       true,     false,  null,       100],
            
            
        ];

    }

   
}

