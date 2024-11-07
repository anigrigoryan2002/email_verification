<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestEmail;


Route::get('/', function () {
    return view('welcome');
    // Mail::to('agrigoryan180302@gmail.com')->send(new MyTestEmail('John Doe'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Auth::routes(['verify' => true]);

require __DIR__.'/auth.php';

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-home', [HomeController::class, 'adminHome'])->name('admin.home'); 
});


