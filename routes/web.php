<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManufacturersController;
use App\Http\Controllers\Admin\SupplierController;
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
    return view('welcome');
});
Route::get('/state/{id}',[HelperController::class,'getState']);
Route::get('/cities/{id}',[HelperController::class,'getCity']);
Route::get('logout',[Logincontroller::class,'logoutForm'])->name('logout');
Route::get('/admin/login', [Logincontroller::class,'showLoginForm'])->name('login');
Route::post('/admin/login', [Logincontroller::class,'Auth_validateLogin'])->name('auth.login');
$prefix = 'admin';
Route::group(['prefix'=>$prefix,'middleware'=>'auth:admin'], function () use($prefix) {
    Route::post('/save-image',[FileController::class,'saveImage']);
    Route::post('/delete-image',[FileController::class,'deleteImage']);
    Route::get('/dashboard',[DashboardController::class,'index'])->name($prefix.'.dashboard');
    Route::resource('branch', BranchController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.branch');
    Route::resource('supplier', SupplierController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.supplier');
    Route::resource('category', CategoryController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.category');
    //manufacture
    Route::resource('manufacture', ManufacturersController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.manufacture');
});
