<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizacion extends Model
{
    use HasFactory;
    
    protected $table = 'organizaciones';
    protected $guarded = ['id'];
    protected $appends = [];

    public function columns()
    {
        //Name, Desc, Type, Required, Unique, Default, Width, Options
        return [
            ['nombre',                      'Nombre:',                       null, true,         false, null, 100],
            ['nit',                         'Nit:',                          null, true,         false, null, 100],
            ['sigla',                       'Sigla:',                        null, false,        false, null, 100],
            ['latitud',                     'Latitud:',                      null, false,        false, null, 100],
            ['longitud',                    'Longitud:',                     null, false,        false, null, 100],
            ['direccion',                   'Dirección:',                    null, true,         false, null, 100],
            ['departamento',                'Departamento:',                 'select', true,         false, null, 100],
            ['municipio',                   'Municipio:',                    null, true,         false, null, 100],
            ['telefono',                    'Teléfono:',                     null, true,         false, null, 100],
            ['correo',                      'Correo:',                       'email', true,      false, null, 100],
            ['total_asociados',             'Asociados:',                    'integer', true,    false, null, 100],
            ['fecha_constitucion',          'Fecha Constitución:',           'date', true,       false, null, 100],         
        ];
        
    }

    
    public function departamento()
    {
        return $this->hasMany('App\Models\Departamento', 'id_departamento', 'id');
    }
}
