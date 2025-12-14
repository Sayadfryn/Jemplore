<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ReviewController;

// Public
Route::name('public.')->group(function () {
    Route::get('/', [PublicController::class, 'index'])->name('home');
    Route::get('/destination', [PublicController::class, 'destination'])->name('destinations');
    Route::get('/culinary', [PublicController::class, 'culinary'])->name('culinary');
    Route::get('/event', [PublicController::class, 'event'])->name('events');
    Route::get('/package', [PublicController::class, 'package'])->name('packages');

    Route::get('/destination/{id}', [PublicController::class, 'show'])->name('destination.show');
    Route::get('/culinary/{id}', [PublicController::class, 'culinaryProfile'])->name('culinary.profile');
    Route::get('/event/{id}', [PublicController::class, 'eventProfile'])->name('event.profile');
    Route::get('/package/{id}', [PublicController::class, 'packageProfile'])->name('package.profile');
});

// Owner
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', function () { return view('owner.dashboardowner'); })->name('dashboard');
    Route::get('/manage-events', function () { return view('owner.manageevents'); })->name('events.manage');
    Route::get('/manage-culinary', function () { return view('owner.manageculinary'); })->name('culinary.manage');
    Route::get('/profile', [OwnerController::class, 'manageProfile'])->name('profile.manage');
    Route::post('/profile/update', [OwnerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/submission', [OwnerController::class, 'submissionStatus'])->name('submission.status');
    Route::get('/performance', function () { return view('owner.performance'); })->name('reports.performance');
    Route::delete('/account/delete', [OwnerController::class, 'deleteAccount'])->name('account.delete');
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Verification
    Route::get('/verification', [AdminController::class, 'verification'])->name('verification');
    Route::post('/verification/{id}/approve', [AdminController::class, 'approve'])->name('verification.approve');
    Route::post('/verification/{id}/reject', [AdminController::class, 'reject'])->name('verification.reject');

    // Reports
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/reports/export-pdf', [AdminController::class, 'exportPDF'])->name('reports.pdf');
    Route::get('/reports/export-excel', [AdminController::class, 'exportExcel'])->name('reports.excel');

    // Reviews Management
    Route::get('/reviews/all', [AdminController::class, 'getAllReviews'])->name('reviews.all');
    Route::delete('/reviews/{id}', [AdminController::class, 'deleteReview'])->name('reviews.delete');

    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::put('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');

    // Master Data
    Route::get('/master-data', [AdminController::class, 'masterData'])->name('masterdata');
    Route::post('/category/store', [AdminController::class, 'storeCategory'])->name('category.store');
    Route::delete('/category/{id}', [AdminController::class, 'deleteCategory'])->name('category.delete');
    Route::post('/tag/store', [AdminController::class, 'storeTag'])->name('tag.store');
    Route::delete('/tag/{id}', [AdminController::class, 'deleteTag'])->name('tag.delete');
});

// Submission & Reviews (Authenticated Users)
Route::middleware(['auth'])->group(function () {
    Route::get('/become-owner', [SubmissionController::class, 'create'])->name('submission.create');
    Route::post('/become-owner/store', [SubmissionController::class, 'store'])->name('submission.store');
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
    Route::put('/review/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('review.delete');
});

Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
