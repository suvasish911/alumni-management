<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlumniApprovalController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Alumni\EventController as AlumniEventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

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
        
        
    });
        
});




require __DIR__.'/auth.php';
