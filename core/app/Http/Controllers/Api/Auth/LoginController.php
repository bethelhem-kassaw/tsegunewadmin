<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\PasswordChangeRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try{
            $request->validated();  

            if($request->has('phone')) $user = User::where('phone', $request->phone)->first();
            else  $user = User::where('email', $request->email)->first();
 
            if($user && Hash::check($request->password, $user->password)){
                $token = $user->createToken('api-token');
                $data = new UserResource($user);
                
                $response['data']['user']       = $data;
                $response['data']['token']      = $token->plainTextToken;
                $response['data']['token-type'] = 'Bearer';
                return $response;
            }
            else{
                return response([
                    'status'  => 'error',
                    'message' => 'These credentials do not match our records.',
                ], 302);
            }
        }
        catch (Exception $e){
            return response()->json($e->getMessage(), 401);
        } 
    }

 
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ['status' => 'success', 'message' => 'token removed from user successfully'];
    }
    public function changePassword(PasswordChangeRequest $request) {
        $user = $request->user();
        if(Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
            return response(['status' => 'success', 'message' => 'Password updated successfully!']);
        }
        return response(['status' => 'failed', 'message' => 'Provided old password is incorrect'], 401);
    }
}