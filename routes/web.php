<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/company', 'CompanyController@index')->name('company');
Route::get('/contact', 'ContactController@index')->name('contact');
Route::get('/customize', 'CustomizeController@index')->name('customize');
Route::get('/products/{sex}', 'ProductsController@index')->name('products');
Route::get('/products/{id}/detail', 'ProductsController@detail')->name('product.detail');

Route::get('/provinsi', 'ProductsController@get_provinces')->name('provinsi');
Route::get('/kota', 'ProductsController@get_cities')->name('kota');
Route::post('/ongkir', 'ProductsController@get_cost')->name('ongkir');

Route::middleware('auth')->group(function() {
    Route::post('/customize/order', 'CustomizeController@saveOrder')->name('customize.order');
    Route::get('/{user}/cart', 'ProductsController@cart')->name('cart.view');
    Route::post('/products/{id}/cart', 'ProductsController@addCart')->name('cart.add');
    Route::patch('/{user}/cartUpdate', 'ProductsController@cartUpdate')->name('cart.update');
    Route::delete('/{user}/cartDelete', 'ProductsController@cartDelete')->name('cart.delete');
    Route::delete('/{user}/cartClear', 'ProductsController@cartClear')->name('cart.clear');
    Route::get('/{user}/rewards', 'GamiController@reward')->name('rewards');
    Route::get('/{user}/rewards/claim', 'GamiController@claim_reward')->name('rewards.claim');
    Route::get('/{user}/quiz', 'GamiController@quiz')->name('quiz');
    Route::get('/{user}/quiz/ques', 'GamiController@get_ques')->name('question');
    Route::get('/{user}/quiz/tries', 'GamiController@get_tries')->name('tries');
    Route::post('/{user}/quiz/save', 'GamiController@saveQues')->name('quiz.save');
    Route::post('/{user}/checkout', 'GamiController@checkout')->name('checkout');
    Route::post('/{user}/historydetails', 'HistoryController@get_details')->name('historydetails');
    Route::post('/{user}/history/upload', 'HistoryController@upload_bukti')->name('history.bukti');
    Route::resource('/{user}/history', 'HistoryController')->except('show');

    Route::middleware('admin')->group(function() {
        Route::get('/dashboard/admin', 'Admin\AdminController@index')->name('admin');
        Route::get('/dashboard/admin/dataChart', 'Admin\AdminController@dataChart')->name('dataChart');
        Route::post('/dashboard/admin/user/role', 'Admin\UsersController@rolestore')->name('role.store');
        Route::put('/dashboard/admin/user/role/{id}', 'Admin\UsersController@roleupdate')->name('role.update');
        Route::delete('/dashboard/admin/user/role/{id}/delete', 'Admin\UsersController@roledestroy')->name('role.destroy');
        Route::resource('/dashboard/admin/user', 'Admin\UsersController');
        Route::put('/dashboard/admin/level/simpanxp', 'Admin\LevelsController@simpanxp')->name('simpanxp');
        Route::resource('/dashboard/admin/level', 'Admin\LevelsController');
        Route::resource('/dashboard/admin/reward', 'Admin\RewardsController');
        Route::post('/dashboard/admin/rewards/typestore', 'Admin\RewardsController@typestore')->name('typestore');
        Route::put('/dashboard/admin/rewards/typeupdate/{id}', 'Admin\RewardsController@typeupdate')->name('typeupdate');
        Route::delete('/dashboard/admin/rewards/typedestroy/{id}', 'Admin\RewardsController@typedestroy')->name('typedestroy');
        Route::put('/dashboard/admin/point/simpanharga', 'Admin\PointsController@simpanharga')->name('simpanharga');
        Route::resource('/dashboard/admin/point', 'Admin\PointsController');
        Route::resource('/dashboard/admin/quiz', 'Admin\QuizController');
        Route::post('/dashboard/admin/produk/typestore', 'Admin\ProdukController@typestore')->name('produk.typestore');
        Route::put('/dashboard/admin/produk/typeupdate/{id}', 'Admin\ProdukController@typeupdate')->name('produk.typeupdate');
        Route::delete('/dashboard/admin/produk/typedestroy/{id}', 'Admin\ProdukController@typedestroy')->name('produk.typedestroy');
        Route::resource('/dashboard/admin/produk', 'Admin\ProdukController');
        Route::resource('/dashboard/admin/material', 'Admin\MaterialsController');
        Route::get('/dashboard/admin/sablon', 'Admin\SablonController@index')->name('sablon.index');
        Route::post('/dashboard/admin/sablon/simpan/warna', 'Admin\SablonController@simpanwarna')->name('warna.store');
        Route::post('/dashboard/admin/sablon/simpan/kain', 'Admin\SablonController@simpankain')->name('kain.store');
        Route::put('/dashboard/admin/sablon/edit/warna/{id}', 'Admin\SablonController@editwarna')->name('warna.update');
        Route::put('/dashboard/admin/sablon/edit/kain/{id}', 'Admin\SablonController@editkain')->name('kain.update');
        Route::delete('/dashboard/admin/sablon/hapus/warna/{id}', 'Admin\SablonController@hapuswarna')->name('warna.destroy');
        Route::delete('/dashboard/admin/sablon/hapus/kain/{id}', 'Admin\SablonController@hapuskain')->name('kain.destroy');
        Route::get('/dashboard/admin/pemesanan', 'Admin\PemesananController@index')->name('pemesanan.index');
        Route::put('/dashboard/admin/pemesanan/{id}', 'Admin\PemesananController@konfirmasi')->name('pemesanan.konfirmasi');
        Route::put('/dashboard/admin/pemesanan/tolak/{id}', 'Admin\PemesananController@tolak')->name('pemesanan.tolak');
        Route::get('/dashboard/admin/penjualan', 'Admin\PenjualanController@index')->name('penjualan.index');
        Route::put('/dashboard/admin/penjualan/{id}', 'Admin\PenjualanController@konfirmasi')->name('penjualan.konfirmasi');
        Route::put('/dashboard/admin/penjualan/tolak/{id}', 'Admin\PenjualanController@tolak')->name('penjualan.tolak');
    });

});
