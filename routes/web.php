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
    Route::resource('/HoaDon','OrderController');
    Route::put('/HoaDon/danggiao/{HoaDon}','OrderController@update_status_0');
    Route::put('/HoaDon/xuly/{HoaDon}','OrderController@update_status_1');
    Route::put('/HoaDon/thanhcong/{HoaDon}','OrderController@update_status_2');
    Route::put('/HoaDon/huy/{HoaDon}','OrderController@update_status_3');
    //OrderDetail
    Route::resource('/ChiTietHoaDon','OrderDetailController');
    Route::put('/ChiTietHoaDon/disabled/{ChiTietHoaDon}','OrderDetailController@disabled');
    Route::put('/ChiTietHoaDon/enabled/{ChiTietHoaDon}','OrderDetailController@enabled');
    //Portfolio
    Route::resource('/NhaCungCap','PortfolioController');
    Route::get('/XoaNhaCungCap/{NhaCungCap}','PortfolioController@destroy');
    Route::put('/NhaCungCap/disabled/{NhaCungCap}','PortfolioController@disabled');
    Route::put('/NhaCungCap/enabled/{NhaCungCap}','PortfolioController@enabled');
    //CMT
    Route::resource('/BinhLuan','CommentController')->except('store');
    Route::put('/BinhLuan/disabled/{BinhLuan}','CommentController@disabled');
    Route::put('/BinhLuan/enabled/{BinhLuan}','CommentController@enabled');
    // //Favorite
    // Route::resource('/YeuThich','FavoriteController');
    // Route::put('/YeuThich/disabled/{YeuThich}','FavoriteController@disabled');
    // Route::put('/YeuThich/enabled/{YeuThich}','FavoriteController@enabled');
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

Route::resource('/CheckOut','CheckOutController');
Route::resource('/BinhLuan','CommentController')->only('store');
//Client
Route::resource('/','ClientController');

Route::get('/about_us','ClientController@about_us');
Route::get('/cart','ClientController@cart');
Route::get('/checkout','ClientController@check_out');
Route::get('/contact_us','ClientController@contact_us');
Route::get('/favorite','ClientController@favorite');
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



//Cart
Route::resource('/cart','CartController');
Route::get('/item-cart/{id}','CartController@AddCart');
Route::get('/delete-item-cart/{id}','CartController@DeleteItemCart');
Route::get('/delete-item-list-cart/{id}','CartController@DeleteItemListCart');
Route::get('/save-item-list-cart/{id}/{qty}','CartController@SaveItemListCart');
