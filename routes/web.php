<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('welcome');
})->name('home');




Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('jobs', JobController::class);
    Route::resource('candidates', CandidateController::class);
    Route::resource('applications', ApplicationController::class);
    Route::resource('categories', CategoryController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
