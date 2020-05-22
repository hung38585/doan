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
// Authenticate
Auth::routes(); 
Route::group(array('prefix'=>'admin','namespace'=>'Auth'),function(){
	// Xu ly Login Logut ADMIN
	Route::get('/login', 'LoginController@showAdminLoginForm');
	Route::post('/login', 'LoginController@adminLogin');
	// Admin ko co register de tam day test thu
	Route::get('/register', 'RegisterController@showAdminRegisterForm');
	Route::post('/register', 'RegisterController@createAdmin');
	Route::get('/logout', 'LoginController@adminLogout')->name('admin.logout');
});
// -------------------------------------------------------------------------------
//Dinh Dang Lai Destroy
Route::group(array('namespace'=>'Admin','middleware'=>'auth:admin'),function(){
	Route::delete('about_delete_modal', 'AboutController@destroy')->name('about_delete_modal');
	Route::delete('brand_delete_modal', 'BrandController@destroy')->name('brand_delete_modal');
	Route::delete('category_delete_modal', 'CategoryController@destroy')->name('category_delete_modal');
	Route::delete('product_delete_modal', 'ProductController@destroy')->name('product_delete_modal');
	Route::delete('slide_delete_modal', 'SlideController@destroy')->name('slide_delete_modal');
	Route::delete('product_detail_delete_modal', 'ProductDetailController@destroy')->name('product_detail_delete_modal');
});
//End Destroy
// -------------------------------------------------------------------------------
Route::group(array('prefix'=>'admin','namespace'=>'Admin','middleware'=>'auth:admin'),function(){
	Route::resource('about','AboutController');
	Route::resource('brand','BrandController');
	Route::resource('category','CategoryController');
	Route::resource('comment','CommentController'); 
	Route::resource('order','OrderController');
	Route::resource('orderdetail','OrderDetailController');
	Route::resource('product','ProductController');
	Route::resource('productdetail','ProductDetailController');
	Route::resource('slide','SlideController');
	Route::resource('store','StoreController');
	Route::get('/home', 'HomeController@index')->name('admin.home');
});
// -------------------------------------------------------------------------------
// function ajax
Route::group(array('namespace'=>'Admin','middleware'=>'auth:admin'),function(){
	Route::get('/setvalue', 'ProductController@setvalue');
	Route::get('/getcolor', 'ProductController@getcolor');
	Route::get('/get_list_size', 'StoreController@getListSize');
	Route::get('/get_list_color', 'StoreController@getListColor');
	Route::get('/get_quantity', 'StoreController@getQuantity');
	Route::get('/get_quantity_order', 'OrderController@getQuantity');
	Route::post('/move_image', 'ProductController@moveImage');
	Route::post('/get_list_image', 'ProductController@getListImage');
	Route::post('/save_image', 'ProductController@saveImage');
	Route::post('/delete_image', 'ProductController@deleteImage');
	Route::post('/get_order_detail', 'OrderController@getOrderDetail');
}); 
Route::get('/get_color_in_productdetail', 'User\HomeController@getListColor');
Route::get('/get_quantity_in_productdetail', 'User\HomeController@getQuantity');
//END ajax
// -------------------------------------------------------------------------------
// END ADMIN
// -------------------------------------------------------------------------------

// USER 
// Thanh toan online return 
Route::get('/return-vnpay','User\CartController@return');
// End thanh toan online
// Xu ly Login Logout CLIENTS
Route::group(array('namespace'=>'Auth'),function(){
	Route::get('/login', 'LoginController@showClientLoginForm');
	Route::post('/login', 'LoginController@clientLogin');
	Route::get('/register', 'RegisterController@showClientRegisterForm');
	Route::post('/register', 'RegisterController@createClient');
	Route::get('/logout', 'LoginController@clientLogout')->name('logout');
});
// End Authenticate
// -------------------------------------------------------------------------------
Route::group(array('namespace'=>'User'),function(){
	//View client
	Route::get('/','HomeController@homepage');
	Route::post('/checkout','CartController@checkout');
	Route::post('/placeorder','CartController@placeorder');
	Route::resource('products','HomeController');
	Route::resource('cart','CartController');
	Route::get('/profile','ClientController@index');  
	Route::get('/feedback','ClientController@feedback');  
	//End view client
	// CART
	Route::patch('update-cart', 'CartController@update');
	Route::get('add-to-cart/{id}', 'CartController@addToCart');
	Route::delete('remove-from-cart', 'CartController@remove');
	// END CART
}); 
// -------------------------------------------------------------------------------
// END USER
//BOT MAN
//Route::match(['get', 'post'], '/botman', 'User\BotManController@handle');
