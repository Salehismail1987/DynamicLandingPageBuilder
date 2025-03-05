<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SuperAdminMessages;
use App\Models\FontFamily;
use App\Models\ImageGalleryCategory;
use App\Models\alertPopupSetting;
use App\Models\EngagementComment;
use App\Models\EngagementNotification;
use App\Models\NotificationSettings;
use App\Models\Like;
use App\Models\WebsiteClick;
use App\Models\WebsiteVisitor;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Comments;
use Request;

class DashboardController extends Controller
{
    public function __construct(){
    }

    public function index()
    {
        $this->data['controller'] = 'dashboard';
        $this->data['controller_name'] = 'Dashboard';
        $this->data['font_family'] = get_font_family(); 
        $this->data['all_categories'] = Like::select('category')->distinct()->get(); // Get all distinct categories
        $this->data['alert_popup_setting'] = alertPopupSetting::first();
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['superadminmessages'] = get_messages();
        $this->data['email_time'] = EngagementNotification::first();
        $this->data['notification_edit'] = false;
        
        // Get engagements data for each date slab
        $this->data['engagements'] = [
            'last_24_hours' => $this->getDataForLast24Hours(),
            'last_7_days' => $this->getDataForLast7Days(),
            'last_30_days' => $this->getDataForLast30Days(),
            'last_12_months' => $this->getDataForLast12Months(),
            'total_likes' => $this->getTotalLikes(),
            'comments' => EngagementComment::all()->sortByDesc(function ($comment) {
                // Pinned comments (if there's a 'pinned' field) should come first
                return $comment->pinned ? 0 : 1; 
            })->sortByDesc('created_at'),
        ];
        // dd($this->data['engagements']);
        return view('admin.dashboard')->with($this->data);
    }
    
        public function getEngagementData()
    {
        $engagements = [
            'last_24_hours' => $this->getDataForLast24Hours(),
            'last_7_days' => $this->getDataForLast7Days(),
            'last_30_days' => $this->getDataForLast30Days(),
            'last_12_months' => $this->getDataForLast12Months(),
            'total_likes' => $this->getTotalLikes(),
            

        ];

        return response()->json(['engagements' => $engagements]);
    }

    // Get likes, clicks, and visitors for the last 24 hours
    private function getDataForLast24Hours()
    {
        return [
            'likes' => $this->getCategoryDataForTimeFrame(Carbon::now()->subDay()),
            'clicks' => WebsiteClick::where('date', '>=', Carbon::now()->subDay())->sum('count'),
            'visitors' => WebsiteVisitor::where('date', '>=', Carbon::now()->subDay())->sum('count'),
        ];
    }

    // Get likes, clicks, and visitors for the last 7 days
    private function getDataForLast7Days()
    {
        return [
            'likes' => $this->getCategoryDataForTimeFrame(Carbon::now()->subDays(7)),
            'clicks' => WebsiteClick::where('date', '>=', Carbon::now()->subDays(7))->sum('count'),
            'visitors' => WebsiteVisitor::where('date', '>=', Carbon::now()->subDays(7))->sum('count'),
        ];
    }

    // Get likes, clicks, and visitors for the last 30 days
    private function getDataForLast30Days()
    {
        return [
            'likes' => $this->getCategoryDataForTimeFrame(Carbon::now()->subDays(30)),
            'clicks' => WebsiteClick::where('date', '>=', Carbon::now()->subDays(30))->sum('count'),
            'visitors' => WebsiteVisitor::where('date', '>=', Carbon::now()->subDays(30))->sum('count'),
        ];
    }

    // Get likes, clicks, and visitors for the last 12 months
    private function getDataForLast12Months()
    {
        return [
            'likes' => $this->getCategoryDataForLast12Months(),
            'clicks' => WebsiteClick::where('date', '>=', Carbon::now()->subMonths(12))->sum('count'),
            'visitors' => WebsiteVisitor::where('date', '>=', Carbon::now()->subMonths(12))->sum('count'),
        ];
    }

    // Get likes for each category in the last 12 months
    private function getCategoryDataForLast12Months()
    {
        $categories = Like::select('category')
            ->distinct()
            ->get();

        $categoryLikes = [];

        foreach ($categories as $category) {
            $categoryLikes[$category->category] = Like::where('category', $category->category)
                ->where('created_at', '>=', Carbon::now()->subMonths(12))
                ->sum('count'); // Sum the count of likes for each category in the last 12 months
        }

        return $categoryLikes;
    }

    // Get likes for each category in a given timeframe
    private function getCategoryDataForTimeFrame($timeframe)
    {
        $categories = Like::select('category')
            ->distinct()
            ->get();

        $categoryLikes = [];

        foreach ($categories as $category) {
            $categoryLikes[$category->category] = Like::where('category', $category->category)
                ->where('created_at', '>=', $timeframe)
                ->sum('count'); // Sum the count of likes for each category in the given timeframe
        }

        return $categoryLikes;
    }

    private function getTotalLikes()
    {
        $categories = Like::select('category')
            ->distinct()
            ->get();

        $categoryLikes = [];

        foreach ($categories as $category) {
            $categoryLikes[$category->category] = Like::where('category', $category->category)
                ->sum('count'); // Sum the count of all likes for each category (total)
        }

        return $categoryLikes;
    }
}
