<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    
    
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware('auth')->group(function () {

    // user routes
    Route::get('/home', [AdminController::class, 'home'])->name('home');





    // admin routes
   Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
   Route::get('/auctions',[AdminController::class,'auction'])->name('auction');
   Route::post('/auctions',[AuctionController::class,'store'])->name('auctions.create');
   Route::get('/users',[AdminController::class,'users'])->name('users');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
