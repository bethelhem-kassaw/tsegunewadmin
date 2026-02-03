<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmailVerifyRequest;
use App\Http\Requests\Auth\LandlordRequest;
use App\Http\Requests\Auth\OTPRequest;
use App\Http\Requests\Auth\PhoneVerifyRequest;
use App\Http\Requests\Auth\ResetLinkRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\VerifyBeforeResetRequest;
use App\Mail\VerifyEmailCode;
use App\Models\Landlord;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\RateLimiter;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function sendResetCode(ResetLinkRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return $this->sendEmailVerification($user, 'Reset password notification');
        } else {
            return response(['status' => 'error', 'message' => 'user with this email is not found'], 401);
        }
    }
    public function sendOtp(OTPRequest $request)
    {
        $user = User::where('phone', $request->phone)->first();
        $phone = $request->phone;
        $userId = $user ? $user->id : null;
        $executed = RateLimiter::attempt(
            'send-message:' . $userId,
            $perMinute = 1,
            function () use ($phone, $userId) {
                return $this->sendPhoneVerification($phone, $userId);
            }
        );

        if (!$executed) {
            return response([
                'message' => 'Too many messages tries, please try after while',
                'status' => 'fail',
            ], 401);
        } else {
            return $executed;
        }
    }
    public function sendVerifyPhone()
    {
        $user = auth()->user();
        return $this->sendPhoneVerification($user->phone, $user->id);
    }
    public function verifyPhone(PhoneVerifyRequest $request)
    {
        $user = auth()->user();
        $verificationCode = VerificationCode::where('user_id', $user->id)->latest()->first();
        if ($verificationCode->verification_for == 'phone' && $verificationCode->code_sent == $request->verification_code) {
            $user->phone_verified_at = now();
            $user->save();
        } else {
            return response([
                'status' => 'fail',
                'message' => 'Verification code was incorrect',
            ], 401);
        }
    }
    public function verifyPhoneBefore(PhoneVerifyRequest $request)
    {
        $verificationCode = VerificationCode::where('phone_number', $request->phone_number)->latest()->first();
        if ($verificationCode->verification_for == 'phone' && $verificationCode->code_sent == $request->verification_code) {
            $verificationCode->status = 'verified';
            $verificationCode->save();
            return response(['status' => 'success', 'phone' => $request->phone_number]);
        }
        return response(['status' => 'failed'], 302);
    }
    public function verifyBeforeReset(VerifyBeforeResetRequest $request){
        if ($request->has('email')) $user = User::where('email', $request->email)->first();
        else $user = User::where('phone', $request->phone)->first();
        $verificationCode = VerificationCode::where('user_id', $user->id)->latest()->first();

        if ($user && $verificationCode && $verificationCode->code_sent == $request->verification_code) {
            $verificationCode->status = 'verified';
            $verificationCode->save();
            return response(['status' => 'success', 'message' => 'Verified successfully']);
        } else {
            return response(['status' => 'fail', 'message' => 'The verification code is incorrect'], 401);
        }

    }
    public function sendVerifyEmail()
    {
        $user = auth()->user();
        return $this->sendEmailVerification($user, 'Email verification');
    }
    public function verifyEmail(EmailVerifyRequest $request)
    {
        $user = auth()->user();
        $verificationCode = VerificationCode::where('user_id', $user->id)->latest()->first();
        if ($verificationCode->verification_for == 'email' && $verificationCode->code_sent == $request->verification_code) {
            $user->email_verified_at = now();
            $user->save();
        } else {
            return response([
                'status' => 'fail',
                'message' => 'Verification code was incorrect',
            ], 401);
        }
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        if ($request->has('email')) $user = User::where('email', $request->email)->first();
        else $user = User::where('phone', $request->phone)->first();
        $verificationCode = VerificationCode::where('user_id', $user->id)->latest()->first();
        if ($user && $verificationCode && $verificationCode->status == 'verified') {
            $user->password = Hash::make($request->new_password);
            $user->save();
            $verificationCode->delete();
            return response(['status' => 'success', 'message' => 'password reseted successfully']);
        } else {
            return response(['status' => 'fail', 'message' => 'The user not verified or not found'], 401);
        }
    }
    // public function verifyLandlord(LandlordRequest $request)
    // {
    //     $document1 = $request->file('document1')->store('public/documents');
    //     $document1 = substr($document1, 7);
    //     $document2 = null;
    //     if ($request->hasFile('document2')) {
    //         $document2 = $request->file('document2')->store('public/documents');
    //         $document2 = substr($document2, 7);
    //     }
    //     Landlord::updateOrCreate(
    //         ['user_id' => auth()->id()],
    //         [
    //         'document1' => $document1,
    //         'document2' => $document2,
    //         'status' => 'pending',
    //     ]);
    //     return response(['status' => 'success', 'message' => 'Document uploaded successfully.'], 201);
    // }
    public function sendEmailVerification($user, $title)
    {
        $optMessage = random_int(1000, 9999);
        try {
            Mail::to($user)->send(new VerifyEmailCode($optMessage, $title));
            VerificationCode::create([
                'user_id' => $user->id,
                'verification_for' => 'email',
                'code_sent' => $optMessage,
                'expire_at' => now()->addMinutes(60)
            ]);
            return response(['status' => 'success', 'message' => 'check your email']);
        } catch (Exception $e) {
            return response(['status' => 'fail', 'message' => $e->getMessage()], 506);
        }
    }
    public function sendPhoneVerification($toPhone, $userId = null)
    {

        $optMessage = random_int(1000, 9999);
        $template_id = 'otp';

        $postData = array('to' => $toPhone, 'message' => $optMessage,  'template_id' => $template_id,  'token' => 'd032ba4-eabe3a1-a-e5859e-8561647-a1-da62');
        $url = "https://sms.yegara.com/api/send";
        $content = json_encode($postData);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array("Content-type: application/json")
        );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $json_response = json_decode($response);

        if ($json_response->status == 'success') {
            VerificationCode::create([
                'user_id' => $userId,
                'verification_for' => 'phone',
                'phone_number' => $toPhone,
                'code_sent' => $optMessage,
                'expire_at' => now()->addMinutes(60)
            ]);
        }
        return $json_response;
    }
}
