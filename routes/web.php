<?php

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

Route::group(['prefix' => 'todos'], function() {
    Route::get('/', 'LoginController@login')->name('login.form');
    Route::post('/login', 'LoginController@loginSubmit')->name('login.submit');
    Route::get('/register', 'LoginController@register')->name('register.form');
    Route::post('/register/submit', 'LoginController@registerSubmit')->name('register.submit');
    Route::get('/dashboard', 'ToDoController@index')->name('todo.list');
    Route::get('/add', 'ToDoController@create')->name('todo.create');
    Route::post('/create', 'ToDoController@store')->name('todo.store');
    Route::get('/edit/{id}', 'ToDoController@edit')->name('todo.edit');
    Route::post('/update', 'ToDoController@update')->name('todo.update');
    Route::get('/delete/{id}', 'ToDoController@destroy')->name('todo.delete');
});