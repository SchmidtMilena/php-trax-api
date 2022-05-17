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

    //middleware can be also applied in controllers
Route::middleware(['auth:api'])->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    //////////////////////////////////////////////////////////////////////////
/// Mock Endpoints To Be Replaced With RESTful API.
/// - API implementation needs to return data in the format seen below.
/// - Post data will be in the format seen below.
/// - /resource/assets/traxAPI.js will have to be updated to align with
///   the API implementation
//////////////////////////////////////////////////////////////////////////

// Mock endpoint to get all cars for the logged in user

    Route::get('/cars', 'CarController@index');


// Mock endpoint to add a new car.

    Route::post('car', 'CarController@store');


// Mock endpoint to get a car with the given id

    Route::get('car/{car}', 'CarController@show')->middleware(['can:show,car']);


// Mock endpoint to delete a car with a given id

    Route::delete('car/{car}', 'CarController@destroy');


// Mock endpoint to get the trips for the logged in user

    Route::get('/trips', 'TripController@index');


// Mock endpoint to add a new trip.

    Route::post('trip', 'TripController@store');
});





