<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
class Usuario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'usuarios';
    protected $guarded = ['id'];
    protected $appends = [ 
        'nombre'
    ];

    public function columns()
    {
        // Arreglo para la carga de Tipos de documentos.
        $tipodocumento = [
            'CC' => 'Cedula Ciudadania', 'CE' => 'Cedula Extranjeria', 'TI' => 'Tarjeta Identidad', 'PA' => 'Pasaporte', 'RC' => 'Registro Civil', 'NI' => 'NIT'
        ];
        // Obtener informacion de los perfiles, y luego almacenarlo en formato de arreglo.
        $perfiles = \App\Models\Perfil::all()->keyBy('id')->map( function($p){
            return $p['perfil'];
        })->toArray();
        
        //Name,         Desc,               Type,   Required, Unique, Default, Width, Options
        return [
            [ 'tipo_documento', 'Tipo Documento',   'select',   true,   false, null, 30, [ 'options' => $tipodocumento ]],
            [ 'documento',      'Documento',        null, 	    true,   false, null, 70 ],
            [ 'nombres',        'Nombres',          null, 	    true,   false, null, 100 ],
            [ 'apellidos',      'Apellidos',        null, 	    true,   false, null, 100 ],
            [ 'correo',         'Correo electrónico', 'email',  false,  false,  null, 100 ],
            [ 'celular',        'Celular',          'string',   false,  false,  null, 45 ],
            [ 'perfil_id',      'Perfil',           'select',   true,   false,  null, 50, ['options' => $perfiles] ],
            [ 'organizacion_id','Organización',     'select',   false,  false,  null, 50 ],
            [ 'finca_id',       'Finca',            'select',   false,  false,  null, 50 ]
        ];
    }
    
    public function scopeLaorganizacion( $q, $organizacion_id) {
        return $q->where('organizacion_id', $organizacion_id);
    }
    //Relaciones
    public function fincas()
    {
        return $this->hasMany('App\Models\Finca', 'usuario_id');
    }

    public function organizaciones()
    {
        return $this->hasMany('App\Models\Organizacion', 'usuario_id');
    }
    
    public function perfil()
    {
        return $this->belongsTo('App\Models\Perfil', 'perfil_id');
    }

    public function getNombreAttribute()
    {
    	return $this->nombres .' '. $this->apellidos;
    }
    
    // Metodo para encriptar la clave del usuario.
    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->attributes['contrasena'] = Crypt::encryptString($model->attributes['documento']);
        });
    }

}
