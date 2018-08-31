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

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('category', 'CategoryController');

/* Send the user to all views */
View::composer(['*'], function($view){
    $user = Auth::user();
    $view->with('user',$user);
});

Route::get('users', function(){
    $users = User::all();
    return view('users', compact('users'));
});
