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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::group(['middleware' => 'api'], function(){
    Route::group(['prefix' => 'v1'], function() {
        Route::group(['prefix' => 'users'], function() {
            Route::post('/register', 'API\V1\UserController@register');
            Route::post('/signin', 'API\V1\UserController@login');
            Route::post('/logout', 'API\V1\UserController@logout');
        });

        Route::group(['prefix' => 'todos'], function() {
            Route::get('/', 'API\V1\ToDoController@index');
            Route::post('add', 'API\V1\ToDoController@store');
            Route::get('show/{id}', 'API\V1\ToDoController@show');
            Route::PATCH('update/{id}', 'API\V1\ToDoController@update');
            Route::delete('delete/{id}', 'API\V1\ToDoController@destroy');
        });

    });
});