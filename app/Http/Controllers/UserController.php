<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home(){

        $status = request()->query();

        if($status)
        {
            $auctions = Auction::with('category')->where('status', $status)->paginate(25);
        }
        else
        {
            $auctions = Auction::with('category')->paginate(25);
        }
        
        return inertia('User/Index',[
            'auctions' => $auctions,
        ]);
    }

    public function auctionInfo($id){
        $auction = Auction::find($id);
        return inertia('User/AuctionInfo',[
            'auction' => $auction,
        ]);
    }

}
