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

Route::group(
    [
        'prefix' => '/',
        'middleware' => ['web'],
        'https' => true,
        'as' => 'painel.auth.'
    ],
    function () {
        Auth::routes();
    }
);

Route::group(
    [
        'prefix' => '/',
        'middleware' => ['web', 'auth:aduser'],
        'https' => true,
        'as' => 'painel.'
    ],
    function () {
        Route::resource('email', 'EmailController');
        Route::resource('mailtemplate', 'MailTemplateController');
        Route::get(
            'api/getMailTemplate/{id}',
            'ApiController@getMailTemplate'
        )->name('api.getMailTemplate');
        Route::get('/', 'PainelController@index')->name('index');
    }
);
