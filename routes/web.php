<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AlumniApprovalController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Alumni\EventController as AlumniEventController;

use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonationHistoryController;
use App\Http\Controllers\Admin\DonationProjectController;
use App\Http\Controllers\Admin\DonationReportController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    | Dashboard (Role Based)
    */
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

    /*
    | Profile Routes
    */
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    /*
    | Admin Events
    */
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('events', AdminEventController::class);
    });

    /*
    | Alumni Events
    */
    Route::get('/events', [AlumniEventController::class, 'generalIndex'])->name('general.events.index');

    Route::middleware(['role:alumni'])->prefix('alumni')->name('alumni.')->group(function () {
        Route::get('/events', [AlumniEventController::class, 'index'])->name('events.index');
        Route::get('/events/{id}/register', [AlumniEventController::class, 'register'])->name('events.register');
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });

    /*
    | Donation Routes (Admin)
    */
    Route::get('/admin/donations/history', [DonationHistoryController::class, 'history'])
        ->name('admin.donations.history');

    Route::get('/admin/donations/report', [DonationReportController::class, 'report'])
        ->name('admin.donations.report');

    Route::get('/admin/donation-projects', [DonationProjectController::class, 'index'])
        ->name('admin.projects.index');

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
});

require __DIR__ . '/auth.php';