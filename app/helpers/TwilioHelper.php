<?php
namespace App\Helpers;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioHelper
{
    protected $client;

    public function __construct()
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $this->client = new Client($sid, $token);
    }

    public function sendOTP($phoneNumber, $otp)
    {
        try {
            $message = $this->client->messages
            ->create($phoneNumber, // to
              array(
                "from" => env('TWILIO_PHONE_NUMBER'),
                "body" => "Your OTP is: {$otp}"
              )
            );

            Log::info("OTP sent successfully to {$phoneNumber}");
            return true;
        } catch (\Exception $e) {
            Log::error("Error sending OTP: {$e->getMessage()}");
            return false;
        }
    }
}
