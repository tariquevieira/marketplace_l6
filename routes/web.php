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
Route::get
Route::post
Route::put
Route::patch
Route::delete
Router::options

*/

Route::get('/','HomeController@index')->name('home');

Route::get('/product/{slug}','HomeController@single')->name('product.single');

Route::get('/category/{slug}','CategoryController@index')->name('category.single');

Route::get('/store/{slug}','StoreController@index')->name('store.single');

Route::prefix('cart')->name('cart.')->group(function(){
	Route::get('/','CartController@index')->name('index');
	Route::post('add','CartController@add')->name('add');
	Route::get('remove/{slug}','CartController@remove')->name('remove');
	Route::get('cancel','CartController@cancel')->name('cancel');
});
Route::prefix('checkout')->name('checkout.')->group(function(){
	Route::get('/','CheckoutController@index')->name('index');
	Route::post('/proccess','CheckoutController@proccess')->name('proccess');
	Route::get('/thanks','CheckoutController@thanks')->name('thanks');
});

Route::group(['middleware'=>['auth']],function(){
	Route::prefix('admin')->namespace('Admin')->group(function(){
	Route::prefix('stores')->group(function(){
		Route::get('/','StoreController@index')->name('admin.stores.index');
		Route::get('/create','StoreController@create')->name('admin.stores.create');
		Route::post('/store','StoreController@store')->name('admin.stores.store');
		Route::get('/{store}/edit','StoreController@edit')->name('admin.stores.edit');
		Route::post('/update/{store}','StoreController@update')->name('admin.stores.update');
		Route::get('/destroy/{store}','StoreController@destroy')->name('admin.stores.destroy');

	});
	Route::resource('products','ProductController');
	Route::resource('categories','CategoryController');
	Route::post('photos/remove/','ProductPhotoController@removePhoto')->name('photo.remove');
});

});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
