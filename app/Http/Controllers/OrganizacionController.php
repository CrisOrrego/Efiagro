<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\Organizacion;
use App\Models\UsuarioOrganizacion;
use App\Models\Infpromedioproduccion as Promedio;
use App\Functions\Helper;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class OrganizacionController extends Controller
{
    public function postOrganizaciones()
	{
		$CRUD = new CRUD('App\Models\Organizacion');
        return $CRUD->call(request()->fn, request()->ops);
	}

	public function postDepartamentos()
 	{
 		$CRUD = new CRUD('App\Models\Departamento');
        return $CRUD->call(request()->fn, request()->ops);
	}

	public function postObtenerOrganizacion()
	{
		$Usuario = Helper::getUsuario();
		$Organizacion = Organizacion::where('id', $Usuario->organizacion_id)->first();
		return $Organizacion;
	}

	// Funcion para obtener las organizaciones que corresponden a un usuario_id
	public function postUsuario()
    {
		$usuario = request('usuario');
		return UsuarioOrganizacion::
            join('organizaciones', 'organizaciones.id', '=', 'organizacion_id')
            ->where("usuario_organizacion.usuario_id", $usuario)
            ->get();
    }

	// Funcion para obtener las organizaciones que corresponden a un usuario_id
	public function postUsuarios()
    {
		$organizacion = request('organizacion');
		return UsuarioOrganizacion::
            join('usuarios', 'usuarios.id', '=', 'usuario_id')
            ->where("usuario_organizacion.organizacion_id", $organizacion)
            ->get();
    }

	// Funcion para obtener las organizaciones que no se han asignado a un usuario_id
	public function postNoasignada()
    {
		$usuario = request('usuario');
		$organizaciones = UsuarioOrganizacion::select('organizacion_id')
            ->where("usuario_id", $usuario)
            ->get();

		return Organizacion::whereNotIn("id", $organizaciones)
            ->get();
    }

	public function postCrearusuarioorganizacion(Request $req)
	{
        $OU = new UsuarioOrganizacion();
            $OU->usuario_id		= $req['usuario'];
            $OU->organizacion_id= $req['organizacion'];
        $OU->save();
	}

	public function postLinea(Request $req)
	{
		return Organizacion::where('linea_productiva_id', $req['linea'])
			->get();
	}

    // Funcion para obtener el ultimo registro activo del informe de Promedio de Produccion
	public function postPromedioproduccion()
    {
		$organizacion = request('organizacion');
		return Promedio::where("organizacion_id", $organizacion)
            ->where("estado", "A")
            ->get();
    }

    // Funcion para calcular el valor de la produccion por cada Organizacion.
	public function postCalculoProduccion()
    {
		$mesActual = date('m');
		$datosActuales = Promedio::where("estado", "A")
            ->get();
        // Validar que no exista el mes actual o siguiente, para generar el conteo.
        if ( $datosActuales[0]['periodo'] == $mesActual || $datosActuales[0]['periodo'] + 1 == $mesActual ) {
            return;
        } else {
            $anio = date('Y');
            if ( $mesActual == 1 || $mesActual == 2 ) {
                $inicio = $anio . '-11-01';
                $final = $anio . '-12-31';
                $mesActual--;
            } else {
                $mes1 = ( $mesActual % 2 == 0 ) ? $mesActual - 3 : $mesActual - 2;
                $inicio = $anio . '-' . $mes1 . '-01';
                $final = $anio . '-' . ( $mes1 + 1 ) . '-31';
            }
            // Obtener promedio de hectareas y suma de kilogramos, para generar el promedio por organizacion.
            $organizaciones = Organizacion::findAll();
            for ($o = 0; $o < count($organizaciones); $o++ ) {
                $valores = DB::select("SELECT AVG(l.hectareas) as 'hectareas', SUM(kilogramo) as kilogramos
                    FROM `lotes` l
                        inner join `lotes_cosechas` c on l.id = c.lote_id
                    where l.organizacion_id = {$organizaciones[$o]['id']} and c.created_at between '$inicio' and '$final' ");
                if ( $valores['hectareas'] > 0 && $valores['kilogramos'] > 0 ) {
                    $promedio = $valores['hectareas'] / $valores['kilogramos'];
                } else {
                    $promedio = 0;
                }
                $datos = new Promedio([
                    'organizacion_id' => $organizaciones[$o]['id'],
                    'periodo'=> $mesActual,
                    'bimestre1'=> $datosActuales['bimestre2'],
                    'bimestre2'=> $datosActuales['bimestre3'],
                    'bimestre3'=> $datosActuales['bimestre4'],
                    'bimestre4'=> $datosActuales['bimestre5'],
                    'bimestre5'=> $datosActuales['bimestre6'],
                    'bimestre6'=> $promedio,
                    'estado' => 'A'
                ]);
                $datos->save();
            }
        }
    }

}
