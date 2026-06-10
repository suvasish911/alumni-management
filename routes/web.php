<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonationHistoryController;
use App\Http\Controllers\Admin\DonationProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/dashboard', function () {
    return view('admin_dashboard');
})->name('admin.dashboard');

Route::get('/admin/donations/history', [DonationHistoryController::class, 'history'])->name('admin.donations.history');
Route::get('/admin/donations/report', [DonationReportController::class, 'report'])->name('admin.donations.report');
Route::get('/admin/donation-projects', [DonationProjectController::class, 'index'])->name('admin.projects.index');

Route::resource('admin/donations', DonationController::class)
    ->except(['show'])
    ->names([
        'index'   => 'admin.donations.index',
        'create'  => 'admin.donations.create',
        'store'   => 'admin.donations.store',
        'edit'    => 'admin.donations.edit',
        'update'  => 'admin.donations.update',
        'destroy' => 'admin.donations.destroy',
    ]);

Route::get('/admin/donations/{id}/edit', [DonationController::class, 'edit'])->name('admin.donations.edit');

Route::put('/admin/donations/{id}', [DonationController::class, 'update'])->name('admin.donations.update');

Route::delete('/admin/donations/{id}', [DonationController::class, 'destroy'])->name('admin.donations.destroy');

Route::get('/admin/donation-projects', [DonationProjectController::class, 'index'])->name('admin.projects.index');

Route::middleware(['auth', 'verified'])->group(function () {
  
Route::middleware(['role:alumni'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin_dashboard');
        })->name('admin.dashboard');
    });
Route::middleware(['role:accounts_officer'])->group(function () {
        Route::get('/accounts/dashboard', function () {
            return view('accounts_dashboard');
        })->name('accounts.dashboard');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
