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

// Route::get('/', function () {
//     return view('welcome');
// });
/*
Route::group(['prefix' => 'cotizador'], function () 
{
    
    Route::get('/{route?}/{route2?}/{route3?}/{route4?}', [App\Http\Controllers\CotisegurosController::class, 'index'])->name('home');
});
*/
 Route::group(['prefix' => 'cotizador'], function () {
     Route::get('/auto', [App\Http\Controllers\CotizadorController::class, 'auto'])->name('cotizador.auto');
     Route::get('/hogar', [App\Http\Controllers\CotizadorController::class, 'hogar'])->name('cotizador.hogar');
     Route::get('/salud', [App\Http\Controllers\CotizadorController::class, 'salud'])->name('cotizador.salud');
     Route::post('/salud/cotizacion', [App\Http\Controllers\CotizadorController::class, 'addCotizacion']);
     Route::post('/salud/cotizacion2', [App\Http\Controllers\CotizadorController::class, 'addCotizacion2']);
     Route::get('/salud/cotizacion/{phone}', [App\Http\Controllers\CotizadorController::class, 'getCotizacion']);
     Route::get('/salud/cotizacionpersonal/{phone}', [App\Http\Controllers\CotizadorController::class, 'getCotizacion2']);
     Route::get('/salud/cotizacionpersonaladmin/{phone}/{id}/', [App\Http\Controllers\CotizadorController::class, 'getCotizacion3']);
     Route::get('/salud/cotizacionpersonaladmin/{phone}', [App\Http\Controllers\CotizadorController::class, 'getCotizacion4']);
     Route::get('/cotizacion/exitosa', [App\Http\Controllers\CotizadorController::class, 'cotizacionExitosa']);
     Route::get('/pdf', [App\Http\Controllers\CotizadorController::class, 'pdf']);
 });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home2', [App\Http\Controllers\HomeController::class, 'home2'])->name('home2');
Route::get('/autos', [App\Http\Controllers\HomeController::class, 'autos'])->name('autos');
Route::get('/patrimonio', [App\Http\Controllers\HomeController::class, 'patrimonio'])->name('patrimonio');
Route::get('/sendSms2', [App\Http\Controllers\CotizadorController::class, 'sendSms2'])->name('sendSms2');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('listado/', [App\Http\Controllers\CotizadorController::class, 'listado'])->name('listado');
//Route::get('clienteslogin/', [App\Http\Controllers\clientesController::class, 'index'])->name('login');
Route::get('adminclientes/', [App\Http\Controllers\ClientesController::class, 'usuarios']);
Route::post('adminfiles/', [App\Http\Controllers\ClientesController::class, 'uploadFile']); 
Route::get('cotizar/', [App\Http\Controllers\CotizadorController::class, 'cotizar'])->name('cotizar'); // cotizador interno
Route::get('listartabla/', [App\Http\Controllers\CotizadorController::class, 'listartabla'])->name('listar'); // ver las cotizaciones
Route::get('nota/{id}', [App\Http\Controllers\NotificationsController::class, 'index'])->name('notas'); // crear nota a una quota
Route::get('listarclientes/', [App\Http\Controllers\ClientesController::class, 'listarclientes'])->name('listacliente'); // lista de los clientes
Route::get('listaclientes', [App\Http\Controllers\ClientesController::class, 'listaclientes'])->name('listacliente'); // vista clientes adminstracion

Route::get('perfilcliente/{id}', [App\Http\Controllers\ClientesController::class, 'perfilcliente'])->name('perfilcliente');
Route::get('adminstracionclientes/{id}', [App\Http\Controllers\ClientesController::class, 'adminstracionclientes'])->name('adminstracionclientes');
Route::post('perfilcliente/adminfiles2/', [App\Http\Controllers\ClientesController::class, 'uploadFile2']); 
Route::post('perfilcliente/adminfiles3/', [App\Http\Controllers\ClientesController::class, 'uploadFilecontrato']); 
Route::post('adminfiles2/', [App\Http\Controllers\ClientesController::class, 'uploadFile3']); 
Route::post('perfilcliente/actualizardatos/', [App\Http\Controllers\ClientesController::class, 'actualizardatos']); 
Route::post('adminstracionclientes/actualizardatos/', [App\Http\Controllers\ClientesController::class, 'actualizardatos']); 
Route::post('perfilcliente/adminpagos/', [App\Http\Controllers\ClientesController::class, 'agregarpagos']);
Route::get('comparar', [App\Http\Controllers\CotizadorController::class, 'comparar']);
Route::post('perfilcliente/frecuenciapagos/', [App\Http\Controllers\ClientesController::class, 'frecuenciapagos'])->name('frecuenciapagos');
Route::post('adminstracionclientes/frecuenciapagos/', [App\Http\Controllers\ClientesController::class, 'frecuenciapagos'])->name('frecuenciapagos');
Route::post('perfilcliente/generateqr/', [App\Http\Controllers\ClientesController::class, 'generateqr']);
Route::post('adminstracionclientes/generateqr/', [App\Http\Controllers\ClientesController::class, 'generateqr']);
Route::get('listarpagospendientes', [App\Http\Controllers\ClientesController::class, 'listarpagospendientesclientes'])->name('pagospendientes'); // vista 
Route::get('pagospendientes', [App\Http\Controllers\ClientesController::class, 'pagospendientes'])->name('pagospendientes'); 
Route::get('/usuarios', [App\Http\Controllers\ClientesController::class, 'usuarios'])->name('usuarios');

Route::post('adminstracionclientes/polizassalud', [App\Http\Controllers\ClientesController::class, 'polizassalud'])->name('polizassalud');
Route::post('adminstracionclientes/polizasuato', [App\Http\Controllers\ClientesController::class, 'polizasuato'])->name('polizasuato');
Route::post('adminstracionclientes/polizaempresas', [App\Http\Controllers\ClientesController::class, 'polizaempresas'])->name('polizaempresas');
Route::post('adminstracionclientes/adminpagos/', [App\Http\Controllers\ClientesController::class, 'guardarpagpendiente']);
Route::post('adminstracionclientes/gudardarsinisestro/', [App\Http\Controllers\ClientesController::class, 'gudardarsinisestro']); 
Route::post('adminstracionclientes/gudardarsinisestroeditar/', [App\Http\Controllers\ClientesController::class, 'gudardarsinisestroeditar']);
Route::post('adminstracionclientes/borrardocumento/', [App\Http\Controllers\ClientesController::class, 'borrardocumento']);
Route::get('asegurado/{code}', [App\Http\Controllers\ClientesController::class, 'qrurl']);
Route::post('clienteasegura', [App\Http\Controllers\ClientesController::class, 'clienteasegurado']);
Route::post('actualizarmisdatos', [App\Http\Controllers\ClientesController::class, 'actualizarmisdatos']);

Route::get('mispolizas', [App\Http\Controllers\ClientesController::class, 'mispolizas']);
Route::get('missninestros', [App\Http\Controllers\ClientesController::class, 'missninestros']);
Route::get('misdatos', [App\Http\Controllers\ClientesController::class, 'misdatos']);
Route::get('mispagos', [App\Http\Controllers\ClientesController::class, 'mispagos']);
Route::get('/test', [App\Http\Controllers\ClientesController::class, 'test']);

// empresas
Route::get('empresas/', [App\Http\Controllers\EmpresaController::class, 'index'])->name('index');
Route::get('listarempresas/', [App\Http\Controllers\EmpresaController::class, 'listarempresas'])->name('listarempresas');
Route::post('datosempresa/', [App\Http\Controllers\EmpresaController::class, 'datosempresa'])->name('listarempresas');
Route::post('crearpolizaapemresa/', [App\Http\Controllers\EmpresaController::class, 'crearpolizaapemresa'])->name('crearpolizaapemresa');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/excel', [App\Http\Controllers\CotizadorController::class, "insurerExcel" ]);
    Route::post('/excel', [App\Http\Controllers\CotizadorController::class, 'importExcel']);
    
    Route::get('/listar-cotizaciones/{page}', [App\Http\Controllers\CotizadorController::class, "listarCotizaciones" ]);

    Voyager::routes();
});
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache has been cleared';
});

//Clear route cache:
Route::get('/route-cache', function() {
	Artisan::call('route:cache');
    return 'Routes cache has been cleared';
});

//Clear config cache:
Route::get('/config-cache', function() {
 	Artisan::call('config:cache');
 	return 'Config cache has been cleared';
}); 

// Clear view cache:
Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return 'View cache has been cleared';
});

Route::get('sendwhat/', [App\Http\Controllers\CotizadorController::class, 'sendwhat'])->name('sendwhat');