<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getCategorias', 'APIController@getCategorias');
Route::get('getMaterias', 'APIController@getMaterias');
Route::get('getTipoDocumento', 'APIController@getTipoDocumento');

Route::apiResource('tipodocumento', 'APIController');

//Route::resource('actor_humanos', 'ActorHumanoController');

//Route::get('api/actorhumano/{expedientecivil}','ActorHumanoController@index');
