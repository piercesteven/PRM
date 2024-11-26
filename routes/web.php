<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');

Route::get('/POS', [POSController::class, 'index'])->name('pos');

Route::get('/stockin', [StockInController::class, 'index'])->name('stock_in');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
