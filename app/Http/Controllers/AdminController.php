<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){

        $user = Auth::user();
        $usersCount = User::count();
        $categories = Category::all();


        return inertia('Admin/Dashboard',[
            'usersCount' => $usersCount,
            'categories' => $categories,
        ]);
    
    }

  
    public function auction(){
        $query = Auction::with(['category', 'user']); 

        $categories = Category::all();

        if (request()->has('status')) {
            $query->where('status', request('status'));
        }

        $auctions = $query->paginate(25);
        return inertia('Admin/Auction/Index',[
            'categories' => $categories,
            'auctions' => $auctions,
        ]);
    }

    public function bids(){

        return inertia('Admin/Bids/Index',[
            'bids' => Bid::with(['auction', 'user'])->latest()->get(),
        ]);
    }

    public function users(){
        $user = Auth::user();
        $users = User::with('roles')->get();
        return inertia('Admin/Users/Index',[
            'user' => $user,
            'users' => $users,
        ]);
    }

    public function settings(){

        return inertia('Admin/Settings/Index');
    }
    
}
