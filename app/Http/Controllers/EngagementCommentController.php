<?php

namespace App\Http\Controllers;

use App\Models\EngagementComment;
use App\Models\EngagementNotification;
use Illuminate\Http\Request;

class EngagementCommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'comment' => 'required|string',
        ]);
        // dd($request);
        EngagementComment::create($validated);

        notificationSend(true);

        return response()->json(['message' => 'Comment added successfully!']);
    }

    public function fetchComments(Request $request)
    {
        // Fetch comments from the database (you can paginate if needed)

        $comments = EngagementComment::where('display', 1)
    ->get()
    ->sortByDesc(function ($comment) {
        // First, sort by 'pinned' status (1 for pinned comes first)
        return $comment->pinned ? 0 : 1;
    })
    ->sortByDesc(function ($comment) {
        // After sorting by 'pinned', sort pinned comments by 'updated_at'
        // and non-pinned comments by 'created_at'
        return $comment->pinned ? $comment->updated_at : $comment->created_at;
    });

        

        // Return the comments as JSON
        return response()->json($comments->values()->toArray());
    }

    public function updateDisplay(Request $request)
    {
        $comment = EngagementComment::find($request->id);
        if ($comment) {
            // Update the display field with the new value (true/false)
            $comment->display = ($request->display == 'true') ? 1 : 0;

            $comment->save();

            // Return success response
            return response()->json(['success' => true]);
        }

        // Return error if comment not found
        return response()->json(['success' => false, 'message' => 'Comment not found.']);
    }

    public function destroy($id)
    {
        $comment = EngagementComment::find($id);

        if ($comment) {
            $comment->delete();
            return response()->json(['message' => 'Comment deleted successfully.']);
        } else {
            return response()->json(['message' => 'Comment not found.'], 404);
        }
    }

    public function togglePin($id, Request $request)
    {
        // Find the comment by ID
        $comment = EngagementComment::findOrFail($id);
        
        // Toggle the pinned status
        if ($request->action == 'pin') {
            $comment->pinned = true;
        } else {
            $comment->pinned = false;
        }

        $comment->save();

        return response()->json(['success' => true]);
    }

    public function updateToggle(Request $request)
    {
        $validated = $request->validate([
         //   'id' => 'required|exists:engagement_notifications,id',
            'engagement_toggle' => 'required|boolean',
        ]);

        $notification = EngagementNotification::first();
        
        if ($notification) {
            // If the record exists, update only the engagement_toggle
            $notification->engagement_toggle = $validated['engagement_toggle'];
            $notification->save(); // Save the updated record
        } else {
            // If the record doesn't exist, create a new record
            
            $eng = new EngagementNotification;
            $eng->emails = null;
            $eng->notification_sent = 1;
            $eng->engagement_toggle = $validated['engagement_toggle'];
            $eng->save();
        }


        return response()->json([
            'success' => true,
            'engagement_toggle' => $notification->engagement_toggle ?? $eng->engagement_toggle
        ]);
    }
    
        public function updateRealTimeToggle(Request $request)
    {
        $validated = $request->validate([
            //'id' => 'required|exists:engagement_notifications,id',
            'real_time_toggle' => 'required|boolean',
        ]);

        $notification = EngagementNotification::firstOrNew([]);
        $notification->is_real_time = $validated['real_time_toggle'];
        $notification->save();

        return response()->json([
            'success' => true,
            'real_time_toggle' => $notification->is_real_time
        ]);
    }
}
