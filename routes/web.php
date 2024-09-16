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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
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
Route::get('listaclientes', [App\Http\Controllers\ClientesController::class, 'listaclientes']); // vista clientes adminstracion


Route::get('eliminarclietne/{id}', [App\Http\Controllers\ClientesController::class, 'eliminarclietne'])->name('eliminarclietne'); // lista de los clientes
Route::post('deletselct/', [App\Http\Controllers\ClientesController::class, 'deletselct'])->name('deletselct');


Route::get('perfilcliente/{id}', [App\Http\Controllers\ClientesController::class, 'perfilcliente'])->name('perfilcliente');
Route::get('adminstracionclientes/{id}', [App\Http\Controllers\ClientesController::class, 'adminstracionclientes'])->name('adminstracionclientes');

Route::get('update-1', [App\Http\Controllers\ClientesController::class, 'update1']);
Route::post('adminstracionclientes/renovarpoliza', [App\Http\Controllers\ClientesController::class, 'renovarpoliza']);
Route::post('adminstracionclientes/continuidad', [App\Http\Controllers\ClientesController::class, 'continuidad']);

Route::post('perfilcliente/adminfiles2/', [App\Http\Controllers\ClientesController::class, 'uploadFile2']); 
Route::post('perfilcliente/adminfiles3/', [App\Http\Controllers\ClientesController::class, 'uploadFilecontrato']); 
Route::post('adminfiles2/', [App\Http\Controllers\ClientesController::class, 'uploadFile3']); 
Route::post('perfilcliente/actualizardatos/', [App\Http\Controllers\ClientesController::class, 'actualizardatos']); 
Route::post('adminstracionclientes/actualizardatos/', [App\Http\Controllers\ClientesController::class, 'actualizardatos']); 
Route::post('perfilcliente/adminpagos/', [App\Http\Controllers\ClientesController::class, 'agregarpagos']);
Route::get('comparar', [App\Http\Controllers\CotizadorController::class, 'comparar']);
Route::post('perfilcliente/frecuenciapagos/', [App\Http\Controllers\ClientesController::class, 'frecuenciapagos'])->name('frecuenciapagos');
Route::post('adminstracionclientes/frecuenciapagos/', [App\Http\Controllers\ClientesController::class, 'frecuenciapagos']);
Route::post('perfilcliente/generateqr/', [App\Http\Controllers\ClientesController::class, 'generateqr']);
Route::post('adminstracionclientes/generateqr/', [App\Http\Controllers\ClientesController::class, 'generateqr']);
Route::get('listarpagospendientes', [App\Http\Controllers\ClientesController::class, 'listarpagospendientesclientes'])->name('pagospendientes'); // vista 
Route::get('pagospendientes', [App\Http\Controllers\ClientesController::class, 'pagospendientes']);
Route::get('/usuarios', [App\Http\Controllers\ClientesController::class, 'usuarios'])->name('usuarios');

Route::post('adminstracionclientes/polizassalud', [App\Http\Controllers\ClientesController::class, 'polizassalud'])->name('polizassalud');
Route::post('adminstracionclientes/polizasuato', [App\Http\Controllers\ClientesController::class, 'polizasuato'])->name('polizasuato');
Route::post('adminstracionclientes/polizaempresas', [App\Http\Controllers\ClientesController::class, 'polizaempresas'])->name('polizaempresas');
Route::post('adminstracionclientes/adminpagos/', [App\Http\Controllers\ClientesController::class, 'guardarpagpendiente']);
Route::post('realizar-pagos-frecuentes/pago-colectivo', [App\Http\Controllers\ClientesController::class, 'guardarpagpendientecolectivos']);


Route::post('adminstracionclientes/gudardarsinisestro/', [App\Http\Controllers\ClientesController::class, 'gudardarsinisestro']); 
Route::post('adminstracionclientes/gudardarsinisestroeditar/', [App\Http\Controllers\ClientesController::class, 'gudardarsinisestroeditar']);
Route::post('adminstracionclientes/borrardocumento/{id}', [App\Http\Controllers\ClientesController::class, 'borrardocumento']);
Route::get('borrardocumento/{id}', [App\Http\Controllers\ClientesController::class, 'borrardocumento']);
Route::get('eliminarqr/{id}', [App\Http\Controllers\ClientesController::class, 'eliminarqr']);

Route::get('editarpoliza/{idinsurancepolicies}', [App\Http\Controllers\ClientesController::class, 'editarpoliza']);

Route::get('eliminarparentesco/{id}', [App\Http\Controllers\ClientesController::class, 'eliminarparentesco']);
Route::get('eliminardocumento/{id}', [App\Http\Controllers\ClientesController::class, 'eliminardocumento']);
Route::get('eliminarcomentario/{id}', [App\Http\Controllers\ClientesController::class, 'eliminarcomentario']);
Route::get('eliminardelcarada/{id}', [App\Http\Controllers\ClientesController::class, 'eliminardelcarada']);
Route::get('eliminarnodeclarada/{id}', [App\Http\Controllers\ClientesController::class, 'eliminarnodeclarada']);
Route::get('eliminarpoliza/{id}', [App\Http\Controllers\ClientesController::class, 'eliminarpoliza']);

Route::post('adminstracionclientes/parentescoadd/', [App\Http\Controllers\ClientesController::class, 'addparentesco']);
Route::post('adminstracionclientes/documentosadd/', [App\Http\Controllers\ClientesController::class, 'adddocumentos']);
Route::post('adminstracionclientes/comentariosadd/', [App\Http\Controllers\ClientesController::class, 'addcomentario']);
Route::post('adminstracionclientes/patologiasiadd/', [App\Http\Controllers\ClientesController::class, 'addpatologiasi']);
Route::post('adminstracionclientes/patologianoadd/', [App\Http\Controllers\ClientesController::class, 'addpatologiano']);

Route::post('adminstracionclientes/editmodeloautos/', [App\Http\Controllers\ClientesController::class, 'editmodeloautos']);
Route::post('adminstracionclientes/formeditdocumentosautosadd/', [App\Http\Controllers\ClientesController::class, 'editardocumentosauto']);
Route::post('adminstracionclientes/formcomentarioseditadd/', [App\Http\Controllers\ClientesController::class, 'editarcomentariosagregar']);

Route::post('adminstracionclientes/editarempresaadd/', [App\Http\Controllers\ClientesController::class, 'editarempresa']);
Route::post('adminstracionclientes/editardocumentoseditar/', [App\Http\Controllers\ClientesController::class, 'editarempresadocumentos']);
Route::post('adminstracionclientes/editarcomentarioempresa/', [App\Http\Controllers\ClientesController::class, 'editarempresacomentarios']);

Route::get('asegurado/{code}', [App\Http\Controllers\ClientesController::class, 'qrurl']);
Route::post('clienteasegura', [App\Http\Controllers\ClientesController::class, 'clienteasegurado']);
Route::post('actualizarmisdatos', [App\Http\Controllers\ClientesController::class, 'actualizarmisdatos']);
Route::post('cliente/actualizarmisdatos', [App\Http\Controllers\ClientesController::class, 'actualizarmisdatos']);

Route::get('mispolizas', [App\Http\Controllers\ClientesController::class, 'mispolizas']);
Route::get('missninestros', [App\Http\Controllers\ClientesController::class, 'missninestros']);
Route::get('misdatos', [App\Http\Controllers\ClientesController::class, 'misdatos']);
Route::get('mispagos', [App\Http\Controllers\ClientesController::class, 'mispagos']);
Route::get('/test', [App\Http\Controllers\ClientesController::class, 'test']);
// empresas
Route::get('agregar-empresa', [App\Http\Controllers\CompanyController::class, "addcompany" ]);
Route::post('agregar-empresa', [App\Http\Controllers\CompanyController::class, "saveaddcompany" ]);
Route::get('lista-empresas', [App\Http\Controllers\CompanyController::class, "listcompany" ]);
Route::get('getcompanys', [App\Http\Controllers\CompanyController::class, 'getcompanys']);
// colectivos
Route::get('colectivos', [App\Http\Controllers\ClientesController::class, "colectivos" ]);
Route::post('uploadgrup', [App\Http\Controllers\ClientesController::class, "importgroups" ]);



Route::get('colectivos-asegurados', [App\Http\Controllers\ClientesController::class, 'insuredgroups']);
Route::get('list-group', [App\Http\Controllers\ClientesController::class, 'listgroups']);

Route::get('colectivos-polizas/{id}', [App\Http\Controllers\ClientesController::class, 'insuredpolicies']);
Route::post('addpolicesgruop', [App\Http\Controllers\ClientesController::class, "addpolicesgruop" ]);

Route::get('colectivos-frecuencias-pagos/{id}', [App\Http\Controllers\ClientesController::class, "frequentcollectivepayments" ]);
Route::post('savecollectivequotas', [App\Http\Controllers\ClientesController::class, 'savecollectivequotas']);
Route::post('colectivos-frecuencias-pagos/savecollectivequotas', [App\Http\Controllers\ClientesController::class, 'savecollectivequotas']);

Route::get('realizar-pagos-frecuentes/{id}', [App\Http\Controllers\ClientesController::class, "makefrequentpayments" ]);



Route::group(['prefix' => 'admin'], function () {
    Route::get('/excel', [App\Http\Controllers\CotizadorController::class, "insurerExcel" ]);
    Route::post('/excel', [App\Http\Controllers\CotizadorController::class, 'importExcel']);
    
    Route::get('listar-cotizaciones/{page}', [App\Http\Controllers\CotizadorController::class, "listarCotizaciones" ]);
    Route::get('consultar-pagos-empresas/{page}', [App\Http\Controllers\CotizadorController::class, "listarCotizaciones" ]);

   
   

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

Route::get('/contacto-seguros', [App\Http\Controllers\ClientesController::class, 'contactoseguros']);
Route::get('/contacto-cotiseguros', [App\Http\Controllers\ClientesController::class, 'conctactocotiseguros']);
Route::get('listarcontactos/', [App\Http\Controllers\ClientesController::class, 'listarcontactos']);
Route::get('listarpersonal/', [App\Http\Controllers\ClientesController::class, 'listarpersonal']);
Route::post('guardarcontacto', [App\Http\Controllers\ClientesController::class, 'guardarcontacto']);
Route::post('guardarcontactocotiseguro', [App\Http\Controllers\ClientesController::class, 'contactocotiseguro']);
Route::get('eliminarpersonal/{id}', [App\Http\Controllers\ClientesController::class, 'eliminarpersonal']);
Route::get('eliminarcontacto/{id}', [App\Http\Controllers\ClientesController::class, 'eliminarcontacto']);

Route::get('cliente/mis-polizas', [App\Http\Controllers\ClientesController::class, 'mispolizascliente']);
Route::get('cliente/mis-siniestros', [App\Http\Controllers\ClientesController::class, 'sinisestros']);
Route::get('cliente/mis-pagos', [App\Http\Controllers\ClientesController::class, 'mispagos']);
Route::get('cliente/mis-datos', [App\Http\Controllers\ClientesController::class, 'misdatos']);
Route::get('cliente/mis-datos-parte-2', [App\Http\Controllers\ClientesController::class, 'misdatosparte2']);

Route::get('cliente/salud', [App\Http\Controllers\ClientesController::class, 'clientesalud']);
Route::get('cliente/auto', [App\Http\Controllers\ClientesController::class, 'clienteauto']);
Route::get('cliente/patrimonio', [App\Http\Controllers\ClientesController::class, 'clientepatrimonio']);

Route::get('importar-usuarios', [App\Http\Controllers\ClientesController::class, 'importarusuarios']);
Route::post('importausu', [App\Http\Controllers\ClientesController::class, 'importausu']);

// CLinicas 
Route::get('agregar-clinica', [App\Http\Controllers\ClinicasController::class, 'clinicas']);
Route::get('agregar-clincas-masivo', [App\Http\Controllers\ClinicasController::class, 'addclinic']);
Route::get('listado-de-clinicas', [App\Http\Controllers\ClinicasController::class, 'listofclinics']);
Route::get('changeselectestado/{id}', [App\Http\Controllers\ClinicasController::class, 'changeselectestado']);
Route::post('agregarclinica', [App\Http\Controllers\ClinicasController::class, 'agregarclinica']);

Route::post('importar-clinicas-excel', [App\Http\Controllers\ClinicasController::class, 'clinicssave']);
Route::get('json-clinicas', [App\Http\Controllers\ClinicasController::class, 'jsonclinics']);
Route::get('eliminarclinica/{id}', [App\Http\Controllers\ClinicasController::class, 'eliminarclinica']);
Route::get('editarclinica/{id}', [App\Http\Controllers\ClinicasController::class, 'datoseditarclinica']);
Route::get('modificar-clinica/{id}', [App\Http\Controllers\ClinicasController::class, 'modifyclinic']);
//----

Route::get('siniestro/{id}', [App\Http\Controllers\ClientesController::class, 'siniestro']);
Route::get('cumpleañeros-del-mes', [App\Http\Controllers\ClientesController::class, 'birthdaydate']);
Route::get('listbirthdaydate', [App\Http\Controllers\ClientesController::class, 'listbirthdaydate']);

Route::get('cambiar', [App\Http\Controllers\ClientesController::class, 'amountcoverages']);

Route::get('teste', [App\Http\Controllers\ClientesController::class, 'pagostes']);
