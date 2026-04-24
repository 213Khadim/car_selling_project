<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\CashAccountController;
use App\Http\Controllers\Admin\CashTransferController;
use App\Http\Controllers\Admin\CustomerPaymentController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (AUTH + ADMIN MIDDLEWARE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Cars CRUD
    Route::get('/cars', [CarController::class, 'index'])->name('cars');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

    // Customers CRUD
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    // Sales CRUD
    Route::get('/sales', [SaleController::class, 'index'])->name('sales');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
    Route::put('/sales/{sale}', [SaleController::class, 'update'])->name('sales.update');
    Route::delete('/sales/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');

    // Expenses CRUD
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

    // Finance
    Route::get('/cash-accounts', [CashAccountController::class, 'index'])->name('cash-accounts');
    Route::post('/cash-accounts', [CashAccountController::class, 'store'])->name('cash-accounts.store');
    Route::put('/cash-accounts/{cashAccount}', [CashAccountController::class, 'update'])->name('cash-accounts.update');
    Route::delete('/cash-accounts/{cashAccount}', [CashAccountController::class, 'destroy'])->name('cash-accounts.destroy');

    Route::get('/cash-transfer', [CashTransferController::class, 'index'])->name('cash-transfer');
    Route::post('/cash-transfer', [CashTransferController::class, 'store'])->name('cash-transfer.store');
    Route::delete('/cash-transfer/{cashTransfer}', [CashTransferController::class, 'destroy'])->name('cash-transfer.destroy');

    Route::get('/customer-payments', [CustomerPaymentController::class, 'index'])->name('customer-payments');
    Route::post('/customer-payments', [CustomerPaymentController::class, 'store'])->name('customer-payments.store');
    Route::delete('/customer-payments/{customerPayment}', [CustomerPaymentController::class, 'destroy'])->name('customer-payments.destroy');

    Route::get('/commissions', [CommissionController::class, 'index'])->name('commissions');
    Route::post('/commissions', [CommissionController::class, 'store'])->name('commissions.store');
    Route::delete('/commissions/{commission}', [CommissionController::class, 'destroy'])->name('commissions.destroy');

    // Content Management
    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // Reports & Settings
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Users Management
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
