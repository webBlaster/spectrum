<?php

use Illuminate\Http\Request;
// use Symfony\Component\Routing\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('API')->prefix('v1')->group(function() {
    Route::group(['middleware' => 'ApiKey'], function () {
        Route::get('test_connection', 'SpectrumApiController@index');
        Route::post('register_device', 'SpectrumApiController@store');
        Route::post('register_user', 'SpectrumApiController@update');
        Route::get('notifications', 'SpectrumApiController@notification')->name('api.notification');
    });
    
    Route::get('download_link/{book_id}', 'SpectrumApiController@downloadBooks')->name('api.download_link');

        // Route::get('image_download_link/{book_id}', 'SpectrumApiController@downloadBooks')->name('api.stream_download');
});

Route::namespace('API')->prefix('v2')->group(function() {
    Route::group(['middleware' => 'ApiKey'], function () {
        Route::get('test_connection', 'SpectrumApiControllerV2@index');
        Route::post('register_device', 'SpectrumApiControllerV2@store');
        Route::post('register_user', 'SpectrumApiControllerV2@update');
        Route::get('notifications', 'SpectrumApiControllerV2@notification')->name('api.notification');
    });
    
    Route::get('download_link/{book_id}', 'SpectrumApiControllerV2@downloadBooks')->name('api.download_linkv2');

        // Route::get('image_download_link/{book_id}', 'SpectrumApiController@downloadBooks')->name('api.stream_download');
});
