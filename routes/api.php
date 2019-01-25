<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::namespace('Api')->group(function() {
	Route::get('/media', 'MediaController@index')->name('media.index');	
	Route::get('/media/{media}', 'MediaController@show')->name('media.show');	

	Route::get('/judete', 'CountiesController@index');
	Route::get('/judete/{county}', 'CountiesController@show');

	Route::middleware(['auth'])->group(function() {
		Route::post('/media', 'MediaController@store')->name('media.store');
		Route::delete('/media/{media}', 'MediaController@destroy')->name('media.destroy');
	});
});



	
	

// Route::get('zone', 'Api\ZoneController@show');
