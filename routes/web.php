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
// Auth::routes();
Route::group(['prefix' => 'admin',  'namespace' => 'Admin'], function () {

    // Authentication Controller Goes Here
    Route::group(['namespace' => 'Auth'], function () {
        Route::get('/register', 'SpectrumAdminAuthController@create');
        Route::post('/register', 'SpectrumAdminAuthController@store')->name('admin/register');

        Route::get('/login', 'SpectrumAdminAuthController@show_login_page')->name('admin/login');
        Route::post('/login', 'SpectrumAdminAuthController@login');

        
        Route::post('/logout', 'SpectrumAdminAuthController@logout')->name('admin.logout');
    });

    // Dashboard Conroller goes Here
    Route::get('/dashboard', 'SpectrumAdminDashboardController@index')->name('admin/dashbard');
    Route::get('/manage-access-keys', 'SpectrumAdminDashboardController@show_access_keys');

    Route::get('/audit-logs', 'SpectrumAdminDashboardController@audit_logs');

    // Notification Controller Goes Here
    Route::resource('/notification', 'AdminNotificationController');

    // License Controller Goes Here
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
});



