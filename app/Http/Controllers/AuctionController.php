<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
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

        if($validatedData['start_time'] < now()) {
            $validatedData['status'] = 'ongoing';
        }
        else {
            $validatedData['status'] = 'upcoming';
        }

        $user = Auth::user();

        // Merge user_id into validated data
        $validatedData['user_id'] = $user->id;


        // Create a new auction
        Auction::create($validatedData);
     

        return redirect()->back()->with('success', 'Bid placed successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'imageURL' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
            'start_price' => 'required|numeric|min:0',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);
    
        // Find the auction
        $auction = Auction::findOrFail($id);
    
        $auction->update($validatedData);
    
        return redirect()->back()->with('success', 'Auction updated successfully.');
    }

    public function destroy($id)
    {

        $auction = Auction::findOrFail($id);
    
        if ($auction->user_id !== auth()->id()) {
            abort(403); // Forbidden
        }
    
        $auction->delete();
    
        return redirect()->back()->with('success', 'Auction deleted successfully.');
    }
    
    
}
