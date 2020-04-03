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

// Route::get('/home', 'HomeController@index')->name('home');
Route::post('/register', ['uses'=>'Auth\RegisterController@create', 'as'=>'register']);
Route::get('/users', 'UsersController@index')->name('users')->middleware('auth');

//USERS
//nampilin data user di profile page
Route::get('/profile/{users}', 'UsersController@show')->name('profile')->middleware('auth');
//nampilin data user di edit page
Route::get('/edit/{user_id}', 'UsersController@profile_edit')->middleware('auth');
//nampilin data user di confirm page
Route::get('/confirm/{user_id}', 'UsersController@profile_edit')->middleware('auth');
//lempar data user ke confirm page
Route::post('/confirm/{user_id}', 'UsersController@profile_edit')->name('confirm')->middleware('auth');
//lempar data ke success page
Route::post('/success/{user_id}', 'UsersController@profile_edit_success')->name('editusersuccess')->middleware('auth');
//delete user
Route::post('/deleteuser','UsersController@confirmdelete')->name('deletesuccess');

//PRODUCTS
//submit new
Route::get('/submit', 'ProductsController@submit')->name('submitnew')->middleware('auth');
Route::post('/submitconfirm', 'ProductsController@submitconfirm')->name('submitconfirm')->middleware('auth');
Route::post('/submitsuccess', 'ProductsController@submitsuccess')->name('submitsuccess')->middleware('auth');

//all products
Route::get('/all', 'ProductsController@allproducts')->name('allproducts')->middleware('auth');
Route::post('/deleteproduct','ProductsController@confirmdeleteproduct')->name('deleteproductsuccess')->middleware('auth');

//edit product
Route::get('/editproduct/{product_id}', 'ProductsController@editproduct')->middleware('auth');
Route::get('/editconfirm/{product_id}', 'ProductsController@editproduct')->middleware('auth');
Route::post('/editconfirm/{product_id}', 'ProductsController@editproduct')->name('editconfirm')->middleware('auth');
Route::post('/editsuccess/{product_id}', 'ProductsController@editsuccess')->name('editproductsuccess')->middleware('auth');

//your products
// Route::get('/your', 'ProductsController@yourproducts')->name('yourproducts');

//homeproductdisplay
Route::get('/home', 'ProductsController@productsdisplay')->name('home')->middleware('auth');
Route::post('/home', 'ProductsController@productsdisplay')->middleware('auth');


//TRANSACTIONS
//submit new
Route::get('/submitnew','TransactionController@submittrans')->name('newtrans')->middleware('auth');
Route::post('/submittransconfirm','TransactionController@submitconfirm')->name('submittransconfirm')->middleware('auth');
Route::post('submittranssuccess','TransactionController@submittranssuccess')->name('submittranssuccess')->middleware('auth');
//all transaction
Route::get('/alltrans', 'TransactionController@display')->name('alltrans')->middleware('auth');
//transaction detail
Route::get('/detail/{transaction_id}', 'TransactionController@detail')->name('detailtrans')->middleware('auth');
Route::post('/deletetrans', 'TransactionController@delete')->name('deletetrans')->middleware('auth');
//transaction edit
Route::get('/edittrans/{transaction_id}', 'TransactionController@edit')->name('edittrans')->middleware('auth');
Route::get('/edittransconfirm/{transaction_id}', 'TransactionController@edit')->middleware('auth');
Route::post('/edittransconfirm/{transaction_id}', 'TransactionController@edit')->name('edittransconfirm')->middleware('auth');
Route::post('/edittranssuccess/{transaction_id}', 'TransactionController@editsuccess')->name('edittranssuccess')->middleware('auth');

//TYPES
Route::get('/typelist','TypesController@show')->name('typelist')->middleware('auth');
Route::post('/typelist', 'TypesController@add')->name('addtype')->middleware('auth');

Route::get('/error','ProductsController@error')->name('error')->middleware('auth');

//AJAX
Route::get('/getproductcount/{transaction_id}', 'TransactionController@total')->name('getproductcount')->middleware('auth');