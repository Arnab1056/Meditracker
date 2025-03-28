<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ButtonController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MedicineOrderController; // Import the MedicineOrderController
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\AdminController;

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

// Home route


Route::get('/', function () {
    return view('index');
})->name('home');

// Example routes
Route::get('/route1', [ButtonController::class, 'route1'])->name('route1');
Route::get('/route2', [ButtonController::class, 'route2'])->name('route2');
Route::get('/route3', [ButtonController::class, 'route3'])->name('route3');

// Search page route
Route::get('/searchpage', [ButtonController::class, 'searchPage'])->name('searchpage');

// Medicine resource routes (CRUD)
Route::resource('medicines', MedicineController::class);

// Custom route for selling medicine
Route::post('medicines/{id}/sell', [MedicineController::class, 'sell'])->name('medicines.sell');

// Route for medicine suggestions
Route::get('/medicines/suggestions', [MedicineController::class, 'suggestions'])->name('medicines.suggestions');

// Search and buy routes
Route::get('/search-medicines', [SearchController::class, 'search']);
Route::post('/buy-medicine/{id}', [SearchController::class, 'buy']);

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard', [AuthController::class, 'dashboard']);

Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');

// Add route for pharmacies index page
Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('pharmacies.index');

Route::resource('pharmacies', PharmacyController::class);

Route::get('/pharmacies/{pharmacy}/medicines', [PharmacyController::class, 'medicines'])->name('pharmacies.medicines');
Route::get('/pharmacies/{pharmacy}/medicines/{medicine}/add', [PharmacyController::class, 'addMedicineForm'])->name('pharmacies.addMedicineForm');
Route::post('/pharmacies/store_medicine', [PharmacyController::class, 'storeMedicine'])->name('pharmacies.store_medicine');
Route::post('/pharmacies/{medicine}/sell', [PharmacyController::class, 'sell'])->name('pharmacies.sell');
Route::delete('/pharmacies/{pharmacyMedicine}/destroy', [PharmacyController::class, 'destroyMedicine'])->name('pharmacies.destroyMedicine');

Route::get('/pharmacies/{pharmacyMedicine}/show', [PharmacyController::class, 'showMedicine'])->name('pharmacies.showMedicine');
Route::get('/pharmacies/{pharmacyMedicine}/edit', [PharmacyController::class, 'editMedicine'])->name('pharmacies.editMedicine');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Add route for getting all orders
Route::get('/cart/orders', [CartController::class, 'getAllOrders'])->name('cart.orders');

Route::get('/order', [MedicineOrderController::class, 'index'])->name('order.page');

Route::get('/pharmacy_medicines', [MedicineOrderController::class, 'index'])->name('pharmacy_medicines.index');

Route::patch('/pharmacy_medicines/{id}', [MedicineOrderController::class, 'updateQuantityAndPrice'])->name('pharmacy_medicines.update');

Route::patch('/pharmacy_medicines/{id}/accept', [MedicineOrderController::class, 'accept'])->name('pharmacy_medicines.accept');

Route::patch('medicine_orders/{id}/update', [MedicineOrderController::class, 'update'])->name('medicine_orders.update');
Route::patch('medicine_orders/{id}/accept', [MedicineOrderController::class, 'accept'])->name('medicine_orders.accept');

Route::patch('pharmacy_medicines/updateByMedicineId/{medicine_id}', [App\Http\Controllers\MedicineOrderController::class, 'updateByMedicineId'])->name('pharmacy_medicines.updateByMedicineId');

Route::patch('pharmacy_medicines/updateByPrice/{price}', [App\Http\Controllers\MedicineOrderController::class, 'updateByPrice'])->name('pharmacy_medicines.updateByPrice');

Route::patch('pharmacy_medicines/updateByPharmacyMedicineId/{id}', [MedicineOrderController::class, 'updateByPharmacyMedicineId'])->name('pharmacy_medicines.updateByPharmacyMedicineId');

Route::patch('/pharmacy_medicines/{id}/updatePrice', [MedicineOrderController::class, 'updatePriceById'])->name('pharmacy_medicines.updatePrice');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/accept/{id}', [OrderController::class, 'accept'])->name('orders.accept'); // Add route for accepting orders
    Route::patch('/orders/{order}/decline', [OrderController::class, 'decline'])->name('orders.decline')->where('order', '[0-9]+');
    Route::delete('/orders/{id}/remove', [OrderController::class, 'remove'])->name('orders.remove');
});

Route::post('/stripe/checkout', [CartController::class, 'stripeCheckout'])->name('stripe.checkout');
Route::get('/cart/success', [CartController::class, 'success'])->name('cart.success');
Route::get('/cart/cancel', [CartController::class, 'cancel'])->name('cart.cancel');

Route::controller(StripePaymentController::class)->group(function(){

    Route::get('stripe', 'stripe');

    Route::post('stripe', 'stripePost')->name('stripe.post');

});

Route::get('/stripe', function () {
    return view('stripe');
})->name('stripe.page');

Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');

Route::get('/admin', [UserManagementController::class, 'index'])->name('admin.page');

Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');