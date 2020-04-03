<?php
use Carbon\Carbon;
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

Route::group(['prefix' => 'admin',  'namespace' => 'Admin'], function () {

    Route::get('/register', 'SpectrumAdminController@create');
    Route::post('/register', 'SpectrumAdminController@store')->name('admin/register');

    Route::get('/login', 'SpectrumAdminController@show_login_page')->name('admin/login');
    Route::post('/login', 'SpectrumAdminController@login');

    Route::get('/dashboard', 'SpectrumAdminController@index')->name('admin/dashbard');

});
