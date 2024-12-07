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
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('login');

Auth::routes();

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
    Route::get('/view-product/{id}', [ProductController::class, 'view'])->name('view-product');
    Route::post('/store-product', [ProductController::class, 'store'])->name('store-product');

    Route::get('/create-order', [OrderController::class, 'store'])->name('create-order');
    Route::post('/add-order-detail', [OrderController::class, 'addOrderDetail'])->name('add-order-detail');
    Route::get('/remove-order-detail/{id}/{state}', [OrderController::class, 'removeOrderDetail'])->name('remove-order-detail');

    Route::get('/checkout-cash', [OrderController::class, 'checkOutCash'])->name('checkout-cash');
    Route::get('/checkout-gcash', [OrderController::class, 'checkOutGcash'])->name('checkout-gcash');

    Route::get('order-checkout/{id}', [POSController::class, 'orderCheckout'])->name('order-checkout');

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
    Route::patch('/update-secondhand-price', [BatchController::class, 'updateSecondhandPrice'])->name('update-secondhand-price');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::post('/generate-sales', [TransactionController::class, 'generateSales'])->name('generate-sales');
});
