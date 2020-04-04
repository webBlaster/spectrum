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

    Route::get('/login', 'SpectrumAdminController@show_login_page')->name('admin/login')->middleware('guest:admin');
    Route::post('/login', 'SpectrumAdminController@login');

    Route::get('/dashboard', 'SpectrumAdminController@index')->name('admin/dashbard')->middleware('auth:admin');
    Route::get('/manage-access-keys', 'SpectrumAdminController@show_access_keys')->middleware('auth:admin');

    Route::get('/audit-logs', 'SpectrumAdminController@audit_logs');

});

Route::group(['prefix' => 'licenses', 'namespace' => 'License'], function() {

    Route::get('/user-licenses', 'SpectrumLicenseController@index');
    Route::get('/single-licenses', 'SpectrumLicenseController@index');
    Route::get('/group-licenses', 'SpectrumLicenseController@index');

    Route::get('/generated-licenses', 'SpectrumLicenseController@create');

    Route::get('/accounting-module', 'SpectrumLicenseController@view_Accounts');

});

Route::group(['prefix' => 'books', 'namespace' => 'Books'], function() {

    Route::get('/uploaded-books', 'SpectrumBooksController@index');

});

Route::group(['prefix' => 'accounts',  'namespace' => 'Account'], function () {

    Route::get('/activate-accounts', 'SpectrumAccountController@index');

});
