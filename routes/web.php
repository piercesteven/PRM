<?php

use App\Http\Controllers\BatchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\InventoryController;
use App\Http\Controllers\Pages\POSController;
use App\Http\Controllers\Pages\StockInController;
use App\Http\Controllers\Pages\TransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
Route::get('/view-product/{id}', [ProductController::class, 'view'])->name('view-product');
Route::post('/store-product', [ProductController::class, 'store'])->name('store-product');

Route::get('/create-order', [OrderController::class, 'store'])->name('create-order');

Route::patch('/update-product', [ProductController::class, 'update'])->name('update-product');
Route::post('/archive-product', [ProductController::class, 'archive'])->name('archive-product');
Route::post('/change-price', [ProductController::class, 'changePrice'])->name('change-price');


Route::get('/POS', [POSController::class, 'index'])->name('pos');
Route::get('/add-order/{id}/{state}/{stocks}', [POSController::class, 'addOrder'])->name('add-order');

Route::get('/stockin', [StockInController::class, 'index'])->name('stock_in');
Route::post('/new-batch', [BatchController::class, "store"])->name('new-batch');
Route::get('/stock-in-product/{id}', [BatchController::class, 'stockInProduct'])->name('stock-in-product');
Route::get('/add-to-batch', [BatchController::class, 'addToBatch'])->name('add-to-batch');
Route::get('/stockin-product-batches', [BatchController::class, 'stockIn'])->name('stockin-product-batches');
Route::get('/remove-product/{id}', [BatchController::class, 'removeProduct'])->name('remove-product');
Route::patch('/update-secondhand-price', [BatchController::class,  'updateSecondhandPrice'])->name('update-secondhand-price');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
