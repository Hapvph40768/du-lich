<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// Public routes
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tours/{id}', [\App\Http\Controllers\HomeController::class, 'showTour'])->name('tours.show');

// Blog public routes
Route::get('/blogs', [\App\Http\Controllers\PublicBlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{id}', [\App\Http\Controllers\PublicBlogController::class, 'show'])->name('blogs.show');

// Booking & Chatbot
Route::middleware('auth')->group(function () {
    Route::post('/tours/{id}/book', [\App\Http\Controllers\PublicBookingController::class, 'store'])->name('bookings.store');
    Route::get('/my-bookings', [\App\Http\Controllers\PublicBookingController::class, 'index'])->name('bookings.my');
    
    // Chatbot API
    Route::post('/chatbot/init', [\App\Http\Controllers\ChatbotController::class, 'init']);
    Route::post('/chatbot/send', [\App\Http\Controllers\ChatbotController::class, 'send']);
});

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('locations', \App\Http\Controllers\Admin\LocationController::class);
    Route::resource('tours', \App\Http\Controllers\Admin\TourController::class);
    Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class);
    Route::resource('tickets', \App\Http\Controllers\Admin\TicketController::class);
    Route::resource('coupons', \App\Http\Controllers\Admin\CouponController::class);
    Route::resource('payments', \App\Http\Controllers\Admin\PaymentController::class)->except(['create', 'store', 'destroy']);
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
});
