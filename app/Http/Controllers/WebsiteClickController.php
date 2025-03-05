<?php

namespace App\Http\Controllers;

use App\Models\WebsiteClick;
use Illuminate\Http\Request;

class WebsiteClickController extends Controller
{
    public function recordClick(Request $request)
    {
        // Get today's date
        $today = now()->toDateString();

        // Get the number of clicks from the request
        $clicks = $request->input('clicks', 1); // Default to 1 if no clicks are provided

        // Check if there's already a record for today
        $click = WebsiteClick::where('date', $today)->first();

        if ($click) {
            // Add the new clicks to the existing count
            $click->count += $clicks; // Add the new clicks
            $click->save(); // Save the updated count
        } else {
            // Create a new record for today with the provided clicks
            WebsiteClick::create([
                'count' => $clicks,
                'date' => $today,
            ]);
        }
        notificationSend(true);
        return response()->json(['success' => true, 'message' => 'Clicks recorded!']);
    }
}
