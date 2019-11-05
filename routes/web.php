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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('user', 'UserController');
Route::resource('frecuencia', 'FrecuenciaController');
Route::resource('checklist', 'CheckListController');
Route::resource('auditor','AuditorController');
Route::resource('pregunta', 'PreguntaController');
Route::resource('subpregunta','SubPreguntaController');
Route::resource('imprimir','PreguntaImprimirController');
Route::get('imprimirPdf','PdfController@pdf')->name('pdf');
Route::get('imprimirPdfInfo','PdfController@pdfInfo')->name('pdfInfo');
Route::post('mail','MailController@send')->name('mail.create');
Route::get('mail','MailController@create')->name('mail'); 

Route::get('subp/{id}','SubPreguntaController@create')->name('subp');
Route::get('apertura','RespuestaController@apertura');
Route::get('precierre','RespuestaController@precierre');
Route::get('Check/{id}','RespuestaController@getCheck')->name('Check');
Route::get('show/{id}','RespuestaController@show')->name('show');
Route::get('indexHome','RespuestaController@indexHome')->name('indexHome');
Route::post('store','RespuestaController@store')->name('store');

Route::get('reporte','ReportesController@index')->name('reporte');
