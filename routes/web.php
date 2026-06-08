<?php
namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AlumniApprovalController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Alumni\EventController as AlumniEventController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonationHistoryController;
use App\Http\Controllers\Admin\DonationProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
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
  


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::middleware(['auth'])->group(function () {
    

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        
        // Route::get('/approvals', [AlumniApprovalController::class, 'index']);
        // Route::post('/approvals/{user}/approve', [AlumniApprovalController::class, 'approve']);


       Route::resource('events',AdminEventController::class);
        
        
    });

    
    Route::get('/events', [AlumniEventController::class, 'generalIndex'])->name('general.events.index'); 
    
    Route::middleware(['role:alumni'])->prefix('alumni')->name('alumni.')->group(function () {
        
        Route::get('/events',[ AlumniEventController::class, 'index'])->name('events.index');
        Route::get('/events/{id}/register',[AlumniEventController::class, 'register'])->name('events.register');
         Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        
    });

   
        
});

});


require __DIR__.'/auth.php';
