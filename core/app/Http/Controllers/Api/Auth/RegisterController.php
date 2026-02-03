<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = true;
        $data['password'] = Hash::make($data['password']);
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('public/profiles');
            $data['photo_path'] = substr($path, 7);
        }

        // $verificationCode = VerificationCode::where('phone_number', $request->phone)->latest()->first();

            $data['phone_verified_at'] = now();
            $user = User::create($data);
            $token = $user->createToken('api-token');

            $user = new UserResource($user);
            // $verificationCode->delete();
            $response['data']['user'] = $data;
            $response['data']['token'] = $token->plainTextToken;
            $response['data']['token-type'] = 'Bearer';
            return response($response, 201);

        return response(['status' => 'error', 'message' => 'phone not verivied'], 401);
    }
}
