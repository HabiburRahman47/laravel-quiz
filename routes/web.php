<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);
Route::group(['middleware' => ['auth', 'get.menu']], function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    });
    Route::get('/test', function () {
        return view('admin.notifications.modals');
    });
    Route::name('web.admin.')->prefix("web/admin")->namespace('Web\Admin\Property')->group(function () {
        //property_type
        Route::patch('property-types/{id}/trash', 'PropertyTypeController@trash');
        Route::patch('property-types/{id}/restore', 'PropertyTypeController@restore');
        Route::resource('property-types', 'PropertyTypeController');

//        //property
//        Route::patch('property/{id}/trash', 'Property\PropertyController@trash');
//        Route::patch('property/{id}/restore', 'PropertyController@restore');
//        Route::apiResource('property', 'PropertyController');
    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


