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

// Route::get('/', function () {
//     return view('welcome');
// });

// // Route::get('/from', function () {
// //     return view('welcome ');
// // });

// // 闭包
// Route::get('/hello', function () {
//     echo '213';
//     });

// // 路由视图
// Route::view('/user','larave');

// post 路由
// Route::post('/dofrom',function(){
//     $post = request()->all();
//     dd($post);
// });

// Route::get('reg','RegController@index');

// Route::post('dofrom','RegController@dofrom');

// Route::redirect('reg','hello');

// // 必填
// Route::get('/goods/{goods_id}','RegController@goods');

// // 可选
// Route::get('show/{id}/{name}',function($id,$username){
//     echo $id;
//     echo $username;
// });

// 后台
// Route::domain('admin.1905.com')->group(function () {
    // 导航首页
    Route::prefix('/public')->middleware('auth')->group(function () {
        Route::get('index','Admin\PublicController@index');
    });

    // 品牌
    Route::prefix('/brand')->middleware('auth')->group(function () {
        Route::get('create','Admin\BrandController@create');
        Route::post('store','Admin\BrandController@store');
        Route::get('index','Admin\BrandController@index');
        Route::get('delete/{id}','Admin\BrandController@destroy');
        Route::get('edit/{id}','Admin\BrandController@edit');
        Route::post('update/{id}','Admin\BrandController@update');
        Route::post('checkOnly','Admin\BrandController@checkOnly');
    });

    // 管理员
    Route::prefix('/admin')->middleware('auth')->group(function () {
        Route::get('create','Admin\AdminController@create');
        Route::get('index','Admin\AdminController@index');
        Route::post('store','Admin\AdminController@store');
        Route::get('delete/{id}','Admin\AdminController@destroy');
        Route::get('edit/{id}','Admin\AdminController@edit');
        Route::post('update/{id}','Admin\AdminController@update');
        Route::post('checkOnly','Admin\AdminController@checkOnly');
    });

    // 商品
    Route::prefix('/goods')->middleware('auth')->group(function(){
        Route::get('create','Admin\GoodsController@create');
        Route::post('store','Admin\GoodsController@store');
        Route::get('index','Admin\GoodsController@index');
        Route::get('delete/{id}','Admin\GoodsController@destroy');
        Route::get('edit/{id}','Admin\GoodsController@edit');
        Route::post('update/{id}','Admin\GoodsController@update');
        Route::post('checkOnly','Admin\GoodsController@checkOnly');
    });

    // 登录
    Route::prefix('/user')->middleware('auth')->group(function(){
        Route::post('create','Admin\UserController@create');
        Route::get('index','Admin\UserController@index');
    });

    // 分类
    Route::prefix('/cate')->middleware('auth')->group(function(){
        Route::get('create','Admin\CateController@create');
        Route::post('store','Admin\CateController@store');
        Route::get('index','Admin\CateController@index');
        Route::get('delete/{id}','Admin\CateController@destroy');
        Route::get('edit/{id}','Admin\CateController@edit');
        Route::post('update/{id}','Admin\CateController@update');
        Route::post('checkOnly','Admin\CateController@checkOnly');
    });

    // 文章
    Route::prefix('/word')->middleware('auth')->group(function(){
        Route::get('create','Admin\WordsController@create');
        Route::post('store','Admin\WordsController@store');
        Route::get('index','Admin\WordsController@index');
        Route::post('delete','Admin\WordsController@destroy');
        Route::get('edit/{id}','Admin\WordsController@edit');
        Route::post('update/{id}','Admin\WordsController@update');
        Route::post('checkOnly','Admin\WordsController@checkOnly');
    });
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::view('/login', 'larave')->name('login');
Route::post('/dologin', 'RegController@dologin');
Route::view('/reg', 'reg');
Route::post('/doReg', 'RegController@doReg');

// 珠宝前台
Route::get('/','Index\IndexController@index');
Route::prefix('/login')->group(function(){
    Route::get('login','Index\LoginController@login');
    Route::get('reg','Index\RegController@reg');
    Route::post('create','Index\RegController@create');
    Route::post('creat','Index\LoginController@creat');
    Route::get('proinfo/{id}','Index\LoginController@proinfo');
    Route::get('car','Index\LoginController@car');
    Route::post('addCart','Index\LoginController@addCart');
    Route::post('send','Index\RegController@send');
    Route::get('getCartDb','Index\LoginController@getCartDb');
});

Route::prefix('/cart')->group(function(){
    Route::get('cart','Index\CartController@cart');
    Route::post('changeNum','Index\CartController@changeNum');
    Route::post('getCount','Index\CartController@getCount');
    Route::post('getTotal','Index\CartController@getTotal');
    Route::post('cartDel','Index\CartController@cartDel');
});

Route::prefix('/pay')->group(function(){
    Route::get('pay/{goods_id}','Index\PayController@pay');
    Route::get('addres','Index\PayController@addres');
    Route::get('getAreaInfo/{parent_id}','Index\PayController@getAreaInfo');
    Route::post('getArea','Index\PayController@getArea');
    Route::get('create','Index\PayController@create');
    Route::post('save','Index\PayController@save');
    Route::get('address','Index\PayController@address');
    Route::get('edit/{addres_id}','Index\PayController@edit');
    Route::get('submitOrder','Index\PayController@submitOrder');
    Route::get('success','Index\PayController@success');
    Route::get('payMoney/{order_id}','Index\PayController@payMoney');
});

Route::prefix('/address')->group(function(){
    Route::get('address','Index\AddressController@address');
    
});


// 库管注册登录
Route::prefix('/add')->group(function(){
    Route::get('index','Index\AddController@index');
    Route::post('reg','Index\AddController@reg');
    Route::get('login','Index\AddController@login');
    Route::post('logi','Index\AddController@logi');
    Route::get('list','Index\AddController@list')->middleware('checkexam');
});

// 货物管理
Route::prefix('/adds')->group(function(){
    Route::get('index','Index\AddsController@index')->middleware('checkexam');
    Route::get('show','Index\AddsController@show')->middleware('checkexam');
    Route::get('create','Index\AddsController@create')->middleware('checkexam');
    Route::post('store','Index\AddsController@store')->middleware('checkexam');
});


Route::prefix('/name')->group(function(){
Route::get('login','Name\NameController@login');
Route::post('create','Name\NameController@create');
});

Route::prefix('/index')->group(function(){
    Route::get('index','Name\IndexController@index');
    Route::post('create','Name\NameController@create');
    });

