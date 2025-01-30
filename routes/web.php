<?php

use App\Http\Controllers\Business\ReportController;
use App\Http\Controllers\Business\AuthController;
use App\Http\Controllers\Business\CategoryController;
use App\Http\Controllers\Business\CustomerController;
use App\Http\Controllers\Business\CustomerLedgerController;
use App\Http\Controllers\Business\CustomerTransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Business\DashboardController;
use App\Http\Controllers\Business\SaleInvoiceController;
use App\Http\Controllers\Business\ProductController;
use App\Http\Controllers\Business\PurchaseInvoiceController;
use App\Http\Controllers\Business\SalePaymentController;
use App\Http\Controllers\Business\SettingController;
use App\Http\Controllers\Business\StockAdjustmentController;
use App\Http\Controllers\Business\UnitController;
use App\Http\Controllers\Business\UserController;
use App\Http\Controllers\Business\VendorController;
use App\Http\Controllers\Business\VendorTransactionController;

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
    return redirect('/business/login'); 
});


//Admin
Route::get('/', [AuthController::class, 'login']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login_submit', [AuthController::class, 'login_submit']);

Route::get('register', [AuthController::class, 'register']);
Route::post('register_submit', [AuthController::class, 'register_submit']);


Route::middleware(['auth'])->group(function () {

        Route::get('/business/logout', [AuthController::class, 'logout']);
        Route::get('/business/changepassword', [DashboardController::class, 'changepassword']);
        Route::post('/business/changepassword_submit', [DashboardController::class, 'changepassword_submit']);

        Route::get('/business/dashboard', [DashboardController::class, 'dashboard']);
        Route::get('/business/dashboard/products', [DashboardController::class, 'products']);
        Route::post('/business/status', [DashboardController::class, 'status']);
        
        //Profile
        Route::get('business/profile',[DashboardController::class, 'profile']);
        Route::post('business/profile-update',[DashboardController::class, 'profile_update']);



        // Inventory Managment
        Route::resource('/business/products',ProductController::class);
        Route::resource('/business/stockadjustment',StockAdjustmentController::class);
        Route::resource('/business/categories',CategoryController::class);
        Route::resource('/business/units',UnitController::class);

        // Purchase Management
        Route::get('/business/purchaseinvoices/print/{id}', [PurchaseInvoiceController::class, 'print']);
        Route::resource('/business/purchaseinvoices',PurchaseInvoiceController::class);

        // Sales Management
        Route::get('/business/saleinvoices/print/{id}', [SaleInvoiceController::class, 'print']);
        Route::resource('/business/saleinvoices',SaleInvoiceController::class);
        Route::resource('/business/salepayments',SalePaymentController::class);


        // Vendor Management
        Route::resource('/business/vendor-transactions',VendorTransactionController::class);
        Route::resource('/business/vendors',VendorController::class);
       

        //Customer Managment
        Route::resource('/business/customer-transactions',CustomerTransactionController::class);
        Route::resource('/business/customers',CustomerController::class);

        //Reports
        Route::get('/business/reports/customerLedger',[ReportController::class,'customerLedger']);
        Route::get('/business/reports/customerLedgerDetail/{id}',[ReportController::class,'customerLedgerDetail']);
        Route::get('/business/reports/vendorLedger',[ReportController::class,'vendorLedger']);
        Route::get('/business/reports/vendorLedgerDetail/{id}',[ReportController::class,'vendorLedgerDetail']);
        
        Route::get('/business/reports/saleReport',[ReportController::class,'saleReport']);
        Route::get('/business/reports/purchaseReport',[ReportController::class,'purchaseReport']);
        
        Route::get('/business/reports/inventoryReport',[ReportController::class,'inventoryReport']);
        Route::get('/business/reports/inventoryReportDetail/{id}',[ReportController::class,'inventoryReportDetail']);


        

        //Settings
        Route::match(['get', 'post'], 'business/settings/general', [SettingController::class, 'general']);
        Route::match(['get', 'post'], 'business/settings/address', [SettingController::class, 'address']);

});



// Auth::routes();
Route::fallback(function () {
    return redirect('/'); 
});