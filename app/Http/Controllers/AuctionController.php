<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

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

        // Create a new auction
         Auction::create($validatedData);

        return redirect(route('dashboard'))
            ->with('success', 'Auction created successfully.');
    }
}
