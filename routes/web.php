<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlotterController;
use App\Http\Controllers\Admin\DocumentsController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\AccountApprovalController;
use App\Http\Controllers\Admin\OfficialController;
use App\Http\Controllers\Admin\ResidentController;
use App\Http\Controllers\Admin\PurokController;

// Public routes
Route::view('/', 'public.home')->name('public.home');
Route::view('/map', 'public.map')->name('public.map');
Route::view('/request/clearance', 'public.request-clearance')->name('request.clearance');
Route::view('/request/residency', 'public.request-residency')->name('request.residency');
Route::view('/request/business-permit', 'public.request-business')->name('request.business');
Route::view('/auth', 'public.auth')->name('public.auth');

// Authentication routes (handled by Fortify)
// These are automatically registered by Fortify

// Protected admin routes
Route::middleware(['auth', 'approved'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/officials', [OfficialController::class, 'index'])->name('officials');
    Route::get('/officials/{official}', [OfficialController::class, 'show'])->name('officials.show');
    Route::post('/officials', [OfficialController::class, 'store'])->name('officials.store');
    Route::put('/officials/{official}', [OfficialController::class, 'update'])->name('officials.update');
    Route::delete('/officials/{official}', [OfficialController::class, 'destroy'])->name('officials.destroy');
    
    Route::get('/residents', [ResidentController::class, 'index'])->name('residents');
    Route::get('/residents/{resident}', [ResidentController::class, 'show'])->name('residents.show');
    Route::post('/residents', [ResidentController::class, 'store'])->name('residents.store');
    Route::put('/residents/{resident}', [ResidentController::class, 'update'])->name('residents.update');
    Route::delete('/residents/{resident}', [ResidentController::class, 'destroy'])->name('residents.destroy');
    Route::get('/blotter', [BlotterController::class, 'index'])->name('blotter');
    Route::get('/documents', [DocumentsController::class, 'index'])->name('documents');
    Route::get('/medicine', [MedicineController::class, 'index'])->name('medicine');
    
    // Purok routes
    Route::get('/purok', [PurokController::class, 'index'])->name('purok');
    Route::get('/purok/{id}', [PurokController::class, 'show'])->name('purok.show');
    
    // Certificate routes
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates');
    Route::post('/certificates/generate', [CertificateController::class, 'generate'])->name('certificates.generate');
    Route::get('/certificates/print/{id}', [CertificateController::class, 'print'])->name('certificates.print');
    
    // Template routes
    Route::get('/templates/edit/{templateType}', [TemplateController::class, 'edit'])->name('templates.edit');
    Route::post('/templates/update/{templateType}', [TemplateController::class, 'update'])->name('templates.update');
    
    // Account approval routes (Captain only)
    Route::get('/account-approvals', [AccountApprovalController::class, 'index'])->name('account-approvals');
    Route::post('/account-approvals/{user}/approve', [AccountApprovalController::class, 'approve'])->name('account-approvals.approve');
    Route::post('/account-approvals/{user}/reject', [AccountApprovalController::class, 'reject'])->name('account-approvals.reject');
    Route::delete('/account-approvals/{user}/delete', [AccountApprovalController::class, 'delete'])->name('account-approvals.delete');
});
