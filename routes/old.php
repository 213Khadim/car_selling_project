<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/cars', function () {
    return view('cars');
});

Route::get('/brands', function () {
    return view('brands');
});

Route::get('/posts', function () {
    return view('posts');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/car-detail/{id}', function ($id) {
    return view('car-detail');
})->name('car-detail');

Route::get('/user/login', function () {
    return view('user.login');
});

Route::get('/user/register', function () {
    return view('user.register');
});

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
});

Route::get('/user/profile', function () {
    return view('user.profile');
});

Route::get('/admin/login', function () {
    return view('admin.login');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/cars', function () {
    return view('admin.cars');
});     

Route::get('/admin/customers', function () {
    return view('admin.customers');
});

Route::get('/admin/sales', function () {
    return view('admin.sales');
});

Route::get('/admin/expenses', function () {
    return view('admin.expenses');
});

Route::get('/admin/cash-accounts', function () {
    return view('admin.cash-accounts');
});

Route::get('/admin/cash-transfer', function () {
    return view('admin.cash-transfer');
});

Route::get('/admin/customer-payments', function () {
    return view('admin.customer-payments');
});

Route::get('/admin/commissions', function () {
    return view('admin.commissions');
});

Route::get('/admin/posts', function () {
    return view('admin.posts');
});

Route::get('/admin/gallery', function () {
    return view('admin.gallery');
});

Route::get('/admin/messages', function () {
    return view('admin.messages');
});

Route::get('/admin/reports', function () {
    return view('admin.reports');
});

Route::get('/admin/settings', function () {
    return view('admin.settings');
});

Route::get('/user/profile', function () {
    return view('user.profile');
});

Route::get('/admin/login', function () {
    return view('admin.login');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/cars', function () {
    return view('admin.cars');
});

Route::get('/admin/sales', function () {
    return view('admin.sales');
});

Route::get('/admin/customers', function () {
    return view('admin.customers');
});

Route::get('/admin/expenses', function () {
    return view('admin.expenses');
});

Route::get('/admin/cash-accounts', function () {
    return view('admin.cash-accounts');
});

Route::get('/admin/messages', function () {
    return view('admin.messages');
});

Route::get('/admin/posts', function () {
    return view('admin.posts');
});

Route::get('/admin/reports', function () {
    return view('admin.reports');
});

Route::get('/admin/settings', function () {
    return view('admin.settings');
});

Route::get('/admin/gallery', function () {
    return view('admin.gallery');
});

Route::get('/admin/commissions', function () {
    return view('admin.commissions');
});

Route::get('/admin/cash-transfer', function () {
    return view('admin.cash-transfer');
});

Route::get('/admin/customer-payments', function () {
    return view('admin.customer-payments');
});
