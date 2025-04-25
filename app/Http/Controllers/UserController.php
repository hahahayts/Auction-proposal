<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home(){
        $auctions = Auction::all();
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
