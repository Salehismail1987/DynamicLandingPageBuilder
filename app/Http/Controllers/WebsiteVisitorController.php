<?php

namespace App\Http\Controllers;

use App\Models\WebsiteVisitor;
use Illuminate\Http\Request;

class WebsiteVisitorController extends Controller
{
    public function recordVisitor(Request $request)
    {
        // Get today's date
        $today = now()->toDateString();

        // Get the number of visitors from the request (if any)
        $visitors = $request->input('visitors', 1); // Default to 1 if not provided

        // Check if there's already a record for today
        $visitorRecord = WebsiteVisitor::where('date', $today)->first();

        if ($visitorRecord) {
            // Add new visitors to the existing count
            $visitorRecord->count += $visitors;
            $visitorRecord->save(); // Save the updated count
        } else {
            // Create a new record for today with the provided visitor count
            WebsiteVisitor::create([
                'count' => $visitors,
                'date' => $today,
            ]);
        }
        notificationSend();
        return response()->json(['success' => true, 'message' => 'Visitor count recorded!']);
    }
}
