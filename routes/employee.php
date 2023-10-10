<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

$prefix="employee";
Route::group(['prefix'=>$prefix,'middleware'=>'auth:employee,employee'], function () use($prefix) {
    Route::get('/dashboard',[\App\Http\Controllers\employee\DashboardController::class,'index'])->name($prefix.'.dashboard');
    Route::resource('sales', \App\Http\Controllers\manager\SaleController::class)->only(['index', 'create', 'edit', 'store', 'destroy'])->names($prefix .'.sales');
});