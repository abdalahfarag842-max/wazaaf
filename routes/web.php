<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminJobController;
use App\Http\Controllers\AdminCandidateController;
use App\Http\Controllers\AdminApplicationController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminCompanyController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    return match (auth()->user()->role) {
        'admin'     => redirect()->route('dashboard'),
        'employee'  => redirect()->route('hr.jobs.index'),
        'candidate' => redirect()->route('home'),
        default     => redirect()->route('login'),
    };
})->name('welcome');

// ─── Candidate ────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:candidate'])->prefix('candidate')->name('candidate.')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('jobs', JobController::class)->only(['index', 'show']);
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/create', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::patch('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.readAll');
});

// ─── Admin ────────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('jobs', AdminJobController::class);
    Route::resource('candidates', AdminCandidateController::class);
    Route::resource('applications', AdminApplicationController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('companies', AdminCompanyController::class);
});

// ─── Employee (HR) ────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:employee'])->prefix('hr')->name('hr.')->group(function () {
    Route::resource('jobs', AdminJobController::class)->only(['index', 'show']);
    Route::resource('applications', AdminApplicationController::class)->only(['index', 'show', 'edit', 'update']);
});

// ─── Profile ──────────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';