<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\InventoryController;
use App\Http\Controllers\Pages\POSController;
use App\Http\Controllers\Pages\StockInController;
use App\Http\Controllers\Pages\TransactionController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
Route::get('/view-product/{id}', [ProductController::class, 'view'])->name('view-product');
Route::post('/store-product', [ProductController::class, 'store'])->name('store-product');
Route::patch('/update-product', [ProductController::class, 'update'])->name('update-product');
Route::post('/archive-product', [ProductController::class, 'archive'])->name('archive-product');
Route::post('/change-price', [ProductController::class, 'changePrice'])->name('change-price');


Route::get('/POS', [POSController::class, 'index'])->name('pos');
Route::get('/add-order/{id}', [POSController::class, 'addOrder'])->name('add-order');

Route::get('/stockin', [StockInController::class, 'index'])->name('stock_in');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
