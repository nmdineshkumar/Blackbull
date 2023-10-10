<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

$prefix="manager";
Route::group(['prefix'=>$prefix,'middleware'=>'auth:employee, manager'], function () use($prefix) {    
    Route::get('/dashboard',[\App\Http\Controllers\manager\DashboardController::class,'index'])->name($prefix.'.dashboard');
    Route::resource('purchase', \App\Http\Controllers\manager\PurchaseOrderController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.purchase');
    Route::resource('sales', \App\Http\Controllers\manager\SaleController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.sales');
    Route::resource('expense', \App\Http\Controllers\manager\ExpenseController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.expense');
    //Purchase order payment
    Route::get('purchase/payment/{id}', [PurchaseOrderController::class, 'addPayment'])->name($prefix.'.purchase.addPayment');
    Route::post('purchase/payment',[PurchaseOrderController::class,'savePayment'])->name($prefix.'.purchase.savePayment');
});