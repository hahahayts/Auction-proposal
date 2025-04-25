<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function placeBidAmount(Request $request,$auction_id){
        
      $bid =  Bid::create([
            'user_id' => auth()->user()->id,
            'auction_id' => $auction_id,
            'amount' => $request->amount,
        ]);

         $bid->auction->update([
            'current_bid' => $request->amount,
        ]);
        
        



        return redirect()->back()->with('success', 'Bid placed successfully.');
    }
}
