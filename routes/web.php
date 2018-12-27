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



Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/register', 'customAuth@register')->name('Register');
Route::post('/login', 'customAuth@login')->name('LogIn');

Route::get('/logout', 'customAuth@logout')->name('LogOut');
Route::get('/loggedin', 'customAuth@loggedin')->name('LoggedIn');

Route::resource('users', 'userController');

Route::resource('exercices', 'exerciceController'); 

Route::resource('sessions', 'sessionController'); 
