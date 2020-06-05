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

Route::namespace('API')->prefix('v1')->middleware('ApiKey')->group(function() {
        Route::get('test_connection', 'SpectrumApiController@index');
        Route::post('register_device', 'SpectrumApiController@store');
        Route::post('register_user', 'SpectrumApiController@update');
        Route::get('notifications', 'SpectrumApiController@notification')->name('api.notification');
        Route::get('download_link/{book_id}', 'SpectrumApiController@downloadBooks')->name('api.download_link');
        // Route::get('image_download_link/{book_id}', 'SpectrumApiController@downloadBooks')->name('api.stream_download');
});
