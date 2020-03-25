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

//USERS
//nampilin data user di profile page
Route::get('/profile/{users}', 'UsersController@show');
//nampilin data user di edit page
Route::get('/edit/{users}', 'UsersController@profile_edit');
//nampilin data user di confirm page
Route::get('/confirm/{user_id}', 'UsersController@profile_edit');
//lempar data user ke confirm page
Route::post('/confirm/{user_id}', 'UsersController@profile_edit')->name('confirm');
//lempar data ke success page
Route::post('/success/{user_id}', 'UsersController@profile_edit_success')->name('editsuccess');
//delete user
Route::post('/delete','UsersController@confirmdelete')->name('deletesuccess');



//PRODUCTS
//submit new
Route::get('/submit', 'ProductsController@submit')->name('submitnew');
Route::post('/submitconfirm', 'ProductsController@submitconfirm')->name('submitconfirm');
Route::post('/submitsuccess', 'ProductsController@submitsuccess')->name('submitsuccess');

//all products
Route::get('/all', 'ProductsController@allproducts')->name('allproducts');

//your products
Route::get('/your', 'ProductsController@yourproducts')->name('yourproducts');