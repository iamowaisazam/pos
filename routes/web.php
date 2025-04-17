<?php

use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerLedgerController;
use App\Http\Controllers\Admin\CustomerTransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SaleInvoiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseInvoiceController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SalePaymentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StockAdjustmentController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\VendorTransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
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

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login_submit', [AuthController::class, 'login_submit']);

Route::get('register', [AuthController::class, 'register']);
Route::post('register_submit', [AuthController::class, 'register_submit']);


Route::middleware(['auth'])->group(function () {

        Route::get('/admin/logout', [AuthController::class, 'logout']);
        Route::get('/admin/changepassword', [DashboardController::class, 'changepassword']);
        Route::post('/admin/changepassword_submit', [DashboardController::class, 'changepassword_submit']);

        Route::get('/admin/dashboard', [DashboardController::class, 'dashboard']);
        Route::get('/admin/dashboard/products', [DashboardController::class, 'products']);
        Route::post('/admin/status', [DashboardController::class, 'status']);

        Route::get('/admin/users/index',[UserController::class, 'index']);
        Route::get('/admin/users/create',[UserController::class, 'create']);
        Route::post('/admin/users/store',[UserController::class, 'store']);
        Route::get('/admin/users/edit/{id}',[UserController::class, 'edit']);
        Route::post('/admin/users/update/{id}',[UserController::class, 'update']);
        Route::get('/admin/users/delete/{id}',[UserController::class, 'delete']);

         //Roles
        Route::get('/admin/roles/index', [RoleController::class, 'index']);
        Route::get('/admin/roles/create', [RoleController::class, 'create']);
        Route::post('/admin/roles/store', [RoleController::class, 'store']);
        Route::get('/admin/roles/edit/{id}', [RoleController::class, 'edit']);
        Route::post('/admin/roles/update/{id}', [RoleController::class, 'update']);
        Route::get('/admin/roles/delete/{id}', [RoleController::class, 'delete']);


        
        //Profile
        Route::get('admin/profile',[DashboardController::class, 'profile']);
        Route::post('admin/profile-update',[DashboardController::class, 'profile_update']);



        // Inventory Managment
        Route::resource('/admin/products',ProductController::class);
        Route::resource('/admin/stockadjustment',StockAdjustmentController::class);
        Route::resource('/admin/categories',CategoryController::class);
        Route::resource('/admin/units',UnitController::class);

        // Purchase Management
        Route::get('/admin/purchaseinvoices/print/{id}', [PurchaseInvoiceController::class, 'print']);
        Route::resource('/admin/purchaseinvoices',PurchaseInvoiceController::class);

        // Sales Management
        Route::get('/admin/saleinvoices/print/{id}', [SaleInvoiceController::class, 'print']);
        Route::resource('/admin/saleinvoices',SaleInvoiceController::class);
        Route::resource('/admin/salepayments',SalePaymentController::class);


        // Vendor Management
        Route::resource('/admin/vendor-transactions',VendorTransactionController::class);
        Route::resource('/admin/vendors',VendorController::class);
       

        //Customer Managment
        Route::resource('/admin/customer-transactions',CustomerTransactionController::class);
        Route::resource('/admin/customers',CustomerController::class);

        //Reports
        Route::get('/admin/reports/customerLedger',[ReportController::class,'customerLedger']);
        Route::get('/admin/reports/customerLedgerDetail/{id}',[ReportController::class,'customerLedgerDetail']);
        Route::get('/admin/reports/vendorLedger',[ReportController::class,'vendorLedger']);
        Route::get('/admin/reports/vendorLedgerDetail/{id}',[ReportController::class,'vendorLedgerDetail']);
        
        Route::get('/admin/reports/saleReport',[ReportController::class,'saleReport']);
        Route::get('/admin/reports/purchaseReport',[ReportController::class,'purchaseReport']);
        
        Route::get('/admin/reports/inventoryReport',[ReportController::class,'inventoryReport']);
        Route::get('/admin/reports/inventoryReportDetail/{id}',[ReportController::class,'inventoryReportDetail']);


        

        //Settings
        Route::match(['get', 'post'], 'admin/settings/general', [SettingController::class, 'general']);
        Route::match(['get', 'post'], 'admin/settings/address', [SettingController::class, 'address']);
        Route::match(['get', 'post'], 'admin/settings/theme', [SettingController::class, 'theme']);

});



// Auth::routes();
Route::fallback(function () {
    return redirect('/'); 
});