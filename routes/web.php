<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('index');
Route::any('/add', 'HomeController@add')->name('add');
Route::any('/add_school', 'HomeController@add_school')->name('add_school');
Route::any('/edit/{id}', 'HomeController@edit')->name('edit');
Route::any('/delete/{id}', 'HomeController@delete')->name('delete');
