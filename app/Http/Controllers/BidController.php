<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Notification;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function placeBidAmount(Request $request,$auction_id){
        
      $bid = Bid::create([
            'user_id' => auth()->user()->id,
            'auction_id' => $auction_id,
            'amount' => $request->amount,
        ]);

         $bid->auction->update([
            'current_bid' => $request->amount,
        ]);

        Notification::create([
            'user_id' => $bid->auction->user_id,
            'bid_id' => $bid->id,
            'type' => 'bid',
            'message' => 'New bid placed on your auction: ' . $bid->auction->title. ' by ' . auth()->user()->name . ' for ' . $request->amount,
            'is_read' => false,
        ]);
        
        return redirect()->back()->with('success', 'Bid placed successfully.');
    }
}
