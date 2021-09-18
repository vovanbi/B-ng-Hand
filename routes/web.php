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

//auth
Route::group(['namespace'=>''],function (){
    Route::get('dang-ky','App\Http\Controllers\Auth\RegisterController@getRegister')->name('get.register');
    Route::post('dang-ky','App\Http\Controllers\Auth\RegisterController@postRegister')->name('post.register');
    Route::get('dang-nhap','App\Http\Controllers\Auth\LoginController@getLogin')->name('get.login');
    Route::post('dang-nhap','App\Http\Controllers\Auth\LoginController@postLogin')->name('post.login');
    Route::get('dang-xuat','App\Http\Controllers\Auth\LoginController@getLogout')->name('get.logout');  
    Route::get('auth/social', 'App\Http\Controllers\Auth\LoginController@show')->name('social.login');
    Route::get('oauth/{driver}', 'App\Http\Controllers\Auth\LoginController@redirectToProvider')->name('social.oauth');
    Route::get('oauth/{driver}/callback', 'App\Http\Controllers\Auth\LoginController@handleProviderCallback')->name('social.callback');

    // Route::get('xac-nhan-tai-khoan','App\Http\Controllers\Auth\RegisterController@verifyAccount')->name('user.verify.account');
});

//user
Route::group(['prefix'=>'user','middleware'=>'App\Http\Middleware\CheckLoginUser'],function (){
    Route::get('tai-khoan','App\Http\Controllers\UserController@getUser')->name('get.user');
    Route::get('tai-khoan/da-mua','App\Http\Controllers\UserController@postUser')->name('get.detail.order');
    Route::get('cai-dat','App\Http\Controllers\UserController@getSetting')->name('get.user.setting');
    Route::post('updateInfo','App\Http\Controllers\UserController@updateInfo')->name('updateInfo');
    Route::post('updatePassword','App\Http\Controllers\UserController@updatePassword')->name('updatePassword');
    Route::get('delete/{id}','App\Http\Controllers\UserController@destroy')->name('get.user.destroy');

   
});

   
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

//product

Route::get('danh-muc/{slug}','App\Http\Controllers\CategoryController@getListProduct')->name('get.product.category');
Route::post('san-pham/search', 'App\Http\Controllers\CategoryController@getSearch')->name('get.search.product');
Route::get('san-pham', 'App\Http\Controllers\CategoryController@getListProduct')->name('get.list.product');
Route::get('san-pham/{slug}', 'App\Http\Controllers\ProductDetailController@productDetail')->name('get.detail.product');

Route::get('san-pham/sold/{type}', 'App\Http\Controllers\CategoryController@getType')->name('get.color.blue.product');
Route::get('san-pham/hot/{type}', 'App\Http\Controllers\CategoryController@getType')->name('get.color.red.product');
Route::get('san-pham/sale/{type}', 'App\Http\Controllers\CategoryController@getType')->name('get.color.green.product');
Route::get('san-pham/default/{type}', 'App\Http\Controllers\CategoryController@getType')->name('get.color.warning.product');

Route::get('san-pham/other/{type}', 'App\Http\Controllers\CategoryController@getType')->name('get.other.product');
Route::get('san-pham/male/{type}', 'App\Http\Controllers\CategoryController@getType')->name('get.male.product');
Route::get('san-pham/female/{type}', 'App\Http\Controllers\CategoryController@getType')->name('get.female.product');

Route::get('view-san-pham/{id}', 'App\Http\Controllers\HomeController@viewProduct')->name('get.view.product');
Route::get('like-san-pham/{id}', 'App\Http\Controllers\HomeController@LikeProduct')->name('get.like.product');


//article
Route::get('bai-viet','App\Http\Controllers\ArticleController@getArticle')->name('get.list.article');
Route::get('bai-viet/{slug}','App\Http\Controllers\ArticleController@getDetail')->name('get.detail.article');

//info
// Route::get('lien-he','ContactController@getContact')->name('get.contact');
// Route::post('lien-he','ContactController@saveContact');
Route::view('/ve-chung-toi', 'info.aboutUs')->name('get.aboutUs');
Route::view('/ho-tro-khach-hang', 'info.support')->name('get.support');
Route::view('/lien-he', 'info.contact')->name('get.contact');


//cart
Route::prefix('')->group(function (){
    Route::get('/add/{id}','App\Http\Controllers\ShoppingCartController@addProduct')->name('add.cart');
    Route::get('/delete/{id}','App\Http\Controllers\ShoppingCartController@deleteProduct')->name('delete.cart');
    Route::get('/update/{id}','App\Http\Controllers\ShoppingCartController@updateProduct')->name('update.cart');
    Route::get('/gio-hang','App\Http\Controllers\ShoppingCartController@getListShoppingCart')->name('get.list.cart');
    Route::get('/mua-ngay/{id}/','App\Http\Controllers\ProductDetailController@buyNow')->name('get.buy.now');
    Route::get('/destroy/','App\Http\Controllers\ShoppingCartController@destroyCart')->name('destroy.cart');

   });
Route::group(['prefix'=>'gio-hang','middleware'=>'App\Http\Middleware\CheckLoginUser'],function (){
    Route::get('/thanh-toan','App\Http\Controllers\ShoppingCartController@getFormPayment')->name('get.form.pay');
    Route::post('/thanh-toan','App\Http\Controllers\ShoppingCartController@savePayment')->name('save.form.pay');
    Route::get('/thanh-toan-online','App\Http\Controllers\ShoppingCartController@getFormPayOnline')->name('get.form.pay.online');
    Route::post('/thanh-toan-online','App\Http\Controllers\ShoppingCartController@savePayOnline');

});
//lien he

Route::get('lien-he','App\Http\Controllers\ContactController@getContact')->name('get.contact');
    Route::post('lien-he','App\Http\Controllers\ContactController@saveContact');
//rating
Route::group(['prefix'=>'rating'],function (){
    Route::post('/danh-gia/{id}','App\Http\Controllers\RatingController@saveRating')->name('save.form.rating');
});


