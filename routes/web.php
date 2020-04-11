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

Route::get('/', function(){
    // $date = Carbon::createFromDate(2020, 9, 4);
    // $date = Carbon::createFromTimeString('2020-09-04 12');
    // if(Carbon::now() > $date) {
    //     return "todate id";
    // }
    // return $date->format('Y-m-d h:i:s A');
    // // return $now->yesterday();
    return redirect('admin\dashboard');
});
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
        Route::get('/create-books', 'SpectrumBooksController@create');
    
    });


    Route::group(['namespace' => 'Developer'], function() {
        Route::resource('manage-apiaccess-keys', 'DeveloperApikeyController');
        Route::get('view-apiaccess-key', 'DeveloperApikeyController@showKey');
        Route::get('get-apiaccess-keys', 'DeveloperApikeyController@showAll');
    });


    Route::group(['prefix' => 'accounts',  'namespace' => 'Account'], function () {

        Route::get('/activate-accounts', 'SpectrumAccountController@index');
        Route::get('/load-accounts/{status}', 'SpectrumAccountController@create');
        Route::delete('/delete-account/{id}', 'SpectrumAccountController@destroy');
        Route::put('/activate-account/{id}', 'SpectrumAccountController@activate_account');
        Route::put('/alter-priviledge/{id}', 'SpectrumAccountController@switch_privilege');

    });
});



