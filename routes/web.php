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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');
Route::get('/list-guides', [CustomerController::class, 'guides'])->name('customer.list-guides');
Route::get('/list-places', [CustomerController::class, 'places'])->name('customer.list-places');
Route::get('/place/{id}', [CustomerController::class, 'placeDetail'])->name('customer.place-detail');
Route::get('/list-gallery', [CustomerController::class, 'gallery'])->name('customer.list-gallery');

// Admin Dashboard
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
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
Route::prefix('guide')->name('guide.')->middleware(['auth', 'verified', 'role:guide'])->group(function () {
    Route::get('/dashboard', [GuideController::class, 'dashboard'])->name('dashboard');
    Route::get('/bookings', [GuideController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{id}complete', [GuideController::class, 'markAsCompleted'])->name('booking.complete');
    Route::get('/profile/edit', [GuideProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [GuideProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-password', [GuideProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::get('/availability', [GuideAvailabilityController::class, 'index'])->name('availability');
    Route::post('/availability', [GuideAvailabilityController::class, 'store'])->name('availability.store');
    Route::post('/availability/bulk', [GuideAvailabilityController::class, 'storeBulk'])->name('availability.bulk');
    Route::delete('/availability/{id}', [GuideAvailabilityController::class, 'destroy'])->name('availability.destroy');
    Route::get('/reviews', [GuideReviewController::class, 'index'])->name('reviews');
});

// Customer
Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [CustomerController::class, 'profile'])->middleware(['auth', 'role:customer'])->name('profile');
    Route::post('/profile/update', [CustomerController::class, 'updateProfile'])->middleware(['auth', 'role:customer'])->name('profile.update');
    Route::post('/profile/update-password', [CustomerController::class, 'updatePassword'])->middleware(['auth', 'role:customer'])->name('profile.updatePassword');
    Route::get('/detail/{id}', [CustomerController::class, 'show'])->name('show');
    Route::get('/bookings', [BookingController::class, 'bookings'])->name('bookings');
    Route::get('/bookings/create/{guideId}', [BookingController::class, 'create'])->middleware(['auth', 'role:customer'])->name('booking.create');
    Route::post('/bookings', [BookingController::class, 'store'])->middleware(['auth', 'role:customer'])->name('booking.store');
    Route::get('/reviews/create/{bookingId}', [ReviewController::class, 'create'])->middleware(['auth', 'role:customer'])->name('review.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->middleware(['auth', 'role:customer'])->name('review.store');
});

require __DIR__ . '/auth.php';
