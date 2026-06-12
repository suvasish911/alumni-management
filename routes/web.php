<?php
namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AlumniApprovalController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Alumni\EventController as AlumniEventController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Alumni\DonationController as AlumniDonationController;
use App\Http\Controllers\DonationHistoryController;
use App\Http\Controllers\Admin\DonationProjectController as AdminDonationProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::middleware(['auth', 'verified'])->group(function () {
  


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::middleware(['auth','isActive'])->group(function () {
    

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        
        Route::get('/approvals', [AlumniApprovalController::class, 'index'])->name('approvals.index');
        Route::post('/approvals/{id}/approve', [AlumniApprovalController::class, 'approve'])->name('approvals.approve');
        Route::post('/approvals/{id}/reject', [AlumniApprovalController::class, 'reject'])->name('approvals.reject');

        //Event Managemnet
        Route::resource('events',AdminEventController::class);
        Route::get('/events/{id}/donors', [AdminEventController::class, 'donorList'])->name('events.donors');
        Route::patch('/events/{id}/approve', [AdminEventController::class, 'approveDonor'])->name('events.approve');
        // Route::patch('/events/donors/{id}/approve', [AdminEventController::class, 'approveDonor'])->name('events.approve');
       
       // Donation Management
        Route::get('/donations/history', [DonationHistoryController::class, 'history'])->name('donations.history');
        Route::get('/donations/report', [DonationReportController::class, 'report'])->name('donations.report');




        // Donation Projects 
        Route::get('/donation-projects', [AdminDonationProjectController::class, 'index'])->name('projects.index');
        Route::post('/donation-projects', [AdminDonationProjectController::class, 'store'])->name('projects.store');
        Route::get('/donations/project/{id}/donors', [AdminDonationProjectController::class, 'projectDonors'])->name('project.donors');
        Route::delete('/donation-projects/{id}', [AdminDonationProjectController::class, 'destroy'])->name('projects.destroy');

        Route::resource('donations', AdminDonationController::class)
                ->except(['show','index'])
                ->names([
                       
                        'create'  => 'donations.create',
                        'store'   => 'donations.store',
                        'edit'    => 'donations.edit',
                        'update'  => 'donations.update',
                        'destroy' => 'donations.destroy',
                    ]);


        
    });

    // For General pupblic view
    Route::get('/events', [AlumniEventController::class, 'generalIndex'])->name('general.events.index'); 
    Route::post('/events/{id}/register', [AdminEventController::class, 'storeRegistration'])->name('events.register');


    Route::middleware(['role:alumni'])->prefix('alumni')->name('alumni.')->group(function () {
        
        Route::get('/events',[ AlumniEventController::class, 'index'])->name('events.index');
        Route::post('/events/{id}/register',[AlumniEventController::class, 'register'])->name('events.register');
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        //Donation part
        Route::get('/make-donation', [AlumniDonationController::class, 'index'])->name('donations.index');
        Route::post('/donate-event/{id}', [AlumniDonationController::class, 'storeEventDonation'])->name('donations.storeEvent');
        Route::post('/donate-project/{id}', [AlumniDonationController::class, 'storeProjectDonation'])->name('donations.storeProject');
    });

   
        
});

});


require __DIR__.'/auth.php';
