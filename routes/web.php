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
Route::get('/admin-login',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/adminlog',[LoginController::class,'adminLogin'])->name('admin.login');

Route::get('/admin/register',[RegisterController::class,'showAdminRegisterForm'])->name('admin.register-view');
Route::post('/admin/register',[RegisterController::class,'createAdmin'])->name('admin.register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin'], function () {
    //Route::get('logout', 'AdminLoginController@logout')->name('admin.logout');
    Route::get('logout', [LoginController::class, 'logoutAdmin'])->name('admin.logout');
    Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::get('services', [App\Http\Controllers\Admin\ServicesController::class, 'index']);

    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class,'index']);
    Route::get('orders/create', [\App\Http\Controllers\Admin\OrderController::class,'create']);
    Route::post('orders/store', [\App\Http\Controllers\Admin\OrderController::class,'store']);
    Route::get('orders/delete/{id}', [\App\Http\Controllers\Admin\OrderController::class,'destroy']);
    Route::get('orders/edit/{id}', [\App\Http\Controllers\Admin\OrderController::class,'edit']);
    Route::post('orders/update', [\App\Http\Controllers\Admin\OrderController::class,'update']);
    Route::get('/order-details/{id}', [\App\Http\Controllers\Admin\OrderController::class,'OrderDetails']);

    Route::get('orders/PrintOrder', [\App\Http\Controllers\Admin\OrderController::class,'PrintOrder']);
    Route::get('clients', [\App\Http\Controllers\Admin\ClientController::class,'index']);
    Route::get('clients/create', [\App\Http\Controllers\Admin\ClientController::class,'create']);
    Route::post('clients/store', [\App\Http\Controllers\Admin\ClientController::class,'store']);


    Route::get('services', [\App\Http\Controllers\Admin\ServiceController::class,'index']);
    Route::get('services/create', [\App\Http\Controllers\Admin\ServiceController::class,'create']);
    Route::post('services/store', [\App\Http\Controllers\Admin\ServiceController::class,'store']);
///    Route::get('orders/autocomplete', 'autocomplete')->name('autocomplete');
    Route::get('orders/autocomplete',[\App\Http\Controllers\Admin\OrderController::class,'autocomplete']);


    Route::get('roles',[\App\Http\Controllers\Admin\RoleController::class,'index']);
    Route::get('roles/create',[\App\Http\Controllers\Admin\RoleController::class,'create']);
    Route::post('roles/store', [\App\Http\Controllers\Admin\RoleController::class, 'store']);
    Route::get('roles/edit/{id}',[\App\Http\Controllers\Admin\RoleController::class,'edit']);
    Route::post('roles/update', [\App\Http\Controllers\Admin\RoleController::class, 'update']);
    Route::get('roles/delete/{id}', [\App\Http\Controllers\Admin\RoleController::class,'destroy']);

    Route::get('users_panel',[\App\Http\Controllers\Admin\RoleController::class,'users_panel']);
    Route::get('users_panel/create',[\App\Http\Controllers\Admin\RoleController::class,'create_users_panel']);
    Route::post('users_panel/store', [\App\Http\Controllers\Admin\RoleController::class, 'store_users_panel']);
    Route::get('users_panel/edit/{id}',[\App\Http\Controllers\Admin\RoleController::class,'edit_users_panel']);
    Route::post('users_panel/update', [\App\Http\Controllers\Admin\RoleController::class, 'update_users_panel']);
    Route::get('users_panel/delete/{id}',[\App\Http\Controllers\Admin\RoleController::class,'destroy_users_panel']);

});
Route::group(['middleware' => ['auth:admin']], function() {


});
