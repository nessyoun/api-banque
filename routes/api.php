<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ClientController;


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

Route::get('/findClient','ClientController@index');
Route::get('/creerClient','ClientController@create');
Route::get('/supprimerClient','ClientController@destroy');
Route::post('/verser','CompteController@verser');
Route::get('/login','CompteController@store');
Route::get('/consulterSolde','CompteController@show');
Route::get('/creerCompte','CompteController@create');
Route::post('/supprimerCompte','CompteController@destroy');




Route::group(['middleware' => ['cors']], function () {
    Route::get('/findClient','ClientController@index');
Route::get('/creerClient','ClientController@create');
Route::delete('/supprimerClient','ClientController@destroy');
Route::post('/verser','CompteController@verser');
Route::get('/login','CompteController@store');
Route::get('/consulterSolde','CompteController@show');
Route::get('/creerCompte','CompteController@create');
Route::post('/supprimerCompte','CompteController@destroy');
});




?>