<?php

use Spatie\GoogleCalendar\Event;

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

Route::get('/', 'AppointmentController@index')->name('appointment.index');
Route::get('/afspraken/nieuw', 'AppointmentController@new')->name('appointment.new');
Route::post('/appointment/create', 'AppointmentController@create')->name('appointment.create');

Route::get('/afspraken/{id}/wijzigen', 'AppointmentController@edit')->name('appointment.edit');
Route::post('/appointment/{id}/update', 'AppointmentController@update')->name('appointment.update');
Route::get('/appointment/{id}/destroy', 'AppointmentController@destroy')->name('appointment.destroy');

Route::get('/appointment/search', 'SearchController@search')->name('appointment.search');

Auth::routes();
