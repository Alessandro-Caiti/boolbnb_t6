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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('delete_comment_action/{id}', function($id){
//
//     $status_Id = Input::get('status_Id');
//     print_r($status_Id);
//     exit();
//
//     return Redirect::back();
// });


Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::prefix('user')
    ->name('user.')
    ->namespace('User')
    ->middleware('auth')
    ->group(function() {
        Route::resource('places' , 'PlaceController');
        // Route::resource('photos' , 'PhotoController');
        // Route::resource('categories' , 'CategoryController');
        // Route::resource('tags' , 'TagController');
        // Route::resource('users' , 'UserController');
    });

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search')->name('search');
