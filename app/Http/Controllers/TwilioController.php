<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TwilioController extends Controller
{
    public function statusCallback(Request $request)
    {
        $messageSid = $request->input('MessageSid');
        $messageStatus = $request->input('MessageStatus');
        $to = $request->input('To');
        $from = $request->input('From');
        $body = $request->input('Body');

        // Log the status update
        Log::info("Message SID: $messageSid, Status: $messageStatus, To: $to, From: $from, Body: $body");

        // DB::table('messages')->where('sid', $messageSid)->update(['status' => $messageStatus]);

        return response()->json(['status' => 'success']);
    }
}
