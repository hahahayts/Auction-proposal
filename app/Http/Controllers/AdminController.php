<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){

        $user = Auth::user();
        $categories = Category::all();


        return inertia('Admin/Dashboard',[
            'user' => $user,
            'categories' => $categories,
        ]);
    
    }

    public function home(){
        return inertia('User/Index');
    }

    public function auction(){
        $user = Auth::user();
        $categories = Category::all();
        $auctions = Auction::with('category')->get();
        return inertia('Admin/Auction/Index',[
            'user' => $user,
            'categories' => $categories,
            'auctions' => $auctions,
        ]);
    }
    
}
