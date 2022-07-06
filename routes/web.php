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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);


});

Route::resource('categories', 'CategoryController');

Route::get('/category/{id}', 'CategoryController@show');

Route::resource('category', 'CategoryController');

Route::resource('home', 'HomeController');

Route::resource('documents', 'DocumentController');

Route::resource('my_documents', 'MyDocumentsController');

Route::resource('sug_category', 'CategorySuggestionController');

Route::resource('user_detail', 'UserDetailController');
