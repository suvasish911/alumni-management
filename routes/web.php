<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlumniApprovalController;
use App\Http\Controllers\Admin\EventController;
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


    Route::middleware(['role:account_officer'])->group(function () {
        Route::post('/invoices', [InvoiceController::class, 'store']);
        Route::patch('/invoices/{id}/collect', [InvoiceController::class, 'updateStatus']);
    });


    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        
        Route::get('/approvals', [AlumniApprovalController::class, 'index']);
        Route::post('/approvals/{user}/approve', [AlumniApprovalController::class, 'approve']);


       Route::resource('events',EventController::class);
        
        
    });

    
    Route::get('/events', [EventController::class, 'index'])->name('public.events.index'); 
    
    Route::post('/events/{id}/join', [EventController::class, 'join'])
        ->middleware('role:alumni')->name('events.join');
        
});




require __DIR__.'/auth.php';
