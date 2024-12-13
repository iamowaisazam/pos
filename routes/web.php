<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/',function(){
    
    return redirect('/admin/login'); 
});

//Admin
Route::get('/', [AuthController::class, 'login']);
Route::get('/admin/login', [AuthController::class, 'login'])->name('login');
Route::post('/admin/login_submit', [AuthController::class, 'login_submit']);

Route::middleware(['auth'])->group(function () {

  Route::get('/admin/logout', [AuthController::class, 'logout']);
//   Route::get('/admin/changepassword', [DashboardController::class, 'changepassword']);
//   Route::post('/admin/changepassword_submit', [DashboardController::class, 'changepassword_submit']);

  Route::get('/admin/dashboard', [DashboardController::class, 'dashboard']);
  Route::get('/admin/dashboard/products', [DashboardController::class, 'products']);
  Route::post('/admin/status', [DashboardController::class, 'status']);


      //Users
      Route::get('/admin/users/index',[UserController::class, 'index']);
      Route::get('/admin/users/create',[UserController::class, 'create']);
      Route::post('/admin/users/store',[UserController::class, 'store']);
      Route::get('/admin/users/edit/{id}',[UserController::class, 'edit']);
      Route::post('/admin/users/update/{id}',[UserController::class, 'update']);
      Route::get('/admin/users/delete/{id}',[UserController::class, 'delete']);
      Route::get('admin/profile',[UserController::class, 'profile']);
      Route::post('admin/profile-update',[UserController::class, 'profile_update']);

      //Roles
      Route::get('/admin/roles/index', [RoleController::class, 'index']);
      Route::get('/admin/roles/create', [RoleController::class, 'create']);
      Route::post('/admin/roles/store', [RoleController::class, 'store']);
      Route::get('/admin/roles/edit/{id}', [RoleController::class, 'edit']);
      Route::post('/admin/roles/update/{id}', [RoleController::class, 'update']);
      Route::get('/admin/roles/delete/{id}', [RoleController::class, 'delete']);

      //Modules
      Route::resource('/admin/orders',OrderController::class);
      Route::resource('/admin/customers',CustomerController::class);
      Route::resource('/admin/products',ProductController::class);
    
      Route::get('/admin/companies/logged/{id}', [CompanyController::class, 'logged']);
      Route::resource('/admin/companies',CompanyController::class);

      //Settings
      Route::match(['get', 'post'], 'admin/settings/general', [SettingController::class, 'general']);
      Route::match(['get', 'post'], 'admin/settings/address', [SettingController::class, 'address']);

});



// Auth::routes();
Route::fallback(function () {
    return redirect('/'); 
});