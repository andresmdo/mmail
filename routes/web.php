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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $mails = App\Mail::all();

    return view('welcome', ['mails' => $mails]);
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Route::get('/home', 'HomeController@index')->name('home.index');
    Route::get('/mail/list', 'MailController@list')->name('mail.list');
    Route::get('/mail/add', 'MailController@add')->name('mail.add');
    Route::post('/mail/add', 'MailController@save')->name('mail.save');
    Route::put('/mail/update/{mail}', 'MailController@update')->name('mail.update');
    Route::get('/mail/{id}', 'MailController@view')->name('mail.view')->where('id', '[0-9]+');
    Route::get('/mail/{id}/edit', 'MailController@edit')->name('mail.edit')->where('id', '[0-9]+');

    Route::resource('home', 'HomeController');
    Route::resource('mails', 'MMailController');
});
