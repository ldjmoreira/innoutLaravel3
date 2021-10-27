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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
// - 8000/api/auth/...
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::post('validateToken', 'AuthController@validateToken');
    

});

Route::group(['middleware' => ['apiJwt']], function(){
    

    Route::get('days_records/index', 'Day_recordsController@index');
    Route::get('days_records/innout', 'Day_recordsController@innout');
    Route::post('days_records/innout2', 'Day_recordsController@innout2');
    
    Route::get('monthly_report/index', 'Monthly_reportController@index')->middleware('check.admin');

    Route::get('manager_report/index', 'Manager_reportController@index')->middleware('check.admin');

    Route::get('monthly_report/index/hours', 'monthly_reportController@indexHour')->middleware('check.admin');

    Route::get('users/index', 'UserController@index')->middleware('check.admin');
//
    Route::get('/admin/save/user/edit/{id}', 'Save_userController@edit')->middleware('check.admin');

    Route::put('/admin/save/user/update/{id}', 'Save_userController@update')->middleware('check.admin');

    Route::delete('/admin/save/user/delete/{id}', 'Save_userController@delete')->middleware('check.admin');

    Route::get('politico/index', 'PoliticoController@index')->middleware('check.admin');
    Route::post('politico/create', 'PoliticoController@create')->middleware('check.admin');
    Route::get('politico/{id}/edit', 'PoliticoController@edit')->middleware('check.admin');
    Route::put('politico/update/{id}', 'PoliticoController@update')->middleware('check.admin');
    Route::delete('politico/delete/{id}', 'PoliticoController@delete')->middleware('check.admin');

    Route::get('reclamacao/index', 'ReclamacaoController@index');
    Route::post('reclamacao/create', 'ReclamacaoController@create');
    Route::get('reclamacao/idpolitico', 'ReclamacaoController@getIdPolitico');
    Route::get('reclamacao/{id}/edit', 'ReclamacaoController@edit');
    Route::put('reclamacao/update/{id}', 'ReclamacaoController@update');
    Route::delete('reclamacao/delete/{id}', 'ReclamacaoController@delete');

    Route::get('reclamacao/{id}/show', 'ReclamacaoController@show');


});