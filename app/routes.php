<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function() {
	return View::make('hello');
});

Route::get('/sheme', array('uses' => 'HomeController@schemes', 'as' => 'sheme'));
Route::get('/sheme/detalji-sheme/{shema_id}', array('uses' => 'SchemeController@details', 'as' => 'detalji-sheme'));
Route::get('/scheme/dekompozicija/{shema_id}', array('uses' => 'SchemeController@decomposition', 'as' => 'dekompozicija'));


Route::get('/edit', array('uses' => 'SchemeController@showAll', 'as' => 'edit'));
Route::get('/edit/{id}', array('uses' => 'SchemeController@editScheme', 'as' => 'editScheme'));
Route::post('edit/save/{id}', array('uses' => 'SchemeController@saveScheme', 'as' => 'save'));


Route::get('/new', array('uses' => 'SchemeController@newScheme', 'as' => 'new'));
Route::post('/new/save', array('uses' => 'SchemeController@saveNew', 'as' => 'saveNew'));
Route::post('/new/save-scheme', array('uses' => 'SchemeController@saveNewFinal', 'as' => 'saveNewFinal'));
