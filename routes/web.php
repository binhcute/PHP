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

Route::group(['middleware' => 'levellogin'],function(){
    //Server
    Route::resource('/admin','ServerController');
    Route::resource('/MyAccount','MyAccountController')->except('destroy');
    //Product
    Route::resource('/SanPham','ProductController');
    Route::get('/XoaSanPham/{SanPham}','ProductController@destroy');
    Route::put('/SanPham/disabled/{SanPham}','ProductController@disabled');
    Route::put('/SanPham/enabled/{SanPham}','ProductController@enabled');
    //Cate
    Route::resource('/LoaiSanPham','CategoryController');
    Route::get('/XoaLoaiSanPham/{LoaiSanPham}','CategoryController@destroy');
    Route::put('/LoaiSanPham/disabled/{LoaiSanPham}','CategoryController@disabled');
    Route::put('/LoaiSanPham/enabled/{LoaiSanPham}','CategoryController@enabled');
    //Article
    Route::resource('/BaiViet','ArticleController');
    Route::get('/XoaBaiViet/{LoaiBaiViet}','ArticleController@destroy');
    Route::put('/BaiViet/disabled/{BaiViet}','ArticleController@disabled');
    Route::put('/BaiViet/enabled/{BaiViet}','ArticleController@enabled');
    //Order
    Route::resource('/HoaDon','OrderController')->only('index','show');
    Route::put('/HoaDon/danggiao/{HoaDon}','OrderController@update_status_0');
    Route::put('/HoaDon/xuly/{HoaDon}','OrderController@update_status_1');
    Route::put('/HoaDon/thanhcong/{HoaDon}','OrderController@update_status_2');
    Route::put('/HoaDon/huy/{HoaDon}','OrderController@update_status_3');
    //Portfolio
    Route::resource('/NhaCungCap','PortfolioController');
    Route::get('/XoaNhaCungCap/{NhaCungCap}','PortfolioController@destroy');
    Route::put('/NhaCungCap/disabled/{NhaCungCap}','PortfolioController@disabled');
    Route::put('/NhaCungCap/enabled/{NhaCungCap}','PortfolioController@enabled');
    //CMT
    Route::resource('/BinhLuan','CommentController')->except('store');
    Route::put('/BinhLuan/disabled/{BinhLuan}','CommentController@disabled');
    Route::put('/BinhLuan/enabled/{BinhLuan}','CommentController@enabled');
    //Account
    Route::resource('/TaiKhoan','AccountController');
    Route::put('/TaiKhoan/disabled/{TaiKhoan}','AccountController@disabled');
    Route::put('/TaiKhoan/enabled/{TaiKhoan}','AccountController@enabled');

    //Slider
    
    // Route::resource('/Slider','SliderController');
    // Route::get('/XoaSlider/{Slider}','SliderController@destroy');
    // Route::put('/Slider/disabled/{Slider}','SliderController@disabled');
    // Route::put('/Slider/enabled/{Slider}','SliderController@enabled');
    //Menu
    //Event
    // //Logo
    // Route::resource('/Logo','LogoController');
    // Route::put('/Logo/disabled/{Logo}','LogoController@disabled');
    // Route::put('/Logo/enabled/{Logo}','LogoController@enabled');

    //API
    Route::get('/QuanLyAPI','ServerController@api');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('LoginCheck','CheckLoginController@check');

Route::resource('/DatHang','CheckOutController')->only('store');
Route::resource('/BinhLuan','CommentController')->only('store');
//Client
Route::resource('/','ClientController');

Route::get('/about_us','ClientController@about_us');
Route::get('/checkout','ClientController@check_out');
Route::get('/contact_us','ClientController@contact_us');
Route::get('/account','ClientController@my_account');

//Brand
Route::get('/brand/{brand}','ClientController@portfolio_list');
Route::get('/brand_detail','ClientController@portfolio_detail');

//Categories
Route::get('/categories_detail','ClientController@categories_detail');
Route::get('/product_categories/{product_categories}','ClientController@categories_list');

//Product
Route::get('/product','ClientController@product');
Route::get('/product/{product}','ClientController@product_detail');

//Article
Route::get('/article/{article_detail}','ClientController@article_detail');
Route::get('/article','ClientController@article');

//Update Account
Route::resource('/TaiKhoan','AccountController')->only('update');

//Cart
Route::resource('/cart','CartController')->only('index','store');
Route::get('/item-cart/{id}','CartController@AddCart');
Route::get('product/item-cart/{id}/{qty}','CartController@AddCartDT');
Route::get('/delete-item-cart/{id}','CartController@DeleteItemCart');
Route::get('/delete-item-list-cart/{id}','CartController@DeleteItemListCart');
Route::get('/save-item-list-cart/{id}/{qty}','CartController@SaveItemListCart');
// Route::post('/AddCartDT/{id}','CartController@AddCartDT');


//Fav???ite
Route::resource('/favorite','FavoriteController')->only('index');
Route::get('/item-favorite/{id}','FavoriteController@AddFavorite');
Route::get('/item-favorite-dt/{id}/{qty}','FavoriteController@AddFavoriteDT');
Route::get('/delete-item-favorite/{id}','FavoriteController@DeleteItemFavorite');
Route::get('/delete-item-list-favorite/{id}','FavoriteController@DeleteItemListFavorite');
Route::get('/save-item-list-favorite/{id}/{qty}','FavoriteController@SaveItemListFavorite');
