    <?php

    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\UserController;
    use Illuminate\Support\Facades\Route;

    Route::get('/',[LandingController::class,'index'])->name('landing');
        


    Route::middleware('auth')->group(function () {

        // user routes
       Route::middleware(['can:user'])->group(function(){
        Route::get('/auctions', [UserController::class, 'home'])->name('home');
        Route::get('/auctions/category-id={category_id}', [UserController::class, 'home']);
        Route::post('/auctions/bid/{auction_id}', [BidController::class, 'placeBidAmount'])->name('bid');
        Route::get('/auctions/{auction_id}', [UserController::class, 'auctionInfo']);
        Route::get('/my-bids', [UserController::class, 'myBids'])->name('my-bids');
        Route::get('/my-auctions', [UserController::class, 'myAuctions'])->name('user.auction');
        Route::post('/my-auctions/create', [AuctionController::class, 'store']);
        Route::put('/my-auctions/edit/{id}', [AuctionController::class, 'update']);
        Route::delete('/my-auctions/delete/{id}', [AuctionController::class, 'destroy'])->name('my-auctions.delete');
       });

        // admin routes
        Route::middleware(['can:admin'])->group(function () {
            Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
            Route::get('/admin/auctions',[AdminController::class,'auction'])->name('admin.auction');
            Route::post('/admin/auctions',[AuctionController::class,'store'])->name('auctions.create');
            Route::get('/admin/bids',[AdminController::class,'bids'])->name('admin.bids');
            Route::get('/admin/users',[AdminController::class,'users'])->name('users');
            Route::get('/admin/settings',[AdminController::class,'settings'])->name('users');
        });

        
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
