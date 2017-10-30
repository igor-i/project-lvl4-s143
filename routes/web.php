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
//    \Log::debug('Here is some debug information');
    if (Auth::check()) {
        return redirect()->route('tasks.index');
    } else {
        return redirect()->route('welcome.index');
    }
});

Route::get('/welcome', function () {
//    \Log::debug('Here is some debug information');
    if (Auth::check()) {
        return redirect()->route('tasks.index');
    } else {
        return view('welcome');
    }
})->name('welcome.index');

Auth::routes();

Route::get('/tasks', 'TasksController@index')->name('tasks.index');

Route::get('/users', 'UsersController@index')->name('users.index');

Route::get('/profile', 'ProfileController@index')->name('profile.edit');

Route::post('/profile', 'ProfileController@update')->name('profile.update');

Route::delete('/profile', 'ProfileController@destroy')->name('profile.destroy');
