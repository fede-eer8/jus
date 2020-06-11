<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('expedientecivil','ExpedienteCivilController');

Route::get('dropdownlist','DataController@getCategorias');
Route::get('dropdownlist/getmaterias/{id}','DataController@getMaterias');

//Route::get('dropdownlist','DataController@getCategorias');
Route::get('dropdown/getmaterias/{id}','ExpedienteCivilController@getMaterias');

Route::get('expedientecivil/{expedientecivil}/actorhumano','ActorHumanoController@index');
Route::post('expedientecivil/{expedientecivil}/actorhumano','ActorHumanoController@store');
Route::post('expedientecivil/{expedientecivil}/actorhumanoupdate','ActorHumanoController@update');
Route::delete('expedientecivil/{expedientecivil}/actorhumanodelete/{id}', 'ActorHumanoController@destroy');

Route::post('expedientecivil/{expedientecivil}/representantelegal','RepresentanteLegalController@store');
Route::get('expedientecivil/{expedientecivil}/representantelegal/{id}','RepresentanteLegalController@show');

Route::get('expedientecivil/{expedientecivil}/actorideal','ActorIdealController@index');
Route::post('expedientecivil/{expedientecivil}/actorideal','ActorIdealController@store');
Route::post('expedientecivil/{expedientecivil}/actoridealupdate','ActorIdealController@update');
Route::delete('expedientecivil/{expedientecivil}/actoridealdelete/{id}', 'ActorIdealController@destroy');

Route::get('expedientecivil/{expedientecivil}/demandadohumano','DemandadoHumanoController@index');
Route::post('expedientecivil/{expedientecivil}/demandadohumano','DemandadoHumanoController@store');
Route::post('expedientecivil/{expedientecivil}/demandadohumanoupdate','DemandadoHumanoController@update');
Route::delete('expedientecivil/{expedientecivil}/demandadohumanodelete/{id}', 'DemandadoHumanoController@destroy');

Route::get('expedientecivil/{expedientecivil}/demandadoideal','DemandadoIdealController@index');
Route::post('expedientecivil/{expedientecivil}/demandadoideal','DemandadoIdealController@store');
Route::post('expedientecivil/{expedientecivil}/demandadoidealupdate','DemandadoIdealController@update');
Route::delete('expedientecivil/{expedientecivil}/demandadoidealdelete/{id}', 'DemandadoIdealController@destroy');

Route::get('expedientecivil/{expedientecivil}/decreto','DecretoController@index');
Route::post('expedientecivil/{expedientecivil}/decreto','DecretoController@store');
Route::post('expedientecivil/{expedientecivil}/decretoupdate','DecretoController@update');
Route::delete('expedientecivil/{expedientecivil}/decretodelete/{id}', 'DecretoController@destroy');

// Route::get('/', function() {
//     return view('actorhumano.actorhumano');
// });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
