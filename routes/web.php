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

Route::get('/', function () {
    return view('welcome');
});

//ini karena ada auth routesnya jadi otomatis nyambung
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/register', ['uses'=>'Auth\RegisterController@create', 'as'=>'register']);
Route::get('/users', 'UsersController@index')->name('users')->middleware('auth');
// Route::get('/users/profile', function(){
//     return view('users/profile');
// });
Route::get('/profile', 'UsersController@profile')->name('profile');
Route::get('/profile/{users}', 'UsersController@show');
// Route::get('/app', 'UsersController@show');