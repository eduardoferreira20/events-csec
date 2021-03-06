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

Route::get('pagamento','InscricaoController@pagamento')->name('pay');
Route::get('pagamento/{id}/listar','InscricaoController@lista')->name('lista.pay');
Route::get('pagamento/download/{namefile}','InscricaoController@baixando')->name('pay.comprovante');

Route::get('boleto/','BoletoController@boleto')->name('boleto');

Route::get('eventos/{id}/escolha','EventController@escolha')->name('events.escolha');
Route::post('eventos/{id}/inscricoes', 'InscricaoController@inscricoes')->name('events.inscricoes');

Route::get('users/{id}', 'UserController@index')->name('user.index');
Route::post('users/{id}', 'UserController@edit')->name('user.edit');

Route::get('certificado/download/{id}/usuario/{user_id}', 'ParticipanteController@pdfexport')->name('evento.pdf');

Route::get('send/certificado/{id}/evento/{user_id}/presenca', 'SendEmailUserController@send')->name('send.email');
Route::get('send/user/{id}/evento/{user_id}', 'SendEmailUserController@QR')->name('send.qr');

Route::get('qrcode/{id}/{user_id}','QRController@qrcode')->name('qr');

Auth::routes();

Auth::routes(['verify' => true]);

Route::get('profile', function () {
    return '<h1>This is profile page</h1>';
})->middleware('verified');

Route::get('/home', 'HomeController@index')->name('home');

