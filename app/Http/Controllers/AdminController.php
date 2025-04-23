<?php

namespace App\Http\Controllers;

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
    //
}
