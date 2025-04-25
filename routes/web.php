    <?php

    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\AuctionController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\UserController;
    use Illuminate\Support\Facades\Route;

    Route::get('/',[LandingController::class,'index'])->name('landing');
        


    Route::middleware('auth')->group(function () {

        // user routes
        Route::get('/auctions', [UserController::class, 'home'])->name('home');
        Route::get('/auctions/{id}', [UserController::class, 'auctionInfo']);

        // admin routes
        Route::middleware(['can:admin'])->group(function () {
            Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
            Route::get('/admin/auctions',[AdminController::class,'auction'])->name('auction');
            Route::post('/admin/auctions',[AuctionController::class,'store'])->name('auctions.create');
            Route::get('/admin/users',[AdminController::class,'users'])->name('users');
        });

        
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
