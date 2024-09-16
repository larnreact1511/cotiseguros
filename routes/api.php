<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/status', [App\Http\Controllers\CotizadorController::class, 'getStatus'])->name('getStatus');

Route::resource('status', App\Http\Controllers\StatusController::class);
Route::resource('gender', App\Http\Controllers\GendersController::class);
Route::get('/salud/cotizacion/{phone}', [App\Http\Controllers\CotizadorController::class, 'getCotizacionByPhone']);

Route::get('/getCotizacionesByOrder/{id}', [App\Http\Controllers\CotizadorController::class, 'getCotizacionesByOrder']);
Route::get('/getCotizacionesByOrder2/', [App\Http\Controllers\CotizadorController::class, 'getCotizacionesByOrder2']);

Route::get('/test', [App\Http\Controllers\CotizadorController::class, 'test']);

Route::get('/frequency', [App\Http\Controllers\CotizadorController::class, 'getFrequency']);
Route::get('/coverages', [App\Http\Controllers\CotizadorController::class, 'getCoberages']);

Route::get('/checkPhone/{number}', [App\Http\Controllers\CotizadorController::class, 'checkPhone']);
Route::get('/verifyCode/{number}/{code}', [App\Http\Controllers\CotizadorController::class, 'verifyCode']);

Route::post('/cotizador/changeMembers/{id}', [App\Http\Controllers\CotizadorController::class, 'changeMembers']);
//Route::get('/getMembersByQuote/{phone}', [App\Http\Controllers\CotizadorSaludController::class, 'getMembersByQuote']);

// New

// Home
Route::get('/getHome', [App\Http\Controllers\HomeController::class, 'getHome']);
// Home

Route::resource("/provinces",App\Http\Controllers\ProvincesController::class);
Route::resource("/codes",App\Http\Controllers\CodesController::class);
Route::post('/cotizarSalud', [App\Http\Controllers\CotizadorSaludController::class, 'cotizarSalud']);
Route::get('/getCotizacionSalud/{phone}', [App\Http\Controllers\CotizadorSaludController::class, 'getCotizacionSalud']);
Route::get('/getCotizacionSaludadmin/{phone}/{id}', [App\Http\Controllers\CotizadorSaludController::class, 'getCotizacionSaludadmin']);

Route::get('/getQuoteByPhone/{phone}', [App\Http\Controllers\CotizadorSaludController::class, 'getQuoteByPhone']);
Route::post('/sendCotizacion', [App\Http\Controllers\CotizadorSaludController::class, 'sendCotizacion']);
Route::post('/sendCotizacionlotes', [App\Http\Controllers\CotizadorSaludController::class, 'sendCotizacionlotes']);
Route::post('/sendCotizacionlotes2', [App\Http\Controllers\CotizadorSaludController::class, 'sendCotizacionlotes2']);
Route::post('/sendCotizacionlotes3', [App\Http\Controllers\CotizadorSaludController::class, 'sendCotizacionlotes3']);
Route::post('/sendCotizacionlotes4', [App\Http\Controllers\CotizadorSaludController::class, 'sendCotizacionlotes4']);
Route::post('/generarpdfcomparativo', [App\Http\Controllers\CotizadorSaludController::class, 'generarpdfcomparativo']);
Route::get('/changeCoverage/{phone}/{coverage}', [App\Http\Controllers\CotizadorSaludController::class, 'changeCoverage']);
Route::post('/changeCoverageid/', [App\Http\Controllers\CotizadorSaludController::class, 'changeCoverageid']);
Route::post('/changeMembersByQuote', [App\Http\Controllers\CotizadorSaludController::class, 'changeMembersByQuote']);
Route::post('/changeMembersByQuote2', [App\Http\Controllers\CotizadorSaludController::class, 'changeMembersByQuote2']);
Route::get('/changeMembersByQuote/{phone}', [App\Http\Controllers\CotizadorSaludController::class, 'getMembersByQuote']);
Route::get('/smtp', [App\Http\Controllers\CotizadorSaludController::class, 'smtp']);




// New
Route::get('/deletecotizacion/{id}', [App\Http\Controllers\CotizadorController::class, 'deletecotizacion']);
Route::get('/agregarcuotacliente/{idquote}/{idusuario}', [App\Http\Controllers\ClientesController::class, 'agregarcuotacliente']); // agregar cuota a un cliente existente
Route::get('/createcliente/{id}', [App\Http\Controllers\ClientesController::class, 'createclientedesdequote']);
Route::post('/crearnotacliente/', [App\Http\Controllers\NotificationsController::class, 'createnote'])->name('crearnotacliente');
Route::post('/vernotasanteriores/{id}', [App\Http\Controllers\NotificationsController::class, 'vernotasanteriores'])->name('vernotasanteriores'); // ver notas de la cuota creada
Route::get('/verpagos/{idquote}/{id_insurancepolicies}', [App\Http\Controllers\ClientesController::class, 'verpagos']); // ver pagos de una cotizacion
Route::post('/calcularcuotas', [App\Http\Controllers\ClientesController::class, 'calcularcuotas'])->name('calcularcuotas');

Route::post('/collective-quotas', [App\Http\Controllers\ClientesController::class, 'collectivequotas']);

Route::post('/aprobarpoliza', [App\Http\Controllers\InsurancepoliciesController::class, 'aprobarpoliza'])->name('aprobarpoliza');
Route::post('/modificardatosquote', [App\Http\Controllers\ClientesController::class, 'modificardatosquote'])->name('modificardatosquote');

Route::post('pagospolizas', [App\Http\Controllers\ClientesController::class, 'pagospolizas'])->name('pagospolizas');
Route::post('pagospolizas-colectivos', [App\Http\Controllers\ClientesController::class, 'pagospolizascolectivos']);
Route::post('consultar-pagos-empresas', [App\Http\Controllers\ClientesController::class, 'consultpaymentscompanies']);
Route::post('funeditarfrecuencia', [App\Http\Controllers\ClientesController::class, 'editarfrecuenciapago'])->name('editarfrecuenciapago');

Route::post('/buscarsiniestros', [App\Http\Controllers\ClientesController::class, 'buscarsiniestros'])->name('buscarsiniestros');
Route::post('/editarnombredocumento', [App\Http\Controllers\ClientesController::class, 'nombredocumento']);

Route::post('/eliminarfrecuecia', [App\Http\Controllers\ClientesController::class, 'eliminarfrecuecia']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
