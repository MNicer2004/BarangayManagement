<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlotterController;
use App\Http\Controllers\Admin\DocumentsController;
use App\Http\Controllers\Admin\MedicineController;

// Public routes
Route::view('/', 'public.home')->name('public.home');
Route::view('/services', 'public.services')->name('public.services');
Route::view('/map', 'public.map')->name('public.map');
Route::view('/track', 'public.track')->name('public.track');
Route::view('/request/clearance', 'public.request-clearance')->name('request.clearance');
Route::view('/request/residency', 'public.request-residency')->name('request.residency');
Route::view('/request/business-permit', 'public.request-business')->name('request.business');
Route::view('/auth', 'public.auth')->name('public.auth');

// Authentication routes (handled by Fortify)
// These are automatically registered by Fortify

// Protected admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::view('/officials', 'admin.officials.index')->name('officials');
    Route::view('/residents', 'admin.residents.index')->name('residents');
    Route::get('/blotter', [BlotterController::class, 'index'])->name('blotter');
    Route::get('/documents', [DocumentsController::class, 'index'])->name('documents');
    Route::get('/medicine', [MedicineController::class, 'index'])->name('medicine');
});
