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
        return redirect()->route('tasks');
    } else {
        return redirect()->route('welcome');
    }
});

Route::get('/welcome', function () {
//    \Log::debug('Here is some debug information');
    if (Auth::check()) {
        return redirect()->route('tasks');
    } else {
        return view('welcome');
    }
})->name('welcome');

Auth::routes();

Route::get('/tasks', 'TasksController@index')->name('tasks');
