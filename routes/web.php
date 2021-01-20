<?php

use Illuminate\Support\Facades\Route;

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

AdvancedRoute::controller('/api/main',      'MainController');
AdvancedRoute::controller('/api/usuario',   'UsuarioController');
AdvancedRoute::controller('/api/articulos', 'ArticulosController');
AdvancedRoute::controller('/api/casos',     'CasosController');
AdvancedRoute::controller('/api/organizaciones',  'OrganizacionController');
AdvancedRoute::controller('/api/fincas',  'FincaController');