<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Category;

class UserController extends Controller
{
    public function home($category_id = null)
    {
        $query = Auction::with(['category', 'user']); // include related user
    
        if ($category_id) {
            $query->where('category_id', $category_id);
        }
    
        if (request()->has('status')) {
            $query->where('status', request('status'));
        }
    
        $auctions = $query->paginate(25);
    
        return inertia('User/Auction/Index', [
            'auctions' => $auctions,
            'categories' => Category::all(),
        ]);
    }
    

    public function auctionInfo($auction_id){
        $auction = Auction::with(['category', 'user'])->find($auction_id);
        $bids = Bid::with('user')->where('auction_id', $auction_id)->latest()->get();
    
        return inertia('User/Auction/AuctionInfo', [
            'auction' => $auction,
            'bids' => $bids
        ]);
    }

    public function myBids(){

        $bids  = Bid::where('user_id', auth()->user()->id)->with('auction')->get();
        return inertia('User/MyBids/Index', [
            'bids' => $bids,
        ]);
    }

    public function myAuctions(){
        $auctions = Auction::where('user_id', auth()->user()->id)->with('category')->get();
        return inertia('User/MyAuction/Index', [
            'auctions' => $auctions,
        ]);
    }

}
