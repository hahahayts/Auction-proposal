<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    //

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'imageURL' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
            'start_price' => 'required|numeric|min:0',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $user = Auth::user();

        // Create a new auction
         Auction::create([$validatedData,
        'user_id' => $user->id,
        ]);

         if($user->hasRole('admin'))return redirect(route('admin.auction'))->with('success', 'Auction created successfully.');

        return redirect(route('user.auction'))
            ->with('success', 'Auction created successfully.');
    }
}
