<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GuideAvailabilityController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\GuideProfileController;
use App\Http\Controllers\GuideReviewController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReviewController;
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

// Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');
Route::get('/list-guides', [CustomerController::class, 'guides'])->name('customer.list-guides');

// Admin Dashboard
Route::prefix('admin')->name('admin.')->middleware('auth', 'role:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // Booking Order
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{id}/status', [AdminController::class, 'updateBookingStatus'])->name('booking.status');
    // Setting Commision
    Route::get('/settings/commission', [AdminController::class, 'commissionSettings'])->name('settings.commission');
    Route::post('/settings/commission', [AdminController::class, 'updateCommission']);
    // Guide Management
    Route::get('/guides', [AdminController::class, 'manageGuides'])->name('guides');
    Route::post('/guides/{id}/level', [AdminController::class, 'updateGuideLevel'])->name('guide.level');
    Route::get('/guides/{id}', [AdminController::class, 'guideDetail'])->name('guide.detail');
    Route::post('/guides/{id}/toggle-status', [AdminController::class, 'toggleGuideStatus'])->name('guide.toggle');
    // Customer Management
    Route::get('/customers', [AdminController::class, 'manageCustomers'])->name('customers');
    Route::get('/customers/{id}', [AdminController::class, 'customerDetail'])->name('customer.detail');
    // Place to Visit
    Route::resource('places', PlaceController::class);
    // Gallery
    Route::resource('gallery', GalleryController::class);
    // About US
    Route::get('/about', [AboutUsController::class, 'index'])->name('about.index');
    Route::get('/about/edit', [AboutUsController::class, 'edit'])->name('about.edit');
    Route::put('/about/update', [AboutUsController::class, 'update'])->name('about.update');
    // Contact (just 1 data, edit/update)
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/edit', [ContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact/update/{id}', [ContactController::class, 'update'])->name('contact.update');
});

// Guide Dashboard
Route::prefix('guide')->name('guide.')->middleware(['auth', 'role:guide'])->group(function () {
    Route::get('/dashboard', [GuideController::class, 'dashboard'])->name('dashboard');
    Route::get('/bookings', [GuideController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{id}complete', [GuideController::class, 'markAsCompleted'])->name('booking.complete');
    Route::get('/profile/edit', [GuideProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [GuideProfileController::class, 'update'])->name('profile.update');
    Route::get('/availability', [GuideAvailabilityController::class, 'index'])->name('availability');
    Route::post('/availability', [GuideAvailabilityController::class, 'store'])->name('availability.store');
    Route::post('/availability/bulk', [GuideAvailabilityController::class, 'storeBulk'])->name('availability.bulk');
    Route::delete('/availability/{id}', [GuideAvailabilityController::class, 'destroy'])->name('availability.destroy');
    Route::get('/reviews', [GuideReviewController::class, 'index'])->name('reviews');
});

// Customer
Route::prefix('customer')->name('customer.')->middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('/bookings', [BookingController::class, 'bookings'])->name('bookings');
    Route::get('/bookings/create/{guideId}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/reviews/create/{bookingId}', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('review.store');
});

require __DIR__ . '/auth.php';
