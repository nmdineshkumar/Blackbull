<?php

use App\Http\Controllers\Admin\BatteryController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManufacturersController;
use App\Http\Controllers\Admin\ProductStockController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TubeController;
use App\Http\Controllers\Admin\TyreController;
use App\Http\Controllers\Admin\TyresizeController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Auth\Logincontroller;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HelperController;
use Illuminate\Support\Facades\Artisan;
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
Route::get('/clear',function(){
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('storage:link');
    Artisan::call('optimize');
    return "Cleared!";
});
Route::get('/', function () {
    return view('website.home');
});
Route::get('/invoice/{id}',[SaleController::class, 'viewInvoice'])->name('getInvoice');
Route::get('/state/{id}',[HelperController::class,'getState']);
Route::get('/cities/{id}',[HelperController::class,'getCity']);
Route::get('logout',[Logincontroller::class,'logoutForm'])->name('logout');
Route::get('/admin/login', [Logincontroller::class,'showLoginForm'])->name('login');
Route::post('/admin/login', [Logincontroller::class,'Auth_validateLogin'])->name('auth.login');
Route::get('/get-car-model/{id}', [HelperController::class,'getCar_model'])->name('get-car-model');
Route::get('/get-car-year/{id}', [HelperController::class,'getCar_year'])->name('get-car-year');
Route::get('/get-products/{id}', [HelperController::class, 'get_Product'])->name('get-products');
Route::get('/get-product-price', [SaleController::class, 'getPriceByProduct'])->name('get-product-price');
$prefix = 'admin';
Route::group(['prefix'=>$prefix,'middleware'=>'auth:admin'], function () use($prefix) {
    //Helper Process
    Route::post('/save-tyreheight', [HelperController::class, 'saveTyreheight'])->name('save-tyreheight');
    Route::post('/save-tyreprofile', [HelperController::class, 'saveTyreprofile'])->name('save-tyreprofile');
    Route::post('/save-tyrerimsize', [HelperController::class, 'saveTyrerimsize'])->name('save-tyrerimsize');
    Route::post('/save-tyre-brand', [HelperController::class, 'saveBrand'])->name('save-tyre-brand');
    Route::post('/save-tyre-pattern', [HelperController::class, 'savePattern'])->name('save-tyre-pattern');
    Route::post('/save-tyre-origin', [HelperController::class, 'saveOrigin'])->name('save-tyre-origin');
    Route::post('/save-car-model', [HelperController::class, 'saveCar_model'])->name('save-car-model');
    Route::post('/save-car-year', [HelperController::class, 'saveCar_year'])->name('save-car-year');
    Route::post('/save-tube-volve', [HelperController::class, 'saveVolve'])->name('save-tube-volve');
    Route::post('/save-tube-height', [HelperController::class, 'saveTubeheight'])->name('save-tube-height');
    Route::post('/save-tube-rim-size', [HelperController::class, 'saveTubeRimsize'])->name('save-tube-rim-size');
    //End helper process
    //Images
    Route::post('/save-image',[FileController::class,'saveImage']);
    Route::post('/delete-image',[FileController::class,'deleteImage']);
    //End Images
    Route::get('/dashboard',[DashboardController::class,'index'])->name($prefix.'.dashboard');
    Route::resource('branch', BranchController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.branch');
    Route::resource('supplier', SupplierController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.supplier');
    Route::resource('category', CategoryController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.category');
    //manufacture
    Route::resource('manufacture', ManufacturersController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.manufacture');
    Route::resource('tyresize', TyresizeController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.tyresize');
    Route::resource('tyre', TyreController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.tyre');
    Route::resource('tube', TubeController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.tube');
    Route::resource('battery', BatteryController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.battery');
    Route::resource('purchase', PurchaseOrderController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.purchase');
    Route::resource('productstock', ProductStockController::class)->only(['index'])->names($prefix .'.productstock');
    Route::resource('sales', SaleController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.sales');
    //Customer
    Route::resource('customer', CustomerController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.customer');
    Route::get('/get-customer/{id}',[CustomerController::class,'getCustomer'])->name('get-customer');
    //Purchase order payment
    Route::get('purchase/payment/{id}', [PurchaseOrderController::class, 'addPayment'])->name($prefix.'.purchase.addPayment');
    Route::post('purchase/payment',[PurchaseOrderController::class,'savePayment'])->name($prefix.'.purchase.savePayment');
    //Monthly Expense
    Route::resource('expense', ExpenseController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.expense');
});
