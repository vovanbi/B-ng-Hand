<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminRatingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckLoginAdmin;
use App\Http\Middleware\CheckLoginUser;

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
    Route::get('dang-ky',[RegisterController::class,'getRegister'])->name('get.register');
    Route::post('dang-ky',[RegisterController::class,'postRegister'])->name('post.register');
    Route::get('dang-nhap',[LoginController::class,'getLogin'])->name('get.login');
    Route::post('dang-nhap',[LoginController::class,'postLogin'])->name('post.login');
    Route::get('dang-xuat',[LoginController::class,'getLogout'])->name('get.logout');  
    Route::get('auth/social', [LoginController::class,'show'])->name('social.login');
    Route::get('oauth/{driver}', [LoginController::class,'redirectToProvider'])->name('social.oauth');
    Route::get('oauth/{driver}/callback', [LoginController::class,'handleProviderCallback'])->name('social.callback');

    // Route::get('xac-nhan-tai-khoan','App\Http\Controllers\Auth\RegisterController@verifyAccount')->name('user.verify.account');
});

//user
Route::group(['prefix'=>'user','middleware'=> CheckLoginUser::class],function (){
    Route::get('tai-khoan',[UserController::class,'getUser'])->name('get.user');
    Route::get('tai-khoan/da-mua',[UserController::class,'postUser'])->name('get.detail.order');
    Route::get('cai-dat',[UserController::class,'getSetting'])->name('get.user.setting');
    Route::post('updateInfo',[UserController::class,'updateInfo'])->name('updateInfo');
    Route::post('updatePassword',[UserController::class,'updatePassword'])->name('updatePassword');
    Route::get('delete/{id}',[UserController::class,'destroy'])->name('get.user.destroy');
    Route::get('/detail/{id}',[UserController::class,'orderDetail'])->name('user.detail.order');

   
});

   
Route::get('/', [HomeController::class,'index'])->name('home');

//product

Route::get('danh-muc/{slug}',[CategoryController::class,'getListProduct'])->name('get.product.category');
Route::get('san-pham/search', [CategoryController::class,'getSearch'])->name('get.search.product');
Route::get('san-pham', [CategoryController::class,'getListProduct'])->name('get.list.product');
Route::get('san-pham/{slug}', [ProductDetailController::class,'productDetail'])->name('get.detail.product');

Route::get('san-pham/sold/{type}', [CategoryController::class,'getType'])->name('get.color.blue.product');
Route::get('san-pham/hot/{type}', [CategoryController::class,'getType'])->name('get.color.red.product');
Route::get('san-pham/sale/{type}', [CategoryController::class,'getType'])->name('get.color.green.product');
Route::get('san-pham/default/{type}', [CategoryController::class,'getType'])->name('get.color.warning.product');

Route::get('san-pham/other/{type}', [CategoryController::class,'getType'])->name('get.other.product');
Route::get('san-pham/male/{type}', [CategoryController::class,'getType'])->name('get.male.product');
Route::get('san-pham/female/{type}', [CategoryController::class,'getType'])->name('get.female.product');

Route::get('view-san-pham/{id}', [HomeController::class,'viewProduct'])->name('get.view.product');
Route::get('like-san-pham/{id}', [HomeController::class,'LikeProduct'])->name('get.like.product');


//article
Route::get('bai-viet',[ArticleController::class,'getArticle'])->name('get.list.article');
Route::get('bai-viet/{slug}',[ArticleController::class,'getDetail'])->name('get.detail.article');

//info
// Route::get('lien-he','ContactController::class,'getContact'])->name('get.contact');
// Route::post('lien-he','ContactController::class,'saveContact');
Route::view('/ve-chung-toi', 'info.aboutUs')->name('get.aboutUs');
Route::view('/ho-tro-khach-hang', 'info.support')->name('get.support');
Route::view('/lien-he', 'info.contact')->name('get.contact');


//cart
Route::prefix('')->group(function (){
    Route::get('/add/{id}',[ShoppingCartController::class,'addProduct'])->name('add.cart');
    Route::get('/delete/{id}',[ShoppingCartController::class,'deleteProduct'])->name('delete.cart');
    Route::get('/update/{id}',[ShoppingCartController::class,'updateProduct'])->name('update.cart');
    Route::get('/gio-hang',[ShoppingCartController::class,'getListShoppingCart'])->name('get.list.cart');
    Route::get('/mua-ngay/{id}/',[ProductDetailController::class,'buyNow'])->name('get.buy.now');
    Route::get('/destroy/',[ShoppingCartController::class,'destroyCart'])->name('destroy.cart');

   });
Route::group(['prefix'=>'gio-hang','middleware'=> CheckLoginUser::class],function (){
    Route::get('/thanh-toan',[ShoppingCartController::class,'getFormPayment'])->name('get.form.pay');
    Route::post('/thanh-toan',[ShoppingCartController::class,'savePayment'])->name('save.form.pay');
    Route::get('/thanh-toan-online',[ShoppingCartController::class,'getFormPayOnline'])->name('get.form.pay.online');
    Route::post('/thanh-toan-online',[ShoppingCartController::class,'savePayOnline']);

});
//lien he

Route::get('lien-he',[ContactController::class,'getContact'])->name('get.contact');
    Route::post('lien-he',[ContactController::class,'saveContact']);
//rating
Route::group(['prefix'=>'rating'],function (){
    Route::post('/danh-gia/{id}',[RatingController::class,'saveRating'])->name('save.form.rating');
});



//admin
Route::prefix('admin')->middleware(CheckLoginAdmin::class)->group(function() {
    Route::get('/',[AdminController::class,'index'])->name('admin.home');
 
    Route::group(['prefix' => 'category'],function (){
       Route::get('/',[AdminCategoryController::class,'index'])->name('admin.list.category');
       Route::get('/create',[AdminCategoryController::class,'create'])->name('admin.create.category');
       Route::post('/create',[AdminCategoryController::class,'store']);
       Route::get('/update/{id}',[AdminCategoryController::class,'edit'])->name('admin.edit.category');
       Route::post('/update/{id}',[AdminCategoryController::class,'update']);
       Route::get('/{action}/{id}',[AdminCategoryController::class,'action'])->name('admin.action.category');
    });
    Route::group(['prefix' => 'product'],function (){
        Route::get('/',[AdminProductController::class,'index'])->name('admin.list.product');
        Route::get('/create',[AdminProductController::class,'create'])->name('admin.create.product');
        Route::post('/create',[AdminProductController::class,'store']);
        Route::get('/update/{id}',[AdminProductController::class,'edit'])->name('admin.edit.product');
        Route::post('/update/{id}',[AdminProductController::class,'update']);
        Route::get('/{action}/{id}',[AdminProductController::class,'action'])->name('admin.action.product');

    });

    Route::group(['prefix'=>'order'], function (){
        Route::get('/', [AdminOrderController::class,'index'])->name('admin.list.order');
        Route::get('/detail/{id}',[AdminOrderController::class,'orderDetail'])->name('admin.detail.order');
        Route::get('/{action}/{id}',[AdminOrderController::class,'action'])->name('admin.action.order');
    });
    Route::group(['prefix'=>'article'], function (){
        Route::get('/', [AdminArticleController::class,'index'])->name('admin.list.article');
        Route::get('/create',[AdminArticleController::class,'create'])->name('admin.create.article');
        Route::post('/create',[AdminArticleController::class,'store']);
        Route::get('/update/{id}',[AdminArticleController::class,'edit'])->name('admin.edit.article');
        Route::post('/update/{id}',[AdminArticleController::class,'update']);
        Route::get('/{action}/{id}',[AdminArticleController::class,'action'])->name('admin.action.article');
    });
    
    //lien he
    Route::group(['prefix' => 'contact'],function (){
        Route::get('/',[AdminContactController::class,'index'])->name('admin.get.list.contact');
        Route::get('/{action}/{id}',[AdminContactController::class,'action'])->name('admin.action.contact');
    });
    Route::group(['prefix'=>'rating'], function (){
        Route::get('/', [AdminRatingController::class,'index'])->name('admin.list.rating');
        Route::get('/{action}/{id}',[AdminRatingController::class,'action'])->name('admin.action.rating');
    });
    Route::group(['prefix'=>'user'],function(){
        Route::get('/',[AdminUserController::class,'index'])->name('admin.list.user');
        Route::get('/{action}/{id}',[AdminUserController::class,'action'])->name('admin.action.user');
    });
});
