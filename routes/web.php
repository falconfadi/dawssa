<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');

Route::get('/admin/register',[RegisterController::class,'showAdminRegisterForm'])->name('admin.register-view');
Route::post('/admin/register',[RegisterController::class,'createAdmin'])->name('admin.register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin'], function () {
    Route::get('logout', 'AdminLoginController@logout')->name('admin.logout');
    Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::get('services', [App\Http\Controllers\Admin\ServicesController::class, 'index']);

    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class,'index']);
    Route::get('orders/create', [\App\Http\Controllers\Admin\OrderController::class,'create']);
    Route::post('orders/store', [\App\Http\Controllers\Admin\OrderController::class,'store']);
    Route::get('orders/delete/{id}', [\App\Http\Controllers\Admin\OrderController::class,'destroy']);
    Route::get('orders/edit/{id}', [\App\Http\Controllers\Admin\OrderController::class,'edit']);
    Route::post('orders/update', [\App\Http\Controllers\Admin\OrderController::class,'update']);
    Route::get('orders/PrintOrder', [\App\Http\Controllers\Admin\OrderController::class,'PrintOrder']);
    Route::get('clients', [\App\Http\Controllers\Admin\ClientController::class,'index']);
    Route::get('clients/create', [\App\Http\Controllers\Admin\ClientController::class,'create']);
    Route::post('clients/store', [\App\Http\Controllers\Admin\ClientController::class,'store']);


    Route::get('services', [\App\Http\Controllers\Admin\ServiceController::class,'index']);

});
Route::group(['middleware' => ['auth:admin']], function() {


});
