<?php

use App\Http\Controllers\Admin\BatteryController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ManufacturersController;
use App\Http\Controllers\Admin\ProductStockController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TubeController;
use App\Http\Controllers\Admin\TyreController;
use App\Http\Controllers\Admin\TyresizeController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\admin\ReportsController;
use App\Http\Controllers\Auth\Logincontroller;
use App\Http\Controllers\CartController;
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
//Demo Invoice 
Route::get('oman-invoice',function(){
    return view('invoice.omanInvoice');
});
Route::get('dubai-invoice',function(){
    return view('invoice.dubaiInvoice');
});



Route::get('/filter-by-maker',[HelperController::class,'FilterMaker'])->name('frontend.filter.maker');
Route::get('/filter-by-make/{id}',[HelperController::class,'FilterCarModel'])->name('frontend.filter.model');
Route::get('/filter-by-model/{id}',[HelperController::class,'FilterCarYear'])->name('frontend.filter.year');
Route::get('/filter-by-year/{id}',[HelperController::class,'FilterCarSize'])->name('frontend.filter.size');
Route::get('/tyre/product-detail/{id}',[\App\Http\Controllers\TyreController::class,'ProductDetail'])->name('frontend.tyre.product-detail');
Route::get('/tyre/product-search',[\App\Http\Controllers\TyreController::class,'ProductSearch'])->name('frontend.tyre.product-search');

//Tubes Filter 
Route::get('/tube/filter-by-brand/{id}',[\App\Http\Controllers\HelperController::class,'TubeFilterByBrand'])->name('frontend.tube.filter.brand');
Route::get('/tube/filter-by-origin/{id}',[\App\Http\Controllers\HelperController::class,'TubeFilterByOrigin'])->name('frontend.tube.filter.origin');
Route::get('/tube/product-detail/{id}',[\App\Http\Controllers\TubeController::class,'ProductDetail'])->name('frontend.tube.product-detail');
Route::get('/tube/product-search',[\App\Http\Controllers\TubeController::class,'ProductSearch'])->name('frontend.tube.product-search');

//Battries
Route::get('/battery/product-detail/{id}',[\App\Http\Controllers\BatteryController::class,'ProductDetail'])->name('frontend.battery.product-detail');
Route::get('/battery/product-search',[\App\Http\Controllers\BatteryController::class,'ProductSearch'])->name('frontend.battery.product-search');
Route::get('/battery/filter-by-brand/{id}',[\App\Http\Controllers\HelperController::class,'BatteryFilterByBrand'])->name('frontend.battery.filter.brand');

Route::get('add-to-cart/{id}/{name}', [CartController::class, 'addToCart'])->name('add_to_cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove_from_cart');

Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::get('/about-us', [\App\Http\Controllers\AboutController::class,'index'])->name('about-us');
Route::get('/contact-us', [\App\Http\Controllers\ContactController::class,'index'])->name('contact-us');
Route::get('/battery', [\App\Http\Controllers\BatteryController::class,'index'])->name('battery');
Route::get('/tyre', [\App\Http\Controllers\TyreController::class,'index'])->name('tyre');
Route::get('/wheel', [\App\Http\Controllers\WheelController::class,'index'])->name('wheel');
Route::get('/tube', [\App\Http\Controllers\TubeController::class,'index'])->name('tube');
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
Route::post('/expense/catgory',[HelperController::class,'save_expense_category'])->name('save-expense-category');
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
    Route::resource('employee', EmployeeController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.employee');
    //Customer
    Route::resource('customer', CustomerController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.customer');
    Route::get('/get-customer/{id}',[CustomerController::class,'getCustomer'])->name('get-customer');
    //Purchase order payment
    Route::get('purchase/payment/{id}', [PurchaseOrderController::class, 'addPayment'])->name($prefix.'.purchase.addPayment');
    Route::post('purchase/payment',[PurchaseOrderController::class,'savePayment'])->name($prefix.'.purchase.savePayment');
    //Monthly Expense
    Route::resource('expense', ExpenseController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.expense');

    //Reports start
    Route::get('reports/sales',[ReportsController::class,'Sales_index'])->name($prefix.'.sales_index');
    Route::get('sale/overall',[ReportsController::class,'over_all'])->name($prefix.'.over-all-sales');
    Route::get('sale/monthly/{id}',[ReportsController::class,'monthly'])->name($prefix.'.montly-sales');
    Route::get('sale/datewise/{from}/{to}',[ReportsController::class,'weekly'])->name($prefix.'.datewise-sales');

    Route::get('reports/purchase',[ReportsController::class,'Purchase_index'])->name($prefix.'.purchase_index');
    Route::get('purchase/overall',[ReportsController::class,'purchase_over_all'])->name($prefix.'.purchase.over-all-sales');
    Route::get('purchase/monthly/{id}',[ReportsController::class,'purchase_monthly'])->name($prefix.'.purchase.montly-sales');
    Route::get('purchase/datewise/{from}/{to}',[ReportsController::class,'purchase_weekly'])->name($prefix.'.purchase.datewise-sales');
});
