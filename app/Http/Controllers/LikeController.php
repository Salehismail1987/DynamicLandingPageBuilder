<?php

namespace App\Http\Controllers;

use App\Models\EngagementNotification;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\WebsiteClick;
use App\Models\WebsiteVisitor;
use Carbon\Carbon;

class LikeController extends Controller
{
    public function incrementLike(Request $request)
    {
        // dd($request);
        $categories = $request->input('categories'); // Array of selected categories
        foreach ($categories as $category) {
            // Check if a record exists for the same category and today's date
            $like = Like::where('category', $category)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            if ($like) {
                // Increment the counter if record exists for today
                $like->increment('count');
            } else {
                // Create a new record for the new date
                $like = Like::create([
                    'category' => $category,
                    'count' => 1, // Start with 1 since this is the first "like" for today
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        notificationSend();
        return response()->json(['success' => true, 'message' => 'Like added!', 'count' => $like->count]);
    }

    public function saveEngagementsData(Request $request)
    {
        $requestData = $request->all();

        $emails = $requestData['emails'] ?? null;
        $time = $requestData['time'] ?? null;
        // Save notifications if emails and time are provided
        if ($emails || $time) {
            // Process emails
            if (is_array($emails)) {
                $emails = implode(',', $emails); // Convert array to a comma-separated string
            }
        
            // Process emails
            $emailArray = $emails ? explode(',', str_replace(' ', '', $emails)) : null;
            // Check if a record already exists
            $existingNotification = EngagementNotification::first();
        
            // if ($emails) {
            //     $existingNotification->where('emails', json_encode($emailArray));
            // }
            // if ($time) {
            //     $existingNotification->where('time', $time);
            // }
        
            // $existingNotification = $existingNotification->first();

            if ($existingNotification) {
                // Update the existing notification
                $updatedData = [];
        
                if ($emails) {
                    $updatedData['emails'] = $emailArray;
                }
                if ($time) {
                    $validTime = Carbon::createFromFormat('H:i', $time)->format('Y-m-d H:i:s');
                    $updatedData['time'] = $validTime;
                }

                // $updatedData['notification_sent'] = false; // Reset the notification status if updated
                
                $existingNotification->update($updatedData);
            } else {
                // Create a new notification if no matching record exists
                EngagementNotification::create([
                    'emails' => $emailArray,
                    'time' => Carbon::createFromFormat('H:i', $time)->format('Y-m-d H:i:s'),
                    'notification_sent' => false, // Default to unsent
                ]);
            }
        }
        // Ensure 'engagements' exists
        $engagements = $requestData['engagements'] ?? [];
        $clicksVisitors = $requestData['clicks_visitors'] ?? [];
        foreach ($clicksVisitors as $key => $periods) {
            // Determine if the data relates to 'visitors' or 'website_clicks'
            $model = null;
            if (strpos($key, 'visitor') !== false) {
                // Assuming 'visitor' in key indicates the 'visitors' table
                $model = WebsiteVisitor::class;
            } elseif (strpos($key, 'click') !== false) {
                // Assuming 'click' in key indicates the 'website_clicks' table
                $model = WebsiteClick::class;
            }
            if ($model) {
                foreach ($periods as $period => $newValue) {
                    if ($period === 'last_24') {
                        // Get the record for the specific period (e.g., 'last_24')
                        $lastRecord = $model::where('date', Carbon::today()) // Assuming we're working with today's date
                            ->orderBy('date', 'desc') // Ensure we're getting the most recent record
                            ->first();
                        // If a record exists for this period
                        if ($lastRecord) {
                            // Get the sum of the counts for this specific period
                            (int)$sumOfCounts = $model::where('date', Carbon::today())
                                ->sum('count');

                            // Convert the new value to an integer
                            $newValue = (int) $newValue;

                            // If the updated value is greater than the existing sum, calculate the difference
                            if ($newValue > $sumOfCounts) {
                                $difference = $newValue - $sumOfCounts;
                                // Update the count by adding the difference
                                $lastRecord->count += $difference;
                                $lastRecord->save();
                            }
                        } else {
                            // If no record exists, create a new one with the updated value
                            $newValue = (int) $newValue;
                            $model::create([
                                'count' => $newValue,
                                'date' => Carbon::today(), // Save with today's date
                            ]);
                        }
                    }
                    if ($period === 'last_7') {
                        // Get the latest record within the last 7 days
                        $sumOfEven = $model::whereBetween('date', [Carbon::today()->subDays(7), Carbon::today()])
                            ->sum('count');
                        $secondLatestRecord =  $model::whereBetween('date', [Carbon::today()->subDays(7), Carbon::today()])
                            ->orderBy('date', 'desc')
                            ->skip(1) // Skip the most recent record
                            ->first();

                        if ($secondLatestRecord) {
                            // If the second latest record exists, update it with the new value
                            $newValue = (int)$newValue;
                            $difference = $newValue - $sumOfEven;
                            $secondLatestRecord->count += $difference;
                            // dd($secondLatestRecord);
                            $secondLatestRecord->save();
                        } else {
                            // If no second latest record exists, create a new record for yesterday
                            $newValue = (int)$newValue;
                            $model::create([
                                'count' => $newValue,
                                'date' => Carbon::today()->subDay(2), // Set date to yesterday
                            ]);
                        }
                    }
                    if ($period === 'last_30') {
                        // Get the latest record within the last 7 days
                        $sumOfEven = $model::whereBetween('date', [Carbon::today()->subDays(30), Carbon::today()])
                            ->sum('count');
                        $secondLatestRecord =  $model::whereBetween('date', [Carbon::today()->subDays(30), Carbon::today()])
                            ->orderBy('date', 'desc')
                            ->skip(1) // Skip the most recent record
                            ->first();

                        if ($secondLatestRecord) {
                            // If the second latest record exists, update it with the new value
                            $newValue = (int)$newValue;
                            $difference = $newValue - $sumOfEven;
                            $secondLatestRecord->count += $difference;
                            // dd($secondLatestRecord);
                            $secondLatestRecord->save();
                        } else {
                            // If no second latest record exists, create a new record for yesterday
                            $newValue = (int)$newValue;
                            $model::create([
                                'count' => $newValue,
                                'date' => Carbon::today()->subDay(8), // Set date to yesterday
                            ]);
                        }
                    }
                }
            }
        }
        foreach ($engagements as $category => $newValue) {
            // Fetch the last record for the given category within the last 24 hours
            $lastLike = Like::where('category', $category)
                ->where('created_at', '>=', Carbon::now()->subDay())  // Check if within the last 24 hours
                ->orderBy('created_at', 'desc')
                ->first();
            $sumOfCounts = Like::where('category', $category)->sum('count');
            // Ensure the last record exists
            if ($lastLike) {
                // Get the current saved value from the database (if exists)
                // Convert the new value to integer
                $requestValue = (int) $newValue;
                // If the new value is greater than the saved value, calculate the difference and update
                if ($requestValue > $sumOfCounts) {
                    $difference = $requestValue - $sumOfCounts;
                    // Update the value in the database
                    $lastLike->count += $difference;
                    $lastLike->save();
                }
            } else {
                $new_likes = (int) $newValue - $sumOfCounts;
                Like::create([
                    'category' => $category,
                    'count' => $new_likes,  // Set the initial value for the category
                ]);
            }
        }
        return response()->json(['message' => 'Engagements updated successfully!']);
    }
}
