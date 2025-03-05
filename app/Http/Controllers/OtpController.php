<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\TwilioHelper;
use App\Models\Otp;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Twilio\Rest\Client;
use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;


class OtpController extends Controller
{

    protected $client;
    protected $snsClient;
    public function __construct()
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $this->client = new Client($sid, $token);

        $this->snsClient = new SnsClient([
            'version' => 'latest',
            'region'  => config('services.sns.region'),
            'credentials' => [
                'key'    => config('services.sns.key'),
                'secret' => config('services.sns.secret'),
            ],
        ]);
        
    }


    public function sendOtp(Request $request)
    {

        $phoneNumber = $request->phone; 
        try {
            $randomNumber = sprintf("%04d", rand(0, 9999));
            // $twilioHelper->sendOTP($phoneNumber, $randomNumber);
            $message = $this->client->messages
                    ->create($phoneNumber, [
                        "from" => env('TWILIO_PHONE_NUMBER'),
                        "body" => "Your OTP is: {$randomNumber}"
                    ]);
            $first = Otp::where('phone_number',$phoneNumber)->first();
            if($first)
            {
                $otp = $first;
            }
            else
            {
                $otp = new Otp();
            }
            
                $otp->phone_number = $phoneNumber;
                $otp->otp = $randomNumber;
                $otp->save();
                $encodedOtp = Crypt::encryptString($randomNumber); // Encrypt OTP
            
                return response()->json(['message' => 'OTP sent successfully','status' => 'success'], 200);
        } catch (\Exception $e) {
            // Log::error("Error sending OTP: {$e->getMessage()}");
            return response()->json(['message' => 'Failed to send OTP', 'status' => 'error'], 500);
        }
    }
    public function sendOtpEmail(Request $request)
    {
    //     $randomNumber = sprintf("%04d", rand(0, 9999));
    //     // $twilioHelper->sendOTP($phoneNumber, $randomNumber);
    //     $message =  'Your otp is '.$randomNumber;
    //     $phoneNumber = $request->phone;
    //     // dd($phoneNumber);
    //     try {
    //         $result = $this->snsClient->publish([
    //             'Message' => $message,
    //             'PhoneNumber' => $phoneNumber,
    //         ]);

    //         dd($result);
    //     } catch (AwsException $e) {
    //         dd($e->getMessage());
    //         // Handle AWS exception
    //         return $e->getMessage();
    //     }

        $email = $request->phone; 
        try {
            $randomNumber = sprintf("%04d", rand(0, 9999));
            // $twilioHelper->sendOTP($phoneNumber, $randomNumber);
            $data['message'] =  'Your otp is '.$randomNumber;
                    $res = sendmail($email, 'Your OTP for form submission', 'string_template', $data);
            $first = Otp::where('email',$email)->first();
            if($first)
            {
                $otp = $first;
            }
            else
            {
                $otp = new Otp();
            }
            
                $otp->email = $email;
                $otp->otp = $randomNumber;
                $otp->save();
                $encodedOtp = Crypt::encryptString($randomNumber); // Encrypt OTP
            
                return response()->json(['message' => 'OTP sent successfully','status' => 'success'], 200);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            // Log::error("Error sending OTP: {$e->getMessage()}");
            return response()->json(['message' => 'Failed to send OTP', 'status' => 'error'], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $phoneNumber = $request->email; 
        $first = Otp::where('email',$request->email)->first();
        if(isset($request->otp))
        {

                if($first && $first->otp == $request->otp)
                {
                    return response()->json(['message' => 'OTP valid','status' => true], 200);
                    exit;
                }
            } else
            {
                return response()->json(['message' => 'Invalid OTP', 'status' => false], 500);
                exit;
            }
    }

}
