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



Route::group(['middleware' => ['auth:admin']], function() {

    Route::group(['prefix' => 'admin'], function () {
        Route::get('logout', [LoginController::class, 'logoutAdmin'])->name('admin.logout');
        Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
        Route::get('services', [App\Http\Controllers\Admin\ServiceController::class, 'index']);

        //Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
        Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class,'index']);
        Route::get('orders/create', [\App\Http\Controllers\Admin\OrderController::class,'create']);
        Route::post('orders/store', [\App\Http\Controllers\Admin\OrderController::class,'store']);
        Route::get('orders/edit/{id}', [\App\Http\Controllers\Admin\OrderController::class,'edit']);
        Route::post('orders/update', [\App\Http\Controllers\Admin\OrderController::class,'update']);
        Route::post('order/receit_number_store', [\App\Http\Controllers\Admin\OrderController::class,'receitNumberStore']);
        Route::post('order/daeert_alwasl_store', [\App\Http\Controllers\Admin\OrderController::class,'daeertAlwaslStore']);

        Route::get('orders/delete/{id}', [\App\Http\Controllers\Admin\OrderController::class,'destroy']);
        Route::get('orders-profile/{id}', [\App\Http\Controllers\Admin\OrderController::class,'show']);
        Route::get('order-details/{id}', [\App\Http\Controllers\Admin\OrderController::class,'OrderDetails']);
        Route::post('order-details-store/', [\App\Http\Controllers\Admin\OrderController::class,'OrderDetailsStore']);
        Route::get('orders/PrintOrder', [\App\Http\Controllers\Admin\OrderController::class,'PrintOrder']);



        Route::get('clients', [\App\Http\Controllers\Admin\ClientController::class,'index']);
        Route::get('clients/create', [\App\Http\Controllers\Admin\ClientController::class,'create']);
        Route::post('clients/store', [\App\Http\Controllers\Admin\ClientController::class,'store']);
        Route::get('clients/edit/{id}', [\App\Http\Controllers\Admin\ClientController::class,'edit']);
        Route::post('clients/update', [\App\Http\Controllers\Admin\ClientController::class,'update']);


        Route::get('services', [\App\Http\Controllers\Admin\ServiceController::class,'index']);
        Route::get('services/create', [\App\Http\Controllers\Admin\ServiceController::class,'create']);
        Route::post('services/store', [\App\Http\Controllers\Admin\ServiceController::class,'store']);
///    Route::get('orders/autocomplete', 'autocomplete')->name('autocomplete');
        Route::get('orders/autocomplete',[\App\Http\Controllers\Admin\OrderController::class,'autocomplete']);


        Route::get('service_entries/{id}',[\App\Http\Controllers\Admin\ServiceEntryController::class,'index']);
        Route::get('service_entries/create/{id}',[\App\Http\Controllers\Admin\ServiceEntryController::class,'create']);
        Route::post('service_entries/store',[\App\Http\Controllers\Admin\ServiceEntryController::class,'store']);
        Route::get('service_entries/delete/{id}',[\App\Http\Controllers\Admin\ServiceEntryController::class,'destroy']);

        Route::get('roles',[\App\Http\Controllers\Admin\RoleController::class,'index']);
        Route::get('roles/create',[\App\Http\Controllers\Admin\RoleController::class,'create']);
        Route::post('roles/store', [\App\Http\Controllers\Admin\RoleController::class, 'store']);
        Route::get('roles/edit/{id}',[\App\Http\Controllers\Admin\RoleController::class,'edit']);
        Route::post('roles/update', [\App\Http\Controllers\Admin\RoleController::class, 'update']);
        Route::get('roles/delete/{id}', [\App\Http\Controllers\Admin\RoleController::class,'destroy']);

        Route::get('users_panel',[\App\Http\Controllers\Admin\UserPanelController::class,'index']);
        Route::get('users_panel/create',[\App\Http\Controllers\Admin\UserPanelController::class,'create_users_panel']);
        Route::post('users_panel/store', [\App\Http\Controllers\Admin\UserPanelController::class, 'store']);
        Route::get('users_panel/edit/{id}',[\App\Http\Controllers\Admin\UserPanelController::class,'edit_users_panel']);
        Route::post('users_panel/update', [\App\Http\Controllers\Admin\UserPanelController::class, 'update_users_panel']);
        Route::get('users_panel/delete/{id}',[\App\Http\Controllers\Admin\UserPanelController::class,'destroy_users_panel']);


        Route::get('boxes',[\App\Http\Controllers\Admin\BoxController::class,'index']);
        Route::get('boxes/create',[\App\Http\Controllers\Admin\BoxController::class,'create']);
        Route::post('boxes/store', [\App\Http\Controllers\Admin\BoxController::class, 'store']);
        Route::get('boxes/edit/{id}',[\App\Http\Controllers\Admin\BoxController::class,'edit']);
        Route::post('boxes/update', [\App\Http\Controllers\Admin\BoxController::class, 'update']);
        Route::get('boxes/delete/{id}',[\App\Http\Controllers\Admin\BoxController::class,'destroy']);

        Route::get('box_items',[\App\Http\Controllers\Admin\BoxItemController::class,'index']);
        Route::get('box_items/create',[\App\Http\Controllers\Admin\BoxItemController::class,'create']);
        Route::post('box_items/store', [\App\Http\Controllers\Admin\BoxItemController::class, 'store']);
        Route::get('box_items/edit/{id}',[\App\Http\Controllers\Admin\BoxItemController::class,'edit']);
        Route::post('box_items/update', [\App\Http\Controllers\Admin\BoxItemController::class, 'update']);
        Route::get('box_items/delete/{id}',[\App\Http\Controllers\Admin\BoxItemController::class,'destroy']);

        Route::get('organizations',[\App\Http\Controllers\Admin\OrganizationController::class,'index']);
        Route::get('organizations/create',[\App\Http\Controllers\Admin\OrganizationController::class,'create']);
        Route::post('organizations/store', [\App\Http\Controllers\Admin\OrganizationController::class, 'store']);
        Route::get('organizations/edit/{id}',[\App\Http\Controllers\Admin\OrganizationController::class,'edit']);
        Route::post('organizations/update', [\App\Http\Controllers\Admin\OrganizationController::class, 'update']);
        Route::get('organizations/delete/{id}',[\App\Http\Controllers\Admin\OrganizationController::class,'destroy']);

        Route::get('service_box_items/index/{id}',[\App\Http\Controllers\Admin\ServiceBoxItemsController::class,'index']);
        Route::get('service_box_items/create/{id}',[\App\Http\Controllers\Admin\ServiceBoxItemsController::class,'create']);

        Route::post('receits/store', [\App\Http\Controllers\Admin\ReceitController::class,'store']);

    });

});
