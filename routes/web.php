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
Route::get('/', 'EventController@index')->name('index');

Route::get('eventos', 'EventController@calendario')->name('events.index');
Route::post('eventos', 'EventController@adicionar')->name('events.add');

Route::get('eventos/{id}', 'EventController@events')->name('events.show');
Route::post('eventos/{id}', 'EventController@edit')->name('events.edit');
Route::get('eventos/aprovar/{id}', 'EventController@aprovar')->name('events.aprovar');
Route::get('eventos/presenca/{id}', 'EventController@presenca')->name('events.presenca');
Route::get('eventos/deletarinscricao/{id}', 'EventController@deletarInscricao')->name('events.deletarIns');
Route::get('eventos/deletar/{id}', 'EventController@deletar')->name('events.deletar');

Route::post('eventos/{id}/inscricoes', 'InscricaoController@inscricoes')->name('events.inscricoes');

Route::get('users/{id}', 'UserController@index')->name('user.index');
Route::post('users/{id}', 'UserController@edit')->name('user.edit');

Route::resource('pdf', 'ParticipanteController');
Route::get('pdf/download/{id}', 'ParticipanteController@pdfexport');

Auth::routes();

Auth::routes(['verify' => true]);

Route::get('profile', function () {
    return '<h1>This is profile page</h1>';
})->middleware('verified');

Route::get('/home', 'HomeController@index')->name('home');

