<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions\CRUD;
use App\Models\Organizacion;
use App\Models\Departamento;


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

}
