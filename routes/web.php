<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('Base'); });
Route::get('/Login', function(){ return view('Login'); });
Route::get('/Home', function(){  return view('Home'); });
Route::get('/Home/{seccion}', function(){  return view('Seccion'); });
Route::get('/Home/{seccion}/{subseccion}', 'MainController@cargarSubseccion');
Route::get('/Frag/{vista}',                'MainController@cargarFragmento');
Route::post("/api/upload", [FileController::class, 'upload']);
//Inicio Dev ANGÉLICA
Route::post("/api/lista", [ListaController::class, 'Actualizar']);
Route::get("/api/lista/{id}",  [ListaController::class, 'Lista']);
Route::post("/api/lista",  [ListaController::class, 'Delete']);
//FIN Dev ANGÉLICA

AdvancedRoute::controller('/api/main',      'MainController');
AdvancedRoute::controller('/api/usuario',   'UsuarioController');
AdvancedRoute::controller('/api/articulos', 'ArticulosController');
//Inicio Dev ANGÉLICA
AdvancedRoute::controller('/api/contacto',                        'ContactoController');
AdvancedRoute::controller('/api/organizacionesmurosecciones',     'OrganizacionesMuroSeccionesController');
AdvancedRoute::controller('/api/lista',                           'ListaController');
//FIN Dev ANGÉLICA
AdvancedRoute::controller('/api/organizaciones',  'OrganizacionController');
AdvancedRoute::controller('/api/fincas',  'FincaController');
AdvancedRoute::controller('/api/lotes',  'LoteController');

AdvancedRoute::controller('/api/casos',     'CasosController'); // Luigi
AdvancedRoute::controller('/api/lineasproductivas',     'LineasProductivasController'); // Luigi