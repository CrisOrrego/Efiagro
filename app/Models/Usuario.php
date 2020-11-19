<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $guarded = ['id'];
    protected $appends = [ 'nombre' ];

    public function columns()
    {
        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
            [ 'nombres',        'Nombres',      null, 	 true,  false, null, 50 ],
            [ 'apellidos',      'Apellidos',    null, 	 true,  false, null, 50 ],
            [ 'cedula',         'Cedula',       null, 	 false, true,  null, 45 ],
            [ 'correo',         'Correo',      'email',  false, true,  null, 55 ]
        ];
    }

    public function getNombreAttribute()
    {
    	return $this->nombres .' '. $this->apellidos;
    }

}
